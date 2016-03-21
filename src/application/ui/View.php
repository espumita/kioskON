<?php

namespace kioskon\application\ui;

use kioskon\application\db\DataBaseSelect;

class View{

    public static function pageHeader($tittle) {
        echo '
<html>
<head>
    <title>'.$tittle.'</title>
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
<p>Loged as: '.$_SESSION['user'].' and user id is:'.$_SESSION['id'].' and email is '.$_SESSION['email'].'</p>
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

    public static function userCurrentMagazinesList($dbConnection) {
        echo '
<h2>Mis revistas</h2>
<table>
   <tr>
       <th>id</th>
       <th>Nombre</th>
       <th>Periodicidad</th>
   </tr>';
        self::deployMagazineTableRows($dbConnection);
        echo '
</table>';
    }

    public static function deployMagazineTableRows($dbConnection){
        if($select = (new DataBaseSelect($dbConnection))->allUserMagazines($_SESSION['id'])){
            if( $select != -1){
                while ($row = $select->fetch_assoc()) self::deploySingleRow($row);
            }
        };
    }

    public static function deploySingleRow($row) {
        echo '
<tr>
    <td>'.$row['_id'].'</td>
    <td>'.$row['magazineName'].'</td>
    <td>'.$row['periodicity'].'</td>
</tr>';
    }

    public static function issuesUploadOption() {
        echo'
<a href="uploadNewIssue.php">Subir nueva entrega de revista</a>
        ';
    }

    public static function issuesUploadForm($dbConnection) {
        echo'
<form method="post" enctype="multipart/form-data" action="checkUploadIssue.php">
    <table>
        <tr>
            <td><input name="userFile" type="file"></td>
        </tr>
    </table>
    <table>
        <tr>
            <td> Revista: </td>
            <td><select name="magazines">';
        self::deployMagazinesOptions($dbConnection);
        echo '
            </select></td>
        </tr>
        <tr>
            <td>Número: </td>
            <td><input name="number" type="text""></td>
        </tr>
        <tr>
            <td>Coste: </td>
            <td><input name="cost" type="text"></td>
        </tr>
        <tr>
            <td><input name="upload" type="submit" value="Subir"></td>
        </tr>
    </table>
</form>';
    }

    private static function deployMagazinesOptions($dbConnection) {
        $select = (new DataBaseSelect($dbConnection))->allUserMagazines($_SESSION['id']);
        while ($row = mysqli_fetch_row($select)) {
            echo '
<option value="'.$row[0].'">'.$row[1].'</option>';
        }
    }

    public static function registerUserOption() {
        echo '
<a href="register.php">Registrarse</a>';
    }

    public static function registerForm(){
        echo '
<form action="checkRegister.php" method="POST">
    <table>
        <tr>
            <td>Usuario</td>
            <td><input type="text" name="userName" required></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" name="email" required></td>
        </tr>
        <tr>
            <td>Contraseña</td>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td>Reescribir contraseña</td>
            <td><input type="password" name="retypePassword" required></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Registrarse" name="register"></td>
        </tr>
    </table>
</form>';
    }
}
