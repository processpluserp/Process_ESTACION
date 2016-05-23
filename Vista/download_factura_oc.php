<?php
	if (!isset($_GET['archivo'])) {
	   exit();
	}
	//Utilizamos basename por seguridad, devuelve el 
	//nombre del archivo eliminando cualquier ruta. 
	$archivo = basename($_GET['archivo']);
	$ot = $_GET['oc'];
	$ruta = "../Process/OC/$oc-".$archivo;

	if (is_file($ruta))
	{
	   
	    header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($ruta).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($ruta));
		readfile($ruta);
		exit;
	}
	else
	   exit();
?>