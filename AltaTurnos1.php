
<?php

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
if (isset($_REQUEST['fecha'])) {
$fecha = $_REQUEST['fecha'];
}

	include_once('mysqlconnect.php');
	
// Consulta por una busqueda filtrada
 $criterio="";
 if ($filtro=='S') {
 
 	 if ($fecha == ''){
		$fecha_d= date("Y/m/d");
		$fecha_h= date("Y/m/d",strtotime("+7 days"));	
		//echo $fecha_h;
		} else{
		$fecha_d= $fecha;
		$fecha_h= $fecha;	
	}	
 
	$fec[2]=substr ($fecha_d, 0, 4);
	$fec[1]=substr($fecha_d, 5, 2);
	$fec[0]=substr($fecha_d, 8, 2);
 
 
	$fec_h[2]=substr ($fecha_h, 0, 4);
	$fec_h[1]=substr($fecha_h, 5, 2);
	$fec_h[0]=substr($fecha_h, 8, 2);
 
//    $fec = split("/", $fecha_d);
    $fecha_desde=$fec[2]."-".$fec[1]."-".$fec[0];	
  //  $fec = explode("/", $fecha_h);
    $fecha_hasta=$fec_h[2]."-".$fec_h[1]."-".$fec_h[0];

		
	
	

	$diaSemana = diaSemana($fec[2], $fec[1], $fec[0]);
	
    //if ($myselect1 >0) {  $criterio.="  and pac.idpaciente = ".$myselect1." and pac.activo = 1 ";   }	
    if ($myselect2 >0) {  $criterio.="  and med.idmedico = ".$myselect2." and med.activo = 1 ";   }	
    if ($myselect3 >0) {  $criterio.="  and esp.idespecialidad = ".$myselect3." and esp.activo = 1 ";   }	
    if ($myselect4 >0) {  $criterio.="  and obr.idobra = ".$myselect4." and obr.activo = 1 ";   }	
    if ($myselect5 >0) {  
		if ($myselect5 == 1) { $criterio.="  and hor.idhorario in (1,3,5,7,9,11) ";}
		if ($myselect5 == 2) { $criterio.="  and hor.idhorario in (2,4,6,8,10) "; }

	}	


	
    $consulta="SELECT distinct med.*, hor.idhorario, TIME_FORMAT(hor.horaIn,'%H:%m') as horaIn, TIME_FORMAT(hor.horaOut,'%H:%m') as horaOut, hor.dia, hor.dia_nro, hor.fecha, mh.*
	FROM horarios as hor 
	inner join med_hor as mh on hor.idhorario = mh.idhorario
	inner join medicos as med on med.idmedico = mh.idmedico 
	inner join med_esp as me on med.idmedico = me.idmedico
	inner join med_obrasocial as mo on med.idmedico = mo.idmedico
	inner join especialidades as esp on me.idespecialidad = esp.idespecialidad
	inner join obrasociales as obr on mo.idobra = obr.idobra
	where  hor.fecha between '$fecha_desde' and '$fecha_hasta' " .$criterio. " order by hor.fecha, hor.horaIn, med.apellido ";	  
     
	$query_busqueda = mysql_query($consulta);
  

 
 }




	

	
	$consulta = "SELECT * FROM pacientes WHERE pacientes.activo = 1";
    $query_pac = mysql_query($consulta);
	
	$consulta = "SELECT * FROM medicos WHERE medicos.activo = 1";
    $query_med = mysql_query($consulta);
	
	$consulta = "SELECT * FROM obrasociales WHERE obrasociales.activo = 1";
    $query_obra = mysql_query($consulta);

	$consulta = "SELECT * FROM especialidades WHERE especialidades.activo = 1";
    $query_espec = mysql_query($consulta);

	$consulta = "SELECT idhorario, TIME_FORMAT(horaIn,'%H:%m') as horaIn, TIME_FORMAT(horaOut,'%H:%m') as horaOut
				 FROM horarios
				 GROUP BY horaIn";
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
 	
 	 <?php  $x=1; ?>
	<?php include_once('header.php'); ?>
	
