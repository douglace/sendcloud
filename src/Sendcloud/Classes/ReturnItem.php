<?php

namespace Anthony\Sendcloud\Sendcloud\Classes;

use Anthony\Sendcloud\Sendcloud\SqQuery;

class ReturnItem extends SqQuery {

    private $id;

    public function __construct($id)
    {
        $this->id = $id;
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $id
     * @return self
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }


    public function exec()
    {
        $this->setUrl(
            $this->getUrl()."/".$this->getId()
        );
        return parent::exec();
    }

}
