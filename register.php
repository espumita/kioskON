<?php

require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\ui\View;
use kioskon\application\utils\Check;
use kioskon\application\utils\Redirection;

session_start();
if(Check::session()) (new Redirection())->to("index.php?BadLogin=badLogin");

View::pageHeader('Registrarse');
View::userNoLoggedNavigationBar();
View::registerForm();
View::carousel();
View::pageFooter();
