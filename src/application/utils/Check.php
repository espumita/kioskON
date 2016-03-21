<?php

namespace kioskon\application\utils;

class Check{

    public static function post($inputPostVar){
        return isset($_POST[$inputPostVar]) && !empty($_POST[$inputPostVar]);
    }

    public static function session(){
        return isset($_SESSION['user']) && isset($_SESSION['id']);
    }

    public static function files($inputFile){
        return isset($_FILES[$inputFile]['size']) && !empty($_FILES[$inputFile]['size'])
        &&  isset($_FILES[$inputFile]['name']) && !empty($_FILES[$inputFile]['name'])
        && isset($_FILES[$inputFile]['tmp_name']) && !empty($_FILES[$inputFile]['tmp_name'])
        && isset($_FILES[$inputFile]['type']) && !empty($_FILES[$inputFile]['type']);
    }

    public static function fileSize($inputFile) {
        return $_FILES[$inputFile]['size'] > 0 && $_FILES[$inputFile]['size'] < (1 * 1048576);
    }

    public static function fileExtension($inputFile, $extensions) {
        return (in_array(pathinfo($_FILES[$inputFile]['name'], PATHINFO_EXTENSION), $extensions)) ;
    }
}