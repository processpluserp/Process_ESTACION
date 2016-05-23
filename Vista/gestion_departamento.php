<?php
	include("../Controller/Conexion.php");
	require("../Modelo/departamento.php");
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
			<script type="text/javascript" src="../js/gestion_depto.js"></script>
		</head>
		<body>
			<?php 
				include("contenido_gestion.php");
			?>
			<div id = "contenedor_datos_administracion_principal">
				<div id = "contenedor_informacion_depto">
					<table class = "tabla_opciones_busqueda_gestion" width = "100%">
						<tr>
							<th>Empresa:</th>
							<th>
								<input class = "input_redondos" type = "text" name = "b_empresa" id = "b_empresa" />
							</th>
							<th>Departamento:</th>
							<th>
								<input class = "input_redondos" type = "text" name = "b_depto" id = "b_depto" />
							</th>
							<th>
								<button class = "mostrar_datos" id = "boton_mostrar_depto_gestion" >MOSTRAR TODO</button>
							</th>
							<th>
								<button class = "mostrar_datos" id = "boton_depto_gestion" >CREAR CECO</button>
							</th>
						</tr>
					</table>
					
					<div id = "contenedor_tabla_depto_gestion" class = "contenedor_datos_consultas">
						<?php
							$depto = new departamento();
							$depto->estructura_tabla($depto->mostrar_datos());
						?>
					</div>
					<div class = "fondo_apertura" id = "e1">
						<div id = "datos_crear_depto_gestion" title = "DATOS NUEVA CECO">
							<div class ="scroll_nueva_ventana">
								<strong><p class = "titulo_nueva_ventana">DATOS NUEVO DEPARTAMENTO</p></strong>
								<table id = "tabla_datos_nueva_depto" class = "tabla_nuevos_datos" width = "100%">
									<tr>
										<td>Empresa:</td>
										<td>
											<select id = "empresa_depto" class = "entradas_bordes_select">
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
										<td>Nombre Departamento</td>
										<td>
											<input type = "text" class = "" name = "n_depto" id ="n_depto" />
										</td>
									</tr>
									<tr>
										<td colspan = "2">
											<button class = "botton_verde" id = "n_crear_depto_gestion" >GUARDAR</button>
											<button class = "botton_verde" id = "n_cancelar_depto_gestion">CANCELAR</button>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					
					<div class = "fondo_apertura" id = "e2">
						<div id = "datos_modificar_depto_gestion" title = "DATOS NUEVA depto">
							<div class ="scroll_nueva_ventana">
								<strong><p class = "titulo_nueva_ventana">MODIFICAR NOMBRE DEPARTAMENTO</p></strong>
								<table id = "tabla_datos_modificar_depto" class = "tabla_nuevos_datos" width = "100%">
									<tr>
										<td>Empresa:</td>
										<td>
											<p id = "nombre_empresa"></p>
											<p id = "codigo" class ="oculto"></p>
										</td>
									</tr>
									<tr>
										<td>Nombre Departamento</td>
										<td>
											<input type = "text" class = "" name = "e_depto" id ="e_depto" />
										</td>
									</tr>
									<tr>
										<td colspan = "2">
											<button class = "botton_verde" id = "e_modificar_depto_gestion" onclick = "guardar_modificar_dpto()">GUARDAR</button>
											<button class = "botton_verde" id = "c_modificar_depto_gestion">CANCELAR</button>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</body>
