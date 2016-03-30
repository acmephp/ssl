<?php

/*
 * This file is part of the ACME PHP library.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AcmePhp\Ssl;

/**
 * Represent a chain of certificates.
 *
 * @author Jérémy Derussé <jeremy@derusse.com>
 */
class CertificateChain
{
    /** @var CertificateChain */
    private $issuerCertificateChain;

    /** @var Certificate */
    private $certificate;

    /**
     * @param Certificate      $certificate
     * @param CertificateChain $issuerCertificateChain
     */
    public function __construct(Certificate $certificate, CertificateChain $issuerCertificateChain = null)
    {
        $this->certificate = $certificate;
        $this->issuerCertificateChain = $issuerCertificateChain;
    }

    /**
     * @return Certificate
     */
    public function getCertificate()
    {
        return $this->certificate;
    }

    /**
     * @return string
     */
    public function getIssuerCertificateChain()
    {
        return $this->issuerCertificateChain;
    }

    /**
     * Returns whether or not the certificate is a root certificate.
     *
     * @return bool
     */
    public function isRootCertificate()
    {
        return null === $this->issuerCertificateChain;
    }
}
