<?php
	include("../Controller/Conexion.php");
	require('../mpdf/mpdf.php');
	require('../Modelo/cabecera_ot.php');
	
	$otn = new cabecera_ot();
	$ppto = $_GET['ppto'];
	$vi = $_GET['vi'];
	$vc = $_GET['vc'];
	
	
	$sql = mysql_query("select e.logo,e.nit_empresa,p.fecha_registro,c.nombre_legal_clientes, pr.nombre_producto, p.referencia,p.ot,p.numero_presupuesto, em.nombre_empleado,e.observacion,con.uaai,c.codigo_interno_cliente,p.vi,p.vc,p.contacto
	from empresa e, cabpresup p, clientes c, cabot ot, producto_clientes pr,usuario u, empleado em, condiciones_cliente con
	where p.empresa_nit_empresa = e.cod_interno_empresa and p.codigo_presup = '$ppto' and p.vi = '$vi' and p.vc = '$vc' and p.pk_clientes_nit_cliente = c.codigo_interno_cliente and
	p.ot = ot.codigo_ot and ot.producto_clientes_codigo_PRC = pr.id_procliente and ot.ejecutivo = u.idusuario and u.pk_empleado = em.documento_empleado and p.tipo_comision = con.consecutivo");
	$logo = "";
	$nit_empresa = "";
	$fecha_registro = "";
	$cliente = "";
	$producto = "";
	$referencia="";
	$ot = "";
	$nombre_emp = "";
	$numero_ppto="";
	$observaci = "";
	$comision = 0;
	$version_interna = "";
	$version_externa = "";
	
	
	$pk_cliente = 0;
	while($row  = mysql_fetch_array($sql)){
		$logo = $row['logo'];
		$nit_empresa = $row['nit_empresa'];
		$fecha_registro = $row['fecha_registro'];
		$cliente = $row['nombre_legal_clientes'];
		$pk_cliente = $row['codigo_interno_cliente'];
		$producto = $row['nombre_producto'];
		$referencia = $row['referencia'];
		$ot = $row['ot'];
		$numero_ppto = $row['numero_presupuesto'];
		$nombre_emp = $row['nombre_empleado'];
		$observaci = $row['observacion'];
		$comision = $row['uaai'];
		$version_interna = $row['vi'];
		$version_externa = $row['vc'];
	}
	$t='';		
	//CONSULTO LOS GRUPOS QUE HAY DEL PPTO MENOS LOS QUE ESTÁN DENTRO DE VALORES NO COMISIONABLES
	
	$grup = mysql_query("select distinct p.name_grupo 
	from itempresup p	
	where p.ppto = '$ppto' and p.vi = '$vi' and p.vc = '$vc' order by p.name_grupo asc");
	$i = 0;
	$acum = 0;
	$acumm_iva = 0;
	$acumxx = 0;
	$t.='	<tr>
				<th colspan = "12" style = "background-color:#88B4F5;" class = "titulos">INTERNO</th>
				<th colspan = "3" class = "cliente titulos">EXTERNO</th>
				<th colspan = "2" style = "background-color:#88B4F5;" class = "titulos">RENTABILIDAD</BR>PARCIAL</th>
			</tr>
			<tr>
				<td></br></td>
			</tr>
			<tr>
				<th style = "background-color:#88B4F5;" class = "titulos">GRUPO</th>
				<th style = "background-color:#88B4F5;" class = "titulos">ITEM</th>
				<th style = "background-color:#88B4F5;" class = "titulos">DESCRIPCIÓN</th>
				<th style = "background-color:#88B4F5;" class = "titulos">PROVEEDOR</th>
				<th style = "background-color:#88B4F5;" class = "titulos">DIAS</th>
				<th style = "background-color:#88B4F5;" class = "titulos">CANT</th>
				<th nowrap style = "background-color:#88B4F5;" class = "titulos">$ UNITARIO</th>
				<th style = "background-color:#88B4F5;" class = "titulos">SUBTOTAL</th>
				<th style = "background-color:#88B4F5;" class = "titulos">ANTICIPO</th>
				<th nowrap style = "background-color:#88B4F5;"  class = "titulos">% IVA</th>
				<th nowrap style = "background-color:#88B4F5;"  class = "titulos">% VOL</th>
				<th style = "background-color:#88B4F5;" nowrap class = "titulos">COSTO INT</th>
				
				<th class = "cliente titulos" nowrap>DESCRIPCIÓN</th>
				<th class = "cliente titulos" nowrap>$ UNITARIO</th>
				<th class = "cliente titulos">TOTAL</th>
				
				<th style = "background-color:#88B4F5;" class = "titulos">%</th>
				<th style = "background-color:#88B4F5;" class = "titulos">$</th>
			</tr>
			<tr>
				<td></br></td>
			</tr>';
	$sql_items = mysql_query("select p.id, p.proveedor, p.dias,p.q,p.descripcion,p.val_item,p.iva_item,p.fecha_ant,p.por_ant,p.cliente,p.por_prov,p.id,p.vnc,
			p.name_item,p.editable, pp.nombre_comercial_proveedor,pp.codigo_interno_proveedor,p.pk_orden,p.pk_op,
			p.name_grupo,p.descripcion2
			
			from itempresup p, proveedores pp
			
			where p.ppto = '$ppto' and p.asoc = '0' and p.proveedor = pp.codigo_interno_proveedor 
			and p.vi = '$vi' and p.vc = '$vc' order by p.num_interno asc");
			
			
	$acum_subtotal = 0;
	$acum_costo_interno = 0;
	$acum_costo_cliente = 0;
	$acum_rentabilidad = 0;
	
	$valores_comisionables = 0;
	$valor_vol_general = 0;
	while($row = mysql_fetch_array($sql_items)){
		$val_subtotal = $row['dias'] * $row['q'] * $row['val_item'];
		$acum_subtotal+=$val_subtotal;
		
		
		$iva_item = ($row['iva_item']/100)*$val_subtotal;
		$vol_item = ($row['por_prov']/100)*$val_subtotal;
		$valor_vol_general +=$vol_item;
		$costo_interno = ($val_subtotal - $vol_item);// + $iva_item;
		$acum_costo_interno += $costo_interno;
		
		$val_cliente = $row['dias'] * $row['q'] * $row['cliente'];
		$acum_costo_cliente+=$val_cliente;
		
		$valor_rentabilidad = $val_cliente - $costo_interno;
		$porcentaje_rentabilidad = ($valor_rentabilidad*100)/$val_cliente;
		$acum_rentabilidad += $valor_rentabilidad;
		
		
		$id = $row['id'];
		$sql_anticipos = mysql_query("select porcentaje from cuerpo_anticipo where pk_item = '$id'");
		$porcentaje_anticipo_item = "";
		$acum_por = 0;
		if(mysql_num_rows($sql_anticipos) == 0){
			$porcentaje_anticipo_item = "0 %";
		}else{
			while($cx = mysql_fetch_array($sql_anticipos)){
				$acum_por+=$cx['porcentaje'];
			}
		}
		
		$t.='<tr>
			<td class = "fondo_td">'.utf8_decode($row['name_grupo']).'</td>
			<td class = "fondo_td">'.utf8_decode($row['name_item']).'</td>
			<td class = "fondo_td">'.nl2br(utf8_decode($row['descripcion'])).'</td>
			<td class = "fondo_td">'.$row['nombre_comercial_proveedor'].'</td>
			<td class = "fondo_td" align = "center">'.$row['dias'].'</td>
			<td class = "fondo_td" align = "center">'.$row['q'].'</td>
			<td class = "fondo_td" align = "center">$ '.number_format($row['val_item']).'</td>
			<td class = "fondo_td" align = "center">$ '.number_format($val_subtotal).'</td>
			<td class = "fondo_td" align = "center">'.$acum_por.'</td>
			<td class = "fondo_td" align = "center">'.$row['iva_item'].'</td>
			<td class = "fondo_td" align = "center">'.$row['por_prov'].'</td>
			<td class = "fondo_td" align = "center">$ '.number_format($costo_interno).'</td>
			<td class = "fondo_td" >'.utf8_decode($row['descripcion2']).'</td>
			<td class = "fondo_td" align = "center">$ '.number_format($row['cliente']).'</td>
			<td class = "fondo_td" align = "center">$ '.number_format($val_cliente).'</td>
			<td class = "fondo_td" align = "center">'.number_format($porcentaje_rentabilidad,2).' %</td>
			<td class = "fondo_td" align = "center">$ '.number_format($valor_rentabilidad).'</td>
		</tr>';
	}
	
	
	
	
	//VALORES NO COMISIONABLES
	$sql_items = mysql_query("select p.id, p.proveedor, p.dias,p.q,p.descripcion,p.val_item,p.iva_item,p.fecha_ant,p.por_ant,p.cliente,p.por_prov,p.id,p.vnc,
			p.name_item,p.editable, pp.nombre_comercial_proveedor,pp.codigo_interno_proveedor,p.pk_orden,p.pk_op,
			p.name_grupo,p.descripcion2
			
			from itempresup p, proveedores pp
			
			where p.ppto = '$ppto' and p.asoc = '0' and p.proveedor = pp.codigo_interno_proveedor 
			and p.vi = '$vi' and p.vc = '$vc' p.vnc = '1' order by p.num_interno asc");
			
	$acum_valores_no_comisionables = 0;
	
	$acum_costo_internox = 0;
	
	while($row = mysql_fetch_array($sql_items)){
		$val_subtotal = $row['dias'] * $row['q'] * $row['val_item'];
		
		$valor_vol_general +=$vol_item;
		$iva_item = ($row['iva_item']/100)*$val_subtotal;
		$vol_item = ($row['por_prov']/100)*$val_subtotal;
		$costo_interno = ($val_subtotal - $vol_item);// + $iva_item;
		$acum_costo_internox += $costo_interno;
		
		$val_cliente = $row['dias'] * $row['q'] * $row['cliente'];
		$acum_valores_no_comisionables+=$val_cliente;
		
	}
	
	$t.='<tr class = "totalizador">
			<th colspan = "7"></th>
			<td class = "fondo_td" align = "center" nowrap><strong>$ '.number_format($acum_subtotal).'</strong></td>
			<th colspan = "3"></th>
			<td class = "fondo_td" align = "center" nowrap><strong>$ '.number_format($acum_costo_interno).'</strong></td>
			<th ></th>
			<th ></th>
			<td class = "fondo_td" align = "center" nowrap><strong>$ '.number_format($acum_costo_cliente).'</strong></td>
			<th ></th>
			<td class = "fondo_td" align = "center" nowrap><strong>$ '.number_format($acum_rentabilidad).'</strong></td>
		</tr>
	</table>';

	
	$cabecera_pdf = '<table class = "tabla_central" width = "100%" >
				<tr>
					<th align = "center" style ="padding-left:5px;vertical-align:top;font-size:11px;">
						<img src = "../images/logos/'.$logo.'" height = "50px" />
						NIT: '.$nit_empresa.'
					</th>
					<th width = "92%" align = "center" style = "vertical-align:middle;" >
						<span id = "titulo">PRESUPUESTO</span>
						<table  style = "font-size:11px;">
							<tr>
								<td>Interno: </td>
								<td class = "decoration">'.$ppto.' v. '.$vi.'</td>
								<td style = "width:20px;"></td>
								<td>Cliente: </td>
								<td class = "decoration">'.$numero_ppto.' v. '.$vc.'</td>
							</tr>
						</table>
						
					</th>
					<th align = "center" style ="padding-right:5px;vertical-align:top;">
					</th>
				</tr>
				<tr><td></td></tr><tr><td></td></tr>
				<tr><td></td></tr><tr><td></td></tr>
			</table>			
			<table width = "100%" class = "tabla_central">
				<tr>
					<td class = "decoration">CLIENTE</td>
					<td class = "decoration_size">'.$cliente.'</td>
					
					<td class = "decoration">PRODUCTO</td>
					<td class = "decoration_size">'.$producto.'</td>
					
					<td style = "width:10%;" class = "decoration">OT</td>
					<td class = "decoration_size">'.strtoupper($ot).'</td>
				</tr>
				<tr>
					<td class = "decoration">EJECUTIVO</td>
					<td class = "decoration_size">'.strtoupper($nombre_emp).'</td>
					
					<td class = "decoration">REFERENCIA</td>
					<td class = "decoration_size">'.(strtoupper($referencia)).'</td>
				</tr>
			</table>';
			
	$total_costos_ejecucion_f = $acum_costo_cliente + $acum_valores_no_comisionables;
	
	
	//IMPREVISTOS:
	$sql_impuestos_pptos = mysql_query("select cree, ica, rfuente, cheques, factoring_imp, ant_int_bancarios_imp, pro_int_bancarios_imp, gastos_admin, imprevistos from cabpresup where codigo_presup = '$ppto'");
	$imprevistos = 0;
	$gastos_admin = 0;
	$retencion = 0;
	$cheques_transferencias = 0;
	$chequess = 0;
	$factoring_imp = 0;
	
	$num_prov = mysql_query("select distinct proveedor from itempresup where ppto = '$ppto' and vi = '$vi' and vc = '$vc'");
	while($row = mysql_fetch_array($sql_impuestos_pptos)){
		$imprevistos = ($total_costos_ejecucion_f) * ($row['imprevistos']/100);
		$chequess = $row['cheques'];
		$gastos_admin = ($total_costos_ejecucion_f) * ($row['gastos_admin']/100);
		$retencion = ($total_costos_ejecucion_f) * ($row['rfuente']/100);
		$factoring_imp = ($total_costos_ejecucion_f) * ($row['factoring_imp']/100);
		$cheques_transferencias = mysql_num_rows($num_prov) * ($row['cheques']);
	}
	
	
	$total_actividad_gastos = $total_costos_ejecucion_f + $imprevistos + $gastos_admin;
	$ica = ($total_actividad_gastos) * (9.66/1000);
	$cree = ($total_costos_ejecucion_f) * (0.008);
	$cuatro_mil = ($total_actividad_gastos) * ((4)/1000);
	$t.='<table width = "100%" width = "100%" class = "tabla_items" style  = "border-collapse: collaps;" >
				<tr>
					<td></br></td>
				</tr>
				<tr class = "encabezado">
					<td style = "vertical-align:top;padding-left:10px;" align = "center" width = "33%">
						<table>
							<tr>
								<th colspan = "3" style = "font-weight:bold;color:#F9904C;padding-left:5px;" align = "center">RESUMEN DE ACTIVIDAD</th>
							</tr>
							<tr >
								<td colspan = "2" class ="concepto2 fondo_td" style = "border-top-left-radius:1em;-moz-border-top-left-radius:1em;-webkit-border-top-left-radius:1em;padding-left:10px;">VALORES COMISIONABLES</td>
								<td style = "padding-left:5px;color:#707070;border-top-right-radius:1em;-moz-border-top-right-radius:1em;-webkit-border-top-right-radius:1em;" class ="concepto2 fondo_td">
									$ '.number_format($acum_costo_cliente).'
								</td>
							</tr>
							<tr >
								<td colspan = "2" class ="concepto2 fondo_td" style = "padding-left:10px;">VALORES NO COMISIONABLES</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									$ '.number_format($acum_valores_no_comisionables).'
								</td>
							</tr>
							<tr >
								<td colspan = "2" class ="concepto2 fondo_td" style = "padding-left:10px;">TOTAL COSTOS DE EJECUCIÓN</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									$ '.number_format($total_costos_ejecucion_f).'
								</td>
							</tr>
							<tr >
								<td class ="concepto2 fondo_td" style = "padding-left:10px;" colspan = "2">IMPREVISTOS</td>
								<td class ="concepto2 fondo_td" style = "padding-left:5px;color:#707070;">
									$ '.number_format($imprevistos).'
								</td>
							</tr>
							<tr>
								<td class ="concepto2 fondo_td" style = "padding-left:10px;" colspan = "2">GASTOS ADMINISTRATIVOS</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									$ '.number_format($gastos_admin).'
								</td>
							</tr>
							<tr>
								<td class ="concepto2 fondo_td" style = "padding-left:10px;" colspan = "2">SERVICIOS DE IMPLEMENTACION </br>ESTRATEGIA Y DESARROLLO</td>
								<td style = "padding-left:5px;color:#707070;" align = "center" class ="concepto2 fondo_td">
									$ 0
								</td>
							</tr>
							<tr>
								<td colspan = "2" class ="concepto2 fondo_td" style = "padding-left:10px;">TOTAL ACTIVIDAD</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									$ '.number_format($total_actividad_gastos).'
								</td>
							</tr>
							<tr>
								<td colspan = "2" class ="concepto2 fondo_td" style = "padding-left:10px;">TOTAL COMISIONES POR DESCUENTOS</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									$ '.number_format($valor_vol_general).'
								</td>
							</tr>
							<tr>
								<td colspan = "2" class ="concepto2 fondo_td" style = "padding-left:10px;">VALORES NO COMISIONALES</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td" >
									$ '.number_format($acum_valores_no_comisionables).'
								</td>
							</tr>
							<tr>
								<td colspan = "2" class ="concepto2 fondo_td" style = "padding-left:10px;">COMISION AGENCIA UAAI</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									$ 0
								</td>
							</tr>
							<tr>
								<td colspan = "2" class ="concepto2 fondo_td" style = "padding-left:10px;">UTILIDAD COMERCIAL</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									$ 0 
								</td>
							</tr>
							<tr class ="concepto2">
								<td colspan = "2"  style = "padding-left:10px;" class ="concepto2 fondo_td">VOLUMEN</td>
								<td style = "padding-left:5px;color:#707070;" class = "concepto2 fondo_td">
									$ 0
								</td>
							</tr>
							<tr class ="concepto2">
								<td colspan = "2" class = "fondo_td" style = "border-bottom-left-radius:1em;-moz-border-bottom-left-radius:1em;-webkit-border-bottom-left-radius:1em;padding-left:10px;">UTILIDAD MARGINAL</td>
								<td style = "padding-left:5px;color:#707070;border-bottom-right-radius:1em;-moz-border-bottom-right-radius:1em;-webkit-border-bottom-right-radius:1em;" class ="concepto2 fondo_td">
									$ 0
								</td>
							</tr>
						</table>
					</td>
					
					<td  style = "vertical-align:top;" align = "center" width = "33%">
						<table>
							<tr>
								<th colspan = "3" style = "font-weight:bold;color:#F9904C;padding-left:5px;" align = "center">RESUMEN DE IMPUESTOS</th>
							</tr>
							<tr>
								<td colspan = "2" class ="concepto2 fondo_td" style = "border-top-left-radius:1em;-moz-border-top-left-radius:1em;-webkit-border-top-left-radius:1em;padding-left:10px;">VALOR TOTAL SIN IVA</td>
								<td style = "padding-left:5px;color:#707070;border-top-right-radius:1em;-moz-border-top-right-radius:1em;-webkit-border-top-right-radius:1em;" class ="concepto2 fondo_td">
									$ '.number_format($total_costos_ejecucion_f).'
								</td>
							</tr>
							
							<tr>
								<td class ="concepto2 fondo_td" style = "padding-left:10px;">RETENCIÓN EN LA FUENTE</td>
								<td align = "center" class ="concepto2 fondo_td">
									<span id = "por_rete_fuente" >4</span>
								</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									$ '.number_format($retencion).'
								</td>
							</tr>
							<tr>
								<td class ="concepto2 fondo_td" style = "padding-left:10px;">IMPUESTOS ADICIONALES</td>
								<td align = "center" class ="concepto2 fondo_td">
									<span id = "por_impuestos_adicionales" >0</span>
								</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									$ 0
								</td>
							</tr>
							<tr>
								<td class ="concepto2 fondo_td" style = "padding-left:10px;">ICA</td>
								<td align = "center" class ="concepto2 fondo_td" >
									9.66/1000
								</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									$ '.number_format($ica).' 
								</td>
							</tr>
							<tr>
								<td class ="concepto2 fondo_td" style = "padding-left:10px;">CREE</td>
								<td align = "center" class ="concepto2 fondo_td">
									0.8
								</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									$ '.number_format($cree).' 
								</td>
							</tr>
							<tr>
								<td colspan = "2" class ="concepto2 fondo_td" style = "padding-left:10px;">4 x 1000</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									$ '.number_format($cuatro_mil).' 
								</td>
							</tr>
							<tr>
								<td class ="concepto2 fondo_td" style = "padding-left:10px;">CHEQUES Y TRANSFERENCIAS</td>
								<td align = "center" class ="concepto2 fondo_td" >
									'.number_format($chequess).'
								</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									$ '.number_format($cheques_transferencias).'
								</td>
							</tr>
							
							<tr>
								<td class ="concepto2 fondo_td" style = "padding-left:10px;" colspan = "2">FACTORING</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									$ '.number_format($factoring_imp).' 
								</td>
							</tr>
							<tr>
								<td class ="concepto2 fondo_td" style = "padding-left:10px;">ANTICIPOS INTERESES BANCARIOS</td>
								<td align = "center" class ="concepto2 fondo_td">
									<span id = "por_ant_banca" >0</span>
								</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									45
								</td>
							</tr>
							<tr>
								<td class ="concepto2 fondo_td" style = "padding-left:10px;" colspan = "2">DEL PROYECTO INTERESES BANCARIOS</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									$ 0
								</td>
							</tr>
							<tr>
								<td class ="concepto2 fondo_td" style = "padding-left:10px;" colspan = "2">DEL PROYECTO INTERESES A 3ROS</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									$
								</td>
							</tr>
							<tr>
								<td colspan = "2" class ="concepto2 fondo_td" style = "padding-left:10px;">TOTAL COSTOS FINANCIEROS E IMPUESTOS</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									$
								</td>
							</tr>
							<tr>
								<td colspan = "2" class ="concepto2 fondo_td" style = "padding-left:10px;">UTILIDAD FINAL</td>
								<td style = "padding-left:5px;color:#707070;" class ="concepto2 fondo_td">
									$ 
								</td>
							</tr>
						</table>
					</td>
					
					<td rowspan = "13"  style = "font-size:300%;vertical-align:top;padding-left:10px;"  width = "33%">
						<div class = "redondo" id = "por_utilidad" align = "center" style = "vertical-align:middle;">
							
						</div>
					</td>
					<span class = "hidde" id = "por_min_val_apro">20</span>
				</tr>
			</table>';
	$html = '
			<head>
				<meta http-equiv="Content-Type" charset=utf-8" />

				<style type="text/css">
					body{
						font-family:"Arial";
					}
					
					#titulo{
						font-size:26px;
					}
					#tabla_central{
						border:1px solid black;	
					}
					
					.tabla_items th{
						border:1px solid white;
						color:white;
						text-align:center;
						font-size:9px;
					}
					.tabla_items td{
						border:1px solid white;
						font-size:8px;
					}
					.internos td{
						border:0px solid white;
						
					}
					.internos2{
						border:1px solid white;
					}
					.salto td{
						border:0px solid tranparent;
					}
					.fondo_td{
						background-color: #EDEDED;
						font-size:7px;
					}
					@page *{
						margin:0px;
					}
					.cliente{
						background-color:#EF8B8B;
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
					.decoration{
						background-color:#E6E7E9;
						font-weight:bold;
						padding:5px;
						font-size:12px;
					}
					.decoration_size{
						font-size:12px;
					}
					.th_central{
						background-color:#ACB9C9;
						color:white;
					}
					.th_sub{
						border:1px solid white;
						border-radius:3em;
						border-radius:3mm;
						border-radius:3px;
						background-color:#F8F0B1;
						color:#71675D;
						text-align:center;
						font-size:11px;
					}
					.th_subtotales{
						background-color:#FEA807;
						border:1px solid white;
					}
					.titulos{
						font-size:8px;
					}
				</style>
			</head>
			
			<body >
			<table width = "100%" class = "tabla_items" style = "border-collapse:collapse;border:1px solid white;">			
				'.$t.'
			</table>
			<body>';
	$pdf=new mPDF('en-x','Letter-L','','',20,20,60,55,5,5);
	$pdf->mirrorMargins = true;
	$pdf->AliasNbPages();
	$pdf->SetAutoPageBreak(true, 12);
 
	
	$pdf->SetFont('Arial','B',10);
	
	$pdf->SetHTMLHeader($cabecera_pdf);
	$cb = $cabecera_pdf;
	$pdf->SetHTMLHeader($cb,'E');
	
	
	include("footer_pdf.php");
	//$stylesheet = file_get_contents('ppto.css');
	//$pdf->WriteHTML($stylesheet,1);
	$pdf->WriteHTML($html);

	$pdf->Output('PPTO '.$_GET['ppto'].'.pdf', 'I');
?>