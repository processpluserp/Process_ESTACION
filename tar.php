<?php
	require("Controller/Conexion.php");
	
	$sql = mysql_query("select nombre_empleado, email_empleado
	
	from empleado where estado = '1' and email_empleado != '' and (pk_depto = '1' or pk_depto = '18')");
	while($row = mysql_fetch_array($sql)){
		echo utf8_decode($row['nombre_empleado'])." < ".$row['email_empleado']."></br>";
	}
?>