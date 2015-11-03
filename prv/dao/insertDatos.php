<?php

// CREAR PUBLICACION
function crearPublicacion($nombreMascota,$edadMascota,$sexoMascota,$raza,$tamano,$vacunas,$desparasitado,
                            $esterilizado,$descripcion,$foto_animal,$tipoPublicacion,$id_usuario){
  //se decidió separar las querys en 2, para no tener las 2 querys en esta misma funcion, ya que aveces
  //chocan las variables de conexion y se traban, por eso mejor trabajarlas de forma externa a la funcion.
  //Pero esta funcion sigue contando como Query (aunque no propiamente tal).
  $insertPublicacion = insertPublicacion($tipoPublicacion,$id_usuario);

  if($insertPublicacion){
    //HACER QUERY PARA OBTENER EL ID DE PUBLICACION QUE SE ACABA DE CREAR.
    $insertAnimal = insertAnimal($nombreMascota,$edadMascota,$sexoMascota,$raza,$tamano,$vacunas,$desparasitado,
                                $esterilizado,$descripcion,$foto_animal);
  }

  if ($insertAnimal){
    return true;
  } elseif (!$insertPublicacion){
    $GLOBALS['msg'] = "<strong> ¡Error! </strong> Ocurrio un problema al intentar guardar la publicacion en la base de datos.";
    return false;
  } elseif (!$insertAnimal){
    $GLOBALS['msg'] = "<strong> ¡Error! </strong> Ocurrio un problema al intentar guardar el animal en la base de datos.";
    return false;
  }

}

function insertPublicacion($tipoPublicacion,$id_usuario){
  include('conexion.php');
  $stmt = $con->prepare("INSERT INTO publicacion (fecha_inicio,fecha_termino,tipo_publicacion,id_usuario) VALUES (?,?,?,?)");

  $fecha_inicio = date("Y-m-d");
  $fecha_termino = new DateTime($fecha_inicio);
  $fecha_termino->modify('+45 days');
  //duda respecto a las fechas. Ojala funcione.
  $stmt->bind_param("ssii",$fecha_inicio,$fecha_termino, $tipoPublicacion, $id_usuario);
  mysqli_set_charset($con,"utf8");
  if($stmt->execute()){
    return true;
  } else {
    return false;
  }
  $stmt->close();
  mysqli_close($con);
}

function insertAnimal($nombreMascota,$edadMascota,$sexoMascota,$raza,$tamano,
                      $vacunas,$desparasitado,$esterilizado,$descripcion,$foto_animal){
  include('conexion.php');
  $stmt = $con->prepare("INSERT INTO animal (nombre,edad,sexo,tamano,esterilizado,
                        desparasitado,vacunas,descripcion,foto,id_publicacion,id_raza) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

  $stmt->bind_param("sisiiiissii",$nombreMascota,$edadMascota,$sexoMascota,$tamano,
                    $esterilizado,$desparasitado,$vacunas,$descripcion,$foto,$id_publicacion,$raza);

  mysqli_set_charset($con,"utf8");
  if($stmt->execute()){
    return true;
  } else {
    return false;
  }
  $stmt->close();
  mysqli_close($con);
}
?>
