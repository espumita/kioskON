<html>
    <head>
        <meta charset="UTF-8">
        <title>REVISTAS EN OFERTA</title>
    </head>
    <body bgcolor="#2E2E2E">
    <font color="white" size="9"><center>Revistas En Oferta</center></font>
        <hr></hr>
        <?php
        if (new mysqli("db4free.net", "kioskon", "kioskon", "kioskon"))
        {
            $conexion = new mysqli("db4free.net", "kioskon", "kioskon", "kioskon");
            $acentos = $conexion->query("SET NAMES 'utf8'");

            function unitCost($conexion,$name){
                $query_magazine_fk = "select * from magazines where magazineName='$name'";
                $result_magazine_fk = $conexion -> query($query_magazine_fk);
                while ($query_result_magazine_fk = $result_magazine_fk->fetch_array()){
                    $magazine_fk = $query_result_magazine_fk["_id"];
                    $query_unitCost = "select * from issues where magazines__fk='$magazine_fk'";
                    $result_unitCost = $conexion -> query($query_unitCost);
                    while ($query_result_unitCost = $result_unitCost->fetch_array()){
                        $unitCost = $query_result_unitCost['unitCost'];
                    }
                }
                return $unitCost;
            }
            
            function discount($cost,$discount){
                return $cost - (($cost*$discount)/100);
            }

            echo '<table style="HEIGHT:100%; WIDTH:100%; text-align: center">
            <tr style="height: 25"></tr>
            <tr>
            <td>
                <font color="white" size="4"> Antes: <s>'.number_format($cost_bw = unitCost($conexion,'Bikes World'), 2, ",", ".").'</s> €'.'</font>
            </td>
            <td>
                <font color="white" size="4"> Antes: <s>'.number_format($cost_oh = unitCost($conexion,'One Hacker'), 2, ",", ".").'</s> €'.'</font>
            </td>
            <td>
                <font color="white" size="4"> Antes: <s>'.number_format($cost_mh = unitCost($conexion,'Muy Historia'), 2, ",", ".").'</s> €'.'</font>
            </td>
            <td>
                <font color="white" size="4"> Antes: <s>'.number_format($cost_f = unitCost($conexion,'Fotogramas'), 2, ",", ".").'</s> €'.'</font>
            </td>
        </tr>
        <tr>  
            <td>
                <img src="img/bikesOferta.png" alt="" width="200" height="275"/>
            </td>
            <td>
                <img src="img/onehackerOferta.png" alt="" width="200" height="275"/>
            </td>
            <td>
                <img src="img/muyhistoriaOferta.png" alt="" width="200" height="275"/>
            </td>
            <td>
                <img src="img/fotogramasOferta.png" alt="" width="200" height="275"/>
            </td>
        </tr>
        <tr>
            <td>
                <font color="white" size="5"> Ahora: '.number_format(discount($cost_bw, 10), 2, ",", ".").' €'.'</font>
            </td>
            <td>
                <font color="white" size="5"> Ahora: '.number_format(discount($cost_oh, 10), 2, ",", ".").' €'.'</font>
            </td>
            <td>
                <font color="white" size="5"> Ahora: '.number_format(discount($cost_mh, 50), 2, ",", ".").' €'.'</font>
            </td>
            <td>
                <font color="white" size="5"> Ahora: '.number_format(discount($cost_f, 10), 2, ",", ".").' €'.'</font>
            </td>
        </tr>
        <tr style="height: 25"></tr>
        <tr>
            <td>
                <font color="white" size="4"> Antes: <s>'.number_format($cost_mc = unitCost($conexion,'Motor Clásico'), 2, ",", ".").'</s> €'.'</font>
            </td>
            <td>
                <font color="white" size="4"> Antes: <s>'.number_format($cost_ng = unitCost($conexion,'National Geographic'), 2, ",", ".").'</s> €'.'</font>
            </td>
            <td>
                <font color="white" size="4"> Antes: <s>'.number_format($cost_ej = unitCost($conexion,'El Jueves'), 2, ",", ".").'</s> €'.'</font>
            </td>
            <td>
                <font color="white" size="4"> Antes: <s>'.number_format($cost_ch = unitCost($conexion,'Computer Hoy'), 2, ",", ".").'</s> €'.'</font>
            </td>
        </tr>
        <tr>
            <td>
                <img src="img/motorOferta.png" alt="" width="200" height="275"/>
            </td>
            <td>
                <img src="img/nationalOfertas.png" alt="" width="200" height="275"/>
            </td>
            <td>
                <img src="img/eljuevesOferta.png" alt="" width="200" height="275"/>
            </td>
            <td>
                <img src="img/computerOferta.png" alt="" width="200" height="275"/>
            </td>
        </tr>
        <tr>
            <td>
                <font color="white" size="5"> Ahora: '.number_format(discount($cost_mc, 50), 2, ",", ".").' €'.'</font>
            </td>
            <td>
                <font color="white" size="5"> Ahora: '.number_format(discount($cost_ng, 50), 2, ",", ".").' €'.'</font>
            </td>
            <td>
                <font color="white" size="5"> Ahora: '.number_format(discount($cost_ej, 10), 2, ",", ".").' €'.'</font>
            </td>
            <td>
                <font color="white" size="5"> Ahora: '.number_format(discount($cost_ch, 50), 2, ",", ".").' €'.'</font>
            </td>
        </tr>
        </table>';
        $conexion->close();
    }else{
        echo "Error de conexión con la base de datos";
    }
    ?>
    </body>
</html>
