<?php

	$titulo_ventana = "ANTICIPOS";
	$cerrar_ventana = "cerrar_ventana_form();";
	$icono_cerrar = "icon-19.png";
	include("encabezado_vista.php");
	
	$ppto = $_POST['ppto'];
	$vi = $_POST['vi'];
	$vc = $_POST['vc'];
	$tipo = $_POST['tipo'];
	$item = "";
	$est_anticipo = "<table width = '100%' style = 'border-collapse:collapse;' class = 'tablas_muestra_datos_tablas_trafico'>
						<tr>
							<th></th>
							<th>Grupo</th>
							<th>Nombre Item</th>
							<th>Dias</th>
							<th>Cantidad</th>
							<th>$ Unitario</th>
							<th>$ Total</th>
							<th>$ Acumulado Sol.</th>
							<th>$ Disponible</th>
							<th>$ Valor Sol.</th>
							<th>Excedente</th>
						</tr>";
	
	
	if($tipo == 1){
		$estructura_historico = "<table width = '100%' style = 'border-collapse:collapse;' class = 'tablas_muestra_datos_tablas_trafico'>
								<tr>
									<th></th>
									<th>Fecha Solicitud</th>
									<th>Solicitado Por</th>
									<th>Estado</th>
									<th>Fecha Estado</th>
									<th>Fecha Legalización</th>
								</tr>";
		$item = $_POST['item'];
		//ARMO EL SQL QUE ME TRAE TODA LA INFORMACIÓN DE LOS ANTICIPOS
		$sql_anticipos_ppto = mysql_query("select antppto.id,antppto.user,antppto.fecha_plata,antppto.fecha_legalizacion,antppto.fecha,e.nombre_empleado
		from anticipos_ppto antppto, cuerpo_anticipo cp, usuario u, empleado e
		where antppto.ppto = '$ppto' and antppto.vi = '$vi' and antppto.vc = '$vc' and antppto.id = cp.pk_anticipo and cp.pk_item = '$item[0]'
		and antppto.user = u.idusuario and u.pk_empleado = e.documento_empleado");
		
		
		while($row = mysql_fetch_array($sql_anticipos_ppto)){
			$id = $row['id'];
			
			$estructura_historico .="
				<tr>
					<td align = 'center'>".($row['id'])."</td>
					<td align = 'center'>".($row['fecha'])."</td>
					<td style = 'padding-left:10px;text-align:left;' >".utf8_decode($row['nombre_empleado'])."</td>";
			$sql_estatus = mysql_query("select e.nombre_empleado,estant.fecha_estado,estant.estado,estant.observaciones
			from estatus_anticipos estant, usuario u, empleado e
			where estant.pk_anticipo = '$id' and estant.useraprobado = u.idusuario and u.pk_empleado = e.documento_empleado");
			
			if(mysql_num_rows($sql_estatus) == 0){
				
				$estructura_historico .= "<td style = 'padding-left:10px;text-align:left;' >EN APROBACIÓN</td>
						<td></td><td></td>";
			}else{
				while($rox = mysql_fetch_array($sql_estatus)){
					$estado = "";
					if($rox['estado'] == 1){
						$estado = "APROBADO";
					}else{
						$estado = "NO APROBADO";
					}
					$estructura_historico .="<td style = 'padding-left:10px;text-align:left;'>$estado</td>
							<td align = 'center'>".($rox['fecha_estado'])."</td>
							<td style = 'padding-left:10px;text-align:left;'>".nl2br($rox['observaciones'])."</td>";
				}
			}
			
			$estructura_historico.="</tr>";
		}
		$estructura_historico.="</table>";
		
		$sql_item = mysql_query("select dias,q,name_item,name_grupo,asoc,val_item,iva_item
		from itempresup where id = '$item[0]'");
		while($row = mysql_fetch_array($sql_item)){
			$por_anticipos_solicitados = 0;
			$sql_ant = mysql_query("select ca.porcentaje
			from anticipos_ppto ap, cuerpo_anticipo ca
			where ap.ppto = '$ppto' and ap.vi = '$vi' and ap.vc = '$vc' and ap.id = ca.pk_anticipo 
			and ca.pk_item = '$item[0]'");
			while($xrow = mysql_fetch_array($sql_ant)){
				$por_anticipos_solicitados+=$xrow['porcentaje'];
			}
			$libre = ($row['val_item'] * $row['dias'] * $row['q'])-$por_anticipos_solicitados;
			
			$est_anticipo.="<tr>
				<td >
					<div>
						<input type = 'checkbox' checked id = 'item_anticipo$item[0]' name = 'item_anticipo[]' value = '$item[0]' class = 'radio'/>
						<label for='item_anticipo$item[0]'><span><span></span></span></label>
					</div>
				</td>
				<td align = 'left'>".utf8_decode($row['name_grupo'])."</td>
				<td align = 'left'>".utf8_decode($row['name_item'])."</td>
				<td >".$row['dias']."<span class = 'hidde' id = 'ant_dias$item[0]'>".$row['dias']."</span></td>
				<td >".$row['q']."<span class = 'hidde' id = 'ant_q$item[0]'>".$row['q']."</span></td>
				<td >".number_format($row['val_item'])."<span class = 'hidde' >".$row['val_item']."</span></td>
				<td >".number_format($row['val_item'] * $row['dias'] * $row['q'])."</td>
				<td >".number_format($por_anticipos_solicitados)."</td>
				<td >".number_format($libre)."<span id = 'ant_val_unitario$item[0]' class = 'hidde'>".$libre."</span></td>
				<td >
					<input type = 'text' min = '1' value = '0' id = 'por_ant$item[0]'   onkeyup = 'validar_porcentaje_libre_item_anticipo($item[0],$libre)' onchange = 'validar_porcentaje_libre_item_anticipo($item[0],$libre)' />
					<span id = 'valor_real_solicitado$item[0]' class = 'hidde'>0</span>
				</td>
				<td >
					<span id = 'total_solicitado$item[0]' ></span>
				</td>
			</tr>";
		}
		$est_anticipo."</table>";
	}else{
		
	}
	
	
	$estructura_ventana .= "
	
	<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
		<tr>
			<th align = 'left' >HISTÓRICO</th>
			<td class = 'separator'></td>
			<th align = 'left' >NUEVO ANTICIPO</th>
		</tr>
		<tr><td></br></td></tr>
		<tr><td></br></td></tr>
		<tr>
			<td class = 'historicos' width = '49%' style = 'background-color:white;vertical-align:top;'>
				$estructura_historico
			</td>
			<td class = 'separator'></td>
			<td class = 'form_anticipos' width = '49%' style = 'vertical-align:top;'>
				<table style = 'padding-left:10px;padding-right:10px;' >
					<tr>
						<td >
							<p>¿Para cuándo necesita el anticipo?:</p>
							<input type = 'text' class = 'fechas_ant entradas_bordes' id = 'fecha_anticipo' onchange = 'sumar_fechas_php();' />
						</td>
						<td class = 'separator'></td>
						<td>
							<p>Fecha de Legalización:</p>
							<input type = 'text' readonly id = 'fecha_max_legal_anticipo'/>
						</td>
					</tr>
				</table>
				<table width = '100%'  style = 'padding-left:10px;padding-right:10px;' >
					<tr><td></br></td></tr>
					<tr>
						<td colspan = '3'>
							<p>Ingrese los porcentajes correspondiente de anticipos:</p>
							$est_anticipo
						</td>
					</tr>
					<tr><td style = 'background-color:#E3E3E3;'></br></td></tr>
					<tr>
						<td colspan = '3' style = 'background-color:#E3E3E3;text-align:left;'>
							<span class = 'botton_verde' onclick = 'generar_anticipo_ppto()'>GENERAR ANTICIPO</span>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<script type = 'text/javascript'>
		function nonWorkingDates(date){
			var day = date.getDay(), Sunday = 0, Monday = 1, Tuesday = 2, Wednesday = 3, Thursday = 4, Friday = 5, Saturday = 6;
			var closedDays = [[Saturday], [Sunday]];
			return [true];
		}
		$('.fechas_ant').datepicker({ dateFormat: 'yy-mm-dd',beforeShowDay: nonWorkingDates,	numberOfMonths: 1,	minDate: '0',firstDay: 1  });
	</script>
	";
	echo $estructura_ventana;
?>