<?php
	if (!isset($_GET['archivo']) || empty($_GET['archivo'])) {
	   exit();
	}
	//Utilizamos basename por seguridad, devuelve el 
	//nombre del archivo eliminando cualquier ruta. 
	$archivo = basename($_GET['archivo']);
	$prove = $_GET['prove'];
	$ruta = "../Process/PROVEEDOR/$prove/DOCUMENTOS/".$archivo;

	if (is_file($ruta))
	{
	   header('Content-Type: application/force-download');
	   header('Content-Disposition: attachment; filename='.$archivo);
	   header('Content-Transfer-Encoding: binary');
	   header('Content-Length: '.filesize($ruta));
	   readfile($ruta);
	}
	else
	   exit();
?>