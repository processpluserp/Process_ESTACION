<?php
	include("../Controller/Conexion.php");
	//require_once('../tcpdf/config/lang/eng.php');
	require('../mpdf/mpdf.php');
	
	
	$pdf = new mPDF('utf-8', array(279,210));
	$pdf->AliasNbPages();
	$pdf->SetAutoPageBreak(true, 15);
 
	$pdf->AddPage();
	//$pdf->Image('logo.png',18,13,33);
	$pdf->SetFont('Arial','B',10);
	
	
	$html="";
			$rs=mysql_query("select id,name from und");
			$i=0;

			$html=$html.'<div align="center" id = "contenedor">
			<table id = "tabla_central">
				<tr>
					<td width = "100%">
						<img src = "../images/logos/2@Logo-Estacion700x700.jpg" id = "logo_empresa"/>
					</td>
				</tr>
			</table>
			<br /><br />			
			<table id = "tabla_2" >';	
			$html=$html.'<tr ><td><font >C&oacute;digo</font></td><td><font >Nombres</font></td><td><font >Apellidos</font></td><td><font >Tel&eacute;fono</font></td><td><font >Ciudad</font></td></tr>';
			while ($row = mysql_fetch_array($rs)){
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#95B1CE">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["id"];
				$html = $html.'</td><td>';
				$html = $html. $row["id"];
				$html = $html.'</td><td>';
				$html = $html. $row["id"];
				$html = $html.'</td><td>';
				$html = $html. $row["id"];
				$html = $html.'</td><td>';
				$html = $html. $row["id"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';	
	$stylesheet = file_get_contents('p1.css');
	$pdf->WriteHTML($stylesheet,1);
	$pdf->WriteHTML($html);

	$pdf->Output('Reporte usuarios.pdf', 'I');
	
?>