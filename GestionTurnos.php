<?php
	
	
	include_once('mysqlconnect.php');
	
	$consulta = "SELECT * FROM pacientes WHERE pacientes.activo = 1";
    $resultado = mysql_query($consulta);
	
?> 
<head>
<meta charset="UTF-8">
<title>ClinicSystem - Turnos</title>

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
		  
			
		
			
			<div id="form-gestion-turnos"> 
			
				<form class="form-horizontal">
					
					<div class="control-group">
						<select >
							<?php
							while ($valor = mysql_fetch_array($resultado)) {
						?>
								<option value="<?php echo $valor["idobra"];?>"><?php echo $valor["nombre"]; ?></option>
						<?php	  
							}
						?>
						</select>
					</div>
					<div class="control-group">
						<input type="text" placeholder="Buscar Medicos..">
					</div>
					<div class="control-group">
						<select multiple="multiple">
							
						</select>
					</div>
					<div style="margin-left: 300px;margin-top: -268px;">
						<label>Obra Social</label>
							<select multiple="multiple">
								
							</select>
					</div>
					<div style="margin-left: 300px;margin-top: 45px;">
						<label>Especialidad</label>
							<select multiple="multiple">
								
							</select>
					</div>
					<div style="margin-left: 600px;margin-top: -250px;">
						<label>Fecha</label>
							<select>
								
							</select>
					</div>
					<div style="margin-left: 600px;margin-top: 24px;">
						<label>Franja Horaria</label>
							<select>
								<option>Manana</option>
								<option>Tarde</option>
							</select>
					</div>
					<div style="margin-top: 40px; margin-left:600px;">
						<button type="submit" class="btn btn-success">Siguiente</button>
					</div>
					<button class="btn btn-primary" type="button" style="margin-top: 15px;margin-left: 600px;">Turno Nuevo</button>
				</form>
			</div>

	<!--		<div id="tabla-gestion-turnos">

				<table class="table table-striped">
					<tr>
						<td>Medico</td>
						<td>Hora</td>
						<td>Fecha</td>
						<td></td>
					</tr>
					<tr>
						<td>Peter Brown</td>
						<td>15:40 - 16:00</td>
						<td>17/05/2013</td>
						<td><button class="btn btn-danger" type="button">Borrar</button></td>
					</tr>
					<tr>
						<td>Peter Brown</td>
						<td>9:20 - 9:40</td>
						<td>21/05/2013</td>
						<td><button class="btn btn-danger" type="button">Borrar</button></td>
					</tr>
					<tr>
						<td>Peter Brown</td>
						<td>19:00 - 19:20</td>
						<td>02/06/2013</td>
						<td><button class="btn btn-danger" type="button">Borrar</button></td>
					</tr>
				</table>
			</div> -->
			
		</div>      <!-- FIN DIV CONTENDOR -->
	
	</div>  <!-- FIN ENCAPSULADOR-->
			




</body>
</html>
  
  
