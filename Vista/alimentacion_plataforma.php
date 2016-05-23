<?php
	include("../Controller/Conexion.php");
	require_once '../php/ext/PHPExcel-1.7.7/Classes/PHPExcel/IOFactory.php';
	$XLFileType = PHPExcel_IOFactory::identify('emple.xlsx');  
	
$objReader = PHPExcel_IOFactory::createReader($XLFileType);  

$objReader->setLoadSheetsOnly('Hoja1');  
$objPHPExcel = $objReader->load('emple.xlsx');  

//$columnas = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y");
$columnas = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB");//LA ESTACION

//$objWorksheet = $objPHPExcel->setActiveSheetIndexByName('Hoja1');  
$objWorksheet = $objPHPExcel->getActiveSheet();


$i = 1;
$emple = array();
$xxx = 1;

foreach ($objWorksheet->getRowIterator() as $row) { 
	
	$cellIterator = $row->getCellIterator();
	$cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
	$y = 0;
	$yyy = 0;
	/*for($f = 0; $f < 28; $f++){
		echo $objPHPExcel->getActiveSheet()->getCell($columnas[$f]."".$i)->getFormattedValue()."</br>";
	}
	$y++;*/
	foreach ($cellIterator as $cell){
		if($i == 1 || $i == 0){
			
		}else{
			
			$emple[$xxx][$yyy] = $objPHPExcel->getActiveSheet()->getCell($columnas[$y]."".$i)->getFormattedValue();	
			//echo $emple[$xxx][$yyy]."</br>";
			$yyy++;
			
		}
		$y++;
		
	}
	$i++;
	$xxx++;
}

for($xx = 2; $xx <=count($emple)+1; $xx++){
	$usuario = 1;
	$empresa = 1;
	$estado = 1;
	$fecha = date("Y-m-d H:i:s");
	$sql = mysql_query("insert into empleado (documento_empleado,nombre_empleado,sexo_empleado,
			cargo_empleado,fecha_nacimiento,tipo_documento_empleado,eps,rh,fecha_ingreso_empleado,fondo_pensiones,
			fondo_cesantias,caja_compensacion,arl,usuario,fecha_registro,pk_depto,pk_empresa,estado,und,email_empleado,email_personal,fecha_retiro,motivo_retiro,phone_casa_empleado,direccion_empleado,celular_empleado) values('".
			$emple[$xx][1]."','".$emple[$xx][2]."','".$emple[$xx][3]."','".$emple[$xx][17]."','".$emple[$xx][8]."','".$emple[$xx][0]."','".$emple[$xx][12]."','".
			$emple[$xx][7]."','".$emple[$xx][9]."','".$emple[$xx][13]."','".$emple[$xx][14]."','".$emple[$xx][15]."','".$emple[$xx][16]."','".$usuario."','".$fecha."','".
			$emple[$xx][19]."','".$empresa."','".$estado."','".$emple[$xx][18]."','".$emple[$xx][5]."','".$emple[$xx][6]."','".$emple[$xx][10]."','".$emple[$xx][11]."','".$emple[$xx][4]."','".$emple[$xx][26]."','".$emple[$xx][27]."')");
	
		
		$otros = 0;
		/*$sql_salarios = mysql_query("insert into salarios_empleado(fecha,pk_empleado,salario_base,otros,bonos_alimentacion,bnp) values ('".
		$fecha."','".$emple[$xx][1]."','".$emple[$xx][22]."','".$emple[$xx][24]."','".$emple[$xx][25]."','".$emple[$xx][23]."')");*/
		
		/*$sql_salarios = mysql_query("insert into salarios_empleado(fecha,pk_empleado,salario_base,otros,bonos_alimentacion,bnp) values ('".
		$fecha."','".$emple[$xx][0]."','".$emple[$xx][24]."','".$emple[$xx][26]."','".$emple[$xx][27]."','".$emple[$xx][25]."')");*/
		
		//echo $emple[$xx][22]."','".$emple[$xx][24]."','".$emple[$xx][25]."','".$emple[$xx][23]."</br>";
		//$sql_vacaciones = mysql_query("insert into vacaciones(cedula,dias) values('".$emple[$xx][1]."','".(floatval($emple[$xx][21]) )."')");
		//mysql_query("delete from empleado where documento_empleado = '".$emple[$xx][1]."'");
		//mysql_query("delete from salarios_empleado where pk_empleado = '".$emple[$xx][1]."'");
		//mysql_query("delete from vacaciones where cedula = '".$emple[$xx][1]."'");
}
//echo $table."</table>";
/*
	//echo $objPHPExcel->getActiveSheet()->getCell($columnas[$y]."".$i)->getFormattedValue()."-- ";
	//echo $objPHPExcel->getActiveSheet()->getCell($columnas[$r]."".$i)->getFormattedValue()."</br>";	
	//echo $cell->getCellByColumnAndRow($i,$y)->getFormattedValue()."</br>";
	//echo $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($i, $y)->getFormattedValue()."$i -- $y</br>";
*/
?>