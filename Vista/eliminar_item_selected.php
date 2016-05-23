<?php
	include("../Controller/Conexion.php");
	
	if (isset($_POST["id"]) && isset($_POST['turno'])){
		if($_POST['turno'] == 1){
			mysql_query("STAR TRANSACTION");
				mysql_query("delete from itempresup where id = '".$_POST['id']."'");
			mysql_query("COMMIT");
		}else if($_POST['turno'] == 2){
			mysql_query("STAR TRANSACTION");
				mysql_query("delete from itempresup where id = '".$_POST['id']."'");
			mysql_query("COMMIT");
		}
		
	}
	
?>