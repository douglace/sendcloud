<?php

namespace Anthony\Sendcloud\Sendcloud\Classes;

use Anthony\Sendcloud\Sendcloud\Interfaces\DataInterface;

use Address as PrestashopAddress;
use Configuration;
use Country;

class Address implements DataInterface {
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $company_name;

    /**
     * @var string
     */
    private $address_1;

    /**
     * @var string
     */
    private $address_2;

    /**
     * @var string
     */
    private $house_number;

    /**
     * @var string
     */
    private $postal_code;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $telephone;

    /**
     * @var string
     */
    private $email;

    // GETTERS

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCompanyName() {
        return $this->company_name;
    }

    /**
     * @return string
     */
    public function getAddress1() {
        return $this->address_1;
    }

    /**
     * @return string
     */
    public function getAddress2() {
        return $this->address_2;
    }

    /**
     * @return string
     */
    public function getHouseNumber() {
        return $this->house_number;
    }

    /**
     * @return string
     */
    public function getPostalCode() {
        return $this->postal_code;
    }

    /**
     * @return string
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getTelephone() {
        return $this->telephone;
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    // SETTERS

    /**
     * @param string $name
     * @return self
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $company_name
     * @return self
     */
    public function setCompanyName($company_name) {
        $this->company_name = $company_name;
        return $this;
    }

     /**
     * @param string $address_1
     * @return self
     */
    public function setAddress1($address_1) {
        $this->address_1 = $address_1;
        return $this;
    }

    /**
     * @param string $address_2
     * @return self
     */
    public function setAddress2($address_2) {
        $this->address_2 = $address_2;
        return $this;
    }

    /**
     * @param string $house_number
     * @return self
     */
    public function setHouseNumber($house_number) {
        $this->house_number = $house_number;
        return $this;
    }

    /**
     * @param string $postal_code
     * @return self
     */
    public function setPostalCode($postal_code) {
        $this->postal_code = $postal_code;
        return $this;
    }

    /**
     * @param string $city
     * @return self
     */
    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    /**
     * @param string $country
     * @return self
     */
    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    /**
     * @param string $telephone
     * @return self
     */
    public function setTelephone($telephone) {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @param string $email
     * @return self
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    // GET FOR QUERY

    public function getData() {
        $data = [
            "name" => $this->getName(),
            "address_1" => $this->getAddress1(),
            "postal_code" => $this->getPostalCode(),
            "city" => $this->getCity(),
            "country" => $this->getCountry(),
        ];

        if(!empty($this->getCompanyName())) {
            $data['company_name'] = $this->getCompanyName();
        }

        if(!empty($this->getCompanyName())) {
            $data['address_2'] = $this->getAddress2();
        }

        if(!empty($this->getCompanyName())) {
            $data['house_number'] = $this->getHouseNumber();
        }

        if(!empty($this->getCompanyName())) {
            $data['telephone'] = $this->getTelephone();
        }

        if(!empty($this->getCompanyName())) {
            $data['email'] = $this->getEmail();
        }

        return $data;
    }
    /**
     * @param PrestashopAddress $addr
     * @param string $email
     * @param string $country_code
     * @return Address
     */
    public static function createFromPrestashopAddress($addr, $email = "", $country_code = '') {
        $address = new Address();
        if(empty($country_code)){
            $country = new Country($addr->id_country);
            $country_code = $country->iso_code;
        }

        $address->setAddress1($addr->address1)
            ->setAddress2($addr->address2)
            ->setName($addr->lastname)
            ->setCompanyName($addr->company)
            ->setHouseNumber($addr->phone)
            ->setCity($addr->city)
            ->setPostalCode($addr->postcode)
            ->setCountry($country_code)
            ->setTelephone($addr->phone_mobile)
            ->setEmail($email)
        ;

        return $address;
    }

    public static function createAdminPrestashopAddress() {
        $address = new Address();
        $name = Configuration::get('PS_SHOP_NAME');
        $email = Configuration::get('PS_SHOP_EMAIL');
        $country = new Country(Configuration::get('PS_COUNTRY_DEFAULT'));

        $address->setName($name)
            ->setCompanyName($name)
            ->setAddress1($name)
            ->setEmail($email)
            ->setPostalCode("64990")
            ->setCity("Toulouse")
            ->setTelephone('+319881729999')
            ->setCountry($country->iso_code)
            ->setHouseNumber("67778873")
            ->setAddress2($name)
        ;

        return $address;
    }
}