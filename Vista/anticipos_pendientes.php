<?php
	include("../Controller/Conexion.php");
	$user = $_POST['user'];
	$sql_pendientes_anticipos = mysql_query("select pa.id,e.nombre_empleado, p.referencia,appto.id as num_anticipo, appto.fecha,appto.fecha_plata,p.codigo_presup
	from pendientes_anticipos pa, anticipos_ppto appto, cabpresup p, empleado e, usuario u
	where pa.user = '$user' and pa.pk_ant = appto.id and appto.ppto = p.codigo_presup 
	and appto.user = u.idusuario and u.pk_empleado = e.documento_empleado and pa.estado = '1'");
	$est_anticipos_pendientes = "<table width = '100%' class = 'tablas_muestra_datos_tablas_trafico'>
		<tr>
			<th></th>
			<th># ANTICIPO</th>
			<th>FECHA DE SOLICITUD</th>
			<th>SOLICITADO POR</th>
			<th># PPTO</th>
			<th>REFERENCIA PPTO</th>
		</tr>
	";
	while($row = mysql_fetch_array($sql_pendientes_anticipos)){
		$id_anticipo = $row['num_anticipo'];
		$est_anticipos_pendientes.="<tr>
			<td>
				<input type = 'radio'  name = 'select_anticipo_pendiente' id = 'anticipo_apro$id_anticipo' value = '".$row['num_anticipo']."'  class = 'radio mano' onclick = 'abrir_visual_anticipo($id_anticipo,".$row['id'].")'/>
				<label for='anticipo_apro$id_anticipo' ><span ><span ></span></span></label>
			</td>
			<td >$id_anticipo</td>
			<td>".$row['fecha']."</td>
			<td>".utf8_decode($row['nombre_empleado'])."</td>
			<td>".$row['codigo_presup']."</td>
			<td>".html_entity_decode($row['referencia'])."</td>
		</tr>";
	}
	$est_anticipos_pendientes.="</table>";
	echo $est_anticipos_pendientes;
?>