<?php

namespace Anthony\Sendcloud\Sendcloud\Classes;

use Anthony\Sendcloud\Sendcloud\SqQuery;
use Anthony\Sendcloud\Sendcloud\Classes\ReturnProperties;


class ValidateReturn extends SqQuery {
    
    /**
     * @param CreateReturn $return
     */
    public static function validate($return) {
        $newReturn = clone $return;
        return $newReturn->validate();
    }
}