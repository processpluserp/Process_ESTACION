<?php
	include("../Controller/Conexion.php");
	$i = $_POST['i'];
	$id = $_POST['i'];
	$prov = "";
	
	$fecha = date("Y-m-d h:i:s");
	$user = $_POST['user'];
	$num_interno = $i+1;
	mysql_query("START TRANSACTION");
		mysql_query("insert into itempresup (proveedor,ppto,vi,vc,fecha_registro,num_interno,usuario) values('272','".$_POST['ppto']."','".$_POST['vi']."','".$_POST['vc']."','$fecha','$num_interno','$user')");
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
	
	$estructura_editable = "<tr class = '$id informacion_guardada_bd item_total$i items_ppto_pro'>
								<td  nowrap  class = 'campos border_table'>
									<img src = '../images/iconos/eliminar.png' width = '20px' title = 'Eliminar Item' onclick = 'eliminar_item_by_id($id)'/>
								</td>
								<td align = 'center'  class = 'campos border_table' nowrap >
									<span class = 'codigo_item hidde' id = 'olditem$i'>$id</span>
									<div>
										<input type = 'checkbox' id = 'grupo$i' name = 'grupo_sel' value = '$i' onclick = 'grupo_selected()' class = 'radio'/>
										<label for='grupo$i'><span><span></span></span></label><span class = 'orden_item_item'>".($i+1)."</span>
									</div>
								</td>
								<td  nowrap  class = 'campos border_table'>
									<img src = '../images/iconos/anticipo.png' width = '20px' title = 'Pedir Anticipo sobre el Item'/>
								</td>
								<td  nowrap  class = 'campos border_table'>
									
								</td>
								<td  nowrap  class = 'campos border_table orden_item$id'>
									
								</td>
								<td  nowrap  class = 'campos border_table'>
									
								</td>
								<td class = 'border_table fondo_td' align = 'center' nowrap>
									<table width = '100%'>
										<tr>
											<td style = 'vertical-align:top;'>
												<span class = 'botton_verde'>Asociados <img src = '../images/iconos/Engra.png'  width = '23px' id = 'add_asoc$i' onclick = 'mostrar_asoc_items($i,0)'/></span>
											</td>
											<td>
												<input type = 'text' value = '' id = 'grupo$id' />
											</td>
										</tr>
									</table>
								</td>
								<td class = 'border_table fondo_td' align = 'left' style = 'padding-left:5px;padding-right:5px;' nowrap>
									<input type = 'text' value = '' id = 'itemppto$id' onkeyup = 'listar_items_tarifarios($id)'/>
									<div id = 'listar_item_tarifario$id'></div>
								</td>
								<td class = 'border_table fondo_td' align = 'left' nowrap width = '250px' style = 'padding-left:5px;padding-right:5px;'>
									<textarea cols = '35' rows = '2' id = 'descripcionitem$id'></textarea>
								</td>
								<td class = 'border_table campos proveedores' align = 'left' nowrap style = 'padding-left:5px;padding-right:5px;width:180px;'>
									<select style = 'width:180px;' id = 'proveedoritem$id' >
										$prov
									</select>
								</td>
								<td class = 'border_table fondo_td' align = 'center' nowrap style = 'padding-left:5px;padding-right:5px;'>
									<input type = 'number' class = 'entrada_bordes' value = '0' id = 'dias$i' style = 'width:45px;' onkeyup = 'formatear_valor_num_dias($i);calcular_interno($i);' onchange = 'formatear_valor_num_dias($i);calcular_interno($i);'/>
									<span id = 'h_dias$i' class = 'hidde diasitem$id'>0</span>
								</td>
								<td class = 'border_table fondo_td' align = 'center' nowrap style = 'padding-left:5px;padding-right:5px;'>
									<input type = 'number' class = 'entrada_bordes'value = '0' id = 'cant$i' style = 'width:45px;' onkeyup = 'formatear_valor_num_cant($i);calcular_interno($i);' onchange = 'formatear_valor_num_cant($i);calcular_interno($i);'/>
									<span id = 'h_cant$i' class = 'hidde cantidadiem$id'>0</span>
								</td>
								<td class = 'border_table fondo_td' align = 'center' nowrap>
									<input type = 'text' class = 'entrada_bordes valor_interno_unitario$id' style = 'width:80px;' onblur = 'limpiar_costo_interno($i);' id = 'valor_interno$i' onkeyup = 'formatear_valor_costo_unitario($i);calcular_interno($i);' value = '0'/>
									<span id = 'h_valor_interno$i' class = 'hidde valorinternoitem$id'>0</span>
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
									0
								</td>
								<td class = 'border_table fondo_td' align = 'center' nowrap>
									<input type = 'text' class = 'entrada_bordes ivaitem$id' style = 'width:40px;' id = 'iva$i' value = '16' onkeyup = 'calcular_interno($i);' onchange = 'calcular_interno($i);' />
								</td>
								<td class = 'border_table fondo_td' align = 'center' nowrap>
									<input type = 'text' class = 'entrada_bordes' style = 'width:40px;' id = 'vol$i' onkeyup = 'formatear_valor_por_vol($i);calcular_interno($i);' onchange = 'formatear_valor_por_vol($i);calcular_interno($i);'value = '0'/>
									<span id = 'h_vol$i' class = 'hidde volumenproveedor$id'>0</span>
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
								<td width = '300px'></td>
								<td class = 'border_table' align = 'left' nowrap width = '250px' style = 'padding-left:5px;padding-right:5px;background-color:#EF8B8B;color:white;' nowrap>
									<textarea cols = '35' rows = '2' id = 'descripcionitemdos$id'></textarea>
								</td>
								<td class = 'border_table' align = 'center' style = 'background-color:#EF8B8B;color:white;' nowrap>
									<table width = '100%'>
										<tr>
											<td>$</td>
											<td align = 'right'><input type = 'text' onblur = 'limpiar_valor_costo_cliente($i);' style = 'width:80px;' class = 'entrada_bordes valorunitariocliente$id' value = '0' id = 'valor_costo_unitario_cliente$i' onkeyup = 'formatear_valor_costo_cliente($i);calcular_interno($i);'/></td>
										</tr>
									</table>
									<span id = 'val_cliente_interno$i' class = 'hidde valorinternocliente$id'>0</span>
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
								<td width = '300px'></td>
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
							<tr  id = 'asocitem$i' style = 'display:none;'>
										
							</tr>";
		echo $estructura_editable;
?>