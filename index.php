<?php

require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\db\DataBaseConnection;
use kioskon\application\ui\View;
use kioskon\application\utils\Check;

View::pageHeader('KioskON');
session_start();
if(Check::session()){
    View::logOut();
    View::createMagazineOption();
    $dbConnection = new DataBaseConnection();
    if($dbConnection->start()){
        View::userCurrentMagazinesList($dbConnection->connection());
        $dbConnection->quit();
    }
    View::issuesUploadOption();
    View::issuesModifyOption();

}else{
    View::loginForm();
    View::registerUserOption();
}
View::pageFooter();