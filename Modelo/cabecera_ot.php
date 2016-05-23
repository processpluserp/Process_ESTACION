<?php

	/*
		Clase que controla toda la información de las OTs del sistema.
		OT: ORDEN DE TRABAJO.
		UNA OT SE COMPONE DE UNA EMRPESA, CLIENTE, PRODUCTO DEL CLIENTE, DIRECTOR, EJECUTIVO, REFERENCIA Y DESCRIPCIÓN.
		EL CÓDIGO DE LA OT SE COMPONE DE:
		INICIALES DEL CLIENTE: AVA.
		CONSECUTIVO DE 4 DIGITOS: 0001
		AÑO EN EL QUE SE CREA LA OT: 2015 -> 15
	*/
	class cabecera_ot{
		public $codigo; //Código de la OT: AVA0001-15;
		public $tipo_brief; //Código del tipo de brief.
		public $referencia; //Referencia de la OT.s
		public $descripcion; //Descripción OT.
		public $director; //Director.
		public $estado; //Estado: 1 -> ACTIVA; 2->INACTIVA.
		public $año; //Año en el que se crea la OT.
		public $ejecutivo; //Código del ejecutivo.
		public $ruta_breaf; //
		public $ruta_informe_entrevista;
		public $num_solicitud;//Datos de colpatria
		public $nombre_solicitud; //Datos Colpatria
		public $pk_empresa;
		public $pk_producto_cliente;
		public $pk_cliente;
		public $pk_profesional_colpatria;//Datos de colpatria
		public $pk_tipo_pieza_colpatria;//Datos de colpatria
		public $pk_objetivo_trabajo_colpatria;//Datos de colpatria
		public $pk_medio_colpatria;//Datos de colpatria
		
		//Modificadores de Acceso.
		public function get_codigo_cabecera_ot(){
			return $this->codigo;
		}
		public function set_codigo_cabecera_ot($cod){
			$this->codigo = $cod;
		}
		public function get_tipo_brief(){
			return $this->tipo_brief;
		}
		public function set_tipo_brief($brief){
			$this->tipo_brief = $brief;
		}
		public function get_referencia_cabecera_ot(){
			return $this->referencia;
		}
		public function set_referencia_cabecera_ot($href){
			$this->referencia = $href;
		}
		public function get_descripcion_cabecera_ot(){
			return $this->descripcion;
		}
		public function set_descripcion_cabecera_ot($desc){
			$this->descripcion = $desc;
		}
		public function get_director_cabecera_ot(){
			return $this->director;
		}
		public function set_director_cabecera_ot($direc){
			$this->director = $direc;
		}
		public function get_estado_cabecera_ot(){
			return $this->estado;
		}
		public function set_estado_cabecera_ot($std){
			$this->estado = $std;
		}
		public function get_año_cabecera_ot(){
			return $this->año;
		}
		public function set_año_cabecera_ot($year){
			$this->año = $year;
		}
		public function get_ejecutivo_cabecera_ot(){
			return $this->ejecutivo;
		}
		public function set_ejecutivo_cabecera_ot($ejec){
			$this->ejecutivo = $ejec;
		}
		
		public function get_numero_solicitud_cabecera_ot(){
			return $this->num_solicitud;
		}
		public function set_numero_solicitud_cabecera_ot($numero){
			$this->num_solicitud = $numero;
		}
		public function get_nombre_solicitud_cabecera_ot(){
			return $this->nombre_solicitud;
		}
		public function set_nombre_solicitud_cabecera_ot($nombre){
			$this->nombre_solicitud = $nombre;
		}
		public function get_empresa_cabecera_ot(){
			return $this->pk_empresa;
		}
		public function set_empresa_cabecera_ot($empresa){
			$this->pk_empresa = $empresa;
		}
		public function get_producto_cliente_cabecera_ot(){
			return $this->pk_producto_cliente;
		}
		public function set_producto_cliente_cabecera_ot($producto_cliente){
			$this->pk_producto_cliente = $producto_cliente;
		}
		public function get_cliente_cabecera_ot(){
			return $this->pk_cliente;
		}
		public function set_cliente_cabecera_ot($cliente){
			$this->pk_cliente = $cliente;
		}
		
		public function get_profecolpatria_cabecera_ot(){
			return $this->pk_profesional_colpatria;
		}
		public function set_profecolpatria_cabecera_ot($profesional_colpatria){
			$this->pk_profesional_colpatria = $profesional_colpatria;
		}
		public function get_pieza_colpatria_cabecera_ot(){
			return $this->pk_tipo_pieza_colpatria;
		}
		public function set_pieza_colpatria_cabecera_ot($pieza){
			$this->pk_tipo_pieza_colpatria = $pieza;
		}
		public function get_objtrabajo_colpatria_cabecera_ot(){
			return $this->pk_objetivo_trabajo_colpatria;
		}
		public function set_objtrabajo_colpatria_cabecera_ot($objetivo){
			$this->pk_objetivo_trabajo_colpatria = $objetivo;
		}
		public function get_medio_colpatria_cabecera_ot(){
			return $this->pk_medio_colpatria;
		}
		public function set_medio_colpatria_cabecera_ot($medio){
			$this->pk_medio_colpatria = $medio;
		}
		
		
		/*
			Método para guardar la información de un nuevo BRIEF.
			@param array $input Contiene la informaciónde los inputs del Brief.
			@param array $text Contiene la información de todos los text area de una brief.
			@param date $fecha fecha en la que se registra la información.
			@param int $usuario: Código de usuario.
			
			Si el tipo de brief que se está guardando no es el del cliente(1)
			Se ejecuta la segunda consulta que tiene los campos adicionales cuando son brief de creatrivos.
		
		*/
		
		public function campo_adicional_crear_tareas_colpatria($ot){
			$sql = mysql_query("select pro_colpatria_codigo_profesional from cabot where codigo_ot = '$ot'");
			$codigo = "";
			$imp="";
			while($row = mysql_fetch_array($sql)){
				$codigo = $row['pro_colpatria_codigo_profesional'];
				$sql_2 = mysql_query("select codigo_profesional,name_profesional from pro_colpatria order by name_profesional asc ");
				while($xrow = mysql_fetch_array($sql_2)){
					if($codigo == $xrow['codigo_profesional']){
						$imp .="<option value=".$xrow['codigo_profesional']." selected>". strtoupper(utf8_encode($xrow['name_profesional']))."</option>";
					}else{
						$imp .="<option value=".$xrow['codigo_profesional'].">". strtoupper(utf8_encode($xrow['name_profesional']))."</option>";
					}
					
				}
			}
			echo $imp;
		}
		
		public function insert_brief($input,$text,$fecha,$usuario){
			if($this->get_tipo_brief() == 1){
				$sql = mysql_query("insert into datos_brief(tipo,ot,producto,desarrollado,fecha_entrega,fechacreativa,1ra,2da,3ra,4ta,5ta,6ta,7ma,8va,9na,10ma,fecha_registro,usuario) values
				('".$this->get_tipo_brief()."','".$this->get_codigo_cabecera_ot()."','".$input[0]."','".$input[1]."','".date("Y-m-d H:i:s")."','".$input[3]."','".$text[0]."','".$text[1]."','".$text[2]."','".$text[3].
				"','".$text[4]."','".$text[5]."','".$text[6]."','".$text[7]."','".$text[8]."','".$text[9]."','".$fecha."','".$usuario."')");
				//ECHO "BRIEF GUARDADO !";
			}else if($this->get_tipo_brief() == 3){
				$sql = mysql_query("insert into datos_brief(tipo,ot,producto,desarrollado,fecha_entrega,fechacreativa,1ra,2da,3ra,4ta,5ta,6ta,insigh,beneficio,soporte,concepto,7ma,8va,9na,10ma,fecha_registro,usuario) values
				('".$this->get_tipo_brief()."','".$this->get_codigo_cabecera_ot()."','".$input[0]."','".$input[1]."','".date("Y-m-d H:i:s")."','".$input[3]."','".$text[0]."','".$text[1]."','".$text[2]."','".$text[3].
				"','".$text[4]."','".$text[5]."','".$text[6]."','".$text[7]."','".$text[8]."','".$text[9]."','".$text[10]."','".$text[11]."','".$text[12]."','".$text[13]."','".$fecha."','".$usuario."')");
				//echo "NO SE HAN GUARDADO LOS DATOS YA QUE NO HA SELECCIONADO NINGÚN BRIEF !";
			}else{
				$sql = mysql_query("insert into datos_brief(tipo,ot,producto,desarrollado,fecha_entrega,fechacreativa,1ra,2da,3ra,4ta,5ta,6ta,insigh,beneficio,soporte,concepto,7ma,8va,9na,10ma,fecha_registro,usuario) values
				('".$this->get_tipo_brief()."','".$this->get_codigo_cabecera_ot()."','".$input[0]."','".$input[1]."','".date("Y-m-d H:i:s")."','".$input[3]."','".$text[0]."','".$text[1]."','".$text[2]."','".$text[3].
				"','".$text[4]."','".$text[5]."','".$text[6]."','".$text[7]."','".$text[8]."','".$text[9]."','".$text[10]."','".$text[11]."','".$text[12]."','".$text[13]."','".$fecha."','".$usuario."')");
				//ECHO "BRIEF GUARDADO !";
			}
		}
		
		
		/*
			Se encarga de evaluar el noombre del brief según el valor ingresado.
			@param int $val Codigo del brief.
		*/
		public function tipo_brief_ot($val){
			$text = "";
			if($val == 0){
				$text .= "NO APLICA";
			}else if($val == 1){
				$text .= "CLIENTE";
			}else if($val == 2){
				$text .= "CREATIVO BTL";
			}else if($val == 3){
				$text .= "CREATIVO CRM";
			}else if($val == 4){
				$text .= "CREATIVO ATL";
			}else if($val == 5){
				$text .= "CREATIVO TRADE";
			}else if($val == 6){
				$text .= "CREATIVO TACTICO";
			}
			return $text;
		}
		
		/*
			Se encarga de modificar el estado de una OT a partir de la razón que justifique el Ejecutivo/Contabilidad.
			@param int $id Código de OT.
			@param int string $text Texto de razón cierre.
		*/
		
		public function update_razon_cierre_ot($id,$text){
			mysql_query("update cabot set razon_cierre = '$text',estado = '0' where id = '$id'");
		}
		
		/*
			Se encarga de consultar el código (AVA0001-15) a partir del id de la ot.
			@param int $id Codigo ot.
		*/
		public function numero_ot_por_id($id){
			$sql = mysql_query("select codigo_ot from cabot where id = '$id'");
			$ott = "";
			while($row = mysql_fetch_array($sql)){
				$ott = $row['codigo_ot'];
			}
			return $ott;

		}
		
		/*
			Muestra el logo de la empresa a partir del id.
			@param int $cod Código de la empresa.
		*/
		public function mostrar_logo_empresa($cod){
			$x = "";
			$sql = mysql_query("select nombre_comercial_empresa,logo from empresa where cod_interno_empresa = '$cod'");
			while($row = mysql_fetch_array($sql)){
				$x = "<img src = '../images/logos/".$row['logo']."' class = 'img_empresa'/>";
			}
			return $x;
		}
		
		/*
			INFORMACIÓN DE LA OT SELECCIONADA.
			@param int $id Código de la OT.
			Se encarga de mostrar la información del estado de la OT que se ha seleccionado.
		*/
		
		public function informacion_ot_seleccionada($id){
			$sql = mysql_query("select id,codigo_ot,referencia,estado from cabot where id = '$id'");
			$tabla = "<table width = 'auto'>";
			while($row = mysql_fetch_array($sql)){
				$sqlx = mysql_query("select codigo_presup from cabpresup where ot = '".$row['codigo_ot']."'");
				$contador_pptos = 0;
				while($xrow = mysql_fetch_array($sqlx)){
					$contador_pptos++;
				}
				
				$indicador = 0;
				if($contador_pptos != 0){
					$indicador = 1;
				}
				$img = "";
				if($row['estado'] == 1){
					$img .="<img src = '../images/iconos/activo.png' onclick = 'cerrar_ot_razon($id,$indicador)' title = 'OT Activa;¿Cerrar?' class = 'botones_opciones mano'/>";
				}else{
					$img .="<img src = '../images/iconos/inactivo.png' title = 'OT CERRADA' class = 'botones_opciones'/>";
				}
				$tabla .="<tr>
					<td>
						$img
					</td>
					<td ><span id = 'num_ot_sel'>".$row['codigo_ot']."</span> - ".strtr(strtoupper(($row['referencia'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
					
				</tr>";
			}
			echo $tabla."</table>";
		}
		/*
			Esta es la estructura de la ficha de las ots de colpatria.
		*/
		/*
		public function estructura_colpatria($ot){
			$tabla="";
			$sql2 = mysql_query("SELECT o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia,c.nombre_comercial_cliente, p.nombre_producto,o.tipo_brief,
				eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director, emp.nombre_comercial_empresa,
				o.num_solicitud,o.nombre_solicitud,proc.name_profesional, tpc.name_tpieza, mec.name_medio, objc.name_otrabajo, o.pk_nit_empresa_ot
						
				from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, empresa emp,
				pro_colpatria proc, tipo_pieza tpc, objtrabajo objc, medio mec
						
				where o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
				and o.id = '$ot' and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
				and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado and o.pk_nit_empresa_ot = emp.cod_interno_empresa and
				o.pro_colpatria_codigo_profesional = proc.codigo_profesional and o.tipo_pieza_codigo_tpieza = tpc.codigo_tpieza 
				and o.objtrabajo_codigo_objtrabajo = objc.codigo_objtrabajo and o.medio_codigo_medio = mec.codigo_medio");

			while($row = mysql_fetch_array($sql2)){
				$tabla.="
					<table width = '100%' >
						<tr>
							<td width = '96%' align = 'left'>
								<table width = '100%'>
									<tr>
										<td align = 'left'>
											".$this->mostrar_logo_empresa($row['pk_nit_empresa_ot'])."
										</td>
									</tr>
									<tr>
										<td align = 'left' style = 'padding-left:50px;'>
											<span class = 'mensaje_bienvenida'>DETALLE OT ".$row['codigo_ot']."</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right' style = 'padding-right:50px;'>
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img onclick = 'cerrar_ventana_detalle_ot()' src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano' title = 'Cerrar Ventana'/>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<div style = 'overflow:scroll;width:100%;height:80%;'>
					<table class = 'tabla_nuevos_datos' width = '100%' style = 'padding-right:50px;'>
						<tr>
							<td style = 'padding-left:50px;' width = '49%'>
								<p>EMPRESA:</p>
								<input type = 'text' class = 'entradas_bordes' readonly value = '".$row['nombre_comercial_empresa']."'/>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td >
								<p>CLIENTE:</p>
								<input type = 'text' class = 'entradas_bordes' readonly value = '".$row['nombre_comercial_cliente']."'/>
							</td>
						</tr>
						<tr>
							<td style = 'padding-left:50px;' width = '49%'>
								<p>EMPRESA:</p>
								<input type = 'text' class = 'entradas_bordes' readonly value = '".$row['nombre_comercial_empresa']."'/>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td >
								<p>CLIENTE:</p>
								<input type = 'text' class = 'entradas_bordes' readonly value = '".$row['nombre_comercial_cliente']."'/>
							</td>
						</tr>
						
						
						<tr>
							<td style = 'padding-left:50px;'>
								<P>REFERENCIA</P>
								<input type = 'text' class = 'entradas_bordes' readonly value = '".($row['referencia'])."'/>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td>
								<P>DESCRIPCION</P>
								<textarea rows = '5' cols = '40' class = 'entradas_bordes' type = 'text' readonly >".($row['descripcion'])."</textarea>
							</td>
						</tr>
					</table>
				</div>";
			}
			echo $tabla;
			
		}
		*/
		/*
			A partir del código de la ot carga la referencia y la descripción de la misma.
			@param int $id Codigo ot.
		*/
		public function referencia_descripcion_ot($id){
			$sql = mysql_query("select referencia,descripcion from cabot where id = '$id'");
			while($row = mysql_fetch_array($sql)){
				return $row['referencia']."__**__".$row['descripcion'];
			}
		}
		
		
		/*
			Traslada un brief de una OT a otra.
			@param string ot Código de la ot AVA0001-15
			@param string $n_ot Código de la nueva OT.
		*/
		public function traslado_brief($ot,$n_ot){
			$sql = mysql_query("select ot from datos_brief where ot = '$ot'");
			if(mysql_num_rows($sql) != 0){
				$update =mysql_query("update datos_brief set ot = '$n_ot' where ot = '$ot'");
			}
		}
		
		/*
			Se encarga de trasladar todos los registros de tareas de una OT a otra.
			@param string ot Código de la ot AVA0001-15
			@param string $n_ot Código de la nueva OT.
		*/

		public function traslado_tareas_ot($ot,$n_ot){
			$sql = mysql_query("select pk_ot from tareas where pk_ot = '$ot' or otpadre = '$ot'");
			if(mysql_num_rows($sql) !=0){
				$update = mysql_query("update tareas set pk_ot = '$n_ot', otpadre = '$n_ot' where pk_ot = '$ot' or otpadre = '$ot'");
			}

			$sql = mysql_query("select ot from flujo_tareas where ot = '$ot'");
			if(mysql_num_rows($sql) !=0){
				$update = mysql_query("update flujo_tareas set ot = '$n_ot'  where ot = '$ot'");
			}			
		}

		public function trasladar_pptos(){

		}
		
		/*Se encarga de modificar el encabezado de una ot ya creada.
			@param int $id codigo de la ot.
			@param int $clie codigo nuevo cliente.
			@param int $emp codigo nueva empresa.
			@param int $pro código del nuevo producto.
			@param string $ref Referencia de la OT.
			@param string $desc descripcion de la ot.
			@param string $n_ot nueva ot.
			@param string $v_ot vieja ot.
		*/
		public function traslado_ot($id,$clie,$emp,$pro,$ref,$desc,$n_ot,$v_ot){
			$update = mysql_query("update cabot set pk_nit_empresa_ot = '$emp', producto_clientes_pk_clientes_nit_procliente = '$clie',
			producto_clientes_codigo_PRC = '$pro', referencia = '$ref', descripcion = '$desc', codigo_ot = '$n_ot' where id = '$id'");
			rename("../Process/OT/$v_ot", "../Process/OT/$n_ot");
		}
		
		
		/*
			Se encarga de mostrar la información del encabezado de una ot.
			@param string $ot Codigo de la ot.
			@param sql $datax Omitir.
		*/
		public function estructura_ots($ot,$datax){
			$tabla="";
			$otx = $this->numero_ot_por_id($ot);
			$sql2 = mysql_query("SELECT o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia,c.nombre_comercial_cliente, p.nombre_producto,o.tipo_brief,
				eje.nombre_empleado as ejecutivox, dir.nombre_empleado as directorx, emp.nombre_comercial_empresa, o.pk_nit_empresa_ot
				
				from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, empresa emp
				
				where o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
				and o.codigo_ot = '$otx' and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
				and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado and o.pk_nit_empresa_ot = emp.cod_interno_empresa");
			$add = "";
			$sql_colpatria = mysql_query("SELECT o.num_solicitud,o.nombre_solicitud,proc.name_profesional, tpc.name_tpieza, mec.name_medio, objc.name_otrabajo 	
			 	from cabot o, pro_colpatria proc, tipo_pieza tpc, objtrabajo objc, medio mec			
				where o.codigo_ot = 'CLP0001-15' AND	o.pro_colpatria_codigo_profesional = proc.codigo_profesional and o.tipo_pieza_codigo_tpieza = tpc.codigo_tpieza 
				and o.objtrabajo_codigo_objtrabajo = objc.codigo_objtrabajo and o.medio_codigo_medio = mec.codigo_medio");
			/*if($datax == 1){
				while($rr = mysql_fetch_array($sql_colpatria)){
					$add .= "
					<tr >
						<td  style = 'padding-left:50px;'>
							<p>Número de Solicitud:</p>
							<input type = 'text' class = 'entradas_bordes' readonly value = '".$rr['num_solicitud']."'/>
						</td>
						<td class = 'separator' width = '2%'></td>
						<td>
							<p>Nombre Solicitud:</p>
							<input type = 'text' class = 'entradas_bordes' readonly value = '".$rr['nombre_solicitud']."'/>
						</td>
					</tr>
					<tr >
						<td style = 'padding-left:50px;'>
							<p>Profesional Colpatria:</p>
							<input type = 'text' class = 'entradas_bordes' readonly value = '".$rr['name_profesional']."'/>
						</td>
						<td class = 'separator' width = '2%'></td>
						<td >
							<p>Tipo de Pieza:</p>
							<input type = 'text'class = 'entradas_bordes'  readonly value = '".$rr['name_tpieza']."'/>
						</td>
					</tr>
					<tr >
						<td style = 'padding-left:50px;'>
							<p>Objetivo Trabajo:</p>
							<input type = 'text' class = 'entradas_bordes' readonly value = '".$rr['name_otrabajo']."'/>
						</td>
						<td class = 'separator' width = '2%'></td>
						<td>
							<p>Medio:</p>
							<input type = 'text' class = 'entradas_bordes' readonly value = '".$rr['name_medio']."'/>
						</td>
					</tr>";
				}
			}
			*/
			while($row = mysql_fetch_array($sql2)){
				$tabla.="
					<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td width = '96%' align = 'left'>
								<table width = '100%' >
									<tr>
										<td align = 'left'>
											".$this->mostrar_logo_empresa($row['pk_nit_empresa_ot'])."
										</td>
									</tr>
									<tr>
										<td align = 'left' >
											<span class = 'mensaje_bienvenida'>DETALLE OT ".$row['codigo_ot']."</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right' >
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img onclick = 'cerrar_ventana_detalle_ot()' src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano' title = 'Cerrar Ventana'/>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				<div style = 'overflow:scroll;width:100%;height:80%;' >
					<table class = 'tabla_nuevos_datos' width = '100%' style = 'padding-right:50px;'>
						<tr>
							<td style = 'padding-left:50px;' width = '49%'>
								<p>EMPRESA:</p>
								<input type = 'text' readonly class = 'entradas_bordes' value = '".$row['nombre_comercial_empresa']."' />
							</td>
							<td class = 'separator' width = '2%'></td>
							<td >
								<p>CLIENTE:</p>
								<input type = 'text' readonly class = 'entradas_bordes' value = '".$row['nombre_comercial_cliente']."' />
							</td>
						</tr>
						
						<tr>
							<td style = 'padding-left:50px;'>
								<p>EJECUTIVO:</p>
								<input type = 'text' readonly class = 'entradas_bordes' value = '".$row['ejecutivox']."' />
							</td>
							<td class = 'separator'></td>
							<td >
								<p>TIPO DE BRIEF:</p>
								<input type = 'text' readonly class = 'entradas_bordes' value = '".$this->tipo_brief_ot($row['tipo_brief'])."'/>
							</td>
						</tr>
						<tr>
							<td style = 'padding-left:50px;'>
								<p>REFERENCIA</p>
								<input type = 'text' readonly class = 'entradas_bordes' value = '".$row['referencia']."'/>
							</td>
							<td class = 'separator'></td>
							<td>
								<p>DESCRIPCION</p>
								<textarea rows = '5' cols = '40' class = 'entradas_bordes' type = 'text' readonly >".$row['descripcion']."</textarea>
							</td>
						</tr>
					</table>
				</div>";
			}
			echo $tabla;
		}
		
		
		
		public function mostrar_detalle_ot($ot){
			$sql = mysql_query("select producto_clientes_pk_clientes_nit_procliente from cabot where id = '$ot'");
			$ott = "";
			while($row = mysql_fetch_array($sql)){
				$ott = $row['producto_clientes_pk_clientes_nit_procliente'];
			}
			if($ott == 1){
				$this->estructura_ots($ot,1);
			}else{
				$this->estructura_ots($ot,0);
			}
		}
		
		/*
			Busca los pptos creados para la ot seleccionada.
			@param int $id Codigo de la ot.
		*/
		public function filtrar_ppto_por_ot($id){
			$ot = $this->mostrar_ot_por_id($id);
			$sql = mysql_query("SELECT codigo_presup, numero_presupuesto, referencia from cabpresup where ot = '$ot'");
			$table = "<table width = '100%' class = 'tablas_muestra_datos_tablas_tareas' style = 'padding-right:50px;padding-left:50px;'>
				<thead>
					<th nowrap></th>
					<th nowrap># PPTO</th>
					<th nowrap>REFERENCIA</th>
				</thead>
				<tbody>";
			while($row = mysql_fetch_array($sql)){
				$table .= "<tr>
					<td nowrap>
						<input type = 'radio'  name = 'select_ppto_t' id = 'ppto_t".$row['codigo_presup']."' value = '".$row['codigo_presup']."'  class = 'radio mano' />
						<label for='tareaa".$row['codigo_presup']."' ><span ><span ></span></span></label>
					</td>
					<td>".$row['numero_presupuesto']."</td>
					<td>".$row['referencia']."</td>
				</tr>";
			}
			echo $table."</tbody></table>";
		}
		
		/*
			Consulta el ultimo digito de la ot creada para un cliente, producto y empresa determinado y al final le añade un 1 para 
			la siguiente ot.
		*/
		public function consultar_datos_crear_ot($empresa,$cliente){
			$y = date("Y");
			$consulta = "select codigo_ot from cabot where year_ot = '$y' and pk_nit_empresa_ot = '$empresa' and producto_clientes_pk_clientes_nit_procliente = '$cliente'";
			$result = mysql_query($consulta);
			$numero = 0;
			while($row = mysql_fetch_array($result)){
				$numero++;
			}
			return $numero + 1;
		}
		
		
		/*
			Se encarga de crear la carpeta correspondiente al código de la OT.
		*/
		public function crear_carpeta_ot(){
			$destino = "../Process/OT/";
			if(file_exists($destino)){
				$destino ="../Process/OT/".$this->get_codigo_cabecera_ot();
				mkdir($destino);
				$destino ="../Process/OT/".$this->get_codigo_cabecera_ot()."/TAREAS";
				mkdir($destino);
			}
		}
		/*
			Se encarga de guardar en la BD la información de la nueva OT.
			Adicional, llama al método que se encarga de crear la carpeta de la OT.
		*/
		public function crear_carpeta_ot_normal($usuario){
			$insert = "INSERT INTO cabot(codigo_ot,tipo_brief,referencia,descripcion,director,estado,year_ot,ejecutivo,fecha_registro,usuario,pk_nit_empresa_ot,
			producto_clientes_codigo_PRC,producto_clientes_pk_clientes_nit_procliente) ";
			$insert .="values('".$this->get_codigo_cabecera_ot()."','".$this->get_tipo_brief()."','".$this->get_referencia_cabecera_ot()."','".$this->get_descripcion_cabecera_ot()."','".
			$this->get_director_cabecera_ot().
			"','".$this->get_estado_cabecera_ot()."','".$this->get_año_cabecera_ot()."','".$this->get_ejecutivo_cabecera_ot()."','".date("Y-m-d h:m:s")."','".
			$usuario."','".$this->get_empresa_cabecera_ot()."','".$this->get_producto_cliente_cabecera_ot()."','".$this->get_cliente_cabecera_ot()."')";
			$result = mysql_query($insert);
			$this->crear_carpeta_ot();
		}
		
		
		/*
			A través del ID, se encarga de consultar el código de la ot.
			@param int $id Código ot.
		*/
		public function mostrar_ot_por_id($id){
			$sql = mysql_query("select codigo_ot from cabot where id = '$id'");
			$ot = "";
			while($row = mysql_fetch_array($sql)){
				$ot = $row['codigo_ot'];
			}
			return $ot;
		}
		
		
		/*
			Se encarga de listar los correos de todas las personas que hay creadas en la plataforma para copiarlos en el caso de los informaes de entrevista.
		*/
		public function listar_asistentes_agencia($name){
			$sql = mysql_query("select documento_empleado,nombre_empleado,cargo_empleado,email_empleado 
			from empleado 
			where estado = '1' and nombre_empleado like '%$name%' 
			order by nombre_empleado asc;");
			$table = "<table  style = 'background-color:white;'class = 'displayxt'>";
			while($row = mysql_fetch_array($sql)){
				$id = $row['documento_empleado'];
				$table .="<tr>
					<td nowrap>
						<div>
							<input type = 'checkbox'  name = 'asis_empres_ie[]' id = '".$row['documento_empleado']."'value = '".$row['email_empleado']."' class = 'radio' onclick = 'add_asis_empresa_push($id)'/>
							<label style = 'font-size:12px;' for='".$row['documento_empleado']."' id = 'text".$row['documento_empleado']."'><span><span></span></span>".$row['nombre_empleado']."</label>
						</div>
					</td>
				</tr>";
			}
			echo $table."</tbody></table>";
		}
		public function listar_asistentes_agencia2($name){
			$sql = mysql_query("select documento_empleado,nombre_empleado,cargo_empleado,email_empleado 
			from empleado 
			where estado = '1' and nombre_empleado like '%$name%' 
			order by nombre_empleado asc;");
			$table = "<table  style = 'background-color:white;'class = 'displayxt'>";
			while($row = mysql_fetch_array($sql)){
				$id = $row['documento_empleado'];
				$table .="<tr>
					<td nowrap>
						<div>
							<input type = 'checkbox'  name = 'asis_empres_ie[]' id = '".$row['documento_empleado']."'value = '".$row['email_empleado']."' class = 'radio' onclick = 'add_asis_empresa_copiados_push($id)'/>
							<label style = 'font-size:12px;' for='".$row['documento_empleado']."' id = 'text".$row['documento_empleado']."'><span><span></span></span>".$row['nombre_empleado']."</label>
						</div>
					</td>
				</tr>";
			}
			echo $table."</tbody></table>";
		}
		/*
			Lista los asistentes de la agencia, esta vez no lo hace a través de un checkbox sino de un select.s
		*/
		public function listar_asistentes_agencia_option(){
			$sql = mysql_query("select documento_empleado,nombre_empleado,cargo_empleado,email_empleado from empleado where estado = '1' order by nombre_empleado asc;");
			$table = "<option value = '0'>[SELECCIONE]</option>";
			while($row = mysql_fetch_array($sql)){
				$table .="<option value = '".$row['email_empleado']."'>".$row['nombre_empleado']."</option>";
			}
			echo $table;
		}
		
		/*
			Contiene la estructura para mostrar las OTs que hay creadas en el sistema a partir de un sql
			@param sql $sql Contiene la sentencia correspondiente a las ots.
		*/
		public function mostrar_ots($sql){
			$tabla = "<table class = 'tablas_muestra_datos_tablas_trafico displayxt' style = 'padding-left:50px;' Width = '120%'>
				<thead>
					<tr>
						<th>I</th>
						<th>NUMERO</th>
						<th>REFERENCIA</th>
						<th>EJECUTIVO</th>
						<th>DIRECTOR</th>
						<th>CLIENTE</th>
						<th>PRODUCTO</th>
					</tr>
				</thead><tbody>";
			while($row = mysql_fetch_array($sql)){
				$color = "";
				$letra = "";
				$text = "";
				if($row['estado'] == 0){
					$color = "red";
					$letra = "white";
					$text = "CERRADA";
				}else{
					
				}
				$id = $row['codigo_ot'];
				$idot = explode("-",$id);
				$xx = $row['id'];
				$ott = $row['codigo_ot'];
				$tabla .="<tr id ='$xx' style = 'background-color:$color;color:$letra;'>
				<td align = 'center' nowrap>
					<div>
						<input type = 'radio'  name = 'select_ot' value = '$id' onclick = 'visualizar_tareas_ot($xx)' class = 'radio'/>
						<label for='$id'><span><span></span></span></label>
					</div>
				</td>
				<td align = 'center' class = 'ot mano' onclick = 'mostrar_descripcion($xx)' nowrap>".$row['codigo_ot']."</td>
				<td style = 'text-align:left;padding-left:10px;' nowrap>".strtr(strtoupper(($row['referencia'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
				<td style = 'text-align:left;padding-left:10px;' nowrap>".strtr(strtoupper(utf8_decode($row['ejecutivo'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
				<td style = 'text-align:left;padding-left:10px;' nowrap>".strtr(strtoupper(utf8_decode($row['director'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
				<td style = 'text-align:left;padding-left:10px;' nowrap>".strtr(strtoupper(utf8_decode($row['nombre_comercial_cliente'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
				<td style = 'text-align:left;padding-left:10px;' nowrap>".strtr(strtoupper(utf8_decode($row['nombre_producto'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
				
				</tr>";
				/*
					<td class = 'hidde'>".utf8_encode($row['descripcion'])."</td>
				<td class = 'hidde'>".$text."</td>
				*/
			}
			$tabla.="</tbody></table>
				<script type = 'text/javascript'>
					
				</script>
			";
			
			echo $tabla;
		}
		
		
		/*
			Muestra la grilla de la información de la OT que se acabó de crear.
			@param string $codigo_ot Codigo textual de la ot.
		*/
		public function mostrar_ot_creada($codigo_ot){
			$tabla = "
			<table  Width='100%' class = 'tablas_muestra_datos_tablas_trafico' style = 'padding-left:50px;padding-right:50px;'>
			<tr>
				<th>Info</th>
				<th>Numero</th>
				<th>Referencia</th>
				<th>Ejecutivo</th>
				<th>Director</th>
				<th>Cliente</th>
				<th>Producto</th>
			</tr>";
			$consulta = "SELECT o.codigo_ot, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,o.id,
				eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
				from cabot o, clientes c, producto_clientes p,empleado eje, usuario u1,empleado dir, usuario u2
				where o.producto_clientes_codigo_PRC = p.id_procliente and o.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente
				and o.codigo_ot = '$codigo_ot' and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
						and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado";
			$result = mysql_query($consulta);
			while($row = mysql_fetch_array($result)){
			$id = $row['id'];
			$xx = $row['id'];
			$tabla .="<tr id ='$id' >
			<td align = 'center' nowrap>
				<div>
					<input type = 'radio' name = 'select_ot' value = '$id' id = 'ot$id'onclick = 'visualizar_tareas_ot($id)'class = 'radio'/>
					<label for='ot$id'><span><span></span></span></label>
				</div>
			<td align = 'center' class = 'ot mano' onclick = 'mostrar_descripcion($xx)' nowrap>".$row['codigo_ot']."</td>
			<td style = 'text-align:left;padding-left:10px;' nowrap>".strtr(strtoupper(($row['referencia'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
				<td style = 'text-align:left;padding-left:10px;' nowrap>".strtr(strtoupper(utf8_decode($row['ejecutivo'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
				<td style = 'text-align:left;padding-left:10px;' nowrap>".strtr(strtoupper(utf8_decode($row['director'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
				<td style = 'text-align:left;padding-left:10px;' nowrap>".strtr(strtoupper(utf8_decode($row['nombre_comercial_cliente'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
				<td style = 'text-align:left;padding-left:10px;' nowrap>".strtr(strtoupper(utf8_decode($row['nombre_producto'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
			</tr>";
			}
			$tabla .="</table>";
			echo $tabla;
		}
		
		public function crear_carpeta_ot_colpatria($usuario){
			$insert = "INSERT INTO cabot(codigo_ot,tipo_brief,referencia,descripcion,director,estado,year_ot,ejecutivo,fecha_registro,usuario,pk_nit_empresa_ot,
			producto_clientes_codigo_PRC,producto_clientes_pk_clientes_nit_procliente,num_solicitud, nombre_solicitud,pro_colpatria_codigo_profesional,
			tipo_pieza_codigo_tpieza,objtrabajo_codigo_objtrabajo,medio_codigo_medio) ";
			$insert .="values('".$this->get_codigo_cabecera_ot()."','".$this->get_tipo_brief()."','".$this->get_referencia_cabecera_ot()."','".$this->get_descripcion_cabecera_ot()."','".
			$this->get_director_cabecera_ot().
			"','".$this->get_estado_cabecera_ot()."','".$this->get_año_cabecera_ot()."','".$this->get_ejecutivo_cabecera_ot()."','".date("Y-m-d h:m:s")."','".
			$usuario."','".$this->get_empresa_cabecera_ot()."','".$this->get_producto_cliente_cabecera_ot()."','".$this->get_cliente_cabecera_ot()."','".
			$this->get_numero_solicitud_cabecera_ot()."','".$this->get_nombre_solicitud_cabecera_ot()."','".$this->get_profecolpatria_cabecera_ot()."','".
			$this->get_pieza_colpatria_cabecera_ot()."','".$this->get_objtrabajo_colpatria_cabecera_ot()."','".$this->get_medio_colpatria_cabecera_ot()."')";
			$result = mysql_query($insert);
			$this->crear_carpeta_ot();
		}
		
		
		/*Lista a través de un select las ots creadas a partir de una Empresa, Cliente y Producto.
			@param int $empresa Codigo de la empresa.
			@param int $cliente Código de CLiente.
			@param int $producto Código del producto.
		*/
		public function listar_ots($empresa,$cliente,$producto){
			$imp = "<option value = '0'>[SELECCIONE]</option>";
			$sql = mysql_query("select codigo_ot,id,referencia
			from cabot
			where pk_nit_empresa_ot = '$empresa' and producto_clientes_codigo_PRC = '$producto' and 
			producto_clientes_pk_clientes_nit_procliente = '$cliente' order by id asc");
			while($row = mysql_fetch_array($sql)){
				$imp.="<option value = '".$row['id']."'>".$row['codigo_ot']." - ".strtoupper($row['referencia'])."</option>";
			}
			echo $imp;
		}
		
		public function adicionar_brief_estructura(){
			$tabla = "
				";
			echo $tabla;
		}
		/*
			Estructura Brief para pdf.
			@param int $id Código del id del brief que se va a exportar.
		*/
		public function brief($id){
			$sql = mysql_query("select b.*,c.nombre_legal_clientes,ot.codigo_ot, ot.referencia, pr.nombre_producto
			from datos_brief b,cabot ot, clientes c, producto_clientes pr
			where b.id_brief = '$id' and b.ot = ot.codigo_ot and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente and
			ot.producto_clientes_codigo_PRC = pr.id_procliente");
			
			$tabla = array();
			while($row = mysql_fetch_array($sql)){
				
				$tablatmp = array();
				$tmpArray = array();
				
				if($row['tipo'] == 3 && $row['fecha_registro'] > "2016-03-01"){
					$tmpArray[] = 'Cliente:';
					$tmpArray[] = $row['nombre_legal_clientes'];
					$tablatmp[] = $tmpArray;
					
					$tmpArray = array();
					
					$tmpArray[] = 'Nombre Proyecto:';
					$tmpArray[] = $row['referencia'];
					$tablatmp[] = $tmpArray;
					
					$tmpArray = array();
					
					$tmpArray[] = 'Producto:';
					$tmpArray[] = $row['nombre_producto'];
					$tablatmp[] = $tmpArray;
					
					$tmpArray = array();
					
					$tmpArray[] = 'Fecha de Realización:';
					$tmpArray[] = $row['fecha_registro'];
					$tablatmp[] = $tmpArray;
					
					$tmpArray = array();
					
					$tmpArray[] = 'Tipo de Proyecto:';
					$tmpArray[] = $row['producto'];
					$tablatmp[] = $tmpArray;
					
					$tmpArray = array();
					
					$tmpArray[] = 'Fecha Entrega Creativa:';
					$tmpArray[] = $row['fechacreativa'];
					$tablatmp[] = $tmpArray;
					
					$tabla[]=$tablatmp;
				
					$tablatmp = array();
					
					$tmpArray = array();
					
					$tmpArray[]='ANTECEDENTES';
					$tmpArray[]='Situación actual, problema que debemos resolver.';
					$tmpArray[]=$row['1ra'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='¿A QUIÉN LE VAMOS A HABLAR?';
					$tmpArray[]='Descripción de la audiencia y su perfil, quienes son, como son, que esperan.';
					$tmpArray[]=$row['2da'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='OBJETIVO DE MERCADEO';
					$tmpArray[]='¿Qué queremos lograr: ventas, posicionamiento, generación de Top of Heart?';
					$tmpArray[]=$row['3ra'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='POSICIONAMIENTO';
					$tmpArray[]='Idea de marca o atributos de producto a destacar.';
					$tmpArray[]=$row['4ta'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='OBJETIVO DE COMUNICACIÓN';
					$tmpArray[]='¿Qué queremos que la comunicación transmita al consumidor final?';
					$tmpArray[]=$row['5ta'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='ACTITUD';
					$tmpArray[]='¿Qué queremos que piense el público como resultado de la comunicación?';
					$tmpArray[]=$row['6ta'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='COMPORTAMIENTO DESEADO';
					$tmpArray[]='¿Qué queremos que haga el público como resultado de la comunicación?';
					$tmpArray[]=$row['insigh'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='¿A QUIEN VA DIRIGIDA ESTA CAMPAÑA DIRECTA?';
					$tmpArray[]='';
					$tmpArray[]=$row['beneficio'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='DESCRIPCION ACTIVIDAD';
					$tmpArray[]='Mecánica a utilizar y detalles generales, piezas.';
					$tmpArray[]=$row['soporte'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='TONO Y MANERA';
					$tmpArray[]='';
					$tmpArray[]=$row['concepto'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='MANDATORIOS';
					$tmpArray[]='';
					$tmpArray[]=$row['7ma'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='PIEZAS CREATIVAS';
					$tmpArray[]='';
					$tmpArray[]=$row['8va'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='COMO MEDIREMOS LOS RESULTADOS';
					$tmpArray[]='Cronogramas, creatividad, ventas, cantidad de diseños.';
					$tmpArray[]=$row['9na'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='OBSERVACIONES';
					$tmpArray[]='';
					$tmpArray[]=$row['10ma'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
				}else{
					$tmpArray[] = 'Producto o Marca:';
					$tmpArray[] = $row['producto'];
					
					$tablatmp[] = $tmpArray;
					
					$tmpArray = array();
					
					$tmpArray[] = 'Desarrollado Por:';
					$tmpArray[] = $row['desarrollado'];
					
					$tablatmp[] = $tmpArray;
					
					$tmpArray = array();
					
					$tmpArray[] = 'Fecha de Elaboración:';
					$tmpArray[] = $row['fecha_entrega'];
					
					$tablatmp[] = $tmpArray;
					
					$tmpArray = array();
					
					$tmpArray[] = 'Fecha de Entrega Creativa:';
					$tmpArray[] = $row['fechacreativa'];
					
					$tablatmp[] = $tmpArray;
					
					$tabla[]=$tablatmp;
				
					
					$tablatmp = array();
					
					$tmpArray = array();
					
					$tmpArray[]='¿Por qué se va hacer la actividad ?';
					$tmpArray[]='¿Cuál es la situación por la que pasa la marca?, se describe brevemente que pasa conel
					entorno competitivo-mercado, lo que se ha hecho en el pasado?';
					$tmpArray[]=$row['1ra'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='Descripción del Producto';
					$tmpArray[]='Describa el producto o servicio, cuáles son los atributos y sus características.';
					$tmpArray[]=$row['2da'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='Beneficio del Producto:';
					$tmpArray[]='Cómo los atributos del producto se convierten en beneficios para el consumidor.';
					$tmpArray[]=$row['3ra'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='Objetivo de Mercadeo:';
					$tmpArray[]='Qué tengo que solucionar en terminos de Mercadeo, Cuál es la oportunidad que tiene
					la marca? Ventas-Unidades-Posiconamiento, Leads.';
					$tmpArray[]=$row['4ta'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='Objetivo de Comunicación.';
					$tmpArray[]='¿Qué queremos que la audiencia piense y haga ?</br>La tarea de comunicación: Qué queremos que la 
					gente piense y haga despues de ver la comunicación. Es el resultado ideal de la comunicación esperado
					y confirmado en el comportamiento de las personas. Que queremos que la gente piense o haga con esta campaña
					o pieza creativa?';
					$tmpArray[]=$row['5ta'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='¿A quién va dirigida esta Campaña ?';
					$tmpArray[]='A quién/quiénes van dirigidos los esfuerzos de comunicación. Una breve descripcion que incluya insights, estamos
					describiendo personas, no cifras. campaña o pieza creativa?';
					$tmpArray[]=$row['6ta'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='Insigh Clave:';
					$tmpArray[]='Son barreras o motivaciones o creencias universales que definen el comportamiento del consumidor.';
					$tmpArray[]=$row['insigh'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='Beneficio:';
					$tmpArray[]='¿Qué tiene la marca o servicio para solucionar el Insight?';
					$tmpArray[]=$row['beneficio'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='Soporte:';
					$tmpArray[]='Lo que hace creíble lo que hay que decir. Qué hace creíble el mensaje que le voy a dar a la audiencia.';
					$tmpArray[]=$row['soporte'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='Concepto Estratégico:';
					$tmpArray[]='BIG IDEA, La carne para el creativo:  En una sola frase definimos cuál es ese único mensaje que hará que
					las personas "hagan" algo por la marca.';
					$tmpArray[]=$row['concepto'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='Entregables:';
					$tmpArray[]='¿Dónde lo vamos a comunicar? Acciones y/o medios. Dependiendo de la unidad de negocio se debe ampliar esta 
					información con hoja anexa.';
					$tmpArray[]=$row['7ma'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='Mandatarios Ejecucionales:';
					$tmpArray[]='Cosas que son obligatorias al momento de desarrollar la acción o campaña en términos de tono, manera, lo que
					es y no es la marca.';
					$tmpArray[]=$row['8va'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='Fecha al Aire:';
					$tmpArray[]='Cuándo debe estar este proyecto, trabajo, campaña al aire en medios.';
					$tmpArray[]=$row['9na'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
					
					$tmpArray[]='Presupuesto';
					$tmpArray[]='Cuánto dinero tenemos para estar aterrizados desde el principio.';
					$tmpArray[]=$row['10ma'];
					
					$tablatmp[]=$tmpArray;
					$tmpArray = array();
				}
							
				break;
					
			}
			
			$tabla[] = $tablatmp;
			
			return $tabla;
			
		}
		
		
		/*
			Se encarga de consultar el correo de la persona que está creado el informe de entrevista.
			@param int $id Código del usuario.
		*/
		public function correo_usuario($id){
			$sql = mysql_query("select e.email_empleado from empleado e, usuario u where u.pk_empleado = e.documento_empleado and u.idusuario = '$id'");
			while($row = mysql_fetch_array($sql)){
				return $row['email_empleado'];
			}
		}
		/*
			Se encarga de guardar en la base de datos el informe de entrevista que se sube a una ot.
			IE: INFORME DE ENTREVISTA
			@param int $empresa Código de la empresa.
			@param int $cliente Código del Cliente.
			@param int $inf_general Información general de IE.
			@param string $comp_agencia Compromisos por parte de la agencia.
			@param string $comp_cliente Compromisos por parte del cliente.
			@param date $fecha Fecha de registro.
			@param int $usuario Código de usuario.
			@param string $ot Código textual de la ot.
			@param date $fecha_r Fecha de la reunión.
			@param string $lugar_r Lugar de la reuinión.
			@param string $hora_i HorA inicial de la reuinión.
			@param string $hora_f Hora Final de la reunión.
		*/
		public function guardar_informe_entrevista_ot($tipo,$name,$tipo_entrevista,$fecha_reunion,$lugar,$hora_i,$hora_f,$inf_general,$ot,$asis_emp,$asis_clie,$comp_agencia,$comp_cliente,$fecha,$usuario,$inf_no_cliente,$temas){
			$sql = mysql_query("select producto_clientes_pk_clientes_nit_procliente as cliente from cabot where codigo_ot = '$ot'");
			$cliente = "";
			while($row  = mysql_fetch_array($sql)){
				$cliente = $row['cliente'];
			}
			
			
			mysql_query("insert into datos_ie(tipo,tipo_reunion,fecha_reunion,lugar_reunion,hora_inicio,hora_fin,inf_general,ot,cliente,asistentes_agencia,asistentes_cliente,
			comp_agencia,comp_cliente,fecha,usuario,inf_no_cliente,name,temas) values
			('".$tipo."','".$tipo_entrevista."','".$fecha_reunion."','".$lugar."','".$hora_i."','".$hora_f."','".$inf_general."','".$ot."','".$cliente."','".$asis_emp."','".$asis_clie."','"
			.$comp_agencia."','".$comp_cliente."','".$fecha."','".$usuario."','".$inf_no_cliente."','".$name."','".$temas."')");
			
			/*mysql_query("insert into datos_ie(tipo_reunion,fecha_reunion,lugar_reunion,hora_inicio,hora_fin,inf_general,ot,cliente,asistentes_agencia,asistentes_cliente,
			comp_agencia,comp_cliente,fecha,usuario,inf_no_cliente,name,temas) values
			('".$tipo_entrevista."','".$fecha_reunion."','".$lugar."','".$hora_i."','".$hora_f."','".$inf_general."','".$ot."','".$cliente."','".$asis_emp."','".$asis_clie."','"
			.$comp_agencia."','".$comp_cliente."','".$fecha."','".$usuario."','".$inf_no_cliente."','".$name."','".$temas."')");*/
			
			echo mysql_error();
		}
		
		
		/*
			Se encarga de Listar todos los informes de entrevista de una ot determinada a partir del ID.
			@param int $id Código de la ot.
		*/
		public function list_informes_entrevista_ot($id){
			$sql = mysql_query("
				SELECT o.codigo_ot,o.referencia, ie.*, e.nombre_empleado
				from cabot o, datos_ie ie, usuario u, empleado e
				where o.id = '$id' and o.codigo_ot = ie.ot and ie.usuario = u.idusuario and u.pk_empleado = e.documento_empleado
				order by ie.fecha desc");
			$tabla = "<table width = '100%' class = 'tablas_muestra_datos_tablas_trafico display_briefs' style = 'padding-left:50px;padding-right:50px;'>
				<thead>
					<tr>
						<th nowrap>NOMBRE</th>
						<th nowrap>FECHA REUNIÓN</th>
						<th nowrap>FECHA DE CREACIÓN</th>
						<th nowrap>LUGAR REUNIÓN</th>
						<th nowrap>ELABORADO POR</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
			";
			while($row = mysql_fetch_array($sql)){
				$tabla.="<tr>
					<td style = 'text-align:left;padding-left:10px;'>".strtr(strtoupper($row['name']),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
					<td>".($row['fecha_reunion'])."</td>
					<td>".($row['fecha'])."</td>
					<td style = 'text-align:left;padding-left:10px;'>".($row['lugar_reunion'])."</td>
					<td style = 'text-align:left;padding-left:10px;'>".($row['nombre_empleado'])."</td>
					<td aling = 'right' style = 'padding-right:10px;'>
						<a href = 'dowload_pdf_ie.php?e=".$row['id_ie']."&ot=".$row['codigo_ot']."' target='_blank'>
							<img src = '../images/iconos/icono_descarga.png' class = 'botones_opciones mano' title = 'Ver Informe de Entrevista'/>
						</a>
					</td>
				</tr>";
			}
			echo $tabla."</tbody></table>";
		}

		
		/*
			Se encarga de Listar todos los brief que hay a partir de una ot.
			@param int $ot Código de la ot.
		*/
		public function listar_brief_x_ot($ot){
			$tabla = "<table width = '100%' class = 'tablas_muestra_datos_tablas_trafico display_briefs' style = 'padding-left:50px;padding-right:50px;'>
				<thead>
					<tr>
						<th>Producto</th>
						<th>Desarrollado Por</th>
						<th>Fecha Elaboración</th>
						<th>Fecha Entrega Creat.</th>
						<th>Fecha Creación</th>
					</tr>
				</thead>
				<tbody>
			";			
			$sql = mysql_query("select b.*,b.fecha_registro as feecha, ot.*
			from datos_brief b, cabot ot
			where b.ot = '$ot' and ot.codigo_ot = b.ot order by b.id_brief desc");
			while($row = mysql_fetch_array($sql)){
				$tabla.="<tr>
					<td align = 'left' style = 'padding-left:15px;'>".strtoupper($row['producto'])."</td>
					<td>".($row['desarrollado'])."</td>
					<td>".($row['fecha_entrega'])."</td>
					<td>".($row['fechacreativa'])."</td>
					<td>".($row['feecha'])."</td>
					<td aling = 'right' style = 'padding-right:10px;'>
						<a href = 'dowload_pdf_brief.php?e=".$row['pk_nit_empresa_ot']."&ot=".$row['codigo_ot']."&i=".$row['id_brief']."' target='_blank'>
							<img src = '../images/iconos/icono_descarga.png' class = 'botones_opciones mano' title = 'Ver Brief Completo'/>
						</a>
					</td>
				</tr>";
			}
			echo $tabla."</tbody></table>";
		}
		/*
			Se encarga de listar las personas de la agencia con sus respectivos correos.
		*/
		public function listar_nombres_personas_correo($correo){
			$sql = mysql_query("select nombre_empleado from empleado where email_empleado = '$correo'");
			while($row = mysql_fetch_array($sql)){
				return $row['nombre_empleado'];
			}
		}
		
		public function insert_cabecera_ot($usuario, $fecha_registro){}
		public function update_cabecera_ot($usuario, $fecha_registro){}
		public function drop_cabecera_ot($usuario, $fecha_registro){}
		
	}
?>