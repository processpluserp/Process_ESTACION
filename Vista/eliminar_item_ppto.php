<?php
	include("../Controller/Conexion.php");
	
	mysql_query("START TRANSACTION");
		mysql_query("delete from itempresup where id = '".$_POST['id']."'");
	mysql_query("COMMIT");
?>