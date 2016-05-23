<?php
	include("../Controller/Conexion.php");
	require("../Modelo/gestion_cabecera.php");
	session_start();
	
	if($_SESSION["codigo_usuario"] == ""){
		header("location:../logeo.php");
	}
	
	
	$gestion = new cabecera_pagina();
	
	$usuario_actual = $_SESSION["codigo_usuario"];
	$nombre_usuario = $_SESSION["nombre_usuario"];
	$consult_ot = "Select distinct year_ot from cabot order by year_ot desc";
	$result1 = mysql_query($consult_ot);
	$consult_departamento = "select * from area_empresa";
	$result2 = mysql_query($consult_departamento);
	$result3 = mysql_query($consult_departamento);
	
	$horas = "";
	for($i = 1; $i <=12;$i++ ){
		if($i<10){
			$i = "0".$i;
		}
		$horas .="<option value = '$i'>$i</option>";
	}
	$minutos = "";
	for($i = 0; $i <=55;$i = $i + 5 ){
		if($i<10){
			$i = "0".$i;
		}
		$minutos .="<option value = '$i'>$i</option>";
	}
?>

<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>:: PROCESS + ::</title>
			<meta charset="utf-8" />
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			<link type="text/css" href="../css/tablas.css" rel="stylesheet" />
			<link type="text/css" href="../css/cabecera.css" rel="stylesheet" />
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script type="text/javascript" src="../css_jquery/css_logeo.js"></script>
			<link type="text/css" href="../css/brief.css" rel="stylesheet" />
			<link type="text/css" href="../css/trafico.css" rel="stylesheet" />
			<link type="text/css" href="../css/reportes.css" rel="stylesheet" />
			<script type="text/javascript" src="../js/trafico.js"></script>
			<script type="text/javascript" src="../js/reportes.js"></script>
			<style >
				.estilos_barra td:nth-child(3){
					background-color:#EF8C14;
				}
			</style>
			<style type="text/css" media="print">
				@media print {
					.tablas_reportes th{
						border-top-left-radius:0.3em;
						border-top-right-radius:0.3em;
						border:1px solid black;
						background-color:rgb(80,184,72);
						color:white;
					}
				}
			</style>
			
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
										<span id ="cumpleanos"><?php $gestion->obtener_cumpleanos_del_dia()?></span>
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
										<span id ="alerta_tareas"><?php echo $gestion->tareas_pendientes($usuario_actual);?></span>
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
							<span onclick = "cerrar_sesion()">Cerrar Sesión</span>
						</td>
					</tr>
				</table>
				
				<table id = "barra_menu" width = '100%' cellpadding = "10px">
					<tr class = "estilos_barra">
						<td>
							<a href = "bienvenida.php"><img src = "../images/iconos/HOME.png" width = '25px' height = '25px'/></a>
						</td>
						<td class = "actual">
							<a href = 'gestion_empresa2.php' class = "actual">
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
			
			<div id = "cuerpo_pagina">
				</br>
				<span id = "p"  class = "botones_trafico">abrir</span>
				<a href="trafico.php"  class = "botones_trafico"><span>GESTION OT</span></a>
				<a href="time_table.php" class = "botones_trafico"><span>TIME TABLE</span></a>
				<a href="reportes.php" id = "actual_trafico" class = "botones_trafico"><span>REPORTES</span></a>
				</br>
				</br>
				<table width = '100%'>
					<tr>
						<td>
							<div id = "listado_reportes">
								<table id = "listado_reportes_tabla">
									<tr>
										<td><span id = "b_reporteot">Reporte de OT's</span></td>
									</tr>
									<tr>
										<td id = "b_reportetareas">Reporte de Tareas </td>
									</tr>
									<tr>
										<td>Reporte de Clientes por Ejecutivo</td>
									</tr>
									<tr>
										<td>Reporte de Pptos</td>
									</tr>
									<tr>
										<td>Reporte</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
				</table>
			</div>
			
			<div id = "reporte_ots" title = "REPORTE DE OT">
				<table width = "100%">
					<tr>
						<td width = '15%'>
							Empresa
							<select class = "entradas_bordes" id = "empresa_rot"  >
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
						<td class = "separator" width = '5%'></td>
						<td width = '15%'>
							Cliente
							<select class = "entradas_bordes" id = "cliente_rot" >
							</select>
						</td>
						<td class = "separator" width = '5%'></td>
						<td width = '15%'>
							Desde
							<?php echo "<input type = 'text' name = 'fdesde_ot' value = '".date('Y-m-d')."' id = 'fdesde_ot' />"?>
						</td>
						<td class = "separator" width = '5%'></td>
						<td width = '15%'>
							Hasta
							<?php echo "<input type = 'text' name = 'fhasta_ot' value = '".date('Y-m-d')."' id = 'fhasta_ot' />"?>
						</td>
						<td class = "separator" width = '5%'></td>
						<td nowrap width = '15%'>
							<span id = "generar_reporte_ot"class = "mostrar_datos">Generar Reporte</span>
						</td>
						<td nowrap width = '15%'>
							<a href = "download_reporte_ot"><img src = "../images/iconos/excel.png" width = '50px' height = '50px'/></a>
						</td>
						<td nowrap width = '15%'>
							<a href = "javascript:imprSelec('contenedor_rreporte_ot')"><img src = "../images/iconos/excel.png" width = '50px' height = '50px'/></a>
						</td>
					</tr>
				</table>
				</br>
				<div id = "contenedor_rreporte_ot"></div>
			</div>
			
			<div  id = "reporte_tareas" title = "REPORTE DE TAREAS">
				<table width = "100%">
					<tr>
						<td >Empresa</td>
						<td>
							<select class = "entradas_bordes" id = "empresa_rtareas"  >
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
						<td>Cliente</td>
						<td>
							<select class = "entradas_bordes" id = "cliente_rtareas" >
							</select>
						</td>
						<td >
							<span id = "generar_reporte_tareas"class = "mostrar_datos">Generar Reporte</span>
						</td>
					</tr>
					<tr>
						<td>Departamento</td>
						<td>
							
						</td>
						<td >Tareas</td>
						<td>
							<select class = "entradas_bordes" id = "tareas_tareas">
								<option value = "2">TODAS</option>
								<option value = "1">CONTESTADAS</option>
								<option value = "0">PENDIENTES</option>
							</select>
						</td>
						<td >
							<a href = "download_reporte_tareas"><img src = "../images/iconos/excel.png" width = '50px' height = '50px'/></a>
						</td>
					</tr>
					<tr>
						<td>Desde</td>
						<td><?php echo "<input type = 'text' name = 'fdesde_tareas' value = '".date('Y-m-d')."' id = 'fdesde_tareas' />"?></td>
						<td>Hasta</td>
						<td><?php echo "<input type = 'text' name = 'fhasta_tareas' value = '".date('Y-m-d')."' id = 'fhasta_tareas' />"?></td>
					</tr>
				</table>
				<div id = "contenedor_rrporte_tareas"></div>
			</div>
		</body>
	</html>
	