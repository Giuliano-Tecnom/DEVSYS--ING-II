<?php
 
	include_once('mysqlconnect.php');
	
	if(isset($_GET['dni'])){
		$consulta = "SELECT nombre,obrasociales.idobra
					FROM pac_obrasocial 
					INNER JOIN obrasociales on pac_obrasocial.idobra= obrasociales.idobra
					WHERE dni= ".$_GET['dni']." ";
					
		$resultado = mysql_query($consulta);	
	if(isset($_GET['Error'])){
		$consultaobra = "SELECT nombre FROM obrasociales WHERE pac_obrasocial.idobra = ".$_GET['idobra']." " ;
		$resobra = mysql_query($consultaobra);
		while ($valor = mysql_fetch_array($resultado)) {
			$nomObra = $valor['nombre'];
		}
	}
	}else{
		header('Location: AltaPacientes.php?Error=2');
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
							<td><a href="GestionPacientes.php"><button class="btn btn-large btn-info" type="button">Pacientes</button></a></td>
							<td><a href="GestionMedicos.php"><button class="btn btn-large" type="button">Medicos</button></a></td>
							<td><a href="#"><button class="btn btn-large" type="button">Turnos</button></a></td>
						</tr>
					</table>
				</div>
			</td>
			</tr>
		</table> 	<!-- Fin de Menú-->

		<div class="contenedor">

			<ul class="breadcrumb">
				<li> 
					<h5>Alta de NroAfialiado <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
																				<!-- ICONO DE AYUDA -->  
				</li>
			</ul>   <!-- Fin del titulo de pagina-->
			<?php
				if(isset($_GET['Error'])){
					if($_GET['Error'] == 1){
						echo"<div class='alert alert-error'>
							<h4>Error!! </h4>
							Ya existe un afiliado a ".$nomObra." con ese Nro de Afiliado. Por Favor vuelva ATRAS.
							</div>";
					}
				}else{

				
			?>
			
			<div id="form-alta-nroafiliado">
			
				<form class="form-horizontal" method="POST" action="AgregarNroAfiliado.php" enctype="multipart/form-data">
				   
					<?php
						while ($valor = mysql_fetch_array($resultado)) {
					?>
							<label class="label"> <?php echo $valor['nombre']?></label>
							<br>
							<input name="<?php echo $valor['idobra'] ?>" type="text" placeholder="Nro Afiliado..">
							<br>
					<?php 
						$obras[]= $valor['idobra'];
						}
						
					?>
						<input type="hidden" name="obras" value='<?php echo serialize($obras)?>' />	    
						<input type="hidden" name="dni" value="<?php echo $_GET['dni'] ?>" />
					
					<div style="margin-left:20px;margin-top: 50px;">
								<button class="btn btn-success" type="submit">Agregar</button>
								<button class="btn btn-danger" type="button" onclick="location.href='GestionPacientes.php'">Cancelar </button>
							</div>
				
				</form>
				
			</div>	
			<?php
					}
				
			?>
			
			

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