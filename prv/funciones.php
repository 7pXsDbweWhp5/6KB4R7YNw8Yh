<?php
// ··························· IMPORTS GLOBALES ·····················
include('validaciones.php');
include('dao/updateDatos.php');
include('dao/getDatos.php');
include('dao/insertDatos.php');
include('dao/deleteDatos.php');
// ··························· INICIAR SESION ·····················

	if($_GET['valor'] == "login"){

	include('conexion.php');
	if (!isset($_SESSION)){
		session_start();
	}

	$email = $_POST['email'];
	$pass = utf8_decode($_POST['pass']);

	$sql = "SELECT id_usuario, nombre, apellidos, direccion, fecha_nac, foto_perfil, sexo, telefono, tipo, id_ciudad
			FROM usuario
			WHERE email = ? and password = ?";

	$stmt = $con->prepare($sql);
	$stmt->bind_param("ss", $email, md5($pass));
	mysqli_set_charset($con,"utf8");

	if ($stmt->execute()){
		$stmt->bind_result($id_usuario,$nombre,$apellidos,$direccion,$fecha_nac,$foto_perfil,$sexo,$telefono,$tipo,$id_ciudad);

		if ($stmt->fetch()) {
			$apellidos = trim($apellidos); //cambia los espacios en blanco por guiones bajos (_);
			$nombre = trim($nombre); //elimina los posibles espacios que tenga la variable
			$apellido = explode(";", $apellidos); //divide los apellidos en 2 segun el separador ";".
			$_SESSION['id_usuario'] = $id_usuario;
			$_SESSION['tipo'] = $tipo;
			$_SESSION['password'] = md5($pass);
			$_SESSION['email'] = $email;
			$_SESSION['direccion'] = $direccion;
			$_SESSION['nombre'] = $nombre;
			$_SESSION['apPaterno'] = $apellido[0];
			$_SESSION['apMaterno'] = $apellido[1];
			$_SESSION['foto_perfil'] = $foto_perfil;
			$_SESSION['telefono'] = (int) $telefono;
			$_SESSION['tipo'] = (int) $tipo;
			$_SESSION['id_ciudad'] = (int) $id_ciudad;
			$_SESSION['sexo'] = $sexo;

			$date = new DateTime($fecha_nac);
			$resDate = $date->format('d-m-Y');
			$resDate = (string) $resDate;
			$_SESSION['day'] = (int) substr($resDate,0,2);
			$_SESSION['month'] = (int) substr($resDate,3,2);
			$_SESSION['year'] = (int) substr($resDate,6,4);
		}
		$stmt->close();

		$sql = "SELECT id_pais
				FROM ciudad
				WHERE id_ciudad = ?";

		$prst = $con->prepare($sql);
		$prst->bind_param("i",$id_ciudad);

		if($prst->execute()){
			$prst->bind_result($id_pais);
			if($prst->fetch()){
				$_SESSION['id_pais'] = (int) $id_pais;
			}
		}
		$prst->close();

		if ($tipo == 0){
			header("Location: ../user/home.php");
		} else if ($tipo == 1){
			header("Location: ../admin/index.php");
		} else {
			echo "Tu cuenta ha sido desactivada";
		}
		setcookie("update", "false", 0, "/");

	}

	if (!isset($_SESSION['id_usuario'])) {
		$msg = "<strong> ¡Error! </strong> El email o la contraseña son incorrectos.";
		setcookie("class_alert", "danger", 0, "/");
		setcookie("animacion", "shake", 0, "/");
		setcookie("msg",$msg,0,"/");
		setcookie("update", "true", 0, "/");
		header("Location: ../login.php");
	}

	mysqli_close($con);

	}

// ··························· DESCONECTARSE ·····················


	if($_GET['valor'] == "disconnect"){
		include('conexion.php');
		if(!isset($_SESSION)){
			session_start();
		}

		if(isset($_SESSION['id_usuario'])){
			session_destroy();
			setcookie("update","",time() - 3600, "/");
			setcookie("class_alert","",time() - 3600, "/");
			echo '<script type="text/javascript">
				alert("Ha cerrado sesión satisfactoriamente.")
				self.location = "../index.html"
				</script>';
		}
		mysqli_close($con);
	}

