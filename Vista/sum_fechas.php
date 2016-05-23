<?php
	include("../Controller/Conexion.php");
	
	$sql_ppto = mysql_query("select vigencia_final from cabpresup where codigo_presup = '".$_POST['ppto']."'");
	
	while($row = mysql_fetch_array($sql_ppto)){
		$temp_fecha = $row['vigencia_final']." 00:00:00";
		//8 días base
		$nuevafecha  = strtotime ( '+8 day' , strtotime ( $temp_fecha ) );
		echo date ( 'Y-m-d' , $nuevafecha );
	}

	
?>