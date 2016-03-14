<?php
if(!isset($_POST['user']) || empty($_POST['user']) || !isset($_POST['pass']) || empty($_POST['pass'])){
    header('Location: index.php?BadLogin=badLogin');
    exit;
}

include_once "model/loginFilter.php";

if(!(new loginFilter($_POST['user']))->check() || !(new loginFilter($_POST['pass']))->check()){
    header('Location: index.php?BadLogin=DataError');
    exit;
}

include_once "application/db/DataBaseConnection.php";
include_once "model/Login.php";

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
