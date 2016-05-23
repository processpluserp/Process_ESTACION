<?php
	class ceco{
		public $pk_empresa;
		public $estado;
		public $nombre;

		public function get_nombre(){
			return $this->nombre;
		}
		public function set_nombre($name){
			$this->nombre = $name;
		}
		public function get_estado(){
			return $this->estado;
		}
		public function set_estado($est){
			$this->estado = $est;
		}
		public function get_empresa(){
			return $this->pk_empresa;
		}
		public function set_empresa($emp){
			$this->pk_empresa = $emp;
		}
		
		public function insert_ceco($usuario,$fecha){
			$insert = "insert into ceco(codigo_empresa, estado,nombre,usuario, fecha_registro) 
			values ('".$this->get_empresa()."','".$this->get_estado()."','".$this->get_nombre()."','".$usuario."','".$fecha."')";
			$result = mysql_query($insert);
		}
		public function mostrar_datos(){
			$consulta = "select e.nombre_comercial_empresa, c.cod_interno_ceco, c.nombre, c.estado from ceco c, empresa e where e.cod_interno_empresa = c.codigo_empresa";
			$result = mysql_query($consulta);
			$tabla = "<table id = 'tabla_ceco_gestion_x' width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>Empresa</th>
					<th>Codigo</th>
					<th>Nombre CECO</th>
					<th>Estado</th>
					<th></th>
					<th></th>
				</tr>";
			while($row = mysql_fetch_array($result)){
				$id = $row['cod_interno_ceco'];
				$est = "";
				if($row['estado'] == 1){
					$est = "ACTIVO";
				}else{
					$est = "INACTIVO";
				}
				$tabla .= "<tr id ='$id'>
					<td>".$row['nombre_comercial_empresa']."</td>
					<td>".$row['cod_interno_ceco']."</td>
					<td>".$row['nombre']."</td>
					<td>".$est."</td>
					<td><img src = '../images/prueba.jpg' onclick = 'editar_ceco_gestion($id)'/></td>
					<td><img src = '../images/editar.png' onclick = 'editar_estado_ceco_gestion($id)' class = 'botones'/></td>
				</tr>";
			}
			$tabla .="</table>";
			echo $tabla;
		}
		
		public function mostrar_datos_filtrado($id){
		$consulta = "select e.nombre_comercial_empresa, c.cod_interno_ceco, c.nombre, c.estado from ceco c, empresa e where e.cod_interno_empresa = c.codigo_empresa and 
		c.cod_interno_ceco = '$id'";
			$result = mysql_query($consulta);
			$tabla = "<table id = 'tabla_ceco_gestion_x' width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>Empresa</th>
					<th>Codigo</th>
					<th>Nombre CECO</th>
					<th>Estado</th>
					<th></th>
					<th></th>
				</tr>";
			while($row = mysql_fetch_array($result)){
				$id = $row['cod_interno_ceco'];
				$est = "";
				if($row['estado'] == 1){
					$est = "ACTIVO";
				}else{
					$est = "INACTIVO";
				}
				$tabla .= "<tr id ='$id'>
					<td>".$row['nombre_comercial_empresa']."</td>
					<td>".$row['cod_interno_ceco']."</td>
					<td>".$row['nombre']."</td>
					<td>".$est."</td>
					<td><img src = '../images/prueba.jpg' onclick = 'editar_ceco_gestion($id)'/></td>
					<td><img src = '../images/editar.png' onclick = 'editar_estado_ceco_gestion($id)' class = 'botones'/></td>
				</tr>";
			}
			$tabla .="</table>";
			echo $tabla;
		}
		
		public function filtrar_datos_empresa($empresa){
			$consulta = "select e.nombre_comercial_empresa, c.cod_interno_ceco, c.nombre, c.estado from ceco c, empresa e where e.cod_interno_empresa = c.codigo_empresa and 
			e.nombre_comercial_empresa like '%$empresa%'";
			$result = mysql_query($consulta);
			$tabla = "<table id = 'tabla_ceco_gestion_x' width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>Empresa</th>
					<th>Codigo</th>
					<th>Nombre CECO</th>
					<th>Estado</th>
					<th></th>
					<th></th>
				</tr>";
			while($row = mysql_fetch_array($result)){
				$id = $row['cod_interno_ceco'];
				$est = "";
				if($row['estado'] == 1){
					$est = "ACTIVO";
				}else{
					$est = "INACTIVO";
				}
				$tabla .= "<tr id ='$id'>
					<td>".$row['nombre_comercial_empresa']."</td>
					<td>".$row['cod_interno_ceco']."</td>
					<td>".$row['nombre']."</td>
					<td>".$est."</td>
					<td><img src = '../images/prueba.jpg' onclick = 'editar_ceco_gestion($id)'/></td>
					<td><img src = '../images/editar.png' onclick = 'editar_estado_ceco_gestion($id)' class = 'botones'/></td>
				</tr>";
			}
			$tabla .="</table>";
			echo $tabla;
		}
		
		public function filtrar_datos_CECO($cco){
			$consulta = "select e.nombre_comercial_empresa, c.cod_interno_ceco, c.nombre, c.estado from ceco c, empresa e where e.cod_interno_empresa = c.codigo_empresa and 
			c.nombre like '%$cco%'";
			$result = mysql_query($consulta);
			$tabla = "<table id = 'tabla_ceco_gestion_x' width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>Empresa</th>
					<th>Codigo</th>
					<th>Nombre CECO</th>
					<th>Estado</th>
					<th></th>
					<th></th>
				</tr>";
			while($row = mysql_fetch_array($result)){
				$id = $row['cod_interno_ceco'];
				$est = "";
				if($row['estado'] == 1){
					$est = "ACTIVO";
				}else{
					$est = "INACTIVO";
				}
				$tabla .= "<tr id ='$id'>
					<td>".$row['nombre_comercial_empresa']."</td>
					<td>".$row['cod_interno_ceco']."</td>
					<td>".$row['nombre']."</td>
					<td>".$est."</td>
					<td><img src = '../images/prueba.jpg' onclick = 'editar_ceco_gestion($id)'/></td>
					<td><img src = '../images/editar.png' onclick = 'editar_estado_ceco_gestion($id)' class = 'botones'/></td>
				</tr>";
			}
			$tabla .="</table>";
			echo $tabla;
		}
		
		public function modificar_ceco($id){
			$update = "update ceco set nombre = '".$this->get_nombre()."' where cod_interno_ceco = '$id'";
			$result = mysql_query($update);
		}
		
		public function cambiar_estado_ceco($id,$est){
			$update = "update ceco set estado = '$est' where cod_interno_ceco = '$id'";
			$result = mysql_query($update);
		}
	}
	
	
?>