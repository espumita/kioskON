<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<?php
session_start();
include_once 'application/ui/View.php';
if(isset($_SESSION['user']) && isset($_SESSION['id']) ) View::logOut();
else View::loginForm();
?>
</body>
</html>