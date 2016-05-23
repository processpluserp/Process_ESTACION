<?php
	#Contiene la información de la asociación entre un cliente y una empresa.
	
	class asocliemp{
		#iniciales: Son las iniciales que se guardan por la asociacion entre un cliente y una empresa
		#fecha_asoc: Fecha y hora en la que se realiza la asociación.
		#pk_empresa: Código de la empresa que se asocia.
		#pk_cliente: Código del cliente que se asocia.
		public $iniciales;
		public $fecha_asoc;
		public $pk_empresa;
		public $pk_cliente;
		
		
		#Modificadores de Acceso.
		public function get_iniciales_asocliemp(){
			return $this->iniciales;
		}
		public function set_iniciales_asocliemp($ini){
			$this->iniciales = strtoupper($ini);
		}
		public function get_fecha_asocliemp(){
			return $this->fecha_asoc;
		}
		public function set_fecha_asocliemp($fecha){
			$this->fecha_asoc = $fecha;
		}
		public function get_empresa_asocliemp(){
			return $this->pk_empresa;
		}
		public function set_empresa_asocliemp($empresa){
			return $this->pk_empresa = $empresa;
		}
		public function get_cliente_asocliemp(){
			return $this->pk_cliente;
		}
		public function set_cliente_asocliemp($cliente){
			$this->pk_cliente = $cliente;
		}
		
		
		/*
			Método que guarda los datos de la asociasión en la BD.
			@param int $usuario Contiene el código del usuario que realiza la asociación.
			@param date $fecha_registro Contiene el dato de la fecha en la que se esstá realizando esta acción.
		*/
		public function insert_asocliemp($usuario,$fecha_registro){
			$est = 1;
			$insert = "insert into asocliemp (inicial_cliente_asoc,fecha_asoc,usuario,fecha_registro,pk_nit_cliente_empresa_asoc,pk_nit_empresa_cliente_asoc,estado) ";
			$insert .="values ('".$this->get_iniciales_asocliemp()."','".$fecha_registro."','".$usuario."','".$fecha_registro."','".
			$this->get_cliente_asocliemp()."','".$this->get_empresa_asocliemp()."','".$est."')";
			$result = mysql_query($insert);
		}
		
		/*
			A través de los datos de Empresa Cliente, carga los datos de las iniciales que se declararon para esta sociedad.
			@param int $empresa Contiene el código de la empresa.
			@param int $cliente Contiene el código del cliente.
		*/
		public function consultar_iniciales($empresa,$cliente){
			$consulta = "select inicial_cliente_asoc from asocliemp 
			where pk_nit_cliente_empresa_asoc = '$cliente' and pk_nit_empresa_cliente_asoc = '$empresa'";
			$result = mysql_query($consulta);
			$iniciales = "";
			while($row = mysql_fetch_array($result)){
				$iniciales .= $row['inicial_cliente_asoc'];
			}
			return $iniciales;
		}
		
	}
?>