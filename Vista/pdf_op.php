<?php
	include("../Controller/Conexion.php");
	require('../mpdf/mpdf.php');
	require('../Modelo/cabecera_ot.php');
	
	$otn = new cabecera_ot();
	$op = $_GET['op'];
	$sql = mysql_query("select ox.codigo_interno_op, p.ot, p.referencia, ox.fecha_orden, e.nombre_empleado as ejecutivo, p.empresa_nit_empresa,emp.logo,emp.nombre_legal_empresa,emp.nit_empresa,p.codigo_presup,p.vi,p.vc,
	cl.codigo_interno_cliente, cl.nombre_legal_clientes, pr.nombre_producto, p.numero_presupuesto, emp.nota_orden_c, proo.nombre_legal_proveedor,proo.nit_proveedor, fpa.name_forma_pago, ox.fecha_entrega,
	emp.cod_interno_empresa
	
	from cabpresup p, orproduccion ox, empleado e, usuario u, empleado e2, usuario u2, cabot ot, empresa emp, clientes cl, producto_clientes pr, proveedores proo,
	fpago fpa
	where ox.ppto = p.codigo_presup and ot.codigo_ot = p.ot and ox.usu_orden = u.idusuario and u.pk_empleado = e.documento_empleado and
	p.usuario = u2.idusuario and u2.pk_empleado = e2.documento_empleado and ox.codigo_interno_op = '$op'
	and p.empresa_nit_empresa = emp.cod_interno_empresa and p.pk_clientes_nit_cliente = cl.codigo_interno_cliente and ot.producto_clientes_codigo_PRC = pr.id_procliente
	and ox.proveedor = proo.codigo_interno_proveedor and ox.fpago = fpa.codigo_interno");
	$logo = "";
	$ppto_ext =0;
	$nit_empresa = "";
	$fecha_registro = "";
	$cliente = "";
	$producto = "";
	$cod_cliente = "";
	$referencia="";
	$ot = "";
	$nombre_emp = "";
	$numero_ppto="";
	$observaci = "";
	$comision = 0;
	$proveedor = "";
	$nit_prove = "";
	$pago_a = "";
	$fecha_entrega = "";
	$cod_empresa = "";
	$version_interna = 0;
	$version_externa = 0;
	
	while($row  = mysql_fetch_array($sql)){
		$logo = $row['logo'];
		$cod_cliente = $row['codigo_interno_cliente'];
		$cod_empresa = $row['cod_interno_empresa'];
		$pago_a = $row['name_forma_pago'];
		$fecha_entrega = $row['fecha_entrega'];
		//$nombre_empresa = $row['nombre_legal_empresa'];
		$nit_empresa = $row['nit_empresa'];
		$fecha_registro = $row['fecha_orden'];
		$cliente = $row['nombre_legal_clientes'];
		$producto = $row['nombre_producto'];
		$referencia = $row['referencia'];
		$ot = $row['ot'];
		$numero_ppto = $row['codigo_presup'];
		$nombre_emp = $row['ejecutivo'];
		$observaci = $row['nota_orden_c'];
		$proveedor = $row['nombre_legal_proveedor'];
		$nit_prove = $row['nit_proveedor'];
		$version_interna = $row['vi'];
		$version_externa = $row['vc'];
		$ppto_ext  = $row['numero_presupuesto'];
	}
	$vi = $version_interna;
	$vc = $version_externa;
	$t='';		
	$acum = 0;
	
	
	$cabecera_pdf =  '<table class = "tabla_central" width = "100%" >
				<tr>
					<th align = "center" style ="padding-left:5px;vertical-align:top;font-size:11px;">
						<img src = "../images/logos/'.$logo.'" height = "50px" />
						NIT: '.$nit_empresa.'
					</th>
					<th width = "92%" align = "center" style = "vertical-align:middle;" >
						<span id = "titulo">ORDEN DE COMPRA # '.$op.'</span>
						<table  style = "font-size:11px;">
							<tr>
								<td>Interno: </td>
								<td class = "decoration">'.$numero_ppto.' v. '.$vi.'</td>
								<td style = "width:20px;"></td>
								<td>Cliente: </td>
								<td class = "decoration">'.$ppto_ext.' v. '.$vc.'</td>
							</tr>
						</table>
						
					</th>
					<th align = "center" style ="padding-right:5px;vertical-align:top;">
					</th>
				</tr>
				<tr><td></td></tr><tr><td></td></tr>
				<tr><td></td></tr><tr><td></td></tr>
			</table>
			<table  width = "100%" class = "tabla_central">
				<tr>
					<td class = "decoration">CLIENTE</td>
					<td class = "decoration_size">'.$cliente.'</td>
					
					<td class = "decoration">PRODUCTO</td>
					<td class = "decoration_size">'.$producto.'</td>
					
					<td style = "width:10%;" class = "decoration">OT</td>
					<td class = "decoration_size">'.strtoupper($ot).'</td>
					
				</tr>
				
				<tr>
					<td class = "decoration">REFERENCIA</td>
					<td class = "decoration_size">'.(strtoupper($referencia)).'</td>
					
					<td class = "decoration">PROVEEDOR</td>
					<td class = "decoration_size">'.$proveedor.'</td>
					
					
					<td class = "decoration">NIT</td>
					<td class = "decoration_size">'.$nit_prove.'</td>
				</tr>
				<tr>
					<td class = "decoration">CREADO POR</td>
					<td class = "decoration_size">'.$nombre_emp.'</td>
				</tr>
			</table>';
		
	$sql = mysql_query("select p.id,p.descripcion,p.dias,p.q,p.val_item,p.iva_item,p.por_prov
		from itempresup p 
		where p.pk_orden = '$op'");
		
	$sql2 = mysql_query("select p.id,p.descripcion,p.dias,p.q,p.val_item,p.iva_item,p.por_prov,cp.codigo_int_celula
		from itempresup p , cecula_ppto_interno cp
		where p.ppto = cp.pk_ppto_interno and p.ppto = '$numero_ppto' and p.pk_orden = '$op' order by cp.codigo_int_celula asc");
	$acum_x = 0;
	$iva_cum = 0;
	$antes_iva = 0;
	//$cod_empresa = 0;
	while($row = mysql_fetch_array($sql)){
		$temp = 0;
		if($cod_empresa == 1){
			$acum_x +=  (($row['iva_item']*$row['val_item']*$row['dias']*$row['q'])/100) + ($row['val_item']*$row['q']*$row['dias']); 
			$antes_iva += $row['val_item']*$row['dias']*$row['q'];
			$acum += $row['val_item']*$row['q']*$row['dias'];
			$iva_cum +=($row['iva_item']*$row['val_item']*$row['dias']*$row['q'])/100;
		}else{
			$temp = ($row['val_item']*$row['por_prov'])/100;
			$temp_aux = $temp*$row['q']*$row['dias'];
			$acum_x +=  (($row['iva_item']*($row['val_item']-$temp)*$row['dias']*$row['q'])/100) + (($row['val_item']-$temp)*$row['q']*$row['dias']); 
			$antes_iva += ($row['val_item']-$temp)*$row['dias']*$row['q'];
			$acum +=($row['val_item']-$temp)*$row['q']*$row['dias'];
			$iva_cum +=($row['iva_item']*($row['val_item']-$temp)*$row['dias']*$row['q'])/100;
		}
		
		$t.='<tr>
			<td align = "center" class = "fondo_items">'.$row['dias'].'</td>
			<td align = "center" class = "fondo_items">'.$row['q'].'</td>
			<td class = "fondo_items">'.(strtr(strtoupper($row['descripcion']),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")).'</td>
			<td class = "fondo_items" >
				<table class ="internos" style = "text-align:right;padding-left:30px;">
					<tr>
						<td align = "left" width = "2%">$</td><td align = "right">'.number_format($row['val_item']-$temp,2,'.',',').'</td>
					</tr>
				</table>
			</td>
			<td class = "fondo_items" style = "text-align:right;padding-left:30px;">
				<table width = "100%" class ="internos">
					<tr>
						<td align = "left" width = "2%">$</td><td align = "right">'.number_format($row['val_item']*$row['dias']*$row['q']-$temp_aux,2,'.',',').'</td>
					</tr>
				</table>
			</td>
			<td align = "center" class = "fondo_items">'.number_format($row['iva_item']).'</td>
			<td class = "fondo_items" style = "text-align:right;padding-left:30px;">
				<table  class ="internos">
					<tr>
						<td align = "left" width = "2%">$</td><td align = "right">'.number_format(($row['iva_item']*($row['val_item']-$temp)*$row['dias']*$row['q'])/100,2,'.',',').'</td>
					</tr>
				</table>
			</td>
			<td class = "fondo_items" style = "text-align:right;padding-left:30px;">
				<table  class ="internos">
					<tr>
						<td align = "left" width = "2%">$</td><td align = "right">'.number_format( (($row['iva_item']*($row['val_item']-$temp)*$row['dias']*$row['q'])/100)+(($row['val_item']-$temp)*$row['dias']*$row['q']),2,'.',',').'</td>
					</tr>
				</table>
			</td>
		</tr>';
	}
		$t.='
		<tr class = "salto">
			<td colspan = "6"></td>
			<th class = "th_subtotales">TOTAL</th>
			<td style = "border:1px solid black;">
				<table width = "100%" class ="internos" style = "font-weight:bold;padding-left:30px;">
					<tr>
						<td align = "left" width = "2%">$</td><td align = "right">'.number_format($acum_x,2,'.',',').'</td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr class = "salto"><td ></br></td></tr>
		
		<tr class = "salto"><td ></br></td></tr>
		';
	
	$nota_op = '';
	$sql_op = mysql_query("select distinct pk_op from itempresup where pk_orden = '$op' and pk_op != 0");
	if(mysql_num_rows($sql_op) > 0){
		while($row = mysql_fetch_array($sql_op)){
			$nota_op .= 'ESTA ORDEN DE COMPRA REEMPLAZA LA OP # '.$row['pk_op'];
		}
	}
	
	$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>OC '.$op.'</title>

				<style type="text/css">
					
					body{
						font-family:"Arial";
					}
					
					#titulo{
						font-size:26px;
					}
					
					
					.tabla_items th{
						
					}
					.tabla_items td{
						border:1px solid white;
						font-size:10px;
					}
					.fondo_items{
						background-color:#E5E5E5;
						border:1px solid white;
						padding-left:3px;
					}
					.internos td{
						border:0px solid white;
						
					}
					.internos2{
						border:1px solid black;
					}
					.salto td{
						border:0px solid tranparent;
					}
					@page *{
						margin:0px;
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
				</style>
			</head>
			<body>
			
			<br></br>
			<table  class = "tabla_items" style = "border-collapse:collapse;border:1px solid white;">
				<tr>
					<th colspan = "2" class = "th_central" style  = "font-size:12px;">CONDICIONES DE ENTREGA</th>
				</tr>
				<tr>
					<td class = "fondo_items">FORMA DE PAGO</td>
					<td class = "fondo_items">'.$pago_a.'</td>
				</tr>
				<tr>
					<td class = "fondo_items">FECHA DE ENTREGA</td>
					<td class = "fondo_items">'.$fecha_entrega.'</td>
				</tr>
				<tr>
					<td class = "fondo_items">LUGAR</td>
					<td class = "fondo_items"></td>
				</tr>
			</table>
			</br>
			<table width = "100%" class = "tabla_items" style = "border-collapse:collapse;border:1px solid white;">			
				<tr>
					<th nowrap class = "th_sub" style = "padding-left:5px;padding-right:5px;">DÍAS</th>
					<th nowrap class = "th_sub" style = "padding-left:5px;padding-right:5px;">CANTIDAD</th>
					<th width = "35%" nowrap class = "th_sub">DESCRIPCIÓN</th>
					<th nowrap class = "th_sub">VALOR UNIDAD</th>
					<th nowrap class = "th_sub">SUBTOTAL</th>
					<th nowrap class = "th_sub">IVA%</th>
					<th nowrap class = "th_sub">VALOR IVA</th>
					<th nowrap class = "th_sub">VALOR TOTAL</th>
				</tr>
				<tr></tr>
				'.$t.'
				
				<tr class = "salto"><td ></br></td></tr>
				
				<tr class = "salto"><td ></br></td></tr>
				<tr class = "salto">
					<td colspan = "6"></td>
					
					<th style = "border:1px solid white;" class = "th_subtotales">
						<strong>SUBTOTAL</strong>
					</th>
					<td style = "border:1px solid white;padding-left:30px;" class = "fondo_items">
						<table width = "100%">
							<tr>
								<td align = "left" width = "2%">$</td>
								<td align = "right"><strong>'.number_format($antes_iva).'</strong></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class = "salto">
					<td colspan = "6"></td>
					
					<th style = "border:1px solid white;" class = "th_subtotales">
						<strong>IVA</strong>
					</th>
					<td style = "border:1px solid white;padding-left:30px;" class = "fondo_items">
						<table width = "100%">
							<tr>
								<td align = "left" width = "2%">$</td>
								<td align = "right"><strong>'.number_format($iva_cum).'</strong></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class = "salto">
					<td colspan = "6"></td>
					
					<th style = "border:1px solid white;" class = "th_subtotales" >
						<strong>TOTAL</strong>
					</th>
					<td style = "border:1px solid white;padding-left:30px;" class = "fondo_items">
						<table width = "100%">
							<tr>
								<td align = "left" width = "2%">$</td>
								<td align = "right"><strong>'.number_format($antes_iva+$iva_cum).'</strong></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table width = "100%" class = "tabla_items" style = "border-collapse:collapse;border:1px solid white;">
				<tr class = "salto">
					<td>
						<table class = "internos">
							<tr>
								<td style = "padding-bottom:20px;padding-right:10px;">DIRECTOR DE COMPRAS</td>
								<td style = "vertical-align:top;">_________________________________________________</td>
							</tr>
							<tr></tr>
							<tr>
								<td style = "padding-bottom:20px;padding-right:10px;">ACEPTADO PROVEEDOR</td>
								<td>_________________________________________________</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			
			
			<br></br>
			<p  style = "text-align:justify;font-weight:bold;font-size:10px;width:100%;color:red;">'.$nota_op.'</p>
			<p style = "text-align:justify;font-size:8px;width:100%;">NOTA:'.$observaci.'</p>
			</body>
		</html>';
	$pdf=new mPDF('en-x','Letter-L','','',20,20,60,55,5,5);
	$pdf->mirrorMargins = true;
	$pdf->AliasNbPages();
	$pdf->SetAutoPageBreak(true, 12);
 
	
	$pdf->SetFont('Arial','B',10);
	
	$pdf->SetHTMLHeader($cabecera_pdf);
	$cb = $cabecera_pdf;
	$pdf->SetHTMLHeader($cb,'E');
	
	include("footer_pdf.php");
	$pdf->WriteHTML($html);
	

	$pdf->Output('OC '.$op.'.pdf', 'I');
?>