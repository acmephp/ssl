<?php

/*
 * This file is part of the ACME PHP library.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AcmePhp\Ssl\Tests\Formatter;

use AcmePhp\Ssl\Certificate;
use AcmePhp\Ssl\CertificateChain;
use AcmePhp\Ssl\CertificateRequest;
use AcmePhp\Ssl\CertificateResponse;
use AcmePhp\Ssl\DistinguishedName;
use AcmePhp\Ssl\Formatter\KeyPairFormatter;
use AcmePhp\Ssl\KeyPair;
use AcmePhp\Ssl\PrivateKey;
use AcmePhp\Ssl\PublicKey;

class KeyPairFormatterTest extends \PHPUnit_Framework_TestCase
{
    /** @var KeyPairFormatter */
    private $service;

    public function setUp()
    {
        parent::setUp();

        $this->service = new KeyPairFormatter();
    }

    public function test format use the certificate PEM()
    {
        $dummyPrivateKeyPEM = uniqid();

        $dummyIssuerChain = $this->prophesize(CertificateChain::class)->reveal();
        $dummyCertificate = $this->prophesize(Certificate::class)->reveal();
        $dummyDistinguishedName = $this->prophesize(DistinguishedName::class)->reveal();
        $dummyPublicKey = $this->prophesize(PublicKey::class)->reveal();

        $dummyPrivateKey = new PrivateKey($dummyPrivateKeyPEM);
        $dummyKeyPair = new KeyPair($dummyPublicKey, $dummyPrivateKey);
        $dummyRequest = new CertificateRequest($dummyDistinguishedName, $dummyKeyPair);
        $dummyResponse = new CertificateResponse($dummyRequest, $dummyIssuerChain, $dummyCertificate);

        $result = $this->service->format($dummyResponse);

        $this->assertSame($dummyPrivateKeyPEM, $result);
    }
}
