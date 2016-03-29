<?php

require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\ui\View;
use kioskon\application\utils\Check;
use kioskon\application\utils\Redirection;

session_start();

View::pageHeader('Tarifas');
View::userLoggedNavigationBar();
View::tarifas();
View::carousel();
View::pageFooter();