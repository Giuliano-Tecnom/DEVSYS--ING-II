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
<script src='js/validarEspecialidad.js'></script>

</head>
    <!-- Fin de HEAD-->
	
<body style="background-image:url('images/bg.png')">
 	
	<?php include_once('header.php'); ?>
	
	<div class="encapsulador">

		<div class="contenedor">

			<ul class="breadcrumb">
				<li> 
					<h5>Modificar Especialidades <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
																				<!-- ICONO DE AYUDA -->  
				</li>
			</ul>   <!-- Fin del titulo de pagina-->
            <?php
				if(isset($_GET['Error'])){
					echo"<div class='alert alert-error'>
						<h4>Error!</h4>
						Ya existe una Especialidad con ese nombre. Verifique que la misma puede estar deshabilitada.
					</div>";
				}
			?>
			
			<div id="form-alta-pacientes"> 
			<?php
					if(isset($_GET['idespecialidad']))
					{
						$consulta_tipo = "SELECT nombre  FROM especialidades WHERE idespecialidad = '" . $_GET['idespecialidad'] . "';";
						$resultado = mysql_query($consulta_tipo);
						$nombre = mysql_fetch_array($resultado);
			
		   ?>
				<form class="form-horizontal" method="POST" action="ModificarEspecialidad.php" enctype="multipart/form-data" > 
		  
					<div class="control-group">
						<input class="nombree" type="text" placeholder="Nombre.." name="nombre" value="<?php echo $nombre['nombre'];?> ">
					    <input type="hidden" name="idespecialidad" value="<?php echo $_GET['idespecialidad']; ?>" />
						<button class="btnsubmit btn-danger" type="submit">Modificar</button>
						
					
					</div>
										
						
					<span class="help-block" style="margin-left: 300px;font-size: 9px;"> Campo Nombre obligatorio.</span>
				</form>
			</div>
			
			 
			<?php 
			        }
			?>

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
