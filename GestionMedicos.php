<?php
	
	if (!isset($_GET['ojito'])) {
		$ojito=1;
	}else{
		$ojito=$_GET['ojito'];
	}
	
	include_once('mysqlconnect.php');
	



if(isset($_POST['filtro'])){
    
    $filtro = $_POST['filtro'];
    $criterio = "";

    if(isset($_POST['nom'])){
    	$nombre = $_POST['nom'];
    	if($nombre != ""){
    		$criterio.="  and m.nombre LIKE '".$nombre."%'  ";
    	}
    }

    if(isset($_POST['ape'])){
    	$apellido = $_POST['ape'];
    	if($apellido != ""){
    		$criterio.="  and m.apellido LIKE '".$apellido."%' ";
    	}
    }

    if(isset($_POST['matricula'])){
    	$matricula = $_POST['matricula'];
    	if($matricula != ""){
    		$criterio.="  and m.nromatricula = ".$matricula."  ";
    	}
    }

    
    $obras = $_POST['obras'];
    if(count($obras) > 0){
    	foreach ($obras as $valor) {
    		$criterio.="  and mo.idobra = ".$valor."  ";
    	}
    }

    $especialidades = $_POST['especialidades'];
    if(count($especialidades) > 0){
    	foreach ($especialidades as $valor) {
    		$criterio.="  and me.idespecialidad = ".$valor."  ";
    	}
    }

    $dias = $_POST['dias'];
    if(count($dias) > 0){
    	foreach ($dias as $valor) {
    		$criterio.="  and mh.idhorario = ".$valor."  ";
    	}
    }



 	$consulta = "SELECT DISTINCT * FROM medicos as m
 				 INNER JOIN med_obrasocial as mo on m.idmedico = mo.idmedico
 				 INNER JOIN med_esp as me on m.idmedico = me.idmedico
 				 INNER JOIN med_hor as mh on m.idmedico = mh.idmedico
 				 WHERE (m.activo = ".$ojito." OR 0 = ".$ojito.") " .$criterio. " 
 				 GROUP BY m.nromatricula";
     
	$resultado = mysql_query($consulta);


}else{
 
 	$consulta = "SELECT * FROM medicos WHERE (medicos.activo = ".$ojito." OR 0 = ".$ojito.") ";
     
	$resultado = mysql_query($consulta);

}





	
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
				
				if(isset($_GET['Error'])) {
					if($_GET['Error'] == 1)
					echo"<div class='alert alert-error'>
						<h4>Aviso! </h4>
						</div>";
				
					if($_GET['Error'] == 3)
					echo"<div class='alert alert-error'>
						<h4>Aviso!</h4>
						No se puede dar de baja el medico ya que tiene un turno asignado.
						</div>";
				}
				
			?>
			
			<div id="form-gestion-medicos"> 
		   
				<form class="form-horizontal" method="POST" action="GestionMedicos.php?ojito=<?php echo $ojito; ?>" enctype="multipart/form-data" >

					<input type="hidden" name="filtro" id="filtro" value="S">
					<div class="control-group">
						<input name="nom" id="nom" type="text" placeholder="Buscar por nombre..">
					</div>
					<div class="control-group">
						<input name="ape" id="ape" type="text" placeholder="Buscar por apellido..">
					</div>
					<div class="control-group">
						<input name="matricula" id="matricula" type="text" placeholder="Buscar por matricula..">
					</div> 

					<div style="margin-top: -122px; margin-left: 221px;">
						
						<?php
							$consultaObras = "SELECT * FROM obraSociales WHERE activo = 1";
							$resObras = mysql_query($consultaObras);
						?>


						<label>Obra Social</label>
						<select multiple="multiple" name="obras[]">
							<?php
								while ($valor = mysql_fetch_array($resObras)) {
							?>
									<option value="<?php echo $valor["idobra"];?>"><?php echo $valor["nombre"]; ?></option>
							<?php	  
								}
							?>
						</select>
						<span class="help-block" style="font-size: 9px;"> Para una Seleccion multiple: Ctrl + Click Izq.</span>

					</div> 

					<div style="margin-top: -132px; margin-left: 455px;">

						<?php
							$consultaesp = "SELECT * FROM especialidades WHERE activo = 1";
							$resEsp = mysql_query($consultaesp);
						?>


						<label>Especialidades</label>
						<select multiple="multiple" name="especialidades[]">
							<?php
								while ($valor = mysql_fetch_array($resEsp)) {
							?>
									<option value="<?php echo $valor["idespecialidad"];?>"><?php echo $valor["nombre"]; ?></option>
							<?php	  
								}
							?>
						</select>
						<span class="help-block" style="font-size: 9px;"> Para una Seleccion multiple: Ctrl + Click Izq.</span>

					</div> 

					<div style="margin-top: -132px; margin-left: 689px;">

						<?php
							$consultaDia = "SELECT * FROM horarios";
							$resDia = mysql_query($consultaDia);
						?>


						<label>Dia y Horario</label>
						<select multiple="multiple" id="dias" name="dias[]" style="width: 200px;">
						<?php
							while ($horario = mysql_fetch_array($resDia)) {
						?>		
								<option value="<?php echo $horario["idhorario"];?>"><?php echo $horario["dia"]." ".$horario["horaIn"]." - ".$horario["horaOut"]?></option>
						<?php	  
							}
						?>
						</select>
						<span class="help-block" style="font-size: 9px;"> Para una Seleccion multiple: Ctrl + Click Izq.</span>

					</div> 


					<div style="margin-top: -15px;">
						<button class="btn btn-success" type="submit">Filtrar</button>	
					</div>

				</form>
			</div>
			



			
			<!-- COMIENZA BARRA DE OPCIONES -->
			<div class="btn-group" style="margin-top: 45px; margin-left: 270;">
					<button class="btn btn-info" type="button" onclick="location.href='AltaMedicos.php'">Medico Nuevo</button>
					
					
					
				    <!-- HABILITA O DESHABILITA EL BOTON REPORTES DEPENDIENDO SI ES ADMIN O NO!!!! -->
                    <?php
                    if ($_SESSION['tipo'] != "administrador") {
                    ?>
                    	<button class="btn btn-info" type="button" disabled>Generar Reporte</button>
				   	<?php
				   	}else{
				   	?>
				   		<button class="btn btn-info" type="button" onclick="location.href='ReporteMedicos.php?ojito=<?php echo $ojito;?>'">Generar Reporte</button>
				   	<?php
				   	}
				   	?>


					<button class="btn btn-info" type="button" onclick="location.href='GestionLicencias.php'">Licencias</button>
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
						<td><b>Apellido y Nombre</b></td>
						<td><b>Matricula</b></td>
						<td><b>Dni</b></td>
						<td><b>Datos Personales</b></td>
						<td><b>Obras Sociales</b></td>
						<td><b>Especialidades</b></td>
						<td><b>Horarios</b></td>
						<td></td>
						<td></td>
					</tr>
			<?php while ($valor = mysql_fetch_array($resultado)) {	?>
					<tr>
						<td><?php echo $valor["apellido"]; ?> <?php echo $valor["nombre"]; ?></td>
						<td><?php echo $valor["nromatricula"]; ?></td>
						<td><?php echo $valor["dni"]; ?></td>

						<?php
						$consultadatos= "SELECT  * from medicos as m
												  where m.idmedico = ".$valor["idmedico"]."";
						$resultadodatos = mysql_query($consultadatos);
						?>
						<td><a data-toggle="modal" role="button" href="#datosmedico<?php echo $idmedico; ?>" class="btn">Ver</a></td>
						<!-- MODAL DE VER ESPECIALIDES-->
						<div id="datosmedico<?php echo $idmedico; ?>" class="modal hide fade in" style="display: none; ">
							<div class="modal-body">
								<center><h3>Datos Personales del Medico</h4></center>	
								<ul>
								<?php 
								if (mysql_num_rows($resultadodatos) > 0) {
									while ($datos = mysql_fetch_array($resultadodatos)) { ?>
										<li><b>Direccion:</b> <?php echo $datos['direccion'] ?></li>
										<li><b>Telefono:</b> <?php echo $datos['telefono'] ?></li>
										<li><b>Email:</b> <?php echo $datos['email'] ?></li>
										<li><b>Fecha de Nacimiento:</b> <?php echo $datos['fechaNac'] ?></li>
							<?php	}
								} else {
									?>
										<li><?php echo 'No se registran datos asignadas al medico.' ?></li>
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
						$idmedico = $valor['idmedico']; //¡Ojo tocando esta variable, se usa en varios lados durante la iteracion del while!.
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

  
  