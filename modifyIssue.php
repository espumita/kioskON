<?php

require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\db\DataBaseConnection;
use kioskon\application\ui\View;
use kioskon\application\utils\Check;
use kioskon\application\utils\Redirection;
use kioskon\application\db\DataBaseUpdate;
use kioskon\model\File;

session_start();
if(!Check::session()) (new Redirection())->to("index.php?BadLogin=badLogin");

View::pageHeader('Lista de Entregas Para Modificar');
View::logOut();

$dbConnection = new DataBaseConnection();
if(!$dbConnection->start()) (new Redirection())->to("index.php?BadConnection=notConnection");

View::userCurrentMagazinesListModify($dbConnection -> connection());

View::pageFooter();