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
	<link rel="stylesheet" type="text/css" href="../css/hover.css" media="all">
	<title>Mis Publicaciones</title>
</head>
<body>
	<?php include('header.php'); ?>
	


	<!-- Scripts -->
	<script src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/funciones.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>
<?php } else {
	header("Location: ../admin/index.php");
}

?>