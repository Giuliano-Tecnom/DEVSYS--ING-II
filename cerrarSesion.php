
<?php

include_once('mysqlconnect.php');
include_once('seguridadSesion.php');

session_unset();
session_destroy();
header("location:login.php");


?>