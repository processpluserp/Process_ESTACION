<?php
		include("../Controller/Conexion.php");
	
		$version = $_POST['vi'];
		$versionc = $_POST['vc'];
		
		
		$ppto = $_POST['ppto'];
		
		mysql_query("START TRANSACTION");
			mysql_query("insert into histo_ppto_cabpresup (name_item,name_grupo,proveedor,dias,q,descripcion,val_item,iva_item,cliente,
			val_desde_item,por_prov,usuario,ppto,asoc,num_interno,vi,vc)
			select name_item,name_grupo,proveedor,dias,q,descripcion,val_item,iva_item,cliente,
			val_desde_item,por_prov,usuario,ppto,asoc,num_interno,vi,vc from itempresup
			where ppto = '$ppto' and vi = '$version' and vc = '$versionc'");
			
			mysql_query("update histo_ppto_cabpresup set tipo = 'PPTO RECHAZADO' where ppto = '$ppto' and vi = '$version' and vc = '$versionc'");
		
		$contador = mysql_query("select count(ppto) as numero from versiones_presup where ppto = '$ppto'");
		$c = 0;
		while($row = mysql_fetch_array($contador)){
			$c = $row['numero'];
		}
		$version_nueva = $c + 1;
		
		$usuario = $_POST['user'];
		$fecha = date("Y-m-d h:i:s");
		
			mysql_query("insert into versiones_presup(ppto,version,fecha,user,versionc) values('$ppto','$version_nueva','$fecha','$usuario',$versionc)");
			mysql_query("update cabpresup set estado_presup = '2' where codigo_presup = '$ppto' and vi = '$version' and vc = '$versionc'");
			mysql_query("update cabpresup set vi = '$version_nueva', vc = $versionc where codigo_presup = '$ppto'");
			$slq_items = mysql_query("select descripcion2,vnc,pk_item,name_item,name_grupo,proveedor,celula,dias,q,descripcion,val_item,iva_item,fecha_ant,por_ant,cliente,val_desde_item,por_prov,usuario,fecha_registro,ppto,asoc,num_interno,vc
			from itempresup where pk_orden = '0' and ppto = '$ppto' and vi = '$version' and vc = '$versionc'");
			while($row = mysql_fetch_array($slq_items)){
				mysql_query("insert into itempresup(descripcion2,vnc,name_item,proveedor,name_grupo,dias,q,descripcion,val_item,iva_item,fecha_ant,por_ant,cliente,val_desde_item,por_prov,usuario,fecha_registro,ppto,asoc,num_interno,vi,vc) values
				('".$row['descripcion2']."','".$row['vnc']."','".$row['name_item']."','".$row['proveedor']."','".$row['name_grupo']."','".$row['dias']."','".$row['q']."','".$row['descripcion']."','".$row['val_item']."','".$row['iva_item']."','".$row['fecha_ant']."','".$row['por_ant'].
				"','".$row['cliente']."','".$row['val_desde_item']."','".$row['por_prov']."','".$usuario."','".date("Y-m-d h:i:s")."','".$row['ppto']."','".$row['asoc']."','".$row['num_interno']."','".$version_nueva."','".$versionc."')");
				
			}
		mysql_query("COMMIT");
?>