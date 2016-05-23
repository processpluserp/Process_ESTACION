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
			  ->setCellValue('A1', 'CLIENTE')
			  ->setCellValue('B1', 'PRODUCTO')
			  ->setCellValue('C1', 'OT')
			->setCellValue('D1', 'REFERENCIA')
			->setCellValue('E1', 'TIPO TAREA')
			->setCellValue('F1', 'DEPARTAMENTO')
			->setCellValue('G1', 'FECHA DE ENTREGA')
			->setCellValue('H1', 'ASIGNADO');
		$objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getFont()->setBold(true);
	
		for ($col = 'A'; $col != 'H'; $col++) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
		}
	
		$sql = mysql_query("select e.nombre_comercial_empresa, c.nombre_comercial_cliente, pr.nombre_producto,ot.codigo_ot,ot.estado, 
			ot.fecha_registro,eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director,ot.referencia, tp.name_ttarea, ar.nombre_area_empresa, t.fecha_prometida, ast.pk_asignado, emps.nombre_empleado as asignado_tarea
			
			from empresa e, clientes c, producto_clientes pr, cabot ot,empleado eje, usuario u1,empleado dir, usuario u2, tareas t, tipo_tarea tp, area_empresa ar, asignados_tareas ast, usuario asis,
			empleado emps
			
			where ot.pk_nit_empresa_ot = e.cod_interno_empresa and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente and
			ot.producto_clientes_codigo_PRC = pr.id_procliente and ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
			and ot.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado and u1.idusuario = '26' and
			ot.codigo_ot = t.pk_ot and t.estado = '0' and t.tipo_tarea_codigo_tipotarea = tp.codigo_tipotarea and t.codigo_departamento = ar.codigo_interno_empresa and 
			t.codigo_int_tarea = ast.pk_tarea and ast.tipo = 'ASI' and ast.pk_asignado = asis.idusuario and asis.pk_empleado  = emps.documento_empleado");
			
			
		$c = 2;
		while($row = mysql_fetch_array($sql)){
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$c, $row['nombre_comercial_cliente'])
				->setCellValue('B'.$c, $row['nombre_producto'])
				->setCellValue('C'.$c, $row['codigo_ot'])
				->setCellValue('D'.$c, $row['referencia'])
				->setCellValue('E'.$c, $row['name_ttarea'])
				->setCellValue('F'.$c, $row['nombre_area_empresa'])
				->setCellValue('G'.$c, $row['fecha_prometida'])
				->setCellValue('H'.$c, $row['asignado_tarea']);
				$c++;
			
		}
		$c--;
		$objPHPExcel->getActiveSheet()->getStyle("A1:H$c")->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        ));
		$objPHPExcel->getActiveSheet()->getStyle("A1:H1")->applyFromArray(array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '7FCD72')
                )
        ));
		$objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getFont()->setBold(true)
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