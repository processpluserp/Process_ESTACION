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
		
		
		$empresax=array();
		
		$ee = explode("<***+++>",$row['asistentes_agencia']);
		for($i = 0;$i < count($ee)-1;$i++){
			$empresax[]=strtoupper($ee[$i]);
		}
	
		
		
		$clientex=array();
		
		$ee = explode("<***+++>",$row['asistentes_cliente']);
		for($i = 0;$i < count($ee)-1;$i++){
			$clientex[]=strtoupper($ee[$i]);
		}
		
		
		$dataRowsAgency=array();
		$dataRowsAgency[]=array('NOMBRE','FECHA','COMPROMISO');
		//$list_agencia = '';
		$ee = explode("<***+++x>",$row['comp_agencia']);
		for($i = 0;$i < count($ee)-1;$i++){
			$info = explode("<***+++>",$ee[$i]);
			//$list_agencia.='<tr><td style = "font-family:Arial;border:1px solid black;border-left:0px;padding-left:10px;padding-right:10px;text-align:left;" >'.($info[1]).'</td><td nowrap = "nowrap" style = "font-family:Arial;border:1px solid black;padding-left:10px;padding-right:10px;">'.($info[2]).'</td><td align = "justify" style = "font-family:Arial;border:1px solid black;padding-left:10px;padding-right:10px;" colspan = "2">'.nl2br($info[3]).'</td></tr>';
			$dataRowsAgency[]=array($info[1],$info[2],$info[3]);
		}
		//$list_agencia .="";
		
		$dataRowsClient=array();
		$dataRowsClient[]=array('NOMBRE','FECHA','COMPROMISO');
		$list_cliente = '';
		$ee = explode("<***+++x>",$row['comp_cliente']);
		for($i = 0;$i < count($ee)-1;$i++){
			$info = explode("<***+++>",$ee[$i]);
			//$list_cliente.='<tr><td style = "border:1px solid black;width:20%;border-left:0px;padding-left:10px;padding-right:10px;">'.($info[0]).'</td><td nowrap = "nowrap" style = "width:20%;border:1px solid black;padding-left:10px;padding-right:10px;">'.($info[1]).'</td><td align = "justify" style = "width:60%;border:1px solid black;border-right:0px;padding-left:10px;padding-right:10px;" colspan = "2">'.nl2br($info[2]).'</td></tr>';
			$dataRowsClient[]=array($info[0],$info[1],$info[2]);
		}
		$list_cliente .="";
		
		
		
		$list_temas = '';
		$ee = explode("<***+++>",$row['temas']);
		for($i = 0;$i < count($ee)-1;$i++){
			$info = explode("<***+++>",$ee[$i]);
			$temppp = $i+1;
			$list_temas.="$temppp. ".nl2br($info[0]).'<br>';
		}
		
		$infoData = array();
		
		$tempPairs = array();
		
		$tempPairs[]='Cliente:';
		$tempPairs[]=$nombre_cliente;
		
		$infoData[] = $tempPairs;
		$tempPairs = array();
		
		$tempPairs[]='Lugar:';
		$tempPairs[]=$row["lugar_reunion"];
		
		$infoData[] = $tempPairs;
		$tempPairs = array();

		$tempPairs[]='Fecha:';
		$tempPairs[]=$row["fecha_reunion"];
		
		$infoData[] = $tempPairs;
		$tempPairs = array();
		
		$tempPairs[]='Tipo de reunión:';
		$tempPairs[]=$row["tipo_reunion"];
		
		$infoData[] = $tempPairs;
		$tempPairs = array();
		
		$tempPairs[]='Hora inicio:';
		$tempPairs[]=$row["hora_inicio"];
		
		$infoData[] = $tempPairs;
		$tempPairs = array();
		
		$tempPairs[]='Hora culminación:';
		$tempPairs[]=$row["hora_fin"];
		
		$infoData[] = $tempPairs;



		
		
		
		
		
		
		
		
		$infoAssist = array();
		
		
		$tempPairs = array();
		
		$tempPairs[]='Asistentes Agencia e Interesados:';
		$tempPairs[]=$empresax;
		
		$infoAssist[] = $tempPairs;
		
		$tempPairs = array();
		
		$tempPairs[]='Asistentes Cliente:';
		$tempPairs[]=$clientex;
		
		$infoAssist[] = $tempPairs;
		
		
		
				
		
		
		
		
		$simpleData=array();
		
		$tempPairs = array();
		
		$tempPairs[]='NOTA';
		$tempPairs[]='<strong>Después de 24 horas de recibir este correo, sino hay respuesta por parte del Cliente, se entenderá que no hay ninguna observación al respecto.</stron>';
		
		$simpleData[] = $tempPairs;
		
		$tempPairs = array();
		
		$tempPairs[]='INFORMACIÓN GENERAL';
		$tempPairs[]=nl2br($row['inf_general']);
		
		$simpleData[] = $tempPairs;
		
		$tempPairs = array();
		
		$tempPairs[]='TEMAS TRATADOS';
		$tempPairs[]=$list_temas;	
		
		$simpleData[] = $tempPairs;
		
		
		
		$obligations = array();
		
		
		
		$obligationsData = array();
		$obligationsData[]="COMPROMISOS AGENCIA";
		$obligationsData[]=$dataRowsAgency;
		
		$obligations[] = $obligationsData;
		
		
		$obligationsData = array();
		$obligationsData[]="COMPROMISOS CLIENTE";
		$obligationsData[]=$dataRowsClient;
		
		$obligations[] = $obligationsData;
		
		
		
		
		
		function printTableData($vectorDataTable){
	
			$outputText='';
			
			
			$outputText.='<div class="itemsWrapper">';
		
			$outputText.='<div class="item1">'.$vectorDataTable[0].'</div>';
			
			$outputText.='<div class="item3"><table>';
			
			$primero='tableFirst';
			
			foreach ($vectorDataTable[1] as $itemTable){
				
				$outputText.='<tr>';
				
				$outputText.= '<td class="itemTable itemTable1 '.$primero.'">'.$itemTable[0].'</td>';
				
				$outputText.= '<td class="itemTable itemTable2 '.$primero.'">'.$itemTable[1].'</td>';
				
				$outputText.= '<td class="itemTable itemTable3 '.$primero.'">'.nl2br($itemTable[2]).'</td>';
				
				$outputText.='</tr>';
				
				$primero='';
			}
			
			$outputText.='</table></div>';
			
			$outputText.='</div>';
			
			return $outputText;
			
		}
		
		
		
		
		
	
	break;
	}
	
	
	
	function printAndOrganizeData($vectorData){
	
	$outputText='';
	//$cQuestions=1;
	foreach ($vectorData as $currentItem){
				
		$outputText.='<div class="itemsWrapper">';
		
		$outputText.='<div class="item1">'.$currentItem[0].'</div>';
		
		//$outputText.='<div class="item2">'.$currentItem[1].'</div>';
		
		$outputText.='<div class="item3">';
		$outputText.=$currentItem[1]?nl2br($currentItem[1]):'<br><br>';
		$outputText.='</div>';
		//$cQuestions++;
		
		$outputText.='</div>';
	}
	return $outputText;
	
	}
	
	
	function printInfoAssist($vectorData){
		
			function packItems($itemData){
				
				
				$outputText='<ul>';
				
				foreach($itemData as $itemVector){
		
				$outputText.='<div class="innerItem">';
		
				$outputText.='<li>'.$itemVector.'</li>';
		
				$outputText.='</div>';
		
				}
				
				return $outputText.'</ul>';
				
			}
		
		$outputText='<div class="assistData">';
		
		foreach($vectorData as $itemVector){
		
		$outputText.='<div class="infoTableDiv">';
		
		$outputText.='<strong>'.$itemVector[0].'</strong><br>';
		
		$outputText.=packItems($itemVector[1]).'<br>';
		
		$outputText.='</div>';
		
		}
		return $outputText.'</div>';
	}
		
	
	
	function printInfoData($vectorData){
		
		$outputText='';
		
		$varSelector=0;
		$value=2;
		
		foreach($vectorData as $itemVector){
		
		$outputText.='<div class="';
		
		if($varSelector<$value){
			
			$outputText.='firstTwo ';
		
		}else{
		
			$outputText.='headerWrapper ';
		}
		
		$outputText.='">';
		
		$outputText.='<div class="item1header';
		
		if($varSelector<$value){
		$outputText.='First';
		}
		
		$outputText.=' itemsHeader">'.$itemVector[0].'</div>';
		
		$outputText.='<div class="item2header';


		if($varSelector<$value){
		$outputText.='First';
		}

		$outputText.=' itemsHeader">'.$itemVector[1].'</div>';
		
		$outputText.='</div>';
		
		$varSelector++;
		
		}
		return $outputText;
	}
	
	
	
	
	
	$html = '
		<style type="text/css">
					.logo{
						text-align:center;
						font-size:24;
						color:black;
						font-family:Arial;
					}
					
					.firstTwo{
						//background-color:red;
						width:100%;
						float:left;
					}
					
					.headerWrapper{
						//background-color:black;
						width:50%;
						float:left;
						
					}
					
					
					
					
					
					.itemsHeader{
						border-radius:3mm;
						float:left;
						padding:0.5mm;
						padding-left:2mm;
						margin:1mm;
					} 
					
					.item1headerFirst{
						border-radius: 1px solid black;
						background-color: #23B116;
						color:white;
						width:20%;
					}
					
					
					.item2headerFirst{
						border-radius: 1px solid black;
						width:74%;
						//background-color:red;
						float:left;
					} 
					
					.item1header{
						border-radius: 1px solid black;
						background-color: #23B116;
						color:white;
						width:40%;
					}
					
					
					
					.item2header{
						border-radius: 1px solid black;
						width:49%;
						//background-color:red;
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
					}
					.item3{
						padding: 10px;
						
						border:1px solid black; 
						
						border-radius: 0px 0px 20px 20px;
						border-top-color:white;
					}
					
					table{
						border-collapse: collapse;
						width: 100%;
					}
					
					td{
						padding:3mm;
						border:1px solid black;
						
					}
					
					/*
					.itemTable{
					}
					
					.itemTable1{
						min-width:20%;
					} 
					
					.itemTable2{
						min-width:20%;
						text-align:center;
					} 
					
					.itemTable3{
					} 
					*/
					
					.tableFirst{
						background-color:grey;
						color:white;
						text-align:center;
					} 
					
					.infoTableDiv{
						float:left;
						width:46%;
					}
					
					.ul{
						list-style-type:circle;
					}
					
					
					
		</style>
			'.printInfoData($infoData).'<br>'.printInfoAssist($infoAssist).'<br>'.printAndOrganizeData($simpleData).printTableData($obligations[0]).printTableData($obligations[1]);

			
	
	$headerHTML='<div class="logo"><img src = "../images/logos/'.$logo.'" height = "80px"/><br>'.$row['name'].'</div>';
	
	////<span style = "font-size:28;color:black;font-family:Arial;font-weight: 900;"><br>'.$row['name'].'</span>';
	
	$footerHTML='<div style="text-align:right" >{PAGENO}</div>';
	
	
	$pdf = new mPDF('utf-8', array(210,279), '', 'Arial', '10','10','55','25','15','15');
	
	$pdf->SetHTMLHeader($headerHTML);

	$pdf->SetHTMLFooter($footerHTML);
			
	$pdf->WriteHTML($html);
	

	$pdf->Output('INFORME OT '.$_GET['ot'].'.pdf', 'I');
?>