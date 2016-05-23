<?php
	class empresa{
	
		public $nit;
		public $nlegal;
		public $ncomercial;
		public $iniciales;
		public $telefono;
		public $direccion;
		public $nota;
		public $n_ppto;
		public $ciudad;
		public $depto;
		public $pais;
		public $noc;
		public $rlegal;
		public $web;
		public $face;
		public $youtube;
		public $twitter;
		public $correo;
		
		
		
		public function get_correo(){
			return $this->correo;
		}
		public function set_correo($x){
			$this->correo = $x;
		}
		public function get_noc(){
			return $this->noc;
		}
		public function set_noc($x){
			$this->noc = $x;
		}
		
		public function get_rlegal(){
			return $this->rlegal;
		}
		public function set_rlegal($x){
			$this->rlegal = $x;
		}
		
		public function get_web(){
			return $this->web;
		}
		public function set_web($x){
			$this->web = $x;
		}
		
		public function get_facebook(){
			return $this->face;
		}
		public function set_facebook($f){
			$this->face = $f;
		}
		public function get_youtube(){
			return $this->youtube;
		}
		public function set_youtube($y){
			$this->youtube = $y;
		}
		
		public function get_twitter(){
			return $this->twitter;
		}
		public function set_twitter($x){
			$this->twitter = $x;
		}
		
		public function get_nota_ppto(){
			return $this->n_ppto;
		}
		public function set_nota_ppto($nnn){
			$this->n_ppto = $nnn;
		}
		
		public function get_nit(){
			return $this->nit;
		}
		public function set_nit($nnit){
			$this->nit = $nnit;
		}
		
		public function get_nlegal(){
			return $this->nlegal;
		}
		public function set_nlegal($n_nlegal){
			$this->nlegal =strtoupper($n_nlegal);
		}
		
		public function get_ncomercial(){
			return $this->ncomercial;
		}
		public function set_ncomercial($comercial){
			$this->ncomercial = strtoupper($comercial);
		}
		
		public function get_iniciales(){
			return $this->iniciales;
		}
		public function set_iniciales($ini){
			$this->iniciales = $ini;
		}
		
		public function get_phone(){
			return $this->telefono;
		}
		public function set_phone($phone){
			$this->telefono = $phone;
		}
		
		public function get_direccion(){
			return $this->direccion;
		}
		public function set_direccion($direcc){
			$this->direccion = $direcc;
		}
		public function get_nota(){
			return $this->nota;
		}
		public function set_nota($note){
			$this->nota = $note;
		}
		public function get_ciudad(){
			return $this->ciudad;
		}
		public function set_ciudad($cdad){
			$this->ciudad = $cdad;
		}
		
		public function get_depto(){
			return $this->depto;
		}
		public function set_depto($departamento){
			$this->depto = $departamento;
		}
		
		public function get_pais(){
			return $this->pais;
		}
		public function set_pais($valor){
			$this->pais = $valor;
		}
		
		public function insert_representantes($name,$empresa){
			$estado = 1;
			$insert = mysql_query("insert into representantes_legales(name,estado,empresa) values
			('".utf8_encode($name)."','".$estado."','".$empresa."')");
		}
		public function insert_correos($name,$empresa){
			$estado = 1;
			$insert = mysql_query("insert into correos_empresa(name,estado,empresa) values
			('".utf8_encode($name)."','".$estado."','".$empresa."')");
		}
		
		public function insert_telefono($name,$empresa){
			$estado = 1;
			$insert = mysql_query("insert into telefonos_empresa(name,estado,empresa) values
			('".utf8_encode($name)."','".$estado."','".$empresa."')");
		}
		
		public function consultar_id(){
			$sql = mysql_query("select cod_interno_empresa from empresa where nit_empresa = '".$this->get_nit()."'");
			$x = "";
			while($row = mysql_fetch_array($sql)){
				$x = $row['cod_interno_empresa'];
			}
			return $x;
		}
		
		public function crear_empresa($x){
			
			if(file_exists("../Process/EMPRESA")){
				$destino = "../Process/EMPRESA/".$x;
				mkdir($destino);
				$destino = "../Process/EMPRESA/".$x."/DOCUMENTOS";
				mkdir($destino);
			}else{
				$destino = "../Process/EMPRESA";
				mkdir($destino);
				$destino = "../Process/EMPRESA/".$x;
				mkdir($destino);
				$destino = "../Process/EMPRESA/".$x."/DOCUMENTOS";
				mkdir($destino);
			}
			return $destino;
		}
		
		public function max_id_empresa(){
			$sql = mysql_query("select max(cod_interno_empresa) as id from empresa");
			while($row = mysql_fetch_array($sql)){
				return floatval($row['id']) + 1;
			}
		}
		
		public function guardar_bp($und){
			mysql_query("insert into bp_und(und,year) values('".$und."','".date("Y")."')");
		}
		
		public function consultar_id_bp($und){
			$sql = mysql_query("select id from bp_und where und = '$und' and year = '".date("Y")."'");
			while($row = mysql_fetch_array($sql)){
				return $row['id'];
			}
		}
		public function guardar_bp_meses($id,$valor,$mes,$cliente){
			mysql_query("insert into mensual_bp(pk_bp,mes,pptado,cliente) values('".$id."','".$mes."','".$valor."','".$cliente."')");
		}
		public function validad_bp($und){
			$sql = mysql_query("select und from bp_und where und = '$und' and year = '".date("Y")."'");
			if(mysql_num_rows($sql) == 0){
				return true;
			}else{
				return false;
			}
		}
		
		public function bp_grilla($und,$year,$cliente){
			$sql = mysql_query("select m.mes,m.pptado from bp_und b, mensual_bp m where b.und = '$und' and b.year = '$year' and b.id = m.pk_bp and m.cliente = '$cliente'");
			$meses = array("Enero", "Febrero", "Marzo",
			"Abril", "Mayo", "Junio", "Julio",
			"Agosto", "Septiembre", "Octubre",
			"Noviembre", "Diciembre");
			$ta = "<table width = '100%'>";
			$i = 0;
			while($row = mysql_fetch_array($sql)){
				if($row['mes'] == 1 || $row['mes'] == 4 || $row['mes'] == 7 || $row['mes'] == 10){
					$ta.="<tr><td><p>".$meses[$row['mes']-1]."</p><input type = 'text' readonly value = '".number_format($row['pptado'])."' /></td>";
				}else if($row['mes'] == 3 || $row['mes'] == 6 || $row['mes'] == 9 || $row['mes'] == 12){
					$ta.="<td><p>".$meses[$row['mes']-1]."</p><input type = 'text' readonly value = '".number_format($row['pptado'])."' /></td></tr>";
				}else{
					$ta.="<td><p>".$meses[$row['mes']-1]."</p><input type = 'text' readonly value = '".number_format($row['pptado'])."' /></td>";
				}
				
				
			}
			echo $ta."</table>";
		}
		
		public function insert_bp($empresa){
			$sql = mysql_query("select name, id  from und where empresa = '$empresa' order by name asc");
			$option = "";
			while($row = mysql_fetch_array($sql)){
				$option .="<option value = '".$row['id']."'>".$row['name']."</option>";
			}
			$year = "";
			for($i = 2015;$i <= date("Y");$i++){
				$year .="<option value = '$i'>$i</option>";
			}
			while($row = mysql_fetch_array($sql)){
				$option .="<option value = '".$row['id']."'>".$row['name']."</option>";
			}
			
			$list = "";
			while($row= mysql_fetch_array(($sql))){
				$list.="<td align = 'center'>
						<input type = 'text' readonly value = '".$row['year']."' style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;padding:7px;border:0px solid white;width:100px;text-align:center;'/>
					</td>
					<td align = 'center'>
						<input type = 'text' readonly value = '".$row['min_ppto']." %' style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;padding:7px;border:0px solid white;width:100px;text-align:center;'/>
					</td>
				";
			}
			$cliente = "";
			$sql =mysql_query("select codigo_interno_cliente, nombre_comercial_cliente from clientes where estado = '1' order by nombre_comercial_cliente asc");
			while($row= mysql_fetch_array(($sql))){
				$cliente .="<option value = '".$row['codigo_interno_cliente']."'>".strtoupper(utf8_decode($row['nombre_comercial_cliente']))."</option>";
			}
			$ene = '"bp_enero_year"';
			$h_ene = '"h_enero_year"';
			
			$feb = '"bp_febrero_year"';
			$h_feb = '"h_febrero_year"';
			
			$marzo = '"bp_marzo_year"';
			$h_mar = '"h_marzo_year"';
			
			$abri = '"bp_abril_year"';
			$h_abril = '"h_abril_year"';
			
			$may = '"bp_mayo_year"';
			$h_mayo = '"h_mayo_year"';
			
			$jun = '"bp_junio_year"';
			$h_jun = '"h_junio_year"';
			
			$juli = '"bp_julio_year"';
			$h_julio = '"h_julio_year"';
			
			$agos = '"bp_agosto_year"';
			$h_agosto = '"h_agosto_year"';
			
			$septi = '"bp_septiembre_year"';
			$h_septiembre = '"h_septiembre_year"';
			
			$octu = '"bp_octubre_year"';
			$h_octubre = '"h_octubre_year"';
			
			$novie = '"bp_noviembre_year"';
			$h_noviembre = '"h_noviembre_year"';
			
			$dic = '"bp_diciembre_year"';
			$h_diciembre_year = '"h_diciembre_year"';
			$est = "<table width = '100%'>
				
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' >
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano' onclick = 'ocultar_listado_usuarios()'>HISTORICO BP</td>
							<td align = 'left' ><img src = '../images/iconos/mas_blanco.png' width = '30px' onclick = 'ocultar_nuevo_usuario();ocultar_listado_usuarios();'/></td>
						</table>
					</th>
				</tr>
				<tr class = 'hijo_listado_usuario' >
					<td style = 'padding-left:20px;' >
						<table width = '100%' class = 'barra_busqueda' >
							<tr>
								<td style = 'vertical-align:top;'>
									<p>Seleccione una Unidad de Negocio:</p>
									<select id = 'und_bp' style = 'width:auto;'>
										$option
									</select>
								</td>
								<td style = 'vertical-align:top;'>
									<p>Seleccione un Año:</p>
									<select id = 'year_bp'>
										$year
									</select>
								</td>
								<td style = 'vertical-align:top;'>
									<p>Seleccione un Cliente:</p>
									<select id = 'cliente_bp_b'>
										$cliente
									</select>
								</td>
								<td style = 'vertical-align:middle;'>
									<img  src='../images/iconos/lupa_azul.png' class='botones_opciones' onclick = 'buscar_und_bp()' />
								</td>
							</tr>
							<TR>
								<td colspan = '3' id = 'contenedor_list_bp'></td>
							</TR>
						</table>
					</td>
				</tr>
				
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' >NUEVO PLAN DE NEGOCIO</th>
				</tr>
				<tr class = 'hijo_nuevo_usuario' style = 'display:none;'>
					<td style = 'padding-left:20px;'>
						<table width = '100%' class = 'barra_busqueda'>
							<tr>
								<td colspan = '3'>
									<p>Seleccione una Unidad de Negocio:</p>
									<select id = 'n_bp_und' style = 'width:auto;'>
										$option
									</select>
								</td>
							</tr>
							<tr>
								<td colspan = '3'>
									<p>Seleccione un Cliente:</p>
									<select id = 'n_bp_cliente' style = 'width:auto;'>
										$cliente
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<p>Enero:</p>
									<input type = 'text' id = 'bp_enero_year' class = 'entradas_bordes' onkeyup = 'formatear_valor(event,$ene,$h_ene)' />
									<span id = 'h_enero_year' class = 'hidde'></span>
								</td>
								<td>
									<p>Febrero:</p>
									<input type = 'text' id = 'bp_febrero_year' class = 'entradas_bordes'  onkeyup = 'formatear_valor(event,$feb,$h_feb)'/>
									<span id = 'h_febrero_year' class = 'hidde'></span>
								</td>
								<td>
									<p>Marzo:</p>
									<input type = 'text' id = 'bp_marzo_year' class = 'entradas_bordes'  onkeyup = 'formatear_valor(event,$marzo,$h_mar)'/>
									<span id = 'h_marzo_year' class = 'hidde'></span>
								</td>
							</tr>
							<tr>
								<td>
									<p>Abril:</p>
									<input type = 'text' id = 'bp_abril_year' class = 'entradas_bordes' onkeyup = 'formatear_valor(event,$abri,$h_abril)'/>
									<span id = 'h_abril_year' class = 'hidde'></span>
								</td>
								<td>
									<p>Mayo:</p>
									<input type = 'text' id = 'bp_mayo_year' class = 'entradas_bordes' onkeyup = 'formatear_valor(event,$may,$h_mayo)'/>
									<span id = 'h_mayo_year' class = 'hidde'></span>
								</td>
								<td>
									<p>Junio:</p>
									<input type = 'text' id = 'bp_junio_year' class = 'entradas_bordes' onkeyup = 'formatear_valor(event,$jun,$h_jun)'/>
									<span id = 'h_junio_year' class = 'hidde'></span>
								</td>
							</tr>
							<tr>
								<td>
									<p>Julio:</p>
									<input type = 'text' id = 'bp_julio_year' class = 'entradas_bordes' onkeyup = 'formatear_valor(event,$juli,$h_julio)'/>
									<span id = 'h_julio_year' class = 'hidde'></span>
								</td>
								<td>
									<p>Agosto:</p>
									<input type = 'text' id = 'bp_agosto_year' class = 'entradas_bordes' onkeyup = 'formatear_valor(event,$agos,$h_agosto)'/>
									<span id = 'h_agosto_year' class = 'hidde'></span>
								</td>
								<td>
									<p>Septiembre:</p>
									<input type = 'text' id = 'bp_septiembre_year' class = 'entradas_bordes' onkeyup = 'formatear_valor(event,$septi,$h_septiembre)'/>
									<span id = 'h_septiembre_year' class = 'hidde'></span>
								</td>
							</tr>
							<tr>
								<td>
									<p>Octubre:</p>
									<input type = 'text' id = 'bp_octubre_year' class = 'entradas_bordes' onkeyup = 'formatear_valor(event,$octu,$h_octubre)'/>
									<span id = 'h_octubre_year' class = 'hidde'></span>
								</td>
								<td>
									<p>Noviembre:</p>
									<input type = 'text' id = 'bp_noviembre_year' class = 'entradas_bordes' onkeyup = 'formatear_valor(event,$novie,$h_noviembre)'/>
									<span id = 'h_noviembre_year' class = 'hidde'></span>
								</td>
								<td>
									<p>Diciembre:</p>
									<input type = 'text' id = 'bp_diciembre_year' class = 'entradas_bordes' onkeyup = 'formatear_valor(event,$dic,$h_diciembre_year)'/>
									<span id = 'h_diciembre_year' class = 'hidde'></span>
								</td>
							</tr>
							<tr>
								<td></td>
							</tr>
							<tr>
								<td></br></td>
							</tr>
							<tr>
								<td colspan = '3' align = 'center'>
									<span class = 'botton_verde' onclick = 'guardar_nuevo_plan_negocio()' >GUARDAR PLAN DE NEGOCIO</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>";
			echo $est;
		}
		
		public function info_basica_empresa($id){
			$sql = mysql_query("select e.cod_interno_empresa,e.nit_empresa,e.iniciales_empresa, e.nombre_legal_empresa,e.facebook,e.youtube,e.twitter,e.email,e.pagina_web,e.representante_legal, e.nombre_comercial_empresa, e.phone_empresa, e.direccion_empresa, e.nota_orden, e.observacion,e.nota_orden_c ,
			e.ciudad_codigo_ciudad, e.ciudad_departamento_codigo_departamento, e.ciudad_departamento_pais_codigo_pais, e.estado,e.logo,e.logo2
			from empresa e
			where e.cod_interno_empresa = '$id'");
			return $sql;
		}
		
		public function info_basica_empresa_ubicacion($id){
			$sql = mysql_query("select p.nombre_pais, d.nombre_departamento, c.nombre_ciudad,d.codigo_departamento,c.departamento_codigo_departamento, e.ciudad_codigo_ciudad,
			c.codigo_ciudad,d.pais_codigo_pais,p.codigo_pais,e.ciudad_departamento_pais_codigo_pais,e.ciudad_departamento_codigo_departamento
			from empresa e, ciudad c, departamento d, pais p
			where e.cod_interno_empresa = '$id' and e.ciudad_codigo_ciudad = c.codigo_ciudad and 
			c.departamento_codigo_departamento = d.codigo_departamento and d.pais_codigo_pais = p.codigo_pais");
			return $sql;
		}
		
		public function id_empresa($nit){
			$x ="";
			$sql = mysql_query("select cod_interno_empresa from empresa where nit_empresa = '$nit'");
			while($row = mysql_fetch_array($sql)){
				$x = $row['cod_interno_empresa'];
			}
			return $x;
		}
		
		public function mostrar_nombre_empresa($cod){
			$x = "";
			$sql = mysql_query("select nombre_comercial_empresa from empresa where cod_interno_empresa = '$cod'");
			while($row = mysql_fetch_array($sql)){
				$x = utf8_decode($row['nombre_comercial_empresa']);
			}
			echo $x;
		}
		
		public function mostrar_logo_empresa($cod){
			$x = "";
			$sql = mysql_query("select nombre_comercial_empresa,logo from empresa where cod_interno_empresa = '$cod'");
			while($row = mysql_fetch_array($sql)){
				$x = "<img src = '../images/logos/".$row['logo']."' class = 'img_empresa'/>";
			}
			return $x;
		}
		
		
		public function mostrar_logo_empresa2($cod){
			$x = "";
			$sql = mysql_query("select nombre_comercial_empresa,logo from empresa where cod_interno_empresa = '$cod'");
			while($row = mysql_fetch_array($sql)){
				$x = "<img src = '../images/logos/".$row['logo']."' class = 'img_empresa'/>";
			}
			return $x;
		}
		
		function nombre_redes($text){
			$subtext = explode("/",$text);
			$posicion = count($subtext) - 1;
			return $subtext[$posicion];
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
		
		public function update_nombre_representantes($x,$n){
			$sql = mysql_query("update representantes_legales set name = '".utf8_encode($n)."' where id = '$x'");
		}
		
		public function update_estado_representantes($x,$e){
			$sql = mysql_query("update representantes_legales set estado = '$e' where id = '$x'");
		}
		
		public function update_nombre_correo($x,$n){
			$sql = mysql_query("update correos_empresa set name = '$n' where id = '$x'");
		}
		
		public function update_estado_correo($x,$e){
			$sql = mysql_query("update correos_empresa set estado = '$e' where id = '$x'");
		}
		
		public function update_nombre_telefono($x,$n){
			$sql = mysql_query("update telefonos_empresa set name = '$n' where id = '$x'");
		}
		
		public function update_estado_telefono($x,$e){
			$sql = mysql_query("update telefonos_empresa set estado = '$e' where id = '$x'");
		}
		
		public function listar_telefonos($id){
			$sql_repre = mysql_query("select name, id,estado from telefonos_empresa where empresa = '$id' and estado = '1'");
			$representantes = "<table width = '100%'>";
			$i = 0;
			while($repre = mysql_fetch_array($sql_repre)){
				$ix = $repre['id'];
				$es = $repre['estado'];
				$estado = 0;
				if($es == 1){
					$estado = 0;
				}else{
					$estado = 1;
				}
				$representantes .="
				<tr>
					<td>
						<img src = '../images/iconos/eliminar.png' class = 'iconos_eliminar_item' onclick = 'desactivar_telefono($ix,$estado)'/>
					</td>
					<td>
						<input type = 'text' value ='".$this->indicativo($id)." ".strtoupper($repre['name'])."' id = 'phone_r$i'onkeyup = 'modificar_nombre_telefono_empresa(event,$ix,$i)'/>
					</td>
				</tr>";
				$i++;
			}
			return $representantes."</table>";			
		}
		
		public function listar_representantes($id){
			$sql_repre = mysql_query("select name, id,estado from representantes_legales where empresa = '$id' and estado = '1'");
			$representantes = "<table width = '100%'>";
			$i = 0;
			while($repre = mysql_fetch_array($sql_repre)){
				$ix = $repre['id'];
				$es = $repre['estado'];
				$estado = 0;
				if($es == 1){
					$estado = 0;
				}else{
					$estado = 1;
				}
				$representantes .="
				<tr>
					<td>
						<img src = '../images/iconos/eliminar.png' class = 'iconos_eliminar_item' onclick = 'desactivar_representante($ix,$estado)'/>
					</td>
					<td>
						<input type = 'text' value ='".strtoupper(utf8_decode($repre['name']))."' id = 'name_r$i'onkeyup = 'modificar_nombre_representantes_empresa(event,$ix,$i)'/>
					</td>
				</tr>";
				$i++;
			}
			return $representantes."</table>";			
		}
		
		public function listar_correos($id){
			$sql_repre = mysql_query("select name, id,estado from correos_empresa where empresa = '$id' and estado = '1'");
			$representantes = "<table width = '100%'>";
			$i = 0;
			while($repre = mysql_fetch_array($sql_repre)){
				$ix = $repre['id'];
				$es = $repre['estado'];
				$estado = 0;
				if($es == 1){
					$estado = 0;
				}else{
					$estado = 1;
				}
				$representantes .="
				<tr>
					<td>
						<img src = '../images/iconos/eliminar.png' class = 'iconos_eliminar_item' onclick = 'desactivar_correo($ix,$estado)'/>
					</td>
					<td>
						<input type = 'text' value ='".strtoupper($repre['name'])."' id = 'correo_e$i'onkeyup = 'modificar_correo_empresa(event,$ix,$i)'/>
					</td>
				</tr>";
				$i++;
			}
			return $representantes."</table>";			
		}
		
		public function indicativo($emp){
			$sql = mysql_query("select c.indicativo as ciudad, p.indicativo as pais
			from empresa e, ciudad c, pais p,departamento d
			where e.ciudad_codigo_ciudad = c.codigo_ciudad and c.departamento_codigo_departamento = d.codigo_departamento and d.pais_codigo_pais = p.codigo_pais and e.cod_interno_empresa = '$emp'");
			$indicativo = "";
			while($row = mysql_fetch_array($sql)){
				$indicativo = "(".$row['pais']." ".$row['ciudad'].")";
			}
			return $indicativo;
		}
		
		public function editar_empresa($sql,$sql_ubicacion){
			$ubicacion = "";
			if(mysql_num_rows($sql_ubicacion) == 0){
				$ubicacion .="
					<td><select id = 'n_pais_empresa' onchange = 'cambiar_pais_empresa()' onclick = 'limpiar_pais(".$row['ciudad_departamento_pais_codigo_pais'].")'>".$this->paises(0)."</select></td>
					<td><select id = 'n_depto_empresa' onchange = 'cargar_ciudad()'><option value = '0'>-</option></td>
					<td><select id = 'n_ciudad_empresa'><option value = '0'>-</option></td>
				";
			}else{
				while($row = mysql_fetch_array($sql_ubicacion)){
					$ubicacion .="
					<td><select id = 'n_pais_empresa' onchange = 'cambiar_pais_empresa()' onclick = 'limpiar_pais(".$row['ciudad_departamento_pais_codigo_pais'].")'>".$this->paises($row['ciudad_departamento_pais_codigo_pais'])."</select></td>
					<td><select id = 'n_depto_empresa' onchange = 'cargar_ciudad()'><option value = '".$row['ciudad_departamento_codigo_departamento']."'>".$row['nombre_departamento']."</option></td>
					<td><select id = 'n_ciudad_empresa'><option value = '".$row['ciudad_codigo_ciudad']."'>".$row['nombre_ciudad']."</option></td>";
				}
			}
			while($row = mysql_fetch_array($sql)){
				$face = "/".$this->nombre_redes($row['facebook']);
				$you = "/".$this->nombre_redes($row['youtube']);
				$twi = "@".$this->nombre_redes($row['twitter']);
				
				$est = "<table width = '100%' >
					<tr>
						<td width = '90%' align = 'left' style = 'padding-left:50px;'>
							<span class = 'mensaje_bienvenida'>INFORMACIÓN EMPRESA</span>
						</td>
						<td>
							<table width = '100%'>
								<tr>
									<td align = 'center'>
										<img src = '../images/iconos/icono_documento.png' class = 'iconos_opciones' onclick = 'function_abrir_panel_documentos()'id = 'abrir_ventana_documentos'/>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right'>
							<table width = '100%'>
								
								<tr>
									<td align = 'center' style = 'border:2px solid #87CDF0;border-radius:0.3em;'>
										<img id = 'cerrar_ventana_info_basica_documentos'src = '../images/iconos/icono_editar.png' class = 'iconos_opciones'/>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right'>
							<table width = '100%'>
								<tr>
									<td align = 'center'>
										<img id = 'cerrar_ventana_info_basica_documentos'src = '../images/iconos/cerrar.png' class = 'iconos_opciones' onclick = 'cerrar_info_basica()' tittle = 'Cerrar Ventana'/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>";
				
				
				$est .= "<div id = 'xcontenedor_info_basica_empleado' style = 'overflow:scroll;width:100%;height:80%;'  >
				<table class = 'tabla_nuevos_datos2' width = '100%' cellpadding = '5' >";
				$id = $row['cod_interno_empresa'];
				$sql_repre = mysql_query("select name, id from correos_empresa where empresa = '$id' and estado = '1'");
				$correos = "<table width = '100%'>";
				while($repre = mysql_fetch_array($sql_repre)){
						$ix = $repre['id'];
					$correos .="
					<tr>
						<td>
							<img src = '../images/iconos/cerrar.png' class = 'iconos_eliminar_item' onclick = 'desactivar_representante($ix)'/>
						</td>
						<td>
							<input type = 'text' value ='".$repre['name']."' />
						</td>
					</tr>";
				}
				$correos.="</table>";
				
				$est .="
					<tr>
						<th align = 'left' colspan = '2' width = '49%' style = 'padding-left:50px;'></th>
						<th class = 'separator'></th>
						<th align = 'left' colspan = '2' width = '48%'></th>
					</tr>
					<tr>
						<td align = 'left' colspan = '2' width = '49%' style = 'padding-left:50px;'>
							<p>Nombre Comercial:</p>
							<input type = 'text' class = 'entradas_bordes' id = 'r_social' value = '".$row['nombre_comercial_empresa']."'/>
						</td>
						<td class = 'separator'></td>
						<td align = 'left' colspan = '2' width = '48%' style = 'padding-right:50px;'>
							<table width = '100%'>
								<tr>
									<td><p>País:</p></td>
									<td><p>Departamento:</p></td>
									<td><p>Ciudad:</p></td>
								</tr>
								<tr>
									$ubicacion
								</tr>
							</table>
							
						</td>
					</tr>
					<tr>
						<td align = 'left' colspan = '2' width = '49%' style = 'padding-left:50px;'>
							<p>Razón Social:</p>
							<input type = 'text' id = 'n_legal' value = '".$row['nombre_legal_empresa']."' />
						</td>
						<td class = 'separator'></td>
						<td  align = 'left' colspan = '2' width = '48%' style = 'padding-right:50px;'>
							<p>Teléfono:</p>
							<input type = 'tel' class = 'entradas_bordes' id = 'phone_empresa_editar' onkeyup = 'guardar_telefono(event)'/>
							<div id = 'lista_telefonos'>
								".$this->listar_telefonos($id)."
							</div>
						</td>
					</tr>
					<tr>
						<td align = 'left' colspan = '2' width = '49%' style = 'padding-left:50px;'>
							<p>Representante Legal:</p>
							<input  type = 'text' name = 'n_re_legal' id = 'n_re_legal' onkeyup = 'guardar_representante(event)'/>
							<div id = 'lista_representante'>
								".$this->listar_representantes($id)."
							</div>
							
						</td>
						<td class = 'separator'></td>
						<td  align = 'left' colspan = '2' width = '48%' style = 'padding-right:50px;'>
							<p>Dirección:</p>
							<input type = 'text' class = 'entradas_bordes' id = 'dir' value = '".$row['direccion_empresa']."'/>
						</td>
					</tr>
					<tr>
						<td align = 'left' colspan = '2' width = '49%' style = 'padding-left:50px;'>
							<p>NIT:</p>
							<input type = 'text' id = 'nit' value = '".$row['nit_empresa']."'readonly/>
						</td>
						<td class = 'separator'></td>
						<td align = 'left' colspan = '2' width = '48%' style = 'padding-right:50px;'>
							<p>Correo:</p>
							<input  type = 'email' name = 'email' id = 'email'  onkeyup = 'guardar_correo(event)'/>
							<div id = 'lista_correos'>
								".$this->listar_correos($id)."
							</div>
						</td>
					</tr>
					<tr>
						<td align = 'center' colspan = '5' style = 'padding-left:50px;'>
							<table width = '100%'>
								<tr>
									<td colspan = '2' >
										<p>Cargar Logo Empresa:</p>
									</td>
									<td class = 'separator'></td>
								</tr>
								<tr>
									<td width = '30%'>
										<input type = 'file' id = 'nuevo_logo_editado' onchange = 'actualizar_foto_miniatura()' />
									</td>
									<td align = 'center'>
										<img src = '../images/iconos/eliminar.png' class ='iconos_eliminar_item' onclick = 'limpiar_nuevo_logo()'/>
									</td>
									<td class = 'separator'></td>
									<td colspan  = '2' width = '40%'>
										<div id = 'foto_logo'>
											<img src = '../images/logos/".$row['logo']."' height = '80px'/>
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<table width = '100%' class = 'tabla_nuevos_datos2'>
					<tr>
						<td align = 'left' colspan = '5' width = '100%' style = 'padding-left:50px;'>
							<table width = '100%'>
								<tr><td colspan = '8'><p>Redes Sociales</p></td></tr>
									<tr>
										<td align = 'right'width = 'auto' style = 'padding-left:50px;'>
											<a href = '".$row['facebook']."'>
												<img src = '../images/iconos/icono_face.png' class ='redes2'/>
											</a>
										</td>
										<td align = 'left' >
											<input type = 'url' id = 'n_face' value = '".$row['facebook']."'/>
										</td>
										<td  align = 'right'>
											<a href = '".$row['twitter']."'>
												<img src = '../images/iconos/icono_twiterr.png' class ='redes2'/>
											</a>
										</td>
										<td align = 'left'>
											<input type = 'url' id = 'n_twitter' value = '".$row['twitter']."'/>
										</td>
									</tr>
									<tr>
										<td align = 'right' style = 'padding-left:50px;'>
											<a href = '".$row['youtube']."'>
												<img src = '../images/iconos/icono_youtube.png' class ='redes2'/>
											</a>
										</td>
										<td align = 'left'>
											<input type = 'url' id = 'n_you' value = '".$row['youtube']."'/>
										</td>
										<td  align = 'right'>
											<a href = '".$row['pagina_web']."'>
												<img src = '../images/iconos/icono_web.png' class ='redes2'/>
											</a>
										</td>
										<td align = 'left'>
											<input type = 'url' id = 'n_pagina' value = '".$row['pagina_web']."'/>
										</td>
									</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan = '2' align = 'left' colspan = '2' width = '49%' style = 'padding-left:50px;'>
							
						</td>
						<td align = 'left' colspan = '2' width = '48%' style = 'padding-right:50px;' >
							
						</td>
					</tr>
					<tr><td></br></td></tr>
					<tr>
						<td colspan = '5' align = 'center'>
							<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' onclick = 'mostrar_info_basica($id)' style = 'position:relative;'>
							<img src = '../images/iconos/guardar_1.png' class = 'iconos_guardar_x'   style = 'position:relative;top:45px;left:-50px;z-index:1;opacity:'>
							<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' onclick = 'modificar_datos_empresa()'  style = 'position:relative;left:-110px;'>
						</td>
					</tr>
					";
			}
			echo $est."</table></div>";
		}
		
		public function estructura_empresa($sql,$sql_ubicacion){
			$ubicacion = "<p>País - Departamento - Ciudad:</p>";
			if(mysql_num_rows($sql_ubicacion) == 0){
				$ubicacion .="<input type = 'text' value = 'SIN REGISTROS' readonly/>";
			}else{
				while($row = mysql_fetch_array($sql_ubicacion)){
					$ubicacion .="<input type = 'text' value = '".$row['nombre_pais']." - ".$row['nombre_departamento']." - ".$row['nombre_ciudad']."' readonly/>";
				}
			}			
			while($row = mysql_fetch_array($sql)){
				$id = $row['cod_interno_empresa'];
				$face = "/".$this->nombre_redes($row['facebook']);
				$you = "/".$this->nombre_redes($row['youtube']);
				$twi = "@".$this->nombre_redes($row['twitter']);
				$est = "<table width = '100%' style = 'padding-right:50px;padding-left:50px;'>
					<tr>
						<td width = '96%' align = 'left'>
							<table width = '100%'>
								<tr>
									<td>
										<img src = '../images/logos/".$row['logo']."'  class = 'img_empresa'/>			
									</td>
								</tr>
								<tr>
									<td >
										<span class = 'mensaje_bienvenida'>INFORMACIÓN EMPRESA</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right'>
							<table width = '100%'>
								<tr>
									<td align = 'center'>
										<img src = '../images/iconos/icono_documento.png' class = 'iconos_opciones' onclick = 'function_abrir_panel_documentos()'/>
									</td>
									<td align = 'center'>
										<img id = 'cerrar_ventana_info_basica_documentos'src = '../images/iconos/icono_editar.png' class = 'iconos_opciones' onclick = 'editar_empresa_gestion($id)'/>
									</td>
									<td align = 'center'>
										<img id = 'cerrar_ventana_info_basica_documentos'src = '../images/iconos/cerrar.png' class = 'iconos_opciones' onclick = 'cerrar_info_basica()' tittle = 'Cerrar Ventana'/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table></br>";
				$est .= "<div id = 'xcontenedor_info_basica_empleado' style = 'overflow:scroll;width:100%;height:80%;'><table class = 'tabla_nuevos_datos' width = '100%' height = '100%'>";
				$id = $row['cod_interno_empresa'];
				$sql_repre = mysql_query("select name, id from representantes_legales where empresa = '$id' and estado = '1'");
				$representantes = "";
				while($repre = mysql_fetch_array($sql_repre)){
					$representantes .="<input type = 'text' value ='".strtoupper($repre['name'])."' readonly/>";
				}
				$sql_repre = mysql_query("select name, id from correos_empresa where empresa = '$id' and estado = '1'");
				$correos = "";
				while($repre = mysql_fetch_array($sql_repre)){
					$correos .= "<input type = 'text' value ='".$repre['name']."' readonly/>";
				}
				$sql_repre = mysql_query("select name, id from telefonos_empresa where empresa = '$id' and estado = '1'");
				$telefono_x = "";
				while($repre = mysql_fetch_array($sql_repre)){
					$telefono_x .= "<input type = 'text' value ='".$this->indicativo($id)." ".$repre['name']."' readonly/>";
				}
				$est .="
					<tr>
						<td align = 'left' colspan = '2' width = '70%' style = 'padding-left:50px;'>
							<p>Nombre Comercial:</p>
							<input type = 'text' class = 'entradas_bordes' id = 'r_social' value = '".$row['nombre_comercial_empresa']."' readonly/>
						</td>
						<td class = 'separator' width = '2%'></td>
						<td align = 'left' colspan = '2' width = '48%' style = 'padding-right:50px;'>
							$ubicacion
						</td>
					</tr>
					<tr>
						<td align = 'left' colspan = '2' width = '48%' style = 'padding-left:50px;'>
							<p>Razón Social:</p>
							<input type = 'text' id = 'n_legal' value = '".$row['nombre_legal_empresa']."' readonly/>
						</td>
						<td class = 'separator' width = '2%'></td>
						<td  align = 'left' colspan = '2' width = '48%' style = 'padding-right:50px;'>
							<p>Teléfono:</p>
							$telefono_x
						</td>
					</tr>
					<tr>
						<td align = 'left' colspan = '2' width = '48%' style = 'padding-left:50px;'>
							<p>Representante Legal:</p> 
							$representantes
						</td>
						<td class = 'separator' width = '2%'></td>
						<td  align = 'left' colspan = '2' width = '48%' style = 'padding-right:50px;'>
							<p>Dirección:</p>
							<input type = 'text' class = 'entradas_bordes' id = 'dir' value = '".$row['direccion_empresa']."'readonly/>
							
						</td>
					</tr>
					<tr>
						<td align = 'left' colspan = '2' width = '48%' style = 'padding-left:50px;'>
							<p>NIT:</p>
							<input type = 'text' id = 'nit' value = '".$row['nit_empresa']."'readonly/>
						</td>
						<td class = 'separator' width = '2%'></td>
						<td align = 'left' colspan = '2' width = '48%' style = 'padding-right:50px;'>
							<p>Correo:</p>
							$correos
						</td>
					</tr>
					<tr>
						<td colspan = '5' width = '100%'>
							<table width = '100%'>
								<tr><td align = 'left' colspan = '5'  style = 'padding-left:50px;' ><span class = 'mensaje_bienvenida'>Redes Sociales</span></td></tr>
								<tr>
									<td width = '25%' align = 'center'>
										<a href = '".$row['facebook']."'>
											<img src = '../images/iconos/icono_face.png' class ='redes2'/>
										</a>
									</td>
									<td width = '25%' align = 'center'>
										<a href = '".$row['twitter']."'>
											<img src = '../images/iconos/icono_twiterr.png' class ='redes2'/>
										</a>
									</td>
									<td width = '25%' align = 'center'>
										<a href = '".$row['youtube']."'>
											<img src = '../images/iconos/icono_youtube.png' class ='redes2'/>
										</a>
									</td>
									<td width = '25%' align = 'center'>
										<a href = '".$row['pagina_web']."'>
											<img src = '../images/iconos/icono_web.png' class ='redes2'/>
										</a>
									</td>
								</tr>
								<tr>
									<td width = '25%' align = 'center'>".$row['facebook']."</td>
									<td  width = '25%' align = 'center'>".$row['twitter']."</td>
									<td width = '25%' align = 'center'>".$row['youtube']."</td>
									<td  width = '25%' align = 'center'>".$row['pagina_web']."</td>
								</tr>
							</table>
						</td>
					</tr>";
			}
			echo $est.="</table></div>";
		}
		
		public function insert_empresa($img1,$img2){
			$est = 1;
			$accion = "INSERT INTO empresa(nit_empresa,nombre_legal_empresa,nombre_comercial_empresa,iniciales_empresa,phone_empresa,direccion_empresa,nota_orden,observacion,ciudad_codigo_ciudad,ciudad_departamento_codigo_departamento,ciudad_departamento_pais_codigo_pais,fecha_registro,estado,logo,logo2,email,pagina_web,facebook,twitter,youtube,representante_legal,nota_orden_c) ";
			$accion .= "values('".$this->get_nit()."','".utf8_encode($this->get_nlegal())."','".
			utf8_encode($this->get_ncomercial())."','".$this->get_iniciales()."','".$this->get_phone()."','".$this->get_direccion()."','".$this->get_nota()."','".$this->get_nota_ppto().
			"','".$this->get_ciudad()."','".$this->get_depto()."','".$this->get_pais()."','".date("Y-m-d h:m:s")."','".$est."','".$img1."','".$img2."','".$this->get_correo().
			"','".$this->get_web()."','".$this->get_facebook()."','".$this->get_twitter()."','".$this->get_youtube()."','".$this->get_rlegal()."','".$this->get_noc()."')";
			$result = mysql_query($accion);
		}
		
		public function insert_documento($name,$empresa,$tipo){
			$accion = "INSERT INTO(name,pk_empresa,pk_tdoc) 
			values('".$name."','".$empresa."','".$tipo."')";
			$result = mysql_query($accion);
		}
		
		public function modificar_empresa($emp){
			$accion = "UPDATE empresa SET nombre_legal_empresa = '".$this->get_nlegal()."', nombre_comercial_empresa = '".$this->get_ncomercial().
			"', iniciales_empresa = '".$this->get_iniciales()."', ciudad_departamento_pais_codigo_pais = '".$this->get_pais()."', direccion_empresa = '".$this->get_direccion().
			"', nota_orden = '".$this->get_nota()."', observacion = '".$this->get_nota_ppto()."', fecha_registro = '".date("Y-m-d h:m:s").
			"',email = '".$this->get_correo()."',pagina_web ='".$this->get_web()."',facebook ='".$this->get_facebook()."',twitter ='".$this->get_twitter().
			"',youtube ='".$this->get_youtube()."',ciudad_codigo_ciudad ='".$this->get_ciudad()."',ciudad_departamento_codigo_departamento = '".$this->get_depto()."' where cod_interno_empresa ='$emp'";
			$result = mysql_query($accion);
		}
		
		public function modificar_empresa_logo($emp,$file){
			$accion = "UPDATE empresa SET nombre_legal_empresa = '".$this->get_nlegal()."', nombre_comercial_empresa = '".$this->get_ncomercial().
			"', iniciales_empresa = '".$this->get_iniciales()."', ciudad_departamento_pais_codigo_pais = '".$this->get_pais()."', direccion_empresa = '".$this->get_direccion().
			"', nota_orden = '".$this->get_nota()."', observacion = '".$this->get_nota_ppto()."', fecha_registro = '".date("Y-m-d h:m:s").
			"',email = '".$this->get_correo()."',pagina_web ='".$this->get_web()."',facebook ='".$this->get_facebook()."',twitter ='".$this->get_twitter().
			"',youtube ='".$this->get_youtube()."',ciudad_codigo_ciudad ='".$this->get_ciudad()."',ciudad_departamento_codigo_departamento = '".$this->get_depto()."',logo = '".$file."' where cod_interno_empresa ='$emp'";
			$result = mysql_query($accion);
		}
		
		public function modificar_empresa_logos_ambos($emp,$file,$file2){
			$accion = "UPDATE empresa SET nombre_legal_empresa = '".$this->get_nlegal()."', nombre_comercial_empresa = '".$this->get_ncomercial().
			"', iniciales_empresa = '".$this->get_iniciales()."', phone_empresa = '".$this->get_phone()."', direccion_empresa = '".$this->get_direccion().
			"', nota_orden = '".$this->get_nota()."', observacion = '".$this->get_nota_ppto()."', fecha_registro = '".date("Y-m-d h:m:s").
			"',email = '".$this->get_correo()."',pagina_web ='".$this->get_web()."',facebook ='".$this->get_facebook()."',twitter ='".$this->get_twitter().
			"',youtube ='".$this->get_youtube()."',representante_legal ='".$this->get_rlegal()."',nota_orden_c = '".$this->get_noc()."',logo2 = '".$file."',logo ='".$file2."' where cod_interno_empresa ='$emp'";
			$result = mysql_query($accion);
		}
		
		public function modificar_empresa_bienvenida($emp,$file){
			$accion = "UPDATE empresa SET nombre_legal_empresa = '".$this->get_nlegal()."', nombre_comercial_empresa = '".$this->get_ncomercial().
			"', iniciales_empresa = '".$this->get_iniciales()."', phone_empresa = '".$this->get_phone()."', direccion_empresa = '".$this->get_direccion().
			"', nota_orden = '".$this->get_nota()."', observacion = '".$this->get_nota_ppto()."', fecha_registro = '".date("Y-m-d h:m:s").
			"',email = '".$this->get_correo()."',pagina_web ='".$this->get_web()."',facebook ='".$this->get_facebook()."',twitter ='".$this->get_twitter().
			"',youtube ='".$this->get_youtube()."',representante_legal ='".$this->get_rlegal()."',nota_orden_c = '".$this->get_noc()."',logo2 = '".$file."' where cod_interno_empresa ='$emp'";
			$result = mysql_query($accion);
		}
		
		public function eliminar_empresa(){
			
		}
		
		public function update_nota_ppto($text,$emp){
			$sql = mysql_query("update empresa set observacion = '$text' where cod_interno_empresa = '$emp'");
		}
		public function update_nota_oc($text,$emp){
			$sql = mysql_query("update empresa set nota_orden_c = '$text' where cod_interno_empresa = '$emp'");
		}
		public function update_nota_op($text,$emp){
			$sql = mysql_query("update empresa set nota_orden = '$text' where cod_interno_empresa = '$emp'");
		}


		public function valor_minimo_utilidad_ppto($empresa){
			$sql = mysql_query("select min_ppto,year from administrativa where empresa = '$empresa' order by year desc");
			$list = "";
			while($row= mysql_fetch_array(($sql))){
				$list.="<tr>
					<td align = 'center'>
						<input type = 'text' readonly value = '".$row['year']."' style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;padding:7px;border:0px solid white;width:100px;text-align:center;'/>
					</td>
					<td align = 'center'>
						<input type = 'text' readonly value = '".$row['min_ppto']." %' style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;padding:7px;border:0px solid white;width:100px;text-align:center;'/>
					</td>
				</tr>
				";
			}
			$est = "<table width = '100%' style = 'font-size:12px;'>
				
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' >
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano' onclick = 'ocultar_listado_usuarios()'>HISTORICO MIN. PPTO</td>
							<td align = 'left' ><img src = '../images/iconos/mas_blanco.png' width = '30px' onclick = 'ocultar_nuevo_usuario();ocultar_listado_usuarios();'/></td>
						</table>
					</th>
				</tr>
				<tr class = 'hijo_listado_usuario' >
					<td style = 'padding-left:20px;' >
						<table width = '100%' >
							<tr>
								<th>AÑO</th>
								<th>PORCENTAJE (%)</th>
							</tr>
							<TR>
								$list
							</TR>
						</table>
					</td>
				</tr>
				
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' >NUEVO % MIN PPTOS</th>
				</tr>
				<tr class = 'hijo_nuevo_usuario' style = 'display:none;'>
					<td style = 'padding-left:20px;'>
						<table width = '100%' class = 'barra_busqueda'>
							<tr>
								<td>
									<p>Ingrese un Nuevo Porcentaje:</p>
									<input type = 'text' id = 'n_valor_min_ppto_emp' class = 'entradas_bordes' />
								</td>
							</tr>
							<tr>
								<td colspan = '2' align = 'center'>
									<span class = 'botton_verde' onclick = 'guardar_nuevo_porcentaje_pptos_empresa()' id = 'boton_guardar_n_usuario'>GUARDAR PORCENTAJE</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>";
			echo $est;
		}

		public function insert_nuevo_porcentaje_ppto($valor,$emp){
			$sql = mysql_query("select year from administrativa where empresa = '$emp' and year = '".date("Y")."' and min_ppto = '0'");
			mysql_query("update administrativa set min_ppto = '$valor' where empresa  = '$emp' and year = '".date("Y")."'");
			echo "VALOR REGISTRADO";
		}

		public function nota_ordenes_ppto($empresa){
			$est = "<table width = '100%' style = 'border-spacing:5px;'>";
			$sql = mysql_query("select nota_orden, nota_orden_c, observacion from empresa where cod_interno_empresa = '$empresa'");
			while($row = mysql_fetch_array($sql)){
				$est .= "
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' >
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;' class = 'mano' onclick = 'ocultar_nota_ppto()'>NOTA DE PRESUPUESTO</td>
						</table>
					</th>
				</tr>
				<tr class = 'hijo_nota_ppto' >
					<td>
						<table width = '100%' class = 'tabla_nuevos_datos'>
							<tr>
								<td align = 'justify' id = 'text_nota_ppto_contenedor' >".utf8_decode($row['observacion'])."</td>
							</tr>
							<tr><td align = 'center' id = 'img_nota_ppto'>
								<img src = '../images/iconos/icono_editar.png' class = 'botones_opciones' title = 'Editar Nota Presupuesto' onclick = 'editar_nota_ppto()'/>
							</td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' >
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;' class = 'mano' onclick = 'ocultar_nota_op()'>NOTA ORDENES DE PRODUCCIÓN</td>
						</table>
					</th>
				</tr>
				<tr class = 'hijo_nota_op' >
					<td>
						<table width = '100%' class = 'tabla_nuevos_datos'>
							<tr>
								<td align = 'justify' id = 'text_nota_oop' >".utf8_decode($row['nota_orden'])."</td>
							</tr>
							<tr><td align = 'center' id = 'img_nota_oop'>
								<img src = '../images/iconos/icono_editar.png' class = 'botones_opciones' title = 'Editar Nota Orden de Producción' onclick = 'editar_nota_oop()'/>
							</td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' >
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;' class = 'mano' onclick = 'ocultar_nota_oc()'>NOTA ORDENES DE COMPRA</td>
						</table>
					</th>
				</tr>
				<tr class = 'hijo_nota_oc' >
					<td>
						<table width = '100%' class = 'tabla_nuevos_datos'>
							<tr>
								<td align = 'justify' id = 'text_nota_ooc' >".utf8_decode($row['nota_orden_c'])."</td>
							</tr>
							<tr><td align = 'center' id = 'img_nota_ooc'>
								<img src = '../images/iconos/icono_editar.png' class = 'botones_opciones' title = 'Editar Nota Orden de Compra' onclick = 'editar_nota_ooc()'/>
							</td></tr>
						</table>
					</td>
				</tr>
				";
			}
			echo $est;
		}
		
	}

?>