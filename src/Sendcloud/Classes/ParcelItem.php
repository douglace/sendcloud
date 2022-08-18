<?php

namespace Anthony\Sendcloud\Sendcloud\Classes;

use Anthony\Sendcloud\Sendcloud\Interfaces\DataInterface;

class ParcelItem implements DataInterface {

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var float
     */
    private $weight;

    /**
     * @var float
     */
    private $value;

    /**
     * @var string
     */
    private $product_id;

    // SETTERS

    /**
     * @param string $description
     * @return self
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * @param int $quantity
     * @return self
     */
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
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
     * @param float $value
     * @return self
     */
    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    /**
     * @param float $product_id
     * @return self
     */
    public function setProductId($product_id) {
        $this->product_id = $product_id;
        return $this;
    }

    // GETTERS


    /**
     * Get the value of description
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the value of quantity
     *
     * @return  int
     */ 
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Get the value of weight
     *
     * @return  float
     */ 
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Get the value of value
     *
     * @return  float
     */ 
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the value of product_id
     *
     * @return  string
     */ 
    public function getProductId()
    {
        return $this->product_id;
    }

    public function getData()
    {
        return [
            "description" => $this->getDescription(),
            "quantity" => $this->getQuantity(),
            "weight" => $this->getWeight(),
            "value" => $this->getValue(),
            "product_id" => '"'.$this->getProductId().'"'
        ];
    }
}