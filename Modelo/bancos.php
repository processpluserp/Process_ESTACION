<?php
	
	/*Clase que contiene toda la informaciónde los bancos de las diferentes empresa.*/
	class banco{
		public $meses = array("Enero", "Febrero", "Marzo",
        "Abril", "Mayo", "Junio", "Julio",
        "Agosto", "Septiembre", "Octubre",
        "Noviembre", "Diciembre"); //Contiene la información de los nombres de cada uno de los meses del año.
		
		public $comercial; //Nombre comercial
		public $legal; //Nombre Legal
		public $nit; //Nit.
		public $direccion; //Dirección.
		public $telefono; //Teléfono.
		public $correo; //Correo.
		
		public $pagina; //Página web.
		public $logo; //Ruta del logo del banco.
		public $empresa; //Empresa por donde es creado y/o asociado.
		public $pais; //País
		public $departamento; //Departamento
		public $ciudad; //Ciudad
		
		//Modificadores de acceso.
		public function get_comercial(){
			return $this->comercial;
		}
		public function set_comercial($x){
			$this->comercial = strtoupper($x);
		}
		
		public function get_legal(){
			return $this->legal;
		}
		public function set_legal($x){
			$this->legal = strtoupper($x);
		}
		
		public function get_nit(){
			return $this->nit;
		}
		public function set_nit($x){
			$this->nit = $x;
		}
		
		public function get_direccion(){
			return $this->direccion;
		}
		public function set_direccion($x){
			$this->direccion = $x;
		}
		
		public function get_telefono(){
			return $this->telefono;
		}
		public function set_telefono($x){
			$this->telefono = $x;
		}
		
		public function get_correo(){
			return $this->correo;
		}
		public function set_correo($x){
			$this->correo = $x;
		}
		
		public function get_pagina(){
			return $this->pagina;
		}
		public function set_pagina($x){
			$this->pagina = $x;
		}
		
		public function get_logo(){
			return $this->logo;
		}
		
		
		/*
			Método que se encarga de consultar el máximo id de la tabla bancos.
		*/
		public function consultar_id(){
			$x = 0;
			$sql = mysql_query("select max(codigo_banco) as id from banco");
			while($row = mysql_fetch_array($sql)){
				$x = $row['id'];
			}
			$x;
			return $x;
		}
		
		public function set_logo($x){
			$this->logo = ($this->consultar_id() + 1 )."@".$x;
		}
		
		public function get_empresa(){
			return $this->empresa;
		}
		public function set_empresa($x){
			$this->empresa = $x;
		}
		
		public function get_pais(){
			return $this->pais;
		}
		public function set_pais($x){
			$this->pais = $x;
		}
		
		public function get_departamento(){
			return $this->departamento;
		}
		public function set_departamento($x){
			$this->departamento = $x;
		}
		
		public function get_ciudad(){
			return $this->ciudad;
		}
		public function set_ciudad($x){
			$this->ciudad = $x;
		}
		
		
		/*
			Este médoto se encarga de consultar el nombre comercial del banco.
			@param int $banco Código del banco.
		
		*/
		public function mostrar_nombre_comercial_banco($b){
			$sql = mysql_query("select name_comercial from banco where codigo_banco = '$b'");
			$banco = "";
			while($row = mysql_fetch_array($sql)){
				$banco = $row['name_comercial'];
			}
			echo $banco;
		}
		
		
		/*
			@param int $banco Contiene el código del banco.
			Contiene el SQL correspondiente a la información básica del banco.
		*/
		public function sql_info_basica($banco){
			$sql = mysql_query("select  b.codigo_banco,b.name_comercial, b.nit, b.name_legal, b.direccion, b.telefono,b.correo, b.pagina_banco, b.logo,
			p.nombre_pais, d.nombre_departamento, c.nombre_ciudad
			from banco b, ciudad c, departamento d, pais p
			where b.codigo_banco= '$banco' and b.ciudad = c.codigo_ciudad and 
			c.departamento_codigo_departamento = d.codigo_departamento and d.pais_codigo_pais = p.codigo_pais ");
			return $sql;
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
		
		
		/*
			@param int $id Código del banco.
			Contiene el SQL de consulta de los contactos de cada uno de los bancos.
		*/
		public function sql_contactos($id){
			$sql = mysql_query("select id, name, cargo, telefono, celular, mes, dia, correo from contactos_banco where banco = '$id'");
			return $sql;
		}
		
		/*
			@param string $nombre Nombre del contacto.
			@param string $cargo Contiene el cargo del contacto.
			@param string $telefono Contiene el teléfono del contacto.
			@param string $celular Contiene el celular del contacto.
			@param string $mes Nombres del mes.
			@param int $dia Día de nacimiento.
			@param int $banco Código del banco.
			
			Se carga de guardar la información de los contactos de cada uno de los bancos.
		*/
		public function insert_contacto($nombre,$cargo,$correo,$telefono,$celular,$mes,$dia,$banco){
			$insert = mysql_query("insert into contactos_banco(name, cargo, correo, telefono, celular, mes, dia,banco) values('".$nombre."','".$cargo."','".$correo."','".$telefono."','".$celular."','".$mes."','".$dia."','".$banco."')");
		}
		
		
		/*
			Se encarga de poner los datos del contacto seleccionado en Inputs para que estos queden editables.
			@param int $id Código del contacto del banco.
		*/
		public function editar_contacto_banco($id){
			$sql = mysql_query("select id, name, cargo, telefono, celular, mes, dia, correo from contactos_banco where id = '$id'");
			$est = "";
			while($row = mysql_fetch_array($sql)){
				$est .="<form id = 'contacto_editado_banco'>
						<td><input type = 'text' name = 'nombre_contacto_b' value = '".$row['name']."'/></td>
						<td><input type = 'text' name = 'cargo_contacto_b' value = '".$row['cargo']."'/></td>
						<td><input type = 'text' name = 'correo_contacto_b' value = '".$row['correo']."'/></td>
						<td><input type = 'text' name = 'telefono_contacto_b' value = '".$row['telefono']."'/></td>
						<td><input type = 'text' name = 'celular_contacto_b' value = '".$row['celular']."'/></td>
						</form>
						<td>".$row['mes']."/></td>
						<td>".$row['dia']."/></td>";
			}
			echo $est;
		}
		
		/*
			@param sql $sql Contiene la sentencia que trae los conctactos de un banco específico.
			Contiene la grilla en donde se muestra la información de los contactos del banco.
		*/
		
		public function listar_contactos($sql){
			$est = "<table width = '100%' class = 'tablas_muestra_datos_tablas display' style = 'padding-left:50px;padding-right:50px;'>
				<thead>
					<tr>
						<th>NOMBRE</th>
						<th>CARGO</th>
						<th>CORREO</th>
						<th>TELEFONO</th>
						<th>CELULAR</th>
						<th>MES</th>
						<th>DÍA</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
			";
			while($row = mysql_fetch_array($sql)){
				$id = $row['id'];
				$est.="
					<tr id = 'editar_contactox$id'>
						<td >".strtoupper($row['name'])."</td>
						<td>".strtoupper($row['cargo'])."</td>
						<td>".strtoupper($row['correo'])."</td>
						<td>".strtoupper($row['telefono'])."</td>
						<td>".strtoupper($row['celular'])."</td>
						<td>".strtoupper($row['mes'])."</td>
						<td>".strtoupper($row['dia'])."</td>
						<td align = 'center'>
							<img src = '../images/iconos/icono_editar.png' class = 'iconos_barra' onclick = 'editar_informacion_contacto($id)'/>
						</td>
					</tr>";
			}
			$estx = "";
			for($i = 0;$i<10;$i++){
				$estx.="<tr>
					<td style = 'padding:20px;font-size:auto;'></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>";
			}
			echo $est."</tbody></table>
				<script type = 'text/javascript'>
					$('.display').DataTable( {
						'scrollY':($('#contenedor_contactos').height()-40)+'px',
						'scrollCollapse':true,
						'paging':false
					});
					$('.dataTables_filter,.dataTables_length,.dataTables_info').hide();
				</script>
			";
		}
		
		public function info_basica_banco_ubicacion($id){
			$sql = mysql_query("select p.nombre_pais, d.nombre_departamento, c.nombre_ciudad, e.ciudad, e.departamento, e.pais
			from banco e, ciudad c, departamento d, pais p
			where e.codigo_banco = '$id' and e.ciudad = c.codigo_ciudad and 
			c.departamento_codigo_departamento = d.codigo_departamento and d.pais_codigo_pais = p.codigo_pais");
			return $sql;
		}
		
		public function logo_banco($id){
			$sql = mysql_query("select logo from banco where codigo_banco = '$id'");
			while($row = mysql_fetch_array($sql)){
				echo "<img src = '../Process/BANCO/$id/".$row['logo']."' class = 'img_empresa'/>";
			}
		}
		
		
		/*
			@param int id Codigo del banco.
			@param sql $sql_ubicacion contiene el script de la información de ubicación del banco.
			@param sql $sql contiene la sentencia con la información básica del banco.
			Se encarga de generar la estructura para editar la información del banco.
			
		*/
		public function editar_banco_gestion($id,$sql_ubicacion,$sql){
			$ubicacion = "";
			if(mysql_num_rows($sql_ubicacion) == 0){
				$ubicacion .="
					<td><select id = 'n_pais_empresa' onchange = 'cambiar_pais_empresa()' onclick = 'limpiar_pais(".$row['pais'].")'>".$this->paises(0)."</select></td>
					<td><select id = 'n_depto_empresa' onchange = 'cargar_ciudad()'><option value = '0'>-</option></td>
					<td><select id = 'n_ciudad_empresa'><option value = '0'>-</option></td>
				";
			}else{
				while($row = mysql_fetch_array($sql_ubicacion)){
					$ubicacion .="
					<td><select id = 'n_pais_empresa' name = 'n_pais_empresa' onchange = 'cambiar_pais_empresa()' onclick = 'limpiar_pais(".$row['pais'].")'>".$this->paises($row['pais'])."</select></td>
					<td><select id = 'n_depto_empresa' name = 'n_depto_empresa' onchange = 'cargar_ciudad()'><option value = '".$row['departamento']."'>".$row['nombre_departamento']."</option></td>
					<td><select id = 'n_ciudad_empresa' name = 'n_ciudad_empresa'><option value = '".$row['ciudad']."'>".$row['nombre_ciudad']."</option></td>";
				}
			}
			$est = "";
			while($row = mysql_fetch_array($sql)){
				$id = $row['codigo_banco'];
				$est.="
					<table width = '100%'>
						<td width = '96%' align = 'left'>
							<table width = '100%' style = 'padding-left:50px;'>
								<tr>
									<td></br></br></br><p></p></td>		
								</tr>
								<tr>
									<td >
										<span class = 'mensaje_bienvenida'>INFORMACIÓN BANCO</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right' style = 'padding-right:50px;'>
							<table width = '100%'>
								<tr>
									<td>
										<img src = '../images/iconos/icono_editar.png'  class = 'iconos_opciones'/>
									</td>
									<td>
										<img id = 'cerrar_info_basica' src = '../images/iconos/cerrar.png' onclick = 'cerrar_ventana_editar()'class = 'iconos_opciones'/>
									</td>
								</tr>
							</table>
						</td>
					</table>
					</br>
				<form id = 'update_form_bancos'>
					<table class = 'tabla_nuevos_datos2' width = '100%' style = 'padding-right:50px;'>
						<tr>
						<tr>
							<td colspan = '2' width = '48%' style = 'padding-left:50px;'>
								<p>Nombre Comercial</p>
								<input type = 'text' class = 'entradas_bordes' name = 'be_name_comerciale' value = '".$row['name_comercial']."' />
							</td>
							<td class = 'separator'></td>
							<td colspan = '2'>
								<table width = '100%'>
									<tr>
										<td >
											<p>Páis:</p>
										</td>
										<td >
											<p>Departamento:</p>
										</td>
										<td >
											<p>Ciudad:</p>
										</td>
									</tr>
									<tr>
										$ubicacion
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td></br></td>
						</tr>
						<tr>
							<td colspan = '2' width = '48%' style = 'padding-left:50px;'>
								<p>Razón Social:</p>
								<input type = 'text' class = 'entradas_bordes' name = 'be_r_sociale' value = '".$row['name_legal']."'/>
							</td>
							<td class = 'separator'></td>
							<td colspan = '2'>
								<p>Teléfono:</p>
								<input type = 'text' class = 'entradas_bordes' name = 'telefono_bee' value = '".$row['telefono']."' />
							</td>
						</tr>
						<tr>
							<td></br></td>
						</tr>
						<tr>
							<td colspan = '2' width = '48%' style = 'padding-left:50px;'>
								<p>Nit:</p>
								<input type = 'text' class = 'entradas_bordes' name = 'be_nit_bancoe' value = '".$row['nit']."' readonly/>
							</td>
							<td class = 'separator'></td>
							<td colspan = '2'>
								<p>Dirección:</p>
								<input type = 'text' class = 'entradas_bordes' name = 'be_direccione' value = '".$row['direccion']."'/>
							</td>
						</tr>
						<tr>
							<td></br></td>
						</tr>
						<tr>
							<td colspan = '2' width = '48%' style = 'padding-left:50px;'>
								<p>Correo:</p>
								<input type = 'text' class = 'entradas_bordes' name = 'be_correoe' value = '".$row['correo']."'/>
							</td>
							<td class = 'separator'></td>
							<td colspan = '2' >
								<p>Página Web:</p>
								<input type = 'text' class = 'entradas_bordes' name = 'be_pagina_webe' value = '".$row['pagina_banco']."' />
							</td>
						</tr>
						<tr><td colspan = '5'></br></td></tr>
						<tr><td colspan = '5'></br></td></tr>
						<tr><td colspan = '5'></br></td></tr>
						<tr>
							<td colspan = '5' align= 'center'>
								<span class = 'botton_verde mano' onclick = 'mostrar_info_banco()'>Cancelar</span>
								<span class = 'botton_verde mano' onclick = 'update_info_banco()'>Guardar Información</span>
							</td>
						</tr>
					</form>
				";
			}
			echo $est."</table>";
		}
		
		
		/*
			Contiene la estructura para mostrar toda la información básica del banco.
		*/
		public function info_basica_banco($sql){
			$est = "
				";
			while($row = mysql_fetch_array($sql)){
				$id = $row['codigo_banco'];
				$est.="
				<table width = '100%'>
					<td width = '96%' align = 'left'>
						<table width = '100%' style = 'padding-left:50px;'>
							<tr>
								<td >
									<img src = '../Process/BANCO/$id/".$row['logo']."' class = 'img_empresa'/>
								</td>		
							</tr>
							<tr>
								<td >
									<span class = 'mensaje_bienvenida'>INFORMACIÓN BANCO</span>
								</td>
							</tr>
						</table>
					</td>
					<td align = 'right' style = 'padding-right:50px;'>
						<table width = '100%'>
							<tr>
								<td>
									<img src = '../images/iconos/icono_editar.png' onclick = 'editar_banco_gestion($id)' class = 'iconos_opciones'/>
								</td>
								<td>
									<img id = 'cerrar_info_basica'src = '../images/iconos/cerrar.png' onclick = 'cerrar_ventana_editar()'class = 'iconos_opciones'/>
								</td>
							</tr>
						</table>
					</td>
				</table>
				</br>
				<table class = 'tabla_nuevos_datos' width = '100%' style = 'padding-right:50px;'>
					<tr>
						<td colspan = '2' width = '48%' style = 'padding-left:50px;'>
							<p>Nombre Comercial:</p>
							<input type = 'text' class = 'entradas_bordes' id = 'r_social' value = '".$row['name_comercial']."' readonly/>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2'>
							<table width = '100%'>
								<tr>
									<td colspan = '3'>
										<p>Páis - Departamento - Ciudad:</p>
									</td>
								</tr>
								<tr>
									<td colspan = '3'>
										<input type = 'text' value = '".$row['nombre_pais']." - ".$row['nombre_departamento']." - ".$row['nombre_ciudad']."'readonly/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td></br></td>
					</tr>
					<tr>
						<td colspan = '2' width = '48%' style = 'padding-left:50px;'>
							<p>Razón Social:</p>
							<input type = 'text' class = 'entradas_bordes' id = 'r_social' value = '".$row['name_legal']."' readonly/>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2'>
							<p>Teléfono:</p>
							<input type = 'text' class = 'entradas_bordes' id = 'dir' value = '".$row['telefono']."'readonly/>
							</td>
					</tr>
					<tr>
						<td></br></td>
					</tr>
					<tr>
						<td colspan = '2' width = '48%' style = 'padding-left:50px;'>
							<p>Nit:</p>
							<input type = 'text' class = 'entradas_bordes' id = 'r_social' value = '".$row['nit']."' readonly/>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2'>
							<p>Dirección:</p>
							<input type = 'text' class = 'entradas_bordes' id = 'dir' value = '".$row['direccion']."'readonly/>
						</td>
					</tr>
					<tr>
						<td></br></td>
					</tr>
					<tr>
						<td colspan = '2' width = '48%' style = 'padding-left:50px;'>
							<p>Correo:</p>
							<input type = 'text' class = 'entradas_bordes' id = 'dir' value = '".$row['correo']."'readonly/>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' >
							<p>Página Web:</p>
							<input type = 'text' class = 'entradas_bordes' id = 'dir' value = '".$row['pagina_banco']."'readonly/>
						</td>
					</tr>
				
				";
			}
			echo $est."</table>";
		}
		
		
		/*
			Guarda la información de un banco nuevo.
			@param date $fecha Contiene la fecha en la que se realiza la acción.
			@param int $usuario Contiene la información del código de usuario.
			@param string $file Ruta en donde se guarda el archivo.
		*/
		public function insert_banco($fecha,$usuario,$file){
			$est = 1;
			$sql = mysql_query("insert into banco(name_comercial,nit,name_legal,direccion,telefono,correo,pagina_banco,logo,empresa,usuario,fecha_registro,
			ciudad,departamento,pais,estado,logo2) values('".
			$this->get_comercial()."','".$this->get_nit()."','".$this->get_legal()."','".$this->get_direccion()."','".$this->get_telefono()."','".
			$this->get_correo()."','".$this->get_pagina()."','".$this->get_logo()."','".$this->get_empresa()."','".$usuario."','".$fecha."','".
			$this->get_ciudad()."','".$this->get_departamento()."','".$this->get_pais()."','".$est."','".$file."')");
		}
	
		/*
			Guarda la asociación entre un banco y al empresa.
			@param date $fecha Fecha de registro.
			@param int $usuario Código del usuario que realiza la acción.
			@param int $empresa Código de la empresa con la que se realiza la asociación.
			@param int $banco Código del banco con el que se realiza la asociación.
			
		*/
		public function asociar_banco_empresas($fecha,$usuario,$empresa,$banco){
			for($i = 0;$i < count($empresa);$i++){
				mysql_query("insert into asobanco(banco,empresa,fecha,user) values('".$banco."','".$empresa[$i]."','".$fecha."','".$usuario."')");				
			}
		}
		
		
		/*
			Actualiza la información del banco.
			@param date $fecha Fecha de registro.
			@para int $usuario: Código del usuario que realiza la acción.
		*/
		public function update_banco($fecha,$usuario){
			$sql = mysql_query("update banco set name_comercial = '".$this->get_comercial()."', telefono ='".$this->get_telefono()."', name_legal = '".$this->get_legal()."', direccion = '".$this->get_direccion()."', correo = '".$this->get_correo()."',
			pagina_banco ='".$this->get_pagina()."', ciudad = '".$this->get_ciudad()."', departamento = '".$this->get_departamento()."', pais = '".$this->get_pais()."' where nit ='".$this->get_nit()."'");
		}
		
		
		/*
			Eeste método se encarga de actualizar la información de uno de los contactos del banco.
			@param string $nombre Nuevo nombre.
			@param string $cargo nuevo cargo.
			@param string $correo Nuevo correo.
			@param string $telefono Nuevo teléfono.
			@param string $celular nuevo Celular.
			@param string $mes Nombre del mes.
			@param int $dia número del día.
			@param int $id Código del id del contacto a modificar.
		*/
		public function update_contacto_banco($nombre,$cargo,$correo,$telefono,$celular,$mes,$dia,$id){
			mysql_query("update contactos_banco set name = '$nombre', cargo = '$cargo', telefono = '$telefono', celular = '$celular', mes = '$mes', dia = '$dia' where id = '$id'");
		}
		
		
		/*
			Crea la carpeta del Banco.
			Cada vez que se crea el banco, se consulta el id y se crea la carpeta correspondiente a ese id.
		*/
		public function crear_carpeta_banco(){
			$x = $this->consultar_id();
			if(file_exists("../Process/BANCO")){
				$destino = "../Process/BANCO/".$x;
				mkdir($destino);
				$destino = "../Process/BANCO/".$x."/DOCUMENTOS";
				mkdir($destino);
			}else{
				$destino = "../Process/BANCO";
				mkdir($destino);
				$destino = "../Process/BANCO/".$x;
				mkdir($destino);
				$destino = "../Process/BANCO/".$x."/DOCUMENTOS";
				mkdir($destino);
			}
		}
		
		
		/*
			Contiene el los registros de las empresas que se pueden asociar a un banco.
		*/
		public function asociar_empresa_proveedor(){
			$imp = "";
			$sql = mysql_query("select cod_interno_empresa as codigo, nombre_legal_empresa from empresa where estado = '1'");
			$i = 0;
			while($row = mysql_fetch_array($sql)){
				$x = $row['codigo'];
				$imp .="<tr>
					<td style = 'padding-left:50px;'nowrap>
						<div>
							<input type = 'checkbox' name = 'empresas[]' id = 'empresas$x' value = '".$row['codigo']."' class = 'radio' />
							<label for='empresas$x'><span><span></span></span>".$row['nombre_legal_empresa']."</label>
						</div>
					</td>
				</tr>";
			$i++;
			}
			echo $imp;
		}
		/*
			Se muestran los bancos asociados a una empresa.
			@param int $emp Código de la empresa.
		*/
		public function mostrar_bancos($emp){
			$sql = mysql_query("select b.codigo_banco, b.logo2 from banco b, asobanco a where b.estado = '1' and a.empresa = '$emp' and a.banco = b.codigo_banco");
			$contador = 1;
			
			$est = "<table width = '100%' id = 'menu_interno_gestion'><tr>
				";
			while($row = mysql_fetch_array($sql)){
				$id = $row['codigo_banco'];
				$img = $row['logo2'];
				if($contador <= 4 ){
					$est .= "
							<td width = 'auto'>
								<a href = 'bancos.php?e=$emp&b=$id'><img src = '../Process/BANCO/$id/$img' class = 'iconos_menu_gestion2'/></a>
							</td>
							
						";
				}else{
					$contador = 1;
				}
			}
			echo $est."</tr></table>
				<table width = '100%'>
					<tr>
						<td align = 'center' >
							<img src = '../images/iconos/barra-55.png' class = 'iconos_opciones' onclick = 'form_nuevo_banco()'/>
						</td>
					</tr>
				</table>
			";
		}
		
		public function insert_producto_banco($emp,$banco,$und,$tipo,$num){
			$sql = mysql_query("INSERT INTO probancos(name,pk_tipo,und,empresa,banco) values 
			('".$num."','".$tipo."','".$und."','".$emp."','".$banco."')");		
		}
		
		public function productos_und($und){
			$sql = mysql_query("select id,name,pk_tipo from probancos where und = '$und'");
			while($row = mysql_fetch_array($sql)){
				echo "<option value ='".$row['id'].".".$row['pk_tipo']."'>".$row['name']."</option>";
			}
		}
		
		public function eliminar_registro($id){
			mysql_query("delete from mov_cuentas where id = '$id'");
		}
		
		public function estructura_cc_ca($id){
			$meses = array("ENERO", "FEBRERO", "MARZO",
			"ABRIL", "MAYO", "JUNIO", "JULIO",
			"AGOSTO", "SEPTIEMBRE", "OCTUBRE",
			"NOVIEMBRE", "DICIEMBRE");
			$mesx = mysql_query("select DISTINCT mes from mov_cuentas where pk_cuenta = '$id'");
			$girado = 0;
			$entregado = 0;
			$valor = 0;
			$sub_total = 0;
			$valor_pagado = 0;
			
			$comp = "";
				
			$va = '"n_format_num"';
			$v2 = '"n_buscar_format"';
			while($r = mysql_fetch_array($mesx)){
				
				$mes = $meses[$r['mes']-1];
				$ccc  = "<tr><th colspan = '6' align ='center'>$mes</th></tr>";
				$sql = mysql_query("select id,pk_cuenta,num,descx,valor,estado from mov_cuentas where  mes = '".$r['mes']."'");
				
				while($row = mysql_fetch_array($sql)){
					$ix = $row['id'];
					$compx = "";
					$valor += $row['valor'];
					if($row['estado'] == 1){
						$valor_pagado += $row['valor'];
						$compx.="<td></td>
								<td></td>
								<td style = 'font-color:red;'>
									<table width = '100%' class ='sin_nada'>
										<tr>
											<td align = 'left' width = '2%'>$</td>
											<td align = 'right'>".number_format($row['valor'])."</td>
										</tr>
									</table>
								</td>
							";
					}else{
						$girado += $row['valor'];
						$entregado += $row['valor'];
						$compx.="<td>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<td align = 'left' width = '2%'>$</td>
									<td align = 'right'>".number_format($row['valor'])."</td>
								</tr>
							</table>
						</td>
						<td>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<td align = 'left' width = '2%'>$</td>
									<td align = 'right'>".number_format($row['valor'])."</td>
								</tr>
							</table>
						</td>
						<td></td>
						<td style = 'background-color:white;'>
							<img src = '../images/iconos/eliminar2.png' height='25px' onclick = 'eliminar_registro_banco($ix)'/>
						</td>
						<td style = 'background-color:white;'>
							<img src = '../images/iconos/ok_verde.png' height='25px' onclick = 'update_estado_pago($ix)'/>
						</td>
						";
					}
					$comp.="
							<tr>
								<td nowrap>".strtr(strtoupper($row['num']),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
								<td nowrap>".strtr(strtoupper($row['descx']),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
								<td>
									<table width = '100%' class = 'sin_nada'>
										<tr>
											<td align = 'left' width = '2%'>$</td>
											<td align = 'right'>".number_format($row['valor'])."</td>
										</tr>
									</table>
								</td>
								$compx
							</tr>";
				}
			}
			$sql2 = mysql_query("select iva,reteiva,ica,reteica,refuente,cree,saldo,canjes from probancos where id = '$id'");
			$cox = "";
			$imp = "";
			while($row = mysql_fetch_array($sql2)){
				$iva = '"iva_saldo_banco"';
				$h_iva = '"h_iva_saldo_banco"';
				
				$riva = '"reteiva_saldo_banco"';
				$h_riva = '"h_reteiva_saldo_banco"';
				
				$ica = '"ica_saldo_banco"';
				$h_ica = '"h_ica_saldo_banco"';
				
				$rica = '"reteica_saldo_banco"';
				$h_rica = '"h_reteica_saldo_banco"';
				
				$fuente = '"refuente_saldo_banco"';
				$h_fuente = '"h_refuente_saldo_banco"';
				
				$cree = '"cree_saldo_banco"';
				$h_cree = '"h_cree_saldo_banco"';
				
				$canje = '"canjes_saldo_banco"';
				$h_canje = '"h_canjes_saldo_banco"';
				
				$saldo = '"saldo_saldo_banco"';
				$h_saldo = '"h_saldo_saldo_banco"';
				$valor += $row['iva'] + $row['reteiva'] +$row['ica']+$row['reteica']+$row['refuente']+$row['cree'];
				$girado += $row['iva'] + $row['reteiva'] +$row['ica']+$row['reteica']+$row['refuente']+$row['cree'];
				$entregado += $row['iva'] + $row['reteiva'] +$row['ica']+$row['reteica']+$row['refuente']+$row['cree'];
				$sub_total = $valor;
				$imp.="
					
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					
					<tr>
						<th style = 'background-color:transparent;'></th>
						<th>SUBTOTAL</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($valor)."</th>
								</tr>
							</table>
						</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($girado)."</th>
								</tr>
							</table>
						</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($entregado)."</th>
								</tr>
							</table>
						</th>
						<th style = 'background-color:transparent;'></th>
					</tr>
					<tr>
						<th style = 'background-color:transparent;'></th>
						<th nowrap>SALDO CUENTA</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($row['saldo'])."</th>
								</tr>
							</table>
						</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($row['saldo'])."</th>
								</tr>
							</table>
						</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($row['saldo'])."</th>
								</tr>
							</table>
						</th>
						<th style = 'background-color:transparent;'></th>
					</tr>
					<tr>
						<th style = 'background-color:transparent;'></th>
						<th nowrap>SALDO + CANJES</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($row['saldo'] + $row['canjes'])."</th>
								</tr>
							</table>
						</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($row['saldo'] + $row['canjes'])."</th>
								</tr>
							</table>
						</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($row['saldo'] + $row['canjes'])."</th>
								</tr>
							</table>
						</th>
						<th style = 'background-color:transparent;'></th>
					</tr>
					<tr>
						<th style = 'background-color:transparent;'></th>
						<th>GIRADO</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($girado)."</th>
								</tr>
							</table>
						</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($girado)."</th>
								</tr>
							</table>
						</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($girado)."</th>
								</tr>
							</table>
						</th>
						<th style = 'background-color:transparent;'></th>
					</tr>
					<tr>
						<th style = 'background-color:transparent;'></th>
						<th nowrap style = 'background-color:rgb(97, 174, 13);color:white;'>TOTAL DISPONIBLE</th>
						<th style = 'background-color:rgb(97, 174, 13);color:white;'>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format(($row['saldo'] + $row['canjes']) - $girado)."</th>
								</tr>
							</table>
						</th>
						<th style = 'background-color:rgb(97, 174, 13);color:white;'>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format(($row['saldo'] + $row['canjes']) - $girado)."</th>
								</tr>
							</table>
						</th>
						<th style = 'background-color:rgb(97, 174, 13);color:white;'>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format(($row['saldo'] + $row['canjes']) - $girado)."</th>
								</tr>
							</table>
						</th>
						<th style = 'background-color:transparent;'></th>
					</tr>
					";
				$cox.="<table class = 'tabla_nuevos_datos' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<th style = 'font-size:14px;'>IVA</th>
						<th style = 'font-size:14px;'>RETE IVA</th>
						<th style = 'font-size:14px;'>ICA</th>
						<th style = 'font-size:14px;'>RETE ICA</th>
						<th style = 'font-size:14px;'>RETE FUENTE</th>
						<th style = 'font-size:14px;'>CREE</th>
						<th style = 'font-size:14px;'>CANJES</th>
						<th style = 'font-size:14px;'>SALDO</th>
					</tr>
					<tr>
						<td>
							<input onkeyup = 'formatear_valor(event,$iva,$h_iva)' type = 'text' id = 'iva_saldo_banco' class = 'entradas_bordes' value = '".number_format($row['iva'])."' style = 'width:120px;'/>
							<span id = 'h_iva_saldo_banco' class = 'hidde'>".$row['iva']."</span>
						</td>
						<td>
							<input onkeyup = 'formatear_valor(event,$riva,$h_riva)' type = 'text' id = 'reteiva_saldo_banco' class = 'entradas_bordes' value = '".number_format($row['reteiva'])."' style = 'width:120px;'/>
							<span id = 'h_reteiva_saldo_banco' class = 'hidde'>".$row['reteiva']."</span>
						</td>
						<td>
							<input onkeyup = 'formatear_valor(event,$ica,$h_ica)' type = 'text' id = 'ica_saldo_banco' class = 'entradas_bordes' value = '".number_format($row['ica'])."' style = 'width:120px;'/>
							<span id = 'h_ica_saldo_banco' class = 'hidde'>".$row['ica']."</span>
						</td>
						<td>
							<input onkeyup = 'formatear_valor(event,$rica,$h_rica)' type = 'text' id = 'reteica_saldo_banco' class = 'entradas_bordes' value = '".number_format($row['reteica'])."' style = 'width:120px;'/>
							<span id = 'h_reteica_saldo_banco' class = 'hidde'>".$row['reteica']."</span>
						</td>
						<td>
							<input onkeyup = 'formatear_valor(event,$fuente,$h_fuente)' type = 'text' id = 'refuente_saldo_banco' class = 'entradas_bordes' value = '".number_format($row['refuente'])."' style = 'width:120px;'/>
							<span id = 'h_refuente_saldo_banco' class = 'hidde'>".$row['refuente']."</span>
						</td>
						<td>
							<input onkeyup = 'formatear_valor(event,$cree,$h_cree)' type = 'text' id = 'cree_saldo_banco' class = 'entradas_bordes' value = '".number_format($row['cree'])."' style = 'width:120px;'/>
							<span id = 'h_cree_saldo_banco' class = 'hidde'>".$row['cree']."</span>
						</td>
						<td>
							<input onkeyup = 'formatear_valor(event,$canje,$h_canje)' type = 'text' id = 'canjes_saldo_banco' class = 'entradas_bordes' value = '".number_format($row['canjes'])."' style = 'width:120px;'/>
							<span id = 'h_canjes_saldo_banco' class = 'hidde'>".$row['canjes']."</span>
						</td>
						<td>
							<input onkeyup = 'formatear_valor(event,$saldo,$h_saldo)' type = 'text' id = 'saldo_saldo_banco' class = 'entradas_bordes' value = '".number_format($row['saldo'])."' style = 'width:120px;'/>
							<span id = 'h_saldo_saldo_banco' class = 'hidde'>".$row['saldo']."</span>
						</td>
						<td align = 'center'>
							<img src = '../images/iconos/ok_verde.png' height='25px' onclick = 'guardar_saldos_bancos($id)'/>
						</td>
					</tr></table>";
			}
			$est="
			<table class = 'tabla_nuevos_datos' style = 'padding-left:50px;padding-right:50px;'>
				
				<tr>
					<td align = 'center'>
						<input type = 'text' id = 'n_num' class = 'entradas_bordes' style = 'width:140px;' placeholder = 'TRANFERENCIA / CHEQUE'/>
					</td>
					<td align = 'center'>
						<input type = 'text' id = 'text_nprod' class = 'entradas_bordes' style = 'width:350px;' placeholder = 'MOTIVO'/>
					</td>
					<td align = 'center'>
						<input type = 'text' id = 'n_format_num' class = 'entradas_bordes' style = 'width:120px;' placeholder = 'VALOR'onkeyup = 'formatear_valor(event,$va,$v2)'/>
						<span id = 'n_buscar_format' class = 'hidde'></span>
					</td>
					<td align = 'center'>
						<img src = '../images/iconos/ok_verde.png' height='25px' onclick = 'insertar_valor_item_producto($id)'/>
					</td>
				</tr>
				
			</table>
			$cox
			<table width = '100%' class = 'tabla_nuevos_datos finan_banco' style = 'padding-left:50px;padding-right:50px;'>
				<tr>
					<th nowrap>NUMERO DE CHEQUE</th>
					<th nowrap>A FAVOR DE</th>
					<th nowrap>VALOR</th>
					<th nowrap>GIRADO</th>
					<th nowrap>ENTREGADO</th>
					<th nowrap>VALOR PAGADO</th>
				</tr>
				$comp
				$imp
				";
				
			return $est."</table>";
		}
		
		
		public function estructura_cc_cax($id){
			$meses = array("ENERO", "FEBRERO", "MARZO",
			"ABRIL", "MAYO", "JUNIO", "JULIO",
			"AGOSTO", "SEPTIEMBRE", "OCTUBRE",
			"NOVIEMBRE", "DICIEMBRE");
			$mesx = mysql_query("select DISTINCT mes from mov_cuentas where pk_cuenta = '$id'");
			$girado = 0;
			$entregado = 0;
			$valor = 0;
			$sub_total = 0;
			$valor_pagado = 0;
			
			$comp = "";
				
			$va = '"n_format_num"';
			$v2 = '"n_buscar_format"';
			while($r = mysql_fetch_array($mesx)){
				
				$mes = $meses[$r['mes']-1];
				$ccc  = "<tr><th colspan = '6' align ='center'>$mes</th></tr>";
				$sql = mysql_query("select id,pk_cuenta,num,descx,valor,estado from mov_cuentas where  mes = '".$r['mes']."'");
				
				while($row = mysql_fetch_array($sql)){
					$ix = $row['id'];
					$compx = "";
					$valor += $row['valor'];
					if($row['estado'] == 1){
						$valor_pagado += $row['valor'];
						$compx.="<td></td>
								<td></td>
								<td style = 'font-color:red;'>
									<table width = '100%' class ='sin_nada'>
										<tr>
											<td align = 'left' width = '2%'>$</td>
											<td align = 'right'>".number_format($row['valor'])."</td>
										</tr>
									</table>
								</td>
							";
					}else{
						$girado += $row['valor'];
						$entregado += $row['valor'];
						$compx.="<td>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<td align = 'left' width = '2%'>$</td>
									<td align = 'right'>".number_format($row['valor'])."</td>
								</tr>
							</table>
						</td>
						<td>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<td align = 'left' width = '2%'>$</td>
									<td align = 'right'>".number_format($row['valor'])."</td>
								</tr>
							</table>
						</td>
						<td></td>
						";
					}
					$comp.="
							<tr>
								<td nowrap>".strtr(strtoupper($row['num']),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
								<td nowrap>".strtr(strtoupper($row['descx']),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
								<td>
									<table width = '100%' class = 'sin_nada'>
										<tr>
											<td align = 'left' width = '2%'>$</td>
											<td align = 'right'>".number_format($row['valor'])."</td>
										</tr>
									</table>
								</td>
								$compx
							</tr>";
				}
			}
			$sql2 = mysql_query("select iva,reteiva,ica,reteica,refuente,cree,saldo,canjes from probancos where id = '$id'");
			$cox = "";
			$imp = "";
			while($row = mysql_fetch_array($sql2)){
				$iva = '"iva_saldo_banco"';
				$h_iva = '"h_iva_saldo_banco"';
				
				$riva = '"reteiva_saldo_banco"';
				$h_riva = '"h_reteiva_saldo_banco"';
				
				$ica = '"ica_saldo_banco"';
				$h_ica = '"h_ica_saldo_banco"';
				
				$rica = '"reteica_saldo_banco"';
				$h_rica = '"h_reteica_saldo_banco"';
				
				$fuente = '"refuente_saldo_banco"';
				$h_fuente = '"h_refuente_saldo_banco"';
				
				$cree = '"cree_saldo_banco"';
				$h_cree = '"h_cree_saldo_banco"';
				
				$canje = '"canjes_saldo_banco"';
				$h_canje = '"h_canjes_saldo_banco"';
				
				$saldo = '"saldo_saldo_banco"';
				$h_saldo = '"h_saldo_saldo_banco"';
				$valor += $row['iva'] + $row['reteiva'] +$row['ica']+$row['reteica']+$row['refuente']+$row['cree'];
				$girado += $row['iva'] + $row['reteiva'] +$row['ica']+$row['reteica']+$row['refuente']+$row['cree'];
				$entregado += $row['iva'] + $row['reteiva'] +$row['ica']+$row['reteica']+$row['refuente']+$row['cree'];
				$sub_total = $valor;
				$imp.="
					
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					
					<tr>
						<th style = 'background-color:transparent;'></th>
						<th>SUBTOTAL</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($valor)."</th>
								</tr>
							</table>
						</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($girado)."</th>
								</tr>
							</table>
						</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($entregado)."</th>
								</tr>
							</table>
						</th>
						<th style = 'background-color:transparent;'></th>
					</tr>
					<tr>
						<th style = 'background-color:transparent;'></th>
						<th nowrap>SALDO CUENTA</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($row['saldo'])."</th>
								</tr>
							</table>
						</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($row['saldo'])."</th>
								</tr>
							</table>
						</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($row['saldo'])."</th>
								</tr>
							</table>
						</th>
						<th style = 'background-color:transparent;'></th>
					</tr>
					<tr>
						<th style = 'background-color:transparent;'></th>
						<th nowrap>SALDO + CANJES</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($row['saldo'] + $row['canjes'])."</th>
								</tr>
							</table>
						</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($row['saldo'] + $row['canjes'])."</th>
								</tr>
							</table>
						</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($row['saldo'] + $row['canjes'])."</th>
								</tr>
							</table>
						</th>
						<th style = 'background-color:transparent;'></th>
					</tr>
					<tr>
						<th style = 'background-color:transparent;'></th>
						<th>GIRADO</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($girado)."</th>
								</tr>
							</table>
						</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($girado)."</th>
								</tr>
							</table>
						</th>
						<th>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format($girado)."</th>
								</tr>
							</table>
						</th>
						<th style = 'background-color:transparent;'></th>
					</tr>
					<tr>
						<th style = 'background-color:transparent;'></th>
						<th nowrap style = 'background-color:rgb(97, 174, 13);color:white;'>TOTAL DISPONIBLE</th>
						<th style = 'background-color:rgb(97, 174, 13);color:white;'>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format(($row['saldo'] + $row['canjes']) - $girado)."</th>
								</tr>
							</table>
						</th>
						<th style = 'background-color:rgb(97, 174, 13);color:white;'>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format(($row['saldo'] + $row['canjes']) - $girado)."</th>
								</tr>
							</table>
						</th>
						<th style = 'background-color:rgb(97, 174, 13);color:white;'>
							<table width = '100%' class = 'sin_nada'>
								<tr>
									<th align = 'left' width = '2%'  style = 'background-color:transparent;'>$</th>
									<th align = 'right'  style = 'background-color:transparent;'>".number_format(($row['saldo'] + $row['canjes']) - $girado)."</th>
								</tr>
							</table>
						</th>
						<th style = 'background-color:transparent;'></th>
					</tr>
					";
				$cox.="<table class = 'tabla_nuevos_datos' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<th style = 'font-size:14px;'>IVA</th>
						<th style = 'font-size:14px;'>RETE IVA</th>
						<th style = 'font-size:14px;'>ICA</th>
						<th style = 'font-size:14px;'>RETE ICA</th>
						<th style = 'font-size:14px;'>RETE FUENTE</th>
						<th style = 'font-size:14px;'>CREE</th>
						<th style = 'font-size:14px;'>CANJES</th>
						<th style = 'font-size:14px;'>SALDO</th>
					</tr>
					<tr>
						<td>
							<input onkeyup = 'formatear_valor(event,$iva,$h_iva)' type = 'text' id = 'iva_saldo_banco' class = 'entradas_bordes' value = '".number_format($row['iva'])."' style = 'width:120px;'/>
							<span id = 'h_iva_saldo_banco' class = 'hidde'>".$row['iva']."</span>
						</td>
						<td>
							<input onkeyup = 'formatear_valor(event,$riva,$h_riva)' type = 'text' id = 'reteiva_saldo_banco' class = 'entradas_bordes' value = '".number_format($row['reteiva'])."' style = 'width:120px;'/>
							<span id = 'h_reteiva_saldo_banco' class = 'hidde'>".$row['reteiva']."</span>
						</td>
						<td>
							<input onkeyup = 'formatear_valor(event,$ica,$h_ica)' type = 'text' id = 'ica_saldo_banco' class = 'entradas_bordes' value = '".number_format($row['ica'])."' style = 'width:120px;'/>
							<span id = 'h_ica_saldo_banco' class = 'hidde'>".$row['ica']."</span>
						</td>
						<td>
							<input onkeyup = 'formatear_valor(event,$rica,$h_rica)' type = 'text' id = 'reteica_saldo_banco' class = 'entradas_bordes' value = '".number_format($row['reteica'])."' style = 'width:120px;'/>
							<span id = 'h_reteica_saldo_banco' class = 'hidde'>".$row['reteica']."</span>
						</td>
						<td>
							<input onkeyup = 'formatear_valor(event,$fuente,$h_fuente)' type = 'text' id = 'refuente_saldo_banco' class = 'entradas_bordes' value = '".number_format($row['refuente'])."' style = 'width:120px;'/>
							<span id = 'h_refuente_saldo_banco' class = 'hidde'>".$row['refuente']."</span>
						</td>
						<td>
							<input onkeyup = 'formatear_valor(event,$cree,$h_cree)' type = 'text' id = 'cree_saldo_banco' class = 'entradas_bordes' value = '".number_format($row['cree'])."' style = 'width:120px;'/>
							<span id = 'h_cree_saldo_banco' class = 'hidde'>".$row['cree']."</span>
						</td>
						<td>
							<input onkeyup = 'formatear_valor(event,$canje,$h_canje)' type = 'text' id = 'canjes_saldo_banco' class = 'entradas_bordes' value = '".number_format($row['canjes'])."' style = 'width:120px;'/>
							<span id = 'h_canjes_saldo_banco' class = 'hidde'>".$row['canjes']."</span>
						</td>
						<td>
							<input onkeyup = 'formatear_valor(event,$saldo,$h_saldo)' type = 'text' id = 'saldo_saldo_banco' class = 'entradas_bordes' value = '".number_format($row['saldo'])."' style = 'width:120px;'/>
							<span id = 'h_saldo_saldo_banco' class = 'hidde'>".$row['saldo']."</span>
						</td>
						<td align = 'center'>
							<img src = '../images/iconos/ok_verde.png' height='25px' onclick = 'guardar_saldos_bancos($id)'/>
						</td>
					</tr></table>";
			}
			$est="
			<table width = '100%' class = 'tabla_nuevos_datos finan_banco' style = 'padding-left:50px;padding-right:50px;'>
				<tr>
					<th nowrap>NUMERO DE CHEQUE</th>
					<th nowrap>A FAVOR DE</th>
					<th nowrap>VALOR</th>
					<th nowrap>GIRADO</th>
					<th nowrap>ENTREGADO</th>
					<th nowrap>VALOR PAGADO</th>
				</tr>
				$comp
				$imp
				";
				
			return $est."</table>";
		}
		
		public function saldo_bancos_und($id){
			$total = 0;
			$mesx = mysql_query("select DISTINCT mes from mov_cuentas where pk_cuenta = '$id'");
			$girado = 0;
			$entregado = 0;
			$valor = 0;
			$sub_total = 0;
			$valor_pagado = 0;
			while($r = mysql_fetch_array($mesx)){
				
				$sql = mysql_query("select id,pk_cuenta,num,descx,valor,estado from mov_cuentas where  mes = '".$r['mes']."'");
				
				while($row = mysql_fetch_array($sql)){
					$ix = $row['id'];
					
					$valor += $row['valor'];
					if($row['estado'] == 1){
						$valor_pagado += $row['valor'];
					}else{
						$girado += $row['valor'];
						$entregado += $row['valor'];
					}
				}
			}
			$sql2 = mysql_query("select iva,reteiva,ica,reteica,refuente,cree,saldo,canjes from probancos where id = '$id'");
			$cox = "";
			$imp = "";
			while($row = mysql_fetch_array($sql2)){
				
				$valor += $row['iva'] + $row['reteiva'] +$row['ica']+$row['reteica']+$row['refuente']+$row['cree'];
				$girado += $row['iva'] + $row['reteiva'] +$row['ica']+$row['reteica']+$row['refuente']+$row['cree'];
				$entregado += $row['iva'] + $row['reteiva'] +$row['ica']+$row['reteica']+$row['refuente']+$row['cree'];
				$sub_total = $valor;
				$total = ($row['saldo'] + $row['canjes']) - $girado;
			}
			
			return $total;
		}
		
		public function update_saldos_bancos($id,$iva,$riva,$ica,$rica,$rfuente,$cree,$saldo,$canjes){
			mysql_query("update probancos set iva = '$iva', reteiva = '$riva', ica = '$ica', reteica = '$rica',
			refuente = '$rfuente', cree = '$cree', saldo = '$saldo', canjes = '$canjes' where id = '$id'");
		}
		public function update_item_pago($id){
			mysql_query("update mov_cuentas set estado = '1' where id = '$id'");
		}
		public function insert_valores_nuevos($id,$val,$ref,$num,$usuario,$fecha){
			$estado = 0;
			$fe = date("m");
			$sql = mysql_query("insert into mov_cuentas(pk_cuenta,num,descx,valor,estado,usuario,mes,fecha) values 
			('".$id."','".$num."','".$ref."','".$val."','".$estado."','".$usuario."','".$fe."','".$fecha."')");
		}
		public function mostrar_logo_bancoo($b){
			$sql = mysql_query("select logo from banco where codigo_banco = '$b'");
			$r = "";
			while($row = mysql_fetch_array($sql)){
				$id =$b;
				$r.="<img src = '../Process/BANCO/$id/".$row['logo']."' class = 'img_empresa' />";
			}
			return $r;
		}

		
	}
?>