<?php

include_once('mysqlconnect.php');


	if(isset($_POST['idpaciente'])){ 

		if (isset($_POST['obrasSoloIDS'])) {
			$obrasSoloIDS = explode(",",$_POST['obrasSoloIDS']);
		} else {
			$obrasSoloIDS = array();
		}
		if (isset($_POST['obrasABorrarString'])) {
			$obrasABorrar = explode(",",$_POST['obrasABorrarString']);
		} else {
			$obrasABorrar = array();
		}

		//Borro Relaciones
		for($i=0; $i < count($obrasABorrar); $i++){
			$obrasABorrarViejasConsulta = " DELETE FROM pac_obrasocial 
										   WHERE idobra = ".$obrasABorrar[$i]." 
										   AND idpaciente = ".$_POST['idpaciente']."";
			mysql_query($obrasABorrarViejasConsulta);
		}
		for ($i=0; $i < count($obrasSoloIDS) ; $i++){
			$nro=$_POST[$obrasSoloIDS[$i]]; //Esto es el numero de afiliado que se cargan en los textfields de las Obras.
			// Busco si hay un paciente con el mismo numero de afiliado en la misma obra social.
			$consulta = "SELECT * FROM pac_obrasocial WHERE nroAfiliado = '".$nro."' AND idobra = '" .$obrasSoloIDS[$i]. "' " ;
			$res = mysql_query($consulta);
			
			if ( mysql_num_rows($res) == 0 ){
				$consulta = "INSERT INTO pac_obrasocial (idpaciente, idobra, nroAfiliado)
							 VALUES ('".$_POST['idpaciente']."', '".$obrasSoloIDS[$i]."', '".$nro."')";
				mysql_query($consulta); 

				Header ('Location: GestionPacientes.php?Correcto=3');	
			} else {
				Header ("Location: GestionPacientes.php?idpaciente=" .$_POST['idpaciente']. "&Error=4&idobra=" .$obrasSoloIDS[$i]. " ");
			}
		
		}
		if (count($obrasSoloIDS) == 0){
			Header ('Location: GestionPacientes.php?Correcto=3');
		}
	}else{
	
		Header ('Location: FatalError.html');
	
	}
	
	
?>