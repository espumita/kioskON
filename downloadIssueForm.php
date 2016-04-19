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
if(isset($_POST["botonListaDescargar"])) {
    $id = $_POST['botonListaDescargar'];
    $id = explode(" ", $id);
    $id = $id[1];
    $select = (new DataBaseSelect($dbConnection->connection()))->downloadIssue($id);
    $row = $select->fetch_assoc();
    $name = $row["fileName"];
    $size = $row["fileSize"];
    $content = $row["fileContent"];
    header("Content-length: $size");
    header("Content-type: pdf");
    header("Content-Disposition: attachment; filename=$name");
    echo $content;
}elseif(isset($_POST["botonListaVisualizar"])){
    $id = $_POST['botonListaVisualizar'];
    $id = explode(" ", $id);
    $id = $id[1];
    $select = (new DataBaseSelect($dbConnection->connection()))->downloadIssue($id);
    $row = $select->fetch_assoc();
    $name = $row["fileName"];
    $size = $row["fileSize"];
    $content = $row["fileContent"];

 /*   $file = './path/to/the.pdf';
    $name = 'Custom file name for the.pdf'; /* Note: Always use .pdf at the end. */

    header('Content-type: application/pdf');
    echo $content;
/*    header('Content-Disposition: inline; filename="' . $name . '"');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . size);
    header('Accept-Ranges: bytes');
*/
    @readfile($file);
}