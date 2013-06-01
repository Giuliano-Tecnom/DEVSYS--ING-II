<?php
	include_once('mysqlconnect.php');
	
	if (!isset($_GET['idobra'])) {
		Header ('Location: GestionObras.php');
	} else {
		$consultaRelacionesConPacientes = 	"SELECT * 
											FROM obrasociales as o 
											INNER JOIN pac_obrasocial as po
											ON o.idobra = po.idobra
											WHERE o.idobra = '" . $_GET['idobra'] ."';";
									
		$consultaRelacionesConMedicos = 	"SELECT * 
											FROM obrasociales as o 
											INNER JOIN med_obrasocial as mo
											ON o.idobra = mo.idobra
											WHERE o.idobra = '" . $_GET['idobra'] ."';";

		$relPacientes = mysql_query($consultaRelacionesConPacientes);
		$relMedicos = mysql_query($consultaRelacionesConMedicos);
		if ( mysql_num_rows($relPacientes) == 0 && mysql_num_rows($relMedicos) == 0) {
			$consulta_delete = "UPDATE obrasociales SET activo = 0 WHERE idobra = '" . $_GET['idobra'] ."';";
			mysql_query($consulta_delete);
			Header ('Location: GestionObras.php?Correcto=1');
		} else {
			Header ('Location: GestionObras.php?Error=1');
		}
	}	
?>
