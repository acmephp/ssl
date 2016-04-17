<?php

/*
 * This file is part of the ACME PHP library.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AcmePhp\Ssl\DependencyInjection;

use AcmePhp\Ssl\Formatter\CertificateFormatter;
use AcmePhp\Ssl\Formatter\CombinedFormatter;
use AcmePhp\Ssl\Formatter\FullChainFormatter;
use AcmePhp\Ssl\Formatter\IssuerChainFormatter;
use AcmePhp\Ssl\Formatter\KeyPairFormatter;
use AcmePhp\Ssl\Generator\KeyPairGenerator;
use AcmePhp\Ssl\Parser\CertificateParser;
use AcmePhp\Ssl\Signer\CertificateRequestSigner;
use Interop\Container\ContainerInterface;
use Interop\Container\ServiceProvider;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 */
class AcmeSslServiceProvider implements ServiceProvider
{
    public static function getServices()
    {
        return [
            // Formatters
            KeyPairFormatter::class     => 'getKeyPairFormatter',
            CertificateFormatter::class => 'getCertificateFormatter',
            IssuerChainFormatter::class => 'getIssuerChainFormatter',
            FullChainFormatter::class   => 'getFullChainFormatter',
            CombinedFormatter::class    => 'getCombinedFormatter',

            // Generators
            KeyPairGenerator::class => 'getKeyPairGenerator',

            // Parsers
            CertificateParser::class => 'getCertificateParser',

            // Signers
            CertificateRequestSigner::class => 'getCertificateRequestSigner',
        ];
    }

    /*
     * Formatters
     */

    public static function getKeyPairFormatter()
    {
        return new KeyPairFormatter();
    }

    public static function getCertificateFormatter()
    {
        return new CertificateFormatter();
    }

    public static function getIssuerChainFormatter()
    {
        return new IssuerChainFormatter();
    }

    public static function getFullChainFormatter(ContainerInterface $container)
    {
        return new FullChainFormatter(
            $container->get(CertificateFormatter::class),
            $container->get(IssuerChainFormatter::class)
        );
    }

    public static function getCombinedFormatter(ContainerInterface $container)
    {
        return new CombinedFormatter(
            $container->get(FullChainFormatter::class),
            $container->get(KeyPairFormatter::class)
        );
    }

    /*
     * Generators
     */

    public static function getKeyPairGenerator()
    {
        return new KeyPairGenerator();
    }

    /*
     * Signers
     */

    public static function getCertificateRequestSigner()
    {
        return new CertificateRequestSigner();
    }

    /*
     * Parsers
     */

    public static function getCertificateParser()
    {
        return new CertificateParser();
    }
}
