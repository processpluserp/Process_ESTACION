<?php
	include("../Controller/Conexion.php");
	include("vectores_th_report.php");
	
	$estructura_tabla = "
	<table class = 'tabla_reporte_estados_pptos tabla_reportes'>
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
	<table id='tabla_estado_ppto' width = '100%' class = 'tabla_reporte_estados_pptos tabla_reportes tabla_reportes4 display nowrap'>";
	$estructura_tabla .= "<thead>";
	$estructura_tabla .= "<tr>";
	for($i = 0; $i < count($estados_pptos); $i++){
		if ($i<1) {
			$estructura_tabla.="<th style='background-color:#DAEFB0; color: rgb(83, 86, 78);  border-color: #FFFFFF; height: 35px;' class = 'th_report' nowrap>".$estados_pptos[$i]."</th>";
		}else
			$estructura_tabla.="<th style='background-color:#F7EFB0; color: rgb(83, 86, 78);  border-color: #FFFFFF; height: 35px;' class = 'th_report' nowrap>".$estados_pptos[$i]."</th>";
	}
	$estructura_tabla .= "</tr>
						</thead>
						<tbody >";
	
	
	if(!empty($_POST["user"]) && !empty($_POST["emp"]) && !empty($_POST["director"]) && !empty($_POST["ejecutivo"]) && !empty($_POST["turno"])){
		$empresa = $_POST['emp'];
		$director = $_POST['director'];
		$ejecutivo = $_POST['ejecutivo'];
		
		$cliente = $_POST['cliente'];
		$producto = $_POST['producto'];
		$sql_cliente = "";
		$sql_producto = "";
		if($cliente != 0){
			$sql_cliente = " and ot.producto_clientes_pk_clientes_nit_procliente = '$cliente' ";
		}
		if($producto != 0){
			$sql_producto = " and ot.producto_clientes_codigo_PRC = '$producto' ";
		}

		$sql_consulta="select c.nombre_comercial_cliente, c.codigo_interno_cliente,ot.codigo_ot, ot.referencia as ref_ot,
		CAST(ot.fecha_registro as DATE) as FECHA_OT,CAST(ot.fecha_registro as TIME) as HORA_OT,pr.nombre_producto,
		p.codigo_presup,p.numero_presupuesto,p.referencia,p.vigencia_final,p.estado_presup, pr.id_procliente
		from cabot ot, clientes c, producto_clientes pr,cabpresup p
		where ot.pk_nit_empresa_ot = '$empresa' and ot.director = '$director' and ot.ejecutivo = '$ejecutivo' 
		and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente and ot.producto_clientes_codigo_PRC = pr.id_procliente and ot.codigo_ot = p.ot $sql_cliente $sql_producto
		order BY c.nombre_comercial_cliente,pr.nombre_producto,ot.codigo_ot";

		//echo $sql_consulta;
		$sql_nivel_cliente = mysql_query($sql_consulta);
		
		$estructura_tabla.="<tr></tr>";
		
		
		$array_cliente = array();
		$arra_temp = array();
		$i = 0;
		while($row = mysql_fetch_array($sql_nivel_cliente)){
			$cliente = $row['nombre_comercial_cliente'];
			
			
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
					/*$estructura_tabla.="<tr>";
					for ($k=11; $k > 1; $k--) { 
						$estructura_tabla.="<td><br></br></td>";
					}
					$estructura_tabla.="</tr>";
					*/
					/*$estructura_tabla.="<tr><td><br></br></td>
											<td><br></br></td>
											<td><br></br></td>
											<td><br></br></td>
											<td><br></br></td>
											<td><br></br></td>
											<td><br></br></td>
											<td><br></br></td>
											<td><br></br></td>
											<td><br></br></td>
										</tr>";
					*/
					$cliente = "";
					$producto = "";
					$ot = "";
					$ref_ot = "";
					$fecha_ot = "";
					$hora_ot = "";
					if(count($array_f_clientesx) == 1 && $c == 0){
						$cliente =$array_cliente[$c][0];
						$producto = $array_cliente[$c][1];
						$ot = $array_cliente[$c][2];
						$ref_ot = $array_cliente[$c][3];
						$fecha_ot = $array_cliente[$c][4];
						$hora_ot = $array_cliente[$c][5];
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
					$rowspan=count($array_cliente)*3;
					$estructura_tabla .= "<tr>";
					if ($cliente != "") {
						$estructura_tabla .= "<td ROWSPAN=".$rowspan." style = 'vertical-align:top; border-color: #FFFFFF;' nowrap><strong>".$cliente."</strong></td>";
					}
						
					if ($producto!="") {
						$estructura_tabla .= "<td ROWSPAN=".$rowspan." style = 'vertical-align:top; border-color: #FFFFFF;'>".$producto."</td>";
					}
					if ($ot!="") {
						$estructura_tabla .= "<td ROWSPAN=".$rowspan." style = 'vertical-align:top; border-color: #FFFFFF;' nowrap>".$ot."</td>";
					}
					if ($ref_ot!="") {
						$estructura_tabla .= "<td ROWSPAN=".$rowspan." style = 'vertical-align:top; border-color: #FFFFFF;' nowrap>".$ref_ot."</td>";
					}
					if ($fecha_ot!="") {
						$estructura_tabla .= "<td ROWSPAN=".$rowspan." nowrap style = 'padding-left:5px;vertical-align:top;text-align:center; border-color: #FFFFFF;'>".$fecha_ot."</td>";
					}
					if ($hora_ot!="") {
						$estructura_tabla .= "<td ROWSPAN=".$rowspan." nowrap style = 'padding-left:5px;vertical-align:top;text-align:center; border-color: #FFFFFF;'>".$hora_ot."</td>";
					}	
						
						
						
					$estructura_tabla .= "<td style = 'vertical-align:top;text-align:center; border-color: #FFFFFF;' nowrap>".$array_cliente[$c][6]."</td>";
					$estructura_tabla .= "<td style = 'vertical-align:top;text-align:center; border-color: #FFFFFF;' nowrap>".$array_cliente[$c][7]."</td>";
					$estructura_tabla .= "<td style = 'vertical-align:top; border-color: #FFFFFF;' nowrap>".$array_cliente[$c][8]."</td>";
					$estructura_tabla .= "<td style = 'vertical-align:top; border-color: #FFFFFF;' nowrap>".$array_cliente[$c][9]."</td>";
					$estructura_tabla .= "</tr>";
					/*$estructura_tabla.="<tr><td><br></br></td>
											<td><br></br></td>
											<td><br></br></td>
											<td><br></br></td>
											<td><br></br></td>
											<td><br></br></td>
											<td><br></br></td>
											<td><br></br></td>
											<td><br></br></td>
											<td><br></br></td>
										</tr>";
					*/
				}else{
					
				}
				
				
			}
/*			$estructura_tabla.="<tr><td  colspan = '10'><br></br></td></tr></tbody></table>
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
	
	/*$cliente = $row['codigo_interno_cliente'];
			$estructura_tabla.="<tr><td>".$row['nombre_comercial_cliente']."</td>";
			
			//AVERIGUO LOS PRODUCTOS DE ESE CLIENTE
			$estructura_tabla.="<td>
				<table width = '100%'>";
			$sql_productos_clientes_ot = mysql_query("select distinct pr.nombre_producto,pr.id_procliente
			from cabot ot, producto_clientes pr
			where ot.pk_nit_empresa_ot = '$empresa' and ot.director = '$director' and ot.ejecutivo = '$ejecutivo' 
			and ot.producto_clientes_pk_clientes_nit_procliente = '$cliente' and ot.producto_clientes_codigo_PRC = pr.id_procliente");
			while($rowp = mysql_fetch_array($sql_productos_clientes_ot)){
				$producto = $rowp['id_procliente'];
				$estructura_tabla.="<tr><td>".$rowp['nombre_producto']."</td>";
				
				//OTS RELACIONADAS CON CADA PRODUCTOS
				$estructura_tabla.="<td>
				<table width = '100%' >";
					$sql_productos_clientes_ot_ot = mysql_query("select distinct ot.codigo_ot, CAST(ot.fecha_registro as DATE) as FECHA_OT,CAST(ot.fecha_registro as TIME) as HORA_OT
					from cabot ot, producto_clientes pr
					where ot.pk_nit_empresa_ot = '$empresa' and ot.director = '$director' and ot.ejecutivo = '$ejecutivo' 
					and ot.producto_clientes_pk_clientes_nit_procliente = '$cliente' and ot.producto_clientes_codigo_PRC = '$producto'");
					while($rowot = mysql_fetch_array($sql_productos_clientes_ot_ot)){
						$ot_ot = $rowot['codigo_ot'];
						$estructura_tabla.="<tr>
							<td>".$rowot['codigo_ot']."</td>
							<td>".$rowot['FECHA_OT']."</td>
							<td>".$rowot['HORA_OT']."</td>";
						
						//SQL PRESUPUESTOS
						$sql_pptos = mysql_query("select p.codigo_presup,p.numero_presupuesto,p.referencia
						from cabpresup p
						where p.ot = '$ot_ot'");
						
						$estructura_tabla.="<td>
							<table width = '100%'>";
						while($rp = mysql_fetch_array($sql_pptos)){
							$estructura_tabla.="<tr>
							<td>".$rp['codigo_presup']."</td>
							<td>".$rp['numero_presupuesto']."</td>
							<td>".$rp['referencia']."</td>";
							$estructura_tabla.="</tr>";
						}
						$estructura_tabla.="</table></td>";
					}
					
				$estructura_tabla.="</table></td>";
				
			}
			$estructura_tabla.="</table></td>";
			
			
			$estructura_tabla.="</tr>";*/
?>