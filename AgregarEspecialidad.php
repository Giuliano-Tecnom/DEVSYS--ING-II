<?php

include_once('mysqlconnect.php');
		
		
	$consulta = "INSERT INTO especialidades
				(nombre)
				VALUES
				( '" . $_POST['nombre'] . "');";
			
	mysql_query($consulta);

	Header ('Location: GestionEspecialidades.php');

?>