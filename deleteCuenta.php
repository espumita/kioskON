<html>
    <head>
        <meta charset="UTF-8">
        <title>ELIMINAR CUENTA</title>
    </head>
    <body>

        <?php
        header("Content-Type: text/html;charset=utf-8");
        //if (new mysqli("db4free.net", "kioskon", "kioskon", "kioskon"))
        if (new mysqli("localhost", "jessyka", "", "bdprueba"))
        {
            //$conexion = new mysqli("db4free.net", "kioskon", "kioskon", "kioskon");
            $conexion = new mysqli("localhost", "jessyka", "", "bdprueba");
            $acentos = $conexion->query("SET NAMES 'utf8'");
                       
            //$query = "delete from users where _id='$_SESSION'";
            $query = "delete from users where id='1'";
            $result = $conexion -> query($query);
            
            $conexion->close();
        }else{
            echo "Error de conexi�n con la base de datos";
        }
        ?>
        <h1><div align="center">Cuenta Eliminada</div></h1>
        <div align="center"><a href="/proyectos/index.php">Página principal</a></div>
    </body>
</html>