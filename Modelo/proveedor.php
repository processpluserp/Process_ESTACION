<?php
	
	class proveedor{
		public $meses = array("Enero", "Febrero", "Marzo",
        "Abril", "Mayo", "Junio", "Julio",
        "Agosto", "Septiembre", "Octubre",
        "Noviembre", "Diciembre");
		public $nit;
		public $ncomercial;
		public $nlegal;
		public $direccion;
		public $correo;
		public $telefono;
		public $fax;
		public $observaciones;
		public $usuario;
		public $fecha_registro;
		public $ciudad;
		public $depto;
		public $pais;
		public $estado;
		
		public function get_estado_proveedor(){
			return $this->estado;
		}
		public function set_estado_proveedor($est){
			$this->estado = $est;
		}
		
		public function get_nit_proveedor(){
			return $this->nit;
		}
		public function set_nit_proveedor($nnit){
			$this->nit = $nnit;
		}
		
		public function get_ncomercial_proveedor(){
			return $this->ncomercial;
		}
		public function set_ncomercial_proveedor($comercial){
			$this->ncomercial = strtoupper($comercial);
		}
		public function get_nlegal_proveedor(){
			return $this->nlegal;
		}
		public function set_nlegal_proveedor($legal){
			$this->nlegal = strtoupper($legal);
		}
		
		public function get_direccion_proveedor(){
			return $this->direccion;
		}
		public function set_direccion_proveedor($direc){
			$this->direccion = $direc;
		}
		
		public function get_correo_proveedor(){
			return $this->correo;
		}
		public function set_correo_proveedor($email){
			$this->correo = $email;
		}
		
		public function get_telefono_proveedor(){
			return $this->telefono;
		}
		public function set_telefono_proveedor($phone){
			$this->telefono = $phone;
		}
		
		public function get_fax_proveedor(){
			return $this->fax;
		}
		public function set_fax_proveedor($nfax){
			$this->fax = $nfax;
		}
		
		public function get_usuario_proveedor(){
			return $this->usuario;
		}
		public function set_usuario_proveedor($usu){
			$this->usuario = $usu;
		}
		public function get_fecha_registro_proveedor(){
			return $this->fecha_registro;
		}
		public function set_fecha_registro_proveedor($fr){
			$this->fecha_registro = $fr;
		}
		public function get_ciudad_proveedor(){
			return $this->ciudad;
		}
		public function set_ciudad_proveedor($city){
			$this->ciudad = $city;
		}
		
		public function get_depto_proveedor(){
			return $this->depto;
		}
		public function set_depto_proveedor($departamento){
			$this->depto = $departamento;
		}
		
		public function get_pais_proveedor(){
			return $this->pais;
		}
		public function set_pais_proveedor($valor){
			$this->pais = $valor;
		}
		
		public function listar_proveedores_nombre($name,$id_item,$id_real){
			$sql = mysql_query("select codigo_interno_proveedor,nombre_comercial_proveedor from proveedores where nombre_comercial_proveedor like '$name%'");
			$tabla = "<table width = 'auto'>";
			while($row = mysql_fetch_array($sql)){
				$x = $row['codigo_interno_proveedor'];
				$tabla.="<tr>
					<td>
						<div>
							<input type = 'checkbox' name = 'proveedores_n[]' id = 'provees$x' value = '".$row['codigo_interno_proveedor']."' class = 'radio' onclick = 'seleccionar_proveedor_item_ppto($x,$id_item,$id_real)'/>
							<label for='provees$x'><span><span></span></span>".$row['nombre_comercial_proveedor']."</label>
						</div>
					</td>";
			}
			echo $tabla."</table>";
		}
		
		public function update_proveedor_tarifario_item($item,$pro){
			mysql_query("update itempresup set proveedor = '$pro' where id = '$item'");
		}
		
		public function update_valor_item_ppto_cambio($estado,$item,$item_r,$valor,$valor_n){
			if($estado == 1){
				mysql_query("update item_tarifario set tarifa = '$valor_n' where id = '$item_r'");
				mysql_query("update itempresup set val_item = '$valor_n' where id = '$item'");
			}else{
				mysql_query("update itempresup set val_item = '$valor_n' where id = '$item'");
				
			}
		}
		
		public function crear_carpeta_proveedor(){
			$sql = mysql_query("select codigo_interno_proveedor from proveedores where nit_proveedor = '".$this->get_nit_proveedor()."'");
			$x = "";
			while($row = mysql_fetch_array($sql)){
				$x = $row['codigo_interno_proveedor'];
			}
			$destino = "../Process/PROVEEDOR/";
			if(file_exists($destino)){
				$destino ="../Process/PROVEEDOR/".$x;
				mkdir($destino);
				$destino ="../Process/PROVEEDOR/".$x."/DOCUMENTOS";
				mkdir($destino);
			}
			return $destino;
		}
		
		public function asociar_empresa_proveedor(){
			$imp = "";
			$sql = mysql_query("select cod_interno_empresa as codigo, nombre_comercial_empresa as nombre_legal_empresa from empresa where estado = '1'");
			$i = 0;
			while($row = mysql_fetch_array($sql)){
				$x = $row['codigo'];
				$imp .="<tr>
					<td style = 'padding-left:50px;'nowrap>
						<div>
							<input type = 'checkbox' name = 'empresas[]' id = 'empresas$x' value = '".$row['codigo']."' class = 'radio'/>
							<label for='empresas$x'><span><span></span></span>".$row['nombre_legal_empresa']."</label>
						</div>
				</tr>";
			$i++;
			}
			echo $imp;
		}
		
		public function consultar_si_documento($doc,$pro){
			$sql = mysql_query("select pk_proveedor from docle_proveedor where pk_proveedor = '$pro' and doc = '$doc'");
			return mysql_num_rows($sql);
		}
		
		public function insertar_nuevo_documento($doc,$pro,$arc,$usuario,$fecha){
			$sql = mysql_query("insert into docle_proveedor(doc,pk_proveedor,nombre_archivo,usuario,fecha)
			values('".$doc."','".$pro."','".$arc."','".$usuario."','".$fecha."')");
		}
		
		public function modificar_documento_proveedor($doc,$pro,$arc,$usuario,$fecha){
			$sql = mysql_query("update docle_proveedor set nombre_archivo = '$arc',usuario = '$usuario',fecha = '$fecha' where doc = '$doc' and pk_proveedor = '$pro'");
		}
		
		public function sql_documentos_proveedores($prov){
			$sql = mysql_query("select p.codigo_interno_proveedor, p.nit_proveedor, p.nombre_comercial_proveedor,p.nombre_legal_proveedor,
			d.pk_proveedor, d.doc, d.nombre_archivo
			from proveedores p, docle_proveedor d
			where p.codigo_interno_proveedor = d.pk_proveedor and d.pk_proveedor = '$prov'");
			return $sql;
		}
		
		public function listar_documentos_proveedores($sql){
			$est = "<table width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>NIT</th>
					<th>PROVEEDOR</th>
					<th>DOCUMENTO</th>
				</tr>
			";
			$i = 0;
			$class = "";
			while($row = mysql_fetch_array($sql)){
				if($i == 1){
					$class = "oscuro_ppto_general";
					$i = 0;
				}else if($i == 0){
					$class = "claro_ppto_general";
					$i = 1;
				}
				$doc = "";
				$arc = $row['nombre_archivo'];
				$pro = $row['codigo_interno_proveedor'];
				
				if($row['doc'] == 1){
					$doc = "CÁMARA Y COMERCIO";
				}else if($row['doc'] == 2){
					$doc = "RUT";
				}else if($row['doc'] == 3){
					$doc = "CONTRATO DE CONFIDENCIALIDAD";
				}else if($row['doc'] == 4){
					$doc = "CÉDULA";
				}else if($row['doc'] == 5){
					$doc = "CERTIFICACIÓN BANCARIA";
				}
				
				$est .="<tr class = '$class'>
					<td style = 'padding-left:10px;'>".$row['nit_proveedor']."</td>
					<td style = 'padding-left:10px;'>".$row['nombre_comercial_proveedor']."</td>
					<td style = 'padding-left:10px;'>$doc</td>
					<td align = 'center'>
						<a href = 'download_doc_proveedor.php?prove=$pro&archivo=$arc'>
							<img src = '../images/iconos/icono_descarga.png' class = 'icono_descarga'/>
						</a>							
					</td>
				</tr>";
			}
			echo $est."</table>";
		}
		
		public function sql_consulta_info_proveedor($emp){
			$sql = mysql_query("select p.codigo_interno_proveedor, p.nit_proveedor, p.nombre_comercial_proveedor,p.nombre_legal_proveedor,
			p.direccion_proveedor, p.telefono_proveedor, p.correo_proveedor,p.estado, c.nombre_ciudad, ac.estado, ac.codigo_asoc
			from proveedores p, ciudad c, asocproemp ac
			where c.codigo_ciudad = p.ciudad_codigo_ciudad and ac.pk_nit_proveedor_asoc = p.codigo_interno_proveedor and ac.pk_nit_empresa_asoc = '$emp' ORDER BY p.nombre_comercial_proveedor,p.nombre_legal_proveedor asc");
			return $sql;
		}
		public function sql_consulta_info_proveedor_nombre($emp,$name){
			$sql = mysql_query("select p.codigo_interno_proveedor, p.nit_proveedor, p.nombre_comercial_proveedor,p.nombre_legal_proveedor,
			p.direccion_proveedor, p.telefono_proveedor, p.correo_proveedor,p.estado, c.nombre_ciudad, ac.estado, ac.codigo_asoc
			from proveedores p, ciudad c, asocproemp ac
			where c.codigo_ciudad = p.ciudad_codigo_ciudad and ac.pk_nit_proveedor_asoc = p.codigo_interno_proveedor and ac.pk_nit_empresa_asoc = '$emp' and nombre_comercial_proveedor like '%$name%' ORDER BY p.nombre_comercial_proveedor asc");
			return $sql;
		}
		public function sql_consulta_info_proveedor_nit($emp,$nit){
			$sql = mysql_query("select p.codigo_interno_proveedor, p.nit_proveedor, p.nombre_comercial_proveedor,p.nombre_legal_proveedor,
			p.direccion_proveedor, p.telefono_proveedor, p.correo_proveedor,p.estado, c.nombre_ciudad, ac.estado, ac.codigo_asoc
			from proveedores p, ciudad c, asocproemp ac
			where c.codigo_ciudad = p.ciudad_codigo_ciudad and ac.pk_nit_proveedor_asoc = p.codigo_interno_proveedor and ac.pk_nit_empresa_asoc = '$emp' and nit_proveedor like '$nit%' ORDER BY p.nombre_comercial_proveedor asc");
			return $sql;
		}
		
		public function consultar_estado($pro){
			$estado = "";
			$sql = mysql_query("select estado from asocproemp where codigo_asoc = '$pro'");
			while($row = mysql_fetch_array($sql)){
				$estado = $row['estado'];
			}
			return $estado;
		}
	
		public function modificar_estado_proveedor($est,$pro){
			if($est == 1){
				$sql = mysql_query("update asocproemp set estado = '0' where codigo_asoc = '$pro'");
			}else{
				$sql = mysql_query("update asocproemp set estado = '1' where codigo_asoc = '$pro'");
			}
		}
		
		public function listar_proveedores($emp){
			$sql = mysql_query("select p.codigo_interno_proveedor, p.nombre_comercial_proveedor,p.nombre_legal_proveedor
			from proveedores p, asocproemp ac
			where ac.pk_nit_proveedor_asoc = p.codigo_interno_proveedor and ac.pk_nit_empresa_asoc = '$emp'");
			$imp = "<option value = '0'></option>";
			while($row = mysql_fetch_array($sql)){
				$imp .="<option value = '".$row['codigo_interno_proveedor']."'>".$row['nombre_comercial_proveedor']."</option>";
			}
			echo $imp;
		}
		
		public function estructura_info_proveedores($sql){
			$est = "<table width = '100%' class = 'tablas_muestra_datos_tablas display'>
				<thead>
					<tr>
						<th>NIT</th>
						<th>NOMBRE</th>
						<th>DIRECCIÓN</th>
						<th>TELÉFONO</th>
						<th>CORREO</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>";
			while($row = mysql_fetch_array($sql)){
				$id = $row['codigo_interno_proveedor'];
				$idx = $row['codigo_asoc'];
				$img = "";
				if($row['estado'] == 1){
					$img = "../images/iconos/activo.png";
				}else{
					$img = "../images/iconos/inactivo.png";
				}
				
				$est.= "
					<tr>
						<td nowrap>".$row['nit_proveedor']."</td>
						<td onclick = 'ver_info_proveedor($id)' class = 'mano'>".$row['nombre_comercial_proveedor']."</td>
						<td>".strtoupper($row['direccion_proveedor'])."</td>
						<td>".$row['telefono_proveedor']."</td>
						<td>".strtoupper($row['correo_proveedor'])."</td>
						<td align = 'center'>
							<img src= '../images/iconos/icono_documento.png' onclick = 'visualizar_documentos_proveedor($id)' class = 'botones_opciones' />
						</td>
						<td align = 'center'>
							<img src= '$img' onclick = 'cambiar_estado_proveedor($idx)' class = 'botones_opciones'/>
						</td>
					</tr>";
				
			}
			echo $est."</tbdoy></table>";
		}
		
		
		public function paises($id){
			$imp = "";
			$x = "";
			$sql = mysql_query("select nombre_pais, codigo_pais from pais");
			while($row = mysql_fetch_array($sql)){
				if($id == $row['codigo_pais']){
					$x = "<option value = '$id' selected>".$row['nombre_pais']."</option>";
				}else{
					$imp .= "<option value = '".$row['codigo_pais']."'>".$row['nombre_pais']."</option>";
				}
			}
			return $x.$imp;
		}
		
		public function pantalla_info_proveedor($prov){
			$est = "<";
			echo $est;
		}
		
		public function insert_acuerdo_confidencialidad_proveedor($file_name,$prov,$ffirma,$fterminacion){
			$tipo = 3;
			$sql = mysql_query("insert into(doc,nombre_archivo,fecha_firma,fecha_terminacion,pk_proveedor) 
			values('".$tipo."','".$file_name."','".$ffirma."','".
			$fterminacion."','".$prov."')");
		}
		
		public function mostrar_tabla_nuevo_proveedor($nit){
			$tabla = "<table id = 'tabla_contenedor_info_proveedores'>
						<tr>
							<th>Nit</th>
							<th>Nombre Legal</th>
							<th>Nombre Comercial</th>
							<th>Dirección</th>
							<th>Teléfono</th>
							<th>Correo</th>
							<th>Ciudad</th>
							<th>Estado</th>
						</tr>";
			$consult_proveedor = "select p.codigo_interno_proveedor, p.nit_proveedor, p.nombre_comercial_proveedor,p.nombre_legal_proveedor,
			p.direccion_proveedor, p.telefono_proveedor, p.correo_proveedor,p.estado, c.nombre_ciudad from proveedores p, ciudad c where 
			c.codigo_ciudad = p.ciudad_codigo_ciudad and p.nit_proveedor = '$nit'";
			$result_proveedor = mysql_query($consult_proveedor);
			while($row = mysql_fetch_array($result_proveedor)){
				$id = $row['codigo_interno_proveedor'];
				$estado = "";
				if($row['estado'] == 1){
					$estado = "ACTIVO";
				}else{
					$estado = "INACTIVO";
				}
				$tabla .= "<tr id = ".$id.">
					<td>".$row['nit_proveedor']."</td>
					<td>".$row['nombre_legal_proveedor']."</td>
					<td>".$row['nombre_comercial_proveedor']."</td>
					<td>".$row['direccion_proveedor']."</td>
					<td>".$row['telefono_proveedor']."</td>
					<td>".$row['correo_proveedor']."</td>
					<td>".$row['nombre_ciudad']."</td>
					<td>".$estado."</td>
					<td><img src = '../images/prueba.jpg' onclick = 'cambiar_estado_proveedor($id)'/></td>
					<td><img src = '../images/editar.png' onclick = 'editar_proveedor($id)' class = 'botones'/></td>
				</tr>";
			}
			$tabla .= "</table>";
			echo $tabla;
		}
		
		public function mostrar_proveedor_nit($nit){
			$tabla = "<table id = 'tabla_contenedor_info_proveedores'>
						<tr>
							<th>Nit</th>
							<th>Nombre Legal</th>
							<th>Nombre Comercial</th>
							<th>Dirección</th>
							<th>Teléfono</th>
							<th>Correo</th>
							<th>Ciudad</th>
							<th>Estado</th>
						</tr>";
			$consult_proveedor = "select p.codigo_interno_proveedor, p.nit_proveedor, p.nombre_comercial_proveedor,p.nombre_legal_proveedor,
			p.direccion_proveedor, p.telefono_proveedor,p.correo_proveedor, p.estado, c.nombre_ciudad from proveedores p, ciudad c where 
			c.codigo_ciudad = p.ciudad_codigo_ciudad and p.nit_proveedor like '%$nit%'";
			$result_proveedor = mysql_query($consult_proveedor);
			while($row = mysql_fetch_array($result_proveedor)){
				$id = $row['codigo_interno_proveedor'];
				$estado = "";
				if($row['estado'] == 1){
					$estado = "ACTIVO";
				}else{
					$estado = "INACTIVO";
				}
				$tabla .= "<tr id = ".$id.">
					<td>".$row['nit_proveedor']."</td>
					<td>".$row['nombre_legal_proveedor']."</td>
					<td>".$row['nombre_comercial_proveedor']."</td>
					<td>".$row['direccion_proveedor']."</td>
					<td>".$row['telefono_proveedor']."</td>
					<td>".$row['correo_proveedor']."</td>
					<td>".$row['nombre_ciudad']."</td>
					<td>".$estado."</td>
					<td><img src = '../images/prueba.jpg' onclick = 'cambiar_estado_proveedor($id)'/></td>
					<td><img src = '../images/editar.png' onclick = 'editar_proveedor($id)' class = 'botones'/></td>
				</tr>";
			}
			$tabla .= "</table>";
			echo $tabla;
		}
		
		public function mostrar_proveedor_nombre($nombre){
			$tabla = "<table id = 'tabla_contenedor_info_proveedores'>
						<tr>
							<th>Nit</th>
							<th>Nombre Legal</th>
							<th>Nombre Comercial</th>
							<th>Dirección</th>
							<th>Teléfono</th>
							<th>Correo</th>
							<th>Ciudad</th>
							<th>Estado</th>
						</tr>";
			$consult_proveedor = "select p.codigo_interno_proveedor, p.nit_proveedor, p.nombre_comercial_proveedor,p.nombre_legal_proveedor,
			p.direccion_proveedor, p.telefono_proveedor, p.correo_proveedor,p.estado, c.nombre_ciudad from proveedores p, ciudad c where 
			c.codigo_ciudad = p.ciudad_codigo_ciudad and p.nombre_legal_proveedor like '%$nombre%'";
			$result_proveedor = mysql_query($consult_proveedor);
			while($row = mysql_fetch_array($result_proveedor)){
				$id = $row['codigo_interno_proveedor'];
				$estado = "";
				if($row['estado'] == 1){
					$estado = "ACTIVO";
				}else{
					$estado = "INACTIVO";
				}
				$tabla .= "<tr id = ".$id.">
					<td>".$row['nit_proveedor']."</td>
					<td>".$row['nombre_legal_proveedor']."</td>
					<td>".$row['nombre_comercial_proveedor']."</td>
					<td>".$row['direccion_proveedor']."</td>
					<td>".$row['telefono_proveedor']."</td>
					<td>".$row['correo_proveedor']."</td>
					<td>".$row['nombre_ciudad']."</td>
					<td>".$estado."</td>
					<td><img src = '../images/prueba.jpg' onclick = 'cambiar_estado_proveedor($id)'/></td>
					<td><img src = '../images/editar.png' onclick = 'editar_proveedor($id)' class = 'botones'/></td>
				</tr>";
			}
			$tabla .= "</table>";
			echo $tabla;
		}
		
		public function mostrar_tabla_todos_proveedor(){
			$tabla = "<table id = 'tabla_contenedor_info_proveedores'>
						<tr>
							<th>Nit</th>
							<th>Nombre Legal</th>
							<th>Nombre Comercial</th>
							<th>Dirección</th>
							<th>Teléfono</th>
							<th>Correo</th>
							<th>Ciudad</th>
							<th>Estado</th>
						</tr>";
			$consult_proveedor = "select p.codigo_interno_proveedor, p.nit_proveedor, p.nombre_comercial_proveedor,p.nombre_legal_proveedor,
			p.direccion_proveedor, p.telefono_proveedor, p.correo_proveedor,p.estado, c.nombre_ciudad from proveedores p, ciudad c where 
			c.codigo_ciudad = p.ciudad_codigo_ciudad";
			$result_proveedor = mysql_query($consult_proveedor);
			$n_registros = mysql_num_rows($result_proveedor);
			if($n_registros == 0){
				echo "<p class = 'resultado_gestion_consulta'>NO SE ENCONTRARON REGISTROS</p>";
			}else{
				while($row = mysql_fetch_array($result_proveedor)){
					$id = $row['codigo_interno_proveedor'];
					$estado = "";
					if($row['estado'] == 1){
						$estado = "ACTIVO";
					}else{
						$estado = "INACTIVO";
					}
					$tabla .= "<tr id = ".$id.">
						<td>".$row['nit_proveedor']."</td>
						<td>".$row['nombre_legal_proveedor']."</td>
						<td>".$row['nombre_comercial_proveedor']."</td>
						<td>".$row['direccion_proveedor']."</td>
						<td>".$row['telefono_proveedor']."</td>
						<td>".$row['correo_proveedor']."</td>
						<td>".$row['nombre_ciudad']."</td>
						<td>".$estado."</td>
						<td><img src = '../images/prueba.jpg' onclick = 'cambiar_estado_proveedor($id)'/></td>
						<td><img src = '../images/editar.png' onclick = 'editar_proveedor($id)' class = 'botones'/></td>
					</tr>";
				}
				$tabla .= "</table>";
				echo $tabla;
			}
		}
		
		public function insert_proveedor(){
			$consulta = "INSERT INTO proveedores(nit_proveedor, nombre_comercial_proveedor,nombre_legal_proveedor,direccion_proveedor,
			correo_proveedor,telefono_proveedor,fax_proveedor,usuario,fecha_registro,ciudad_codigo_ciudad,ciudad_departamento_codigo_departamento,
			ciudad_departamento_pais_codigo_pais,estado) ";
			$consulta .="values('".$this->get_nit_proveedor()."','".$this->get_ncomercial_proveedor()."','".$this->get_nlegal_proveedor()."','".$this->get_direccion_proveedor()."','".
			$this->get_correo_proveedor()."','".$this->get_telefono_proveedor()."','".$this->get_fax_proveedor()."','".$this->get_usuario_proveedor()."','".
			$this->get_fecha_registro_proveedor()."','".$this->get_ciudad_proveedor()."','".$this->get_depto_proveedor()."','".$this->get_pais_proveedor()."','".$this->get_estado_proveedor()."')";
			$result = mysql_query($consulta);
		}
		
		public function modificar_proveedor(){
			$update = "update proveedores set nombre_legal_proveedor = '".$this->get_nlegal_proveedor()."', nombre_comercial_proveedor = '".
			$this->get_ncomercial_proveedor()."',correo_proveedor = '".$this->get_correo_proveedor()."', direccion_proveedor = '".$this->get_direccion_proveedor()."', telefono_proveedor = '".$this->get_telefono_proveedor()."', 
			usuario = '".$this->get_usuario_proveedor()."', fecha_registro = '".$this->get_fecha_registro_proveedor()."' where nit_proveedor = '".$this->get_nit_proveedor()."'";
			$result = mysql_query($update);
		}
		
		public function mostrar_cambio_estado_proveedor($id){
			$tabla = "<table id = 'tabla_contenedor_info_proveedores'>
						<tr>
							<th>Nit</th>
							<th>Nombre Legal</th>
							<th>Nombre Comercial</th>
							<th>Dirección</th>
							<th>Teléfono</th>
							<th>Correo</th>
							<th>Ciudad</th>
							<th>Estado</th>
						</tr>";
			$consult_proveedor = "select p.codigo_interno_proveedor, p.nit_proveedor, p.nombre_comercial_proveedor,p.nombre_legal_proveedor,
			p.direccion_proveedor, p.telefono_proveedor, p.correo_proveedor,p.estado, c.nombre_ciudad from proveedores p, ciudad c where 
			c.codigo_ciudad = p.ciudad_codigo_ciudad and p.codigo_interno_proveedor = '$id'";
			$result_proveedor = mysql_query($consult_proveedor);
			while($row = mysql_fetch_array($result_proveedor)){
				$id = $row['codigo_interno_proveedor'];
				$estado = "";
				if($row['estado'] == 1){
					$estado = "ACTIVO";
				}else{
					$estado = "INACTIVO";
				}
				$tabla .= "<tr id = ".$id.">
					<td>".$row['nit_proveedor']."</td>
					<td>".$row['nombre_legal_proveedor']."</td>
					<td>".$row['nombre_comercial_proveedor']."</td>
					<td>".$row['direccion_proveedor']."</td>
					<td>".$row['telefono_proveedor']."</td>
					<td>".$row['correo_proveedor']."</td>
					<td>".$row['nombre_ciudad']."</td>
					<td>".$estado."</td>
					<td><img src = '../images/prueba.jpg' onclick = 'cambiar_estado_proveedor($id)'/></td>
					<td><img src = '../images/editar.png' onclick = 'editar_proveedor($id)' class = 'botones'/></td>
				</tr>";
			}
			$tabla .= "</table>";
			echo $tabla;
		}
		
		public function cambiar_estado_proveedor($estado,$nit){
			$consulta = "update proveedores set estado = '$estado' where nit_proveedor = '$nit'";
			$r = mysql_query($consulta);
		}
		
		public function insertar_contactos_proveedor($a,$b,$c,$d,$e,$f,$g,$h){
			$sql = mysql_query("insert into contactos_proveedor(nombre,cargo,phone,correo,celular,mes,dia,proveedor)
			values ('".strtoupper($a)."','".strtoupper($b)."','".$c."','".$d."','".$e."','".$f."','".$g."','".$h."')");
		}
		
		public function sql_listar_contactos($pro){
			$sql = mysql_query("select id, nombre,cargo,phone,correo,celular,mes,dia
			from contactos_proveedor where proveedor = '$pro'");
			return $sql;
		}
		
		public function mostrar_contactos_proveedor($sql){

			$est = "<table width = '100%' class = 'tablas_muestra_datos_tablas'>
				<th>NOMBRE</th>
				<th>CARGO</th>
				<th>TELÉFONO</th>
				<th>CELULAR</th>
				<th>CORREO</th>
				<th>MES</th>
				<th>DÍA</th>
			";
			while($row = mysql_fetch_array($sql)){
				$mxmes = "";
				if(floatval($row['mes']) == 0){
					$mxmes = 'SIN MES';
				}else{
					$mxmes =$this->meses[floatval($row['mes'])-1]; 
				}
				
				$id = $row['id'];
				$est .= "<tr>
						<td id = 'cname$id'>".$row['nombre']."</td>
						<td id = 'ccargo$id'>".$row['cargo']."</td>
						<td id = 'cphone$id'>".$row['phone']."</td>
						<td id = 'ccelular$id'>".$row['celular']."</td>
						<td id = 'ccorreo$id'>".$row['correo']."</td>
						<td >".$mxmes."</td>
						<td >".$row['dia']."</td>
						<td id = 'icono_editar$id' align = 'center'>
							<img src ='../images/iconos/icono_editar.png' onclick = 'editar_contacto_proveedor($id)' class = 'botones_opciones'/>
						</td>
					</tr>";
				
			}
			echo $est."</table>";
		}
		
		public function guardar_grupo($name,$usuario,$fecha){
			$sql = mysql_query("insert into grupo_tarifario(name,usuario,fecha) values('".strtoupper($name)."','".$usuario."','".$fecha."')");
		}
		
		public function guardar_subgrupo($name,$grupo,$usuario,$fecha){
			$sql = mysql_query("insert into subgrpr(name,pk_grupo,usuario,fecha) values('".strtoupper($name)."','".$grupo."','".$usuario."','".$fecha."')");
		}
		
		public function listar_grupos(){
			$sql = mysql_query("select id,name from grupo_tarifario WHERE length(name) > 2");
			$imp = "<option value = '0'></option>";
			while($row = mysql_fetch_array($sql)){
				$imp.="<option value = '".$row['id']."'>".$row['name']."</option>";
			}
			echo $imp;
		}
		
		public function listar_subgrupos($id){
			$sql = mysql_query("select id,name from subgrpr where pk_grupo = '$id'");
			$imp = "<option value = '0'></option>";
			while($row = mysql_fetch_array($sql)){
				$imp.="<option value = '".$row['id']."'>".$row['name']."</option>";
			}
			echo $imp;
		}
		
		public function guardar_item($item,$iva,$val,$vol,$subg,$grupo,$adici){
			$pro = 272;
			$sql = mysql_query("insert into  item_tarifario(name,pk_subgrupo,grupo,tarifa,iva,volumen,adicional,proveedor) values('".
			$item."','".$subg."','".$grupo."','".$val."','".$iva."','".$vol."','".$adici."','".$pro."')");
		}
		
		public function update_contacto_proveedor($id,$datos){
			mysql_query("update contactos_proveedor set nombre = '".$datos[0]."', cargo ='".$datos[1]."', phone = '".$datos[2]."',
			correo = '".$datos[3]."', celular = '".$datos[4]."' where id = '$id'");
		}
		
		public function sql_contratos($id){
			$sql = "";
			if($id == ""){
				$sql = mysql_query("select dp.id_dlprove,dp.nombre_archivo,dp.fecha_firma,dp.fecha_terminacion, dp.fecha_fin_real
				from docle_proveedor dp, proveedores p
				where dp.pk_proveedor = p.codigo_interno_proveedor");
			}else{
				$sql = mysql_query("select dp.id_dlprove,dp.nombre_archivo,dp.fecha_firma,dp.fecha_terminacion, dp.fecha_fin_real
				from docle_proveedor dp, proveedores p
				where dp.pk_proveedor = p.codigo_interno_proveedor and p.codigo_interno_proveedor = '$id'");
			}
			return $sql;
		}
		public function info_basica_proveedor_ubicacion($id){
			$sql = mysql_query("select p.nombre_pais, d.nombre_departamento, c.nombre_ciudad,d.codigo_departamento,c.departamento_codigo_departamento, e.ciudad_codigo_ciudad,
			c.codigo_ciudad,d.pais_codigo_pais,p.codigo_pais,e.ciudad_departamento_pais_codigo_pais,e.ciudad_departamento_codigo_departamento
			from proveedores e, ciudad c, departamento d, pais p
			where e.codigo_interno_proveedor = '$id' and e.ciudad_codigo_ciudad = c.codigo_ciudad and 
			c.departamento_codigo_departamento = d.codigo_departamento and d.pais_codigo_pais = p.codigo_pais");
			return $sql;
		}
		
		public function editar_info_proveedor($id,$emp,$sql_ubicacion,$empresa){
			$ubicacion = "";
			if(mysql_num_rows($sql_ubicacion) == 0){
				$ubicacion .="
					<td><select id = 'n_pais_empresax' onchange = 'cambiar_pais_empresa()' onclick = 'limpiar_pais(".$row['ciudad_departamento_pais_codigo_pais'].")'>".$this->paises(0)."</select></td>
					<td><select id = 'n_depto_empresax' onchange = 'cargar_ciudad()'><option value = '0'>-</option></td>
					<td><select id = 'n_ciudad_empresax'><option value = '0'>-</option></td>
				";
			}else{
				while($row = mysql_fetch_array($sql_ubicacion)){
					$ubicacion .="
					<td><select name = 'n_pais_empresax' onchange = 'cambiar_pais_empresa()' onclick = 'limpiar_pais(".$row['ciudad_departamento_pais_codigo_pais'].")'>".$this->paises($row['ciudad_departamento_pais_codigo_pais'])."</select></td>
					<td><select name = 'n_depto_empresax' onchange = 'cargar_ciudad()'><option value = '".$row['ciudad_departamento_codigo_departamento']."'>".$row['nombre_departamento']."</option></td>
					<td><select name = 'n_ciudad_empresax'><option value = '".$row['ciudad_codigo_ciudad']."'>".$row['nombre_ciudad']."</option></td>";
				}
			}
			$sql =  mysql_query("select p.codigo_interno_proveedor, p.nit_proveedor, p.nombre_comercial_proveedor,p.nombre_legal_proveedor,
			p.direccion_proveedor, p.telefono_proveedor, p.correo_proveedor,p.estado, c.nombre_ciudad, ac.estado, ac.codigo_asoc
			from proveedores p, ciudad c, asocproemp ac
			where c.codigo_ciudad = p.ciudad_codigo_ciudad and ac.pk_nit_proveedor_asoc = p.codigo_interno_proveedor and ac.pk_nit_empresa_asoc = '$emp' and p.codigo_interno_proveedor = '$id'");
			$est = "";
			while($row = mysql_fetch_array($sql)){
				$est .= "<div class = 'scroll_nueva_ventana'>
						<table width = '100%' style = 'padding-left:50px;padding-right:50px;' >
							<tr>
								<td width = '96%'>
									<table width = '100%' >
										<tr>
											<td align = 'left'>
												".$empresa->mostrar_logo_empresa2($emp)."
											</td>
										</tr>
										<tr>
											<td align = 'left' >
												<span class = 'mensaje_bienvenida'>".$row['nombre_comercial_proveedor']."</span>
											</td>
										</tr>
									</table>
								</td>
								<td align = 'right' >
									<table width ='100%'>
										<tr>
											<td align = 'center'>
												<img src = '../images/iconos/cerrar.png' class = 'iconos_opciones' onclick = 'cerrar_ventana_info_d()'/>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						</br>
						<form id = 'form_actualiza_proveedor'>
						<table width = '100%' class = 'tabla_nuevos_datos2' style = 'padding-right:50px;'>
							<tr>
								<th style = 'padding-left:50px;' align = 'left' width = '49%' colspan = '2'>LEGALES</th>
								<td class = 'separator'></td>
								<th align = 'left' width = '49%' colspan = '2'>UBICACIÓN</th>
							</tr>
							<tr>
								<td style = 'padding-left:50px;' colspan = '2'>
									<p>Razón Social:</p>
									<input type = 'text' class = 'entradas_bordes' name = 'n_ncomercial_proveedore' value = '".$row['nombre_comercial_proveedor']."' />
								</td>
								<td class = 'separator'></td>
								<td colspan = '2'>
									<table width = '100%'>
										<tr>
											<td >
												$ubicacion
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style = 'padding-left:50px;' colspan = '2'>
									<p>Nombre Legal:</p>
									<input type = 'text' class = 'entradas_bordes' name = 'n_nlegal_proveedore' value = '".$row['nombre_legal_proveedor']."' />
								</td>
								<td class = 'separator'></td>
								<td>
									<p>Dirección:</p>
									<input type = 'text' class = 'entradas_bordes' name = 'n_direccion_proveedore' value = '".$row['direccion_proveedor']."' />
								</td>
								<td>
									<p>Teléfono:</p>
									<input type = 'text' class = 'entradas_bordes' name = 'n_telefono_proveedore' value = '".$row['telefono_proveedor']."' />
								</td>
							</tr>
							<tr>
								<td style = 'padding-left:50px;' colspan = '2'>
									<p>Nit:</p>
									<input type = 'text' class = 'entradas_bordes' name = 'n_nit_proveedore' value = '".$row['nit_proveedor']."' readonly/>
								</td>
								<td class = 'separator'></td>
								<td>
									<p>Correo:</p>
									<input type = 'text' class = 'entradas_bordes' name = 'n_correo_proveedore' value = '".$row['correo_proveedor']."' />
								</td>
							</tr>
							<tr><td></br></td></tr>
							<tr><td></br></td></tr>
							<tr>
								<th  style = 'padding-left:50px;' colspan = '5' align = 'left'>ASOCIACIÓN</th>
							</tr>
							<tr><td></br></td></tr>";
				$codigos_empresa = "";
				$sql_asoc = mysql_query("select e.nombre_comercial_empresa,e.cod_interno_empresa
				from empresa e, asocproemp ax
				where e.cod_interno_empresa = ax.pk_nit_empresa_asoc and ax.pk_nit_proveedor_asoc = '$id'");
				while($xrow = mysql_fetch_array($sql_asoc)){
					$xcd = $xrow['cod_interno_empresa'];
					$codigos_empresa .= "and cod_interno_empresa <> '$xcd'";
					$est.="<tr>
						<td style = 'padding-left:50px;'>".$xrow['nombre_comercial_empresa']."</td>
					</tr>";
				}
				$sql_asoc = mysql_query("select nombre_comercial_empresa,cod_interno_empresa
				from empresa 
				where estado = '1' $codigos_empresa");
				while($xrow = mysql_fetch_array($sql_asoc)){
					$ide = $xrow['cod_interno_empresa'];
					$est.="<tr>
						<td style = 'padding-left:40px;'>
							<div><input type = 'checkbox' name = 'empresasx[]' id = 'empresasx$ide' value = '".$xrow['cod_interno_empresa']."' class = 'radio'/>
							<label for='empresasx$ide'><span><span></span></span>".$xrow['nombre_comercial_empresa']."</label></div>
						</td>
					</tr>";
				}
				$est.="</form><tr>
					<td colspan = '5' align ='center'>
						<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' onclick = 'ver_info_proveedor($id)' style = 'position:relative;'>
						<img src = '../images/iconos/guardar_1.png' class = 'iconos_guardar_x'   style = 'position:relative;top:45px;left:-50px;z-index:1;opacity:'>
						<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' onclick = 'modificar_informacion_proveedor($id)' style = 'position:relative;left:-110px;'>
					</td>
				</tr>";
				$est.="</table>
					</div>";
			}
			echo $est;
		}
		
		public function mostrar_info_proveedor_detalle($id,$emp,$sql_ubicacion,$empresa){
			$sql =  mysql_query("select p.codigo_interno_proveedor, p.nit_proveedor, p.nombre_comercial_proveedor,p.nombre_legal_proveedor,
			p.direccion_proveedor, p.telefono_proveedor, p.correo_proveedor,p.estado, c.nombre_ciudad, ac.estado, ac.codigo_asoc
			from proveedores p, ciudad c, asocproemp ac
			where c.codigo_ciudad = p.ciudad_codigo_ciudad and ac.pk_nit_proveedor_asoc = p.codigo_interno_proveedor and ac.pk_nit_empresa_asoc = '$emp' and p.codigo_interno_proveedor = '$id'");
			$ubicacion = "<p>País - Departamento - Ciudad</p>";
			if(mysql_num_rows($sql_ubicacion) == 0){
				$ubicacion .="<input type = 'text' value = 'SIN REGISTROS' readonly/>";
			}else{
				while($row = mysql_fetch_array($sql_ubicacion)){
					$ubicacion .="<input type = 'text' value = '".$row['nombre_pais']." - ".$row['nombre_departamento']." - ".$row['nombre_ciudad']."' readonly/>";
				}
			}
			$est = "";
			while($row = mysql_fetch_array($sql)){
				$est .= "<div class = 'scroll_nueva_ventana'>
						<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
							<tr>
								<td width = '96%'>
									<table width = '100%' >
										<tr>
											<td align = 'left'>
												".$empresa->mostrar_logo_empresa2($emp)."
											</td>
										</tr>
										<tr>
											<td align = 'left' >
												<span class = 'mensaje_bienvenida'>".$row['nombre_comercial_proveedor']."</span>
											</td>
										</tr>
									</table>
								</td>
								<td align = 'right' >
									<table width ='100%'>
										<tr>
											<td align = 'center'>
												<img src = '../images/iconos/icono_editar.png' class = 'iconos_opciones' onclick = 'editar_info_proveedor_v($id)'/>
											</td>
											<td align = 'center'>
												<img src = '../images/iconos/cerrar.png' class = 'iconos_opciones' onclick = 'cerrar_ventana_info_d()'/>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						</br>
						<table width = '100%' class = 'tabla_nuevos_datos2' style = 'padding-right:50px;'>
							<tr>
								<th style = 'padding-left:50px;' align = 'left' width = '49%' colspan = '2'>LEGALES</th>
								<td class = 'separator'></td>
								<th align = 'left' width = '49%' colspan = '2'>UBICACIÓN</th>
							</tr>
							<tr>
								<td style = 'padding-left:50px;' colspan = '2'>
									<p>Razón Social:</p>
									<input type = 'text' class = 'entradas_bordes' id = 'n_ncomercial_proveedor' value = '".$row['nombre_comercial_proveedor']."' readonly/>
								</td>
								<td class = 'separator'></td>
								<td colspan = '2'>
									<table width = '100%'>
										<tr>
											<td >
												$ubicacion
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style = 'padding-left:50px;' colspan = '2'>
									<p>Nombre Legal:</p>
									<input type = 'text' class = 'entradas_bordes' id = 'n_nlegal_proveedor' value = '".$row['nombre_legal_proveedor']."' readonly/>
								</td>
								<td class = 'separator'></td>
								<td>
									<p>Dirección:</p>
									<input type = 'text' class = 'entradas_bordes' id = 'n_direccion_proveedor' value = '".$row['direccion_proveedor']."' readonly/>
								</td>
								<td>
									<p>Teléfono:</p>
									<input type = 'text' class = 'entradas_bordes' id = 'n_telefono_proveedor' value = '".$row['telefono_proveedor']."' readonly/>
								</td>
							</tr>
							<tr>
								<td style = 'padding-left:50px;' colspan = '2'>
									<p>Nit:</p>
									<input type = 'text' class = 'entradas_bordes' id = 'n_nit_proveedor' value = '".$row['nit_proveedor']."' readonly/>
								</td>
								<td class = 'separator'></td>
								<td>
									<p>Correo:</p>
									<input type = 'text' class = 'entradas_bordes' id = 'n_correo_proveedor' value = '".$row['correo_proveedor']."' readonly/>
								</td>
							</tr>
							<tr><td></br></td></tr>
							<tr><td></br></td></tr>
							<tr>
								<th  style = 'padding-left:50px;' colspan = '5' align = 'left'>ASOCIACIÓN</th>
							</tr>
							<tr><td></br></td></tr>";
				$sql_asoc = mysql_query("select e.nombre_comercial_empresa
				from empresa e, asocproemp ax
				where e.cod_interno_empresa = ax.pk_nit_empresa_asoc and ax.pk_nit_proveedor_asoc = '$id'");
				while($xrow = mysql_fetch_array($sql_asoc)){
					$est.="<tr>
						<td style = 'padding-left:50px;'>".$xrow['nombre_comercial_empresa']."</td>
					</tr>";
				}
					$est.="</table>
					</div>";
			}
			echo $est;
		}
		
		public function listar_contratos_proveedor($sql){
			$tabla = "<table width = '100%'>
				<tr>
					<td></td>
				</tr>
			";
		}
		
		public function eliminar_proveedor(){
			
		}

	}
	
?>