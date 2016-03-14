<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<?php

require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\ui\View;

session_start();
if(isset($_SESSION['user']) && isset($_SESSION['id']) ) View::logOut();
else View::loginForm();
?>
</body>
</html>