<?php

require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\db\DataBaseConnection;
use kioskon\model\Login;
use kioskon\model\LoginFilter;

if(!isset($_POST['user']) || empty($_POST['user']) || !isset($_POST['pass']) || empty($_POST['pass'])){
    header('Location: index.php?BadLogin=badLogin');
    exit;
}

if(!(new LoginFilter($_POST['user']))->check() || !(new LoginFilter($_POST['pass']))->check()){
    header('Location: index.php?BadLogin=DataError');
    exit;
}

$dbConnection = new DataBaseConnection();
if(!$dbConnection->start()) {
    header('Location: index.php?BadLogin=notConnection');
    exit;
}
$login = new Login($dbConnection,$_POST['user'],$_POST['pass']);
if($login->check()){
    session_start();
    $_SESSION['user'] = $_POST['user'];
    $_SESSION['id'] = $login->userId();
    header('Location: index.php?Login=OK');
    exit;
}
else header('Location: index.php?BadLogin=wrongInfo');
exit;
