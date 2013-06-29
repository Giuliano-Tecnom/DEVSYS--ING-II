 <?php
include_once('mysqlconnect.php');

    $licencias = "SELECT fechaDesde, fechaHasta, estado
			      FROM medicos as m
				  INNER JOIN licencias as l ON l.idmedico=m.idmedico 
				  WHERE l.estado = 1 AND m.idmedico = ".$_GET['idmedico']."";
	
							
	$reslic = mysql_query($licencias);

	while($valor = mysql_fetch_array($reslic)){
		$fec = $_GET['fecha'];
		$idmed = $_GET['idmedico'];
		$idhor = $_GET['idhorario'];
		if($valor['fechaDesde'] <= $_GET['fecha'] && $valor['fechaHasta'] >= $_GET['fecha']){
				Header ("Location: AltaTurnos1.php?filtro=S&myselect2=".$idmed."&myselect3=0&myselect4=0&myselect5=".$idhor."&fecha=".$fec."");
		}
	}

?>


<?php
	
	
	
	// CONFIGURACION DE HORA Y FECHA PARA CONSULTAS!!!...



date_default_timezone_set('America/Argentina/Buenos_Aires');
setlocale(LC_TIME, 'spanish');
$time = strftime("%H:%M");
$date = date("Y-m-d"); 			

 
//FIN DE CONFIGURACION DE HORA Y FECHA!!!..
	
	
?>



<head>

	<meta charset="UTF-8">
	<title>ClinicSystem - Turnos</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>
	<!-- Scripts para búsqueda y filtro-->
<script type="text/javascript" src="sh/shCore.js"></script>
<script type="text/javascript" src="sh/shBrushJScript.js"></script>
<script type="text/javascript" src="./sh/jquery.min.js"></script> 
<script type="text/javascript" src="./sh/jquery.searchabledropdown-1.0.8.min.js"></script>

	<!-- Scripts para búsqueda y filtro-->
	<script type="text/javascript">
		$(document).ready(function() {
			$("select").searchable();
		});
	
	
		// demo functions
		$(document).ready(function() {
			$("#value").html($("#myselect :selected").text() + " (VALUE: " + $("#myselect").val() + ")");
			$("select").change(function(){
				$("#value").html(this.options[this.selectedIndex].text + " (VALUE: " + this.value + ")");
			});
		});
	
		function modifySelect() {
			$("select").get(0).selectedIndex = 5;
		}
	
		function appendSelectOption(str) {
			$("select").append("<option value=\"" + str + "\">" + str + "</option>");
		}
	
		function applyOptions() {			  
			$("select").searchable({
				maxListSize: $("#maxListSize").val(),
				maxMultiMatch: $("#maxMultiMatch").val(),
				latency: $("#latency").val(),
				exactMatch: $("#exactMatch").get(0).checked,
				wildcards: $("#wildcards").get(0).checked,
				ignoreCase: $("#ignoreCase").get(0).checked
			});
	
			alert(
				"OPTIONS\n---------------------------\n" + 
				"maxListSize: " + $("#maxListSize").val() + "\n" +
				"maxMultiMatch: " + $("#maxMultiMatch").val() + "\n" +
				"exactMatch: " + $("#exactMatch").get(0).checked + "\n"+
				"wildcards: " + $("#wildcards").get(0).checked + "\n" +
				"ignoreCase: " + $("#ignoreCase").get(0).checked + "\n" +
				"latency: " + $("#latency").val()
			);
		}
	</script>
</head>
		
