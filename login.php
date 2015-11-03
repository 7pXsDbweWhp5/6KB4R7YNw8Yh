<!DOCTYPE html>
<html lang="es">
<!-- metadatos -->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/formulario.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/hover.css" media="all">
	<title>Adopta</title>
</head>

<body id="wrap-login">
	<!-- Barra de menú -->
	<header>
		<nav class="navbar navbar-inverse">
		  <div class="container" id="mibarrademenu">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span> 
		      </button>
		      <a title="Adopta" href="index.html"><img class="hvr-shrink" id="logo-navbar" src="img/logo250x75.png" alt="Logo adopta.cl"></a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav navbar-right">
		        <li><a id="registro" href="register.php" class="hvr-icon-pulse">Registrate</a></li>
		        <li class="active"><a id="ingresar" href="#" class="hvr-icon-pulse">Ingresa</a></li>
		      </ul>
		    </div>
		  </div>
		</nav>
	</header>

	<section class="formulario container">
		<div class="titulo">
			<h1>Inicio de sesión</h1>
		</div>
		<hr/>
		<div id="sub-login">
			<?php if(isset($_COOKIE['update']) and $_COOKIE['update'] == "true"){ ?>
				<div class="alert alert-<?php echo $_COOKIE['class_alert'] ?> alert-dismissible animated <?php echo $_COOKIE['animacion']?>" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <?php echo $_COOKIE['msg'];?>
				</div>
				<?php } 
					setcookie("update","", time()-3600,"/");
					setcookie("class_alert", "", time()-3600,"/");
					setcookie("animacion", "", time()-3600,"/");
					setcookie("msg","", time()-3600, "/"); 
				?>
			<form class="form-horizontal" action="prv/funciones.php?valor=login" method="POST">
				<div class="row">
					<div id="lgEmail"class="form-group">
					    <label for="lgEmail" class="col-sm-4 control-label">Email</label>
					    <div class="col-sm-8">
					      	<input type="email" class="form-control" name="email" id="lgEmail"
							  placeholder="Email">
					    </div>
					</div>
				</div>
				<div class="row">
					<div id="lgPassword" class="form-group">
					    <label for="lgPass" class="col-sm-4 control-label">Contraseña</label>
					    <div class="col-sm-8">
					      <input type="password" class="form-control" name="pass" id="lgPass"
							  placeholder="Contraseña">
					    </div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-sm-offset-4 col-xs-12 col-sm-8">
							<button type="button" class="btn btn-danger pull-left btn-xs" 
							data-toggle="modal" data-target="#requestPassword">Recuperar contraseña</button>
							<input type="submit" class="btn btn-success pull-right" value="Iniciar sesión">
						</div>
				    </div>
				</div>
			</form>

			<!-- Modal -->
			<div class="modal fade" id="requestPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
				        	onclick='document.getElementById("rqEmail").value = ""'>
				        <span aria-hidden="true">&times;</span>
				    </button>
			        <h4 class="modal-title" id="myModalLabel">Recuperar contraseña</h4>
			      </div>
			      <div class="modal-body">
			        <form class="form-horizontal" action="prv/funciones.php?valor=requestPwd" method="POST">
			        	<div class="row">
							<div id="modalEmail" class="form-group" >
							    <label for="email" class="col-sm-3 control-label">Ingrese su email</label>
							    <div class="col-sm-9">
							      	<input type="email" class="form-control" name="email" id="email"
									  placeholder="Email">
							    </div>
							</div>
						</div>
						<div class="modal-footer">
					        <button type="button" class="btn btn-danger" data-dismiss="modal" 
					        onclick='document.getElementById("rqEmail").value = ""'>Cerrar</button>
					        <input type="submit" class="btn btn-primary" value="Recuperar contraseña"></input>
					    </div>
			        </form>
			      </div>
			      
			    </div>
			  </div>
			</div>
			<!-- Fin del Modal -->

		</div>
	</section>

	<script src="js/jquery.js"></script>
	<script src="js/funciones.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>