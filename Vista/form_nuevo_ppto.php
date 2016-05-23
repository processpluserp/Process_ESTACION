<?php
	$titulo_ventana = "NUEVO PRESUPUESTO";
	$cerrar_ventana = "cerrar_ventanas_ppto();";
	$icono_cerrar = "icon-19.png";
	include("encabezado_vista.php");
	
	if(!empty($_POST["user"])){
		$usu = $_POST['user'];
		$estructura_ventana.="
		<div class ='scroll_nueva_ventana2'>
				<table class = 'tabla_nuevos_datos2 form_nuevo_ppto' width = '100%' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td width = '48%'>
							<p>Seleccione una Empresa:</p>
							<select class = 'entradas_bordes' id = 'grupo_empresas' name = 'grupo_empresas' onchange = 'frmnewppto_empresa()' style = 'width:98%;'>
								<option value = '0'>[SELECCIONE]</option>";
								//$usu = $_SESSION['codigo_usuario'];
								$select_emp = 'select distinct e.cod_interno_empresa, e.nombre_comercial_empresa from empresa e, pusuemp p where 
								p.cod_usuario = '.$usu.' and p.cod_empresa = e.cod_interno_empresa order by e.nombre_comercial_empresa asc';
								$result = mysql_query($select_emp);
								while($row = mysql_fetch_array($result)){
									$estructura_ventana.="<option value ='".$row['cod_interno_empresa']."'>".$row['nombre_comercial_empresa']."</option>";
								}
							$estructura_ventana.="</select>
						</td>
						<td style = 'width:2%;' ></td>
						<td width = '48%'>
							<p>Seleccione un Cliente:</p>
							<select class = 'entradas_bordes' id ='cliente' name = 'cliente' onchange = 'frmnewppto_cliente();'><option value = '0'>[SELECCIONE]</option></select>
						</td>
					</tr>
					<tr>
						<td style = 'vertical-align:top;' >
							<table width = '100%'>
								<tr>
									<td style = 'width:48%'>
										<p>Seleccione una OT:</p>
										<select id = 'ot' name = 'ot'><option value = '0'>[SELECCIONE]</option></select>
									</td>
									<td style = 'width:2%;' ></td>
									<td style = 'width:48%'>
										<p>Seleccione un Centro de Costo:</p>
										<select id = 'c_costo_fn' name = 'c_costo_fn'>
											<option value = '0'>[SELECCIONE]</option>
										</select>
									</td>
								</tr>
							</table>
							
						</td>
						<td style = 'width:2%;' ></td>
						<td style = 'vertical-align:top;' width = '48%'>
							<p>Ingrese la Referencia del Ppto:</p>
							<textarea class = 'entradas_bordes' rows = '5' cols = '60' id = 'referencia'>
							</textarea>
						</td>
					</tr>
					<tr>
						<td style = 'vertical-align:top;'>
							<table width = '100%'>
								<tr>
									<td style = 'width:48%'>
										<p>Seleccione la Vigencia Inicial:</p>
										<input type = 'text' name = 'v_inicial' id = 'v_inicial' class = 'entradas_bordes fechas' />
									</td>
									<td style = 'width:2%;' ></td>
									<td style = 'width:48%'>
										<p>Seleccione la Vigencia Final:</p>
										<input type = 'text' name = 'v_final' id = 'v_final' class = 'entradas_bordes fechas' onchange = 'validar_fechas_vigencia_ppto()'/>
									</td>
								</tr>
								<tr>
									<td style = 'width:48%'>
										<p>Número de Aprobación</p>
										<input type = 'text' name = 'n_aprobacion' id = 'n_aprobacion' />
									</td>
									<td style = 'width:2%;' ></td>
									<td style = 'width:48%'>
										<p>Ingrese el lugar de ejecución:</p>
										<input type = 'text' class = 'entradas_bordes' id = 'ciudad' name = 'ciudad' />
										";
												/*
												<select id = 'ciudad' name = 'ciudad'>
												<option>...</option>
												$select = 'select c.codigo_ciudad, c.nombre_ciudad from ciudad c where
												c.departamento_pais_codigo_pais = 1 order by c.nombre_ciudad';
												$r = mysql_query($select);
												while($row = mysql_fetch_array($r)){
													if($row['codigo_ciudad'] == 14){
														$estructura_ventana.="<option value = '".$row['codigo_ciudad']."' selected>".$row['nombre_ciudad']."</option>";
													}else{
														$estructura_ventana.="<option value = '".$row['codigo_ciudad']."'>".$row['nombre_ciudad']."</option>";
													}
												}*/
											$estructura_ventana.="
										</select>
									</td>
								</tr>
							</table>
						</td>
						<td style = 'width:2%;' ></td>
						<td style = 'vertical-align:top;'>
							<p>Nota legal del Ppto:</p>
							<textarea id = 'nota_ppto' class = 'entradas_bordes' rows = '5' cols = '60' readonly></textarea>
						</td>
					</tr>
					<tr>
						<td style = 'vertical-align:top;'>
							<table width = '100%'>
								<tr>
									<td style = 'width:48%'>
										<p>Dirigido a:</p>
										<input type = 'text' name = 'aquien_va' id = 'aquien_va' class = 'entradas_bordes' />
									</td>
									<td style = 'width:2%;' ></td>
									<td style = 'width:48%'>
									</td>
								</tr>
							</table>
						</td>
						<td style = 'width:2%;' ></td>
						<td style = 'vertical-align:top;'>
							<table width = '100%'>
								<tr>
									<td style = 'width:48%'>
										<p>Seleccione el Tipo de Ppto:</p>
										<select id = 'tipo_ppto' name = 'tipo_ppto'>
											<option value = '0'>[SELECCIONE]</option>";
												$select = 'select consecutivo, nombre from tipo_cuenta_ppto where estado = 1 order by nombre asc';
												$r = mysql_query($select);
												while($row = mysql_fetch_array($r)){
													$estructura_ventana.="<option value = '".$row['consecutivo']."'>".utf8_encode($row['nombre'])."</option>";
												}
											$estructura_ventana.="
										</select>
									</td>
									<td style = 'width:2%;' ></td>
									<td style = 'width:48%'>
										<p>Seleccione el Tipo Comision:</p>
										<select id = 'tipo_comision'>
											<option value = '0'>[SELECCIONE]</option>
										</select>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td style = 'vertical-align:top;'>
							
						</td>
						<td style = 'width:2%;' ></td>
						<td>
							
						</td>
					</tr>
					<tr>
						<td style = 'vertical-align:top;' colspan = '3' align = 'center'>
							<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' id = 'cancelar' onclick = 'cerrar_ventanas_ppto();' style = 'position:relative;'>
							<img src = '../images/iconos/guardar_1.png' class = 'iconos_guardar_x'   style = 'position:relative;top:45px;left:-50px;z-index:1;'>
							<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' onclick = 'crear_ppto()' style = 'position:relative;left:-110px;'>
						</td>
					</tr>
				</table>
			</div>
			<script type = 'text/javascript'>
				function nonWorkingDates(date){
					var day = date.getDay(), Sunday = 0, Monday = 1, Tuesday = 2, Wednesday = 3, Thursday = 4, Friday = 5, Saturday = 6;
					var closedDays = [[Saturday], [Sunday]];
					return [true];
				}
				$('.form_nuevo_ppto input,.form_nuevo_ppto textarea').val('');
				$('.fechas').datepicker({ dateFormat: 'yy-mm-dd',beforeShowDay: nonWorkingDates,	numberOfMonths: 1,	minDate: '0',firstDay: 1  });
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