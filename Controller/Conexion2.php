<?php
	#Empleado el mysql_connect me conecto a la base de datos del phpMyAdmin al servidor localhost con el 
	#usuario ROOT y la contraseña $#laestacionmayday724$#
	$conexion = mysql_connect("localhost","root","1234");
	
	#Con el método de mysql_select_db, selecciono la base de datos con la que voy a trabajar, en este caso la que guarda TODA la información 
	#del process que es DB_PROCESS, junto con la variable "$conexion" que guarda la información de ingreso al servidor localhost que es en donde 
	#se almanace esta base de datos.
	mysql_select_db("traficos",$conexion);

?>