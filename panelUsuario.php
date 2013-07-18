<?php if (!isset ($x)) { ?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap-modal.js"></script>		
		<?php } ?>
		
	<div class="panelUsuario">
		Bienvenido a ClinicSystem, <?php echo $_SESSION['usuario']?>.
		<button class="btn btn-mini" onclick="location.href='cerrarSesion.php'" type="button">Cerrar Sesion</button> 
	</div>
