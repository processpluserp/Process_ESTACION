<?php
	include("../Controller/Conexion.php");
	include("../Modelo/ppto_produccion.php");
	
	$turno = $_POST['turno'];
	
	
	
	if($turno == 1){
		$ppto = $_POST['ppto'];
		$vi = $_POST['vi'];
		$vc = $_POST['vc'];
		$proveedor = $_POST['prove'];
		$est = "<table width = '100%' style = 'border-collapse:collapse;'>
			<tr>
				<td>
					
				</td>
				<td colspan = '6'>
					<p>Seleccione al menos un item</p>
				</td>
			</tr>
			<tr>
				<th align = 'center'>
					<div>
						<input type = 'checkbox' value = '0' id = 'sel_todo_form_op'  class = 'radio' onclick = 'sel_del_all_formop()'/>
						<label for='itemop'><span><span></span></span></label>
					</div>
				</th>
				<th>#</th>
				<th>Grupo</th>
				<th>Item</th>
				<th>Días</th>
				<th>Cant.</th>
				<th>Valor Unt.</th>
				<th>Total</th>
			</tr>";
		$sql_op = mysql_query("select id,name_grupo,name_item,dias,q,val_item,descripcion,iva_item,asoc,num_interno,pk_op
		from itempresup 
		where ppto = '$ppto' and vi = '$vi' and vc = '$vc' and proveedor = '$proveedor' AND pk_op = 0 and pk_orden = 0");
		while($row = mysql_fetch_array($sql_op)){
			$num_op = "";
			if($row['pk_op'] != 0){
				$num_op = "# ".$row['pk_op'];
			}
			
			$id = $row['id'];
			$text = "";
			if($row['asoc'] != 0){
				$text = "ASOCIADO";
			}else{
				$text = $row['name_grupo'];
			}
			$est .="
				<tr>
					<td style = 'border:1px solid black;' align = 'center'>
						<div>
							<input type = 'checkbox' id = 'itemop$id' name = 'itemop[]' value = '$id'  class = 'radio radioformop'/>
							<label for='itemop$id'><span><span></span></span></label>
						</div>
					</td>
					<td style = 'border:1px solid black;padding-left:5px;'>".($row['num_interno'])."</td>
					<td style = 'border:1px solid black;padding-left:5px;'>".utf8_decode($text)."</td>
					<td style = 'border:1px solid black;padding-left:5px;'>".utf8_decode($row['name_item'])."</td>
					<td style = 'border:1px solid black;padding-left:5px;'>".$row['dias']."</td>
					<td style = 'border:1px solid black;padding-left:5px;'>".$row['q']."</td>
					<td style = 'border:1px solid black;padding-left:5px;'>".number_format($row['val_item'])."</td>
					<td style = 'border:1px solid black;padding-left:5px;'>".number_format($row['val_item']*$row['q']*$row['dias'])."</td>
				</tr>";
		}
		$est.="</table>";
		echo $est;
	}else if($turno == 2){
		$ppto = $_POST['ppto'];
		$vi = $_POST['vi'];
		$vc = $_POST['vc'];
		$proveedor = $_POST['prove'];

		$item = $_POST['items'];		
		$lugar = $_POST['lugar'];
		$vfi = $_POST['vfi'];
		$vff = $_POST['vff'];
		$fpago = $_POST['fpago'];
		$ot = $_POST['ot'];
		$nota = $_POST['nota'];
		$user = $_POST['user'];
		mysql_query("start transaction");
			mysql_query("insert into produccion_orden(ppto,vi,vc,ot,proveedor,user,lugar,vigencia_inicial,vigencia_final,pago,estado,nota)
			values ('$ppto','$vi','$vc','$ot','$proveedor','$user','$lugar','$vfi','$vff','$fpago','1','$nota')");
		$sql_consult = mysql_query("SELECT @@identity AS id");
		$id = "";
		mysql_query("COMMIT");
		while($row = mysql_fetch_row($sql_consult)){
			$id = $row[0];
		}
		for($i = 0; $i < count($item); $i++){
			$cons = mysql_query("select name_item,name_grupo,dias,q,descripcion,val_item,iva_item,por_prov 
			from itempresup where id = '$item[$i]'");
			while($row = mysql_fetch_array($cons)){
				mysql_query("insert into detalle_produccion_orden(pk_item,name_item,name_grupo,dias,q,descripcion,val_item,iva_item,por_prov,user,op)
				values('$item[$i]','".$row['name_item']."','".$row['name_grupo']."','".$row['dias']."','".$row['q']."','".$row['descripcion']."','
				".$row['val_item']."','".$row['iva_item']."','".$row['por_prov']."','$user','$id')");
				
				mysql_query("update itempresup set editable = '1', pk_op = '$id' where id = '$item[$i]'");
			}
			
		}
		mysql_query("update cabpresup set estado_presup = '6' where codigo_presup = '$ppto'");
		mysql_query("commit");
		echo $id;
	}else if($turno == 3){
		$item = $_POST['vnc'];
		mysql_query("start transaction");
			for($i = 0; $i < count($item); $i++){
				mysql_query("update itempresup set vnc = '1' where id = '$item[$i]'");
			}		
		mysql_query("COMMIT");
	}else if($turno == 4){
		mysql_query("begin");
			$sql_update = mysql_query("update itempresup set vnc = '0' where id = '".$_POST['id']."'");
			if($sql_update){
				mysql_query("COMMIT");
				echo "Completado :".mysql_errno();
			}else{
				mysql_query("ROLLBACK");
				echo "Error : ".mysql_errno()." Id: ".$_POST['id'];
			}
		
	}else if($turno == 5){
		$ppto = $_POST['ppto'];
		$vi = $_POST['vi'];
		$vc = $_POST['vc'];
		$proveedor = $_POST['prove'];
		$est = "<table width = '100%' style = 'border-collapse:collapse;'>
			<tr>
				<td>
					
				</td>
				<td colspan = '6'>
					<p>Seleccione al menos un item</p>
				</td>
			</tr>
			<tr>
				<th align = 'center'>
					<div>
						<input type = 'checkbox' value = '0' id = 'sel_todo_form_op'  class = 'radio' onclick = 'sel_del_all_formop()'/>
						<label for='itemop'><span><span></span></span></label>
					</div>
				</th>
				<th>Grupo</th>
				<th>Item</th>
				<th>Días</th>
				<th>Cant.</th>
				<th>Valor Unt.</th>
				<th>Total</th>
				<th>OP</th>
			</tr>";
		$sql_op = mysql_query("select id,name_grupo,name_item,dias,q,val_item,descripcion,iva_item,pk_op,asoc
		from itempresup 
		where ppto = '$ppto' and vi = '$vi' and vc = '$vc' and proveedor = '$proveedor' and pk_orden = 0");
		while($row = mysql_fetch_array($sql_op)){
			$id = $row['id'];
			$num_op = "";
			if($row['pk_op'] != 0){
				$num_op = "# ".$row['pk_op'];
			}
			
			$id = $row['id'];
			$text = "";
			if($row['asoc'] != 0){
				$text = "ASOCIADO";
			}else{
				$text = $row['name_grupo'];
			}
			$est .="
				<tr>
					<td style = 'border:1px solid black;' align = 'center'>
						<div>
							<input type = 'checkbox' id = 'itemop$id' name = 'itemop[]' value = '$id'  class = 'radio radioformop'/>
							<label for='itemop$id'><span><span></span></span></label>
						</div>
					</td>
					
					<td style = 'border:1px solid black;padding-left:5px;'>".utf8_decode($text)."</td>
					<td style = 'border:1px solid black;padding-left:5px;'>".utf8_decode($row['name_item'])."</td>
					<td style = 'border:1px solid black;padding-left:5px;'>".$row['dias']."</td>
					<td style = 'border:1px solid black;padding-left:5px;'>".$row['q']."</td>
					<td style = 'border:1px solid black;padding-left:5px;'>".number_format($row['val_item'])."</td>
					<td style = 'border:1px solid black;padding-left:5px;'>".number_format($row['val_item']*$row['q']*$row['dias'])."</td>
					<td style = 'border:1px solid black;padding-left:5px;'>".($num_op)."</td>
				</tr>";
		}
		$est.="</table>";
		echo $est;
	}else if($turno == 6){
		$ppto = $_POST['ppto'];
		$vi = $_POST['vi'];
		$vc = $_POST['vc'];
		$proveedor = $_POST['prove'];

		$item = $_POST['items'];		
		$lugar = $_POST['lugar'];
		$vfi = $_POST['vfi'];
		$vff = $_POST['vff'];
		$fpago = $_POST['fpago'];
		$ot = $_POST['ot'];
		$user = $_POST['user'];
		$nota = $_POST['nota'];
		$fradicacion = $_POST['fradicacion'];
		$fentrega = $_POST['fentrega'];
		mysql_query("start transaction");
			mysql_query("insert into orproduccion(ppto,vi,vc,ot,proveedor,usu_orden,lugar,vigencia_inicial,vigencia_final,fpago,descripcion_nota,
			fecha_entrega,fecha_radicacion_orden,fecha_orden)
			values ('$ppto','$vi','$vc','$ot','$proveedor','$user','$lugar','$vfi','$vff','$fpago','$nota','$fentrega','$fradicacion','".date("Y-m-d h:i:s")."')");
		$sql_consult = mysql_query("SELECT @@identity AS id");
		$id = "";
		
		while($row = mysql_fetch_row($sql_consult)){
			$id = $row[0];
		}
		for($i = 0; $i < count($item); $i++){
			$cons = mysql_query("select name_item,name_grupo,dias,q,descripcion,val_item,iva_item,por_prov 
			from itempresup where id = '$item[$i]'");
			while($row = mysql_fetch_array($cons)){
				mysql_query("insert into detalle_orden(item,name_item,descx,d,q,valor,iva,vol,noorden)
				values('$item[$i]','".$row['name_item']."','".$row['descripcion']."','".$row['dias']."','".$row['q']."','".$row['val_item']."','
				".$row['iva_item']."','".$row['por_prov']."')");
				
				mysql_query("update itempresup set editable = '1', pk_orden = '$id' where id = '$item[$i]'");
			}
			
		}
		mysql_query("update cabpresup set estado_presup = '6' where codigo_presup = '$ppto'");
		mysql_query("commit");
		echo $id;
	}else if($turno == 7){
		$ppto_item = new ppto_produccion();
		echo $ppto_item->buscar_ordenes($_POST['valor'],$_POST['tipo'],$_POST['ppto']);
	}else if($turno == 8){
		mysql_query("start transaction");
			mysql_query("update produccion_orden set rcancelacion = '".$_POST['razon']."', estado = '0',usercancelacion = '".$_POST['user']."'
			where id = '".$_POST['op']."'");
			
			mysql_query("update itempresup set editable = '0', pk_op = '0' where pk_op = '".$_POST['op']."'");
		mysql_query("commit");
	}else if($turno == 9){
		mysql_query("start transaction");
			mysql_query("update orproduccion set razon_cancelacion = '".$_POST['razon']."',usercancelacion = '".$_POST['user']."'
			where codigo_interno_op = '".$_POST['oc']."'");
			
			mysql_query("update itempresup set editable = '0', pk_orden = '0' where pk_orden = '".$_POST['oc']."'");
		mysql_query("commit");
	}
?>