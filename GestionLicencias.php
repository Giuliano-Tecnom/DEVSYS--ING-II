<?php
	if (!isset($_GET['ojito'])) {
		$ojito=1;
	}else{
		$ojito=$_GET['ojito'];
	}
	include_once('mysqlconnect.php');
	
	// $consulta = "SELECT idlicencia,med.idmedico,fechaDesde,fechaHasta,nombre,apellido,
	             // case estado when 1 then 'Activa' else 'Inactiva' end as estado
               	// FROM licencias as lic
				
                     // INNER JOIN medicos as med on med.idmedico=lic.idmedico
				// where estado = ".$ojito." OR 0 = ".$ojito." ";
	
	
	$consulta = "SELECT idlicencia,med.idmedico,fechaDesde,fechaHasta,nombre,apellido,
	             case estado when 1 then 'Activa' else 'Inactiva' end as estado
               	FROM licencias as lic
				
                     INNER JOIN medicos as med on med.idmedico=lic.idmedico
				where estado = ".$ojito."";
    $resultado = mysql_query($consulta);
	
	

?> 
<html>
<head>
<meta charset="UTF-8">
<title>ClinicSystem - Licencias</title>

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
					<h5>Gestion de Licencias<a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
														 <!-- ICONO DE AYUDA -->  
				</li>
			</ul>
		  	
			<?php 
		  
				if(isset($_GET['Correcto'])){
					if($_GET['Correcto'] == 1){
						echo"<div class='alert alert-success'>
							<h4>Exito!</h4>
							La obra social se elimino correctamente.
							</div>";
					}
				}
				
				if(isset($_GET['Error'])){
					if($_GET['Error'] == 1)
					echo"<div class='alert alert-error'>
						<h4>Error!!</h4>
						La obra social no se puede eliminar porque existen pacientes o medicos relacionados a ella. 
						</div>";
				}
				
			?>
			
			<!-- COMIENZA BARRA DE OPCIONES -->
			<div class="btn-group" style="margin-top: 45px; margin-left: 270;">
			        <button class="btn btn-info" type="button" onclick="location.href='AltaLicencias.php'">Agregar Licencia</button>
                    <button class="btn btn-info" type="button"onclick="location.href='ReporteLicencias.php?ojito=<?php echo $ojito ?>'">Generar Reporte</button>
				    <button class="btn btn-info" type="button"
					<?php	if($ojito == 1){ ?>
								onclick="location.href='GestionLicencias.php?ojito=0'"> Mostrar Inactivas <i class="icon-eye-close" style="margin-left: 3px;"></i>
					<?php	} else { ?>			
								onclick="location.href='GestionLicencias.php?ojito=1'"> Ocultar Inactivas <i class="icon-eye-open" style="margin-left: 3px;"></i>
					<?php	} ?>
					</button>
			</div>
			<!-- FIN BARRA DE OPCIONES -->
			
		</div>
		
		<div id="tabla-gestion-licencias">

				<table class="table table-striped">
					<tr>
						<td><b>Medico</b></b></td>
						<td><b>Fecha Desde</b></td>
						<td><b>Fecha Hasta</b></td>	
					    <td><b>Estado</b></td>
					</tr>
					
					<?php while ($valor = mysql_fetch_array($resultado)) {	?>
					<tr>
						<td><?php echo $valor["nombre"]." ".$valor["apellido"]; ?></td>
						<td><?php echo $valor["fechaDesde"]; ?></td>
						<td><?php echo $valor["fechaHasta"]; ?></td>
						<td><?php echo $valor["estado"]; ?></td>
						
					</tr>
					<?php } ?>
				</table>
		</div>

	</div>  <!-- FIN ENCAPSULADOR-->

</body>
</html>

  
  