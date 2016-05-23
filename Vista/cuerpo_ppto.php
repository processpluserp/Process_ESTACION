<?php
	
	//SACO EL LISTADO DE PROVEEDORES QUE HAY
	$prov = "";
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
	
	//CONSULTO LOS GRUPOS QUE HAY DEL PPTO MENOS LOS QUE ESTÁN DENTRO DE VALORES NO COMISIONABLES
	
	$sql = mysql_query("select p.id, p.proveedor, p.dias,p.q,p.descripcion,p.val_item,p.iva_item,p.fecha_ant,p.por_ant,p.cliente,p.por_prov,p.id,p.vnc,
	p.name_item,p.editable, pp.nombre_comercial_proveedor,pp.codigo_interno_proveedor,p.pk_orden,p.pk_op,
	p.name_grupo,p.num_interno,p.descripcion2
	
	from itempresup p, proveedores pp
	
	where p.ppto = '$num_ppto' and p.asoc = '0' and p.proveedor = pp.codigo_interno_proveedor 
	and p.vi = '$version_interna' and p.vc = '$version_externa' order by p.num_interno asc");
	$i = 0;
	while($row = mysql_fetch_array($sql)){
		$numero_item = $row['num_interno'];
		//BUSCO NUEVAMENTE LOS PROVEEDORES Y DEJO POR DEFECTO EL QUE ESTÉ SELECCIONADO.
		$sql_prove = mysql_query("select codigo_interno_proveedor, nombre_comercial_proveedor 
		from proveedores where estado = '1' order by nombre_comercial_proveedor asc");
		$option = "<option value = '0'>[SELECCIONE]</option>";
		while($rowx = mysql_fetch_array($sql_prove)){
			if($rowx['codigo_interno_proveedor'] == $row['codigo_interno_proveedor']){
				$option.="<option value = '".$rowx['codigo_interno_proveedor']."' selected>".$rowx['nombre_comercial_proveedor']."</option>";
			}else{
				$option.="<option value = '".$rowx['codigo_interno_proveedor']."'>".$rowx['nombre_comercial_proveedor']."</option>";
			}
		}
		
		//CAPTURO EL ID CORRESPONDIENTE DE CADA REGISTRO.
		$id = $row['id'];
		
		//PREGUNTO SI LOS ITEMS TIENEN ALGÚN ASOCIADO RELACIONADO.
		$sql_asoc = mysql_query("select p.id,p.proveedor,p.dias,p.q,p.descripcion,p.val_item,p.iva_item,p.fecha_ant,p.cliente,p.por_prov,p.id, p.name_item,p.editable, 
		pp.nombre_comercial_proveedor,pp.codigo_interno_proveedor,p.pk_orden,p.pk_op
		from itempresup p, proveedores pp
		where p.ppto = '$num_ppto' and p.proveedor = pp.codigo_interno_proveedor and p.asoc = '$id' order by p.fecha_registro asc");
		$ix = 1;
		$asociados = "";
		$total_asoc = 0;
		$item_ordenado_funcion = "";
		while($r = mysql_fetch_array($sql_asoc)){
			$xid = $r['id'];
			//BUSCO NUEVAMENTE LOS PROVEEDORES Y DEJO POR DEFECTO EL QUE ESTÉ SELECCIONADO.
			$sql_prove = mysql_query("select codigo_interno_proveedor, nombre_comercial_proveedor 
			from proveedores where estado = '1' order by nombre_comercial_proveedor asc");
			$option_asoc = "<option value = '0'>[SELECCIONE]</option>";
			while($rowx = mysql_fetch_array($sql_prove)){
				if($rowx['codigo_interno_proveedor'] == $r['codigo_interno_proveedor']){
					$option_asoc.="<option value = '".$rowx['codigo_interno_proveedor']."' selected>".$rowx['nombre_comercial_proveedor']."</option>";
				}else{
					$option_asoc.="<option value = '".$rowx['codigo_interno_proveedor']."'>".$rowx['nombre_comercial_proveedor']."</option>";
				}
			}
			$idd = $ix."hijo".$i;
			$total_asoc += ($r['val_item']*$r['q']*$r['dias']);
			$item_ordenado_funcion = "onclick = 'alert_item_ordenado($estado_ppto)'";
			$orden_item = "";
			if($r['pk_op'] != 0){
				$orden_item = "<a class = 'links_documentos' target ='_blank'href = 'pdf_opp.php?op=".$r['pk_op']."' >OP # ".$r['pk_op']."</a>";
			}else if($r['pk_orden'] != 0){
				$orden_item = "<a class = 'links_documentos' target ='_blank' href = 'pdf_op.php?op=".$r['pk_orden']."'>OC # ".$r['pk_orden']."</a>";
			}
			if($r['editable'] == 1 || $estado_ppto == 3 || $estado_ppto == 4 || $estado_ppto == 100){
				$item_ordenado_funcion = "onclick = 'alert_item_ordenado($estado_ppto)'";
				include('asoc_block.php');
			}else{
				include('asoc_edit.php');
			}
			$ix++;
		}
		
		//SALDO TOTAL DE LOS ASOCIADOS
		$visible = "";
		$descr = "";
		$desc2 = "";
		$itemm = "";
		$vnc_item = "";
		$class_vnc = "";
		
		$engranage_asociados = "";
		if($estado_ppto == 1 || $estado_ppto == 2 || $estado_ppto == 5 || $estado_ppto == 6 ){
			$engranage_asociados = "<span class = 'botton_verde'>Asociados<img src = '../images/iconos/Engra.png'  width = '23px' id = 'add_asoc$i' onclick = 'mostrar_asoc_items($i,".$row['editable'].")'/></span>";
		}else if($estado_ppto == 3){
			$engranage_asociados = "";
		}
		if($ix > 1){
			$visible = "style = 'display:block;'";
			$descr = "<textarea cols = '35' rows = '2' id = 'descripcionitem$id'>".utf8_decode($row['descripcion'])."</textarea>";
			$desc2 = "<textarea cols = '35' rows = '2' id = 'descripcionitemdos$id'>".utf8_decode($row['descripcion2'])."</textarea>";
			$itemm = "<input type = 'text' value = '".utf8_decode($row['name_item'])."' id = 'itemppto$id' onkeyup = 'listar_items_tarifarios($id)'/>";
			$asociados.="<tr class = 'hijos_asoc$i' data-dep='$i' style = 'display:none;'>
				<td colspan = '13' align = 'right'><strong>TOTAL</strong></td>
				<td style = 'font-weight:bold;'>
					<table width = '100%'>
						<tr>
							<td>$</td>
							<td align = 'right' id = 'total_asociado_grupo$i'>".number_format($total_asoc)."</td>
						</tr>
					</table>
				</td>
			</tr>";
		}else{
			$visible = "style = 'display:none;'";
			$descr = "<textarea cols = '35' rows = '2' id = 'descripcionitem$id'>".utf8_decode($row['descripcion'])."</textarea>";
			$desc2 = "<textarea cols = '35' rows = '2' id = 'descripcionitemdos$id'>".utf8_decode($row['descripcion2'])."</textarea>";
			$itemm = "<input type = 'text' value = '".utf8_decode($row['name_item'])."' id = 'itemppto$id'  onkeyup = 'listar_items_tarifarios($id)' />";
		}
		
		
		if($row['vnc'] == 1 && ($estado_ppto == 1 || $estado_ppto == 2)){
			$class_vnc = 'vnc_ppto';
			$vnc_item = "<table width = '100%'><tr><td >VNC<span class = 'hidde vnc_real_vnc'>$id</span></td><td><img src = '../images/iconos/eliminar.png' width = '20px' onclick = 'uncheck_item_vnc($id)'/></td></tr></table>";
		}else if($row['vnc'] == 1 && $estado_ppto > 2){
			$class_vnc = 'vnc_ppto';
			$vnc_item = "<table width = '100%'><tr><td>VNC<span class = 'hidde vnc_real_vnc'>$id</span></td></tr></table>";
		}else{
			$vnc_item = "";
		}
		//SI EL PPTO TIENE ITEMS CON ORDEN LLAMO AL ARCHIVO QUE TIENE LA ESTRUCTURA DE BLOQUEO
		$item_ordenado_funcion = "";
		
		
		
		
		if($pregunta_perfil == true &&  ($estado_ppto == 3  || $estado_ppto == 4) ){
			$item_ordenado_funcion = "";
			$desc2 = "<textarea cols = '35' rows = '2' id = 'descripcionitemdos$id'>".utf8_decode($row['descripcion2'])."</textarea>";
			include('edit_ppto.php');
		}else if($row['editable'] == 1 || $estado_ppto == 3 || $estado_ppto == 100 || $estado_ppto == 4){
			$item_ordenado_funcion = "onclick = 'alert_item_ordenado($estado_ppto)'";
			$orden_item = "";
			if($row['pk_op'] != 0 && $row['pk_orden'] == 0){
				$orden_item = "<a class = 'links_documentos'target ='_blank' href = 'pdf_opp.php?op=".$row['pk_op']."' >OP # ".$row['pk_op']."</a>";
			}else if($row['pk_orden'] != 0){
				$orden_item = "<a class = 'links_documentos' target ='_blank'href = 'pdf_op.php?op=".$row['pk_orden']."'>OC # ".$row['pk_orden']."</a>";
			}
			$desc2 = utf8_decode($row['descripcion2']);
			include('block_ppto.php');
		}else{
			$item_ordenado_funcion = "";
			$desc2 = "<textarea cols = '35' rows = '2' id = 'descripcionitemdos$id'>".utf8_decode($row['descripcion2'])."</textarea>";
			include('edit_ppto.php');
		}
		echo $asociados;
		
		$i++;
	}
	echo "<tr class = 'totalizador'>
				<th colspan = '13'></th>
				<th class = 'dil resultados subtotal'>
					<table width = '100%'>
						<tr>
							<td>$</td>
							<td align = 'right' id = 'sum_subtotal_costo_interno'></td>
						</tr>
					</table>
				</th>
				<th colspan = '3'></th>
				<th class = 'dil resultados'>
					<table width = '100%'>
						<tr>
							<td>$</td>
							<td align = 'right' id = 'sum_total_costo_interno'></td>
						</tr>
					</table>
				</th>
				<th colspan = '3'></th>
				<th class = 'ext resultados'>
					<table width = '100%'>
						<tr>
							<td>$</td>
							<td align = 'right' id = 'sum_total_costo_externo'></td>
						</tr>
					</table>
				</th>
			</tr>";
?>