<?php
	include("../Controller/Conexion.php");
	require('../mpdf/mpdf.php');
	require('../Modelo/cabecera_ot.php');
	

	$lorem='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sit amet velit auctor, bibendum felis quis, aliquam est. Nunc nec imperdiet lectus. Sed ut tristique lorem. Donec eu sapien enim. Vestibulum volutpat urna massa. Phasellus dolor massa, porttitor sit amet odio ac, aliquam lobortis tortor. Integer non auctor est. Proin aliquam vulputate leo eu tempor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla tempus efficitur ultricies. Proin egestas in mi nec finibus. Etiam auctor consectetur orci in volutpat. Morbi et eros vitae quam accumsan iaculis. Morbi pulvinar est eu lectus bibendum ornare. Sed enim erat, ultricies vel pretium et, facilisis a nibh.';
	
	$otn = new cabecera_ot();
	//los ultimos 4 valores son respectivamente margenes cuerpotop, cuerpobot, header, footer
	$pdf = new mPDF('utf-8', array(210,279), '', '', '25','25','80','40','10','25');

	////$pdf->AliasNbPages();
	////$pdf->SetAutoPageBreak(true, 12);
 
	//$pdf->AddPage("L");
	$pdf->SetFont('Arial','B',10);

	
	//$pdf->use_kwt = true;  
	$empresa = $_GET['e'];
	$logo_empresa = mysql_query("select logo,nombre_legal_empresa,nit_empresa from empresa where cod_interno_empresa = '$empresa'");
	$logo = "";
	$nombre_empresa = "";
	$nit_empresa = "";
	$id = $_GET['i'];
	
	
	while($row  = mysql_fetch_array($logo_empresa)){
		$logo = $row['logo'];
		$nombre_empresa = $row['nombre_legal_empresa'];
		$nit_empresa = $row['nit_empresa'];
	}
	//[]
	//$currentData=array();
	
	$currentData=$otn->brief($id);
	
	function printAndOrganizeHeader($vectorData){
		
		global $lorem;
		
		$outputText='';
		
		foreach ($vectorData as $currentItem){
				
			$outputText.='<div class="headerWrapper">';
			
			$outputText.='<div class="item1header itemsHeader">'.$currentItem[0].'</div>';
			
			$outputText.='<div class="item2header itemsHeader">'.$currentItem[1].'</div>';
			
			$outputText.='</div>';
		}
		
		return $outputText;
		
		
	}
	
	function printAndOrganizeData($vectorData){
		$outputText='';
		$cQuestions=1;
		foreach ($vectorData as $currentItem){
					
			$outputText.='<div class="itemsWrapper">';
			
			$outputText.='<div class="item1">'.$cQuestions.'. '.$currentItem[0].'</div>';
			
			$outputText.='<div class="item2">'.$currentItem[1].'</div>';
			
			$outputText.='<div class="item3">';
			$outputText.=$currentItem[2]?nl2br($currentItem[2]):'<br><br>';
			$outputText.='</div>';
			$cQuestions++;
			
			$outputText.='</div>';
		}
		return $outputText;
	
	}
	
	$headerHTML='<div class="logo"><img src = "../images/logos/'.$logo.'" height = "70px"/></div>'.printAndOrganizeHeader($currentData[0]);
	
	$footerHTML='<div style="text-align:right" >{PAGENO}</div>';
	
	$html = '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>BRIEF # '.$id.'</title>

				<style type="text/css">
					
					body{
						font-family:"Arial";
						font-size:12px;
					}
					
					.logo{
						text-align:center;
						margin-bottom:7mm;
					}
					
					.headerWrapper{
						//border: 1px solid black;
						width:100%;
						
					}
					
					.itemsHeader{
						border-radius:3mm;
						float:left;
						padding:0.5mm;
						padding-left:2mm;
						margin:0.25mm;
					} 
					
					.item1header{
						border-radius: 1px solid black;
						width:29%;
						float:left;
						background-color: #23B116;
						color:white;
					}
					
					.item2header{
						border-radius: 1px solid black;
						width:60%;
						float:left;
					} 
					
					.itemsWrapper{
						margin-top:20px;
						text-align:justify;
					}
					.item1{
						border-style: solid;
						border-radius: 20px 20px 0px 0px;
						background-color: #23B116;
						color:white;
						padding: 10px;
						padding-top: 20px;
					}
					.item2{
						padding: 10px;
						border:1px dashed black; 
						color:#666666;
					}
					.item3{
						padding: 10px;
						
						border:1px solid black; 
						
						border-radius: 0px 0px 20px 20px;
						border-top-color:white;
					}
				</style>
		</head>
		<body>		
		'.printAndOrganizeData($currentData[1]).'
		</body>
	</html>';
	
	$pdf->setHTMLHeader($headerHTML);
	$pdf->setHTMLFooter($footerHTML);	
		
	$pdf->WriteHTML($html);
	//$pdf->Output("BRIEF_$id OT_".$_GET['ot']."_".date("Y-m-d h:i:s")'BRIEF_OT_'.$_GET['ot']."_".date("Y-m-d")."_".date("H:i:s").'.pdf', 'I');
	$pdf->Output("BRIEF_$id OT_".$_GET['ot']."_".date("Y-m-d_his").".pdf", 'I');
?>