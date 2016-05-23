<?php
	include("../Controller/Conexion.php");
	
	mysql_query("update hijos_empleados set nombre  = '".$_POST['name']."', nacimiento = '".$_POST['fecha']."' where id = '".$_POST['id']."'");
?>