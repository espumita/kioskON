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
    
    public function searchByPrice($min, $max) {
        // AQUI HACER MI CONSULTA PARA BUSCAR POR UN RANGO DE PRECIOS
        // LA VISTA QUE CONTIENE EL BUSCAR SE LLAMA userLoggedNavigationBar EN EL FICHERO view.php
        // CREAR UNA VISTA DONDE SE MUESTREN LOS RESULTADOS
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
}