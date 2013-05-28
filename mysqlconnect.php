<?php
	
	$link = mysql_connect('localhost', 'root', '');
	if (!$link)
	{
		die('No se pudo conectar al servidor: ' . mysql_error());
	}
	$db_selected = mysql_select_db('clinicsystem', $link);
	if (!$db_selected) 
	{
		die ('Can\'t use foo : ' . mysql_error());
	}

?>