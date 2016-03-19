<?php
namespace kioskon\application\db;

use kioskon\model\User;

class DataBaseSelect extends DataBaseHelper{

    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function userCreationTime($userName) {
        if($select =  $this->dbConnection->query("SELECT ".$this->CREATION_TIME." FROM ".$this->TABLE_USERS.
            " WHERE ".$this->USER_NAME." = '$userName'")){
            if(mysqli_num_rows($select)){
                $row = mysqli_fetch_assoc($select);
                return $row[$this->CREATION_TIME];
            }
        }
        return false;
    }

    public function userId(User $user) {
        if($select =  $this->dbConnection->query("SELECT ".$this->USER_ID." FROM ".$this->TABLE_USERS.
            " WHERE ".$this->USER_NAME." ='".$user->name().
            "' AND ".$this->PASSWORD." ='".$user->hashedPassword()."'")){

            if(mysqli_num_rows($select)){
                $row = mysqli_fetch_assoc($select);
                return $row[$this->USER_ID];
            }
        }
        return -1;
    }

    public function allUserMagazines($id) {
        if( $select = $this->dbConnection->query("SELECT ".$this->MAGAZINE_ID.",".$this->MAGAZINE_NAME.",".$this->PERIODICITY.
            " FROM ".$this->TABLE_MAGAZINES.
            " WHERE ".$this->OWNER."='$id'")){

            if(mysqli_num_rows($select)) return $select;
            return -1;
        }
    }

    public function checkMagazineName($magazineName) {
        if($select =  $this->dbConnection->query("SELECT * FROM ".$this->TABLE_MAGAZINES.
            " WHERE ".$this->MAGAZINE_NAME." = '$magazineName'")){
            return mysqli_num_rows($select) == 1 ? true : false;
        }
        return false;
    }
}