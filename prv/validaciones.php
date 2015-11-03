<?php

    function validarRegistro($nombre,$apPaterno,$apMaterno,$email,$cfmEmail,$pass,$cfmPass, $pais,$telefono,
      $direccion,$day,$month,$year,$sexo, $ciudad){

      $regex = "/^[a-zA-Z ñÑáÁéÉíÍóÓúÚ]*$/";

      if(!preg_match($regex,$nombre)){
        $GLOBALS['msg'] = "<strong> ¡Cuidado! </strong>El nombre sólo puede contener letras o espacios.";
        return false;
      } else if (empty($nombre)){
        $GLOBALS['msg'] = "<strong> ¡Advertencia! </strong>El nombre es requerido.";
        return false;
      }

      if(!preg_match($regex,$apPaterno)){
        $GLOBALS['msg'] = "<strong> ¡Cuidado! </strong>El apellido paterno sólo puede contener letras o espacios.";
        return false;
      } else if (empty($apPaterno)){
        $GLOBALS['msg'] = "<strong> ¡Advertencia! </strong>El apellido paterno es requerido.";
        return false;
      }

      if(!preg_match($regex,$apMaterno)){
        $GLOBALS['msg'] = "<strong> ¡Cuidado! </strong>El apellido materno sólo puede contener letras o espacios.";
        return false;
      } else if (empty($apMaterno)){
        $GLOBALS['msg'] = "<strong> ¡Advertencia! </strong>El apellido materno es requerido.";
        return false;
      }

      if($sexo != 'F' && $sexo != 'M'){
        $GLOBALS['msg'] = "<strong> ¡Advertencia! </strong>Por favor seleccione su sexo.";
        return false;
      }

      if(!checkdate($month,$day,$year)){
        $GLOBALS['msg'] = "<strong> ¡Error! </strong> La fecha seleccionada es inválida.";
        return false;
      }

      if(!is_numeric($pais) || $pais == 0){
        $GLOBALS['msg'] = "<strong> ¡Advertencia! </strong> Por favor seleccione su país.";
        return false;
      }

      if(!is_numeric($ciudad) || $ciudad == 0){
        $GLOBALS['msg'] = "<strong> ¡Advertencia! </strong>Por favor seleccione su ciudad.";
        return false;
      }

      if(!empty($telefono) && !is_numeric($telefono)){
        $GLOBALS['msg'] = "<strong> ¡Cuidado! </strong>El telefono debe contener sólo números.";
        return false;
      } else if (!empty($telefono) && strlen($telefono)<8){
        $GLOBALS['msg'] = "<strong> ¡Error! </strong>El telefono debe contener 8 números.";
        return false;
      }

      if(empty($email) || empty($cfmEmail)){
        $GLOBALS['msg'] = '<strong> ¡Hubo un problema! </strong>Por favor, ingrese el email.';
        return false;
      } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $GLOBALS['msg'] = '<strong> ¡Hubo un problema! </strong>El email no es válido.';
        return false;
      } else if ($email != $cfmEmail){
        $GLOBALS['msg'] = '<strong> ¡Hubo un problema! </strong>Los correos ingresado no coinciden.';
        return false;
      }

      if (empty($pass) || empty($cfmPass)){
        $GLOBALS['msg'] = "<strong> ¡Error! </strong> Debe ingresar y confirmar contraseña.";
        return false;
      }else if (strlen($pass) < 6 && strlen($pass) > 32){
        $GLOBALS['msg'] = "<strong> ¡Error! </strong> La contraseña debe contener entre 6 y 30 caracteres.";
        return false;
      }else if ($pass != $cfmPass){
        $GLOBALS['msg'] = "<strong> ¡Hubo un problema! </strong> Las contraseñas no coinciden.";
        return false;
      }
      return true;
    }


    function validarCambioPass($oldPass,$nuevaPass,$nuevaPassCfm,$password){
  		if (empty($oldPass)){
  			$GLOBALS['msg'] = "<strong> ¡Advertencia! </strong> Falta ingresar la antigua contraseña.";
        return false;
  		} else if ($oldPass != $password){
  			$GLOBALS['msg'] = "<strong> ¡Advertencia! </strong> La contraseña ingresada no corresponde con la actual.";
  			return false;
  		}

  		if (empty($nuevaPass) || empty($nuevaPassCfm)){
  			$GLOBALS['msg'] = "<strong> ¡Cuidado! </strong> Debe ingresar la nueva contraseña.";
  			return false;
  		} else if (strlen($nuevaPass) < 6 || strlen($nuevaPass) > 32){
  			$GLOBALS['msg'] = "<strong> ¡Error! </strong> La contraseña debe tener entre 6 y 32 caracteres.";
  			return false;
  		} else if (strlen($nuevaPassCfm) < 6 || strlen($nuevaPassCfm) > 32){
  			$GLOBALS['msg'] = "<strong> ¡Error! </strong> La contraseña confirmada debe tener entre 6 y 32 caracteres.";
  		  return false;
  		} else if ($nuevaPass != $nuevaPassCfm){
  			$GLOBALS['msg'] = "<strong> ¡Error! </strong> Las contraseñas no coinciden.";
  			return false;
  		}
      return true;
    }

    function validarEmails($nuevoEmail,$nuevoEmailCfm){
      if (empty($nuevoEmail)){
        $GLOBALS['msg'] = "<strong> ¡Error! </strong> Por favor ingrese el email.";
  			return false;
      } else if(empty($nuevoEmailCfm)){
        $GLOBALS['msg'] = "<strong> ¡Error! </strong> Por favor confirme el email.";
  			return false;
      } else if ($nuevoEmail != $nuevoEmailCfm){
  			$GLOBALS['msg'] = "<strong> ¡Cuidado! </strong>Los emails no coinciden.";
  			return false;
  		} elseif (!filter_var($nuevoEmail, FILTER_VALIDATE_EMAIL)){
  			$GLOBALS['msg'] = "<strong> ¡Error de formato! </strong> Por favor reingrese el email.";
  			return false;
  		}
      return true;
    }

    function validarPublicacion($nombreMascota,$edadMascota,$sexoMascota,$especie,$raza,
                                $tamano,$vacunas,$desparasitado,$esterilizado,$descripcion){

        $regex = "/^[a-zA-Z ñÑáÁéÉíÍóÓúÚ]*$/";

        if (empty($nombreMascota)){
          $GLOBALS['msg'] = "<strong> ¡Error! </strong> Por favor ingrese el email.";
          return false;
        } else if(!preg_match($regex,$nombreMascota)){
          $GLOBALS['msg'] = "<strong> ¡Cuidado! </strong>El nombre sólo puede contener letras o espacios.";
          return false;
        }

        if (!empty($descripcion) && !preg_match("/^[a-zA-Z ñÑáÁéÉíÍóÓúÚ 0987654321 ,.]*$/", $descripcion)){
          $GLOBALS['msg'] = "<strong> ¡Error! </strong> La descripcion contiene caracteres no admitidos.";
          return false;
        }

        if($sexo != 'H' && $sexo != 'M'){
          $GLOBALS['msg'] = "<strong> ¡Error! </strong>Por favor seleccione el sexo de la mascota.";
          return false;
        }

        if($especie == 0){
          $GLOBALS['msg'] = "<strong> ¡Error! </strong>Por favor seleccione la especie.";
          return false;
        }

        if($raza == 0){
          $GLOBALS['msg'] = "<strong> ¡Error! </strong>Por favor seleccione la raza.";
          return false;
        }

        if($tamano == 0){
          $GLOBALS['msg'] = "<strong> ¡Error! </strong>Por favor seleccione el tamaño.";
          return false;
        }

        if($vacunas == 0){
          $GLOBALS['msg'] = "<strong> ¡Error! </strong>Por favor seleccione si está vacunado o no.";
          return false;
        }

        if($desparasitado == 0){
          $GLOBALS['msg'] = "<strong> ¡Error! </strong>Por favor seleccione si está desparasitado o no.";
          return false;
        }

        if($esterilizado == 0){
          $GLOBALS['msg'] = "<strong> ¡Error! </strong>Por favor seleccione si está esterilizado o no.";
          return false;
        }

        if($tipoPublicacion == 3){
          $GLOBALS['msg'] = "<strong> ¡Error! </strong>Por favor seleccione el tipo de publicación.";
          return false;
        }
        
        return true;
    }

 ?>
