<?php

include_once('mysqlconnect.php');
			
	$nombre = strtoupper($_POST['nombre']);
	$apellido = strtoupper($_POST['apellido']);
	$usuario = strtoupper($_POST['usuario']);
	$pass = strtoupper($_POST['password']);
	$tipo = $_POST['tipo'];
	$idusuario = $_POST['idusuario'];

	$consulta = "SELECT * FROM usuarios WHERE usuario = '".$usuario."' ";
	$resultado = mysql_query($consulta);

	if ( mysql_num_rows($resultado) == 0 ) {


		$update = "UPDATE usuarios 
				   SET nombre = '".$nombre."', apellido = '".$apellido."', usuario = '".$usuario."', password = '".$pass."', tipo = '".$tipo."'
				   WHERE idusuario = ".$idusuario." ";
				
		mysql_query($update);

		Header ('Location: GestionUsuarios.php?Correcto=2');

	}else{
		Header ('Location: GestionUsuarios.php?Error=1');
	}

	
		
?>

