<?php
	$footer_ppto = "
			</div>
			<script type = 'text/javascript'>
				var alto = $(window).height();
				var x = (alto*100)/100;
				$('.contenedor_cuerpo_ppto').css({'height':(x*62)/100});
			</script>
			<table width = '100%'>
				<tr>
					<td colspan = '25' align = 'center'; style = 'background-color:#FF8F47;border-radius:1em;padding-top:3px;padding-bottom:3px;'>
						<div class = 'triangulo_inf' onclick = 'mostrar_cabecera();' id = 'opcion_para_ocultar_resumen'></div>
					</td>
				</tr>
				<tr class = 'encabezado'>
					<td style = 'vertical-align:top;padding-left:10px;' align = 'center' width = '33%' colspan = '10'>
						<table>
							<tr>
								<th colspan = '3' style = 'font-weight:bold;color:#F9904C;padding-left:5px;' align = 'center'>RESUMEN DE ACTIVIDAD</th>
							</tr>
							<tr >
								<td colspan = '2' class ='concepto2' style = 'background-color:#D0DEF4;border-top-left-radius:1em;-moz-border-top-left-radius:1em;-webkit-border-top-left-radius:1em;padding-left:10px;'>VALORES COMISIONABLES</td>
								<td style = 'background-color:#D0DEF4;padding-left:5px;color:#707070;border-top-right-radius:1em;-moz-border-top-right-radius:1em;-webkit-border-top-right-radius:1em;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'valores_comisionables'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr >
								<td colspan = '2' class ='concepto2' style = 'background-color:#D0DEF4;padding-left:10px;'>VALORES NO COMISIONABLES</td>
								<td style = 'background-color:#D0DEF4;padding-left:5px;color:#707070;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'valores_no_comisionables'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr >
								<td colspan = '2' class ='concepto2' style = 'background-color:#D0DEF4;padding-left:10px;'>TOTAL COSTOS DE EJECUCIÓN</td>
								<td style = 'background-color:#D0DEF4;padding-left:5px;color:#707070;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'total_costos_ejecucion'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr >
								<td class ='concepto2' style = 'padding-left:10px;'>IMPREVISTOS</td>
								<td class ='concepto2'>
									<input type = 'text' value = '$imprevistos' id = 'porcentaje_imprevistos' class = 'entrada_bordes' style = 'width:40px;' placeholder = '%' onkeyup = 'calcular_impuestos_ppto();'/>
								</td>
								<td style = 'padding-left:5px;color:#707070;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'total_por_imprevistos'>0</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class ='concepto2' style = 'padding-left:10px;'>GASTOS ADMINISTRATIVOS</td>
								<td class ='concepto2'>
									<input type = 'text' value = '$gastos_administrativos' id = 'por_gastos_admin' class = 'entrada_bordes' style = 'width:40px;' placeholder = '%' onkeyup = 'calcular_impuestos_ppto();'/>
								</td>
								<td style = 'padding-left:5px;color:#707070;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'total_gastos_administrativos'>0</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class ='concepto2' style = 'padding-left:10px;'>SERVICIOS DE IMPLEMENTACION </br>ESTRATEGIA Y DESARROLLO</td>
								<td align = 'center' class ='concepto2'>
									<span id = 'val_comision' >$valor_comision</span>
									<span id = 'tipo_comision' class = 'hidde'>$tipo_comision_ppto</span>
								</td>
								<td style = 'padding-left:5px;color:#707070;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'valor_comision_agencia'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto2' style = 'padding-left:10px;background-color:#D0DEF4;'>TOTAL ACTIVIDAD</td>
								<td style = 'padding-left:5px;color:#707070;background-color:#D0DEF4;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'total_actividad_inicial'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto2' style = 'padding-left:10px;background-color:#D0DEF4;'>TOTAL COMISIONES POR DESCUENTOS</td>
								<td style = 'padding-left:5px;color:#707070;background-color:#D0DEF4;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'total_comisiones_por_descuentos'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto2' style = 'padding-left:10px;'>VALORES NO COMISIONALES</td>
								<td style = 'padding-left:5px;color:#707070;' class ='concepto2' >
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'valores_no_comisionables2'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto2' style = 'padding-left:10px;'>COMISION AGENCIA UAAI</td>
								<td style = 'padding-left:5px;color:#707070;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'valor_comision_agencia2'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto2' style = 'padding-left:10px;background-color:#D0DEF4;'>UTILIDAD COMERCIAL</td>
								<td style = 'background-color:#D0DEF4;padding-left:5px;color:#707070;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'utilidad_comercial'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr class ='concepto2'>
								<td colspan = '2'  style = 'padding-left:10px;background-color:#D0DEF4;' class ='concepto2'>VOLUMEN</td>
								<td style = 'padding-left:5px;color:#707070;background-color:#D0DEF4;'>
									<table >
										<tr>
											<td align = 'right' id = 'vol_ppto_vol'></td>
											<td>%</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr class ='concepto2'>
								<td colspan = '2'  style = 'border-bottom-left-radius:1em;-moz-border-bottom-left-radius:1em;-webkit-border-bottom-left-radius:1em;padding-left:10px;'>UTILIDAD MARGINAL</td>
								<td style = 'padding-left:5px;color:#707070;border-bottom-right-radius:1em;-moz-border-bottom-right-radius:1em;-webkit-border-bottom-right-radius:1em;' class ='concepto2'>
									<table >
										<tr>
											<td align = 'right' id = 'utilidad_marginal'></td>
											<td>%</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					
					<td  style = 'vertical-align:top;' align = 'center' width = '33%' colspan = '10'>
						<table>
							<tr>
								<th colspan = '3' style = 'font-weight:bold;color:#F9904C;padding-left:5px;' align = 'center'>RESUMEN DE IMPUESTOS</th>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto2' style = 'border-top-left-radius:1em;-moz-border-top-left-radius:1em;-webkit-border-top-left-radius:1em;padding-left:10px;background-color:#D0DEF4;'>VALOR TOTAL SIN IVA</td>
								<td style = 'padding-left:5px;color:#707070;border-top-right-radius:1em;-moz-border-top-right-radius:1em;-webkit-border-top-right-radius:1em;background-color:#D0DEF4;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'valor_sin_iva_total'></td>
										</tr>
									</table>
								</td>
							</tr>
							
							<tr>
								<td class ='concepto2' style = 'padding-left:10px;'>RETENCIÓN EN LA FUENTE</td>
								<td align = 'center' class ='concepto2'>
									<span id = 'por_rete_fuente' >4</span>
								</td>
								<td style = 'padding-left:5px;color:#707070;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'retencion_fuente'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class ='concepto2' style = 'padding-left:10px;'>IMPUESTOS ADICIONALES</td>
								<td align = 'center' class ='concepto2'>
									<span id = 'por_impuestos_adicionales' >0</span>
								</td>
								<td style = 'padding-left:5px;color:#707070;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'impuestos_adicionales'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class ='concepto2' style = 'padding-left:10px;'>ICA</td>
								<td align = 'center'class ='concepto2' >
									<span  >9.66/1000</span>
									<span id = 'por_ica_val' class  = 'hidde'>9.66</span>
								</td>
								<td style = 'padding-left:5px;color:#707070;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'val_ica'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class ='concepto2' style = 'padding-left:10px;'>CREE</td>
								<td align = 'center' class ='concepto2'>
									<span id = 'por_cree_val' >0.8</span>
								</td>
								<td style = 'padding-left:5px;color:#707070;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'val_cree'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2'class ='concepto2' style = 'padding-left:10px;'>4 x 1000</td>
								<td style = 'padding-left:5px;color:#707070;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'cuatro_por_mil'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class ='concepto2' style = 'padding-left:10px;'>CHEQUES Y TRANSFERENCIAS</td>
								<td align = 'center' class ='concepto2' >
									<span id = 'num_chueques' >0</span>
								</td>
								<td style = 'padding-left:5px;color:#707070;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'cheques_val'></td>
										</tr>
									</table>
									<span id = 'uni_valor_cheques' class = 'hidde'>3350</span>
								</td>
							</tr>
							
							<tr>
								<td class ='concepto2' style = 'padding-left:10px;'>FACTORING</td>
								<td class ='concepto2'>
									<input type = 'text' id = 'por_factoring' value = '0' class = 'entrada_bordes' style = 'width:40px;' placeholder = '%' />
								</td>
								<td style = 'padding-left:5px;color:#707070;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'val_factoring'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class ='concepto2' style = 'padding-left:10px;'>ANTICIPOS INTERESES BANCARIOS</td>
								<td align = 'center' class ='concepto2'>
									<span id = 'por_ant_banca' >0</span>
								</td>
								<td style = 'padding-left:5px;color:#707070;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'val_ant_int_banc'></td>
										</tr>
									</table>
									<span class = 'hidde' id = 'pago_a_cliente'>45</span>
								</td>
							</tr>
							<tr>
								<td class ='concepto2' style = 'padding-left:10px;'>DEL PROYECTO INTERESES BANCARIOS</td>
								<td class ='concepto2'>
									<input type = 'text' id = 'dpib' value = '0' class = 'entrada_bordes' style = 'width:40px;' placeholder = '%' />
								</td>
								<td style = 'padding-left:5px;color:#707070;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'val_por_pro_banc'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class ='concepto2' style = 'padding-left:10px;'>DEL PROYECTO INTERESES A 3ROS</td>
								<td class ='concepto2'>
									<input type = 'text' id = 'dpi3' value = '0' class = 'entrada_bordes' style = 'width:40px;' placeholder = '%' />
								</td>
								<td style = 'padding-left:5px;color:#707070;'class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'val_por_com_ter'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto2' style = 'padding-left:10px;background-color:#D0DEF4;'>TOTAL COSTOS FINANCIEROS E IMPUESTOS</td>
								<td style = 'padding-left:5px;color:#707070;background-color:#D0DEF4;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'total_cost_finan_imp'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto2' style = 'padding-left:10px;background-color:#D0DEF4;'>UTILIDAD FINAL</td>
								<td style = 'padding-left:5px;color:#707070;background-color:#D0DEF4;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'utilidad_final' nowrap></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan = '2' class ='concepto2' style = 'border-bottom-left-radius:1em;-moz-border-bottom-left-radius:1em;-webkit-border-bottom-left-radius:1em;padding-left:10px;'>EXCEDENTE ASOCIADOS</td>
								<td style = 'padding-left:5px;color:#707070;border-bottom-right-radius:1em;-moz-border-bottom-right-radius:1em;-webkit-border-bottom-right-radius:1em;' class ='concepto2'>
									<table >
										<tr>
											<td>$</td>
											<td align = 'right' id = 'sobrante_asoc'></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					
					<td rowspan = '13'  style = 'font-size:300%;vertical-align:top;padding-left:10px;'  width = '33%' colspan = '5'>
						<div class = 'redondo' id = 'por_utilidad' align = 'center' style = 'vertical-align:middle;'>
							
						</div>
					</td>
					<span class = 'hidde' id = 'por_min_val_apro'>20</span>
				</tr>
			</table>";
		echo $footer_ppto;
?>