// ··························· RECUPERAR CONTRASEÑA ·····················

	if($_GET['valor'] == "requestPwd"){

		include('conexion.php');
		$email = rawurldecode($_POST['email']);
		$pass = generatePassword();
		$sql = "UPDATE usuario SET password = '".md5($pass)."' WHERE email = '".$email."'";

		mysqli_set_charset($con,"utf8");
		mysqli_query($con,$sql);

		if (mysqli_affected_rows($con) == 0) {
			$msg = "<strong> ¡Error! </strong> El email ingresado no existe o está incorrecto.";
			setcookie("class_alert", "danger", 0, "/");
			setcookie("animacion", "shake", 0, "/");
			setcookie("msg",$msg,0,"/");
			setcookie("update", "true", 0, "/");
			header("Location: ../login.php");
		} else {
			mysqli_set_charset($con,"utf8");
			$sql = "SELECT nombre,apellidos FROM usuario WHERE email = '".$email."'";
			$res = mysqli_query($con,$sql);
			$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

			$apellidos = str_replace(";", " ", $row['apellidos']);
			$to = $email;
			$subject = "Recuperar contraseña";

			$message = '<!DOCTYPE html>
						<html lang="en">
						<head>
							<meta charset="UTF-8">
							<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
							<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
							<title>Recuperar contraseña</title>
						</head>
						<body>
							<div style="width: 100%;
							 	max-width: 768px;
							 	height: 100%;
							 	margin:auto;
							 	text-align: center;	padding:0;" class="container">
								<a href="http://adoptame.esy.es/login.php"><img src="http://i.imgur.com/ee2zwYD.png"   alt="Recuperar contraseña"></a>
								<div>
									<h3 style="margin:0">Estimado: '.$row['nombre']." ".$apellidos.'</h3>
									<h4>Tu <strong> nueva </strong> contraseña es: '.$pass.'</h4>
									<small>Recuerda que debes cambiar tu contraseña en tu perfil</small>
									<br><br>
									<a href="http://adoptame.esy.es/login.html"><img src="http://i.imgur.com/RNEKjUa.png" alt="Iniciar sesión"></a>
									<br><br><br>


									<small>Este email ha sido enviado de forma automática por petición del usuario.</small>
								</div>
							</div>
						</body>
						</html>';

			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= 'From: <no-responder@adopta.cl>' . "\r\n";

			mail($to,$subject,$message,$headers);

			echo '<script type="text/javascript">
				alert("Contrasena enviada al correo electronico.")
				self.location = "../login.php"
				</script>';
		}
		mysqli_close($con);
	}

