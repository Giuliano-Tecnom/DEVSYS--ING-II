<?php
	
	include_once('mysqlconnect.php');
	
	if (!isset($_GET['dni']))
	{
		Header ('Location: GestionPacientes.php');
	}
	
	$consulta= "SELECT * FROM pac_obrasocial where dni ='" . $_GET['dni'] ."';";
	$res=mysql_query($consulta);
	
	if ( mysql_num_rows($res) == 0 )
	{
	$consulta_delete = "UPDATE pacientes SET activo = 0 WHERE dni = '" . $_GET['dni'] ."';";
	
	echo $consulta_delete;
	mysql_query($consulta_delete);
	
	
	Header ('Location: GestionPacientes.php');
	}
	
	else {
	
	Header ('Location: GestionPacientes.php?Error=1');
	}
?>
