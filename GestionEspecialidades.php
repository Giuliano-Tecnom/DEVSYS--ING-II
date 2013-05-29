<?php
	
	include_once('mysqlconnect.php');
	$consulta = "SELECT idespecialidad,nombre FROM especialidades";
    $resultado = mysql_query($consulta);
	

?> 
<html>
<head>
<meta charset="UTF-8">
<title>ClinicSystem - Especialidades</title>

<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>

</head>
		<!-- Fin de HEAD-->
    
<body style="background-image:url('images/bg.png')">
 
	<div class="encapsulador">
	
		<table style="margin-top: 40px; ">
			<tr>
			<td>
				<h3 style="font-size: 76px;margin-top: 30px; color: #00CCFF;">CLIMED</h3>   	
			</td>
			<td> 
				<div class="menu">
					<table>
						<tr>
							<td><a href="#"><button class="btn btn-large" type="button">Home</button></a></td>
							<td><a href="#"><button class="btn btn-large btn-info" type="button">Pacientes</button></a></td>
							<td><a href="#"><button class="btn btn-large" type="button">Medicos</button></a></td>
							<td><a href="#"><button class="btn btn-large" type="button">Turnos</button></a></td>
						</tr>
					</table>
				</div>
			</td>
			</tr>
		</table>	<!-- Fin de Menú-->

		<div class="contenedor">
			
			<ul class="breadcrumb">
				<li> 
					<h5>Gestion de Especialidades<a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
														 <!-- ICONO DE AYUDA -->  
				</li>
			</ul>
		  
			
			<button class="btn btn-primary" type="button" style="margin-top: 25px;margin-left: 300px;"><a href="AltaEspecialidades.php">Agregar Especialidad</a></button>
			
			</div>
			<div id="tabla-gestion-especialidades" style="margin-top:20px;">

				<table class="table table-striped">
					<tr>
						<td>Id Especialidad </td>
						<td>Nombre Especialidad</td>
						<td></td>
						<td></td>
						
					</tr>
					<?php
				while ($valor = mysql_fetch_array($resultado))
				{
				?>
					<tr>
						<td><?php echo $valor["idespecialidad"]; ?></td>
						<td><?php echo $valor["nombre"]; ?></td>
						<td><button class="btn btn-warning" type="button"><a href="BorrarEspecialidad.php?idespecialidad=<?php echo $valor["idespecialidad"]; ?>">Borrar </a></button> </td>
						<td><button class="btn btn-danger" type="button"><a href="Especialidad.php?idespecialidad=<?php echo $valor["idespecialidad"]; ?>">Modif </a></button> </td>
						
					</tr>
				<?php
				}
				?>	
				</table>
			</div>

						<!-- BOTON DE SALIR, ATRAS y REPORTE-->
			<ul class="breadcrumb">
				<li> 
					<button class="btn btn-primary" style="margin-left:400px;" type="button">Generar Reporte</button>
					<div style="margin-left: 800px;">
						<button class="btn btn-primary"type="button"> Atras </button>
						<button class="btn btn-inverse" type="button"> Salir </button>
					</div>
				</li>
			</ul>

		</div>      <!-- FIN DIV CONTENDOR -->


	</div>  <!-- FIN ENCAPSULADOR-->





</body>
</html>

  
  