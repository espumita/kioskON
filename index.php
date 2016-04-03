<?php

require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\ui\View;
use kioskon\application\utils\Check;

View::pageHeader('KioskON');
session_start();
if(Check::session()){
    View::userLoggedNavigationBar();
}else{
    View::userNoLoggedNavigationBar();
}
View::cosas();
View::button();
View::pageFooter();