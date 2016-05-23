<?php
	include("../Controller/Conexion.php");

	class cliente{
		public $meses = array("Enero", "Febrero", "Marzo",
        "Abril", "Mayo", "Junio", "Julio",
        "Agosto", "Septiembre", "Octubre",
        "Noviembre", "Diciembre");
		
		public $nit;
		public $nlegal;
		public $ncomercial;
		public $telefono;
		public $direccion;
		public $ciudad;
		public $depto;
		public $pais;
		public $estado;
		public $ruta_carpeta;
		
		//CONDICIONES:
		public $pago;
		public $impuestos;
		public $rfuente;
		public $uaai;
		public $t_comision;
		public $comision;
		public $tercero;
		public $cierre;
		
		
		//DOCUMENTOS LEGALES CLIENTE:
		public $nombre_archivo;
		public $tipo_documento;
		
		//CONTRATOR POR UNIDAD DE NEGOCIO
		public $num_contrato;
		
		
		//FEE
		public $valor_fee;
		
		public function get_valor_fee(){
			return $this->valor_fee;
		}
		
		public function set_valor_fee($x){
			$this->valor_fee = $x;
		}
		/*
		public function grilla($clie,$pro,$emp){
			$sql = mysql_query("select consecutivo from pcliepro where cod_cliente = '$clie' and
			cod_producto = '$pro' and pk_empresa = '$emp'");
			$x = "";
			while($row = mysql_fetch_array($sql)){
				$x = $row['consecutivo'];
			}
			return $x;
		}
		
		public function sql_departamentos_grilla($grilla){
			$sql = mysql_query("select distinct ar.nombre_area_empresa, ar.codigo_interno_empresa
			from area_empresa ar, cobro_cliente_grilla c
			where c.depto = ar.codigo_interno_empresa and c.grilla = '$grilla'");
			return $sql;
		}
		
		public function mostrar_grilla($sql,$grilla){
			$pk_depto = "";
			$est.="<table width = '100%'>
				<tr>
					<th class = 'bordes_nomina'>RECURSO</th>
					<th class = 'bordes_nomina'>COSTOS DIRECTOS</th>
					<th class = 'bordes_nomina'>OVERHEAD</th>
					<th class = 'bordes_nomina'>DEDICACIÓN</th>
					<th class = 'bordes_nomina'>COSTOS DIRECTOS SEGÚN DEDICACIÓN</th>
					<th class = 'bordes_nomina'>OVERHEAD</th>
					<th class = 'bordes_nomina'>TOTAL COSTO</th>
					<th class = 'bordes_nomina'>UTILIDAD MENSUAL</th>
					<th class = 'bordes_nomina'>FEE MENSUAL A COBRAR</th>
				</tr>
				<tr><td></br></td></tr>
			";
			while($row = mysql_fetch_array($sql)){
				$pk_depto = $row['codigo_interno_empresa'];
				
				$sql_unidad = mysql_query("select distinct u.name, u.id from und u, cobro_cliente_grilla c where
				c.und = u.id");
				
				while($row2 = mysql_fetch_array($sql_unidad)){
					$und = $row2['id'];
					$periodo = date("Y")."-".floatval(date("m"));
					$sql_emple = mysql_query("select e.documento_empleado,e.estado,e.nombre_empleado,te.id,te.dias, te.salario_base, te.otros, te.bnp, te.balimentacion, te.indemnizacion, te.afc,te.rte
					from empleado e, tablas_empleados te, cobro_cliente_grilla c,usuario s
					where e.documento_empleado = te.cedula and te.periodo = '$periodo' and te.empresa = '$emp' and
					c.ejecutivo = s.idusuario and s.pk_empleado = e.documento_empleado and c.grilla = '$grilla' and
					c.depto = '$pk_depto' and c.und = '$und'");
					$est.="<tr>
							<th class = 'bordes_nomina' colspan = '9'>UNIDAD ".$row2['name'].", DEPTO: ".$row['nombre_area_empresa']."</th>
						</tr>";
					while($row3 = mysql_fetch_array($sql_emple)){
						$est.="<tr>
							<td class = 'bordes_nomina'>".$row3['nombre_empleado']."</td>
							<td class = 'bordes_nomina'>".$row3['salario_base']."</td>
						</tr>";
					}
				}
			}
			echo $est.="</table>";
		}
		
		*/
		
		public function sql_asignado_cliente($clie,$pro,$emp){
			$sql = mysql_query("select c.codigo_interno_cliente, c.nombre_comercial_cliente, e.nombre_empleado, p.fecha, pc.nombre_producto,p.consecutivo
			from clientes c, empleado e,pcliepro p,usuario s,  producto_clientes pc
			where p.cod_usuario = s.idusuario and p.pk_empresa = '$emp' and p.cod_cliente ='$clie' and p.cod_producto = '$pro' and
			p.cod_cliente = c.codigo_interno_cliente and p.cod_producto = pc.id_procliente and s.pk_empleado = e.documento_empleado order by c.nombre_comercial_cliente asc");
			return $sql;
		}
		
		public function sql_asignado_empleado($emp,$empleado){
			$sql = mysql_query("select c.codigo_interno_cliente, c.nombre_comercial_cliente, e.nombre_empleado, p.fecha, pc.nombre_producto,p.consecutivo
			from clientes c, empleado e,pcliepro p,usuario s,  producto_clientes pc
			where p.cod_usuario = s.idusuario and p.pk_empresa = '$emp' and
			p.cod_cliente = c.codigo_interno_cliente and p.cod_producto = pc.id_procliente and s.idusuario = '$empleado' 
			AND e.documento_empleado = s.pk_empleado order by c.nombre_comercial_cliente asc");
			return $sql;
		}
		
		
		public function ejecutivo_asignado_cuenta($clie,$pro,$emp,$grilla){
			$sql = mysql_query("select e.nombre_empleado
			from empleado e, pcliepro p, usuario s1
			where p.pk_empresa = '$emp' and p.cod_cliente = '$clie' and p.cod_producto = '$pro' and
			p.cod_usuario = s1.idusuario and s1.pk_empleado = e.documento_empleado");
			$t = "";
			while($row = mysql_fetch_array($sql)){
				$t =  "<p>EJECUTIVO ASIGNADO: ".$row['nombre_empleado']."</p>";
			}
			echo $t;
		}
		
		public function remover_cuenta_empleado($id){
			$sql = mysql_query("delete from pcliepro where consecutivo ='$id'");
		}
		
		public function muestra_asignado_cliente($sql){
			$est = "<table width = '100%' class='tablas_muestra_datos_tablas'>
				<tr>
					<th class = 'bordes_nomina'></th>
					<th class = 'bordes_nomina'>CLIENTE</th>
					<th class = 'bordes_nomina'>PRODUCTO</th>
					<th class = 'bordes_nomina'>FECHA ASIGNACION</th>
				</tr>
			";
			while($row = mysql_fetch_array($sql)){
				$id = $row['consecutivo'];
				$est.="<tr>
					<td class = 'bordes_nomina'>
						<img onclick = 'eliminar_permiso_cuenta($id)'src = '../images/iconos/eliminar.png' width = '25px' height = '25px' />
					</td >
					<td class = 'bordes_nomina' nowrap>".$row['nombre_comercial_cliente']."</td>
					<td class = 'bordes_nomina' nowrap>".$row['nombre_producto']."</td>
					<td align = 'center' class = 'bordes_nomina' nowrap>".$row['fecha']."</td>
				</tr>";
			}
			echo $est."</table>";
			
		}
				
		public function insert_fee_cliente($id,$producto){
			$s1 = mysql_query("select id from fee_cliente where cliente = '$id' and producto = '$producto'");
			if(mysql_num_rows($s1) == 0){
				$sql = mysql_query("insert into fee_cliente(valor,cliente,producto) 
				values('".$this->get_valor_fee()."','".$id."','".$producto."')");
				//echo "FEE CREADO";
			}else{
				//echo "ESTE CLIENTE YA TIENE FEE CREADO CON ESTE PRODUCTO";
			}
		}
		
		public function sql_fees_cliente($cliente){
			$sql = mysql_query("select f.valor,f.id,c.nombre_comercial_cliente,p.nombre_producto
			from fee_cliente f,clientes c, producto_clientes p
			where f.cliente = c.codigo_interno_cliente and f.producto = p.id_procliente and c.codigo_interno_cliente = '$cliente' order by p.nombre_producto asc");
			return $sql;
		}
		
		public function mostrar_tabla_productos_cliente($sql){
			$est = "<table width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>CLIENTE</th>
					<th>PRODUCTO</th>
					<th>VALOR FEE</th>
				</tr>";
			while($row = mysql_fetch_array($sql)){
				$est .="<tr>
					<td nowrap>".$row['nombre_comercial_cliente']."</td>
					<td nowrap>".$row['nombre_producto']."</td>
					<td nowrap>".number_format($row['valor'])."</td>
				</tr>";
			}
			echo $est."</table>";
		}
		
		public function get_numero_contrato(){
			return $this->num_contrato;
		}
		public function set_numero_contrato($num){
			$this->num_contrato = $num;
		}
		public function insert_contratos($valor,$id,$emp,$f1,$f2,$f3,$tipo){
			$sql = mysql_query("insert into conagencias(valor,numero_c_contrato,archivo_contrato,cliente,empresa,fcontrato,ffirma,fterminacion,tipo) values('".$valor."','".
			$this->get_numero_contrato()."','".$this->get_nombre_archivo()."','".$id."','".$emp."','".$f1."','".$f2."','".$f3."','".$tipo."')");
		}
		
		public function get_nombre_archivo(){
			return $this->nombre_archivo;
		}
		public function set_nombre_archivo($xc){
			$this->nombre_archivo = $xc;
		}
		public function get_tipo_documento(){
			return $this->tipo_documento;
		}
		public function set_tipo_documento($xc){
			$this->tipo_documento =$xc;
		}
		public function insert_documentos_legales_cliente($id,$usuario,$fecha){
			$sql = mysql_query("insert into docle_cliente(nombre_documento,doc,pk_cliente,usuario,fecha) values('".
			$this->get_nombre_archivo()."','".$this->get_tipo_documento()."','".$id."','".$usuario."','".$fecha."')");
		}
		
		public function listar_clientes_x_empresa($emp){
			$imp = "<option value = '0'></option>";
			$sql = mysql_query("select c.codigo_interno_cliente, c.nombre_comercial_cliente
			from clientes c, asocliemp ax
			where c.codigo_interno_cliente = ax.pk_nit_cliente_empresa_asoc and ax.pk_nit_empresa_cliente_asoc = '$emp' order by nombre_comercial_cliente asc");
			while($row = mysql_fetch_array($sql)){
				$imp.="<option value ='".$row['codigo_interno_cliente']."'>".$row['nombre_comercial_cliente']."</option>";
			}
			echo $imp;
		}
		
		public function sql_mostrar_documentos($emp,$clie){
			$sql = mysql_query("select c.codigo_interno_cliente,c.nombre_comercial_cliente, c.nit_cliente, dl.doc,dl.nombre_documento
			from clientes c, docle_cliente dl, asocliemp ax
			where dl.pk_cliente = c.codigo_interno_cliente and c.codigo_interno_cliente = ax.pk_nit_cliente_empresa_asoc and
			ax.pk_nit_empresa_cliente_asoc = '$emp' and dl.pk_cliente = '$clie' order by dl.nombre_documento asc");
			return $sql;
		}
		
		public function comprobar_contratos($clie,$empresa){
			$sql = mysql_query("select archivo_contrato from conagencias where cliente = '$clie' and empresa ='$empresa'");
			$x = 0;
			while($row = mysql_fetch_array($sql)){
				$x++;
			}
			return $x;
		}
		
		public function sql_mostrar_contratos_clientes($emp){
			$sql = mysql_query("select c.codigo_interno_cliente,c.nombre_comercial_cliente, c.nit_cliente, dl.numero_c_contrato,
			dl.archivo_contrato,dl.fcontrato,dl.ffirma,dl.fterminacion,dl.cliente,dl.empresa
			from clientes c, conagencias dl, asocliemp ax
			where dl.cliente = c.codigo_interno_cliente and c.codigo_interno_cliente = ax.pk_nit_cliente_empresa_asoc and
			ax.pk_nit_empresa_cliente_asoc = '$emp' order by c.nombre_comercial_cliente asc");
			return $sql;
		}
		
		
		public function sql_mostrar_contratos_clientes_c($id,$emp){
			$sql = mysql_query("select c.codigo_interno_cliente,c.nombre_comercial_cliente, c.nit_cliente, dl.numero_c_contrato,
			dl.archivo_contrato,dl.fcontrato,dl.ffirma,dl.fterminacion,dl.cliente,dl.empresa
			from clientes c, conagencias dl, asocliemp ax
			where dl.cliente = c.codigo_interno_cliente and c.codigo_interno_cliente = ax.pk_nit_cliente_empresa_asoc and
			c.codigo_interno_cliente = '$id' and ax.pk_nit_empresa_cliente_asoc = '$emp' order by c.nombre_comercial_cliente asc");
			return $sql;
		}
		
		
		public function validar_nit($text){
			$sql = mysql_query("select nit_cliente from clientes where nit_cliente = '$text'");
			if(mysql_num_rows($sql) == 0){
				return 0;
			}else{
				return 1;
			}
		}
		
		public function mostrar_contratos_clientes($sql){
			$est = "<table width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>NIT</th>
					<th>CLIENTE</th>
					<th>NOMBRE CONTRATO</th>
					<th>FECHA</br>CONTRATO</th>
					<th>FECHA</br>FIRMA</th>
					<th>FECHA</br>CULMINACIÓN</th>
					<th>DESCARGAR</th>
				</tr>
			";
			while($row = mysql_fetch_array($sql)){
				$id = $row['codigo_interno_cliente'];
				$name_arc = $row['archivo_contrato'];
				$datx = $row['fcontrato'];
				$dat = explode("-",$datx);
				$fecha = $this->meses[floatval($dat[1])-1]." ".$dat[2]." ".$dat[0];
				
				$dat2x = $row['ffirma'];
				$dat2 = explode("-",$dat2x);
				$fecha2 = $this->meses[floatval($dat2[1])-1]." ".$dat2[2]." ".$dat2[0];
				
				$dat3x = $row['fterminacion'];
				$dat3 = explode("-",$dat3x);
				$fecha3 = $this->meses[floatval($dat3[1])-1]." ".$dat3[2]." ".$dat3[0];
				$est.="<tr>
					<td nowrap>".($row['nit_cliente'])."</td>
					<td nowrap>".strtoupper($row['nombre_comercial_cliente'])."</td>
					<td nowrap>".strtoupper($row['numero_c_contrato'])."</td>
					<td nowrap>".strtoupper($fecha)."</td>
					<td nowrap>".strtoupper($fecha2)."</td>
					<td nowrap>".strtoupper($fecha3)."</td>
					<td align = 'center'>
						<a href = 'descargar_contratos_cliente.php?clie=$id&archivo=$name_arc'>
							<img src = '../images/iconos/icono_descarga.png' class = 'botones_opciones'>
						</a>
					</td>
				</tr>";
			}
			echo $est."</table>";
		}
		
		public function comprar_documento_subido($id,$doc){
			$sql = mysql_query("select doc from docle_cliente where pk_cliente = '$id' and doc = '$doc'");
			return mysql_num_rows($sql);
		}
		
		public function mostrar_documentos_cliente($sql){
			$est = "<table width = '100%' class = 'tablas_muestra_datos_tablas displaydoc'>
				<thead>
					<tr>
						<th>NIT</th>
						<th>CLIENTE</th>
						<th>TIPO DE DOCUMENTO</th>
						<th>DESCARGAR</th>
					</tr>
				</thead>
				<tbody>
			";
			if(mysql_num_rows($sql) == 0){
				for($ii = 0; $ii <= 10;$ii++){
					$est.="<tr>
						<td style = 'font-size:17px;padding:40px;'></td>
						<td style = 'font-size:17px;'></td>
						<td style = 'font-size:17px;'></td>
						<td style = 'font-size:17px;'></td>
					</tr>";
				}
			}else{
				while($row = mysql_fetch_array($sql)){
					$id = $row['codigo_interno_cliente'];
					$name_arc = $row['nombre_documento'];
					$tip_doc = "";
					if($row['doc'] == 1){
						$tip_doc = "RUT";
					}else if($row['doc'] == 2){
						$tip_doc = "CÁMARA DE COMERCIO";
					}else if($row['doc'] == 3){
						$tip_doc = "CERTIFICACIÓN BANCARIA";
					}else if($row['doc'] == 4){
						$tip_doc = "CÉDULA REPRESENTANTE LEGAL";
					}
					$est.="<tr>
						<td nowrap>".$row['nit_cliente']."</td>
						<td nowrap>".$row['nombre_comercial_cliente']."</td>
						<td nowrap>".$tip_doc."</td>
						<td align = 'center'>
							<a href = 'descargar_documentos_cliente.php?clie=$id&archivo=$name_arc'>
								<img src = '../images/iconos/icono_descarga.png'  width = '55px' height = 'auto'>
							</a>
						</td>
					</tr>";
				}
			}
			
			
			echo $est."</tbody></table>
				<script type = 'text/javascript'>
					$('.displaydoc').DataTable({
						'scrollY':($('#contenedor_documentos_clientes').height()-20)+'px',
						'scrollCollapse':true,
						'paging':false
					});
					$('.dataTables_filter,.dataTables_length,.dataTables_info').hide();
				</script>
			";
		}
		
		public function get_pago(){
			return $this->pago;
		}
		public function set_pago($p){
			$this->pago = $p;
		}
		public function get_impuestos(){
			return $this->impuestos;
		}
		public function set_impuestos($imp){
			$this->impuestos = $imp;
		}
		public function get_rte_fuente(){
			return $this->rfuente;
		}
		public function set_rte_fuente($r){
			$this->rfuente = $r;
		}
		public function get_uaai(){
			return $this->uaai;
		}
		public function set_uaai($ua){
			$this->uaai = $ua;
		}
		public function get_tipo_comision(){
			return $this->t_comision;
		}
		public function set_tipo_comision($tp){
			$this->t_comision = $tp;
		}
		public function get_comsion(){
			return $this->comision;
		}
		public function set_comision($c){
			$this->comision = $c;
		}
		
		public function get_tercero(){
			return $this->tercero;
		}
		public function set_tercero($x){
			$this->tercero = strtoupper($x);
		}
		public function get_cierre(){
			return $this->cierre;
		}
		public function set_cierre($x){
			$this->cierre = strtoupper($x);
		}
		
		public function update_contacto_cliente($id,$datos){
			mysql_query("update contactos_area set nombre = '".$datos[0]."', correo = '".$datos[1]."', cargo = '".$datos[2]."', telefono = '".$datos[3]."', celular = '".$datos[4]."'
			where codigo_ca = '$id'");
		}
		
		public function listar_contactos_x_cliente($clie){
			$sql = mysql_query("select codigo_ca,nombre,correo,cargo,telefono,celular,mes_nacimiento,dia_nacimiento
			from contactos_area where clientes_nit_cliente = '$clie' order by nombre asc;");
			$imp = "<table width = '100%' class = 'tablas_muestra_datos_tablas displaydocx' id ='ccdcdcd'>
				<thead>
					<tr>
						<th>NOMBRE</th>
						<th>CARGO</th>
						<th>CORREO</th>
						<th>TELÉFONO</th>
						<th>CELULAR</th>
					</tr>
				</thead>
				<tbody>";
			while($row = mysql_fetch_array($sql)){
				$id = $row['codigo_ca'];
				$imp .="<tr>
					<td nowrap id = 'nombre_c$id'>".strtoupper($row['nombre']) ."</td>
					<td nowrap id = 'cargo_c$id'>".strtoupper($row['cargo'])."</td>
					<td nowrap id = 'correo_c$id'>".strtoupper($row['correo'])."</td>
					<td id = 'telefono_c$id'>".strtoupper($row['telefono'])."</td>
					<td id = 'celular_c$id'>".strtoupper($row['celular'])."</td>
					<td align = 'center' id = 'icono_editar$id'>
						<img src = '../images/iconos/icono_editar.png' class = 'botones_opciones' onclick = 'editar_contacto_cliente($id)'/>
					</td>
				</tr>";
			}
			for($ii = 0; $ii <= 20;$ii++){
					$imp.="<tr>
						<td style = 'font-size:17px;padding:20px;'></td>
						<td style = 'font-size:17px;'></td>
						<td style = 'font-size:17px;'></td>
						<td style = 'font-size:17px;'></td>
						<td style = 'font-size:17px;'></td>
						<td style = 'font-size:17px;'></td>
					</tr>";
				}
			echo $imp."</tbody></table>";
		}
		
		public function insert_condiciones($id,$iva,$regimen,$auto){
			$sql = mysql_query("insert into condiciones_cliente(cliente,pago,refuente,reiva,uaai,regimen,auto,tipo,cierre,adicionales) values
			('".$id."','".$this->get_pago()."','".$this->get_rte_fuente()."','".$iva."','".$this->get_uaai()."','".$regimen."','".$auto."','".$this->get_tipo_comision()."','".$this->get_cierre()."','".$this->get_tercero()."')");
		}
		
		public function negociaciones_cliente($id){
			$sql = mysql_query("select * from condiciones_cliente where cliente = '$id'");
			$est = "<table width = '100%' class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>PAGA A</th>
					<th>TIPO DE COMISION</th>
					<th>VALOR COMISIÓN</th>
					<th>CIERRE DE FACTURACIÓN</th>
				</tr>
			";
			while($row = mysql_fetch_array($sql)){
				$comi = "";
				if($row['tipo'] == 1){
					$comi = "DIVIDIDA";
				}else{
					$comi = "MULTIPLICADA";
				}
				$est.="<tr >
					<td style = 'padding:10px;'>".$row['pago']." DÍAS</td>
					<td>".$comi."</td>
					<td align = 'center'>".$row['uaai']."</td>
					<td align = 'center'>".strtoupper($row['cierre'])."</td>
				</tr>";
			}
			echo $est."</table>";
		}
		
		public function get_nit_cliente(){
			return $this->nit;
		}
		public function set_nit_cliente($nnit){
			$this->nit = $nnit;
		}
		
		public function get_nlegal_cliente(){
			return $this->nlegal;
		}
		public function set_nlegal_cliente($n_nlegal){
			$this->nlegal = strtoupper($n_nlegal);
		}
		
		public function get_ncomercial_cliente(){
			return $this->ncomercial;
		}
		public function set_ncomercial_cliente($comercial){
			$this->ncomercial = strtoupper($comercial);
		}
		
		public function get_telefono_cliente(){
			return $this->telefono;
		}
		public function set_telefono_cliente($phone){
			$this->telefono = $phone;
		}
		
		public function get_direccion_cliente(){
			return $this->direccion;
		}
		public function set_direccion_cliente($direc){
			$this->direccion = strtoupper($direc);
		}
		
		
		
		public function get_ciudad_cliente(){
			return $this->ciudad;
		}
		public function set_ciudad_cliente($city){
			$this->ciudad = $city;
		}
		
		public function get_depto_cliente(){
			return $this->depto;
		}
		public function set_depto_cliente($departamento){
			$this->depto = $departamento;
		}
		
		public function get_pais_cliente(){
			return $this->pais;
		}
		public function set_pais_cliente($valor){
			$this->pais = $valor;
		}
		public function get_estado_cliente(){
			return $this->estado;
		}
		public function set_estado_cliente($est){
			$this->estado = $est;
		}
		public function get_ruta_carpeta_cliente(){
			return $this->ruta_carpeta;
		}
		public function set_ruta_carpeta_cliente($ruta){
			$this->ruta_carpeta = $ruta;
		}
		
		public function crear_cliente($id){
			$destino = "../Process/CLIENTE";
			if(file_exists($destino)){
				$destino ="../Process/CLIENTE/".$id;
				mkdir($destino);
				$destino ="../Process/CLIENTE/".$id."/DOCUMENTOS";
				mkdir($destino);
				$destino ="../Process/CLIENTE/".$id."/CONTRATOS";
				mkdir($destino);
				$this->set_ruta_carpeta_cliente($destino);
			}
			return $destino;
		}
		
		public function id_cliente($id){
			$sql = mysql_query("select codigo_interno_cliente from clientes where nit_cliente ='$id'");
			$x = "";
			while($row = mysql_fetch_array($sql)){
				$x = $row['codigo_interno_cliente'];
			}
			return $x;
		}
		
		public function insert_cliente($usuario,$fecha){
			$accion = "INSERT INTO clientes(nit_cliente,nombre_legal_clientes,nombre_comercial_cliente,telefono_cliente,direccion_cliente,usuario,fecha_registro,
			ciudad_codigo_ciudad,ciudad_departamento_codigo_departamento,ciudad_departamento_pais_codigo_pais,estado,ruta_carpeta) ";
			$accion .= "values('".$this->get_nit_cliente()."','".$this->get_nlegal_cliente()."','".
			$this->get_ncomercial_cliente()."','".$this->get_telefono_cliente()."','".$this->get_direccion_cliente()."','".$usuario."','".$fecha."','".$this->get_ciudad_cliente().
			"','".$this->get_depto_cliente()."','".$this->get_pais_cliente()."','".$this->get_estado_cliente()."','".$this->get_ruta_carpeta_cliente()."')";
			$result = mysql_query($accion);
		}
		
		public function modificar_cliente($usuario, $fecha){
			$update = "update clientes set nombre_comercial_cliente = '".$this->get_ncomercial_cliente()."', nombre_legal_clientes = '".
			$this->get_nlegal_cliente()."', telefono_cliente = '".$this->get_telefono_cliente()."', direccion_cliente = '".$this->get_direccion_cliente()."', ciudad_codigo_ciudad = '".$this->get_ciudad_cliente()."',ciudad_departamento_codigo_departamento = '".$this->get_depto_cliente()."',ciudad_departamento_pais_codigo_pais = '".$this->get_pais_cliente()."',
			usuario = '".$usuario."', fecha_registro = '".$fecha."' where nit_cliente = '".$this->get_nit_cliente()."'";
			$result = mysql_query($update);
		}
		
		public function asociar_empresas(){
			$imp = "";
			$sql = mysql_query("select cod_interno_empresa, nombre_legal_empresa from empresa where estado = '1'");
			while($row = mysql_fetch_array($sql)){
				$id = $row['cod_interno_empresa'];
												
				$imp .="<tr>
						<td width = '20%' nowrap>
							<div><input type = 'checkbox' name = 'empresas[]' id = 'empresas$id' value = '".$row['cod_interno_empresa']."' class = 'radio'/>
							<label for='empresas$id'><span><span></span></span>".$row['nombre_legal_empresa']."</label></div>
						</td>
				<td width = '15%'><input type = 'text' name = 'iniciales[]' placeholder = 'INICIALES'/></tr>";
			}
			echo $imp;
		}
		public function asociar_empresas2(){
			$imp = "";
			$sql = mysql_query("select cod_interno_empresa, nombre_legal_empresa from empresa where estado = '1'");
			while($row = mysql_fetch_array($sql)){
				$imp .="<tr><td width = '20%'><input type = 'checkbox' name = 'empresas[]' value = '".$row['cod_interno_empresa']."'/></td>
				<td nowrap>".$row['nombre_legal_empresa']."</td></tr>";
			}
			echo $imp;
		}
		public function sql_todos_clientes($emp){
			$sql = mysql_query("select c.nit_cliente,c.codigo_interno_cliente,c.nombre_comercial_cliente,c.telefono_cliente,direccion_cliente, b.nombre_ciudad,ax.estado,ax.codigo_asoc
			from clientes c, ciudad b, asocliemp ax
			where c.ciudad_codigo_ciudad = b.codigo_ciudad and c.codigo_interno_cliente = ax.pk_nit_cliente_empresa_asoc and ax.pk_nit_empresa_cliente_asoc = '$emp' ORDER BY c.nombre_comercial_cliente asc");
			return $sql;
		}
		
		public function sql_clientes_nit($id,$emp){
			$sql = mysql_query("select c.nit_cliente,c.codigo_interno_cliente,c.nombre_comercial_cliente,c.telefono_cliente,direccion_cliente, b.nombre_ciudad,ax.estado,ax.codigo_asoc
			from clientes c, ciudad b,asocliemp ax
			where c.ciudad_codigo_ciudad = b.codigo_ciudad and c.nit_cliente like '%$id%'
			and c.codigo_interno_cliente = ax.pk_nit_cliente_empresa_asoc and ax.pk_nit_empresa_cliente_asoc = '$emp' order by c.nombre_comercial_cliente asc");
			return $sql;
		}
		
		public function sql_clientes_comercial($id,$emp){
			$sql = mysql_query("select c.nit_cliente,c.codigo_interno_cliente,c.nombre_comercial_cliente,c.telefono_cliente,direccion_cliente, b.nombre_ciudad,ax.estado,ax.codigo_asoc
			from clientes c, ciudad b, asocliemp ax
			where c.ciudad_codigo_ciudad = b.codigo_ciudad and c.nombre_comercial_cliente like '%$id%'
			and c.codigo_interno_cliente = ax.pk_nit_cliente_empresa_asoc and ax.pk_nit_empresa_cliente_asoc = '$emp' order by c.nombre_comercial_cliente asc");
			return $sql;
		}
		
		public function sql_clientes_id($id){
			$sql = mysql_query("select c.nit_cliente,c.codigo_interno_cliente,c.nombre_comercial_cliente,c.telefono_cliente,direccion_cliente, b.nombre_ciudad,ax.estado,ax.codigo_asoc
			from clientes c, ciudad b, asocliemp ax
			where c.ciudad_codigo_ciudad = b.codigo_ciudad and c.codigo_interno_cliente = '$id'
			and c.codigo_interno_cliente = ax.pk_nit_cliente_empresa_asoc order by c.nombre_comercial_cliente asc");
			return $sql;
		}
		
		public function update_estado_cliente($id,$est,$emp){
			if($est == 1){
				$est = 0;
			}else{
				$est = 1;
			}
			$update = mysql_query("update asocliemp set estado = '$est' where codigo_asoc = '$id'");
			$this->mostrar_tabla_basica_clientes($this->sql_todos_clientes($emp));
		}
		
		public function info_basica_cliente_ubicacion($id){
			$sql = mysql_query("select ci.ciudad_departamento_codigo_departamento, ci.ciudad_codigo_ciudad,p.nombre_pais, d.nombre_departamento, c.nombre_ciudad,
			ci.ciudad_departamento_pais_codigo_pais
			from clientes ci, ciudad c, departamento d, pais p
			where ci.codigo_interno_cliente = '$id' and ci.ciudad_codigo_ciudad = c.codigo_ciudad and 
			c.departamento_codigo_departamento = d.codigo_departamento and d.pais_codigo_pais = p.codigo_pais order by ci.nombre_comercial_cliente asc");
			return $sql;
		}
		
		public function paises($id){
			$imp = "";
			$x = "";
			$sql = mysql_query("select nombre_pais, codigo_pais from pais");
			while($row = mysql_fetch_array($sql)){
				if($id == $row['codigo_pais']){
					$x = "<option value = '$id' selected>".$row['nombre_pais']."</option>";
				}else{
					$imp .= "<option value = '".$row['codigo_pais']."'>".$row['nombre_pais']."</option>";
				}
			}
			return $x.$imp;
		}
				
		public function editar_info_basica_cliente($id,$sql_ubicacion,$empresa,$emp){
			$ubicacion = "";
			if(mysql_num_rows($sql_ubicacion) == 0){
				$ubicacion .="
					<td><select id = 'n_pais_empresax' onchange = 'cambiar_pais_empresa()' onclick = 'limpiar_pais(".$row['ciudad_departamento_pais_codigo_pais'].")'>".$this->paises(0)."</select></td>
					<td><select id = 'n_depto_empresax' onchange = 'cargar_ciudad()'><option value = '0'>-</option></td>
					<td><select id = 'n_ciudad_empresax'><option value = '0'>-</option></td>
				";
			}else{
				while($row = mysql_fetch_array($sql_ubicacion)){
					$ubicacion .="
					<td><select id = 'n_pais_empresax' onchange = 'cambiar_pais_empresa()' onclick = 'limpiar_pais(".$row['ciudad_departamento_pais_codigo_pais'].")'>".$this->paises($row['ciudad_departamento_pais_codigo_pais'])."</select></td>
					<td><select id = 'n_depto_empresax' onchange = 'cargar_ciudad()'><option value = '".$row['ciudad_departamento_codigo_departamento']."'>".$row['nombre_departamento']."</option></td>
					<td><select id = 'n_ciudad_empresax'><option value = '".$row['ciudad_codigo_ciudad']."'>".$row['nombre_ciudad']."</option></td>";
				}
			}	
			$sql = mysql_query("select c.codigo_interno_cliente,c.nit_cliente, c.nombre_comercial_cliente,c.nombre_legal_clientes,c.telefono_cliente,c.direccion_cliente
			from clientes c where c.codigo_interno_cliente = '$id'");
			$tabla = "<div class ='scroll_nueva_ventana'>";
			while($row = mysql_fetch_array($sql)){
				$tabla.= "
				<table width = '100%' style = 'padding-right:50px;padding-left:50px;'>
					<tr>
						<td width = '96%' align = 'left'> 
							<table width = '100%' >
								<tr>
									<td align = 'left'>
										".$empresa->mostrar_logo_empresa2($emp)."
									</td>
								</tr>
								<tr>
									<td align = 'left' >
										<span class = 'mensaje_bienvenida'>DATOS CLIENTE</span>
									</td>
								</tr>
							</table>
						</td>
						<td align = 'right'>
							<table width = '100%'>
								<tr>
									<td style = 'border:1px solid blue;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;'  >
										<img  src = '../images/iconos/icono_editar.png' class = 'iconos_opciones'/>
									</td>
									<td>
										<img  src = '../images/iconos/cerrar.png' onclick = 'cerrar_ventana_info_por_cliente()' class = 'iconos_opciones'/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					</table>					
					</br>
					<table width = '100%' class = 'tabla_nuevos_datos2'>
						<tr>
							<th align = 'left' width = '49%' colspan = '2' style = 'padding-left:50px;'>LEGALES</th>
							<th class = 'separator'></th>
							<th nowrap align = 'left' width = '48%'colspan = '2' >UBICACIÓN</th>
						</tr>
						<tr>
							<td colspan  = '2' style = 'padding-left:50px;'>
								<p>Nombre Legal:</p>
								<input type = 'text' value = '".$row['nombre_legal_clientes']."' id = 'e_nombre_legal_cliente'/>
							</td>
							<td class = 'separator'></td>
							<td colspan = '2' >
								<table width = '100%'>
									<tr>
										<td><p>País:</p></td>
										<td><p>Departamento:</p></td>
										<td><p>Ciudad:</p></td>
									</tr>
									<tr>
										$ubicacion
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan = '2' style = 'padding-left:50px;' >
								<p>Nombre Comercial:</p>
								<input type = 'text' value = '".$row['nombre_comercial_cliente']."' id = 'e_ncomercial_cliente' />
							</td>
							<td class = 'separator'></td>
							<td >
								<p>Teléfono:</p>
								<input type = 'text' value = '".$row['telefono_cliente']."' id = 'e_phone_cliente'/>
							</td>
							<td >
								<p>Dirección:</p>
								<input type = 'text' value = '".$row['direccion_cliente']."' id = 'e_direccion_cliente'/>
							</td>
						</tr>
						<tr>
							<td colspan = '2' style = 'padding-left:50px;'>
								<p>NIT:</p>
								<input type = 'text' value = '".$row['nit_cliente']."' id = 'e_nit_cliente' readonly/>
							</td>
							<td class = 'separator'></td>
						</tr>
						<tr><td></br></td></tr>
						<tr><td colspan = '2'><table width = '100%'>";
				$codigos_empresa = "";
				$sql_asoc = mysql_query("select e.nombre_comercial_empresa, ax.inicial_cliente_asoc,e.cod_interno_empresa
				from empresa e, asocliemp ax
				where e.cod_interno_empresa = ax.pk_nit_empresa_cliente_asoc and ax.pk_nit_cliente_empresa_asoc = '$id'");
				while($xrow = mysql_fetch_array($sql_asoc)){
					$xcd = $xrow['cod_interno_empresa'];
					$codigos_empresa .= "and cod_interno_empresa <> '$xcd'";
					$tabla.="<tr>
						<td style = 'padding-left:50px;'>
							<div><input type = 'checkbox' id = 'empresas$id' value = value = '".$xrow['cod_interno_empresa']."' class = 'radio' checked/>
							<label for='empresas$id'><span><span></span></span>".$xrow['nombre_comercial_empresa']."</label></div>
						</td>
						<td width = '15%' align = 'left'> <input type = 'text' value = '".$xrow['inicial_cliente_asoc']."' readonly style = 'text-align:center;'/> </td>
					</tr>";
				}
				
				$sql_asoc = mysql_query("select nombre_comercial_empresa,cod_interno_empresa
				from empresa 
				where estado = '1' $codigos_empresa");
				while($xrow = mysql_fetch_array($sql_asoc)){
					$ide = $xrow['cod_interno_empresa'];
					$tabla.="<tr>
						<td style = 'padding-left:50px;'>
							<div><input type = 'checkbox' name = 'empresasx[]' id = 'empresasx$ide' value = '".$xrow['cod_interno_empresa']."' class = 'radio'/>
							<label for='empresasx$ide'><span><span></span></span>".$xrow['nombre_comercial_empresa']."</label></div>
						</td>
						<td width = '15%' > <input type = 'text' name = 'inicialesx[]' placeholder = 'INICIALES' value = '' /> </td>
					</tr>";
				}
				$tabla.="</table></td></tr>
					<tr>
						<td colspan = '5' align = 'center'>
							<img src = '../images/iconos/guardar_2.png' class = 'mano iconos_guardar'  onclick = 'visualizar_informacion_cliente($id)' style = 'position:relative;'>
							<img src = '../images/iconos/guardar_1.png' class = 'iconos_guardar_x'   style = 'position:relative;top:45px;left:-50px;z-index:1;opacity:'>
							<img src = '../images/iconos/guardar_3.png' class = 'mano iconos_guardar'  onclick = 'update_info_cliente($id)'  style = 'position:relative;left:-110px;'>
						</td>
					</tr>";
				echo $tabla."</table></div>";
			}
		}
		
		public function ver_informacion_cliente($id,$empresa,$emp){
			$sql = mysql_query("select c.codigo_interno_cliente,c.nit_cliente, c.nombre_comercial_cliente,c.nombre_legal_clientes,c.telefono_cliente,c.direccion_cliente, ci.nombre_ciudad, d.nombre_departamento, p.nombre_pais
			from clientes c, ciudad ci, departamento d, pais p
			where c.codigo_interno_cliente = '$id' and c.ciudad_codigo_ciudad = ci.codigo_ciudad and ci.departamento_codigo_departamento = d.codigo_departamento and d.pais_codigo_pais = p.codigo_pais");
			
			$tabla = "";
			while($row = mysql_fetch_array($sql)){
				
				$tabla.= "
					<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
						<tr>
							<td width = '96%' align = 'left'>
								<table width = '100%' >
									<tr>
										<td align = 'left'>
											".$empresa->mostrar_logo_empresa2($emp)."
										</td>
									</tr>
									<tr>
										<td align = 'left' >
											<span class = 'mensaje_bienvenida'>DATOS CLIENTE</span>
										</td>
									</tr>
								</table>
							</td>
							<td align = 'right' >
								<table width = '100%' rowspan = '2'>
									<tr>
										<td align = 'center'>
											<img  src = '../images/iconos/icono_editar.png' onclick = 'editar_info_basica_cliente($id)' class = 'iconos_opciones'/>
										</td>
										<td align = 'center'>
											<img  src = '../images/iconos/cerrar.png' onclick = 'cerrar_ventana_info_por_cliente()' class = 'iconos_opciones'/>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>					
					</br>
					<table width = '100%' class = 'tabla_nuevos_datos' style = 'padding-right:50px;'>
						<tr>
							<th align = 'left' width = '49%' colspan = '2' style = 'padding-left:50px;'>LEGALES</th>
							<th class = 'separator'></th>
							<th nowrap align = 'left' width = '48%'colspan = '2' >UBICACIÓN</th>
						</tr>
						<tr>
							<td colspan  = '2' style = 'padding-left:50px;'>
								<p>Nombre Legal:</p>
								<input type = 'text' value = '".$row['nombre_legal_clientes']."' class = 'entradas_bordes' readonly />
							</td>
							<td class = 'separator'></td>
							<td colspan = '2' >
								<p>País - Departamento - Ciudad</p>
								<input type = 'text' value = '".$row['nombre_pais']."-".$row['nombre_departamento']."-".$row['nombre_ciudad']."' style = 'width:100%;' class = 'entradas_bordes' readonly/>
							</td>
						</tr>
						<tr>
							<td colspan = '2' style = 'padding-left:50px;' >
								<p>Nombre Comercial:</p>
								<input type = 'text' value = '".$row['nombre_comercial_cliente']."' readonly/>
							</td>
							<td class = 'separator'></td>
							<td >
								<p>Teléfono:</p>
								<input type = 'text' value = '".$row['telefono_cliente']."' style = 'width:100%;' readonly/>
							</td>
							<td style = 'padding-left:50px;'>
								<p>Dirección:</p>
								<input type = 'text' value = '".$row['direccion_cliente']."' style = 'width:100%;' readonly/>
							</td>
						</tr>
						<tr>
							<td colspan = '2' style = 'padding-left:50px;'>
								<p>NIT:</p>
								<input type = 'text' value = '".$row['nit_cliente']."'readonly/>
							</td>
							<td class = 'separator'></td>
						</tr>
						<tr><td></br></td></tr>
						<tr><td colspan = '2'><table width = '100%'>";
				$sql_asoc = mysql_query("select e.nombre_comercial_empresa, ax.inicial_cliente_asoc 
				from empresa e, asocliemp ax
				where e.cod_interno_empresa = ax.pk_nit_empresa_cliente_asoc and ax.pk_nit_cliente_empresa_asoc = '$id'");
				while($xrow = mysql_fetch_array($sql_asoc)){
					$tabla.="<tr>
						<td style = 'padding-left:50px;'>".$xrow['nombre_comercial_empresa']."</td>
						<td width = '15%' align = 'left' > 
							<input type = 'text' value = '".$xrow['inicial_cliente_asoc']."' readonly style = 'text-align:center;'/> 
						</td>
					</tr>";
				}
				echo $tabla."</table></td></tr></table>";
			}
		}
		
		public function mostrar_tabla_basica_clientes($sql){
			$est = "<table width = '100%' class = 'tablas_muestra_datos_tablas displaycu'  >
				<thead>
					<tr>
						<th>NIT</th>
						<th>NOMBRE COMERCIAL</th>
						<th>TELÉFONO</th>
						<th>DIRECCIÓN</th>
						<th>CIUDAD</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					";
			while($row = mysql_fetch_array($sql)){
				$id_asoc = $row['codigo_asoc'];
				$codigo = $row['codigo_interno_cliente'];
				$img = "";
				$estx = $row['estado'];
				if($row['estado'] == 1){
					$img = "activo.png";
				}else{
					$img = "inactivo.png";
				}
				//onclick = 'mostrar_informacion_detallada_cliente($codigo)'
				$est.="
				<tr id = '$codigo'>
					<td align = 'center' nowrap >".$row['nit_cliente']."</td>
					<td style = 'padding-left:10px;' onclick = 'visualizar_informacion_cliente($codigo)' class = 'mano' nowrap>".$row['nombre_comercial_cliente']."</td>
					<td style = 'padding-left:10px;'nowrap>".$row['telefono_cliente']."</td>
					<td style = 'padding-left:10px;'nowrap>".$row['direccion_cliente']."</td>
					<td style = 'padding-left:10px;'nowrap>".$row['nombre_ciudad']."</td>
					<td align = 'center'>
						<img src = '../images/iconos/$img' class = 'botones_opciones' onclick ='editar_estado_cliente($id_asoc,$estx)'/>
					</td>
					<td>
						<img src = '../images/iconos/icono_documento.png' class = 'botones_opciones' onclick = 'abrir_documentos_empleados($codigo)'/>
					</td>
				</tr>";
			}
			
			$est.="</tbody></table>
				<script type = 'text/javascript'>
					$('.displaycu').DataTable({
						'scrollY':($('.contenedor_info_tablas').height()-40)+'px',
						'scrollCollapse':true,
						'paging':false
					});
					$('.dataTables_filter,.dataTables_length,.dataTables_info').hide();
				</script>";
			echo $est;
			
		}
		
		public function sql_estructura_completa_info_cliente($id){
			$sql = mysql_query("select c.codigo_interno_cliente, c.nit_cliente, c.nombre_comercial_cliente, c.nombre_legal_clientes, c.direccion_cliente,
			c.telefono_cliente, b.nombre_ciudad from clientes c, ciudad b
			where c.ciudad_codigo_ciudad = b.codigo_ciudad and c.codigo_interno_cliente = '$id' order by c.nombre_comercial_cliente asc");
			return $sql;
		}
		
		public function estructura_tabla_info_completa_cliente($sql){
			$est = "
				<table width = '100%'>
						<th width = '96%'>
							<span class = 'titulo_nueva_ventana'>INFORMACIÓN CLIENTE</span>
						</th>
						<th align = 'right'>
							<img id = 'c_v_info_cliente' onclick = 'cerrar_info_cliente()' src = '../images/iconos/cerrar.png' width = '30px' height = '30px'/>
						</th>
					</table>
					</br>
			<table width ='100%'>
				<tr>
					<th class = 'bordes_nomina'>CLIENTE</th>
					<th class = 'bordes_nomina'>NIT</th>
					<th></th>
					<th class = 'bordes_nomina'>DIRECCIÓN</th>
					<th class = 'bordes_nomina'>CIUDAD</th>
					<th colspan = '4' class = 'bordes_nomina'>CONTACTOS</th>
					<th class = 'bordes_nomina'>PAGO</th>
					<th class = 'bordes_nomina'>RTE FUENTE</th>
					<th class = 'bordes_nomina'>TOTAL IMPUESTOS</th>
					<th class = 'bordes_nomina'>COMISION</th>
					<th class = 'bordes_nomina'>CIERRE FACT.</th>
					<th class = 'bordes_nomina'>COMISION TERC.</th>
				</tr>
			";
			$t = 0;
			while($row = mysql_fetch_array($sql)){
				$cliente = $row['codigo_interno_cliente'];
				$sql2 = mysql_query("select ct.nombre, ct.cargo, ct.celular,ct.correo, ct.telefono,ct.mes_nacimiento,ct.dia_nacimiento, ct.clientes_nit_cliente
				from contactos_area ct where ct.clientes_nit_cliente = '$cliente'");
				$rowspan = mysql_num_rows($sql2)+1;
				$t = $rowspan;
				$nombre_cliente = $row['nombre_legal_clientes']." / ".$row['nombre_comercial_cliente'];
				$est.="<tr>
						<td height = '100%'class = 'bordes_nomina' rowspan = '$rowspan'><strong>".$nombre_cliente."</strong></td>
						<td nowrap class = 'bordes_nomina' rowspan = '$rowspan'>".$row['nit_cliente']."</td>
						<td rowspan = '$rowspan'></td>
						<td class = 'bordes_nomina' rowspan = '$rowspan'>".$row['direccion_cliente']."</td>
						<td class = 'bordes_nomina' rowspan = '$rowspan'>".$row['nombre_ciudad']."</td>
						<td colspan = '4'>
							<table width = '100%'>
								<tr>
									<th class = 'bordes_nomina'>NOMBRE</th>
									<th class = 'bordes_nomina'>CARGO</th>
									<th class = 'bordes_nomina'>TELEFONO</th>
									<th class = 'bordes_nomina'>CELULAR</th>
								</tr>";
				while($rr = mysql_fetch_array($sql2)){
					$est.="<tr>
							<td class = 'bordes_nomina'>".$rr['nombre']."</td>
							<td class = 'bordes_nomina'>".$rr['cargo']."</td>
							<td class = 'bordes_nomina'>".$rr['telefono']."</td>
							<td class = 'bordes_nomina'>".$rr['celular']."</td></tr>";
				}
				$est.="</table>";
			}
			$sql3 = mysql_query("select pago,impuestos,refuente,uaai,tipo,cterceros,cierre from condiciones_cliente where cliente = '$cliente'");
				while($rr = mysql_fetch_array($sql3)){
					$comision = "";
					if($rr['tipo'] == 1){
						$comision = "MULTIPLICADA";
					}else{
						$comision = "DIVIDIDA";
					}
					$est.="<td align = 'center' class = 'bordes_nomina' rowspan = '$t'>".$rr['pago']."</td>
							<td align = 'center' class = 'bordes_nomina' rowspan = '$t'>".$rr['refuente']."</td>
							<td align = 'center' class = 'bordes_nomina' rowspan = '$t'>".$rr['impuestos']."</td>
							<td align = 'center' class = 'bordes_nomina' rowspan = '$t' nowrap>".$comision." ".$rr['uaai']."</td>
							<td align = 'center' class = 'bordes_nomina' rowspan = '$t' nowrap>".$rr['cierre']."</td>
							<td align = 'center' class = 'bordes_nomina' rowspan = '$t' nowrap>".$rr['cterceros']."</td></tr>";
				}
			echo $est."</table>";
		}
		
		public function eliminar_cliente(){
			
		}

	}

?>

