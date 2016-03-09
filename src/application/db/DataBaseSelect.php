<?php

class DataBaseSelect {

    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function userCreationTime($userName) {
        if($select =  $this->dbConnection->query("SELECT creationTime FROM users WHERE userName ='$userName'")){
            if(mysqli_num_rows($select)){
                $row = mysqli_fetch_assoc($select);
                return $row['creationTime'];
            }
        }
        return false;
    }

    public function numOfRowsWhen(User $user) {
        if($select =  $this->dbConnection->query("SELECT * FROM users WHERE userName ='".$user->name()."' AND password ='".$user->hashedPassword()."'")){
            if(mysqli_num_rows($select)) return true;
        }
        return false;
    }
}