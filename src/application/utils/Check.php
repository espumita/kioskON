<?php

namespace kioskon\application\utils;

class Check{

    public static function post($PostVar){
        return isset($_POST[$PostVar]) && !empty($_POST[$PostVar]);
    }

    public static function session(){
        return isset($_SESSION['user']) && isset($_SESSION['id']);
    }
}