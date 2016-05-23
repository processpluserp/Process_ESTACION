<?php
	include("../controller/Conexion2.php");
	require("../Modelo/asistentes.php");
	session_start();
	$asis = new admin_trafico();
	/*if($_SESSION["codigo_usuario"] == ""){
		header("location:../logeo.php");
	}*/
?>
<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>PROCESS +</title>
			<meta charset="utf-8" />
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script type = "text/javascript"src="../js/jquery_datatables.js"></script>
			<script type="text/javascript" src="../js/traficoadmin.js"></script>
			<script type="text/javascript" src="../js/trafico.js"></script>
			
			<link rel="stylesheet" href="../css/jquery-ui.css">
			<link rel="stylesheet" href="../css/trafico.css">
			<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
			<link type="text/css" href="../css/tablas.css" rel="stylesheet" />
			<link type="text/css" href="../css/cabecera.css" rel="stylesheet" />
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
			<style >
				body{
					font-family:'Arial';
				}
				.tabla_trafico th{
					background-color:rgb(210, 71, 46);
					color:white;
					padding:5px;
					font-size:14px;
				}
				.tabla_trafico{
					border-collapse: collapse;
				}
				.tabla_trafico tr:first-child th:first-child{
					border-top-left-radius:1.5em;
					-webkit-border-top-left-radius:1.5em;
					-moz-border-top-left-radius:1.5em;
				}
				.tabla_trafico tr:first-child th:last-child{
					border-top-right-radius:1.5em;
					-webkit-border-top-right-radius:1.5em;
					-moz-border-top-right-radius:1.5em;
					
				}
				.tabla_trafico td{
					border:1px solid black;
					font-size:13px;
					
				}
				.cajas{
					padding:2px;
					border-radius:0.3em;
					-webkit-border-radius:0.3em;
					-moz-border-radius:0.3em;
				}
				select{
					border-radius:0.3em;
					-webkit-border-radius:0.3em;
					-moz-border-radius:0.3em;
					padding:5px;
				}
			</style>
		</head>
		
		<body>
			<h1 style = 'text-align:center;'>TRÁFICO ADMINISTRATIVO</h1>
			<div id = 'filtros' >
				<table style ='padding-left:50px;'>
					<tr>
						<p>Seleccione un Empleado:</p>
						<?php
							$personass = mysql_query("select distinct user from cuerpo_trafico ");
							$personas = array();
							$i = 0;
							while($row = mysql_fetch_array($personass)){
								$personas[$i] = $row['user'];
								$i++;
							}
							
							include("../controller/Conexion.php");
							$names = array();
							$list = "";
							for($x = 0;$x < count($personas); $x++){
								$sql = mysql_query("select e.nombre_empleado
								from empleado e, usuario u 
								where u.idusuario = '$personas[$x]' and u.pk_empleado = e.documento_empleado");
								while($row = mysql_fetch_array($sql)){
									$names[$x] = $row['nombre_empleado'];
									$list.="<option value = '$personas[$x]'>".$row['nombre_empleado']."</option>";
								}
							}
						?>
						<select id = 'filtro_cliente' onchange = 'filtrar_por_empleado()'>
							<option value = "" selected>[TODOS]</option>
							<?php
								echo $list;
							?>
						</select>
					</tr>
				</table>
			</div>
			
			<div id  = 'contenedor_trafico' >
				<?php
					
					echo "</br><div id = 'trafico_empleados'>";
					include("../controller/Conexion2.php");
					for($x = 0;$x < count($personas); $x++){
						$est = "<table width = '100%' class = 'tabla_trafico'>
							<tr>
								
								<th colspan = '10' style = 'text-align:left;padding-left:10px;'>".$names[$x]."</th>
							</tr>
							<tr><td style = 'border:0px;background-color:white;'></td></tr>
							<tr><td style = 'border:0px;background-color:white;'></td></tr>
							<tr>
								<th >#</th>
								<th>CLIENTE</th>
								<th>PRODUCTO</th>
								<th>UNIDAD</th>
								<th>PROYECTO</th>
								<th>TAREA</th>
								<th>STATUS</th>
								<th>INICIO</th>
								<th>TERMINACIÓN</th>
								<th>DURACIÓN</th>
							</tr>
						";
						$est.=$asis->construct_traficx($personas[$x])."</table>";
						echo $est."</br>";
					}
					echo "</div>";
				?>
			</div>
		</body>
	</html>
	
	