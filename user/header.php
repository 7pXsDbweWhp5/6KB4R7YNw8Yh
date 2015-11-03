<!-- Barra de menú -->
	<header>
		<nav class="navbar navbar-inverse" role="navigation">
		  <div class="container" id="mibarrademenu">
		    <div class="navbar-header welcome-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <?php echo "<h3 class='bienvenido'> Bienvenido(a) ". $_SESSION['nombre'] ?>
		  	</div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav navbar-right">
		      	<li><a id="home" href="home.php" class="hvr-icon-pulse">Inicio</a></li>
		      	<li><a id="crear_publicacion" href="create.php" class="hvr-icon-pulse">Crear Publicación</a></li>
		      	<li><a id="notificaciones" href="notificaciones.php" class="hvr-icon-pulse">Mis Notificaciones <span class="label label-danger">2</span></a></li>
		        <li class="dropdown">
		          	<a id="config" class="dropdown-toggle hvr-icon-spin" data-toggle="dropdown" href="#">
		          		Mi Cuenta</a>
		          	<ul id="sub_menu" class="dropdown-menu">
		            	<li><a id="perfil" href="perfil.php"><i class="fa fa-user"></i> Ver Perfil</a></li>
		            	<li><a id="mis_publicaciones" href="publicaciones.php"><i class="fa fa-paw"></i> Mis Publicaciones</a></li>
		            	<li><a id="mis_solicitudes" href="solicitudes.php"><i class="fa fa-envelope"></i> Mis Solicitudes</a></li>
		            </ul>
		        </li>
		        <li><a id="cerrar_sesion" href="../prv/funciones.php?valor=disconnect" class="hvr-icon-pulse">Cerrar Sesión</a></li>
		      </ul>
		    </div>
		  </div>
		</nav>
	</header>