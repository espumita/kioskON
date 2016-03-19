<?php

namespace kioskon\application\ui;

class View{

    public static function pageHeader() {
        echo '
<html>
<head>
    <meta charset="utf-8">
</head>
<body>';
    }

    public static function pageFooter() {
        echo '
</body>
</html>';
    }

    public static function loginForm(){
        echo '
<form action="login.php" method="post">
    <ul>
        <li>Usuario: <input type="text" name="user"></li>
        <li>Contraseña <input type="password" name="pass"></li>
        <li><input type="submit" value="login"></li>
    </ul>
</form>';
    }

    public static function logOut(){
        echo '
<p>Loged as: '.$_SESSION['user'].' and user id is:'.$_SESSION['id'].'</p>
</br>
<a href="logout.php">Logout</a>
</br>
</br>';
    }

    public static function createMagazineOption() {
        echo '
<a href="createNewMagazine.php">Crear nueva revista</a>';
    }

    public static function createMagazineForm() {
        echo '
<form action="checkCreateNewMagazine.php" method="post">
    <ul>
        <li>Nombre de la revista: <input type="text" name="magazine"></li>
        <li>Número de entregas anuales: <input type="text" name="periodicity"></li>
        <li><input type="submit" value="Crear"></li>
    </ul>
</form>';
    }
}
