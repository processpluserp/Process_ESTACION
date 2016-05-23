<?php
	include("../Controller/Conexion.php");
	session_start();
?>

<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>:: PROCESS + ::</title>
			<meta charset="utf-8" />
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui-1.8.23.custom.min.js"></script> <!-- Primordial-->
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script type="text/javascript" src="../css_jquery/css_logeo.js"></script>
			<link type="text/css" href="../css/barra_navegacion.css" rel="stylesheet" />
			<link type="text/css" href="../css/gestion.css" rel="stylesheet" />
			<script type="text/javascript" src="../js/gestion.js"></script>
			<script type="text/javascript" src="../js/gestion_empresa.js"></script>
			<script type="text/javascript" src="../js/jquery.accordion.js"></script>
			<script type="text/javascript" src="../js/acordeon.js"></script>
		</head>
		<body>
			<?php 
				include("contenido_gestion.php");
			?>
				
				
				<div id = "contenedor_datos_administracion_principal">
						<!-- CONTENEDOR EMPRESAS -->
					<div id = "contenedor_informacion_cliente" class = "ppp1">
					
						<table class = "tabla_opciones_busqueda_gestion" width = "100%">
							<tr>
								<th>Nit:</th>
								<th><input type = "text" name = "nit_empresa_gestion" id = "nit_empresa_gestion" /></th>
								<th>Nombre:</th>
								<th>
									<input type = "text" name = "nombre_empresa_gestion" id = "nombre_empresa_gestion" />
								</th>
								<th>
									<button class = "mostrar_datos" id = "boton_mostrar_empresa_gestion" >MOSTRAR TODO</button>
								</th>
								<th>
									<button class = "crear_nuevos_datos" id = "boton_crear_empresa_gestion" >CREA NUEVA</button>
								</th>
							</tr>
						</table>
						<!-- LISTADO DE EMPRESAS -->
						<div id = "contenedor_tabla_empresa_gestion">
							<div class = "contenedor_opciones_documentos">
								<table class = "panel_documentos" width = "100%">
									<tr>
										<th>Agregar</th>
										<th>Ver</th>
										<th>Descargar</th>
									</tr>									
								</table>
								<div id = "doc_ver">
									<table class = "opciones_documentos" width = "100%">
										<tr>
											<td>
												Tipo de Documento
											</td>
											<td>
												<select>
													<?php															
														$cons = "select * from tipodoc";
														$result = mysql_query($cons);
														while($row = mysql_fetch_array($result)){
															echo "<option value = ".$row['codigo_documento'].">".utf8_encode($row['nombre_documento'])."</option>";
														}
													?>
												</select>
											</td>
										</tr>
									</table>
								</div>
								<div id = "doc_agregar">
									<form enctype="multipart/form-data" class = "formulario">
										<table class = "opciones_documentos" width = "100%">
											<tr>
												<td>
													Tipo de Documento
												</td>
												<td>
													<select>
														<?php															
															$cons = "select * from tipodoc";
															$result = mysql_query($cons);
															while($row = mysql_fetch_array($result)){
																echo "<option value = ".$row['codigo_documento'].">".utf8_encode($row['nombre_documento'])."</option>";
															}
														?>
													</select>
												</td>
												<td>
													<input type = "file" name = "arc_doc" id = "arc_doc" />
												</td>
											</tr>
										</table>
									</form>
								</div>
								<div id = "doc_descargar"></div>
							</div>
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
									e.nombre_comercial_empresa,e.iniciales_empresa,e.phone_empresa,e.direccion_empresa, e.nota_orden,
									c.nombre_ciudad	from empresa e, ciudad c where e.ciudad_codigo_ciudad=c.codigo_ciudad ";
									$result = mysql_query($consulta);
									
									while($row = mysql_fetch_array($result)){
										$id = $row['cod_interno_empresa'];
										echo "<tr id =".$row['cod_interno_empresa'].">
											<td class = 'tabla_nit_empresa'>".$row['nit_empresa']."</td>
											<td>".$row['nombre_legal_empresa']."</td>
											<td>".$row['nombre_comercial_empresa']."</td>
											<td>".$row['iniciales_empresa']."</td>
											<td>".$row['phone_empresa']."</td>
											<td  nowrap>".$row['direccion_empresa']."</td>
											<td>".$row['nombre_ciudad']."</td>									
											<td id = 'nota$id' class = 'campo_oculto_tabla'>".$row['nota_orden']."</td>
											<td><img src = '../images/editar.png' onclick = 'editar_empresa_gestion($id)' class = 'botones'/></td>
											<td><img src = '../images/prueba.jpg' /></td>
										</tr>";
									}
								?>
							</table>
						</div>
						<!-- CREAR EMPRESAS -->
						<div class = "fondo_apertura" id = "e1">
							<div id = "datos_crear_empresa_gestion" title = "DATOS NUEVA EMPRESA">
								<div class ="scroll_nueva_ventana">
									<strong><p class = "titulo_nueva_ventana">DATOS NUEVA EMPRESA</p></strong>
									<table id = "tabla_datos_nueva_empresa" class = "tabla_nuevos_datos" width = "100%">
										<tr>
											<th colspan = "2">DATOS LEGALES</th>
										</tr>
										<tr>
											<td>
												<p>NIT</p>
												<input class = "entradas_bordes" type = "text" name = "n_nit_empresa" id = "n_nit_empresa" />
											</td>
											<td>
												<p>Nombre Legal</p>
												<input class = "entradas_bordes" type = "text" name = "n_nombre_legal_empresa" id = "n_nombre_legal_empresa" />
											</td>
										</tr>
										<tr>
											<td colspan = "2">
												<p>Nombre Comercial</p>
												<input class = "entradas_bordes"type = "text" name = "n_nombre_comercial_empresa" id = "n_nombre_comercial_empresa" />
											</td>
										</tr>
										<tr>
											<th colspan = "2">DATOS INFORMATIVOS</th>
										</tr>
										<tr>
											<td>
												<p>Iniciales</p>
												<input class = "entradas_bordes" type = "text" name = "n_iniciales_empresa" id = "n_iniciales_empresa" size = "3"/>
											</td>
											<td>
												<p>Teléfono</p>
												<input class = "entradas_bordes" type = "text" name = "n_telefono_empresa" id = "n_telefono_empresa" />
											</td>
										</tr>
										<tr>
											<td>
												<p>Dirección</p>
												<input class = "entradas_bordes" type = "text" name = "n_direccion_empresa" id = "n_direccion_empresa" />
											</td>
											<td>
												<p>Nota Orden</p>
												<textarea class = "entradas_bordes" name = "n_nota_orden_empresa" id = "n_nota_orden_empresa" rows = "4" placeholder = "Nota Orden"></textarea>
											</td>
										</tr>
										<tr>
											<th colspan = "2">DATOS DE UBICACIÓN</th>
										</tr>
										<tr>
											<td>
												<p>País</p>
												<select class = "entradas_bordes_select" id = "n_pais_empresa" name = "n_pais_empresa">
													<option value = "">...</option>
													<?php
														$consulta2 = "select * from pais";
														$result2 = mysql_query($consulta2);
														while($row2 = mysql_fetch_array($result2)){
															echo "<option value = ".$row2['codigo_pais'].">".$row2['nombre_pais']."</option>";
														}
													?>
												</select>
											</td>
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
										<tr>
											<td class = "botones_finales" colspan = "2">
												<button class = "botton_verde" class = "botones_nueva_ventana" id = "n_guardar_empresa_gestion">GUARDAR</button>
												<button class = "botton_verde" class = "botones_nueva_ventana" id = "n_cancelar_empresa_gestion" >CANCELAR</button>
											</tr>
										</tr>
									</table>
								</div>
							</div>
						</div>
						
						<!-- MODIFICAR EMPRESA -->
						<div class = "fondo_apertura" id = "e2">
							<div id = "datos_modificar_empresa_gestion" title = "INFORMACIÓN EMPRESA">
								<div class ="scroll_nueva_ventana">
									<strong><p class = "titulo_nueva_ventana">INFORMACION EMPRESA</p></strong>
									<table id = "tabla_datos_nueva_empresa" class = "tabla_nuevos_datos">
										<tr>
											<th>DATOS LEGALES</th>
										</tr>
										<tr>
											<td>
												<p>NIT</p>
												<input class = "entradas_bordes" type = "text" name = "e_nit_empresa" id = "e_nit_empresa" readonly="readonly"/>
											</td>
										</tr>
										<tr>
											<td>
												<p>Nombre Legal</p>
												<input class = "entradas_bordes" type = "text" name = "e_nombre_legal_empresa" id = "e_nombre_legal_empresa" />
											</td>
										</tr>
										<tr>
											<td>
												<p>Nombre Comercial</p><input class = "entradas_bordes"type = "text" name = "e_nombre_comercial_empresa" id = "e_nombre_comercial_empresa" />
											</td>
										</tr>
										<tr>
											<th>DATOS INFORMATIVOS</th>
										</tr>
										<tr>
											<td>
												<p>Iniciales</p>
												<input class = "entradas_bordes" type = "text" name = "e_iniciales_empresa" id = "e_iniciales_empresa" size = "3"/>
											</td>
										</tr>
										<tr>
											<td>
												<p>Teléfono</p>
												<input class = "entradas_bordes" type = "text" name = "e_telefono_empresa" id = "e_telefono_empresa" />
											</td>
										</tr>
										<tr>
											<td>
												<p>Dirección</p>
												<input class = "entradas_bordes" type = "text" name = "e_direccion_empresa" id = "e_direccion_empresa" />
											</td>
										</tr>
										<tr>
											<td>
												<p>Nota Orden</p>
												<textarea class = "entradas_bordes" name = "e_nota_orden_empresa" id = "e_nota_orden_empresa" rows = "4" placeholder = "Nota Orden"></textarea>
											</td>
										</tr>
										<tr>
											<td class = "botones_finales">
												<button class = "botton_verde" id = "n_modificar_empresa_gestion" >MODIFICAR</button>
												<button class = "botton_verde" id = "n_cancelar_modificar_empresa_gestion">CANCELAR</button>
											</td>
										</tr>
									</table>
								</div>
								
							</div>
						</div>
					</div>
				
				</div>
				
				</div>
			
			</div>
		
			
			
		</body>
	</html>