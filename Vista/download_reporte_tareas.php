<?php
	include("../Controller/Conexion.php");
	
	
	$emp = 1;//$_SESSION['emp'];
	$clie = 1;$_SESSION['clie'];
	$fd = '2016-01-01';$_SESSION['fd'];
	$fh = DATE("Y-m-d");//$_SESSION['fh'];
	$tareas =2;//$_SESSION['tareas'];
	$depto = 0;//$_SESSION['depto'];
	
	require_once 'PHPExcel/Classes/PHPExcel.php';
	require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->
	getProperties()
       ->setCreator("process.toro-love.com")
       ->setLastModifiedBy("process.toro-love.com")
       ->setTitle("REPORTE TAREAS")
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
		->setCellValue('H1', 'DESCRIPCION')
		->setCellValue('I1', 'ESTADO')
		->setCellValue('J1', 'FECHA')
		->setCellValue('K1', '# TAREA')
		->setCellValue('L1', 'TIPO TAREA')
		->setCellValue('M1', 'FECHA TAREA')
		->setCellValue('N1', 'REFERENCIA TAREA')
		->setCellValue('O1', 'DESCRIPCION TAREA')
		->setCellValue('P1', 'RESPONSABLE')
		->setCellValue('Q1', 'ASIGNADO')
		->setCellValue('R1', 'DEPARTAMENTO')
		->setCellValue('S1', 'RADICADO POR')
		->setCellValue('T1', 'ESTADO TAREA')
		->setCellValue('U1', 'FECHA PROMETIDA')
		->setCellValue('V1', 'HORA PROMETIDA')
		->setCellValue('W1', 'FECHA ENTREGA')
		->setCellValue('X1', 'HORA ENTREGA');
	$objPHPExcel->getActiveSheet()->getStyle("A1:X1")->getFont()->setBold(true);
	
	for ($col = 'A'; $col != 'X'; $col++) {
		$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
	}
	
		$sql_clie = "";
		$sql_depto = "";
		$sql = "";
		$ste = "";
		
		
		if($tareas == 2){
			$ste = "";
		}else{
			$ste = "and t.estado = '$tareas'";
		}
		if($clie != 0){
			$sql_clie = "and ot.producto_clientes_pk_clientes_nit_procliente = '$clie'";
		}
		if($depto != 0){
			$sql_depto = "and t.codigo_departamento = '$depto'";
		}
		if($emp != 0){
			$sql_emp = "and ot.pk_nit_empresa_ot = '$emp'";
			
		}
		$sql = "select DISTINCT e.nombre_comercial_empresa, c.nombre_comercial_cliente, pr.nombre_producto,ot.codigo_ot,ot.estado as estado_ot,ot.fecha_registro,ot.descripcion,ot.referencia,
			tr.codigo, eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director, t.*, tp.name_ttarea, t.fecha_registro as fecha_re, ra.nombre_empleado as radicado_por
			from empresa e, clientes c, producto_clientes pr, cabot ot,tareas t , flujo_tareas tr,tipo_tarea tp,
			empleado eje, empleado dir, usuario u1, usuario u2, empleado ra, usuario u3
			where ot.director  = u1.idusuario and u1.pk_empleado = eje.documento_empleado and ot.ejecutivo = u2.idusuario and u2.pk_empleado = dir.documento_empleado and
			t.usuario = u3.idusuario and u3.pk_empleado = ra.documento_empleado and 
			ot.pk_nit_empresa_ot = e.cod_interno_empresa and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente and
			ot.producto_clientes_codigo_PRC = pr.id_procliente and ot.codigo_ot = t.pk_ot and t.codigo_int_tarea= tr.consecutivo and
			t.tipo_tarea_codigo_tipotarea = tp.codigo_tipotarea $sql_emp $sql_clie
			and date_format(t.fecha_prometida, '%Y-%m-%d') >= '$fd' and date_format(t.fecha_prometida, '%Y-%m-%d') <= '$fh' AND ot.codigo_ot = 'CLP0388-16' order by ot.fecha_registro asc";
		
		$r = mysql_query($sql);
		$c = 2;
		while($row = mysql_fetch_array($r)){
			$text = "";
			if($row['estado_ot'] == 2){
				$text ="CERRADA";
			}else{
				$text ="ACTIVA";
			}
			$sql_tareas = mysql_query("select DISTINCT t.*, tp.name_ttarea, t.fecha_registro as fecha_re, ra.nombre_empleado as radicado_por,tr.codigo, dep.name_depto
			from tareas t , flujo_tareas tr, tipo_tarea tp, empleado ra, usuario u3,deptos_trafico dep
			where t.usuario = u3.idusuario and u3.pk_empleado = ra.documento_empleado and t.codigo_int_tarea= tr.consecutivo and t.codigo_departamento = dep.id and 
			t.tipo_tarea_codigo_tipotarea = tp.codigo_tipotarea $ste $sql_depto and t.pk_ot = '".$row['codigo_ot']."'
			and date_format(t.fecha_registro, '%Y-%m-%d') >= '$fd' and date_format(t.fecha_registro, '%Y-%m-%d') <= '$fh' order by t.codigo_int_tarea asc");
			
			while($rowx = mysql_fetch_array($sql_tareas)){
				$sql_responsable = mysql_query("select e.nombre_empleado as responsable
				from empleado e, usuario u, asignados_tareas atx
				where atx.pk_tarea = '".$rowx['codigo_int_tarea']."' and atx.pk_asignado = u.idusuario and u.pk_empleado = e.documento_empleado and atx.tipo = 'RES'");
				$responsable = "";
				while($rs = mysql_fetch_array($sql_responsable)){
					$responsable .=$rs['responsable']."</br>";
				}
				
				$sql_responsable = mysql_query("select e.nombre_empleado as responsable
				from empleado e, usuario u, asignados_tareas at
				where at.pk_tarea = '".$rowx['codigo_int_tarea']."' and at.pk_asignado = u.idusuario and u.pk_empleado = e.documento_empleado and at.tipo = 'ASI'");
				$asignado = "";
				while($rs = mysql_fetch_array($sql_responsable)){
					$asignado .=$rs['responsable']."</br>";
				}
				
				$text2 = "";
				if($rowx['estado'] == 0){
					$text2 ="PENDIENTE";
				}else if($rowx['estado'] == 1){
					$text2 ="CONTESTADA";
				}else{
					$text2 ="CANCELADA";
				}
				
				$val = "";
					if($rowx['codigo'] == 0){
						$val = "";
					}else{
						$val = ".".$rowx['codigo'];
					}
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$c, $row['nombre_comercial_empresa'])
					->setCellValue('B'.$c, $row['nombre_comercial_cliente'])
					->setCellValue('C'.$c, $row['nombre_producto'])
					->setCellValue('D'.$c, $row['codigo_ot'])
					->setCellValue('E'.$c, $row['director'])
					->setCellValue('F'.$c, $row['ejecutivo'])
					->setCellValue('G'.$c, strtoupper($row['referencia']))
					->setCellValue('H'.$c, strtoupper($row['descripcion']))
					->setCellValue('I'.$c, $text)
					->setCellValue('J'.$c, $rowx['fecha_registro'])
					->setCellValue('K'.$c, $rowx['codigo_tarea'].$val)
					->setCellValue('L'.$c, utf8_encode($rowx['name_ttarea']))
					->setCellValue('M'.$c, $rowx['fecha_re'])
					->setCellValue('N'.$c, $rowx['trabajo'])
					->setCellValue('O'.$c, $rowx['descripcion'])
					->setCellValue('P'.$c, $responsable)
					->setCellValue('Q'.$c, $asignado)
					->setCellValue('R'.$c, $rowx['nombre_area_empresa'])
					->setCellValue('S'.$c, $rowx['radicado_por'])
					->setCellValue('T'.$c, $text2)
					->setCellValue('U'.$c, $rowx['fecha_prometida'])
					->setCellValue('V'.$c, $rowx['hora_p'].":".$rowx['minutos_p']." ".$rowx['formato'])
					->setCellValue('W'.$c, $rowx['fecha_r'])
					->setCellValue('X'.$c, $rowx['hora_r']);
				$c++;
			}
		}
		$c--;
		$objPHPExcel->getActiveSheet()->getStyle("A1:X$c")->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        ));
		$objPHPExcel->getActiveSheet()->getStyle("A1:X1")->applyFromArray(array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '7FCD72')
                )
        ));
		$objPHPExcel->getActiveSheet()->getStyle("A1:X1")->getFont()->setBold(true)
                                ->getColor()->setRGB('FFFFFF');
		
		$objPHPExcel->getActiveSheet()->setTitle('REPORTE TAREAS');
		$objPHPExcel->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="reporte_tareas.xls"');
		header('Cache-Control: max-age=0');
		$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$objWriter->save('php://output');
		exit;
?>