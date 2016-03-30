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
 * Represent the response to a certificate request.
 *
 * @author Jérémy Derussé <jeremy@derusse.com>
 */
class CertificateResponse
{
    /** @var CertificateRequest */
    private $certificateRequest;

    /** @var CertificateChain */
    private $issuerCertificateChain;

    /** @var Certificate */
    private $certificate;

    /**
     * @param CertificateRequest $certificateRequest
     * @param CertificateChain   $issuerCertificateChain
     * @param Certificate        $certificate
     */
    public function __construct(
        CertificateRequest $certificateRequest,
        CertificateChain $issuerCertificateChain,
        Certificate $certificate
    ) {
        $this->certificateRequest = $certificateRequest;
        $this->issuerCertificateChain = $issuerCertificateChain;
        $this->certificate = $certificate;
    }

    /**
     * @return CertificateRequest
     */
    public function getCertificateRequest()
    {
        return $this->certificateRequest;
    }

    /**
     * @return CertificateChain
     */
    public function getIssuerCertificateChain()
    {
        return $this->issuerCertificateChain;
    }

    /**
     * @return Certificate
     */
    public function getCertificate()
    {
        return $this->certificate;
    }
}
