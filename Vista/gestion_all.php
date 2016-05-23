<?php
	
	//Contiene los datos de Conexion a la base de datos.
	include("../Controller/Conexion.php");
	require("../Modelo/Empresa.php");
	require("../Modelo/Cliente.php");
	require("../Modelo/asoccliemp.php");
	require("../Modelo/producto_cliente.php");
	require("../Modelo/Proveedor.php");
	require("../Modelo/asocproemp.php");
	require("../Modelo/pais.php");
	require("../Modelo/ceco.php");
	require("../Modelo/departamento.php");
	require("../Modelo/usuarios.php");
	require("../Modelo/gestion_cabecera.php");
	require("../Modelo/empleado.php");
	require("../Modelo/inv_tecnologia.php");
	require("../Modelo/muebles.php");
	require("../Modelo/permisos.php");
	session_start();
	
	$usuario = $_SESSION['codigo_usuario'];
	$fecha = date("Y-m-d h:i:s");
	$turno = $_POST['turno'];
	if($turno == 0){
		$_SESSION["nombre_usuario"] = "";
		$_SESSION["departamento_usuario"] = "";
		$_SESSION["codigo_usuario"] = "";
		$_SESSION["nick_usuario"] = "";
	}
	
	
	else if($turno == 1){
		$nit = $_POST['nit'];
		$consulta = "select e.cod_interno_empresa, e.nit_empresa, e.nombre_legal_empresa,
			e.nombre_comercial_empresa,e.iniciales_empresa,e.phone_empresa,e.direccion_empresa, e.nota_orden,e.observacion,
			c.nombre_ciudad	from empresa e, ciudad c where e.ciudad_codigo_ciudad=c.codigo_ciudad  and
			e.nit_empresa like '%$nit%'";
		$result = mysql_query($consulta);
		$registros = mysql_num_rows($result);
		if($registros == 0){
			echo "<p class = 'resultado_gestion_consulta'>NO SE ENCONTRARON REGISTROS</p>";
		}ELSE{
			$tabla = "<table id = 'tabla_contenedor_info_empresas' width = '100%' class = 'tablas_muestra_datos_tablas' class = 'tablas_muestra_datos_tablas'>
			<tr>
				<th>NIT</th>
				<th>Nombre Legal</th>
				<th>Nombre Comercial</th>
				<th>Iniciales</th>
				<th>Teléfono</th>
				<th>Dirección</th>
				<th>Ciudad</th>
				<th></th>
				<th></th>
			</tr>";
			while($row = mysql_fetch_array($result)){
				$id = $row['cod_interno_empresa'];
				$tabla .= "<tr id =".$row['cod_interno_empresa'].">
					<td class = 'tabla_nit_empresa'>".$row['nit_empresa']."</td>
					<td>".$row['nombre_legal_empresa']."</td>
					<td>".$row['nombre_comercial_empresa']."</td>
					<td>".$row['iniciales_empresa']."</td>
					<td>".$row['phone_empresa']."</td>
					<td  nowrap>".$row['direccion_empresa']."</td>
					<td>".$row['nombre_ciudad']."</td>									
					<td id = 'nota$id' class = 'campo_oculto_tabla'>".$row['nota_orden']."</td>
					<td id = 'nota_ppto$id' class = 'campo_oculto_tabla'>".utf8_encode($row['observacion'])."</td>
					<td><img src = '../images/editar.png' onclick = 'editar_empresa_gestion($id)' class = 'botones'/></td>
					<td><img src = '../images/prueba.jpg' /></td>
				</tr>";
			}
			$tabla .="</table>";
			echo $tabla;
		}
	}
	else if($turno == 2){
		$nombre = $_POST['nombre'];
		$consulta = "select e.cod_interno_empresa, e.nit_empresa, e.nombre_legal_empresa,
			e.nombre_comercial_empresa,e.iniciales_empresa,e.phone_empresa,e.direccion_empresa, e.nota_orden,e.observacion,
			c.nombre_ciudad	from empresa e, ciudad c where e.ciudad_codigo_ciudad=c.codigo_ciudad  and
			e.nombre_comercial_empresa like '%$nombre%'";
		$result = mysql_query($consulta);
		$registros = mysql_num_rows($result);
		if($registros == 0){
			echo "<p class = 'resultado_gestion_consulta'>NO SE ENCONTRARON REGISTROS</p>";
		}ELSE{
			$tabla = "<table id = 'tabla_contenedor_info_empresas' width = '100%' class = 'tablas_muestra_datos_tablas'>
			<tr>
				<th>NIT</th>
				<th>Nombre Legal</th>
				<th>Nombre Comercial</th>
				<th>Iniciales</th>
				<th>Teléfono</th>
				<th>Dirección</th>
				<th>Ciudad</th>
				<th></th>
				<th></th>
			</tr>";
			while($row = mysql_fetch_array($result)){
				$id = $row['cod_interno_empresa'];
				$tabla .= "<tr id =".$row['cod_interno_empresa'].">
					<td class = 'tabla_nit_empresa'>".$row['nit_empresa']."</td>
					<td>".$row['nombre_legal_empresa']."</td>
					<td>".$row['nombre_comercial_empresa']."</td>
					<td>".$row['iniciales_empresa']."</td>
					<td>".$row['phone_empresa']."</td>
					<td  nowrap>".$row['direccion_empresa']."</td>
					<td>".$row['nombre_ciudad']."</td>									
					<td id = 'nota$id' class = 'campo_oculto_tabla'>".$row['nota_orden']."</td>
					<td id = 'nota_ppto$id' class = 'campo_oculto_tabla'>".utf8_encode($row['observacion'])."</td>
					<td><img src = '../images/editar.png' onclick = 'editar_empresa_gestion($id)' class = 'botones'/></td>
					<td><img src = '../images/prueba.jpg' /></td>
				</tr>";
			}
			$tabla .="</table>";
			echo $tabla;
		}
	}
	else if($turno == 3){
		$consulta = "select e.cod_interno_empresa, e.nit_empresa, e.nombre_legal_empresa,
			e.nombre_comercial_empresa,e.iniciales_empresa,e.phone_empresa,e.direccion_empresa, e.nota_orden,e.observacion,
			c.nombre_ciudad	from empresa e, ciudad c where e.ciudad_codigo_ciudad=c.codigo_ciudad";
		$result = mysql_query($consulta);
		$registros = mysql_num_rows($result);
		if($registros == 0){
			echo "<p class = 'resultado_gestion_consulta'>NO SE ENCONTRARON REGISTROS</p>";
		}ELSE{
			$tabla = "<table id = 'tabla_contenedor_info_empresas' width = '100%' class = 'tablas_muestra_datos_tablas'>
			<tr>
				<th>NIT</th>
				<th>Nombre Legal</th>
				<th>Nombre Comercial</th>
				<th>Iniciales</th>
				<th>Teléfono</th>
				<th>Dirección</th>
				<th>Ciudad</th>
				<th></th>
				<th></th>
			</tr>";
			while($row = mysql_fetch_array($result)){
				$id = $row['cod_interno_empresa'];
				$tabla .= "<tr id =".$row['cod_interno_empresa'].">
					<td class = 'tabla_nit_empresa'>".$row['nit_empresa']."</td>
					<td>".$row['nombre_legal_empresa']."</td>
					<td>".$row['nombre_comercial_empresa']."</td>
					<td>".$row['iniciales_empresa']."</td>
					<td>".$row['phone_empresa']."</td>
					<td  nowrap>".$row['direccion_empresa']."</td>
					<td>".$row['nombre_ciudad']."</td>									
					<td id = 'nota$id' class = 'campo_oculto_tabla'>".$row['nota_orden']."</td>
					<td id = 'nota_ppto$id' class = 'campo_oculto_tabla'>".utf8_encode($row['observacion'])."</td>
					<td><img src = '../images/editar.png' onclick = 'editar_empresa_gestion($id)' class = 'botones'/></td>
					<td><img src = '../images/prueba.jpg' /></td>
				</tr>";
			}
			$tabla .="</table>";
			echo $tabla;
		}
	}
	else if($turno == 4){
		$empresa = new empresa();
		$empresa->set_nit($_POST['nit']);
		$empresa->set_nlegal($_POST['legal']);
		$empresa->set_ncomercial($_POST['comercial']);
		//$empresa->set_iniciales($_POST['iniciales']);
		//$empresa->set_phone($_POST['phone']);
		//$empresa->set_direccion($_POST['direc']);
		//$empresa->set_nota($_POST['nota']);
		//$empresa->set_nota_ppto($_POST['n_ppto']);
		//$empresa->set_ciudad($_POST['ciudad']);
		//$empresa->set_depto($_POST['depto']);
		//$empresa->set_pais($_POST['pais']);
		//$empresa->set_facebook($_POST['n_face']);
		//$empresa->set_youtube($_POST['n_you']);
		//$empresa->set_twitter($_POST['n_twitter']);
		//$empresa->set_noc($_POST['n_nota_oc']);
		//$empresa->set_web($_POST['n_web']);
		//$empresa->set_correo($_POST['email']);
		//$empresa->set_rlegal($_POST['n_re_legal']);
		$id = $empresa->max_id_empresa();
		$file1 ="";// $id."@".$_FILES['bienvenida0']['name'];
		$file2 = $id."@".$_FILES['logo0']['name'];
		$empresa->insert_empresa($file2,$file1);
		$empresa->crear_empresa($empresa->consultar_id());
		
		/*
		$correos = $_POST['email'];
		$correos = explode(",",$correos);
		for($i = 0;$i < count($correos);$i++){
			$empresa->insert_correos($correos[$i],$id);
		}
		$representantes = $_POST['n_re_legal'];
		$representantes = explode(",",$representantes);
		for($i = 0;$i < count($representantes);$i++){
			$empresa->insert_representantes($representantes[$i],$id);
		}
		
		$telefono = $_POST['phone'];
		$telefono = explode(",",$telefono);
		for($i = 0;$i < count($telefono);$i++){
			$empresa->insert_telefono($telefono[$i],$id);
		}		
		*/
		$file2 = $_FILES['logo0']['name'];
		$ruta = "../images/logos/$file2";
		$ruta_n ="../images/logos/$id@$file2";
		move_uploaded_file($_FILES['logo0']['tmp_name'],"../images/logos/$file2");
		rename($ruta,$ruta_n);
		
		echo "SE CREÓ LA EMPRESA ".$empresa->get_nlegal();
		
	}
	else if($turno == 5){
		$empresa = new empresa();
		$id = $_POST['emp'];
		$empresa->set_nlegal($_POST['legal']);
		$empresa->set_ncomercial($_POST['comercial']);
		$empresa->set_ciudad($_POST['ciudad']);
		$empresa->set_depto($_POST['depto']);
		$empresa->set_pais($_POST['pais']);
		//$empresa->set_iniciales($_POST['iniciales']);
		//$empresa->set_phone($_POST['phone']);
		$empresa->set_direccion($_POST['direc']);
		//$empresa->set_nota($_POST['nota']);
		//$empresa->set_nota_ppto($_POST['n_ppto']);
		$empresa->set_facebook($_POST['n_face']);
		$empresa->set_youtube($_POST['n_you']);
		$empresa->set_twitter($_POST['n_twitter']);
		//$empresa->set_noc($_POST['n_nota_oc']);
		$empresa->set_web($_POST['n_web']);
		//$empresa->set_correo($_POST['email']);
		$empresa->set_rlegal($_POST['n_re_legal']);
		if($_POST['archivos'] == 0){
			$empresa->modificar_empresa($_POST['emp']);
		}else if($_POST['archivos'] == 1){
			$file1 = $id."@".$_FILES['bienvenida0']['name'];
			$ruta = "../images/logos/$file1";
			move_uploaded_file($_FILES['bienvenida0']['tmp_name'],"../images/logos/$file1");
			$empresa->modificar_empresa_logo($_POST['emp'],$file1);
		}
		echo "EMPRESA MODIFICADA";
	}
	
	else if($turno == 6){
		$pais = $_POST['p'];
		$consulta = "select d.codigo_departamento, d.nombre_departamento from departamento d
		where d.pais_codigo_pais = '$pais'";
		$result = mysql_query($consulta);
		$imprimir = "<option value = ''>...</option>";
		while($row = mysql_fetch_array($result)){
			$imprimir .= "<option value =".$row['codigo_departamento']." >".$row['nombre_departamento']."</option>";
		}
		echo $imprimir;
	}
	
	else if($turno == 7){
		$depto = $_POST['d'];
		$consulta = "select codigo_ciudad, nombre_ciudad from ciudad where
		departamento_codigo_departamento = '$depto'";
		$result = mysql_query($consulta);
		while($row = mysql_fetch_array($result)){
			echo "<option value = ".$row['codigo_ciudad'].">".$row['nombre_ciudad']."</option>";
		}
	}
	else if($turno == 8){
		$nit = $_POST['n'];
		$consulta = "select e.cod_interno_empresa, e.nit_empresa, e.nombre_legal_empresa,
			e.nombre_comercial_empresa,e.iniciales_empresa,e.phone_empresa,e.direccion_empresa, e.nota_orden,
			c.nombre_ciudad	from empresa e, ciudad c where e.ciudad_codigo_ciudad=c.codigo_ciudad  and
			e.nit_empresa ='$nit'";
		$result = mysql_query($consulta);
		$contador = 0;
		while($row = mysql_fetch_array($result)){
			$contador++;
		}
		if($contador > 0){
			echo "1";
		}else{
			echo "0";
		}
	}
	
	//Cliente
	else if($turno == 9){
		$nit = $_POST['nit'];
		$estado =  $_POST['estado'];
		$consulta = "select c.codigo_interno_cliente, c.nit_cliente, c.nombre_comercial_cliente,
			c.nombre_legal_clientes, c.telefono_cliente, c.direccion_cliente, c.estado, ci.nombre_ciudad from clientes c, ciudad ci 
			where c.ciudad_codigo_ciudad=ci.codigo_ciudad and c.nit_cliente like '%$nit%' and c.estado = '$estado'";
		$result = mysql_query($consulta);
		$registros = mysql_num_rows($result);
		if($registros == 0){
			echo "<p class = 'resultado_gestion_consulta'>NO SE ENCONTRARON REGISTROS</p>";
		}ELSE{
			$tabla = "<table id = 'tabla_contenedor_info_cliente' width = '100%' class = 'tablas_muestra_datos_tablas'>
			<tr>
				<th>NIT</th>
				<th>Nombre Legal</th>
				<th>Nombre Comercial</th>
				<th>Teléfono</th>
				<th>Dirección</th>
				<th>Ciudad</th>
				<th>Estado</th>
				<th></th>
				<th></th>
			</tr>";
			while($row = mysql_fetch_array($result)){
				$id = $row['codigo_interno_cliente'];
				$estado = $row['estado'];
				$valor_estado = "";
				if ($estado == 1){
					$valor_estado = "ACTIVO";
				}else{
					$valor_estado = "INACTIVO";
				}
				$tabla.= "<tr id =".$row['codigo_interno_cliente'].">
						<td class = 'tabla_nit_empresa'>".$row['nit_cliente']."</td>
						<td>".$row['nombre_comercial_cliente']."</td>
						<td>".$row['nombre_legal_clientes']."</td>
						<td>".$row['telefono_cliente']."</td>
						<td>".$row['direccion_cliente']."</td>
						<td>".$row['nombre_ciudad']."</td>	
						<td>".$valor_estado."</td>								
						<td><img src = '../images/editar.png' onclick = 'editar_cliente_gestion($id)' class = 'botones'/></td>
						<td><img src = '../images/prueba.jpg' onclick = 'cambiar_estado_cliente($id)'/></td>
					</tr>";
			}
			$tabla .="</table>";
			echo $tabla;
		}
	}
	else if($turno == 10){
		$nombre = $_POST['name'];
		$estado =  $_POST['estado'];
		$consulta = "select c.codigo_interno_cliente, c.nit_cliente, c.nombre_comercial_cliente,
			c.nombre_legal_clientes, c.telefono_cliente, c.direccion_cliente, c.estado, ci.nombre_ciudad from clientes c, ciudad ci 
			where c.ciudad_codigo_ciudad=ci.codigo_ciudad and c.nombre_comercial_cliente like '%$nombre%' and c.estado = '$estado'";
		$result = mysql_query($consulta);
		$registros = mysql_num_rows($result);
		if($registros == 0){
			echo "<p class = 'resultado_gestion_consulta'>NO SE ENCONTRARON REGISTROS</p>";
		}ELSE{
			$tabla = "<table id = 'tabla_contenedor_info_cliente' width = '100%' class = 'tablas_muestra_datos_tablas'>
			<tr>
				<th>NIT</th>
				<th>Nombre Legal</th>
				<th>Nombre Comercial</th>
				<th>Teléfono</th>
				<th>Dirección</th>
				<th>Ciudad</th>
				<th>Estado</th>
				<th></th>
				<th></th>
			</tr>";
			while($row = mysql_fetch_array($result)){
				$id = $row['codigo_interno_cliente'];
				$estado = $row['estado'];
				$valor_estado = "";
				if ($estado == 1){
					$valor_estado = "ACTIVO";
				}else{
					$valor_estado = "INACTIVO";
				}
				$tabla.= "<tr id =".$row['codigo_interno_cliente'].">
						<td class = 'tabla_nit_empresa'>".$row['nit_cliente']."</td>
						<td>".$row['nombre_comercial_cliente']."</td>
						<td>".$row['nombre_legal_clientes']."</td>
						<td>".$row['telefono_cliente']."</td>
						<td>".$row['direccion_cliente']."</td>
						<td>".$row['nombre_ciudad']."</td>	
						<td>".$valor_estado."</td>								
						<td><img src = '../images/editar.png' onclick = 'editar_cliente_gestion($id)' class = 'botones'/></td>
						<td><img src = '../images/prueba.jpg' onclick = 'cambiar_estado_cliente($id)'/></td>
					</tr>";
			}
			$tabla .="</table>";
			echo $tabla;
		}
	}
	else if($turno == 11){
		$nit = $_POST['nit'];
		$consulta = "select c.codigo_interno_cliente, c.nit_cliente from clientes c
			where c.nit_cliente = '$nit'";
		$result = mysql_query($consulta);
		$contador = 0;
		while($row = mysql_fetch_array($result)){
			$contador++;
		}
		if($contador > 0){
			echo "1";
		}else{
			echo "0";
		}
	}
	else if($turno == 12){
		$primeros_campos = $_POST['primeros'];
		$datos_ubicacion= $_POST['ubicacion'];
		$datos_empresas_asoc = $_POST['asoc'];
		$texto_empresas_asoc = $_POST['asoc_1'];
		$clie = new cliente();
		
		//Datos Cliente:
		$clie->set_nit_cliente($primeros_campos[0]);
		$clie->set_nlegal_cliente($primeros_campos[1]);
		$clie->set_ncomercial_cliente($primeros_campos[2]);
		$clie->set_telefono_cliente($primeros_campos[3]);
		$clie->set_direccion_cliente($primeros_campos[4]);
		$clie->set_ciudad_cliente($datos_ubicacion[2]);
		$clie->set_depto_cliente($datos_ubicacion[1]);
		$clie->set_pais_cliente($datos_ubicacion[0]);
		$clie->set_estado_cliente(1);
		$fecha = date("Y-m-d h:i:s");
		//Se crea la carpeta del cliente.
		$clie->crear_cliente($clie->get_nit_cliente());
		$clie->insert_cliente($usuario,$fecha);
		
		$nit_cliente = $clie->get_nit_cliente();
		$consult = "select codigo_interno_cliente from clientes where nit_cliente =".$nit_cliente;
		$resultado = mysql_query($consult);
		$id_cliente_nuevo = "";
		while($row = mysql_fetch_array($resultado)){
			$id_cliente_nuevo = $row['codigo_interno_cliente'];
		}
		$asoc = new asocliemp();
		for($i = 0; $i < count($datos_empresas_asoc); $i++){
			$asoc->set_iniciales_asocliemp($datos_empresas_asoc[$i]);
			$asoc->set_empresa_asocliemp($texto_empresas_asoc[$i]);
			$asoc->set_cliente_asocliemp($id_cliente_nuevo);
			$asoc->insert_asocliemp($usuario,$fecha);
		}
		echo "EL CLIENTE ".$clie->get_nlegal_cliente()." HA SIDO CREADO";
	}
	
	else if($turno == 13){
		$consulta = "select c.codigo_interno_cliente, c.nit_cliente, c.nombre_comercial_cliente,
			c.nombre_legal_clientes, c.telefono_cliente, c.direccion_cliente, c.estado, ci.nombre_ciudad from clientes c, ciudad ci 
			where c.ciudad_codigo_ciudad=ci.codigo_ciudad";
		$result = mysql_query($consulta);
		$registros = mysql_num_rows($result);
		if($registros == 0){
			echo "<p class = 'resultado_gestion_consulta'>NO SE ENCONTRARON REGISTROS</p>";
		}ELSE{
			$tabla = "<table id = 'tabla_contenedor_info_cliente' width = '100%' class = 'tablas_muestra_datos_tablas'>
			<tr>
				<th>NIT</th>
				<th>Nombre Legal</th>
				<th>Nombre Comercial</th>
				<th>Teléfono</th>
				<th>Dirección</th>
				<th>Ciudad</th>
				<th>Estado</th>
				<th></th>
				<th></th>
			</tr>";
			while($row = mysql_fetch_array($result)){
				$id = $row['codigo_interno_cliente'];
				$estado = $row['estado'];
				$valor_estado = "";
				if ($estado == 1){
					$valor_estado = "ACTIVO";
				}else{
					$valor_estado = "INACTIVO";
				}
				$tabla.= "<tr id =".$row['codigo_interno_cliente'].">
						<td class = 'tabla_nit_empresa'>".$row['nit_cliente']."</td>
						<td>".$row['nombre_comercial_cliente']."</td>
						<td>".$row['nombre_legal_clientes']."</td>
						<td>".$row['telefono_cliente']."</td>
						<td>".$row['direccion_cliente']."</td>
						<td>".$row['nombre_ciudad']."</td>	
						<td>".$valor_estado."</td>								
						<td><img src = '../images/editar.png' onclick = 'editar_cliente_gestion($id)' class = 'botones'/></td>
						<td><img src = '../images/prueba.jpg' onclick = 'cambiar_estado_cliente($id)'/></td>
					</tr>";
			}
			$tabla .="</table>";
			echo $tabla;
		}
	}
	else if($turno == 14){
		$clie = new cliente();
		$clie->set_nit_cliente($_POST['nit_cliente']);
		$clie->set_nlegal_cliente($_POST['nlegal']);
		$clie->set_ncomercial_cliente($_POST['ncomercial']);
		$clie->set_telefono_cliente($_POST['phone']);
		$clie->set_direccion_cliente($_POST['direccion']);
		$clie->set_ciudad_cliente($_POST['ciudad']);
		$clie->set_depto_cliente($_POST['depto']);
		$clie->set_pais_cliente($_POST['pais']);
		$fecha = date("Y-m-d h:i:s");
		$clie->modificar_cliente($usuario, $fecha);
		
		$id_cliente_nuevo = $_POST['id'];
		$asoc = new asocliemp();
		//Sociedades:
		$emp = $_POST['check_empresa'];
		$iniciales = $_POST['iniciales'];
		
		if($iniciales[0] !="$#$#$#"){
			for($i = 0; $i < count($emp);$i++){
				$asoc->set_iniciales_asocliemp($iniciales[$i]);
				$asoc->set_empresa_asocliemp($emp[$i]);
				$asoc->set_cliente_asocliemp($id_cliente_nuevo);
				$asoc->insert_asocliemp($usuario,$fecha);
			}
		}
		echo "SE HA MODIFICADO EL CLIENTE CON NIT: ".$clie->get_nit_cliente();
	}
	else if($turno == 15){
		$nit = $_POST['nit'];
		$estado = $_POST['est'];
		$consulta = "update clientes set estado = '$estado' where nit_cliente = '$nit'";
		$result = mysql_query($consulta);
		
		$consulta = "select c.codigo_interno_cliente, c.nit_cliente, c.nombre_comercial_cliente,
		c.nombre_legal_clientes, c.telefono_cliente, c.direccion_cliente, c.estado, ci.nombre_ciudad from clientes c, ciudad ci 
		where c.nit_cliente = '$nit' and c.ciudad_codigo_ciudad=ci.codigo_ciudad";
		$result = mysql_query($consulta);
		$tabla = "<table id = 'tabla_contenedor_info_cliente' width = '100%' class = 'tablas_muestra_datos_tablas'>
			<tr>
				<th>NIT</th>
				<th>Nombre Legal</th>
				<th>Nombre Comercial</th>
				<th>Iniciales</th>
				<th>Teléfono</th>
				<th>Dirección</th>
				<th>Ciudad</th>
				<th></th>
				<th></th>
			</tr>";
			while($row = mysql_fetch_array($result)){
				$id = $row['codigo_interno_cliente'];
				$estado = $row['estado'];
				$valor_estado = "";
				if ($estado == 1){
					$valor_estado = "ACTIVO";
				}else{
					$valor_estado = "INACTIVO";
				}
				$tabla.= "<tr id =".$row['codigo_interno_cliente'].">
					<td class = 'tabla_nit_empresa'>".$row['nit_cliente']."</td>
					<td>".$row['nombre_comercial_cliente']."</td>
					<td>".$row['nombre_legal_clientes']."</td>
					<td>".$row['telefono_cliente']."</td>
					<td>".$row['direccion_cliente']."</td>
					<td>".$row['nombre_ciudad']."</td>	
					<td>".$valor_estado."</td>								
					<td><img src = '../images/editar.png' onclick = 'editar_cliente_gestion($id)' class = 'botones'/></td>
					<td><img src = '../images/prueba.jpg' onclick = 'cambiar_estado_cliente($id)'/></td>
				</tr>";
			}
			$tabla .="</table>";
			echo $tabla;
	}
	
	//MOdulo Productos Cliente
	else if($turno == 16){
		$nombre = $_POST['nombre'];
		$consulta = "select pc.id_procliente, pc.estado, pc.nombre_producto, c.nombre_legal_clientes from producto_clientes pc, clientes c 
		where pc.pk_clientes_nit_procliente = c.codigo_interno_cliente and pc.nombre_producto like '%$nombre%'";
		$result = mysql_query($consulta);
		$tabla = "<table id = 'tabla_contenedor_info_productos_cliente' width = '100%' class = 'tablas_muestra_datos_tablas'>
			<tr>
				<th>Nombre Producto</th>
				<th>Cliente</th>
				<th>Estado</th>
				<th></th>
			</tr>";
		while($row = mysql_fetch_array($result)){
			$id = $row['id_procliente'];
			$estado = "";
			if($row['estado'] == 1){
				$estado = "ACTIVO";
			}else{
				$estado = "INACTIVO";
			}
			$tabla .= "<tr id = ".$row['id_procliente'].">
				<td>".$row['nombre_producto']."</td>
				<td>".$row['nombre_legal_clientes']."</td>
				<td>".$estado."</td>
				<td><img src = '../images/prueba.jpg' onclick = 'cambiar_estado_producto_cliente($id)'/></td>
			</tr>";
		}
		
		
	}
	else if($turno == 17){
		$cliente = $_POST['nombre'];
		$consulta = "select pc.id_procliente,pc.estado, pc.nombre_producto, c.nombre_legal_clientes from clientes c,producto_clientes pc where 
		c.codigo_interno_cliente = '$cliente' and pc.pk_clientes_nit_procliente = '$cliente'";
		$result = mysql_query($consulta);
		$registros = mysql_num_rows($result);
		if($registros == 0){
			echo "<p class = 'resultado_gestion_consulta'>NO SE ENCONTRARON PRODUCTOS</p>";
		}else{
			$tabla = "<table id = 'tabla_contenedor_info_productos_cliente' width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>Nombre Producto</th>
					<th>Cliente</th>
					<th>Estado</th>
					<th></th>
				</tr>";
			while($row = mysql_fetch_array($result)){
				$id = $row['id_procliente'];
				$estado = "";
				if($row['estado'] == 1){
					$estado = "ACTIVO";
				}else{
					$estado = "INACTIVO";
				}
				$tabla .= "<tr id = ".$row['id_procliente'].">
					<td>".$row['nombre_producto']."</td>
					<td>".$row['nombre_legal_clientes']."</td>
					<td>".$estado."</td>
					<td><img src = '../images/prueba.jpg' onclick = 'cambiar_estado_producto_cliente($id)'/></td>
				</tr>";
			}
			echo $tabla;
		}
	}
	else if($turno == 18){
		$consulta = "select pc.id_procliente, pc.estado, pc.nombre_producto, c.nombre_legal_clientes from producto_clientes pc, clientes c where 
		pc.pk_clientes_nit_procliente = c.codigo_interno_cliente";
		$result = mysql_query($consulta);
		$registros = mysql_num_rows($result);
		if($registros == 0){
			echo "<p class = 'resultado_gestion_consulta'>NO SE ENCONTRARON PRODUCTOS</p>";
		}else{
			$tabla = "<table id = 'tabla_contenedor_info_productos_cliente' width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>Nombre Producto</th>
					<th>Cliente</th>
					<th>Estado</th>
					<th></th>
				</tr>";
			while($row = mysql_fetch_array($result)){
				$id = $row['id_procliente'];
				$estado = "";
				if($row['estado'] == 1){
					$estado = "ACTIVO";
				}else{
					$estado = "INACTIVO";
				}
				$tabla .= "<tr id = ".$row['id_procliente'].">
					<td>".$row['nombre_producto']."</td>
					<td>".$row['nombre_legal_clientes']."</td>
					<td>".$estado."</td>
					<td><img src = '../images/prueba.jpg' onclick = 'cambiar_estado_producto_cliente($id)'/></td>
				</tr>";
			}
			echo $tabla;
		}
	}
	else if($turno == 19){
		$name = $_POST['name'];
		$cliente = $_POST['cliente'];
		$pro = new producto_cliente();
		$pro->set_nombre_procliente($_POST['name']);
		$pro->set_cliente_procliente($_POST['cliente']);
		$pro->set_estado_producto_cliente(1);
		$pro->insert_procliente($usuario,$fecha);
		
		$consulta = "select pc.id_procliente,pc.estado, pc.nombre_producto, c.nombre_legal_clientes from producto_clientes pc, clientes c where 
		pc.pk_clientes_nit_procliente = c.codigo_interno_cliente and pc.nombre_producto = '$name' and pc.pk_clientes_nit_procliente = '$cliente'";
		$result = mysql_query($consulta);
		$tabla = "<table id = 'tabla_contenedor_info_productos_cliente' width = '100%' class = 'tablas_muestra_datos_tablas'>
			<tr>
				<th>Nombre Producto</th>
				<th>Cliente</th>
				<th>Estado</th>
				<th></th>
			</tr>";
		while($row = mysql_fetch_array($result)){
			$id = $row['id_procliente'];
			$estado = "";
			if($row['estado'] == 1){
				$estado = "ACTIVO";
			}else{
				$estado = "INACTIVO";
			}
			$tabla .= "<tr id = ".$row['id_procliente'].">
				<td>".$row['nombre_producto']."</td>
				<td>".$row['nombre_legal_clientes']."</td>
				<td>".$estado."</td>
				<td><img src = '../images/prueba.jpg' onclick = 'cambiar_estado_producto_cliente($id)'/></td>
			</tr>";
		}
		echo $tabla;
	}
	else if($turno == 20){
		$id = $_POST['id'];
		$pro = new producto_cliente();
		$pro->set_estado_producto_cliente($_POST['estado']);
		$pro->update_procliente($id,$fecha,$usuario);
		
		$consulta = "select pc.id_procliente, pc.estado, pc.nombre_producto, c.nombre_legal_clientes from producto_clientes pc, clientes c where 
		pc.pk_clientes_nit_procliente = c.codigo_interno_cliente and pc.id_procliente = '$id'";
		$result = mysql_query($consulta);
		$tabla = "<table id = 'tabla_contenedor_info_productos_cliente' width = '100%' class = 'tablas_muestra_datos_tablas'>
			<tr>
				<th>Nombre Producto</th>
				<th>Cliente</th>
				<th>Estado</th>
				<th></th>
			</tr>";
		while($row = mysql_fetch_array($result)){
			$id = $row['id_procliente'];
			$estado = "";
			if($row['estado'] == 1){
				$estado = "ACTIVO";
			}else{
				$estado = "INACTIVO";
			}
			$tabla .= "<tr id = ".$row['id_procliente'].">
				<td>".$row['nombre_producto']."</td>
				<td>".$row['nombre_legal_clientes']."</td>
				<td>".$estado."</td>
				<td><img src = '../images/prueba.jpg' onclick = 'cambiar_estado_producto_cliente($id)'/></td>
			</tr>";
		}
		echo $tabla;
	}
	
	//Proveedor
	else if($turno == 21){
		$prov = new proveedor();
		$prov->mostrar_proveedor_nit($_POST['nit']);
	}
	else if($turno == 22){
		$prov = new proveedor();
		$prov->mostrar_proveedor_nombre($_POST['nlegal']);
	}
	else if($turno == 23){
		$prov = new proveedor();
		$prov->mostrar_tabla_todos_proveedor();
	}
	else if($turno == 24){
		$nit = $_POST['nit'];
		$consulta = "select nombre_legal_proveedor from proveedores where nit_proveedor = '$nit'";
		$result = mysql_query($consulta);
		$registros = mysql_num_rows($result);
		if($registros == 0){
			echo 0;
		}else{
			echo 1;
		}
	}
	else if($turno == 25){
		
	}
	else if($turno == 26){
		$prov = new proveedor();
		$estado = $_POST['esta'];
		$nit = $_POST['nii'];
		$iid = $_POST['id'];
		$prov->cambiar_estado_proveedor($estado,$nit);
		$prov->mostrar_tabla_nuevo_proveedor($nit);
	}
	else if($turno == 27){
		$prov = new proveedor();
		$prov->set_nit_proveedor($_POST['n_nit_proveedore']);
		$prov->set_ncomercial_proveedor($_POST['n_ncomercial_proveedore']);
		$prov->set_nlegal_proveedor($_POST['n_nlegal_proveedore']);
		$prov->set_direccion_proveedor($_POST['n_direccion_proveedore']);
		$prov->set_correo_proveedor($_POST['n_correo_proveedore']);
		$prov->set_telefono_proveedor($_POST['n_telefono_proveedore']);
		$prov->set_usuario_proveedor($usuario);
		$prov->set_fecha_registro_proveedor($fecha);
		$prov->modificar_proveedor();
		$empresas = $_POST['empresasx'];
		if(count($empresas) > 0){
			$asoc = new asociacion_proveedor_empresa();
			$id_prov = $_POST['id'];
			
			for($i = 0;$i < count($empresas);$i++){
				$asoc->set_fecha_asociacion_asocproemp($fecha);
				$asoc->set_proveedor_asocproemp($id_prov);
				$asoc->insert_asocproemp($usuario,$empresas[$i]);
			}
		}
	}
	else if($turno == 28){
		$p = $_POST['pais'];
		$pais = new pais();
		$pais->mostrar_relacion_ubicacion_x_pais($p);
	}
	else if($turno == 29){
		$p = $_POST['pais'];
		$pais = new pais();
		$pais->mostrar_relacion_ubicacion_x_depto($p);
	}
	else if($turno == 30){
		$p = $_POST['pais'];
		$pais = new pais();
		$pais->mostrar_relacion_ubicacion_x_ciudad($p);
	}
	else if($turno == 31){
		$p = $_POST['empresa'];
		$ceco = new ceco();
		$ceco->filtrar_datos_empresa($p);
	}
	else if($turno == 32){
		$p = $_POST['empresa'];
		$ceco = new ceco();
		$ceco->filtrar_datos_CECO($p);
	}
	else if($turno == 33){
		$ceco = new ceco();
		$ceco->mostrar_datos();
	}
	else if($turno == 34){
		$ceco = new ceco();
		$ceco->set_estado(1);
		$ceco->set_nombre($_POST['nombre']);
		$ceco->set_empresa($_POST['emp']);
		$ceco->insert_ceco($usuario,$fecha);
		echo "SE HA CREADO EL CECO ".$_POST['nombre'];
	}
	else if($turno == 35){
		$ceco = new ceco();
		$ceco->set_nombre($_POST['name']);
		$ceco->modificar_ceco($_POST['cod']);
	}
	else if($turno == 36){
		$ceco = new ceco();
		$ceco->cambiar_estado_ceco($_POST['id'],$_POST['est']);
		$ceco->mostrar_datos_filtrado($_POST['id']);
		//echo $_POST['id']."..".$_POST['est'];
	}
	else if($turno == 37){
		$depto = new departamento();
		$depto->estructura_tabla($depto->filtrar_empresa_depto($_POST['empresa']));
	}
	
	else if($turno == 38){
		$depto = new departamento();
		$depto->estructura_tabla($depto->filtrar_depto($_POST['depto']));
	}
	else if($turno == 39){
		$depto = new departamento();
		$depto->estructura_tabla($depto->mostrar_datos($_POST['emp']));
	}
	else if($turno == 40){
		$depto = new departamento();
		$depto->set_empresa($_POST['emp']);
		$depto->set_nombrearea(($_POST['depto']));
		$depto->set_unidad_negocio(($_POST['und']));
		$depto->set_codigo_areas_empresa($depto->consulta_id_empresa($_POST['emp']));
		$depto->insert_area_trabajo($usuario,$fecha);
		echo "SE HA CREADO EL DEPARTAMENTO ".strtoupper($_POST['depto']);
	}
	else if($turno == 41){
		$depto = new departamento();
		$depto->modificar_estado($_POST['id'],$_POST['estado']);
		$depto->estructura_tabla($depto->filtrar_id($_POST['id']));
	}
	else if($turno == 42){
		$depto = new departamento();
		$depto->modificar_nombre_depto($_POST['id'],strtoupper($_POST['depto']));
		$depto->estructura_tabla($depto->filtrar_id($_POST['id']));
	}
	else if($turno == 43){
		$usuarios = new usuario();
		$usuarios->estrutura_tabla_usuarios($usuarios->filtrar_empresa($_POST['empresa']));
	}
	else if($turno == 44){
		$usuarios = new usuario();
		$usuarios->estrutura_tabla_usuarios($usuarios->filtrar_usuario($_POST['empresa']));
	}
	
	else if($turno == 45){
		$usuarios = new usuario();
		$usuarios->estrutura_tabla_usuarios($usuarios->mostrar_datos());
	}
	/*
	else if($turno == 46){
		$emp = $_POST['emp'];
		$consulta = "select d.codigo_interno_empresa, d.nombre_area_empresa from area_empresa d where d.pk_empresa_areas = '$emp'";
		$result = mysql_query($consulta);
		$emp = "<option value = ''>...</option>";
		while($row = mysql_fetch_array($result)){
			$emp .= "<option value = ".$row['codigo_interno_empresa'].">".$row['nombre_area_empresa']."</option>";
		}
		echo $emp;
	}*/
	
	//Subida de Documentos de las Empresas
	else if($turno == 47){
		$emp = $_POST['emp'];
		$tipo = $_POST['tipo'];
		$fechax = $_POST['fecha'];
		$valor = $_POST['valor'];
		
		$arc = "";
		if($_POST['tipo_x'] == 0){
			$ins = mysql_query("insert into documentos_legales_entidades(name,fvencimiento,pk_empresa,pk_tdocumento,valor) values
			('".$arc."','".$fechax."','".$emp."','".$tipo."','".$valor."')");
			echo "TARIFA GUARDADA";
		}else{
			$file = $_FILES['archivo0']['name'];
			$maxid = 0;
			$sql = mysql_query("select max(id) as id from historico_documentos");
			while($row = mysql_fetch_array($sql)){
				$maxid = $row['id'];
			}
			$maxid++;
			
			$consulta = mysql_query("select name from documentos_legales_entidades where pk_empresa = '$emp' and pk_tdocumento = '$tipo'");
			$ruta = "../Process/EMPRESA/$emp/DOCUMENTOS/$file";
			$ruta_n="../Process/EMPRESA/$emp/DOCUMENTOS/$maxid@$file";
			$arc = $maxid."@".$file;
			move_uploaded_file($_FILES['archivo0']['tmp_name'],"../Process/EMPRESA/$emp/DOCUMENTOS/$maxid@$file");
			//rename($ruta,$ruta_n);
			$s = mysql_query("insert into historico_documentos(name,tipo,fecha,empresa,usuario) values ('".$arc."','".$tipo."','".$fecha."','".$emp."','".$usuario."')");
			
			if(mysql_num_rows($consulta) == 0){
				$ins = mysql_query("insert into documentos_legales_entidades(name,fvencimiento,pk_empresa,pk_tdocumento,valor) values
				('".$arc."','".$fechax."','".$emp."','".$tipo."','".$valor."')");
				echo "DOCUMENTO SUBIDO";
			}else{
				$id = "";
				$consultax = mysql_query("select consecutivo from documentos_legales_entidades where pk_empresa = '$emp' and pk_tdocumento = '$tipo'");
				while($row = mysql_fetch_array($consultax)){
					$id = $row['consecutivo'];
				}
				$ins = mysql_query("update documentos_legales_entidades
				set name = '$arc',fvencimiento = '$fechax',valor = '$valor' where consecutivo = '$id'");
				echo "DOCUMENTO MODIFICADO";
			}
		}
		$gestion = new cabecera_pagina();
		$correos = $_POST['notificar'];
		$correos = explode(",",$correos);
		if(count($correos) > 0){
			for($i = 0;$i < count($correos);$i++){
				if($correos[$i] != ""){
					$gestion->insert_notificaciones("DOC",$correos[$i],$tipo,$emp);
				}
			}
		}		
	}
	
	else if($turno == 48){
		$gestion = new cabecera_pagina();
		$gestion->filtrar_datos_por_empresa_documentos($_POST['emp']);
	}
	
	else if($turno == 49){
		$gestion = new cabecera_pagina();
		$gestion->obtener_num_alertas_factura_documento();
	}
	
	/*DATOS DEL EMPLEADO*/
	else if($turno == 50){
		$emp = new empleado();
		$emp->set_numero_documento($_POST['cedula']);
		$emp->set_nombre_empleado($_POST['name']);
		$emp->set_sexo_empleado($_POST['sexo']);
		$emp->set_direccion_empleado($_POST['direccion']);
		$emp->set_telefono_empleado($_POST['phone_casa']);
		$emp->set_celular_empleado($_POST['celular']);
		$emp->set_cargo_empleado($_POST['cargo']);
		$emp->set_correo_empleado($_POST['correo']);
		$emp->set_und($_POST['und']);
		
		//$emp->set_fecha_retiro($_POST['fecha_retiro_empleado']);
		//$emp->set_motivo_retiro($_POST['motivo_retiro']);
		$emp->set_correo_personal($_POST['correo_personal']);
		
		$emp->set_fecha_nacimiento_empleado($_POST['fnacimiento']);
		$emp->set_tipo_documento_empleado($_POST['td']);
		$emp->set_eps_empleado($_POST['eps']);
		$emp->set_rh_empleado($_POST['rh']);
		$emp->set_fecha_ingreso_empleado($_POST['fingreso']);
		$emp->set_fondo_pensiones_empleado($_POST['fpension']);
		$emp->set_fondo_cesantias_empleado($_POST['fcesantias']);
		$emp->set_fondo_caja_compensacion($_POST['caja']);
		$emp->set_arl_empleado($_POST['arl']);
		$emp->set_fecha_registro($fecha);
		$emp->set_area_empleado($_POST['area']);
		$emp->set_empresA_empleado($_POST['emp']);
		$emp->set_usuario_empleado($usuario);
		$file = $_POST['empleado_foto'];
		$n_file = $_POST['cedula']."@".$file;
		rename("../Process/temp/$file","../Process/EMPLEADO/$n_file");
		$emp->insert_empleado($fecha,$usuario,$n_file,$_POST['contacto_emergencia'],$_POST['num_contacto']);
		$emp->set_salario_base($_POST['salario_base_empleado']);
		$emp->set_b_alimentacion($_POST['bonos_alimentacion']);
		$emp->set_bn_prestacional($_POST['bnp']);
		$emp->set_otros($_POST['otros_salario']);
		$emp->insert_salario_empleado($fecha);
		
		$hijos = $_POST['hijos'];
		for($i = 0; $i < $hijos; $i++){
			$emp->insert_hijos_empleados($_POST['cedula'],$_POST["name$i"],$_POST["fn$i"]);
		}
		
		$emp->consultar_datos_empleado($_POST['emp']);
	}
	
	else if($turno == 51){
		$emp = $_POST['emp'];
		$sel = mysql_query("select documento_empleado, nombre_empleado from empleado where pk_empresa = '$emp'");
		$imp = "<option value = 'vacio'></option>";
		while($row = mysql_fetch_array($sel)){
			$imp .="<option value ='".$row['documento_empleado']."'>".$row['nombre_empleado']."</option>";
		}
		echo $imp;
	}
	else if($turno == 52){
		$inv = new inv_tecnologia();
		$inv->set_empresa($_POST['emp']);
		$inv->set_usuario($_POST['empleado_inv_tecnologia']);
		$inv->set_tipo($_POST['tipo']);
		$inv->set_paltaforma($_POST['plataforma']);
		$inv->set_marca($_POST['marca']);
		$inv->set_modelo($_POST['modelo']);
		$inv->set_serie_modelo($_POST['s_modelo']);
		$inv->set_monitor($_POST['monitor']);
		$inv->set_serie_monitor($_POST['s_monitor']);
		$inv->set_mouse($_POST['mouse']);
		$inv->set_serie_mouse($_POST['s_mouse']);
		$inv->set_teclado($_POST['teclado']);
		$inv->set_serie_teclado($_POST['s_teclado']);
		$inv->set_dd($_POST['dd']);
		$inv->set_memoria($_POST['memoria']);
		$inv->set_procesador($_POST['procesador']);
		$inv->set_velocidad($_POST['velocidad']);
		$inv->set_drive($_POST['drive']);
		$inv->insert_inv_tecnologia($fecha,$usuario);		
		$inv->mostrar_datos();
	}
	
	else if($turno == 53){
		$emp = $_POST['emp'];
		$inv = new inv_tecnologia();
		if($emp == "vacio"){
			$inv->mostrar_datos();
		}else{
			$inv->mostrar_datos_empresa($emp);
		}	
	}
	else if($turno == 54){
		$emp = $_POST['emp'];
		$pla = $_POST['pla'];
		$inv = new inv_tecnologia();
		$inv->mostrar_datos_empresa_plataforma($emp,$pla);
	}
	
	else if($turno == 55){
		$emp = $_POST['emp'];
		$sel = mysql_query("select ar.nombre_area_empresa, ar.codigo_interno_empresa from area_empresa ar where ar.pk_empresa_areas = '$emp'");
		$imp = "<option value = 'vacio'></option>";
		while($row = mysql_fetch_array($sel)){
			$imp .= "<option value = '".$row['codigo_interno_empresa']."'>".$row['nombre_area_empresa']."</option>";
		}
		echo $imp;
	}
	
	else if($turno == 56){
		$muebles = new muebles();
		$muebles->set_descripcion($_POST['desc']);
		$muebles->set_valor_hoy($_POST['val_hoy']);
		$muebles->set_valor_compra($_POST['val_compra']);
		$muebles->set_quien($_POST['quien']);
		$muebles->set_factura($_POST['factura']);
		$muebles->set_area_empresa($_POST['area_empresa_muebles']);
		$muebles->set_empresa($_POST['empresa_muebles_n']);
		$muebles->set_depreciacion("0");
		$muebles->insert_muebles($fecha,$usuario);
		$muebles->mostrar_item_creado();
	}
	else if($turno == 57){
		$muebles = new muebles();
		$muebles->mostrar_datos_empresa($_POST['emp']);
	}
	
	else if($turno == 58){
		$emple = new empleado();
		$emple->cambiar_estado_empleado($_POST['id'],$_POST['est']);
	}
	else if($turno == 59){
		$emple = new empleado();
		$emple->consultar_datos_empleado();
	}
	
	else if($turno == 60){
		$emple = new empleado();
		$emple->info_basica_empleado($_POST['id']);
	}
	else if($turno == 61){
		$inv = new inv_tecnologia();
		$inv->mostrar_hoja_inventario_equipo($_POST['id']);
	}
	else if($turno == 62){
		$emple = new empleado();
		echo $emple->personal_down($_POST['periodo'],$_POST['emp'],$_POST['und']);
	}
	/*GENERAR CUADRO DE NOMINA*/
	else if($turno == 63){
		$emple = new empleado();
		$emple->estructura_editar_empleado($_POST['id']);
	}
	
	else if($turno == 64){
		$emple = new empleado();
		$emple->set_nombre_empleado($_POST['name']);
		$emple->set_cargo_empleado($_POST['cargo']);
		
		$emple->set_fecha_retiro($_POST['e_fecha_retiro_empleado']);
		
		if($_POST['e_fecha_retiro_empleado'] != '0000-00-00'){
			mysql_query("update empleado set estado = '0' where documento_empleado = '".$_POST['cedula']."'");
			mysql_query("update usuario set estado = '0' where pk_empleado = '".$_POST['cedula']."'");
		}
		$emple->set_motivo_retiro($_POST['e_motivo_retiro']);
		$emple->set_und($_POST['e_und']);
		$emple->set_area_empleado($_POST['e_departamento_empleado']);
		$emple->set_sexo_empleado($_POST['sexo']);
		$emple->set_correo_personal($_POST['e_correo_personal']);
		$emple->set_eps_empleado($_POST['eps']);
		$emple->set_arl_empleado($_POST['arl']);
		$emple->set_correo_empleado($_POST['correo']);
		$emple->set_direccion_empleado($_POST['direc']);
		$emple->set_fondo_pensiones_empleado($_POST['fpension']);
		$emple->set_telefono_empleado($_POST['e_phone_casa']);
		$emple->set_fondo_cesantias_empleado($_POST['e_fondo_cesantias']);
		$emple->set_celular_empleado($_POST['e_celular_empleado']);
		$emple->set_fondo_caja_compensacion($_POST['e_caja_compensacion']);
		//$emple->set_salario_base($_POST['e_salario_base_empleado']);
		//$emple->set_b_alimentacion($_POST['e_bonos_alimentacion']);
		//$emple->set_bn_prestacional($_POST['e_bnp']);
		//$emple->set_otros($_POST['e_otros_salario']);
		
		if($_POST['foto'] == 0){
			$emple->update_empleados_sin_foto($_POST['cedula'],$usuario,$n_file);
		}else{
			$file = $_POST['empleado_foto'];
			$n_file = $_POST['cedula']."@".$file;
			rename("../Process/temp/$file","../Process/EMPLEADO/$n_file");
			$emple->update_empleados($_POST['cedula'],$usuario,$n_file);
		}
	}
	else if($turno == 65){
		$emple = new empleado();
		$emple->consultar_datos_empleado($_POST['emp'],$_POST['alto']);
	}
	else if($turno == 66){
		$emple = new empleado();
		$emple->consultar_dato_x_empleado($_POST['c'],$_POST['emp']);
	}
	else if($turno == 67){
		$emple = new empleado();
		//$periodo = $_SESSION['periodo_nomina'];
		echo $emple->hoja_vida_empleado($_POST['c'],$_POST['periodo'],$_POST['emp']);
	}
	
	else if($turno == 68){
		$usu = new usuario();
		$usu->set_pk_empleado($_POST['empleado']);
		$usu->set_nombre_usuario($_POST['name']);
		$usu->insert_usuario($usuario,$fecha,$_POST['perfil'],$_POST['depto']);
		$id = $usu->id_usuario_consultar($_POST['name'],$_POST['empleado']);
		$permi = new permisos();
		$permi->permisos_administrador($id,$_POST['perfil']);
		$usu->estrutura_tabla_usuarios($usu->mostrar_datos_x_usuario($_POST['e']));
	}
	
	else if($turno == 69){
		$emple = new empleado();
		$emple->listado_empleados_carga($_POST['emp']);
	}
	
	else if($turno == 70){
		$emple = new empleado();
		$emple->generar_cuadros($_POST['emp'],$_POST['categorias'],$_POST['und'],$usuario);
	}
	
	else if($turno == 71){
		$_SESSION['periodo_nomina'] = $_POST['periodo'];
		/*$periodo = $_POST['periodo'];*/
	}
	
	else if($turno == 72){
		$imp = "<option value = 'vacio'></option>";
		$emp = $_POST['emp'];
		$periodo = $_SESSION['periodo_nomina'];
		
		$sql = mysql_query("select e.nombre_empleado, e.documento_empleado 
					from empleado e, tablas_empleados te
					where e.documento_empleado = te.cedula and te.periodo ='$periodo' and te.empresa = '$emp'");
		while($row = mysql_fetch_array($sql)){
			$imp .= "<option value ='".$row['documento_empleado']."'>".$row['nombre_empleado']."</option>";
		}
		echo $imp;
	}
	
	else if($turno == 73){
		$emple = new empleado();
		$emple->modificar_dias_empleado_hv($_POST['id'],$_POST['d'],$_POST['emple'],$_POST['periodo'],$_POST['emp']);
	}
	
	else if($turno == 74){
		$emple = new empleado();
		//$periodo = $_SESSION['periodo_nomina'];
		$emple->nomina_detallado($_POST['periodo'],$_POST['emp'],$_POST['und']);
	}
	else if($turno == 75){
		$emplex = new empleado();
		$emplex->cambiar_people($_POST['p'],$_POST['id']);
		$emplex->nomina_detallado($_POST['periodo'],$_POST['emp'],$_POST['und']);
	}
	
	else if($turno == 76){
		$emplex = new empleado();
		$emplex->cambiar_pacc($_POST['p'],$_POST['id']);
		$emplex->nomina_detallado($_POST['periodo'],$_POST['emp'],$_POST['und']);
	}
	else if($turno == 77){
		$emplex = new empleado();
		$emplex->cambiar_examenes($_POST['p'],$_POST['id']);
		$emplex->nomina_detallado($_POST['periodo'],$_POST['emp'],$_POST['und']);
	}
	else if($turno == 78){
		$impri = "<option value = ''>PERIODO</option>";
		$sql = mysql_query("select distinct periodo from tablas_empleados where empresa = '$emp'");
		while($row = mysql_fetch_array($sql)){
			$impri .= "<option value = '".$row['periodo']."'>".$row['periodo']."</option>";
		}
		echo $impri;
	}
?>
