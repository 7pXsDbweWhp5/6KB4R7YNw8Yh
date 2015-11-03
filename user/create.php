<?php
	include('../prv/conexion.php');
	session_start();
	if (!isset($_SESSION['id_usuario'])){
		Header("Location: ../login.php");
		exit;
	} else if ($_SESSION['tipo'] == 0){
		?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="../css/navbar.css">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<link rel="stylesheet" type="text/css" href="../css/modals.css">
	<link rel="stylesheet" type="text/css" href="../css/formulario.css">
	<link rel="stylesheet" type="text/css" href="../css/hover.css" media="all">
	<title>Crear publicación</title>
</head>
<body>
	<?php include('header.php'); ?>
	<!-- Formulario crear publicacion -->
	<div class="formulario container">
		<div class="titulo">
			<h1>Crear publicación</h1>
		</div>
		<hr>
		<div class="sub-registro centrado">
			<?php if(isset($_COOKIE['update']) and $_COOKIE['update'] == "true"){ ?>
					<div class="alert alert-<?php echo $_COOKIE['class_alert'] ?> alert-dismissible animated <?php echo $_COOKIE['animacion']?>" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<?php echo $_COOKIE['msg']?>
					</div>
					<?php }
						setcookie("update","false", 0,"/");
						setcookie("class_alert", "", time()-3600,"/");
						setcookie("animacion", "", time()-3600,"/");
						setcookie("msg","", time()-3600, "/");
					?>
			<form action="../prv/funciones.php?valor=crearpub" class="form-inline" method="POST">
				<div class="datos">
					<div class="row">
						<div id="petName" class="form-group">
						    <label for="nombreMascota" class="control-label txt-sdw-gray">Nombre del animal <span style="color:white">*</span></label>
						    <div class="">
						    	<input type="text" class="form-control ancho input-sm" id="nombreMascota" name="nombreMascota"
								placeholder="Nombre del animal">
						    </div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
						    <label for="edad" class="control-label txt-sdw-gray">Edad <span style="color:white">*</span></label>
						    <div>
						    	<select class="form-control ancho input-sm" name="edad" id="edad" >
							      	<option value="0" selected disabled>Seleccione edad</option>
							      	<option value="1">Bebé</option>
							      	<option value="2">Joven</option>
							      	<option value="3">Adulto</option>
							      	<option value="4">Mayor</option>
						      	</select>
						    </div>
						</div>
						<div class="form-group ancho">
							<label for="crtSexo" class="control-label txt-sdw-gray">Sexo <span style="color:white">*</span></label>
							<div id="crtSexo" name="groupSelect" class="btn-group ancho" data-toggle="buttons">
							    <label class="btn btn-default btn-sm">
							    	<input type="radio" name="sexo" value="M" autocomplete="off"> Macho
							    </label>
							    <label class="btn btn-default btn-sm">
							    	<input type="radio" name="sexo" value="H" autocomplete="off"> Hembra
							    </label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
						    <label for="especie" class="control-label txt-sdw-gray">Especie <span style="color:white">*</span></label>
						    <div>
						    	<select class="form-control ancho input-sm" onchange='cargarRazas("create")' name="especie" id="especie">
							      	<?php
										$sql = "SELECT * FROM especie ORDER BY especie ASC";
										$res = mysqli_query($con,$sql); ?>
										<option value="0" disabled selected>Seleccione...</option> <?php
										while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
											echo '<option value="'.$row['id_especie'].'">'.utf8_encode($row['especie']).'</option>';
										}
									?>
							    </select>
						    </div>
						</div>
						<div class="form-group">
						    <label for="raza" class="control-label txt-sdw-gray">Raza <span style="color:white">*</span></label>
						    <div>
						    	<select class="form-control ancho input-sm" name="raza" id="raza">
							      	<option value="0" disabled selected>Seleccione...</option>
						      	</select>
						    </div>

						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<label for="tamano" class="control-label txt-sdw-gray">Tamaño <span style="color:white">*</span></label>
							<div>
								<select class="form-control ancho input-sm" name="tamano" id="tamano">
									<option value="0" disabled selected>Seleccione...</option>
									<option value="1">Pequeño</option>
									<option value="2">Mediano</option>
									<option value="3">Grande</option>
									<option value="4">Muy grande</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="vacunas" class="control-label txt-sdw-gray">¿Tiene vacunas? <span style="color:white">*</span></label>
							<div>
								<select class="form-control ancho input-sm" name="vacunas" id="vacunas">
									<option value="0" disabled selected>Seleccione...</option>
									<option value="1">Si</option>
									<option value="2">No</option>
									<option value="3">No lo sé</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<label for="desparasitado" class="control-label txt-sdw-gray">¿Está desparasitado? <span style="color:white">*</span></label>
							<div>
								<select class="form-control ancho input-sm" name="desparasitado" id="desparasitado">
									<option value="0" disabled selected>Seleccione...</option>
									<option value="1">Si</option>
									<option value="2">No</option>
									<option value="3">No lo sé</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="esterilizado" class="control-label txt-sdw-gray">¿Está esterilizado? <span style="color:white">*</span></label>
							<div>
								<select class="form-control ancho input-sm" name="esterilizado" id="esterilizado">
									<option value="0" disabled selected>Seleccione...</option>
									<option value="1">Si</option>
									<option value="2">No</option>
									<option value="3">No lo sé</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<label for="descripcion" class="control-label txt-sdw-gray">Descripción (opcional):</label>
							<div>
								<textarea class="form-control" rows="5" name="descripcion" id="descripcion" maxlength="180"
								placeholder="Agregue aquí una descripción..."></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="avatar">
					<div class="row">
						<div class="form-group">
					  		<label class="control-label" for="crtFotoAnimal txt-sdw-gray">Foto del animal <span style="color:white">*</span></label>
					  		<div class="kv-avatar center-block">
					  			<img src="../img/no-avatar.jpg" alt="no-avatar" id="preview-avatar" class="img-thumbnail img-responsive">
					  			<p class="help-block" style="color:rgba(0,0,0,0.7)">Maximo 1MB</p>
					  				<input class="filestyle input-sm" data-input="false" type="file"
				  				name="imagen" id="imagen" onchange="showMyImage(this)"
				  				style="max-width:147px" data-buttonText="&nbsp; Cargar imagen" data-badge="false">
					  		</div>
					    </div>
					</div>
					<div id="btn-reg" class="form-group">
							<button type="button" class="btn btn-success btn-style" onclick="cleanTipoPublicacion()"
							data-toggle="modal" data-target="#mdCrearPublicacion">Siguiente</button>
					</div>
				</div>

