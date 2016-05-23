<?php
	
	ini_set('memory_limit', '512M');
	ini_set('max_execution_time','360');
	
	include("../Controller/Conexion.php");
	
	
	require_once 'PHPExcel/Classes/PHPExcel.php';
	require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
	
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->
		getProperties()
		   ->setCreator("process.toro-love.com")
		   ->setLastModifiedBy("process.toro-love.com")
		   ->setTitle("REPORTE OTS")
		   ->setSubject("REPORTE OTS")
		   ->setDescription("REPORTE OTS")
		   ->setKeywords("PROCESS")
		   ->setCategory("REPORTE OTS");
		$objPHPExcel->setActiveSheetIndex(0)
			  ->setCellValue('A1', 'UNIDAD')
			  ->setCellValue('B1', 'CLIENTE')
			  ->setCellValue('C1', 'PRODUCTO')
			->setCellValue('D1', 'NO. PPTO AG')
			->setCellValue('E1', 'NO. PPTO CL')
			->setCellValue('F1', 'REFERENCIA PPTO')
			->setCellValue('G1', 'ESTADO PPTO')
			->setCellValue('H1', 'PROVEEDOR')
			->setCellValue('I1', 'ORDEN')
			->setCellValue('J1', 'ESTADO ORDEN')
			->setCellValue('K1', 'FECHA DE CREACIÓN')
			->setCellValue('L1', 'VALOR SIN IVA')
			->setCellValue('M1', 'FACTURA PROVEEDOR');
		$objPHPExcel->getActiveSheet()->getStyle("A1:M1")->getFont()->setBold(true);
	
		for ($col = 'A'; $col != 'M'; $col++) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
		}
	
	
	$acum = 0;
	$sqlx = mysql_query("select 
	u.name, ip.pk_orden, p.nombre_legal_proveedor, op.fecha_orden, cp.codigo_presup, cp.numero_presupuesto, cp.referencia, c.nombre_comercial_cliente, cp.vigencia_final,cp.estado_presup, op.num_doc_prov, cp.empresa_nit_empresa
	from und u, itempresup ip, proveedores p, orproduccion op, cabpresup cp, clientes c
	where u.id = cp.ceco and ip.pk_orden = op.codigo_interno_op and op.proveedor = p.codigo_interno_proveedor and ip.ppto = cp.codigo_presup and cp.pk_clientes_nit_cliente = c.codigo_interno_cliente ORDER BY u.name, c.nombre_comercial_cliente asc");
		$c = 2;
		while($rowx = mysql_fetch_array($sqlx)){
			$text = "";
			if( $rowx['num_doc_prov'] ==  ""){
				$text ="SIN FACTURAR";
			}else{
				$text ="FACTURADA";
			}
			
			$text_ppto = "";
			if((date("Y-m-d")) > ($rowx['vigencia_final']) && $rowx['estado_presup'] == 3){
				$text_ppto = "PTE POR FACTURAR";
			}else if($rowx['estado_presup'] == 1){
				$text_ppto = "< 20%";
			}else if($rowx['estado_presup'] == 2){
				$text_ppto = "APROBADO POR SISTEMA";
			}else if($rowx['estado_presup'] == 3){
				$text_ppto = "APROBADO SIN EJECUTAR";
			}else if($rowx['estado_presup'] == 5){
				$text_ppto = "FACTURADO SIN PAGAR";
			}else if($rowx['estado_presup'] == 6){
				$text_ppto = "PAGADO";
			}else if($rowx['estado_presup'] == 7){
				$text_ppto = "CERRADO";
			}
			
			$op = $rowx['pk_orden'];
		
			$sql = mysql_query("select p.id,p.descripcion,p.dias,p.q,p.val_item,p.iva_item,p.por_prov
				from itempresup p 
				where p.pk_orden = '$op'");
				
			
			$acum_x = 0;
			$iva_cum = 0;
			$antes_iva = 0;
			while($row = mysql_fetch_array($sql)){
				$temp = 0;
				if($rowx['empresa_nit_empresa'] == 1){
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
				
			}
			
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$c, $rowx['name'])
				->setCellValue('B'.$c, $rowx['nombre_comercial_cliente'])
				->setCellValue('C'.$c, $rowx['nombre_comercial_cliente'])
				->setCellValue('D'.$c, $rowx['codigo_presup'])
				->setCellValue('E'.$c, $rowx['numero_presupuesto'])
				->setCellValue('F'.$c, $rowx['referencia'])
				->setCellValue('G'.$c, $text_ppto)
				->setCellValue('H'.$c, $rowx['nombre_legal_proveedor'])
				->setCellValue('I'.$c, $rowx['pk_orden'])
				->setCellValue('J'.$c, $text)
				->setCellValue('K'.$c, $rowx['fecha_orden'])
				->setCellValue('L'.$c, $acum_x)
				->setCellValue('M'.$c, $rowx['num_doc_prov']);
				$c++;
			
		}
		$c--;
		$objPHPExcel->getActiveSheet()->getStyle("A1:M$c")->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        ));
		$objPHPExcel->getActiveSheet()->getStyle("A1:M1")->applyFromArray(array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '7FCD72')
                )
        ));
		$objPHPExcel->getActiveSheet()->getStyle("A1:M1")->getFont()->setBold(true)
                                ->getColor()->setRGB('FFFFFF');
		
		$objPHPExcel->getActiveSheet()->setTitle('REPORTE OC');
		$objPHPExcel->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="REPORTE OC"'.date("Y-m-d h:i:s").'".xls"');
		header('Cache-Control: max-age=0');
		$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$objWriter->save('php://output');
		exit;
?>