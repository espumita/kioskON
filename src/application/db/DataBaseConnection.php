<?php
include_once 'DataBaseHelper.php';

class DataBaseConnection {
    private $connection;


    public function start() {
        $this->connection = new mysqli(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DBNAME,MYSQL_PORT);
        return $this->connection->connect_error ? false : true;
    }

    public function quit() {
        return $this->connection->close();
    }

    public function connection() {
        return $this->connection;
    }

}