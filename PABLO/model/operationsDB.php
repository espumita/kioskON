<?php

class operationsDB {
    
    private $connection;

    public function __construct() {
        include "connection.php";
        $this->connection = new connection();
        $this->connection->start();
    }
    
    function __destruct() {
       $this->connection->quit();
   }

    public function insert( $data ) {
        
        if( $data['table'] == 'users' ){
            if( $data = $this->connection->connect()->query( " INSERT INTO ".$data['table']." (userName,password,type,email) VALUES ('".$data['username']."','".$data['password']."','".$data['type']."','".$data['email']."') " ) ){
                return true;
            }
        }
        
        return false;
        
    }
    
    public function update( $data ) {
        
        if( $data['table'] == 'users' ){
            if( $data = $this->connection->connect()->query( " UPDATE users SET userName='".$data['username']."',password='".$data['password']."',email='".$data['email']."' WHERE _id = '".$data['_id']."' " ) ){
                return true;
            }
        }
        return false;
        
    }
    
    public function get( array $data ) {
        
        if( $data['table'] == 'users' ){
            if( $data = $this->connection->connect()->query( " SELECT * FROM ".$data['table']." WHERE _id = '".$data['user_id']."' " ) ){
                return mysqli_fetch_assoc($data);
            }
        }
        
        return false;
        
    }
    
    public function exist( array $data ) {
        
        $where = array_keys($data);
        $where = array_pop($where);
        
        if( $data = $this->connection->connect()->query( " SELECT * FROM users WHERE ".$where." = '".$data[$where]."' " ) ){
            return $data->num_rows;
        }
        
    }

}