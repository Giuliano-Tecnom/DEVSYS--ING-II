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
						<h4>Error!</h4>
						Ya existe una Obra Social con ese nombre. Verifique que la misma puede estar deshabilitada.
					</div>";
				}
			?>
			
			<div id="form-alta-pacientes"> 
		   
				<form class="form-horizontal" method="POST" action="AgregarObras.php" enctype="multipart/form-data" > 
		  
					<div class="control-group">
						<input class="nombree" name="nombre" type="text" maxlength="5" placeholder="Nombre..">
					</div>
										
						<div style="margin-left:300px;margin-top: 90px;">
						<button class="btnsubmit btn-success" type="submit">Agregar</button>
						<button class="btn btn-danger" type="button">Cancelar </button>
					</div>
					<span class="help-block" style="margin-left: 300px;font-size: 9px;"> Campo Nombre obligatorio.</span>
				</form>
			</div>
			

			<!-- BOTON DE SALIR Y ATRAS-->
			<ul class="breadcrumb" style="margin-top: 600px;">
				<li> 
					<div style="margin-left: 800px;">
						<button class="btn btn-primary"type="button"> Atras </button>
						<button class="btn btn-inverse" type="button"> Salir </button>
					</div>
				</li>
			</ul>
			
		</div>     <!-- FIN DIV CONTENDOR -->
	
	</div>  <!-- FIN ENCAPSULADOR-->

</body>
</html>
