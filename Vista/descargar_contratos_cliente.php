<?php
	if (!isset($_GET['archivo']) || empty($_GET['archivo'])) {
	   exit();
	}

	
	$archivo = basename($_GET['archivo']);
	$clie = $_GET['clie'];
	$ruta = "../Process/CLIENTE/$clie/CONTRATOS/".$archivo;

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