<?php
	ini_set('memory_limit', '512M');
	ini_set('max_execution_time','360');
	
	include("../Controller/Conexion.php");
	
	
	$emp = $_GET['e'];
	$clie = $_GET['c'];
	$fd = $_GET['d'];
	$fh = $_GET['h'];
	
	require_once 'PHPExcel/Classes/PHPExcel.php';
	require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
	
	$objPHPExcel = new PHPExcel();
	if($clie == 1){
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
			  ->setCellValue('A1', 'EMPRESA')
			  ->setCellValue('B1', 'CLIENTE')
			  ->setCellValue('C1', 'PRODUCTO')
			->setCellValue('D1', 'OT')
			->setCellValue('E1', 'DIRECTOR')
			->setCellValue('F1', 'EJECUTIVO')
			->setCellValue('G1', 'REFERENCIA')
			->setCellValue('H1', 'ESTADO')
			->setCellValue('I1', 'FECHA')
			->setCellValue('J1', 'NÚMERO SOLICITUD')
			->setCellValue('K1', 'NOMBRE SOLICITUD')
			->setCellValue('L1', 'PROFESIONAL COLPATRIA')
			->setCellValue('M1', 'TIPO DE PIEZA')
			->setCellValue('N1', 'OBJETIVO TRABAJO')
			->setCellValue('O1', 'MEDIO');
		$objPHPExcel->getActiveSheet()->getStyle("A1:O1")->getFont()->setBold(true);
	
		for ($col = 'A'; $col != 'O'; $col++) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
		}
	}else{
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
			  ->setCellValue('A1', 'EMPRESA')
			  ->setCellValue('B1', 'CLIENTE')
			  ->setCellValue('C1', 'PRODUCTO')
			->setCellValue('D1', 'OT')
			->setCellValue('E1', 'DIRECTOR')
			->setCellValue('F1', 'EJECUTIVO')
			->setCellValue('G1', 'REFERENCIA')
			->setCellValue('H1', 'ESTADO')
			->setCellValue('I1', 'FECHA');
		$objPHPExcel->getActiveSheet()->getStyle("A1:I1")->getFont()->setBold(true);
	
		for ($col = 'A'; $col != 'V'; $col++) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
		}
	}
	
	
	
	if($emp == 0){
			$sql = "select e.nombre_comercial_empresa, c.nombre_comercial_cliente, pr.nombre_producto,ot.codigo_ot,ot.estado, 
			ot.fecha_registro,eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director,ot.referencia
			from empresa e, clientes c, producto_clientes pr, cabot ot,empleado eje, usuario u1,empleado dir, usuario u2
			where ot.pk_nit_empresa_ot = e.cod_interno_empresa and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente and
			ot.producto_clientes_codigo_PRC = pr.id_procliente and ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
			and ot.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
			and date_format(ot.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh' ";
	}else{
			if($clie == 0){
				$sql = "select e.nombre_comercial_empresa, c.nombre_comercial_cliente, pr.nombre_producto,ot.codigo_ot,
				ot.estado,ot.fecha_registro,eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director,ot.referencia
				from empresa e, clientes c, producto_clientes pr, cabot ot,empleado eje, usuario u1,empleado dir, usuario u2
				
				where ot.pk_nit_empresa_ot = '$emp' and 
				ot.pk_nit_empresa_ot = e.cod_interno_empresa and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente and
				ot.producto_clientes_codigo_PRC = pr.id_procliente and date_format(ot.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh' and ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
				and ot.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado";
			}else if($clie == 1){
				$sql = "SELECT o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia,c.nombre_comercial_cliente, p.nombre_producto,o.tipo_brief,
				eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director, emp.nombre_comercial_empresa,
				o.num_solicitud,o.nombre_solicitud,proc.name_profesional, tpc.name_tpieza, mec.name_medio, objc.name_otrabajo, o.pk_nit_empresa_ot,o.fecha_registro
						
				from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, empresa emp,
				pro_colpatria proc, tipo_pieza tpc, objtrabajo objc, medio mec
						
				where o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente and o.pk_nit_empresa_ot = '$emp' AND o.producto_clientes_pk_clientes_nit_procliente = '$clie'
				and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and date_format(o.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh'
				and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado and o.pk_nit_empresa_ot = emp.cod_interno_empresa and
				o.pro_colpatria_codigo_profesional = proc.codigo_profesional and o.tipo_pieza_codigo_tpieza = tpc.codigo_tpieza 
				and o.objtrabajo_codigo_objtrabajo = objc.codigo_objtrabajo and o.medio_codigo_medio = mec.codigo_medio";
			}else{
				$sql = "select e.nombre_comercial_empresa, c.nombre_comercial_cliente, pr.nombre_producto,ot.codigo_ot,
				ot.estado, ot.fecha_registro,eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director,ot.referencia
				from empresa e, clientes c, producto_clientes pr, cabot ot,empleado eje, usuario u1,empleado dir, usuario u2
				
				where ot.pk_nit_empresa_ot = '$emp' and ot.producto_clientes_pk_clientes_nit_procliente = '$clie' and
				ot.pk_nit_empresa_ot = e.cod_interno_empresa and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente and
				ot.producto_clientes_codigo_PRC = pr.id_procliente and date_format(ot.fecha_registro, '%Y-%m-%d') between '$fd' and '$fh' and ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
				and ot.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado";
			}
		}
		$r = mysql_query($sql);
		$c = 2;
		while($row = mysql_fetch_array($r)){
			$text = "";
			if($row['estado'] == 0){
				$text ="CERRADA";
			}else{
				$text ="ACTIVA";
			}
			if($clie == 1){
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$c, $row['nombre_comercial_empresa'])
				->setCellValue('B'.$c, $row['nombre_comercial_cliente'])
				->setCellValue('C'.$c, $row['nombre_producto'])
				->setCellValue('D'.$c, $row['codigo_ot'])
				->setCellValue('E'.$c, $row['director'])
				->setCellValue('F'.$c, $row['ejecutivo'])
				->setCellValue('G'.$c, $row['referencia'])
				->setCellValue('H'.$c, $text)
				->setCellValue('I'.$c, $row['fecha_registro'])
				->setCellValue('J'.$c, $row['num_solicitud'])
				->setCellValue('K'.$c, $row['nombre_solicitud'])
				->setCellValue('L'.$c, $row['name_profesional'])
				->setCellValue('M'.$c, $row['name_tpieza'])
				->setCellValue('N'.$c, utf8_encode($row['name_otrabajo']))
				->setCellValue('O'.$c, $row['name_medio']);
				$c++;
			}else{
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$c, $row['nombre_comercial_empresa'])
				->setCellValue('B'.$c, $row['nombre_comercial_cliente'])
				->setCellValue('C'.$c, $row['nombre_producto'])
				->setCellValue('D'.$c, $row['codigo_ot'])
				->setCellValue('E'.$c, $row['director'])
				->setCellValue('F'.$c, $row['ejecutivo'])
				->setCellValue('G'.$c, $row['referencia'])
				->setCellValue('H'.$c, $text)
				->setCellValue('I'.$c, $row['fecha_registro']);
				$c++;
			}
			
		}
		$c--;
		$objPHPExcel->getActiveSheet()->getStyle("A1:O$c")->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        ));
		$objPHPExcel->getActiveSheet()->getStyle("A1:O1")->applyFromArray(array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '7FCD72')
                )
        ));
		$objPHPExcel->getActiveSheet()->getStyle("A1:O1")->getFont()->setBold(true)
                                ->getColor()->setRGB('FFFFFF');
		
		$objPHPExcel->getActiveSheet()->setTitle('REPORTE OTS');
		$objPHPExcel->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="REPORTE OTS"'.date("Y-m-d h:i:s").'".xls"');
		header('Cache-Control: max-age=0');
		$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$objWriter->save('php://output');
		exit;
?>