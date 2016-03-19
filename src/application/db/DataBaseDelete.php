<?php
namespace kioskon\application\db;

class DataBaseDelete extends DataBaseHelper{

    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function userWithName($userName) {
        $this->dbConnection->query("DELETE FROM ".$this->TABLE_USERS.
            " WHERE $this->USER_NAME = '$userName'");
        return $this->dbConnection->affected_rows == 1 ? true : false ;
    }

    public function magazineWithName($magazineName) {
        $this->dbConnection->query("DELETE FROM ".$this->TABLE_MAGAZINES.
            " WHERE $this->MAGAZINE_NAME = '$magazineName'");
        return $this->dbConnection->affected_rows == 1 ? true : false ;
    }
}