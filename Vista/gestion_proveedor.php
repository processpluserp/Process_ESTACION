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
			<script type="text/javascript" src="../js/gestion_proveedor.js"></script>
		</head>
		<body>
			<?php 
				include("contenido_gestion.php");
			?>
			<div id = "contenedor_datos_administracion_principal">
				<div id = "contenedor_informacion_proveedores">
					<table class = "tabla_opciones_busqueda_gestion" width = "100%">
						<tr>
							<th>Nit</th>
							<th>
								<input type = "text" name = "b_nit_proveedor" id = "b_nit_proveedor" />
							</th>
							<th>Nombre Proveedor:</th>
							<th>
								<input class = "entradas_bordes_select" id = "b_nombre_proveedor" name = "b_nombre_proveedor"  />
							</th>
							<th>
								<button class = "mostrar_datos" id = "boton_mostrar_proveedores_gestion" >MOSTRAR TODO</button>
							</th>
							<th>
								<button class = "crear_nuevos_datos" id = "boton_crear_proveedores_gestion" >CREA NUEVO</button>
							</th>
						</tr>
					</table>
					<div id = "contenedor_tabla_proveedores_gestion" class = "contenedor_datos_consultas">
						<?php
							$tabla = "<table id = 'tabla_contenedor_info_proveedores' class = 'tablas_muestra_datos_tablas'>
								<tr>
									<th>Nit</th>
									<th>Nombre Legal</th>
									<th>Nombre Comercial</th>
									<th>Dirección</th>
									<th>Teléfono</th>
									<th>Correo</th>
									<th>Ciudad</th>
									<th>Estado</th>
								</tr>";
							$consult_proveedor = "select p.codigo_interno_proveedor, p.nit_proveedor, p.nombre_comercial_proveedor,p.nombre_legal_proveedor,
							p.direccion_proveedor, p.telefono_proveedor, p.correo_proveedor,p.estado, c.nombre_ciudad from proveedores p, ciudad c where 
							c.codigo_ciudad = p.ciudad_codigo_ciudad";
							$result_proveedor = mysql_query($consult_proveedor);
							$n_registros = mysql_num_rows($result_proveedor);
							if($n_registros == 0){
								echo "<p class = 'resultado_gestion_consulta'>NO SE ENCONTRARON REGISTROS</p>";
							}else{
								while($row = mysql_fetch_array($result_proveedor)){
									$id = $row['codigo_interno_proveedor'];
									$nit = $row['nit_proveedor'];
									$estado = "";
									if($row['estado'] == 1){
										$estado = "ACTIVO";
									}else{
										$estado = "INACTIVO";
									}
									$tabla .= "<tr id = ".$id.">
										<td>".$row['nit_proveedor']."</td>
										<td>".$row['nombre_legal_proveedor']."</td>
										<td>".$row['nombre_comercial_proveedor']."</td>
										<td nowrap>".$row['direccion_proveedor']."</td>
										<td>".$row['telefono_proveedor']."</td>
										<td>".$row['correo_proveedor']."</td>
										<td>".$row['nombre_ciudad']."</td>
										<td>".$estado."</td>
										<td><img src = '../images/prueba.jpg' onclick = 'cambiar_estado_proveedor($id)'/></td>
										<td><img src = '../images/editar.png' onclick = 'editar_proveedor($id)' class = 'botones'/></td>
									</tr>";
								}
								$tabla .="</table>";
								echo $tabla;
							}
						?>
					</div>
					<div class = "fondo_apertura" id = "p1">
						<div id = "datos_crear_proveedor_gestion" title = "DATOS NUEVO PROVEEDOR">
							<div class ="scroll_nueva_ventana">
								<strong><p class = "titulo_nueva_ventana">DATOS NUEVO PROVEEDOR</p></strong>
								<table id = "tabla_datos_nuevo_proveedor" class = "tabla_nuevos_datos">
									<tr>
										<td>
											<p>NIT</p>
											<input class = "entradas_bordes" id = "n_nit_proveedor" name = "n_nit_proveedor"/>
											<p id = "nit_ingresado_proveedor" ></p>
										</td>
										<td>
											<p>Nombre Legal</p>
											<input class = "entradas_bordes" id = "n_nlegal_proveedor" name = "n_nlegal_proveedor" />
										</td>
									</tr>
									<tr>
										<td>
											<p>Nombre Comercial</p>
											<input class = "entradas_bordes" id = "n_ncomercial_proveedor" name = "n_ncomercial_proveedor" />
										</td>
									</tr>
									<tr>
										<th colspan = "2">DATOS INFORMATIVOS</th>
									</tr>
									<tr>
										<td>
											<p>Dirección</p>
											<input class = "entradas_bordes" id = "n_direccion_proveedor" name = "n_direccion_proveedor" />
										</td>
										<td>
											<p>Teléfono</p>
											<input class = "entradas_bordes" id = "n_telefono_proveedor" name = "n_telefono_proveedor" />
										</td>
									</tr>
									<tr>
										<td>
											<p>Correo</p>
											<input class = "entradas_bordes" id = "n_correo_proveedor" name = "n_correo_proveedor" />
										</td>
									</tr>
									<tr>
										<th colspan = "2">DATOS DE UBICACIÓN</th>
									</tr>
									<tr>
										<td>
											<p>País</p>
											<select class = "entradas_bordes_select" id = "n_pais_proveedor" name = "n_pais_proveedor" >
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
											<select class = "entradas_bordes_select" id = "n_departamento_proveedor" name = "n_departamento_proveedor" >
											</select>
										</td>
									</tr>
									<tr>
										<td>
											<p>Ciudad</p> 
											<select class = "entradas_bordes_select" id = "n_ciudad_proveedor" name = "n_ciudad_proveedor"></select>
										</td>
									</tr>
									<tr>
										<table class = "info_empresas_asociadas" id = "asoc_proveedor_empresa" >
											<tr>
												<th>Asociar</th>
												<th width = "100%">Empresa</th>
											</tr>
											<?php
												$consulta3 = "select c.cod_interno_empresa, c.nit_empresa, c.nombre_legal_empresa from empresa c where c.estado = 1";
												$result3 = mysql_query($consulta3);
												$ii = 0;
												/*
												<td><input type = 'text' name = 'iniciales_proveedor_empresa' id = 'iniprov$ii'class = 'iniciales' onkeyup = 'validar_iniciales($ii)'/> </td>
												*/
												while($row = mysql_fetch_array($result3)){
													echo "<tr>
														<td><input type = 'checkbox' name = 'empresas_proveedor' value ='".$row['cod_interno_empresa']."'/></td>
														<td>".$row['nombre_legal_empresa']."</td>
													</tr>";
													$ii++;
												}
											?>
										</table>
									</tr>
									<tr>
										<td class = "botones_finales">
											<button class = "botton_verde" id = "n_crear_proveedor_gestion" >GUARDAR</button>
											<button class = "botton_verde" id = "n_cancelar_proveedores_gestion">CANCELAR</button>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class = "fondo_apertura" id = "p2">
						<div id = "datos_modificar_proveedor_gestion" title = "INFORMACIÓN PROVEEDOR">
							<div class ="scroll_nueva_ventana">
								<strong><p class = "titulo_nueva_ventana">INFORMACION PROVEEDOR</p></strong>
								<table id = "tabla_datos_modificar_proveedor" class = "tabla_nuevos_datos">
									<tr>
										<th>DATOS LEGALES</th>
									</tr>
									<tr>
										<td>
											<p>NIT</p>
											<input class = "entradas_bordes" type = "text" name = "e_nit_proveedor" id = "e_nit_proveedor" readonly="readonly"/>
										</td>
									</tr>
									<tr>
										<td>
											<p>Nombre Legal</p>
											<input class = "entradas_bordes" type = "text" name = "e_nombre_legal_proveedor" id = "e_nombre_legal_proveedor" />
										</td>
									</tr>
									<tr>
										<td>
											<p>Nombre Comercial</p><input class = "entradas_bordes"type = "text" name = "e_nombre_comercial_proveedor" id = "e_nombre_comercial_proveedor" />
										</td>
									</tr>
									<tr>
										<th>DATOS INFORMATIVOS</th>
									</tr>
									<tr>
										<td>
											<p>Teléfono</p>
											<input class = "entradas_bordes" type = "text" name = "e_telefono_proveedor" id = "e_telefono_proveedor" />
										</td>
									</tr>
									<tr>
										<td>
											<p>Correo</p>
											<input class = "entradas_bordes" type = "text" name = "e_correo_proveedor" id = "e_correo_proveedor" />
										</td>
									</tr>
									<tr>
										<td>
											<p>Dirección</p>
											<input class = "entradas_bordes" type = "text" name = "e_direccion_proveedor" id = "e_direccion_proveedor" />
										</td>
									</tr>
									<tr>
										<td class = "botones_finales">
											<button class = "botton_verde" id = "n_modificar_proveedor_gestion">MODIFICAR</button>
											<button class = "botton_verde" id = "n_cancelar_modificar_proveedor_gestion" >CANCELAR</button>
										</td>
									</tr>
								</table>
							</div>	
						</div>
					</div>
					
					
				</div>
			</div>
		</body>
	</html>