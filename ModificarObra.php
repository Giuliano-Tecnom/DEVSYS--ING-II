<?php
	
	if (empty($_POST['nombre']))
	{
		Header ('Location: ObraSocial.php');
	}
	
	include_once('mysqlconnect.php');
	
	$nombre=trim($_POST['nombre']);
	$consulta = " SELECT nombre,idobra FROM obrasociales where UPPER(nombre) = UPPER('" . $nombre . "') ";
	$res=mysql_query($consulta);
	
	$valor = mysql_fetch_array($res);
	
	if ( mysql_num_rows($res) == 0  ||  $_POST['idobra'] == $valor['idobra'] )
		{
	
	$consulta_modif = "UPDATE obrasociales SET nombre = '" . $nombre . "' WHERE idobra = '" . $_POST['idobra'] . "';";
	$modif = mysql_query($consulta_modif);
	
	Header ('Location: GestionObras.php');
	
	}
	else
	
	{
	   $idobra=$_POST['idobra'];
	   Header ("Location: ObraSocial.php?idobra=".$idobra."&Error=1");
	
	}
?>
