<?php
	include("../Controller/Conexion.php");
	
	$name = $_POST['name'];
	$sql_interno = mysql_query("select name,id from item_tarifario where name like '$name%'");
	
	$estructura = "<table width = '100%'>
		<tr>
			<td colspan = '2'>INT: Interno</td>
		</tr>
		<tr>
			<td colspan = '2'>CLIE: Cliente</td>
		</tr>
	";
	
	while($row = mysql_fetch_array($sql_interno)){
		$estructura .="<tr>
			<td nowrap style = 'background-color:#D0DEF4;'  align = 'center'>
				<div>
					<input type = 'radio'  id = 'tarifarioint".$row['id']."'  value = '".$row['id']."' class = 'radio' onclick = 'alimentar_ppto_interno(".$row['id'].",".$_POST['id'].")'/>
					<label for='tarifarioint".$row['id']."'><span><span></span></span></label>
				</div>
			</td>
			<td nowrap style = 'background-color:#D0DEF4;'>(INT) ".utf8_decode($row['name'])."</td>
		</tr>";
	}
	
	
	$cliente = $_POST['cliente'];
	
	$sql_externo = mysql_query("select name,id from tarifario_cliente where pk_cliente = '$cliente' AND name like '$name%'");
	
	
	
	while($row = mysql_fetch_array($sql_externo)){
		$estructura .="<tr>
			<td nowrap style = 'background-color:white;' align = 'center'>
				<div>
					<input type = 'radio'  id = 'tarifarioclie".$row['id']."'  value = '".$row['id']."' class = 'radio' onclick = 'alimentar_ppto_externo(".$row['id'].",".$_POST['id'].")'/>/>
					<label for='tarifarioclie".$row['id']."'><span><span></span></span></label>
				</div>
			</td>
			<td nowrap style = 'background-color:white;'>(CLIE) ".utf8_decode($row['name'])."</td>
		</tr>";
	}
	
	echo $estructura."</table>";
?>