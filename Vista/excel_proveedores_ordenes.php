<?php
	ini_set('memory_limit', '512M');
	ini_set('max_execution_time','360');
	$user = 'pr1';
	$pass = '1234';
	$server = 'COMTOTALSQL01\TORO_LOVE';
	$database = 'Consolidado';
	$connection_string = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database"; 
	$conn = odbc_connect($connection_string,$user,$pass);
	if ($conn) {
	} else{
		die("PROBLEMA CON LA CONEXIÓN ".odbc_errormsg());
	}
	require_once 'PHPExcel/Classes/PHPExcel.php';
	require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->
				getProperties()
			   ->setCreator("process.toro-love.com")
			   ->setLastModifiedBy("process.toro-love.com")
			   ->setTitle("REPORTE PROVEEDORES") 
			   ->setSubject("REPORTE PROVEEDORES")
			   ->setDescription("REPORTE PROVEEDORES")
			   ->setKeywords("PROCESS")
			   ->setCategory("REPORTE PROVEEDORES");
	$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1', '')
					->setCellValue('B1', 'EMPRESA')
					->setCellValue('C1', 'CLIENTE')
				->setCellValue('D1', 'PRODUCTO')
				->setCellValue('E1', '# PPTO')
				->setCellValue('F1', 'REFERENCIA PPTO')
				->setCellValue('G1', 'NIT PROVEEDOR')
				->setCellValue('H1', 'PROVEEDOR')
				->setCellValue('I1', 'ORDEN')
				->setCellValue('J1', 'VALOR ORDEN')
				->setCellValue('K1', 'ESTADO EN SISTEMA')
				->setCellValue('L1', 'CONCEPTO')
				->setCellValue('M1', 'FACT. PROV')
				->setCellValue('N1', 'NUM. RADICADO')
				->setCellValue('O1', 'TIPO DE ORDEN')
				->setCellValue('P1', 'ESTADO')
				->setCellValue('Q1', 'FORMA DE PAGO')
				->setCellValue('R1', 'FECHA1')
				->setCellValue('S1', 'FECHA2');
	$objPHPExcel->getActiveSheet()->getStyle("A1:S1")->getFont()->setBold(true);
					
	for ($col = 'A'; $col != 'S'; $col++) {
		$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
	}
	$c = 2;
	$cur=odbc_exec($conn,"select po.nAutoNumPpto, po.nNumOrden, po.dFecha, po.dFechaEntrega, po.IdProveedor,po.FechaRadicacion,
					CAST(est.tNombre AS TEXT) AS ESTADO_ORDEN, CAST(fp.tnombre AS TEXT) AS FORMA_PAGO, pe.nCodAgencia as Numero_ppto,
					pe.tReferencia as referencia_ppto, CAST(em.nomempresa AS TEXT) as nombre_empresa, pe.nCodTerceroCL as codigo_cliente, pe.nCodProducto,po.tipo_orden,
					pd.nCostoUnidadTo as valor_item_ppto, pd.nIvaCostoTo as iva_item_ppto, pd.nDias as dias, pd.ncantidad as cantidad_items, CAST(pd.tconcepto AS TEXT) as concepto
					FROM Estados est, FormasPago fp, PptosOrdenes po, PptoEncab pe, empresas em, PptoDetalle pd
					where po.nformapago = fp.ncodforpag and po.nEstado = est.nCodEstado and po.nAutoNumPpto = pe.nAutoNumPpto and pe.nCodEmpresa = em.codempresas
					and po.nAutoNumPpto = pd.nAutoNumPpto and po.nAutoNumOrden = pd.nAutoNumOrden and year(dFechaCreacion) = '2015'"); 
					$i = 1;
					while(odbc_fetch_row($cur)){
						$codigo_cliente = odbc_result($cur,"codigo_cliente");
						$codigo_producto = odbc_result($cur,"nCodProducto");
						$codigo_proveedor = odbc_result($cur,"IdProveedor");
						$nombre_cliente = "";
						$nombre_producto = "";
						$numero_orden = odbc_result($cur,"nNumOrden");
						
						$database2 = 'Erptrafico';
						$connection_string2 = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database2"; 
						$conn2 = odbc_connect($connection_string2,$user,$pass);
						$cur2 = odbc_exec($conn2,"select cast(prnombre as text) as producto FROM products where prcodigo = '$codigo_producto'");
						while(odbc_fetch_row($cur2)){
							$nombre_producto = odbc_result($cur2,"producto");
						}
						$cur2 = odbc_exec($conn2,"select cast(apellidos as text) as cliente FROM ivtercer where codigo = '$codigo_cliente'");
						while(odbc_fetch_row($cur2)){
							$nombre_cliente = odbc_result($cur2,"cliente");
						}
						$database2 = 'UnionEmpresas';
						$connection_string2 = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database2"; 
						$conn2 = odbc_connect($connection_string2,$user,$pass);
						$nombre_proveedor = "";
						$nit_proveedor = "";
						$cur2 = odbc_exec($conn2,"select cast(nombre as text) as nombre,nit FROM tblprovedoresh where consecutiv = '$codigo_proveedor'");
						while(odbc_fetch_row($cur2)){
							$nombre_proveedor = odbc_result($cur2,"nombre");
							$nit_proveedor = odbc_result($cur2,"nit");
						}
						$database2 = 'BdfacturasProv';
						$connection_string2 = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database2"; 
						$conn2 = odbc_connect($connection_string2,$user,$pass);
						$estado_factura = "SIN REGISTRAR";
						$factura_proveedor ="SIN REGISTRAR";
						$num_radicado ="SIN REGISTRAR";
						$cur2 = odbc_exec($conn2,"select noorden,numfactprov,numradicado FROM tblencabezado where noorden = '$numero_orden'");
						while(odbc_fetch_row($cur2)){
							$estado_factura = "REGISTRADA";
							$factura_proveedor = odbc_result($cur2,"numfactprov");
							$num_radicado = odbc_result($cur2,"numradicado");
						}
						$cantidad =  odbc_result($cur,"dias") *  odbc_result($cur,"cantidad_items");
						//$val_item = odbc_result($cur,"valor_item_ppto")+(odbc_result($cur,"valor_item_ppto") *(odbc_result($cur,"iva_item_ppto")/100));
						$val_item = odbc_result($cur,"valor_item_ppto")*$cantidad;
						$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$c, $i)
							->setCellValue('B'.$c, odbc_result($cur,"nombre_empresa"))
							->setCellValue('C'.$c, utf8_decode($nombre_cliente))
							->setCellValue('D'.$c, utf8_encode($nombre_producto))
							->setCellValue('E'.$c, utf8_encode(odbc_result($cur,"Numero_ppto")))
							->setCellValue('F'.$c, utf8_encode(odbc_result($cur,"referencia_ppto")))
							->setCellValue('G'.$c, utf8_encode($nit_proveedor))
							->setCellValue('H'.$c, utf8_encode($nombre_proveedor))
							->setCellValue('I'.$c, odbc_result($cur,"nNumOrden"))
							->setCellValueExplicit('J'.$c,$val_item,PHPExcel_Cell_DataType::TYPE_NUMERIC)
							->setCellValue('K'.$c, $estado_factura)
							->setCellValue('L'.$c, utf8_encode(odbc_result($cur,"concepto")))
							->setCellValue('M'.$c, $factura_proveedor)
							->setCellValue('N'.$c, $num_radicado)
							->setCellValue('O'.$c, utf8_encode(odbc_result($cur,"tipo_orden")))
							->setCellValue('P'.$c, utf8_encode(odbc_result($cur,"ESTADO_ORDEN")))
							->setCellValue('Q'.$c, utf8_encode(odbc_result($cur,"FORMA_PAGO")))
							->setCellValue('R'.$c, odbc_result($cur,"dFechaEntrega"))
							->setCellValue('S'.$c, odbc_result($cur,"FechaRadicacion"));
							$c++;
							$i++;
						
					}
	$c--;
	$objPHPExcel->getActiveSheet()->getStyle("A1:S$c")->applyFromArray(array(
		'borders' => array(
		'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	));
	$objPHPExcel->getActiveSheet()->getStyle("A1:S1")->applyFromArray(array(
		'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array('rgb' => '7FCD72')
		)
	));
	$objPHPExcel->getActiveSheet()->getStyle("A1:S1")->getFont()->setBold(true)
											->getColor()->setRGB('FFFFFF');
					
	$objPHPExcel->getActiveSheet()->setTitle('REPORTE PROVEEDORES');
	$objPHPExcel->setActiveSheetIndex(0);

	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="REPORTE PPTOS - ORDENES.xls"');
	header('Cache-Control: max-age=0');
	$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
	$objWriter->save('php://output');
	exit;
?>