 <?php
	include_once('mysqlconnect.php');
	
	$consultaObras = "SELECT idobra, nombre FROM obrasociales where activo = 1 ORDER BY nombre";
	$resultadoObras = mysql_query($consultaObras);
	$consultaHorarios = "SELECT idhorario, dia, TIME_FORMAT(horaIn,'%H:%m') as horaIn , TIME_FORMAT(horaOut,'%H:%m') as horaOut FROM horarios ORDER BY idhorario";
	$resultadoHorarios = mysql_query($consultaHorarios);
    $consultaEsp= "SELECT idespecialidad, nombre FROM especialidades where activo = 1 ORDER BY nombre";	
	$resultadoEsp = mysql_query($consultaEsp);
?>      <!-- Fin de CONSULTAS-->

<head>

<meta charset="UTF-8">
<title>ClinicSystem - Medicos</title>

<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>

</head>

<body style="background-image:url('images/bg.png')">
	<!--JQuery -->
	<script src='js/jquery.min.js'></script>
	<script src='js/validarFormularioMedico.js'></script>
		
	<?php include_once('header.php'); ?>
	
	<div class="encapsulador">

		<div class="contenedor">

			<ul class="breadcrumb">
				<li> 
					<h5>Alta de Medicos <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
																				<!-- ICONO DE AYUDA -->  
				</li>
			</ul>   <!-- Fin del titulo de pagina-->
            
			<?php
				
				if(isset($_GET['Correcto'])){
					echo "	<div class='alert alert-success' style='margin-left: 10px; margin-right: 10px;' >
							<h4>Medico Agregado Correctamente</h4>
							</div> ";
				}
					
				if(isset($_GET['Error'])){
					if( $_GET['Error'] == 1 ){
						echo "  <div class='alert alert-error' style='margin-left: 10px; margin-right: 10px;'>
								<h4>Error!!</h4>
								Ya existe un medico con la misma matricula. Si no lo encuentra revise los Inactivos.
								</div> ";
					}
					
					
					
				}
			?>
			
			<div id="form-alta-medico"> 
		   
				<form class="form-horizontal" method="POST" action="AgregarMedico.php" enctype="multipart/form-data" >
		  
					<div class="control-group" >
						<input class="namee" name="nombre" type="text" maxlength="50" placeholder="Nombre..">
					</div>
					<div class="control-group">
						<input class="apellidoo" name="apellido" type="text" maxlength="50" placeholder="Apellido..">
					</div>
					<div class="control-group">
						<input class="nromatriculaa" name="nromatricula" type="text" maxlength="9" placeholder="NroMatricula..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ej: 11111111</span>
					</div>
					<div class="control-group">
						<input class="dirr" name="dir" type="text" maxlength="150" placeholder="Direccion..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ej: 60 N 1009</span>
					</div>
					<div class="control-group">
						<input class="tell" name="tel" type="text" maxlength="25" placeholder="Telefono..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Sin parentesis, ni espacios Ej: 02214567800</span>
					</div>
					<div class="control-group">
						<input class="dnii" name="dni" type="text" maxlength="9" placeholder="DNI..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Sin puntos, Ej: 36789456</span>
					</div>
					<div class="control-group">
						<input class="emaill" name="email" type="email" maxlength="35" placeholder="Email..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ej: aaa@gmail.com</span>
					</div>
					
					
					<div class="control-group">
						<input class="fecnacc" name="fecnac" type="date" min="1900-01-01" max="2013-06-01" placeholder="Fecha de Nacimiento..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ingrese DD.MM.AAAA</span>
					</div>
		
					<div style="margin-left: 300px;margin-top: -325px;">
						<label>Obra Social</label>
						<select multiple="multiple" id="obra" name="obra[]">
						<?php
							while ($valor = mysql_fetch_array($resultadoObras)) {
						?>
								<option value="<?php echo $valor["idobra"];?>"><?php echo $valor["nombre"]; ?></option>
						<?php	  
							}
						?>
						</select>
						<span class="help-block" style="font-size: 9px;"> Para una Seleccion multiple: Ctrl + Click Izq.</span>
					</div>
					
					
					<div style="margin-left: 300px;margin-top: 15px;">
						<label>Especialidad</label>
						<select multiple="multiple" id="especialidad" name="especialidad[]">
						<?php
							while ($valor = mysql_fetch_array($resultadoEsp)) {
						?>
								<option value="<?php echo $valor["idespecialidad"];?>"><?php echo $valor["nombre"]; ?></option>
						<?php	  
							}
						?>
						</select>
						<span class="help-block" style="font-size: 9px;"> Para una Seleccion multiple: Ctrl + Click Izq.</span>
					</div>
					
					<div style="margin-left: 448px;margin-top: -281px;">
						<button class="btn btn-mini" onclick="location.href='GestionObras.php'"type="button">Adm. Obras</button>
					</div>
					<div style="margin-left: 407px;margin-top: 125px;">
						<button class="btn btn-mini" onclick="location.href='GestionEspecialidades.php'"type="button">Adm. Especialidades</button>
					</div>
					<div style="margin-left:300px;margin-top: 150px;">
						<button class="btnsubmit btn-success" type="submit">Agregar</button>
						<button class="btn btn-danger" type="button" onclick="location.href='GestionMedicos.php'">Cancelar </button>
					</div>
					<span class="help-block" style="margin-left: 300px;font-size: 9px;"> Todos los campos son obligatorios, salvo el Email.</span>
				
					
					<div style="margin-left: 550px;margin-top: -367px;";>
						<label>Horarios</label>
						<select multiple="multiple" id="horarios" name="horarios[]" size='11' style="width: 150px;">
						<?php
							while ($horario = mysql_fetch_array($resultadoHorarios)) {
						?>		
								<option value="<?php echo $horario["idhorario"];?>"><?php echo $horario["dia"]." ".$horario["horaIn"]." - ".$horario["horaOut"]?></option>
						<?php	  
							}
						?>
						</select>
						<span class="help-block" style="font-size: 9px;"> Para una Seleccion multiple: Ctrl + Click Izq.</span>
					</div>
				
					
				
				
				
				</form>
			</div>
				
			
			<!-- BOTON DE SALIR Y ATRAS-->
			<ul class="breadcrumb" style="margin-top: 600px;">
				<li> 
					<div style="margin-left: 800px;">
						<button class="btn btn-primary"type="button" onclick="javascript:history.go(-1)"> Atras </button>
						<button class="btn btn-inverse" type="button" onclick="window.close();"> Salir </button>
					</div>
				</li>
			</ul>
			
		</div>     <!-- FIN DIV CONTENDOR -->
	
	</div>  <!-- FIN ENCAPSULADOR-->

</body>
</html>
