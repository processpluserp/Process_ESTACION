<?php
	include("../Controller/Conexion.php");
	require("../Modelo/gestion_cabecera.php");
	require("../Modelo/Empresa.php");
	require("../Modelo/financiera.php");
	require("../Modelo/empleado.php");
	session_start();
	if($_SESSION["codigo_usuario"] == ""){
		header("location:../logeo.php");
	}
	
	
	$gestion = new cabecera_pagina();
	
	$emp = new Empresa();
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
	$codigo_usuario_real = $_SESSION["codigo_usuario"];
	$empresa_final = $gestion->mostrar_empresa_empleado();
?>

<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>:: PROCESS + ::</title>
			<meta charset="utf-8" />
			<script type="text/javascript" src="https://www.google.com/jsapi"></script>
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="../css_jquery/css_logeo.js"></script>
			<script type="text/javascript" src="../js/gestion_empresa.js"></script>
			<script type="text/javascript" src="../js/ocultar.js"></script>
			<script type="text/javascript" src="../js/financiera.js"></script>
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
			
			
			<script type="text/javascript" src="../js/reportes.js"></script>
			<script type="text/javascript" src="../js/b_ot_g.js"></script>
			<script src="../chart_js/Chart.js"></script>
			
			<script src="../js/canvasjs.min.js"></script>
			<!--<link href='https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>-->
			<link rel="stylesheet" href="../css/jquery-ui.css"/>
			<link type="text/css" href="../css/reportes.css" rel="stylesheet" />
			<!--<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>-->
			
			<link type="text/css" href="../css/tablas.css" rel="stylesheet" />
			<link type="text/css" href="../css/cabecera.css" rel="stylesheet" />

			<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
			
			<script type="text/javascript" src="../js/resize.js"></script>
			

			<script type="text/javascript" src="../lib/alertify.js"></script>
			<link rel="stylesheet" href="../themes/alertify.core.css" />
			<link rel="stylesheet" href="../themes/alertify.default.css" />


			<!--<link rel='stylesheet' href='../lib/cupertino/jquery-ui.min.css' />-->
			<style >
				.subtitulos_columnas{
					border-top-left-radius:0.3em;
					-moz-border-top-left-radius:0.3em;
					-webkit-border-top-left-radius:0.3em;
					border-top-right-radius:0.3em;
					-moz-border-top-right-radius:0.3em;
					-webkit-border-top-right-radius:0.3em;
				}
				.titulos{
					background-color:#EF8C14;
					color:white;
					border-radius:0.3em;
					-moz-border-radius:0.3em;
					-webkit-border-radius:0.3em;
					text-align:center;
					vertical-align:middle;
					font-weight:bold;
					font-size:14px;
				}
				.cartera td{
					border:1px solid black;
				}
				.titulos2{
					background-color:#EF8C14;
					color:white;
					border-top-left-radius:0.3em;
					-moz-border-top-left-radius:0.3em;
					-webkit-border-top-left-radius:0.3em;
					border-top-right-radius:0.3em;
					-moz-border-top-right-radius:0.3em;
					-webkit-border-top-right-radius:0.3em;
					text-align:center;
					vertical-align:middle;
					font-weight:bold;
				}
				.contenedor_items{
					border-radius:0.3em;
					-moz-border-radius:0.3em;
					-webkit-border-radius:0.3em;
					font-size:12px;
					border:1px solid black;
				}
				.resultados{
					border-radius:0.3em;
					-moz-border-radius:0.3em;
					-webkit-border-radius:0.3em;
					font-size:12px;
					color:white;
					font-weight:bold;
					background-color:#A0A0A0;
				}
				.alerta{
					font-weight:bold;
					color:red;
				}
				.alerta_positiva{
					background-color:#35B324;
					color:white;
				}
				.alerta_negativa{
					background-color:#FF0101;
					color:white;
				}
				.recuadro{
					border:1px solid black;
					padding:4px;
				}
				
				.estilos_barra td:nth-child(5){
					background-color:rgb(109, 202, 35);
				}
				.ui-widget-header{
					/*background-color: rgb(109, 202, 35);*/
				}
				.sorting,.sorting_asc,.sorting_desc{
					cursor:pointer;
				}
				.ui-widget-header table tr{
					border-radius:0.5em;
					-moz-border-radius:0.5em;
					-webkit-border-radius:0.5em;
				}
				.ui-widget-content .ui-state-highlight, .ui-datepicker-week-end .ui-state-highlight{
					background-color: rgb(219, 247, 197);
					font-weight: bold;
				}
				.ui-tabs .ui-tabs-active a, .ui-tabs .ui-tabs-active a:hover {
				  background-color: rgb(39,170,225);
				}
				.finan_banco th{
					background-color:rgb(232, 165, 42);
					color:white;
					font-size:16px;
					padding:5px;
				}
				.finan_banco th:first-child{
					border-top-left-radius:0.5em;
					-moz-border-top-left-radius:0.5em;
					-webkit-border-top-left-radius:0.5em;
				}
				.finan_banco th:last-child{
					border-top-right-radius:0.5em;
					-moz-border-top-right-radius:0.5em;
					-webkit-border-top-right-radius:0.5em;
				}
				.finan_banco td{
					padding-left:4px;
					padding-right:4px;
					background-color:rgb(218, 218, 218);
				}
				.sin_nada td{
					border:0xp solid black;
				}
				
				li{
					font-size:12px;
					margin-left: 10px; margin-right: 10px;
				}
				#contenedor_financiero > div{
					font-size:13px;
				}
				.cartera td,.cartera th{
					font-size:12px;
				}
			</style>
			<script>
				$(document).ready(function() {
					
									
				});
			</script>
			
		</head>
		<body class = 'scroll'>
			<span id = "codigo_usuario" class = 'hidde'><?php echo $_SESSION["codigo_usuario"]; ?></span>
			<span id = "codigo_emp" class = 'hidde'><?php echo $_SESSION["cod_empresa"]; ?></span>
			<div id="spinner" class="spinner" style="display:none;">
				<img id="img-spinner" src="../images/spinner.gif" alt="Cargando..."/>
			</div>
			
			<?php include('cabecera.php'); echo $imprimir;?>
			
			<!-- 
				
			-->
			<div id = "cuerpo_pagina" >
				<table class = 'tabla_nuevos_datos2' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td>
							<p>Seleccione una empresa:</p>
							<select id = 'empresa_financiero'>
								<?php
									echo "<option value = '0'>[SELECCIONE]</option>";
									$consulta = "SELECT e.nombre_comercial_empresa, e.cod_interno_empresa 
									from empresa e, pusuemp p
										where e.cod_interno_empresa = p.cod_empresa and p.cod_usuario = '$usuario_actual' order by e.nombre_comercial_empresa asc;";
									$result = mysql_query($consulta);
									while($row = mysql_fetch_array($result)){
										echo "<option value=".$row['cod_interno_empresa'].">".utf8_encode($row['nombre_comercial_empresa'])."</option>";
									}
								?>
							</select>
						</td>
						<td style = 'padding-left:20px;'>
							<p>Seleccione una unidad de negocio:</p>
							<select id = 'und_financiera'>
								
							</select>
						</td>
						<td style = 'padding-left:20px;vertical-align:middle;'>
							<img src = '../images/iconos/lupa_naranja.png' class = 'iconos_opciones' onclick = 'generar_cuadros_financieros()'/>
						</td>
					</tr>
				</table>
				<div width = '100%' style = 'overflow:scroll;height:700px;background-color:white;' id = 'contenedor_principal'>
					
				</div>
			</div>
			<div id = 'contenedor_financiero' class = 'ventana' style = 'font-size:12px;'>
				<!--<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td width = '96%' align = 'left'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>
										<?php echo $emp->mostrar_logo_empresa($gestion->mostrar_empresa_empleado()); ?>
									</td>
								</tr>
								<tr>
									<td align = 'left' >
										<span class = 'mensaje_bienvenida' >REPORTES FINANCIERO</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right' >
							<table width = '100%'>
								<tr>
									<td align = 'center'>
										<img onclick = '$("#contenedor_financiero").dialog("close");$(".scroll").css({"overflow-y":"scroll"});' src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano' />
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				-->
				<?php
					$finan = new financiera();
					$emple = new empleado();
				?>
				<div id="tabsx" style = 'width:100%;'>
					
					<div >
						<?php
							//echo $finan->estructura_consolidado_digital();
							//echo $finan->estructura_consolidado_atl();
							//echo $finan->estructura_consolidado_btl();
							
						?>
					</div>
					<div >
						<?php
							//echo $finan->cartera_general();
						?>
					</div>
					<div >
						<?php
							//echo $finan->cuentas_por_cobrar();
						?>
					</div>
					<div >
						<?php
							//echo $finan->ppto_vs_ejecutado();
						?>
					</div>
					<div >
						<?php
							//echo $finan->personal_down("2016-1",3,7,$emple);
							//echo $finan->personal_down("2015-12",2,1,$emple);
						?>
					</div>
					<?php
						
						//$finan->div_costos_list_empleados(7,$emple,3);
						//$finan->div_costos_list_empleados(1,$emple,2);
					?>
					</ul>
				</div>
			</div>
		</body>
	</html>