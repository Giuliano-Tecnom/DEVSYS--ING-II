
<?php

include_once('mysqlconnect.php');


if (isset($_POST['user']) && isset($_POST['pass'])) {
    $usuario = $_POST['user'];
    $consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = ".$_POST['pass']." ";
    $res = mysql_query($consulta);
    
    echo $consulta;
    echo $_POST['user'];
    echo $_POST['pass'];

    if (mysql_num_rows($res) == 1) {
        
        while ($valor = mysql_fetch_array($res)) {
            session_start();
            $_SESSION['usuario'] = $valor['usuario'];
            $_SESSION['tipo'] = $valor['tipo'];
            
            header("location:index.php");
        }
    }else{

        header("location:login.php?Error=1");
    }

}

?>