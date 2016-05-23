<?php
	include("../Controller/Conexion.php");
	require_once '../php/ext/PHPExcel-1.7.7/Classes/PHPExcel/IOFactory.php';
	$XLFileType = PHPExcel_IOFactory::identify('subir.xls');  
	
$objReader = PHPExcel_IOFactory::createReader($XLFileType);  

$objReader->setLoadSheetsOnly('REPORTE OTS');  
$objPHPExcel = $objReader->load('subir.xls');  

//$columnas = array("A","B","C","D","E","F","G","H","I");//,"I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y");
$columnas = array("A","B","C","D","E","F","G","H","I");//LA ESTACION

//$objWorksheet = $objPHPExcel->setActiveSheetIndexByName('Hoja1');  
$objWorksheet = $objPHPExcel->getActiveSheet();


$i = 1;
$emple = array();
$xxx = 1;
	ini_set('memory_limit', '512M');
	ini_set('max_execution_time','360');
	$user = 'pr1';
	$pass = '1234';
	$server = 'COMTOTALSQL01\TORO_LOVE';
	$database = 'Erptrafico';
	$connection_string = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database"; 
	$conn = odbc_connect($connection_string,$user,$pass);
	if ($conn) {
	} else{
		die("PROBLEMA CON LA CONEXIÓN ".odbc_errormsg());
	}

foreach ($objWorksheet->getRowIterator() as $row) { 
	/*if($i > 1){
		$cellIterator = $row->getCellIterator();
		$cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
		$codigo_ot = $objPHPExcel->getActiveSheet()->getCell($columnas[3]."".$i)->getFormattedValue();
		$director = $objPHPExcel->getActiveSheet()->getCell($columnas[4]."".$i)->getFormattedValue();;
		$eje = $objPHPExcel->getActiveSheet()->getCell($columnas[5]."".$i)->getFormattedValue();;
		$fecha = $objPHPExcel->getActiveSheet()->getCell($columnas[6]."".$i)->getFormattedValue();;
		$empresa = $objPHPExcel->getActiveSheet()->getCell($columnas[0]."".$i)->getFormattedValue();;
		$cliente = $objPHPExcel->getActiveSheet()->getCell($columnas[1]."".$i)->getFormattedValue();;
		$producto = $objPHPExcel->getActiveSheet()->getCell($columnas[2]."".$i)->getFormattedValue();;
		$estado = 1;
		$year = 2015;
		$referencia = $objPHPExcel->getActiveSheet()->getCell($columnas[7]."".$i)->getFormattedValue();;
		$desc = $objPHPExcel->getActiveSheet()->getCell($columnas[8]."".$i)->getFormattedValue();;
		$usuario = 1;
		mysql_query("INSERT INTO cabot(codigo_ot,referencia,descripcion,director,ejecutivo,pk_nit_empresa_ot,producto_clientes_pk_clientes_nit_procliente,producto_clientes_codigo_PRC,estado,year_ot,usuario) 
		values ('".$codigo_ot."','".$referencia."','".$desc."','".$director.
		"','".$eje."','".$empresa."','".$cliente."','".$producto."','".$estado."','".$year."','".$usuario."')");
		echo mysql_error();
		/*$destino ="../Process/OT/".$codigo_ot;
		mkdir($destino);
		$destino ="../Process/OT/".$codigo_ot."/TAREAS";
		mkdir($destino);
	}
	*/
	/*if($i > 1){
		$cellIterator = $row->getCellIterator();
		$cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
		$name = $objPHPExcel->getActiveSheet()->getCell($columnas[0]."".$i)->getFormattedValue();
		$usuario = 1;
		mysql_query("INSERT INTO tipo_tarea(name_ttarea)values ('".$name."')");
		echo mysql_error();
	}*/
	
	/*if($i > 1){
		$cellIterator = $row->getCellIterator();
		$cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
		$pptado = $objPHPExcel->getActiveSheet()->getCell($columnas[0]."".$i)->getFormattedValue();
		$ejecutado = $objPHPExcel->getActiveSheet()->getCell($columnas[1]."".$i)->getFormattedValue();
		$mes = $objPHPExcel->getActiveSheet()->getCell($columnas[2]."".$i)->getFormattedValue();
		$cliente = $objPHPExcel->getActiveSheet()->getCell($columnas[3]."".$i)->getFormattedValue();
		$year = $objPHPExcel->getActiveSheet()->getCell($columnas[4]."".$i)->getFormattedValue();
		$und = $objPHPExcel->getActiveSheet()->getCell($columnas[5]."".$i)->getFormattedValue();
		$usuario = 1;
		mysql_query("INSERT INTO saldo_facturacion(pptado,ejecutado,mes,cliente,year,und)values ('".$pptado."','".$ejecutado."','".$mes."','".$cliente."','".$year."','".$und"')");
		echo mysql_error();
	}*/
	
	if($i > 1){
		$cellIterator = $row->getCellIterator();
		$cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
		$emp = $objPHPExcel->getActiveSheet()->getCell($columnas[0]."".$i)->getFormattedValue();
		$cliente = $objPHPExcel->getActiveSheet()->getCell($columnas[1]."".$i)->getFormattedValue();
		$producto = $objPHPExcel->getActiveSheet()->getCell($columnas[2]."".$i)->getFormattedValue();
		$referencia = $objPHPExcel->getActiveSheet()->getCell($columnas[6]."".$i)->getFormattedValue();
		$res = $objPHPExcel->getActiveSheet()->getCell($columnas[4]."".$i)->getFormattedValue();
		$obser = $objPHPExcel->getActiveSheet()->getCell($columnas[6]."".$i)->getFormattedValue();
		$eje = $objPHPExcel->getActiveSheet()->getCell($columnas[5]."".$i)->getFormattedValue();
		$fecha = $objPHPExcel->getActiveSheet()->getCell($columnas[8]."".$i)->getFormattedValue();
		$por = $objPHPExcel->getActiveSheet()->getCell($columnas[5]."".$i)->getFormattedValue();
		$ot = $objPHPExcel->getActiveSheet()->getCell($columnas[3]."".$i)->getFormattedValue();
		$est = 1;
		$hora ="16:27:40";
		$cur=odbc_exec($conn,"INSERT INTO tropes0(opnum,codclte,codprod,referencia,oprespons,observ,codejecut,opfecha,estado_ot,codempresa,creadopor,ophora) values(
		'$ot','$cliente','$producto','$referencia','$res','$obser','$eje','$fecha','$est','$emp','$por','$hora')");
	}
	$i++;
}
?>