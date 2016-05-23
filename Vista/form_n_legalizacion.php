<?php
	$titulo_ventana = "NUEVA FACTURA";
	$cerrar_ventana = "cerrar_ventana_n_lega();";
	$icono_cerrar = "icon-19.png";
	include("encabezado_vista.php");
	
	$estructura_ventana.="<table width = '100%' style = 'padding-left:50px;padding-right:50px;' class = 'tabla_datos_nuevos'>
		<tr>
			<td>
				<p>Ingrese el número de Factura:</p>
				<input type = 'text' Placeholder = 'Factura' class = 'entradas_bordes' id = 'form_legalizacion_factura' />
			</td>
			<td>
				<p>Seleccione el Fecha de Factura:</p>
				<input type = 'text' placeholder = 'Fecha'  class = 'entradas_bordes fechas_legalizaciones' id = 'form_legalizacion_fecha_factura' />
			</td>
		</tr>
		<tr>
			<td>
				<p>Ingrese Nit del Beneficiario:</p>
				<input type = 'text' placeholder = 'Nit'  class = 'entradas_bordes' id = 'form_legalizacion_nit_beneficiario'  />
			</td>
			<td>
				<p>Ingrese Nombre del Beneficiario:</p>
				<input type = 'text' placeholder = 'Nombre'  class = 'entradas_bordes' id = 'form_legalizacion_nombre_beneficiario' />
			</td>
		</tr>
		<tr>
			<td>
				<p>Dirección Beneficiario:</p>
				<input type = 'text' placeholder = 'Dirección'  class = 'entradas_bordes' id = 'form_legalizacion_direccion_beneficiario'  />
			</td>
			<td>
				<p>Teléfono Beneficiario:</p>
				<input type = 'text' placeholder = 'Teléfono'  class = 'entradas_bordes' id = 'form_legalizacion_telefono_beneficiario'  />
			</td>
		</tr>
		<tr>
			<td>
				<p>Ciudad:</p>
				<input type = 'text' placeholder = 'Ciudad'  class = 'entradas_bordes' id = 'form_legalizacion_ciudad_beneficiario' />
			</td>
			<td>
				<p>Concepto:</p>
				<textarea placeholder = 'Concepto' class = 'entradas_bordes' cols = '20' rows = '3' id = 'form_legalizacion_concepto'></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<p>Valor Factura:</p>
				$ <input type = 'text' placeholder = 'Valor'  class = 'entradas_bordes' id = 'form_legalizacion_valor_factura' onkeyup = 'format_valor_factura();'/>
				<span class = 'hidde' id = 'num_valor_real'></span>
			</td>
			<td>
				<p>Iva Factura:</p>
				$ <input type = 'text' placeholder = 'Iva'  class = 'entradas_bordes' id = 'form_legalizacion_iva_factura' onkeyup = 'format_iva_valor_factura();' />
				<span class = 'hidde' id = 'num_iva_valor_real'></span>
			</td>
		</tr>
		<tr>
			<td>
				<p>Retención Factura:</p>
				$ <input type = 'text' placeholder = 'Retención'  class = 'entradas_bordes' id = 'form_legalizacion_retencion_factura'  onkeyup = 'format_retencion_valor_factura();'/>
				<span class = 'hidde' id = 'num_rete_valor_real'></span>
			</td>
		</tr>
		<tr><td></br></td></tr>
		<tr>
			<td align = 'center' colspan = '2' nowrap>
				<span class = 'botton_verde' style = 'background-color:red;' onclick = 'cerrar_ventana_n_lega();'>CANCELAR</span>
				<span class = 'botton_verde' onclick = 'guadar_legalizacion_item(".$_POST['id'].");' >GUARDAR</span>
			</td>
		</tr>
	</table>
	<script type = 'text/javascript'>
		$('.fechas_legalizaciones').datepicker({ dateFormat: 'yy-mm-dd' });
	</script>";
	echo $estructura_ventana;
?>