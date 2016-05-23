<?php

	/*
		Es el menú que antecede a los submodulos de la plataforma.
		
	*/
	require("../Modelo/gestion_cabecera.php");
	require("../Modelo/empleado.php");
	require("../Controller/Conexion.php");
	require("../Modelo/inv_tecnologia.php");
	require("../Modelo/muebles.php");
	require("../Modelo/usuarios.php");
	require("../Modelo/ppto_general.php");
	require("../Modelo/Empresa.php");
	
	session_start();
	if($_SESSION["codigo_usuario"] == ""){
		header("location: ../logeo.php");
	}
	$empresa_final = $_GET["e"];
	if(count($empresa_final) == 0){
		header("location: bienvenida.php");
	}
	$codigo_usuario_real = $_SESSION['codigo_usuario'];
	$inv_tec = new inv_tecnologia();
	$gestion = new cabecera_pagina();
	$empleado = new empleado();
	$muebles = new muebles();
	$usux = new usuario();
	$ppto = new ppto_general();
	$emp = new empresa();
?>
<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>:: PROCESS + ::</title>
			<meta charset="utf-8" />
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			
			<link type="text/css" href="../css/cabecera.css" rel="stylesheet" />
			<link type="text/css" href="../css/tablas.css" rel="stylesheet" />
			
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script type="text/javascript" src="../js/gestion.js"></script>
			<script type="text/javascript" src="../css_jquery/css_logeo.js"></script>
			<script type="text/javascript" src="../js/gestion_empresa.js"></script>
			<script type="text/javascript" src="../js/gestion2.js"></script>
			<script type="text/javascript" src="../js/gestionf.js"></script>
			<link type="text/css" href="gestion_final.css" rel="stylesheet" />
			<link rel="stylesheet" href="../css/jquery-ui.css">
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
			<script src="../js/medidas.js"></script>
			<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
			<style >
				.titulo_ventana{
					font-size:20px;
					font-weight:bold;
				}
				.estilos_barra td:nth-child(2){
					background-color:rgb(39,170,225);
				}
				.tabla_nuevos_datos input,.tabla_nuevos_datos textarea,.tabla_nuevos_datos select{
					width:90%;
					border-radius:0.2em;
					border:2px solid #9D9B99;
				}
				.mano_links{
					cursor:pointer;
				}
				a:active,a:hover,a:visited,a:link{
					cursor:grab;
				}
				
			</style>
			
		</head>
		
		<body>
			<span id = "empresa_final" class = "hidde"><?php echo $empresa_final;?></span>
			<span id = "periodo_nomina_seleccionado" class = "hidde"></span>
			<?php include('cabecera.php'); echo $imprimir;?>
			
			<div id = "cuerpo_pagina">
			
				<table  width = '100%'>
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
					/*
						Incluye el archivo empresa_defect.php que contiene la información del logo de la empresa por la cual está trabajando el usuario.
						Adicional a esto, a través de la instancia de cabecera_pagina, llama al médito que contiene los módulos correspondientes segun los permisos
						que tenga el usuario.
					*/
					include('empresa_defect.php');
					$gestion->menu_gestion($codigo_usuario_real,$empresa_final);
				?>
			</div>
		</body>
	</html>
