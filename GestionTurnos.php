<?php
if(isset($_GET['pre'])){
    $opcionSeleccionada=$_GET['idsel'];
    $html='<select name=\"idpresupuesto\" id=\"idpresupuesto\">';
	include_once('mysqlconnect.php');
	$consulta = "SELECT mo.idobra, os.nombre FROM med_obrasocial as mo INNER JOIN obrasociales as os ON mo.idobra = os.idobra WHERE idmedico =  ".$opcionSeleccionada;
	$query_med = mysql_query($consulta);

	    
 	 while ($valor = mysql_fetch_array($query_med)) {   
	     if ($valor["idobra"] == $opcionSeleccionada) { $sel = " selected "; } else { $sel = " "; }
	 
	     $html.= "<option value='".$valor["idobra"]."' ".$sel." > ".$valor['nombre']."</option>";
     }
     $html.='</select>';
echo 'document.getElementById("pp2").innerHTML="'.$html.'";';
	
exit;
} 
	
					
					
			

?>

<?php
	
	
	include_once('mysqlconnect.php');
	
	$consulta = "SELECT * FROM pacientes WHERE pacientes.activo = 1";
    $query_pac = mysql_query($consulta);
	
	$consulta = "SELECT * FROM medicos WHERE medicos.activo = 1";
    $query_med = mysql_query($consulta);
	
	$consulta = "SELECT * FROM obrasociales WHERE obrasociales.activo = 1";
    $query_obra = mysql_query($consulta);

	$consulta = "SELECT * FROM especialidades WHERE especialidades.activo = 1";
    $query_espec = mysql_query($consulta);
	
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
 	
	
	
<div style="margin-top: 100px;margin-left: 100px;">
	<label>Pacientes</label>		
	<select id="myselect" >
				<?php
					while ($valor = mysql_fetch_array($query_pac)) {
				?>
				<option value="<?php echo $valor["idpaciente"];?>"><?php echo $valor["nombre"]; ?> <?php echo $valor["apellido"]; ?></option>
				<?php	  
					}
			?>
		</select>
		
   <label>Medicos</label>
	<select id="myselect" onChange="adjs('GestionTurnos.php?pre&idsel='+this.value)" >
				<?php
					while ($valor = mysql_fetch_array($query_med)) {
				?>
				<option value="<?php echo $valor["idmedico"];?>"><?php echo $valor["nombre"]; ?> <?php echo $valor["apellido"]; ?></option>
				<?php	  
					}
			?>
		</select>	


</div>
<div style="margin-top: -146px;margin-right: 300px;float: right;">
	<label>Obras Sociales</label>		
	<select id="myselect" >
				<?php
					while ($valor = mysql_fetch_array($query_obra)) {
				?>
				<option value="<?php echo $valor["idobra"];?>"><?php echo $valor["nombre"]; ?></option>
				<?php	  
					}
			?>
		</select>
		
   <label>Especialidades</label>
	<select id="myselect" >
				<?php
					while ($valor = mysql_fetch_array($query_espec)) {
				?>
				<option value="<?php echo $valor["idespecialidad"];?>"><?php echo $valor["nombre"]; ?></option>
				<?php	  
					}
			?>
		</select>	


</div>
<div id="pp2"><select name="idpresupuesto" id="idpresupuesto">



</div>
</body>
</html>
  
<script>
function adjs(url){
//alert(url);
oldsc=document.getElementById("old_sc");
if(oldsc)
document.getElementsByTagName('body')[0].removeChild(oldsc);
sc=document.createElement('script');
sc.id="old_sc";
sc.src=url+'&'+Math.random();
document.getElementsByTagName('body')[0].appendChild(sc);
}
</script>  
