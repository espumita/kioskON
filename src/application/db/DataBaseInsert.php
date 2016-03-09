<?php

class DataBaseInsert {

    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function inTableUsers(User $newUser, $time) {
        return $this->dbConnection->query("INSERT INTO users (userName,password,creationTime) VALUES ('".$newUser->name()."','".$newUser->hashedPassword()."','".$time."')");
    }
}