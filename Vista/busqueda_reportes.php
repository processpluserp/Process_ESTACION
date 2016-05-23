<?php
	include("../Controller/Conexion.php");	
	$t = $_POST['t'];
	$tabla_reporte_ot = "<div class = 'contenedor_scroll_reportes'><div id = 'imp_ot'><table id = 'tabla_reportes_ot' class = 'tablas_reportes' width = '100%'>
		<tr>
			<th >EMPRESA</th>
			<th>CLIENTE</th>
			<th>PRODUCTO</th>
			<th>OT</th>
			<th>DIRECTOR</th>
			<th>EJECUTIVO</th>
			<th>ESTADO</th>
			<th>FECHA</th>
		</tr>";
	$tabla_reporte_tareas = "<table id = 'tabla_reporte_tareas' class = 'tablas_reportes' width = '100%'>
	<thead><tr>
			<th>EMPRESA</th>
			<th>CLIENTE</th>
			<th>PRODUCTO</th>
			<th>OT</th>
			<th>DIRECTOR</th>
			<th>EJECUTIVO</th>
			<th>REFERENCIA</th>
			<th>DESCRIPCION</th>
			<th>ESTADO</th>
			<th>FECHA</th>
			<th nowrap># TAREA</th>
			<th nowrap>TIPO TAREA</th>
			<th nowrap>FECHA TAREA</th>
			<th nowrap>REFERENCIA TAREA</th>
			<th>DESCRIPCION TAREA</th>
			<th>RESPONSABLE</th>
			<th>ASIGNADO</th>
			<th>DEPARTAMENTO</th>
			<th nowrap>RADICADO POR</th>
			<th nowrap>ESTADO TAREA</th>
			<th nowrap>FECHA PROMETIDA</th>
			<th nowrap>HORA PROMETIDA</th>
			<th nowrap>FECHA ENTREGA</th>
			<th nowrap>HORA ENTREGA</th>
	</tr></thead>";
	/*EMPRESA - CLIENTE*/
	
	$option = "<option value = '0'>TODOS</option>";
	if($t == 1){
		
		$emp = $_POST['emp'];
		$usu = $_POST['usu'];
		$consulta_empresa = "select distinct e.codigo_interno_cliente, e.nombre_comercial_cliente from clientes e, pcliepro c where e.estado = 1 and 
		c.cod_cliente = e.codigo_interno_cliente and c.pk_empresa = '$emp' and c.cod_usuario = '$usu'";
		$result2 = mysql_query($consulta_empresa);
		while($row = mysql_fetch_array($result2)){
			$option .= "<option value = ".$row['codigo_interno_cliente'].">".$row['nombre_comercial_cliente']."</option>";
		}
		echo $option;
	}
	
	/*Reporte de OT*/
	else if($t == 2){
		$sql = "";
		$emp = $_POST['emp'];
		$clie = $_POST['clie'];
		$fd = $_POST['fd'];
		$fh = $_POST['fh'];
		$_SESSION['cod_emp_rot'] = $_POST['emp'];
		$_SESSION['cod_clie_rot'] = $_POST['clie'];
		$_SESSION['cod_fd_rot'] = $_POST['fd'];
		$_SESSION['cod_fh_rot'] = $_POST['fh'];
		if($emp == 0){
			$sql = "select e.nombre_comercial_empresa, c.nombre_comercial_cliente, pr.nombre_producto,ot.codigo_ot,ot.estado,ot.director, ot.ejecutivo,ot.fecha_registro,
			eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
			from empresa e, clientes c, producto_clientes pr, cabot ot,empleado eje, usuario u1,empleado dir, usuario u2
			where ot.pk_nit_empresa_ot = e.cod_interno_empresa and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente and
			ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
			and ot.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado and 
			ot.producto_clientes_codigo_PRC = pr.id_procliente and date_format(ot.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh'";
		}else{
			if($clie == 0){
				$sql = "select e.nombre_comercial_empresa, c.nombre_comercial_cliente, pr.nombre_producto,ot.codigo_ot,ot.estado,ot.director, ot.ejecutivo,ot.fecha_registro,
				eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
				from empresa e, clientes c, producto_clientes pr, cabot ot,empleado eje, usuario u1,empleado dir, usuario u2
				where ot.pk_nit_empresa_ot = '$emp' and 
				ot.pk_nit_empresa_ot = e.cod_interno_empresa and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente
				 and ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
				and ot.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado and 
				ot.producto_clientes_codigo_PRC = pr.id_procliente and date_format(ot.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh'";
			}else{
				$sql = "select e.nombre_comercial_empresa, c.nombre_comercial_cliente, pr.nombre_producto,ot.codigo_ot,ot.estado,ot.director, ot.ejecutivo,ot.fecha_registro,
				eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director				
				from empresa e, clientes c, producto_clientes pr, cabot ot,empleado eje, usuario u1,empleado dir, usuario u2
				where ot.pk_nit_empresa_ot = '$emp' and ot.producto_clientes_pk_clientes_nit_procliente = '$clie' and
				ot.pk_nit_empresa_ot = e.cod_interno_empresa and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente and
				ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
				and ot.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado and 
				ot.producto_clientes_codigo_PRC = pr.id_procliente and date_format(ot.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh'";
			}
		}
		$r = mysql_query($sql);
		while($row = mysql_fetch_array($r)){
			$text = "";
			if($row['estado'] == 2){
				$text ="CERRADA";
			}else{
				$text ="ACTIVA";
			}
			$tabla_reporte_ot .= "<tr>
				<td>".$row['nombre_comercial_empresa']."</td>
				<td>".$row['nombre_comercial_cliente']."</td>
				<td>".$row['nombre_producto']."</td>
				<td align = 'center'>".$row['codigo_ot']."</td>
				<td>".$row['director']."</td>
				<td>".$row['ejecutivo']."</td>
				<td align = 'center'>".$text."</td>
				<td align = 'center'>".$row['fecha_registro']."</td>
			</tr>";
		}
		echo $tabla_reporte_ot."</table>";
	}
	
	/*REPORTE DE TAREAS*/
	
	//Consulta de departamento por empresa
	else if($t == 3){
		$emp = $_POST['emp'];
		$consulta_empresa = "select a.codigo_interno_empresa, a.nombre_area_empresa from area_empresa a where a.pk_empresa_areas = '$emp'";
		$result2 = mysql_query($consulta_empresa);
		while($row = mysql_fetch_array($result2)){
			$option .= "<option value = ".$row['codigo_interno_empresa'].">".$row['nombre_area_empresa']."</option>";
		}
		echo $option;
	}
	
	/*REPORTE DE TAREAS*/
	else if($t == 4){
		$emp = $_POST['emp'];
		
		$sql_emp = "";
		$clie = $_POST['clie'];
		$sql_clie = "";
		$fd = $_POST['fd'];
		$fh = $_POST['fh'];
		$depto = $_POST['depto'];
		$sql_depto = "";
		$tareas = $_POST['tar'];
		$sql = "";
		$ste = "";
		
		$_SESSION['emp'] = $emp;
		$_SESSION['clie'] = $clie;
		$_SESSION['fd'] = $fd;
		$_SESSION['fh'] = $fh;
		$_SESSION['tareas'] = $tareas;
		$_SESSION['depto'] = $depto;
		if($tareas == 2){
			$ste = "";
		}else{
			$ste = "and t.estado = '$tareas'";
		}
		if($clie != 0){
			$sql_clie = "and ot.producto_clientes_pk_clientes_nit_procliente = '$clie'";
		}
		if($depto != 0){
			$sql_depto = "and t.codigo_departamento = '$depto'";
		}
		if($emp != 0){
			$sql_emp = "and ot.pk_nit_empresa_ot = '$emp'";
			
		}
		$sql = "select e.nombre_comercial_empresa, c.nombre_comercial_cliente, pr.nombre_producto,ot.codigo_ot,ot.estado as estado_ot,ot.fecha_registro,ot.descripcion,ot.referencia,
			tr.codigo, eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director, t.*, tp.name_ttarea, t.fecha_registro as fecha_re, ra.nombre_empleado as radicado_por
			
			from empresa e, clientes c, producto_clientes pr, cabot ot,tareas t , flujo_tareas tr,tipo_tarea tp,
			empleado eje, empleado dir, usuario u1, usuario u2, empleado ra, usuario u3
			
			where ot.director  = u1.idusuario and u1.pk_empleado = eje.documento_empleado and ot.ejecutivo = u2.idusuario and u2.pk_empleado = dir.documento_empleado and
			t.usuario = u3.idusuario and u3.pk_empleado = ra.documento_empleado and 
			ot.pk_nit_empresa_ot = e.cod_interno_empresa and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente and
			ot.producto_clientes_codigo_PRC = pr.id_procliente and ot.codigo_ot = t.pk_ot and t.codigo_int_tarea= tr.consecutivo and
			t.tipo_tarea_codigo_tipotarea = tp.codigo_tipotarea $sql_emp $sql_clie
			and t.fecha_prometida between '$fd' and '$fh' AND ot.codigo_ot = 'CLP0388-16' order by ot.fecha_registro asc";
		
		$r = mysql_query($sql);
		while($row = mysql_fetch_array($r)){
			$text = "";
			if($row['estado_ot'] == 2){
				$text ="CERRADA";
			}else{
				$text ="ACTIVA";
			}
			$sql_tareas = mysql_query("select t.*, tp.name_ttarea, t.fecha_registro as fecha_re, ra.nombre_empleado as radicado_por,tr.codigo, dep.name_depto
			from tareas t , flujo_tareas tr, tipo_tarea tp, empleado ra, usuario u3,deptos_trafico dep
			where t.usuario = u3.idusuario and u3.pk_empleado = ra.documento_empleado and t.codigo_int_tarea= tr.consecutivo and t.codigo_departamento = dep.id and 
			t.tipo_tarea_codigo_tipotarea = tp.codigo_tipotarea $ste $sql_depto and t.pk_ot = '".$row['codigo_ot']."'
			and t.fecha_prometida between '$fd' and '$fh' order by t.codigo_int_tarea asc");
			while($rowx = mysql_fetch_array($sql_tareas)){
				$sql_responsable = mysql_query("select e.nombre_empleado as responsable
				from empleado e, usuario u, asignados_tareas atx
				where atx.pk_tarea = '".$rowx['codigo_int_tarea']."' and atx.pk_asignado = u.idusuario and u.pk_empleado = e.documento_empleado and atx.tipo = 'RES'");
				$responsable = "";
				while($rs = mysql_fetch_array($sql_responsable)){
					$responsable .=$rs['responsable']."</br>";
				}
				
				$sql_responsable = mysql_query("select e.nombre_empleado as responsable
				from empleado e, usuario u, asignados_tareas at
				where at.pk_tarea = '".$rowx['codigo_int_tarea']."' and at.pk_asignado = u.idusuario and u.pk_empleado = e.documento_empleado and at.tipo = 'ASI'");
				$asignado = "";
				while($rs = mysql_fetch_array($sql_responsable)){
					$asignado .=$rs['responsable']."</br>";
				}
				
				$text2 = "";
				if($rowx['estado'] == 0){
					$text2 ="PENDIENTE";
				}else if($rowx['estado'] == 1){
					$text2 ="CONTESTADA";
				}else{
					$text2 ="CANCELADA";
				}
				
				$val = "";
					if($rowx['codigo'] == 0){
						$val = "";
					}else{
						$val = ".".$rowx['codigo'];
					}
				$tabla_reporte_tareas .="<tr>
					<td nowrap>".$row['nombre_comercial_empresa']."</td>
					<td nowrap>".$row['nombre_comercial_cliente']."</td>
					<td nowrap>".$row['nombre_producto']."</td>
					<td nowrap>".$row['codigo_ot']."</td>
					<td nowrap>".$row['director']."</td>
					<td nowrap>".$row['ejecutivo']."</td>
					<td>".strtoupper($row['referencia'])."</td>
					<td>".strtoupper($row['descripcion'])."</td>
					<td>".$text."</td>
					<td nowrap>".$rowx['fecha_registro']."</td>
					<td>".$rowx['codigo_tarea'].$val."</td>
					<td>".utf8_encode($rowx['name_ttarea'])."</td>
					<td nowrap>".$rowx['fecha_re']."</td>
					<td>".$rowx['trabajo']."</td>
					<td>".$rowx['descripcion']."</td>
					<td nowrap>".$responsable."</td>
					<td nowrap>".$asignado."</td>
					<td nowrap>".$rowx['nombre_area_empresa']."</td>
					<td nowrap>".$rowx['radicado_por']."</td>
					<td nowrap>".$text2."</td>
					<td nowrap>".$rowx['fecha_prometida']."</td>
					<td nowrap>".$rowx['hora_p'].":".$rowx['minutos_p']." ".$rowx['formato']."</td>
					<td nowrap>".$rowx['fecha_r']."</td>
					<td nowrap>".$rowx['hora_r']."</td>
				</tr>";
			}
			
			
		}
		echo $tabla_reporte_tareas."</table>";
	}

	else if ($t == 5){
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
		$r = mysql_query($sql);
		$val = "";
		$datt = array();
		while($row = mysql_fetch_array($r)){
			$val .= "<->".$row['nombre_comercial_empresa']."*---*".$row['ots']."*---*".$row['cod_interno_empresa'];
		}
		echo $val;
	}
	else if ($t == 6){
		$sql = "";
		$emp = $_POST['emp'];
		$est = $_POST['est'];
		$dir = $_POST['dir'];
		$eje = $_POST['eje'];
		//$clie = $_POST['clie'];
		$fd = $_POST['fd'];
		$fh = $_POST['fh'];
		//$_SESSION['cod_emp_rot'] = $_POST['emp'];
		//$_SESSION['cod_clie_rot'] = $_POST['clie'];
		//$_SESSION['cod_fd_rot'] = $_POST['fd'];
		//$_SESSION['cod_fh_rot'] = $_POST['fh'];
		$sql = "select c.nombre_comercial_cliente, count(ot.codigo_ot) as ots, c.codigo_interno_cliente
			from empresa e, clientes c, producto_clientes pr, cabot ot,empleado eje, usuario u1,empleado dir, usuario u2
			where ot.pk_nit_empresa_ot = '$emp' and ot.estado = '$est' and ot.director = '$dir' and ot.ejecutivo = '$eje' and
			ot.pk_nit_empresa_ot = e.cod_interno_empresa and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente
			 and ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
			and ot.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado and 
			ot.producto_clientes_codigo_PRC = pr.id_procliente and date_format(ot.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh' group by c.codigo_interno_cliente";
		$r = mysql_query($sql);
		$val = "";
		$datt = array();
		while($row = mysql_fetch_array($r)){
			$val .= "<->".$row['nombre_comercial_cliente']."*---*".$row['ots']."*---*".$row['codigo_interno_cliente'];
		}
		echo $val;
	}
	
	else if ($t == 7){
		$sql = "";
		$emp = $_POST['emp'];
		$est = $_POST['est'];
		$dir = $_POST['dir'];
		$clie = $_POST['clie'];
		$eje = $_POST['eje'];
		//$clie = $_POST['clie'];
		$fd = $_POST['fd'];
		$fh = $_POST['fh'];
		//$_SESSION['cod_emp_rot'] = $_POST['emp'];
		//$_SESSION['cod_clie_rot'] = $_POST['clie'];
		//$_SESSION['cod_fd_rot'] = $_POST['fd'];
		//$_SESSION['cod_fh_rot'] = $_POST['fh'];
		$sql = "select pr.nombre_producto, count(ot.codigo_ot) as ots, pr.id_procliente
			from empresa e, clientes c, producto_clientes pr, cabot ot,empleado eje, usuario u1,empleado dir, usuario u2
			where ot.pk_nit_empresa_ot = '$emp' and ot.producto_clientes_pk_clientes_nit_procliente = '$clie' and ot.estado = '$est' and ot.director = '$dir' and ot.ejecutivo = '$eje' and
			ot.pk_nit_empresa_ot = e.cod_interno_empresa and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente
			 and ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
			and ot.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado and 
			ot.producto_clientes_codigo_PRC = pr.id_procliente and date_format(ot.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh' group by pr.id_procliente";
		$r = mysql_query($sql);
		$val = "";
		$datt = array();
		while($row = mysql_fetch_array($r)){
			$val .= "<->".$row['nombre_producto']."*---*".$row['ots']."*---*".$row['id_procliente'];
		}
		echo $val;
	}
	
	else if($t == 8){
		$sql = "";
		$emp = $_POST['id'];
		//$clie = $_POST['clie'];
		$fd = $_POST['fd'];
		$fh = $_POST['fh'];
		//$_SESSION['cod_emp_rot'] = $_POST['emp'];
		//$_SESSION['cod_clie_rot'] = $_POST['clie'];
		//$_SESSION['cod_fd_rot'] = $_POST['fd'];
		//$_SESSION['cod_fh_rot'] = $_POST['fh'];
		$sql = "select ot.estado as name, count(ot.codigo_ot) as ots, ot.estado
			from empresa e, clientes c, producto_clientes pr, cabot ot,empleado eje, usuario u1,empleado dir, usuario u2
			where ot.pk_nit_empresa_ot = '$emp' and 
			ot.pk_nit_empresa_ot = e.cod_interno_empresa and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente
			 and ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
			and ot.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado and 
			ot.producto_clientes_codigo_PRC = pr.id_procliente and date_format(ot.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh' group by ot.estado";
		$r = mysql_query($sql);
		$val = "";
		$datt = array();
		while($row = mysql_fetch_array($r)){
			$text = "";
			if($row['name'] == 1){
				$text ="ABIERTAS";
			}else{
				$text ="CERRADAS";
			}
			$val .= "<->".$text."*---*".$row['ots']."*---*".$row['estado'];
		}
		echo $val;
	}
	
	else if($t == 9){
		$sql = "";
		$emp = $_POST['emp'];
		//$clie = $_POST['clie'];
		$est = $_POST['est'];
		$fd = $_POST['fd'];
		$fh = $_POST['fh'];
		//$_SESSION['cod_emp_rot'] = $_POST['emp'];
		//$_SESSION['cod_clie_rot'] = $_POST['clie'];
		//$_SESSION['cod_fd_rot'] = $_POST['fd'];
		//$_SESSION['cod_fh_rot'] = $_POST['fh'];
		$sql = "select dir.nombre_empleado, count(ot.codigo_ot) as ots, ot.director
			from empresa e, clientes c, producto_clientes pr, cabot ot,empleado eje, usuario u1,empleado dir, usuario u2
			where ot.pk_nit_empresa_ot = '$emp' and ot.estado = '$est' and 
			ot.pk_nit_empresa_ot = e.cod_interno_empresa and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente
			 and ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
			and ot.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado and 
			ot.producto_clientes_codigo_PRC = pr.id_procliente and date_format(ot.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh' group by ot.director";
		$r = mysql_query($sql);
		$val = "";
		$datt = array();
		while($row = mysql_fetch_array($r)){
			
			$val .= "<->".$row['nombre_empleado']."*---*".$row['ots']."*---*".$row['director'];
		}
		echo $val;
	}
	
	else if ($t == 10){
		$sql = "";
		$emp = $_POST['emp'];
		$est = $_POST['est'];
		$dir = $_POST['dir'];
		$prod = $_POST['prod'];
		$clie = $_POST['clie'];
		$eje = $_POST['eje'];
		$fd = $_POST['fd'];
		$fh = $_POST['fh'];
		$sql = "select trp.name_ttarea, count(tr.codigo_int_tarea) as ots, trp.codigo_tipotarea
			
			from empresa e, clientes c, producto_clientes pr, cabot ot,empleado eje, usuario u1,empleado dir, usuario u2, tareas tr, tipo_tarea trp
			
			where ot.pk_nit_empresa_ot = '$emp' and ot.producto_clientes_pk_clientes_nit_procliente = '$clie' and ot.estado = '$est' and ot.director = '$dir' and ot.ejecutivo = '$eje'
			and ot.producto_clientes_codigo_PRC = '$prod' and ot.pk_nit_empresa_ot = e.cod_interno_empresa 
			and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente and ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
			and ot.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado and ot.codigo_ot = tr.pk_ot and tr.tipo_tarea_codigo_tipotarea = trp.codigo_tipotarea and
			ot.producto_clientes_codigo_PRC = pr.id_procliente and date_format(ot.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh' group by trp.codigo_tipotarea";
		$r = mysql_query($sql);
		$val = "";
		$datt = array();
		while($row = mysql_fetch_array($r)){
			$val .= "<->".strtoupper(utf8_encode($row['name_ttarea']))."*---*".$row['ots']."*---*".$row['codigo_tipotarea'];
		}
		echo $val;
	}
	
	else if ($t == 11){
		$sql = "";
		$emp = $_POST['emp'];
		$est = $_POST['est'];
		$dir = $_POST['dir'];
		$fd = $_POST['fd'];
		$fh = $_POST['fh'];
		//$_SESSION['cod_emp_rot'] = $_POST['emp'];
		//$_SESSION['cod_clie_rot'] = $_POST['clie'];
		//$_SESSION['cod_fd_rot'] = $_POST['fd'];
		//$_SESSION['cod_fh_rot'] = $_POST['fh'];
		$sql = "select eje.nombre_empleado, count(ot.codigo_ot) as ots, ot.ejecutivo
			from empresa e, clientes c, producto_clientes pr, cabot ot,empleado eje, usuario u1,empleado dir, usuario u2
			where ot.pk_nit_empresa_ot = '$emp'  and ot.estado = '$est' and ot.director = '$dir' and
			ot.pk_nit_empresa_ot = e.cod_interno_empresa and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente
			and ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
			and ot.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado and 
			ot.producto_clientes_codigo_PRC = pr.id_procliente and date_format(ot.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh' group by ot.ejecutivo order by count(ot.codigo_ot)";
		$r = mysql_query($sql);
		$val = "";
		$datt = array();
		while($row = mysql_fetch_array($r)){
			$val .= "<->".$row['nombre_empleado']."*---*".$row['ots']."*---*".$row['ejecutivo'];
		}
		echo $val;
	}
	
	else if ($t == 12){
		$sql = "";
		$emp = $_POST['emp'];
		$est = $_POST['est'];
		$dir = $_POST['dir'];
		$prod = $_POST['prod'];
		$clie = $_POST['clie'];
		$eje = $_POST['eje'];
		$fd = $_POST['fd'];
		$fh = $_POST['fh'];
		$tipo_tarea = $_POST['tpt'];
		$sql = "select TIMESTAMPDIFF(second,concat(tr.fecha_prometida,' ',tr.hora_p,':',tr.minutos_p,':00'), tr.fecha_r) AS duracion,trp.codigo_tipotarea
			
			from empresa e, clientes c, producto_clientes pr, cabot ot,empleado eje, usuario u1,empleado dir, usuario u2, tareas tr, tipo_tarea trp
			
			where ot.pk_nit_empresa_ot = '$emp' and ot.producto_clientes_pk_clientes_nit_procliente = '$clie' and ot.estado = '$est' and ot.director = '$dir' and ot.ejecutivo = '$eje'
			and ot.producto_clientes_codigo_PRC = '$prod' and ot.pk_nit_empresa_ot = e.cod_interno_empresa and trp.codigo_tipotarea = '$tipo_tarea'
			and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente and ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
			and ot.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado and ot.codigo_ot = tr.pk_ot and tr.tipo_tarea_codigo_tipotarea = trp.codigo_tipotarea and
			ot.producto_clientes_codigo_PRC = pr.id_procliente and date_format(ot.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh'";
		$r = mysql_query($sql);
		$val = "";
		$datt = array();
		$c = 0;
		$nc = 0;
		$null = 0;
		while($row = mysql_fetch_array($r)){
			if($row['duracion'] <= 0){
				$c++;
			}else if($row['duracion'] == 'NULL'){
				$null++;
			}else{
				$nc++;
			}
			echo $row['duracion']."</br>";
		}
		$val .= "<->A TIEMPO*---*".$c."*---*1";
		$val .= "<->FUERA DE TIEMPO*---*".$nc."*---*0";
		//$val .= "<->VACIO*---*".$null."*---*".$tipo_tarea;
		echo $val;
	}
	
	else if ($t == 13){
		$sql = "";
		$emp = $_POST['emp'];
		$est = $_POST['est'];
		$dir = $_POST['dir'];
		$prod = $_POST['prod'];
		$clie = $_POST['clie'];
		$eje = $_POST['eje'];
		$fd = $_POST['fd'];
		$fh = $_POST['fh'];
		$tipo_tarea = $_POST['tpt'];
		$cumplimiento = $_POST['cumplimiento'];
		$sql = "select distinct depto.nombre_area_empresa,depto.codigo_interno_empresa, count(depto.codigo_interno_empresa) as ots
			
			from empresa e, clientes c, producto_clientes pr, cabot ot,empleado eje, usuario u1,empleado dir, usuario u2, tareas tr, tipo_tarea trp, asignados_tareas atr, area_empresa depto, usuario usu3, empleado e3
			
			
			where ot.pk_nit_empresa_ot = '$emp' and ot.producto_clientes_pk_clientes_nit_procliente = '$clie' and ot.estado = '$est' and ot.director = '$dir' and ot.ejecutivo = '$eje'
			and ot.producto_clientes_codigo_PRC = '$prod' and ot.pk_nit_empresa_ot = e.cod_interno_empresa and trp.codigo_tipotarea = '$tipo_tarea'
			and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente and ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
			and ot.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado and ot.codigo_ot = tr.pk_ot and tr.tipo_tarea_codigo_tipotarea = trp.codigo_tipotarea and tr.codigo_int_tarea = atr.pk_tarea and
			ot.producto_clientes_codigo_PRC = pr.id_procliente and date_format(ot.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh' and atr.tipo = 'ASI' AND
			if(TIMESTAMPDIFF(second,concat(tr.fecha_prometida,' ',tr.hora_p,':',tr.minutos_p,':00'), tr.fecha_r) <= 0,1,0) = '$cumplimiento'
			and atr.pk_asignado = usu3.idusuario and usu3.pk_empleado = e3.documento_empleado and e3.pk_depto = depto.codigo_interno_empresa group by depto.codigo_interno_empresa";
		$r = mysql_query($sql);
		$val = "";
		$datt = array();
		$c = 0;
		$nc = 0;
		$null = 0;
		while($row = mysql_fetch_array($r)){
			$val .= "<->".strtoupper(utf8_encode($row['nombre_area_empresa']))."*---*".$row['ots']."*---*".$row['codigo_interno_empresa'];
		}
		//$val .= "<->A TIEMPO*---*".$c."*---*".$tipo_tarea;
		//$val .= "<->FUERA DE TIEMPO*---*".$nc."*---*".$tipo_tarea;
		//$val .= "<->VACIO*---*".$null."*---*".$tipo_tarea;
		echo $val;
	}
	else if($t == 14){
		$emp = 1;
		$clie = 1;
		$fd = $_POST['fd'];
		$fh = $_POST['fh'];
		$sql = mysql_query("select eje.nombre_empleado, count(ot.codigo_ot) as ots, ot.ejecutivo
			from cabot ot,empleado eje, usuario u1
			where ot.pk_nit_empresa_ot = '$emp' and ot.producto_clientes_pk_clientes_nit_procliente = '$clie'
			and ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and
			
			date_format(ot.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh' group by ot.ejecutivo order by count(ot.codigo_ot) desc");
		$val="";
		
		while($row = mysql_fetch_array($sql)){
			
			$val .= "<->".strtoupper(utf8_encode($row['nombre_empleado']))."*---*".$row['ots']."*---*".$row['ejecutivo'];
		}
		echo $val;
	}
	else if($t == 15){
		$emp = 1;
		$clie = 1;
		$fd = $_POST['fd'];
		$fh = $_POST['fh'];
		$sql = mysql_query("select pc.name_profesional, count(ot.codigo_ot) as ots, pc.codigo_profesional
			from cabot ot, pro_colpatria pc
			where ot.pk_nit_empresa_ot = '$emp' and ot.producto_clientes_pk_clientes_nit_procliente = '$clie' and
			ot.pro_colpatria_codigo_profesional = pc.codigo_profesional
			and date_format(ot.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh' group by ot.pro_colpatria_codigo_profesional order by count(ot.codigo_ot) desc");
		$val="";
		
		while($row = mysql_fetch_array($sql)){
			
			$val .= "<->".strtoupper(utf8_encode($row['name_profesional']))."*---*".$row['ots']."*---*".$row['codigo_profesional'];
		}
		echo $val;
	}
	else if($t == 16){
		$emp = 1;
		$clie = 1;
		$fd = $_POST['fd'];
		$fh = $_POST['fh'];
		$sql = mysql_query("
			SELECT eje.nombre_empleado, count(t.codigo_int_tarea) as tareas, t.usuario
			from tareas t, usuario u, empleado eje
			where t.otpadre like 'CLP%' and t.usuario = u.idusuario and u.pk_empleado = eje.documento_empleado and
			date_format(t.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh' group by t.usuario order by count(t.otpadre) desc");
		$val="";
		
		while($row = mysql_fetch_array($sql)){
			
			$val .= "<->".strtoupper(utf8_encode($row['nombre_empleado']))."*---*".$row['tareas']."*---*".$row['usuario'];
		}
		echo $val;
	}
	else if($t == 17){
		$emp = 1;
		$clie = 1;
		$fd = $_POST['fd'];
		$fh = $_POST['fh'];
		$sql = mysql_query("SELECT prof.name_profesional, count(t.codigo_int_tarea) as tareas, t.pro_colpatria
			from tareas t, pro_colpatria prof
			where t.otpadre like 'CLP%' and t.pro_colpatria = prof.codigo_profesional AND
			date_format(t.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh' group by t.pro_colpatria order by count(t.otpadre) desc");
		$val="";
		
		while($row = mysql_fetch_array($sql)){
			
			$val .= "<->".strtoupper(utf8_encode($row['name_profesional']))."*---*".$row['tareas']."*---*".$row['pro_colpatria'];
		}
		echo $val;
	}
	?>
