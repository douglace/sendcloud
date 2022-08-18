<?php

namespace Anthony\Sendcloud\Sendcloud\Classes;

use Anthony\Sendcloud\Sendcloud\SqQuery;
use Exception;

class Lists extends SqQuery {

    private $date_from;

    private $date_to;

    private $cursor;

    private $page_size = 10;

    /**
     * @return string
     */
    public function getDateFrom() {
        return $this->date_from;
    }

    /**
     * @param string $date_from
     * @return self
     */
    public function setDateFrom($date_from) {
        $this->date_from = $date_from;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateTo() {
        return $this->date_to;
    }

    /**
     * @param string $date_to
     * @return self
     */
    public function setDateTo($date_to) {
        $this->date_to = $date_to;
        return $this;
    }

    /**
     * @return string
     */
    public function getCursor() {
        return $this->cursor;
    }

    /**
     * @return string
     */
    public function getPageSize() {
        return $this->page_size;
    }

    /**
     * @param int $page_size
     * @return self
     */
    public function setPageSize($page_size) {
        $this->page_size = $page_size;
        return $this;
    }

    /**
     * @return string
     */
    public function getData() {
        if(!\Validate::isDate($this->getDateFrom()) || !\Validate::isDate($this->getDateTo())) {
            throw new Exception("An error occurred. Invalid dates");
            return false;
        }
        return http_build_query([
            'from_date' => $this->getDateFrom(),
            'to_date' => $this->getDateTo(),
            'page_size' => $this->getPageSize(),
        ]);
    }

    public function exec()
    {
        $this->setUrl(
            $this->getUrl()."?".$this->getData()
        );
        return parent::exec();
    }

}
