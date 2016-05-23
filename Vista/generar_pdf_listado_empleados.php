<?php
	include("../Controller/Conexion.php");
	require('../mpdf/mpdf.php');
	$meses = array("Enero", "Febrero", "Marzo",
        "Abril", "Mayo", "Junio", "Julio",
        "Agosto", "Septiembre", "Octubre",
        "Noviembre", "Diciembre");
	$empresa = $_GET['ee'];
	$und =  $_GET['u'];
	$departamento =  $_GET['d'];
	$nombre =  $_GET['n'];
	$cedula =  $_GET['c'];
	$estado =  $_GET['e'];
	$fil_und = "";
	$fil_nombre = "";
	$fil_cedula = "";
	$fil_estado = "";
	$fil_departamento = "";
	if($und != 0){
		$fil_und = "and e.und = '$und'";
	}
	if($nombre != "0x"){
		$fil_nombre = "and e.nombre_empleado like '%$nombre%'";
	}
	
	if($cedula != 0){
		$fil_cedula = "and e.documento_empleado like '%$cedula%'";
	}
	
	if($estado != -1){
		if( $estado != 'undefined'){
			$fil_estado = "and e.estado like '%$estado%'";
		}
	}
	
	if( $departamento != 0){
		if( $departamento != "null"){
			$fil_departamento = "and e.pk_depto = '$departamento'";
		}
	}
	
	
	
	$pdf = new mPDF('utf-8', array(279,210));
	$pdf->AliasNbPages();
	$pdf->SetAutoPageBreak(true, 12);
 
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',10);
	
	$logo_empresa = mysql_query("select logo,nombre_legal_empresa,nit_empresa from empresa where cod_interno_empresa = '$empresa'");
	$logo = "";
	$nombre_empresa = "";
	$nit_empresa = "";
	while($row  = mysql_fetch_array($logo_empresa)){
		$logo = $row['logo'];
		$nombre_empresa = $row['nombre_legal_empresa'];
		$nit_empresa = $row['nit_empresa'];
	}
	$listado_empleados ="";
	$empleados = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,e.sexo_empleado,e.direccion_empleado,
			e.phone_casa_empleado,e.celular_empleado,e.cargo_empleado,e.email_empleado,e.fecha_nacimiento,e.tipo_documento_empleado,
			e.eps,e.rh,e.fecha_ingreso_empleado,e.fondo_pensiones,e.fondo_cesantias,e.caja_compensacion,e.arl,e.usuario,e.fecha_registro,emp.cod_interno_empresa,
			emp.nombre_comercial_empresa,ar.nombre_area_empresa from empleado e, area_empresa ar, empresa emp where 
			e.pk_depto = ar.codigo_interno_empresa  and ar.pk_empresa_areas = emp.cod_interno_empresa and emp.cod_interno_empresa = '$empresa' 
			$fil_departamento $fil_estado $fil_cedula $fil_nombre $fil_und
			order by e.nombre_empleado asc");
			$i = 1;
	
	while($row = mysql_fetch_array($empleados)){
		$dat = $row['fecha_ingreso_empleado'];
		$dat = explode("-",$dat);
		$fecha = $meses[floatval($dat[1])-1]." ".$dat[2]." ".$dat[0];
		$dat2 = $row['fecha_retiro'];
		$fechar = "";
		if($dat2 = "0000-00-00"){
			$fechar="";
		}else{
			$dat2 = explode("-",$dat2);
			$fechar = $meses[floatval($dat2[1])-1]." ".$dat2[2]." ".$dat2[0];
		}
		$text = "";
		$emp = $row['cod_interno_empresa'];
		$cedula = $row['documento_empleado'];
		if($row['estado'] == 1){
			$text = "ACTIVO";
		}else{
			$text = "INACTIVO";
		}
		$listado_empleados .= "<tr id = '$cedula' >
			
			<td >".number_format($cedula)."</td>
			<td nowrap>".$row['nombre_empleado']."</td>
			<td>".$row['cargo_empleado']."</td>
			<td nowrap>".$fecha."</td>
			<td nowrap>".$fechar."</td>
			<td>".$row['nombre_area_empresa']."</td>
		</tr>";
		$i++;
	}
	
	//<p>LISTADO DE PERSONAL DE LA EMPRESA <STRONG>'.$nombre_empresa.'</STRONG> IDENTIFICADA CON NIT NÚMERO<STRONG>'.$nit_empresa.'</STRONG> A PARTIR DE LOS SIGUIENTES FILTROS:</p>
	$html = '
		<table id = "tabla_central">
			<tr>
				<td width = "100%">
					<img src = "../images/logos/'.$logo.'" height = "80px"/>
				</td>
			</tr>
		</table>
		</br>
		
		</br>
		<table id = "tabla_listado" style="border-spacing:2px;">
			<tr>
				
				<th>DOCUMENTO</th>
				<th>NOMBRE</th>
				<th>CARGO</th>
				<th nowrap>FECHA DE INGRESO</th>
				<th nowrap>FECHA DE RETIRO</th>
				<th>ÁREA</th>
			</tr>'.$listado_empleados.'</table>';
			
			
	//$html=$html.'</table></div>';	
	$stylesheet = file_get_contents('p1.css');
	$pdf->WriteHTML($stylesheet,1);
	$pdf->WriteHTML($html);

	$pdf->Output('Reporte usuarios.pdf', 'I');
?>