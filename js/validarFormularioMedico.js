$(document).ready(function () {
    $(".btnsubmit").click(function (){
        $(".error").remove();
		
		var dnimatreg = /^(\d{7,9})$/
		
		//INICIO VALIDACION APELLIDO Y NOMBRE
        if( $(".namee").val() == "" ){
            $(".namee").focus().after("<span class='error'>Ingrese el nombre del medico</span>");
            return false;
        } 
		if ( $.trim( $(".namee").val() ) == "" ) {
			$(".namee").focus().after("<span class='error'>Ingrese un nombre valido</span>");
			return false;	
		}
		
		if( $(".apellidoo").val() == "" ){
			$(".apellidoo").focus().after("<span class='error'>Ingrese el apellido del medico</span>");
			return false;
		}
		if ( $.trim( $(".apellidoo").val() ) == "" ) {
			$(".apellidoo").focus().after("<span class='error'>Ingrese un apellido valido</span>");
			return false;	
		}
	
		//FIN VALIDACION APELLIDO Y NOMBRE
				
		//INICIO VALIDACION MATRICULA
		if($(".nromatriculaa").val() == "" ) {
			$(".nromatriculaa").focus().after("<span class='error'>Ingrese el numero de matricula del medico</span>");
				return false;				
		}
		if(!dnimatreg.test($(".nromatriculaa").val())) {
			$(".nromatriculaa").focus().after("<span class='error'>Ingrese una matricula valida</span>");
			return false;
		}
		
		//FIN VALIDACION MATRICULA
				
		//INICIO VALIDACION DIRECCION
		if( $(".dirr").val() == "" ){
			$(".dirr").focus().after("<span class='error'>Ingrese la direccion del medico</span>");
			return false;
		}
		if ( $.trim( $(".dirr").val() ) == "" ) {
					$(".dirr").focus().after("<span class='error'>Ingrese una direccion valida</span>");
					return false;	
		}

		//FIN VALIDACION DIRECCION
		
		//INICIO VALIDACION TELEFONO
		if( $(".tell").val() == "" ){
			$(".tell").focus().after("<span class='error'>Ingrese el telefono del medico</span>");
			return false;
		}
		var telreg = /^([0-9\+\-])+$/;
		var num_telefono = $(".tell").val().length
		if(!telreg.test($(".tell").val())) {
			$(".tell").focus().after("<span class='error'>Ingrese un telefono valido</span>");
			return false;
		} else if(num_telefono < 7) {
				$(".tell").focus().after("<span class='error'>El telefono es demasiado corto</span>");
				return false;
		}
		
		//FIN VALIDACION TELEFONO
			
		//INICIO VALIDACION DNI
		if( $(".dnii").val() == "" ){
			$(".dnii").focus().after("<span class='error'>Ingrese el dni del medico</span>");
			return false;
		}
		var num_dni = $(".dnii").val().length
		if(!dnimatreg.test($(".dnii").val())) {
			$(".dnii").focus().after("<span class='error'>Ingrese un dni valido</span>");
			return false;
		}		
		
		//FIN VALIDACION DNI
		
		//INICIO VALIDACION MAIL
		if($(".emaill").val() != ""){
			var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
			if(!emailreg.test($(".emaill").val())){
				$(".emaill").focus().after("<span class='error'>Ingrese un email correcto</span>");
				return false;
			}
		}
		//FIN VALIDACION MAIL 
		
		//INICIO VALIDACION FECHA NACIMIENTO
		if( $(".fecnacc").val() == "" ){
			$(".fecnacc").focus().after("<span class='error'>Ingrese la fecha de nacimiento del medico</span>");
			return false;
		}
		//FIN VALIDACION FECHA NACIMIENTO
    });
});