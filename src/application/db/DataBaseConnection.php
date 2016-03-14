<?php

namespace kioskon\application\db;

class DataBaseConnection {
    private $MYSQL_HOST = 'db4free.net';
    private $MYSQL_USER = 'kioskon';
    private $MYSQL_PASSWORD = 'kioskon';
    private $MYSQL_DB_NAME = 'kioskon';
    private $MYSQL_PORT = '3306';
    private $connection;


    public function start() {
        $this->connection = new \mysqli($this->MYSQL_HOST,$this->MYSQL_USER,$this->MYSQL_PASSWORD,$this->MYSQL_DB_NAME,$this->MYSQL_PORT);
        return $this->connection->connect_error ? false : true;
    }

    public function quit() {
        return $this->connection->close();
    }

    public function connection() {
        return $this->connection;
    }

}