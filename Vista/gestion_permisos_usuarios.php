<?php
	include("../Controller/Conexion.php");
	require("../Modelo/permisos.php");

	$turno = $_POST['turno'];
	$fecha = date("Y-m-d");
	$permisos = new permisos();
	
	
	if($turno == 1){
		$permisos->set_usuario($_POST['usu']);
		$permisos->set_asignador($_POST['asig']);
		$permisos->set_empresa($_POST['emp']);
		$x = $permisos->insert_permisos_empresa($fecha,$permisos->consulta_sino_empresa($_POST['usu'],$_POST['emp']));
		if($x == 1){
			echo "Permisos Habilitados";
		}else{
			echo "Error !, Permiso ya habilitado";
		}
	}
	else if($turno == 2){
		$permisos->estructura_permisos_empresa($permisos->consultar_permisos_usuario($_POST['usu']));
	}
	else if($turno == 3){
		$permisos->borrar_permisos_empresa($_POST['id']);
		echo "Permisos Borrados";
	}
	else if($turno == 4){
		$id = $_POST['cliente'];
		$consulta_empresa = "select id_procliente, nombre_producto from producto_clientes where estado = 1 and pk_clientes_nit_procliente = '$id' ";
		$result2 = mysql_query($consulta_empresa);
		while($row = mysql_fetch_array($result2)){
			echo "<option value = ".$row['id_procliente'].">".$row['nombre_producto']."</option>";
		}
	}
	else if($turno == 5){
		$permisos->set_usuario($_POST['usu']);
		$permisos->set_asignador($_POST['asig']);
		$permisos->set_cliente($_POST['clie']);
		$permisos->set_producto($_POST['pclie']);
		$permisos->set_empresa($_POST['emp']);
		$x = $permisos->insert_permisos_cliente_producto($fecha, $permisos->consulta_sino_cliente($_POST['usu'],$_POST['clie'],$_POST['pclie'],$_POST['emp']));
		if($x == 1){
			echo "Permisos Habilitados";
		}else{
			echo "Error !, Permiso ya habilitado";
		}
	}
	else if($turno == 6){
		$permisos->estructura_permisos_cliente($permisos->consultar_permisos_usuario_cliente($_POST['usu']));
	}
	else if($turno == 7){
		$permisos->borar_permisos_cliente_producto($_POST['id']);
		echo "Permisos Borrados";
	}
	else if($turno == 8){
		$emp = $_POST['emp'];
		$imp = "<option value = '...'>...</option>";
		$consulta_empresa = "select a.codigo_interno_empresa, a.nombre_area_empresa from area_empresa a where a.estado = 1 and a.pk_empresa_areas = '$emp'";
		
		//select a.codigo_interno_empresa, a.nombre_area_empresa from area_empresa a, pdepto p where a.estado = 1 and p.pk_empresa = '$emp' and p.pk_depto = a.codigo_interno_empresa
		$result2 = mysql_query($consulta_empresa);
		while($row = mysql_fetch_array($result2)){
			$imp .= "<option value = ".$row['codigo_interno_empresa'].">".$row['nombre_area_empresa']."</option>";
		}
		echo $imp;
	}
	else if($turno == 9){
		$permisos->set_usuario($_POST['usu']);
		$permisos->set_asignador($_POST['asig']);
		$permisos->set_departamento($_POST['depto']);
		$permisos->set_empresa($_POST['emp']);
		$x = $permisos->insert_permisos_depto($fecha, $permisos->consulta_sino_depto($_POST['usu'],$_POST['depto'],$_POST['emp']));
		if($x == 1){
			echo "Permisos Habilitados";
		}else{
			echo "Error !, Permiso ya habilitado";
		}
	}
	else if($turno == 10){
		$depto = $_POST['depto'];
		$emp = $_POST['emp'];
		$imp = "<option value = '...'>...</option>";
		$consulta_empresa = "select idusuario, nombre_usuario from usuario where estado = 1 and pk_departamento = '$depto' and pk_empleado_cedula = '$emp'";
		$result2 = mysql_query($consulta_empresa);
		while($row = mysql_fetch_array($result2)){
			$imp .= "<option value = ".$row['idusuario'].">".$row['nombre_usuario']."</option>";
		}
		echo $imp;
	}
	else if($turno == 11){
		$permisos->set_usuario($_POST['usu']);
		$permisos->set_asignador($_POST['asig']);
		$permisos->set_departamento($_POST['depto']);
		$permisos->set_empresa($_POST['emp']);
		$permisos->set_responsable($_POST['respon']);
		$x = $permisos->insert_permisos_responsable($fecha, $permisos->consulta_sino_responsable($_POST['usu'],$_POST['depto'],$_POST['emp'],$_POST['respon']));
		if($x == 1){
			echo "Permisos Habilitados";
		}else{
			echo "Error !, Permiso ya habilitado";
		}
	}
	else if($turno == 12){
		$permisos->set_usuario($_POST['usu']);
		$permisos->set_asignador($_POST['asig']);
		$permisos->set_departamento($_POST['depto']);
		$permisos->set_empresa($_POST['emp']);
		$permisos->set_responsable($_POST['respon']);
		$x = $permisos->insert_permisos_asignado($fecha, $permisos->consulta_sino_asignado($_POST['usu'],$_POST['depto'],$_POST['emp'],$_POST['respon']));
		if($x == 1){
			echo "Permisos Habilitados";
		}else{
			echo "Error !, Permiso ya habilitado";
		}
	}
	//Permisos Director
	else if($turno == 13){
		$permisos->set_usuario($_POST['usu']);
		$permisos->set_asignador($_POST['asig']);
		$permisos->set_director($_POST['direc']);
		$permisos->insert_permiso_director($fecha);
		echo "Permiso Habiliitado.";
	}
	
	//Asignación de Rol
	else if($turno == 14){
		$permisos->set_usuario($_POST['usu']);
		$permisos->set_rol($_POST['rol']);
		$x = $permisos->insert_rol_usuario($fecha, $permisos->consulta_sino_rol($_POST['usu']));
		if($x == 1){
			echo "Permisos Habilitados";
		}else{
			echo "Error ! Este usuario ya tiene un rol asignado";
		}
	}
	
	else if($turno == 100){
		$imp = "<option value = '...'>...</option>";
		$usu = $_POST['usu'];
		$consulta_empresa = "select e.cod_interno_empresa, e.nombre_comercial_empresa from empresa e, pusuemp p where e.estado = 1 and p.cod_empresa = e.cod_interno_empresa and cod_usuario = '$usu'";
		$result2 = mysql_query($consulta_empresa);
		while($row = mysql_fetch_array($result2)){
			$imp .= "<option value = ".$row['cod_interno_empresa'].">".$row['nombre_comercial_empresa']."</option>";
		}
		echo $imp;
	}
	else if($turno == 101){
		$imp = "<option value = '...'>...</option>";
		$emp = $_POST['emp'];
		$consulta_empresa = "select e.codigo_interno_cliente, e.nombre_comercial_cliente from clientes e, asocliemp c where e.estado = 1 and 
		c.pk_nit_cliente_empresa_asoc = e.codigo_interno_cliente and c.pk_nit_empresa_cliente_asoc = '$emp'";
		$result2 = mysql_query($consulta_empresa);
		while($row = mysql_fetch_array($result2)){
			$imp .= "<option value = ".$row['codigo_interno_cliente'].">".$row['nombre_comercial_cliente']."</option>";
		}
		echo $imp;
	}
?>
