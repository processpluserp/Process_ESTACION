<?php
	
	/*
		Requiere la información de los módulos para complementar su información.
	*/
	require("../Modelo/gestion_cabecera.php");
	require("../Modelo/empleado.php");
	require("../Controller/Conexion.php");
	require("../Modelo/inv_tecnologia.php");
	require("../Modelo/muebles.php");
	require("../Modelo/usuarios.php");
	require("../Modelo/ppto_general.php");
	require("../Modelo/Empresa.php");
	
	session_start();
	
	if($_SESSION["codigo_usuario"] == ""){
		header("location:../logeo.php");
	}
	$empresa_final = $_GET["e"];
	if($empresa_final == ""){
		header("location:bienvenida.php");
	}
	
	
	$inv_tec = new inv_tecnologia();
	$gestion = new cabecera_pagina();
	$empleado = new empleado();
	$muebles = new muebles();
	$usux = new usuario();
	$ppto = new ppto_general();
	$emp = new empresa();
	$codigo_usuario_real = $_SESSION["codigo_usuario"];
	//$festivos = array("[8, 7, 2015]", "[8, 28, 2015]");
	
?>
<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>:: PROCESS + ::</title>
			<meta charset="utf-8" />
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="../js/gestion.js"></script>
			<script type="text/javascript" src="../css_jquery/css_logeo.js"></script>
			<script type="text/javascript" src="../js/gestion_empresa.js"></script>
			<script type="text/javascript" src="../js/gestion2.js"></script>
			<script type="text/javascript" src="../js/gestionf.js"></script>
			
			<script type="text/javascript" src="../js/ocultar.js"></script>
			<script type="text/javascript" src="../js/simulador_costo_empleado.js"></script>
			

			<link rel="stylesheet" href="../css/jquery-ui.css">
			
						
			<link type="text/css" href="../css/tablas.css" rel="stylesheet" />
			<link type="text/css" href="../css/cabecera.css" rel="stylesheet" />
			<link type="text/css" href="../css/empresa.css" rel="stylesheet" />
			<script type="text/javascript" src="../js/resize.js"></script>
			<style >
				#n_face{
					width:50%;
				}
				.estilos_barra td:nth-child(2){
					background-color:rgb(39,170,225);
				}
				
			</style>
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
			
			
		</head>
		<body class = 'scroll'>
			<div id="spinner" class="spinner" style="display:none;">
				<img id="img-spinner" src="../images/spinner.gif" alt="Cargando..."/>
			</div>
			<span id = "empresa_final" class = "hidde"><?php echo $empresa_final;?></span>
			<span id = "user" class = "hidde"><?php echo $codigo_usuario_real;?></span>
			<span id = "periodo_nomina_seleccionado" class = "hidde"></span>
			
			<?php include('cabecera.php'); echo $imprimir;?>
			
			
			<div id = "cuerpo_pagina">
				<table width = '100%'>
					<tr>
						<td>
							<table>
								<tr>
									<td  align = 'left'><span class = "bara_ubicacion" id = "actual">AGENCIA</span></td>
									<td  align = 'left'><span class = "bara_ubicacion">
										<?php
											echo "<a class = 'links_barra_ubicacion' href = 'cliente.php?e=$empresa_final'>CLIENTES</a>"
										?>
									</span></td>
									<td align = 'left'><span class = "bara_ubicacion">
										<?php
											echo "<a class = 'links_barra_ubicacion' href = 'proveedor.php?e=$empresa_final'>PROVEEDORES</a>"
										?>
									</span></td>
									<td align = 'left'><span class = "bara_ubicacion">
										<?php
											echo "<a class = 'links_barra_ubicacion' href = 'banco.php?e=$empresa_final'>BANCOS</a>"
										?>
									</span></td>
								</tr>
							</table>
						</td>
						<td align = 'right'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>
										<table >
											<tr>
												<td>Regresar</td>
												<td>
													<?php
														echo "<a class = 'links_barra_ubicacion' href = 'menu_gestion.php?e=$empresa_final'>
															<img src = '../images/icon/icono_regresar.png' class = 'iconos_barra'/>
														</a>";
													?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<?php
					include('empresa_defect.php');
					$gestion->menu_agencia_perfil($_SESSION["codigo_usuario"]);
				?>
				
				
				<div id = "ventana_permisos_usuarios">
					<table width = '100%'>
						<th width = '96%'>
							<span class = "titulo_ventana">PERMISOS USUARIOS</span>
						</th>
						<th align = 'right'>
							<img id = "cerrar_ventana_permisos"src = "../images/iconos/cerrar.png" width = '30px' height = '30px'/>
						</th>
					</table>
					</br>
					<table width = '100%' class = "botones_opciones">
						<tr>
							<td align = "center"><span id = "abrir_consola_cuentas" class = "mostrar_datos">CUENTAS</span></td>
							<td align = "center"><span id = "" class = "mostrar_datos">TAREAS</span></td>
							<td align = "center"><span id = "" class = "mostrar_datos">MÓDULOS</span></td>
						</tr>
					</table>
				</div>
				
				
				<div id = 'nueva_cuenta_asignar'>
					<table width = '100%'>
						<th width = '96%'>
							<span class = "titulo_ventana">ASIGNAR NUEVA CUENTA</span>
						</th>
						<th align = 'right'>
							<img id = "cerrar_ventana_nueva_cuenta_asignar"src = "../images/iconos/cerrar.png" width = '30px' height = '30px'/>
						</th>
					</table>
					</br>
					<table width = '100%'>
						<tr>
							<td>
								<p>UNIDAD DE NEGOCIO</p>
								<select id = "n_und_negocio_consola"></select>
							</td>
							<td>
								<p>DEPARTAMENTO</p>
								<select id = "n_und_depto_consola"></select>
							</td>
							<td>
								<p>EMPLEADO</p>
								<select id = "n_und_empleado_consola"></select>
							</td>
						</tr>
					</table>
					<table width = '100%'>
						<tr>
							<td>
								<p>CLIENTE</p>
								<select id = "n_cliente_consola"></select>
							</td>
							<td>
								<p>PRODUCTO</p>
								<select id = "n_producto_cliente_consola"></select>
							</td>
						</tr>
					</table>
					</br>
					<table width = '100%'>
						<tr>
							<td align = 'right'>
								<span class = "botton_verde" class = "botones_nueva_ventana" id = "n_cancelar_c_cuenta" >CANCELAR</span>
								<span class = "botton_verde" class = "botones_nueva_ventana" id = "n_guardar_c_cuenta">GUARDAR</span>
							</td>
						</tr>
					</table>
				</div>
				
				
				<div id = "consola_cuentas">
					<table width = '100%'>
						<th width = '96%'>
							<span class = "titulo_ventana">CONSOLA DE CUENTAS</span>
						</th>
						<th align = 'right'>
							<img id = "cerrar_ventana_consola_cuentas"src = "../images/iconos/cerrar.png" width = '30px' height = '30px'/>
						</th>
					</table>
					</br>
					<img id = "agregar_cuenta_empleado" src = "../images/iconos/cerrar.png" width = '30px' height = '30px'>
					</br>
					<table width = '100%'>
						<tr>
							<td>
								<p>UNIDAD DE NEGOCIO</p>
								<select id = "und_negocio_consola"></select>
							</td>
							<td>
								<p>DEPARTAMENTO</p>
								<select id = "und_depto_consola"></select>
							</td>
							<td>
								<p>EMPLEADO</p>
								<select id = "und_empleado_consola"></select>
							</td>
						</tr>
					</table>
					<table width = '100%'>
						<tr>
							<td>
								<p>CLIENTE</p>
								<select id = "cliente_consola"></select>
							</td>
							<td>
								<p>PRODUCTO</p>
								<select id = "producto_cliente_consola"></select>
							</td>
						</tr>
					</table>
					</br>
					<hr>
					<table width = '100%'>
						<tr>
							<td >
								<div id = "contenedor_habilitados_cuenta" >
									
								</div>
							</td>
						</tr>
					</table>
				</div>
				<!-- ADMINISTRACION-->
				
				<div id = "opciones_administracion" class = 'ventana'>
					<table width = '100%' style = 'padding-right:50px;padding-left:50px;'>
						<tr>
							<td width = '90%' >
								
								<table width = '100%'>
									<tr>
										<td align = 'left'>
											<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
										</td>
									</tr>
									<tr>
										<td align = 'left' >
											<span class = 'mensaje_bienvenida'>PARAMETRIZACIÓN</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right' >
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img id = 'cerrar_administracion' src = '../images/iconos/cerrar.png' class = 'iconos_opciones' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					</br>
					<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td width = '52%'>
								<table width = '100%' id = 'panel_opciones' >
									<tr >
										<th align = 'left' >
											<img src = '../images/iconos/parametrizacion_nomina_admin.png' onclick = 'ocultar_submenus_nomina_cuadros("nomina_parametrizacion");mostrar_opciones_nomina("nomina_parametrizacion");' id = 'nomina_parametrizacion' class = 'img_menu_desplieg' />
										</th>
									</tr>
									<tr >
										<td  style = 'padding-left:100px;' nowrap >
											<span  class = 'titulos_hijo_p' id = 'sal_minimo' onclick = 'resaltar_accion("sal_minimo")'  style = 'background-color:rgba(124, 145, 152, 0.14);color:#aaaaaa;'>SALARIO MÍNIMO</span>
										</td>
									</tr>
									<tr>
										<td style = 'padding-left:100px;' nowrap >
											<span  class = 'titulos_hijo_p' id = 'sal_integral' onclick = 'resaltar_accion("sal_integral")'  style = 'background-color:rgba(124, 145, 152, 0.14);color:#aaaaaa;'>SALARIO INTEGRAL</span>
										</td>
									</tr>
									<tr >
										<td style = 'padding-left:100px;' nowrap  >
											<span  class = 'titulos_hijo_p' id = 'monetizacion_sena' onclick = 'resaltar_accion("monetizacion_sena")'  style = 'background-color:rgba(124, 145, 152, 0.14);color:#aaaaaa;'>MONETIZACIÓN SENA</span>
										</td>
									</tr>
									<tr>
										<td  style = 'padding-left:100px;' nowrap >
											<span  class = 'titulos_hijo_p' id = 'aux_transporte' onclick = 'resaltar_accion("aux_transporte")'  style = 'background-color:rgba(124, 145, 152, 0.14);color:#aaaaaa;'>AUX. TRANSPORTE</span>
										</td>
									</tr>
									<tr>
										<th align = 'left' >
											<img src = '../images/iconos/parametrizacion_empresa_admin.png' onclick = 'ocultar_submenus_nomina_cuadros("jerarquia_empresa");ocultar_jerarquia_empresa();' id = 'jerarquia_empresa' class = 'img_menu_desplieg' />
										</th>
									</tr>
									<tr>
										<td  style = 'padding-left:100px;' nowrap>
											<span  class = 'titulos_hijo_p' id = 'und_empresa' onclick = 'resaltar_accion("und_empresa")'  style = 'background-color:rgba(124, 145, 152, 0.14);color:#aaaaaa;'>UNIDADES DE NEGOCIO</span>
										</td>
									</tr>
									<tr>
										<td style = 'padding-left:100px;' nowrap>
											<span  class = 'titulos_hijo_p' id = 'departamentos_empresa' onclick = 'resaltar_accion("departamentos_empresa")'  style = 'background-color:rgba(124, 145, 152, 0.14);color:#aaaaaa;'>DEPARTAMENTOS</span>
										</td>
									</tr>
									<tr>
										<td style = 'padding-left:100px;' nowrap>
											<span  class = 'titulos_hijo_p' id = 'nota_op_produccion' onclick = 'resaltar_accion("nota_op_produccion")'  style = 'background-color:rgba(124, 145, 152, 0.14);color:#aaaaaa;'>NOTAS DOCUMENTOS</span>
										</td>
									</tr>
									<tr>
										<td  style = 'padding-left:100px;' nowrap>
											
											<span  class = 'titulos_hijo_p' id = 'min_valor_pptos' onclick = 'resaltar_accion("min_valor_pptos")'  style = 'background-color:rgba(124, 145, 152, 0.14);color:#aaaaaa;'>MÍNIMO DE PPTOS</span>
										</td>
									</tr>
									<tr>
										<td  style = 'padding-left:100px;' nowrap>
											
											<span  class = 'titulos_hijo_p' id = 'pl_negocio' onclick = 'resaltar_accion("pl_negocio")'  style = 'background-color:rgba(124, 145, 152, 0.14);color:#aaaaaa;'>PLAN DE NEGOCIO</span>
										</td>
									</tr>
									<tr>
										<th align = 'left' >
											<img src = '../images/iconos/parametrizacion_sistema_admin.png' onclick = 'ocultar_submenus_nomina_cuadros("opciones_sistema");ocultar_opciones_sistema();' id = 'opciones_sistema' class = 'img_menu_desplieg' />
										</th>
									</tr>
									<tr>
										<td style = 'padding-left:100px;' nowrap>											
											<span  class = 'titulos_hijo_p' id = 'usuarios_x_empresa' onclick = 'resaltar_accion("usuarios_x_empresa")'  style = 'background-color:rgba(124, 145, 152, 0.14);color:#aaaaaa;'>USUARIOS</span>
										</td>
									</tr>
									<tr>
										<td style = 'padding-left:100px;' nowrap>
											<span  class = 'titulos_hijo_p' id = 'respon_deptos' onclick = 'resaltar_accion("respon_deptos")'  style = 'background-color:rgba(124, 145, 152, 0.14);color:#aaaaaa;'>RESPONSABLES DEPARTAMENTO</span>
										</td>
									</tr>
									<tr>
										<td style = 'padding-left:100px;' nowrap>
											<span  class = 'titulos_hijo_p' id = 'asignados_tareas' onclick = 'resaltar_accion("asignados_tareas")'  style = 'background-color:rgba(124, 145, 152, 0.14);color:#aaaaaa;'>ASIGNADOS</span>
										</td>
									</tr>
									<tr>
										<td style = 'padding-left:100px;' nowrap>
											<span  class = 'titulos_hijo_p' id = 'permisos_usuarios_empresas_p' onclick = 'resaltar_accion("permisos_usuarios_empresas_p")'  style = 'background-color:rgba(124, 145, 152, 0.14);color:#aaaaaa;'>PERMISOS EMPRESA</span>
										</td>
									</tr>
									<tr>
										<td style = 'padding-left:100px;' nowrap>
											<span  class = 'titulos_hijo_p' id = 'permisos_director_usuario_p' onclick = 'resaltar_accion("permisos_director_usuario_p")'  style = 'background-color:rgba(124, 145, 152, 0.14);color:#aaaaaa;'>PERMISOS DIRECTOR</span>
										</td>
									</tr>
									<tr>
										<td style = 'padding-left:100px;' nowrap>
											<span  class = 'titulos_hijo_p' id = 'permisos_clientes_p' onclick = 'resaltar_accion("permisos_clientes_p")'  style = 'background-color:rgba(124, 145, 152, 0.14);color:#aaaaaa;'>PERMISOS CLIENTES</span>
										</td>
									</tr>
								</table>
							</td>
							<td width = '48%' style = 'vertical-align:top;'>
								<div style = 'width:100%height:100%;' id = 'contenedor_opciones_admin' >
								</div>
							</td>
						</tr>
					</table>
					</br>
				</div>
				
				
				<div id = "info_basica_empresa" class = 'ventana'>
					<div id = "contenedor_info_empresa" width = '100%'>
						<?php
							$empresa = new Empresa();
							$empresa->estructura_empresa($empresa->info_basica_empresa($empresa_final),$empresa->info_basica_empresa_ubicacion($empresa_final));
						?>
					</div>
				</div>
				
				<!--CONTENEDORES INFO OPCIONES -->
				<div id = "documentos_legales_empresa" class = 'ventanas_principales ventana' >
					<table width = '100%' style = 'padding-right:50px;padding-left:50px;'>
						<tr>
							<td width = '90%' >
								<!--<span class = 'titulo_nueva_ventana'>DOCUMENTOS LEGALES</br> <?php //$emp->mostrar_logo_empresa($empresa_final); ?></span>-->
								<table width = '100%'>
									<tr>
										<td align = 'left'>
											<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
										</td>
									</tr>
									<tr>
										<td align = 'left' >
											<span class = 'mensaje_bienvenida'>DOCUMENTOS LEGALES</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right' >
								<table width = '100%'>
									<tr>
										<td align = 'center' >
											<img id = "ingresar_nuevo_documento" src = '../images/iconos/icono_doc_nuevo.png' class = 'iconos_opciones' onclick = 'function_abrir_panel_documentos()'/>
										</td>
										<td align = 'center'>
											<img id = 'cerrar_ventana_documentos' src = '../images/iconos/cerrar.png' class = 'iconos_opciones' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					</br>
					<div id = "contenedor_documentos_x_empresass" style = 'padding-right:50px;' >
						<table width = '100%' class = 'tabla_nuevos_datos' style = 'padding-left:50px;'>
							<tr>
								<td >
									<p>Tipo Documento:</p>
									<select id = 'b_tipo_documento' style = 'width:auto;'>
										<?php
											$sql = mysql_query("select codigo_documento,nombre_documento from tipodoc order by nombre_documento asc");
											echo "<option value ='0'>DOCUMENTOS VIGENTES</option>";
											while($row = mysql_fetch_array($sql)){
												echo "<option value ='".$row['codigo_documento']."'>".utf8_encode($row['nombre_documento'])."</option>";
											}
										?>
									</select>
								</td>
							</tr>
						</table>
						</BR>
						<div id = "contenedor_documentos_x_empresa" style = 'overflow:scroll;width:100%;height:70%;padding-left:50px;'>
							<?php
								$gestion->mostrar_datos_por_empresa_documentos($empresa_final);
							?>
						</div>
					</div>
				</div>
				
				<div id = "form_nuevo_documento" class = 'ventana'>
					<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td width = '90%' align = 'left'>
								<table width = '100%'>
								<tr>
									<td align = 'left'>
										<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
									</td>
								</tr>
								<tr>
									<td align = 'left' >
										<span class = 'mensaje_bienvenida'>NUEVO DOCUMENTO LEGAL</span>
									</td>
								</tr>
							</table>
							</td>
							<td align = 'right' style = 'padding-right:50px;'>
								<table width = '100%' class = 'tabla_nuevos_datos2'>
									<tr>
										<td align = 'center' style = 'border:2px solid #87CDF0;border-radius:0.3em;'>
											<img id = "ingresar_nuevo_documento" src = '../images/iconos/icono_doc_nuevo.png' class = 'iconos_opciones' onclick = 'function_abrir_panel_documentos()'/>
										</td>
										<td align = 'center'>
											<img id = 'n_cancelar_documento_empresa_x' src = '../images/iconos/cerrar.png' class = 'iconos_opciones' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				
					<table width = '100%' class = "tablas_formularios" style = 'padding-left:50px;padding-right:50px;'> 
						<tr>
							<th>
							
							</th>
							<th class = "separator"></th>
							<th nowrap>
								<p>Fecha de Vencimiento (ALERTA)</p>
							</th>
						</tr>
						<tr>
							<td width = '49%'>
								<p>Tipo de Documento:</p>
								<select id ="tipo_documento_subir">
									<option value = "vacio"></option>
									<?php
										$sel = mysql_query("select codigo_documento,nombre_documento from tipodoc order by nombre_documento asc");
										while($row = mysql_fetch_array($sel)){
											echo "<option value = '".$row['codigo_documento']."'>".utf8_encode($row['nombre_documento'])."</option>";
										}
									?>
								</select>
							</td>
							<td class = "separator"></td>
							<td>
								<p>Fecha Vencimiento:</p>
								<input type = "text" id = "fecha_vencimiento_documento" name = "fecha_vencimiento_documento" onclick = '$("#ui-datepicker-div").css({"min-width":$("#fecha_vencimiento_documento").width()});'/>
								<span id = 'fecha_numerica_documento'class = 'hidde'></span>
							</td>
						</tr>
						<tr>
							<td colspan = "3"></br></td>
						</tr>
						<tr>
							<td>
								<table width = '100%' >
									<tr>
										<td colspan = '2'><p>Carga de Archivo PDF:</p></td>
										<td ><p>TARIFA:</p></td>
									</tr>
									<tr>
										<td>
											<div class = 'fondo_inputs_file'>
												<input type = "file" name = "archivo_documento" id = "archivo_documento" />
											</div>
										</td>
										<td align = 'right'>
											<img id = 'limpiar_documentos' src = '../images/iconos/eliminar.png' class = 'iconos_eliminar_item'/>
										</td>
										<td>
											<input type = "text"  value = "" name = "valor" id = "valor" onkeyup = 'formatear_valor(event,"valor","text_input_valor_doc")' />
											<span id = 'text_input_valor_doc' class = 'hidde'></span>
										</td>
									</tr>
								</table>
							</td>
							<td class = "separator"></td>
							<td>
								
							</td>
						</tr>
						<tr>
							<td colspan = "3"></br></td>
						</tr>
						<tr>
							<td colspan = "3"></br></td>
						</tr>
						<tr>
							<td>
								<p>Notificar a:</p>
								<input type = "email"  id = "nombre_notificar" onkeyup = 'guardar_notificar_a(event)'/>
								<div id = 'listado_notificar_a'></div>
							</td>
							<td class = "separator"></td>
							<td></td>
						</tr>
						<tr>
							<td colspan = "3"></br></td>
						</tr>
						<tr>
							<td align = "center" colspan = '3' style = 'padding-left:50px;' >
								<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' id = "n_cancelar_documento_empresa"  style = 'position:relative;'>
								<img src = '../images/iconos/guardar_1.png' class = 'mano iconos_guardar_x'   style = 'position:relative;top:45px;left:-50px;z-index:1;opacity:'>
								<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' id = "n_guardar_documento_empresa"  style = 'position:relative;left:-110px;'>
							</td>
						</tr>
					</table>
				</div>
				
				
					
				
							
				<div id = "panel_opciones_financiero" class = 'ventana'>
					<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td width = '96%' align = 'left'>
								<table width = '100%'>
									<tr>
										<td align = 'left'>
											<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
										</td>
									</tr>
									<tr>
										<td align = 'left' >
											<span class = 'mensaje_bienvenida'>CUADROS FINANCIEROS</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right' >
								<table width = '100%'>
									<tr>
										<td align = 'right'>
											<img id = 'cerrar_ventana_panel_financiero' src = '../images/iconos/cerrar.png' class = 'iconos_opciones' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					</br>
					<div style = 'overflow:scroll;width:100%;height:70%;'>
						<table width = '100%'>
							<tr>
								<td width = '40%' height='100%'>
									<table width = '100%' id = 'panel_opciones' >
										<tr >
											<th align = 'left' style = 'vertical-align:top;' id = 'izquierda_panel_cf'>
												<img src = '../images/iconos/ppto_general.png' class = 'img_menu_desplieg'  id = 'consultar_ppto' onclick = 'resaltar_imagen_seleccionada("consultar_ppto")'/>
											</th>
										</tr>
										<tr >
											<th align = 'left' >
												<img src = '../images/iconos/nomina.png' onclick = 'ocultar_submenus_nomina_cuadros("img_nomina_cuadro_f")' id = 'img_nomina_cuadro_f' class = 'img_menu_desplieg' />
											</th>
										</tr>
										<tr class = 'tr_padre_nomina'>
											<td style = 'padding:10px;padding-left:150px;' nowrap>
												<span  class = 'titulos_hijo_p' id = 'crea_nomina_mes' onclick = 'resaltar_accion("crea_nomina_mes")'  style = 'background-color:rgba(124, 145, 152, 0.14);color:#aaaaaa;'>CREAR NÓMINA MES</span>
											</td>
										</tr>
										<tr class = 'tr_padre_nomina'>
											<td style = 'padding:10px;padding-left:150px;' nowrap>
												<span class = 'titulos_hijo_p'  id = 'consultar_nomina' onclick = 'resaltar_accion("consultar_nomina")' style = 'background-color:rgba(124, 145, 152, 0.14);color:#aaaaaa;' >CONSULTAR NÓMINA POR PERIODOS</span>
											</td>
										</tr>
										
										<tr>
											<th align = 'left'  style = 'vertical-align:bottom;'>
												<img src = '../images/iconos/parametrizacion_ppto.png' onclick = 'ocultar_submenus_ppto_cuadros("img_sub_menu_pptos_cuadros")'  class = 'img_menu_desplieg' id = 'img_sub_menu_pptos_cuadros' />
											</th>
										</tr>
										<tr>
											<td style = 'padding:10px;padding-left:150px;' nowrap>
												<span  id = 'admin_ppto' class = 'titulos_hijo_p' onclick = 'resaltar_accion("admin_ppto")' >ADMINISTRAR</span>
											</td>
										</tr>
									</table>
								</td>
								<td width = '100%'>
									<div width = '100%' id = 'contenedor_opciones' style = 'background-color:#dadada;vertical-align:middle;'>
									</div>
								</td>
							</tr>
						</table>
					</div>
					
				</div>
				
					
				<div id ="nuevo_usuario">
					<table width = '100%'>
						<th width = '96%'>
							<span class = "titulo_ventana">USUARIOS</span>
						</th>
						<th align = 'right'>
							<img id = "cerrar_ventana_usuarios_n_empleados" src = "../images/iconos/cerrar.png" width = '30px' height = '30px'/>
						</th>
					</table>
					</br>
					<table width = '100%'>
						<tr>
							<td>
								<p>Empleado</p>
								<select id = "empleado_usuario">
									
								</select>
							</td>
							<td>
								<p>Usuario</p>
								<input type = "text" id = "nickname" />
							</td>
						</tr>
						<tr>
							<td></br></td>
						</tr>
						<tr>
							<td colspan = '2' align = 'right'>
								<span class = "botton_verde" class = "botones_nueva_ventana" id = "n_usuario">GUARDAR</span>
							</td>
						</tr>
					</table>
				</div>
				
				<div id = "usuarios_empleados">
					<table width = '100%'>
						<th width = '96%'>
							<span class = "titulo_ventana">USUARIOS</span>
						</th>
						<th align = 'right'>
							<img id = "cerrar_ventana_usuarios_empleados" src = "../images/iconos/cerrar.png" width = '30px' height = '30px'/>
						</th>
					</table>
					</br>
					<table width = '100%' >
						<tr>
							<td width = '10%'>
								<table>
									<tr>
										<td><img src = "../images/iconos/cerrar.png" height = '40px' width = '40px' id = "nuevo_usuario_empleado"/></td>
										<td align = "left">
											Nuevo
										</td>
									<tr>
								</table>
							</td>
							<td width = '10%'>
								
							</td>
							<td class = "separator"></td>
							<td>
								<table>
									<tr>
										<td class = "separator"></td>
										<td>Usuario</td>
										<td >
											<input class =""type = "text" name = "b_usuario" id = "b_usuario" />
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right'>
								<span class ="mostrar_datos" id = "mostrar_all_usuarios">MOSTRAR DATOS</span>
							</td>
						</tr>
					</table>
					<div id = "contenedor_listado_usuario">
						<?php
							
							$usux->estrutura_tabla_usuarios($usux->mostrar_datos_s($empresa_final));
						?>
					</div>
				</div>
				<div id ="datos_empleados_empresa" class = 'ventana'>
					<table width = '100%' height = '10%' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td width = '90%' align = 'left'>
								<table width = '100%'>
									<tr>
										<td align = 'left'>
											<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
										</td>
									</tr>
									<tr>
										<td align = 'left' >
											<span class = 'mensaje_bienvenida'>EMPLEADOS</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right'>
								<table width = '100%'>
									<tr>
										<td align = 'center'  align = 'center'>
											<?php
												echo "<a id = 'link_impresion_empleados_pdf' target = '_blank' href = 'generar_pdf_listado_empleados.php?ee=$empresa_final&c=0&n=0x&u=0&d=0&e=1'><img src = '../images/iconos/pdf.png'  class = 'iconos_opciones' title = 'Imprimir' /></a>";
											?>
										</td>
										<td align = 'center'  align = 'center'>
											<img id = 'nuevo_empleado_real'src = '../images/iconos/icon_ad_empleado.png' class = 'iconos_opciones' />
										</td>
										<td align = 'center'  align = 'center'>
											<img id = 'nuevo_empleado'src = '../images/iconos/icono_adicionar_contacto.png' class = 'iconos_opciones' />
										</td>
										<td align = 'center'>
											<img id = 'cerrar_ventana_datos_empleados' src = '../images/iconos/cerrar.png' class = 'iconos_opciones' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<div id="tabs" >
					  <ul style = 'padding-left:50px;'>
						<li class = 'pestanas_menu' ><a href="#tabs-1">Empleados</a></li>
						<li class = 'pestanas_menu' id = 'pestana_sim'><a href="#tabs-2">Prospectos</a></li>
					  </ul>
					  <div id="tabs-1" style = 'padding-left:50px;'>
						<table class = 'barra_busqueda' width = '100%'>
							<tr>
								<td>
									<p >Nombre:</p>
									<input type = "text" name = "b_nombre_empleado" id = "b_nombre_empleado" />
								</td>
								<td style = 'padding-left:5px;padding-right:5px;'>
									<p >Cédula:</p>
									<input type = "text" name = "b_cedula_empleado" id = "b_cedula_empleado" />
								</td>
								<td style = 'padding-left:5px;padding-right:5px;'>
									<p >Uni. De Negocio:</p>
									<select id = "und_filtro_empleado">
										<option value = '0'>--</option>
									</select>
								</td>
								<td style = 'padding-left:5px;padding-right:5px;'>
									<p >Área:</p>
									<select id = "depto_filtro_empleado">
										<option value = '0'>--</option>
									</select>
								</td>
								<td>
									<p >Estado:</p>
									<select id = "estado_empleados" onchange = 'filtrar_empleados_estado()'>
										<option value = '1' selected>Activos</option>
										<option value = '0'>Inactivos</option>
									</select>									
								</td>
								<td nowrap align = 'right'>
									<img src = '../images/iconos/mostrar_todo.png' id = "mostrar_all_empleados" width = '150px' title = 'MOSTRAR TODOS LOS EMPLADOS'/>
								</td>
							</tr>
						</table>
						<div id = "contenedo_tabla_muestra_empleados" style = 'min-height:300px;overflow-y:hidden;'>
							<?php
							?>
						</div>
					  </div>
					  
					  <div id="tabs-2" style = 'padding-left:50px;'>
						<table width = '100%' class = 'barra_busqueda'>
							<tr>
								<td>
									<p>Nombre:</p>
									<input type = "text" name = "b_nombre_simulador" id = "b_nombre_simulador" />
								</td>
							</tr>
						</table>
						</br>
						<div id = "listado_simulaciones" style = 'min-height:300px;overflow-y:hidden;'>
							
						</div>
					  </div>
					</div>
				</div>
				
				<div id = "info_basica_empleado" class = 'ventana'>
					
					
				</div>
				
				<div id = "nomina_detallado_empleados" class = 'ventana'>
					<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td width = '96%' align = 'left'>
								<table width = '100%'>
									<tr>
										<td align = 'left'>
											<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
										</td>
									</tr>
									<tr>
										<td align = 'left' >
											<span class = 'mensaje_bienvenida' id = 'cuadro_financiero_titulo_nomina'>NOMINA DETALLADO</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right' >
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img id = 'cerrar_ventana_nde' src = '../images/iconos/cerrar.png' class = 'iconos_opciones' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					</br>
					<div id = "contenedor_nde" style = 'padding-left:50px;padding-right:50px;overflow:scroll;width:95%;height:80%;'></div>
				</div>
				
				<div id = "indepm_liqui_empleados" class = 'ventana'>
					<table width = '100%'  style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td width = '96%' align = 'left'>
								<table width = '100%'>
									<tr>
										<td align = 'left'>
											<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
										</td>
									</tr>
									<tr>
										<td align = 'left'>
											<span class = 'mensaje_bienvenida' id = 'cuadro_financiero_titulo_indli'>INDEMNIZACIONES Y LIQUIDACIONES</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right'>
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img id = 'cerrar_ventana_inlie' src = '../images/iconos/cerrar.png' class = 'iconos_opciones' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					</br>
					<div id = "contenedor_inlie" style = 'padding-left:50px;overflow:scroll;width:95%;height:80%;'></div>
				</div>
				
				<div id = "ppto_general_empleados">
					<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td width = '96%' align = 'left'>
								<table width = '100%'>
									<tr>
										<td align = 'left'>
											<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
										</td>
									</tr>
									<tr>
										<td align = 'left'>
											<span class = 'mensaje_bienvenida' id = 'cuadro_financiero_titulo'>PPTO GENERAL</span> <span class = 'mensaje_bienvenida' id = 'und_negocio_ppto_general_texto'></span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right'>
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img id = 'cerrar_ventana_ppto_general_empleados' src = '../images/iconos/cerrar.png' class = 'iconos_opciones' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<table id = 'tabla_todos_los_mes_ppto_general' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td>
								<div><input type = 'checkbox' value = '1' id = 'oa_all_mes' class = 'radio' onchange = 'ocultar_mes_all(0)' checked/>
								<label for='oa_all_mes'><span><span></span></span>Ocultar / Visualizar Todo</label></div>
							</td>
						</tr>
						<tr class = 'checkbox_ppto_general'>
							<td>
								<div><input type = 'checkbox' value = '1' id = 'enero' class = 'radio' onchange = 'ocultar_mes(1)' checked/>
								<label for='enero'><span><span></span></span>ENERO</label></div>
							</td>
							<td>
								<div><input type = 'checkbox' value = '1' id = 'febrero' class = 'radio' onchange = 'ocultar_mes(2)' checked/>
								<label for='febrero'><span><span></span></span>FEBRERO</label></div>
							</td>
							<td>
								<div><input type = 'checkbox' value = '1' id = 'marzo' class = 'radio' onchange = 'ocultar_mes(3)' checked/>
								<label for='marzo'><span><span></span></span>MARZO</label></div>
							</td>
							<td>
								<div><input type = 'checkbox' value = '1' id = 'abril' class = 'radio' onchange = 'ocultar_mes(4)' checked/>
								<label for='abril'><span><span></span></span>ABRIL</label></div>
							</td>
							<td>
								<div><input type = 'checkbox' value = '1' id = 'mayo' class = 'radio' onchange = 'ocultar_mes(5)' checked/>
								<label for='mayo'><span><span></span></span>MAYO</label></div>
							</td>
							<td>
								<div><input type = 'checkbox' value = '1' id = 'junio' class = 'radio' onchange = 'ocultar_mes(6)' checked/>
								<label for='junio'><span><span></span></span>JUNIO</label></div>
							</td>
						</tr>
						<tr class = 'checkbox_ppto_general'>
							<td>
								<div><input type = 'checkbox' value = '1' id = 'julio' class = 'radio' onchange = 'ocultar_mes(7)' checked/>
								<label for='julio'><span><span></span></span>JULIO</label></div>
							</td>
							<td>
								<div><input type = 'checkbox' value = '1' id = 'agosto' class = 'radio' onchange = 'ocultar_mes(8)' checked/>
								<label for='agosto'><span><span></span></span>AGOSTO</label></div>
							</td>
							<td>
								<div><input type = 'checkbox' value = '1' id = 'septiembre' class = 'radio' onchange = 'ocultar_mes(9)' checked/>
								<label for='septiembre'><span><span></span></span>SEPTIEMBRE</label></div>
							</td>
							<td>
								<div><input type = 'checkbox' value = '1' id = 'octubre' class = 'radio' onchange = 'ocultar_mes(10)' checked/>
								<label for='octubre'><span><span></span></span>OCTUBRE</label></div>
							</td>
							<td>
								<div><input type = 'checkbox' value = '1' id = 'novimebre' class = 'radio' onchange = 'ocultar_mes(11)' checked/>
								<label for='novimebre'><span><span></span></span>NOVIEMBRE</label></div>
							</td>
							<td>
								<div><input type = 'checkbox' value = '1' id = 'diciembre' class = 'radio' onchange = 'ocultar_mes(12)' checked/>
								<label for='diciembre'><span><span></span></span>DICIEMBRE</label></div>
							</td>
						</tr>
					</table>
					<!--<span style = 'padding-left:50px;'id = 'editable' ondblclick = 'agregar_item_ppto()'>HAGA DOBLE CLICK PARA AGREGAR UN ITEM</span>-->
					<div id = "contenedor_ppto_general_empleados" style = 'overflow:scroll;width:100%;height:70%;'></div>
				</div>
				
				<div id = "ventana_reportar_novedad_vacaciones">
					<table width = '100%' style = 'padding-right:50px;padding-left:50px;'>
						<tr>
							<td width = '96%' align = 'left'>
								<table width = '100%'>
									<tr>
										<td align = 'left'>
											<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
										</td>
									</tr>
									<tr>
										<td align = 'left' >
											<span class = 'mensaje_bienvenida' >REPORTE DE NOVEDADES</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right'>
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img id = 'cerrar_ventana_rvacaciones' src = '../images/iconos/cerrar.png' class = 'iconos_opciones' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					</br>
					<table width = '100%'class = 'tabla_nuevos_datos2' style = 'padding-right:50px;padding-left:50px;'>
						<tr>
							<td>
								<p>Seleccione la Fecha de Inicio De Vacaciones(*):</p>
								<input type = 'text' id = 'fi_vacaciones' />
								<span id = 'fri_vacaciones' class = 'hidde'></span>
							</td>
							<td style = 'padding-left:20px;'>
								<p>Seleccione la Fecha Final De Vacaciones(*):</p>
								<input type = 'text' id = 'ff_vacaciones' />
								<span id = 'frf_vacaciones' class = 'hidde'></span>
							</td>
						</tr>
						<tr>
							<td>
								<p>Seleccione el Tipo de Novedad:</p>
								<select id = 'tipo_novedad' style = 'width:auto;'>
									<option value = '1'>VACACIONES DISFRUTADAS</option>
									<option value = '2'>ANTICIPO DE VACACIONES</option>
									<option value = '3'>VACACIONES REMUNERADAS</option>
								</select>
							</td>
						</tr>
						<tr><td></br></td></tr>
						<tr>
							<td colspan = '2'align = 'center'>
								<span class = "botton_verde" id = "cancelar_reportar_novedad_vacaciones_empleado">CANCELAR</span>
								<span class = "botton_verde" id = "crear_vacaciones_reporte_empleado">GUARDAR</span>
							</td>
						</tr>
					</table>
				</div>
				
				<div id = "modificar_info_empleado"  style = 'padding-right:50px;'>
					<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td width = '96%' align = 'left'>
								<table width = '100%'>
									<tr>
										<td align = 'left'>
											<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
										</td>
									</tr>
									<tr>
										<td align = 'left' >
											<span class = 'mensaje_bienvenida' id = 'cuadro_financiero_titulo'>HOJA DE VIDA</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right'>
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img id = 'reportar_novedad_vacaciones' src = '../images/iconos/reportar_novedad.png' class = 'iconos_opciones' />
										</td>
										<td align = 'center'>
											<img id = 'cerrar_ventana_hje' src = '../images/iconos/cerrar.png' class = 'iconos_opciones' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					</br>
					<div id = "contenedor_hj" style = 'overflow:scroll;width:45%;height:75%;margin: 0 auto;'></div>
				</div>
				
				<div id = "simulador_costo_empleado_sistema" class = 'ventana'>
					<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td width = '96%' align = 'left'>
								<table width = '100%'>
									<tr>
										<td align = 'left'>
											<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
										</td>
									</tr>
									<tr>
										<td align = 'left' >
											<span class = 'mensaje_bienvenida' id = 'cuadro_financiero_titulo'>SIMULADOR DE COSTOS</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right'>
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img id = 'cerrar_ventana_sme' src = '../images/iconos/cerrar.png' class = 'iconos_opciones' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<div id = "contenedor_hjs" style = 'overflow:scroll;width:auto;height:80%;padding-left:50px;padding-right:50px;'></div>
				</div>
				<div id = 'simulador_costo_nuevo_empleado' class = 'ventana'>
					<table width = '100%' style = 'padding-left:50px;padding-right:50px;' >
						<tr>
							<td width = '96%' align = 'left'>
								<table width = '100%'>
									<tr>
										<td align = 'left'>
											<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
										</td>
									</tr>
									<tr>
										<td align = 'left'>
											<span class = 'mensaje_bienvenida'>NUEVO PROSPECTO</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right' >
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img id = 'cerrar_ventana_simulador' src = '../images/iconos/cerrar.png' class = 'iconos_opciones' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<table width = 'auto' class = 'tabla_nuevos_datos' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td>
								<table >
									<tr>
										<td style = 'padding-right:30px;'>
											<p>Nombre Nuevo Empleado:</p>
										</td>
										<td style = 'padding-right:30px;' >
											<p>Modalidad de Pago:</p>
										</td>
										<td style = 'padding-right:30px;'>
											<p>Salario:</p>
										</td>
									</tr>
									<tr>
										<td style = 'padding-right:30px;'>
											<input type = 'text' id = 'nombre_simulador'/>
										</td>
										<td style = 'padding-right:30px;'>
											<select id = 'modalidad_pago'>
												<?php
													$sql = mysql_query("select id,name from modalidad_pago_sal where estado = '1'");
													$imp = "<option value = '0'>[SELECCIONE]</option>";
													while($row = mysql_fetch_array($sql)){
														$imp .="<option value ='".$row['id']."'>".$row['name']."</option>";
													}
													echo $imp;
												?>
											</select>
										</td>
										<td style = 'padding-right:30px;'>
											<input type = 'text' id = 'salario' onkeyup='formatear_valor(event,"salario","salario_sim")'/>
											<span class = 'hidde' id = 'salario_sim'></span>
										</td>
										<td style = 'padding-left:30px;'>
											<span class = 'botton_verde' id = 'guardar_nombre_simulador' style = 'padding-left:25px;padding-right:25px;'>Guardar</span>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					</br>
					<div  style = 'padding-left:50px;padding-right:50px;width:95%;height:70%;'>
						<div id = 'contenedor_simulador' style = 'overflow:scroll;width:99.5%;height:96.5%;border:1px solid black;border-radius:1.3em;-moz-border-radius:1.3em;-webkit-border-radius:1.3em;margin:0 auto;' ></div>
					</div>
				</div>
				
				<div id = "form_nuevo_empleado" class = 'ventana'>
						<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
							<tr>
								<td width = '90%' align = 'left'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>
												<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
											</td>
										</tr>
										<tr>
											<td align = 'left' >
												<span class = 'mensaje_bienvenida'>DATOS NUEVO EMPLEADO</span>
											</td>
										</tr>
									</table>
								</td>
								<td align = 'right'>
									<img id = 'cerrar_ventana_form_empleados' src = '../images/iconos/cerrar.png' class = 'iconos_opciones' />
								</td>
							</tr>
						</table>
						<div style = 'overflow:scroll;width:100%;height:82%;'>
							<table width = "100%" class = "tabla_nuevos_datos" style = 'padding-left:50px;padding-right:50px;'>
								<tr>
									<th align = 'left'width = '49%' colspan = '2' nowrap></th>
									<th class = 'separator' width = '5%'></th>
									<th nowrap align = 'left' colspan = '2' width = '49%'>LABORALES Y DE SALUD</th>
								</tr>
								<tr>
									<td colspan = "2"  align = 'center' style = 'vertical-align:middle;'>
										<div id = "foto">
										</div>
										<table width = '100%'>
											<tr>
												<td width = '96%' >
													<input type = 'file' id = 'foto_empleado' />
												</td>
												<td align = 'right'>
													<img id = "limpiar_foto_empleado"src = "../images/iconos/eliminar.png" width = '40px' height = '40px'/>
												</td>
											</tr>
										</table>
									</td>
									<td class = "separator"></td>
									<td style="padding-right:25px;" width = '25%'>
										<p>Fecha Ingreso:</p>
										<input type = "text" name = "fecha_ingreso_empleado" id = "fecha_ingreso_empleado" onclick='$("#ui-datepicker-div").css({"min-width":$("#fecha_ingreso_empleado").width()});'/>
									</td>
									<td >
										<p>Fecho Retiro:</p>
										<input type = "text" name = "fecha_retiro_empleado" id = "fecha_retiro_empleado" onclick='$("#ui-datepicker-div").css({"min-width":$("#fecha_retiro_empleado").width()});'/>
									</td>
								</tr>
								<tr>
									<td colspan = "2" >
										<p>Nombre Completo:</p>
										<input type = "text" name = "name_complet" id = "nombre_complet" />
									</td>
									<td class = "separator"></td>
									<td colspan = '2'>
										<table width = '100%'>
											<tr>
												<td>
													<p>Unidad Negocio:</p>
													<select id = "und_empleado"></select>
												</td>
												<td>
													<p>Área:</p>
													<select id = "departamento_empleado"></select>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td nowrap style="padding-right:25px;">
										<p>Tipo de Documento</p>
										<select id = "tipo_doc_empleado">
											<option value = "vacio"></option>
											<option value = "C.C">C.C</option>
											<option value = "C.C">C.E</option>
											<option value = "T.I">T.I</option>
										</select>
									</td>
									<td>
										<p>Número:</p>
										<input type = "text" name = "num_cedula_empleado" id ="num_cedula_empleado" />
									</td>
									<td class = "separator"></td>
									<td colspan = '2'>
										<p>Cargo:</p>
										<input type = "text" name = "cargo_empleado" id = "cargo_empleado"/>
									</td>
								</tr>
								<tr>
									<td style="padding-right:25px;">
										<table width = '100%'>
											<tr>
												<td colspan = '2'>
													<table width = '100%'>
														<tr>
															<td width = '30%'>
																<p>Sexo:</p>
															</td>
															<td nowrap align = "center" width = '25%'>
																<div><input type = 'radio' value = 'M' id = 'sm' name = 'sexo'  class = 'radio'/>
																	<label for='sm'><span><span></span></span>M</label></div>
															</td>
															<td nowrap align = "center" width = '25%'>
																<div><input type = 'radio' value = 'F' id = 'sf' name = 'sexo'  class = 'radio'/>
																	<label for='sf'><span><span></span></span>F</label></div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
									<td>
										<p>Fecha Nacimiento:</p>
										<input type = "text" name = "fecha_nacimiento_empleado" id = "fecha_nacimiento_empleado" onclick='$("#ui-datepicker-div").css({"min-width":$("#fecha_nacimiento_empleado").width()});'/>
									</td>
									<td class = "separator"></td>
									<td  colspan = '2'>
										<p>EPS:</p>
										<select id = "eps" >
											<?php
												$sql = mysql_query("select id,name from eps order by name asc");
												echo "<option value ='0'>[SELECCIONE]</option>";
												while($row = mysql_fetch_array($sql)){
													echo "<option value ='".$row['id']."'>".$row['name']."</option>";
												}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td style = 'padding-right:25px;'>
										<p>Dirección:</p>
										<input type ="text" name = "direccion_empleado" id = "direccion_empleado" />
									</td>
									<td >
										<p>Correo Personal:</p>
										<input type ="text" name = "correo_personal" id = "correo_personal" />
									</td>
									<td class = "separator"></td>
									<td colspan = "2">
										<p>Fondo de Cesantías:</p>
										<select id = "fondo_cesantias" >
											<?php
												$sql = mysql_query("select id,name from fcesantias order by name asc;");
												echo "<option value ='0'>[SELECCIONE]</option>";
												while($row = mysql_fetch_array($sql)){
													echo "<option value ='".$row['id']."'>".$row['name']."</option>";
												}
											?>
										</select>
									</td>						
								</tr>
								<tr>
									<td style = 'padding-right:25px;'>
										<p>Celular:</p>
										<input type = "text" name = "celular_empleado" id = "celular_empleado" />
									</td>
									<td >
										<p>Teléfono de Casa:</p>
										<input type = "text" name = "phone_casa" id = "phone_casa" />
									</td>
									<td class = "separator"></td>
									<td colspan = '2'>
										<p>ARL:</p>
										<select id = "arl" >
											<?php
												$sql = mysql_query("select id,name from arl order by name asc");
												echo "<option value ='0'>[SELECCIONE]</option>";
												while($row = mysql_fetch_array($sql)){
													echo "<option value ='".$row['id']."'>".$row['name']."</option>";
												}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td style = 'padding-right:25px;'>
										<p>RH:</p>
										<select id = "rh" />
											<?php
												$sql = mysql_query("select id,name from rh order by name asc");
												echo "<option value ='0'>[SELECCIONE]</option>";
												while($row = mysql_fetch_array($sql)){
													echo "<option value ='".$row['id']."'>".$row['name']."</option>";
												}
											?>
										</select>
									</td>
									<td>
										<p>Correo Institucional:</p>
										<input type = "text" name = "correo" id = "correo" />
									</td>
									<td class = "separator"></td>
									<td colspan = "2">
										<p>Fondo de Pensiones:</p>
										<select id =  "fondo_pensiones">
											<?php
												$sql = mysql_query("select id,name from fpensiones order by name asc");
												echo "<option value ='0'>[SELECCIONE]</option>";
												while($row = mysql_fetch_array($sql)){
													echo "<option value ='".$row['id']."'>".$row['name']."</option>";
												}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td style = 'padding-right:25px;'>
										<p>Nombre Contacto de Emergencia:</p>
										<input type = 'text' name = 'person_contacto' id = 'person_contacto' />
									</td>
									<td>
										<p>Número de Contacto:</p>
										<input type = 'text' name = 'num_person_contacto' id = 'num_person_contacto' />
									</td>
									<td class = "separator"></td>
									<td colspan = "2">
										<p>Caja de Compensación:</p>
										<select  id = "caja_compensacion" >
											<?php
												$sql = mysql_query("select id,name from ccompensacion order by name asc");
												echo "<option value ='0'>[SELECCIONE]</option>";
												while($row = mysql_fetch_array($sql)){
													echo "<option value ='".$row['id']."'>".$row['name']."</option>";
												}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan = '2' style = 'vertical-align:middle;'>
										<table width = '100%'>
											<tr>
												<p>Número de Hijos:</p>
												<select id = 'num_hijos' name = 'num_hijos' onchange = 'hijos_empleados()'>
													<option value = '0'>0</option>
													<option value = '1'>1</option>
													<option value = '2'>2</option>
													<option value = '3'>3</option>
													<option value = '4'>4</option>
													<option value = '5'>5</option>
												</select>
											</tr>
											<tr>
												<td id = 'contenedor_hijos_empleados'>
													<table width = '100%' class = 'tabla_hijos'>
														<tr class = 'contenedor_num_hijos'>
															<td style = 'padding-right:25px;'>
																<input type = 'text' name = 'name0' id = 'name0' placeholder = 'Nombre Hijo'/>
															</td>
															<td>
																<input type = 'text' name = 'fn0' id = 'fn0' placeholder = 'Fecha Nacimiento'/>
															</td>
														</tr>
														<tr class = 'contenedor_num_hijos'>
															<td style = 'padding-right:25px;'>
																<input type = 'text' name = 'name1' id = 'name1' placeholder = 'Nombre Hijo'/>
															</td>
															<td>
																<input type = 'text' name = 'fn1' id = 'fn1' placeholder = 'Fecha Nacimiento'/>
															</td>
														</tr>
														<tr class = 'contenedor_num_hijos'>
															<td style = 'padding-right:25px;'>
																<input type = 'text' name = 'name2' id = 'name2' placeholder = 'Nombre Hijo'/>
															</td>
															<td>
																<input type = 'text' name = 'fn2' id = 'fn2' placeholder = 'Fecha Nacimiento'/>
															</td>
														</tr >
														<tr class = 'contenedor_num_hijos'>
															<td style = 'padding-right:25px;'>
																<input type = 'text' name = 'name3' id = 'name3' placeholder = 'Nombre Hijo'/>
															</td>
															<td>
																<input type = 'text' name = 'fn3' id = 'fn3' placeholder = 'Fecha Nacimiento'/>
															</td>
														</tr>
														<tr class = 'contenedor_num_hijos'>
															<td style = 'padding-right:25px;'>
																<input type = 'text' name = 'name4' id = 'name4' placeholder = 'Nombre Hijo'/>
															</td>
															<td>
																<input type = 'text' name = 'fn4' id = 'fn4' placeholder = 'Fecha Nacimiento'/>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
										
									</td>
									<td class = "separator"></td>
								</tr>
								<tr></tr>
								<tr></tr>
								<tr>
									<tH colspan = '2' align = 'left'>SALARIAL</tH>
									<td class = "separator"></td>
									<td colspan = "2">
										
									</td>
								</tr>
								<tr>
									<td colspan = "2">
										<p>Salario Base:</p>
										<input type = "text" name = "salario_base_empleado" id = "salario_base_empleado" />
									</td>
									<td class = "separator"></td>
									<td colspan = "2">
										<p>Beneficio No Prestacional:</p>
										<input type = "text" name = "bnp" id = "bnp" />
									</td>
								</tr>
								<tr>
									<td colspan = "2">
										<p>Bonos Alimentación:</p>
										<input type = "text" name  = "bonos_alimentacion" id = "bonos_alimentacion" />
									</td>
									<td class = "separator"></td>
									<td colspan = "2">
										<p>Otros:</p>
										<input type = "text" name  = "otros_salario" id = "otros_salario" />
									</td>
								</tr>
								<tr><td colspan = "5"></br></td></tr>
								<tr>
									<td colspan = "2" align = "center" style = 'vertical-align:middle;' >
										<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' id = "cancelar_crear_empleado" style = 'position:relative;left:40%' />
									</td>
									<td  style = 'vertical-align:top;' >
										<img src = '../images/iconos/guardar_1.png' class = 'iconos_guardar_x'   style = 'position:relative;top:0px;z-index:1;' />
									</td>
									<td colspan = "2" align = "center"  style = 'vertical-align:middle;' >
										<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' id = "crear_empleado" style = 'position:relative;left:-40%;'/>
									</td>
								</tr>
							</table>
						</div>
					
				</div>
			</div>
		</body>
	</html>