<!doctype html>  

<head>
<meta charset="UTF-8">
<title>ClinicSystem - Login</title>

<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap.min"></script>

</head>

<body style="background-image:url('images/bg.png')">
	
	<div class="encapsulador">
	
		<header style="width: 310px; margin-left: 320px;">
			<h3 style="font-size: 76px; text-align: center;margin-top: 140px; color: #00CCFF;">CLIMED</h3>    
		</header>

		<div id="form-logeo">


		<?php
			if(isset($_GET['Error'])){
				if( $_GET['Error'] == 1 ){
					echo "  <div class='alert alert-error' style='margin-left: 10px; margin-right: 10px;'>
							<h4>Ingrese un Usuario y Contraseña Correctos.</h4>
							</div> ";
				}	
			}


			// INICIO DE CONTROL DE LOGEO!!!!!!!!!!!!

    		session_start();
    		if (isset($_SESSION['usuario']))
       			 header("location:index.php");
			// fin de control de logeo!!!!!!!
		?>

			<form class="form-horizontal" style="margin-top: 20px;" action="verificarCuenta.php" method="post">
				<div class="control-group">
					<label class="control-label" for="inputEmail">Usuario</label>
					<div class="controls">
						<input type="text" name="user" id="user" placeholder="Usuario">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">Contraseña</label>
					<div class="controls">
						<input type="password" name="pass" id="pass" placeholder="Contraseña">
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn">Iniciar Sesión</button>
					</div>
				</div>
			</form>
		</div>

		
	</div>  <!-- FIN ENCAPSULADOR-->
	
</body>
</html>

	
	

   
 

