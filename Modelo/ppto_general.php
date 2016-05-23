<?php
	class ppto_general{
		
		public $valor;
		public $mes;
		public $ppto;
		public $item;
		public $un;
		
		
		//Grupossalario_base_empleado_real
		public $name_grupo;
		
		//Items
		public $item2;
		public $valor2;
		
		public function get_item2(){
			return $this->item2;
		}
		public function set_item2($i){
			$this->item2 = strtoupper($i);
		}
		public function get_valor2(){
			return $this->valor2;
		}
		public function set_valor2($x){
			$this->valor2 = $x;
		}
		
		public function consultar_ultimo_item(){
			$sql = mysql_query("select max(id) as id from i_ppto_general");
			$x = "";
			while($row = mysql_fetch_array($sql)){
				$x = $row['id'];
			}
			return $x;
		}
		
		public function insert_valor_item($grupo){
			$sql = mysql_query("insert into i_ppto_general(name,valor,pk_grupo) values('".$this->get_item2()."','".$this->get_valor2()."','".$grupo."')");
		}
		public function update_valor_item($id){
			$sql = mysql_query("update i_ppto_general set valor = '".$this->get_valor()."' where id = '$id'");
		}
		
		public function get_nombre_grupo(){
			return $this->name_grupo;
		}
		public function set_nombre_grupo($n){
			$this->name_grupo = strtoupper($n);
		}
		
		public function insert_grupo_x_unidad(){
			$sql = mysql_query("insert into g_ppto_general(name) values('".$this->get_nombre_grupo()."')");
		}
		
		
		public function listar_grupos(){
			$sql = mysql_query("select distinct g.name as nombre_grupo, g.id as codigo_grupo 
			from g_ppto_general g, c_ppto_general c, i_ppto_general i
			where c.item = i.id and i.pk_grupo = g.id order by g.name asc");
			$imp = "<option value = '0'></option>";
			while($row = mysql_fetch_array($sql)){
				$imp .= "<option value ='".$row['codigo_grupo']."'>".$row['nombre_grupo']."</option>";
			}
			echo $imp;
		}
		
		
		public function grupos_sistema(){
			$sql = mysql_query("select id,name from g_ppto_general");
			$imp = "<option value = '0'></option>";
			while($row = mysql_fetch_array($sql)){
				$imp .= "<option value ='".$row['id']."'>".$row['name']."</option>";
			}
			echo $imp;
		}
		
		public function listar_grupos_pptos_general(){
			$sql = mysql_query("select id,name from g_ppto_general");
			$tabla = "<table class = 'tablas_muestra_datos_tablas'>
				<tr>
					<th>Nombre</th>
					<th></th>
				</tr>";
			while($row = mysql_fetch_array($sql)){
				$id = $row['id'];
				$tabla.="<tr>
					<td id = 'campo$id'>".$row['name']."</td>
					<td>
						<img src = '../images/iconos/editar.png' height = '50px' onclick = 'modificar_nombre_grupo_ppto_general(".$row['id'].")'/>
					</td>
				</tr>";
			}
			return $tabla."</table>";
		}
		
		public function listar_all_grupos_ppto_general(){
			$imp = "<option value = '0'>[SELECCIONE]</option>";
			$sql = mysql_query("select id,name from g_ppto_general order by name asc");
			while($row = mysql_fetch_array($sql)){
				$imp.="<option value ='".$row['id']."'>".$row['name']."</option>";
			}
			return $imp;
		}
		public function menu_ppto_general($und,$emp,$alto){
			$alto = $alto-200;
			$table  = "<table width = '100%' class = 'barra_busqueda contenido_hijos_hijos' style = 'height:".$alto."px;'>
				<tr class = 'consultar_ppto_general' align = 'center'>
					<td  >
						<p>Seleccione una Unidad de Negocio:</p>
						<select id = 'und_ppto_general_consulta' onchange = 'buscar_ano_ppto_general_und()'>$und</select>
					</td>
					<td>
						<p>Seleccione el Año:</p>
						<select id = 'ano_und_ppto_general_consulta' onchange = 'cambiar_imagen_ano_ppto()'></select>
					</td>	
				</tr>
				</table>
				<table width = '100%' >
					<tr>
						<td align = 'right' id = 'generar_ppto_general_id'>
							<img src = '../images/iconos/generar_apagado.png'  height = '150px'/>
						</td>
					</tr>
				</table>";
				echo $table;
		}
		public function menu_administrar_pptos_general($und,$grupos,$emp){
			$impri = "<option value = ''>PERIODO</option>";
			$sql = mysql_query("select distinct periodo from tablas_empleados where empresa = '$emp'");
			$val1 ='"val_item_grupo"';
			$val2 ='"text_valor_item_grupo"';
			while($row = mysql_fetch_array($sql)){
				$impri .= "<option value = '".$row['periodo']."'>".$row['periodo']."</option>";
			}
			$table = "<table width = '100%' style = 'border-spacing:5px;' height:'100%'>
				
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' onclick = 'ocultar_hijos_ppto_anual()'>
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano'>CREAR PPTO ANUAL</td>
							<td align = 'left' ><img src = '../images/iconos/mas_blanco.png' width = '30px' /></td>
						</table>
					</th>
				</tr>
				<tr class = 'hijo_nuevo_ppto' >
					<td style = 'padding-left:30px;'>
						<table width = '100%' class = 'barra_busqueda titulos_hijo_p'>
							<tr>
								<td align = 'left' style = 'padding-left:15px;' >
									<p style = 'color:white;'>Seleccione una Unidad de Negocio:</p>
									<select id = 'und_ppto_nuevo'>$und</select>
								</td>
							</tr>
							<tr><td></br></td></tr>
							<tr>
								<td>
									<span class = 'botton_verde' onclick = 'crear_ppto_general_und()'>CREAR PPTO</span>
								</td>
							</tr>
							<tr><td></br></td></tr>							
						</table>
					</td>
				</tr>
				
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' onclick = 'ocultar_hijos_grupo_ppto_anual();ocultar_hijos_grupo_ppto()'>
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano'>NUEVO GRUPO</td>
							<td align = 'left' ><img src = '../images/iconos/mas_blanco.png' width = '30px' /></td>
						</table>
					</th>
				</tr>
				<tr class = 'hijo_nuevo_grupo_ppto' >
					<td style = 'padding-left:30px;'>
						<table width = '100%' >
							<tr class = 'hijo_add_grupo'>
								<td style = 'padding-left:30px;'>
									<table width = '100%' class = 'barra_busqueda contenido_hijos_hijos'>
										<tr>
											<td>
												<p>Ingrese el Nombre del Grupo:</p>
												<input type = 'text' id = 'name_grupo_ppto_general' />
											</td>
										</tr>
										<tr><td></br></td></tr>
										<tr>
											<td>
												<span class = 'botton_verde' onclick = 'crear_grupo_ppto_general()'>CREAR GRUPO</span>
											</td>
										</tr>
										<tr><td></br></td></tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				
				<tr>
					<th class='titulos_gestion_azul_x' align = 'left' id = 'ppto_anual_nuevo' onclick = 'ocultar_hijos_items_ppto_general()'>
						<table width = '100%'>
							<td align = 'center' style = 'vertical-align:middle;width:96%' class = 'mano'>NUEVO ITEM</td>
							<td align = 'left' ><img src = '../images/iconos/mas_blanco.png' width = '30px' /></td>
						</table>
					</th>
				</tr>
				<tr class = 'hijos_items_pppto_general' >
					<td style = 'padding-left:30px;'>
						<table width = '100%' class = 'barra_busqueda contenido_hijos_hijos'>
							<tr>
								<td>
									<p>Seleccione un Grupo:</p>
									<select id = 'listado_grupos_ppto_general'>$grupos</select>
								</td>
								<td>
									<p>Ingrese el nombre del Item:</p>
									<input type = 'text' id = 'name_item_grupo' />
								</td>
							</tr>
							<tr>
								<td>
									<p>Ingrese el Valor Presupuestado del Item:</p>
									<input type = 'text' id = 'val_item_grupo' onkeyup = 'formatear_valor(event,$val1,$val2)' />
									<span class = 'hidde' id = 'text_valor_item_grupo'></span>
								</td>
							</tr>
							<tr><td></br></td></tr>
							<tr>
								<td>
									<span class = 'botton_verde' onclick = 'agregar_item_grupo_ppto_general()'>CREAR ITEM</span>
								</td>
							</tr>
							<tr><td></br></td></tr>
						</table>
					</td>
				</tr>
				
			</table>";
			echo $table;
		}
		
		public function get_und(){
			return $this->un;
		}
		public function set_und($t){
			$this->un = $t;
		}
		
		public function get_item(){
			return $this->item;
		}
		public function set_item($i){
			$this->item = $i;
		}
		
		public function get_ppto(){
			return $this->ppto;
		}
		public function set_ppto($p){
			$this->ppto = $p;
		}
		public function get_mes(){
			return $this->mes;
		}
		public function set_mes($m){
			$this->mes = $m;
		}
		
		public function get_valor(){
			return $this->valor;
		}
		
		public function set_valor($x){
			$this->valor = $x;
		}
		
		
		public function select_grupos_x_unidad($und){
			$imp = "<option value = '0'></option>";
			$sql = mysql_query("select id, name from g_ppto_general where und = '$und'");
			while($row = mysql_fetch_array($sql)){
				$imp .= "<option value ='".$row['id']."'>".$row['name']."</option>";
			}
			echo $imp;
		}
		
		public function consulta_ppto($und){
			$imp = "<option value = '0'></option>";
			$year = date("Y");
			$sql = mysql_query("select id from ppto_general where und = '$und' and year = '$year'");
			if(mysql_num_rows($sql) == 0){
				$this->insert_nuevo_ppto();
				echo 1;
			}else{
				echo 0;
			}
		}
		
		public function unidades_negocio_pptos($emp){
			$imp = "<option value = '0'></option>";
			$sql = mysql_query("select distinct u.id,u.name
			from und u, ppto_general p
			where p.und = u.id and u.empresa = '$emp'");
			while($row = mysql_fetch_array($sql)){
				$imp .= "<option value ='".$row['id']."'>".$row['name']."</option>";
			}
			echo $imp;
		}
		
		public function listar_item_x_grupo_und($grupo,$und){
			$x = "<table width = '100%'>";
			$sql = mysql_query("select i_ppto_general.id,i_ppto_general.name,i_ppto_general.valor, item_x_ppto_general.ppto
			from i_ppto_general
			left outer join item_x_ppto_general on item_x_ppto_general.item = i_ppto_general .id
			where item_x_ppto_general.ppto is null and i_ppto_general.pk_grupo = '$grupo'");
			while($row = mysql_fetch_array($sql)){
				$x .="<tr>
						<td>
							<input type ='checkbox' name = 'items_ppto[]' value = '".$row['id']."'/>
						</td>
						<td>".$row['name']."</td>
						<td>".number_format($row['valor'])."</td>
					</tr>";
			}
			$y = date("Y");
			$sql = mysql_query("select ppto.id 
			from ppto_general ppto, und u
			where u.id = ppto.und and u.id = '$und' and ppto.year = '$y'");
			while($row = mysql_fetch_array($sql)){
				$x.="</table>$$$$".$row['id'];
			}
			echo $x;
		}
		
		public function insert_item_x_ppto($id,$ppto){
			$valor_pptado = 0;
			$sqlx = mysql_query("select valor from i_ppto_general where id = '$id'");
			while($row = mysql_fetch_array($sqlx)){
				$valor_pptado = $row['valor'];
				$sql = mysql_query("insert into item_x_ppto_general(item,valor,ppto) values('".$id."','".$row['valor']."','".$ppto."')");
			}
			$valor = 0;
			
			$mes_actual = date("m");
			for($ii = $mes_actual; $ii <=12;$ii++){
				$sql = mysql_query("insert into c_ppto_general(item,mes,ppto,valor,pptado_item) values
				('".$id."','".$ii."','".$ppto."','".$valor."','".$valor_pptado."')");
			}
		}
		
		public function insert_nuevo_ppto(){
			$sql = mysql_query("insert into ppto_general(year,fecha,und) values('".date("Y")."','".date("Y-m-d")."','".$this->get_und()."')");
			$sql = mysql_query("select max(id) as id from ppto_general");
			while($row = mysql_fetch_array($sql)){
				for($i = 1; $i <= 12;$i++){
					mysql_query("insert into ppto_mensual_ppto_general(ppto,year,mes) values('".$row['id']."','".date("Y")."','".$i."')");
				}
			}
		}
		
		public function update_valor_mes_pptado($id,$valor){
			mysql_query("update c_ppto_general set pptado_item = '$valor' where id = '$id'");
		}
		
		public function consulta_accion($id,$mes,$ppto){
			$sql = mysql_query("select id from c_ppto_general where item = '$id' and mes = '$mes' and ppto = '$ppto'");
			if(mysql_num_rows($sql) == 0){
				$this->insert_item();
			}else{
				$this->modificar_valor();
			}
		}
		
		public function insert_item(){
			$sql = mysql_query("insert into c_ppto_general(item,mes,valor,ppto) values 
			('".$this->get_item()."','".$this->get_mes()."','".$this->get_valor()."','".$this->get_ppto()."')");
		}
		
		public function modificar_valor(){
			$sql = mysql_query("update c_ppto_general set valor = '".$this->get_valor()."' where 
			item = '".$this->get_item()."' and mes = '".$this->get_mes()."' and ppto = '".$this->get_ppto()."'");
		}
		
		public function estructura(){
			$est = "
			<table class = 'tablas_muestra_datos_tablas' style = 'padding-left:50px;'>
				<tr><td colspan = '3'id = 'editable' ondblclick = 'agregar_item_ppto()'>HAGA DOBLE CLICK PARA AGREGAR UN ITEM</td></tr>
			</table>
			<table width = '100%' id = 'tabla_ppto' class = 'xxdisplay'>
				<thead>
					<tr>
						<td></td>
						<th colspan = '3' class = 'titulo_ppto_general_concepto'>GASTOS ADMINISTRATIVOS</th>
						<th class = 'separator'></th>
						<th colspan = '2'class = 'mesx1'>ENERO</th>
						<th class = 'separator mesx1'></th>
						<th colspan = '2'class = 'mesx2'>FEBRERO</th>
						<th class = 'separator mesx2'></th>
						<th colspan = '2'class = 'mesx3'>MARZO</th>
						<th class = 'separator mesx3'></th>
						<th colspan = '2'class = 'mesx4'>ABRIL</th>
						<th class = 'separator mesx4'></th>
						<th colspan = '2'class = 'mesx5'>MAYO</th>
						<th class = 'separator mesx5'></th>
						<th colspan = '2'class = 'mesx6'>JUNIO</th>
						<th class = 'separator mesx6'></th>
						<th colspan = '2'class = 'mesx7'>JULIO</th>
						<th class = 'separator mesx7'></th>
						<th colspan = '2'class = 'mesx8'>AGOSTO</th>
						<th class = 'separator mesx8'></th>
						<th colspan = '2'class = 'mesx9'>SEPTIEMBRE</th>
						<th class = 'separator mesx9'></th>
						<th colspan = '2'class = 'mesx10'>OCTUBRE</th>
						<th class = 'separator mesx10'></th>
						<th colspan = '2'class = 'mesx11'>NOVIEMBRE</th>
						<th class = 'separator mesx11'></th>
						<th colspan = '2'class = 'mesx12'>DICIEMBRE</th>
						<th class = 'separator mesx12'></th>
						<th colspan = '2'class = ''>TOTAL</th>
					</tr>
					<tr>
						<td></td>
						<th class = 'subtitulos_columnas'  nowrap>COSTOS FIJOS</th>
						<th class = 'subtitulos_columnas'>%</th>
						<th class = 'subtitulos_columnas'>PRESUPUESTO AÑO ".date("Y")."</th>
						<th class = 'separator'></th>
						<th class = 'subtitulos_columnas mesx1'>PRESUPUESTADO</th>
						<th class = 'subtitulos_columnas mesx1'>EJECUTADO</th>
						<th class = 'separator mesx1'></th>
						<th class = 'subtitulos_columnas mesx2'>PRESUPUESTADO</th>
						<th class = 'subtitulos_columnas mesx2'>EJECUTADO</th>
						<th class = 'separator mesx2'></th>
						<th class = 'subtitulos_columnas mesx3'>PRESUPUESTADO</th>
						<th class = 'subtitulos_columnas mesx3'>EJECUTADO</th>
						<th class = 'separator mesx3'></th>
						<th class = 'subtitulos_columnas mesx4'>PRESUPUESTADO</th>
						<th class = 'subtitulos_columnas mesx4'>EJECUTADO</th>
						<th class = 'separator mesx4'></th>
						<th class = 'subtitulos_columnas mesx5'>PRESUPUESTADO</th>
						<th class = 'subtitulos_columnas mesx5'>EJECUTADO</th>
						<th class = 'separator mesx5'></th>
						<th class = 'subtitulos_columnas mesx6'>PRESUPUESTADO</th>
						<th class = 'subtitulos_columnas mesx6'>EJECUTADO</th>
						<th class = 'separator mesx6'></th>
						<th class = 'subtitulos_columnas mesx7'>PRESUPUESTADO</th>
						<th class = 'subtitulos_columnas mesx7'>EJECUTADO</th>
						<th class = 'separator mesx7'></th>
						<th class = 'subtitulos_columnas mesx8'>PRESUPUESTADO</th>
						<th class = 'subtitulos_columnas mesx8'>EJECUTADO</th>
						<th class = 'separator mesx8'></th>
						<th class = 'subtitulos_columnas mesx9'>PRESUPUESTADO</th>
						<th class = 'subtitulos_columnas mesx9'>EJECUTADO</th>
						<th class = 'separator mesx9'></th>
						<th class = 'subtitulos_columnas mesx10'>PRESUPUESTADO</th>
						<th class = 'subtitulos_columnas mesx10'>EJECUTADO</th>
						<th class = 'separator mesx10'></th>
						<th class = 'subtitulos_columnas mesx11'>PRESUPUESTADO</th>
						<th class = 'subtitulos_columnas mesx11'>EJECUTADO</th>
						<th class = 'separator mesx11'></th>
						<th class = 'subtitulos_columnas mesx12'>PRESUPUESTADO</th>
						<th class = 'subtitulos_columnas mesx12'>EJECUTADO</th>
						<th class = 'separator mesx12'></th>
						<th class = 'subtitulos_columnas'>PRESUPUESTADO</th>
						<th class = 'subtitulos_columnas'>EJECUTADO</th>
					</tr>

				";
			return $est;
		}
		
		public function listar_items_name($name){
			$sql = mysql_query("select i.id as codigo_item, i.name as nombre_item, g.name as grupo
			from i_ppto_general i,g_ppto_general g
			where i.pk_grupo = g.id and i.name like '%$name%' ORDER BY i.name asc;");
			$est = "<table width = '100%'>";
			while($row = mysql_fetch_array($sql)){
				$est.="<tr>
					<td >
						<div><input type = 'checkbox' value = '".$row['codigo_item']."' name = 'item_nuevo_add_ppto' id = 'v_info_emp".$row['codigo_item']."' onchange = 'ocultar_info_empleado_pd()' class = 'radio' onclick = 'sel_item_ppto()'/>
						<label for='v_info_emp".$row['codigo_item']."'><span><span></span></span>".$row['nombre_item']." -- ".$row['grupo']."</label></div>
					</td>
				</tr>";
			}
			echo $est."</table>";
		}
		
		public function sql_ppto($g){
			
			return $sql;
		}
		
		public function ano_ppto($und){
			$imp = "<option value = '0'></option>";
			$y = date("Y");
			$sql = mysql_query("select id, year from ppto_general where und  = '$und' order by year asc;");
			while($row = mysql_fetch_array($sql)){
				if($y == $row['year']){
					$imp .= "<option value ='".$row['id']."' selected>".$row['year']."</option>";
				}else{
					$imp .= "<option value ='".$row['id']."'>".$row['year']."</option>";
				}
			}
			echo $imp;
		}
		
		public function sql2_ppto($und,$ppto){
			$sql = mysql_query("select distinct g.id as id_grupo,g.name as nombre_grupo 
			from g_ppto_general g, item_x_ppto_general ix, i_ppto_general i
			where 
			ix.item = i.id and i.pk_grupo = g.id and ix.ppto = '$ppto' order by i.name,g.name asc");
			return $sql;
		}
		
		public function eliminar_info_cuadro($id,$ppto){
			mysql_query("delete from c_ppto_general where item = '$id' and ppto = '$ppto'");
			mysql_query("delete from item_x_ppto_general where item = '$id' and ppto = '$ppto'");
		}
		
		public function insert_meta_mensual($id,$val){
			$update = mysql_query("update ppto_mensual_ppto_general set valor = '$val' where id = '$id'");
		}
		
		public function llenar_estructura($sql2,$estructura,$und,$ppto){
			$total_mes_pptado_nomina = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
			$total_mes_real_nomina =array(0,0,0,0,0,0,0,0,0,0,0,0,0);
			$total_acum_por_mes =array(0,0,0,0,0,0,0,0,0,0,0,0,0);
			$total_pptado_nomina = 0;
			$total_mes_nomina_varios = array(0,0,0,0,0,0,0,0,0,0,0,0);
			$total_mes_nomina_varios_adicionales = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
			$ano_ppto = mysql_query("select year from ppto_general where id = '$ppto'");
			$year_ppto = 0;
			while($row = mysql_fetch_array($ano_ppto)){
				$year_ppto = $row['year'];
			}
			$num_mes =floatval(date("m"));
			$est = $estructura;			
			$grupo = "";
			$total_pptado = 0;
			$acum_mes = array( array(0,0),array(0,0),array(0,0),array(0,0),array(0,0),array(0,0),array(0,0),array(0,0),array(0,0),array(0,0),array(0,0),array(0,0),array(0,0),array(0,0),array(0,0),array(0,0),array(0,0));
			$class = "oscuro_ppto_general";
			$class2 = "claro_ppto_general";
			$est.="<tr>
				<td></td>
				<th colspan = '3' class = '$class' nowrap>PRESUPUESTADO VS EJECUTADO</th>
				<th class = 'separator'></th>
			";
			$acum_total_pptado = 0;
			$acum_total_real_ejecutado = 0;
			for($i = 1;$i<=12;$i++){
				$sql = mysql_query("select cp.pptado_item as pptado from  c_ppto_general cp
				where cp.ppto = '$ppto' and cp.mes  = '$i'");
				$valor_ppto_real=0;
				while($val = mysql_fetch_array($sql)){
					$valor_ppto_real+=$val['pptado'];
					$acum_total_pptado+=$val['pptado'];					
				}
				$est.="<td class = '$class mesx$i'>
						<table width = '100%'>
							<tr>
								<td align = 'left'>$</td>
								<td align = 'right'>
									".number_format($valor_ppto_real)."
								</td>
							</tr>
						</table>
					</td>";
				$sql=mysql_query("select cp.valor as pptado from  c_ppto_general cp
				where cp.ppto = '$ppto' and cp.mes  = '$i'");
				$valor_real_mes_total = 0;
				while($row = mysql_fetch_array($sql)){
					if($row['pptado'] >= 0){
						$valor_real_mes_total+=$row['pptado'];
						$acum_total_real_ejecutado+=$row['pptado'];
					}
				}
				$est.="<td class = '$class mesx$i'>
						<table width = '100%'>
							<tr>
								<td align = 'left'>$</td>
								<td align = 'right'>
									".number_format($valor_real_mes_total)."
								</td>
							</tr>
						</table>
					</td>
					<td class = 'separator mesx$i'></td>";
			}
			
			$est.="
				<th class = '$class'>
					<table width = '100%'>
						<tr>
							<th align = 'left'>$</th>
							<th align = 'right'>
								".number_format($acum_total_pptado)."
							</th>
						</tr>
					</table>
				</th>
				<th class = '$class'>
					<table width = '100%'>
						<tr>
							<th align = 'left'>$</th>
							<th align = 'right'>
								".number_format($acum_total_real_ejecutado)."
							</th>
						</tr>
					</table>
				</th>
			</tr>
			<tr>
				<td></td>
				<th colspan = '3' class = '$class2'>DIFERENCIA</th>
				<th class = 'separator'></th>";
			$acum_total_pptado = 0;
			$acum_total_ejecutado = 0;
			for($i = 1;$i<=12;$i++){
				$sql = mysql_query("select cp.pptado_item as pptado from  c_ppto_general cp
				where cp.ppto = '$ppto' and cp.mes  = '$i'");
				$valor_ppto_real=0;
				
				while($val = mysql_fetch_array($sql)){
					$valor_ppto_real+=$val['pptado'];
					$acum_total_pptado+=$val['pptado'];					
				}
				$sql=mysql_query("select cp.valor as pptado from  c_ppto_general cp
				where cp.ppto = '$ppto' and cp.mes  = '$i'");
				$valor_real_mes_total = 0;
				
				while($row = mysql_fetch_array($sql)){
					if($row['pptado'] >= 0){
						$valor_real_mes_total+=$row['pptado'];
						$acum_total_ejecutado+=$row['pptado'];
					}
				}
				
				/*$sql = mysql_query("select cp.item from c_ppto_general cp
				where  cp.ppto = '$ppto' and cp.mes  = '$i' and cp.valor <> '-1'");
				$valor_ppto_real=0;
				$valor_ppto_real_x=0;
				while($row = mysql_fetch_array($sql)){
					$id = $row['item'];
					$sql_interno = mysql_query("select valor from item_x_ppto_general where item = '$id'");
					while($val = mysql_fetch_array($sql_interno)){
						if($val['valor'] >= 0){
							$valor_ppto_real+=$val['valor'];
							$valor_ppto_real_x=$val['valor'];
						}
					}
				}
				$sql=mysql_query("select cp.valor as pptado from  c_ppto_general cp
				where cp.ppto = '$ppto' and cp.mes  = '$i'");
				$valor_real_mes_total = 0;
				$valor_real_mes_total_x = 0;
				while($row = mysql_fetch_array($sql)){
					if($row['pptado'] >= 0){
						$valor_real_mes_total+=$row['pptado'];
						$valor_real_mes_total_x=$row['pptado'];
					}
				}*/
				$valor_real_mes_total = $valor_real_mes_total -$valor_ppto_real;
				$xval_x = $valor_ppto_real - $valor_real_mes_total;
				$colorxr = "";
				if($xval_x > 0 ){
					$colorxr = "style = 'background-color:#35B324;color:white;'";
				}else{
					$color = "style = 'background-color:#FF0101;color:white;'";
				}
				$est.="
					<th class = '$class2 mesx$i'>DIFERENCIA</th>
					<th class = '$class2 mesx$i' $colorxr>
						<table width = '100%'>
							<tr>
								<th align = 'left'>$</th>
								<th align = 'right'>
									".number_format($valor_real_mes_total)."
								</th>
							</tr>
						</table>
					</th>
					<th class = 'separator mesx$i'></th>";
			}
			$est.="
					<th class = '$class2'>DIFERENCIA</th>
					<th class = '$class2'>
						<table width = '100%'>
							<tr>
								<th align = 'left'>$</th>
								<th align = 'right'>
									".number_format($acum_total_pptado - $acum_total_ejecutado)."
								</th>
							</tr>
						</table>
					</th>
				</tr>
			</thead><tbody>";
			
			while($row = mysql_fetch_array($sql2)){
				$grupo = $row['id_grupo'];
				$sql3 = mysql_query("select sum(i.valor) as valor_total 
				from item_x_ppto_general item, g_ppto_general g, i_ppto_general i
				where item.item = i.id and i.pk_grupo = g.id and i.pk_grupo = '$grupo' and item.ppto = '$ppto' ORDER by g.id DESC ");
				while($row2 = mysql_fetch_array($sql3)){
					$est .="<tr>
						<td></td>
						<td class = 'grupos_ppto_general' style = 'padding-right:10px;' align = 'center'>".$row['nombre_grupo']."</td>
						<td class = 'grupos_ppto_general' align = 'center'>100%</td>
						<td class = 'grupos_ppto_general' style = 'padding-left:20px;padding-right:20px;'>
							<table width = '100%'>
								<tr>
									<td  width = '2%'>$</td>
									<td  align = 'right'>".number_format($row2['valor_total'])."</td>
								</tr>
							</table>
						</td>
					</tr>";
				}
				$sql = mysql_query("select distinct p.id as num_ppto,i.id, i.name as nombre_item,xi.valor as valor_item_real
				from ppto_general p, g_ppto_general g, i_ppto_general i, c_ppto_general c, item_x_ppto_general xi
				where c.ppto = p.id and p.year = '".date('Y')."' and c.item  = i.id and i.pk_grupo = '$grupo'
				and i.pk_grupo = g.id and c.item = xi.item AND c.ppto = '$ppto' and xi.ppto = '$ppto' order by i.name asc");
				$acum_valor_ppto_mes = 0;
				$acum_valor_real_mes = 0;
				$xclass = 1;
				while($row4 = mysql_fetch_array($sql)){
					$identificador = $row4['id'];
						if($xclass == 1){
							$class = "oscuro_ppto_general";
							$xclass = 0;
						}else if($xclass == 0){
							$class = "claro_ppto_general";
							$xclass = 1;
						}
						//$valor_ppto_mes = $row4['valor_item_real'];
						
						$num_ppto = $row4['num_ppto'];
						$total_pptado += $row4['valor_item_real'];
						$valor_real_del_item = $row4['valor_item_real'];
						$est .="<tr>
							<td>
								<img src = '../images/iconos/eliminar2.png' height='25px' onclick = 'eliminar_registros_cuadro($identificador,$ppto)'/>
							</td>
							<td class = '$class' nowrap>".$row4['nombre_item']."</td>
							<td class = '$class' align = 'center'>100%</td>
							<td class = '$class' style = 'padding-left:20px;padding-right:20px;'>
								<table width = '100%'>
									<tr>
										<td width = '2%'>$</td>
										<td align = 'right'>".number_format($row4['valor_item_real'])."</td>
									</tr>
								</table>
							</td>
							<td class = 'separator'></td>";
						$t = "";
						$t = $row4['id'];
						for($r = 1;$r <= 12; $r++){
							
							$sql_f = mysql_query("select p.year, g.name as nombre_grupo, i.id, i.name as nombre_item, i.valor as valor_item_real, c.mes as mes_item, c.valor as valor_real_mes,c.pptado_item,c.id as id_pptado_mes
							from ppto_general p, g_ppto_general g, i_ppto_general i, c_ppto_general c
							where c.ppto = p.id and p.year = '".date('Y')."'and c.item  = i.id and i.pk_grupo = '$grupo' and i.pk_grupo = g.id and i.id = '$t' and c.mes = '$r' and c.ppto = '$ppto' order by i.name asc");
							if(mysql_num_rows($sql_f) == 1){								
								while($rr = mysql_fetch_array($sql_f)){
									$id_pptado_mes = $rr['id_pptado_mes'];
									//Cambio del Pptado general a pptado mes a mex
									$valor_ppto_mes = $rr['pptado_item'];
									
									
									$acum_valor_ppto_mes +=$row4['valor_item_real'];
									$acum_valor_real_mes +=floatval($rr['valor_real_mes']);
									$total_acum_por_mes[$r] +=floatval($rr['valor_real_mes']);
									$acum_mes[$r][0] = $acum_mes[$r][0] + floatval($rr['valor_real_mes']);
									$acum_mes[$r][1] += $rr['pptado_item'];
									$color = "";
									if($rr['valor_real_mes'] <= $valor_ppto_mes ){
										$color = "style = 'background-color:#35B324;color:white;'";
									}else if($rr['valor_real_mes'] > $valor_ppto_mes){
										$color = "style = 'background-color:#FF0101;color:white;'";
									}
									//if($num_mes == $r ){
									if($r == $r ){
										if($rr['valor_real_mes'] != 0){
											$est .="
										<td class = '$class mesx$r'>
											<table width = '100%'>
												<tr id = 'pptado_mes_casilla$id_pptado_mes'>
													<td>$</td>
													<td align = 'right'>
													<span class = 'hidde' id = 'pptado_mes$id_pptado_mes' >".$valor_ppto_mes."</span>
													<span ondblclick = 'update_valor_pptado_mes($id_pptado_mes)'>".number_format($valor_ppto_mes)."</span></td>
												</tr>
											</table>
										</td>
										<td class = '$class mesx$r' id = 't-$t-$r' $color>
											<table width = '100%'>
												<tr>
													<td>$</td>
													<td align = 'right'>
														<span ondblclick = 'editar_valor_mes($t,$r,$ppto,$id_pptado_mes)' id = '$t-$r'>".number_format($rr['valor_real_mes'])."</span>
														<span class = 'hidde' id = '$t-$r-h'>".($rr['valor_real_mes'])."</span>
													</td>
												</tr>
											</table>
										</td>
										<td class = 'separator mesx$r'></td>
										";
										}else{
											//PILAS AQUÍ
											//if($num_mes - 1 == $r && date("d") <= 18){
											if(date("d") <= 30){
													$est .="
													<td class = '$class mesx$r'>
														<table width = '100%'>
															<tr id = 'pptado_mes_casilla$id_pptado_mes'>
																<td>$</td>
																<td align = 'right'>
																<span class = 'hidde' id = 'pptado_mes$id_pptado_mes' >".$valor_ppto_mes."</span>
																<span ondblclick = 'update_valor_pptado_mes($id_pptado_mes)'>".number_format($valor_ppto_mes)."</span></td>
															</tr>
														</table>
													</td>
													<td class = '$class mesx$r' id = 't-$t-$r' $color>
														<table width = '100%'>
															<tr>
																<td>$</td>
																<td align = 'right'>
																	<span ondblclick = 'editar_valor_mes($t,$r,$ppto,$id_pptado_mes)' id = '$t-$r'>".number_format($rr['valor_real_mes'])."</span>
																	<span class = 'hidde' id = '$t-$r-h'>".($rr['valor_real_mes'])."</span>
																</td>
															</tr>
														</table>
													</td>
													<td class = 'separator mesx$r'></td>
													";
											}else{
												$est .="
												<td class = '$class mesx$r'>
													<table width = '100%'>
														<tr id = 'pptado_mes_casilla$id_pptado_mes'>
															<td>$</td>
															<td align = 'right'>".number_format($valor_ppto_mes)."</td>
														</tr>
													</table>
												</td>
												<td class = '$class mesx$r' id = 't-$t-$r' $color>
													<table width = '100%'>
														<tr>
															<td>$</td>
															<td align = 'right'>
																<span ondblclick = 'editar_valor_mes($t,$r,$ppto,$id_pptado_mes)' id = '$t-$r'>".number_format($rr['valor_real_mes'])."</span>
																<span class = 'hidde' id = '$t-$r-h'>".($rr['valor_real_mes'])."</span>
															</td>
														</tr>
													</table>
												</td><td class = 'separator mesx$r'></td>";
											}
											
										}
										
									}else{
										if($rr['valor_real_mes'] != -1){
											$est .="
											<td class = '$class mesx$r'>
												<table width = '100%'>
													<tr id = 'pptado_mes_casilla$id_pptado_mes'>
														<td>$</td>
														<td align = 'right'>".number_format($valor_ppto_mes)."</td>
													</tr>
												</table>
											</td>
											<td class = '$class mesx$r' $color>
												<table width = '100%'>
													<tr>
														<td>$</td>
														<td align = 'right'>
															".number_format($rr['valor_real_mes'])."
														</td>
													</tr>
												</table>
											</td><td class = 'separator mesx$r'></td>";
										}else{
											$est .="
										<td class = '$class mesx$r'>
											<table width = '100%'>
												<tr>
													<td>$</td>
													<td align = 'right'>".number_format(0)."</td>
												</tr>
											</table>
										</td>
										<td class = '$class mesx$r' $color>
											<table width = '100%'>
												<tr>
													<td>$</td>
													<td align = 'right'>
														".number_format($rr['valor_real_mes'])."
													</td>
												</tr>
											</table>
										</td><td class = 'separator mesx$r'></td>";
										}
										
									}
								}
							}else if(mysql_num_rows($sql_f) == 0){
								$acum_mes[$r][0] = 0;
								$acum_mes[$r][1] = 0;
									$est .="
									<td class = '$class mesx$r'>
										<table width = '100%'>
											<tr>
												<td>$</td>
												<td align = 'right'>
													<span >".number_format(0)."</span>
												</td>
											</tr>
										</table>
									</td>
									<td class = '$class mesx$r'>
										<table width = '100%'>
											<tr>
												<td>$</td>
												<td align = 'right'>
													<span >".number_format(0)."</span>
												</td>
											</tr>
										</table>
									</td><td class = 'separator mesx$r'></td>";
								
							}
						}
						$est .="
								<td class = '$class'>
									<table width = '100%'>
											<tr>
												<td>$</td>
												<td align = 'right'>
													<span >".number_format($acum_valor_ppto_mes)."</span>
												</td>
											</tr>
										</table>
								</tD>
								<td class = '$class'>
									<table width = '100%'>
											<tr>
												<td>$</td>
												<td align = 'right'>
													<span >".number_format($acum_valor_real_mes)."</span>
												</td>
											</tr>
										</table>
								</tD>
						</tr>";
					}
			}
			
			$est.="<tr><td></td><td></br></td></tr><tr>
				<td></td>
				<td class = 'grupos_ppto_general' colspan = '3'style = 'padding-right:10px;' align = 'center'>TOTAL COSTOS FIJOS Y VARIABLES</td>
				<td class ='separator'></td>";
			for($ixx = 1;$ixx <= 12;$ixx++){
				$est.="<td colspan = '2' class = 'grupos_ppto_general mesx$ixx'>
						<table width = '100%'>
							<tr>
								<th align = 'left'>$</th>
								<th align = 'right'>
									".number_format($total_acum_por_mes[$ixx])."
								</th>
							</tr>
						</table>
					</td>
					<td class ='separator mesx$ixx'></td>
				";
			}
			//echo $est."</tr></tbody></table>
			echo $est."</tr></tbody></table>
			<script type = 'text/javascript'>
					
				</script>
			";
		}
		
		public function consultar_empresa($ppto){
			$sql = mysql_query("select e.cod_interno_empresa 
			from empresa e, ppto_general p,und u
			where p.und = u.id and u.empresa = e.cod_interno_empresa and p.id = '$ppto'");
			while($row = mysql_fetch_array($sql)){
				return $row['cod_interno_empresa'];
			}
		}
	}
?>
