<?php
require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\ui\View;
use kioskon\application\db\DataBaseConnection;
use kioskon\application\utils\Search;

$dbConnection = new DataBaseConnection();
$dbConnection->start();

//if( strpos($_POST['srch-term'], "/dfdf") !== FALSE ){
//    $min = substr( $_POST['srch-term'], 0, strpos($_POST['srch-term'], "-") );
//    $max = substr( $_POST['srch-term'], strpos($_POST['srch-term'], "-")+1, strlen($_POST['srch-term']) );
//    View::search( $dbConnection->connection(), $min, $max );
//}
if (strpos($_POST['srch-term'], "-") !== FALSE) {
    
    View::searchByDate( $dbConnection->connection(), $_POST['srch-term'] );
    
}else{
    $result = (new Search($dbConnection->connection()))->magazineName($_POST['srch-term']);
    View::magazineTable($result);
}

