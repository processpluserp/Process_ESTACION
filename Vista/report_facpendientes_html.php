<?php
	include("../Controller/Conexion.php");
	include("vectores_th_report.php");
	
	$estructura_tabla = "
	<table  class = 'tabla_reporte_estados_pptos tabla_reportes'>
		<tr>
			<th align = 'left' style = 'padding-right:5px;'>
				<a href = ''>
					<img src = '../images/produccion/iconos-82.png' width = '45px' />
				</a>
			</th>
			<th align = 'left'>
				<img src = '../images/produccion/iconos-81.png' width = '45px' />
			</th>
		</tr>
	</table>
	<div style='background-color:#E5E5E5; border-radius: 15px; width: 1750px;'>
	<table width = '100%' class = 'tabla_reporte_estados_pptos tabla_reportes4 tabla_reportes'>";
	$estructura_tabla .= "<thead>";
	//$estructura_tabla .= "<tr></tr>";
	$estructura_tabla .= "<tr>";
	for($i = 0; $i < count($facturas_pendientes_por_llegar); $i++){
		if ($i<1) {
			$estructura_tabla.="<th style='background-color:#DAEFB0; color: rgb(83, 86, 78); border-color: #FFFFFF; height: 35px;' class = 'th_report' nowrap>".$facturas_pendientes_por_llegar[$i]."</th>";		
		}else
			$estructura_tabla.="<th style='background-color:#F7EFB0; color: rgb(83, 86, 78); border-color: #FFFFFF; height: 35px;' class = 'th_report' nowrap>".$facturas_pendientes_por_llegar[$i]."</th>";
		
		//$estructura_tabla.="<th style='background-color:#DAEFB0; color: rgb(83, 86, 78); border: hidden; border-color: #daefb0; height: 35px;' class = 'th_report' nowrap>".$facturas_pendientes_por_llegar[$i]."</th>";
	}
	$estructura_tabla .= "</tr>
						</thead>
						<tbody>";
	
	
	if(!empty($_POST["user"]) && !empty($_POST["emp"]) && !empty($_POST["director"]) && !empty($_POST["ejecutivo"]) && !empty($_POST["turno"])){
		$empresa = $_POST['emp'];
		$director = $_POST['director'];
		$ejecutivo = $_POST['ejecutivo'];
		
		$cliente = $_POST['cliente'];
		$presupuesto = $_POST['ppto'];
		$sql_cliente = "";
		$sql_ppto = "";
		if($cliente != 0){
			$sql_cliente = " and ot.producto_clientes_pk_clientes_nit_procliente = '$cliente'";
		}
		if($presupuesto != 0){
			$sql_ppto = " and p.codigo_presup = '$presupuesto'";
		}
		
		$sql_nivel_cliente = mysql_query("select c.nombre_comercial_cliente, c.codigo_interno_cliente,ot.codigo_ot, ot.referencia as ref_ot,
		CAST(ot.fecha_registro as DATE) as FECHA_OT,CAST(ot.fecha_registro as TIME) as HORA_OT,pr.nombre_producto,
		p.codigo_presup,p.numero_presupuesto,p.referencia,p.vigencia_final,p.estado_presup, pr.id_procliente, pp.codigo_interno_proveedor,pp.nombre_comercial_proveedor,
		op.codigo_interno_op,op.fecha_radicacion_orden
		from cabot ot, clientes c, producto_clientes pr,cabpresup p,proveedores pp,orproduccion op
		where ot.pk_nit_empresa_ot = '$empresa' and ot.director = '$director' and ot.ejecutivo = '$ejecutivo' 
		and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente and ot.producto_clientes_codigo_PRC = pr.id_procliente and ot.codigo_ot = p.ot 
		 and p.codigo_presup = op.ppto and op.proveedor = pp.codigo_interno_proveedor $sql_cliente $sql_ppto
		order BY c.nombre_comercial_cliente,pr.nombre_producto,ot.codigo_ot,op.codigo_interno_op");
		
		$estructura_tabla.="<tr></tr>";
		
		
		$array_cliente = array();
		$arra_temp = array();
		$i = 0;
		while($row = mysql_fetch_array($sql_nivel_cliente)){
			$cliente = $row['nombre_comercial_cliente'];
			$oc = $row['codigo_interno_op'];
			
			$text = "";
			
			if((date("Y-m-d")) > ($row['vigencia_final']) && $row['estado_presup'] == 3){
				$text = "PTE POR FACTURAR";
			}else if($row['estado_presup'] == 1){
				$text = "< 20%";
			}else if($row['estado_presup'] == 2){
				$text = "APROBADO POR SISTEMA";
			}else if($row['estado_presup'] == 3){
				$text = "APROBADO SIN EJECUTAR";
			}else if($row['estado_presup'] == 5){
				$text = "FACTURADO SIN PAGAR";
			}else if($row['estado_presup'] == 6){
				$text = "PAGADO";
			}else if($row['estado_presup'] == 7){
				$text = "CERRADO";
			}
			
			$val_inicial = 0;
			$iva = 0;
			$vol = 0;
			
			$sql_valor_oc = mysql_query("select dias,q,iva_item,val_item,por_prov
			from itempresup where pk_orden = '$oc'");
			while($ro = mysql_fetch_array($sql_valor_oc)){
				$val_inicial += $ro['dias']*$ro['q']*$ro['val_item'];
				$temp = $ro['dias']*$ro['q']*$ro['val_item'];
				$iva += $temp * ($ro['iva_item']/100);
				$vol += $temp * ($ro['por_prov']/100);
			}
			$total = $val_inicial+$iva-$vol;
			
			$array_cliente[$i][0] = $row['nombre_comercial_cliente'];
			$array_cliente[$i][1] = $row['nombre_producto'];
			$array_cliente[$i][2] = $row['codigo_ot'];
			$array_cliente[$i][3] = $row['ref_ot'];
			$array_cliente[$i][4] = $row['FECHA_OT'];
			$array_cliente[$i][5] = $row['HORA_OT'];
			$array_cliente[$i][6] = $row['codigo_presup'];
			$array_cliente[$i][7] = $row['numero_presupuesto'];
			$array_cliente[$i][8] = $row['referencia'];
			$array_cliente[$i][9] = $text;
			$array_cliente[$i][10] = $row['codigo_interno_cliente'];
			$array_cliente[$i][11] = $row['id_procliente'];
			$array_cliente[$i][12] = $row['codigo_interno_proveedor'];
			$array_cliente[$i][13] = $row['nombre_comercial_proveedor'];
			$array_cliente[$i][14] = $row['codigo_interno_op']; //ITEM
			$array_cliente[$i][15] = $row['fecha_radicacion_orden'];
			//$array_cliente[$i][16] = $row['q'];
			//$array_cliente[$i][17] = number_format($row['val_item']);
			$array_cliente[$i][18] = number_format($val_inicial);
			$array_cliente[$i][19] = number_format($iva);
			$array_cliente[$i][20] = number_format($vol);
			$array_cliente[$i][21] = number_format($total);
			$i++;
			
			
			
		}
		
		$array_f_clientes = array();
		for($x = 0; $x < count($array_cliente);$x++){
			$array_f_clientes[] = ($array_cliente[$x][10]);
		}
		$array_f_clientesx = array_unique($array_f_clientes);
		
		$llaves_clientes = array_keys($array_f_clientesx);
		
		for($n = 0; $n < count($array_f_clientesx); $n++){
			for($c = 0; $c < count($array_cliente); $c++){
				if( $array_f_clientesx[$llaves_clientes[$n]] == $array_cliente[$c][10]){
					//$estructura_tabla.="<tr><td><br></br></td></tr>";
					$cliente = "";
					$producto = "";
					$ot = "";
					$ref_ot = "";
					$fecha_ot = "";
					$hora_ot = "";
					
					$proveedor ="";
					
					$presupuesto = "";
					$presupuesto_cliente = "";
					$referencia_ppto = "";
					$estado_ppto = "";
					if(count($array_f_clientesx) == 1 && $c == 0){
						$cliente =$array_cliente[$c][0];
						$producto =  $array_cliente[$c][1];
						$proveedor = $array_cliente[$c][13];
						$ot = $array_cliente[$c][2];
						$ref_ot = $array_cliente[$c][3];
						$fecha_ot = $array_cliente[$c][4];
						$hora_ot = $array_cliente[$c][5];
						$presupuesto =  $array_cliente[$c][6];
						$presupuesto_cliente = $array_cliente[$c][7];
						$referencia_ppto = $array_cliente[$c][8];
						$estado_ppto = $array_cliente[$c][9];
						
						
					}else if($c == 0){
						//CLIENTE
						$cliente = $array_cliente[$c][10];
						if($cliente == $array_cliente[$c+1][10]){
							$cliente =$array_cliente[$c][0];
						}else{
							$cliente = $array_cliente[$c][0];
						}
						
						//PRODUCTO
						$producto = $array_cliente[$c][11];
						if($producto == $array_cliente[$c+1][11]){
							$producto =  $array_cliente[$c][1];
						}else{
							$producto = $array_cliente[$c][1];
						}
						
						//PROVEEDOR
						$proveedor = $array_cliente[$c][12];
						if($proveedor == $array_cliente[$c+1][12]){
							$proveedor =  $array_cliente[$c][13];
						}else{
							$proveedor = $array_cliente[$c][13];
						}
												
						//OT
						$ot = $array_cliente[$c][2];
						if($ot == $array_cliente[$c+1][2]){
							$ot = $array_cliente[$c][2];
							$ref_ot = $array_cliente[$c][3];
							$fecha_ot = $array_cliente[$c][4];
							$hora_ot = $array_cliente[$c][5];
						}else{
							$ot = $array_cliente[$c][2];
							$ref_ot = $array_cliente[$c][3];
							$fecha_ot = $array_cliente[$c][4];
							$hora_ot = $array_cliente[$c][5];
						}
						
						//PRESUPUESTO
						$presupuesto = $array_cliente[$c][6];
						if($presupuesto == $array_cliente[$c+1][6]){
							$presupuesto =  $array_cliente[$c][6];
							$presupuesto_cliente = $array_cliente[$c][7];
							$referencia_ppto = $array_cliente[$c][8];
							$estado_ppto = $array_cliente[$c][9];
						}else{
							$presupuesto = $array_cliente[$c][6];
							$presupuesto_cliente = $array_cliente[$c][7];
							$referencia_ppto = $array_cliente[$c][8];
							$estado_ppto = $array_cliente[$c][9];
						}
						
					}else{
						
						//CLIENTE
						$cliente = $array_cliente[$c-1][10];
						if($cliente == $array_cliente[$c][10]){
							$cliente = "";
						}else{
							$cliente = $array_cliente[$c][0];
						}
						
						//PRODUCTO
						$producto = $array_cliente[$c-1][11];
						if($producto == $array_cliente[$c][11]){
							$producto = "";
						}else{
							$producto = $array_cliente[$c][1];
						}
						
						//proveedor
						$proveedor = $array_cliente[$c-1][12];
						if($proveedor == $array_cliente[$c][12]){
							$proveedor = "";
						}else{
							$proveedor = $array_cliente[$c][13];
						}
						
						//PRESUPUESTO
						$presupuesto = $array_cliente[$c-1][6];
						if($presupuesto == $array_cliente[$c][6]){
							$presupuesto = "";
						}else{
							$presupuesto = $array_cliente[$c][6];
							$presupuesto_cliente = $array_cliente[$c][7];
							$referencia_ppto = $array_cliente[$c][8];
							$estado_ppto = $array_cliente[$c][9];
						}
						
						//OT
						$ot = $array_cliente[$c-1][2];
						if($ot == $array_cliente[$c][2]){
							$ot = "";
						}else{
							$ot = $array_cliente[$c][2];
							$ref_ot = $array_cliente[$c][3];
							$fecha_ot = $array_cliente[$c][4];
							$hora_ot = $array_cliente[$c][5];
						}
					}
					
					$rowspan=count($array_cliente);
					$estructura_tabla .= "<tr>";

					if ($cliente != "") {
						$estructura_tabla .= "<td ROWSPAN=".$rowspan." style = 'vertical-align:top;' nowrap><strong>".$cliente."</strong></td>";
					}
						
					if ($producto!="") {
						$estructura_tabla .= "<td ROWSPAN=".$rowspan." style = 'vertical-align:top;'>".$producto."</td>";
					}
					if ($ot!="") {
						$estructura_tabla .= "<td ROWSPAN=".$rowspan." style = 'vertical-align:top;' nowrap>".$ot."</td>";
					}
					if ($ref_ot!="") {
						$estructura_tabla .= "<td ROWSPAN=".$rowspan." style = 'vertical-align:top;' nowrap>".$ref_ot."</td>";
					}
					if ($fecha_ot!="") {
						$estructura_tabla .= "<td ROWSPAN=".$rowspan." nowrap style = 'padding-left:5px;vertical-align:top;text-align:center;'>".$fecha_ot."</td>";
					}
					if ($hora_ot!="") {
						$estructura_tabla .= "<td ROWSPAN=".$rowspan." nowrap style = 'padding-left:5px;vertical-align:top;text-align:center;'>".$hora_ot."</td>";
					}	

					if ($presupuesto!="") {
						$estructura_tabla .= "<td ROWSPAN=".$rowspan." style = 'vertical-align:top;text-align:center;' nowrap>".$presupuesto."</td>";
					}
					if ($presupuesto_cliente!="") {
						$estructura_tabla .= "<td ROWSPAN=".$rowspan." style = 'vertical-align:top;text-align:center;' nowrap>".$presupuesto_cliente."</td>";
					}
					if ($referencia_ppto!="") {
						
						$estructura_tabla .= "<td ROWSPAN=".$rowspan." style = 'vertical-align:top;' nowrap>".$referencia_ppto."</td>";
					}
					if ($estado_ppto!="") {
						$estructura_tabla .= "<td ROWSPAN=".$rowspan." style = 'vertical-align:top;' nowrap>".$estado_ppto."</td>";
					}						
						

					/*
						$estructura_tabla .= "<td style = 'vertical-align:top;' nowrap><strong>".$cliente."</strong></td>";
						$estructura_tabla .= "<td style = 'vertical-align:top;'>".$producto."</td>";
						$estructura_tabla .= "<td style = 'vertical-align:top;' nowrap>".$ot."</td>";
						$estructura_tabla .= "<td style = 'vertical-align:top;' nowrap>".$ref_ot."</td>";
						$estructura_tabla .= "<td nowrap style = 'padding-left:5px;vertical-align:top;text-align:center;'>".$fecha_ot."</td>";
						$estructura_tabla .= "<td nowrap style = 'padding-left:5px;vertical-align:top;text-align:center;'>".$hora_ot."</td>";
						$estructura_tabla .= "<td style = 'vertical-align:top;text-align:center;' nowrap>".$presupuesto."</td>";
						$estructura_tabla .= "<td style = 'vertical-align:top;text-align:center;' nowrap>".$presupuesto_cliente."</td>";
						$estructura_tabla .= "<td style = 'vertical-align:top;' nowrap>".$referencia_ppto."</td>";
						$estructura_tabla .= "<td style = 'vertical-align:top;' nowrap>".$estado_ppto."</td>";
					*/
						$estructura_tabla .= "<td style = 'vertical-align:top;' nowrap>".$proveedor."</td>";
						
						$estructura_tabla .= "<td style = 'vertical-align:top;' nowrap>".$array_cliente[$c][14]."</td>";
						$estructura_tabla .= "<td style = 'vertical-align:top;text-align:center;' nowrap>".$array_cliente[$c][15]."</td>";
						$estructura_tabla .= "<td style = 'vertical-align:top;text-align:center;' nowrap>$ ".$array_cliente[$c][18]."</td>";
						$estructura_tabla .= "<td style = 'vertical-align:top;text-align:center;' nowrap>$ ".$array_cliente[$c][19]."</td>";
						//$estructura_tabla .= "<td style = 'vertical-align:top;text-align:center;' nowrap>$ ".$array_cliente[$c][19]."</td>";
						//$estructura_tabla .= "<td style = 'vertical-align:top;text-align:center;' nowrap>$ ".$array_cliente[$c][20]."</td>";
						$estructura_tabla .= "<td style = 'vertical-align:top;text-align:center;' nowrap>$ ".$array_cliente[$c][21]."</td>";
					$estructura_tabla .= "</tr>";
					//$estructura_tabla.="<tr><td><br></br></td></tr>";
				}else{
					
				}
				
				
			}
			/*$estructura_tabla.="<tr><td style = 'border-bottom:1px solid black;' colspan = '16'><br></br></td></tr>
			</tbody></table>
			</div>";
			*/
			$estructura_tabla.="</tbody></table>
			</div>";
		}
		
		$turno = $_POST['turno'];
		
		if($turno == 1){
			
		}
		
	}
	
	echo $estructura_tabla;
?>