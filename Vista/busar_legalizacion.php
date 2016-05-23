<?php
	include("../Controller/Conexion.php");
	
	if(isset($_POST['id']) && isset($_POST['user']) ){
		$turno = $_POST['turno'];
		if($turno == 1){
			$id = $_POST['id'];
		
			$sql_lega = mysql_query("select l.factura,l.valor,l.id,l.fecha_factura,l.fecha,p.num_interno,l.pk_anticipo,p.name_item
				from legalizaciones_items l,cuerpo_anticipo cp, itempresup p
				where l.pk_anticipo = '$id' and l.estado = '1' and cp.pk_anticipo = l.pk_anticipo and cp.pk_item = p.id");
			$tabla = "<table class = 'tablas_muestra_datos_tablas_trafico facturas_sobre_anticipo'>
				<tr>
					<th style = 'padding-left:5px;padding-right:5px;'>Eliminar</th>
					<th style = 'padding-left:5px;padding-right:5px;'>Editar</th>
					<th style = 'padding-left:5px;padding-right:5px;'># Item</th>
					<th style = 'padding-left:5px;padding-right:5px;'>Nombre Item</th>
					<th style = 'padding-left:5px;padding-right:5px;'># Anticipo</th>
					<th style = 'padding-left:5px;padding-right:5px;'>Factura</th>
					<th style = 'padding-left:5px;padding-right:5px;'>Fecha Factura</th>
					<th style = 'padding-left:5px;padding-right:5px;'>Valor</th>
					<th style = 'padding-left:5px;padding-right:5px;'>Fecha de Registro</th>
				</tr>";
			while($row = mysql_fetch_array($sql_lega)){
				$id_lega = $row['id'];
				$tabla.="
					<tr class = '$id_lega legalizaciones_subidas legalizaciones_subidas$id_lega'>
						<td>
							<img width = '25px' src = '../images/iconos/eliminar.png' onclick = 'eliminar_legalizacion_anticipo($id_lega);' class = 'botton_eliminar$id_lega opcion_eliminar_legalizacion' title = 'Eliminar Legalización'/>
						</td>
						<td>
							<img width = '25px' src = '../images/iconos/icono_editar.png' onclick = 'editar_legalizacion_anticipo($id_lega);'  class = 'botton_editar$id_lega opcion_editar_legalizacion'title = 'Editar Legalización'/>
						</td>
						<td >".$row['num_interno']."</td>
						<td style = 'text-align:left;'>".utf8_decode($row['name_item'])."</td>
						<td >".$row['pk_anticipo']."</td>						
						<td >".$row['factura']."</td>
						<td>".$row['fecha_factura']."</td>
						<td>
							<span class = 'hidde valor_factura$id_lega' >".$row['valor']."</span>
							".number_format($row['valor'])."
						</td>
						<td>".$row['fecha']."</td>
						<td class = 'hidde td_oculto_ok_editar$id_lega'>
							<img src = '../images/iconos/ok_verde.png' width = '25px' class = 'hidde guardar_edit_legalizacion$id_lega' onclick = 'guardar_editar_legalizacion($id_lega);'/>
						</td>
					</tr>
				";
			}
			echo $tabla."</table>";
		}else if($turno == 2){
			$id = $_POST['id'];
			mysql_query("start transaction");
				mysql_query("update legalizaciones_items set estado = '0' where id = '$id'");
			mysql_query("commit");
		}else if($turno == 3){
			$id = $_POST['id'];
			$factura = $_POST['factura'];
			$fecha = $_POST['fecha'];
			$valor = $_POST['valor'];
			mysql_query("start transaction");
				mysql_query("update legalizaciones_items set factura = '$factura', valor = '$valor', fecha_factura = '$fecha' where id = '$id'");
			mysql_query("commit");
		}
	}else{
		Echo "No se han enviado datos al servidor !";
	}
?>