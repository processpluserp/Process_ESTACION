<?php
	class cabecera_pagina{
		public $meses = array("Enero", "Febrero", "Marzo",
        "Abril", "Mayo", "Junio", "Julio",
        "Agosto", "Septiembre", "Octubre",
        "Noviembre", "Diciembre");
		
		public function mostrar_fecha(){
			$fecha = date("Y-m-d"); //5 agosto de 2004 por ejemplo 
			$fechats = strtotime($fecha); //a timestamp
			$mes = "";
			switch (date('w', $fechats)){
				case 0: $mes = "DOMINGO"; break;
				case 1: $mes = "LUNES"; break;
				case 2: $mes = "MARTES"; break;
				case 3: $mes = "MIERCOLES"; break;
				case 4: $mes = "JUEVES"; break;
				case 5: $mes = "VIERNES"; break;
				case 6: $mes = "SABADO"; break;
			}
			setlocale(LC_TIME, 'spanish');  
			$nombre=strftime("%B",mktime(0, 0, 0,DATE("m"), 1, 2000));
			return $mes.',</br>'.date("d").' DE '.strtoupper($nombre).' DE '.date("Y");
		}
		
		public function listar_festivos_calendario(){
			$listado = "";
			$year = date("Y");
			$sql = mysql_query("select year,mes,dia from festivos_calendario where year = '$year'");
			$i = 0;
			while($row = mysql_fetch_array($sql)){
				$listado.= "***".$row['mes'].",".$row['dia'].",".$row['year'];
			}
			return $listado;
		}
		
		public function mostrar_usuario(){
			return $_SESSION["nombre_usuario"]." (".$_SESSION["departamento_usuario"].")";
		}
		
		public function menu_bar_process($id,$empresa){
			
			$sql_perfil = mysql_query("select perfil from usuario where idusuario = '$id'");
			$perfil = "";
			while($row = mysql_fetch_array($sql_perfil)){
				$perfil = $row['perfil'];
			}
			
			$est ="<table id = 'barra_menu' width = '100%' cellpadding = '10px'>
					<tr class = 'estilos_barra'>
						<td>
							<a href = 'bienvenida.php'><img src = '../images/iconos/HOME.png' width = '25px' height = '25px'/></a>
						</td>";
			$sql = mysql_query("select codigo from permisos_op where usuario = '$id' and codigo <= '600'");
			
			$a1 = "";
			if( ($perfil == 1 || $perfil == 9 || $perfil == 7 || $perfil == 8) ){
				$a1 = "menu_gestion.php?e=$empresa";
			}else{
				$a1 = "";
			}
			
			$a2 = "";
			$a3 = "";
			$a4 = "";
			$a5 = "";
			while($row = mysql_fetch_array($sql)){
				if($row['codigo'] == 2){
					$a2 = "trafico.php";
				}else if($row['codigo'] == 3){
					$a3 = "produccion.php";
				}else if($row['codigo'] == 4 && ($perfil == 1 || $perfil == 9)){
					$a4 = "financiera.php";
				}else if($row['codigo'] == 5){
					$a5 = "bienvenida.php";
				}
			}
			$est.="	<td align ='center'>
						<a href = '$a1'>
							GESTIÓN
						</a>
					</td>
					<td>
						<a href = '$a2'>
							TRÁFICO
						</a>
					</td>
					<td>
						<a href = '$a3'>
							PRODUCCIÓN
						</a>
					</td>
					<td>
						<a href = '$a4'>
							INFORMES GERENCIALES
						</a>
					</td>
					<td >
						<a href = '$a5'>
							CLIENTE
						</a>
					</td>
					";
			return $est."</tr></table>";
		}
		
		public function menu_proveedor_perfil($id){
			$est = "";
			$sql = mysql_query("select codigo from permisos_op where usuario = '$id' and codigo between '19' and '21'");
			$a1 = "";
			$a2 = "";
			$a3 = "";
			$a4 = "";
			while($row = mysql_fetch_array($sql)){
				if($row['codigo'] == 19){
					$a1 = "abrir_info_basica";
				}else if($row['codigo'] == 20){
					$a2 = "abrir_contactos";
				}else if($row['codigo'] == 21){
					$a3 = "abrir_acuerdos";
				}
			}
			$est.="<table width = '100%'><tr>
						<td align = 'center' >
							<a id = '$a1' href = '#'><img src = '../images/icono/Gestion_informacion_basica_proveedor.png' class = 'iconos_menu_gestion2'/></a>
						</td>
						<td >
							<a id = '$a2' href = '#'><img src = '../images/icono/Gestion_contactos.png' class = 'iconos_menu_gestion2'/></a>
						</td>
						<td >
							<a id = '$a3' href = '#'><img  src = '../images/icono/Gestion_administracion.png' class = 'iconos_menu_gestion2'/></a>
						</td>
					</tr>";
				echo $est."</table>";
		}
		
		public function menu_trafico_perfil($id){
			$est = "";
			$sql = mysql_query("select codigo from permisos_op where usuario = '$id' and codigo between '26' and '33'");
			$a1 = "";
			$a2 = "";
			$a3 = "";
			$a4 = "";
			while($row = mysql_fetch_array($sql)){
				if($row['codigo'] == 26){
					$a1 = "ventana_trafico";
				}else if($row['codigo'] == 32 ){
					$a2 = "grafica_time_table();";
					//$a2 = "";
				}else if($row['codigo'] == 33){
					$a3 = '$("#ventana_reportes_trafico").dialog("open");$(".scroll").css({"overflow-y":"hidden"});';
				}
			}
			$a4 = 'abrir_ventana_aprobaciones();';
			$est.="<table width = '100%'><tr>
						<td align = 'center' >
							<a id = '$a1' href = '#'><img src = '../images/icono/iconos-01.png' class = 'iconos_menu_gestion2'/></a>
						</td>
						<td align = 'center'>
							<a  href = '#'><img onclick = '$a2' src = '../images/icono/iconos-02.png' class = 'iconos_menu_gestion2'/></a>
						</td>
						<td align = 'center'>
							<a  href = '#'><img onclick = '$a4' src = '../images/icono/mod_aprobaciones.png' class = 'iconos_menu_gestion2'/></a>
						</td>
						<td align = 'center'>
							<a  href = '#'><img onclick = '$a3' src = '../images/icono/iconos-03.png' class = 'iconos_menu_gestion2'/></a>
						</td>
					</tr>";
				echo $est."</table>";
		}
		
		public function menu_produccion_perfil($id){
			$est = "";
			$sql = mysql_query("select codigo from permisos_op where usuario = '$id' and codigo between '34' and '37'");
			$a1 = "";
			$a2 = "";
			$a3 = "";
			$a4 = "";
			while($row = mysql_fetch_array($sql)){
				if($row['codigo'] == 34){
					$a1 = "nuevo_ppto";
				}else if($row['codigo'] == 35){
					$a2 = "cargar_ppto";
				}else if($row['codigo'] == 36){
					$a3 = 'abrir_ventana_ingresos_costos();';
				}
				else if($row['codigo'] == 37){
					$a4 = 'abrir_ventana_reportes_produccion();';
				}
			}
			$est.="<table width = '100%'><tr>
						<td align = 'center' >
							<a id = '$a1' href = '#'><img src = '../images/icono/ICONO-11.png' class = 'iconos_menu_gestion2'/></a>
						</td>
						<td align = 'center'>
							<a id = '$a2' href = '#'><img  src = '../images/icono/iconos-12.png' class = 'iconos_menu_gestion2'/></a>
						</td>
						<td align = 'center'>
							<a  href = '#'><img onclick = '$a3' src = '../images/icono/iconos-13.png' class = 'iconos_menu_gestion2'/></a>
						</td>
						<td align = 'center'>
							<a  href = '#'><img onclick = '$a4' src = '../images/icono/iconos-14.png' class = 'iconos_menu_gestion2'/></a>
						</td>
					</tr>";
				echo $est."</table>";
		}
		
		public function menu_clientes_perfil($id){
			$est = "";
			$sql = mysql_query("select codigo from permisos_op where usuario = '$id' and codigo between '15' and '18'");
			$a1 = "";
			$a2 = "";
			$a3 = "";
			$a4 = "";
			while($row = mysql_fetch_array($sql)){
				if($row['codigo'] == 15){
					$a1 = "abrir_info_basica";
				}else if($row['codigo'] == 16){
					$a2 = "contactos_cliente_n_n";
				}else if($row['codigo'] == 17){
					$a3 = "abrir_negociacion";
				}else if($row['codigo'] == 18){
					$a4 = "admin_cliente";
				}
			}
			$est.="<table width = '100%'><tr>
						<td align = 'center' width = '23%'>
							<a id = '$a1' href = '#'><img src = '../images/icono/Gestion_informacion_basica_cliente.png' class = 'iconos_menu_gestion2'/></a>
						</td>
						<td width = '23%'>
							<a id = '$a2' href = '#'><img src = '../images/icono/Gestion_contactos.png' class = 'iconos_menu_gestion2'/></a>
						</td>
						<td width = '23%'>
							<a id = '$a3' href = '#'><img  src = '../images/icono/Gestion_negociacion_contratos.png' class = 'iconos_menu_gestion2'/></a>
						</td>
						<td width = '23%'>
							<a id = '$a4' href = '#'><img  src = '../images/icono/productos_clientes.png' class = 'iconos_menu_gestion2'/></a>
						</td>
					</tr>";
				echo $est."</table>";
		}
		
		
		public function menu_bienvenida_perfil($id){
			$sql_perfil = mysql_query("select perfil from usuario where idusuario = '$id'");
			$perfil = "";
			while($row = mysql_fetch_array($sql_perfil)){
				$perfil = $row['perfil'];
			}
			
			
			$est = "
				<nav id = 'lista_menus_process'><ul width = '100%' >";
				/*$est = "
				<ul width = '100%'>
				<tr>";*/
			$sql = mysql_query("select codigo from permisos_op where usuario = '$id' and codigo <= '6'");
			$a1 = "";
			$a2 = "";
			$a3 = "";
			$a4 = "";
			$a5 = "";
			while($row = mysql_fetch_array($sql)){
				if($row['codigo'] == 1 && ($perfil == 1 || $perfil == 9 || $perfil == 7 || $perfil == 8 || $perfil == 10)){
					$a1 = "gestion";
				}else if($row['codigo'] == 2){
					$a2 = "trafico.php";
				}else if($row['codigo'] == 3){
					$a3 = "produccion.php";
				}else if($row['codigo'] == 4 && ($perfil == 1 || $perfil == 9) ){
					$a4 = "financiera.php";
				}else if($row['codigo'] == 5 && ($perfil == 1 || $perfil == 9) ){
					$a5 = "dashboard.php";
				}
			}
			$est.="<li align = 'center'>
						<img id = '$a1' src = '../images/bienvenida/gestion.png' class = 'iconos_menu_gestion2 mano' title = 'GESTIÓN'/>
					</li>
					<li align ='center'>
						<a href = '$a2'><img src = '../images/bienvenida/trafico.png' class = 'iconos_menu_gestion2 mano' title = 'TRÁFICO'/></a>
					</li>
					<li align = 'center'>
						<a href = '$a3'><img src = '../images/bienvenida/produccion.png' class = 'iconos_menu_gestion2 mano' title = 'PRODUCCIÓN'/></a>
					</li>
					<li align = 'center' >
						<a href = '$a4'><img src = '../images/bienvenida/informes.png' class = 'iconos_menu_gestion2 mano' title = 'INFORMES'/></a>
					</li>
					<li align = 'center'>
						<a href = '$a5'><img src = '../images/bienvenida/cliente.png' class = 'iconos_menu_gestion2 mano' title = 'CLIENTE'/></a>
					</li>
					";
			/*$est.="<td align = 'center'>
						<img id = '$a1' src = '../images/bienvenida/gestion.png' class = 'iconos_menu_gestion2 mano' title = 'GESTIÓN'/>
					</td>
					<td align ='center'>
						<a href = '$a2'><img src = '../images/bienvenida/trafico.png' class = 'iconos_menu_gestion2 mano' title = 'TRÁFICO'/></a>
					</td>
					<td align = 'center'>
						<a href = '$a3'><img src = '../images/bienvenida/produccion.png' class = 'iconos_menu_gestion2 mano' title = 'PRODUCCIÓN'/></a>
					</td>
					<td align = 'center' >
						<a href = '$a4'><img src = '../images/bienvenida/informes.png' class = 'iconos_menu_gestion2 mano' title = 'INFORMES'/></a>
					</td>
					<td align = 'center'>
						<a href = '$a5'><img src = '../images/bienvenida/cliente.png' class = 'iconos_menu_gestion2 mano' title = 'CLIENTE'/></a>
					</td>
					";*/
					/*echo $est."</tr></table>";*/
			echo $est."</ul></nav>";
		}
		
		public function opcion_crear_ot($id){
			$est = "";
			$sql = mysql_query("select codigo from permisos_op where usuario = '$id' and codigo = '27'");
			while($row = mysql_fetch_array($sql)){
				if($row['codigo'] == 27){
					$est.= "<img src = '../images/iconos/barras-54.png' class = 'botones_opciones mano' title = 'Crear Nueva OT' id = 'nueva_ot'/>";
				}
			}
			echo $est;
		}
		
		public function opcion_crear_tarea($id){
			$est = "";
			$sql = mysql_query("select codigo from permisos_op where usuario = '$id' and codigo = '28'");
			while($row = mysql_fetch_array($sql)){
				if($row['codigo'] == 28){
					$est.= "<img src = '../images/iconos/barras-55.png' class = 'botones_opciones mano' title = 'Crear Nueva Tarea' id = 'nueva_tarea'/>";
				}
			}
			echo $est;
		}
		
		public function menu_agencia_perfil($id){
			$est = "";
			$sql = mysql_query("select codigo from permisos_op where usuario = '$id' and codigo between '11' and '14'");
			$a1 = "";
			$a2 = "";
			$a3 = "";
			$a4 = "";
			while($row = mysql_fetch_array($sql)){
				if($row['codigo'] == 11){
					$a1 = "ventana_documentos";
				}else if($row['codigo'] == 12){
					$a2 = "ventana_empleados";
				}else if($row['codigo'] == 13){
					$a3 = "financiero";
				}else if($row['codigo'] == 14){
					$a4 = "administracion";
				}
			}
			$est.="<table width = '100%'><tr>
						<td align = 'center' width = '23%'>
							<a id = '$a1' href = '#'><img src = '../images/icono/Gestion_informacion_basica.png' class = 'iconos_menu_gestion2'/></a>
						</td>
						<td width = '23%'>
							<a id = '$a2' href = '#'><img src = '../images/icono/Gestion_empleados.png' class = 'iconos_menu_gestion2'/></a>
						</td>
						<td width = '23%'>
							<a id = '$a3' href = '#'><img  src = '../images/icono/iconos-57.png' class = 'iconos_menu_gestion2'/></a>
						</td>
						<td width = '23%'>
							<a id = '$a4' href = '#'><img  src = '../images/icono/iconos-58.png' class = 'iconos_menu_gestion2'/></a>
						</td>
					</tr>";
				echo $est."</table>";
		}
		
		public function adicionar_empresa($id){
			$sql = mysql_query("select codigo from permisos_op where usuario = '$id' and codigo =  '6'");
			while($row = mysql_fetch_array($sql)){
				echo "<div id = 'contenedor_adicionar'  class = 'add_nueva'>
					<span  id = 'agregar_nueva_empresa'>ADICIONAR EMPRESA <img src = '../images/iconos/mas_blanco.png' width = '19px' height = '19px' /></span>
				</div>";
			}
		}
		
		public function menu_gestion($id,$empresa_trabajo){
			$est = "<table width = '100%' id = 'menu_interno_gestion'>
					<tr>";
			$sql = mysql_query("select codigo from permisos_op where usuario = '$id' and (codigo =  '7' or codigo = '8' or codigo = '9' or codigo = '10')");
			//$x = mysql_num_rows($sql);
			$a1 = "";
			$a2 = "";
			$a3 = "";
			$a4 = "";
			$c1 = "";
			$c2 = "";
			$c3 = "";
			$c4 = "";
			while($row = mysql_fetch_array($sql)){
				if($row['codigo'] == 7){
					$a1 = "gestion.php?e=$empresa_trabajo";
					$c1 = "class = 'mano_links'";
					
				}else if($row['codigo'] == 8) {
					$c2 = "class = 'mano_links'";
					$a2 = "cliente.php?e=$empresa_trabajo";
				}
				else if($row['codigo'] == 9) {
					$c3 = "class = 'mano_links'";
					$a3 = "proveedor.php?e=$empresa_trabajo";
				}
				else if($row['codigo'] == 10) {
					$c1 = "class = 'mano_links'";
					$a4 = "banco.php?e=$empresa_trabajo";
				}
			}
			$est.="		<td class = 'menus'>
							<a href = '$a1' $c1>
								<img  src = '../images/icono/Gestion_agencia.png' class = 'iconos_menu_gestion2' title = 'AGENCIA'/>
							</a>
						</td>
						<td class = 'menus'>
							<a href = '$a2' $c2>
								<img src = '../images/icono/Gestion_clientes.png' class = 'iconos_menu_gestion2' title = 'CLIENTES'/>
							</a>
						</td>
						<td class = 'menus'>
							<a href = '$a3' $c3>
								<img src = '../images/icono/Gestion_proveedor.png' class = 'iconos_menu_gestion2' title = 'PROVEEDORES'/>
							</a>
						</td>
						<td class = 'menus'>
							<a href = '$a4' $c4>
								<img src = '../images/icono/Gestion_bancos.png' class = 'iconos_menu_gestion2' title = 'BANCOS'/>
							</a>
						</td>
						";
			echo $est."</tr></table>";
		}
		
		public function mostrar_logo_empresa_empleado(){
			$id = $_SESSION['codigo_usuario'];
			$sql = mysql_query("select e.logo from empresa e, empleado em, usuario u
			where u.idusuario = '$id' and pk_empleado = em.documento_empleado and em.pk_empresa = e.cod_interno_empresa");
			while($row = mysql_fetch_array($sql)){
				return "<img src = '../images/logos/".$row['logo']."' id = 'logo_usuario'/>";
			}
		}
		
		
		
		public function mostrar_empresa_empleado(){
			$id = $_SESSION['codigo_usuario'];
			$sql = mysql_query("select e.cod_interno_empresa from empresa e, empleado em, usuario u
			where u.idusuario = '$id' and pk_empleado = em.documento_empleado and em.pk_empresa = e.cod_interno_empresa");
			while($row = mysql_fetch_array($sql)){
				return $row['cod_interno_empresa'];
			}
		}
		
		public function obtener_num_alertas_factura_documento(){
			$sel = mysql_query("select fvencimiento from documentos_legales_entidades where fvencimiento <= SYSDATE()");
			$num = 0;
			while($row = mysql_fetch_array($sel)){
				$num++;
			}
			echo $num;
		}
	
		public function obtener_cumpleanos_del_dia(){
			$i = 0;
			$se = mysql_query("select nombre_empleado,fecha_nacimiento from empleado where month(fecha_nacimiento) = month(SYSDATE()) AND day(fecha_nacimiento) = day(SYSDATE())");
			while($row = mysql_fetch_array($se)){
				$i++;
			}
			return $i;
		}
		public function listar_cumpleanos_del_dia(){
			$name = "HOY ES EL CUMPLEAÑOS DE:\n";
			$se = mysql_query("select nombre_empleado,fecha_nacimiento from empleado where month(fecha_nacimiento) = month(SYSDATE()) AND day(fecha_nacimiento) = day(SYSDATE())");
			while($row = mysql_fetch_array($se)){
				$name.="".$row['nombre_empleado']."\n";
			}
			return $name;
		}
		
		public function historico_documentos($id,$emp){
			$est = "<table class = 'opciones_ocultar'>
				<tr>
					<td>
						<div><input type = 'checkbox' value = '1' id = 'v_nombre_archivo' class = 'radio' onchange = 'ocultar_nombre_archivo_documentos()' checked/>
						<label for='v_nombre_archivo'><span><span></span></span>Nombre Del Archivo</label></div>
					</td>
					<td style = 'padding-right:40px;padding-left:40px;'>
						<div><input type = 'checkbox' value = '1'id = 'v_cpor' onchange = 'ocultar_cargado_por_documentos()' class = 'radio' checked/>
						<label for='v_cpor'><span><span></span></span>Cargado Por</label></div>
					</td>
					<td style = 'padding-right:40px;padding-left:40px;'>
						<div><input type = 'checkbox' value = '1'id = 'v_fcarga' onchange = 'ocultar_fecha_carga_documentos()' class = 'radio' checked/>
						<label for='v_fcarga'><span><span></span></span>Fecha Carga</label></div>
					</td>
					<td style = 'padding-right:40px;padding-left:40px;'>
						<div><input type = 'checkbox' value = '1'  id = 'v_descarga' onchange = 'ocultar_descarga_documentos2()'  class = 'radio'checked/>
						<label for='v_descarga'><span><span></span></span>Descarga</label></div>
						<div>
					</td>
				</tr>
			</table></br>";
			$sql = mysql_query("select h.name,h.fecha,t.nombre_documento, e.nombre_empleado,t.codigo_documento
			from historico_documentos h, tipodoc t, usuario u, empleado e
			where h.empresa = '$emp' and t.codigo_documento = h.tipo and h.tipo = '$id' and h.usuario = u.idusuario and u.pk_empleado = e.documento_empleado order by t.nombre_documento desc");
			$cantidad =1 + mysql_num_rows($sql);
						
			$est .= "<table id = 'tabla_contenedor_documentos_empresa' class = 'tablas_muestra_datos_tablas' width = '100%'>
						<tr>
							<th>Tipo Documento</th>
							<th>Nombre Documento</th>
							<th>Cargado Por</th>
							<th nowrap align = 'center'>Fecha Carga</th>
							<th></th>
						</tr>";
						
			$sql2 = mysql_query("select t.nombre_documento 
			from tipodoc t 
			where t.codigo_documento = '$id' order by t.nombre_documento asc");
			while($row = mysql_fetch_array($sql2)){
					//$est.="<tr><td rowspan = '$cantidad' align = 'center'>".utf8_encode($row['nombre_documento'])."</td></tr>";
			}
			
			$nums = mysql_num_rows($sql);
			$i = 0;
			while($row = mysql_fetch_array($sql)){
				$color = "";
				if($i == 0){
					$color = "green";
				}else{
					$color = "red";
				}
				$i++;
				$dat = $row['fecha'];
				$dat = explode("-",$dat);
				$dia = explode(" ",$dat[2]);
				$fecha = $this->meses[floatval($dat[1])-1]." ".floatval($dia[0])." ".$dat[0];//." - ".$dia[1];
				$doc = $row['codigo_documento'];
				$name = $row['name'];
				$est.= "<tr>
					<td align = 'center' style = 'color:$color'>".utf8_encode($row['nombre_documento'])."</td>
					<td align = 'left' style = 'color:$color'>".$row['name']."</td>
					<td align = 'center' style = 'color:$color'>".utf8_encode($row['nombre_empleado'])."</td>
					<td align = 'center' style = 'color:$color'>".$fecha."</td>
					<td align = 'center'>
						<a href = 'dowload_documentos.php?emp=$emp&doc=$doc&archivo=$name'>
							<img src = '../images/icon/icono_descarga.png' class = 'icono_descarga'/>
						</a>
					</td>
				</tr>";
			}
			echo $est."</table>";
		}
		
		public function mostrar_datos_por_empresa_documentos($emp){
			
			$est = "<table>
				<tr >
					<td style = 'padding-left:50px;'>
						<div><input type = 'checkbox' value = '1'id = 'v_fvencimiento' onchange = 'ocultar_fvencimiento_documentos()' checked/>
						<label for='v_fvencimiento'><span><span></span></span>Fecha Vencimiento</label></div>
					</td>
					<td style = 'padding-right:40px;padding-left:40px;'>
						<div><input type = 'checkbox' value = '1'id = 'v_correos' onchange = 'ocultar_correos_documentos()' checked/>
						<label for='v_correos'><span><span></span></span>Notifica a</label></div>
					</td>
					<td >
						<div><input type = 'checkbox' value = '1'id = 'v_descarga' onchange = 'ocultar_descarga_documentos()' checked/>
						<label for='v_descarga'><span><span></span></span>Descarga</label></div>
					</td>
				</tr>
			</table></br>";
			$sel = mysql_query("select td.codigo_documento, td.nombre_documento,de.consecutivo,
			de.name,de.valor,de.fvencimiento,e.cod_interno_empresa, e.nombre_comercial_empresa
			from tipodoc td,documentos_legales_entidades de, empresa e
			where e.cod_interno_empresa = '$emp' and 
			de.pk_tdocumento = td.codigo_documento and de.pk_empresa = e.cod_interno_empresa order by td.nombre_documento asc");
			$est .= "<table id = 'tabla_contenedor_documentos_empresa' class = 'display3 tablas_muestra_datos_tablas' width = '100%'>
						<thed>
							<tr>
								<th style = 'padding-left:50px;'>DOCUMENTO</th>
								<th nowrap align = 'center'>FECHA DE VENCIMIENTO</th>
								<th nowrap align = 'center'>NOTIFICAR A</th>
								<th></th>
							</tr>
						</thead><tbody>";
			while($row = mysql_fetch_array($sel)){
				$dat = $row['fvencimiento'];
				$dat = explode("-",$dat);
				$fecha = $this->meses[floatval($dat[1])-1]." ".$dat[2]." ".$dat[0];
				$emp = $row['cod_interno_empresa'];
				$doc = $row['codigo_documento'];
				$name = $row['name'];
				$est.= "<tr>
						<td style = 'font-size:17px;'>".utf8_encode($row['nombre_documento'])."</td>
						<td align = 'center' style = 'font-size:17px;'>".$fecha."</td>
						<td style = 'font-size:17px;'>";
				$not = "";
				$sql2 = mysql_query("select empleado from notificaciones where tipo = 'DOC' and codigo = '$doc' and empresa = '$emp' order by empleado asc;");
				while($x = mysql_fetch_array($sql2)){
						$not.=strtoupper($x['empleado'])."</br>";
				}
				$est.="
					$not</td>
						<td align = 'center'>
							<a href = 'dowload_documentos.php?emp=$emp&doc=$doc&archivo=$name'>
								<img src = '../images/icon/icono_descarga.png' class = 'icono_descarga'/>
							</a>
						</td>
					</tr>";
			}
			for($ii = 0; $ii <= 10;$ii++){
					$est.="<tr>
						<td style = 'font-size:17px;padding:40px;'></td>
						<td style = 'font-size:17px;'></td>
						<td style = 'font-size:17px;'></td>
						<td style = 'font-size:17px;'></td>
					</tr>";
				}
			echo $est."</tbody></table>";
		}
		
		
		public function insert_notificaciones($tipo,$empleado,$id,$empresa){
			$sql = mysql_query("insert into notificaciones(tipo,empleado,codigo,empresa) values ('".$tipo."','".$empleado."','".$id."','".$empresa."')");
		}
		
		public function tareas_pendientes($usu){
			$i = 0;
			$sql_1=mysql_query("select t.pk_ot, t.codigo_int_tarea,t.codigo_tarea, ft.codigo, ot.referencia,t.trabajo,t.fecha_prometida,ot.id as id_ot,
						t.usuario, e2.nombre_empleado as radicado_por, ft.num_tarea
						from tareas t, flujo_tareas ft, cabot ot, usuario u2, empleado e2
						where t.codigo_int_tarea = ft.pk_tarea  and t.codigo_tarea = ft.num_tarea and t.estado = '0' and ot.codigo_ot = t.pk_ot
						and t.usuario = u2.idusuario and u2.pk_empleado = e2.documento_empleado");
			while($trow = mysql_fetch_array($sql_1)){
				$id_tareaa = $trow['codigo_int_tarea'];
				$sql_int = mysql_query("select e.documento_empleado, ax.pk_asignado, ax.tipo, e.nombre_empleado as name
				from empleado e, usuario u, asignados_tareas ax
				where ax.pk_tarea = '$id_tareaa' and ax.pk_asignado = u.idusuario and u.pk_empleado = e.documento_empleado");
				$sql_info_res = mysql_query("select pk_asignado from asignados_tareas where pk_tarea = '$id_tareaa' and tipo = 'RES' and pk_asignado = '$usu'");
				
				if(mysql_num_rows($sql_info_res )> 0){
					$i++;
				}else{
					$sql_info_res = mysql_query("select pk_asignado from asignados_tareas where pk_tarea = '$id_tareaa' and tipo = 'ASI' and pk_asignado = '$usu'");
					if(mysql_num_rows($sql_info_res)>0){
						$i++;
					}
					
				}
			}
			
			return $i;			
		}
		
		public function filtrar_datos_por_empresa_documentos($emp){
			$table = "
			<table id = 'tabla_contenedor_documentos_empresas' class = 'tablas_muestra_datos_tablas'>
				<tr>
				<th>Empresa</th>
				<th>Documento</th>
				<th>Fecha de Vencimiento</th>
				<th>Valor</th>
				<th>Descargar</th>
				</tr>";
			
			$sel = mysql_query("select td.codigo_documento, td.nombre_documento,de.consecutivo,
			de.name,de.valor,de.fvencimiento,e.cod_interno_empresa, e.nombre_comercial_empresa from tipodoc td,
			documentos_legales_entidades de, empresa e where
			de.pk_tdocumento = td.codigo_documento and de.pk_empresa ='$emp' and de.pk_empresa = e.cod_interno_empresa");
			while($row = mysql_fetch_array($sel)){
				$emp = $row['cod_interno_empresa'];
				$doc = $row['codigo_documento'];
				$name = $row['name'];
				$table .= "<tr>
					<td>".$row['nombre_comercial_empresa']."</td>
					<td>".$row['nombre_documento']."</td>
					<td>".$row['fvencimiento']."</td>
					<td>".$row['valor']."</td>
					<td>
						<a href = 'dowload_documentos.php?emp=$emp&doc=$doc&archivo=$name'>
							<img src = '../images/iconos/ADICIONAR.png' width = '40px' height = '40px'
						</a>
					</td>
				</tr>";
			}
			echo $table."</table>";
		}
	}
?>