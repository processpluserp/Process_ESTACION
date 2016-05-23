<?php
	include("../Controller/Conexion.php");
	
	$est = "<table width = '100%' style = 'padding-left:20px;padding-right:20px;'>
			<tr>
				<td >
					<span class = 'mensaje_bienvenida' >PPTO RECHAZADO</span>
				</td>				
				<td align = 'right'>
					<img onclick = 'cerrar_ventana_general(this);' width = '50px'src = '../images/iconos/icon-18.png' class = 'mano' id = 'cerrar_mensaje_bloqueo' />
				</td>
			</tr>
			</table>
			<table width = '100%' style = 'padding-left:20px;padding-right:20px;'>
			<tr>
				<td >Su presupuesto a sido rechazado por:</td>
			</tr>
			<tr><td></td></tr>";
	
			$consulta = mysql_query("select ea.observaciones,ea.fecha,e.nombre_empleado,e.cargo_empleado,ea.fecha
			from estatus_aprobaciones ea,  usuario u, empleado e
			where ppto = '".$_POST['ppto']."' and vi = '".$_POST['vi']."' and vc = '".$_POST['vc']."' and estado_aprobacion = '0'
			and ea.user = u.idusuario and u.pk_empleado = e.documento_empleado");
			while($esttt = mysql_fetch_array($consulta)){
				$fecha_explode = explode(' ',$esttt['fecha']);
				
				
				$est.="<tr><td><strong>Nombre</strong>:</td><td>".utf8_decode($esttt['nombre_empleado'])."</td></tr>";
				$est.="<tr><td><strong>Cargo</strong>:</td><td>".utf8_decode($esttt['cargo_empleado'])."</td></tr>";
				$est.="<tr><td><strong>Fecha</strong>:</td><td>".($fecha_explode[0]." Hora ".$fecha_explode[1])."</td></tr>";
				$est.="<tr><td></br></td></tr></table>";
				$est.="<table width = '100%' style = 'padding-left:20px;padding-right:20px;'>";
				$est.="<tr><td colspan = '2'><strong><p>Motivo:</p></strong><textarea readonly style = 'width:100%;' rows = '10'>".($esttt['observaciones'])."</textarea></td></tr>";
			}
	echo $est."</table>";
?>