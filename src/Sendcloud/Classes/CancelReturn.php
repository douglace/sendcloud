<?php

namespace Anthony\Sendcloud\Sendcloud\Classes;

use Anthony\Sendcloud\Sendcloud\SqQuery;

class CancelReturn extends SqQuery {

    protected $method = "PATCH";

    protected $id;

    /**
     * @param int $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function exec()
    {
        $this->setUrl(
            $this->getUrl().'/'.$this->id.'/cancel'
        );
        return parent::exec();
    }


}