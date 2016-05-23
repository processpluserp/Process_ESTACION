<?php
	//echo $_FILES['multiples_archivos_tareas-0']['name'];
	//echo $_FILES['multiple_archivos_tareas']['name'];
	$i = 0;
	//echo $_FILES['file0']['name'];
	/*foreach($_FILES['multiple_archivos_tareas']['name'] as $key){
		echo $_FILES['multiple_archivos_tareas']['name'][$i];
		$i++;
	}*/
	/*for($i = 0;$i<$_;$i++){
		echo $_FILES['file'.$i]['name']."---</br>";
	}*/
	//$archivos = explode(",",$_POST['archiivos']);
	//move_uploaded_file($archivos[0],"../Process/OT/".$archivos[0]);
	//($archivos[0]);
	echo count($_FILES);
	//var_dump($_POST);
	$x = "";
	for($i = 0;$i < count($_POST);$i++){
		//$x .= $_POST['archiivos']."</br>";
	}
	//echo $x;
?>