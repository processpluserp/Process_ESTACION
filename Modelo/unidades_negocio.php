<?php
	class unidades_negocio{
		public $name;
		public $empresa;
		
		
		public function get_name(){
			return $this->name;
		}
		public function set_name($n){
			$this->name = strtoupper($n);
		}
		
		public function get_empresa(){
			return $this->empresa;
		}
		
		public function set_empresa($e){
			$this->empresa = $e;
		}
		
		public function update_name_und($cod){
			$nan = $this->get_name();
			$sql = mysql_query("update und set name = '$nan' where id = '$cod'");
		}
		
		public function insert_udn(){
			$sql = mysql_query("insert into und(name,empresa) values ('".$this->get_name()."','".$this->get_empresa()."')");
		}
		
		public function sql1($emp){
			$sql = mysql_query("select u.name,e.nombre_comercial_empresa,u.id
			from und u, empresa e
			where u.empresa = e.cod_interno_empresa and u.empresa = '$emp' order by u.name asc");
			return $sql;
		}
		
		public function tabla_unidades_de_negocio($sql){
			$est = "<table width = '100%' id = 'tabla_und' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<td>EMPRESA</td>
					<td>UNIDAD DE NEGOCIO</td>
					<td></td>
				</tr>";
			while($row = mysql_fetch_array($sql)){
				$id = $row['id'];
				$est .="<tr id = '$id'>
					<td>".$row['nombre_comercial_empresa']."</td>
					<td>".$row['name']."</td>
					<td>
						<img src = '../images/editar.png' onclick = 'editar_unidad_negocio($id)' class = 'botones'/>
					</td>
				</tr>";
			}
			echo $est.="</table>";
		}
		
		public function nombre_und($id){
			$sql = mysql_query("select name from und where id = '$id' order by name asc;");
			while($row =  mysql_fetch_array($sql)){
				echo  strtoupper($row['name']);
			}
		}
		
		public function select_unidades_negocio($emp){
			$sql = mysql_query("select id, name from und where empresa ='$emp' order by name asc;");
			$imp = "<option value = '0'></option>";
			while($row = mysql_fetch_array($sql)){
				$imp .="<option value = '".$row['id']."'>".$row['name']."</option>";
			}
			return $imp;
		}
		
		public function empleado_und($emp,$un,$periodo){
			$sql = "";
			if($un == 'all'){
				$sql = mysql_query("select e.documento_empleado, e.nombre_empleado 
			from empleado e, tablas_empleados te
			where e.documento_empleado = te.cedula and  te.empresa = '$emp' and te.periodo = '$periodo' order by e.nombre_empleado asc");
			}else{
				$sql = mysql_query("select e.documento_empleado, e.nombre_empleado 
			from empleado e, tablas_empleados te
			where e.documento_empleado = te.cedula and  te.empresa = '$emp' and te.und = '$un' and te.periodo = '$periodo' order by e.nombre_empleado asc");
			}
			
			$imp = "<option value = '0'></option>";
			while($row = mysql_fetch_array($sql)){
				$imp.="<option value = '".$row['documento_empleado']."'>".$row['nombre_empleado']."</option>";
			}
			echo $imp;
		}
		
		public function listar_und($emp){
			$imp = "<option value = '0'></option>";
			$sql = mysql_query("select distinct u.name, u.id
			from und u, tablas_empleados te
			where u.id = te.und and te.empresa = '$emp' order by u.name asc");
			while($row = mysql_fetch_array($sql)){
				$imp.="<option value = '".$row['id']."'>".$row['name']."</option>";
			}
			echo $imp;
		}
		public function listar_und2($emp){
			$imp = "<option value = '0'></option>";
			$sql = mysql_query("select distinct u.name, u.id
			from und u, tablas_empleados te
			where u.id = te.und and te.empresa = '$emp' order by u.name asc");
			while($row = mysql_fetch_array($sql)){
				$imp.="<option value = '".$row['id']."'>".$row['name']."</option>";
			}
			return $imp;
		}
		
		public function tabla_listar_und_empresa($emp){
			$class = "";
			$sql = mysql_query("select id,name from und where empresa = '$emp' order by name asc");
			$tabla = "<table width = '100%' style = 'padding-left:20px;font-size:12px;'>
				<tr>
					<th>NOMBRE</th>
				</tr>
				";
			$x = 1;
			while($row = mysql_fetch_array($sql)){
				if($x == 1){
					$class = 'oscuro_ppto_general';
					$x = 0;
				}else if($x == 0){
					$class = 'claro_ppto_general';
					$x = 1;
				}
				$id = $row['id'];
				$tabla .="<tr>
					<td class = '$class' id = 'undxx$id'>".$row['name']."</td>
					<td class = '$class' align = 'center'>
						<img src = '../images/iconos/icono_editar.png' onclick = 'editar_unidad_negociox($id)' width = '50px' />
					</td>
				</tr>";
			}
			return $tabla."</table>";
		}
		
		public function menu_administrar_unidades_negocio($emp,$tabla_consulta){
			$estructura = "<table width = '100%' >
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' >
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano' onclick = 'ocultar_consultar_und()'>UNIDADES DE NEGOCIO</td>
							<td align = 'left' ><img src = '../images/iconos/mas_blanco.png' width = '30px' onclick = 'ocultar_add_und_empresa()'/></td>
						</table>
					</th>
				</tr>
				<tr  class = 'hijo_und_negocio'>
					<td>$tabla_consulta</td>
				</tr>
				<tr >
					<th class='titulos_gestion_azul_x' align = 'left' >AGREGAR UNIDAD DE NEGOCIO</th>
				</tr>
				<tr style = 'display:none;' class ='hijo_add_und'>
					<td style = 'padding-left:20px;'>
						<table width = '100%' class = 'barra_busqueda'>
							<tr>
								<td>
									<p>Ingrese el Nombre de la Unidad de Negocio:</p>
									<input type = 'text' id = 'nombre_und_nueva_und'/>
								</td>
							</tr>
							<tr><td></br></td></tr>
							<tr>
								<td>
									<span class = 'botton_verde' onclick = 'add_unidad_negocio()'>Guardar</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>";
			echo $estructura;
		}
		
		public function empleado_x_unidad_negocio($emp,$un){
			$periodo = date("Y")."-".floatval(date("m"));
			$est ="<table width = '100%'>";
			$estx= "";
			$empleados = array();
			$trabajadores = array();
			
			$sql = mysql_query("select documento_empleado from empleado where pk_empresa = '$emp' and estado = '1' and und = '$un'");
			$i = 0;
			while($row = mysql_fetch_array($sql)){
				$empleados[$i][0] = $row['documento_empleado'];
				$empleados[$i][1] = '1';
				$i++;
			}
			$i = 0;
			$sql = mysql_query("select cedula from tablas_empleados where empresa = '$emp' and periodo = '$periodo' and und = '$un'");
			while($row = mysql_fetch_array($sql)){
				$trabajadores[$i] = $row['cedula'];
				$i++;
			}
			for($t = 0;$t < count($trabajadores);$t++){
				for($r = 0;$r < count($empleados);$r++){
					if($trabajadores[$t] == $empleados[$r][0]){
						$empleados[$r][1] = '0';
					}
				}
			}
			for($r = 0;$r < count($empleados);$r++){
				if($empleados[$r][1] == "1"){
					$x = $empleados[$r][0];
					$sql = mysql_query("select nombre_empleado, documento_empleado from empleado where pk_empresa = '$emp' and documento_empleado = '$x' and und = '$un'");
					while($row = mysql_fetch_array($sql)){
						$est .="<tr>
								<td>
									<div>
										<input type = 'checkbox' value = '".$row['documento_empleado']."' id = 'sel_empleado".$row['documento_empleado']."' name = 'empleados_seleccionado_carga[]' class = 'radio'/>
										<label for='sel_empleado".$row['documento_empleado']."'><span><span></span></span>".$row['nombre_empleado']."</label>
									</div>
								</td>
							</tr>";
					}
				}
				
			}
			echo $est."</table>";
		}
		
		public function listar_empleados($und){
			
		}
	}
?>
