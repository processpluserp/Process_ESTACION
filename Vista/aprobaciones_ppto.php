<?php
	include("../Controller/Conexion.php");
	
	if (isset($_POST["ppto"]) && !empty($_POST["vi"]) && !empty($_POST["vc"]) && !empty($_POST["user"]) && !empty($_POST["id"])) {
		
		mysql_query("START TRANSACTION");
			
			//GUARDO EN LA TABLA DE ESTATUS_APROBACIONES LA APROBACIÓN DEL USUARIO DEL NIVEL 1
			mysql_query("insert into estatus_aprobaciones(pk_id,user,estado_aprobacion,ppto,vi,vc) values('".$_POST['id']."','".$_POST['user']."','".$_POST['estado']."','".$_POST['ppto']."','".$_POST['vi']."','".$_POST['vc']."')");
			
			//BORRO DE LOS PENDIENTES A TRAVÉS DEL ID EL PPTO QUE YA SE APROBÓ.
			mysql_query("update pendientes_aprobacion set estado = '0' where ppto = '".$_POST['ppto']."' and vi = '".$_POST['vi']."' and vc = '".$_POST['vc']."' and pk_id = '".$_POST['id']."'");
			
			include("cabecera_email.php");
			
			//CONSULTAMOS EN QUÉ NIVEL DE APROBACIONES SE ENCUENTRA EL PPTO A TRAVÉS DEL ID.
			$sql_level_actual = mysql_query("select level,und from nivel_ppto_apro where pk_histo = '".$_POST['id']."'");
			$level = 0;
			$und_level = 0;
			while($row = mysql_fetch_array($sql_level_actual)){
				$level = $row['level'];
				$und_level = $row['und'];
			}
			
			
			$cliente = 0;
		$sql_porcentaje_minimo = mysql_query("select rc.porcentaje,rc.cliente from rentabilidad_cliente rc, cabpresup p
		where p.codigo_presup = '$ppto' and p.pk_clientes_nit_cliente = rc.cliente");
		
		while($row = mysql_fetch_array($sql_porcentaje_minimo)){
			$porcenjate_min = $row['porcentaje'];
			$cliente = $row['cliente'];
		}
			//CONSULTO EL MÍNIMO DE 
			
			//PASAMOS AL SIGUIENTE NIVEL Y CONSULTO A QUIÉNES TENGO QUE NOTIFICAR.
			$level++;
			$por_donde = "";
			if($_POST['up_bottom'] == 1){
				$por_donde = " and ej.mayor = '1' ";
			}else{
				$por_donde = " and ej.menor = '1' ";
			}
			$sql_nex_apro = mysql_query("select e.nombre_empleado, e.email_empleado, u.idusuario
			from estructura_jerarquia ej, user_aprobaciones_ppto userpp, usuario u, empleado e
			where ej.cliente = '$cliente' and ej.orden = '$level' $por_donde and ej.id = userpp.pk_jerarquia and userpp.pk_usuario = u.idusuario and u.pk_empleado = e.documento_empleado");
			
			if(mysql_num_rows($sql_nex_apro) != 0){
				
				//NOTIFICO Y GUARDO LA INFORMACIÓN DE LAS PERSONAS QUE SE VAN A NOTIFICAR DEL SIGUIENTE NIVEL.
				$user_vector = array();
				$ii = 0;
				while($row = mysql_fetch_array($sql_nex_apro)){
					$user_vector[$ii] = $row['idusuario'];
					$ii++;
					$mail->addAddress($row['email_empleado'], $row['nombre_empleado']);
				}
				
				//INSERTO EN LA TABLA DE PENDIENTES LOS USUARIOS A LOS CUALES SE NOTIFICA QUE TIENEN APROBACIÓN
				for($x = 0; $x < count($user_vector); $x++){
					$estado = 1;
					mysql_query("insert into pendientes_aprobacion(pk_id,ppto,vi,vc,user,estado) values('".$_POST['id']."','".$_POST['ppto']."','".$_POST['vi']."','".$_POST['vc']."','".$user_vector[$x]."','".$estado."')");
				}
				
				
				//ACTUALIZO EL NIVEL DE APROBACION EN EL QUE SE ENCUENTRA EL PPTO.
				mysql_query("update nivel_ppto_apro set level = '$level' where pk_histo = '".$_POST['id']."' and und = '$und_level'");
				
				
		
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
										HA SIDO ENVIADO EL PPTO INTERNO # ".$_POST['ppto']." VERSION INTERNA ".$_POST['vi']." - PPTO EXTERNO ".$_POST['vc']."  VERSION ".$_POST['vc']." A APROBACIÓN							
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
					$mail->Subject = utf8_decode("Presupuesto pendiente de aprobación ".date("Y-m-d h:i:s"));
					
					$mail->msgHTML($ht);

					$mail->AltBody = 'This is a plain-text message body';
					
					if (!$mail->send()) {
					   echo "El presupuesto ".$_POST['ppto']." fue aprobado exitosamente !\nEn breve se enviará el correo notificando a las personas implicadas !";
					} else {
						echo "El presupuesto ".$_POST['ppto']." fue aprobado exitosamente !";
					}
				
			}else{
				
				$cliente = 0;
				$sql_porcentaje_minimo = mysql_query("select rc.porcentaje,rc.cliente from rentabilidad_cliente rc, cabpresup p
				where p.codigo_presup = '$ppto' and p.pk_clientes_nit_cliente = rc.cliente");
				
				while($row = mysql_fetch_array($sql_porcentaje_minimo)){
					$porcenjate_min = $row['porcentaje'];
					$cliente = $row['cliente'];
				}
				
				if($cliente == 1){
					mysql_query("update cabpresup set estado_presup = '5' where codigo_presup = '".$_POST['ppto']."'");
				}else{
					mysql_query("update cabpresup set estado_presup = '4' where codigo_presup = '".$_POST['ppto']."'");
				}
				
				
				$sql_notificar_user = mysql_query("select e.nombre_empleado, e.email_empleado
				from apropresup_histo histo, usuario u, empleado e
				where histo.id = '".$_POST['id']."' and histo.user = u.idusuario and u.pk_empleado = e.documento_empleado");
				
				while($row = mysql_fetch_array($sql_notificar_user)){
					$mail->addAddress($row['email_empleado'], $row['nombre_empleado']);
				}
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
										HA SIDO ENVIADO EL PPTO INTERNO # ".$_POST['ppto']." VERSION INTERNA ".$_POST['vi']." - PPTO EXTERNO ".$_POST['vc']."  VERSION ".$_POST['vc']." A APROBACIÓN							
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
				$mail->Subject = utf8_decode("PRESUPUESTO APROBADO ! ".date("Y-m-d h:i:s"));
				
				$mail->msgHTML($ht);

				$mail->AltBody = 'This is a plain-text message body';
				
				if (!$mail->send()) {
				    echo "El presupuesto ".$_POST['ppto']." fue aprobado exitosamente !\nEn breve se enviará el correo notificando a las personas implicadas !";
				} else {
					echo "El presupuesto ".$_POST['ppto']." fue aprobado exitosamente !";
				}
			}
			
			
		mysql_query("COMMIT");
		
		
	}
	
?>
