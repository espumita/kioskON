<?php
require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\ui\View;
use kioskon\application\db\DataBaseConnection;

if( strpos($_POST['srch-term'], "-") !== FALSE ){
    $min = substr( $_POST['srch-term'], 0, strpos($_POST['srch-term'], "-") );
    $max = substr( $_POST['srch-term'], strpos($_POST['srch-term'], "-")+1, strlen($_POST['srch-term']) );
}else{
    $min = $_POST['srch-term'];
    $max = NULL;
}

$dbConnection = new DataBaseConnection();
$dbConnection->start();
View::search( $dbConnection->connection(), $min, $max );
