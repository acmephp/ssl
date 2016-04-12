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
 * Format the private key used to request a certificate.
 *
 * @author Jérémy Derussé <jeremy@derusse.com>
 */
class KeyPairFormatter implements FormatterInterface
{
    /**
     * {@inheritdoc}
     */
    public function format(CertificateResponse $certificateResponse)
    {
        return trim($certificateResponse->getCertificateRequest()->getKeyPair()->getPrivateKey()->getPEM()).self::SEPARATOR;
    }
}
