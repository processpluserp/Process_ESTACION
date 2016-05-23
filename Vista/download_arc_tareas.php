<?php
	if (!isset($_GET['archivo']) || empty($_GET['archivo'])) {
	   exit();
	}
	//Utilizamos basename por seguridad, devuelve el 
	//nombre del archivo eliminando cualquier ruta. 
	$archivo = basename($_GET['archivo']);
	$tarea = $_GET['tarea'];
	$ot = $_GET['ot'];
	$ruta = "../Process/OT/$ot/TAREAS/$tarea/".$archivo;

	if (is_file($ruta))
	{
	   /*header('Content-Type: application/force-download');
	   header('Content-Disposition: attachment; filename='.$archivo);
	   header('Content-Transfer-Encoding: binary');
	   header('Content-Length: '.filesize($ruta));
	   readfile($ruta);*/
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