<?php
	include("../Controller/Conexion.php");
	
	$user = 13;
	
	$est = "<table width = '100%' class = 'tabla_trafico'>
					<tr>
						<th>UND</th>
						<th>ASUNTO</th>
						<th>DESCRIPCIÓN</th>
						<th>STATUS</th>
						<th>INICIO</th>
						<th>TERMINACIÓN</th>
						<th>DURACIÓN</th>
					</tr>";
		echo $est;
?>
<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>PROCESS +</title>
			<meta charset="utf-8" />
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			<style >
				body{
					font-family:'Arial';
				}
				.tabla_trafico th{
					background-color:rgb(210, 71, 46);
					color:white;
					padding:5px;
					
				}
				.tabla_trafico{
					border-collapse: collapse;
				}
				.tabla_trafico th:first-child{
					border-top-left-radius:1.5em;
				}
				.tabla_trafico th:last-child{
					border-top-right-radius:1.5em;
				}
				.tabla_trafico td{
					border:1px solid black;
					padding:3px;
				}
				.cajas{
					padding:5px;
				}
			</style>
		</head>
		<body>
			<?php
				$em = mysql_query("select e.documento_empleado, ot.codigo_ot, t.codigo_int_tarea, tt.name_ttarea, t.trabajo,t.descripcion,t.estado,t.fecha_registro,t.fecha_prometida
				from empleado e, usuario u, clientes c, cabot ot, tareas t, tipo_tarea tt
				where u.idusuario = '$user' and u.pk_empleado = e.documento_empleado and c.nit_cliente = e.documento_empleado and 
				c.codigo_interno_cliente = ot.producto_clientes_pk_clientes_nit_procliente and ot.codigo_ot = t.pk_ot and t.tipo_tarea_codigo_tipotarea = tt.codigo_tipotarea and t.estado = 0");
				
				while($row = mysql_fetch_array($em)){
					$estado = "";
					$fe = explode(" ",$row['fecha_registro']);
					if($row['estado'] == 0){
						$estado = "EN PROCESO";
					}else if($row['estado'] == 1){
						$estado = "CONTINÚA EN PROCESO";
					}else if($row['estado'] == 2){
						$estado = "TERMINADA";
					}
					echo "<tr>
						<td  nowrap>".$row['name_ttarea']."</td>
						<td>".nl2br($row['trabajo'])."</td>
						<td>".nl2br($row['descripcion'])."</td>
						<td align = 'center' nowrap>".($estado)."</td>
						<td align = 'center' nowrap>".$fe[0]."</td>
						<td align = 'center' nowrap>".$row['fecha_prometida']."</td>
						<td align = 'center' nowrap></td>
					</tr>";
				}
			?>
		</body>
	</html>