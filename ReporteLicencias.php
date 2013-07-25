<?php

if (!isset($_GET['ojito'])) {
		$ojito=1;
	}else{
		$ojito=$_GET['ojito'];
	}
	
	
if ($ojito == 1) {
 $nombre= 'ACTIVAS';
}else{
  $nombre= 'INACTIVAS';
  
 } 	
	include_once('mysqlconnect.php');
	
	
	// $consulta = "SELECT idlicencia,med.idmedico,fechaDesde,fechaHasta,nombre,apellido,
	             // case estado when 1 then 'Activa' else 'Inactiva' end as estado
               	// FROM licencias as lic
				
                     // INNER JOIN medicos as med on med.idmedico=lic.idmedico
				// where estado = ".$ojito." OR 0 = ".$ojito." ";
	
	
	$consulta = "SELECT idlicencia,med.idmedico,fechaDesde,fechaHasta,nombre,apellido,
	             case estado when 1 then 'Activa' else 'Inactiva' end as estado
               	FROM licencias as lic
				
                     INNER JOIN medicos as med on med.idmedico=lic.idmedico
				where estado = ".$ojito."";
    $resultado = mysql_query($consulta);
	        

	
	
	

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
$porc = Array("40","40","40","40");  // Tamaño de las COLUMNAS para "A4"   // Maximo : 185% total de tr  PARA orientacion "P"    273%  PARA orientacion "L"


 
// Encabezado del Reporte
$titulo_listado='LISTADO DE LICENCIAS '.$nombre;
$subtitulo_listado=' '.$estado;
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
    <td   width=".$porc[0]."%  valign=middle align=".$C.$size." ".$bgcolor.">Apellido y Nombre</td>
    <td   width=".$porc[1]."%  valign=middle align=".$C.$size." ".$bgcolor.">Fecha Desde</td>
    <td   width=".$porc[2]."%  valign=middle align=".$C.$size." ".$bgcolor.">Fecha Hasta</td>	     
	<td   width=".$porc[3]."%  valign=middle align=".$C.$size." ".$bgcolor.">Estado</td>";	     
 $_SESSION['repor_enc'] .= "</tr>"; 
 $_SESSION['repor_enc'] .="</table>";
            
		  	
// Detalle	Reporte
$size="size=7";

 
    
         	        
       

  while ($valor = mysql_fetch_array($resultado))
				{
					$bgcolor = " ";   
				   $content .="<table border=1 >";
				   $content .= "<tr>";
				// datos 
				   $content .= "
					
					<td  width=".$porc[0]."% valign=middle align=".$L.$size." ".$bgcolor." >".$valor["apellido"].' '.$valor["nombre"]."</td>
					<td  width=".$porc[1]."% valign=middle align=".$L.$size." ".$bgcolor." >".$valor["fechaDesde"]."</td>
					<td  width=".$porc[2]."% valign=middle align=".$L.$size." ".$bgcolor." >".$valor["fechaHasta"]."</td>	
					<td  width=".$porc[3]."% valign=middle align=".$C.$size." ".$bgcolor." >".$valor["estado"]."</td>";	
	

					$content .= "</tr></table>";  
 } // fin while /FOR					
				
  		

// Impresion

   $pdf->AddPage();
   $pdf->htmltable($content);
   $pdf->output();






?>