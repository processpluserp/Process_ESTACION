<?php
	$titulo_ventana = "LEGALIZACIÓN DE ANTICIPOS";
	$cerrar_ventana = "cerrar_ventana_general_produccion_legal();";
	$icono_cerrar = "icon-19.png";
	include("encabezado_vista.php");
	
	
	$ppto = $_POST['ppto'];
	$vi = $_POST['vi'];
	$vc = $_POST['vc'];
	
	
	
	
	//PRIMERO PREGUNTO SI HAY ANTICIPOS SOBRE ESTE PPTO.
	$sql_valida_anticipos = mysql_query("select id 
	from anticipos_ppto
	where ppto = '$ppto' and vi = '$vi' and vc = '$vc'");
	
	if(mysql_num_rows($sql_valida_anticipos) == 0){
		$estructura_ventana.= "<h1>NO SE HAN GENERADO ANTICIPOS SOBRE ESTE PPTO !</h1>";
	}else{
		//TRAIGO LOS ANTICIPOS QUE HAY SOBRE ESTE PPTO.
		$sql_anticipos = mysql_query("select antppto.id as num_anticipo, p.dias,p.q,p.val_item,p.name_item,cp.porcentaje,p.name_grupo,p.num_interno
		from anticipos_ppto antppto, cuerpo_anticipo cp, itempresup p, estatus_anticipos estant
		where antppto.id = cp.pk_anticipo and antppto.ppto = '$ppto' and antppto.vi = '$vi' and antppto.vc = '$vc' and
		cp.pk_item = p.id and antppto.id = estant.pk_anticipo and estant.estado = '1'");
		
		$list_anticipos = "<option value = '0'>[SELECCIONE]</option>";
		
		$estructura_anticipos = "<table class = 'tablas_muestra_datos_tablas_trafico'>
			<tr></tr>
			<tr>
				<th></th>
				<th style = 'width:100px;text-align:center;'># Item</th>
				<th style = 'width:100px;text-align:center;'>Nombre Item</th>
				<th style = 'width:100px;text-align:center;'># Anticipo</th>
				<th style = 'text-align:center;' nowrap>$ Valor Anticipo</th>
				<th># Facturas</th>
				<th style = 'text-align:center;' nowrap>$ Valor Facturas</th>
				<th style = 'text-align:center;' nowrap>$ Dif.</th>
			</tr>";
		while($row = mysql_fetch_array($sql_anticipos)){			
			$id = $row['num_anticipo'];
			
			$list_anticipos.="<option value = '$id'>$id</option>";
			
			$porcentaje = $row['porcentaje'];
			$valor_anticipo = $porcentaje;
			
			//onclick = 'habilitar_legal_item($id,".$id.")'
			
		
			$sql_legalizacion = mysql_query("select factura,valor
			from legalizaciones_items
			where pk_anticipo = '$id' and estado = '1'");
			$numero_facturas  = mysql_num_rows($sql_legalizacion);
			$valor_facturas = 0;
			while($lega = mysql_fetch_array($sql_legalizacion)){
				$valor_facturas+=$lega['valor'];
			}
			$diferencia = $valor_anticipo - $valor_facturas;
			$color = "";
			$color = ($diferencia > 0) ? "red" : "green";
			
			
			$estructura_anticipos .="<tr class = '$id'>
										<td style = 'vertical-align:top;'>
											<input type = 'radio'  name = 'select_anticipo_pendiente' id = 'anticipo_apro$id' value = '$id'  class = 'radio mano' />
											<label for='anticipo_apro$id' ><span ><span ></span></span></label>
										</td>
										<td style = 'vertical-align:top;'>".($row['num_interno'])."</td>
										<td style = 'vertical-align:top;'>".utf8_decode($row['name_item'])."</td>
										<td style = 'vertical-align:top;'>".($row['num_anticipo'])."</td>
										<td style = 'vertical-align:top;text-align:center;'>$ ".number_format($valor_anticipo)."</td>
										<td style = 'vertical-align:top;text-align:center;'>".($numero_facturas)."</td>
										<td style = 'vertical-align:top;text-align:center;'>$ ".number_format($valor_facturas)."</td>
										<td style = 'vertical-align:top;text-align:center;color:$color'>$ ".number_format((-1)*$diferencia)."</td>
									</tr>";
		}
		$estructura_anticipos.="</table>";
		
		$estructura_ventana .= "
			<div id='tabs_legalizaciones' >
				<ul style = 'padding-left:50px;'>
					<li class = 'pestanas_menu' id = 'submod_presupuestos'><a href='#tabs-1'>Legalizaciones</a></li>
					<li class = 'pestanas_menu' id = 'submod_anticipos'><a href='#tabs-2'>Histórico Legalizaciones</a></li>
				</ul>
				<div id='tabs-1' style = 'padding-left:50px;' class = 'reportes_divs'>
					<table >
						<tr>
							<td>
								<span class = 'botton_verde' onclick = 'adicionar_facturas_legalizacion();'>Adicionar</span>
							</td>
							<td>
								<a href = 'pdf_legalizacion.php?ppto=$ppto&vi=$vi&vc=$vc' target = '_blank'>
									<img src = '../images/iconos/iconos-42.png' width = '45px' />
								</a>
							</td>
						</tr>
					</table>
					$estructura_anticipos
				</div>
				<div id='tabs-2' style = 'padding-left:50px;' class = 'reportes_divs' >
					<table class = 'barra_busqueda'>
						<tr>
							<td>
								<p>Seleccione un # de Anticipo:</p>
								<select id = 'num_anticipo_legalizacion' onchange = 'buscar_legalizaciones_anticipo_select();'>
									$list_anticipos
								</select>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<script type = 'text/javascript'>
				$('#tabs_legalizaciones').tabs();
				var alto = $(window).height();
				var x = (alto*100)/100;
				$('.reportes_divs').css({'height':(x*70)/100});
			</script>";
		
		echo $estructura_ventana;
		
		
	}
?>