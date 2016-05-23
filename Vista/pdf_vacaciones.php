<?php
	include("../Controller/Conexion.php");
	require('../mpdf/mpdf.php');
	
	$empresa = 2;
	
	$est = '<table width = "100%" class = "lista">
		<tr>
			<th></th>
			<th >CÉDULA</th>
			<th>NOMBRE EMPLEADO</th>
			<th># DÍAS</th>			
		</tr>
	';
	$sql = mysql_query("select v.dias, e.documento_empleado, e.nombre_empleado
	from empleado e, vacaciones v
	where e.pk_empresa = $empresa and e.documento_empleado = v.cedula order by e.nombre_empleado asc");
	$i = 1;
	$estx="";
	$val = mysql_num_rows($sql);
	while($row = mysql_fetch_array($sql)){
		
		if($i < $val){
			$estx.='<tr>
				<td data-dep="1" style = "border-left:0px;">'.$i.'</td>
				<td data-dep="2" style = "padding-left:10px;">'.$row['documento_empleado'].'</td>
				<td data-dep="3" style = "padding-left:10px;">'.$row['nombre_empleado'].'</td>
				<td data-dep="4" align = "center" style = "border-right:0px;">'.number_format($row['dias']).'</td>
			</tr>';
		}else{
			$estx.='<tr>
				<td data-dep="1" style = "border-left:0px;border-bottom:0px;">'.$i.'</td>
				<td data-dep="2" style = "padding-left:10px;border-bottom:0px;">'.$row['documento_empleado'].'</td>
				<td data-dep="3" style = "padding-left:10px;border-bottom:0px;">'.$row['nombre_empleado'].'</td>
				<td data-dep="4" align = "center" style = "border-right:0px;border-bottom:0px;">'.number_format($row['dias']).'</td>
			</tr>';
		}
		
		
		$i++;
	}
	$est.="</table>";
	$html = '	<style type="text/css">
					
					body{
						font-family:"Arial";
					}
					.redondo{
						border:0.1mm solid #220044; 
						border-radius: 2mm;
						background-clip: border-box;
					}
					#titulo{
						font-size:26px;
					}
					#tabla_central{
						border:1px solid black;
					}
					.lista{
						border-collapse: collapse;
					}
					.lista th{
						
						padding:5px;
						font-size:13px;
					}
					
					.lista td{
						border:1px solid black;
						font-size:12px;
					}
					
				</style>
			<body>
				<table  width = "100%">
					<tr>
						<th align = "center" style ="padding-left:5px;vertical-align:top;">
							<img src = "../images/Untitled-1-01.png" height = "60px" />
						</th>
					</tr>
					<tr>
						<td style ="padding-left:5px;">
							<p>Listado de las vacaciones pendientes de los empleados:</p>
						</td>
					</tr>
					<tr>
					</tr>
				</table>
				</br>
				</br>
				<div class = "redondo">
					<table width = "80%" class = "lista">
						<tr >
							<th id = "1" ></th>
							<th id = "2">CÉDULA</th>
							<th id = "3">NOMBRE EMPLEADO</th>
							<th id = "4"># DÍAS</th>			
						</tr>
						'.$estx.'
					</table>
				</div>
			</body>';
	
	
	$pdf = new mPDF('utf-8', array(279,210));
	$pdf->AliasNbPages();
	$pdf->SetAutoPageBreak(true, 12);
 
	$pdf->AddPage("P");
	$pdf->SetFont('Arial','B',10);

	$pdf->WriteHTML($html);
	//$mpdf->WriteHTML('<pagebreak resetpagenum="1" pagenumstyle="a" suppress="off" />');

	$pdf->Output('LIBRO VACACIONES '.$_GET['ppto'].'.pdf', 'I');
?>