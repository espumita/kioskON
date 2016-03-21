<?php

require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\db\DataBaseConnection;
use kioskon\application\ui\View;
use kioskon\application\utils\Check;
use kioskon\application\utils\Redirection;

session_start();
if(!Check::session()) (new Redirection())->to("index.php?BadLogin=badLogin");

View::pageHeader('Subir nueva entrega');

$dbConnection = new DataBaseConnection();
if(!$dbConnection->start()) (new Redirection())->to("index.php?BadConnection=notConnection");

View::issuesUploadForm($dbConnection->connection());
View::pageFooter();