// ··························· REGISTRO DE USUARIO ·····················

	if($_GET['valor']=="register"){
		include('conexion.php');

		$nombre = ucwords(mb_strtolower($_POST['name'], "UTF-8"));
		$apellidos = ucwords(mb_strtolower($_POST['apPaterno'], "UTF-8")). ";" .ucwords(mb_strtolower($_POST['apMaterno'], "UTF-8"));
		$email = strtolower($_POST['email']);
		$cfmEmail = strtolower($_POST['emailCfm']);
		$pass = $_POST['pass'];
		$cfmPass = $_POST['passCfm'];
		$telefono = $_POST['telefono'];
		$direccion = ucwords(mb_strtolower($_POST['direccion'], "UTF-8"));
		$fechaNac = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['year']."-".$_POST['month']."-".$_POST['day'])));
		$sexo = $_POST['sexo'];
		$tipo = 0;
		$foto_perfil = "../img/no-avatar.jpg";
		$ciudad = $_POST['ciudad'];
		$pais = $_POST['pais'];
		$day = $_POST['day'];
		$month = $_POST['month'];
		$year = $_POST['year'];
		$apPaterno = $_POST['apPaterno'];
		$apMaterno = $_POST['apMaterno'];

		//inicialización de variables.
		$form_valido = validarRegistro(	$nombre,$apPaterno,$apMaterno,$email,$cfmEmail,$pass,$cfmPass, $pais,
										$telefono,$direccion,$day,$month,$year,$sexo, $ciudad);

		$sql = "SELECT nombre
					FROM usuario
					WHERE email = ?";

		$prst = $con->prepare($sql);
		$prst->bind_param("s",rawurldecode($email));
		mysqli_set_charset($con,"utf8");

		if($prst->execute()){
			$prst->bind_result($result);
			if($prst->fetch()){
				$msg = "<strong> ¡Error! </strong> El email ingresado (".rawurldecode($email).") ya existe!";
				$form_valido = false;
			}
		}
		$prst->close();

		if (!$form_valido) {
			setcookie("class_alert", "danger", 0, "/");
			setcookie("animacion", "shake", 0, "/");
			setcookie("msg",$msg,0,"/");
			setcookie("update", "true", 0, "/");
			header("Location: ../register.php");
		} else {
			include('conexion.php');
			$target_file = '""';

			if (is_uploaded_file($_FILES['imagen']['tmp_name'])){
				$target_dir = "../user/img/";
				$target_file = $target_dir . basename($_FILES["imagen"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
				    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
				    if($check !== false) {
				        $uploadOk = 1;
				    } else {
				        $msg = "<strong> ¡Error! </strong> El archivo no es una imagen.";
				        $uploadOk = 0;
				        $form_valido = false;
				    }
				}
				// Check file size
				if ($_FILES["imagen"]["size"] > (1000*1024)) {
				    $msg = "<strong> ¡Cuidado! </strong>La imagen debe pesar menos de 1Mb.";
				    $uploadOk = 0;
				    $form_valido = false;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				    $msg = "<strong> ¡Error! </strong>Sólo se aceptan formatos JPG, JPEG, PNG y GIF.";
				    $uploadOk = 0;
				    $form_valido = false;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				    $form_valido = false;
				// if everything is ok, try to upload file
				} else {
					//guarda la imagen con nombre igual al ID del usuario
				    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_dir . md5($email) .".".$imageFileType)) {
				    	$foto_perfil = $target_dir. md5($email).".".$imageFileType;
				    }
				}
			}

			$stmt = $con->prepare("INSERT INTO usuario (nombre,apellidos,email,telefono,direccion,fecha_nac,sexo,password,tipo,foto_perfil,id_ciudad)
								VALUES (?,?,?,?,?,?,?,?,?,?,?)");

			$stmt->bind_param("sssissssisi",$nombre,$apellidos,	$email,$telefono,$direccion,$fechaNac,$sexo,md5($pass),$tipo,$foto_perfil,$ciudad);
			mysqli_set_charset($con,"utf8");
			if($stmt->execute()){
				$msg = "<strong> ¡Felicitaciones! </strong> Tu cuenta ha sido registrada satisfactoriamente. Ya puedes iniciar sesión.";
				setcookie("class_alert", "success", 0, "/");
				setcookie("animacion", "fadeIn", 0, "/");
				setcookie("msg",$msg,0,"/");
				setcookie("update", "true", 0, "/");
				header("Location: ../login.php");
			} else {
				$msg = "<strong> ¡Lo sentimos! </strong> Ha ocurrido un error inesperado. Intente nuevamente.";
				setcookie("class_alert", "danger", 0, "/");
				setcookie("animacion", "shake", 0, "/");
				setcookie("msg",$msg,0,"/");
				setcookie("update", "true", 0, "/");
				header("Location: ../register.php");
			}

			$stmt->close();
			mysqli_close($con);

		}
	}

