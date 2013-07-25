<?php

include_once('mysqlconnect.php');
		
	$idmedico=$_POST['myselect2'];
	$fechaDesde=$_POST['fechaDesde'];
	$fechaHasta=$_POST['fechaHasta'];
    
     
	$consulta = " SELECT * FROM licencias where idmedico = ".$idmedico." and fechaHasta < ".$fechaDesde." ";
	$res=mysql_query($consulta);
	
	if ( mysql_num_rows($res) == 0 ) {
		
		
	$consulta = "INSERT INTO licencias
				(idmedico, fechaDesde, fechaHasta)
				VALUES
				( '".$idmedico."', '".$fechaDesde."', '".$fechaHasta."');";
			
	mysql_query($consulta);
	
	Header ('Location: GestionLicencias.php');
	
    } else {
	     Header ('Location: AltaLicencias.php?Error=1');
    }
	   
?>