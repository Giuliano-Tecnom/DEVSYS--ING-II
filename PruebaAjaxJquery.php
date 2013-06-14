<!doctype html>  
<head>
<meta charset="UTF-8">
<title>ClinicSystem - Turnos</title>

<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>
<script type="text/javascript" src="./js/jquery.js"></script>


</head>
<script>

function realizaProceso(valorSelect){
var parametros = {
                "valorSelect" : valorSelect,
        };
        $.ajax({
                data:  parametros,
                url:   'PruebaAjaxJqueryInclude.php', 
                type:  'post',
				beforeSend: function () {   //Antes de enviar.

                        $("#resultado").html("Procesando, espere por favor...");

                },
                success:  function (response) {  //Si se ejecuta correctamente.

                        $("#resultado").html(response);

                }

        });

}

</script>
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
							<td><a href="#"><button class="btn btn-large" type="button">Pacientes</button></a></td>
							<td><a href="#"><button class="btn btn-large" type="button">Medicos</button></a></td>
							<td><a href="#"><button class="btn btn-large  btn-info" type="button">Turnos</button></a></td>
						</tr>
					</table>
				</div>
			</td>
			</tr>
		</table>	<!-- Fin de Menú-->

		<div class="contenedor">	
			
			<ul class="breadcrumb">
				<li> 
					<h5>Gestion de Turnos<a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
														 <!-- ICONO DE AYUDA -->  
				</li>
			</ul>
		  
			
			    <label><b>Medicos</b></label>
				<form>
				   <select name="users" onchange="realizaProceso(this.value)">
                   <option value="1">Orlando Piazzesi</option>
				   <option value="2">Lois Griffin</option>
				   <option value="3">Glenn Quagmire</option>
				   <option value="4">Joseph Swanson</option>
                  </select>
				</form>

			 
			<span id="resultado"></span>

			<!-- BOTON DE SALIR y REPORTE-->
			

		
	
	</div>  <!-- FIN ENCAPSULADOR-->

</body>
</html>

  
  
  
  
