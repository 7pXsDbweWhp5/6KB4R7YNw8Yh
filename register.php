<?php 
include('prv/conexion.php');
 ?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/formulario.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/hover.css" media="all">
	<title>Registrate!</title>
</head>

<body onload='hideplcHolder("register")'>
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
		        <li class="active"><a id="registro" href="#" class="hvr-icon-pulse">Registrate</a></li>
		        <li><a id="ingresar" href="login.php" class="hvr-icon-pulse">Ingresa</a></li>
		      </ul>
		    </div>
		  </div>
		</nav>
	</header>

<!-- Formulario -->
	<div class="formulario container">
		<div class="titulo">
			<h2>Registro de usuario</h2>
		</div>
		<hr/>

		<div class="sub-registro centrado">
		<?php if(isset($_COOKIE['update']) and $_COOKIE['update'] == "true"){ ?>
				<div class="alert alert-<?php echo $_COOKIE['class_alert'] ?> alert-dismissible animated <?php echo $_COOKIE['animacion']?>" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <?php echo $_COOKIE['msg']?>
				</div>
				<?php }
					setcookie("update","", time()-3600,"/");
					setcookie("class_alert", "", time()-3600,"/");
					setcookie("animacion", "", time()-3600,"/");
					setcookie("msg","", time()-3600, "/");
				?>
			<form id="registro" class="form-inline" action="prv/funciones.php?valor=register" method="POST" enctype="multipart/form-data">
				<div class="datos">
					<div class="row">
						<div id="name-grp" class="form-group">
						    <label for="name" class="control-label txt-sdw-gray">Nombre <span style="color:white">*</span></label>
						    <div class="">
						      <input type="text" class="form-control input-sm" maxlength="30"
						      		 name="name" id="name" placeholder="Nombre" required>
						    </div>
						    <small>Amelie</small>
						</div>
					</div>
					<div class="row">
						<div id="apPaterno-grp" class="form-group">
						    <label for="apPaterno" class="control-label txt-sdw-gray">Apellido paterno <span style="color:white">*</span></label>
						    <div class="">
						      <input type="text" class="form-control input-sm" name="apPaterno" maxlength="30"
						      		 id="apPaterno" placeholder="Apellido paterno" required>
						    </div>
						    <small>Nuñez</small>
						</div>
						<div id="apMaterno-grp" class="form-group">
						    <label for="apMaterno" class="control-label txt-sdw-gray">Apellido materno <span style="color:white">*</span></label>
						    <div class="">
						      <input type="text" class="form-control input-sm" required maxlength="30"
						      		 name="apMaterno" id="apMaterno" placeholder="Apellido materno">
						    </div>
						    <small>San Martín</small>
						</div>
					</div>
					<div class="row">
						<div id="sexo-grp" class="form-group">
							<label for="sexo" class="control-label txt-sdw-gray">Sexo <span style="color:white">*</span></label><br>
							<div class="btn-group" name="groupSelect" data-toggle="buttons">
							    <label id="sexoM" class="btn btn-default btn-sm">
							    	<input type="radio" name="sexo" id="M" value="M"> Masculino
							    </label>
							    <label id="sexoF" class="btn btn-default btn-sm">
							    	<input type="radio" name="sexo" id="F" value="F"> Femenino
							    </label>
					    	</div>
						</div>
					</div>
					<div class="row">
						<div id="fechaNacimiento" class="form-group">
							<label for="day" class="control-label txt-sdw-gray">Fecha de nacimiento <span style="color:white">*</span></label>
							<div class="form-inline" style="color:black">
				                 <div class="reg-fecha">
									<select id="day" name="day" class="form-control input-sm">
										<option value="0" selected>Dia</option><?php
									    for($i=1;$i<=31;$i++)
									    {
									        echo '<option value="'.$i.'">'.$i.'</option>';
										}?>
									</select>
								</div>
								<div class="reg-fecha">
									<select id="month" name="month" class="form-control input-sm">
										<option value="0" selected>Mes</option>
									    <option value="1">Enero</option>
									    <option value="2">Febrero</option>
									    <option value="3">Marzo</option>
									    <option value="4">Abril</option>
									    <option value="5">Mayo</option>
									    <option value="6">Junio</option>
									    <option value="7">Julio</option>
									    <option value="8">Agosto</option>
									    <option value="9">Septiembre</option>
									    <option value="10">Octubre</option>
									    <option value="11">Noviembre</option>
									    <option value="12">Diciembre</option>
									</select>
								</div>
								<div class="reg-fecha">
									<select id="year" name="year" class="form-control input-sm">
										<option value="0" selected>Año</option><?php
									    for($i=(date("Y")-13);$i>=(date("Y")-110);$i--){
									    	echo '<option value="'.$i.'">'.$i.'</option>';
									    }?>
									</select>
								</div>
						    </div>
						</div>
					</div>
					<div class="row">
						<div id="pais-grp" class="form-group">
							<label class="control-label txt-sdw-gray" for="pais">País <span style="color:white">*</span></label>
							<div class="">
								<select class="form-control input-sm" onchange="cargarCiudades('registro')" name="pais" id="pais">
									<?php
										$sql = "SELECT * FROM pais ORDER BY pais ASC";
										mysqli_set_charset($con,"utf8");
										$res = mysqli_query($con,$sql);?>
										<option value="0" selected>Seleccione...</option><?php
										while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
											echo '<option value="'.$row['id_pais'].'">'.$row['pais'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div id="ciudad-grp" class="form-group">
							<label class="control-label txt-sdw-gray" for="ciudad">Ciudad <span style="color:white">*</span></label>
							<div class="">
								<select class="form-control input-sm" name="ciudad" id="ciudad">
									<option value="0" selected>Seleccione...</option>;
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div id="direccion-grp" class="form-group">
						    <label for="direccion" class="control-label txt-sdw-gray">Dirección</label>
						    <div class="">
						      <input type="text" class="form-control input-sm" name="direccion"
						      	maxlength="50" id="direccion" placeholder="Dirección">
						    </div>
						    <small>Av Siempreviva #742</small>
						</div>
						<div id="telefono-grp" class="form-group">
						    <label for="telefono" class="control-label txt-sdw-gray">Teléfono móvil</label>
						    <div class="">
						      <input type="text" class="form-control input-sm" maxlength="8"
						      name="telefono" id="telefono" placeholder="Teléfono móvil">
						    </div>
						    <small>87655123</small>
						</div>
					</div>
					<div class="row">
						<div id="email-grp" class="form-group">
						    <label for="email" class="control-label txt-sdw-gray">Email <span style="color:white">*</span></label>
						    <div class="">
						      <input type="email" class="form-control input-sm" maxlength="60"
						      		 name="email" id="email" placeholder="Email" required>
						    </div>
						    <small>ejemplo@gmail.com</small>
						</div>
						<div id="email-grp2" class="form-group">
						    <label for="emailCfm" class="control-label txt-sdw-gray">Repita email <span style="color:white">*</span></label>
						    <div class="">
						      <input type="email" class="form-control input-sm" required maxlength="60"
						      		 name="emailCfm" id="emailCfm" placeholder="Repita Email" autocomplete="off">
						    </div>
						    <small>ejemplo@gmail.com</small>
						</div>
					</div>
					<div class="row">
						<div id="pass-grp" class="form-group">
						    <label for="pass" class="control-label txt-sdw-gray">Contraseña <span style="color:white">*</span></label>
						    <div class="">
						      <input type="password" class="form-control input-sm" maxlength="32" pattern=".{6,32}" required title="6 a 32 caracteres."
						      		 name="pass" id="pass" placeholder="Contraseña">
						    </div>
						    <small>Mínimmo 6 caracteres.</small>
						</div>
						<div id="pass-grp2" class="form-group">
						    <label for="passCfm" class="control-label txt-sdw-gray">Repita contraseña <span style="color:white">*</span></label>
						    <div class="">
						      <input type="password" class="form-control input-sm" maxlength="32" pattern=".{6,32}" required title="6 a 32 caracteres."
						      		 name="passCfm" id="passCfm" placeholder="Repita Contraseña" autocomplete="off">
						    </div>
						    <small>Mínimmo 6 caracteres.</small>
						</div>
					</div>
				</div>
				<div class="avatar">
					<div class="row">
						<div class="form-group">
					  		<label class="control-label txt-sdw-gray" for="fecha_nac">Foto de perfil</label>
					  		<div class="kv-avatar center-block">
					  			<img src="img/no-avatar.jpg" alt="no-avatar" id="preview-avatar" class="img-thumbnail img-responsive">
					  			<p class="help-block text-center" style="color:white">Maximo 1MB</p>
					  			<div class="fileInput">
					  				<input class="filestyle input-sm" data-input="false" type="file"
				  				name="imagen" id="imagen" onchange="showMyImage(this)"
				  				style="max-width:147px" data-buttonText="&nbsp; Cargar imagen" data-badge="false">
					  			</div>
					  		</div>
					    </div>
					</div>
					<div id="btn-reg" class="form-group">
				  		<input type="submit" class="btn btn-danger btn-style btn-sm" value="Registrarse">
				    </div>
				</div>
			</form>
		</div>
	</div>

	<!-- Scripts -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
	<script type="text/javascript" src="js/funciones.js"></script>

	</body>
</html>
