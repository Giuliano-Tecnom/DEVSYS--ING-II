 <?php
	include_once('mysqlconnect.php');
	
	$consulta = "SELECT idobra, nombre FROM obrasociales where activo = 1 ORDER BY nombre";
    $resultado = mysql_query($consulta);			
	
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

		<div class="contenedor">

			<ul class="breadcrumb">
				<li> 
					<h5>Alta de Pacientes <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
																				<!-- ICONO DE AYUDA -->  
				</li>
			</ul>   <!-- Fin del titulo de pagina-->
            
			<?php
					
				if(isset($_GET['Error'])){
					if( $_GET['Error'] == 1 ){
						echo "  <div class='alert alert-error' style='margin-left: 10px; margin-right: 10px;'>
								<h4>Error!!</h4>
								Ya existe un paciente con el mismo DNI. Si no lo encuentra revise los Inactivos.
								</div> ";
					}
					
					if( $_GET['Error'] == 2 ){
						echo "  <div class='alert alert-error' style='margin-left: 10px; margin-right: 10px;' >
								<h4>Error!!</h4>
								Primero debe dar de alta un paciente para luego asignar su Nro de Afiliado. Reintentelo!
								</div> ";
					}
					
				}
			?>
			
			<div id="form-alta-pacientes"> 
		   
				<form class="form-horizontal" method="POST" action="AgregarPaciente.php" enctype="multipart/form-data" >
		  
					<div class="control-group" >
						<input class="namee" name="nombre" type="text" maxlength="50" placeholder="Nombre..">
					</div>
					<div class="control-group">
						<input class="apellidoo" name="apellido" type="text" maxlength="50" placeholder="Apellido..">
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
						<input class="tell" name="tel" type="text" maxlength="25" placeholder="Telefono..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Sin parentesis, ni espacios Ej: 02214567800</span>
					</div>
					<div class="control-group">
						<input class="dirr" name="dir" type="text" maxlength="150" placeholder="Direccion..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ej: 60 N 1009</span>
					</div>
					<div class="control-group">
						<input class="fecnacc" name="fecnac" type="date" min="1900-01-01" max="2013-06-01" placeholder="Fecha de Nacimiento..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ingrese DD.MM.AAAA</span>
					</div>
				
					
					
					<div style="margin-left: 300px;margin-top: -285px;">
						<label>Obra Social</label>
						<select multiple="multiple" id="obra" name="obra[]">
						<?php
							while ($valor = mysql_fetch_array($resultado)) {
						?>
								<option value="<?php echo $valor["idobra"];?>"><?php echo $valor["nombre"]; ?></option>
						<?php	  
							}
						?>
						</select>
						<span class="help-block" style="font-size: 9px;"> Para una Seleccion multiple: Ctrl + Click Izq.</span>
					</div>
					<div style="margin-left: 550px;margin-top: -77px;">
						<button class="btn btn-mini" onclick="location.href='GestionObras.php'"type="button">Editar Obra Social</button>
					</div>
					<div style="margin-left:300px;margin-top: 90px;">
					
							
						<a data-toggle="modal" role="button" href="#agregar" class="btnsubmit btn-success">Agregar</a>
						<!-- MODAL DE AGREGAR -->
							<div id="agregar" class="modal hide fade in" style="display: none; ">
								<div class="modal-body">
									<h4>Aviso</h4>	      
									<p> Esta seguro que desea Agregar al paciente nuevo? </p>
								</div>
								<div class="modal-footer">
									<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
									<button class="btn btn-success" type="submit" onclick="location.href='AgregarPaciente.php'">Aceptar</button>
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
									<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
									<a class="btn btn-danger"  href="GestionPacientes.php">Aceptar</a>
								</div>
							</div>
							
					</div>
					<span class="help-block" style="margin-left: 300px;font-size: 9px;"> Todos los campos son obligatorios, salvo el Email.</span>
					
					
					
					

					
				</form>
			</div>
			
		</div>     <!-- FIN DIV CONTENDOR -->
	
	</div>  <!-- FIN ENCAPSULADOR-->

</body>
</html>
