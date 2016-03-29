<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <meta name="language" content="es">
        <title>TARIFAS</title>
    </head>
    <body>
        <?php
        header("Content-Type: text/html;charset=utf-8");
        if (new mysqli("db4free.net", "kioskon", "kioskon", "kioskon"))
        {
            $conexion = new mysqli("db4free.net", "kioskon", "kioskon", "kioskon");
            $acentos = $conexion->query("SET NAMES 'utf8'");
            $query_magazines = "select * from magazines";
            $result_magazines = $conexion -> query($query_magazines);
           
            echo'<table align="center" width="620">
                <tr align="center">
                    <td align="left" width="150"><font size=5 color="blue" face="Arial"><u><b>Nombre</b></u></font></td>
                    <td align="right" width="150"><font size=5 color="blue" face="Arial"><u><b>Unidad</b></u></font></td>
                    <td align="right" width="150"><font size=5 color="blue" face="Arial"><u><b>Mensual</b></u></font></td>
                    <td align="right" width="150"><font size=5 color="blue" face="Arial"><u><b>Semestral</b></u></font></td>
                    <td align="right" width="150"><font size=5 color="blue" face="Arial"><u><b>Anual</b></u></font></td>
                </tr>
                <tr height=20></tr>';
                
            while($query_result_magazines = $result_magazines->fetch_array()) {
                $semanal = 0;
                $nombre_magazine = $query_result_magazines["magazineName"];
                $id_magazine = $query_result_magazines["_id"];
                $query_issues = "select * from issues where magazines__fk='$id_magazine'";
                $result_issues = $conexion -> query($query_issues);
                while($query_result_issues = $result_issues->fetch_array()) {
                    $mensual = NULL;
                    $semestral = NULL;
                    $anual = NULL;
                    $coste = $query_result_issues["unitCost"];
                    $query_discounts = "select * from discounts2 where magazines_fk='$id_magazine'";
                    $result_discounts = $conexion ->query($query_discounts);
                    while($query_result_discounts = $result_discounts->fetch_array()){
                        $dmensual = $query_result_discounts["discountMensual"];
                        $dsemestral = $query_result_discounts["discountSemestral"];
                        $danual = $query_result_discounts["discountAnual"];
                        if ($dmensual != NULL){
                            $semanal = 1;
                            $mensual = ($coste - (($coste*$dmensual)/100))*4;
                        }else{
                            $mensual = NULL;
                        }
                        if ($dsemestral != NULL){
                            if ($semanal == 1){
                                $semestral = (($coste - (($coste*$dsemestral)/100))*4)*6;
                                $semanal = 0;
                            }else{
                                $semestral = ($coste - (($coste*$dsemestral)/100))*6;
                            }
                        }else{
                            $semestral = NULL;
                        }
                        if ($danual != NULL){
                            if ($semanal == 1){
                                $anual = (($coste - (($coste*$danual)/100))*4)*12;
                                $semanal = 0;
                            }else{
                                $anual = ($coste - (($coste*$danual)/100))*12;
                            }
                        }else{
                            $anual = NULL;
                        }
                    }
                    if ($mensual != NULL){
                        $eurom = ' €';
                        $mensual = number_format($mensual, 2, ",", ".");
                    }else{
                        $eurom = '';
                        $mensual = '--';
                    }
                    if ($semestral != NULL){
                        $euros = ' €';
                        $semestral = number_format($semestral, 2, ",", ".");
                    }else{
                        $euros = '';
                        $semestral = '--';
                    }
                    if ($anual != NULL){
                        $euroa = ' €';
                        $anual = number_format($anual, 2, ",", ".");
                    }else{
                        $euroa = '';
                        $anual = '--';
                    }
                    echo'<tr align="center">
                        <td align="left"><font size=4 color="navy" face="Times New Roman">'.$nombre_magazine.'</font></td>
                        <td align="right"><font size=4>'.number_format($coste, 2, ",", ".").' €'.'</font></td>
                        <td align="right"><font size=4>'.$mensual.$eurom.'</font></td>
                        <td align="right"><font size=4>'.$semestral.$euros.'</font></td>
                        <td align="right"><font size=4>'.$anual.$euroa.'</font></td>
                        </tr>';
                }
            }
            echo '</table>';
            $conexion->close();
        }else{
            echo "Error de conexión con la base de datos";
        }
        ?>
    </body>
</html>
