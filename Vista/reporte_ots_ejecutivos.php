<?php
	include("../Controller/Conexion.php");
	
	
	
	
	echo "<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		
		<style type = 'text/css'>
			.tabla_comprimosos_ie th{
				border:1px solid black;
				background-color:white;
			}
			.tabla_comprimosos_ie td{
				border:1px solid black;
			}
			.tabla_comprimosos_ie th:first-child{
				border-top-left-radius:0.3em;
				-moz-border-top-left-radius:0.3em;
				-webkit-border-top-left-radius:0.3em;
			}
			.tabla_comprimosos_ie th:last-child{
				border-top-right-radius:0.3em;
				-moz-border-top-right-radius:0.3em;
				-webkit-border-top-right-radius:0.3em;
			}
		</style>
	</head>
	<body>";
	$sql_empresas = mysql_query("select distinct emp.nombre_comercial_empresa,emp.cod_interno_empresa
	from cabot ot, empresa emp
	where ot.pk_nit_empresa_ot = emp.cod_interno_empresa order by emp.nombre_comercial_empresa asc");
	
	echo "<h1 style = 'width:100%;text-align:center;'>REPORTE # DE OTS POR EJECUTIVO</h1>";
	echo "<img src='http://localhost:82/Process/images/Untitled-1-01.png' width = '300px'/>";
	echo "<table width = '100%'>";
	
	while($rowemp = mysql_fetch_array($sql_empresas)){
		$empresa = $rowemp['cod_interno_empresa'];
		$contar_ots_empresa = 0;
		echo "<tr>";
			echo "<td style = 'border:1px solid black;width:15%;padding-left:5px;'>".$rowemp['nombre_comercial_empresa']."</td>";
			
			$sql_directores = mysql_query("select distinct ot.director as id_user_director, e.nombre_empleado as director
			from cabot ot, usuario u, empleado e
			where ot.estado = '1' and ot.pk_nit_empresa_ot = '$empresa' and ot.director = u.idusuario and u.pk_empleado = e.documento_empleado order by e.nombre_empleado asc");
				
			echo "<td style = 'border:1px solid black;'>";
				echo "<table width = '100%'>";
				while($row = mysql_fetch_array($sql_directores)){
					$contar_ots_director = 0;
					echo "<tr>";
						echo "<td style = 'border:1px solid black;width:20%;'>".utf8_decode($row['director'])."</td>";
					
					$cod_director = $row['id_user_director'];
					
					$sql_ejecutivos = mysql_query("select distinct e.nombre_empleado as ejecutivo, ot.ejecutivo as id_user_ejecutivo
					from cabot ot, usuario u, empleado e
					where ot.estado = '1' and ot.director = '$cod_director' and ot.pk_nit_empresa_ot = '$empresa'  and ot.ejecutivo = u.idusuario and u.pk_empleado = e.documento_empleado order by e.nombre_empleado asc");
					
						echo "<td style = 'border:1px solid black;'>";
							echo "<table width = '100%'>";
								
								while($roweje = mysql_fetch_array($sql_ejecutivos)){
									$contar_ots_ejecutivo = 0;
									$cod_ejecutivo = $roweje['id_user_ejecutivo'];
									echo "<tr>";
										echo "<td style = 'border:1px solid black;width:20%;'>".utf8_decode($roweje['ejecutivo'])."</td>";							
										
										$sql_cuentas = mysql_query("select distinct c.nombre_comercial_cliente,ot.producto_clientes_pk_clientes_nit_procliente
										from cabot ot, clientes c
										where ot.director = '$cod_director' and ot.pk_nit_empresa_ot = '$empresa' and ot.ejecutivo = '$cod_ejecutivo' and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente");
											echo "<td style = 'border:1px solid black;'>";
												echo "<table width = '100%'>";
										while($rowc = mysql_fetch_array($sql_cuentas)){
													$cod_cliente = $rowc['producto_clientes_pk_clientes_nit_procliente'];
													echo "<tr>";
														echo "<td style = 'border:1px solid black;width:20%;'>".utf8_decode($rowc['nombre_comercial_cliente'])."</td>";
														$sql_cuenta_ots = mysql_query("select codigo_ot 
														from cabot 
														where  director = '$cod_director' and pk_nit_empresa_ot = '$empresa' and ejecutivo = '$cod_ejecutivo' and producto_clientes_pk_clientes_nit_procliente = '$cod_cliente'");
														$i = 0;
														while($rowot = mysql_fetch_array($sql_cuenta_ots)){
															$i++;
														}
														$contar_ots_ejecutivo += $i;
														echo "<td style = 'border:1px solid black;width:5%;'>".($i)."</td>";
													echo "</tr>";		
										}
										echo "</table>";
										echo "</tr>";
										echo "<tr><th colspan = '2' align = 'center'>TOTAL POR EJECUTIVO		$contar_ots_ejecutivo</th></tr>";
									echo "<tr><td></td></tr>";
									$contar_ots_director += $contar_ots_ejecutivo;
								}
									echo "</table>";
					echo "</tr>";
					echo "<tr><th colspan = '2' align = 'center' style = 'color:red;'>TOTAL POR DIRECTOR		$contar_ots_director</th></tr>";
					echo "<tr><td></td></tr>";
					
					$contar_ots_empresa += $contar_ots_director;
				}
				echo "</td>";
			echo "</tr>";
			
		echo "</table>";
		echo "<tr><th colspan = '2' align = 'center' style = 'color:white;background-color:red;'>TOTAL POR EMPRESA		$contar_ots_empresa</th></tr>";
		echo "<tr><td></br></td></tr>";
	}
	echo "</table>";
	echo "</body>";
	
	/*require_once 'PHPExcel/Classes/PHPExcel.php';
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
			  ->setCellValue('A1', 'EMPRESA')
			  ->setCellValue('B1', 'DIRECTOR')
			  ->setCellValue('C1', 'EJECUTIVO')
			  ->setCellValue('D1', 'CLIENTE')
			->setCellValue('E1', 'PRODUCTO')
			->setCellValue('F1', '# OT ')
			->setCellValue('G1', 'REFERENCIA')
			->setCellValue('H1', 'FECHA CREACIÓN');
		$objPHPExcel->getActiveSheet()->getStyle("A1:J1")->getFont()->setBold(true);*/
	
	/*	for ($col = 'A'; $col != 'G'; $col++) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
		}
	$sql_ots = mysql_query("select e.nombre_comercial_empresa, c.nombre_comercial_cliente, pr.nombre_producto,ot.codigo_ot,ot.estado, 
			ot.fecha_registro,eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director,ot.referencia
			from empresa e, clientes c, producto_clientes pr, cabot ot,empleado eje, usuario u1,empleado dir, usuario u2
			where ot.pk_nit_empresa_ot = e.cod_interno_empresa and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente and
			ot.producto_clientes_codigo_PRC = pr.id_procliente and ot.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado
			and ot.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado and ot.estado = '1'");
			$c = 2;
	while($rowx = mysql_fetch_array($sql_ots)){
		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$c, $rowx['nombre_comercial_empresa'])
				->setCellValue('B'.$c, $rowx['director'])
				->setCellValue('C'.$c, $rowx['ejecutivo'])
				->setCellValue('D'.$c, $rowx['nombre_comercial_cliente'])
				->setCellValue('E'.$c, $rowx['nombre_producto'])
				->setCellValue('F'.$c, $rowx['codigo_ot'])
				->setCellValue('G'.$c, $rowx['referencia'])
				->setCellValue('H'.$c, $rowx['fecha_registro']);
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
		*/
		/*$objPHPExcel->getActiveSheet()->setTitle('REPORTE ESTADO PPTOS X UND');
		$objPHPExcel->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="REPORTE GENERAL DE OTS"'.date("Y-m-d h:i:s").'".xls"');
		header('Cache-Control: max-age=0');
		$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$objWriter->save('php://output');
		exit;*/
?>