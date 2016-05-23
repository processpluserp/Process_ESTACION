<?php
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
			  ->setCellValue('B1', 'OT')
			  ->setCellValue('C1', 'CLIENTE')
			  ->setCellValue('D1', 'REF. OT')
			->setCellValue('E1', 'DIRECTOR')
			->setCellValue('F1', 'EJECUTIVO')
			->setCellValue('G1', 'NUM AG PPTO')
			->setCellValue('H1', 'NUM CL PPTO')
			->setCellValue('I1', 'REFERENCIA PPTO')
			->setCellValue('J1', 'ESTADO');
		$objPHPExcel->getActiveSheet()->getStyle("A1:J1")->getFont()->setBold(true);
	
		for ($col = 'A'; $col != 'I'; $col++) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
		}
		
	$sql = mysql_query("select u.name as unidad, edir.nombre_empleado as director, eje.nombre_empleado as ejecutivo,
	ot.codigo_ot, ot.referencia as referencia_ot, p.referencia as referencia_ppto, p.estado_presup, p.codigo_presup, p.numero_presupuesto,p.vigencia_final,
	c.nombre_comercial_cliente,p.factura_fact
	
	from cabpresup p, und u, cabot ot, usuario userdir, empleado edir, usuario usereje, empleado eje, clientes c
	where p.ceco = u.id and p.ot = ot.codigo_ot and ot.director = userdir.idusuario and userdir.pk_empleado = edir.documento_empleado and
	ot.ejecutivo = usereje.idusuario and usereje.pk_empleado = eje.documento_empleado and p.pk_clientes_nit_cliente = c.codigo_interno_cliente and p.ot != 'AVA0001-15'");
	
	$c = 2;
	while($rowx = mysql_fetch_array($sql)){
		$text_ppto = "";
		if((date("Y-m-d")) > ($rowx['vigencia_final']) && $rowx['estado_presup'] == 3){
			$text_ppto = "PTE POR FACTURAR";
		}else if($rowx['estado_presup'] == 1){
			$text_ppto = "< 20%";
		}else if($rowx['factura_fact'] != "" || $rowx['estado_presup'] == 5){
			$text_ppto = "FACTURADO SIN PAGAR";
		}else if($rowx['estado_presup'] == 2){
			$text_ppto = "APROBADO POR SISTEMA";
		}else if($rowx['estado_presup'] == 6){
			$text_ppto = "PAGADO";
		}else if($rowx['estado_presup'] == 7){
			$text_ppto = "CERRADO";
		}
		
		$sql_grupos = mysql_query("select g.name as grupo, g.id as codigo,cp.codigo_int_celula
		from grupo_tarifario g, cecula_ppto_interno cp
		where cp.pk_ppto_interno = '$num_ppto' and cp.nombre_celula <> 'VALORES NO COMISIONABLES' and cp.nombre_celula = g.id order by cp.codigo_int_celula asc");
		
		$valores_comisionables = 0;
		$valores_no_comisionables = 0;
		$total_final_anticipos = 0;
		$total_final_compra = 0;
		$total_final_venta = 0;
		$total_comision_venta = 0;
		$total_comisiones = 0;
		$total_volumen  =0;
		$total_negociacion = 0;
		$total_valores_no_comisionables = 0;
		
		$num_ppto = $row['codigo_presup'];
		$codigo_cliente = 0;
		$sql_cliente  = mysql_query("select pk_clientes_nit_cliente from cabpresup where codigo_presup = '$num_ppto'");
		while($row = mysql_fetch_array($sql_cliente)){
			$codigo_cliente = $row['pk_clientes_nit_cliente'];
		}
		
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$c, $rowx['unidad'])
				->setCellValue('B'.$c, $rowx['codigo_ot'])
				->setCellValue('C'.$c, $rowx['nombre_comercial_cliente'])
				->setCellValue('D'.$c, $rowx['referencia_ot'])
				->setCellValue('E'.$c, $rowx['director'])
				->setCellValue('F'.$c, $rowx['ejecutivo'])
				->setCellValue('G'.$c, $rowx['codigo_presup'])
				->setCellValue('H'.$c, $rowx['numero_presupuesto'])
				->setCellValue('I'.$c, $rowx['referencia_ppto'])
				->setCellValue('J'.$c, $text_ppto);
				$c++;
	}
	
	$c--;
		$objPHPExcel->getActiveSheet()->getStyle("A1:J$c")->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        ));
		$objPHPExcel->getActiveSheet()->getStyle("A1:J1")->applyFromArray(array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '7FCD72')
                )
        ));
		$objPHPExcel->getActiveSheet()->getStyle("A1:J1")->getFont()->setBold(true)
                                ->getColor()->setRGB('FFFFFF');
		
		$objPHPExcel->getActiveSheet()->setTitle('REPORTE ESTADO PPTOS X UND');
		$objPHPExcel->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="REPORTE EST PPTOS UND"'.date("Y-m-d h:i:s").'".xls"');
		header('Cache-Control: max-age=0');
		$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$objWriter->save('php://output');
		exit;
?>