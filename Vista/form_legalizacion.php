<?php
	
	$id = $_POST['id'];

	$titulo_ventana = "FACTURAS DEL ANTICIPO # $id";
	$cerrar_ventana = "cerrar_ventana_legalizacion();";
	$icono_cerrar = "icon-19.png";
	include("encabezado_vista.php");
	
	$facturas_valor = "
		<tr>
			<th></th>
			<th># Factura</th>
			<th>Fecha Factura</th>
			<th>NIT</th>
			<th>Beneficiario</th>
			<th>Ciudad</th>
			<th>Concepto</th>
			<th>Valor $</th>
			<th>Iva</th>
			<th>TOTAL</th>
		</tr>
	";
	/*for($i = 0; $i < 2; $i++){
		$facturas_valor.="<tr class = 'contenedor_facturas_anticipo$i facturas_legal'>
			<td>
				<img src = '../images/iconos/eliminar.png' width = '25px' onclick = 'eliminar_facturas_anticipo($i);' />
			</td>
			<td>
				<input type = 'text' placeholder = 'Factura' class = 'input_fact$id' style = 'width:70px;'/>
			</td>
			<td>
				<input type = 'text' placeholder = 'Fecha' class = 'input_fecha_fact$id fechas_legalizaciones' style = 'width:90px;'/>
			</td>
			<td>
				<input type = 'text' placeholder = 'Nit' class = 'nit_factura$id' style = 'width:90px;' />
			</td>
			<td>
				<input type = 'text' placeholder = 'DV' class = 'dv_factura$id' style = 'width:30px;'/>
			</td>
			<td>
				<textarea placeholder = 'Beneficiario' class = 'beneficiario_factura$id entradas_bordes' cols = '25' rows = '2'></textarea>
			</td>
			<td>
				<input type = 'text' placeholder = 'Dirección' class = 'direccion_factura$id' />
			</td>
			<td>
				<input type = 'text' placeholder = 'Teléfono' class = 'telefono_factura$id' style = 'width:90px;' />
			</td>
			<td>
				<input type = 'text' placeholder = 'Ciudad' class = 'ciudad_factura$id' style = 'width:90px;'/>
			</td>
			<td>
				<input type = 'text' placeholder = 'Ciudad' class = 'ciudad_factura$id' style = 'width:90px;'/>
				<textarea placeholder = 'Concepto' class = 'concepto_factura$id entradas_bordes' cols = '25' rows = '1'></textarea>
			</td>
			<td>
				<input type = 'number' min = '0' value = '0' placeholder = 'Valor Factura' onblur = 'calcular_facturas_registradas_legal($id)' onkeyup = 'calcular_facturas_registradas_legal($id)'class = 'entradas_bordes input_valor_fact$id valor_facturas_lega' style = 'width:90px;' />
			</td>
			<td>
				<input type = 'number' min = '0' value = '0' placeholder = 'Iva Factura' onblur = 'calcular_facturas_registradas_legal($id)' onkeyup = 'calcular_facturas_registradas_legal($id)'class = 'entradas_bordes input_valor_iva_fact$id iva_valor_facturas_lega' style = 'width:90px;' />
			</td>
			<td>
				<input type = 'number' min = '0' value = '0' placeholder = 'Rete Factura' onblur = 'calcular_facturas_registradas_legal($id)' onkeyup = 'calcular_facturas_registradas_legal($id)'class = 'entradas_bordes input_valor_rete_fact$id rete_valor_facturas_lega' style = 'width:90px;'/>
			</td>
		</tr>";
	}*/
	
	$estructura_ventana.="
	<table style = 'padding-left:50px;padding-right:50px;' class = 'legalizacion_anticipo$id' width = '100%'>
		<tr>
			<td colspan = '2'>
				<p>Ingrese las facturas correspondientes a este anticipo:</p>
			</td>
		</tr>
		<tr>
			<td>
				<table>
					<tr>
						<td style = 'vertical-align:middle;'>
							<span class = 'mano' onclick = 'adicionar_item_nuevo($id)'>Adicionar</span>
						</td>
						<td>
							<img src = '../images/iconos/mas_blanco.png' width = '25px' onclick = 'adicionar_item_nuevo($id)'/>
						</td>
					</tr>
				</table>
				
			</td>
		</tr>
		<tr><th class = 'total_lega".$id."' colspan = '4' align = 'right'></th></tr>
	</table>
	<table style = 'padding-left:50px;padding-right:50px;' class ='histo_facturas_lega tablas_muestra_datos_tablas_trafico' max-width = '800px'>
		
	</table>
	
	";
	
	echo $estructura_ventana;
?>