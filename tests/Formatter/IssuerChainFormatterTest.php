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
        $dummyCertificate1 = uniqid();
        $dummyCertificate2 = uniqid();

        $dummyRequest = $this->prophesize(CertificateRequest::class)->reveal();
        $dummyCertificate = $this->prophesize(Certificate::class)->reveal();

        $dummyIssuerChain = new CertificateChain(
            new Certificate($dummyCertificate1),
            new CertificateChain(new Certificate($dummyCertificate2))
        );
        $dummyResponse = new CertificateResponse($dummyRequest, $dummyIssuerChain, $dummyCertificate);

        $result = $this->service->format($dummyResponse);

        $this->assertSame($dummyCertificate1.$dummyCertificate2, $result);
    }
}
