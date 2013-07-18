<?php
	
	include_once('mysqlconnect.php');
	
	

	$consultaTurnos = "UPDATE turnos
    SET estado = '".$_POST['estado']."'
	where idturno = ".$_POST['idturno']." ";
	$resultadoTurnos = mysql_query($consultaTurnos);
	
	Header ('Location: GestionTurnos.php');
	
?>
