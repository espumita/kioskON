<?php
require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\ui\View;
use kioskon\application\db\DataBaseConnection;
use kioskon\application\utils\Search;

$dbConnection = new DataBaseConnection();
$dbConnection->start();

if( $pos = strpos($_POST['srch-term'], "-") !== FALSE ){
    
    if( strpos($_POST['srch-term'], "-", $pos+1) !== FALSE ){
        View::searchByDate( $dbConnection->connection(), $_POST['srch-term'] );
    }else{
        $min = substr( $_POST['srch-term'], 0, strpos($_POST['srch-term'], "-") );
        $max = substr( $_POST['srch-term'], strpos($_POST['srch-term'], "-")+1, strlen($_POST['srch-term']) );
        View::search( $dbConnection->connection(), $min, $max );
    } 
    
}else{
    $result = (new Search($dbConnection->connection()))->magazineName($_POST['srch-term']);
    if($result == "Not Found"){
        $result2 = (new Search($dbConnection->connection()))->userName($_POST['srch-term']);
        View::magazinesFromUserTable($result2);
    }else{
        View::magazineTable($result);
    }
}

