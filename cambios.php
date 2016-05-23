<?php
	include("Controller/Conexion.php");
	
	
	$sql = mysql_query("select distinct ppto from itempresup where pk_orden != 0");
	echo "----------------------".mysql_num_rows($sql)."--------------</br>";
	while($row = mysql_fetch_array($sql)){
		
		
		mysql_query("update cabpresup set estado_presup = 5 where codigo_presup = ".$row['ppto']."");
		echo $row['ppto']." Actualizado...</br>";
	}
	
	
	
	
?>