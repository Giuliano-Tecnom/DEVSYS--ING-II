<?php
	if (!isset($_GET['ojito'])) {
		$ojito=1;
	}else{
		$ojito=$_GET['ojito'];
	}
	
	include_once('mysqlconnect.php');
	$consulta = "SELECT idespecialidad,nombre,activo FROM especialidades where activo = ".$ojito." OR 0 = ".$ojito." ";
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
							<td><a href="index.php"><button class="btn btn-large" type="button">Home</button></a></td>
							<td><a href="GestionPacientes.php"><button class="btn btn-large" type="button">Pacientes</button></a></td>
							<td><a href="GestionMedicos.php"><button class="btn btn-large" type="button">Medicos</button></a></td>
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
			<?php
				if(isset($_GET['Error'])){
					if($_GET['Error'] == 1)
					echo"<div class='alert alert-error'>
						<h4>Error!!</h4>
						La Especialidad no se puede eliminar porque existen medicos relacionados a ella. 
						</div>";
				}
			?>
			<div style="margin-left: 15px;">
			<button class="btn btn-primary" type="button" onclick="location.href='AltaEspecialidades.php'">
			   Agregar Especialidad
			</button>
			</div>
			
			<div id="tabla-gestion-especialidades" style="margin-top: 25px; margin-left: 15px; margin-right: 15px;">

				<table class="table table-striped">
					<tr class="info">
						
						<td><b>Especialidad</b></td>
						<td><b>Activo</b>
						<?php
							if($ojito == 1){
								echo "<a href='GestionEspecialidades.php?ojito=0'><i class='icon-eye-close' style='margin-left: 3px; margin-top: 3px;'></i></a>"; 
							} else {
								echo "<a href='GestionEspecialidades.php?ojito=1'><i class='icon-eye-open' style='margin-left: 3px; margin-top: 3px;'></i></a>";
							}
						?>
						</td>
						<td></td>
						<td></td>
					
					</tr>
					<?php
				while ($valor = mysql_fetch_array($resultado))
				{
				?>
					<tr>
						
						<td><?php echo $valor["nombre"]; ?></td>
						<?php 
							$id = $valor['idespecialidad'];
							
							if( $valor["activo"] == 1 ){
								echo "<td>  Si </td>";
								echo "<td><button class='btn btn-warning' type='button' ><a href='BorrarEspecialidad.php?idespecialidad=".$id."'> Borrar </a></button> </td>";
							}     
						    else {
							    echo "<td>No</td>";
								echo "<td><button class='btn btn-success' type='button'><a href='HabilitarEspecialidad.php?idespecialidad=".$id."'>Habilitar </a></button> </td>";
							}  
						?>
						
						<td><button class="btn btn-danger" onclick="location.href='Especialidad.php?idespecialidad=<?php echo $valor["idespecialidad"]; ?>'"type="button">Modif</button> </td>
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
						<button class="btn btn-primary"type="button" onclick="javascript:history.go(-1)"> Atras </button>
						<button class="btn btn-inverse" type="button" onclick="window.close();"> Salir </button>
					</div>
				</li>
			</ul>

		</div>      <!-- FIN DIV CONTENDOR -->


	</div>  <!-- FIN ENCAPSULADOR-->





</body>
</html>

  
  