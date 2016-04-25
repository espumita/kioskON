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
            if(strcmp($select[$tableMagazineColumn]['magazineName'],$searchedMagazine) == 0) return $select[$tableMagazineColumn]['magazineName'];
        }
        return "Not Found";
    }

    public function userName($userName) {
        if($userId = (new DataBaseSelect($this->dbConnection))->userId($userName)){
            if($data = (new DataBaseSelect($this->dbConnection))->allMagazinesFromUser($userId));
                if( $data != -1) return $data;
        };
        return "Not Found";
    }
}