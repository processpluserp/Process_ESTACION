<!DOCTYPE html>
	<html>
	
<?php
	require("Controller/Conexion.php");
	
	//$message = file_get_contents("index.html");
	
	$mensaje = "<html>
		
					<body>";

	
	//$cabecera = "From: damian.mosquera@grupolaestacion.com" . "\r\n";
	$cabecera = "From: soporte.processplues@gmail.com" . "\r\n";
	$cabecera .= 'Cc: <damian.mosquera@grupolaestacion.com>' . "\r\n";
	$cabecera .= "MIME-Version: 1.0\r\n";
	$cabecera .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	
	$num_correos = 0;
	$sql = mysql_query("select codigo_documento,nombre_documento from tipodoc");
	$sql_empresa = mysql_query("select cod_interno_empresa from empresa where estado = '1'");
	//while($emp = mysql_fetch_array($sql_empresa)){
	
		
		while($row = mysql_fetch_array($sql)){
			$sql2 = mysql_query("select consecutivo,fvencimiento,pk_empresa from  documentos_legales_entidades where pk_tdocumento = '".$row['codigo_documento']."' order by pk_empresa asc");			
			if(mysql_num_rows($sql2) != 0){
				while($doc = mysql_fetch_array($sql2)){
					$datetime1 = new DateTime(date("Y-m-d"));
					$datetime2 = new DateTime($doc['fvencimiento']);
					$interval = $datetime1->diff($datetime2);
					
					if($interval->format('%a') < 15){
						$sql3 = mysql_query("select empleado from notificaciones where codigo = '".$row['codigo_documento']."' and empresa = '".$doc['pk_empresa']."' and tipo = 'DOC'");
						$num_correos = mysql_num_rows($sql3);
						if(mysql_num_rows($sql3) > 0){
							$i = 0;
							$para = "";
							while($cor = mysql_fetch_array($sql3)){
								$i++;
								if($i < $num_correos){
									$para .=$cor['empleado'].",";
								}else{
									$para .=$cor['empleado'];
								}
							}
						//$para = "damian.mosquera@grupolaestacion.com";
						$asunto = "VENCIMIENTO ".strtoupper($row['nombre_documento']);
						$mensaje = utf8_decode("<h3>Buenos días</h3>
						<strong><p style = 'font-size:1.1em;'>PROCESS le informa que el documento ").( ($row['nombre_documento'])).utf8_decode(" <span style = 'color:red;'>vence el  ".$doc['fvencimiento'].".</span>
						Por favor, diríjase al módulo de Gestión y actualice este documento.</p></body></html>");
						if(mail($para, $asunto, $mensaje, $cabecera)) {
							echo 'Correo enviado</BR>';
						}else {
							echo 'Error al enviar mensaje</BR>';
							}
						}
					}else{
						echo utf8_decode( "EL DOCUMENTO ".strtoupper($row['nombre_documento'])." ESTÁ AL DÍA, SE VENCE  EL DÍA ".$doc['fvencimiento']."; ES DECIR EN ".$interval->format('%a')." DÍAS</BR>");
					}		
				}
			}
		}
		echo "FECHA DE EJECUCIÓN ".date("Y-m-d H:m:s");
	//}
	
	
	
	
	date_default_timezone_set('Etc/UTC');

	require 'Vista/PHPMailerAutoload.php';



	$mail = new PHPMailer;

	$mail->isSMTP();

	$mail->Debugoutput = 'html';


	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;

	$mail->SMTPSecure = 'tls';

	$mail->SMTPAuth = true;

	$mail->Username = "soporteprocessplues@gmail.com";

	$mail->Password = "12345678#$#$";

	
	$mail->Subject = utf8_decode("Cumpleaños ").date("Y-m-d");

	$correos = mysql_query("select email_empleado,nombre_empleado from empleado where estado = '1'");
	while($row = mysql_fetch_array($correos)){
		$mail->addAddress($row['email_empleado'],utf8_decode($row['nombre_empleado']));	
	}
	
	$mail->setFrom("soporteprocessplues@gmail.com", "Process Plus");
	//$mail->addAddress('juan.bermudez@toro-love.com','Juan Bermudez');	
	
	$num_correos = 0;
	$asunto = utf8_decode("CUMPLEAÑOS ".date("Y-m-d"));
	$repeat_div1 = "";
	$sql = mysql_query("select e.nombre_empleado,e.fecha_nacimiento,e.foto,emp.logo,e.cargo_empleado
								from empleado e, empresa emp
								where month(e.fecha_nacimiento) = month(SYSDATE()) AND (day(e.fecha_nacimiento)) = (day(SYSDATE())) and  e.pk_empresa = emp.cod_interno_empresa");
								
	if(mysql_num_rows($sql) > 0){
		if(mysql_num_rows($sql) > 3){
			$repeat_div1 = "repeat-y";
		}else if(mysql_num_rows($sql) <= 3){
			$repeat_div1 = "no-repeat";
		}
		$ht = "
		<!DOCTYPE html>
			<html lang='es'>
				<head>
					<title>:: PROCESS + ::</title>
					<meta charset='utf-8' />
				</head>
				<body>
					<div class = 'contenedor_principal' style = 'background-image: url(http:process.toro-love.com:82/Process/images/cumple/fondo.jpg);background-repeat:$repeat_div1;width:800px;height:800px;'>
						<div class = 'tarjeta' style = 'background-image: url(http:process.toro-love.com:82/Process/images/cumple/tarjeta.png);background-repeat:$repeat_div1;width:800px;height:800px;z-index:100;position:absolute;left:400px;top:400px;''>
							<div class = 'contenido' style = 'height:300px;	width:500px;z-index:150;padding-left:250px;padding-top:100px;'>
									<table width = '100%'>";
									
									$sql = mysql_query("select e.nombre_empleado,e.fecha_nacimiento,e.foto,emp.logo,e.cargo_empleado
									from empleado e, empresa emp
									where month(e.fecha_nacimiento) = month(SYSDATE()) AND (day(e.fecha_nacimiento)) = (day(SYSDATE())) and e.pk_empresa = emp.cod_interno_empresa");
									
									$i = 0;
									while($row = mysql_fetch_array($sql)){
										if($i == 3){
											$i = 0;
											for($x = 0;$x < 7;$x++){
												$ht.="<tr><td colspan = '4' style = 'color:transparent;'>$i</td></tr>";
											}
										}else{
											$foto_foto = "";
											if($row['foto'] != ""){
												$foto_foto = "<tr>
																<td rowspan = '4'>
																	<img src = 'http:process.toro-love.com:82/Process/Process/EMPLEADO/".$row['foto']."' width = '150px' height = '150px' title = '".$row['nombre_empleado']."' style ='border-radius:1em;'/>
																</td>
															</tr>";
											}
											$ht.= "
											$foto_foto
											<tr>
												<td style = 'vertical-aling:top;'><strong>".utf8_decode($row['nombre_empleado'])."</strong></td>
											</tr>
											<tr>
												<td style = 'vertical-aling:top;'><strong>CARGO: ".utf8_decode($row['cargo_empleado'])."</strong></td>
											</tr>
											<tr>
												<td style = 'vertical-aling:top;'>
													<img src = 'http:process.toro-love.com:82/Process/images/logos/".$row['logo']."' width = '250px' height = 'auto' />
												</td>
											</tr>";
											$i++;
										}
										
									}
								
							$ht.="</table>
							</div>
						</div>
					</div>
				</body>
			</html>";


		$mail->msgHTML($ht);
		//$mail->msgHTML(file_get_contents('tarjeta.php'));

		$mail->AltBody = 'This is a plain-text message body';
		if (!$mail->send()) {
		   echo "Error al enviar el mensaje: " . $mail->ErrorInfo;
		} else {
			echo "Enviado".date("Y-m-d h:i:s");
		}
	}
								
	
	
	
?>
</html>
