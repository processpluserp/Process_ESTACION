<?php
	include("../Controller/Conexion.php");
	include_once("../Modelo/gestion_cabecera.php");
	include_once("../Modelo/Empresa.php");
	session_start();
	
	$gestion = new cabecera_pagina();
	
	$emp = new Empresa();
	
	
	$id = $_POST['id'];
	
	$sql = mysql_query("select e.nombre_empleado, p.referencia,appto.id as num_anticipo, appto.fecha,appto.fecha_plata,p.codigo_presup,
	c.nombre_comercial_cliente,emp.nombre_comercial_empresa,p.ot,unn.name as unidad_negocio
	from pendientes_anticipos pa, anticipos_ppto appto, cabpresup p, empleado e, usuario u,clientes c, empresa emp, und unn
	where appto.id = '$id' and pa.pk_ant = appto.id and appto.ppto = p.codigo_presup and appto.user = u.idusuario and u.pk_empleado = e.documento_empleado
	and p.pk_clientes_nit_cliente = c.codigo_interno_cliente and p.empresa_nit_empresa = emp.cod_interno_empresa and
	p.ceco = unn.id");
	
	$sql_item_anticipo = mysql_query("select p.name_item,p.name_grupo,p.asoc,p.dias,p.q, prov.nombre_comercial_proveedor,cp.porcentaje,p.val_item
	from cuerpo_anticipo cp, itempresup p, proveedores prov
	where cp.pk_anticipo = '$id' and cp.pk_item = p.id and p.proveedor = prov.codigo_interno_proveedor");
	$tabla_anticipos = "<table width = '100%' class = 'tablas_muestra_datos_tablas_trafico' style = 'border-collapse:collapse;'>
							<tr>
								<th></th>
								<th>Grupo</th>
								<th>Item</th>
								<th>Proveedor</th>
								<th>Días</th>
								<th>Cantidad</th>
								<th>$ Unitario</th>
								<th>Total</th>
								<th>$ Valor Sol.</th>
							</tr>";
	$acum_total_anticipo = 0;
	$ii = 1;
	while($row = mysql_fetch_array($sql_item_anticipo)){
		$valor_item = $row['dias']*$row['q']*$row['val_item'];
		$por = $row['porcentaje'];
		$to = ($valor_item*$por)/100;
		
		$acum_total_anticipo+=$por;
		$grupo = "";
		if($row['asoc'] != 0){
			$grupo = "ASOCIADO";
		}else{
			$grupo = $row['name_grupo'];
		}
		$tabla_anticipos.="<tr>
			<td>$ii</td>
			<td>".utf8_decode($grupo)."</td>
			<td>".utf8_decode($row['name_item'])."</td>
			<td>".utf8_decode($row['nombre_comercial_proveedor'])."</td>
			<td>".($row['dias'])."</td>
			<td>".($row['q'])."</td>
			<td>".number_format($row['val_item'])."</td>
			<td>".number_format($valor_item)."</td>
			<td>".number_format($por)."</td>
		</tr>";
		$ii++;
	}
	$tabla_anticipos.="<tr><td style = 'background-color:white;'></td></tr>";
	$tabla_anticipos.="<tr><td colspan = '7' style = 'background-color:white;'></td><th>TOTAL</th><th>".number_format($acum_total_anticipo)."</th></tr>";
	$tabla_anticipos.="</table>";
	
	$est = "";
	while($row = mysql_fetch_array($sql)){
		$est = "<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
			<tr>
				<td width = '96%' align = 'left'>
					<table width = '100%'>
						<tr>
							<td align = 'left'>
								".$emp->mostrar_logo_empresa($gestion->mostrar_empresa_empleado())."
							</td>
						</tr>
						<tr>
							<td align = 'left' >
								<span class = 'mensaje_bienvenida' >ANTICIPO # $id</span>
							</td>
						</tr>
					</table>
				</td>
				<td align = 'right' >
					<table width = '100%'>
						<tr>
							<td align = 'center'>
								<img onclick = 'aprobacion_anticipo($id,".$_POST['pen'].");' src = '../images/iconos/aprobado_ppto.png' class = 'iconos_opciones mano'/>
							</td>
							<td align = 'center'>
								<img onclick = 'noaprobar_anticipo($id,".$_POST['pen'].");' src = '../images/iconos/noaprobado_ppto.png' class = 'iconos_opciones mano'/>
							</td>
							<td align = 'center'>
								<img onclick = 'cerrar_ventana_form_visual_anticipos();' src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano'/>
							</td>
						</tr>
					</table>
				</td>
			</tr>
	</table>
	<table width = '100%' style = 'padding-left:50px;padding-right:50px;' class = 'tabla_nuevos_datos'>
		<tr>
			<td>
				<p>Empresa:</p>
				<input type = 'text' class = 'entradas_bordes' readonly value = '".$row['nombre_comercial_empresa']."'/>
			</td>
			<td class = 'separator'></td>
			<td>
				<p>Cliente:</p>
				<input type = 'text' class = 'entradas_bordes' readonly value = '".$row['nombre_comercial_cliente']."'/>
			</td>
		</tr>
		<tr>
			<td>
				<p># OT:</p>
				<input type = 'text' class = 'entradas_bordes' readonly value = '".$row['ot']."'/>
			</td>
			<td class = 'separator'></td>
			<td>
				<p>UNIDAD:</p>
				<input type = 'text' class = 'entradas_bordes' readonly value = '".$row['unidad_negocio']."'/>
			</td>
		</tr>
		<tr>
			<td>
				<p># PRESUPUESTO:</p>
				<input type = 'text' class = 'entradas_bordes' readonly value = '".$row['codigo_presup']."'/>
			</td>
			<td class = 'separator'></td>
			<td>
				<p>REFERENCIA PRESUPUESTO:</p>
				<input type = 'text' class = 'entradas_bordes' readonly value = '".html_entity_decode($row['referencia'])."'/>
			</td>
		</tr>
		<tr>
			<td>
				<p>SOLICITADO POR:</p>
				<input type = 'text' class = 'entradas_bordes' readonly value = '".$row['nombre_empleado']."'/>
			</td>
			<td class = 'separator'></td>
			<td>
				<p>FECHA DE SOLICITUD:</p>
				<input type = 'text' class = 'entradas_bordes' readonly value = '".($row['fecha'])."'/>
			</td>
		</tr>
		<tr>
			<td colspan = '3'>
				<p>El anticipo # $id se realiza sobre:</p>
				$tabla_anticipos
			</td>
		</tr>
	</table>";
	}
	echo $est;
?>