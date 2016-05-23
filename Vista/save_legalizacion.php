<?php
	include("../Controller/Conexion.php");
	
	if(isset($_POST['factura']) ){
		
		$factura = $_POST['facturas'];
		$valores = $_POST['valores'];
		$fechas = $_POST['fechas'];
		$id = $_POST['id'];
		$user = $_POST['user'];
		
		mysql_query("start transaction");
			$estado = 1;
				mysql_query("insert into legalizaciones_items(pk_anticipo,factura,valor,user,estado,fecha_factura,nit,beneficiario,direccion,telefono,ciudad,concepto,iva,retencion) values
				('".$_POST['id']."','".$_POST['factura']."','".$_POST['valor']."','".$_POST['user']."','$estado','".$_POST['fecha']."','".$_POST['nit']."'
				,'".utf8_encode($_POST['nombre'])."','".$_POST['direccion']."','".$_POST['telefono']."','".$_POST['ciudad']."','".utf8_encode($_POST['concepto'])."'
				,'".$_POST['iva']."','".$_POST['retencion']."')");
				
		mysql_query("commit");
		
		
		
	}
?>