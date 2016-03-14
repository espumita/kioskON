<?php
namespace kioskon\application\db;

use kioskon\model\User;

class DataBaseSelect extends DataBaseHelper{

    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function userCreationTime($userName) {
        if($select =  $this->dbConnection->query("SELECT ".$this->CREATION_TIME." FROM ".$this->TABLE_USERS." WHERE ".$this->USER_NAME." ='$userName'")){
            if(mysqli_num_rows($select)){
                $row = mysqli_fetch_assoc($select);
                return $row[$this->CREATION_TIME];
            }
        }
        return false;
    }

    public function getUserId(User $user) {
        if($select =  $this->dbConnection->query("SELECT * FROM ".$this->TABLE_USERS." WHERE ".$this->USER_NAME." ='".$user->name()."' AND ".$this->PASSWORD." ='".$user->hashedPassword()."'")){
            if(mysqli_num_rows($select)){
                $row = mysqli_fetch_assoc($select);
                return $row[$this->ID];
            }
        }
        return -1;
    }
}