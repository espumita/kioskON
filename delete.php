<html>
    <head>
        <meta charset="UTF-8">
        <title>ELIMINAR REVISTA</title>
    </head>
    <body>

        <?php
        header("Content-Type: text/html;charset=utf-8");
        if (new mysqli("db4free.net", "kioskon", "kioskon", "kioskon"))
        {
            $conexion = new mysqli("db4free.net", "kioskon", "kioskon", "kioskon");
            $acentos = $conexion->query("SET NAMES 'utf8'");
            
            $nombre = $_POST['magazine'];
           
            $query = "delete from magazines where magazineName='$nombre'";
            $result = $conexion -> query($query);
            
            $conexion->close();
        }else{
            echo "Error de conexión con la base de datos";
        }
        ?>
    </select>
        <h1><div align="center">Revista Eliminada</div></h1>
        <div align="center"><a href="/proyectos/Tarifas/index.php">Visualizar el listado de revistas</a></div>
    </body>
</html>
