<?php

/*
 * This file is part of the ACME PHP library.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AcmePhp\Ssl\Tests\Factory;

use AcmePhp\Ssl\Factory\KeyPairFactory;
use AcmePhp\Ssl\KeyPair;

class KeyPairFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var KeyPairFactory */
    private $service;

    public function setUp()
    {
        parent::setUp();

        $this->service = new KeyPairFactory();
    }

    public function test createKeyPair returns instance of KeyPair()
    {
        $dummyPublicKey = uniqid();
        $dummyPrivateKey = uniqid();

        $result = $this->service->createKeyPair($dummyPublicKey, $dummyPrivateKey);

        $this->assertInstanceOf(KeyPair::class, $result);
        $this->assertContains($dummyPublicKey, $result->getPublicKey()->getPEM());
        $this->assertContains($dummyPrivateKey, $result->getPrivateKey()->getPEM());
    }
}
