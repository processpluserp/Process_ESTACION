<?php

$post_ot = $_POST['ot'];
$post_copiados = $_POST['copiados'];
$post_asu = $_POST['asu'];
$post_tp = $_POST['tp'];
$post_lu = $_POST['lu'];
$post_ct = $_POST['ct'];
$post_ccie = $_POST['ccie'];
$post_ac = $_POST['ac'];
$post_hf = $_POST['hf'];
$post_ig = $_POST['ig'];
$post_hi = $_POST['hi'];
$post_fec = $_POST['fec'];
$post_nan = $_POST['nan'];
$post_archadj = $_POST['archadj'];
$post_caie = $_POST['caie'];


include("../Controller/Conexion.php");

$result=mysql_query('select cl.nombre_comercial_cliente FROM cabot as ca, clientes as cl WHERE ca.codigo_ot = "'.$post_ot.'" AND ca.producto_clientes_pk_clientes_nit_procliente = cl.codigo_interno_cliente
	');

//var_dump($result);

$cliente='';


while ($row = mysql_fetch_assoc($result)) {
    $cliente.=  $row['nombre_comercial_cliente'];
}

function cleanagencia($str){


$arreglo = json_decode($str);

$send='';

foreach ($arreglo as $value) {

	$tmp = explode('- ',$value);
	$send.='- '.$tmp[0];
	$send.='<br>';
}


return $send;


}


function organizearc($str){

$send='';

foreach(json_decode($str) as $item){

	$send.= '- '.$item.'<br>';

}

return $send;

}

function obtenerLista($str){

	//var_dump($str);

	$contador=1;

	$str = json_decode($str);

	//var_dump($str);

	$send='';

	foreach($str as $item){

		$tmp= $contador.'. '.str_replace('<***+++>', '<br>', $item)	;


		$send.=	'<tr>

			<td class="itemvalue" colspan="4">'.$tmp.'</td>

			</tr>';

		$contador++;



	}


	return $send;

}


function ordenarCompromisosAgencia($str){



	$send='';

	$str = json_decode($str);

	$contar=1;


	foreach($str as $item){
	
		$arreglo =explode('<***+++>',$item);
		//<tr class="spacetr"></tr>


		$send.='


		<tr>

		<td class="itemvalue" width = "25%">'.$contar.'. '.$arreglo[1].'</td>
		<td class="itemvalue" width = "15%" align="center">'.$arreglo[2].'</td>

		<td class="itemvalue" colspan="2">'.$arreglo[3].'</td>

		</tr>
		';
		$contar++;

	}

	

	
	return $send;
	
}


function ordenarCompromisosCliente($str){

	$send='';


	$contar=1;

	$str = json_decode($str);



	foreach($str as $item){
	
		$arreglo =explode('<***+++>',$item);

//<tr class="spacetr"></tr>

		$send.='

		

		<tr>

		<td class="itemvalue" width = "25%">'.$contar.'. '.$arreglo[0].'</td>
		<td class="itemvalue" width = "15%" align="center">'.$arreglo[1].'</td>

		<td class="itemvalue" colspan="2">'.$arreglo[2].'</td>

		</tr>
		';
		$contar++;

	}

	

	
	return $send;

}

//BUSCO EL NOMBRE DEL CLIENTE
$nombre_cliente = "";

	$sql =mysql_query("select c.nombre_legal_clientes
	from clientes c, cabot t
	where t.codigo_ot = '".$_POST['ot']."' and t.producto_clientes_pk_clientes_nit_procliente = c.codigo_interno_cliente");
	while($row = mysql_fetch_array($sql)){
		$nombre_cliente = $row['nombre_legal_clientes'];
	}

//--------------------------------------------------------------------------------------------------
//TEMAS DE LA REUNIÓN
$list_temas = "";
$temas = $_POST['ct'];
	$list_temas = "<table width = '100%' class = 'tabla_comprimosos_ies'>";
	for($i = 0;$i < count($temas);$i++){
		$temp = $i + 1;
		$info = explode("<***+++>",$temas[$i]);
		$list_temas.="<tr><td style = 'text-align:justify'>$temp. ".nl2br($info[0])."</td>";
	}
	$list_temas.="</table>";
//--------------------------------------------------------------------------------------------------

//COMPROMISOS CLIENTE
$listad_compromisos_cliente = "";
$comp_agencia = $_POST['ccie'];
$listad_compromisos_cliente = "<table width = '100%' class = 'tabla_comprimosos_ie'><tr><th>NOMBRE</th><th>FECHA</th><th>COMPROMISO</th></tr>";
for($i = 0;$i < count($comp_agencia);$i++){
	$temp = $i + 1;
	$info = explode("<***+++>",$comp_agencia[$i]);
	$listad_compromisos_cliente.="<tr>
		<td width = '25%' style = 'border:1px solid black;padding-left:5px;'>$temp. ".$info[0]."</td>
		<td nowrap width = '10%' align = 'center' style = 'border:1px solid black;padding-left:5px;'>".$info[1]."</td>
		<td style = 'text-align:justify;border:1px solid black;padding-left:5px;'>".nl2br($info[2])."</td>
	</tr>";
}
$listad_compromisos_cliente.="</table>";


//COMPROMISOS AGENCIA
$listad_compromisos_empresa = "";
$comp_agencia = $_POST['caie'];
	$listad_compromisos_empresa = "<table width = '100%' class = 'tabla_comprimosos_ie'><tr><th>NOMBRE</th><th>FECHA</th><th>COMPROMISO</th></tr>";
	for($i = 0;$i < count($comp_agencia);$i++){
		$temp = $i + 1;
		$info = explode("<***+++>",$comp_agencia[$i]);
		$listad_compromisos_empresa.="<tr>
			<td width = '25%' style = 'border:1px solid black;padding-left:5px;'>$temp. ".$info[1]."</td>
			<td nowrap width = '10%' align = 'center' style = 'border:1px solid black;padding-left:5px;'>".$info[2]."</td>
			<td style = 'text-align:justify;border:1px solid black;padding-left:5px;'>".nl2br($info[3])."</td>
		</tr>";
	}
	$listad_compromisos_empresa.="</table>";
	
//ASISTENTES DEL CLIENTE
$clie = "";
$asis_clientex = $_POST['ac'];
	if(count($asis_clientex) > 0){
		for($i = 0;$i < count($asis_clientex);$i++){
			$info = explode(" - ",$asis_clientex[$i]);
			$clie.="<li>".$info[0]."</li>";
		}
	}
$emp = "";
$asis_list = $_POST['nan'];
	for($i = 0;$i < count($asis_list);$i++){
		$emp.="<li>".($asis_list[$i])."</li>";
	}
	
//BUSCO LA IMAGEN DE LA COMPAÑÍA
$sql = mysql_query("select e.logo from empresa e, cabot ot 
where ot.codigo_ot = '".$_POST['ot']."' and ot.pk_nit_empresa_ot = e.cod_interno_empresa");
$img_logo = "";
while($row = mysql_fetch_array($sql)){
	$img_logo = "<img src = '../images/logos/".$row['logo']."' height = '60px'/>";
}

echo "
<html>
	<head>
		<link type='text/css' href='../css/tablas.css' rel='stylesheet'>
		<link type='text/css' href='../css/cabecera.css' rel='stylesheet'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		
		<style type = 'text/css'>
			.tabla_comprimosos_ie th{
				border:1px solid black;
				background-color:white;
			}
			.tabla_comprimosos_ie td{
				border:1px solid black;
			}
			.tabla_comprimosos_ie th:first-child{
				border-top-left-radius:0.3em;
				-moz-border-top-left-radius:0.3em;
				-webkit-border-top-left-radius:0.3em;
			}
			.tabla_comprimosos_ie th:last-child{
				border-top-right-radius:0.3em;
				-moz-border-top-right-radius:0.3em;
				-webkit-border-top-right-radius:0.3em;
			}
		</style>
	</head>
<body>
	<table width = '100%' style = 'font-color:black;padding-left:50px;padding-right:50px;'>
		<tr>
			<td colspan = '3' width = '96%'>
				<span class = 'mensaje_bienvenida'>PREVISUALIZACIÓN INFORME DE ENTREVISTA PARA OT ".$post_ot."</span>
			</td>
			<td align = 'right'>
				<img id='close_intent_x' src='../images/iconos/icon-18.png' class='iconos_opciones mano' onclick = 'cerrar_ventana_visual_ie();'>
			</td>
		</tr>
	</table>
<table width = '100%' style = 'font-color:black;padding-left:50px;padding-right:50px;'>
	<tr>
		<td>
			$img_logo
		</td>
	</tr>
	<tr>
		<td>
			<span class = 'mensaje_bienvenida' style = 'font-size:60;color:black;font-weight: 900;'>INFORME DE ENTREVISTA</span>
		</td>
	</tr>
	<tr >
		<td colspan = '5' style = 'border:1px solid black;border-radius:0.3em;-webkit-border-radius:0.3em;-moz-border-radius:0.3em;text-align:center;'>
			<table width = '100%'>
				<tr>
					<td style = 'text-align:left;padding-left:5%;'>
						<strong><p style = 'font-size:30;color:black;'>".("CLIENTE").":</strong> ".utf8_decode($nombre_cliente)."</p>
					</td>
					<td style = 'text-align:left;padding-right:5%;'>
						<strong><p>REFERENCIA:</strong> ".($post_asu)."</p>
					</td>
				</tr>
				<tr>
					<td style = 'text-align:left;padding-left:5%;'>
						<strong><p style = 'font-size:30;color:black;'>".("FECHA DE REUNIÓN Y LUGAR").":</strong> ".$post_fec."; ".($post_lu)."</p>
					</td>
					<td style = 'text-align:left;padding-right:5%;'>
						<strong><p>TIPO DE ".("REUNIÓN").":</strong> ".($post_tp)."</p>
					</td>
				</tr>
				<tr>
					<td style = 'text-align:left;padding-left:5%;'>
						<strong><p>HORA DE INICIO:</strong> ".$post_hi."</p>
					</td>
					<td style = 'text-align:left;padding-right:5%;'>
						<strong><p>HORA ".("FINALIZACIÓN").":</strong> ".$post_hf."</p>
					</td>
				</tr>
				<tr>
					<td style = 'text-align:left;padding-left:5%;vertical-align:top;'>
						<strong><p>ASISTENTES AGENCIA:</p></strong>
						<ul>".$emp."</ul>
					</td>
					<td style = 'text-align:left;padding-right:5%;vertical-align:top;'>
						<strong><p>ASISTENTES CLIENTE:</p></strong>
						<ul>".$clie."</ul>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td></br></td></tr>
	<tr>
		<td colspan = '5' style = 'border:1px solid black;border-radius:0.3em;-webkit-border-radius:0.3em;-moz-border-radius:0.3em;text-align:center;'>
			<table width = '100%'>
				<tr>
					<td style = 'border:1px solid black;border-radius:0.3em;-webkit-border-radius:0.3em;-moz-border-radius:0.3em;text-align:center;'>
						<strong><p>NOTA</p></strong>
					</td>
				</tr>
				<tr>
					<td>
						<strong><p style = 'text-align:justify;'>".("Después")." de 24 horas de recibir este correo, sino hay respuesta por parte del Cliente, se ".("entenderá")." que no hay ninguna ".("observación")." al respecto.</p></strong>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td></br></td></tr>
	<tr>
		<td colspan = '5' style = 'border:1px solid black;border-radius:0.3em;-webkit-border-radius:0.3em;-moz-border-radius:0.3em;text-align:center;'>
			<table width = '100%'>
				<tr>
					<td style = 'border:1px solid black;border-radius:0.3em;-webkit-border-radius:0.3em;-moz-border-radius:0.3em;text-align:center;'>
						<strong><p>".("INFORMACIÓN")." GENERAL</p></strong>
					</td>
				</tr>
				<tr>
					<td style = 'text-align:justify;padding-left:10px;'>
						".nl2br(($post_ig))."
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td></br></td></tr>
	<tr>
		<td colspan = '5' style = 'border:1px solid black;border-radius:0.3em;-webkit-border-radius:0.3em;-moz-border-radius:0.3em;text-align:center;'>
			<table width = '100%'>
				<tr>
					<td style = 'border:1px solid black;border-radius:0.3em;-webkit-border-radius:0.3em;-moz-border-radius:0.3em;text-align:center;'>
						<strong><p>TEMAS TRATADOS</p></strong>
					</td>
				</tr>
				<tr>
					<td>
						<p style = 'text-align:justify;'>".($list_temas)."</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td></br></td></tr>
	<tr>
		<td colspan = '5' style = 'border:1px solid black;border-radius:0.3em;-webkit-border-radius:0.3em;-moz-border-radius:0.3em;text-align:center;'>
			<table width = '100%'>
				<tr>
					<td style = 'border:1px solid black;border-radius:0.3em;-webkit-border-radius:0.3em;-moz-border-radius:0.3em;text-align:center;'>
						<strong><p>COMPROMISOS AGENCIA</p></strong>
					</td>
				</tr>
				<tr>
					<td>
						<p style = 'text-align:justify;'>".($listad_compromisos_empresa)."</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td></br></td></tr>
	<tr>
		<td colspan = '5' style = 'border:1px solid black;border-radius:0.3em;-webkit-border-radius:0.3em;-moz-border-radius:0.3em;text-align:center;'>
			<table width = '100%'>
				<tr>
					<td style = 'border:1px solid black;border-radius:0.3em;-webkit-border-radius:0.3em;-moz-border-radius:0.3em;text-align:center;'>
						<strong><p>COMPROMISOS CLIENTES</p></strong>
					</td>
				</tr>
				<tr>
					<td>
						<p style = 'text-align:justify;'>".($listad_compromisos_cliente)."</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
";

?>