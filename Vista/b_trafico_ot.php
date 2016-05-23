<?php

	$sql = "";
		$emp = $_POST['emp'];
		//$clie = $_POST['clie'];
		$fd = $_POST['fd'];
		$fh = $_POST['fh'];
		//$_SESSION['cod_emp_rot'] = $_POST['emp'];
		//$_SESSION['cod_clie_rot'] = $_POST['clie'];
		//$_SESSION['cod_fd_rot'] = $_POST['fd'];
		//$_SESSION['cod_fh_rot'] = $_POST['fh'];
		if($emp == 0){
			$sql = "select e.nombre_comercial_empresa, count(ot.codigo_ot) as ots, e.cod_interno_empresa
			from empresa e, clientes c, producto_clientes pr, cabot ot,empleado eje, usuario u1,empleado dir, usuario u2
			where ot.pk_nit_empresa_ot = e.cod_interno_empresa and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente and
			ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
			and ot.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado and 
			ot.producto_clientes_codigo_PRC = pr.id_procliente and date_format(ot.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh' group by e.cod_interno_empresa";
		}else{
			$sql = "select e.nombre_comercial_empresa, count(ot.codigo_ot) as ots, e.cod_interno_empresa
			from empresa e, clientes c, producto_clientes pr, cabot ot,empleado eje, usuario u1,empleado dir, usuario u2
			where ot.pk_nit_empresa_ot = '$emp' and 
			ot.pk_nit_empresa_ot = e.cod_interno_empresa and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente
			 and ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
			and ot.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado and 
			ot.producto_clientes_codigo_PRC = pr.id_procliente and date_format(ot.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh' group by e.cod_interno_empresa";
		}
		$values = array(
        array('Task', 'Hours Per Day'),
        array('Work', 11),
        array('Eat', 2),
        array('Commute', 2),
        array('Watch TV', 2),
        array('Sleep', 7),
    );
	echo json_encode($values);
		
		
		
	?>