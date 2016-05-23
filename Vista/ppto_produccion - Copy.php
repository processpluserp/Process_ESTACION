<?php
	require("../Controller/Conexion.php");
	require("../Modelo/gestion_cabecera.php");
	require("../Modelo/ppto_produccion.php");
	
	if($_SESSION["codigo_usuario"] == ""){
		header("location:../logeo.php");
	}
	
	//include("estructura_ppto.php");
	$ppto = new ppto_produccion();
	$gestion = new cabecera_pagina();
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
			<script type="text/javascript" src="../js/gestion.js"></script>
			<script type="text/javascript" src="../js/gestion_empresa.js"></script>
			<script type="text/javascript" src="../js/gestion2.js"></script>
			<script type="text/javascript" src="../js/produccion2.js"></script>
			<link type="text/css" href="gestion_final.css" rel="stylesheet" />
			<link rel="stylesheet" href="../css/jquery-ui.css">
			
			
			<script type="text/javascript" src="../js/ppto_produccion.js"></script>
			<style >
				.estilos_barra td:nth-child(4){
					background-color:#EF8C14;
				}
				
				img,.botones_opciones span,#ingresar_nuevo_documento,.botton_verde,#mostrar_all_usuarios,
				#mostrar_all_empleados{
					cursor:pointer;
				}
				#contenedor_ppto_x{
					height:460px;
					width:100%;
					overflow-y:scroll;
					overflow-x:scroll;
				}
				#contenedor_resumen_ppto{
					height:260px;
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
			</style>
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
			<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		</head>
		<body>
			
			<span id = "periodo_nomina_seleccionado" class = "hidde"></span>
			
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
							<a href = 'bienvenida.php' class = "actual">
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
							<a href = 'financiera.php'>
								INFORMES
							</a>
						</td>
						<td>
							<a href = 'dashboard.php'>
								CLIENTE
							</a>
						</td>
					</tr>					
				</table>
			</div>
			
			
			<span id = "codigo_usuario" class = 'hidde'><?php echo $_SESSION["codigo_usuario"]; ?></span>
			<span id = "codigo_ppto" class = 'hidde'><?php echo $_SESSION["num_ppto"]; ?></span>
			<div id="spinner" class="spinner" style="display:none;">
				<img id="img-spinner" src="../images/spinner.gif" alt="Cargando..."/>
			</div>
			
			<div id = "v_generar_op" class = 'ventana_ordenes'>
				<div class = "scroll_nueva_ventana">
					<table width = '100%'>
						<tr>
							<th width = '96%' align = 'center'>
								<span class = "titulo_ventana">GENERAR ORDEN DE PRODUCCIÓN</span>
							</th>
							<th align = 'right'>
								<img id = "cerrar_ventana_informacion_basica" src = "../images/icon/icono_cerrar.png" width = '30px' height = '30px'/>
							</th>
						</tr>
					</table>
					</br>
					<table width = '100%'>
						<tr>
							<td colspan = '2'>
								<p>Proveedores</p>
								<select id = 'listado_proveedores'></select>
							</td>
						</tr>
						<tr>
							<td colspan = '2'>
								<div id = 'contenedor_items_proveedor' style = 'overflow:scroll;width:100%;height:200px;border:1px solid black;'></div>
							</td>
						</tr>
						<tr>
							<td>
								<p>Fecha Entrega</p>
								<input type = 'text' id = 'fecha_entrega_op'/>
							</td>
							<td>
								<p>Fecha Radicación Orden</p>
								<input type = 'text' id = 'fecha_radicacion_op'/>
							</td>
						</tr>
						<tr>
							<td>
								<p>Vigencia Inicial Orden</p>
								<input type = 'text' id = 'vigencia_inicial_op'/>
							</td>
							<td>
								<p>Vigencia Final Orden</p>
								<input type = 'text' id = 'vigencia_final_op'/>
							</td>
						</tr>
						<tr>
							<td>
								<p>Nota Op</p>
								<textarea id = 'nota_op' cols = '30'>
								
								</textarea>
							</td>
							<td>
								<p>Forma de Pago</p>
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
				</div>
			</div>
			<div id = "cuerpo_pagina">
				</br>
				<table >
					<tr>
						<td>
							<span id = 'generar_op' class = 'mostrar_datos'>GENERAR OP</span>
						</td>
						<td>
							<span id = 'generar_oc' class = 'mostrar_datos'>GENERAR OC</span>
						</td>
						<td>
							<span id = 'generar_cliente' class = 'mostrar_datos'>GENERAR PPTO CLIENTE</span>
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