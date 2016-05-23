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
	$b = $_GET['b'];
	if($empresa_final == "" or $b == ""){
		header("location:banco.php");
	}
	
	$gestion = new cabecera_pagina();
	$empleado = new empleado();
	$banco = new banco();
	$emp = new empresa();
	$codigo_usuario_real = $_SESSION["codigo_usuario"];
?>
<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>:: PROCESS + ::</title>
			<meta charset="utf-8" />
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="../js/gestion.js"></script>
			<script type="text/javascript" src="../js/gestionf.js"></script>
			<script type="text/javascript" src="../js/bancos.js"></script>
			<script type="text/javascript" src="../js/ocultar.js"></script>
			<link rel="stylesheet" href="../css/jquery-ui.css">
			
			
			<link type="text/css" href="../css/tablas.css" rel="stylesheet" />
			<link type="text/css" href="../css/cabecera.css" rel="stylesheet" />
			<link type="text/css" href="../css/banco.css" rel="stylesheet" />
			
			<style >
				.estilos_barra td:nth-child(2){
					background-color:rgb(39,170,225);
				}
				img,.botones_opciones span,#ingresar_nuevo_documento,.botton_verde,#mostrar_all_usuarios,
				#mostrar_all_empleados,#abrir_ventana_documentos{
					cursor:pointer;
				}
				.finan_banco th{
					background-color:rgb(232, 165, 42);
					color:white;
					font-size:16px;
					padding:5px;
				}
				.finan_banco th:first-child{
					border-top-left-radius:0.5em;
					-moz-border-top-left-radius:0.5em;
					-webkit-border-top-left-radius:0.5em;
				}
				.finan_banco th:last-child{
					border-top-right-radius:0.5em;
					-moz-border-top-right-radius:0.5em;
					-webkit-border-top-right-radius:0.5em;
				}
				.finan_banco td{
					padding-left:4px;
					padding-right:4px;
					background-color:rgb(218, 218, 218);
				}
				.sin_nada td{
					border:0xp solid black;
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
			<span id = "banco_actual" class = "hidde"><?php echo $b;?></span>
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
														echo "<a class = 'links_barra_ubicacion' href = 'banco.php?e=$empresa_final'>
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
					include('banco_defect.php');
				?>
								
				<div id ="contenedor_menu_interno">
					<table id = "menu_interno_gestion" width = '100%'>
						<tr>
							<td align = 'center' width = '23%'>
								<a id = "abrir_info_basica" href = "#"><img src = '../images/icono/informacion_banco.png' class = 'iconos_menu_gestion2'/></a>
							</td>
							<td width = '23%'>
								<a id = "ventana_empleados" href = "#"><img src = '../images/icono/Gestion_contactos.png' class = 'iconos_menu_gestion2'/></a>
							</td>
							<td width = '23%'>
								<a href = "#"><img id = 'financiero' src = '../images/icono/libro_bancos.png' class = 'iconos_menu_gestion2'/></a>
							</td>
							<td width = '23%'>
								<a href = "#"><img id = 'administracion' src = '../images/icono/parametrizacion_bancos.png' class = 'iconos_menu_gestion2'/></a>
							</td>
						</tr>
					</table>
				</div>
			</div>
			
			<div id = "info_basica" class = 'ventana'>	
				<div id = "contenedor_info_basica">
						
				</div>
			</div>
				
			<div id = "contactos_banco" class = 'ventana'>
				<table width = '100%'>
					<td width = '96%' align = 'left'>
						<table width = '100%' style = 'padding-left:50px;'>
							<tr>
								<td align = 'left'>
									<?php $banco->logo_banco($b);?>
								</td>
							</tr>
							<tr>
								<td align = 'left'>
									<span class = 'mensaje_bienvenida'>CONTACTOS</span>
								</td>
							</tr>
						</table>
					</td>
					<td align = 'right' style = 'padding-right:50px;'>
						<table width = '100%'>
							<tr>
								<td>
									<img id = 'abrir_nuevo_contacto'src = '../images/iconos/icono_nuevo_contacto.png'  class = 'iconos_opciones'/>
								</td>
								<td>
									<img id = 'cerrar_ventana_contactos'src = '../images/iconos/cerrar.png' onclick = 'cerrar_ventana_editar()'class = 'iconos_opciones'/>
								</td>
							</tr>
						</table>
					</td>
				</table>
				</br>
				</br>
				</br>
				</br>
				<div id = "contenedor_contactos" >
				</div>
			</div>
				
			
			<div id = "parametrizacion_banco" class = 'ventana'>
				<table width = '100%'>
					<td width = '96%' align = 'left'>
						<table width = '100%' style = 'padding-left:50px;'>
							<tr>
								<td align = 'left'>
									<?php $banco->logo_banco($b);?>
								</td>
							</tr>
							<tr>
								<td align = 'left'>
									<span class = 'mensaje_bienvenida'>PARAMETRIZACIÓN BANCO</span>
								</td>
							</tr>
						</table>
					</td>
					<td align = 'right' style = 'padding-right:50px;'>
						<table width = '100%'>
							<tr>
								<td>
									<img src = '../images/iconos/cerrar.png' onclick = 'cerrar_parametrizacion_banco()'class = 'iconos_opciones'/>
								</td>
							</tr>
						</table>
					</td>
				</table>
				</br>
				</br>
				</br>
				</br>
				<div id = "contenedor_parametrizacion" >
					<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' >
								<table width = '100%'>
									<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano' >PRODUCTOS</td>
									<td align = 'left' ><img src = '../images/iconos/mas_blanco.png' width = '30px' onclick = 'mostrar_nuevo_producto()'/></td>
								</table>
							</th>
						</tr>
						<tr>
							<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' >
								<table width = '100%'>
									<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano' >NUEVOS PRODUCTOS</td>
								</table>
							</th>
						</tr>
						<tr>
							<?php
								$sql = mysql_query("select name, id from und where empresa = '$empresa_final'");
								$option_und = "<option value = '0'>[SELECCIONE]</option>";
								while($row = mysql_fetch_array($sql)){
									$option_und.="<option value ='".$row['id']."'>".$row['name']."</option>";
								}
								$sql = mysql_query("select name, id from tipo_producto_banco order by name asc");
								$option_tipo = "<option value = '0'>[SELECCIONE]</option>";
								while($row = mysql_fetch_array($sql)){
									$option_tipo.="<option value ='".$row['id']."'>".$row['name']."</option>";
								}
								echo "<td class = 'hidde list_banco_nuevo_producto'>
									<table width = '100%' class = 'barra_busqueda'>
										<tr>
											<td>
												<p>Seleccione una Unidad de Negocio:</p>
												<select id = 'und_banco_nproducto' style = 'width:auto;'>$option_und</select>
											</td>
											<td>
												<p>Seleccione un Tipo de Producto:</p>
												<select id = 'und_tipo_nproducto' style = 'width:auto;'>$option_tipo</select>
											</td>
											<td>
												<p>Ingrese el Número de Cuenta:</p>
												<input type = 'text' class = 'entradas_bordes' id = 'num_cuenta_banco_und_n'/>
											</td>
										</tr>
										<tr>
											<td></br></td>
										</tr>
										<tr>
											<td colspan = '3' align = 'center'>
												<span onclick = 'guardar_nuevo_producto_banco()' class = 'botton_verde'>GUARDAR PRODUCTO</span>
											</td>
										</tr>
									</table>
								</td>";
							?>
						</tr>
					</table>
				</div>
			</div>
			
			<div id = "cuadros_bancos" class = 'ventana'>
				<table width = '100%'>
					<td width = '96%' align = 'left'>
						<table width = '100%' style = 'padding-left:50px;'>
							<tr>
								<td align = 'left'>
									<?php $banco->logo_banco($b);?>
								</td>
							</tr>
							<tr>
								<td align = 'left'>
									<span class = 'mensaje_bienvenida'>CUADROS FINANCIEROS</span>
								</td>
							</tr>
						</table>
					</td>
					<td align = 'right' style = 'padding-right:50px;'>
						<table width = '100%'>
							<tr>
								<td>
									<img src = '../images/iconos/cerrar.png' onclick = 'cerrar_financiera_banco()'class = 'iconos_opciones'/>
								</td>
							</tr>
						</table>
					</td>
				</table>
				<div  >
					<table class = 'barra_busqueda' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td>
								<p>Seleccione una unidad de negocio:</p>
								<select id = 'b_und_productoo' style = 'width:auto;' onclick = 'buscar_producto_und()'>
									<?php
										$sql = mysql_query("select name, id from und where empresa = '$empresa_final'");
										echo "<option value = '0'>[SELECCIONE]</option>";
										while($row = mysql_fetch_array($sql)){
											echo "<option value ='".$row['id']."'>".$row['name']."</option>";
										}										
									?>
								</select>
							</td>
							<td style = 'padding-left:20px;width:auto;'>
								<p>Seleccione un Producto:</p>
								<select id = 'b_productos_und_b' style = 'width:auto;'></select>
							</td>
							<td>
								<img src = '../images/iconos/lupa_azul.png' class = 'botones_opciones' onclick = 'buscar_info_cuenta()' />
							</td>
						</tr>
					</table>
					</br>
					<table width = '100%'>
						<tr>
							<td id = 'contenedor_info_producto'>
								
							</td>
						</tr>
					</table>
				</div>
			</div>
			
			<div id = 'nuevo_contacto_banco' class = 'ventana'>
				<table width = '100%' style ='padding-left:50px;padding-right:50px;'>
					<tr>
						<td width = '96%' align = 'left'>
							<table width = '100%' >
								<tr>
									<td align = 'left'>
										<?php $banco->logo_banco($b);?>
									</td>
								</tr>
								<tr>
									<td align = 'left'>
										<span class = 'mensaje_bienvenida'>NUEVO CONTACTO</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right'>
							<table width = '100%'>
								<tr>
									<td>
										<img id = 'cerrar_nuevo_contacto'src = '../images/iconos/cerrar.png' onclick = 'cerrar_ventana_editar()'class = 'iconos_opciones'/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				</br>
				</br>
				</br>
				</br>
				<table width = '100%' class = 'tabla_nuevos_datos2' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td>
							<p>NOMBRE:</p>
							<input type = 'text' id = 'n_name' />
						</td>
						<td>
							<p>CARGO:</p>
							<input type = 'text' id = 'n_cargo' />
						</td>
						<td>
							<p>CORREO:</p>
							<input type = 'text' id = 'n_correo' />
						</td>
						<td>
							<p>TELÉFONO:</p>
							<input type = 'text' id = 'n_telefono' />
						</td>
					</tr>
					<tr>
						<td></br></br></br></br></td>
					</tr>
					<tr>
						<td>
							<p>CELULAR:</p>
							<input type = 'text' id = 'n_celular' />
						</td>
						<td>
							<p>MES:</p>
							<select id = 'mes_contacto'>
								<option value = '0'>[SELECCIONE]</option>
								<option value = 'Enero'>Enero</option>
								<option value = 'Febrero'>Febrero</option>
								<option value = 'Marzo'>Marzo</option>
								<option value = 'Abril'>Abril</option>
								<option value = 'Mayo'>Mayo</option>
								<option value = 'Junio'>Junio</option>
								<option value = 'Julio'>Julio</option>
								<option value = 'Agosto'>Agosto</option>
								<option value = 'Septiembre'>Septiembre</option>
								<option value = 'Octubre'>Octubre</option>
								<option value = 'Noviembre'>Noviembre</option>
								<option value = 'Diciembre'>Diciembre</option>
							</select>
						</td>
						<td>
							<p>DÍA:</p>
							<input type = 'number' id = 'n_dia' max = '31' />
						</td>
					</tr>
					<tr><td></br></td></tr>
					<tr><td></br></td></tr>
					<tr><td></br></br></br></br></td></tr>
					<tr>
						<td colspan = '4'align = 'center'>
							<span class = "botton_verde" id = "cancelar_contacto">CANCELAR</span>
							<span class = "botton_verde" id = "crear_contacto_banco">GUARDAR</span>
						</td>
					</tr>
				</table>
			</div>
			
			
				<div id = "documentos_banco">
					<table width = '100%'>
						<th width = '96%'>
							<span class = "titulo_ventana">DOCUMENTOS</span>
						</th>
						<th align = 'right'>
							<img id = "cerrar_info_basica"src = "../images/iconos/CANCELAR.png" width = '30px' height = '30px'/>
						</th>
					</table>
					</br>
					
					<div id = "contenedor_listado_documentos"></div>
				</div>
		</body>
	</html>
	