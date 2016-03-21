<?php

require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\utils\Check;
use kioskon\application\utils\Redirection;

session_start();
if(!Check::session())(new Redirection())->to("index.php?Logout=BadLogOut");

unset($_SESSION['user']);
unset($_SESSION['id']);
unset($_SESSION['email']);
session_destroy();

(new Redirection())->to("index.php?Logout=OK");