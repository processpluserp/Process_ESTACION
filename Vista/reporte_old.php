<?php 
	include("../Controller/Conexion.php");
	$sql = mysql_query("select distinct  t.codigo_int_tarea
		from tareas t, flujo_tareas ft, cabot ot, usuario u2, empleado e2, asignados_tareas ax
		where t.codigo_int_tarea = ft.pk_tarea  and t.estado = '0' and ot.codigo_ot = t.pk_ot

		and t.usuario = u2.idusuario and u2.pk_empleado = e2.documento_empleado 

		and t.codigo_int_tarea = ax.pk_tarea  and ax.pk_ot =ot.id and

		ax.pk_asignado = '18' and( ax.tipo = 'RES' or ax.tipo = 'ASI')");
	while($row = mysql_fetch_array($sql)){
		$id_tarea = $row['codigo_int_tarea'];
		$id = '86';
		mysql_query("update asignados_tareas set pk_asignado = '$id' where tipo = 'ASI' and pk_tarea = '$id_tarea'");
	}
?>