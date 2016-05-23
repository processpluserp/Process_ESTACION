<?php
	
?>
<!DOCTYPE html>
 
<html lang="es">
 
<head>
	<title>:: PROCESS + ::</title>
	<meta charset="utf-8" />
	<!--
		Librerías:
	-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link type="text/css" href="css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />

	<script type="text/javascript" src="js/jquery1_10_2.js"></script>
	
	<link rel="icon" type="image/png" href="images/Untitled-1-02.png" />
	
	<link type="text/css" href="css/logeo.css" rel="stylesheet" />
	
	<script type="text/javascript" src="js/jquery_ui/jquery-ui.js"></script>
	<script type="text/javascript" src="css_jquery/css_logeo.js"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/medidas.js"></script>
    <script src="js/jquery.backstretch.min.js"></script>
    
</head>

<body>
	
	<div id = "contenedor">
		
		<form method  = "post" action = "Controller/validar_logeo.php">
			<div  id = "contenedor_datos_mayor">
				<table width = "100%" height = "100%" id = "tabla_logeo">
					<tr>
						<td colspan = "4" width = "100%" id = "img_c" align = 'center'>
							<img id = "img_log" src = "images/Untitled-1-01.png" />
						</td>
					</tr>
					<tr>
						<td width ='43%' style = '' class = 'normal_c'>
							<input type = "text" id = "usuario" name = "usuario" class  = "ingreso" placeholder = "USUARIO"/>
						</td>
						<td width ='43%' class = 'normal_c'>
							<input type = "password" id = "password" name = "password" class  = "ingreso" placeholder = "CONTRASEÑA" onkeyup = 'entrar(event)'/>
						</td>
						<td width ='14%' style = 'padding-left:3px;' class = 'normal_c' colspan = '2'>							
							<input type = 'button' id = 'entrar_logeo' value = 'ENTRAR' class = 'botton_verde'/>
						</td>
					</tr>
					<tr>
						<td colspan= '4' class = 'cambio_c'>
							<table width = '100%'>
								<tr>
									<td class = 'cambio_c' colspan = '2' width = '49%'>
										<input type = 'password' id = 'n_contrasena' class = 'ingreso' placeholder = "INGRESE SU CONTRASEÑA"/>
									</td>
									<td class = 'cambio_c'  colspan = '2'  width = '49%' style = 'padding-right:25px;'>
										<input type = 'password' id = 'c_contrasena' class = 'ingreso' placeholder = "CONFIRME SU CONTRASEÑA"/>
									</td>
								</tr>
							</table>						
						</td>
					</tr>
					<tr >
						<td colspan= '4' class = 'cambio_c'>
							<table width = '100%'>
								<tr>
									<td colspan = '2'>
										<input type = 'button' id = 'cancelar_c' value = 'CANCELAR' class = 'botton_verde' />
									</td>
									<td colspan = '2'>
										<input type = 'button' value = 'GUARDAR'  class = 'botton_verde' id = 'guardar_contrasena_nueva'/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</form>
		
		
		
		<footer id= 'contenedor_mensaje_error' align= 'center'>
			<?php
				//echo $_SESSION['error'];//$_GET['e'];
			?>
		</footer>
	  		
	<script>
            jQuery.backstretch([
                  "images/logeo/1.jpg"
                , "images/logeo/2.jpg"
                , "images/logeo/3.jpg"
				, "images/logeo/5.jpg"
				, "images/logeo/6.jpg"
				, "images/logeo/7.jpg"
                ], {duration: 1500, fade: 900}
            );
    </script>
    
</body>
</html>


