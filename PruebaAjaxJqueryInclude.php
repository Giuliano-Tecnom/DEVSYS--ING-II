
  
<?php

include_once('mysqlconnect.php');
			
	




$obras="SELECT * FROM  med_obrasocial 
                 inner join obrasociales obra on obra.idobra=med_obrasocial.idobra
				 where med_obrasocial.idmedico=".$_POST['valorSelect']." 
				 
";

$query_obras=mysql_query($obras);
while($row = mysql_fetch_array($query_obras))
  {
echo "
     <label><b>Obras Sociales asociadas al Medico</label></b>
     <select name='Obras'>
                   <option value=". $row['idobra'] .">" . $row['nombre'] . "</option>
				   
     </select>

";
  }
  
  
?>