<?php

include_once('mysqlconnect.php');
		
	$nombre=trim($_POST['nombre']);
    
     
	$consulta = " SELECT nombre FROM obrasociales where UPPER(nombre) = UPPER('" .$nombre. "') ";
	$res=mysql_query($consulta);
	
	if ( mysql_num_rows($res) == 0 )
		{
		
		
	$consulta = "INSERT INTO obrasociales
				(nombre)
				VALUES
				( '" .$nombre. "');";
			
	mysql_query($consulta);

	Header ('Location: GestionObras.php');
        }
	else 
	   {
	     Header ('Location: AltaObras.php?Error=1');
	   }
	   
?>