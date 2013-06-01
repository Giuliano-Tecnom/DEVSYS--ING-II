<?php
	
	include_once('mysqlconnect.php');
	
	if (!isset($_GET['nrolicencia'])) {
		Header ('Location: GestionMedicos.php');
	}
	$consulta = "SELECT * FROM medicos where nrolicencia = '" . $_GET['nrolicencia'] ."';";
	$res=mysql_query($consulta);
	if ( mysql_num_rows($res) == 0 ) {
		Header ('Location: GestionMedicos.php?Error=1');
	
	
	
	}
	else {
		
			$consulta_delete = "UPDATE medicos SET activo = 0 WHERE nrolicencia = '" . $_GET['nrolicencia'] ."';";
			
			mysql_query($consulta_delete);//  Borrado lógico de paciente.
			Header ('Location: GestionMedicos.php?Correcto=2');
			
			
	}		
?>
