<?php
namespace kioskon\application\db;

use kioskon\model\User;

class DataBaseInsert extends DataBaseHelper{

    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function inTableUsers(User $newUser, $time) {
        return $this->dbConnection->query("INSERT INTO ".$this->TABLE_USERS." (".$this->USER_NAME.",".$this->PASSWORD.",".$this->CREATION_TIME.") VALUES ('".$newUser->name()."','".$newUser->hashedPassword()."','".$time."')");
    }
}