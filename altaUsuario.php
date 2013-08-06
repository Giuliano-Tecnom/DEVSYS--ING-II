<?php

include_once('mysqlconnect.php');
			
	$nombre = strtoupper($_POST['nombre']);
	$apellido = strtoupper($_POST['apellido']);
	$usuario = strtoupper($_POST['usuario']);
	$pass = strtoupper($_POST['password']);
	$tipo = $_POST['tipo'];


	$consulta = "SELECT * FROM usuarios WHERE usuario = '".$usuario."' ";
	$resultado = mysql_query($consulta);

	if ( mysql_num_rows($resultado) == 0 ) {


		$insertar = "INSERT INTO usuarios (nombre, apellido, usuario, password, tipo) 
				 	 VALUES ( '".$nombre."' , '".$apellido."' , '".$usuario."' , '".$pass."' , '".$tipo."' )";
				
		mysql_query($insertar);

		Header ('Location: GestionUsuarios.php?Correcto=3');

	}else{
		Header ('Location: agregarUsuarios.php?Error=1');
	}

	
		
?>