// ··························· CARGAR CIUDADES O RAZAS A LOS COMBOBOX ·····················



	if ($_GET['valor'] == "ciudades"){
		include('conexion.php');
		if(!isset($_SESSION)){
			session_start();
		}
		mysqli_set_charset($con,"utf8");
		$sql = "SELECT * FROM ciudad WHERE id_pais = ".$_GET['id']." ORDER BY ciudad ASC";
		$res = mysqli_query($con,$sql);
		echo '<option value = 0 hidden>Seleccione...</option>';
		while($row=mysqli_fetch_array($res)){
			if($_GET['id_ciudad'] == $row['id_ciudad']){
				echo '<option value="'.$row['id_ciudad'].'" selected>'.$row['ciudad'].'</option>';
			} else {
				echo '<option value="'.$row['id_ciudad'].'">'.$row['ciudad'].'</option>';
			}

		}
		mysqli_close($con);

	} elseif ($_GET['valor'] == "razas"){
		include('conexion.php');
		mysqli_set_charset($con,"utf8");
		$sql = "SELECT * FROM raza WHERE id_especie = ".$_GET['id']." ORDER BY raza ASC";
		mysqli_set_charset($con,"utf8");
		$res = mysqli_query($con,$sql);
		echo '<option value = 0 >Seleccione...</option>';
		while($row=mysqli_fetch_array($res)){
			echo '<option value="'.$row['id_raza'].'">'.$row['raza'].'</option>';
		}
		mysqli_close($con);
	} elseif ($_GET['valor'] == "ciudadesPerfil"){
		include('conexion.php');
		if(!isset($_SESSION)){
			session_start();
		}
		mysqli_set_charset($con,"utf8");
		$sql = "SELECT * FROM ciudad WHERE id_pais = ".$_SESSION['id_pais']." ORDER BY ciudad ASC";
		$res = mysqli_query($con,$sql);
		echo '<option value = 0 hidden>Seleccione...</option>';
		while($row=mysqli_fetch_array($res)){
			if($_SESSION['id_ciudad'] == $row['id_ciudad']){
				echo '<option value="'.$row['id_ciudad'].'" selected>'.$row['ciudad'].'</option>';
			} else {
				echo '<option value="'.$row['id_ciudad'].'">'.$row['ciudad'].'</option>';
			}

		}
		mysqli_close($con);
	}


