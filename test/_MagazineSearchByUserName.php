<?php

use kioskon\application\db\DataBaseConnection;
use kioskon\application\db\DataBaseDelete;
use kioskon\application\db\DataBaseInsert;
use kioskon\application\utils\Search;
use kioskon\model\Login;
use kioskon\model\Magazine;
use kioskon\model\Password;
use kioskon\model\User;

require_once __DIR__.'/../vendor/autoload.php';

class _MagazineSearchByUserName extends PHPUnit_Framework_TestCase{
    protected static $dbConnection;
    protected static $userId;
    public static function setUpBeforeClass(){
        self::$dbConnection = new DataBaseConnection();
        self::$dbConnection->start();
        $time= time();
        (new DataBaseInsert( self::$dbConnection->connection()))->inTableUsers(new User("userTest","userTest@domain.test",new Password("1234".$time)),$time);
        $login= (new Login(self::$dbConnection,"userTest","1234"));
        $login->check();
        self::$userId = $login->userInfo()['id'];
        (new DataBaseInsert( self::$dbConnection->connection()))->inTableMagazines(new Magazine("magazineTest1",((int)self::$userId),12));
        (new DataBaseInsert( self::$dbConnection->connection()))->inTableMagazines(new Magazine("magazineTest2",((int)self::$userId),12));
        (new DataBaseInsert( self::$dbConnection->connection()))->inTableMagazines(new Magazine("magazineTest3",((int)self::$userId),12));
    }

    public static function tearDownAfterClass(){
        (new DataBaseDelete(self::$dbConnection->connection()))->userWithName("userTest");
        (new DataBaseDelete(self::$dbConnection->connection()))->magazineWithName("magazineTest1");
        (new DataBaseDelete(self::$dbConnection->connection()))->magazineWithName("magazineTest2");
        (new DataBaseDelete(self::$dbConnection->connection()))->magazineWithName("magazineTest3");
        self::$dbConnection->quit();
    }


    public function test_when_we_search_the_magazines_by_user(){
        $this->assertEquals((new Search(self::$dbConnection->connection()))->userName("userTest")[0],"magazineTest1");
        $this->assertEquals((new Search(self::$dbConnection->connection()))->userName("userTest")[1],"magazineTest2");
        $this->assertEquals((new Search(self::$dbConnection->connection()))->userName("userTest")[2],"magazineTest3");
    }

}