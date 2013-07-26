<!doctype html>  


<head>
<meta charset="UTF-8">
<title>ClinicSystem - Usuarios</title>

<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>

</head>
    
<body style="background-image:url('images/bg.png')">
<!--JQuery-->
<script src='js/jquery.min.js'></script>
<script src='js/validarFormularioUsuario.js'></script>

	<?php
	
	include_once('mysqlconnect.php');
	
	include_once('header.php'); 

	?>
	
	
	

	<div class="encapsulador">

		<div class="contenedor">

			<ul class="breadcrumb">
				<li> 
					<h5>Alta de Usuario <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
																					<!-- ICONO DE AYUDA -->  
				</li>
			</ul>   <!-- Fin del titulo de pagina-->

			<?php
			if(isset($_GET['Correcto'])){
					if($_GET['Correcto'] == 1){
					echo"<div class='alert alert-success'>
						<h4>Se agrego al Usuario Correctamente!!</h4>
						</div>";
					}	
			}
			if(isset($_GET['Error'])){
					if($_GET['Error'] == 1){
					echo"<div class='alert alert-error'>
						<h4>Usuario existente!!.. </h4>
						Por favor, ingrese un usuario diferente.
						</div>";
					}	
			}
			?>

			<div id="form-alta-usuarios"> 
			   
				<form class="form-horizontal" method="POST" action="altaUsuario.php" enctype="multipart/form-data" >
			  		
			  		<div style="">
						<div class="control-group" >
							<input class="namee" name="nombre" type="text" maxlength="50" placeholder="Nombre..">
							<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ingrese Nombre.</span>
						</div>
						<div class="control-group">
							<input class="apellidoo" name="apellido" type="text" maxlength="50" placeholder="Apellido..">
							<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ingrese Apellido.</span>
						</div>
						<div class="control-group">
							<input class="usuarioo" name="usuario" type="text" maxlength="16" placeholder="Usuario..">
							<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Usuario: no mayor a 16 caracteres.</span>
						</div>
						<div class="control-group">
							<input class="passwordd" name="password" type="password" maxlength="16" placeholder="Contraseña..">
							<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Contraseña: debe ser entre 5 y 16 caracteres, solo letras y num.</span>
						</div>	
						<select name="tipo" class="tipoo">
  							<option value="usuario">Usuario Comun</option>
  							<option value="administrador">Administrador</option>	
						</select>
					</div>
					<div style="margin-left: 30px;margin-top: 35px;">
						
								
							<a data-toggle="modal" role="button" href="#agregar" class="btnsubmit btn-success">Agregar</a>
							<!-- MODAL DE AGREGAR -->
								<div id="agregar" class="modal hide fade in" style="display: none; ">
									<div class="modal-body">
										<h4>Aviso</h4>	      
										<p> Esta seguro que desea Agregar al Usuario nuevo? </p>
									</div>
									<div class="modal-footer">
										<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
										<button class="btn btn-success" type="submit" onclick="location.href='altaUsuario.php'">Aceptar</button>
									</div>
								</div>
								
							<a data-toggle="modal" role="button" href="#cancelar" class="btn btn-danger">Cancelar</a>
								<!-- MODAL DE CANCELAR -->
								<div id="cancelar" class="modal hide fade in" style="display: none; ">
									<div class="modal-body">
										<h4>Aviso</h4>	      
										<p> Esta seguro que desea Cancelar? </p>
									</div>
									<div class="modal-footer">
										<a href="#" class="btn" data-dismiss="modal">No</a>
										<a class="btn btn-danger"  href="index.php">Si</a>
									</div>
								</div>
							<span class="help-block" style="margin-left: 10px; font-size: 9px;"> Todos los campos son obligatorios.</span>	
					</div>
					
						
				</form>

			</div>

		</div>

	</div>  <!-- FIN ENCAPSULADOR-->
	
	
</body>
</html>
