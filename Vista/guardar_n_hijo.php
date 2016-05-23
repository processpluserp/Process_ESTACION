<?php
	include("../Controller/Conexion.php");
	
	mysql_query("insert into hijos_empleados (nombre,nacimiento,empleado) values('".$_POST['name']."','".$_POST['fecha']."','".$_POST['empleado']."')");
	$sql_consult = mysql_query("SELECT @@identity AS id");
		$id = "";
		while($row = mysql_fetch_row($sql_consult)){
			echo $row[0];
		}
?>