<?php
	if (!isset($_GET['ojito'])) {
		$ojito=1;
	}else{
		$ojito=$_GET['ojito'];
	}
	include_once('mysqlconnect.php');
	$consulta = "SELECT * FROM pacientes 
	where pacientes.activo = ".$ojito." OR 0 = ".$ojito." ";
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
				<h3 style="font-size: 76px;margin-top: 30px; color: #00CCFF;">CLIMED</h3>   	
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
		</table>	<!-- Fin de Menú-->

		<div class="contenedor">
			
			<ul class="breadcrumb">
				<li> 
					<h5>Gestion de Pacientes<a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
														 <!-- ICONO DE AYUDA -->  
				</li>
			</ul>
		  
		  <?php if(isset($_GET['Correcto'])){
					echo"<div class='alert alert-success'>
						<h4>Paciente Agregado Correctamente</h4>
						
					</div>";
				}
				?>
			<div id="form-gestion-pacientes"> 
		   
				<form class="form-horizontal">
					<div class="control-group">
						<input id="nom" type="text" placeholder="Buscar por nombre..">
					</div>
					<div class="control-group">
						<input id="ape" type="text" placeholder="Buscar por apellido..">
					</div>
					<div class="control-group">
						<input id="dni" type="text" placeholder="Buscar por DNI..">
					</div> 
					<div class="control-group">
						<input id="email" type="text" placeholder="Buscar por Email..">
					</div>
					<div class="control-group">
						Edad desde:
						<select id="edadmin" class="span2">
						  <option value="0">0</option>
						</select> 
					</div>
					<div class="control-group">
						Edad Hasta: 
						<select id="edadmax" class="span2">
						  <option value="120">120</option>
						</select> 
					</div>
					<div style="margin-left: 300px;margin-top: -300px;">
						<label>Obra Social</label>
						<select multiple="multiple">
							<option>Cualquiera</option>
							<option>GALENO</option>
							<option>OSSEG</option>
							<option>IOMA</option>
							<option>OSDE</option>
							<option>OSECAC</option>   
						</select>
					</div> 
					<div style="margin-left:300px;margin-top: 25px;">
						<button class="btn btn-success" type="button">Buscar</button>
						<button class="btn btn-danger" type="button">Limpiar </button>
					</div>
					<button class="btn btn-primary" type="button" onclick="location.href='AltaPacientes.php'"
					style="margin-top: 25px;margin-left: 300px;">Paciente Nuevo</button>
				</form>
			</div>
			<div id="tabla-gestion-pacientes">

				<table class="table table-striped">
					<tr>
						<td>Nombre </td> 
						<td>Apellido</td>
						<td>Direccion</td>
						<td>Telefono</td>
						<td>Email</td>
						<td>Obra Social</td>
						<td>Dni</td>
						<td>F.Nac</td>
						<td><b>Activo</b>
						<?php

							if($ojito == 1){
								echo "<a href='GestionPacientes.php?ojito=0'><i class='icon-eye-close' style='margin-left: 3px; margin-top: 3px;'></i></a>"; 
							} else {
								echo "<a href='GestionPacientes.php?ojito=1'><i class='icon-eye-open' style='margin-left: 3px; margin-top: 3px;'></i></a>";
							}
						?>
						</td>
						<td></td>
						<td></td>
					</tr>
					<?php
				while ($valor = mysql_fetch_array($resultado))
				{
				?>
					<tr>
						<td><?php echo $valor["nombre"]; ?></td>
						<td><?php echo $valor["apellido"]; ?></td>
						<td><?php echo $valor["direccion"]; ?></td>
						<td><?php echo $valor["telefono"]; ?></td>
						<td><?php echo $valor["email"]; ?></td>
						<td><?php
						
						
						$query= "SELECT  * from pac_obrasocial 
	                             inner join obrasociales on obrasociales.idobra=pac_obrasocial.idobra 
								 where dni ='" .$valor["dni"]. "'";

						
						$res = mysql_query($query);
						while ($obra=mysql_fetch_array($res)) {
						echo "&nbsp;".$obra["nombre"]."";
						}
						
						
						?>
						
						
						
						</td>
						<td><?php echo $valor["dni"]; ?></td>
						<td><?php echo $valor["fechaNac"]; ?></td>
						<?php 
							$id = $valor['idpaciente'];
							
							if( $valor["activo"] == 1 ){
								echo "<td>  Si </td>";
								echo "<td><button class='btn btn-warning' type='button'><a href='BorrarPaciente.php?idespecialidad=".$id."'>Borrar </a></button> </td>";
							}     
						    else {
							    echo "<td>No</td>";
								echo "<td><button class='btn btn-success' type='button'><a href='HabilitarPaciente.php?idespecialidad=".$id."'>Habilitar </a></button> </td>";
							}  
						?>
						
						<td><button class="btn btn-danger" onclick="location.href='Pacientes.php?idobra=<?php echo $valor["idobra"]; ?>'" type="button">Modif</button> </td>
						
					</tr>
				<?php
				}
				?>	
				</table>
			</div>

						<!-- BOTON DE SALIR, ATRAS y REPORTE-->
			<ul class="breadcrumb">
				<li> 
					<button class="btn btn-primary" style="margin-left:400px;" type="button">Generar Reporte</button>
					<div style="margin-left: 800px;">
						<button class="btn btn-primary"type="button"> Atras </button>
						<button class="btn btn-inverse" type="button"> Salir </button>
					</div>
				</li>
			</ul>

		</div>      <!-- FIN DIV CONTENDOR -->


	</div>  <!-- FIN ENCAPSULADOR-->





</body>
</html>

  
  