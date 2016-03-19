<?php
namespace kioskon\application\db;

class DataBaseDelete extends DataBaseHelper{

    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function userWithName($userName) {
        return $this->dbConnection->query("DELETE FROM ".$this->TABLE_USERS.
            " WHERE $this->USER_NAME = '$userName'");
    }

    public function magazineWithName($magazineName) {
        return $this->dbConnection->query("DELETE FROM ".$this->TABLE_MAGAZINES.
            " WHERE $this->MAGAZINE_NAME = '$magazineName'");
    }
}