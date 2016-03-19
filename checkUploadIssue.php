<?php

require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\utils\Check;

session_start();
if(!Check::session()) (new Redirection())->to("index.php?BadLogin=badLogin");

if(!Check::post('number') || !Check::post('cost'))(new Redirection())->to("index.php?BadForm=badForm");

//checkbox post...

if(!Check::files('userFile','size'))(new Redirection())->to("index.php?BadFile=NoFile");

//Filters...

$dbConnection = new DataBaseConnection();
if(!$dbConnection->start()) (new Redirection())->to("index.php?BadConnection=notConnection");

//upload...
define('MB', 1048576);
$maxSize = 1 * MB;
if (isset($_POST['upload']) && ($size = $_FILES['userfile']['size']) > 0) {
    $allowedExtensions = array('pdf');
    $fileName = $_FILES['userfile']['name'];
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    if (!in_array($ext, $allowedExtensions)) {
        echo "Error: la extensión .$ext no está permitida, suba archvios tipo ";
        $string = implode(", ", $allowedExtensions);
        echo $string . ".";
        exit();
    }
    if ($size > $maxSize) {
        echo "Fichero demasiado grande, tamaño máximo de " . $maxSize / 1048576 . "MB";
        exit();
    }

    $tmpName = $_FILES['userfile']['tmp_name'];
    $fileSize = $_FILES['userfile']['size'];
    $fileType = $_FILES['userfile']['type'];
    $magazinesId = $_POST['magazines'];
    $issueNumber = $_POST["number"];
    $unitCost = $_POST["cost"];
    $publicationDate = date("Y-m-d H:i:s");

    $fp = fopen($tmpName, 'r');
    $fileContent = fread($fp, filesize($tmpName));
    $fileContent = addslashes($fileContent);
    fclose($fp);

    if (!get_magic_quotes_gpc()) {
        $fileName = addslashes($fileName);
    }

    $query = "INSERT INTO issues (fileName, magazinesId, issueNumber, fileSize, publicationDate, fileContent, unitCost ) " .
        "VALUES ('$fileName', $magazinesId, $issueNumber, $fileSize, '$publicationDate', '$fileContent', $unitCost)";

    $resultado = mysqli_query($connection, $query) or die("ERROR");

    echo "<br>Archivo $fileName subido correctamente<br>";

}