<?php
 
	include_once('mysqlconnect.php');
	
	if( isset($_GET['idpaciente'])){
		
		$obrasString = $_GET['obras'];
		
		$consulta = " 	SELECT 
								idobra, 
								nombre
						FROM	
								obrasociales
						WHERE 	
								idobra IN (".$obrasString.") 
						AND		activo = 1";
					
		$obrasDeBase = mysql_query($consulta);	
		if(isset($_GET['Error'])){
			$consultaobra = "	SELECT 
										o.nombre 
								FROM 
										obrasociales AS o
								INNER JOIN 
										pac_obrasocial AS po ON po.idobra = o.idobra
								WHERE 
										po.idobra = ".$_GET['idobra']." " ;
										
			$resobra = mysql_query($consultaobra);
			while ($valor = mysql_fetch_array($obrasDeBase)) {
				$nomObra = $valor['nombre'];
			}
		}
	} else {
		header('Location: AltaPacientes.php?Error=2');
	}
			
?>     <!-- Fin de CONSULTAS-->
   
<head>
<meta charset="UTF-8">
<title>ClinicSystem - Pacientes</title>

<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>

<!--JQuery-->
<script src='js/jquery.min.js'></script>
<script src='js/validarNumeroAfiliado.js'></script>

</head>
    <!-- Fin de HEAD-->
	
<body style="background-image:url('images/bg.png')">
 
	<?php include_once('header.php'); ?>
	
	<div class="encapsulador">
	
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
							Ya existe un afiliado a ".$nomObra." con ese Numero de Afiliado. Por Favor verifique el numero.
							</div>";
					}
				}else{

				
			?>
			
			<div id="form-alta-nroafiliado">
			
				<form class="form-horizontal" method="POST" action="AgregarNroAfiliadoObras.php" enctype="multipart/form-data">
				   
					<?php
						while ($obra = mysql_fetch_array($obrasDeBase)) {
					?>
							<label class="label"> <?php echo $obra['nombre']?></label>
							<br>
							<input name="<?php echo $obra['idobra'] ?>" type="text" maxlength="30" required placeholder="Nro Afiliado..">
							<br>
					<?php 
						}
						
					?>
						<input type="hidden" name="obras" value="<?php echo $obrasString?>" />	    
						<input type="hidden" name="idpaciente" value="<?php echo $_GET['idpaciente'] ?>" />
					
					<div style="margin-left:20px;margin-top: 50px;">
								<button class="btnsubmit btn-success" type="submit">Agregar</button>
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
