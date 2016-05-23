<?php
	date_default_timezone_set('Etc/UTC');

require 'Mailer/PHPMailerAutoload.php';
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com';
//$mail->Host = 'ssl://smtp.gmail.com';
$mail->SMTPAuth= true;
$mail->Username='soporteprocessplues@gmail.com';
$mail->Password='12345678#$#$';
$mail->Port = 587; 
//$mail->Port       = 26;     
$mail->SMTPDebug = 2; 
//$mail->SMTPSecure = 'ssl';
$mail->SetFrom('ooodam15@gmail.com', 'Name');
$mail->AddAddress('damian.mosquera@grupolaestacion.com', 'HisName');
$mail->Subject = 'Subject';
$mail->Subject = "Here is the subject";
$mail->Body    = "This is the HTML message body <b>in bold!</b>";
$mail->AltBody = "This is the body in plain text for non-HTML mail    clients";
if(!$mail->Send()) {
echo 'Error : ' . $mail->ErrorInfo;
} else {
    echo 'Ok!!';
  } 


/*$mail = new PHPMailer;

$mail->isSMTP();

$mail->Debugoutput = 'html';


$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;

$mail->SMTPSecure = 'ssl';

$mail->SMTPAuth = true;

$mail->Username = "soporteprocessplues@gmail.com";

$mail->Password = "12345678#$#$";

$mail->SMTPDebug = 2;

$mail->addAddress("damian.mosquera@grupolaestacion.com", "damian");

$mail->Subject = "Hla";

$mail->msgHTML("haghasddsahdashasd");

$mail->AltBody = 'This is a plain-text message body';

/*if (!$mail->send()) {
   $vari = 0;
   echo "Error al enviar el mensaje: " . $mail->ErrorInfo;
} else {
    echo"bn";
}
echo "</br>".gethostbyname("process.toro-love.com");
var_export (dns_get_record ( "host.name.tld") );*/
?>