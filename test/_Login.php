<?php
include_once(__DIR__ . '/../src/model/User.php');
include_once(__DIR__ . '/../src/model/Login.php');
include_once(__DIR__ . '/../src/application/db/DataBaseConnection.php');
include_once(__DIR__ . '/../src/application/db/DataBaseDelete.php');
include_once(__DIR__ . '/../src/application/db/DataBaseInsert.php');

class _DB extends PHPUnit_Framework_TestCase{

    public function test_get_mysqli_db_connection_and_disconnection(){
        $dbConnection = new DataBaseConnection();
        $this->assertEquals($dbConnection->start(),true);
        $this->assertEquals($dbConnection->quit(),true);
    }

    public function test_get_user_name(){
        $user = new User("userTest",new Password("1234"+time()));
        $this->assertEquals($user->name(),"userTest");
    }

    public function test_get_md5_hashed_password_and_current_time(){
        $time = time();
        $user = new User("userTest",new Password("1234".$time));
        $this->assertEquals($user->hashedPassword(),md5("1234".$time));
    }


    public function test_insert_and_delete_one_user(){
        $dbConnection = new DataBaseConnection();
        $dbConnection->start();
        $time= time();
        $this->assertEquals((new DataBaseInsert($dbConnection->connection()))->inTableUsers(new User("userTest",new Password("1234".$time)),$time),true);
        $this->assertEquals((new DataBaseDelete($dbConnection->connection()))->userWithName("userTest"),true);
        $dbConnection->quit();
    }

    public function test_successful_and_bad_login(){
        $dbConnection = new DataBaseConnection();
        $dbConnection->start();
        $time= time();
        $this->assertEquals((new DataBaseInsert($dbConnection->connection()))->inTableUsers(new User("userTest",new Password("1234".$time)),$time),true);
        $this->assertEquals((new Login($dbConnection,"userTest","1234"))->check(),true);
        $this->assertEquals((new Login($dbConnection,"userTest","12345"))->check(),false);
        $this->assertEquals((new Login($dbConnection,"userTest5","1234"))->check(),false);
        $this->assertEquals((new Login($dbConnection,"",""))->check(),false);
        $this->assertEquals((new DataBaseDelete($dbConnection->connection()))->userWithName("userTest"),true);
        $dbConnection->quit();

    }



}