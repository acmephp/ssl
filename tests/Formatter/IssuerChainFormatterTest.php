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
use AcmePhp\Ssl\CertificateRequest;
use AcmePhp\Ssl\CertificateResponse;
use AcmePhp\Ssl\Formatter\IssuerChainFormatter;

class IssuerChainFormatterTest extends \PHPUnit_Framework_TestCase
{
    /** @var IssuerChainFormatter */
    private $service;

    public function setUp()
    {
        parent::setUp();

        $this->service = new IssuerChainFormatter();
    }

    public function test format use the certificate PEM()
    {
        $dummyCertificatePem = uniqid()."\n";
        $dummyIssuer1Pem = uniqid()."\n";
        $dummyIssuer2Pem = uniqid()."\n";

        $dummyRequest = $this->prophesize(CertificateRequest::class)->reveal();
        $dummyCertificate = new Certificate(
            $dummyCertificatePem,
            new Certificate($dummyIssuer1Pem, new Certificate($dummyIssuer2Pem))
        );

        $dummyResponse = new CertificateResponse($dummyRequest, $dummyCertificate);

        $result = $this->service->format($dummyResponse);

        $this->assertSame($dummyIssuer1Pem.$dummyIssuer2Pem, $result);
    }
}
