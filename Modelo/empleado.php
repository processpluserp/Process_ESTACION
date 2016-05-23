<?php
	
	class empleado{
		public $meses = array("Enero", "Febrero", "Marzo",
        "Abril", "Mayo", "Junio", "Julio",
        "Agosto", "Septiembre", "Octubre",
        "Noviembre", "Diciembre");
		
		
		public $num_documento;
		public $nempleado;
		public $napellido;
		public $sexo;
		public $direccion;
		public $telefono;
		public $celular;
		public $cargo;
		public $email;
		public $fecha_nacimiento;
		public $tipo_documento;
		public $eps;
		public $rh;
		public $fecha_ingreso_trabajo;
		public $fondo_pensiones;
		public $fondo_cesantias;
		public $caja_compensacion;
		public $arl;
		public $usuario;
		public $fecha_registro;
		public $karea_empresa;
		public $und;
		public $kempresa;
		
		public $fecha_retiro;
		public $motivo_retiro;
		public $correo_personal;
		
		
		/*SALARIOS*/
		public $salario_base;
		public $b_alimentacion;
		public $b_no_prestacional;
		public $otros;
		
		
		public function get_fecha_retiro(){
			return $this->fecha_retiro;
		}
		public function set_fecha_retiro($x){
			$this->fecha_retiro = $x;
		}
		
		public function get_motivo_retiro(){
			return $this->motivo_retiro;
		}
		public function set_motivo_retiro($x){
			$this->motivo_retiro = $x;
		}
		
		public function get_correo_personal(){
			$this->correo_personal;
		}
		public function set_correo_personal($x){
			$this->correo_personal = $x;
		}
		
		public function get_numero_documento(){
			return $this->num_documento;
		}
		public function set_numero_documento($numdoc){
			$this->num_documento = $numdoc;
		}
		
		public function get_nombre_empleado(){
			return $this->nempleado;
		}
		public function set_nombre_empleado($nombre_empleado){
			$this->nempleado = $nombre_empleado;
		}
		
		public function get_apellido_empleado(){
			return $this->napellido;
		}
		public function set_apellido_empleado($apellido){
			$this->napellido = $apellido;
		}
		
		public function get_sexo_empleado(){
			return $this->sexo;
		}
		public function set_sexo_empleado($sexo_empleado){
			$this->sexo = $sexo_empleado;
		}
		
		public function get_direccion_empleado(){
			return $this->direccion;
		}
		public function set_direccion_empleado($dir_empleado){
			$this->direccion = $dir_empleado;
		}
		
		public function get_telefono_empleado(){
			return $this->telefono;
		}
		public function set_telefono_empleado($phone_empleado){
			$this->telefono = $phone_empleado;
		}
	
		public function get_celular_empleado(){
			return $this->celular;
		}
		public function set_celular_empleado($celular_empleado){
			$this->celular = $celular_empleado;
		}
		
		public function get_cargo_empleado(){
			return $this->cargo;
		}
		public function set_cargo_empleado($cargo_empleado){
			$this->cargo = $cargo_empleado;
		}
		
		public function get_correo_empleado(){
			return $this->email;
		}
		public function set_correo_empleado($correo){
			$this->email = $correo;
		}
		
		public function get_und(){
			return $this->und;
		}
		public function set_und($y){
			$this->und = $y;
		}
		
		public function get_fecha_nacimiento_empleado(){
			return $this->fecha_nacimiento;
		}
		public function set_fecha_nacimiento_empleado($fec_nacimiento){
			$this->fecha_nacimiento = $fec_nacimiento;
		}
		
		public function get_tipo_documento_empleado(){
			return $this->tipo_documento;
		}
		public function set_tipo_documento_empleado($tipo_doc){
			$this->tipo_documento = $tipo_doc;
		}
		
		public function get_eps_empleado(){
			return $this->eps;
		}
		public function set_eps_empleado($n_eps){
			$this->eps = $n_eps;
		}
		
		public function get_rh_empleado(){
			return $this->rh;
		}
		public function set_rh_empleado($n_rh){
			$this->rh = $n_rh;
		}
		
		public function get_fecha_ingreso_empleado(){
			return $this->fecha_ingreso_trabajo;
		}
		public function set_fecha_ingreso_empleado($fec_ingreso){
			$this->fecha_ingreso_trabajo = $fec_ingreso;
		}
		
		public function get_fondo_pensiones_empleado(){
			return $this->fondo_pensiones;
		}
		public function set_fondo_pensiones_empleado($fpensiones){
			$this->fondo_pensiones = $fpensiones;
		}
		
		public function get_fondo_cesantias_empleado(){
			return $this->fondo_cesantias;
		}
		public function set_fondo_cesantias_empleado($fcesantias){
			$this->fondo_cesantias = $fcesantias;
		}
		
		public function get_fondo_caja_compensacion(){
			return $this->caja_compensacion;
		}
		public function set_fondo_caja_compensacion($s){
			$this->caja_compensacion = $s;
		}
		
		public function get_arl_empleado(){
			return $this->arl;
		}
		public function set_arl_empleado($n_arl){
			$this->arl = $n_arl;
		}
		
		public function get_usuario_empleado(){
			return $this->usuario;
		}
		public function set_usuario_empleado($usu){
			$this->usuario = $usu;
		}
		public function get_fecha_registro(){
			return $this->fecha_registro;
		}
		public function set_fecha_registro($fregistro){
			$this->fecha_registro = $fregistro;
		}
		
		public function get_area_empleado(){
			return $this->area_empresa;
		}
		public function set_area_empleado($n_area_empresa){
			$this->area_empresa = $n_area_empresa;
		}
		public function get_empresa_empleado(){
			return $this->kempresa;
		}
		public function set_empresA_empleado($empresa){
			$this->kempresa = $empresa;
		}
		
		/*SALARIOS*/
		public function get_salario_base(){
			return $this->salario_base;
		}
		public function set_salario_base($sb){
			$this->salario_base = $sb;
		}
		
		public function get_b_alimentacion(){
			return $this->b_alimentacion;
		}
		public function set_b_alimentacion($a){
			$this->b_alimentacion = $a;
		}
		
		public function get_b_n_prestacional(){
			return $this->b_no_prestacional;
		}
		public function set_bn_prestacional($bn){
			$this->b_no_prestacional = $bn;
		}
		
		public function get_otros(){
			return $this->otros;
		}
		public function set_otros($t){
			$this->otros = $t;
		}
		
		//Vacaciones
		public function accion_vacaciones($cedula){
			$sql = mysql_query("select id from vacaciones where cedula = '$cedula'");
			$val = mysql_num_rows($sql);
			return $val;
		}
		public function tratar_vacaciones_empleado($accion,$cedula){
			if($accion == 0){
				$this->insert_vacaciones_empleado($cedula);
			}else{
				$this->update_vacaciones_empleado($cedula);
			}
		}
		public function insert_vacaciones_empleado($cedula){
			$dias = 1.25;
			$insert = mysql_query("insert into vacaciones(cedula,dias) values('".$cedula."','".$dias."')");
		}
		
		public function update_vacaciones_empleado($cedula){
			$sql = mysql_query("select dias from vacaciones where cedula = '$cedula'");
			$dias = 0;
			while($row = mysql_fetch_array($sql)){
				$dias = $row['dias'] + 1.25;
			}
			$update = mysql_query("update vacaciones set dias = '$dias' where cedula = '$cedula'");
		}
		
		
		
		
		public function deptos_empresa($emp){
			$imp = "<option value = '0'></option>";
			$sql = mysql_query("select ");
			while($row = mysql_fetch_array($sql)){
				$imp.= "<option value ='".$row['documento_empleado']."'>".$row['nombre_empleado']."</option>";
			}
			echo $imp;
		}
		
		
		
		public function und_empresa($id,$emp){
			$sql = mysql_query("select id,name from und where empresa = '$emp'");
			$imp ="";
			while($row = mysql_fetch_array($sql)){
				if($id == $row['id']){
					$imp .="<option value ='".$row['id']."' selected>".$row['name']."</option>";
				}else{
					$imp.="<option value ='".$row['id']."'>".$row['name']."</option>";
				}
			}
			return $imp;
		}
		
		public function und_empresa_lista($emp){
			$sql = mysql_query("select id,name from und where empresa = '$emp'");
			$imp ="<option value = '0'>[SELECCIONE]</option>";
			while($row = mysql_fetch_array($sql)){
				$imp.="<option value ='".$row['id']."'>".$row['name']."</option>";
			}
			return $imp;
		}
		
		public function departamentos_empresa($id,$und){
			$sql = mysql_query("select codigo_interno_empresa,nombre_area_empresa from area_empresa where pk_und = '$und'");
			$imp ="";
			while($row = mysql_fetch_array($sql)){
				if($id == $row['codigo_interno_empresa']){
					$imp .="<option value ='".$row['codigo_interno_empresa']."' selected>".$row['nombre_area_empresa']."</option>";
				}else{
					$imp.="<option value ='".$row['codigo_interno_empresa']."'>".$row['nombre_area_empresa']."</option>";
				}
			}
			return $imp;
		}
		
		public function listar_empleados_sin_usuario($emp){
			$imp = "<option value = '0'></option>";
			$sql = mysql_query("select Empleado.documento_empleado,Empleado.nombre_empleado,usuario.nick
			from Empleado
			left join usuario on Empleado.documento_empleado = usuario.pk_empleado where usuario.nick is NULL and Empleado.pk_empresa = '$empresa_final'");
			while($row = mysql_fetch_array($sql)){
				$imp.= "<option value ='".$row['documento_empleado']."'>".$row['nombre_empleado']."</option>";
			}
			echo $imp;
		}
		
		public function listado_empleados_carga($emp){
			$periodo = date("Y")."-".floatval(date("m"));
			$est ="<table width = '100%'>";
			$estx= "";
			$empleados = array();
			$trabajadores = array();
			
			$sql = mysql_query("select documento_empleado from empleado where pk_empresa = '$emp' and estado = '1'");
			$i = 0;
			while($row = mysql_fetch_array($sql)){
				$empleados[$i][0] = $row['documento_empleado'];
				$empleados[$i][1] = '1';
				$i++;
			}
			$i = 0;
			$sql = mysql_query("select cedula from tablas_empleados where empresa = '$emp' and periodo = '$periodo'");
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
					$sql = mysql_query("select nombre_empleado, documento_empleado from empleado where pk_empresa = '$emp' and documento_empleado = '$x'");
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
		public function sql_consulta_simulados($emp){
			$sql = mysql_query("select s.id,s.name,s.salario,s.bnp,s.otros,s.bonos,s.total,s.apro,s.fecha, m.name as modalidad
			from SMCE s, modalidad_pago_sal m
			where s.modalidad = m.id and s.empresa = '$emp'");
			return $sql;
		}
		public function sql_consulta_simulados_name($emp,$name){
			$sql = mysql_query("select s.id,s.name,s.salario,s.bnp,s.otros,s.bonos,s.total,s.apro,s.fecha, m.name as modalidad
			from SMCE s, modalidad_pago_sal m
			where s.modalidad = m.id and s.empresa = '$emp' and s.name like '%$name%'");
			return $sql;
		}
		
		public function eliminar_prospecto($id){
			mysql_query("delete from SMCE where id = '$id' ");
		}
		
		public function mostrar_simulados($sql){
			$est = "<table  class = 'display2 tablas_muestra_datos_tablas' width = '100%'>
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Modalidad de Pago</th>
						<th>Salario Total</th>
						<th></th>
					</tr>
				</thead><tbody>";
			while($row = mysql_fetch_array($sql)){
				$estado ="";
				$text ="";
				if($row['apro'] == 1){
					$estado = "<img src = '../images/iconos/activo.png' class = 'botones_opciones'/>";
					$text = "ACTIVO";
				}else{
					$estado = "<img src = '../images/iconos/inactivo.png' class = 'botones_opciones'/>";
					$text = "INACTIVO";
				}
				$id = $row['id'];
				$est.="<tr >
					<td onclick = 'visualizar_hoja_costos_simulacro($id)' class = 'mano'>".$row['name']."</td>
					<td align = 'center'>".$row['modalidad']."</td>
					<td align = 'center'>$ ".number_format($row['total'])."</td>
					<td align = 'center'><img src = '../images/iconos/eliminar.png' width = '25px' onclick = 'eliminar_prospecto($id)' /></td>
				</tr>";
			}
			echo $est."</tbody></table>
				<script type = 'text/javascript'>
					$('.display2').DataTable( {
						'scrollY':($('#listado_simulaciones').height()-40)+'px',
						'scrollCollapse':true,
						'paging':false
					});
					$('.dataTables_filter,.dataTables_length,.dataTables_info').hide();
				</script>
			";
		}
		
		public function consultar_datos_empleado($emx){
			
			/*<td><img src = '../images/editar.png' onclick = 'editar_empleado_gestion($cedula)' class = 'botones'/></td>*/
			$tabla = "
			<div class = 'container'>
			<table class = 'display tablas_muestra_datos_tablas' width = '100%' >
				<thead>
					<tr class = 'header'>
						<th></th>
						<th>DOCUMENTO</th>
						<th>NOMBRE</th>
						<th>CARGO</th>
						<th nowrap>FECHA DE INGRESO</th>
						<th nowrap>FECHA DE RETIRO</th>
						<th>ÁREA</th>
					</tr>
				</thead>
				<tbody>";
			$i = 1;
			$sel = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,e.sexo_empleado,e.direccion_empleado,e.fecha_retiro,
			e.phone_casa_empleado,e.celular_empleado,e.cargo_empleado,e.email_empleado,e.fecha_nacimiento,e.tipo_documento_empleado,
			e.eps,e.rh,e.fecha_ingreso_empleado,e.fondo_pensiones,e.fondo_cesantias,e.caja_compensacion,e.arl,e.usuario,e.fecha_registro,emp.cod_interno_empresa,
			emp.nombre_comercial_empresa,ar.nombre_area_empresa from empleado e, area_empresa ar, empresa emp where 
			e.pk_depto = ar.codigo_interno_empresa and emp.cod_interno_empresa = '$emx' and ar.pk_empresa_areas = emp.cod_interno_empresa order by e.nombre_empleado asc");
			while($row = mysql_fetch_array($sel)){
				$dat = $row['fecha_ingreso_empleado'];
				$dat = explode("-",$dat);
				$fecha = $this->meses[floatval($dat[1])-1]." ".$dat[2]." ".$dat[0];
				$dat2 = $row['fecha_retiro'];
				$fechar = "";
				$dat2 = explode("-",$dat2);
				
				if($dat2 = "0000-00-00"){
					$fechar="";
				}else{
					$fechar = $this->meses[floatval($dat2[1])-1]." ".$dat2[2]." ".$dat2[0];
				}
				
				$ruta = "";
				$text = "";
				$emp = $row['cod_interno_empresa'];
				$cedula = $row['documento_empleado'];
				if($row['estado'] == 1){
					$ruta = "<img src = '../images/iconos/activo.png' class = 'botones_opciones' />";
					$text = "ACTIVO";
				}else{
					$ruta = "<img src = '../images/iconos/inactivo.png' class = 'botones_opciones'/>";
					$text = "INACTIVO";
				}
				$tabla .= "<tr id = '$cedula' >
					<td style = 'padding:5px;'>$i</td>
					<td >$cedula</td>
					<td class = 'mano' onclick = 'mostrar_informacion_basica_empleado($cedula,$emp)' nowrap>".$row['nombre_empleado']."</td>
					<td>".$row['cargo_empleado']."</td>
					<td >".$fecha."</td>
					<td >".$row['fecha_retiro']."</td>
					<td>".$row['nombre_area_empresa']."</td>					
				</tr>";
				$i++;
			}
			echo $tabla."</tbody></table>
				<script type = 'text/javascript'>
					$('.display').DataTable( {
						'scrollY':($('#contenedo_tabla_muestra_empleados').height()-40)+'px',
						'scrollCollapse':true,
						'paging':false
					});
					$('.dataTables_filter,.dataTables_length,.dataTables_info').hide();
				</script>
			</div>";
		}
		
		public function consultar_datos_empleado_und_depto($emx,$und,$depto){
			$tabla = "<table width = '100%' class = 'display tablas_muestra_datos_tablas'>
				<thead>
					<tr>
						<th></th>
						<th>DOCUMENTO</th>
						<th>NOMBRE</th>
						<th>CARGO</th>
						<th nowrap>FECHA DE INGRESO</th>
						<th nowrap>FECHA DE RETIRO</th>
						<th>ÁREA</th>
					</tr>
				</thead><tbody>";
			$i = 1;
			$sel = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,e.sexo_empleado,e.direccion_empleado,e.fecha_retiro,
			e.phone_casa_empleado,e.celular_empleado,e.cargo_empleado,e.email_empleado,e.fecha_nacimiento,e.tipo_documento_empleado,
			e.eps,e.rh,e.fecha_ingreso_empleado,e.fondo_pensiones,e.fondo_cesantias,e.caja_compensacion,e.arl,e.usuario,e.fecha_registro,emp.cod_interno_empresa,
			emp.nombre_comercial_empresa,ar.nombre_area_empresa 
			from empleado e, area_empresa ar, empresa emp 
			where 
			e.pk_depto = ar.codigo_interno_empresa and emp.cod_interno_empresa = '$emx' and ar.pk_empresa_areas = emp.cod_interno_empresa and e.und = '$und' and e.pk_depto = '$depto' order by e.nombre_empleado asc");
			while($row = mysql_fetch_array($sel)){
				$dat = $row['fecha_ingreso_empleado'];
				$dat = explode("-",$dat);
				$fecha = $this->meses[floatval($dat[1])-1]." ".$dat[2]." ".$dat[0];
				$dat2 = $row['fecha_retiro'];
				$fechar = "";
				if($dat2 = "0000-00-00"){
					$fechar="";
				}else{
					$dat2 = explode("-",$dat2);
					$fechar = $this->meses[floatval($dat2[1])-1]." ".$dat2[2]." ".$dat2[0];
				}
				
				$ruta = "";
				$text = "";
				$emp = $row['cod_interno_empresa'];
				$cedula = $row['documento_empleado'];
				if($row['estado'] == 1){
					$ruta = "<img src = '../images/iconos/activo.png' class = 'botones_opciones' />";
					$text = "ACTIVO";
				}else{
					$ruta = "<img src = '../images/iconos/inactivo.png' class = 'botones_opciones'/>";
					$text = "INACTIVO";
				}
				$tabla .= "<tr id = '$cedula' >
					<td style = 'padding:5px;'>$i</td>
					<td >$cedula</td>
					<td class = 'mano' onclick = 'mostrar_informacion_basica_empleado($cedula,$emp)' nowrap>".$row['nombre_empleado']."</td>
					<td>".$row['cargo_empleado']."</td>
					<td >".$fecha."</td>
					<td >".$row['fecha_retiro']."</td>
					<td>".$row['nombre_area_empresa']."</td>	
				</tr>";
				$i++;
			}
			echo $tabla."</tbody></table>
				<script type = 'text/javascript'>
					$('.display').DataTable( {
						'scrollY':($('#contenedo_tabla_muestra_empleados').height()-20)+'px',
						'scrollCollapse':true,
						'paging':false
					});
					$('.dataTables_filter,.dataTables_length,.dataTables_info').hide();
				</script>";
		}
		
		public function consultar_datos_empleado_und($emx,$und){
			$tabla = "<table  width = '100%' class = 'display tablas_muestra_datos_tablas'>
				<thead>
					<tr>
						<th></th>
						<th>DOCUMENTO</th>
						<th>NOMBRE</th>
						<th>CARGO</th>
						<th nowrap>FECHA DE INGRESO</th>
						<th nowrap>FECHA DE RETIRO</th>
						<th>ÁREA</th>
					</tr>
				</thead><tbody>";
			$i = 1;
			$sel = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,e.sexo_empleado,e.direccion_empleado,e.fecha_retiro,
			e.phone_casa_empleado,e.celular_empleado,e.cargo_empleado,e.email_empleado,e.fecha_nacimiento,e.tipo_documento_empleado,
			e.eps,e.rh,e.fecha_ingreso_empleado,e.fondo_pensiones,e.fondo_cesantias,e.caja_compensacion,e.arl,e.usuario,e.fecha_registro,emp.cod_interno_empresa,
			emp.nombre_comercial_empresa,ar.nombre_area_empresa 
			from empleado e, area_empresa ar, empresa emp 
			where 
			e.pk_depto = ar.codigo_interno_empresa and emp.cod_interno_empresa = '$emx' and ar.pk_empresa_areas = emp.cod_interno_empresa and e.und = '$und' order by e.nombre_empleado asc");
			while($row = mysql_fetch_array($sel)){
				$dat = $row['fecha_ingreso_empleado'];
				$dat = explode("-",$dat);
				$fecha = $this->meses[floatval($dat[1])-1]." ".$dat[2]." ".$dat[0];
				$dat2 = $row['fecha_retiro'];
				$fechar = "";
				if($dat2 = "0000-00-00"){
					$fechar="";
				}else{
					$dat2 = explode("-",$dat2);
					$fechar = $this->meses[floatval($dat2[1])-1]." ".$dat2[2]." ".$dat2[0];
				}
				
				$ruta = "";
				$text = "";
				$emp = $row['cod_interno_empresa'];
				$cedula = $row['documento_empleado'];
				if($row['estado'] == 1){
					$ruta = "<img src = '../images/iconos/activo.png' class = 'botones_opciones' />";
					$text = "ACTIVO";
				}else{
					$ruta = "<img src = '../images/iconos/inactivo.png' class = 'botones_opciones'/>";
					$text = "INACTIVO";
				}
				$tabla .= "<tr id = '$cedula' >
					<td style = 'padding:5px;'>$i</td>
					<td >$cedula</td>
					<td class = 'mano' onclick = 'mostrar_informacion_basica_empleado($cedula,$emp)' nowrap>".$row['nombre_empleado']."</td>
					<td>".$row['cargo_empleado']."</td>
					<td >".$fecha."</td>
					<td >".$row['fecha_retiro']."</td>
					<td>".$row['nombre_area_empresa']."</td>	
				</tr>";
				$i++;
			}
			echo $tabla."</tbody></table>
				<script type = 'text/javascript'>
					$('.display').DataTable( {
						'scrollY':($('#contenedo_tabla_muestra_empleados').height()-20)+'px',
						'scrollCollapse':true,
						'paging':false
					});
					$('.dataTables_filter,.dataTables_length,.dataTables_info').hide();
				</script>
			";
		}
		
		public function consultar_dato_x_empleado($id,$emp){
			$tabla = "<table width = '100%' class = 'display tablas_muestra_datos_tablas'>
				<thead>
					<tr>
						<th></th>
						<th>DOCUMENTO</th>
						<th>NOMBRE</th>
						<th>CARGO</th>
						<th nowrap>FECHA DE INGRESO</th>
						<th nowrap>FECHA DE RETIRO</th>
						<th>ÁREA</th>
					</tr>
				</thead><tbody>";
			$i = 1;
			$sel = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,e.sexo_empleado,e.direccion_empleado,e.fecha_retiro,
			e.phone_casa_empleado,e.celular_empleado,e.cargo_empleado,e.email_empleado,e.fecha_nacimiento,e.tipo_documento_empleado,
			e.eps,e.rh,e.fecha_ingreso_empleado,e.fondo_pensiones,e.fondo_cesantias,e.caja_compensacion,e.arl,e.usuario,e.fecha_registro,emp.cod_interno_empresa,
			emp.nombre_comercial_empresa,ar.nombre_area_empresa from empleado e, area_empresa ar, empresa emp where 
			e.pk_depto = ar.codigo_interno_empresa and e.documento_empleado like '%$id%' and ar.pk_empresa_areas = emp.cod_interno_empresa and emp.cod_interno_empresa = '$emp' order by e.nombre_empleado asc");
			while($row = mysql_fetch_array($sel)){
				$dat = $row['fecha_ingreso_empleado'];
				$dat = explode("-",$dat);
				$fecha = $this->meses[floatval($dat[1])-1]." ".$dat[2]." ".$dat[0];
				$dat2 = $row['fecha_retiro'];
				$fechar = "";
				if($dat2 = "0000-00-00"){
					$fechar="";
				}else{
					$dat2 = explode("-",$dat2);
					$fechar = $this->meses[floatval($dat2[1])-1]." ".$dat2[2]." ".$dat2[0];
				}
				
				$ruta = "";
				$text = "";
				$emp = $row['cod_interno_empresa'];
				$cedula = $row['documento_empleado'];
				if($row['estado'] == 1){
					$ruta = "<img src = '../images/iconos/activo.png' class = 'botones_opciones' />";
					$text = "ACTIVO";
				}else{
					$ruta = "<img src = '../images/iconos/inactivo.png' class = 'botones_opciones'/>";
					$text = "INACTIVO";
				}
				$tabla .= "<tr id = '$cedula' >
					<td style = 'padding:5px;'>$i</td>
					<td >$cedula</td>
					<td class = 'mano' onclick = 'mostrar_informacion_basica_empleado($cedula,$emp)' nowrap>".$row['nombre_empleado']."</td>
					<td>".$row['cargo_empleado']."</td>
					<td >".$fecha."</td>
					<td >".$row['fecha_retiro']."</td>
					<td>".$row['nombre_area_empresa']."</td>	
				</tr>";
				$i++;
			}
			echo $tabla."</tbody></table>
				<script type = 'text/javascript'>
					$('.display').DataTable( {
						'scrollY':($('#contenedo_tabla_muestra_empleados').height()-20)+'px',
						'scrollCollapse':true,
						'paging':false
					});
					$('.dataTables_filter,.dataTables_length,.dataTables_info').hide();
				</script>";
		}
		
		public function consultar_name_empleado($id,$emp){
			$tabla = "<table  class = 'display tablas_muestra_datos_tablas' id = 'malparida' width = '100%'>
				<thead>
					<tr>
						<th></th>
						<th>DOCUMENTO</th>
						<th>NOMBRE</th>
						<th>CARGO</th>
						<th nowrap>FECHA DE INGRESO</th>
						<th nowrap>FECHA DE RETIRO</th>
						<th>ÁREA</th>
					</tr>
				</thead><tbody>";
			$i = 1;
			$sel = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,e.sexo_empleado,e.direccion_empleado,e.fecha_retiro,
			e.phone_casa_empleado,e.celular_empleado,e.cargo_empleado,e.email_empleado,e.fecha_nacimiento,e.tipo_documento_empleado,
			e.eps,e.rh,e.fecha_ingreso_empleado,e.fondo_pensiones,e.fondo_cesantias,e.caja_compensacion,e.arl,e.usuario,e.fecha_registro,emp.cod_interno_empresa,
			emp.nombre_comercial_empresa,ar.nombre_area_empresa from empleado e, area_empresa ar, empresa emp where 
			e.pk_depto = ar.codigo_interno_empresa and e.nombre_empleado like '%$id%' and ar.pk_empresa_areas = emp.cod_interno_empresa and emp.cod_interno_empresa = '$emp' order by e.nombre_empleado asc");
			while($row = mysql_fetch_array($sel)){
				$dat = $row['fecha_ingreso_empleado'];
				$dat = explode("-",$dat);
				$fecha = $this->meses[floatval($dat[1])-1]." ".$dat[2]." ".$dat[0];
				$dat2 = $row['fecha_retiro'];
				$fechar = "";
				if($dat2 = "0000-00-00"){
					$fechar="";
				}else{
					$dat2 = explode("-",$dat2);
					$fechar = $this->meses[floatval($dat2[1])-1]." ".$dat2[2]." ".$dat2[0];
				}
				
				$ruta = "";
				$text = "";
				$emp = $row['cod_interno_empresa'];
				$cedula = $row['documento_empleado'];
				if($row['estado'] == 1){
					$ruta = "<img src = '../images/iconos/activo.png' class = 'botones_opciones' />";
					$text = "ACTIVO";
				}else{
					$ruta = "<img src = '../images/iconos/inactivo.png' class = 'botones_opciones'/>";
					$text = "INACTIVO";
				}
				$tabla .= "<tr id = '$cedula' >
					<td style = 'padding:5px;'>$i</td>
					<td >$cedula</td>
					<td class = 'mano' onclick = 'mostrar_informacion_basica_empleado($cedula,$emp)' nowrap>".$row['nombre_empleado']."</td>
					<td>".$row['cargo_empleado']."</td>
					<td >".$fecha."</td>
					<td >".$row['fecha_retiro']."</td>
					<td>".$row['nombre_area_empresa']."</td>	
				</tr>";
				$i++;
			}
			echo $tabla."</tbody></table>
				<script type = 'text/javascript'>
					$('.display').DataTable( {
						'scrollY':($('#contenedo_tabla_muestra_empleados').height()-20)+'px',
						'scrollCollapse':true,
						'paging':false
					});
					$('.dataTables_filter,.dataTables_length,.dataTables_info').hide();
				</script>";
		}
		
		public function consultar_empleado_estado($id,$emp){
			$tabla = "<table width = '100%' class = 'display tablas_muestra_datos_tablas'>
				<thead>
					<tr>
						<th></th>
						<th>DOCUMENTO</th>
						<th>NOMBRE</th>
						<th>CARGO</th>
						<th nowrap>FECHA DE INGRESO</th>
						<th nowrap>FECHA DE RETIRO</th>
						<th>ÁREA</th>
					</tr>
				</thead><tbody>";
			$i = 1;
			$sel = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,e.sexo_empleado,e.direccion_empleado,e.fecha_retiro,
			e.phone_casa_empleado,e.celular_empleado,e.cargo_empleado,e.email_empleado,e.fecha_nacimiento,e.tipo_documento_empleado,
			e.eps,e.rh,e.fecha_ingreso_empleado,e.fondo_pensiones,e.fondo_cesantias,e.caja_compensacion,e.arl,e.usuario,e.fecha_registro,emp.cod_interno_empresa,
			emp.nombre_comercial_empresa,ar.nombre_area_empresa from empleado e, area_empresa ar, empresa emp where 
			e.pk_depto = ar.codigo_interno_empresa and e.estado = '$id' and ar.pk_empresa_areas = emp.cod_interno_empresa and emp.cod_interno_empresa = '$emp' order by e.nombre_empleado asc");
			while($row = mysql_fetch_array($sel)){
				$dat = $row['fecha_ingreso_empleado'];
				$dat = explode("-",$dat);
				$fecha = $this->meses[floatval($dat[1])-1]." ".$dat[2]." ".$dat[0];
				$dat2 = $row['fecha_retiro'];
				$fechar = "";
				if($dat2 = "0000-00-00"){
					$fechar="";
				}else{
					$dat2 = explode("-",$dat2);
					$fechar = $this->meses[floatval($dat2[1])-1]." ".$dat2[2]." ".$dat2[0];
				}
				
				$ruta = "";
				$text = "";
				$emp = $row['cod_interno_empresa'];
				$cedula = $row['documento_empleado'];
				if($row['estado'] == 1){
					$ruta = "<img src = '../images/iconos/activo.png' class = 'botones_opciones'/>";
					$text = "ACTIVO";
				}else{
					$ruta = "<img src = '../images/iconos/inactivo.png' class = 'botones_opciones'/>";
					$text = "INACTIVO";
				}
				$tabla .= "<tr id = '$cedula' >
					<td style = 'padding:5px;'>$i</td>
					<td >$cedula</td>
					<td class = 'mano' onclick = 'mostrar_informacion_basica_empleado($cedula,$emp)' nowrap>".$row['nombre_empleado']."</td>
					<td>".$row['cargo_empleado']."</td>
					<td >".$fecha."</td>
					<td >".$row['fecha_retiro']."</td>
					<td>".$row['nombre_area_empresa']."</td>	
				</tr>";
				$i++;
			}
			echo $tabla."</table>
				<script type = 'text/javascript'>
					$('.display').DataTable( {
						'scrollY':($('#contenedo_tabla_muestra_empleados').height()-20)+'px',
						'scrollCollapse':true,
						'paging':false
					});
					$('.dataTables_filter,.dataTables_length,.dataTables_info').hide();
				</script>
				";
		}
		
		public function insert_empleado($fecha,$usu,$foto,$name_c,$num_c){
			$est = 1;
			$insert = mysql_query("insert into empleado(documento_empleado,foto,nombre_empleado,sexo_empleado,direccion_empleado, phone_casa_empleado,
			celular_empleado,cargo_empleado,fecha_nacimiento,tipo_documento_empleado,eps,rh,fecha_ingreso_empleado,fondo_pensiones,
			fondo_cesantias,caja_compensacion,arl,usuario,fecha_registro,pk_depto,pk_empresa,estado,und,email_empleado,email_personal,name_emergencia,num_emergencia) values
			('".$this->get_numero_documento()."','".$foto."','".$this->get_nombre_empleado()."','".$this->get_sexo_empleado()."','".$this->get_direccion_empleado()
			."','".$this->get_telefono_empleado()."','".$this->get_celular_empleado()."','".$this->get_cargo_empleado()."','".$this->get_fecha_nacimiento_empleado()."','".$this->get_tipo_documento_empleado()."','".$this->get_eps_empleado()."','".$this->get_rh_empleado()
			."','".$this->get_fecha_ingreso_empleado()."','".$this->get_fondo_pensiones_empleado()."','".$this->get_fondo_cesantias_empleado()
			."','".$this->get_fondo_caja_compensacion()."','".$this->get_arl_empleado()."','".$usu."','".$fecha."','".$this->get_area_empleado()
			."','".$this->get_empresa_empleado()."','".$est."','".$this->get_und()."','".$this->get_correo_empleado()."','".$this->get_correo_personal()."','".$name_c."','".$num_c."')");
		}
		
		public function insert_hijos_empleados($cedula,$name,$fecha){
			mysql_query("insert into hijos_empleados(nombre,nacimiento,empleado) values ('".$name."','".$fecha."','".$cedula."')");
		}
		
		public function insert_salario_empleado($fecha){
			$insert = mysql_query("insert into salarios_empleado(fecha,pk_empleado,salario_base,otros,bonos_alimentacion,bnp)
			values('".$fecha."','".$this->get_numero_documento()."','".$this->get_salario_base()."','".$this->get_otros()
			."','".$this->get_b_alimentacion()."','".$this->get_b_n_prestacional()."')");
		}
		
		public function cambiar_estado_empleado($id,$est){
			$update = mysql_query("update empleado set estado = '$est' where documento_empleado = '$id'");
			$tabla = "<table width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th></th>
					<th>NOMBRE</th>
					<th>DIRECCIÓN</th>
					<th>CARGO</th>
					<th nowrap>FECHA DE INGRESO</th>
					<th>DEPARTAMENTO</th>
					<th>EMPRESA</th>
					<th>ESTADO</th>
					<th></th>
					<th></th>
				</tr>";
			$i = 1;
			$sel = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,e.sexo_empleado,e.direccion_empleado,
			e.phone_casa_empleado,e.celular_empleado,e.cargo_empleado,e.email_empleado,e.fecha_nacimiento,e.tipo_documento_empleado,
			e.eps,e.rh,e.fecha_ingreso_empleado,e.fondo_pensiones,e.fondo_cesantias,e.caja_compensacion,e.arl,e.usuario,e.fecha_registro,emp.cod_interno_empresa,
			emp.nombre_comercial_empresa,ar.nombre_area_empresa from empleado e, area_empresa ar, empresa emp where e.documento_empleado = '$id' and
			e.pk_depto = ar.codigo_interno_empresa and ar.pk_empresa_areas = emp.cod_interno_empresa");
			while($row = mysql_fetch_array($sel)){
				$ruta = "";
				$text = "";
				$emp = $row['cod_interno_empresa'];
				
				$cedula = $row['documento_empleado'];
				if($row['estado'] == 1){
					$ruta = "<img src = 'images/iconos/activo.png' width = '35px' height = 'auto' onclick = 'cambiar_estado_empleado_gestion($cedula)' class = 'botones_estado'/>";
					$text = "ACTIVO";
				}else{
					$ruta = "<img src = 'images/iconos/inactivo.png' width = '35px' height = 'auto' onclick = 'cambiar_estado_empleado_gestion($cedula)' class = 'botones_estado'/>";
					$text = "INACTIVO";
				}
				$tabla .= "<tr id = '$cedula' >
					<td align = 'center'>$i</td>
					<td onclick = 'mostrar_informacion_empleado($cedula,$emp)' nowrap>".$row['nombre_empleado']."</td>
					<td nowrap>".$row['direccion_empleado']."</td>
					<td>".$row['cargo_empleado']."</td>
					<td>".$row['fecha_ingreso_empleado']."</td>
					<td>".$row['nombre_area_empresa']."</td>
					<td nowrap>".$row['nombre_comercial_empresa']."</td>
					<td>".$text."</td>
					<td><img src = '../images/editar.png' onclick = 'editar_empleado_gestion($cedula)' class = 'botones'/></td>
					<td>$ruta</td>
				</tr>";
				$i++;
			}
			echo $tabla."</table>";
		}
		
		public function dateDiff($start, $end){ 
			$start_ts = strtotime($start); 
			$end_ts = strtotime($end); 
			$diff = $end_ts - $start_ts; 
			return round($diff / 86400); 
		} 
		
		public function fpension($id){
			$sql = mysql_query("select id,name from fpensiones");
			$imp ="";
			while($row = mysql_fetch_array($sql)){
				if($id == $row['id']){
					$imp .="<option value ='".$row['id']."' selected>".$row['name']."</option>";
				}else{
					$imp.="<option value ='".$row['id']."'>".$row['name']."</option>";
				}
			}
			return $imp;
		}
	
		public function fcesantias($id){
		$sql = mysql_query("select id,name from fcesantias");
			$imp ="";
			while($row = mysql_fetch_array($sql)){
				if($id == $row['id']){
					$imp .="<option value ='".$row['id']."' selected>".$row['name']."</option>";
				}else{
					$imp.="<option value ='".$row['id']."'>".$row['name']."</option>";
				}
			}
			return $imp;
		}
		
		public function ccompensacion($id){
			$sql = mysql_query("select id,name from ccompensacion");
			$imp ="";
			while($row = mysql_fetch_array($sql)){
				if($id == $row['id']){
					$imp .="<option value ='".$row['id']."' selected>".$row['name']."</option>";
				}else{
					$imp.="<option value ='".$row['id']."'>".$row['name']."</option>";
				}
			}
			return $imp;
		}
		
		public function eps($id){
			$sql = mysql_query("select id,name from eps");
			$imp ="";
			while($row = mysql_fetch_array($sql)){
				if($id == $row['id']){
					$imp .="<option value ='".$row['id']."' selected>".$row['name']."</option>";
				}else{
					$imp.="<option value ='".$row['id']."'>".$row['name']."</option>";
				}
			}
			return $imp;
		}
		
		public function farl($id){
			$sql = mysql_query("select id,name from arl");
			$imp ="";
			while($row = mysql_fetch_array($sql)){
				if($id == $row['id']){
					$imp .="<option value ='".$row['id']."' selected>".$row['name']."</option>";
				}else{
					$imp.="<option value ='".$row['id']."'>".$row['name']."</option>";
				}
			}
			return $imp;
		}
		
		public function info_basica_empleado($empleado){
			$estructura = "";
			$sel = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,e.sexo_empleado,e.direccion_empleado,
			e.phone_casa_empleado,e.celular_empleado,e.cargo_empleado,e.email_empleado,e.fecha_nacimiento,e.tipo_documento_empleado,e.foto,
			e.fecha_ingreso_empleado,e.usuario,e.fecha_registro,emp.cod_interno_empresa,e.fecha_retiro,e.motivo_retiro,e.email_personal,
			emp.nombre_comercial_empresa,ar.nombre_area_empresa,u.name, e.name_emergencia,e.num_emergencia,
			rh.name as rh, fp.name as fondo_pensiones, fc.name as fondo_cesantias, eps.name as eps,cc.name as caja_compensacion,arl.name as arl
			from empleado e, area_empresa ar, empresa emp, und u,rh rh, fpensiones fp, fcesantias fc, eps eps, ccompensacion cc, arl arl
			where e.documento_empleado = '$empleado' and  e.rh = rh.id and e.fondo_pensiones = fp.id and e.fondo_cesantias = fc.id and e.eps = eps.id and
			e.caja_compensacion = cc.id and e.arl = arl.id and
			e.pk_depto = ar.codigo_interno_empresa and ar.pk_empresa_areas = emp.cod_interno_empresa and e.und = u.id");
			$hijos = "";
			$sql_hijos = mysql_query("select nombre, nacimiento from hijos_empleados where empleado = '$empleado'");
			if(mysql_num_rows($sql_hijos) != 0){
				$hijos .="<tr><th align = 'left'colspan = '2'>HIJOS</th></tr>";
			}
			$salarios = "";
			$sql_salarios = mysql_query("select pk_empleado,salario_base,otros,bonos_alimentacion,bnp from salarios_empleado where pk_empleado = '$empleado'");
			if(mysql_num_rows($sql_salarios) != 0){
				$salarios .="<tr><th align = 'left' colspan = '2'>SALARIAL</th></tr>";
			}
			while($xrow = mysql_fetch_array($sql_salarios)){
				$salarios.="<tr>
					<td colspan = '2'>
						<p>Salario Base:</p>
						<input type = 'text' readonly value = '".number_format($xrow['salario_base'])."'/>
					</td>
					<td class = 'separator'></td>
					<td colspan = '2'>
						<p>Beneficio No Prestanacional:</p>
						<input type = 'text' readonly value = '".number_format($xrow['bnp'])."'/>
					</td>
				</tr>
				<tr>
					<td colspan = '2'>
						<p>Bonos Alimentación:</p>
						<input type = 'text' readonly value = '".number_format($xrow['bonos_alimentacion'])."'/>
					</td>
					<td class = 'separator'></td>
					<td colspan = '2'>
						<p>Otros:</p>
						<input type = 'text' readonly value = '".number_format($xrow['otros'])."'/>
					</td>
				</tr>
				";
			}
			while($xrow = mysql_fetch_array($sql_hijos)){
				$hijos.="<tr>
					<td style = 'padding-right:25px;'>
						<p>Nombre:</p>
						<input type = 'text' readonly value = '".strtoupper($xrow['nombre'])."'/>
					</td>
					<td >
						<p>Fecha Nacimiento:</p>
						<input type = 'text' readonly value = '".strtoupper($xrow['nacimiento'])."'/>
					</td>
				</tr>";
			}
			while($row = mysql_fetch_array($sel)){
				$doc = $row['documento_empleado'];
				$sql_vacas = mysql_query("select dias from vacaciones where cedula = '$doc'");
				$dias = "";
				while($va = mysql_fetch_array($sql_vacas)){
					$dias = $va['dias'];
				}
				$tiempo = (-1)*$this->dateDiff(date("Y-m-d"),$row['fecha_ingreso_empleado'])." DÍAS";
				$sexo = "";
				if($row['sexo_empleado'] == "M"){
					$sexo = "MASCULINO";
				}else{
					$sexo = "FEMENINO";
				}
				$estructura .="
					<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
						<th width = '96%' align = 'left'>
							<span class = 'mensaje_bienvenida'>INFORMACION EMPLEADO</span>
						</th>
						<td align = 'right'>
							<table width = '100%'>
								<tr>
									<td align = 'center'>
										<img src = '../images/iconos/icono_editar.png' class = 'iconos_opciones' onclick = 'editar_empleado_gestion(".$row['documento_empleado'].")'/>
									</td>
									<td align = 'center'>
										<img id = 'cerrar_ventana_info_basica_documentos'src = '../images/iconos/cerrar.png' class = 'iconos_opciones' onclick = 'cerrar_info_basica_empleado()' alt = 'Cerrar Ventana'/>
									</td>
								</tr>
							</table>
						</td>
					</table>
					<div id= 'contenedor_info_basica_empleado' style = 'overflow:scroll;width:100%;height:80%;'>
						<table width = '100%' class = 'tabla_nuevos_datos'style = 'padding-left:50px;padding-right:50px;'>
							<tr>
								<th align = 'left'width = '49%' colspan = '2' nowrap></th>
								<th class = 'separator'></th>
								<th nowrap align = 'left' colspan = '2' width = '49%'>LABORALES Y DE SALUD</th>
							</tr>
							<tr>
								<td colspan = '2'  align = 'center'>
									<div id = 'foto' style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;' width = '200px' height = '200px' >
										<img src = '../Process/EMPLEADO/".$row['foto']."' width = '180px' height = '180px' style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;' width = '200px' height = '200px'/>
									</div>
								</td>
								<td class = 'separator'></td>
								<td colspan = '2'>
									<table width = '100%'>
										<tr>
											<td style = 'padding-right:25px;'>
												<p>Fecha de Ingreso:</p>
												<input type = 'text' id = 'e_fecha_ingreso_empleado' value = '".$row['fecha_ingreso_empleado']."' readonly />
											</td>
											<td >
												<p>Fecha de Retiro:</p>
												<input type = 'text' id = 'fecha_retiro_empleado'  value = '".$row['fecha_retiro']."' readonly />
											</td>
										</tr>
										<tr>
											<td  style = 'padding-right:25px;'>
												<p>Tiempo Laborando:</p>
												<input type = 'text' id = 'e_tiempo_transcurrido' value = '$tiempo' readonly/>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2' >
									<p>Nombre Completo:</p>
									<input type = 'text'  id = 'e_nombre_complet' value = '".$row['nombre_empleado']."' readonly  />
								</td>
								<td class = 'separator'></td>
								<td colspan = '2'>
									<p>Motivo de Retiro:</p>
									<textarea width = '100%' id = 'e_motivo_retiro' value = '".$row['motivo_retiro']."' readonly ></textarea>
								</td>
							</tr>
							<tr>
								<td style = 'padding-right:25px;'>
									<p>Tipo de Documento:</p>
									<input type = 'text' value = '".$row['tipo_documento_empleado']."' readonly/>
								</td>
								<td>
									<p>Número:</p>
									<input type = 'text' id ='e_num_cedula_empleado' value = '".number_format($row['documento_empleado'])."' readonly/>
								</td>
								<td class = 'separator'></td>
								<td colspan = '2'>
									<table width = '100%' class = 'tabla_nuevos_datos'>
										<tr>
											<td  style = 'padding-right:25px;'>
												<p>Unidad Negocio:</p>
												<input type = 'text' value = '".$row['name']."' readonly/>
											</td>
											<td>
												<p>Área:</p>
												<input type = 'text' value = '".$row['nombre_area_empresa']."' readonly/>
											</td>
										</tr>
										<tr>
											<td colspan = '2'>
												<p>Cargo:</p>
												<input type = 'text' id = 'e_cargo_empleado' value ='".$row['cargo_empleado']."' readonly />
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style = 'padding-right:25px;'>
									<p>Sexo:</p>
									<input type = 'text' id = 'sexo' value = '$sexo' readonly/>
								</td>
								<td>
									<p>Fecha de Nacimiento:</p>
									<input type = 'text'  id = 'e_fecha_nacimiento_empleado' value = '".$row['fecha_nacimiento']."' readonly />
								</td>
								<td class = 'separator' width = '5%'></td>
								<td  style = 'padding-right:25px;'>
									<p>EPS:</p>
									<input type = 'text' id = 'e_eps' value='".$row['eps']."' readonly/>
								</td>
								<td>
									<p>ARL:</p>
									<input type = 'text' id = 'e_arl' value='".$row['arl']."' readonly/>
								</td>
							</tr>
							<tr>
								<td style = 'padding-right:25px;'>
									<p>Dirección:</p>
									<input type ='text' id = 'e_direccion_empleado'  value = '".$row['direccion_empleado']."' readonly/>
								</td>
								<td >
									<p>Correo Personal:</p>
									<input type ='text' id = 'e_correo_personal'  value = '".$row['email_personal']."' readonly/>
								</td>
								<td class = 'separator'></td>
								<td colspan = '2'>
									<p>FONDO DE CESANTÍAS:</p>
									<input type = 'text' id = 'e_fondo_cesantias' value = '".$row['fondo_cesantias']."' readonly />
								</td>						
							</tr>
							<tr>
								<td style = 'padding-right:25px;' >
									<p>Celular:</p>
									<input type = 'text' id = 'e_celular_empleado' value = '".$row['celular_empleado']."' readonly />
								</td>
								<td >
									<p>Teléfono de Casa:</p>
									<input type = 'text' id = 'e_phone_casa' value = '".$row['phone_casa_empleado']."'readonly />
								</td>	
								<td class = 'separator'></td>
								<td colspan = '2'>
									<p>FONDO DE PENSIONES:</p>
									<input type = 'text'  id = 'e_fondo_pensiones' value = '".$row['fondo_pensiones']."'readonly />
								</td>
							</tr>
							<tr>
								<td style = 'padding-right:25px;'>
									<p>RH:</p>
									<input type = 'text' id = 'e_rh' value = '".$row['rh']."' readonly />
								</td>
								<td >
									<p>Días Pts. de Vacaciones:</p>
									<input type = 'text' id = 'e_rh' value = '$dias DIAS' readonly />
								</td>
								<td class = 'separator'></td>
								<td colspan = '2'>
									<p>CAJA DE COMPENSACIÓN:</p>
									<input type = 'text' id = 'e_caja_compensacion' value = '".$row['caja_compensacion']."'readonly/>
								</td>
							</tr>
							<tr>
								<td colspan = '2'>
									<p>Correo Institucional:</p>
									<input type = 'text' id = 'e_correo'  value = '".$row['email_empleado']."'readonly />
								</td>
							</tr>
							<tr>
								<td style = 'padding-right:25px;'>
									<p>Nombre Contacto Emergencia:</p>
									<input type = 'text' id = 'e_caja_compensacion' value = '".$row['name_emergencia']."'readonly/>
								</td>
								<td>
									<p>Número Contacto Emergencia:</p>
									<input type = 'text' id = 'e_caja_compensacion' value = '".$row['num_emergencia']."'readonly/>
								</td>
							</tr>
							$hijos
							$salarios
						</table>
					</div>";
			}
			echo $estructura;
		}
		
		public function estructura_editar_empleado($empleado){
			$estructura = "";
			$sel = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,e.sexo_empleado,e.direccion_empleado,
			e.phone_casa_empleado,e.celular_empleado,e.cargo_empleado,e.email_empleado,e.fecha_nacimiento,e.tipo_documento_empleado,e.foto,
			e.fecha_ingreso_empleado,e.usuario,e.fecha_registro,emp.cod_interno_empresa,e.fecha_retiro,e.motivo_retiro,e.email_personal,
			emp.nombre_comercial_empresa,ar.nombre_area_empresa,ar.codigo_interno_empresa as codigo_depto,u.name,u.id as id_und,
			rh.name as rh, fp.id as codigo_fp,fp.name as fondo_pensiones,fc.id as codigo_fc, fc.name as fondo_cesantias, eps.name as eps, eps.id as codigo_eps,
			cc.id as codigo_cc,cc.name as caja_compensacion,arlx.name as arl,arlx.id as codigo_arl
			from empleado e, area_empresa ar, empresa emp, und u,rh rh, fpensiones fp, fcesantias fc, eps eps, ccompensacion cc, arl arlx
			where e.documento_empleado = '$empleado' and e.rh = rh.id and e.fondo_pensiones = fp.id and e.fondo_cesantias = fc.id and e.eps = eps.id and
			e.caja_compensacion = cc.id and e.arl = arlx.id and
			e.pk_depto = ar.codigo_interno_empresa and ar.pk_empresa_areas = emp.cod_interno_empresa and e.und = u.id");
			while($row = mysql_fetch_array($sel)){
				$tiempo = (-1)*$this->dateDiff(date("Y-m-d"),$row['fecha_ingreso_empleado'])." DÍAS";
				$sexo = "";
				if($row['sexo_empleado'] == "M"){
					$sexo = "<td nowrap align = 'left' width = '25%'>
								<div><input type = 'radio' value = 'M' id = 'sm' name = 'sexox' checked class = 'radio'/>
									<label for='sm'><span><span></span></span>M</label></div>
							</td>
							<td nowrap align = 'left' width = '25%'>
								<div><input type = 'radio' value = 'F' id = 'sf' name = 'sexox'  class = 'radio'/>
									<label for='sf'><span><span></span></span>F</label></div>
								
							</td>";
				}else{
					$sexo = "<td nowrap align = 'left' width = '25%'>
								<div><input type = 'radio' value = 'M' id = 'sm' name = 'sexox'  class = 'radio'/>
									<label for='sm'><span><span></span></span>M</label></div>
							</td>
							<td nowrap align = 'left' width = '25%'>
								<div><input type = 'radio' value = 'F' id = 'sf' name = 'sexox' checked class = 'radio'/>
									<label for='sf'><span><span></span></span>F</label></div>
								
							</td>";
				}
				$estructura .="
					<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
						<th width = '96%' align = 'left'>
							<span class = 'mensaje_bienvenida'>INFORMACION EMPLEADO</span>
						</th>
						<td align = 'right'>
							<table width = '100%'>
								<tr>
									<td align = 'center' style = 'border:2px solid #87CDF0;border-radius:0.3em;'>
										<img src = '../images/iconos/icono_editar.png' class = 'iconos_opciones' />
									</td>
									<td align = 'center'>
										<img id = 'cerrar_ventana_info_basica_documentos'src = '../images/iconos/cerrar.png' class = 'iconos_opciones' onclick = 'cerrar_info_basica_empleado()' alt = 'Cerrar Ventana'/>
									</td>
								</tr>
							</table>
						</td>
					</table>
					<div id= 'contenedor_info_basica_empleado' style = 'overflow:scroll;width:100%;height:90%;'>
						<table width = '100%' class = 'tabla_nuevos_datos'  style = 'padding-left:50px;padding-right:50px;'>
							<tr>
								<th align = 'left'width = '49%' colspan = '2' nowrap></th>
								<th class = 'separator'  width = '5%'></th>
								<th nowrap align = 'left' colspan = '2' width = '48%'>LABORALES Y DE SALUD</th>
							</tr>
							<tr>
								<td colspan = '2'  align = 'center'>
									<div id = 'foto_x' >
										<img src = '../Process/EMPLEADO/".$row['foto']."' width = '180px' height = '180px' style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'/>
									</div>
									<table width = '100%'>
										<tr>
											<td width = '96%'>
												<input type = 'file' id = 'foto_empleado_x' onchange= 'cambiar_foto_empleado()' />
											</td>
											
											<td>
												<img id = 'limpiar_foto_empleado' src = '../images/iconos/eliminar.png' width = '40px' height = '40px' onclick = 'limpiar_foto_empleado_editar()'/>
											</td>
										</tr>
									</table>
								</td>
								<td class = 'separator'></td>
								<td style = 'padding-right:25px;'>
									<p>Fecha de Ingreso:</p>
									<input type = 'text' id = 'e_fecha_ingreso_empleado' value = '".$row['fecha_ingreso_empleado']."' readonly />
								</td>
								<td >
									<p>Fecha de Retiro:</p>
									<input type = 'text' id = 'e_fecha_retiro_empleado'  value = '".$row['fecha_retiro']."' />
								</td>
							</tr>
							<tr>
								<td colspan = '2' >
									<p>Nombre Completo:</p>
									<input type = 'text'  id = 'e_nombre_complet' value = '".$row['nombre_empleado']."'  />
								</td>
								<td class = 'separator'></td>
								<td style = 'padding-right:25px;'>
									<p>Tiempo Laborando:</p>
									<input type = 'text' id = 'e_tiempo_transcurrido' value = '$tiempo' readonly/>
								</td>
								<td>
									<p>Motivo de Retiro:</p>
									<textarea width = '100%' id = 'e_motivo_retiro' value = '".$row['motivo_retiro']."' ></textarea>
								</td>
							</tr>
							<tr>
								<td nowrap style = 'padding-right:25px;'>
									<p>Tipo de Documento:</p>
									<select id = 'e_tipo_doc_empleado'>
										<option value = '".$row['tipo_documento_empleado']."'>".$row['tipo_documento_empleado']."</option>
									</select>
								</td>
								<td>
									<p>Número:</p>
									<input type = 'text' id ='e_num_cedula_empleado' value = '".$row['documento_empleado']."' readonly/>
								</td>
								<td class = 'separator'></td>
								<td colspan = '2'>
									<table width = '100%' class = 'tabla_nuevos_datos'>
										<tr>
											<td >
												<p>Unidad Negocio:</p>
												<select id = 'e_und' onchange = 'cargar_departamentos_und()'>".$this->und_empresa($row['id_und'],$row['cod_interno_empresa'])."</select>
											</td>
											<td>
												<p>Área:</p>
												<select id = 'e_departamento_empleado'>".$this->departamentos_empresa($row['codigo_depto'],$row['id_und'])."</select>
											</td>
										</tr>
										<tr>
											<td colspan = '2'>
												<p>Cargo:</p>
												<input type = 'text' id = 'e_cargo_empleado' value ='".$row['cargo_empleado']."' />
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style = 'padding-right:25px;'>
									<table width = '100%'>
										<tr>
											<td colspan = '2'>
												<table width = '100%'>
													<tr>
														<td width = '10%'>Sexo:</td>
														$sexo
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
								<td>
									<p>Fecha de Nacimiento</p>
									<input type = 'text'  id = 'e_fecha_nacimiento_empleado' value = '".$row['fecha_nacimiento']."' readonly />
								</td>
								<td class = 'separator'></td>
								<td style = 'padding-right:25px;'>
									<p>EPS:</p>
									<select id = 'e_eps'>".$this->eps($row['codigo_eps'])."</select>
								</td>
								<td>
									<p>ARL:</p>
									<select id = 'e_arl'>".$this->farl($row['codigo_arl'])."</select>
								</td>
							</tr>
							<tr>
								<td style = 'padding-right:25px;'>
									<p>Dirección:</p>
									<input type ='text' id = 'e_direccion_empleado'  value = '".$row['direccion_empleado']."' />
								</td>
								<td >
									<p>Correo Personal:</p>
									<input type ='text' id = 'e_correo_personal'  value = '".$row['email_personal']."' />
								</td>
								<td class = 'separator'></td>
								<td colspan = '2'>
									<p>FONDO DE CESANTÍAS:</p>
									<select id = 'e_fondo_cesantias'>".$this->fcesantias($row['codigo_fc'])."</select>
								</td>						
							</tr>
							<tr>
								<td style = 'padding-right:25px;'>
									<p>Celular:</p>
									<input type = 'text' id = 'e_celular_empleado' value = '".$row['celular_empleado']."'  />
								</td>
								<td >
									<p>Teléfono de Casa:</p>
									<input type = 'text' id = 'e_phone_casa' value = '".$row['phone_casa_empleado']."' />
								</td>	
								<td class = 'separator'></td>
								<td colspan = '2'>
									<p>FONDO DE PENSIONES:</p>
									<select id = 'e_fondo_pensiones'>".$this->fpension($row['codigo_fp'])."</select>
								</td>
							</tr>
							<tr>
								<td colspan = '2'>
									<p>RH:</p>
									<input type = 'text' id = 'e_rh' value = '".$row['rh']."' readonly />
								</td>
								<td class = 'separator'></td>
								<td colspan = '2'>
									<p>CAJA DE COMPENSACIÓN</p>
									<select id = 'e_caja_compensacion'>".$this->ccompensacion($row['codigo_cc'])."</select>
								</td>
							</tr>
							<tr>
								<td colspan = '2'>
									<p>Correo Institucional:</p>
									<input type = 'text' id = 'e_correo'  value = '".$row['email_empleado']."'readonly />
								</td>
							</tr>
							<tr><td colspan = '5'></br></td></tr>
							<tr>
								<td colspan = '5' align = 'center'>
									<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' onclick = 'cerrar_editar_empleado(".$row['documento_empleado'].")'id = 'cancelar_editar_empleado' style = 'position:relative;'>
									<img src = '../images/iconos/guardar_1.png' class = 'iconos_guardar_x'   style = 'position:relative;top:45px;left:-50px;z-index:1;'>
									<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' onclick = 'modificar_empleado()' style = 'position:relative;left:-110px;'>
								</td>
							</tr>
						</table>
					</div>";
			}
			echo $estructura;
		}
		
		public function update_empleados($emp,$usuario,$file){
			$estado = 0;
			if($this->get_fecha_retiro() == "0000-00-00"){$estado = 1;}
			$sql = mysql_query("update empleado set nombre_empleado = '".$this->get_nombre_empleado()."',direccion_empleado = '".$this->get_direccion_empleado()."',und = '".$this->get_und()."',pk_depto ='".$this->get_area_empleado().
			"', phone_casa_empleado = '".$this->get_telefono_empleado()."', celular_empleado = '".$this->get_celular_empleado()."',cargo_empleado ='".$this->get_cargo_empleado().
			"',eps = '".$this->get_eps_empleado()."',fondo_pensiones = '".$this->get_fondo_pensiones_empleado()."',fondo_cesantias ='".$this->get_fondo_cesantias_empleado()."',
			caja_compensacion = '".$this->get_fondo_caja_compensacion()."', arl = '".$this->get_arl_empleado()."', foto = '".$file."',usuario ='".$usuario."', estado ='".$estado."', fecha_retiro = '".$this->get_fecha_retiro()."' where documento_empleado = '$emp'");
			
			/*$sql = mysql_query("update salarios_empleado set salario_base = '".$this->get_salario_base()."', otros = '".$this->get_otros().
			"',bonos_alimentacion = '".$this->get_b_alimentacion()."',bnp = '".$this->get_b_n_prestacional()."' where pk_empleado = '$emp'");*/
			
		}
		
		public function update_empleados_sin_foto($emp,$usuario){
			$estado = 0;
			if($this->get_fecha_retiro() == "0000-00-00"){$estado = 1;}
			$sql = mysql_query("update empleado set nombre_empleado = '".$this->get_nombre_empleado()."',direccion_empleado = '".$this->get_direccion_empleado()."',und = '".$this->get_und()."',pk_depto ='".$this->get_area_empleado().
			"', phone_casa_empleado = '".$this->get_telefono_empleado()."', celular_empleado = '".$this->get_celular_empleado()."',cargo_empleado ='".$this->get_cargo_empleado().
			"',eps = '".$this->get_eps_empleado()."',fondo_pensiones = '".$this->get_fondo_pensiones_empleado()."',fondo_cesantias ='".$this->get_fondo_cesantias_empleado()."',
			caja_compensacion = '".$this->get_fondo_caja_compensacion()."', arl = '".$this->get_arl_empleado()."',usuario ='".$usuario."', estado ='".$estado."', fecha_retiro = '".$this->get_fecha_retiro()."' where documento_empleado = '$emp'");
			
			/*$sql = mysql_query("update salarios_empleado set salario_base = '".$this->get_salario_base()."', otros = '".$this->get_otros().
			"',bonos_alimentacion = '".$this->get_b_alimentacion()."',bnp = '".$this->get_b_n_prestacional()."' where pk_empleado = '$emp'");*/
			
		}
		
		public function calculos_nomina_pptado($empleado,$und,$year){
			$s = mysql_query("select e.cod_interno_empresa from empresa e, und u
			where u.empresa = e.cod_interno_empresa and u.id = '$und'");
			$emp = "";
			while($row = mysql_fetch_array($s)){
				$emp = $row['cod_interno_empresa'];
			}
			$empx = mysql_query("select e.documento_empleado,e.pk_depto,e.fecha_ingreso_empleado,se.salario_base,se.bnp,se.bonos_alimentacion,se.otros 
				from empleado e, salarios_empleado se 
				where e.documento_empleado = se.pk_empleado and e.pk_empresa = '$emp' and e.documento_empleado = '".$empleado."'");
			$total_total = 0;
			while($row = mysql_fetch_array($empx)){
				$e_documento = $row['documento_empleado'];
				$salario_base_empleado_real = ($row['salario_base']);
				
				$beneficio_no_prestacional = ($row['bnp']);
				
				$salario_base_1 = $salario_base_empleado_real + $beneficio_no_prestacional+ $row['bonos_alimentacion'];
				
				$total_aportes_empleado = $this->aporte_salud($salario_base_empleado_real,$emp,$year) + $this->pension_deducciones($salario_base_empleado_real,$emp,$year) + $this->fondo_solidaridad_pensional($salario_base_empleado_real,$emp,$year) + 0 + 0;
				
				$id = $row['documento_empleado'];
				
				$total_a_pagar = $salario_base_1 + $this->aux_transporte($salario_base_empleado_real,$emp,$year);
				
				$neto_recibir_trabajador = ($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year)) - $total_aportes_empleado;
				
				$bonos = $row['bnp'] + $row['bonos_alimentacion'];
				
				$total_deducciones_del_trabajador = 0;
				
						
				$subtotal_prestaciones_sociales = $this->cesantias($salario_base_empleado_real+ $this->aux_transporte($salario_base_empleado_real,$emp,$year),$emp,$year) + $this->int_cesantias($salario_base_empleado_real+ $this->aux_transporte($salario_base_empleado_real,$emp,$year),$emp,$year) +
				$this->vacaciones($salario_base_empleado_real,$emp,$year) + $this->prima($salario_base_empleado_real+ $this->aux_transporte($salario_base_empleado_real,$emp,$year),$emp,$year);
				
				$subtotal_seguridad_social = $this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year) + $this->salud($salario_base_empleado_real,$emp,$year) + $this->pension($salario_base_empleado_real,$emp,$year);
				
				$subtotal_aporte_parafiscales = $this->caja_compensacion($salario_base_empleado_real,$emp,$year) + $this->icbf($salario_base_empleado_real,$emp,$year) +
				$this->sena($salario_base_empleado_real,$emp,$year);
				
				$total_todo = $subtotal_prestaciones_sociales + $total_a_pagar + $subtotal_seguridad_social + $subtotal_aporte_parafiscales;
				
				$total_total = $this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year) + $total_todo;
				
				$sqql = mysql_query("select e.documento_empleado from empleado e where e.cargo_empleado like '%PASANT%' and e.documento_empleado = '$e_documento'");
				if(mysql_num_rows($sqql) == 0){
					$total_deducciones_del_trabajador = $bonos + $neto_recibir_trabajador;
					$total_total = $this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year) + $total_todo;
				}else{
					$xsql = mysql_query("select otros from tablas_empleados where cedula = '$e_documento'");
					while($ro = mysql_fetch_array($xsql)){
						$total_deducciones_del_trabajador = $ro['otros'];
						$total_total = $this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year) + $ro['otros'];
					}
				}
			}
			return $total_total;
		}
		
		public function calculos_nomina($sql,$und,$year){
			$s = mysql_query("select e.cod_interno_empresa from empresa e, und u
			where u.empresa = e.cod_interno_empresa and u.id = '$und'");
			$emp = "";
			$total_total = 0;
			while($row = mysql_fetch_array($s)){
				$emp = $row['cod_interno_empresa'];
			}
			while($row = mysql_fetch_array($sql)){
				$e_documento = $row['documento_empleado'];
				$salario_base_empleado_real = ($row['salario_base']/30)*$row['dias'];
				
				$beneficio_no_prestacional = ($row['bnp']/30)*$row['dias'];
				
				$salario_base_1 = $salario_base_empleado_real + $beneficio_no_prestacional+ $row['balimentacion'];
				
				$total_aportes_empleado = $this->aporte_salud($salario_base_empleado_real,$emp,$year) + $this->pension_deducciones($salario_base_empleado_real,$emp,$year) + $this->fondo_solidaridad_pensional($salario_base_empleado_real,$emp,$year) + $row['rte'] + $row['afc'];
				
				$id = $row['documento_empleado'];
				
				$total_a_pagar = $salario_base_1 + $this->aux_transporte($salario_base_empleado_real,$emp,$year);
				
				$neto_recibir_trabajador = ($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year)) - $total_aportes_empleado;
				
				$bonos = $row['bnp'] + $row['balimentacion'];
				
				$total_deducciones_del_trabajador = 0;
				
						
				$subtotal_prestaciones_sociales = $this->cesantias($salario_base_empleado_real+ $this->aux_transporte($salario_base_empleado_real,$emp,$year),$emp,$year) + $this->int_cesantias($salario_base_empleado_real+ $this->aux_transporte($salario_base_empleado_real,$emp,$year),$emp,$year) +
				$this->vacaciones($salario_base_empleado_real,$emp,$year) + $this->prima($salario_base_empleado_real+ $this->aux_transporte($salario_base_empleado_real,$emp,$year),$emp,$year);
				
				$subtotal_seguridad_social = $this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year) + $this->salud($salario_base_empleado_real,$emp,$year) + $this->pension($salario_base_empleado_real,$emp,$year);
				
				$subtotal_aporte_parafiscales = $this->caja_compensacion($salario_base_empleado_real,$emp,$year) + $this->icbf($salario_base_empleado_real,$emp,$year) +
				$this->sena($salario_base_empleado_real,$emp,$year);
				
				$total_todo = $subtotal_prestaciones_sociales + $total_a_pagar + $subtotal_seguridad_social + $subtotal_aporte_parafiscales;
				
				$total_total = $this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year) + $total_todo;
				
				$sqql = mysql_query("select e.documento_empleado from empleado e where e.cargo_empleado like '%PASANT%' and e.documento_empleado = '$e_documento'");
				if(mysql_num_rows($sqql) == 0){
					$total_deducciones_del_trabajador = $bonos + $neto_recibir_trabajador;
					$total_total = $this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year) + $total_todo;
				}else{
					$xsql = mysql_query("select otros from tablas_empleados where cedula = '$e_documento'");
					while($ro = mysql_fetch_array($xsql)){
						$total_deducciones_del_trabajador = $ro['otros'];
						$total_total = $this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year) + $ro['otros'];
					}
				}
			}
			return $total_total;
		}
		
		public function modificar_dias_empleado_hv($id,$dias,$empleado,$periodo,$empresa){
			$sql = mysql_query("update tablas_empleados set dias = '$dias' where id = '$id'");
			$this->hoja_vida_empleado($empleado,$periodo,$empresa);
		}
		public function modiciar_bonos_empleado($id,$val,$empleado,$periodo,$empresa){
			$sql = mysql_query("update tablas_empleados set balimentacion = '$val' where id = '$id'");
			$this->hoja_vida_empleado($empleado,$periodo,$empresa);
		}
		public function menu_hojas_de_vida(){
			$tabla = "
				<table width = 'auto' class = 'barra_busqueda' style = 'padding-left:50px;'>
					<tr>
						<td >
							<p>Seleccione un Empleado:</p>
							<select id = 'listado_empleados_empresa_x' onchange = 'validar_valor_sel_empleado_hj()' style = 'width:auto;border:2px solid red;'></select>
						</td>
					</tr>
					<tr>
						<td >
							<img src = '../images/iconos/generar_on.png'  height ='120px' id = 'id_imagen_generar_npersonal' style = 'filter:alpha(opacity=50);-moz-opacity:0.5;-webkit-opacity:50;opacity:0.5;'/>
						</td>
					</tr>
				</table>";
			echo $tabla;
		}
		
		public function menu_nomina_detallado($emp,$und,$alto){
			$alto_h = ($alto*20)/100;
			$impri = "<option value = ''>PERIODO</option>";
			$sql = mysql_query("select distinct periodo from tablas_empleados where empresa = '$emp' order by periodo asc");
			while($row = mysql_fetch_array($sql)){
				$impri .= "<option value = '".$row['periodo']."'>".$row['periodo']."</option>";
			}
			$tabla = "
				<table width = '100%' height = '$alto_h' class = 'barra_busqueda'>
					<tr>
						<td style = 'padding-left:20px;'>
							<p>Periodo</p>
							<select id = 'periodo_nomina_x' onchange = 'limpiar_filtros_hv()'>$impri</select>
						</td>
						<td >
							<p>Unidad de Negocio</p>
							<select id = 'und_nomina_detallado_x' onchange = 'cargar_empleados_und_nd()'>$und</select>
						</td>
					</tr>
				</table>
				<div id = 'contenedor_hojas_vida_empleados_x' ></div>";
			echo $tabla;
		}
		
		public function menu_personal_donw($emp,$und,$alto){
			$alto_h = ($alto*20)/100;
			$impri = "<option value = ''>PERIODO</option>";
			$sql = mysql_query("select distinct periodo from tablas_empleados where empresa = '$emp'order by periodo asc");
			while($row = mysql_fetch_array($sql)){
				$impri .= "<option value = '".$row['periodo']."'>".$row['periodo']."</option>";
			}
			$tabla = "
				<table width = '100%' height = '$alto_h'>
					<tr>
						<td >
							<p>Periodo</p>
							<select id = 'periodo_nomina_x' onchange = 'limpiar_filtros_hv()'>$impri</select>
						</td>
						<td >
							<p>Unidad de Negocio</p>
							<select id = 'und_pd_x' onchange = 'cargar_empleados_und_pd()'>$und</select>
						</td>
					</tr>
				</table>
				<div id = 'contenedor_hojas_vida_empleados_x' ></div>";
			echo $tabla;
		}
		
		public function consultar_nomina_por_periodos($emp,$und){
			$und.="<option value = 'all'>TODAS</option>";
			$periodos = "<option value = '0'>[SELECCIONE]</option>";
			$sql = mysql_query("select distinct periodo  from tablas_empleados where empresa = '$emp'order by periodo asc");
			while($row = mysql_fetch_array($sql)){
				$d = explode("-",$row['periodo']);
				if(date("m") == $d[1]){
					$periodos .="<option value = '".$row['periodo']."' selected>".$row['periodo']."</option>";
				}else{
					$periodos .="<option value = '".$row['periodo']."'>".$row['periodo']."</option>";
				}
				
			}
			$est = "
				<table  class = 'barra_busqueda' style = 'padding-left:50px;'>
					<tr>
						<td >
							<p>Seleccione un Periodo(*):</p>
							<select id = 'periodo_nomina_x' onchange = 'limpiar_filtros_hv()'>$periodos</select>
						</td>
						<td style = 'padding-left:20px;'>
							<p>Seleccione una Unidad de Negocio(*):</p>
							<select id = 'und_nomina_detallado_x' >$und</select>
						</td>
					</tr>
				</table>
				<table width = '100%' style = 'padding-left:50px;'>
					<tr>
						<td align = 'center'  width = '32%'>
							<a href = '#listado_empleados_empresa_x'> <img src = '../images/iconos/hoja_vida.png' height = '230px' width = 'auto' id = 'hojas_de_vida' onclick = 'cargar_menu_hj()'/></a>
						</td>
						<td align = 'center' width = '32%'>
							<img src = '../images/iconos/nomina_detallado.png' height = '230px' width = 'auto' id = 'nomina_detallado_x' onclick = 'generar_cuadro_nomina_detallado()'/>
						</td>
						<td   align = 'center' width = '32%'>
							<img src = '../images/iconos/indenniaciones_liquidaciones.png' height = '230px' width = 'auto' id = 'indenp_liquidaciones' onclick = 'generar_cuadro_personal_down()'/>
						</td>
					</tr>
					<tr>
						<td id = 'menu_hj_empleado'></td>
						<td id = 'menu_nd_empleado'></td>
						<td id = 'menu_pd_empleado'></td>
					</tr>
				</table>
				<div id = 'menus_nominaxx' width = '100%'>
					
				</div>
			";
			return $est;
		}
		
		public function menu_personal_down_ind($und){
			$tabla = "
				<table width = 'auto' class = 'barra_busqueda'>
					<tr>
						<td>
							<p>Seleccione una Unidad de Negocio(*):</p>
							<select id = 'und_personal_down_x' onchange = 'generar_cuadro_personal_down()'>$und</select>
						</td>
					</tr>
				</table>";
			echo $tabla;
		}
		
		public function consutar_nomina_detallado($und){
			$tabla = "
				<table width = 'auto' class = 'barra_busqueda' style = 'padding-left:50px;'>
					<tr>
						<td>
							<p>Seleccione una Unidad de Negocio</p>
							<select id = 'und_nomina_detallado_x' >$und</select>
						</td>
					</tr>
				</table>";
			echo $tabla;
		}
		
		public function crear_nomina_mes($emp){
			/*
				$est = "
			<table width = '100%' class = 'barra_busqueda' height = '100%' style = 'vertical-align:middle;'>
				<tr>
					<th  class='titulos_gestion_azul mano' align = 'left' style = 'padding-left:20px;' onclick = 'ocultar_sub_menu_duplicar_nomina()'>DUPLICAR NÓMINA MES ANTERIOR</th>
				</tr>
				<tr class = 'hijo_duplicar_nomina' style = 'display:none;'><td></br></td></tr>
				<tr class = 'hijo_duplicar_nomina' style = 'display:none;'>
					<td align = 'center' nowrap id = 'trasladar_nomina'>
						<img src = '../images/iconos/duplicar_nomina.png' onclick = 'trasladar_nomina()' height = '150px'/>
					</td>
				</tr>
				<tr class = 'hijo_duplicar_nomina' style = 'display:none;'><td></br></td></tr>
				
				<tr>
					<th class='titulos_gestion_azul mano' align = 'left' style = 'padding-left:20px;' id = 'nomina_uno_uno_id'  onclick = 'ocultar_uno_uno_nomina()'>SELECCIONAR UNO A UNO</th>
				</tr>
				
				<tr class = 'hijo_nomina_mensual_uno_uno ' style = 'display:none;'>
					<td>
						<table width = '100%' class = 'barra_busqueda'>
							<tr>
								<td style = 'padding-left:20px;'><p>Seleccione una Unidad de Negocio</p></td>
								<td align = 'right'>
									<span class = 'botton_verde' id = 'guardar_nomina_x_mes_empleados' onclick = 'generar_nomina_mes()'>Guardar Nómina</span>
								</td>
							</tr>
							<tr>
								<td style = 'padding-left:20px;'>
									<select id = 'unidad_negocio_c_nomina' onchange = 'listar_empleados_und_nueva_nomina()'>".$this->und_empresa_lista($emp)."</select>
								</td>
							</tr>
							<tr>
								<td colspan = '2'>
									<div width = '100%' height = '200px' id = 'contenendor_lista_empleados_carga' style = 'overflow:scroll;'>
											
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				
				
				<tr>
					<th class='titulos_gestion_azul mano' align = 'left' style = 'padding-left:20px;'  onclick = 'ocultar_uno_uno_nomina()'>GENERAR NÓMINA EXCEL</th>
				</tr>
			</table>";
			*/
			$est = "
				<table width = '100%' class = 'barra_busqueda' style = 'vertical-align:middle;'>
					<tr>
						<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' colspan = '2'>
							<table width = '100%'>
								<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano'>GENERAR NÓMINA POR EXCEL</td>
							</table>
						</th>
					</tr>
					<tr >
						<td style = 'vertical-align:middle;padding-left:20px;'>
							<p>Seleccione un Archivo (EXCEL):</p>
							<input  style = 'width:100%;' class = 'mano' type = 'file' name = 'excel_nomina' id = 'excel_nomina' accept='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel,text/comma-separated-values, text/csv, application/csv'/>
						</td>
						<td align = 'center'>
							<img src = '../images/iconos/icon-27_excel.png' onclick = 'subir_archivo_nomina_excel()' class = 'iconos_barra'/>
						</td>
					</tr>
				</table>
			";
			return $est;
		}
		
		public function generar_nomina_excel(){
			
		}
		
		//Simulador y Cuadros nomina
		
		public function insert_nombre_simulador($name,$user,$fecha,$m,$v,$emp){
			if($m == 1){
				$sb = ($v*60)/100;
				$bnp = ($v*40)/100;
				$insert = mysql_query("insert into SMCE(name,user,fecha,total,modalidad,salario,bnp,empresa) values ('".strtoupper($name)."','".$user."','".$fecha."','".$v."','".$m."','".$sb."','".$bnp."','".$emp."')");
			}else if($m == 2){
				$insert = mysql_query("insert into SMCE(name,user,fecha,total,modalidad,salario,empresa) values ('".strtoupper($name)."','".$user."','".$fecha."','".$v."','".$m."','".$v."','".$emp."')");
			}
			$id = 0;
			$consulta = mysql_query("select max(id) as id from SMCE where apro = '0'");
			while($row = mysql_fetch_array($consulta)){
				$id = $row['id'];
			}
			return $id;
		}
		
		public function insert_salario_sim($id,$val){
			mysql_query("update SMCE set salario = '$val' where id = '$id'");
		}
		
		public function insert_bono_sim($id,$val){
			mysql_query("update SMCE set bonos = '$val' where id = '$id'");
		}
		

		/*Añadir a prestaciones el valor del auxlilio de*/
		public function simulador_hoja_vida_nuevo_empleado($id,$emp){
			$tabla = "<table class ='tablas_muestra_datos_tablas' width = '100%'>";
			$consulta = mysql_query("select name,salario,bnp,otros,bonos from SMCE where id = '$id'");
			while($row = mysql_fetch_array($consulta)){
				$salario_base_empleado_real = $row['salario'];
				$beneficio_no_prestacional = $row['bnp'];
				$salario_base_1 = $salario_base_empleado_real + $beneficio_no_prestacional+ $row['bonos'];
				
				$total_aportes_empleado = $this->aporte_salud_sim($salario_base_empleado_real,$emp) + $this->pension_deducciones_sim($salario_base_empleado_real,$emp) + $this->fondo_solidaridad_pensional_sim($salario_base_empleado_real,$emp);// + $row['rte'] + $row['afc'];
				
				
				$total_a_pagar = $salario_base_1 + $this->aux_transporte_sim($salario_base_empleado_real,$emp);
				
				$neto_recibir_trabajador = ($salario_base_empleado_real + $this->aux_transporte_sim($salario_base_empleado_real,$emp)) - $total_aportes_empleado;
				
				$bonos = $row['bnp'] + $row['bonos'];
				
				$total_deducciones_del_trabajador = 0;
				$total_total = 0;
						
				$subtotal_prestaciones_sociales = $this->cesantias_sim($salario_base_empleado_real+ $this->aux_transporte_sim($salario_base_empleado_real,$emp),$emp) + $this->int_cesantias_sim($salario_base_empleado_real+ $this->aux_transporte_sim($salario_base_empleado_real,$emp),$emp) +
				$this->vacaciones($salario_base_empleado_real,$emp) + $this->prima_sim($salario_base_empleado_real+ $this->aux_transporte_sim($salario_base_empleado_real,$emp),$emp);
				
				$subtotal_seguridad_social = $this->arl_simulador($salario_base_empleado_real,$emp,$id) + $this->salud_sim($salario_base_empleado_real,$emp) + $this->pension($salario_base_empleado_real,$emp);
				
				$subtotal_aporte_parafiscales = $this->caja_compensacion_sim($salario_base_empleado_real,$emp) + $this->icbf_sim($salario_base_empleado_real,$emp) +
				$this->sena_sim($salario_base_empleado_real,$emp);
				
				$total_todo = $subtotal_prestaciones_sociales + $total_a_pagar + $subtotal_seguridad_social + $subtotal_aporte_parafiscales;
				
				$total_total = $this->base_indemnizaciones_provisiones_simulacro($salario_base_empleado_real,$id,$emp) + $total_todo;
				
				$sqql = mysql_query("select name from SMCE e where name like '%PASANT%' and id = '$id'");
				if(mysql_num_rows($sqql) == 0){
					$total_deducciones_del_trabajador = $bonos + $neto_recibir_trabajador;
					$total_total = $this->base_indemnizaciones_provisiones_simulacro($salario_base_empleado_real,$id,$emp) + $total_todo;
				}else{
					$xsql = mysql_query("select otros from SMCE where id = '$id'");
					while($ro = mysql_fetch_array($xsql)){
						$total_deducciones_del_trabajador = $ro['otros'];
						$total_total = $this->arl_simulador($salario_base_empleado_real,$emp,$id) + $ro['otros'];
					}
				}
			$tabla .= "
					<tr>
						<th colspan = '3' class = 'nombre_empleado_hj' style = 'font-size:1.6em;color:#6B6D6F;'>
						".$row['name']."
						<span id = 'id_sim' class = 'hidde'>$id</span>
						</th>
					</tr>
					<tr>
						<td>Salario Base</td>
						<td align = 'center'>30</td>
						<td>
							<table  width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left'>$</td>
									<td align = 'right' ondblclick = 'editar_sb($id)' id = 'sb_campo'>
										<span id = 'sb_empleado' >".number_format($salario_base_empleado_real)."</span><span id = 'sb_empleado_h' class = 'hidde'>".$salario_base_empleado_real."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>Otros</td>
						<td></td>
						<td>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'otros_emp'>".number_format($row['otros'])."</span><span id = 'otros_emp_h' class = 'hidde'>".$row['otros']."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>Bonos Alimentación</td>
						<td></td>
						<td>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' id = 'bono_al_sim' ondblclick = 'editar_bonos_sim($id)' >
										<span id = 'b_alimentacion_emp'>".number_format($row['bonos'])."</span><span id = 'b_alimentacion_emp_h' class = 'hidde'>".$row['bonos']."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>Beneficio No Prestacional</td>
						<td></td>
						<td>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'b_np_emp'>".number_format($beneficio_no_prestacional)."</span><span id = 'b_np_emp_h' class = 'hidde'>".$beneficio_no_prestacional."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><strong>Salario Base</strong></td>
						<td></td>
						<td>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'salario_base_final' class = 'bold'>".number_format($salario_base_1)."</span><span id = 'salario_base_final_h' class = 'hidde'>".$salario_base_1."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>Auxilio de Transporte</td>
						<td></td>
						<td>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'aux_transporte_emp'>".number_format($this->aux_transporte_sim($salario_base_empleado_real,$emp))."</span><span id = 'aux_transporte_emp_h' class = 'hidde'>".$this->aux_transporte_sim($salario_base_empleado_real,$emp)."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><strong>Total a Pagar</strong></td>
						<td></td>
						<td>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'total_a_pagar' class = 'bold' >".number_format($total_a_pagar)."</span><span id = 'total_a_pagar_h' class = 'hidde'>".$total_a_pagar."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><strong>BASE PARA SEGURIDAD SOCIAL</strong></td>
						<td></td>
						<td>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'base_para_seguridad_social'>".number_format($this->base_seguridad_social($salario_base_empleado_real,$emp))."</span><span id = 'base_para_seguridad_social_h' class = 'hidde'>".$this->base_seguridad_social($salario_base_empleado_real,$emp)."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><strong>BASE PARA VACACIONES</strong></td>
						<td></td>
						<td>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'base_para_vacaciones'>".number_format($salario_base_empleado_real)."</span><span id = 'base_para_vacaciones_h' class = 'hidde'>".$salario_base_empleado_real."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<th onclick = 'ocultar_prestaciones_sociales()'colspan ='3' style = 'background-color:#FA9F1F;color:white;padding-top:5px;'>
							<table width = '100%' class = 'titulos_cuadros'>
								<tr>
									<th width = '98%' style = 'padding:15px;font-size:1em;'>PRESTACIONES SOCIALES</th>
									<th id = 'triangulo_pshj_nd' align = 'center'>
										<div class = 'triangulo_inf' ></div>
									</th>
								</tr>
							</table>
						</th>
					</tr>
					<tr class = 'op_prestaciones_sociales'style = 'display:none;'>
						<td>Cesantías</td>
						<td align = 'center'>".($this->por_cesantias_sim($salario_base_empleado_real,$emp))."%</td>
						<td>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'cesantias'>".number_format($this->cesantias_sim($salario_base_empleado_real+ $this->aux_transporte_sim($salario_base_empleado_real,$emp),$emp))."</span><span id = 'cesantias_h' class = 'hidde'>".$this->cesantias_sim($salario_base_empleado_real+ $this->aux_transporte_sim($salario_base_empleado_real,$emp),$emp)."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'op_prestaciones_sociales'style = 'display:none;'>
						<td>Intereses Cesantías</td>
						<td align = 'center'>".($this->por_int_cesantias_sim($salario_base_empleado_real,$emp))."%</td>
						<td>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'int_cesantias'>".number_format($this->int_cesantias_sim($salario_base_empleado_real+ $this->aux_transporte_sim($salario_base_empleado_real,$emp),$emp))."</span><span id = 'int_cesantias_h' class = 'hidde'>".$this->int_cesantias_sim($salario_base_empleado_real+ $this->aux_transporte_sim($salario_base_empleado_real,$emp),$emp)."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'op_prestaciones_sociales'style = 'display:none;'>
						<td >Prima de Servicios</td>
						<td align = 'center' ><span>".($this->por_prima_sim($salario_base_empleado_real,$emp))."%</span></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'prima'>".number_format($this->prima_sim($salario_base_empleado_real+ $this->aux_transporte_sim($salario_base_empleado_real,$emp),$emp))."</span><span id = 'prima_h' class = 'hidde'>".$this->prima_sim($salario_base_empleado_real+ $this->aux_transporte_sim($salario_base_empleado_real,$emp),$emp)."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'op_prestaciones_sociales'style = 'display:none;'>
						<td >Vacaciones</td>
						<td align = 'center'><span>".($this->por_vacaciones($salario_base_empleado_real,$emp))."%</span></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'vacaciones'>".number_format($this->vacaciones($salario_base_empleado_real,$emp))."</span><span id = 'vacaciones_h' class = 'hidde'>".$this->vacaciones($salario_base_empleado_real,$emp)."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td ><strong>SUBTOTAL PRESTACIONES SOCIALES</strong></td>
			<td align  ='center'><strong><span>".($this->por_total_prestaciones_sociales_sim($salario_base_empleado_real,$emp))."%</span></strong></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<strong><span id = 'subtotal_ps'>".number_format($subtotal_prestaciones_sociales)."</span><span id = 'subtotal_ps_h' class = 'hidde'>".$subtotal_prestaciones_sociales."</span></strong>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr>
						<th onclick = 'ocultar_seguridad_social()'colspan ='3' align = 'center' style = 'background-color:#FA9F1F;color:white;padding-top:5px;'>
							<table width = '100%' class = 'titulos_cuadros'>
								<tr>
									<th width = '98%' style = 'padding:15px;font-size:1em;'>SEGURIDAD SOCIAL</th>
									<th id = 'triangulo_sshj_nd' align = 'center'>
										<div class = 'triangulo_inf' ></div>
									</th>
								</tr>
							</table>
						</th>
					</tr>
					<tr class = 'op_seguridad_social'style = 'display:none;'>
						<td >Pesion</td>
						<td  align = 'center'><span>".$this->por_pension($salario_base_empleado_real,$emp)."</span></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'pension_ss'>".number_format($this->pension($salario_base_empleado_real,$emp))."</span><span id = 'pension_ss_h' class = 'hidde'>".$this->pension($salario_base_empleado_real,$emp)."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'op_seguridad_social'style = 'display:none;'>
						<td >Salud</td>
						<td  align = 'center'><span>".$this->por_salud_sim($salario_base_empleado_real,$emp)."</span></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'salud_ss'>".number_format($this->salud_sim($salario_base_empleado_real,$emp))."</span><span id = 'salud_ss_h' class = 'hidde'>".$this->salud_sim($salario_base_empleado_real,$emp)."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'op_seguridad_social'style = 'display:none;'>
						<td >ARL</td>
						<td  align = 'center'><span>".$this->por_arl_simulador($salario_base_empleado_real,$emp,$id)."</span></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'arl'>".number_format($this->arl_simulador($salario_base_empleado_real,$emp,$id))."</span><span id = 'arl_h' class = 'hidde'>".$this->arl_simulador($salario_base_empleado_real,$emp,$id)."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr >
						<td ><strong>SUBTOTAL SEGURIDAD SOCIAL</strong></td>
						<td  align = 'center' ><strong><span>".$this->por_total_seguridad_social_sim($salario_base_empleado_real,$emp,$id)."%</span></strong></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<strong><span id = 'subtotal_ps'>".number_format($subtotal_seguridad_social)."</span><span id = 'subtotal_ps_h' class = 'hidde'>".$subtotal_seguridad_social."</span></strong>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr>
						<th onclick = 'ocultar_aportes_parafiscales()'colspan ='3' align = 'center' style = 'background-color:#FA9F1F;color:white;padding-top:5px;'>
							<table width = '100%' class = 'titulos_cuadros'>
								<tr>
									<th width = '98%' style = 'padding:15px;font-size:1em;'>APORTES PARAFISCALES</th>
									<th id = 'triangulo_apshj_nd' align = 'center'>
										<div class = 'triangulo_inf' ></div>
									</th>
								</tr>
							</table>
						</th>
					</tr>
					<tr class = 'op_aportes_parafiscales'style = 'display:none;'>
						<td >Caja de Compensación</td>
						<td  align = 'center'><span>".$this->por_caja_compensacion_sim($salario_base_empleado_real,$emp)."%</span></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'caja_compensacion'>".number_format($this->caja_compensacion_sim($salario_base_empleado_real,$emp))."</span><span id = 'caja_compensacion_h' class = 'hidde'>".$this->caja_compensacion_sim($salario_base_empleado_real,$emp)."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'op_aportes_parafiscales'style = 'display:none;'>
						<td >ICBF</td>
						<td  align = 'center'><span>".$this->por_icbf_sim($salario_base_empleado_real,$emp)."%</span></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'icbf'>".number_format($this->icbf_sim($salario_base_empleado_real,$emp))."</span><span id = 'icbf_h' class = 'hidde'>".$this->icbf_sim($salario_base_empleado_real,$emp)."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'op_aportes_parafiscales'style = 'display:none;'>
						<td >Sena</td>
						<td align = 'center'><span>".$this->por_sena_sim($salario_base_empleado_real,$emp)."%</span></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'sena'>".number_format($this->sena_sim($salario_base_empleado_real,$emp))."</span><span id = 'sena_h' class = 'hidde'>".$this->sena_sim($salario_base_empleado_real,$emp)."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td ><strong>SUBTOTAL APORTES PARAFISCALES</strong></td>
						<td align = 'center'><strong><span>".$this->por_total_aportes_parafiscales_sim($salario_base_empleado_real,$emp)."%</span></strong></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<strong><span id = 'subtotal_ap'>".number_format($subtotal_aporte_parafiscales)."</span><span id = 'subtotal_ap_h' class = 'hidde'>".$subtotal_aporte_parafiscales."</span></strong>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr>
						<th onclick = 'ocultar_deducciones()'colspan ='3' align = 'center' style = 'background-color:#FA9F1F;color:white;padding-top:5px;'>
							<table width = '100%' class = 'titulos_cuadros'>
								<tr>
									<th width = '98%' style = 'padding:15px;font-size:1em;'>DEDUCCIONES TRABAJADOR</th>
									<th id = 'triangulo_ddshj_nd' align = 'center'>
										<div class = 'triangulo_inf' ></div>
									</th>
								</tr>
							</table>
						</th>
					</tr>
					
					<tr class = 'op_deducciones'style = 'display:none;'>
						<td>Salud</td>
						<td align = 'center'>".$this->por_aporte_salud_sim($salario_base_empleado_real,$emp)."%</td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'salud_empleado'>".number_format($this->aporte_salud_sim($salario_base_empleado_real,$emp))."</span><span id = 'salud_empleado_h' class = 'hidde'>".$this->aporte_salud_sim($salario_base_empleado_real,$emp)."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'op_deducciones'style = 'display:none;'>
						<td>Pensión</td>
						<td align = 'center'>".$this->por_pension_deducciones_sim($salario_base_empleado_real,$emp)."%</td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'pension_empleado'>".number_format($this->pension_deducciones_sim($salario_base_empleado_real,$emp))."</span><span id = 'pension_empleado_h' class = 'hidde'>".$this->pension_deducciones_sim($row['salario'],$emp)."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'op_deducciones'style = 'display:none;'>
						<td>Fondo de Solidaridad Pensional</td>
						<td align = 'center'>".$this->por_fondo_solidaridad_pensional_sim($salario_base_empleado_real,$emp)."%</td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'fondo_solidaridad_pensional_empleado'>".number_format($this->fondo_solidaridad_pensional_sim($salario_base_empleado_real,$emp))."</span><span id = 'fondo_solidaridad_pensional_empleado_h' class = 'hidde'>".$this->fondo_solidaridad_pensional_sim($salario_base_empleado_real,$emp)."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'op_deducciones'style = 'display:none;' class = 'sin_color'>
						<td>Rte Fte</td>
						<td align = 'center'>4%</td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'rte_fte' ondblclick = 'editar_rte_empleado($id)'>".number_format(0)."</span><span id = 'rte_fte_h' class = 'hidde'>0</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'op_deducciones'style = 'display:none;'>
						<td>AFC</td>
						<td></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span ondblclick = 'editar_afc_empleado($id)' id = 'afc'>".number_format(0)."</span><span id = 'afc_h' class = 'hidde'>0</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'op_deducciones'style = 'display:none;'>
						<td><strong>Total Aportes Empleado</strong></td>
						<td></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'total_aportes_empleado' >".number_format($total_aportes_empleado)."</span><span id = 'total_aportes_empleado_h' class = 'hidde'>".$total_aportes_empleado."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'op_deducciones'style = 'display:none;'>
						<td><strong>Neto a recibir trabajador dinero</strong></td>
						<td></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' class = 'bold'>
										<span id = 'neto_empleado'>".number_format($neto_recibir_trabajador)."</span><span id = 'neto_empleado_h' class = 'hidde'>".$neto_recibir_trabajador."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'op_deducciones'style = 'display:none;'>
						<td><strong>Bonos</strong></td>
						<td></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<span id = 'bonos'>".number_format($bonos)."</span><span id = 'bonos_h' class ='hidde'>".$bonos."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'op_deducciones'style = 'display:none;' class = 'sin_color'>
						<td><strong>Total</strong></td>
						<td></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' class ='bold'>
										<span id = 'total_deducciones_trabajador'>".number_format($total_deducciones_del_trabajador)."</span><span id = 'total_deducciones_trabajador_h' class = 'hidde'>".$total_deducciones_del_trabajador."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					
					<tr class = 'op_deducciones' style = 'display:none;'>
						<td ><strong>SUBTOTAL SALARIO</strong></td>
						<td ><span></span></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<strong><span id = 'subtotal_salario_final'>".number_format($total_a_pagar)."</span></strong><span id = 'subtotal_ap_h' class = 'hidde'>".$total_a_pagar."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'op_deducciones' style = 'display:none;'>
						<td ><strong>SUBTOTAL DE PRESTACIONES LEGALES</strong></td>
						<td ><span></span></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<strong><span id = 'subtotal_prestaciones_sociales'>".number_format($subtotal_prestaciones_sociales)."</span></strong><span id = 'subtotal_prestaciones_sociales_h' class = 'hidde'>".$subtotal_prestaciones_sociales."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'op_deducciones' style = 'display:none;'>
						<td ><strong>SUBTOTAL DE SEGURIDAD SOCIAL</strong></td>
						<td ><span></span></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<strong><span id = 'subtotal_seguridad_social'>".number_format($subtotal_seguridad_social)."</span></strong><span id = 'subtotal_seguridad_social_h' class = 'hidde'>".$subtotal_seguridad_social."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'op_deducciones' style = 'display:none;'>
						<td ><strong>SUBTOTAL DE APORTES PARAFISCALES</strong></td>
						<td ><span></span></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<strong><span id = 'subtotal_aportes_parafiscales'>".number_format($subtotal_aporte_parafiscales)."</span></strong><span id = 'subtotal_aportes_parafiscales_h' class = 'hidde'>".$subtotal_aporte_parafiscales."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan = '2'><strong>SUBTOTAL</strong></td>
						<td>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<strong><span id = 'total'>".number_format($total_todo)."</span></strong><span id = 'total_h' class = 'hidde'>".$total_todo."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr >
						<td colspan = '2'><strong>INDEMNIZACION</strong></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<strong><span id = 'indemnizacion'>".number_format($this->base_indemnizaciones_provisiones_simulacro($salario_base_empleado_real,$id,$emp))."</span></strong><span id = 'indemnizacion_h' class = 'hidde'>".$this->base_indemnizaciones_provisiones_simulacro($salario_base_empleado_real,$id,$emp)."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan = '2'><strong>TOTAL</strong></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<strong><span id = 'total_total'>".number_format($total_total)."</span></strong><span id = 'total_total_h' class = 'hidde'>".$total_total."</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan  ='2'><strong>TOTAL RECIBIDO</strong></td>
						<td >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td  align = 'left' >$</td>
									<td align = 'right' >
										<strong><span id = 'total_recibido'>".number_format($total_deducciones_del_trabajador)."</span><span id = 'total_recibido_h' class = 'hidde'>".$total_deducciones_del_trabajador."</span></strong>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				";
			}
			echo $tabla."</table>";
		}
		
		public function hoja_vida_empleado($cedula,$periodo,$emp){
			$year = explode("-",$periodo);
			$tabla = "<table class ='tablas_muestra_datos_tablas' width = '100%' >";
			$sel = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = '$cedula' and e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.empresa = '$emp'");
			while($row = mysql_fetch_array($sel)){
				$e_documento = $row['documento_empleado'];
				$salario_base_empleado_real = (($row['salario_base'])/30)*$row['dias'];
				
				$beneficio_no_prestacional = ($row['bnp']/30)*$row['dias'];
				
				$salario_base_1 = $salario_base_empleado_real + $beneficio_no_prestacional+ $row['balimentacion'];
				
				$total_aportes_empleado = $this->aporte_salud($salario_base_empleado_real,$emp,$year[0]) + $this->pension_deducciones($salario_base_empleado_real,$emp,$year[0]) + $this->fondo_solidaridad_pensional($salario_base_empleado_real,$emp,$year[0]) + $row['rte'] + $row['afc'];
				
				$id = $row['id'];
				
				$total_a_pagar = $salario_base_1 + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]);
				
				$neto_recibir_trabajador = ($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0])) - $total_aportes_empleado;
				
				$bonos = $row['bnp'] + $row['balimentacion'];
				
				$total_deducciones_del_trabajador = 0;
				$total_total = 0;
						
				$subtotal_prestaciones_sociales = $this->cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]) + $this->int_cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]) +
				$this->vacaciones($salario_base_empleado_real,$emp) + $this->prima($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]);
				
				$subtotal_seguridad_social = $this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year[0]) + $this->salud($salario_base_empleado_real,$emp,$year[0]) + $this->pension($salario_base_empleado_real,$emp,$year[0]);
				
				$subtotal_aporte_parafiscales = $this->caja_compensacion($salario_base_empleado_real,$emp,$year[0]) + $this->icbf($salario_base_empleado_real,$emp,$year[0]) +
				$this->sena($salario_base_empleado_real,$emp,$year[0]);
				
				$total_todo = $subtotal_prestaciones_sociales + $total_a_pagar + $subtotal_seguridad_social + $subtotal_aporte_parafiscales;
				
				$total_total = $this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year[0]) + $total_todo;
				
				$sqql = mysql_query("select e.documento_empleado from empleado e where e.cargo_empleado like '%PASANT%' and e.documento_empleado = '$e_documento'");
				if(mysql_num_rows($sqql) == 0){
					$total_deducciones_del_trabajador = $bonos + $neto_recibir_trabajador;
					$total_total = $this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year[0]) + $total_todo;
				}else{
					$xsql = mysql_query("select otros from tablas_empleados where cedula = '$e_documento'");
					while($ro = mysql_fetch_array($xsql)){
						$total_deducciones_del_trabajador = $ro['otros'];
						$total_total = $this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year[0]) + $ro['otros'];
					}
				}
				
				$tabla .= "
					<thead>
						<tr>
							<th colspan = '3' class = 'nombre_empleado_hj' style = 'font-size:1.6em;color:#6B6D6F;' >
							".$row['nombre_empleado']."
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Salario Base</td>
							<td   align = 'center' id  ='editar_dias'><span id = 'dias_sb' ondblclick = 'cammbiar_dias_trabajo_empleado($id)'>".$row['dias']."</span></td>
							<td>
								<table width = '100%'  class = 'sin_color'>
									<tr >
										<td  align = 'left'>$</td>
										<td align = 'right' ondblclick = 'editar_sb($id)' id = 'sb_campo'>
											<span id = 'sb_empleado' >".number_format($salario_base_empleado_real)."</span><span id = 'sb_empleado_h' class = 'hidde'>".$salario_base_empleado_real."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>Otros</td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr >
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'otros_emp'>".number_format($row['otros'])."</span><span id = 'otros_emp_h' class = 'hidde'>".$row['otros']."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>Bonos Alimentación</td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr >
										<td  align = 'left' >$</td>
										<td align = 'right' id = 'bono_al_sim' ondblclick = 'editar_bonos_empleado($id)' >
											<span id = 'b_alimentacion_emp'>".number_format($row['balimentacion'])."</span><span id = 'b_alimentacion_emp_h' class = 'hidde'>".$row['balimentacion']."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>Beneficio No Prestacional</td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'b_np_emp'>".number_format($beneficio_no_prestacional)."</span><span id = 'b_np_emp_h' class = 'hidde'>".$beneficio_no_prestacional."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td><strong>Salario Base</strong></td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'salario_base_final' class = 'bold'>".number_format($salario_base_1)."</span><span id = 'salario_base_final_h' class = 'hidde'>".$salario_base_1."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>Auxilio de Transporte</td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'aux_transporte_emp'>".number_format($this->aux_transporte($salario_base_empleado_real,$emp,$year[0]))."</span><span id = 'aux_transporte_emp_h' class = 'hidde'>".$this->aux_transporte($salario_base_empleado_real,$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td><strong>Total a Pagar</strong></td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'total_a_pagar' class = 'bold' >".number_format($total_a_pagar)."</span><span id = 'total_a_pagar_h' class = 'hidde'>".$total_a_pagar."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td><strong>BASE PARA SEGURIDAD SOCIAL</strong></td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'base_para_seguridad_social'>".number_format($this->base_seguridad_social($salario_base_empleado_real,$emp))."</span><span id = 'base_para_seguridad_social_h' class = 'hidde'>".$this->base_seguridad_social($salario_base_empleado_real,$emp)."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td><strong>BASE PARA VACACIONES</strong></td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'base_para_vacaciones'>".number_format($salario_base_empleado_real)."</span><span id = 'base_para_vacaciones_h' class = 'hidde'>".$salario_base_empleado_real."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<th onclick = 'ocultar_prestaciones_sociales()'colspan ='3' style = 'background-color:#FA9F1F;color:white;padding-top:5px;'>
								<table width = '100%' class = 'titulos_cuadros'>
									<tr>
										<th width = '98%' style = 'padding:15px;font-size:1em;'>PRESTACIONES SOCIALES</th>
										<th id = 'triangulo_pshj_nd' align = 'center'>
											<div class = 'triangulo_inf' ></div>
										</th>
									</tr>
								</table>
							</th>
						</tr>
						<tr class = 'op_prestaciones_sociales' style = 'display:none;'>
							<td>Cesantías</td>
							<td align = 'center' >".$this->por_cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0])."%</td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'cesantias'>".number_format($this->cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]))."</span><span id = 'cesantias_h' class = 'hidde'>".$this->cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_prestaciones_sociales'  style = 'display:none;'>
							<td>Intereses Cesantías</td>
							<td align = 'center'>".$this->por_int_cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0])."%</td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'int_cesantias'>".number_format($this->int_cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]))."</span><span id = 'int_cesantias_h' class = 'hidde'>".$this->int_cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_prestaciones_sociales'  style = 'display:none;'>
							<td >Prima de Servicios</td>
							<td align = 'center'><span>".$this->por_prima($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0])."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'prima'>".number_format($this->prima($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]))."</span><span id = 'prima_h' class = 'hidde'>".$this->prima($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_prestaciones_sociales'  style = 'display:none;'>
							<td >Vacaciones</td>
							<td align = 'center'><span>".$this->por_vacaciones($salario_base_empleado_real)."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'vacaciones'>".number_format($this->vacaciones($salario_base_empleado_real,$emp))."</span><span id = 'vacaciones_h' class = 'hidde'>".$this->vacaciones($salario_base_empleado_real,$emp)."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td ><strong>SUBTOTAL PRESTACIONES SOCIALES</strong></td>
							<td align  ='center'><strong>".$this->por_total_prestaciones_sociales($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0])."%</strong></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' style = 'font-weight:bold;'>
											<span id = 'subtotal_ps'>".number_format($subtotal_prestaciones_sociales)."</span><span id = 'subtotal_ps_h' class = 'hidde'>".$subtotal_prestaciones_sociales."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						
						<tr>
							<th onclick = 'ocultar_seguridad_social()'colspan ='3' align = 'center' style = 'background-color:#FA9F1F;color:white;padding-top:5px;'>
								<table width = '100%' class = 'titulos_cuadros'>
									<tr>
										<th width = '98%' style = 'padding:15px;font-size:1em;'>SEGURIDAD SOCIAL</th>
										<th id = 'triangulo_sshj_nd' align = 'center'>
											<div class = 'triangulo_inf' ></div>
										</th>
									</tr>
								</table>
							</th>
						</tr>
						<tr class = 'op_seguridad_social'  style = 'display:none;'>
							<td >Pesion</td>
							<td  align = 'center'><span>12%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'pension_ss'>".number_format($this->pension($salario_base_empleado_real,$emp))."</span><span id = 'pension_ss_h' class = 'hidde'>".$this->pension($salario_base_empleado_real,$emp)."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_seguridad_social'  style = 'display:none;'>
							<td >Salud</td>
							<td  align = 'center'><span>".$this->por_salud($salario_base_empleado_real,$emp,$year[0])."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'salud_ss'>".number_format($this->salud($salario_base_empleado_real,$emp,$year[0]))."</span><span id = 'salud_ss_h' class = 'hidde'>".$this->salud($salario_base_empleado_real,$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_seguridad_social' style = 'display:none;'>
							<td >ARL</td>
							<td  align = 'center'><span>".$this->por_arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$periodo)."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'arl'>".number_format($this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year[0]))."</span><span id = 'arl_h' class = 'hidde'>".$this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr >
							<td ><strong>SUBTOTAL SEGURIDAD SOCIAL</strong></td>
							<td  align = 'center' ><strong>".$this->por_total_seguridad_social($salario_base_empleado_real,$emp,$periodo,$row['documento_empleado'],$year[0])."%</strong></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' style = 'font-weight:bold;'>
											<span id = 'subtotal_ps'>".number_format($subtotal_seguridad_social)."</span><span id = 'subtotal_ps_h' class = 'hidde'>".$subtotal_seguridad_social."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						
						<tr>
							<th onclick = 'ocultar_aportes_parafiscales()'colspan ='3' align = 'center' style = 'background-color:#FA9F1F;color:white;padding-top:5px;'>
								<table width = '100%' class = 'titulos_cuadros'>
									<tr>
										<th width = '98%' style = 'padding:15px;font-size:1em;'>APORTES PARAFISCALES</th>
										<th id = 'triangulo_apshj_nd' align = 'center'>
											<div class = 'triangulo_inf' ></div>
										</th>
									</tr>
								</table>
							</th>
						</tr>
						<tr class = 'op_aportes_parafiscales' style = 'display:none;'>
							<td >Caja de Compensación</td>
							<td  align = 'center'><span>".$this->por_caja_compensacion($salario_base_empleado_real,$emp,$year[0])."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'caja_compensacion'>".number_format($this->caja_compensacion($salario_base_empleado_real,$emp,$year[0]))."</span><span id = 'caja_compensacion_h' class = 'hidde'>".$this->caja_compensacion($salario_base_empleado_real,$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_aportes_parafiscales' style = 'display:none;'>
							<td >ICBF</td>
							<td  align = 'center'><span>".$this->por_icbf($salario_base_empleado_real,$emp,$year[0])."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'icbf'>".number_format($this->icbf($salario_base_empleado_real,$emp,$year[0]))."</span><span id = 'icbf_h' class = 'hidde'>".$this->icbf($salario_base_empleado_real,$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_aportes_parafiscales' style = 'display:none;'>
							<td >Sena</td>
							<td align = 'center'><span>".$this->por_sena($salario_base_empleado_real,$emp,$year[0])."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'sena'>".number_format($this->sena($salario_base_empleado_real,$emp,$year[0]))."</span><span id = 'sena_h' class = 'hidde'>".$this->sena($salario_base_empleado_real,$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td ><strong>SUBTOTAL APORTES PARAFISCALES</strong></td>
							<td align = 'center'><strong><span>".$this->por_total_aportes_parafiscales($salario_base_empleado_real,$emp,$year[0])."%</span></strong></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' style = 'font-weight:bold;'>
											<strong><span id = 'subtotal_ap'>".number_format($subtotal_aporte_parafiscales)."</span><span id = 'subtotal_ap_h' class = 'hidde'>".$subtotal_aporte_parafiscales."</span></strong>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						
						<tr>
							<th onclick = 'ocultar_deducciones()'colspan ='3' align = 'center' style = 'background-color:#FA9F1F;color:white;padding-top:5px;'>
								<table width = '100%' class = 'titulos_cuadros'>
									<tr>
										<th width = '98%' style = 'padding:15px;font-size:1em;'>DEDUCCIONES TRABAJADOR</th>
										<th id = 'triangulo_ddshj_nd' align = 'center'>
											<div class = 'triangulo_inf' ></div>
										</th>
									</tr>
								</table>
							</th>
						</tr>
						<tr class = 'op_deducciones'  style = 'display:none;'>
							<td>Salud</td>
							<td align = 'center'>".$this->por_aporte_salud($salario_base_empleado_real,$emp,$year[0])."%</td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'salud_empleado'>".number_format($this->aporte_salud($salario_base_empleado_real,$emp,$year[0]))."</span><span id = 'salud_empleado_h' class = 'hidde'>".$this->aporte_salud($salario_base_empleado_real,$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones'  style = 'display:none;'>
							<td>Pensión</td>
							<td align = 'center'>".$this->por_pension_deducciones($salario_base_empleado_real,$emp,$year[0])."%</td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'pension_empleado'>".number_format($this->pension_deducciones($salario_base_empleado_real,$emp,$year[0]))."</span><span id = 'pension_empleado_h' class = 'hidde'>".$this->pension_deducciones($row['salario_base'],$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones'  style = 'display:none;'>
							<td>Fondo de Solidaridad Pensional</td>
							<td align = 'center'>".$this->por_fondo_solidaridad_pensional($salario_base_empleado_real,$emp,$year[0])."%</td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'fondo_solidaridad_pensional_empleado'>".number_format($this->fondo_solidaridad_pensional($salario_base_empleado_real,$emp,$year[0]))."</span><span id = 'fondo_solidaridad_pensional_empleado_h' class = 'hidde'>".$this->fondo_solidaridad_pensional($salario_base_empleado_real,$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td>Rte Fte</td>
							<td align = 'center'>4%</td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'rte_fte' ondblclick = 'editar_rte_empleado($id)'>".number_format($row['rte'])."</span><span id = 'rte_fte_h' class = 'hidde'>".$row['rte']."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td>AFC</td>
							<td></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span ondblclick = 'editar_afc_empleado($id)' id = 'afc'>".number_format($row['afc'])."</span><span id = 'afc_h' class = 'hidde'>".$row['afc']."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td><strong>Total Aportes Empleado</strong></td>
							<td></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'total_aportes_empleado' >".number_format($total_aportes_empleado)."</span><span id = 'total_aportes_empleado_h' class = 'hidde'>".$total_aportes_empleado."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td><strong>Neto a recibir trabajador dinero</strong></td>
							<td></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' class = 'bold'>
											<span id = 'neto_empleado'>".number_format($neto_recibir_trabajador)."</span><span id = 'neto_empleado_h' class = 'hidde'>".$neto_recibir_trabajador."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td><strong>Bonos</strong></td>
							<td></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'bonos'>".number_format($bonos)."</span><span id = 'bonos_h' class ='hidde'>".$bonos."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td><strong>Total</strong></td>
							<td></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' class ='bold'>
											<span id = 'total_deducciones_trabajador'>".number_format($total_deducciones_del_trabajador)."</span><span id = 'total_deducciones_trabajador_h' class = 'hidde'>".$total_deducciones_del_trabajador."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td ><strong>SUBTOTAL SALARIO</strong></td>
							<td ><span></span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong><span id = 'subtotal_salario_final'>".number_format($total_a_pagar)."</span></strong><span id = 'subtotal_ap_h' class = 'hidde'>".$total_a_pagar."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td ><strong>SUBTOTAL DE PRESTACIONES LEGALES</strong></td>
							<td ><span></span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong><span id = 'subtotal_prestaciones_sociales'>".number_format($subtotal_prestaciones_sociales)."</span></strong><span id = 'subtotal_prestaciones_sociales_h' class = 'hidde'>".$subtotal_prestaciones_sociales."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td ><strong>SUBTOTAL DE SEGURIDAD SOCIAL</strong></td>
							<td ><span></span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong><span id = 'subtotal_seguridad_social'>".number_format($subtotal_seguridad_social)."</span></strong><span id = 'subtotal_seguridad_social_h' class = 'hidde'>".$subtotal_seguridad_social."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td ><strong>SUBTOTAL DE APORTES PARAFISCALES</strong></td>
							<td ><span></span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong><span id = 'subtotal_aportes_parafiscales'>".number_format($subtotal_aporte_parafiscales)."</span></strong><span id = 'subtotal_aportes_parafiscales_h' class = 'hidde'>".$subtotal_aporte_parafiscales."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan = '2'><strong>SUBTOTAL</strong></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong><span id = 'total'>".number_format($total_todo)."</span></strong><span id = 'total_h' class = 'hidde'>".$total_todo."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr >
							<td colspan = '2'><strong>INDEMNIZACION</strong></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong><span id = 'indemnizacion'>".number_format($this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year))."</span></strong><span id = 'indemnizacion_h' class = 'hidde'>".$this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year)."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan = '2'><strong>TOTAL COSTO COMPAÑÍA</strong></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong><span id = 'total_total'>".number_format($total_total)."</span></strong><span id = 'total_total_h' class = 'hidde'>".$total_total."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td ><strong>TOTAL RECIBIDO</strong></td>
							<td ></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong><span id = 'total_recibido'>".number_format($total_deducciones_del_trabajador)."</span><span id = 'total_recibido_h' class = 'hidde'>".$total_deducciones_del_trabajador."</span></STRONG>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>";
			}
			return $tabla."</table>";
		}
	
		public function planilla($cedula,$periodo,$emp){
			$year = explode("-",$periodo);
			$tabla = "<table class ='tablas_muestra_datos_tablas' width = '100%' >";
			$sel = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = '$cedula' and e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.empresa = '$emp'");
			while($row = mysql_fetch_array($sel)){
				$e_documento = $row['documento_empleado'];
				$salario_base_empleado_real = (($row['salario_base'])/30)*$row['dias'];
				
				$beneficio_no_prestacional = ($row['bnp']/30)*$row['dias'];
				
				$salario_base_1 = $salario_base_empleado_real + $beneficio_no_prestacional+ $row['balimentacion'];
				
				$total_aportes_empleado = $this->aporte_salud($salario_base_empleado_real,$emp,$year[0]) + $this->pension_deducciones($salario_base_empleado_real,$emp,$year[0]) + $this->fondo_solidaridad_pensional($salario_base_empleado_real,$emp,$year[0]) + $row['rte'] + $row['afc'];
				
				$id = $row['id'];
				
				$total_a_pagar = $salario_base_1 + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]);
				
				$neto_recibir_trabajador = ($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0])) - $total_aportes_empleado;
				
				$bonos = $row['bnp'] + $row['balimentacion'];
				
				$total_deducciones_del_trabajador = 0;
				$total_total = 0;
						
				$subtotal_prestaciones_sociales = $this->cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]) + $this->int_cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]) +
				$this->vacaciones($salario_base_empleado_real,$emp) + $this->prima($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]);
				
				$subtotal_seguridad_social = $this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year[0]) + $this->salud($salario_base_empleado_real,$emp,$year[0]) + $this->pension($salario_base_empleado_real,$emp,$year[0]);
				
				$subtotal_aporte_parafiscales = $this->caja_compensacion($salario_base_empleado_real,$emp,$year[0]) + $this->icbf($salario_base_empleado_real,$emp,$year[0]) +
				$this->sena($salario_base_empleado_real,$emp,$year[0]);
				
				$total_todo = $subtotal_prestaciones_sociales + $total_a_pagar + $subtotal_seguridad_social + $subtotal_aporte_parafiscales;
				
				$total_total = $this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year[0]) + $total_todo;
				
				$sqql = mysql_query("select e.documento_empleado from empleado e where e.cargo_empleado like '%PASANT%' and e.documento_empleado = '$e_documento'");
				if(mysql_num_rows($sqql) == 0){
					$total_deducciones_del_trabajador = $bonos + $neto_recibir_trabajador;
					$total_total = $this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year[0]) + $total_todo;
				}else{
					$xsql = mysql_query("select otros from tablas_empleados where cedula = '$e_documento'");
					while($ro = mysql_fetch_array($xsql)){
						$total_deducciones_del_trabajador = $ro['otros'];
						$total_total = $this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year[0]) + $ro['otros'];
					}
				}
				return $subtotal_seguridad_social + $subtotal_aporte_parafiscales + $this->pension_deducciones($salario_base_empleado_real,$emp,$year[0]) + $this->aporte_salud($salario_base_empleado_real,$emp,$year[0]);
			}
			
		}
	
		public function provisiones($cedula,$periodo,$emp){
			$year = explode("-",$periodo);
			$tabla = "<table class ='tablas_muestra_datos_tablas' width = '100%' >";
			$sel = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = '$cedula' and e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.empresa = '$emp'");
			while($row = mysql_fetch_array($sel)){
				$e_documento = $row['documento_empleado'];
				$salario_base_empleado_real = (($row['salario_base'])/30)*$row['dias'];
				
				$beneficio_no_prestacional = ($row['bnp']/30)*$row['dias'];
				
				$salario_base_1 = $salario_base_empleado_real + $beneficio_no_prestacional+ $row['balimentacion'];
				
				$total_aportes_empleado = $this->aporte_salud($salario_base_empleado_real,$emp,$year[0]) + $this->pension_deducciones($salario_base_empleado_real,$emp,$year[0]) + $this->fondo_solidaridad_pensional($salario_base_empleado_real,$emp,$year[0]) + $row['rte'] + $row['afc'];
				
				$id = $row['id'];
				
				$total_a_pagar = $salario_base_1 + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]);
				
				$neto_recibir_trabajador = ($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0])) - $total_aportes_empleado;
				
				$bonos = $row['bnp'] + $row['balimentacion'];
				
				$total_deducciones_del_trabajador = 0;
				$total_total = 0;
						
				$subtotal_prestaciones_sociales = $this->cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]) + $this->int_cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]) +
				$this->vacaciones($salario_base_empleado_real,$emp) + $this->prima($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]);
				
				$subtotal_seguridad_social = $this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year[0]) + $this->salud($salario_base_empleado_real,$emp,$year[0]) + $this->pension($salario_base_empleado_real,$emp,$year[0]);
				
				$subtotal_aporte_parafiscales = $this->caja_compensacion($salario_base_empleado_real,$emp,$year[0]) + $this->icbf($salario_base_empleado_real,$emp,$year[0]) +
				$this->sena($salario_base_empleado_real,$emp,$year[0]);
				
				$total_todo = $subtotal_prestaciones_sociales + $total_a_pagar + $subtotal_seguridad_social + $subtotal_aporte_parafiscales;
				
				$total_total = $this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year[0]) + $total_todo;
				
				$sqql = mysql_query("select e.documento_empleado from empleado e where e.cargo_empleado like '%PASANT%' and e.documento_empleado = '$e_documento'");
				if(mysql_num_rows($sqql) == 0){
					$total_deducciones_del_trabajador = $bonos + $neto_recibir_trabajador;
					$total_total = $this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year[0]) + $total_todo;
				}else{
					$xsql = mysql_query("select otros from tablas_empleados where cedula = '$e_documento'");
					while($ro = mysql_fetch_array($xsql)){
						$total_deducciones_del_trabajador = $ro['otros'];
						$total_total = $this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year[0]) + $ro['otros'];
					}
				}
				return $subtotal_prestaciones_sociales  + $this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year[0]);
			}
			
		}
	
	
		public function beneficio_np($cedula,$periodo,$emp){
			$year = explode("-",$periodo);
			$tabla = "<table class ='tablas_muestra_datos_tablas' width = '100%' >";
			$sel = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = '$cedula' and e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.empresa = '$emp'");
			while($row = mysql_fetch_array($sel)){
				return $row['bnp'];
			}
			
		}
	
		
		public function costo_total_empleado_compania($cedula,$periodo,$emp){
			$year = explode("-",$periodo);
			$tabla = "<table class ='tablas_muestra_datos_tablas' width = '100%' >";
			$sel = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = '$cedula' and e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.empresa = '$emp'");
			while($row = mysql_fetch_array($sel)){
				$e_documento = $row['documento_empleado'];
				$salario_base_empleado_real = (($row['salario_base'])/30)*$row['dias'];
				
				$beneficio_no_prestacional = ($row['bnp']/30)*$row['dias'];
				
				$salario_base_1 = $salario_base_empleado_real + $beneficio_no_prestacional+ $row['balimentacion'];
				
				$total_aportes_empleado = $this->aporte_salud($salario_base_empleado_real,$emp,$year[0]) + $this->pension_deducciones($salario_base_empleado_real,$emp,$year[0]) + $this->fondo_solidaridad_pensional($salario_base_empleado_real,$emp,$year[0]) + $row['rte'] + $row['afc'];
				
				$id = $row['id'];
				
				$total_a_pagar = $salario_base_1 + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]);
				
				$neto_recibir_trabajador = ($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0])) - $total_aportes_empleado;
				
				$bonos = $row['bnp'] + $row['balimentacion'];
				
				$total_deducciones_del_trabajador = 0;
				$total_total = 0;
						
				$subtotal_prestaciones_sociales = $this->cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]) + $this->int_cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]) +
				$this->vacaciones($salario_base_empleado_real,$emp) + $this->prima($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]);
				
				$subtotal_seguridad_social = $this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year[0]) + $this->salud($salario_base_empleado_real,$emp,$year[0]) + $this->pension($salario_base_empleado_real,$emp,$year[0]);
				
				$subtotal_aporte_parafiscales = $this->caja_compensacion($salario_base_empleado_real,$emp,$year[0]) + $this->icbf($salario_base_empleado_real,$emp,$year[0]) +
				$this->sena($salario_base_empleado_real,$emp,$year[0]);
				
				$total_todo = $subtotal_prestaciones_sociales + $total_a_pagar + $subtotal_seguridad_social + $subtotal_aporte_parafiscales;
				
				$total_total = $this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year[0]) + $total_todo;
				
				$sqql = mysql_query("select e.documento_empleado from empleado e where e.cargo_empleado like '%PASANT%' and e.documento_empleado = '$e_documento'");
				if(mysql_num_rows($sqql) == 0){
					$total_deducciones_del_trabajador = $bonos + $neto_recibir_trabajador;
					$total_total = $this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year[0]) + $total_todo;
				}else{
					$xsql = mysql_query("select otros from tablas_empleados where cedula = '$e_documento'");
					while($ro = mysql_fetch_array($xsql)){
						$total_deducciones_del_trabajador = $ro['otros'];
						$total_total = $this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year[0]) + $ro['otros'];
					}
				}
				
				$tabla .= "
					<thead>
						<tr>
							<th colspan = '3' class = 'nombre_empleado_hj' style = 'font-size:1.6em;color:#6B6D6F;' >
							".$row['nombre_empleado']."
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Salario Base</td>
							<td   align = 'center' id  ='editar_dias'><span id = 'dias_sb' ondblclick = 'cammbiar_dias_trabajo_empleado($id)'>".$row['dias']."</span></td>
							<td>
								<table width = '100%'  class = 'sin_color'>
									<tr >
										<td  align = 'left'>$</td>
										<td align = 'right' ondblclick = 'editar_sb($id)' id = 'sb_campo'>
											<span id = 'sb_empleado' >".number_format($salario_base_empleado_real)."</span><span id = 'sb_empleado_h' class = 'hidde'>".$salario_base_empleado_real."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>Otros</td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr >
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'otros_emp'>".number_format($row['otros'])."</span><span id = 'otros_emp_h' class = 'hidde'>".$row['otros']."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>Bonos Alimentación</td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr >
										<td  align = 'left' >$</td>
										<td align = 'right' id = 'bono_al_sim' ondblclick = 'editar_bonos_empleado($id)' >
											<span id = 'b_alimentacion_emp'>".number_format($row['balimentacion'])."</span><span id = 'b_alimentacion_emp_h' class = 'hidde'>".$row['balimentacion']."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>Beneficio No Prestacional</td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'b_np_emp'>".number_format($beneficio_no_prestacional)."</span><span id = 'b_np_emp_h' class = 'hidde'>".$beneficio_no_prestacional."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td><strong>Salario Base</strong></td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'salario_base_final' class = 'bold'>".number_format($salario_base_1)."</span><span id = 'salario_base_final_h' class = 'hidde'>".$salario_base_1."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>Auxilio de Transporte</td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'aux_transporte_emp'>".number_format($this->aux_transporte($salario_base_empleado_real,$emp,$year[0]))."</span><span id = 'aux_transporte_emp_h' class = 'hidde'>".$this->aux_transporte($salario_base_empleado_real,$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td><strong>Total a Pagar</strong></td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'total_a_pagar' class = 'bold' >".number_format($total_a_pagar)."</span><span id = 'total_a_pagar_h' class = 'hidde'>".$total_a_pagar."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td><strong>BASE PARA SEGURIDAD SOCIAL</strong></td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'base_para_seguridad_social'>".number_format($this->base_seguridad_social($salario_base_empleado_real,$emp))."</span><span id = 'base_para_seguridad_social_h' class = 'hidde'>".$this->base_seguridad_social($salario_base_empleado_real,$emp)."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td><strong>BASE PARA VACACIONES</strong></td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'base_para_vacaciones'>".number_format($salario_base_empleado_real)."</span><span id = 'base_para_vacaciones_h' class = 'hidde'>".$salario_base_empleado_real."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<th onclick = 'ocultar_prestaciones_sociales()'colspan ='3' style = 'background-color:#FA9F1F;color:white;padding-top:5px;'>
								<table width = '100%' class = 'titulos_cuadros'>
									<tr>
										<th width = '98%' style = 'padding:15px;font-size:1em;'>PRESTACIONES SOCIALES</th>
										<th id = 'triangulo_pshj_nd' align = 'center'>
											<div class = 'triangulo_inf' ></div>
										</th>
									</tr>
								</table>
							</th>
						</tr>
						<tr class = 'op_prestaciones_sociales' style = 'display:none;'>
							<td>Cesantías</td>
							<td align = 'center' >".$this->por_cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0])."%</td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'cesantias'>".number_format($this->cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]))."</span><span id = 'cesantias_h' class = 'hidde'>".$this->cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_prestaciones_sociales'  style = 'display:none;'>
							<td>Intereses Cesantías</td>
							<td align = 'center'>".$this->por_int_cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0])."%</td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'int_cesantias'>".number_format($this->int_cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]))."</span><span id = 'int_cesantias_h' class = 'hidde'>".$this->int_cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_prestaciones_sociales'  style = 'display:none;'>
							<td >Prima de Servicios</td>
							<td align = 'center'><span>".$this->por_prima($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0])."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'prima'>".number_format($this->prima($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]))."</span><span id = 'prima_h' class = 'hidde'>".$this->prima($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_prestaciones_sociales'  style = 'display:none;'>
							<td >Vacaciones</td>
							<td align = 'center'><span>".$this->por_vacaciones($salario_base_empleado_real)."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'vacaciones'>".number_format($this->vacaciones($salario_base_empleado_real,$emp))."</span><span id = 'vacaciones_h' class = 'hidde'>".$this->vacaciones($salario_base_empleado_real,$emp)."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td ><strong>SUBTOTAL PRESTACIONES SOCIALES</strong></td>
							<td align  ='center'><strong>".$this->por_total_prestaciones_sociales($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0])."%</strong></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' style = 'font-weight:bold;'>
											<span id = 'subtotal_ps'>".number_format($subtotal_prestaciones_sociales)."</span><span id = 'subtotal_ps_h' class = 'hidde'>".$subtotal_prestaciones_sociales."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						
						<tr>
							<th onclick = 'ocultar_seguridad_social()'colspan ='3' align = 'center' style = 'background-color:#FA9F1F;color:white;padding-top:5px;'>
								<table width = '100%' class = 'titulos_cuadros'>
									<tr>
										<th width = '98%' style = 'padding:15px;font-size:1em;'>SEGURIDAD SOCIAL</th>
										<th id = 'triangulo_sshj_nd' align = 'center'>
											<div class = 'triangulo_inf' ></div>
										</th>
									</tr>
								</table>
							</th>
						</tr>
						<tr class = 'op_seguridad_social'  style = 'display:none;'>
							<td >Pesion</td>
							<td  align = 'center'><span>12%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'pension_ss'>".number_format($this->pension($salario_base_empleado_real,$emp))."</span><span id = 'pension_ss_h' class = 'hidde'>".$this->pension($salario_base_empleado_real,$emp)."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_seguridad_social'  style = 'display:none;'>
							<td >Salud</td>
							<td  align = 'center'><span>".$this->por_salud($salario_base_empleado_real,$emp,$year[0])."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'salud_ss'>".number_format($this->salud($salario_base_empleado_real,$emp,$year[0]))."</span><span id = 'salud_ss_h' class = 'hidde'>".$this->salud($salario_base_empleado_real,$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_seguridad_social' style = 'display:none;'>
							<td >ARL</td>
							<td  align = 'center'><span>".$this->por_arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$periodo)."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'arl'>".number_format($this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year[0]))."</span><span id = 'arl_h' class = 'hidde'>".$this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr >
							<td ><strong>SUBTOTAL SEGURIDAD SOCIAL</strong></td>
							<td  align = 'center' ><strong>".$this->por_total_seguridad_social($salario_base_empleado_real,$emp,$periodo,$row['documento_empleado'],$year[0])."%</strong></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' style = 'font-weight:bold;'>
											<span id = 'subtotal_ps'>".number_format($subtotal_seguridad_social)."</span><span id = 'subtotal_ps_h' class = 'hidde'>".$subtotal_seguridad_social."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						
						<tr>
							<th onclick = 'ocultar_aportes_parafiscales()'colspan ='3' align = 'center' style = 'background-color:#FA9F1F;color:white;padding-top:5px;'>
								<table width = '100%' class = 'titulos_cuadros'>
									<tr>
										<th width = '98%' style = 'padding:15px;font-size:1em;'>APORTES PARAFISCALES</th>
										<th id = 'triangulo_apshj_nd' align = 'center'>
											<div class = 'triangulo_inf' ></div>
										</th>
									</tr>
								</table>
							</th>
						</tr>
						<tr class = 'op_aportes_parafiscales' style = 'display:none;'>
							<td >Caja de Compensación</td>
							<td  align = 'center'><span>".$this->por_caja_compensacion($salario_base_empleado_real,$emp,$year[0])."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'caja_compensacion'>".number_format($this->caja_compensacion($salario_base_empleado_real,$emp,$year[0]))."</span><span id = 'caja_compensacion_h' class = 'hidde'>".$this->caja_compensacion($salario_base_empleado_real,$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_aportes_parafiscales' style = 'display:none;'>
							<td >ICBF</td>
							<td  align = 'center'><span>".$this->por_icbf($salario_base_empleado_real,$emp,$year[0])."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'icbf'>".number_format($this->icbf($salario_base_empleado_real,$emp,$year[0]))."</span><span id = 'icbf_h' class = 'hidde'>".$this->icbf($salario_base_empleado_real,$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_aportes_parafiscales' style = 'display:none;'>
							<td >Sena</td>
							<td align = 'center'><span>".$this->por_sena($salario_base_empleado_real,$emp,$year[0])."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'sena'>".number_format($this->sena($salario_base_empleado_real,$emp,$year[0]))."</span><span id = 'sena_h' class = 'hidde'>".$this->sena($salario_base_empleado_real,$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td ><strong>SUBTOTAL APORTES PARAFISCALES</strong></td>
							<td align = 'center'><strong><span>".$this->por_total_aportes_parafiscales($salario_base_empleado_real,$emp,$year[0])."%</span></strong></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' style = 'font-weight:bold;'>
											<strong><span id = 'subtotal_ap'>".number_format($subtotal_aporte_parafiscales)."</span><span id = 'subtotal_ap_h' class = 'hidde'>".$subtotal_aporte_parafiscales."</span></strong>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						
						<tr>
							<th onclick = 'ocultar_deducciones()'colspan ='3' align = 'center' style = 'background-color:#FA9F1F;color:white;padding-top:5px;'>
								<table width = '100%' class = 'titulos_cuadros'>
									<tr>
										<th width = '98%' style = 'padding:15px;font-size:1em;'>DEDUCCIONES TRABAJADOR</th>
										<th id = 'triangulo_ddshj_nd' align = 'center'>
											<div class = 'triangulo_inf' ></div>
										</th>
									</tr>
								</table>
							</th>
						</tr>
						<tr class = 'op_deducciones'  style = 'display:none;'>
							<td>Salud</td>
							<td align = 'center'>".$this->por_aporte_salud($salario_base_empleado_real,$emp,$year[0])."%</td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'salud_empleado'>".number_format($this->aporte_salud($salario_base_empleado_real,$emp,$year[0]))."</span><span id = 'salud_empleado_h' class = 'hidde'>".$this->aporte_salud($salario_base_empleado_real,$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones'  style = 'display:none;'>
							<td>Pensión</td>
							<td align = 'center'>".$this->por_pension_deducciones($salario_base_empleado_real,$emp,$year[0])."%</td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'pension_empleado'>".number_format($this->pension_deducciones($salario_base_empleado_real,$emp,$year[0]))."</span><span id = 'pension_empleado_h' class = 'hidde'>".$this->pension_deducciones($row['salario_base'],$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones'  style = 'display:none;'>
							<td>Fondo de Solidaridad Pensional</td>
							<td align = 'center'>".$this->por_fondo_solidaridad_pensional($salario_base_empleado_real,$emp,$year[0])."%</td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'fondo_solidaridad_pensional_empleado'>".number_format($this->fondo_solidaridad_pensional($salario_base_empleado_real,$emp,$year[0]))."</span><span id = 'fondo_solidaridad_pensional_empleado_h' class = 'hidde'>".$this->fondo_solidaridad_pensional($salario_base_empleado_real,$emp,$year[0])."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td>Rte Fte</td>
							<td align = 'center'>4%</td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'rte_fte' ondblclick = 'editar_rte_empleado($id)'>".number_format($row['rte'])."</span><span id = 'rte_fte_h' class = 'hidde'>".$row['rte']."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td>AFC</td>
							<td></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span ondblclick = 'editar_afc_empleado($id)' id = 'afc'>".number_format($row['afc'])."</span><span id = 'afc_h' class = 'hidde'>".$row['afc']."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td><strong>Total Aportes Empleado</strong></td>
							<td></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'total_aportes_empleado' >".number_format($total_aportes_empleado)."</span><span id = 'total_aportes_empleado_h' class = 'hidde'>".$total_aportes_empleado."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td><strong>Neto a recibir trabajador dinero</strong></td>
							<td></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' class = 'bold'>
											<span id = 'neto_empleado'>".number_format($neto_recibir_trabajador)."</span><span id = 'neto_empleado_h' class = 'hidde'>".$neto_recibir_trabajador."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td><strong>Bonos</strong></td>
							<td></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span id = 'bonos'>".number_format($bonos)."</span><span id = 'bonos_h' class ='hidde'>".$bonos."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td><strong>Total</strong></td>
							<td></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' class ='bold'>
											<span id = 'total_deducciones_trabajador'>".number_format($total_deducciones_del_trabajador)."</span><span id = 'total_deducciones_trabajador_h' class = 'hidde'>".$total_deducciones_del_trabajador."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td ><strong>SUBTOTAL SALARIO</strong></td>
							<td ><span></span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong><span id = 'subtotal_salario_final'>".number_format($total_a_pagar)."</span></strong><span id = 'subtotal_ap_h' class = 'hidde'>".$total_a_pagar."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td ><strong>SUBTOTAL DE PRESTACIONES LEGALES</strong></td>
							<td ><span></span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong><span id = 'subtotal_prestaciones_sociales'>".number_format($subtotal_prestaciones_sociales)."</span></strong><span id = 'subtotal_prestaciones_sociales_h' class = 'hidde'>".$subtotal_prestaciones_sociales."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td ><strong>SUBTOTAL DE SEGURIDAD SOCIAL</strong></td>
							<td ><span></span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong><span id = 'subtotal_seguridad_social'>".number_format($subtotal_seguridad_social)."</span></strong><span id = 'subtotal_seguridad_social_h' class = 'hidde'>".$subtotal_seguridad_social."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td ><strong>SUBTOTAL DE APORTES PARAFISCALES</strong></td>
							<td ><span></span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong><span id = 'subtotal_aportes_parafiscales'>".number_format($subtotal_aporte_parafiscales)."</span></strong><span id = 'subtotal_aportes_parafiscales_h' class = 'hidde'>".$subtotal_aporte_parafiscales."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan = '2'><strong>SUBTOTAL</strong></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong><span id = 'total'>".number_format($total_todo)."</span></strong><span id = 'total_h' class = 'hidde'>".$total_todo."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr >
							<td colspan = '2'><strong>INDEMNIZACION</strong></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong><span id = 'indemnizacion'>".number_format($this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year))."</span></strong><span id = 'indemnizacion_h' class = 'hidde'>".$this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year)."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan = '2'><strong>TOTAL COSTO COMPAÑÍA</strong></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong><span id = 'total_total'>".number_format($total_total)."</span></strong><span id = 'total_total_h' class = 'hidde'>".$total_total."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td ><strong>TOTAL RECIBIDO</strong></td>
							<td ></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong><span id = 'total_recibido'>".number_format($total_deducciones_del_trabajador)."</span><span id = 'total_recibido_h' class = 'hidde'>".$total_deducciones_del_trabajador."</span></STRONG>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>";
			}
			return $total_total;
		}
	
		public function hoja_vida_empleado2($cedula,$periodo,$emp){
			$year = explode("-",$periodo);
			$tabla = "<table class ='tablas_muestra_datos_tablas' width = '100%' >";
			$sel = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = '$cedula' and e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.empresa = '$emp'");
			while($row = mysql_fetch_array($sel)){
				$e_documento = $row['documento_empleado'];
				$salario_base_empleado_real = (($row['salario_base'])/30)*$row['dias'];
				
				$beneficio_no_prestacional = ($row['bnp']/30)*$row['dias'];
				
				$salario_base_1 = $salario_base_empleado_real + $beneficio_no_prestacional+ $row['balimentacion'];
				
				$total_aportes_empleado = $this->aporte_salud($salario_base_empleado_real,$emp,$year[0]) + $this->pension_deducciones($salario_base_empleado_real,$emp,$year[0]) + $this->fondo_solidaridad_pensional($salario_base_empleado_real,$emp,$year[0]) + $row['rte'] + $row['afc'];
				
				$id = $row['id'];
				
				$total_a_pagar = $salario_base_1 + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]);
				
				$neto_recibir_trabajador = ($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0])) - $total_aportes_empleado;
				
				$bonos = $row['bnp'] + $row['balimentacion'];
				
				$total_deducciones_del_trabajador = 0;
				$total_total = 0;
						
				$subtotal_prestaciones_sociales = $this->cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]) + $this->int_cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]) +
				$this->vacaciones($salario_base_empleado_real,$emp) + $this->prima($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]);
				
				$subtotal_seguridad_social = $this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year[0]) + $this->salud($salario_base_empleado_real,$emp,$year[0]) + $this->pension($salario_base_empleado_real,$emp,$year[0]);
				
				$subtotal_aporte_parafiscales = $this->caja_compensacion($salario_base_empleado_real,$emp,$year[0]) + $this->icbf($salario_base_empleado_real,$emp,$year[0]) +
				$this->sena($salario_base_empleado_real,$emp,$year[0]);
				
				$total_todo = $subtotal_prestaciones_sociales + $total_a_pagar + $subtotal_seguridad_social + $subtotal_aporte_parafiscales;
				
				$total_total = $this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year[0]) + $total_todo;
				
				$sqql = mysql_query("select e.documento_empleado from empleado e where e.cargo_empleado like '%PASANT%' and e.documento_empleado = '$e_documento'");
				if(mysql_num_rows($sqql) == 0){
					$total_deducciones_del_trabajador = $bonos + $neto_recibir_trabajador;
					$total_total = $this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year[0]) + $total_todo;
				}else{
					$xsql = mysql_query("select otros from tablas_empleados where cedula = '$e_documento'");
					while($ro = mysql_fetch_array($xsql)){
						$total_deducciones_del_trabajador = $ro['otros'];
						$total_total = $this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year[0]) + $ro['otros'];
					}
				}
				
				$tabla .= "
					<thead>
						<tr>
							<th colspan = '3' class = 'nombre_empleado_hj' style = 'font-size:1.6em;color:#6B6D6F;' >
							".$row['nombre_empleado']."
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Salario Base</td>
							<td   align = 'center' >".$row['dias']."</td>
							<td>
								<table width = '100%'  class = 'sin_color'>
									<tr >
										<td  align = 'left'>$</td>
										<td align = 'right'>
											".number_format($salario_base_empleado_real)."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>Otros</td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr >
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($row['otros'])."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>Bonos Alimentación</td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr >
										<td  align = 'left' >$</td>
										<td align = 'right'>
											".number_format($row['balimentacion'])."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>Beneficio No Prestacional</td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($beneficio_no_prestacional)."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td><strong>Salario Base</strong></td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span class = 'bold'>".number_format($salario_base_1)."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>Auxilio de Transporte</td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($this->aux_transporte($salario_base_empleado_real,$emp,$year[0]))."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td><strong>Total a Pagar</strong></td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<span class = 'bold' >".number_format($total_a_pagar)."</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td><strong>BASE PARA SEGURIDAD SOCIAL</strong></td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($this->base_seguridad_social($salario_base_empleado_real,$emp))."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td><strong>BASE PARA VACACIONES</strong></td>
							<td></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($salario_base_empleado_real)."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<th onclick = 'ocultar_prestaciones_sociales()'colspan ='3' style = 'background-color:#FA9F1F;color:white;padding-top:5px;'>
								<table width = '100%' class = 'titulos_cuadros'>
									<tr>
										<th width = '98%' style = 'padding:15px;font-size:1em;'>PRESTACIONES SOCIALES</th>
										<th id = 'triangulo_pshj_nd' align = 'center'>
											<div class = 'triangulo_inf' ></div>
										</th>
									</tr>
								</table>
							</th>
						</tr>
						<tr class = 'op_prestaciones_sociales' style = 'display:none;'>
							<td>Cesantías</td>
							<td align = 'center' >".$this->por_cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0])."%</td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($this->cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]))."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_prestaciones_sociales'  style = 'display:none;'>
							<td>Intereses Cesantías</td>
							<td align = 'center'>".$this->por_int_cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0])."%</td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($this->int_cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]))."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_prestaciones_sociales'  style = 'display:none;'>
							<td >Prima de Servicios</td>
							<td align = 'center'><span>".$this->por_prima($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0])."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($this->prima($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0]))."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_prestaciones_sociales'  style = 'display:none;'>
							<td >Vacaciones</td>
							<td align = 'center'><span>".$this->por_vacaciones($salario_base_empleado_real)."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($this->vacaciones($salario_base_empleado_real,$emp))."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td ><strong>SUBTOTAL PRESTACIONES SOCIALES</strong></td>
							<td align  ='center'><strong>".$this->por_total_prestaciones_sociales($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year[0]),$emp,$year[0])."%</strong></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' style = 'font-weight:bold;'>
											".number_format($subtotal_prestaciones_sociales)."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						
						<tr>
							<th onclick = 'ocultar_seguridad_social()'colspan ='3' align = 'center' style = 'background-color:#FA9F1F;color:white;padding-top:5px;'>
								<table width = '100%' class = 'titulos_cuadros'>
									<tr>
										<th width = '98%' style = 'padding:15px;font-size:1em;'>SEGURIDAD SOCIAL</th>
										<th id = 'triangulo_sshj_nd' align = 'center'>
											<div class = 'triangulo_inf' ></div>
										</th>
									</tr>
								</table>
							</th>
						</tr>
						<tr class = 'op_seguridad_social'  style = 'display:none;'>
							<td >Pesion</td>
							<td  align = 'center'><span>12%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($this->pension($salario_base_empleado_real,$emp))."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_seguridad_social'  style = 'display:none;'>
							<td >Salud</td>
							<td  align = 'center'><span>".$this->por_salud($salario_base_empleado_real,$emp,$year[0])."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($this->salud($salario_base_empleado_real,$emp,$year[0]))."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_seguridad_social' style = 'display:none;'>
							<td >ARL</td>
							<td  align = 'center'><span>".$this->por_arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$periodo)."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year[0]))."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr >
							<td ><strong>SUBTOTAL SEGURIDAD SOCIAL</strong></td>
							<td  align = 'center' ><strong>".$this->por_total_seguridad_social($salario_base_empleado_real,$emp,$periodo,$row['documento_empleado'],$year[0])."%</strong></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' style = 'font-weight:bold;'>
											".number_format($subtotal_seguridad_social)."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						
						<tr>
							<th onclick = 'ocultar_aportes_parafiscales()'colspan ='3' align = 'center' style = 'background-color:#FA9F1F;color:white;padding-top:5px;'>
								<table width = '100%' class = 'titulos_cuadros'>
									<tr>
										<th width = '98%' style = 'padding:15px;font-size:1em;'>APORTES PARAFISCALES</th>
										<th id = 'triangulo_apshj_nd' align = 'center'>
											<div class = 'triangulo_inf' ></div>
										</th>
									</tr>
								</table>
							</th>
						</tr>
						<tr class = 'op_aportes_parafiscales' style = 'display:none;'>
							<td >Caja de Compensación</td>
							<td  align = 'center'><span>".$this->por_caja_compensacion($salario_base_empleado_real,$emp,$year[0])."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($this->caja_compensacion($salario_base_empleado_real,$emp,$year[0]))."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_aportes_parafiscales' style = 'display:none;'>
							<td >ICBF</td>
							<td  align = 'center'><span>".$this->por_icbf($salario_base_empleado_real,$emp,$year[0])."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($this->icbf($salario_base_empleado_real,$emp,$year[0]))."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_aportes_parafiscales' style = 'display:none;'>
							<td >Sena</td>
							<td align = 'center'><span>".$this->por_sena($salario_base_empleado_real,$emp,$year[0])."%</span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($this->sena($salario_base_empleado_real,$emp,$year[0]))."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td ><strong>SUBTOTAL APORTES PARAFISCALES</strong></td>
							<td align = 'center'><strong><span>".$this->por_total_aportes_parafiscales($salario_base_empleado_real,$emp,$year[0])."%</span></strong></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' style = 'font-weight:bold;'>
											<strong>".number_format($subtotal_aporte_parafiscales)."</strong>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						
						<tr>
							<th onclick = 'ocultar_deducciones()'colspan ='3' align = 'center' style = 'background-color:#FA9F1F;color:white;padding-top:5px;'>
								<table width = '100%' class = 'titulos_cuadros'>
									<tr>
										<th width = '98%' style = 'padding:15px;font-size:1em;'>DEDUCCIONES TRABAJADOR</th>
										<th id = 'triangulo_ddshj_nd' align = 'center'>
											<div class = 'triangulo_inf' ></div>
										</th>
									</tr>
								</table>
							</th>
						</tr>
						<tr class = 'op_deducciones'  style = 'display:none;'>
							<td>Salud</td>
							<td align = 'center'>".$this->por_aporte_salud($salario_base_empleado_real,$emp,$year[0])."%</td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($this->aporte_salud($salario_base_empleado_real,$emp,$year[0]))."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones'  style = 'display:none;'>
							<td>Pensión</td>
							<td align = 'center'>".$this->por_pension_deducciones($salario_base_empleado_real,$emp,$year[0])."%</td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($this->pension_deducciones($salario_base_empleado_real,$emp,$year[0]))."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones'  style = 'display:none;'>
							<td>Fondo de Solidaridad Pensional</td>
							<td align = 'center'>".$this->por_fondo_solidaridad_pensional($salario_base_empleado_real,$emp,$year[0])."%</td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($this->fondo_solidaridad_pensional($salario_base_empleado_real,$emp,$year[0]))."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td>Rte Fte</td>
							<td align = 'center'>4%</td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($row['rte'])."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td>AFC</td>
							<td></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($row['afc'])."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td><strong>Total Aportes Empleado</strong></td>
							<td></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($total_aportes_empleado)."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td><strong>Neto a recibir trabajador dinero</strong></td>
							<td></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' class = 'bold'>
											".number_format($neto_recibir_trabajador)."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td><strong>Bonos</strong></td>
							<td></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											".number_format($bonos)."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td><strong>Total</strong></td>
							<td></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' class ='bold'>
											".number_format($total_deducciones_del_trabajador)."
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td ><strong>SUBTOTAL SALARIO</strong></td>
							<td ><span></span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong>".number_format($total_a_pagar)."</strong>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td ><strong>SUBTOTAL DE PRESTACIONES LEGALES</strong></td>
							<td ><span></span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong>".number_format($subtotal_prestaciones_sociales)."</strong>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td ><strong>SUBTOTAL DE SEGURIDAD SOCIAL</strong></td>
							<td ><span></span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong>".number_format($subtotal_seguridad_social)."</strong>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr class = 'op_deducciones' style = 'display:none;'>
							<td ><strong>SUBTOTAL DE APORTES PARAFISCALES</strong></td>
							<td ><span></span></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong>".number_format($subtotal_aporte_parafiscales)."</strong>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan = '2'><strong>SUBTOTAL</strong></td>
							<td>
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong>".number_format($total_todo)."</strong>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr >
							<td colspan = '2'><strong>INDEMNIZACION</strong></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong>".number_format($this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year))."</strong>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan = '2'><strong>TOTAL COSTO COMPAÑÍA</strong></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong>".number_format($total_todo + $this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year))."</strong>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td ><strong>TOTAL RECIBIDO</strong></td>
							<td ></td>
							<td >
								<table width = '100%' class = 'sin_color'>
									<tr>
										<td  align = 'left' >$</td>
										<td align = 'right' >
											<strong>".number_format($total_deducciones_del_trabajador)."</STRONG>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>";
			}
			return $tabla."</table>";
		}
	
		public function nomina_detallado($periodo,$emp,$un){
			$gran_acumulado = 0;
			$year_periodo = explode("-",$periodo);
			$sql = "";
			if($un == 'all'){
				$sql = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.empresa = '$emp' ");
			}else{
				$sql = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.empresa = '$emp' and te.und ='$un'");
			}
			
			
			$rowspan = mysql_num_rows($sql)-2;
			//Seguridad Social y demás
			$acum = 0;
			$est = "<table class ='tablas_muestra_datos_tablas' width = '100%' >";
			$est .= "<tr>
						<th width = '30%'  style = 'text-align:left;'>
							<strong>SEGURIDAD SOCIAL</br>Y APORTES PARAFISCALES</strong>
						</th>
						<th id ='tabla_nd_ss' style = 'display:none;'>
							<table width = '100%'>
								<tr>
									<th >NOMBRE</th>
									<th >A PAGAR</th>
								</tr>";
			
			while($row = mysql_fetch_array($sql)){
				$salario_base_empleado_real = ($row['salario_base']/30)*$row['dias'];
				$subtotal_seguridad_social = $this->arl($salario_base_empleado_real,$emp,$row['documento_empleado'],$year_periodo[0]) + $this->salud($salario_base_empleado_real,$emp,$year_periodo[0]) + $this->pension($salario_base_empleado_real,$emp,$year_periodo[0]);
				$subtotal_aporte_parafiscales = $this->caja_compensacion($salario_base_empleado_real,$emp,$year_periodo[0]) + $this->icbf($salario_base_empleado_real,$emp,$year_periodo[0]) +
				$this->sena($salario_base_empleado_real,$emp,$year_periodo[0]);
				$total_aportes_empleado = $this->aporte_salud($salario_base_empleado_real,$emp,$year_periodo[0]) + $this->pension_deducciones($salario_base_empleado_real,$emp,$year_periodo[0]) + $this->fondo_solidaridad_pensional($salario_base_empleado_real,$emp,$year_periodo[0]) + $row['rte'] + $row['afc'];
				$total_seguridad_s_a = $subtotal_seguridad_social + $subtotal_aporte_parafiscales + $total_aportes_empleado;
				$acum += $total_seguridad_s_a;
				
					$est .= "	<tr>
									<td align = 'left' width = '70%'>".$row['nombre_empleado']."</td>
									<td >
										<table width = '100%' class = 'sin_color'>
											<tr>
												<td align = 'left'>$</td>
												<td align = 'right'>".number_format($total_seguridad_s_a)."</td>
											</tr>
										</table>
									</td>
								</tr>";
			}
			$est.="</table></th></tr></table>";
			
			$gran_acumulado += $acum;
			$est .="<table width = '100%' class = 'titulos_cuadros' onclick = 'ocultar_prestaciones_sociales_nd()'>
				<tr>
					<th width = '79%'colspan = '2' align = 'right'><strong>TOTAL SEGURIDAD SOCIAL Y PRESTACIONES</strong></td>
					<th nowrap>
						<table width = '100%'>
							<tr>
								<th width = '80%'>
								$ ".number_format($acum)."
								</th>
								<th id = 'triangulo_ss_nd'>
									<div class = 'triangulo_inf mano'></div>
								</th>
							</tr>
						</table>
					</th>
				</tr></table>";
			
			$est .= "</br>
					<table  class ='tablas_muestra_datos_tablas' width = '100%'>
						<tr>
						<th width = '30%' style = 'text-align:left;'>
							<strong>NOMINA</strong>
						</th>
						<th id = 'tabla_nomina_nd' style = 'display:none;'>
							<table width = '100%'>
								<tr>
									<th >NOMBRE</th>
									<th >A PAGAR</th>
								</tr>";
			$acum = 0;
			if($un == 'all'){
				$sql = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.empresa = '$emp' ");
			}else{
				$sql = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.empresa = '$emp' and te.und ='$un'");
			}
			while($row = mysql_fetch_array($sql)){
				$salario_base_empleado_real = ($row['salario_base']/30)*$row['dias'];
				$acum +=$salario_base_empleado_real;
					$est .= "	<tr>
									<td  width = '70%' align = 'left'>".$row['nombre_empleado']."</td>
									<td >
										<table width = '100%' class = 'sin_color'>
											<tr>
												<td align = 'left'>$</td>
												<td align = 'right'>".number_format($salario_base_empleado_real)."</td>
											</tr>
										</table>
									</td>
								</tr>";
			}
			$est.="</table></th></tr></table>";
			$gran_acumulado += $acum;
			$est .="<table width = '100%' class = 'titulos_cuadros' onclick = 'ocultar_nomina_nd()'>
				<tr >
					<th width = '79%' colspan = '2' align = 'right'><strong>TOTAL NÓMINA</strong></th>
					<th nowrap>
						<table width = '100%'>
							<tr>
								<th width = '80%'>
								$ ".number_format($acum)."
								</th>
								<th id = 'triangulo_nomina_nd'>
									<div class = 'triangulo_inf mano'></div>
								</th>
							</tr>
						</table>
					</th>
				</tr>
			</table></th></tr></table>";
			
			//BENEFICIO NO PRESTACIONAL
			$acum = 0;
			$est .= "</br>
					<table class ='tablas_muestra_datos_tablas' width = '100%'>";
			$est .= "<tr>
						<th width = '30%' style = 'text-align:left;'>
							<strong>BENEFICIO NO PRESTACIONAL</strong>
						</th>
						<th id = 'tabla_bnp_nd' style = 'display:none;'>
							<table width = '100%'>
								<tr>
									<th >NOMBRE</th>
									<th >A PAGAR</th>
								</tr>";
			if($un == 'all'){
				$sql = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.empresa = '$emp' ");
			}else{
				$sql = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.empresa = '$emp' and te.und ='$un'");
			}
			
			while($row = mysql_fetch_array($sql)){
				$salario_base_empleado_real = ($row['salario_base']/30)*$row['dias'];
				$bonos = $row['bnp'] + $row['balimentacion'] + $row['otros'];
				$acum += $bonos;
				
					$est .= "	<tr>
									<td width = '70%' align = 'left'>".$row['nombre_empleado']."</td>
									<td >
										<table width = '100%'class = 'sin_color'>
											<tr>
												<td align = 'left'>$</td>
												<td align = 'right'>".number_format($bonos)."</td>
											</tr>
										</table>
									</td>
								</tr>";
			}
			$est.="</table></th></tr></table>";
			$gran_acumulado += $acum;
			$est .="<table width = '100%' class = 'titulos_cuadros' onclick = 'ocultar_bnp_nd()'>
				<tr>
					<th width = '79%' align = 'right'><strong>TOTAL BENEFICIO NO PRESTACIONAL</strong></th>
					<th nowrap>
						<table width = '100%'>
							<tr>
								<th  width = '80%'>
								$ ".number_format($acum)."
								</th>
								<th id = 'triangulo_bnp_nd'>
									<div class = 'triangulo_inf mano'></div>
								</th>
							</tr>
						</table>
					</th>
				</tr>
			</table></th></tr></table>";
			
			//---------------------------------------
			//COMSION PEOPLE PASS --- QUITAR PORQUE NO APLICA PARA TODAS LAS EMPRESAS
			//---------------------------------------
			$acum = 0;
			$mes = floatval(date("m"));
			$periodo_monetizacion = "";
			if($mes <= 6){
				$periodo_monetizacion = date("Y")."-1";
			}else{
				$periodo_monetizacion = date("Y")."-2";
			}
			$sql = mysql_query("select valor from monetizacion_sena where periodo = '$periodo_monetizacion' and
			empresa = '$emp'");
			$moni_sena = 0;
			while($ro = mysql_fetch_array($sql)){
				$moni_sena = $ro['valor'];
				$gran_acumulado += $moni_sena;
				$acum += $moni_sena;
			}
			$sql = mysql_query("select id,people,pacc, examenes, periodo,empresa from costos_admin_nomina where periodo = '$periodo' and
			empresa = '$emp'");
			$people_x = 0;
			$pacc_x = 0;
			$examenes_x = 0;
			$est .= "</br><table class ='tablas_muestra_datos_tablas' width = '100%'>";
			while($ro = mysql_fetch_array($sql)){
				$id = $ro['id'];
				$gran_acumulado +=$ro['people'];
				$acum +=$ro['people'];
				$people_x = $ro['people'];
				$gran_acumulado +=$ro['pacc'];
				$pacc_x = $ro['pacc'];
				$acum +=$ro['pacc'];
				$gran_acumulado +=$ro['examenes'];
				$acum +=$ro['examenes'];
				$examenes_x = $ro['examenes'];
				$est .= "<tr>
						<th width = '30%' style = 'text-align:left;'>
							<strong>ADMINISTRATIVOS</strong>
						</th>
						<th id = 'tabla_admin_nd'  style = 'display:none;'>
							<table  width = '100%'>
								<tr>
									<td align = 'left' width = '70%'>COMISION PEOPLE</td>
									<td align = 'right'>
										<table width = '100%' class = 'sin_color'>
											<tr>
												<td align = 'left'>$</td>
												<td id = 'comision_people' align = 'right'>
													<span id = 'comi_people' ondblclick = 'cambiar_comision_people_pas($id)'>".number_format($people_x)."</span>
													<span id = 'comi_people_h' class = 'hidde'>".$people_x."</span>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td align = 'left' width = '70%'>MONETIZACION SENA</td>
									<td align = 'right' >
										<table width = '100%' class = 'sin_color'>
											<tr>
												<td align = 'left'>$</td>
												<td align = 'right'>".number_format($moni_sena)."</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td align = 'left' width = '70%' class = 'bordes_nomina'>PACC POLIZA EMPLEADOS POR 40% NO PRESTACIONAL</td>
									<td align = 'right' class = 'bordes_nomina'>
										<table width = '100%' class = 'sin_color'>
											<tr>
												<td align = 'left'>$</td>
												<td id ='c_pacc'align = 'right'>
													<span id = 'pacc' ondblclick = 'cambiar_pacc($id)'>".number_format($pacc_x)."</span>
													<span id = 'pacc_h' class = 'hidde'>".$pacc_x."</span>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td align = 'left' width = '70%' class = 'bordes_nomina'> PROVISION EXAMNES MEDICOS OCUPACIONALES</td>
									<td align = 'right' class = 'bordes_nomina'>
										<table width = '100%' class = 'sin_color'>
											<tr>
												<td align = 'left'>$</td>
												<td id = 'exa' align = 'right'>
													<span id = 'examenes' ondblclick = 'cambiar_examenes($id)'>".number_format($examenes_x)."</span>
													<span id = 'examenes_h' class = 'hidde'>".$examenes_x."</span>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</th>
					</tr>";
			}
			
			
			$est.="</table>";
			$est .="<table width = '100%' class = 'titulos_cuadros' onclick = 'ocultar_admins_nd()'>
				<tr>
					<th width = '79%' align = 'right'><strong>TOTAL GASTOS ADMINISTRATIVOS</strong></th>
					<th nowrap>
						<table width = '100%'>
							<tr>
								<th width = '80%'>
								$ ".number_format($acum)."
								</th>
								<th id = 'triangulo_admin_nd'>
									<div class = 'triangulo_inf mano'></div>
								</th>
							</tr>
						</table>
					</th>
				</tr>
			</table></th></tr></table>";
					
			//PRESTACIONES SOCIALES
			$acum = 0;
			$est .= "</br><table class ='tablas_muestra_datos_tablas' width = '100%'>";
			$est .= "<tr>
						<th width = '30%' style = 'text-align:left;' >
							<strong>PRESTACIONES SOCIALES</strong>
						</th>
						<th id = 'tabla_ps_nd'  style = 'display:none;'>
							<table width = '100%'>
								<tr>
									<th >NOMBRE</th>
									<th >A PAGAR</th>
								</tr>";
			if($un == 'all'){
				$sql = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.empresa = '$emp' ");
			}else{
				$sql = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.empresa = '$emp' and te.und ='$un'");
			}
			
			while($row = mysql_fetch_array($sql)){
				$salario_base_empleado_real = ($row['salario_base']/30)*$row['dias'];
				$subtotal_prestaciones_sociales = $this->cesantias($salario_base_empleado_real+ $this->aux_transporte($salario_base_empleado_real,$emp,$year_periodo[0]),$emp,$year_periodo[0]) + $this->int_cesantias($salario_base_empleado_real+ $this->aux_transporte($salario_base_empleado_real,$emp,$year_periodo[0]),$emp,$year_periodo[0]) +
				$this->vacaciones($salario_base_empleado_real,$emp,$year_periodo[0]) + $this->prima($salario_base_empleado_real+ $this->aux_transporte($salario_base_empleado_real,$emp,$year_periodo[0]),$emp,$year_periodo[0]);
				$acum += $subtotal_prestaciones_sociales;
				
					$est .= "	<tr>
									<td width = '70%' align = 'left'>".$row['nombre_empleado']."</td>
									<td >
										<table width = '100%' class = 'sin_color'>
											<tr>
												<td align = 'left'>$</td>
												<td align = 'right'>".number_format($subtotal_prestaciones_sociales)."</td>
											</tr>
										</table>
									</td>
								</tr>";
			}
			$est.="</table></th></tr></table>";
			$gran_acumulado += $acum;
			$est .="<table width = '100%' class = 'titulos_cuadros' onclick = 'ocultar_ps_nd()'>
				<tr>
					<th width = '79%' align = 'right'><strong>TOTAL PRESTACIONES SOCIALES</strong></th>
					<th  nowrap>
						<table width = '100%'>
							<tr>
								<th width = '80%'>
								$ ".number_format($acum)."
								</th>
								<th id = 'triangulo_ps_nd'>
									<div class = 'triangulo_inf mano'></div>
								</th>
							</tr>
						</table>
					</th>
				</tr>
			</table></th></tr></table>";
			
			
			
			//INDEMNIZACION
			$acum = 0;
			$est .= "</br><table class ='tablas_muestra_datos_tablas' width = '100%'>";
			$est .= "<tr>
						<th width = '30%' style = 'text-align:left;'>
							<strong>INDEMNIZACION</strong>
						</th>
						<th id = 'tabla_indep_nd'  style = 'display:none;'>
							<table width = '100%'>
								<tr>
									<th class = 'bordes_nomina'>NOMBRE</th>
									<th class = 'bordes_nomina'>A PAGAR</th>
								</tr>";
			if($un == 'all'){
				$sql = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.empresa = '$emp' ");
			}else{
				$sql = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.empresa = '$emp' and te.und ='$un'");
			}
			
			while($row = mysql_fetch_array($sql)){
				$salario_base_empleado_real = ($row['salario_base']/30)*$row['dias'];
				$indep = $this->base_indemnizaciones_provisiones($salario_base_empleado_real,$row['documento_empleado'],$emp,$year_periodo[0]);
				$acum += $indep;
				
					$est .= "	<tr>
									<td align = 'left' width = '70%'>".$row['nombre_empleado']."</td>
									<td >
										<table width = '100%' class = 'sin_color'>
											<tr>
												<td align = 'left'>$</td>
												<td align = 'right'>".number_format($indep)."</td>
											</tr>
										</table>
									</td>
								</tr>";
			}
			$gran_acumulado += $acum;
			$est.="</table></th></tr></table>";
			$est .="<table width = '100%' class = 'titulos_cuadros' onclick = 'ocultar_indp_nd()'>
				<tr>
					<th width ='79%' align = 'right'><strong>TOTAL INDEMNIZACION</strong></th>
					<th nowrap>
						<table width = '100%'>
							<tr>
								<th width = '80%'>
								$ ".number_format($acum)."
								</th>
								<th id = 'triangulo_indp_nd'>
									<div class = 'triangulo_inf mano'></div>
								</th>
							</tr>
						</table>
					</th>
				</tr>
			</table></th></tr></table>";
			
			
			
			
			
			$est .="</br><table width = '100%' class = 'titulos_cuadros'>
				<tr>
					<td  align = 'right' width = '79%'style = 'background-color:#EB2B2B;color:white;padding:5px;'><strong>GRAN TOTAL NÓMINA<strong></td>
					<td align = 'center'  style = 'background-color:#EB2B2B;color:white;padding:5px;'>
						<table width = '100%' >
							<tr>
								<td nowrap align = 'center'><strong>$".number_format($gran_acumulado)."</strong></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>";
			echo $est;
		}
		
		function insert_novedades_empleado($pk,$fi,$ff,$tipo,$usuario,$fecha){
			$diferencia = strtotime($ff) - strtotime($fi);
			if($diferencia < 60){
				$tiempo = floor($diferencia);
			}else if($diferencia > 60 && $diferencia < 3600){
				$tiempo = floor($diferencia/60);
			}else if($diferencia > 3600 && $diferencia < 86400){
				$tiempo =floor($diferencia/3600);
			}else if($diferencia > 86400 && $diferencia < 2592000){
				$tiempo = floor($diferencia/86400);
			}else if($diferencia > 2592000 && $diferencia < 31104000){
				$tiempo =floor($diferencia/2592000);
			}else if($diferencia > 31104000){
				$tiempo = floor($diferencia/31104000);
			}else{
				$tiempo =0;
			}
			$sql = mysql_query("insert into novedades(cedula,fechai,fechaf,dias,tipo,fecha,usuario) values('".$pk."','".$fi."','".$ff."','".$tiempo."','".
			$tipo."','".$fecha."','".$usuario."')");
			
			$acumulado = 0;
			$sql = mysql_query("select dias from vacaciones where cedula = '$pk'");
			while($row = mysql_fetch_array($sql)){
				$acumulado = $row['dias'];
			}
			$total = $acumulado - $tiempo;
			mysql_query("update vacaciones set dias = '$total' where cedula = '$pk'");
			//echo $dias;
		}
		
		public function fondo_solidaridad_pensional_sim($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 0;
			}else if(($x+1) >= $v){
				$x = ($x*0.70)*0.01;
			}
			return $x;
		}
		
		public function fondo_solidaridad_pensional($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 0;
			}else if(($x+1) >= $v){
				$x = ($x*0.70)*0.01;
			}
			return $x;
		}
		public function por_fondo_solidaridad_pensional_sim($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 0;
			}else if(($x+1) >= $v){
				$x = 1;
			}
			return $x;
		}
		
		public function por_fondo_solidaridad_pensional($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 0;
			}else if(($x+1) >= $v){
				$x = 1;
			}
			return $x;
		}
		
		public function base_seguridad_social($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = $x;
			}else if(($x+1) >= $v){
				$x = $x*0.70;
			}
			return $x;
		}
		
		public function salud($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			$min = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
				$min = $row['sal_minimo'];
			}
			if(($x+1) < ($min*10)){
				$x = 0;
			}else if(($x+1) >= ($min*10)){
				$x = (($x*70)/100)*0.0850;
			}
			return $x;
		}
		
		public function salud_sim($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			$min = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
				$min = $row['sal_minimo'];
			}
			if(($x+1) < ($min*10)){
				$x = 0;
			}else if(($x+1) >= ($min*10)){
				$x = (($x*70)/100)*0.0850;
			}
			return $x;
		}
		
		public function por_salud($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			$min = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
				$min = $row['sal_minimo'];
			}
			if(($x+1) < ($min*10)){
				$x = 0;
			}else if(($x+1) >= ($min*10)){
				$x = 8.50;
			}
			return $x;
		}
		
		public function por_salud_sim($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			$min = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
				$min = $row['sal_minimo'];
			}
			if(($x+1) < ($min*10)){
				$x = 0;
			}else if(($x+1) >= ($min*10)){
				$x = 8.50;
			}
			return $x;
		}
		
		public function pension($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = $x*0.12;
			}else if(($x+1) >= $v){
				$x = (($x*70)/100)*0.12;
			}
			return $x;
		}
		
		public function por_pension($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 12;
			}else if(($x+1) >= $v){
				$x = 12;
			}
			return $x;
		}
	
		public function pension_deducciones($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = $x*0.04;
			}else if(($x+1) >= $v){
				$x = (($x*70)/100)*0.04;
			}
			return $x;
		}
		
		public function pension_deducciones_sim($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = $x*0.04;
			}else if(($x+1) >= $v){
				$x = (($x*70)/100)*0.04;
			}
			return $x;
		}
		
		public function por_pension_deducciones($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 4;
			}else if(($x+1) >= $v){
				$x = 4;
			}
			return $x;
		}
		
		public function por_pension_deducciones_sim($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 4;
			}else if(($x+1) >= $v){
				$x = 4;
			}
			return $x;
		}
		
		public function caja_compensacion_sim($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = $x*0.04;
			}else if(($x+1) >= $v){
				$x = (($x*70)/100)*0.04;
			}
			return $x;
		}
		
		public function por_caja_compensacion_sim($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 4;
			}else if(($x+1) >= $v){
				$x = 4;
			}
			return $x;
		}
		
		public function caja_compensacion($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = $x*0.04;
			}else if(($x+1) >= $v){
				$x = (($x*70)/100)*0.04;
			}
			return $x;
		}
		
		public function por_caja_compensacion($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 4;
			}else if(($x+1) >= $v){
				$x = 4;
			}
			return $x;
		}
		
		public function por_total_aportes_parafiscales($x,$emp,$year){
			return $this->por_caja_compensacion($x,$emp,$year) + $this->por_icbf($x,$emp,$year) + $this->por_sena($x,$emp,$year);
		}
		public function por_total_aportes_parafiscales_sim($x,$emp){
			return $this->por_caja_compensacion_sim($x,$emp) + $this->por_icbf_sim($x,$emp) + $this->por_sena_sim($x,$emp);
		}
		
		public function aporte_salud($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = $x*0.04;
			}else if(($x+1) >= $v){
				$x = (($x*70)/100)*0.04;
			}
			return $x;
		}
		public function aporte_salud_sim($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = $x*0.04;
			}else if(($x+1) >= $v){
				$x = (($x*70)/100)*0.04;
			}
			return $x;
		}
		
		public function por_total_deducciones_trabajador($x,$emp,$year){
			return $this->por_aporte_salud($x,$emp,$year)+$this->por_pension_deducciones($x,$emp,$year)+$this->por_fondo_solidaridad_pensional($x,$emp,$year);
		}
		
		public function por_total_deducciones_trabajador_sim($x,$emp){
			return $this->por_aporte_salud_sim($x,$emp)+$this->por_pension_deducciones_sim($x,$emp)+$this->por_fondo_solidaridad_pensional_sim($x,$emp);
		}
		
		public function por_aporte_salud($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 4;
			}else if(($x+1) >= $v){
				$x = 4;
			}
			return $x;
		}
		
		public function por_aporte_salud_sim($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 4;
			}else if(($x+1) >= $v){
				$x = 4;
			}
			return $x;
		}
		
		public function aportes_empleados_pension($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_minimo'];
			}
			$cuatro = $v*4;
			if(($x+1) < $cuatro){
				$x = $x*0.04;
			}else if(($x+1) >= $cuatro){
				$x = (($x*70)/100)*0.05;
			}
			return $x;
		}
		
		public function total_seguridad_social($x,$emp,$de,$periodo,$year){
			return $this->aportes_empleados_pension($x,$emp,$year) + $this->aporte_salud($x,$emp,$year) + $this->caja_compensacion($x,$emp,$year) + 
			$this->sena($x,$emp,$year) + $this->icbf($x,$emp,$year) + $this->arl($x,$emp,$de,$year) + $this->salud($x,$emp,$year) + $this->pension($x,$emp,$year);
		}
		
		public function vacaciones($x){
			return $x*0.0417;
		}
		
		public function por_vacaciones($x){
			return 4.17;
		}
		
		public function prima($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = $x*0.0833;
			}else if(($x+1) >= $v){
				$x = 0;
			}
			return $x;
		}
		
		public function prima_sim($x,$emp){
			$year = date("Y");
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = $x*0.0833;
			}else if(($x+1) >= $v){
				$x = 0;
			}
			return $x;
		}
		
		public function por_prima($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 8.33;
			}else if(($x+1) >= $v){
				$x = 0;
			}
			return $x;
		}
		public function por_prima_sim($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 8.33;
			}else if(($x+1) >= $v){
				$x = 0;
			}
			return $x;
		}
		
		public function cesantias($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1)< $v){
				$x = $x*0.0833;
			}else if(($x+1) >= $v){
				$x = 0;
			}
			return $x;
		}
		public function cesantias_sim($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1)< $v){
				$x = $x*0.0833;
			}else if(($x+1) >= $v){
				$x = 0;
			}
			return $x;
		}
		
		public function por_cesantias($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1)< $v){
				$x = 8.33;
			}else if(($x+1) >= $v){
				$x = 0;
			}
			return $x;
		}
		public function por_cesantias_sim($x,$emp){
			$year = date("Y");
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1)< $v){
				$x = 8.33;
			}else if(($x+1) >= $v){
				$x = 0;
			}
			return $x;
		}
		
		
		public function int_cesantias($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = $x*0.01;
			}else if(($x+1) >= $v){
				$x = 0;
			}
			return $x;
		}
		public function int_cesantias_sim($x,$emp){
			$year = date("Y");
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = $x*0.01;
			}else if(($x+1) >= $v){
				$x = 0;
			}
			return $x;
		}
		
		
		public function por_int_cesantias($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 1;
			}else if(($x+1) >= $v){
				$x = 0;
			}
			return $x;
		}
		public function por_int_cesantias_sim($x,$emp){
			$year = date("Y");
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 1;
			}else if(($x+1) >= $v){
				$x = 0;
			}
			return $x;
		}
		
		public function por_total_prestaciones_sociales_sim($x,$emp){
			return $this->por_cesantias_sim($x,$emp)+$this->por_int_cesantias_sim($x,$emp)+$this->por_prima_sim($x,$emp)+$this->por_vacaciones($x);
		}
		
		public function por_total_prestaciones_sociales($x,$emp,$year){
			return $this->por_cesantias($x,$emp,$year)+$this->por_int_cesantias($x,$emp,$year)+$this->por_prima($x,$emp,$year)+$this->por_vacaciones($x);
		}
		
		public function indemnizaciones($x,$emp,$c,$year){
			return $this->base_indemnizaciones_provisiones($x,$emp,$c,$year);
		}
		
		public function total_prestaciones_sociales_indepnizaciones($x,$emp,$c,$year){
			return $this->vacaciones($x) + $this->prima($x+ $this->aux_transporte($x,$emp,$year),$emp,$year) + $this->cesantias($x+ $this->aux_transporte($x,$emp,$year),$emp,$year) + $this->int_cesantias($x+ $this->aux_transporte($x,$emp,$year),$emp,$year) + 
			$this->indemnizaciones($x,$c,$emp,$year);
		}
		
		public function sena($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 0;
			}else if(($x+1) >= $v){
				$x = (($x*70)/100)*0.02;
			}
			return $x;
		}
		
		public function sena_sim($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 0;
			}else if(($x+1) >= $v){
				$x = (($x*70)/100)*0.02;
			}
			return $x;
		}
		
		public function por_sena($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 0;
			}else if(($x+1) >= $v){
				$x = 2;
			}
			return $x;
		}
		
		public function por_sena_sim($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 0;
			}else if(($x+1) >= $v){
				$x = 2;
			}
			return $x;
		}
		
		public function icbf_sim($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 0;
			}else if(($x+1) >= $v){
				$x = (($x*70)/100)*0.03;
			}
			return $x;
		}
		
		public function por_icbf_sim($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 0;
			}else if(($x+1) >= $v){
				$x = 3;
			}
			return $x;
		}
		
		public function icbf($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 0;
			}else if(($x+1) >= $v){
				$x = (($x*70)/100)*0.03;
			}
			return $x;
		}
		
		public function por_icbf($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				$x = 0;
			}else if(($x+1) >= $v){
				$x = 3;
			}
			return $x;
		}
		
		public function arl_simulador($x,$emp,$id){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			$sm =0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
				$sm = $row['sal_minimo'];
			}
			$valor = 0;
			$sel = mysql_query("select name from SMCE where name like '%PASANT%' and id = '$id'");
			if(mysql_num_rows($sel) == 0){
				if(($x+1) < $v){
					$valor = $x*0.00522;
				}else if(($x+1) >= $v){
					$valor = (($x*70)/100)*0.00522;
				}
			}else{
				$sx = mysql_query("select otros from SMCE where  id = '$id'");
				while($row = mysql_fetch_array($sx)){
					$valor = $sm*0.00522;
				}
			}
			return $valor;
		}
		
		public function por_arl_simulador($x,$emp,$id){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			$sm =0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
				$sm = $row['sal_minimo'];
			}
			$valor = 0;
			$sel = mysql_query("select name from SMCE where name like '%PASANT%' and id = '$id'");
			if(mysql_num_rows($sel) == 0){
				if(($x+1) < $v){
					$valor = 0.522;
				}else if(($x+1) >= $v){
					$valor = 0.522;
				}
			}else{
				$sx = mysql_query("select otros from SMCE where  id = '$id'");
				while($row = mysql_fetch_array($sx)){
					$valor = 0.522;
				}
			}
			return $valor;
		}
		
		public function por_total_seguridad_social_sim($x,$emp,$id){
			return $this->por_pension($x,$emp) + $this->por_salud_sim($x,$emp)+$this->por_arl_simulador($x,$emp,$id);
		}
		
		public function por_total_seguridad_social($x,$emp,$periodo,$empleado,$year){
			return $this->por_pension($x,$emp,$year) + $this->por_salud($x,$emp,$year)+$this->por_arl($x,$emp,$empleado,$periodo);
		}
		
		public function por_arl($x,$emp,$empleado,$periodo){
			$periodo = explode("-",$periodo);
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".$periodo[0]."'");
			$v = 0;
			$sm =0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
				$sm = $row['sal_minimo'];
			}
			$valor = 0;
			$sel = mysql_query("select e.documento_empleado from empleado e where e.cargo_empleado like '%PASANT%' and e.documento_empleado ='$empleado'");
			if(mysql_num_rows($sel) == 0){
				if(($x+1) < $v){
					$valor = 0.522;
				}else if(($x+1) >= $v){
					$valor = 0.522;
				}
			}else{
				$sx = mysql_query("select s.otros from salarios_empleado s where s.pk_empleado = '$empleado'");
				while($row = mysql_fetch_array($sx)){
					$valor = 0.522;
				}
			}
			return $valor;
		}
		
		public function arl($x,$emp,$empleado,$periodo){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".$periodo."'");
			$v = 0;
			$sm =0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
				$sm = $row['sal_minimo'];
			}
			$valor = 0;
			$sel = mysql_query("select e.documento_empleado from empleado e where e.cargo_empleado like '%PASANT%' and e.documento_empleado ='$empleado'");
			if(mysql_num_rows($sel) == 0){
				if(($x+1) < $v){
					$valor = $x*0.00522;
				}else if(($x+1) >= $v){
					$valor = (($x*70)/100)*0.00522;
				}
			}else{
				$sx = mysql_query("select s.otros from salarios_empleado s where s.pk_empleado = '$empleado'");
				while($row = mysql_fetch_array($sx)){
					$valor = $sm*0.00522;
				}
			}
			return $valor;
		}
		
		public function base_indemnizaciones_provisiones_simulacro($x,$id,$emp){
			$se = mysql_query("select year(fecha) as ano from SMCE where id = '$id'");
			$fecha = "";
			while($row = mysql_fetch_array($se)){
				$fecha = $row['ano'];
			}
			$ano = $fecha;
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			if(($x+1) < $v){
				if($ano > 1991 && $ano <= (date("Y")-1)){
					$x = (($x/30)*20)/12;
				}else if($ano >=1980 && $ano <=1990){
					$x = ($x/30)*40;
				}else if($ano < 1980){
					$x = ($x/30)*30;
				}else if($ano == date("Y")){
					$x = $x/12;
				}
			}else if(($x+1) >= $v){
				$x = ($x/30)*15;
			}
			return $x;
		}
		
		public function base_indemnizaciones_provisiones($x,$empleado,$emp,$year){
			$se = mysql_query("select year(fecha_ingreso_empleado) as ano,fecha_ingreso_empleado from empleado where documento_empleado = '$empleado'");
			$fecha = "";
			$f = "";
			while($row = mysql_fetch_array($se)){
				$fecha = $row['ano'];
				$f = $row['fecha_ingreso_empleado'];
			}
			$ano = $fecha;
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year[0]'");
			$v = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_integral'];
			}
			$fecha = $f;
			$nuevafecha = strtotime ( '+365 day' , strtotime ( $fecha ) ) ;
			$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
			//$r = printf('%d años, %d meses, %d días, %d horas, %d minutos', $fecha->y, $fecha->m, $fecha->d, $fecha->h, $fecha->i);
			if(($x+1) < $v){
				if($nuevafecha > date("Y-m-d")){
					$x = $x/12;
				}else if($ano > 1991 && $ano <= (date("Y")-1)){
					$x = (($x/30)*20)/12;
				}else if($ano >=1980 && $ano <=1990){
					$x = ($x/30)*40;
				}else if($ano < 1980){
					$x = ($x/30)*30;
				}
			}else if(($x+1) >= $v){
				$x = ($x/30)*15;
			}
			return $x;
		}
		
		public function aux_transporte($x,$emp,$year){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			$v = 0;
			$a = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_minimo'];
				$a = $row['aux_transporte'];
			}
			$dos_salarios = $v*2;
			if(($x+1) >= $v && ($x+1) < $dos_salarios){
				$x = $a;
			}else{
				$x = 0;
			}
			return $x;
		}
		
		public function aux_transporte_sim($x,$emp){
			$selx = mysql_query("select sal_integral,sal_minimo,aux_transporte from administrativa where empresa = '$emp' and year = '".date("Y")."'");
			$v = 0;
			$a = 0;
			while($row = mysql_fetch_array($selx)){
				$v = $row['sal_minimo'];
				$a = $row['aux_transporte'];
			}
			$dos_salarios = $v*2;
			if(($x+1) >= $v && ($x+1) < $dos_salarios){
				$x = $a;
			}else{
				$x = 0;
			}
			return $x;
		}
		
		public function personal_down($periodo,$emp,$un){
			$tabla ="
				<table >
				<tr>
					<td>
						<div><input type = 'checkbox' value = '1' id = 'v_info_emp' onchange = 'ocultar_info_empleado_pd()' checked class = 'radio'/>
						<label for='v_info_emp'><span><span></span></span>Información Empleado</label></div>
					</td>
					<td>
						<div><input type = 'checkbox' value = '1'id = 'v_info_Sal' onchange = 'ocultar_info_salarial_pd()' checked class = 'radio'/>
						<label for='v_info_Sal'><span><span></span></span>Composición Salarial</label></div>
					</td>
				</tr>
				<tr>
					<td>
						<div><input type = 'checkbox' value = '1'  id = 'v_info_ssp' onchange = 'ocultar_info_ssp_pd()' checked class = 'radio'/>
						<label for='v_info_ssp'><span><span></span></span>Seguridad Social Y Parafiscales</label></div>
					</td>
					<td>
						<div><input type = 'checkbox' value = '1'  id = 'v_ppsi' onchange = 'ocultar_pps_i_pd()' checked class = 'radio'/>
						<label for='v_ppsi'><span><span></span></span>Provisiones,Prestaciones Sociales E Indemnizaciones</label></div>
					</td>
				</tr>
			</table></br>
			";
			$tabla.= "<table width = '100%' class = 'tablas_muestra_datos_tablas2' id = 'personal_down_emple' style = 'border-spacing:  5px 5px;'>
					<tr>
						<th ></th>
						<th ></th>
						<th colspan = '4'  id = 'info_empleado' >INFORMACIÓN EMPLEADO</th>
						<th></th>
						<th colspan = '7'  id = 'composicion_salarial' >COMPOSICIÓN SALARIAL</th>
						<th></th>
						<th colspan = '9'  id = 'ss_pf' >SEGURIDAD SOCIAL Y PARAFISCALES</th>
						<th></th>
						<th colspan = '6'  id = 'pps_i'>PROVISIONES PRESTACIONES SOCIALES E INDEMNIZACIONES</th>
					</tr>
				";
			$sel1 = "";
			if($un == 'all'){
				$sel1 = mysql_query("select distinct ar.codigo_interno_empresa,ar.nombre_area_empresa 
			from area_empresa ar, empresa emp, tablas_empleados te,empleado e
			where te.cedula = e.documento_empleado and te.depto = ar.codigo_interno_empresa and ar.pk_empresa_areas = emp.cod_interno_empresa and emp.cod_interno_empresa = '$emp' and te.periodo = '$periodo' order by e.nombre_empleado asc");
			}else{
				$sel1 = mysql_query("select distinct ar.codigo_interno_empresa,ar.nombre_area_empresa 
			from area_empresa ar, empresa emp, tablas_empleados te,empleado e
			where te.cedula = e.documento_empleado and te.depto = ar.codigo_interno_empresa and ar.pk_empresa_areas = emp.cod_interno_empresa and emp.cod_interno_empresa = '$emp' and te.und = '$un' and te.periodo = '$periodo' order by e.nombre_empleado asc");
			}
			
			$ii = 0;
			$year_periodo = explode("-",$periodo);
			$xio = 0;
			while($row = mysql_fetch_array($sel1)){
				$xio++;
				$depto = $row['codigo_interno_empresa'];
				$tabla .= "<tr id = 't$ii'>
					<th >".$row['nombre_area_empresa']."</th>
					<th ></th>
					<th nowrap class = 'inf_empleado'>CARGO</th>					
					<th nowrap class = 'inf_empleado'>FECHA INGRESO</th>
					<th nowrap class = 'inf_empleado'>FECHA NACIMIENTO</th>
					<th nowrap class = 'inf_empleado'>EDAD</th>
					<th ></th>
					<th nowrap class = 'info_sal'>SUELDO</th>
					<th nowrap class = 'info_sal'>BENEFICIO </br>NO PRESTACIONAL</th>
					<th nowrap class = 'info_sal'>OTROS</th>
					<th nowrap class = 'info_sal'>AUX. TRANSPORTE</th>
					<th nowrap class = 'info_sal'>BASE SEGURIDAD SOCIAL</th>
					<th nowrap class = 'info_sal'>BASE INDEMNIZACIONES</br>PROVISION</th>
					<th nowrap class = 'info_sal'>TOTAL SALARIO</th>
					<th ></th>
					<th nowrap class = 'ss_pf'>SALUD</th>
					<th nowrap class = 'ss_pf'>PENSION</th>
					<th nowrap class = 'ss_pf'>ARL</th>
					<th nowrap class = 'ss_pf'>SENA</th>
					<th nowrap class = 'ss_pf'>ICBF</th>
					<th nowrap class = 'ss_pf'>CAJA COMPENSACION</th>
					<th nowrap class = 'ss_pf'>APORTE EMPLEADOS SALUD</th>
					<th nowrap class = 'ss_pf'>APORTE EMPLEADOS PENSION</th>
					<th nowrap class = 'ss_pf'>TOTAL SEGURIDAD SOCIAL</th>
					<th ></th>
					<th nowrap class = 'pps_i'>VACACIONES</th>
					<th nowrap class = 'pps_i'>PRIMA</th>
					<th nowrap class = 'pps_i'>CESANTIAS</th>
					<th nowrap class = 'pps_i'>INT CESANTIAS</th>
					<th nowrap class = 'pps_i'>INDEMNIZACIONES</th>
					<th nowrap class = 'pps_i'>TOTAL PROVISIONES</th>
					<th ></th>
					<th nowrap>TOTAL COSTO EMPLEADO</th>
				</tr>";
				
				$sel = mysql_query("select e.documento_empleado,e.nombre_empleado,e.cargo_empleado, e.fecha_ingreso_empleado, 
				e.fecha_nacimiento,e.estado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
				from empleado e, tablas_empleados te
				where e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.empresa = '$emp' and te.depto = '$depto' order by e.nombre_empleado asc");
				$acum1 = 0;
				$acum2 = 0;
				$acum3 = 0;
				$acum4 = 0;
				$acum5 = 0;
				$acum6 = 0;
				$cox = 0;
				while($rr = mysql_fetch_array($sel)){
					$cox++;
					$edad = date("Y-m-d")-$rr['fecha_nacimiento'];
					$doc = $rr['documento_empleado'];
					$e_documento = $rr['documento_empleado'];
					$salario_base_empleado_real = (($rr['salario_base'])/30)*$rr['dias'];
					
					$beneficio_no_prestacional = ($rr['bnp']/30)*$rr['dias'];
					$salario_base_1 = $rr['salario_base'];
					$total_a_pagar = $salario_base_1 + $this->aux_transporte($salario_base_empleado_real,$emp,$year_periodo[0]);
				
					
					
					$bonos = $rr['bnp'] + $rr['balimentacion'];
					
					$total_deducciones_del_trabajador = 0;
					$total_total = 0;
							
					$subtotal_prestaciones_sociales = $this->cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year_periodo[0]),$emp,$year_periodo[0]) + $this->int_cesantias($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year_periodo[0]),$emp,$year_periodo[0]) +
					$this->vacaciones($salario_base_empleado_real,$emp) + $this->prima($salario_base_empleado_real + $this->aux_transporte($salario_base_empleado_real,$emp,$year_periodo[0]),$emp,$year_periodo[0]);
					
					$subtotal_seguridad_social = $this->arl($salario_base_empleado_real,$emp,$rr['documento_empleado'],$year_periodo[0]) + $this->salud($salario_base_empleado_real,$emp,$year_periodo[0]) + $this->pension($salario_base_empleado_real,$emp,$year_periodo[0]);
					
					$subtotal_aporte_parafiscales = $this->caja_compensacion($salario_base_empleado_real,$emp,$year_periodo[0]) + $this->icbf($salario_base_empleado_real,$emp,$year_periodo[0]) +
					$this->sena($salario_base_empleado_real,$emp,$year_periodo[0]);
					
					$total_todo = $subtotal_prestaciones_sociales + $total_a_pagar + $subtotal_seguridad_social + $subtotal_aporte_parafiscales;
					$total = $total_todo +$this->base_indemnizaciones_provisiones($rr['salario_base'],$doc,$emp,$year_periodo);
					$acum1 += $rr['bnp'];
					$acum2 += $rr['otros'] +$rr['balimentacion'] + $rr['salario_base'] + $rr['bnp'] + $this->aux_transporte($rr['salario_base'],$emp,$year_periodo[0]);
					$acum3 += $this->total_seguridad_social($rr['salario_base'],$emp,$doc,$periodo,$year_periodo[0]);
					$acum4 += $this->total_prestaciones_sociales_indepnizaciones($rr['salario_base'],$emp,$doc,$year_periodo[0]);
					$acum5 += $total;
					
					
					$dat = $rr['fecha_ingreso_empleado'];
					$dat = explode("-",$dat);
					$fecha_ingreso = $this->meses[floatval($dat[1])-1]." ".$dat[2]." ".$dat[0];
					$dat2 = $rr['fecha_nacimiento'];
					$dat2 = explode("-",$dat2);
					$fecha_cumpleaños = $this->meses[floatval($dat2[1])-1]." ".$dat2[2]." ".$dat2[0];
					$tabla .="<tr id = '$ii'>
						<td  class = '$ii'nowrap>".$rr['nombre_empleado']."</td>
						<th class = 'add_td_info_empleado $ii'></th>
						<td  nowrap class = 'inf_empleado $ii'>".$rr['cargo_empleado']."</td>
						<td  nowrap class = 'inf_empleado $ii'>$fecha_ingreso</td>
						<td  nowrap class = 'inf_empleado $ii'>$fecha_cumpleaños</td>
						<td  align = 'center' class = 'inf_empleado $ii'>".$edad."</td>
						<td style = 'background-color:white;' class = '$ii'></td>
						<td class = 'info_sal $ii'   >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($rr['salario_base'])."</td>
								</tr>
							</table>
						</td>
						<td  class = 'info_sal $ii'  >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($rr['bnp'])."</td>
								</tr>
							</table>
						</td>
						<td  class = 'info_sal $ii'  >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format(($rr['otros'] + $rr['balimentacion']))."</td>
								</tr>
							</table>
						</td>
						<td  class = 'info_sal $ii' >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->aux_transporte($rr['salario_base'],$emp,$year_periodo[0]))."</td>
								</tr>
							</table>
						</td>
						<td  class = 'info_sal $ii' >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->base_seguridad_social($rr['salario_base']+ $this->aux_transporte($rr['salario_base'],$emp,$year_periodo[0]),$emp))."</td>
								</tr>
							</table>
						</td>
						<td  class = 'info_sal $ii' >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->base_indemnizaciones_provisiones($rr['salario_base'],$doc,$emp,$year_periodo))."</td>
								</tr>
							</table>
						</td>
						<td  class = 'info_sal $ii'  >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format(($rr['otros'] +$rr['balimentacion'] + $rr['salario_base'] + $rr['bnp'] + $this->aux_transporte($rr['salario_base'],$emp,$year_periodo[0])))."</td>
								</tr>
							</table>
						</td>
						<td style = 'background-color:white;' class = '$ii'></td>
						<td   class = 'ss_pf $ii' >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->salud($rr['salario_base'],$emp,$year_periodo[0]))."</td>
								</tr>
							</table>
						</td>
						<td  class = 'ss_pf $ii'  >
							<table width = '100%' class = 'sin_color'>
								<tr> 
									<td>$</td>
									<td align = 'right'>".number_format($this->pension($rr['salario_base'],$emp,$year_periodo[0]))."</td>
								</tr>
							</table>
						</td>
						<td   class = 'ss_pf $ii' >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->arl($rr['salario_base'],$emp,$rr['documento_empleado'],$year_periodo[0]))."</td>
								</tr>
							</table>
						</td>
						<td  class = 'ss_pf $ii'  >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->sena($rr['salario_base'],$emp,$year_periodo[0]))."</td>
								</tr>
							</table>
						</td>
						<td  class = 'ss_pf $ii'  >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->icbf($rr['salario_base'],$emp,$year_periodo[0]))."</td>
								</tr>
							</table>
						</td>
						<td  class = 'ss_pf $ii'  >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->caja_compensacion($rr['salario_base'],$emp,$year_periodo[0]))."</td>
								</tr>
							</table>
						</td>
						<td  class = 'ss_pf $ii'  >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->aporte_salud($rr['salario_base'],$emp,$year_periodo[0]))."</td>
								</tr>
							</table>
						</td>
						<td  class = 'ss_pf $ii' >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->aportes_empleados_pension($rr['salario_base'],$emp,$year_periodo[0]))."</td>
								</tr>
							</table>
						</td>
						<td  class = 'ss_pf $ii'>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->total_seguridad_social($rr['salario_base'],$emp,$doc,$periodo,$year_periodo[0]))."</td>
								</tr>
							</table>
						</td>
						<td style = 'background-color:white;' class = '$ii'></td>
						<td  class = 'pps_i $ii'>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->vacaciones($rr['salario_base']))."</td>
								</tr>
							</table>
						</td>
						<td  class = 'pps_i $ii'>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->prima($rr['salario_base'] + $this->aux_transporte($rr['salario_base'],$emp,$year_periodo[0]),$emp,$year_periodo[0]))."</td>
								</tr>
							</table>
						</td>
						<td class = 'pps_i $ii'>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->cesantias($rr['salario_base'] + $this->aux_transporte($rr['salario_base'],$emp,$year_periodo[0]),$emp,$year_periodo[0]))."</td>
								</tr>
							</table>
						</td>
						<td class = 'pps_i $ii'>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->int_cesantias($rr['salario_base'] + $this->aux_transporte($rr['salario_base'],$emp,$year_periodo[0]),$emp,$year_periodo[0]))."</td>
								</tr>
							</table>
						</td>
						<td class = 'pps_i $ii'>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($rr['indemnizacion'])."</td>
								</tr>
							</table>
						</td>
						<td class = 'pps_i $ii'>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($this->total_prestaciones_sociales_indepnizaciones($rr['salario_base'],$emp,$doc,$year_periodo[0]))."</td>
								</tr>
							</table>
						</td>
						
						<td style = 'background-color:white;' class = '$ii'></td>
						<td  class = '$ii'>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format(($total))."</td>
								</tr>
							</table>
						</td>
					</tr>";
				}
				$tabla .="<tr><td style = 'background-color:white;'></br></td></tr>
					<tr>
						<th onclick = 'ocultar_horizontal_pd($ii)'nowrap style = 'background-color:#FA9F1F;color:white;padding:5px;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;-khtml-border-radius: 0.3em;'>
							<strong>TOTAL COSTO AREA ".$row['nombre_area_empresa']."</strong>
						</th>
						<td style = 'background-color:white;'></td>
						<td class = 'inf_empleado' style = 'background-color:white;'></td>
						<td class = 'inf_empleado' style = 'background-color:white;'></td>
						<td class = 'inf_empleado' style = 'background-color:white;'></td>
						<td class = 'inf_empleado' style = 'background-color:white;'></td>
						<td style = 'background-color:white;'></td>
						<td class = 'info_sal' style = 'background-color:white;'></td>
						<td class = 'info_sal' style = 'background-color:#FA9F1F;color:white;padding:5px;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;-khtml-border-radius: 0.3em;' class = 'info_sal'>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right' ><strong>".number_format(($acum1))."</strong></td>
								</tr>
							</table>
						</td>
						<td  class = 'info_sal' style = 'background-color:white;'></td>
						<td  class = 'info_sal' style = 'background-color:white;'></td>
						<td  class = 'info_sal' style = 'background-color:white;'></td>
						<td  class = 'info_sal' style = 'background-color:white;'></td>
						<td style = 'background-color:#FA9F1F;color:white;padding:5px;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;-khtml-border-radius: 0.3em;'class = 'info_sal' >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'><strong>".number_format(($acum2))."</strong></td>
								</tr>
							</table>
						</td>
						<td style = 'background-color:white;'></td>
						<td class = 'ss_pf' style = 'background-color:white;'></td>
						<td class = 'ss_pf' style = 'background-color:white;'></td>
						<td class = 'ss_pf' style = 'background-color:white;'></td>
						<td class = 'ss_pf' style = 'background-color:white;'></td>
						<td class = 'ss_pf' style = 'background-color:white;'></td>
						<td class = 'ss_pf' style = 'background-color:white;'></td>
						<td class = 'ss_pf'style = 'background-color:white;'></td>
						<td class = 'ss_pf'style = 'background-color:white;'></td>
						<td style = 'background-color:#FA9F1F;color:white;padding:5px;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;-khtml-border-radius: 0.3em;'class = 'ss_pf'>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'><strong>".number_format(($acum3))."</strong></td>
								</tr>
							</table>
						</td>
						<td  style = 'background-color:white;'></td>
						<td  class = 'pps_i' style = 'background-color:white;'></td>
						<td  class = 'pps_i' style = 'background-color:white;'></td>
						<td  class = 'pps_i' style = 'background-color:white;'></td>
						<td  class = 'pps_i' style = 'background-color:white;'></td>
						<td  class = 'pps_i' style = 'background-color:white;'></td>
						<td style = 'background-color:#FA9F1F;color:white;padding:5px;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;-khtml-border-radius: 0.3em;' class = 'pps_i'>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'><strong>".number_format($acum4)."</strong></td>
								</tr>
							</table>
						</td>
						<td style = 'background-color:white;'></td>
						<td style = 'background-color:#FA9F1F;color:white;padding:5px;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;-khtml-border-radius: 0.3em;' >
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'><strong>".number_format(($acum5))."</strong></td>
								</tr>
							</table>
						</td>
				</tr>
				<tr><th></br></br></th><th></br></th></tr>";
				
				$acum1 = 0;
				$acum2 = 0;
				$acum3 = 0;
				$acum4 = 0;
				$acum5 = 0;
				$ii++;
			}
			return $tabla."</table>";
		}
		
		public function menu_personal_down(){
			$contenido = "<table>
				<tr>
					<p>Empresa</p>
				</tr>
			</table>";
			echo $contenido;
		}
		
		
		public function generar_cuadros($empresa,$empleados,$un,$usuario){
			$dias = 30;
			$c = 0;
			$val = 0;
			$periodo =date("Y")."-".floatval(date("m"));
			for($i = 0;$i < count($empleados);$i++){
				$emp = mysql_query("select e.documento_empleado,e.pk_depto,e.fecha_ingreso_empleado,se.salario_base,se.bnp,se.bonos_alimentacion,se.otros 
				from empleado e, salarios_empleado se 
				where e.documento_empleado = se.pk_empleado and e.pk_empresa = '$empresa' and e.documento_empleado = '".$empleados[$i]."'");
				
				while($rr = mysql_fetch_array($emp)){
					$indemn = $this->vacaciones($rr['salario_base']) + $this->prima($rr['salario_base'],$empresa) + $this->cesantias($rr['salario_base'],$empresa) + $this->int_cesantias($rr['salario_base'],$empresa);
					$vacas = 1.25;
					$liquidacion = $this->indemnizaciones($rr['salario_base'],$rr['documento_empleado'],$empresa);
					$insert = mysql_query("insert into tablas_empleados(cedula,depto,usuario,dias,salario_base,otros,bnp,balimentacion,indemnizacion,liquidacion,
					vacaciones,fecha,empresa,periodo,rte,afc,und) values('".$rr['documento_empleado']."','".$rr['pk_depto']."','".$usuario."','".$dias."','".$rr['salario_base']."','".$rr['otros']."','".$rr['bnp']
					."','".$rr['bonos_alimentacion']."','".$indemn."','".$liquidacion."','".$vacas."','".date('Y-m-d')."','".$empresa."','".$periodo."','".$c."','".$c."','".$un."')");					
				}
				$this->tratar_vacaciones_empleado($this->accion_vacaciones($empleados[$i]),$empleados[$i]);
				$sql = mysql_query("select periodo from costos_admin_nomina where periodo = '$periodo'");
				if(mysql_num_rows($sql) == 0){
					$sql = mysql_query("insert into costos_admin_nomina(periodo,empresa) values('".$periodo."','".$empresa."')");
				}
				
			}
		}
		
		//Traslado de Nómina 
		public function trasladar_nomina($empresa,$usuario){
			$periodo_actual = date("Y")."-".floatval(date("m"));
			$periodo_anterior = date("Y")."-".(floatval(date("m"))-1);
			$sql = mysql_query("select periodo from costos_admin_nomina where periodo = '$periodo_actual'");
				if(mysql_num_rows($sql) == 0){
					$sql = mysql_query("insert into costos_admin_nomina(periodo,empresa) values('".$periodo_actual."','".$empresa."')");
				}
			
			$sql_pregunta = mysql_query("select periodo from tablas_empleados where periodo = '$periodo_actual' and empresa = '$empresa'");
			$val = mysql_num_rows($sql_pregunta);
			if($val == 0){
				$sql = mysql_query("select cedula,depto,dias,salario_base,otros,bnp,balimentacion,indemnizacion,liquidacion,vacaciones,afc,rte,und
				from tablas_empleados where periodo = '$periodo_anterior' and empresa = '$empresa'");
				while($rr = mysql_fetch_array($sql)){
					$dias = 30;
					$c = 0;
					$indemn = $this->vacaciones($rr['salario_base']) + $this->prima($rr['salario_base'],$empresa) + $this->cesantias($rr['salario_base'],$empresa) + $this->int_cesantias($rr['salario_base'],$empresa);
					$vacas = 1.25;
					$liquidacion = $this->indemnizaciones($rr['salario_base'],$rr['cedula'],$empresa);
					$insert = mysql_query("insert into tablas_empleados(cedula,depto,usuario,dias,salario_base,otros,bnp,balimentacion,indemnizacion,liquidacion,
					vacaciones,fecha,empresa,periodo,rte,afc,und) values('".$rr['cedula']."','".$rr['depto']."','".$usuario."','".$dias."','".$rr['salario_base']."','".$rr['otros']."','".$rr['bnp']
					."','".$rr['balimentacion']."','".$indemn."','".$liquidacion."','".$vacas."','".date('Y-m-d')."','".$empresa."','".$periodo_actual."','".$c."','".$c."','".$rr['und']."')");	
					$this->tratar_vacaciones_empleado($this->accion_vacaciones($rr['cedula']),$rr['cedula']);
				}
				echo "NÓMINA DEL MES ANTERIOR TRASLADADA !";
			}else{
				echo "ESTA FUNCIÓN YA SE HA REALIZADO \nVERIFIQUE LOS EMPLEADOS NUEVOS !";
			}
		}
		
		
		public function cambiar_people($p,$id){
			$sql = mysql_query("update costos_admin_nomina set people = '$p' where id = '$id'");
		}
		
		public function cambiar_pacc($p,$id){
			$sql = mysql_query("update costos_admin_nomina set pacc = '$p' where id = '$id'");
		}
		
		public function cambiar_examenes($p,$id){
			$sql = mysql_query("update costos_admin_nomina set examenes = '$p' where id = '$id'");
		}
			
		public function sql_empleados_x_depto($depto,$und,$emp){
			$sql = mysql_query("select Empleado.documento_empleado,Empleado.nombre_empleado,usuario.nick
			from Empleado
			left join usuario on Empleado.documento_empleado = usuario.pk_empleado where  usuario.nick is not NULL and Empleado.pk_empresa = '$emp'
			and Empleado.pk_depto = '$depto' and Empleado.und = '$und'");
			return $sql;
		}
		
		public function sql_empleados_x_depto_id($depto,$und,$emp){
			$sql = mysql_query("select Empleado.documento_empleado,Empleado.nombre_empleado,usuario.nick,usuario.idusuario
			from Empleado
			left join usuario on Empleado.documento_empleado = usuario.pk_empleado where  usuario.nick is not NULL and Empleado.pk_empresa = '$emp'
			and Empleado.pk_depto = '$depto' and Empleado.und = '$und'");
			return $sql;
		}
		
		public function listar_empleados_departamento_cobro_cliente($depto,$und,$emp){
			$sql = mysql_query("select Empleado.documento_empleado,Empleado.nombre_empleado,usuario.nick
			from Empleado
			left join usuario on Empleado.documento_empleado = usuario.pk_empleado where usuario.nick is not NULL and Empleado.pk_empresa = '$emp' and usuario.estado = '1' and Empleado.und = '$und' and Empleado.pk_depto = '$depto'");
			$est ="<table width = '100%'>";
			while($row = mysql_fetch_array($sql)){
				$est.="<tr>
					<td>
						<input type = 'checkbox' name = 'listado_empleados_add[]' />
					</td>
					<td>".$row['nombre_empleado']."</td>
				</tr>";
			}
			echo $est.="</table>";
		}
		
		public function empleado_x_departamento_id($sql){
			$imp = "<option value = '0'></option>";
			while($row = mysql_fetch_array($sql)){
				$imp .="<option value ='".$row['idusuario']."'>".$row['nombre_empleado']."</option>";
			}
			echo $imp;
		}
		public function empleado_x_departamento($sql){
			$imp = "<option value = '0'></option>";
			while($row = mysql_fetch_array($sql)){
				$imp .="<option value ='".$row['documento_empleado']."'>".$row['nombre_empleado']."</option>";
			}
			echo $imp;
		}
		public function modificar_empleado(){
			
		}
		
		public function eliminar_empleado(){
			
		}
		
		public function tabla_salarios_minimos_empresa($emp){
			$sql = mysql_query("select sal_minimo,year from administrativa where empresa = '$emp'");
			$tabla = "<table width = '100%' style = 'padding-left:20%;padding-right:20%;font-size:12px;'>
				<thead>
					<tr>
						<th>AÑO</th>
						<th>SALARIO MÍNIMO</th>
					</tr>
				</thead>
				<tbdoy>";
			while($row = mysql_fetch_array($sql)){
				$tabla .="<tr>
					<td align = 'center'>
						<input type = 'text' readonly value = '".$row['year']."' style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;padding:7px;border:0px solid white;width:80px;text-align:center;'/>
					</td>
					<td align = 'center'>
						<input type = 'text' readonly value = '$   ".number_format($row['sal_minimo'])."' style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;padding:7px;border:0px solid white;width:100px;text-align:right;'/>
					</td>
				</tr>";
			}
			return $tabla."</tbody></table>";
		}
		
		public function tabla_salarios_integral_empresa($emp){
			$sql = mysql_query("select sal_integral,year from administrativa where empresa = '$emp'");
			$tabla = "<table width = '100%' style = 'padding-left:20%;padding-right:20%;font-size:12px;'>
				<thead>
					<tr>
						<th>Año</th>
						<th>Salario Integral</th>
					</tr>
				</thead>
				<tbdoy>";
			while($row = mysql_fetch_array($sql)){
				$tabla .="<tr>
					<td align = 'center'>
						<input type = 'text' readonly value = '".$row['year']."' style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;padding:7px;border:0px solid white;width:80px;text-align:center;'/>
					</td>
					<td align = 'center'>
						<input type = 'text' readonly value = '$   ".number_format($row['sal_integral'])."' style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;padding:7px;border:0px solid white;width:100px;text-align:right;'/>
					</td>
				</tr>";
			}
			return $tabla."</tbody></table>";
		}
		
		public function tabla_aux_transporte_empresa($emp){
			$sql = mysql_query("select aux_transporte,year from administrativa where empresa = '$emp'");
			$tabla = "<table width = '100%' style = 'padding-left:20%;padding-right:20%;font-size:12px;'>
				<thead>
					<tr>
						<th>Año</th>
						<th>Auxilio de Transporte</th>
					</tr>
				</thead>
				<tbdoy>";
			while($row = mysql_fetch_array($sql)){
				$tabla .="<tr>
					<td align = 'center'>
						<input type = 'text' readonly value = '".$row['year']."' style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;padding:7px;border:0px solid white;width:80px;text-align:center;'/>
					</td>
					<td align = 'center'>
						<input type = 'text' readonly value = '$   ".number_format($row['aux_transporte'])."' style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;padding:7px;border:0px solid white;width:100px;text-align:right;'/>
					</td>
				</tr>";
			}
			return $tabla."</tbody></table>";
		}
		
		public function tabla_monetizacion_sena_empresa($emp){
			$sql = mysql_query("select valor,periodo,resolucion from monetizacion_sena where empresa = '$emp'");
			$tabla = "<table width = '100%' style = 'padding-left:20%;padding-right:20%;font-size:12px;'>
				<thead>
					<tr>
						<th>Periodo</th>
						<th>Valor</th>
						<th>Resolución</th>
					</tr>
				</thead>
				<tbdoy>";
			while($row = mysql_fetch_array($sql)){
				$tabla .="<tr>
					<td align = 'center'>
						<input type = 'text' readonly value = '".$row['periodo']."' style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;padding:7px;border:0px solid white;width:80px;text-align:center;'/>
					</td>
					<td align = 'center'>
						<input type = 'text' readonly value = '$   ".number_format($row['valor'])."' style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;padding:7px;border:0px solid white;width:100px;text-align:right;'/>
					</td>
					<td align = 'center'>
						<input type = 'text' readonly value = '".$row['resolucion']."' style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;padding:7px;border:0px solid white;text-align:left;'/>
					</td>
				</tr>";
			}
			return $tabla."</tbody></table>";
		}
		
		
		public function registro_salario_minimo($emp,$val){
			$year = date("Y");
			$sql = mysql_query("select sal_minimo from administrativa where empresa = '$emp' and year = '$year'");
			if(mysql_num_rows($sql) == 0){
				$insert = mysql_query("insert into administrativa(sal_minimo,empresa,year) values('".$val."','".$emp."','".$year."')");
				echo "SE HA REGISTRADO EL VALOR DEL SALARIO MÍNIMO PARA EL AÑO ".$year;
			}else{
				$sql2 = mysql_query("select sal_minimo from administrativa where empresa = '$emp' and year = '$year' and sal_minimo = '0'");
				if(mysql_num_rows($sql2) == 1){
					$update = mysql_query("update administrativa set sal_minimo = '$val' where empresa = '$emp' and year = '$year'");
					echo "SE HA REGISTRADO EL VALOR DEL SALARIO MÍNIMO PARA EL AÑO ".$year;
				}else{
					echo "YA SE HA REGISTRADO EL VALOR DEL SALARIO MÍNIMO PARA EL AÑO ".$year;
				}
			}
		}
		
		public function registro_salario_integral($emp,$val){
			$year = date("Y");
			$sql = mysql_query("select sal_integral from administrativa where empresa = '$emp' and year = '$year'");
			if(mysql_num_rows($sql) == 0){
				$insert = mysql_query("insert into administrativa(sal_integral,empresa,year) values('".$val."','".$emp."','".$year."')");
				echo "SE HA REGISTRADO EL VALOR DEL SALARIO MÍNIMO PARA EL AÑO ".$year;
			}else{
				$sql2 = mysql_query("select sal_integral from administrativa where empresa = '$emp' and year = '$year' and sal_integral = '0'");
				if(mysql_num_rows($sql2) == 1){
					$update = mysql_query("update administrativa set sal_integral = '$val' where empresa = '$emp' and year = '$year'");
					echo "SE HA REGISTRADO EL VALOR DEL SALARIO MÍNIMO PARA EL AÑO ".$year;
				}else{
					echo "YA SE HA REGISTRADO EL VALOR DEL SALARIO MÍNIMO PARA EL AÑO ".$year;
				}
			}
		}
		
		public function registro_aux_transporte($emp,$val){
			$year = date("Y");
			$sql = mysql_query("select aux_transporte from administrativa where empresa = '$emp' and year = '$year'");
			if(mysql_num_rows($sql) == 0){
				$insert = mysql_query("insert into administrativa(aux_transporte,empresa,year) values('".$val."','".$emp."','".$year."')");
				echo "SE HA REGISTRADO EL VALOR DEL SALARIO MÍNIMO PARA EL AÑO ".$year;
			}else{
				$sql2 = mysql_query("select aux_transporte from administrativa where empresa = '$emp' and year = '$year' and aux_transporte = '0'");
				if(mysql_num_rows($sql2) == 1){
					$update = mysql_query("update administrativa set aux_transporte = '$val' where empresa = '$emp' and year = '$year'");
					echo "SE HA REGISTRADO EL VALOR DEL SALARIO MÍNIMO PARA EL AÑO ".$year;
				}else{
					echo "YA SE HA REGISTRADO EL VALOR DEL SALARIO MÍNIMO PARA EL AÑO ".$year;
				}
			}
		}
		
		public function registro_monetizacion_sena($emp,$val,$rel,$usu,$fecha){
			$year = date("Y");
			$num_mes = floatval(date("m"));
			$periodo = "";
			if($num_mes < 7){
				$periodo = date("Y")."-1";
				$sql = mysql_query("select valor from monetizacion_sena where empresa = '$emp' and periodo = '$periodo'");
				if(mysql_num_rows($sql) == 0){
					$insert = mysql_query("insert into monetizacion_sena(valor,resolucion,periodo,fecha,usuario,empresa) 
					values('".$val."','".$rel."','".$periodo."','".$fecha."','".$usu."','".$emp."')");
					echo "SE HA REGISTRADO LA MONETIZACION SENA PARA EL SEMESTRE ".$periodo;
				}else{
					echo "YA SE HA REGISTRADO LA MONETIZACION SENA PARA EL SEMESTRE ".$periodo;
				}
			}else{
				$periodo = date("Y")."-2";
				$sql = mysql_query("select valor from monetizacion_sena where empresa = '$emp' and periodo = '$periodo'");
				if(mysql_num_rows($sql) == 0){
					$insert = mysql_query("insert into monetizacion_sena(valor,resolucion,periodo,fecha,usuario,empresa) 
					values('".$val."','".$rel."','".$periodo."','".$fecha."','".$usu."','".$emp."')");
					echo "SE HA REGISTRADO LA MONETIZACION SENA PARA EL PERIODO ".$periodo;
				}else{
					echo "YA SE HA REGISTRADO LA MONETIZACION SENA PARA EL SEMESTRE ".$periodo;
				}
			}
		}
		
		
		public function estructura_parametrizacion_salario_minimo($emp){
			$registros = $this->tabla_salarios_minimos_empresa($emp);
			$val1 = '"valor_sal_minimo"';
			$val2 = '"valor_sal_minimo_format"';
			$tabla = "<table width = '100%' style = 'border-spacing:5px;'>
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' onclick = 'ocultar_hijo_historico_sal_min()'>
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano'>HISTÓRICO</td>
							<td align = 'left' ><img src = '../images/iconos/mas_blanco.png' width = '30px' onclick = 'ocultar_nuevo_sal_minimo()'/></td>
						</table>
					</th>
				</tr>
				<tr id = 'contenedor_registros_salarios'>
					<td>$registros</td>
				</tr>
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' >Nuevo Salario Mínimo</th>
				</tr>
				<tr id = 'contenedor_nuevo_sal_minimo'  style = 'display:none;'>
					<td style = 'padding-left:15px;'>
						<table width = '100%' class = 'barra_busqueda'>
							<tr>
								<td>
									<p>Nueva Tarifa:</p>
									<input type = 'text' id = 'valor_sal_minimo' onkeyup = 'formatear_valor(event,$val1,$val2)' />
									<span class = 'hidde' id = 'valor_sal_minimo_format' ></span>
								</td>
							</tr>
							<tr><td></br></td></tr>
							<tr>
								<td>
									<span class = 'botton_verde' onclick = 'guardar_tarifa_sal_minimo()'>GUARDAR SALARIO MÍNIMO</span>
								</td>
							</tr>
							<tr><td></br></td></tr>
						</table>
					</td>
				</tr>
				
				";
			echo $tabla;
		}
		
		public function estructura_parametrizacion_salario_integral($emp){
			$registros = $this->tabla_salarios_integral_empresa($emp);
			$val1 = '"valor_sal_minimo"';
			$val2 = '"valor_sal_minimo_format"';
			$tabla = "<table width = '100%' style = 'border-spacing:5px;'>
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' onclick = 'ocultar_hijo_historico_sal_min()'>
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano'>HISTÓRICO</td>
							<td align = 'left' ><img src = '../images/iconos/mas_blanco.png' width = '30px' onclick = 'ocultar_nuevo_sal_minimo()'/></td>
						</table>
					</th>
				</tr>
				<tr id = 'contenedor_registros_salarios'>
					<td>$registros</td>
				</tr>
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' >Nuevo Salario Integral</th>
				</tr>
				<tr id = 'contenedor_nuevo_sal_minimo' style = 'display:none;'>
					<td style = 'padding-left:15px;'>
						<table width = '100%' class = 'barra_busqueda'>
							<tr>
								<td>
									<p>Nueva Tarifa:</p>
									<input type = 'text' id = 'valor_sal_minimo' onkeyup = 'formatear_valor(event,$val1,$val2)'/>
									<span class = 'hidde' id = 'valor_sal_minimo_format'></span>
								</td>
							</tr>
							<tr><td></br></td></tr>
							<tr>
								<td>
									<span class = 'botton_verde' onclick = 'guardar_tarifa_sal_integral()'>GUARDAR SALARIO INTEGRAL</span>
								</td>
							</tr>
							<tr><td></br></td></tr>
						</table>
					</td>
				</tr>
				
				";
			echo $tabla;
		}
		
		public function estructura_parametrizacion_aux_transporte($emp){
			$registros = $this->tabla_aux_transporte_empresa($emp);
			$val1 = '"valor_sal_minimo"';
			$val2 = '"valor_sal_minimo_format"';
			$tabla = "<table width = '100%' style = 'border-spacing:5px;'>
				
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' onclick = 'ocultar_hijo_historico_sal_min()'>
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano'>HISTÓRICO</td>
							<td align = 'left' ><img src = '../images/iconos/mas_blanco.png' width = '30px' onclick = 'ocultar_nuevo_sal_minimo()'/></td>
						</table>
					</th>
				</tr>
				<tr id = 'contenedor_registros_salarios' >
					<td>$registros</td>
				</tr>
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' style = 'padding-left:20px;' id = 'ppto_anual_nuevo' onclick = 'ocultar_nuevo_sal_minimo()'>Nuevo Auxilio de Transporte</th>
				</tr>
				<tr id = 'contenedor_nuevo_sal_minimo' style = 'display:none;'>
					<td style = 'padding-left:15px;'>
						<table width = '100%' class = 'barra_busqueda'>
							<tr>
								<td>
									<p>Nueva Tarifa:</p>
									<input type = 'text' id = 'valor_sal_minimo' onkeyup = 'formatear_valor(event,$val1,$val2)'/>
									<span class = 'hidde' id = 'valor_sal_minimo_format'></span>
								</td>
							</tr>
							<tr><td></br></td></tr>
							<tr>
								<td>
									<span class = 'botton_verde' onclick = 'guardar_tarifa_aux_transporte()'>GUARDAR AUXILIO DE TRANSPORTE</span>
								</td>
							</tr>
							<tr><td></br></td></tr>
						</table>
					</td>
				</tr>";
			echo $tabla;
		}
	
		public function estructura_parametrizacion_mon_sena($emp){
			$registros = $this->tabla_monetizacion_sena_empresa($emp);
			$val1 = '"valor_sal_minimo"';
			$val2 = '"valor_sal_minimo_format"';
			$tabla = "<table width = '100%' style = 'border-spacing:5px;'>
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' onclick = 'ocultar_hijo_historico_sal_min()'>
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano'>HISTÓRICO</td>
							<td align = 'left' ><img src = '../images/iconos/mas_blanco.png' width = '30px' onclick = 'ocultar_nuevo_sal_minimo()'/></td>
						</table>
					</th>
				</tr>
				<tr id = 'contenedor_registros_salarios' >
					<td>$registros</td>
				</tr>
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' style = 'padding-left:20px;' id = 'ppto_anual_nuevo' onclick = 'ocultar_nuevo_sal_minimo()'>Nueva Monetización Sena</th>
				</tr>
				<tr id = 'contenedor_nuevo_sal_minimo' style = 'display:none;'>
					<td style = 'padding-left:15px;'>
						<table width = '100%' class = 'barra_busqueda'>
							<tr>
								<td>
									<p>Nueva Tarifa:</p>
									<input type = 'text' id = 'valor_sal_minimo' onkeyup = 'formatear_valor(event,$val1,$val2)'/>
									<span class = 'hidde' id = 'valor_sal_minimo_format'></span>
								</td>
								<td>
									<p>Resolución:</p>
									<input type = 'text' id = 'rel_sena' />
								</td>
							</tr>
							<tr><td></br></td></tr>
							<tr>
								<td>
									<span class = 'botton_verde' onclick = 'guardar_tarifa_monetizacion_sena()'>GUARDAR MONETIZACIÓN SENA</span>
								</td>
							</tr>
							<tr><td></br></td></tr>
						</table>
					</td>
				</tr>
				
				";
			echo $tabla;
		}
	
	}
?>

