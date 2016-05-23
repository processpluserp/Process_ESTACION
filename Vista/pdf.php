<?php
	require_once("dompdf/dompdf_config.inc.php");
	$html = "<html>
		</head>
			<meta charset='utf-8' />
			<link type='text/css' href='style.css' rel='stylesheet' />
		</head>
		<body><h1 width = '100%' align='center;'>ORDEN DE TRABAJO #545</h1>
		<table width = '100%'>
			<tr class = 'lleno'>
				<td >Fecha ".date('d-m-Y')."</td>
				<td >Ciudad</td>
				<td >".utf8_decode("Bogotá")."</td>
			</tr>
			<tr class = 'vacio'>
				<td ></td>
				<td ></td>
				<td ></td>
			</tr>
			<tr class = 'vacio'>
				<td ></td>
				<td ></td>
				<td ></td>
			</tr>
			<tr class = 'lleno'>
				<td >CLIENTE: DU BRANS SAS</td>
				<td >NIT</td>
				<td >900.275.221-6</td>
			</tr>
			<tr class = 'lleno'>
				<td colspan = '3'>PREGUNTAR ????</td>
			</tr>
			<tr class = 'vacio'>
				<td ></td>
				<td ></td>
				<td ></td>
			</tr>
			<tr class = 'vacio'>
				<td ></td>
				<td ></td>
				<td ></td>
			</tr>
			<tr class = 'lleno'>
				<td colspan = '3'>PERSONAS ENCARGADAS DEL TRABAJO</td>
			</tr>
			<tr class = 'lleno'>
				<td colspan = '2'>PROVEEDOR: '$nombre_proveedor'</td>
				<td >TELEFONOS: $telefono</td>
			</tr>
			<tr class = 'lleno'>
				<td colspan = '2'>DIRECCION: '$direccion'</td>
				<td >NIT: '$nit_proveedor'</td>
			</tr>
			<tr class = 'lleno'>
				<td colspan = '2'>'$nombre_empresa': '$dueno_empresa'</td>
				<td ></td>
			</tr>
			
			<tr class = 'vacio'>
				<td ></td>
				<td ></td>
				<td ></td>
			</tr>
			<tr class = 'vacio'>
				<td ></td>
				<td ></td>
				<td ></td>
			</tr>
			<tr class = 'vacio'>
				<td ></td>
				<td ></td>
				<td ></td>
			</tr>
			<tr class = 'vacio'>
				<td ></td>
				<td ></td>
				<td ></td>
			</tr>
			<tr class = 'lleno'>
				<td colspan = '3'>DESCRIPCION DEL TRABAJO</td>
			</tr>
			<tr class = 'vacio'>
				<td ></td>
				<td ></td>
				<td ></td>
			</tr>
		</table>
	</body></html>";
	
	$dompdf = new DOMPDF();
	$dompdf->set_paper("letter","landscape"); 
	$dompdf->load_html($html);
	ini_set("memory_limit","32M");
	$dompdf->render();
	$dompdf->stream("ORDEN DE TRABAJO.pdf");
	
?>

