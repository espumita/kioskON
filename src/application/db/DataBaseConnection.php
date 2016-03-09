<?php

class DataBaseConnection {
    private $host = "db4free.net";
    private $user = "kioskon";
    private $pass = "kioskon";
    private $dbName = "kioskon";
    private $port = "3306";
    private $connection;


    public function start() {
        $this->connection = new mysqli($this->host,$this->user,$this->pass,$this->dbName,$this->port);
        return $this->connection->connect_error ? false : true;
    }

    public function quit() {
        return $this->connection->close();
    }

    public function connection() {
        return $this->connection;
    }

}