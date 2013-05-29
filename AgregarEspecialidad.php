<?php

include_once('mysqlconnect.php');
	
	$nombre=trim($_POST['nombre']);
	$consulta = " SELECT nombre FROM especialidades where UPPER(nombre) = UPPER('" . $nombre. "') ";
	$res=mysql_query($consulta);
	
	if ( mysql_num_rows($res) == 0 )
		{
		
		
	$consulta = "INSERT INTO especialidades
				(nombre)
				VALUES
				( '" . $nombre. "');";
			
	mysql_query($consulta);

	Header ('Location: GestionEspecialidades.php');
        }
	else 
	   {
	     Header ('Location: AltaEspecialidades.php?Error=1');
	   }
?>