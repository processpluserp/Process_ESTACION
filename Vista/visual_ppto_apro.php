<?php
	if (isset($_POST["id"])) {
		include("../Controller/Conexion.php");
		require("../Modelo/ppto_produccion.php");
		
		
		
		$id_apro_histo = $_POST['id'];
		$id = $_POST['id'];
		$est = "<table width = '100%'>";
		
		//consulto la info del ppto.
		$sql = mysql_query("select ppto,vc,vi,comentarios,fecha,up_bottom
		from apropresup_histo
		where id = '$id_apro_histo'");
		
		$num_ppto = 0;
		$ppto = 0;
		$version_interna = 0;
		$version_externa = 0;
		$vi = 0;
		$vc = 0;
		$up_bottom = 0;
		$comentarios = "";
		$fecha = "";
		while($row = mysql_fetch_array($sql)){
			$num_ppto = $row['ppto'];
			$ppto = $row['ppto'];
			
			$version_interna = $row['vi'];
			$version_externa = $row['vc'];
			
			$vi = $row['vi'];
			$vc = $row['vc'];
			
			$up_bottom = $row['up_bottom'];
			$comentarios = $row['comentarios'];
			$fecha = $row['fecha'];
		}
		
		
		//Sigo armando la estructura de la cabecera.
		$est.="
			<tr>
				<td colspan = '3' align = 'right' style = 'padding-left:10px;'>
					<img src = '../images/iconos/icon-19.png' width = '50px' onclick = 'cerrar_ventana_gen();'/>
				</td>
			</tr>
			</table>
			<table >
				<tr>
						<td >
							<p>Comentarios:</p>
							<textarea cols = '35' rows = '2' readonly style = 'background-color:darkgrey;color:white;'>$comentarios</textarea>
						</td>
						<td>
							<table width = '100%'>
								<tr>
									<td align = 'center'>
										<img class = 'mano' src = '../images/iconos/aprobado_ppto.png' width = '100px' onclick = 'aprobar_ppto($ppto,$vi,$vc,$id,$up_bottom)' />
									</td>
								</tr>
								<tr>
									<td align = 'center'>Aprobar Ppto</td>
								</tr>
							</table>
						</td>
						<td>
							<table width = '100%'>
								<tr>
									<td align = 'center'>
										<img class = 'mano' src = '../images/iconos/noaprobado_ppto.png' width = '100px' onclick = 'confirm_rechazo($ppto,$vi,$vc,$id)' />
									</td>
								</tr>
								<tr>
									<td align = 'center'>No Aprobar Ppto</td>
								</tr>
							</table>
						</td>
				</tr>
			</table>";
		
		
		
		$est.="</table>";
		
		
		echo $est;
		$ppto = new ppto_produccion();
		session_start();
		require("estructura_ppto_produccion.php");
		require("cabecera_ppto.php");
		require("cuerpo_ppto.php");
		require("footer_ppto.php");
	}
?>