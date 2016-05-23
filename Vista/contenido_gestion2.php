<?php
	$fecha = date("Y-m-d"); //5 agosto de 2004 por ejemplo 
	$fechats = strtotime($fecha); //a timestamp
	$mes = "";
	//el parametro w en la funcion date indica que queremos el dia de la semana
	//lo devuelve en numero 0 domingo, 1 lunes,....
	switch (date('w', $fechats)){
		case 0: $mes = "DOMINGO"; break;
		case 1: $mes = "LUNES"; break;
		case 2: $mes = "MARTES"; break;
		case 3: $mes = "MIERCOLES"; break;
		case 4: $mes = "JUEVES"; break;
		case 5: $mes = "VIERNES"; break;
		case 6: $mes = "SABADO"; break;
	}
	//Obtengo el nombre del mes.
	setlocale(LC_TIME, 'spanish');  
	$nombre=strftime("%B",mktime(0, 0, 0,DATE("m"), 1, 2000));
	
	echo '<p id = "cierra_sesion"><a href = "" onclick = "redireccionar()" >Cerrar Sesión</a></p>
		<div id = "contenedor_cabecera_info">
			<div id = "contenedor_fecha">
			'.$mes.',</br>'.date("d").' DE '.$nombre.' DE '.date("Y").'
			</div>
			
		<div id = "contenedor_datos_logeo_usuario">
			<table id = "tabla_contenedora_datos_usuario" >
				<tr>
					<td>
						<img id = "img_logo2" src = "../images/logo_toro_love.png" />
					</td>
					<td >
						<p id = "contenedor_datos_usuario_logeo">'.$_SESSION["nombre_usuario"]." (".$_SESSION["departamento_usuario"].')</p>
					</td>
				</tr>
			</table>
			
		</div>
		<div id = "contenedor_menu_navegacion">
			<table id= "contenedor_barra_navegacion" width = "100%">
				<tr>
					<td><a class = "link_internos" href = "gestion_empresa.php">GESTION</a></td>
					<td><a class = "link_internos" href = "trafico.php">TRÁFICO</a></td>
					<td>COTIZACION</td>
					<td><a class = "link_internos" href = "produccion.php">PRODUCCIÓN</a></td>
					<td>RECEPCIÓN FACTURAS</td>
					<td>FINANCIERO - COMERCIAL</td>
					<td>REPORTES</td>
				</tr>
			</table>
		</div>
	</div>'
?>