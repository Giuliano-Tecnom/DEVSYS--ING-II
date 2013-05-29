<?php
	
	include_once('mysqlconnect.php');
	
	if (!isset($_GET['idespecialidad']))
	{
		Header ('Location: GestionEspecialidades.php');
	}
	$consulta_delete = "UPDATE especialidades SET activo = 0 WHERE idespecialidad = '" . $_GET['idespecialidad'] ."';";
	
	echo $consulta_delete;
	mysql_query($consulta_delete);
	
	
	Header ('Location: GestionEspecialidades.php');
?>
