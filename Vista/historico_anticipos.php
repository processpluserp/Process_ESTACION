<?php
	include("../Controller/Conexion.php");
	include_once("../Modelo/gestion_cabecera.php");
	include_once("../Modelo/Empresa.php");
	session_start();
	
	$gestion = new cabecera_pagina();
	
	$emp = new Empresa();
	
	//Variables Básicas para ejecutar este Script.
	$turno = $_POST['turno'];
	$ppto = $_POST['ppto'];
	$vi = $_POST['vi'];
	$vc = $_POST['vc'];
	
	
	$estructura = "";
	$esx = "";
	if($turno == 1){
		
		$item = $_POST['item'];
		//ARMO EL SQL QUE ME TRAE TODA LA INFORMACIÓN DE LOS ANTICIPOS
		$sql_anticipos_ppto = mysql_query("select antppto.id,antppto.user,antppto.fecha_plata,antppto.fecha_legalizacion,antppto.fecha,e.nombre_empleado
		from anticipos_ppto antppto, cuerpo_anticipo cp, usuario u, empleado e
		where antppto.ppto = '$ppto' and antppto.vi = '$vi' and antppto.vc = '$vc' and antppto.id = cp.pk_anticipo and cp.pk_item = '$item'
		and antppto.user = u.idusuario and u.pk_empleado = e.documento_empleado");
		
		$esx = "";
		$list_anticipos = "";
		$list_estados = "
			<option value = '1'>APROBADO</option>
			<option value = '0'>NO APROBADO</option>
			<option value = '10'>EN APROBACIÓN</option>
		";
		while($row = mysql_fetch_array($sql_anticipos_ppto)){
			$id = $row['id'];
			$list_anticipos .= "<option value = '$id'>$id</option>";
			$esx .="
				<tr>
					<td align = 'center'>".($row['id'])."</td>
					<td style = 'padding-left:10px;text-align:left;' >".utf8_decode($row['nombre_empleado'])."</td>
					<td align = 'center'>".($row['fecha'])."</td>
					<td align = 'center'>".($row['fecha_plata'])."</td>
					<td align = 'center'>".($row['fecha_legalizacion'])."</td>";
			$sql_estatus = mysql_query("select e.nombre_empleado,estant.fecha_estado,estant.estado,estant.observaciones
			from estatus_anticipos estant, usuario u, empleado e
			where estant.pk_anticipo = '$id' and estant.useraprobado = u.idusuario and u.pk_empleado = e.documento_empleado");
			
			if(mysql_num_rows($sql_estatus) == 0){
				
				$esx .= "<td style = 'padding-left:10px;text-align:left;' >EN APROBACIÓN</td>
						<td></td>
						<td></td>
						<td>
								<a target = '_blank' href = 'pdf_anticipo.php?id=".$row['id']."'>
									<img src = '../images/iconos/icono_descarga.png' width = '45px'/>
								</a>
							</td>";
			}else{
				while($rox = mysql_fetch_array($sql_estatus)){
					$estado = "";
					if($rox['estado'] == 1){
						$estado = "APROBADO";
					}else{
						$estado = "NO APROBADO";
					}
					$esx .="<td style = 'padding-left:10px;text-align:left;'>$estado</td>
							<td align = 'center'>".($rox['fecha_estado'])."</td>
							<td style = 'padding-left:10px;text-align:left;'>".nl2br($rox['observaciones'])."</td>
							<td>
								<a target = '_blank' href = 'pdf_anticipo.php?id=".$row['id']."'>
									<img src = '../images/iconos/icono_descarga.png' width = '45px'/>
								</a>
							</td>";
				}
			}
			$esx.="</tr>";
		}
		$estructura = "<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
							<tr>
								<td width = '96%' align = 'left'>
									<table width = '100%'>
										<tr>
											<td align = 'left'>
												".$emp->mostrar_logo_empresa($gestion->mostrar_empresa_empleado())."
											</td>
										</tr>
										<tr>
											<td align = 'left' >
												<span class = 'mensaje_bienvenida' >HISTÓRICO ANTICIPOS POR ITEM</span>
											</td>
										</tr>
									</table>
								</td>
								<td align = 'right' >
									<table width = '100%'>
										<tr>
											<td align = 'center'>
												<img onclick = 'cerrar_ventana_limpiar();' src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano'/>
											</td>
										</tr>
									</table>
								</td>
							</tr>
					</table>
					<table style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td>
								<select id = 'filtro_anticipos' onchange = 'evento_filtro_anticipo()'>
									<option value = 'NUMANT'>NUMERO ANTICIPO</option>
									<option value = 'ESTANT'>ESTADO</option>
								</select>
							</td>
							<td style = 'padding-left:10px;'>
								<input type = 'number' id = 'filtro_list_anticipos' class = 'entradas_bordes' width = '100px'/>
								<select id = 'filtro_list_estados' class = 'entradas_bordes hidde'>$list_estados</select>
							</td>
							<td>
								<img src = '../images/iconos/lupa_naranja.png' width = '45px' onclick = 'buscar_anticipo()' />
							</td>
							<td style = 'padding-left:10px;' nowrap>
								<span class = 'botton_verde' onclick = 'historico_anticipos_completo()'>Ver todo</span>
							</td>
						</tr>
					</table>
					<div class = 'contenedor_listado_anticipos_ppto'>
						<table width = '100%' class = 'tablas_muestra_datos_tablas_trafico list_anticipos_table' style = 'padding-left:50px;padding-right:50px;'>
									<tr>
										<th nowrap># ANTICIPO</th>
										<th nowrap>SOLICITADO POR</th>
										<th nowrap>FECHA SOL.</th>
										<th nowrap>FECHA REQUERIDO</th>
										<th nowrap>FECHA MAX LEGALIZACIÓN</th>
										<th nowrap>ESTADO</th>
										<th nowrap>FECHA APROBACIÓN</th>
										<th nowrap >OBSERVACIONES</th>
										<th nowrap ></th>
									</tr>";
	}else if($turno == 2){
		
		//ARMO EL SQL QUE ME TRAE TODA LA INFORMACIÓN DE LOS ANTICIPOS
		$sql_anticipos_ppto = mysql_query("select antppto.id,antppto.user,antppto.fecha_plata,antppto.fecha_legalizacion,antppto.fecha,e.nombre_empleado
		from anticipos_ppto antppto, usuario u, empleado e
		where antppto.ppto = '$ppto' and antppto.vi = '$vi' and antppto.vc = '$vc' 
		and antppto.user = u.idusuario and u.pk_empleado = e.documento_empleado");
		
		$esx = "";
		$list_anticipos = "";
		$list_estados = "
			<option value = '1'>APROBADO</option>
			<option value = '0'>NO APROBADO</option>
			<option value = '10'>EN APROBACIÓN</option>
		";
		while($row = mysql_fetch_array($sql_anticipos_ppto)){
			$id = $row['id'];
			
			
			$esx .="
				<tr>
					<td align = 'center'>".($row['id'])."</td>
					<td style = 'padding-left:10px;text-align:left;' >".utf8_decode($row['nombre_empleado'])."</td>
					<td align = 'center'>".($row['fecha'])."</td>
					<td align = 'center'>".($row['fecha_plata'])."</td>
					<td align = 'center'>".($row['fecha_legalizacion'])."</td>";
			$sql_estatus = mysql_query("select e.nombre_empleado,estant.fecha_estado,estant.estado,estant.observaciones
			from estatus_anticipos estant, usuario u, empleado e
			where estant.pk_anticipo = '$id' and estant.useraprobado = u.idusuario and u.pk_empleado = e.documento_empleado");
			
			if(mysql_num_rows($sql_estatus) == 0){
				
				$esx .= "<td style = 'padding-left:10px;text-align:left;' >EN APROBACIÓN</td>
						<td></td>
						<td></td>
						<td>
								<a target = '_blank' href = 'pdf_anticipo.php?id=".$row['id']."'>
									<img src = '../images/iconos/icono_descarga.png' width = '45px'/>
								</a>
							</td>";
			}else{
				while($rox = mysql_fetch_array($sql_estatus)){
					$estado = "";
					if($rox['estado'] == 1){
						$estado = "APROBADO";
					}else{
						$estado = "NO APROBADO";
					}
					$esx .="<td style = 'padding-left:10px;text-align:left;'>$estado</td>
							<td align = 'center'>".($rox['fecha_estado'])."</td>
							<td style = 'padding-left:10px;text-align:left;'>".nl2br($rox['observaciones'])."</td>
							<td>
								<a target = '_blank' href = 'pdf_anticipo.php?id=".$row['id']."'>
									<img src = '../images/iconos/icono_descarga.png' width = '45px'/>
								</a>
							</td>";
				}
			}
			$esx.="</tr>";
		}
		
		$estructura = "<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
			<tr>
				<td width = '96%' align = 'left'>
					<table width = '100%'>
						<tr>
							<td align = 'left'>
								".$emp->mostrar_logo_empresa($gestion->mostrar_empresa_empleado())."
							</td>
						</tr>
						<tr>
							<td align = 'left' >
								<span class = 'mensaje_bienvenida' >HISTÓRICO ANTICIPOS</span>
							</td>
						</tr>
					</table>
				</td>
				<td align = 'right' >
					<table width = '100%'>
						<tr>
							<td align = 'center'>
								<img onclick = 'cerrar_ventana_limpiar();' src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano'/>
							</td>
						</tr>
					</table>
				</td>
			</tr>
	</table>
	<table style = 'padding-left:50px;padding-right:50px;'>
		<tr>
			<td>
				<select id = 'filtro_anticipos' onchange = 'evento_filtro_anticipo()'>
					<option value = 'NUMANT'>NUMERO ANTICIPO</option>
					<option value = 'ESTANT'>ESTADO</option>
				</select>
			</td>
			<td style = 'padding-left:10px;'>
				<input type = 'number' id = 'filtro_list_anticipos' class = 'entradas_bordes' width = '100px'/>
				<select id = 'filtro_list_estados' class = 'entradas_bordes hidde'>$list_estados</select>
			</td>
			<td>
				<img src = '../images/iconos/lupa_naranja.png' width = '45px' onclick = 'buscar_anticipo()' />
			</td>
			<td style = 'padding-left:10px;' nowrap>
				<span class = 'botton_verde' onclick = 'historico_anticipos_completo()'>Ver todo</span>
			</td>
		</tr>
	</table>
	<div class = 'contenedor_listado_anticipos_ppto'>
		<table width = '100%' class = 'tablas_muestra_datos_tablas_trafico list_anticipos_table' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<th nowrap># ANTICIPO</th>
						<th nowrap>SOLICITADO POR</th>
						<th nowrap>FECHA SOL.</th>
						<th nowrap>FECHA REQUERIDO</th>
						<th nowrap>FECHA MAX LEGALIZACIÓN</th>
						<th nowrap>ESTADO</th>
						<th nowrap>FECHA APROBACIÓN</th>
						<th nowrap >OBSERVACIONES</th>
						<th nowrap ></th>
					</tr>";
	}else if($turno == 3){
		$item = $_POST['num_ant'];
		//ARMO EL SQL QUE ME TRAE TODA LA INFORMACIÓN DE LOS ANTICIPOS
		$sql_anticipos_ppto = mysql_query("select antppto.id,antppto.user,antppto.fecha_plata,antppto.fecha_legalizacion,antppto.fecha,e.nombre_empleado
		from anticipos_ppto antppto,  usuario u, empleado e
		where antppto.ppto = '$ppto' and antppto.vi = '$vi' and antppto.vc = '$vc' and antppto.id = '$item'
		and antppto.user = u.idusuario and u.pk_empleado = e.documento_empleado");
		
		$esx = "
				<table width = '100%' class = 'tablas_muestra_datos_tablas_trafico list_anticipos_table' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<th nowrap># ANTICIPO</th>
						<th nowrap>SOLICITADO POR</th>
						<th nowrap>FECHA SOL.</th>
						<th nowrap>FECHA REQUERIDO</th>
						<th nowrap>FECHA MAX LEGALIZACIÓN</th>
						<th nowrap>ESTADO</th>
						<th nowrap>FECHA APROBACIÓN</th>
						<th nowrap >OBSERVACIONES</th>
						<th nowrap ></th>
					</tr>";
		while($row = mysql_fetch_array($sql_anticipos_ppto)){
			$id = $row['id'];
			$esx .="
				<tr >
					<td align = 'center'>".($row['id'])."</td>
					<td style = 'padding-left:10px;text-align:left;' >".utf8_decode($row['nombre_empleado'])."</td>
					<td align = 'center'>".($row['fecha'])."</td>
					<td align = 'center'>".($row['fecha_plata'])."</td>
					<td align = 'center'>".($row['fecha_legalizacion'])."</td>";
			$sql_estatus = mysql_query("select e.nombre_empleado,estant.fecha_estado,estant.estado,estant.observaciones
			from estatus_anticipos estant, usuario u, empleado e
			where estant.pk_anticipo = '$id' and estant.useraprobado = u.idusuario and u.pk_empleado = e.documento_empleado");
			
			if(mysql_num_rows($sql_estatus) == 0){
				
				$esx .= "<td style = 'padding-left:10px;text-align:left;' >EN APROBACIÓN</td>
						<td></td>
						<td></td>
						<td>
								<a target = '_blank' href = 'pdf_anticipo.php?id=".$row['id']."'>
									<img src = '../images/iconos/icono_descarga.png' width = '45px'/>
								</a>
							</td>";
			}else{
				while($rox = mysql_fetch_array($sql_estatus)){
					$estado = "";
					if($rox['estado'] == 1){
						$estado = "APROBADO";
					}else{
						$estado = "NO APROBADO";
					}
					$esx .="<td style = 'padding-left:10px;text-align:left;'>$estado</td>
							<td align = 'center'>".($rox['fecha_estado'])."</td>
							<td style = 'padding-left:10px;text-align:left;'>".nl2br($rox['observaciones'])."</td>
							<td>
								<a target = '_blank' href = 'pdf_anticipo.php?id=".$row['id']."'>
									<img src = '../images/iconos/icono_descarga.png' width = '45px'/>
								</a>
							</td>";
				}
			}
			$esx.="</tr>";
		}
	}else if($turno == 4){
		$estado_ant = $_POST['estado'];
		$sql_estado = "";
		$sql_dos = "";
		$sql_from = "";
		if($estado_ant == 1 || $estado_ant == 0){
			$sql_from = ", estatus_anticipos estant";
			$sql_estado = "and antppto.id = estant.pk_anticipo and estant.estado = $estado_ant";
			$sql_dos = "";
			//ARMO EL SQL QUE ME TRAE TODA LA INFORMACIÓN DE LOS ANTICIPOS
			$sql_anticipos_ppto = mysql_query("select antppto.id,antppto.user,antppto.fecha_plata,antppto.fecha_legalizacion,antppto.fecha,e.nombre_empleado
			from anticipos_ppto antppto,  usuario u, empleado e $sql_from
			where antppto.ppto = '$ppto' and antppto.vi = '$vi' and antppto.vc = '$vc'
			and antppto.user = u.idusuario and u.pk_empleado = e.documento_empleado $sql_estado");
			
			$esx = "
					<table width = '100%' class = 'tablas_muestra_datos_tablas_trafico list_anticipos_table' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<th nowrap># ANTICIPO</th>
							<th nowrap>SOLICITADO POR</th>
							<th nowrap>FECHA SOL.</th>
							<th nowrap>FECHA REQUERIDO</th>
							<th nowrap>FECHA MAX LEGALIZACIÓN</th>
							<th nowrap>ESTADO</th>
							<th nowrap>FECHA APROBACIÓN</th>
							<th nowrap >OBSERVACIONES</th>
							<th nowrap ></th>
						</tr>";
			while($row = mysql_fetch_array($sql_anticipos_ppto)){
				$id = $row['id'];
				$esx .="
					<tr >
						<td align = 'center'>".($row['id'])."</td>
						<td style = 'padding-left:10px;text-align:left;' >".utf8_decode($row['nombre_empleado'])."</td>
						<td align = 'center'>".($row['fecha'])."</td>
						<td align = 'center'>".($row['fecha_plata'])."</td>
						<td align = 'center'>".($row['fecha_legalizacion'])."</td>";
				$sql_estatus = mysql_query("select e.nombre_empleado,estant.fecha_estado,estant.estado,estant.observaciones
				from estatus_anticipos estant, usuario u, empleado e
				where estant.pk_anticipo = '$id' and estant.useraprobado = u.idusuario and u.pk_empleado = e.documento_empleado $sql_dos");
				
				if(mysql_num_rows($sql_estatus) == 0){
					$esx .= "<td style = 'padding-left:10px;text-align:left;' >EN APROBACIÓN</td>
							<td></td>
							<td></td>
							<td>
								<a target = '_blank' href = 'pdf_anticipo.php?id=".$row['id']."'>
									<img src = '../images/iconos/icono_descarga.png' width = '45px'/>
								</a>
							</td>";
				}else{
					while($rox = mysql_fetch_array($sql_estatus)){
						$estado = "";
						if($rox['estado'] == 1){
							$estado = "APROBADO";
						}else{
							$estado = "NO APROBADO";
						}
						$esx .="<td style = 'padding-left:10px;text-align:left;'>$estado</td>
								<td align = 'center'>".($rox['fecha_estado'])."</td>
								<td style = 'padding-left:10px;text-align:left;'>".nl2br($rox['observaciones'])."</td>
								<td>
									<a target = '_blank' href = 'pdf_anticipo.php?id=".$row['id']."'>
										<img src = '../images/iconos/icono_descarga.png' width = '45px'/>
									</a>
								</td>";
					}
				}
				$esx.="</tr>";
			}
		}else if($estado_ant == 10){
			$sql_from = "";
			$sql_estado = "";
			$sql_dos = "  and (estant.estado != '1' or estant.estado != '0')";
			//ARMO EL SQL QUE ME TRAE TODA LA INFORMACIÓN DE LOS ANTICIPOS
			$sql_anticipos_ppto = mysql_query("select antppto.id,antppto.user,antppto.fecha_plata,antppto.fecha_legalizacion,antppto.fecha,e.nombre_empleado
			from anticipos_ppto antppto,  usuario u, empleado e 
			where antppto.ppto = '$ppto' and antppto.vi = '$vi' and antppto.vc = '$vc'
			and antppto.user = u.idusuario and u.pk_empleado = e.documento_empleado");
			
			$esx = "
					<table width = '100%' class = 'tablas_muestra_datos_tablas_trafico list_anticipos_table' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<th nowrap># ANTICIPO</th>
							<th nowrap>SOLICITADO POR</th>
							<th nowrap>FECHA SOL.</th>
							<th nowrap>FECHA REQUERIDO</th>
							<th nowrap>FECHA MAX LEGALIZACIÓN</th>
							<th nowrap>ESTADO</th>
							<th nowrap>FECHA APROBACIÓN</th>
							<th nowrap >OBSERVACIONES</th>
							<th nowrap ></th>
						</tr>";
			while($row = mysql_fetch_array($sql_anticipos_ppto)){
				$id = $row['id'];
				
				$sql_estatus = mysql_query("select e.nombre_empleado,estant.fecha_estado,estant.estado,estant.observaciones
				from estatus_anticipos estant, usuario u, empleado e
				where estant.pk_anticipo = '$id' and estant.useraprobado = u.idusuario and u.pk_empleado = e.documento_empleado $sql_dos");
				
				if(mysql_num_rows($sql_estatus) == 0){
					$esx .="
					<tr >
						<td align = 'center'>".($row['id'])."</td>
						<td style = 'padding-left:10px;text-align:left;' >".utf8_decode($row['nombre_empleado'])."</td>
						<td align = 'center'>".($row['fecha'])."</td>
						<td align = 'center'>".($row['fecha_plata'])."</td>
						<td align = 'center'>".($row['fecha_legalizacion'])."</td>";
					$esx .= "<td style = 'padding-left:10px;text-align:left;' >EN APROBACIÓN</td>
							<td></td>
							<td></td>
							<td>
								<a target = '_blank' href = 'pdf_anticipo.php?id=".$row['id']."'>
									<img src = '../images/iconos/icono_descarga.png' width = '45px'/>
								</a>
							</td>";
				}
				$esx.="</tr>";
			}
		}
		
	}
	
	echo $estructura."$esx</div></table>";
?>