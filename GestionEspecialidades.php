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
 	
	<?php include_once('header.php'); ?>
	
	<div class="encapsulador">
	

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
						<h4>Aviso!</h4>
						La Especialidad no se puede eliminar porque existen medicos relacionados a ella. 
						</div>";
				}
			?>
			
			<!-- COMIENZA BARRA DE OPCIONES -->
			<div class="btn-group" style="margin-top: 45px; margin-left: 270;">
			        <button class="btn btn-info" type="button" onclick="location.href='AltaEspecialidades.php'">Agregar Especialidad</button>
                    
                    <!-- HABILITA O DESHABILITA EL BOTON REPORTES DEPENDIENDO SI ES ADMIN O NO!!!! -->
                    <?php
                    if ($_SESSION['tipo'] != "administrador") {
                    ?>
                    	<button class="btn btn-info" type="button" disabled>Generar Reporte</button>
				   	<?php
				   	}else{
				   	?>
				   		<button class="btn btn-info" type="button">Generar Reporte</button>
				   	<?php
				   	}
				   	?>

				   	<button class="btn btn-info" type="button"
					<?php	if($ojito == 1){ ?>
								onclick="location.href='GestionEspecialidades.php?ojito=0'"> Mostrar Inactivos <i class="icon-eye-close" style="margin-left: 3px;"></i>
					<?php	} else { ?>			
								onclick="location.href='GestionEspecialidades.php?ojito=1'"> Ocultar Inactivos <i class="icon-eye-open" style="margin-left: 3px;"></i>
					<?php	} ?>
					</button>
			</div>
			<!-- FIN BARRA DE OPCIONES -->

			
			<div id="tabla-gestion-especialidades" style="margin-top: 45px; margin-left: 15px; margin-right: 15px;">

				<table class="table table-striped">
					<tr>
						
						<td><b>Especialidad</b></td>
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
								$idespecialidad = $valor["idespecialidad"];
								if( $valor["activo"] == 1 ){
						?>	
									<td><a data-toggle="modal" role="button" href="#borrar<?php echo $idespecialidad; ?>" class="btn btn-danger">Borrar</a></td>
									<!-- MODAL DE BORRAR -->
									<div id="borrar<?php echo $idespecialidad; ?>" class="modal hide fade in" style="display: none; ">
										<div class="modal-body">
											<h4>Aviso</h4>	      
											<p> Esta seguro que desea dar de baja la especialidad? </p>
										</div>
										<div class="modal-footer">
											<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
											<a class="btn btn-danger"  href="BorrarEspecialidad.php?idespecialidad=<?php echo $idespecialidad; ?>">Aceptar</a>
										</div>
									</div>
						<?php	}else{ ?>
									<td><button class="btn btn-success" type="button" onclick="location.href='HabilitarEspecialidad.php?idespecialidad=<?php echo $idespecialidad; ?> '">Habilitar</button></td>
						<?php	}  	?>		
						
						<td><button class="btn btn-warning" onclick="location.href='Especialidad.php?idespecialidad=<?php echo $valor["idespecialidad"]; ?>'"type="button">Modificar</button> </td>
					</tr>
				<?php
				}
				?>	
				</table>
			</div>

						<!-- BOTON DE SALIR, ATRAS y REPORTE-->
			

		</div>      <!-- FIN DIV CONTENDOR -->


	</div>  <!-- FIN ENCAPSULADOR-->





</body>
</html>

  
  