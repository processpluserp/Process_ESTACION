<?php
	$asociados .= "
		<tr class = 'hijos_asoc$i' id = '$idd' data-dep='$i' > 
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td >$orden_item</td>
			<td align = 'center'  >
				<img src = '../images/iconos/lock.png' width = '15px' $item_ordenado_funcion/>
			</td>
			<td ></td>
			<td class = 'border_table asoc'>".$r['name_item']."</td>
			<td class = 'border_table asoc'>".$r['descripcion']."</td>
			<td class = 'border_table asoc'>".$r['nombre_comercial_proveedor']."</td>
			<td class = 'border_table asoc' align = 'center'>".number_format($r['dias'])."</td>
			<td class = 'border_table asoc' align = 'center'>".number_format($r['q'])."</td>
			<td class = 'border_table asoc' align = 'center'>
				<table width = '100%'>
					<tr>
						<td>$</td>
						<td align = 'right' >".number_format($r['val_item'])."</td>
					</tr>
				</table>
			</td>
			<td class = 'border_table asoc' align = 'center'>
				<table width = '100%'>
					<tr>
						<td>$</td>
						<td align = 'right' >".number_format($r['val_item']*$r['q']*$r['dias'])."</td>
					</tr>
				</table>
			</td>
		</tr>";
	
	
?>