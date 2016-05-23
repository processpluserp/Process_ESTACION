<?php
	/*
		Usuario.php
		@author Damian Mosquera
		
		Esta clase recibe via POST todos los parámetros para ejecutar las siguientes acciones correspondientes al logeo de los usuarios.
		
	*/
	include("Controller/Conexion.php");
	
	//Se recibe por POST el turno correspondiente a la acción que se va a realizar.
	$t = $_POST['t'];
	
	
	switch($t){
		case 1:
			/*
				Dentro de esta caso, se verifica que el usuario ingresado tenga o no contraseña.
				@param string $name recibe el nombre que ha ingresado el usuario.
				
				La consulta verifica que el usuario se encuentra activo y que no tenga contraseña; De ser cierto, returna 1, de lo contrario
				0.
			*/
			$name = $_POST['usuario'];
			$sql = mysql_query("select idusuario, contrasena from usuario where nick = '$name' and contrasena  = '' and usu = '1'");
			
			if(mysql_num_rows($sql) == 1){
				echo 1;
			}else{
				echo 0;
			}
		break;
		
		case 2:
			/*
				Dentro de este caso, se reciben los siguientes parámetros:
				@param string usuario vía POST, contiene el nombre de usuario.
				@param string password vía POST, contiene la contraseña del usuaril.
				
				Mediante la consulta @param sql consulta se verifica que los datos coincidan con los de la base datos;
				Se verifica si la consulta trae más de un registro, se crean las variables de session donde se almacenará los siguientes datos:
				@param string $_SESSION['nombre_usuario'] Nombre del empleado  @example RICARDO JOSE HUERTADO.
				@param int $_SESSION['departamento_usuario'] Código del departamento al que pertenece el empleado. @example 1
				@param int $_SESSION['codigo_usuario'] Código del usuario almacenado en la BD. @example 1
				@param string $_SESSION['nick_usuario'] Usuario del empleaddo. @example dmosquera
				@param int $_SESSION['perfil'] Código del perfil del usuario. @example 1
				@param string $_SESSION['error'] Mensaje de error. @example "Error"
				Se devuelve un 1 al archivo de Javascript css_logeo.js diciendole que puede redireccionar al módulo correspondiente.
				
				Si no se trae ningún registros dentro de la variable error se guarda la información del mensaje de error, y adicional, se duvuelve
				un 0 indicando que no se encontró ningúna información.
				
			*/
			$usuario = $_POST['usuario'];
			$password = $_POST['password'];
			
			$consulta = "select u.idusuario, u.nick, u.contrasena,emp.nombre_empleado, u.estado, u.perfil,
					d.nombre_area_empresa from usuario u, empleado emp,area_empresa d 
					where u.pk_empleado = emp.documento_empleado and emp.pk_depto = d.codigo_interno_empresa and u.nick = '$usuario' and u.contrasena = '$password' ";
					$result = mysql_query($consulta);
			
			$cantidad_registros_consulta = mysql_num_rows($result);
			session_start();
			$_SESSION['error'] = "";
			if($cantidad_registros_consulta > 0){
				while($row = mysql_fetch_array($result)){
					$_SESSION["nombre_usuario"] = $row['nombre_empleado'];
					$_SESSION["departamento_usuario"] = $row['nombre_area_empresa'];
					$_SESSION["codigo_usuario"] = $row['idusuario'];
					$_SESSION["nick_usuario"] = $row['nick'];
					$_SESSION["perfil"] = $row['perfil'];
					$_SESSION['error'] = "";
				}
				$error = "";
				echo 1;
			}else{
				$error = "<div id ='mensaje_error'><span>Ha ingresado los datos Mal! Verifique sus datos de Logeo</span></div>";
				$_SESSION['error'] = $error;
				echo 0;//header("Location:logeo.php");
			}
		break;
		
		case 3:
			/*
				Dentro de este caso, se modifica la contraseña de usuario cuando este no tiene una contraseña
				previamente creada.
				@param string $usu nombre de usuario.
				@param string $pass nueva contraseña.
			*/
			$usu = $_POST['usu'];
			$pass = $_POST['pass'];
			mysql_query("update usuario set contrasena = '$pass' where nick = '$usu'");
			break;
	}
	
?>