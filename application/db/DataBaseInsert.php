<?php

include_once 'DataBaseHelper.php';
class DataBaseInsert {

    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function inTableUsers(User $newUser, $time) {
        return $this->dbConnection->query("INSERT INTO ".TABLE_USERS." (".USER_NAME.",".PASSWORD.",".CREATION_TIME.") VALUES ('".$newUser->name()."','".$newUser->hashedPassword()."','".$time."')");
    }
}