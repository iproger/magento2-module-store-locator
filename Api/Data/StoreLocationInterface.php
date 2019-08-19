<?php

namespace Iproger\StoreLocator\Api\Data;

interface StoreLocationInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return void
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return void
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getCountryId();

    /**
     * @param string $countryId
     * @return void
     */
    public function setCountryId($countryId);

    /**
     * @return int
     */
    public function getRegionId();

    /**
     * @param int $regionId
     * @return void
     */
    public function setRegionId($regionId);

    /**
     * @return string
     */
    public function getCity();

    /**
     * @param string $city
     * @return void
     */
    public function setCity($city);

    /**
     * @return string
     */
    public function getStreet();

    /**
     * @param string $street
     * @return void
     */
    public function setStreet($street);

    /**
     * @return string
     */
    public function getPostcode();

    /**
     * @param string $postcode
     * @return void
     */
    public function setPostcode($postcode);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $email
     * @return void
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getPhone();

    /**
     * @param string $phone
     * @return void
     */
    public function setPhone($phone);

    /**
     * @return string
     */
    public function getFax();

    /**
     * @param string $fax
     * @return void
     */
    public function setFax($fax);

    /**
     * @return float
     */
    public function getLatitude();

    /**
     * @param float $latitude
     * @return void
     */
    public function setLatitude($latitude);

    /**
     * @return float
     */
    public function getLongitude();

    /**
     * @param float $longitude
     * @return void
     */
    public function setLongitude($longitude);
}
