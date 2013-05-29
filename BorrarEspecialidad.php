<?php
	
	include_once('mysqlconnect.php');
	
	if (!isset($_GET['idespecialidad']))
	{
		Header ('Location: GestionEspecialidades.php');
	}
	$consulta_delete = "DELETE FROM especialidades WHERE idespecialidad = '" . $_GET['idespecialidad'] ."';";
	
	echo $consulta_delete;
	mysql_query($consulta_delete);
	
	
	Header ('Location: GestionEspecialidades.php');
?>
