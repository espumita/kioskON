<?php
require_once __DIR__.'/../vendor/autoload.php';
use kioskon\model\User;
use kioskon\model\Login;
use kioskon\model\Password;
use kioskon\model\LoginFilter;
use kioskon\application\db\DataBaseConnection;
use kioskon\application\db\DataBaseDelete;
use kioskon\application\db\DataBaseInsert;

class _Login extends PHPUnit_Framework_TestCase{

    public function test_get_mysqli_db_connection_and_disconnection(){
        $dbConnection = new DataBaseConnection();
        $this->assertTrue($dbConnection->start());
        $this->assertTrue($dbConnection->quit());
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
        $this->assertTrue((new DataBaseInsert($dbConnection->connection()))->inTableUsers(new User("userTest",new Password("1234".$time)),$time));
        $this->assertTrue((new DataBaseDelete($dbConnection->connection()))->userWithName("userTest"));
        $dbConnection->quit();
    }

    public function test_when_we_try_to_insert_an_existing_user(){
        $dbConnection = new DataBaseConnection();
        $dbConnection->start();
        $time= time();
        $this->assertTrue((new DataBaseInsert($dbConnection->connection()))->inTableUsers(new User("userTest",new Password("1234".$time)),$time));
        $this->assertFalse((new DataBaseInsert($dbConnection->connection()))->inTableUsers(new User("userTest",new Password("1234".$time)),$time));
        $this->assertTrue((new DataBaseDelete($dbConnection->connection()))->userWithName("userTest"));
        $this->assertFalse((new DataBaseDelete($dbConnection->connection()))->userWithName("userTest"));
        $dbConnection->quit();
    }

    public function test_successful_and_bad_login(){
        $dbConnection = new DataBaseConnection();
        $dbConnection->start();
        $time= time();
        $this->assertTrue((new DataBaseInsert($dbConnection->connection()))->inTableUsers(new User("userTest",new Password("1234".$time)),$time));
        $this->assertTrue((new Login($dbConnection,"userTest","1234"))->check());
        $this->assertFalse((new Login($dbConnection,"userTest","12345"))->check());
        $this->assertFalse((new Login($dbConnection,"userTest5","1234"))->check());
        $this->assertFalse((new Login($dbConnection,"",""))->check());
        $this->assertTrue((new DataBaseDelete($dbConnection->connection()))->userWithName("userTest"));
        $dbConnection->quit();

    }

    public function test_user_and_password_login_filters(){
        $this->assertFalse((new LoginFilter("asdfghjklasdfghj"))->check());
        $this->assertTrue((new LoginFilter("asdfghjklasdfgh"))->check());
        $this->assertFalse((new LoginFilter("asdf"))->check());
        $this->assertTrue((new LoginFilter("asdfg"))->check());
        $this->assertFalse((new LoginFilter(""))->check());
        $this->assertTrue((new LoginFilter("123123"))->check());
        $this->assertTrue((new LoginFilter("pepe33"))->check());
        $this->assertFalse((new LoginFilter("            "))->check());
        $this->assertFalse((new LoginFilter("; Select * from users;"))->check());
        $this->assertFalse((new LoginFilter("; xcvý5♣ 5♠56"))->check());
        $this->assertFalse((new LoginFilter("aa aa"))->check());
        $this->assertFalse((new LoginFilter("aaaa "))->check());
        $this->assertFalse((new LoginFilter("ñññññ"))->check());
        $this->assertTrue((new LoginFilter("óooóó"))->check());
        $this->assertFalse((new LoginFilter("_%%^_a12"))->check());
        $this->assertFalse((new LoginFilter("한국어/조어"))->check());
        $this->assertFalse((new LoginFilter("РУССКИЙ ТЕСТ"))->check());
        $this->assertFalse((new LoginFilter("النص العربي"))->check());
        $this->assertFalse((new LoginFilter("سسسسسسس"))->check());
    }

}