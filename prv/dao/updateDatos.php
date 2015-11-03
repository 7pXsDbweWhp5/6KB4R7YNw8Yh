<?php

function cambiarPassword($nuevaPass,$id_usuario){
  include('conexion.php');
  $stmt = $con->prepare("UPDATE usuario SET password = ?	WHERE id_usuario = ?");
  mysqli_set_charset($con,"utf8");
  $stmt->bind_param("si",md5($nuevaPass),$id_usuario);
  if($stmt->execute()){
    $valor = true;
  } else {
    $valor = false;
  }
  $stmt->close();
  mysqli_close($con);
  return $valor;
}

function cambiarEmail($nuevoEmail,$id_usuario){
  include('conexion.php');
  $stmt = $con->prepare("UPDATE usuario SET email = ?	WHERE id_usuario = ?");
  mysqli_set_charset($con,"utf8");
  $stmt->bind_param("si",$nuevoEmail,$id_usuario);
  if($stmt->execute()){
    $valor = true;
  } else {
    $valor = false;
  }
  $stmt->close();
  mysqli_close($con);
  return $valor;
}


 ?>
