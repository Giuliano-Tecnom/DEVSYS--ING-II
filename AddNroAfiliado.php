 <?php
	include_once('mysqlconnect.php');
	
	$consulta = "SELECT nombre,obrasociales.idobra
FROM pac_obrasocial inner join obrasociales on pac_obrasocial.idobra= obrasociales.idobra
WHERE dni= ".$_GET['dni']." ";
    $resultado = mysql_query($consulta);			

		
				
				
	
				
?>
<head>
<meta charset="UTF-8">
<title>ClinicSystem - Pacientes</title>

<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>

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
							<td><a href="#"><button class="btn btn-large" type="button">Home</button></a></td>
							<td><a href="#"><button class="btn btn-large btn-info" type="button">Pacientes</button></a></td>
							<td><a href="#"><button class="btn btn-large" type="button">Medicos</button></a></td>
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
					<h5>Alta de Pacientes <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
																				<!-- ICONO DE AYUDA -->  
				</li>
			</ul>   <!-- Fin del titulo de pagina-->

			
		<form class="form-horizontal" method="POST" action="AgregarNroAfiliado.php" enctype="multipart/form-data">
		   
		  
			
			<?php
				while ($valor = mysql_fetch_array($resultado)) {
			?>
					<label> <?php echo $valor['nombre']?></label>
					<input name="<?php echo $valor['idobra'] ?>" type="text" placeholder="Nro Afiliado..">
			<?php 
				$obras[]= $valor['idobra'];
				}
				
			?>
				<input type="hidden" name="obras" value='<?php echo serialize($obras)?>' />	    
				<input type="hidden" name="dni" value="<?php echo $_GET['dni'] ?>" />
			
			<div style="margin-left:300px;margin-top: 90px;">
						<button class="btn btn-success" type="submit">Agregar</button>
						<button class="btn btn-danger" type="button">Cancelar </button>
					</div>
		
		</form>

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
