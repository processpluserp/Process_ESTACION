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
	<div style='background-color:#E5E5E5; border-radius: 15px;'> 
	<table width = '100%' class = 'tabla_reporte_estados_pptos tabla_reportes4 tabla_reportes'>";
	$estructura_tabla .= "<thead>";
	$estructura_tabla .= "<tr>";
	for($i = 0; $i < count($facturacion_proveedor); $i++){
		if ($i<1) {
			$estructura_tabla.="<th style='background-color:#DAEFB0; color: rgb(83, 86, 78); border-color: #FFFFFF; height: 35px;' class = 'th_report' nowrap>".$facturacion_proveedor[$i]."</th>";
		}else
			$estructura_tabla.="<th style='background-color:#F7EFB0; color: rgb(83, 86, 78); border-color: #FFFFFF; height: 35px;' class = 'th_report' nowrap>".$facturacion_proveedor[$i]."</th>";
	}
	$estructura_tabla .= "</tr>
						</thead>
						<tbody>";
	
	
	if(!empty($_POST["user"]) && !empty($_POST["proveedor"])){
		$empresa = $_POST['emp'];
		$proveedor = $_POST['proveedor'];
		
		
		
		$sql_nivel_cliente = mysql_query("select distinct p.nombre_comercial_proveedor,p.codigo_interno_proveedor,oc.num_doc_prov,oc.fecha_doc_pro,oc.codigo_interno_op,
		oc.valor_doc_pro, oc.iva_doc_pro,oc.fecha_facpro,oc.valor_pagado,oc.fecha_radicacion_orden
		from cabpresup pp, itempresup ip, orproduccion oc, proveedores p
		where pp.empresa_nit_empresa = '$empresa' and pp.codigo_presup = ip.ppto 
		and ip.pk_orden = oc.codigo_interno_op and oc.proveedor = '$proveedor' and oc.proveedor = p.codigo_interno_proveedor and oc.tipo_doc_pro != '0' order by oc.codigo_interno_op asc");
		
		$estructura_tabla.="<tr></tr>";
		
		
		$array_cliente = array();
		$arra_temp = array();
		$i = 0;
		while($row = mysql_fetch_array($sql_nivel_cliente)){			
			$text = "";
			
			if( $row['valor_pagado'] == 0){
				$text = "NO PAGADO";
			}else {
				$text = "PAGADO";
			}
			
			$valor = $row['valor_doc_pro'];
			$ival = $row['iva_doc_pro'];
			
			$total = $valor+$ival;
			
			$array_cliente[$i][0] = $row['codigo_interno_proveedor'];
			$array_cliente[$i][1] = $row['nombre_comercial_proveedor'];
			$array_cliente[$i][2] = $row['codigo_interno_op'];
			$array_cliente[$i][3] = $row['fecha_radicacion_orden'];
			$array_cliente[$i][4] = $row['num_doc_prov'];
			$array_cliente[$i][5] = $row['fecha_facpro'];
			$array_cliente[$i][6] = number_format($valor);
			$array_cliente[$i][7] = number_format($ival);
			$array_cliente[$i][8] = number_format($total);
			$array_cliente[$i][9] = $text;
			$i++;
			
			
			
		}
		
		$array_f_clientes = array();
		for($x = 0; $x < count($array_cliente);$x++){
			$array_f_clientes[] = ($array_cliente[$x][0]);
		}
		$array_f_clientesx = array_unique($array_f_clientes);
		
		$llaves_clientes = array_keys($array_f_clientesx);
		
		for($c = 0; $c < count($array_cliente); $c++){
			//$estructura_tabla.="<tr><td><br></br></td></tr>";
			$proveedor = "";
			if(count($array_cliente) == 1 && $c == 0){
				$proveedor = $array_cliente[$c][1];
			}else if($c == 0){						
				//PROVEEDOR
				$proveedor = $array_cliente[$c][0];
				if($proveedor == $array_cliente[$c+1][0]){
					$proveedor =  $array_cliente[$c][1];
				}else{
					$proveedor = $array_cliente[$c][1];
				}
			}else{
				//proveedor
				$proveedor = $array_cliente[$c-1][0];
				if($proveedor == $array_cliente[$c][0]){
					$proveedor = "";
				}else{
					$proveedor = $array_cliente[$c][1];
				}
			}
			
			$estructura_tabla .= "<tr>";
			
			if ($proveedor!="") {
				$estructura_tabla .= "<td ROWSPAN=".count($array_cliente[$c][2])." style = 'vertical-align:top;' nowrap>".$proveedor."</td>";
			}
				$estructura_tabla .= "<td style = 'vertical-align:top;' nowrap><strong>".$proveedor."</strong></td>";
				$estructura_tabla .= "<td style = 'vertical-align:top;text-align:center;'>".$array_cliente[$c][2]."</td>";
				$estructura_tabla .= "<td style = 'vertical-align:top;text-align:center;' nowrap>".$array_cliente[$c][3]."</td>";
				$estructura_tabla .= "<td style = 'vertical-align:top;text-align:center;' nowrap>".$array_cliente[$c][4]."</td>";
				$estructura_tabla .= "<td nowrap style = 'padding-left:5px;vertical-align:top;text-align:center;'>$ ".$array_cliente[$c][6]."</td>";
				$estructura_tabla .= "<td nowrap style = 'padding-left:5px;vertical-align:top;text-align:center;'>$ ".$array_cliente[$c][7]."</td>";
				$estructura_tabla .= "<td nowrap style = 'padding-left:5px;vertical-align:top;text-align:center;'>$ ".$array_cliente[$c][8]."</td>";
				$estructura_tabla .= "<td nowrap style = 'padding-left:5px;vertical-align:top;'>".$array_cliente[$c][9]."</td>";
				$estructura_tabla .= "<td style = 'vertical-align:top;text-align:center;' nowrap>".$array_cliente[$c][5]."</td>";
			$estructura_tabla .= "</tr>";
			$estructura_tabla.="<tr><td><br></br></td></tr>";
			
		}
		/*$estructura_tabla.="<tr><td style = 'border-bottom:1px solid black;' colspan = '16'><br></br></td></tr></tbody></table>
			</div>";
		*/
		$estructura_tabla.="</tbody></table>
			</div>";
		$turno = $_POST['turno'];
		
		if($turno == 1){
			
		}
		
	}
	
	echo $estructura_tabla;
?>