<?php
	
	
	include_once('mysqlconnect.php');
	
	$consulta_modif = "UPDATE medicos SET activo = 1 WHERE nrolicencia = '" . $_GET['nrolicencia'] . "';";
	$modif = mysql_query($consulta_modif);
	
	
	
	
	Header ('Location: GestionMedicos.php');
	
?>