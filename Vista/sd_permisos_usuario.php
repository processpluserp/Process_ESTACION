<?php
	session_start();
	include("../Controller/Conexion.php");
	require("../Modelo/permisos.php");
?>

<!DOCTYPE html>
	<html lang="es">
		<head>
			<title>:: PROCESS + ::</title>
			<meta charset="utf-8" />
			<link type="text/css" href="../css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
			<script type="text/javascript" src="../js/jquery1_10_2.js"></script>
			<script type="text/javascript" src="../css_jquery/css_logeo.js"></script>
			<link type="text/css" href="../css/barra_navegacion2.css" rel="stylesheet" />
			<link type="text/css" href="../css/trafico.css" rel="stylesheet" />
			<script type="text/javascript" src="../js/permisos_usuarios.js"></script>
			<link rel="stylesheet" href="../css/jquery-ui.css">
			<script type="text/javascript" src="../js/jquery_ui/jquery-ui.js"></script>
		</head>
		<body>
			<?php 
				include("contenido_gestion2.php");
			?>
			<div id = "contenedor_principal_gestion">
				<span id = "id_usuario"><?php echo  $_SESSION['codigo_usuario']?></span>
				
				<!--PERMISOS EMPRESA -->
				<p>PERMISOS EMPRESA</p>
				<select id = "usuario">
				<option value = "...">...</option>
					<?php
						$consulta_usuarios = "select idusuario,nombre_usuario from usuario where estado = 1";
						$result = mysql_query($consulta_usuarios);
						while($row = mysql_fetch_array($result)){
							echo "<option value = ".$row['idusuario'].">".$row['nombre_usuario']."</option>";
						}
					?>
				</select>
				<select id = "empresa">
					<option value = "...">...</option>
					<?php
						$consulta_empresa = "select cod_interno_empresa, nombre_comercial_empresa from empresa where estado = 1";
						$result2 = mysql_query($consulta_empresa);
						while($row = mysql_fetch_array($result2)){
							echo "<option value = ".$row['cod_interno_empresa'].">".$row['nombre_comercial_empresa']."</option>";
						}
					?>
				</select>
				<button id = "agregar_permiso_empresa">Habilitar Empresa</button>
				<div id = "contenedor_permisos">
					
				</div>
				
				
				<!--PERMISOS CLIENTE -->
				<p>PERMISOS CLIENTES</p>
				<select id = "usuario_cliente">
				<option value = "...">...</option>
					<?php
						$consulta_usuarios = "select idusuario,nombre_usuario from usuario where estado = 1";
						$result = mysql_query($consulta_usuarios);
						while($row = mysql_fetch_array($result)){
							echo "<option value = ".$row['idusuario'].">".$row['nombre_usuario']."</option>";
						}
					?>
				</select>
				
				<select id = "empresa_clie"></select>
				
				<select id = "cliente">
				</select>
				
				<select id = "producto_cliente">
				</select>
				<button id = "agregar_permiso_cliente">Habilitar Cliente Y Producto</button>
				
				</br>
				<!--PERMISOS EMPRESA DEPARTAMENTO -->
				<p>PERMISOS DEPARTAMENTOS EMPRESA</p>
				<select id = "usuario_depto">
				<option value = "...">...</option>
					<?php
						$consulta_usuarios = "select idusuario,nombre_usuario from usuario where estado = 1";
						$result = mysql_query($consulta_usuarios);
						while($row = mysql_fetch_array($result)){
							echo "<option value = ".$row['idusuario'].">".$row['nombre_usuario']."</option>";
						}
					?>
				</select>
				<select id = "empresa_depto">					
				</select>
				<select id = "departamento_general">
				</select>
				<button id = "agregar_permiso_depto">Habilitar Departamento</button>
				
				</br>
				<!--PERMISOS RESPONSABLE -->
				<p>PERMISOS RESPONSABLE</p>
				<select id = "usuario_r">
				<option value = "...">...</option>
					<?php
						$consulta_usuarios = "select idusuario,nombre_usuario from usuario where estado = 1";
						$result = mysql_query($consulta_usuarios);
						while($row = mysql_fetch_array($result)){
							echo "<option value = ".$row['idusuario'].">".$row['nombre_usuario']."</option>";
						}
					?>
				</select>
				<select id = "empresa_depto_r">
				</select>
				<select id = "departamento_general_r">
				</select>
				<select id = "responsable">
				</select>
				<button id = "agregar_permiso_responsable">Habilitar Responsable</button>
				
				</br>
				<!--PERMISOS ASIGNADO -->
				<p>PERMISOS ASIGNADO</p>
				<select id = "usuario_a">
				<option value = "...">...</option>
					<?php
						$consulta_usuarios = "select idusuario,nombre_usuario from usuario where estado = 1";
						$result = mysql_query($consulta_usuarios);
						while($row = mysql_fetch_array($result)){
							echo "<option value = ".$row['idusuario'].">".$row['nombre_usuario']."</option>";
						}
					?>
				</select>
				<select id = "empresa_depto_a">
				</select>
				<select id = "departamento_general_a">
				</select>
				<select id = "asignado">
				</select>
				<button id = "agregar_permiso_asignado">Habilitar Asignado</button>
				
				</br>
				<!--PERMISOS DIRECTOR OT -->
				<p>PERMISOS DIRECTOR</p>
				<select id = "usuario_direc">
				<option value = "...">...</option>
					<?php
						$consulta_usuarios = "select idusuario,nombre_usuario from usuario where estado = 1";
						$result = mysql_query($consulta_usuarios);
						while($row = mysql_fetch_array($result)){
							echo "<option value = ".$row['idusuario'].">".$row['nombre_usuario']."</option>";
						}
					?>
				</select>
				<select id = "director">
					<option value = "...">...</option>
					<?php
						$select = "select a.usuario, u.nombre_usuario from asigsur a, usuario u where a.rol = 3 and a.usuario = u.idusuario";
						$result = mysql_query($select);
						while($row = mysql_fetch_array($result)){
							echo "<option value = ".$row['usuario'].">".$row['nombre_usuario']."</option>";
						}
					?>
					?>
				</select>
				<button id = "agregar_permiso_director">Asignar Director</button>
				
				
				</br>
				<!--PERMISOS ROL POR USUARIO -->
				<p>PERMISOS ROLES POR USUARIO</p>
				<select id = "usuario_rol">
				<option value = "...">...</option>
					<?php
						$consulta_usuarios = "select idusuario,nombre_usuario from usuario where estado = 1";
						$result = mysql_query($consulta_usuarios);
						while($row = mysql_fetch_array($result)){
							echo "<option value = ".$row['idusuario'].">".$row['nombre_usuario']."</option>";
						}
					?>
				</select>
				<select id = "rol">
					<option value = "...">...</option>
					<?php
						$consulta_usuarios = "select consecutivo,rol from usur";
						$result = mysql_query($consulta_usuarios);
						while($row = mysql_fetch_array($result)){
							echo "<option value = ".$row['consecutivo'].">".utf8_encode($row['rol'])."</option>";
						}
					?>
				</select>
				<button id = "agregar_permiso_rol">Habilitar Rol</button>
			</div>
		</body>