<?php

use kioskon\application\db\DataBaseConnection;
use kioskon\application\db\DataBaseDelete;
use kioskon\application\db\DataBaseInsert;
use kioskon\model\Login;
use kioskon\model\Magazine;
use kioskon\model\Password;
use kioskon\model\User;

require_once __DIR__.'/../vendor/autoload.php';

class _CreateMagazine extends PHPUnit_Framework_TestCase{
    protected static $dbConnection;
    protected static $userId;
    public static function setUpBeforeClass(){
        self::$dbConnection = new DataBaseConnection();
        self::$dbConnection->start();
        $time= time();
        (new DataBaseInsert( self::$dbConnection->connection()))->inTableUsers(new User("userTest",new Password("1234".$time)),$time);
        $login= (new Login(self::$dbConnection,"userTest","1234"));
        $login->check();
        self::$userId = $login->userId();

    }

    public static function tearDownAfterClass(){
        (new DataBaseDelete(self::$dbConnection->connection()))->userWithName("userTest");
        self::$dbConnection->quit();
    }

    public function test_when_we_crete_one_single_magazine(){
        $magazine = new Magazine("magazineTest",self::$userId,12);
        $this->assertEquals($magazine->magazineName(),"magazineTest");
        $this->assertEquals($magazine->owner(),self::$userId);
        $this->assertEquals($magazine->periodicity(),12);
    }

    public function test_when_we_insert_and_delete_one_magazine() {
        $this->assertTrue((new DataBaseInsert(self::$dbConnection->connection()))->inTableMagazines(new Magazine("magazineTest",self::$userId,12)));
        $this->assertTrue((new DataBaseDelete(self::$dbConnection->connection()))->magazineWithName("magazineTest"));
    }


}