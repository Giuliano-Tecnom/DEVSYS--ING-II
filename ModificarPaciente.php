<?php
	
	if (empty($_POST['idpaciente'])) {
		Header ('Location: Pacientes.php');
	}
	include_once('mysqlconnect.php');
	
	$idpaciente=trim($_POST['idpaciente']);
	$dni=trim($_POST['dni']);
	$queryPaciente = " 	SELECT 
								* 
						FROM 
								pacientes 
						WHERE idpaciente <> ".$idpaciente."
						AND dni = ".$dni."";
					
	$resultadoPaciente=mysql_query($queryPaciente);
	$paciente = mysql_fetch_array($resultadoPaciente);
	
	if ( mysql_num_rows($resultadoPaciente) == 0 ) {
	
		$queryModificar = "	UPDATE pacientes 
							SET 
								nombre = '". $_POST['nombre']."', 
								apellido = '".$_POST['apellido']."',
								dni = '".$_POST['dni']."', 
								email = '".$_POST['email']."', 
								telefono = '".$_POST['tel']."', 
								direccion = '".$_POST['dir']."',
								fechaNac = '".$_POST['fecnac']."' 
							WHERE idpaciente = '".$_POST['idpaciente']."' 
						";	
		mysql_query($queryModificar);
		
		//Obras sociales que tenías previo a la modificacion.
		$obrasocialesPrevias = "SELECT 
										nombre,
										obrasociales.idobra 
								FROM 
										pac_obrasocial
								INNER JOIN obrasociales on obrasociales.idobra=pac_obrasocial.idobra
								WHERE  idpaciente=".$_POST['idpaciente']." ";
								
		$resultadoObrasocialesPrevias = mysql_query($obrasocialesPrevias);
		$obrasQuePosee = array();
		
		while ($obraPrevia = mysql_fetch_array($resultadoObrasocialesPrevias)) {
			$obrasQuePosee[] = $obraPrevia['idobra'];
		}	
		
		if(isset($_POST['obra'])) {
			$obrasSeleccionadas = $_POST['obra']; //Obras Seleccionadas
		} else{
			$obrasSeleccionadas;
		}
		
		$obrasBorrarString = implode(",",$obrasQuePosee);
		$obrasSeleccionadasString = implode(",",$obrasSeleccionadas);
		
	 	Header ("Location: ModNroAfiliado.php?idpaciente=".$idpaciente."&obras=".$obrasSeleccionadasString."&oaborrar=".$obrasBorrarString."");	
	} else {
	  Header ("Location: Pacientes.php?Error=1&idpaciente=".$_POST['idpaciente']."");
	}
?>