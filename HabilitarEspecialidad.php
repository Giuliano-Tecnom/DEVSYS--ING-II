<?php
	
	
	
	include_once('mysqlconnect.php');
	
	$consulta_modif = "UPDATE especialidades SET activo = 1 WHERE idespecialidad = '" . $_GET['idespecialidad'] . "';";
	$modif = mysql_query($consulta_modif);
	
	Header ('Location: GestionEspecialidades.php');
	
?>