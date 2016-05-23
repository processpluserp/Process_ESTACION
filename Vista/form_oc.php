<?php

	include("../Controller/Conexion.php");
	include_once("../Modelo/gestion_cabecera.php");
	include_once("../Modelo/Empresa.php");
	session_start();
	
	$gestion = new cabecera_pagina();
	
	$emp = new Empresa();
	
	$ppto = $_POST['ppto'];
	$vi = $_POST['vi'];
	$vc = $_POST['vc'];
	
	$sql_nota_oc = mysql_query("select e.nota_orden_c
	from empresa e, cabpresup p
	where p.codigo_presup = '$ppto' and p.empresa_nit_empresa = e.cod_interno_empresa");
	
	$nota_orden_oc = "";
	while($row = mysql_fetch_array($sql_nota_oc)){
		$nota_orden_oc = $row['nota_orden_c'];
	}
	
	$sql_proveedores = mysql_query("select distinct p.codigo_interno_proveedor,p.nombre_comercial_proveedor
	from proveedores p, itempresup it
	where it.proveedor = p.codigo_interno_proveedor and p.estado = '1' and it.ppto = '$ppto' and it.vi = '$vi' and it.vc = '$vc'");
	$prov = "<option value = '0'>[SELECCIONE]</option>";
	while($rowx = mysql_fetch_array($sql_proveedores)){
		$prov.="<option value = '".$rowx['codigo_interno_proveedor']."'>".$rowx['nombre_comercial_proveedor']."</option>";
	}
	
	$sql_fpago = mysql_query("select codigo_interno,valor_numerico,name_forma_pago from fpago");
	$fpago = "<option value = '0'>[SELECCIONE]</option>";
	while($rowx = mysql_fetch_array($sql_fpago)){
		$fpago.="<option value = '".$rowx['codigo_interno']."'>".$rowx['name_forma_pago']."</option>";
	}
	
	$estructura = "
	<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
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
								<span class = 'mensaje_bienvenida' >ORDEN DE COMPRA</span>
							</td>
						</tr>
					</table>
				</td>
				<td align = 'right' >
					<table width = '100%'>
						<tr>
							<td align = 'center'>
								<img onclick = 'cerrar_ventana_general_op();' src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano'/>
							</td>
						</tr>
					</table>
				</td>
			</tr>
	</table>
	<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
		<tr>
			<td colspan = '5'>
				<p>Seleccione un Proveedor</p>
				<select id = 'listado_proveedores_op' onchange = 'buscar_items_proveedores_oc();' class = 'entradas_bordes'>
					$prov
				</select>
			</td>
		</tr>
	</table>
	<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
		<tr>
			<td colspan = '5'>
				<div style = 'width:100%;height:250px;background-color:white;' id = 'contenedor_listado_proveedor_items'>
					
				</div>
			</td>
		</tr>
		<tr><td></br></td></tr>
		<tr>
			<td>
				<p>Seleccione la Fecha de Entrega:</p>
				<input type = 'text' class = 'entradas_bordes fechas_ordenes' width = '120px;' id = 'fecha_entrega_ordenc'/>
			</td>
			<td>
				<p>Seleccione la Fecha de Radicación:</p>
				<input type = 'text' class = 'entradas_bordes fechas_ordenes' width = '120px;' id = 'fecha_radicacion_ordenc'/>
			</td>
			<td class = 'separator'></td>
			<td>
				<p>Seleccione la Vigencia Inicial:</p>
				<input type = 'text' class = 'entradas_bordes fechas_ordenes' width = '120px;' id = 'vigencia_inicial_op'/>
			</td>
			<td>
				<p>Seleccione la Vigencia Final:</p>
				<input type = 'text' class = 'entradas_bordes fechas_ordenes' width = '120px;' id = 'vigencia_final_op' onchange = 'validar_fechas_op();' />
			</td>
		</tr>
		<tr>
			<td>
				<p>Seleccione la forma de pago:</p>
				<select id = 'fpago_op'>$fpago</select>
			</td>
			<td>
				<p>Ingres el lugar de Entrega:</p>
				<input type = 'text' class = 'entradas_bordes' id = 'lugar_op'/>
			</td>
			<td class = 'separator'></td>
		</tr>
		<tr><td></br></td></tr>
		<tr>
			<td colspan = '5'>
				<textarea style = 'width:100%' rows = '5' id = 'nota_orden_oc'>$nota_orden_oc</textarea>
			</td>
		</tr>
		<tr><td></br></td></tr>
		<tr>
			<td colspan = '5'>
				<span class = 'botton_verde' onclick = 'generar_orden_oc()'>GENERAR OC</span>
			</td>
		</tr>
	</table>
	<script type = 'text/javascript'>
		function nonWorkingDates(date){
			var day = date.getDay(), Sunday = 0, Monday = 1, Tuesday = 2, Wednesday = 3, Thursday = 4, Friday = 5, Saturday = 6;
			var closedDays = [[Saturday], [Sunday]];
			return [true];
		}
		$('.fechas_ordenes').datepicker({ dateFormat: 'yy-mm-dd',beforeShowDay: nonWorkingDates,	numberOfMonths: 1,	minDate: '0',firstDay: 1  });
	</script>
	";
	echo $estructura;
?>