<?php
	include("../Controller/Conexion.php");
	require('../mpdf/mpdf.php');
	require('../Modelo/cabecera_ot.php');
	
	$otn = new cabecera_ot();
	

	
	
	$ot = $_GET['ot'];
	$id = $_GET['e'];
	$logo_empresa = mysql_query("select e.logo,e.nombre_legal_empresa,e.nit_empresa 
	from empresa e, datos_ie ie, cabot ot 
	where e.cod_interno_empresa = ot.pk_nit_empresa_ot and ie.ot = '$ot' and ie.ot = ot.codigo_ot");
	$logo = "";
	$nombre_empresa = "";
	$nit_empresa = "";
	$nombre_cliente = "";

	$sql = mysql_query("select c.nombre_legal_clientes
	from clientes c, cabot t
	where t.codigo_ot = '$ot' and t.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente");
	while($row = mysql_fetch_array($sql)){
		$nombre_cliente .=$row['nombre_legal_clientes'];
	}
	
	while($row  = mysql_fetch_array($logo_empresa)){
		$logo = $row['logo'];
		$nombre_empresa = $row['nombre_legal_empresa'];
		$nit_empresa = $row['nit_empresa'];
		$img_logo = '<img src = "../images/logos/'.$logo.'" height = "80px"/>';
	}
	$sql = mysql_query("select * from datos_ie where id_ie = '$id'");
	$est = '';
	while($row = mysql_fetch_array($sql)){
		$empresax = '';
		$clientex = "";
		$ee = explode("<***+++>",$row['asistentes_agencia']);
		for($i = 0;$i < count($ee)-1;$i++){
			$empresax.='<li style = "font-family:Arial;">'.strtoupper($ee[$i]).'</li>';
		}
		$ee = explode("<***+++>",$row['asistentes_cliente']);
		for($i = 0;$i < count($ee)-1;$i++){
			$clientex.='<li style = "font-family:Arial;">'.strtoupper($ee[$i]).'</li>';
		}
		$list_agencia = '';
		$ee = explode("<***+++x>",$row['comp_agencia']);
		for($i = 0;$i < count($ee)-1;$i++){
			$info = explode("<***+++>",$ee[$i]);
			$list_agencia.='<tr><td style = "font-family:Arial;border:1px solid black;border-left:0px;padding-left:10px;padding-right:10px;text-align:left;" >'.($info[1]).'</td><td nowrap = "nowrap" style = "font-family:Arial;border:1px solid black;padding-left:10px;padding-right:10px;">'.($info[2]).'</td><td align = "justify" style = "font-family:Arial;border:1px solid black;padding-left:10px;padding-right:10px;" colspan = "2">'.nl2br($info[3]).'</td></tr>';
		}
		$list_agencia .="";
		
		
		$list_cliente = '';
		$ee = explode("<***+++x>",$row['comp_cliente']);
		for($i = 0;$i < count($ee)-1;$i++){
			$info = explode("<***+++>",$ee[$i]);
			$list_cliente.='<tr><td style = "border:1px solid black;width:20%;border-left:0px;padding-left:10px;padding-right:10px;">'.($info[0]).'</td><td nowrap = "nowrap" style = "width:20%;border:1px solid black;padding-left:10px;padding-right:10px;">'.($info[1]).'</td><td align = "justify" style = "width:60%;border:1px solid black;border-right:0px;padding-left:10px;padding-right:10px;" colspan = "2">'.nl2br($info[2]).'</td></tr>';
		}
		$list_cliente .="";
		
		
		
		$list_temas = '';
		$ee = explode("<***+++>",$row['temas']);
		for($i = 0;$i < count($ee)-1;$i++){
			$info = explode("<***+++>",$ee[$i]);
			$list_temas.='<tr><td style = "border:1px solid black;width:20%;border:0px;padding-left:10px;">'.nl2br($info[0]).'</td></tr>';
		}
		
		$est.='
			<table width = "100%" style = "font-color:black;">
			<tr> 
				<td width = "100%" align = "center" colspan = "4">
					'.$img_logo.'
				</td>
			</tr>
			<tr>
				<td align = "center" colspan = "4">
					<span style = "font-size:28;color:black;font-family:Arial;font-weight: 900;">'.$row['name'].'</span>
				</td>
			</tr>
		</table>
		<div class = "redondo" style = "padding-left:15px;">
			<table width = "100%" >
				<tr>
					<td></br></td>
				</tr>
				<tr>
					<td></br></td>
				</tr>
				<tr>
					<td >
						<p style = "font-family:Arial;"><strong>Cliente:</strong></p>
					</td>
					<td colspan = "3">
						<span style = "font-family:Arial;">'.$nombre_cliente.'</span>
					</td>
				</tr>
				<tr>
					<td></br></td>
				</tr>
				<tr>
					<td></br></td>
				</tr>
				<tr>
					<td  >
						<p style = "font-family:Arial;"><strong>Fecha:</strong></p>
					</td>
					<td>
						<span style = "font-family:Arial;">'.$row["fecha_reunion"].'</span>
					</td>
					<td  >
						<p style = "font-family:Arial;"><strong>Lugar:</strong></p>
					</td>
					<td>
						<span style = "font-family:Arial;">'.strtoupper($row["lugar_reunion"]).'</span>
					</td>
				</tr>
				<tr>
					<td></br></td>
				</tr>
				<tr>
					<td></br></td>
				</tr>
				<tr>
					<td >
						<p style = "font-family:Arial;"><strong>Tipo de reunión:</strong></p>
					</td>
					<td>
						<span style = "font-family:Arial;">'.$row["tipo_reunion"].'</span>
					</td>
				</tr>
				<tr>
					<td></br></td>
				</tr>
				<tr>
					<td></br></td>
				</tr>
				<tr>
					<td >
						<p  style = "font-family:Arial;"><strong>Hora inicio:</strong></p>
					</td>
					<td>
						<span style = "font-family:Arial;">'.$row["hora_inicio"].'</span>
					</td>
					<td >
						<p style = "font-family:Arial;"><strong>Hora culminación:</strong></p>
					</td>
					<td>
						<span style = "font-family:Arial;">'.$row["hora_fin"].'</span>
					</td>
				</tr>
				<tr>
					<td></br></td>
				</tr>
				<tr>
					<td></br></td>
				</tr>
				<tr>
					<td></br></td>
				</tr>
				<tr>
					<td></br></td>
				</tr>
				<tr>
					<td colspan = "2" style = "font-family:Arial;vertical-align:top;">
						<p style = "font-family:Arial;"><strong>Asistentes Agencia e Interesados:</strong></p>
						<ul style = "font-family:Arial;">'.$empresax.'</ul>
					</td>
					<td colspan ="2" style = "font-family:Arial;padding-left:10px;vertical-align:top;">
						<p style = "font-family:Arial;"><strong>Asistentes Cliente:</strong></p>
						<ul style = "font-family:Arial;">'.$clientex.'</ul>
					</td>
				</tr>
				<tr>
					<td></br></td>
				</tr>
				<tr>
					<td></br></td>
				</tr>
			</table>
		</div>
		</br>
		</br>
			
	<div class = "redondo" >
		<div class = "redondo" style = "font-family:Arial;text-align:center;font-weight:bold;background-color:#23B116;color:white;padding:5px;">
			NOTA
		</div>
		</br>
		</br>
		<table width = "100%">
			<tr>
				<td style = "font-family:Arial;padding-left:10px;text-align:justify;">
					<strong >Después de 24 horas de recibir este correo, sino hay respuesta por parte del Cliente, se entenderá que no hay ninguna observación al respecto.</strong>
				</td>
			</tr>
			<tr>
				<td></br></td>
			</tr>
			<tr>
				<td></br></td>
			</tr>
		</table>
	</div>
	</br>
	</br>
	<div class = "redondo">
		<div class = "redondo" style = "font-family:Arial;text-align:center;font-weight:bold;background-color:#23B116;color:white;padding:5px;">
			INFORMACIÓN GENERAL
		</div>
		</br>
		</br>
		<table width = "100%">
			<tr>
				<td colspan = "4" style = "font-family:Arial;text-align:justify;padding-left:10px;">
					'.nl2br($row['inf_general']).'
				</td>
			</tr>
			<tr>
				<td></br></td>
			</tr>
			<tr>
				<td></br></td>
			</tr>
		</table>
	</div>
	</br>
	</br> 
	<div class = "redondo">
		<div class = "redondo" style = "font-family:Arial;text-align:center;font-weight:bold;background-color:#23B116;color:white;padding:5px;">
			TEMAS TRATADOS
		</div>
		</br>
		</br>
		
		<table width = "100%" style = "font-family:Arial;text-align:justify;">
			'.$list_temas.'			
			<tr>
				<td></br></td>
			</tr>
			<tr>
				<td></br></td>
			</tr>
		</table>
	</div>
	</br>
	</br>
	<div class = "redondo">
		<div class = "redondo" style = "font-family:Arial;text-align:center;font-weight:bold;background-color:#23B116;color:white;padding:5px;">
			COMPROMISOS AGENCIA
		</div>
		</br>
		</br>
		<table width = "100%" style = "font-family:Arial;text-align:justify;">
			<tr>
				<th nowrap>NOMBRE</th>
				<th>FECHA</th>
				<th colspan = "2">COMPROMISO</th>
			</tr>
			<tr>
				<td>
					'.$list_agencia.'
				</td>
			</tr>
			<tr>
				<td></br></td>
			</tr>
			<tr>
				<td></br></td>
			</tr>
		</table>
	</div>
	</br>
	</br>
	<div class = "redondo" >
		<div class = "redondo" style = "font-family:Arial;text-align:center;font-weight:bold;background-color:#23B116;color:white;padding:5px;">
			COMPROMISOS CLIENTE
		</div>
		</br>
		</br>
		<table width = "100%" style = "font-family:Arial;text-align:justify;">
			<tr>
				<th nowrap>NOMBRE</th>
				<th>FECHA</th>
				<th colspan = "2">COMPROMISO</th>
			</tr>
			'.$list_cliente.'
			<tr>
				<td></br></td>
			</tr>
			<tr>
				<td></br></td>
			</tr>
		</table>
	</div>
	';
	}
	$html = '
		<style type="text/css">
			.redondo{
				border:0.1mm solid #220044; 
				border-radius: 2mm;
				background-clip: border-box;
			}
			table{
				border-collapse: collapse;
			}
		</style>
			'.$est;

	$pdf=new mPDF('en-x','Letter','','',15,15,10,10,5,5); 
	$pdf->mirrorMargins = true;
	
	$pdf->SetAutoPageBreak(true, 12);
	$pdf->SetFont('Arial','B',10);
	
	$footer = '<div style = "width:100%;font-size:10px;text-align:right;">{PAGENO}</div>';
	$footerE = '<div style = "width:100%;font-size:10px;text-align:right;">{PAGENO}</div>';
	$pdf->SetHTMLFooter($footer);
	$pdf->SetHTMLFooter($footerE,'E');
	
	$stylesheet = file_get_contents('p1.css');
	$pdf->WriteHTML($stylesheet,1);
	$pdf->WriteHTML($html);
	

	$pdf->Output('INFORME OT '.$_GET['ot'].'.pdf', 'I');
?>