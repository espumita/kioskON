<?php

namespace kioskon\application\utils;

class Redirection{
    public function to($location){
        header("Location: $location");
        exit;
    }
}