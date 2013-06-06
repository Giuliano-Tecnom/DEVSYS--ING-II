<?php
 
	include_once('mysqlconnect.php');
	
	if( isset ($_GET['oaborrar'])) {
		$obrasABorrarString = $_GET['oaborrar'];
		$obrasABorrar = explode(",",$_GET['oaborrar']);
	} else {
		$obrasABorrar = array();
		$obrasABorrarString;
	}
	
	if(isset($_GET['obras'])){
		$obrasSeleccionadasString = $_GET['obras'];

		if (!($obrasSeleccionadasString == "")){
			$obrasConIdNombreConsulta = "SELECT os.nombre, os.idobra, po.nroAfiliado
											FROM obrasociales as os
											LEFT JOIN pac_obrasocial as po 
											ON po.idobra = os.idobra
											WHERE os.idobra IN (".$obrasSeleccionadasString.")";
			$obrasConIdNombre = mysql_query($obrasConIdNombreConsulta);
			
			//$obrasSeleccionadas = explode(",",$obrasSeleccionadasString); 
		}
	} else {
		$obrasSeleccionadasString;
	}
			
?>     <!-- Fin de CONSULTAS-->
   
<head>
<meta charset="UTF-8">
<title>ClinicSystem - Pacientes</title>

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
					<h5>Modificacio / Alta de Nro Afialiado <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
																				<!-- ICONO DE AYUDA -->  
				</li>
			</ul>   <!-- Fin del titulo de pagina-->
			
			<div id="form-alta-nroafiliado">
			
				<form class="form-horizontal" name="form" method="POST" action="ModificarNroAfiliado.php" enctype="multipart/form-data">
				   
					<?php
						if (!empty($obrasSeleccionadasString)){
							while ($valor = mysql_fetch_array($obrasConIdNombre)) {
					?>
							<label class="label"> <?php echo $valor['nombre']?></label>

							<br>
							<?php
							if ($valor['nroAfiliado'] != "") {
							?>
							<input name="<?php echo $valor['idobra'] ?>" type="text" maxlength="30" required placeholder="Nro Afiliado.." value="<?php echo $valor['nroAfiliado'] ?>">
							<?php
							} else {
							?>
							<input name="<?php echo $valor['idobra'] ?>" type="text" maxlength="30" required placeholder="Nro Afiliado..">
							<?php
							}
							?>
							<br>
					<?php 
							$obrasSoloIDS[]= $valor['idobra'];
							}
							$obrasSoloIDS = implode(",",$obrasSoloIDS);
							
					?>		
						<input type="hidden" name="obrasSoloIDS" value='<?php echo $obrasSoloIDS ?>' />	  
						<input type="hidden" name="obrasABorrarString" value='<?php echo $obrasABorrarString ?>' />	  						
						<input type="hidden" name="dni" value="<?php echo $_GET['dni'] ?>" />
						<?php
						} else {
						?>
						
						 
						<input type="hidden" name="obrasABorrarString" value='<?php echo $obrasABorrarString ?>' />	  						
						<input type="hidden" name="dni" value="<?php echo $_GET['dni'] ?>" />
						<script language="JavaScript">document.form.submit();</script>
						<?php
						}
						?>
						


						
					
					<div style="margin-left:20px;margin-top: 50px;">
								<button class="btn btn-success" type="submit">Agregar</button>
								<button class="btn btn-danger" type="button" onclick="location.href='GestionPacientes.php'">Cancelar </button>
							</div>
				
				</form>
				
			</div>	
				<!-- BOTON DE SALIR Y ATRAS-->
				<ul class="breadcrumb" style="margin-top: 500px;">
					<li> 
						<div style="margin-left: 800px;">
							<button class="btn btn-primary"type="button" onclick="javascript:history.go(-1)"> Atras </button>
							<button class="btn btn-inverse" type="button" onclick="window.close();"> Salir </button>
						</div>
					</li>
				</ul>
				
			</div>     <!-- FIN DIV CONTENDOR -->
	
	</div>  <!-- FIN ENCAPSULADOR-->
 
 
</body>
</html>