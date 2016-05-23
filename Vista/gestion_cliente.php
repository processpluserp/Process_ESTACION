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
			<script type="text/javascript" src="../js/gestion_cliente.js"></script>
		</head>
		<body>
			<?php 
				include("contenido_gestion.php");
			?>				
				<div id = "contenedor_datos_administracion_principal">
				
					<div id = "contenedor_informacion_empresa" class = "ppp1">
					
						<table class = "tabla_opciones_busqueda_gestion" width = "100%">
							<tr>
								<th></th>
								<th><input type = "text" name = "nit_cliente_gestion" id = "nit_cliente_gestion" placeholder = "Nit"/></th>
								
								<th></th>
								<th>
									<input type = "text" name = "nombre_cliente_gestion" id = "nombre_cliente_gestion" placeholder = "Nombre" />
								<th>
									<input name = "estado_cliente_gestion" type = "radio" value = "1" checked="checked" />Activo
									<input name = "estado_cliente_gestion" type = "radio" value = "0" />Inactivo
								</th>
								<th>
									<a href = "#" class = "boton_buscar_datos_add" id = "buscar_clientes_gestion" onclick = "buscar_clientes_gestion()">Buscar</a>
								</th>
								<th>
									<button class = "mostrar_datos" id = "boton_mostrar_cliente_gestion" onclick = "mostrar_todas_clientes_gestion()">MOSTRAR TODO</button>
								</th>
								<th>
									<button class = "crear_nuevos_datos" id = "boton_crear_cliente_gestion" >CREA NUEVA</button>
								</th>
							</tr>
						</table>
						
						<!-- LISTADO DE CLIENTES -->
						<div id = "contenedor_tabla_cliente_gestion">
							<table id = "tabla_contenedor_info_cliente" class = "tablas_muestra_datos_tablas">
								<tr>
									<th>NIT</th>
									<th>Nombre Legal</th>
									<th>Nombre Comercial</th>
									<th>Teléfono</th>
									<th>Dirección</th>
									<th>Ciudad</th>
									<th>Estado</th>
									<th></th>
									<th></th>									
								</tr>
								<?php
									$consulta2 = "select c.codigo_interno_cliente, c.nit_cliente, c.nombre_comercial_cliente,
									c.nombre_legal_clientes, c.telefono_cliente, c.direccion_cliente, c.estado, ci.nombre_ciudad from clientes c, ciudad ci 
									where c.ciudad_codigo_ciudad=ci.codigo_ciudad ";
									$result2 = mysql_query($consulta2);
									
									while($row = mysql_fetch_array($result2)){
										$id = $row['codigo_interno_cliente'];
										$estado = $row['estado'];
										$valor_estado = "";
										if ($estado == 1){
											$valor_estado = "ACTIVO";
										}else{
											$valor_estado = "INACTIVO";
										}
										echo "<tr id =".$row['codigo_interno_cliente'].">
											<td class = 'tabla_nit_empresa'>".$row['nit_cliente']."</td>
											<td>".$row['nombre_comercial_cliente']."</td>
											<td>".$row['nombre_legal_clientes']."</td>
											<td>".$row['telefono_cliente']."</td>
											<td  nowrap>".$row['direccion_cliente']."</td>
											<td>".$row['nombre_ciudad']."</td>	
											<td>".$valor_estado."</td>								
											<td><img src = '../images/editar.png' onclick = 'editar_cliente_gestion($id)' class = 'botones'/></td>
											<td><img src = '../images/prueba.jpg' onclick = 'cambiar_estado_cliente($id)' /></td>
										</tr>";
									}
								?>
							</table>
						</div>
						
						<!-- Crear Cliente -->
						<div class = "fondo_apertura" id = "c1">
							<div id = "datos_crear_cliente_gestion" title = "DATOS NUEVO CLIENTE">
								<div class ="scroll_nueva_ventana_cliente">
									<strong><p class = "titulo_nueva_ventana">DATOS NUEVO CLIENTE</p></strong>
									<table id = "tabla_datos_nuevo_cliente" class = "tabla_nuevos_datos" width = "100%">
										<tr>
											<th colspan = "2">DATOS LEGALES</th>
										</tr>
										<tr>	
											<td>
												<p>NIT</p>
												<input class = "entradas_bordes" type = "text" name = "n_nit_cliente" id = "n_nit_cliente" onkeyup = "validar_nit()"/>
												<p id = "nit_ingresado_cliente" ></p>
											</td>
											<td>
												<p>Nombre Legal</p>
												<input class = "entradas_bordes" type = "text" name = "n_nombre_legal_cliente" id = "n_nombre_legal_cliente" />
											</td>
										</tr>	
										<tr>
											<td>
											<p>Nombre Comercial</p>
											<input class = "entradas_bordes" type = "text" name = "n_nombre_comercial_cliente" id = "n_nombre_comercial_cliente" />
										</td>
									</tr>
									<tr>
										<th colspan = "2">DATOS INFORMATIVOS</th>
									</tr>
									<tr>
										<td>
											<p>Teléfono</p>
											<input class = "entradas_bordes" type = "text" name = "n_telefono_cliente" id = "n_telefono_cliente" />
										</td>
										<td>
											<p>Dirección</p>
											<input class = "entradas_bordes" type = "text" name = "n_direccion_cliente" id = "n_direccion_cliente" />
										</td>
									</tr>
									
									<tr>
										<th colspan = "2">DATOS DE UBICACIÓN</th>
									</tr>
									<tr>
										<td>
											<p>País</p>
											<select class = "entradas_bordes_select" id = "n_pais_cliente" name = "n_pais_cliente" >
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
											<select class = "entradas_bordes_select" id = "n_departamento_cliente" name = "n_departamento_cliente" >
											</select>
										</td>
									</tr>
									<tr>
										<td>
											<p>Ciudad</p> 
											<select class = "entradas_bordes_select" id = "n_ciudad_cliente" name = "n_ciudad_cliente"></select>
										</td>
									</tr>
									
									<tr colspan = "2">
										<table class = "info_empresas_asociadas" id = "asoc_cliente_empresa" width = "100%">
											<tr>
												<th>Asociar</th>
												<th>Empresa</th>
												<th>Iniciales</th>
											</tr>
											<?php
												$consulta3 = "select c.cod_interno_empresa, c.nit_empresa, c.nombre_comercial_empresa from empresa c where c.estado = 1";
												$result3 = mysql_query($consulta3);
												while($row = mysql_fetch_array($result3)){
													echo "<tr>
														<td><input type = 'checkbox' name = 'empresas_clientes' value ='".$row['cod_interno_empresa']."'/></td>
														<td>".$row['nombre_comercial_empresa']."</td>
														<td><input type = 'text' name = 'iniciales_cliente_empresa' class = 'iniciales' /> </td>
													</tr>";
												}
											?>
										</table>
									</tr>
									<tr>
										<td></td>
									</tr>
									<tr>
										<td class = "botones_finales" colspan = "2">
											<button class = "botton_verde" id = "n_guardar_cliente_gestion" >GUARDAR</button>
											<button class = "botton_verde" id = "n_cancelar_cliente_gestion">CANCELAR</button>
										</td>
									</tr>
								</table>
							</div>
						
						</div>
					</div>
					<div class = "fondo_apertura" id = "c2">
						<div id = "datos_modificar_cliente_gestion" title = "INFORMACIÓN CLIENTE">
							<div class ="scroll_nueva_ventana">
								<strong><p class = "titulo_nueva_ventana">INFORMACION CLIENTE</p></strong>
								<table id = "tabla_datos_modificar_cliente" class = "tabla_nuevos_datos">
									<tr>
										<th>DATOS LEGALES</th>
									</tr>
									<tr>
										<td>
											<p>NIT</p>
											<input class = "entradas_bordes" type = "text" name = "e_nit_cliente" id = "e_nit_cliente" readonly="readonly"/>
										</td>
									</tr>
									<tr>
										<td>
											<p>Nombre Legal</p>
											<input class = "entradas_bordes" type = "text" name = "e_nombre_legal_cliente" id = "e_nombre_legal_cliente" />
										</td>
									</tr>
									<tr>
										<td>
											<p>Nombre Comercial</p><input class = "entradas_bordes"type = "text" name = "e_nombre_comercial_cliente" id = "e_nombre_comercial_cliente" />
										</td>
									</tr>
									<tr>
										<th>DATOS INFORMATIVOS</th>
									</tr>
									<tr>
										<td>
											<p>Teléfono</p>
											<input class = "entradas_bordes" type = "text" name = "e_telefono_cliente" id = "e_telefono_cliente" />
										</td>
									</tr>
									<tr>
										<td>
											<p>Dirección</p>
											<input class = "entradas_bordes" type = "text" name = "e_direccion_cliente" id = "e_direccion_cliente" />
										</td>
									</tr>
									<tr>
										<td class = "botones_finales">
											<button class = "botton_verde" id = "n_modificar_empresa_gestion" onclick = "guardar_modificar_cliente_gestion()">MODIFICAR</button>
											<button class = "botton_verde" id = "n_cancelar_modificar_empresa_gestion" >CANCELAR</button>
										</td>
									</tr>
								</table>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		</body>
	</html>