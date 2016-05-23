<?php
	include("../Controller/Conexion.php");
	
	$user = $_POST['user'];

	$sql = mysql_query("select p.vc,p.vi,p.numero_presupuesto,p.codigo_presup, e.nombre_empleado,appto.fecha,p.referencia,appto.id,estp.estado as estado_aprobacion,estp.fecha_estado,estp.observaciones
	from estatus_anticipos estp, anticipos_ppto appto, cabpresup p, empleado e, usuario u
	where estp.useraprobado = '$user' and estp.pk_anticipo = appto.id and appto.user = u.idusuario and u.pk_empleado = e.documento_empleado and
	appto.ppto = p.codigo_presup order by estp.fecha_estado desc");
	$estructura = "
	<table class = 'barra_filtros'>
		<tr>
			<td>
				<select id = 'filtro_ant_revisados' class = 'entradas_bordes' style = 'background-color: rgb(221, 221, 221);' onchange = 'select_historico_ant();'>
					<option value = '0'>[SELECCIONE]</option>
					<option value = 'PPTOINT'>PPTO INT</option>
					<option value = 'PPTOEXT'>PPTO EXT</option>
					<option value = 'REF'>REFERENCIA</option>
					<option value = 'ANT'># ANTICIPO</option>
					<option value = 'ENV'>RADICADO POR</option>
					<option value = 'FECS'>FECHA SOLICITUD</option>
					<option value = 'EST'>ESTADO</option>
					<option value = 'FECR'>FECHA ESTADO</option>
				</select>
			</td>
			<td style = 'padding-left:10px;'>
				<input type = 'text' id = 'input_general_ant_revisados' class = 'entradas_bordes filtros_buscar_ppto_revisados' style = 'background-color: rgb(221, 221, 221);' placeholder = 'Ingrese la información'/>
				<select id = 'buscar_estado_ant_revisados' class = 'entradas_bordes filtros_buscar_ppto_revisados hidde'  style = 'background-color: rgb(221, 221, 221);'>
					<option value ='1'>APROBADO</option>
					<option value ='0'>NO APROBADO</option>
				</select>
			</td>
			<td>
				<img src = '../images /iconos/lupa_verde.png' width = '45px' onclick = 'buscar_historico_ant();'/>
			</td>
			<td nowrap>
				<span class = 'botton_verde' onclick = 'cargar_historico_aprobaciones_ant()'>Ver todo</span>
			</td>
		</tr>
		<tr><td></td></tr>
	</table>
	<script type = 'text/javascript'>
		$('.fechas_filtrado').datepicker({ dateFormat: 'yy-mm-dd' });
	</script>
	<div style = 'overflow: scroll; border-radius: 0.3em; height: 606.98px;background-color: rgb(221, 221, 221);' class = 'contenedor_listado_historico_ant'>
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