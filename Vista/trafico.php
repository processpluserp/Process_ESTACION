<?php
	include_once("../Controller/Conexion.php");
	include_once("../Modelo/gestion_cabecera.php");
	include_once("../Modelo/cabecera_ot.php");
	include_once("../Modelo/Empresa.php");
	ini_set("session.cookie_lifetime","7200");
	ini_set("session.gc_maxlifetime","7200");
	session_start();
	if($_SESSION["codigo_usuario"] == ""){
		header("location:../logeo.php");
	}
	
	
	$gestion = new cabecera_pagina();
	
	$emp = new Empresa();
	$usuario_actual = $_SESSION["codigo_usuario"];
	$nombre_usuario = $_SESSION["nombre_usuario"];
	
	$sql_depto = mysql_query("select d.codigo_interno_empresa
	from area_empresa d, empleado e, usuario u
	where u.idusuario = '$usuario_actual' and u.pk_empleado = e.documento_empleado and e.pk_depto = d.codigo_interno_empresa");
	$depto_pk = 0;
	while($row = mysql_fetch_array($sql_depto)){
		$depto_pk = $row['codigo_interno_empresa'];
	}
	
	
	$consult_ot = "Select distinct year_ot from cabot order by year_ot desc";
	
	//$result1 = mysql_query($consult_ot);
	//$consult_departamento = "select * from area_empresa";
	//$result2 = mysql_query($consult_departamento);
	//$result3 = mysql_query($consult_departamento);
	
	$horas = "";
	for($i = 1; $i <=12;$i++ ){
		if($i == date("h")){
			if($i<10){
				$i = "0".$i;
			}
			$horas .="<option value = '$i' selected>$i</option>";
		}else{
			if($i<10){
				$i = "0".$i;
			}
			$horas .="<option value = '$i'>$i</option>";
		}
		
	}
	
	$minutos = "";
	
	for($i = 0; $i <=55;$i = $i + 5 ){
		if($i<10){
			$i = "0".$i;
		}
		$minutos .="<option value = '$i'>$i</option>";
	}
	$codigo_usuario_real = $_SESSION["codigo_usuario"];
	$codigo_depto_usuario = $_SESSION["departamento_usuario"];
	
	$empresa_final = $gestion->mostrar_empresa_empleado();
	
?>

<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>:: PROCESS + ::</title>
			<meta charset="utf-8" />
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			
			<script type="text/javascript" src="../css_jquery/css_logeo.js"></script>
			<script type="text/javascript" src="../js/gestion_empresa.js"></script>
			<script type="text/javascript" src="../js/ocultar.js"></script>
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
			


			
			<link type="text/css" href="../css/brief.css" rel="stylesheet" />
			
			<script type="text/javascript" src="../js/reportes.js"></script>
			<script type="text/javascript" src="../js/b_ot_g.js"></script>
			
			
			<script src="../js/canvasjs.min.js"></script>
			<link rel="stylesheet" href="../css/jquery-ui.css"/>
			<link type="text/css" href="../css/reportes.css" rel="stylesheet" />
			
			<link type="text/css" href="../css/tablas.css" rel="stylesheet" />
			<link type="text/css" href="../css/cabecera.css" rel="stylesheet" />
			<link type="text/css" href="../css/trafico.css" rel="stylesheet" />
			<link type="text/css" href="../css/ppto_pro.css" rel="stylesheet" />


			<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
			
			<script type="text/javascript" src="../js/resize.js"></script>
			

			<script type="text/javascript" src="../lib/alertify.js"></script>
			<link rel="stylesheet" href="../themes/alertify.core.css" />
			<link rel="stylesheet" href="../themes/alertify.default.css" />


			
			<link href='../fullcalendar.css' rel='stylesheet' />
			<link href='../fullcalendar.print.css' rel='stylesheet' media='print' />
			
			<script src='../lib/moment.min.js'></script>
			<script src='../fullcalendar.min.js'></script>
			<script src='../lang-all.js'></script>
			<script type="text/javascript" src="../js/trafico.js"></script>
			<script type="text/javascript" src="../js/ppto_pro.js"></script>
			<style >
				.tabla_comprimosos_ie{
					border-collapse:collapse;
				}
				.tabla_comprimosos_ie th{
					font-size:14px;
				}
				.estilos_barra td:nth-child(3){
					background-color:rgb(109, 202, 35);
				}
				.ui-widget-header{
					
				}
				.sorting,.sorting_asc,.sorting_desc{
					cursor:pointer;
				}
				.ui-widget-header table tr{
					border-radius:0.5em;
					-moz-border-radius:0.5em;
					-webkit-border-radius:0.5em;
				}
				.ui-widget-content .ui-state-highlight, .ui-datepicker-week-end .ui-state-highlight{
					background-color: rgb(219, 247, 197);
					font-weight: bold;
				}
				.tabla_reportes_col th{
					background-color:#2CBF09;
					padding:5px;
					color:white;
					font-size:13px;
					border:1px solid black;
				}
				.tabla_reportes_col td{
					font-size:12px;
					border:1px solid black;
					padding:5px;
					border:1px solid black;
				}
				/* The Modal (background) */
				.modalCreated {
					display: none; /* Hidden by default */
					position: fixed; /* Stay in place */
					z-index: 1; /* Sit on top */
					left: 0;
					top: 0;
					width: 100%; /* Full width */
					height: 100%; /* Full height */
					overflow: auto; /* Enable scroll if needed */
					background-color: rgb(0,0,0); /* Fallback color */
					background-color: rgba(0,0,0,0.7); /* Black w/ opacity */
				}

				/* Modal Content/Box */
				.modalCreatedContent {
					background-color:#E3E3E3;
					color:white;
					margin: 15% auto; /* 15% from the top and centered */
					padding: 20px;
					border: 1px solid #888;
					width: 80%; /* Could be more or less, depending on screen size */
				}

				/* The Close Button */
				.closeCreated {
				
				}
				#ui-datepicker-div {z-index: 1151 !important ;}
				
				.fc-row .ui-widget-header{
					  background-color: #9CCB3B;
					  border-top-left-radius: 1em;
					  border-top-right-radius: 1em;
					  padding-left: 5px;
					  padding-right: 5px;
					  color:white;
					  border:none;
					
				}
				.fc-day-grid{
					padding-left:5px;
					padding-right:5px;
				}
				.fc .fc-row{
					
				}
				td.ui-widget-header{
					border:none;
				}
				.fc-title{
					font-size:11px;
					
				}
				.dimension_tabla{
					width:120px;
				}
				.dimension_tabla_opciones{
					width:150px;
				}
			</style>
			
		</head>
		<body class = 'scroll'>
			<span id = "codigo_usuario" class = 'hidde'><?php echo $_SESSION["codigo_usuario"]; ?></span>
			<span id = "perfil_usuario" class = 'hidde'><?php echo $_SESSION["perfil"]; ?></span>
			<span id = "codigo_emp" class = 'hidde'><?php echo $empresa_final; ?></span>
			<span id = "codigo_ot_interno" class = 'hidde'></span>
			<span id ="cod_tarea" class = 'hidde'></span>
			<span id ="cod_tareax" class = 'hidde'></span>
			<span id = 'ppto_tareas' class = 'hidde'></span>
			<span id = 'ultima_actualizacion_tareas' class = 'hidde'></span>
			<span id = 'ultima_actualizacion_tareas' class = 'hidde'></span>
			<div id="spinner" class="spinner" style="display:none;">
				<img id="img-spinner" src="../images/cargando/spinner5.gif" alt="Cargando..."/>
			</div>
			<div id="spinner2" class="spinner" style="display:none;">
				<img id="img-spinner" src="../images/cargando/spinner6.gif" alt="Cargando..."/>
			</div>
			
			<!-- VARIABLES PARA MODULO DE APROBACION -->
			<span id = 'user_html' class = 'hidde'><?php echo $_SESSION['codigo_usuario'];?></span>
			<span id = 'num_ppto' class = 'hidde'></span>
			<span id = 'id_aprohisto' class = 'hidde'></span>
			<span id = 'vc_ppto' class = 'hidde'></span>
			<span id = 'vi_ppto' class = 'hidde'></span>
			<div class = 'ventana' id = 'ventana_aprobaciones'>
				
			</div>
			<div class = 'ventana' id = 'visual_ppto'>
			
			</div>
			
			<div id = 'oculto' class = 'ventana' style = 'position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);-webkit-transform: translate(-50%, -50%);'>
				<img id="img-spinner" src="../images/cargando/spinner5.gif" alt="Cargando..."/>
			</div>
			
			<div id = 'comentarios_anticipos' style = 'display:none;'>
				<table width = '100%' style = 'padding-left:25px;padding-right:25px;'>
					<tr>
						<th width = '96%' align = 'left'>Comentarios Anticipos</th>
						<td>
							<img  src = '../images/iconos/icon-19.png' width = '50px' onclick = 'cerrar_ventana_comentarios_aprobaciones()'/>
						</td>
					</tr>
					<tr>
						<td>
							<p>Por favor ingrese los comentarios correspondientes:</p>
						</td>
					</tr>
				</table>
				<table width = '100%'  style = 'padding-left:25px;padding-right:25px;'>
					<tr>
						<td>
							<textarea style = 'width:100%;height:260px;' id = 'comentarios_ant_text'></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr>
						<td>
							<span class = 'botton_verde'  onclick = 'noaprobar_anticipo_fin()'>GUARDAR</span>
						</td>
					</tr>
				</table>
			</div>
			
			<div id = 'comentarios_ppto' style = 'display:none;'>
				<table width = '100%' style = 'padding-left:25px;padding-right:25px;'>
					<tr>
						<th width = '96%' align = 'left'>Comentarios Pptos</th>
						<td>
							<img  src = '../images/iconos/icon-19.png' width = '50px' onclick = 'cerrar_ventana_comentarios_aprobaciones()'/>
						</td>
					</tr>
					<tr>
						<td>
							<p>Por favor ingrese los comentarios correspondientes:</p>
						</td>
					</tr>
				</table>
				<table width = '100%'  style = 'padding-left:25px;padding-right:25px;'>
					<tr>
						<td>
							<textarea style = 'width:100%;height:260px;background-color:#F2F2F2;' id = 'comentarios_ppto_text'></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr>
						<td>
							<span class = 'botton_verde'  onclick = 'no_aprobar_ppto_text()'>GUARDAR</span>
						</td>
					</tr>
				</table>
			</div>
			
			
			<?php include('cabecera.php'); echo $imprimir;?>
			
			<div id = 'time_table' class = 'ventana' >
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
											<span class = 'mensaje_bienvenida' >TIME TABLE</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right' >
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img onclick = '$("#time_table").dialog("close");$(".scroll").css({"overflow-y":"scroll"});' src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
				</table>
				</br>
				<div style = 'padding-left:50px;padding-right:50px;overflow:scroll;'id='calendar' height = '400px' width ='80%'></div>
			</div>

			
			
			<div id = 'informe_entrevista' class = 'ventana'>
				<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
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
											<span class = 'mensaje_bienvenida' id = 'mensaje_ie' ></span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right' >
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img onclick = '$("#informe_entrevista input").val("");$("#informe_entrevista textarea").val("");$("#informe_entrevista").dialog("close");' src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
				</table>
				<form id = 'id_form_informe_entrevista_add'>
					<table width = '100%' style = 'padding-left:50px;padding-right:50px;font-size:13px;' class = 'tabla_nuevos_datos2'>
						<tr>
							<td style = 'vertical-align:top;width:24%;' >
								<p>Título de la Reunión:</p>
								<input type = 'text' id = 'name_ie' name = 'name_ie' class = 'entradas_bordes' style = 'width:100%;'/>
								<span style = 'color:red;' id = 'mesaje_alerta_name'></span>
							</td>
							<td width = '2%'></td>
							<td style = 'vertical-align:top;width:24%;'>
								<p>Tipo de Reunión:</p>
								<select id = 'tipo_reunion' style = 'width:103%;' >
									<option value = 'PRESENCIAL'>Presencial</option>
									<option value = 'TELEFÓNICA'>Telefónica</option>
									<option value = 'CORREO'>Correo</option>
								</select>
							</td>
							<td class = 'separator' width = '5%'></td>
							<td style = 'vertical-align:top;width:24%;'>
								<p>Tipo de Informe:</p>
								<select id = 'tipo_informe' style = 'width:100%;'>
									<option value = 'INTERNO'>Interno</option>
									<option value = 'EXTERNO' selected>Externo</option>
								</select>
							</td>
							<td style = 'width:2%;'></td>
							<td style = 'vertical-align:top;width:24%;'></td>
						</tr>
						<tr>
							<td style = 'vertical-align:top;width:24%;'>
								<p>Seleccione la Fecha de Reunión:</p>
								<table width = '100%'>
									<tr>
										<td>
											<input type = 'text' id = 'fecha_reunion_ie' name = 'fecha_reunion_ie' class = 'entradas_bordes' style = 'width:100%;'/>
											<span style = 'color:red;' id = 'mesaje_alerta_fecha_reunion'></span>
										</td>
									</tr>
								</table>
							</td>
							<td style = 'width:2%;'></td>
							<td style = 'vertical-align:top;width:24%;'>
								<p>Ingrese el Lugar de la Reunión:</p>
								<table width = '100%'>
									<tr>
										<td>
											<input type = 'text' id = 'lugar_reunion_ie' name = 'lugar_reunion_ie' class = 'entradas_bordes' style = 'width:100%;'/>
											<span style = 'color:red;' id = 'mesaje_alerta_lugar'></span>
										</td>
									</tr>
								</table>
							</td>
							<td class = 'separator' width = '5%'></td>
							<td style = 'vertical-align:top;width:24%;'>
								<p>Seleccione la Hora de Inicio:</p>
								<table width = '100%'>
									<tr>
										<td>
											<select id = "hora_inicio_ie" name = 'hora_inicio_ie' style = 'padding-bottom:5px;'><?php echo $horas;?></select>
										</td>
										<td>
											<select id = "minuto_inicio_ie" name = 'minuto_inicio_ie' style = 'padding-bottom:5px;' ><?php echo $minutos;?></select>
										</td>
										<td align = 'right'>
											<select id = "formato_inicio_ie" name = 'formato_inicio_ie' style = 'padding-bottom:5px;'><option value = "AM">AM</option><option value = "PM">PM</option></select>
										</td>
									</tr>
								</table>
							</td>
							<td style = 'width:2%;'></td>
							<td style = 'width:24%;'>
								<p>Seleccione la Hora de Finalización:</p>
								<table width = '100%'>
									<tr>
										<td>
											<select id = "hora_fin_ie" name = 'hora_fin_ie' style = 'padding-bottom:5px;'><?php echo $horas;?></select>
										</td>
										<td>
											<select id = "minuto_fin_ie" name = 'minuto_fin_ie' style = 'padding-bottom:5px;'><?php echo $minutos;?></select>
										</td>
										<td align = 'right'>
											<select id = "formato_fin_ie" name ='formato_fin_ie' style = 'padding-bottom:5px;'><option value = "AM">AM</option><option value = "PM">PM</option></select>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td></br></td>
						</tr>
						<tr>
							<th align = 'left' style = 'width:24%;'>AGENCIA</th>
							<td style = 'width:2%;'></td>
							<th align = 'left' style = 'width:24%;' ></th>
							<td class = 'separator' width = '5%'></td>
							<th align = 'left' style = 'width:24%;'>CLIENTE</th>
							<td style = 'width:2%;'></td>
						</tr>
						<tr>
							<td style = 'width:24%;'>
								<p>Ingrese los asistentes agencia:</p>
							</td>
							<td style = 'width:2%;'></td>
							<td style = 'width:24%;'>
								<p>Copiar a:</p>
							</td>
							<td class = 'separator' width = '5%'></td>
							<td style = 'width:24%;'>
								
							</td>
							<td style = 'width:2%;'></td>
							<td style = 'width:24%;'>
								
							</td>
						</tr>
						<tr>
							<td style = 'width:24%;'>
								<input type = 'text' id = 'asis_input_agencia' onkeyup = 'filtrar_asis_agencia_input()' style = 'width:100%;'/>
								<span style = 'color:red;' id = 'mensaje_alerta_asis_agencia'></span>
							</td>
							<td style = 'width:2%;'></td>
							<td style = 'width:24%;'>
								<input type = 'text' id = 'asis_input_agencia_copiados' onkeyup = 'filtrar_asis_agencia_interesados_input()' style = 'width:100%;'/>
								<span style = 'color:red;' id = 'mensaje_alerta_int_agencia'></span>
							</td>
							
							<td class = 'separator' width = '5%'></td>
							
							<td style = 'width:24%;' class = 'botton_verde mano'>
								<span id="asistentesBoton" style = 'text-align:center;width:100%;color:white;'>AGREGAR ASISTENTE DEL CLIENTE</span>
							</td>
							<td style = 'width:2%;'></td>
							<td style = 'width:24%;'class = 'botton_verde mano'>
								<span id="copiarotrosBoton" style = 'text-align:center;width:100%;color:white;'>AGREGAR COPIAR A</span>
							</td>
						</tr>
						<tr>
							<td style = 'vertical-align:top;width:24%;'>
								<table width = '100%' height = '100%'style = 'vertical-align:top;'>
									<tr>
										<td>
											<div id = 'listado_Asistentes_agencia' style = 'width:100%;'></div>
										</td>
									</tr>
									<tr>
										<td id = 'list_asistentes_agencia_confirmados'>
											
										</td>
									</tr>
									<tr>
										<td colspan = '3' id = 'cnt_asis_emp'></td>
									</tr>
								</table>
							</td>
							<td style = 'width:2%;'></td>
							<td style = 'vertical-align:top;width:24%;'>
								<table width = '100%'>
									<tr>
										<td>
											<div id = 'listado_Asistentes_agencia2' style = 'width:100%;'></div>
										</td>
									</tr>
									<tr>
										<td id = 'list_asistentes_agencia_interesados'>
											 
										</td>
									</tr>
									<tr>
										<td colspan = '3'>
											<table id = 'list_bd_copiados_x_empresa'>
												
											</table>
										</td>
									</tr>
									<tr>
										<td colspan = '3' id = 'cnt_asis_emp'></td>
									</tr>
								</table>
							</td>
							<td class = 'separator' width = '5%'></td>
							<td style = 'vertical-align:top;width:24%;' >
								<table width = '100%'>
									<tr>
										<td><div colspan = '3' id = 'cnt_asis_clie'></div></td>
									</tr>
								</table>
								<div id="asistentesReunion" class="modalCreated">
									<div  class="modalCreatedContent">
										<table width = '100%'>
											<tr>
												<td >
													<p>Nombre Asistente:</p>
													<input type = 'text' class = 'entradas_bordes' id = 'add_name_ie_c'/>
												</td>
												<td></td>
												<td>
													<p>Correo asistente:</p>
													<input type = 'text' class = 'entradas_bordes' id = 'add_cargo_ie_c'/>
												</td>
											</tr>
											<tr>
												<td></br></td>
											</tr>
											<tr>
												<td colspan = "3">
													<table width = "100%">
														<tr>
															<td  width = "50%" align = "center">
																<span class="mano botton_verde closeCreated" style = "background-color:red;">Cancelar</span>
															</td>
															<td width = "50%" align = "center">
																<span onclick = 'add_int_cliente_ie()' class = 'mano botton_verde'>Guardar</span>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</div>
								</div>
							</td>
							<td></td>
							<td style = 'vertical-align:top;width:24%;' >
								<table width = '100%'>
									<tr>
										<td><div colspan = '3' id = 'cnt_asis_clie_cc'></div></td>
									</tr>
								</table>
								<div id="copiarotroscliente" class="modalCreated">
									<div  class="modalCreatedContent">
										<table width = '100%'>
											<tr>
												<td >
													<p>Nombre:</p>
													<input type = 'text' class = 'entradas_bordes' id = 'add_name_ie_cc'/>
												</td>
												<td></td>
												<td>
													<p>Correo:</p>
													<input type = 'text' class = 'entradas_bordes' id = 'add_cargo_ie_cc'/>
												</td>
											</tr>
											<tr>
												<td></br></td>
											</tr>
											<tr>
												<td colspan = "3">
													<table width = "100%">
														<tr>
															<td  width = "50%" align = "center">
																<span class="mano botton_verde closeCreated" style = "background-color:red;">Cancelar</span>
															</td>
															<td width = "50%" align = "center">
																<span onclick = 'add_int_cliente_ie_cc()' class = 'mano botton_verde'>Guardar</span>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</div>
								</div>
							</td>
						</tr>
						
						<tr>
							<td  style = 'width:24%;'>
								<p>Seleccione un Adjunto:</p>
								<input type = 'file'  id = 'adjunto_ie' name = 'adjunto_ie[]' multiple style = 'width:100%;'/>
							</td>
							<td  style = 'width:2%;'></td>
							<td  style = 'width:24%;'>
								
							</td>
							<td class = 'separator' width = '5%'></td>
							<td  style = 'width:24%;'></td>
							<td  style = 'width:2%;'></td>
							<td  style = 'width:24%;'></td>
						</tr>
						<tr>
							<td></br></td>
						</tr>
						<tr>
							<td colspan = '7'  style = 'vertical-align:top;'>
								<p>Ingrese la información General de la Reunión:</p>
								<textarea id = 'info_general_ie' name = 'info_general_ie' rows = '5' cols = '40' style = 'width:100%;'></textarea>
								<span style = 'color:red;' id = 'mensaje_alerta_info_general'></span>
							</td>
						</tr>
						<tr>
							<td></br></td>
						</tr>
						<tr>
							<td colspan = '7'  style = 'vertical-align:top;'>
								<span id="temasTratadosBoton" class= 'botton_verde mano'>AGREGAR TEMAS TRATADOS</span>
								</br>
								<div id="temasReunion" class="modalCreated">
									<div  class="modalCreatedContent">
										<table width = '100%'>
											<tr>
												<td colspan = '3'>
													<p>Ingrese los temas tratados en la Reunión:</p>
													<textarea id = 'temas_tratados_ie' name = 'temas_tratados_ie' rows = '5' cols = '40'></textarea>
												</td>
											</tr>
											<tr>
												<td colspan = "3">
													<table width = "100%">
														<tr>
															<td  width = "50%" align = "center">
																<span class="mano botton_verde closeCreated" style = "background-color:red;">Cancelar</span>
															</td>
															<td width = "50%" align = "center">
																<span onclick = 'add_temas_ie()' class = 'mano botton_verde'>Guardar</span>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<div id="editmodal" class="modalCreated">
									<div  class="modalCreatedContent">
										<table width = '100%'>
												<tr>
													<td id="title_edit_modal_name">
														<p>Nombre asistente:</p>
														<select id = 'modal_edit_ta_select'>
															<?php
																	$n_ot = new cabecera_ot();
																	$n_ot->listar_asistentes_agencia_option();
															?>
														</select>
													</td>
												</tr>
												<tr>
													<td id="title_edit_modal_name2" colspan = '3'>
															<p>Nombre del cliente:</p>
															<input id = 'modal_edit_ta_name' rows = '5' cols = '40'></input>
													</td>
												</tr>
												<tr>
													<td id="title_edit_modal_date" colspan = '3'>
															<p>Fecha:</p>
															<input readonly type = 'text' id = 'modal_edit_ta_date' placeholder = '1999-12-31'/>
													</td>
												</tr>
												<tr>
													
													<td id="title_edit_modal_content" colspan = '3'>
															<p>Compromiso:</p>
															<textarea id = 'modal_edit_ta' rows = '5' cols = '40'></textarea>
													</td>
												</tr>
												<tr>
													
													<td id="title_edit_modal_content_tema" colspan = '3'>
															<p>Editar Tema:</p>
															<textarea id = 'modal_edit_ta_tema' rows = '5' cols = '40'></textarea>
													</td>
												</tr>
												<tr>
													<td colspan = "3">
														<table width = "100%">
																<tr>
																		<td  width = "50%" align = "center">
																				<span id="cerraredit" class="mano botton_verde" style = "background-color:red;">Cancelar</span>
																		</td>
																		<td width = "50%" align = "center">
																				<span onclick = 'save_edit_modal()' class = 'mano botton_verde'>Guardar</span>
																		</td>
																</tr>
														</table>
													</td>
												</tr>
										</table>
									</div>
							</div>
								</br>
								<div style = 'width:100%;' id = 'contenedor_temas_ie'></div>
							</td>
						</tr>
						<tr>
							<td></br></td>
						</tr>
						<tr>
							<td colspan = '7' style = 'vertical-align:top;'>
								<span id="compromisosAgenciaBoton" class = 'botton_verde mano'  >AGREGAR COMPROMISOS AGENCIA</span>
								</br>
								<div id="compromisosAgencia" class="modalCreated">
									<div  class="modalCreatedContent">
										<table width = '100%' >
											<tr>
												<td colspan = '3'>
													<p>Ingrese los Compromisos de la Agencia:</p>
												</td>
											</tr>
											<tr>
												<td colspan = '3'>
													<table width = '100%'>
														<tr>
															<p>Seleccione a una persona:</p>
															<select id = 'n_compromiso_agencia_p1'>
																	<?php
																		$n_ot = new cabecera_ot();
																		$n_ot->listar_asistentes_agencia_option();
																	?>
															</select>	
															<br>
															<p>Seleccione la fecha de entrega:</p>
															<input type = 'text' id = 'fentrega_compromiso_agencia_p1' placeholder = '1999-12-31'/>
															<br>
															<p>Ingrese el compromiso:</p>
															<textarea id = 'compromisos_empresa_p1' name = 'compromisos_empresa_ie' rows = '5' cols = '10'width = '100%' placeholder = 'Texto del Compromiso'></textarea>
														</tr>
														<tr>
															<td colspan = "3">
																<table width = "100%">
																	<tr>
																		<td  width = "50%" align = "center">
																			<span class="mano botton_verde closeCreated" style = "background-color:red;">Cancelar</span>
																		</td>
																		<td width = "50%" align = "center">
																			<span onclick = 'adicionar_compromiso_agencia_ie()' class = 'mano botton_verde'>Guardar</span>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</div>
								</div>
								</br>
								<div style = 'width:100%;' id = 'contenedor_listado_compromisos_agencia'></div>
							</td>
						</tr>
						<tr>
							<td></br></td>
						</tr>
						<tr>
							<td colspan = '7' style = 'vertical-align:top;'>
								<span id="compromisosClienteBoton" class = 'botton_verde mano' >AGREGAR COMPROMISOS DEL CLIENTE</span>
								</br>
								<div id="compromisosCliente" class="modalCreated">

									<div  class="modalCreatedContent">
								
									<table width = '100%'>
										<tr>
											<p>Ingrese el nombre del cliente:</p>
											<input id = 'name_compromiso_cliente_ie' type = 'text' placeholder = 'Nombre Asistente Cliente' />
											</br>
											<p>Seleccione la fecha de entrega:</p>
											<input type = 'text' id = 'fentrega_compromiso_cliente_p1' placeholder = '1999-12-31'/>
											
											</br>
											<p>Ingrese el compromiso:</p>
											<textarea id = 'compromisos_cliente_p1' name = 'compromisos_cliente_ie' rows = '5' cols = '10'width = '100%' placeholder = 'Texto del Compromiso'></textarea>
											
										</tr>
										<tr>
											<td colspan = "3">
												<table width = "100%">
													<tr>
														<td  width = "50%" align = "center">
															<span class="mano botton_verde closeCreated" style = "background-color:red;">Cancelar</span>
														</td>
														<td width = "50%" align = "center">
															<span onclick = 'adicionar_compromiso_cliente_ie()' class = 'mano botton_verde'>Guardar</span>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									</div>
									
									
									</div>
								</br>
								<div style = 'width:100%;' id = 'contenedor_listado_compromisos_cliente'></div>
							</td>
						</tr>
						<tr style = 'display:none;'>
							<td colspan = '7' style = 'vertical-align:top;display:none;'>
								<p>Información Específica de la Agencia (Esta información no va para el Cliente):</p>
								<textarea id = 'info_especifica_ie' name = 'info_especifica_ie' rows = '5' cols = '40'></textarea>
							</td>
						</tr>
						<tr>
							<td>
								<br></br>
								<br></br>
							</td>
						</tr>
						<tr>
							<td align = 'center' colspan = '7'>
								<span class = 'botton_verde mano' id = 'previsual_informe'>VISUALIZAR</span>
								<span style = 'display:none;background-color:red;' class = 'botton_verde mano' id = 'cancelar_ie'onclick = '$("#informe_entrevista input").val("");$("#informe_entrevista textarea").val("");$("#informe_entrevista").dialog("close");$("#cancelar_ie,#add_informe_entrevista_ot").hide();'>CANCELAR</span>
								<span style = 'display:none;' class = 'botton_verde mano' id = 'add_informe_entrevista_ot'>GUARDAR Y ENVIAR</span>
							</td>
						</tr>
						<tr>
							<td>
								<br></br>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div id="previ" class="modalCreated ventana">
				
				<div class="modalCreatedContentPrevi">					
					<div id="infoPrevi" style="padding-bottom:15px;">
					</div>
					<br>
					<table width="100%">
							<tr width="100%" align="center">
								<td width= "25%" align="center">
									<span onclick = 'cerrar_ventana_visual_ie();' class="mano botton_verde" style = "background-color:red;">CERRAR PREVISUALIZACIÓN</span>
								</td>
							</tr>
					</table>
				</div>
			</div>

			<div id = 'traslado_ot' class = 'ventana'>
				<table width = '100%'  style = 'padding-right:50px;padding-left:50px;'>
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
											<span class = 'mensaje_bienvenida' ID = 'text_tras_ot' >asdsda</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right'>
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img id = 'cerrar_ventana_tras_ot' onclick = '$("#traslado_ot input").val("");$("#traslado_ot").dialog("close");' src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
				</table>
				</br>
				<table width = '100%' class = "tabla_nuevos_datos2" style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td width = '48%'>
							<p>Seleccione una Empresa:</p>
								<select class = "entradas_bordes" id = "grupo_empresas2" name = "grupo_empresas2" >
								<option>...</option>
								<?php
									$consulta = "SELECT e.nombre_comercial_empresa, e.cod_interno_empresa 
									from empresa e, pusuemp p
										where e.cod_interno_empresa = p.cod_empresa and p.cod_usuario = '$usuario_actual' order by e.nombre_comercial_empresa asc;";
									$result = mysql_query($consulta);
									while($row = mysql_fetch_array($result)){
										echo "<option value=".$row['cod_interno_empresa'].">".utf8_encode($row['nombre_comercial_empresa'])."</option>";
									}
								?>
								</select>
						</td>
						<td class = 'separator' width = '2%'></td>
						<td width = '48%'>
							<p>Seleccione un Cliente:</p>
							<select class = "entradas_bordes" id = "cliente2" name = "cliente2" >
								<option>...</option>
							</select>
						</td>
					</tr>
					<tr>
						<td >
							<p>Seleccione un Producto del Cliente:</p>
							<select class = "entradas_bordes" id = "pro_cliente2" name = "pro_cliente2">
								<option>...</option>
							</select>
						</td>
						<td class = 'separator'></td>
						<td >
							<P>Ingrese la Referencia de la OT:</P>
							<input class = "entradas_bordes" type = "text" name = "referencia2" id = "referencia2" value = "" width = '98%'/>
						</td>
					</tr>
					<tr>
						<td>
							<P>Ingrese la Descripción de la OT:</P>
							<textarea class = "entradas_bordes" id = "descripcion2" name ="descripcion2" rows = "5" cols = "40"></textarea>
						</td>
						<td class = 'separator'></td>
						
					</tr>
					<tr>
						<td></br></td>
					</tr>
					<tr>
						<td align = "center" colspan = '3'>
							<span class = "botton_verde mano"  id = "cancelar_tralador_ot" onclick = '$("#traslado_ot input").val("");$("#traslado_ot").dialog("close");' >Cancelar</span>
							<span class = "botton_verde mano" id = "traslador_ot_ot" name = "traslador_ot_ot" >Trasladar OT</span>
						</td>
					</tr>
				</table>

			</div>
			
			<div id = "brief_1" class = 'brief_trafico ventana'>
				<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
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
										<span class = 'mensaje_bienvenida' >BRIEF CLIENTE</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right' >
							<table width = '100%'>
								<tr>
									<td align = 'center'>
										<img id = 'cerrar_ventana_brief1' src = '../images/iconos/cerrar.png' class = 'iconos_opciones mano' />
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<table class ="tabla_nuevos_datos2" width = '100%' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td style = 'display:none;' class = 'nbriefcrm'>
							<p>Tipo Proyecto:</p>
							<input type = 'text'  name ='tipo_priyecto_crm' id ='tipo_priyecto_crm'/>
						</td>
						<td >
							<p>Producto o Marca:</p>
							<input type = "text" name = "producto_marca_brief_1" id ="producto_marca_brief_1"readonly/>
						</td>
						<td >
							<p>Desarrollado Por:</p>
							<input type = "text" name = "desarrollador_por_brief1" id ="desarrollador_por_brief1" readonly/>
						</td>
						<td class = "separator"></td>
						<td >
							<p>Fecha de Elaboración:</p>
							<input type = "text" name = "fecha_elaboracion_brief_1" id ="fecha_elaboracion_brief_1" value = '<?php echo date("Y-m-d");?>' readonly/>
						</td>
						<td >
							<p>Fecha de Entrega Creativa:</p>
							<input type = "text" name = "fecha_entrega_creativa_brief1" id ="fecha_entrega_creativa_brief1"/>
						</td>
					</tr>
				</table>
				
				<table class ="tabla_nuevos_datos2" width = '100%' style = 'padding-left:50px;padding-right:50px;'>
					<tr class = 'nbriefcrm'>
						<td colspan = '2' width = '33.3%' >
							<p class = 'tooltip mano'>ANTECEDENTES:
								<span>Situación actual, problema que debemos resolver.<span>
							</p>
							<textarea rows = '5' cols ='5' name ='rpta1_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>¿A QUIÉN LE VAMOS A HABLAR?
								<span>Descripción de la audiencia y su perfil, quienes son, como son, que esperan</span>
							</p> 
							<textarea rows = '5' cols ='5' name = 'rpta2_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>OBJETIVO DE MERCADEO:
								<span>¿Qué queremos lograr: ventas, posicionamiento, generación de Top of Heart?</span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta3_briefcrm'></textarea>
						</td>
					</tr>
					
					<tr class = 'nbriefcrm'>
						<td colspan = '2' width = '33.3%' >
							<p class = 'tooltip mano'>POSICIONAMIENTO:
								<span>Idea de marca o atributos de producto a destacar.<span>
							</p>
							<textarea rows = '5' cols ='5' name ='rpta4_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>OBJETIVO DE COMUNICACIÓN:
								<span>¿Qué queremos que la comunicación transmita al consumidor final?</span>
							</p> 
							<textarea rows = '5' cols ='5' name = 'rpta5_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>ACTITUD:
								<span>¿Qué queremos que piense el público como resultado de la comunicación?</span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta6_briefcrm'></textarea>
						</td>
					</tr>
					
					<tr class = 'nbriefcrm'>
						<td colspan = '2' width = '33.3%' >
							<p class = 'tooltip mano'>COMPORTAMIENTO DESEADO:
								<span>¿Qué queremos que haga el público como resultado de la comunicación?<span>
							</p>
							<textarea rows = '5' cols ='5' name ='rpta7_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>¿ A QUIEN VA DIRIGIDA ESTA CAMPAÑA DIRECTA?
								<span></span>
							</p> 
							<textarea rows = '5' cols ='5' name = 'rpta8_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>DESCRIPCION ACTIVIDAD:
								<span>Mecánica a utilizar y detalles generales, piezas.</span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta9_briefcrm'></textarea>
						</td>
					</tr>
					
					<tr class = 'nbriefcrm'>
						<td colspan = '2' width = '33.3%' >
							<p class = 'tooltip mano'>TONO Y MANERA:
								<span><span>
							</p>
							<textarea rows = '5' cols ='5' name ='rpta10_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>MANDATORIOS:
								<span></span>
							</p> 
							<textarea rows = '5' cols ='5' name = 'rpta11_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>PIEZAS CREATIVAS:
								<span></span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta12_briefcrm'></textarea>
						</td>
					</tr>
					<tr class = 'nbriefcrm'>
						<td colspan = '2' width = '33.3%' >
							<p class = 'tooltip mano'>COMO MEDIREMOS LOS RESULTADOS:
								<span>Cronogramas, creatividad, ventas, cantidad de diseños<span>
							</p>
							<textarea rows = '5' cols ='5' name ='rpta13_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>OBSERVACIONES:
								<span></span>
							</p> 
							<textarea rows = '5' cols ='5' name = 'rpta14_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							
						</td>
					</tr>
					
					<tr class = 'nbriefall'>
						<td colspan = '2' width = '33.3%' >
							<p class = 'tooltip mano'>¿Por qué se va hacer la actividad ?
								<span>¿Cuál es la situación por la que pasa la marca?, se describe brevemente que pasa con el entorno competitivo-mercado, lo que se ha hecho en el pasado?<span>
							</p>
							<textarea rows = '5' cols ='5' name ='rpta1_briefx'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>Descripción del Producto:
								<span>Describa el producto o servicio, cuáles son los atributos y sus características.</span>
							</p> 
							<textarea rows = '5' cols ='5' name = 'rpta2_briefx'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>Beneficio del Producto:
								<span>Cómo los atributos del producto se convierten en beneficios para el consumidor</span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta3_briefx'></textarea>
						</td>
					</tr>
					<tr class = 'nbriefall'>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>Objetivo de Mercadeo:
								<span>Qué tengo que solucionar en terminos de Mercadeo, Cuál es la oportunidad que tiene la marca? Ventas-Unidades-Posiconamiento, Leads.</span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta4_briefx'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>Objetivo de Comunicación.
								<span>¿Qué queremos que la audiencia piense y haga ?</br>La tarea de comunicación: Qué queremos que la gente piense y haga despues de ver la comunicación. 
								Es el resultado ideal de la comunicación esperado y confirmado en el comportamiento de las personas. Que queremos que la gente piense o haga con esta campaña o pieza creativa?  </span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta5_briefx'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>¿A quién va dirigida esta Campaña ?
								<span>A quién/quiénes van dirigidos los esfuerzos de comunicación. Una breve descripcion que incluya insights, estamos describiendo personas, no cifras.</span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta6_briefx'></textarea>
						</td>
					</tr>
					<tr class = 'nbriefcreativos'>
						<td id = 'tabla_trafico_creativox' colspan = '8' >
							<table width = '100%' >
								<tr>
									<td width = '22%'>
										<p class = 'tooltip mano'>Insigh Clave:
											<span>Son barreras o motivaciones o creencias universales que definen el comportamiento del consumidor.</span>
										</p>
										<textarea rows = '5' cols ='5' name = 'Insigh_Clavex'></textarea>
									</td>
									<td class = 'separator'></td>
									<td width = '22%'>
										<p class = 'tooltip mano'>Beneficio:
											<span>¿Qué tiene la marca o servicio para solucionar el Insight?</span>
										</p>
										<textarea rows = '5' cols ='5' name = 'beneficio_creativox'></textarea>
									</td>
									<td class = 'separator'></td>
									<td width = '22%'>
										<p class = 'tooltip mano'>Soporte:
											<span>Lo que hace creíble lo que hay que decir. Qué hace creíble el mensaje que le voy a dar a la audiencia.</span>
										</p>
										<textarea rows = '5' cols ='5' name = 'soporte_creativox'></textarea>
									</td>
									<td class = 'separator'></td>
									<td width = '22%'>
										<p class = 'tooltip mano'>Concepto Estratégico:
											<span>BIG IDEA, La carne para el creativo:  En una sola frase definimos cuál es ese único mensaje que hará que las personas 'hagan' algo por la marca.</span>
										</p>
										<textarea rows = '5' cols ='5' name = 'concepto_estrategicox'></textarea>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'nbriefall'>
						<td colspan = '2' width = '33.3%' class = 'tooltip mano'>
							<p >Entregables:</p>
							<textarea rows = '5' cols ='5' name = 'rpta7_briefx'></textarea>
							<span>¿Dónde lo vamos a comunicar? Acciones y/o medios. Dependiendo de la unidad de negocio se debe ampliar esta información con hoja anexa.</span>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>Mandatarios Ejecucionales:
							<span>Cosas que son obligatorias al momento de desarrollar la acción o campaña en términos de tono, manera, lo que es y no es la marca.</span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta8_briefx'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>Fecha al Aire:
								<span>Cuándo debe estar este proyecto, trabajo, campaña al aire en medios.</span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta9_briefx'></textarea>
						</td>
					</tr>
					<tr class = 'nbriefall'>
						<td colspan = '2' width = '33.3%' class = 'tooltip mano'>
							<p class = 'tooltip mano'>Presupuesto:	</p>
							<textarea rows = '5' cols ='5' name = 'rpta10_briefx'></textarea>
							<span>Cuánto dinero tenemos para estar aterrizados desde el principio</span>
						</td>
						<td class = 'separator'></td>
					</tr>
					<tr>
						<td></br></td>
					</tr>
					<tr>
						<td colspan = '8' align = 'center'>
							<span class = 'botton_verde mano' id = 'cancelar_brief_1'>CANCELAR</span>
							<span class = 'botton_verde mano' id = 'crear_ot_brief_1'>CREAR BRIEF</span>
						</td>
					</tr>
				</table>
			</div>
			
			<div id = "cuerpo_pagina">
				<table width = '100%'>
					<tr>
						<td align = 'right'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>
										<table >
											<tr>
												<td>Regresar</td>
												<td>
													<?php
														echo "<a class = 'links_barra_ubicacion' href = 'bienvenida.php'>
															<img src = '../images/iconos/icon-17.png' width = '45px' height = '45px'/>
														</a>";
													?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<?php
					include('empresa_defect.php');
					$gestion->menu_trafico_perfil($_SESSION["codigo_usuario"]);
				?>
				
			<div id = 'ventana_reportes_trafico' class = 'ventana'>
				<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
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
										<span class = 'mensaje_bienvenida' id = 'mensaje_crear_tarea'>REPORTES TRÁFICO</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right'>
							<table width = '100%'>
								<tr>
									<td align = 'center'>
										<img onclick = '$("#ventana_reportes_trafico").dialog("close");$(".scroll").css({"overflow-y":"scroll"});'src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano'  title = 'Adicionar Brief'/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				</br>
				<div style = 'overflow:scroll;width:100%;height:70%;'>
					<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td width = '100%'>
								<table width = '100%' >
									<tr >
										<th align = 'left' >
											<img src = '../images/iconos/barras-47.png' class = 'img_menu_desplieg mano' id = 'consultar_ppto' onclick = 'resaltar_imagen_seleccionada("consultar_ppto");mostrar_barra_reporte("hijos_reporte_ot");' style = 'width:300px'/>
										</th>
										<th align = 'left' >
											<img src = '../images/iconos/barras-46.png' onclick = 'ocultar_submenus_nomina_cuadros("img_nomina_cuadro_f");mostrar_barra_reporte("hijos_reporte_tareas");' id = 'img_nomina_cuadro_f' class = 'img_menu_desplieg mano' style = 'width:300px' />
										</th>
										<th align = 'left' >
											<img src = '../images/iconos/barras-46_colp.png' onclick = 'ocultar_submenus_nomina_cuadros("img_colpatria");mostrar_barra_reporte("reporte_colpatria");' id = 'img_colpatria' class = 'img_menu_desplieg mano' style = 'width:300px'/>
										</th>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td width = '100%'>
								<div  id = 'contenedor_opciones' style = 'background-color:#dadada;vertical-align:middle;width:100%;'>
									<table width = '100%' style = 'display:none;' class = 'hijos_reporte_ot' >
										<tr >
											<td>
												<table width = '100%' class = 'barra_busqueda2' style = ''>
													<tr>
														<td style = 'padding-left:20px;'>
															<p>Empresa:</p>
															<select class = "entradas_bordes" id = "empresa_rot"  >
																<option value = 0>Todas las empresas</option>
																<?php
																	$consulta = "SELECT e.nombre_comercial_empresa, e.cod_interno_empresa from empresa e, pusuemp p
																	where e.cod_interno_empresa = p.cod_empresa and p.cod_usuario = '$usuario_actual' order by e.nombre_comercial_empresa asc;";
																	$result = mysql_query($consulta);
																	while($row = mysql_fetch_array($result)){
																		echo "<option value=".$row['cod_interno_empresa'].">".utf8_encode($row['nombre_comercial_empresa'])."</option>";
																	}
																?>
															</select>
														</td>
														<td style = 'padding-left:20px;'>
															<p>Cliente:</p>
															<select class = "entradas_bordes" id = "cliente_rot" style = 'min-width:200px;'>
															</select>
														</td>
														<td style = 'padding-left:20px;'>
															<p>Desde</p>
															<input type = 'text'  id = 'fdesde_ot' class = "entradas_bordes" value = "<?php echo date('Y-m-d'); ?>"/>
														</td>
														<td style = 'padding-left:20px;'>
															<p>Hasta</p>
															<input type = 'text'  id = 'fhasta_ot' class = "entradas_bordes" value = "<?php echo date('Y-m-d'); ?>"/>
														</td>
														<td style = 'padding-left:20px;vertical-align:center;'>
															<img id = "generar_reporte_ot" src = "../images/iconos/icon-20.png" class = 'mano botones_opciones'/>
														</td>
														<td style = 'padding-left:20px;vertical-align:center;'>
															<a href = "download_reporte_ot.php" id = 'link_bajar_excel_ots'><img title = 'Exportar a Excel'src = "../images/iconos/icon-27.png" class = 'botones_opciones mano'/></a>
														</td>
														<td style = 'padding-left:20px;vertical-align:center;'>
															<a href = "download_reporte_ot.php" target = '_blank'><img title = 'Exportar a Excel'src = "../images/iconos/iconos-40.png" class = 'iconos_opciones mano'/></a>
														</td>
														<!--<td style = 'padding-left:20px;'>
															<a target = '_blank'><img src = "../images/iconos/pdf.png" title = 'Exportar a PDF'class = 'mano'width = '50px' height = '50px'/></a>
														</td>-->
													</tr>
													<tr class = 'hijos_reporte_ot' style = 'display:none;padding-right:50px;'>
														<td colspan = '6' >
															<table width = '100%'>
																<tr></tr>
																<tr>
																	<td width = '49%' style = 'padding-left:20px;'>
																		<div id = 'chart_div' class = 'contenedor_scroll_reportes' style = 'overflow-y:hidden;overflow:hidden;background-color:rgb(232, 232, 232);border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'></div>
																	</td>
																	<td class = 'separator'></td>
																	<td width = '49%'>
																		<div id = "canvas_rots" class = 'contenedor_scroll_reportes' style = 'overflow:hidden;background-color:rgb(232, 232, 232);border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'></div>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									
									<table width = '100%' class = 'hijos_reporte_tareas' style = 'display:none;padding-left:20px;padding-right:50px;'>
										<tr  >
											<td>
												<table width = '100%' class = 'barra_busqueda2'>
													<tr>
														<td >
															<p>Empresa:</p>
															<select class = "entradas_bordes" id = "empresa_rtareas"  >
																<option value = 0>Todas las empresas</option>
																<?php
																	$consulta = "SELECT e.nombre_comercial_empresa, e.cod_interno_empresa from empresa e, pusuemp p
																	where e.cod_interno_empresa = p.cod_empresa and p.cod_usuario = '$usuario_actual' order by e.nombre_comercial_empresa asc;";
																	$result = mysql_query($consulta);
																	while($row = mysql_fetch_array($result)){
																		echo "<option value=".$row['cod_interno_empresa'].">".utf8_encode($row['nombre_comercial_empresa'])."</option>";
																	}
																?>
															</select>
														</td>
														<td>
															<p>Cliente:</p>
															<select class = "entradas_bordes" id = "cliente_rtareas" >
															</select>
														</td>
														<td>
															<p>Departamento:</p>
															<select class = "entradas_bordes" id = "depto_tareas"></select>
														</td>
														<td>
															<p>Tareas:</p>
															<select class = "entradas_bordes" id = "tareas_tareas">
																<option value = "2">TODAS</option>
																<option value = "1">CONTESTADAS</option>
																<option value = "0">PENDIENTES</option>
															</select>
														</td>
														<td>
															<p>Desde:</p>
															<?php echo "<input style = 'width:110px;' type = 'text' class = 'entradas_bordes' name = 'fdesde_tareas' value = '".date('Y-m-d')."' id = 'fdesde_tareas' />"?>
														</td>
														<td>
															<p>Hasta:</p>
															<?php echo "<input style = 'width:110px;' type = 'text' name = 'fhasta_tareas' value = '".date('Y-m-d')."' id = 'fhasta_tareas' />"?>
														</td>
														<td>
															<img id = "generar_reporte_tareas" src = "../images/iconos/icon-20.png" class = 'mano botones_opciones'/>
														</td>
														<td >
															<a href = "download_reporte_tareas.php"><img src = "../images/iconos/icon-27.png" class = 'mano botones_opciones'/></a>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr >
											<td width = '100%'>
												<div id = "contenedor_rrporte_tareas" class = 'contenedor_scroll_reportes' style = 'overflow:scrollheight:300px;width:100%;padding-right:50px;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'></div>
											</td>
										</tr>
									</table>
								
									<table width = '100%' class = 'reporte_colpatria barra_busqueda2'>
										<tr>	
											<td style = 'padding-left:20px;'>
												<p>Desde:</p>
												<input type = 'text'  id = 'fdesde_ot_c' class = "entradas_bordes" value = "<?php echo date('Y-m-d'); ?>"/>
											</td>
											<td style = 'padding-left:20px;'>
												<p>Hasta:</p>
												<input type = 'text'  id = 'fhasta_ot_c' class = "entradas_bordes" value = "<?php echo date('Y-m-d'); ?>"/>
											</td>
											<td style = 'padding-left:20px;vertical-align:center;'>
												<img id = "generar_reporte_ot_c" onclick = 'grafica_colpatria()'src = "../images/iconos/icon-20.png" class = 'mano botones_opciones'/>
											</td>
										</tr>
										<tr><td></td></tr>
										<tr>
											<td colspan = '2' width = '52%' style = 'padding-left:20px;'>
												<div id = 'chart_div_ots_eje' class = 'contenedor_scroll_reportes' style = 'overflow-y:hidden;overflow:hidden;background-color:rgb(232, 232, 232);border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'></div>
											</td>
											
											<td  colspan = '2' width = '49%'>
												<div id = "tabla_divs_ots_eje" class = 'contenedor_scroll_reportes' style = 'overflow:scroll;background-color:rgb(232, 232, 232);border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'></div>
											</td>
										</tr>
										<tr>
											<td  colspan = '2' width = '52%' style = 'padding-left:20px;'>
												<div id = 'chart_div_ots_pro' class = 'contenedor_scroll_reportes' style = 'overflow-y:scroll;overflow:hidden;background-color:rgb(232, 232, 232);border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'></div>
											</td>
											
											<td  colspan = '2' width = '49%'>
												<div id = "tabla_divs_ots_pro" class = 'contenedor_scroll_reportes' style = 'overflow:scroll;background-color:rgb(232, 232, 232);border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'></div>
											</td>
										</tr>
										<tr>
											<td  colspan = '2' width = '52%' style = 'padding-left:20px;'>
												<div id = 'chart_div_tareas_eje' class = 'contenedor_scroll_reportes' style = 'overflow-y:scroll;overflow:hidden;background-color:rgb(232, 232, 232);border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'></div>
											</td>
											
											<td width = '49%' colspan = '2'>
												<div id = "tabla_divs_tareas_eje" class = 'contenedor_scroll_reportes' style = 'width:100%;overflow:scroll;background-color:rgb(232, 232, 232);border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'></div>
											</td>
										</tr>
										<tr>
											<td  colspan = '2' width = '52%' style = 'padding-left:20px;'>
												<div id = 'chart_div_tareas_pro' class = 'contenedor_scroll_reportes' style = 'overflow-y:scroll;overflow:hidden;background-color:rgb(232, 232, 232);border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'></div>
											</td>
											<td colspan = '2'  width = '49%'>
												<div id = "tabla_divs_tareas_pro" class = 'contenedor_scroll_reportes' style = 'overflow:scroll;background-color:rgb(232, 232, 232);border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'></div>
											</td>
										</tr>
									</table>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
				<div id = "desc_ot" class = 'ventana'>
				</div>
			</div>
			<div id = "tarea_desc" class = 'ventana'>				
			</div>
			
			
			
			
			<!-- FORMULARIO PARA CREAR TAREAS-->
			<div id = "crear_tarea" title="Create new user" class = 'ventana'>
				<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
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
											<span class = 'mensaje_bienvenida' id = 'mensaje_crear_tarea'>CREAR TAREA </span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right' >
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img id = 'cerrar_ventana_crear_tarea' src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano' title = 'Cerrar Ventana'/>
										</td>
									</tr>
								</table>
							</td>
						</tr>
				</table>
				<div class ="scroll_nueva_ventana2">					
					<form enctype="multipart/form-data" id="formuploadajax" method="post"><table class = "tabla_nuevos_datos2" width = '100%'>
						<tr>
							<td width = '32%' style = 'padding-left:50px;vertical-align:top;'>
								<p>Seleccione un Departamento:</p>
								<select class = "entradas_bordes" id = "depto_ct" name = "depto_ct" onchange = 'cargar_enviar_a()' >
								</select>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td width = '32%' >
								<p>Responsable(s) del Departamento:</p>
								<div style = 'overflow:scroll;height:100px;border:1px solid black;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;font-size:12px;' id = 'responsable_ctx'></div>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td width = '32%' style = 'padding-right:50px;'>			
								<p>Seleccione Por lo menos un Asignado:</p>
								<div style = 'overflow:scroll;height:100px;border:1px solid black;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;font-size:12px;'  id = 'asignado_ctx'></div>
							</td>
						</tr>
						<!--
							onclick = '$("#ui-datepicker-div,.ui-datepicker .ui-widget .ui-widget-content .ui-helper-clearfix .ui-corner-all").css({"width":$("#fechap_ct").width()});'
						 -->
						<tr>
							<td width = '32%' style = 'padding-left:50px;'>
								<p>Seleccione la Fecha de Entrega:</p>
								<input  class = "entradas_bordes" type = "text" name = "fechap_ct" id = "fechap_ct" onclick = '$("#ui-datepicker-div").css({"min-width":$("#fechap_ct").width()});'/>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td width = '32%' >
								<table width = '100%'>
									<tr>
										<td>
											<p>Hora:</p>
										</td>
										<td>
											<p>Minutos:</p>
										</td>
										<td>
											<p>Formato:</p>
										</td>
									</tr>
									<tr>
										<td>
											<select id = "hora_ct"><?php echo $horas;?></select>
										</td>
										<td>
											<select id = "minuto_ct"><?php echo $minutos;?></select>
										</td>
										<td>
											<select id = "formato_ct"><option value = "AM">AM</option><option value = "PM">PM</option></select>
										</td>
									</tr>
								</table>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td width = '32%' style = 'padding-right:50px;'>
								<p>Seleccione el Tipo de Tarea:</p>
								<select id = "tipo_tarea_ct"  class = "entradas_bordes">
									<option value = "0" selected>[SELECCIONE]</option>
								<?php
									$tipo = "select codigo_tipotarea, name_ttarea from tipo_tarea order by name_ttarea asc";
									$re = mysql_query($tipo);
									while($t = mysql_fetch_array($re)){
										echo "<option value = ".$t['codigo_tipotarea'].">".strtr(strtoupper(utf8_encode($t['name_ttarea'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ") ."</option>";
									}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td width = '32%' style = 'padding-left:50px;'>
								<p>Ingrese el título del Trabajo:</p>
								<input  class = "entradas_bordes" type = "text" name = "trabajo_ct" id = "trabajo_ct" />
							</td>
							<td class = 'separator' width = '2%'></td>
							<td width = '32%' id = 'campo_adicional_colpatria_ejecutivo'>
								
							</td>
						</tr>
						<tr>
							<td width = '32%' style = 'padding-left:50px;'>
								<p>Describa el Trabajo:</p>
								<textarea class = "entradas_bordes" rows = "5" cols = "60" id = "descripcion_ct">
								
								</textarea>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td width = '32%' style = 'display:none;'>
								<p>Describa la razón de Demora:</p>
								<textarea class = "entradas_bordes" rows = "5" cols = "60" id = "razondemora_ct">
								
								</textarea>
							</td>
							<td width = '32%' >
								<p>Seleccione el archivo a Subir:</p>
								<input type = "file" class = "entradas_bordes" id = 'archivo_subir_tarea_crear' name = 'multiple_archivos_tareas[]' multiple />
								<div style = 'overflow:scroll;height:100px;border:1px solid black;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;' id = 'contenedor_archivos_enviar' height:'180px'>
									<table id = 'lista_archivos_crear_tareas' style = 'width:100%;font-size:13px;'></table>
								</div>
							</td>
						</tr>
						<tr><td></br></td></tr>
						<tr>
							<td align = 'center' colspan = '5'>
								<span class = "botton_verde mano"  id = "cerrar_ingreso_ct">Cancelar</span>
								<span class = "botton_verde mano" id = "enviar_ct" name = "enviar_ct" >Crear Tarea</span>		
							</td>
						</tr>
					</form></table>
				</div>
			</div>

			<div id = 'adjuntar_ppto_tarea' class = 'ventana'>
				<table width = '100%' style = 'padding-right:50px;padding-left:50px;'>
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
											<span class = 'mensaje_bienvenida' >ADJUNTAR PPTO</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right' >
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img onclick = '$("#adjuntar_ppto_tarea").dialog("close");' src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano' title = 'Cerrar Ventana'/>
										</td>
									</tr>
								</table>
							</td>
						</tr>
				</table>
				</br>
				<table width = '100%' class = 'tabla_nuevos_datos2' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td>
							<p>Seleccione un Ppto:</p>
						</td>
					</tr>
				</table>
				<div style = 'overflow:scroll;' height = '350px' width = '100%' id = 'contenedor_adj_ppto'>

				</div>
				<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td align = 'center'>
							<span class = 'botton_verde mano' onclick = '$("#adjuntar_ppto_tarea").dialog("close");'>CANCELAR</span>
							<span class = 'botton_verde mano' onclick = 'adjuntar_ppto_meth()'>ADJUNTAR PPTO</span>
						</td>
					</tr>
				</table>
			</div>
			
			<!-- FORMULARIO PARA RESPONDER-->
			<div id = "responder_tarea" title="Create new user" class = 'ventana'>
				<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
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
											<span class = 'mensaje_bienvenida' id = 'mensaje_respon_tarea'>RESPONDER TAREA</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right' >
								<table width = '100%'>
									<tr>
										<td align = 'center'>
											<img id = 'adjuntar_ppto' src = '../images/iconos/icon-22xx.png' class = 'iconos_opciones mano' title = 'Adjuntar Ppto' onclick ='abrir_ventana_adjt_ppto()'/>
										</td>
										<td align = 'center'>
											<img id = 'cerrar_ventana_responder_tarea' src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano' title = 'Cerrar Ventana'/>
										</td>
									</tr>
								</table>
							</td>
						</tr>
				</table>
				<div class ="scroll_nueva_ventana2">					
					<table class = "tabla_nuevos_datos2" width = '100%'>
						<tr>
							<td width = '32%' style = 'padding-left:50px;vertical-align:top;'>
								<p>Seleccione un Departamento:</p>
								<select class = "entradas_bordes" id = "r_depto_ct" onchange = 'cargar_enviar_a2()' >
								</select>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td width = '32%' >
								<p>Responsable(s) del Departamento:</p>
								<div style = 'overflow-y:scroll;height:100px;border:1px solid black;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;font-size:12px;' id = 'r_responsable_ctx'></div>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td width = '32%' style = 'padding-right:50px;'>			
								<p>Seleccione Por lo menos un Asignado:</p>
								<div style = 'overflow-y:scroll;height:100px;border:1px solid black;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;font-size:12px;'  id = 'r_asignado_ctx'></div>
							</td>
						</tr>
						<tr>
							<td width = '32%' style = 'padding-left:50px;'>
								<p>Seleccione la Fecha de Entrega:</p>
								<input  class = "entradas_bordes" type = "text"  id = "r_fechap_ct" />
							</td>
							<td class = 'separator' width = '2%'></td>
							<td width = '32%' >
								<table width = '100%'>
									<tr>
										<td>
											<p>Hora:</p>
										</td>
										<td>
											<p>Minutos:</p>
										</td>
										<td>
											<p>Formato:</p>
										</td>
									</tr>
									<tr>
										<td>
											<select id = "r_hora_ct"><?php echo $horas;?></select>
										</td>
										<td>
											<select id = "r_minuto_ct"><?php echo $minutos;?></select>
										</td>
										<td>
											<select id = "r_formato_ct"><option value = "AM" selected>AM</option><option value = "PM">PM</option></select>
										</td>
									</tr>
								</table>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td width = '32%' style = 'padding-right:50px;'>
								<p>Seleccione el Tipo de Tarea:</p>
								<select id = "r_tipo_tarea_ct"  class = "entradas_bordes">
								<option value = "0">[SELECCIONE]</option>
								<?php
									$tipo = "select codigo_tipotarea, name_ttarea from tipo_tarea order by name_ttarea asc";
									$re = mysql_query($tipo);
									while($t = mysql_fetch_array($re)){
										echo "<option value = ".$t['codigo_tipotarea'].">".strtoupper(utf8_encode($t['name_ttarea'])) ."</option>";
									}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td width = '32%' style = 'padding-left:50px;'>
								<p>Ingrese el título del Trabajo</p>
								<input  class = "entradas_bordes" type = "text"  id = "r_trabajo_ct" />
							</td>
						</tr>
						<tr>
							<td width = '32%' style = 'padding-left:50px;'>
								<p>Describa el Trabajo:</p>
								<textarea class = "entradas_bordes" rows = "5" cols = "60" id = "r_descripcion_ct">
								
								</textarea>
							</td>
							<td width = '32%' style = 'display:none;'>
								<p>Describa la razón de Demora:</p>
								<textarea class = "entradas_bordes" rows = "5" cols = "60" id = "r_razondemora_ct">
								
								</textarea>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td width = '32%' style = 'padding-right:50px;'>
								<p>Seleccione el archivo a Subir:</p>
								<input type = "file" class = "entradas_bordes" id = 'r_archivo_subir_tarea_crear' name = 'r_archivo_subir_tarea_crear[]' multiple />
								<div style = 'overflow-y:scroll;height:100px;border:1px solid black;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;' id = 'contenedor_archivos_enviar'>
									<table id = 'r_lista_archivos_crear_tareas' style = 'width:100%;'></table>
								</div>								
							</td>
						</tr>
						<tr><td></br></td></tr>
						<tr>
							<td align = 'center' colspan = '5'>
								<span class = "botton_verde mano"  id = "r_cerrar_ingreso_ct">Cancelar</span>
								<span class = "botton_verde mano" id = "r_enviar_ct" name = "r_enviar_ct" >Responder Tarea</span>										
								<span class = "botton_verde mano"  id = "r_terminar_tarea">Terminar Tarea</span>
							</td>
						</tr>
					</table>
				</div>
			</div>
			
			<!-- FORMULARIO PARA CREAR UNA NUEVA OT-->
			<div id = "crear_ot" title="Create new user" class = 'ventana'>
				<table width = '100%' style = 'padding-left:50px;padding-left:right:50px;'>
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
										<span class = 'mensaje_bienvenida'>DATOS NUEVA OT</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right' >
							<table width = '100%'>
								<tr>
									<td align = 'center'>
										<img id = 'cerrar_ventana_not' src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano' />
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<div style = 'overflow:scroll;height:80%;padding-left:50px;padding-right:50px;'>
					</br>
					<table class = "tabla_nuevos_datos" width = '100%'>
						<tr>
							<td width = '48%'>
								<p>EMPRESA:</p>
									<select class = "entradas_bordes" id = "grupo_empresas" name = "grupo_empresas" >
									<option>...</option>
									<?php
										$consulta = "SELECT distinct e.nombre_comercial_empresa, e.cod_interno_empresa 
										from empresa e, pusuemp p
											where e.cod_interno_empresa = p.cod_empresa and p.cod_usuario = '$usuario_actual' order by e.nombre_comercial_empresa asc;";
										$result = mysql_query($consulta);
										while($row = mysql_fetch_array($result)){
											echo "<option value=".$row['cod_interno_empresa'].">".utf8_encode($row['nombre_comercial_empresa'])."</option>";
										}
									?>
									</select>
							</td>
							<td class = 'separator' width = '2%'></td>
							<td width = '48%'>
								<p>CLIENTE:</p>
								<select class = "entradas_bordes" id = "cliente" name = "cliente" >
									<option>...</option>
								</select>
							</td>
						</tr>
						<tr>
							<td >
								<p>PRODUCTO:</p>
								<select class = "entradas_bordes" id = "pro_cliente" name = "pro_cliente">
									<option>...</option>
								</select>
							</td>
							<td class = 'separator'></td>
							<td >
								<p>DIRECTOR:</p>
								<select class = "entradas_bordes" id = "ot_director" name = "ot_director">
									<?php
										$select = "select e.nombre_empleado, p.director
										from usuario u,empleado e, pdirector p 
										where p.director = u.idusuario and
										p.usuario ='$usuario_actual' and u.pk_empleado = e.documento_empleado";
										$result = mysql_query($select);
										while($row = mysql_fetch_array($result)){
											$dir = ($row['director']);
											echo "<option value = '$dir'>".utf8_encode($row['nombre_empleado'])."</option>";
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td >
								<p>EJECUTIVO:</p>
								<select class = "entradas_bordes" id = "ejecutivo" name = "ejecutivo">
									<?php
										echo "<option value = '$usuario_actual'>$nombre_usuario</option>";
									?>
								</select>
							</td>
							<td class = 'separator'></td>
							<td >
								<p>TIPO DE BRIEF:</p>
								<select class = "entradas_bordes" id = "tipo_brief" name = "tipo_brief">
									<option value = "...">...</option>
									<option value = "1">CLIENTE</option>
									<option value = "2">CREATIVO BTL </option>
									<option value = "3">CREATIVO CRM</option>
									<option value = "4">CREATIVO ATL</option>
									<option value = "5">CREATIVO TRADE</option>
									<option value = "6">CREATIVO TACTICO</option>
									<option value = "0">NO APLICA</option>
								</select>
							</td>
						</tr>
						<div >
							<tr class = "datos_colpatria"  >
								<td>
									<p>Número de Solicitud:</p>
									<input id = "bc_num_solicitud" name = "bc_num_solicitud" class = "entradas_bordes"/>
								</td>
								<td class = 'separator'></td>
								<td>
									<p>Nombre Solicitud:</p>
									<input id = "bc_nombre_solicitud" name = "bc_nombre_solicitud" class = "entradas_bordes">
								</td>
							</tr>
							<tr class = "datos_colpatria">
								<td>
									<p>Profesional Colpatria:</p>
									<select id = "bc_profesional" class = "entradas_bordes">
										<?php
											$colp1 = "select * from pro_colpatria order by name_profesional asc";
											$rcol1 = mysql_query($colp1);
											$imp = "<option value = '...'>...</option>";
											while($row = mysql_fetch_array($rcol1)){
												$imp .="<option value=".$row['codigo_profesional'].">". strtoupper(utf8_encode($row['name_profesional']))."</option>";
											}
											echo $imp;
										?>
									</select>
								</td>
								<td class = 'separator'></td>
								<td>
									<p>Tipo de Pieza:</p>
									<select id = "bc_tipopieza" class = "entradas_bordes">
									<?php
										$colp2 = "select * from  tipo_pieza";
										$rcol2 = mysql_query($colp2);
										$imp = "<option value = '...'>...</option>";
										while($row = mysql_fetch_array($rcol2)){
											$imp .="<option value=".$row['codigo_tpieza'].">". utf8_encode($row['name_tpieza'])."</option>";
										}
										echo $imp;
									?>
									</select>
								</td>
							</tr>
							<tr class = "datos_colpatria" >
								<td>
									<p>Objetivo Trabajo:</p>
									<select id = "bc_objtrabajo" class = "entradas_bordes">
										<?php
											$colp3 = "select * from objtrabajo";
											$rcol3 = mysql_query($colp3);
											$imp = "<option value = '...'>...</option>";
											while($row = mysql_fetch_array($rcol3)){
												$imp .="<option value=".$row['codigo_objtrabajo'].">". utf8_encode($row['name_otrabajo'])."</option>";
											}
											echo $imp;
										?>
										</select>
								</td>
								<td class = 'separator'></td>
								<td>
									<p>Medio:</p>
									<select id = "bc_medio" class = "entradas_bordes">
									<?php
										$colp4 = "select * from medio";
										$rcol4 = mysql_query($colp4);
										$imp = "<option value = '...'>...</option>";
										while($row = mysql_fetch_array($rcol4)){
											$imp .="<option value=".$row['codigo_medio'].">".utf8_encode($row['name_medio'])."</option>";
										}
										echo $imp;
									?>
									</select>
								</td>
							</div>
						</tr>
						<tr>
							<td >
								<P>REFERENCIA</P>
								<input class = "entradas_bordes" type = "text" name = "referencia" id = "referencia" value = "" width = '98%'/>
							</td>
							<td class = 'separator'></td>
							<td>
								<P>DESCRIPCION</P>
								<textarea class = "entradas_bordes" id = "descripcion" name ="descripcion" rows = "5" cols = "40"></textarea>
							</td>
						</tr>
						<tr>
							<td></br></td>
						</tr>
						<tr>
							<td align = "center" colspan = '3'>
								<span class = "botton_verde mano"  id = "cerrar_ingreso_ot" >Cancelar</span>
								<span class = "botton_verde mano" id = "enviar_ot" name = "enviar_ot" style = 'display:none;' >Crear OT</span>
								<span class = "botton_verde mano" id = "siguiente_brief" style = 'display:none;' onclick = "abrir_brief()">BRIEF</span>
							</td>
						</tr>
					</table>
				</div>
			</div>
			
			<div id = 'razon_cancelacion_ot' class = 'ventana'>
				<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
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
											<span class = 'mensaje_bienvenida' id = 'mensaje_cierre_ot'>CERRAR OT</span>
										</td>
									</tr>
								</table>
						</td>
						<td align = 'right' >
							<table width = '100%'>
								<tr>
									<td align = 'center'>
										<img title = 'Cerrar Ventana' onclick = "$('#razon_cancelacion_ot textarea').val('');$('#razon_cancelacion_ot').dialog('close');" src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano' />
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<span id = 'id_pk_razon_cancelacion' class = 'hidde'></span>
				<table width = '100%' class = 'tabla_nuevos_datos2' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td>
							<p>Indique la razón del cierre de la OT:</p>
							<textarea cols = '80' rows = '18' id = 'razon_text_ot'></textarea>
						</td>
					</tr>
					<tr>
						<td align = 'center'>
							</br>
							<span class ='botton_verde mano' id = 'cerrar_ot_razon'>Cerrar OT</span>
						</td>
					</tr>
				</table>
			</div>
			
			<div id = 'adicionar_brief_nuevo_ot' class = 'ventana'>
				<table width = '100%'style = 'padding-left:50px;padding-right:50px;' >
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
										<span class = 'mensaje_bienvenida mensaje_brief_consulta' >BRIEF NUEVO</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right' >
							<table width = '100%'>
								<tr>
									<td align = 'center'>
										<img onclick = '$("#adicionar_brief_nuevo_ot").dialog("close");$("#tipo_briefx").val("...");$("#adicionar_brief_nuevo_ot textarea, #tipo_priyecto_crm, #fecha_entrega_creativa_briefx, #desarrollador_por_briefx").val("");'src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano'  title = 'Adicionar Brief'/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<form id ='contenedor_datos_brief_adicional'>
				<table width = '100%' class = 'tabla_nuevos_datos2' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td >
							<p>Tipo de Brief:</p>
							<select class = "entradas_bordes" id = "tipo_briefx" name = "tipo_briefx">
								<option value = "...">...</option>
								<option value = "1">CLIENTE</option>
								<option value = "2">CREATIVO BTL </option>
								<option value = "3">CREATIVO CRM</option>
								<option value = "4">CREATIVO ATL</option>
								<option value = "5">CREATIVO TRADE</option>
								<option value = "6">CREATIVO TACTICO</option>
							</select>
						</td>
						<td style = 'display:none;' class = 'nbriefcrm'>
							<p>* Tipo Proyecto:</p>
							<input type = 'text'  name ='tipo_priyecto_crm' id ='tipo_priyecto_crm'/>
						</td>
						<td >
							<p>* Producto o Marca:</p>
							<input type = 'text'  name ='producto_marca_brief_x' id ='producto_marca_brief_x' readonly />
						</td>
						<td >
							<p>* Desarrollado Por:</p>
							<input type = 'text'  name ='desarrollador_por_briefx' id ='desarrollador_por_briefx' value = '' />
						</td>
						<td class = 'separator'></td>
						<td >
							<p>* Fecha de Elaboración:</p>
							<input type = 'text'  id = 'fecha_elaboracion_brief_x'name ='fecha_elaboracion_brief_x' style = 'width:120px;' value = '<?php echo date("Y-m-d");?>' readonly/>
						</td>
						<td >
							<p>* Fecha de Entrega Creativa:</p>
							<input type = 'text'  id = 'fecha_entrega_creativa_briefx'name ='fecha_entrega_creativa_briefx' style = 'width:120px;'/>
						</td>
					</tr>
				</table>
				
				<table class ='tabla_nuevos_datos2' width = '100%'  style = 'padding-left:50px;padding-right:50px;'>
					
					<tr class = 'nbriefcrm'>
						<td colspan = '2' width = '33.3%' >
							<p class = 'tooltip mano'>1. ANTECEDENTES:
								<span>Situación actual, problema que debemos resolver.<span>
							</p>
							<textarea rows = '5' cols ='5' name ='rpta1_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>2. ¿A QUIÉN LE VAMOS A HABLAR?
								<span>Descripción de la audiencia y su perfil, quienes son, como son, que esperan</span>
							</p> 
							<textarea rows = '5' cols ='5' name = 'rpta2_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>3. OBJETIVO DE MERCADEO:
								<span>¿Qué queremos lograr: ventas, posicionamiento, generación de Top of Heart?</span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta3_briefcrm'></textarea>
						</td>
					</tr>
					
					<tr class = 'nbriefcrm'>
						<td colspan = '2' width = '33.3%' >
							<p class = 'tooltip mano'>4. POSICIONAMIENTO:
								<span>Idea de marca o atributos de producto a destacar.<span>
							</p>
							<textarea rows = '5' cols ='5' name ='rpta4_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>5. OBJETIVO DE COMUNICACIÓN:
								<span>¿Qué queremos que la comunicación transmita al consumidor final?</span>
							</p> 
							<textarea rows = '5' cols ='5' name = 'rpta5_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>6. ACTITUD:
								<span>¿Qué queremos que piense el público como resultado de la comunicación?</span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta6_briefcrm'></textarea>
						</td>
					</tr>
					
					<tr class = 'nbriefcrm'>
						<td colspan = '2' width = '33.3%' >
							<p class = 'tooltip mano'>7. COMPORTAMIENTO DESEADO:
								<span>¿Qué queremos que haga el público como resultado de la comunicación?<span>
							</p>
							<textarea rows = '5' cols ='5' name ='rpta7_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>8. ¿ A QUIEN VA DIRIGIDA ESTA CAMPAÑA DIRECTA?
								<span></span>
							</p> 
							<textarea rows = '5' cols ='5' name = 'rpta8_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>9. DESCRIPCION ACTIVIDAD:
								<span>Mecánica a utilizar y detalles generales, piezas.</span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta9_briefcrm'></textarea>
						</td>
					</tr>
					
					<tr class = 'nbriefcrm'>
						<td colspan = '2' width = '33.3%' >
							<p class = 'tooltip mano'>10. TONO Y MANERA:
								<span><span>
							</p>
							<textarea rows = '5' cols ='5' name ='rpta10_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>11. MANDATORIOS:
								<span></span>
							</p> 
							<textarea rows = '5' cols ='5' name = 'rpta11_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>12. PIEZAS CREATIVAS:
								<span></span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta12_briefcrm'></textarea>
						</td>
					</tr>
					<tr class = 'nbriefcrm'>
						<td colspan = '2' width = '33.3%' >
							<p class = 'tooltip mano'>13. COMO MEDIREMOS LOS RESULTADOS:
								<span>Cronogramas, creatividad, ventas, cantidad de diseños<span>
							</p>
							<textarea rows = '5' cols ='5' name ='rpta13_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>14. OBSERVACIONES:
								<span></span>
							</p> 
							<textarea rows = '5' cols ='5' name = 'rpta14_briefcrm'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							
						</td>
					</tr>
					
					<tr class = 'nbriefall'>
						<td colspan = '2' width = '33.3%' >
							<p class = 'tooltip mano'>1. ¿Por qué se va hacer la actividad ?
								<span>¿Cuál es la situación por la que pasa la marca?, se describe brevemente que pasa con el entorno competitivo-mercado, lo que se ha hecho en el pasado?<span>
							</p>
							<textarea rows = '5' cols ='5' name ='rpta1_briefx'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>2. Descripción del Producto:
								<span>Describa el producto o servicio, cuáles son los atributos y sus características.</span>
							</p> 
							<textarea rows = '5' cols ='5' name = 'rpta2_briefx'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>3. Beneficio del Producto:
								<span>Cómo los atributos del producto se convierten en beneficios para el consumidor</span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta3_briefx'></textarea>
						</td>
					</tr>
					<tr class = 'nbriefall'>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>4. Objetivo de Mercadeo:
								<span>Qué tengo que solucionar en terminos de Mercadeo, Cuál es la oportunidad que tiene la marca? Ventas-Unidades-Posiconamiento, Leads.</span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta4_briefx'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>5. Objetivo de Comunicación.
								<span>¿Qué queremos que la audiencia piense y haga ?</br>La tarea de comunicación: Qué queremos que la gente piense y haga despues de ver la comunicación. 
								Es el resultado ideal de la comunicación esperado y confirmado en el comportamiento de las personas. Que queremos que la gente piense o haga con esta campaña o pieza creativa?  </span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta5_briefx'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>6. ¿A quién va dirigida esta Campaña ?
								<span>A quién/quiénes van dirigidos los esfuerzos de comunicación. Una breve descripcion que incluya insights, estamos describiendo personas, no cifras.</span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta6_briefx'></textarea>
						</td>
					</tr>
					<tr class = 'nbriefcreativos'>
						<td id = 'tabla_trafico_creativox' colspan = '8' >
							<table width = '100%' >
								<tr>
									<td width = '22%'>
										<p class = 'tooltip mano'>Insigh Clave:
											<span>Son barreras o motivaciones o creencias universales que definen el comportamiento del consumidor.</span>
										</p>
										<textarea rows = '5' cols ='5' name = 'Insigh_Clavex'></textarea>
									</td>
									<td class = 'separator'></td>
									<td width = '22%'>
										<p class = 'tooltip mano'>Beneficio:
											<span>¿Qué tiene la marca o servicio para solucionar el Insight?</span>
										</p>
										<textarea rows = '5' cols ='5' name = 'beneficio_creativox'></textarea>
									</td>
									<td class = 'separator'></td>
									<td width = '22%'>
										<p class = 'tooltip mano'>Soporte:
											<span>Lo que hace creíble lo que hay que decir. Qué hace creíble el mensaje que le voy a dar a la audiencia.</span>
										</p>
										<textarea rows = '5' cols ='5' name = 'soporte_creativox'></textarea>
									</td>
									<td class = 'separator'></td>
									<td width = '22%'>
										<p class = 'tooltip mano'>Concepto Estratégico:
											<span>BIG IDEA, La carne para el creativo:  En una sola frase definimos cuál es ese único mensaje que hará que las personas 'hagan' algo por la marca.</span>
										</p>
										<textarea rows = '5' cols ='5' name = 'concepto_estrategicox'></textarea>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr class = 'nbriefall'>
						<td colspan = '2' width = '33.3%' class = 'tooltip mano'>
							<p >7. Entregables:</p>
							<textarea rows = '5' cols ='5' name = 'rpta7_briefx'></textarea>
							<span>¿Dónde lo vamos a comunicar? Acciones y/o medios. Dependiendo de la unidad de negocio se debe ampliar esta información con hoja anexa.</span>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>8. Mandatarios Ejecucionales:
							<span>Cosas que son obligatorias al momento de desarrollar la acción o campaña en términos de tono, manera, lo que es y no es la marca.</span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta8_briefx'></textarea>
						</td>
						<td class = 'separator'></td>
						<td colspan = '2' width = '33.3%'>
							<p class = 'tooltip mano'>9. Fecha al Aire:
								<span>Cuándo debe estar este proyecto, trabajo, campaña al aire en medios.</span>
							</p>
							<textarea rows = '5' cols ='5' name = 'rpta9_briefx'></textarea>
						</td>
					</tr>
					<tr class = 'nbriefall'>
						<td colspan = '2' width = '33.3%' class = 'tooltip mano'>
							<p class = 'tooltip mano'>10. Presupuesto:	</p>
							<textarea rows = '5' cols ='5' name = 'rpta10_briefx'></textarea>
							<span>Cuánto dinero tenemos para estar aterrizados desde el principio</span>
						</td>
						<td class = 'separator'></td>
					</tr>
					<tr>
						<td></br></td>
					</tr>
					<tr>
						<td colspan = '8' align = 'center'>
							<span class = 'botton_verde mano' id = 'cancelar_brief_x' onclick = '$("#adicionar_brief_nuevo_ot").dialog("close");'>CANCELAR</span>
							<span class = 'botton_verde mano' id = 'crear_ot_brief_x'>CREAR BRIEF</span>
						</td>
					</tr>
				</table>
				</form>
			</div>
				
			<div id = 'ventana_briefs' class = 'ventana'>
				<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
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
										<span class = 'mensaje_bienvenida mensaje_brief_consulta' >BRIEF CLIENTE</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right' >
							<table width = '100%'>
								<tr>
									<td align = 'center'>
										<img id = 'abrir_nuevo_brief'src = '../images/iconos/icon-28.png' class = 'iconos_opciones mano'  title = 'Adicionar Brief'/>
									</td>
									<td align = 'center'>
										<img onclick = 'cerrar_ventanas("ventana_briefs")'src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano' />
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				
				</br>
				<div id = 'contenedor_listado_brief' class = 'contenedores_resultados' style = 'background-color:white;overflow:scroll;height:300px;width:100%;'>
				</div>
			</div>
			
			<div id = 'ventana_informes' class = 'ventana'>
				<table width = '100%'  style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td width = '96%' align = 'left'>
							<table width = '100%'>
								<tr>
									<td align = 'left'>
										<?php echo  $emp->mostrar_logo_empresa($gestion->mostrar_empresa_empleado()); ?>
									</td>
								</tr>
								<tr>
									<td align = 'left'>
										<span class = 'mensaje_bienvenida' >INFORMES DE ENTREVISTA</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right' >
							<table width = '100%'>
								<tr>
									<td align = 'center'>
										<img onclick = 'abrir_nuevo_informe_ie()'src = '../images/iconos/icon-29.png' class = 'iconos_opciones mano'  title = 'Adicionar Informe de Entrevista'/>
									</td>
									<td align = 'center'>
										<img onclick = 'cerrar_ventanas("ventana_informes")'src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano' />
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				
				</br>
				<div id = 'contenedor_listado_ie' class = 'contenedores_resultados' style = 'background-color:white;overflow:scroll;height:300px;width:100%;'>
				</div>
			</div>
				
				
				
				<!--VENTANA TRÁFICO-->
				<div id = "cv_trafico" class = 'ventana'>
					<table width = '100%' style = 'padding-right:50px;padding-left:50px;'>
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
											<span class = 'mensaje_bienvenida'>TRÁFICO</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right' >
								<table width = '100%'>
									<tr>
										<td class = 'class_brief'>
											
										</td>
										<td class = 'class_ie'>
											
										</td>
										<td class = 'class_tras'>
											
										</td>
										<td align = 'center'>
											<img id = 'cerrar_ventana_trafico' src = '../images/iconos/icon-18.png' class = 'iconos_opciones mano' />
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					</br>
					<div id = "contenedor_datos_trafico" style = 'overflow:scroll;width:100%;' style = 'padding-left:50px;padding-right:50px;'>
						<div id = 'contenedor_ot_seleccionada' style = 'padding-left:50px;' >
							
						</div>
						<table class  = "tabla_nuevos_datos" width = "100%" style = 'font-size:auto;padding-left:50px;padding-right:50px;'>
							<tr>
								<td>
									<span class = "mostrar_datos" id = "ot">
										OTS
									</span>
								</td>
								<td>
									<div id = "ot_criterio">
										CRITERIO DE BÚSQUEDA
									</div>
								</td>
								
								<td> 
									<select id = "criterio_busqueda" name = "criterio_busqueda" width = '200px'>
										<option value = "cliente">Cliente</option>
										<option value = "director">Director</option>
										<option value = "ejecutivo">Ejecutivo</option>
										<option value = "numero">Número</option>
										<option value = "producto">Producto</option>
										<option value = "referencia">Referencia</option>
										
										
									</select>
								</td>
								<td>
									<select name = "ano" id ="ano">
											<?php
												for($i = date("Y"); $i >= 2015;$i--){
													echo "<option value =".$i.">".$i."</option>";
												}
												/*while($r1 = mysql_fetch_array($result1)){
													echo "<option value =".$r1['year_ot'].">".$r1['year_ot']."</option>";
												}*/
											?>
									</select>
									
								</td>
								<td style = 'padding-right:20px;'>
									<div id = "ot_buscar">
										<input type = "text" name ="buscar" id ="buscar" placeholder = "Ingrese el Texto"/>
									</div>
								</td>
								<td>
									<select id = 'estado'>
										<option value = '' >Todas</option>
										<option value = '1' selected>Activas</option>
										<option value = '12' >Cerradas</option>
									</select>
								</td>
								<td>
									<a href = "#"id = "bus" onclick = "buscar_ots()">
										<img src = '../images/iconos/icon-05.png' class = 'botones_opciones mano' title = 'Buscar OTs' />
									</a>
								</td>
								</td>
								<td align = 'right'>
									<?php
										$gestion->opcion_crear_ot($_SESSION["codigo_usuario"]);
									?>
								</td>
							</tr>
						</table>
						
						<div id = "contenedor_resultados_ot" class = 'contenedores_resultados' style = 'overflow:scroll;' width = 'auto'>
							<table width = '100%' class = 'tablas_muestra_datos_tablas_trafico' style = 'padding-left:50px;padding-right:50px;'>
								<tr>
									<th>I</th>
									<th>NUMERO</th>
									<th>REFERENCIA</th>
									<th>EJECUTIVO</th>
									<th>DIRECTOR</th>
									<th>CLIENTE</th>
									<th>PRODUCTO</th>
								</tr>
								<tr>
									<td style = "padding:12px;"></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td style = "padding:12px;"></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td style = "padding:12px;"></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td style = "padding:12px;"></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td style = "padding:12px;"></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</table>
						</div>
						
						</br>
						<table class  = "tabla_nuevos_datos" width = "100%" style = 'padding-left:50px;padding-right:50px;font-size:12px;'>
							<tr>
								<td width = '5%'>
									<div class = "mostrar_datos" id = "ot">
										TAREAS
									</div>
								</td>
								<td nowrap>
									<div id = "ot_criterio">
										CRITERIO DE BÚSQUEDA
									</div>
								</td>
								<td >
									<table width = '100%'>
										<tr>
											<td width = '10%' align = 'right'>
												<div  style = 'height:18px;width:18px;background-color:#bac288;border:3px solid #bac288;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'></div>			
											</td>
											<td width = '15%' align = 'left'>MIS TAREAS</td>
											<td width = '10%' align = 'right'>
												<div  style = 'height:18px;width:18px;background-color:#6ebbbc;border:3px solid #6ebbbc;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'></div>
											</td>
											<td width = '15%' align = 'left'>TAREAS DE OTROS</td>
											<td width = '10%' align = 'right'>
												<div  style = 'height:18px;width:18px;background-color:#dedede;border:3px solid #dedede;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'></div>
											</td>
											<td width = '15%' align = 'left'>TAREAS FINALIZADAS</td>
											<td width = '10%' align = 'right'>
												<div  style = 'height:18px;width:18px;background-color:#f07570;border:3px solid #f07570;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'></div>
											</td>
											<td width = '15%' align = 'left'>TAREAS CANCELADAS</td>
										</tr>
									</table>	
								</td>
								<td align = 'right'>
									<?php
										$gestion->opcion_crear_tarea($_SESSION["codigo_usuario"]);
									?>
								</td>
							</tr>
						</table>
						<div id = "contenedor_resultados_tareas" class = 'contenedores_resultados' style = 'overflow:scroll;'  width = 'auto'>
							<table width = '100%' class = 'tablas_muestra_datos_tablas_trafico' style = 'padding-left:50px;padding-right:50px;'>
								<tr>
									<th>I</th>
									<th>R</th>
									<th>A</th>
									<th>NUM. TAREA</th>
									<th>FECHA</th>
									<th>TRABAJO</th>
									<th>TRANS. DEPTO</th>
									<th>RESPONSABLE</th>
									<th>ASIGNADO</th>
									<th>FECHA PROMETIDA</th>
								</tr>
								<tr>
									<td style = "padding:12px;"></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td style = "padding:12px;"></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td style = "padding:12px;"></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td style = "padding:12px;"></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td style = "padding:12px;"></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td style = "padding:12px;"></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</table>
						</div>
						
						
						</br>
						<div id = 'tabs' style = 'padding-left:50px;'>
							<ul >
								<li class = 'pestanas_menu' ><a href="#tabs-1">Pendientes</a></li>
								<li class = 'pestanas_menu' id = 'contestadas_tareas'><a href="#tabs-2">Contestadas</a></li>
							</ul>
							<div id="tabs-1" style = 'background-color:white;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;' >
								<div id = "pendientes_contestadas" class = 'contenedores_resultados'  width = '100%'>
									<table width = '100%' class = 'tablas_muestra_datos_tablas_trafico display2'  >
										<tr>
											<th></th>
											<th>OT</th>
											<th># TAREA</th>
											<th>REFERENCIA</th>
											<th>TRABAJO</th>
											<th>RADICADO POR</th>
											<th>RESPONSABLE</th>
											<th>ASIGNADO</th>
											<th>FECHA</th>
										</tr>
										<?php
											$tabla = "";
							$sql_1=mysql_query("select distinct t.pk_ot, t.codigo_int_tarea,t.codigo_tarea, ft.codigo, ot.referencia,t.trabajo,t.fecha_registro as fecha_prometida,ot.id as id_ot,
											t.usuario, e2.nombre_empleado as radicado_por, ft.num_tarea
																									

											from tareas t, flujo_tareas ft, cabot ot, usuario u2, empleado e2, asignados_tareas ax
																									
											where t.codigo_int_tarea = ft.pk_tarea  and t.estado = '0' and ot.codigo_ot = t.pk_ot

											and t.usuario = u2.idusuario and u2.pk_empleado = e2.documento_empleado 

											and t.codigo_int_tarea = ax.pk_tarea  and ax.pk_ot =ot.id and ot.estado = '1' and

											ax.pk_asignado = '$usuario_actual' and( ax.tipo = 'RES' or ax.tipo = 'ASI')

											order by t.fecha_registro asc");
											$tt = 1;
											while($trow = mysql_fetch_array($sql_1)){
												$id_tareaa = $trow['codigo_int_tarea'];
												$sql_info_res = mysql_query("select pk_asignado from asignados_tareas where pk_tarea = '$id_tareaa' and tipo = 'RES' and pk_asignado = '$usuario_actual'");
												$id = $trow['codigo_int_tarea'];
												$id_ot = $trow['id_ot'];
												$responsables = "";
												$asignados = "";
												$sql_res = mysql_query("select e.nombre_empleado as responsable,ax.tipo
												from tareas t, usuario u, asignados_tareas ax, empleado e
												where t.codigo_int_tarea ='$id' and t.codigo_int_tarea = ax.pk_tarea and ax.pk_asignado = u.idusuario 
												and u.pk_empleado = e.documento_empleado");
												while($xrow = mysql_fetch_array($sql_res)){
													if($xrow['tipo'] == 'RES'){
														$responsables .=$xrow['responsable']."</br>";
													}else{
														$asignados .=$xrow['responsable']."</br>";	
													}
												}
												$comp = "";
												if($trow['codigo'] == 0){
													$comp = $trow['num_tarea'];
												}else{
													$comp = $trow['num_tarea'].".".$trow['codigo'];
												}
												$tabla .="<tr>
													<td align = 'center' nowrap>
														<input type = 'radio'  name = 'select_ot' value = '$id' id = 't_pendiente$id' onclick = 'visualizar_tarea_pendiente($id,$id_ot)' class = 'radio'/>
														<label for='t_pendiente$id'><span><span></span></span></label>
													</td>
													<td align = 'center' nowrap>$tt ".$trow['pk_ot']."</td>
													<td style = 'text-align:left;padding-left:10px;' nowrap>".$comp."</td>
													<td style = 'text-align:left;padding-left:10px;' nowrap>".strtr(strtoupper(($trow['referencia'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
													<td style = 'text-align:left;padding-left:10px;' nowrap>".strtr(strtoupper(($trow['trabajo'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
													<td style = 'text-align:left;padding-left:10px;' nowrap>".utf8_decode($trow['radicado_por'])."</td>
													<td style = 'text-align:left;padding-left:10px;' nowrap>".$responsables."</td>
													<td style = 'text-align:left;padding-left:10px;' nowrap>".$asignados."</td>
													<td style = 'text-align:left;padding-left:10px;' nowrap>".$trow['fecha_prometida']."</td>
												</tr>";
												$tt++;
											}
								
								$tabla .="</tbody></table>
								";
								echo $tabla;
										?>
								</div>
							</div>
							<div id = 'tabs-2' style = 'background-color:white;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'>
								<div id = "list_contestadas" class = 'contenedores_resultados' style = '' width = '110%'>
									<table width = '100%' class = 'tablas_muestra_datos_tablas_trafico displaytc' >
										<tr>
											<th></th>
											<th>OT</th>
											<th># TAREA</th>
											<th>REFERENCIA</th>
											<th>TRABAJO</th>
											<th>FECHA</th>
										</tr>
										<?php
											$select = "select DISTINCT t.pk_ot, t.codigo_int_tarea,t.codigo_tarea, ft.codigo, ot.referencia,t.trabajo,t.fecha_prometida,ot.id as id_ot,
														t.usuario, ft.num_tarea
														from tareas t, flujo_tareas ft, cabot ot
														where t.codigo_int_tarea = ft.pk_tarea and t.usuario = '$usuario_actual' and (t.estado = '1') and ot.codigo_ot = t.pk_ot and ot.estado = '1'
														order by t.fecha_registro desc";
														
											$result = mysql_query($select);
											while($row = mysql_fetch_array($result)){
												$id = $row['codigo_int_tarea'];
												$id_ot = $row['id_ot'];
															
												$comp = "";
												if($row['codigo'] == 0){
													$comp = $row['num_tarea'];
												}else{
													$comp = $row['num_tarea'].".".$row['codigo'];
												}
												echo "<tr>
													<td nowrap>
														<div>
															<input type = 'radio'  name = 'select_ot' value = '$id' id = 't_pendiente$id' onclick = 'visualizar_tarea_pendiente($id,$id_ot)' class = 'radio'/>
															<label for='t_pendiente$id'><span><span></span></span></label>
														</div>
													</td>
													<td align = 'center' nowrap>".$row['pk_ot']."</td>
													<td style = 'text-align:left;padding-left:10px;' nowrap>".$comp."</td>
													<td style = 'text-align:left;padding-left:10px;' nowrap>".strtr(strtoupper(($row['referencia'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
													<td style = 'text-align:left;padding-left:10px;' nowrap>".strtr(strtoupper(($row['trabajo'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ")."</td>
													<td align = 'center' nowrap>".$row['fecha_prometida']."</td>
												</tr>";
											}		
											
										?>
									</table>
								</div>
							</div>
						</div>						
					</div>
				
				</div>
			</div>
		</div>
		
		</body>
	</html>
	
	