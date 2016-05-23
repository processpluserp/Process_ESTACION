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
			<script type="text/javascript" src="../js/gestion_producto_cliente.js"></script>
		</head>
		<body>
			<?php 
				include("contenido_gestion.php");
			?>				
				<div id = "contenedor_datos_administracion_principal">
					<div id = "contenedor_informacion_productos_clientes" >
						<table class = "tabla_opciones_busqueda_gestion" width ="100%">
							<tr>
								<th>Nombre Producto:</th>
								<th>
									<input type = "text" name = "n_producto_cliente" id = "n_producto_cliente" />
								</th>
								<th>Cliente</th>
								<th>
									<select class = "entradas_bordes_select" id = "b_cliente_producto" name = "b_cliente_producto" >
										<option value = "">...</option>
										<?php
											$consult6 = "select codigo_interno_cliente, nombre_legal_clientes from clientes";
											$result6 = mysql_query($consult6);
											while($row = mysql_fetch_array($result6)){
												echo "<option value =".$row['codigo_interno_cliente'].">".$row['nombre_legal_clientes']."</option>";
											}
										?>												
									</select>
								</th>
								<th>
									<button class = "mostrar_datos" id = "boton_mostrar_productos_cliente_gestion" >MOSTRAR TODO</button>
								</th>
								<th>
									<button class = "crear_nuevos_datos" id = "boton_crear_producto_cliente_gestion" >CREA NUEVO</button>
								</th>
							</tr>
						</table>
						
						<div id = "contenedor_tabla_productos_cliente_gestion">
							<?php
								$tabla = "<table id = 'tabla_contenedor_info_productos_cliente' class = 'tablas_muestra_datos_tablas'>
									<tr>
										<th>Nombre Producto</th>
										<th>Cliente</th>
										<th>Estado</th>
										<th></th>
									</tr>";
								$consult5 = "select pc.id_procliente,pc.estado, pc.nombre_producto, c.nombre_legal_clientes from producto_clientes pc, clientes c 
								where pc.pk_clientes_nit_procliente = c.codigo_interno_cliente";
								$result5 = mysql_query($consult5);
								$n_registros = mysql_num_rows($result5);
								if($n_registros == 0){
									echo "<p class = 'resultado_gestion_consulta'>NO SE ENCONTRARON REGISTROS</p>";
								}else{
									while($row = mysql_fetch_array($result5)){
										$id = $row['id_procliente'];
										$estado = "";
										if($row['estado'] == 1){
											$estado = "ACTIVO";
										}else{
											$estado = "INACTIVO";
										}
										$tabla .= "<tr id = ".$id.">
											<td>".$row['nombre_producto']."</td>
											<td>".$row['nombre_legal_clientes']."</td>
											<td>".$estado."</td>
											<td><img src = '../images/prueba.jpg' onclick = 'cambiar_estado_producto_cliente($id)'/></td>
										</tr>";
									}
									echo $tabla;
								}
								echo "</table>";
							?>
						</div>
						
						<div class = "fondo_apertura" id = "p1">
							<div id = "datos_crear_producto_cliente_gestion" title = "DATOS NUEVO PRODUCTO CLIENTE" class = "ventana_producto">
								<strong><p class = "titulo_nueva_ventana">DATOS NUEVO PRODUCTO</p></strong>
								<table id = "tabla_datos_nuevo_producto_cliente"  >
									<tr>
										<td>
											<p>Seleccione el Cliente</p>
											<select class = "entradas_bordes_select" id = "n_cliente_producto" name = "n_cliente_producto">
												<option value = "">...</option>
												<?php
													$consult6 = "select codigo_interno_cliente, nombre_legal_clientes from clientes";
													$result6 = mysql_query($consult6);
													while($row = mysql_fetch_array($result6)){
														echo "<option value =".$row['codigo_interno_cliente'].">".$row['nombre_legal_clientes']."</option>";
													}
												?>												
											</select>
										</td>
									</tr>	
									<tr>
										<td>
											<p>Nombre Producto</p>
											<input name = "n_nombre_producto" id = "n_nombre_producto" class = "entradas_bordes" />
										</td>
									</tr>
									<tr>	
										<td class = "botones_finales">
											<button class = "botton_verde" id = "n_crear_producto_cliente_gestion">GUARDAR</button>
											<button class = "botton_verde" id = "n_cancelar_producto_clientes_gestion" >CANCELAR</button>
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