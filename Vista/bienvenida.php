<?php
	/*
		Incluye el Archivo Conexion.php que tiene toda la información de conexión a la BD.
		Requiere los datos del archivo gestion_cabecera.php para completar la información de la cabecera de la página.
	*/
	include("../Controller/Conexion.php");
	require("../Modelo/gestion_cabecera.php");
	
	/*
		Verifica que la variabale 
		@param $_SESSION['codigo_usuario'] Contiene el código de usuario.
		No se encuentre vacia; De estar vacia, se redireccione al usuario al la página de logeo.
		Adicional a esto, se crea una instacia de la clase cabecera_pagina llamada @param cabecera_pagina $gestion
	*/
	session_start();
	if($_SESSION["codigo_usuario"] == ""){
		header("location:../logeo.php");
	}
	$codigo_usuario_real = $_SESSION['codigo_usuario'];
	$gestion = new cabecera_pagina();
?>
<!DOCTYPE html>
 
<html lang="es">
 
	<head>
		<title>:: PROCESS + ::</title>
		<meta charset="utf-8" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
		<link type="text/css" href="../css/bienvenida.css" rel="stylesheet" />
		<script type="text/javascript" src="../js/bienvenida.js"></script>
		
		<link type="text/css" href="../css/tablas.css" rel="stylesheet" />
		<link rel="stylesheet" href="../css/jquery-ui.css">
		
		<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
		<script src="../js/vendor/bootstrap.min.js"></script>
		<script src="../js/jquery.backstretch.min.js"></script>
		<script type = 'text/javascript'>
			function cerrar_sesion(){
				/*
					Mediante Ajax, cierro la sesion que tengo abierta en php,
					y luego redireccione a la página que de logeo.
				*/
				
				$.ajax({
					url:'gestion_all.php',
					data:{turno:0},
					type:'post',
					success:function(data){
						location.href="../logeo.php";
					}
				});
			}
		</script>
	</head>
	<body>
			
		<img src = '../images/iconos/cerrar_sesion.png' id = 'cerrar_sesion' width = '100px' class = 'mano' />
		<div  id = "contenedor_datos_mayor">
			<table width = "100%" height = "100%" id = "tabla_logeo">
				<tr>
					<td colspan = "3" width = "100%" id = "img_c" align = 'center'>
						<?php						
							echo "<img  src = '../images/Untitled-1-01.png' id = 'img_logo'/>";
						?>
					</td>
				</tr>
				<tr>
					<td colspan = "3" align = 'center'>
						<span class = "mensaje_bienvenida">BIENVENIDO</span>
					</td>
				</tr>
				<tr >
					<td colspan = "3" align = 'center' style = 'padding-bottom:10px;'>
						<table width = '100%'>
							<tr>
								<td align = 'center'><span class = "mensaje_usuario" align = 'center'><?php echo utf8_decode($_SESSION['nombre_usuario'])." ";?></span></td>
							</tr>
							<tr>
								<td align = 'center'>
									<span class = "mensaje_usuario"><?php echo $_SESSION['departamento_usuario'];?></span>
								</td>
							</tr>
						</table>
						<!--<ul class = 'inicio'>
							<li align = 'center'><span id = "mensaje_usuario" align = 'center'><?php //echo utf8_encode($_SESSION['nombre_usuario'])." ";?></span></li>
							<li>
								
							</li>
						</ul>-->
						
					</td>
				</tr>
			</table>					
		</div>
		
		<div id = "menu_inicio">
			<?php
				/*
					A partir de la instacia de la clase creada de cabecera_pagina, se llama el método que valida que el usuario tenga acceso a los
					módulos principales de la plataforma.
				*/
				$gestion->menu_bienvenida_perfil($codigo_usuario_real);
			?>
		</div>
		
		<div id = "ventana_nueva_empresa">
			<div class = 'scroll_nueva_ventana'>
				<table width = '100%'>
					<tr>
						<td width = '90%' align = 'left'>
							<span class = "mensaje_bienvenida">INGRESO NUEVA EMPRESA</span>
						</td>
						<td align = 'right'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>
										<img src ='../images/iconos/cerrar.png' alt = 'Cerrar'  class = 'iconos_opciones'id = 'cerrar_ventana_nueva_empresa'/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<table id = "tabla_datos_nueva_empresa" width = "100%" class ='tabla_nuevos_datos2' style = 'padding-left:50px;padding-right:50px;'>
					<tr>
						<td colspan = "2" align = "left" width = '48%'>
							<p>Nombre Comercial: (*)</p>
							<input class = "entradas_bordes"type = "text" name = "n_nombre_comercial_empresa" id = "n_nombre_comercial_empresa" />
						</td>
						<td ></td>
						<td colspan = "2" lign = "left" width = '48%'>
							<p>Razón Social: (*)</p>
							<input class = "entradas_bordes" type = "text" name = "n_nombre_legal_empresa" id = "n_nombre_legal_empresa" />								
						</td>
					</tr>
					<tr>
						<td colspan = "2">
							<p>NIT: (*)</p>
							<input class = "entradas_bordes" type = "text" name = "n_nit_empresa" id = "n_nit_empresa" />
						</td>
						<td ></td>
						<td colspan = "2">
							<p>Cargar Logo Empresa: (*)</p>
							<table width = '100%'>
								<tr>
									<td>
										<input class = "entradas_bordes" type = "file" name = "n_logo_empresa" id = "n_logo_empresa" />
									</td>
									<td align = 'right'>
										<img src = '../images/iconos/eliminar.png' width = '35px' height = '40px' id = 'limpiar_img_logo' title = 'Limpiar'/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan = "2" align = "center" style = 'vertical-align:middle;' >
							<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar' id = "n_cancelar_empresa_gestion" style = 'position:relative;left:35%' />
						</td>
						<td  style = 'vertical-align:top;' >
							<img src = '../images/iconos/guardar_1.png' class = 'iconos_guardar_x'   style = 'position:relative;top:0px;z-index:1;' />
						</td>
						<td colspan = "2" align = "center"  style = 'vertical-align:middle;' >
							<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar' id = "n_guardar_empresa_gestion" style = 'position:relative;left:-35%;'/>
						</td>
					</tr>
				</table>
			</div>
		</div>
		
		
		<div id = "empresa_arranque">
			<div id = 'titulo' width = '100%' align ="center">
				<table width = '100%'>
					<tr>
						<td align = 'left' style = 'padding-left:20px;'>
							<span class = 'mensaje_bienvenida'>SELECCIONE UNA EMPRESA:</span>
						</td>
						<td align = 'right'>
							<table width = '100%'>
								<tr>
									<td align = 'right'>
										<img src ='../images/iconos/cerrar.png' alt = 'Cerrar' class = 'iconos_opciones' id = 'cerrar'/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<div id = 'empresas_logos'><table width = '100%' >
				<tr><td></br></td></tr>
				<?php
					/*
						Específicamente para el módulo de Gestion, se cargan las empresas que hay creadas dentro de la plataforma;
						Para las personas que tengan acceso a este módulo, no dependerán de permisos para poder trabajar con cualquiera de las empresas.
						
						Es de vital importacia que no todo el mundo tenga acceso a este módulo.
					*/
					$x = 1;
					$tabla = "";
					$td = "";
					$sql = mysql_query("SELECT e.logo2,e.cod_interno_empresa,e.nombre_comercial_empresa 
									from empresa e, pusuemp p
										where e.cod_interno_empresa = p.cod_empresa and p.cod_usuario = '$codigo_usuario_real' order by e.nombre_comercial_empresa asc");
					$x_imp = "<tr>";
					while($row = mysql_fetch_array($sql)){
						$id = $row['cod_interno_empresa'];
						$x_imp .= "<td align = 'center' class = 'barras' >
								<a href = 'menu_gestion.php?e=$id'>
									<img  src = '../images/logos/".$row['logo2']."' class = 'empresas_css'  height = '120px'style = 'padding-left:60px;'/>
								</a>
							</td>";
						/*
						if($x == 1){
							
						}
						if($x == 2){
							$x_imp .= "<td align = 'center' class = 'barras' >
								<a href = 'menu_gestion.php?e=$id'>
									<img  src = '../images/logos/".$row['logo2']."' class = 'empresas_css' />
								</a>
							</td>";
						}
						if($x == 3){
							$x_imp .= "<td align = 'left' class = 'barras' >
								<a href = 'menu_gestion.php?e=$id'>
									<img  src = '../images/logos/".$row['logo2']."' class = 'empresas_css' />
								</a>
							</td>";
						}
						$x++;*/
						
					}
					echo $x_imp."</tr>";
				?>
			</table></div>
			
			<?php
				$gestion->adicionar_empresa($codigo_usuario_real);
			?>
		</div>
		<!--<script>
            jQuery.backstretch("../images/logeo/1.jpg");
		</script>-->
	</body>	
</html>