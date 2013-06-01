$(document).ready(function () {
    $(".btnsubmit").click(function (){
        $(".error").remove();
		//INICIO VALIDACION APELLIDO Y NOMBRE
        if( $(".nomm").val() == "" ){
            $(".nomm").focus().after("<span class='error'>Ingrese el nombre del paciente</span>");
            return false;
        } else {
			if ( $.trim( $(".nomm").val() ) == '' ) {
				$(".nomm").focus().after("<span class='error'>Ingrese un nombre valido</span>");
				return false;	
			}
			if( $("apee").val() == "" ){
				$(".apee").focus().after("<span class='error'>Ingrese el apellido del paciente</span>");
				return false;
		//FIN VALIDACION APELLIDO Y NOMBRE
			} else {
				if ( $.trim( $(".apee").val() ) == '' ) {
					$(".apee").focus().after("<span class='error'>Ingrese un apellido valido</span>");
					return false;	
				}
				//INICIO VALIDACION DNI
				if( $(".dnii").val() == "" ){
					$(".dnii").focus().after("<span class='error'>Ingrese el dni del paciente</span>");
					return false;
				} else {
					var dnireg = /^(\d{7,9})$/
					var num_dni = $(".dnii").val().length
					if(!dnireg.test($(".dnii").val())) {
						$(".dnii").focus().after("<span class='error'>Ingrese un dni valido</span>");
						return false;
					}		
				//FIN VALIDACION DNI
					if($(".emaill").val() != ""){
						var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
						if(!emailreg.test($(".emaill").val())){
							$(".emaill").focus().after("<span class='error'>Ingrese un email correcto</span>");
							return false;
						}
					} else {
						//INICIO VALIDACION TELEFONO
						if( $(".tell").val() == "" ){
							$(".tell").focus().after("<span class='error'>Ingrese el telefono del paciente</span>");
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
							
							//INICIO VALIDACION DIRECCION
							if( $(".dirr").val() == "" ){
								$(".dirr").focus().after("<span class='error'>Ingrese la direccion del paciente</span>");
								return false;
							//FIN VALIDACION DIRECCION
							} else {
								if ( $.trim( $(".dirr").val() ) == '' ) {
									$(".dirr").focus().after("<span class='error'>Ingrese una direccion valida</span>");
									return false;	
								}
								if( $(".fecnacc").val() == "" ){
									$(".fecnacc").focus().after("<span class='error'>Ingrese la fecha de nacimiento del paciente</span>");
									return false;
								}
							}
						}
					}
				}
			}
		}
    });
});