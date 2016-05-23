<?php
	#Contiene la información sobre las áreas que tiene una determinada empresa.
	class departamento{
		
		public $narea;
		public $kempresa;
		public $codigo_area;
		public $und;
		
		#Modificadores de Acceso.
		public function get_codigo_areas_empresa(){
			return $this->codigo_area;
		}
		public function set_codigo_areas_empresa($codigo){
			$this->codigo_area = $codigo;
		}
		
		public function get_nombrearea(){
			return $this->narea;
		}
		public function set_nombrearea($area){
			$this->narea = strtoupper($area);
		}
		
		public function get_unidad_negocio(){
			return $this->und;
		}
		public function set_unidad_negocio($s){
			$this->und = $s;
		}
		
		public function get_empresa(){
			return $this->kempresa;
		}
		public function set_empresa($empresa){
			$this->kempresa = $empresa;
		}
		
		public function consulta_id_empresa($empresa){
			$consulta = "select * from area_empresa where pk_empresa_areas = '$empresa' order by nombre_area_empresa asc";
			$result = mysql_query($consulta);
			$contador = 0;
			while($row = mysql_fetch_array($result)){
				$contador++;
			}
			return $contador + 1;
		}
		
		public function sql_normal_deptos($emp){
			$sql = mysql_query("select a.codigo_interno_empresa, a.nombre_area_empresa, a.estado,u.name
			from area_empresa a, und u
			where a.pk_empresa_areas = '$emp' and a.pk_und = u.id order by a.nombre_area_empresa asc");
			return $sql;
		}
		
		public function sql_und_deptos($und,$emp){
			$sql = "";
			if($und == 0){
				$sql = mysql_query("select a.codigo_interno_empresa, a.nombre_area_empresa, a.estado,u.name
					from area_empresa a, und u
					where a.pk_empresa_areas = '$emp' and a.pk_und = u.id order by a.nombre_area_empresa asc");
			}else{
				$sql = mysql_query("select a.codigo_interno_empresa, a.nombre_area_empresa, a.estado,u.name
					from area_empresa a, und u
					where a.pk_und = '$und' and a.pk_empresa_areas = '$emp' and a.pk_und = u.id order by a.nombre_area_empresa asc");
			}
			
			return $sql;
		}
		
		public function nueva_estructura_areas_empresa($sql){
			
			$tabla = "<table width = '100%' style = 'padding-left:20px;padding-right:20px;font-size:12px;'>
				<tr>
					<th>Nombre</th>
					<th>Unidad Negocio</th>
					<th>Estado</th>
				</tr>";
			$x = 1;
			while($row = mysql_fetch_array($sql)){
				if($x == 1){
					$class = 'oscuro_ppto_general';
					$x = 0;
				}else if($x == 0){
					$class = 'claro_ppto_general';
					$x = 1;
				}
				$id = $row['codigo_interno_empresa'];
				$est = "";
				$editar = "";
				if($row['estado'] == 1){
					$est = "<img src = '../images/iconos/activo.png' height = '50px' onclick = 'update_estado_area_empresa(1,$id)'/>";
					$editar = "onclick = 'editar_nombre_departamento($id)'";
				}else{
					$est = "<img src = '../images/iconos/inactivo.png' height = '50px' onclick = 'update_estado_area_empresa(0,$id)'/>";
				}
				$tabla.="<tr>
					<td id = 'namedepto$id' class = '$class'>".$row['nombre_area_empresa']."</td>
					<td class = '$class'>".$row['name']."</td>
					<td class = '$class' align = 'center'>$est</td>
					<td class = '$class' align = 'center'>
						<img src = '../images/iconos/icono_editar.png' width ='45px' $editar/>
					</td>
				</tr>";
			}
			return $tabla."</table>";
		}
		
		public function listar_option_und($emp){
			$imp = "<option value = '0'>[SELECCIONE]</option>";
			$sql = mysql_query("select id,name from und where empresa = '$emp' order by name asc");
			while($row = mysql_fetch_array($sql)){
				$imp.="<option value = '".$row['id']."'>".$row['name']."</option>";
			}
			return $imp;
		}
		
		public function menu_administrar_departamentos($emp,$und,$tabla_deptos){
			$tabla = "<table width = '100%'>
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' >
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano' onclick = 'ocultar_consultar_areas()'>ÁREAS</td>
							<td align = 'left' ><img src = '../images/iconos/mas_blanco.png' width = '30px' onclick = 'ocultar_add_areas()'/></td>
						</table>
					</th>
				</tr>
				<tr  class = 'hijo_consultar_deptos'>
					<td>
						<table width = '100%' class = 'barra_busqueda'>
							<tr>
								<td style = 'padding-left:20px;'>
									<p>Seleccione una Unidad de negocio:</p>
									<select id = 'listado_und_empresa_area' onchange = 'listar_por_und_areas_empresa()'>$und</select>
								</td>
							</tr>
						</table>
						<div width = '100%' height = '100px' id = 'contenedor_departamentos_und_empresax'>
							$tabla_deptos
						</div>
					</td>
				</tr>
				
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' style = 'padding-left:20px;'>AGREAR ÁREA A UNIDAD DE NEGOCIO</th>
				</tr>
				<tr class ='hijo_add_deptos'style = 'display:none;'>
					<td>
						<table width = '100%' class = 'barra_busqueda' style = 'padding-left:20px;'>
							<tr>
								<td>
									<p>Seleccione una Unidad de Negocio:</p>
									<select id  = 'und_negocio_add_area'>$und</select>
								</td>
								<td>
									<p>Nombre Área:</p>
									<input type = 'text' id = 'name_area_nueva_und_empresa'/>
								</td>
							</tr>
							<tr><td></br></td></tr>
							<tr>
								<td>
									<span class = 'botton_verde' onclick = 'add_depto_und_empresa()'>Guardar</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			";
			echo $tabla;
		}
		
		public function estructura_tabla($result){
			$tabla = "<table id = 'tabla_depto_gestion' width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<td>EMPRESA</td>
					<td>UNIDAD DE NEGOCIO</td>
					<td>DEPARTAMENTO</td>
					<td>Estado</td>
					<td></td>
				</tr>";
			$x = 1;
			while($row = mysql_fetch_array($result)){
				
				$id = $row['codigo_interno_empresa'];
				$estado = "";
				if($row['estado'] == 1){
					$estado ="ACTIVO";
				}else{
					$estado = "INACTIVO";
				}
				$tabla .="<tr id = '$id'>
					<td>".$row['nombre_comercial_empresa']."</td>
					<td>".$row['name']."</td>
					<td>".$row['nombre_area_empresa']."</td>
					<td>".$estado."</td>
					<td><img src = '../images/' onclick = 'cambiar_estado_depto($id)' /></td>
					<td><img src = '../images/editar.png' onclick = 'cambiar_nombre_depto($id)' class = 'botones'/></td>
				</tr>";
			}
			$tabla .= "</table>";
			echo $tabla;
		}
		
		
		public function mostrar_datos($emp){
			$consulta = "select d.codigo_interno_empresa,d.nombre_area_empresa, d.estado,e.nombre_comercial_empresa,u.name
			from area_empresa d, empresa e, und u
			where d.pk_empresa_areas = e.cod_interno_empresa and e.cod_interno_empresa = '$emp' and d.pk_und  = u.id order by d.nombre_area_empresa,u.name asc";
			return mysql_query($consulta);
		}
		public function mostrar_datos_und($emp,$und){
			$consulta = "select d.codigo_interno_empresa,d.nombre_area_empresa, d.estado,e.nombre_comercial_empresa,u.name
			from area_empresa d, empresa e, und u
			where d.pk_empresa_areas = e.cod_interno_empresa and e.cod_interno_empresa = '$emp' and d.pk_und = '$und' and d.pk_und  = u.id order by d.nombre_area_empresa,u.name asc";
			return mysql_query($consulta);
		}
		
		public function select_mostrar_datos_und($emp,$und){
			$consulta = mysql_query("select d.codigo_interno_empresa,d.nombre_area_empresa, d.estado,e.nombre_comercial_empresa,u.name
			from area_empresa d, empresa e, und u
			where d.pk_empresa_areas = e.cod_interno_empresa and e.cod_interno_empresa = '$emp' and d.pk_und = '$und' and d.pk_und  = u.id order by d.nombre_area_empresa asc;");
			$imp = "<option value = '0'></option>";
			while($row = mysql_fetch_array($consulta)){
				$imp .="<option value = '".$row['codigo_interno_empresa']."'>".$row['nombre_area_empresa']."</option>";
			}
			echo $imp;
		}
		
		public function filtrar_empresa_depto($empresa){
			$consulta =  "select d.codigo_interno_empresa,d.nombre_area_empresa, d.estado,e.nombre_comercial_empresa 
			from area_empresa d, empresa e where d.pk_empresa_areas = e.cod_interno_empresa and e.nombre_comercial_empresa like '%$empresa%' order by d.nombre_area_empresa asc";
			return mysql_query($consulta);
		}
		
		public function filtrar_depto($depto){
			$consulta =  "select d.codigo_interno_empresa,d.nombre_area_empresa, d.estado,e.nombre_comercial_empresa 
			from area_empresa d, empresa e where d.pk_empresa_areas = e.cod_interno_empresa and d.nombre_area_empresa like '%$depto%' order by d.nombre_area_empresa asc";
			return mysql_query($consulta);
		}
		
		public function filtrar_id($id){
			$consulta =  "select d.codigo_interno_empresa,d.nombre_area_empresa, d.estado,e.nombre_comercial_empresa,u.name
			from area_empresa d, empresa e, und u
			where d.pk_empresa_areas = e.cod_interno_empresa and d.pk_und  = u.id and d.codigo_interno_empresa = '$id' order by d.nombre_area_empresa asc";
			return mysql_query($consulta);
		}
		
		public function insert_area_trabajo($usuario,$fecha){
			$estado = 1;
			$accion = "INSERT INTO area_empresa(nombre_area_empresa,pk_empresa_areas,estado,pk_und) ";
			$accion .= "values('".$this->get_nombrearea()."','".$this->get_empresa()."','".$estado."','".$this->get_unidad_negocio()."')";
			$result = mysql_query($accion);
		}
		
		public function modificar_estado($id,$estado){
			$update = "update area_empresa set estado = '$estado' where codigo_interno_empresa = '$id'";
			$result = mysql_query($update);
		}
		
		public function modificar_nombre_depto($id,$depto){
			$update = "update area_empresa set nombre_area_empresa = '$depto' where codigo_interno_empresa = '$id'";
			$result = mysql_query($update);
		}
		
		public function drop_area_trabajo(){
			
		}
		
	}
?>