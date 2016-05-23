<?php
	include("../Controller/Conexion.php");
?>
<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>:: PROCESS + ::</title>
			<meta charset="utf-8" />
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			 <!--<script type="text/javascript" src="../js/jquery_ui/jquery-ui-1.8.23.custom.min.js"></script> Primordial-->
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script type="text/javascript" src="../css_jquery/css_logeo.js"></script>
			<link type="text/css" href="../css/barra_navegacion2.css" rel="stylesheet" />
			<link type="text/css" href="../css/tarifario.css" rel="stylesheet" />
			<script type="text/javascript" src="../js/tarifario.js"></script>
		
			<link rel="stylesheet" href="../css/jquery-ui.css">
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
		</head>
		<body>
			<div width = "100%">
				<h1>TARIFARIO PROVEEDORES</h1>
			</div>
			
			<div id = "tarifario" width = "100%">
				<table width = "100%">
					<tr>
						<td width = "50%" id = "datos_nuevos">
							<div class = "nuevo_item">
								<h1>AÑADIR DATOS AL TARIFARIO</h1>
							</div>
							<div id = "ingresar_datos_nuevos">
								<table>
									<tr id = "form_nuevo_item">
										<th>NUEVO ITEM</th>
									</tr>
									
									<tr class = "form_item_nuevo">
										<td>Empresa</td>
										<td>
											<select id = "empresa">
												<option value = "1">DU BRANDS</option>
												<option value = "2">LA ESTACION PROMOCIONES Y ACTIVACIONES</option>
											</select>
										</td>
									</tr>
									<tr class = "form_item_nuevo">
										<td>Proveedor</td>
										<td>
											<select id = "proveedor">
												<?php
													$select = mysql_query("select id,nit,name from pro_tarifario");
													while($row = mysql_fetch_array($select)){
														$id = $row['id'];
														echo "<option value = '$id'>".$row['name']."</option>";
													}
												?>
											</select>
										</td>
									</tr>
									<tr class = "form_item_nuevo">
										<td>Grupo</td>
										<td>
											<select id = "grupo_option">
												<?php
													$select = mysql_query("select id,name from grupo_tarifario");
													while($row = mysql_fetch_array($select)){
														$id = $row['id'];
														echo "<option value = '$id'>".$row['name']."</option>";
													}
												?>
											</select>
										</td>
									</tr>
									<tr class = "form_item_nuevo">
										<td>Item</td>
										<td>
											<input type = "text" name = "item" id = "item" />
										</td>
									</tr>
									<tr class = "form_item_nuevo">
										<td>Tarifa</td>
										<td>
											<input type = "text" name = "tarifa" id = "tarifa" value = "0" />
										</td>
									</tr>
									<tr class = "form_item_nuevo">
										<td>% Iva</td>
										<td>
											<input type = "text" name = "iva" id = "iva" value ="16"/>
										</td>
									</tr>
									<tr class = "form_item_nuevo">
										<td>% Volumen</td>
										<td>
											<input type = "text" name = "vol" id = "vol" value = "0"/>
										</td>
									</tr>
									<tr class = "form_item_nuevo">
										<td colspan = "2">
											<button id ="agregar_tarifa">Agregar Tarifa</button>
										</td>
									</tr>
									
									<tr id = "form_nuevo_grupo">
										<th>NUEVO GRUPO</th>
									</tr>
									<tr class = "form_grupo_nuevo">
										<td>Nombre</td>
										<td>
											<input type = "text" name = "nombre_grupo" id = "nombre_grupo"/>
											<button id = "agregar_grupo">Añadir Grupo</button>
										</td>
									</tr>
									<tr id = "form_nuevo_proveedor">
										<th>NUEVO PROVEEDOR</th>
									</tr>
									<tr class = "form_proveedor_nuevo">
										<td>Nit</td>
										<td>
											<input type = "text" name = "nit_pro" id = "nit_pro"/>
										</td>
									</tr>
									<tr class = "form_proveedor_nuevo">
										<td>Nombre Proveedor</td>
										<td>
											<input type = "text" name = "nombre_pro" id = "nombre_pro"/>
											<button id = "agregar_proveedor">Añadir Proveedor</button>
										</td>
									</tr>
								</table>
							</div>
						</td>
						<td  width = "50%" id = "datos_cargados">
							<div class = "nuevo_item">
								<h1>TARIFARIO ACTUAL</h1>
							</div>
							<table width = "100%">
								<tr>
									<td>Empresa
										<select id = "b_emp">
											<option value = "1">DU BRANDS</option>
											<option value = "2">LA ESTACION PROMOCIONES Y ACTIVACIONES</option>
										</select>
									</td>
									<td>Proveedor
										<select id = "b_proveedor">
											<?php
												$select = mysql_query("select id,nit,name from pro_tarifario");
												while($row = mysql_fetch_array($select)){
													$id = $row['id'];
													echo "<option value = '$id'>".$row['name']."</option>";
												}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td>Grupo
										<select id = "b_grupo">
											<?php
												$select = mysql_query("select id,name from grupo_tarifario");
												while($row = mysql_fetch_array($select)){
													$id = $row['id'];
													echo "<option value = '$id'>".$row['name']."</option>";
												}
											?>
										</select>
									</td>
									<td>Nombre
										<input type = "text" name = "nombre_item" id = "nombre_item" />
									</td>
								</tr>
								<tr></tr>
								<tr>
									<td colspan = "2">
										<div  id= "contenedor_tarifario" width = "100%">
											
										</div>
									</td>
								</tr>
							</table>
							
						</td>
					</tr>
				</table>
			</div>
		</body>
	</html>
	
	