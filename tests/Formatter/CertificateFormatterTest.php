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
use AcmePhp\Ssl\Formatter\CertificateFormatter;

class CertificateFormatterTest extends \PHPUnit_Framework_TestCase
{
    /** @var CertificateFormatter */
    private $service;

    public function setUp()
    {
        parent::setUp();

        $this->service = new CertificateFormatter();
    }

    public function test format use the certificate PEM()
    {
        $dummyPEM = uniqid();

        $dummyRequest = $this->prophesize(CertificateRequest::class)->reveal();
        $dummyIssuerChain = $this->prophesize(CertificateChain::class)->reveal();
        $dummyCertificate = new Certificate($dummyPEM);

        $dummyResponse = new CertificateResponse($dummyRequest, $dummyIssuerChain, $dummyCertificate);

        $result = $this->service->format($dummyResponse);

        $this->assertSame($dummyPEM, $result);
    }
}
