<?php
	
	$titulo_ventana = "CABECERA PPTO";
	$cerrar_ventana = "cerrar_ventana_form();";
	$icono_cerrar = "icon-19.png";
	include("encabezado_vista.php");
	
	$ppto = $_POST['ppto'];
	$sql_cabcera = mysql_query("select emp.nombre_comercial_empresa, c.nombre_comercial_cliente, p.ot, p.ciudad_presup,
	p.referencia, p.vigencia_final, p.vigencia_inicial,p.nota,p.num_aprobacion
	from cabpresup p, empresa emp, clientes c
	where p.codigo_presup = '$ppto' and p.empresa_nit_empresa = emp.cod_interno_empresa and p.pk_clientes_nit_cliente = c.codigo_interno_cliente");
	
	while($row = mysql_fetch_array($sql_cabcera)){
		$estructura_ventana.="
		<table width = '100%' class = 'tabla_nuevos_datos2 form_nuevo_ppto' style = 'padding-left:50px;padding-right:50px;'>
			<tr>
				<td width = '48%'>
					<p>Empresa:</p>
					<input type = 'text' readonly value = '".utf8_decode($row['nombre_comercial_empresa'])."' />
				</td>
				
				<td width = '2%'></td>
				
				<td width = '48%'>
					<p>Cliente:</p>
					<input type = 'text' readonly value = '".utf8_decode($row['nombre_comercial_cliente'])."' />
				</td>
			</tr>
			
			<tr>
				<td width = '48%'>
					<table width = '100%'>
						<tr>
							<td width = '48%'>
								<p>OT:</p>
								<input type = 'text' readonly value = '".$row['ot']."'/>
							</td>
							<td width = '2%'></td>
							<td width = '48%'>
								<p>Centro de Costo:</p>
								<input type = 'text' readonly value = '".$row['ot']."'/>
							</td>
						</tr>
					</table>
				</td>
				
				<td width = '2%'></td>
				
				<td width = '48%'>
					<p>Referencia Ppto:</p>
					<textarea rows = '5' cols = '2'>".utf8_decode($row['referencia'])."</textarea>
				</td>			
			</tr>
			<tr>
				<td width = '48%'>
					<table width = '100%'>
						<tr>
							<td width = '48%'>
								<p>Vigencia Inicial:</p>
								<input type = 'text' id = 'edit_vigencia_inicial_ppto' value = '".$row['vigencia_inicial']."'/>
							</td>
							<td width = '2%'></td>
							<td width = '48%'>
								<p>Vigencia Final:</p>
								<input type = 'text' id = 'edit_vigencia_final_ppto'value = '".$row['vigencia_final']."'/>
							</td>
						</tr>
					</table>
				</td>
				
				<td width = '2%'></td>
				
				<td width = '48%'>
					<p>Nota Legal Ppto:</p>
					<textarea rows = '5' cols = '2'>".utf8_decode($row['nota'])."</textarea>
				</td>	
			</tr>
			
			<tr>
				<td width = '48%'>
					<table width = '100%'>
						<tr>
							<td width = '48%'>
								<p>Número de Aprobación:</p>
								<input type = 'text' id = 'edit_vigencia_inicial_ppto' value = '".$row['num_aprobacion']."'/>
							</td>
							<td width = '2%'></td>
							<td width = '48%'>
								<p>Lugar:</p>
								<input type = 'text' id = 'edit_vigencia_final_ppto'value = '".utf8_decode($row['ciudad_presup'])."'/>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>";
	}
	echo $estructura_ventana;
?>