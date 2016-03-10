<?php

include_once 'DataBaseHelper.php';
class DataBaseSelect {

    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function userCreationTime($userName) {
        if($select =  $this->dbConnection->query("SELECT ".CREATION_TIME." FROM ".TABLE_USERS." WHERE ".USER_NAME." ='$userName'")){
            if(mysqli_num_rows($select)){
                $row = mysqli_fetch_assoc($select);
                return $row[CREATION_TIME];
            }
        }
        return false;
    }

    public function getUserId(User $user) {
        if($select =  $this->dbConnection->query("SELECT * FROM ".TABLE_USERS." WHERE ".USER_NAME." ='".$user->name()."' AND ".PASSWORD." ='".$user->hashedPassword()."'")){
            if(mysqli_num_rows($select)){
                $row = mysqli_fetch_assoc($select);
                return $row[ID];
            }
        }
        return -1;
    }
}