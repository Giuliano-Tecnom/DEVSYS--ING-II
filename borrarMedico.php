<?php
	
	include_once('mysqlconnect.php');
	
	if (!isset($_GET['idmedico'])) {
		Header ('Location: GestionMedicos.php');
	}

	$consultaTurnos = "SELECT * FROM turnos where idmedico = ".$_GET['idmedico'].";";
	$resultadoTurnos = mysql_query($consultaTurnos);
	//Verifico que no tenga turnos asignados
	if ( mysql_num_rows($resultadoTurnos) > 0 ) {
		Header ('Location: GestionMedicos.php?Error=3');
	} else {
		$consulta_delete = "UPDATE medicos SET activo = 0 WHERE idmedico = '" . $_GET['idmedico'] ."';";
		mysql_query($consulta_delete);//  Borrado lógico de medico.
		Header ('Location: GestionMedicos.php?Correcto=2');
		echo $consultaTurnos;
	}
?>
