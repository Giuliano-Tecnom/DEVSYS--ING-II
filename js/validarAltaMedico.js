$(document).ready(function () {
    $(".btnsubmit").click(function (){
        $(".error").remove();
		//INICIO VALIDACION APELLIDO Y NOMBRE
        if( $(".namee").val() == "" ){
            $(".namee").focus().after("<span class='error'>Ingrese el nombre del medico</span>");
            return false;
        } else { 
			if( $(".apellidoo").val() == "" ){
				$(".apellidoo").focus().after("<span class='error'>Ingrese el apellido del medico</span>");
				return false;
		//FIN VALIDACION APELLIDO Y NOMBRE
			} else {
				var dnimatreg = /^(\d{7,9})$/
				//INICIO VALIDACION MATRICULA
				if($(".nrolicenciaa").val() == "" ) {
					$(".nrolicenciaa").focus().after("<span class='error'>Ingrese el numero de licencia del medico</span>");
						return false;				
				} else {
					var num_mat = $(".nrolicenciaa").val().length
					if(!dnimatreg.test($(".nrolicenciaa").val())) {
						$(".nrolicenciaa").focus().after("<span class='error'>Ingrese una matricula valida</span>");
						return false;
				}
				//FIN VALIDACION MATRICULA
				//INICIO VALIDACION DIRECCION
				if( $(".dirr").val() == "" ){
					$(".dirr").focus().after("<span class='error'>Ingrese la direccion del medico</span>");
					return false;
				}
				//FIN VALIDACION DIRECCION
				else {
					//INICIO VALIDACION TELEFONO
					if( $(".tell").val() == "" ){
						$(".tell").focus().after("<span class='error'>Ingrese el telefono del medico</span>");
						return false;
					} else {
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
						else {					
							//INICIO VALIDACION DNI
							if( $(".dnii").val() == "" ){
								$(".dnii").focus().after("<span class='error'>Ingrese el dni del medico</span>");
								return false;
							} else {
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
								else {
								if( $(".fecnacc").val() == "" ){
									$(".fecnacc").focus().after("<span class='error'>Ingrese la fecha de nacimiento del medico</span>");
									return false;
								}
								//FIN VALIDACION FECHA NACIMIENTO
								}
							}
						}
					}
				}
				}
			}
		}
    });
});