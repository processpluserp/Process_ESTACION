<?php
	include("../Modelo/cabecera_ot.php");
	
	
	$ot = new cabecera_ot();
	$nombre_ot = ($_POST['ot']);
	$destino = "../Process/OT/$nombre_ot/IE";
	$arc = "";
	if(file_exists($destino)){
		for($tx = 0; $tx < $_POST['num_archivos']; $tx++){
			$arc .= $_FILES['arc'.$tx]['name']."<!!>";
			$file = $_FILES['arc'.$tx]['name'];
			move_uploaded_file($_FILES['arc'.$tx]['tmp_name'],"../Process/OT/$nombre_ot/IE/".$file);
		}
	}else{
		$destino ="../Process/OT/$nombre_ot/IE";
		mkdir($destino);
		for($tx = 0; $tx < $_POST['num_archivos']; $tx++){
			$file = $_FILES['arc'.$tx]['name'];
			$arc .= $_FILES['arc'.$tx]['name']."<!!>";
			move_uploaded_file($_FILES['arc'.$tx]['tmp_name'],"../Process/OT/$nombre_ot/IE/".$file);
		}
	}
	echo $arc;
	
?>