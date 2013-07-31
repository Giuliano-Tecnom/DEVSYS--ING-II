<?php
	
	if (!isset($_REQUEST['ojito'])) {
		$ojito=1;
	} else {
		$ojito=$_REQUEST['ojito'];
	}
	
	include_once('mysqlconnect.php');


if(isset($_POST['filtro'])){
    
    $filtro = $_POST['filtro'];
    $criterio = "";

    if(isset($_POST['nom'])){
    	$nombre = $_POST['nom'];
    	if($nombre != ""){
    		$criterio.="  and p.nombre LIKE '".$nombre."%'  ";
    	}
    }

    if(isset($_POST['ape'])){
    	$apellido = $_POST['ape'];
    	if($apellido != ""){
    		$criterio.="  and p.apellido LIKE '".$apellido."%' ";
    	}
    }

    if(isset($_POST['dni'])){
    	$dni = $_POST['dni'];
    	if($dni != ""){
    		$criterio.="  and p.dni = ".$dni."  ";
    	}
    }

    if(isset($_POST['obraSocial'])){
    	$obra = $_POST['obraSocial'];
    	if($obra > 0){
    		$criterio.="  and po.idobra = ".$obra."  ";
    	}
    }



 	$consulta = "SELECT DISTINCT * FROM pacientes as p
 				 INNER JOIN pac_obrasocial as po on p.idpaciente = po.idpaciente
 				 WHERE (p.activo = ".$ojito." OR 0 = ".$ojito.") " .$criterio. " 
 				 GROUP BY p.dni";
     
	$resultado = mysql_query($consulta);


}else{
 
 	$consulta = "SELECT * FROM pacientes WHERE (pacientes.activo = ".$ojito." OR 0 = ".$ojito.") ";
     
	$resultado = mysql_query($consulta);

}


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
 	
	<?php include_once('header.php'); ?>
	
	<div class="encapsulador">

		<div class="contenedor">
			
			<ul class="breadcrumb">
				<li> 
					<h5>Gestion de Pacientes<a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
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
					if($_GET['Correcto'] == 3){
						echo"<div class='alert alert-success'>
							<h4>Exito!</h4>
							El paciente se modifico correctamente.
							</div>";
					}
				}
				
				if(isset($_GET['Error'])){
					if($_GET['Error'] == 1){
					echo"<div class='alert alert-error'>
						<h4>Error!! </h4>
						</div>";
					}
					
					if($_GET['Error'] == 2) {
					echo"<div class='alert alert-error'>
						<h4>Error!! </h4>
	
						</div>";
					}
					
					if($_GET['Error'] == 3) {
					echo"<div class='alert alert-error'>
						<h4>Aviso!</h4>
						No se puede dar de baja el paciente ya que tiene un turno asignado.
						</div>";
					}
				}
				
			?>
			

			
			<div id="form-gestion-pacientes"> 
		  
				<form class="form-horizontal" method="POST" action="GestionPacientes.php?ojito=<?php echo $ojito; ?>" enctype="multipart/form-data" >
					<input type="hidden" name="filtro" id="filtro" value="S">
					<div style="margin-top: 60px;">

						<div class="control-group">
							<input name="nom" id="nom" type="text" placeholder="Buscar por nombre..">
						</div>
						<div class="control-group">
							<input name="ape" id="ape" type="text" placeholder="Buscar por apellido..">
						</div>
						<div class="control-group">
							<input name="dni" id="dni" type="text" placeholder="Buscar por DNI..">
						</div> 

					</div>
					<div style="margin-top: -145px; margin-left: 225px;">

						<?php
							$consultaObras = "SELECT * FROM obraSociales WHERE activo = 1";
							$resObras = mysql_query($consultaObras);
						?>

						<label>Obra Social:</label>
						<select id="obraSocial" name="obraSocial">
							<option value=0>Todas</option>
							<?php
								while ($valor = mysql_fetch_array($resObras)) {
									if ($obraSocial == $valor["idobra"]) {
										$sel= " SELECTED ";
									}else{
										$sel= "";
									}
							?>
									<option value="<?php echo $valor["idobra"];?>"<?php echo $sel;?>><?php echo $valor["nombre"]; ?></option>
							<?php	  
								}
							?>
						</select>

					</div>

					<div style="margin-top: 80px;">
						<button class="btn btn-success" type="submit">Filtrar</button>
					</div>
					
				</form>
			</div>
			
			<div id="tabla-gestion-pacientes">

				<!-- COMIENZA BARRA DE OPCIONES -->
				<div class="btn-group" style="margin-top: -13px; margin-left: 270;">

				        <button class="btn btn-info" type="button" onclick="location.href='AltaPacientes.php'">Paciente Nuevo</button>
	                    
	                   
					    <!-- HABILITA O DESHABILITA EL BOTON REPORTES DEPENDIENDO SI ES ADMIN O NO!!!! -->
	                    <?php
	                    if ($_SESSION['tipo'] != "administrador") {
	                    ?>
	                    	 <button class="btn btn-info" type="button" disabled>Generar Reporte</button>
					   	<?php
					   	}else{
					   	?>
					   		 <button class="btn btn-info" type="button" onclick="location.href='ReportePacientes.php?ojito=<?php echo $ojito ?>'">Generar Reporte</button>
					   	<?php
					   	}
					   	?>


					    <button class="btn btn-info" type="button"
						<?php	if($ojito == 1){ ?>
									onclick="location.href='GestionPacientes.php?ojito=0'"> Mostrar Inactivos <i class="icon-eye-close" style="margin-left: 3px;"></i>
						<?php	} else { ?>			
									onclick="location.href='GestionPacientes.php?ojito=1'"> Ocultar Inactivos <i class="icon-eye-open" style="margin-left: 3px;"></i>
						<?php	} ?>
						</button>
				</div>
				<br></br>
				<br></br>
				<!-- FIN BARRA DE OPCIONES -->
			
			

				<table class="table table-striped">
					<tr>
						<td><b>Apellido y Nombre</b></td>
						<td><b>Dni</b></td>
						<td><b>Obras Sociales</b></td>
						<td><b>Datos Personales</b></td>
						<td></td>
						<td></td>
					</tr>
					<?php
				while ($valor = mysql_fetch_array($resultado))
				{
				?>
					<tr>
						<td><?php echo $valor["apellido"]; ?> <?php echo $valor["nombre"]; ?></td>
						<td><?php echo $valor["dni"]; ?></td>
						
						<?php
						$idpaciente = $valor['idpaciente']; //¡Ojo tocando esta variable, se usa en varios lados durante la iteracion del while!.
						$consultaObras= "SELECT  o.nombre										 
										 FROM pac_obrasocial as po
										 INNER join obrasociales as o ON o.idobra= po.idobra
										 INNER join pacientes as p ON p.idpaciente = po.idpaciente
										 where po.idpaciente ='" .$valor["idpaciente"]. "'";
						$resultadoConsultaObras = mysql_query($consultaObras);
						?>
						<td><a data-toggle="modal" role="button" href="#obrasSocialesPaciente<?php echo $idpaciente; ?>" class="btn">Ver</a></td>
						<!-- MODAL DE VER OBRAS SOCIALES -->
						<div id="obrasSocialesPaciente<?php echo $idpaciente; ?>" class="modal hide fade in" style="display: none; ">
							<div class="modal-body">
								<center><h3>Obras Sociales del Paciente</h4></center>	
								<ul>
								<?php 
								if (mysql_num_rows($resultadoConsultaObras) > 0) {
									while ($obra = mysql_fetch_array($resultadoConsultaObras)) { ?>
										<li><?php echo $obra['nombre'] ?></li>
							<?php	}
								} else {
									?>
										<li><?php echo 'No se registran obras sociales asignadas al paciente.' ?></li>
									<?php 
								}
									?>
								</ul> 
							</div>
							<div class="modal-footer">
								<a href="#" class="btn" data-dismiss="modal">Volver</a>
							</div>
						</div>

						<?php
						$consultaDatos= "SELECT email, fechaNac, direccion, telefono
										 FROM pacientes
										 WHERE idpaciente ='" .$valor["idpaciente"]. "'";
						$resultadoConsultaDatos = mysql_query($consultaDatos);
						?>
						<td><a data-toggle="modal" role="button" href="#datosPersonalesPaciente<?php echo $idpaciente; ?>" class="btn">Ver</a></td>
						<!-- MODAL DE VER OBRAS SOCIALES -->
						<div id="datosPersonalesPaciente<?php echo $idpaciente; ?>" class="modal hide fade in" style="display: none; ">
							<div class="modal-body">
								<center><h3>Datos Personales del Paciente</h4></center>	
								<ul>
								<?php 
								if (mysql_num_rows($resultadoConsultaDatos) > 0) {
									while ($datos = mysql_fetch_array($resultadoConsultaDatos)) { ?>
										<li><b>Direccion:</b> <?php echo $datos['direccion'] ?></li>
										<li><b>Telefono:</b> <?php echo $datos['telefono'] ?></li>
										<li><b>Email:</b> <?php echo $datos['email'] ?></li>
										<li><b>Fecha de Nacimiento:</b> <?php echo $datos['fechaNac'] ?></li>
							<?php	}
								} else {
									?>
										<li><?php echo 'No se registran Datos Personales asignados al paciente.' ?></li>
									<?php 
								}
									?>
								</ul> 
							</div>
							<div class="modal-footer">
								<a href="#" class="btn" data-dismiss="modal">Volver</a>
							</div>
						</div>

						<?php 
							
								if( $valor["activo"] == 1 ){
						?>	
									<td><a data-toggle="modal" role="button" href="#borrar<?php echo $idpaciente; ?>" class="btn btn-danger">Borrar</a></td>
									<!-- MODAL DE BORRAR -->
									<div id="borrar<?php echo $idpaciente; ?>" class="modal hide fade in" style="display: none; ">
										<div class="modal-body">
											<h4>Aviso</h4>	      
											<p> Esta seguro que desea dar de baja el paciente? </p>
										</div>
										<div class="modal-footer">
											<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
											<a class="btn btn-warning"  href="BorrarPaciente.php?idpaciente=<?php echo $idpaciente; ?>">Aceptar</a>
										</div>
									</div>
									
									
						<?php	}else{ ?>
									<td><button class="btn btn-success" type="button" onclick="location.href='HabilitarPaciente.php?idpaciente=<?php echo $idpaciente; ?> '">Habilitar</button></td>
						<?php	}  	?>
						
						<td><button class="btn btn-warning" onclick="location.href='CargaPaciente.php?idpaciente=<?php echo $idpaciente; ?> '" type="button">Modificar</button> </td>

					</tr>
				<?php
				}
				?>	
				</table>
			</div>

					
		</div>      <!-- FIN DIV CONTENDOR -->


	</div>  <!-- FIN ENCAPSULADOR-->





</body>
</html>


 
  