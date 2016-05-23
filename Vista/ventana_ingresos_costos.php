<?php
	$titulo_ventana = "INGRESOS Y COSTOS";
	$cerrar_ventana = "cerrar_ventana_ingresos_costos();";
	$icono_cerrar = "icon-19.png";
	include("encabezado_vista.php");
	
	
	if(!empty($_POST["user"])){
		$estructura_ventana.="
		<div id='tabs_aprobaciones'style = 'padding-left:50px;padding-right:50px;' >
			<ul >
				<li class = 'pestanas_menu' id = 'submod_presupuestos' >
					<a href='#tabs-1'>
						Recepción de Facturas
					</a>
				</li>
				<li class = 'pestanas_menu' id = 'submod_anticipos' >
					<a href='#tabs-2'>
						Facturación de Pptos
					</a>
				</li>
				<li class = 'pestanas_menu' id = 'submod_histo_ppto' ><a href='#tabs-3'>Fact. Pendientes por Llegar</a></li>
				<li class = 'pestanas_menu' id = 'submod_histo_ant' ><a href='#tabs-4'>Facturación Proveedores</a></li>
				
			</ul>
			<div id='tabs-1'  class = 'reportes_divs' width = '100%'>
				<table class = 'hijos_recepcion_facturacion todo_fact barra_busqueda'>
					<tr >
						<td >
							<p>Ingrese el Número de OC:</p>
							<input type = 'number' min = '0' id = 'num_orden_b_rf' class = 'entradas_bordes'/>
						</td>
						<td style = 'padding-left:20px;vertical-align:middle;'>
							<img src = '../images/iconos/lupa_naranja.png' class = 'botones_opciones mano' onclick = 'buscar_orden_compra();'/>
						</td>
					</tr>
				</table>
				<div id = 'contenedor_result_facturas' class = 'reportes_divs_interno' style = 'background-color:#dadada;overflow:scroll;min-height:300px;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;' width = '100%'>								
				
				</div>
			</div>
			<div id='tabs-2' style = 'overflow:scroll;' class = 'reportes_divs' width = '100%'  >
				
			</div>
			<div id='tabs-3' style = 'overflow:scroll;' class = 'reportes_divs' width = '100%'>
				
			</div>
			<div id='tabs-4' style = 'overflow:scroll;' class = 'reportes_divs' width = '100%'>
				
			</div>
		</div>
		<script type = 'text/javascript'>
			$('#tabs_aprobaciones').tabs();
			var alto = $(window).height();
			var x = (alto*100)/100;
			$('.reportes_divs').css({'height':(x*70)/100});
			$('.reportes_divs_interno').css({'height':(x*60)/100});
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