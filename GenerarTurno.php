<?php
	include_once('mysqlconnect.php');
//	if ((empty($_POST['idmedico'])) or (empty($_POST['idpaciente'])) or (empty($_POST['idhora'])) or (empty($_POST['idobra'])) or (empty($_POST['fecha'])))  {
//		Header ('Location: AltaTurno.php');
//	}
	
	
	$idmedico= $_POST['idmedico'];
	$idpaciente= $_POST['myselect1'];
	$idhora= $_POST['idhora'];
	$idobra= $_POST['idobra'];
	$fecha= $_POST['fecha']; 
	
	
	if ($idpaciente == 0){
			Header ("Location: AltaTurno.php?idmedico=".$idmedico."&idhorario=".$idhora."&fecha=".$fecha."&Error=7");
	
	}
	else {
	$queryPacienteHorario = "SELECT h.idhora
							 FROM hora AS h
							 INNER JOIN turnos AS t ON h.idhora = t.idhora
							 WHERE idpaciente = '$idpaciente' AND fecha = '$fecha' AND h.idhora = '$idhora' ";						
	$puede = mysql_query($queryPacienteHorario);
	if(	mysql_num_rows($puede) == 0){
		$addturno = "INSERT INTO turnos (idmedico, idpaciente, idobra, idhora, fecha) VALUES ('".$idmedico."','".$idpaciente."', '".$idobra."', '".$idhora."', '".$fecha."' )";
		mysql_query($addturno);
	}
		
		
			
		
	
	
			Header ("Location: GestionTurnos.php?Correcto=1"); 
		
	}
?>