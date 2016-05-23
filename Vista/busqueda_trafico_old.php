<?php
	
	include("../Controller/Conexion.php");
	require("../Modelo/tareas.php");
	require("../Modelo/cabecera_ot.php");
	require("../Modelo/admindatos.php");
	require("../Modelo/asoccliemp.php");
	require("../Modelo/Empresa.php");
	require("../Modelo/gestion_cabecera.php");
	ini_set("session.cookie_lifetime","7200");
	ini_set("session.gc_maxlifetime","7200");
	session_start();
	$admin = new administrador();
	$usuario = $_SESSION["codigo_usuario"];
	$usu = $_SESSION["codigo_usuario"];
	$fecha = date("Y-m-d");
	$fecha2 = date("Y-m-d h:i:s");
	$hm_militar = date("Y-m-d H:i:s");
	$hora = date("h:i:s");
	
	
	
	$turno = $_POST['turno'];
	switch ($turno){
		case 1:
			$criterio = $_POST['c'];
			$ano = $_POST['a'];
			$buscar = $_POST['b'];
			$estado = $_POST['e'];
			$usu = $_POST['usu'];
			
			$consulta = "";
			if($criterio == "numero"){
				IF(empty($buscar)){
					if(empty($estado)){
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and 
						o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and year_ot ='$ano' order by o.fecha_registro desc";
					}else{
						if($estado == 12){
							$estado = 0;
						}
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and year_ot ='$ano' and o.estado='$estado'  order by o.fecha_registro desc";
					}
				}else{
					if(empty($estado)){
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and 
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and codigo_ot = '$buscar' and year_ot ='$ano' order by o.fecha_registro desc";
					}else{
						if($estado == 12){
							$estado = 0;
						}
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and 
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and codigo_ot = '$buscar' and year_ot ='$ano' and o.estado='$estado' order by o.fecha_registro desc";
					}
					
				}
			}
			if($criterio == "cliente"){
				if(empty($buscar)){
					if(empty($estado)){
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC  and
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and year_ot ='$ano' order by o.fecha_registro desc";
					}else{
						if($estado == 12){
							$estado = 0;
						}
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and year_ot ='$ano' and o.estado='$estado' order by o.fecha_registro desc";
					}
					
				}else{
					if(empty($estado)){
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and c.nombre_comercial_cliente LIKE '%$buscar%' and year_ot ='$ano' order by o.fecha_registro desc";
					}else{
						if($estado == 12){
							$estado = 0;
						}
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and 
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and c.nombre_comercial_cliente LIKE '%$buscar%' and year_ot ='$ano' and o.estado='$estado' order by o.fecha_registro desc";
					}
				}
			}
			if($criterio == "producto"){
				if(empty($buscar)){
					if(empty($estado)){
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and 
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and year_ot ='$ano' order by o.fecha_registro desc";
					}else{
						if($estado == 12){
							$estado = 0;
						}
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and year_ot ='$ano' and o.estado='$estado' order by o.fecha_registro desc";
					}
					
				}else{
					if(empty($estado)){
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and 
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and p.nombre_producto LIKE '%$buscar%' and year_ot ='$ano'  order by o.fecha_registro desc";
					}else{
						if($estado == 12){
							$estado = 0;
						}
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and p.nombre_producto LIKE '%$buscar%' and year_ot ='$ano' and o.estado='$estado'  order by o.fecha_registro desc";
					}
				}
			}
			if($criterio == "referencia"){
				if(empty($buscar)){
					if(empty($estado)){
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and 
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and year_ot ='$ano'  order by o.fecha_registro desc";
					}else{
						if($estado == 12){
							$estado = 0;
						}
						$consulta .= "SELECT  distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and 
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and year_ot ='$ano' and o.estado='$estado  order by c.codigo_interno_cliente desc'";
					}
					
				}else{
					if(empty($estado)){
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and 
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and o.referencia LIKE '%$buscar%' and year_ot ='$ano'  order by o.fecha_registro desc";
					}else{
						if($estado == 12){
							$estado = 0;
						}
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and 
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and o.referencia LIKE '%$buscar%' and year_ot ='$ano' and o.estado='$estado' order by o.fecha_registro desc";
					}
				}
			}
			if($criterio == "director"){
				if(empty($buscar)){
					if(empty($estado)){
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and year_ot ='$ano' order by o.fecha_registro desc";
					}else{
						if($estado == 12){
							$estado = 0;
						}
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and 
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and year_ot ='$ano' and o.estado='$estado' order by o.fecha_registro desc";
					}
					
				}else{
					if(empty($estado)){
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and 
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and dir.nombre_empleado LIKE '%$buscar%' and year_ot ='$ano' order by o.fecha_registro desc";
					}else{
						if($estado == 12){
							$estado = 0;
						}
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and 
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and dir.nombre_empleado LIKE '%$buscar%' and year_ot ='$ano' and o.estado='$estado' order by o.fecha_registro desc";
					}
				}
			}
			if($criterio == "ejecutivo"){
				if(empty($buscar)){
					if(empty($estado)){
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and 
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and year_ot ='$ano' order by o.fecha_registro desc";
					}else{
						if($estado == 12){
							$estado = 0;
						}
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and 
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and year_ot ='$ano' and o.estado='$estado' order by o.fecha_registro desc";
					}
					
				}else{
					if(empty($estado)){
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and 
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and eje.nombre_empleado LIKE '%$buscar%' and year_ot ='$ano' order by o.fecha_registro desc";
					}else{
						if($estado == 12){
							$estado = 0;
						}
						$consulta .= "SELECT distinct o.id,o.codigo_ot, o.descripcion,o.estado, o.referencia, c.nombre_comercial_cliente, p.nombre_producto,
						eje.nombre_empleado as ejecutivo, dir.nombre_empleado as director
						from cabot o, producto_clientes p, clientes c,empleado eje, usuario u1,empleado dir, usuario u2, pcliepro pcp
						where pcp.cod_usuario = '$usu' and pcp.cod_cliente = o.producto_clientes_pk_clientes_nit_procliente and pcp.cod_producto = o.producto_clientes_codigo_PRC and 
						 o.producto_clientes_codigo_PRC=p.id_procliente AND o.producto_clientes_pk_clientes_nit_procliente=c.codigo_interno_cliente
						and o.ejecutivo = u1.idusuario and u1.pk_empleado = eje.documento_empleado and o.director = u2.idusuario and u2.pk_empleado = dir.documento_empleado
						and eje.nombre_empleado LIKE '%$buscar%' and year_ot ='$ano' and o.estado='$estado' order by o.fecha_registro desc";
					}
				}
			}
			$result = mysql_query($consulta);
			$ott =  new cabecera_ot();
			$ott->mostrar_ots($result);
			break;
		
		case 2:
			$t = new tareas_ot();
			$ot = new cabecera_ot();
			$nombre_ot = $ot->mostrar_ot_por_id($_POST['idot']);
			//$para = $t->listar_correos_copia($_POST['asi']);
			$cabecera = "From: Soporte Proces<soporteprocessplues@gmail.com>";
			$cabecera.="\r\n";
			//$cabecera .="Cc: ".$t->listar_correos_copia($_POST['resp']);
			
			$t->set_codigo_ot_tarea($nombre_ot);
			$num = $t->codigo_automatico_tarea();
			$t->set_codigo_area_tarea($_POST['depto']);			
			
			if( floatval(date("h")) >= 6  && $_POST['formato'] == "PM"  && $_POST['fecha'] == date("Y-m-d")){
				$fechax = $_POST['fecha'];
				//date_add($fechax, date_interval_create_from_date_string('1 days'));
				$t->set_fecha_prometida_tarea( $_POST['fecha'] );
				$t->set_hora_tarea($_POST['h']);
				$t->set_minutos_tarea($_POST['m']);
				$t->set_formato_hora_tarea($_POST['formato']);
			}else{
				$t->set_fecha_prometida_tarea($_POST['fecha']);
				$t->set_hora_tarea($_POST['h']);
				$t->set_minutos_tarea($_POST['m']);
				$t->set_formato_hora_tarea($_POST['formato']);
			}
			
			$t->set_trabajo_tarea($_POST['trabajo']);
			$t->set_descripcion_tarea($_POST['desc']);
			$t->set_razon_demora_tarea($_POST['razon']);
			
			
			$t->set_tipo_tarea_tarea($_POST['tipo']);
			$t->set_estado_tarea(0);
			$t->codigo_hijo_tarea($num,"P");
			$t->insert_tarea($_POST['usu'], date("Y-m-d")." ".$_POST['th'],$num,"P",$hora,$hm_militar,$_POST['xxpro_colpatria']);
					
			
			mkdir("../Process/OT/$nombre_ot/TAREAS/$num");
			if($_POST['tipo_envio'] == 2){
				for($tx = 0; $tx < $_POST['num_arc']; $tx++){
					$file = $_FILES['arc'.$tx]['name'];
					move_uploaded_file($_FILES['arc'.$tx]['tmp_name'],"../Process/OT/$nombre_ot/TAREAS/$num/".$file);
				}
			}			
			echo $num;
			break;
		
		case 3:
			
			$idxx = $_POST['id'];
			if($_POST['test'] == 1){
				mysql_query("update tareas set estado = '3' where codigo_int_tarea = '$idxx'");
			}else{
				$t = new tareas_ot();
			
				$ot = new cabecera_ot();
				$nombre_ot = $ot->mostrar_ot_por_id($_POST['idot']);
			
				$t->cambiar_estado_tarea($_POST['id'],0);
				$t->actualizar_respuesta($_POST['id'],$fecha2,date("Y-m-d h:i:s"),$usuario);
				$t->set_codigo_ot_tarea($nombre_ot);
				$num = $t->codigo_automatico_tarea();
				$t->set_codigo_area_tarea($_POST['depto']);
				
				
				if( floatval(date("h")) >= 6 && $_POST['formato'] == "PM" && $_POST['fecha'] == date("Y-m-d")){
					$fechax = $_POST['fecha'];
					$t->set_fecha_prometida_tarea( $_POST['fecha'] );
					$t->set_hora_tarea("08");
					$t->set_minutos_tarea("00");
					$t->set_formato_hora_tarea("AM");
				}else{
					$t->set_fecha_prometida_tarea($_POST['fecha']);
					$t->set_hora_tarea($_POST['h']);
					$t->set_minutos_tarea($_POST['m']);
					$t->set_formato_hora_tarea($_POST['formato']);
				}
				$t->set_trabajo_tarea($_POST['trabajo']);
				$t->set_descripcion_tarea($_POST['desc']);
				$t->set_razon_demora_tarea($_POST['razon']);
				
				$t->set_tarea_padre($nombre_ot."x");
				$ot = $nombre_ot;
				$t->set_tipo_tarea_tarea($_POST['tipo']);
				if($_POST['test'] == 0){
					$t->set_estado_tarea(0);	
				}else{
					$t->set_estado_tarea(3);
				}
				


				$t->codigo_hijo_tarea($_POST['id'],"R");
				if($_POST['num_ppto'] == 0){
					$pptox = $t->consultar_ppto_tarea($_POST['id_tarea']);
					//ACTUALIZAR PPTO CUANDO SE INGRESE UN TIPO DE TAREA DE APROBACIÓN CLIENTE
					if($_POST['tipo'] == 33 && count($_FILES['arc0']['name']) > 0){
						mysql_query("update cabpresup set estado_presup = '3' where codigo_presup = '$pptox'");
					}
					$t->insert_tarea2($usuario, date("Y-m-d h:i:s"),$num,"R",$_POST['id'],date("h:i:s"),$pptox,$hm_militar);
				}else{
					$t->insert_tarea2($usuario, date("Y-m-d h:i:s"),$num,"R",$_POST['id'],date("h:i:s"),$_POST['num_ppto'],$hm_militar);
				}
				
				mkdir("../Process/OT/$nombre_ot/TAREAS/$num");
				
				if($_POST['tipo_envio'] == 2){
					for($tx = 0; $tx < $_POST['num_arc']; $tx++){
						$file = $_FILES['arc'.$tx]['name'];
						move_uploaded_file($_FILES['arc'.$tx]['tmp_name'],"../Process/OT/$nombre_ot/TAREAS/$num/".$file);
					}
				}
			
				echo $num;
			}
			
			break;
			
		case 4:
			$imp = "<option value = '...'>...</option>";
			$emp = $_POST['emp'];
			$usu = $_POST['usu'];
			$consulta_empresa = "select distinct e.codigo_interno_cliente, e.nombre_comercial_cliente from clientes e, pcliepro c where (e.estado = 1 OR e.estado = 2) and 
			c.cod_cliente = e.codigo_interno_cliente and c.pk_empresa = '$emp' and c.cod_usuario = '$usu' order by  e.nombre_comercial_cliente asc";
			$result2 = mysql_query($consulta_empresa);
			while($row = mysql_fetch_array($result2)){
				$imp .= "<option value = ".$row['codigo_interno_cliente'].">".$row['nombre_comercial_cliente']."</option>";
			}
			echo $imp;
			break;
		
		case 5:
			$imp = "<option value = '...'>...</option>";
			$clie = $_POST['clie'];
			$usu = $_POST['usu'];
			$consulta_clie = "select e.id_procliente, e.nombre_producto from producto_clientes e, pcliepro p where e.estado = 1 and 
			p.cod_cliente = '$clie' and p.cod_usuario = '$usu' and e.id_procliente =  p.cod_producto order by e.nombre_producto asc;";
			$resultclie = mysql_query($consulta_clie);
			while($row = mysql_fetch_array($resultclie)){
				$imp .= "<option value = ".$row['id_procliente'].">".$row['nombre_producto']."</option>";
			}
			echo $imp;
			break;
		
		case 6:
			$asoc = new asocliemp();
			$ot = new cabecera_ot();
			$ot->set_tipo_brief($_POST['brief']);
			$ot->set_referencia_cabecera_ot($_POST['ref']);
			$ot->set_descripcion_cabecera_ot($_POST['desc']);
			$ot->set_director_cabecera_ot($_POST['direc']);
			$ot->set_estado_cabecera_ot(1);
			$ot->set_año_cabecera_ot(date("Y"));
			$ot->set_ejecutivo_cabecera_ot($_POST['eje']);
			$ot->set_empresa_cabecera_ot($_POST['emp']);
			$ot->set_producto_cliente_cabecera_ot($_POST['pclie']);
			$ot->set_cliente_cabecera_ot($_POST['clie']);
			
			//Consulta la cantidad de ot que hay para generar el consecutivo correspondiente.
			$numero = $ot->consultar_datos_crear_ot($_POST['emp'],$_POST['clie']);
			if($numero == 0){
				$numero = 1;
			}
			
			//Consulto las iniciales de la asociación entre el cliente y la empresa.
			$iniciales = $asoc->consultar_iniciales($_POST['emp'],$_POST['clie']);
			
			//Añado la cantidad de ceros correspondientes al número que le paso por parámetro.
			$ceros = $admin->complementos_ceros($numero);
			
			//Separo los dos útlimos dígitos del año.
			$finales_año = substr(date("Y"),2,2);
			
			//Concateno los valores para formar el código correspondiente de la OT.
			$codigo_ot = $iniciales.$ceros."-".$finales_año;
			$ot->set_codigo_cabecera_ot($codigo_ot);
			$ot->crear_carpeta_ot_normal($usuario);
			$ot->insert_brief($_POST['inputs_brief'],$_POST['respuestas_brief'],$fecha,$usuario);
			$ot->mostrar_ot_creada($codigo_ot);
			break;
			
		case 7:
			//$ot = $_POST['ot'];
			$usu = $_POST['usu'];
			/*$t = new tareas_ot();
			$t->estructura_tareas($ot,$usu);
			
			$consul_emp = "select pk_nit_empresa_ot from cabot where codigo_ot = '$ot'";
			$re = mysql_query($consul_emp);
			while($r = mysql_fetch_array($re)){
				$_SESSION['cod_empresa'] = $r['pk_nit_empresa_ot'];
			}*/
			$t = new tareas_ot();
			$t->listar_asignados($_POST['usu'],$_POST['depto']);
			break;
			
		case 8:
			/*$depto = $_POST['depto'];
			$usu = $_POST['usu'];
			$emp = $_POST['emp'];
			$imp = "<option value = '...'>...</option>";
			$consulta = "select u.nombre_usuario, u.idusuario from usuario u, prespon p where
			u.idusuario = p.responsable and p.pk_depto = '$depto' and p.pk_empresa = '$emp' and p.usuario = '$usu'";
			$result = mysql_query($consulta);
			while($row = mysql_fetch_array($result)){
				$name = $row['idusuario'];
				$imp .= "<option value='$name'>".utf8_encode($row['nombre_usuario'])."</option>";
			}
			echo $imp;*/
			break;
		
		case 9:
			$usu = $_POST['usuario'];
			$t = new tareas_ot();
			$t->mostrar_tareas_pendientes_resumen($usu);			
			break;
			
		case 10:
			$t = new tareas_ot();
			$ot = new cabecera_ot();
			$nombre_ot = $ot->mostrar_ot_por_id($_POST['ot']);
			$t->estructura_tareas($nombre_ot,$usu);	
			break;
			
		case 11:
			$asoc = new asocliemp();
			$ot = new cabecera_ot();
			$ot->set_tipo_brief($_POST['brief']);
			$ot->set_referencia_cabecera_ot($_POST['ref']);
			$ot->set_descripcion_cabecera_ot($_POST['desc']);
			$ot->set_director_cabecera_ot($_POST['direc']);
			$ot->set_estado_cabecera_ot(1);
			$ot->set_año_cabecera_ot(date("Y"));
			$ot->set_ejecutivo_cabecera_ot($_POST['eje']);
			$ot->set_empresa_cabecera_ot($_POST['emp']);
			$ot->set_producto_cliente_cabecera_ot($_POST['pclie']);
			$ot->set_cliente_cabecera_ot($_POST['clie']);
			
			$ot->set_profecolpatria_cabecera_ot($_POST['prof']);
			$ot->set_pieza_colpatria_cabecera_ot($_POST['tpieza']);
			$ot->set_objtrabajo_colpatria_cabecera_ot($_POST['trab']);
			$ot->set_medio_colpatria_cabecera_ot($_POST['medio']);
			$ot->set_numero_solicitud_cabecera_ot($_POST['cnums']);
			$ot->set_nombre_solicitud_cabecera_ot($_POST['cnoms']);
			
			//Consulta la cantidad de ot que hay para generar el consecutivo correspondiente.
			$numero = $ot->consultar_datos_crear_ot($_POST['emp'],$_POST['clie']);
			if($numero == 0){
				$numero = 1;
			}
			
			//Consulto las iniciales de la asociación entre el cliente y la empresa.
			$iniciales = $asoc->consultar_iniciales($_POST['emp'],$_POST['clie']);
			
			//Añado la cantidad de ceros correspondientes al número que le paso por parámetro.
			$ceros = $admin->complementos_ceros($numero);
			
			//Separo los dos útlimos dígitos del año.
			$finales_año = substr(date("Y"),2,2);
			
			//Concateno los valores para formar el código correspondiente de la OT.
			$codigo_ot = $iniciales.$ceros."-".$finales_año;
			$ot->set_codigo_cabecera_ot($codigo_ot);
			$ot->crear_carpeta_ot_colpatria($usuario);
			$ot->insert_brief($_POST['inputs_brief'],$_POST['respuestas_brief'],$fecha,$usuario);
			$ot->mostrar_ot_creada($codigo_ot);
			break;
			
		case 12:

			break;
		case 13:
			$t = new tareas_ot();
			$t->listar_departamentos_usuario($_POST['id']);
			break;
		case 14:
			$t = new tareas_ot();
			$t->mostrar_responsables($_POST['depto']);
			break;
		case 15:
			$t = new tareas_ot();
			$ot = new cabecera_ot();
			$t->cancelar_tareas($_POST['id']);
			$nombre_ot = $ot->mostrar_ot_por_id($_POST['id']);
			$t->estructura_tareas($nombre_ot,$_POST['usu']);
			break;
		case 16:
			$t = new tareas_ot();
			$t->mostrar_info_tarea($_POST['id'],$_POST['usu'],$_POST['ot']);
			//$t->actualizar_estado_tarea($_POST['id'],$_POST['usu'],$fecha2);
			break;
		case 17:
			$t = new tareas_ot();
			$t->mostrar_archivos_adjuntos($_POST['id']);
			break;
		case 18:
			$ot = new cabecera_ot();
			$ot->listar_ots($_POST['empresa'],$_POST['cliente'],$_POST['producto']);
			break;
		case 19:
			$ot = new cabecera_ot();
			//$nombre_ot = $ot->mostrar_ot_por_id();
			$ot->listar_brief_x_ot($_POST['id']);
			break;
		case 20:
			$ot = new cabecera_ot();
			$ot->informacion_ot_seleccionada($_POST['id']);
			break;
		case 21:
			$ot = new cabecera_ot();
			$ot->update_razon_cierre_ot($_POST['id'],$_POST['text']);
			break;
		case 22:
			$ot = new cabecera_ot();
			$inputs = $_POST['inputs'];
			$texts = $_POST['text'];
			$ot->set_tipo_brief($_POST['tipo']);
			$ot->set_codigo_cabecera_ot($_POST['ot']);
			$ot->insert_brief($inputs,$texts,date("Y-m-d"),$usuario);
			break;

		case 23:
			$t  = new tareas_ot();
			$t->mostrar_tareas_contestadas_resumen($_POST['usuario']);
			break;
		case 24:
			$ot = new cabecera_ot();
			echo $ot->referencia_descripcion_ot($_POST['id']);
			break;
		case 25:
			$ot = new cabecera_ot();
			$asoc = new asocliemp();
			$ot = new cabecera_ot();
			$ot->set_estado_cabecera_ot(1);
			$ot->set_año_cabecera_ot(date("Y"));
			$ot->set_empresa_cabecera_ot($_POST['empresa']);
			$ot->set_producto_cliente_cabecera_ot($_POST['producto']);
			$ot->set_cliente_cabecera_ot($_POST['cliente']);
			
			//Consulta la cantidad de ot que hay para generar el consecutivo correspondiente.
			$numero = $ot->consultar_datos_crear_ot($_POST['empresa'],$_POST['cliente']);
			if($numero == 0){
				$numero = 1;
			}
			
			//Consulto las iniciales de la asociación entre el cliente y la empresa.
			$iniciales = $asoc->consultar_iniciales($_POST['empresa'],$_POST['cliente']);
			
			//Añado la cantidad de ceros correspondientes al número que le paso por parámetro.
			$ceros = $admin->complementos_ceros($numero);
			
			//Separo los dos útlimos dígitos del año.
			$finales_año = substr(date("Y"),2,2);
			
			//Concateno los valores para formar el código correspondiente de la OT.
			$codigo_ot = $iniciales.$ceros."-".$finales_año;
			$ot->set_codigo_cabecera_ot($codigo_ot);
			//$ot->crear_carpeta_ot();
			
			$ot_vieja = $ot->mostrar_ot_por_id($_POST['id_ot']);
			$ot->traslado_ot($_POST['id_ot'],$_POST['cliente'],$_POST['empresa'],$_POST['producto'],$_POST['referencia'],$_POST['descripcion'],$codigo_ot,$ot_vieja);
			
			$ot->traslado_tareas_ot($ot_vieja,$codigo_ot);
			$ot->traslado_brief($ot_vieja,$codigo_ot);
			$ot->mostrar_ot_creada($codigo_ot);
			break;
		case 26:
			$ot = new cabecera_ot();
			$ot->mostrar_detalle_ot($_POST['xx']);
			//var_dump($_POST['xx']);
			break;
		case 27:
			$ot = new cabecera_ot();
			$ot->filtrar_ppto_por_ot($_POST['ot']);
			break;
		case 28:
			$ta = new tareas_ot();
			$ta->consultar_sino_ppto($_POST['id']);
			break;
		case 29:
			$ot = new cabecera_ot();
			//ASISTENTES AGENCIA
			$asis_empresax = "";
			if($_POST['num_asis_agencia'] > 0){
				$asis_list = $_POST['asis'];
				for($i = 0;$i < count($asis_list);$i++){
					$sql_correo = mysql_query("select e.email_empleado,e.nombre_empleado  
					from empleado e
					where e.email_empleado = '".$asis_list[$i]."'");
					while($row = mysql_fetch_array($sql_correo)){
						$asis_empresax.=$row['nombre_empleado']."<***+++>";
					}
				}
			}
			
			//ASISTENTES CLIENTE
			$asis_clientex = "";
			if($_POST['num_cliente'] > 0){
				$asis_cliente = $_POST['cliente'];
				for($i = 0;$i < count($asis_cliente);$i++){
					$info = explode(" - ",$asis_cliente[$i]);
					$asis_clientex.=$info[0]."<***+++>";
				}
			}
			
			
			//COMPROMISOS AGENCIA
			$list_comp_empre = "";
			if($_POST['num_comp_age'] > 0){
				$c_emp = $_POST['compromisos_emp'];
				for($i = 0;$i < count($c_emp);$i++){
					$info = explode("<***+++>",$c_emp[$i]);
					$list_comp_empre.=$info[0]."<***+++>".$info[1]."<***+++>".$info[2]."<***+++>".$info[3]."<***+++x>";
				}
			}
			
			//COMPROMISOS CLIENTE
			$list_comp_clie = "";
			if($_POST['comp_clie_num'] > 0){
				$c_clie = $_POST['compromisos_clie'];
				for($i = 0;$i < count($c_clie);$i++){
					$info = explode("<***+++>",$c_clie[$i]);
					$list_comp_clie.=$info[0]."<***+++>".$info[1]."<***+++>".$info[2]."<***+++x>";
				}
			}
			
			//TEMAS
			$list_temasx = "";
			if($_POST['contar_temas'] > 0){
				$temas = $_POST['temas'];
				for($i = 0;$i < count($temas);$i++){
					$info = explode("<***+++>",$temas[$i]);
					$list_temasx.=$info[0]."<***+++>";
				}
			}
			
			$ot->guardar_informe_entrevista_ot($_POST['asunto'],$_POST['tipo_entrevista'],$_POST['fecha_reunion_ie'],$_POST['lugar_reunion_ie'],$_POST['hora_inicio_ie'].":".$_POST['minuto_inicio_ie'].":00 ".$_POST['formato_inicio_ie'],$_POST['hora_fin_ie'].":".$_POST['minuto_fin_ie'].":00 ".$_POST['formato_fin_ie'],$_POST['info_general_ie'],$_POST['ot'],$asis_empresax,$asis_clientex,$list_comp_empre,$list_comp_clie,$fecha2,$usuario,$_POST['info_especifica_ie'],$list_temasx);
			$vari = 0;
			if($_POST['num_cliente']>0){
				include("enviar_ie.php");
				if($_POST['copi'] > 0){
					//include("enviar_ie2.php");
				}
			}else{
				date_default_timezone_set('Etc/UTC');

				require 'Mailer/PHPMailerAutoload.php';
				include("../Controller/Conexion.php");
				$mailx = new PHPMailer;
				$mailx->isSMTP();
				$mailx->Debugoutput = 'html';
				$mailx->Host = 'smtp.gmail.com';
				$mailx->Port = 587;
				$mailx->SMTPSecure = 'tls';
				$mailx->SMTPAuth = true;
				$mailx->Username = "soporteprocessplues@gmail.com";
				$mailx->Password = "12345678#$#$";
				if($_POST['copi'] > 0){
					
					include("enviar_ie2.php");
				}
			}
			
			
			if($vari == 3){
				echo "INFORME ENVIADO SATISFACTORIAMENTE";
			}else if($vari == 1){
				echo "INFORME ENVIADO SATISFACTORIAMENTE";
			}else if($vari == 2){
				echo "INFORME ENVIADO SATISFACTORIAMENTE";
			}else if($vari == 0){
				echo "INFORME GUARDADO CON EXITO EN PROCESS.\nACTUALMENTE NO SE PUEDE ENVIAR EL INFORME A LOS INTERESADOS, POR FAVOR DESCARGUE EL PDF CORRESPONDIENTE Y ENVÍELO POR EMAIL.";
			}
			break;
		case 30:
			$ot = new cabecera_ot();
			$ot->list_informes_entrevista_ot($_POST['id']);
			break;
		case 31:
			$emp = new empresa();
			$emp->mostrar_nombre_empresa($_POST['id']);
			break;
		case 32:
			$ta = new tareas_ot();
			$ta->contar_tareas_nuevas($usuario,$fecha2);
			break;
		case 33:
			$ta = new tareas_ot();
			$ta->listar_tareas_calendario($usuario,$fecha2);
			break;
		case 34:
			$ca = new cabecera_ot();
			$ca->listar_asistentes_agencia($_POST['name']);
			break;
		case 35:
			$t = new tareas_ot();
			$ot = new cabecera_ot();
			$nombre_ot = $ot->mostrar_ot_por_id($_POST['idot']);
			$num = $_POST['num'];
			$asig = $_POST['asi'];
			for($i = 0; $i < count($asig);$i++){
				$t->insert_personas_asires($asig[$i],"ASI",$_POST['idot'],$num);
			}
			$asig = $_POST['resp'];
			for($i = 0; $i < count($asig);$i++){
				$t->insert_personas_asires($asig[$i],"RES",$_POST['idot'],$num);
			}
			$asunto = "TENES UNA NUEVA TAREA EN PROCESS !";
			//$asunto = "TENES UNA NUEVA TAREA EN PROCESS: ".$nombre_ot." FECHA ENTREGA: ".$t->get_fecha_promedita_tarea();
			$mensaje = "PARA PODER VER ESTE MENSAJE, INGRESA A PROCESS PLUSS.";
						
			$t->estructura_tareas($nombre_ot,$_POST['usu']);
			break;
		case 36:
			$t = new tareas_ot();
			$ot = new cabecera_ot();
			$nombre_ot = $ot->mostrar_ot_por_id($_POST['ot']);
			$t->estructura_tareas($nombre_ot,$_POST['usu']);
			break;
		case 37:
			$t = new tareas_ot();
			$ot = new cabecera_ot();
			$nombre_ot = $ot->mostrar_ot_por_id($_POST['ot']);
			$ot->mostrar_ot_creada($nombre_ot);
			break;
		case 38:
			$gestion = new cabecera_pagina();
			echo $gestion->tareas_pendientes($_POST['usu']);
			break;
		case 39:
			$t = new tareas_ot();
			$t->depto_responder_taras($_POST['id'],$_POST['usu']);
			break;
		case 40:
			$t = new tareas_ot();
			$t->mostrar_responsable_res($_POST['id'],$_POST['depto'],$_POST['usu']);
			break;
		case 41:
			$t = new tareas_ot();
			$t->mostrar_responsable_asi($_POST['id'],$_POST['usu'],$_POST['depto']);
			break;
		case 42:
			$t = new tareas_ot();
			$t->tipo_tarea_select($_POST['id']);
			break;
		case 43:
			$t = new cabecera_ot();
			$t->campo_adicional_crear_tareas_colpatria($_POST['ot']);
			break;
		case 44:
			$ca = new cabecera_ot();
			$ca->listar_asistentes_agencia2($_POST['name']);
			break;
	}
	
?>