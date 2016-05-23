<?php
	class admin_trafico{
		//Asistentes
		private $nombre;
		
		//Cabecera tráfico
		private $empresa;
		private $fecha;
		private $numero_trafico;
		
		//Cuerpo Tráfico
		private $pk_trafico;
		private $asunto;
		private $descripcion;
		private $estatus;
		private $next;
		private $pendiente;
		
		//Acceso Asistentes
		public function get_nombre_asistente(){
			return $this->nombre;
		}
		public function set_nombre_asistente($name){
			$this->nombre = $name;
		}
		
		public function insert_asistente(){
			$insert = mysql_query("insert into asistentes(name) values ('".$this->get_nombre_asistente()."')");
		}
		
		//Acceso Cabecera tráfico.
		public function get_empresa(){
			return $this->empresa;
		}
		public function set_empresa($emp){
			$this->empresa = $emp;
		}
		public function get_fecha(){
			return $this->fecha;
		}
		public function set_fecha($fec){
			$this->fecha = $fec;
		}
		public function get_numero_trafico(){
			return $this->numero_trafico;
		}
		public function set_numero_trafico($numero){
			$this->numero_trafico = $numero;
		}
		public function consultar_numero_trafico(){
			$consulta = mysql_query("select empresa from trafico where empresa = '".$this->get_empresa()."'");
			$contador = 0;
			while($row = mysql_fetch_array($consulta)){
				$contador++;
			}
			return $contador+1;
		}
		public function insertar_datos_cabecera_trafico(){
			$this->set_numero_trafico($this->consultar_numero_trafico());
			$insert = mysql_query("insert into trafico(numero,fecha,empresa) values('".$this->get_numero_trafico()."','".
			$this->get_fecha()."','".$this->get_empresa()."')");
		}
		
		//Cuerpo Tráfico
		public function get_pk_trafico(){
			return $this->pk_trafico;
		}
		public function set_pk_trafico($traf){
			$this->pk_trafico = $traf;
		}
		public function get_asunto(){
			return $this->asunto;
		}
		public function set_asunto($asun){
			$this->asunto = $asun;
		}
		public function get_descripcion(){
			return $this->descripcion;
		}
		public function set_descripcion($desc){
			$this->descripcion = $desc;
		}
		public function get_estatus(){
			return $this->estatus;
		}
		public function set_estatus($est){
			$this->estatus = $est;
		}
		public function get_next(){
			return $this->next;
		}
		public function set_next($n){
			$this->next = $n;
		}
		public function get_pendiente(){
			return $this->pendiente;
		}
		public function set_pendiente($p){
			$this->pendiente = $p;
		}
		public function insert_cuerpo_trafico_asunto($id){
			$insert = mysql_query("insert into cuerpo_trafico(asunto) values('".$this->get_asunto()."')");
		}
		public function update_asunto($id){
			$insert = mysql_query("update cuerpo_trafico(asunto) values('".$this->get_asunto()."') where id = '$id'");
		}
		public function update_descripcion($id){
			$insert = mysql_query("update cuerpo_trafico(descripcion) values('".$this->get_descripcion()."') where id = '$id'");
		}
		public function update_estatus($id){
			$insert = mysql_query("update cuerpo_trafico(estatus) values('".$this->get_estatus()."') where id = '$id'");
		}
		public function update_next($id){
			$insert = mysql_query("update cuerpo_trafico(next) values('".$this->get_next()."') where id = '$id'");
		}
		
		public function estructura_trafico_asistentes($x){
			$tabla = "<table width = '100%' id  ='tabla_trafico'>
				<tr>
					<th></th>
					<th>No</th>
					<th>Asunto</th>
					<th>Descripción</th>
					<th>Estatus</th>
					<th>Paso a Seguir</th>
					<th>Departamento Responsable</th>
					<th>Responsables</th>
					<th>Fecha Entrega</th>
				</tr>";
			$consulta = mysql_query("select id, trafico,asunto,descripcion,estatus,next,fecha from cuerpo_trafico where
			trafico = '$x' order by id asc");
			$xx = 0;
			$xy = 1;
			while($row = mysql_fetch_array($consulta)){
				$iid = $row['id'];
				$est = $row['estatus'];
				$est_text = "";
				if($est == 1){
					$est_text = "PENDIENTE";
				}else{
					$est_text = "TERMINADO";
				}
				
				$cc = mysql_query("select d.id,d.name from departamentos d, depto_traficos dt where	d.id = dt.depto and dt.item = '$iid' and dt.trafico = '$x'");
				$deptos = "<table class = 'departamentos_por_item' id = 'listado_dept$xx' width = '100%' >";
				while($row2 = mysql_fetch_array($cc)){
					
					$y = $row2['id'];
					$deptos .= "<tr id = 'depto_$xx-$y'>
						<td>".$row2['name']."</td>
						<td><img src ='../img/eliminar.png' width = '10px' height = '10px' onclick = 'eliminar_departamento_item($xx,$y)' /></td>
					</tr>";
				}
				$deptos .="</table>";
				
				$responsables = "<table class = 'departamentos_por_item' id = 'listado_dept$xx' width = '100%' >";
				$cx = mysql_query("select a.id,a.name from asistentes a, responsable_trafico rt where a.id = rt.respon and rt.tarea = '$iid'");
				while($row2 = mysql_fetch_array($cx)){
					$y = $row2['id'];
					$responsables .= "<tr id = 'respon_$xx-$y'>
						<td>".$row2['name']."</td>
						<td><img src ='../img/eliminar.png' width = '10px' height = '10px' onclick = 'eliminar_responsable_item($xx,$y)' /></td>
					</tr>";
				}
				$responsables .="</table>";
				
				$desc = "";
				if($row['descripcion'] == ""){
					$desc = "";
				}else{
					$desc = $row['descripcion'];
				}
				$tabla .= "<tr id = 'fila$xx'>
					<td class = 'bordes'><img src = '../img/eliminar.png' width = '10px' height = '10px' id = '$iid' onclick = 'eliminar_item_trafico($iid,$xx)'/></td>
					<td class = 'bordes'>".$xy."</td>
					<td id = 'asunt$xx' class = 'bordes'>
						<span id = 'idreal$xx' class = 'hidde'>".($row['id'])."</span>
						<span id = 'asunto$xx' name = 'asunto$xx' ondblclick = 'editar_asunto($xx)'>".utf8_encode($row['asunto'])."</span>
					</td>
					<td id = 'desc$xx' ondblclick = 'editar_descripcion($xx)' class = 'bordes'>
						<div>
							<span id = 'descripcion$xx' name = 'descripcion$xx' >".utf8_encode($desc)."</span>
						</div>
					</td>
					<td class = 'bordes' id ='estat$xx' ondblclick = 'editar_estatus($xx)'>
						<div>
							<span id = 'estatus$xx' name = 'estatus$xx' >".$est_text."</span>
						</div>
					</td>
					<td class = 'bordes' id ='next$xx' ondblclick = 'editar_next($xx)'>
						<div>
							<span id = 'nex$xx' name = 'nex$xx' >".utf8_encode($row['next'])."</span>
						</div>
					</td>
					<td class = 'bordes'>
						<div id = 'deptos_responsables$xx' width = '100%'>
							$deptos
						</div>
						<div class = 'departamentos_add'>
							<table width = '100%'>
								<tr>
									<td>
										<input class = 'inputs' type = 'text' name = 'deptos$xx' id = 'deptos$xx' onkeyup = 'listar_deptos($xx)'/>
									</td>
									<td>
										<img src = '../img/eliminar.png' width = '10px' height = '10px' class = 'img' id = 'add_depto$xx' onclick = 'add_departamento($xx)'/>
									</td>
								</tr>
							</table>
						</div>
						<div id = 'lista_departamentos$xx' width = '100%'>
							
						</div>
					</td>
					<td class = 'bordes'>
						<div id = 'responsables$xx' width = '100%'>
							$responsables
						</div>
						<div class = 'departamentos_add'>
							<table width = '100%'>
								<tr>
									<td>
										<input class = 'inputs' type = 'text' name = 'respon$xx' id = 'respon$xx' onkeyup = 'listar_responsables($xx)'/>
									</td>
								</tr>
							</table>
						</div>
						<div id = 'lista_responsable$xx' width = '100%'>
							
						</div>
					</td>
					<td class = 'bordes' id ='fecha$xx' ondblclick = 'editar_fecha($xx)'>
						<div>
							<span id = 'fech$xx' name = 'fech$xx' >".utf8_encode($row['fecha'])."</span>
						</div>
					</td>
				</tr>";
				$xx++;
				$xy++;
			}
			$t = $xx + 100;
			for($i = $xx;$i < $t; $i++){
				$tabla .="<tr>
					<td class = 'bordes'></td>
					<td class = 'bordes'></td>
					<td class = 'bordes'  id = 'asunt$i' >
						<div class = 'contenedor_asunto' id = 'asun$i' ondblclick = 'agregar_asunto($i)' >
							<span></span>
						</div>
					</td>
					<td class = 'bordes'></td>
					<td class = 'bordes'></td>
					<td class = 'bordes'></td>
					<td class = 'bordes'></td>
					<td class = 'bordes'></td>
					<td class = 'bordes'></td>
				<tr>";
			}
			
			return $tabla;
		}
		
		public function validar_user($user,$pass){
			$pass = md5($pass);
			$sql = mysql_query("select id from user where name = '$user' and passw = '$pass'");
			
			if(mysql_num_rows($sql) == 0){
				return 0;
			}else{
				while($row = mysql_fetch_array($sql)){
					return $row['id'];
				}
			}
		}
		public function filtro($user){
			$sql_filtro = mysql_query("select distinct cliente from cuerpo_trafico where user = '$user' order by cliente asc");
			$list = "";
			while($row = mysql_fetch_array($sql_filtro)){
				$list .="<option value = '".$row['cliente']."'>".$row['cliente']."</option>";
			}
			return $list;
		}
		
		public function construct_trafic_fcliente($user,$cl){
			
			$est = "";
			$sql = "";
			if($cl == ""){
				$sql = mysql_query("select id, estado, user, cliente, producto, und, estatus, descr, inicio,asunto,fin from cuerpo_trafico where user = '$user' and estado = '0' order by cliente asc");
			}else{
				$sql = mysql_query("select id, estado, user, cliente, producto, und, estatus, descr, inicio,asunto,fin from cuerpo_trafico where user = '$user' and cliente = '$cl' and estado = '0' order by cliente asc");
			}
			
			while($row = mysql_fetch_array($sql)){
				$datetime1 = new DateTime($row['inicio']);
				$datetime2 = new DateTime($row['fin']);
				$interval = $datetime1->diff($datetime2);
				$est.= "<tr>
					<td>".($row['cliente'])."</td>
					<td>".($row['producto'])."</td>
					<td>".($row['und'])."</td>
					<td >".nl2br($row['asunto'])."</td>
					<td  >".nl2br($row['descr'])."</td>
					<td >".nl2br($row['estatus'])."</td>
					<td nowrap align = 'center'>".($row['inicio'])."</td>
					<td nowrap align = 'center'>".($row['fin'])."</td>
					<td nowrap align = 'center'>".$interval->format('%a Días')."</td>
				</tr>";
			}
			$est.="<tr>
						<td >
							<input type = 'text' class = 'cajas' id = 'cliente'/>
						</td>
						<td >
							<input type = 'text' class = 'cajas' id = 'producto'/>
						</td>
						<td >
							<input type = 'text' class = 'cajas' id = 'und'/>
						</td>
						<td >
							<input type = 'text' class = 'cajas' id = 'asunto'/>
						</td>
						<td >
							<textarea class ='cajas'   id = 'descc' rows = '4' cols = '45'></textarea>
						</td>
						<td >
							<input type = 'text' class = 'cajas' id = 'status'/>
						</td>
						<td>
							
						</td>
						<td >
							<input type = 'text' class = 'cajas' id = 'fecha_terminacion_compromiso'/>
						</td>
						<td>
							
						</td>
						<td style = 'border:0px;cursor:pointer;'>
							<img src = '../images/iconos/ok_verde.png' width = '25px' onclick = 'insert_cliente_trafic($user)'/>
						</td>
					</tr>";
			echo $est;
		}
	
		
		public function construct_trafic($user){
			
			$est = "";
			$sql = mysql_query("select id, estado, user, cliente, producto, und, estatus, descr, inicio,asunto,fin from cuerpo_trafico where user = '$user' and estado = '0' order by cliente asc");
			while($row = mysql_fetch_array($sql)){
				$id = $row['id'];
				$datetime1 = new DateTime($row['inicio']);
				$datetime2 = new DateTime($row['fin']);
				$interval = $datetime1->diff($datetime2);
				
				$est.= "<tr>
					<td style = 'vertical-align:middle;'>
						<img src = '../images/iconos/histo.png' style = 'border:0px;cursor:pointer;' width = '25px' onclick = 'historico($id)' title = 'Finalizar Tarea'/> ".($row['cliente'])."
					</td>
					<td>".($row['producto'])."</td>
					<td>".($row['und'])."</td>
					<td id = 'asunto$id'>".nl2br($row['asunto'])."</td>
					<td id = 'descr$id' >".nl2br($row['descr'])."</td>
					<td id = 'estatus$id'>".nl2br($row['estatus'])."</td>
					
					<td nowrap align = 'center'>".nl2br($row['inicio'])."</td>
					<td nowrap align = 'center' id = 'fin$id'>".($row['fin'])."</td>
					<td nowrap align = 'center'>".$interval->format('%a Días')."</td>
					<td style = 'border:0px;cursor:pointer;' id = 'icono_guardar$id'>
						<img src = '../images/iconos/icono_editar.png' width = '30px' id = 'mostrar$id' onclick = 'editar_pendiente($id)' title = 'Editar Tarea'/>
					</td>
					<td style = 'border:0px;cursor:pointer;' >
						<img src = '../images/iconos/fin.png' width = '30px' onclick = 'finalizar($id)' title = 'Finalizar Tarea'/>
					</td>
					<tr id = 'lin$id' style = 'display:none;padding-left:20px;'></tr>
				</tr>";
				$sql_historico = mysql_query("select * from cuerpo_trafico where pk_id = '$id' order by registro desc");
				$est.="
					<tr class = 'historio$id' style = 'display:none;'><td colspan = '9' style = 'border:0px;'></br></td></tr>
					<tr class = 'historio$id' style = 'display:none;'>
						<th colspan = '9'>HISTÓRICO</th>
					</tr>
					<tr class = 'historio$id' style = 'display:none;'><td style = 'border:0px;'></td></tr>
					<tr class = 'historio$id' style = 'display:none;'><td style = 'border:0px;'></td></tr>";
				while($row = mysql_fetch_array($sql_historico)){
					if($row['estado'] == 5){
						$est.= "<tr class = 'historio$id' style = 'display:none;'>
							<td style = 'vertical-align:middle;background-color:rgb(223, 223, 223);'>".($row['cliente'])."</td>
							<td style = 'background-color:rgb(240, 220, 14);'>".($row['producto'])."</td>
							<td style = 'background-color:rgb(240, 220, 14);'>".($row['und'])."</td>
							<td style = 'background-color:rgb(240, 220, 14);'>".nl2br($row['estatus'])."</td>
							<td style = 'background-color:rgb(240, 220, 14);'>".nl2br($row['descr'])."</td>
							<td style = 'background-color:rgb(240, 220, 14);'>".nl2br($row['asunto'])."</td>
							<td style = 'background-color:rgb(240, 220, 14);'nowrap align = 'center'>".nl2br($row['inicio'])."</td>
							<td style = 'background-color:rgb(240, 220, 14);' nowrap align = 'center'>".($row['fin'])."</td>
							<td style = 'background-color:rgb(240, 220, 14);' nowrap align = 'center'>".$row['registro']."</td>
						</tr>";
					}else{
						$est.= "<tr class = 'historio$id' style = 'display:none;'>
							<td style = 'vertical-align:middle;background-color:rgb(223, 223, 223);'>".($row['cliente'])."</td>
							<td style = 'background-color:rgb(223, 223, 223);'>".($row['producto'])."</td>
							<td  style = 'background-color:rgb(223, 223, 223);'>".($row['und'])."</td>
							<td  style = 'background-color:rgb(223, 223, 223);'>".nl2br($row['estatus'])."</td>
							<td  style = 'background-color:rgb(223, 223, 223);'>".nl2br($row['descr'])."</td>
							<td  style = 'background-color:rgb(223, 223, 223);'>".nl2br($row['asunto'])."</td>
							<td  style = 'background-color:rgb(223, 223, 223);'nowrap align = 'center'>".nl2br($row['inicio'])."</td>
							<td style = 'background-color:rgb(223, 223, 223);' nowrap align = 'center'>".($row['fin'])."</td>
							<td style = 'background-color:rgb(223, 223, 223);' nowrap align = 'center'>".$row['registro']."</td>
						</tr>";
					}
					
				}
				$est.="<tr class = 'historio$id' style = 'display:none;'><td colspan = '9' style = 'border:0px;'></br></td></tr><tr class = 'historio$id' style = 'display:none;'><td colspan = '9' style = 'border:0px;'></br></td></tr>";
			}
			$est.="<tr>
						<td >
							<input type = 'text' class = 'cajas' id = 'cliente'/>
						</td>
						<td >
							<input type = 'text' class = 'cajas' id = 'producto'/>
						</td>
						<td >
							<input type = 'text' class = 'cajas' id = 'und'/>
						</td>
						<td >
							<textarea type = 'text' class = 'cajas' id = 'asunto' rows = '4' cols = '40'></textarea>
						</td>
						<td >
							<textarea class ='cajas'   id = 'descc' rows = '4' cols = '40'></textarea>
						</td>
						<td >
							<textarea type = 'text' class = 'cajas' rows = '4' cols = '50' id = 'status'></textarea>
						</td>
						<td>
							
						</td>
						<td >
							<input type = 'text' class = 'cajas' id = 'fecha_terminacion_compromiso'/>
						</td>
						<td>
							
						</td>
						<td style = 'border:0px;cursor:pointer;'>
							<img src = '../images/iconos/ok_verde.png' width = '25px' onclick = 'insert_cliente_trafic($user)'/>
						</td>
					</tr>";
			echo $est;
		}
	
		public function construct_traficx($user){
			
			$estx = "";			
			$sql = mysql_query("select id, estado, user, cliente, producto, und, estatus, descr, inicio,asunto,fin from cuerpo_trafico where user = '$user' and estado = '0' order by cliente asc");
			$i = 1;
			while($row = mysql_fetch_array($sql)){
				$datetime1 = new DateTime($row['inicio']);
				$datetime2 = new DateTime($row['fin']);
				$interval = $datetime1->diff($datetime2);
				$estx.= "<tr>
					<td style = 'border:0px;background-color:white;text-align:center;'>$i</td>
					<td nowrap style = 'padding:4px;'>".($row['cliente'])."</td>
					<td nowrap>".($row['producto'])."</td>
					<td nowrap>".($row['und'])."</td>
					<td >".nl2br($row['asunto'])."</td>
					<td  >".nl2br($row['descr'])."</td>
					<td >".nl2br($row['estatus'])."</td>
					<td nowrap align = 'center'>".($row['inicio'])."</td>
					<td nowrap align = 'center'>".($row['fin'])."</td>
					<td nowrap align = 'center'>".$interval->format('%a Días')."</td>
				</tr>";
				$i++;
			}		
			
			return $estx;
		}
	
	}
?>