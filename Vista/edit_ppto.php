<?php
	$sql_anticipos = mysql_query("select porcentaje from cuerpo_anticipo where pk_item = '$id'");
	$porcentaje_anticipo_item = "";
	$acum_por = 0;
	$val_anticipo_acum = 0;
	if(mysql_num_rows($sql_anticipos) == 0){
		$porcentaje_anticipo_item = "0 %";
	}else{
		while($cx = mysql_fetch_array($sql_anticipos)){
			$acum_por+=$cx['porcentaje'];
			$valor_inicial = $row['dias'] * $row['q'] * $row['val_item'];
			$temp = ($cx['porcentaje']);
			$val_anticipo_acum += $temp;
		}
		$acum_por = ($val_anticipo_acum*100)/($valor_inicial);
		$val_anticipo_acum = ($valor_inicial) - ($val_anticipo_acum);
		$porcentaje_anticipo_item = "<span onclick = 'histo_anticipos_item($id)'  class = 'botton_verde mano item_anticipo' >".number_format($acum_por,2)." %</span><span class = 'hidde xvalor_item_anticipo'>$val_anticipo_acum</span>";
	}
	$estructura_editable = "<tr class = '$id informacion_guardada_bd item_total$i items_ppto_pro'>
								<td  nowrap  class = 'campos border_table'>
									<img src = '../images/iconos/eliminar.png' width = '20px' title = 'Eliminar Item' onclick = 'eliminar_item_by_id($id,$i)'/>
								</td>
								<td align = 'center'  class = 'campos border_table' nowrap >
									<span class = 'codigo_item hidde' id = 'olditem$i'>$id</span>
									<div>
										<input type = 'checkbox' id = 'grupo$i' name = 'grupo_sel' value = '$i' onclick = 'grupo_selected()' class = 'radio'/>
										<label for='grupo$i'><span><span></span></span></label><span class = 'orden_item_item'>$numero_item</span>
									</div>
								</td>
								<td  nowrap  class = 'campos border_table'>
									<img src = '../images/iconos/anticipo.png' width = '20px' title = 'Pedir Anticipo sobre el Item' onclick = 'solicitar_anticipo_item($id);'/>
								</td>
								<td  nowrap  class = 'campos border_table $class_vnc'>
									$vnc_item
								</td>
								<td  nowrap  class = 'campos border_table orden_item$id'>
									
								</td>
								<td  nowrap  class = 'campos border_table '>
									
								</td>
								<td class = 'border_table fondo_td' align = 'center' nowrap>
									<table width = '100%'>
										<tr>
											<td style = 'vertical-align:top;'>
												$engranage_asociados
											</td>
											<td>
												<input type = 'text' value = '".utf8_decode($row['name_grupo'])."' id = 'grupo$id' />
											</td>
										</tr>
									</table>
								</td>
								<td class = 'border_table fondo_td' align = 'left' style = 'padding-left:5px;padding-right:5px;' nowrap>
									$itemm
									<div id = 'listar_item_tarifario$id'></div>
								</td>
								<td class = 'border_table fondo_td' align = 'left' nowrap width = '250px' style = 'padding-left:5px;padding-right:5px;'>
									".$descr."
								</td>
								<td class = 'border_table campos proveedores' align = 'left' nowrap style = 'padding-left:5px;padding-right:5px;width:180px;'>
									<select style = 'width:180px;' id = 'proveedoritem$id' >
										$option
									</select>
								</td>
								<td class = 'border_table fondo_td' align = 'center' nowrap style = 'padding-left:5px;padding-right:5px;'>
									<input type = 'number' class = 'entrada_bordes' min = '0' max = '100000000' value = '".$row['dias']."' id = 'dias$i' style = 'width:55px;' onkeyup = 'formatear_valor_num_dias($i);calcular_interno($i);' onchange = 'formatear_valor_num_dias($i);calcular_interno($i);'/>
									<span id = 'h_dias$i' class = 'hidde diasitem$id'>".$row['dias']."</span>
								</td>
								<td class = 'border_table fondo_td' align = 'center' nowrap style = 'padding-left:5px;padding-right:5px;'>
									<input type = 'number' class = 'entrada_bordes' min = '0' max = '100000000' value = '".$row['q']."' id = 'cant$i' style = 'width:55px;' onkeyup = 'formatear_valor_num_cant($i);calcular_interno($i);' onchange = 'formatear_valor_num_cant($i);calcular_interno($i);'/>
									<span id = 'h_cant$i' class = 'hidde cantidadiem$id'>".$row['q']."</span>
								</td>
								<td class = 'border_table fondo_td' align = 'center' nowrap>
									<input type = 'text' class = 'entrada_bordes valor_interno_unitario$id' min = '0' max = '15' style = 'width:80px;' id = 'valor_interno$i' onkeyup = 'formatear_valor_costo_unitario($i);calcular_interno($i);' onblur = 'limpiar_costo_interno($i);'value = '".number_format($row['val_item'])."'/>
									<span id = 'h_valor_interno$i' class = 'hidde valorinternoitem$id'>".$row['val_item']."</span>
								</td>
								<td class = 'border_table subtotal' align = 'center' nowrap>
									<table width = '100%'>
										<tr>
											<td>$</td>
											<td align = 'right' id = 'valor_subtotal_item$i'></td>
										</tr>
									</table>
									<span class = 'subtotal_items hidde' id = 'h_subtotal_item$i' ></span>
								</td>
								<td class = 'border_table fondo_td' align = 'center' nowrap>
									$porcentaje_anticipo_item
								</td>
								<td class = 'border_table fondo_td' align = 'center' nowrap>
									<input type = 'number' class = 'entrada_bordes ivaitem$id' min = '0' max = '100' maxlength = '3'  style = 'width:45px;' id = 'iva$i' value = '".$row['iva_item']."' onkeyup = 'calcular_interno($i);' onchange = 'calcular_interno($i);' />
								</td>
								<td class = 'border_table fondo_td' align = 'center' nowrap>
									<input type = 'number'  min = '0' max = '100' class = 'entrada_bordes' style = 'width:45px;' maxlength = '3'  id = 'vol$i' onkeyup = 'formatear_valor_por_vol($i);calcular_interno($i);' value = '".$row['por_prov']."' onchange = 'formatear_valor_por_vol($i);calcular_interno($i);'/>
									<span id = 'h_vol$i' class = 'hidde volumenproveedor$id'>".$row['por_prov']."</span>
								</td>
								<td class = 'border_table fondo_td' align = 'center' nowrap>
									<table width = '100%'>
										<tr>
											<td>$</td>
											<td align = 'right'><span id = 'costo_interno$i'></span></td>
										</tr>
									</table>
									<span id = 'h_costo_interno$i' class = 'hidde cost_interno_x'></span>
								</td>
								<td ></td>
								<td class = 'border_table' align = 'left' nowrap width = '250px' style = 'padding-left:5px;padding-right:5px;background-color:#EF8B8B;color:white;' nowrap>
									".$desc2."
								</td>
								<td class = 'border_table' align = 'center' style = 'background-color:#EF8B8B;color:white;' nowrap>
									<table width = '100%'>
										<tr>
											<td>$</td>
											<td align = 'right'><input type = 'text' style = 'width:80px;' class = 'entrada_bordes valorunitariocliente$id' value = '".number_format($row['cliente'])."' id = 'valor_costo_unitario_cliente$i' onblur = 'limpiar_valor_costo_cliente($i);'onkeyup = 'formatear_valor_costo_cliente($i);calcular_interno($i);'/></td>
										</tr>
									</table>
									<span id = 'val_cliente_interno$i' class = 'hidde valorinternocliente$id'>".($row['cliente'])."</span>
								</td>
								<td class = 'border_table' style = 'background-color:#EF8B8B;color:white;' nowrap>
									<table width = '100%'>
										<tr>
											<td>$</td>
											<td align = 'right'><span id = 'costo_cliente$i'></span></td>
										</tr>
									</table>
									<span id = 'h_costo_cliente$i' class = 'hidde externo_cliente'></span>					
								</td>
								<td ></td>
								<td align = 'center' class = 'border_table fondo_td' id = 'por_rent_item$i' nowrap>
									
								</td>
								<td align = 'center' class = 'border_table fondo_td'   nowrap>
									<table width = '100%'>
										<tr>
											<td>$</td>
											<td align = 'right' id = 'valor_rent_item$i'>0</td>
										</tr>
									</table>
									<span id ='valor_rentabilidad_item$i' class = 'hidde rentabilidad_item'></span>
								</td>
							</tr>
							<tr id = 'asocitem$i' style = 'display:none;'>
										
							</tr>";
		echo $estructura_editable;
?>