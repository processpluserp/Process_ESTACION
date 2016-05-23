<?php
	include("../Controller/Conexion.php");
	function cuadro_tarifario($data){
		$tabla = "<table id = 'cuadro_tarifa' width = '100%'>
		<tr>
			<th>EMPRESA</th>
			<th>PROVEEDOR</th>
			<th>GRUPO</th>
			<th>ITEM</th>
			<th>VALOR UNIDAD</th>
			<th>% IVA</th>
			<th>% VOLUMEN</th>
		</tr>";
		while($row = mysql_fetch_array($data)){
			$emp = "";
			if($row['empresa'] == 1){
				$emp = "DU BRANDS";
			}else{
				$emp = "LA ESTACION PROMOCIONES Y ACTIVACIONES";
			}
			$tabla .="<tr>
				<td>".$emp."</td>
				<td>".$row['proveedor']."</td>
				<td>".$row['grupo']."</td>
				<td>".$row['name']."</td>
				<td>".number_format($row['tarifa'])."</td>
				<td>".$row['iva']."</td>
				<td>".$row['volumen']."</td>				
			</tr>";
		}
		echo $tabla."</table>";
	}
	
	function consulta_normal(){
		$insert = "select t.empresa,t.name,t.tarifa,t.iva,t.volumen, p.name as proveedor, g.name as grupo from
		item_tarifario t, pro_tarifario p, grupo_tarifario g
		where t.proveedor = p.id and t.grupo = g.id";
		return mysql_query($insert);
	}
	
	function consulta_x_empresa($emp){
		$insert = "select t.empresa,t.name,t.tarifa,t.iva,t.volumen, p.name as proveedor, g.name as grupo from
		item_tarifario t, pro_tarifario p, grupo_tarifario g
		where t.proveedor = p.id and t.grupo = g.id and t.empresa = '$emp'";
		return mysql_query($insert);
	}
	
	function consulta_x_proveedor($emp){
		$insert = "select t.empresa,t.name,t.tarifa,t.iva,t.volumen, p.name as proveedor, g.name as grupo from
		item_tarifario t, pro_tarifario p, grupo_tarifario g
		where t.proveedor = p.id and t.grupo = g.id and t.proveedor = '$emp'";
		return mysql_query($insert);
	}
	
	function consulta_x_grupo($emp){
		$insert = "select t.empresa,t.name,t.tarifa,t.iva,t.volumen, p.name as proveedor, g.name as grupo from
		item_tarifario t, pro_tarifario p, grupo_tarifario g
		where t.proveedor = p.id and t.grupo = g.id and t.grupo = '$emp'";
		return mysql_query($insert);
	}
	
	function consulta_x_name($emp){
		$insert = "select t.empresa,t.name,t.tarifa,t.iva,t.volumen, p.name as proveedor, g.name as grupo from
		item_tarifario t, pro_tarifario p, grupo_tarifario g
		where t.proveedor = p.id and t.grupo = g.id and t.name like '%$emp%'";
		return mysql_query($insert);
	}
	
	function estructura_ppto($n,$ppto){
		$estructura = "<table id = 'estructura_ppto' width = '80%'>
			<tr >
				<th ></th>
				<th ></th>
				<th ></th>
				<th ></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th class = 'cabeceras' colspan = '2'>UTILIDAD VENTA</th>
				<th></th>
				<th class = 'cabeceras' colspan = '2'>UTILIDAD VOLUMEN</th>
				<th></th>
				<th class = 'cabeceras'>TOTAL</th>
			</tr>
			<tr class = 'cabeceras'>
				<td></td>
				<td></td>
				<td>GRUPO</td>
				<td>ÍTEM</td>
				<td>Q</td>
				<td># DÍAS</td>
				<td>DESCRIPCION</td>
				<td>VALOR UNIDAD</td>
				<td> VALOR TOTAL</td>
				<td>VALOR UNIDAD</td>
				<td>VALOR TOTAL</td>
				<td></td>
				<td>GANANCIA</td>
				<td>% GANANCIA</td>
				<td></td>
				<td>GANANCIA VOLUMEN</td>
				<td>% VOLUMEN</td>
				<td></td>
				<td>TOTAL GANANCIA</td>
			</tr>
		";
		$xx = 0;
		$valor_final_mio = 0;
		$valor_final_cliente = 0;
		$valor_final_ganancia = 0;
		$consu = mysql_query("select p.id, p.ppto, p.empresa, p.item as codigo, p.cliente, p.tarifa, p.q, p.dias, p.descripcion, p.valor_cliente,
		g.name as grupo,i.name as item, i.volumen
		from item_ppto_p p, grupo_tarifario g, item_tarifario i where p.ppto = '1' and p.item = i.id and i.grupo = g.id order by g.id asc");
		while($row = mysql_fetch_array($consu)){
			$valor_total = floatval($row['q'])* floatval($row['dias'])*floatval($row['tarifa']);
			$valor_total_cliente = floatval($row['q'])* floatval($row['dias'])*floatval($row['valor_cliente']);
			$ganancia = $valor_total_cliente-$valor_total;
			$valor_final_ganancia +=$ganancia;
			$valor_final_mio += $valor_total;
			$valor_final_cliente += $valor_total_cliente;
			$por_ganancia = 0;
			$por_volumen = floatval($row['volumen']);
			$volumen = $valor_total*($por_volumen/100);
			if($ganancia <= 0){
				$por_ganacia = 0;
			}else{
				$por_ganacia = ($ganancia/$valor_total_cliente)*100;
			}
			
			/*<input type = 'text' name = 'q$xx' id = 'q$xx' class = 'cantidad' value = '".$row['q']."' onkeyup = 'cantidad($xx)'/>*/
			$estructura .="<tr id = '$xx'>
				<td class = 'check_item' id = 'check$xx'><input type = 'checkbox' name = 'seleccionados[]' value = '".$row['codigo']."'/></td>
				<td><img src = '../images/eliminar.png' width:'15px' height = '15px' onclick = 'eliminar_item($xx)'/></td>
				
				<td><span id = 'grupo$xx'>".$row['grupo']."</span></td>
				
				<td id = 'elemento$xx'><span id = 'itemm$xx' ondblclick = 'cambiar_item($xx)'>".$row['item']."</span><span class = 'hidde' id = 'itemm_o$xx'>".$row['codigo']."</span></td>
				
				<td id = 'cantidad_item$xx'><span name = 'q$xx' id = 'q$xx' class = 'cantidad' ondblclick = 'cambiar_cantidad($xx)'>".$row['q']." </span></td>
				
				<td id = 'dias_item$xx'><span name = 'd$xx' id = 'd$xx' class = 'dias' ondblclick = 'cambiar_dias($xx)'>".$row['dias']."</span></td>
				
				<td><textarea id = 'desc$xx' onkeyup = 'guardar_descripcion($xx)'>".$row['descripcion']."</textarea></td>
				
				<td class = 'valores'><span id = 'valor_unidad$xx' >".number_format($row['tarifa'])."</span><span class = 'hidde' id = 'valor_unidad_o$xx' >".$row['tarifa']."</span></td>
				
				<td class = 'valores2'><span id = 'valor_total$xx' >".number_format($valor_total)."</span><span class = 'hidde' id = 'valor_total_o$xx' >".$valor_total."</span></td>
				
				<td id = 'val_cliente$xx'><span name = 'val_unidad_c$xx' id = 'val_unidad_c$xx' class = 'val_unidad_c' ondblclick = 'cambiar_cliente($xx)'>".$row['valor_cliente']."</span></td>
				
				<td class = 'val_total'><span id = 'v_total_c$xx'>".number_format($valor_total_cliente)."</span><span class = 'hidde' id = 'v_total_c_o$xx'>".$valor_total_cliente."</span></td>
				
				<td></td>
				<td class = 'ganancia_class'><span id = 'ganancia$xx'>".number_format(($valor_total_cliente-$valor_total))."</span><span class = 'hidde' id = 'ganancia_o$xx'>".($valor_total_cliente-$valor_total)."</span></td>
				
				<td><span id ='por_ganancia$xx'>".number_format($por_ganacia)."</span><span class = 'hidde' id ='por_ganancia_o$xx'>".($por_ganacia)."</span></td>
				
				<td></td>
				<td class = 'ganancia_volumen'><span id = 'ganancia_vol$xx'>".number_format($volumen)."</span><span class = 'hidde' id = 'ganancia_vol_o$xx'>".$volumen."</span></td>
				
				<td class ='volumen'><span id = 'por_volumen$xx'>".$por_volumen."</span><span class = 'hidde' id = 'por_volumen_o$xx'>".$por_volumen."</span></td>
				
				<td></td>
				<td class = 'suma_ganancias' ><span id = 'total_ganacia$xx'>".number_format($ganancia+$volumen)."</span><span class = 'hidde' id = 'total_ganacia_o$xx'>".($ganancia+$volumen)."</span></td>
				
			</tr>";
			$xx++;
		}
		$n = $n + $xx;
		for($i = $xx; $i<$n;$i++){
			$estructura .="<tr id = '$i'>
				<td class = 'check_item' id = 'check$i'></td>
				<td><img src = '../images/eliminar.png' width:'15px' height = '15px' onclick = 'eliminar_item($xx)'/></td>
				<td><span id = 'grupo$i'></span></td>
				<td id = 'elemento$i'>

					<input type = 'text' name = 'item$i' id = 'item$i' class = 'item' onkeyup = 'consultar_item($i)'/>
					<div id = 'lista$i'></div>
				</td>
				<td id = 'cantidad_item$i'><span name = 'q$i' id = 'q$i' class = 'cantidad' ondblclick = 'cambiar_cantidad($i)'>0</span></td></td>
				
				<td id = 'dias_item$i'><span name = 'd$i' id = 'd$i' class = 'dias' ondblclick = 'cambiar_dias($i)'>0</span></td>
				
				<td><textarea id = 'desc$i' onkeyup = 'guardar_descripcion($i)'></textarea></td>
				<td class = 'valores'><span id = 'valor_unidad$i' >0</span><span class = 'hidde' id = 'valor_unidad_o$i' >0</span></td>
				<td class = 'valores2'><span id = 'valor_total$i' >0</span><span class = 'hidde' id = 'valor_total_o$i' >0</span></td>
				<td id = 'val_cliente$i'><span name = 'val_unidad_c$i' id = 'val_unidad_c$i' class = 'val_unidad_c' ondblclick = 'cambiar_cliente($i)'>0</span></td>
				<td class = 'val_total'><span id = 'v_total_c$i'>0</span><span class = 'hidde' id = 'v_total_c_o$i'>0</span></td>
				<td></td>
				<td class = 'ganancia_class'><span id = 'ganancia$i'>0</span><span class = 'hidde' id = 'ganancia_o$i'>0</span></td>
				<td><span id ='por_ganancia$i'>0</span><span class = 'hidde' id ='por_ganancia_o$i'>0</span></td>
				<td></td>
				<td class = 'ganancia_volumen'><span id = 'ganancia_vol$i'>0</span><span class = 'hidde' id = 'ganancia_vol_o$i'>0</span></td>
				<td class = 'volumen'><span id = 'por_volumen$i'>0</span><span class = 'hidde' id = 'por_volumen_o$i'>0</span></td>
				<td></td>
				<td class = 'suma_ganancias'><span id = 'total_ganacia$i'>0</span><span class = 'hidde' id = 'total_ganacia_o$i'>0</span></td>
			</tr>";
		}
		$estructura .="<tr class = 'barra_final'>
			<td></td>
			<td colspan = '7' class = 'barra_final_ppto'>TOTAL GENERAL</td>
			<td><span id = 'valor_final_mio'>".number_format($valor_final_mio)."</span><span class = 'hidde' id = 'valor_final_mio_o'>".$valor_final_mio."</span></td>
			<td></td>
			<td><span id = 'total_cliente'>".number_format($valor_final_cliente)."</span><span class = 'hidde' id = 'total_cliente_o'>".$valor_final_cliente."</span></td>
			<td></td>
			<td><span id = 'total_ganancia'>".number_format($valor_final_ganancia)."</span><span class = 'hidde' id = 'total_ganancia_o'>".$valor_final_ganancia."</span></td>
			<td><span id = 'total_por_ganancia'></span><span class = 'hidde' id = 'total_por_ganancia_o'></span></td>
			<td></td>
			<td><span id = 'total_volumen'></span><span class = 'hidde' id = 'total_volumen_o'></span></td>
			<td><span id = 'total_por_volumen'></span><span class = 'hidde' id = 'total_por_volumen_o'></span></td>
			<td></td>
			<td><span id = 'total_total_ganancia'></span><span class = 'hidde' id = 'total_total_ganancia_o'></span></td>
			</tr></table>
		";
		echo $estructura;
	}
	$t = $_POST['turno'];
	
	//Insert Grupo
	if($t == 1){
		$insert = "insert into grupo_tarifario(name) 
		values('".$_POST['name']."')";
		$result = mysql_query($insert);
		echo "1";
	}
	
	//Insert Proveedor{
	else if($t == 2){
		$insert = "insert into pro_tarifario(nit,name) values('".$_POST['nit']."','".$_POST['name']."')";
		$result = mysql_query($insert);
		echo "1";
	}
	
	//Consulta Proveedores
	else if($t == 3){
		$select = mysql_query("select id,nit,name from pro_tarifario");
		while($row = mysql_fetch_array($select)){
			$id = $row['id'];
			echo "<option value = '$id'>".$row['name']."</option>";
		}
	}
	
	//Consulta grupos
	else if($t == 4){
		$select = mysql_query("select id,name from grupo_tarifario");
		while($row = mysql_fetch_array($select)){
			$id = $row['id'];
			echo "<option value = '$id'>".$row['name']."</option>";
		}		
	}
	
	//Guarda tarifas
	else if($t == 5){
		$insert = mysql_query("insert into item_tarifario(name,empresa,proveedor,grupo,tarifa,iva,volumen) 
		values('".$_POST['item']."','".$_POST['emp']."','".$_POST['pro']."','".$_POST['grup']."','".$_POST['tar']."','".$_POST['iva']."','".$_POST['vol']."')");
		echo "1";
	}
	
	//Cuando carga la página
	else if($t == 6){
		cuadro_tarifario(consulta_normal());
	}
	
	//Cuando cambian de empresa
	else if($t == 7){
		cuadro_tarifario(consulta_x_empresa($_POST['emp']));
	}
	
	//Cuando cambian de Proveedor
	else if($t == 8){
		cuadro_tarifario(consulta_x_proveedor($_POST['emp']));
	}
	//Cuando cambian de Grupo
	else if($t == 9){
		cuadro_tarifario(consulta_x_grupo($_POST['emp']));
	}
	//Cuando cambian de Nombre
	else if($t == 10){
		cuadro_tarifario(consulta_x_name($_POST['emp']));
	}
	//Estrutura ppto Pedro
	else if($t == 11 ){
		estructura_ppto(10,1);
	}
	
	//Cuando empieza a escribir en el item
	else if($t == 12){
		$name = $_POST['item'];
		if($name == ""){
			
		}else{
			$cel = mysql_query("select * from item_tarifario t where name like '%$name%'");
			$options = "";
			while($row = mysql_fetch_array($cel)){
				$xid = $row['id'];
				$options .= "<input type = 'radio' id ='new_item$xid' name = 'new_item' value ='$xid' onclick ='select_item()' >
				<label for = 'new_item$xid'>".$row['name']."</label></br>";
			}
			echo $options;
		}
		
	}
	
	//Cuando selecciona un item
	else if($t == 13){
		$id = $_POST['id'];
		$emp = 1;
		$clie = 1;
		$bn = 1;
		$mal = 0;
		$ppto = 1;
		$consulta = mysql_query("select empresa from item_ppto_p where item = '$id'");
		if(mysql_num_rows($consulta) == 0){
			$cel = mysql_query("select t.empresa,t.name,t.tarifa,t.iva,t.volumen, p.name as proveedor, g.name as grupo from
			item_tarifario t, pro_tarifario p, grupo_tarifario g
			where t.proveedor = p.id and t.grupo = g.id and t.id = '$id'");
			while($row = mysql_fetch_array($cel)){
				echo $bn."****".$row['tarifa']."****".$row['grupo']."****".$row['proveedor']."****".$row['volumen'];
				$insert = mysql_query("insert into item_ppto_p(empresa,cliente,item,tarifa,ppto) values('".$emp."','".$clie."','".$id."','".$row['tarifa']."','".$ppto."')");
			}
		}else{
			echo "0****";
		}	
	}
	
	//Inserto los días y cantidad para cada item
	else if($t == 14){
		$q = $_POST['q'];
		$d = $_POST['d'];
		$id = $_POST['id'];
		$insert = mysql_query("update item_ppto_p set q = '$q',dias = '$d' where item = '$id'");
	}
	
	//Eliminar item ppto
	else if($t == 15){
		$id = $_POST['id'];
		$delete = mysql_query("delete from item_ppto_p where item = '$id'");
	}
	
	//Guardar valor cliente
	else if($t == 16){
		$id = $_POST['id'];
		$valor = $_POST['valor'];
		$insert = mysql_query("update item_ppto_p set valor_cliente = '$valor' where item = '$id'");
	}
	
	//Guarda la descripcion del item
	else if($t == 17){
		$id = $_POST['id'];
		$desc = $_POST['text'];
		$insert = mysql_query("update item_ppto_p set descripcion = '$desc' where item = '$id'");
	}
	
	//Orden de Trabajo
	else if($t == 18){
		
	}
?>