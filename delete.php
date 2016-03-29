<?php

require_once __DIR__.'/vendor/autoload.php';
use kioskon\application\utils\Redirection;


if (new mysqli("db4free.net", "kioskon", "kioskon", "kioskon")){
    $conexion = new mysqli("db4free.net", "kioskon", "kioskon", "kioskon");
    $acentos = $conexion->query("SET NAMES 'utf8'");

    $nombre = $_POST['magazine'];

    $query = "delete from magazines where magazineName='$nombre'";
    $result = $conexion -> query($query);

    $conexion->close();
    (new Redirection())->to("index.php?Delete=OK");

}else{
    (new Redirection())->to("index.php?Delete=error");
}
