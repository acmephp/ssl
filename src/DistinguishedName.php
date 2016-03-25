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
 * Represent a Distinguished Name.
 *
 * @author Jérémy Derussé <jeremy@derusse.com>
 */
class DistinguishedName
{
    /** @var string */
    private $commonName;

    /** @var string */
    private $countryName;

    /** @var string */
    private $stateOrProvinceName;

    /** @var string */
    private $localityName;

    /** @var string */
    private $organizationName;

    /** @var string */
    private $organizationalUnitName;

    /** @var string */
    private $emailAddress;

    /** @var array */
    private $subjectAlternativeNames;

    /**
     * @param string $commonName
     * @param string $countryName
     * @param string $stateOrProvinceName
     * @param string $localityName
     * @param string $organizationName
     * @param string $organizationalUnitName
     * @param string $emailAddress
     * @param array  $subjectAlternativeNames
     */
    public function __construct(
        $commonName,
        $countryName,
        $stateOrProvinceName,
        $localityName,
        $organizationName,
        $organizationalUnitName,
        $emailAddress,
        array $subjectAlternativeNames
    ) {
        Assert::stringNotEmpty($commonName, __CLASS__.'::$commonName expected a non empty string. Got: %s');
        Assert::stringNotEmpty($countryName, __CLASS__.'::$countryName expected a non empty string. Got: %s');
        Assert::stringNotEmpty(
            $stateOrProvinceName,
            __CLASS__.'::$stateOrProvinceName expected a non empty string. Got: %s'
        );
        Assert::stringNotEmpty($localityName, __CLASS__.'::$localityName expected a non empty string. Got: %s');
        Assert::stringNotEmpty($organizationName, __CLASS__.'::$organizationName expected a non empty string. Got: %s');
        Assert::stringNotEmpty(
            $organizationalUnitName,
            __CLASS__.'::$organizationalUnitName expected a non empty string. Got: %s'
        );
        Assert::stringNotEmpty($emailAddress, __CLASS__.'::$emailAddress expected a non empty string. Got: %s');
        Assert::allStringNotEmpty(
            $subjectAlternativeNames,
            __CLASS__.'::$subjectAlternativeNames expected an array of non empty string. Got: %s'
        );

        $this->commonName = $commonName;
        $this->countryName = $countryName;
        $this->stateOrProvinceName = $stateOrProvinceName;
        $this->localityName = $localityName;
        $this->organizationName = $organizationName;
        $this->organizationalUnitName = $organizationalUnitName;
        $this->emailAddress = $emailAddress;
        $this->subjectAlternativeNames = array_unique(array_merge([$commonName], $subjectAlternativeNames));
    }

    /**
     * @return string
     */
    public function getCommonName()
    {
        return $this->commonName;
    }

    /**
     * @return string
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * @return string
     */
    public function getStateOrProvinceName()
    {
        return $this->stateOrProvinceName;
    }

    /**
     * @return string
     */
    public function getLocalityName()
    {
        return $this->localityName;
    }

    /**
     * @return string
     */
    public function getOrganizationName()
    {
        return $this->organizationName;
    }

    /**
     * @return string
     */
    public function getOrganizationalUnitName()
    {
        return $this->organizationalUnitName;
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @return array
     */
    public function getSubjectAlternativeNames()
    {
        return $this->subjectAlternativeNames;
    }
}
