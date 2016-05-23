<?php
	$cumple = $gestion->obtener_cumpleanos_del_dia();
	$img_logo =  "<img src = '../images/Untitled-1-01.png' id = 'logo_usuario'/>";//$gestion->mostrar_logo_empresa_empleado();
	$usu = $gestion->mostrar_usuario();
	$imprimir = "<div id = 'contenedor_cabecera'>
			</br>
			<table id = 'cabecera' width = '100%'>
				<tr>
					<td >
						<span >".$gestion->mostrar_fecha()."</span>
					</td>
					<td>
						<table width = '100%'>
							<tr>
								<td align = 'right' class = 'img_alertas'>
									<img src = '../images/iconos/ALERTA_CUMPLE.png' class = 'iconos_barra' title = '".$gestion->listar_cumpleanos_del_dia()."'/>
								</td>
								<td align = 'left'>
									<span >".$cumple."</span>
								</td>
							</tr>
						</table>
					</td>
					<td >
						<table width = '100%'>
							<tr>
								<td align = 'right' class = 'img_alertas'>
									<img id = 'title_alertas_tareas' src = '../images/iconos/ALERTA_TRAFICO_TAREA.png' class = 'iconos_barra' title = 'TIENES  TAREA(S) NUEVA(S)'/>
								</td>
								<td align = 'left'>
									<span id ='alerta_tareas'></span>
								</td>
							</tr>
						</table>							
					</td>
					<td></td>
					<td >
						<div id = 'nombre_usuario_contenedor' width = '100%' >
							<table width = '100%'>
								<tr>
									<td align = 'center' style = 'vertical-align:middle;' width = '20%'>
										$img_logo
									</td>
									<td style = 'vertical-align:top;'>
										<p id = 'nombre_usuario'>$usu</p>
									</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td align='right' class = 'salir_sistema'>
						<span onclick = 'cerrar_sesion()'>Cerrar sesión</span>
					</td>
				</tr>
			</table>".$gestion->menu_bar_process($codigo_usuario_real,$empresa_final)."</div>";
			
			//".$gestion->menu_bar_process($codigo_usuario_real,$empresa_final)."
?>