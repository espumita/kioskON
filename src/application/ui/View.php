<?php

namespace kioskon\application\ui;

class View{

    public static function loginForm(){
        $loginForm = '<form action="login.php" method="post">
        <ul>
            <li>Usuario: <input type="text" name="user"></li>
            <li>Contraseña <input type="password" name="pass"></li>
            <li><input type="submit" value="login"></li>
        </ul>
     </form>';
        echo $loginForm;
    }

    public static function logOut(){
        $logOut = '<p>Loged as: '.$_SESSION['user'].' and user id is:'.$_SESSION['id'].'</p>
        </br>
        <a href="logout.php">Logout</a>';
        echo $logOut;
    }
}
