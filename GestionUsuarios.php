<!doctype html>  
<?php

	if (!isset($_REQUEST['ojito'])) {
		$ojito=1;
	} else {
		$ojito=$_REQUEST['ojito'];
	}

?>

<head>
<meta charset="UTF-8">
<title>ClinicSystem - Usuarios</title>

<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>

</head>
    
<body style="background-image:url('images/bg.png')">
<!--JQuery-->
<script src='js/jquery.min.js'></script>


	<?php
	
	include_once('mysqlconnect.php');

	$consulta = "SELECT idusuario, nombre, apellido, usuario, tipo, activo FROM usuarios WHERE activo = ".$ojito." OR 0 = ".$ojito." ";
	$res = mysql_query($consulta);
	
	include_once('header.php'); 

	?>
	
	
	

	<div class="encapsulador">

		<div class="contenedor">

			<ul class="breadcrumb">
				<li> 
					<h5>Gestion de Usuarios <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
																					<!-- ICONO DE AYUDA -->  
				</li>
			</ul>   <!-- Fin del titulo de pagina-->

			<?php
			if(isset($_GET['Correcto'])){
					if($_GET['Correcto'] == 1){
					echo"<div class='alert alert-success'>
						<h4>Se Elimino al Usuario Correctamente!!</h4>
						</div>";
					}	
					if($_GET['Correcto'] == 2){
					echo"<div class='alert alert-success'>
						<h4>Se Modifico al Usuario Correctamente!!</h4>
						</div>";
					}	
					
					if($_GET['Correcto'] == 3){
					echo"<div class='alert alert-success'>
						<h4>Se agrego al Usuario Correctamente!!</h4>
						</div>";
					}

					if($_GET['Correcto'] == 4){
					echo"<div class='alert alert-success'>
						<h4>Se habilito al Usuario Correctamente!!</h4>
						</div>";
					}		
			
			}


			?>
			<?php
			if(isset($_GET['Error'])){
					if($_GET['Error'] == 1){
					echo"<div class='alert alert-success'>
						<h4>Ya existe un Usuario igual!!</h4>
						Por favor, realize nuevamente el proceso e ingrese un usuario distinto.
						</div>";
					}	
			}

			?>

				<!-- COMIENZA BARRA DE OPCIONES -->
				<div class="btn-group" style="margin-top: -13px; margin-left: 270;">

	      
					    <button class="btn btn-info" type="button"
						<?php	if($ojito == 1){ ?>
									onclick="location.href='GestionUsuarios.php?ojito=0'"> Mostrar Inactivos <i class="icon-eye-close" style="margin-left: 3px;"></i>
						<?php	} else { ?>			
									onclick="location.href='GestionUsuarios.php?ojito=1'"> Ocultar Inactivos <i class="icon-eye-open" style="margin-left: 3px;"></i>
						<?php	} ?>
						</button>

				</div>
				<br></br>
				<br></br>
				<!-- FIN BARRA DE OPCIONES -->




			<div id="tabla-gestion-usuarios">

				<table class="table table-striped">
					<tr>
						<td><b>Usuario</b></td>
						<td><b>Nombre</b></td>
						<td><b>Apellido</b></td>
						<td><b>Tipo de Usuario</b></td>
						<td></td>
						<td></td>
					</tr>
				<?php
				while ($valor = mysql_fetch_array($res)) {
				?>
					<tr>
						<td><?php echo $valor["usuario"]; ?></td>
						<td><?php echo $valor["nombre"]; ?></td>
						<td><?php echo $valor["apellido"]; ?></td>
						<td><?php echo $valor["tipo"]; ?></td>
						<?php 
						$idusuario = $valor["idusuario"];
						?>	

						<?php 
							
								if( $valor["activo"] == 1 ){
						?>	
									<td><a data-toggle="modal" role="button" href="#borrar<?php echo $idusuario; ?>" class="btn btn-danger">Borrar</a></td>
									<!-- MODAL DE BORRAR -->
									<div id="borrar<?php echo $idusuario; ?>" class="modal hide fade in" style="display: none; ">
										<div class="modal-body">
											<h4>Aviso</h4>	      
											<p> Esta seguro que desea Borrar al usuario <b><?php echo $valor["usuario"]; ?></b> ? </p>
										</div>
										<div class="modal-footer">
											<a href="#" class="btn" data-dismiss="modal">No</a>
											<a class="btn btn-danger"  href="BorrarUsuario.php?idusuario=<?php echo $idusuario; ?>">Si</a>
										</div>
									</div>
									
									
						<?php	}else{ ?>
									<td><button class="btn btn-success" type="button" onclick="location.href='HabilitarUsuario.php?idusuario=<?php echo $idusuario; ?> '">Habilitar</button></td>
						<?php	}  	?>
						
						<td><button class="btn btn-warning" onclick="location.href='Usuario.php?idusuario=<?php echo $idusuario; ?>'"type="button">Modificar</button> </td>
					</tr>
				<?php
				}
				?>	
				</table>
			</div>


		</div>

	</div>  <!-- FIN ENCAPSULADOR-->
	
	
</body>
</html>
