<?php

/*
 * This file is part of the ACME PHP library.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AcmePhp\Ssl\Tests\Generator;

use AcmePhp\Ssl\Generator\KeyPairGenerator;
use AcmePhp\Ssl\KeyPair;

class KeyPairGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /** @var KeyPairGenerator */
    private $service;

    public function setUp()
    {
        parent::setUp();

        $this->service = new KeyPairGenerator();
    }

    public function test generateKeyPair generate random instance of KeyPair()
    {
        $result = $this->service->generateKeyPair(1024);

        $this->assertInstanceOf(KeyPair::class, $result);
        $this->assertContains('-----BEGIN PUBLIC KEY-----', $result->getPublicKey()->getPEM());
        $this->assertContains('-----BEGIN PRIVATE KEY-----', $result->getPrivateKey()->getPEM());
        $this->assertInternalType('resource', $result->getPublicKey()->getResource());
        $this->assertInternalType('resource', $result->getPrivateKey()->getResource());
    }
}
