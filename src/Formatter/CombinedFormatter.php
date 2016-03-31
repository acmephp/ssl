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
 * Combine the full chain of a certificate with the private key.
 *
 * @author Jérémy Derussé <jeremy@derusse.com>
 */
class CombinedFormatter implements FormatterInterface
{
    /**
     * @var FullChainFormatter
     */
    private $fullChainFormatter;
    /**
     * @var KeyPairFormatter
     */
    private $keyPairFormatter;

    /**
     * FullChainFormatter constructor.
     *
     * @param FullChainFormatter $fullChainFormatter
     * @param KeyPairFormatter   $keyPairFormatter
     */
    public function __construct(FullChainFormatter $fullChainFormatter, KeyPairFormatter $keyPairFormatter)
    {
        $this->fullChainFormatter = $fullChainFormatter;
        $this->keyPairFormatter = $keyPairFormatter;
    }

    /**
     * {@inheritdoc}
     */
    public function format(CertificateResponse $certificateResponse)
    {
        return implode(
            self::SEPARATOR,
            [
                trim($this->fullChainFormatter->format($certificateResponse)),
                trim($this->keyPairFormatter->format($certificateResponse)),
            ]
        ).self::SEPARATOR;
    }
}
