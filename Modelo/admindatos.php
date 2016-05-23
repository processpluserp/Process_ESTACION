<?php
	#Dentro de esta clase, almaceno toda la información al control de datos como son los complementarios de los ids, las consultas, etc.
	
	class administrador{
		
		#@usuario: Guarda la información de quién esstá usando el process en un determinado momento.
		#@fecha: Fecha y hora en la que se realiza una determinada acción en el sistema.
		public $usuario;
		public $fecha;
		
		#Estos son los modificadores de acceso, es decir los métodos que me permiten modificar(SET) el contenido de las variables de usuario y fecha
		#o cargar el contenido(GET) que tenga en su interior en cualquier momento, empleando un objeto de esta clase.
		public function get_usuario(){
			return $this->usuario;
		}
		public function set_usuario($usu){
			$this->usuario = $usu;
		}
		
		public function get_fecha(){
			return $this->fecha;
		}
		public function set_fecha($fec){
			$this->fecha = $fecha;
		}
	
		public function consultas($query){
			$result = mysql_query($query);
			return $result;
		}
		#Como se había estipulado, hay una tabla dentro de la base de datos que me almacena los movimiento y/o acciones que realice un usuario.
		#El método insert_auditoria, lo que hace es guarda en dicha tabla, el usuario, fecha y hora, módulo y acción que realice sobre este.
		public function insert_auditoria($usuario,$tiempo,$fecha,$modulo,$accion,$observacion){
			$accion = "INSERT INTO auditoria(usuario,tiempo,fecha,modulo,accion,observaciones) ";
			$accion .= "values('".$usuario."','".$tiempo."','".$fecha."','".$modulo."','".$accion."','".$observacion."')";
			$result = mysql_query($accion);
		}
		#Este método autocomplementa el # que se le ingrese con ceros para completar la longuitud máxima de los ids.
		public function complementos_ceros($id){
			$identificador = "";
			if(($id) < 10){
				$identificador = "000".$id;
			}
			else if(($id) > 9 && ($id) < 100){
				$identificador = "00".$id;
			}
			else if(($id) > 99 && ($id) < 1000 ){
				$identificador = "0".$id;
			}
			else if(($id) > 999 and ($id) <= 9999){
				$identificador = $id;
			}
			return $identificador;
		}
		#Con este método se unen dos variables con el separador "-".
		public function concatenador($valor1, $valor2){
			$union = $valor1."-".$valor2;
			return $union;
		}
		
		
	}

?>