<?php
	if (!isset($_GET['ojito'])) {
		$ojito=1;
	}else{
		$ojito=$_GET['ojito'];
	}
	include_once('mysqlconnect.php');
	$consulta = "SELECT idobra,nombre,activo FROM obrasociales where activo = ".$ojito." OR 0 = ".$ojito." ";
    $resultado = mysql_query($consulta);
	

?> 
<html>
<head>
<meta charset="UTF-8">
<title>ClinicSystem - Obras Sociales</title>

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
					<h5>Gestion de Obras Sociales<a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
														 <!-- ICONO DE AYUDA -->  
				</li>
			</ul>
		  	
			<?php 
		  		// MANEJADOR DE ERRORES!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

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
						<h4>La obra social no se puede eliminar porque existen pacientes o medicos relacionados a ella.</h4>
						 Revise este problema para luego poder borrar la obra social.
						</div>";
				}
				
			?>
			
			<!-- COMIENZA BARRA DE OPCIONES -->
			<div class="btn-group" style="margin-top: 45px; margin-left: 270;">
			        <button class="btn btn-info" type="button" onclick="location.href='AltaObras.php'">Agregar Obra Social</button>
                    <button class="btn btn-info" type="button">Generar Reporte</button>
				    <button class="btn btn-info" type="button"
					<?php	if($ojito == 1){ ?>
								onclick="location.href='GestionObras.php?ojito=0'"> Mostrar Inactivos <i class="icon-eye-close" style="margin-left: 3px;"></i>
					<?php	} else { ?>			
								onclick="location.href='GestionObras.php?ojito=1'"> Ocultar Inactivos <i class="icon-eye-open" style="margin-left: 3px;"></i>
					<?php	} ?>
					</button>
			</div>
			<!-- FIN BARRA DE OPCIONES -->
			
		</div>
		
		<div id="tabla-gestion-obrasociales">

				<table class="table table-striped">
					<tr>
						<td><b>Obra Social</b> </td>
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
								$idobra = $valor["idobra"];
								if( $valor["activo"] == 1 ){
						?>	
									<td><a data-toggle="modal" role="button" href="#borrar<?php echo $idobra; ?>" class="btn btn-danger">Borrar</a></td>
									<!-- MODAL DE BORRAR -->
									<div id="borrar<?php echo $idobra; ?>" class="modal hide fade in" style="display: none; ">
										<div class="modal-body">
											<h4>Aviso</h4>	      
											<p> Esta seguro que desea dar de baja la obra social? </p>
										</div>
										<div class="modal-footer">
											<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
											<a class="btn btn-warning"  href="BorrarObra.php?idobra=<?php echo $idobra; ?>">Aceptar</a>
										</div>
									</div>
						<?php	}else{ ?>
									<td><button class="btn btn-success" type="button" onclick="location.href='HabilitarObra.php?idobra=<?php echo $idobra; ?> '">Habilitar</button></td>
						<?php	}  	?>						
						
						<td><button class="btn btn-warning" onclick="location.href='ObraSocial.php?idobra=<?php echo $valor["idobra"]; ?>'" type="button">Modificar</button> </td>
						
					</tr>
				<?php
				}
				?>	
				</table>
		</div>

	</div>  <!-- FIN ENCAPSULADOR-->

</body>
</html>

  
  