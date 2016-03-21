<?php
namespace kioskon\model;

use kioskon\application\db\DataBaseConnection;
use kioskon\application\db\DataBaseSelect;

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
        $this->userId =  (new DataBaseSelect($this->dbConnection->connection()))->userInfo($this->userName,(new Password($this->password.$userCreationTime))->md5Hash());
        return $this->userId  > 0;
    }

    public function userInfo() {
        return $this->userId;
    }
}