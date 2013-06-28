<?php

include_once('mysqlconnect.php');
?>
 
<head>
<meta charset="UTF-8">
<title>ClinicSystem - Obras Sociales</title>

<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>


<!--JQuery-->
<script src='js/jquery.min.js'></script>
<script src='js/validarAltaObra.js'></script>

</head>
    <!-- Fin de HEAD-->
	
<body style="background-image:url('images/bg.png')">
 	
	<?php include_once('header.php'); ?>
	
	<div class="encapsulador">

		<div class="contenedor">

			<ul class="breadcrumb">
				<li> 
					<h5>Alta de Obras Sociales <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
																				<!-- ICONO DE AYUDA -->  
				</li>
			</ul>   <!-- Fin del titulo de pagina-->

			<?php
				if(isset($_GET['Error'])){
					echo"<div class='alert alert-error'>
						<h4>Ya existe una Obra Social con ese nombre.</h4>
						 Verifique que la misma puede estar deshabilitada o Ingrese un nombre diferente para la nueva obra social.
					</div>";
				}
			?>
			
			<div id="form-alta-pacientes"> 
		   
				<form class="form-horizontal" method="POST" action="AgregarObras.php" enctype="multipart/form-data" > 
		  
					<div class="control-group">
						<input class="nombree" name="nombre" type="text" maxlength="50" placeholder="Nombre..">
						<span class="help-block" style="margin-left: 4px; margin-top: -2px; font-size: 9px;"> Campo Nombre obligatorio.</span>
					</div>
										
					<div style="margin-left: 225px; margin-top: -62px;">
						<a data-toggle="modal" role="button" href="#agregar" class="btnsubmit btn-success">Agregar</a>
						<!-- MODAL DE AGREGAR -->
						<div id="agregar" class="modal hide fade in" style="display: none; ">
							<div class="modal-body">
								<h4>Aviso</h4>	      
								<p> Esta seguro que desea Agregar la Obra nueva? </p>
							</div>
							<div class="modal-footer">
								<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
								<button class="btn btn-success" type="submit" onclick="location.href='AgregarObras.php'">Aceptar</button>
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
								<a class="btn btn-danger"  href="GestionObras.php">Aceptar</a>
							</div>
						</div>
					</div>	
				</form>
			</div>

		</div>     <!-- FIN DIV CONTENDOR -->
	
	</div>  <!-- FIN ENCAPSULADOR-->

</body>
</html>
