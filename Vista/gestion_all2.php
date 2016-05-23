<?php
	
	include("../Controller/Conexion.php");
	require("../Modelo/ppto_general.php");
	require("../Modelo/unidades_negocio.php");
	require("../Modelo/departamento.php");
	require("../Modelo/cliente.php");
	require("../Modelo/asoccliemp.php");
	require("../Modelo/contactos_cliente.php");
	require("../Modelo/producto_cliente.php");
	require("../Modelo/empleado.php");
	require("../Modelo/permisos.php");
	require("../Modelo/Empresa.php");
	require("../Modelo/proveedor.php");
	require("../Modelo/asocproemp.php");
	require("../Modelo/gestion_cabecera.php");
	require("../Modelo/bancos.php");
	require("../Modelo/usuarios.php");
	require("../Modelo/financiera.php");
	session_start();
	$usuario = $_SESSION['codigo_usuario'];
	$fecha = date("Y-m-d h:i:s");
	$t = $_POST['t'];
	
	
	switch ($t){
		case 0:
			$ppto = new ppto_general();
			$ppto->grupos_sistema();
			break;
		case 1:
			$udn = new unidades_negocio();
			$udn->set_name($_POST['name']);
			$udn->set_empresa($_POST['emp']);
			$udn->insert_udn();
			$udn->tabla_unidades_de_negocio($udn->sql1($_POST['emp']));
			break;
		case 2:
			$udn = new unidades_negocio();
			$udn->set_name($_POST['name']);
			$udn->update_name_und($_POST['cod']);
			//$udn->tabla_unidades_de_negocio($udn->sql1($_POST['emp']));
			break;
		case 3:
			$udn = new unidades_negocio();
			$udn->tabla_unidades_de_negocio($udn->sql1($_POST['emp']));
			break;
		case 4:
			$udn = new unidades_negocio();
			echo $udn->select_unidades_negocio($_POST['emp']);
			break;
		case 5:
			$depto = new departamento();
			$depto->estructura_tabla($depto->mostrar_datos_und($_POST['emp'],$_POST['und']));
			break;
		case 6:
			$depto = new departamento();
			$depto->select_mostrar_datos_und($_POST['emp'],$_POST['und']);
			break;
			
		case 7:
			$udn = new unidades_negocio();
			$udn->empleado_x_unidad_negocio($_POST['emp'],$_POST['und']);
			break;
			
		case 8:
			$udn = new unidades_negocio();
			$udn->empleado_und($_POST['emp'],$_POST['und'],$_POST['periodo']);
			break;
		case 9:
			$udn =new unidades_negocio();
			$udn->listar_und($_POST['emp']);
			break;
		case 10:
			$ppto = new ppto_general();
			$ppto->set_item($_POST['id']);
			$ppto->set_mes($_POST['mes']);
			$ppto->set_valor($_POST['v']);
			$ppto->set_ppto($_POST['ppto']);
			$ppto->consulta_accion($_POST['id'],$_POST['mes'],$_POST['ppto']);
			$ppto->llenar_estructura($ppto->sql2_ppto($_POST['und'],$_POST['ppto']),$ppto->estructura(),$_POST['und'],$_POST['ppto']);
			break;
		case 11:
			$ppto = new ppto_general();
			$ppto->set_und($_POST['und']);
			$ppto->consulta_ppto($_POST['und']);
			break;
		case 12:
			$ppto = new ppto_general();
			$ppto->set_nombre_grupo($_POST['name']);
			$ppto->insert_grupo_x_unidad();
			break;
		case 13:
			$ppto = new ppto_general();
			$ppto->select_grupos_x_unidad($_POST['und']);
			break;
		case 14:
			$ppto = new ppto_general();
			$ppto->set_item2($_POST['name']);
			$ppto->set_valor2($_POST['valor']);
			$ppto->insert_valor_item($_POST['grupo']);
			break;
		case 15:
			$ppto = new ppto_general();
			$ppto->listar_item_x_grupo_und($_POST['grupo'],$_POST['und']);
			break;
		case 16:
			$ppto = new ppto_general();
			$ppto->unidades_negocio_pptos($_POST['emp']);
			break;
		case 17:
			$ppto = new ppto_general();
			$item = $_POST['items'];
			for($i = 0;$i < count($item);$i++){
				$ppto->insert_item_x_ppto($item[$i],$_POST['ppto']);
			}			
			break;
		case 18:
			$ppto = new ppto_general();
			$ppto->llenar_estructura($ppto->sql2_ppto($_POST['und'],$_POST['ppto']),$ppto->estructura(),$_POST['und'],$_POST['ppto']);
			break;
		case 19:
			$ppto = new ppto_general();
			$ppto->ano_ppto($_POST['und']);
			break;
		case 20:
			$clie = new cliente();
			$asoc = new asocliemp();
			$contac = new contactos_area_cliente();
			$clie->set_nit_cliente($_POST['nit']);
			$clie->set_nlegal_cliente($_POST['n_legal']);
			$clie->set_ncomercial_cliente($_POST['n_comercial']);
			$clie->set_telefono_cliente($_POST['tel']);
			$clie->set_direccion_cliente($_POST['direccion']);
			$clie->set_ciudad_cliente($_POST['n_ciudad_empresa']);
			$clie->set_depto_cliente($_POST['n_departamento_empresa']);
			$clie->set_pais_cliente($_POST['n_pais_empresa']);
			$clie->set_estado_cliente(1);
			$clie->set_ruta_carpeta_cliente("");
			$clie->insert_cliente($usuario,$fecha);
			$id = $clie->id_cliente($_POST['nit']);
			$clie->crear_cliente($id);
			
			//Sociedades:
			$emp = $_POST['check_empresa'];
			$iniciales = $_POST['iniciales'];
			for($i = 0; $i < count($emp);$i++){
				$asoc->set_iniciales_asocliemp($iniciales[$i]);
				$asoc->set_empresa_asocliemp($emp[$i]);
				$asoc->set_cliente_asocliemp($id);
				$asoc->insert_asocliemp($usuario,$fecha);
			}
			
			//Contactos
			/*$name = $_POST['c_name'];
			$cargo = $_POST['c_cargo'];
			$email = $_POST['c_mail'];
			$tele = $_POST['c_phone'];
			$celu = $_POST['c_cel'];
			$mes = $_POST['c_mes'];
			$dia = $_POST['c_dia'];
			for($i = 0; $i < count($name);$i++){
				$contac->set_ncontacto($name[$i]);
				$contac->set_correoc($email[$i]);
				$contac->set_cargo_contacto($cargo[$i]);
				$contac->set_telefono_contacto($tele[$i]);
				$contac->set_cliente_contacto($id);
				$contac->set_mes($mes[$i]);
				$contac->set_dia($dia[$i]);
				$contac->insert_contacto_cliente($usuario,$fecha,$celu[$i]);
			}*/
			
			echo "CLIENTE CREADO";
			break;
		Case 21:
			$clie = new cliente();
			
			$clie->mostrar_tabla_basica_clientes($clie->sql_todos_clientes($_POST['emp']));
			break;
		case 22:
			$clie = new cliente();
			$clie->estructura_tabla_info_completa_cliente($clie->sql_estructura_completa_info_cliente($_POST['id']));
			break;
		case 23:
			$clie = new cliente();
			$clie->mostrar_documentos_cliente($clie->sql_mostrar_documentos($_POST['emp'],$_POST['cliente']));
			break;
		case 24:
			$clie = new cliente();
			if($clie->comprar_documento_subido($_POST['cliente'],$_POST['doc']) == 0){
				$file = $_FILES['archivo0']['name'];
				$file2 = $_POST['name_archivo0'];
				$clie->set_nombre_archivo($file2);
				
				$clie->set_tipo_documento($_POST['doc']);
				$clie->insert_documentos_legales_cliente($_POST['cliente'],$usuario,$fecha);
				$c = $_POST['cliente'];
				move_uploaded_file($_FILES['archivo0']['tmp_name'],"../Process/CLIENTE/$c/DOCUMENTOS/$file2");
			}
			break;
		case 25:
			$clie = new cliente();
			$clie->listar_clientes_x_empresa($_POST['emp']);
			break;
		case 26:
			$clie = new cliente();
			if($clie->comprobar_contratos($_POST['cliente'],$_POST['emp']) == 0){
				$clie->set_numero_contrato($_POST['nombre_contrato_clie']);
				$file2 = $_POST['name_archivo0'];
				$file = $_FILES['archivo0']['name'];
				$c = $_POST['cliente'];
				$clie->set_nombre_archivo($file2);
				$clie->insert_contratos($_POST['valor'],$_POST['cliente'],$_POST['emp'],$_POST['fcontrato'],$_POST['ffirma'],$_POST['fterminacion'],$_POST['tipo_contrato']);
				move_uploaded_file($_FILES['archivo0']['tmp_name'],"../Process/CLIENTE/$c/CONTRATOS/$file2");
				echo "CONTRATO SUBIDO";
			}else{
				echo "YA SE HA SUBIDO UN CONTRATO PARA ESTE CLIENTE";
			}
			break;
		case 27:
			$clie = new cliente();
			$clie->mostrar_contratos_clientes($clie->sql_mostrar_contratos_clientes($_POST['emp']));
			break;
		case 28:
			$pro = new producto_cliente();
			$pro->set_nombre_procliente($_POST['name']);
			$pro->set_fee($_POST['fee']);
			$pro->set_cliente_procliente($_POST['cliente']);
			$pro->set_estado_producto_cliente(1);
			$pro->insert_procliente($usuario,$fecha);
			$pro->mostrar_producto_cliente_creado($pro->sql_productos_cliente($_POST['cliente']));
			break;
		case 29:
			$pro = new producto_cliente();
			$pro->mostrar_producto_cliente_creado($pro->sql_productos_cliente($_POST['cliente']));
			break;
		case 30:
			$pro = new producto_cliente();
			$pro->listar_productos_cliente($pro->sql_productos_cliente($_POST['cliente']));
			break;
		case 31:
			$clie = new cliente();
			$clie->set_valor_fee($_POST['valor']);
			$clie->insert_fee_cliente($_POST['cliente'],$_POST['producto']);
			$clie->mostrar_tabla_productos_cliente($clie->sql_fees_cliente($_POST['cliente']));
			break;
		case 32:
			$clie = new cliente();
			$clie->mostrar_tabla_productos_cliente($clie->sql_fees_cliente($_POST['cliente']));
			break;
		case 33:
			$depto = new departamento();
			$depto->select_mostrar_datos_und($_POST['emp'],$_POST['und']);
			break;
		case 34:
			$emp = new empleado();
			$emp->empleado_x_departamento($emp->sql_empleados_x_depto($_POST['depto'],$_POST['und'],$_POST['emp']));
			break;
		case 35:
			$clie = new cliente();
			$clie->muestra_asignado_cliente($clie->sql_asignado_cliente($_POST['clie'],$_POST['pro'],$_POST['emp']));
			break;
		case 36:
			$clie = new cliente();
			$clie->muestra_asignado_cliente($clie->sql_asignado_empleado($_POST['emp'],$_POST['emple']));
			break;
		case 37:
			$clie = new cliente();
			$clie->remover_cuenta_empleado($_POST['id']);
			break;
		case 38:
			$permisos = new permisos();
			$permisos->set_usuario($_POST['empleado']);
			$permisos->set_asignador($usuario);
			$permisos->set_cliente($_POST['clie']);
			//$permisos->set_producto($_POST['pro']);
			$permisos->set_empresa($_POST['emp']);
			$permisos->consulta_sino_cliente($_POST['empleado'],$_POST['clie'],$_POST['pro'],$_POST['emp'],$fecha);
			/*if($x == 1){
				$permisos->insertar_valores_grilla($_POST['empleado'],$_POST['emp'],$_POST['clie'],$_POST['pro'],$_POST['und'],$_POST['depto']);
				echo "Permisos Habilitados";
			}else{
				echo "Error !, Permiso ya habilitado";
			}*/
			break;
		case 39:
			$emp = new empleado();
			$emp->empleado_x_departamento_id($emp->sql_empleados_x_depto_id($_POST['depto'],$_POST['und'],$_POST['emp']));
			break;
		case 40:
			$clie = new cliente();
			$clie->ejecutivo_asignado_cuenta($_POST['clie'],$_POST['pro'],$_POST['emp'],1);
			break;
		case 41:
			$clie = new cliente();
			$clie->mostrar_grilla($clie->sql_departamentos_grilla($clie->grilla($_POST['clie'],$_POST['pro'],$_POST['emp'])),$clie->grilla($_POST['clie'],$_POST['pro'],$_POST['emp']));
			break;
		case 42:
			$emp = new empleado();
			$emp->listar_empleados_departamento_cobro_cliente($_POST['depto'],$_POST['und'],$_POST['emp']);
			break;
		case 43:
			$emp = new empresa();
			$emp->estructura_empresa($emp->info_basica_empresa($_POST['emp']),$emp->info_basica_empresa_ubicacion($_POST['emp']));
			break;
		case 44:
			$ppto = new ppto_general();
			$ppto->listar_grupos();
			break;
		case 45:
			$ppto = new ppto_general();
			$ppto->set_item2($_POST['name']);
			$ppto->set_valor2($_POST['valor']);
			$ppto->insert_valor_item($_POST['grupo']);
			$ppto->insert_item_x_ppto($ppto->consultar_ultimo_item(),$_POST['ppto']);
			$ppto->llenar_estructura($ppto->sql2_ppto($_POST['und'],$_POST['ppto']),$ppto->estructura(),$_POST['und']);
			break;
		case 46:
			$clie = new cliente();
			$clie->listar_contactos_x_cliente($_POST['clie']);
			break;
		case 47:
			$contac = new contactos_area_cliente();
			$contac->set_ncontacto($_POST['name']);
			$contac->set_correoc($_POST['email']);
			$contac->set_cargo_contacto($_POST['cargo']);
			$contac->set_telefono_contacto($_POST['phone']);
			$contac->set_cliente_contacto($_POST['clie']);
			$contac->set_mes($_POST['mes']);
			$contac->set_dia($_POST['dia']);
			$contac->insert_contacto_cliente($usuario,$fecha,$_POST['celular']);
			break;
		case 48:
			$emp = new empleado();
			$emp->listar_empleados_sin_usuario($_POST['emp']);
			break;
		case 49:
			$prov = new proveedor();
			$prov->estructura_info_proveedores($prov->sql_consulta_info_proveedor($_POST['emp']));
			break;
		case 50:
			$prov = new proveedor();
			$prov->listar_documentos_proveedores($prov->sql_documentos_proveedores($_POST['prov']));
			break;
		case 51:
			$prov = new proveedor();
			$val = $prov->consultar_si_documento($_POST['doc'],$_POST['prov']);
			$file = $_FILES['archivo0']['name'];
			$file2 = $_POST['name_archivo0'];
			$pro = $_POST['prov'];
			if($val == 1){
				$prov->modificar_documento_proveedor($_POST['doc'],$_POST['prov'],$file2,$usuario,$fecha);
				move_uploaded_file($_FILES['archivo0']['tmp_name'],"../Process/PROVEEDOR/$pro/DOCUMENTOS/".$file2);
			}else{
				$prov->insertar_nuevo_documento($_POST['doc'],$_POST['prov'],$file2,$usuario,$fecha);
				move_uploaded_file($_FILES['archivo0']['tmp_name'],"../Process/PROVEEDOR/$pro/DOCUMENTOS/".$file2);
			}
			$prov->listar_documentos_proveedores($prov->sql_documentos_proveedores($_POST['prov']));
			break;
		case 52:
			$prov = new proveedor();
			$estado = 1;
			$prov->set_estado_proveedor($estado);
			$prov->set_nit_proveedor($_POST['nit']);
			$prov->set_ncomercial_proveedor($_POST['ncomercial']);
			$prov->set_nlegal_proveedor($_POST['nlegal']);
			$prov->set_direccion_proveedor($_POST['direccion']);
			$prov->set_correo_proveedor($_POST['correo']);
			$prov->set_telefono_proveedor($_POST['telefono']);
			$prov->set_ciudad_proveedor($_POST['ciudad']);
			$prov->set_depto_proveedor($_POST['depto']);
			$prov->set_pais_proveedor($_POST['pais']);
			$prov->set_usuario_proveedor($usuario);
			$prov->set_fecha_registro_proveedor($fecha);
			$prov->insert_proveedor();
			$nit = $_POST['nit'];
			$consulta = "select codigo_interno_proveedor from proveedores where nit_proveedor ='$nit'";
			$result = mysql_query($consulta);
			$prov->crear_carpeta_proveedor();
			$prov->mostrar_tabla_nuevo_proveedor($_POST['nit']);
			$asoc = new asociacion_proveedor_empresa();
			
			$asociaciones = $_POST['e_asoc'];
			$id_prov = "";
			while($row = mysql_fetch_array($result)){
				$id_prov = $row['codigo_interno_proveedor'];
			}
			
			for($i = 0;$i < count($asociaciones);$i++){
				//echo $asociaciones[$i]."--</br>";
				$asoc->set_fecha_asociacion_asocproemp($fecha);
				//$asoc->set_empresa_asocproemp($asociaciones[$i]);
				$asoc->set_proveedor_asocproemp($id_prov);
				$asoc->insert_asocproemp($usuario,$asociaciones[$i]);
			}
			break;
		case 53:
			$prov = new proveedor();
			$prov->modificar_estado_proveedor($prov->consultar_estado($_POST['id']),$_POST['id']);
			$prov->listar_documentos_proveedores($prov->sql_documentos_proveedores($_POST['prov']));
			break;
		case 54:
			$prov = new proveedor();
			$prov->listar_proveedores($_POST['emp']);
			break;
		case 55:
			$prov = new proveedor();
			$prov->insertar_contactos_proveedor($_POST['name'],$_POST['cargo'],$_POST['phone'],$_POST['correo'],$_POST['cel'],$_POST['mes'],$_POST['dia'],$_POST['pro']);
			$prov->mostrar_contactos_proveedor($prov->sql_listar_contactos($_POST['pro']));
			break;
		case 56:
			$prov = new proveedor();
			$prov->mostrar_contactos_proveedor($prov->sql_listar_contactos($_POST['pro']));
			break;
		case 57:
			$prov = new proveedor();
			$prov->insert_acuerdo_confidencialidad_proveedor($_FILES['archivo0']['name'],$_POST['prov'],$_POST['ffirma'],$_POST['fterminacion']);
			move_uploaded_file($_FILES['archivo0']['tmp_name'],"../Process/PROVEEDOR/$pro/DOCUMENTOS/".$_FILES['archivo0']["name"]);
			break;
		case 58:
			$udn = new unidades_negocio();
			ECHO $udn->select_unidades_negocio($_POST['emp']);
			break;
		case 59:
			$emp = new empleado();
			$emp->consultar_datos_empleado_und($_POST['emp'],$_POST['und']);
			break;
		case 60:
			$emp = new empleado();
			$emp->consultar_datos_empleado_und_depto($_POST['emp'],$_POST['und'],$_POST['depto']);
			break;
		case 61:
			$prov = new proveedor();
			$prov->guardar_grupo($_POST['grupo'],$usuario,$fecha);
			break;
		case 62:
			$prov = new proveedor();
			$prov->listar_grupos();
			break;
		case 63:
			$prov = new proveedor();
			$prov->guardar_item(strtoupper($_POST['nombre_item_tarifario']),$_POST['iva_item_tarifario'],$_POST['tarifa_item_tarifario'],$_POST['vol_tarifa_item_ppto'],$_POST['listado_subgrupos_grupos_tarifario'],$_POST['listado_grupos_item_tarifario'],$_POST['adicional_item_tarifario']);
			break;
		case 64:
			$gestion = new cabecera_pagina();
			$gestion->mostrar_datos_por_empresa_documentos($_POST['emp']);
			break;
		case 65:
			$empresa = new empresa();
			$empresa->editar_empresa($empresa->info_basica_empresa($_POST['emp']),$empresa->info_basica_empresa_ubicacion($_POST['emp']));
			break;
		case 66:
			$banco = new banco();
			$banco->set_empresa($_POST['emp']);
			$banco->set_comercial($_POST['ncomercial_banco']);
			$banco->set_direccion($_POST['direccion']);
			$banco->set_legal($_POST['nsocial_banco']);
			$banco->set_telefono($_POST['phone']);
			$banco->set_nit($_POST['nnit_banco']);
			$banco->set_pagina($_POST['pagina']);
			$banco->set_correo($_POST['correo']);
			$banco->set_pais($_POST['n_pais_empresa']);
			$banco->set_departamento($_POST['n_departamento_empresa']);
			$banco->set_ciudad($_POST['n_ciudad_empresa']);
			$file = $_FILES['logo0']['name'];
			$file2 = $_FILES['bienve0']['name'];
			$banco->set_logo($file);
			$id = $banco->consultar_id()+1;
			//echo $id;
			//$banco->asociar_banco_empresas($fecha,$usuario,$_POST['empre'],$id);
			$banco->insert_banco($fecha,$usuario,$file2);
			$banco->crear_carpeta_banco();
			//$id = $banco->consultar_id();
			$ruta = "../Process/BANCO/$id/".$banco->get_logo();
			//$ruta2 = "../Process/BANCO/$id/x".$file2;
			move_uploaded_file($_FILES['logo0']['tmp_name'],"../Process/BANCO/$id/$file");
			move_uploaded_file($_FILES['bienve0']['tmp_name'],"../Process/BANCO/$id/$file2");
			rename("../Process/BANCO/$id/$file",$ruta);
			//rename("../Process/BANCO/$id/$file2",$file2);
			break;
		case 67:
			$banco = new banco();
			$banco->info_basica_banco($banco->sql_info_basica($_POST['b']));
			break;
		case 68:
			$file = $_FILES['empleado_foto0']['name'];
			move_uploaded_file($_FILES['empleado_foto0']['tmp_name'],"../Process/temp/$file");
			echo "<img src = '../Process/temp/$file' width = '200px' height = '200px'/>";
			break;
		case 69:
			$emp = new empleado();
			$emp->consultar_name_empleado($_POST['name'],$_POST['emp']);
			break;
		case 70:
			$und = new unidades_negocio();
			$emp = new empleado();
			$emp->menu_hojas_de_vida();
			break;
		case 71:
			$und = new unidades_negocio();
			$emp = new empleado();
			$emp->menu_nomina_detallado($_POST['emp'],$und->listar_und2($_POST['emp']),$_POST['alto']);
			break;
		case 72:
			$und = new unidades_negocio();
			$emp = new empleado();
			$emp->menu_personal_donw($_POST['emp'],$und->listar_und2($_POST['emp']),$_POST['alto']);
			break;
		case 73:
			$empresa = new empresa();
			$empresa->insert_representantes($_POST['name'],$_POST['emp']);
			echo $empresa->listar_representantes($_POST['emp']);
			break;
		case 74:
			$empresa = new empresa();
			$empresa->update_nombre_representantes($_POST['id'],$_POST['name']);
			echo $empresa->listar_representantes($_POST['emp']);
			break;
		case 75:
			$empresa = new empresa();
			$empresa->update_estado_representantes($_POST['id'],$_POST['estado']);
			echo $empresa->listar_representantes($_POST['emp']);
			break;
		case 76:
			$empresa = new empresa();
			$empresa->insert_correos($_POST['name'],$_POST['emp']);
			echo $empresa->listar_correos($_POST['emp']);
			break;
		case 77:
			$empresa = new empresa();
			$empresa->update_nombre_correo($_POST['id'],$_POST['name']);
			echo $empresa->listar_correos($_POST['emp']);
			break;
		case 78:
			$empresa = new empresa();
			$empresa->update_estado_correo($_POST['id'],$_POST['estado']);
			echo $empresa->listar_correos($_POST['emp']);
			break;
		case 79:
			$empresa = new empresa();
			$empresa->insert_telefono($_POST['name'],$_POST['emp']);
			echo $empresa->listar_telefonos($_POST['emp']);
			break;
		case 80:
			$empresa = new empresa();
			$empresa->update_nombre_telefono($_POST['id'],$_POST['name']);
			echo $empresa->listar_telefonos($_POST['emp']);
			break;
		case 81:
			$empresa = new empresa();
			$empresa->update_estado_telefono($_POST['id'],$_POST['estado']);
			echo $empresa->listar_telefonos($_POST['emp']);
			break;
		case 82:
			$gestion = new cabecera_pagina();
			if($_POST['tipo'] == 0){
				$gestion->mostrar_datos_por_empresa_documentos($_POST['emp']);
			}else{
				$gestion->historico_documentos($_POST['tipo'],$_POST['emp']);
			}
			break;
		case 83:
			$empleado = new empleado();
			echo $empleado->crear_nomina_mes($_POST['emp']);
			break;
		case 84:
			$und = new unidades_negocio();
			$empleado = new empleado();
			echo $empleado->consultar_nomina_por_periodos($_POST['emp'],$und->listar_und2($_POST['emp']));
			break;
		//Simulador:
		case 85:
			$emp = new empleado();
			$emp->simulador_hoja_vida_nuevo_empleado($emp->insert_nombre_simulador($_POST['name'],$usuario,$fecha,$_POST['modalidad'],$_POST['sal'],$_POST['emp']),$_POST['emp']);
			break;
		case 86:
			$emp = new empleado();
			$emp->insert_bono_sim($_POST['id'],$_POST['val']);
			$emp->simulador_hoja_vida_nuevo_empleado($_POST['id'],$_POST['emp']);
			break;
		case 87:
			$emp = new empleado();
			$emp->mostrar_simulados($emp->sql_consulta_simulados($_POST['emp']));
			break;
		case 88:
			$emp = new empleado();
			$emp->mostrar_simulados($emp->sql_consulta_simulados_name($_POST['emp'],$_POST['name']));
			break;
		case 89:
			$und = new unidades_negocio();
			$emp = new empleado();
			$emp->consutar_nomina_detallado($und->listar_und2($_POST['emp']));
			break;
		case 90:
			$emp = new empleado();
			$emp->trasladar_nomina($_POST['emp'],$usuario);
			break;
		case 91:
			$und = new unidades_negocio();
			$emp = new empleado();
			$emp->menu_personal_down_ind($und->listar_und2($_POST['emp']));
			break;
		case 92:
			$clie = new cliente();
			$clie->update_estado_cliente($_POST['id'],$_POST['est'],$_POST['emp']);
			break;
		case 93:
			$emp = new empleado();
			$emp->modiciar_bonos_empleado($_POST['id'],$_POST['val'],$_POST['empleado'],$_POST['periodo'],$_POST['empresa']);
			break;
		case 94:
			$udn =new unidades_negocio();
			$ppto = new ppto_general();
			$ppto->menu_administrar_pptos_general($udn->select_unidades_negocio($_POST['emp']),$ppto->listar_all_grupos_ppto_general(),$_POST['emp']);
			break;
		case 95:
			$ppto = new ppto_general();
			$ppto->listar_items_name($_POST['name']);
			break;
		case 96:
			$ppto = new ppto_general();
			$ppto->insert_meta_mensual($_POST['id'],$_POST['meta']);
			break;
		case 97:
			$emp =  new empleado();
			$emp->simulador_hoja_vida_nuevo_empleado($_POST['id'],$_POST['emp']);
			break;
		case 98:
			$emp =  new empleado();
			$emp->insert_novedades_empleado($_POST['doc'],$_POST['fi'],$_POST['ff'],$_POST['tipo'],$usuario,$fecha);
			break;
		case 99:
			$emp =  new empleado();
			$emp->estructura_parametrizacion_salario_minimo($_POST['emp']);
			break;
		case 100:
			$emp =  new empleado();
			$emp->registro_salario_minimo($_POST['emp'],$_POST['val']);
			break;
		case 101:
			$emp =  new empleado();
			$emp->estructura_parametrizacion_salario_integral($_POST['emp']);
			break;
		case 102:
			$emp =  new empleado();
			$emp->registro_salario_integral($_POST['emp'],$_POST['val']);
			break;
		case 103:
			$emp =  new empleado();
			$emp->estructura_parametrizacion_aux_transporte($_POST['emp']);
			break;
		case 104:
			$emp =  new empleado();
			$emp->registro_aux_transporte($_POST['emp'],$_POST['val']);
			break;
		case 105:
			$emp =  new empleado();
			$emp->estructura_parametrizacion_mon_sena($_POST['emp']);
			break;
		case 106:
			$emp =  new empleado();
			$emp->registro_monetizacion_sena($_POST['emp'],$_POST['val'],$_POST['rel'],$usuario,$fecha);
			break;
		case 107:
			$udn =new unidades_negocio();
			$ppto = new ppto_general();
			$ppto->menu_ppto_general($udn->select_unidades_negocio($_POST['emp']),$_POST['emp'],$_POST['alto']);
			break;
		case 108:
			$udn =new unidades_negocio();
			$udn->menu_administrar_unidades_negocio($_POST['emp'],$udn->tabla_listar_und_empresa($_POST['emp']));
			break;
		case 109:
			$udn =new unidades_negocio();
			echo $udn->tabla_listar_und_empresa($_POST['emp']);
			break;
		case 110:
			$depto = new departamento();
			$listado_und = $depto->listar_option_und(($_POST['emp']));
			$sql = $depto->sql_normal_deptos($_POST['emp']);
			$depto->menu_administrar_departamentos($_POST['emp'],$listado_und,$depto->nueva_estructura_areas_empresa($sql));
			break;
		case 111:
			$depto = new departamento();
			$sql = $depto->sql_und_deptos($_POST['und'],$_POST['emp']);
			echo $depto->nueva_estructura_areas_empresa($sql);
			break;
		case 112:
			$depto = new departamento();
			$depto->modificar_estado($_POST['id'],$_POST['est']);
			echo $depto->nueva_estructura_areas_empresa($depto->sql_und_deptos($_POST['und'],$_POST['emp']));
			break;
		Case 113:
			$clie = new cliente();
			$clie->mostrar_tabla_basica_clientes($clie->sql_clientes_nit($_POST['id'],$_POST['emp']));
			break;
		Case 114:
			$clie = new cliente();
			$clie->mostrar_tabla_basica_clientes($clie->sql_clientes_comercial($_POST['id'],$_POST['emp']));
			break;
		Case 115:
			$emp = new empleado();
			$emp->consultar_empleado_estado($_POST['estado'],$_POST['emp']);
			break;
		Case 116:
			$g = new cabecera_pagina();
			echo $g->listar_festivos_calendario();
			break;
		case 117:
			$clie  =  new cliente();
			$empre = new Empresa();
			$clie->ver_informacion_cliente($_POST['id'],$empre,$_POST['emp']);
			break;
		case 118:
			$clie  =  new cliente();
			$empresa = new empresa();
			$clie->editar_info_basica_cliente($_POST['id'],$clie->info_basica_cliente_ubicacion($_POST['id']),$empresa,$_POST['emp']);
			break;
		case 119:
			$clie  =  new cliente();
			$datos = array($_POST['nombre_c'],$_POST['cargo_c'],$_POST['correo_c'],$_POST['telefono_c'],$_POST['celular_c']);
			$clie->update_contacto_cliente($_POST['id'],$datos);
			break;
		case 120:
			$pro = new producto_cliente();
			$pro->set_estado_producto_cliente($_POST['estado']);
			$pro->update_procliente($_POST['id'],$fecha,$usuario);
			break;
		case 121:
			$pro = new producto_cliente();
			$pro->update_name_procliente($_POST['id'],$fecha,$usuario,$_POST['nombre']);
			break;
		case 122:
			$pro  =  new proveedor();
			$datos = array($_POST['nombre_c'],$_POST['cargo_c'],$_POST['telefono_c'],$_POST['correo_c'],$_POST['celular_c']);
			$pro->update_contacto_proveedor($_POST['id'],$datos);
			break;
		case 123:
			$pro = new proveedor();
			$pro->guardar_subgrupo($_POST['name'],$_POST['grupo'],$usuario,$fecha);
			break;
		case 124:
			$pro = new proveedor();
			$pro->listar_subgrupos($_POST['grupo']);
			break;
		case 125:
			$banco = new banco();
			$banco->editar_banco_gestion($_POST['id'],$banco->info_basica_banco_ubicacion($_POST['id']),$banco->sql_info_basica($_POST['id']));
			break;
		case 126:
			$banco = new banco();
			$banco->listar_contactos($banco->sql_contactos($_POST['banco']));
			break;
		case 127:
			$banco = new banco();
			$banco->insert_contacto($_POST['name'],$_POST['n_cargo'],$_POST['n_correo'],$_POST['n_telefono'],$_POST['n_celular'],$_POST['mes_contacto'],$_POST['n_dia'],$_POST['banco']);
			break;
		case 128:
			$pptado = new ppto_general();
			$pptado->update_valor_mes_pptado($_POST['id'],$_POST['valor']);
			$pptado->llenar_estructura($pptado->sql2_ppto($_POST['und'],$_POST['ppto']),$pptado->estructura(),$_POST['und'],$_POST['ppto']);
			break;
		case 129:
			$und = new unidades_negocio();
			$und->nombre_und($_POST['und']);
			break;
		case 130:
			$emp = new empresa();
			$emp->nota_ordenes_ppto($_POST['emp']);
			break;
		case 131:
			$emp = new empresa();
			$emp->update_nota_ppto($_POST['text'],$_POST['emp']);
			break;
		case 132:
			$emp = new empresa();
			$emp->update_nota_op($_POST['text'],$_POST['emp']);
			break;
		case 133:
			$emp = new empresa();
			$emp->update_nota_oc($_POST['text'],$_POST['emp']);
			break;
		case 134:
			$usu = new usuario();
			$usu->menu_usuarios($_POST['emp']);
			break;
		case 135:
			$usu = new usuario();
			$usu->update_estado_usuario($_POST['id'],$_POST['est']);
			break;
		case 136:
			$usu = new usuario();
			$usu->update_contrasena($_POST['id']);
			echo "CONTRASEÑA BORRADA";
			break;
		case 137:
			$clie =  new Cliente();
			//Condiciones de Pago
			$clie->set_pago($_POST['dias']);
			//$clie->set_impuestos($_POST['impuesto']);
			$clie->set_rte_fuente($_POST['rfuente']);
			$clie->set_uaai($_POST['val_comision']);
			$clie->set_tipo_comision($_POST['comision']);
			$clie->set_cierre($_POST['fact']);
			$clie->set_tercero($_POST['ter']);
			$clie->insert_condiciones($_POST['cliente'],$_POST['riva'],$_POST['regimen'],$_POST['auto']);
			break;
		case 138:
			$clie =  new Cliente();
			$clie->negociaciones_cliente($_POST['cliente']);
			break;
		case 139:
			$clie =  new Cliente();
			$clie->mostrar_contratos_clientes($clie->sql_mostrar_contratos_clientes_c($_POST['cliente'],$_POST['emp']));
			break;
		case 140:
			$clie = new Cliente();
			echo $clie->validar_nit($_POST['nit']);
			break;
		case 141:
			$prov = new proveedor();
			$prov->estructura_info_proveedores($prov->sql_consulta_info_proveedor_nombre($_POST['emp'],$_POST['text']));
			break;
		case 142:
			$prov = new proveedor();
			$prov->estructura_info_proveedores($prov->sql_consulta_info_proveedor_nit($_POST['emp'],$_POST['text']));
			break;
		case 143:
			$prov = new proveedor();
			$empresa = new empresa();
			$prov->mostrar_info_proveedor_detalle($_POST['id'],$_POST['emp'],$prov->info_basica_proveedor_ubicacion($_POST['id']),$empresa);
			break;
		case 144:
			$prov = new proveedor();
			$empresa = new empresa();
			$prov->editar_info_proveedor($_POST['id'],$_POST['emp'],$prov->info_basica_proveedor_ubicacion($_POST['id']),$empresa);
			break;
		case 145:
			$prov = new proveedor();
			//$prov->editar_info_proveedor($_POST['id'],$_POST['emp'],$prov->info_basica_proveedor_ubicacion($_POST['id']));
			echo $_POST['n_nlegal_proveedore'];
			break;
		case 146:
			$banco = new banco();
			$banco->set_comercial($_POST['be_name_comerciale']);
			$banco->set_direccion($_POST['be_direccione']);
			$banco->set_legal($_POST['be_r_sociale']);
			$banco->set_telefono($_POST['telefono_bee']);
			$banco->set_nit($_POST['be_nit_bancoe']);
			$banco->set_pagina($_POST['be_pagina_webe']);
			$banco->set_correo($_POST['be_correoe']);
			$banco->set_pais($_POST['n_pais_empresa']);
			$banco->set_departamento($_POST['n_depto_empresa']);
			$banco->set_ciudad($_POST['n_ciudad_empresa']);
			$banco->update_banco($fecha,$usuario);
			echo $_POST['be_name_comerciale'];
			break;
		case 147:
			$usu = new usuario();
			echo $usu->buscar_n_usuario($_POST['name']);
			break;
		case 148:
			$usu = new usuario();
			echo $usu->responsables_deptos($_POST['emp']);
			break;
		case 149:
			$usu = new usuario();
			$usu->insert_responsables_deptos($_POST['usuario'],$_POST['depto'],$fecha);
			break;
		case 150:
			$usu = new usuario();
			$usu->eliminar_responsable($_POST['id']);
			break;
		case 151:
			$usu = new usuario();
			echo $usu->asignados_usuarios($_POST['emp']);
			break;
		case 152:
			$usu = new usuario();
			echo $usu->asignados_por_usuario($_POST['usuario']);
			break;
		case 153:
			$usu = new usuario();
			$usu->elimininar_asignado_usuario($_POST['id']);
			break;
		case 154:
			$usu = new usuario();
			echo $usu->buscar_usuarios_por_depto($_POST['depto'],$_POST['usu']);
			break;
		case 155:
			$usu = new usuario();
			$usu->insert_asignado($_POST['emp'],$_POST['depto'],$_POST['usu'],$_POST['asig'],$fecha);
			break;
		case 156:
			$usu = new usuario();
			echo $usu->permisos_clientes_producto($_POST['emp']);
			break;
		case 157:
			$usu = new usuario();
			echo $usu->list_productos_cliente($_POST['cliente'],$_POST['usuario'],$_POST['emp']);
			break;
		case 158:
			$usu = new usuario();
			echo $usu->menu_permisos_empresa($_POST['emp']);
			break;
		case 159:
			$usu = new usuario();
			$usu->insert_permisos_empresa($_POST['empleado'],$_POST['emp'],$fecha,$usuario);
			break;
		case 160:
			$usu = new usuario();
			echo $usu->directores_departamentos($_POST['emp']);
			break;
		case 161:
			$usu = new usuario();
			$usu->insert_director_empleado($_POST['empleado'],$_POST['director'],$fecha,$usuario);
			break;
		case 162:
			$banco = new banco();
			$banco->set_nit($_POST['nnit_banco']);
			$id = $banco->consultar_id();
			$empresas = $_POST['e_asoc'];
			$banco->asociar_banco_empresas($fecha,$usuario,$empresas,$id);
			
			echo "BANCO CREADO";
			break;
		case 163:
			$banco = new banco();
			$id = $_POST['id'];
			$banco->update_contacto_banco($_POST[$id.'name0'],$_POST[$id.'name1'],$_POST[$id.'name2'],$_POST[$id.'name3'],$_POST[$id.'name4'],$_POST[$id.'name5'],$_POST[$id.'name6'],$id);
			echo "CONTACTO MODIFICADO";
			break;
		case 164:
			$emp = new Empresa();
			$emp->valor_minimo_utilidad_ppto($_POST['emp']);
			break;
		case 165:
			$emp = new Empresa();
			$emp->insert_nuevo_porcentaje_ppto($_POST['val'],$_POST['emp']);
			break;
		case 166:
			$emp = new empleado();
			$emp->eliminar_prospecto($_POST['id']);
			break;
		case 167:
			$emp = new empresa();
			$emp->insert_bp($_POST['emp']);
			break;
		case 168:
			$emp = new empresa();
			$resp = $emp->validad_bp($_POST['und']);
			if($resp == true){
				$emp->guardar_bp($_POST['und']);
				$id = $emp->consultar_id_bp($_POST['und']);
				$mes = $_POST['meses'];
				for($i = 0;$i < 12;$i++){
					$emp->guardar_bp_meses($id,$mes[$i],$i+1,$_POST['cliente']);
				}
			}else{
				$id = $emp->consultar_id_bp($_POST['und']);
				$mes = $_POST['meses'];
				for($i = 0;$i < 12;$i++){
					$emp->guardar_bp_meses($id,$mes[$i],$i+1,$_POST['cliente']);
				}
			}
			$emp->insert_bp($_POST['emp']);
			break;
		case 169:
			$emp = new empresa();
			$emp->bp_grilla($_POST['und'],$_POST['year'],$_POST['cliente']);
			break;
		case 170:
			$banc = new banco();
			$banc->insert_producto_banco($_POST['emp'],$_POST['banco'],$_POST['und'],$_POST['tipo'],$_POST['num']);
			break;
		case 171:
			$banc = new banco();
			$banc->productos_und($_POST['und']);
			break;
		case 172:
			$banc = new banco();
			$p = $_POST['pro'];
			$pro = explode(".",$p);
			if($pro[1] == 3){
				
			}else{
				echo $banc->estructura_cc_ca($pro[0]);
			}
			break;
		case 173:
			$banc = new banco();
			$banc->insert_valores_nuevos($_POST['id'],$_POST['val'],$_POST['text'],$_POST['num'],$usuario,$fecha);
			break;
		case 174:
			$banc = new banco();
			$banc->update_item_pago($_POST['id']);
			break;
		case 175:
			$banc = new banco();
			$banc->update_saldos_bancos($_POST['id'],$_POST['iva'],$_POST['h_reteiva_saldo_banco'],$_POST['h_ica_saldo_banco'],$_POST['h_reteica_saldo_banco'],$_POST['h_refuente_saldo_banco'],$_POST['h_cree_saldo_banco'],$_POST['h_saldo_saldo_banco'],$_POST['h_canjes_saldo_banco']);
			break;
		case 176:
			$banc = new banco();
			$banc->eliminar_registro($_POST['id']);
			break;
		case 177:
			$ppto = new ppto_general();
			$ppto->eliminar_info_cuadro($_POST['id'],$_POST['ppto']);
			break;
		case 178:
			$emple = new empleado();
			$fin = new financiera();
			$banc = new banco();
			$fin->estructura_financierta($_POST['und'],$_POST['emp'],$emple,$banc);
			break;
		case 179:
			$file = $_FILES['empleado_foto0']['name'];
			move_uploaded_file($_FILES['empleado_foto0']['tmp_name'],"../Process/temp/$file");
			echo "<img src = '../Process/temp/$file' height = '400px'/>";
	}
	
?>