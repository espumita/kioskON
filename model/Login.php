<?php

include_once '/../application/db/DataBaseSelect.php';
include_once '/../model/User.php';
include_once '/../model/Password.php';

class Login {

    private $userName;
    private $password;
    private $dbConnection;
    private $userId;

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
        $this->userId =  (new DataBaseSelect($this->dbConnection->connection()))->getUserId(new User($this->userName, new Password($this->password . $userCreationTime)));
        return $this->userId  > 0;
    }

    public function userId() {
        return $this->userId;
    }
}