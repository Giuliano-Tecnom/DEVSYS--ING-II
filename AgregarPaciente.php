<?php

include_once('mysqlconnect.php');
	
	$obras=$_POST['obra'];
	$dni=(int)trim(($_POST['dni']));
	$consulta = " SELECT dni FROM pacientes where dni = '" . $dni. "' ";
	$res=mysql_query($consulta);
	
	if ( mysql_num_rows($res) == 0 ){
		$consulta = "INSERT INTO pacientes(dni,apellido, nombre,email
										   ,telefono,fechaNac,direccion)
					VALUES ('" . $dni. "','" .$_POST['apellido']. "','" .$_POST['nombre']. "',
							'" .$_POST['email']. "','" .$_POST['tel']. "','" .$_POST['fecnac']. "',
							'" .$_POST['dir']. "' )
					";
		mysql_query($consulta);
		
		for ($i=0; $i < count($obras) ; $i++){
	        $consulta = "INSERT INTO pac_obrasocial (dni,idobra)
						VALUES ('" .$dni. "','" .$obras[$i]. "')
						";
			
			mysql_query($consulta);
		}
		
		if (count($obras)==0) {
		
			Header ('Location: AltaPacientes.php?Correcto=1');
	    
		}else{
	    
			Header ("Location: AddNroAfiliado.php?dni='" .$dni. "' ");
		
		}	 
	
	}else{
	    
		Header ('Location: AltaPacientes.php?Error=1');
	
	}
	
?>

