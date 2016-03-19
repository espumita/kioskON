<?php

require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\db\DataBaseConnection;
use kioskon\application\db\DataBaseInsert;
use kioskon\application\db\DataBaseSelect;
use kioskon\application\utils\Check;
use kioskon\application\utils\Redirection;
use kioskon\model\Magazine;
use kioskon\model\MagazineFilter;

session_start();
if(!Check::session()) (new Redirection())->to("index.php?BadLogin=badLogin");

if(!Check::post('magazine') || !Check::post('periodicity'))(new Redirection())->to("index.php?BadForm=badForm");

if(!(new MagazineFilter($_POST['magazine']))->checkName() || !(new MagazineFilter($_POST['periodicity']))->checkPeriodicity()){
    (new Redirection())->to("index.php?BadForm=DataError");
}

$dbConnection = new DataBaseConnection();
if(!$dbConnection->start()) (new Redirection())->to("index.php?BadConnection=notConnection");

if((new DataBaseSelect($dbConnection->connection()))->checkMagazineName($_POST['magazine'])){
    (new Redirection())->to("index.php?BadForm=DataError");
}

if((new DataBaseInsert($dbConnection->connection()))->inTableMagazines(new Magazine($_POST['magazine'],$_SESSION['id'],$_POST['periodicity']))){
    (new Redirection())->to("index.php?GoodMagazineCreation=OK");
}

(new Redirection())->to("index.php?BadCreation=wrongFromInfo");
