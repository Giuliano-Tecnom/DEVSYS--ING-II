
<?php

include_once('mysqlconnect.php');


if (isset($_POST['user']) && isset($_POST['pass'])) {
    $usuario =strtoupper($_POST['user']);
    $pass = strtoupper($_POST['pass']);

    $consultaUsu = "SELECT * FROM usuarios WHERE usuario = '".$usuario."'";
	
	$resU = mysql_query($consultaUsu);
    $consultaCont="SELECT * FROM usuarios WHERE usuario = '".$usuario."' AND password = '".$pass."' AND activo = 1";
	$resC = mysql_query($consultaCont);
	
	
			
    
			if (mysql_num_rows($resU) == 1) {
				$consultaActivo="SELECT activo FROM usuarios WHERE usuario = '".$usuario."'";
				$resActivo = mysql_query($consultaActivo);
				while ($valor = mysql_fetch_array($resActivo)) {
					$activo = $valor["activo"];
				}
				if ($activo == 1) {
			
						if (mysql_num_rows($resC) == 1) {	
							while ($valor = mysql_fetch_array($resC)) {
								session_start();
								$_SESSION['usuario'] = $valor['usuario'];
								$_SESSION['tipo'] = $valor['tipo'];
								$Consulta_modIntentos ="UPDATE usuarios SET intentos = 0 WHERE usuario = '".$usuario."'";
								$ModificacionIntentos = mysql_query($Consulta_modIntentos);
								header("location:index.php");
							}
						}else{
						
								$ConsultaIntentos = "SELECT intentos FROM usuarios WHERE usuario = '".$usuario."'";
								$resI = mysql_query($ConsultaIntentos);
								while ($valor = mysql_fetch_array($resI)) {
									$cant_intentos = $valor["intentos"];
								
								}
								
								if ($cant_intentos == 2){
									$Consulta_mod ="UPDATE usuarios SET activo = 0 WHERE usuario = '".$usuario."'";
									$Modificacion = mysql_query($Consulta_mod);
									header("location:login.php?Error=3");
								}else{
									$cant_intentos++;
									echo $valor["intentos"];
									echo $cant_intentos;
									$Consulta_modIntentos ="UPDATE usuarios SET intentos = '".$cant_intentos."' WHERE usuario = '".$usuario."'";
									$ModificacionIntentos = mysql_query($Consulta_modIntentos);
									header("location:login.php?Error=2");
								}
						}
						
						 }else{
							header("location:login.php?Error=4");
						}
					}else{

				header("location:login.php?Error=1");
			}
 
  
}

?>