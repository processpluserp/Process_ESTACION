<?php
	class contactos_area_cliente{
		public $cod_contacto; //Número compuesto por el código del cliente y el consecutivo correspondiente
		public $num_contacto; //Número del consecutivo;
		public $area;
		public $ncontacto;
		public $correo;
		public $cargo;
		public $telefono;
		public $ext;
		public $fecha_nacimiento;
		public $usuario;
		public $fecha_registro;
		public $pkcliente;
		
		public function get_cod_contacto(){
			return $this->cod_contacto;
		}
		public function set_cod_contacto($codigo){
			$this->cod_contacto = $codigo;
		}
		public function get_numcontacto(){
			return $this->num_contacto;
		}
		public function set_numcontacto($num){
			$this->num_contacto = $num;
		}
		
		public function get_area_contacto(){
			return $this->area;
		}
		public function set_area_contacto($area_c){
			$this->area = $area_c;
		}
		public function get_ncontacto(){
			return $this->ncontacto;
		}
		public function set_ncontacto($ncontac){
			$this->ncontacto = strtoupper($ncontac);
		}
		public function get_correoc(){
			return $this->correo;
		}
		public function set_correoc($mail){
			$this->correo = $mail;
		}
		public function get_cargo_contacto(){
			return $this->cargo;
		}
		public function set_cargo_contacto($crg){
			$this->cargo = $crg;
		}
		public function get_telefono_contacto(){
			return $this->telefono;
		}
		public function set_telefono_contacto($phone){
			$this->telefono = $phone;
		}
		public function get_mes(){
			return $this->ext;
		}
		public function set_mes($extt){
			$this->ext = $extt;
		}
		public function get_dia(){
			return $this->fecha_nacimiento;
		}
		public function set_dia($fnaci){
			$this->fecha_nacimiento = $fnaci;
		}
		public function get_usuario_contacto(){
			return $this->usuario;
		}
		public function set_usuario_contacto($usu){
			$this->usuario = $usu;
		}
		public function get_fecharegistro_contacto(){
			return $this->fecha_registro;
		}
		public function set_fecharegistro_contacto($fre){
			$this->fecha_registro = $fre;
		}
		public function get_cliente_contacto(){
			return $this->pkcliente;
		}
		public function set_cliente_contacto($cliente){
			$this->pkcliente = $cliente;
		}
		
		
		public function insert_contacto_cliente($usuario,$fecha,$cel){
			$sql = mysql_query("insert into contactos_area(nombre,cargo,correo,telefono,celular,mes_nacimiento,dia_nacimiento,usuario,fecha_registro,clientes_nit_cliente) values
			('".$this->get_ncontacto()."','".$this->get_cargo_contacto()."','".$this->get_correoc()."','".$this->get_telefono_contacto()."','".$cel."','".
			$this->get_mes()."','".$this->get_dia()."','".$usuario."','".$fecha."','".$this->get_cliente_contacto()."')");
		}
		public function update_contacto_cliente(){
		
		}
		public function drop_contacto_cliente(){
		
		}
	}

?>