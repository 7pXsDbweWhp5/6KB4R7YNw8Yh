/*function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};*/

function hideplcHolder(x){

    if (x=="register"){
    	$("#inputPais").find("option").eq(0).hide();
	    $("#inputCiudad").find("option").eq(0).hide();
	    $("#day").find("option").eq(0).hide();
	    $("#month").find("option").eq(0).hide();
	    $("#year").find("option").eq(0).hide();
    } else if(x=="create") {
    	$("#inputEdad").find("option").eq(0).hide();
	    $("#inputEspecie").find("option").eq(0).hide();
	    $("#inputRaza").find("option").eq(0).hide();
	    $("#inputEsterilizado").find("option").eq(0).hide();
	    $("#inputDesparasitado").find("option").eq(0).hide();
	    $("#inputVacunas").find("option").eq(0).hide();
	    $("#inputTamano").find("option").eq(0).hide();
    }

}

function cargarCiudades(x){
    var id = document.getElementById("pais").value;
    if (x=="registro"){
        $('#ciudad').load('prv/funciones.php?id='+id+'&valor=ciudades');
        $("#ciudad").find("option").eq(0).hide();
    } else if(x == "perfil") {
        $('#ciudad').load('../prv/funciones.php?id='+id+'&valor=ciudades');
        $("#ciudad").find("option").eq(0).hide();
    }
}

function cargarRazas(){
    var id = document.getElementById("especie").value;
    $('#raza').load('../prv/funciones.php?id='+id+'&valor=razas');
}

/*
function setFocus(grpId, ipId){
	var x = document.getElementById(ipId);
	var y = document.getElementById(grpId);

	if (x.value == ""){
		y.className = "form-group";
	}
}

function lostFocus(grpId, ipId, mensaje){
	var x = document.getElementById(ipId);
	var y = document.getElementById(grpId);

	if (x.value == ""){
		y.className = "form-group has-error";
	} else {
		y.className = "form-group has-success";
	}
}
*/
function showMyImage(fileInput) {
    var files = fileInput.files;
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var imageType = /image.*/;
        if (!file.type.match(imageType)) {
            continue;
        }
        var img=document.getElementById("preview-avatar");
        img.file = file;
        var reader = new FileReader();
        reader.onload = (function(aImg) {
            return function(e) {
                aImg.src = e.target.result;
            };
        })(img);
        reader.readAsDataURL(file);
    }
}

function scroll(){
    var change = false;
    $(window).scroll(function(){
        window_y = $(window).scrollTop(); // VALOR QUE SE HA MOVIDO DEL SCROLL
        scrollInferior = parseInt($('#tercero').height()); //VALOR DEL DIV

        if (window_y > scrollInferior) {// SI EL SCROLL HA SUPERADO EL ALTO DE TU DIV
            $('#firstElement').show();
        }

        scrollBot = $(document).height();

        if (window_y + $(window).height() == scrollBot){
            $('#titulo3').show();
            $('#parrafo3').show();
            $('#link3').show();
        }
    });
}

function cargarPerfil(){
    $('#ciudad').load('../prv/funciones.php?valor=ciudadesPerfil');
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

function bloquearPerfil(){
    $('fieldset').prop("disabled", true);
    $("#pfButtons").hide();
}

function desbloquearPerfil(){
    $('fieldset').prop("disabled", false);
    $("#pfButtons").show();
}

function enviarPerfil(){
    $( "#frmPerfil" ).submit();
}

function cargarPreguntas(){
  if($('#adopcion').is(':checked')){
    $( "#mdPreguntas" ).load( "../user/preguntas.php" );
  } else {
    $( "#cuestionario" ).remove();
  }
}

function cargarRespuestas(numPreg){
  var id = $('#preg'+numPreg).val();
  $( "#resp"+numPreg ).load( '../prv/funciones.php?valor=respuestas&id='+id);
}

function cleanTipoPublicacion(){
  $('#tpAdopcion').removeClass( "active" );
  $('#tpExtraviado').removeClass( "active" );
  $('#tpBuscaDueno').removeClass( "active" );
  $('#rdDefault').prop('checked','checked');
  $( "#cuestionario" ).remove();
}


// -------------------------- USANDO AJAX ----------------------

function loadDoc() {
    var xhttp;
    if (window.XMLHttpRequest) {
      // code for modern browsers
      xhttp = new XMLHttpRequest();
      } else {
      // code for IE6, IE5
      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
}
