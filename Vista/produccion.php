<?php
	include("../Controller/Conexion.php");
	require("../Modelo/gestion_cabecera.php");
	require("../Modelo/Empresa.php");
	session_start();
	if($_SESSION["codigo_usuario"] == ""){
		header("location:../logeo.php");
	}
	$usuario_actual = $_SESSION["codigo_usuario"];
	$nombre_usuario = $_SESSION["nombre_usuario"];
	$gestion = new cabecera_pagina();
	$emp = new empresa();
	
	$codigo_usuario_real = $_SESSION["codigo_usuario"];
	$empresa_final = $gestion->mostrar_empresa_empleado();
?>
<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>:: PROCESS + ::</title>
			<meta charset="utf-8" />
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script type="text/javascript" src="../css_jquery/css_logeo.js"></script>
			<!--<link type="text/css" href="../css/barra_navegacion2.css" rel="stylesheet" />-->
			
			<script type="text/javascript" src="../js/produccion.js"></script>
			<script type="text/javascript" src="../js/resize.js"></script>
			<script type="text/javascript" src="../js/ocultar.js"></script>
			<link rel="stylesheet" href="../css/jquery-ui.css">
			<style >
				.ui-tabs .ui-tabs-active a, .ui-tabs .ui-tabs-active a:hover{
				  background-color: #EF8C14;
				}
				.estilos_barra td:nth-child(4){
					background-color:#EF8C14;
				}
				.tabla_reportes{
					border-collapse:collapse;
					font-size:12px;
				}
				
				.tabla_reportes tr td:first-child{
					border-left:1px solid black;
				}
				
				.tabla_reportes td{
					padding-left:5px;
					
				}
				
				.th_report{
					background-color:rgb(217,217,217);
					color:black;
					border:1px solid black;
					padding-left:5px;
					padding-right:5px;
				}
				
			</style>
			<link type="text/css" href="../css/tablas.css" rel="stylesheet" />
			<link type="text/css" href="../css/cabecera.css" rel="stylesheet" />
			<link type="text/css" href="../css/produccion.css" rel="stylesheet" />

			
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
			<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
			
		</head>
		<body class = 'scroll'>
			<?php include('cabecera.php'); echo $imprimir;?>
			
			
			<span id = "codigo_usuario" class = 'hidde'><?php echo $_SESSION["codigo_usuario"]; ?></span>
			<span id = "perfil_usuario" class = 'hidde'><?php echo $_SESSION["perfil"]; ?></span>
			<div id="spinner" class="spinner" style="display:none;">
				<img id="img-spinner" src="../images/spinner.gif" alt="Cargando..."/>
			</div>
			
			
			<div id = "formato_nuevo_ppto"  class = 'ventana'>
				
			</div>
			
			<!--FORMULARIO PARA CARGAR UN PPTO -->
			<div id ="fomr_carga_ppto" class = 'ventana'>
				
			</div>
			
			<div id = "cuerpo_pagina">
				<table width = '100%'>
					<tr>
						<td align = 'right'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>
										<table >
											<tr>
												<td>Regresar</td>
												<td>
													<?php
														echo "<a class = 'links_barra_ubicacion' href = 'bienvenida.php'>
															<img src = '../images/iconos/icon-16.png' width = '45px' height = '45px'/>
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
					$gestion->menu_produccion_perfil($_SESSION["codigo_usuario"]);
				?>


				<div  id = 'reportes_produccion' class = 'ventana'></div>

				<div id = 'v_recepcion_fact' class = 'ventana' style = 'padding-right:50px;background-color:white;border-radius:0.5em;-moz-border-radius:0.5em;-webkit-border-radius:0.5em;'>
					<table width= '100%' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td width = '96%'>
								<table width = '100%' >
								<tr>
									<td align = 'left'>
										<?php echo  $emp->mostrar_logo_empresa($gestion->mostrar_empresa_empleado()); ?>
									</td>
								</tr>
								<tr>
									<td align = 'left' >
										<span class = 'mensaje_bienvenida'>FACTURACIÓN</span>
									</td>
								</tr>
							</table>
							</td>
							<td align = 'right'>
								<img src = '../images/iconos/icon-19.png' onclick = "$('#v_recepcion_fact').dialog('close');$('.scroll').css({'overflow-y':'scroll'});" class = 'iconos_opciones mano' />
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
											<th align = 'left' style = 'vertical-align:top;' id = 'izquierda_panel_cf' class = 'mano'>
												<img src = '../images/iconos/barras-48.png' class = 'img_menu_desplieg'  id = 'recepcion_fact_img' onclick = 'resaltar_imagen_seleccionada("recepcion_fact_img");$(".todo_fact").hide();$(".hijos_recepcion_facturacion").toggle();'/>
											</th>
										</tr>
										<tr >
											<th align = 'left' class = 'mano'>
												<img src = '../images/iconos/barras-49.png' onclick = 'resaltar_imagen_seleccionada("img_nomina_cuadro_fxx");$(".todo_fact").hide();$(".hijos_facturacion_pptos").toggle();' id = 'img_nomina_cuadro_fxx' class = 'img_menu_desplieg' />
											</th>
										</tr>
										<tr >
											<th align = 'left' class = 'mano'>
												<img src = '../images/iconos/barras-50.png' onclick = 'resaltar_imagen_seleccionada("img_nomina_cuadro_fx");$(".todo_fact").hide();$(".hijos_tesoreria_cliente").toggle();' id = 'img_nomina_cuadro_fx' class = 'img_menu_desplieg' />
											</th>
										</tr>
										
										<tr>
											<th align = 'left'  style = 'vertical-align:bottom;' class = 'mano'>
												<img src = '../images/iconos/barras-51.png' onclick = 'ocultar_submenus_ppto_cuadros("img_sub_menu_pptos_cuadros");$(".todo_fact").hide();$(".hijos_pagos_proveedores_pagos").toggle();'  class = 'img_menu_desplieg' id = 'img_sub_menu_pptos_cuadros' />
											</th>
										</tr>
									</table>
								</td>
								<td width = '100%'>
									<div  id = 'contenedor_opciones' style = 'background-color:#dadada;vertical-align:middle;width:90%;'>
										<table width = '100%' class = 'hijos_recepcion_facturacion todo_fact' style = 'display:none;'>
											<tr >
												<td width = '100%' style = 'padding-left:20px;'>
													<table class = 'tabla_nuevos_datos'>
														<tr>
															<td style = 'padding-left:15px;'>
																<p>Ingrese el Número de OC:</p>
																<input type = 'text' id = 'num_orden_b_rf' class = 'entradas_bordes'/>
															</td>
															<td style = 'padding-left:20px;vertical-align:bottom;'>
																<img src = '../images/iconos/lupa_naranja.png' class = 'botones_opciones mano' onclick = 'buscar_orden_compra();'id = 'buscar_orden'/>
															</td>
														</tr>
													</table>
													</br>
													<div id = 'contenedor_result_facturas'style = 'min-height:300px;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'>								
													</div>
												</td>
											</tr>
										</table>
										<table width = '100%' class = 'hijos_facturacion_pptos todo_fact' style = 'display:none;'>
											<tr >
												<td width = '100%' >
													<div width = '100%' style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'>
														<table width = '100%' class = 'tabla_nuevos_datos2' style = 'padding-left:10%;padding-right:10%;'>
															<tr>
																<td width = '49%'>
																	<p>Seleccione una Empresa:</p>
																	<select class = "entradas_bordes" id = "empresa_b_facturacion" name = 'empresa_b_facturacion'  >
																		<option value = 0>Todas las empresas</option>
																		<?php
																			$consulta = "SELECT e.nombre_comercial_empresa, e.cod_interno_empresa from empresa e, pusuemp p
																			where e.cod_interno_empresa = p.cod_empresa and p.cod_usuario = '$usuario_actual'";
																			$result = mysql_query($consulta);
																			while($row = mysql_fetch_array($result)){
																				echo "<option value=".$row['cod_interno_empresa'].">".utf8_encode($row['nombre_comercial_empresa'])."</option>";
																			}
																		?>
																	</select>
																</td>
																<td class = 'separator' width = '2%'></td>
																<td width = '49%'>
																	<p>Seleccione un Cliente:</p>
																	<select id = 'cliente_b_facturacion' name = 'cliente_b_facturacion'>
																		<option value = '0'>[SELECCIONE]</option>
																	</select>
																</td>
															</tr>
															<tr>
																<td>
																	<p>Seleccione un Producto:</p>
																	<select id = 'producto_cliente_b_facturacion' name = 'producto_cliente_b_facturacion'>
																		<option value = '0'>[SELECCIONE]</option>
																	</select>
																</td>
																<td class = 'separator' width = '2%'></td>
																<td>
																	<p>Seleccione una OT:</p>
																	<select id = 'ot_producto_cliente_b_facturacion' name = 'ot_producto_cliente_b_facturacion'>
																		<option value = '0'>[SELECCIONE]</option>
																	</select>
																</td>
															</tr>
															<tr>
																<td>
																	<p>Seleccione un Prespupuesto:</p>
																	<select id = 'ppto_ot_producto_cliente_b_facturacion' name = 'ppto_ot_producto_cliente_b_facturacion'>
																		<option value = '0'>[SELECCIONE]</option>
																	</select>
																</td>
																<td class = 'separator' width = '2%'></td>
																<td>
																	<p>Ingrese el Número de Factura:</p>
																	<input type = 'text' class = 'entradas_bordes' id = 'num_factura_ppto' name = 'num_factura_ppto'  />
																</td>
															</tr>
															<tr>
																<td>
																	<p>Ingrese el Valor de la Factura:</p>
																	<input type = 'text' class = 'entradas_bordes' id = 'valor_factura_ppto' name = 'valor_factura_ppto'  onkeyup = 'formatear_valor(event,"valor_factura_ppto","valor_factura_ppto_real")'/>
																	<span class = 'hidde' id = 'valor_factura_ppto_real'></span>
																</td>
																<td class = 'separator' width = '2%'></td>
																<td>
																	<p>Ingrese la Fecha de la Factura:</p>
																	<input type = 'text' class = 'entradas_bordes' id = 'fecha_factura_ppto' name = 'fecha_factura_ppto'  />
																</td>
															</tr>
															<tr>
																<td colspan = '3' align = 'center'>
																	<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' id = "limpiar_campos_ingresar_factura" style = 'position:relative;'>
																	<img src = '../images/iconos/guardar_1.png' class = 'iconos_guardar_x'   style = 'position:relative;top:45px;left:-50px;z-index:1;'>
																	<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' id = "guardar_factura_ppto"  style = 'position:relative;left:-110px;'>
																</td>
															</tr>
														</table>
													</div>
													
												</td>
											</tr>	
										</table>
										<table width = '100%' class = 'hijos_tesoreria_cliente todo_fact' style = 'display:none;' >
											<tr >
												<td width = '100%' style = 'padding-left:20px;'>
													<div  style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;' width = '100%'>
														<table width = '100%' class = 'tabla_nuevos_datos2' style = 'padding-left:10%;padding-right:10%;'>
															<tr>
																<td width = '49%'>
																	<p>Seleccione una Empresa:</p>
																	<select class = "entradas_bordes" id = "empresa_b_tesoreria" name = 'empresa_b_tesoreria'  >
																		<option value = 0>Todas las empresas</option>
																		<?php
																			$consulta = "SELECT e.nombre_comercial_empresa, e.cod_interno_empresa from empresa e, pusuemp p
																			where e.cod_interno_empresa = p.cod_empresa and p.cod_usuario = '$usuario_actual'";
																			$result = mysql_query($consulta);
																			while($row = mysql_fetch_array($result)){
																				echo "<option value=".$row['cod_interno_empresa'].">".utf8_encode($row['nombre_comercial_empresa'])."</option>";
																			}
																		?>
																	</select>
																</td>
																<td class = 'separator' width = '2%'></td>
																<td width = '49%'>
																	<p>Seleccione un Cliente:</p>
																	<select id = 'cliente_b_tesoreria' name = 'cliente_b_tesoreria'>
																		<option value = '0'>[SELECCIONE]</option>
																	</select>
																</td>
															</tr>
															<tr>
																<td>
																	<p>Seleccione el Número de Factura:</p>
																	<select type = 'text' class = 'entradas_bordes' id = 'num_factura_tesoreria' name = 'num_factura_tesoreria' >
																		<option value = '0'>[SELECCIONE]</option>
																	</select>
																</td>
																<td class = 'separator' width = '2%'></td>
																<td>
																	<p>Número de Ppto - REFERENCIA</p>
																	<select class = 'entradas_bordes' id = 'num_ppto_factura_tesoreria' name = 'num_ppto_factura_tesoreria' >
																		<option value = '0'>[SELECCIONE]</option>
																	</select>
																</td>
															</tr>
															<tr>
																<td>
																	<p>Seleccione la Fecha de Pago:</p>
																	<input type = 'text' class = 'entradas_bordes' id = 'fecha_pago_cliente_tesoreria' name = 'fecha_pago_cliente_tesoreria' />
																</td>
																<td class = 'separator' width = '2%'></td>
																<td>
																	<p>Seleccione el Tipo de Pago:</p>
																	<select id = 'pago_tesoreria_cliente'>
																		<option value = '0'>[SELECCIONE]</option>
																		<option value = '1'>Parcial</option>
																		<option value = '2'>Total</option>
																	</select>
																</td>
															</tr>
															<tr>
																<td>
																	<p>Ingrese el Valor del Pago:</p>
																	<input type = 'text' class = 'entradas_bordes' name = 'valor_pago_cliente_factura' id = 'valor_pago_cliente_factura' onkeyup = 'formatear_valor(event,"valor_pago_cliente_factura","valor_tesoreria_ppto_real")'/>
																	<span class = 'hidde' id = 'valor_tesoreria_ppto_real'></span>
																</td>
															</tr>
															<tr>
																<td colspan = '3' align = 'center'>
																	<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' id = "limpiar_campos_pago_clientes_tesoreria" style = 'position:relative;'>
																	<img src = '../images/iconos/guardar_1.png' class = 'iconos_guardar_x'   style = 'position:relative;top:45px;left:-50px;z-index:1;'>
																	<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' id = "guardar_pago_cliente_tesoreria"  style = 'position:relative;left:-110px;'>
																</td>
															</tr>
														</table>
													</div>
												</td>
											</tr>
										</table>
										<table width = '100%' class = 'hijos_pagos_proveedores_pagos todo_fact' style = 'display:none;' >
											<tr >
												<td width = '100%'>
													<div style = 'border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;' width = '100%'>
														<table width = '100%' class = 'tabla_nuevos_datos2' style = 'padding-left:10%;padding-right:10%;'>
															<tr>
																<td>
																	<p>Ingres el Número de OC:</p>
																	<input type = 'text' class = 'entradas_bordes' id = 'num_oc_pago_proveedor' name = 'num_oc_pago_proveedor' onkeyup = 'buscar_oc_para_pagar_proveedor()' />
																</td>
																<td class = 'separator' width = '2%'></td>
																<td>
																	<p>Número de Factura Proveeodr:</p>
																	<input type = 'text' class = 'entradas_bordes' id = 'num_fact_pago_proveedor' name = 'num_fact_pago_proveedor' readonly/>
																</td>
															</tr>
															<tr>
																<td>
																	<p>Seleccione la Fecha de Pago:</p>
																	<input type = 'text' class = 'entradas_bordes' id = 'fecha_pago_num_fact_proveedor' name = 'fecha_pago_num_fact_proveedor' />
																</td>
																<td class = 'separator' width = '2%'></td>
																<td>
																	<p>Ingrese el Valor Pagado:</p>
																	<input type = 'text' class = 'entradas_bordes' id = 'valor_pago_num_fact_proveedor' name = 'valor_pago_num_fact_proveedor' readonly/>
																</td>
															</tr>
															<tr>
																<td colspan = '3' align = 'center'>
																	<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' id = "limpiar_pago_facturas_proveedor" style = 'position:relative;'>
																	<img src = '../images/iconos/guardar_1.png' class = 'iconos_guardar_x'   style = 'position:relative;top:45px;left:-50px;z-index:1;'>
																	<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' id = "guardar_pago_facturas_proveedor"  style = 'position:relative;left:-110px;'>
																</td>
															</tr>
														</table>
													</div>
												</td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
						</table>
					</div>
					<!--<table width = '100%'>
						<tr>
							<th align = 'left' onclick = '$(".hijos_recepcion_facturacion").toggle();' class ='mano submenus_facturacion' >RECEPCIÓN DE FACTURAS</th>
						</tr>
						
						<tr>
							<th align = 'left'  onclick = '$(".hijos_facturacion_pptos").toggle();' class ='mano submenus_facturacion'>FACTURACIÓN DE PPTOS</th>
						</tr>
						
						<tr>
							<th align = 'left' onclick = '$(".hijos_tesoreria_cliente").toggle();' class ='mano submenus_facturacion'>PAGOS DE CLIENTES</th>
						</tr>
						
						<tr>
							<th align = 'left' onclick = '$(".hijos_pagos_proveedores_pagos").toggle();' class ='mano submenus_facturacion'>PAGOS A PROVEEDORES</th>
						</tr>
						
					</table>-->					
				</div>
				
				<div id = 'vetana_registrar_fac_pro' style = 'padding-left:50px;padding-right:50px;background-color:white;border-radius:0.5em;-webkit-border-radius:0.5em;'>
					<table width = '100%'>
						<tr>
							<td width = '96%'>
								<span class = 'mensaje_bienvenida'>REGISTRO DE FACTURAS PROVEDOR</span>
							</td>
							<td align = 'right'>
								<img src = '../images/iconos/cerrar.png' onclick = "$('#vetana_registrar_fac_pro').dialog('close');" class = 'iconos_opciones' />
							</td>
						</tr>
					</table>
					</br>
					
					<table width = '100%' class = 'tabla_nuevos_datos'>
						<tr>
							<td>
								<p>Tipo de Documento:</p>
								<select id = 'tipo_doc_prov'>
									<option value = '1'>Factura</option>
									<option value = '2'>Cuenta de Cobro</option>
									<option value = '3'>Poliza</option>
									<option value = '4'>Legalización</option>
									<option value = '5'>Reembolso</option>
									<option value = '6'>Anticipo</option>
								</select>
							</td>
							<td class = 'separator' style = 'padding-left:20px;'></td>
							<td>
								<p>Número de Documento:</p>
								<input type = 'text' id = 'num_doc_pro' />
							</td>
						</tr>
						<tr>
							<td>
								<p>Fecha de Documento:</p>
								<input type = 'text' id = 'fecha_doc_fact_prov'/>
							</td>
							<td class = 'separator' style = 'padding-left:20px;'></td>
							<td>
								<p>Fecha de Vencimiento Documento:</p>
								<input type = 'text' id = 'fechav_doc_fact_prov'/>
							</td>
						</tr>
						<tr>
							<td>
								<p>Valor Documento:</p>
								<input type = 'text' id = 'valor_fact_prov'/>
							</td>
							<td class = 'separator' style = 'padding-left:20px;'></td>
							<td>
								<p>Iva Documento:</p>
								<input type = 'text' id = 'iva_fact_prov'/>
							</td>
						</tr>
						<tr>
							<td></br></td>
						</tr>
						<tr>
							<td></br></td>
						</tr>
						<tr>
							<td colspan = '3' align = 'center'>
								<span class = 'botton_verde' onclick ="$('#vetana_registrar_fac_pro').dialog('close');$('#vetana_registrar_fac_pro input').val('');">CANCELAR</span>
								<span class = 'botton_verde' ID = 'guardar_fac_prov_orden'>Guardar</span>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</body>
		