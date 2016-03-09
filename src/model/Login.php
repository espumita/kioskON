<?php

include_once '/../src/application/db/DataBaseSelect.php';
include_once '/../src/model/User.php';
include_once '/../src/model/Password.php';

class Login {

    private $userName;
    private $password;
    private $dbConnection;

    public function __construct(DataBaseConnection $dbConnection, $userName, $password) {
        $this->userName = $userName;
        $this->password = $password;
        $this->dbConnection = $dbConnection;
    }

    public function check() {
        if(!$userCreationTime = $this->getUserCreationTimeIfExists()) return false;
        return $this->checkIfPasswordIsCorrect($userCreationTime);
    }

    public function getUserCreationTimeIfExists() {
        return (new DataBaseSelect($this->dbConnection->connection()))->userCreationTime($this->userName);
    }

    public function checkIfPasswordIsCorrect($userCreationTime) {
        return (new DataBaseSelect($this->dbConnection->connection()))->numOfRowsWhen(new User($this->userName, new Password($this->password . $userCreationTime)));
    }
}