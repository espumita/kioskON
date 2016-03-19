<?php
require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\ui\View;

session_start();
if(!isset($_SESSION['user']) || !isset($_SESSION['id']) ){
    header('Location: index.php?BadLogin=badLogin');
    exit;
}
View::pageHeader();
View::createMagazineForm();
View::pageFooter();