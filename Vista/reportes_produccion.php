<?php
	$titulo_ventana = "REPORTES PRODUCCIÓN";
	$cerrar_ventana = "cerrar_ventana_reportes();";
	$icono_cerrar = "icon-19.png";
	include("encabezado_vista.php");
	
	
	//onclick = 'cargar_reporte_estados_pptos()'
	//onclick = 'cargar_reporte_ipordenacion();'
	//onclick = 'cargar_reporte_factpentllegar()'
	//onclick = 'cargar_reporte_factproveedores()'
	
	
	if(!empty($_POST["user"])){
		$usuario_actual = $_POST['user'];
		$list_empresa = "<option value = '0'>[SELECCIONE]</option>";
		$sql_empresa = "SELECT e.nombre_comercial_empresa, e.cod_interno_empresa 
		from empresa e, pusuemp p
			where e.cod_interno_empresa = p.cod_empresa and p.cod_usuario = '$usuario_actual' order by e.nombre_comercial_empresa asc;";
		$result = mysql_query($sql_empresa);
		while($row = mysql_fetch_array($result)){
			$list_empresa.= "<option value=".$row['cod_interno_empresa'].">".utf8_encode($row['nombre_comercial_empresa'])."</option>";
		}
		$estructura_ventana.="
		<div id='tabs_aprobaciones'style = 'padding-left:50px;padding-right:50px;' >
			<ul >
				<li class = 'pestanas_menu' id = 'submod_presupuestos' ><a href='#tabs-1'>Estado Presupuestos</a></li>
				<li class = 'pestanas_menu' id = 'submod_anticipos' ><a href='#tabs-2'>Items Pendientes de Ordenacion</a></li>
				<li class = 'pestanas_menu' id = 'submod_histo_ppto' ><a href='#tabs-3'>Fact. Pendientes por Llegar</a></li>
				<li class = 'pestanas_menu' id = 'submod_histo_ant' ><a href='#tabs-4'>Facturación Proveedores</a></li>
				
			</ul>
			<div id='tabs-1' style = 'overflow:scroll;' class = 'reportes_divs' width = '100%'>
				<table class = 'barra_busqueda'>
					<tr>
						<td>
							<p>Seleccione una Empresa:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_est_empresa' onchange = 'report_est_buscar_directores_empresa()' style = 'width:220px;'>$list_empresa</select>
						</td>
						
						<td style = 'padding-left:10px;'>
							<p>Seleccione un Director:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_est_director' onchange = 'report_est_buscar_ejecutivos_director()'  style = 'width:220px;'>
								<option value = '0'>[SELECCIONE]</option>
							</select>
						</td>
						
						<td style = 'padding-left:10px;'>
							<p>Seleccione un Ejecutivo:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_est_ejecutivo' onchange = 'report_est_buscar_cliente_ejectuvo()'  style = 'width:220px;'>
								<option value = '0'>[SELECCIONE]</option>
							</select>							
						</td>
						
						<td style = 'padding-left:10px;'>
							<p>Seleccione un Cliente:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_est_cliente' onchange = 'report_est_buscar_cliente_producto()' style = 'width:220px;'>
								<option value = '0'>[SELECCIONE]</option>
							</select>							
						</td>
						
						<td style = 'padding-left:10px;'>
							<p>Seleccione un Producto de Cliente:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_est_producto' style = 'width:220px;'>
								<option value = '0'>[SELECCIONE]</option>
							</select>							
						</td>";
						$estructura_ventana.= "<td style='padding-left:10px;'>
							  					 <p>&nbsp;</p>
												 <img width='45px' height='55px' src='../images/iconos/lupa_naranja.png' onclick='generar_reporte_html_estados_pptos();'>
											  </td>";
					/*
						<td style = 'padding-left:10px;vertical-align:middle;'>
							<img src = '../images/iconos/lupa_naranja.png' width = '45px' onclick = 'generar_reporte_html_estados_pptos();'/>
						</td>
					*/
					$estructura_ventana.= "</tr>
				</table>
			</div>
			<div id='tabs-2' style = 'overflow:scroll;' class = 'reportes_divs' width = '100%'  >
				<table class = 'barra_busqueda'>
					<tr>
						<td>
							<p>Seleccione una Empresa:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_itempenorden_empresa' onchange = 'report_itempenorden_buscar_directores_empresa()' style = 'width:220px;'>$list_empresa</select>
							
						</td>
						
						<td style = 'padding-left:10px;'>
							<p>Seleccione un Director:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_itempenorden_director' onchange = 'report_itempenorden_buscar_ejecutivos_director()'  style = 'width:220px;'>
								<option value = '0'>[SELECCIONE]</option>
							</select>
						</td>
						
						<td style = 'padding-left:10px;'>
							<p>Seleccione un Ejecutivo:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_itempenorden_ejecutivo' onchange = 'report_itemspendientes_buscar_cliente_ejectuvo()'  style = 'width:220px;'>
								<option value = '0'>[SELECCIONE]</option>
							</select>							
						</td>
						
						<td style = 'padding-left:10px;'>
							<p>Seleccione un Cliente:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_itemspendientes_cliente' onchange = 'report_itemspendientes_buscar_cliente_producto()' style = 'width:220px;'>
								<option value = '0'>[SELECCIONE]</option>
							</select>							
						</td>
						
						<td style = 'padding-left:10px;'>
							<p>Seleccione un No. de Ppto:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_itemspendientes_presupuesto' style = 'width:220px;'>
								<option value = '0'>[SELECCIONE]</option>
							</select>							
						</td>
		
						<td style = 'padding-left:10px;vertical-align:middle;'>
							<img src = '../images/iconos/lupa_naranja.png' width = '45px' onclick = 'generar_reporte_html_itemspendientes_ordenacion();'/>
						</td>
					</tr>
				</table>
			</div>
			<div id='tabs-3' style = 'overflow:scroll;' class = 'reportes_divs' width = '100%'>
				<table class = 'barra_busqueda'>
					<tr>
						<td>
							<p>Seleccione una Empresa:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_factpendiente_empresa' onchange = 'report_factpendiente_buscar_directores_empresa()' style = 'width:220px;'>$list_empresa</select>
						</td>
						
						<td style = 'padding-left:10px;'>
							<p>Seleccione un Director:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_factpendiente_director' onchange = 'report_factpendiente_buscar_ejecutivos_director()'  style = 'width:220px;'>
								<option value = '0'>[SELECCIONE]</option>
							</select>
						</td>
						
						<td style = 'padding-left:10px;'>
							<p>Seleccione un Ejecutivo:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_factpendiente_ejecutivo' onchange = 'report_factpendiente_buscar_cliente_ejectuvo()'  style = 'width:220px;'>
								<option value = '0'>[SELECCIONE]</option>
							</select>							
						</td>
						
						<td style = 'padding-left:10px;'>
							<p>Seleccione un Cliente:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_factpendiente_cliente' onchange = 'report_factpendiente_buscar_cliente_ppto()' style = 'width:220px;'>
								<option value = '0'>[SELECCIONE]</option>
							</select>							
						</td>
						
						<td style = 'padding-left:10px;'>
							<p>Seleccione un No. de Ppto:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_factpendiente_presupuesto' style = 'width:220px;'>
								<option value = '0'>[SELECCIONE]</option>
							</select>							
						</td>
		
						<td style = 'padding-left:10px;vertical-align:middle;'>
							<img src = '../images/iconos/lupa_naranja.png' width = '45px' onclick = 'generar_reporte_html_facturas_pendientes();'/>
						</td>
					</tr>
				</table>
			</div>
			<div id='tabs-4' style = 'overflow:scroll;' class = 'reportes_divs' width = '100%'>
				<table class = 'barra_busqueda'>
					<tr>
						<td>
							<p>Seleccione una Empresa:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_facprov_empresa' onchange = 'report_facprov_buscar_directores_empresa()' style = 'width:220px;'>$list_empresa</select>
						</td>
						
						
						<td style = 'padding-left:10px;'>
							<p>Seleccione un Proveedor:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_facprov_proveedor' style = 'width:220px;'>
								<option value = '0'>[SELECCIONE]</option>
							</select>							
						</td>
		
						<td style = 'padding-left:10px;vertical-align:middle;'>
							<img src = '../images/iconos/lupa_naranja.png' width = '45px' onclick = 'generar_reporte_html_facturacion_proveedor();'/>
						</td>
					</tr>
				</table>
			</div></div>
			<script type = 'text/javascript'>
				$('#tabs_aprobaciones').tabs();
				var alto = $(window).height();
				var x = (alto*100)/100;
				$('.reportes_divs').css({'height':(x*70)/100});
			</script>";
	}else{
		$estructura_ventana.="<table width = '100%'>
			<tr>
				<th align = 'center'>SU SESIÓN A TERMINADO, POR FAVOR INICIE SU SESIÓN NUEVAMENTE</th>
			</tr>
			<tr>
				<th>
					<a href = '../logeo.php'>
						<img src = '../images/iconos/home.png' class = 'mano'width = '100px' />
					</a>
				</th>
			</tr>
		</table>";
	}
	echo $estructura_ventana;
?>