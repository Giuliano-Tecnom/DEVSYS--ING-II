<?php
	
	include_once('mysqlconnect.php');
	$consulta = "SELECT medicos.nombre as nommed,medicos.apellido as apemed , e.nombre as area, pacientes.nombre as pacnom
	            ,pacientes.apellido as pacape,
                 hora.hora, obrasociales.nombre as nomobra, t.fecha, t.idturno,t.estado
               	FROM turnos as t
	             inner join medicos on medicos.idmedico=t.idmedico
				 inner join pacientes on pacientes.idpaciente=t.idpaciente
				 left join obrasociales on obrasociales.idobra=t.idobra
				 inner join hora on hora.idhora=t.idhora
				 inner join especialidades as e on t.idespecialidad = e.idespecialidad
				 WHERE t.estado='en espera'
				 ORDER BY t.fecha,hora.hora
				 ";
	        
    $resultado = mysql_query($consulta);
	

?> 
<html>
<head>
<meta charset="UTF-8">
<title>ClinicSystem - Gestion Turnos</title>

<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>

</head>
		<!-- Fin de HEAD-->
    
<body style="background-image:url('images/bg.png')">
 	
	<?php include_once('header.php'); ?>
	
	<div class="encapsulador">
	
		<div class="contenedor">
			
			<ul class="breadcrumb">
				<li> 
					<h5>Gestion de Turnos<a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
														 <!-- ICONO DE AYUDA -->  
				</li>
			</ul>
		  	
			<?php 
		  		// MANEJADOR DE ERRORES!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

			
				
				if(isset($_GET['Correcto'])){
					if($_GET['Correcto'] == 1){
						echo"<div class='alert alert-success'>
							<h4>Exito!</h4>
							El turno se dio de alta correctamente.
							</div>";
					}
					if($_GET['Correcto'] == 2){
						echo"<div class='alert alert-success'>
							<h4>Exito!</h4>
							El turno se dio de baja correctamente.
							</div>";
					}
				}
				
							
			?>
			
			<!-- COMIENZA BARRA DE OPCIONES -->
			<div class="btn-group" style="margin-top: 45px; margin-left: 270;">
			        <button class="btn btn-info" type="button" onclick="location.href='AltaTurnos1.php'">Generar Turno</button>
                    <button class="btn btn-info" type="button" onclick="location.href='ReporteTurnos.php?estado=en espera'">Generar Reporte</button>

			</div>
			<!-- FIN BARRA DE OPCIONES -->
			
		</div>
		
		<div id="tabla-gestion-obrasociales">

				<table class="table table-striped">
					<tr>
						<td><b>Nro. Turno</b> </td>
						<td><b>Medico</b></td>
						<td><b>Area</b></td>
						<td><b>Paciente</b></td>
						<td><b>Obra Social</b></td>		
						<td><b>Fecha</b></td>
						<td><b>Hora</b></td>	
						<td><b>Estado</b></td>
						<td></td>	
						
					</tr>
					<?php
				while ($valor = mysql_fetch_array($resultado))
				{
					$idturno= $valor["idturno"];
				?>
					<tr>
						<td><?php echo $valor["idturno"]; ?></td>
						<td><?php echo $valor["nommed"]; ?>&nbsp;<?php echo $valor["apemed"]; ?></td>
						<td><?php echo $valor["area"]; ?></td>
						<td><?php echo $valor["pacnom"]; ?>&nbsp;<?php echo $valor["pacape"]; ?></td>
						
						<?php
						if(is_null($valor["nomobra"] )){
						?>	
							<td>Sin Obra Social</td>
						<?php
						}else{
						?>	
							<td><?php echo $valor["nomobra"];?></td>
						<?php
						}
						?>
						<td><?php echo $valor["fecha"];?></td>
						<td><?php echo $valor["hora"];?></td>
						<td><a data-toggle="modal" role="button" href="#borrar<?php echo $idturno; ?>" class="btn btn-danger"><?php echo $valor["estado"];?></a></td>
									<!-- MODAL DE BORRAR -->
									<div id="borrar<?php echo $idturno; ?>" class="modal hide fade in" style="display: none; ">
										<div class="modal-body">
											<h4>Aviso</h4>	      
											<p> Esta seguro que desea modificar el estado del turno? </p>
										</div>
										<div class="modal-footer">
											<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
											<a class="btn btn-warning"  href="ModificarEstado.php?idturno=<?php echo $idturno; ?>">Aceptar</a>
										</div>
									</div>
									
			    <?php } ?>
				</table>
		</div>

	</div>  <!-- FIN ENCAPSULADOR-->

</body>
</html>

  
  