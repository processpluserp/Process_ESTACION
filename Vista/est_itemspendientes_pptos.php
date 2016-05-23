<?php
	include("../Controller/Conexion.php");
	
	$estructura = "";
	
	if(!empty($_POST["user"])){
		$turno = $_POST['turno'];
		if($turno == 1){
			$usuario_actual = $_POST['user'];
			$list_empresa = "<option value = '0'>[SELECCIONE]</option>";
			$sql_empresa = "SELECT e.nombre_comercial_empresa, e.cod_interno_empresa 
			from empresa e, pusuemp p
				where e.cod_interno_empresa = p.cod_empresa and p.cod_usuario = '$usuario_actual' order by e.nombre_comercial_empresa asc;";
			$result = mysql_query($sql_empresa);
			while($row = mysql_fetch_array($result)){
				$list_empresa.= "<option value=".$row['cod_interno_empresa'].">".utf8_encode($row['nombre_comercial_empresa'])."</option>";
			}
			
			$estructura = "
				<table >
					<tr>
						<td>
							<p>Seleccione una Empresa:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_itempenorden_empresa' onchange = 'report_itempenorden_buscar_directores_empresa()' style = 'width:220px;'>$list_empresa</select>
							
						</td>
						
						<td style = 'padding-left:10px;'>
							<p>Seleccione un Director:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_itempenorden_director' onchange = 'report_itempenorden_buscar_ejecutivos_director()'  style = 'width:220px;'>
								<option value = '0'>[SELECCIONE]</option>
							</select>
						</td>
						
						<td style = 'padding-left:10px;'>
							<p>Seleccione un Ejecutivo:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_itempenorden_ejecutivo' onchange = 'report_itemspendientes_buscar_cliente_ejectuvo()'  style = 'width:220px;'>
								<option value = '0'>[SELECCIONE]</option>
							</select>							
						</td>
						
						<td style = 'padding-left:10px;'>
							<p>Seleccione un Cliente:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_itemspendientes_cliente' onchange = 'report_itemspendientes_buscar_cliente_producto()' style = 'width:220px;'>
								<option value = '0'>[SELECCIONE]</option>
							</select>							
						</td>
						
						<td style = 'padding-left:10px;'>
							<p>Seleccione un No. de Ppto:</p>
							<select class = 'entradas_bordes' id = 'report_produccion_itemspendientes_presupuesto' style = 'width:220px;'>
								<option value = '0'>[SELECCIONE]</option>
							</select>							
						</td>
		
						<td style = 'padding-left:10px;vertical-align:middle;'>
							<img src = '../images/iconos/lupa_naranja.png' width = '45px' onclick = 'generar_reporte_html_itemspendientes_ordenacion();'/>
						</td>
					</tr>
				</table>";
		}else if($turno == 2){
			$empresa = $_POST['emp'];
			$list_directores = "<option value = '0'>[SELECCIONE]</option>";
			
			$sql_directores = mysql_query("select distinct e.nombre_empleado,u.idusuario
			from cabot ot,usuario u, empleado e
			where ot.pk_nit_empresa_ot = '$empresa' and ot.director = u.idusuario and u.pk_empleado = e.documento_empleado order by e.nombre_empleado asc");
			while($row = mysql_fetch_array($sql_directores)){
				$list_directores.= "<option value=".$row['idusuario'].">".utf8_decode($row['nombre_empleado'])."</option>";
			}
			$estructura = $list_directores;
		}else if($turno == 3){
			$empresa = $_POST['emp'];
			$director = $_POST['director'];
			
			$list_ejecutivos = "<option value = '0'>[SELECCIONE]</option>";
			
			$sql_ejecutivos = mysql_query("select distinct e.nombre_empleado,u.idusuario
			from cabot ot,usuario u, empleado e
			where ot.pk_nit_empresa_ot = '$empresa' and ot.director = '$director' and ot.ejecutivo = u.idusuario and u.pk_empleado = e.documento_empleado order by e.nombre_empleado asc");
			while($row = mysql_fetch_array($sql_ejecutivos)){
				$list_ejecutivos.= "<option value=".$row['idusuario'].">".utf8_decode($row['nombre_empleado'])."</option>";
			}
			$estructura = $list_ejecutivos;
		}else if($turno == 4){
			$empresa = $_POST['emp'];
			$director = $_POST['director'];
			$ejecutivo = $_POST['ejecutivo'];
			
			$list_ejecutivos = "<option value = '0'>[SELECCIONE]</option>";
			
			$sql_ejecutivos = mysql_query("select distinct c.nombre_comercial_cliente,c.codigo_interno_cliente
			from cabot ot, clientes c
			where ot.pk_nit_empresa_ot = '$empresa' and ot.director = '$director' and ot.ejecutivo = '$ejecutivo' and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente order by c.nombre_comercial_cliente asc");
			while($row = mysql_fetch_array($sql_ejecutivos)){
				$list_ejecutivos.= "<option value=".$row['codigo_interno_cliente'].">".utf8_decode($row['nombre_comercial_cliente'])."</option>";
			}
			$estructura = $list_ejecutivos;
		}else if($turno == 5){
			$empresa = $_POST['emp'];
			$director = $_POST['director'];
			$ejecutivo = $_POST['ejecutivo'];
			$cliente = $_POST['cliente'];
			
			$list_ejecutivos = "<option value = '0'>[SELECCIONE]</option>";
			
			$sql_ejecutivos = mysql_query("select pr.codigo_presup,pr.numero_presupuesto,pr.referencia
			from cabot ot, cabpresup pr
			where ot.pk_nit_empresa_ot = '$empresa' and ot.director = '$director' and ot.ejecutivo = '$ejecutivo' and ot.producto_clientes_pk_clientes_nit_procliente = '$cliente'
			and ot.codigo_ot = pr.ot order by pr.codigo_presup asc");
			while($row = mysql_fetch_array($sql_ejecutivos)){
				$list_ejecutivos.= "<option value=".$row['codigo_presup'].">".($row['referencia'])."</option>";
			}
			$estructura = $list_ejecutivos;
		}else if($turno == 6){
			$empresa = $_POST['emp'];
			
			$list_ejecutivos = "<option value = '0'>[SELECCIONE]</option>";
			
			$sql_ejecutivos = mysql_query("select distinct p.codigo_interno_proveedor,p.nombre_comercial_proveedor
			from cabpresup pr, itempresup ip, proveedores p
			where pr.empresa_nit_empresa = '$empresa' and pr.codigo_presup = ip.ppto and ip.proveedor = p.codigo_interno_proveedor order by p.nombre_comercial_proveedor asc");
			while($row = mysql_fetch_array($sql_ejecutivos)){
				$list_ejecutivos.= "<option value=".$row['codigo_interno_proveedor'].">".($row['nombre_comercial_proveedor'])."</option>";
			}
			$estructura = $list_ejecutivos;
		}
	}	
	echo $estructura;
?>