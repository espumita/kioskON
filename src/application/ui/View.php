<?php

namespace kioskon\application\ui;

use kioskon\application\db\DataBaseConnection;
use kioskon\application\db\DataBaseSelect;
use kioskon\application\utils\Check;
use mysqli;

class View{

    public static function pageHeader($tittle) {
        echo '
<html>
<head>
    <title>'.$tittle.'</title>
	<meta charset="UTF-8">
	<link rel="icon" href="/img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/styleLogin.css">
	<script src="/js/scripts.js"></script>
	<script src="/js/jquery.min.js"></script>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
	<script src="/js/bootstrap.min.js"></script>
</head>
<body>';
    }

    public static function pageFooter() {
        echo '
</body>
</html>';
    }

    public static function userNoLoggedNavigationBar(){
        echo'
<div class="navbar-wrapper">
	<div class="container-fluid">
		<nav class="navbar navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<img alt="" src="/img/logo_small.png">

				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="index.php" class="">Principal</a></li>
                        
							<li><a href="#" class="">Periódicos</a></li>
							<li><a href="#" class="">Revistas</a></li>
							<li><a href="tarifas.php" class="">Tarifas</a></li>
							<li class=" dropdown"><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Próximos Lanzamientos<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#">Periódicos</a></li>
									<li><a href="#">Revistas</a></li>
								</ul>
							</li>
				            <li><a href="faq.php" class="">FAQ</a></li>
					</ul>



							<div class="pull-right">
							<!-- en action va la url donde iría el resultado de búsqueda -->
						        <form class="navbar-form" role="search" method="post" action="search.php">
						        <div class="input-group">
						            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
						            <div class="input-group-btn">
						                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
						            </div>
						        </div>
						        </form>
			        		</div>
					</ul>

					<ul class="nav navbar-nav pull-right">

						<li class=" dropdown"><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Accede a tu perfil<span class="caret"></span></a>
							<ul class="dropdown-menu">      
                                <li><a href="login.php">Iniciar Sesión</a></li>
                                <li><a href="register.php">Registrarse</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
</div>';
    }

    public static function userLoggedNavigationBar(){
        echo '
<div class="navbar-wrapper">
	<div class="container-fluid">
		<nav class="navbar navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<img alt="" src="/img/logo_small.png">

				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="index.php" class="">Principal</a></li>
                            <li><a href="tarifas.php" class="">Tarifas</a></li>
							<li class=" dropdown"><a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestionar <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#"></a></li>
									<li><a href="uploadNewIssue.php">Nueva entrega</a></li>
									<li><a href="modifyIssue.php">Modificar entrega</a></li>
									<li><a href="#">Eliminar entrega</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="createNewMagazine.php">Añadir Revista</a></li>
									<li><a href="#">Modificar Revista</a></li>
									<li><a href="eliminarRevista.php">Eliminar Revista</a></li>
									<li><a href="downloadIssue.php">Revistas Compradas</a></li>
                                    <li role="separator" class="divider"></li>
									<li><a href="#">Añadir Suscripción</a></li>
									<li><a href="#">Modificar Suscripción</a></li>
									<li><a href="#">Eliminar Suscripción</a></li>
								</ul>
							</li>
							<li class=" dropdown"><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Calendario<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#">Lanzamiento</a></li>
								</ul>
							</li>
                            <li><a href="faq.php" class="">FAQ</a></li>
							<div class="pull-right">
						        <form class="navbar-form" role="search" method="post" action="search.php">
						        <div class="input-group">
						            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
						            <div class="input-group-btn">
						                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
						            </div>
						        </div>
						        </form>
			        		</div>
					</ul>

					<ul class="nav navbar-nav pull-right">

						<li class=" dropdown"><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bienvenido '.$_SESSION['user'].'<span class="caret"></span></a>
							<ul class="dropdown-menu">
						        <li><a href="eliminarCuenta.php">Eliminar Cuenta</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="editUser.php">Configurar Perfil</a></li>
								<li><a href="logout.php">Desconectarse</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
</div>';
    }

    public static function carousel(){
        echo '
<div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
  <div class="carousel-inner">
    <div class="item slides active">
      <div class="slide-1">
          <div class="overlay"></div>
      </div>
     
    </div>
  </div>
</div>';
    }
    
