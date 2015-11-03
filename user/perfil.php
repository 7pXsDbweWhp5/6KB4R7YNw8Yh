<?php
	include('../prv/conexion.php');
	session_start();
	if (!isset($_SESSION['id_usuario'])){
		Header("Location: ../login.php");
		exit;
	} else if ($_SESSION['tipo'] == 0){
		?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="../css/navbar.css">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<link rel="stylesheet" type="text/css" href="../css/perfil.css">
	<link rel="stylesheet" type="text/css" href="../css/animate.css">
	<link rel="stylesheet" type="text/css" href="../css/hover.css" media="all">
	<title>Mi Perfil</title>

</head>
<body>
	<?php include('header.php'); ?>

	<div class="container">

<!-- titulo del perfil -->
			<div class="titulo">
				<h2>Perfil de usuario</h2>
				<hr>
			</div>
<!-- datos del usuario -->
			<div id="form_perfil" class="center-block">
				<?php if($_COOKIE['update'] == "true"){ ?>
				<div class="alert alert-<?php echo $_COOKIE['class_alert'] ?> alert-dismissible
							animated <?php echo $_COOKIE['animacion']?>" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <?php echo $_COOKIE['msg'];?>
				</div>
				<?php }
					setcookie("update","false",0,"/");
					setcookie("msg","", time()-3600, "/");
					setcookie("animacion","",time()-3600,"/");
				?>

				<div id="sub_menu">
					<div class="bnt-group btn-group-vertical" style="width:100%;margin-bottom:20px">
					  <button id="editarPerfil" type="button" class="btn btn-default" onclick="desbloquearPerfil()">Editar perfil</button>
					  <button id="cambiarEmail" type="button" class="btn btn-default" data-toggle="modal" data-target="#mdChangeEmail">Cambiar email</button>
					  <button id="cambiarFoto" type="button" class="btn btn-default" data-toggle="modal" data-target="#mdChangeFoto">Cambiar foto de Perfil</button>
					  <button id="cambiarPass" type="button" class="btn btn-default" data-toggle="modal" data-target="#mdChangePass">Cambiar contraseña</button>
					  <button id="desactivarCuenta" type="button" class="btn btn-danger" data-toggle="modal" data-target="#mdDeleteAccount">Eliminar cuenta</button>
					</div>
					<div id="pfButtons" class="form-group pull-right" hidden>
						<button class="btn btn-block btn-danger" onclick="bloquearPerfil()">Cancelar</button>
						<button class="btn btn-block btn-success" onclick="enviarPerfil()">Guardar cambios</button>
				    </div>
				</div>

				<form id="frmPerfil" class="form-horizontal" action="../prv/funciones.php?valor=perfil" method="POST">

					<fieldset disabled>
	<!-- AVATAR -->		<div id="avatar">
							<div class="form-group">
						  		<label class="control-label txt-sdw-gray" for="fecha_nac">Foto de perfil</label>
						  		<div class="kv-avatar center-block">
						  			<img src="<?php echo $_SESSION['foto_perfil']?>" alt="foto_perfil" id="imgPerfil" style="width:230px;height:230px" class="img-thumbnail img-responsive">
						  		</div>
						    </div>
						</div>

	<!-- DATOS -->	<div id="datos">
							<div id="name-grp" class="form-group">
							    <label for="name" class="control-label txt-sdw-gray">Nombre</label>
							    <div class="">
							      <input type="text" class="form-control input-sm"
							      		 name="name" id="name" placeholder="Nombre" maxlength="30" value="<?php echo $_SESSION['nombre']?>">
							    </div>
							</div>
							<div id="apPaterno-grp" class="form-group">
							    <label for="apPaterno" class="control-label txt-sdw-gray">Apellido paterno</label>
							    <div class="">
							      <input type="text" class="form-control input-sm" name="apPaterno"
							      		 id="apPaterno" placeholder="Apellido paterno" maxlength="30" value="<?php echo $_SESSION['apPaterno']?>">
							    </div>
							</div>
							<div id="apMaterno-grp" class="form-group">
							    <label for="apMaterno" class="control-label txt-sdw-gray">Apellido materno</label>
							    <div class="">
							      <input type="text" class="form-control input-sm" maxlength="30"
							      		 name="apMaterno" id="apMaterno" placeholder="Apellido materno" value="<?php echo $_SESSION['apMaterno']?>">
							    </div>
							</div>
							<div id="sexo-grp" class="form-group">
								<label for="sexo" class="control-label txt-sdw-gray">Sexo</label><br>
								<div class="btn-group" name="groupSelect" data-toggle="buttons">
								    <label id="sexoM" class="btn btn-default btn-sm <?php echo $_SESSION['sexo'] == 'M' ? "active" : ""; ?>">
								    	<input type="radio" name="sexo" id="M" value="M" <?php echo $_SESSION['sexo'] == 'M' ? "checked" : ""; ?>> Masculino
								    </label>
								    <label id="sexoF" class="btn btn-default btn-sm <?php echo $_SESSION['sexo'] == 'F' ? "active" : "";?>">
								    	<input type="radio" name="sexo" id="F" value="F" <?php echo $_SESSION['sexo'] == 'F' ? "checked" : "";  ?>> Femenino
								    </label>
						    	</div>
							</div>
							<div id="fechaNacimiento" class="form-group">
								<label for="day" class="control-label txt-sdw-gray">Fecha de nacimiento</label>
								<div class="form-inline">
						                <div class="reg-fecha" style="display:inline">
											<select id="day" name="day" class="form-control input-sm">
												<option value="0" selected>Dia</option><?php
											    for($i=1;$i<=31;$i++){
											    	if ($_SESSION['day'] == $i){
											    		echo '<option value="'.$i.'" selected>'.$i.'</option>';
											    	} else {
											    		echo '<option value="'.$i.'">'.$i.'</option>';
											    	}

												}?>
											</select>
										</div>
										<div class="reg-fecha" style="display:inline">
											<select id="month" name="month" class="form-control input-sm">
												<option value="0">Mes</option>
											    <option value="1" <?php echo $_SESSION['month'] == 1 ? "selected" : ""?>>Enero</option>
											    <option value="2" <?php echo $_SESSION['month'] == 2 ? "selected" : ""?>>Febrero</option>
											    <option value="3" <?php echo $_SESSION['month'] == 3 ? "selected" : ""?>>Marzo</option>
											    <option value="4" <?php echo $_SESSION['month'] == 4 ? "selected" : ""?>>Abril</option>
											    <option value="5" <?php echo $_SESSION['month'] == 5 ? "selected" : ""?>>Mayo</option>
											    <option value="6" <?php echo $_SESSION['month'] == 6 ? "selected" : ""?>>Junio</option>
											    <option value="7" <?php echo $_SESSION['month'] == 7 ? "selected" : ""?>>Julio</option>
											    <option value="8" <?php echo $_SESSION['month'] == 8 ? "selected" : ""?>>Agosto</option>
											    <option value="9" <?php echo $_SESSION['month'] == 9 ? "selected" : ""?>>Septiembre</option>
											    <option value="10" <?php echo $_SESSION['month'] == 10 ? "selected" : ""?>>Octubre</option>
											    <option value="11" <?php echo $_SESSION['month'] == 11 ? "selected" : ""?>>Noviembre</option>
											    <option value="12" <?php echo $_SESSION['month'] == 12 ? "selected" : ""?>>Diciembre</option>
											</select>
										</div>
										<div class="reg-fecha" style="display:inline">
											<select id="year" name="year" class="form-control input-sm">
												<option value="0" selected>Año</option><?php
											    for($i=(date("Y")-13);$i>=(date("Y")-110);$i--){
											    	if ($_SESSION['year'] == $i){
											    		echo '<option value="'.$i.'" selected>'.$i.'</option>';
											    	} else {
											    		echo '<option value="'.$i.'">'.$i.'</option>';
											    	}
											    }?>
											</select>
										</div>
							    </div>
							</div>
							<div id="pais-grp" class="form-group">
								<label class="control-label txt-sdw-gray" for="pais">País</label>
								<div class="">
									<select class="form-control input-sm" onchange="cargarCiudades('perfil')" name="pais" id="pais">
										<?php
											$sql = "SELECT * FROM pais ORDER BY pais ASC";
											mysqli_set_charset($con,"utf8");
											$res = mysqli_query($con,$sql);
										?>	<option value="0" hidden>Seleccione...</option><?php
											while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
												if($_SESSION['id_pais'] == $row['id_pais']){
													echo '<option value="'.$row['id_pais'].'" selected>'.$row['pais'].'</option>';
												} else {
													echo '<option value="'.$row['id_pais'].'">'.$row['pais'].'</option>';
												}
											}?>
									</select>
								</div>
							</div>
							<div id="ciudad-grp" class="form-group">
								<label class="control-label txt-sdw-gray" for="ciudad">Ciudad</label>
								<div class="">
									<select class="form-control input-sm" name="ciudad" id="ciudad">
										<option value="0">Seleccione...</option>
									</select>
								</div>
							</div>
							<div id="direccion-grp" class="form-group">
							    <label for="direccion" class="control-label txt-sdw-gray">Dirección</label>
							    <div class="">
							      <input type="text" class="form-control input-sm" maxlength="50"
							      name="direccion" id="direccion" placeholder="Dirección" value="<?php echo $_SESSION['direccion']?>">
							    </div>
							</div>
							<div id="telefono-grp" class="form-group">
							    <label for="telefono" class="control-label txt-sdw-gray">Teléfono móvil</label>
							    <div class="">
							      <input type="text" class="form-control input-sm" name="telefono" id="telefono"
							      placeholder="Teléfono móvil" maxlength="8" value="<?php echo $_SESSION['telefono']?>">
							    </div>
							</div>
						</div>

					</fieldset>
				</form>
			</div>
