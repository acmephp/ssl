<?php

/*
 * This file is part of the ACME PHP library.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AcmePhp\Ssl\Parser;

use AcmePhp\Ssl\Certificate;
use AcmePhp\Ssl\Exception\CertificateParsingException;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Parse certificate to extract metadata.
 *
 * @author Jérémy Derussé <jeremy@derusse.com>
 */
class CertificateParser
{
    /** @var PropertyAccessor */
    private $accessor;

    /**
     * CertificateParser constructor.
     *
     * @param PropertyAccessor $accessor
     */
    public function __construct(PropertyAccessor $accessor = null)
    {
        $this->accessor = $accessor ?: PropertyAccess::createPropertyAccessor();
    }

    /**
     * Parse the certificate.
     *
     * @param string $content
     *
     * @return Certificate
     */
    public function parse($content)
    {
        $rawData = openssl_x509_parse($content);
        if (!$rawData) {
            throw new CertificateParsingException(
                sprintf('Fail to parse certificate with error: %s', openssl_error_string())
            );
        }

        return new Certificate(
            $this->accessor->getValue($rawData, '[subject][CN]'),
            $this->accessor->getValue($rawData, '[issuer][CN]'),
            $this->accessor->getValue($rawData, '[subject]') === $this->accessor->getValue($rawData, '[issuer]'),
            new \DateTime('@'.$this->accessor->getValue($rawData, '[validFrom_time_t]')),
            new \DateTime('@'.$this->accessor->getValue($rawData, '[validTo_time_t]')),
            $this->accessor->getValue($rawData, '[serialNumber]'),
            array_map(
                function ($item) {
                    return explode(':', trim($item), 2)[1];
                },
                array_filter(
                    explode(',', $this->accessor->getValue($rawData, '[extensions][subjectAltName]')),
                    function ($item) {
                        return false !== strpos($item, ':');
                    }
                )
            )
        );
    }
}
