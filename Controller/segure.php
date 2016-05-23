<?php
	//Reanudamos la sesión 
	@session_start(); 
	//Validamos si existe realmente una sesión activa o no 
	if($_SESSION["autentic"] != "SIP"){ 
	  //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión) 
	  header("Location:logeo.php"); 
	  exit(); 
	}else{
		header("Location:Vista/bienvenida.php"); 
		exit();
	}
?>