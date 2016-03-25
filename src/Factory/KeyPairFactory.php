<?php

/*
 * This file is part of the ACME PHP library.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AcmePhp\Ssl\Factory;

use AcmePhp\Ssl\KeyPair;
use AcmePhp\Ssl\PrivateKey;
use AcmePhp\Ssl\PublicKey;

/**
 * Crate KeyPair entities from PEMs.
 *
 * @author Jérémy Derussé <jeremy@derusse.com>
 */
class KeyPairFactory
{
    /**
     * Generate KeyPair.
     *
     * @param string $publicKey  the PEM formatted public key
     * @param string $privateKey the PEM formatted private key
     *
     * @return KeyPair
     */
    public function createKeyPair($publicKey, $privateKey)
    {
        return new KeyPair(
            new PublicKey($publicKey),
            new PrivateKey($privateKey)
        );
    }
}
