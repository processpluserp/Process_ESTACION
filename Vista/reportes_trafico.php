<?php
	$titulo_ventana = "REPORTES TRAFICO";
	$cerrar_ventana = "cerrar_ventana_reportes();";
	$icono_cerrar = "icon-18.png";
	include("encabezado_vista.php");
	
	
		$usuario_actual =1;// $_SESSION["codigo_usuario"];
		$list_empresa = "<option value = '0'>[SELECCIONE]</option>";
		$sql_empresa = "SELECT e.nombre_comercial_empresa, e.cod_interno_empresa 
		from empresa e, pusuemp p
			where e.cod_interno_empresa = p.cod_empresa and p.cod_usuario = '$usuario_actual' order by e.nombre_comercial_empresa asc;";
		$result = mysql_query($sql_empresa);
		while($row = mysql_fetch_array($result)){
			$list_empresa.= "<option value=".$row['cod_interno_empresa'].">".utf8_encode($row['nombre_comercial_empresa'])."</option>";
		}
		
		//OBTENGO LOS RESPONSABLES DE LOS DEPARTAMENTOS
		$sql_responsables = mysql_query("select distinct e.nombre_empleado,u.idusuario 
			from pasig p, empleado e, usuario u
			where p.usuario = u.idusuario and u.pk_empleado = e.documento_empleado and u.estado = 1 order by e.nombre_empleado asc");
		
		while($row = mysql_fetch_array($sql_responsables)){
			
		}
		
		$list_empleados = "";
		$sql_empleado = mysql_query("select e.nombre_empleado, u.idusuario 
		from usuario u, empleado e
		where e.documento_empleado = u.pk_empleado and e.estado = '1' and u.estado = '1' order by e.nombre_empleado asc");
		while($row = mysql_fetch_array($sql_empleado)){
			$list_empleados.= "<option value=".$row['idusuario'].">".utf8_encode($row['nombre_empleado'])."</option>";
		}
		
		$estructura_ventana.="
		<div id='tabs_reportes'style = 'padding-left:50px;padding-right:50px;' >
			<ul >
				
				<li class = 'pestanas_menu' id = 'submod_anticipos' ><a href='#tabs-2'>Carga Laboral</a></li>
				<li class = 'pestanas_menu' id = 'submod_anticipos' ><a href='#tabs-3'>Actividad Tareas</a></li>
			</ul>
			
			
			<div id='tabs-2' style = 'overflow:scroll;' class = 'reportes_divs' width = '100%'>
				<table class = 'barra_busqueda'>
					<tr>
						<td>
							<p>Seleccione un Empleado:</p>
							<select class = 'entradas_bordes' id = 'list_empleados_report'  style = 'width:180px;'>$list_empleados</select>
						</td>
										
		
						<td style = 'padding-left:10px;vertical-align:middle;'>
							<img src = '../images/iconos/lupa_verde.png' width = '45px' onclick = 'generar_reporte_carga_laboral_empleado();' />
						</td>
					</tr>
				</table>
				<br></br>
				<div style = 'overflow:scroll;'id='calendar_carga_laboral' height = '400px' width ='80%'></div>
			</div>
			<div id='tabs-3' style = 'overflow:scroll;' class = 'reportes_divs' width = '100%'>
				<table class = 'barra_busqueda'>
					<tr>
						<td>
							<p>Seleccione un Empleado:</p>
							<select class = 'entradas_bordes' id = 'list_empleados_report_actividad_tareas'  style = 'width:180px;'>$list_empleados</select>
						</td>
										
		
						<td style = 'padding-left:10px;vertical-align:middle;'>
							<img src = '../images/iconos/lupa_verde.png' width = '45px' onclick = 'generar_reporte_actividad_empleado();' />
						</td>
					</tr>
				</table>
				<br></br>
				<div style = 'overflow:scroll;'id='actividad_empleado' height = '400px' width ='80%'></div>
			</div>
			
		</div>
			<script type = 'text/javascript'>
				var alto = $(window).height();
				var x = (alto*100)/100;
				$('.reportes_divs').css({'height':(x*70)/100});
			</script>";
	
	echo $estructura_ventana;
?>