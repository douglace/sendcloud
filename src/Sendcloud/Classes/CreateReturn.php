<?php

namespace Anthony\Sendcloud\Sendcloud\Classes;

use Anthony\Sendcloud\Sendcloud\SqQuery;
use Anthony\Sendcloud\Sendcloud\Classes\ReturnProperties;


class CreateReturn extends SqQuery {

    use ReturnProperties;

    protected $method = "POST";

    public function exec()
    {
        $this->setPostfield(json_encode($this->generatePostfield()));
        $this->addHeaders("Content-Type: application/json");
    
        return parent::exec();
    }

    /**
     * Validate a return before create
     */
    public function validate()
    {
        $this->setUrl($this->getUrl().'/validate');
        $this->setPostfield(json_encode($this->generatePostfield()));
        $this->addHeaders("Content-Type: application/json");
    
        return parent::exec();
    }
}