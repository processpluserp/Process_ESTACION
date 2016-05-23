<?php
	include("../Controller/Conexion.php");
	
	mysql_query("update registro_facturas set estado = '0', rechazo = '".$_POST['rechazo']."', user_rechazo = '".$_POST['user']."', fecha_rechazo = '".date("Y-m-d h:i:s")."'");
	mysql_query("delete from documento_cargado where id_orproduccion = '".$_POST['noorden']."' and estado = '0'");
	echo "Rechazo de Factura realizado con éxito !";
?>