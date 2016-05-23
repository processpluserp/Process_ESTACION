<?php
	$ppto = $_SESSION["num_ppto"];
	$consulta = "select codigo_interno_proveedor, nombre_comercial_proveedor from proveedores";
	$result = mysql_query($consulta);
	$proveedor = "";
	while($row = mysql_fetch_array($result)){
		$proveedor .="<option value = ".$row['nombre_comercial_proveedor'].">".$row['nombre_comercial_proveedor']."</option>";
	}
	
	$consulta2 = "select codigo_int_celula, consecutivo,nombre_celula from cecula_ppto_interno where pk_ppto_interno = '$ppto' order by codigo_int_celula desc";
	$result2 = mysql_query($consulta2);
	$celulas = "<select id = 'celu'>";
	$celulas2 = "<select id = 'celu2'>";
	$sub_celulas = "";
	$val1 = 0;
	$val2 = 0;
	$val3 = 0;
	$val4 = 0;
	$val5 = 0;
	$val6 = 0;
	//Valores cuadritos
	$suma_venta_total = 0;
	$suma_no_comisionables = 0;
	$total_costo_ejecuction = 0;
	$total_comisiones_descuentos=0;
	
	$r = 0;
	$rt = 0;
	while($row = mysql_fetch_array($result2)){
		$o = $row['codigo_int_celula'];
		$celulas .="<option value = ".$row['codigo_int_celula'].">".$row['nombre_celula']."</option>";
		$celulas2 .="<option value = ".$row['codigo_int_celula'].">".$row['nombre_celula']."</option>";
		
		if($row['consecutivo'] == 1){
			$sub_celulas .="<tr>
				<th colspan = '60' class = 'encabezado' id = 'va_com'>".$row['nombre_celula']."</th>
			</tr>
			";
		}else{
			
			$sub_celulas .="<tr>
				<th colspan = '60' class = 'encabezado' id = 't$rt'>".$row['nombre_celula']."</th>
			</tr>
			";
		}
			
		$consulta3 = "select codigo_interno_item,item,descripcion,proveedor,dias,cantidad,valor_anticipo,por,fecha,unitario1,total1,
		unitario2,total2,valor,por_valor,unitario3,total3,valor2,por_valor2,valor_final,por_final from dppto_interno where codigo_celuda = $o";
		$result3 = mysql_query($consulta3);
	
		while($row2 = mysql_fetch_array($result3)){
			if($row['consecutivo'] == 1){
				$suma_no_comisionables +=floatval($row2['unitario3']);
			}else{
				$suma_venta_total +=  floatval($row2['total3']);
				$total_comisiones_descuentos += floatval($row2['valor_final']);
			}
			$total_costo_ejecuction = $suma_no_comisionables + $suma_venta_total;
			
			$val1 = $val1 + intval($row2['valor_anticipo']);
			$val2 = $val2 + floatval($row2['total1']);
			$val3 = $val3 + floatval($row2['valor']);
			$val4 = $val4 + floatval($row2['total3']);
			$val5 = $val5 + floatval($row2['valor2']);
			$val6 = $val6 + floatval($row2['valor_final']);
			$sub_celulas .= "<tr id = 'c$r'>
				<td class = 'ocultos'><span class = 'id'>".$row2['codigo_interno_item']."</span></td>
				
				<td class = 'encabezado'><span class = 'item'>".$row2['item']."</span></td>
				<td class = 'ocultos'><span class = 'item'>".$row2['item']."</span></td>
				
				<td class = 'encabezado' COLSPAN = '30'><span class = 'descripcion'>".$row2['descripcion']."</span></td>
				<td class = 'ocultos' COLSPAN = '30'><span class = 'descripcion'>".$row2['descripcion']."</span></td>
				
				<td class = 'encabezado'><span class = 'proveedor'>".$row2['proveedor']."</span></td>
				<td class = 'ocultos'><span class = 'proveedor'>".$row2['proveedor']."</span></td>
				
				<td class = 'encabezado' style = 'background-color: #3A9CCA;'><span class = 'cantidad' >".$row2['cantidad']."</span></td>
				<td class = 'ocultos' style = 'background-color: #3A9CCA;'><span class = 'cantidad' >".$row2['cantidad']."</span></td>
				
				
				<td class = 'encabezado' style = 'background-color: #3A9CCA;'><span class = 'dias' >".$row2['dias']."</span></td>
				<td class = 'ocultos' style = 'background-color: #3A9CCA;'><span class = 'dias' >".$row2['dias']."</span></td>
				
				<td class = 'espacios'></td>
				<td class = 'espacios'></td>
				
				<td class = 'encabezado' style = 'background-color: #F1DCDC;'><span class = 'valor'>".number_format($row2['valor_anticipo'])."</span></td>
				<td class = 'ocultos' style = 'background-color: #F1DCDC;'><span class = 'valor'>".number_format($row2['valor_anticipo'])."</span></td>
				
				<td class = 'encabezado' style = 'background-color: #3A9CCA;'><span class = 'por_anticipo'>".number_format($row2['por'])."</span></td>
				<td class = 'ocultos' style = 'background-color: #3A9CCA;'><span class = 'por_anticipo'>".($row2['por'])."</span></td>
				
				<td class = 'encabezado' style = 'background-color: #3A9CCA;'><span class = 'fecha_anticipo'>".$row2['fecha']."</span></td>
				<td class = 'ocultos' style = 'background-color: #3A9CCA;'><span class = 'fecha_anticipo'>".$row2['fecha']."</span></td>
				
				<td class = 'espacios'></td>
				<td class = 'espacios'></td>
				<td class = 'encabezado' style = 'background-color: #D37CEB;'><span class = 'unitario1'>".number_format($row2['unitario1'])."</span></td>
				<td class = 'ocultos' style = 'background-color: #D37CEB;'><span class = 'unitario1'>".number_format($row2['unitario1'])."</span></td>
				
				<td class = 'encabezado' style = 'background-color: #D37CEB;'><span class = 'total1'>".number_format($row2['total1'])."</span></td>
				<td class = 'ocultos' style = 'background-color: #D37CEB;'><span class = 'total1'>".number_format($row2['total1'])."</span></td>
				
				<td class = 'espacios'></td>
				<td class = 'encabezado' style = 'background-color: #3A9CCA;'><span class = 'vcotizacion'>".number_format($row2['unitario2'])."</span></td>
				<td class = 'ocultos' style = 'background-color: #3A9CCA;'><span class = 'vcotizacion'>".($row2['unitario2'])."</span></td>
				
				<td class = 'encabezado' style = 'background-color: #FA65C3;'><span class = 'total_cotizacion'>".number_format($row2['total2'])."</span></td>
				<td class = 'ocultos' style = 'background-color: #FA65C3;'><span class = 'total_cotizacion'>".number_format($row2['total2'])."</span></td>
				
				<td class = 'espacios'></td>
				<td class = 'encabezado' style = 'background-color: #E8C8DC;'><span class = 'val_negociacion'>".number_format($row2['valor'])."</span></td>
				<td class = 'ocultos' style = 'background-color: #E8C8DC;'><span class = 'val_negociacion'>".($row2['valor'])."</span></td>
				
				<td class = 'encabezado' style = 'background-color: #3A9CCA;'><span class = 'por_nego'>".number_format($row2['por_valor'])."</span></td>
				<td class = 'ocultos' style = 'background-color: #3A9CCA;'><span class = 'por_nego'>".number_format($row2['por_valor'])."</span></td>
				
				<td class = 'espacios'></td>
				<td class = 'encabezado' style = 'background-color: #3A9CCA;'><span class = 'valor_venta'>".number_format($row2['unitario3'])."</span></td>
				<td class = 'ocultos' style = 'background-color: #3A9CCA;'><span class = 'valor_venta'>".($row2['unitario3'])."</span></td>
				
				<td class = 'encabezado' style = 'background-color: #C8F3DB;'><span class = 'total_venta'>".number_format($row2['total3'])."</span></td>
				<td class = 'ocultos' style = 'background-color: #C8F3DB;'><span class = 'total_venta'>".number_format($row2['total3'])."</span></td>
				
				<td class = 'espacios'></td>
				<td class = 'encabezado' style = 'background-color: #E8C8DC;'><span class = 'val_comision_venta'>".number_format($row2['valor2'])."</span></td>
				<td class = 'ocultos' style = 'background-color: #E8C8DC;'><span class = 'val_comision_venta'>".number_format($row2['valor2'])."</span></td>
				
				<td class = 'encabezado' style = 'background-color: #3A9CCA;'><span class = 'por_comision_venta'>".number_format($row2['por_valor2'])."</span></td>
				<td class = 'ocultos' style = 'background-color: #3A9CCA;'><span class = 'por_comision_venta'>".($row2['por_valor2'])."</span></td>
				<td class = 'espacios'></td>
				<td class = 'espacios'></td>
				<td class = 'encabezado' style = 'background-color: #F2B449;'><span class = 'total_comision'>".number_format($row2['valor_final'])."</span></td>
				<td class = 'ocultos' style = 'background-color: #F2B449;'><span class = 'total_comision'>".number_format($row2['valor_final'])."</span></td>
				
				<td class = 'encabezado' style = 'background-color: #F2B449;'><span class = 'por_comision'>".number_format($row2['por_final'])."</span></td>
				<td class = 'ocultos' style = 'background-color: #F2B449;'><span class = 'por_comision'>".number_format($row2['por_final'])."</span></td>
				
				<td class = 'encabezado' style = 'background-color: #F2B449;'><span class = 'por_comision'><a href = '#' onclick = 'editar($r)'>E</a></span></td>
				<td></td>
				<td></td>
				<td></td>
				<td class = 't'>".number_format($row2['unitario3'])."</td>
				<td class = 'ocultos'>".number_format($row2['unitario3'])."</td>
				
				<td class = 't'>".number_format($row2['total3'])."</td>
				<td class = 'ocultos'>".number_format($row2['total3'])."</td>
			</tr>";
			$r++;
		}
		
		$sub_celulas .= "<tr>
				<td></td>
				<td COLSPAN = '30'></td>
				<td></td>
				<td></td>
				<td></td>
				<td class = 'espacios'></td>
				<td class = 'espacios'></td>
				<td class = 'encabezado' style = 'background-color: #F1DCDC;'><span class = 'valor'>".number_format($val1)."</span></td>
				<td></td>
				<td></td>
				<td class = 'espacios'></td>
				<td class = 'espacios'></td>
				<td></td>
				<td class = 'encabezado' style = 'background-color: #D37CEB;'><span class = 'total1'>".number_format($val2)."</span></td>
				<td class = 'espacios'></td>
				<td></td>
				<td></td>
				<td></td>
				<td class = 'encabezado' style = 'background-color: #E8C8DC;'><span class = 'val_negociacion'>".number_format($val3)."</span></td>
				<td></td>
				<td class = 'espacios'></td>
				<td></td>
				<td class = 'encabezado' style = 'background-color: #C8F3DB;'><span class = 'total_venta'>".number_format($val4)."</span></td>
				<td class = 'espacios'></td>
				<td class = 'encabezado' style = 'background-color: #E8C8DC;'><span class = 'val_comision_venta'>".number_format($val5)."</span></td>
				<td></td>
				<td class = 'espacios'></td>
				<td class = 'espacios'></td>
				<td class = 'encabezado' style = 'background-color: #F2B449;'><span class = 'total_comision'>".number_format($val6)."</span></td>
				<td></td>
			</tr>";
			$val1 = 0;
			$val2 = 0;
			$val3 = 0;
			$val4 = 0;
			$val5 = 0;
			$val6 = 0;
			$rt++;
	}
	$celulas .= "</select>";
	$celulas2 .= "</select>";
	
	
?>