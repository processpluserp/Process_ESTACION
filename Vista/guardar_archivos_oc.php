<?php

	$nombre_oc = $_POST['noo'];
	$destino = "../Process/OC/";
	if(file_exists($destino)){
		move_uploaded_file($_FILES['arch']['tmp_name'],"../Process/OC/".$nombre_oc."-".$_FILES['arch']['name']);
	}else{
		mkdir($destino);
		move_uploaded_file($_FILES['arch']['tmp_name'],"../Process/OC/".$nombre_oc."-".$_FILES['arch']['name']);
	}
	echo $nombre_oc."-".$_FILES['arch']['name'];
	
	
	
?>