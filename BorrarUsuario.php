<?php

include_once('mysqlconnect.php');
			
	$idusuario = $_GET['idusuario'];


	$delete = "DELETE FROM usuarios WHERE idusuario = ".$idusuario." ";
	mysql_query($delete);


	Header ('Location: GestionUsuarios.php?Correcto=1');

	
		
?>