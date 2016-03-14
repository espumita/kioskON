<?php

require_once __DIR__.'/../vendor/autoload.php';
use kioskon\application\db\DataBaseConnection;

class _ModifyProfile extends PHPUnit_Framework_TestCase{

    public function test_change_user_name(){
        $dbConnection = new DataBaseConnection();
        $dbConnection->start();
        $this->assertEquals(false,true);
        $dbConnection->quit();
    }
}