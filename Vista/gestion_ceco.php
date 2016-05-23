<?php
	include("../Controller/Conexion.php");
	require("../Modelo/ceco.php");
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
			<script type="text/javascript" src="../js/gestion_ceco.js"></script>
		</head>
		<body>
			<?php 
				include("contenido_gestion.php");
			?>
			<div id = "contenedor_datos_administracion_principal">
				<div id = "contenedor_informacion_ceco">
					<table class = "tabla_opciones_busqueda_gestion" width = "100%">
						<tr>
							<th>
								<input class = "input_redondos" type = "text" name = "b_empresa" id = "b_empresa" placeholder ="Nombre Empresa"/>
							</th>
							<th>
								<input class = "input_redondos" type = "text" name = "b_ceco" id = "b_ceco" placeholder = "Nombre Ceco"/>
							</th>
							<th>
								<button class = "mostrar_datos" id = "boton_mostrar_ceco_gestion" >MOSTRAR TODO</button>
							</th>
							<th>
								<button class = "mostrar_datos" id = "boton_ceco_gestion" >CREAR CECO</button>
							</th>
						</tr>
					</table>
					<div id = "contenedor_tabla_ceco_gestion" class = "contenedor_datos_consultas">
						<?php
							$ceco = new ceco();
							$ceco->mostrar_datos();
						?>
					</div>
					<div class = "fondo_apertura" id = "e1">
							<div id = "datos_crear_ceco_gestion" title = "DATOS NUEVA CECO">
								<div class ="scroll_nueva_ventana">
									<strong><p class = "titulo_nueva_ventana">DATOS NUEVO CECO</p></strong>
									<table id = "tabla_datos_nueva_ceco" class = "tabla_nuevos_datos" width = "100%">
										<tr>
											<td>Empresa:</td>
											<td>
												<select id = "empresa_ceco" class = "entradas_bordes_select">
													<option value = "">...</option>
													<?php
														$consulta3 = "select c.cod_interno_empresa, c.nit_empresa, c.nombre_comercial_empresa from empresa c where c.estado = 1";
														$result = mysql_query($consulta3);
														while($row = mysql_fetch_array($result)){
															echo "<option value = ".$row['cod_interno_empresa'].">".$row['nombre_comercial_empresa']."</option>";
														}
													?>
												</select>
											</td>
										</tr>
										<tr>
											<td>Nombre Ceco</td>
											<td>
												<input type = "text" class = "input_redondos" name = "n_ceco" id = "n_ceco" width = "300px"/>
											</td>
										</tr>
										<tr>
											<td colspan = "2">
												<button class = "botton_verde" id = "n_crear_ceco_gestion" >GUARDAR</button>
												<button class = "botton_verde" id = "n_cancelar_ceco_gestion">CANCELAR</button>
											</td>
										</tr>
									</table>
								</div>
							</div>
					</div>
					<div class = "fondo_apertura" id = "e2">
							<div id = "datos_modificar_ceco_gestion" title = "MODIFICAR DATOS CECO">
								<div class ="scroll_nueva_ventana">
									<strong><p class = "titulo_nueva_ventana">MODIFICAR DATOS CECO</p></strong>
									<table id = "tabla_datos_nueva_ceco" class = "tabla_nuevos_datos" width = "100%">
										<tr>
											<td>Empresa:</td>
											<td>
												<p id = "emp_ceco"></p>
											</td>
										</tr>
										<tr>
											<td>Código:</td>
											<td>
												<p id = "cod_ceco"></p>
											</td>
										</tr>
										<tr>
											<td>Nombre Ceco</td>
											<td>
												<input type = "text" class = "input_redondos" name = "e_ceco" id = "e_ceco"/>
											</td>
										</tr>
										<tr>
											<td colspan = "2">
												<button class = "botton_verde" id = "e_crear_ceco_gestion" >GUARDAR</button>
												<button class = "botton_verde" id = "e_cancelar_ceco_gestion">CANCELAR</button>
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