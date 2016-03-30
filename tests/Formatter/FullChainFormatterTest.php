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
use AcmePhp\Ssl\CertificateResponse;
use AcmePhp\Ssl\Formatter\CertificateFormatter;
use AcmePhp\Ssl\Formatter\FullChainFormatter;
use AcmePhp\Ssl\Formatter\IssuerChainFormatter;

class FullChainFormatterTest extends \PHPUnit_Framework_TestCase
{
    /** @var FullChainFormatter */
    private $service;
    /** @var IssuerChainFormatter */
    private $mockIssuerChainFormatter;
    /** @var CertificateFormatter */
    private $mockCertificateFormatter;

    public function setUp()
    {
        parent::setUp();

        $this->mockIssuerChainFormatter = $this->prophesize(IssuerChainFormatter::class);
        $this->mockCertificateFormatter = $this->prophesize(CertificateFormatter::class);

        $this->service = new FullChainFormatter(
            $this->mockCertificateFormatter->reveal(),
            $this->mockIssuerChainFormatter->reveal()
        );
    }

    public function test format use the certificate PEM()
    {
        $dummyCertificateFormat = uniqid();
        $dummyIssuerChainFormat = uniqid();

        $dummyResponse = $this->prophesize(CertificateResponse::class)->reveal();

        $this->mockCertificateFormatter->format($dummyResponse)->shouldBeCalled()->willReturn($dummyCertificateFormat);
        $this->mockIssuerChainFormatter->format($dummyResponse)->shouldBeCalled()->willReturn($dummyIssuerChainFormat);

        $result = $this->service->format($dummyResponse);

        $this->assertSame($dummyCertificateFormat.$dummyIssuerChainFormat, $result);
    }
}
