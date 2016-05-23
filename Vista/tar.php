<?php
	include("../Controller/Conexion.php");
	
	$sql = mysql_query("select consecutivo from flujo_tareas");
	while($row = mysql_fetch_array($sql)){
		mysql_query("update flujo_tareas set pk_tarea = '".$row['consecutivo']."' where consecutivo = '".$row['consecutivo']."'");
	}
?>