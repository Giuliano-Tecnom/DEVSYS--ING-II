
<?php

    // INICIO DE CONTROL DE LOGEO!!!!!!!!!!!!

    session_start();
    if (!isset($_SESSION['usuario']))
        header("location:login.php");

    // fin de control de logeo!!!!!!!

?>