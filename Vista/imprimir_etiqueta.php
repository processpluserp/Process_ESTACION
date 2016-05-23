<?php
session_start();
include("../Controller/Conexion.php");
$numorden=$_GET['numorden'];

	$sql_radicado = mysql_query("select id from registro_facturas where noorden = '".$_GET['numorden']."' and estado = '1'");
	$ros = mysql_fetch_array($sql_radicado);
	
$codigo_barra=str_pad($ros['id'],12,'0',STR_PAD_LEFT);

	
	$consulta="SELECT DISTINCT prove.nombre_legal_proveedor				
	from empresa emp, cabpresup presup, clientes clie, orproduccion ordenc, proveedores prove
	where ordenc.ppto = presup.codigo_presup 
	and presup.empresa_nit_empresa = emp.cod_interno_empresa 
	and presup.pk_clientes_nit_cliente = clie.codigo_interno_cliente
	
	and ordenc.proveedor = prove.codigo_interno_proveedor 
	and ordenc.codigo_interno_op = '$numorden'";

	$sql_items = mysql_query($consulta);
	$rowx = mysql_fetch_array($sql_items);

	$cons_tp_doc="SELECT tpd.name,e.nombre_empleado as nombre, TIME(dc.fecha) AS hora, DATE(dc.fecha) AS fecha 
				FROM documento_cargado dc, tipo_doc_fact tpd,usuario u,empleado e 
				WHERE dc.id_tipo_doc_fact = tpd.id 
				AND dc.id_orproduccion = '$numorden'
				AND u.idusuario =dc.id_usuario 
				AND e.documento_empleado=u.pk_empleado 
				LIMIT 1";

	$sql_items = mysql_query($cons_tp_doc);
	$rowtpd = mysql_fetch_array($sql_items);
?>
<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>:: PROCESS + ::</title>
			<meta charset="utf-8" />		
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script type="text/javascript" src="../js/jquery-barcode.min.js"></script>
			<script>
				function imprimir(){
					window.print();
				}
				function imprimir_etiqueta(num){
					//alert('entro'+num);
					$('#bcTarget').barcode(num, 'ean13',{barWidth:3, barHeight:50});
				}
			</script>
		</head>
		<body onload="imprimir_etiqueta('<?php echo $codigo_barra;?>');">
			<div id="bcTarget" style="margin-top: 25px;">
				
			</div>
			<div style="line-height: 0.8em;font-size:12px;font-family: Arial,Helvetica Neue,Helvetica,sans-serif; margin-left: 28px;">
				<p>Fecha de radicacion: <?php echo $rowtpd['fecha'].' '.$rowtpd['hora'];;?></p>
				<p>Numero de radicado: <?php echo $codigo_barra;?></p>
				<p>Tipo documento: <?php echo $rowtpd['name'];?></p>
				<p>Proveedor: <?php echo ($rowx['nombre_legal_proveedor']);?></p>
				<p>Radicador: <?php echo $rowtpd['nombre'];?></p>
			</div>
			<div style="text-align:center;">
				<button onclick="imprimir();">
	  				IMPRIMIR
				</button>
			</div>			
		</body>
	</html>
		