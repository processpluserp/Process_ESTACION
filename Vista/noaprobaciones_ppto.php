<?php
	include("../Controller/Conexion.php");
	
	if (isset($_POST["ppto"]) && !empty($_POST["vi"]) && !empty($_POST["vc"]) && !empty($_POST["user"]) && !empty($_POST["id"])) {
		
		//BORRO DE LOS PENDIENTES A TRAVÉS DEL ID EL PPTO QUE YA SE APROBÓ.
		mysql_query("update pendientes_aprobacion set estado = '0' where ppto = ".$_POST['ppto']." and vi = ".$_POST['vi']." and vc = ".$_POST['vc']."");
		mysql_query("START TRANSACTION");
			
			//GUARDO EN LA TABLA DE ESTATUS_APROBACIONES LA APROBACIÓN DEL USUARIO DEL NIVEL 1
			mysql_query("insert into estatus_aprobaciones(pk_id,user,estado_aprobacion,ppto,vi,vc,observaciones) values('".$_POST['id']."','".$_POST['user']."','".$_POST['estado']."','".$_POST['ppto']."','".$_POST['vi']."','".$_POST['vc']."','".$_POST['descc']."')");
			
			
			
			$empleado_no_aprobado = mysql_query("select e.nombre_empleado
			from usuario u, empleado e
			where u.idusuario = '".$_POST['user']."' and u.pk_empleado = e.documento_empleado");
			$nombre_empleado_no_aprobado = "";
			while($row = mysql_fetch_array($empleado_no_aprobado)){
				$nombre_empleado_no_aprobado = $row['nombre_empleado'];
			}
			
			include("cabecera_email.php");
			
			//CONSULTO EL CORREO DE LA PERSONA QUE MANDÓ A APROBAR EL PPTO Y LE INFORMO POR QUÉ FUE RECHAZADO
			$sql = mysql_query("select e.nombre_empleado, e.email_empleado
			from apropresup_histo ah, usuario u, empleado e
			where ah.id = '".$_POST['id']."' and ah.user = u.idusuario and u.pk_empleado = e.documento_empleado");
			
			if(mysql_num_rows($sql) != 0){
				
				//NOTIFICO Y GUARDO LA INFORMACIÓN DE LAS PERSONAS QUE SE VAN A NOTIFICAR DEL SIGUIENTE NIVEL.
				while($row = mysql_fetch_array($sql)){
					$mail->addAddress($row['email_empleado'], $row['nombre_empleado']);
				}
				
				//PONGO EL PPTO EN ESTADO BLOCK !
				mysql_query("update cabpresup set estado_presup = '100' where codigo_presup = '".$_POST['ppto']."'");
				
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
										EL PPTO INTERNO # ".$_POST['ppto']." VERSION INTERNA ".$_POST['vi']." - PPTO EXTERNO ".$_POST['vc']."  VERSION ".$_POST['vc']." NO HA SIDO APROBADO !!!
									</th>
								</tr>
								<tr>
									<th align = 'center'>
										EL USUARIO ".utf8_decode($nombre_empleado_no_aprobado)."
									</th>
								<tr>
									<th align = 'center'>
										<img src = 'http:process.toro-love.com:82/Process/images/Untitled-1-01.png' height = '80'/>
									</th>
								</tr>
							</table>
						</body>
					</html>";
					$mail->Subject = utf8_decode("PPTO NO APROBADO ! ".date("Y-m-d h:i:s"));
					
					$mail->msgHTML($ht);

					$mail->AltBody = 'This is a plain-text message body';
					
					if (!$mail->send()) {
					   echo "Se ha enviado una notificación a la persona que envió este presupuesto ha aprobación.";
					} else {
						echo "Se ha enviado una notificación a la persona que envió este presupuesto ha aprobación.";
					}
				
			}
		mysql_query("COMMIT");
	}else{
		ECHO ("No se han recibido los datos necesarios !");
	}
	
?>
