<?php

function subirFotoAnimal($_FILES,$_POST,$id_usuario){
    $target_file = '""';
    $target_dir = "../user/img_animal/";
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $GLOBALS['msg'] = "<strong> ¡Error! </strong> El archivo no es una imagen.";
            $uploadOk = 0;
            return false;
        }
    }
    // Check file size
    if ($_FILES["imagen"]["size"] > (1000*1024)) {
        $GLOBALS['msg'] = "<strong> ¡Cuidado! </strong>La imagen debe pesar menos de 1Mb.";
        $uploadOk = 0;
        return false;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $GLOBALS['msg'] = "<strong> ¡Error! </strong>Sólo se aceptan formatos JPG, JPEG, PNG y GIF.";
        $uploadOk = 0;
        return false;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        return false;
    // if everything is ok, try to upload file
    } else {
      //guarda la imagen con nombre igual al ID del usuario
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_dir . $id_usuario .".".$imageFileType)) {
          $GLOBALS['foto_animal'] = $target_dir. $id_usuario.".".$imageFileType;
        }
    }
    return true;
  }







 ?>
