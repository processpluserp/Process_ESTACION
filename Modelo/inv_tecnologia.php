<?php
	
	class inv_tecnologia{
		public $codigo;
		public $empresa;
		public $usuario;
		public $tipo;
		public $plataforma;
		public $marca;
		public $modelo;
		public $s_modelo;
		public $monitor;
		public $s_monitor;
		public $teclado;
		public $s_teclado;
		public $mouse;
		public $s_mouse;
		public $dd;
		public $memo;
		public $procesador;
		public $velocidad;
		public $drive;
		
		
		public function mostrar_datos($emp){
			$tabla = "<table width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>#</th>
					<th>Código</th>
					<th>Empresa</th>
					<th>Empleado</th>
					<th>Plataforma</th>
					<th>Marca</th>
					<th></th>
					<th></th>
				</tr>";
				$i = 1;
			$s = mysql_query("select inv.id,inv.codigo,inv.plataforma, inv.marca, inv.tipo,
			inv.modelo, inv.s_modelo, inv.monitor, inv.s_monitor, inv.teclado,inv.s_teclado, inv.mouse,
			inv.s_mouse, inv.dd, inv.memoria, inv.procesador,inv.velocidad,inv.drive,e.nombre_empleado, emp.nombre_comercial_empresa from inv_tecnologia inv, empleado e, empresa emp where emp.cod_interno_empresa = '$emp' and
			inv.pk_empresa = emp.cod_interno_empresa and inv.pk_usuario = e.documento_empleado");
			while($row = mysql_fetch_array($s)){
				$id = $row['id'];
				$tabla .="<tr onclick = 'mostrar_informacion_item_invtec($id)'>
					<td>".$i."</td>
					<td>".$row['codigo']."</td>
					<td>".$row['nombre_comercial_empresa']."</td>
					<td>".$row['nombre_empleado']."</td>
					<td>".$row['plataforma']."</td>
					<td>".$row['marca']."</td>
				</tr>";
				$i++;
			}
			$tabla.="</table>";
			echo $tabla;
		}
		
		public function mostrar_datos_empresa($emp){
			$tabla = "<table width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>#</th>
					<th>Código</th>
					<th>Empresa</th>
					<th>Empleado</th>
					<th>Plataforma</th>
					<th>Marca</th>
					<th></th>
					<th></th>
				</tr>";
				$i = 1;
			$s = mysql_query("select inv.id,inv.codigo,inv.plataforma, inv.marca, inv.tipo,
			inv.modelo, inv.s_modelo, inv.monitor, inv.s_monitor, inv.teclado,inv.s_teclado, inv.mouse,
			inv.s_mouse, inv.dd, inv.memoria, inv.procesador,inv.velocidad,inv.drive,e.nombre_empleado, emp.nombre_comercial_empresa from inv_tecnologia inv, empleado e, empresa emp where inv.pk_empresa = '$emp' and
			inv.pk_empresa = emp.cod_interno_empresa and inv.pk_usuario = e.documento_empleado");
			while($row = mysql_fetch_array($s)){
				$id = $row['id'];
				$tabla .="<tr onclick = 'mostrar_informacion_item_invtec($id)'>
					<td>".$i."</td>
					<td>".$row['codigo']."</td>
					<td>".$row['nombre_comercial_empresa']."</td>
					<td>".$row['nombre_empleado']."</td>
					<td>".$row['plataforma']."</td>
					<td>".$row['marca']."</td>
				</tr>";
				$i++;
			}
			$tabla.="</table>";
			echo $tabla;
		}
		
		public function mostrar_datos_empresa_plataforma($emp,$plat){
			$s = "";
			if($emp == "vacio"){
				$s = mysql_query("select inv.id,inv.codigo,inv.plataforma, inv.marca, inv.tipo,
				inv.modelo, inv.s_modelo, inv.monitor, inv.s_monitor, inv.teclado,inv.s_teclado, inv.mouse,
				inv.s_mouse, inv.dd, inv.memoria, inv.procesador,inv.velocidad,inv.drive,e.nombre_empleado, emp.nombre_comercial_empresa from inv_tecnologia inv, empleado e, empresa emp where
				inv.pk_empresa = emp.cod_interno_empresa and inv.pk_usuario = e.documento_empleado and
				inv.plataforma = '$plat'");
			}else{
				$s = mysql_query("select inv.id,inv.codigo,inv.plataforma, inv.marca, inv.tipo,
				inv.modelo, inv.s_modelo, inv.monitor, inv.s_monitor, inv.teclado,inv.s_teclado, inv.mouse,
				inv.s_mouse, inv.dd, inv.memoria, inv.procesador,inv.velocidad,inv.drive,e.nombre_empleado, emp.nombre_comercial_empresa from inv_tecnologia inv, empleado e, empresa emp where inv.pk_empresa = '$emp' and
				inv.pk_empresa = emp.cod_interno_empresa and inv.pk_usuario = e.documento_empleado and
				inv.plataforma = '$plat'");
			}
			$tabla = "<table width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>#</th>
					<th>Código</th>
					<th>Empresa</th>
					<th>Empleado</th>
					<th>Plataforma</th>
					<th>Marca</th>
					<th></th>
					<th></th>
				</tr>";
				$i = 1;
			while($row = mysql_fetch_array($s)){
				$id = $row['id'];
				$tabla .="<tr onclick = 'mostrar_informacion_item_invtec($id)'>
					<td>".$i."</td>
					<td>".$row['codigo']."</td>
					<td>".$row['nombre_comercial_empresa']."</td>
					<td>".$row['nombre_empleado']."</td>
					<td>".$row['plataforma']."</td>
					<td>".$row['marca']."</td>
				</tr>";
				$i++;
			}
			$tabla.="</table>";
			echo $tabla;
		}
		
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
			$c = mysql_query("select max(id) as id from inv_tecnologia");
			while($row = mysql_fetch_array($c)){
				$s = $row['id'];
			}
			$s++;
			$year = date("Y") - 2000;
			$codigo = "TEC".$this->ceros($s)."-".$year;
			return $codigo;
		}
		
		public function get_empresa(){
			return $this->empresa;
		}
		public function set_empresa($emp){
			$this->empresa = $emp;
		}
		
		public function get_usuario(){
			return $this->usuario;
		}
		public function set_usuario($usu){
			$this->usuario = $usu;
		}
		
		public function get_tipo(){
			return $this->tipo;
		}
		public function set_tipo($tip){
			$this->tipo = $tip;
		}
		
		public function get_plataforma(){
			return $this->plataforma;
		}
		public function set_paltaforma($p){
			$this->plataforma = $p;
		}
		
		public function get_marca(){
			return $this->marca;
		}
		public function set_marca($m){
			$this->marca = $m;
		}
		public function get_modelo(){
			return $this->modelo;
		}
		public function set_modelo($m){
			$this->modelo = $m;
		}
		public function get_serie_modelo(){
			return $this->s_modelo;
		}
		public function set_serie_modelo($sm){
			$this->s_modelo = $sm;
		}
		public function get_monitor(){
			return $this->monitor;
		}
		public function set_monitor($m){
			$this->monitor = $m;
		}
		public function get_serie_monitor(){
			return $this->s_monitor;
		}
		public function set_serie_monitor($sm){
			$this->s_monitor = $sm;
		}
		
		public function get_mouse(){
			return $this->mouse;
		}
		public function set_mouse($m){
			$this->mouse = $m;
		}
		
		public function get_serie_mouse(){
			return $this->s_mouse;
		}
		public function set_serie_mouse($sm){
			$this->s_mouse = $sm;
		}
		public function get_teclado(){
			return $this->teclado;
		}
		public function set_teclado($t){
			$this->teclado = $t;
		}
		public function get_serie_teclado(){
			return $this->s_teclado;
		}
		public function set_serie_teclado($st){
			$this->s_teclado = $st;
		}
		public function get_dd(){
			return $this->dd;
		}
		public function set_dd($d){
			$this->dd = $d;
		}
		public function get_memoria(){
			return $this->memo;
		}
		public function set_memoria($mm){
			$this->memo = $mm;
		}
		
		public function get_procesador(){
			return $this->procesador;
		}
		public function set_procesador($pr){
			$this->procesador = $pr;
		}
		
		public function get_velocidad(){
			return $this->velocidad;
		}
		public function set_velocidad($v){
			$this->velocidad = $v;
		}
		public function get_drive(){
			return $this->drive;
		}
		public function set_drive($d){
			$this->drive = $d;
		}
		
		public function insert_inv_tecnologia($fecha,$usu){
			$insert = mysql_query("insert into inv_tecnologia(codigo,pk_empresa,pk_usuario,tipo,plataforma,marca,modelo,s_modelo,	monitor,s_monitor,teclado,s_teclado,mouse,s_mouse,dd,memoria,procesador,velocidad,drive,fecha_registro,registrado_por) values
			('".$this->generar_codigo()."','".$this->get_empresa()."','".$this->get_usuario()."','".$this->get_tipo()."','".$this->get_plataforma()."','".$this->get_marca()."','".$this->get_modelo()."','".$this->get_serie_modelo()."','".$this->get_monitor()."','".$this->get_serie_monitor()."','".$this->get_teclado()."','".$this->get_serie_teclado()."','".$this->get_mouse()."','".$this->get_serie_mouse()."','".$this->get_dd()."','".$this->get_memoria()."','".$this->get_procesador()."','".$this->get_velocidad()."','".$this->get_drive()."','".$fecha."','".$usu."')");
		}
		public function update_inv_tecnoligia(){
			$update = mysql_query("update from inv_tecnologia set pk_usuario = '".$this->get_usuario()."',");
		}
		
		public function mostrar_hoja_inventario($id){
			$estructura = "<table class = 'tabla_nuevos_datos' width = '100%' id = 'info_basica_equipo'>";
			$sel = mysql_query("select e.nombre_empleado,e.cargo_empleado,ar.nombre_area_empresa,tec.codigo,tec.tipo,tec.plataforma,tec.marca,
			tec.modelo,tec.s_modelo,tec.monitor,tec.s_monitor,tec.teclado,tec.s_teclado,tec.mouse,tec.s_mouse,tec.dd,tec.memoria,tec.procesador,tec.velocidad,tec.drive,tec.fecha_registro from empleado e,  area_empresa ar, inv_tecnologia tec 
			where tec.pk_usuario = '$id' and tec.pk_usuario = e.documento_empleado and e.pk_depto = ar.codigo_interno_empresa");
			while($row = mysql_fetch_array($sel)){
				$estructura .= "<tr>
					<th colspan = '5' id = 'nombre_persona'><strong>".$row['nombre_empleado']."</strong></th>
				</tr>
				<tr>
					<td colspan = '2'><p><strong>DEPARTAMENTO</strong> ".$row['nombre_area_empresa']."</p></td>
					<td class = 'separator'></td>
					<td colspan = '2' ><p><strong>CARGO</strong> ".$row['cargo_empleado']."</p></td>
				</tr>
				<tr>
					<td colspan = '2'><p><strong>TIPO </strong>".$row['tipo']."</p></td>
					<td class = 'separator'></td>
					<td colspan = '2' ><p><strong>PLATAFORMA</strong> ".$row['plataforma']."</p></td>
				</tr>
				</table>
				</br>
			<table class = 'tabla_nuevos_datos' width = '100%' id = 'caracteristicas_equipo'>
				<tr>
					<th colspan = '5'><strong>CARACTERÍSTICAS DEL EQUIPO</strong></th>
				</tr>
				<tr>
					<td colspan = '2' width = '40%'><p><strong>MARCA</strong> ".$row['marca']."</p></td>
					<td class = 'separator'></td>
					<td colspan = '2' width = '40%'><p><strong>CÓDIGO INV.</strong> ".$row['codigo']."</p></td>
				</tr>
				<tr>
					<td colspan = '2' width = '40%'><p><strong>MODELO</strong> ".$row['modelo']."</p></td>
					<td class = 'separator'></td>
					<td colspan = '2' width = '40%'><p><strong>SERIE</strong> ".$row['s_modelo']."</p></td>
				</tr>
				<tr>
					<td colspan = '2' width = '40%'><p><strong>MONITOR</strong> ".$row['monitor']."</p></td>
					<td class = 'separator'></td>
					<td colspan = '2' width = '40%'><p><strong>SERIE</strong> ".$row['s_monitor']."</p></td>
				</tr>
				<tr>
					<td colspan = '2' width = '40%'><p><strong>TECLADO</strong> ".$row['teclado']."</p></td>
					<td class = 'separator'></td>
					<td colspan = '2' width = '40%'><p><strong>SERIE</strong> ".$row['s_teclado']."</p></td>
				</tr>
				<tr>
					<td colspan = '2' width = '40%'><p><strong>MOUSE</strong> ".$row['mouse']."</p></td>
					<td class = 'separator'></td>
					<td colspan = '2' width = '40%'><p><strong>SERIE</strong> ".$row['s_mouse']."</p></td>
				</tr>
				</table>";
			}
			$estructura .="</table>";
			echo $estructura;
		}
		
		public function mostrar_hoja_inventario_equipo($id){
			$estructura = "<table class = 'tabla_nuevos_datos' width = '100%' id = 'info_basica_equipo'>";
			$sel = mysql_query("select e.nombre_empleado,e.cargo_empleado,ar.nombre_area_empresa,tec.codigo,tec.tipo,tec.plataforma,tec.marca,
			tec.modelo,tec.s_modelo,tec.monitor,tec.s_monitor,tec.teclado,tec.s_teclado,tec.mouse,tec.s_mouse,tec.dd,tec.memoria,tec.procesador,tec.velocidad,tec.drive,tec.fecha_registro from empleado e,  area_empresa ar, inv_tecnologia tec 
			where tec.id = '$id' and tec.pk_usuario = e.documento_empleado and e.pk_depto = ar.codigo_interno_empresa");
			while($row = mysql_fetch_array($sel)){
				$estructura .= "<tr>
					<th colspan = '5' id = 'nombre_persona'><strong>".$row['nombre_empleado']."</strong></th>
				</tr>
				<tr>
					<td colspan = '2'><p><strong>DEPARTAMENTO</strong> ".$row['nombre_area_empresa']."</p></td>
					<td class = 'separator'></td>
					<td colspan = '2' ><p><strong>CARGO</strong> ".$row['cargo_empleado']."</p></td>
				</tr>
				<tr>
					<td colspan = '2'><p><strong>TIPO </strong>".$row['tipo']."</p></td>
					<td class = 'separator'></td>
					<td colspan = '2' ><p><strong>PLATAFORMA</strong> ".$row['plataforma']."</p></td>
				</tr>
				</table>
				</br>
			<table class = 'tabla_nuevos_datos' width = '100%' id = 'caracteristicas_equipo'>
				<tr>
					<th colspan = '5'><strong>CARACTERÍSTICAS DEL EQUIPO</strong></th>
				</tr>
				<tr>
					<td colspan = '2' width = '40%'><p><strong>MARCA</strong> ".$row['marca']."</p></td>
					<td class = 'separator'></td>
					<td colspan = '2' width = '40%'><p><strong>CÓDIGO INV.</strong> ".$row['codigo']."</p></td>
				</tr>
				<tr>
					<td colspan = '2' width = '40%'><p><strong>MODELO</strong> ".$row['modelo']."</p></td>
					<td class = 'separator'></td>
					<td colspan = '2' width = '40%'><p><strong>SERIE</strong> ".$row['s_modelo']."</p></td>
				</tr>
				<tr>
					<td colspan = '2' width = '40%'><p><strong>MONITOR</strong> ".$row['monitor']."</p></td>
					<td class = 'separator'></td>
					<td colspan = '2' width = '40%'><p><strong>SERIE</strong> ".$row['s_monitor']."</p></td>
				</tr>
				<tr>
					<td colspan = '2' width = '40%'><p><strong>TECLADO</strong> ".$row['teclado']."</p></td>
					<td class = 'separator'></td>
					<td colspan = '2' width = '40%'><p><strong>SERIE</strong> ".$row['s_teclado']."</p></td>
				</tr>
				<tr>
					<td colspan = '2' width = '40%'><p><strong>MOUSE</strong> ".$row['mouse']."</p></td>
					<td class = 'separator'></td>
					<td colspan = '2' width = '40%'><p><strong>SERIE</strong> ".$row['s_mouse']."</p></td>
				</tr>
				</table>";
			}
			$estructura .="</table>";
			echo $estructura;
		}
	}
?>