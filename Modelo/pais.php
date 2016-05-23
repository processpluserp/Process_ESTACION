<?php
	class pais{
		public $npais;
		public $iniciales;
		
		public function get_pais(){
			return $this->npais;
		}
		public function set_pais($pais){
			$this->npais = $pais;
		}
		public function get_iniciales(){
			return $this->iniciales;
		}
		public function set_iniciales($ini){
			$this->iniciales = $ini;
		}
		
		public function insert_pais($usuario,$fecha){
			$insert = "insert into pais(nombre_pais,siglas_pais) ";
			$insert .="values ('".$this->get_pais()."','".$this->get_iniciales()."')";
			$result = mysql_query($insert);
			return "SE HA CREADO EL PAÍS ".$this->get_pais();
		}
		public function mostrar_relacion_ubicacion(){
			$tabla = "<table id = 'tabla_contenedor_info_ubicaciones' class = 'tablas_muestra_datos_tablas' width = '100%'>
				<tr>
					<th>PAÍS</th>
					<th>DEPARTAMENTO</th>
					<th>CIUDAD</th>
				</tr>";
			$consult_proveedor = "select p.nombre_pais, d.nombre_departamento, c.nombre_ciudad from pais p, departamento d, ciudad c where p.codigo_pais = d.pais_codigo_pais 
			and c.departamento_codigo_departamento = d.codigo_departamento";
			$result_proveedor = mysql_query($consult_proveedor);
			$n_registros = mysql_num_rows($result_proveedor);
			if($n_registros == 0){
				echo "<p class = 'resultado_gestion_consulta'>NO SE ENCONTRARON REGISTROS</p>";
			}else{
				while($row = mysql_fetch_array($result_proveedor)){
					$tabla .= "<tr id = ".$id.">
						<td>".$row['nombre_pais']."</td>
						<td>".$row['nombre_departamento']."</td>
						<td>".$row['nombre_ciudad']."</td>
					</tr>";
				}
				$tabla .="</table>";
				echo $tabla;
			}
		}
		public function mostrar_relacion_ubicacion_x_pais($p){
			$tabla = "<table id = 'tabla_contenedor_info_ubicaciones' class = 'tablas_muestra_datos_tablas' width = '100%'>
				<tr>
					<th>PAÍS</th>
					<th>DEPARTAMENTO</th>
					<th>CIUDAD</th>
				</tr>";
			$consult_proveedor = "select p.nombre_pais, d.nombre_departamento, c.nombre_ciudad from pais p, departamento d, ciudad c where 
			p.codigo_pais = d.pais_codigo_pais and p.nombre_pais like '%$p%' and c.departamento_codigo_departamento = d.codigo_departamento ";
			$result_proveedor = mysql_query($consult_proveedor);
			while($row = mysql_fetch_array($result_proveedor)){
				$tabla .= "<tr id = ".$id.">
					<td>".$row['nombre_pais']."</td>
					<td>".$row['nombre_departamento']."</td>
					<td>".$row['nombre_ciudad']."</td>
				</tr>";
			}
				$tabla .="</table>";
				echo $tabla;
		}
		
		public function mostrar_relacion_ubicacion_x_depto($p){
			$tabla = "<table id = 'tabla_contenedor_info_ubicaciones' class = 'tablas_muestra_datos_tablas' width = '100%'>
				<tr>
					<th>PAÍS</th>
					<th>DEPARTAMENTO</th>
					<th>CIUDAD</th>
				</tr>";
			$consult_proveedor = "select p.nombre_pais, d.nombre_departamento, c.nombre_ciudad from pais p, departamento d, ciudad c where 
			p.codigo_pais = d.pais_codigo_pais and c.departamento_codigo_departamento = d.codigo_departamento and d.nombre_departamento like '%$p%'";
			$result_proveedor = mysql_query($consult_proveedor);
			while($row = mysql_fetch_array($result_proveedor)){
				$tabla .= "<tr id = ".$id.">
					<td>".$row['nombre_pais']."</td>
					<td>".$row['nombre_departamento']."</td>
					<td>".$row['nombre_ciudad']."</td>
				</tr>";
			}
				$tabla .="</table>";
				echo $tabla;
		}
		
		public function mostrar_relacion_ubicacion_x_ciudad($p){
			$tabla = "<table id = 'tabla_contenedor_info_ubicaciones' class = 'tablas_muestra_datos_tablas' width = '100%'>
				<tr>
					<th>PAÍS</th>
					<th>DEPARTAMENTO</th>
					<th>CIUDAD</th>
				</tr>";
			$consult_proveedor = "select p.nombre_pais, d.nombre_departamento, c.nombre_ciudad from pais p, departamento d, ciudad c where 
			p.codigo_pais = d.pais_codigo_pais and c.departamento_codigo_departamento = d.codigo_departamento and c.nombre_ciudad like '%$p%'";
			$result_proveedor = mysql_query($consult_proveedor);
			while($row = mysql_fetch_array($result_proveedor)){
				$tabla .= "<tr id = ".$id.">
					<td>".$row['nombre_pais']."</td>
					<td>".$row['nombre_departamento']."</td>
					<td>".$row['nombre_ciudad']."</td>
				</tr>";
			}
				$tabla .="</table>";
				echo $tabla;
		}
	}
?>