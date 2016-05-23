<?php
	require("../Controller/Conexion.php");
	require("../Modelo/gestion_cabecera.php");
	require("../Modelo/ppto_produccion.php");
	require("../Modelo/Empresa.php");
	session_start();
	if($_SESSION["codigo_usuario"] == ""){
		header("location:../logeo.php");
	}
	
	//include("estructura_ppto.php");
	$ppto = new ppto_produccion();
	$emp =new Empresa();
	$gestion = new cabecera_pagina();
	$codigo_usuario_real = $_SESSION["codigo_usuario"];
	$empresa_final = $gestion->mostrar_empresa_empleado();
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
			
			<script type="text/javascript" src="../js/ppto_produccion.js"></script>
			<style >
				#v_generar_op,#ventana_asoc_items,#ventana_anticipos{
					background-color:#E3E3E3;
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
					border-top-right-radius:0.3em;
					-moz-border-top-right-radius:0.3em;
					-webkit-border-top-right-radius:0.3em;
				}
				.tablas_muestra_datos_tablaspro td{
					border:1px solid black;
				}
			</style>
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
			<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		</head>
		<body class = 'scroll'>
			
			<span id = "periodo_nomina_seleccionado" class = "hidde"></span>
			
			<?php include('cabecera.php'); echo $imprimir;?>
			
			<span id = "codigo_usuario" class = 'hidde'><?php echo $_SESSION["codigo_usuario"]; ?></span>
			<span id = "codigo_ppto" class = 'hidde'><?php echo $_SESSION["num_ppto"]; ?></span>
			<div id="spinner" class="spinner" style="display:none;">
				<img id="img-spinner" src="../images/spinner.gif" alt="Cargando..."/>
			</div>
			
			<div id = 'ventana_anticipos' class = 'ventana'>
				<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td width = '96%' align = 'left'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>
										<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
									</td>
								</tr>
								<tr>
									<td align = 'left' >
										<span class = 'mensaje_bienvenida'>ANTICIPOS</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right'>
							<img id = "cerrar_ventana_ant" src = "../images/iconos/icon-19.png" class = 'iconos_opciones'/>
						</td>
					</tr>
				</table>
				<table width = '100%' class = 'tabla_nuevos_datos2' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td>
							<p>Seleccione los siguientes datos para la realización de un Anticipo:</p>
						</td>
					</tr>
				</table>
			</div>
			
			
			<div id = 'ventana_asoc_items' class = 'ventana'>
				<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td width = '96%' align = 'left'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>
										<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
									</td>
								</tr>
								<tr>
									<td align = 'left' >
										<span class = 'mensaje_bienvenida'>Asociación Items</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right'>
							<img id = "cerrar_ventana_asoc" src = "../images/iconos/icon-19.png" class = 'iconos_opciones'/>
						</td>
					</tr>
				</table>
				
				<div id = 'contenedor_asociaciones' style = 'padding-left:50px;padding-right:50px;'>
					
				</div>
			</div>
			
			<div id = "v_generar_op" class = 'ventana'>
				<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td width = '96%' align = 'left'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>
										<?php echo $emp->mostrar_logo_empresa($empresa_final); ?>
									</td>
								</tr>
								<tr>
									<td align = 'left' >
										<span class = 'mensaje_bienvenida'>GENERAR ORDEN</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right'>
							<img id = "cerrar_ventana_informacion_basica" src = "../images/iconos/icon-19.png" class = 'iconos_opciones'/>
						</td>
					</tr>
				</table>
				</br>
				<table width = '100%' class = 'tabla_nuevos_datos2' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td colspan = '2'>
							<p>Seleccione un Proveedor:</p>
							<select id = 'listado_proveedores' style = 'width:auto;'></select>
						</td>
					</tr>
					<tr><td></td></tr>
					<tr>
						<td colspan = '2'>
							<div id = 'contenedor_items_proveedor' style = 'overflow:scroll;width:100%;height:250px;border:1px solid black;'></div>
						</td>
					</tr>
					<tr>
						<td>
							<p>Fecha Entrega:</p>
							<input type = 'text' id = 'fecha_entrega_op'/>
						</td>
						<td>
							<p>Fecha Radicación Orden:</p>
							<input type = 'text' id = 'fecha_radicacion_op'/>
						</td>
					</tr>
					<tr>
						<td>
							<p>Vigencia Inicial Orden:</p>
							<input type = 'text' id = 'vigencia_inicial_op'/>
						</td>
						<td>
							<p>Vigencia Final Orden:</p>
							<input type = 'text' id = 'vigencia_final_op'/>
						</td>
					</tr>
					<tr>
						<td>
							<p>Nota OP:</p>
							<textarea id = 'nota_op' cols = '30'>
							
							</textarea>
						</td>
						<td style = 'vertical-align:top;'>
							<p>Forma de Pago:</p>
							<select id = 'fpago'>
								<?php
									$sql = mysql_query("select codigo_interno,name_forma_pago from fpago");
									$imp = "<option value = '0'>[SELECCIONE]</option>";
									while($row = mysql_fetch_array($sql)){
										$imp.="<option value ='".$row['codigo_interno']."'>".$row['name_forma_pago']."</option>";
									}
									echo $imp;
								?>
							</select>
						</td>
					</tr>
					<tr><td></br></td></tr>
					<tr>
						<td align = 'center' colspan = '2'>
							<span id = 'bttn_generar_op' class ='botton_verde'>Generar OP</span>
						</td>
					</tr>
				</table>
				<div class = "scroll_nueva_ventana">
					</br>
					
				</div>
			</div>
			<div id = "cuerpo_pagina">
				
				
				
				<table >
					<tr>
						<td>
							<img src = '../images/iconos/iconos-43.png' class = 'iconos_opciones' id = 'modificar_ppto_botton' title = 'Modificar Ppto'/>
							<!--<span id = 'generar_oC' class = 'mostrar_datos'>MODIFICAR ENCABEZADO</span>-->
						</td>
						<td>
							<img src = '../images/iconos/iconos-44.png' class = 'iconos_opciones' id = 'generar_op' title = 'Generar Orden'/>
						</td>
						<td>
							<img src = '../images/iconos/iconos-45.png' class = 'iconos_opciones' id = 'generar_op' title = 'Consultar Ordenes'/>
						</td>
						<td>
							<img src = '../images/iconos/iconos-45.png' class = 'iconos_opciones' id = 'generar_ant' title = 'Generar Anticipo'/>
						</td>
						<td>
							<img src = '../images/iconos/iconos-45.png' class = 'iconos_opciones' id = 'asoc_items_ppto' title = 'Asociar Items'/>
						</td>
						<td>
							<?php
								if($_SESSION['perfil'] == 8 || $_SESSION['perfil'] == 1){
									echo "<a target = '_blank' href = 'pdf_ppto.php?ppto=".$_SESSION["num_ppto"]."'>
										<img src = '../images/iconos/iconos-42.png' class = 'iconos_opciones' id = 'generar_cliente' title = 'Imprimir PPto Cliente'/>
									</a>";
								}
							?>
							<!--<a target = '_blank' <?php echo "href = 'pdf_ppto.php?ppto=".$_SESSION["num_ppto"]."'";?>>
								
							</a>-->
						</td>
						<td align = 'right' width = '4%'>
							<table >
								<tr>
									<td>Regresar</td>
									<td>
										<?php
											echo "<a class = 'links_barra_ubicacion' href = 'produccion.php'>
												<img src = '../images/iconos/icon-16.png' width = '45px' height = '45px'/>
											</a>";
										?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<div id = "contenedor_informacion_ppto">
					<?php
						$ppto->estructura($_SESSION['num_ppto']);
					?>
				</div>				
			</div>
			<!--Formulario modificar Item
			<div id = "modificar_item"  title = "MODIFICAR ITEM">
				<div title = "MODIFICAR ITEM">
					<table id = "n_item2">
						<tr>
							<p>CELULA</p>
							<?php echo $celulas2; ?>
						</tr>
						<tr>
							<td class = "encabezado">
								<p>ITEM</p>
								<input type = "text" name = "item2" id = "item2" />
							</td>
							<td class = "encabezado">
								<p>DESCRIPCIÓN</p>
								<textarea rows = "4" cols = "10" name = "descripcion2" id = "descripcion2" style="margin: 0px; width: 360px; height: 70px;">
								</textarea>
							</td>
						</tr>
						<tr>
							<td class = "encabezado">
								<p>PROVEEDOR</p>
								<select name = "proveedor2" id = "proveedor2">
									<option>[SELECCIONE UN PROVEEDOR]</option>
										 <?php echo $proveedor; ?>
								</select>
							</td>
							<td class = "encabezado">
								<table>
									<tr>
										<td class = "encabezado">
											<p>CANTIDAD</p>
											<input type = "text" name = "cantidad2" id = "cantidad2" class = "val"/>
										</td>
										<td class = "encabezado">
											<p>DÍAS</p>
											<input type = "text" name = "dias2" id = "dias2" class = "val"/>
										</td>
									</tr>
								</table>
							</td>
							<tr>
								<center><table ID = "tbl_interna">
									<tr>
										<th colspan = "2" class = "encabezado">ANTICIPOS</th>
										<th class = "encabezado">VALOR COTIZACION</th>
										<th class = "encabezado">NEGOCIACION</th>
										<th class = "encabezado">VALOR VENTA</th>
										<th class = "encabezado">COMISION VENTA</th>
									</tr>
									<tr>
										<td class = "encabezado">
											<p>%</p>
											<input type = "text" name = "por_anticipo2" id = "por_anticipo2" class = "val"/>
										</td>
										<td class = "encabezado">
											<p>Fecha Anticipo</p>
											<input type="text" id="fecha_anticipo2" name="fecha_anticipo2" class="{required:true,maxlength:80} span3"/>
										</td>
										
										<td class = "encabezado">
											<p>UNITARIO</p>
											<input type = "text" name = "vcotizacion2" id = "vcotizacion2" class = "val"/>
										</td>
										
										<td class = "encabezado">
											<p>%</p>
											<input type = "text" name = "nego2" id = "nego2" class = "val"/>
										</td>
										
										<td class = "encabezado">
											<p>UNITARIO</p>
											<input type = "text" name = "vventa2" id = "vventa2" class = "val"/>
										</td>
										
										<td class = "encabezado">
											<p>%</p>
											<input type = "text" name = "cventa2" id = "cventa2" class = "val"/>
										</td>
									</tr>
								</table></center>
							</tr>
						</tr>
					</table>
					<button id = "agregar_concepto2" onclick = "modificar_celda_celula()">Modificar Concepto</button>
				</div>
			</div>
			-->
			<!--Formulario add celula 
			<div id = "add_celula" class = "hide" title =  "CELULA NUEVA">
				<p>Nombre Celula</p>
				<input name = "celula" id = "celula" type = "text" />
				<button id = "celula_add" >+</button>
			</div>
			-->
			<!--Formulario add Item
			<div id = "add_item"  title = "ITEM NUEVO">
				<div title = "Agregar Item">
					<table id = "n_item">
						<tr>
							<p>CELULA</p>
							<?php echo $celulas; ?>
						</tr>
						<tr>
							<td class = "encabezado">
								<p>ITEM</p>
								<input type = "text" name = "item" id = "item" />
							</td>
							<td class = "encabezado">
								<p>DESCRIPCIÓN</p>
								<textarea rows = "4" cols = "10" name = "descripcion" id = "descripcion" style="margin: 0px; width: 360px; height: 70px;">
								</textarea>
							</td>
						</tr>
						<tr>
							<td class = "encabezado">
								<p>PROVEEDOR</p>
								<select name = "proveedor" id = "proveedor">
									<option>[SELECCIONE UN PROVEEDOR]</option>
										 <?php echo $proveedor; ?>
								</select>
							</td>
							<td class = "encabezado">
								<table>
									<tr>
										<td class = "encabezado">
											<p>CANTIDAD</p>
											<input type = "text" name = "cantidad" id = "cantidad" class = "val"/>
										</td>
										<td class = "encabezado">
											<p>DÍAS</p>
											<input type = "text" name = "dias" id = "dias" class = "val"/>
										</td>
									</tr>
								</table>
							</td>
							<tr>
								<center><table ID = "tbl_interna">
									<tr>
										<th colspan = "2" class = "encabezado">ANTICIPOS</th>
										<th class = "encabezado">VALOR COTIZACION</th>
										<th class = "encabezado">NEGOCIACION</th>
										<th class = "encabezado">VALOR VENTA</th>
										<th class = "encabezado">COMISION VENTA</th>
									</tr>
									<tr>
										<td class = "encabezado">
											<p>%</p>
											<input type = "text" name = "por_anticipo" id = "por_anticipo" class = "val"/>
										</td>
										<td class = "encabezado">
											<p>Fecha Anticipo</p>
											<input type="text" id="fecha_anticipo" name="fecha_anticipo" class="{required:true,maxlength:80} span3"/>
										</td>
										
										<td class = "encabezado">
											<p>UNITARIO</p>
											<input type = "text" name = "vcotizacion" id = "vcotizacion" class = "val"/>
										</td>
										
										<td class = "encabezado">
											<p>%</p>
											<input type = "text" name = "nego" id = "nego" class = "val"/>
										</td>
										
										<td class = "encabezado">
											<p>UNITARIO</p>
											<input type = "text" name = "vventa" id = "vventa" class = "val"/>
										</td>
										
										<td class = "encabezado">
											<p>%</p>
											<input type = "text" name = "cventa" id = "cventa" class = "val"/>
										</td>
									</tr>
								</table></center>
							</tr>
						</tr>
					</table>
					<button id = "agregar_concepto" >Concepto</button>
					<button id = "cancelar_concepto">Cerrar</button>
				</div>
			</div>
		
			
			<div id = "contenedor_principal_gestion">
				<div id = "bh_ppto">
					<table>
						<tr>
							<td><button id = "nueva_celda">+ Celda</button></td>
							<td><button id = "nuevo_item">+ Item</button></td>
							<td><button id = "vinterno">Interno</button></td>
							<td><button id = "vexterno">Externo</button></td>
							<td><button id = "cerrar_ppto">Cerrar</button></td>
							
						</tr>
					</table>
				</div>
				
				<div id ="contenedor_ppto">
					<table id = "ppto_interno">
						<tr>
							<th colspan  = '60' class = "titulo_ppto_interno" style = "background-color: #C4B5A2;">
								<p>PRESUPUESTO INTERNO</p>
							</th>
							<th></th>
							<th></th>
							<th></th>
							<th colspan  = '2' class = "titulo_ppto_interno" style = "background-color: #C4B5A2;">
								<p>PRESUPUESTO EXTERNO</p>
							</th>
						</tr>
						<tr>
							<td></td>
							<td COLSPAN = "30"></td>
							<td></td>
							<td></td>
							<td></td>
							<td class = "espacios"></td>
							<td class = "espacios"></td>
							<td class = "t" colspan = "3" style = "background-color: #F1DCDC;"><strong>ANTICIPO</strong></td>
							<td class = "espacios"></td>
							<td class = "espacios"></td>
							<td class = "t" COLSPAN = "2" style = "background-color: #D37CEB;"><strong>VALOR COMPRA</strong></td>
							<td class = "espacios"></td>
							<td class = "t" COLSPAN = "2" style = "background-color: #FA65C3;"><strong>VALOR COTIZACION</strong></td>
							<td class = "espacios"></td>
							<td class = "t" COLSPAN = "2" style = "background-color: #E8C8DC;"><strong>NEGOCIACION</strong></td>
							<td class = "espacios"></td>
							<td class = "t" COLSPAN = "2" style = "background-color: #C8F3DB;"><strong>VALOR VENTA</strong></td>
							<td class = "espacios"></td>
							<td class = "t" COLSPAN = "2" style = "background-color: #E8C8DC;"><strong>COMISION VENTA</strong></td>
							<td class = "espacios"></td>
							<td class = "espacios"></td>
							<td class = "t" COLSPAN = "2" style = "background-color: #F2B449;">TOTAL COMISIONES</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class = "t" COLSPAN ="2">TOTAL CLIENTE</td>
						</tr>
						<tr>
							<td class = "encabezado" style = "background-color: #C4B5A2;"><strong>ITEM</strong></td>
							<td class = "encabezado" style = "background-color: #C4B5A2;" COLSPAN = "30"><strong>DESCRIPCIÓN</strong></td>
							<td class = "encabezado" style = "background-color: #C4B5A2;"><strong>PROVEEDOR</strong></td>
							<td class = "encabezado" style = "background-color: #C4B5A2;"><strong>CANT</strong></td>
							<td class = "encabezado" style = "background-color: #C4B5A2;"><strong>DÍAS</strong></td>
							<td class = "espacios"></td>
							<td class = "espacios"></td>
							<td class = "encabezado" style = "background-color: #F1DCDC;"><strong>VALOR</strong></td>
							<td class = "encabezado" style = "background-color: #F1DCDC;"><strong>%</strong></td>
							<td class = "encabezado" style = "background-color: #F1DCDC;"><strong>FECHA ANTICIPO</strong></td>
							<td class = "espacios"></td>
							<td class = "espacios"></td>
							<td class = "encabezado" style = "background-color: #D37CEB;"><strong>UNITARIO</strong></td>
							<td class = "encabezado" style = "background-color: #D37CEB;"><strong>TOTAL</strong></td>
							<td class = "espacios"></td>
							<td class = "encabezado" style = "background-color: #FA65C3;"><strong>UNITARIO</strong></td>
							<td class = "encabezado" style = "background-color: #FA65C3;"><strong>TOTAL</strong></td>
							<td class = "espacios"></td>
							<td class = "encabezado" style = "background-color: #E8C8DC;"><strong>$</strong></td>
							<td class = "encabezado" style = "background-color: #E8C8DC;"><strong>%</strong></td>
							<td class = "espacios"></td>
							<td class = "encabezado" style = "background-color: #C8F3DB;"><strong>UNITARIO</strong></td>
							<td class = "encabezado" style = "background-color: #C8F3DB;"><strong>TOTAL</strong></td>
							<td class = "espacios"></td>
							<td class = "encabezado" style = "background-color: #E8C8DC;"><strong>$</strong></td>
							<td class = "encabezado" style = "background-color: #E8C8DC;"><strong>%</strong></td>
							<td class = "espacios"></td>
							<td class = "espacios"></td>
							<td class = "encabezado" style = "background-color: #F2B449;"><strong>$</strong></td>
							<td class = "encabezado" style = "background-color: #F2B449;"><strong>%</strong></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							
							<td class = "t">VALOR UNIDAD</td>
							<td class = "t">VALOR TOTAL CLIENTE</td>
						</tr>
						<?php
							echo "<div id = 'super_contenedor'>
							".$sub_celulas."
							</div>";
							
						?>
					</table>
				</div>
				
				<div id ="contenedor_cuadritos">
					<table>
						<tr>
							<td>
								<div>
									<table>
										<tr>
											<td>VALORES COMISIONALES</td>
											<td></td>
											<td></td>
											<td>
												<span = id = "vl_o" class = "hide"><?echo ($suma_venta_total);?></span>
												<span = id = "vl"><?echo number_format($suma_venta_total);?></span>
											</td>
										</tr>
										<tr>
											<td>VALORES NO COMISIONALES</td>
											<td></td>
											<td></td>
											<td>
												<span = id = "vnl_o" class = "hide"><?php echo ($suma_no_comisionables); ?></span>
												<span = id = "vnl"><?php echo number_format($suma_no_comisionables); ?></span>
											</td>
										</tr>
										<tr>
											<td>TOTAL COSTOS DE EJECUCION</td>
											<td></td>
											<td></td>
											<td>
												<span = id = "tce_o" class = "hide"><?php echo ($total_costo_ejecuction); ?></span>
												<span = id = "tce"><?php echo number_format($total_costo_ejecuction); ?></span>
											</td>
										</tr>
										<tr>
											<td>IMPREVISTOS</td>
											<td></td>
											<td><input type = "text" id ="imp_p" name = "imp_p" /></td>
											<td>
												<span = id = "t_imp_o" class = "hide"></span>
												<span = id = "t_imp"></span>
											</td>
										</tr>
										<tr>
											<td>GASTOS ADMINISTRATIVOS</td>
											<td></td>
											<td><input type = "text" id ="ga_p" name = "ga_p" /></td>
											<td>
												<span = id = "t_ga_o" class ="hide"></span>
												<span = id = "t_ga"></span>
											</td>
										</tr>
										<tr>
											<td>SERVICIOS DE IMPLEMENTACION ESTRATEGIA Y DESARROLLO</td>
											<td></td>
											<td>UAAI<span id ="uaai_p" name = "uaai_p">
												<?php 
													$clie = $_SESSION['codigo_cliente_ppto'];
													$select = "select uaai,tipo from condiciones_cliente where cliente = '$clie'";
													$r = mysql_query($select);
													$val = 0;
													$operacion = 0;
													$uaai = 0;
													while($row = mysql_fetch_array($r)){
														$val = floatval($row['uaai']);
														$uaai = (100-$val)/100;
														if($row['tipo'] == 1){
															$operacion = $suma_venta_total/$uaai-$suma_venta_total;
														}else{
															$operacion = $uaai*$suma_venta_total;
														}
													}
													echo $uaai;
												?>
											</span>
											<span id ="uaai_p_o" name = "uaai_p_o" class = "hide"><?php echo $uaai; ?></span>
											</td>
											<td>
												<span = id = "t_uaai_o" class = "hide"><?php echo $operacion; ?></span>
												<span = id = "t_uaai"><?php echo number_format($operacion); ?></span>
											</td>
										</tr>
										<tr>
											<td>TOTAL ACTIVIDAD</td>
											<td></td>
											<td></td>
											<td>
												<span = id = "total_actividad_o" class = "hide"></span>
												<span = id = "total_actividad"></span>
											</td>
										</tr>
									</table>
								</div>
							</td>
							<td>
								<div>
									<table>
										<tr>
											<td>TOTAL COMISIONES POR DESCUENTOS</td>
											<td></td>
											<td>
												<span id = "tocpd_o" class = "hide"><?php echo $total_comisiones_descuentos;?></span>
												<span id = "tocpd"><?php echo number_format($total_comisiones_descuentos);?></span>
											</td>
										</tr>
										<tr>
											<td>VALORES NO COMISIONALES</td>
											<td></td>
											<td><span id = "2vnc"><?php echo $suma_no_comisionables; ?></span></td>
										</tr>
										<tr>
											<td>COMISION AGENCIA UAAI</td>
											<td></td>
											<td><span = id = "2t_uaai_o" class = "hide"><?php echo $operacion; ?></span>
												<span = id = "2t_uaai"><?php echo number_format($operacion); ?></span></td>
										</tr>
										<tr>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>UTILIDAD COMERCIAL</td>
											<td></td>
											<td><span = id = "utilidad_comercial_o" class = "hide"></span>
												<span = id = "utilidad_comercial"></span></td>
										</tr>
										<tr></tr>
										<tr></tr>
										<tr>
											<td>VOLUMEN</td>
											<td></td>
											<td>
												<span id = "vol_ppto_o" class ="hide"></span>
												<span id = "vol_ppto" ></span>
											</td>
										</tr>
										<tr>
											<td>UTILIDAD MARGINAL</td>
											<td></td>
											<td>
												<span id = "um_ppto_o" class ="hide"></span>
												<span id = "um_ppto" ></span>
											</td>
										</tr>
									</table>
								</div>
							</td>
							<td>
								<div>
									<table>
										<tr>
											<td >VALOR TOTAL SIN IVA</td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td >
												<span id = "total_actividad2_o" class = "hide"></span>
												<span id = "total_actividad2"></span>
											</td>
										</tr>
										<tr>
											<td>RETENCIÓN EN LA FUENTE</td>
											<td></td>
											<td></td>
											<td>
												<span id = "val_retefuente">
													<?php
														$select = "select refuente from condiciones_cliente where cliente = '$clie'";
														$r = mysql_query($select);
														$valr = 0;
														$operacion = 0;
														while($row = mysql_fetch_array($r)){
															$valr = floatval($row['refuente']);
														}
														echo $valr;
													?>
												</span>
											</td>
											<td></td>
											<td>
												<span id = "valor_retefuente_o" class = "hide"></span>
												<span id = "valor_retefuente"></span>
											</td>
										</tr>
										<tr>
											<td>ICA</td>
											<td></td>
											<td></td>
											<td>
												<span id = "imp_ica">9,66/1000</span>
											</td>
											<td></td>
											<td>
												<span id = "valor_ica_o" class = "hide"></span>
												<span id = "valor_ica"></span>
											</td>
										</tr>
										<tr>
											<td>CREE</td>
											<td></td>
											<td></td>
											<td>
												<span id = "imp_cree">0.8%</span>
											</td>
											<td></td>
											<td>
												<span id = "valor_ica_o" class = "hide"></span>
												<span id = "valor_ica"></span>
											</td>
										</tr>
									</table>
								</div>
							</td>
						</tr>
					</table>
				</div>
			-->
			</div>
				
		</body>
	</html>