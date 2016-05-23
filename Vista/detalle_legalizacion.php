<?php
	include("../Controller/Conexion.php");
	
	$id = $_POST['id'];
	$sql = mysql_query("select * from legalizaciones_items where pk_anticipo ='$id'");
	
	$table = "
		<tr>
			<th>Factura</th>
			<th>Fecha</th>
			<th>Nit</th>
			<th>Beneficiario</th>
			<th>Concepto</th>
			<th>Teléfono</th>
			<th>Valor</th>
			<th>Iva</th>
			<th>Retención</th>
		</tr>
	";
	
	while($row = mysql_fetch_array($sql)){
		$table .="<tr>
			<td>".$row['factura']."</td>
			<td>".$row['fecha_factura']."</td>
			<td>".$row['nit']."</td>
			<td style = 'text-align:left;'>".$row['beneficiario']."</td>
			<td style = 'text-align:left;'>".nl2br(utf8_decode($row['concepto']))."</td>
			<td style = 'text-align:right;'>".$row['telefono']."</td>
			<td style = 'text-align:right;'>$ ".number_format($row['valor'])."</td>
			<td style = 'text-align:right;'>$ ".number_format($row['iva'])."</td>
			<td style = 'text-align:right;'>$ ".number_format($row['retencion'])."</td>
		</tr>";
		
	}
	
	$table.="</table>";
	echo $table;
?>