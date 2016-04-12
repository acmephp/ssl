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
use AcmePhp\Ssl\Formatter\CombinedFormatter;
use AcmePhp\Ssl\Formatter\FullChainFormatter;
use AcmePhp\Ssl\Formatter\KeyPairFormatter;

class CombinedFormatterTest extends \PHPUnit_Framework_TestCase
{
    /** @var CombinedFormatter */
    private $service;
    /** @var FullChainFormatter */
    private $mockFullChainFormatter;
    /** @var KeyPairFormatter */
    private $mockKeyPairFormatter;

    public function setUp()
    {
        parent::setUp();

        $this->mockFullChainFormatter = $this->prophesize(FullChainFormatter::class);
        $this->mockKeyPairFormatter = $this->prophesize(KeyPairFormatter::class);

        $this->service = new CombinedFormatter(
            $this->mockFullChainFormatter->reveal(),
            $this->mockKeyPairFormatter->reveal()
        );
    }

    public function test format use the certificate PEM()
    {
        $dummyFullChainFormat = uniqid()."\n";
        $dummyKeyPairFormat = uniqid()."\n";

        $dummyResponse = $this->prophesize(CertificateResponse::class)->reveal();

        $this->mockFullChainFormatter->format($dummyResponse)->shouldBeCalled()->willReturn($dummyFullChainFormat);
        $this->mockKeyPairFormatter->format($dummyResponse)->shouldBeCalled()->willReturn($dummyKeyPairFormat);

        $result = $this->service->format($dummyResponse);

        $this->assertSame($dummyFullChainFormat.$dummyKeyPairFormat, $result);
    }
}
