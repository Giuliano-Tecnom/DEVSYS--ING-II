<?php
	
	include_once('mysqlconnect.php');
	
	if (!isset($_GET['idpaciente'])) {
		Header ('Location: GestionPacientes.php');
	}
	
	$consulta= "SELECT * FROM pac_obrasocial where idpaciente ='" . $_GET['idpaciente'] ."';";
	$res=mysql_query($consulta);
	
	$consultaTurnos= "SELECT * FROM turnos where idpaciente ='" . $_GET['idpaciente'] ."';";
	$resultadoTurnos=mysql_query($consultaTurnos);
	$cant=0;	
	//Verifico que no tenga turnos asignados
	if ( mysql_num_rows($resultadoTurnos) > 0 ) {
		while ($valor = mysql_fetch_array($resultadoTurnos)){
			$estado = $valor["estado"];
			
			if ($estado == 'en espera') { 
				
				$cant++;
				Header ('Location: GestionPacientes.php?Error=3');
			}
		}
		if ($cant == 0){
			$consulta_delete = "UPDATE pacientes SET activo = 0 WHERE idpaciente = '" . $_GET['idpaciente'] ."';";
			mysql_query($consulta_delete);
			Header ('Location: GestionPacientes.php?Correcto=2');
		}
		
		
	} else {
		
		//Borrado lógico de paciente.
		$consulta_delete = "UPDATE pacientes SET activo = 0 WHERE idpaciente = '" . $_GET['idpaciente'] ."';";
		mysql_query($consulta_delete);//  Borrado lógico de paciente.
		Header ('Location: GestionPacientes.php?Correcto=2');
		//Borro las obras sociales
		// if ( mysql_num_rows($res) > 0 ) {
			// $consulta_delete = "UPDATE pac_obrasocial SET activo = 0 WHERE idpaciente = '" . $_GET['idpaciente'] ."';";
			// mysql_query($consulta_delete);
		// }
		
		Header ('Location: GestionPacientes.php?Correcto=2');
	}
?>
