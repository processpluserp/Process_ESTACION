<?php
	include("../Controller/Conexion.php");
	include("../Modelo/empleado.php");
	$empleado = new empleado();
	require_once '../php/ext/PHPExcel-1.7.7/Classes/PHPExcel/IOFactory.php';
	$XLFileType = PHPExcel_IOFactory::identify($_FILES['nomina_excel0']['tmp_name']);  
	$objReader = PHPExcel_IOFactory::createReader($XLFileType);  

	$objReader->setLoadSheetsOnly('Hoja1');  
	$objPHPExcel = $objReader->load($_FILES['nomina_excel0']['tmp_name']);  
	$columnas = array("A","B","C","D","E","F","G","H");//LA ESTACION
	$objWorksheet = $objPHPExcel->getActiveSheet();


	$i = 1;
	$emple = array();
	$periodo = date("Y")."-".floatval(date("m"));
	$periodo = date("Y")."-".floatval(date("m"));
	$dias = 30;
	foreach ($objWorksheet->getRowIterator() as $row) { 
		
		if($i > 1){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
			$cedula_empleado = $objPHPExcel->getActiveSheet()->getCell($columnas[0]."".$i)->getFormattedValue();
			$salario_base = $objPHPExcel->getActiveSheet()->getCell($columnas[1]."".$i)->getFormattedValue();
			$bnp = $objPHPExcel->getActiveSheet()->getCell($columnas[2]."".$i)->getFormattedValue();
			$alimentacion = $objPHPExcel->getActiveSheet()->getCell($columnas[3]."".$i)->getFormattedValue();
			$otros = $objPHPExcel->getActiveSheet()->getCell($columnas[4]."".$i)->getFormattedValue();
			$afc = $objPHPExcel->getActiveSheet()->getCell($columnas[5]."".$i)->getFormattedValue();
			$rete = $objPHPExcel->getActiveSheet()->getCell($columnas[6]."".$i)->getFormattedValue();
			$disfrutadas = $objPHPExcel->getActiveSheet()->getCell($columnas[7]."".$i)->getFormattedValue();
			
			$sql_valida = mysql_query("select cedula from tablas_empleados where cedula = '$cedula_empleado' and periodo = '$periodo'");
			
			if(mysql_num_rows($sql_valida) == 0){
				$sql = mysql_query("SELECT salario_base,otros,bonos_alimentacion,bnp from salarios_empleado where pk_empleado = '$cedula_empleado'");
				while($row = mysql_fetch_array($sql)){
					if($row['salario_base'] < $salario_base || $row['bnp'] < $bnp){
						mysql_query("update salarios_empleado set salario_base = '$salario_base', bnp = '$bnp',bonos_alimentacion = '$alimentacion', otros = '$otros' where pk_empleado = '$cedula_empleado'");
					}
					$sql2 = mysql_query("select pk_empresa,pk_depto,und from empleado where documento_empleado = '$cedula_empleado'");
					while($xrow = mysql_fetch_array($sql2)){
						$indemn = $empleado->vacaciones($salario_base) + $empleado->prima($salario_base,$xrow['pk_empresa'],date("Y")) + $empleado->cesantias($salario_base,$xrow['pk_empresa'],date("Y")) + $empleado->int_cesantias($salario_base,$xrow['pk_empresa'],date("Y"));
						$vacas = 1.25;
						$liquidacion = $empleado->indemnizaciones($salario_base,$salario_base,$xrow['pk_empresa'],date("Y"));
						$insert = mysql_query("insert into tablas_empleados(cedula,depto,usuario,dias,salario_base,otros,bnp,balimentacion,indemnizacion,liquidacion,
						vacaciones,fecha,empresa,periodo,rte,afc,und) values('".$cedula_empleado."','".$xrow['pk_depto']."','".$_POST['usuario']."','".$dias."','".$salario_base."','".$otros."','".$bnp
						."','".$alimentacion."','".$indemn."','".$liquidacion."','".$vacas."','".date('Y-m-d')."','".$xrow['pk_empresa']."','".$periodo."','".$rete."','".$afc."','".$xrow['und']."')");	
						
						$sql_vacas = mysql_query("select id,cedula,dias from vacaciones where cedula = '$cedula_empleado'");
						while($v = mysql_fetch_array($sql_vacas)){
							$id = $v['id'];
							$valor = $v['dias'] + $vacas;
							if($disfrutadas > 0){
								$valor = $valor - $disfrutadas;
							}
							mysql_query("update vacaciones set dias = '$valor' where cedula = '$cedula_empleado' and id = '$id'");
						}
					}
				}
			}else{
				echo "CEDULA NO ENCONTRADA ($cedula_empleado)\n";
			}
		}
		
		$i++;
	}
	$sql = mysql_query("select periodo from costos_admin_nomina where periodo = '$periodo'");
	if(mysql_num_rows($sql) == 0){
		$sql = mysql_query("insert into costos_admin_nomina(periodo,empresa) values('".$periodo."','".$_POST['emp']."')");
	}
?>