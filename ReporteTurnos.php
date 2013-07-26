<?php
//error_reporting = E_ALL
//+
//& ~E_STRICT & ~E_NOTICE
// =
//error_reporting = E_ALL & ~E_STRICT & ~E_NOTICE

include_once('mysqlconnect.php');

		if (isset($_REQUEST['filtro'])) {
		$filtro = $_REQUEST['filtro'];
		}
if ($filtro=='S') {
		
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
     
	$resultado = mysql_query($consultaFinal);
  
	
	
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
     
	$resultado = mysql_query($consultaFinal);
  
 
 
 
 
 
 }
		    



	

// configuracion
define("FPDF_FONTPATH","font/");
require("lib/pdftable.inc.php");

$_SESSION['orientacion'] = 'P';
$_SESSION['hoja'] = 'A4';
$pdf = new PDFTable($_SESSION['orientacion'],"mm",$_SESSION['hoja']);

// I set margins out of class
$pdf->AddFont("vni_times");
$pdf->AddFont("vni_times", "B");
$pdf->AddFont("vni_times", "I");
$pdf->AddFont("vni_times", "BI");
$pdf->SetMargins(15,15,15);
$pdf->defaultFontFamily = "arial";
$pdf->defaultFontStyle  = "";
$pdf->defaultFontSize   = 10;
$pdf->SetFont($pdf->defaultFontFamily, $pdf->defaultFontStyle, $pdf->defaultFontSize);
$pdf->AliasNbPages();

// Parametros

$size="size=6";
$bgcolor_tit = "bgcolor=#B4D4ED"; //COLOR DEL TITULO 	
// $bgcolor_total = "bgcolor=#F3F781";
$L='left ';
$C='center ';
$R='right ';


$content ="";
$porc = Array("20","30","30","30","20","20","20","15");  // Tamaño de las COLUMNAS para "A4"   // Maximo : 185% total de tr  PARA orientacion "P"    273%  PARA orientacion "L"


 
// Encabezado del Reporte
$titulo_listado='LISTADO DE TURNOS';
$subtitulo_listado='Subtitulos '.$estado;
$bgcolor = $bgcolor_tit; 
 $_SESSION['repor_enc'] = '';
 
 $_SESSION['repor_enc'] .="<table border=0 align=center>
                                  <tr><td  ".$size.">&nbsp;</td></tr>
                                  <tr><td  align=center size=12 style=bold>
								  &nbsp;".$titulo_listado."</td></tr>
								  <tr><td  align=center size=8 style=bold>
								  &nbsp;".$subtitulo_listado."</td></tr>
                                  </table>";    
  
 
 $_SESSION['repor_enc'] .="<table border=1 align=left>";
 
 $_SESSION['repor_enc'] .= "<tr>  
    <td   width=".$porc[0]."%  valign=middle align=".$C.$size." ".$bgcolor.">Nro.Turno</td>
    <td   width=".$porc[1]."%  valign=middle align=".$C.$size." ".$bgcolor.">Medico</td>
    <td   width=".$porc[2]."%  valign=middle align=".$C.$size." ".$bgcolor.">Area</td>	     
	<td   width=".$porc[3]."%  valign=middle align=".$C.$size." ".$bgcolor.">Paciente</td>
    <td   width=".$porc[4]."%  valign=middle align=".$C.$size." ".$bgcolor.">Obra Social</td>
    <td   width=".$porc[5]."%  valign=middle align=".$C.$size." ".$bgcolor.">Fecha</td>	
    <td   width=".$porc[6]."%  valign=middle align=".$C.$size." ".$bgcolor.">Hora</td>	
    <td   width=".$porc[7]."%  valign=middle align=".$C.$size." ".$bgcolor.">Estado Turno</td>";	     
 $_SESSION['repor_enc'] .= "</tr>"; 
 $_SESSION['repor_enc'] .="</table>";
            
		  	
// Detalle	Reporte
$size="size=7";

 
    
         	        
       

  while ($valor = mysql_fetch_array($resultado))
				{
					
					if(is_null($valor["nomobra"] )){
						$valor["nomobra"]='Sin Obra Social';
					}
					
					
					$idturno= $valor["idturno"];
					$bgcolor = " ";   
				   $content .="<table border=1 >";
				   $content .= "<tr>";
				// datos 
				   $content .= "
					<td  width=".$porc[0]."% valign=middle align=".$C.$size." ".$bgcolor." >".$valor["idturno"]."</td>
					<td  width=".$porc[1]."% valign=middle align=".$L.$size." ".$bgcolor." >".$valor["apemed"].' '.$valor["nommed"]."</td>
					<td  width=".$porc[2]."% valign=middle align=".$L.$size." ".$bgcolor." >".$valor["area"]."</td>
					<td  width=".$porc[3]."% valign=middle align=".$L.$size." ".$bgcolor." >".$valor["pacape"].' '.$valor["pacnom"]."</td>	
					<td  width=".$porc[4]."% valign=middle align=".$L.$size." ".$bgcolor." >".$valor["nomobra"]."</td>
					<td  width=".$porc[5]."% valign=middle align=".$C.$size." ".$bgcolor." >".$valor["fecha"]."</td>
					<td  width=".$porc[6]."% valign=middle align=".$C.$size." ".$bgcolor." >".$valor["hora"]."</td>
					<td  width=".$porc[7]."% valign=middle align=".$C.$size." ".$bgcolor." >".$valor["estado"]."</td>";	
					
					$content .= "</tr></table>";  
 } // fin while /FOR					
				
  		

// Impresion

   $pdf->AddPage();
   $pdf->htmltable($content);
   $pdf->output();






?>