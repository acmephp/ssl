<?php

/*
 * This file is part of the ACME PHP library.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AcmePhp\Ssl;

use Webmozart\Assert\Assert;

/**
 * Represent a Certificate.
 *
 * @author Jérémy Derussé <jeremy@derusse.com>
 */
class Certificate
{
    /** @var string */
    private $certificatePEM;

    /**
     * @param string $certificatePEM
     */
    public function __construct($certificatePEM)
    {
        Assert::stringNotEmpty($certificatePEM, __CLASS__.'::$certificatePEM should not be an empty string. Got %s');

        $this->certificatePEM = $certificatePEM;
    }

    /**
     * @return string
     */
    public function getPEM()
    {
        return $this->certificatePEM;
    }
}
