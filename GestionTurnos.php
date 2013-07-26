
<?php
// CONFIGURACION DE HORA Y FECHA PARA CONSULTAS!!!...



date_default_timezone_set('America/Argentina/Buenos_Aires');
setlocale(LC_TIME, 'spanish');
$time = strftime("%H:%M");
 			
$date = date("Y-m-d");

 
//FIN DE CONFIGURACION DE HORA Y FECHA!!!..

include_once('mysqlconnect.php');
$consulta_maxFec="SELECT MAX(t.fecha) as fechamax FROM turnos as t";
$query_maxFec = mysql_query($consulta_maxFec);
while ($valor = mysql_fetch_array($query_maxFec)){
	$maxFec= $valor['fechamax'];

}
$consulta_minFec="SELECT MIN(t.fecha) as fechamin FROM turnos as t";
$query_minFec = mysql_query($consulta_minFec);
while($valor = mysql_fetch_array($query_minFec)){
	$minFec= $valor['fechamin'];

}





function diaSemana($ano,$mes,$dia)
{
	
	$dia= date("w",mktime(0, 0, 0, $mes, $dia, $ano));
		return $dia;
}


$dia=0;

$filtro='N';
if (isset($_REQUEST['filtro'])) {
$filtro = $_REQUEST['filtro'];
}
if (isset($_REQUEST['myselect1'])) {
$myselect1 = $_REQUEST['myselect1'];
}
if (isset($_REQUEST['myselect2'])) {
$myselect2 = $_REQUEST['myselect2'];
}
if (isset($_REQUEST['myselect3'])) {
$myselect3 = $_REQUEST['myselect3'];
}
if (isset($_REQUEST['myselect4'])) {
$myselect4 = $_REQUEST['myselect4'];
}
if (isset($_REQUEST['myselect5'])) {
$myselect5 = $_REQUEST['myselect5'];
}
if (isset($_REQUEST['fechaDesde'])) {
$fechaDesde = $_REQUEST['fechaDesde'];
}
if (isset($_REQUEST['fechaHasta'])) {
$fechaHasta = $_REQUEST['fechaHasta'];
}
if (isset($_REQUEST['myselect6'])) {
$myselect6 = $_REQUEST['myselect6'];
}
	include_once('mysqlconnect.php');
	
// Consulta por una busqueda filtrada
 $criterio="";
 if ($filtro=='S') {
 
 	
	$diaSemana = diaSemana($fec[2], $fec[1], $fec[0]);
	
    if ($myselect1 >0) {  $criterio.="  and pacientes.idpaciente = ".$myselect1."  ";   }	
    if ($myselect2 >0) {  $criterio.="  and medicos.idmedico = ".$myselect2." ";   }	
    if ($myselect3 >0) {  $criterio.="  and e.idespecialidad = ".$myselect3." ";   }	
    if ($myselect4 >0) {  $criterio.="  and obrasociales.idobra = ".$myselect4." ";   }	
    if ($myselect5 >0) {  
		$criterio.="  and hora.idhora = ".$myselect5." ";
		}
	if ($myselect6 != "0") {
		if($myselect6 == "espera") {
			$criterio.="  and t.estado = 'en espera' ";
		}else{
			$criterio.="  and t.estado = '".$myselect6."' ";   
		}
	}
	
	if (empty($fechaDesde)) {
		$fechaDesde = $minFec;
	}
	
	if (empty($fechaHasta)) {
		$fechaHasta = $maxFec;
	}
	$criterio.="and t.fecha between '".$fechaDesde."' and '".$fechaHasta."'";


	$consultaFinal = "SELECT medicos.nombre as nommed,medicos.apellido as apemed , e.nombre as area, pacientes.nombre as pacnom
	            ,pacientes.apellido as pacape,
                 hora.hora, obrasociales.nombre as nomobra, t.fecha, t.idturno,t.estado
               	FROM turnos as t
	             inner join medicos on medicos.idmedico=t.idmedico
				 inner join pacientes on pacientes.idpaciente=t.idpaciente
				 left join obrasociales on obrasociales.idobra=t.idobra
				 inner join hora on hora.idhora=t.idhora
				 inner join especialidades as e on t.idespecialidad = e.idespecialidad
				 WHERE 1=1  " .$criterio. "
				 ";
     
	$query_busqueda = mysql_query($consultaFinal);
  
	
	
 }else{
 
 $consultaFinal = "SELECT medicos.nombre as nommed,medicos.apellido as apemed , e.nombre as area, pacientes.nombre as pacnom
	            ,pacientes.apellido as pacape,
                 hora.hora, obrasociales.nombre as nomobra, t.fecha, t.idturno,t.estado
               	FROM turnos as t
	             inner join medicos on medicos.idmedico=t.idmedico
				 inner join pacientes on pacientes.idpaciente=t.idpaciente
				 left join obrasociales on obrasociales.idobra=t.idobra
				 inner join hora on hora.idhora=t.idhora
				 inner join especialidades as e on t.idespecialidad = e.idespecialidad
				 WHERE t.estado='en espera'
				 ORDER BY t.fecha,hora.hora
				 ";
     
	$query_busqueda = mysql_query($consultaFinal);
  
 
 
 
 
 
 }




	

	
	$consulta = "SELECT * FROM pacientes WHERE pacientes.activo = 1";
    $query_pac = mysql_query($consulta);
	
	$consulta = "SELECT * FROM medicos WHERE medicos.activo = 1";
    $query_med = mysql_query($consulta);
	
	$consulta = "SELECT * FROM obrasociales WHERE obrasociales.activo = 1";
    $query_obra = mysql_query($consulta);

	$consulta = "SELECT * FROM especialidades WHERE especialidades.activo = 1";
    $query_espec = mysql_query($consulta);

	$consulta = "SELECT idhora,hora 
				 FROM hora
				 ";
    $query_hor = mysql_query($consulta);
	
	
	
