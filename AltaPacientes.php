 <?php
	include_once('mysqlconnect.php');
	
	$consulta = "SELECT idobra, nombre FROM obrasociales where activo = 1 ORDER BY nombre";
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
		</table> 	<!-- Fin de Menú-->

		<div class="contenedor">

			<ul class="breadcrumb">
				<li> 
					<h5>Alta de Pacientes <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
																				<!-- ICONO DE AYUDA -->  
				</li>
			</ul>   <!-- Fin del titulo de pagina-->
            <?php
				if(isset($_GET['Correcto'])){
					echo"<div class='alert alert-success'>
						<h4>Paciente Agregado Correctamente</h4>
						
					</div>";
				}
			?>
			<?php
				if(isset($_GET['Error'])){
					echo"<div class='alert alert-error'>
						<h4>El paciente que desea agregar ya se encuentra dado de alta.</h4>
						
					</div>";
				}
			?>
			
			<div id="form-alta-pacientes"> 
		   
				<form class="form-horizontal" method="POST" action="AgregarPaciente.php" enctype="multipart/form-data" >
		  
					<div class="control-group" >
						<input name="nombre" type="text" placeholder="Nombre..">
					</div>
					<div class="control-group">
						<input name="apellido" type="text" placeholder="Apellido..">
					</div>
					<div class="control-group">
						<input name="dni" type="text" placeholder="DNI..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Sin puntos, Ej: 36789456</span>
					</div>
					<div class="control-group">
						<input name="email" type="text" placeholder="Email..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ej: aaa@gmail.com</span>
					</div>
					<div class="control-group">
						<input name="tel" type="text" placeholder="Telefono..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Sin parentesis, ni espacios Ej: 02214567800</span>
					</div>
					<div class="control-group">
						<input name="dir" type="text" placeholder="Direccion..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ej: 60 N 1009</span>
					</div>
					<div class="control-group">
						<input name="fecnac" type="date" placeholder="Fecha de Nacimiento..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ingrese DD.MM.AAAA</span>
					</div>
				
					
					
					<div style="margin-left: 300px;margin-top: -285px;">
						<label>Obra Social</label>
						<select multiple="multiple" id="obra" name="obra[]">
						<?php
							while ($valor = mysql_fetch_array($resultado)) {
						?>
								<option value="<?php echo $valor["idobra"];?>"><?php echo $valor["nombre"]; ?></option>
						<?php	  
							}
						?>
						</select>
						<span class="help-block" style="font-size: 9px;"> Seleccion multiple: SHIFT + CLIK.</span>
					</div>
					<div style="margin-left: 550px;margin-top: -77px;">
						<button class="btn btn-mini" onclick="location.href='GestionObras.php'"type="button">Editar</button>
					</div>
					<div style="margin-left:300px;margin-top: 90px;">
						<button class="btn btn-success" type="submit">Agregar</button>
						<button class="btn btn-danger" type="button">Cancelar </button>
					</div>
					<span class="help-block" style="margin-left: 300px;font-size: 9px;"> Todos los campos son obligatorios, salvo el Email.</span>
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
