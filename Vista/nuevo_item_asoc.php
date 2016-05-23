<?php
	include("../Controller/Conexion.php");
	$i = $_POST['i'];
	$idd = $_POST['id'];
	$prov = "";
	$aux = $_POST['aux'];
	$date = date("Y-m-d h:i:s");
	$user = $_POST['user'];
	
	mysql_query("START TRANSACTION");
		mysql_query("insert into itempresup (proveedor,ppto,vi,vc,asoc,fecha_registro,usuario) values('272','".$_POST['ppto']."','".$_POST['vi']."','".$_POST['vc']."','".$_POST['id']."','$date',$user)");
		$sql_consult = mysql_query("SELECT @@identity AS id");
		$id = "";
		while($row = mysql_fetch_row($sql_consult)){
			$id = $row[0];
		}
	$sql_prove = mysql_query("select codigo_interno_proveedor, nombre_comercial_proveedor 
	from proveedores where estado = '1' order by nombre_comercial_proveedor asc");
	$prov = "";
	while($rowx = mysql_fetch_array($sql_prove)){
		if($rowx['codigo_interno_proveedor'] == 272){
			$prov.="<option value = '".$rowx['codigo_interno_proveedor']."' selected>".$rowx['nombre_comercial_proveedor']."</option>";
		}else{
			$prov.="<option value = '".$rowx['codigo_interno_proveedor']."'>".$rowx['nombre_comercial_proveedor']."</option>";
		}
	}
	mysql_query("COMMIT");
	echo "
		<tr class = '$id hijos_asoc$i $aux' id = '".$aux."hijo$i' data-dep='$i'  > 
			<td><span class = 'codigo_item hidde' id = 'olditem$i'>$id</span></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td align = 'right' style = 'padding-right:10px;'>
				<img src = '../images/iconos/eliminar.png' width = '25px' onclick = 'eliminar_item_asoc_bd($id,$i)'/>
			</td>
			<td class = 'border_table asoc' align = 'left' style = 'padding-left:5px;padding-right:5px;'>
				<input type = 'text' value = '' id = 'itemppto$id' />
			</td>
			<td class = 'border_table asoc' align = 'left' style = 'padding-left:5px;padding-right:5px;'>
				<textarea cols = '35' rows = '2' id = 'descripcionitem$id'></textarea>
			</td>
			<td class = 'border_table asoc' align = 'left' style = 'padding-left:5px;padding-right:5px;'>
				<select style = 'width:180px;' id = 'proveedoritem$id' >
					$prov
				</select>
			</td>
			<td class = 'border_table asoc' align = 'center'>
				<input type = 'number' class = 'entrada_bordes' min = '0' max = '100000000' value = '0' id = '".$aux."dias_asoc$i' style = 'width:55px;' onkeyup = 'formatear_valor_num_dias_asoc($i,$aux);calcular_asociados($i,$aux);recalcular_bolsa($i);' onchange = 'formatear_valor_num_dias_asoc($i,$aux);calcular_asociados($i,$aux);recalcular_bolsa($i);'/>
				<span id = '".$aux."h_dias_asoc$i' class = 'hidde diasitem$id'>0</span>
			</td>
			<td class = 'border_table asoc' align = 'center'>
				<input type = 'number' class = 'entrada_bordes' min = '0' max = '100000000' value = '0' id = '".$aux."cant_asoc$i' style = 'width:55px;' onkeyup = 'formatear_valor_num_cant_asoc($i,$aux);calcular_asociados($i,$aux);recalcular_bolsa($i);' onchange = 'formatear_valor_num_cant_asoc($i,$aux);calcular_asociados($i,$aux);recalcular_bolsa($i);'/>
				<span id = '".$aux."h_cant_asoc$i' class = 'hidde cantidadiem$id'>0</span>
			</td>
			<td class = 'border_table asoc' align = 'center'>
				<table width = '100%'>
					<tr>
						<td>$</td>
						<td align = 'right' >
							<input type = 'text' class = 'entrada_bordes' onblur = 'limpiar_valor_unitario_asoc($i,$aux);operacion_asoc($i);calcular_asociados($i,$aux);recalcular_bolsa($i);' style = 'width:80px;' id = '".$aux."valor_interno_asoc$i' onkeyup = 'formatear_valor_num_interno_asoc($i,$aux);operacion_asoc($i);calcular_asociados($i,$aux);recalcular_bolsa($i);' onchange = 'formatear_valor_num_interno_asoc($i,$aux);operacion_asoc($i);calcular_asociados($i,$aux);recalcular_bolsa($i);' value = '0'/>
							<span id = '".$aux."h_valor_interno_asoc$i' class = 'hidde valorinternoitem$id'>0</span>
						</td>
					</tr>
				</table>
			</td>
			<td class = 'border_table asoc' align = 'center'>
				<table width = '100%'>
					<tr>
						<td>$</td>
						<td align = 'right' id = '".$aux."costo_interno_asoc$i'>0</td>
						<span class = 'hidde' id = '".$aux."h_costo_interno_asoc$i' ></span>
					</tr>
				</table>
			</td>
		</tr>";
?>