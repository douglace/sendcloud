<?php

namespace Anthony\Sendcloud\Mollie;

use Tools;
use Configuration;
use Mollie\Api\MollieApiClient;
use Mollie\Api\Resources\Payment;

class Mollie {

    private static $_instance = null;

    private $live_mode = true;

    private $api_key = null;

    private $fees = 10;

    private $currency = 'EUR';

    private $description = 'FEES';

    private $redirectmollie;

    private $webhookmollie;

    private $metadata = [];

    /**
     * @var MollieApiClient
     */
    private $mollie;

    private function __construct() {}

    /**
     * @return Mollie
     */
    public static function getInstance($live_mode = null) {
        if(self::$_instance == null) {

            self::$_instance =  new Mollie();
            self::$_instance->live_mode = (bool)Configuration::get('SC_LIVE_MODE');
            self::$_instance->fees = number_format((float)Configuration::get('SC_API_MOLLIE_FEES'), 2, '.', '');
            
            if(is_bool($live_mode)) {
                if($live_mode) {
                    self::$_instance->api_key = Configuration::get('SC_API_MOLLIE_LIVE');
                } else {
                    self::$_instance->api_key = Configuration::get('SC_API_MOLLIE_TEST');
                }
            }else {
                if(self::$_instance->live_mode) {
                    self::$_instance->api_key = Configuration::get('SC_API_MOLLIE_LIVE');
                } else {
                    self::$_instance->api_key = Configuration::get('SC_API_MOLLIE_TEST');
                }
            }

            self::$_instance->initMollie(); 
            
        }

        return self::$_instance;
    }

    private function initMollie() {
        $this->mollie = new MollieApiClient();
        $this->mollie->setApiKey($this->api_key);
    }

    public function getProfil() {
        return $this->mollie->profiles->getCurrent();
    }

    /**
     * @return Payment
     */
    public function createPayments() {
        return $this->mollie->payments->create([
            "amount" => [
                "currency" => $this->getCurrency(),
                "value" => $this->getFees()
            ],
            "description" => $this->getDescription(),
            "redirectUrl" => $this->getRedirect(),
            "webhookUrl"  => $this->getWebhook(),
            "metadata" => $this->getMetadata()
        ]);
    }

    /**
     * @param string $id_payment
     * @return Payment
     */
    public function getPayment($id_payment) {
        return $this->mollie->payments->get($id_payment);
    }

    /**
     * @param string $iso_code
     * @return Mollie
     */
    public function setCurrency($iso_code) {
        $this->currency = $iso_code;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * @param string $description
     * @return Mollie
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param string $fees
     * @return Mollie
     */
    public function setFees($fees) {
        $this->fees = number_format((float)$fees, 2, '.', '');;
        return $this;
    }

    /**
     * @return string
     */
    public function getFees() {
        return $this->fees;
    }

    /**
     * @param string $redirectmollie
     * @return Mollie
     */
    public function setRedirect($redirectmollie) {
        $this->redirectmollie = $redirectmollie;
        return $this;
    }

    /**
     * @return string
     */
    public function getRedirect() {
        return $this->redirectmollie;
    }

    /**
     * @param string $webhook
     * @return Mollie
     */
    public function setWebhook($webhook) {
        $this->webhookmollie = $webhook;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebhook() {
        return $this->webhookmollie;
    }

    /**
     * @param array $metadata
     * @return Mollie
     */
    public function setMetadata($metadata) {
        $this->metadata = $metadata;
        return $this;
    }

    /**
     * @return array
     */
    public function getMetadata() {
        return $this->metadata;
    }
}