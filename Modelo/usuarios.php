<?php
	class usuario{
		public $nombre_usuario;
		public $pk_empleado;
		public $password;
		public $nickname;
		
		
		
		public function get_nombre_usuario(){
			return $this->nickname;
		}
		public function set_nombre_usuario($n){
			$this->nickname = $n;
		}
		
		public function get_pk_empleado(){
			return $this->pk_empleado;
		}
		public function set_pk_empleado($nick){
			$this->pk_empleado = $nick;
		}
		
		
		public function get_pass(){
			return $this->password;
		}
		public function set_pass($nick){
			$this->password = $nick;
		}
	
				
		public function mostrar_datos_s($emp){
			$sql = mysql_query("select u.estado, u.nick, e.nombre_empleado from usuario u, empleado e 
			where u.pk_empleado = e.documento_empleado and e.pk_empresa = '$emp' order by e.nombre_empleado asc");
			return $sql;
		}
		public function mostrar_datos_x_usuario($id){
			$sql = mysql_query("select u.estado, u.nick, e.nombre_empleado from usuario u, empleado e 
			where u.pk_empleado = e.documento_empleado and e.documento_empleado = '$id' order by e.nombre_empleado asc");
			return $sql;
		}
		public function consultar_logeo($usuario,$password){
			
		}
		
		public function insert_usuario($usuario,$fecha,$perfil,$depto){
			$est = 1;
			$sql = mysql_query("insert into usuario(pk_empleado,nick,fecha,usu,estado,perfil,depto) values
			('".$this->get_pk_empleado()."','".$this->get_nombre_usuario()."','".$fecha."','".$usuario."','".
			$est."','".$perfil."','".$depto."')");
			echo mysql_error();
		}
		
		public function update_estado_usuario($id,$est){
			mysql_query("update usuario set estado = '$est' where idusuario = '$id'");
		}
		
		
		public function filtrar_usuario($emp){
			
		}
		
		public function update_contrasena($id){
			mysql_query("update usuario set contrasena = '' where idusuario = '$id'");
		}
		
		public function id_usuario_consultar($name,$pk_empleado){
			$sql = mysql_query("select idusuario from usuario where nick = '$name' and pk_empleado = '$pk_empleado'");
			while($row = mysql_fetch_array($sql)){
				return $row['idusuario'];
			}
		}
		
		public function estrutura_tabla_usuarios($result){
			$tabla = "<table width = '100%' class = 'tablas_muestra_datos_tablas' style = 'font-size:12px;'>
				<tr>
					<th>Nombre</th>
					<th>Usuario</th>
					<th>Estado</th>
					<th></th>
					<th></th>
				</tr>";
			while($row = mysql_fetch_array($result)){
				$id = $row['idusuario'];
				$estado = "";
				if($row['estado'] == 1){
					$estado = "ACTIVO";
				}else{
					$estado = "INACTIVO";
				}
				$tabla .= "<tr id = '$id'>
					<td nowrap>".$row['nombre_empleado']."</td>
					<td nowrap>".$row['nick']."</td>
					<td>".$estado."</td>
					<td><img src = '../images/iconos/activo.png' onclick = 'cambiar_estado_depto($id)'/></td>
					<td><img src = '../images/iconos/activo.png' onclick = 'editar_depto($id)' class = 'botones'/></td>
				</tr>";
			}
			$tabla .="</table>";
			echo $tabla;
		}
		
		public function buscar_n_usuario($name){
			$sql = mysql_query("select pk_empleado from usuario where nick = '$name'");
			return mysql_num_rows($sql);
		}
		
		public function eliminar_responsable($id){
			mysql_query("delete from pasig where consecutivo = '$id'");
		}
		public function elimininar_asignado_usuario($id){
			mysql_query("delete from prespon where consecutivo = '$id'");
		}
		
		public function insert_asignado($emp,$depto,$usuario,$asignado,$fecha){
			for($i = 0;$i < count($asignado);$i++){
				mysql_query("insert into prespon(usuario,asignado,pk_empresa,pk_depto,fecha) values('".$usuario."','".$asignado[$i]."','".$emp."','".$depto."','".$fecha."')");
			}
			
		}
		
		public function list_productos_cliente($cliente,$usuario,$empresa){
			$sql = mysql_query("select pro.nombre_producto, pro.id_procliente
			from producto_clientes pro
			where pro.pk_clientes_nit_procliente = '$cliente' and pro.id_procliente not in(select px.cod_producto from pcliepro px where px.cod_usuario = '$usuario' and px.pk_empresa = '$empresa' and px.cod_cliente = '$cliente') order by pro.nombre_producto asc");
			$tabla = "<table style = 'font-size:12px;'>";
			while($row = mysql_fetch_array($sql)){
				$id = $row['id_procliente'];
				$tabla.="<tr><td width = '20%' nowrap>
							<div><input type = 'checkbox' name = 'productos_permisos[]' id = 'productos_permisos$id' value = '".$row['id_procliente']."' class = 'radio'/>
							<label for='productos_permisos$id'><span><span></span></span>".strtoupper($row['nombre_producto'])."</label></div>
						</td></tr>";
			}
			echo $tabla."</table>";
		}
		
		public function permisos_clientes_producto($empresa){
			$sql_usuario = mysql_query("SELECT c.codigo_interno_cliente,c.nombre_comercial_cliente  
			from clientes c, asocliemp a
			where c.estado = '1' and a.pk_nit_cliente_empresa_asoc = c.codigo_interno_cliente and a.pk_nit_empresa_cliente_asoc = '$empresa' order by c.nombre_comercial_cliente asc");
			$list_cliente = "<option value = '0'>[SELECCIONE]</option>";
			while($row = mysql_fetch_array($sql_usuario)){
				$list_cliente.="<option value = '".$row['codigo_interno_cliente']."'>".strtoupper($row['nombre_comercial_cliente'])."</option>";
			}
			$sql_usuario = mysql_query("SELECT distinct  e.nombre_empleado, e.documento_empleado,u.idusuario from empleado e, usuario u where u.pk_empleado = e.documento_empleado and u.estado = '1' order by e.nombre_empleado asc");
			$list_usuarios = "<option value = '0'>[SELECCIONE]</option>";
			while($row = mysql_fetch_array($sql_usuario)){
				$list_usuarios.="<option value = '".$row['idusuario']."'>".strtoupper($row['nombre_empleado'])."</option>";
			}
			$est = "<table width = '100%' style = 'font-size:12px;'>
			
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' >
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano' onclick = 'ocultar_listado_usuarios()'>PERMISOS CLIENTES</td>
							<td align = 'left' ><img src = '../images/iconos/mas_blanco.png' width = '30px' onclick = 'ocultar_nuevo_usuario();ocultar_listado_usuarios();'/></td>
						</table>
					</th>
				</tr>
				<tr class = 'hijo_listado_usuario' >
					<td style = 'padding-left:20px;' >
						<table width = '100%' class = 'barra_busqueda2'>
							<tr>
								<td>
									<p>Seleccione un Usuario:</p>
									<select id = 'list_usuario_clientes_permisos' >$list_usuarios</select>
								</td>
								<td style = 'vertical-align:bottom;'>
									<img src = '../images/iconos/lupa_azul.png' class = 'botones_opciones' onclick = 'buscar_asignados_por_cuenta()' />
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class = 'hijo_listado_usuario' >
					<td style = 'padding-left:20px;' ><div style = 'overflow:scroll;width:100%; height:250px;'id = 'contenedor_list_asignados_usuario'</td>
				</tr>
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' >ASIGNAR CUENTA</th>
				</tr>
				<tr class = 'hijo_nuevo_usuario' style = 'display:none;'>
					<td style = 'padding-left:20px;'>
						<table width = '100%' class = 'barra_busqueda'>
							<tr>
								<td>
									<p>Seleccione un Usuario:</p>
									<select id = 'listado_usuarios_sistema_asignados' style = 'width:auto;'>$list_usuarios</select>
								</td>
							</tr>
							<tr>
								<td>
									<p>Seleccione un Cliente:</p>
									<select id = 'listado_cliente_permisos_p' onchange = 'buscar_productos_clientes_libres()'  style = 'width:auto;'>$list_cliente</select>
								</td>
							</tr>
							<tr>
								<td colspan = '2'>
									<p>Seleccione un Producto:</p>
									<div id = 'contenedor_productos_list'style = 'overflow:scroll;height:150px;width:100%'>
									
									</div>
								</td>
							</tr>
							<tr>
								<td></br></td>
							</tr>
							<tr>
								<td colspan = '2' align = 'center'>
									<span class = 'botton_verde' onclick = 'guardar_cliente_producto_usuario()' id = 'boton_guardar_n_usuario'>ASIGNAR PRODUCTO</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>";
			echo $est;
			
		}
		
		
		
		public function asignados_por_usuario($usuario){
			
			$sql_valida_camino = mysql_query("select estado
			from param_deptos_trafico
			where estado = 1");
			
			$sql = "";
			if(mysql_num_rows($sql_valida_camino) == 0){
				$sql = mysql_query("select e.nombre_empleado, p.consecutivo,ar.nombre_area_empresa,es.nombre_comercial_empresa,P.fecha
				from empleado e, usuario u, prespon p, area_empresa ar, empresa es
				where p.asignado = u.idusuario and u.pk_empleado = e.documento_empleado and p.usuario = '$usuario' and p.pk_depto = ar.codigo_interno_empresa and p.pk_empresa = es.cod_interno_empresa order by e.nombre_empleado asc");
			}else{
				$sql = mysql_query("select e.nombre_empleado, p.consecutivo,ar.name_depto as nombre_area_empresa,P.fecha
				from empleado e, usuario u, prespon p, deptos_trafico ar
				where p.asignado = u.idusuario and u.pk_empleado = e.documento_empleado and p.usuario = '$usuario' and u.depto = ar.id order by ar.name_depto asc");
			}
			
			
			$tabla = "<table  width = '100%' class = 'tablas_muestra_datos_tablas' style = 'font-size:12px;'>
				<tr>
					<th>NOMBRE</th>
					<th>DEPARTAMENTO</th>
					<th>FECHA</th>
				</tr>
			";
			while($row = mysql_fetch_array($sql)){
				$id = $row['consecutivo'];
				$tabla.="<tr>
					<td>".strtoupper($row['nombre_empleado'])."</td>
					<td>".strtoupper($row['nombre_area_empresa'])."</td>
					<td nowrap>".strtoupper($row['fecha'])."</td>
					<td><img src = '../images/iconos/eliminar.png' width='30px' height = 'auto' title = '¿Eliminar?' onclick = 'eliminar_asignado_usuario_r($id)'/></td>
				</tr>";
			}
			return $tabla."</table>";
		}
		
		public function buscar_usuarios_por_depto($depto,$usu){
			$sql = mysql_query("select e.nombre_empleado, u.idusuario
			from empleado e, usuario u
			where u.estado = '1' and u.depto = '$depto'  and u.pk_empleado = e.documento_empleado and u.estado = '1' and u.idusuario not in(select asignado from prespon where usuario = '$usu') 
			order by e.nombre_empleado asc ");
			//$list_usuarios = "<option value = '0'>[SELECCIONE]</option>";
			$list_usuarios = "<table width = '100%' style = 'font-size:12px;'>";
			while($row = mysql_fetch_array($sql)){
				$list_usuarios .="<tr><td><div>
									<input type = 'checkbox' id = 'depto_per".$row['idusuario']."' name = 'list_permisos_empleados[]' value = '".$row['idusuario']."'  class = 'radio' checked/>
									<label for='depto_per".$row['idusuario']."' nowrap><span><span></span></span>".strtoupper($row['nombre_empleado'])."</label>
								</div></td></tr>";
				//$list_usuarios.="<option value = '".$row['idusuario']."'>".strtoupper($row['nombre_empleado'])."</option>";
			}
			return $list_usuarios."</table>";
		}
		
		public function asignados_usuarios($empresa){
			$sql_usuario = mysql_query("SELECT distinct  e.nombre_empleado, e.documento_empleado,u.idusuario from empleado e, usuario u where u.pk_empleado = e.documento_empleado and u.estado = '1'  order by e.nombre_empleado asc");
			$list_usuarios = "<option value = '0'>[SELECCIONE]</option>";
			while($row = mysql_fetch_array($sql_usuario)){
				$list_usuarios.="<option value = '".$row['idusuario']."'>".strtoupper($row['nombre_empleado'])."</option>";
			}
			
			$sql_valida_camino = mysql_query("select estado
			from param_deptos_trafico
			where estado = 1");
			
			$sql_deptos = "";
			if(mysql_num_rows($sql_valida_camino) == 0){
				$sql_deptos = mysql_query("SELECT ar.codigo_interno_empresa,ar.nombre_area_empresa from area_empresa ar where estado = '1' order by ar.nombre_area_empresa asc");
			}else{
				$sql_deptos = mysql_query("SELECT ar.id as codigo_interno_empresa,ar.name_depto as nombre_area_empresa from deptos_trafico ar order by ar.name_depto asc");
			}
			
			$list_deptos = "<option value = '0'>[SELECCIONE]</option>";
			while($row = mysql_fetch_array($sql_deptos)){
				$list_deptos.="<option value = '".$row['codigo_interno_empresa']."'>".strtoupper($row['nombre_area_empresa'])."</option>";
			}
			$est = "<table width = '100%' style = 'font-size:12px;'>
				
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' >
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;width:96%;font-size:12px;' class = 'mano' onclick = 'ocultar_listado_usuarios()'>ASIGNADOS</td>
							<td align = 'left' ><img src = '../images/iconos/mas_blanco.png' width = '20px' onclick = 'ocultar_nuevo_usuario();ocultar_listado_usuarios();'/></td>
						</table>
					</th>
				</tr>
				<tr class = 'hijo_listado_usuario' >
					<td style = 'padding-left:20px;' >
						<table width = '100%' class = 'barra_busqueda2'>
							<tr>
								<td>
									<p>Seleccione un Usuario:</p>
									<select id = 'list_usuarios_asignados'  >$list_usuarios</select>
								</td>
								<td style = 'vertical-align:bottom;'>
									<img src = '../images/iconos/lupa_azul.png' width = '30px' onclick = 'buscar_asignados_por_usuario()'/>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class = 'hijo_listado_usuario' >
					<td style = 'padding-left:20px;' ><div stye = 'width:100%; height:400px;'id = 'contenedor_list_asignados_usuario'</td>
				</tr>
				<tr>
					<th style = 'font-size:12px;'class='titulos_gestion_azul_x' align = 'left' >NUEVO ASIGNADO</th>
				</tr>
				<tr class = 'hijo_nuevo_usuario' style = 'display:none;'>
					<td style = 'padding-left:20px;'>
						<table width = '100%' class = 'barra_busqueda'>
							<tr>
								<td>
									<p>Seleccione un Usuario:</p>
									<select id = 'listado_usuarios_sistema_asignados' onchange = 'update_list_deptos()' style = 'width:auto;'>$list_usuarios</select>
								</td>
								<td>
									<p>Seleccione el Departamento:</p>
									<select id = 'listado_deptos_empresa' onchange = 'buscar_empleados_depto_usuarios()' style = 'width:auto;'>$list_deptos</select>
								</td>
							</tr>
							<tr>
								<td>
									<p>Seleccione el Asignado:</p>
									<div id = 'listado_usuario_por_asignar' style = 'overflow:scroll;height:180px;width:100%;'></div>
								</td>
							</tr>
							<tr>
								<td></br></td>
							</tr>
							<tr>
								<td colspan = '2' align = 'center'>
									<span style = 'font-size:12px;' class = 'botton_verde' onclick = 'guardar_info_nuevo_usuario_asignado()' id = 'boton_guardar_n_usuario'>GUARDAR NUEVO ASIGNADO</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>";
			echo $est;
		}
		
		public function responsables_deptos($empresa){
			$sql_usuario = mysql_query("SELECT e.nombre_empleado, e.documento_empleado,u.idusuario from empleado e, usuario u where u.pk_empleado = e.documento_empleado and u.estado = '1'  order by e.nombre_empleado asc");
			$list_usuarios = "<option value = '0'>[SELECCIONE]</option>";
			while($row = mysql_fetch_array($sql_usuario)){
				$list_usuarios.="<option value = '".$row['idusuario']."'>".strtoupper($row['nombre_empleado'])."</option>";
			}
			
			$sql_valida_camino = mysql_query("select estado
			from param_deptos_trafico
			where estado = 1");
			
			$sql_deptos = "";
			if(mysql_num_rows($sql_valida_camino) == 0){
				$sql_deptos = mysql_query("SELECT ar.codigo_interno_empresa,ar.nombre_area_empresa from area_empresa ar where ar.pk_empresa_areas = '$empresa'  order by ar.nombre_area_empresa asc");
			}else{
				$sql_deptos = mysql_query("SELECT id,name_depto from deptos_trafico order by name_depto asc");
			}
		
			$list_deptos = "<option value = '0'>[SELECCIONE]</option>";
			while($row = mysql_fetch_array($sql_deptos)){
				$list_deptos.="<option value = '".$row['id']."'>".strtoupper($row['name_depto'])."</option>";
			}
			
			$sql_valida_camino = mysql_query("select estado
			from param_deptos_trafico
			where estado = 1");
			
			$sql_deptos_asignados = "";
			if(mysql_num_rows($sql_valida_camino) == 0){
				$sql_deptos_asignados = mysql_query("select ar.nombre_area_empresa, e.nombre_empleado,p.consecutivo,p.fecha
				from area_empresa ar, empleado e, usuario u, pasig p
				where p.usuario = u.idusuario and u.pk_empleado = e.documento_empleado and p.pk_depto = ar.codigo_interno_empresa and ar.pk_empresa_areas = '$empresa' order by e.nombre_empleado asc");
			}else{
				$sql_deptos_asignados = mysql_query("select ar.name_depto as nombre_area_empresa, e.nombre_empleado,p.consecutivo,p.fecha
				from deptos_trafico ar, empleado e, usuario u, pasig p
				where p.usuario = u.idusuario and u.pk_empleado = e.documento_empleado and p.pk_depto = ar.id order by e.nombre_empleado asc");
			}
			
			$tabla = "<table width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>EMPLEADO</th>
					<th>DEPARTAMENTO</th>
					<th>FECHA</th>
				</tr>";
				
			while($row = mysql_fetch_array($sql_deptos_asignados)){
				$img = "";
				
				$id = $row['consecutivo'];
				$img = "<img src = '../images/iconos/eliminar.png' width='55px' height = 'auto' title = '¿Eliminar?' onclick = 'eliminar_responsable_departamento($id)'/>";
				$tabla.="<tr id = 'asigdeptos$id'>
					<td>".strtoupper($row['nombre_empleado'])."</td>
					<td>".strtoupper($row['nombre_area_empresa'])."</td>
					<td>".strtoupper($row['fecha'])."</td>
					<td>$img</td>
				</tr>";
			}
			$tabla.="</table>";
			$est = "<table width = '100%'>
				
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' >
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano' onclick = 'ocultar_listado_usuarios()'>RESPONSABLES POR DEPARTAMENTO</td>
							<td align = 'left' ><img src = '../images/iconos/mas_blanco.png' width = '30px' onclick = 'ocultar_nuevo_usuario();ocultar_listado_usuarios();'/></td>
						</table>
					</th>
				</tr>
				<tr class = 'hijo_listado_usuario' >
					<td style = 'padding-left:20px;' >$tabla</td>
				</tr>
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' >NUEVO RESPONSABLE</th>
				</tr>
				<tr class = 'hijo_nuevo_usuario' style = 'display:none;'>
					<td style = 'padding-left:20px;'>
						<table width = '100%' class = 'barra_busqueda'>
							<tr>
								<td>
									<p>Seleccione el Empleado:</p>
									<select id = 'listado_empleados_usuario' style = 'width:auto;'>$list_usuarios</select>
								</td>
								<td>
									<p>Seleccione el Departamento:</p>
									<select id = 'listado_deptos_empresa' style = 'width:auto;'>$list_deptos</select>
								</td>
							</tr>
							<tr>
								<td></br></td>
							</tr>
							<tr>
								<td colspan = '2' align = 'center'>
									<span class = 'botton_verde' onclick = 'guardar_info_nuevo_usuario_depto()' id = 'boton_guardar_n_usuario'>GUARDAR NUEVO RESPONSABLE</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>";
			echo $est;
		}
		
		public function insert_responsables_deptos($usu,$depto,$fecha){
			mysql_query("insert into pasig(usuario,pk_depto,fecha) values('".$usu."','".$depto."','".$fecha."')");
		}
		
		public function menu_permisos_empresa($empresa){
			
			$sql_usuario = mysql_query("SELECT e.nombre_empleado, e.documento_empleado,u.idusuario 
			from empleado e, usuario u 
			where u.pk_empleado = e.documento_empleado and u.estado = '1' 
			 order by e.nombre_empleado asc");
			$list_usuarios = "<option value = '0'>[SELECCIONE]</option>";
			while($row = mysql_fetch_array($sql_usuario)){
				$list_usuarios.="<option value = '".$row['idusuario']."'>".strtoupper($row['nombre_empleado'])."</option>";
			}
			$sql_deptos = mysql_query("SELECT cod_interno_empresa,nombre_comercial_empresa from empresa where estado = '1' and cod_interno_empresa = '$empresa' order by nombre_comercial_empresa asc ");
			$list_deptos = "<option value = '0'>[SELECCIONE]</option>";
			while($row = mysql_fetch_array($sql_deptos)){
				$list_deptos.="<option value = '".$row['cod_interno_empresa']."'>".strtoupper($row['nombre_comercial_empresa'])."</option>";
			}
			$sql_deptos_asignados = mysql_query("select distinct e.nombre_empleado, em.nombre_comercial_empresa,p.consecutivo, p.fecha
			from pusuemp p, empresa em, empleado e, usuario u
			where  p.cod_usuario = u.idusuario and em.cod_interno_empresa = p.cod_empresa and u.pk_empleado = e.documento_empleado and em.cod_interno_empresa = '$empresa' order by e.nombre_empleado asc");
			
			$tabla = "<table width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>EMPLEADO</th>
					<th>EMPRESA</th>
					<th>FECHA</th>
				</tr>";
			while($row = mysql_fetch_array($sql_deptos_asignados)){
				$img = "";
				
				$id = $row['consecutivo'];
				$img = "<img src = '../images/iconos/eliminar.png' width='30px' height = 'auto' title = '¿Eliminar?' onclick = 'eliminar_permiso_empresa_usuario($id)'/>";
				$tabla.="<tr id = 'asigdeptos$id'>
					<td>".strtoupper($row['nombre_empleado'])."</td>
					<td>".strtoupper($row['nombre_comercial_empresa'])."</td>
					<td>".strtoupper($row['fecha'])."</td>
					<td>$img</td>
				</tr>";
			}
			$tabla.="</table>";
			$est = "<table width = '100%'>
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' >
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano' onclick = 'ocultar_listado_usuarios()'>PERMISOS DE EMPRESA</td>
							<td align = 'left' ><img src = '../images/iconos/mas_blanco.png' width = '30px' onclick = 'ocultar_nuevo_usuario();ocultar_listado_usuarios();'/></td>
						</table>
					</th>
				</tr>
				<tr class = 'hijo_listado_usuario' >
					<td style = 'padding-left:20px;' >$tabla</td>
				</tr>
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left'>NUEVO PERMISO EMPRESA</th>
				</tr>
				<tr class = 'hijo_nuevo_usuario' style = 'display:none;'>
					<td style = 'padding-left:20px;'>
						<table width = '100%' class = 'barra_busqueda'>
							<tr>
								<td>
									<p>Seleccione el Empleado:</p>
									<select id = 'listado_empleados_usuario' style = 'width:auto;'>$list_usuarios</select>
								</td>
								<td>
									<p>Seleccione la Empresa:</p>
									<select id = 'listado_empresa_actual_p' style = 'width:auto;'>$list_deptos</select>
								</td>
							</tr>
							<tr>
								<td></br></td>
							</tr>
							<tr>
								<td colspan = '2' align = 'center'>
									<span class = 'botton_verde' onclick = 'guardar_info_permiso_empresa()' id = 'boton_guardar_n_usuario'>GUARDAR PERMISO EMPRESA</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>";
			echo $est;
		}
		
		public function insert_permisos_empresa($usu,$empresa,$fecha,$usuario){
			$estado = 1;
			$insert = "insert into pusuemp(cod_usuario,cod_empresa,fecha,asignador,estado) 
				values('".$usu."','".$empresa."','".$fecha."','".$usuario."','".$estado."')";
				$result = mysql_query($insert);
		}
		
		public function insert_director_empleado($usu,$director,$fecha,$asignador){
			mysql_query("insert into pdirector(usuario,director,fecha,asignador)  values('".$usu."','".$director."','".$fecha."','".$asignador."')");
		}
		
		public function directores_departamentos($empresa){
			$sql_usuario = mysql_query("SELECT e.nombre_empleado, e.documento_empleado,u.idusuario from empleado e, usuario u where u.pk_empleado = e.documento_empleado and u.estado = '1' and e.pk_empresa = '$empresa' order by e.nombre_empleado asc");
			$list_usuarios = "<option value = '0'>[SELECCIONE]</option>";
			while($row = mysql_fetch_array($sql_usuario)){
				$list_usuarios.="<option value = '".$row['idusuario']."'>".strtoupper($row['nombre_empleado'])."</option>";
			}
			
			$sql_deptos = mysql_query("SELECT e.nombre_empleado, u.idusuario from empleado e, usuario u
			where u.pk_empleado = e.documento_empleado and e.pk_empresa = '$empresa' order by e.nombre_empleado asc");
			$list_deptos = "<option value = '0'>[SELECCIONE]</option>";
			while($row = mysql_fetch_array($sql_deptos)){
				$list_deptos.="<option value = '".$row['idusuario']."'>".strtoupper($row['nombre_empleado'])."</option>";
			}
			$sql_deptos_asignados = mysql_query("select e.nombre_empleado as usuario, e2.nombre_empleado as director, p.consecutivo,p.fecha
			from empleado e, empleado e2, usuario u, pdirector p, usuario u2
			where e.documento_empleado = u.pk_empleado and e2.documento_empleado = u2.pk_empleado and p.director = u2.idusuario and p.usuario = u.idusuario order by e.nombre_empleado asc");
			
			$tabla = "<table width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>EMPLEADO</th>
					<th>DIRECTOR</th>
					<th>FECHA</th>
				</tr>";
				
			while($row = mysql_fetch_array($sql_deptos_asignados)){
				$img = "";
				
				$id = $row['consecutivo'];
				$img = "<img src = '../images/iconos/eliminar.png' width='30px' height = 'auto' title = '¿Eliminar?' onclick = 'eliminar_responsable_departamento($id)'/>";
				$tabla.="<tr id = 'asigdeptos$id'>
					<td>".strtoupper($row['usuario'])."</td>
					<td>".strtoupper($row['director'])."</td>
					<td>".strtoupper($row['fecha'])."</td>
					<td>$img</td>
				</tr>";
			}
			$tabla.="</table>";
			$est = "<table width = '100%'>
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' >
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano' onclick = 'ocultar_listado_usuarios()'>DIRECTORES POR USUARIO</td>
							<td align = 'left' ><img src = '../images/iconos/mas_blanco.png' width = '30px' onclick = 'ocultar_nuevo_usuario();ocultar_listado_usuarios();'/></td>
						</table>
					</th>
				</tr>
				<tr class = 'hijo_listado_usuario' >
					<td style = 'padding-left:20px;' >$tabla</td>
				</tr>
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' style = 'padding-left:20px;' id = '' onclick = 'ocultar_nuevo_usuario()'>NUEVO DIRECTOR</th>
				</tr>
				<tr class = 'hijo_nuevo_usuario' style = 'display:none;'>
					<td style = 'padding-left:20px;'>
						<table width = '100%' class = 'barra_busqueda'>
							<tr>
								<td>
									<p>Seleccione el Empleado:</p>
									<select id = 'listado_empleados_usuario' style = 'width:auto;'>$list_usuarios</select>
								</td>
								<td>
									<p>Seleccione un Director:</p>
									<select id = 'listado_empleados_directores' style = 'width:auto;'>$list_deptos</select>
								</td>
							</tr>
							<tr>
								<td></br></td>
							</tr>
							<tr>
								<td colspan = '2' align = 'center'>
									<span class = 'botton_verde' onclick = 'guardar_info_director_empleado()' id = 'boton_guardar_n_usuario'>GUARDAR DIRECTOR</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>";
			echo $est;
		}
		
		public function menu_usuarios($empresa){
			$sql_list_deptost = mysql_query("select id,name_depto from deptos_trafico order by name_depto");
			$list_dep_trafico = "<option value = '0'>[SELECCIONE]</option>";
			
			while($row = mysql_fetch_array($sql_list_deptost)){
				$list_dep_trafico.="<option value = '".$row['id']."'>".strtoupper($row['name_depto'])."</option>";
			}
			
			$sql_usuario = mysql_query("SELECT e.nombre_empleado, e.documento_empleado from empleado e where e.documento_empleado not in(select pk_empleado from usuario u) and e.pk_empresa = '$empresa' order by e.nombre_empleado asc");
			$list_usuarios = "<option value = '0'>[SELECCIONE]</option>";
			while($row = mysql_fetch_array($sql_usuario)){
				$list_usuarios.="<option value = '".$row['documento_empleado']."'>".strtoupper($row['nombre_empleado'])."</option>";
			}
			$sql =mysql_query("select u.estado, u.nick, e.nombre_empleado,r.rol,u.idusuario
			from usuario u, empleado e, usur r 
			where u.pk_empleado = e.documento_empleado and e.pk_empresa = '$empresa' and u.perfil = r.consecutivo order by e.nombre_empleado asc");
			$tabla = "<table width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>EMPLEADO</th>
					<th>USUARIO</th>
					<th>PERFIL</th>
					<th>ESTADO</th>
				</tr>";
			while($row = mysql_fetch_array($sql)){
				$id = $row['idusuario'];
				$img = "";
				if($row['estado'] == 1){
					$est = 0;
					$img = "<img src = '../images/iconos/ACTIVO.png' width='55px' height = 'auto' title = 'ACTIVO' onclick = 'desactivar_usuario_empresa($id,$est)'/>";
				}else{
					$est = 1;
					$img = "<img src = '../images/iconos/INACTIVO.png' width='55px' height = 'auto' title = 'INACTIVO'onclick = 'desactivar_usuario_empresa($id,$est)'/>";
				}
				$tabla.="<tr>
					<td>".$row['nombre_empleado']."</td>
					<td>".strtoupper($row['nick'])."</td>
					<td>".strtoupper($row['rol'])."</td>
					<td id = 'imgestado$id'>$img</td>
					<td ><img src = '../images/iconos/eliminar.png' height = '30px' title = 'Eliminar Contraseña' onclick = 'eliminar_contrasena_usuario($id)'/></td>
				</tr>";
			}
			$tabla.="</table>";
			$perfil =mysql_query("select consecutivo, rol from usur order by rol asc");
			$tbl = "<option value = '0'></option>";
			while($row = mysql_fetch_array($perfil)){
				$tbl.="<option value = '".$row['consecutivo']."'>".strtoupper(utf8_encode($row['rol']))."</option>";
			}
			$est = "<table width = '100%'>
				
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' >
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano' onclick = 'ocultar_listado_usuarios()'>USUARIOS</td>
							<td align = 'left' ><img src = '../images/iconos/mas_blanco.png' width = '30px' onclick = 'ocultar_nuevo_usuario();ocultar_listado_usuarios();'/></td>
						</table>
					</th>
				</tr>
				<tr class = 'hijo_listado_usuario' >
					<td style = 'padding-left:20px;' >$tabla</td>
				</tr>
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left'  >NUEVO USUARIO</th>
				</tr>
				<tr class = 'hijo_nuevo_usuario' style = 'display:none;'>
					<td style = 'padding-left:20px;'>
						<table width = '100%' class = 'barra_busqueda'>
							<tr>
								<td>
									<p>Seleccione el Empleado:</p>
									<select id = 'listado_empleados_sin_usuario'>$list_usuarios</select>
								</td>
								<td>
									<p>Seleccione el Departamento:</p>
									<select id = 'listado_depto_trafico_usuario'>$list_dep_trafico</select>
								</td>
							</tr>
							<tr>
								<td>
									<p>Seleccione el Perfil de Usuario:</p>
									<select id = 'listado_perfiles_usuario'>$tbl</select>
								</td>
								<td>
									<p>Ingrese el Nombre de Usuario:</p>
									<input type = 'text' id = 'nombre_nuevo_usuario_empleado' onkeyup = 'buscar_nombre_usuario_n()'/>
									<span id = 'valid_usuario'></span>
								</td>
							</tr>
							<tr>
								<td></br></td>
							</tr>
							<tr>
								<td colspan = '2' align = 'center'>
									<span class = 'botton_verde' onclick = 'guardar_info_nuevo_usuario_empleado()' id = 'boton_guardar_n_usuario'>GUARDAR NUEVO USUARIO</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>";
			echo $est;
		}
	}
?>
