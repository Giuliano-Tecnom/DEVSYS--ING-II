<?php
	
	
	include_once('mysqlconnect.php');
	
	$consulta = "SELECT * FROM pacientes WHERE dni= ".$_GET['dni']."";
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

		 <table style="margin-top: 40px; margin-left: 25px;">
			<tr>
			<td>
				<div>
					<h3 style="font-size: 76px;margin-top: 30px; color: #00CCFF;">CLIMED</h3>    
				</div>
			</td>
			<td> 
			<div style="margin-left: 200px; margin-top: 27px;">
				<table>
					<tr>
					<td><a href="#"><button class="btn btn-large " type="button">Home</button></a></td>
					<td><a href="#"><button class="btn btn-large btn-info" type="button">Pacientes</button></a></td>
					<td><a href="#"><button class="btn btn-large" type="button">Medicos</button></a></td>
					<td><a href="#"><button class="btn btn-large" type="button">Turnos</button></a></td>
					</tr>
				</table>
			</div>
			</td>
			</tr>
		 </table>

		<!-- Fin de Men�-->

		<div class="contenedor">
			
			<ul class="breadcrumb">
				<li> 
					<h5>Modificacion de Pacientes <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
														 <!-- ICONO DE AYUDA -->  
				</li>
			</ul>

			<div id="form-modificacion-pacientes"> 
		   
				<form class="form-horizontal">
		  
					<div class="control-group">
						<input id="nom" type="text" placeholder="Nombre..">
					</div>
					<div class="control-group">
						<input id="ape" type="text" placeholder="Apellido..">
					</div>
					<div class="control-group">
						<input id="dni" type="text" placeholder="DNI..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Sin puntos, Ej: 36789456</span>
					</div>
					<div class="control-group">
						<input id="email" type="text" placeholder="Email..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ej: aaa@gmail.com</span>
					</div>
					<div class="control-group">
						<input id="tel" type="text" placeholder="Telefono..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Sin parentesis, ni espacios Ej: 02214567800</span>
					</div>
					<div class="control-group">
						<input id="dir" type="text" placeholder="Direccion..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ej: 60 N 1009</span>
					</div>
					<div class="control-group">
						<input id="fecnac" type="text" placeholder="Fecha de Nacimiento..">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ingrese DD/MM/AAAA</span>
					</div>
					<div style="margin-left: 300px;margin-top: -350px;">
						<label>Obra Social</label>
						<select multiple="multiple" id="obras[]">
							<option>GALENO</option>
							<option>OSSEG</option>
							<option>IOMA</option>
							<option>OSDE</option>
							<option>OSECAC</option>   
						</select>
					</div>
					<div style="margin-left: 550px;margin-top: -77px;">
						<button class="btn btn-mini" type="button">Editar</button>
					</div>
					<div style="margin-left:300px;margin-top: 90px;">
						<button class="btn btn-success" type="submit">Modificar</button>
						<button class="btn btn-danger" type="button">Cancelar </button>
					</div>
					<span class="help-block" style="margin-left: 300px;font-size: 9px;"> Todos los campos son obligatorios, salvo el Email.</span>
				</form>
			</div>
			
			<!-- BOTON DE SALIR-->
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