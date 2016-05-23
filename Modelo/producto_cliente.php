<?php
	class producto_cliente{
		public $nproducto;
		public $pk_cliente;
		public $estado;
		public $fee;
		
		
		public function get_fee(){
			return $this->fee;
		}
		public function set_fee($s){
			$this->fee = $s;
		}
		
		public function get_estado_producto_cliente(){
			return $this->estado;
		}
		public function set_estado_producto_cliente($est){
			$this->estado = $est;
		}
		public function get_nombre_procliente(){
			return $this->nproducto;
		}
		public function set_nombre_procliente($name_producto){
			$this->nproducto = strtoupper($name_producto);
		}
	
		public function get_cliente_procliente(){
			return $this->pk_cliente;
		}
		public function set_cliente_procliente($cliente){
			$this->pk_cliente = $cliente;
		}
		
		
		public function sql_productos_cliente($cliente){
			$sql = mysql_query("select pc.id_procliente, pc.fee,pc.estado, pc.nombre_producto, c.nombre_legal_clientes 
			from producto_clientes pc, clientes c 
			where pc.pk_clientes_nit_procliente = c.codigo_interno_cliente and c.codigo_interno_cliente = '$cliente'");
			return $sql;
		}
		
		public function listar_productos_cliente($sql){
			$imp = "<option value = '0'></option>";
			while($row = mysql_fetch_array($sql)){
				$imp .= "<option value = '".$row['id_procliente']."'>".$row['nombre_producto']."</option>";
			}
			echo $imp;
		}
		
		public function mostrar_producto_cliente_creado($sql){
			$est ="<table width = '100%' class = 'tablas_muestra_datos_tablas'>
			<tr>
				<th>Nombre Producto</th>
				<th>Fee</th>
				<th>Cliente</th>
			</tr>";
			$i = 0;
			while($row = mysql_fetch_array($sql)){
				
				$id = $row['id_procliente'];
				$estado = "";
				$img = "";
				if($row['estado'] == 1){
					$estado = "ACTIVO";
					$img = "<img src = '../images/iconos/activo.png' onclick = 'cambiar_estado_producto_cliente($id,0)' class = 'botones_opciones' title = 'ACTIVO, ¿Desactivar?'/>";
				}else{
					$estado = "INACTIVO";
					$img = "<img src = '../images/iconos/inactivo.png' onclick = 'cambiar_estado_producto_cliente($id,1)'class = 'botones_opciones' title = 'INACTIVO, ¿Activar?'/>";
				}
				$est .= "<tr id = ".$row['id_procliente']." >
						<td id = 'nombre_producto$id'style = 'padding-left:10px;'nowrap>".strtoupper($row['nombre_producto'])."</td>
						<td nowrap>
							<table width = '100%' class = 'sin_color'>
								<tr>
									<td>$</td>
									<td align = 'right'>".number_format($row['fee'])."</td>
									<span class = 'hidde' id = 'valor_productox$id'>".$row['fee']."</span>
								</tr>
							</table>
						</td>
						<td nowrap>".$row['nombre_legal_clientes']."</td>
						<td align = 'center' id = 'imgestado$id'>$img</td>
						<td align = 'center' >
							<img src = '../images/iconos/icono_editar.png' onclick = 'update_nombre_producto_cliente($id)'class = 'botones_opciones'/>
						</td>
					</tr>";
			}
			$est .="</table>";
			echo $est;
		}
		
		public function insert_procliente($usuario,$fecha){
			$accion = "INSERT INTO producto_clientes(nombre_producto,estado,usuario,fecha_registro,fee,pk_clientes_nit_procliente) ";
			$accion .="values('".$this->get_nombre_procliente()."','".$this->get_estado_producto_cliente()."','".$usuario."','".$fecha."','".
			$this->get_fee()."','".$this->get_cliente_procliente()."')";
			$result = mysql_query($accion);
		}
		
		public function update_procliente($id,$fecha,$usuario){
			$accion = "update producto_clientes set estado = '".$this->get_estado_producto_cliente()."', fecha_registro = '".$fecha.
			"', usuario = '".$usuario."' where id_procliente = '".$id."'";
			$result = mysql_query($accion);
		}
		
		public function update_name_procliente($id,$fecha,$usuario,$name){
			$accion = "update producto_clientes set nombre_producto = '".$name."', fecha_registro = '".$fecha.
			"', usuario = '".$usuario."' where id_procliente = '".$id."'";
			$result = mysql_query($accion);
		}
		
		public function drop_procliente(){
		
		}
	}

?>
