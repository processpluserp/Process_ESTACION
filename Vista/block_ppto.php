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
	$estructura = "<tr class = 'old$id item_total$i informacion_guardada_bd items_ppto_pro'>
					<td align = 'center'  class = 'campos border_table' width = '25px'>
						<span class = 'olditem hidde' id = 'olditem$i'>$id</span>
					</td>
					<td align = 'center'  class = 'campos border_table'>
						
					</td>
					<td align = 'center'  class = 'campos border_table'>
						
					</td>
					<td  nowrap  class = 'campos border_table $class_vnc'>
						$vnc_item
					</td>
					<td  nowrap  class = 'campos border_table'>
						$orden_item
					</td>
					<td align = 'center'  class = 'campos border_table'>
						<img src = '../images/iconos/lock.png' width = '15px' $item_ordenado_funcion/>
					</td>
					<td class = 'border_table fondo_td' align = 'center' nowrap>
						<table width = '100%'>
							<tr>
								<td>
									$engranage_asociados
								</td>
								<td>
									".utf8_decode($row['name_grupo'])."
								</td>
							</tr>
						</table>
					</td>
					<td class = 'border_table fondo_td' align = 'left' style = 'padding-left:5px;padding-right:5px;'>
						".utf8_decode($row['name_item'])."
					</td>
					<td class = 'border_table fondo_td' align = 'left' width = '250px' style = 'padding-left:5px;padding-right:5px;'>
						".nl2br(utf8_decode($row['descripcion']))."
					</td>
					<td class = 'border_table campos proveedores' id = 'proveedoritem$id' align = 'left' nowrap style = 'padding-left:5px;padding-right:5px;width:180px;' nowrap>
						<span >".$row['nombre_comercial_proveedor']."</span>
					</td>
					<td class = 'border_table fondo_td' align = 'center' nowrap>
						".$row['dias']." 
						<span id = 'h_dias$i' class = 'hidde diasitem$id'>".$row['dias']."</span>
					</td>
					<td class = 'border_table fondo_td' align = 'center' nowrap>
						".$row['q']."
						<span id = 'h_cant$i'  class = 'hidde cantidadiem$id'>".$row['q']."</span>
					</td>
					<td class = 'border_table fondo_td' align = 'center' nowrap>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right' >".number_format($row['val_item'])."</td>
							</tr>
						</table>
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
						$porcentaje_anticipo_item %
					</td>
					<td class = 'border_table fondo_td' align = 'center' nowrap>
						<span >".$row['iva_item']."</span>
					</td>
					<td class = 'border_table fondo_td' align = 'center' nowrap>
						".$row['por_prov']."
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
								<td align = 'right'><span >".number_format($row['cliente'])."</span></td>
							</tr>
						</table>
						<span id = 'val_cliente_interno$i' class = 'hidde'>".($row['cliente'])."</span>
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
					<td align = 'center' class = 'border_table fondo_td'  nowrap>
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
			echo $estructura;
			