<?php
	include("Conexion.php");
	require("../Modelo/usuarios.php");
	
	$usu = new usuario();
	
	$usuario = $_POST['usuario'];
	$password = $_POST['password'];
	
	$consulta = "select u.idusuario, u.nick, u.contrasena,emp.nombre_empleado, u.estado, u.perfil,d.nombre_area_empresa,emp.pk_empresa,d.codigo_interno_empresa
			from usuario u, empleado emp,area_empresa d 
			where u.pk_empleado = emp.documento_empleado and emp.pk_depto = d.codigo_interno_empresa and u.nick = '$usuario' and u.contrasena = '$password' ";
			$result = mysql_query($consulta);
	
	$cantidad_registros_consulta = mysql_num_rows($result);
	
	$_SESSION['error'] = "";
	if($cantidad_registros_consulta > 0){
		session_start();
		while($row = mysql_fetch_array($result)){
			$_SESSION["nombre_usuario"] = $row['nombre_empleado'];
			$_SESSION["departamento_usuario"] = $row['nombre_area_empresa'];
			$_SESSION["num_departamento"] = $row['codigo_interno_empresa'];
			$_SESSION["codigo_usuario"] = $row['idusuario'];
			$_SESSION["nick_usuario"] = $row['nick'];
			$_SESSION["perfil"] = $row['perfil'];
			$_SESSION["empresa_empleado"] = $row['pk_empresa'];
			$_SESSION['error'] = "";
			$_SESSION['autentic'] = "SIP";
		}
		$error = "";
		header("Location:../Vista/bienvenida.php");
	}else{
		$error = "<div id ='mensaje_error'><span>Ha ingresado los datos Mal! Verifique sus datos de Logeo</span></div>";
		$_SESSION['error'] = $error;
		header("Location:../logeo.php");
	}
	
?>