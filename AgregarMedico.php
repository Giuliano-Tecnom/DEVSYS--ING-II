<?php

include_once('mysqlconnect.php');
	
	$obras=$_POST['obra'];
	$esp=$_POST['especialidad'];
	$horarios=$_POST['horarios'];
	
	
	$nromatricula=(int)trim(($_POST['nromatricula']));
	$nrodni=(int)trim(($_POST['dni']));
	$consultaExistente = " SELECT * FROM medicos where nromatricula = ".$nromatricula." OR dni = ".$nrodni."";
	$existente=mysql_query($consultaExistente);
	

	if(!isset($_POST['especialidad'])) {
		Header ("Location: AltaMedicos.php?Error=2");
	} else {
		if ( mysql_num_rows($existente) == 0 ){
			//Insertar pacientes
			$queryAgregarMedico = "INSERT INTO medicos(dni, apellido, nombre, email, telefono, fechaNac, direccion, nromatricula)
						VALUES (
								'".$_POST['dni']."',
								'".$_POST['apellido']."',
								'".$_POST['nombre']."',
								'".$_POST['email']."',
								'".$_POST['tel']."',
								'".$_POST['fecnac']."',
								'".$_POST['dir']."',
								'".$nromatricula."'
								)
						";
			mysql_query($queryAgregarMedico);
			
			//Consulta idMedico
			$queryIdMedico = "	SELECT idmedico 
								FROM   medicos
								WHERE  nromatricula = ".$nromatricula."";
			
			$result = mysql_query($queryIdMedico);
			$rowMedico = mysql_fetch_assoc($result);
			$idmedico = $rowMedico['idmedico'];
			//Insertar obra
			for ($i=0; $i < count($obras) ; $i++){
				$queryRelacionObraMedico = "INSERT INTO med_obrasocial (idmedico, idobra)
											VALUES ('".$idmedico."', '".$obras[$i]."')
							";
				
				mysql_query($queryRelacionObraMedico);
			}
			
			//Insertar relacion hr - medico
			for ($i=0; $i < count($horarios) ; $i++){
				$queryRelacionHorarioMedico = "INSERT INTO med_hor (idmedico, idhorario)
											   VALUES ('".$idmedico."', '".$horarios[$i]."')
											  ";
				
				mysql_query($queryRelacionHorarioMedico);
			}
			
			for ($i=0; $i < count($esp) ; $i++){
				$queryRelacionEspecialidadMedico = "INSERT INTO med_esp (idmedico, idespecialidad)
													VALUES ('".$idmedico."', '".$esp[$i]."')
													";
				
				mysql_query($queryRelacionEspecialidadMedico);
			}
			Header ('Location: GestionMedicos.php?Correcto=1');    
		} else {
			Header ('Location: AltaMedicos.php?Error=1');
		}
	}
?>

