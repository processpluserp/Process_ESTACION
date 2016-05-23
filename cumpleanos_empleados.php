<!DOCTYPE html>
	<html>
	
<?php
	require("Controller/Conexion.php");
	
//$message = file_get_contents("index.html");

	$mensaje = "<html>
		
					<body>";

	
	$cabecera = "From: SOPORTE PROCESS PLUS<soporte.processplues@gmail.com>" . "\r\n";
	$cabecera .= 'Cc: Damian Mosquera<damian.mosquera@grupolaestacion.com>' . "\r\n";
	$cabecera .= "MIME-Version: 1.0\r\n";
	$cabecera .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	
	$num_correos = 0;
	$asunto = utf8_decode("CUMPLEAÑOS ".date("Y-m-d"));
	$sql = mysql_query("select nombre_empleado,fecha_nacimiento from empleado where month(fecha_nacimiento) = month(SYSDATE()) AND day(fecha_nacimiento) = day(SYSDATE())");
	$texto = "<h3>Hola ! Qué tal ?</h3>
						<strong><p style = 'font-size:1.1em;'>Un día como hoy nacieron las siguientes personas:</strong> </p></br>"."
						<ul>";
	while($row = mysql_fetch_array($sql)){
		//echo $row['nombre_empleado']." - ".$row['fecha_nacimiento']."</br>";
		$texto .="<li>
					<span style = 'color:red;'>".$row['nombre_empleado']."</span>
				</li>";
	}
	$para = "Martin Pinzon <martin.pinzon@toro-love.com>,Martin Pinzon <martin.pinzon@grupolaestacion.com>";
	$sql = mysql_query("select nombre_empleado,fecha_nacimiento from empleado where month(fecha_nacimiento) = month(SYSDATE()) AND day(fecha_nacimiento) = day(SYSDATE())");
	if(mysql_num_rows($sql) != 0){
		if(mail($para, $asunto, utf8_decode($texto."</ul>"), $cabecera)) {
			echo 'Correo enviado</BR>';
		}
	}
	else {
		echo 'Nadie Cumple Años hoy !!';
	}
	
	
	
	
?>
</html>
