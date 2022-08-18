<?php

namespace Anthony\Sendcloud\Sendcloud\Interfaces;

interface ScQueryInterface {

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @return string
     */
    public function getPassword();

    /**
     * @return string
     */
    public function getBasicAuthorisation();

    /**
     * @return string
     */
    public function getUrl();

    /**
     * @param string $url
     * @return static
     */
    public function setUrl($url);

    /**
     * @return string
     */
    public function getMode();

    /**
     * @param string $mode
     * @return static
     */
    public function setMode($mode);

    /**
     * execute query
     */
    public function exec();

}