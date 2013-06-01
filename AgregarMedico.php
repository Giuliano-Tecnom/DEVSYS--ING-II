<?php

include_once('mysqlconnect.php');
	
	$obras=$_POST['obra'];
	$esp=$_POST['especialidad'];
	
	
	$nrolicencia=(int)trim(($_POST['nrolicencia']));
	
	
	$consulta = " SELECT nrolicencia FROM medicos where nrolicencia = " . $nrolicencia. " ";
	$res=mysql_query($consulta);
	echo $consulta;
	
	if ( mysql_num_rows($res) == 0 ){
	    //Insertar pacientes
		$consulta = "INSERT INTO medicos(nrolicencia,dni,apellido, nombre,email
										   ,telefono,fechaNac,direccion)
					VALUES ('" . $nrolicencia. "','" .$_POST['dni']. "','" .$_POST['apellido']. "','" .$_POST['nombre']. "',
							'" .$_POST['email']. "','" .$_POST['tel']. "','" .$_POST['fecnac']. "',
							'" .$_POST['dir']. "' )
					";
		mysql_query($consulta);
		
		//Insertar obra
		for ($i=0; $i < count($obras) ; $i++){
	        $consulta = "INSERT INTO med_obrasocial (nrolicencia,idobra)
						VALUES ('" .$nrolicencia. "','" .$obras[$i]. "')
						";
			
			mysql_query($consulta);
		}
		
		for ($i=0; $i < count($esp) ; $i++){
	        $consulta = "INSERT INTO med_esp (nrolicencia,idespecialidad)
						VALUES ('" .$nrolicencia. "','" .$esp[$i]. "')
						";
			
			mysql_query($consulta);
		}
		Header ('Location: AltaMedicos.php?Correcto=1');
	    
		
		

	
	}else{
	    
		Header ('Location: AltaMedicos.php?Error=1');
	
	}
	
?>

