<?php
	
	if (empty($_POST['dni'])) {
		Header ('Location: Pacientes.php');
	}
	
	include_once('mysqlconnect.php');
	
	$dni=trim($_POST['dni']);
	$consulta = " SELECT * FROM pacientes where dni = '" . $dni . "' ";
	$res=mysql_query($consulta);
	
	$valor = mysql_fetch_array($res);
	
	if ( mysql_num_rows($res) == 0  ||  ($_POST['idpaciente'] == $valor['idpaciente']  ) ){
		
		$consulta_modif = "UPDATE pacientes SET nombre = '" . $_POST['nom'] . "', apellido = '" . $_POST['ape'] . "',
		dni = '" . $_POST['dni'] . "', email = '" . $_POST['email'] . "', telefono = '" . $_POST['tel'] . "', direccion = '" . $_POST['dir'] . "',
		fechaNac = '" . $_POST['fecnac'] . "' WHERE idpaciente = '" . $_POST['idpaciente'] . "' ";
		
		$modif = mysql_query($consulta_modif);
		
		//Obras sociales que tenías previo a la modificacion.
		$obrasocialesPrevias = "SELECT nombre,obrasociales.idobra FROM pac_obrasocial
							              INNER JOIN obrasociales on obrasociales.idobra=pac_obrasocial.idobra
										 WHERE  dni=".$_POST['dni']." ";
		$resultado = mysql_query($obrasocialesPrevias);
		
		$obrasQuePosee = array();
		while ($valor = mysql_fetch_array($resultado)) {
			$obrasQuePosee[] = $valor['idobra'];
		}
		
		if(isset($_POST['obra'])){
			$obrasSeleccionadas = $_POST['obra']; //Obras Seleccionadas
		} else{
			$obrasSeleccionadas;
		}
		$obrasBorrar = array();
		/*if(count($obrasQuePosee) > 0) {
			if(count($obrasSeleccionadas) > 0) {
				$obrasBorrar = array_diff($obrasQuePosee, $obrasSeleccionadas); // obras a borrar
			} else {
				$obrasBorrar = $obrasQuePosee;
			}
		}*/
		$obrasBorrarString = implode(",",$obrasQuePosee);
		
		$obrasSeleccionadasString = implode(",",$obrasSeleccionadas);
			
		echo count($obrasBorrar);
	 	Header ("Location: ModNroAfiliado.php?dni=".$dni."&obras=".$obrasSeleccionadasString."&oaborrar=".$obrasBorrarString."");
	
	} else {
	  Header ("Location: Pacientes.php?Error=1");
	
	}
?>