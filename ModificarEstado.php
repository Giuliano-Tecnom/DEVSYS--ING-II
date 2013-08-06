 <?php
	include_once('mysqlconnect.php');

   
	
	$turnos = "SELECT medicos.nombre as nommed,medicos.apellido as apemed , e.nombre as area, pacientes.nombre as pacnom
	            ,pacientes.apellido as pacape,
                 hora.hora, ifnull(obrasociales.nombre,'Sin obra Social') as nomobra, t.fecha, t.idturno,t.estado
               	FROM turnos as t
	             inner join medicos on medicos.idmedico=t.idmedico
				 inner join pacientes on pacientes.idpaciente=t.idpaciente
				 left join obrasociales on obrasociales.idobra=t.idobra
				 inner join hora on hora.idhora=t.idhora
				 inner join especialidades as e on t.idespecialidad = e.idespecialidad
				 WHERE t.idturno = ".$_GET['idturno'].";
				 ";
	$restur = mysql_query($turnos);
	
	
	$consultaIdMedico = "SELECT m.idmedico 
						 FROM medicos as m
						 INNER JOIN turnos as t
						 ON m.idmedico = t.idmedico
						 where t.idturno = ".$_GET['idturno'].";";
	$rescidm = mysql_query($consultaIdMedico);
	$idm;
	while ($idmedicoinactivo = mysql_fetch_array($rescidm)) {
		$idm = $idmedicoinactivo['idmedico'];
	}
	if ($idm != '') {
	
	
		$consultaMedicoInactivo = "SELECT m.activo
									FROM medicos as m
									WHERE m.idmedico = ".$idm."
									AND m.activo = 0;";
		$resMedicoInactivo = mysql_query($consultaMedicoInactivo);

		if (( mysql_num_rows($resMedicoInactivo) != 0)) {
			Header ("Location: GestionTurnos.php?Error=6");
		}
	}
	
	

	

?>




<head>

	<meta charset="UTF-8">
	<title>ClinicSystem - Turnos</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>
	<!-- Scripts para búsqueda y filtro-->
<script type="text/javascript" src="sh/shCore.js"></script>
<script type="text/javascript" src="sh/shBrushJScript.js"></script>
<script type="text/javascript" src="./sh/jquery.min.js"></script> 
<script type="text/javascript" src="./sh/jquery.searchabledropdown-1.0.8.min.js"></script>

	<!-- Scripts para búsqueda y filtro-->
	<script type="text/javascript">
		$(document).ready(function() {
			$("select").searchable();
		});
	
	
		// demo functions
		$(document).ready(function() {
			$("#value").html($("#myselect :selected").text() + " (VALUE: " + $("#myselect").val() + ")");
			$("select").change(function(){
				$("#value").html(this.options[this.selectedIndex].text + " (VALUE: " + this.value + ")");
			});
		});
	
		function modifySelect() {
			$("select").get(0).selectedIndex = 5;
		}
	
		function appendSelectOption(str) {
			$("select").append("<option value=\"" + str + "\">" + str + "</option>");
		}
	
		function applyOptions() {			  
			$("select").searchable({
				maxListSize: $("#maxListSize").val(),
				maxMultiMatch: $("#maxMultiMatch").val(),
				latency: $("#latency").val(),
				exactMatch: $("#exactMatch").get(0).checked,
				wildcards: $("#wildcards").get(0).checked,
				ignoreCase: $("#ignoreCase").get(0).checked
			});
	
			alert(
				"OPTIONS\n---------------------------\n" + 
				"maxListSize: " + $("#maxListSize").val() + "\n" +
				"maxMultiMatch: " + $("#maxMultiMatch").val() + "\n" +
				"exactMatch: " + $("#exactMatch").get(0).checked + "\n"+
				"wildcards: " + $("#wildcards").get(0).checked + "\n" +
				"ignoreCase: " + $("#ignoreCase").get(0).checked + "\n" +
				"latency: " + $("#latency").val()
			);
		}
	</script>
</head>
		
<body style="background-image:url('images/bg.png')">
	

	 
 	<?php include_once('header.php'); ?>

	
	<div class="encapsulador">
		<div class="contenedor">
			
			<ul class="breadcrumb">
				<li> 
					<h5>Modificar Estado del Turno <a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
														 <!-- ICONO DE AYUDA -->  
				</li>
			</ul>
			
	
		   <div id="form-turno"> 
			   <form class="form-horizontal" name="filtro" method="POST" action="UpdateEstado.php" enctype="multipart/form-data" > 
			  		<?php while ($turno = mysql_fetch_array($restur)) { ?>		
					<div class="control-group">
						<label> <b>Nro. Turno:</b><?php echo $turno['idturno'];?> </label>
						<input type="hidden" id="idturno" name="idturno" value="<?php echo $turno['idturno'];?>">
						
					</div>	  		

			  		<div class="control-group">
						<label> <b> Medico:  </b><?php echo $turno['nommed'];?> <?php echo $turno['apemed']; ?></label>
						<input type="hidden" id="idmedico" name="idmedico" value="">
					</div>

					<div class="control-group">
						<label>  <b>Area: </b><?php echo $turno['area'];  ?></label>
						<input type="hidden" id="area" name="area" value="">
					</div>
					
					<div class="control-group">
						<label>  <b>Paciente: </b> <?php echo $turno['pacnom'];?> <?php echo $turno['pacape'];?> </label>
						<input type="hidden" id="paciente" name="paciente" value="">
					</div>
					
					<div class="control-group">
						<label> <b> Obra Social: </b> <?php echo $turno['nomobra'];?> </label>
						<input type="hidden" id="obra" name="obra" value="">
					</div>
					<div class="control-group">
						<label>  <b>Fecha:  </b><?php echo $turno['fecha'];?> </label>
						<input type="hidden" id="fecha" name="fecha" value="">
					</div>
					<div class="control-group">
						<label>  <b>Hora: </b> <?php echo $turno['hora'];?> </label>
						<input type="hidden" id="hora" name="hora" value="">
					</div>
					<div class="control-group">
						<label>  <b>Estado:  </b> </label>
						<select  id="estado" name="estado">
							<option  value="en espera">En espera</option>
						     <option  value="cancelado">Cancelado</option>
							 <option  value="ausente">Ausente</option>
							 <option  value="realizado">Realizado</option>
						</select>
					</div>
				
         
							
					<a data-toggle="modal" role="button" href="#modificar" class="btnsubmit btn-success">Modificar</a>
						<!-- MODAL DE AGREGAR -->
							<div id="modificar" class="modal hide fade in" style="display: none; ">
								<div class="modal-body">
									<h4>Aviso</h4>	      
									<p> Esta seguro que desea modificar el estado del turno? </p>
								</div>
								<div class="modal-footer">
									<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
									<button class="btn btn-success" type="submit" onclick="location.href='UpdateEstado.php'">Aceptar</button>
								</div>
							</div>
			</form>				
	<?php } ?>	

		</div>	
	</div>  <!-- FIN ENCAPSULADOR-->

</body>
</html>