// ··························· EDITAR DATOS DE PERFIL ·····················

	if ($_GET['valor'] == "perfil"){
		include('conexion.php');

		if(!isset($_SESSION)){
			session_start();
		}

		$id_usuario = $_SESSION['id_usuario'];
		$form_valido = true;

		$nombre = ucwords(strtolower($_POST['name']));
		$apPaterno = ucwords(strtolower($_POST['apPaterno']));
		$apMaterno = ucwords(strtolower($_POST['apMaterno']));
		$telefono = $_POST['telefono'];
		$direccion = ucwords(strtolower($_POST['direccion']));
		$sexo = $_POST['sexo'];
		$day = $_POST['day'];
		$month = $_POST['month'];
		$year = $_POST['year'];
		$pais = $_POST['pais'];
		$ciudad = $_POST['ciudad'];


		if(!checkdate($month,$day,$year)){
			$form_valido = false;
			$msg = "<strong> ¡Error! </strong>La fecha seleccionada es inválida.";
		}

		if(!preg_match("/^[a-zA-Z ñÑáÁéÉíÍóÓúÚ]*$/",$nombre)){
			$form_valido = false;
			$msg = "<strong> ¡Advertencia! </strong>El nombre sólo puede contener letras o espacios.";
		} else if (empty($nombre)){
			$form_valido = false;
			$msg = "<strong> ¡Cuidado! </strong>El nombre es requerido.";
		}

		if(!preg_match("/^[a-zA-Z ñÑáÁéÉíÍóÓúÚ]*$/",$apPaterno)){
			$form_valido = false;
			$msg = "<strong> ¡Advertencia! </strong>El apellido paterno sólo puede contener letras o espacios.";
		} else if (empty($apPaterno)){
			$form_valido = false;
			$msg = "<strong> ¡Cuidado! </strong>El apellido paterno es requerido.";
		}

		if(!preg_match("/^[a-zA-Z ñÑáÁéÉíÍóÓúÚ]*$/",$apMaterno)){
			$form_valido = false;
			$msg = "<strong> ¡Advertencia! </strong>El apellido materno sólo puede contener letras o espacios.";
		} else if (empty($apMaterno)){
			$form_valido = false;
			$msg = "<strong> ¡Cuidado! </strong>El apellido materno es requerido.";
		}

		if(!is_numeric($pais) || $pais == 0){
			$form_valido = false;
			$msg = "<strong> ¡Error inesperado! </strong>Por favor seleccione su país.";
		}

		if(!is_numeric($ciudad) || $ciudad == 0){
			$form_valido = false;
			$msg = "<strong> ¡Advertencia! </strong>Por favor seleccione su ciudad.";
		}

		if(!empty($telefono) && !is_numeric($telefono)){
			$form_valido = false;
			$msg = "<strong> ¡Cuidado! </strong>El telefono debe contener sólo números.";
		} else if (!empty($telefono) && strlen($telefono)<8){
			$form_valido = false;
			$msg = "<strong> ¡Error! </strong>El telefono debe contener 8 números.";
		}

		if($form_valido == true){
			$apellidos = $apPaterno.";".$apMaterno;
			$fecha_nac = date("Y-m-d",strtotime((string) $year."-".$month."-".$day));

			$stmt = $con->prepare("UPDATE usuario
									SET nombre = ?, apellidos = ?, direccion = ?, sexo = ?, fecha_nac = ?,
									 	id_ciudad = ?, telefono = ?
									WHERE id_usuario = ?");
			$stmt->bind_param("sssssiii",$nombre, $apellidos, $direccion, $sexo, $fecha_nac, $ciudad, $telefono, $id_usuario);

			mysqli_set_charset($con,"utf8");

			if($stmt->execute()){

				$_SESSION['nombre'] = trim($nombre);
				$_SESSION['apPaterno'] = trim($apPaterno);
				$_SESSION['apMaterno'] = trim($apMaterno);
				$_SESSION['sexo'] = $sexo;
				$_SESSION['direccion'] = $direccion;
				$_SESSION['telefono'] = (int) $telefono;
				$_SESSION['id_ciudad'] = (int) $ciudad;
				$_SESSION['id_pais'] = (int) $pais;
				$date = new DateTime($fecha_nac);
				$resDate = $date->format('d-m-Y');
				$resDate = (string) $resDate;
				$_SESSION['day'] = (int) substr($resDate,0,2);
				$_SESSION['month'] = (int) substr($resDate,3,2);
				$_SESSION['year'] = (int) substr($resDate,6,4);

				setcookie("class_alert", "success", 0, "/");
				setcookie("animacion", "fadeIn", 0, "/");
				$msg = "<strong> ¡Felicidades! </strong>Los datos han sido actualizados correctamente.";
			} else {
				$msg = "<strong> ¡Error! $sql</strong> ". mysqli_error($con);
			}

			$stmt->close();
		} else {
			setcookie("class_alert", "danger", 0, "/");
			setcookie("animacion", "shake", 0, "/");
		}

		setcookie("msg",$msg,0,"/");
		setcookie("update", "true", 0, "/");
		header("Location: ../user/perfil.php");
		mysqli_close($con);
	}

// ··························· CAMBIAR FOTO DE PERFIL ·····················

	if($_GET['valor'] == "nuevaFoto"){
		include('conexion.php');

		if(!isset($_SESSION)){
			session_start();
		}
		$id_usuario = $_SESSION['id_usuario'];
		$email = md5($_SESSION['email']);
		$form_valido = true;
		setcookie("class_alert", "success", 0, "/");
		setcookie("animacion", "fadeIn", 0, "/");
		$msg = "<strong> ¡Felicidades! </strong>La foto de perfil ha sido actualizada correctamente.";
		$target_file = '""';

		if (is_uploaded_file($_FILES['imagen']['tmp_name'])){
			$target_dir = "../user/img/";
			$target_file = $target_dir . basename($_FILES["imagen"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
			    if($check !== false) {
			        $uploadOk = 1;
			    } else {
			        $msg = "<strong> ¡Error! </strong> El archivo no es una imagen.";
			        $uploadOk = 0;
			        $form_valido = false;
			    }
			}
			// Check file size
			if ($_FILES["imagen"]["size"] > (1000*1024)) {
			    $msg = "<strong> ¡Cuidado! </strong>La imagen debe pesar menos de 1Mb.";
			    $uploadOk = 0;
			    $form_valido = false;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    $msg = "<strong> ¡Error! </strong>Sólo se aceptan formatos JPG, JPEG, PNG y GIF.";
			    $uploadOk = 0;
			    $form_valido = false;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    $form_valido = false;
			// if everything is ok, try to upload file
			} else {
				//guarda la imagen con nombre igual al ID del usuario
			    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_dir.$email.".".$imageFileType)) {
			    	$target_file = $target_dir.$email.".".$imageFileType;
			        $msg = "<strong> ¡Felicidades! </strong> La foto de perfil ha sido actualizada correctamente.";
			    } else {
			    	setcookie("class_alert", "danger", 0, "/");
			    	setcookie("animacion", "shake", 0, "/");
			    	$msg = "<strong> ¡Hubo un error inesperado! </strong>No se ha subido la imagen.";
			    	$form_valido = false;
			    }
			}

			if($form_valido){

				$stmt = $con->prepare("UPDATE usuario SET foto_perfil = ? WHERE id_usuario = ?");
				$stmt->bind_param("si",$target_file,$id_usuario);
				mysqli_set_charset($con,"utf8");

				if($stmt->execute()){
					$_SESSION['foto_perfil'] = $target_file;
				} else {
					$msg = "<strong> ¡Error! </strong> ". mysqli_error($con);
				}
				$stmt->close();

			} else {
				setcookie("class_alert", "danger", 0, "/");
				setcookie("animacion", "shake", 0, "/");
			}

		} else {
			setcookie("class_alert", "warning", 0, "/");
			$msg = "<strong> ¡Advertencia! </strong> La imagen no se ha subido";
		}


		setcookie("msg",$msg,0,"/");
		setcookie("update", "true", 0, "/");
		header("Location: ../user/perfil.php");
		mysqli_close($con);
	}


