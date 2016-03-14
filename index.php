<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<?php

require_once __DIR__.'/vendor/autoload.php';

session_start();
if(isset($_SESSION['user']) && isset($_SESSION['id']) ) \kioskon\application\ui\View::logOut();
else \kioskon\application\ui\View::loginForm();
?>
</body>
</html>