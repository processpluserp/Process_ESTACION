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
		
		public function get_pk_item(){
			return $this->pk_item;
		}
		public function set_pk_item($xx){
			$this->pk_item = $xx;
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
		
		public function consultar_valor_item($item){
			$sql = mysql_query("select tarifa from item_tarifario where id = '$item'");
			$x = "";
			while($row = mysql_fetch_array($sql)){
				$x = $row['tarifa'];
			}
			return $x;
		}
		
		public function consultar_valor_desde($item){
			$sql = mysql_query("select desde from item_tarifario where id = '$item'");
			$x = "";
			while($row = mysql_fetch_array($sql)){
				$x = $row['desde'];
			}
			return $x;
		}
		
		public function consultar_valor_por_desde($item){
			$sql = mysql_query("select volumen from item_tarifario where id = '$item'");
			$x = "";
			while($row = mysql_fetch_array($sql)){
				$x = $row['volumen'];
			}
			return $x;
		}
		
		public function insert_item_ppto($fecha,$usuario,$celula){
			$sql = mysql_query("insert into itempresup(pk_item,dias,q,descripcion,val_item,fecha_ant,por_ant,cliente,val_desde_item,
			por_prov,usuario,fecha_registro,ppto,celula) values('".
			$this->get_pk_item()."','".$this->get_dias()."','".$this->get_q()."','".$this->get_descripcion()."','".$this->get_val_item()."','".$this->get_fecha_ant()."','".
			$this->get_por_ant()."','".$this->get_costo_cliente()."','".$this->get_valor_desde()."','".$this->get_por_desde()."','".$fecha."','".$usuario."','".$this->get_ppto()."','".$celula."')");
		}
		
		public function listar_grupos_tarifario($nombre){
			$sql = mysql_query("select name, id from grupo_tarifario where name like '%$nombre%'");
			$imp = "<div class = 'listado_items'><table>";
			while($row = mysql_fetch_array($sql)){
				$id = $row['id'];
				$imp.="<tr>
					<td>
						<div>
							<input type = 'radio'  name = 'grupo_sel' value = '$id' onclick = 'grupo_selected()' class = 'radio'/>
							<label for='$id'><span><span></span></span>".$row['name']."</label>
						</div>
					</td>
				</tr>";
			}
			return $imp."</table></div>";
		}
		
		public function listado_items_x_grupo($name,$g,$z){
			$sql_items = mysql_query("select name,id from item_tarifario where grupo = '$g' and name like '%$name%'");
			$imp = "<div class = 'listado_items'><table width = 'auto'>";
			while($row = mysql_fetch_array($sql_items)){
				$id = $row['id'];
				$imp.="<tr>
					<td>
						<div>
							<input type = 'radio'  name = 'item_sel' value = '$id' onclick = 'item_selected($z)' class = 'radio'/>
							<label for='$id'><span><span></span></span>".$row['name']."</label>
						</div>
					</td>
				</tr>";
			}
			return $imp."</table></div>";
		}
		
		public function listar_proveedores_ppto($num){
			$imp = "<option value = '0'>[SELECCIONE]</option>";
			$sql = mysql_query("select distinct p.nombre_comercial_proveedor, p.codigo_interno_proveedor
				from itempresup ip, item_tarifario i, proveedores p
				where i.id = ip.pk_item and i.proveedor =  p.codigo_interno_proveedor and ip.ppto = '$num'
				order by i.id asc");
				while($row = mysql_fetch_array($sql)){
					$imp.="<option value ='".$row['codigo_interno_proveedor']."'>".$row['nombre_comercial_proveedor']."</option>";
				}
			return $imp;
		}
		
		public function listado_items_valores_no_comisionables($name,$z){
			$sql_items = mysql_query("select name,id from item_tarifario where name like '%$name%'");
			$imp = "<div class = 'listado_items'><table>";
			while($row = mysql_fetch_array($sql_items)){
				$id = $row['id'];
				$imp.="<tr>
					<td>
						<input type = 'radio' value = '$id' name = 'item_nc' onclick = 'item_selected_nc($z)'/>
					</td>
					<td>".$row['name']."</td>
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
			$sql = mysql_query("select i.id as codigo_item,i.volumen,i.name,ip.id, ip.dias, ip.q, ip.descripcion
				from itempresup ip, item_tarifario i, proveedores p
				where i.id = ip.pk_item and i.proveedor =  p.codigo_interno_proveedor and ip.ppto = '$num' and p.codigo_interno_proveedor = '$pro'
				order by i.id asc");
			$estructura = "<table width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<td></td>
					<td>Item</td>
					<td>D</td>
					<td>Q</td>
					<td>Descripción</td>
				</tr>
			";
			while($row = mysql_fetch_array($sql)){
				$estructura.="<tr><td><input type = 'checkbox' name = 'productos_proveedores[]' value = '".$row['codigo_item']."'/></td><td>".$row['name']."</td>
				<td>".$row['dias']."</td><td>".$row['q']."</td><td>".$row['descripcion']."</td></tr>";
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
			where p.codigo_presup = '$num_ppto' and p.pk_clientes_nit_cliente = cc.cliente");
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
		
		public function calcular_anticipo($por,$val){
			return $val*($por/100);
		}
		
		public function consultar_valor_volumen($item,$valor){
			$x = 0;
			$sql = mysql_query("select volumen from item_tarifario where id = '$item'");
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
		
		public function cambiar_fecha($q,$id){
			$sql = mysql_query("update itempresup set fecha_ant = '$q' where id = '$id'");
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
		
		public function modificar_gasto($q,$n){
			$sql = mysql_query("update cabpresup set gastos_admin = '$q' where codigo_presup = '$n'");
		}
		
		
		public function update_comision_pedro($val,$id){
			$sql = mysql_query("update cabpresup set comision_adicional = '$val' where codigo_presup = '$id'");
		}
		
		public function estructura($num_ppto){
			$nombre_ppto = mysql_query("select referencia,comision_adicional from cabpresup where codigo_presup = '$num_ppto'");
			$valor_comision_pedro = 0;
			$imp = "<div  id = 'contenedor_ppto_x'><table width = '100%' id = 'tabla_mayor_ppto'>";
			while($row = mysql_fetch_array($nombre_ppto)){
				$valor_comision_pedro = $row['comision_adicional'];
				$imp .="<tr>
							<th class = 'titulo_ppto_general_concepto' colspan = '25'>".strtoupper($row['referencia'])."</th>
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
				<th class = 'separator'></th>
				<th colspan = '3' class = 'grupos_ppto_general' align = 'center'><strong>ANTICIPO</strong></th>
				<th class = 'separator'></th>
				<th colspan = '2' class = 'grupos_ppto_general' align = 'center'><strong>VALOR COMPRA INTERNA</strong></th>
				<th class = 'separator'></th>
				<th colspan = '2' class = 'grupos_ppto_general' align = 'center'><strong>VOLUMEN</strong></th>
				<th class = 'separator'></th>
				<th colspan = '2' class = 'grupos_ppto_general' align = 'center'><strong>VALOR VENTA EXTERNA</strong></th>
				<th class = 'separator'></th>
				<th colspan = '2' class = 'grupos_ppto_general' align = 'center'><strong>COMISION VENTA</strong></th>
				<th class = 'separator'></th>
				<th colspan = '2' class = 'grupos_ppto_general' align = 'center'><strong>TOTAL UTILIDAD VENTA</strong></th>
			</tr>";
			$total_volumen = 0;
			$imp.="<tr>
				<th></th>
				<th class = 'subtitulos_columnas'>ITEM</th>
				<th class = 'subtitulos_columnas' width = '300px'>DESCRIPCION</th>
				<th class = 'subtitulos_columnas'>PROVEEDOR</th>
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
				<th class = 'subtitulos_columnas'>UNITARIO</th>
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
			</tr>";
			$imp.="<tr><td></br></td></tr>";
			$sql_grupos = mysql_query("select g.name as grupo, g.id as codigo,cp.codigo_int_celula
			from grupo_tarifario g, cecula_ppto_interno cp
			where cp.pk_ppto_interno = '$num_ppto' and cp.nombre_celula <> 'VALORES NO COMISIONABLES' and cp.nombre_celula = g.id order by cp.codigo_int_celula asc");
			
			$valores_comisionables = 0;
			$total_final_anticipos = 0;
			$total_final_compra = 0;
			$total_final_venta = 0;
			$total_comision_venta = 0;
			$total_comisiones = 0;
			$total_volumen  =0;
			
			while($row = mysql_fetch_array($sql_grupos)){
				$total_anticipos = 0;
				$total_1 = 0;
				$total_2 = 0;
				$com_venta = 0;
				$comision_total_x = 0;
				
				
				$cod_grupo = $row['codigo'];
				$celula = $row['codigo_int_celula'];
				$imp.="<tr>
						<th>
							<img src = '../images/iconos/eliminar.png' width = '15px' height ='15px' onclick ='eliminar_grupo_ppto($celula)'/>
						</th>
						<th align = 'center' class = 'grupos_ppto_general' colspan = '24'>".$row['grupo']."</th>
					</tr>";
				$sql_item = mysql_query("select i.id as codigo_item,i.volumen,i.name,ip.id, ip.dias, ip.q, ip.descripcion, ip.val_item, ip.fecha_ant, ip.por_ant, ip.cliente, ip.val_desde_item,
				ip.por_prov, p.nombre_comercial_proveedor
				from itempresup ip, item_tarifario i, proveedores p
				where i.id = ip.pk_item and i.proveedor =  p.codigo_interno_proveedor and ip.ppto = '$num_ppto' and i.grupo = '$cod_grupo' and ip.celula ='$celula'
				order by i.id asc");
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
					$total_anticipos += $this->calcular_anticipo($items['por_ant'],$this->calcular_d_q_val($this->consultar_valor_volumen($items['codigo_item'],$items['val_item']),$items['dias'],$items['q']));
					$total_final_anticipos =+$total_anticipos;
					$total_1 += $this->calcular_d_q_val($this->consultar_valor_volumen($items['codigo_item'],$items['val_item']),$items['dias'],$items['q']);
					$total_final_compra +=$this->calcular_d_q_val($this->consultar_valor_volumen($items['codigo_item'],$items['val_item']),$items['dias'],$items['q']);
					$total_2 += $this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']);
					$total_final_venta +=$this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']);
					$com_venta += $this->calcular_comision_dinero($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item']);
					$total_comision_venta +=$this->calcular_comision_dinero($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item']);
					$comision_total_x +=$this->comision_total($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item']);
					$total_comisiones +=$this->comision_total($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item']);
					$total_volumen+= $this->d_consultar_valor_volumen($items['codigo_item'],$items['val_item']);
					
					$id_item = $items['id'];
					$imp.="<tr>
						<td align = 'center'>
							<img src = '../images/iconos/eliminar.png' width = '15px' height ='15px' onclick ='eliminar_item_ppto($id_item)'/>
						</td>
						<td class = '$class' id = 'item' >".$items['name']."</td>
						<td class = '$class' id = 'desc$id_item' ondblclick = 'update_desc_item($id_item)'>".$items['descripcion']."</td>
						<td class = '$class'>".$items['nombre_comercial_proveedor']."</td>
						<td class = '$class' id = 'q$id_item' align = 'center' ondblclick = 'update_q_item($id_item)' style = 'background-color:#88B4F5;'>".$items['q']."</td>
						<td class = '$class' id = 'dias$id_item' align = 'center' ondblclick = 'update_dias_item($id_item)' style = 'background-color:#88B4F5;'>".$items['dias']."</td>
						<td class = 'separator'></td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->calcular_anticipo($items['por_ant'],$this->calcular_d_q_val($this->consultar_valor_volumen($items['codigo_item'],$items['val_item']),$items['dias'],$items['q'])))."</td>
								</tr>
							</table>
						</td>
						<td class = '$class' id = 'por_a$id_item' align = 'center'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>".number_format($items['por_ant'])."</td>
									<td>%</td>
								</tr>
							</table>
						</td>
						<td class = '$class' nowrap id = 'fec$id_item' align = 'center' ondblclick = 'update_fecha($id_item)'>".$items['fecha_ant']."</td>
						<td class = 'separator'></td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->consultar_valor_volumen($items['codigo_item'],$items['val_item']))."</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->calcular_d_q_val($this->consultar_valor_volumen($items['codigo_item'],$items['val_item']),$items['dias'],$items['q']))."</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>
						
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($items['val_item'])."</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>".number_format($items['volumen'])."</td>
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
									".number_format($items['cliente'])."</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']))."</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->calcular_comision_dinero($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item']))."</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>".number_format($this->calcular_comision_porcentaje($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item']))."</td>
									<td>%</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->comision_total($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item']))."</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>".number_format($this->porcentaje_comision_total($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item'],$items['volumen']))."</td>
									<td>%</td>
								</tr>
							</table>
						</td>
					</tr>";
				}
				if($xclass == 1){
					$class = "oscuro_ppto_general";
					$xclass = 0;
				}else if($xclass == 0){
					$class = "claro_ppto_general";
					$xclass = 1;
				}
				for($i = 0;$i < 1;$i++){
					$imp.="<tr>
						<td ></td>
						<td class = '$class' id = '$celula-item$i' ondblclick = 'listado_items_grupo($cod_grupo,$i,$celula)'>ITEM</td>
						<td class = '$class'></td>
						<td class = '$class'></td>
						<td class = '$class'></td>
						<td class = '$class'></td>
						<td class = 'separator'></td>
						<td class = '$class'></td>
						<td class = '$class'></td>
						<td class = '$class'></td>
						<td class = 'separator'></td>
						<td class = '$class'></td>
						<td class = '$class'></td>
						<td class = 'separator'></td>
						<td class = '$class'></td>
						<td class = '$class'></td>
						<td class = 'separator'></td>
						<td class = '$class'></td>
						<td class = '$class'></td>
						<td class = 'separator'></td>
						<td class = '$class'></td>
						<td class = '$class'></td>
						<td class = 'separator'></td>
						<td class = '$class'></td>
						<td class = '$class'></td>
					</tr>";
				}
			
				$imp.="<tr>
					<td ></td>
					<td ></td>
					<td  width = '300px'></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($total_anticipos)."</td>
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
								<td align = 'right'>".number_format($total_1)."</td>
							</tr>
						</table>
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
								<td align = 'right'>".number_format($total_2)."</td>
							</tr>
						</table>
					</td>
					<td ></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($com_venta)."</td>
							</tr>
						</table>
					</td>
					<td></td>
					<td class = 'separator'></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($comision_total_x)."</td>
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
				
				$celula = $row['codigo_int_celula'];
				$imp.="<tr>
						<th></th>
						<th align = 'center' class = 'grupos_ppto_general' colspan = '24' >".$row['nombre_celula']."</th>
					</tr>";
				$sql_item = mysql_query("select i.id as codigo_item,i.volumen,i.name,ip.id, ip.dias, ip.q, ip.descripcion, ip.val_item, ip.fecha_ant, ip.por_ant, ip.cliente, ip.val_desde_item,
				ip.por_prov, p.nombre_comercial_proveedor
				from itempresup ip, item_tarifario i, proveedores p
				where i.id = ip.pk_item and i.proveedor =  p.codigo_interno_proveedor and ip.ppto = '$num_ppto'  and ip.celula ='$celula' order by i.id asc");
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
					$com_venta += $this->calcular_comision_dinero($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item']);
					$comision_total_x +=$this->comision_total($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item']);
					$total_comisiones +=$this->comision_total($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item']);
					//$total_volumen += $this->consultar_valor_volumen($items['codigo_item'],$items['val_item']);
					$id_item = $items['id'];
					$imp.="<tr>
						<td align = 'center'>
							<img src = '../images/iconos/eliminar.png' width = '15px' height ='15px' onclick ='eliminar_item_ppto($id_item)'/>
						</td>
						<td class = '$class' id = 'item' >".$items['name']."</td>
						<td class = '$class' id = 'desc$id_item' ondblclick = 'update_desc_item($id_item)'>".$items['descripcion']."</td>
						<td class = '$class'>".$items['nombre_comercial_proveedor']."</td>
						<td class = '$class' id = 'q$id_item' align = 'center' ondblclick = 'update_q_item($id_item)' style = 'background-color:#88B4F5;'>".$items['q']."</td>
						<td class = '$class' id = 'dias$id_item' align = 'center' ondblclick = 'update_dias_item($id_item)' style = 'background-color:#88B4F5;'>".$items['dias']."</td>
						<td class = 'separator'></td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->calcular_anticipo($items['por_ant'],$this->calcular_d_q_val($this->consultar_valor_volumen($items['codigo_item'],$items['val_item']),$items['dias'],$items['q'])))."</td>
								</tr>
							</table>
						</td>
						<td class = '$class' id = 'por_a$id_item' align = 'center'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>".number_format($items['por_ant'])."</td>
									<td>%</td>
								</tr>
							</table>
						</td>
						<td class = '$class' nowrap id = 'fec$id_item' align = 'center' ondblclick = 'update_fecha($id_item)'>".$items['fecha_ant']."</td>
						<td class = 'separator'></td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->consultar_valor_volumen($items['codigo_item'],$items['val_item']))."</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->calcular_d_q_val($this->consultar_valor_volumen($items['codigo_item'],$items['val_item']),$items['dias'],$items['q']))."</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>
						
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($items['val_item'])."</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>".number_format($items['volumen'])."</td>
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
									".number_format($items['cliente'])."</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->calcular_d_q_val($items['cliente'],$items['dias'],$items['q']))."</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->calcular_comision_dinero($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item']))."</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>".number_format($this->calcular_comision_porcentaje($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item']))."</td>
									<td>%</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->comision_total($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item']))."</td>
								</tr>
							</table>
						</td>
						<td class = '$class'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>".number_format($this->porcentaje_comision_total($items['val_item'],$items['dias'],$items['q'],$items['cliente'],$items['codigo_item'],$items['volumen']))."</td>
									<td>%</td>
								</tr>
							</table>
						</td>
					</tr>";
				}
				
				for($i = 0;$i < 1;$i++){
					$imp.="<tr>
					<td></td>
						<td class = '$class' id = '$celula-item$i' ondblclick = 'listado_items_nc($i,$celula)'>ITEM</td>
						<td class = '$class'></td>
						<td class = '$class'></td>
						<td class = '$class'></td>
						<td class = '$class'></td>
						<td class = 'separator'></td>
						<td class = '$class'></td>
						<td class = '$class'></td>
						<td class = '$class'></td>
						<td class = 'separator'></td>
						<td class = '$class'></td>
						<td class = '$class'></td>
						<td class = 'separator'></td>
						<td class = '$class'></td>
						<td class = '$class'></td>
						<td class = 'separator'></td>
						<td class = '$class'></td>
						<td class = '$class'></td>
						<td class = 'separator'></td>
						<td class = '$class'></td>
						<td class = '$class'></td>
						<td class = 'separator'></td>
						<td class = '$class'></td>
						<td class = '$class'></td>
					</tr>";
				}
				
				$imp.="<tr>
					<td ></td>
					<td ></td>
					<td  width = '300px'></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($total_anticipos)."</td>
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
								<td align = 'right'>".number_format($total_1)."</td>
							</tr>
						</table>
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
								<td align = 'right'>".number_format($total_2)."</td>
							</tr>
						</table>
					</td>
					<td ></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($com_venta)."</td>
							</tr>
						</table>
					</td>
					<td ></td>
					<td class = 'separator'></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($comision_total_x)."</td>
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
					<td colspan = '2' align = 'right' class = 'grupos_ppto_general' nowrap>TOTAL ANTICIPOS</td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($total_final_anticipos)."</td>
							</tr>
						</table>
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td nowrap align = 'right' class = 'grupos_ppto_general'>TOTAL COMPRA</td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($total_final_compra)."</td>
							</tr>
						</table>
					</td>
					<td ></td>
					<td ></td>
					<td >
					</td>
					
					<td colspan = '2' class = 'grupos_ppto_general' align = 'right'>TOTAL VENTA</td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($total_final_venta)."</td>
							</tr>
						</table>
					</td>
					<td ></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($total_comision_venta)."</td>
							</tr>
						</table>
					</td>
					<td ></td>
					<td class = 'separator'></td>
					<td class = 'totales_ppto'>
						<table width = '100%'>
							<tr>
								<td>$</td>
								<td align = 'right'>".number_format($total_comisiones)."</td>
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
					<td align = 'center' id = 'grupon$i'class = 'grupos_ppto_general' colspan = '24' ondblclick = 'listar_grupos_tarifario($i)'>Nuevo Grupo</td>
				</tr>";
			}
			$imp.="</table></div>";
			
			
			
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
			$imp.="<div id = 'contenedor_resumen_ppto' >
				
				<table class = 'tabla_nuevos_datos' width = '100%'>
					<tr>
						<th colspan = '2'>RESUMEN INTERNO UTILIDAD</th>
						<td class = 'separator'></td>
						<td class = 'separator'></td>
						<th colspan = '2' style = 'vertical-align: top;'>RESUMEN CLIENTE</th>
						<td class = 'separator'></td>
						<td class = 'separator'></td>
					</tr>
					<tr>
						<td style = 'padding-left:10px;'>
							<p>TOTAL CLIENTE</p>
						</td>
						<td>
							<input type = 'text' readonly value ='".number_format($total_comision_venta)."'/>
						</td>
						<td class = 'separator'></td>
						<td class = 'separator'></td>
						
						<td>
							<p>SUBTOTAL</p>
						</td>
						<td>
							<input type = 'text' readonly value ='".number_format($total_final_venta)."'/>
						</td>
						<td class = 'separator'></td>
						<td class = 'separator'></td>
						<td>
							<p>% PPTO</p>
						</td>
						<td>
							<input type = 'text' readonly value ='".number_format((($total_comision_venta+$total_volumen+$valor_comision_pedro)/$total_final_venta)*100)." %'/>
						</td>
					</tr>
					<tr>
						<td style = 'padding-left:10px;' >
							<p>TOTAL VOLÚMEN</p>
						</td>
						<td>
							<input type = 'text' readonly value ='".number_format($total_volumen)."'/>
						</td>
						<td class = 'separator'></td>
						<td class = 'separator'></td>
						
						<td>
							<p>IVA</p>
						</td>
						<td>
							<input type = 'text' readonly value ='".number_format($total_final_venta*0.16)."'/>
						</td>
						<td class = 'separator'></td>
						<td class = 'separator'></td>
						<td>
							<p>% COMPRA</p>
						</td>
						<td>
							<input type = 'text' readonly value ='".number_format((($total_comision_venta+$total_volumen+$valor_comision_pedro)/$total_final_venta)*100)." %'/>
						</td>
					</tr>
					<tr>
						<td style = 'padding-left:10px;'>
							<p>COMISIÓN AGENCIA</p>
						</td>
						<td id = 'comision_agencia_pedrox' ondblclick = 'escribir_comision_agencia($num_ppto)'>
							<input type = 'text' id = 'comision_agencia_pedro' readonly value ='".number_format($valor_comision_pedro)."'/>
						</td>
						<td class = 'separator'></td>
						<td class = 'separator'></td>
						
						<td>
							<p>TOTAL GENERAL</p>
						</td>
						<td>
							<input style = 'font-weight:bold;color:red;' type = 'text' readonly value ='".number_format(($total_final_venta*0.16)+$total_final_venta)."'/>
						</td>
					</tr>
					<tr>
						<td style = 'padding-left:10px;'>
							<p >TOTAL GENERAL</p>
						</td>
						<td >
							<input style = 'font-weight:bold;color:red;'type = 'text' readonly value ='".number_format($total_comision_venta+$total_volumen+$valor_comision_pedro)."'/>
						</td>
					</tr>
				</table>
			</div>";
			echo $imp;
		}
	}
?>