<div class="encapsulador" style="margin-top: 75px;">
	<ul class="breadcrumb">
		<li> 
			<h5>Alta de Turno<a href="#" style="margin-left: 40px;"><i class="icon-question-sign"></i></a></h5>
																				 <!-- ICONO DE AYUDA -->  
		</li>
	</ul>
	<div id="form-turnos">
		<form name="filtro" class="form-horizontal">
			<div>
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
			<div style="margin-left: 253px; margin-top: -150px;">
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

				<label>Fecha:</label>
				<select id="fecha" name="fecha" >
					<option value=>Todas</option>
					<?php
						$query= "SELECT DISTINCT fecha
								 FROM horarios";
						$res_fecha = mysql_query($query);

						while ($valor = mysql_fetch_array($res_fecha)) {
							if ($fecha == $valor["fecha"]) {
								$sel= " SELECTED ";
								}else{
									$sel= "";
								}
					?>
							<option value="<?php echo $valor["fecha"];?>"<?php echo $sel;?>> <?php echo $valor["fecha"]; ?></option>
					<?php	  
						}
					?>
				</select>	
			</div>	
			<div style="margin-left: 506px; margin-top: -150px;">
				<!-- ***************************** SELECT DE HORA ***************************** -->
				<label>Franja Horaria:</label>
				<select id="myselect5" name="myselect5" >
					<option value=0>Todas</option>
					<?php
						while ($valor = mysql_fetch_array($query_hor)) {
							if ($myselect5 == $valor["idhorario"]) {
								$sel= " SELECTED ";
								}else{
									$sel= "";
								}
								$horaIn=substr($valor["horaIn"],0,5);
								$horaOut=substr($valor["horaOut"],0,5);
								
					?>
							<option value="<?php echo $valor["idhorario"];?>"<?php echo $sel;?>> <?php echo $horaIn; ?><?php echo ' - '.$horaOut; ?></option>
					<?php	  
						}
					?>
				</select>	
			
				<button class='btn btn-warning' style="margin-top: 50px;" type='button' onclick='AceptarFiltro();'> Buscar </button>
			</div>
		</form>
	</div>

	<div id="tabla-medicos">
    <?php
	  	if ($filtro == "S") {
	?>
			<table class="table table-striped">
				<tr>
					<td>Medico </td> 
					<td>Especialidades</td>
					<td>Obras Sociales</td>
					<td>Dia</td>
					<td>Fecha </td>
					<td> Franja Hor. </td>
					<td></td>
				</tr>
	<?php
			while ($valor = mysql_fetch_array($query_busqueda)) {
	?>
				<tr>
					<td><?php echo $valor["apellido"].', '.$valor["nombre"]; ?></td>
					<td>
						<?php
							$query= "SELECT * from med_esp as me
							 		 INNER JOIN especialidades as e on e.idespecialidad = me.idespecialidad 
							 		 WHERE me.idmedico = ".$valor["idmedico"]."";
							$res = mysql_query($query);
							while ($esp = mysql_fetch_array($res)) {
								echo "&nbsp;".$esp["nombre"]."";
							}
						?>
					</td>
					<td>
						<?php				
							$query= "SELECT  * from med_obrasocial as mo
							 		 INNER JOIN obrasociales as o on o.idobra = mo.idobra 
							 		 WHERE mo.idmedico = ".$valor["idmedico"]."";
							$res = mysql_query($query);
							while ($obra=mysql_fetch_array($res)) {
								echo "&nbsp;".$obra["nombre"]."";
							}
						?>
					</td>
					<td><?php echo $valor["dia"]; ?></td>
					<td><?php echo $valor["fecha"]; ?></td>
					<td><?php echo $valor["horaIn"].' - '.$valor["horaOut"]; ?></td>
					<?php 
						$idmedico = $valor['idmedico'];
						$idhorario = $valor['idhorario'];
						$fecha = $valor['fecha'];
					?>	
						
					<td><button class='btn btn-success' type='button' onclick="location.href='AltaTurno.php?idmedico=<?php echo $idmedico;?>&idhorario=<?php echo $idhorario;?>&fecha=<?php echo $fecha;?>'"> Alta </button> </td>
				</tr>
	<?php
			}
	?>	
			</table>
	</div>
	<?php
		 
		}  // FIN DE  FILTRO == S
		
	?>
		
		
</div>  			<!-- FIN ENCAPSULADOR!!!!! -->
</body>
</html>
 <script>
function AceptarFiltro(){ 
	

 var myselect2 = document.getElementsByName('myselect2')[0].value;
 var myselect3 = document.getElementsByName('myselect3')[0].value;
 var myselect4 = document.getElementsByName('myselect4')[0].value;
 var myselect5 = document.getElementsByName('myselect5')[0].value; 
 var fecha = document.getElementsByName('fecha')[0].value;

//if (denominacion == ''){ 
// alert('Ingrese algun valor, verifique.');
// return 	
//}
//alert(miselect1);

location.href='AltaTurnos1.php?filtro=S&myselect2='+myselect2+'&myselect3='+myselect3+'&myselect4='+myselect4+'&myselect5='+myselect5+'&fecha='+fecha;	


}


</script> 
 
