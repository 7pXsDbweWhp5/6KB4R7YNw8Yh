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
	<link rel="stylesheet" type="text/css" href="../css/cards.css">
	<link rel="stylesheet" type="text/css" href="../css/filtro.css">
	<link rel="stylesheet" type="text/css" href="../css/hover.css" media="all">
	<title>Bienvenido al home</title>
</head>
<body>
	<?php include('header.php'); ?>


	<div class="container-fluid" style="max-width:1280px">
		<div class="row">
	  		<div class="search-group">
	  			<div class="input-group">
		      		<input type="text" class="form-control search-query" placeholder="Buscar animales...">
		      		<span class="input-group-btn">
		        		<button class="btn btn-primary" type="button">Buscar</button>
		      		</span>
		    	</div>
	  		</div>
		</div>

		<div class="row">
			<div class="col-sm-8 col-md-9 col-lg-9">
				<div class="text-center">
					<div class="card">
						<h1 class="card-title"> Lissa & Gorch </h1>
						<div class="card-header">
							<img src="../img/pub01.jpg" class="card-img-top" alt="Mascota">
							<h5 class="card-race"> Otros </h5>
						</div>
						<div class="card-block">
							<div class="attrib">
								<p>Macho - Pequeño - Joven</p>
								<p>Santiago - Chile</p>
							</div>
							<span class="label label-success"> En Adopción</span>
							<button class="btn btn-primary card-btn btn-xs pull-right">Ver más</button>
						</div>
					</div>
					<div class="card">
						<h1 class="card-title"> Tommy & Tobby </h1>
						<div class="card-header">
							<img src="../img/pub02.jpg" class="card-img-top" alt="Mascota">
							<h5 class="card-race"> Beaggle </h5>
						</div>
						<div class="card-block">
							<div class="attrib">
								<p>Macho - Pequeño - Joven</p>
								<p>Santiago - Chile</p>
							</div>
							<span class="label label-success"> En Adopción</span>
							<button class="btn btn-primary card-btn btn-xs pull-right">Ver más</button>
						</div>
					</div>
					<div class="card">
						<h1 class="card-title"> Alisa </h1>
						<div class="card-header">
							<img src="../img/pub03.jpg" class="card-img-top" alt="Mascota">
							<h5 class="card-race"> Siberiano </h5>
						</div>
						<div class="card-block">
							<div class="attrib">
								<p>Hembra - Pequeño - Joven</p>
								<p>Valparaíso - Chile</p>
							</div>
							<span class="label label-success"> En Adopción</span>
							<button class="btn btn-primary card-btn btn-xs pull-right">Ver más</button>
						</div>
					</div>
					<div class="card">
						<h1 class="card-title"> Carlitos </h1>
						<div class="card-header">
							<img src="../img/pub04.jpg" class="card-img-top" alt="Mascota">
							<h5 class="card-race"> Golden Retriever </h5>
						</div>
						<div class="card-block">
							<div class="attrib">
								<p>Macho - Pequeño - Joven</p>
								<p>Quilpué - Chile</p>
							</div>
							<span class="label label-success"> En Adopción</span>
							<button class="btn btn-primary card-btn btn-xs pull-right">Ver más</button>
						</div>
					</div>
					<div class="card">
						<h1 class="card-title"> Juanito </h1>
						<div class="card-header">
							<img src="../img/sebusca.jpg" class="card-img-top" alt="Mascota">
							<h5 class="card-race"> Quiltro </h5>
						</div>
						<div class="card-block">
							<div class="attrib">
								<p>Macho - Pequeño - Joven</p>
								<p>Quilpué - Chile</p>
							</div>
							<span class="label label-warning"> Extraviado</span>
							<button class="btn btn-primary card-btn btn-xs pull-right">Ver más</button>
						</div>
					</div>
					<div class="card">
						<h1 class="card-title"> Juanito </h1>
						<div class="card-header">
							<img src="../img/sebusca.jpg" class="card-img-top" alt="Mascota">
							<h5 class="card-race"> Quiltro </h5>
						</div>
						<div class="card-block">
							<div class="attrib">
								<p>Macho - Pequeño - Joven</p>
								<p>Quilpué - Chile</p>
							</div>
							<span class="label label-danger"> Se busca dueño</span>
							<button class="btn btn-primary card-btn btn-xs pull-right">Ver más</button>
						</div>
					</div>
					<div class="card">
						<h1 class="card-title"> Juanito </h1>
						<div class="card-header">
							<img src="../img/sebusca.jpg" class="card-img-top" alt="Mascota">
							<h5 class="card-race"> Quiltro </h5>
						</div>
						<div class="card-block">
							<div class="attrib">
								<p>Macho - Pequeño - Joven</p>
								<p>Quilpué - Chile</p>
							</div>
							<span class="label label-warning"> Extraviado</span>
							<button class="btn btn-primary card-btn btn-xs pull-right">Ver más</button>
						</div>
					</div>
					<div class="card">
						<h1 class="card-title"> Juanito </h1>
						<div class="card-header">
							<img src="../img/sebusca.jpg" class="card-img-top" alt="Mascota">
							<h5 class="card-race"> Quiltro </h5>
						</div>
						<div class="card-block">
							<div class="attrib">
								<p>Macho - Pequeño - Joven</p>
								<p>Quilpué - Chile</p>
							</div>
							<span class="label label-danger"> Se busca dueño</span>
							<button class="btn btn-primary card-btn btn-xs pull-right">Ver más</button>
						</div>
					</div>
					<br>

					<nav class="text-center">
					  <ul class="pagination">
					    <li>
					      <a href="#" aria-label="Previous">
					        <span aria-hidden="true">&laquo; Ant</span>
					      </a>
					    </li>
					    <li><a href="#">1</a></li>
					    <li><a href="#">2</a></li>
					    <li><a href="#">3</a></li>
					    <li>
					      <a href="#" aria-label="Next">
					        <span aria-hidden="true">Sig &raquo;</span>
					      </a>
					    </li>
					  </ul>
					</nav>
				</div>
				
			</div>

			<!-- FILTRO DE BUSQUEDA -->
			<div class="col-sm-4 col-md-3 col-lg-3 visible-sm visible-md visible-lg">
				<div class="filtro">
					<h4>Filtrar publicaciones</h4>

					<div>
				    	<label for="filPub" class="control-label">Tipo de publicación</label>
				    	<select class="form-control" name="filPub" id="filPub">
				    		<option value="0" disabled selected>Seleccione...</option>
				    		<option value="1">En adopción</option>
				    		<option value="2">Extraviado</option>
				    		<option value="3">Busca al dueño</option>
				    	</select>
				    </div>

				    <div>
				    	<label for="hmEspecie" class="control-label">Especie</label>
				    	<select class="form-control ancho" name="hmEspecie" id="hmEspecie" onchange='cargarRazas("home")'>
					      	<?php 
								$sql = "SELECT * FROM especie ORDER BY especie ASC";
								$res = mysqli_query($con,$sql);
								echo '<option value="0" disabled selected>Seleccione...</option>';
								while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
									echo '<option value="'.$row['id_especie'].'">'.utf8_encode($row['especie']).'</option>';
								}
							?>
					    </select>
				    </div>
				    
				    <div>
				    	<label for="hmRaza" class="control-label">Raza</label>
				    	<select class="form-control ancho" name="hmRaza" id="hmRaza">
					      	<option value="0" disabled selected>Seleccione...</option>
				      	</select>
				    </div>

				    <div>
				    	<label for="filSexo" class="control-label">Sexo</label>
				    	<select class="form-control" name="filSexo" id="filSexo">
				    		<option value="0" disabled selected>Seleccione...</option>
				    		<option value="1">Macho</option>
				    		<option value="2">Hembra</option>
				    	</select>
				    </div>

				    <div>
				    	<label for="filEdad" class="control-label">Edad</label>
				    	<select class="form-control" name="filEdad" id="filEdad">
				    		<option value="0" disabled selected>Seleccione...</option>
				    		<option value="2">Bebé</option>
				    		<option value="1">Joven</option>
				    		<option value="2">Adulto</option>
				    		<option value="2">Mayor</option>
				    	</select>
				    </div>

				    <div>
				    	<label for="filTamano" class="control-label">Tamaño</label>
				    	<select class="form-control" name="filTamano" id="filTamano">
				    		<option value="0" disabled selected>Seleccione...</option>
				    		<option value="2">Pequeño</option>
				    		<option value="1">Mediano</option>
				    		<option value="2">Grande</option>
				    		<option value="2">Muy grande</option>
				    	</select>
				    </div>

				    <div>
				    	<label for="filCiudad" class="control-label">Ciudad</label>
				    	<select class="form-control" name="filCiudad" id="filCiudad">
				    		<?php 
								$sql = "SELECT * FROM ciudad WHERE id_pais = '46' ORDER BY ciudad ASC";
								$res = mysqli_query($con,$sql);
								echo '<option value="0" disabled selected>Seleccione...</option>';
								while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){
									echo '<option value="'.$row['id_ciudad'].'">'.utf8_encode($row['ciudad']).'</option>';
								}
							?>
				    	</select>
				    </div>
					<div id="filtrar">
						<button id="probar" class="btn btn-primary btn-sm">Filtrar</button>
					</div>	    
				</div>
			</div>
		</div>
		
	</div>

	<!-- Scripts -->
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/funciones.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>
<?php } else {
	header("Location: ../admin/index.php");
}

?>