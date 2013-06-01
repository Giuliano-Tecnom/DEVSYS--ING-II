$(document).ready(function () {
    
    $(".btnsubmit").click(function (){
        $(".error").remove();
        if( $(".nombree").val() == '' ){
            $(".nombree").focus().after("<span class='error'>Ingrese el nombre de la obra</span>");
            return false;
        }
		if ( $.trim( $(".nombree").val() ) == '' ) {
			$(".nombree").focus().after("<span class='error'>Ingrese un nombre valido</span>");
            return false;	
		}
    });
});