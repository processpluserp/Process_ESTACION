<?php
	include("../Controller/Conexion.php");
	
	$ppto = $_POST['ppto'];
	$sql_val = mysql_query("select e.nombre_empleado, v.version, v.fecha
	from empleado e, usuario u, versiones_presup v
	where v.ppto = '$ppto' and v.user = u.idusuario and u.pk_empleado = e.documento_empleado");
	if(mysql_num_rows($sql_val) > 0){
		$tab = "";
		while($row = mysql_fetch_array($sql_val)){
			if($row['version'] == $_POST['version']){
				$tab.="<tr>
					<td nowrap>
						<div>
							<input type = 'radio'  name = 'num_version_ppto' id = '".$row['version']."'value = '".$row['version']."' class = 'radio' onclick = 'cargar_versiones_ppto($ppto,".$row['version'].")'/>
							<label style = 'font-size:12px;' for='".$row['version']."' id = 'text".$row['version']."'><span><span></span></span></label>
						</div>
					</td>
					<td>
						".$row['version']." (ACTUAL)
					</td>
					<td>
						".$row['fecha']."
					</td>
					<td>
						".$row['nombre_empleado']."
					</td>
				</tr>";
			}else{
				$tab.="<tr>
					<td nowrap>
						<div>
							<input type = 'radio'  name = 'num_version_ppto' id = '".$row['version']."'value = '".$row['version']."' class = 'radio' onclick = 'cargar_versiones_ppto($ppto,".$row['version'].")'/>
							<label style = 'font-size:12px;' for='".$row['version']."' id = 'text".$row['version']."'><span><span></span></span></label>
						</div>
					</td>
					<td>
						".$row['version']."
					</td>
					<td>
						".$row['fecha']."
					</td>
					<td>
						".$row['nombre_empleado']."
					</td>
				</tr>";
			}
			
		}
		$est = "<table width = '100%'>
				<tr>
					<td width = '96%' style = 'font-weight:bold;font-size:16px;'>Versiones de Ppto</td>
					<td>
						<img  src = '../images/iconos/icon-19.png' width = '50px' onclick = 'cerrar_ventana_abierta_version()'/>
					</td>
				</tr>
			</table>
			<table width = '100%'>
				<tr>
					<th></th>
					<th>Version</th>
					<th>Fecha</th>
					<th>Usuario</th>
				</tr>
				$tab
			</table>";
		echo $est;
	}
	
?>