<!-- fin de datos del usuario -->
	</div>
<!-- MODALES -->

<!-- Change email -->
	<div class="modal fade" id="mdChangeEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Actualizar email</h4>
	      </div>
	      <div class="modal-body">
	<!-- Contenido del Modal -->
			<form id="frmChangeEmail" action="../prv/funciones.php?valor=changeEmail" method="POST">
				<div id="email" class="form-group">
				    <label for="mdEmail" class="control-label">Actual email: <?php echo $_SESSION['email']?></label>
				</div>
		        <div id="email" class="form-group">
				    <label for="mdEmail" class="control-label">Nuevo email</label>
				    <div class="">
				      <input type="email" class="form-control input-sm" maxlength="60"
				      		 name="mdEmail" id="mdEmail" placeholder="Email">
				    </div>
				</div>
				<div id="cfmEmail" class="form-group">
				    <label for="mdEmailCfm" class="control-label">Confirme email</label>
				    <div class="">
				      <input type="email" class="form-control input-sm" maxlength="60"
				      		 name="mdEmailCfm" id="mdEmailCfm" placeholder="Repita Email" autocomplete="off">
				    </div>
				</div>
				<div class="modal-footer">
		        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		        	<input type="submit" class="btn btn-primary" value="Guardar cambios">
		      	</div>
			</form>
	<!-- Fin del contenido -->
	      </div>

	    </div>
	  </div>
	</div>