    public static function searchByDate( $dbConnection, $date ){
        date_default_timezone_set('utc');
        $select = (new DataBaseSelect($dbConnection))->searchByDate($date);
        
        if( $select ){
            
            ob_start();
                ?>
                    <table>
                        <caption>Results</caption>
                        <thead>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Date</th>
                        </thead>
                <?php 
                
                while ($row = mysqli_fetch_row($select)) {
                        ?>
                            <tr>
                                <td><?php echo $row[0]; ?></td>
                                <td><?php echo $row[4] . "€"; ?></td>
                                <td><?php echo date( "d/m/Y", strtotime($row[3])); ?></td>
                            </tr>
                        <?php
                }
                    ?> </table> <?php
            echo ob_get_clean();
            
        }else{ echo "no hay coincidencias"; }
    }
    
    public static function search( $dbConnection, $min, $max ){
        date_default_timezone_set('utc');
        $select = (new DataBaseSelect($dbConnection))->searchByPrice($min, $max);
        
        if( $select ){
            
            ob_start();
                ?>
                    <table>
                        <caption>Results</caption>
                        <thead>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Date</th>
                        </thead>
                <?php 
                
                while ($row = mysqli_fetch_row($select)) {
                        ?>
                            <tr>
                                <td><?php echo $row[0]; ?></td>
                                <td><?php echo $row[4] . "€"; ?></td>
                                <td><?php echo date( "d/m/Y", strtotime($row[3])); ?></td>
                            </tr>
                        <?php
                }
                    ?> </table> <?php
            echo ob_get_clean();
            
        }else{ echo "no hay coincidencias"; }
    }

    public static function loginForm(){
        echo'
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pr-wrap">
                <div class="pass-reset">
                    <label>
                        Introduce tu email</label>
                    <input type="email" placeholder="Email" />
                    <input type="submit" value="Submit" class="pass-reset-submit btn btn-success btn-sm" />
                </div>
            </div>
            <div class="wrap">
                <p class="form-title">
                    Inicia sesión</p>
                <form action="checkLogin.php" class="login" method="post">
                    <input type="text" placeholder="Usuario" name="user"/>
                    <input type="password" placeholder="Contraseña" name="pass"/>
                    <input type="submit" value="Iniciar Sesión" class="btn btn-success btn-sm" />
                    <div class="remember-forgot">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <div class="remember"><input type="checkbox" />
                                        Recordarme</div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 forgot-pass-content">
                                <a href="javascript:void(0)" class="forgot-pass">¿Olvidaste la contraseña?</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>';
    }

    public static function logOut(){
        echo '
<li><a href="logout.php">Logout</a></li>';
    }

