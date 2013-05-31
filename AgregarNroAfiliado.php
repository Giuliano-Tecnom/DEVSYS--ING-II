<?php

include_once('mysqlconnect.php');
	    
		
	echo $_POST['dni'];
	$obras = unserialize(stripslashes($_POST['obras']));
	
	 for ($i=0; $i < count($obras) ; $i++)
	     {
		   $nro=$_POST[$obras[$i]];
		   
	        $consulta = "UPDATE pac_obrasocial 
			             SET nroAfiliado= '".$nro."'
						 WHERE dni= " .$_POST['dni']. " and idobra= '" .$obras[$i]. "'
			
	             
	        ";
		
	 mysql_query($consulta);
	 
	}
	Header ('Location: AltaPacientes.php?Correcto');	
	
	
?>