<?php
	$est = "<table width = '100%' style = 'padding-left:20px;padding-right:20px;'>
		<tr>
			<td>
				<span class = 'mensaje_bienvenida'>CANCELACIÓN OC # ".$_POST['num_op']."</span>
			</td>
			<td align = 'right'>
				<img src = '../images/iconos/icon-19.png' width = '45px' onclick = 'cerrar_cancelacion_op();'/>
			</td>
		</tr>
		<tr><td></br></td></tr>
		<tr>
			<td colspan = '2'>
				<p>Especifíque la razones por las que cancela la Orden de Compra # ".$_POST['num_op'].":</p>
			</td>
		</tr>
		<tr><td></br></td></tr>
		<tr>
			<td  colspan = '2'>
				<textarea style = 'width:100%;' rows = '13' id = 'razon_cancelacion_oc'>
				
				</textarea>
			</td>
		</tr>
		<tr><td></br></td></tr>
		<tr>
			<td align = 'center' colspan = '2'>
				<span class = 'botton_verde' onclick = 'generar_cancelacion_oc(".$_POST['num_op'].")'>GENERAR CANCELACIÓN</span>
			</td>
		</tr>
	</table>
	<script type = 'text/javascript'>
		$('#razon_cancelacion_op').val('');
	</script>";
	echo $est;
?>