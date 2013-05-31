$(document).ready(function () {
    var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    $(".btn").click(function (){
        $(".error").remove();
        if( $(".nombre").val() == "" ){
            $(".nombre").focus().after("<span class='error'>Ingrese el nombre del paciente</span>");
            return false;
        }else if( $(".apellido").val() == "" ){
            $(".apellido").focus().after("<span class='error'>Ingrese el apellido del paciente</span>");
            return false;
        }else if( $(".dni").val() == "" ){
            $(".dni").focus().after("<span class='error'>Ingrese el dni del paciente</span>");
            return false;
        }else if( $(".tel").val() == "" ){
            $(".tel").focus().after("<span class='error'>Ingrese el telefono del paciente</span>");
            return false;
        }else if( $(".dir").val() == "" ){
            $(".dir").focus().after("<span class='error'>Ingrese la direccion del paciente</span>");
            return false;
        }else if($(".email").val() != ""){
				if(!emailreg.test($(".email").val())){
					$(".email").focus().after("<span class='error'>Ingrese un email correcto</span>");
					return false;
				}
        } else if( $(".fecnac").val() == "" ){ //Desmenuzar date
            $(".fecnac").focus().after("<span class='error'>Ingrese la fecha de nacimiento del paciente</span>");
            return false;
        }
    });
});