    public static function createMagazineForm() {
        echo'
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pr-wrap">
                <div class="pass-reset">
                    <label>
                        Introduce tu email</label>
                    <input type="email" placeholder="Email" />
                    <input type="submit" value="Submit" class="pass-reset-submit btn btn-success btn-sm" />
                </div>
            </div>
            <div class="wrap">
                <p class="form-title">
                    Añadir revista</p>
                <form action="checkCreateNewMagazine.php" class="login" method="post">
                    <input type="text" placeholder="Nombre de la revista" name="magazine"/>
                    <input type="text" placeholder="Número de entregas anuales" name="periodicity"/>
                    <input type="submit" value="Añadir" class="btn btn-success btn-sm" />
                </form>
            </div>
        </div>
    </div>
</div>';
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

    public static function issuesUploadForm($dbConnection) {
        echo'
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="wrap">
                <p class="form-title">
                    Nueva entrega</p>
                <form enctype="multipart/form-data" action="checkUploadIssue.php" class="login" method="post">
                    <input name="userFile" type="file">
                    <br>
                    <select name="magazines">';
        self::deployMagazinesOptions($dbConnection);
        echo '
                    </select>
                    <br>
                    <br>
                    <input type="text" placeholder="Número" name="number"/>
                    <input type="text" placeholder="Coste" name="cost"/>
                    <input type="submit" value="Publicar" class="btn btn-success btn-sm" />
                </form>
            </div>
        </div>
    </div>
</div>';
    }

    private static function deployMagazinesOptions($dbConnection) {
        $select = (new DataBaseSelect($dbConnection))->allUserMagazines($_SESSION['id']);
        while ($row = mysqli_fetch_row($select)) {
            echo '
<option value="'.$row[0].'">'.$row[1].'</option>';
        }
    }

    public static function registerForm(){
        echo'
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pr-wrap">
                <div class="pass-reset">
                    <label>
                        Introduce tu email</label>
                    <input type="email" placeholder="Email" />
                    <input type="submit" value="Submit" class="pass-reset-submit btn btn-success btn-sm" />
                </div>
            </div>
            <div class="wrap">
                <p class="form-title">
                    Registrarse</p>
                <form action="checkRegister.php" class="login" method="post">
                    <input type="text" placeholder="Usuario" name="userName"/>
                    <input type="text" placeholder="Email" name="email"/>
                    <input type="password" placeholder="Contraseña" name="password"/>
                    <input type="password" placeholder="Reescribir contraseña" name="retypePassword"/>
                    <input type="submit" value="Registrarse" class="btn btn-success btn-sm" />
                </form>
            </div>
        </div>
    </div>
</div>';
    }

    public static function tarifas()
    {
        echo '
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pr-wrap">
                <div class="pass-reset">
                    <label>
                        Tabla</label>
                    <input type="email" placeholder="Email" />
                    <input type="submit" value="Submit" class="pass-reset-submit btn btn-success btn-sm" />
                </div>
            </div>
            <div class="wrap"><br><br><br><br><br><br>';
        header("Content-Type: text/html;charset=utf-8");
        if (new mysqli("db4free.net", "kioskon", "kioskon", "kioskon")) {
            $conexion = new mysqli("db4free.net", "kioskon", "kioskon", "kioskon");
            $acentos = $conexion->query("SET NAMES 'utf8'");
            $query_magazines = "select * from magazines";
            $result_magazines = $conexion->query($query_magazines);

            echo '<table align="center" width="620" class="login">
                <tr align="center">
                    <td align="left" width="150"><font size=5 color="blue" face="Arial"><u><b>Nombre</b></u></font></td>
                    <td align="right" width="150"><font size=5 color="blue" face="Arial"><u><b>Unidad</b></u></font></td>
                    <td align="right" width="150"><font size=5 color="blue" face="Arial"><u><b>Mensual</b></u></font></td>
                    <td align="right" width="150"><font size=5 color="blue" face="Arial"><u><b>Semestral</b></u></font></td>
                    <td align="right" width="150"><font size=5 color="blue" face="Arial"><u><b>Anual</b></u></font></td>
                </tr>
                <tr height=20></tr>';

            while ($query_result_magazines = $result_magazines->fetch_array()) {
                $nombre_magazine = $query_result_magazines["magazineName"];
                $id_magazine = $query_result_magazines["_id"];
                $query_issues = "select * from issues where magazines__fk='$id_magazine'";
                $result_issues = $conexion->query($query_issues);
                while ($query_result_issues = $result_issues->fetch_array()) {
                    $mensual = NULL;
                    $semestral = NULL;
                    $anual = NULL;
                    $coste = $query_result_issues["unitCost"];
                    $query_discounts = "select * from discounts2 where magazines_fk='$id_magazine'";
                    $result_discounts = $conexion->query($query_discounts);
                    while ($query_result_discounts = $result_discounts->fetch_array()) {
                        $semanal = 0;
                        $dmensual = $query_result_discounts["discountMensual"];
                        $dsemestral = $query_result_discounts["discountSemestral"];
                        $danual = $query_result_discounts["discountAnual"];
                        if ($dmensual != NULL) {
                            $semanal = 1;
                            $mensual = ($coste - (($coste * $dmensual) / 100)) * 4;
                        } else {
                            $mensual = NULL;
                        }
                        if ($dsemestral != NULL) {
                            if ($semanal == 1) {
                                $semestral = (($coste - (($coste * $dsemestral) / 100)) * 4) * 6;
                            } else {
                                $semestral = ($coste - (($coste * $dsemestral) / 100)) * 6;
                            }
                        } else {
                            $semestral = NULL;
                        }
                        if ($danual != NULL) {
                            if ($semanal == 1) {
                                $anual = (($coste - (($coste * $danual) / 100)) * 4) * 12;
                            } else {
                                $anual = ($coste - (($coste * $danual) / 100)) * 12;
                            }
                        } else {
                            $anual = NULL;
                        }
                    }
                    if ($mensual != NULL) {
                        $eurom = ' €';
                        $mensual = number_format($mensual, 2, ",", ".");
                    } else {
                        $eurom = '';
                        $mensual = '--';
                    }
                    if ($semestral != NULL) {
                        $euros = ' €';
                        $semestral = number_format($semestral, 2, ",", ".");
                    } else {
                        $euros = '';
                        $semestral = '--';
                    }
                    if ($anual != NULL) {
                        $euroa = ' €';
                        $anual = number_format($anual, 2, ",", ".");
                    } else {
                        $euroa = '';
                        $anual = '--';
                    }
                    echo '<tr align="center">
                        <td align="left"><font size=4 color="navy" face="Times New Roman">' . $nombre_magazine . '</font></td>
                        <td align="right"><font size=4>' . number_format($coste, 2, ",", ".") . ' €' . '</font></td>
                        <td align="right"><font size=4>' . $mensual . $eurom . '</font></td>
                        <td align="right"><font size=4>' . $semestral . $euros . '</font></td>
                        <td align="right"><font size=4>' . $anual . $euroa . '</font></td>
                        </tr>';
                }
            }
            echo '</table>';
            $conexion->close();
        } else {
            echo "Error de conexión con la base de datos";
        }
        echo '
            </div>
        </div>
    </div>
</div>';
    }

    public static function deleteMagazineForm(){
        echo '
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pr-wrap">
                <div class="pass-reset">
                    <label>
                        Tabla</label>
                    <input type="email" placeholder="Email" />
                    <input type="submit" value="Submit" class="pass-reset-submit btn btn-success btn-sm" />
                </div>
            </div>
            <div class="wrap"><br><br><br><br><br><br>';
        echo '<div align="center">
<br>';
header("Content-Type: text/html;charset=utf-8");
if (new mysqli("db4free.net", "kioskon", "kioskon", "kioskon"))
{
    $conexion = new mysqli("db4free.net", "kioskon", "kioskon", "kioskon");
    $acentos = $conexion->query("SET NAMES ,'utf8'");

    echo '<FORM class="login" METHOD="POST" ACTION="delete.php"><font size=5>Nombre Revista</font><br><p></p>';

    $query = "select magazineName from magazines where owner=".$_SESSION['id']." order by magazineName";
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
echo'
</select>
<br>
<p></p>
<INPUT TYPE="SUBMIT" value="Eliminar Revista">
</FORM>
</div>';
        echo '
            </div>
        </div>
    </div>
</div>';
    }

    public static function cosas(){
        echo'

    <div style="background-color: #2E2E2E; padding:30px 0px 30px 0px">

    <div class="row" style="margin: 20px 0px 20px 0px">
        <div class="col-md-2"></div>
        <div class="col-md-2">
            <img src="img/abc.png" width="150" height="220">            
        </div>
        <div class="col-md-2">
            <img src="img/elpais.jpg" width="150" height="220">
        </div>
        <div class="col-md-2">
            <img src="img/lavanguardia.png" width="150" height="220">
        </div>    
        <div class="col-md-2">
            <img src="img/larazon.png" width="150" height="220">
        </div>    
    </div>

    <div class="row" style="margin: 20px 0px 20px 0px">
        <div class="col-md-2"></div> 
        <div class="col-md-2">
            <img src="img/computer.png" width="150" height="220">            
        </div>
        <div class="col-md-2">
            <img src="img/fotogramas.png" width="150" height="220">
        </div>
        <div class="col-md-2">
            <img src="img/onehacker.png" width="150" height="220">
        </div> 
        <div class="col-md-2">
            <img src="img/national.png" width="150" height="220">
        </div>       
    </div>

    <div class="row"  style="margin: 20px 0px 20px 0px">
        <div class="col-md-2"></div> 
        <div class="col-md-2">
            <img src="img/bikes.png" width="150" height="220">            
        </div>
        <div class="col-md-2">
            <img src="img/motor.png" width="150" height="220">
        </div>
        <div class="col-md-2">
            <img src="img/muyhistoria.png" width="150" height="220">
        </div>   
        <div class="col-md-2">
            <img src="img/eljueves.png" width="150" height="220">
        </div>     
    </div>
    </div>';
    }

    public static function button()
    {
        echo'    <div style="padding:30px 0px 30px 50px;">
        <input type="button" class="btn btn-primary" value="Comprar ejemplar" onclick="window.open(\'https://www.paypal.com/signin/?country.x=ES&locale.x=es_ES\')" />
    </div>';
    }

    public static function modifyIssueForm($id){
        echo'
 <form method="post" enctype="multipart/form-data" action="modifyIssueForm.php">
     <table>
         <tr>
             <td colspan=2><input name="userFile" type="file"> <input name="id" type="hidden" value="'.$id.'"></td>
         </tr>
         <tr>
             <td>Número: </td>
             <td><input name="number" type="text" value=""></td>
         </tr>
         <tr>
             <td>Coste: </td>
             <td><input name="cost" type="text" value=""></td>
         </tr>
         <tr>
             <td><input name="upload" type="submit" value="Subir"></td>
         </tr>
     </table>
 </form>';
     }

    public static function userPurchases($dbConnection){
        echo '
<h2>Mis revistas compradas</h2>
<table><form action="downloadIssueForm.php" method="POST">
   <tr>
       <th>ID Entrega</th>
       <th>Número de Entrega</th>
       <th>Descargar</th>
       <th>Visualizar</th>
   </tr>';
        self::deployPurchasesRows($dbConnection);
        echo '</form>
</table>';
    }
    public static function deployPurchasesRows($dbConnection){
        if($select = (new DataBaseSelect($dbConnection))->purchases($_SESSION['id'])) {
            if (!is_int($select)) {
                while ($row = $select->fetch_assoc()) self::deploySingleRowPurchases($row);
            }
        };
    }

    public static function deploySingleRowPurchases($row){
        echo '
<tr>
    <td>'.$row['_idIssue'].'</td>
        <td>'.$row['issueNumber'].'</td>
    <td><input name="botonListaDescargar" type="submit" value="Descargar '.$row['_idIssue'].'"></td>
    <td><input name="botonListaVisualizar" type="submit" value="Visualizar '.$row['_idIssue'].'"></td>
</tr>';
    }

   public static function userCurrentMagazinesListModify($dbConnection){
       echo '
<h2>Mis revistas</h2>
<table><form action="modifyIssueForm.php" method="POST">
   <tr>
       <th>ID Entrega</th>
       <th>Revista</th>
       <th>Nombre Fichero</th>
       <th>Numero de Entrega</th>
       <th>Coste Unitario</th>
       <th>Modificar fichero</th>
   </tr>';
        self::deployMagazineTableRowsModify($dbConnection);
        echo '</form>
</table>';
}
   public static function deployMagazineTableRowsModify($dbConnection){
       if($select = (new DataBaseSelect($dbConnection))->allUserIssues($_SESSION['id'])) {
           if (!is_int($select)) {
                 while ($row = $select->fetch_assoc()) self::deploySingleRowModify($row);
            }
        };
}
   public static function deploySingleRowModify($row){
       echo '
<tr>
    <td>'.$row['_id'].'</td>
    <td>'.$row['magazineName'].'</td>
    <td>'.$row['fileName'].'</td>
    <td>'.$row['issueNumber'].'</td>
    <td>'.$row['unitCost'].'</td>
    <td><input name="botonListaModificar" type="submit" value="Modificar '.$row['_id'].'"></td>
</tr>';
    }

    public static function modifyProfileForm() {
        echo'
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pr-wrap">
                <div class="pass-reset">
                    <label>
                        Introduce tu email</label>
                    <input type="email" placeholder="Email" />
                    <input type="submit" value="Submit" class="pass-reset-submit btn btn-success btn-sm" />
                </div>
            </div>
            <div class="wrap">
                <p class="form-title">
                    Modificar perfil</p>
                <form action="checkEditUser.php" class="login" method="post">
                    <input type="text" value="';
        echo $_SESSION['user'];
        echo'" name="userName"/>
                    <input type="text" value="';
        echo $_SESSION['email'];
        echo '" name="email"/>
                    <input type="password" placeholder="Contraseña" name="password"/>
                    <input type="password" placeholder="Reescribir contraseña" name="retypePassword"/>
                    <input type="submit" value="Modificar" class="btn btn-success btn-sm" />
                </form>
            </div>
        </div>
    </div>
</div>';
    }
    
    public static function magazineTable($magazines){
        echo '
<table>
    <caption>Results</caption>
    <thead>
        <th>Name</th>
        </thead> 
    <tr>
        <td>';
        echo $magazines;
        echo'
        </td>
    </tr>
</table>';
    }

    public static function faqBody(){
        echo "<div class=\"faqBody\" style=\"background-color: #2E2E2E; padding:30px 0px 30px 0px\">   
<ul>
  <li class=\"li-faq\"><a href=\"#faq1\">¿Qué es KioskON?</a></li>
  <li class=\"li-faq\"><a href=\"#faq2\">¿Qué ventajas tiene ser cliente de KioskON?</a></li>
  <li class=\"li-faq\"><a href=\"#faq3\">¿Qué requisitos mínimos debe tener mi dispositivo para poder visualizar KioskON?</a></li>
  <li class=\"li-faq\"><a href=\"#faq4\">¿Hace falta registrarse?</a></li>
  <li class=\"li-faq\"><a href=\"#faq5\">¿Qué pasa si ya soy suscriptor de edición impresa?</a></li>
  <li class=\"li-faq\"><a href=\"#faq6\">¿Qué es un plan de suscripción?</a></li>
  <li class=\"li-faq\"><a href=\"#faq8\">¿Cuántos periódicos o revistas puedo comprar?</a></li>
  <li class=\"li-faq\"><a href=\"#faq9\">¿Los suplementos se venden por separado?</a></li>
  <li class=\"li-faq\"><a href=\"#faq10\">¿Cuántas publicaciones hay disponibles?</a></li>
  <li class=\"li-faq\"><a href=\"#faq11\">¿Qué tipo de descuento se aplica?</a></li>
  <li class=\"li-faq\"><a href=\"#faq12\">¿Puedo acceder a mi cuenta desde mis otros dispositivos?</a></li>
  <li class=\"li-faq\"><a href=\"#faq13\">¿Puedo compartir las noticias en mis redes sociales?</a></li>
  <li class=\"li-faq\"><a href=\"#faq14\">¿Necesito instalar algún software/plugin adicional para poder disfrutar de KioskON?</a></li>
  <li class=\"li-faq\"><a href=\"#faq15\">¿Dónde puedo notificar errores, problemas o sugerencias?</a></li>
  <li class=\"li-faq\"><a href=\"#faq16\">¿Me avisarán cuando esté mi publicación disponible?</a></li>
  <li class=\"li-faq\"><a href=\"#faq17\">Me he equivocado ¿Cómo puedo realizar una cancelación?</a></li>
  <li class=\"li-faq\"><a href=\"#faq18\">¿Existen cuentas oficiales de KioskON en redes sociales?</a></li>
  <li class=\"li-faq\"><a href=\"#faq19\">¿Qué medios de pago acepta KioskON? </a></li>
  <li class=\"li-faq\"><a href=\"#faq20\">¿Tengo acceso a ejemplares anteriores si soy suscriptor?</a></li>
  <li class=\"li-faq\"><a href=\"#faq21\">¿Me puedo descargar las publicaciones a mi disco duro para acceder al contenido?</a></li>
  <li class=\"li-faq\"><a href=\"#faq22\">Si me doy de alta en una publicación, ¿tendrán los editores mis datos personales?</a></li>
  <li class=\"li-faq\"><a href=\"#faq23\">¿Puedo disfrutar de las promociones de las distintas publicaciones siendo cliente de KioskON?</a></li>
</ul>
<br><br>
<div class=\"faq-list\" >
<a name=\"faq1\" id=\"faq1\"></a>
<h2> ¿Qué es KioskON?</h2>

<p>KioskON es el servicio digital que te permite disfrutar de tu 
periódico o revista tanto en tu ordenador como en tu dispositivo móvil.</p>

<p>Si lo quieres probar desde tu navegador, simplemente <a href=\"http://kioskon.hol.es/\">pincha aquí</a>.</p>

<p>Si lo que deseas es disfrutar de tu prensa favorita desde desde tu 
dispositivo móvil, visita la página desde tu navegador móvil </p>

  
  <a name=\"faq2\" id=\"faq2\"></a>
    <h2> ¿Qué ventajas tiene ser cliente de KioskON?</h2>
    <p>Por ser cliente de KioskON tendrás acceso a la mayor oferta de prensa de calidad en España:</p>

    <ul>
      <li>Accederás a todas la oferta de ediciones y suplementos de la publicación a la que te suscribas</li>
      <li>Podrás elegir entre más de 100 publicaciones</li>
      <li>Podrás acceder desde tu navegador</li>
      <li>Puedes disfrutar de descuentos de hasta el 50% al realizar más de una suscripción en la misma compra desde nuestra web</li>
    </ul>
  
  <a name=\"faq3\" id=\"faq3\"></a>
    <h2> ¿Qué requisitos mínimos debe tener mi dispositivo para poder visualizar KioskON?</h2>
    <p>Todas las versiones de iPad son compatibles, aunque por rendimiento se recomienda iPad 2 o superior.</p>
    <p>En el caso de Android todas las versiones Android 2.2 o posteriores son compatibles.</p>
    <p>También es compatible con cualquier dispositivo que tenga instalado Windows 8 o 10 como sistema operativo.</p>
    <p>Próximamente nuestro servicio estará disponible para otras plataformas.</p>
  
  <a name=\"faq4\" id=\"faq4\"></a>
    <h2> ¿Hace falta registrarse?</h2>
    <p>Para realizar las compras debes 
registrarte. En menos de un minuto 
podrás disfrutar de todo lo que ofrece <strong>KioskON y sus descuentos</strong>. </p>
  
  <a name=\"faq5\" id=\"faq5\"></a>
    <h2> ¿Qué pasa si ya soy suscriptor de edición impresa?</h2>
    <p>Si eres suscriptor de un medio en edición impresa, y tu medio 
ofrece una oferta conjunta papel/digital, podrás seguir disfrutando de 
todo lo mejor de la edición impresa como hasta ahora, con la ventaja 
adicional de disfrutar también de tu suscripción en KioskON pagando.</p>
  
  <a name=\"faq6\" id=\"faq6\"></a>
    <h2> ¿Qué es un plan de suscripción?</h2>
    <p>En KioskON ofrecemos múltiples modos de suscribirte a 
periódicos y revistas, para que escojas el que mejor se adapte a ti. 
Pero para acceder a tanta flexibilidad, no olvides darte de alta como 
cliente.</p>
    <p>¿Por cuánto tiempo me puedo suscribir?</p>
    <p>Las suscripciones pueden realizarse por períodos de uno, tres, 
seis o doce meses
      y para tu comodidad siempre son autorrenovables. Debido a la 
periodicidad de algunas publicaciones es posible que las suscripciones 
de duración menor no siempre estén disponibles.</p>
    <p>Si ningún plan de suscripción se adapta a ti, siempre puedes 
disfrutar de descuentos dándote de alta como cliente, y utilizando la 
compra por ejemplar.</p>
    <p>Descuentos</p>
    <p>Recuerda que no puedes suscribirte a revistas y periódicos en la 
misma compra. Para ello, deberás realizar dos compras distintas. </p>
 
  
  <a name=\"faq8\" id=\"faq8\"></a>
    <h2> ¿Cuántos periódicos o revistas puedo comprar?</h2>
    <p>Puedes disponer de tantos ejemplares como desees. Recuerda que no
 puedes adquirir periódicos y revistas en una misma compra. En este 
caso, deberás realizar las compras por separado.</p>
  
  <a name=\"faq9\" id=\"faq9\"></a>
    <h2> ¿Los suplementos se venden por separado?</h2>
    <p>No. Debes adquirir el ejemplar de la fecha de publicación del suplemento y podrás acceder a las dos publicaciones</p>
  
  <a name=\"faq10\" id=\"faq10\"></a>
    <h2> ¿Cuántas publicaciones hay disponibles?</h2>
    <p>En KioskON podrás disfrutar de más de 350 de publicaciones 
entre periódicos y revistas, contamos con las cabeceras más prestigiosas
 de prensa nacional, así como con una amplia selección de periódicos 
regionales, de ocio, deportivos y de estilos de vida.</p>
  
  <a name=\"faq11\" id=\"faq11\"></a>
    <h2> ¿Qué tipo de descuento se aplica?</h2>
    <p>Puedes disfrutar hasta de 50% de descuento en las publicaciones si realizas las compras de una sola vez.</p>
  
  <a name=\"faq12\" id=\"faq12\"></a>
    <h2> ¿Puedo acceder a mi cuenta desde mis otros dispositivos?</h2>
    <p>Si realizas tu compra desde nuestra web, puedes acceder con tu 
cuenta desde tu PC, teléfono o tablet. Recuerda que puedes acceder como 
máximo desde tres dispositivos a la vez.</p>
  
  <a name=\"faq13\" id=\"faq13\"></a>
    <h2> ¿Puedo compartir las noticias en mis redes sociales?</h2>
    <p>No.</p>
  
  <a name=\"faq14\" id=\"faq14\"></a>
    <h2>¿Necesito instalar algún software/plugin adicional para poder disfrutar de KioskON?</h2>
    <p>Para acceder desde tu navegador sólo necesitas una conexión a Internet.</p>
  
  <a name=\"faq15\" id=\"faq15\"></a>
    <h2>¿Dónde puedo notificar errores, problemas o sugerencias?</h2>
    <p>Accede a nuestros <a href=\"INSERTAR PÁGINA DE CONTACTO\">datos de contacto</a>.</p>
  
  <a name=\"faq16\" id=\"faq16\"></a>
    <h2>¿Me avisarán cuando esté mi publicación disponible?</h2>
    <p>Si lo desea, sí. KioskON cuenta con un sistema de 
notificaciones automáticas, que te avisará por e-mail, de las 
actualizaciones de las publicaciones en las que estés interesado.</p>
  
  <a name=\"faq17\" id=\"faq17\"></a>
    <h2>Me he equivocado ¿Cómo puedo realizar una cancelación?</h2>
    <p>Accede a nuestros <a href=\"INSERTAR PÁGINA DE CONTACTO\">datos de contacto</a>.</p>
  
  <a name=\"faq18\" id=\"faq18\"></a>
    <h2>¿Existen cuentas oficiales de KioskON en redes sociales?</h2>
    <p>No. </p>
  <a name=\"faq19\" id=\"faq19\"></a>
    <h2>¿Qué medios de pago acepta KioskON? </h2>
    <p>Puedes efectuar el pago con VISA, MasterCard, American Express.</p>
  
  <a name=\"faq20\" id=\"faq20\"></a>
    <h2>¿Tengo acceso a ejemplares anteriores si soy suscriptor?</h2>
    <p>No</p>
  
  <a name=\"faq21\" id=\"faq21\"></a>
    <h2>¿Me puedo descargar las publicaciones a mi disco duro para acceder al contenido?</h2>
    <p>Sí, podrás descargar los archivos en formato pdf.</p>
  
  <a name=\"faq22\" id=\"faq22\"></a>
    <h2>Si me doy de alta en una publicación, ¿tendrán los editores mis datos personales?</h2>
    <p>No.</p>
  
  <div class=\"question noline\"><a name=\"faq23\" id=\"faq23\"></a>
    <h2>¿Puedo disfrutar de las promociones de las distintas publicaciones siendo cliente de KioskON?</h2>
    <p>Es cada cabecera la que decide que promociones de entre las que 
facilita, ya sea a través de KioskON o en soporte tradicional, son 
disponibles a través de KioskON, y que condiciones debe cumplir 
cada usuario para disfrutarlas. Para mas información te sugerimos 
contactes con los servicios de atención al cliente de tu publicación.</p>
  


</div>  
</div>";
    }

    public static function magazinesFromUserTable($result) {
        echo '
<table>
    <caption>Results</caption>
    <thead>
        <th>Name</th>
        </thead>';
        if($result != "Not Found"){
            foreach ($result as $magazine){
                echo '<tr><td>'.$magazine.'</td></tr>';
            }
        }else{
            echo '<tr><td>'.$result.'</td></tr>';
        }
        echo'
</table>';
    }
}
