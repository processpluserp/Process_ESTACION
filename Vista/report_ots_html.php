<?php
	include("../Controller/Conexion.php");
	include("vectores_th_report.php");
	
	$estructura_tabla = "<div >
	<table class = 'tabla_reporte_estados_pptos tabla_reportes'>
		<tr>
			<th align = 'left' style = 'padding-right:5px;'>
				<a href = ''>
					<img src = '../images/produccion/iconos-82.png' width = '45px' />
				</a>
			</th>
			<th align = 'left'>
				<img src = '../images/produccion/iconos-81.png' width = '45px' />
			</th>
		</tr>
	</table>
	<div style=' border-radius: 15px; width:100%;'> 
	<table id='tabla_estado_ppto' width = '100%' style = 'background-color:#E5E5E5;'class = 'tabla_reporte_estados_pptos tabla_reportes tabla_reportes4 display nowrap'>";
	$estructura_tabla .= "";
	$estructura_tabla .= "<tr>";
	for($i = 0; $i < count($reporte_ots); $i++){
		if ($i<1) {
			$estructura_tabla.="<th style='background-color:#DAEFB0; color: rgb(83, 86, 78);  border-color: #FFFFFF; height: 35px;' class = 'th_report' nowrap>".$reporte_ots[$i]."</th>";
		}else
			$estructura_tabla.="<th style='background-color:#F7EFB0; color: rgb(83, 86, 78);  border-color: #FFFFFF; height: 35px;' class = 'th_report' nowrap>".$reporte_ots[$i]."</th>";
	}
	$estructura_tabla .= "</tr>";
	
	
	if(!empty($_POST["user"]) && !empty($_POST["emp"]) && !empty($_POST["director"]) && !empty($_POST["ejecutivo"]) && !empty($_POST["turno"])){
		$empresa = $_POST['emp'];
		$director = $_POST['director'];
		$ejecutivo = $_POST['ejecutivo'];
		
		$cliente = $_POST['cliente'];
		$producto = $_POST['producto'];
		$sql_cliente = "";
		$sql_producto = "";
		if($cliente != 0){
			$sql_cliente = " and ot.producto_clientes_pk_clientes_nit_procliente = '$cliente' ";
		}
		if($producto != 0){
			$sql_producto = " and ot.producto_clientes_codigo_PRC = '$producto' ";
		}

		$sql_consulta="select c.nombre_comercial_cliente, c.codigo_interno_cliente,ot.codigo_ot, ot.referencia as ref_ot,
		CAST(ot.fecha_registro as DATE) as FECHA_OT,CAST(ot.fecha_registro as TIME) as HORA_OT,pr.nombre_producto,
		pr.id_procliente
		from cabot ot, clientes c, producto_clientes pr
		where ot.pk_nit_empresa_ot = '$empresa' and ot.director = '$director' and ot.ejecutivo = '$ejecutivo' 
		and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente and ot.producto_clientes_codigo_PRC = pr.id_procliente  $sql_cliente $sql_producto
		 and ot.estado = '1' 
		order BY c.nombre_comercial_cliente,pr.nombre_producto,ot.codigo_ot";

		//echo $sql_consulta;
		$sql_nivel_cliente = mysql_query($sql_consulta);
		
		$estructura_tabla.="<tr></tr>";
		
		
		$array_cliente = array();
		$arra_temp = array();
		$i = 0;
		while($row = mysql_fetch_array($sql_nivel_cliente)){
			$cliente = $row['nombre_comercial_cliente'];
			
			
			$text = "";
			$sql_tareas_num = mysql_query("select distinct codigo_tarea,codigo_int_tarea from tareas where pk_ot = '".$row['codigo_ot']."'");
			
			while($num_tarea = mysql_fetch_array($sql_tareas_num)){
				
				$sql_tarea_final = mysql_query("select max(ft.codigo) as last_num, t.fecha_registro, t.trabajo, dp.name_depto as departamento,t.codigo_int_tarea ,
				t.estado,t.fecha_prometida, t.hora_p,t.minutos_p,t.formato
				from flujo_tareas ft, tareas t, deptos_trafico dp
				where ft.ot = '".$row['codigo_ot']."' and ft.pk_tarea = t.codigo_int_tarea and t.codigo_tarea = '".$num_tarea['codigo_tarea']."' and
				t.codigo_departamento = dp.id");
				$estado_tarea = "";
				
				while($fl = mysql_fetch_array($sql_tarea_final)){
					if($fl['estado'] == 0){
						$estado_tarea = "SIN RESPONDER";
					}else if($fl['estado'] == 1){
						$estado_tarea = "CONTESTADA";
					}else if($fl['estado'] == 2){
						$estado_tarea = "CERRADA";
					}
					else if($fl['estado'] == 3){
						$estado_tarea = "FINALIZADA";
					}
					$array_cliente[$i][0] = $row['nombre_comercial_cliente'];
					$array_cliente[$i][1] = $row['nombre_producto'];
					$array_cliente[$i][2] = $row['codigo_ot'];
					$array_cliente[$i][3] = $row['ref_ot'];
					$array_cliente[$i][4] = $row['FECHA_OT'];
					$array_cliente[$i][5] = $row['HORA_OT'];
					$array_cliente[$i][6] = $num_tarea['codigo_tarea'].".".$fl['last_num'];
					$array_cliente[$i][7] = "TIPO TAREA";//$row['numero_presupuesto'];
					$array_cliente[$i][8] = $fl['fecha_registro'];
					$array_cliente[$i][9] = utf8_decode($fl['trabajo']);
					$array_cliente[$i][10] = $fl['departamento'];
					
					$sql_responsable = mysql_query("select e.nombre_empleado, at.fecha_visto
					from asignados_tareas at, usuario u, empleado e
					where at.pk_tarea = '".$fl['codigo_int_tarea']."' and at.pk_asignado = u.idusuario and u.pk_empleado = e.documento_empleado and at.tipo = 'RES'");
					while($rem = mysql_fetch_array($sql_responsable)){
						$array_cliente[$i][11] .= utf8_decode($rem['nombre_empleado'])."</br>";
					}
					
					$sql_responsable = mysql_query("select e.nombre_empleado, at.fecha_visto
					from asignados_tareas at, usuario u, empleado e
					where at.pk_tarea = '".$fl['codigo_int_tarea']."' and at.pk_asignado = u.idusuario and u.pk_empleado = e.documento_empleado and at.tipo = 'ASI'");
					while($rem = mysql_fetch_array($sql_responsable)){
						$array_cliente[$i][12] .= utf8_decode($rem['nombre_empleado'])."</br>";
					}
					
					$array_cliente[$i][13] = $estado_tarea;
					$array_cliente[$i][14] = $fl['fecha_prometida'];
					$array_cliente[$i][15] = $fl['hora_p'].":".$fl['minutos_p']." ".$fl['formato'];
					
					$i++;
				}
				
			}
						
		}
		
		$array_f_clientes = array();
		for($x = 0; $x < count($array_cliente);$x++){
			$array_f_clientes[] = ($array_cliente[$x][10]);
		}
		$array_f_clientesx = array_unique($array_f_clientes);
		
		$llaves_clientes = array_keys($array_f_clientesx);


		
		
		for($n = 0; $n < count($array_f_clientesx); $n++){
			for($c = 0; $c < count($array_cliente); $c++){
				if( $array_f_clientesx[$llaves_clientes[$n]] == $array_cliente[$c][10]){
					
					$cliente = "";
					$producto = "";
					$ot = "";
					$ref_ot = "";
					$fecha_ot = "";
					$hora_ot = "";
					if(count($array_f_clientesx) == 1 && $c == 0){
						$cliente =$array_cliente[$c][0];
						$producto = $array_cliente[$c][1];
						$ot = $array_cliente[$c][2];
						$ref_ot = $array_cliente[$c][3];
						$fecha_ot = $array_cliente[$c][4];
						$hora_ot = $array_cliente[$c][5];
					}else if($c == 0){
						//CLIENTE
						$cliente = $array_cliente[$c][10];
						if($cliente == $array_cliente[$c+1][10]){
							$cliente =$array_cliente[$c][0];
						}else{
							$cliente = $array_cliente[$c][0];
						}
						
						//PRODUCTO
						$producto = $array_cliente[$c][11];
						if($producto == $array_cliente[$c+1][11]){
							$producto =  $array_cliente[$c][1];
						}else{
							$producto = $array_cliente[$c][1];
						}
						
						
						//OT
						$ot = $array_cliente[$c][2];
						if($ot == $array_cliente[$c+1][2]){
							$ot = $array_cliente[$c][2];
							$ref_ot = $array_cliente[$c][3];
							$fecha_ot = $array_cliente[$c][4];
							$hora_ot = $array_cliente[$c][5];
						}else{
							$ot = $array_cliente[$c][2];
							$ref_ot = $array_cliente[$c][3];
							$fecha_ot = $array_cliente[$c][4];
							$hora_ot = $array_cliente[$c][5];
						}
						
					}else{
						
						
						//CLIENTE
						$cliente = $array_cliente[$c-1][10];
						if($cliente == $array_cliente[$c][10]){
							$cliente = "";
						}else{
							$cliente = $array_cliente[$c][0];
						}
						
						//PRODUCTO
						$producto = $array_cliente[$c-1][11];
						if($producto == $array_cliente[$c][11]){
							$producto = "";
						}else{
							$producto = $array_cliente[$c][1];
						}
						
						//OT
						$ot = $array_cliente[$c-1][2];
						if($ot == $array_cliente[$c][2]){
							$ot = "";
						}else{
							$ot = $array_cliente[$c][2];
							$ref_ot = $array_cliente[$c][3];
							$fecha_ot = $array_cliente[$c][4];
							$hora_ot = $array_cliente[$c][5];
						}
						
					}
					$rowspan=0;//count($array_cliente)*5;
					$estructura_tabla .= "<tr>";
					if ($cliente != "") {
						
					}
					$estructura_tabla .= "<td style = 'vertical-align:top; border-color: #FFFFFF;' nowrap><strong>".$cliente."</strong></td>";
					if ($producto!="") {
						
					}
					$estructura_tabla .= "<td  style = 'vertical-align:top; border-color: #FFFFFF;'>".$producto."</td>";
					if ($ot!="") {
						
					}
					$estructura_tabla .= "<td   style = 'vertical-align:top; border-color: #FFFFFF;' nowrap>".$ot."</td>";
					if ($ref_ot!="") {
						
					}
					$estructura_tabla .= "<td   style = 'vertical-align:top; border-color: #FFFFFF;' nowrap>".$ref_ot."</td>";
					if ($fecha_ot!="") {
						
					}
					$estructura_tabla .= "<td  nowrap style = 'padding-left:5px;vertical-align:top;text-align:center; border-color: #FFFFFF;'>".$fecha_ot."</td>";
					if ($hora_ot!="") {
						
					}	
					$estructura_tabla .= "<td nowrap style = 'padding-left:5px;vertical-align:top;text-align:center; border-color: #FFFFFF;'>".$hora_ot."</td>";
						
						
						
					$estructura_tabla .= "<td style = 'vertical-align:top;text-align:center; border-color: #FFFFFF;' nowrap>".$array_cliente[$c][6]."</td>";
					$estructura_tabla .= "<td style = 'vertical-align:top;text-align:center; border-color: #FFFFFF;' nowrap>".$array_cliente[$c][7]."</td>";
					$estructura_tabla .= "<td  style = 'vertical-align:top; border-color: #FFFFFF;'>".$array_cliente[$c][8]."</td>";
					$estructura_tabla .= "<td style = 'vertical-align:top; border-color: #FFFFFF;' nowrap>".$array_cliente[$c][9]."</td>";
					$estructura_tabla .= "<td style = 'vertical-align:top; border-color: #FFFFFF;' nowrap>".$array_cliente[$c][10]."</td>";
					$estructura_tabla .= "<td style = 'vertical-align:top; border-color: #FFFFFF;' nowrap>".$array_cliente[$c][11]."</td>";
					$estructura_tabla .= "<td style = 'vertical-align:top; border-color: #FFFFFF;' nowrap>".$array_cliente[$c][12]."</td>";
					$estructura_tabla .= "<td style = 'vertical-align:top; border-color: #FFFFFF;' nowrap>".$array_cliente[$c][13]."</td>";
					$estructura_tabla .= "<td style = 'vertical-align:top; border-color: #FFFFFF;' nowrap>".$array_cliente[$c][14]."</td>";
					$estructura_tabla .= "<td style = 'vertical-align:top; border-color: #FFFFFF;' nowrap>".$array_cliente[$c][15]."</td>";
					$estructura_tabla .= "</tr>";
					
				}else{	
						
				}
			}

			$estructura_tabla.="</table>
			</div>";
		}
		
		$turno = $_POST['turno'];
		
		
	}
	
	echo $estructura_tabla."</div>";
	
	?>