<!doctype html>  


<head>
<meta charset="UTF-8">
<title>ClinicSystem - Home</title>

<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>

</head>
    
<body style="background-image:url('images/bg.png')">

	
	
	<?php
	
	include_once('mysqlconnect.php');


	$queryLicenciasBorrar = "SELECT idlicencia FROM licencias WHERE fechaHasta < CURDATE()";
	$resultadoLicenciasBorrar = mysql_query($queryLicenciasBorrar);
	
	if ( mysql_num_rows($resultadoLicenciasBorrar) > 0 ) {
		$licencias = Array();
		while ($row = mysql_fetch_array($resultadoLicenciasBorrar)) {
			$licencias[] = $row['idlicencia'];
		}
		
		$licenciasString = implode(",",$licencias);
		$queryDarDeBajaLicencias = "UPDATE licencias
									set estado = 0
									where idlicencia in (".$licenciasString.")";
		mysql_query($queryDarDeBajaLicencias);
	}
	
	
	
	for ($i=0; $i<7; $i++) {
		$fecha_a= date("Y/m/d",strtotime("+$i days"));
	
		$ano_act=substr ($fecha_a, 0, 4);
		$mes_act=substr($fecha_a, 5, 2);
		$dia_act=substr($fecha_a, 8, 2);
	
		$diaSemana = diaSemana($ano_act, $mes_act, $dia_act);
		//echo $fecha_a.' '.$diaSemana.'<br>';
		if( $diaSemana == 4 ) {
			$qry= "UPDATE horarios SET fecha = '" .$fecha_a. "' WHERE idhorario = 7 or idhorario=8 ";
			$query_mod = mysql_query($qry);
		}
		if( $diaSemana == 5 ) {
			$qry= "UPDATE horarios SET fecha = '" .$fecha_a. "' WHERE idhorario = 9 or idhorario=10 ";
			$query_mod = mysql_query($qry);
		}
		if( $diaSemana == 6 ) {
			$qry= "UPDATE horarios SET fecha = '" .$fecha_a. "' WHERE idhorario = 11";
			$query_mod = mysql_query($qry);
		}
		if( $diaSemana == 1 ) {
		    $qry= "UPDATE horarios SET fecha = '" .$fecha_a. "' WHERE idhorario = 1 or idhorario=2 ";
			$query_mod = mysql_query($qry);
		}
		if( $diaSemana == 2 ) {
			$qry= "UPDATE horarios SET fecha = '" .$fecha_a. "' WHERE idhorario = 3 or idhorario=4 ";
			$query_mod = mysql_query($qry);
		}
		if( $diaSemana == 3 ) {
			$qry= "UPDATE horarios SET fecha = '" .$fecha_a. "' WHERE idhorario = 5 or idhorario=6 ";
			$query_mod = mysql_query($qry);
		}
	}
	function diaSemana($ano,$mes,$dia)
	{	
	
	$dia= date("w",mktime(0, 0, 0, $mes, $dia, $ano));
		return $dia;
	}
	
	
	
	
	?>
	



	
	
	<?php include_once('header.php'); ?>
	
	
	
	
	
	<div class="encapsulador">
		
		<div id="imagenhome"> 
			<img src="images/homeclinic.jpg" class="img-polaroid">
		</div>
		
		<div style="margin-top: 72PX;">
			<a href="GestionObras.php"><button class="btn btn-large" type="button">Obras Sociales</button></a>
			<a href="GestionEspecialidades.php"><button class="btn btn-large" type="button">Especialidades</button></a>		
		</div>
	</div>  <!-- FIN ENCAPSULADOR-->
	
	
</body>
</html>