<!-- Publicación Paso 2 -->
						<div class="modal fade" id="mdCrearPublicacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Creando la publicación...</h4>
						      </div>
										<div id="mdOpciones">
											<div class="btn-group" name="groupSelect" data-toggle="buttons" onchange="cargarPreguntas()">
												<label>Elija el tipo de publicación:</label><br>
												<label id="tpAdopcion" class="btn btn-default btn-sm">
										      <input id="adopcion" type="radio" name="tipoPublicacion" value="0" >Adopción
										    </label>
										    <label id="tpExtraviado" class="btn btn-default btn-sm">
										      <input id="extraviado" type="radio" name="tipoPublicacion" value="1">Extraviado
										    </label>
										    <label id="tpBuscaDueno" class="btn btn-default btn-sm">
										      <input id="buscaDueno" type="radio" name="tipoPublicacion" value="2">Busca a su dueño
										    </label>
										      <input id="rdDefault" type="radio" name="tipoPublicacion" value="3" hidden>
											</div>
										</div>
										<div id="mdPreguntas">
												<!-- Aquí va el cuestionario, si tuviera uno!! >_< -->
										</div>

								    <div class="modal-footer">
								        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
								        <input type="submit" class="btn btn-primary" value="Crear publicación">
								    </div>
						    </div>
						  </div>
						</div>
			</form>
		</div>
	</div>
	<!-- Scripts -->
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/funciones.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap-filestyle.min.js"> </script>
</body>
</html>
<?php } else {
	header("Location: ../admin/index.php");
}

?>
