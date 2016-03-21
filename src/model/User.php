<?php

namespace kioskon\model;

use \kioskon\model\Password;

class User {

    private $userNickName;
    private $hashedPassword;
    private $email;

    public function __construct($userNickName,$email, Password $password) {
        $this->userNickName = $userNickName;
        $this->email = $email;
        $this->hashedPassword = $password->md5Hash();
    }

    public function name() {
        return $this->userNickName;
    }

    public function hashedPassword() {
        return $this->hashedPassword;
    }
    
    public function email(){
        return $this->email;
    }
}