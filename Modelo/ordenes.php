<?php
	class ordenes{
		public $ppto;
		public $ot;
		public $proveedor;
		public $vinicial;
		public $vfinal;
		public $fentrega;
		public $fradicacion;
		public $nota;
		public $fpago;
		public $cancelacion;
		
		
		//Items
		public $item;
		public $q;
		public $d;
		public $valor;
		public $iva;
		
		
		public function get_ppto(){
			return $this->ppto;
		}
		public function set_ppto($x){
			$this->ppto = $x;
		}
		
		public function get_ot(){
			return $this->ot;
		}
		public function set_ot($x){
			$this->ot = $x;
		}
		
		public function get_proveedor(){
			return $this->proveedor;
		}
		public function set_proveedor($x){
			$this->proveedor = $x;
		}
		
		public function get_vinicial(){
			return $this->vinicial;
		}
		public function set_vinicial($x){
			$this->vinicial = $x;
		}
		
		public function get_vfinal(){
			return $this->vfinal;
		}
		public function set_vfinal($x){
			$this->vfinal = $x;
		}
		
		public function get_fentrega(){
			return $this->fentrega;
		}
		public function set_fentrega($x){
			$this->fentrega = $x;
		}
		
		public function get_fradicacion(){
			return $this->fradicacion;
		}
		public function set_fradicacion($x){
			$this->fradicacion = $x;
		}
		
		public function get_nota(){
			return $this->nota;
		}
		public function set_nota($x){
			$this->nota = $x;
		}
		
		public function get_fpago(){
			return $this->fpago;
		}
		public function set_fpago($x){
			$this->fpago = $x;
		}
		
		public function get_cancelacion(){
			return $this->cancelacion;
		}
		public function set_cancelacion($x){
			$this->cancelacion = $x;
		}
		
		public function get_item(){
			return $this->item;
		}
		public function set_item($x){
			$this->item = $x;
		}
		
		public function get_q(){
			return $this->q;
		}
		public function set_q($x){
			$this->q = $x;
		}
		
		public function get_d(){
			return $this->d;
		}
		public function set_d($x){
			$this->d = $x;
		}
		
		public function get_valor(){
			return $this->valor;
		}
		public function set_valor($x){
			$this->valor = $x;
		}
		
		public function get_iva(){
			return $this->iva;
		}
		public function set_iva($x){
			$this->iva = $x;
		} 
		
		public function insert_ordenes($num,$year,$fecha,$usu){
			$insert = mysql_query("insert into orproduccion(usu_orden,fecha_orden,ppto,numero,year,proveedor,vigencia_inicial,vigencia_final,fecha_entrega,fecha_radicacion_orden,descripcion_nota,fpago) 
			values('".$usu."','".$fecha."','".$this->get_ppto()."','".$num."','".$year."','".$this->get_proveedor()."','".$this->get_vinicial()."','".$this->get_vfinal()."','".$this->get_fentrega()."','".$this->get_fradicacion().
			"','".$this->get_nota()."','".$this->get_fpago()."')");			
		}
		
		
		public function update_info_orden_proveedor($fecha,$usuario,$t,$d,$f,$fv,$val,$ival,$noo,$fecha,$usu){
			mysql_query("update orproduccion set tipo_doc_pro = '$t', num_doc_prov = '$d', fecha_doc_pro = '$f',
			fechav_doc_pro = '$fv', valor_doc_pro = '$val', iva_doc_pro = '$ival', fecha_facpro = '$fecha', usu_facpro = '$usuario' where codigo_interno_op = '$noo'");			
		}
		public function consultar_ultima_orden(){
			$sql = mysql_query("select max(codigo_interno_op) as id from orproduccion");
			$noorden = 0;
			while($row = mysql_fetch_array($sql)){
				$noorden = $row['id'];
			}
			return $noorden;
		}

		public function evaluar_estado_ocs_ppto($oc){

		}

		public function guardar_pago_factura_proveedor($oc,$fecha_pago,$val_pagado,$fecha,$usuario){
			mysql_query("update orproduccion set fecha_pago_factura = '$fecha_pago', valor_pagado = '$val_pagado', f_registro_pago_fact = '$fecha', usuario_pago_fact = '$usuario'
				where codigo_interno_op = '$oc'");

		}
		
		public function consultar_consecutivo_orden($prov,$year){
			$x = 0;
			$sql = mysql_query("select count(proveedor) as proveedor from orproduccion where proveedor = '$prov' and year = '$year'");
			while($row = mysql_fetch_array($sql)){
				$x = $row['proveedor'];
			}
			return $x+1;
		}


		public function buscar_num_oc_pago_proveedor($oc){
			$sql = mysql_query("select num_doc_prov,codigo_interno_op from orproduccion where codigo_interno_op = '$oc'");
			while($row = mysql_fetch_assoc($sql)){
				echo $row['num_doc_prov'];
			}
		}

		public function sql_orden_busqueda($noorden){
			$sql = mysql_query("SELECT DISTINCT emp.nombre_legal_empresa as nombre_empresa,presup.codigo_presup as codigo_ppto_agencia, presup.numero_presupuesto as codigo_ppto_cliente,
				clie.nombre_legal_clientes, presup.ot, presup.referencia, prove.nombre_legal_proveedor as nombre_proveedor, prove.nit_proveedor, prove.direccion_proveedor,prove.telefono_proveedor, ordenc.fecha_radicacion_orden,
				ordenc.codigo_interno_op, ordenc.tipo_doc_pro

				from empresa emp, cabpresup presup, clientes clie, orproduccion ordenc, itempresup item,proveedores prove

				where ordenc.ppto = presup.codigo_presup and presup.empresa_nit_empresa = emp.cod_interno_empresa and presup.pk_clientes_nit_cliente = clie.codigo_interno_cliente
				and item.proveedor = prove.codigo_interno_proveedor and ordenc.codigo_interno_op = $noorden and item.pk_orden = $noorden");
			return $sql;
		}

		public function estructura_orden_recepcion_facturas($sql,$noorden){
			$guardar_recharzar = "";
			if(mysql_num_rows($sql) == 0){
				echo "ORDEN NO ENCONTRADA ".mysql_num_rows($sql);
			}else{
				$est = "<table width = '100%' style = 'padding-left:10%;padding-right:10%;' class = 'tabla_nuevos_datos2'>";
				while($row = mysql_fetch_array($sql)){
					if($row['tipo_doc_pro'] != 0){
						$guardar_recharzar .="<span class = 'botton_verde' onclick = 'rechazar_fac_prove(".$noorden.")'>RECHAZAR FACTURA</span>";
					}else{
						$guardar_recharzar .="<span class = 'botton_verde' onclick = 'abrir_fac_prove(".$_POST['noorden'].")'>REGISTRAR FACTURA</span>";
					}
					$est.="
					<tr>
						<td width = '49%'>
							<p>Empresa:</p>
							<input type = 'text' readonly value = '".$row['nombre_empresa']."' />
						</td>
						<td class = 'separator' width = '2%'></td>
						<td width = '49%'>
							<p>Cliente:</p>
							<input type = 'text' readonly value = '".$row['nombre_legal_clientes']."' />
						</td>
					</tr>
					<tr>
						<td>
							<p>OT:</p>
							<input type = 'text' readonly value = '".$row['ot']."' />
						</td>
						<td class = 'separator' width = '2%'></td>
						<td>
							<p>Número Ppto Agencia:</p>
							<input type = 'text' readonly value = '".$row['codigo_ppto_agencia']."' />
						</td>
						
					</tr>
					<tr>
						<td>
							<p>Número de Ppto Cliente:</p>
							<input type = 'text' readonly value = '".$row['codigo_ppto_cliente']."' />
						</td>
						<td class = 'separator' width = '2%'></td>
						<td>
							<p>OT:</p>
							<input type = 'text' readonly value = '".$row['referencia']."' />
						</td>
					</tr>
					<tr>
						<td>
							<p>Fecha para Radicar:</p>
							<input type = 'text' readonly value = '".$row['fecha_radicacion_orden']."' />
						</td>
						<td class = 'separator' width = '2%'></td>
						<td>
							<p>Número de Ppto Cliente:</p>
							<input type = 'text' readonly value = '".$row['codigo_ppto_cliente']."' />
						</td>
					</tr>
					<tr>
						<td>
							<p>Número de Orden de Compra:</p>
							<input type = 'text' readonly value = '".$row['codigo_interno_op']."' />
						</td>
						<td class = 'separator' width = '2%'></td>
						<td>
							<p>Nombre Proveedor:</p>
							<input type = 'text' readonly value = '".$row['nombre_proveedor']."' />
						</td>
					</tr>
					<tr>
						<td>
							<p>Nit Proveedor:</p>
							<input type = 'text' readonly value = '".$row['nit_proveedor']."' />
						</td>
						<td class = 'separator' width = '2%'></td>
						<td>
							<p>Teléfono Proveedor:</p>
							<input type = 'text' readonly value = '".$row['telefono_proveedor']."' />
						</td>
					</tr>
					";
				}

				$sql_items = mysql_query("SELECT item.q, item.dias as d, item.descripcion as descx, item.iva_item as iva, item.val_item as valor

					from orproduccion ordenc, itempresup item 

					where ordenc.codigo_interno_op =  item.pk_orden and ordenc.codigo_interno_op = '$noorden'");
				$est .="<tr>
							<td colspan = '3'>
								
									<table width = '100%' class = 'tablas_muestra_datos_tablas_produccion'>
										<thead>
											<tr></tr>
											<tr>
												<th >Descripción</th>
												<th >Dias</th>
												<th >Cantidad</th>
												<th >Valor Unidad</th>
												<th >Costo Total</th>
												<th >Iva Costo</th>
												<th >Total</th>
											</tr>
										</thead>
										<tbody>";
				$subtotal = 0;
				$iva_subtotal = 0;
				while($rowx = mysql_fetch_array($sql_items)){
					$costo = ( floatval($rowx['d']) *floatval($rowx['q'])*floatval($rowx['valor']));
					$costo_iva = (( floatval($rowx['d']) *floatval($rowx['q'])*floatval($rowx['valor']))*floatval($rowx['iva']))/100;
					$total = $costo + $costo_iva;

					$subtotal += $costo;
					$iva_subtotal += $costo_iva;
					$est .="
						<tr>
							<td >".$rowx['descx']."</td>
							<td  align = 'center'>".$rowx['d']."</td>
							<td  align = 'center'>".$rowx['q']."</td>
							<td >$ ".number_format($rowx['valor'])."</td>
							<td >".number_format($costo)."</td>
							<td >".number_format($costo_iva)."</td>
							<td >".number_format($total)."</td>
						</tr>";
				}
				$est .="</tbody></table></td>
						<tr>
							<td >
								<p>SubTotal:</p>
								<input type = 'text' readonly value = '$ ".number_format($subtotal)."'/>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td >
								<p>Iva:</p>
								<input type = 'text' readonly value = '$ ".number_format($iva_subtotal)."'/>
							</td>
						</tr>
						<tr>
							<td >
								<p>TOTAL:</p>
								<input type = 'text' readonly value = '$ ".number_format($subtotal + $iva_subtotal)."'/>
							</td>
							<td class = 'separator' width = '2%'></td>
						</tr>
						<tr>
							<td colspan = '3' align = 'center'>
								</br>
								".$guardar_recharzar."
								</br>
							</td>
						</tr>
						</table>";
				echo $est;
			}
			

		}

		public function consultar_valores_item($id,$noorden){
			$sql = mysql_query("SELECT dias,q,descripcion,val_item,iva_item,por_prov
				from itempresup where id = '$id'");
			while($row = mysql_fetch_array($sql)){
				$this->insert_detalle_orden($noorden,$id,$row['q'],$row['dias'],$row['descripcion'],$row['val_item'],$row['iva_item'],$row['por_prov']);
				mysql_query("update itempresup set editable = '1', pk_orden = '$noorden' where id = '$id'");
			}
		}
		
		public function insert_detalle_orden($noorden,$id,$q,$d,$desc,$val,$iva,$vol){
			mysql_query("insert into detalle_orden(item,noorden,descx,d,q,valor,iva,vol) values ('".$id."','".$noorden."','".$desc."','".$d."','".$q."','".$val."','".$iva."','".$vol."')");
			echo mysql_error();
		}
		
	}
?>