<?php
	include("../Controller/Conexion.php");
	$user = $_POST['user'];
	$sql = mysql_query("select ie.nombre,ie.correo
	from usuario u, empleado e, informe_entrevista_correos ie
	where u.idusuario = '$user' and u.pk_empleado = e.documento_empleado and e.und = ie.und and ie.estado = '1' order by ie.nombre asc");
	
	$est = "";
	while($row = mysql_fetch_array($sql)){
		$est.=$row['nombre']."-".$row['correo']."*****";
	}
	echo $est;
?>