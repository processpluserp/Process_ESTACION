<?php
	$titulo_ventana = "BUSCAR PRESUPUESTO";
	$cerrar_ventana = "cerrar_ventanas_buscar_ppto();";
	$icono_cerrar = "icon-19.png";
	include("encabezado_vista.php");
	
	if(!empty($_POST["user"])){
		$estructura_ventana.="
	<table class = 'barra_busqueda2' style = 'padding-left:50px;padding-right:50px;' >
		<tr>
			<td>
				<p>Seleccione una Empresa:</p>
				<select id = 'empresa_carga' onchange = 'formbuscar_empresa();' style = 'width:200px;'>
					<option value = '0'>[SELECCIONE]</option>";
					
						$usu = $_POST["user"];
						$select_emp = "select distinct e.cod_interno_empresa, e.nombre_comercial_empresa from empresa e, pusuemp p where 
						p.cod_usuario = '$usu' and p.cod_empresa = e.cod_interno_empresa order by e.nombre_comercial_empresa asc";
						$result = mysql_query($select_emp);
						while($row = mysql_fetch_array($result)){
							$estructura_ventana.="<option value ='".$row['cod_interno_empresa']."'>".$row['nombre_comercial_empresa']."</option>";
						}
				$estructura_ventana.="</select>
			</td>
			<td style = 'padding-left:20px;'>
				<p>Seleccione un Cliente:</p>
				<select id = 'cliente_carga' style = 'width:200px;' onchange = 'formbuscar_cliente();'></select>
			</td>
			<td style = 'padding-left:20px;'>
				<p>OT</p>
				<select id = 'ot_carga' style = 'width:200px;'></select>
			</td>
			<td style = 'vertical-align:bottom;' align = 'right'>
				<a href = '#'id = 'bus' onclick = 'buscar_ppto_sel_ot()'>
					<img src = '../images/iconos/lupa_naranja.png' class = 'botones_opciones mano' title = 'Buscar OTs' />
				</a>
			</td>
		</tr>
		<tr>
			<td></br></td>
		</tr>
	</table>
	<table style = 'padding-left:50px;padding-right:50px;' width = '100%'>
		<tr>
			<td style = 'width:100%;'>
				<div id = 'pptos_realizados' style = 'overflow:scroll;background-color:rgb(221, 221, 221);border-radius:0.3em;-webkit-border-radius:0.3em;-moz-border-radius:0.3em;'></div>
			</td>
		</tr>
	</table>
	
	<script type = 'text/javascript'>
		var alto = $(window).height();
		var x = (alto*100)/100;
		$('#pptos_realizados').css({'height':(x*62)/100});
	</script>";
	}else{
		$estructura_ventana.="<table width = '100%'>
			<tr>
				<th align = 'center'>SU SESIÓN A TERMINADO, POR FAVOR INICIE SU SESIÓN NUEVAMENTE</th>
			</tr>
			<tr>
				<th>
					<a href = '../logeo.php'>
						<img src = '../images/iconos/home.png' class = 'mano'width = '100px' />
					</a>
				</th>
			</tr>
		</table>";
	}
	echo $estructura_ventana;
	
	
?>	