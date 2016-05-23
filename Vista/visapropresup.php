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
			<script type="text/javascript" src="../js/ppto_pro.js"></script>
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
					border-top-left-radius:1em;
					border-top-right-radius:1em;
					
					-webkit-border-top-left-radius:1em;
					-webkit-border-top-right-radius:1em;
					
					-moz-border-top-left-radius:1em;
					-moz-border-top-right-radius:1em;
				}
				.border_table{
					border:1px solid black;
				}
				.ext{
					background-color:#EF8B8B;
				}
				input,select,textarea{
					padding:5px;
					border-radius:0.3em;
					border:1px solid black;
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
					background-color:#EAEAEA;
					border-radius:0.3em;
					-webkit-border-radius:0.3em;
					-moz-border-radius:0.3em;
					padding-left:5px;
					font-weight:bold;
				}
				th{
					font-size:14px;
				}
				.subtotal{
					background-color:rgb(219, 219, 219);
				}
			</style>
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
			<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		</head>
		<body class = 'scroll'>			
			<!--<?php include('cabecera.php'); /*echo $imprimir;*/?>-->
			
			<span id = "codigo_usuario" class = 'hidde'><?php echo $_SESSION["codigo_usuario"]; ?></span>
			<span id = "codigo_ppto" class = 'hidde'><?php echo $_SESSION["num_ppto"]; ?></span>
			
			<!--<div id="spinner" class="spinner" style="display:none;">
				<img id="img-spinner" src="../images/spinner.gif" alt="Cargando..."/>
			</div>-->
			
			<div class = 'ventana'>
						
			</div>
			<table width = '100%'>
				<tr>
					<td onclick = 'mostrar_cabecera();' class = 'mano' style = 'font-weight:bold;' colspan = '3'>
						ENCABEZADO
					</td>
					<td align = 'right'  colspan = '5'>
						<table width = '100%' align = 'right'>
							<tr>
								<td align = 'right' style = 'padding-right:70px;font-weight:bold;'>
									<strong>APROBACIÓN DE PPTO</strong>
								</td>
							</tr>
							<tr>
								<td align = 'right'>
									<span class = 'botton_verde'>SI</span>
									<span class = 'botton_verde' style = 'background-color:red;'>NO</span>
								</td>
							</tr>
							<tr><td></br></td></tr>
						</table>		
					</td>
				</tr>
				<?php
					$imprevistos = 0;
					$gastos_administrativos = 0;
					$valor_comision = 0;
					$tipo_comision_ppto = 0;
					$encab = mysql_query("Select e.nombre_comercial_empresa, c.nombre_legal_clientes,p.referencia, p.vigencia_inicial,p.vigencia_final,pr.nombre_producto,p.codigo_presup,p.numero_presupuesto,ot.codigo_ot,tp.nombre,unx.name,
					p.imprevistos,p.gastos_admin, cc.pago,cc.impuestos,cc.refuente,cc.reiva,cc.uaai,cc.tipo
					from cabpresup p, empresa e, clientes c, cabot ot, producto_clientes pr, tipo_cuenta_ppto tp, und unx, condiciones_cliente cc
					where e.cod_interno_empresa = p.empresa_nit_empresa	and c.codigo_interno_cliente = p.pk_clientes_nit_cliente and p.ot = ot.codigo_ot and ot.producto_clientes_codigo_PRC = pr.id_procliente and
					p.codigo_presup = '$num_ppto' and p.tipo = tp.consecutivo and p.ceco = unx.id and p.tipo_comision = cc.consecutivo");
					while($row = mysql_fetch_array($encab)){
						$imprevistos = $row['imprevistos'];
						$gastos_administrativos = $row['gastos_admin'];
						$valor_comision = $row['uaai'];
						$tipo_comision_ppto = $row['tipo'];
						
						echo "<tr class ='encabezado'>
								<td class = 'concepto '>
									No. PPTO INT.
								</td>
								<td>".$row['codigo_presup']."</td>
								
								<td class = 'concepto'>
									REFERENCIA
								</td>
								<td>".$row['referencia']."</td>
								
								<td class = 'concepto'>
									No. Ppto EXT.
								</td>
								<td>".$row['numero_presupuesto']."</td>
								
								<td class = 'concepto'>
									TIPO PPTO
								</td>
								<td>".$row['nombre']."</td>
						</tr>
						<tr class ='encabezado'>
							<td class = 'concepto'>
								EMPRESA
							</td>
							<td>".$row['nombre_comercial_empresa']."</td>
							
							<td class = 'concepto'>
								CLIENTE
							</td>
							<td>".$row['nombre_legal_clientes']."</td>
							
							<td class = 'concepto'>
								PRODUCTO
							</td>
							<td>".$row['nombre_producto']."</td>
							
							<td class = 'concepto'>
								OT
							</td>
							<td>".$row['codigo_ot']."</td>
						</tr>
						<tr class ='encabezado'>
							<td class = 'concepto'>
								VIGENCIA INICIAL
							</td>
							<td>".$row['vigencia_inicial']."</td>
							
							<td class = 'concepto'>
								VIGENCIA FINAL
							</td>
							<td>".$row['vigencia_final']."</td>
							
							<td class = 'concepto'>
								CENTRO DE COSTO
							</td>
							<td>".$row['name']."</td>
							
							<td class = 'concepto'>
								VERSION
							</td>
							<td>".$row['codigo_ot']."</td>
						</tr>
						";
					}
				?>
				
				<tr>
					<td></br></td>
				</tr>
			</table>
			
			<table width = '100%' class = '' style = 'border-collapse: collapse;'>
				<tr>
					<th colspan = '12' class = 'dil th_principal'>INTERNO</th>
					<th></th>
					<th colspan = '2' class = 'ext th_principal'>EXTERNO</th>
					<th></th>
					<th colspan = '2' class = 'dil th_principal'>RENTABILIDAD PARCIAL</th>
				</tr>
				<tr>
					<th class = 'border_table campos2' nowrap>VNC</th>
					<th class = 'border_table campos2' nowrap>GRUPO</th>
					<th class = 'border_table' nowrap>NOMBRE ITEM</th>
					<th class = 'border_table' nowrap>DESCRIPCIÓN</th>
					<th class = 'border_table campos' nowrap>PROVEEDOR</th>
					<th class = 'border_table campos' nowrap>DIAS</th>
					<th class = 'border_table campos' nowrap>CANT.</th>
					<th class = 'border_table campos' nowrap>VALOR</th>				
					<th class = 'border_table subtotal' nowrap>SUBTOTAL</th>
					<th class = 'border_table' nowrap>% IVA</th>
					<th class = 'border_table' nowrap>% VOLUMEN</th>
					<th class = 'border_table' nowrap>COSTO INTERNO</th>
					<th width = '2%'></th>
					<th class = 'border_table' nowrap>$ UNITARIO</th>
					<th class = 'border_table' nowrap>$ TOTAL</th>
					<th width = '2%'></th>
					<th class = 'border_table' align = 'center'>%</th>
					<th class = 'border_table' align = 'center'>$</th>
				</tr>
				<?php
					
					$sql = mysql_query("select name,id from grupo_tarifario where length(name) > 0 order by name asc");
					$grupos = "";
					while($row = mysql_fetch_array($sql)){
						$grupos.="<option value ='".$row['id']."'>".$row['name']."</option>";
					}
					$sql = mysql_query("select p.proveedor,p.dias,p.q,p.descripcion,p.val_item,p.iva_item,p.fecha_ant,p.cliente,p.por_prov,p.id, i.name
					from itempresup p, item_tarifario i
					where p.ppto = '$num_ppto' and i.id = p.pk_item");
					$i = 0;
					while($row = mysql_fetch_array($sql)){
						
						$option = "<option value = '0'>[SELECCIONE]</option>";
						
						echo "<tr>
								<td  nowrap>
									<div>
										<input type = 'checkbox' id = 'grupo$i' name = 'grupo_sel' value = '$i' class = 'radio' readonly/>
										<label for='grupo$i'><span><span></span></span></label>
									</div>
								</td>
								<td class = 'border_table grupos' align = 'center' nowrap>
									<table width = '100%'>
										<tr>
											<td>
												<img src = '../images/iconos/Engra.png'  width = '23px' id = 'add_asoc$i' onclick = 'mostrar_asoc_items($i)'/>
											</td>
											<td>
												<input style = 'width:150px;' id = 'grupo$i' />
											</td>
										</tr>
									</table>
								</td>
								<td class = 'border_table' align = 'justify' style  = 'padding-left:5px;' nowrap>
									".$row['name']."
								</td>
								<td class = 'border_table' align = 'center' style  = 'padding-left:5px;' nowrap>
									".nl2br($row['descripcion'])."
								</td>
								<td class = 'border_table campos proveedores' align = 'center' nowrap>
									<select style = 'width:180px;' id = 'provee$i'>
										$option
									</select>
								</td>
								<td class = 'border_table campos' align = 'center' nowrap>
									<table width = '100%'>
										<tr>
											<td align = 'right' >".$row['dias']."</td>
										</tr>
									</table>
									
									<span id = 'h_dias$i' class = 'hidde'>".$row['dias']."</span>
								</td>
								<td class = 'border_table campos' align = 'center' nowrap>
									<table width = '100%'>
										<tr>
											<td align = 'right' >".$row['q']."</td>
										</tr>
									</table>
									
									<span id = 'h_cant$i' class = 'hidde'>".$row['q']."</span>
								</td>
								<td class = 'border_table campos' align = 'center' nowrap>
									<table width = '100%'>
										<tr>
											<td>$</td>
											<td align = 'right' >".number_format($row['val_item'])."</td>
										</tr>
									</table>
									
									<span id = 'h_valor_interno$i' class = 'hidde'>".$row['val_item']."</span>
								</td>
								<td class = 'border_table subtotal' align = 'center' nowrap>
									<table width = '100%'>
										<tr>
											<td>$</td>
											<td align = 'right' id = 'valor_subtotal_item$i'></td>
										</tr>
									</table>
									<span class = 'subtotal_items hidde' id = 'h_subtotal_item$i' ></span>
								</td>
								<td class = 'border_table' align = 'center' nowrap>
									<table width = '100%'>
										<tr>
											<td align = 'right' >".$row['iva_item']."</td>
										</tr>
									</table>
								</td>
								<td class = 'border_table' align = 'center' nowrap>
									<table width = '100%'>
										<tr>
											<td align = 'right' id = 'iva$i'>".$row['por_prov']."</td>
										</tr>
									</table>
									
									<span id = 'h_vol$i' class = 'hidde'>".$row['por_prov']."</span>
								</td>
								<td class = 'border_table' align = 'center' nowrap>
									<table width = '100%'>
										<tr>
											<td>$</td>
											<td align = 'right'><span id = 'costo_interno$i'></span></td>
										</tr>
									</table>
									<span id = 'h_costo_interno$i' class = 'hidde cost_interno_x'></span>
								</td>
								<th ></th>
								<td class = 'border_table' align = 'center' style = 'background-color:rgb(190, 190, 190);' nowrap>
									<table width = '100%'>
										<tr>
											<td>$</td>
											<td align = 'right'><span>".number_format($row['cliente'])."</span></td>
										</tr>
									</table>
									
									<span id = 'val_cliente_interno$i' class = 'hidde'>".($row['cliente'])."</span>
								</td>
								<td class = 'border_table' style = 'background-color:rgb(190, 190, 190);' nowrap>
									<table width = '100%'>
										<tr>
											<td>$</td>
											<td align = 'right'><span id = 'costo_cliente$i'></span></td>
										</tr>
									</table>
									<span id = 'h_costo_cliente$i' class = 'hidde externo_cliente'></span>					
								</td>
								<th ></th>
								<td align = 'center' class = 'border_table' id = 'por_rent_item$i' nowrap>
									
								</td>
								<td align = 'center' class = 'border_table'   nowrap>
									<table width = '100%'>
										<tr>
											<td>$</td>
											<td align = 'right' id = 'valor_rent_item$i'>0</td>
										</tr>
									</table>
									<span id ='valor_rentabilidad_item$i' class = 'hidde rentabilidad_item'></span>
								</td>
							</tr>
							<tr id = 'asocitem$i' style = 'display:none;'>
										
							</tr>
						</tr>";
						$i++;
					}
					echo "<tr>
						<th colspan = '8'></th>
						<th class = 'dil resultados subtotal'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right' id = 'sum_subtotal_costo_interno'></td>
								</tr>
							</table>
						</th>
						<th colspan = '2'></th>
						<th class = 'dil resultados'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right' id = 'sum_total_costo_interno'></td>
								</tr>
							</table>
						</th>
						<th colspan = '2'></th>
						<th class = 'ext resultados'>
							<table width = '100%'>
								<tr>
									<td>$</td>
									<td align = 'right' id = 'sum_total_costo_externo'></td>
								</tr>
							</table>
						</th>
					</tr>";
				?>
			</table>
		
			<table width = '100%' width = '100%'>
				<tr class = 'encabezado'>
					<td style = 'vertical-align:top;'>
						<table>
							<tr>
								<th colspan = '3'>
									RESUMEN DE ACTIVIDAD
								</th>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto'>VALORES COMISIONALES</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'valores_comisionables'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto'>VALORES NO COMISIONALES</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'valores_no_comisionables'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto'>TOTAL COSTOS DE EJECUCIÓN</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'total_costos_ejecucion'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class ='concepto'>IMPREVISTOS</td>
								<td>
									<?php
										echo "<input type = 'text' value = '$imprevistos' id = 'porcentaje_imprevistos' class = 'entrada_bordes' style = 'width:40px;' placeholder = '%' onkeyup = 'calcular_impuestos_ppto();'/>";
									?>
								</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'total_por_imprevistos'>0</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class ='concepto'>GASTOS ADMINISTRATIVOS</td>
								<td>
									<?php
										echo "<input type = 'text' value = '$gastos_administrativos' id = 'por_gastos_admin' class = 'entrada_bordes' style = 'width:40px;' placeholder = '%' onkeyup = 'calcular_impuestos_ppto();'/>";
									?>
								</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'total_gastos_administrativos'>0</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class ='concepto'>SERVICIOS DE IMPLEMENTACION </br>ESTRATEGIA Y DESARROLLO</td>
								<td align = 'center' >
									<span id = "val_comision" ><?php echo $valor_comision; ?></span>
									<span id = "tipo_comision" class = 'hidde'><?php echo $tipo_comision_ppto;//1 DIVIDIDA?></span>
								</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'valor_comision_agencia'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto'>TOTAL ACTIVIDAD</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'total_actividad_inicial'></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td  style = 'vertical-align:top;'>
						<table>
							
							<tr>
								<td colspan = '2' class ='concepto'>TOTAL COMISIONES POR DESCUENTOS</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'total_comisiones_por_descuentos'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto'>VALORES NO COMISIONALES</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'valores_no_comisionables2'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto'>COMISION AGENCIA UAAI</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'valor_comision_agencia2'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto'>UTILIDAD COMERCIAL</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'utilidad_comercial'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto'>VOLUMEN</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'vol_ppto_vol'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto'>UTILIDAD MARGINAL</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'utilidad_marginal'></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td  style = 'vertical-align:top;'>
						<table>
							<tr>
								<th colspan = '3'>
									RESUMEN DE IMPUESTOS
								</th>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto'>VALOR TOTAL SIN IVA</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'valor_sin_iva_total'></td>
										</tr>
									</table>
								</td>
							</tr>
							
							<tr>
								<td class ='concepto'>RETENCIÓN EN LA FUENTE</td>
								<td align = 'center' class ='concepto'>
									<span id = "por_rete_fuente" ><?php echo "4"; ?></span>
								</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'retencion_fuente'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class ='concepto'>IMPUESTOS ADICIONALES</td>
								<td align = 'center' class ='concepto'>
									<span id = "por_impuestos_adicionales" ><?php echo "0"; ?></span>
								</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'impuestos_adicionales'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class ='concepto'>ICA</td>
								<td align = 'center'class ='concepto' >
									<span  ><?php echo "9.66/1000"; ?></span>
									<span id = "por_ica_val" class  = 'hidde'><?php echo "9.66"; ?></span>
								</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'val_ica'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class ='concepto'>CREE</td>
								<td align = 'center' class ='concepto'>
									<span id = "por_cree_val" ><?php echo "0.8"; ?></span>
								</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'val_cree'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2'class ='concepto'>4 x 1000</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'cuatro_por_mil'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class ='concepto'>CHEQUES Y TRANSFERENCIAS</td>
								<td align = 'center' class ='concepto'>
									<span id = "num_chueques" >0</span>
								</td>
								<td >
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'cheques_val'></td>
										</tr>
									</table>
									<span id = 'uni_valor_cheques' class = 'hidde'><?php echo "3350";?></span>
								</td>
							</tr>
							
							<tr>
								<td class ='concepto'>FACTORING</td>
								<td class ='concepto'>
									<input type = 'text' id = 'por_factoring' value = '0' class = 'entrada_bordes' style = 'width:40px;' placeholder = '%' />
								</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'val_factoring'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class ='concepto'>ANTICIPOS INTERESES BANCARIOS</td>
								<td align = 'center' class ='concepto'>
									<span id = "por_ant_banca" >0</span>
								</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'val_ant_int_banc'></td>
										</tr>
									</table>
									<span class = 'hidde' id = 'pago_a_cliente'>45</span>
								</td>
							</tr>
							<tr>
								<td class ='concepto'>DEL PROYECTO INTERESES BANCARIOS</td>
								<td class ='concepto'>
									<input type = 'text' id = 'dpib' value = '0' class = 'entrada_bordes' style = 'width:40px;' placeholder = '%' />
								</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'val_por_pro_banc'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class ='concepto'>DEL PROYECTO INTERESES A 3ROS</td>
								<td class ='concepto'>
									<input type = 'text' id = 'dpi3' value = '0' class = 'entrada_bordes' style = 'width:40px;' placeholder = '%' />
								</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'val_por_com_ter'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto'>TOTAL COSTOS FINANCIEROS E IMPUESTOS</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'total_cost_finan_imp'></td>
										</tr>
									</table>
								</td>
							</tr>
							
							<tr>
								<td colspan = '2' class ='concepto'>EXCEDENTE ASOCIADOS</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'sobrante_asoc'></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td rowspan = '13'  style = 'font-size:300%;vertical-align:top;' nowrap>
						<table width = '100%'>
							<tr>
								<th colspan = '3'>
									TOTAL UTILIDAD
								</th>
							</tr>
							<tr style = 'font-size:300%;vertical-align:top;'>
								<td colspan = '2' class ='concepto'>UTILIDAD FINAL</td>
								<td>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'utilidad_final' nowrap></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr style = 'font-size:300%;vertical-align:top;'>
								<td colspan = '3' class ='concepto' id = 'por_utilidad'></td>
							</tr>
						</table>
					</td>
					<span class = 'hidde' id = 'por_min_val_apro'><?php  echo "20";?></span>
				</tr>
			</table>
		</body>
	</html>