<?php
	class financiera{
		
		public function estructura_financierta($und,$empresa,$emple,$bancos){
		$comp = "";
		$total_fac = 0;
		$per_gan = 0;
		$apro_sin_ej = 0;
		$eje_po_fac = 0;
		$administrativos = 0;
		if($und == 1){
			$total_fac = 0;
			$eje_po_fac = 0;
			$apro_sin_ej = 0;
			$administrativos = 0;
			$per_gan = 0;
			$comp = "<table >
				<tr>
					<td>FACTURADO A 30 DIC.</td>
					<td>
						<table >
							<tr>
								<td align = 'left'>$</td>
								<td align = 'right'>".number_format(51415404)."</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>GANACIA A 30 DIC.</td>
					<td>
						<table >
							<tr>
								<td align = 'left'>$</td>
								<td align = 'right'>".number_format(18219937)."</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>";
		}else if($und == 2){
			$total_fac = 0;
			$per_gan = 0;
			$eje_po_fac = 0;
			$apro_sin_ej = 0;
			$administrativos = 0;
			$comp = "<table >
				<tr>
					<td>FACTURADO A 30 DIC.</td>
					<td>
						<table >
							<tr>
								<td align = 'left'>$</td>
								<td align = 'right'>".number_format(51415404)."</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>PERDIDA A 30 DIC.</td>
					<td>
						<table >
							<tr>
								<td align = 'left'>$</td>
								<td align = 'right'>".number_format(18219937)."</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>";
		}else if($und == 4){
			$total_fac = 561000428;
			$eje_po_fac = 0;
			$apro_sin_ej = 0;
			$administrativos = 0;
			$per_gan = 201517493;
			$comp = "<table >
				<tr>
					<td>FACTURADO A 30 DIC.</td>
					<td>
						<table >
							<tr>
								<td align = 'left'>$</td>
								<td align = 'right'>".number_format(561000428)."</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>GANANCIA A 30 DIC.</td>
					<td>
						<table >
							<tr>
								<td align = 'left'>$</td>
								<td align = 'right'>".number_format(201517493)."</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>";
		}else if($und == 7){
			$total_fac = 51415404;
			$per_gan = -18219937;
			$eje_po_fac = 0;
			$administrativos = 11407375;
			$apro_sin_ej = 0;
			$comp = "<table >
				<tr>
					<td>FACTURADO A 30 DIC.</td>
					<td>
						<table >
							<tr>
								<td align = 'left'>$</td>
								<td align = 'right'>".number_format(51415404)."</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>PERDIDA A 30 DIC.</td>
					<td>
						<table >
							<tr>
								<td align = 'left'>$</td>
								<td align = 'right'>".number_format(18219937)."</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>";
		}
		
			$est = "<div id = 'tabs' style = 'width:100%;padding-left:50px;padding-right:50px;'>
						<ul style = 'padding-left:50px;'>
							<li class = 'pestanas_menu' ><a href='#tabs-1'>CONSOLIDADO</a></li>
							<li class = 'pestanas_menu' ><a href='#tabs-2'>CARTERA GENERAL</a></li>
							<li class = 'pestanas_menu' ><a href='#tabs-3'>CUENTAS X PAGAR</a></li>
							<li class = 'pestanas_menu' ><a href='#tabs-4'>PPTADO VS EJECUTADO</a></li>
							<li class = 'pestanas_menu' ><a href='#tabs-5'>INDEMNIZACIONES Y LIQUIDACIONES</a></li>
			";
			$sql = mysql_query("select p.id,p.name,t.name as tipo from probancos p, tipo_producto_banco t
			where p.und = '$und' and p.pk_tipo = t.id");
			while($row = mysql_fetch_array($sql)){
				$est.="<li class = 'pestanas_menu' ><a href='#tabs-r".$row['id']."'>".$row['tipo']." ".$row['name']."</a></li>";
			}
			$periodo =date("Y")."-".floatval(date("m"));
			$sql = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.und = '$und' order by e.nombre_empleado asc");
			
			while($row = mysql_fetch_array($sql)){
				$est.="<li class = 'pestanas_menu' ><a href='#tabs-".$row['documento_empleado']."'>".$row['nombre_empleado']."</a></li>";
			}
			
						
			$est.="</ul>";
			$est.="<div id = 'tabs-4'>".$this->ppto_vs_ejecutado($und,$empresa)."</div>";
			$sql = mysql_query("select p.id,p.name,t.name as tipo from probancos p, tipo_producto_banco t
			where p.und = '$und' and p.pk_tipo = t.id");
			while($row = mysql_fetch_array($sql)){
				$est.="<div id = 'tabs-r".$row['id']."'>".$bancos->estructura_cc_cax($row['id'])."</div>";
			}
			$est.="<div id = 'tabs-2'>".$this->cartera_general($und)."</div>";
			
			$sql = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.und = '$und'");
			
			while($row = mysql_fetch_array($sql)){
				$est.="<div style = 'padding-left:10%;padding-right:10%;'id = 'tabs-".$row['documento_empleado']."'>".$emple->hoja_vida_empleado2($row['documento_empleado'],$periodo,$empresa)."</div>";
			}
			$est.="<div id = 'tabs-5'>".$emple->personal_down($periodo,$empresa,$und)."</div>";
			
			//ESTRUCTURA CONSOLIDADO
			$sql = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
			from empleado e, tablas_empleados te
			where e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.und = '$und'");
			$nomina_a_personal = 0;
			$planilla = 0;
			$bnp = 0;
			$provisiones  = 0;
			while($row = mysql_fetch_array($sql)){
				$nomina_a_personal +=$emple->costo_total_empleado_compania($row['documento_empleado'],$periodo,$empresa);
				$planilla +=$emple->planilla($row['documento_empleado'],$periodo,$empresa);
				$bnp +=$emple->beneficio_np($row['documento_empleado'],$periodo,$empresa);
				$provisiones += $emple->provisiones($row['documento_empleado'],$periodo,$empresa);
			}
			$sql = mysql_query("select id from probancos where empresa = '$empresa' and und = '$und'");
			$total_bancos = 0;
			while($row = mysql_fetch_array($sql)){
				$total_bancos +=$bancos->saldo_bancos_und($row['id']);
			}
			
			$sql = mysql_query("select saldo from temp_clientes where und = '$und'");
			$total_carterea = 0;
			while($row = mysql_fetch_array($sql)){
				$total_carterea +=$row['saldo'];
			}
			
			
			$sql = mysql_query("select valor from temp_proveedores where und = '$und'");
			$cuentas_x_pagar = 0;
			while($row = mysql_fetch_array($sql)){
				$cuentas_x_pagar +=$row['valor'];
			}
			$est.="<div id = 'tabs-1'>
				$comp
				<table width = '100%' >
					<tr>
					<th colspan = '5'>CONSOLIDADO ".date("Y")."</th>
				</tr>
				<tr>
					<td>Fecha: ".date("Y-m-d")."</td>
				</tr>
				<tr>
					<td class = 'titulos' nowrap>
						<p>SALDO EN BANCOS</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>Saldo</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format($total_bancos)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td class = 'titulos' nowrap>
						<p>CREDITOS BANCARIOS</p>						
					</td>
					<td class = 'contenedor_items'>
						
					</td>
				</tr>
				
				<tr>
					<td></td>
					<td >
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>SALDO EN BANCOS</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format($total_bancos)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>CREDITOS BANCARIOS</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td class = 'titulos' nowrap>
						<p>CARTERA</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>CARTERA</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format($total_carterea)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td class = 'titulos' nowrap>
						<p>CUENTAS POR PAGAR</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>PROVEEDORES</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format($cuentas_x_pagar)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								
							</tr>
						</table>
					</td>
				</tr>
				
				<tr>
					<td></td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>TOTAL CARTERA</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format($total_carterea)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>TOTAL CUENTAS POR PAGAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format($cuentas_x_pagar)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td></td>
					<td class = 'titulos' nowrap>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>TOTAL FACTURADO</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format($total_fac + $total_carterea)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td rowspan = '8'class = 'titulos' nowrap>NOMINA Y ADMINISTRATIVOS</td>
					<td rowspan = '8' class  ='contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>NOMINA A PERSONAL</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format($nomina_a_personal)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>PLANILLA</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format($planilla)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>BENEFICIO NO PRESTACIONAL</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format($bnp)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>PROVISIONES CUENTA DE AHORRO</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format($provisiones)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>COMISION PEOPLE PASS 1.8%</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(($bnp*1.8)/100)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>ADMINISTRATIVOS</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format($administrativos)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr >
								<td colspan = '2'>
									<table width = '100%' class = 'resultados'>
										<tr>
											<td width = '50%'>
												<p>NOMINA Y ADMINISTRATIVOS</p>
											</td>
											<td>
												<table width = '100%'>
													<tr>
														<td align = 'left'>$</td>
														<td align = 'right'>".number_format($nomina_a_personal + $bnp + (($bnp*1.8)/100) + $planilla + $provisiones + $administrativos)."</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class = 'titulos' nowrap>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>EJECUTADO PTE POR FACTURAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format($eje_po_fac)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class = 'titulos' nowrap>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>APROBADO SIN EJECUTAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class = 'titulos' nowrap>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>TOTAL CARTERA</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format($total_fac + $total_carterea + $eje_po_fac)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr>
					<td class = 'titulos' nowrap>
						<p>CUENTA DE AHORROS</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>PROVISION LIQUIDACIONES A DICIEMBRE 30</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>PROVISION INDEMNIZACION A DICIEMBRE 30</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td class = 'titulos' nowrap>
						<p>LIQUIDACIONES E INDEMNIZACIONES</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>PROVISION LIQUIDACIONES A DICIEMBRE 30</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>PROVISION INDEMNIZACION A DICIEMBRE 30</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>TOTAL PORVISION CUENTA DE AHORROS</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>TOTAL LIQUIDACIONES E INDEPNIZACIONES</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>CUENTAS POR COBRAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format($total_carterea)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>CUENTAS POR PAGAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format($cuentas_x_pagar)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>DISPONIBLE 2014</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(13720000)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>SALDO DISPONIBLE</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(398645771)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>NECESIDAD MENSUAL</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(114167506)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>DISPONIBLE SIN FACTURAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(521420)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>DISPONIBLE REAL FACTURADO</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(398124350)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td class = 'titulos' nowrap>
						<p>RETENCIONES A FAVOR 2015</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>RETENCIONES A FAVOR 2015</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(141638000)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>NOVIEMBRE</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(283956844)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>DICIEMBRE</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(169789339)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>ENERO</p>
								</td>
								<td class = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(55621833)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>FEBRERO</p>
								</td>
								<td class = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(-58545673)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
				</tr>
				</table>
			</div>";
			echo $est."</div>
			<script type = 'text/javascript'>
				$( '#tabs' ).tabs();
			</script>";
		}
	
		
		public function estructura_consolidado_btl(){
			$est = "<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
				<tr>
					<th colspan = '5'>CONSOLIDADO ".date("Y")."</th>
				</tr>
				<tr>
					<td>Fecha: ".date("Y-m-d")."</td>
				</tr>
				<tr>
					<td class = 'titulos' nowrap>
						<p>SALDO EN BANCOS</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>Saldo Bancolombia</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(17837673)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td class = 'titulos' nowrap>
						<p>CREDITOS BANCARIOS</p>						
					</td>
					<td class = 'contenedor_items'>
						
					</td>
				</tr>
				
				<tr>
					<td></td>
					<td >
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>SALDO EN BANCOS</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(17837673)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>CREDITOS BANCARIOS</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td class = 'titulos' nowrap>
						<p>CARTERA</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>CARTERA</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(756228598)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td class = 'titulos' nowrap>
						<p>CUENTAS POR PAGAR</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>PROVEEDORES</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(263424103)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>GASTOS ADMINISTRATIVOS</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(17460000)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				
				<tr>
					<td></td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>TOTAL CARTERA</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(756228598)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>TOTAL CUENTAS POR PAGAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(280884103)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td></td>
					<td class = 'titulos' nowrap>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>TOTAL FACTURADO</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(753961553)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td rowspan = '8'class = 'titulos' nowrap>NOMINA Y ADMINISTRATIVOS</td>
					<td rowspan = '8' class  ='contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>NOMINA A PERSONAL</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(38103934)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>PLANILLA</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(13788692)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>BENEFICIO NO PRESTACIONAL</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(28856100)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>PROVISIONES CUENTA DE AHORRO</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(10097862)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>COMISION PEOPLE PASS 1.8%</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(739900)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>ADMINISTRATIVOS</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(16669909)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr >
								<td colspan = '2'>
									<table width = '100%' class = 'resultados'>
										<tr>
											<td width = '50%'>
												<p>NOMINA Y ADMINISTRATIVOS</p>
											</td>
											<td>
												<table width = '100%'>
													<tr>
														<td align = 'left'>$</td>
														<td align = 'right'>".number_format(108256397)."</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class = 'titulos' nowrap>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>EJECUTADO PTE POR FACTURAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(2267046)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class = 'titulos' nowrap>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>APROBADO SIN EJECUTAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class = 'titulos' nowrap>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>TOTAL CARTERA</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(756228598)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr>
					<td class = 'titulos' nowrap>
						<p>CUENTA DE AHORROS</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>PROVISION LIQUIDACIONES A OCTUBRE 30</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(31661050)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>PROVISION INDEMNIZACION A OCTUBRE 30</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(27057552)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td class = 'titulos' nowrap>
						<p>LIQUIDACIONES E INDEMNIZACIONES</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>PROVISION LIQUIDACIONES A OCTUBRE 30</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(31661050)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>PROVISION INDEMNIZACION A OCTUBRE 30</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(27057552)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>TOTAL PORVISION CUENTA DE AHORROS</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(58718602)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>TOTAL LIQUIDACIONES E INDEPNIZACIONES</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(58718602)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>CUENTAS POR COBRAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(832784873)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>CUENTAS POR PAGAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(447859102)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>DISPONIBLE 2014</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(13720000)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>SALDO DISPONIBLE</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(398645771)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>NECESIDAD MENSUAL</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(114167506)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>DISPONIBLE SIN FACTURAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(521420)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>DISPONIBLE REAL FACTURADO</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(398124350)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td class = 'titulos' nowrap>
						<p>RETENCIONES A FAVOR 2015</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>RETENCIONES A FAVOR 2015</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(141638000)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>NOVIEMBRE</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(283956844)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>DICIEMBRE</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(169789339)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>ENERO</p>
								</td>
								<td class = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(55621833)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>FEBRERO</p>
								</td>
								<td class = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(-58545673)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
				</tr>
			</table>";
			return $est;
		}
		
		public function estructura_consolidado_digital(){
			$est = "<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
				<tr>
					<th colspan = '5'>CONSOLIDADO ".date("Y")."</th>
				</tr>
				<tr>
					<td>Fecha: ".date("Y-m-d")."</td>
				</tr>
				<tr>
					<td class = 'titulos' nowrap>
						<p>SALDO EN BANCOS</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>Saldo Bancolombia</p>
								</td>
								<td class = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(-636823)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td class = 'titulos' nowrap>
						<p>CREDITOS BANCARIOS</p>						
					</td>
					<td class = 'contenedor_items'>
						
					</td>
				</tr>
				
				<tr>
					<td></td>
					<td >
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>SALDO EN BANCOS</p>
								</td>
								<td class = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(-636823)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>CREDITOS BANCARIOS</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td class = 'titulos' nowrap>
						<p>CARTERA</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>CARTERA</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(51415404)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td class = 'titulos' nowrap>
						<p>CUENTAS POR PAGAR</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>PROVEEDORES</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(19840000)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				
				<tr>
					<td></td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>TOTAL CARTERA</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(51415404)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>TOTAL CUENTAS POR PAGAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(19840000)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td></td>
					<td class = 'titulos' nowrap>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>TOTAL FACTURADO</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(51415404)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td rowspan = '8'class = 'titulos' nowrap>NOMINA Y ADMINISTRATIVOS</td>
					<td rowspan = '8' class  ='contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>NOMINA A PERSONAL</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(5762000)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>PLANILLA</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(1292467)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>BENEFICIO NO PRESTACIONAL</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(3909120)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>PROVISIONES CUENTA DE AHORRO</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>COMISION PEOPLE PASS 1.8%</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(69120)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>ADMINISTRATIVOS</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(11260530)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr >
								<td colspan = '2'>
									<table width = '100%' class = 'resultados'>
										<tr>
											<td width = '50%'>
												<p>NOMINA Y ADMINISTRATIVOS</p>
											</td>
											<td>
												<table width = '100%'>
													<tr>
														<td align = 'left'>$</td>
														<td align = 'right'>".number_format(22293237)."</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class = 'titulos' nowrap>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>EJECUTADO PTE POR FACTURAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class = 'titulos' nowrap>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>APROBADO SIN EJECUTAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class = 'titulos' nowrap>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>TOTAL CARTERA</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(51415404)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr>
					<td class = 'titulos' nowrap>
						<p>CUENTA DE AHORROS</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>PROVISION LIQUIDACIONES A DICIEMBRE 30</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>PROVISION INDEMNIZACION A DICIEMBRE 30</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td class = 'titulos' nowrap>
						<p>LIQUIDACIONES E INDEMNIZACIONES</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>PROVISION LIQUIDACIONES A DICIEMBRE 30</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(7110598)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>PROVISION INDEMNIZACION A DICIEMBRE 30</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(6660000)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>TOTAL PORVISION CUENTA DE AHORROS</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(6660000)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>TOTAL LIQUIDACIONES E INDEPNIZACIONES</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(13770598)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>CUENTAS POR COBRAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(51415404)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>CUENTAS POR PAGAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(19840000)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>DISPONIBLE 2015</p>
								</td>
								<td class = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(-1643931)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>SALDO DISPONIBLE</p>
								</td>
								<td class = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(-1643931)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>NECESIDAD MENSUAL</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(33276540)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>DISPONIBLE SIN FACTURAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>DISPONIBLE REAL FACTURADO</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td class = 'titulos' nowrap>
						<p>RETENCIONES A FAVOR 2015</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>RETENCIONES A FAVOR 2015</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(6641139)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>NOVIEMBRE</p>
								</td>
								<td class = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(-168026630)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>DICIEMBRE</p>
								</td>
								<td class = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(-201303170)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>ENERO</p>
								</td>
								<td class = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(-234579710)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
				</tr>
				<tr><td></td></tr>
			</table>";
			return $est;
		}
		
		public function estructura_consolidado_atl(){
			$est = "<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
				<tr>
					<th colspan = '5'>CONSOLIDADO ".date("Y")."</th>
				</tr>
				<tr>
					<td>Fecha: ".date("Y-m-d")."</td>
				</tr>
				<tr>
					<td class = 'titulos' nowrap>
						<p>SALDO EN BANCOS</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>Saldo Toro</p>
								</td>
								<td class = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(-154596555)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>Saldo Fase Dos</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(199434)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>Saldo Publicidad Toro</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(2679116)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td class = 'titulos' nowrap>
						<p>CREDITOS BANCARIOS</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>Publicidad Toro</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>Toro Love</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(350000000)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>Divisa Toro Love</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				
				<tr>
					<td></td>
					<td >
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>SALDO EN BANCOS</p>
								</td>
								<td class = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(-151718005)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>CREDITOS BANCARIOS</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(350000000)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td class = 'titulos' nowrap>
						<p>CARTERA</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>Cuentas Por Cobrar Toro</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(1561831609)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>Prestamos</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>Cuentas Pendientes por Facturar Toro</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>Cuentas por Cobrar Fase Dos</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>Cuentas Pendientes por Facturar Fase Dos</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>Fee Pte por Cobrar Diciembre</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(79765366)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>Fee Pte por Facturar Diciembre</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td class = 'titulos' nowrap>
						<p>CUENTAS POR PAGAR</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>Cuentas por pagar Toro Proveedores</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(2264797590)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>Cuentas por pagar Toro Admon</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(201744)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				
				<tr>
					<td></td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>TOTAL CARTERA</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(1641596975)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>TOTAL CUENTAS POR PAGAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(2264999334)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td></td>
					<td class = 'titulos' nowrap>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>TOTAL FACTURADO</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(1641596975)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td rowspan = '8'class = 'titulos' nowrap>NOMINA Y ADMINISTRATIVOS</td>
					<td rowspan = '8' class  ='contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>NOMINA A PERSONAL</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(120411001)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>PLANILLA</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(28656247)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>BENEFICIO NO PRESTACIONAL</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(52935000)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>PROVISIONES CUENTA DE AHORRO</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(25726421)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>COMISION PEOPLE PASS 1.8%</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(1000000)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>MONETIZACIÓN SENA</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(1933050)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>POLIZA 40% BENEFICIO NO PRESTACIONAL</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(1980000)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>ADMINISTRATIVOS</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(27454069)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr >
								<td colspan = '2'>
									<table width = '100%' class = 'resultados'>
										<tr>
											<td width = '50%'>
												<p>NOMINA Y ADMINISTRATIVOS</p>
											</td>
											<td>
												<table width = '100%'>
													<tr>
														<td align = 'left'>$</td>
														<td align = 'right'>".number_format(260095787)."</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class = 'titulos' nowrap>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>EJECUTADO PTE POR FACTURAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class = 'titulos' nowrap>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>APROBADO SIN EJECUTAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class = 'titulos' nowrap>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>TOTAL CARTERA</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(1641596975)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr>
					<td class = 'titulos' nowrap>
						<p>CUENTA DE AHORROS</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>PROVISION LIQUIDACIONES A OCTUBRE 30</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(56043600)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>PROVISION INDEMNIZACION A OCTUBRE 30</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(38699370)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td class = 'titulos' nowrap>
						<p>LIQUIDACIONES E INDEMNIZACIONES</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>PROVISION LIQUIDACIONES A DICIEMBRE 30</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(157149226)."</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width = '50%'>
									<p>PROVISION INDEMNIZACION A DICIEMBRE 30</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(429355195)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>TOTAL PORVISION CUENTA DE AHORROS</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(94742970)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'resultados'>
							<tr>
								<td width = '50%'>
									<p>TOTAL LIQUIDACIONES E INDEPNIZACIONES</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(586504421)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>CUENTAS POR COBRAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(1984621940)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>CUENTAS POR PAGAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(3461599542)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>DISPONIBLE</p>
								</td>
								<td CLASS = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(-1476977602)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>NECESIDAD MENSUAL</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(281908735)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>DISPONIBLE SIN FACTURAR</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(0)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>FEE MENSUAL</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(170310279)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>DISPONIBLE REAL FACTURADO</p>
								</td>
								<td class = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(-1476977602)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>NECESIDAD MENSUAL</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(111598456)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					
				</tr>
				<tr><td></td></tr>
				<tr>
					
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>NOVIEMBRE</p>
								</td>
								<td class = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(-340620558)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td class = 'titulos' nowrap>
						<p>RETENCIONES A FAVOR 2015</p>						
					</td>
					<td class = 'contenedor_items'>
						<table width = '100%'>
							<tr>
								<td width = '50%'>
									<p>RETENCIONES A FAVOR 2015</p>
								</td>
								<td>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(400000000)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>DICIEMBRE</p>
								</td>
								<td class = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(-510930837)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>ENERO</p>
								</td>
								<td class = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(-681241116)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>FEBRERO</p>
								</td>
								<td class = 'alerta'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(-851551394)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td class= 'separator' width = '2%'></td>
					<td>
										
					</td>
					<td>
						<table width = '100%' class = 'titulos'>
							<tr>
								<td width = '50%'>
									<p>VOLUMEN</p>
								</td>
								<td >
									<table width = '100%'>
										<tr>
											<td align = 'left'>$</td>
											<td align = 'right'>".number_format(-317071663)."</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>";
			return $est;
		}
		
		public function cuentas_por_cobrar($und){
			$est ="<table width ='100%' style = 'padding-left:50px;padding-right:50px;'>
				<tr>
					<th colspan = '22' class = 'titulos2'>CUENTAS POR PAGAR</th>
				</tr>
				<tr>
					<th class = 'subtitulos_columnas' nowrap>FECHA DE RADICACION</th>
					<th class = 'subtitulos_columnas' nowrap>DIAS</th>
					<th class = 'subtitulos_columnas' nowrap>FECHA VENCIMIENTO</th>
					<th class = 'subtitulos_columnas' nowrap>FECHA DE EVENTO</th>
					<th class = 'subtitulos_columnas' nowrap>No. OC</th>
					<th class = 'subtitulos_columnas' nowrap>No. FACTURA</th>
					<th class = 'subtitulos_columnas' nowrap>No. PPTO</th>
					<th class = 'subtitulos_columnas' nowrap>PROVEEDOR</th><th></th>
					<th class = 'subtitulos_columnas' nowrap>CONCEPTO</th>
					<th class = 'subtitulos_columnas' nowrap>VALOR</th>
					<th class = 'subtitulos_columnas' nowrap>TOTAL</th>
				</tr>
			</table>";
			$sql = mysql_query("select * from temp_proveedores where und = '$und'");
			while($row= mysql_fetch_array($sql)){
					$i++;
					$est.="
						<tr>
							<td style = 'border:0px solid black;'>$i</td>
							<td align = 'center'>".$row['radicacion']."</td>
							<td align = 'center'>".$row['dias']."</td>
							<td align = 'center'>".$row['vencimiento']."</td>
							<td align = 'center'></td>
							<td align = 'center'>".$row['oc']."</td>
							<td align = 'center'>".$row['factura']."</td>
							<td align = 'center'>".$row['ppto']."</td>
							<td align = 'center'>".$row['proveedor']."</td>
							<td align = 'center'></td>
							<td>
								<table  class = 'sin_nada' width = '100%' >
									<tr>
										<td width = '2%' align = 'left' style = 'border:0px solid white;'>$</td>
										<td align = 'right' style = 'border:0px solid white;'>".number_format($row['valor'])."</td>
									</tr>
								</table>
							</td>
						</tr>
					";
			}
			return $est."</table>";
		}
		
		public function cartera_general($und){
			/*
				<th class = 'subtitulos_columnas' nowrap>VALOR A RECIBIR X CLIENTE</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' nowrap>INTERESES Y COSTOS FINANCIERTOS</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' nowrap>TOTAL A RECIBIR CARTERA</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' nowrap>TOTAL RECIBIDO</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' nowrap>TOTAL SALDO POR COBRAR</th>
					<th class = 'separator'></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' nowrap>TOTAL PAGADO PROVEEDORES</th>
					<th class = 'separator'></th>
					<th class = 'separator'></th>
					<TH class = 'subtitulos_columnas' nowrap>FLUJO</TH>
			*/
			$est = "<table width = '100%' style = 'padding-left:50px;padding-right:50px;' class = 'cartera'>
				";
			$cl = mysql_query("select distinct c.codigo_interno_cliente, c.nombre_comercial_cliente 
			from clientes c, temp_clientes t
			where t.und = '$und'and t.cliente = c.codigo_interno_cliente");
			$sum = 0;
			while($x = mysql_fetch_array($cl)){
				
				$est.="<tr>
					<th></th>
					<th colspan = '13' class = 'subtitulos_columnas'>".$x['nombre_comercial_cliente']."</th>
				</tr>
				<tr>
					<th ></th>
					<th class = 'subtitulos_columnas' nowrap>FECHA RADICACION</th>
					<th class = 'subtitulos_columnas' nowrap>DIAS</th>
					<th class = 'subtitulos_columnas' nowrap>FECHA VENCIMIENTO</th>
					<th class = 'subtitulos_columnas' nowrap>PPTO</th>
					<th class = 'subtitulos_columnas' nowrap>FACTURA</th>
					<th class = 'subtitulos_columnas' nowrap>FECHA DE EVENTO</th>
					<th class = 'subtitulos_columnas' nowrap>CLIENTE</th>
					<th class = 'subtitulos_columnas' nowrap>EVENTO</th>
					<th class = 'subtitulos_columnas' nowrap>VALOR</th>
					<th class = 'subtitulos_columnas' nowrap>IVA</th>
					<th class = 'subtitulos_columnas' nowrap>VALOR TOTAL FACTURA</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' nowrap style = 'background-color:red;'>TOTAL SALDO POR COBRAR</th>
					
				</tr>
				";
				$sql = mysql_query("select t.cliente,t.und,t.ppto,t.radicacion,t.dias,t.vencimiento,t.factura,t.name,t.iva,t.valor,t.saldo,c.nombre_comercial_cliente
				from temp_clientes t, clientes c where t.und = '$und' and t.cliente = '".$x['codigo_interno_cliente']."'and t.cliente = c.codigo_interno_cliente");
				$i=0;
				while($row = mysql_fetch_array($sql)){
					$sum+=$row['saldo'];
					$i++;
					$est.="
						<tr>
							<td style = 'border:0px solid black;'>$i</td>
							<td align = 'center'>".$row['radicacion']."</td>
							<td align = 'center'>".$row['dias']."</td>
							<td align = 'center'>".$row['vencimiento']."</td>
							<td align = 'center'>".$row['ppto']."</td>
							<td align = 'center'>".$row['factura']."</td>
							<td></td>
							<td nowrap>".$row['nombre_comercial_cliente']."</td>
							<td nowrap>".$row['name']."</td>
							<td>
								<table  class = 'sin_nada' width = '100%' >
									<tr>
										<td width = '2%' align = 'left' style = 'border:0px solid white;'>$</td>
										<td align = 'right' style = 'border:0px solid white;'>".number_format($row['valor'])."</td>
									</tr>
								</table>
							</td>
							<td>
								<table width = '100%' class = 'sin_nada'>
									<tr>
										<td width = '2%' align = 'left' style = 'border:0px solid white;'>$</td>
										<td align = 'right' style = 'border:0px solid white;'>".number_format($row['iva'])."</td>
									</tr>
								</table>
							</td>
							<td>
								<table width = '100%' class = 'sin_nada'>
									<tr>
										<td width = '2%' align = 'left' style = 'border:0px solid white;'>$</td>
										<td align = 'right' style = 'border:0px solid white;'>".number_format($row['iva'] + $row['valor'])."</td>
									</tr>
								</table>
							</td>
							<td style = 'border:0px solid white;'></td>
							<td>
								<table width = '100%' class = 'sin_nada'>
									<tr>
										<td width = '2%' align = 'left' style = 'border:0px solid white;'>$</td>
										<td align = 'right' style = 'border:0px solid white;'>".number_format($row['saldo'])."</td>
									</tr>
								</table>
							</td>
						</tr>
					";
				}
				
				
				$sql = mysql_query("select * from cabpresup where factura_fact != ''");
				$i=0;
				while($row = mysql_fetch_array($sql)){
					$sum+=$row['valor'];
					$i++;
					$est.="
						<tr>
							<td style = 'border:0px solid black;'>$i</td>
							<td align = 'center'>".$row['fecha_r_facturacion']."</td>
							<td align = 'center'></td>
							<td align = 'center'></td>
							<td align = 'center'>".$row['codigo_presup']."</td>
							<td align = 'center'>".$row['factura_fact']."</td>
							<td></td>
							<td nowrap></td>
							<td nowrap></td>
							<td>
								<table  class = 'sin_nada' width = '100%' >
									<tr>
										<td width = '2%' align = 'left' style = 'border:0px solid white;'>$</td>
										<td align = 'right' style = 'border:0px solid white;'>".number_format($row['valor'])."</td>
									</tr>
								</table>
							</td>
							<td>
								<table width = '100%' class = 'sin_nada'>
									<tr>
										<td width = '2%' align = 'left' style = 'border:0px solid white;'>$</td>
										<td align = 'right' style = 'border:0px solid white;'>".number_format(($row['valor']*16)/100)."</td>
									</tr>
								</table>
							</td>
							<td>
								<table width = '100%' class = 'sin_nada'>
									<tr>
										<td width = '2%' align = 'left' style = 'border:0px solid white;'>$</td>
										<td align = 'right' style = 'border:0px solid white;'>".number_format((($row['valor']*16)/100)+$row['valor'])."</td>
									</tr>
								</table>
							</td>
							<td style = 'border:0px solid white;'></td>
							<td>
								<table width = '100%' class = 'sin_nada'>
									<tr>
										<td width = '2%' align = 'left' style = 'border:0px solid white;'>$</td>
										<td align = 'right' style = 'border:0px solid white;'>".number_format($row['valor'])."</td>
									</tr>
								</table>
							</td>
						</tr>
					";
				}
				
				
				$est.="<tr>
					<th></th>
					<th colspan = '12'></th>
					<th class = 'subtitulos_columnas' nowrap style = 'background-color:red;'>
						<table width = '100%' class = 'sin_nada'>
							<tr>
								<td width = '2%' align = 'left' style = 'border:0px solid white;'>$</td>
								<td align = 'right' style = 'border:0px solid white;'>".number_format($sum)."</td>
							</tr>
						</table>
					</th>
				</tr>
				<tr>
					<th></th>
				</tr>";
			}
			return $est."</table>";
		}
	
		public function ppto_vs_ejecutado($und,$empresa){
			$est = "<table width = '100%'>
				<tr>
					<th>".date("Y")."</th>
				</tr>
				<tr>
					<th></th>
					<th class = 'separator'></th>
					<th></th>
					<th class = 'separator'></th>
					<th colspan = '6'>ENERO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>FEBRERO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>MARZO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>ABRIL</th>
					<th class = 'separator'></th>
					<th colspan = '6'>MAYO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>JUNIO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>JULIO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>AGOSTO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>SEPTIEMBRE</th>
					<th class = 'separator'></th>
					<th colspan = '6'>OCTUBRE</th>
					<th class = 'separator'></th>
					<th colspan = '6'>NOVIEMBRE</th>
					<th class = 'separator'></th>
					<th colspan = '6'>DICIEMBRE</th>
					<th class = 'separator'></th>
					<th colspan = '6'>TOTAL</th>
					<th class = 'separator'></th>
				</tr>
				<tr>
					<th class = 'subtitulos_columnas'>FACTURADO BTL ".date("Y")."</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas'>PAGO A</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas'>Presupuesto</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Ejecutado</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Pendiente por Ejecutar</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas'>Presupuesto</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Ejecutado</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Pendiente por Ejecutar</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas'>Presupuesto</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Ejecutado</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Pendiente por Ejecutar</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas'>Presupuesto</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Ejecutado</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Pendiente por Ejecutar</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas'>Presupuesto</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Ejecutado</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Pendiente por Ejecutar</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas'>Presupuesto</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Ejecutado</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Pendiente por Ejecutar</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas'>Presupuesto</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Ejecutado</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Pendiente por Ejecutar</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas'>Presupuesto</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Ejecutado</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Pendiente por Ejecutar</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas'>Presupuesto</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Ejecutado</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Pendiente por Ejecutar</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas'>Presupuesto</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Ejecutado</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Pendiente por Ejecutar</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas'>Presupuesto</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Ejecutado</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Pendiente por Ejecutar</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas'>Presupuesto</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Ejecutado</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Pendiente por Ejecutar</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas'>Presupuesto</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Ejecutado</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'subtitulos_columnas'>Pendiente por Ejecutar</th>
					<th class = 'subtitulos_columnas'>%</th>
					<th class = 'separator'></th>
				</tr>
				
				<tr>
					<td class = 'oscuro_ppto_general' nowrap>PRESUPUESTADO VS EJECUTADO</td>
					<td class = 'separator'></td>
					<td class = ''></td>
					<td class = 'separator'></td>";
			$sql_bp = mysql_query("select sum(m.pptado) as valor, m.mes
			from mensual_bp m, bp_und b where
			b.und = '$und' and b.year = '".date("Y")."' and b.id = m.pk_bp group by m.mes");
			while($row = mysql_fetch_array($sql_bp)){
				$me = $row['mes'];
				$sql = mysql_query("select valor,fecha_factura,factura_fact from cabpresup where factura_fact != '' and ceco = '$und' and month(fecha_factura) = '$me'");
				$acum = 0;
				while($cl = mysql_fetch_array($sql)){
					$acum +=$cl['valor'];
				}
				$class = "";
				$por = 0;
				$eje_pen_fact = $row['valor'] - $acum;
				
				if($row['valor'] > $acum){
					$class = "alerta_negativa";
				}else{
					$class = "alerta_positiva";
				}
				
				$porcentaje_per_gan = 0;
				if($acum == 0){
					$porcentaje_per_gan = 100;
					
				}else{
					$porcentaje_per_gan = ($eje_pen_fact*100)/$row['valor'];
				}
				
				$temp = ($acum*100)/$row['valor'];
				
				$est.="<td class = 'oscuro_ppto_general'>
						<table width = '100%'>
							<tr>
								<td align = 'left'>$</td>
								<td align = 'right'>".number_format($row['valor'])."</td>
							</tr>
						</table>
					</td>
					<td class = 'oscuro_ppto_general'>
						<table width = '100%'>
							<tr>
								
								<td align = 'left'>100</td>
								<td align = 'right'>%</td>
							</tr>
						</table>
					</td>
					<td class = '$class'>
						<table width = '100%'>
							<tr>
								<td align = 'left'>$</td>
								<td align = 'right'>".number_format($acum)."</td>
							</tr>
						</table>
					</td>
					<td class = '$class'>
						<table width = '100%'>
							<tr>
								
								<td align = 'left'>".number_format($temp,2,'.',',')."</td>
								<td align = 'right'>%</td>
							</tr>
						</table>
					</td>
					<td class = 'oscuro_ppto_general'>
						<table width = '100%'>
							<tr>
								<td align = 'left'>$</td>
								<td align = 'right'>".number_format($eje_pen_fact)."</td>
							</tr>
						</table>
					</td>
					<td class = '$class'>
						<table width = '100%'>
							<tr>
								<td align = 'left'>".number_format($porcentaje_per_gan,2,'.',',')."</td>
								<td align = 'right'>%</td>
							</tr>
						</table>
					</td>
					<td class = 'separator'></td>";
			}
			
			$est.="</tr><tr><td></br></td></tr>";
			
			
			
			$sql_clientes_bp = mysql_query("select distinct c.nombre_comercial_cliente,c.codigo_interno_cliente
			from clientes c, mensual_bp m, bp_und b
			where b.und = '$und' and b.year = '".date("Y")."' and b.id = m.pk_bp and m.cliente = c.codigo_interno_cliente order by c.nombre_comercial_cliente asc");
			while($clie = mysql_fetch_array($sql_clientes_bp)){
				$est.="<tr>
					<td class = 'oscuro_ppto_general' nowrap>".$clie['nombre_comercial_cliente']."</td>
					<td class = 'separator'></td>
					<td class = ''></td>
					<td class = 'separator'></td>";
				
				$cliex = $clie['codigo_interno_cliente'];
				
				$sql_bp = mysql_query("select m.pptado as valor, m.mes, c.nombre_comercial_cliente,c.codigo_interno_cliente
				from mensual_bp m, bp_und b, clientes c
				where
				b.und = '$und' and b.year = '".date("Y")."' and b.id = m.pk_bp and m.cliente = c.codigo_interno_cliente  and c.codigo_interno_cliente = '$cliex'");
				$acum_ppto = 0;
				$acum_eje = 0;
				$por_acum = 0;
				while($row = mysql_fetch_array($sql_bp)){
					$me = $row['mes'];
					
					$sql = mysql_query("select p.valor,p.fecha_factura,p.factura_fact, c.nombre_comercial_cliente
					from cabpresup p, clientes c
					where p.factura_fact != '' and p.ceco = '$und' and month(p.fecha_factura) = '$me' and c.codigo_interno_cliente = p.pk_clientes_nit_cliente and c.codigo_interno_cliente = '$cliex'");
					$acum = 0;
					$temp = 0;
					$temp2 = 0;
					$acum_ppto+=$row['valor'];
					while($cl = mysql_fetch_array($sql)){
						$acum +=$cl['valor'];
						$acum_eje += $cl['valor'];
					}
					if($row['valor'] == 0){
						$temp = 0;
					}else{
						$temp2 = (($acum - $row['valor'])*100) / $row['valor'];
						$temp = ($acum*100)/$row['valor'];
					}
					
					
					
					$class = "";
					$valor = 0;
					$fact = 0;
					$est.="<td  class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>$</td>
									<td align = 'right'>".number_format($row['valor'])."</td>
								</tr>
							</table>
						</td>
						<td class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									
									<td align = 'left'>100</td>
									<td align = 'right'>%</td>
								</tr>
							</table>
						</td>
						<td  class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>$</td>
									<td align = 'right'>".number_format($acum)."</td>
								</tr>
							</table>
						</td>
						<td class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									
									<td align = 'left'>".number_format($temp,2,'.',',')."</td>
									<td align = 'right'>%</td>
								</tr>
							</table>
						</td>
						<td  class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>$</td>
									<td align = 'right'>".number_format($row['valor'] - $acum)."</td>
								</tr>
							</table>
						</td>
						<td class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									
									<td align = 'left'>".number_format($temp2,2,'.',',')."</td>
									<td align = 'right'>%</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>";
				}
				if($acum_ppto == 0 || $acum_eje == 0){
					$por_acum = 0;
				}else{
					$por_acum = ($acum_eje*100)/$acum_ppto;
				}
				$est.="<td class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>$</td>
									<td align = 'right'>".number_format($acum_ppto)."</td>
								</tr>
							</table>
						</td>
						<td class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									
									<td align = 'left'>100</td>
									<td align = 'right'>%</td>
								</tr>
							</table>
						</td>
						<td class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>$</td>
									<td align = 'right'>".number_format($acum_eje)."</td>
								</tr>
							</table>
						</td>
						<td class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									
									<td align = 'left'>".number_format($por_acum,2,'.',',')."</td>
									<td align = 'right'>%</td>
								</tr>
							</table>
						</td>
						<td class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>$</td>
									<td align = 'right'>".number_format($acum_ppto - $acum_eje)."</td>
								</tr>
							</table>
						</td>
						<td class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									
									<td align = 'left'>".number_format($por_acum,2,'.',',')."</td>
									<td align = 'right'>%</td>
								</tr>
							</table>
						</td>
						<td class = 'separator'></td>";
				$est.="</tr>";
				
			}
			
			$est.="<tr><td></br></td></tr><tr>
					<th></th>
					<th class = 'separator'></th>
					<th></th>
					<th class = 'separator'></th>
					<th colspan = '6'>ENERO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>FEBRERO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>MARZO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>ABRIL</th>
					<th class = 'separator'></th>
					<th colspan = '6'>MAYO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>JUNIO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>JULIO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>AGOSTO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>SEPTIEMBRE</th>
					<th class = 'separator'></th>
					<th colspan = '6'>OCTUBRE</th>
					<th class = 'separator'></th>
					<th colspan = '6'>NOVIEMBRE</th>
					<th class = 'separator'></th>
					<th colspan = '6'>DICIEMBRE</th>
					<th class = 'separator'></th>
					<th colspan = '6'>TOTAL</th>
					<th class = 'separator'></th>
				</tr>
				<tr>
					<th class = 'subtitulos_columnas'>IMPUESTO CREE</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					
				</tr>";
			$sql_clientes_bp = mysql_query("select distinct c.nombre_comercial_cliente,c.codigo_interno_cliente
			from clientes c, mensual_bp m, bp_und b
			where b.und = '$und' and b.year = '".date("Y")."' and b.id = m.pk_bp and m.cliente = c.codigo_interno_cliente order by c.nombre_comercial_cliente asc");
			$sql_cree = mysql_query("select  d.valor 
			from documentos_legales_entidades d
			where  d.pk_tdocumento = '11' and d.pk_empresa = '$empresa'");
			$valor_cree = 0;
			
			while($row = mysql_fetch_array($sql_cree)){
				$valor_cree = $row['valor'];
			}
			
			while($clie = mysql_fetch_array($sql_clientes_bp)){
				$est.="<tr>
					<td class = 'oscuro_ppto_general' nowrap>".$clie['nombre_comercial_cliente']."</td>
					<td class = 'separator'></td>
					<td class = '' align = 'center'>$valor_cree %</td>
					<td class = 'separator'></td>";
				
				$cliex = $clie['codigo_interno_cliente'];
				
				$sql_bp = mysql_query("select m.pptado as valor, m.mes, c.nombre_comercial_cliente,c.codigo_interno_cliente
				from mensual_bp m, bp_und b, clientes c
				where
				b.und = '$und' and b.year = '".date("Y")."' and b.id = m.pk_bp and m.cliente = c.codigo_interno_cliente  and c.codigo_interno_cliente = '$cliex'");
				$acum_ppto = 0;
				$acum_eje = 0;
				$por_acum = 0;
				$xx = 0;
				$cree_acum_pptado = 0;
				while($row = mysql_fetch_array($sql_bp)){
					$me = $row['mes'];
					
					$sql = mysql_query("select p.valor,p.fecha_factura,p.factura_fact, c.nombre_comercial_cliente
					from cabpresup p, clientes c
					where p.factura_fact != '' and p.ceco = '$und' and month(p.fecha_factura) = '$me' and c.codigo_interno_cliente = p.pk_clientes_nit_cliente and c.codigo_interno_cliente = '$cliex'");
					$acum = 0;
					$temp = 0;
					$temp2 = 0;
					$acum_ppto+=$row['valor'];
					while($cl = mysql_fetch_array($sql)){
						$acum +=$cl['valor'];
						$acum_eje += $cl['valor'];
					}
					if($row['valor'] == 0){
						$temp = 0;
					}else{
						$temp2 = (($acum - $row['valor'])*100) / $row['valor'];
						$temp = ($acum*100)/$row['valor'];
					}
					
					
					
					
					$class = "";
					$valor = 0;
					$fact = 0;
					$est.="<td  class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>$</td>
									<td align = 'right'>".number_format(($row['valor']*$valor_cree)/100)."</td>
								</tr>
							</table>
						</td>
						<td class = 'oscuro_ppto_general'>
							
						</td>
						<td  class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>$</td>
									<td align = 'right'>".number_format( ($acum*$valor_cree)/100 )."</td>
								</tr>
							</table>
						</td>
						<td class = 'oscuro_ppto_general'>
							
						</td>
						<td  class = 'oscuro_ppto_general'>
							
						</td>
						<td class = 'oscuro_ppto_general'>
							
						</td>
						<td class = 'separator'></td>";
				}
			}
			$est.="</tr>";
			$est.="<tr>
					<td class = 'oscuro_ppto_general' nowrap>TOTAL</td>
					<td class = 'separator'></td>
					<td class = '' align = 'center'></td>
					<td class = 'separator'></td>";
			$aux_sum_ppto = 0;
			$aux_sum_eje = 0;
			for($i = 0; $i < 12;$i++){
				
				$est.="<td  class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>$</td>
									<td align = 'right'>".number_format(0)."</td>
								</tr>
							</table>
						</td>
						<td class = 'oscuro_ppto_general'>
							
						</td>
						<td  class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>$</td>
									<td align = 'right'>".number_format(0 )."</td>
								</tr>
							</table>
						</td>
						<td class = 'oscuro_ppto_general'>
							
						</td>
						<td  class = 'oscuro_ppto_general'>
							
						</td>
						<td class = 'oscuro_ppto_general'>
							
						</td>
						<td class = 'separator'></td>";
			}
			$est.="</tr>";
			
			
			//ICA
			
			$est.="<tr><td></br></td></tr><tr>
					<th></th>
					<th class = 'separator'></th>
					<th></th>
					<th class = 'separator'></th>
					<th colspan = '6'>ENERO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>FEBRERO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>MARZO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>ABRIL</th>
					<th class = 'separator'></th>
					<th colspan = '6'>MAYO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>JUNIO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>JULIO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>AGOSTO</th>
					<th class = 'separator'></th>
					<th colspan = '6'>SEPTIEMBRE</th>
					<th class = 'separator'></th>
					<th colspan = '6'>OCTUBRE</th>
					<th class = 'separator'></th>
					<th colspan = '6'>NOVIEMBRE</th>
					<th class = 'separator'></th>
					<th colspan = '6'>DICIEMBRE</th>
					<th class = 'separator'></th>
					<th colspan = '6'>TOTAL</th>
					<th class = 'separator'></th>
				</tr>
				<tr>
					<th class = 'subtitulos_columnas'>IMPUESTO ICA</th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Presupuesto</th>
					<th class = 'subtitulos_columnas'></th>
					<th class = 'subtitulos_columnas' colspan = '2'>Ejecutado</th>
					<th class = 'subtitulos_columnas' ></th>
					<th class = 'separator'></th>
					
				</tr>";
			$sql_clientes_bp = mysql_query("select distinct c.nombre_comercial_cliente,c.codigo_interno_cliente
			from clientes c, mensual_bp m, bp_und b
			where b.und = '$und' and b.year = '".date("Y")."' and b.id = m.pk_bp and m.cliente = c.codigo_interno_cliente order by c.nombre_comercial_cliente asc");
			$sql_cree = mysql_query("select  d.valor 
			from documentos_legales_entidades d
			where  d.pk_tdocumento = '14' and d.pk_empresa = '$empresa'");
			$valor_cree = 0;
			
			while($row = mysql_fetch_array($sql_cree)){
				$valor_cree = $row['valor'];
			}
			
			while($clie = mysql_fetch_array($sql_clientes_bp)){
				$est.="<tr>
					<td class = 'oscuro_ppto_general' nowrap>".$clie['nombre_comercial_cliente']."</td>
					<td class = 'separator'></td>
					<td class = '' align = 'center'>$valor_cree %</td>
					<td class = 'separator'></td>";
				
				$cliex = $clie['codigo_interno_cliente'];
				
				$sql_bp = mysql_query("select m.pptado as valor, m.mes, c.nombre_comercial_cliente,c.codigo_interno_cliente
				from mensual_bp m, bp_und b, clientes c
				where
				b.und = '$und' and b.year = '".date("Y")."' and b.id = m.pk_bp and m.cliente = c.codigo_interno_cliente  and c.codigo_interno_cliente = '$cliex'");
				$acum_ppto = 0;
				$acum_eje = 0;
				$por_acum = 0;
				$xx = 0;
				$cree_acum_pptado = 0;
				while($row = mysql_fetch_array($sql_bp)){
					$me = $row['mes'];
					
					$sql = mysql_query("select p.valor,p.fecha_factura,p.factura_fact, c.nombre_comercial_cliente
					from cabpresup p, clientes c
					where p.factura_fact != '' and p.ceco = '$und' and month(p.fecha_factura) = '$me' and c.codigo_interno_cliente = p.pk_clientes_nit_cliente and c.codigo_interno_cliente = '$cliex'");
					$acum = 0;
					$temp = 0;
					$temp2 = 0;
					$acum_ppto+=$row['valor'];
					while($cl = mysql_fetch_array($sql)){
						$acum +=$cl['valor'];
						$acum_eje += $cl['valor'];
					}
					if($row['valor'] == 0){
						$temp = 0;
					}else{
						$temp2 = (($acum - $row['valor'])*100) / $row['valor'];
						$temp = ($acum*100)/$row['valor'];
					}
					
					
					
					
					$class = "";
					$valor = 0;
					$fact = 0;
					$est.="<td  class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>$</td>
									<td align = 'right'>".number_format(($row['valor']*$valor_cree)/1000)."</td>
								</tr>
							</table>
						</td>
						<td class = 'oscuro_ppto_general'>
							
						</td>
						<td  class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>$</td>
									<td align = 'right'>".number_format( ($acum*$valor_cree)/1000 )."</td>
								</tr>
							</table>
						</td>
						<td class = 'oscuro_ppto_general'>
							
						</td>
						<td  class = 'oscuro_ppto_general'>
							
						</td>
						<td class = 'oscuro_ppto_general'>
							
						</td>
						<td class = 'separator'></td>";
				}
			}
			$est.="</tr>";
			$est.="<tr>
					<td class = 'oscuro_ppto_general' nowrap>TOTAL</td>
					<td class = 'separator'></td>
					<td class = '' align = 'center'></td>
					<td class = 'separator'></td>";
			$aux_sum_ppto = 0;
			$aux_sum_eje = 0;
			for($i = 0; $i < 12;$i++){
				
				$est.="<td  class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>$</td>
									<td align = 'right'>".number_format(0)."</td>
								</tr>
							</table>
						</td>
						<td class = 'oscuro_ppto_general'>
							
						</td>
						<td  class = 'oscuro_ppto_general'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>$</td>
									<td align = 'right'>".number_format(0 )."</td>
								</tr>
							</table>
						</td>
						<td class = 'oscuro_ppto_general'>
							
						</td>
						<td  class = 'oscuro_ppto_general'>
							
						</td>
						<td class = 'oscuro_ppto_general'>
							
						</td>
						<td class = 'separator'></td>";
			}
			$est.="</tr>";
			$est.="</table>";
			
			return $est;
		}
	}
	
?>