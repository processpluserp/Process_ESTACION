<?php
	#Empleado el mysql_connect me conecto a la base de datos del phpMyAdmin al servidor localhost con el 
	#usuario ROOT y la contraseña $#laestacionmayday724$#
	//$conexion = mysql_connect("localhost","root","");
	ini_set('upload_max_filesize', '5000000M');
	ini_set('post_max_size', '5000000M');
	ini_set('max_execution_time', 5000000);
	ini_set('memory_limit', "150M");
	set_time_limit(0);
	date_default_timezone_set('America/Bogota');
	$conexion = mysql_connect("localhost","root","");
	
	#Con el método de mysql_select_db, selecciono la base de datos con la que voy a trabajar, en este caso la que guarda TODA la información 
	#del process que es DB_PROCESS, junto con la variable "$conexion" que guarda la información de ingreso al servidor localhost que es en donde 
	#se almanace esta base de datos.
	mysql_select_db("db_process",$conexion);
	

?>