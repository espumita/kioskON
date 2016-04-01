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

View::pageHeader('Modificar entrega');
View::logOut();

$dbConnection = new DataBaseConnection();
if(!$dbConnection->start()) (new Redirection())->to("index.php?BadConnection=notConnection");


if(isset($_POST["botonListaModificar"])){
    $id = getID();
    View::modifyIssueForm($id);
}

if(isset($_POST["upload"])){
    list($file, $size, $name) = getFile();
    $result = (new DataBaseUpdate($dbConnection->connection()))->modifyValues($_POST["id"], $file, $_POST["number"], $_POST["cost"], $name, $size);
    if($result) (new Redirection())->to("modifyIssue.php?IssueModify=OK");
    (new Redirection())->to("modifyIssue.php?IssueModify=ERROR");
}

function getFile(){
    if (!Check::files("userFile")) {
        $file = "";
        $size = "";
        $name = "";
        return array($file, $size, $name);
    } else {
        $file = (new File("userFile"))->content();
        $name = $_FILES['userFile']['name'];
        $size = $_FILES['userFile']['size'];
        return array($file, $size, $name);
    }
}

function getID(){
    $id = $_POST['botonListaModificar'];
    $id = explode(" ", $id);
    $id = $id[1];
    return $id;
}
