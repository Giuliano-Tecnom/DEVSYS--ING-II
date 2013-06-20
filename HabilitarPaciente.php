<?php
	include_once('mysqlconnect.php');
	
	$consulta_modif = "UPDATE pacientes SET activo = 1 WHERE idpaciente = ".$_GET['idpaciente']."";
	$modif = mysql_query($consulta_modif);
	Header ('Location: GestionPacientes.php');
?>