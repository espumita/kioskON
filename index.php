<?php
require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\db\DataBaseConnection;
use kioskon\application\ui\View;
View::pageHeader();
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['id']) ){
    View::logOut();
    View::createMagazineOption();
    $dbConnection = new DataBaseConnection();
    if($dbConnection->start()){
        View::userCurrentMagazinesList($dbConnection->connection());
        $dbConnection->quit();
    }
}else View::loginForm();
View::pageFooter();