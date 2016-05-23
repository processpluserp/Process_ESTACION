<?php
	//calcular_asociados("+i+","+temp+");
	$asociados .= "
		<tr class = '$xid hijos_asoc$i informacion_guardada_bd' id = '$idd' data-dep='$i' style = 'display:none;'>
			<td><span class = 'codigo_item hidde' id = 'olditem$i'>$xid</span></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td align = 'right' style = 'padding-right:10px;'>
				<img src = '../images/iconos/eliminar.png' width = '25px' onclick = 'eliminar_item_asoc_bd($xid)'/>
			</td>
			<td class = 'border_table asoc' align = 'left' style = 'padding-left:5px;padding-right:5px;'>
				<input type = 'text' value = '".$r['name_item']."' id = 'itemppto$xid' />
			</td>
			<td class = 'border_table asoc' align = 'left' style = 'padding-left:5px;padding-right:5px;'>
				<textarea cols = '35' rows = '2' id = 'descripcionitem$xid'>".$r['descripcion']."</textarea>
			</td>
			<td class = 'border_table asoc' align = 'left' style = 'padding-left:5px;padding-right:5px;'>
				<select style = 'width:180px;' id = 'proveedoritem$xid' >
					$option_asoc
				</select>
			</td>
			<td class = 'border_table asoc' align = 'center'>
				<input type = 'number' class = 'entrada_bordes' min = '0' max = '100000000'value = '".$r['dias']."' id = '".$ix."dias_asoc$i' style = 'width:55px;' onkeyup = 'formatear_valor_num_dias_asoc($i,$ix);calcular_asociados($i,$ix);recalcular_bolsa($i);'/>
				<span id = '".$ix."h_dias_asoc$i' class = 'hidde diasitem$xid'>".$r['dias']."</span>
			</td>
			<td class = 'border_table asoc' align = 'center'>
				<input type = 'number' class = 'entrada_bordes' min = '0' max = '100000000' value = '".$r['q']."' id = '".$ix."cant_asoc$i' style = 'width:55px;' onkeyup = 'formatear_valor_num_cant_asoc($i,$ix);calcular_asociados($i,$ix);recalcular_bolsa($i);'/>
				<span id = '".$ix."h_cant_asoc$i' class = 'hidde cantidadiem$xid'>".$r['q']."</span>
			</td>
			<td class = 'border_table asoc' align = 'center'>
				<table width = '100%'>
					<tr>
						<td>$</td>
						<td align = 'right' >
							<input type = 'text' class = 'entrada_bordes' max = '15' style = 'width:80px;' id = '".$ix."valor_interno_asoc$i' onblur = 'limpiar_valor_unitario_asoc($i,$ix);operacion_asoc($i);calcular_asociados($i,$ix);recalcular_bolsa($i);' onkeyup = 'formatear_valor_num_interno_asoc($i,$ix);operacion_asoc($i);calcular_asociados($i,$ix);recalcular_bolsa($i);' value = '".number_format($r['val_item'])."'/>
							<span id = '".$ix."h_valor_interno_asoc$i' class = 'hidde valorinternoitem$xid'>".$r['val_item']."</span>
						</td>
					</tr>
				</table>
			</td>
			<td class = 'border_table asoc' align = 'center'>
				<table width = '100%'>
					<tr>
						<td>$</td>
						<td align = 'right' id = '".$ix."costo_interno_asoc$i' >".number_format($r['val_item']*$r['q']*$r['dias'])."</td>
						<span class = 'hidde' id = '".$ix."h_costo_interno_asoc$i' ></span>
					</tr>
				</table>
			</td>
		</tr>";
?>