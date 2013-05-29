<?php
	
	if (empty($_POST['nombre']))
	{
		Header ('Location: Especialidad.php');
	}
	
	include_once('mysqlconnect.php');
	
	$consulta_modif = "UPDATE especialidades SET nombre = '" . $_POST['nombre'] . "' WHERE idespecialidad = '" . $_POST['idespecialidad'] . "';";
	$modif = mysql_query($consulta_modif);
	
	Header ('Location: GestionEspecialidades.php');
	
?>
