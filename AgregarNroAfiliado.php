<?php

include_once('mysqlconnect.php');



	if(isset($_POST['dni'])){ 

		
	
		$obras = unserialize(stripslashes($_POST['obras']));
	
		for ($i=0; $i < count($obras) ; $i++){
			$nro=$_POST[$obras[$i]]; //Esto es el numero de afiliado que se cargan en los textfields de las Obras.
			$consulta = "SELECT * FROM pac_obrasocial WHERE nroAfiliado = '".$nro."' AND idobra = '" .$obras[$i]. "' " ;
			$res = mysql_query($consulta);
			// Busco si hay un paciente con el mismo numero de afiliado en la misma obra social.
			
			if ( mysql_num_rows($res) == 0 ){
				$consulta = "UPDATE pac_obrasocial 
							SET nroAfiliado= '".$nro."'
							WHERE dni= " .$_POST['dni']. " and idobra= '" .$obras[$i]. "' 
							";
				mysql_query($consulta); 
				
				Header ('Location: AltaPacientes.php?Correcto=1');	
			}else{
			
				Header ("Location: AddNroAfiliado.php?dni=" .$_POST['dni']. "&Error=1&idobra=" .$obras[$i]. " ");
			}

		}
		
		
	
	}else{
	
		Header ('Location: FatalError.html');
	
	}
	
	
?>