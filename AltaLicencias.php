<?php

include_once('mysqlconnect.php');

$consulta = "SELECT * FROM medicos WHERE medicos.activo = 1";
$query_med = mysql_query($consulta);
?>
 
<head>
<meta charset="UTF-8">
<title>ClinicSystem - Licencias</title>

<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>


<!--JQuery-->
<script src='js/jquery.min.js'></script>

</head>
    <!-- Fin de HEAD-->
	
<body style="background-image:url('images/bg.png')">
 	
	<?php include_once('header.php'); ?>
	
	<div class="encapsulador">

		<div class="contenedor">

			<ul class="breadcrumb">
				<li> 
					<h5>Alta de Licencias <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
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
		   
				<form class="form-horizontal" method="POST" action="AgregarLicencias.php" enctype="multipart/form-data" > 
		  
					<div class="control-group" style="margin-top: -12px; margin-left: 50px;">
						<label>Medico:</label>
						<select id="myselect2" name="myselect2" required>
							<option value=0>Seleccione un Medico...</option>
							<?php
								while ($valor = mysql_fetch_array($query_med)) {
									if ($myselect2 == $valor["idmedico"]) {
										$sel= " SELECTED ";
									}else{
										$sel= "";
									} 
							?>
									<option  value="<?php echo $valor["idmedico"];?>"><?php echo $valor["nombre"]; ?> <?php echo $valor["apellido"]; ?></option>
							<?php	  
								}
							?>
						</select>
					</div>
					
					<!-- ***************************** FECHAAAA ***************************** -->
					<?php 
						$min_fechaDesde = date("Y-m-d");
						$min_fechaHasta = date("Y-m-d",strtotime("+1 days"));
						$max_fecha = date("Y-m-d",strtotime("+365 days"));
					?>
					<div class = "fecha1" style="margin-top: -68px; margin-left: 342px;">
						<label>Fecha Desde:</label>
						<input id="fechaDesde" name="fechaDesde" type="date" min="<?php echo $min_fechaDesde?>" max="<?php echo $max_fecha?>" placeholder="Fecha" required>
					</div>
					
					<div class = "fecha2" style="margin-top: -45px; margin-left: 615px;">
						<label>Fecha Hasta:</label>
						<input id="fechaHasta" name="fechaHasta" type="date" min="<?php echo $min_fechaHasta?>" max="<?php echo $max_fecha?>" placeholder="Fecha" required>
					</div>					
									
					<div style="margin-left:367px;margin-top: 55px;">
						<button class="btnsubmit btn-success" type="submit">Agregar</button>
						<button class="btn btn-danger" type="button">Cancelar </button>
					</div>
				</form>
			</div>
		
			
		</div>     <!-- FIN DIV CONTENDOR -->
	
	</div>  <!-- FIN ENCAPSULADOR-->

</body>
</html>
