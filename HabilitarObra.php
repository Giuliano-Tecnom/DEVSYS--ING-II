<?php
	
	
	include_once('mysqlconnect.php');
	
	$consulta_modif = "UPDATE obrasociales SET activo = 1 WHERE idobra = '" . $_GET['idobra'] . "';";
	$modif = mysql_query($consulta_modif);
	
	Header ('Location: GestionObras.php');
	
?>