<?php
 //  	if (empty($_POST['idpaciente'])) {
//		Header ('Location: GestionTurnos.php');
	//}
	include_once('mysqlconnect.php');
?>

<head>

	<meta charset="UTF-8">
	<title>ClinicSystem - Medicos</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>
	
</head>
		
<body style="background-image:url('images/bg.png')">
	
	<!--JQuery-->
	<script src='js/jquery.min.js'></script>
	<script src='js/validarFormularioMedico.js'></script>
 	<?php include_once('header.php'); ?>
	
	<div class="encapsulador">
		
		<ul class="breadcrumb">
			<li> 
				<h5>Alta de Turnos <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
													 <!-- ICONO DE AYUDA -->  
			</li>
		</ul>
		<?php
		if(isset($_GET['Error'])){
				if($_GET['Error'] == 1) {
					echo	"<div class='alert alert-error'>
								<h4>Error!! </h4>
							No se puede agregar el Medico.
							</div>";
				}
				if($_GET['Error'] == 2) {
					echo	"<div class='alert alert-error'>
								<h4>Error!! </h4>
							No se puede modificar el Medico.
							</div>";
				}
			}
		
		?>
		<?php


			if(isset($_GET['idmedico'])){
			    $idmedico = $_GET['idmedico'];
				$queryMedico = "SELECT * FROM medicos WHERE idmedico = ".$_GET['idmedico']."";
				$resultadoQueryMedico = mysql_query($queryMedico);
				$medico = mysql_fetch_array($resultadoQueryMedico);
			if(isset($_GET['idpaciente'])){
			    $idpaciente = $_GET['idpaciente'];
				$queryPaciente = "SELECT * FROM pacientes WHERE idpaciente = ".$_GET['idpaciente']."";
				$resultadoQueryPaciente = mysql_query($queryPaciente);
				$paciente = mysql_fetch_array($resultadoQueryPaciente);
			}
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
	   
	   
	   <div id="form-generar-turno"> 
		   
				<form class="form-horizontal" method="POST" action="GenerarTurno.php" enctype="multipart/form-data" > 
		  
					<div class="control-group">
						<input id="idmedico" name="idmedico" type="hidden" maxlength="50" value="<?php echo $medico['idmedico'];?>">
						<input name="idpaciente" type="hidden" value="<?php echo $medico['idmedico'];?>">
						<div class="control-group" >Nombre y Apellido del Medico
							<input class="namee" name="nombre" type="text"  value="<?php echo $medico['nombre'].', '.$medico['apellido'];?>">
						</div>
					</div>
					<div class="control-group">
						<input id="idpaciente" name="idpaciente" type="hidden"  value="<?php echo $paciente['idpaciente'];?>">
						<input name="idpaciente" type="hidden"  value="<?php echo $paciente['idpaciente'];?>">
						<div class="control-group" >Nombre y Apellido del paciente
						<input class="namee" name="nombre" type="text"  value="<?php echo $paciente['nombre'].', '.$paciente['apellido'];?>">
					</div>
							
					
					
					<div class="control-group">Fecha del turno
						<input id="fecha" name="fecha" type="text" value="<?php echo $fechaSel;?>">
						
					</div>
							
				<!-- Obras Sociales -->
				<div style="margin-left: 0px;margin-top: -6;">
					<label>Obras Sociales</label>
					<select  id="idobra" name="idobra">
					<?php
						$queryObrasMedico = "  SELECT 
														o.nombre, 
														o.idobra 
												 FROM 
														med_obrasocial AS mo
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
				
				
				<!-- Horarios -->
				<div style="margin-left: 0px;margin-top: 7px;";>
					<label>Horarios</label>
					<select id="idhora" name="idhora">
					<?php 
						if ($idhorario == 1) { $topeHora = ' AND h.idhora < 13 '; }
						if ($idhorario == 2) { $topeHora = ' AND h.idhora > 12 '; }						
							$queryMedicoHorario = "SELECT * 
													FROM hora AS h
													WHERE h.idhora NOT 
													IN (
													SELECT t.idhora
														FROM turnos AS t
														INNER JOIN hora AS h ON t.idhora = h.idhora
														INNER JOIN medicos AS m ON t.idmedico = m.idmedico
														WHERE t.idhora = h.idhora 
														 AND t.fecha = '$fechaSel'
														AND t.idmedico = '$idmedico'
														)
														AND
														 h.idhora NOT IN (
														SELECT t.idhora
														FROM turnos AS t
														INNER JOIN hora AS h ON t.idhora = h.idhora
														INNER JOIN pacientes AS p ON t.idpaciente = p.idpaciente
														WHERE t.idhora = h.idhora 
														 AND t.fecha = '$fechaSel'
														AND t.idpaciente = '$idpaciente'
														)".$topeHora;
							
													
						echo $queryMedicoHorario;				
							
						$hora = mysql_query($queryMedicoHorario);
					
						
						
						while ($medicoHorario = mysql_fetch_array($hora)) {
							
						?>
							
							<option  value="<?php echo $medicoHorario["idhora"];?>"><?php echo $medicoHorario["hora"];?></option>
						<?php
						}
						?>
					</select>	
					
						
				</div>
		
		
		
		
				
				<div style="margin-left:300px;margin-top: 120px;">
					<div id="form-alta-turno" style="margin-left: 15px;"> 
		   
		  
						<div style="margin-left:300px;margin-top: 90px;">
							<input type="submit"  value"filtrar" name="agregar"/>
							
							
						</div>
				
			</div>
					
				</div>		
				
				
			</form>
		</div>
		<?php
			}
		?>
		
	</div>  <!-- FIN ENCAPSULADOR-->

</body>
</html>