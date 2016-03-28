<?php

namespace kioskon\application\ui;

use kioskon\application\db\DataBaseConnection;
use kioskon\application\db\DataBaseSelect;
use kioskon\application\utils\Check;

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

							<li class=" dropdown"><a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestionar <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#"></a></li>
									<li><a href="uploadNewIssue.php">Nueva entrega</a></li>
									<li><a href="#">Modificar entrega</a></li>
									<li><a href="#">Eliminar entrega</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="createNewMagazine.php">Añadir Revista</a></li>
									<li><a href="#">Modificar Revista</a></li>
									<li><a href="#">Eliminar Revista</a></li>
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
								<li><a href="#">Configurar Perfil</a></li>
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
}
