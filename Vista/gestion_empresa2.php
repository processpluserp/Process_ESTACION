<?php
	require("../Modelo/gestion_cabecera.php");
	require("../Modelo/empleado.php");
	require("../Controller/Conexion.php");
	require("../Modelo/inv_tecnologia.php");
	require("../Modelo/muebles.php");
	
	session_start();
	if($_SESSION["codigo_usuario"] == ""){
		header("location:../logeo.php");
	}
	$empresa_final = $empresa_trabajo;
	if($empresa_final == ""){
		header("location:../bienvenida.php");
	}
	
	$inv_tec = new inv_tecnologia();
	$gestion = new cabecera_pagina();
	$empleado = new empleado();
	$muebles = new muebles();
?>
<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>:: PROCESS + ::</title>
			<meta charset="utf-8" />
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			<link type="text/css" href="prueba.css" rel="stylesheet" />
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script type="text/javascript" src="../js/gestion.js"></script>
			<script type="text/javascript" src="../js/gestion_empresa.js"></script>
			<script type="text/javascript" src="../js/gestion2.js"></script>
			<link rel="stylesheet" href="../css/jquery-ui.css">
			<style >
				.estilos_barra td:nth-child(2){
					background-color:#EF8C14;
				}
				.tabla_nuevos_datos input,.tabla_nuevos_datos textarea,.tabla_nuevos_datos select{
					width:90%;
					border-radius:0.2em;
					border:2px solid #9D9B99;
				}
			</style>
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
			
			
		</head>
		<body>
			<span id = "empresa_final" class = "hidde"><?php echo $empresa_final;?></span>
			<div id = "contenedor_cabecera">
			</br>
				<table id  = "cabecera" width = '100%'>
					<tr>
						<td >
							<span ><?php echo $gestion->mostrar_fecha();?></span>
						</td>
						<td >
							<table width = '100%'>
								<tr>
									<td align = 'right' class = "img_alertas">
										<img src = "../images/iconos/ALERTA_CUMPLE.png" class = "iconos_barra"/>
									</td>
									<td align = 'left'>
										<span id ="cumpleanos"><?php $gestion->obtener_cumpleanos_del_dia()?></span>
									</td>
								</tr>
							</table>
						</td>
						<td >
							<table width = '100%'>
								<tr>
									<td align = 'right' class = "img_alertas">
										<img src = "../images/iconos/ALERTA_ALARMA.png" class = "iconos_barra"/>
									</td>
									<td align = 'left'>
										<span id ="alertas_facturas"><?php $gestion->obtener_num_alertas_factura_documento()?></span>
									</td>
								</tr>
							</table>
						</td>
						<td >
							<table width = '100%'>
								<tr>
									<td align = 'right' class = "img_alertas">
										<img src = "../images/iconos/ALERTA_TRAFICO_TAREA.png" class = "iconos_barra"/>
									</td>
									<td align = 'left'>
										<span id ="alerta_tareas">2</span>
									</td>
								</tr>
							</table>							
						</td>
						<td>
							<div id = "nombre_usuario_contenedor" width = '100%'>
								<table width = '100%' id = "contenedora_usuario" height = '100%'>
									<tr>
										<td >
											<img src = "../images/logo_toro_love.png" id = "logo_usuario"/>
										</td>
										<td>
											<p id = "nombre_usuario"><?php echo $gestion->mostrar_usuario();?></p>
										</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td align='right' class = 'salir_sistema'>
							<span onclick = "cerrar_sesion()">Cerrar Sesión</span>
						</td>
					</tr>
				</table>
				
				<table id = "barra_menu" width = '100%' cellpadding = "10px">
					<tr class = "estilos_barra">
						<td>
							<a href = "bienvenida.php"><img src = "../images/iconos/HOME.png" width = '25px' height = '25px'/></a>
						</td>
						<td class = "actual">
							<a href = 'gestion_empresa2.php' class = "actual">
								GESTIÓN
							</a>
						</td>
						<td>
							<a href = 'trafico.php'>
								TRÁFICO
							</a>
						</td>
						<td>
							<a href = 'produccion.php'>
								PRODUCCIÓN
							</a>
						</td>
						<td>
							<a href = 'facturacion.php'>
								FACTURACIÓN
							</a>
						</td>
						<td>
							<a href = 'financiera.php'>
								FINANCIERA
							</a>
						</td>
						<td>
							<a href = 'dashboard.php'>
								DASHBOARD
							</a>
						</td>
					</tr>					
				</table>
			</div>
			
			
			<div id = "cuerpo_pagina">
				<table id ="haha" width = '99.9%'>
					<tr>
						<td width = '15%'>
							<div id = "p" width = "90%">
								<table width = "100%" id = "menu_desplegable">
									
									<tr id = "p_empresa" class = "menus_padres">
										<th colspan = "2">EMPRESA</th>
									</tr>
									
									<tr class = "h_empresa" >
										<td style = "padding-left:20px;" width = '80%'><span>CREAR</span></td>
										<td align = "center">
											<img src = "../images/iconos/ADICIONAR.png" height = '20px' width = '20px' id = "boton_crear_empresa_gestion"/>
										</td>
									</tr>
																		
									<tr class = "h_empresa" id = "docu_legales">
										<td style = "padding-left:20px;" width = '80%'><span>DOCUMENTOS LEGALES</span></td>
										<td align = "center">
											<div class="arrow-down"></div>
										</td>
									</tr>
									<tr  class ="hh_documentos">
										<td style = "padding-left:30px;">Subir Documento</td>
									</tr>
									
									<tr class = "h_empresa" id = "inventarios">
										<td style = "padding-left:20px;" width = '80%'><span>INVENTARIOS</span></td>
										<td align = "center">
											<div class="arrow-down"></div>
										</td>
									</tr>
									<tr  class ="hh_inventario" id = "tecnologia">
										<td style = "padding-left:30px;">Tecnología</td>
									</tr>
									<tr  class ="hh_inventario" id = "muebles">
										<td style = "padding-left:30px;">Muebles y Enseres</td>
									</tr>
									<tr  class ="hh_inventario" id = "caf_aseo">
										<td style = "padding-left:30px;">Cafetería y Aseo</td>
									</tr>
									<tr  class ="hh_inventario" id = "be">
										<td style = "padding-left:30px;">Bodega Externa</td>
									</tr>
									<tr  class ="hh_inventario" id = "bi">
										<td style = "padding-left:30px;">Bodega Interna</td>
									</tr>
									<tr id = "p_empleados" class = "menus_padres2">
										<th colspan = "2">EMPLEADOS</th>
									</tr>
									<tr class = "h_empleados" id = "ver_empleados">
										<td align = "center" width = '80%'><span>VER EMPLEADOS</span></td>
										<td align = "center">
											<div class="arrow-down"></div>
										</td>
									</tr>
									<tr class = "hh_empleados">
										<td style = "padding-left:30px;" id = "add_e">
											ADICIONAR
										</td>
										<td align = "center">
											<img src = "../images/iconos/ADICIONAR.png" height = '20px' width = '20px' id = "nuevo_empleado"/>
										</td>
									</tr>
									<tr class = "hh_empleados">
										<td style = "padding-left:30px;" id = "usuario_cre">
											Usuario
										</td>
									</tr>
									<tr class = "hh_empleados">
										<td style = "padding-left:30px;" id = "pest_hj">
											Hoja de Vida Empleado
										</td>
									</tr>
									<tr class = "hh_empleados" id = "personal_down">
										<td style = "padding-left:30px;" id = "pest_hj">
											Personal Down
										</td>
									</tr>
									
									
									
									<tr id = "p_bancos" class = "menus_padres2">
										<th colspan = "2">BANCOS</th>
									</tr>
									<tr id = "p_clientes" class = "menus_padres2">
										<th colspan = "2">CLIENTES</th>
									</tr>
									<tr id = "p_proveedores" class = "menus_padres2">
										<th colspan = "2">PROVEEDORES</th>
									</tr>
								</table>
							</div>
						</td>
						<td>
							<div id = "panel_muestra_datos">
								<div id = "datos_generales_empresa">
									</br>
									<table class = "tabla_opciones_busqueda_gestion" width = "100%">
										<tr>
											<th align = 'center'>NIT</th>
											<th align = 'center'><input type = "text" name = "nit_empresa_gestion" id = "nit_empresa_gestion" class = "inputs_gestion"/></th>
											<th align = 'center'>NOMBRE</th>
											<th align = 'center'>
												<input type = "text" name = "nombre_empresa_gestion" id = "nombre_empresa_gestion" class = "inputs_gestion"/>
											</th>
											<th align = 'center'>
												<span class = "mostrar_datos" id = "boton_mostrar_empresa_gestion" >LISTADO EMPRESAS</span>
											</th>
										</tr>
									</table>
									</br>
									<div id= "contenedor_respuestas">
										<table id = "tabla_contenedor_info_empresas" class = "tablas_muestra_datos_tablas">
											<tr>
												<th>NIT</th>
												<th>Nombre Legal</th>
												<th>Nombre Comercial</th>
												<th>Iniciales</th>
												<th>Teléfono</th>
												<th>Dirección</th>
												<th>Ciudad</th>
												<th></th>
												<th></th>									
											</tr>
											<?php
												$consulta = "select e.cod_interno_empresa, e.nit_empresa, e.nombre_legal_empresa,
												e.nombre_comercial_empresa,e.iniciales_empresa,e.phone_empresa,e.direccion_empresa, e.observacion,e.nota_orden,e.estado,
												c.nombre_ciudad	from empresa e, ciudad c where e.ciudad_codigo_ciudad=c.codigo_ciudad ";
												$result = mysql_query($consulta);
												
												while($row = mysql_fetch_array($result)){
													$id = $row['cod_interno_empresa'];
													$estructura = "";
													if($row['estado'] == 1){
														$estructura = "<div width = '100px' height = '100px' style = 'background-color:red;'></div>";
													}
													echo "<tr id =".$row['cod_interno_empresa'].">
														<td class = 'tabla_nit_empresa'>".$row['nit_empresa']."</td>
														<td>".$row['nombre_legal_empresa']."</td>
														<td>".$row['nombre_comercial_empresa']."</td>
														<td>".$row['iniciales_empresa']."</td>
														<td>".$row['phone_empresa']."</td>
														<td  nowrap>".$row['direccion_empresa']."</td>
														<td>".$row['nombre_ciudad']."</td>									
														<td id = 'nota$id' class = 'campo_oculto_tabla'>".$row['nota_orden']."</td>
														<td id = 'nota_ppto$id' class = 'campo_oculto_tabla'>".utf8_encode($row['observacion'])."</td>
														<td><img src = '../images/editar.png' onclick = 'editar_empresa_gestion($id)' class = 'botones'/></td>
														<td>$estructura</td>
													</tr>";
												}
											?>
										</table>
									</div>
								</div>
								
								<div id= "informacion_invetarios_x_empresa">
									<div id = "inv_tecnoligia">
										</br>
										<table class = "tabla_opciones_busqueda_gestion" width = "100%">
											<tr>
												<td style = "padding-left:20px;">
													<p>Empresa</p>
													<select id = "empresa_inventario_tec">
															<?php
																$sel = mysql_query("select cod_interno_empresa, nombre_comercial_empresa from empresa where cod_interno_empresa = '$empresa_final'");
																while($row = mysql_fetch_array($sel)){
																	echo "<option value = '".$row['cod_interno_empresa']."'>".$row['nombre_comercial_empresa']."</option>";
																}
															?>
													</select>
												</td>
												<td style = "padding-left:20px;">
													<p>Plataforma</p>
													<select id = "plataforma_inventario_tec">
														<option value = "vacio"></option>
														<option value = "WINDOWS">WINDOWS</option>
														<option value = "MAC">MAC</option>	
													</select>
												</td>
												<td style = "padding-left:20px;">
													<p>Plataforma</p>
													<select id = "departamento_inventario_tec">
														<option value = "vacio"></option>
														<
													</select>
												</td>
												<td width = "50%">
												</td>
												<td ALIGN = "center"nowrap>
													<span id = "ingresar_nuevo_inventario_tec" class = "mostrar_datos">NUEVO ELEMENTO</span>
												</td>
											</tr>
										</table>
										<div id = "contenedor_tabla_inv_tecnologia">
											<?php $inv_tec->mostrar_datos($empresa_final); ?>
										</div>
									</div>
									<div id = "c_caf_aseo">
										</br>
										<table class = "tabla_opciones_busqueda_gestion" width = "100%">
											<tr>
												<td style = "padding-left:20px;">
													<p>Empresa</p>
													<select id = "empresa_inventario_caf">
															<?php
																$sel = mysql_query("select cod_interno_empresa, nombre_comercial_empresa from empresa where cod_interno_empresa = '$empresa_final'");
																while($row = mysql_fetch_array($sel)){
																	echo "<option value = '".$row['cod_interno_empresa']."'>".$row['nombre_comercial_empresa']."</option>";
																}
															?>
													</select>
												</td>
												<td width = "50%">
												</td>
												<td ALIGN = "center">
													<span id = "ingresar_nuevo_inventario_tec" class = "mostrar_datos">NUEVO ELEMENTO</span>
												</td>
											</tr>
										</table>
									</div>
									<div id = "c_muebles">
										</br>
										<table class = "tabla_opciones_busqueda_gestion" width = "100%">
											<tr>
												<td style = "padding-left:20px;">
													<p>Empresa</p>
													<select id = "empresa_inventario_muebles">
															<?php
																$sel = mysql_query("select cod_interno_empresa, nombre_comercial_empresa from empresa where cod_interno_empresa = '$empresa_final'");
																while($row = mysql_fetch_array($sel)){
																	echo "<option value = '".$row['cod_interno_empresa']."'>".$row['nombre_comercial_empresa']."</option>";
																}
															?>
													</select>
												</td>
												<td width = "50%">
												</td>
												<td ALIGN = "center">
													<span id = "ingresar_nuevo_inventario_muebles" class = "mostrar_datos">NUEVO ELEMENTO</span>
												</td>
											</tr>
										</table>
										<div id = "contenedor_tabla_muebles">
											<?php
												$muebles->mostrar_datos($empresa_final);
											?>
										</div>
									</div>
									<div id = "c_be"></div>
									<div id = "c_bi"></div>
								</div>
								
								<div id = "crear_item_muebles">
									<div class ="scroll_nueva_ventana">
										<span class = "titulo_nueva_ventana">DATOS NUEVO MUEBLE</span>
										</br>
										</br>
										<table width = "100%" class = "tabla_nuevos_datos">
											<tr>
												<th>INFORMATIVOS</th>
												<th colspan = '4' ><hr></th>
											</tr>
											<tr>
												<td colspan = "2">
													<p>Descripción</p>
													<input type = "text" name = "desc" id = "desc" />
												</td>
												<td class = "separator"></td>
												<td>
													<p>Valor Hoy</p>
													<input type = "text" name = "val_hoy" id = "val_hoy" />
												</td>
												<td>
													<p>Valor Compra</p>
													<input type = "text" name = "val_compra" id = "val_compra" />
												</td>
											</tr>
											<tr>
												<td>
													<p>A quién ?</p>
													<input type = "text" name = "quien" id = "quien" />
												</td>
												<td>
													<p># Factura</p>
													<input type = "text" name = "factura" id = "factura" />
												</td>
												<td class = "separator"></td>
												<td>
													<p>EMPRESA</p>
													<select id = "empresa_muebles_n">
														<?php
															$sel = mysql_query("select cod_interno_empresa, nombre_comercial_empresa from empresa where cod_interno_empresa = '$empresa_final'");
															while($row = mysql_fetch_array($sel)){
																echo "<option value = '".$row['cod_interno_empresa']."'>".$row['nombre_comercial_empresa']."</option>";
															}
														?>
													</select>
												</td>
												<td>
													<p>Área</p>
													<select id = "area_empresa_muebles">
													</select>
												</td>
											</tr>
											<tr>
												<td colspan = "5"></br></td>
											</tr>
											<tr>
												<td colspan = "2"></td>
												<td class = "separator"></td>
												<td colspan = "2">
													<span class = "botton_verde" id = "cancelar_crear_muebles">CANCELAR</span>
													<span class = "botton_verde" id = "crear_muebles">GUARDAR</span>
												</td>
											</tr>
										</table>
									</div>
								</div>
								
								<div id = "crear_item_tecnologia">
									<div class ="scroll_nueva_ventana">
										<span class = "titulo_nueva_ventana">DATOS NUEVO EQUIPO</span>
										</br>
										</br>
										<table width = "100%" class = "tabla_nuevos_datos">
											<tr>
												<th>INFORMATIVOS</th>
												<th colspan = '4' ><hr></th>
											</tr>
											<tr>
												<td colspan = "2">
													<p>EMPRESA</p>
													<select id = "empresa_inv_tecnologia">
														<option value = "vacio"></option>
														<?php
															$sel = mysql_query("select cod_interno_empresa, nombre_comercial_empresa from empresa where cod_interno_empresa = '$empresa_final'");
															while($row = mysql_fetch_array($sel)){
																echo "<option value = '".$row['cod_interno_empresa']."'>".$row['nombre_comercial_empresa']."</option>";
															}
														?>
													</select>
												</td>
												<td class = "separator"></td>
												<td >
													<p>Plataforma</p>
													<select type = "text" name = "plataforma" id = "plataforma" >
														<option value = "vacio"></option>
														<option value = "WINDOWS">WINDOWS</option>
														<option value = "MAC">MAC</option>
													</select>
												</td>
												<td >
													<p>Portatil /desktop</p>
													<input type = "text" name = "tipo" id = "tipo" />
												</td>
											</tr>
											<tr>
												<td colspan = "2">
													<p>Empleado</p>
													<select id = "empleado_inv_tecnologia">
														<option value = "vacio"></option>
													</select>
												</td>
												<td class = "separator"></td>
												<td colspan = "2">
													<p>Marca</p>
													<input type = "text" name = "marca" id = "marca" />
												</td>
											</tr>
											<tr>
												<td colspan = "5"></br></th>
											</tr>
											<tr>
												<th colspan = '2'>CARACTERÍSTICAS DEL EQUIPO</th>
												<th colspan = '3' ><hr></th>
											</tr>
											<tr>
												<td>
													<p>Modelo</p>
													<input type = "text" name = "modelo" id = "modelo" />
												</td>
												<td>
													<p>Serie</p>
													<input type = "text" name = "s_modelo" id = "s_modelo" />
												</td>
												<td class = "separator"></td>
												<td >
													<p>Monitor</p>
													<input type = "text" name = "monitor" id = "monitor" />
												</td>
												<td >
													<p>Serie</p>
													<input type = "text" name = "s_monitor" id = "s_monitor" />
												</td>
											</tr>
											<tr>
												<td>
													<p>Teclado</p>
													<input type = "text" name = "teclado" id = "teclado" />
												</td>
												<td>
													<p>Serie</p>
													<input type = "text" name = "s_teclado" id = "s_teclado" />
												</td>
												<td class = "separator"></td>
												<td >
													<p>Mouse</p>
													<input type = "text" name = "mouse" id = "mouse" />
												</td>
												<td >
													<p>Serie</p>
													<input type = "text" name = "s_mouse" id = "s_mouse" />
												</td>
											</tr>
											<tr>
												<td>
													<p>Disco Duro</p>
													<input type = "text" name = "dd" id = "dd" />
												</td>
												<td>
													<p>Memoria</p>
													<input type = "text" name = "memoria" id = "memoria" />
												</td>
												<td class = "separator"></td>
												<td >
													<p>Procesadr</p>
													<input type = "text" name = "procesador" id = "procesador" />
												</td>
												<td >
													<p>Velocidad</p>
													<input type = "text" name = "velocidad" id = "velocidad" />
												</td>
											</tr>
											<tr>
												<td colspan = "2">
													<p>Drive</p>
													<input type = "text" name = "drive" id = "drive" />
												</td>
												<td class = "separator"></td>
											</tr>
											<tr>
												<td colspan = "5"></br></th>
											</tr>
											<tr>
												<td colspan = "2"></td>
												<td class = "separator"></td>
												<td colspan = "2">
													<span class = "botton_verde" id = "cancelar_crear_inv_tec">CANCELAR</span>
													<span class = "botton_verde" id = "crear_inv_tect">GUARDAR</span>
												</td>
											</tr>
										</table>
									</div>
								</div>
								
								<div id = "opciones_info_empleado">
									<div class ="scroll_nueva_ventana">
										<span align = "center"class = "titulo_nueva_ventana" id = "nombre_empleado_muestra"></span>
										</br>
										</br>
										<table width = "100%" class = "tabla_nuevos_datos">
											<tr>
												<th >
													<span class = "mostrar_datos" id = "updatae_salario_empleado">EDITAR SALARIO</span>
												</th>
												<th class = "separator"></th>
												<th >
													<span class = "mostrar_datos" id = "inventario_equipo_empleado">EQUIPO</span>
												</th>
											</tr>
										</table>
									</div>
								</div>
								
								<div id = "hoja_inventario_empleado"></div>
								<div id = "nomina_detallado_empleado"></div>
								<div id = "personal_down_contenedor"></div>
								
								
								
								
								
								
								
								
								
								
								
								<!--INFORMACIÓN EMPLEADOS-->
								<div id = "informacion_empleados">
									</br>
									<table width = '100%'>
										<tr>
											<td style = "padding-left:20px;">
												Nombre
												<input type = "text" name = "num_cedula_busqueda" id = "num_cedula_busqueda" />
											</td>
											<td align = "center" width = "20%">
												
											</td>
											<td align = "center" width = "20%">
												<span id= "mostrar_todo_empleados" class = "mostrar_datos">MOSTRAR TODO</span>
											</td>
										</tr>
									</table>
									</br>
									<div id = "contenedor_tabla_empleados">
										<span class = "mostrar_datos" id = "generar_cuadros_empleados">Generar Cuadros</span>
										<span class = "mostrar_datos" id = "generar_cuadros_empleados">Consultar Cuadros</span>
										</br>
										<?php
											$empleado->consultar_datos_empleado($empresa_final);
											/*$empleado->generar_cuadros(1,"2015-03-01");*/
										?>
									</div>
									
								</div>
								
								<!--FORMULARIO PARA AÑADIR EMPLEADO -->
								<div id = "form_nuevo_empleado">
									<div class ="scroll_nueva_ventana">
										<span class = "titulo_nueva_ventana">DATOS NUEVO EMPLEADO</span>
										</br>
										</br>
										<table width = "100%" class = "tabla_nuevos_datos">
											<tr>
												<th align = "left" width = "10%">LEGALES</th>
												<th width = '40%' align = "left"><hr></th>
												<th class = "separator"></th>
												<th nowrap align = "left" width = "10%">LABORALES Y DE SALUD</th>
												<th width = '40%' align = "left"><hr></th>
											</tr>
											<tr>
												<td colspan = "2">
													<p>NOMBRE COMPLETO</p>
													<input type = "text" name = "name_complet" id = "nombre_complet" />
												</td>
												<td class = "separator"></td>
												<td colspan = "2">
													<p>EMPRESA</p>
													<select id = "empresa_empleado">
													<option value = "0"></option>
														<?php
															$sel = mysql_query("select cod_interno_empresa, nombre_comercial_empresa from empresa where cod_interno_empresa = '$empresa_final'");
															while($row = mysql_fetch_array($sel)){
																echo "<option value = '".$row['cod_interno_empresa']."'>".$row['nombre_comercial_empresa']."</option>";
															}
														?>
													</select>
												</td>
											</tr>
											<tr>
												<td nowrap>
													<p>TIPO DE DOCUMENTO</p>
													<select id = "tipo_doc_empleado">
														<option value = "vacio"></option>
														<option value = "C.C">C.C</option>
														<option value = "T.I">T.I</option>
													</select>
												</td>
												<td>
													<p>NÚMERO</p>
													<input type = "text" name = "num_cedula_empleado" id ="num_cedula_empleado" />
												</td>
												<td class = "separator"></td>
												<td colspan = "2">
													<table width = '100%'>
														<tr>
															<td>
																<p>Área</p>
																<select id = "departamento_empleado"></select>
															</td>
															<td>
																<p>Cargo</p>
																<input type = "text" name = "cargo_empleado" id = "cargo_empleado"/>
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<th align = "left" width = "10%">BÁSICA</th>
												<th width = '40%' align = "left"><hr></th>
												<td class = "separator"></td>
												<td colspan = "2">
													<table width = "100%">
														<tr>
															<td>
																<p>EPS</p>
																<input type = "text" id = "eps" />
															</td>
															<td>
																<p>ARL</p>
																<input type = "text" id = "arl" />
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td>
													<table width = '100%'>
														<tr>
															<td width = '30%'>
																<p>SEXO</p>
															</td>
															<td nowrap align = "center" width = '25%'>
																<input type = "radio" name = "sexo" value = "M" />M
															</td>
															<td nowrap align = "center" width = '25%'>
																<input type = "radio" name = "sexo" value = "F" />F
															</td>
															<td></td>
														</tr>
													</table>													
												</td>
												<td>
													<p>FECHA NACIMIENTO</p>
													<input type = "text" name = "fecha_nacimiento_empleado" id = "fecha_nacimiento_empleado" />
												</td>
												<td class = "separator"></td>
												<td colspan = "2">
													<p>FECHA DE INGRESO</p>
													<input type = "text" name = "fecha_ingreso_empleado" id = "fecha_ingreso_empleado" />
												</td>
											</tr>
											<tr>
												<td colspan = "2">
													<p>DIRECCIÓN</p>
													<input type ="text" name = "direccion_empleado" id = "direccion_empleado" />
												</td>
												<td class = "separator"></td>
												<td colspan = "2">
													<p>FONDO DE PENSIONES</p>
													<input type = "text" name = "fondo_pensiones" id = "fondo_pensiones" />
												</td>
											</tr>
											<tr>
												<td colspan = "2">
													<p>TELÉFONO DE CASA</p>
													<input type = "text" name = "phone_casa" id = "phone_casa" />
												</td>
												<td class = "separator"></td>
												<td colspan = "2">
													<p>FONDO DE CESANTÍAS</p>
													<input type = "text" name = "fondo_cesantias" id = "fondo_cesantias" />
												</td>
											</tr>
											<tr>
												<td colspan = "2">
													<p>CELULAR</p>
													<input type = "text" name = "celular_empleado" id = "celular_empleado" />
												</td>
												<td class = "separator"></td>
												<td colspan = "2">
													<p>CAJA DE COMPENSACIÓN</p>
													<input type = "text" name = "caja_compensacion" id = "caja_compensacion" />
												</td>
											</tr>
											<tr>
												<td colspan = "2">
													<p>RH</p>
													<input type = "text" name = "rh" id = "rh" />
												</td>
												<td class = "separator"></td>
												<td colspan = "2">
												</td>
											</tr>
											<tr><td colspan = "5"></br></td></tr>
											<tr>
												<th align = "left" colspan = "1">SALARIAL</th>
												<th colspan = "4"><hr></th>
											</tr>
											<tr>
												<td colspan = "2">
													<p>SALARIO BASE</p>
													<input type = "text" name = "salario_base_empleado" id = "salario_base_empleado" />
												</td>
												<th class = "separator"></th>
												<td colspan = "2">
													<p>Bonos Alimentación</p>
													<input type = "text" name  = "bonos_alimentacion" id = "bonos_alimentacion" />
												</td>
											</tr>
											<tr>
												<td colspan = "2">
													<p>Beneficio No Prestacional</p>
													<input type = "text" name = "bnp" id = "bnp" />
												</td>
												<th class = "separator"></th>
												<td colspan = "2">
													<p>Otros</p>
													<input type = "text" name  = "otros_salario" id = "otros_salario" />
												</td>
											</tr>
											<tr><td colspan = "5"></br></td></tr>
											<tr>
												<td colspan = "2"></td>
												<td class = "separator"></td>
												<td colspan = "2">
													<span class = "botton_verde" id = "cancelar_crear_empleado">CANCELAR</span>
													<span class = "botton_verde" id = "crear_empleado">GUARDAR</span>
												</td>
											</tr>
										</table>
									</div>
								</div>
								
								
								<!--DOCUMENTOS LEGALES X EMPRESA.-->
								<div id = "documentos_legales_x_empresa">
									</br>
									<table width = "100%">
										<tr>
											<td width = "30%">Empresa
												<select id = "empresa_documentos">
													<?php
														$sel = mysql_query("select cod_interno_empresa,nombre_comercial_empresa from empresa where cod_interno_empresa = '$empresa_final'");
														while($row = mysql_fetch_array($sel)){
															echo "<option value = '".$row['cod_interno_empresa']."'>".$row['nombre_comercial_empresa']."</option>";
														}
													?>
												</select>
											</td>
											<td width = "50%"></td>
											<td ALIGN = "center">
												<span id = "ingresar_nuevo_documento" class = "mostrar_datos">NUEVO DOCUMENTO</span>
											</td>
										</tr>
									</table>
									</br>
									<div id = "contenedor_documentos_x_empresa">
										<table id = "tabla_contenedor_documentos_empresas" class = "tablas_muestra_datos_tablas">
											<tr>
												<th>Empresa</th>
												<th>Documento</th>
												<th>Fecha de Vencimiento</th>
												<th>Valor</th>
												<th>Descargar</th>
											</tr>
											<?php
												$gestion->mostrar_datos_por_empresa_documentos($empresa_final);
											?>
										</table>
									</div>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<!--FORMULARIO NUEVO DOCUMENTO-->
			<div id = "form_nuevo_documento">
				<div class ="scroll_nueva_ventana">
					<table width = '100%' class = "tabla_nuevos_datos"> 
						<tr>
							<th >
								
							</th>
							<th class = "separator"></th>
							<th >
								<span class = "titulo_nueva_ventana">FECHA DE VENCIMIENTO (ALERTA)</span>
							</th>
						</tr>
						<tr>
							<td colspan = "3"></br></td>
						</tr>
						<tr>
							<td>
								Empresa
								<select id = "empresa_documentos_subir">
									<option value = "vacio"></option>
									<?php
										$sel = mysql_query("select cod_interno_empresa,nombre_comercial_empresa from empresa where cod_interno_empresa = '$empresa_final'");
										while($row = mysql_fetch_array($sel)){
											echo "<option value = '".$row['cod_interno_empresa']."'>".utf8_encode($row['nombre_comercial_empresa'])."</option>";
										}
									?>
								</select>
							</td>
							<td class = "separator"></td>
							<td>
								Fecha Vencimiento
								<input type = "text" id = "fecha_vencimiento_documento" name = "fecha_vencimiento_documento" /> 
							</td>
						</tr>
						<tr>
							<td colspan = "3"></br></td>
						</tr>
						<tr>
							<td>
								ARCHIVO(PDF)
								<input type = "file" name = "archivo_documento" id = "archivo_documento" on/>
							</td>
							<td class = "separator"></td>
							<td>
								TIPO DE DOCUMENTO
								<select id ="tipo_documento_subir">
									<option value = "vacio"></option>
									<?php
										$sel = mysql_query("select codigo_documento,nombre_documento from tipodoc");
										while($row = mysql_fetch_array($sel)){
											echo "<option value = '".$row['codigo_documento']."'>".utf8_encode($row['nombre_documento'])."</option>";
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan = "3"></br></td>
						</tr>
						<tr>
							<td>
								Valor
								<input type = "text" value = "0" name = "valor" id = "valor" />
 							</td>
							<td class = "separator"></td>
							<td></td>
						</tr>
						<tr>
							<td colspan = "3"></br></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td align = "right">
								<span class = "botton_verde" class = "botones_nueva_ventana" id = "n_cancelar_documento_empresa" >CANCELAR</span>
								<span class = "botton_verde" class = "botones_nueva_ventana" id = "n_guardar_documento_empresa">GUARDAR</span>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<!--CREAR EMPRESA-->
				<div id = "datos_crear_empresa_gestion" title = "DATOS NUEVA EMPRESA" class ="ventanas_add">
					<div class ="scroll_nueva_ventana">
						<span class = "titulo_nueva_ventana">DATOS NUEVA EMPRESA</span>
						</br>
						</br>
						<table id = "tabla_datos_nueva_empresa" class = "tabla_nuevos_datos" width = "100%">
							<tr>
								<th align = "left" width = "10%">LEGALES</th>
								<th width = '40%' align = "left"><hr></th>
								<th class = "separator"></th>
								<th align = "left" width = "10%">INFORMATIVOS</th>
								<th width = '40%' align = "left"><hr></th>
							</tr>
							<tr>
								<td colspan = "2">
									<p>NIT</p>
									<input class = "entradas_bordes" type = "text" name = "n_nit_empresa" id = "n_nit_empresa" />
								</td>
								<td class = "separator"></td>
								<td colspan = "2">
									<p>Iniciales</p>
									<input class = "entradas_bordes" type = "text" name = "n_iniciales_empresa" id = "n_iniciales_empresa" size = "3"/>
								</td>
							</tr>
							<tr>
								<td colspan = "2">
									<p>Nombre Legal</p>
									<input class = "entradas_bordes" type = "text" name = "n_nombre_legal_empresa" id = "n_nombre_legal_empresa" />
								</td>
								<td class = "separator"></td>
								<td colspan = "2">
									<p>Teléfono</p>
									<input class = "entradas_bordes" type = "text" name = "n_telefono_empresa" id = "n_telefono_empresa" />
								</td>
							</tr>
							<tr>
								<td colspan = "2">
									<p>Nombre Comercial</p>
									<input class = "entradas_bordes"type = "text" name = "n_nombre_comercial_empresa" id = "n_nombre_comercial_empresa" />
								</td>
								<td class = "separator"></td>
								<td colspan = "2">
									<p>Dirección</p>
									<input class = "entradas_bordes" type = "text" name = "n_direccion_empresa" id = "n_direccion_empresa" />
								</td>
							</tr>
							<tr>
								<th align = "left" width = "10%">UBICACIÓN</th>
								<th width = '40%' align = "left"><hr></th>
								<th class = "separator"></th>
							</tr>
							<tr>
								<td colspan = "2">
									<div><p>País</p>
									<select class = "entradas_bordes_select" id = "n_pais_empresa" name = "n_pais_empresa">
										<option value = "vacio"></option>
											<?php
											$consulta2 = "select * from pais";
											$result2 = mysql_query($consulta2);
											while($row2 = mysql_fetch_array($result2)){
												echo "<option value = ".$row2['codigo_pais'].">".$row2['nombre_pais']."</option>";
											}
											?>
									</select></div>
								</td>
								<th class = "separator"></th>
								<td colspan = "2">
									<p>Nota Orden</p>
									<textarea class = "entradas_bordes" name = "n_nota_orden_empresa" id = "n_nota_orden_empresa" rows = "4" placeholder = "Nota Orden"></textarea>
								</td>
							</tr>
							<tr>
								<td colspan = "2">
									<table width = "100%">
										<tr>
											<td>
												<p>Departamento</p>
												<select class = "entradas_bordes_select" id = "n_departamento_empresa" name = "n_departamento_empresa" >
												</select>
											</td>
										</tr>
										<tr>
											<td>
												<p>Ciudad</p> 
												<select class = "entradas_bordes_select" id = "n_ciudad_empresa" name = "n_ciudad_empresa"></select>
											</td>
										</tr>
									</table>
									
								</td>
								<th class = "separator"></th>
								<td colspan = "2">
									<p>Nota Presupuesto</p>
									<textarea class = "entradas_bordes" name = "n_nota_ppto_empresa" id = "n_nota_ppto_empresa" rows = "4" placeholder = "Nota Presupuesto"></textarea>
								</td>
							</tr>
							<tr>
								<td colspan = "2" align = "center">
									
								</td>
								<td class = "separator"></td>
								<td colspan = "2" align = "center" >
									<span class = "botton_verde" class = "botones_nueva_ventana" id = "n_cancelar_empresa_gestion" >CANCELAR</span>
									<span class = "botton_verde" class = "botones_nueva_ventana" id = "n_guardar_empresa_gestion">GUARDAR</span>
								</td>
							</tr>
						</table>
					</div>
				</div>	

				<!--MODIFICAR EMPRESA-->
				<div id = "datos_modificar_empresa_gestion" title = "INFORMACIÓN EMPRESA">
					<div class ="scroll_nueva_ventana">
						<span class = "titulo_nueva_ventana">INFORMACIÓN EMPRESA</span>
						</br>
						</br>
						<table WIDTH = "100%" id = "tabla_datos_nueva_empresa" class = "tabla_nuevos_datos">
							<tr>
								<th align = "left">LEGALES</th>
								<th class = "separator"></th>
								<th align = "left">INFORMATIVOS</th>
							</tr>
							<tr>
								<td>
									<p>NIT</p>
									<input class = "entradas_bordes" type = "text" name = "e_nit_empresa" id = "e_nit_empresa" readonly="readonly"/>
								</td>
								<td class = "separator"></td>
								<td>
									<p>Iniciales</p>
									<input class = "entradas_bordes" type = "text" name = "e_iniciales_empresa" id = "e_iniciales_empresa" size = "3"/>
								</td>
							</tr>
							<tr>
								<td>
									<p>Nombre Legal</p>
									<input class = "entradas_bordes" type = "text" name = "e_nombre_legal_empresa" id = "e_nombre_legal_empresa" />
								</td>
								<td class = "separator"></td>
								<td>
									<p>Teléfono</p>
									<input class = "entradas_bordes" type = "text" name = "e_telefono_empresa" id = "e_telefono_empresa" />
								</td>
							</tr>
							<tr>
								<td>
									<p>Nombre Comercial</p><input class = "entradas_bordes"type = "text" name = "e_nombre_comercial_empresa" id = "e_nombre_comercial_empresa" />
								</td>
								<td class = "separator"></td>
								<td>
									<p>Dirección</p>
									<input class = "entradas_bordes" type = "text" name = "e_direccion_empresa" id = "e_direccion_empresa" />
								</td>
							</tr>
							<tr>
								<td colspan = "3">
									<p>Nota Orden</p>
									<textarea class = "entradas_bordes" name = "e_nota_orden_empresa" id = "e_nota_orden_empresa" rows = "4" placeholder = "Nota Orden"></textarea>
								</td>
							</tr>
							<tr>
								<td colspan = "3">
									<p>Nota Presupuesto</p>
									<textarea class = "entradas_bordes" name = "e_nota_ppto_empresa" id = "e_nota_ppto_empresa" rows = "4" placeholder = "Nota Orden"></textarea>
								</td>
							</tr>
							<tr>
								<td colspan = "3"></br></td>
							</tr>
							<tr>
								<td align = "right" colspan = "3">
									<span class = "botton_verde" id = "n_modificar_empresa_gestion" >MODIFICAR</span>
									<span class = "botton_verde" id = "n_cancelar_modificar_empresa_gestion">CANCELAR</span>
								</td>
							</tr>
							</table>
						</div>
					</div>
		</body>