<!-- cambiar foto de Perfil -->
	<div class="modal fade" id="mdChangeFoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header text-center">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Cambiar Foto de Perfil</h4>
	      </div>
	      <div class="modal-body">
	<!-- Contenido del Modal -->
			<form id="nuevaFoto" action="../prv/funciones.php?valor=nuevaFoto" method="POST" enctype="multipart/form-data">
				<div id="mdAvatar">
					<div class="form-group">
				  		<label class="control-label" for="fecha_nac">Foto de perfil</label>
				  		<div class="kv-avatar center-block">
				  			<img src="../img/no-avatar.jpg" alt="no-avatar" id="preview-avatar" class="img-thumbnail img-responsive">
				  			<p class="help-block" style="color:rgba(0,0,0,0.7)">Maximo 1MB</p>
				  			<div class="fileInput">
				  				<input class="filestyle input-sm" data-input="false" type="file"
			  				name="imagen" id="imagen" onchange="showMyImage(this)"
			  				style="max-width:147px" data-buttonText="&nbsp; Cargar imagen" data-badge="false">
				  			</div>
				  		</div>
				    </div>
				</div>
				<div class="modal-footer">
	        		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
	        		<input type="submit" class="btn btn-primary" value="Actualizar foto">
	      		</div>
			</form>
	      </div>

	    </div>
	  </div>
	</div>

<!-- Change password -->
	<div class="modal fade" id="mdChangePass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Actualizar contraseña</h4>
	      </div>
	<!-- contenido del modal -->
		<form id="frmChangePass" action="../prv/funciones.php?valor=changePass" method="POST">
			<div class="modal-body">
		        <div id="oldPass" class="form-group">
				    <label for="mdPass" class="control-label">Actual Contraseña</label>
				    <div class="">
				      <input type="password" class="form-control input-sm" maxlength="32" pattern=".{6,32}" required title="6 a 32 caracteres."
				      		 name="mdPass" id="mdPass" placeholder="Contraseña">
				    </div>
				</div>
				<div id="pass" class="form-group">
				    <label for="mdNewPass" class="control-label">Nueva contraseña</label>
				    <div class="">
				      <input type="password" class="form-control input-sm" maxlength="32" pattern=".{6,32}" required title="6 a 32 caracteres."
				      		 name="mdNewPass" id="mdNewPass" placeholder="Repita Contraseña" autocomplete="off">
				    </div>
				</div>
				<div id="cfmPass" class="form-group">
				    <label for="mdPassCfm" class="control-label">Repita contraseña</label>
					    <div class="">
					      	<input type="password" class="form-control input-sm" maxlength="32" pattern=".{6,32}" required title="6 a 32 caracteres."
					      		name="mdPassCfm" id="mdPassCfm" placeholder="Repita Contraseña" autocomplete="off">
					    </div>
					</div>

		      	<!-- fin del contenido del modal -->
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		        	<input type="submit" class="btn btn-primary" value="Cambiar contraseña">
		      	</div>
		    </div>
		</form>


	    </div>
	  </div>
	</div>


<!-- Delete account -->
	<div class="modal fade" id="mdDeleteAccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Precaución</h4>
	      </div>
	      <form id="frmDeleteAccount" action="../prv/funciones.php?valor=deleteAccount" method="POST">
	      	<div class="modal-body" style="text-align:center">
		        <h3>¿Está seguro que desea eliminar su cuenta?</h3>
		        <small>Una vez que elimine la cuenta no podrá volver a iniciar sesión.</small>
		    </div>
		    <div class="modal-footer">
		        <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
		        <input type="submit" class="btn btn-danger" value="Eliminar cuenta">
		    </div>
	      </form>
	    </div>
	  </div>
	</div>

	<!-- Scripts -->
	<script src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/funciones.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap-filestyle.min.js"> </script>
	<script type="text/javascript">
	$( window ).load(function() {
	  cargarPerfil();
	});
	</script>

</body>
</html>

	<?php } else {
		header("Location: ../admin/index.php");
	} ?>
