<?php

class loginFilter {

    private $loginFormData;

    public function __construct($loginFormData) {
        $this->loginFormData = utf8_encode($loginFormData);
    }

    public function check() {
        return $this->checkMaximumAndMinimumDataLength()? false : $this-> checkAlphaNumericDataContent();
    }

    private function checkMaximumAndMinimumDataLength() {
        return strlen($this->loginFormData) > 15 || strlen($this->loginFormData) < 5;
    }

    private function checkAlphaNumericDataContent() {
        return ctype_alnum($this->loginFormData);
    }

}