?> 
<html>
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
		<!-- Fin de HEAD-->
    
<body style="background-image:url('images/bg.png')">
 	<script src="js/bootstrap-modal.js"></script>
 	 <?php  $x=1; ?>
	<?php include_once('header.php'); ?>
	
	
	
<div class="encapsulador" style="margin-top: 75px;">
	<ul class="breadcrumb">
		<li> 
			<h5>Gestion de Turnos<a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
																				 <!-- ICONO DE AYUDA -->  
		</li>
	</ul>
	
	<?php 
	
	if(isset($_GET['Error'])){
					if( $_GET['Error'] == 5 ){
						echo "  <div class='alert alert-error' style='margin-left: 10px; margin-right: 10px;'>
								<h4>Aviso!!</h4>
								El medico con el que se desea dar el turno,en esa fecha estara de licencia.
								</div> ";
								}
					}
	
	?>
	<div id="form-turnos">
		<form name="filtro" class="form-horizontal">
			<div>
				</br><!-- ***************************** SELECT DE PACIENTES ***************************** -->
				<label>Paciente:</label>
				<select id="myselect1" name="myselect1" >
					<option value=0>Todos</option>
					<?php
						while ($valor = mysql_fetch_array($query_pac)) {
						    if ($myselect2 == $valor["idpaciente"]) {
								$sel= " SELECTED ";
							}else{
								$sel= "";
							} 
					?>
							<option value="<?php echo $valor["idpaciente"];?>"<?php echo $sel;?>><?php echo $valor["nombre"]; ?> <?php echo $valor["apellido"]; ?></option>
					<?php	  
						}
					?>
				</select>
				</br>
			
			
				</br><!-- ***************************** SELECT DE MEDICOS ***************************** -->
				<label>Medico:</label>
				<select id="myselect2" name="myselect2" >
					<option value=0>Todos</option>
					<?php
						while ($valor = mysql_fetch_array($query_med)) {
						    if ($myselect2 == $valor["idmedico"]) {
								$sel= " SELECTED ";
							}else{
								$sel= "";
							} 
					?>
							<option value="<?php echo $valor["idmedico"];?>"<?php echo $sel;?>><?php echo $valor["nombre"]; ?> <?php echo $valor["apellido"]; ?></option>
					<?php	  
						}
					?>
				</select>
				</br>
				<!-- ***************************** SELECT DE ESPECIALIDADES ***************************** -->		
				<label>Especialidad:</label>
				<select id="myselect3" name="myselect3">
					<option value=0>Cualquiera</option>
					<?php
						while ($valor = mysql_fetch_array($query_espec)) {
							if ($myselect3 == $valor["idespecialidad"]) {
								$sel= " SELECTED ";
							}else{
								$sel= "";
							}
					?>
							<option value="<?php echo $valor["idespecialidad"];?>"<?php echo $sel;?>><?php echo $valor["nombre"]; ?></option>
					<?php	  
						}
					?>
				</select>
			</div>	
			<div style="margin-left: 253px; margin-top: -256px;">
				<!-- ***************************** SELECT DE OBRAS SOCIALES ***************************** -->
				<label>Obra Social:</label>
				<select id="myselect4" name="myselect4">
					<option value=0>Todas</option>
					<?php
						while ($valor = mysql_fetch_array($query_obra)) {
							if ($myselect4 == $valor["idobra"]) {
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
				</br>
				<!-- ***************************** FECHAAAA ***************************** -->

				<label>Fecha Desde:</label>
				<input class="fechaDesde" name="fechaDesde" type="date" >
				<label>Fecha Hasta:</label>
				<input class="fechaHasta" name="fechaHasta" type="date" >
			</div>	
			<div style="margin-left: 506px; margin-top: -177px;">
			
			
			
			
			
				<!-- ***************************** SELECT DE HORA ***************************** -->
				<label>Franja Horaria:</label>
				<select id="myselect5" name="myselect5" >
					<option value=0>Todas</option>
					<?php
						while ($valor = mysql_fetch_array($query_hor)) {
							if ($myselect5 == $valor["idhora"]) {
								$sel= " SELECTED ";
								}else{
									$sel= "";
								}
								$hora=substr($valor["hora"],0,5);
								
								
					?>
							<option value="<?php echo $valor["idhora"];?>"<?php echo $sel;?>> <?php echo $hora; ?></option>
					<?php	  
						}
					?>
				</select>
					
					
				</br><!-- ***************************** SELECT DE ESTADOS ***************************** -->
				<label>Estados:</label>
				<select id="myselect6" name="myselect6" >
					<option selected value="0" >Todos</option>
					<option value="espera">En Espera</option>
					<option value="cancelado">Cancelado</option>
					<option value="realizado">Realizado</option>
					<option value="ausente">Ausente</option>
					
				</select>
				</br>
			
				<button class='btn btn-warning' style="margin-top: 110px; margin-left: -179px;" type='button' onclick='AceptarFiltro();'> Buscar </button>
			</div>
		</form>
	</div>

	<div id="tabla-medicos">
    <?php
	  	//if ($filtro == "S") {
	?>
			
			<!-- COMIENZA BARRA DE OPCIONES -->
			<div class="btn-group" style="margin-top: -13px; margin-left: 270;">
			        <button class="btn btn-info" type="button" onclick="location.href='AltaTurnos1.php'">Generar Turno</button>
                    <button class="btn btn-info" type="button" onclick="location.href='ReporteTurnos.php?filtro=<?php echo $filtro?>&myselect1=<?php echo $myselect1?>&myselect2=<?php echo $myselect2?>&myselect3=<?php echo $myselect3?>&myselect4=<?php echo $myselect4?>&myselect5=<?php echo $myselect5?>&myselect6=<?php echo $myselect6?>&fechaDesde=<?php echo $fechaDesde?>&fechaHasta=<?php echo $fechaHasta?>'">Generar Reporte</button>

			</div>
			<br></br>
			<br></br>
			<!-- FIN BARRA DE OPCIONES -->
			
			
			<table class="table table-striped">
				<tr>
					<td>Nro Turno </td> 
					<td>Medico</td>
					<td>Area</td>
					<td>Paciente</td>
					<td>Obra Social</td>
					<td>Fecha </td>
					<td>Hora </td>
					<td>Estado </td>
					<td></td>
				</tr>
	<?php
			while ($valor = mysql_fetch_array($query_busqueda)) {
				
				?>
						<tr>
						
						<td><?php echo $valor["idturno"]; ?></td>
						<td><?php echo $valor["apemed"].', '.$valor["nommed"]; ?></td>
						<td><?php echo $valor["area"]; ?></td>
						<td><?php echo $valor["pacape"].', '.$valor["pacnom"]; ?></td>
						<?php
						if(is_null($valor["nomobra"] )){
						?>	
							<td>Sin Obra Social</td>
						<?php
						}else{
						?>	
						<td><?php echo $valor["nomobra"];}?></td>
						
						<td><?php echo $valor["fecha"]; ?></td>
						<td><?php echo $valor["hora"]; ?></td>
						<td><a data-toggle="modal" role="button" href="#borrar<?php echo $valor["idturno"]; ?>" class="btn btn-danger"><?php echo $valor["estado"];?></a></td>
									<!-- MODAL DE BORRAR -->
									<div id="borrar<?php echo $valor["idturno"]; ?>" class="modal hide fade in" style="display: none; ">
										<div class="modal-body">
											<h4>Aviso</h4>	      
											<p> Esta seguro que desea modificar el estado del turno? </p>
										</div>
										<div class="modal-footer">
											<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
											<a class="btn btn-warning"  href="ModificarEstado.php?idturno=<?php echo $valor["idturno"]; ?>">Aceptar</a>
										</div>
									</div>
						</tr>
	<?php
				
			}
			
	?>	
			</table>
	</div>
	
		
		
</div>  			<!-- FIN ENCAPSULADOR!!!!! -->
</body>
</html>
 <script>
function AceptarFiltro(){ 
	
var myselect1 = document.getElementsByName('myselect1')[0].value;
 var myselect2 = document.getElementsByName('myselect2')[0].value;
 var myselect3 = document.getElementsByName('myselect3')[0].value;
 var myselect4 = document.getElementsByName('myselect4')[0].value;
 var myselect5 = document.getElementsByName('myselect5')[0].value; 
 var fechaDesde = document.getElementsByName('fechaDesde')[0].value;
 var fechaHasta = document.getElementsByName('fechaHasta')[0].value;
var myselect6 = document.getElementsByName('myselect6')[0].value;
//if (denominacion == ''){ 
// alert('Ingrese algun valor, verifique.');
// return 	
//}
//alert(miselect1);

location.href='GestionTurnos.php?filtro=S&myselect1='+myselect1+'&myselect2='+myselect2+'&myselect3='+myselect3+'&myselect4='+myselect4+'&myselect5='+myselect5+'&myselect6='+myselect6+'&fechaDesde='+fechaDesde+'&fechaHasta='+fechaHasta;	


}


</script> 
 
