<?php

/*
 * This file is part of the ACME PHP library.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AcmePhp\Ssl\Generator;

use AcmePhp\Ssl\Exception\KeyPairGenerationException;
use AcmePhp\Ssl\Factory\KeyPairFactory;
use AcmePhp\Ssl\KeyPair;
use Webmozart\Assert\Assert;

/**
 * Generate random KeyPair using OpenSSL.
 *
 * @author Jérémy Derussé <jeremy@derusse.com>
 */
class KeyPairGenerator
{
    /** @var KeyPairFactory */
    private $keyPairFactory;

    /**
     * @param KeyPairFactory $keyPairFactory
     */
    public function __construct(KeyPairFactory $keyPairFactory = null)
    {
        $this->keyPairFactory = $keyPairFactory ?: new KeyPairFactory();
    }

    /**
     * Generate KeyPair.
     *
     * @param int $keySize Size of the key.
     *
     * @throws KeyPairGenerationException When OpenSSL failed to generate keys.
     *
     * @return KeyPair
     */
    public function generateKeyPair($keySize = 4096)
    {
        Assert::integer($keySize, __METHOD__.'::$keySize should be an integer. Got:%s');

        $key = openssl_pkey_new(
            [
                'private_key_type' => OPENSSL_KEYTYPE_RSA,
                'private_key_bits' => $keySize,
            ]
        );

        if (!openssl_pkey_export($key, $privateKey)) {
            throw new KeyPairGenerationException(
                sprintf(
                    'OpenSSL key export failed during generation with error: %s',
                    openssl_error_string()
                )
            );
        }

        $details = openssl_pkey_get_details($key);

        return $this->keyPairFactory->createKeyPair($details['key'], $privateKey);
    }
}
