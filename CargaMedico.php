<?php
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
				<h5>Modificacion de Medicos <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
													 <!-- ICONO DE AYUDA -->  
			</li>
		</ul>
		<?php
		if(isset($_GET['Error'])){
				if($_GET['Error'] == 1) {
					echo	"<div class='alert alert-error'>
								<h4>Aviso! </h4>
							No se puede agregar el Medico.
							</div>";
				}
				if($_GET['Error'] == 2) {
					echo	"<div class='alert alert-error'>
								<h4>Aviso! </h4>
							No se puede modificar el medico. Ya existe uno con esa matricula o dni.
							</div>";
				}
				if($_GET['Error'] == 3) {
					echo	"<div class='alert alert-error'>
								<h4>Aviso! </h4>
							El medico debe tener al menos una especialidad seleccionada.
							</div>";
				}
				if($_GET['Error'] == 4) {
					echo	"<div class='alert alert-error'>
								<h4>Aviso! </h4>
							No se puede quitar la especialidad deseada ya que esta asignada a un turno.
							</div>";
				}
				if($_GET['Error'] == 5) {
					echo	"<div class='alert alert-error'>
								<h4>Aviso! </h4>
							No se puede quitar la obra social deseada ya que esta asignada a un turno.
							</div>";
				}
			}
		
		?>
		<?php


			if(isset($_GET['idmedico'])){
				$queryMedico = "SELECT * FROM medicos WHERE idmedico = ".$_GET['idmedico']."";
				$resultadoQueryMedico = mysql_query($queryMedico);
				$medico = mysql_fetch_array($resultadoQueryMedico);
			
		
	   ?>
		<div id="form-modificacion-medicos"> 
	   
			<form class="form-horizontal" method="POST" action="ModificarMedico.php" enctype="multipart/form-data" > 
				
				<input name="idmedico" type="hidden" maxlength="50" value="<?php echo $medico['idmedico'];?>">
				
				<div class="control-group" >
						<input class="namee" name="nombre" type="text" maxlength="50" placeholder="Nombre.." value="<?php echo $medico['nombre'];?>">
					</div>
					<div class="control-group">
						<input class="apellidoo" name="apellido" type="text" maxlength="50" placeholder="Apellido.." value="<?php echo $medico['apellido'];?>">
					</div>
					<div class="control-group">
						<input class="nromatriculaa" name="nromatricula" type="text" maxlength="9" placeholder="NroMatricula.." value="<?php echo $medico['nromatricula'];?>">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ej: 11111111</span>
					</div>
					<div class="control-group">
						<input class="dirr" name="dir" type="text" maxlength="150" placeholder="Direccion.." value="<?php echo $medico['direccion'];?>">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ej: 60 N 1009</span>
					</div>
					<div class="control-group">
						<input class="tell" name="tel" type="text" maxlength="25" placeholder="Telefono.." value="<?php echo $medico['telefono'];?>">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Sin parentesis, ni espacios Ej: 02214567800</span>
					</div>
					<div class="control-group">
						<input class="dnii" name="dni" type="text" maxlength="9" placeholder="DNI.." value="<?php echo $medico['dni'];?>">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Sin puntos, Ej: 36789456</span>
					</div>
					<div class="control-group">
						<input class="emaill" name="email" type="email" maxlength="35" placeholder="Email.." value="<?php echo $medico['email'];?>">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ej: aaa@gmail.com</span>
					</div>
					
					
					<div class="control-group">
						<input class="fecnacc" name="fecnac" type="date" min="1900-01-01" max="2013-06-01" placeholder="Fecha de Nacimiento.." value="<?php echo $medico['fechaNac'];?>">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ingrese DD.MM.AAAA</span>
					</div>
				
				
				<!-- Obras Sociales -->
				<div style="margin-left: 300px;margin-top: -320px;">
					<label>Obras Sociales</label>
					<select multiple="multiple" id="obra" name="obra[]">
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
							<option selected="selected" value="<?php echo $obrasMedico["idobra"];?>"><?php echo $obrasMedico["nombre"]; ?></option>
					<?php	  
						}
					
						$queryObrasResto = "SELECT o.nombre, o.idobra  
									 FROM obrasociales as o
									 WHERE o.nombre not in   (SELECT o.nombre
															  FROM med_obrasocial as mo
															  INNER JOIN obrasociales as o ON o.idobra = mo.idobra
															  INNER JOIN medicos as m ON m.idmedico = mo.idmedico
															  WHERE m.idmedico=".$_GET['idmedico'].")
									AND o.activo = 1";
						$resultadoQueryObrasResto = mysql_query($queryObrasResto);
					
						while ($obrasResto = mysql_fetch_array($resultadoQueryObrasResto)) {
					?>
							<option value="<?php echo $obrasResto["idobra"];?>"><?php echo $obrasResto["nombre"]; ?></option>
					<?php	  
						}
					?>

					</select>
					<span class="help-block" style="font-size: 9px;"> Para una Seleccion multiple: Ctrl + Click Izq.</span>
				</div>
				
				
				<!-- Especialidades -->
				<div style="margin-left: 300px;margin-top: 10px;">
				<label>Especialidades</label>
				<select multiple="multiple" id="especialidad" name="especialidad[]">
				<?php
					$queryEspecialidadesMedico = "	SELECT 	e.nombre,
															e.idespecialidad 
													FROM 
															med_esp as me
													INNER JOIN especialidades as e on e.idespecialidad = me.idespecialidad
													WHERE  me.idmedico=".$_GET['idmedico']." ";
					$resultadoQueryEspecialidadesMedico = mysql_query($queryEspecialidadesMedico);
				
					while ($especialidad = mysql_fetch_array($resultadoQueryEspecialidadesMedico)) {
				?>
						<option selected="selected" value="<?php echo $especialidad["idespecialidad"];?>"><?php echo $especialidad["nombre"]; ?></option>
				<?php	  
					}
				
					$consultaEsp = "SELECT	e.nombre, 
											e.idespecialidad  
									FROM 
											especialidades as e
									WHERE e.nombre not in   (SELECT 
																	esp.nombre
															 FROM 
																	med_esp as me
															 INNER JOIN especialidades as esp ON esp.idespecialidad = me.idespecialidad
														     WHERE me.idmedico=".$_GET['idmedico'].")";
					$resultadoConsultaEsp = mysql_query($consultaEsp);
				
					while ($especialidad = mysql_fetch_array($resultadoConsultaEsp)) {
				?>
						<option value="<?php echo $especialidad["idespecialidad"];?>"><?php echo $especialidad["nombre"]; ?></option>
				<?php	  
					}
					?>
				</select>
				<span class="help-block" style="font-size: 9px;"> Para una Seleccion multiple: Ctrl + Click Izq.</span>
				</div>
				
				<div style="margin-left: 550px;margin-top: -275px;";>
					<label>Horarios</label>
					<select multiple="multiple" id="horarios" name="horarios[]" size='11' style="width: 200px;">
					<?php 
						$queryMedicoHorario = "SELECT h.idhorario
											   FROM horarios AS h
											   INNER JOIN med_hor AS mh on mh.idhorario = h.idhorario
											   WHERE  mh.idmedico=".$_GET['idmedico']." ";
						$resultadoQueryMedicoHorario = mysql_query($queryMedicoHorario);
					
						$hor = array();
						
						while ($medicoHorario = mysql_fetch_array($resultadoQueryMedicoHorario)) {
							$hor[] = $medicoHorario['idhorario'];
						}		
					
						$queryHorariosResto = "SELECT h.idhorario, h.dia, TIME_FORMAT(h.horaIn,'%H:%m') as horaIn , TIME_FORMAT(h.horaOut,'%H:%m') as horaOut  
											   FROM horarios as h
											   WHERE h.idhorario ";
						$resultadoQueryHorarioResto = mysql_query($queryHorariosResto);

						while ($horarioResto = mysql_fetch_array($resultadoQueryHorarioResto)) {
							if( in_array($horarioResto['idhorario'], $hor) ){
								if ($horarioResto["dia"] == 'Miercoles'){ ?>
									<option selected="selected" value="<?php echo $horarioResto["idhorario"];?>"><?php echo $horarioResto["dia"]."&nbsp&nbsp&nbsp&nbsp".$horarioResto["horaIn"]." - ".$horarioResto["horaOut"]?></option>
						<?php	}else{ ?>
									<option selected="selected" value="<?php echo $horarioResto["idhorario"];?>"><?php echo $horarioResto["dia"]."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$horarioResto["horaIn"]." - ".$horarioResto["horaOut"]?></option>
						<?php	 } 
							}else{ 
								if ($horarioResto["dia"] == 'Miercoles'){ ?>
									<option value="<?php echo $horarioResto["idhorario"];?>"><?php echo $horarioResto["dia"]."&nbsp&nbsp&nbsp&nbsp".$horarioResto["horaIn"]." - ".$horarioResto["horaOut"]?></option>
						<?php   } else { ?>
									<option value="<?php echo $horarioResto["idhorario"];?>"><?php echo $horarioResto["dia"]."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$horarioResto["horaIn"]." - ".$horarioResto["horaOut"]?></option>
						<?php   } 
							}
						}
					?>

					</select>
						<span class="help-block" style="font-size: 9px;"> Para una Seleccion multiple: Ctrl + Click Izq.</span>
				</div>
		
				
				<div style="margin-left:300px;margin-top: 120px;">
					
					<a data-toggle="modal" role="button" href="#modificar" class="btnsubmit btn-success">Modificar</a>
						<!-- MODAL DE MODIFICAR -->
							<div id="modificar" class="modal hide fade in" style="display: none; ">
								<div class="modal-body">
									<h4>Aviso</h4>	      
									<p> Esta seguro que desea Modificar el medico? </p>
								</div>
								<div class="modal-footer">
									<a href="#" class="btn" data-dismiss="modal">Volver</a>
									<button class="btn btn-success" type="submit" onclick="location.href='ModificarMedico.php'">Aceptar</button>
								</div>
							</div>
							
					<a data-toggle="modal" role="button" href="#cancelar" class="btn btn-danger">Cancelar</a>
						<!-- MODAL DE CANCELAR -->
							<div id="cancelar" class="modal hide fade in" style="display: none; ">
								<div class="modal-body">
									<h4>Aviso</h4>	      
									<p> Esta seguro que desea Cancelar? </p>
								</div>
								<div class="modal-footer">
									<a href="#" class="btn" data-dismiss="modal">Volver</a>
									<a class="btn btn-success"  href="GestionMedicos.php">Aceptar</a>
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