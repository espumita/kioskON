<?php

namespace kioskon\model;


class MagazineFilter {

    private $MagazineFormData;

    public function __construct($MagazineFormData) {
        $this->MagazineFormData = $MagazineFormData;
    }

    public function checkName() {
        return $this->checkMaximumAndMinimumDataLength()? false : true;
    }

    private function checkMaximumAndMinimumDataLength() {
        return strlen($this->MagazineFormData) > 45 || strlen($this->MagazineFormData) <= 1;
    }

    public function checkPeriodicity() {
        return !filter_var($this->MagazineFormData,FILTER_VALIDATE_INT) === false;
    }
}