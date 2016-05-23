<?php
	include("../Controller/Conexion.php");
	
	$ppto = $_POST['ppto'];
	$vi = $_POST['vi'];
	$vc = $_POST['vc'];
	$items = $_POST['items'];
	$valores = $_POST['valores'];
	$user = $_POST['user'];
	
	$fecha_plata = $_POST['finicial'];
	$fecha_legalizacion = $_POST['flega'];
	
	mysql_query("start transaction");
		
		
		//Guardo la información del anticipo:
		mysql_query("insert into anticipos_ppto(ppto,vi,vc,user,fecha_plata,fecha_legalizacion)
		values('$ppto','$vi','$vc','$user','$fecha_plata','$fecha_legalizacion')");
		
		$id_ant = 0;
		$sql_consult = mysql_query("SELECT @@identity AS id");
		$id = "";
		
		while($row = mysql_fetch_row($sql_consult)){
			$id = $row[0];
		}
		
		//PREGUNTO A QUIÉN DEBO NOTIFICAR SEGÚN LA UNIDAD DE NEGOCIO A LA CUAL PERTENECE EL EMPLEADO
		$sql_persona_user = mysql_query("select aea.asignado
		from asignados_estructura_anticipos aea, usuario u, empleado e, und un, estructura_aprobaciones_anticipos ean
		where u.idusuario = '$user' and u.pk_empleado = e.documento_empleado and e.und = un.id
		and un.id = ean.unidad and ean.id = aea.pk_est_anticipo and ean.orden = '1'");
		
		$persona_notifica = array();
		while($row = mysql_fetch_array($sql_persona_user)){
			$persona_notifica[] =  $row['asignado'];
		}
		
		//Guardo en la tabla correspondiente la información de la notificación del usaurio que aprueba el anticipo.
		for($i = 0;$i < count($persona_notifica);$i++){
			mysql_query("insert into pendientes_anticipos(pk_ant,estado,user) values('$id','1','$persona_notifica[$i]')");
		}
		
		
		//ESPACIO PARA GENERAR MAIL DE NOFICIACION A LA PERSONA CORRESPONDIENTE
		
		for($i = 0; $i < count($items); $i++){
			mysql_query("insert into cuerpo_anticipo(pk_anticipo,pk_item,porcentaje) values
			('$id','$items[$i]','$valores[$i]')");
		}
		echo $id;
	mysql_query("commit");
?>