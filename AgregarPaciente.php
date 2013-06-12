<?php

include_once('mysqlconnect.php');
	
	$obras=$_POST['obra'];
	$dni=(int)trim(($_POST['dni']));
	$queryExistente = " SELECT dni FROM pacientes where dni = " . $dni. " ";
	$existente=mysql_query($queryExistente);

	if ( mysql_num_rows($existente) == 0 ){
	    //Insertar pacientes
		$queryAgregarPaciente = "INSERT INTO pacientes(dni, apellido, nombre, email, telefono, fechaNac, direccion)
								VALUES (
										'".$dni."',
										'".$_POST['apellido']."',
										'".$_POST['nombre']."',
										'".$_POST['email']."',
										'".$_POST['tel']."',
										'".$_POST['fecnac']."',
										'".$_POST['dir']."'
										)
								";
		mysql_query($queryAgregarPaciente);
		if (count($obras)==0) {
			Header ('Location: AltaPacientes.php?Correcto=1');
	    } else {
			$obrasString = implode(",",$obras);
			$queryIdPaciente = " 	SELECT 
											*
									FROM
											pacientes
									WHERE dni = ".$dni."
								";
			$result = mysql_query($queryIdPaciente);
			$rowPaciente = mysql_fetch_assoc($result);
			Header ("Location: AddNroAfiliadoObras.php?obras=".$obrasString."&idpaciente=".$rowPaciente['idpaciente']."");
		}	 
	} else {
	    Header ('Location: AltaPacientes.php?Error=1');
	}
?>

