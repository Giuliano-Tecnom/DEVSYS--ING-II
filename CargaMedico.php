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
				<div style="margin-left: 300px;margin-top: -285px;">
					<label>Obra Social</label>
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
															  WHERE m.idmedico=".$_GET['idmedico'].")";
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
				<label>Especialidad</label>
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
	
				
				<div style="margin-left: 550px;margin-top: -77px;">
					<button class="btn btn-mini" type="button" onclick="location.href='GestionObras.php'">Editar</button>
				</div>
				<div style="margin-left:300px;margin-top: 90px;">
					<button class="btnsubmit btn-success" type="submit">Modificar</button>
					<button class="btn btn-danger" type="button" onclick="location.href='GestionMedicos.php' ">Cancelar </button>
				</div>		
				
				
			</form>
		</div>
		<?php
			}
		?>
		
	</div>  <!-- FIN ENCAPSULADOR-->

</body>
</html>