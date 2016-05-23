<?php

	include("../Controller/Conexion.php");
	
	$id = $_GET['id'];
	
	$sql = mysql_query("select distinct e.nombre_empleado, p.referencia,appto.id as num_anticipo, appto.fecha,appto.fecha_plata,p.codigo_presup,
	c.nombre_comercial_cliente,emp.nombre_comercial_empresa,p.ot,unn.name as unidad_negocio, emp.logo,e.documento_empleado,e.tipo_documento_empleado,emp.nombre_legal_empresa
	from pendientes_anticipos pa, anticipos_ppto appto, cabpresup p, empleado e, usuario u,clientes c, empresa emp, und unn
	where appto.id = '$id' and pa.pk_ant = appto.id and appto.ppto = p.codigo_presup and appto.user = u.idusuario and u.pk_empleado = e.documento_empleado
	and p.pk_clientes_nit_cliente = c.codigo_interno_cliente and p.empresa_nit_empresa = emp.cod_interno_empresa and
	p.ceco = unn.id");
	
	$sql_item_anticipo = mysql_query("select p.name_item,p.name_grupo,p.asoc,p.dias,p.q, prov.nombre_comercial_proveedor,cp.porcentaje,p.val_item
	from cuerpo_anticipo cp, itempresup p, proveedores prov
	where cp.pk_anticipo = '$id' and cp.pk_item = p.id and p.proveedor = prov.codigo_interno_proveedor");
	
	$th = '<table width = "100%">';
	
	$empresa = '';
	$empleado = '';
	$documento_empleado = '';
	while($row = mysql_fetch_array($sql)){
		$empresa = '<strong>'.$row['nombre_legal_empresa'].'</strong>';
		$empleado = '<strong>'.$row['nombre_empleado'].'</strong>';
		$documento_empleado = '<strong>'.$row['tipo_documento_empleado'].' '.$row['documento_empleado'].'</strong>';
		$th.='<tr>
			<th style = "vertical-align:top;" colspan = "3">
				<img src = "../images/logos/'.$row['logo'].'" height = "80px" />
			</th>
		</tr>
		<tr>
			<th colspan = "3" style = "font-size:20px">ANTICIPO # '.$id.'</th>
		</tr>
		
		<tr>
			<td><br></br><br></br></td>
		</tr>
		<tr>
			<td><br></br><br></br></td>
		</tr>
		<tr>
			<td><br></br><br></br></td>
		</tr>
		<tr>
			<td>
				<p class = "bold">Empresa:</p>
				'.$row['nombre_comercial_empresa'].'
			</td>
			<td class = "separator"></td>
			<td>
				<p class = "bold">Cliente:</p>
				'.$row['nombre_comercial_cliente'].'
			</td>
		</tr>
		<tr>
			<td>
				<p class = "bold"># OT:</p>
				'.$row['ot'].'
			</td>
			<td class = "separator"></td>
			<td>
				<p class = "bold">UNIDAD:</p>
				'.$row['unidad_negocio'].'
			</td>
		</tr>
		<tr>
			<td>
				<p class = "bold"># PRESUPUESTO:</p>
				'.$row['codigo_presup'].'
			</td>
			<td class = "separator"></td>
			<td>
				<p class = "bold">REFERENCIA PRESUPUESTO:</p>
				'.utf8_decode($row['referencia']).'
			</td>
		</tr>
		<tr>
			<td>
				<p class = "bold">SOLICITADO POR:</p>
				'.$row['nombre_empleado'].'
			</td>
			<td class = "separator"></td>
			<td>
				<p class = "bold">No. Documento:</p>
				'.($row['tipo_documento_empleado'].'  '.$row['documento_empleado']).'
			</td>
		</tr>
		<tr>
			<td>
				<p class = "bold">SOLICITADO POR:</p>
				'.$row['nombre_empleado'].'
			</td>
			<td class = "separator"></td>
			<td>
				<p class = "bold">FECHA DE SOLICITUD:</p>
				'.($row['fecha']).'
			</td>
		</tr>';
	}
	
	$th.='
		<tr>
			<td><br></br><br></br></td>
		</tr>
		<tr>
			<td><br></br><br></br></td>
		</tr>
	</table>';
	
	
	$th.='<table width = "100%">
	<tr>
			<th></th>
			<th>Grupo</th>
			<th>Item</th>
			<th>Días</th>
			<th>Cantidad</th>
			<th>Unitario</th>
			<th>Total</th>
			<th>$ Valor Sol.</th>
		</tr>';
	
	$ii = 1;
	while($row = mysql_fetch_array($sql_item_anticipo)){
		$valor_item = $row['dias']*$row['q']*$row['val_item'];
		$por = $row['porcentaje'];
		$to = $valor_item-$por;		
		$acum_total_anticipo+=$por;
		$grupo = "";
		if($row['asoc'] != 0){
			$grupo = "ASOCIADO";
		}else{
			$grupo = $row['name_grupo'];
		}
		$th.='<tr>
			<td class = "color" style = "text-align:center;">'.$ii.'</td>
			<td class = "color"> '.utf8_decode($grupo).'</td>
			<td class = "color"> '.utf8_decode($row['name_item']).'</td>
			<td class = "color" style = "text-align:center;">'.($row['dias']).'</td>
			<td class = "color" style = "text-align:center;">'.($row['q']).'</td>
			<td class = "color" style = "text-align:center;">$ '.number_format($row['val_item']).'</td>
			<td class = "color" style = "text-align:center;">$ '.number_format($valor_item).'</td>
			<td class = "color" style = "text-align:center;">'.number_format($por).'</td>
		</tr>';
		$ii++;
	}
	$th.='<tr><td style = "background-color:white;"></td></tr>';
	$th.='<tr><td colspan = "6" style = "background-color:white;"></td><th>TOTAL</th><th>'.number_format($acum_total_anticipo).'</th></tr>';
	$th.='</table>';
	
	require('../mpdf/mpdf.php');
	$html = '
		<head>
			<meta http-equiv="Content-Type" charset=utf-8" />
			<title>Anticipo No. '.$id.'</title>
			<style type="text/css">
				body{
					font-family:"Arial";
				}
				.divs_redondos{
					border-style: solid;
					border-radius: 5px 5px 5px 5px;
					background-color: #23B116;
					color:white;
					padding: 5px;
					width:20%;
					font-size:12px;
					font-weight:bold;
					float:left;
				}
				.th_report{
					background-color: rgb(217,217,217);
					color: black;
					border: 1px solid black;
					padding-left: 5px;
					padding-right: 5px;
				}
				.bold{font-weight:bold;}
				#titulo{
					font-size:26px;
				}
				#tabla_central{
					
				}
				
				.color{background-color:#EDEDED;font-size:12px;}
				.fondo_td{
					background-color: #EDEDED;
				}
				
				#tabla_items th{
					border:1px solid black;
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
				.cuarto{
					width:200px;
					background-color:green;
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
				.tabla_items th{
					border:1px solid white;
					color:black;
					text-align:center;
					font-size:11px;
				}
				.tabla_items td{
					border:1px solid white;
					font-size:10px;
				}
			</style>
		</head>
		<body>
		'.$th.'
		
		</body>
	';
	
	$pdf=new mPDF('en','Letter','','',20,20,20,20,5,5); 
	$pdf->mirrorMargins = true;
	$pdf->AliasNbPages();
	$pdf->SetAutoPageBreak(true, 12);
 
	
	$pdf->SetFont('Arial','B',10);
	
	$pdf->SetHTMLHeader($cabecera_pdf);
	$cb = $cabecera_pdf;
	$pdf->SetHTMLHeader($cb,'E');
	
	
	$footer = '<div style = "width:100%;font-size:10px;text-align:justify;"><p style = "text-align:justify;">Yo,  '.$empleado.' autorizo a '.$empresa.' para descontar de mi salario y/o prestaciones sociales u otro derecho laboral que me llegue a corresponder, la suma que he recibido en razón de ANTICIPO, en caso de no legalizarlo oportunamente según lo dispuesto en el procedimiento para solicitar y legalizar anticipos el cual declaro conocer suficientemente.</p>{PAGENO}</div>';
	$footerE = '<div style = "width:100%;font-size:10px;text-align:justify;"><p style = "text-align:justify;">Yo,  '.$empleado.' autorizo a '.$empresa.' para descontar de mi salario y/o prestaciones sociales u otro derecho laboral que me llegue a corresponder, la suma que he recibido en razón de ANTICIPO, en caso de no legalizarlo oportunamente según lo dispuesto en el procedimiento para solicitar y legalizar anticipos el cual declaro conocer suficientemente.</p>{PAGENO}</div>';
	$pdf->SetHTMLFooter($footer);
	$pdf->SetHTMLFooter($footerE,'E');
	$stylesheet = file_get_contents('ppto.css');
	$pdf->WriteHTML($stylesheet,1);
	$pdf->WriteHTML($html);

	$pdf->Output('ANTICIPO no. '.$_GET['id'].'.pdf', 'I');
?>