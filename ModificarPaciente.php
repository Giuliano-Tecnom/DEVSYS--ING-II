<?php
	
	if (empty($_POST['dni']))
	{
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
		$consulta = "SELECT nombre,obrasociales.idobra FROM pac_obrasocial
							              INNER JOIN obrasociales on obrasociales.idobra=pac_obrasocial.idobra
										 WHERE  dni=".$_POST['dni']." ";
		$resultado = mysql_query($consulta);
		
		while ($valor = mysql_fetch_array($resultado)) {
			$obrasAnt[] = $valor['idobra'];
		}
		
		$obrasNvas= $_POST['obra']; //Obras nuevas
		
		$obrasBorrar = array_diff($obrasAnt, $obrasNvas); // obras a borrar
		
		for($i=0; $i < count($obrasBorrar); $i++){
			$consulta = " DELETE FROM obrasociales WHERE idobra = ".$obrasBorrar[$i]." ";
			$resultado = mysql_query($consulta);
		}
		

		
		
		
	//	Header ("Location: ModNroAfiliado.php?dni=".$dni." ");
	
	}else{
	 //  Header ("Location: Pacientes.php?Error=1");
	
	}
?>