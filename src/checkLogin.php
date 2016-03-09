<?php
if(!isset($_POST['user']) || empty($_POST['user']) ||
    !isset($_POST['pass']) || empty($_POST['pass'])) header('Location: index.php?BadLogin=badLogin');

include_once "application/db/DataBaseConnection.php";
include_once "model/Login.php";

$dbConnection = new DataBaseConnection();
if(!$dbConnection->start()) header('Location: index.php?BadLogin=notConnection');
if((new Login($dbConnection,$_POST['user'],$_POST['pass']))->check()) echo "Logged as: ".$_POST['user'];
else header('Location: index.php?BadLogin=wrongInfo');
