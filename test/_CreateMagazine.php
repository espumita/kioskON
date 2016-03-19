<?php

use kioskon\application\db\DataBaseConnection;
use kioskon\application\db\DataBaseDelete;
use kioskon\application\db\DataBaseInsert;
use kioskon\application\db\DataBaseSelect;
use kioskon\model\Login;
use kioskon\model\Magazine;
use kioskon\model\MagazineFilter;
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

    public function test_when_we_try_insert_an_existing_magazine() {
        $this->assertTrue((new DataBaseInsert(self::$dbConnection->connection()))->inTableMagazines(new Magazine("magazineTest",self::$userId,12)));
        $this->assertFalse((new DataBaseInsert(self::$dbConnection->connection()))->inTableMagazines(new Magazine("magazineTest",self::$userId,12)));
        $this->assertTrue((new DataBaseDelete(self::$dbConnection->connection()))->magazineWithName("magazineTest"));
        $this->assertFalse((new DataBaseDelete(self::$dbConnection->connection()))->magazineWithName("magazineTest"));

    }

    public function test_when_we_check_Magazine_Name_and_periodicity_Filter() {
        $this->assertTrue((new MagazineFilter("Natura"))->checkName());
        $this->assertFalse((new MagazineFilter("a"))->checkName());
        $this->assertFalse((new MagazineFilter("asdfghjklasdfghjklasdfghjklasdfghjklasdfghjklasdfghjklasdfghjklasdfghjkl"))->checkName());
        $this->assertTrue((new MagazineFilter("El Periódico de Catalunya (Castellano)"))->checkName());
        $this->assertTrue((new MagazineFilter("23"))->checkPeriodicity());
        $this->assertFalse((new MagazineFilter("abcde"))->checkPeriodicity());
        $this->assertFalse((new MagazineFilter("@/Á"))->checkPeriodicity());
    }

    public function test_when_we_check_if_magazine_name_already_exists(){
        $this->assertTrue((new DataBaseInsert(self::$dbConnection->connection()))->inTableMagazines(new Magazine("magazineTest",self::$userId,12)));
        $this->assertTrue((new DataBaseSelect(self::$dbConnection->connection()))->magazineName("magazineTest"));
        $this->assertTrue((new DataBaseDelete(self::$dbConnection->connection()))->magazineWithName("magazineTest"));
        $this->assertFalse((new DataBaseSelect(self::$dbConnection->connection()))->magazineName("magazineTest"));
    }

}