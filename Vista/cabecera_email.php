<?php
	
	require 'Mailer/PHPMailerAutoload.php';
	
	$mail = new PHPMailer;

	$mail->isSMTP();

	$mail->Debugoutput = 'html';


	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;

	$mail->SMTPSecure = 'tls';

	$mail->SMTPAuth = true;

	$mail->Username = "soporteprocessplues@gmail.com";

	$mail->Password = "12345678#$#$";
	
	$mail->setFrom("soporteprocessplues@gmail.com", "Process Plus");
	
?>