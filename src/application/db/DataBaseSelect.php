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

    public function userInfo($userName,$userHashedPassword) {
        if($select =  $this->dbConnection->query("SELECT ".$this->USER_ID.",".$this->EMAIL." FROM ".$this->TABLE_USERS.
            " WHERE ".$this->USER_NAME." ='".$userName.
            "' AND ".$this->PASSWORD." ='".$userHashedPassword."'")){

            if(mysqli_num_rows($select)){
                $row = mysqli_fetch_assoc($select);
                return [ 'id' => $row[$this->USER_ID], 'email' => $row[$this->EMAIL] ];
            }
        }
        return -1;
    }

    public function downloadIssue($issueID) {
        if($select =  $this->dbConnection->query("SELECT ".$this->FILE_NAME.",".$this->FILE_SIZE.",".$this->FILE_CONTENT." FROM ".$this->TABLE_ISSUES.
            " WHERE ".$this->ISSUE_ID." ='".$issueID."'")){

            if(mysqli_num_rows($select)) return $select;
            return -1;
        }
    }

    public function purchases($userID) {
        if($select =  $this->dbConnection->query("SELECT ".$this->PURCHASE_ISSUE.",".$this->ISSUE_NUMBER." FROM ".$this->TABLE_PURCHASES.
            " INNER JOIN " . $this->TABLE_ISSUES .
            " ON ".$this->TABLE_PURCHASES.".".$this->PURCHASE_ISSUE."=".$this->TABLE_ISSUES.".".$this->ISSUE_ID.
            " WHERE ".$this->PURCHASE_USER." ='".$userID."'")){

            if(mysqli_num_rows($select)) return $select;
            return -1;
        }
    }

    public function allUserMagazines($id) {
        if( $select = $this->dbConnection->query("SELECT ".$this->MAGAZINE_ID.",".$this->MAGAZINE_NAME.",".$this->PERIODICITY.
            " FROM ".$this->TABLE_MAGAZINES.
            " WHERE ".$this->OWNER."='$id'")){

            if(mysqli_num_rows($select)) return $select;
            return -1;
        }
    }

    public function allUserIssues($id) {
        $string = "SELECT ".$this->ISSUE_NUMBER.",".$this->FILE_NAME.",".$this->ISSUES_FK.",".$this->TABLE_ISSUES.".".$this->ISSUE_ID.",".$this->UNIT_COST.",".$this->TABLE_MAGAZINES.".".$this->MAGAZINE_NAME.
            " FROM ".$this->TABLE_ISSUES.
            " INNER JOIN " . $this->TABLE_MAGAZINES .
            " ON ".$this->TABLE_MAGAZINES.".".$this->MAGAZINE_ID."=".$this->TABLE_ISSUES.".".$this->ISSUES_FK.
            " WHERE ".$this->TABLE_MAGAZINES.".".$this->OWNER."='$id'";
        if( $select = $this->dbConnection->query($string)){

            if(mysqli_num_rows($select)) return $select;
            return -1;
        }
    }
    
    public function searchByPrice($min, $max ) {
        
        $string = "SELECT ".$this->MAGAZINE_NAME.",".$this->PERIODICITY.",".$this->OWNER.",".$this->PUBLICATION_DATE.",".$this->UNIT_COST.
            " FROM ".$this->TABLE_ISSUES.
            " INNER JOIN " . $this->TABLE_MAGAZINES .
            " ON ".$this->TABLE_MAGAZINES.".".$this->MAGAZINE_ID."=".$this->TABLE_ISSUES.".".$this->ISSUES_FK.
            " WHERE ".$this->TABLE_ISSUES.".".$this->UNIT_COST." >= $min AND ".$this->UNIT_COST." <= $max ";
        
        if( $select = $this->dbConnection->query($string)){
            if(mysqli_num_rows($select)) return $select;
            return false;
        }
    }
    
    public function searchByDate( $date ) {
        
        $string = "SELECT ".$this->MAGAZINE_NAME.",".$this->PERIODICITY.",".$this->OWNER.",".$this->PUBLICATION_DATE.",".$this->UNIT_COST.
            " FROM ".$this->TABLE_ISSUES.
            " INNER JOIN " . $this->TABLE_MAGAZINES .
            " ON ".$this->TABLE_MAGAZINES.".".$this->MAGAZINE_ID."=".$this->TABLE_ISSUES.".".$this->ISSUES_FK.
            " WHERE ".$this->TABLE_ISSUES.".".$this->PUBLICATION_DATE." = '$date' ";
       
        
        if( $select = $this->dbConnection->query($string)){
            if(mysqli_num_rows($select)) return $select;
            return false;
        }
    }

    public function checkMagazineName($magazineName) {
        if($select =  $this->dbConnection->query("SELECT * FROM ".$this->TABLE_MAGAZINES.
            " WHERE ".$this->MAGAZINE_NAME." = '$magazineName'")){
            return mysqli_num_rows($select) == 1 ? true : false;
        }
        return false;
    }

    public function checkUserName($userName) {
        if($select =  $this->dbConnection->query("SELECT * FROM ".$this->TABLE_USERS.
            " WHERE ".$this->USER_NAME." = '$userName'")){
            return mysqli_num_rows($select) == 1 ? true : false;
        }
        return false;
    }

    public function checkUserEmail($email) {
        if($select =  $this->dbConnection->query("SELECT * FROM ".$this->TABLE_USERS.
            " WHERE ".$this->EMAIL." = '$email'")){
            return mysqli_num_rows($select) == 1 ? true : false;
        }
        return false;
    }

    public function allMagazines() {
        if( $select = $this->dbConnection->query("SELECT * ".
            " FROM ".$this->TABLE_MAGAZINES)){
            if(mysqli_num_rows($select)) return mysqli_fetch_all($select,1);
            return -1;
        }
    }
}