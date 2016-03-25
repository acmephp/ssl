<?php

/*
 * This file is part of the ACME PHP library.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AcmePhp\Ssl\Signer;

use AcmePhp\Ssl\DistinguishedName;
use AcmePhp\Ssl\Exception\CSRSigninException;
use AcmePhp\Ssl\KeyPair;

/**
 * Provide tools to sign certificate request.
 *
 * @author Jérémy Derussé <jeremy@derusse.com>
 */
class CertificateRequestSigner
{
    /**
     * Generate a CSR from the given distinguishedName and keyPair.
     *
     * @param DistinguishedName $distinguishedName
     * @param KeyPair           $keyPair
     *
     * @return string
     */
    public function signCertificateRequest(DistinguishedName $distinguishedName, KeyPair $keyPair)
    {
        if (1 < count($distinguishedName->getSubjectAlternativeNames())) {
            $csrObject = $this->createCsrWithSANsObject($distinguishedName, $keyPair);
        } else {
            $csrObject = $this->createCsrObject($distinguishedName, $keyPair);
        }

        if (!$csrObject) {
            throw new CSRSigninException(
                sprintf('OpenSSL CSR signing failed with error: %s', openssl_error_string())
            );
        }

        openssl_csr_export($csrObject, $csrExport);

        return $csrExport;
    }

    /**
     * Generate a CSR object with SANs from the given distinguishedName and keyPair.
     *
     * @param DistinguishedName $distinguishedName
     * @param KeyPair           $keyPair
     *
     * @return mixed
     */
    protected function createCsrWithSANsObject(DistinguishedName $distinguishedName, KeyPair $keyPair)
    {
        $sslConfigTemplate = <<<'EOL'
[ req ]
distinguished_name = req_distinguished_name
req_extensions = v3_req
[ req_distinguished_name ]
[ v3_req ]
basicConstraints = CA:FALSE
keyUsage = nonRepudiation, digitalSignature, keyEncipherment
subjectAltName = @req_subject_alt_name
[ req_subject_alt_name ]
%s
EOL;
        $sslConfigDomains = [];

        foreach (array_values($distinguishedName->getSubjectAlternativeNames()) as $index => $domain) {
            $sslConfigDomains[] = 'DNS.'.($index + 1).' = '.$domain;
        }

        $sslConfigContent = sprintf($sslConfigTemplate, implode("\n", $sslConfigDomains));
        $sslConfigFile = tempnam(sys_get_temp_dir(), 'acmephp_');

        try {
            file_put_contents($sslConfigFile, $sslConfigContent);

            $resource = $keyPair->getPrivateKey()->getResource();

            return openssl_csr_new(
                $this->getCSRPayload($distinguishedName),
                $resource,
                [
                    'digest_alg' => 'sha256',
                    'config'     => $sslConfigFile,
                ]
            );
        } finally {
            unlink($sslConfigFile);
        }
    }

    /**
     * Generate a CSR without SANs from the given distinguishedName and keyPair.
     *
     * @param DistinguishedName $distinguishedName
     * @param KeyPair           $keyPair
     *
     * @return string
     */
    protected function createCsrObject(DistinguishedName $distinguishedName, KeyPair $keyPair)
    {
        $resource = $keyPair->getPrivateKey()->getResource();

        return openssl_csr_new(
            $this->getCSRPayload($distinguishedName),
            $resource,
            ['digest_alg' => 'sha256']
        );
    }

    /**
     * Retrieves a CSR payload from the given distinguished name.
     *
     * @param DistinguishedName $distinguishedName
     *
     * @return array
     */
    private function getCSRPayload(DistinguishedName $distinguishedName)
    {
        return [
            'commonName'             => $distinguishedName->getCommonName(),
            'countryName'            => $distinguishedName->getCountryName(),
            'stateOrProvinceName'    => $distinguishedName->getStateOrProvinceName(),
            'localityName'           => $distinguishedName->getLocalityName(),
            'organizationName'       => $distinguishedName->getOrganizationName(),
            'organizationalUnitName' => $distinguishedName->getOrganizationalUnitName(),
            'emailAddress'           => $distinguishedName->getEmailAddress(),
        ];
    }
}