// ··························· CAMBIAR CONTRASEÑA ·····················

	if ($_GET['valor'] == "changePass"){
		if(!isset($_SESSION)){
			session_start();
		}
		//inicialización de variables.
		$id_usuario = $_SESSION['id_usuario'];
		$password = $_SESSION['password']; //esta password está encriptada en md5
		$oldPass = md5($_POST['mdPass']);
		$nuevaPass = $_POST['mdNewPass'];
		$nuevaPassCfm = $_POST['mdPassCfm'];
		setcookie("class_alert", "danger", 0, "/");
		setcookie("animacion", "shake", 0, "/");

		$form_valido = validarCambioPass($oldPass,$nuevaPass,$nuevaPassCfm,$password);

		if ($form_valido){
			$msg = "<strong> Felicidades! </strong> La contraseña ha sido actualizada correctamente.";
			$result = cambiarPassword($nuevaPass,$id_usuario);
			if ($result){
				setcookie("class_alert", "success", 0, "/");
		    setcookie("animacion", "fadeIn", 0, "/");
		    $_SESSION['password'] = md5($nuevaPass);
			} else {
				$msg = "<strong> ¡Error inesperado! </strong> No se pudo actualizar la contraseña.";
			}
		}

		setcookie("update", "true", 0, "/");
		setcookie("msg",$msg,0,"/");
		header("Location: ../user/perfil.php");
	}

// ··························· CAMBIAR EMAIL ·····················

	if ($_GET['valor'] == "changeEmail"){
		if(!isset($_SESSION)){
			session_start();
		}
		//inicialización de variables.
		$id_usuario = $_SESSION['id_usuario'];
		$nuevoEmail = strtolower($_POST['mdEmail']);
		$nuevoEmailCfm = strtolower($_POST['mdEmailCfm']);
		setcookie("class_alert", "danger", 0, "/");
		setcookie("animacion", "shake", 0, "/");

		//validaciones
		$form_valido = validarEmails($nuevoEmail,$nuevoEmailCfm);
		if ($form_valido){
			$result = cambiarEmail($nuevoEmail,$id_usuario);
			if($result){
				$msg = "<strong> Felicidades! </strong> El email ha sido actualizado correctamente.";
				setcookie("class_alert", "success", 0, "/");
				setcookie("animacion", "fadeIn", 0, "/");
				$_SESSION['email'] = $nuevoEmail;
			} else {
				$msg = "<strong> ¡Error! </strong> El email ingresado ya existe.";
			}
		}
		setcookie("update", "true", 0, "/");
		setcookie("msg",$msg,0,"/");
		header("Location: ../user/perfil.php");
	}

// ··························· Cargar respuestas en cuestionario ·····················

	if($_GET['valor'] == "respuestas"){
		$arreglo = getArrayResp($_GET['id']);
		foreach($arreglo as $value){
			echo $value;
		}
	}

