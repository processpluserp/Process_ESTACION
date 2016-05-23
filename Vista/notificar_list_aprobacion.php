<?php
	date_default_timezone_set('Etc/UTC');

	if (isset($_POST["ppto"]) && !empty($_POST["vi"]) && !empty($_POST["vc"]) && !empty($_POST["user"]) && !empty($_POST["ppto_ext"])) {
		
		
		include("../Controller/Conexion.php");
		include("cabecera_email.php");
		
		//Recibo los valores del POST
		
		$user = $_POST['user'];
		$ppto = $_POST['ppto'];
		$vi = $_POST['vi'];
		$vc = $_POST['vc'];
		$ppto_ext = $_POST['ppto_ext'];
		
		$sql_und_user = mysql_query("select e.und
		from usuario u, empleado e
		where u.idusuario = '$user' and u.pk_empleado = e.documento_empleado");
		$und_empleado = 0;
		
		while($row = mysql_fetch_array($sql_und_user)){
			$und_empleado = $row['und'];
		}
		
		$sql_mayor_menor = mysql_query("select admin.min_ppto
		from und u, administrativa admin
		where u.id = '$und_empleado' and u.empresa = admin.empresa and year = '".date("Y")."'");
		//porcentaje
		
		$sql_list_apro_level_first = "";
		$porcenjate_min = 0;
		$up_bottom = 0;
		
		while($row = mysql_fetch_array($sql_mayor_menor)){
			$porcenjate_min = $row['min_ppto'];
		}
		$cliente = 0;
		$sql_porcentaje_minimo = mysql_query("select rc.porcentaje,rc.cliente from rentabilidad_cliente rc, cabpresup p
		where p.codigo_presup = '$ppto' and p.pk_clientes_nit_cliente = rc.cliente");
		
		while($row = mysql_fetch_array($sql_porcentaje_minimo)){
			$porcenjate_min = $row['porcentaje'];
			$cliente = $row['cliente'];
		}
		if($_POST['porcentaje'] > $porcenjate_min){
			$up_bottom = 1;
			$sql_list_apro_level_first = mysql_query("select e.nombre_empleado, e.email_empleado, u.idusuario
			from estructura_jerarquia ej, user_aprobaciones_ppto userpp, usuario u, empleado e
			where ej.cliente = '$cliente' and ej.orden = '1' and ej.mayor = '1' and
			ej.id = userpp.pk_jerarquia and userpp.pk_usuario = u.idusuario and u.pk_empleado = e.documento_empleado");
		}else{
			$up_bottom = 0;
			$sql_list_apro_level_first = mysql_query("select e.nombre_empleado, e.email_empleado, u.idusuario
			from estructura_jerarquia ej, user_aprobaciones_ppto userpp, usuario u, empleado e
			where ej.cliente = '$cliente' and ej.orden = '1' and ej.menor = '1' and
			ej.id = userpp.pk_jerarquia and userpp.pk_usuario = u.idusuario and u.pk_empleado = e.documento_empleado");
		}
		$user_vector = array();
		$ii = 0;
		
		while($row = mysql_fetch_array($sql_list_apro_level_first)){
			$user_vector[$ii] = $row['idusuario'];
			$ii++;
			$mail->addAddress($row['email_empleado'], $row['nombre_empleado']);
		}
		
		if($_POST['porcentaje'] > $porcenjate_min){
			$up_bottom = 1;
			$sql_list_apro_level_first = mysql_query("select e.nombre_empleado, e.email_empleado, u.idusuario
			from estructura_jerarquia ej, user_aprobaciones_ppto userpp, usuario u, empleado e
			where ej.cliente = '$cliente' and ej.orden = '1' and ej.mayor = '1' and
			ej.id = userpp.pk_jerarquia and userpp.pk_usuario = u.idusuario and u.pk_empleado = e.documento_empleado");
		}else{
			$up_bottom = 0;
			$sql_list_apro_level_first = mysql_query("select e.nombre_empleado, e.email_empleado, u.idusuario
			from estructura_jerarquia ej, user_aprobaciones_ppto userpp, usuario u, empleado e
			where ej.cliente = '$cliente' and ej.orden = '1' and ej.menor = '1' and
			ej.id = userpp.pk_jerarquia and userpp.pk_usuario = u.idusuario and u.pk_empleado = e.documento_empleado");
		}
		
		$validar_si_existe = mysql_num_rows($sql_list_apro_level_first);
		if($validar_si_existe > 0){
			mysql_query("START TRANSACTION");
		
				//GUARDO EN LA TABLA QUE EL PPTO FUE ENVIADO A APROBACIÓN
				mysql_query("INSERT INTO apropresup_histo(ppto,vi,vc,user,porcentaje,up_bottom,comentarios) values ('".$ppto."','".$vi."','".$vc."','".$user."','".$_POST['porcentaje']."','".$up_bottom."','".$_POST['descc']."')");
				
				//CAMBIO EL PPTO A EN PROCESO
				mysql_query("update cabpresup set estado_presup = '3' where codigo_presup = '$ppto'");
				
				//BUSCO EL ULTIMO ID INSERTADO.
				$max_id = "";
				$sql_max_id = mysql_query("select max(id) as id from apropresup_histo");
				while($row = mysql_fetch_array($sql_max_id)){
					$max_id = $row['id'];
				}
				$level = 1;
				
				//INSERTO EN LA TABLA DE PENDIENTES LOS USUARIOS A LOS CUALES SE NOTIFICA QUE TIENEN APROBACIÓN
				for($x = 0; $x < count($user_vector); $x++){
					$estado = 1;
					mysql_query("insert into pendientes_aprobacion(pk_id,ppto,vi,vc,user,estado) values('".$max_id."','".$ppto."','".$vi."','".$vc."','".$user_vector[$x]."','".$estado."')");
				}
				
				//GUARDO EL NIVEL VIGENTE EN DONDE ESTÁ EL PPTO.
				mysql_query("insert into nivel_ppto_apro(pk_histo,level,und) values('".$max_id."','".$level."','".$und_empleado."')");
				
				
			mysql_query("COMMIT");
			
			
			$ht = "
				<html>
					<head>
						<link type='text/css' href='../css/tablas.css' rel='stylesheet'>
						<link type='text/css' href='../css/cabecera.css' rel='stylesheet'>
						<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
						
						<style type = 'text/css'>
							.tabla_comprimosos_ie th{
								border:1px solid black;
								background-color:white;
							}
							.tabla_comprimosos_ie td{
								border:1px solid black;
							}
							.tabla_comprimosos_ie th:first-child{
								border-top-left-radius:0.3em;
								-moz-border-top-left-radius:0.3em;
								-webkit-border-top-left-radius:0.3em;
							}
							.tabla_comprimosos_ie th:last-child{
								border-top-right-radius:0.3em;
								-moz-border-top-right-radius:0.3em;
								-webkit-border-top-right-radius:0.3em;
							}
						</style>
					</head>
				<body>
					<table width = '100%'>
						<tr>
							<th align = 'center'>
								HA SIDO ENVIADO EL PPTO INTERNO # ".$ppto." VERSION INTERNA ".$vi." - PPTO EXTERNO ".$ppto_ext."  VERSION ".$vc." A APROBACIÓN							
							</th>
						</tr>
						<tr>
							<th align = 'center'>
								ENTRE A PROCESS PLUS Y REVISE ESTE PPTO.
							</th>
						<tr>
							<th align = 'center'>
								<img src = 'http:process.toro-love.com:82/Process/images/Untitled-1-01.png' height = '80'/>
							</th>
						</tr>
					</table>
				</body>
			</html>";
			$mail->Subject = utf8_decode("NUEVA APROBACIÓN DE PPTO ! ".date("Y-m-d h:i:s"));
			
			$mail->msgHTML($ht);

			$mail->AltBody = 'This is a plain-text message body';
			
			
			if (!$mail->send()) {
			   echo $mail->ErrorInfo;
			} else {
				echo true;
			}
		}else{
			echo 0;
		}
		
		
	}else{  
		echo false;
	}
	
	
	

?>