<?php
	
	include_once('mysqlconnect.php');
	
	if (!isset($_GET['idespecialidad']))
	{
		Header ('Location: GestionEspecialidades.php');
	}
	
	$consultaRelacionesConMedicos = 	"SELECT * 
											FROM especialidades as e
											INNER JOIN med_esp as me
											ON e.idespecialidad = me.idespecialidad
											WHERE e.idespecialidad = '" . $_GET['idespecialidad'] ."' ";
											
	$relMedicos = mysql_query($consultaRelacionesConMedicos);									
											
	if (mysql_num_rows($relMedicos) == 0) {										
		$consulta_delete = "UPDATE especialidades SET activo = 0 WHERE idespecialidad = '" . $_GET['idespecialidad'] ."';";
		mysql_query($consulta_delete);
		Header ('Location: GestionEspecialidades.php');
	} else {
		Header ('Location: GestionEspecialidades.php?Error=1');
	}
	
	
?>
