<?php

include_once('mysqlconnect.php');
		
	$idmedico=$_POST['myselect2'];
	$fechaDesde=$_POST['fechaDesde'];
	$fechaHasta=$_POST['fechaHasta'];
    
	if( $fechaDesde < $fechaHasta ) {
     
		$consulta = " SELECT * FROM licencias where idmedico = ".$idmedico." and fechaHasta < ".$fechaDesde." ";
		$res=mysql_query($consulta);
		
		$consultaTurnoAsignado = " SELECT * FROM medicos as m 
									INNER JOIN turnos as t 
									ON m.idmedico = t.idmedico
									WHERE m.idmedico = ".$idmedico." 
									AND t.fecha between '".$fechaDesde."' and '".$fechaHasta."' 
									AND t.estado = 'en espera' ";
		$resTurnoAsignado=mysql_query($consultaTurnoAsignado);
		
		if ( mysql_num_rows($res) == 0 ) {
			
			if ( mysql_num_rows($resTurnoAsignado) == 0 ) {
				
				$consulta = "INSERT INTO licencias
						(idmedico, fechaDesde, fechaHasta)
						VALUES
						( '".$idmedico."', '".$fechaDesde."', '".$fechaHasta."');";
				
				mysql_query($consulta);
			
				Header ('Location: GestionLicencias.php');
			} else {
				Header ('Location: AltaLicencias.php?Error=3');
			}
		} else {
			 Header ('Location: AltaLicencias.php?Error=1');
		}
	}else{
	
		Header ('Location: AltaLicencias.php?Error=2');
	
	}
?>