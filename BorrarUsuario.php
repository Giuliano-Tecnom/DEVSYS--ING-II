<?php

include_once('mysqlconnect.php');
			
	$idusuario = $_GET['idusuario'];

	if (!isset($_GET['idusuario'])) {
		Header ('Location: GestionUsuarios.php');
	}

	$consulta_delete = "UPDATE usuarios SET activo = 0 WHERE idusuario = '" . $_GET['idusuario'] ."';";
	mysql_query($consulta_delete);


	Header ('Location: GestionUsuarios.php?Correcto=1');

	
		
?>