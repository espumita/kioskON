<?php

class connection {
    private $MYSQL_HOST = 'localhost';
    private $MYSQL_USER = 'root';
    private $MYSQL_PASSWORD = '';
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

    public function connect() {
        return $this->connection;
    }

}

