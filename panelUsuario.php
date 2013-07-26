<?php if (!isset ($x)) { ?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap-modal.js"></script>		
		<?php } ?>
	<!--	
	<div class="panelUsuario">
		Bienvenido a ClinicSystem, <?php echo $_SESSION['usuario']?>.
		<button class="btn btn-mini" onclick="location.href='AdmUsuarios.php'" type="button">Administracion de Usuarios</button>
		<button class="btn btn-inverse btn-mini" onclick="location.href='cerrarSesion.php'" type="button">Cerrar Sesion</button> 
	</div>
-->
	<?php

	$usuario = $_SESSION['usuario'];

	$usuario = strtoupper($usuario);

	?>


	<div class="panelUsuario">
		<div class="navbar">
		  <div class="navbar-inner">
		    <a class="brand" href="#">Bienvenido a ClinicSystem, <div style="color: #00CCFF; margin-left: 238px; margin-top: -20px;"> <?php echo $usuario ?>  </div> </a>
		    <ul class="nav" style="float: right;">
		      	
		      	<!-- HABILITA O DESHABILITA EL BOTON REPORTES DEPENDIENDO SI ES ADMIN O NO!!!! -->
                <?php
                if ($_SESSION['tipo'] == "administrador") {
                ?>
		      		<li><a href="agregarUsuarios.php">Agregar Usuarios</a></li>
		      		<li><a href="GestionUsuarios.php">Gestion de Usuarios</a></li>
				<?php
				}
				?>

		      <li><a href="cerrarSesion.php"><b>Cerrar Sesion</b></a></li>
		    </ul>
		  </div>
		</div>
	</div>



                    	