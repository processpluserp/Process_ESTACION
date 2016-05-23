<?php
	
	include("../Controller/Conexion.php");
	$num_ppto = $_POST['ppto'];
	$version_interna = $_POST['version'];
	
	mysql_query("START TRANSACTION");
		mysql_query("update cabpresup set vi = '$version_interna' where codigo_presup = '$num_ppto'");
	mysql_query("COMMIT");
	
?>