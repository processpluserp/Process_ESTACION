<?php
			include("../Controller/Conexion.php");
			include("vector_colores_pastel.php");
				
			function cambiar_formato_hora($hora,$formato){
				if($formato == "pm"){
					return floatval($hora)+12;
				}else{
					return $hora;
				}
			}
			
			
			$usu = $_POST['usuario'];
			
			$tabla = "";
			$sql_1=mysql_query("select distinct t.pk_ot, t.codigo_int_tarea,t.codigo_tarea, ft.codigo, ot.referencia,t.trabajo,t.fecha_registro as fecha_prometida,ot.id as id_ot,
			t.usuario, e2.nombre_empleado as radicado_por, ft.num_tarea,t.hora_p,t.formato,t.hm_registro,t.minutos_p, c.nombre_comercial_cliente
																	
			from tareas t, flujo_tareas ft, cabot ot, usuario u2, empleado e2, asignados_tareas ax, clientes c
																	
			where t.codigo_int_tarea = ft.pk_tarea  and t.estado = '0' and ot.codigo_ot = t.pk_ot

			and t.usuario = u2.idusuario and u2.pk_empleado = e2.documento_empleado 

			and t.codigo_int_tarea = ax.pk_tarea  and ax.pk_ot =ot.id and

			ax.pk_asignado = ".$usu." and( ax.tipo = 'RES' or ax.tipo = 'ASI') and ot.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente order by t.fecha_registro asc");
			
			
			while($trow = mysql_fetch_array($sql_1)){
				$id_tareaa = $trow['codigo_int_tarea'];
				
				
				$id = $trow['codigo_int_tarea'];
				$id_ot = $trow['id_ot'];
				$responsables = "";
				$asignados = "";
				$sql_res = mysql_query("select e.nombre_empleado as responsable,ax.tipo
				from tareas t, usuario u, asignados_tareas ax, empleado e
				where t.codigo_int_tarea ='$id' and t.codigo_int_tarea = ax.pk_tarea and ax.pk_asignado = u.idusuario 
				and u.pk_empleado = e.documento_empleado");
				while($xrow = mysql_fetch_array($sql_res)){
					if($xrow['tipo'] == 'RES'){
						$responsables .=$xrow['responsable']."</br>";
					}else{
						$asignados .=$xrow['responsable']."</br>";	
					}
				}
				$id = $trow['codigo_int_tarea'];
				$id_ot = $trow['id_ot'];
				$comp = "";
				if($trow['codigo'] == 0){
					$comp = $trow['num_tarea'];
				}else{
					$comp = $trow['num_tarea'].".".$trow['codigo'];
				}
				
				$ffhora = "";
				
				if($trow['formato'] == "pm"){
					$ffhora =  floatval($trow['hora_p'])+12;
				}else{
					$ffhora =  $trow['hora_p'];
				}
				
				
				//$this->cambiar_formato_hora($trow['hora_p'],$trow['formato']);

				$fregistro = explode(" ",$trow['hm_registro']);
				$hora2 = $fregistro[0]."T".$fregistro[1];
				$color = $colores_array[(mt_rand(0,7))];
				$tabla .= "<->".strtoupper($trow['nombre_comercial_cliente']." # TAREA ".$comp)."*---*".$trow['fecha_prometida']."T".$ffhora.":".$trow['minutos_p'].":00*---*".$hora2."*---*#".$color."*---*false*---*".$id."*---*mano*---*".$id_ot;
				
			}
			echo $tabla;
?>