<?php

require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\db\DataBaseConnection;
use kioskon\application\ui\View;
use kioskon\application\utils\Check;
use kioskon\application\utils\Redirection;
use kioskon\application\db\DataBaseSelect;
use kioskon\model\File;

session_start();
if(!Check::session()) (new Redirection())->to("index.php?BadLogin=badLogin");

$dbConnection = new DataBaseConnection();
if(!$dbConnection->start()) (new Redirection())->to("index.php?BadConnection=notConnection");

// if id is set then get the file with the id from database
    $id = $_POST['botonListaDescargar'];
    $id = explode(" ", $id);
    $id = $id[1];
    $select =(new DataBaseSelect($dbConnection->connection()))->downloadIssue($id);
    $row = $select->fetch_assoc();
    $name = $row["fileName"];
    $size = $row["fileSize"];
    $content = $row["fileContent"];
    header("Content-length: $size");
    header("Content-type: pdf");
    header("Content-Disposition: attachment; filename=$name");
    echo $content;
