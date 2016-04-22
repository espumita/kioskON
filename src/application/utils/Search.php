<?php

namespace kioskon\application\utils;


use kioskon\application\db\DataBaseSelect;

class Search {

    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function magazineName($searchedMagazine) {
        $select = (new DataBaseSelect($this->dbConnection))->allMagazines();
        foreach ($select as $tableMagazineColumn=>$tableMagazineRow){
            if(strcmp($select[$tableMagazineColumn]['magazineName'],$searchedMagazine)) return $searchedMagazine;
        }
        return -1;
    }
}