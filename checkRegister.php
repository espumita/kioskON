<?php

require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\db\DataBaseConnection;
use kioskon\application\db\DataBaseInsert;
use kioskon\application\db\DataBaseSelect;
use kioskon\application\utils\Check;
use kioskon\application\utils\Redirection;
use kioskon\model\Password;
use kioskon\model\RegisterFilter;
use kioskon\model\User;

session_start();
if(Check::session()) (new Redirection())->to("index.php?BadLogin=badLogin");

if(!Check::post('userName') || !Check::post('email') || !Check::post('password') || !Check::post('retypePassword'))(new Redirection())->to("index.php?BadForm=badForm");

if(!(new RegisterFilter($_POST['userName']))->check() || !(new RegisterFilter($_POST['password']))->check() || !(new RegisterFilter($_POST['email']))->checkEmail()){
    (new Redirection())->to("index.php?BadRegister=DataError");
}
if(!Check::ifPasswordsAreEquals()) (new Redirection())->to("index.php?BadForm=wrongPasswords");

$dbConnection = new DataBaseConnection();
if(!$dbConnection->start()) (new Redirection())->to("index.php?BadConnection=notConnection");

if((new DataBaseSelect($dbConnection->connection()))->checkUserName($_POST['userName'])){
    (new Redirection())->to("index.php?BadForm=nameAlreadyExists");
}

if((new DataBaseSelect($dbConnection->connection()))->checkUserEmail($_POST['email'])){
    (new Redirection())->to("index.php?BadForm=emailAlreadyExists");
}

$userCreationTime = time();
if((new DataBaseInsert($dbConnection->connection()))->inTableUsers(new User($_POST['userName'],$_POST['email'],new Password($_POST['password'].$userCreationTime)),$userCreationTime)) {
    (new Redirection())->to("index.php?UserCreation=OK");
}

$dbConnection->quit();
(new Redirection())->to("index.php?BadRegister=wrongFormInfo");