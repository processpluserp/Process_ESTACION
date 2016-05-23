<?php
	class muebles{
		public $codigo;
		public $desc;
		public $valor_hoy;
		public $valor_compra;
		public $quien;
		public $factura;
		public $pk_area;
		public $empresa;
		public $depreciacion;
		
		
		public function ceros($num){
			$text = "";
			if($num < 9 ){
				$text = "000".$num;
			}else if($num > 9 && $num <= 99){
				$text = "00".$num;
			}else if($num > 99 && $num <= 999){
				$text = "0".$num;
			}else if($num > 999 && $num <= 9999){
				$text = $num;
			}
			return $text;
		}
		
		public function generar_codigo(){
			$s = 0;
			$c = mysql_query("select max(id) as id from muebles");
			while($row = mysql_fetch_array($c)){
				$s = $row['id'];
			}
			$s++;
			$year = date("Y") - 2000;
			$codigo = "MUE".$this->ceros($s)."-".$year;
			return $codigo;
		}
		
		public function get_descripcion(){
			return $this->desc;
		}
		public function set_descripcion($de){
			$this->desc = $de;
		}
		
		public function get_valor_hoy(){
			return $this->valor_hoy;
		}
		public function set_valor_hoy($vh){
			$this->valor_hoy = $vh;
		}
		
		public function get_valor_compra(){
			return $this->valor_compra;
		}
		public function set_valor_compra($vc){
			$this->valor_compra = $vc;
		}
		
		public function get_quien(){
			return $this->quien;
		}
		public function set_quien($q){
			$this->quien = $q;
		}
		
		public function get_factura(){
			return $this->factura;
		}
		public function set_factura($fact){
			$this->factura = $fact;
		}
		
		public function get_area_empresa(){
			return $this->pk_area;
		}
		public function set_area_empresa($area){
			$this->pk_area = $area;
		}
		
		public function get_empresa(){
			return $this->empresa;
		}
		public function set_empresa($emp){
			$this->empresa = $emp;
		}
		
		public function get_depreciacion(){
			return $this->depreciacion;
		}
		public function set_depreciacion($dep){
			$this->depreciacion = $dep;
		}
		
		public function estructura(){
			$tabla = "<table width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>#</th>
					<th>Código</th>
					<th>Descripcion</th>
					<th>Valor Hoy</th>
					<th>Valor Compra</th>
					<th>Quién</th>
					<th># Factura</th>
					<th>Área</th>
					<th>Empresa</th>
				</tr>";
			return $tabla;
		}
		
		public function mostrar_datos($emp){
			$t = $this->estructura();
			$i = 1;
			$s = mysql_query("select m.id,m.descripcion, m.valor_hoy, m.valor_compra, m.quien, m.factura,
			m.pk_area, m.pk_empresa, m.codigo, ar.nombre_area_empresa, e.nombre_comercial_empresa from
			muebles m, area_empresa ar, empresa e where e.cod_interno_empresa = '$emp' and
			m.pk_area = ar.codigo_interno_empresa and ar.pk_empresa_areas = e.cod_interno_empresa");
			while($row = mysql_fetch_array($s)){
				$t .="<tr>
					<td>".$i."</td>
					<td>".$row['codigo']."</td>
					<td>".$row['descripcion']."</td>
					<td>".number_format($row['valor_hoy'])."</td>
					<td>".number_format($row['valor_compra'])."</td>
					<td>".$row['quien']."</td>
					<td>".$row['factura']."</td>
					<td>".$row['nombre_area_empresa']."</td>
					<td>".$row['nombre_comercial_empresa']."</td>
				</tr>";
				$i++;
			}
			echo $t."</table>";
		}
		
		public function mostrar_datos_empresa($emp){
			$t = $this->estructura();
			$i = 1;
			$s = mysql_query("select m.id,m.descripcion, m.valor_hoy, m.valor_compra, m.quien, m.factura,
			m.pk_area, m.pk_empresa, m.codigo, ar.nombre_area_empresa, e.nombre_comercial_empresa from
			muebles m, area_empresa ar, empresa e where m.pk_empresa = '$emp' and
			m.pk_area = ar.codigo_interno_empresa and ar.pk_empresa_areas = e.cod_interno_empresa");
			while($row = mysql_fetch_array($s)){
				$t .="<tr>
					<td>".$i."</td>
					<td>".$row['codigo']."</td>
					<td>".$row['descripcion']."</td>
					<td>".number_format($row['valor_hoy'])."</td>
					<td>".number_format($row['valor_compra'])."</td>
					<td>".$row['quien']."</td>
					<td>".$row['factura']."</td>
					<td>".$row['nombre_area_empresa']."</td>
					<td>".$row['nombre_comercial_empresa']."</td>
				</tr>";
				$i++;
			}
			echo $t."</table>";
		}
		
		public function mostrar_datos_area($emp,$area){
			$t = $this->estructura();
			$i = 1;
			$s = mysql_query("select m.id,m.descripcion, m.valor_hoy, m.valor_compra, m.quien, m.factura,
			m.pk_area, m.pk_empresa, m.codigo, ar.nombre_area_empresa, e.nombre_comercial_empresa from
			muebles m, area_empresa ar, empresa e where m.pk_empresa = '$emp' and m.pk_area = '$area' and
			m.pk_area = ar.codigo_interno_empresa and ar.pk_empresa_areas = e.cod_interno_empresa");
			while($row = mysql_fetch_array($s)){
				$t .="<tr>
					<td>".$i."</td>
					<td>".$row['codigo']."</td>
					<td>".$row['descripcion']."</td>
					<td>".number_format($row['valor_hoy'])."</td>
					<td>".number_format($row['valor_compra'])."</td>
					<td>".$row['quien']."</td>
					<td>".$row['factura']."</td>
					<td>".$row['nombre_area_empresa']."</td>
					<td>".$row['nombre_comercial_empresa']."</td>
				</tr>";
				$i++;
			}
			echo $t."</table>";
		}
		public function mostrar_item_creado(){
			$e = mysql_query("select max(id) as id from muebles");
			$x = 0;
			while($row = mysql_fetch_array($e)){
				$x = $row['id'];
			}
			$t = $this->estructura();
			$i = 1;
			$s = mysql_query("select m.id,m.descripcion, m.valor_hoy, m.valor_compra, m.quien, m.factura,
			m.pk_area, m.pk_empresa, m.codigo, ar.nombre_area_empresa, e.nombre_comercial_empresa from
			muebles m, area_empresa ar, empresa e where m.id = '$x' and
			m.pk_area = ar.codigo_interno_empresa and ar.pk_empresa_areas = e.cod_interno_empresa");
			while($row = mysql_fetch_array($s)){
				$t .="<tr>
					<td>".$i."</td>
					<td>".$row['codigo']."</td>
					<td>".$row['descripcion']."</td>
					<td>".number_format($row['valor_hoy'])."</td>
					<td>".number_format($row['valor_compra'])."</td>
					<td>".$row['quien']."</td>
					<td>".$row['factura']."</td>
					<td>".$row['nombre_area_empresa']."</td>
					<td>".$row['nombre_comercial_empresa']."</td>
				</tr>";
				$i++;
			}
			echo $t."</table>";
		}
		
		public function insert_muebles($fecha, $usuario){
			$insert = mysql_query("insert into muebles( descripcion,valor_hoy,valor_compra,quien,
			factura,pk_area,pk_empresa,codigo,depreciacion,fecha,usuario) values
			('".$this->get_descripcion()."','".$this->get_valor_hoy()."','".$this->get_valor_compra()."','".$this->get_quien()."','".$this->get_factura()."','".$this->get_area_empresa()."','".$this->get_empresa()."','".$this->generar_codigo()
			."','".$this->get_depreciacion()."','".$fecha."','".$usuario."')");
		}
	}
?>