$(document).ready(function () {
    $(".btnsubmit").click(function (){
        $(".error").remove();
		
		//INICIO VALIDACION APELLIDO Y NOMBRE
        if( $(".namee").val() == "" ){
            $(".namee").focus().after("<span class='error'>Ingrese el nombre</span>");
            return false;
        }
		if ( $.trim( $(".namee").val() ) == '' ) {
			$(".namee").focus().after("<span class='error'>Ingrese un nombre valido</span>");
			return false;	
		}
		if( $(".apellidoo").val() == "" ){
			$(".apellidoo").focus().after("<span class='error'>Ingrese el apellido</span>");
			return false;
		} 
		if ( $.trim( $(".apellidoo").val() ) == '' ) {
			$(".apellidoo").focus().after("<span class='error'>Ingrese un apellido valido</span>");
			return false;	
		}
		//FIN VALIDACION APELLIDO Y NOMBRE
		
		//INICIO VALIDACION USUARIO
		if( $(".usuarioo").val() == "" ){
			$(".usuarioo").focus().after("<span class='error'>Ingrese un usuario</span>");
			return false;
		} else {
			var lim_user = /^([a-zA-Z0-9_\.\-]{0,16})+$/;
			if(!lim_user.test($(".usuarioo").val())) {
				$(".usuarioo").focus().after("<span class='error'>Ingrese un Usuario valido</span>");
				return false;
			}		
		}
		//FIN VALIDACION USUARIO
		
		//INICIO VALIDACION PASSWORD
		if( $(".passwordd").val() == "" ){
			$(".passwordd").focus().after("<span class='error'>Ingrese una contraseña</span>");
			return false;
		} else {
			var lim_user = /^([a-zA-Z0-9_\.\-]{5,16})+$/;
			if(!lim_user.test($(".passwordd").val())) {
				$(".passwordd").focus().after("<span class='error'>Ingrese una contraseña valida</span>");
				return false;
			}		
		}
		//FIN VALIDACION PASSWORD
		
    });
});