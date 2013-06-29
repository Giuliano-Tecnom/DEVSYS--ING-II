<?php
	include_once('mysqlconnect.php');
?>

<head>

	<meta charset="UTF-8">
	<title>ClinicSystem - Pacientes</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>
	
</head>
		
<body style="background-image:url('images/bg.png')">
	
	<!--JQuery-->
	<script src='js/jquery.min.js'></script>
	<script src='js/validarFormularioPaciente.js'></script>
 	<?php include_once('header.php'); ?>
	
	<div class="encapsulador">
		
		<ul class="breadcrumb">
			<li> 
				<h5>Modificacion de Pacientes <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
													 <!-- ICONO DE AYUDA -->  
			</li>
		</ul>
		<?php
		if(isset($_GET['Error'])){
				if($_GET['Error'] == 1) {
					echo	"<div class='alert alert-error'>
								<h4>Error!! </h4>
							No se puede agregar el paciente, ya existe uno con ese dni.
							</div>";
				}
			}
		
		?>
		<?php


			if(isset($_GET['idpaciente'])){
				$queryPaciente = "SELECT * FROM pacientes WHERE idpaciente = ".$_GET['idpaciente']."";
				$resultadoQueryPaciente = mysql_query($queryPaciente);
				$paciente = mysql_fetch_array($resultadoQueryPaciente);
			
		
	   ?>
		<div id="form-modificacion-pacientes"> 
	   
			<form class="form-horizontal" method="POST" action="ModificarPaciente.php" enctype="multipart/form-data" > 
				
				<input name="idpaciente" type="hidden" maxlength="50" value="<?php echo $paciente['idpaciente'];?>">
				
				<div class="control-group">
					<input class="namee" name="nombre" type="text" maxlength="50" placeholder="Nombre.." value="<?php echo $paciente['nombre'];?>">
				</div>
				<div class="control-group">
					<input class="apellidoo" name="apellido" type="text" maxlength="50" placeholder="Apellido.." value="<?php echo $paciente['apellido'];?>">
				</div>
				<div class="control-group">
					<input class="dnii" name="dni" type="text" maxlength="9" placeholder="DNI.." value="<?php echo $paciente['dni'];?>">
					<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Sin puntos, Ej: 36789456</span>
				</div>
				<div class="control-group">
					<input class="emaill" name="email" type="text" maxlength="35" placeholder="Email.." value="<?php echo $paciente['email'];?>">
					<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ej: aaa@gmail.com</span>
				</div>
				<div class="control-group">
					<input class="tell" name="tel" type="text" maxlength="25" placeholder="Telefono.." value="<?php echo $paciente['telefono'];?>">
					<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Sin parentesis, ni espacios Ej: 02214567800</span>
				</div>
				<div class="control-group">
					<input class="dirr" name="dir" type="text" maxlength="150" placeholder="Direccion.." value="<?php echo $paciente['direccion'];?>">
					<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ej: 60 N 1009</span>
				</div>
				<div class="control-group">
					<input class="fecnacc" name="fecnac" type="date" min="1900-01-01" max="2013-06-01" placeholder="Fecha de Nacimiento.." value="<?php echo $paciente['fechaNac'];?>">
					<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ingrese DD/MM/AAAA</span>
				</div>
				<div style="margin-left: 300px;margin-top: -285px;">
					<label>Obras Sociales</label>
					<select multiple="multiple" id="obra" name="obra[]">
					<?php
						$queryObrasPaciente = "  SELECT 
														o.nombre, 
														o.idobra 
												 FROM 
														pac_obrasocial AS po
												 INNER JOIN obrasociales AS o on o.idobra = po.idobra
												 INNER JOIN pacientes AS p on p.idpaciente = po.idpaciente
												 WHERE  p.idpaciente=".$_GET['idpaciente']." ";
						$resultadoQueryObrasPaciente = mysql_query($queryObrasPaciente);
					
						while ($obrasPaciente = mysql_fetch_array($resultadoQueryObrasPaciente)) {
					?>
							<option selected="selected" value="<?php echo $obrasPaciente["idobra"];?>"><?php echo $obrasPaciente["nombre"]; ?></option>
					<?php	  
						}
					
						$queryObrasResto = "SELECT o.nombre, o.idobra  
									 FROM obrasociales as o
									 WHERE o.nombre not in   (SELECT o.nombre
															  FROM pac_obrasocial as po
															  INNER JOIN obrasociales as o ON o.idobra = po.idobra
															  INNER JOIN pacientes as p ON p.idpaciente = po.idpaciente
															  WHERE p.idpaciente=".$_GET['idpaciente'].")
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
				<div style="margin-left:300px;margin-top: 180px;">
					
					<a data-toggle="modal" role="button" href="#modificar" class="btnsubmit btn-success">Modificar</a>
						<!-- MODAL DE MODIFICAR -->
							<div id="modificar" class="modal hide fade in" style="display: none; ">
								<div class="modal-body">
									<h4>Aviso</h4>	      
									<p> Esta seguro que desea Modificar el paciente? </p>
								</div>
								<div class="modal-footer">
									<a href="#" class="btn" data-dismiss="modal">Volver</a>
									<button class="btn btn-success" type="submit" onclick="location.href='ModificarPaciente.php'">Aceptar</button>
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
									<a class="btn btn-success"  href="GestionPacientes.php">Aceptar</a>
								</div>
							</div>
				
				</div>
				<span class="help-block" style="margin-left: 300px;font-size: 9px;"> Todos los campos son obligatorios, salvo el Email.</span>
			
			</form>
		</div>
		<?php
			}
		?>
		
	</div>  <!-- FIN ENCAPSULADOR-->

</body>
</html>