<?php
	include_once('mysqlconnect.php');
//	if ((empty($_POST['idmedico'])) or (empty($_POST['idpaciente'])) or (empty($_POST['idhora'])) or (empty($_POST['idobra'])) or (empty($_POST['fecha'])))  {
//		Header ('Location: AltaTurno.php');
//	}
	echo '------- ENTRO ';
	
	
	$idmedico=trim($_REQUEST['idmedico']);
	$idpaciente=trim($_POST['idpaciente']);
	$idhora=trim($_POST['idhora']);
	$idobra=trim($_POST['idobra']);
	$fecha=trim($_POST['fecha']);
	
	
	$queryInsertar = "INSERT INTO turnos(idmedico, idpaciente, idobra, idhora, fecha)
					VALUES (
							'".$idmedico."',
							'".$idpaciente."',
							'".$idobra."',
							'".$idhora."',
						    '".$fecha."'
							)
							";
		echo $queryInsertar;
		mysql_query($queryInsertar);
		
					
	 Header ("Location: GestionTurnos.php?Correcto=4");	
	
?>