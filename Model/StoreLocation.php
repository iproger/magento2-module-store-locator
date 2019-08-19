<?php

namespace Iproger\StoreLocator\Model;

use Iproger\StoreLocator\Api\Data\StoreLocationInterface;
use Magento\Framework\Model\AbstractModel;

class StoreLocation extends AbstractModel implements StoreLocationInterface
{
    const ENTITY = 'store_location';

    const NAME = 'name';

    const COUNTRY_ID = 'country_id';
    const REGION_ID = 'region_id';
    const REGION = 'region';
    const CITY = 'city';
    const STREET = 'street';
    const POSTCODE = 'postcode';
    const EMAIL = 'email';
    const PHONE = 'phone';
    const FAX = 'fax';
    const LATITUDE = 'latitude';
    const LONGITUDE = 'longitude';

    const STORE_IDS = 'store_ids';


    protected function _construct()
    {
        $this->_init(ResourceModel\StoreLocation::class);
    }

    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function setName($name)
    {
        $this->setData(self::NAME, $name);
    }

    /**
     * @return string
     */
    public function getCountryId()
    {
        return $this->getData(self::COUNTRY_ID);
    }

    /**
     * @param string $countryId
     * @return void
     */
    public function setCountryId($countryId)
    {
        $this->setData(self::COUNTRY_ID, $countryId);
    }

    /**
     * @return int
     */
    public function getRegionId()
    {
        return $this->getData(self::REGION_ID);
    }

    /**
     * @param int $regionId
     * @return void
     */
    public function setRegionId($regionId)
    {
        $this->setData(self::REGION_ID, $regionId);
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->getData(self::CITY);
    }

    /**
     * @param string $city
     * @return void
     */
    public function setCity($city)
    {
        $this->setData(self::CITY, $city);
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->getData(self::STREET);
    }

    /**
     * @param string $street
     * @return void
     */
    public function setStreet($street)
    {
        $this->setData(self::STREET, $street);
    }

    /**
     * @return string
     */
    public function getPostcode()
    {
        return $this->getData(self::POSTCODE);
    }

    /**
     * @param string $postcode
     * @return void
     */
    public function setPostcode($postcode)
    {
        $this->setData(self::POSTCODE, $postcode);
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->setData(self::EMAIL, $email);
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->getData(self::PHONE);
    }

    /**
     * @param string $phone
     * @return void
     */
    public function setPhone($phone)
    {
        $this->setData(self::PHONE, $phone);
    }

    /**
     * @return string
     */
    public function getFax()
    {
        return $this->getData(self::FAX);
    }

    /**
     * @param string $fax
     * @return void
     */
    public function setFax($fax)
    {
        $this->setData(self::FAX, $fax);
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->getData(self::LATITUDE);
    }

    /**
     * @param float $latitude
     * @return void
     */
    public function setLatitude($latitude)
    {
        $this->setData(self::LATITUDE, $latitude);
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->getData(self::LONGITUDE);
    }

    /**
     * @param float $longitude
     * @return void
     */
    public function setLongitude($longitude)
    {
        $this->setData(self::LONGITUDE, $longitude);
    }








    public function getStoreIds()
    {
        return $this->getData(self::STORE_IDS);
    }

    public function setStoreIds($storeIds)
    {
        $this->setData(self::STORE_IDS, $storeIds);
    }

    public function getStoreIdsData()
    {
        if (is_string($this->getData(self::STORE_IDS))) {
            return explode(',', $this->getData(self::STORE_IDS));
        }
        return $this->getData(self::STORE_IDS);
    }
}
