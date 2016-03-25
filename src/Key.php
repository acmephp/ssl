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
 * Represent a SSL key.
 *
 * @author Jérémy Derussé <jeremy@derusse.com>
 */
abstract class Key
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @param string $key
     */
    public function __construct($key)
    {
        Assert::stringNotEmpty($key, __CLASS__.'::$key should be an empty string. Got %s');

        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getPEM()
    {
        return $this->key;
    }

    /**
     * @return resource
     */
    abstract public function getResource();
}
