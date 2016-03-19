<?php
require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\ui\View;
View::pageHeader();
session_start();
if(isset($_SESSION['user']) && isset($_SESSION['id']) ){
    View::logOut();
    View::createMagazineOption();
}else View::loginForm();
View::pageFooter();