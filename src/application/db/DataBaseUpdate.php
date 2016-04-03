<?php
namespace kioskon\application\db;

use kioskon\model\User;

class DataBaseUpdate extends DataBaseHelper
{

    private $dbConnection;

    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function modifyValues($id, $file, $number, $cost, $name, $size) {
        $set = "";
        if($file != ""){
            $set = $set . $this->FILE_CONTENT."=\"".$file."\", ";
            $set = $set . $this->FILE_NAME."=\"".$name."\", ";
            $set = $set . $this->FILE_SIZE."=".$size." ";
        }
        if($number != ""){
            if($set != "") $set = $set . ", ";
            $set = $set . $this->ISSUE_NUMBER."=".$number." ";
        }
        if($cost != "") {
            if ($set != "") $set = $set . ", ";
            $set = $set . $this->UNIT_COST . "=" . $cost . " ";
        }
        if($set == "") return 0;
        $string = "UPDATE ".$this->TABLE_ISSUES." SET ".$set." WHERE ".$this->ISSUE_ID."=$id";
        $select =  $this->dbConnection->query($string);
        if(!$select) echo $this->dbConnection -> error;
        return $select;
    }

    public function inTableUsers(User $newUser, $time) {
        return $this->dbConnection->query("UPDATE ".$this->TABLE_USERS." SET ".
            $this->USER_NAME."='".$newUser->name()."', ".
            $this->PASSWORD."='".$newUser->hashedPassword()."', ".
            $this->CREATION_TIME."='".$time."', ".
            $this->EMAIL."='".$newUser->email()."'".
            " WHERE ".$this->USER_ID."='".$_SESSION['id']."'");
    }

}