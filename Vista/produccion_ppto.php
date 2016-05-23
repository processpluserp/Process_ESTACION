<?php
	require("../Controller/Conexion.php");
	require("../Modelo/gestion_cabecera.php");
	require("../Modelo/ppto_produccion.php");
	require("../Modelo/Empresa.php");
	
	session_start();
	//include("estructura_ppto.php");
	$ppto = new ppto_produccion();
	$emp =new Empresa();
	$gestion = new cabecera_pagina();
	$num_ppto = $_SESSION["num_ppto"];
	$nombre_cliente = "";
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
			
			
			<style >
				#v_generar_op,#ventana_asoc_items,#ventana_anticipos,#ventana_ordenes,#anticipos_ventana,#ventana_versiones,#comentarios_ppto,#ventana_form_op,#ventana_observaciones_bloqueo_ppto,#ventana_facturas_anticipos,#form_legalizacion{
					background-color:#E3E3E3;
					border-radius:0.5em;
					-moz-border-radius:0.5em;
					-webkit-border-radius:0.5em;
				}
				
				.links_documentos:link,.links_documentos:visited,.links_documentos:hover,.links_documentos:active{color:black;}
				#visual_ppto_version,#ventana_legalizacion{
					background-color:white;
					border-radius:0.5em;
					-moz-border-radius:0.5em;
					-webkit-border-radius:0.5em;
				}
				.estilos_barra td:nth-child(4){
					background-color:#EF8C14;
				}
				.triangulo_sup {
				    width: 0;
				    height: 0;
				    border-left: 20px solid transparent;
				    border-right: 20px solid transparent;
				    border-bottom: 15px solid #F9F9F9;
				}
				.triangulo_inf {
				    width: 0;
				    height: 0;
				    border-left: 20px solid transparent;
				    border-right: 20px solid transparent;
				    border-top: 15px solid #F9F9F9;
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
				.resaltados{
					background-color:#FCEFA1;
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
					color:white;
					padding:5px;
					border-top-left-radius:1em;
					-webkit-border-top-left-radius:1em;
					-moz-border-top-left-radius:1em;
					
					border-top-right-radius:1em;
					-webkit-border-top-right-radius:1em;
					-moz-border-top-right-radius:1em;
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
				.dimension_tabla{
					width:120px;
				}
				.dimension_tabla_opciones{
					width:150px;
					
				}
				
			</style>
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
			<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		</head>
		<body class = 'scroll'>
			<span class = 'hidde' id = 'por_real_utlidad'></span>
			<div id = 'ventana_versiones' class ='ventana_gris'>
				
			</div>
			<div id = 'visual_ppto_version'>
				
			</div>
			<div id = 'form_legalizacion' >
				
			</div>
			
			<div class = 'ventana' id = 'oculto' >
				<div id="spinner2" class="spinner" style="display:none;">
					<img id="img-spinner" src="../images/spinner.gif" alt="Cargando..."/>
				</div>
			</div>
			
			
			<div id="spinner" class="spinner" style="display:none;">
				<img id="img-spinner" src="../images/spinner.gif" alt="Cargando..."/>
			</div>
			
			<span id = "codigo_usuario" class = 'hidde'><?php echo $_SESSION['codigo_usuario']; ?></span>
			<span id = "codigo_ppto" class = 'hidde'><?php echo  $_SESSION['num_ppto']; ?></span>
			
			<div id = 'ventana_visual_ordenes' class = 'ventana' style = 'padding-left:50px;padding-right:50px;'>
			
			</div>
				
			
			<div id = 'ventana_ordenes' class = 'ventana'  style = 'padding-left:50px;padding-right:50px;'>
				<table width = '100%' class = 'tabla_ventana_ordenes' style = 'display:none;'>
					<tr>
						<td width = '96%' align = 'left'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>
										<?php echo $emp->mostrar_logo_empresa($gestion->mostrar_empresa_empleado()); 
										?>
									</td>
								</tr>
								<tr>
									<td align = 'left' >
										<span class = 'mensaje_bienvenida' >HISTORICO ORDENES</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right' >
							<img onclick = '$("#ventana_ordenes").dialog("close");$(".scroll").css({"overflow-y":"scroll"});' src = '../images/iconos/icon-19.png' class = 'iconos_opciones mano' />
						</td>
					</tr>
				</table>
				</br>
				<table >
					<tr>
						<td>
							<select id = 'buscador_histo_ordenes' class = 'entradas_bordes'>
								<option value = 'PROV'>PROVEEDOR</option>
								<option value = 'OP' selected>ORDEN DE PRODUCCIÓN</option>
								<option value = 'OC'>ORDEN DE COMPRA</option>
							</select>
						</td>
						<td>
							<input type = 'number' min = '1' max = '10000000' class = 'entradas_bordes' id = 'ordenes_histo'/>
						</td>
						<td>
							<img src = '../images/iconos/lupa_naranja.png' width = '45px' onclick = 'buscar_info_histo_ordenes();'/>
						</td>
					</tr>
				</table>
				<div id = 'contenedor_list_ordenes'>
					
				</div>
			</div>
			
			<?php
				require("estructura_ppto_produccion.php");
				require("cabecera_ppto.php");
				require("cuerpo_ppto.php");
				require("footer_ppto.php");
			?>
			
			<div class = 'ventana' id = 'ventana_form_op'>
			
			</div>
			<div class = 'ventana' id = 'ventana_legalizacion'>
			
			</div>
			<div  id = 'ventana_observaciones_bloqueo_ppto'>
			
			</div>
			
			<div  id = 'ventana_facturas_anticipos' >
			
			</div>
			
			<div id = 'comentarios_ppto'>
				
				<table width = '100%' style = 'padding-left:25px;padding-right:25px;'>
					<tr>
						<th width = '96%' align = 'left'>Comentarios Ppto</th>
						<td>
							<img  src = '../images/iconos/icon-19.png' width = '50px' onclick = '$("#comentarios_ppto").dialog("close");$("#comentarios_ppto_text").val();'/>
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
							<span class = 'botton_verde' <?php echo "onclick = 'enviar_aprobacion_ppto_text()'"; ?> >GUARDAR</span>
						</td>
					</tr>
				</table>
			</div>
	
	</body>
	</html>