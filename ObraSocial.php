<?php

include_once('mysqlconnect.php');
?>
 
<head>
<meta charset="UTF-8">
<title>ClinicSystem - Obra Social</title>

<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>
<script rel="javascript" src="js/boostrap-alerts.js"></script>

<!--JQuery-->
<script src='js/jquery.min.js'></script>
<script src='js/validarObra.js'></script>

</head>
    <!-- Fin de HEAD-->
	
<body style="background-image:url('images/bg.png')">

	<?php include_once('header.php'); ?>
 
	<div class="encapsulador">
	

		<div class="contenedor">

			<ul class="breadcrumb">
				<li> 
					<h5>Modificar Obra Social <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
																				<!-- ICONO DE AYUDA -->  
				</li>
			</ul>   <!-- Fin del titulo de pagina-->
			<?php
				if(isset($_GET['Error'])){
					echo"<div class='alert alert-error'>
						<h4>Ya existe una Obra Social con ese nombre.</h4>
						 Verifique que la misma puede estar deshabilitada o ingrese un nombre diferente.
					</div>";
				}
			?>
			<div id="form-alta-pacientes"> 
			<?php
					if(isset($_GET['idobra']))
					{
						$consulta_tipo = "SELECT nombre  FROM obrasociales WHERE idobra = '" . $_GET['idobra'] . "';";
						$resultado = mysql_query($consulta_tipo);
						$nombre = mysql_fetch_array($resultado);
			
		   ?>
				<form class="form-horizontal" method="POST" action="ModificarObra.php" enctype="multipart/form-data" > 
		  
					<div class="control-group">
						<input class="nombree" type="text" placeholder="Nombre.." name="nombre" value="<?php echo $nombre['nombre'];?>">
						<input type="hidden" name="idobra" value="<?php echo $_GET['idobra']; ?>" />
						<span class="help-block" style="margin-left: 4px; margin-top: -2px; font-size: 9px;"> Campo Nombre obligatorio.</span>
					</div>
					
					<div style="margin-left: 225px; margin-top: -62px;">
						<a data-toggle="modal" role="button" href="#modificar" class="btn btn-warning">Modificar</a>
						<!-- MODAL DE Modificar -->
						<div id="modificar" class="modal hide fade in" style="display: none; ">
							<div class="modal-body">
								<h4>Aviso</h4>	      
								<p> Esta seguro que desea modificar el nombre de la obra social? </p>
							</div>
							<div class="modal-footer">
								<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
								<button class="btnsubmit btn-warning" type="submit">Aceptar</button>
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
								<a class="btn btn-danger"  href="GestionObras.php">Aceptar</a>
							</div>
						</div>
					</div>
				</form>
			</div>
			
			 
			<?php 
			        }
			?>
		</div>     <!-- FIN DIV CONTENDOR -->
	
	</div>  <!-- FIN ENCAPSULADOR-->

</body>
</html>
