<?php

    function eliminarCuenta($id_usuario){
      include('conexion.php');
      $stmt = $con->prepare("DELETE FROM usuario WHERE id_usuario = ?");
      $stmt->bind_param("i",$id_usuario);

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
