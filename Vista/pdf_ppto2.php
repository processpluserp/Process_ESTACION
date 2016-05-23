<?php
	include("../Controller/Conexion.php");
	require('../mpdf/mpdf.php');
	require('../Modelo/cabecera_ot.php');
	
	$otn = new cabecera_ot();
	$ppto = $_GET['ppto'];
	$sql = mysql_query("select e.logo,e.nit_empresa,p.fecha_registro,c.nombre_legal_clientes, pr.nombre_producto, p.referencia,p.ot,p.numero_presupuesto, em.nombre_empleado,e.observacion,con.uaai,c.codigo_interno_cliente
	from empresa e, cabpresup p, clientes c, cabot ot, producto_clientes pr,usuario u, empleado em, condiciones_cliente con
	where p.empresa_nit_empresa = e.cod_interno_empresa and p.codigo_presup = '$ppto' and p.pk_clientes_nit_cliente = c.codigo_interno_cliente and
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
	/*
	$empresa = $_GET['e'];
	$logo_empresa = mysql_query("select logo,nombre_legal_empresa,nit_empresa from empresa where cod_interno_empresa = '$empresa'");
	
	$nombre_empresa = "";
	
	$id = $_GET['i'];
	*/
	$pk_cliente = 0;
	while($row  = mysql_fetch_array($sql)){
		$logo = $row['logo'];
		//$nombre_empresa = $row['nombre_legal_empresa'];
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
	}
	$t='';		
	$grup =mysql_query("select g.name as grupo, g.id as codigo,cp.codigo_int_celula
			from grupo_tarifario g, cecula_ppto_interno cp
			where cp.pk_ppto_interno = '$ppto' and cp.nombre_celula = g.id order by cp.codigo_int_celula asc");
	$acum = 0;
	$acumm_iva = 0;
	$acumxx = 0;
	
	while($rowx = mysql_fetch_array($grup)){
		$celula = $rowx['codigo_int_celula'];
		if($pk_cliente == 1){
			$t.='<tr><th colspan ="7" align = "center">'.strtoupper($rowx['grupo']).'</th></tr>
			<tr>
				<th>PROVEEDOR</th>
				<th>ITEM</th>
				<th width = "45%" >DESCRIPCIÓN</th>
				<th>VALOR UNIDAD</th>
				<th>CANTIDAD</th>
				<th>DÍAS</th>
				<th>VALOR TOTAL</th>
			</tr>';
		}else{
			$t.='<tr><th colspan ="6" align = "center">'.strtoupper($rowx['grupo']).'</th></tr>
			<tr>
				<th>ITEM</th>
				<th width = "45%" >DESCRIPCIÓN</th>
				<th>VALOR UNIDAD</th>
				<th>CANTIDAD</th>
				<th>DÍAS</th>
				<th>VALOR TOTAL</th>
			</tr>';
		}
		
		
		$sql = mysql_query("select ip.asoc, ip.num_interno,i.id as codigo_item,ip.por_prov as volumen,i.name,ip.id, ip.dias, ip.q, ip.descripcion, ip.val_item, ip.fecha_ant, ip.por_ant, ip.cliente, ip.val_desde_item,
				ip.por_prov, ip.iva_item, p.nombre_legal_proveedor
				from itempresup ip, item_tarifario i,proveedores p
				where i.id = ip.pk_item and ip.ppto = '$ppto' and ip.asoc = '0'  and ip.celula ='$celula' and ip.proveedor = p.codigo_interno_proveedor order by ip.num_interno asc");
		$acum_x = 0;
		while($row = mysql_fetch_array($sql)){
			$acum_x+=$row['cliente']*$row['q']*$row['dias'];
			$acum += $row['cliente']*$row['q']*$row['dias'];
			$acumxx += $row['cliente']*$row['q']*$row['dias'];
			$acumm_iva += (($row['cliente']*$row['q']*$row['dias'])*$row['iva_item'])/100;
			if($pk_cliente == 1){
				$t.='<tr>
					<td>'.$row['nombre_legal_proveedor'].'</td>
					<td>'.strtr(strtoupper($row['name']),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
					<td width = "45%" >'.strtr(strtoupper($row['descripcion']),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
					<td>
						<table width = "100%" class ="internos">
							<tr>
								<td align = "left" width = "2%">$</td><td align = "right">'.number_format($row['cliente']).'</td>
							</tr>
						</table>
					</td>
					<td align = "center">'.$row['q'].'</td>
					<td align = "center">'.$row['dias'].'</td>
					<td>
						<table width = "100%" class ="internos">
							<tr>
								<td align = "left" width = "2%">$</td><td align = "right">'.number_format($row['cliente']*$row['q']*$row['dias']).'</td>
							</tr>
						</table>
					</td>
			</tr>';
			}else{
				$t.='<tr>
				<td>'.strtr(strtoupper($row['name']),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
				<td width = "45%" >'.strtr(strtoupper($row['descripcion']),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
				<td>
					<table width = "100%" class ="internos">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.number_format($row['cliente']).'</td>
						</tr>
					</table>
				</td>
				<td align = "center">'.$row['q'].'</td>
				<td align = "center">'.$row['dias'].'</td>
				<td>
					<table width = "100%" class ="internos">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.number_format($row['cliente']*$row['q']*$row['dias']).'</td>
						</tr>
					</table>
				</td>
			</tr>';
			}
		}
		if($pk_cliente == 1){
			$t.='
				<tr class = "salto">
					<td colspan = "5"></td>
					<th >SUBTOTAL</th>
					<td style = "border:1px solid black;">
						<table width = "100%" class ="internos" style = "font-weight:bold;">
							<tr>
								<td align = "left" width = "2%">$</td><td align = "right">'.number_format($acum_x).'</td>
							</tr>
						</table>
					</td>
				</tr>
				
				<tr class = "salto"><td ></br></td></tr>
				
				<tr class = "salto"><td ></br></td></tr>
				';
			
		}else{
			$t.='
				<tr class = "salto">
					<td colspan = "4"></td>
					<th >SUBTOTAL</th>
					<td style = "border:1px solid black;">
						<table width = "100%" class ="internos" style = "font-weight:bold;">
							<tr>
								<td align = "left" width = "2%">$</td><td align = "right">'.number_format($acum_x).'</td>
							</tr>
						</table>
					</td>
				</tr>
				
				<tr class = "salto"><td ></br></td></tr>
				
				<tr class = "salto"><td ></br></td></tr>
				';
		}
		
	}
	
	$cabecera_pdf = '<table id = "tabla_central" width = "100%" >
				<tr>
					<th align = "center" style ="padding-left:5px;vertical-align:top;">
						<img src = "../images/Untitled-1-01.png" height = "60px" />
					</th>
					<th width = "92%" align = "center" style = "vertical-align:middle;" >
						<span id = "titulo">PRESUPUESTO</span>
						<p>AG: '.$ppto.' - CL: '.$numero_ppto.'</p>
					</th>
					<th align = "center" style ="padding-right:5px;vertical-align:top;">
						<img src = "../images/logos/'.$logo.'" height = "60px" />
						<p id = "nit" align = "center">NIT: '.$nit_empresa.'</p>
					</th>
				</tr>
				<tr>
					<td style ="padding-left:5px;" colspan = "2">
						<table width = "100%">
							<tr>
								<td><strong>CLIENTE</strong>: </td>
								<td style = "padding-left:10px;padding:5px;">'.$cliente.'</td>
								
								<td><strong>PRODUCTO</strong>: </td>
								<td style = "padding-left:10px;">'.$producto.'</td>
							</tr>
							<tr>
								<td><strong>OT</strong>: </td>
								<td style = "padding-left:10px;padding:5px;">'.strtoupper($ot).'</td>
								
								<td><strong>EJECUTIVO</strong>: </td>
								<td style = "padding-left:10px;">'.strtoupper($nombre_emp).'</td>
							</tr>
							<tr>
								<td><strong>REFERENCIA</strong>: </td>
								<td style = "padding-left:10px;">'.strtoupper($referencia).'</td>
							</tr>
						</table>
					</td>
					<td>
						<table width = "100%">
							<tr>
								<td nowrap><strong>Fecha de Impresión</strong>: </td>
								<td style = "padding-left:10px;padding:5px;">'.date("Y-m-d").'</td>
							</tr>
							<tr>
								<td nowrap><strong>Fecha de Creación</strong>: </td>
								<td style = "padding-left:10px;">'.$fecha_registro.'</td>
							</tr>
							<tr>
								
							</tr>
						</table>
					</td>
				</tr>
				<tr>
				</tr>
			</table>';
	
	
	$contenedor_val_no_cm = '';
	$accc = 0;
	$cont = mysql_query("select ip.num_interno as y
	from itempresup ip, cecula_ppto_interno cp
	where ip.ppto = '$ppto' and cp.nombre_celula = 'VALORES NO COMISIONABLES' and ip.celula = cp.codigo_int_celula and cp.pk_ppto_interno = '$ppto'");
	if(mysql_num_rows($cont) > 0){
		$grup =mysql_query("select cp.codigo_int_celula, cp.nombre_celula
			from cecula_ppto_interno cp
			where cp.pk_ppto_interno = '$ppto' and cp.nombre_celula = 'VALORES NO COMISIONABLES' order by cp.codigo_int_celula asc");
		while($rowx = mysql_fetch_array($grup)){
			$celula = $rowx['codigo_int_celula'];
			if($pk_cliente == 1){
				$t.='<tr><th colspan ="7" align = "center">'.strtoupper($rowx['nombre_celula']).'</th></tr>
				<tr>
					<th>PROVEEDOR</th>
					<th>ITEM</th>
					<th width = "45%" >DESCRIPCIÓN</th>
					<th>VALOR UNIDAD</th>
					<th>CANTIDAD</th>
					<th>DÍAS</th>
					<th>VALOR TOTAL</th>
				</tr>';
			}else{
				$t.='<tr><th colspan ="6" align = "center">'.strtoupper($rowx['nombre_celula']).'</th></tr>
				<tr>
					<th>ITEM</th>
					<th width = "45%" >DESCRIPCIÓN</th>
					<th>VALOR UNIDAD</th>
					<th>CANTIDAD</th>
					<th>DÍAS</th>
					<th>VALOR TOTAL</th>
				</tr>';
			}
			
			
			$sql = mysql_query("select ip.asoc, ip.num_interno,i.id as codigo_item,ip.por_prov as volumen,i.name,ip.id, ip.dias, ip.q, ip.descripcion, ip.val_item, ip.fecha_ant, ip.por_ant, ip.cliente, ip.val_desde_item,
					ip.por_prov, ip.iva_item, p.nombre_legal_proveedor
					from itempresup ip, item_tarifario i,proveedores p
					where i.id = ip.pk_item and ip.ppto = '$ppto' and ip.asoc = '0'  and ip.celula ='$celula' and ip.proveedor = p.codigo_interno_proveedor order by ip.num_interno asc");
			
			
			$acum_x = 0;
			while($row = mysql_fetch_array($sql)){
				$acum_x+=$row['cliente']*$row['q']*$row['dias'];
				$acum += $row['cliente']*$row['q']*$row['dias'];
				$accc +=$row['cliente']*$row['q']*$row['dias'];
				$acumm_iva += (($row['cliente']*$row['q']*$row['dias'])*$row['iva_item'])/100;
				if($pk_cliente == 1){
					$t.='<tr>
						<td>'.$row['nombre_legal_proveedor'].'</td>
						<td>'.strtr(strtoupper($row['name']),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
						<td width = "30%">'.strtr(strtoupper($row['descripcion']),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
						<td>
							<table width = "100%" class ="internos">
								<tr>
									<td align = "left" width = "2%">$</td><td align = "right">'.number_format($row['cliente']).'</td>
								</tr>
							</table>
						</td>
						<td align = "center">'.$row['q'].'</td>
						<td align = "center">'.$row['dias'].'</td>
						<td>
							<table width = "100%" class ="internos">
								<tr>
									<td align = "left" width = "2%">$</td><td align = "right">'.number_format($row['cliente']*$row['q']*$row['dias']).'</td>
								</tr>
							</table>
						</td>
				</tr>';
				}else{
					$t.='<tr>
					<td>'.strtr(strtoupper($row['name']),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
					<td width = "30%">'.strtr(strtoupper($row['descripcion']),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
					<td>
						<table width = "100%" class ="internos">
							<tr>
								<td align = "left" width = "2%">$</td><td align = "right">'.number_format($row['cliente']).'</td>
							</tr>
						</table>
					</td>
					<td align = "center">'.$row['q'].'</td>
					<td align = "center">'.$row['dias'].'</td>
					<td>
						<table width = "100%" class ="internos">
							<tr>
								<td align = "left" width = "2%">$</td><td align = "right">'.number_format($row['cliente']*$row['q']*$row['dias']).'</td>
							</tr>
						</table>
					</td>
				</tr>';
				}
			}
			if($pk_cliente == 1){
				$t.='
					<tr class = "salto">
						<td colspan = "5"></td>
						<th >SUBTOTAL</th>
						<td style = "border:1px solid black;">
							<table width = "100%" class ="internos" style = "font-weight:bold;">
								<tr>
									<td align = "left" width = "2%">$</td><td align = "right">'.number_format($acum_x).'</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr class = "salto"><td ></br></td></tr>
					
					<tr class = "salto"><td ></br></td></tr>
					';
				
			}else{
				$t.='
					<tr class = "salto">
						<td colspan = "4"></td>
						<th >SUBTOTAL</th>
						<td style = "border:1px solid black;">
							<table width = "100%" class ="internos" style = "font-weight:bold;">
								<tr>
									<td align = "left" width = "2%">$</td><td align = "right">'.number_format($acum_x).'</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr class = "salto"><td ></br></td></tr>
					
					<tr class = "salto"><td ></br></td></tr>
					';
			}
			
		}
	}
	$contenedor_val_no_cm.='<tr class = "salto">
		<td colspan = "4"></td>
		<th NOWRAP>NO COMISIONABLES</th>
		<td style = "border:1px solid black;" >
			<table width = "100%" class ="internos" style = "font-weight:bold;">
				<tr>
					<td align = "left" width = "2%">$</td><td align = "right">'.number_format($accc).'</td>
				</tr>
			</table>
		</td>
	</tr>
	';
	$contenedor_val_no_cmx.='<tr class = "salto">
		<td colspan = "5"></td>
		<th NOWRAP>NO COMISIONABLES</th>
		<td style = "border:1px solid black;" >
			<table width = "100%" class ="internos" style = "font-weight:bold;">
				<tr>
					<td align = "left" width = "2%">$</td><td align = "right">'.number_format($accc).'</td>
				</tr>
			</table>
		</td>
	</tr>
	';
	
	$xt = '';
	if($pk_cliente == 1){
		$comision = 0;
		$xt .='<tr  class = "salto">
				<td colspan = "5"></td>
				<th >SUBTOTAL</th>
				<td style = "border:1px solid black;">
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.number_format($acumxx).'</td>
						</tr>
					</table>
				</td>
			</tr>
			'.$contenedor_val_no_cmx.'
			<tr class = "salto">
				<td colspan = "5"></td>
				<th NOWRAP>IVA</th>
				<td style = "border:1px solid black;">
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.number_format($acumm_iva).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr class = "salto">
				<td colspan = "5"></td>
				<th NOWRAP>COMISIÓN</th>
				<td style = "border:1px solid black;" >
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.number_format(0).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr class = "salto">
				<td colspan = "5"></td>
				<th NOWRAP>IVA COMISIÓN</th>
				<td style = "border:1px solid black;" >
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.number_format(0).'</td>
						</tr>
					</table>
				</td>
			</tr>
			
			<tr class = "salto">
				<td colspan = "5"></td>
				<th >TOTAL</th>
				<td style = "border:1px solid black;" >
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.
							number_format((((($acumxx*$comision)/100)*16)/100) + (($acumxx*$comision)/100) + $acumm_iva + $acum + $accc).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr class = "salto"><td ></br></td></tr>
			<tr class = "salto"><td ></br></td></tr>
			<tr class = "salto">
				<td colspan = "7" style = "text-align:justify;font-weight:bold;font-size:8px;"><strong>NOTA</strong>: '.$observaci.'</td>
			</tr>';
	}else{
		$uaai = 0;
		$comi = 0;
		$sql = mysql_query("select cc.uaai,cc.tipo, p.pk_clientes_nit_cliente 
		from cabpresup p, condiciones_cliente cc
		where p.codigo_presup = '$ppto' and p.pk_clientes_nit_cliente = cc.cliente  AND p.tipo_comision = cc.consecutivo");
		while($row = mysql_fetch_array($sql)){
			$uaai = $row['uaai'];
			$real = (100-$uaai)/100;
			if($row['tipo'] == 1){
				$comi = ($acumxx/$real)-$acumxx;
			}
			else if($row['tipo'] == 2){
				$comi = $acumxx*($uaai/100);
			}
		}
		$xt.='<tr  class = "salto">
				<td colspan = "4"></td>
				<th >SUBTOTAL</th>
				<td style = "border:1px solid black;">
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.number_format($acumxx).'</td>
						</tr>
					</table>
				</td>
			</tr>
			'.$contenedor_val_no_cm.'
			
			<tr class = "salto">
				<td colspan = "4"></td>
				<th NOWRAP>COMISIÓN</th>
				<td style = "border:1px solid black;" >
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.number_format($comi).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr class = "salto">
				<td colspan = "4"></td>
				<th NOWRAP>ANTES DE IVA</th>
				<td style = "border:1px solid black;" >
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.number_format($comi + $acumxx +$accc).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr class = "salto">
				<td colspan = "4"></td>
				<th NOWRAP>IVA</th>
				<td style = "border:1px solid black;">
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.number_format((($comi + $acumxx +$accc)*16)/100).'</td>
						</tr>
					</table>
				</td>
			</tr>
			
			<tr class = "salto">
				<td colspan = "4"></td>
				<th >TOTAL</th>
				<td style = "border:1px solid black;" >
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.
							number_format( $acumxx +  $comi + $accc+ ((($comi + $acumxx+$accc)*16)/100)).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr class = "salto"><td ></br></td></tr>
			<tr class = "salto"><td ></br></td></tr>
			<tr class = "salto">
				<td colspan = "6" style = "text-align:justify;font-weight:bold;font-size:8px;"><strong>NOTA</strong>: '.$observaci.'</td>
			</tr>';
	}
	
	
	
	
	$html = '
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
					
					#tabla_items th{
						border:1px solid black;
						border-radius:3em;
						border-radius:3mm;
						border-radius:3px;
						background-color:red;
						color:white;
						text-align:center;
						font-size:11px;
					}
					#tabla_items td{
						border:1px solid black;
						font-size:10px;
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
				</style>
			</head>
			
			<body >
			<table width = "100%" id = "tabla_items" >			
				'.$t.'
			<tr class = "salto">
				<td>
					<table width = "100%" class = "internos">
						<tr>
							<td style = "padding-bottom:20px;padding-right:10px;">FIRMA CLIENTE</td>
							<td style = "vertical-align:top;">_________________________________________________</td>
						</tr>
						<tr></tr>
						<tr>
							<td style = "padding-bottom:20px;padding-right:10px;">FECHA FIRMA</td>
							<td>_________________________________________________</td>
						</tr>
					</table>
				</td>
			</tr>
			'.$xt.'
			
			</table>
			<body>';
	//$pdf = new mPDF('utf-8', array(279,210));
	$pdf=new mPDF('en-x','Letter-L','','',20,20,47,47,5,5); 
	$pdf->mirrorMargins = true;
	$pdf->AliasNbPages();
	$pdf->SetAutoPageBreak(true, 12);
 
	
	$pdf->SetFont('Arial','B',10);
	
	$pdf->SetHTMLHeader($cabecera_pdf);
	$cb = $cabecera_pdf;
	$pdf->SetHTMLHeader($cb,'E');
	
	
	$footer = '<div style = "width:100%;font-size:10px;text-align:right;">{PAGENO}</div>';
	$footerE = '<div style = "width:100%;font-size:10px;text-align:right;">{PAGENO}</div>';
	$pdf->SetHTMLFooter($footer);
	$pdf->SetHTMLFooter($footerE,'E');
	$stylesheet = file_get_contents('ppto.css');
	$pdf->WriteHTML($stylesheet,1);
	$pdf->WriteHTML($html);

	$pdf->Output('PPTO '.$_GET['ppto'].'.pdf', 'I');
?>