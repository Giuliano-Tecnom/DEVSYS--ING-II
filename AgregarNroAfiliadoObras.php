<?php

include_once('mysqlconnect.php');

	if(isset($_POST['idpaciente'])){
		$idpaciente = $_POST['idpaciente'];
		$obrasString = ($_POST['obras']);
		$obras = explode(",",$obrasString);
		
		foreach ($obras as $idObra){
			$nro=$_POST[$idObra]; //Esto es el numero de afiliado que se cargan en los textfields de las Obras.
			// Busco si hay un paciente con el mismo numero de afiliado en la misma obra social.
			$queryAfiliadoExistente = "	SELECT 
												* 
										FROM 
												pac_obrasocial 
										WHERE 
												nroAfiliado = ".$nro." 
										AND 	idobra = ".$idObra."";
			$existe = mysql_query($queryAfiliadoExistente);
			
			if ( mysql_num_rows($existe) == 0 ) {
				// Se inserta la relacion: obra social <-> paciente con Numero de Afiliado
				foreach ($obras as $idObra) {
					$queryRelacion = "INSERT INTO pac_obrasocial (idpaciente,idobra,nroAfiliado)
									  VALUES (".$idpaciente.", ".$idObra.", ".$nro." ) ";
					mysql_query($queryRelacion);
				}
				Header ('Location: GestionPacientes.php?Correcto=1');	
			} else {
				Header ("Location: AddNroAfiliado.php?idpaciente=" .$_POST['idpaciente']. "&Error=1&idobra=" .$obras[$i]. " ");
			}
		}
	} else {
		Header ('Location: FatalError.html');
	}
?>