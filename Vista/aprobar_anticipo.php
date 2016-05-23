<?php
	include("../Controller/Conexion.php");
	
	$user = $_POST['user'];
	$id = $_POST['id'];//NUMERO DEL ANTICIPO
	$estado = $_POST['estado'];
	$id_pendiente = $_POST['pen'];
	
	
	
	//LIMPIO PENDIENTES
	mysql_query("update pendientes_anticipos set estado = '0' where id = '$id_pendiente'");
	
	if($estado == 1){
		//INSERTO LA APROBACIÓN EN LA TABLA CORRESPONDIENTE
		mysql_query("insert into estatus_anticipos(pk_anticipo,estado,useraprobado)
		values('$id','$estado','$user')");
		
		//NOTIFICO EL ANTICIPO A LA PERSONA DE CONTABILIDAD
		$sql_buscar_financiero = mysql_query("select aa.asignado
		from usuario u, empleado e, und un, estructura_aprobaciones_anticipos est,asignados_estructura_anticipos aa
		where u.idusuario = '$user' and u.pk_empleado = e.documento_empleado and e.und = un.id
		and un.id = est.unidad and est.orden = '2' and est.id = aa.pk_est_anticipo");
		
		$id_asignado = 0;
		while($row = mysql_fetch_assoc($sql_buscar_financiero)){
			$id_asignado = $row[0];
		}
		//Guardo en la tabla correspondiente la información de la notificación del usaurio que aprueba el anticipo.
		mysql_query("insert into pendientes_anticipos(pk_ant,estado,user) values('$id','1','$id_asignado')");
	}else if($estado == 0){
		$observaciones = $_POST['observ'];
		//INSERTO LA APROBACIÓN EN LA TABLA CORRESPONDIENTE
		mysql_query("insert into estatus_anticipos(pk_anticipo,estado,useraprobado,observaciones)
		values('$id','$estado','$user','$observaciones')");
	}
	
	
?>