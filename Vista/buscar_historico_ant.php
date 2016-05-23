<?php
	include("../Controller/Conexion.php");
	
	$user = $_POST['user'];
	$tipo = $_POST['tipo'];
	$input = $_POST['input'];
	$select = $_POST['select'];
	
	
	$sql_adicional = "";
	if($tipo == 'EST'){
		$sql_adicional = " and estp.estado = '$select'";
	}else if($tipo == 'FECS'){
		$sql_adicional = " and appto.fecha like '$input%'";
	}else if($tipo == 'FECR'){
		$sql_adicional = " and estp.fecha_estado like '$input%'";
	}else if($tipo == 'PPTOINT'){
		$sql_adicional = " and p.codigo_presup = '$input'";
	}else if($tipo == 'PPTOEXT'){
		$sql_adicional = " and p.numero_presupuesto = '$input'";
	}else if($tipo == 'REF'){
		$sql_adicional = " and p.referencia like '%$input%'";
	}else if($tipo == 'ENV'){
		$sql_adicional = " and e.nombre_empleado like '%$input%'";
	}else if($tipo == 'ANT'){
		$sql_adicional = " and appto.id = '$input'";
	}
	
	$sql = mysql_query("select p.vc,p.vi,p.numero_presupuesto,p.codigo_presup, e.nombre_empleado,appto.fecha,p.referencia,appto.id,estp.estado as estado_aprobacion,estp.fecha_estado,estp.observaciones
	from estatus_anticipos estp, anticipos_ppto appto, cabpresup p, empleado e, usuario u
	where estp.useraprobado = '$user' and estp.pk_anticipo = appto.id and appto.user = u.idusuario and u.pk_empleado = e.documento_empleado and
	appto.ppto = p.codigo_presup $sql_adicional order by estp.fecha_estado desc");
	
	
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
			<td style = 'text-align:center;'>".$row['id']."</td>
			<td style = 'text-align:left;padding-left:10px;'>".$row['nombre_empleado']."</td>
			<td style = 'text-align:center;'>".$row['fecha']."</td>
			<td style = 'text-align:left;padding-left:10px;'>".$estado."</td>
			<td>".$row['fecha_estado']."</td>
			<td style = 'text-align:left;padding-left:10px;'>".nl2br($row['observaciones'])."</td>
		</tr>";
	}
	$estructura.="</table></div>";
	echo $estructura;
?>