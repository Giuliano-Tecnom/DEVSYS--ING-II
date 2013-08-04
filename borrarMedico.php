<?php
	
	include_once('mysqlconnect.php');
	
	if (!isset($_GET['idmedico'])) {
		Header ('Location: GestionMedicos.php');
	}
	
	$consultaTurnos = "SELECT * FROM turnos where idmedico = ".$_GET['idmedico'].";";
	$resultadoTurnos = mysql_query($consultaTurnos);
	//Verifico que no tenga turnos asignados
	$cant = 0;
	if ( mysql_num_rows($resultadoTurnos) > 0 ) {
		while ($valor = mysql_fetch_array($resultadoTurnos)){
			$estado = $valor["estado"];
			
			if ($estado == 'en espera') { 
				$cant++;
				
				Header ('Location: GestionMedicos.php?Error=3');
			}
		}
		
		if ($cant == 0){
			$consulta_delete = "UPDATE medicos SET activo = 0 WHERE idmedico = '" . $_GET['idmedico'] ."';";
			mysql_query($consulta_delete);//  Borrado lógico de medico.
			Header ('Location: GestionMedicos.php?Correcto=2');
		}
		
	
	} else {
		
		$consulta_delete = "UPDATE medicos SET activo = 0 WHERE idmedico = '" . $_GET['idmedico'] ."';";
		mysql_query($consulta_delete);//  Borrado lógico de medico.
		Header ('Location: GestionMedicos.php?Correcto=2');
		
	}
?>
