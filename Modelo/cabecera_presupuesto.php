<?php

	/*
		Clase que contiene la información de los pptos creados.
	*/
	class cabecera_presupuesto{
		public $numero_presupuesto; //Codigo del numero de ppto.
		public $referencia; //Referente del ppto
		public $vigencia_inicial;//Vigencia Inicial
		public $vigencia_final;//Vigencia Final
		public $nota; //Nota de ppto, parametrizada a partir de la empresa.
		public $tipo_comision;//Tipo de comisión, cargada a partir de la sociedad entre Empresa - Cliente.
		public $grupo_presupuesto; //No APlica
		public $ciudad_presupuesto; //Ciudad.
		public $estado; //1
		public $pk_empresa;
		public $pk_cliente;
		public $pk_ot;
		public $moneda;
		public $tipo;
		
		
		public $num_aprobacion;
		
		
		//Modificadores de Acceso.
		public function get_num_apro(){
			return $this->num_aprobacion;
		}
		
		public function set_num_apro($val){
			$this->num_aprobacion = $val;
		}
		
		
		public function get_tipo(){
			return $this->tipo;
		}
		public function set_tipo($t){
			$this->tipo = $t;
		}
		
		public function get_numero_cabecera_presupuesto(){
			return $this->numero_presupuesto;
		}
		public function set_numero_cabecera_presupuesto($numero){
			$this->numero_presupuesto = $numero;
		}
		public function get_referencia_cabecera_presupuesto(){
			return $this->referencia;
		}
		public function set_referencia_cabecera_presupuesto($ref){
			$this->referencia = $ref;
		}
		public function get_vigencia_final_cabecera_presupuesto(){
			return $this->vigencia_final;
		}
		public function set_vigencia_final_cabecera_presupuesto($v_final){
			$this->vigencia_final = $v_final;
		}
		public function get_vigencia_inicial_cabecera_presupuesto(){
			return $this->vigencia_inicial;
		}
		public function set_vigencia_inicial_cabecera_presupuesto($v_inicial){
			$this->vigencia_inicial = $v_inicial;
		}
		public function get_nota_cabecera_presupuesto(){
			return $this->nota;
		}
		public function set_nota_cabecera_presupuesto($not){
			$this->nota = $not;
		}
		public function get_tipo_comision_cabecera_presupuesto(){
			return $this->tipo_comision;
		}
		public function set_tipo_comision_cabecera_presupuesto($comision){
			$this->tipo_comision = $comision;
		}
		public function get_grupo_cabecera_presupuesto(){
			return $this->grupo_presupuesto;
		}
		public function set_grupo_cabecera_presupuesto($grupo){
			$this->grupo_presupuesto = $grupo;
		}
		public function get_ciudad_cabecera_presupuesto(){
			return $this->ciudad_presupuesto;
		}
		public function set_ciudad_cabecera_presupuesto($ciudad){
			$this->ciudad_presupuesto = $ciudad;
		}
		public function get_estado_cabecera_presupuesto(){
			return $this->estado;
		}
		public function set_estado_cabecera_presupuesto($est){
			$this->estado = $est;
		}
		public function get_empresa_cabecera_presupuesto(){
			return $this->pk_empresa;
		}
		public function set_empresa_cabecera_presupuesto($empresa){
			$this->pk_empresa = $empresa;
		}
		public function get_cliente_cabecera_presupuesto(){
			return $this->pk_cliente;
		}
		public function set_cliente_cabecera_presupuesto($cliente){
			$this->pk_cliente = $cliente;
		}
		public function get_codigoot_cabecera_presupuesto(){
			return $this->pk_ot;
		}
		public function set_codigoot_cabecera_presupuesto($codigo_ot){
			$this->pk_ot = $codigo_ot;
		}
		public function get_mondea_cabecera_presupuesto(){
			return $this->moneda;
		}
		public function set_moneda_cabecera_presupuesto($money){
			$this->moneda = $money;
		}
		
		
		/*
			Se encarga de contar el número de pptos que hay creado a través de la relación Empresa - Cliente.
			@param int $emp Código empresa.
			@param int $clie Código Cliente.
			
		*/
		public function consulta_pptos_existentes($emp,$clie){
			$select = "select numero_presupuesto from cabpresup where empresa_nit_empresa = '$emp'
			and pk_clientes_nit_cliente = '$clie'";
			$r = mysql_query($select);
			$i = 0;
			while($row = mysql_fetch_array($r)){
				$i++;
			}
			$this->set_numero_cabecera_presupuesto($i+1);
		}
		
		/*
			Consulta el consecutivo del ppto.
			@param int $emp Código empresa.
			@param int $clie Código del cliente.
			@param int $num Código del cliente.
		*/
		public function consulta_consecutivo_ppto($emp,$clie,$num){
			$select = "select codigo_presup from cabpresup where empresa_nit_empresa = '$emp'
			and pk_clientes_nit_cliente = '$clie' and numero_presupuesto = '$num'";
			$r = mysql_query($select);
			$i = 0;
			while($row = mysql_fetch_array($r)){
				$i = $row['codigo_presup'];
			}
			return $i;
		}
		
		/*
			Consulta el valor de los impuestos a partir de la empresa.
			@param int $empresa Código empresa.
			@param int $doc Código del documento/Impuesto.
		*/
		public function valores_impuestos($empresa,$doc){
			$sql = mysql_query("select d.valor 
			from documentos_legales_entidades d
			where d.pk_tdocumento = '$doc' and d.pk_empresa = '$empresa'");
			while($row = mysql_fetch_array($sql)){
				return  $row['valor'];
			}
		}
		
		
		/*
			Se encarga de buscar las facturas relacionadas con una empresa y cliente.
			@param int $emp Código empresa.
			@param int $clie Código Cliente.
		*/
		public function buscar_facturas_empresa_cliente($emp,$clie){
			$sql =  mysql_query(("select factura_fact from cabpresup where pk_clientes_nit_cliente = '$clie' and empresa_nit_empresa = '$emp'"));
			$imp = "<option value = '0'>[SELECCIONE]</option>";
			while($row = mysql_fetch_array(($sql))){
				$imp.="<option value = '".$row['factura_fact']."'>".$row['factura_fact']."</option>";
			}
			echo $imp;
		}
	
		/*
			Se encarga de buscar la información del ppto a partir de la factura
			@param int $fact Número de la factura.
		*/
		public function buscar_referecia_num_ppto_factura($fact){
			$sql =  mysql_query("select referencia,codigo_presup,numero_presupuesto from cabpresup where factura_fact = '$fact'");
			
			while($row = mysql_fetch_array(($sql))){
				echo $row['codigo_presup']." - ".$row['referencia'];
			}
		}

		
		public function sql_mostrar_oc_recepcion_facturas($emp,$noorden){

		}

		/*
			Se encarga de buscar los impuestos adicionales que tenga el CLiente.
			@param int $clie Código del Cliente.
			@param int $condicion Código de la condición del cliente.
		*/
		public function impuestos_adicionales_cliente($clie,$condicion){
			$sql = mysql_query("select adicionales from condiciones_cliente where cliente = '$clie' and consecutivo = '$condicion'");
			while($row = mysql_fetch_array($sql)){
				return $row['adicionales'];
			}
		}
		
		
		/*
			Se encarga de buscar el impuesta de la retención del cliente.
			@param int $clie Código Cliente.
			@param int $condicion Código de la condición.
		*/
		public function impuesto_rete_cliente($clie,$condicion){
			$sql = mysql_query("select refuente from condiciones_cliente where cliente = '$clie' and consecutivo = '$condicion'");
			while($row = mysql_fetch_array($sql)){
				return $row['refuente'];
			}
		}

		/*
			Se encarga de buscar la información de un ppto a partir de la factura.
			@param string $fact Número de factura.
		*/
		public function buscar_factura_pago($fact){
			$sql = mysql_query("select codigo_presup,referencia,numero_presupuesto from cabpresup where factura_fact = '$fact'");
			while($row = mysql_fetch_array($sql)){
				echo "<option value = '".$row['codigo_presup']."'>".$row['codigo_presup']." - ".$row['referencia']."</option>";
			}
		}


		/*Se encarga de guardar en la BD la factura relacionada a un ppto.
			@param int $codigo_presup Código del ppto.
			@param string $factura Número de la factura.
			@param date $fecha_fact Fecha de la factura.
			@param double $valor_fact Valor de la factura.
			@param date $fecha Fecha de registro.
			@param int $usuario Código de usuario.
			
		*/
		public function facturar_ppto($codigo_presup,$factura,$fecha_fact,$valor_fact,$fecha,$usuario){
			mysql_query("UPDATE cabpresup set factura_fact = '$factura', estado_presup = '5', fecha_factura = '$fecha_fact', valor = '$valor_fact', fecha_r_facturacion = '$fecha', usuario_facturacion = '$usuario' where codigo_presup = '$codigo_presup'");
			echo "PPTO FACTURADO !!!";
		}

		/*
			Evuala si el valor que se ha pagado es equivalente al valor que estipuló en la factura,
			Si el valor es igual o mayor se actualiza el estado del ppto.
			Sino, solo guarda el valor que se pagó por parte del cliente.
		*/
		public function evaluar_pagado_ppto_tesoreria($num_ppto,$fact){
			$sql = mysql_query("select valor from cabpresup where codigo_presup = '$num_ppto'");
			$valor_factura_ppto = 0;
			while($row = mysql_fetch_array($sql)){
				$valor_factura_ppto = $row['valor'];
			}
			$sql = mysql_query(("select valor from pagos_clientes where ppto = '$num_ppto' and factura = '$fact'"));
			$valor_pagado_cliente = 0;
			while($row = mysql_fetch_array($sql)){
				$valor_pagado_cliente += $row['valor'];
			}
			if($valor_pagado_cliente >= $valor_factura_ppto){
				mysql_query("update cabpresup set estado_presup = '6' where codigo_presup = '$num_ppto'");
			}
		}

		/*Se encarga de guardar en la BD la información del pago del cliente
			@param int $tipo Tipo de pago, parcial o completo.
			@param string $factura Número de la factura.
			@param int $ppto Código del ppto.
			@param double $valor Valor pagado por cliente.
			@param date $fecha Fecha de registro.
			@param int $usuario Código de usuario.
		*/
		public function descargar_pago_cliente($tipo,$factura,$ppto,$valor,$fecha,$usuario){
			mysql_query("INSERT into pagos_clientes(tipo,factura,ppto,valor,fecha,usuario) values('".$tipo."','".$factura."','".$ppto."','".$valor."','".$fecha."','".$usuario."')");
			$this->evaluar_pagado_ppto_tesoreria($ppto,$factura);
		}
		
		
		/*
			
		*/
		public function valor_min_pppto_por_empresa(){
			$empresa = $this->get_empresa_cabecera_presupuesto();
			$sql = mysql_query("select min_ppto from administrativa where empresa = '$empresa' and year = '".date("Y")."'");
			while($row = mysql_fetch_array($sql)){
				return $row['min_ppto'];
			}
		}
		
		public function insert_cabecera_presupuesto($usuario, $fecha_presupuesto,$ceco){
			$emp = $this->get_empresa_cabecera_presupuesto();
			$insert = "insert into cabpresup(numero_presupuesto,referencia,vigencia_inicial,vigencia_final,nota,
			tipo_comision,ciudad_presup,estado_presup,usuario,fecha_registro,empresa_nit_empresa,pk_clientes_nit_cliente,
			ot,tipo,num_aprobacion,rfuente,val_cheques,ica,cree,rete_adicional,min_val,ceco,vi,vc) 
			values('".$this->get_numero_cabecera_presupuesto()."','".$this->get_referencia_cabecera_presupuesto()."','".
			$this->get_vigencia_inicial_cabecera_presupuesto()."','".$this->get_vigencia_final_cabecera_presupuesto()."','".$this->get_nota_cabecera_presupuesto()."','".
			$this->get_tipo_comision_cabecera_presupuesto()."','".$this->get_ciudad_cabecera_presupuesto()."','".$this->get_estado_cabecera_presupuesto()."','".
			$usuario."','".$fecha_presupuesto."','".$this->get_empresa_cabecera_presupuesto()."','".$this->get_cliente_cabecera_presupuesto()."','".
			$this->get_codigoot_cabecera_presupuesto()."','".$this->get_tipo()."','".$this->get_num_apro()."','".$this->impuesto_rete_cliente($this->get_cliente_cabecera_presupuesto(),$this->get_tipo_comision_cabecera_presupuesto())
			."','".$this->valores_impuestos($emp,16)."','".$this->valores_impuestos($emp,14)
			."','".$this->valores_impuestos($emp,11)."','".$this->impuestos_adicionales_cliente($this->get_cliente_cabecera_presupuesto(),$this->get_tipo_comision_cabecera_presupuesto())."','".$this->valor_min_pppto_por_empresa()."','".$ceco."','1','1')";
			return mysql_query($insert);
		}

		public function listar_pptos_select($empresa,$cliente,$ot){
			$sql = mysql_query("SELECT codigo_presup,numero_presupuesto,referencia from cabpresup where empresa_nit_empresa = '$empresa' and pk_clientes_nit_cliente = '$cliente' and ot = '$ot'");
			$imp = "<option value = '0'>[SELECCIONE]</option>";
			while($row = mysql_fetch_array($sql)){
				$imp.="<option value = '".$row['codigo_presup']."'>".$row['codigo_presup']." - ".$row['referencia']."</option>";
			}
			echo $imp;
		}
		public function update_cabecera_presupuesto($usuario, $fecha_presupuesto){}
		public function drop_cabecera_presupuesto($usuario, $fecha_presupuesto){}
		
	}
?>