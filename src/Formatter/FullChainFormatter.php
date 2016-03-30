<?php

/*
 * This file is part of the ACME PHP library.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AcmePhp\Ssl\Formatter;

use AcmePhp\Ssl\CertificateResponse;

/**
 * Format the full chain certificate from the certificate to the issuer's root certificate.
 *
 * @author Jérémy Derussé <jeremy@derusse.com>
 */
class FullChainFormatter implements FormatterInterface
{
    /**
     * @var IssuerChainFormatter
     */
    private $issuerChainFormatter;
    /**
     * @var CertificateFormatter
     */
    private $certificateFormatter;

    /**
     * FullChainFormatter constructor.
     *
     * @param CertificateFormatter $certificateFormatter
     * @param IssuerChainFormatter $issuerChainFormatter
     */
    public function __construct(CertificateFormatter $certificateFormatter, IssuerChainFormatter $issuerChainFormatter)
    {
        $this->issuerChainFormatter = $issuerChainFormatter;
        $this->certificateFormatter = $certificateFormatter;
    }

    /**
     * {@inheritdoc}
     */
    public function format(CertificateResponse $certificateResponse)
    {
        return implode(
            '',
            [
                $this->certificateFormatter->format($certificateResponse),
                $this->issuerChainFormatter->format($certificateResponse),
            ]
        );
    }
}
