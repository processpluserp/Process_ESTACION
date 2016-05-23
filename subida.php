<!DOCTYPE html>
	<html>
	
<?php
	require("Controller/Conexion.php");
	$fecha = date("Y-m-d");
	$nuevafecha  = strtotime ( '+1 day' , strtotime ( $fecha ) );
	echo "...".date ( 'Y-m-d' , $nuevafecha );
	
	$sql_cumple = mysql_query("select nombre_empleado, month(fecha_nacimiento) as mes, day(fecha_nacimiento) as dia from empleado where  month(fecha_nacimiento) = '".date("m")."'");
			while($row = mysql_fetch_array($sql_cumple)){
				$temp_fecha = date("Y-m")."-".$row['dia'];
				$nuevafecha  = strtotime ( '+1 day' , strtotime ( $temp_fecha ) );
				
				echo "<->".strtoupper($row['nombre_empleado'])."*---*".date("Y")."-".date("m")."-".$row['dia']." 00:00:00*---*".date ( 'Y-m-d' , $nuevafecha )." 00:00:00*---*#EF8C14*---*true</br>";
			}
?>
</html>
