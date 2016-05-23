<?php
	include("../Controller/Conexion.php");	
	$t = $_POST['t'];
	switch ($t){
		case 1:
			$empresa = 0;
			$sql_empresa = "";
			if($empresa == 0){
				$sql_empresa = "ot.pk_nit_empresa_ot = emp.cod_interno_empresa and";
			}else{
				$sql_empresa = "ot.pk_nit_empresa_ot = '$empresa' and ot.pk_nit_empresa_ot = emp.cod_interno_empresa and";
			}
			
			$director = 0;
			$sql_director = "";
			if($director == 0){
				$sql_director = "ot.director = dir.idusuario and dir.pk_empleado = dirn.documento_empleado and";
			}else{
				$sql_director = "ot.director = '$director' and dir.pk_empleado = dirn.documento_empleado and ";
			}
			
			$clientes = 0;
			$sql_clientes = "";
			if($clientes == 0){
				$sql_clientes = "ot.producto_clientes_pk_clientes_nit_procliente = clie.codigo_interno_cliente and";
			}else{
				$sql_clientes = "ot.producto_clientes_pk_clientes_nit_procliente = clie.codigo_interno_cliente and clie.codigo_interno_cliente = '$clientes' and";
			}
			
			$productos = 0;
			$sql_productos = "";
			if($productos == 0){
				$sql_productos = "ot.producto_clientes_codigo_PRC = pr.id_procliente and";
			}else{
				$sql_productos = "ot.producto_clientes_codigo_PRC = pr.id_procliente and pr.id_procliente = '$productos'";
			}
			
			$sql = mysql_query("SELECT emp.nombre_comercial_empresa as Nombre_empresa, count(dirn.nombre_empleado) as director,emp.cod_interno_empresa
				FROM empresa emp, cabot ot, usuario as dir, empleado dirn
				WHERE ot.pk_nit_empresa_ot = emp.cod_interno_empresa and ot.director = dir.idusuario and dir.pk_empleado = dirn.documento_empleado group by emp.cod_interno_empresa");
			$val = "";
			while($row = mysql_fetch_array($sql)){
				$val .= "<->".$row['Nombre_empresa']."*---*".$row['director']."*---*".$row['cod_interno_empresa'];
			}
			echo $val;
			break;
	}
?>