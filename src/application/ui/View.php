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

							<div class="pull-right">
							<!-- en action va la url donde iría el resultado de búsqueda -->
						        <form class="navbar-form" role="search" action="#">
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

							<div class="pull-right">
						        <form class="navbar-form" role="search" action="./searchWithFilter.html">
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
                $semanal = 0;
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
                                $semanal = 0;
                            } else {
                                $semestral = ($coste - (($coste * $dsemestral) / 100)) * 6;
                            }
                        } else {
                            $semestral = NULL;
                        }
                        if ($danual != NULL) {
                            if ($semanal == 1) {
                                $anual = (($coste - (($coste * $danual) / 100)) * 4) * 12;
                                $semanal = 0;
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

}
