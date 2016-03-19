<?php

namespace kioskon\model;


class Magazine{

    private $magazineName;
    private $owner;
    private $periodicity;

    public function __construct($magazineName, $owner, $periodicity){

        $this->magazineName = $magazineName;
        $this->owner = $owner;
        $this->periodicity = $periodicity;
    }

    public function magazineName(){
        return $this->magazineName;
    }

    public function owner() {
        return $this->owner;
    }

    public function periodicity() {
        return $this->periodicity;
    }
}