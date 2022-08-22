<?php
/**
* 2007-2022 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2022 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

namespace Anthony\Sendcloud\Sendcloud;

use Anthony\Sendcloud\Sendcloud\Interfaces\ScQueryInterface;
use Configuration;

abstract class SqQuery implements ScQueryInterface {

    public function __construct()
    {
        $this->username = Configuration::get('SC_USERNAME');
        $this->password = Configuration::get('SC_PASSWORD');
    }

    /**
     * @var string
     */
    private $url = "https://panel.sendcloud.sc/api/v3/returns";

    /**
     * @var string
     */
    private $url_dev = "https://stoplight.io/mocks/sendcloud/sendcloud-beta-rest-api/84330/returns";

     /**
     * @var string
     */
    protected $method = "GET";

    /**
     * @var string
     */
    private $mode = "DEV";

    /**
     * @var string
     */
    private $postfield = "";

    /**
     * @var string
     */
    private $username = "happy@dadasport.com";

    /**
     * @var string
     */
    private $password = "@dada4U2!?";

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @return string
     */
    public function getMethod() {
        return $this->method;
    }

    public function getUrl() {
        if($this->getMode() == "DEV") {
            return $this->url_dev;
        }
        return $this->url;
    }

    public function getPostField() {
        return $this->postfield;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function getMode()
    {
        return $this->mode;
    }

    

    /**
     * @return string
     */
    public function getBasicAuthorisation()
    {
        return "Basic ".base64_encode($this->getUsername().':'.$this->getPassword());
    }

    /**
     * @param string $mode
     * @return static
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
        return $this;
    }

    public function getHeaders() {
        return array_merge(
            [
                "Authorization: ".$this->getBasicAuthorisation()
            ],
            $this->headers
        );
    }

    /**
     * @param string $postfield
     * @return static
     */
    public function setPostfield($postfield)
    {
        $this->postfield = $postfield;
        return $this;
    }

    /**
     * @param string $url
     * @return static
     */
    public function setUrl($url) {
        if($this->getMode() == "DEV") {
            $this->url_dev = $url;
        } else {
            $this->url = $url;
        }
        
        return $this;
    }

    /**
     * @param string $header
     * @return static
     */
    public function addHeaders($header) {
        $this->headers[] = $header;
        return $this;
    }




    public function exec()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->getUrl(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $this->getMethod(),
            CURLOPT_POSTFIELDS => $this->getPostField(),
            CURLOPT_HTTPHEADER => $this->getHeaders(),
          ]);
          
          
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        if($err) {
            return false;
        }

        return json_decode($response);
    }
}