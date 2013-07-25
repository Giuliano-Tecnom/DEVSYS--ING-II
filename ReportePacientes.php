<?php

if (!isset($_GET['ojito'])) {
		$ojito=1;
	} else {
		$ojito=$_GET['ojito'];
	}

if ($ojito == 1) {
 $nombre= 'ACTIVOS';
}else{
  $nombre= 'INACTIVOS';
  
 } 	

include_once('mysqlconnect.php');	
	
$consulta = "SELECT * FROM pacientes WHERE pacientes.activo = ".$ojito;
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
$porc = Array("30","30","20","20","40","20","25");  // Tamaño de las COLUMNAS para "A4"   // Maximo : 185% total de tr  PARA orientacion "P"    273%  PARA orientacion "L"


 
// Encabezado del Reporte
$titulo_listado='LISTADO DE PACIENTES '.$nombre;
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
    <td   width=".$porc[1]."%  valign=middle align=".$C.$size." ".$bgcolor.">Direccion</td>
    <td   width=".$porc[2]."%  valign=middle align=".$C.$size." ".$bgcolor.">Telefono</td>	     
	<td   width=".$porc[3]."%  valign=middle align=".$C.$size." ".$bgcolor.">Email</td>
    <td   width=".$porc[4]."%  valign=middle align=".$C.$size." ".$bgcolor.">Obra Social</td>
    <td   width=".$porc[5]."%  valign=middle align=".$C.$size." ".$bgcolor.">DNI</td>	
    <td   width=".$porc[6]."%  valign=middle align=".$C.$size." ".$bgcolor.">Fecha de Nacimiento</td>";	     
 $_SESSION['repor_enc'] .= "</tr>"; 
 $_SESSION['repor_enc'] .="</table>";
            
		  	
// Detalle	Reporte
$size="size=7";

 
    
         	        
       

  while ($valor = mysql_fetch_array($resultado))
				{
					$consultaObras= "SELECT  o.nombre										 
										 FROM pac_obrasocial as po
										 INNER join obrasociales as o ON o.idobra= po.idobra
										 INNER join pacientes as p ON p.idpaciente = po.idpaciente
										 where po.idpaciente ='" .$valor["idpaciente"]. "'";
					$resultadoConsultaObras = mysql_query($consultaObras);
					
					$obraSociales=' ';
					if (mysql_num_rows($resultadoConsultaObras) > 0) {
									while ($obra = mysql_fetch_array($resultadoConsultaObras)) { 
										 $obraSociales.= $obra['nombre']. ' - ';
								}
					}else{
					
						$obraSociales='Sin Obra Social';
						
					}
					
					
					
					$bgcolor = " ";   
				   $content .="<table border=1 >";
				   $content .= "<tr>";
				// datos 
				   $content .= "
					
					<td  width=".$porc[0]."% valign=middle align=".$L.$size." ".$bgcolor." >".$valor["apellido"].' '.$valor["nombre"]."</td>
					<td  width=".$porc[1]."% valign=middle align=".$L.$size." ".$bgcolor." >".$valor["direccion"]."</td>
					<td  width=".$porc[2]."% valign=middle align=".$L.$size." ".$bgcolor." >".$valor["telefono"]."</td>	
					<td  width=".$porc[3]."% valign=middle align=".$L.$size." ".$bgcolor." >".$valor["email"]."</td>
					<td  width=".$porc[4]."% valign=middle align=".$C.$size." ".$bgcolor." >".$obraSociales."</td>
					<td  width=".$porc[5]."% valign=middle align=".$C.$size." ".$bgcolor." >".$valor["dni"]."</td>
					<td  width=".$porc[6]."% valign=middle align=".$C.$size." ".$bgcolor." >".$valor["fechaNac"]."</td>";	
					
					$content .= "</tr></table>";  
 } // fin while /FOR					
				
  		

// Impresion

   $pdf->AddPage();
   $pdf->htmltable($content);
   $pdf->output();






?>