<?php
	include("../Controller/Conexion.php");
	require('../mpdf/mpdf.php');
	
	
	//Obtengo las variables que vienes por la URL
	$ppto = $_GET['ppto'];
	$vi = $_GET['vi'];
	$vc = $_GET['vc'];
	
	
	$cabecera_pdf = '';
	$sql = mysql_query("select e.logo,e.nit_empresa,p.fecha_registro,c.nombre_legal_clientes, pr.nombre_producto, p.referencia,p.ot,p.numero_presupuesto, em.nombre_empleado,e.observacion,con.uaai,c.codigo_interno_cliente,p.vi,p.vc
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
	$version_interna = "";
	$version_externa = "";
	
	
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
		$version_interna = $row['vi'];
		$version_externa = $row['vc'];
	}
	
	
	
	$tabl = '<table width = "100%" class = "tabla_items" style  = "border-collapse: collaps;">
		<tr>
			<th class = "th_report"># Item</th>
			<th class = "th_report">Nombre Grupo</th>
			<th class = "th_report">Nombre Item</th>
			<th class = "th_report"># Ant.</th>
			<th class = "th_report">Valor Ant.</th>
			<th class = "th_report"># Facturas</th>
			<th class = "th_report">Valor Facturas</th>
			<th class = "th_report">Diferencia</th>
		</tr>
	';
	$array_informacion = array();
	$ix = 0;
	
	$sql_anticipos = mysql_query("select distinct pk_anticipo from legalizaciones_items where estado = '1'");
	$array_anticipos = array();
	$t = 0;
	while($row = mysql_fetch_array($sql_anticipos)){
		$array_anticipos[$t] = $row['pk_anticipo'];
		$t++;
	}
	
	
	$array_facturas = array();
	$acum_Valor_facturas = 0;
	$i_temp = 0;
	for($u = 0; $u < count($array_anticipos); $u++){
		$sql_legalizaciones = mysql_query("select p.name_item,p.name_grupo,p.num_interno,cp.porcentaje,p.dias,p.q,p.val_item
		from anticipos_ppto ap, cuerpo_anticipo cp, itempresup p
		where ap.id = '$array_anticipos[$u]' and ap.ppto = '$ppto' and ap.vi = '$vi' and ap.vc = '$vc' and ap.id = cp.pk_anticipo and cp.pk_item = p.id order by p.num_interno asc");
		
			while($row = mysql_fetch_array($sql_legalizaciones)){
				
				$sql_legalizacion = mysql_query("select *
				from legalizaciones_items
				where pk_anticipo = '$array_anticipos[$u]' and estado = '1'");
				$numero_facturas  = mysql_num_rows($sql_legalizacion);
				$valor_facturas = 0;
				while($lega = mysql_fetch_array($sql_legalizacion)){
					$valor_facturas+=$lega['valor'];
					$array_facturas[$i_temp][0] = $array_anticipos[$u];
					$array_facturas[$i_temp][1] = $lega['factura'];
					$array_facturas[$i_temp][2] = $lega['fecha_factura'];
					$array_facturas[$i_temp][3] = $lega['valor'];
					$array_facturas[$i_temp][4] = $lega['nit'];
					$array_facturas[$i_temp][5] = $lega['beneficiario'];
					$array_facturas[$i_temp][6] = $lega['direccion'];
					$array_facturas[$i_temp][7] = $lega['telefono'];
					$array_facturas[$i_temp][8] = $lega['ciudad'];
					$array_facturas[$i_temp][9] = $lega['concepto'];
					$array_facturas[$i_temp][10] = $lega['iva'];
					$array_facturas[$i_temp][11] = $lega['retencion'];
					$acum_Valor_facturas += $lega['valor'];
					$i_temp++;
				}
				$diferencia = $valor_anticipo - $valor_facturas;
				
				$porcentaje = $row['porcentaje'];
				$valor_anticipo = $porcentaje;
				
				$array_informacion[$ix][0] = $row['num_interno'];
				$array_informacion[$ix][1] = $row['name_grupo'];
				$array_informacion[$ix][2] = $row['name_item'];
				$array_informacion[$ix][3] = $array_anticipos[$u];
				$array_informacion[$ix][4] = $valor_anticipo;
				$array_informacion[$ix][5] = $numero_facturas;
				$array_informacion[$ix][6] = $valor_facturas;
				$array_informacion[$ix][7] = $diferencia;
				
				
				$ix++;
			}
	
	}
	
	$valor_ant = 0;
	for($tt = 0; $tt < count($array_informacion); $tt++){
		$num_item = "";
		$nombre_item = "";
		$nombre_grupo = "";
		$anticipo = "";
		$valor_ant = $array_informacion[$ix][4];
		$valor_anticipo = 0;
		if(count($array_informacion) == 1 && $tt == 0){
			$num_item = $array_informacion[$tt][0];
			$nombre_grupo = $array_informacion[$tt][1];
			$nombre_item = $array_informacion[$tt][2];
			$anticipo = $array_informacion[$tt][3];
		}else{
			
			//Numero de item
			$num_item = $array_informacion[$tt-1][0];
			if($num_item == $array_informacion[$tt][0]){
				$num_item = "";
			}else{
				$num_item = $array_informacion[$tt][0];
				$nombre_grupo = $array_informacion[$tt][1];
				$nombre_item = $array_informacion[$tt][2];
			}
			
			//Anticipos
			$anticipo = $array_informacion[$tt-1][3];
			if($anticipo == $array_informacion[$tt][3]){
				$anticipo = "";
				$valor_anticipo = 0;
			}else{
				$anticipo = $array_informacion[$tt][3];
				$valor_anticipo = $array_informacion[$tt][4];
			}
		}
		$dife = $array_informacion[$tt][4] -  $acum_Valor_facturas;
		$tabl.='<tr>
					<td class = "fondo_td" align = "center">'.$num_item.'</td>
					<td class = "fondo_td" align = "center">'.utf8_decode($nombre_grupo).'</td>
					<td class = "fondo_td" style = "text-align:center;">'.utf8_decode($nombre_item).'</td>
					<td class = "fondo_td" align = "center">'.$anticipo.'</td>
					<td class = "fondo_td" style = "text-align:right;">$ '.number_format($array_informacion[$tt][4]).'</td>
					<td class = "fondo_td" style = "text-align:center;">'.($i_temp).'</td>
					<td class = "fondo_td" style = "text-align:right;">$ '.number_format($acum_Valor_facturas).'</td>
					<td class = "fondo_td" style = "text-align:right;">$ '.number_format($dife).'</td>
				</tr>
			</table>
					
			<table width = "100%" class = "tabla_items">
				<tr>
					<th class = "th_report" colspan = "10"> 
						Detalle Facturas
					</th>
				</tr>
				<tr>
					<th class = "th_report">Factura</th>
					<th class = "th_report">Fecha</th>
					<th class = "th_report">Nit</th>
					<th class = "th_report">Beneficiario</th>
					<th class = "th_report">Dirección</th>
					<th class = "th_report">Teléfono</th>
					<th class = "th_report">Concepto</th>
					<th class = "th_report">Valor</th>
					<th class = "th_report">Iva</th>
					<th class = "th_report">Retención</th>
				</tr>
				';
		$acum_valor = 0;
		$acum_iva =0;
		$acum_retencion =0;
		for($x = 0; $x < count($array_facturas); $x++){
			if($anticipo == $array_facturas[$x][0]){
				$acum_valor += $array_facturas[$x][3];
				$acum_iva += $array_facturas[$x][10];
				$acum_retencion += $array_facturas[$x][11];
				$tabl.='
				<tr>
					<td class = "fondo_td" align = "center">'.$array_facturas[$x][1].'</td>
					<td class = "fondo_td">'.$array_facturas[$x][2].'</td>
					<td class = "fondo_td">'.$array_facturas[$x][4].'</td>
					<td class = "fondo_td">'.$array_facturas[$x][5].'</td>
					<td class = "fondo_td">'.$array_facturas[$x][6].'</td>
					<td class = "fondo_td" style = "text-align:right;">'.$array_facturas[$x][7].'</td>
					<td class = "fondo_td">'.nl2br(utf8_decode($array_facturas[$x][9])).'</td>
					<td class = "fondo_td" style = "text-align:right;">$ '.number_format($array_facturas[$x][3]).'</td>
					<td class = "fondo_td" style = "text-align:right;">$ '.number_format($array_facturas[$x][10]).'</td>
					<td class = "fondo_td" style = "text-align:right;">$ '.number_format($array_facturas[$x][11]).'</td>
				</tr>';
			}
		}
		$tabl.='<tr>
			<th class = "th_report" colspan = "7" align = "right">TOTAL</th>
			<th class = "th_report" style = "text-align:right;">$ '.number_format($acum_valor).'</th>
			<th class = "th_report" style = "text-align:right;">$ '.number_format($acum_iva).'</th>
			<th class = "th_report" style = "text-align:right;">$ '.number_format($acum_retencion).'</th>
		</tr>';
		
	}
	$tabl.='</table>';
	
	

	$cabecera_pdf = '
	
	<table id = "tabla_central" width = "100%" >
				<tr>
					<th align = "center" style ="padding-left:5px;vertical-align:top;">
						<img src = "../images/logos/'.$logo.'" height = "60px" />
						<p id = "nit" align = "center">NIT: '.$nit_empresa.'</p>
					</th>
					<th width = "100%"  style = "vertical-align:middle;text-align:center;" >
						<span id = "titulo">LEGALIZACIÓN ANTICIPOS</span>
						<p>INT: '.$ppto.' V '.$vi.' - EXT: '.$numero_ppto.' V '.$vc.'</p>
					</th>
				</tr>
				<tr><td></br></td></tr>
				<tr>
					<td style ="padding-left:5px;width:100%;" colspan = "2">
						<table width = "100%">
							<tr>
								<td style = "padding:5px;padding-right:50px;"><strong>CLIENTE</strong>: '.$cliente.'</td>
								
								
								<td><strong>PRODUCTO</strong>: '.$producto.'</td>
							</tr>
							<tr>
								<td style = "padding:5px;"><strong>EJECUTIVO</strong>: '.strtoupper($nombre_emp).'</td>
								
								<td style = "padding:5px;"><strong>OT</strong>: '.strtoupper($ot).'</td>
							</tr>
							<tr>
								<td style = "padding:5px;"><strong>REFERENCIA</strong>: '.(strtoupper($referencia)).'</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
				</tr>
			</table>
			';
	
	$html = '
		<head>
			<meta http-equiv="Content-Type" charset=utf-8" />
			<title>LEGALIZACIÓN</title>
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
				#titulo{
					font-size:26px;
				}
				#tabla_central{
					
				}
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
		'.$tabl.'
		</body>
	';
	
	$pdf=new mPDF('en-x','Letter-L','','',20,20,47,47,5,5); 
	$pdf->mirrorMargins = true;
	$pdf->AliasNbPages();
	$pdf->SetAutoPageBreak(true, 12);
 
	
	$pdf->SetFont('Arial','B',10);
	
	$pdf->SetHTMLHeader($cabecera_pdf);
	$cb = $cabecera_pdf;
	$pdf->SetHTMLHeader($cb,'E');
	
	
	
	$footerE = '<div style = "width:100%;font-size:10px;">
		<table style = "font-size:10px;width:100%;border-top:1px solid black;">
			<tr>
				<td nowrap style = "width:33%;text-align:left;">
					Fecha de Impresión<br></br>'.date("Y-m-d h:i:s").'
				</td>
				<td style = "width:33%;text-align:center;">
					{PAGENO}
				</td>
				<td style = "text-align:right;font-size:10px;">
					<table>
						<tr>
							<td>
								© Process Plus. Todos los derechos reservados.<br></br>
								Prohibida la reproducción total o parcial.
							</td>
							<td>
								<img src = "../images/Untitled-1-01.png" height = "20px" />
							</td>
						</tr>
					</table>
				</td>
				
			</tr>
		</table></div>';
	$pdf->SetHTMLFooter($footerE);
	$pdf->SetHTMLFooter($footerE,'E');
	$stylesheet = file_get_contents('ppto.css');
	$pdf->WriteHTML($stylesheet,1);
	$pdf->WriteHTML($html);

	$pdf->Output('LEGALIZACIÓN PPTO '.$_GET['ppto'].'.pdf', 'I');
	
?>