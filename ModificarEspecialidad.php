<?php
	
	if (empty($_POST['nombre']))
	{
		Header ('Location: Especialidad.php');
	}
	
	include_once('mysqlconnect.php');
	
	$nombre=trim($_POST['nombre']);
	$consulta = " SELECT nombre,idespecialidad FROM especialidades where UPPER(nombre) = UPPER('" .$nombre. "') ";
	$res=mysql_query($consulta);
	$valor = mysql_fetch_array($res);
	
	if ( mysql_num_rows($res) == 0  ||  $_POST['idespecialidad'] == $valor['idespecialidad'] )
		{
	
	
	
	
	$consulta_modif = "UPDATE especialidades SET nombre = '" .$nombre. "' WHERE idespecialidad = '" . $_POST['idespecialidad'] . "';";
	$modif = mysql_query($consulta_modif);
	
	Header ('Location: GestionEspecialidades.php');
	
	}
	else
	
	{
	   $idespecialidad=$_POST['idespecialidad'];
	   Header ("Location: Especialidad.php?idespecialidad=".$idespecialidad."&Error=1");
	
	}
?>