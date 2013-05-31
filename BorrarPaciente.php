<?php
	
	include_once('mysqlconnect.php');
	
	if (!isset($_GET['dni']))
	{
		Header ('Location: GestionPacientes.php');
	}
	
	$consulta= "SELECT * FROM pac_obrasocial where dni ='" . $_GET['dni'] ."';";
	$res=mysql_query($consulta);
	
	
	$consulta_delete = "UPDATE pacientes SET activo = 0 WHERE dni = '" . $_GET['dni'] ."';";
	mysql_query($consulta_delete);//  Borrado lógico de paciente.
	
	
	if ( mysql_num_rows($res) == 0 )
	{
	
	
	 Header ('Location: GestionPacientes.php?Correcto=2');
	}
	
	else {
	
	$consulta_delete = "UPDATE pac_obrasocial SET activo = 0 WHERE dni = '" . $_GET['dni'] ."';";
	mysql_query($consulta_delete);
	
	Header ('Location: GestionPacientes.php?Correcto=2');
	}
?>