// ··························· ELIMINAR CUENTA ·····················

	if ($_GET['valor'] == "deleteAccount"){
		if(!isset($_SESSION)){
			session_start();
		}
		$id_usuario = $_SESSION['id_usuario'];
		$result = eliminarCuenta($id_usuario);
		if($result){
			session_destroy();
			setcookie("update","",time() - 3600, "/");
			setcookie("class_alert","",time() - 3600, "/");
			header("Location: ../index.html");
		}
	}

// ······················ CREAR PUBLICACION ·····················

	if($_GET['valor'] == "crearPub"){
		if(!isset($_SESSION)){
			session_start();
		}
		//inicializacion de variables
		$nombreMascota = strtolower($_POST['nombreMascota']);
		$edadMascota = $_POST['edad'];
		$sexoMascota = $_POST['sexo'];
		$especie = $_POST['especie'];
		$raza = $_POST['raza'];
		$tamano = $_POST['tamano'];
		$vacunas = $_POST['vacunas'];
		$desparasitado = $_POST['desparasitado'];
		$esterilizado = $_POST['esterilizado'];
		$descripcion = strtolower($_POST['descripcion']);
		$tipoPublicacion = $_POST['tipoPublicacion'];
		$foto_animal = "";
		$id_usuario = $_SESSION['id_usuario'];

		if ($tipoPublicacion == 0){
			//Cuestionario

			$preg1 = $_POST['preg1'];
			$preg2 = $_POST['preg2'];
			$preg3 = $_POST['preg3'];
			$preg4 = $_POST['preg4'];
			$preg5 = $_POST['preg5'];
			$preg6 = $_POST['preg6'];

			$resp1 = $_POST['resp1'];
			$resp2 = $_POST['resp2'];
			$resp3 = $_POST['resp3'];
			$resp4 = $_POST['resp4'];
			$resp5 = $_POST['resp5'];
			$resp6 = $_POST['resp6'];

			$preguntas = array($preg1,$preg2,$preg3,$preg4,$preg5,$preg6);
			$respuestas = array($resp1,$resp2,$resp3,$resp4,$resp5,$resp6);
		}

		setcookie("class_alert", "danger", 0, "/");
		setcookie("animacion", "shake", 0, "/");

		$form_valido = validarPublicacion($nombreMascota,$edadMascota,$sexoMascota,$especie,
										$raza,$tamano,$vacunas,$desparasitado,$esterilizado,$descripcion,$tipoPublicacion);

		if (is_uploaded_file($_FILES['imagen']['tmp_name'])){
			$foto_valida = subirFotoAnimal($_FILES,$_POST,$id_usuario);
		}

		if ($form_valido && $foto_valida){
			if ($tipoPublicacion != 0) {
				$result = crearPublicacion($nombreMascota,$edadMascota,$sexoMascota,$raza,$tamano,$vacunas,$desparasitado,
																		$esterilizado,$descripcion,$foto_animal,$tipoPublicacion,$id_usuario); //Query Insert en dao.
				if($result){
					$msg = "<strong> ¡Felicidades! </strong>La publicacion ha sido creada satisfactoriamente.";
					setcookie("class_alert", "success", 0, "/");
					setcookie("animacion", "fadeIn", 0, "/");
				} else {
					$msg = "<strong> ¡Error! </strong> Ha ocurrido un problema al crear la publicación.";
				}
			} else {
				$cuestionarioValido = validarCuestionario($preguntas, $respuestas);
				if ($cuestionarioValido){
					$result = crearPublicacion(); //Insert Query en dao.
					if ($result){
						$res = crearCuestionario(); //Insert Query en dao.
						if($res){
								$msg = "<strong> ¡Felicidades! </strong> La publicacion y el cuestionario han sido creados satisfactoriamente.";
						}
					} else {
						$msg = "<strong> ¡Error! </strong> Ocurrio un problema al crear la publicación.";
					}
				} else {
					//envio alerta de error en el cuestionario
				}
			}
		} else {
			//mostrar mensaje de error de campos o foto
		}

		setcookie("update", "true", 0, "/");
		setcookie("msg",$msg,0,"/");
		if ($_COOKIE['class_alert'] == "success"){
			header("Location: ../user/publicaciones.php");
		} else {
			header("Location: ../user/create.php");
		}
	}

// ························ GENERAR PASSWORD  ·····················

	function generatePassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }
    return $result;
}

?>
