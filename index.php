<?php

require_once __DIR__.'/vendor/autoload.php';
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
    View::userLoggedNavigationBar();
}else{
    View::userNoLoggedNavigationBar();
}
View::cosas();
View::button();
View::pageFooter();