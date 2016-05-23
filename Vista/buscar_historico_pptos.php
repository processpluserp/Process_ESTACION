<?php
	include("../Controller/Conexion.php");
	
	$user = $_POST['user'];
	$tipo = $_POST['tipo'];
	$input = $_POST['input'];
	$select = $_POST['select'];
	
	
	$sql_adicional = "";
	if($tipo == 'EST'){
		$sql_adicional = " and est.estado_aprobacion = '$select'";
	}else if($tipo == 'FECS'){
		$sql_adicional = " and ap.fecha like '$input%'";
	}else if($tipo == 'FECR'){
		$sql_adicional = " and est.fecha like '$input%'";
	}else if($tipo == 'PPTOINT'){
		$sql_adicional = " and p.codigo_presup = '$input'";
	}else if($tipo == 'PPTOEXT'){
		$sql_adicional = " and p.numero_presupuesto = '$input'";
	}else if($tipo == 'REF'){
		$sql_adicional = " and p.referencia like '%$input%'";
	}else if($tipo == 'ENV'){
		$sql_adicional = " and e.nombre_empleado like '%$input%'";
	}
	
	$sql = mysql_query("select p.referencia,p.vi,p.vc,p.codigo_presup,est.fecha AS fecha_aprobacion, e.nombre_empleado,ap.fecha as fecha_solicitud,est.estado_aprobacion,ap.porcentaje, est.observaciones,p.numero_presupuesto
	from estatus_aprobaciones est, apropresup_histo ap, usuario u, empleado e, cabpresup p
	where est.user = '$user' and est.pk_id = ap.id and ap.ppto = p.codigo_presup and ap.user = u.idusuario and
	u.pk_empleado = e.documento_empleado $sql_adicional order by est.fecha desc");
	
	
	$estructura = "
	<table width = '100%' class = 'tablas_muestra_datos_tablas_trafico'>
		<tr>
				<th nowrap>PPTO INT</th>
				<th nowrap>PPTO EXT</th>
				<th>REFERENCIA</th>
				<th># ANT.</th>
				<th>RADICADO POR</th>
				<th>FECHA DE SOLICITUD</th>
				<th>ESTADO</th>
				<th>FECHA DE RESPUESTA</th>
				<th>OBSERVACIONES</th>
			</tr>";
	
	while($row = mysql_fetch_array($sql)){
		$estado = "";
		if($row['estado_aprobacion'] == 1){
			$estado = "APROBADO";
		}else{
			$estado = "RECHAZADO";
		}
		$estructura.="<tr>
			<td>".$row['codigo_presup']." V ".$row['vi']."</td>
			<td>".$row['numero_presupuesto']." V ".$row['vc']."</td>
			<td style = 'text-align:left;padding-left:10px;'>".$row['referencia']."</td>
			<td>".$row['porcentaje']."</td>
			<td style = 'text-align:left;padding-left:10px;'>".$row['nombre_empleado']."</td>
			<td>".$row['fecha_solicitud']."</td>
			<td style = 'text-align:left;padding-left:10px;'>".$estado."</td>
			<td>".$row['fecha_aprobacion']."</td>
			<td style = 'text-align:left;padding-left:10px;'>".nl2br($row['observaciones'])."</td>
		</tr>";
	}
	$estructura.="</table></div>";
	echo $estructura;
?>