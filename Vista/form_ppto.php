<?php

?>
<div id = "v_generar_op" class = 'ventana'>
				<table width = '100%' class = 'tabla_gen_orden' style = 'padding-left:50px;padding-right:50px;display:none;'>
					<tr>
						<td width = '96%' align = 'left'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>
										<?php echo $emp->mostrar_logo_empresa($gestion->mostrar_empresa_empleado()); ?>
									</td>
								</tr>
								<tr>
									<td align = 'left' >
										<span class = 'mensaje_bienvenida'>GENERAR ORDEN</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right'>
							<img id = "cerrar_ventana_informacion_basica" src = "../images/iconos/icon-19.png" class = 'iconos_opciones'/>
						</td>
					</tr>
				</table>
				</br>
				<table width = '100%' class = 'tabla_nuevos_datos2' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td colspan = '2'>
							<p>Seleccione un Proveedor:</p>
							<select id = 'listado_proveedores' style = 'width:auto;'></select>
						</td>
					</tr>
					<tr><td></td></tr>
					<tr>
						<td colspan = '2'>
							<div id = 'contenedor_items_proveedor' style = 'overflow:scroll;width:100%;height:250px;border:1px solid black;'></div>
						</td>
					</tr>
					<tr>
						<td>
							<p>Fecha Entrega:</p>
							<input type = 'text' id = 'fecha_entrega_op'/>
						</td>
						<td>
							<p>Fecha Radicación Orden:</p>
							<input type = 'text' id = 'fecha_radicacion_op'/>
						</td>
					</tr>
					<tr>
						<td>
							<p>Vigencia Inicial Orden:</p>
							<input type = 'text' id = 'vigencia_inicial_op'/>
						</td>
						<td>
							<p>Vigencia Final Orden:</p>
							<input type = 'text' id = 'vigencia_final_op'/>
						</td>
					</tr>
					<tr>
						<td>
							<p>Nota OP:</p>
							<textarea id = 'nota_op' cols = '30'>
							
							</textarea>
						</td>
						<td style = 'vertical-align:top;'>
							<p>Forma de Pago:</p>
							<select id = 'fpago'>
								<?php
									$sql = mysql_query("select codigo_interno,name_forma_pago from fpago");
									$imp = "<option value = '0'>[SELECCIONE]</option>";
									while($row = mysql_fetch_array($sql)){
										$imp.="<option value ='".$row['codigo_interno']."'>".$row['name_forma_pago']."</option>";
									}
									echo $imp;
								?>
							</select>
						</td>
					</tr>
					<tr><td></br></td></tr>
					<tr>
						<td align = 'center' colspan = '2'>
							<span id = 'bttn_generar_op' class ='botton_verde'>Generar OP</span>
						</td>
					</tr>
				</table>
				<div class = "scroll_nueva_ventana">
					</br>
					
				</div>
			</div>
			
			
			
			<div class = 'ventana' id = "anticipos_ventana">
				<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td width = '96%' align = 'left'>
								<table width = '100%'>
									<tr>
										<td align = 'left'>
											<?php echo $emp->mostrar_logo_empresa($gestion->mostrar_empresa_empleado()); 
											?>
										</td>
									</tr>
									<tr>
										<td align = 'left' >
											<span class = 'mensaje_bienvenida' >FORMATO DE SOLICITUD DE ANTICIPO VIATICOS Y COMRPAS</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right' >
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img onclick = '$("#anticipos_ventana").dialog("close");$(".scroll").css({"overflow":"scroll"});' src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
				</table>
				</br>
				<table width = '100%' style = 'padding-left:50px;padding-right:50px;border'>
					<tr>
						<td>Fecha: <?php echo date("Y-m-d ");?></td>
					</tr>
					<tr>
						<td>
							<strong>
								<p>Nombre Cliente:</p>
							</strong>
						</td>
						<td>
							<p id = 'name_cliente_ant'></p>
						</td>
						<td class = 'separator'></td>
						<td>
							<strong>
								<p>No.PPTO:</p>
							</strong>
						</td>
						<td>
							<p id = 'num_ppto_ant'></p>
						</td>
					</tr>
					<tr>
						<td>
							<strong>
								<p>Fecha Entrega Anticipo:</p>
							</strong>
						</td>
						<td>
							<input type = 'text' class = 'entrada_bordes' id = 'fecha_entrega_anticipo'/>
						</td>
						<td class = 'separator'></td>
						<td>
							<strong>
								<p>Unidad de Negocio:</p>
							</strong>
						</td>
						<td>
							<p id = 'unidad_negocio_ant'></p>
						</td>
					</tr>
					<tr>
						<td>
							<strong>
								<p>Fecha Máxima de Legalización:</p>
							</strong>
						</td>
						<td>
							<p id = 'fecha_maxima_legalizacion'></p>
						</td>
						<td class = 'separator'></td>
					</tr>
				</table>
				<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td>
							<strong>
								<p>Nombre del Funcionario:</p>
							</strong>
						</td>
						<td>
							<p>DAMIAN ALFREDO MOSQUERA BRAVO:</p>
						</td>
						<td class = 'separator'></td>
						<td>
							<strong>
								<p>Documento de Identidad:</p>
							</strong>
						</td>
						<td>
							<p id = 'name_cliente_ant'>1019078426 C.C.</p>
						</td>
					</tr>
					<tr>
						<td>
							<strong>
								<p>Dependencia:</p>
							</strong>
						</td>
						<td>
							<p>DESARROLLADOR</p>
						</td>
						<td class = 'separator'></td>
						<td>
							<strong>
								<p>CARGO:</p>
							</strong>
						</td>
						<td>
							<p id = 'name_cliente_ant'>PRODUCTOR</p>
						</td>
					</tr>
					
					<tr>
						<td colspan = '5'  width = '100%'>
							<textarea cols = '100' class = 'entrada_bordes' style = 'width:100%;'rows = '5' placeholder = 'Describa brevemente la solicitud del Anticipo'></textarea>	
						</td>
					</tr>
				</table>
				<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td colspan = '5'>
							<table width = '100%'>
								<tr>
									<td >
										<table width = '100%'>
											<tr>
												<th style = 'border:1px solid black;'>Vo. Bo. Director Proyecto</th>
											</tr>
											<tr>
												<td style = 'border:1px solid black;height:80px;'></td>
											</tr>
										</table>
									</td>
									<td >
										<table width = '100%'>
											<tr>
												<th style = 'border:1px solid black;'>Vo. Bo. Dir. Unidad</th>
											</tr>
											<tr>
												<td style = 'border:1px solid black;height:80px;'></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<?php
					$ppto->mostrar_items_anticipo(3);
				?>
				<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td colspan = '5' align = 'justify'>
							
							<p>Yo,  <strong>DAMIAN ALFREDO MOSQUERA BRAVO</strong> autorizo a <strong>LA ESTACIÓN PROMOCIONES Y ACTIVACIONES S.A.S. </strong>para descontar de mi salario y/o prestaciones sociales u otro derecho laboral que me llegue a corresponder, la suma que he recibido en razón de ANTICIPO, en caso de no legalizarlo oportunamente según lo dispuesto en el procedimiento para solicitar y legalizar anticipos el cual declaro conocer suficientemente.</p>
							<p><strong>**** Este anticipo deberá ser legalizado a la Empresa,  a más tardar al segundo miércoles después de la fecha de entrega del ANTICIPO.</strong></p>
						</td>
					</tr>
				</table>
				<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td colspan = '5' align = 'justify'>
							<table width = '100%'>
								<tr>
									<th  style = 'border:1px solid black;text-align:center;'>Autorización descuento de Nómina</th>
								</tr>
								<tr>
									<td style = 'border:1px solid black;height:80px;' ></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				
			</div>
			
			