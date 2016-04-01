<?php

require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\db\DataBaseConnection;
use kioskon\application\utils\Check;
use kioskon\application\utils\Redirection;
use kioskon\model\Login;
use kioskon\model\LoginFilter;

session_start();
if(Check::session())(new Redirection())->to("index.php?BadLogin=LoginOn");

if(!Check::post('user') || !Check::post('pass'))(new Redirection())->to("index.php?BadLogin=badLogin");

if(!(new LoginFilter($_POST['user']))->check() || !(new LoginFilter($_POST['pass']))->check()){
    (new Redirection())->to("index.php?BadLogin=DataError");
}

$dbConnection = new DataBaseConnection();
if(!$dbConnection->start()) (new Redirection())->to("index.php?notConnection");

$login = new Login($dbConnection,$_POST['user'],$_POST['pass']);
if($login->check()){
    $_SESSION['user'] = $_POST['user'];
    $userInfo = $login->userInfo();
    $_SESSION['id'] = $userInfo['id'];
    $_SESSION['email'] = $userInfo['email'];
    (new Redirection())->to("index.php?Login=OK");
}

(new Redirection())->to("index.php?BadLogin=wrongInfo");

