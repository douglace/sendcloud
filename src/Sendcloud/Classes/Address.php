<?php

namespace Anthony\Sendcloud\Sendcloud\Classes;

use Anthony\Sendcloud\Sendcloud\Interfaces\DataInterface;

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
        return [
            "name" => $this->getName(),
            "company_name" => $this->getCompanyName(),
            "address_1" => $this->getAddress1(),
            "address_2" => $this->getAddress2(),
            "house_number" => $this->getHouseNumber(),
            "postal_code" => $this->getPostalCode(),
            "city" => $this->getCity(),
            "country" => $this->getCountry(),
            "telephone" => $this->getTelephone(),
            "email" => $this->getEmail()
        ];
    }
}