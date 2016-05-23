<?php 
	class tareas_ot{//Por cada Tatrea creo una carpeta donde pueda agregar 1 presupuesto y muchas imágnes
		//Tiene un consecutivo normal, pero cuando busco las tareas de la OT me traigo el codigo
		public $codigo_tarea;
		public $codigo_area;
		public $codigo_responsable;
		public $codigo_asignado;
		public $asignado;
		public $fecha_prometida;
		public $hora;
		public $minutos;
		public $formato;
		public $trabajo;
		public $descripcion;
		public $razon_demora;
		public $pk_codigo_ot;
		public $pk_tipo_tarea;
		public $estado_tarea;
		
		//Flujo de Tareas
		public $tarea_padre;
		public $num_tarea_real;
		public $estado_flujo_tarea;
		
		
		public function get_tarea_padre(){
			return $this->tarea_padre;
		}
		public function set_tarea_padre($ta){
			$this->tarea_padre = $ta;
		}
		public function get_num_tarea_real(){
			return $this->num_tarea_real;
		}
		public function set_num_tarea_real($num_tarea){
			$this->num_tarea_real = $num_tarea;
		}
		public function get_estado_flujo_tarea(){
			return $this->estado_flujo_tarea;
		}
		public function set_estado_flijo_tarea($est_flujo){
			$this->estado_flujo_tarea = $est_flujo;
		}
		
		
		public function get_codigo_tarea_tarea(){
			return $this->codigo_tarea;
		}
		public function set_codigo_tarea_tarea($cod_tarea){
			$this->codigo_tarea = $cod_tarea;
		}
		public function get_codigo_area_tarea(){
			return $this->codigo_area;
		}
		public function set_codigo_area_tarea($area){
			$this->codigo_area = $area;
		}
		public function get_codigo_responsable_tarea(){
			return $this->codigo_responsable;
		}
		public function set_codigo_responsable_tarea($responsable){
			$this->codigo_responsable = $responsable;
		}
		public function get_codigo_asignado_tarea(){
			return $this->codigo_asignado;
		}
		public function set_codigo_asignado_tarea($asignado2){
			$this->codigo_asignado = $asignado2;
		}
		
		public function get_asignado(){
			return $this->asignado;
		}
		public function set_asignado($asig){
			$this->asignado = $asig;
		}
		
		public function get_fecha_promedita_tarea(){
			return $this->fecha_prometida;
		}
		public function set_fecha_prometida_tarea($fecha){
			$this->fecha_prometida = $fecha;
		}
		public function get_hora_tarea(){
			return $this->hora;
		}
		public function set_hora_tarea($hours){
			$this->hora = $hours;
		}
		public function get_minutos_tarea(){
			return $this->minutos;
		}
		public function set_minutos_tarea($minute){
			$this->minutos = $minute;
		}
		public function get_formato_hora_tarea(){
			return $this->formato;
		}
		public function set_formato_hora_tarea($format){
			$this->formato = $format;
		}
		public function get_trabajo_tarea(){
			return $this->trabajo;
		}
		public function set_trabajo_tarea($job){
			$this->trabajo = $job;
		}
		public function get_descripcion_tarea(){
			return $this->descripcion;
		}
		public function set_descripcion_tarea($desc){
			$this->descripcion = $desc;
		}
		public function get_razon_demora_tarea(){
			return $this->razon_demora;
		}
		public function set_razon_demora_tarea($razon){
			$this->razon_demora = $razon;
		}
		public function get_codigo_ot_tarea(){
			return $this->pk_codigo_ot;
		}
		public function set_codigo_ot_tarea($ot){
			$this->pk_codigo_ot = $ot;
		}
		public function get_tipo_tarea_tarea(){
			return $this->pk_tipo_tarea;
		}
		public function set_tipo_tarea_tarea($tip_tarea){
			$this->pk_tipo_tarea = $tip_tarea;
		}
		public function get_estado_tarea(){
			return $this->estado_tarea;
		}
		public function set_estado_tarea($est){
			$this->estado_tarea = $est;
		}
		
		
		public function codigo_automatico_tarea(){
			$consulta = "select max( codigo_int_tarea) as id from tareas";
			$result = mysql_query($consulta);
			$contador = 0;
			while($row = mysql_fetch_array($result)){
				$contador = $row['id'];
			}
			return $contador+1;
		}
		
		public function codigo_hijo_tarea($numero,$tipo){
			$x = $this->get_codigo_ot_tarea();
			$consulta = "select * from flujo_tareas where tipo ='$tipo' and ot = '$x' and num_tarea = '$numero' ";
			$result = mysql_query($consulta);
			$contador = 1;
			while($row = mysql_fetch_array($result)){
				$contador++;
			}
			return $contador+1;
		}
		
		Public function cambiar_estado_tarea($id,$f){
			$sql = mysql_query("update tareas set estado = '1' where codigo_int_tarea = '$id'");	
			
		}

		public function actualizar_respuesta($id,$f,$h,$user){
			$sql = mysql_query("update tareas set fecha_r = '$f',hora_r = '$h',userr = '$user' where codigo_int_tarea = '$id'");
		}
		
		public function cancelar_tareas($id){
			$sql = mysql_query("update tareas set estado = '2' where codigo_int_tarea = '$id'");
		}
		
		public function insert_tarea($usuario, $fecha_registro,$numero,$tipo,$hora,$hm,$pro_colpatria){
			$x = $this->get_codigo_ot_tarea();
			$consulta = "select otpadre from tareas where otpadre = '$x'";
			$result = mysql_query($consulta);
			$num = 0;
			while($row = mysql_fetch_array($result)){
				$num++;
			}
			if($num == 0){
				$num = 1;
			}else{
				$num++;
			}
			$insert = "INSERT into tareas(pro_colpatria,codigo_int_tarea,codigo_tarea,codigo_departamento,codigo_responsable,codigo_asignado,asignado,fecha_prometida,hora_p,minutos_p,formato,trabajo,descripcion,razon_demora,estado,usuario,fecha_registro,hora,pk_ot,otpadre,tipo_tarea_codigo_tipotarea,hm_registro) 
			values ('".$pro_colpatria."','".$numero."','".$num."','".$this->get_codigo_area_tarea()."','".$this->get_codigo_responsable_tarea()."','".$this->get_codigo_asignado_tarea()."','".$this->get_asignado()."','".$this->get_fecha_promedita_tarea()."','".
			$this->get_hora_tarea()."','".$this->get_minutos_tarea()."','".$this->get_formato_hora_tarea()."','".$this->get_trabajo_tarea()."','".$this->get_descripcion_tarea().
			"','".$this->get_razon_demora_tarea()."','".$this->get_estado_tarea()."','".$usuario."','".$fecha_registro."','".$hora."','".$this->get_codigo_ot_tarea()."','".$this->get_codigo_ot_tarea()."','".$this->get_tipo_tarea_tarea()."','".$hm."')";
			
			$x_num = $this->codigo_hijo_tarea($numero,$tipo);
			$es = 1;
			$xxx = "";
			$insert2 = "insert into flujo_tareas(codigo,tipo,ot,num_tarea,pk_tarea) 
			values('".$xxx."','".$tipo."','".$x."','".$num."','".$numero."')";
			mysql_query("START TRANSACTION");			
				mysql_query($insert);
				mysql_query($insert2);
			mysql_query("COMMIT");
			
		}
	
	
		function tareas_pendientes($usu){
			return 0;
		}
		public function consultar_ppto_tarea($id){
			$sql = mysql_query("SELECT ppto from tareas where codigo_int_tarea = '$id'");
			while($row = mysql_fetch_array($sql)){
				return $row['ppto'];
			}
		}
		
		public function consultar_sino_ppto($id){
			$sql_flujo = mysql_query("SELECT ot,num_tarea from flujo_tareas where pk_tarea = '$id' and codigo <> 0");
			$ot = "";
			$num = "";
			while($row = mysql_fetch_array($sql_flujo)){
				$ot = $row['ot'];
				$num = $row['num_tarea'];
			}
			$sql_tareas = mysql_query("SELECT t.ppto 
				from tareas t, cabpresup p
				where t.ppto = p.codigo_presup and t.othijo = '$ot' and t.codigo_tarea = '$num'");
			if( mysql_num_rows($sql_tareas) == 0){
				echo 1;
			}else{
				echo 0;
			}
		}

		
		
		public function insert_tarea2($usuario, $fecha_registro,$numero,$tipo,$id,$hora,$pptoo,$hmilitar){
			$x = $this->get_codigo_ot_tarea();
			$conx = "select codigo from flujo_tareas where pk_tarea = '$id' and ot = '$x' and tipo = '$tipo'";
			$re = mysql_query($conx);
			$xy = 0;
			while($r = mysql_fetch_array($re)){
				$xy = $r['codigo'];
			}
			$xy++;
						
			$conx = "select num_tarea from flujo_tareas where pk_tarea = '$id'";
			$re = mysql_query($conx);
			$tarea_real = "";
			$tr = 0;
			while($r = mysql_fetch_array($re)){
				$tarea_real = $r['num_tarea'];
				$tr++;
			}
			
			$x_num = $this->codigo_hijo_tarea($numero,$tipo);
			$es = 1;
			$xxx = $tr;
			$insert2 = "insert into flujo_tareas(codigo,tipo,ot,num_tarea,pk_tarea) 
			values('".$xy."','".$tipo."','".$this->get_codigo_ot_tarea()."','".$tarea_real."','".$numero."')";
			$zsas = "";
			if($xxx == 0){
				$zsas = $tarea_real;
			}else{
				$zsas = $tarea_real++;
			}
			
			
			$insert = "insert into tareas(codigo_int_tarea,codigo_tarea,codigo_departamento,codigo_responsable,codigo_asignado,asignado,fecha_prometida,hora_p,minutos_p,formato,trabajo,descripcion,razon_demora,estado,usuario,fecha_registro,hora,pk_ot,othijo,tipo_tarea_codigo_tipotarea,ppto,hm_registro) 
			values ('".$numero."','".$zsas."',".$this->get_codigo_area_tarea().",'".$this->get_codigo_responsable_tarea()."','".$this->get_codigo_asignado_tarea()."','".$this->get_asignado()."','".$this->get_fecha_promedita_tarea()."','".
			$this->get_hora_tarea()."','".$this->get_minutos_tarea()."','".$this->get_formato_hora_tarea()."','".$this->get_trabajo_tarea()."','".$this->get_descripcion_tarea().
			"','".$this->get_razon_demora_tarea()."','".$this->get_estado_tarea()."','".$usuario."','".$fecha_registro."','".$hora."','".$this->get_codigo_ot_tarea()."','".$this->get_codigo_ot_tarea()."',".$this->get_tipo_tarea_tarea().",'".$pptoo."','".$hmilitar."')";
			mysql_query("START TRANSACTION");						
				mysql_query($insert);
				mysql_query($insert2);
			mysql_query("COMMIT");
			
		}
		
		public function listar_departamentos_usuario($id){
			$imp = "<option value = '0'>[SELECIONE]</option>";
			
			$sql_valida_camino = mysql_query("select estado
			from param_deptos_trafico
			where estado = 1");
			
			$consulta = "";
			if(mysql_num_rows($sql_valida_camino) == 0){
				$consulta = mysql_query("SELECT distinct ae.nombre_area_empresa, ae.codigo_interno_empresa 
				from area_empresa ae, empleado e, prespon pe, usuario u
				where ae.codigo_interno_empresa = e.pk_depto and u.pk_empleado = e.documento_empleado and pe.usuario = '$id' and pe.asignado = u.idusuario order by ae.nombre_area_empresa asc");
			}else{
				$consulta = mysql_query("SELECT distinct ae.name_depto as nombre_area_empresa, ae.id as codigo_interno_empresa 
				from deptos_trafico ae, prespon pe
				where pe.usuario = '$id' and pe.pk_depto = ae.id order by ae.name_depto asc");
			}
			
			while($row = mysql_fetch_array($consulta)){
				$imp.="<option value = '".$row['codigo_interno_empresa']."'>".$row['nombre_area_empresa']."</option>";
			}
			echo $imp;
		}
		
		public function listar_asignados($id,$depto){
			$sql = mysql_query("select e.nombre_empleado, p.asignado,u.idusuario
			from empleado e, usuario u, prespon p
			where p.usuario = '$id' and u.estado = 1 and p.pk_depto = '$depto' and p.asignado = u.idusuario and u.pk_empleado = e.documento_empleado order by e.nombre_empleado asc");
			$imp = "";
			while($row = mysql_fetch_array($sql)){
				$imp.="
					<div>
						<input type = 'checkbox' id = 'asig".$row['idusuario']."' name = 'asig_tarea[]' value = '".$row['idusuario']."' class = 'radio'/>
						<label for='asig".$row['idusuario']."' nowrap><span><span></span></span>".$row['nombre_empleado']."</label>
					</div>";
			}
			echo $imp;
		}
		
		public function listar_personas_tareas_mostrar($id,$rol){
			$sql = mysql_query("select e.nombre_empleado,asp.visto
			from empleado e, asignados_tareas asp,usuario u
			where asp.pk_tarea = '$id' and asp.pk_asignado = u.idusuario and u.pk_empleado = e.documento_empleado and u.estado = '1' and asp.tipo = '$rol'");
			$imp = "<table width = '100%'>";
			while($row = mysql_fetch_array($sql)){
				
				$imp.="
					<tr>
						<td nowrap style = 'padding-left:10px;'> -> ".$row['nombre_empleado']."</td>
						
					</tr>";
			}
			return $imp."</table>";
		}
		
		public function mostrar_tareas_contestadas_resumen($usu){
			$tabla = "<table  class = 'tablas_muestra_datos_tablas_trafico displaytc' width = '120%'>
				<thead>
					<tr>
						<th nowrap></th>
						<th nowrap>OT</th>
						<th nowrap># TAREA</th>
						<th nowrap>REFERENCIA</th>
						<th nowrap>TRABAJO</th>
						<th nowrap>FECHA</th>
					</tr>
				</thead><tbody>";
			$select = "select t.pk_ot, t.codigo_int_tarea,t.codigo_tarea, ft.codigo, ot.referencia,t.trabajo,t.fecha_prometida,ot.id as id_ot,
						t.usuario, ft.num_tarea
						from tareas t, flujo_tareas ft, cabot ot
						where t.codigo_int_tarea = ft.pk_tarea and t.usuario = '$usu' and (t.estado = '1') and ot.codigo_ot = t.pk_ot
						order by t.fecha_registro desc";
						
			$result = mysql_query($select);
			while($row = mysql_fetch_array($result)){
				$id = $row['codigo_int_tarea'];
				$id_ot = $row['id_ot'];
							
				$comp = "";
				if($row['codigo'] == 0){
					$comp = $row['num_tarea'];
				}else{
					$comp = $row['num_tarea'].".".$row['codigo'];
				}
				$tabla .="<tr>
					<td nowrap>
						<div>
							<input type = 'radio'  name = 'select_ot' value = '$id' id = 't_pendiente$id' onclick = 'visualizar_tarea_pendiente($id,$id_ot)' class = 'radio'/>
							<label for='t_pendiente$id'><span><span></span></span></label>
						</div>
					</td>
					<td align = 'center' nowrap>".$row['pk_ot']."</td>
					<td align = 'center' nowrap>".$comp."</td>
					<td align = 'center' nowrap>".strtoupper($row['referencia'])."</td>
					<td align = 'left' nowrap>".strtoupper($row['trabajo'])."</td>
					<td align = 'center' nowrap>".$row['fecha_prometida']."</td>
				</tr>";
			}			
			$tabla .="</tbody></table>";
			echo $tabla;
		}


		public function contar_tareas_nuevas($usu,$fecha){
			$nuevafecha = strtotime ( '-2 minutes' , strtotime ( $fecha ) ) ;
			$nuevafecha = date ( 'Y-m-d h:i:s' , $nuevafecha );
			$sql1 = mysql_query("
			select distinct (t.codigo_int_tarea)																	

			from tareas t, asignados_tareas ax
																	
			where t.estado = '0' and t.fecha_registro  > '$nuevafecha'  and

			t.codigo_int_tarea = ax.pk_tarea and

			ax.pk_asignado = '$usu' and( ax.tipo = 'RES' or ax.tipo = 'ASI')");
			echo mysql_num_rows($sql1);			
		}

		public function listar_tareas_calendario($usu,$fecha){
			$tabla = "";
			$sql_1=mysql_query("select distinct t.pk_ot, t.codigo_int_tarea,t.codigo_tarea, ft.codigo, ot.referencia,t.trabajo,t.fecha_registro as fecha_prometida,ot.id as id_ot,
			t.usuario, e2.nombre_empleado as radicado_por, ft.num_tarea,t.hora_p,t.formato,t.hm_registro,t.minutos_p
																	

			from tareas t, flujo_tareas ft, cabot ot, usuario u2, empleado e2, asignados_tareas ax
																	
			where t.codigo_int_tarea = ft.pk_tarea  and t.estado = '0' and ot.codigo_ot = t.pk_ot

			and t.usuario = u2.idusuario and u2.pk_empleado = e2.documento_empleado 

			and t.codigo_int_tarea = ax.pk_tarea  and ax.pk_ot =ot.id and

			ax.pk_asignado = '$usu' and ax.tipo = 'ASI'

			order by t.fecha_registro asc");
			while($trow = mysql_fetch_array($sql_1)){
				$id_tareaa = $trow['codigo_int_tarea'];
				$sql_info_res = mysql_query("select pk_asignado from asignados_tareas where pk_tarea = '$id_tareaa' and tipo = 'RES' and pk_asignado = '$usuario_actual'");
				$id = $trow['codigo_int_tarea'];
				$id_ot = $trow['id_ot'];
				$responsables = "";
				$asignados = "";
				$sql_res = mysql_query("select e.nombre_empleado as responsable,ax.tipo
				from tareas t, usuario u, asignados_tareas ax, empleado e
				where t.codigo_int_tarea ='$id' and t.codigo_int_tarea = ax.pk_tarea and ax.pk_asignado = u.idusuario 
				and u.pk_empleado = e.documento_empleado");
				while($xrow = mysql_fetch_array($sql_res)){
					if($xrow['tipo'] == 'RES'){
						$responsables .=$xrow['responsable']."</br>";
					}else{
						$asignados .=$xrow['responsable']."</br>";	
					}
				}
				$id = $trow['codigo_int_tarea'];
				$id_ot = $trow['id_ot'];
				$comp = "";
				if($trow['codigo'] == 0){
					$comp = $trow['num_tarea'];
				}else{
					$comp = $trow['num_tarea'].".".$trow['codigo'];
				}
				$ffhora = $this->cambiar_formato_hora($trow['hora_p'],$trow['formato']);

				$fregistro = explode(" ",$trow['hm_registro']);
				$hora2 = $fregistro[0]."T".$fregistro[1];
				$tabla .= "<->".strtoupper($trow['referencia']." # TAREA ".$comp)."*---*".$trow['fecha_prometida']."T".$ffhora.":".$trow['minutos_p'].":00*---*".$hora2."*---*#3a87ad*---*false";
			}

			$fecha = explode("-",$fecha);
			
			$sql_cumple = mysql_query("select nombre_empleado, month(fecha_nacimiento) as mes, day(fecha_nacimiento) as dia from empleado where  month(fecha_nacimiento) = '".date("m")."' and estado = '1'");
			while($row = mysql_fetch_array($sql_cumple)){
				$temp_fecha = date("Y-m")."-".$row['dia']." 00:00:00";
				$nuevafecha  = strtotime ( '+1 day' , strtotime ( $temp_fecha ) );
				$d = $row['dia'];
				if($d < 10){
					$d = "0$d";
				}else{
					$d = "$d";
				}
				//$tabla .= "<->".date ( 'Y-m-d' , $nuevafecha )."*---*".date("Y")."-".date("m")."-".$d."*---*".$temp_fecha.""."*---*#EF8C14*---*true";
				$tabla .= "<->".strtoupper($row['nombre_empleado'])."*---*".date("Y")."-".date("m")."-".$d."*---*".date("Y")."-".date("m")."-".$d."*---*#EF8C14*---*true";
			}
			echo $tabla;				
		}

		public function cambiar_formato_hora($hora,$formato){
			if($formato == "pm"){
				return floatval($hora)+12;
			}else{
				return $hora;
			}
		}
		
		public function depto_responder_taras($id_tarea,$id){
			
			$sql_valida_camino = mysql_query("select estado
			from param_deptos_trafico
			where estado = 1");
			
			$sql_depto = "";
			if(mysql_num_rows($sql_valida_camino) == 0){
				$sql_depto = mysql_query("select ae.codigo_interno_empresa
				from tareas t, usuario u, empleado e, area_empresa ae
				where t.codigo_int_tarea = '$id_tarea' and t.usuario = u.idusuario and u.pk_empleado = e.documento_empleado and
				e.pk_depto = ae.codigo_interno_empresa");
			}else{
				$sql_depto = mysql_query("select ae.id as codigo_interno_empresa
				from tareas t, deptos_trafico ae
				where t.codigo_int_tarea = $id_tarea and t.codigo_departamento = ae.id");
			}
			
			$deptoo = "";
			while($row = mysql_fetch_array($sql_depto)){
				$deptoo = $row['codigo_interno_empresa'];
			}
			$imp = "<option value = '0'>[SELECIONE]</option>";
			
			$consulta = "";
			$sql_valida_camino = mysql_query("select estado
			from param_deptos_trafico
			where estado = 1");
			if(mysql_num_rows($sql_valida_camino) == 0){
				$consulta =mysql_query("SELECT distinct ae.nombre_area_empresa, ae.codigo_interno_empresa 
				from area_empresa ae, empleado e, prespon pe, usuario u
				where ae.codigo_interno_empresa = e.pk_depto and u.pk_empleado = e.documento_empleado and pe.usuario = $id and pe.asignado = u.idusuario order by ae.nombre_area_empresa asc");
			}else{
				$consulta =mysql_query("SELECT distinct ae.name_depto as nombre_area_empresa, ae.id as codigo_interno_empresa 
				from deptos_trafico ae, prespon pe
				where pe.usuario = '$id' and pe.pk_depto = ae.id order by ae.name_depto asc");
			}
			
			
			while($row = mysql_fetch_array($consulta)){
				if($row['codigo_interno_empresa'] == $deptoo){
					$imp.="<option value = '".$row['codigo_interno_empresa']."' selected>".$row['nombre_area_empresa']."</option>";
				}else{
					$imp.="<option value = '".$row['codigo_interno_empresa']."'>".$row['nombre_area_empresa']."</option>";
				}
				
			}
			echo $imp;
		}
		
		/*TAREAS PENDIENTES*/
		public function mostrar_tareas_pendientes_resumen($usu){
			$tabla = "<table  class = 'tablas_muestra_datos_tablas_trafico display2' width = '100%'>
				<thead>
					<tr>
						<th nowrap></th>
						<th nowrap>OT</th>
						<th nowrap># TAREA</th>
						<th nowrap>REFERENCIA</th>
						<th nowrap>TRABAJO</th>
						<th nowrap>RADICADO POR</th>
						<th nowrap>RESPONSABLE</th>
						<th nowrap>ASIGNADO</th>
						<th nowrap>FECHA</th>
					</tr>
				</thead><tbody>";
			
			$sql_1=mysql_query("select distinct t.pk_ot, t.codigo_int_tarea,t.codigo_tarea, ft.codigo, ot.referencia,t.trabajo,t.fecha_registro as fecha_prometida,ot.id as id_ot,
			t.usuario, e2.nombre_empleado as radicado_por, ft.num_tarea
																	

			from tareas t, flujo_tareas ft, cabot ot, usuario u2, empleado e2, asignados_tareas ax
																	
			where t.codigo_int_tarea = ft.pk_tarea  and t.estado = '0' and ot.codigo_ot = t.pk_ot

			and t.usuario = u2.idusuario and u2.pk_empleado = e2.documento_empleado 

			and t.codigo_int_tarea = ax.pk_tarea  and ax.pk_ot =ot.id and ot.estado = '1' and

			ax.pk_asignado = '$usu' and( ax.tipo = 'RES' or ax.tipo = 'ASI')

			order by t.fecha_registro asc");
			$tt = 1;
			while($trow = mysql_fetch_array($sql_1)){
				$id_tareaa = $trow['codigo_int_tarea'];
				$sql_info_res = mysql_query("select pk_asignado from asignados_tareas where pk_tarea = '$id_tareaa' and tipo = 'RES' and pk_asignado = '$usu'");
				$id = $trow['codigo_int_tarea'];
				$id_ot = $trow['id_ot'];
				$responsables = "";
				$asignados = "";
				$sql_res = mysql_query("select e.nombre_empleado as responsable,ax.tipo
				from tareas t, usuario u, asignados_tareas ax, empleado e
				where t.codigo_int_tarea ='$id' and t.codigo_int_tarea = ax.pk_tarea and ax.pk_asignado = u.idusuario 
				and u.pk_empleado = e.documento_empleado");
				while($xrow = mysql_fetch_array($sql_res)){
					if($xrow['tipo'] == 'RES'){
						$responsables .=$xrow['responsable']."</br>";
					}else{
						$asignados .=$xrow['responsable']."</br>";	
					}
				}
				$comp = "";
				if($trow['codigo'] == 0){
					$comp = $trow['num_tarea'];
				}else{
					$comp = $trow['num_tarea'].".".$trow['codigo'];
				}
				$tabla .="<tr>
					<td align = 'center' nowrap>
						<input type = 'radio'  name = 'select_ot' value = '$id' id = 't_pendiente$id' onclick = 'visualizar_tarea_pendiente($id,$id_ot)' class = 'radio'/>
						<label for='t_pendiente$id'><span><span></span></span></label>
					</td>
					<td align = 'center' nowrap>$tt ".$trow['pk_ot']."</td>
					<td style = 'text-align:left;padding-left:10px;' nowrap>".$comp."</td>
					<td style = 'text-align:left;padding-left:10px;' nowrap>".strtr(strtoupper(($trow['referencia'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
					<td style = 'text-align:left;padding-left:10px;' nowrap>".strtr(strtoupper(($trow['trabajo'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
					<td style = 'text-align:left;padding-left:10px;' nowrap>".utf8_decode($trow['radicado_por'])."</td>
					<td style = 'text-align:left;padding-left:10px;' nowrap>".$responsables."</td>
					<td style = 'text-align:left;padding-left:10px;' nowrap>".$asignados."</td>
					<td style = 'text-align:left;padding-left:10px;' nowrap>".$trow['fecha_prometida']."</td>
				</tr>";
				$tt++;
			}
			
			$tabla .="</tbody></table>
			<script type = 'text/javascript'>
					$('.display2').DataTable( {
						'language':'//cdn.datatables.net/plug-ins/1.10.10/i18n/Spanish.json',
						'paging':false
					});
					$('.dataTables_filter,.dataTables_length,.dataTables_info').hide();
				</script>
			";
			echo $tabla;
		}
		
		public function mostrar_tareas_pendientes_resumenx($usu){
			$tabla = "<table  class = 'tablas_muestra_datos_tablas_trafico display2' width = '120%'>
				<thead>
					<tr>
						<th nowrap></th>
						<th nowrap>OT</th>
						<th nowrap># TAREA</th>
						<th nowrap>REFERENCIA</th>
						<th nowrap>TRABAJO</th>
						<th nowrap>RADICADO POR</th>
						<th nowrap>RESPONSABLE</th>
						<th nowrap>ASIGNADO</th>
						<th nowrap>FECHA</th>
					</tr>
				</thead><tbody>";
			$sql1 = mysql_query("select e.nombre_empleado,ax.pk_asignado
				from asignados_tareas ax, usuario u, empleado e
				where ax.pk_asignado = u.idusuario and u.pk_empleado = e.documento_empleado  and ax.tipo = 'ASI' and ax.pk_asignado = '$usu'");
				
				if(mysql_num_rows($sql1) == 0){
					$sql2 = mysql_query("select e.nombre_empleado,ax.pk_asignado
					from asignados_tareas ax, usuario u, empleado e
					where ax.pk_asignado = u.idusuario and u.pk_empleado = e.documento_empleado and  ax.tipo = 'RES' and ax.pk_asignado = '$usu'");
					
					if(mysql_num_rows($sql2) == 0){
						$color="black";
						$img = "../images/iconos/icon-25.png";
						$even = "";
					}else{
						$select = "select t.pk_ot, t.codigo_int_tarea,t.codigo_tarea, ft.codigo, e.nombre_empleado, ot.referencia,t.trabajo,t.fecha_prometida,ot.id as id_ot,
						t.usuario, e2.nombre_empleado as radicado_por, ft.num_tarea
						from tareas t, flujo_tareas ft, asignados_tareas ax, empleado e, usuario u, cabot ot, usuario u2, empleado e2
						where t.codigo_int_tarea = ft.pk_tarea and t.codigo_int_tarea = ax.pk_tarea and ax.pk_asignado = u.idusuario and
						u.pk_empleado = e.documento_empleado and ax.pk_asignado = '$usu' and t.estado = '0' and  ax.tipo = 'RES' and ot.codigo_ot = t.pk_ot
						and t.usuario = u2.idusuario and u2.pk_empleado = e2.documento_empleado";
						
						$result = mysql_query($select);
						while($row = mysql_fetch_array($result)){
							$id = $row['codigo_int_tarea'];
							$id_ot = $row['id_ot'];
							$responsables = "";
							$sql_res = mysql_query("select e.nombre_empleado as responsable
							from tareas t, usuario u, asignados_tareas ax, empleado e
							where t.codigo_int_tarea ='$id' and t.codigo_int_tarea = ax.pk_tarea and ax.pk_asignado = u.idusuario 
							and u.pk_empleado = e.documento_empleado and ax.tipo = 'RES'");
							while($xrow = mysql_fetch_array($sql_res)){
								$responsables .=$xrow['responsable']."</br>";
							}	
						}
					}
				}else{
					$select = "select t.pk_ot, t.codigo_int_tarea,t.codigo_tarea, ft.codigo, e.nombre_empleado, ot.referencia,t.trabajo,t.fecha_prometida,
						t.usuario, e2.nombre_empleado as radicado_por, ft.num_tarea,ot.id as id_ot
						from tareas t, flujo_tareas ft, asignados_tareas ax, empleado e, usuario u, cabot ot, usuario u2, empleado e2
						where t.codigo_int_tarea = ft.pk_tarea and t.codigo_int_tarea = ax.pk_tarea and ax.pk_asignado = u.idusuario and
						u.pk_empleado = e.documento_empleado and ax.pk_asignado = '$usu' and t.estado = '0' and  ax.tipo = 'ASI' and ot.codigo_ot = t.pk_ot
						and t.usuario = u2.idusuario and u2.pk_empleado = e2.documento_empleado";
						
						$result = mysql_query($select);
						while($row = mysql_fetch_array($result)){
							$contador_x;
						}
				}
			
			$tabla .="</tbody></table>";
			echo $tabla;
		}
		
		
		public function insert_personas_asires($personas,$tipo,$ot,$tarea){
			mysql_query("START TRANSACTION");
			mysql_query("insert into asignados_tareas(tipo,pk_ot,pk_asignado,pk_tarea) values('".$tipo."','".$ot."','".$personas."','".$tarea."')");
			
			mysql_query("COMMIT");
			
		}
		
		public function listar_correos_copia($id){
			$correo = "";
			$condicion = "";
			for($i = 0; $i < count($id);$i++){
				if($i == 0){
					$condicion .= "(and u.idusuario = '$id[$i]' ";
				}else if($i > 0){
					$condicion .= "or u.idusuario = '$id[$i]' ";
				}
				
			}
			$sql = mysql_query("select e.email_empleado
				from empleado e, usuario u
				where u.pk_empleado = e.documento_empleado $condicion)");
				$registros = mysql_num_rows($sql);
				$x = 1;
			while($row = mysql_fetch_array($sql)){
				if($x < $registros){
					$correo.=$row['email_empleado'].",";
					$x++;
				}else{
					$correo.=$row['email_empleado'];
				}		
			}
			$correo.="\r\n";
			return $correo;
		}
		
		public function opcion_responder_tarea($usu,$ot,$id){
			
		}
		
		public function mostrar_responsables($depto){
			$sql = mysql_query("select distinct e.nombre_empleado,u.idusuario 
			from pasig p, empleado e, usuario u
			where p.pk_depto = '$depto' and p.usuario = u.idusuario and u.pk_empleado = e.documento_empleado and u.estado = 1 order by e.nombre_empleado asc");
			$imp = "<table width = '100%'>";
			while($row = mysql_fetch_array($sql)){
				$id = $row['idusuario'];
				//onclick = 'nouncheck($id)'
				$imp.="<tr>
						<td nowrap>
							<div >
								<input type = 'checkbox' id = 'respon".$row['idusuario']."' name = 'respon_tarea[]' value = '".$row['idusuario']."'  class = 'radio' />
								<label for='respon".$row['idusuario']."' nowrap><span><span></span></span>".$row['nombre_empleado']."</label>
							</div>
						</td>
					</tr>";
			}
			echo $imp."</table>";
		}
		
		
		public function mostrar_responsable_res($tarea,$depto,$id){
			
			$imp = "<table width = '100%' style = 'font-size:12px;'>";
			$sql = mysql_query("select distinct e.nombre_empleado,u.idusuario 
			from pasig p, empleado e, usuario u
			where p.pk_depto = '$depto' and p.usuario = u.idusuario and u.pk_empleado = e.documento_empleado and e.estado = '1' and u.estado = '1' order by e.nombre_empleado asc");
			$imp = "";
			while($row = mysql_fetch_array($sql)){
				$imp.="
					<tr>
						<td>
							<div>
								<input type = 'checkbox' id = 'respon".$row['idusuario']."' name = 'respon_tarea[]' value = '".$row['idusuario']."'  class = 'radio' />
								<label for='respon".$row['idusuario']."' nowrap><span><span></span></span>".$row['nombre_empleado']."</label>
							</div>
						</td>
					</tr>";
			}
			echo $imp;
		}
		
		
		public function tipo_tarea_select($tarea){
			$sql_res = mysql_query("select tipo_tarea_codigo_tipotarea,trabajo,fecha_prometida 
			from tareas where codigo_int_tarea = '$tarea' ");
			$resp = "";
			$trabajo = "";
			$fecha_prometida = "";
			while($row = mysql_fetch_array($sql_res)){
				$resp = $row['tipo_tarea_codigo_tipotarea'];
				$trabajo = $row['trabajo'];
				$fecha_prometida = $row['fecha_prometida'];
			}
			$sql = mysql_query("select name_ttarea, codigo_tipotarea from tipo_tarea order by name_ttarea asc");
			$imp = "";
			while($row = mysql_fetch_array($sql)){
				if($resp == $row['codigo_tipotarea']){
					$imp.="<option value = '".$row['codigo_tipotarea']."' selected>".utf8_encode($row['name_ttarea'])."</option>";
				}else{
					$imp.="<option value = '".$row['codigo_tipotarea']."'>".utf8_encode($row['name_ttarea'])."</option>";
				}
			}
			
			echo $imp."<+++***>$trabajo<+++***>$fecha_prometida";
		}
		
		public function mostrar_responsable_asi($tarea,$id,$depto){
			$sql_res = mysql_query("select usuario from tareas where codigo_int_tarea = '$tarea'");
			$resp = "";
			while($row = mysql_fetch_array($sql_res)){
				$resp = $row['usuario'];
			}
			/*$depto = "";
			$depto_tarea = mysql_query("select codigo_departamento from tareas where codigo_int_tarea = '$tarea'");
			while($row = mysql_fetch_array($depto_tarea)){
				$depto = $row['codigo_departamento'];
			}*/
			$sql = mysql_query("select e.nombre_empleado, p.asignado,u.idusuario
			from empleado e, usuario u, prespon p
			where p.usuario = '$id' and p.pk_depto = '$depto' and p.asignado = u.idusuario and u.pk_empleado = e.documento_empleado order by e.nombre_empleado asc");
			$imp = "<table width = '100%' style = 'font-size:12px;'>";
			while($row = mysql_fetch_array($sql)){
				if($row['idusuario'] == $resp){
					$imp.="
						<tr>
							<td>
								<div>
									<input type = 'checkbox' id = 'asig".$row['idusuario']."' name = 'asig_tarea[]' value = '".$row['idusuario']."' class = 'radio' checked/>
									<label for='asig".$row['idusuario']."' nowrap><span><span></span></span>".$row['nombre_empleado']."</label>
								</div>
							</td>
						</tr>";
				}else{
					$imp.="
						<tr>
							<td>
								<div>
									<input type = 'checkbox' id = 'asig".$row['idusuario']."' name = 'asig_tarea[]' value = '".$row['idusuario']."' class = 'radio'/>
									<label for='asig".$row['idusuario']."' nowrap><span><span></span></span>".$row['nombre_empleado']."</label>
								</div>
							</td>
						</tr>";
				}
				
			}
			echo $imp."</table>";
			
		}
		
		/*
		public function estructura_taras($ot,$usu){
			$tabla = '<table   class = "tablas_muestra_datos_tablas_tareas display3" style = "padding-left:50px;" Width = "120%">
			<thead>
				<tr>
					<th nowrap align = "center"><img src = "../images/iconos/mas_blanco.png" width = "25px"></th><th nowrap ><img src = "../images/iconos/mas_blanco.png" width = "25px"></th><th nowrap ># AD</th><th nowrap># TAREA</th><th>FECHA</th><th>ESTADO</th><th>TRABAJO</th><th>DEPARTAMENTO</th><th>RESPONSABLE</th>
					<th>ASIGNADO</th><th nowrap>FECHA ENTREGA</th><th nowrap>HORA ENTREGA</th><th nowrap># PPTO</th><th nowrap>Fecha Rpta</th>
				</tr>
			</thead><tbody>';
		}
		*/
		
		public function estructura_tareas($ot,$usu){
			$tabla = '<table   class = "tablas_muestra_datos_tablas_tareas display3" style = "padding-left:50px;" Width = "120%">
			<thead>
				<tr>
					<th nowrap align = "center"><img src = "../images/iconos/mas_blanco.png" width = "25px"></th><th nowrap ><img src = "../images/iconos/mas_blanco.png" width = "25px"></th><th nowrap ># AD</th><th nowrap># TAREA</th><th>FECHA</th><th>ESTADO</th><th>TRABAJO</th><th>DEPARTAMENTO</th><th>RESPONSABLE</th>
					<th>ASIGNADO</th><th nowrap>FECHA ENTREGA</th><th nowrap>HORA ENTREGA</th><th nowrap># PPTO</th><th nowrap>Fecha Rpta</th>
				</tr>
			</thead><tbody>';
			
			
			
			$sql_valida_camino = mysql_query("select estado
			from param_deptos_trafico
			where estado = 1");
			
			$consulta = "";
			if(mysql_num_rows($sql_valida_camino) == 0){
				$consulta = "select distinct t.codigo_int_tarea,t.codigo_tarea,t.codigo_departamento,t.fecha_r,t.hora_r,t.ppto,t.codigo_responsable,t.asignado,
				t.usuario,t.codigo_asignado,t.fecha_prometida,t.hora_p,t.minutos_p,t.formato,t.trabajo,t.descripcion,t.razon_demora, ar.nombre_area_empresa,
				t.estado,t.fecha_registro, tr.codigo
				from tareas t, flujo_tareas tr , area_empresa ar
				where t.pk_ot = '$ot' and t.codigo_int_tarea= tr.pk_tarea and t.pk_ot = tr.ot and t.codigo_departamento = ar.codigo_interno_empresa order by t.codigo_tarea,t.fecha_registro asc  ";
			}else{
				$consulta = "select distinct t.codigo_int_tarea,t.codigo_tarea,t.codigo_departamento,t.fecha_r,t.hora_r,t.ppto,t.codigo_responsable,t.asignado,
				t.usuario,t.codigo_asignado,t.fecha_prometida,t.hora_p,t.minutos_p,t.formato,t.trabajo,t.descripcion,t.razon_demora, ar.name_depto as nombre_area_empresa,
				t.estado,t.fecha_registro, tr.codigo
				from tareas t, flujo_tareas tr , deptos_trafico ar
				where t.pk_ot = '$ot' and t.codigo_int_tarea= tr.pk_tarea and t.pk_ot = tr.ot and t.codigo_departamento = ar.id order by t.codigo_tarea asc  ";
			}
			
			$result = mysql_query($consulta);
			$descccc = "";
			while($row = mysql_fetch_array($result)){
				$ppto_id = $row['ppto'];
				$sql_pptos = mysql_query("SELECT referencia, numero_presupuesto from cabpresup where codigo_presup = '$ppto_id'");
				$texto_ppto = "";
				while($ppto_row = mysql_fetch_array($sql_pptos)){
					$texto_ppto = $ppto_row['numero_presupuesto']." - ".substr($ppto_row['referencia'],0,20);
				}
				$num_filas = 0;
				$id = $row['codigo_int_tarea'];
				$color = "";
				$clase = "";
				$img = "";
				$even = "";
				$cancelar = "";
				$asignados_tc = "<table width = '100%' class = 'sin_color'>";
				$sql_asig = mysql_query("select e.nombre_empleado,ax.pk_asignado,ax.visto,ax.fecha_visto
				from asignados_tareas ax, usuario u, empleado e
				where ax.pk_asignado = u.idusuario and u.pk_empleado = e.documento_empleado and ax.pk_tarea = '$id' and ax.tipo = 'ASI'");
				$num_filas = mysql_num_rows($sql_asig);
				while($rows = mysql_fetch_array($sql_asig)){
					$img = "";
					if($rows['visto'] == 1){
						$img.="<img src = '../images/iconos/ok_verde.png' title = 'Tarea Vista: ".$rows['fecha_visto']."' height = '25px'/>";
					}else{
						$img.="";
					}
					$asignados_tc .= "<tr style = 'background-color:transparent;'>
						<td nowrap style = 'text-align:left;'>".$rows['nombre_empleado']."</td>
						<td align = 'center'>$img</td>
					</tr>";
				}
				$asignados_tc.="</table>";
				
				$responsable_tc = "<table width = '100%' class = 'sin_color'>";
				$sql_asig = mysql_query("select e.nombre_empleado,ax.pk_asignado,ax.visto,ax.fecha_visto
				from asignados_tareas ax, usuario u, empleado e
				where ax.pk_asignado = u.idusuario and u.pk_empleado = e.documento_empleado and ax.pk_tarea = '$id' and ax.tipo = 'RES'");
				if($num_filas < mysql_num_rows($sql_asig)){
					$num_filas = mysql_num_rows($sql_asig);
				}
				while($rows = mysql_fetch_array($sql_asig)){
					$img = "";
					if($rows['visto'] == 1){
						$img.="<img src = '../images/iconos/ok_verde.png' title = 'Tarea Vista: ".$rows['fecha_visto']."' height = '25px'/>";
					}else{
						$img.="";
					}
					$responsable_tc .= "<tr style = 'background-color:transparent;'>
						<td nowrap style = 'text-align:left;'>".$rows['nombre_empleado']."</td>
						<td align = 'center'>$img</td>
					</tr>";
				}
				$responsable_tc.="</table>";
				$sql1 = mysql_query("select e.nombre_empleado,ax.pk_asignado
				from asignados_tareas ax, usuario u, empleado e
				where ax.pk_asignado = u.idusuario and u.pk_empleado = e.documento_empleado and ax.pk_tarea = '$id' and ax.tipo = 'ASI' and ax.pk_asignado = '$usu'");
				if(mysql_num_rows($sql1) == 0){
					$sql2 = mysql_query("select e.nombre_empleado,ax.pk_asignado
					from asignados_tareas ax, usuario u, empleado e
					where ax.pk_asignado = u.idusuario and u.pk_empleado = e.documento_empleado and ax.pk_tarea = '$id' and ax.tipo = 'RES' and ax.pk_asignado = '$usu'");
					if(mysql_num_rows($sql2) == 0){
						$color="#6ebbbc";
						$img = "../images/iconos/respondertarea1.png";
						$even = "";
					}else{
						
						$color = "rgb(80,184,72)";
						$img = "../images/iconos/respondertarea.png";
						$clase ="class = 'mano'";
						$even = "onclick = 'responder($id)'";
						$cancelar = "onclick = 'cancelar_tarea($id)'";
					}
				}else{
					$color = "#bac288";
					$img = "../images/iconos/respondertarea.png";
					$even = "onclick = 'responder($id)'";
					$cancelar = "onclick = 'cancelar_tarea($id)'";
					$clase ="class = 'mano'";
				}
								
				$val = "";
				if($row['codigo'] == 0){
					$val = "";
				}else{
					$val = ".".$row['codigo'];
				}
				
				$num_archivos = count(glob("../Process/OT/$ot/TAREAS/$id/{*.*}",GLOB_BRACE));
				$img_adjuntos = "";
				if($num_archivos != 0){
				$img_adjuntos = "<img src = '../images/cargando/adjunto.png' width = '15px' title = 'Esta tarea tiene $num_archivos adjuntos'/> $num_archivos";
				}
				$name_archivos = (glob("../Process/OT/$ot/TAREAS/$id/{*.*}",GLOB_BRACE));
				$name ="";
				$name2 ="";
				$clase2 = "";
				if(count($name_archivos) != 0){
					$name = explode("/",$name_archivos[0]);
					$name2= $name[6];
				}
				$estado_nombre = "";
				$fcolor = "black";
				if($row['estado'] == 0){
					$estado_nombre = "SIN RESPONDER";
					$clase2 ="class = 'mano'";
				}else if($row['estado'] == 1){
					$estado_nombre = "CONTESTADA";
					$cancelar = "";
					$even = "";
					$img = "../images/iconos/respondertarea1.png";
				}else if($row['estado'] == 2){
					$estado_nombre = "CANCELADA";
					$color = "#f07570";
					$even = "";
					$fcolor = "black";
					$cancelar = "";
				}else if($row['estado'] == 3){
					$estado_nombre = "FIN TAREA ".$row['codigo_tarea'];
					$color = "#dedede";
					$even = "";
					$cancelar = "";
				}
				/*<label for='tareaa$id' style = 'position:relative;top:0px;background-color:blue;margin:auto;vertical-align:top;'><span ><span style  = 'background-color:green;position:fixed;top:0px;'></span></span></label>*/
				/*<td align = 'center' ><img src = '$img' $even $clase/></td>*/
				$tabla .= "<tr id = $id style = 'background-color:$color;color:$fcolor;'>
					<td nowrap >
						<table class = 'sin_color'>
							<tr style = 'background-color:transparent;'>
								<td >
									<input type = 'radio'  name = 'select_tarea' id = 'tareaa$id' value = '$id' onclick = 'abrir_tareas($id)' class = 'radio mano' />
									<label for='tareaa$id' ><span ><span ></span></span></label>
								</td>
							</tr>
						</table>
					</td>
					<td align = 'center'><img src = '../images/iconos/mas_blanco.png' style = 'transform:  rotate(45deg);'$clase2 height = '25px' $cancelar /></td>
					
					<td align = 'center' nowrap>".$img_adjuntos."</td>
					
					<td align = 'center'>".$row['codigo_tarea'].$val."</td>
					<td align = 'center' nowrap>".$row['fecha_registro']."</td>
					<td align = 'center' nowrap>".$estado_nombre."</td>
					<td style = 'text-align:left;padding-left:10px;'>".($row['trabajo'])."</td>
					<td style = 'text-align:left;padding-left:10px;'>".$row['nombre_area_empresa']."</td>
					<td align = 'center'>".$responsable_tc."</td>
					<td align = 'center'>".$asignados_tc."</td>
					<td align = 'center' nowrap>".$row['fecha_prometida']."</td>
					<td align = 'center' nowrap>".$row['hora_p'].":".$row['minutos_p']." ".$row['formato']."</td>
					<td align = 'center' nowrap>".$texto_ppto."</td>
					<td align = 'center' nowrap>".$row['fecha_r']."</td>
				</tr>";
			}
			$tabla .="</tbody></table>";
			//$tabla .="</tbody></table>";
			
			echo $tabla;
		}
		
		public function actualizar_estado_tarea($id,$usu,$tipo,$fecha){
			$sql = mysql_query("select visto from asignados_tareas where pk_tarea = '$id' and tipo = '$tipo' and pk_asignado = '$usu' and visto = '1'");
			if(mysql_num_rows($sql) == 0){
				mysql_query("update asignados_tareas set visto = '1',fecha_visto = '$fecha' where pk_tarea = '$id' and tipo = '$tipo' and pk_asignado = '$usu'");
			}			
		}
		
		public function mostrar_logo_empresa_ot($cod){
			$x = "";
			$sql = mysql_query("select e.nombre_comercial_empresa,e.logo 
				from empresa e, tareas t, cabot ot
				where t.pk_ot = '$cod' and t.pk_ot = ot.codigo_ot and ot.pk_nit_empresa_ot = e.cod_interno_empresa");
			while($row = mysql_fetch_array($sql)){
				$x = "<img src = '../images/logos/".$row['logo']."' class = 'img_empresa'/>";
			}
			return $x;
		}

		public function mostrar_info_tarea($id,$usu,$pk_oot){
			$this->actualizar_estado_tarea($id,$usu,"RES",date("Y-m-d h:i:s"));
			$this->actualizar_estado_tarea($id,$usu,"ASI",date("Y-m-d h:i:s"));
			$tabla = "";
			
			$sql = "";
			
			$sql_valida_camino = mysql_query("select estado
			from param_deptos_trafico
			where estado = 1");
			
			$sql = "";
			if(mysql_num_rows($sql_valida_camino) == 0){
				$sql = mysql_query("select distinct t.codigo_int_tarea,t.codigo_tarea,t.codigo_departamento,t.fecha_r,t.hora_r,t.ppto,t.codigo_responsable,t.asignado,
				t.usuario,t.codigo_asignado,t.fecha_prometida,t.hora_p,t.minutos_p,t.formato,t.trabajo,t.descripcion,t.razon_demora, ar.nombre_area_empresa,t.pk_ot,
				t.estado,t.fecha_registro, tr.codigo,tpt.codigo_tipotarea, tpt.name_ttarea,ar.codigo_interno_empresa,t.usuario, radir.nombre_empleado as radicada_por
				from tareas t, flujo_tareas tr , area_empresa  ar,tipo_tarea tpt, usuario r, empleado radir
				where t.codigo_int_tarea= tr.pk_tarea and t.codigo_departamento = ar.codigo_interno_empresa and
				t.tipo_tarea_codigo_tipotarea = tpt.codigo_tipotarea and t.codigo_int_tarea = '$id' and t.usuario = r.idusuario and r.pk_empleado = radir.documento_empleado and t.pk_ot = tr.ot
				");
			}else{
				$sql = mysql_query("select distinct t.codigo_int_tarea,t.codigo_tarea,t.codigo_departamento,t.fecha_r,t.hora_r,t.ppto,t.codigo_responsable,t.asignado,
				t.usuario,t.codigo_asignado,t.fecha_prometida,t.hora_p,t.minutos_p,t.formato,t.trabajo,t.descripcion,t.razon_demora, ar.name_depto as nombre_area_empresa,t.pk_ot,
				t.estado,t.fecha_registro, tr.codigo,tpt.codigo_tipotarea, tpt.name_ttarea,ar.id as codigo_interno_empresa,t.usuario, radir.nombre_empleado as radicada_por
				
				from tareas t, flujo_tareas tr , deptos_trafico  ar,tipo_tarea tpt, usuario r, empleado radir
				where t.codigo_int_tarea= tr.pk_tarea and t.codigo_departamento = ar.id and
				t.tipo_tarea_codigo_tipotarea = tpt.codigo_tipotarea and t.codigo_int_tarea = '$id' and t.usuario = r.idusuario and r.pk_empleado = radir.documento_empleado and t.pk_ot = tr.ot
				");
			}
			
			
			
			while($row = mysql_fetch_array($sql)){
				
				$val = "";
				if($row['codigo'] == 0){
					$val = "";
				}else{
					$val = ".".$row['codigo'];
				}
			$clase = "";
			$even = "";
			$img = "";
			$style = "";
			$sql1 = mysql_query("select e.nombre_empleado,ax.pk_asignado
				from asignados_tareas ax, usuario u, empleado e
				where ax.pk_asignado = u.idusuario and u.pk_empleado = e.documento_empleado and ax.pk_tarea = '$id' and ax.tipo = 'ASI' and ax.pk_asignado = '$usu'");
			if(mysql_num_rows($sql1) == 0){
				$sql2 = mysql_query("select e.nombre_empleado,ax.pk_asignado
				from asignados_tareas ax, usuario u, empleado e
				where ax.pk_asignado = u.idusuario and u.pk_empleado = e.documento_empleado and ax.pk_tarea = '$id' and ax.tipo = 'RES' and ax.pk_asignado = '$usu'");
				if(mysql_num_rows($sql2) == 0){
					$img = "../images/iconos/icon-25.png";
					$style = "style = 'opacity:0.5;'";
					$even = "";
				}else{
					$img = "../images/iconos/icon-25.png";
					$clase ="mano";
					$even = "onclick = 'responder($id,$pk_oot)'";			
				}
			}else{
				$img = "../images/iconos/icon-25.png";
				$even = "onclick = 'responder($id,$pk_oot)'";
				$clase ="mano";
			}

			if($row['estado'] == 0){
			
			}else if($row['estado'] == 1 || $row['estado'] == 2 || $row['estado'] == 3){
				$even = "";
				$img = "../images/iconos/icon-25.png";
				$style = "style = 'opacity:0.5;'";
				$clase ="";
			}
				$asignados_x = $this->listar_personas_tareas_mostrar($id,"ASI");
				$responsables_x = $this->listar_personas_tareas_mostrar($id,"RES");
				$tabla.="
					<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td width = '96%' align = 'left'>
								<table width = '100%'>
									<tr>
										<td align = 'left'>
											".$this->mostrar_logo_empresa_ot($row['pk_ot'])."
										</td>
									</tr>
									<tr>
										<td align = 'left' >
											<span class = 'mensaje_bienvenida'>DETALLE OT ".$row['pk_ot'].", TAREA  ".$row['codigo_tarea'].$val." POR ".$row['radicada_por']." </span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right' >
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img $style $even src = '$img' class = 'iconos_opciones $clase' title = 'Reponder Tarea'/>
										</td>
										<td align = 'center'>
											<img  onclick = 'cerrar_ventana_detalle_tarea()' src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano' title = 'Cerrar Ventana'/>
										</td>
									</tr>
								</table>
							</td>
						</tr>
				</table>
				<div class ='scroll_nueva_ventana2'>
					
					<table class = 'tabla_nuevos_datos' width = '100%' >
						<tr>
							<td width = '32%' style = 'padding-left:50px;vertical-align:top;'>
								<p>Departamento:</p>
								<input  class = 'entradas_bordes' type = 'text' value = '".$row['nombre_area_empresa']."'readonly/>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td width = '32%' >
								<p>Responsable(s):</p>
								<div style = 'overflow-y:scroll;height:100px;background-color:rgb(224,225,226);border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;' >
									$responsables_x
								</div>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td width = '32%' style = 'padding-right:50px;' >			
								<p>Asignado(s):</p>
								<div style = 'overflow-y:scroll;height:100px;background-color:rgb(224,225,226);border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;' >
									$asignados_x
								</div>
							</td>
						</tr>
						<tr>
							<td width = '32%' style = 'padding-left:50px;'>
								<p>Fecha de Entrega:</p>
								<input  class = 'entradas_bordes' type = 'text' value = '".$row['fecha_prometida']."' readonly/>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td width = '32%'>
								<table width = '100%'>
									<tr>
										<td>
											<p>Hora:</p>
										</td>
										<td>
											<p>Minutos:</p>
										</td>
										<td>
											<p>Formato:</p>
										</td>
									</tr>
									<tr>
										<td style = 'width:50px;'>
											<input  class = 'entradas_bordes' type = 'text' value = '".$row['hora_p']."' readonly/>
										</td>
										<td style = 'padding-left:10px;width:50px;'>
											<input  class = 'entradas_bordes' type = 'text' value = '".$row['minutos_p']."' readonly/>
										</td>
										<td style = 'padding-left:10px;width:50px;'>
											<input  class = 'entradas_bordes' type = 'text' value = '".$row['formato']."' readonly/>
										</td>
									</tr>
								</table>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td width = '32%' style = 'padding-right:50px;'>
								<p>Tipo de Tarea:</p>
								<input  class = 'entradas_bordes' type = 'text' value = '".utf8_encode($row['name_ttarea'])."' readonly/>
							</td>
						</tr>
						<tr>
							<td width = '32%' style = 'padding-left:50px;'>
								<p>Título del Trabajo</p>
								<input  class = 'entradas_bordes' type = 'text' value = '".($row['trabajo'])."' readonly/>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td width = '32%' rowspan = '2' style = 'vertical-align:top;'>
								<table  width = '100%'>
									<tr>
										<td>
											<p>Archivos Adjuntos:</p>
										</td>
									</tr>
									<tr>
										<td width = '100%'>
											<div  style = 'overflow:scroll;background-color:white;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;width:100%;height:220px;'>
												".$this->mostrar_archivos_adjuntos($id)."
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td width = '32%' style = 'padding-left:50px;'>
								<p>Describa el Trabajo:</p>
								<textarea class = 'entradas_bordes' rows = '5' cols = '60' readonly>".$row['descripcion']."</textarea>
							</td>
							<td class = 'separator' width = '2%'></td>
							
						</tr>
					</table>
				</div>";
			}
			echo $tabla;
		}
		
		public function mostrar_archivos_adjuntos($id){
			$consulta = "select t.codigo_int_tarea,t.pk_ot
			from tareas t
			where t.codigo_int_tarea = '$id'";
			$result = mysql_query($consulta);
			$tabla = "<table width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>Nombre</th>
					<th>Descargar</th>
				</tr>";
			while($row = mysql_fetch_array($result)){
				$id = $row['codigo_int_tarea'];
				$ot = $row['pk_ot'];
				$num_archivos = count(glob("../Process/OT/$ot/TAREAS/$id/{*.*}",GLOB_BRACE));
				$name_archivos = (glob("../Process/OT/$ot/TAREAS/$id/{*.*}",GLOB_BRACE));
				for($i = 0; $i < $num_archivos;$i++){
					$name ="";
					$name2 ="";
					if(count($name_archivos) != 0){
						$name = explode("/",$name_archivos[$i]);
						$name2= $name[6];
					}
					$tabla.="<tr>
						<td >".$name2."</td>
						<td align = 'center'>
							<a  href = 'download_arc_tareas.php?ot=$ot&tarea=$id&archivo=$name2'>
								<img src = '../images/iconos/icono_descarga.png' class = 'icono_descarga mano'/>
							</a>
						</td>
					</tr>";
				}
			}
			return $tabla."</table>";
		}
		

		public function time_table_dias($usuario){
			
		}
		public function update_tarea($usuario, $fecha_registro){}
		public function drop_tarea($usuario, $fecha_registro){}
		
	}
?>