<body style="background-image:url('images/bg.png')">
	

	 <?php  $x=1; ?>
 	<?php include_once('header.php'); ?>
	
	<div class="encapsulador">
		<div class="contenedor">
			
			<ul class="breadcrumb">
				<li> 
					<h5>Alta de Turnos <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
														 <!-- ICONO DE AYUDA -->  
				</li>
			</ul>

			<?php

				if(isset($_GET['idmedico'])){
				    $idmedico = $_GET['idmedico'];
					$queryMedico = "SELECT * FROM medicos WHERE idmedico = ".$_GET['idmedico']."";
					$resultadoQueryMedico = mysql_query($queryMedico);
					$medico = mysql_fetch_array($resultadoQueryMedico);
				
				if(isset($_GET['fecha'])){
					$fechaSel = $_GET['fecha'];
				}
				
				if(isset($_GET['idhorario'])){
					$horario = $_GET['idhorario'];
					if(($horario == 1) or ($horario == 3) or ($horario == 5) or ($horario == 7) or ($horario == 9) or ($horario == 11)){
						$idhorario = 1;
					}

					if(($horario == 2) or ($horario == 4) or ($horario == 6) or ($horario == 8) or ($horario == 10)){
						$idhorario = 2;
					} 
					
				}
				
			
		   ?>
		   
		   	   
		   
		   <div id="form-turno"> 
			   <form class="form-horizontal" name="filtro" method="POST" action="GenerarTurno.php" enctype="multipart/form-data" > 
			  		<!-- ***************************** SELECT DE PACIENTES ***************************** -->
			  		<div class="control-group">
				  		<?php 
							$consulta = "SELECT * FROM pacientes WHERE pacientes.activo = 1";
	   						$query_pac = mysql_query($consulta);
				  		?>
						<label>Paciente:</label>
						<select id="myselect1" name="myselect1">
							<option value=0>Seleccione paciente</option>
							<?php
								while ($valor = mysql_fetch_array($query_pac)) {
									if ($myselect1 == $valor["idpaciente"]) {
										$sel= " SELECTED ";
									}else{
										$sel= "";
									}
							?>
									<option value="<?php echo $valor["idpaciente"];?>" <?php echo $sel;?>><?php echo $valor["nombre"]; ?> <?php echo $valor["apellido"]; ?></option>
							<?php	  
								}
							?>
						</select>
					</div>

			  		<div class="control-group">
						<label> Medico:<?php echo $medico['nombre'].', '.$medico['apellido'];?> </label>
						<input type="hidden" id="idmedico" name="idmedico" value="<?php echo $idmedico ?>">
					</div>

					<div class="control-group">
						<label> Fecha: <?php echo $fechaSel;?> </label>
						<input type="hidden" id="fecha" name="fecha" value="<?php echo $fechaSel ?>">
					</div>
								
					<!-- Obras Sociales -->
					<div class="control-group">
						<label>Obras Sociales</label>
						<select  id="idobra" name="idobra">
						<?php
							$queryObrasMedico = "SELECT o.nombre, o.idobra 
												 FROM med_obrasocial AS mo
												 INNER JOIN obrasociales AS o on o.idobra = mo.idobra
												 INNER JOIN medicos AS m on m.idmedico = mo.idmedico
												 WHERE  m.idmedico=".$_GET['idmedico']." ";
							$resultadoQueryObrasMedico = mysql_query($queryObrasMedico);
						
							while ($obrasMedico = mysql_fetch_array($resultadoQueryObrasMedico)) {
						?>
								<option  value="<?php echo $obrasMedico["idobra"];?>"><?php echo $obrasMedico["nombre"]; ?></option>
						<?php	  
							}
						?>
						</select>
					</div>
					<!-- ******************** Horarios ****************** -->
					<div class="control-group">
						<label>Horarios</label>
						<select id="idhora" name="idhora">
						<?php 
							if ($idhorario == 1) { $topeHora = ' AND h.idhora < 13 '; }
							if ($idhorario == 2) { $topeHora = ' AND h.idhora > 12 '; }						
								$queryMedicoHorario = "SELECT *
													   FROM hora AS h
													   WHERE idhora NOT IN (SELECT h.idhora
																			FROM hora AS h
																			INNER JOIN turnos AS t ON h.idhora = t.idhora
																			WHERE idmedico = '$idmedico' AND fecha = '$fechaSel') ".$topeHora." ";	
								
								$hora = mysql_query($queryMedicoHorario);
						
							while ($medicoHorario = mysql_fetch_array($hora)) {
								if ($_GET['fecha'] == $date) {
									if($medicoHorario["hora"] > $time){
						?>
										<option  value="<?php echo $medicoHorario["idhora"]?>" > <?php echo $medicoHorario["hora"];?> </option>
						<?php
									}
								}else {
								?>
									<option  value="<?php echo $medicoHorario["idhora"]?>" > <?php echo $medicoHorario["hora"];?> </option>
							<?php	
								
								}
							}
						?>
						</select>	
					</div>
					<button class='btn btn-success' type='submit'> Dar de Alta </button>
				</form>
			</div>
			<?php
				}
			?>
		</div>	
	</div>  <!-- FIN ENCAPSULADOR-->

</body>
</html>