<?php
	
	
	include_once('mysqlconnect.php');
	
	$consulta_modif = "UPDATE pacientes SET activo = 1 WHERE dni = '" . $_GET['dni'] . "';";
	$modif = mysql_query($consulta_modif);
	
	$consulta_modif = "UPDATE pac_obrasocial SET activo = 1 WHERE dni = '" . $_GET['dni'] . "';";
	$modif = mysql_query($consulta_modif);
	
	
	Header ('Location: GestionPacientes.php');
	
?>