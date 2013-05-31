$(document).ready(function () {
    
    $(".btn").click(function (){
        $(".error").remove();
        if( $(".nombre").val() == "" ){
            $(".nombre").focus().after("<span class='error'>Ingrese el nombre de la especialidad</span>");
            return false;
        }
    });
});