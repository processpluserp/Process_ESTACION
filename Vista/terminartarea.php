<?php
	include("../Controller/Conexion.php");
	$idxx = $_POST['id'];
	mysql_query("update tareas set estado = '3' where codigo_int_tarea = '$idxx'");
	echo "Tarea Terminada";
?>