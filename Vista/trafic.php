<?php
	date_default_timezone_set('America/Bogota');
	include("../Controller/Conexion2.php");
	require("../Modelo/asistentes.php");
	session_start();
	
	$asis = new admin_trafico();
	
	$t = $_POST['turno'];
	if($t == 1){
		$est = "<table width = '100%' class = 'tabla_trafico'>
					<thead>
						<tr>
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
					</thead>
					<tbody>";
		echo $est;
		$asis->construct_trafic_fcliente($_SESSION["codigo_usuario"],$_POST['clie']);
	}else if($t == 2){
		$est = 1;
		$f = date("Y-m-d");
		$usu = $_SESSION["codigo_usuario"];
		mysql_query("insert into cuerpo_trafico(estado,user,cliente,producto,und,estatus,descr,inicio,fin,asunto) values('
		".$est."','".$usu."','".$_POST['cliente']."','".$_POST['producto']."','".$_POST['und']."','".$_POST['status']."','".
		$_POST['descc']."','".$f."','".$_POST['fecha']."','".$_POST['asunto']."')");
		
	}else if($t == 3){
		$est = "<table width = '100%' class = 'tabla_trafico'>
					<tr>
						<th colspan = '10' style = 'text-align:left;padding-left:20px;'>".$_POST['name']."</th>
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
		$est.=$asis->construct_traficx($_POST['empleado'])."</table>";
		echo $est;
	}else if($t == 4){
		$nueva_fecha = $_POST['fin'];
		$id = $_POST['id'];
		$preguntar = mysql_query("select * from cuerpo_trafico where id = '$id' and fin = '$nueva_fecha'");
		if(mysql_num_rows($preguntar) == 0){
			$copiar = mysql_query("select * from cuerpo_trafico where id = '$id'");
			while($row = mysql_fetch_array($copiar)){
				$estado = 10;
				$usu = $_SESSION["codigo_usuario"];
				$ff = date("Y-m-d H:i:s");
				mysql_query("insert into cuerpo_trafico(estado,user,cliente,producto,und,estatus,descr,inicio,fin,asunto,pk_id,registro) values('".$estado."','".$usu."','".$row['cliente']."','".$row['producto']."','".$row['und']."','".$row['estatus']."','".
				$row['descr']."','".$row['inicio']."','".$row['fin']."','".$row['asunto']."','".$id."','".$ff."')");
								
				mysql_query("update cuerpo_trafico set estatus = '".$_POST['estatus']."', descr = '".$_POST['descr']."',
				asunto = '".$_POST['asunto']."', fin = '".$_POST['fin']."' where id = '$id'");
							
			}
		}else{
			mysql_query("update cuerpo_trafico set estatus = '".$_POST['estatus']."', descr = '".$_POST['descr']."',
			asunto = '".$_POST['asunto']."' where id = '$id'");
		}
	}else if($t == 5){
		mysql_query("update cuerpo_trafico set estado = '5', pk_id = '".$_POST['id']."' where id = '".$_POST['id']."'");
	}else if($t == 6){
		$id = $_POST['id'];
		$sql = mysql_query("select * from cuerpo_trafico where pk_id = '$id' order by registro asc");
		$est = "<td colspan = '9' style = 'padding-left:20px;'><table width = '100%' class = 'tabla_trafico'>
					
					<tr>
						<th style = 'background-color:rgb(145, 141, 141);'>CLIENTE</th>
						<th style = 'background-color:rgb(145, 141, 141);'>PRODUCTO</th>
						<th style = 'background-color:rgb(145, 141, 141);'>UNIDAD</th>
						<th style = 'background-color:rgb(145, 141, 141);'>PROYECTO</th>
						<th style = 'background-color:rgb(145, 141, 141);'>TAREA</th>
						<th style = 'background-color:rgb(145, 141, 141);'>STATUS</th>
						<th style = 'background-color:rgb(145, 141, 141);'>INICIO</th>
						<th style = 'background-color:rgb(145, 141, 141);'>TERMINACIÓN</th>
						<th style = 'background-color:rgb(145, 141, 141);'>DURACIÓN</th>
					</tr>
				";
			while($row = mysql_fetch_array($sql)){
				$datetime1 = new DateTime($row['inicio']);
				$datetime2 = new DateTime($row['fin']);
				$interval = $datetime1->diff($datetime2);
				$est.= "<tr>
					<td style = 'vertical-align:middle;'>".($row['cliente'])."</td>
					<td>".($row['producto'])."</td>
					<td>".($row['und'])."</td>
					<td >".nl2br($row['estatus'])."</td>
					<td >".nl2br($row['descr'])."</td>
					<td >".nl2br($row['asunto'])."</td>
					<td nowrap align = 'center'>".nl2br($row['inicio'])."</td>
					<td nowrap align = 'center' >".($row['fin'])."</td>
					<td nowrap align = 'center'>".$interval->format('%a Días')."</td>
				</tr>";
			}
			echo $est."</td>";
	}
	
?>

