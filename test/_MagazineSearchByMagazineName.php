<?php

use kioskon\application\db\DataBaseConnection;
use kioskon\application\db\DataBaseDelete;
use kioskon\application\db\DataBaseInsert;
use kioskon\application\db\DataBaseSelect;
use kioskon\application\utils\Search;
use kioskon\model\Login;
use kioskon\model\Magazine;
use kioskon\model\Password;
use kioskon\model\User;

require_once __DIR__.'/../vendor/autoload.php';

class _MagazineSearchByMagazineName extends PHPUnit_Framework_TestCase{
    protected static $dbConnection;
    protected static $userId;
    public static function setUpBeforeClass(){
        self::$dbConnection = new DataBaseConnection();
        self::$dbConnection->start();
        (new DataBaseInsert( self::$dbConnection->connection()))->inTableMagazines(new Magazine("magazineTest1",1,12));
        (new DataBaseInsert( self::$dbConnection->connection()))->inTableMagazines(new Magazine("magazineTest2",1,12));
        (new DataBaseInsert( self::$dbConnection->connection()))->inTableMagazines(new Magazine("magazineTest3",1,12));
    }

    public static function tearDownAfterClass(){
        (new DataBaseDelete(self::$dbConnection->connection()))->magazineWithName("magazineTest1");
        (new DataBaseDelete(self::$dbConnection->connection()))->magazineWithName("magazineTest2");
        (new DataBaseDelete(self::$dbConnection->connection()))->magazineWithName("magazineTest3");
        self::$dbConnection->quit();
    }


    public function test_when_we_search_a_single_magazine(){
        $this->assertEquals((new Search(self::$dbConnection->connection()))->magazineName("magazineTest1"),"magazineTest1");
    }

}