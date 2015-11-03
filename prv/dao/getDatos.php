<?php
// Obtiene las respuestas que corresponden a cada pregunta por medio de una id pregunta.
    function getArrayResp($id_pregunta){

      include('conexion.php');
      $sql = "SELECT id_respuesta FROM preg_resp WHERE id_pregunta = ? ORDER BY id_respuesta DESC";
      mysqli_set_charset($con,"utf8");
      $stmt = $con->prepare($sql);
      $stmt->bind_param("i",$id_pregunta);
      if($stmt->execute()){
        $stmt->bind_result($id_resp);
        while($stmt->fetch()){
            $respArray[] = getRespuestas($id_resp); //Se van agregando las "options" al arreglo.
        }
        $stmt->close();
        mysqli_close($con);
      }
      return $respArray;
    }
// devuelve cada row del arreglo para posteriormente retornarlo a la vista
    function getRespuestas($id_resp){
      include('conexion.php');
      $sql = "SELECT respuesta FROM respuesta WHERE id_respuesta = ?";
      mysqli_set_charset($con,"utf8");
      $prst = $con->prepare($sql);
      $prst->bind_param("i",$id_resp);
      if($prst->execute()){
        $prst->bind_result($resp);
        if($prst->fetch()){
              return '<option value="'.$id_resp.'">'.$resp.'</option>';
        }
        $prst->close();
      }
      mysqli_close();
    }
 ?>
