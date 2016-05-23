<?php
	include("../Controller/Conexion.php");
	require("../Modelo/gestion_cabecera.php");
	require("../Modelo/Empresa.php");
	session_start();
	$emp =  new Empresa();
	$gestion = new cabecera_pagina();
	
	$user = $_SESSION['codigo_usuario'];
	//$user = 94;
?>

<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>:: PROCESS + ::</title>
			<meta charset="utf-8" />
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			
			<link rel="stylesheet" href="../css/jquery-ui.css">
			
			
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="../css_jquery/css_logeo.js"></script>
			<script type="text/javascript" src="../js/gestion.js"></script>
			<script type="text/javascript" src="../js/gestion_empresa.js"></script>
			<script type="text/javascript" src="../js/gestion2.js"></script>
			<script type="text/javascript" src="../js/produccion2.js"></script>
			<script type="text/javascript" src="../js/resize.js"></script>
			<link type="text/css" href="gestion_final.css" rel="stylesheet" />
			
			<link type="text/css" href="../css/cabecera.css" rel="stylesheet" />
			<link type="text/css" href="../css/tablas.css" rel="stylesheet" />
			<link type="text/css" href="../css/trafico.css" rel="stylesheet" />
			
			<script type="text/javascript" src="../js/ppto_pro.js"></script>
			<script type="text/javascript" src="../js/ppto_produccion.js"></script>
			<!--<script type="text/javascript" src="../js/jquery-confirm.js"></script>-->
			
			<style >
				#v_generar_op,#ventana_asoc_items,#ventana_anticipos,#ventana_ordenes,#anticipos_ventana,#ventana_versiones,#comentarios_ppto{
					background-color:#E3E3E3;
					border-radius:0.5em;
					-moz-border-radius:0.5em;
					-webkit-border-radius:0.5em;
				}
				#visual_ppto_version,#visual_ppto{
					background-color:white;
					border-radius:0.5em;
					-moz-border-radius:0.5em;
					-webkit-border-radius:0.5em;
				}
				.estilos_barra td:nth-child(4){
					background-color:#EF8C14;
				}
				
				.redondo{
					background: radial-gradient( 5px -9px, circle, white 8%, red 26px );
					background-color: #FF8F47;
					border-radius: 100px; /* one half of ( (border * 2) + height + padding ) */
					box-shadow: 1px 1px 1px black;
					color: white;
					height: 200px; 
					width: 200px;
					padding: 4px 3px 0 3px;
					text-align: center;
				}
				.triangulo_sup {
				    width: 0;
				    height: 0;
				    border-left: 20px solid transparent;
				    border-right: 20px solid transparent;
				    border-bottom: 15px solid #EF8C14;;
				}
				.triangulo_inf {
				    width: 0;
				    height: 0;
				    border-left: 20px solid transparent;
				    border-right: 20px solid transparent;
				    border-top: 15px solid #EF8C14;;
				}
				img,.botones_opciones span,#ingresar_nuevo_documento,.botton_verde,#mostrar_all_usuarios,
				#mostrar_all_empleados{
					cursor:pointer;
				}
				#contenedor_ppto_x{
					height:440px;
					width:100%;
					overflow-y:scroll;
					overflow-x:scroll;
				}
				#contenedor_resumen_ppto{
					height:230px;
					width:100%;
					overflow:scroll;
				}
				#tabla_mayor_ppto td{
					font-size:0.95em;
				}
				.totales_ppto{
					border:0px;
					padding-left:10px;
					background-color:#FF8F41;
				}
				@media (min-width:700px){
					#tabla_mayor_ppto th{
						font-size:12px;
					}
					#tabla_mayor_ppto td{
						font-size:11px;
					}
				}
				@media (max-width:1000px){
					#tabla_mayor_ppto th{
						font-size:12px;
					}
					#tabla_mayor_ppto td{
						font-size:10px;
					}
				}
				a:focus img {
				  border: 1px solid red;
				  border-radius: 0.3em;
				}
				#contenedor_items_proveedor{
					border-radius:0.3em;
					-moz-border-radius:0.3em;
					-webkit-border-radius:0.3em;
				}
				
				.tablas_muestra_datos_tablaspro th{
					background-color:white;
					font-weight:bold;
					padding:5px;
				}
				.tablas_muestra_datos_tablaspro th:first-child{
					border-top-left-radius:0.3em;
					-moz-border-top-left-radius:0.3em;
					-webkit-border-top-left-radius:0.3em;
				}
				.tablas_muestra_datos_tablaspro th:last-child{
					border-top-right-radius:1em;
					-moz-border-top-right-radius:0.3em;
					-webkit-border-top-right-radius:0.3em;
				}
				.tablas_muestra_datos_tablaspro td{
					border:1px solid black;
					font-size:12px;
				}
				
				td{
					font-size:12px;
				}
				.dil{
					background-color:#88B4F5;
				}
				.th_principal{
					font-size:14px;
					border-radius:1em;
					color:white;
					-webkit-border-radius:1em;
					-moz-border-radius:1em;
				}
				.border_table{
					border:1px solid white;
				}
				.ext{
					background-color:#EF8B8B;
				}
				input,select,textarea{
					padding:5px;
					border-radius:0.3em;
					border:1px solid white;
					-webkit-border-radius:0.3em;
					-moz-border-radius:0.3em;
				}
				
				.resultados{
					border-bottom-left-radius:1em;
					border-bottom-right-radius:1em;
					
					-webkit-border-bottom-left-radius:1em;
					-webkit-border-bottom-right-radius:1em;
					
					-moz-border-bottom-left-radius:1em;
					-moz-border-bottom-right-radius:1em;
				}
				.campos{
					background-color:#D0DEF4;
				}
				.campos2{
					background-color:#D0DEF4;
				}
				.asoc{
					background-color:#D6E8BC;
				}
				.concepto{
					background-color:#E6E7E9;
					border-radius:0.3em;
					-webkit-border-radius:0.3em;
					-moz-border-radius:0.3em;
					font-weight:bold;
					color:#666666;
					padding-left:10px;
					padding:5px;
				}
				.concepto2{
					background-color:#F2F2F2;
					font-weight:bold;
					color:#666666;
					padding-left:10px;
					padding:5px;
				}
				
				th{
					font-size:14px;
				}
				.subtotal{
					background-color:rgb(219, 219, 219);
				}
				.fondo_td{
					background-color:#EDEDED;
				}
				.tabla_info th{
					border:1px solid black;
					text-align:center;
				}
				.tabla_info td{
					border:1px solid black;
					padding-left:5px;
					padding-right:5px;
				}
				.titulo_ppto{
					font-weight:bold;
					font-size:14px;
				}
			</style>
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
			<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		</head>
		<body class = 'scroll'>
			<span id = 'user_html' class = 'hidde'><?php echo $_SESSION['codigo_usuario'];?></span>
			<span id = 'num_ppto' class = 'hidde'></span>
			<span id = 'id_aprohisto' class = 'hidde'></span>
			<span id = 'vc_ppto' class = 'hidde'></span>
			<span id = 'vi_ppto' class = 'hidde'></span>
			
			
			<div class = 'ventana' id = 'modulo_aprobaciones'>
				<?php include("estructura_mod_aprobaciones.php");?>
			</div>
			
			<div class = 'ventana' id = 'visual_ppto'>
			
			</div>
			
			
			<?php
				
				$sql = mysql_query("select p.referencia, p.codigo_presup,p.vi,p.vc,histo.id,histo.up_bottom
				from pendientes_aprobacion pen, apropresup_histo histo, cabpresup p
				where pen.user = '$user'  and pen.pk_id = histo.id and pen.estado ='1'
				and histo.ppto = p.codigo_presup");
				
				$ppto = 0;
				$vi = 0;
				$up_bottom = 0;
				$vc = 0;
				while($row = mysql_fetch_array($sql)){
					$ppto = $row['codigo_presup'];
					$vi = $row['vi'];
					$vc = $row['vc'];
					$id = $row['id'];
					$up_bottom = $row['up_bottom'];
				}
				
			?>
			
			<div id = 'comentarios_ppto' style = 'display:none;'>
				
				<table width = '100%' style = 'padding-left:25px;padding-right:25px;'>
					<tr>
						<th width = '96%' align = 'left'>Versiones de Ppto</th>
						<td>
							<img  src = '../images/iconos/icon-19.png' width = '50px' onclick = 'cerrar_ventana_abierta(comentarios_ppto)'/>
						</td>
					</tr>
					<tr>
						<td>
							<p>Por favor ingrese los comentarios correspondientes:</p>
						</td>
					</tr>
				</table>
				<table width = '100%'  style = 'padding-left:25px;padding-right:25px;'>
					<tr>
						<td>
							<textarea style = 'width:100%;height:260px;' id = 'comentarios_ppto_text'></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr>
						<td>
							<span class = 'botton_verde'  onclick = 'no_aprobar_ppto_text()'>GUARDAR</span>
						</td>
					</tr>
				</table>
			</div>
		</body>
	</html>