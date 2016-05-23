<?php
	include("../Controller/Conexion.php");
	
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
		//->setCellValue('E1', 'DIRECTOR')
		//->setCellValue('F1', 'EJECUTIVO')
		->setCellValue('E1', 'REFERENCIA')
		->setCellValue('F1', '# TAREA')
		->setCellValue('G1', 'TRABAJO')
		->setCellValue('H1', 'RADICADO POR')
		->setCellValue('I1', 'RESPONSABLE')
		->setCellValue('J1', 'ASIGNADO')
		->setCellValue('K1', 'FECHA DE ENVÍO DE SOLICITUD')
		->setCellValue('L1', 'FECHA DE RESPUESTA');
	$objPHPExcel->getActiveSheet()->getStyle("A1:L1")->getFont()->setBold(true);
	
	for ($col = 'A'; $col != 'M'; $col++) {
		$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
	}
	$tabla = "<table  	width = '100%'>
				<thead>
					<tr>
						<th nowrap>EMPRESA</th>
						<th nowrap>CLIENTE</th>
						<th nowrap>OT</th>
						<th nowrap># TAREA</th>
						<th nowrap>REFERENCIA</th>
						<th nowrap>TRABAJO</th>
						<th nowrap>RADICADO POR</th>
						<th nowrap>RESPONSABLE</th>
						<th nowrap>ASIGNADO</th>
						<th nowrap>FECHA</th>
					</tr>
				</thead><tbody>";
			
			$sql_1=mysql_query("select distinct t.pk_ot, t.codigo_int_tarea,t.codigo_tarea, ft.codigo, ot.referencia,t.trabajo,t.fecha_registro as fecha_prometida,ot.id as id_ot,
			t.usuario, e2.nombre_empleado as radicado_por, ft.num_tarea, emp.nombre_comercial_empresa, c.nombre_comercial_cliente, pr.nombre_producto,t.fecha_r
																	

			from tareas t, flujo_tareas ft, cabot ot, usuario u2, empleado e2, asignados_tareas ax, clientes c, empresa emp, producto_clientes pr
																	
			where t.codigo_int_tarea = ft.pk_tarea  and ot.codigo_ot = t.pk_ot and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente and ot.pk_nit_empresa_ot = emp.cod_interno_empresa and ot.producto_clientes_codigo_PRC = pr.id_procliente

			and t.usuario = u2.idusuario and u2.pk_empleado = e2.documento_empleado 

			and t.codigo_int_tarea = ax.pk_tarea  and ax.pk_ot = ot.id and ot.estado = '1' and

			ax.pk_asignado = 55 and( ax.tipo = 'RES' or ax.tipo = 'ASI') and date_format(t.fecha_prometida, '%Y-%m-%d') >= '2016-02-01' and date_format(t.fecha_prometida, '%Y-%m-%d') <= '".date("Y-m-d")."'

			order by t.fecha_registro asc");
			$tt = 1;
			$c = 2;
			while($trow = mysql_fetch_array($sql_1)){
				
				$id_tareaa = $trow['codigo_int_tarea'];
				$sql_info_res = mysql_query("select pk_asignado from asignados_tareas where pk_tarea = '$id_tareaa' and tipo = 'RES' and pk_asignado = 72");
				$id = $trow['codigo_int_tarea'];
				$id_ot = $trow['id_ot'];
				$responsables = "";
				$asignados = "";
				$sql_res = mysql_query("select e.nombre_empleado as responsable,ax.tipo
				from tareas t, usuario u, asignados_tareas ax, empleado e
				where t.codigo_int_tarea ='$id' and t.codigo_int_tarea = ax.pk_tarea and ax.pk_asignado = u.idusuario 
				and u.pk_empleado = e.documento_empleado");
				while($xrow = mysql_fetch_array($sql_res)){
					if($xrow['tipo'] == 'RES'){
						$responsables .=$xrow['responsable']." - ";
					}else if($xrow['tipo'] == 'ASI'){
						$asignados .=$xrow['responsable']." - ";	
					}
				}
				$comp = "";
				if($trow['codigo'] == 0){
					$comp = $trow['num_tarea'];
				}else{
					$comp = $trow['num_tarea'].".".$trow['codigo'];
				}
				/*echo "<tr>
					<td align = 'center' nowrap>$tt ".."</td>
					<td align = 'center' nowrap>$tt ".."</td>
					<td align = 'center' nowrap>$tt ".$trow['pk_ot']."</td>
					<td style = 'text-align:left;padding-left:10px;' nowrap>".."</td>
					<td style = 'text-align:left;padding-left:10px;' nowrap>".."</td>
					<td style = 'text-align:left;padding-left:10px;' nowrap>".."</td>
					<td style = 'text-align:left;padding-left:10px;' nowrap>".."</td>
					<td style = 'text-align:left;padding-left:10px;' nowrap>".$."</td>
					<td style = 'text-align:left;padding-left:10px;' nowrap>".$asignados."</td>
					<td style = 'text-align:left;padding-left:10px;' nowrap>".$trow['fecha_prometida']."</td>
				</tr>";*/
				
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$c, utf8_decode($trow['nombre_comercial_empresa']))
					->setCellValue('B'.$c, utf8_decode($trow['nombre_comercial_cliente']))
					->setCellValue('C'.$c, ($trow['nombre_producto']))
					->setCellValue('D'.$c, $trow['pk_ot'])
					//->setCellValue('E'.$c, $row['director'])
					//->setCellValue('F'.$c, $row['ejecutivo'])
					->setCellValue('E'.$c, ($trow['referencia']))
					->setCellValue('F'.$c, $comp)
					->setCellValue('G'.$c, (($trow['trabajo'])))
					->setCellValue('H'.$c, ($trow['radicado_por']))
					->setCellValue('I'.$c, $responsables)
					->setCellValue('J'.$c, $asignados)
					->setCellValue('K'.$c, $trow['fecha_prometida'])
					->setCellValue('L'.$c, $trow['fecha_r']);
				$c++;
				$tt++;
			}
			
			$c--;
		$objPHPExcel->getActiveSheet()->getStyle("A1:L$c")->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        ));
		$objPHPExcel->getActiveSheet()->getStyle("A1:L1")->applyFromArray(array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '7FCD72')
                )
        ));
		$objPHPExcel->getActiveSheet()->getStyle("A1:L1")->getFont()->setBold(true)
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