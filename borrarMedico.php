<?php
	
	include_once('mysqlconnect.php');
	
	if (!isset($_GET['idmedico'])) {
		Header ('Location: GestionMedicos.php');
	}
	$consulta = "SELECT * FROM medicos where idmedico = '" . $_GET['idmedico'] ."';";
	$res=mysql_query($consulta);
	if ( mysql_num_rows($res) == 0 ) {
		Header ('Location: GestionMedicos.php?Error=1');
	} else {
			$consulta_delete = "UPDATE medicos SET activo = 0 WHERE idmedico = '" . $_GET['idmedico'] ."';";
			mysql_query($consulta_delete);//  Borrado lógico de medico.
			Header ('Location: GestionMedicos.php?Correcto=2');
	}		
?>
