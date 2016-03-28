<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>ELIMINAR REVISTA</title>
    </head>
    <body>
        <div align="center">
        <br>
        <?php
        header("Content-Type: text/html;charset=utf-8");
        if (new mysqli("db4free.net", "kioskon", "kioskon", "kioskon"))
        {
            $conexion = new mysqli("db4free.net", "kioskon", "kioskon", "kioskon");
            $acentos = $conexion->query("SET NAMES 'utf8'");
           
            echo '<FORM METHOD="POST" ACTION="delete.php"><font size=5>Nombre Revista</font><br><p></p>';
            
            //$query = "select magazineName from magazines where owner='$_SESSION' order by magazineName";
            $query = "select magazineName from magazines order by magazineName";
            $result = $conexion -> query($query);
            
            echo '<select name=magazine><p></p>';
            
            while($query_result = $result->fetch_array()) {
                echo '<option>'.$query_result["magazineName"];
            }
            
            $result->free_result();
            
            $conexion->close();
        }else{
            echo "Error de conexión con la base de datos";
        }
        ?>
    </select>
    <br>
    <p></p>
    <INPUT TYPE="SUBMIT" value="Eliminar Revista">
    </FORM>
    </div>
    </body>
</html>
