<?php

class Password {

    private $passwordAndTime;

    public function __construct($passwordAndTime) {
        $this->passwordAndTime = $passwordAndTime;
    }

    public function md5Hash() {
        return md5($this->passwordAndTime);
    }
}