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

			<form class="form-horizontal" style="margin-top: 20px;" action="func/logeo.php" method="post">
				<div class="control-group">
					<label class="control-label" for="inputEmail">Usuario</label>
					<div class="controls">
						<input type="text" id="inputUser" placeholder="Usuario">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">Contraseña</label>
					<div class="controls">
						<input type="password" id="inputPassword" placeholder="Contraseña">
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn">Iniciar Sesión</button>
					</div>
				</div>
			</form>
		</div>
		<!-- BOTON DE SALIR-->
		<ul class="breadcrumb" style="margin-top: 100px;">
			<li> 
				<div style="margin-left: 800px;">
					<button class="btn btn-inverse" type="button"> Salir </button>
				</div>
			</li>
		</ul>
		
	</div>  <!-- FIN ENCAPSULADOR-->
	
</body>
</html>

	
	

   
 

