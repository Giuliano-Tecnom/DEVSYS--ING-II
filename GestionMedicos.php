<?php
	
	if (!isset($_GET['ojito'])) {
		$ojito=1;
	}else{
		$ojito=$_GET['ojito'];
	}
	
	include_once('mysqlconnect.php');
	
	$consulta = "SELECT * FROM medicos WHERE medicos.activo = ".$ojito." OR 0 = ".$ojito." ";
    $resultado = mysql_query($consulta);
	
?> 

<head>
<meta charset="UTF-8">
<title>ClinicSystem - Medicos</title>

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
					<h5>Gestion de Medicos<a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
														 <!-- ICONO DE AYUDA -->  
				</li>
			</ul>
		  
			<?php 
		  
				if(isset($_GET['Correcto'])){
					if($_GET['Correcto'] == 1){
						echo"<div class='alert alert-success'>
							<h4>Exito!</h4>
							El Medico se agrego correctamente.
							</div>";
					}
					if($_GET['Correcto'] == 2){
						echo"<div class='alert alert-success'>
							<h4>Exito!</h4>
							El Medico se borro correctamente.
							</div>";
					}
					if($_GET['Correcto'] == 3){
						echo"<div class='alert alert-success'>
							<h4>Exito!</h4>
							El Medico se modifico correctamente.
							</div>";
					}				
				}
				
				if(isset($_GET['Error'])){
					if($_GET['Error'] == 1)
					echo"<div class='alert alert-error'>
						<h4>Error!! </h4>
						</div>";
				}
				
			?>
			<!--
			<div id="form-gestion-medicos"> 
		   
				<form class="form-horizontal">
					<div class="control-group">
						<input name="nom" type="text" placeholder="Buscar por nombre..">
					</div>
					<div class="control-group">
						<input name="ape" type="text" placeholder="Buscar por apellido..">
					</div>
					<div class="control-group">
						<input name="dni" type="text" placeholder="Buscar por DNI..">
					</div> 
					<div class="control-group">
						<input name="email" type="text" placeholder="Buscar por Email..">
					</div>
					<div class="control-group">
						Edad desde:
						<select name="edadmin" class="span2">
							<option value="0"> < 1 </option>
							<?php
								for($i=1; $i < 121; $i++){
									echo " <option value='".$i."'>".$i."</option> ";
								}	
							?>
						</select> 
					</div>
					<div class="control-group">
						Edad Hasta: 
						<select name="edadmax" class="span2">
							<?php
								for($i=120; $i > 0; $i--){
									echo " <option value='".$i."'>".$i."</option> ";
								}
							?>
							<option value="0"> < 1 </option>
						</select> 
					</div>
					<div style="margin-left: 300px;margin-top: -265px;">
						<label>Obra Social</label>
						<select multiple="multiple" name="obras[]">
							<option>Cualquiera</option>
							<option>GALENO</option>
							<option>OSSEG</option>
							<option>IOMA</option>
							<option>OSDE</option>
							<option>OSECAC</option>   
						</select>
					</div> 
					<div style="margin-left:300px;margin-top: 25px;">
						<button class="btn btn-success" type="button">Buscar</button>
						<button class="btn btn-danger" type="button">Limpiar </button>
					</div>
					<button class="btn btn-primary" type="button" onclick="location.href='AltaMedicos.php'"
					style="margin-top: 25px;margin-left: 300px;">Medico Nuevo</button>
				</form>
			</div>
			-->
			
			<!-- COMIENZA BARRA DE OPCIONES -->
			<div class="btn-group" style="margin-top: 45px; margin-left: 270;">
					<button class="btn btn-info" type="button" onclick="location.href='AltaMedicos.php'">Medico Nuevo</button>
					<button class="btn btn-info" type="button">Generar Reporte</button>
					<button class="btn btn-info" type="button"
					<?php	if($ojito == 1){ ?>
								onclick="location.href='GestionMedicos.php?ojito=0'"> Mostrar Inactivos <i class="icon-eye-close" style="margin-left: 3px;"></i>
					<?php	} else { ?>			
								onclick="location.href='GestionMedicos.php?ojito=1'"> Ocultar Inactivos <i class="icon-eye-open" style="margin-left: 3px;"></i>
					<?php	} ?>
					</button>
			</div>
			<!-- FIN BARRA DE OPCIONES -->
					
					
			<div id="tabla-gestion-pacientes">

				<table class="table table-striped">
					<tr>
						<td><b>Nombre</b></td> 
						<td><b>Apellido</b></td>
						<td><b>Matricula</b></td>
						<td><b>Direccion</b></td>
						<td><b>Telefono</b></td>
						<td><b>Email</b></td>
						<td><b>Obras Sociales</b></td>
						<td><b>Especialidades</b></td>
						<td><b>Dni</b></td>
						<td><b>Fecha de Nacimiento</b></td>
						<td><b>Horarios</b></td>
						<td></td>
						<td></td>
					</tr>
			<?php while ($valor = mysql_fetch_array($resultado)) {	?>
					<tr>
						<td><?php echo $valor["nombre"]; ?></td>
						<td><?php echo $valor["apellido"]; ?></td>
						<td><?php echo $valor["nromatricula"]; ?></td>
						<td><?php echo $valor["direccion"]; ?></td>
						<td><?php echo $valor["telefono"]; ?></td>
						<td><?php echo $valor["email"]; ?></td>
						
						<?php
						$idmedico = $valor['idmedico']; //�Ojo tocando esta variable, se usa en varios lados durante la iteracion del while!.
						$consultaObras= "SELECT  * from med_obrasocial as mo
								 inner join obrasociales as o on o.idobra = mo.idobra 
								 where mo.idmedico = ".$valor["idmedico"]."";
						$resultadoConsultaObras = mysql_query($consultaObras);
						?>
						<td><a data-toggle="modal" role="button" href="#obrasSocialesMedico<?php echo $idmedico; ?>" class="btn">Ver</a></td>
						<!-- MODAL DE VER OBRAS SOCIALES -->
						<div id="obrasSocialesMedico<?php echo $idmedico; ?>" class="modal hide fade in" style="display: none; ">
							<div class="modal-body">
								<center><h3>Obras Sociales del Medico</h4></center>	
								<ul>
								<?php 
								if (mysql_num_rows($resultadoConsultaObras) > 0) {
									while ($obra = mysql_fetch_array($resultadoConsultaObras)) { ?>
										<li><?php echo $obra['nombre'] ?></li>
							<?php	}
								} else {
									?>
										<li><?php echo 'No se registran obras sociales asignadas al medico.' ?></li>
									<?php 
								}
									?>
								</ul> 
							</div>
							<div class="modal-footer">
								<a href="#" class="btn" data-dismiss="modal">Volver</a>
							</div>
						</div>
						
						
						<?php
						$consultaEspecialidades= "SELECT  * from med_esp as me
												  inner join especialidades as e on e.idespecialidad = me.idespecialidad 
												  where me.idmedico = ".$valor["idmedico"]."";
						$resultadoConsultaEspecialidades = mysql_query($consultaEspecialidades);
						?>
						<td><a data-toggle="modal" role="button" href="#especialidadesMedico<?php echo $idmedico; ?>" class="btn">Ver</a></td>
						<!-- MODAL DE VER ESPECIALIDES-->
						<div id="especialidadesMedico<?php echo $idmedico; ?>" class="modal hide fade in" style="display: none; ">
							<div class="modal-body">
								<center><h3>Especialidades del Medico</h4></center>	
								<ul>
								<?php 
								if (mysql_num_rows($resultadoConsultaEspecialidades) > 0) {
									while ($especialidad = mysql_fetch_array($resultadoConsultaEspecialidades)) { ?>
										<li><?php echo $especialidad['nombre'] ?></li>
							<?php	}
								} else {
									?>
										<li><?php echo 'No se registran especialidades asignadas al medico.' ?></li>
									<?php 
								}
									?>
								</ul> 
							</div>
							<div class="modal-footer">
								<a href="#" class="btn" data-dismiss="modal">Volver</a>
							</div>
						</div>
						
						<td><?php echo $valor["dni"]; ?></td>
						<td><?php echo $valor["fechaNac"]; ?></td>
						<?php 
							$consultaHorarios = "SELECT h.dia, h.horaIn, h.horaOut 
												 FROM horarios as h
												 INNER JOIN med_hor as mh
												 ON h.idhorario = mh.idhorario
												 WHERE mh.idmedico = ".$idmedico."";
							$resultadoConsultaHorarios = mysql_query($consultaHorarios);
						?>	
						<td><a data-toggle="modal" role="button" href="#horariosMedico<?php echo $idmedico; ?>" class="btn">Ver</a></td>
						<!-- MODAL DE VER HORARIOS -->
						<div id="horariosMedico<?php echo $idmedico; ?>" class="modal hide fade in" style="display: none; ">
							<div class="modal-body">
								<center><h3>Horarios del Medico</h4></center>	
								<?php 
								if (mysql_num_rows($resultadoConsultaHorarios) > 0) {
								?>											
									<p><b>&nbsp&nbsp&nbsp&nbsp&nbsp Dia &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Horario Entrada &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Horario Salida </b></p>
									<ul>
									<?php 
										while ($horario = mysql_fetch_array($resultadoConsultaHorarios)) {
											if ($horario['dia'] == 'Miercoles') { ?>
											<li><?php echo $horario['dia']."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$horario['horaIn']."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$horario['horaOut'] ?></li>
									<?php	} else { ?>
												<li><?php echo $horario['dia']."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$horario['horaIn']."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$horario['horaOut'] ?></li>
									<?php	}
										}
								} else {
									?>
										<li><?php echo 'No se registran horarios asignados al medico.' ?></li>
									<?php 
								}
									?>
									</ul> 
							</div>
							<div class="modal-footer">
								<a href="#" class="btn" data-dismiss="modal">Volver</a>
							</div>
						</div>
										
						<?php 
								if( $valor["activo"] == 1 ){
						?>	
									<td><a data-toggle="modal" role="button" href="#borrar<?php echo $idmedico; ?>" class="btn btn-danger">Borrar</a></td>
									<!-- MODAL DE BORRAR -->
									<div id="borrar<?php echo $idmedico; ?>" class="modal hide fade in" style="display: none; ">
										<div class="modal-body">
											<h4>Aviso</h4>	      
											<p> Esta seguro que desea dar de baja el medico? </p>
										</div>
										<div class="modal-footer">
											<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
											<a class="btn btn-warning"  href="BorrarMedico.php?idmedico=<?php echo $idmedico; ?>">Aceptar</a>
										</div>
									</div>
						<?php	}else{ ?>
									<td><button class="btn btn-success" type="button" onclick="location.href='HabilitarMedico.php?idmedico=<?php echo $idmedico; ?> '">Habilitar</button></td>
						<?php	}  	?>
						
						<td><button class="btn btn-warning" onclick="location.href='CargaMedico.php?idmedico=<?php echo $idmedico; ?> '" type="button">Modificar</button> </td>
						
					</tr>
				<?php
				}
				?>	
				</table>
			</div>

		</div>      <!-- FIN DIV CONTENDOR -->

	</div>  <!-- FIN ENCAPSULADOR-->



</body>
</html>

  
  