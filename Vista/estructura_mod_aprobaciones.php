<?php
	include("../Controller/Conexion.php");
	include_once("../Modelo/gestion_cabecera.php");
	include_once("../Modelo/Empresa.php");
	session_start();
	$gestion = new cabecera_pagina();
	
	$emp = new Empresa();
	
	$user = $_POST['user'];
	
	//SQL PPTOS PENDIENTES DE APROBACION
	$sql_pptos_pendientes_apro = mysql_query("select histo.id,histo.ppto,histo.porcentaje, histo.up_bottom, histo.vi, histo.vc, p.referencia, u.nick, 
	e.nombre_empleado, histo.fecha, p.numero_presupuesto
	from apropresup_histo histo, pendientes_aprobacion  pen, usuario u, empleado e, cabpresup p
	where pen.estado = '1' and pen.user = '$user' and  histo.ppto = p.codigo_presup and histo.user = u.idusuario and u.pk_empleado = e.documento_empleado 
	and histo.id = pen.pk_id ");
	
	$table = "<table width = '100%' class = 'tablas_muestra_datos_tablas_trafico'>
		<tr>
			<th></th>
			<th># PPTO INT. - V</th>
			<th># PPTO EXT. - V</th>
			<th>REFERENCIA</th>
			<th>ENVIADO POR</th>
			<th>FECHA</th>
		</tr>
	";
	while($row = mysql_fetch_array($sql_pptos_pendientes_apro)){
		$id_x = $row['id'];
		$table.="<tr>
			<td nowrap>
				<input type = 'radio'  name = 'select_ppto_x_apro' id = 'ppto_t".$row['id']."' value = '".$row['id']."'  class = 'radio mano' onclick = 'abrir_visual_ppto($id_x)'/>
				<label for='tareaa".$row['id']."' ><span ><span ></span></span></label>
			</td>
			<td>".$row['ppto']." - ".$row['vi']."</td>
			<td>".$row['numero_presupuesto']." - ".$row['vc']."</td>
			<td>".html_entity_decode($row['referencia'])."</td>
			<td>".$row['nombre_empleado']."</td>
			<td>".$row['fecha']."</td>
		</tr>";
	}
	$table.="</table>";
	
	$sql_pendientes_brief = mysql_query("select s.id,ab.pregunta,ab.descripcion,s.version,s.vigencia,s.user,s.fecha,s.respuesta,s.pk_pregunta
	from solved_brief s, ask_brief ab
	where s.vigencia = '1' and s.pk_pregunta = ab.id");
	$list_brief_pendientes = "<table >
		<tr>
			<td>
				<img src = '../images/iconos/aprobado_ppto.png' width = '80px' onclick = 'guardar_revision_brief();'/>
			</td>
			<td>
				<img src = '../images/iconos/noaprobado_ppto.png' width = '80px' onclick = 'no_aprobado_brief();'/>
			</td>
		</tr>
		</table>
		<table>
	";
	while($row = mysql_fetch_array($sql_pendientes_brief)){
		$list_brief_pendientes.="
			<tr>
				<td style = 'border:1px solid black;border-radius:0.5em;width:25%;padding-left:10px;'>".$row['pregunta']."</td>
				<td align = 'left'>
					<textarea  style = 'border:1px solid black;width:100%;' class = 'entradas_bordes' cols = '10' rows = '5' readonly>".$row['respuesta']."</textarea>
				</td>
			</tr>
		";
	}
	$list_brief_pendientes .= "
		<tr><td></br></td></tr>
	</table>";
	
	$perfil = $_POST['perfil'];
	$pestana = "";
	$div_pestana = "";
	
	$pestana_brief = "";
	$div_brief = "";
	$pestana_historico_brief = "";
	$div_historico_brief = "";
	
	/*
		PERFILES:
		1 - > ADMIN FINANCIERO
		7 - > CONTABILIDAD
		9 - > ADMINISTRADOR
		12 ->  FACTURACIÓN
		13 -> TESORERÍA
	*/
	if($perfil == 1 || $perfil == 7 || $perfil == 9 || $perfil == 12 || $perfil == 13){
		$pestana = "<li class = 'pestanas_menu' onclick = 'listar_desembolsos()'><a href='#tabs-5'>Desembolsos</a></li>";
		$div_pestana = "<div id='tabs-5' style = 'padding-left:50px;'></div>";
	}
	
	if($perfil == 3 || $perfil == 11 || $perfil == 5 || $perfil == 9){
		$pestana_brief = "<li class = 'pestanas_menu' onclick = 'listar_brief_sin_check()'><a href='#tabs-6'>Brief</a></li>";
		$div_brief = "<div id='tabs-6' style = 'padding-left:50px;'>$list_brief_pendientes</div>";
		$pestana_historico_brief = "<li class = 'pestanas_menu' onclick = 'listar_brief_sin_check()'><a href='#tabs-7'>Histórico Check Brief</a></li>";
		$div_historico_brief = "<div id='tabs-7' style = 'padding-left:50px;'></div>";
	}
	
	$est = "
		<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
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
								<span class = 'mensaje_bienvenida' >APROBACIONES</span>
							</td>
						</tr>
					</table>
				</td>
				<td align = 'right' >
					<table width = '100%'>
						<tr>
							<td align = 'center'>
								<img onclick = 'cerrar_modulo_aprobaciones()' src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano' />
							</td>
						</tr>
					</table>
				</td>
			</tr>
	</table>
	<div id='tabs_aprobaciones' >
		<ul style = 'padding-left:50px;'>
			<li class = 'pestanas_menu' id = 'submod_presupuestos'><a href='#tabs-1'>Presupuestos</a></li>
			<li class = 'pestanas_menu' id = 'submod_anticipos' onclick = 'actualizar_listado_anticipos_pendientes();'><a href='#tabs-2'>Anticipos</a></li>
			<li class = 'pestanas_menu' id = 'submod_histo_ppto' onclick = 'cargar_historico_aprobaciones_ppto()'><a href='#tabs-3'>Historico Aprobaciones Pptos</a></li>
			<li class = 'pestanas_menu' id = 'submod_histo_ant' onclick = 'cargar_historico_aprobaciones_anticipo()'><a href='#tabs-4'>Historico Aprobaciones Anticipos</a></li>
		
		</ul>
	
		<div id='tabs-1' style = 'padding-left:50px;'>
			$table
		</div>
		<div id='tabs-2' style = 'padding-left:50px;' class = 'pendientes_anticipos' >
			
		</div>
		<div id='tabs-3' style = 'padding-left:50px;' class = 'histo_ppto_aprobaciones'>
		
		</div>
		<div id='tabs-4' style = 'padding-left:50px;' class = 'histo_ant_aprobaciones'>
		
		</div>
		
	</div>
	<script type = 'text/javascript'>
		$('#tabs_aprobaciones').tabs();
	</script>";
	echo $est;
?>