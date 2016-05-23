<?php
	
	
	require("../Modelo/gestion_cabecera.php");
	require("../Modelo/empleado.php");
	require("../Controller/Conexion.php");
	require("../Modelo/Empresa.php");
	require("../Modelo/bancos.php");
	session_start();
	if($_SESSION["codigo_usuario"] == ""){
		header("location:../logeo.php");
	}
	$empresa_final = $_GET['e'];
	if($empresa_final == ""){
		header("location:bienvenida.php");
	}
	$codigo_usuario_real = $_SESSION["codigo_usuario"];
	
	$gestion = new cabecera_pagina();
	$empleado = new empleado();
	$emp = new empresa();
	$bancoss = new banco();
?>

<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>:: PROCESS + ::</title>
			<meta charset="utf-8" />
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script type="text/javascript" src="../js/gestion.js"></script>
			<script type="text/javascript" src="../js/gestionf.js"></script>
			<script type="text/javascript" src="../js/bancos.js"></script>
			<link rel="stylesheet" href="../css/jquery-ui.css">
			<link type="text/css" href="../css/tablas.css" rel="stylesheet" />
			<link type="text/css" href="../css/cabecera.css" rel="stylesheet" />
			<style >
				.estilos_barra td:nth-child(2){
					background-color:rgb(39,170,225);
				}
				#form_nuevo_banco{
					background-color:#E3E3E3;
					border-radius:0.5em;
				}
				img,.botones_opciones span,#ingresar_nuevo_documento,.botton_verde,#mostrar_all_usuarios,
				#mostrar_all_empleados,#abrir_ventana_documentos{
					cursor:pointer;
				}
				
			</style>
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
			<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
			<script type="text/javascript" src="../js/resize.js"></script>
			
		</head>
		<body>
			<div id="spinner" class="spinner" style="display:none;">
				<img id="img-spinner" src="../images/spinner.gif" alt="Cargando..."/>
			</div>
			<span id = "empresa_final" class = "hidde"><?php echo $empresa_final;?></span>
			<span id = "periodo_nomina_seleccionado" class = "hidde"></span>
			<?php include('cabecera.php'); echo $imprimir;?>
			
			<div id = "cuerpo_pagina">
				<table width = '100%'>
					<tr>
						<td>
							<table>
								<tr>
									<td  align = 'left'><span class = "bara_ubicacion" >
										<?php
											echo "<a class = 'links_barra_ubicacion' href = 'gestion.php?e=$empresa_final'>AGENCIA</a>"
										?>
									</span></td>
									<td  align = 'left'><span class = "bara_ubicacion" >
										<?php
											echo "<a class = 'links_barra_ubicacion' href = 'cliente.php?e=$empresa_final'>CLIENTES</a>"
										?>
									</span></td>
									<td align = 'left'><span class = "bara_ubicacion">
										<?php
											echo "<a class = 'links_barra_ubicacion' href = 'proveedor.php?e=$empresa_final'>PROVEEDORES</a>"
										?>
									</span></td>
									<td><span class = "bara_ubicacion" id = "actual">BANCOS</span></td>
									
								</tr>
							</table>
						</td>
						<td align = 'right'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>
										<table >
											<tr>
												<td>Regresar</td>
												<td>
													<?php
														echo "<a class = 'links_barra_ubicacion' href = 'menu_gestion.php?e=$empresa_final'>
															<img src = '../images/icon/icono_regresar.png' class = 'iconos_barra'/>
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
				?>
				
				<div id = "form_nuevo_banco" class = 'ventana'>
					<table width = '100%'>
						<tr>
							<td width = '96%' align = 'left'>
								<table width = '100%'>
									<tr>
										<td align = 'left'>
											<?php $emp->mostrar_logo_empresa($empresa_final); ?>
										</td>
									</tr>
									<tr>
										<td align = 'left' style = 'padding-left:50px;'>
											<span class = 'mensaje_bienvenida'>DATOS NUEVO BANCO</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right' style = 'padding-right:50px;'>
								<table width = '100%'>
									<tr>
										<td>
											<img onclick = '$("#form_nuevo_banco input").val("");$("#form_nuevo_banco").dialog("close");' src = "../images/iconos/cerrar.png" class = 'iconos_opciones'/>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					</br>
					<table class = "tabla_nuevos_datos2" width = "100%" style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<th align = "left" colspan = '2'  width = "49%" >LEGALES</th>
							<th class = "separator"></th>
							<th align = "left" colspan = '2' width = "49%">UBICACIÓN</th>
						</tr>
						<tr>
						<td colspan = "2">
								<p>Nombre Comercial:</p>
								<input class = "entradas_bordes"type = "text" name = "ncomercial_banco" id = "ncomercial_banco" />
							</td>
							<td class = "separator"></td>
							<td colspan = "2">
								<table width = '100%'>
										<tr>
											<td>
												<p>País:</p>
											</td>
											<td>
												<p>Departamento:</p>
											</td>
											<td>
												<p>Ciudad:</p>
											</td>
										</tr>
										<tr>
											<td>
												<select id = "n_pais_empresa" name = "n_pais_empresa">
													<option value = "0"></option>
													<?php
														$sql = mysql_query("select codigo_pais, nombre_pais from pais");
														while($row = mysql_fetch_array($sql)){
															echo "<option value ='".$row['codigo_pais']."'>".$row['nombre_pais']."</option>";
														}
													?>
												</select>
											</td>
											<td>
												<select id = "n_departamento_empresa" ></select>
											</td>
											<td>
												<select id = "n_ciudad_empresa" ></select>
											</td>
										</tr>
									</table>

								
							</td>
						</tr>
						<tr>
							<td colspan = "2">
								<p>Razón Social:</p>
								<input class = "entradas_bordes"type = "text" name = "nsocial_banco" id = "nsocial_banco" />
							</td>
							<td class = "separator"></td>
							<td >
								<p>Dirección:</p>
								<input class = "entradas_bordes" type = "text" name = "direccion" id = "direccion" />
							</td>
							<td>
								<p>Teléfono:</p>
								<input class = "entradas_bordes" type = "text" name = "phone" id = "phone" />
							</td>
						</tr>
						<tr>
							<td colspan = "2">
								<p>Nit:</p>
								<input class = "entradas_bordes"type = "text" name = "nnit_banco" id = "nnit_banco" />
								
							</td>
							<td class = "separator"></td>
							<td >
								<p>Página Web:</p>
								<input class = "entradas_bordes" type = "text" name = "pagina" id = "pagina" />
							</td>
							<td >
								<p>Correo:</p>
								<input class = "entradas_bordes" type = "text" name = "correo" id = "correo" />
							</td>
						</tr>
						<tr>
							<td>
								</br>
							</td>
						</tr>
						<tr>
							<th align = "left" colspan = '2' >CONFIGURACIÓN</th>
						</tr>
						<tr>
							<td colspan = "2">
								<p>Logo del Banco:</p>
								<table width = '100%'>
										<tr>
											<td>
											<input class = "entradas_bordes"type = "file" name = "n_logo_bienvenida" id = "n_logo_bienvenida" />
										</td>
										<td>
											<img src = '../images/iconos/CANCELAR.png' width = '15px' height = '15px' id = 'limpiar_img_bienvenida'/>
										</td>
									</tr>
								</table>
							</td>
							<td class = "separator"></td>
							<td colspan = "2">
								<p>Imagen Bienvenida (PNG):</p>
								<table width = '100%'>
										<tr>
											<td>
											<input class = "entradas_bordes"type = "file" name = "n_logo_bienvenida2" id = "n_logo_bienvenida2" />
										</td>
										<td>
											<img src = '../images/iconos/CANCELAR.png' width = '15px' height = '15px' id = 'limpiar_img_bienvenida2'/>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								</br>
							</td>
						</tr>
						<tr>
							<th align = "left" colspan = '2' >ASOCIACIÓN</th>
						</tr>
						<?php
							$bancoss->asociar_empresa_proveedor();
						?>
						<tr>
							<td>
								</br>
							</td>
						</tr>
						<tr>
							<td colspan = "5" align = "center">
								<span class = "botton_verde" class = "botones_nueva_ventana" id = "n_cancelar_banco_gestion" >CANCELAR</span>
								<span class = "botton_verde" class = "botones_nueva_ventana" id = "n_guardar_banco_gestion">GUARDAR</span>
							</td>
						</tr>
					</table>
				</div>
				
				<div id ="contenedor_menu_interno">
					<?php
						$banco = new banco();
						$banco->mostrar_bancos($empresa_final);
					?>
				</div>
				
			</div>
			
		</body>
	</html>


