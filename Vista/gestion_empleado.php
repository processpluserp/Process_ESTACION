<?php
	require("../Modelo/gestion_cabecera.php");
	require("../Controller/Conexion.php");
	session_start();
	
	$gestion = new cabecera_pagina();
?>
<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>:: PROCESS + ::</title>
			<meta charset="utf-8" />
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			<link type="text/css" href="prueba.css" rel="stylesheet" />
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script type="text/javascript" src="../js/gestion.js"></script>
			<script type="text/javascript" src="../js/gestion_empresa.js"></script>
			<link rel="stylesheet" href="../css/jquery-ui.css">
			
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
			
			
		</head>
		<body>
			<div id = "contenedor_cabecera">
			</br>
				<table id  = "cabecera" width = '100%'>
					<tr>
						<td >
							<span ><?php echo $gestion->mostrar_fecha();?></span>
						</td>
						<td >
							<table width = '100%'>
								<tr>
									<td align = 'right' class = "img_alertas">
										<img src = "../images/iconos/ALERTA_CUMPLE.png" class = "iconos_barra"/>
									</td>
									<td align = 'left'>
										<span id ="cumpleanos">2</span>
									</td>
								</tr>
							</table>
						</td>
						<td >
							<table width = '100%'>
								<tr>
									<td align = 'right' class = "img_alertas">
										<img src = "../images/iconos/ALERTA_ALARMA.png" class = "iconos_barra"/>
									</td>
									<td align = 'left'>
										<span id ="alertas_facturas"><?php $gestion->obtener_num_alertas_factura_documento()?></span>
									</td>
								</tr>
							</table>
						</td>
						<td >
							<table width = '100%'>
								<tr>
									<td align = 'right' class = "img_alertas">
										<img src = "../images/iconos/ALERTA_TRAFICO_TAREA.png" class = "iconos_barra"/>
									</td>
									<td align = 'left'>
										<span id ="alerta_tareas">2</span>
									</td>
								</tr>
							</table>							
						</td>
						<td>
							<div id = "nombre_usuario_contenedor" width = '100%'>
								<table width = '100%' id = "contenedora_usuario" height = '100%'>
									<tr>
										<td >
											<img src = "../images/logo_toro_love.png" id = "logo_usuario"/>
										</td>
										<td>
											<p id = "nombre_usuario"><?php echo $gestion->mostrar_usuario();?></p>
										</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td align='right' class = 'salir_sistema'>
							<a href = "">Cerrar Sesión</a>
						</td>
					</tr>
				</table>
				
				<table id = "barra_menu" width = '100%' cellpadding = "10px">
					<tr class = "estilos_barra">
						<td>
							<a href = "bienvenida.php"><img src = "../images/iconos/HOME.png" width = '25px' height = '25px'/></a>
						</td>
						<td>
							<a href = 'gestion_empresa2.php'>
								GESTIÓN
							</a>
						</td>
						<td>
							<a href = 'trafico.php'>
								TRÁFICO
							</a>
						</td>
						<td>
							<a href = 'produccion.php'>
								PRODUCCIÓN
							</a>
						</td>
						<td>
							<a href = 'facturacion.php'>
								FACTURACIÓN
							</a>
						</td>
						<td>
							<a href = 'financiera.php'>
								FINANCIERA
							</a>
						</td>
						<td>
							<a href = 'dashboard.php'>
								DASHBOARD
							</a>
						</td>
					</tr>					
				</table>
			</div>
			
			
			
		</body>