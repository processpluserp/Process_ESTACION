<?php
	
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
			
			<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
			<link href="../dist/selectivity-full.css" rel="stylesheet">
			<script src="../dist/selectivity-full.js"></script>
			
			
			<script type="text/javascript" src="../js/ppto_tarifa.js"></script>
			
			<link rel="stylesheet" href="../css/jquery-ui.css">
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
			
			
		</head>
		
		<body>
			<button id = 'generar_orden'>Generar Orden</button>
			<a href= 'pdf.php'>Generar Orden</a>
			<div id = "contenedor_ppto"></div>
			<table>
				<tr>
					<td>
						<div id ="resumen_ppto">
							<table>
								<tr>
									<th colspan = '2'>RESUMEN INTERNO UTILIDAD</th>
								</tr>
								<tr>
									<td>TOTAL CLIENTE</td>
									<td>
										<span id = "total_cliente_final_cuadro"></span>
										<span id = "total_cliente_final_cuadro_o" class = 'hidde'></span>
									</td>
								</tr>
								<tr>
									<td>TOTAL VOLUMEN</td>
									<td>
										<span id = "total_vol_cliente_final_cuadro"></span>
										<span id = "total_vol_cliente_final_cuadro_o" class = 'hidde'></span>
									</td>
								</tr>
								<tr>
									<td>COMIOSION AGENCIA 10%</td>
									<td id = "comision_agencia"><span id = 'ingres_com_agencia' ondblclick = 'cambiar_comision()'>0</span></td>
								</tr>
								<tr>
									<td>TOTAL GENERAL</td>
									<td>
										<span id = 'total_general_1'></span>
										<span id = 'total_general_1_o' class = 'hidde'></span>
									</td>
								</tr>
							</table>
						</div>
					</td>
					<td>	
						<div id = "resumen_ppto2">
							<table>
								<tr>
									<th colspan = '2'>RESUMEN CLIENTE</th>
								</tr>
								<tr>
									<td>SUBTOTAL</td>
									<td>
										<span id = 'subtotal_1'></span>
										<span id = 'subtotal_1_o' class = 'hidde'></span>
									</td>
								</tr>
								<tr>
									<td>IVA</td>
									<td>
										<span id = 'total_general_2'></span>
										<span id = 'total_general_2_o' class = 'hidde'></span>
									</td>
								</tr>
								<tr>
									<td>TOTAL GENERAL</td>
									<td>
										<span id = 'to_general'></span>
										<span id = 'to_general_o' class = 'hidde'></span>
									</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</table>
		</body>
	</html>