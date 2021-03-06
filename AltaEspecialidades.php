<?php

include_once('mysqlconnect.php');

?>
 
<head>
<meta charset="UTF-8">
<title>ClinicSystem - Especialidades</title>

<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>

<!--JQuery-->
<script src='js/jquery.min.js'></script>
<script src='js/validarAltaEspecialidad.js'></script>

</head>
    <!-- Fin de HEAD-->
	
<body style="background-image:url('images/bg.png')">
 	
	<?php include_once('header.php'); ?>
	
	<div class="encapsulador">
	


		<div class="contenedor">

			<ul class="breadcrumb">
				<li> 
					<h5>Alta de Especialidades <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
																				<!-- ICONO DE AYUDA -->  
				</li>
			</ul>   <!-- Fin del titulo de pagina-->
            <?php
				if(isset($_GET['Error'])){
					echo"<div class='alert alert-error'>
						<h4>Aviso!</h4>
						Ya existe una Especialidad con ese nombre. Verifique que la misma puede estar deshabilitada.
					</div>";
				}
			?>
			
			<div id="form-alta-especialidad" style="margin-left: 15px;"> 
		   
				<form class="form-horizontal" method="POST" action="AgregarEspecialidad.php" enctype="multipart/form-data" > 
		  
					<div class="control-group">
						<input id="nom" type="text" maxlength="30"  placeholder="Nombre.." class="nombree" name="nombre">
					</div>
										
					<div style="margin-left: 22px;">
						<button class="btnsubmit btn-success" type="submit">Agregar</button>
						<button class="btn btn-danger" type="button" onclick="location.href='GestionEspecialidades.php'">Cancelar </button>
						<span class="help-block" style="font-size: 9px; margin-left: 28px;"> Campo Nombre obligatorio.</span>
					</div>
					
				</form>
			</div>
			
		</div>     <!-- FIN DIV CONTENDOR -->
	
	</div>  <!-- FIN ENCAPSULADOR-->

</body>
</html>
