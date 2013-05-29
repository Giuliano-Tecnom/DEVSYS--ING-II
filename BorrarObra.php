<?php
	
	include_once('mysqlconnect.php');
	
	if (!isset($_GET['idobra']))
	{
		Header ('Location: GestionObras.php');
	}
	$consulta_delete = "UPDATE obrasociales SET activo = 0 WHERE idobra = '" . $_GET['idobra'] ."';";
	
	echo $consulta_delete;
	mysql_query($consulta_delete);
	
	
	Header ('Location: GestionObras.php');
?>
