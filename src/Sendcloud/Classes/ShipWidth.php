<?php

namespace Anthony\Sendcloud\Sendcloud\Classes;

use Anthony\Sendcloud\Sendcloud\Interfaces\DataInterface;

class ShipWidth implements DataInterface {

    /**
     * @var string
     */
    private $carrier;

    /**
     * @var array
     */
    private $functionalities = [];

    // GETTERS

    /**
     * @var string
     */
    public function getCarrier() {
        return $this->carrier;
    }

    /**
     * @var array
     */
    public function getFunctionalities() {
        return $this->functionalities;
    }

    // SETTERS

    /**
     * @param boolean $labelles
     * @return self
     */
    public function setLabelles($labelless) {
        $this->functionalities = array_merge(
            $this->functionalities,
            [
                'labelless' => $labelless
            ]
        );
        return $this;
    }

    /**
     * @param string $labelles
     * @return self
     */
    public function setCarrier($carrier) {
        $this->carrier = $carrier;
        return $this;
    }

    public function getData()
    {
        return [
            "carrier" => $this->getCarrier(),
            "functionalities" => $this->getFunctionalities()
        ];
    }

} 