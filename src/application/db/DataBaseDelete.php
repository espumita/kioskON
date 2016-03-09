<?php

class DataBaseDelete {

    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function userWithName($userName) {
        return $this->dbConnection->query("DELETE FROM users WHERE userName = '".$userName."'");
    }
}