<?php
	include("../controller/Conexion2.php");
	require("../Modelo/asistentes.php");
	session_start();
	$asis = new admin_trafico();
	if($_SESSION["codigo_usuario"] == ""){
		header("location:../logeo.php");
	}
?>
<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>PROCESS +</title>
			<meta charset="utf-8" />
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="../js/traficoadmin.js"></script>
			<script type="text/javascript" src="../js/trafico.js"></script>
			
			<link rel="stylesheet" href="../css/jquery-ui.css">
			<link rel="stylesheet" href="../css/trafico.css">
			<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
			<link type="text/css" href="../css/tablas.css" rel="stylesheet" />
			<link type="text/css" href="../css/cabecera.css" rel="stylesheet" />
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
			<style >
				body{
					font-family:'Arial';
				}
				.tabla_trafico th{
					background-color:rgb(210, 71, 46);
					color:white;
					padding:5px;
					font-size:13px;
				}
				.tabla_trafico{
					border-collapse: collapse;
				}
				.tabla_trafico th:first-child{
					border-top-left-radius:1.5em;
				}
				.tabla_trafico th:last-child{
					border-top-right-radius:1.5em;
				}
				.tabla_trafico td{
					border:1px solid black;
					font-size:11px;
				}
				.cajas{
					padding:2px;
					border-radius:0.3em;
					-webkit-border-radius:0.3em;
					-moz-border-radius:0.3em;
				}
				select{
					border-radius:0.3em;
					-webkit-border-radius:0.3em;
					-moz-border-radius:0.3em;
					padding:5px;
				}
			</style>
		</head>
		
		<body>
			<h1 style = 'text-align:center;'>TRÁFICO ADMINISTRATIVO</h1>
			<div id = 'filtros' >
				<table style ='padding-left:50px;'>
					<tr>
						<p>Seleccione un Cliente:</p>
						<select id = 'filtro_cliente' onchange = 'filtrar_por_cliente()'>
							<option value = "" selected>[TODOS]</option>
							<?php
								echo $asis->filtro($_SESSION["codigo_usuario"]);
							?>
						</select>
					</tr>
				</table>
			</div>
			</br>
			<div id  = 'contenedor_trafico' >
				
				<table width = '100%' class = 'tabla_trafico' style ='padding-left:50px;'>
					<tr>
						<th>CLIENTE</th>
						<th>PRODUCTO</th>
						<th>UNIDAD</th>
						<th>PROYECTO</th>
						<th>TAREA</th>
						<th>STATUS</th>
						<th>INICIO</th>
						<th>TERMINACIÓN</th>
						<th>DURACIÓN</th>
					</tr>
					<?php

						$user = 1;
						$asis->construct_trafic($_SESSION["codigo_usuario"]);
				
					?>
				</table>
			</div>
		</body>
	</html>
	
	