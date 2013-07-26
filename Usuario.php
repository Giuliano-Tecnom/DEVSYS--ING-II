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

	$idusuario = $_GET['idusuario'];

	$consulta = "SELECT * FROM usuarios WHERE idusuario = ".$idusuario." ";
	$res = mysql_query($consulta);
	
	include_once('header.php'); 

	?>
	
	
	

	<div class="encapsulador">

		<div class="contenedor">

			<ul class="breadcrumb">
				<li> 
					<h5>Modificacion de Usuario <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
																					<!-- ICONO DE AYUDA -->  
				</li>
			</ul>   <!-- Fin del titulo de pagina-->





			<div id="form-modificacion-usuarios"> 
			   
				<form class="form-horizontal" method="POST" action="modificarUsuario.php" enctype="multipart/form-data" >
			  		
			  		<?php
			  		while($valor = mysql_fetch_array($res)) {
			  		?>
				  		<div style="">
				  			<input type="hidden" value="<?php echo $valor['idusuario'] ?>" name="idusuario">
							<div class="control-group" >
								<input class="namee" name="nombre" type="text" maxlength="50" placeholder="Nombre.." value="<?php echo $valor['nombre'] ?>">
								<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ingrese Nombre.</span>
							</div>
							<div class="control-group">
								<input class="apellidoo" name="apellido" type="text" maxlength="50" placeholder="Apellido.." value="<?php echo $valor['apellido'] ?>">
								<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Ingrese Apellido.</span>
							</div>
							<div class="control-group">
								<input class="usuarioo" name="usuario" type="text" maxlength="16" placeholder="Usuario.." value="<?php echo $valor['usuario'] ?>">
								<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Usuario: no mayor a 16 caracteres.</span>
							</div>
							<div class="control-group">
								<input class="passwordd" name="password" type="text" maxlength="16" placeholder="Contraseña.." value="<?php echo $valor['password'] ?>">
								<span class="help-block" style= "margin-left: 10px; margin-top: 0px; font-size: 10px;margin-bottom: -20px;">Contraseña: debe ser entre 5 y 16 caracteres..</span>
							</div>	
							<select name="tipo" class="tipoo">
	  						<?php
	  						if ( $valor['tipo'] == "administrador") {
	  						?>
	  							<option value="administrador">Administrador</option>	
	  							<option value="usuario">Usuario Comun</option>
	  						<?php
	  						}else{
	  						?>
	  							<option value="usuario">Usuario Comun</option>
	  							<option value="administrador">Administrador</option>
	  						<?php
	  						}
	  						?>
							</select>
						</div>

						<div style="margin-left: 30px;margin-top: 35px;">
							
									
								<a data-toggle="modal" role="button" href="#modificar" class="btnsubmit btn-success">Modificar</a>
								<!-- MODAL DE Modificar -->
									<div id="modificar" class="modal hide fade in" style="display: none; ">
										<div class="modal-body">
											<h4>Aviso</h4>	      
											<p> Esta seguro que desea Modificar al Usuario <b><?php echo $valor['usuario'] ?></b> </p>
										</div>
										<div class="modal-footer">
											<a href="#" class="btn" data-dismiss="modal">No</a>
											<button class="btn btn-success" type="submit" onclick="location.href='modificarUsuario.php'">Si</button>
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
											<a class="btn btn-danger"  href="GestionUsuarios.php">Si</a>
										</div>
									</div>
								<span class="help-block" style="margin-left: 10px; font-size: 9px;"> Todos los campos son obligatorios.</span>	
						</div>
					<?php
					}   // FIN DEL WHILEEEEEEEEE
					?>
						
				</form>

			</div>

		</div>

	</div>  <!-- FIN ENCAPSULADOR-->
	
	
</body>
</html>
