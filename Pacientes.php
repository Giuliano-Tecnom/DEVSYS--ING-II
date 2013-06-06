<?php
	
	
	include_once('mysqlconnect.php');
	

	
	
?>
	


<head>
<meta charset="UTF-8">
<title>ClinicSystem - Pacientes</title>

<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>

<!--JQuery-->
<script src='js/jquery.min.js'></script>
<script src='js/validarModificarPaciente.js'></script>

</head>
    <!-- Fin de HEAD-->
	
<body style="background-image:url('images/bg.png')">
 
	<?php include_once('header.php'); ?>
	
	<div class="encapsulador">



		<div class="contenedor">
			
			<ul class="breadcrumb">
				<li> 
					<h5>Modificacion de Pacientes <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
														 <!-- ICONO DE AYUDA -->  
				</li>
			</ul>
            <?php
            if(isset($_GET['Error'])){
					if($_GET['Error'] == 1) {
						echo	"<div class='alert alert-error'>
									<h4>Error!! </h4>
								No se puede agregar el paciente, ya existe uno con ese dni.
								</div>";
					}
				}
			
			?>
			<?php

	
				if(isset($_GET['idpaciente'])){
					$consulta = "SELECT * FROM pacientes WHERE idpaciente = ".$_GET['idpaciente']."";
					$resultado = mysql_query($consulta);
					$datospaciente = mysql_fetch_array($resultado);
				
			
		   ?>
			<div id="form-modificacion-pacientes"> 
		   
				<form class="form-horizontal" method="POST" action="ModificarPaciente.php" enctype="multipart/form-data" > 
					
					<input name="idpaciente" type="hidden" maxlength="50" value="<?php echo $datospaciente['idpaciente'];?>">
					
					<div class="control-group">
						<input class="nomm" name="nom" type="text" maxlength="50" placeholder="Nombre.." value="<?php echo $datospaciente['nombre'];?>">
					</div>
					<div class="control-group">
						<input class="apee" name="ape" type="text" maxlength="50" placeholder="Apellido.." value="<?php echo $datospaciente['apellido'];?>">
					</div>
					<div class="control-group">
						<input class="dnii" name="dni" type="text" maxlength="9" placeholder="DNI.." value="<?php echo $datospaciente['dni'];?>">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Sin puntos, Ej: 36789456</span>
					</div>
					<div class="control-group">
						<input class="emaill" name="email" type="text" maxlength="35" placeholder="Email.." value="<?php echo $datospaciente['email'];?>">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ej: aaa@gmail.com</span>
					</div>
					<div class="control-group">
						<input class="tell" name="tel" type="text" maxlength="25" placeholder="Telefono.." value="<?php echo $datospaciente['telefono'];?>">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Sin parentesis, ni espacios Ej: 02214567800</span>
					</div>
					<div class="control-group">
						<input class="dirr" name="dir" type="text" maxlength="150" placeholder="Direccion.." value="<?php echo $datospaciente['direccion'];?>">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ej: 60 N 1009</span>
					</div>
					<div class="control-group">
						<input class="fecnacc" name="fecnac" type="date" min="1900-01-01" max="2013-06-01" placeholder="Fecha de Nacimiento.." value="<?php echo $datospaciente['fechaNac'];?>">
						<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ingrese DD/MM/AAAA</span>
					</div>
					<div style="margin-left: 300px;margin-top: -285px;">
						<label>Obra Social</label>
						<select multiple="multiple" id="obra" name="obra[]">
						<?php
							$consulta = "SELECT o.nombre, 
												o.idobra 
										 FROM pac_obrasocial as po
							             INNER JOIN obrasociales as o on o.idobra = po.idobra
										 INNER JOIN pacientes as p on p.dni = po.dni
										 WHERE  p.idpaciente=".$_GET['idpaciente']." ";
							$resultado = mysql_query($consulta);
						
							while ($valor = mysql_fetch_array($resultado)) {
						?>
								<option selected="selected" value="<?php echo $valor["idobra"];?>"><?php echo $valor["nombre"]; ?></option>
						<?php	  
							}
						
							$consulta = "SELECT o.nombre, o.idobra  
										 FROM obrasociales as o
                                         WHERE o.nombre not in   (SELECT o.nombre
																  FROM pac_obrasocial as po
																  INNER JOIN obrasociales as o
																  ON o.idobra = po.idobra
																  INNER JOIN pacientes as p
																  ON p.dni = po.dni
																  WHERE p.idpaciente=".$_GET['idpaciente'].")";
							$resultado = mysql_query($consulta);
						
							while ($valor = mysql_fetch_array($resultado)) {
						?>
								<option value="<?php echo $valor["idobra"];?>"><?php echo $valor["nombre"]; ?></option>
						<?php	  
							}
						?>

						</select>
						<span class="help-block" style="font-size: 9px;"> Para una Seleccion multiple: Ctrl + Click Izq.</span>
					</div>
					<div style="margin-left: 550px;margin-top: -77px;">
						<button class="btn btn-mini" type="button" onclick="location.href='GestionObras.php'">Editar</button>
					</div>
					<div style="margin-left:300px;margin-top: 90px;">
						<button class="btnsubmit btn-success" type="submit">Modificar</button>
						<button class="btn btn-danger" type="button" onclick="location.href='GestionPacientes.php' ">Cancelar </button>
					</div>
					<span class="help-block" style="margin-left: 300px;font-size: 9px;"> Todos los campos son obligatorios, salvo el Email.</span>
					
					
					
				</form>
			</div>
			<?php
				}
			?>
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