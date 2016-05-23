<?php
	/*
		Clase en donde se realiza el control de la sociedad EMPRESA - PROVEEDOR
	*/
	class asociacion_proveedor_empresa{
		public $fecha_asociacion; //Fecha de registro.
		public $proveedor; //Código del proveedor.
		public $empresa; //Código de la empresa.
		
		
		//Modificadores de acceso.
		public function get_fecha_asociacion_asocproemp(){
			return $this->fecha_asociacion;
		}
		public function set_fecha_asociacion_asocproemp($fecha){
			$this->fecha_asociacion = $fecha;
		}
		public function get_proveedor_asocproemp(){
			return $this->proveedor;
		}
		public function set_proveedor_asocproemp($pk_proveedor){
			$this->proveedor = $pk_proveedor;
		}
		public function get_empresa_asocproemp(){
			return $this->empresa;
		}
		public function set_empresa_asocproemp($pk_empresa){
			$this->empresa = pk_empresa;
		}
		
		
		/*
			Este médoto se encarga de guardar la información en la BD de la sociedad entre un proveedor y la empresa.
			@param int $usuario Contiene la información del código de usuario.
			@param int $empresa Contiene la información del código de la empresa.
		*/
		public function insert_asocproemp($usuario,$empresa){
			$est = 1;
			$insert = "insert into asocproemp(fecha_asoc,usuario,pk_nit_proveedor_asoc,pk_nit_empresa_asoc,estado) values";
			$insert .= "('".$this->get_fecha_asociacion_asocproemp()."','".$usuario."','".$this->get_proveedor_asocproemp()."','".$empresa."','".$est."')";
			$result = mysql_query($insert);
		}
		public function update_asocproemp($usuario, $fecha_registro){
		
		}
	}
?>