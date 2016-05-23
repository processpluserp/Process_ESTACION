<?php
	require("../Modelo/gestion_cabecera.php");
	require("../Modelo/empleado.php");
	require("../Controller/Conexion.php");
	require("../Modelo/usuarios.php");
	require("../Modelo/proveedor.php");
	require("../Modelo/cliente.php");
	require("../Modelo/Empresa.php");
	session_start();
	if($_SESSION["codigo_usuario"] == ""){
		header("location:../logeo.php");
	}
	$empresa_final = $_GET["e"];
	if($empresa_final == ""){
		header("location:bienvenida.php");
	}
	
	$gestion = new cabecera_pagina();
	$empleado = new empleado();
	$pro = new proveedor();
	$usux = new usuario();
	$cliente = new cliente();
	$emp = new empresa();
	$codigo_usuario_real = $_SESSION["codigo_usuario"];
?>
<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>:: PROCESS + ::</title>
			<meta charset="utf-8" />
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script type="text/javascript" src="../css_jquery/css_logeo.js"></script>
			<script type="text/javascript" src="../js/gestion.js"></script>
			<script type="text/javascript" src="../js/gestion_empresa.js"></script>
			<script type="text/javascript" src="../js/gestion2.js"></script>
			<script type="text/javascript" src="../js/proveedor.js"></script>
			<link type="text/css" href="gestion_final.css" rel="stylesheet" />
			<link rel="stylesheet" href="../css/jquery-ui.css">
			<link type="text/css" href="../css/tablas.css" rel="stylesheet" />
			<link type="text/css" href="../css/cabecera.css" rel="stylesheet" />
			<link type="text/css" href="../css/proveedor.css" rel="stylesheet" />
			<style >
				.estilos_barra td:nth-child(2){
					background-color:rgb(39,170,225);
				}
				.tabla_nuevos_datos input,.tabla_nuevos_datos textarea,.tabla_nuevos_datos select{
					width:90%;
					border-radius:0.2em;
					border:2px solid #9D9B99;
				}
				img,.botones_opciones span,#ingresar_nuevo_documento,.botton_verde,#mostrar_all_usuarios,
				#mostrar_all_empleados{
					cursor:pointer;
				}
				#listado_contactos_cliente p{
					text-align:center;
				}
			</style>
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
			<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="../js/resize.js"></script>
			<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
		</head>
		<body>
			<div id="spinner" class="spinner" style="display:none;">
				<img id="img-spinner" src="../images/spinner.gif" alt="Cargando..."/>
			</div>
			<span id = "empresa_final" class = "hidde"><?php echo $empresa_final;?></span>
			<span id = "periodo_nomina_seleccionado" class = "hidde"></span>
			<?php include('cabecera.php'); echo $imprimir;?>
			
			<div id = "cuerpo_pagina">
				<table width = '100%'>
					<tr>
						<td>
							<table>
								<tr>
									<td  align = 'left'><span class = "bara_ubicacion" >
										<?php
											echo "<a class = 'links_barra_ubicacion' href = 'gestion.php?e=$empresa_final'>AGENCIA</a>"
										?>
									</span></td>
									<td  align = 'left'><span class = "bara_ubicacion" >
										<?php
											echo "<a class = 'links_barra_ubicacion' href = 'cliente.php?e=$empresa_final'>CLIENTES</a>"
										?>
									</span></td>
									<td><span class = "bara_ubicacion" id = "actual">PROVEEDOR</span></td>
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
														echo "<a class = 'links_barra_ubicacion' href = 'menu_gestion.php?empresa_trabajo=$empresa_final'>
															<img src = '../images/icon/icono_regresar.png'  class = 'iconos_barra'/>
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
					$gestion->menu_proveedor_perfil($_SESSION["codigo_usuario"]);
				?>
				
				<!--INFORMACIÓN BÁSICA -->
				<div id = "informacion_basica" class = 'ventana'>
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
											<span class = 'mensaje_bienvenida'>PROVEEDORES</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right' >
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img id = 'add_proveedor' src = '../images/iconos/nuevo_proveedor.png' class = 'iconos_opciones' />
										</td>
										<td align = 'center'>
											<img id = 'cerrar_ventana_informacion_basica' src = '../images/iconos/cerrar.png' class = 'iconos_opciones' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<table  class = 'barra_busqueda2' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td style = 'padding-right:25px;'>
								<p>Nit:</p>
								<input type = 'text' id = 'b_nit_proveedor'/>
							</td>
							<td>
								<p>Nombre:</p>
								<input type = 'text' id = 'b_name_proveedor'/>
							</td>
						</tr>
					</table>
					</br>
					<div style = 'overflow:scroll;padding-left:50px;padding-right:50px;' id = "contenedor_informacion_basica_proveedores" class = 'contenedores_info_provee'>
					
					</div>
				</div>
				
				<div id = "ventana_proveedor_info" class = 'ventana'></div>
				
				<!--FORMULARIO NUEVO PROVEEDOR -->
				<div id = "form_nuevo_proveedor" class = 'ventana'>
					<div class = "scroll_nueva_ventana">
						<table width = '100%'  style = 'padding-left:50px;padding-right:50px;'>
							<tr>
								<td width = '96%'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>
												<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
											</td>
										</tr>
										<tr>
											<td align = 'left'>
												<span class = 'mensaje_bienvenida'>NUEVO PROVEEDOR</span>
											</td>
										</tr>
									</table>
								</td>
								<td align = 'right'>
									<table width ='100%'>
										<tr>
											<td align = 'center'>
												<img id = "cerrar_ventana_nuevo_proveedor" src = "../images/iconos/cerrar.png" class = 'iconos_opciones'/>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						</br>
						<table width = '100%' class = 'tabla_nuevos_datos2' style = 'padding-right:50px;'>
							<tr>
								<th style = 'padding-left:50px;' align = "left" width = "49%" colspan = '2'>LEGALES</th>
								<td class = "separator"></td>
								<th align = "left" width = "49%" colspan = '2'>UBICACIÓN</th>
							</tr>
							<tr>
								<td style = 'padding-left:50px;' colspan = "2">
									<p>Razón Social:</p>
									<input type = "text" class = "entradas_bordes" id = "n_ncomercial_proveedor" />
								</td>
								<td class = "separator"></td>
								<td colspan = "2">
									<table width = '100%'>
										<tr>
											<td>
												<p>País:</p>
											</td>
											<td>
												<p>Departamento:</p>
											</td>
											<td>
												<p>Ciudad:</p>
											</td>
										</tr>
										<tr>
											<td>
												<select id = "n_pais_empresa" >
													<option value = "0"></option>
													<?php
														$sql = mysql_query("select codigo_pais, nombre_pais from pais");
														while($row = mysql_fetch_array($sql)){
															echo "<option value ='".$row['codigo_pais']."'>".$row['nombre_pais']."</option>";
														}
													?>
												</select>
											</td>
											<td>
												<select id = "n_departamento_empresa" ></select>
											</td>
											<td>
												<select id = "n_ciudad_empresa" ></select>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style = 'padding-left:50px;' colspan = "2">
									<p>Nombre Legal:</p>
									<input type = "text" class = "entradas_bordes" id = "n_nlegal_proveedor" />
								</td>
								<td class = "separator"></td>
								<td>
									<p>Dirección:</p>
									<input type = "text" class = "entradas_bordes" id = "n_direccion_proveedor" />
								</td>
								<td>
									<p>Teléfono:</p>
									<input type = "text" class = "entradas_bordes" id = "n_telefono_proveedor" />
								</td>
							</tr>
							<tr>
								<td style = 'padding-left:50px;' colspan = '2'>
									<p>Nit:</p>
									<input type = "text" class = "entradas_bordes" id = "n_nit_proveedor" />
								</td>
								<td class = "separator"></td>
								<td>
									<p>Correo:</p>
									<input type = "text" class = "entradas_bordes" id = "n_correo_proveedor" />
								</td>
							</tr>
							<tr><td></br></td></tr>
							<tr>
								<th  style = 'padding-left:50px;' colspan = '5' align = 'left'>ASOCIACIÓN</th>
							</tr>
							<tr><td></br></td></tr>
							<tr>
								<?php
									$pro->asociar_empresa_proveedor();
								?>
							</tr>
							<tr>
								<td colspan = "5" align = 'center'>
									<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' id = "cancelar_crear_proveedor" style = 'position:relative;'>
									<img src = '../images/iconos/guardar_1.png' class = 'iconos_guardar_x'   style = 'position:relative;top:45px;left:-50px;z-index:1;opacity:'>
									<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' id = "crear_proveedor" style = 'position:relative;left:-110px;'>
								</td>
							</tr>
						</table>
					</div>
				</div>
				
				<!--DOCUMENTOS PROVEEDOR-->
				<div id = "documentos_proveedor" class = 'ventana'>
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
												<span class = 'mensaje_bienvenida'>DOCUMENTOS</span>
											</td>
										</tr>
									</table>
								</td>
								<td align = 'right' >
									<table width = '100%'>
										<tr>
											<td>
												<img id = "abrir_adicionar_nuevo_documento" src = "../images/iconos/icono_doc_nuevo.png" class = 'iconos_opciones'/>
											</td>
											<td>
												<img id = "cerrar_ventana_documentos_proveedor" src = "../images/iconos/cerrar.png" class = 'iconos_opciones'/>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						</br>
						<div id = "contenedor_listado_documentos_proveedor" style = 'padding-left:50px;padding-right:50px;'>
							
						</div>
				</div>
				
				<!--FORMULARIO PARA SUBIR DOCUMENTOS DE LOS PROVEEDORS-->
				<div id = "nuevo_documento_proveedor" class = 'ventana'>
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
											<span class = 'mensaje_bienvenida'>NUEVO DOCUMENTO</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right'>
								<table width = '100%'>
									<tr>
										<td>
											<img id = "cerrar_ventana_n_documentos_proveedor" src = "../images/iconos/cerrar.png" class = 'iconos_opciones'/>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					</br>
					<span id = "codigo_proveedor" class = "hidde"></span>
					<table width = '100%' class = 'tabla_nuevos_datos2' style = 'padding-right:50px;padding-left:50px;'>
						<tr>
							<td>
								</br></br>
							</td>
						</tr>
						<tr>
							<td>
								<p>Seleccione el Tipo de Documento:</p>
								<Select id = "documento_proveedor">
									<option value = '1'>CÁMARA Y COMERCIO</option>
									<option value = '4'>CÉDULA</option>
									<option value = '5'>CERTIFICACIÓN BANCARIA</option>
									<option value = '3'>CONTRATO DE CONFIDENCIALIDAD</option>
									<option value = '2'>RUT</option>									
								</select>
							</td>
							<td class = 'separator'></td>
							<td>
								<p>Seleccione un Archivo:</p>
								<table width = '100%'>
									<tr>
										<td>
											<input type = 'file' id = "doc_proveedor" name = 'doc_proveedor' />
										</td>
										<td>
											<img id = "limpiar_arc_documento" src = "../images/iconos/eliminar.png" class = 'iconos_eliminar_item'/>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								</br></br></br>
							</td>
						</tr>
						<tr style = 'display:none;'class = 'contrato_confidencialidad'>
							<td>
								<p>Fecha de Contrato:</p>
								<input type = 'text' id = 'fecha_contrato' />
							</td>
							<td class = 'separator'></td>
							<td>
								<p>Fecha de Firma:</p>
								<input type = 'text' id = 'fecha_firma_contrato' />
							</td>
						</tr>
						<tr>
							<td>
								</br></br></br>
							</td>
						</tr>
						<tr style = 'display:none;' class = 'contrato_confidencialidad'>
							<td>
								<p>Fecha de Terminación:</p>
								<input type = 'text' id = 'fecha_terminacion_contrato' />
							</td>
							<td class = 'separator'></td>
						</tr>
						<tr><td></br></td></tr>
						<tr><td></br></td></tr>
						<tr>
							<td>
								</br></br></br>
							</td>
						</tr>
						<tr>
							<td colspan = "3" align ="center">
								<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' id = "cancelar_crear_doc_proveedor" style = 'position:relative;'>
								<img src = '../images/iconos/guardar_1.png' class = 'iconos_guardar_x'   style = 'position:relative;top:45px;left:-50px;z-index:1;opacity:'>
								<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' id = "crear_doc_proveedor" style = 'position:relative;left:-110px;'>
							</td>
						</tr>
					</table>
				</div>
				
				
				<!--CONTACTOS DEL PROVEEDOR-->
				<div id = "contactos_proveedor" class = 'ventana'>
					<div class = "scroll_nueva_ventana">
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
												<span class = 'mensaje_bienvenida'>CONTACTOS PROVEEDORES</span>
											</td>
										</tr>
									</table>
								</td>
								<td align = 'right'>
									<table width = '100%'>
										<tr>
											<td>
												<img id = "abrir_adicionar_nuevo_contacto" src = "../images/iconos/icono_nuevo_contacto.png" class = 'iconos_opciones'/>
											</td>
											<td>
												<img id = "cerrar_ventana_contactos_x_proveedor" src = "../images/iconos/cerrar.png" class = 'iconos_opciones'/>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						</br>
						<table class = 'barra_busqueda2' style = 'padding-left:50px;'> 
							<tr>
								<td >
									<p>Proveedor</p>
									<select id = "listado_proveedores"></select>
								</td>
							</tr>
						</table>
						</br>
						<div id = "contenedor_contactos_proveedor" class= 'contenedores_info_provee' style = 'padding-left:50px;padding-right:50px;'>
							<?php
								echo "<table width = '100%' class = 'tablas_muestra_datos_tablas displaydocx'>
										<tr>
											<th>NOMBRE</th>
											<th>CARGO</th>
											<th>CORREO</th>
											<th>TELÉFONO</th>
											<th>CELULAR</th>
										</tr>";
									for($re = 0; $re < 15; $re++){
										echo "<tr>
											<td style = 'font-size:17px;padding:20px;'></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>";
									}
								echo "</table>";
								?>
						</div>
					</div>
				</div>
				
				<!--NUEVO CONTACTO PROVEEDOR -->
				<div id = "nuevo_contacto_proveedor" CLASS = 'ventana'>
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
											<span class = 'mensaje_bienvenida'>NUEVO CONTACTO</span>
										</td>
									</tr>
								</table>
								
							</td>
							<td align = 'right'>
								<table width = '100%'>
									<tr>
										<td>
											<img id = "cerrar_ventana_n_contactos_proveedor" src = "../images/iconos/cerrar.png" class = 'iconos_opciones'/>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					</br>
					</br>
					</br>
					<table width = '100%' class = 'tabla_nuevos_datos2' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td>
								<p>NOMBRE:</p>
								<input type = "text" id = "nombre_contacto" />
							</td>
							<td>
								<p>CARGO:</p>
								<input type = "text" id = "cargo_contacto" />
							</td>
							<td>
								<p>TELÉFONO:</p>
								<input type = "text" id = "telefono_contacto" />
							</td>
							<td>
								<p>CELULAR:</p>
								<input type = "text" id = "celular_contacto" />
							</td>
						</tr>
						<tr>
							<td>
								</br>
								</br>
								</br>
							</td>
						</tr>
						<tr>
							<td>
								<p>CORREO:</p>
								<input type = "text" id = "correo_contacto" />
							</td>
							<td>
								<p>MES:</p>
								<select id = "mes_contacto" >
									<option value = '0'>[SELECCIONE]</option>
									<option value = '1'>Enero</option>
									<option value = '2'>Febrero</option>
									<option value = '3'>Marzo</option>
									<option value = '4'>Abril</option>
									<option value = '5'>Mayo</option>
									<option value = '6'>Junio</option>
									<option value = '7'>Julio</option>
									<option value = '8'>Agosto</option>
									<option value = '9'>Septiembre</option>
									<option value = '10'>Octubre</option>
									<option value = '11'>Noviembre</option>
									<option value = '12'>Diciembre</option>
								</select>
							</td>
							<td>
								<p>DÍA:</p>
								<input type = "number" id = "dia_contacto" max = '31'/>
							</td>
						</tr>
						<tr>
							<td>
								</br>
								</br>
								</br>
							</td>
						</tr>
						<tr>
							<td>
								</br>
								</br>
								</br>
							</td>
						</tr>
						<tr>
							<td></br></td>
						</tr>
						<tr>
							<td></br></td>
						</tr>
						<tr>
							<td colspan = "4" align = 'center'>
								<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' id = "cancelar_crear_contacto_proveedor" style = 'position:relative;'>
								<img src = '../images/iconos/guardar_1.png' class = 'iconos_guardar_x'   style = 'position:relative;top:45px;left:-50px;z-index:1;opacity:'>
								<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' id = "crear_contacto_proveedor" style = 'position:relative;left:-110px;'>
							</td>
						</tr>
					</table>
				</div>
				
				<!--ACUERDOS Y TARIFARIO-->
				<div id = "acuerdo_tarifario" class = 'ventana'>
					<div class = "scroll_nueva_ventana">
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
												<span class = 'mensaje_bienvenida'>TARIFARIO PROVEEDORES</span>
											</td>
										</tr>
									</table>
								</td>
								<td align = 'right' >
									<table width = '100%'>
										<tr>
											<td>
												<img id = "cerrar_ventana_contactos_proveedor" src = "../images/iconos/cerrar.png" class = 'iconos_opciones'/>
											</td>
										</tr>
									</table>
									
								</td>
							</tr>
						</table>
						<table width = '100%'>
							<tr>
								<td width = '30%'>
									<table width = '100%' id = 'panel_opciones' style = 'border-spacing:  5px;'>
										<tr >
											<th align = 'left' style = 'vertical-align:top;' >
												<img src = '../images/iconos/GRUPOS.png' class = 'img_menu_desplieg'  colspan  ='2' id = 'add_grupos_tarifario' onclick="resaltar_imagen_seleccionada('add_grupos_tarifario')"/>
											</th>
										</tr>
										<tr>
											<!--<th class = 'titulo_padre_p mano' align = 'center' nowrap  colspan = '2' id = 'add_subgrupos_tarifario'  style = 'padding-bottom:30px;padding-top:30px;'>
												SUBGRUPOS
											</th>-->
											<th align = 'left' style = 'vertical-align:top;' >
												<img src = '../images/iconos/SUBGRUPOS.png' class = 'img_menu_desplieg'  colspan  ='2' id = 'add_subgrupos_tarifario' onclick="resaltar_imagen_seleccionada('add_subgrupos_tarifario')"/>
											</th>
										</tr>
										<tr>
											<!--<th class = 'titulo_padre_p mano' align = 'center' nowrap  colspan = '2' id = '' style = 'padding-bottom:30px;padding-top:30px;'>
												ITEMS
											</th>-->
											<th align = 'left' style = 'vertical-align:top;' >
												<img src = '../images/iconos/ITEMS.png' class = 'img_menu_desplieg'  colspan  ='2' id = 'add_item_tarifario_item' onclick="resaltar_imagen_seleccionada('add_item_tarifario_item')"/>
											</th>
										</tr>
									</table>
								</td>
								<td colspan = '68%' style = 'padding-right:50px;overflow:scroll;'>
									<div width = '100%' id = 'contenedor_opciones_admin' style = 'background-color:rgb(218, 218, 218);'>
										<table  class = 'tabla_nuevos_datos2' style = 'display:none;' id = 'menu_grupo_tarifario' align = 'center'>
											<tr>
												<td style = 'vertical-align:middle;' align = 'center'>
													<p>Ingrese el Nombre del Grupo:</p>
													<input type = "text" id = "nombre_grupo" style = 'width:250px;'/>
												</td>
											</tr>
											<tr>
												<td  align = 'center'>
													<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' id = "cancelar_nuevo_grupo" style = 'position:relative;'>
													<img src = '../images/iconos/guardar_1.png' class = 'iconos_guardar_x'   style = 'position:relative;top:45px;left:-50px;z-index:1;opacity:'>
													<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' id = "crear_nuevo_grupo" style = 'position:relative;left:-110px;'>
												</td>
											</tr>
										</table>
										<form id = 'nuevo_item_tarifario_form'>
										<table width = '100%' class = 'tabla_nuevos_datos2'  id = 'menu_tarifario_tarifario' style = 'display:none;'>
											<tr>
												<td style = 'padding-left:10%;' align = 'left' width = '45%'>
													<!--<p>Seleccione un Proveedor:</p>
													<select id = 'listado_proveedores_tarifario' style = 'width:200px;'></select>-->
													<p>Seleccione un Grupo:</p>
													<select name = 'listado_grupos_item_tarifario' id = 'listado_grupos_item_tarifario' ></select>
												</td>
												<td class = 'separator' ></td>
												<td style = 'padding-right:10%;'  align = 'left' width = '45%'>
													<p>Seleccione un Subgrupo:</p>
													<select name = 'listado_subgrupos_grupos_tarifario' id = 'listado_subgrupos_grupos_tarifario' ></select>
												</td>
											</tr>
											<tr>
												<td style = 'padding-left:10%;'  align = 'left'>
													<p>Ingrese el Nombre del Item:</p>
													<input type = 'text' name = 'nombre_item_tarifario' />
												</td>
												<td class = 'separator'></td>
												<td style = 'padding-right:10%;'  align = 'left'>
													<p>Ingrese Tarifa:</p>
													<input type = 'text' name = 'tarifa_item_tarifario' value = '0' />
												</td>
											</tr>
											<tr>
												<td style = 'padding-left:10%;'  align = 'left'>
													<p>Ingrese el Iva:</p>
													<input type = 'text' name = 'iva_item_tarifario' value = '16' />
												</td>
												<td class = 'separator'></td>
												<td style = 'padding-right:10%;' align = 'left'>
													<p>Porcentaje de Volúmen:</p>
													<input type = 'text' name = 'vol_tarifa_item_ppto' value = '0' />
												</td>
											</tr>
											<tr>
												<td style = 'padding-left:10%;' align = 'left'>
													<p>Porcentaje de Descuentos Adicionales:</p>
													<input type = 'text' name = 'adicional_item_tarifario' value = '0' />
												</td>
												<td class = 'separator'></td>
												<td style = 'padding-right:10%;' align = 'center'>
													
												</td>
											</tr>
									</form>
											<tr>
												<td colspan = '3'  align = 'center'>
													<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' id = "cancelar_nuevo_grupo" style = 'position:relative;'>
													<img src = '../images/iconos/guardar_1.png' class = 'iconos_guardar_x'   style = 'position:relative;top:45px;left:-50px;z-index:1;opacity:'>
													<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' id = "crear_nuevo_itemgrupo" style = 'position:relative;left:-110px;'>
												</td>
											</tr>
										</table>
										
										<table width = '100%' class = 'tabla_nuevos_datos2' style = 'display:none;vertical-align:middle;' id = 'menu_subgrupo_tarifario'>
											
											<tr>
												<td align = 'center' style = 'padding-left:20%;padding-right:20%;'>
													<p align = 'left'>Seleccione el Grupo:</p>
													<select id = 'listado_grupos_tarifario'></select>
												</td>
											</tr>
											<tr>
												<td style = 'padding-left:20%;padding-right:20%;' align = 'center'>
													<p align = 'left'>Ingrese el Nombre del Subgrupo:</p>
													<input type = "text" id = "nombre_subgrupo" />
												</td>
											</tr>
											
											<tr>
												<td  align = 'center' colspan = '2'>
													<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' id = "cancelar_nuevo_grupo" style = 'position:relative;'>
													<img src = '../images/iconos/guardar_1.png' class = 'iconos_guardar_x'   style = 'position:relative;top:45px;left:-50px;z-index:1;opacity:'>
													<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' id = "crear_nuevo_subgrupo" style = 'position:relative;left:-110px;'>
												</td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
				
				<div id = "nuevo_grupo_tarifario">
					
				</div>
				
				<div id = "nuevo_item_tarifario">
					<div class = "scroll_nueva_ventana">
						<table width = '100%'>
							<tr>
								<th width = '96%'>
									<span class = "titulo_ventana">NUEVO GRUPO</span>
								</th>
								<th align = 'right'>
									<img id = "cerrar_ventana_item_tarifario" src = "../images/iconos/cerrar.png" width = '30px' height = '30px'/>
								</th>
							</tr>
						</table>
						</br>
						
						<table width = '100%'>
							<tr>
								<td colspan = '2'>
									<p>Grupo</p>
									<select id ='grupos_item'></select>
								</td>
							</tr>
							<tr>
								<td colspan = '2'>
									<p>Nombre Item</p>
									<input type = "text" id = "nombre_item" />
								</td>
							</tr>
							<tr>
								<td>
									<p>Valor</p>
									<input type = "text" id = "valor_item" />
								</td>
								<td>
									<p>Iva (%)</p>
									<input type = "text" id = "iva_item" value = '16'/>
								</td>
							</tr>
							<tr>
								<td>
									<p>Volumen (%)</p>
									<input type = "text" id = "volumen" value = '0'/>
								</td>
								<td>
									
								</td>
							</tr>
							<tr><td></br></td></tr>
							<tr>
								<td colspan = "2" align = 'right'>
									<span class = "botton_verde" id = "cancelar_nuevo_item">CANCELAR</span>
									<span class = "botton_verde" id = "crear_nuevo_item">GUARDAR</span>
								</td>
							</tr>
						</table>
					</div>
				</div>
				
				<div id = "contenedor_nuevo_acuerdo" >
					<div class = "scroll_nueva_ventana">
						<table width = '100%'>
							<tr>
								<th width = '96%'>
									<span class = "titulo_ventana">CONTACTOS</span>
								</th>
								<th align = 'right'>
									<img id = "cerrar_ventana_auc_proveedor" src = "../images/iconos/cerrar.png" width = '30px' height = '30px'/>
								</th>
							</tr>
						</table>
						</br>
						<table width = '100%'>
							<tr>
							<td>
								<p>Fecha Firma</p>
								<input type = "text" id = "fecha_firma"/>
							</td>
							<td>
								<p>Fecha Terminación</p>
								<input type = "text" id = "fecha_terminacion"/>
							</td>
							</tr>
						</table>
						<table width = '100%'>
							<tr>
								<td>
								<p>Documento</p>
								<table width = '100%'>
									<tr>
										<td>
											<input type = 'file' id = "acu_proveedor" name = 'acu_proveedor' />
										</td>
										<td>
											<img id = "limpiar_acu_documento" src = "../images/iconos/cerrar.png" width = '15px' height = '15px'/>
										</td>
									</tr>
									</table>
								</td>
							</tr>
							<tr><td></br></td></tr>
						</table>
						
						<table width = '100%'>
							<tr><td></br></td></tr>
						</table>
						<table width = '100%'>
							<tr>
								<td colspan = "3" align = 'right'>
									<span class = "botton_verde" id = "cancelar_crear_acuerdo_proveedor">CANCELAR</span>
									<span class = "botton_verde" id = "crear_acuerdo_proveedor">GUARDAR</span>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</body>
	</html>