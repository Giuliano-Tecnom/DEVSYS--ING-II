<?php

include_once('mysqlconnect.php');
			
	$idusuario = $_GET['idusuario'];

	if (!isset($_GET['idusuario'])) {
		Header ('Location: GestionUsuarios.php');
	}

	$consulta_hab = "UPDATE usuarios SET activo = 1, intentos = 0 WHERE idusuario = '" . $_GET['idusuario'] ."';";
	mysql_query($consulta_hab);


	Header ('Location: GestionUsuarios.php?Correcto=4');


		
?>