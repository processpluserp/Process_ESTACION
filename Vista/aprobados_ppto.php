<?php
	include("../Controller/Conexion.php");
	
	$user = $_POST['user'];

	$sql = mysql_query("select p.referencia,p.vi,p.vc,p.codigo_presup,est.fecha AS fecha_aprobacion, e.nombre_empleado,ap.fecha as fecha_solicitud,est.estado_aprobacion,ap.porcentaje, est.observaciones,p.numero_presupuesto
	from estatus_aprobaciones est, apropresup_histo ap, usuario u, empleado e, cabpresup p
	where est.user = '$user' and est.pk_id = ap.id and ap.ppto = p.codigo_presup and ap.user = u.idusuario and
	u.pk_empleado = e.documento_empleado order by est.fecha desc");
	$estructura = "
	<table class = 'barra_filtros'>
		<tr>
			<td>
				<select id = 'filtro_ppto_revisados' class = 'entradas_bordes' style = 'background-color: rgb(221, 221, 221);' onchange = 'select_historico_pptos();'>
					<option value = '0'>[SELECCIONE]</option>
					<option value = 'PPTOINT'>PPTO INT</option>
					<option value = 'PPTOEXT'>PPTO EXT</option>
					<option value = 'REF'>REFERENCIA</option>
					<option value = 'ENV'>RADICADO POR</option>
					<option value = 'EST'>ESTADO</option>
					<option value = 'FECS'>FECHA DE SOLICITUD</option>
					<option value = 'FECR'>FECHA RESPUESTA</option>
				</select>
			</td>
			<td style = 'padding-left:10px;'>
				<input type = 'text' id = 'input_general_pptos_revisados' class = 'entradas_bordes filtros_buscar_ppto_revisados' style = 'background-color: rgb(221, 221, 221);' placeholder = 'Ingrese la información'/>
				<select id = 'buscar_estado_pptos_revisados' class = 'entradas_bordes filtros_buscar_ppto_revisados hidde'  style = 'background-color: rgb(221, 221, 221);'>
					<option value ='1'>APROBADO</option>
					<option value ='0'>NO APROBADO</option>
				</select>
			</td>
			<td>
				<img src = '../images /iconos/lupa_verde.png' width = '45px' onclick = 'buscar_historico_ppto();'/>
			</td>
			<td nowrap>
				<span class = 'botton_verde' onclick = 'cargar_historico_aprobaciones_ppto()'>Ver todo</span>
			</td>
		</tr>
		<tr><td></td></tr>
	</table>
	<script type = 'text/javascript'>
		$('.fechas_filtrado').datepicker({ dateFormat: 'yy-mm-dd' });
	</script>
	<div style = 'overflow: scroll; border-radius: 0.3em; height: 606.98px;background-color: rgb(221, 221, 221);' class = 'contenedor_listado_historico_ppto'>
		<table width = '100%' class = 'tablas_muestra_datos_tablas_trafico'>
			<tr>
				<th nowrap>PPTO INT</th>
				<th nowrap>PPTO EXT</th>
				<th>REFERENCIA</th>
				<th title = 'Porcentaje de Rentabilidad' nowrap>% RENT.</th>
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