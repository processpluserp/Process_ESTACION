<?php
	require("../Modelo/gestion_cabecera.php");
	require("../Modelo/empleado.php");
	require("../Controller/Conexion.php");
	require("../Modelo/cliente.php");
	require("../Modelo/usuarios.php");
	require("../Modelo/Empresa.php");
	
	session_start();
	if($_SESSION["codigo_usuario"] == ""){
		header("location:../logeo.php");
	}
	$empresa_final = $_GET["e"];
	if($empresa_final == ""){
		header("location:bienvenida.php");
	}
	
	$cliente = new cliente();
	$gestion = new cabecera_pagina();
	$empleado = new empleado();
	$emp = new empresa();
	$usux = new usuario();
	$codigo_usuario_real = $_SESSION["codigo_usuario"];
?>
<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>:: PROCESS + ::</title>
			<meta charset="utf-8" />
			
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script type="text/javascript" src="../js/gestion.js"></script>
			<script type="text/javascript" src="../css_jquery/css_logeo.js"></script>
			<script type="text/javascript" src="../js/gestion_empresa.js"></script>
			<script type="text/javascript" src="../js/gestion2.js"></script>
			<script type="text/javascript" src="../js/cliente.js"></script>
			<link type="text/css" href="gestion_final.css" rel="stylesheet" />
			<link rel="stylesheet" href="../css/jquery-ui.css">
			<link type="text/css" href="../css/tablas.css" rel="stylesheet" />
			
			<link type="text/css" href="../css/cabecera.css" rel="stylesheet" />
			<link type="text/css" href="../css/cliente.css" rel="stylesheet" />
			<style >
				.estilos_barra td:nth-child(2){
					background-color:rgb(39,170,225);
				}
				
				#listado_contactos_cliente p{
					text-align:center;
				}
				#tabla_division_grilla > td{
					border:1px solid black;
				}
			</style>
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
			<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="../js/resize.js"></script>

			<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
			
		</head>
		
		<body class = 'scroll'>
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
									<td  align = 'left'><span class = "bara_ubicacion">
										<?php
											echo "<a class = 'links_barra_ubicacion' href = 'gestion.php?e=$empresa_final'>AGENCIA</a>"
										?>
									</span></td>
									<td  align = 'left'><span class = "bara_ubicacion" id = "actual">CLIENTE</span></td>
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
														echo "<a class = 'links_barra_ubicacion' href = 'menu_gestion.php?empresa_trabajo=$empresa_final'>
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
					$gestion->menu_clientes_perfil($_SESSION["codigo_usuario"]);
				?>
			</div>
			
			<div id = "nuevo_contacto_cliente" class = 'ventana'>
				<table width = '100%' style = 'padding-right:50px;padding-left:50px;'>
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
					<td align = 'right' >
						<table width = '100%'>
							<tr>
								<td>
									<img id = "c_v_info_n_contactos_cliente" src = "../images/iconos/cerrar.png" class = 'iconos_opciones'/>
								</td>
							</tr>
						</table>
					</td>
				</table>
				</br>
				</br>
				</br>
				<table width = '100%' class = 'tabla_nuevos_datos2' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td>
							<p>Seleccione un Cliente:</p>
							<select id = 'n_cliente_contacto'></select>
						</td>
						<td class = 'separator'></td>
						<td>
							<p>Ingrese el Nombre:</p>
							<input type = 'text' id = 'nombre_contactos'/>
						</td>
						<td>
							<p>Ingrese el Cargo:</p>
							<input type = 'text' id = 'cargos'/>
						</td>
						
						
					</tr>
					<tr>
						<td></br></br></td>
					</tr>
					<tr >
						<td>
							<p>Ingrese el Email:</p>
							<input type = 'text' id = 'email'/>
						</td>
						<td class = 'separator'></td>
						<td>
							<p>Digite el Teléfono:</p>
							<input type = 'text' id = 'phone'/>
						</td>
						<td>
							<p>Digite el Celular:</p>
							<input type = 'text' id = 'celular'/>
						</td>
						
					</tr>
					<tr>
						<td></br></br></td>
					</tr>
					<tr>
						<td>
							<p>Seleccione el Mes de Cumpleaños:</p>
							<select id = 'mes'>
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
						<td class = 'separator'></td>
						<td>
							<p>Ingrese el día de Cumpleaños:</p>
							<input type = 'number' id = 'dia' maxlength = '2'/>
						</td>
					</tr>
					<tr>
						<td></br></br></td>
					</tr>
					<tr>
						<td  align = "center" style = 'vertical-align:middle;' >
							<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' id = "cancelar_crear_n_contacto_cliente" style = 'position:relative;left:40%' />
						</td>
						<td  style = 'vertical-align:top;' >
							<img src = '../images/iconos/guardar_1.png' class = 'iconos_guardar_x'   style = 'position:relative;top:0px;z-index:1;' />
						</td>
						<td  align = "center"  style = 'vertical-align:middle;' >
							<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' id = "crear_n_contacto_cliente" style = 'position:relative;left:-40%;'/>
						</td>
					</tr>
				</table>
			</div>
			
			<div id ="contactos_cliente" class = 'ventana'>
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
										<span class = 'mensaje_bienvenida'>CONTACTOS CLIENTES</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right'>
							<table width = '100%'>
								<tr>
									<td>
										<img id = "n_contactos_cliente" src = "../images/iconos/icono_nuevo_contacto.png" class = 'iconos_opciones mano' title = 'Adicionar Contacto'/>
									</td>
									<td>
										<img id = "c_v_info_contactos_cliente" src = "../images/iconos/cerrar.png" class = 'iconos_opciones'/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<table width = '100%'>
					<tr>
						<td style = 'padding-left:50px;'>
							<p style = "color:#585D5E;font-weight:bold;">Seleccione un Cliente:</p>
							<select id = "listado_cliente_contacto" style = 'text-align:left;background-color:#E2E2E2;border-radius:0.3em;border:0px;font-size:0.9em;padding:5px;'width = 'auto'></select>
						</td>
					</tr>
				</table>
				</br>
				<div style = 'overflow:scroll;padding-left:50px;padding-right:50px;' id = "contenedor_contactos_x_cliente" class = 'contenedor_info_tablas'>
					
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
			
			<div id = "informacion_basica_cliente" class = 'ventana'>
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
											<span class = 'mensaje_bienvenida'>INFORMACIÓN CLIENTES</span>
										</td>
									</tr>
								</table>
							</td>
							<td  align = 'right' >
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img id = "n_cliente" src = "../images/iconos/adicionar_cliente2.png" class = 'iconos_opciones' />
										</td>
										<td align = 'center'>
											<img id = "c_v_info_cliente" src = "../images/iconos/cerrar.png" class = 'iconos_opciones' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<table  class = 'barra_busqueda' width = '100%' style = 'padding-left:50px;padding-right:50px;'>
						<tr>							
							<td >
								<p>NIT</p>
								<input type = "text" id = 'b_nit' style = 'width:auto;'/>
							</td>
							<td>
								<p>NOMBRE</p>
								<input type = "text" id = 'b_name_cliente'style = 'width:auto;' />
							</td>
							<td align = 'right'></br>
								<img src = '../images/iconos/mostrar_todo.png' width = '150px' title = 'Mostrar Todo' id = 'mostrar_todos_clientes'/>
							</td>
						</tr>
					</table>
					</br>
					<div id ="contenedor_info_clientes" style = 'padding-left:50px;padding-right:50px;overflow:scroll;' class = 'contenedor_info_tablas'>
						<?php
							$cliente = new cliente();
							$cliente->mostrar_tabla_basica_clientes($cliente->sql_todos_clientes($empresa_final));
						?>
					</div>
			</div>
			
			<div id = "muestra_info_cliente" class = 'ventana'>
				
			</div>
			
			<div id = "n_cliente_empresa" class = 'ventana'>
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
									<td align = 'left'>
										<span class = 'mensaje_bienvenida'>DATOS NUEVO CLIENTE</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right' >
							<table width = '100%'>
								<tr>
									<td>
										<img id = "c_v_n_cliente" src = "../images/iconos/cerrar.png" class = 'iconos_opciones'/>
									</td>
								</tr>
							</table>
						</td>
					</tr>				
				</table>
					</br>
					<table width = "100%" class = "tabla_nuevos_datos2">
						<tr>
							<th align = "left" width = '49%' colspan = '2' style = 'padding-left:50px;padding-right:50px;'>LEGALES</th>
							<th class = "separator"></th>
							<th nowrap align = "left" width = '48%'colspan = '2' >UBICACIÓN</th>
						</tr>
						<tr>
							<td colspan  = '2' style = 'padding-left:50px;'>
								<p>Nombre Legal:</p>
								<input type = "text" name = "n_legal" id = "n_legal" />
							</td>
							<td class = "separator"></td>
							<td colspan = '2' style = 'padding-right:50px;'>
								<table width = '100%'>
									<tr>
										<td >
											<p>País:</p>
										</td>
										<td >
											<p>Departamento:</p>
										</td>
										<td >
											<p>Ciudad:</p>
										</td>
									</tr>
									<tr>
										<td>
											<select id = "n_pais_empresa">
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
							<td colspan = "2" style = 'padding-left:50px;' >
								<p>Nombre Comercial:</p>
								<input type = "text" name = "n_comercial" id = "n_comercial" />
							</td>
							<td class = "separator"></td>
							<td >
								<p>Teléfono:</p>
								<input type = "text" name = "tel" id = "tel" />
							</td>
							<td style = 'padding-right:50px;'>
								<p>Dirección:</p>
								<input type = "text" name = "direccion" id = "direccion" />
							</td>
						</tr>
						
						
						<tr>
							<td colspan = '2' style = 'padding-left:50px;'>
								<p>NIT:</p>
								<input type = "text" name = "nit" id = "nit" onkeyup = "validar_nit_cliente()"/>
								<span id = 'nit_verificar_cliente'></span>
							</td>
							<td class = "separator"></td>
						</tr>
						<tr><td></br></td></tr>
						<tr>
							<th style = 'padding-left:50px;' nowrap align = "left" colspan = '5'>EMPRESAS</th>
						</tr>
						<tr>
							<td colspan = "5" style = 'padding-left:50px;'>
								<div id = "contenedor_empresas_cliente">
									<table >
										<?php
											$cliente->asociar_empresas();
										?>
									</table>
									
								</div>
							</td>
						</tr>
						<tr><td colspan = "5"></br></td></tr>
						<tr>
							<td colspan = "5" align = 'center'>
								<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' id = "cancelar_crear_cliente" style = 'position:relative;'>
								<img src = '../images/iconos/guardar_1.png' class = 'iconos_guardar_x'   style = 'position:relative;top:45px;left:-50px;z-index:1;'>
								<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' id = "crear_cliente"  style = 'position:relative;left:-110px;opacity:0.5;'>
							</td>
						</tr>
						
					</table>
			</div>
			
			<div id = 'documentos_cliente' class = 'ventana' >
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
										<span class = 'mensaje_bienvenida'>DOCUMENTOS CLIENTE</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right' >
							<table width = '100%'>
								<tr>
									<td align = 'center'>
										<img id = "n_doc_cliente" src = "../images/iconos/icono_doc_nuevo.png" class = 'iconos_opciones'/>
									</td>
									<td align = 'center'>
										<img id = "c_v_doc_cliente" src = "../images/iconos/cerrar.png" class = 'iconos_opciones'/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				</br>
				<div id = "contenedor_documentos_clientes" style = 'padding-left:50px;padding-right:50px;' class = 'contenedor_info_tablas'>
					
				</div>
				
			</div>
			
			<div id = "n_documento_cliente" class = 'ventana'>
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
						<td align = 'right' >
							<table width = '100%'>
								<tr>
									<td align = 'center'>
										<img id = "c_v_n_doc_cliente" src = "../images/iconos/cerrar.png"  class = 'iconos_opciones'/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				</br>
				</br>
				</br>
				</br>
				<table width = '100%' class = 'tabla_nuevos_datos2' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td>
							<p>Seleccione un Cliente(*):</p>
							<select id = "listado_clientes_doc">
								
							</select>
						</td>
						<td>
							<p>Seleccione un tipo de Documento(*):</p>
							<select id = "tipo_documento_cliente">
								<option value = "1">RUT</option>
								<option value = "2">CÁMARA DE COMERCIO</option>
								<option value = "4">CÉDULA REPRESENTATE LEGAL</option>
								<option value = "3">CERTIFICACIÓN BANCARIA</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							</br>
							</br>
						</td>
					</tr>
					<tr>
						<td>
							<p>Seleccione un Archivo(*):</p>
							<table>
								<tr>
									<td >
										<input type = "file" id = "archivo_doc" />
									</td>
									<td>
										<img id = "limpiar_doc_cliente" src = "../images/iconos/eliminar.png" width = '35px' height = '40px'/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr><td></br></td></tr>
					<tr>
						<td>
							</br>
							</br>
						</td>
					</tr>
					<tr>
						<td colspan = "2" align ="center">
							<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' id = "cancelar_crear_doc_cliente"  style = 'position:relative;'>
							<img src = '../images/iconos/guardar_1.png' class = 'mano iconos_guardar_x'   style = 'position:relative;top:45px;left:-50px;z-index:1;opacity:'>
							<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' id = "crear_doc_cliente"  style = 'position:relative;left:-110px;'>
						</td>
					</tr>
				</table>
			</div>
			
			<div id = 'ventana_negociacion_cliente' class = 'ventana'>
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
									<td align = 'left' '>
										<span class = 'mensaje_bienvenida'>NUEVA NEGOCACIÓN CLIENTES</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right' >
							<table width = '100%'>
								<tr>
									<td>
										<img id = "cerrar_ventana_nego_clientes" src = "../images/iconos/cerrar.png" class = 'iconos_opciones'/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				</br>
				<table width = 'auto'class = 'tabla_nuevos_datos2' style = 'padding-right:50px;'>
					<tr>
						<td style = 'padding-left:50px;'>
							<p>Seleccione un Cliente:</p>
							<select id = 'list_cliente_nego_n'></select>
						</td>
					</tr>
				</table>
				</br>
				<table width = 'auto' class = 'tabla_nuevos_datos2' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td >
							<table width = '100%'>
								<tr>
									<td>
										<p>Información Tributaria:</p>
										<div>
											<input type = 'radio' value = 'GC' name = 'regimen' id = 'gc'class = 'radio'/>
											<label for='gc'><span><span></span></span>Gran Contribuyente</label>
										</div>
										<div>
											<input type = 'radio' value = 'RC' name = 'regimen' id = 'rc' class = 'radio' />
											<label for='rc'><span><span></span></span>Régimen Común</label>
										</div>
										<div>
											<input type = 'radio' value = 'RS' name = 'regimen' id = 'rs' class = 'radio' />
											<label for='rs'><span><span></span></span>Régimen Simplificado</label>
										</div>
									</td>
									<td>
										
									</td>
								</tr>
							</table>
						</td>
						<td style = 'vertical-align:top;'>
							<p>Es Autoretenedor?</p>
							<div >
								<input type = 'radio' value = '1' name = 'autoretenedor' id = 'autor' class = 'radio' />
								<label for='autor'><span><span></span></span>Si</label>
							</div>
							<div >
								<input type = 'radio' value = '0' name = 'autoretenedor' id = 'autor2' class = 'radio' checked/>
								<label for='autor2'><span><span></span></span>No</label>
							</div>
						</td>
						<td style = 'padding-left:50px;'>
							<p>ReteIva:</p>
							<input type = 'text' id = 'reteiva_cond'/>
						</td>						
						<td style = 'padding-left:50px;'>
							<p>ReteFuente:</p>
							<input type = 'text' id = 'retefuente_cond'/>
						</td>
						<td style = 'padding-left:50px;'>
							<p>Impuestos Adicionales:</p>
							<input type = 'text' id = 'val_comi_terceros'/>
						</td>
					</tr>
					<tr>
						<td >
							<p>Tipo Comisión:</p>
								<div>
									<input type = 'radio' value = '1' name = 'comision' id = 'cdv' class = 'radio' />
									<label for='cdv'><span><span></span></span>Dividida</label>
								</div>
								<div>
									<input type = 'radio' value = '2' id = 'cmu' name = 'comision' class = 'radio' />
									<label for='cmu'><span><span></span></span>Multiplicada</label>
								</div>
						</td>
						<td style = 'padding-left:50px;'>
							<p>Valor Comision:</p>
							<input type = 'text' id = 'valor_comision_cliente'/>
						</td>
						<td style = 'padding-left:50px;'>
							<p>Cierre de Facturación:</p>
							<input type = 'text' id = 'cierre_fact_cliente'/>
						</td>
						<td style = 'padding-left:50px;'>
							<p>Paga a:</p>
							<select id = 'dias_pago_cliente'>
								<option value = '30'>30 DÍAS</option>
								<option value = '45'>45 DÍAS</option>
								<option value = '47'>47 DÍAS</option>
								<option value = '60'>60 DÍAS</option>
								<option value = '90'>90 DÍAS</option>
								<option value = '120'>120 DÍAS</option>
								<option value = '150'>150 DÍAS</option>
								<option value = '180'>180 DÍAS</option>
							</select>
						</td>
					</tr>
					<tr>
						
					</tr>
				</table>
				</br>
				</br></br>
				<table width = '100%'>
					<tr>
						<td align = 'center'>
							<span class = "botton_verde" id = "cancelar_nego_cliente">CANCELAR</span>
							<span class = "botton_verde" id = "crear_nego_cliente">GUARDAR</span>
						</td>
					</tr>
				</table>
			</div>
			
			<div id = "contratos_clientes" class = 'ventana'>
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
										<span class = 'mensaje_bienvenida'>CONTRATOS CLIENTES</span>
									</td>
								</tr>
							</table>
							
						</td>
						<td align = 'right'>
							<table width = '100%'>
								<tr>
									<td>
										<img id = "n_negociacion_cliente" src = "../images/iconos/nueva_negociacion.png" class = 'iconos_opciones' title = 'NUEVO NEGOCIACIÓN CLIENTE'/>
									</td>
									<td>
										<img id = "n_contrato_cliente" src = "../images/iconos/nuevo_contrato.png" class = 'iconos_opciones' title = 'NUEVO CONTRATO CLIENTE'/>
									</td>
									<td>
										<img id = "c_v_n_contratos_cliente" src = "../images/iconos/cerrar.png" class = 'iconos_opciones'/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				</br>
				<div id="tabs" height = '10%' style = 'padding-left:50px;padding-right:50px;'>
					<ul>
						<li><a href="#tabs-1">Negociaciones</a></li>
						<li id = 'pestana_sim'><a href="#tabs-2">Contratos</a></li>
					</ul>
					<div id="tabs-1">
						<table class = 'barra_busqueda2'>
							<tr>
								<td >
									<p>NIT:</p>
									<select id = 'b_nego_cliente_list'></select>
								</td>
							</tr>
						</table>
						</br>
						<div id ='contenedor_condiciones_clientes' width = '100%'></div>
					</div>
					<div id="tabs-2">
						<table class = 'barra_busqueda2'>
							<tr>
								<td >
									<p>NIT:</p>
									<select id = 'b_cont_cliente_list'></select>
								</td>
							</tr>
						</table>
						</br>
						<div id = "contenedor_contratos_clientes" style = 'padding-left:50x;padding-right:50px;' >
							<?php
								$cliente->mostrar_contratos_clientes($cliente->sql_mostrar_contratos_clientes($empresa_final));
							?>
						</div>
					</div>
				</div>
				
			</div>
			
			<div id = "nuevo_contrato" class = 'ventana'>
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
										<span class = 'mensaje_bienvenida'>NUEVO CONTRATO</span>
									</td>
								</tr>
							</table>
						</td>
						<td >
							<table width = '100%'>
								<tr>
									<td>
										<img id = "c_v_nn_contratos_cliente" src = "../images/iconos/cerrar.png" class = 'iconos_opciones'/>
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
						<td width = '48%'>
							<p>Ingrese el Nombre del Contrato:</p>
							<input type = 'text' id = "nombre_contrato_clie"/>
						</td>
						<td class = 'separator'></td>
						<td width = '48%'>
							<p>Seleccione el Cliente</p>
							<select id = "listado_clientes_contrato">
								
							</select>
						</td>
					</tr>
					<tr><td></br></br></td></tr>
					<tr>
						<td width = '48%'>
							<p>Ingrese el Archivo del Contrato:</p>
							<table>
								<tr>
									<td>
										<input type = "file" id = "archivo_contrato"/>
									</td>
									<td>
										<img id = "limpiar_contratos_cliente" src = "../images/iconos/eliminar.png" class = 'iconos_eliminar_item'/>
									</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>
						<td width = '48%'>
							<table width = '100%'>
								<tr>
									<td>
										<p>Seleccione la Fecha del Contrato:</p>
										<input type = "text" name = "fcontrato" id = "fcontrato"/>
									</td>
									<td>
										<p>Ingrese el valor del contrato:</p>
										<input type = "text" name = "n_valor_contrato" id = "n_valor_contrato" onkeyup = 'formatear_valor(event,"n_valor_contrato","h_valor_contrato_cliente")'/>
										<span class = 'hidde' id = 'h_valor_contrato_cliente'></span>
									</td>
								</tr>
							</table>
							
						</td>
					</tr>
					<tr><td></br></br></td></tr>
					<tr>
						<td  width = '48%'>
							<p>Seleccione la Fecha de Firma del Contrato:</p>
							<input type = "text" name = "ffirma" id = "ffirma"/>
						</td>
						<td class = 'separator'></td>
						<td width = '48%'>
							<p>Seleccione la Fecha de Terminación del Contrato:</p>
							<input type = "text" name = "fterminacion" id = "fterminacion"/>
						</td>
					</tr>
					<tr>
						<td  width = '48%'>
							<p>Seleccione el Tipo de Contrato:</p>
							<select id = 'tipo_contrato_cliente'>
								<option value = 'FEE'>FEE</Option>
								<option value = 'MANDATO'>MANDATO</Option>
								<option value = 'SERVICIOS'>SERVICIOS</Option>							
							</select>
						</td>
						<td class = 'separator'></td>
					</tr>
					<tr><td></br></td></tr>
					<tr><td></br></br></td></tr>
					<tr>
						<td colspan = "3" align ="center">
							<span class = "botton_verde" id = "cancelar_crear_contrato_cliente">CANCELAR</span>
							<span class = "botton_verde" id = "crear_contrato_cliente">GUARDAR</span>
						</td>
					</tr>
				</table>
			</div>
		
			<div id = "panel_opciones_administracion" class = 'ventana'>
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
										<span class = 'mensaje_bienvenida'>PRODUCTOS CLIENTES</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right' >
							<table width = '100%'>
								<tr>
									<td align = 'center'>
										<img id = "n_producto_cliente" src = "../images/iconos/nuevo_producto_cliente.png" class = 'iconos_opciones' />
									</td>
									<td align = 'center'>
										<img id = 'cerrar_ventana_panel_admin' src = '../images/iconos/cerrar.png' class = 'iconos_opciones' />
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td width = '90%'>
								<div width = '96%' id = 'contenedor_opciones_admin' style = 'background-color:rgb(218, 218, 218);overflow:scroll;'>
									<table  class = 'barra_busqueda2' width = 'auto'>
										<tr>
											<td style = 'padding-left:25px;padding-right:25px;'>
												<p>Seleccione un Cliente:</p>
												<select id = "cliente_producto" style = 'background-color:white;'>
													
												</select>
											</td>
										</tr>
									</table>
									<div style = 'overflow:scroll;padding-right:50px;height:600px;width:100%;overflow:scroll;' id = "contenedor_productos_cliente">
										
									</div>
								</div>
							</td>
						</tr>
					</table>
			</div>	
				
			<div id = "panel_opciones_negocacion">
				<table width = '100%'>
					<th width = '96%'>
						<span class = "titulo_ventana" >NEGOCIACIÓN</span>
						<?php
							echo $per;
						?>
					</th>
					<th align = 'right'>
						<img id = "cerrar_ventana_panel_negocacion" src = "../images/iconos/cerrar.png" width = '30px' height = '30px'/>
					</th>
				</table>
				</br>
				<table width = '100%' class = "botones_opciones">
					<tr>
						<td align = "center"><span id = "abrir_contratos_n"class = "mostrar_datos">CONTRATOS</span></td>
						<td align = "center"><span id = "" class = "mostrar_datos">CONDICIONES</span></td>
					</tr>
				</table>
			</div>
					
			<div id = "nuevo_producto_cliente">
				<table width = '100%'  style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<th width = '96%'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>
										<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
									</td>
								</tr>
								<tr>
									<td align = 'left'>
										<span class = 'mensaje_bienvenida'>NUEVO PRODUCTO</span>
									</td>
								</tr>
							</table>
						</th>
						<th align = 'right' >
							<img id = "c_v_n_producto_cliente" src = "../images/iconos/cerrar.png" class = 'iconos_opciones'/>
						</th>
					</tr>
				</table>
				</br>
				<table width = '100%' class = 'tabla_nuevos_datos2'>
					<tr><td></br></td></tr>
					<tr>
						<td align = 'center' style = 'padding-left:20%;padding-right:20%;'>
							<p>CLIENTE</p>
							<select id = "n_cliente_producto" >
								
							</select>
						</td>
					</tr>
					<tr><td></br></td></tr>
					<tr><td></br></td></tr>
					<tr>
						<td  align = 'center' style = 'padding-left:20%;padding-right:20%;'>
							<p>NOMBRE PRODUCTO</p>
							<input type = "text" name = "nombre_producto" id = "nombre_producto"/>
						</td>
					</tr>
					<tr><td></br></td></tr>
					<tr><td></br></td></tr>
					<tr>
						<td  align = 'center' style = 'padding-left:20%;padding-right:20%;'>
							<p>VALOR FEE</p>
							<input type = "text" name = "fee_val" id = "fee_val" value = '0'/>
						</td>
					</tr>
					<tr><td></br></td></tr>
					<tr><td></br></td></tr>
					<tr><td></br></td></tr>
					<tr><td></br></td></tr>
					<tr>
						<td  align ="center">
							<span class = "botton_verde" id = "cancelar_crear_producto_cliente">CANCELAR</span>
							<span class = "botton_verde" id = "crear_producto_cliente">GUARDAR</span>
						</td>
					</tr>
				</table>
			</div>
			
			<div id = "informacion_fee">
				<table width = '100%'>
					<tr>
						<th width = '96%'>
							<span class = "titulo_ventana">FEE CLIENTES</span>
						</th>
						<th align = 'right'>
							<img id = "c_v_fee_cliente" src = "../images/iconos/cerrar.png" width = '30px' height = '30px'/>
						</th>
					</tr>
				</table>
				</br>
				<hr>
				<table>
					<tr>
						<td style = 'padding-right:20px;'>
								<img id = "n_fee_cliente" src = "../images/iconos/mas_blanco.png" width = '50px' height = '50px'/>
						</td>
						<td>
							<p>CLIENTE</p>
							<select id = "cliente_fee">
								
							</select>
						</td>
					</tr>
				</table>
				</br>
				<div id ="contenedor_fee">
					
				</div>
			</div>
			
			<div id = "new_fee">
				<table width = '100%'>
					<tr>
						<th width = '96%'>
							<span class = "titulo_ventana">NUEVO FEE CLIENTE</span>
						</th>
						<th align = 'right'>
							<img id = "c_v_n_fee_cliente" src = "../images/iconos/cerrar.png" width = '30px' height = '30px'/>
						</th>
					</tr>
				</table>
				</br>
				<hr>
				<table width = '100%'>
					<tr>
						<td>
							<p>CLIENTE</p>
							<select id = "n_cliente_fee">
								
							</select>
						</td>
						<td>
							<p>PRODUCTO</p>
							<select id = "n_procliente"></select>
						</td>
					</tr>
					<tr>
						<td>
							<p>VALOR FEE</p>
							<input type = 'text' id = "valor_fee" />
						</td>
					</tr>
					<tr><td></br></td></tr>
					<tr>
						<td colspan = "2" align ="right">
							<span class = "botton_verde" id = "cancelar_crear_fee_cliente">CANCELAR</span>
							<span class = "botton_verde" id = "crear_fee_cliente">GUARDAR</span>
						</td>
					</tr>
				</table>
			</div>
		</body>
	</html>

	
	