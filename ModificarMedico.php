<?php
	
	if (empty($_POST['idmedico'])) {
		Header ('Location: CargaMedico.php');
	}
	include_once('mysqlconnect.php');
	
	$idmedico=trim($_POST['idmedico']);
	$nromatricula=(int)trim(($_POST['nromatricula']));
	$nrodni=(int)trim(($_POST['dni']));
	$consultaExistente = " SELECT * FROM medicos where (nromatricula = ".$nromatricula." OR dni = ".$nrodni.") and idmedico <> ".$idmedico."";
	$existente=mysql_query($consultaExistente);
	$medico = mysql_fetch_array($existente);
	
	if ( mysql_num_rows($existente) == 0 ){
	
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
		
		//Obras sociales que tenías previo a la modificacion.
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
		
		
		//Especialidades que tenías previo a la modificacion.
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
		
		
		//Horarios que tenías previo a la modificacion.
		$horariosPrevios = "SELECT 
										h.idhorario
								FROM 
										horarios as h
								INNER JOIN med_hor as mh on h.idhorario = mh.idhorario
								WHERE  mh.idmedico=".$_POST['idmedico']." ";
								
		$ResultadoHorariosPrevios = mysql_query($horariosPrevios);
		$horariosQuePosee = array();
		
		while ($horarioPrevio = mysql_fetch_array($ResultadoHorariosPrevios)) {
			$horariosQuePosee[] = $horarioPrevio['idhorario'];
		}	
		
		if(isset($_POST['horarios'])) {
			$horariosSeleccionados = $_POST['horarios']; //Horarios Seleccionados
		} else{
			$horariosSeleccionados = array();
		}
		
		
		//// INICIO DELETE E INSERT OBRAS, ESPECIALIDADES Y HORARIOS ////
			
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
		
		//Borro Relaciones horarios
		for($i=0; $i < count($horariosQuePosee); $i++){
			$horariosABorrarViejasConsulta = " DELETE FROM med_hor
											   WHERE idhorario = ".$horariosQuePosee[$i]." 
										       AND idmedico = ".$_POST['idmedico']."";
			mysql_query($horariosABorrarViejasConsulta);
		}
		
		//Inserto relaciones horarios		
		for ($i=0; $i < count($horariosSeleccionados) ; $i++){			
			$consultaRelacionHorariosMedicos = 	"	
												INSERT INTO med_hor (idmedico, idhorario)
												VALUES ('".$_POST['idmedico']."', '".$horariosSeleccionados[$i]."')
												";
			mysql_query($consultaRelacionHorariosMedicos); 
		}
		
		//// FIN DELETE E INSERT OBRAS, ESPECIALIDADES Y HORARIOS ////
				
	 Header ("Location: GestionMedicos.php?Correcto=3");	
	} else {
	  Header ("Location: CargaMedico.php?Error=2&idmedico=".$_POST['idmedico']."");
	}
?>