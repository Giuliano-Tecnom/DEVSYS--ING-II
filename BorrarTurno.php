<?php
	
	include_once('mysqlconnect.php');
	$consulta = "DELETE FROM turnos where idturno= ".$_GET['idturno']." ";
	$resultado = mysql_query($consulta);
	Header ('Location: GestionTurnos.php?Correcto=2');

?> 