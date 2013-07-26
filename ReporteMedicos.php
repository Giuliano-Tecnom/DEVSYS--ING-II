<?php

if (!isset($_GET['ojito'])) {
		$ojito=1;
	}else{
		$ojito=$_GET['ojito'];
	}
if ($ojito == 1) {
 $nombre= 'ACTIVOS';
}else{
  $nombre= 'INACTIVOS';
  
 } 
	include_once('mysqlconnect.php');
	
	//$consulta = "SELECT * FROM medicos WHERE medicos.activo = ".$ojito." OR 0 = ".$ojito." ";
	$consulta = "SELECT * FROM medicos WHERE medicos.activo = ".$ojito;
    $resultado = mysql_query($consulta);
	
	

	
	
	

// configuracion
define("FPDF_FONTPATH","font/");
require("lib/pdftable.inc.php");

$_SESSION['orientacion'] = 'L';
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
$porc = Array("20","20","20","20","20","50","50","15","15","45");  // Tamaño de las COLUMNAS para "A4"   // Maximo : 185% total de tr  PARA orientacion "P"    273%  PARA orientacion "L"


 
// Encabezado del Reporte

$titulo_listado='LISTADO DE MEDICOS '.$nombre;
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
    <td   width=".$porc[0]."%  valign=middle align=".$C.$size." ".$bgcolor.">Apellido y Nombre</td>
    <td   width=".$porc[1]."%  valign=middle align=".$C.$size." ".$bgcolor.">Matricula</td>
    <td   width=".$porc[2]."%  valign=middle align=".$C.$size." ".$bgcolor.">Direccion</td>	     
	<td   width=".$porc[3]."%  valign=middle align=".$C.$size." ".$bgcolor.">Telefono</td>
    <td   width=".$porc[4]."%  valign=middle align=".$C.$size." ".$bgcolor.">Email</td>
    <td   width=".$porc[5]."%  valign=middle align=".$C.$size." ".$bgcolor.">Obras Sociales</td>	
    <td   width=".$porc[6]."%  valign=middle align=".$C.$size." ".$bgcolor.">Especialidades</td>
	<td   width=".$porc[7]."%  valign=middle align=".$C.$size." ".$bgcolor.">DNI</td>
	<td   width=".$porc[8]."%  valign=middle align=".$C.$size." ".$bgcolor.">Fecha de Nacimiento</td>
    <td   width=".$porc[9]."%  valign=middle align=".$C.$size." ".$bgcolor.">Horarios</td>";	     
 $_SESSION['repor_enc'] .= "</tr>"; 
 $_SESSION['repor_enc'] .="</table>";
            
		  	
// Detalle	Reporte
$size="size=7";

 
    
         	        
       

  while ($valor = mysql_fetch_array($resultado))
				{
					//inicio especialidades
					$consultaEspecialidades= "SELECT  * from med_esp as me
												  inner join especialidades as e on e.idespecialidad = me.idespecialidad 
												  where me.idmedico = ".$valor["idmedico"]."";
							
					$resultadoConsultaEspecialidades = mysql_query($consultaEspecialidades);	
					$especialidades=' ';
					if (mysql_num_rows($resultadoConsultaEspecialidades) > 0) {
						while ($especialidad = mysql_fetch_array($resultadoConsultaEspecialidades)) { 
							$especialidades.=utf8_decode($especialidad['nombre']).' - '; 
						}
					}
					
					//fin especialidades
					
					//inicio obras sociales
					
					$consultaObras= "SELECT  * from med_obrasocial as mo
								 inner join obrasociales as o on o.idobra = mo.idobra 
								 where mo.idmedico = ".$valor["idmedico"]."";
					$resultadoConsultaObras = mysql_query($consultaObras);
					
					$obraSocial=' ';
					if (mysql_num_rows($resultadoConsultaObras) > 0) {
									while ($obra = mysql_fetch_array($resultadoConsultaObras)) { 
										$obraSocial.=utf8_decode($obra['nombre']).' - ';
								}
								
					}
					
									
					//fin obras sociales
					
					
					//inicio de horarios
					$consultaHorarios = "SELECT h.dia, h.horaIn, h.horaOut 
												 FROM horarios as h
												 INNER JOIN med_hor as mh
												 ON h.idhorario = mh.idhorario
												 WHERE mh.idmedico = ".$valor["idmedico"]."";
					$resultadoConsultaHorarios = mysql_query($consultaHorarios);
					
					$horarios=' ';
					
					if (mysql_num_rows($resultadoConsultaHorarios) > 0) {
						while ($horario = mysql_fetch_array($resultadoConsultaHorarios)) {
							$horarios.= $horario['dia']." - ".$horario['horaIn']." - ".$horario['horaOut'].' <br> '; 
						}
					}
					
					
					//fin de horarios
					
					$bgcolor = " ";   
					$content .="<table border=1 >";
					$content .= "<tr>";
				// datos 
				   $content .= "
					<td  width=".$porc[0]."% valign=middle align=".$C.$size." ".$bgcolor." >".$valor["apellido"].' '.$valor["nombre"]."</td>
					<td  width=".$porc[1]."% valign=middle align=".$L.$size." ".$bgcolor." >".$valor["nromatricula"]."</td>
					<td  width=".$porc[2]."% valign=middle align=".$L.$size." ".$bgcolor." >".$valor["direccion"]."</td>
					<td  width=".$porc[3]."% valign=middle align=".$L.$size." ".$bgcolor." >".$valor["telefono"]."</td>	
					<td  width=".$porc[4]."% valign=middle align=".$L.$size." ".$bgcolor." >".$valor["email"]."</td>
					<td  width=".$porc[5]."% valign=middle align=".$C.$size." ".$bgcolor." >".$obraSocial."</td>
					<td  width=".$porc[6]."% valign=middle align=".$C.$size." ".$bgcolor." >".$especialidades."</td>
					<td  width=".$porc[7]."% valign=middle align=".$L.$size." ".$bgcolor." >".$valor["dni"]."</td>
					<td  width=".$porc[8]."% valign=middle align=".$L.$size." ".$bgcolor." >".$valor["fechaNac"]."</td>
					<td  width=".$porc[9]."% valign=middle align=".$C.$size." ".$bgcolor." >".$horarios."</td>";	
					
					$content .= "</tr></table>";  
 } // fin while /FOR					
				
					

// Impresion

   $pdf->AddPage();
   $pdf->htmltable($content);
   $pdf->output();






?>