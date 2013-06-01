<?php
	
	if (!isset($_GET['ojito'])) {
		$ojito=1;
	}else{
		$ojito=$_GET['ojito'];
	}
	
	include_once('mysqlconnect.php');
	
	$consulta = "SELECT * FROM medicos WHERE medicos.activo = ".$ojito." OR 0 = ".$ojito." ";
    $resultado = mysql_query($consulta);
	
?> 

<head>
<meta charset="UTF-8">
<title>ClinicSystem - Medicos</title>

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
							<td><a href="index.php"><button class="btn btn-large" type="button">Home</button></a></td>
							<td><a href="GestionPacientes.php"><button class="btn btn-large" type="button">Pacientes</button></a></td>
							<td><a href="GestionMedicos.php"><button class="btn btn-large btn-info" type="button">Medicos</button></a></td>
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
					<h5>Gestion de Medicos<a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
														 <!-- ICONO DE AYUDA -->  
				</li>
			</ul>
		  
			<?php 
		  
				if(isset($_GET['Correcto'])){
					if($_GET['Correcto'] == 1){
						echo"<div class='alert alert-success'>
							<h4>Exito!</h4>
							El paciente se agrego correctamente.
							</div>";
					}
					if($_GET['Correcto'] == 2){
						echo"<div class='alert alert-success'>
							<h4>Exito!</h4>
							El paciente se borro correctamente.
							</div>";
					}
				}
				
				if(isset($_GET['Error'])){
					if($_GET['Error'] == 1)
					echo"<div class='alert alert-error'>
						<h4>Error!! </h4>
						</div>";
				}
				
			?>
			<!--
			<div id="form-gestion-medicos"> 
		   
				<form class="form-horizontal">
					<div class="control-group">
						<input name="nom" type="text" placeholder="Buscar por nombre..">
					</div>
					<div class="control-group">
						<input name="ape" type="text" placeholder="Buscar por apellido..">
					</div>
					<div class="control-group">
						<input name="dni" type="text" placeholder="Buscar por DNI..">
					</div> 
					<div class="control-group">
						<input name="email" type="text" placeholder="Buscar por Email..">
					</div>
					<div class="control-group">
						Edad desde:
						<select name="edadmin" class="span2">
							<option value="0"> < 1 </option>
							<?php
								for($i=1; $i < 121; $i++){
									echo " <option value='".$i."'>".$i."</option> ";
								}	
							?>
						</select> 
					</div>
					<div class="control-group">
						Edad Hasta: 
						<select name="edadmax" class="span2">
							<?php
						  		for($i=120; $i > 0; $i--){
									echo " <option value='".$i."'>".$i."</option> ";
								}
							?>
							<option value="0"> < 1 </option>
						</select> 
					</div>
					<div style="margin-left: 300px;margin-top: -265px;">
						<label>Obra Social</label>
						<select multiple="multiple" name="obras[]">
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
					<button class="btn btn-primary" type="button" onclick="location.href='AltaMedicos.php'"
					style="margin-top: 25px;margin-left: 300px;">Medico Nuevo</button>
				</form>
			</div>
			-->
			
			<!-- una vez que se descomente lo de arriba borrar estas dos lineas de aca abajo -->
			<button class="btn btn-primary" type="button" onclick="location.href='AltaMedicos.php'"
					style="margin-top: 25px;margin-left: 425px;">Medico Nuevo</button>
					
					
			<div id="tabla-gestion-medicos">

				<table class="table table-striped">
					<tr>
						<td>Nombre </td> 
						<td>Apellido</td>
						<td>Nro Matricula </td>
						<td>Direccion</td>
						<td>Telefono</td>
						<td>Email</td>
						<td>O.Sociales</td>
						<td>Especialidades</td>
						<td>Dni</td>
						<td>F.Nac</td>
						<td><b>Activo</b>
						<?php

							if($ojito == 1){
								echo "<a href='GestionMedicos.php?ojito=0'><i class='icon-eye-close' style='margin-left: 3px; margin-top: 3px;'></i></a>"; 
							} else {
								echo "<a href='GestionMedicos.php?ojito=1'><i class='icon-eye-open' style='margin-left: 3px; margin-top: 3px;'></i></a>";
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
						<td><?php echo $valor["nrolicencia"]; ?></td>
						<td><?php echo $valor["direccion"]; ?></td>
						<td><?php echo $valor["telefono"]; ?></td>
						<td><?php echo $valor["email"]; ?></td>
						<td><?php
						
						
						$query= "SELECT  * from med_obrasocial 
	                             inner join obrasociales on obrasociales.idobra=med_obrasocial.idobra 
								 where nrolicencia ='" .$valor["nrolicencia"]. "'";

						
						$res = mysql_query($query);
						while ($obra=mysql_fetch_array($res)) {
						echo "&nbsp;".$obra["nombre"]."";
						}
						
						
						?>
						


						</td>
						
						
						<td><?php
						
						
						$query= "SELECT  * from med_esp 
	                             inner join especialidades on especialidades.idespecialidad=med_esp.idespecialidad 
								 where nrolicencia ='" .$valor["nrolicencia"]. "'";

						
						$res = mysql_query($query);
						while ($esp=mysql_fetch_array($res)) {
						echo "&nbsp;".$esp["nombre"]."";
						}
						
						
						?>
						


						</td>

						
						
						<td><?php echo $valor["dni"]; ?></td>
						<td><?php echo $valor["fechaNac"]; ?></td>
						<?php 
							$nrolicencia = $valor['nrolicencia'];
							
							if( $valor["activo"] == 1 ){
								echo "<td>  Si </td>";
								echo "<td><button class='btn btn-warning' type='button'><a href='BorrarMedico.php?nrolicencia=".$nrolicencia."'>Borrar </a></button> </td>";
							}     
						    else {
							    echo "<td>No</td>";
								echo "<td><button class='btn btn-success' type='button'><a href='HabilitarMedico.php?nrolicencia=".$nrolicencia."'>Habilitar </a></button> </td>";
							}  
						?>
						
						<td><button class="btn btn-danger" onclick="location.href='Medicos.php?nrolicencia=<?php echo $nrolicencia; ?> '" type="button">Modif</button> </td>

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
						<button class="btn btn-primary"type="button" onclick="javascript:history.go(-1)"> Atras </button>
						<button class="btn btn-inverse" type="button" onclick="window.close();"> Salir </button>
					</div>
				</li>
			</ul>

		</div>      <!-- FIN DIV CONTENDOR -->


	</div>  <!-- FIN ENCAPSULADOR-->





</body>
</html>

  
  