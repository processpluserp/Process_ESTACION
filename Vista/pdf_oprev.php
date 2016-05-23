<?php
	include("../Controller/Conexion.php");
	require('../mpdf/mpdf.php');
	require('../Modelo/cabecera_ot.php');
		
	$otn = new cabecera_ot();
	$op = $_GET['op'];
	$sql = mysql_query("select ox.codigo_interno_op, p.ot, p.referencia, ox.fecha_orden, e.nombre_empleado as ejecutivo, p.empresa_nit_empresa,emp.logo,emp.nombre_legal_empresa,emp.nit_empresa,p.codigo_presup,
	cl.codigo_interno_cliente, cl.nombre_legal_clientes, pr.nombre_producto, p.numero_presupuesto, emp.nota_orden_c, proo.nombre_legal_proveedor,proo.nit_proveedor, fpa.name_forma_pago, ox.fecha_entrega
	
	from cabpresup p, detalle_orden do, orproduccion ox, empleado e, usuario u, empleado e2, usuario u2, cabot ot, empresa emp, clientes cl, producto_clientes pr, proveedores proo,
	fpago fpa
	where ox.ppto = p.codigo_presup and do.noorden = ox.codigo_interno_op and ot.codigo_ot = p.ot and ot.ejecutivo = u.idusuario and u.pk_empleado = e.documento_empleado and
	p.usuario = u2.idusuario and u2.pk_empleado = e2.documento_empleado and ox.codigo_interno_op = '$op'
	and p.empresa_nit_empresa = emp.cod_interno_empresa and p.pk_clientes_nit_cliente = cl.codigo_interno_cliente and ot.producto_clientes_codigo_PRC = pr.id_procliente
	and ox.proveedor = proo.codigo_interno_proveedor and ox.fpago = fpa.codigo_interno");
	$logo = "";
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
	$num_ext_cliente = "";
	
	while($row  = mysql_fetch_array($sql)){
		$logo = $row['logo'];
		$cod_cliente = $row['codigo_interno_cliente'];
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
		$num_ext_cliente = $row['numero_presupuesto'];
		$nombre_emp = $row['ejecutivo'];
		$observaci = $row['nota_orden_c'];
		$proveedor = $row['nombre_legal_proveedor'];
		$nit_prove = $row['nit_proveedor'];
		
		break;
	}
	
	
	
	
	$t='';		
	$acum = 0;
		
	$sql = mysql_query("select p.id,p.descripcion,p.dias,p.q,p.val_item,p.iva_item,p.por_prov
		from itempresup p 
		where p.pk_orden = '$op'");
		
	$sql2 = mysql_query("select p.id,p.descripcion,p.dias,p.q,p.val_item,p.iva_item,p.por_prov,cp.codigo_int_celula
		from itempresup p , cecula_ppto_interno cp
		where p.ppto = cp.pk_ppto_interno and p.ppto = '$numero_ppto' and p.pk_orden = '$op' order by cp.codigo_int_celula asc");
	$acum_x = 0;
	$iva_cum = 0;
	$antes_iva = 0;
	while($row = mysql_fetch_array($sql)){
		$temp = 0;
		if($cod_cliente == 1){
			$acum_x +=  (($row['iva_item']*$row['val_item']*$row['dias']*$row['q'])/100) + ($row['val_item']*$row['q']*$row['dias']); 
			$antes_iva += $row['val_item']*$row['dias']*$row['q'];
			$acum += $row['val_item']*$row['q']*$row['dias'];
			$iva_cum +=($row['iva_item']*$row['val_item']*$row['dias']*$row['q'])/100;
		}else{
			$temp = ($row['val_item']*$row['por_prov'])/100;
			$acum_x +=  (($row['iva_item']*($row['val_item']-$temp)*$row['dias']*$row['q'])/100) + (($row['val_item']-$temp)*$row['q']*$row['dias']); 
			$antes_iva += ($row['val_item']-$temp)*$row['dias']*$row['q'];
			$acum +=($row['val_item']-$temp)*$row['q']*$row['dias'];
			$iva_cum +=($row['iva_item']*($row['val_item']-$temp)*$row['dias']*$row['q'])/100;
		}
		
		$t.='<tr>
			<td align = "center">'.$row['dias']*$row['q'].'</td>
			<td>'.strtr(strtoupper($row['descripcion']),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
			<td>
				<table width = "100%" class ="internos">
					<tr>
						<td align = "left" >$</td><td align = "right">'.number_format($row['val_item']-$temp,2,'.',',').'</td>
					</tr>
				</table>
			</td>
			<td>
				<table width = "100%" class ="internos">
					<tr>
						<td align = "left" >$</td><td align = "right">'.number_format($row['val_item']*$row['dias']*$row['q'],2,'.',',').'</td>
					</tr>
				</table>
			</td>
			<td align = "center">'.number_format($row['iva_item']).'</td>
			<td>
				<table width = "100%" class ="internos">
					<tr>
						<td align = "left" >$</td><td align = "right">'.number_format(($row['iva_item']*($row['val_item']-$temp)*$row['dias']*$row['q'])/100,2,'.',',').'</td>
					</tr>
				</table>
			</td>
			<td>
				<table width = "100%" class ="internos">
					<tr>
						<td align = "left" width = "2%">$</td><td align = "right">'.number_format( (($row['iva_item']*($row['val_item']-$temp)*$row['dias']*$row['q'])/100)+(($row['val_item']-$temp)*$row['dias']*$row['q']),2,'.',',').'</td>
					</tr>
				</table>
			</td>
		</tr>';
	}
		$t.='
		<tr class = "salto">
			<td colspan = "5"></td>
			<th >TOTAL</th>
			<td style = "border:1px solid black;">
				<table width = "100%" class ="internos" style = "font-weight:bold;">
					<tr>
						<td align = "left" width = "2%">$</td><td align = "right">'.number_format($acum_x,2,'.',',').'</td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr class = "salto"><td ></br></td></tr>
		
		<tr class = "salto"><td ></br></td></tr>
		';
	
	///////REVISADO
	
	$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>PPTO</title>

				<style type="text/css">
					
					body{
						font-family:"Arial";
					}
					
			////////		
		
			.footerText{
				font-size:2 ;
			}
			
			
			.header{
				width:100%;
				border: 1px solid black;
				padding:2px;
				//margin-top:2px;
				border-top-color:white;
				border-bottom-color:white;
			}
			
			.header1{
				border-radius:3px 3px 0px 0px;
				border-top-color:black;;
			}
			.header2{
				border-radius:0px 0px 3px 3px;
				border-bottom-color:black;
			}
			
			.headTopItem{
				
				float:left;
				text-align:center;
			}
			
			
			.headTopItem1{
				margin:2px;
				width:19%;
			}
			
			.headTopItem2{
				width:60%;
				font-size:24px;
				padding-top:16px;
			}
			
			.headTopItem3{
				width:19%;
				float:right;
				margin-right:4px;
			}
			.headerWrapper{
				//width:50%;
				float:left;
			}
			.class0{
				width:49%;
			}
			.class1{
				width:49%;
			}
			.headerItem{
				float:left;
				padding:1px;
				padding-left:6px;
				margin:3px;
				margin-top:1px;
				margin-bottom:1px;
			}
			.headerItem1{
				background-color:#298cda;
				width:25%;
				color:white;
				border-radius:6px;
			}
			.headerItem2{
				width73%;
			}
			
			
			////////
					
					#titulo{
						font-size:26px;
					}
					#tabla_central{
						border:1px solid black;
					}
					.tabla_items th{
						border:1px solid black;
						border-radius:3em;
						border-radius:3mm;
						border-radius:3px;
						background-color:#0090FF;
						color:white;
						text-align:center;
						font-size:11px;
						padding:4px;
					}
					.tabla_items td{
						border:1px solid black;
						font-size:10px;
						padding:2px;
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
						margin-top: 2.54cm;
						margin-bottom: 2.54cm;
						margin-left: 3.175cm;
						margin-right: 3.175cm;
					}
				</style>
			</head>
			<body>
			
			<table class = "tabla_items">
				<tr>
					<th colspan = "2">CONDICIONES DE ENTREGA</th>
				</tr>
				<tr>
					<td>
						<strong>FORMA DE PAGO</strong>
					</td>
					<td>
						'.$pago_a.'
					</td>
				</tr>
				<tr>
					<td>
						<strong>FECHA DE ENTREGA</strong>
					</td>
					<td>
						'.$fecha_entrega.'
					</td>
				</tr>
				<tr>
					<td>
						<strong>LUGAR</strong>
					</td>
					<td>
					
					</td>
				</tr>
				<tr class = "salto"><td ></br></td></tr>
				
				<tr class = "salto"><td ></br></td></tr>
			</table>
			<table width = "100%" class = "tabla_items" style = "border-collapse: collapse;">			
				<tr>
					<th nowrap>CANTIDAD</th>
					<th width = "40%" nowrap>DESCRIPCIÓN</th>
					<th nowrap>VALOR UNIDAD</th>
					<th nowrap>SUBTOTAL</th>
					<th nowrap>IVA %</th>
					<th nowrap>VALOR IVA</th>
					<th nowrap>VALOR TOTAL</th>
				</tr>
				<tr></tr>
				'.$t.'
				
				<tr class = "salto"><td ></br></td></tr>
				
				<tr class = "salto"><td ></br></td></tr>
				<tr class = "salto">
					<td colspan = "5"></td>
					
					<th style = "border:1px solid black;" >
						<strong>SUBTOTAL</strong>
					</th>
					<td style = "border:1px solid black;">
						<table width = "100%">
							<tr>
								<td align = "left" width = "2%">$</td>
								<td align = "right"><strong>'.number_format($antes_iva).'</strong></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class = "salto">
					<td colspan = "5"></td>
					
					<th style = "border:1px solid black;" >
						<strong>IVA</strong>
					</th>
					<td style = "border:1px solid black;">
						<table width = "100%">
							<tr>
								<td align = "left" width = "2%">$</td>
								<td align = "right"><strong>'.number_format($iva_cum).'</strong></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class = "salto">
					<td colspan = "5"></td>
					
					<th style = "border:1px solid black;" >
						<strong>TOTAL</strong>
					</th>
					<td style = "border:1px solid black;">
						<table width = "100%">
							<tr>
								<td align = "left" width = "2%">$</td>
								<td align = "right"><strong>'.number_format($antes_iva+$iva_cum).'</strong></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<tr class = "salto">
				<td>
					<table  style = "font-size:12px;">
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
			</body>
		</html>';
		
	
			
			

			$infoHeaderTmp[]='<img  src = "../images/Untitled-1-01.png" height="60px" />';
									
			$infoHeaderTmp[]='ORDEN DE COMPRA # '.$op;
			
			$infoHeaderTmp[]='<img height="60px" src = "../images/logos/'.$logo.'" />';
			
			$infoHeaderTmp[]='NIT: '.$nit_empresa;
			
			
			$infoHeader[]=$infoHeaderTmp;
			
			
			
			$infoHeaderTmp=array();
			
			
			$infoHeaderTmp[]='PRESUPUESTO:';
			$infoHeaderTmp[]=strtr(strtoupper($referencia),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");
			
			
			$itemTmp[]=$infoHeaderTmp;
			$infoHeaderTmp=array();
			
			
			
			$infoHeaderTmp[]='PROVEEDOR:';
			$infoHeaderTmp[]=$proveedor;
			
			$itemTmp[]=$infoHeaderTmp;
			$infoHeaderTmp=array();
			
			
			$infoHeaderTmp[]='CLIENTE:';
			$infoHeaderTmp[]=strtoupper($cliente);
			
			$itemTmp[]=$infoHeaderTmp;
			$infoHeaderTmp=array();
			
			
			
			$infoHeaderTmp[]='NIT:';
			$infoHeaderTmp[]=$nit_prove;
			
			$itemTmp[]=$infoHeaderTmp;
			$infoHeaderTmp=array();
			
			
			
			$infoHeaderTmp[]='OT:';
			$infoHeaderTmp[]=$ot;
			
			$itemTmp[]=$infoHeaderTmp;
			$infoHeaderTmp=array();
			
			
			$infoHeaderTmp[]='FECHA DE CREACIÓN:';
			$infoHeaderTmp[]=date("Y-m-d");
			
			$itemTmp[]=$infoHeaderTmp;
			$infoHeaderTmp=array();
			
			
			
			$infoHeaderTmp[]='PRODUCTO:';
			$infoHeaderTmp[]=strtoupper($producto);
			
			$itemTmp[]=$infoHeaderTmp;
			$infoHeaderTmp=array();
			
			
			$infoHeaderTmp[]='FECHA DE IMPRESIÓN:';
			$infoHeaderTmp[]=date("Y-m-d");
			
			$itemTmp[]=$infoHeaderTmp;
			$infoHeaderTmp=array();
			
			
			$infoHeaderTmp[]='AG - CL:';
			$infoHeaderTmp[]=$numero_ppto.' - '.$num_ext_cliente;
			
			$itemTmp[]=$infoHeaderTmp;
			$infoHeaderTmp=array();
			
			
			
			$infoHeaderTmp[]='CREADO POR:';
			$infoHeaderTmp[]='PAOLA PAEZ';
			
			$itemTmp[]=$infoHeaderTmp;
			$infoHeaderTmp=array();
			
			
			
			
			
			
			
			$infoHeader[]=$itemTmp;
			
			
			function createHeader($vectorData){
				
				
				$outputText='<div class="header header1">';
				
				$outputText.= '<div class="headTopItem headTopItem1">'.$vectorData[0][0].'<br>';
				
				$outputText.= '</div>';

				$outputText.= '<div class="headTopItem headTopItem2">'.$vectorData[0][1].'</div>';

				$outputText.= '<div class="headTopItem headTopItem3">'.$vectorData[0][2].'<br>';

				$outputText.= $vectorData[0][3].'</div>';
								
				$outputText.='</div>';
				
				$outputText.='<div class="header header2">';
				
				$classSelector=0;
				
				foreach($vectorData[1] as $itemData){
				
				
				
				$outputText.='<div class="headerWrapper class'.$classSelector.'">';
				
				$outputText.='<div class="headerItem headerItem1">'.$itemData[0].'</div>';
				
				$outputText.='<div class="headerItem headerItem2">'.$itemData[1].'</div>';
				
				$outputText.='</div>';
				
				if($classSelector==0)$classSelector=1;else $classSelector=0;
				
				}
				
				
				return $outputText.'</div>';
				
			}
				
		
		
			
	
	$headerHTML=createHeader($infoHeader);
		
	$footerHTML='<div class="footerText" ><font size="2"><strong>'.$observaci.'</strong></font></div><div style="text-align:right" >{PAGENO}</div>';	
	
	$pdf = new mPDF('utf-8', array(279,210), '7', 'Arial', '15','15','60','30','10','15');

	$pdf->SetHTMLHeader($headerHTML);

	$pdf->SetHTMLFooter($footerHTML);
			
	$pdf->WriteHTML($html);
		
		/*
	$pdf = new mPDF('utf-8', array(279,210));
	$pdf->AliasNbPages();
	$pdf->SetAutoPageBreak(true, 12);
 
	$pdf->AddPage("P");
	$pdf->SetFont('Arial','B',10);
	$stylesheet = file_get_contents('ppto.css');
	$pdf->WriteHTML($stylesheet,1);
	$pdf->WriteHTML($html);
	//$mpdf->WriteHTML('<pagebreak resetpagenum="1" pagenumstyle="a" suppress="off" />');
*/
	$pdf->Output('OC 1.pdf', 'I');
?>