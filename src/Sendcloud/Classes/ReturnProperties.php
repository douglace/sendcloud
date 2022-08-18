<?php

namespace Anthony\Sendcloud\Sendcloud\Classes;

use Anthony\Sendcloud\Sendcloud\SqQuery;
use Anthony\Sendcloud\Sendcloud\Classes\Address;
use Anthony\Sendcloud\Sendcloud\Classes\ShipWidth;
use Anthony\Sendcloud\Sendcloud\Classes\ParcelItem;



trait ReturnProperties {

    
    
    /**
     * @var Address
     */
    private $address_from;

    /**
     * @var Address
     */
    private $address_to;

    /**
    * @var ShipWidth
    */
   private $ship_width;

   /**
    * @var ParcelItem[]
    */
   private $parcelItems = [];

   /**
    * @var string
    */
   private $order_number;

   /**
    * @var float
    */
   private $total_order_value;

   /**
    * @var string
    */
   private $external_reference;

    /**
     * @var float
     */
    private $weight;

    // SETTERS

    /**
     * @param Address $address_from
     * @return self
     */
    public function setAddressFrom($address_from) {
        $this->address_from = $address_from;
        return $this;
    }

    /**
     * @param Address $address_to
     * @return self
     */
    public function setAddressTo($address_to) {
         $this->address_to = $address_to;
         return $this;
    }

    /**
     * @param float $weight
     * @return self
     */
    public function setWeight($weight) {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @param ShipWidth $ship_width
     * @return self
     */
    public function setShipWidth($ship_width) {
        $this->ship_width = $ship_width;
        return $this;
    }

    /**
     * @param string
     * @return self
     */
    public function setOrderNumber($order_number) {
        $this->order_number = $order_number;
        return $this;
    }

    /**
     * @param string $external_reference
     * @return self
     */
    public function setExternalReference($external_reference) {
        $this->external_reference = $external_reference;
        return $this;
    }

    /**
     * @param float $total_order_value
     * @return self
     */
    public function setOrderTotalValue($total_order_value) {
        $this->total_order_value = $total_order_value;
        return $this;
    }

    /**
     * @param ParcelItem $item
     * @return self
     */
    public function addParcelItem($item) {
        $this->parcelItems[] = $item;
        return $this;
    }


    // GETTERS

    /**
     * @return Address
     */
    public function getAddressFrom() {
        return $this->address_from;
    }

    /**
     * @return Address
     */
    public function getAddressTo() {
        return $this->address_to;
    }

    /**
     * @return float
     */
    public function getWeight() {
        return $this->weight;
    }

    /**
     * @return ShipWidth
     */
    public function getShipWidth() {
        return $this->ship_width;
    }

    /**
     * @return string
     */
    public function getOrderNumber() {
        return $this->order_number;
    }

    /**
     * @return string
     */
    public function getExternalaReference() {
        return $this->external_reference;
    }

    /**
     * @return float
     */
    public function getTotalOrderValue() {
        return $this->total_order_value;
    }

    /**
     * @return ParcelItem[]
     */
    public function getParcelItems() {
        return $this->parcelItems;
    }

    public function buildParcelItem() {
        return array_map(function(ParcelItem $a){
            return $a->getData();
        }, $this->getParcelItems());
    }

    private function generatePostfield() {
        return [
            "from_address" => $this->getAddressFrom()->getData(),
            "to_address" => $this->getAddressTo()->getData(),
            'ship_with' => $this->getShipWidth()->getData(),
            'weight' => $this->getWeight(),
            'parcel_items' => $this->buildParcelItem(),
            'total_order_value' => $this->getTotalOrderValue(),
            'external_reference' => '"'.$this->getExternalaReference().'"',
            'order_number' => '"'.$this->getOrderNumber().'"',
        ];
    }

    /**
     * @return CreateReturn
     */
    public function simulReturn() {
        $fromAddress = new Address();
        $fromAddress->setName("John")
            ->setCompanyName("Sendcloud")
            ->setHouseNumber("67778873")
            ->setTelephone("+319881729999")
            ->setPostalCode("1013 XX")
            ->setCity("Amsterdam")
            ->setCountry("NL")
            ->setEmail("test@test.com")
            ->setAddress1("Straatlaan")
            ->setAddress2("string")
        ;

        $toAddress = new Address();
        $toAddress->setName("John")
            ->setCompanyName("Sendcloud")
            ->setHouseNumber("67778873")
            ->setTelephone("+319881729999")
            ->setPostalCode("1013 XX")
            ->setCity("Amsterdam")
            ->setCountry("NL")
            ->setEmail("test@test.com")
            ->setAddress1("Straatlaan")
            ->setAddress2("string")
        ;

        $ship_width = new ShipWidth();
        $ship_width->setCarrier('postnl')
        ->setLabelles(true);

        $parcelItem = new ParcelItem();
        $parcelItem->setDescription("description")
            ->setQuantity(2)
            ->setWeight(2.4)
            ->setValue(2.450)
            ->setProductId(5)
        ;

        $createReturn =  new CreateReturn();
        $createReturn->setWeight(4.8)
            ->setOrderNumber("ORD123456")
            ->setExternalReference("RET98765")
            ->setOrderTotalValue(150)
            ->addParcelItem($parcelItem)
            ->setShipWidth($ship_width)
            ->setAddressFrom($fromAddress)
            ->setAddressTo($toAddress)
        ;
        return $createReturn;
    }
    
}