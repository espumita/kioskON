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
                return $row['creationTime'];
            }
        }
        return false;
    }

    public function numOfRowsWhen(User $user) {
        if($select =  $this->dbConnection->query("SELECT * FROM ".TABLE_USERS." WHERE ".USER_NAME." ='".$user->name()."' AND ".PASSWORD." ='".$user->hashedPassword()."'")){
            if(mysqli_num_rows($select)) return true;
        }
        return false;
    }
}