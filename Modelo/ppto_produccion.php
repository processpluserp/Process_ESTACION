<?php
	class ppto_produccion{
		
		public $pk_item;
		public $dias;
		public $q;
		public $val_item;
		public $descripcion;
		public $fecha_ant;
		public $por_ant;
		public $costo_cliente;
		public $valor_desde;
		public $por_desde;
		public $ppto;
		public $uaai;
		public $num_aprobacion;
		
		public function get_num_apro(){
			return $this->num_aprobacion;
		}
		
		public function set_num_apro($val){
			$this->num_aprobacion = $val;
		}
		
		public function get_pk_item(){
			return $this->pk_item;
		}
		public function set_pk_item($xx){
			$this->pk_item = $xx;
		}
		
		public function estados_ppto($estado){
			if($estado == 1){
				return "INICIAL SIN APROBAR";
			}else if($estado == 2){
				return "INICIAL SIN APROBAR";
			}else if($estado == 3){
				return "EN APROBACIÓN";
			}else if($estado == 4){
				return "PENDIENTE APROBACIÓN CLIENTE";
			}else if($estado == 5){
				return "APROBADO POR CLIENTE";
			}else if($estado == 6){
				return "APROBADO POR EL CLIENTE (EN ORDENACIÓN)";
			}else if($estado == 100){
				return "RECHAZADO";
			}
		}
		
		public function buscar_ordenes($valor,$tipo,$ppto){
			if($tipo == "OP"){
				$sql = mysql_query("select fp.valor_numerico,
				p.nombre_comercial_proveedor,cop.id,cop.fecha,e.nombre_empleado,fp.name_forma_pago as forma_pago,cop.estado
				from produccion_orden cop, usuario u, empleado e,fpago fp, proveedores p
				where cop.id = '$valor' and cop.ppto = '$ppto' and cop.user = u.idusuario and u.pk_empleado = e.documento_empleado and
				cop.pago = fp.codigo_interno and cop.proveedor = p.codigo_interno_proveedor");
				$est = "";
				if(mysql_num_rows($sql) == 0){
					$est = "La orden de Producción # $valor no fue encontrada sobre este Presupuesto !";
				}else{
					$est = "<table width = '100%' class = 'tabla_muestra_datos_tabla' style = 'border-collapse:collapse;'>
						<tr>
							<th></th>
							<th>PROVEEDOR</th>
							<th># OP</th>
							<th>FECHA</th>
							<th>CREADA POR</th>
							<th>ITEMS</th>
							<th>DESCARGAR OP</th>
							<th>DESCARGAR</BR>CANCELACION OP</th>
						</tr>";
					while($row = mysql_fetch_array($sql)){
						$eliminar = "";
						$cancelacion = "";
						if($row['estado'] == 1){
							$eliminar = "<img src = '../images/iconos/eliminar2.png' width = '30px' onclick = 'cancelacion_orden_produccion($valor)' />";
						}else{
							$cancelacion = "<a target = '_blank' href = 'fcancelacionop.php?op=$valor&ppto=$ppto'>
												<img src = '../images/iconos/icono_descarga.png' class = 'icono_descarga' />
											</a>";
						}
						
						$est.="<tr>
								<td  align = 'center'>
									$eliminar
								</td>
								<td style = 'border:1px solid black;'>".$row['nombre_comercial_proveedor']."</td>
								<td style = 'border:1px solid black;'>".$row['id']."</td>
								<td style = 'border:1px solid black;'>".$row['fecha']."</td>
								<td style = 'border:1px solid black;'>".utf8_decode($row['nombre_empleado'])."</td>
								<td style = 'border:1px solid black;'>
									<table width = '100%' style = 'background-color:white;'>
										<tr>
											<th>Item</th>
											<th>Días</th>
											<th>Cant.</th>
											<th>$ Unitario</th>
										</tr>";
						$sql_interno = mysql_query("select dp.name_item,dp.val_item,dp.iva_item,dp.por_prov,dp.dias,dp.q
						from detalle_produccion_orden dp
						where dp.op = '$valor'");
						while($r = mysql_fetch_array($sql_interno)){
							$est.="<tr>
								<td style = 'border:1px solid black;'>".utf8_decode($r["name_item"])."</td>
								<td style = 'border:1px solid black;'>".$r["dias"]."</td>
								<td style = 'border:1px solid black;'>".$r["q"]."</td>
								<td style = 'border:1px solid black;'>".$r["val_item"]."</td>
							</tr>";
						}
						$est.="</table></td>";
						$est.="<td style = 'border:1px solid black;' align = 'center'>
									<a target = '_blank' href = 'pdf_opp.php?op=$valor'>
										<img src = '../images/iconos/icono_descarga.png' class = 'icono_descarga' />
									</a>
								</td>";
						$est.="<td style = 'border:1px solid black;' align = 'center'>$cancelacion</td>";
						$est.="</tr>";
					}
				}
				
				return $est."</table>";
			}else if($tipo == "OC"){
				$sql = mysql_query("select e.nombre_empleado,p.nombre_comercial_proveedor,oc.fecha_orden,oc.codigo_interno_op,oc.razon_cancelacion
				from orproduccion oc, empleado e, proveedores p,usuario u
				where oc.codigo_interno_op = '$valor' and oc.ppto = '$ppto' and oc.usu_orden = u.idusuario and u.pk_empleado = e.documento_empleado
				and oc.proveedor = p.codigo_interno_proveedor");
				$est = "";
				if(mysql_num_rows($sql) == 0){
					$est = "La orden de Compra # $valor no fue encontrada sobre este Presupuesto !";
				}else{
					$est = "<table width = '100%' class = 'tabla_muestra_datos_tabla' style = 'border-collapse:collapse;'>
						<tr>
							<th></th>
							<th>PROVEEDOR</th>
							<th># OC</th>
							<th>FECHA</th>
							<th>CREADA POR</th>
							<th>ITEMS</th>
							<th>DESCARGAR OC</th>
							<th>DESCARGAR</BR>CANCELACIÓN OC</th>
						</tr>";
					while($row = mysql_fetch_array($sql)){
						$eliminar = "";
						$cancelacion = "";
						if(count($row['razon_cancelacion']) == 0){
							$eliminar = "<img src = '../images/iconos/eliminar2.png' width = '30px' onclick = 'cancelacion_orden_compra($valor)' />";
						}else{
							$cancelacion = "<a target = '_blank' href = 'fcancelacionoc.php?oc=$valor&ppto=$ppto'>
												<img src = '../images/iconos/icono_descarga.png' class = 'icono_descarga' />
											</a>";
						}
						
						$est.="<tr>
								<td  align = 'center'>
									$eliminar
								</td>
								<td style = 'border:1px solid black;'>".$row['nombre_comercial_proveedor']."</td>
								<td style = 'border:1px solid black;'>".$row['codigo_interno_op']."</td>
								<td style = 'border:1px solid black;'>".$row['fecha_orden']."</td>
								<td style = 'border:1px solid black;'>".utf8_decode($row['nombre_empleado'])."</td>
								<td style = 'border:1px solid black;'>
									<table width = '100%' style = 'background-color:white;'>
										<tr>
											<th>Item</th>
											<th>Días</th>
											<th>Cant.</th>
											<th>$ Unitario</th>
										</tr>";
						$sql_interno = mysql_query("select dp.name_item,dp.val_item,dp.iva_item,dp.por_prov,dp.dias,dp.q
						from itempresup dp
						where dp.pk_orden = '$valor'");
						while($r = mysql_fetch_array($sql_interno)){
							$est.="<tr>
								<td style = 'border:1px solid black;'>".utf8_decode($r["name_item"])."</td>
								<td style = 'border:1px solid black;'>".$r["dias"]."</td>
								<td style = 'border:1px solid black;'>".$r["q"]."</td>
								<td style = 'border:1px solid black;'>".$r["val_item"]."</td>
							</tr>";
						}
						$est.="</table></td>";
						$est.="<td style = 'border:1px solid black;' align = 'center'>
									<a target = '_blank' href = 'pdf_op.php?op=$valor'>
										<img src = '../images/iconos/icono_descarga.png' class = 'icono_descarga' />
									</a>
								</td>";
						$est.="<td style = 'border:1px solid black;' align = 'center'>$cancelacion</td>";
						$est.="</tr>";
					}
				}
				
				return $est."</table>";
			}
		
		}
		
		public function buscar_pptos($ot){
			$sel = "select pp.codigo_presup, pp.numero_presupuesto, pp.referencia, pp.fecha_registro, pp.ot, pc.nombre_producto,pp.estado_presup, pp.vigencia_final,pp.vc,pp.vi
			from cabpresup pp, cabot cb, producto_clientes pc where
			pp.ot = '$ot' and cb.codigo_ot = '$ot' and cb.producto_clientes_codigo_PRC = pc.id_procliente";
			$r = mysql_query($sel);
			$tabla = "<table id = 'muestra_pptos' width = '100%' class = 'tablas_muestra_datos_tablas_produccion'>
						<tr>
							<th>*</th>
							<th># Ppto Int</th>
							<th># Ppto Ext</th>
							<th>FECHA</th>
							<th>ESTADO</th>
							<th>REFERENCIA</th>
							<th>PRODUCTO</th>
							<th>OT</th>
						</tr>";
			while($row = mysql_fetch_array($r)){
				$id = $row['codigo_presup'];
				$text = $this->estados_ppto($row['estado_presup']);
				
				/*if((date("Y-m-d")) > ($row['vigencia_final']) && $row['estado_presup'] == 3){
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
				}*/
				
				$tabla.= "<tr id = '$id'>
					<td>
						<div>
							<input type = 'radio' id = 'grupo$id' name = 'select_ppto' value = '$id' onclick = 'visualizar_pptos()' class = 'radio'/>
							<label for='grupo$id'><span><span></span></span></label>
						</div>
					</td>
					<td align = 'left' style = 'text-align:left;padding-left:15px;'>".$row['codigo_presup']." V ".$row['vi']."</td>
					<td align = 'left' style = 'text-align:left;padding-left:15px;'>".$row['numero_presupuesto']." V ".$row['vc']."</td>
					<td align = 'left'>".$row['fecha_registro']."</td>
					<td align = 'left' style = 'text-align:left;padding-left:15px;'>".$text."</td>
					<td align = 'left' style = 'text-align:left;padding-left:15px;'>".$row['referencia']."</td>
					<td align = 'left' style = 'text-align:left;padding-left:15px;'>".$row['nombre_producto']."</td>
					<td align = 'left'>".$ot."</td>
					</tr>";
			}
			echo $tabla;
		}
		
		public function get_dias(){
			return $this->dias;
		}
		public function set_dias($xx){
			$this->dias = $xx;
		}
		public function get_q(){
			return $this->q;
		}
		public function set_q($xx){
			$this->q = $xx;
		}
		
		public function get_val_item(){
			return $this->val_item;
		}
		public function set_val_item($xx){
			$this->val_item = $xx;
		}
		public function get_descripcion(){
			return $this->descripcion;
		}
		public function set_descripcion($xx){
			$this->descripcion = $xx;
		}
		public function get_fecha_ant(){
			return $this->fecha_ant;
		}
		public function set_fecha_ant($xx){
			$this->fecha_ant = $xx;
		}
		public function get_por_ant(){
			return $this->por_ant;
		}
		public function set_por_ant($xx){
			$this->por_ant = $xx;
		}
		public function get_costo_cliente(){
			return $this->costo_cliente;
		}
		public function set_costo_cliente($xx){
			$this->costo_cliente = $xx;
		}
		public function get_valor_desde(){
			return $this->valor_desde;
		}
		public function set_valor_desde($xx){
			$this->valor_desde = $xx;
		}
		public function get_por_desde(){
			return $this->por_desde;
		}
		public function set_por_desde($xx){
			$this->por_desde = $xx;
		}
		public function get_ppto(){
			return $this->ppto;
		}
		public function set_ppto($xx){
			$this->ppto = $xx;
		}
		public function set_uaai($x){
			$this->uaai = $x;
		}
		public function mostrar_uaai(){
			return $this->uaai;
		}
		
		
		//NUEVA VERSION DE PPTO
		public function update_item_nuevo_ppto($id,$grupo,$name,$descripcion,$proveedor,$dias,$q,$valor,$iva,$vol,$cliente,$vi,$vc,$i,$desc2){
			mysql_query("update itempresup set proveedor = '$proveedor', name_grupo = '".utf8_encode($grupo)."',dias = '$dias', q = '$q', descripcion = '".utf8_encode($descripcion)."',
			name_item = '".utf8_encode($name)."', val_item = '$valor',iva_item = '$iva', cliente = '$cliente',por_prov = '$vol', vi = '$vi',vc = '$vc' , num_interno = '$i', descripcion2 = '".utf8_encode($desc2)."'
			where id = '$id'");
		}
		
		public function consultar_valor_item($item){
			$sql = mysql_query("select tarifa from item_tarifario where id = '$item'");
			$x = "";
			while($row = mysql_fetch_array($sql)){
				$x = $row['tarifa'];
			}
			return $x;
		}
		
		public function contar_items_por_ppto($ppto){
			$sql = mysql_query("select ppto as num from itempresup where ppto = '$ppto'");
			$i = 0;
			while($row = mysql_fetch_array($sql)){
				$i++;
			}
			return $i+1;
		}
		
		public function consultar_proveedor_item($item){
			$sql = mysql_query("select proveedor from item_tarifario where id = '$item'");
			$x = "";
			while($row = mysql_fetch_array($sql)){
				$x = $row['proveedor'];
			}
			return $x;
		}
		
		public function consultar_valor_desde($item){
			/*$sql = mysql_query("select desde from item_tarifario where id = '$item'");
			$x = "";
			while($row = mysql_fetch_array($sql)){
				$x = $row['desde'];
			}*/
			return 0;
		}
		
		public function consultar_valor_por_desde($item){
			$sql = mysql_query("select volumen from item_tarifario where id = '$item'");
			$x = "";
			while($row = mysql_fetch_array($sql)){
				$x = $row['volumen'];
			}
			return $x;
		}
		
		public function insert_item_ppto($num,$fecha,$usuario,$celula,$pro){
			$sql = mysql_query("insert into itempresup(num_interno,pk_item,dias,q,descripcion,val_item,fecha_ant,por_ant,cliente,val_desde_item,
			por_prov,usuario,fecha_registro,ppto,celula,proveedor) values('".$num."','".
			$this->get_pk_item()."','".$this->get_dias()."','".$this->get_q()."','".$this->get_descripcion()."','".$this->get_val_item()."','".$this->get_fecha_ant()."','".
			$this->get_por_ant()."','".$this->get_costo_cliente()."','".$this->get_valor_desde()."','".$this->get_por_desde()."','".$usuario."','".$fecha."','".$this->get_ppto()
			."','".$celula."','".$pro."')");
		}
		
		public function listar_grupos_tarifario($nombre){
			$sql = mysql_query("select name, id from grupo_tarifario where name like '%$nombre%'");
			$imp = "<div class = 'listado_items'><table width = '100%'>";
			while($row = mysql_fetch_array($sql)){
				$id = $row['id'];
				$imp.="<tr>
					<td >
						<div>
							<input type = 'radio' id = 'grupo$id' name = 'grupo_sel' value = '$id' onclick = 'grupo_selected()' class = 'radio'/>
							<label for='grupo$id'><span><span></span></span>".$row['name']."</label>
						</div>
					</td>
				</tr>";
			}
			return $imp."</table></div>";
		}
		
		public function modificar_grupo_celula($id,$grupo){
			mysql_query("update cecula_ppto_interno set nombre_celula = '$grupo' where codigo_int_celula = '$id'");
		}
		
		public function listar_grupos_tarifario_m($nombre,$idx){
			$sql = mysql_query("select name, id from grupo_tarifario where name like '$nombre%'");
			$imp = "<div class = 'listado_items'><table width = '100%'>";
			while($row = mysql_fetch_array($sql)){
				$id = $row['id'];
				$imp.="<tr>
					<td>
						<div>
							<input type = 'radio'  name = 'grupo_selm' id = 'grupoo$id'value = '$id' onclick = 'modificar_grupo_actual_ppto_celula($idx)' class = 'radio'/>
							<label for='grupoo$id'><span><span></span></span>".$row['name']."</label>
						</div>
					</td>
				</tr>";
			}
			return $imp."</table></div>";
		}
		
		public function listado_items_x_grupo($name,$g,$z){
			$sql_items = mysql_query("select name,id from item_tarifario where name like '%$name%'");
			$imp = "<div class = 'listado_items'><table width = '100%'>";
			while($row = mysql_fetch_array($sql_items)){
				$id = $row['id'];
				$imp.="<tr>
					<td nowrap>
						<div>
							<input type = 'radio'  name = 'item_sel' value = '$id' onclick = 'item_selected($z)' class = 'radio'/>
							<label for='$id'><span><span></span></span>".$row['name']."</label>
						</div>
					</td>
				</tr>";
			}
			return $imp."</table></div>";
		}
		
		public function listado_items_x_nuevo_ppto($name,$i){
			$sql_items = mysql_query("select name,id from item_tarifario where name like '%$name%'");
			$imp = "<div class = 'listado_items'><table width = '100%'>";
			while($row = mysql_fetch_array($sql_items)){
				$id = $row['id'];
				$name = $row['name'];
				$imp.="<tr>
					<td nowrap>
						<span class = 'hidde' id = 'xxnameitem$id'>$name</span>
						<div>
							<input type = 'radio' value = '$name' id = 'val$id' onclick = 'guardar_array_id($id,$i)' class = 'radio'/>
							<label for='val$id'><span><span></span></span>".$row['name']."</label>
						</div>
						
					</td>
				</tr>";
			}
			return $imp."</table></div>";
		}
		
		public function listar_proveedores_ppto($num){
			$imp = "<option value = '0'>[SELECCIONE]</option>";
			$sql = mysql_query("select distinct p.nombre_comercial_proveedor, p.codigo_interno_proveedor
				from itempresup ip, proveedores p
				where ip.proveedor =  p.codigo_interno_proveedor and ip.ppto = '$num'
				order by p.codigo_interno_proveedor asc");
				while($row = mysql_fetch_array($sql)){
					$imp.="<option value ='".$row['codigo_interno_proveedor']."'>".$row['nombre_comercial_proveedor']."</option>";
				}
			return $imp;
		}
		
		
		public function formato_anticipos_personal_pptos($ppto){
			$est = "<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td width = '96%' align = 'left'>
								<table width = '100%'>
									<tr>
										<td align = 'left'>
											<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
										</td>
									</tr>
									<tr>
										<td align = 'left' >
											<span class = 'mensaje_bienvenida'>GENERAR ORDEN</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right'>
								<img onclick = 'cerrar_ventana_form_anticipo_interno()' src = '../images/iconos/icon-19.png' class = 'iconos_opciones'/>
							</td>
						</tr>
					</table>
					<table width = '100%'>
						<tr>
							<td>
								<p>Fecha: ".date("Y-m-d")."</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Nombre Cliente:</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Nombre Proyecto:</p>
							</td>
							<td>
								<p>No. PPTO:</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Fecha Entrega Anticipo:</p>
							</td>
							<td>
								<p>Fecha Culminación Evento/Actividad:</p>
							</td>
						</tr>
					</table>
					";
		}
		
		public function listado_items_valores_no_comisionables($name,$z){
			$sql_items = mysql_query("select name,id from item_tarifario where name like '%$name%'");
			$imp = "<div class = 'listado_items'><table>";
			while($row = mysql_fetch_array($sql_items)){
				$id = $row['id'];
				$imp.="<tr>
					<td nowrap>
						<div>
							<input type = 'radio'  name = 'item_nc' value = '$id' onclick = 'item_selected_nc($z)' class = 'radio'/>
							<label for='$id'><span><span></span></span>".$row['name']."</label>
						</div>
					</td>
				</tr>";
			}
			return $imp."</table></div>";
		}
		
		public function nota_op_empresa($num){
			$sql = mysql_query("select e.nota_orden from empresa e, cabpresup p
			where p.empresa_nit_empresa = e.cod_interno_empresa and p.codigo_presup = '$num'");
			while($row = mysql_fetch_array($sql)){
				return $row['nota_orden'];
			}
		}
		
		public function productos_proveedor_ppto($pro,$num){
			$sql = mysql_query("select ip.id as codigo_item,ip.por_prov as volumen,i.name,ip.id, ip.dias, ip.q, ip.descripcion,ip.val_item
				from itempresup ip, item_tarifario i, proveedores p
				where i.id = ip.pk_item and ip.proveedor =  p.codigo_interno_proveedor and ip.ppto = '$num' and p.codigo_interno_proveedor = '$pro'
				order by p.codigo_interno_proveedor  asc");
			$estructura = "<table width = '100%' class = 'tablas_muestra_datos_tablaspro'>
				<tr>
					<th>Sel.</th>
					<th>Item</th>
					<th>Descripción</th>
					<th>D</th>
					<th>Q</th>
					<th>Valor</th>
					
				</tr>
			";
			while($row = mysql_fetch_array($sql)){
				$estructura.="<tr>
					<td>
						<div>
							<input type = 'checkbox' id = 'item_select".$row['codigo_item']."' name = 'productos_proveedores[]' value = '".$row['codigo_item']."' class = 'radio'/>
							<label for='item_select".$row['codigo_item']."'><span><span></span></span></label>
						</div>
					</td>
					<td>".$row['name']."</td>
					<td>".nl2br($row['descripcion'])."</td>
					<td>".$row['dias']."</td>
					<td>".$row['q']."</td>
					<td align = 'right'>$ ".number_format($row['q']*$row['dias']*$row['val_item'])."</td>
				</tr>";
			}
			return $estructura;
		}
		
		public function calcular_d_q_val($v,$d,$q){
			return $v*$d*$q;
		}
		
		public function calcular_comision_dinero($v,$d,$q,$c,$item){
			$x = 0;
			$sql = mysql_query("select volumen from item_tarifario where id = '$item'");
			while($row = mysql_fetch_array($sql)){
				$x = $row['volumen'];
			}
			$v = $v -($v*($x/100));
			$val = $this->calcular_d_q_val($c,$d,$q) - $this->calcular_d_q_val($v,$d,$q);
			return $val;
		}
		
		public function calcular_comision_porcentaje($v,$d,$q,$c,$item){
			if($this->calcular_d_q_val($v,$d,$q) == 0 || $this->calcular_d_q_val($c,$d,$q) == 0 ){
				return 0;
			}else{
				$x = 0;
				$sql = mysql_query("select volumen from item_tarifario where id = '$item'");
				while($row = mysql_fetch_array($sql)){
					$x = $row['volumen'];
				}
				$xx = $v -($v*($x/100));
				$val = ($this->calcular_d_q_val($xx,$d,$q)/$this->calcular_d_q_val($c,$d,$q));
				$val2 = (1-$val)*100;
				return $val2;
			}
		}
		
		public function comision_total($v,$d,$q,$c,$item){
			$val = $this->calcular_comision_dinero($v,$d,$q,$c,$item);
			$val2 = $v - $this->consultar_valor_volumen($item,$v);
			return $val + $val2;
		}
		
		public function porcentaje_comision_total($v,$d,$q,$c,$item,$vol){
			$val = $this->calcular_comision_porcentaje($v,$d,$q,$c,$item);
			return $val+$vol;
		}
		
		public function comision_cliente($num_ppto,$vcomisionables){
			$sql = mysql_query("select cc.uaai,cc.tipo, p.pk_clientes_nit_cliente 
			from cabpresup p, condiciones_cliente cc
			where p.codigo_presup = '$num_ppto' and p.pk_clientes_nit_cliente = cc.cliente  AND p.tipo_comision = cc.consecutivo");
			$uaai = "";
			while($row = mysql_fetch_array($sql)){
				$uaai = $row['uaai'];
				$real = (100-$uaai)/100;
				$this->set_uaai($real);
				if($row['tipo'] == 1){
					return ($vcomisionables/$real)-$vcomisionables;
				}
				else if($row['tipo'] == 2){
					return $vcomisionables*($uaai/100);
				}
			}
		}
		public function comision_cliente_valor($num_ppto,$vcomisionables){
			$sql = mysql_query("select cc.uaai,cc.tipo, p.pk_clientes_nit_cliente 
			from cabpresup p, condiciones_cliente cc
			where p.codigo_presup = '$num_ppto' and p.pk_clientes_nit_cliente = cc.cliente AND p.tipo_comision = cc.consecutivo");
			$uaai = "";
			while($row = mysql_fetch_array($sql)){
				return $row['uaai'];
			}
		}
		
		public function calcular_anticipo($por,$val){
			return $val*($por/100);
		}
		
		public function consultar_valor_volumen($item,$valor){
			$x = 0;
			$sql = mysql_query("select por_prov as volumen from itempresup where id = '$item'");
			while($row = mysql_fetch_array($sql)){
				$x = $row['volumen'];
			}
			if($x == 0){
				return $valor;
			}else{
				return $valor -($valor*($x/100));
			}
		}
		
		public function d_consultar_valor_volumen($item,$valor){
			$x = 0;
			$sql = mysql_query("select volumen from item_tarifario where id = '$item'");
			while($row = mysql_fetch_array($sql)){
				$x = $row['volumen'];
			}
			if($x == 0){
				return 0;
			}else{
				return ($valor*($x/100));
			}
		}
		
		public function insertar_grupo_ppto($id,$ppto){
			$insert = mysql_query("insert into cecula_ppto_interno(nombre_celula,pk_ppto_interno) values('".$id."','".$ppto."')");
		}
		
		public function cambiar_dias($q,$id){
			$sql = mysql_query("update itempresup set dias = '$q' where id = '$id'");
		}
	
		public function cambiar_descripcion($q,$id){
			$sql = mysql_query("update itempresup set descripcion = '$q' where id = '$id'");
		}
		
		public function cambiar_q($q,$id){
			$sql = mysql_query("update itempresup set q = '$q' where id = '$id'");
		}
		
		public function cambiar_cliente($q,$id){
			$sql = mysql_query("update itempresup set cliente = '$q' where id = '$id'");
		}
		
		public function modificar_cheques_ppto($q,$ppto){
			mysql_query("update cabpresup set cheques = '$q' where codigo_presup = '$ppto'");
		}
		
		public function cambiar_fecha($q,$id){
			$sql = mysql_query("update itempresup set fecha_ant = '$q' where id = '$id'");
		}
		
		public function cambiar_volumen_item($q,$id){
			$sql = mysql_query("update itempresup set por_prov = '$q' where id = '$id'");
		}
		
		public function cambiar_por_ant($q,$id){
			$sql = mysql_query("update itempresup set por_ant = '$q' where id = '$id'");
		}
		
		public function eliminar_item($x){
			$sql = mysql_query("delete from itempresup where id = '$x'");
		}
		public function eliminar_grupo($x){
			$sql = mysql_query("delete from itempresup where celula = '$x'");
			$sql = mysql_query("delete from cecula_ppto_interno where codigo_int_celula = '$x'");
		}
		
		public function modificar_imprevisto($q,$n){
			$sql = mysql_query("update cabpresup set imprevistos = '$q' where codigo_presup = '$n'");
		}
		
		public function modificar_factoring_impuestos($q,$n){
			$sql = mysql_query("update cabpresup set factoring_imp = '$q' where codigo_presup = '$n'");
		}
		
		public function modificar_ant_int_ban_impuestos($q,$n){
			$sql = mysql_query("update cabpresup set ant_int_bancarios_imp = '$q' where codigo_presup = '$n'");
		}
		
		public function modificar_pro_int_ban_impuestos($q,$n){
			$sql = mysql_query("update cabpresup set pro_int_bancarios_imp = '$q' where codigo_presup = '$n'");
		}
		
		public function modificar_pro_int_ter_impuestos($q,$n){
			$sql = mysql_query("update cabpresup set pro_int_ter_imp = '$q' where codigo_presup = '$n'");
		}
		
		public function modificar_gasto($q,$n){
			$sql = mysql_query("update cabpresup set gastos_admin = '$q' where codigo_presup = '$n'");
		}
		
		
		public function update_comision_pedro($val,$id){
			$sql = mysql_query("update cabpresup set comision_adicional = '$val' where codigo_presup = '$id'");
		}
		
		public function impresvistos($ppto,$valor){
			$contedor = "<td id = 'impresvistos' ondblclick = 'cambiar_imprevistos($ppto)'>";
			$sql = mysql_query("select imprevistos from cabpresup where codigo_presup = '$ppto'");
			while($row = mysql_fetch_array($sql)){
				$vall = $row['imprevistos']/100;
				$contedor.="<span  id = 'imprevistos_h' class = 'hidde' >".$row['imprevistos']."</span><span >".$row['imprevistos']." %</span></td><td>
					<table width = '100%' class = 'sin_color'>
						<tr>
							<td align = 'left'>$</td>
							<td align = 'right'>".number_format($vall*$valor)."</td>
						</tr>
					</table>
					</td>";
			}
			return $contedor;
		}
		
		public function factoring_imp($ppto,$valor){
			$contedor = "<td id = 'factoring_impuestos' ondblclick = 'cambiar_factoring_impuestos($ppto)'>";
			$sql = mysql_query("select factoring_imp from cabpresup where codigo_presup = '$ppto'");
			while($row = mysql_fetch_array($sql)){
				$vall = $row['factoring_imp']/100;
				$contedor.="<span  id = 'factoring_impuestos_h' class = 'hidde' >".$row['factoring_imp']."</span><span >".$row['factoring_imp']." %</span></td><td>
					<table width = '100%' class = 'sin_color'>
						<tr>
							<td align = 'left'>$</td>
							<td align = 'right'>".number_format($vall*$valor)."</td>
						</tr>
					</table>
					</td>";
			}
			return $contedor;
		}
		public function factoring_imp_valor($ppto,$valor){
			
			$sql = mysql_query("select factoring_imp from cabpresup where codigo_presup = '$ppto'");
			while($row = mysql_fetch_array($sql)){
				$vall = $row['factoring_imp']/100;
				return $vall*$valor;
			}
		}
		
		public function pro_int_bancarios_imp($ppto,$valor){
			$contedor = "<td id = 'pro_int_bancarios_imp' ondblclick = 'cambiar_pro_int_bancarios_impuestos($ppto)'>";
			$sql = mysql_query("select pro_int_bancarios_imp from cabpresup where codigo_presup = '$ppto'");
			while($row = mysql_fetch_array($sql)){
				$vall = $row['pro_int_bancarios_imp']/100;
				$contedor.="<span  id = 'pro_int_bancarios_imp_h' class = 'hidde' >".$row['pro_int_bancarios_imp']."</span><span >".$row['pro_int_bancarios_imp']." %</span></td><td>
					<table width = '100%' class = 'sin_color'>
						<tr>
							<td align = 'left'>$</td>
							<td align = 'right'>".number_format($vall*$valor)."</td>
						</tr>
					</table>
					</td>";
			}
			return $contedor;
		}
		public function pro_int_bancarios_imp_valor($ppto,$valor){
			$contedor = "<td id = 'pro_int_bancarios_imp' ondblclick = 'cambiar_pro_int_bancarios_impuestos($ppto)'>";
			$sql = mysql_query("select pro_int_bancarios_imp from cabpresup where codigo_presup = '$ppto'");
			while($row = mysql_fetch_array($sql)){
				$vall = $row['pro_int_bancarios_imp']/100;
				return $vall*$valor;
			}
		}
		
		public function pro_int_ter_imp($ppto,$valor){
			$contedor = "<td id = 'pro_int_ter_imp' ondblclick = 'cambiar_pro_int_ter_impuestos($ppto)'>";
			$sql = mysql_query("select pro_int_ter_imp from cabpresup where codigo_presup = '$ppto'");
			while($row = mysql_fetch_array($sql)){
				$vall = $row['pro_int_ter_imp']/100;
				$contedor.="<span  id = 'pro_int_ter_imp_h' class = 'hidde' >".$row['pro_int_ter_imp']."</span><span >".$row['pro_int_ter_imp']." %</span></td><td>
					<table width = '100%' class = 'sin_color'>
						<tr>
							<td align = 'left'>$</td>
							<td align = 'right'>".number_format($vall*$valor)."</td>
						</tr>
					</table>
					</td>";
			}
			return $contedor;
		}
		public function pro_int_ter_imp_valor($ppto,$valor){
			$sql = mysql_query("select pro_int_ter_imp from cabpresup where codigo_presup = '$ppto'");
			while($row = mysql_fetch_array($sql)){
				$vall = $row['pro_int_ter_imp']/100;
				return $vall*$valor;
			}
		}
		
		public function ant_int_bancarios_imp($ppto,$valor){
			$contedor = "<td id = 'ant_int_bancarios_imp' >";
			$sql = mysql_query("select cc.pago
			from cabpresup p, condiciones_cliente cc
			where p.codigo_presup = '$ppto' and  p.tipo_comision = cc.consecutivo");
			while($row = mysql_fetch_array($sql)){
				$vall = (0.043*$row['pago']);
				$contedor.="<span >".$vall." %</span></td><td>
					<table width = '100%' class = 'sin_color'>
						<tr>
							<td align = 'left'>$</td>
							<td align = 'right'>".number_format(($valor*$vall)/100)."</td>
						</tr>
					</table>
					</td>";
			}
			return $contedor;
		}
		public function ant_int_bancarios_imp_valor($ppto,$valor){
			$sql = mysql_query("select cc.pago
			from cabpresup p, condiciones_cliente cc
			where p.codigo_presup = '$ppto' and  p.tipo_comision = cc.consecutivo");
			while($row = mysql_fetch_array($sql)){
				$vall = (0.043*$row['pago']);
				return ($vall*$valor)/100;
			}
		}
		
		
		public function impresvistos_valor($ppto,$valor){
			$contedor = "<td id = 'impresvistos' ondblclick = 'cambiar_imprevistos($ppto)'>";
			$sql = mysql_query("select imprevistos from cabpresup where codigo_presup = '$ppto'");
			while($row = mysql_fetch_array($sql)){
				$vall = $row['imprevistos']/100;
				return $vall*$valor;
			}
		}
		
		public function gastos_administrativos_valor($ppto,$valor){
			$sql = mysql_query("select gastos_admin from cabpresup where codigo_presup = '$ppto'");
			while($row = mysql_fetch_array($sql)){
				$vall = $row['gastos_admin']/100;
				return $vall*$valor;
			}
		}
		
		public function retencion_fuente_empresa($ppto,$documento){
			$rtefuente = "";
			$sql = mysql_query("select c.empresa_nit_empresa, d.valor 
			from cabpresup c, documentos_legales_entidades d
			where c.codigo_presup = '$ppto' and d.pk_tdocumento = '$documento' and c.empresa_nit_empresa = d.pk_empresa");
			while($row = mysql_fetch_array($sql)){
				return  $row['valor'];
			}
		}
		
		public function retencion_adicional_cliente_ppto($ppto){
			$rtefuente = "";
			$sql = mysql_query("select c.rete_adicional
			from cabpresup c 
			where c.codigo_presup = '$ppto'");
			while($row = mysql_fetch_array($sql)){
				return  $row['rete_adicional'];
			}
		}
		
		public function valor_retencion_fuente_empresa($ppto,$documento,$valor,$cliente,$valor2){
			$rtefuente = 0;
			$sql = mysql_query("select c.empresa_nit_empresa, d.valor 
			from cabpresup c, documentos_legales_entidades d
			where c.codigo_presup = '$ppto' and d.pk_tdocumento = '$documento' and c.empresa_nit_empresa = d.pk_empresa");
			while($row = mysql_fetch_array($sql)){
				$rtefuente = $row['valor'];
			}
			if($cliente == 22){
				return (($valor2)*($rtefuente/100));
			}else{
				return (($valor)*($rtefuente/100));
			}
			
		}
		
		public function ica_empresa($ppto,$documento){
			$rtefuente = "";
			$sql = mysql_query("select c.ica
			from cabpresup c
			where c.codigo_presup = '$ppto'");
			while($row = mysql_fetch_array($sql)){
				return  $row['ica'];
			}
		}
		public function valor_ica_empresa($ppto,$documento,$valor){
			$rtefuente = 0;
			$sql = mysql_query("select c.ica
			from cabpresup c
			where c.codigo_presup = '$ppto'");
			while($row = mysql_fetch_array($sql)){
				$rtefuente = $row['ica'];
			}
			return (($valor)*($rtefuente)/1000);
		}
		
		public function cree_empresa($ppto,$documento){
			$rtefuente = "";
			$sql = mysql_query("select c.empresa_nit_empresa, d.valor 
			from cabpresup c, documentos_legales_entidades d
			where c.codigo_presup = '$ppto' and d.pk_tdocumento = '$documento' and c.empresa_nit_empresa = d.pk_empresa");
			while($row = mysql_fetch_array($sql)){
				return  $row['valor'];
			}
		}
		
		public function update_item_onclick($id,$des,$q,$d,$vcotizacion,$iva,$vol,$vexterna,$fa,$vant){
			$sql = mysql_query("select asoc from itempresup where id = '$id'");
			while($row = mysql_fetch_array($sql)){
				if($row['asoc'] == 0){
					mysql_query("update itempresup set dias = '$d', q = '$q', descripcion = '$des',
					fecha_ant = '$fa', por_ant = '$vant', iva_item = '$iva', cliente = '$vexterna', val_item = '$vcotizacion',por_prov = '$vol'
					where id = '$id'");
				}else{
					mysql_query("update itempresup set descripcion = '$des',
					fecha_ant = '$fa', por_ant = '$vant', iva_item = '$iva', cliente = '$vexterna', por_prov = '$vol'
					where id = '$id'");
				}
			}
			
			
		}
		
		public function valor_cree_empresa($ppto,$documento,$valor){
			$rtefuente = 0;
			$sql = mysql_query("select c.empresa_nit_empresa, d.valor 
			from cabpresup c, documentos_legales_entidades d
			where c.codigo_presup = '$ppto' and d.pk_tdocumento = '$documento' and c.empresa_nit_empresa = d.pk_empresa");
			while($row = mysql_fetch_array($sql)){
				$rtefuente = $row['valor'];
			}
			return (($valor)*($rtefuente)/100);
		}
		public function valor_cheques_empresa($ppto,$documento){
			$rtefuente = 0;
			$sql = mysql_query("select distinct proveedor from
			itempresup 
			where ppto = '$ppto'");
			$i = 0;
			while($row = mysql_fetch_array($sql)){
				$i++;
			}
			$sql = mysql_query("select val_cheques
			from cabpresup
			where codigo_presup = '$ppto'");
			while($row = mysql_fetch_array($sql)){
				return $row['val_cheques']*$i;
			}
		}
		public function num_cheques_empresa($ppto,$documento){
			$rtefuente = 0;
			$sql = mysql_query("select distinct proveedor from
			itempresup 
			where ppto = '$ppto'");
			$i = 0;
			while($row = mysql_fetch_array($sql)){
				$i++;
			}
			return $i;
		}
		
		public function valor_impuestos_adicionales($ppto,$valor,$cliente,$valor2){
			$rtefuente = 0;
			$sql = mysql_query("select c.rete_adicional
			from cabpresup c
			where c.codigo_presup = '$ppto' ");
			while($row = mysql_fetch_array($sql)){
				if($cliente == 22){
					return $valor2 * ($row['rete_adicional']/100);
				}else{
					return $valor * ($row['rete_adicional']/100);
				}
				
			}
		}
		
		public function gastos_administrativos($ppto,$valor){
			$contedor = "<td id = 'gas_admin' ondblclick = 'cambiar_gas_admin($ppto)'>";
			$sql = mysql_query("select gastos_admin from cabpresup where codigo_presup = '$ppto'");
			while($row = mysql_fetch_array($sql)){
				$vall = $row['gastos_admin']/100;
				$contedor.="<span  id = 'gas_admin_h' class = 'hidde' >".$row['gastos_admin']."</span><span >".$row['gastos_admin']." %</span></td><td>
					<table width = '100%' class = 'sin_color'>
						<tr>
							<td align = 'left'>$</td>
							<td align = 'right'>".number_format($vall*$valor)."</td>
						</tr>
					</table>
					</td>";
			}
			return $contedor;
		}
		
		public function copiar_celula_ppto_items($celula,$ppto,$usuario,$fecha){
			$sql = mysql_query("select nombre_celula  from cecula_ppto_interno where codigo_int_celula = '$celula' and pk_ppto_interno = '$ppto'");
			$id = "";
			while($row = mysql_fetch_array($sql)){
				$id = $row['nombre_celula'];
			}
			
			mysql_query("insert into cecula_ppto_interno(nombre_celula,pk_ppto_interno) values('".$id."','".$ppto."')");
			$sql_c = mysql_query("select max(codigo_int_celula) as id from cecula_ppto_interno");
			$id_n = "";
			
			$sql2 = mysql_query("select * from itempresup where celula = '$celula'");
			while($row = mysql_fetch_array($sql_c)){
				$id_n = $row['id'];
			}
			
			while($row = mysql_fetch_array($sql2)){
				mysql_query("insert into itempresup(pk_item,dias,q,descripcion,val_item,fecha_ant,por_ant,cliente,val_desde_item,
				por_prov,usuario,fecha_registro,ppto,celula,proveedor) values('".
				$row['pk_item']."','".$row['dias']."','".$row['q']."','".$row['descripcion']."','".$row['val_item']."','".$row['fecha_ant']."','".
				$row['por_ant']."','".$row['cliente']."','".$row['val_desde_item']."','".$row['por_prov']."','".$usuario."','".$fecha."','".$ppto
				."','".$id_n."','".$row['proveedor']."')");
				
			}
			
		}
		
		public function list_diferente_asoc($ppto,$item){
			$sql = mysql_query("select ip.id as codigo_itempresup,ip.asoc, ip.num_interno,i.id as codigo_item,ip.por_prov as volumen,i.name,ip.id, ip.dias, ip.q, ip.descripcion, ip.val_item, ip.fecha_ant, ip.por_ant, ip.cliente, ip.val_desde_item,
				ip.por_prov, p.nombre_comercial_proveedor,ip.iva_item,p.codigo_interno_proveedor
				from itempresup ip, item_tarifario i, proveedores p
				where i.id = ip.pk_item and ip.proveedor =  p.codigo_interno_proveedor and ip.ppto = '$ppto' and (ip.asoc = '0' or ip.asoc = '$item') and ip.id != '$item'
				order by ip.num_interno asc");
			$option = "<table width = '100%'>";
			while($row = mysql_fetch_array($sql)){
				$id = $row['codigo_itempresup'];
				if($row['asoc'] == $item){
					$option.="<tr><td nowrap>
							<div>
								<input type = 'checkbox' id = 'item_asocx$id' name = 'items_asoc_ppto[]' value = '$id' class = 'radio' onclick = 'acum_sumar_asoc($ppto)' checked/>
								<label for='item_asocx$id'><span><span></span></span>".$row['num_interno']." - ".$row['name']."</label>
							</div>
						</td></tr>";
				}else{
					$option.="<tr><td nowrap>
							<div>
								<input type = 'checkbox' id = 'item_asocx$id' name = 'items_asoc_ppto[]' value = '$id' class = 'radio' onclick = 'acum_sumar_asoc($ppto)'/>
								<label for='item_asocx$id'><span><span></span></span>".$row['num_interno']." - ".$row['name']."</label>
							</div>
						</td></tr>";
				}
				
			}
			/*$sql = mysql_query("select ip.id as codigo_itempresup,ip.asoc, ip.num_interno,i.id as codigo_item,ip.por_prov as volumen,i.name,ip.id, ip.dias, ip.q, ip.descripcion, ip.val_item, ip.fecha_ant, ip.por_ant, ip.cliente, ip.val_desde_item,
				ip.por_prov, p.nombre_comercial_proveedor,ip.iva_item,p.codigo_interno_proveedor
				from itempresup ip, item_tarifario i, proveedores p
				where i.id = ip.pk_item and ip.proveedor =  p.codigo_interno_proveedor and ip.ppto = '$ppto' and ip.asoc = '$item' and ip.id != '$item'
				order by ip.num_interno asc");
			
			while($row = mysql_fetch_array($sql)){
				$id = $row['codigo_itempresup'];
				$option.="<tr><td nowrap>
							<div>
								<input type = 'checkbox' id = 'item_asocx$id' name = 'items_asoc_ppto[]' value = '$id' class = 'radio' onclick = 'acum_sumar_asoc($ppto)' checked/>
								<label for='item_asocx$id'><span><span></span></span>".$row['num_interno']." - ".$row['name']."</label>
							</div>
						</td></tr>";
			}*/
			echo $option."</table>";
		}
		
		public function guardar_asociacion_items($principal,$ppto,$items){
			mysql_query("update itempresup set asoc = '$principal' where ppto = '$ppto' and id = '".$items."'");
		}
		
		public function items_seleccionados_asoc($principal,$ppto,$items){
			$list_items = "";
			if($items != "x"){
				if(count($items) > 0 && count($items)<= 1){
					$list_items = "and ip.id = '".$items[0]."' ";
				}else{
					$list_items.=" and (ip.id = '".$items[0]."' or";
					for($i = 1;$i < count($items)-1; $i++){
						$list_items.=" ip.id = '".$items[$i]."' or";
					}
					$list_items.=" ip.id = '".$items[count($items)-1]."')";
				}
			}			
			$sql = mysql_query("select ip.id as codigo_itempresup,ip.asoc, ip.num_interno,i.id as codigo_item,ip.por_prov as volumen,i.name,ip.id, ip.dias, ip.q, ip.descripcion, ip.val_item, ip.fecha_ant, ip.por_ant, ip.cliente, ip.val_desde_item,
				ip.por_prov, p.nombre_comercial_proveedor,ip.iva_item,p.codigo_interno_proveedor
				from itempresup ip, item_tarifario i, proveedores p
				where i.id = ip.pk_item and ip.proveedor =  p.codigo_interno_proveedor and ip.ppto = '$ppto' and (ip.asoc = '0' ) and ip.id = '$principal'
				order by ip.num_interno asc");
			$tab = "<table class = 'tabla_nuevos_datos2'>	
			<tr>
				<th style = 'padding-left:10px;padding-right:10px;border-top-left-radius:0.3em;-moz-border-top-left-radius:0.3em;-webkit-border-top-left-radius:0.3em;background-color:white;'>#</th>
				<th style = 'background-color:white;'>ITEM</th>
				<th style = 'border-top-right-radius:0.3em;-moz-border-top-right-radius:0.3em;-webkit-border-top-right-radius:0.3em;background-color:white;'>VALOR</th>
			</tr>";
			$prin = 0;
			$acum = 0;
			while($row = mysql_fetch_array($sql)){
				$prin = $row['val_item']*$row['dias']*$row['q'];
				$tab.="<tr>
					<td align = 'center' style = 'font-weight:bold;border:1px solid black;padding-left:5px;padding-right:5px;'>".$row['num_interno']."</td>
					<td style = 'font-weight:bold;border:1px solid black;padding-left:5px;padding-right:5px;'>".$row['name']."</td>
					<td style = 'font-weight:bold;border:1px solid black;padding-left:5px;padding-right:5px;'>
						<table width = '100%' class = 'sin_color'>
							<tr>
								<td align = 'left'>$</td>
								<td align = 'right'>".number_format($row['val_item']*$row['dias']*$row['q'])."</td>
							</tr>
						</table>
					</td>
				</tr>";
			}
			if(($items) !="x"){
				$sql = mysql_query("select ip.id as codigo_itempresup, ip.asoc, ip.num_interno,i.id as codigo_item,ip.por_prov as volumen,i.name,ip.id, ip.dias, ip.q, ip.descripcion, ip.val_item, ip.fecha_ant, ip.por_ant, ip.cliente, ip.val_desde_item,
				ip.por_prov, p.nombre_comercial_proveedor,ip.iva_item,p.codigo_interno_proveedor
				from itempresup ip, item_tarifario i, proveedores p
				where i.id = ip.pk_item and ip.proveedor =  p.codigo_interno_proveedor and ip.ppto = '$ppto' and (ip.asoc = '0' or ip.asoc = '$principal') $list_items
				order by ip.num_interno asc");
			
				while($row = mysql_fetch_array($sql)){
					$acum+=$row['val_item']*$row['dias']*$row['q'];
					$tab.="<tr>
						<td style = 'color:red;border:1px solid black;padding-left:5px;padding-right:5px;' align = 'center'>".$row['num_interno']."</td>
						<td style = 'color:red;border:1px solid black;padding-left:5px;padding-right:5px;'>".$row['name']."</td>
						<td style = 'color:red;border:1px solid black;padding-left:5px;padding-right:5px;'>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td align = 'left'>$</td>
									<td align = 'right'>-".number_format($row['val_item']*$row['dias']*$row['q'])."</td>
								</tr>
							</table>
						</td>
					</tr>";
				}
			}
			
			$tab.="<tr>
				<td style = 'font-weight:bold;color:black;border:1px solid black;padding-left:5px;padding-right:5px;' colspan = '2'>
					DISPONIBLE
				</td>
				<td style = 'color:black;border:1px solid black;padding-left:5px;padding-right:5px;'>
					<table width = '100%' style = 'color:black;' class = 'sin_color'>
						<tr>
							<td align = 'left' style = 'color:black;'>$</td>
							<td align = 'right' style = 'color:black;'>".number_format($prin-$acum)."</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td></br></td></tr>";
			$guardar = "";
			if(($prin-$acum) <= 0){
				$guardar ="<span style = 'color:red;font-weight:bold;'>LOS ITEMS ASOCIADOS SUPERAN EL MONTO ESTABLECIDO</span>";
			}else if (($prin-$acum) > 0){
				$guardar ="<span onclick = 'guardar_asociacion_items($ppto)' class = 'botton_verde'>GUARDAR</span>";
			}
			$guardar ="<span onclick = 'guardar_asociacion_items($ppto)' class = 'botton_verde'>GUARDAR</span>";
			$tab.="<tr>
				<td colspan = '3' align = 'center'>
					$guardar
				</td>
			</tr>";
			echo $tab."</table>";
			
		}
		
		
		public function est_asiciacion($ppto){
			$sql = mysql_query("select ip.id as codigo_itempresup,ip.asoc, ip.num_interno,i.id as codigo_item,ip.por_prov as volumen,i.name,ip.id, ip.dias, ip.q, ip.descripcion, ip.val_item, ip.fecha_ant, ip.por_ant, ip.cliente, ip.val_desde_item,
				ip.por_prov, p.nombre_comercial_proveedor,ip.iva_item,p.codigo_interno_proveedor
				from itempresup ip, item_tarifario i, proveedores p
				where i.id = ip.pk_item and ip.proveedor =  p.codigo_interno_proveedor and ip.ppto = '$ppto' and ip.asoc = '0'
				order by ip.num_interno asc");
			$option = "<option value ='0'>[SELECCIONE]</option>";
			while($row = mysql_fetch_array($sql)){
				$id = $row['codigo_itempresup'];
				
				$option .="<option value ='$id'>".$row['name']."</option>";
			}
			$t = "<table width = '100%' class = 'tabla_nuevos_datos2'>
				<tr>
					<td style = 'vertical-align:top;'>
						<p>Seleccione el item principal:</p>
						<select id = 'item_asoc_principal' onchange = 'buscar_items_diferentes($ppto)' style = 'width:auto;'>
							$option
						</select>
					</td>
					<td rowspan = '2' id = 'list_valores_items_selected_asoc' style = 'vertical-align:top;'>
						
					</td>
				</tr>
				<tr>
					<td>
						<p>Seleccione los items que lo integran:</p>
						<div width = '100%' id = 'list_select_asoc' style = 'overflow:scroll;height:400px;'>
						</div>
					</td>
				</tr>
			</table>";
			echo $t;
		}

		public function evaluar_estado_ppto_aprobado_sin_facturar_o_pte_aprobacion($valor,$num_ppto){
			$valor = $valor*100;
			$sql = mysql_query("select min_val from cabpresup where codigo_presup = '$num_ppto'");
			$por = 0;
			while($row = mysql_fetch_array($sql)){
				$por = $row['min_val'];
			}
			if($valor < $por){
				mysql_query(("update cabpresup set estado_presup = '1' where codigo_presup = '$num_ppto'"));
				return "<td style = 'background-color:red;font-weight:bold;color:white;font-size:15px;'><table width = '100%' class = 'sin_color' ><tr><td >".number_format($valor)."</td><td >%</td></tr></table></td>";
			}else{
				mysql_query(("update cabpresup set estado_presup = '2' where codigo_presup = '$num_ppto'"));
				return "<td style = 'background-color:green;font-weight:bold;color:white;font-size:15px;'><table width = '100%' class = 'sin_color'><tr><td >".number_format($valor)."</td><td >%</td></tr></table></td>";
			}
		}
		
		public function asociado_sino($val){
			if($val == 0){
				return "0";
			}else{
				$sql = mysql_query("select num_interno from itempresup where id = '$val'");
				while($row = mysql_fetch_array($sql)){
					return $row['num_interno'];
				}
			}
		}
		
		public function estructura($num_ppto){
			$nombre_ppto = mysql_query("select referencia,comision_adicional,numero_presupuesto from cabpresup where codigo_presup = '$num_ppto'");
			$valor_comision_pedro = 0;
			$imp = "<div  id = 'contenedor_ppto_x'><table width = '100%' id = 'tabla_mayor_ppto' class = 'display_ppto'>";
			while($row = mysql_fetch_array($nombre_ppto)){
				$valor_comision_pedro = $row['comision_adicional'];
				$imp .="<thead><tr>
							<th class = 'titulo_ppto_general_concepto' style = 'background-color:rgb(127,146,153);'colspan = '30'> AG # $num_ppto CL # ".$row['numero_presupuesto']." - ".strtoupper($row['referencia'])."</th>
						</tr>";
			}
			$imp.="<tr><th></br></th></tr>";
			$imp.="<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th class = 'separator'></th>
				<th colspan = '3' class = 'grupos_ppto_general' style = 'background-color:rgb(127,146,153);' align = 'center'><strong>ANTICIPO</strong></th>
				<th class = 'separator'></th>
				<th colspan = '2' class = 'grupos_ppto_general' style = 'background-color:rgb(127,146,153);' align = 'center'><strong>VALOR COMPRA INTERNA</strong></th>
				<th class = 'separator'></th>
				<th colspan = '3' class = 'grupos_ppto_general' style = 'background-color:rgb(127,146,153);' align = 'center'><strong>VALOR COTIZACIÓN</strong></th>
				<th class = 'separator'></th>
				<th colspan = '2' class = 'grupos_ppto_general' style = 'background-color:rgb(127,146,153);' align = 'center'><strong>VOLUMEN</strong></th>
				<th class = 'separator'></th>
				<th colspan = '2' class = 'grupos_ppto_general' style = 'background-color:rgb(127,146,153);' align = 'center'><strong>VALOR VENTA EXTERNA</strong></th>
				<th class = 'separator'></th>
				<th colspan = '2' class = 'grupos_ppto_general' style = 'background-color:rgb(127,146,153);' align = 'center'><strong>COMISION VENTA</strong></th>
				<th class = 'separator'></th>
				<th colspan = '2' class = 'grupos_ppto_general' style = 'background-color:rgb(127,146,153);'align = 'center'><strong>TOTAL UTILIDAD VENTA</strong></th>
			</tr>";
			$total_volumen = 0;
			$imp.="<tr>
				<th></th>
				<th class = 'subtitulos_columnas' nowrap>ITEM</th>
				<th class = 'subtitulos_columnas' nowrap>ASOCIADO</th>
				<th class = 'subtitulos_columnas' >DESCRIPCION</th>
				<th class = 'subtitulos_columnas' nowrap>PROVEEDOR</th>
				<th class = 'subtitulos_columnas'>CANT.</th>
				<th class = 'subtitulos_columnas'>DÍAS</th>
				<th class = 'separator'></th>
				<th class = 'subtitulos_columnas'>VALOR</th>
				<th class = 'subtitulos_columnas'>%</th>
				<th class = 'subtitulos_columnas'>FECHA</th>
				<th class = 'separator'></th>
				<th class = 'subtitulos_columnas'>UNITARIO</th>
				<th class = 'subtitulos_columnas'>TOTAL</th>
				<th class = 'separator'></th>
				<th class = 'subtitulos_columnas'>VALOR</th>
				<th class = 'subtitulos_columnas'>IVA</th>
				<th class = 'subtitulos_columnas'>TOTAL</th>
				<th class = 'separator'></th>
				<th class = 'subtitulos_columnas'>VALOR</th>
				<th class = 'subtitulos_columnas'>%</th>
				<th class = 'separator'></th>
				<th class = 'subtitulos_columnas'>UNITARIO</th>
				<th class = 'subtitulos_columnas'>TOTAL</th>
				<th class = 'separator'></th>
				<th class = 'subtitulos_columnas'>$</th>
				<th class = 'subtitulos_columnas'>%</th>
				<th class = 'separator'></th>
				<th class = 'subtitulos_columnas'>$</th>
				<th class = 'subtitulos_columnas'>%</th>
			</tr>
			</thead><tbody>";
			$imp.="<tr><td></br></td></tr>";
			$sql_grupos = mysql_query("select g.name as grupo, g.id as codigo,cp.codigo_int_celula
			from grupo_tarifario g, cecula_ppto_interno cp
			where cp.pk_ppto_interno = '$num_ppto' and cp.nombre_celula <> 'VALORES NO COMISIONABLES' and cp.nombre_celula = g.id order by cp.codigo_int_celula asc");
			
			$valores_comisionables = 0;
			$valores_no_comisionables = 0;
			$total_final_anticipos = 0;
			$total_final_compra = 0;
			$total_final_venta = 0;
			$total_comision_venta = 0;
			$total_comisiones = 0;
			$total_volumen  =0;
			$total_negociacion = 0;
			$total_valores_no_comisionables = 0;
			
			$codigo_cliente = 0;
			$sql_cliente  = mysql_query("select pk_clientes_nit_cliente from cabpresup where codigo_presup = '$num_ppto'");
			while($row = mysql_fetch_array($sql_cliente)){
				$codigo_cliente = $row['pk_clientes_nit_cliente'];
			}
			
			while($row = mysql_fetch_array($sql_grupos)){
				$total_anticipos = 0;
				$total_1 = 0;
				$total_2 = 0;
				$com_venta = 0;
				$comision_total_x = 0;
				$negociacion = 0;
				
				$cod_grupo = $row['codigo'];
				$celula = $row['codigo_int_celula'];
				$imp.="<tr>
						
						<th>
							<img src = '../images/iconos/eliminar2.png' width = '15px' height ='15px' onclick ='eliminar_grupo_ppto($celula)'/>
						</th>
						
						<th align = 'left' class = 'grupos_ppto_general' colspan = '29' style = 'padding-left:10px;' id = 'celula_ppto$celula'ondblclick = 'modificar_grupo_celula_ppto($num_ppto,$cod_grupo,$celula)'>".$row['grupo']."</th>
					</tr>";
				$sql_item = mysql_query("select ip.editable,ip.asoc, ip.num_interno,i.id as codigo_item,ip.por_prov as volumen,i.name,ip.id, ip.dias, ip.q, ip.descripcion, ip.val_item, ip.fecha_ant, ip.por_ant, ip.cliente, ip.val_desde_item,
				ip.por_prov, p.nombre_comercial_proveedor,ip.iva_item,p.codigo_interno_proveedor
				from itempresup ip, item_tarifario i, proveedores p
				where i.id = ip.pk_item and ip.proveedor =  p.codigo_interno_proveedor and ip.ppto = '$num_ppto'  and ip.celula ='$celula'
				order by ip.id asc");
				$xclass = 1;
				$class = "";
				
				while($items = mysql_fetch_array($sql_item)){
					if($xclass == 1){
							$class = "oscuro_ppto_general";
							$xclass = 0;
						}else if($xclass == 0){
							$class = "claro_ppto_general";
							$xclass = 1;
						}
					
					$con_venta_momento = $this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']) - $this->calcular_d_q_val($items['val_item'],$items['dias'],$items['q']);
					$total_anticipos += $this->calcular_anticipo($items['por_ant'],$this->calcular_d_q_val($this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']));
					$total_final_anticipos +=$this->calcular_anticipo($items['por_ant'],$this->calcular_d_q_val($this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']));
					$total_1 += $this->calcular_d_q_val($this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']);
					$total_final_compra +=$this->calcular_d_q_val($this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']);
					$total_2 += $this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']);
					$total_final_venta +=$this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']);
					$com_venta += $this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']) - $this->calcular_d_q_val($items['val_item'],$items['dias'],$items['q']);
					$total_comision_venta +=$con_venta_momento;
					$comision_total_x +=$con_venta_momento + $this->calcular_d_q_val($items['val_item'] - $this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']);
					$total_comisiones +=$con_venta_momento + $this->calcular_d_q_val($items['val_item'] - $this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']);//$comision_total_x;
					$total_volumen+= $this->d_consultar_valor_volumen($items['codigo_item'],$items['val_item']);
					$negociacion += $this->calcular_d_q_val($items['val_item'] - $this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']);
					
					$val_con =0;
					if($con_venta_momento == 0 || $this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']) == 0){
						$val_con = 0;
					}else{
						$val_con = ($con_venta_momento/$this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']));
					}
					
					$tttt = 'input';
					
					$id_item = $items['id'];
					//En el campo de item ondblclick = 'modificar_informacion_item_ppto($id_item)'
					
					if($items['editable'] == 1){
						$imp.="<tr id ='espacio_item$id_item'>
						
						<td align = 'center'>
							
						</td>
						<td class = '$class' nowrap>".$items['name']."</td>
						<td class = '$class'  nowrap>".$this->asociado_sino($items['asoc'])."</td>
						<td class = '$class' >
							".nl2br($items['descripcion'])."
						</td>
						<td nowrap class = '$class' id = 'prove$id_item' ondblclick = 'input_proveedor($id_item,".$items['codigo_item'].")' width = '100%'>
							".$items['nombre_comercial_proveedor']."
						</td>
						<td class = '$class' id = 'q$id_item' align = 'center' ondblclick = 'update_q_item($id_item)' style = 'background-color:#88B4F5;'>
							".$items['q']."
							<span class = 'hidde' id = 'numero_real_cantidad$id_item' >".$items['q']."</span>
						</td>
						<td class = '$class' id = 'dias$id_item' align = 'center' ondblclick = 'update_dias_item($id_item)' style = 'background-color:#88B4F5;'>
							".$items['dias']."
							<span class = 'hidde' id = 'numero_real_dias$id_item' >".$items['dias']."</span>
						</td>
						<td class = 'separator'></td>
						<td class = '$class' >
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->calcular_anticipo($items['por_ant'],$this->calcular_d_q_val($this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q'])),2,'.',',')."</td>
								</tr>
							</table>
						</td>
						<td class = '$class' id = 'por_a$id_item' align = 'center' style = 'background-color:#88B4F5;'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>
										".$items['por_ant']."									
									</td>
									<td>%</td>
								</tr>
							</table>
						</td>
						<td class = '$class' nowrap id = 'fec$id_item' align = 'center'  style = 'background-color:#88B4F5;'>
							".$items['fecha_ant']."
						</td>
						<td class = 'separator'></td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right' >".number_format($this->consultar_valor_volumen($items['id'],$items['val_item']),2,'.',',')."</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->calcular_d_q_val($this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']),2,'.',',')."</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>
						
						<td class = '$class' style = 'background-color:#88B4F5;'>
							<table width = 'auto'>
								<tr>
									<td>$</td>
									<td align = 'right' id = 'item_val_tarifario$id_item' ondblclick = 'input_item_valor_unitario($id_item,".$items['codigo_item'].",".$items['val_item'].")'>
										".number_format($items['val_item'],2,'.',',')."
										<span class = 'hidde' id = 'h_item_val_tarifario$id_item' >".$items['val_item']."</span>
									</td>
								</tr>
							</table>
						</td>
						<td class = '$class' style = 'background-color:#88B4F5;'>
							<table width = 'auto'>
								<tr>
									<td align = 'right' id = 'iva_item_valor$id_item' >
										".$items['iva_item']."
									</td>
									<td>%</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->calcular_d_q_val($items['val_item'],$items['dias'],$items['q']),2,'.',',')."</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>
						
						
						
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right' >".number_format($this->calcular_d_q_val($items['val_item'] - $this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']),2,'.',',')."<span class = 'hidde' id ='h_item_val_tarifario$id_item' >".$items['val_item']."</span></td>
								</tr>
							</table>
						</td>
						<td class = '$class' style = 'background-color:#88B4F5;'>
							<table width = '100%'>
								<tr>
									<td align = 'right' id = 'volumen_item$id_item' ondblclick = 'update_volumen_item($id_item,".$items['volumen'].",$num_ppto)'>
										".number_format($items['volumen'],2,'.',',')."
										<span class = 'hidde' id = 'valor_volumen_item_valor$id_item' >".$items['volumen']."</span>
									</td>
									<td>%</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>
						
						<td class = '$class' style = 'background-color:#88B4F5;'>
							<table width = '100%' >
								<tr>
									<td>$</td>
									<td align = 'right'>
										<span id = 'val_cliente$id_item' class = 'hidde'>".$items['cliente']."</span>
										".($items['cliente'])."
										<span class = 'hidde' id = 'valor_cobrar_cliente_real$id_item' >".$items['cliente']."</span>
									</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']),2,'.',',')."</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($con_venta_momento)."</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>".number_format(($val_con)*100)."</td>
									<td>%</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($con_venta_momento + $this->calcular_d_q_val($items['val_item'] - $this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']),2,'.',',')."</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>".number_format((($val_con)*100) + $items['volumen'],2,'.',',')."</td>
									<td>%</td>
								</tr>
							</table>
						</td>
						<td>
							
						</td>
					</tr>";
					}else{
						$imp.="<tr id ='espacio_item$id_item'>
						
						<td align = 'center'>
							<img src = '../images/iconos/eliminar2.png' width = '15px' height ='15px' onclick ='eliminar_item_ppto($id_item)'/>
						</td>
						<td class = '$class' nowrap>".$items['name']."</td>
						<td class = '$class'  nowrap>".$this->asociado_sino($items['asoc'])."</td>
						<td class = '$class' id = 'desc$id_item' ondblclick = 'update_desc_item($id_item)'>
							<textarea class = 'textarea_ppto' cols = '30' rows = '4' id = 'textarea_descripcion$id_item'>".$items['descripcion']."</textarea>
						</td>
						<td nowrap class = '$class' id = 'prove$id_item' ondblclick = 'input_proveedor($id_item,".$items['codigo_item'].")' width = '100%'>
							<select class = 'inputs_ppto' id = 'provee$id_item' style = 'width:280px'><option selected nowrap value = '".$items['codigo_interno_proveedor']."' >".$items['nombre_comercial_proveedor']."</select>
						</td>
						<td class = '$class' id = 'q$id_item' align = 'center' ondblclick = 'update_q_item($id_item)' style = 'background-color:#88B4F5;'>
							<input class = 'inputs_ppto'type = 'text' value = '".$items['q']."' id = 'input_cantidad$id_item' onkeyup = 'formatear_valor_q(event,$id_item);'/>
							<span class = 'hidde' id = 'numero_real_cantidad$id_item' >".$items['q']."</span>
						</td>
						<td class = '$class' id = 'dias$id_item' align = 'center' ondblclick = 'update_dias_item($id_item)' style = 'background-color:#88B4F5;'>
							<input class = 'inputs_ppto'type = 'text' value = '".$items['dias']."' id = 'input_dias$id_item' onkeyup = 'formatear_valor_d(event,$id_item);'/>
							<span class = 'hidde' id = 'numero_real_dias$id_item' >".$items['dias']."</span>
						</td>
						<td class = 'separator'></td>
						<td class = '$class' >
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->calcular_anticipo($items['por_ant'],$this->calcular_d_q_val($this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q'])),2,'.',',')."</td>
								</tr>
							</table>
						</td>
						<td class = '$class' id = 'por_a$id_item' align = 'center' style = 'background-color:#88B4F5;'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>
										<input type = 'text' class = 'inputs_ppto' id = 'porant$id_item' value = '".$items['por_ant']."'/>
									
									</td>
									<td>%</td>
								</tr>
							</table>
						</td>
						<td class = '$class' nowrap id = 'fec$id_item' align = 'center'  style = 'background-color:#88B4F5;'>
							<input type = 'text' class = 'inputs_ppto' value ='".$items['fecha_ant']."' onclick = 'ponerfecha($id_item)' id = 'fecha$id_item' name = 'fecha$id_item'/>
						</td>
						<td class = 'separator'></td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right' >".number_format($this->consultar_valor_volumen($items['id'],$items['val_item']),2,'.',',')."</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->calcular_d_q_val($this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']),2,'.',',')."</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>
						
						<td class = '$class' style = 'background-color:#88B4F5;'>
							<table width = 'auto'>
								<tr>
									<td>$</td>
									<td align = 'right' id = 'item_val_tarifario$id_item' ondblclick = 'input_item_valor_unitario($id_item,".$items['codigo_item'].",".$items['val_item'].")'>
										<input type = 'text' value = '".number_format($items['val_item'],2,'.',',')."' class = 'inputs_ppto' id = 'valor_unitario_venta_ppto$id_item'onkeyup = 'formatear_valor_v_unitario(event,$id_item);'/>
										<span class = 'hidde' id = 'h_item_val_tarifario$id_item' >".$items['val_item']."</span>
									</td>
								</tr>
							</table>
						</td>
						<td class = '$class' style = 'background-color:#88B4F5;'>
							<table width = 'auto'>
								<tr>
									<td align = 'right' id = 'iva_item_valor$id_item' >
										<input type = 'text' value = '".$items['iva_item']."' class = 'inputs_ppto' id = 'iva_item_valor_item$id_item'/>
									</td>
									<td>%</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->calcular_d_q_val($items['val_item'],$items['dias'],$items['q']),2,'.',',')."</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>
						
						
						
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right' >".number_format($this->calcular_d_q_val($items['val_item'] - $this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']),2,'.',',')."<span class = 'hidde' id ='h_item_val_tarifario$id_item' >".$items['val_item']."</span></td>
								</tr>
							</table>
						</td>
						<td class = '$class' style = 'background-color:#88B4F5;'>
							<table width = '100%'>
								<tr>
									<td align = 'right' id = 'volumen_item$id_item' ondblclick = 'update_volumen_item($id_item,".$items['volumen'].",$num_ppto)'>
										<input type = 'text' value = '".number_format($items['volumen'],2,'.',',')."'  class = 'inputs_ppto' id = 'valor_volumen_ppto_valor$id_item'onkeyup = 'formatear_valor_v_volumen(event,$id_item);'/>
										<span class = 'hidde' id = 'valor_volumen_item_valor$id_item' >".$items['volumen']."</span>
									</td>
									<td>%</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>
						
						<td class = '$class' ondblclick = 'cambiar_valor_cliente($id_item)' id = 'celda_cliente$id_item' style = 'background-color:#88B4F5;'>
							<table width = '100%' >
								<tr>
									<td>$</td>
									<td align = 'right'>
										<span id = 'val_cliente$id_item' class = 'hidde'>".$items['cliente']."</span>
										<input type = 'text' value = '".($items['cliente'])."' class = 'inputs_ppto' id = 'valor_cobrar_cliente$id_item'onkeyup = 'formatear_valor_v_externa(event,$id_item);'/>
										<span class = 'hidde' id = 'valor_cobrar_cliente_real$id_item' >".$items['cliente']."</span>
									</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']),2,'.',',')."</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($con_venta_momento)."</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>".number_format(($val_con)*100)."</td>
									<td>%</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($con_venta_momento + $this->calcular_d_q_val($items['val_item'] - $this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']),2,'.',',')."</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>".number_format((($val_con)*100) + $items['volumen'],2,'.',',')."</td>
									<td>%</td>
								</tr>
							</table>
						</td>
						<td>
							<a href = '#'><img src = '../images/iconos/ok_verde.png' width = '30px' onclick = 'guardar_cambios_items($id_item)'  	/></a>
						</td>
					</tr>";
					}
					
					
				}
				if($xclass == 1){
					$class = "oscuro_ppto_general";
					$xclass = 0;
				}else if($xclass == 0){
					$class = "claro_ppto_general";
					$xclass = 1;
				}
				for($i = 0;$i < 1;$i++){
					$imp.="<tr >
						<td ></td>
						<td style = 'background-color:white;' id = '$celula-item$i' class = 'mano'ondblclick = 'listado_items_grupo($cod_grupo,$i,$celula)'>ITEM</td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td class = 'separator'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td class = 'separator'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td class = 'separator'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td class = 'separator'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td class = 'separator'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td class = 'separator'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td class = 'separator'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
					</tr>";
				}
			
				$imp.="<tr>
					<td ></td>
					<td ></td>
					<td ></td>
					<td  ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($total_anticipos,2,'.',',')."</td>
							</tr>
						</table>
					</td>
					<td ></td>
					<td ></td>
					<td></td>
					<td></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($total_1,2,'.',',')."</td>
							</tr>
						</table>
					</td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td >
					</td>
					<td ></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($negociacion,2,'.',',')."</td>
							</tr>
						</table>
					</td>
					
					<td >
					</td>
					<td ></td>
					<td ></td>
					
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($total_2,2,'.',',')."</td>
							</tr>
						</table>
					</td>
					<td ></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($com_venta,2,'.',',')."</td>
							</tr>
						</table>
					</td>
					<td></td>
					<td class = 'separator'></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($comision_total_x,2,'.',',')."</td>
							</tr>
						</table>
					</td>
					<td ></td>
				</tr>";
				$total_1 = 0;
				$total_2 = 0;
				$com_venta = 0;
				$total_anticipos = 0;
				
				$imp.="<tr><td></br></td></tr>";
			}
			
			$sql_grupos = mysql_query("select cp.nombre_celula, cp.codigo_int_celula
			from cecula_ppto_interno cp
			where cp.pk_ppto_interno = '$num_ppto' and cp.nombre_celula = 'VALORES NO COMISIONABLES'");
			
			
			while($row = mysql_fetch_array($sql_grupos)){
				$total_1 = 0;
				$total_2 = 0;
				$total_anticipos = 0;
				$com_venta = 0;
				$vol = 0;
				$comision_total_x = 0;
				$negociacion = 0;
				$celula = $row['codigo_int_celula'];
				$imp.="<tr>
						<th></th>
						<th align = 'left' class = 'grupos_ppto_general' colspan = '29' style = 'padding-left:10px;'>".$row['nombre_celula']."</th>
					</tr>";
				$sql_item = mysql_query("select ip.asoc, ip.num_interno,i.id as codigo_item,i.volumen,i.name,ip.id, ip.dias, ip.q, ip.descripcion, ip.val_item, ip.fecha_ant, ip.por_ant, ip.cliente, ip.val_desde_item,
				ip.por_prov, p.nombre_comercial_proveedor,ip.iva_item,p.codigo_interno_proveedor,ip.editable
				from itempresup ip, item_tarifario i, proveedores p
				where i.id = ip.pk_item and ip.proveedor =  p.codigo_interno_proveedor and ip.ppto = '$num_ppto'  and ip.celula ='$celula' order by i.id asc");
				$class = "";
				$xclass = 1;
				while($items = mysql_fetch_array($sql_item)){
					if($xclass == 1){
							$class = "oscuro_ppto_general";
							$xclass = 0;
						}else if($xclass == 0){
							$class = "claro_ppto_general";
							$xclass = 1;
						}
					$total_anticipos += $this->calcular_anticipo($items['por_ant'],$this->calcular_d_q_val($this->consultar_valor_volumen($items['codigo_item'],$items['val_item']),$items['dias'],$items['q']));				
					$total_1 += $this->calcular_d_q_val($this->consultar_valor_volumen($items['codigo_item'],$items['val_item']),$items['dias'],$items['q']);
					$total_2 += $this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']);
					$total_valores_no_comisionables +=$this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']);
					
					$com_venta += $this->calcular_comision_dinero($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item']);
					//$comision_total_x +=$this->comision_total($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item']);
					
					
					
					
					//$total_volumen += $this->consultar_valor_volumen($items['codigo_item'],$items['val_item']);
					$id_item = $items['id'];
					
					
					$con_venta_momento = $this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']) - $this->calcular_d_q_val($items['val_item'],$items['dias'],$items['q']);
					
					$comision_total_x +=$con_venta_momento + $this->calcular_d_q_val($items['val_item'] - $this->consultar_valor_volumen($items['codigo_item'],$items['val_item']),$items['dias'],$items['q']);
					$negociacion += $this->calcular_d_q_val($items['val_item'] - $this->consultar_valor_volumen($items['codigo_item'],$items['val_item']),$items['dias'],$items['q']);
					
					$total_comisiones +=$this->comision_total($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item']);
					$total_comision_venta +=$this->comision_total($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item']);
					
					$total_final_compra +=$this->calcular_d_q_val($this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']);
					$total_final_anticipos +=$this->calcular_anticipo($items['por_ant'],$this->calcular_d_q_val($this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']));
					
					$val_con =0;
					if($con_venta_momento == 0 || $this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']) == 0 ){
						$val_con = 0;
					}else{
						$val_con = ($con_venta_momento/$this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']));
					}
					
					
					$valores_no_comisionables +=$total_2;
					if($items['editable'] == 1){
						$imp.="<tr>
							<td align = 'center'>
								<img src = '../images/iconos/eliminar2.png' width = '15px' height ='15px' onclick ='eliminar_item_ppto($id_item)'/>
							</td>
							<td class = '$class'  nowrap>".$items['num_interno']." - ".$items['name']."</td>
							<td class = '$class' nowrap>".$this->asociado_sino($items['asoc'])."</td>
							<td class = '$class' width = '40%'>
								".nl2br($items['descripcion'])."
							</td>
							<td nowrap class = '$class'  width = '100%'>
								".$items['nombre_comercial_proveedor']."
							</td>
							<td class = '$class' style = 'background-color:#88B4F5;'>
								".$items['q']."
							</td>
							<td class = '$class'  style = 'background-color:#88B4F5;'>
								".$items['dias']."
							</td>
							<td class = 'separator'></td>
							<td class = '$class' >
								<table width = '100%'>
									<tr>
										<td>$</td>
										<td align = 'right'>".number_format($this->calcular_anticipo($items['por_ant'],$this->calcular_d_q_val($this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q'])),2,'.',',')."</td>
									</tr>
								</table>
							</td>
							<td class = '$class' id = 'por_a$id_item' align = 'center' style = 'background-color:#88B4F5;'>
								<table width = '100%'>
									<tr>
										<td align = 'right'>
											".$items['por_ant']."										
										</td>
										<td>%</td>
									</tr>
								</table>
							</td>
							<td class = '$class' nowrap  align = 'center'  style = 'background-color:#88B4F5;'>
								".$items['fecha_ant']."
							</td>
							<td class = 'separator'></td>
							<td class = '$class'>
								<table width = '100%'>
									<tr>
										<td>$</td>
										<td align = 'right' >".number_format($this->consultar_valor_volumen($items['id'],$items['val_item']),2,'.',',')."</td>
									</tr>
								</table>
							</td>
							<td class = '$class'>
								<table width = '100%'>
									<tr>
										<td>$</td>
										<td align = 'right'>".number_format($this->calcular_d_q_val($this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']),2,'.',',')."</td>
									</tr>
								</table>
							</td>
							<td class = 'separator'></td>
							
							<td class = '$class' style = 'background-color:#88B4F5;'>
								<table width = 'auto'>
									<tr>
										<td>$</td>
										<td align = 'right' id = 'item_val_tarifario$id_item' ondblclick = 'input_item_valor_unitario($id_item,".$items['codigo_item'].",".$items['val_item'].")'>
											".number_format($items['val_item'],2,'.',',')."
											
										</td>
									</tr>
								</table>
							</td>
							<td class = '$class' style = 'background-color:#88B4F5;'>
								<table width = 'auto'>
									<tr>
										<td align = 'right' id = 'iva_item_valor$id_item' >
											".$items['iva_item']."
										</td>
										<td>%</td>
									</tr>
								</table>
							</td>
							<td class = '$class'>
								<table width = '100%'>
									<tr>
										<td>$</td>
										<td align = 'right'>".number_format($this->calcular_d_q_val($items['val_item'],$items['dias'],$items['q']),2,'.',',')."</td>
									</tr>
								</table>
							</td>
							<td class = 'separator'></td>
							
							
							
							<td class = '$class'>
								<table width = '100%'>
									<tr>
										<td>$</td>
										<td align = 'right' >".number_format($this->calcular_d_q_val($items['val_item'] - $this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']),2,'.',',')."<span class = 'hidde' id ='h_item_val_tarifario$id_item' >".$items['val_item']."</span></td>
									</tr>
								</table>
							</td>
							<td class = '$class' style = 'background-color:#88B4F5;'>
								<table width = '100%'>
									<tr>
										<td align = 'right' id = 'volumen_item$id_item' ondblclick = 'update_volumen_item($id_item,".$items['volumen'].",$num_ppto)'>
											".number_format($items['volumen'],2,'.',',')."
											
										</td>
										<td>%</td>
									</tr>
								</table>
							</td>
							<td class = 'separator'></td>
							
							<td class = '$class' ondblclick = 'cambiar_valor_cliente($id_item)' id = 'celda_cliente$id_item' style = 'background-color:#88B4F5;'>
								<table width = '100%' >
									<tr>
										<td>$</td>
										<td align = 'right'>
											".$items['cliente']."
										</td>
									</tr>
								</table>
							</td>
							<td class = '$class'>
								<table width = '100%'>
									<tr>
										<td>$</td>
										<td align = 'right'>".number_format($this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']),2,'.',',')."</td>
									</tr>
								</table>
							</td>
							<td class = 'separator'></td>
							<td class = '$class'>
								<table width = '100%'>
									<tr>
										<td>$</td>
										<td align = 'right'>".number_format($con_venta_momento)."</td>
									</tr>
								</table>
							</td>
							<td class = '$class'>
								<table width = '100%'>
									<tr>
										<td align = 'right'>".number_format(($val_con)*100)."</td>
										<td>%</td>
									</tr>
								</table>
							</td>
							<td class = 'separator'></td>
							<td class = '$class'>
								<table width = '100%'>
									<tr>
										<td>$</td>
										<td align = 'right'>".number_format($con_venta_momento + $this->calcular_d_q_val($items['val_item'] - $this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']),2,'.',',')."</td>
									</tr>
								</table>
							</td>
							<td class = '$class'>
								<table width = '100%'>
									<tr>
										<td align = 'right'>".number_format((($val_con)*100) + $items['volumen'],2,'.',',')."</td>
										<td>%</td>
									</tr>
								</table>
							</td>
							<td>
								
							</td>
						</tr>";
					}else{
						$imp.="<tr>
							<td align = 'center'>
								<img src = '../images/iconos/eliminar2.png' width = '15px' height ='15px' onclick ='eliminar_item_ppto($id_item)'/>
							</td>
							<td class = '$class'  nowrap>".$items['num_interno']." - ".$items['name']."</td>
							<td class = '$class' nowrap>".$this->asociado_sino($items['asoc'])."</td>
							<td class = '$class' id = 'desc$id_item' ondblclick = 'update_desc_item($id_item)'>
								<textarea class = 'textarea_ppto' cols = '30' rows = '4' id = 'textarea_descripcion$id_item'>".$items['descripcion']."</textarea>
							</td>
							<td nowrap class = '$class' id = 'prove$id_item' ondblclick = 'input_proveedor($id_item,".$items['codigo_item'].")' width = '100%'>
								<select class = 'inputs_ppto' id = 'provee$id_item' style = 'width:280px'><option selected nowrap value = '".$items['codigo_interno_proveedor']."' >".$items['nombre_comercial_proveedor']."</select>
							</td>
							<td class = '$class' id = 'q$id_item' align = 'center' ondblclick = 'update_q_item($id_item)' style = 'background-color:#88B4F5;'>
								<input class = 'inputs_ppto'type = 'text' value = '".$items['q']."' id = 'input_cantidad$id_item' onkeyup = 'formatear_valor_q(event,$id_item);'/>
								<span class = 'hidde' id = 'numero_real_cantidad$id_item' >".$items['q']."</span>
							</td>
							<td class = '$class' id = 'dias$id_item' align = 'center' ondblclick = 'update_dias_item($id_item)' style = 'background-color:#88B4F5;'>
								<input class = 'inputs_ppto'type = 'text' value = '".$items['dias']."' id = 'input_dias$id_item' onkeyup = 'formatear_valor_d(event,$id_item);'/>
								<span class = 'hidde' id = 'numero_real_dias$id_item' >".$items['dias']."</span>
							</td>
							<td class = 'separator'></td>
							<td class = '$class' >
								<table width = '100%'>
									<tr>
										<td>$</td>
										<td align = 'right'>".number_format($this->calcular_anticipo($items['por_ant'],$this->calcular_d_q_val($this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q'])),2,'.',',')."</td>
									</tr>
								</table>
							</td>
							<td class = '$class' id = 'por_a$id_item' align = 'center' style = 'background-color:#88B4F5;'>
								<table width = '100%'>
									<tr>
										<td align = 'right'>
											<input type = 'text' class = 'inputs_ppto' id = 'porant$id_item' value = '".$items['por_ant']."'/>
										
										</td>
										<td>%</td>
									</tr>
								</table>
							</td>
							<td class = '$class' nowrap id = 'fec$id_item' align = 'center'  style = 'background-color:#88B4F5;'>
								<input type = 'text' class = 'inputs_ppto' value ='".$items['fecha_ant']."' onclick = 'ponerfecha($id_item)' id = 'fecha$id_item' name = 'fecha$id_item'/>
							</td>
							<td class = 'separator'></td>
							<td class = '$class'>
								<table width = '100%'>
									<tr>
										<td>$</td>
										<td align = 'right' >".number_format($this->consultar_valor_volumen($items['id'],$items['val_item']),2,'.',',')."</td>
									</tr>
								</table>
							</td>
							<td class = '$class'>
								<table width = '100%'>
									<tr>
										<td>$</td>
										<td align = 'right'>".number_format($this->calcular_d_q_val($this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']),2,'.',',')."</td>
									</tr>
								</table>
							</td>
							<td class = 'separator'></td>
							
							<td class = '$class' style = 'background-color:#88B4F5;'>
								<table width = 'auto'>
									<tr>
										<td>$</td>
										<td align = 'right' id = 'item_val_tarifario$id_item' ondblclick = 'input_item_valor_unitario($id_item,".$items['codigo_item'].",".$items['val_item'].")'>
											<input type = 'text' value = '".number_format($items['val_item'],2,'.',',')."' class = 'inputs_ppto' id = 'valor_unitario_venta_ppto$id_item'onkeyup = 'formatear_valor_v_unitario(event,$id_item);'/>
											<span class = 'hidde' id = 'h_item_val_tarifario$id_item' >".$items['val_item']."</span>
										</td>
									</tr>
								</table>
							</td>
							<td class = '$class' style = 'background-color:#88B4F5;'>
								<table width = 'auto'>
									<tr>
										<td align = 'right' id = 'iva_item_valor$id_item' >
											<input type = 'text' value = '".$items['iva_item']."' class = 'inputs_ppto' id = 'iva_item_valor_item$id_item'/>
										</td>
										<td>%</td>
									</tr>
								</table>
							</td>
							<td class = '$class'>
								<table width = '100%'>
									<tr>
										<td>$</td>
										<td align = 'right'>".number_format($this->calcular_d_q_val($items['val_item'],$items['dias'],$items['q']),2,'.',',')."</td>
									</tr>
								</table>
							</td>
							<td class = 'separator'></td>
							
							
							
							<td class = '$class'>
								<table width = '100%'>
									<tr>
										<td>$</td>
										<td align = 'right' >".number_format($this->calcular_d_q_val($items['val_item'] - $this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']),2,'.',',')."<span class = 'hidde' id ='h_item_val_tarifario$id_item' >".$items['val_item']."</span></td>
									</tr>
								</table>
							</td>
							<td class = '$class' style = 'background-color:#88B4F5;'>
								<table width = '100%'>
									<tr>
										<td align = 'right' id = 'volumen_item$id_item' ondblclick = 'update_volumen_item($id_item,".$items['volumen'].",$num_ppto)'>
											<input type = 'text' value = '".number_format($items['volumen'],2,'.',',')."'  class = 'inputs_ppto' id = 'valor_volumen_ppto_valor$id_item'onkeyup = 'formatear_valor_v_volumen(event,$id_item);'/>
											<span class = 'hidde' id = 'valor_volumen_item_valor$id_item' >".$items['volumen']."</span>
										</td>
										<td>%</td>
									</tr>
								</table>
							</td>
							<td class = 'separator'></td>
							
							<td class = '$class' ondblclick = 'cambiar_valor_cliente($id_item)' id = 'celda_cliente$id_item' style = 'background-color:#88B4F5;'>
								<table width = '100%' >
									<tr>
										<td>$</td>
										<td align = 'right'>
											<span id = 'val_cliente$id_item' class = 'hidde'>".$items['cliente']."</span>
											<input type = 'text' value = '".($items['cliente'])."' class = 'inputs_ppto' id = 'valor_cobrar_cliente$id_item'onkeyup = 'formatear_valor_v_externa(event,$id_item);'/>
											<span class = 'hidde' id = 'valor_cobrar_cliente_real$id_item' >".$items['cliente']."</span>
										</td>
									</tr>
								</table>
							</td>
							<td class = '$class'>
								<table width = '100%'>
									<tr>
										<td>$</td>
										<td align = 'right'>".number_format($this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']),2,'.',',')."</td>
									</tr>
								</table>
							</td>
							<td class = 'separator'></td>
							<td class = '$class'>
								<table width = '100%'>
									<tr>
										<td>$</td>
										<td align = 'right'>".number_format($con_venta_momento)."</td>
									</tr>
								</table>
							</td>
							<td class = '$class'>
								<table width = '100%'>
									<tr>
										<td align = 'right'>".number_format(($val_con)*100)."</td>
										<td>%</td>
									</tr>
								</table>
							</td>
							<td class = 'separator'></td>
							<td class = '$class'>
								<table width = '100%'>
									<tr>
										<td>$</td>
										<td align = 'right'>".number_format($con_venta_momento + $this->calcular_d_q_val($items['val_item'] - $this->consultar_valor_volumen($items['id'],$items['val_item']),$items['dias'],$items['q']),2,'.',',')."</td>
									</tr>
								</table>
							</td>
							<td class = '$class'>
								<table width = '100%'>
									<tr>
										<td align = 'right'>".number_format((($val_con)*100) + $items['volumen'],2,'.',',')."</td>
										<td>%</td>
									</tr>
								</table>
							</td>
							<td>
								<a href = '#'><img src = '../images/iconos/ok_verde.png' width = '30px' onclick = 'guardar_cambios_items($id_item)'  	/></a>
							</td>
						</tr>";
					}
					
				}
				
				for($i = 0;$i < 1;$i++){
					$imp.="<tr >
						<td ></td>
						<td style = 'background-color:white;' id = '$celula-item$i' class = 'mano'ondblclick = 'listado_items_grupo($celula,$i,$celula)'>ITEM</td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td class = 'separator'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td class = 'separator'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td class = 'separator'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td class = 'separator'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td class = 'separator'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td class = 'separator'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td class = 'separator'></td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
					</tr>";
				}
				
				$imp.="<tr>
					<td ></td>
					<td ></td>
					<td ></td>
					<td  ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($total_anticipos,2,'.',',')."</td>
							</tr>
						</table>
					</td>
					<td ></td>
					<td ></td>
					<td></td>
					<td></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($total_1,2,'.',',')."</td>
							</tr>
						</table>
					</td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td >
						
					</td>
					<td ></td>
					<td ></td>
					
					<td >
						
					</td>
					<td ></td>
					<td ></td>
					
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($total_2,2,'.',',')."</td>
							</tr>
						</table>
					</td>
					<td ></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($com_venta,2,'.',',')."</td>
							</tr>
						</table>
					</td>
					<td ></td>
					<td class = 'separator'></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($comision_total_x,2,'.',',')."</td>
							</tr>
						</table>
					</td>
					<td ></td>
				</tr>";
				$imp.="<tr><td></br></td></tr>";
			}
			
			$imp.="<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td colspan = '2' align = 'right' class = 'grupos_ppto_general' nowrap>TOTAL ANTICIPOS</td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($total_final_anticipos,2,'.',',')."</td>
							</tr>
						</table>
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td nowrap align = 'right' class = 'grupos_ppto_general'>TOTAL A PAGAR</td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($total_final_compra,2,'.',',')."</td>
							</tr>
						</table>
					</td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td >
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td colspan = '2' class = 'grupos_ppto_general' align = 'right'>TOTAL VENTA</td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($total_final_venta + $total_valores_no_comisionables,2,'.',',')."</td>
							</tr>
						</table>
					</td>
					<td ></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($total_comision_venta,2,'.',',')."</td>
							</tr>
						</table>
					</td>
					<td ></td>
					<td class = 'separator'></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($total_comisiones,2,'.',',')."</td>
							</tr>
						</table>
					</td>
					<td ></td>
				</tr>
				<tr><td></br></td></tr>
				";
				
			for($i = 0;$i< 1;$i++){
				$imp.="<tr>
					<td></td>
					<td align = 'center' id = 'grupon$i'class = 'grupos_ppto_general mano' colspan = '29' ondblclick = 'listar_grupos_tarifario($i)'>NUEVO GRUPO</td>
				</tr>";
			}
			$imp.="</tbody></table>
				
			</div>";
			
			
			
			$costo_ejecucion = $total_final_venta + $total_2;
			$sql_adicionales = mysql_query("select imprevistos, gastos_admin from cabpresup where codigo_presup = '$num_ppto'");
			$impre = 0;
			$gastos = 0;
			while($rrr = mysql_fetch_array($sql_adicionales)){
				$impre = $rrr['imprevistos'];
				$gastos = $rrr['gastos_admin'];
			}
			$imprevisto_final = ($total_final_venta*($impre/100));
			$gastos_final = ($total_final_venta*($gastos/100));
			
			$sql = mysql_query("select cc.uaai,cc.tipo, p.pk_clientes_nit_cliente 
			from cabpresup p, condiciones_cliente cc
			where p.codigo_presup = '$num_ppto' and p.pk_clientes_nit_cliente = cc.cliente");
			$uaai = "";
			while($ro = mysql_fetch_array($sql)){
				$uaai = (100-$ro['uaai'])/100;
			}
			
			$total_actividad = $this->comision_cliente($num_ppto,$total_final_venta) + $costo_ejecucion + 
			$imprevisto_final + $gastos_final;
			$total_comisiones_div_total_actividad = 0;
			if($total_actividad == 0){
				$total_comisiones_div_total_actividad = 0;
			}else{
				$total_comisiones_div_total_actividad = ((($total_comisiones)/$total_actividad)*100);
			}
			
			$xx_final_total_venta = 0;
			if($total_final_venta == 0){
				$xx_final_total_venta = 0;
			}else{
				$xx_final_total_venta = (($total_comisiones/$total_final_venta)*100);
			}
			
			/*
				<table width = '100%'>
					<tr>
						<td align = 'center' id = 'indicador_posicion' onclick = 'mostrar_ocultar_resumen_ppto()'>^</td>
					</tr>
				</table>
			*/
			$total_actividad_final_resumen = $total_final_venta + $valores_no_comisionables +  $this->comision_cliente($num_ppto,$total_final_venta) + 
														$this->gastos_administrativos_valor($num_ppto,$total_final_venta) + $this->impresvistos_valor($num_ppto,$total_final_venta);
			$total_utilidad_comercial_final = $this->comision_cliente($num_ppto,$total_final_venta) + $total_comisiones;
			$valor_total_volumen_f = 0;
			if( $total_actividad_final_resumen == 0){
				$valor_total_volumen_f = 0;
			}else{
				$valor_total_volumen_f = $total_utilidad_comercial_final / $total_actividad_final_resumen;
			}
			$valor_total_sin_iva_f = $total_final_venta + $total_valores_no_comisionables +  $this->comision_cliente($num_ppto,$total_final_venta) + $this->gastos_administrativos_valor($num_ppto,$total_final_venta) + $this->impresvistos_valor($num_ppto,$total_final_venta);
			$ica_valor_total = 0;
			if($valor_total_sin_iva_f == 0){
				$ica_valor_total = 0;
			}else{
				$ica_valor_total =  $this->valor_ica_empresa($num_ppto,14,$valor_total_sin_iva_f);
			}
			$cuatro_valor_total = 0;
			if($valor_total_sin_iva_f == 0){
				$cuatro_valor_total = 0;
			}else{
				$cuatro_valor_total = ($valor_total_sin_iva_f*4)/1000;
			}
			$impuestos_adicionales_condicion_cliente = $this->valor_impuestos_adicionales($num_ppto,$valor_total_sin_iva_f,$codigo_cliente,$this->comision_cliente($num_ppto,$total_final_venta));
			$cheques_tranferencias_valor = $this->valor_cheques_empresa($num_ppto,16);
			$total_impuestos_f = $this->valor_retencion_fuente_empresa($num_ppto,9,$valor_total_sin_iva_f,$codigo_cliente,($total_final_venta + $total_valores_no_comisionables)) + $ica_valor_total + $this->valor_cree_empresa($num_ppto,11,$valor_total_sin_iva_f) + $cuatro_valor_total + $cheques_tranferencias_valor +
			$this->factoring_imp_valor($num_ppto,$valor_total_sin_iva_f) + $this->ant_int_bancarios_imp_valor($num_ppto,$total_final_anticipos) + $this->pro_int_bancarios_imp_valor($num_ppto,$valor_total_sin_iva_f) + 
			$this->pro_int_ter_imp_valor($num_ppto,$valor_total_sin_iva_f) + $impuestos_adicionales_condicion_cliente;
			$utilidad_total_total = ($this->comision_cliente($num_ppto,$total_final_venta) + $total_comisiones) - $total_impuestos_f;
			$porcentaje_utilidad_total = 0;
			if($valor_total_sin_iva_f == 0 || $utilidad_total_total == 0){
				$porcentaje_utilidad_total = 0;
			}else{
				$porcentaje_utilidad_total = $utilidad_total_total / $valor_total_sin_iva_f;
			}
			$imp.="<div id = 'contenedor_resumen_ppto' >
					<table width = '100%'>
						<tr>
							<td colspan = '3' align = 'center'>
								<div class = 'triangulo_inf' onclick = 'ocultar_resumen_ppto()' id = 'opcion_para_ocultar_resumen'></div>
							</td>
						</tr>
						<tr class = 'ocultar_opciones_ppto'>
							<td style = 'vertical-align:text-top;'>
								<table class = 'tablas_muestra_datos_tablas'>
									<tr>
										<td>VALORES COMISIONALES</td>
										<td></td>
										<td>
											<span  id = 'vl_o' class = 'hidde'>".($total_final_venta)."</span>
											<table width = '100%' class ='sin_color'>
												<tr>
													<td align = 'left'>$</td>
													<td align = 'right'><span  id = 'vl'>".number_format($total_final_venta)."</span></td>
												</tr>
											</table>											
										</td>
									</tr>
									<tr>
										<td>VALORES NO COMISIONALES</td>
										<td></td>
										<td>
											<span = id = 'vnl_o' class = 'hidde'>".($valores_no_comisionables)."</span>
											<table width = '100%' class ='sin_color'>
												<tr>
													<td align = 'left'>$</td>
													<td align = 'right'><span = id = 'vnl'>".number_format($total_valores_no_comisionables)."</span></td>
												</tr>
											</table>	
											
										</td>
									</tr>
									<tr>
										<td>TOTAL COSTOS DE EJECUCION</td>
										<td></td>
										<td>
											<span = id = 'tce_o' class = 'hidde'>".($total_final_venta + $total_valores_no_comisionables)."</span>
											<table width = '100%' class ='sin_color'>
												<tr>
													<td align = 'left'>$</td>
													<td align = 'right'><span = id = 'tce'>".number_format($total_final_venta + $total_valores_no_comisionables)."</span></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td>IMPREVISTOS</td>
										".$this->impresvistos($num_ppto,$total_final_venta)."
									</tr>
									<tr>
										<td>GASTOS ADMINISTRATIVOS</td>
										".$this->gastos_administrativos($num_ppto,$total_final_venta)."
									</tr>
									<tr>
										<td>SERVICIOS DE IMPLEMENTACION </br>ESTRATEGIA Y DESARROLLO</td>
										<td>".$this->comision_cliente_valor($num_ppto,$total_final_venta)." %</td>
										<td>
											<table width = '100%' class ='sin_color'>
												<tr>
													<td align = 'left'>$</td>
													<td align = 'right'>".number_format($this->comision_cliente($num_ppto,$total_final_venta))."</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td>TOTAL ACTIVIDAD</td>
										<td></td>
										<td>
											<table width = '100%' class ='sin_color'>
												<tr>
													<td align = 'left'>$</td>
													<td align = 'right'>".number_format($total_final_venta + $total_valores_no_comisionables +  $this->comision_cliente($num_ppto,$total_final_venta) + 
													$this->gastos_administrativos_valor($num_ppto,$total_final_venta) + $this->impresvistos_valor($num_ppto,$total_final_venta))."</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
							<td style = 'vertical-align:text-top;'>
								<table class = 'tablas_muestra_datos_tablas'>
										<tr>
											<td>TOTAL COMISIONES POR DESCUENTOS</td>
											<td>
												<table width = '100%' class ='sin_color'>
													<tr>
														<td align = 'left'>$</td>
														<td align = 'right'>".number_format($total_comisiones)."</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>COMISION AGENCIA UAAI</td>
											<td>
												<table width = '100%' class = 'sin_color'>
													<tr>
														<td align = 'left'>$</td>
														<td align = 'right'>".number_format($this->comision_cliente($num_ppto,$total_final_venta))."</td>
													</tr>
												</table>
											</td>
										</tr>
										
										<tr>
											<td>UTILIDAD COMERCIAL</td>
											<td>
												<table width = '100%' class = 'sin_color'>
													<tr>
														<td align = 'left'>$</td>
														<td align = 'right'>".number_format($this->comision_cliente($num_ppto,$total_final_venta) + $total_comisiones)."</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>VOLUMEN</td>
											<td>
												<table width = '100%' class = 'sin_color'>
													<tr>
														<td align = 'right' >".number_format(($valor_total_volumen_f)*100)."</td>
														<td align ='left'>%</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>UTILIDAD MARGINAL</td>
											<td>
												<table width = '100%' class = 'sin_color'>
													<tr>
														<td align = 'right' >".number_format($xx_final_total_venta)."</td>
														<td align ='left'>%</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
							</td>
							<td>
								<div>
									<table class = 'tablas_muestra_datos_tablas'>
										<tr>
											<td >VALOR TOTAL SIN IVA</td>
											<td></td>
											<td >
												<table width = '100%' class = 'sin_color'>
													<tr>
														<td align = 'left' >$</td>
														<td align = 'right' >".number_format($valor_total_sin_iva_f)."</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>RETENCIÓN EN LA FUENTE</td>
											<td> ".$this->retencion_fuente_empresa($num_ppto,9)."%</td>
											<td >
												<table width = '100%' class = 'sin_color'>
													<tr>
														<td align = 'left' >$</td>
														<td align = 'right' >".number_format($this->valor_retencion_fuente_empresa($num_ppto,9,$valor_total_sin_iva_f,$codigo_cliente,($total_final_venta + $total_valores_no_comisionables)))."</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>IMPUESTOS ADICIONALES</td>
											<td> ".$this->retencion_adicional_cliente_ppto($num_ppto)."%</td>
											<td >
												<table width = '100%' class = 'sin_color'>
													<tr>
														<td align = 'left'>$</td>
														<td align = 'right' >".number_format($impuestos_adicionales_condicion_cliente)."</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>ICA</td>
											<td> ".$this->ica_empresa($num_ppto,14)."/1000</td>
											<td >
												<table width = '100%' class = 'sin_color'>
													<tr>
														<td align = 'left'>$</td>
														<td align = 'right' >".number_format($this->valor_ica_empresa($num_ppto,14,$valor_total_sin_iva_f))."</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>CREE</td>
											<td>".$this->cree_empresa($num_ppto,11)."</td>
											<td >
												<table width = '100%'class = 'sin_color'>
													<tr>
														<td align = 'left'>$</td>
														<td align = 'right' >".number_format( $this->valor_cree_empresa($num_ppto,11,$valor_total_sin_iva_f))."</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>4 x 1000</td>
											<td></td>
											<td >
												<table width = '100%' class = 'sin_color'>
													<tr>
														<td align = 'left' >$</td>
														<td align = 'right' >".number_format($cuatro_valor_total)."</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>CHEQUES Y TRANSFERENCIAS</td>
											<td id = 'cheques_ppto'>".number_format( $this->num_cheques_empresa($num_ppto,16))."</td>
											<td >
												<table width = '100%' class = 'sin_color'>
													<tr>
														<td align = 'left'>$</td>
														<td align = 'right' >".number_format($cheques_tranferencias_valor)."</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>FACTORING</td>
											".$this->factoring_imp($num_ppto,$valor_total_sin_iva_f)."
										</tr>
										<tr>
											<td>ANTICIPOS INTERESES BANCARIOS</td>
											".$this->ant_int_bancarios_imp($num_ppto,$total_final_anticipos)."
										</tr>
										<tr>
											<td>DEL PROYECTO INTERESES BANCARIOS</td>
											".$this->pro_int_bancarios_imp($num_ppto,$valor_total_sin_iva_f)."
										</tr>
										<tr>
											<td>DEL PROYECTO INTERESES A 3ROS</td>
											".$this->pro_int_ter_imp($num_ppto,$valor_total_sin_iva_f)."
										</tr>
										<tr>
											<td>TOTAL COSTOS FINANCIEROS E IMPUESTOS</td>
											<td></td>
											<td>
												<table width = '100%' class = 'sin_color'>
													<tr>
														<td align = 'left'>$</td>
														<td align = 'right'>".number_format($total_impuestos_f)."</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>UTILIDAD FINAL</td>
											<td></td>
											<td>
												<table width = '100%' class = 'sin_color'>
													<tr>
														<td align = 'left'>$</td>
														<td align = 'right'>".number_format(($this->comision_cliente($num_ppto,$total_final_venta) + $total_comisiones ) - $total_impuestos_f)."</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>UTILIDAD PORCENTAJE</td>
											<td></td>
											".$this->evaluar_estado_ppto_aprobado_sin_facturar_o_pte_aprobacion($porcentaje_utilidad_total,$num_ppto)."
										</tr>
									</table>
								</div>
							</td>
						</tr>
					</table>
				</div>
			";
			echo $imp;
		}
		
		public function ordenes_produccion($ppto){
			$sql = mysql_query("select op.codigo_interno_op,p.nombre_comercial_proveedor, op.razon_cancelacion, fp.name_forma_pago,op.num_doc_prov,op.fecha_doc_pro
			from orproduccion op, proveedores p, fpago fp
			where op.ppto = '$ppto' and op.proveedor = p.codigo_interno_proveedor and
			op.fpago = fp.codigo_interno order by op.codigo_interno_op asc");
			$table = "
			<table width = '100%' class = 'tablas_muestra_datos_tablas' style = 'border-collapse:collapse;padding-left:50px;padding-right:50px;'>
				<tr>
					<td>
						<p>Ingrese el número de la Orden:</p>
						
					</td>
				</tr>
			</table>
			<table width = '100%' class = 'tablas_muestra_datos_tablas' style = 'border-collapse:collapse;padding-left:50px;padding-right:50px;'>
				<tr style = 'padding-left:50px;padding-right:50px;'>
					<th>Orden</th>
					<th>Proveedor</th>
					<th>Item</th>
					<th>Factura Proveedor</th>
					<th>Fecha Fact.</th>
				</tr>
				";
			while($row = mysql_fetch_array($sql)){
				$table.="<tr>
					<td style = 'border:1px solid black;'>".$row['codigo_interno_op']."</td>
					<td style = 'border:1px solid black;'>".$row['nombre_comercial_proveedor']."</td>
					<td style = 'border:1px solid black;padding-left:5px;padding-right:5px;'>
						<table width = '100%' style = 'border-collapse: collapse;'>
							<tr>
								<th style = 'border:1px solid black;' width = '80%'>Item</th>
								<th style = 'border:1px solid black;' width = '10%'>Días</th>
								<th style = 'border:1px solid black;' width = '10%'>Q</th>
							</tr>";
				$orden = $row['codigo_interno_op'];
				$sqlx = mysql_query("select i.name,p.dias,p.q
				from itempresup p, item_tarifario i
				where p.pk_item = i.id and p.pk_orden = '$orden' and p.editable = '1'");
				while($rowx = mysql_fetch_array($sqlx)){
					$table.="<tr>
						<td width = '80%' align = 'left' style = 'border:1px solid black;'>".$rowx['name']."</td>
						<td width = '10%' align = 'center' style = 'border:1px solid black;'>".$rowx['dias']."</td>
						<td width = '10%' align = 'center' style = 'border:1px solid black;'>".$rowx['q']."</td>
					</tr>";
				}
				$table.="</table>";
				$fecha = "";
				$cancelar_orden = "";
				if($row['fecha_doc_pro'] != '0000-00-00'){
					$fecha = $row['fecha_doc_pro'];
				}else{
					$cancelar_orden = "<img src = '../images/iconos/eliminar2.png' width = '25px' onclick = 'cancelar_oc($orden)'/>";
				}
				$table.="</td>
					<td style = 'border:1px solid black;'>".$row['num_doc_prov']."</td>
					<td style = 'border:1px solid black;'>".$fecha."</td>
					<td style = 'border:1px solid black;'>".$cancelar_orden."</td>
				</tr>";
					
			}
			echo $table."</table>";
		}
		
		public function cancelar_oc($orden,$ppto){
			$sql = mysql_query("update itempresup set editable = '0', pk_orden = '0' where pk_orden = '$orden' and ppto = '$ppto'");
		}
		
		public function mostrar_items_anticipo($ppto){
			$sql = mysql_query("select p.id,p.proveedor,p.dias,p.q,p.descripcion,p.val_item,p.iva_item,p.fecha_ant,p.por_ant,p.cliente,p.por_prov,p.id, i.name
			from itempresup p, item_tarifario i
			where p.editable = '0' and p.ppto = '$ppto' and i.id = p.pk_item");
			$est = "<table width = '100%' style = 'border-collapse:collapse;padding-left:50px;padding-right:50px;' class = 'tabla_info'>
				<tr>
					<th></th>
					<th >Item</th>
					<th>Descripción</th>
					<th>Total</th>
					<th>% Ant.</th>
					<th>$ Ant.</th>
					<th>Disponible</th>
					<th>%</th>
					<th>Valor</th>
				</tr>
				";
			while($row = mysql_fetch_array($sql)){
				$id = $row['id'];
				$anti = $row['por_ant']/100;
				$antix = $anti*($row['val_item']*$row['q']*$row['dias']);
				$est.="<tr>
					<td>
						<div>
							<input type = 'checkbox' id = 'ant_item$id' name = 'grupo_sel' value = '$id' onclick = 'sel_anticipo()' class = 'radio'/>
							<label for='ant_item$id'><span><span></span></span></label>
						</div>
					</td>
					<td>".$row['name']."</td>
					<td>".nl2br($row['descripcion'])."</td>
					<td class = ''>".number_format($row['val_item']*$row['q']*$row['dias'])."</td>
					<td align = 'center'>".$row['por_ant']." %</td>
					<td >$ ".number_format($antix)."</td>
					<td >$ ".number_format($row['val_item']*$row['q']*$row['dias'] - $antix)."<span class = 'hidde valoranticipodisponible' id = 'contValueAntDisponible$id'>".($row['val_item']*$row['q']*$row['dias'] - $antix)."</span></td>
					<td><input type = 'text' value = '0' style = 'width:25px;' maxlength = '3' class ='porcenjateAntform' id = 'inpuTextPorAnt$id' onkeyup = 'calcular_valor_anticipo($id)'/></td>
					<td class = 'calculoAntSolicitado$id'></td>
				</tr>";
			}
			$est.="<tr>
				<td colspan = '8' style = 'border:0px;'></td>
				<td class = 'total_acum_ant'></td>
			</tr>";
			echo $est."</table>";
		}
	}


	
?>

