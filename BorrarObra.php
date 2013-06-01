<?php
	include_once('mysqlconnect.php');
	
	if (!isset($_GET['idobra'])) {
		Header ('Location: GestionObras.php');
	} else {
		$consulta_hayRelaciones = 	"SELECT * 
									FROM obrasociales as o 
									INNER JOIN pac_obrasocial as po
									ON o.idobra = 	po.idobra
									WHERE o.idobra = '" . $_GET['idobra'] ."';";

		$res = mysql_query($consulta_hayRelaciones);
		if ( mysql_num_rows($res) == 0 ) {
			$consulta_delete = "UPDATE obrasociales SET activo = 0 WHERE idobra = '" . $_GET['idobra'] ."';";
			mysql_query($consulta_delete);
			Header ('Location: GestionObras.php?Correcto=1');
		} else {
			Header ('Location: GestionObras.php?Error=1');
		}
	}	
?>
