<?php
	
	if (empty($_POST['idmedico'])) {
		Header ('Location: CargaMedico.php');
	}
	include_once('mysqlconnect.php');
	
	$idmedico=trim($_POST['idmedico']);
	$queryMedico = " 	SELECT 
								* 
						FROM 
								medicos 
						WHERE idmedico = ".$idmedico."";
					
	$resultadoMedico=mysql_query($queryMedico);
	$medico = mysql_fetch_array($resultadoMedico);
	
	if ( mysql_num_rows($resultadoMedico) == 0  ||  ($_POST['idmedico'] == $medico['idmedico']  ) ){
	
		$queryModificar = "	UPDATE medicos
							SET 
								nombre = '".$_POST['nombre']."', 
								apellido = '".$_POST['apellido']."',
								nromatricula = '".$_POST['nromatricula']."',
								email = '".$_POST['email']."',
								telefono = '".$_POST['tel']."',
								fechaNac = '".$_POST['fecnac']."',
								dni = '".$_POST['dni']."', 
								direccion = '".$_POST['dir']."'
												
							WHERE idmedico = '".$_POST['idmedico']."' 
						";

		mysql_query($queryModificar);
		
		//Obras sociales que ten�as previo a la modificacion.
		$obrasocialesPrevias = "SELECT 
										o.nombre,
										o.idobra 
								FROM 
										med_obrasocial as mo
								INNER JOIN obrasociales as o on o.idobra = mo.idobra
								WHERE  mo.idmedico=".$_POST['idmedico']." ";
								
		$resultadoObrasocialesPrevias = mysql_query($obrasocialesPrevias);
		$obrasQuePosee = array();
		
		while ($obraPrevia = mysql_fetch_array($resultadoObrasocialesPrevias)) {
			$obrasQuePosee[] = $obraPrevia['idobra'];
		}	
		
		if(isset($_POST['obra'])) {
			$obrasSeleccionadas = $_POST['obra']; //Obras Seleccionadas
		} else{
			$obrasSeleccionadas = array();
		}
		
		
		//Especialidades que ten�as previo a la modificacion.
		$especialidadesPrevias = "SELECT 
										e.nombre,
										e.idespecialidad 
								FROM 
										med_esp as me
								INNER JOIN especialidades as e on e.idespecialidad = me.idespecialidad
								WHERE  me.idmedico=".$_POST['idmedico']." ";
								
		$resultadoEspecialidadesPrevias = mysql_query($especialidadesPrevias);
		$especialidadesQuePosee = array();
		
		while ($especialidadPrevia = mysql_fetch_array($resultadoEspecialidadesPrevias)) {
			$especialidadesQuePosee[] = $especialidadPrevia['idespecialidad'];
		}	
		
		if(isset($_POST['especialidad'])) {
			$especialidadesSeleccionadas = $_POST['especialidad']; //Especialidades Seleccionadas
		} else{
			$especialidadesSeleccionadas = array();
		}
		
		$especialidadesSeleccionadasString = implode(",",$especialidadesSeleccionadas);
		
		
		//// INICIO DELETE E INSERT OBRAS Y ESPECIALIDADES ////
			
		//Borro Relaciones obras
		for($i=0; $i < count($obrasQuePosee); $i++){
			$obrasABorrarViejasConsulta = " DELETE FROM med_obrasocial 
										   WHERE idobra = ".$obrasQuePosee[$i]." 
										   AND idmedico = ".$_POST['idmedico']."";
			mysql_query($obrasABorrarViejasConsulta);
		}
		
		//Inserto relaciones obras		
		for ($i=0; $i < count($obrasSeleccionadas) ; $i++){			
			$consultaRelacionObrasMedicos = 	"	
												INSERT INTO med_obrasocial (idmedico, idobra)
												VALUES ('".$_POST['idmedico']."', '".$obrasSeleccionadas[$i]."')
												";
			mysql_query($consultaRelacionObrasMedicos); 
		}
		
		//Borro Relaciones especialidades
		for($i=0; $i < count($especialidadesQuePosee); $i++){
			$especialidadesABorrarViejasConsulta = " DELETE FROM med_esp
										   WHERE idespecialidad = ".$especialidadesQuePosee[$i]." 
										   AND idmedico = ".$_POST['idmedico']."";
			mysql_query($especialidadesABorrarViejasConsulta);
		}
		
		//Inserto relaciones especialidades		
		for ($i=0; $i < count($especialidadesSeleccionadas) ; $i++){			
			$consultaRelacionEspecialidadesMedicos = 	"	
												INSERT INTO med_esp (idmedico, idespecialidad)
												VALUES ('".$_POST['idmedico']."', '".$especialidadesSeleccionadas[$i]."')
												";
			mysql_query($consultaRelacionEspecialidadesMedicos); 
		}
		
		//// FIN DELETE E INSERT OBRAS Y ESPECIALIDADES ////
				
	 Header ("Location: GestionMedicos.php?Correcto=3");	
	} else {
	  Header ("Location: CargaMedico.php?Error=2&idmedico=".$_POST['idmedico']."");
	}
?>