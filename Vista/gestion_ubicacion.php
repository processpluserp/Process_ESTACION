<?php
	include("../Controller/Conexion.php");
	require("../Modelo/pais.php");
	
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
			<script type="text/javascript" src="../js/gestion_ubicacion.js"></script>
		</head>
		<body>
			<?php 
				include("contenido_gestion.php");
			?>
			
			<div id = "contenedor_datos_administracion_principal">
				<div id = "contenedor_informacion_proveedores">
					<table class = "tabla_opciones_busqueda_gestion" width = "100%">
						<tr>
							<th>
								<input class = "input_redondos" type = "text" name = "b_pais" id = "b_pais" placeholder ="Nombre País"/>
							</th>
							<th>
								<input class = "input_redondos" type = "text" name = "b_departamento" id = "b_departamento" placeholder = "Departamento"/>
							</th>
							<th>
								<input class = "input_redondos" type = "text" id = "b_ciudad" name = "b_ciudad" placeholder ="Ciudad" />
							</th>
							<th>
								<button class = "mostrar_datos" id = "boton_mostrar_proveedores_gestion" >MOSTRAR TODO</button>
							</th>
						</tr>
					</table>
					
					<div id = "contenedor_tabla_ubicaciones_gestion" class = "contenedor_datos_consultas">
						<?php
							$pais = new pais();
							$pais->mostrar_relacion_ubicacion();
						?>
					</div>
				</div>
			</div>
		</body>
	</html>