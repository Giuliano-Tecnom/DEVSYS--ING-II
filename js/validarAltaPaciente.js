$(document).ready(function () {
    var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    $(".btn").click(function (){
        $(".error").remove();
        if( $(".namee").val() == "" ){
            $(".namee").focus().after("<span class='error'>Ingrese el nombre del paciente</span>");
            return false;
        }else if( $(".apellidoo").val() == "" ){
            $(".apellidoo").focus().after("<span class='error'>Ingrese el apellido del paciente</span>");
            return false;
        }else if( $(".dnii").val() == "" ){
            $(".dnii").focus().after("<span class='error'>Ingrese el dni del paciente</span>");
            return false;
        }else if($(".emaill").val() != ""){
				if(!emailreg.test($(".emaill").val())){
					$(".emaill").focus().after("<span class='error'>Ingrese un email correcto</span>");
					return false;
				}
        }else if( $(".tell").val() == "" ){
            $(".tell").focus().after("<span class='error'>Ingrese el telefono del paciente</span>");
            return false;
        }else if( $(".dirr").val() == "" ){
            $(".dirr").focus().after("<span class='error'>Ingrese la direccion del paciente</span>");
            return false;
        }else if( $(".fecnacc").val() == "" ){ //Desmenuzar date
            $(".fecnacc").focus().after("<span class='error'>Ingrese la fecha de nacimiento del paciente</span>");
            return false;
        }
    });
});