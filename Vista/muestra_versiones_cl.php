<?php
	include("../Controller/Conexion.php");
	
	$ppto = $_POST['ppto'];
	$sql_val = mysql_query("select distinct  v.versionc, v.version, v.fecha, e.nombre_empleado
	from empleado e, usuario u, versiones_presup v
	where v.ppto = '$ppto' and v.user = u.idusuario and u.pk_empleado = e.documento_empleado");
	if(mysql_num_rows($sql_val) > 0){
		$tab = "";
		while($row = mysql_fetch_array($sql_val)){
			if($row['versionc'] == $_POST['version']){
				$tab.="<tr>
					<td nowrap>
						<div>
							<input type = 'radio'  name = 'num_version_ppto' id = '".$row['versionc']."'value = '".$row['versionc']."' class = 'radio' onclick = 'cargar_versiones_ppto($ppto,".$row['versionc'].")'/>
							<label style = 'font-size:12px;' for='".$row['versionc']."' id = 'text".$row['versionc']."'><span><span></span></span></label>
						</div>
					</td>
					<td>
						CL. ".$row['versionc']." INT.  ".$row['version']."(ACTUAL)
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
							<input type = 'radio'  name = 'num_version_ppto' id = '".$row['versionc']."'value = '".$row['versionc']."' class = 'radio' onclick = 'cargar_versiones_ppto($ppto,".$row['versionc'].")'/>
							<label style = 'font-size:12px;' for='".$row['versionc']."' id = 'text".$row['versionc']."'><span><span></span></span></label>
						</div>
					</td>
					<td>
						CL. ".$row['versionc']." INT.  ".$row['version']."
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
					<td width = '96%' style = 'font-weight:bold;font-size:16px;'>Versiones al Cliente</td>
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