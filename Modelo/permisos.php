<?php
	class permisos{
		
		public $usuario; //Sirve para todos los permisos.
		public $asignador;
		public $pk_empresa;
		public $pk_depto;
		public $responsable;
		public $pk_cliente;
		public $pk_producto_cliente;
		public $director;
		public $rol;
		public $admin_total = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40);
		public $admin_trafico= array(1,2,3,4,26,27,28,29,30,31,32,33,34,35,37,38,39,40);
		public $dir_eje = array(2,4,26,27,28,29,30,31,32,33,34,35,38,39,40);
		public $ejecutivo = array(2,3,26,27,28,29,30,31,32,33,34,35);		
		public $dir_creativo = array(2,4,26,27,28,29,30,31,32,33,38,39,40);
		public $creativo = array(2,26,32,33);
		public $productor = array(2,3,26,28,29,30,31,32,34,35);
		public $contabilidad = array(1,2,3,4,6,7,8,9,10,11,13,14,16,17,18,19,20,21,22,23,24,25,26,27,28,32,33,34,35,36,37);
		public $recep_fact = array(2,3,26,32,36);
		public $compras = array(1,2,3,9,19,20,21,26,28,32,33,34,35,36,37);
		public $admin_personal = array(1,2,4,7,12,13,14,26,27,28,32,33,34,35,38,39,40);
		public $fac_teso = array(2,3,26,32,36,37);
		
		
		public function get_rol(){
			return $this->rol;
		}
		public function set_rol($r){
			$this->rol = $r;
		}
		
		public function get_director(){
			return $this->director;
		}
		public function set_director($direc){
			$this->director = $direc;
		}
		
		public function get_departamento(){
			return $this->pk_depto;
		}
		public function set_departamento($depto){
			$this->pk_depto = $depto;
		}
		
		public function get_responsable(){
			return $this->responsable;
		}
		public function set_responsable($respon){
			$this->responsable = $respon;
		}
		
		public function get_usuario(){
			return $this->usuario;
		}
		public function set_usuario($usu){
			$this->usuario = $usu;
		}
		
		public function get_asignador(){
			return $this->asignador;
		}
		public function set_asignador($asig){
			$this->asignador = $asig;
		}
		
		public function get_empresa(){
			return $this->pk_empresa;
		}
		public function set_empresa($emp){
			$this->pk_empresa = $emp;
		}
		
		public function get_cliente(){
			return $this->pk_cliente;
		}
		public function set_cliente($clie){
			$this->pk_cliente = $clie;
		}
		
		public function get_producto(){
			return $this->pk_producto_cliente;
		}
		public function set_producto($producto){
			$this->pk_producto_cliente = $producto;
		}
		
		public function consulta_sino_rol($usu){
			$select = "select consecutivo from asigsur where usuario = '$usu'";
			$result = mysql_query($select);
			$i = 0;
			while($row = mysql_fetch_array($result)){
				$i++;
			}
			return $i;
		}
		
		public function consulta_sino_empresa($id,$emp){
			$select = "select consecutivo from pusuemp where cod_usuario = '$id' and cod_empresa = '$emp'";
			$result = mysql_query($select);
			$i = 0;
			while($row = mysql_fetch_array($result)){
				$i++;
			}
			return $i;
		}
		
		public function insert_permisos_cliente_producto($fecha, $i,$producto){
			if($i == 0){
				$insert = "insert into pcliepro(cod_usuario,cod_cliente,cod_producto,fecha,asignador,pk_empresa) 
				values('".$this->get_usuario()."','".$this->get_cliente()."','".$producto."','".$fecha."','".$this->get_asignador()."','".$this->get_empresa()."')";
				$result = mysql_query($insert);
			}			
		}
		
		public function consulta_sino_cliente($id,$clie,$pclie,$emp,$fecha){
			for($i = 0; $i < count($pclie);$i++){
				$select = "select consecutivo from pcliepro where cod_usuario = '$id' and cod_cliente = '$clie' and cod_producto = '$pclie[$i]' and pk_empresa = '$emp'";
				$result = mysql_query($select);
				$xx = 0;
				while($row = mysql_fetch_array($result)){
					$xx++;
				}
				$this->insert_permisos_cliente_producto($fecha,$xx,$pclie[$i]);
			}
			
			return $i;
		}
		
		public function consulta_sino_depto($id,$depto,$emp){
			$select = "select consecutivo from pdepto where usuario = '$id' and pk_depto = '$depto' and pk_empresa = '$emp'";
			$result = mysql_query($select);
			$i = 0;
			while($row = mysql_fetch_array($result)){
				$i++;
			}
			return $i;
		}
		
		public function consulta_sino_responsable($id,$depto,$emp,$respon){
			$select = "select consecutivo from prespon where usuario = '$id' and pk_depto = '$depto' and pk_empresa = '$emp' and responsable = '$respon'";
			$result = mysql_query($select);
			$i = 0;
			while($row = mysql_fetch_array($result)){
				$i++;
			}
			return $i;
		}
		
		public function consulta_sino_asignado($id,$depto,$emp,$respon){
			$select = "select consecutivo from pasig where usuario = '$id' and pk_depto = '$depto' and pk_empresa = '$emp' and responsable = '$respon'";
			$result = mysql_query($select);
			$i = 0;
			while($row = mysql_fetch_array($result)){
				$i++;
			}
			return $i;
		}
		
		public function insert_permisos_asignado($fecha,$i){
			if($i == 0){
				$insert = "insert into pasig(usuario,pk_depto,fecha,pk_empresa,asignado,responsable) 
				values('".$this->get_usuario()."','".$this->get_departamento()."','".$fecha."','".$this->get_empresa()."','".$this->get_asignador()."','".$this->get_responsable()."')";
				$result = mysql_query($insert);
				return 1;
			}else{
				return 2;
			}
		}
		
		public function insertar_valores_grilla($asig,$emp,$clie,$pro,$und,$depto){
			$s = mysql_query("select consecutivo from pcliepro where
			cod_usuario = '$asig' and pk_empresa = '$emp' and cod_cliente = '$clie' and cod_producto = '$pro'");
			$x = "";
			while($row = mysql_fetch_array($s)){
				$x = $row['consecutivo'];
			}
			$sql = mysql_query("insert into cobro_cliente_grilla(grilla,und,depto,ejecutivo)
			values ('".$x."','".$und."','".$depto."','".$asig."')");
		}
		
		
		public function listar_empleados_no_grilla($depto,$und,$grilla){
			
		}
		
		public function insert_permisos_responsable($fecha,$i){
			if($i == 0){
				$insert = "insert into prespon(usuario,pk_depto,fecha,pk_empresa,asignado,responsable) 
				values('".$this->get_usuario()."','".$this->get_departamento()."','".$fecha."','".$this->get_empresa()."','".$this->get_asignador()."','".$this->get_responsable()."')";
				$result = mysql_query($insert);
				return 1;
			}else{
				return 2;
			}
		}
		
		public function insert_permisos_depto($fecha,$i){
			if($i == 0){
				$insert = "insert into pdepto(usuario,pk_depto,fecha,pk_empresa,asignador) 
				values('".$this->get_usuario()."','".$this->get_departamento()."','".$fecha."','".$this->get_empresa()."','".$this->get_asignador()."')";
				$result = mysql_query($insert);
				return 1;
			}else{
				return 2;
			}
		}
		
		public function insert_permisos_empresa($fecha,$i){
			if($i == 0){
				$insert = "insert into pusuemp(cod_usuario,cod_empresa,fecha,asignador) 
				values('".$this->get_usuario()."','".$this->get_empresa()."','".$fecha."','".$this->get_asignador()."')";
				$result = mysql_query($insert);
				return 1;
			}else{
				return 2;
			}
		}
		
		
		
		public function insert_rol_usuario($fecha,$i){
			if($i == 0){
				$insert = "insert into asigsur(usuario,rol,fecha,asignador) 
				values('".$this->get_usuario()."','".$this->get_rol()."','".$fecha."','".$this->get_asignador()."')";
				$result = mysql_query($insert);
				return 1;
			}
			else{
				return 2;
			}	
		}
		
		public function insert_permiso_director($fecha){
			$insert = "insert into pdirector(usuario,director,asignador,fecha) 
			values ('".$this->get_usuario()."','".$this->get_director()."','".$this->get_asignador()."','".$fecha."')";
			return mysql_query($insert);
		}
		
		public function estructura_permisos_empresa($obj){
			$tabla = "<table>
				<tr>
					<th>Nombre Usuario</th>
					<th>Empresa</th>
					<th>Fecha</th>
					<th>Eliminar</th>
				</tr>";
			while($row = mysql_fetch_array($obj)){
				$id = $row['consecutivo'];
				$tabla .= "<tr id = '$id'>
					<td>".$row['nombre_usuario']."</td>
					<td>".$row['nombre_comercial_empresa']."</td>
					<td>".$row['fecha']."</td>
					<td><img src = '../images/borrar.png' onclick = 'eliminar_permiso($id)' /></td>
				</tr>";
			}
			$tabla .="</table>";
			echo $tabla;
		}
		
		public function estructura_permisos_cliente($obj){
			$tabla = "<table>
				<tr>
					<th>Nombre Usuario</th>
					<th>Cliente</th>
					<th>Producto</th>
					<th>Fecha</th>
					<th>Eliminar</th>
				</tr>";
			while($row = mysql_fetch_array($obj)){
				$id = $row['consecutivo'];
				$tabla .= "<tr id = '$id'>
					<td>".$row['nombre_usuario']."</td>
					<td>".$row['nombre_comercial_cliente']."</td>
					<td>".$row['nombre_producto']."</td>
					<td>".$row['fecha']."</td>
					<td><img src = '../images/borrar.png' onclick = 'eliminar_permisos_cliente($id)' /></td>
				</tr>";
			}
			$tabla .="</table>";
			echo $tabla;
		}
		
		public function consultar_permisos_usuario($id){
			$select = "select u.nombre_usuario, e.nombre_comercial_empresa, p.fecha, p.consecutivo from usuario u, empresa e, pusuemp p where 
			p.cod_usuario = u.idusuario and p.cod_empresa = e.cod_interno_empresa and p.cod_usuario = '$id'";
			return mysql_query($select);
		}
		
		public function consultar_permisos_usuario_cliente($id){
			$select = "select u.nombre_usuario, e.nombre_comercial_cliente, pr.nombre_producto, p.fecha, p.consecutivo from usuario u, clientes e, producto_clientes pr, pcliepro p where 
			p.cod_usuario = u.idusuario and p.cod_cliente = e.codigo_interno_cliente and p.cod_producto = pr.id_procliente and p.cod_usuario = '$id'";
			return mysql_query($select);
		}
		
		public function borrar_permisos_empresa($id){
			$drop = "delete from pusuemp where consecutivo = '$id'";
			$result = mysql_query($drop);
		}
		public function borrar_permisos_cliente($id){
			$drop = "delete from pusuemp where consecutivo = '$id'";
			$result = mysql_query($drop);
		}
		
		
		
		public function borar_permisos_cliente_producto($id){
			$drop = "delete from pcliepro where consecutivo = '$id'";
			$result = mysql_query($drop);
		}
		
		//Permisos Perfiles
		public function permisos_administrador($usuario,$rol){
			$sql = mysql_query("select codigo from cpermisos where perfil = '$rol'");
			while($row = mysql_fetch_array($sql)){
				mysql_query("insert into permisos_op(usuario,codigo) values('".$usuario."','".$row['codigo']."')");
			}
			/*if($rol == 9 || $rol == 1){
				for($i = 0; $i < count($admin_total); $i++){
					mysql_query("insert into permisos_op(usuario,codigo) values('".$usuario."','".$admin_total[$i]."')");
				}
			}else if($rol == 2){
				for($i = 0; $i < count($admin_trafico); $i++){
					mysql_query("insert into permisos_op(usuario,codigo) values('".$usuario."','".$admin_trafico[$i]."')");
				}
			}else if($rol == 3){
				for($i = 0; $i < count($dir_eje); $i++){
					mysql_query("insert into permisos_op(usuario,codigo) values('".$usuario."','".$dir_eje[$i]."')");
				}
			}else if($rol == 4){
				for($i = 0; $i < count($ejecutivo); $i++){
					mysql_query("insert into permisos_op(usuario,codigo) values('".$usuario."','".$ejecutivo[$i]."')");
				}
			}else if($rol == 11){
				for($i = 0; $i < count($dir_creativo); $i++){
					mysql_query("insert into permisos_op(usuario,codigo) values('".$usuario."','".$dir_creativo[$i]."')");
				}
			}else if($rol == 5){
				for($i = 0; $i < count($creativo); $i++){
					mysql_query("insert into permisos_op(usuario,codigo) values('".$usuario."','".$creativo[$i]."')");
				}
			}else if($rol == 6){
				for($i = 0; $i < count($productor); $i++){
					mysql_query("insert into permisos_op(usuario,codigo) values('".$usuario."','".$productor[$i]."')");
				}
			}else if($rol == 7){
				for($i = 0; $i < count($contabilidad); $i++){
					mysql_query("insert into permisos_op(usuario,codigo) values('".$usuario."','".$contabilidad[$i]."')");
				}
			}else if($rol == 8){
				for($i = 0; $i < count($compras); $i++){
					mysql_query("insert into permisos_op(usuario,codigo) values('".$usuario."','".$compras[$i]."')");
				}
			}else if($rol == 14){
				for($i = 0; $i < count($recep_fact); $i++){
					mysql_query("insert into permisos_op(usuario,codigo) values('".$usuario."','".$recep_fact[$i]."')");
				}
			}else if($rol == 10){
				for($i = 0; $i < count($admin_personal); $i++){
					mysql_query("insert into permisos_op(usuario,codigo) values('".$usuario."','".$admin_personal[$i]."')");
				}
			}else if($rol == 12 || $rol == 13){
				for($i = 0; $i < count($fac_teso); $i++){
					mysql_query("insert into permisos_op(usuario,codigo) values('".$usuario."','".$fac_teso[$i]."')");
				}
			}	
		*/
		}
		
		
	}

?>