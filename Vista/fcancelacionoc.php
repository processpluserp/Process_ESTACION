<?php
	include("../Controller/Conexion.php");
	include("host.php");
	require('../mpdf/mpdf.php');
	require('../Modelo/cabecera_ot.php');
	
	$otn = new cabecera_ot();
	

	
	
	$ppto = $_GET['ppto'];
	$oc = $_GET['oc'];
	$logo_empresa = mysql_query("select e.logo,e.nombre_legal_empresa,e.nit_empresa 
	from empresa e, cabpresup p
	where e.cod_interno_empresa = p.empresa_nit_empresa and p.codigo_presup = '$ppto'");
	$logo = "";
	$nombre_empresa = "";
	$nit_empresa = "";
		
	while($row  = mysql_fetch_array($logo_empresa)){
		$logo = $row['logo'];
		$nombre_empresa = $row['nombre_legal_empresa'];
		$nit_empresa = $row['nit_empresa'];
		$img_logo = '<img src = "'.$hosstt.'/images/logos/'.$logo.'" height = "80px"/>';
	}
	
	$nombre_proveedor = "";
	$telefono_proveedor = "";
	$direccion_proveedor ="";
	$razon = "";
	$empleado = "";
	$cargo = "";
	$sql_pro = mysql_query("select p.nombre_legal_proveedor, p.direccion_proveedor,p.telefono_proveedor,op.razon_cancelacion,e.nombre_empleado, e.cargo_empleado
	from proveedores p, orproduccion op, usuario u, empleado e
	where op.codigo_interno_op = '$oc' and op.proveedor = p.codigo_interno_proveedor and 
	op.usercancelacion = u.idusuario and u.pk_empleado = e.documento_empleado");
	while($row = mysql_fetch_array($sql_pro)){
		$nombre_proveedor = $row['nombre_legal_proveedor'];
		$telefono_proveedor = $row['telefono_proveedor'];
		$direccion_proveedor = $row['direccion_proveedor'];
		$razon = utf8_decode($row['razon_cancelacion']);
		$empleado = utf8_decode($row['nombre_empleado']);
		$cargo = $row['cargo_empleado'];
	}
	
	
	$est = '';
	
	$est.='<table width = "100%" style = "font-color:black;">
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
		
		<br></br>
		<br></br>
		<br></br>
		<p style = "font-family:Arial;">Bogotá D.C, '.date("Y-m-d").'</p>
		
		<br></br>
		
		<p style = "font-family:Arial;font-weight:bold;">Señores:</p>
		<p style = "font-family:Arial;font-weight:bold;">'.$nombre_proveedor.'</p>
		<p style = "font-family:Arial;font-weight:bold;">Dirección: '.$direccion_proveedor.'</p>
		<p style = "font-family:Arial;font-weight:bold;">Tel.: '.$telefono_proveedor.'</p>
		
		
		<br></br>
		
		<p style = "font-family:Arial;">De manera atenta me permito hacer la cancelación de la Orden No '.$oc.' porque <br></br>'.nl2br(utf8_encode($razon)).'</p>
		
		<br></br>
		<p style = "font-family:Arial;">Gracias por la atención prestada.</p>
		
		<br></br>
		<p style = "font-family:Arial;">Cordialmente</p>
		<p style = "font-family:Arial;">'.$empleado.'</p>
		<p style = "font-family:Arial;">'.$cargo.'</p>
		';
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