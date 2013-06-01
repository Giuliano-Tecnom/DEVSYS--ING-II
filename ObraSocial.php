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


 
	<div class="encapsulador">
	
		<table style="margin-top: 40px; ">
			<tr>
			<td>
				<h3 style="font-size: 76PX;margin-top: 30px; color: #00CCFF;">CLIMED</h3>   	
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
		</table> 	<!-- Fin de Men�-->

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
						<h4>Error!</h4>
						Ya existe una Obra Social con ese nombre. Verifique que la misma puede estar deshabilitada.
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
