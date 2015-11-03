<?php 
	include('../prv/conexion.php');
	session_start();
	if (!isset($_SESSION['id_usuario'])){
		Header("Location: ../login.php");
		exit;
	} else if ($_SESSION['tipo'] == 1){
		?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<link rel="stylesheet" type="text/css" href="../css/navbar.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<link rel="stylesheet" type="text/css" href="../css/hover.css" media="all">
	<title>Crear publicación</title>
</head>

<body>
	<!-- Barra de menú -->
	<header>
		<nav class="navbar navbar-default" role="navigation">
		  <div class="container" id="mibarrademenu">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a title="Adopta" href="index.php"><img class="hvr-shrink" id="logo-navbar" src="../img/logo250x75b.png" alt="Logo adopta.cl"></a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav navbar-right">
		      	<li><a id="adm_reportes" href="reportes.php" class="hvr-icon-pulse">Reportes&nbsp;<span class="label label-danger">4</span></a></li>
		      	<li><a id="adm_edit_perfil" href="reportes.php" class="hvr-icon-pulse">Editar Perfil</a></li>
		      	
		      	<li class="dropdown">
		          	<a id="mantenedores" class="dropdown-toggle hvr-icon-spin" data-toggle="dropdown" href="#">
		          		Mantenedores</a>
		          	<ul id="sub-menu-align" class="dropdown-menu">
		            	<li><a id="adm_users" href="#" class="hvr-icon-pop" onclick="document.getElementById('titulo').innerHTML = '<h2>Mantenedor de Usuarios</h2>'">Usuarios</a></li>
		            	<li><a id="adm_pubs" href="#" class="hvr-icon-pop" onclick="document.getElementById('titulo').innerHTML = '<h2>Mantenedor de Publicaciones</h2>'">Publicaciones</a></li>
		            	<li><a id="adm_races" href="#" class="hvr-icon-pop" onclick="document.getElementById('titulo').innerHTML = '<h2>Mantenedor de Comentarios</h2>'">Comentarios</a></li>
		            	<li><a id="adm_countries" href="#" class="hvr-icon-pop" onclick="document.getElementById('titulo').innerHTML = '<h2>Mantenedor de Países</h2>'">Países</a></li>
		            	<li><a id="adm_cities" href="#" class="hvr-icon-pop" onclick="document.getElementById('titulo').innerHTML = '<h2>Mantenedor de Ciudades</h2>'">Ciudades</a></li>
		            	<li><a id="adm_species" href="#" class="hvr-icon-pop" onclick="document.getElementById('titulo').innerHTML = '<h2>Mantenedor de Especies</h2>'">Especies</a></li>
		            	<li><a id="adm_races" href="#" class="hvr-icon-pop" onclick="document.getElementById('titulo').innerHTML = '<h2>Mantenedor de Razas</h2>'">Razas</a></li>
		            	<li><a id="adm_races" href="#" class="hvr-icon-pop" onclick="document.getElementById('titulo').innerHTML = '<h2>Mantenedor de Comentarios</h2>'">Preguntas</a></li>
		            	<li><a id="adm_races" href="#" class="hvr-icon-pop" onclick="document.getElementById('titulo').innerHTML = '<h2>Mantenedor de Comentarios</h2>'">Respuestas</a></li>
		            	<li><a id="adm_races" href="#" class="hvr-icon-pop" onclick="document.getElementById('titulo').innerHTML = '<h2>Mantenedor de Comentarios</h2>'">Preguntas preestablecidas</a></li>
		          	</ul>
		        </li>
		        <li><a id="cerrar_sesion" href="index.php" class="hvr-icon-pulse">Cerrar sesión</a></li>
		      </ul>
		    </div>
		  </div>
		</nav>
	</header>

	<!-- Contenido -->
	<section class="formulario container">
		<div id="mantenedor_usuarios">
			<div id="titulo" class="titulo">
				<h2>Bienvenido a la administración</h2>
			</div>
			<hr>

			<section id="adm_información">
				
			</section>

				
			</div>
		</div>
	</section>




	<!-- Scripts -->
	<script src="../js/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>

<?php } else {
	header("Location: ../user/home.php");
}

?>