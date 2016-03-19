<?php

require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\db\DataBaseConnection;
use kioskon\application\db\DataBaseInsert;
use kioskon\model\Magazine;
use kioskon\model\MagazineFilter;

session_start();
if(!isset($_SESSION['user']) || !isset($_SESSION['id']) ){
    header('Location: index.php?BadLogin=badLogin');
    exit;
}

if(!isset($_POST['magazine']) || empty($_POST['magazine']) || !isset($_POST['periodicity']) || empty($_POST['periodicity'])){
    header('Location: index.php?BadForm=badForm');
    exit;
}

if(!(new MagazineFilter($_POST['magazine']))->checkName() || !(new MagazineFilter($_POST['periodicity']))->checkPeriodicity()){
    header('Location: index.php?BadForm=DataError');
    exit;
}


$dbConnection = new DataBaseConnection();
if(!$dbConnection->start()) {
    header('Location: index.php?BadConnection=notConnection');
    exit;
}

//check name existence


if((new DataBaseInsert($dbConnection->connection()))->inTableMagazines(new Magazine($_POST['magazine'],$_SESSION['id'],$_POST['periodicity']))){
    header('Location: index.php?GoodMagazineCreation=OK');
    exit;
}
header('Location: index.php?BadCreation=wrongFromInfo');
exit;
