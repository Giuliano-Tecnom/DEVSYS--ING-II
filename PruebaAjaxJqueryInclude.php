
  
<?php

include_once('mysqlconnect.php');
			
	

$sql="SELECT * FROM medicos WHERE idmedico = ".$_POST['valorSelect']."";



$result = mysql_query($sql);

echo "<table  border='1'>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Nro Matricula</th>
<th>Email</th>
<th>Telefono</th>
<th>Fecha Nacimiento</th>
<th>dni</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['nombre'] . "</td>";
  echo "<td>" . $row['apellido'] . "</td>";
  echo "<td>" . $row['nromatricula'] . "</td>";
  echo "<td>" . $row['email'] . "</td>";
  echo "<td>" . $row['telefono'] . "</td>";
  echo "<td>" . $row['fechaNac'] . "</td>";
  echo "<td>" . $row['dni'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

  
  
  
?>