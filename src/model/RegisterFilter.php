<?php

namespace kioskon\model;


class RegisterFilter {

    private $RegisterFormData;

    public function __construct($RegisterFormData) {

        $this->RegisterFormData = $RegisterFormData;
    }

    public function checkEmail() {
        return !filter_var($this->RegisterFormData,FILTER_VALIDATE_EMAIL) === false;
    }

    public function check() {
        return $this->checkMaximumAndMinimumDataLength()? false : $this-> checkAlphaNumericDataContent();
    }

    private function checkMaximumAndMinimumDataLength() {
        return strlen($this->RegisterFormData) > 15 || strlen($this->RegisterFormData) < 5;
    }

    private function checkAlphaNumericDataContent() {
        return ctype_alnum($this->RegisterFormData);
    }
    
}