<?php
	include("../Controller/Conexion.php");
	require("../Modelo/usuarios.php");
	session_start();
?>
<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>:: PROCESS + ::</title>
			<meta charset="utf-8" />
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui-1.8.23.custom.min.js"></script> <!-- Primordial-->
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script type="text/javascript" src="../css_jquery/css_logeo.js"></script>
			<link type="text/css" href="../css/barra_navegacion.css" rel="stylesheet" />
			<link type="text/css" href="../css/gestion.css" rel="stylesheet" />
			<script type="text/javascript" src="../js/gestion.js"></script>
			<script type="text/javascript" src="../js/gestion_usuario.js"></script>
		</head>
		<body>
			<?php 
				include("contenido_gestion.php");
			?>
			
			<div id = "contenedor_datos_administracion_principal">
				<div id = "contenedor_informacion_usu">
					<table class = "tabla_opciones_busqueda_gestion" width = "100%">
						<tr>
							<th>Empresa</th>
							<th>
								<input class = "input_redondos" type = "text" name = "b_empresa" id = "b_empresa" placeholder = "Empresa"/>
							</th>
							<th>Usuario</th>
							<th>
								<input class = "input_redondos" type = "text" name = "b_nick" id = "b_nick" placeholder = "Usuario"/>
							</th>
							<th>
								<button class = "mostrar_datos" id = "boton_mostrar_usuario_gestion" >MOSTRAR TODO</button>
							</th>
							<th>
								<button class = "mostrar_datos" id = "boton_usuario_gestion" >CREAR CECO</button>
							</th>
						</tr>
					</table>
					
					<div id = "contenedor_tabla_usu_gestion" class = "contenedor_datos_consultas">
						<?php
							$usu = new usuario();
							$usu->estrutura_tabla_usuarios($usu->mostrar_datos());
						?>
					</div>
			
				</div>
				
			</div>
			
		</body>
	</html>