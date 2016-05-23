<?php
	include("../Controller/Conexion.php");
	require('../mpdf/mpdf.php');
	require('../Modelo/cabecera_ot.php');
	
	$otn = new cabecera_ot();
	$ppto = $_GET['ppto'];
	$vi = '';
	$vc = '';
	
	$sql = mysql_query("select e.logo,e.nit_empresa,p.fecha_registro,c.nombre_legal_clientes, pr.nombre_producto, p.referencia,p.ot,p.numero_presupuesto, em.nombre_empleado,e.observacion,con.uaai,c.codigo_interno_cliente,p.vi,p.vc
	from empresa e, cabpresup p, clientes c, cabot ot, producto_clientes pr,usuario u, empleado em, condiciones_cliente con
	where p.empresa_nit_empresa = e.cod_interno_empresa and p.codigo_presup = '$ppto' and p.pk_clientes_nit_cliente = c.codigo_interno_cliente and
	p.ot = ot.codigo_ot and ot.producto_clientes_codigo_PRC = pr.id_procliente and ot.ejecutivo = u.idusuario and u.pk_empleado = em.documento_empleado and p.tipo_comision = con.consecutivo");
	$logo = "";
	$nit_empresa = "";
	$fecha_registro = "";
	$cliente = "";
	$producto = "";
	$referencia="";
	$ot = "";
	$nombre_emp = "";
	$numero_ppto="";
	$observaci = "";
	$comision = 0;
	$version_interna = "";
	$version_externa = "";
	
	$pk_cliente = 0;
	
	while($row  = mysql_fetch_array($sql)){
		$logo = $row['logo'];
		//$nombre_empresa = $row['nombre_legal_empresa'];
		$nit_empresa = $row['nit_empresa'];
		$fecha_registro = $row['fecha_registro'];
		$cliente = $row['nombre_legal_clientes'];
		$pk_cliente = $row['codigo_interno_cliente'];
		$producto = $row['nombre_producto'];
		$referencia = $row['referencia'];
		$ot = $row['ot'];
		$numero_ppto = $row['numero_presupuesto'];
		$nombre_emp = $row['nombre_empleado'];
		$observaci = $row['observacion'];
		$comision = $row['uaai'];
		$version_interna = $row['vi'];
		$version_externa = $row['vc'];
	}
	$vi = $version_interna;
	$vc = $version_externa;
	$t='';		
	$grup = mysql_query("select distinct name_grupo as grupo from itempresup where ppto = '$ppto' and vi = '$vi' and vc = '$vc' and vnc = 0");
	$acum = 0;
	$acumm_iva = 0;
	$acumxx = 0;
	//$xxxx ="select distinct name_grupo as grupo from itempresup where ppto = '$ppto' and vi = '$vi' and vc = '$vc'";
	while($rowx = mysql_fetch_array($grup)){
		
		$celula = $rowx['grupo'];
		if($pk_cliente == 1){
			$t.='<tr><th colspan ="7" align = "center" class = "th_central">'.strtr(strtoupper(utf8_decode($rowx['grupo'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</th></tr>
			<tr>
				<th class = "th_sub">PROVEEDOR</th>
				<th class = "th_sub">ITEM</th>
				<th class = "th_sub" width = "45%" >DESCRIPCIÓN</th>
				<th class = "th_sub">VALOR UNIDAD</th>
				<th class = "th_sub">CANTIDAD</th>
				<th class = "th_sub">DÍAS</th>
				<th class = "th_sub">VALOR TOTAL</th>
			</tr>';
		}else{
			$t.='<tr><th colspan ="6" align = "center" class = "th_central">'.strtr(strtoupper(utf8_decode($rowx['grupo'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</th></tr>
			<tr>
				<th class = "th_sub">ITEM</th>
				<th class = "th_sub" width = "45%" >DESCRIPCIÓN</th>
				<th class = "th_sub">VALOR UNIDAD</th>
				<th class = "th_sub">CANTIDAD</th>
				<th class = "th_sub">DÍAS</th>
				<th class = "th_sub">VALOR TOTAL</th>
			</tr>';
		}
		
		
		
		
		$sql = mysql_query("select ip.asoc, ip.num_interno,ip.por_prov as volumen,ip.id, ip.dias, ip.q, ip.descripcion, ip.val_item, ip.fecha_ant, ip.por_ant, ip.cliente, ip.val_desde_item,
				ip.por_prov, ip.iva_item, p.nombre_legal_proveedor,ip.name_item,ip.descripcion2,ip.name_item as name
				from itempresup ip, proveedores p
				where ip.ppto = '$ppto' and ip.asoc = 0 and ip.name_grupo ='$celula' and ip.vi = '$vi' and ip.vc = '$vc'and ip.proveedor = p.codigo_interno_proveedor  order by ip.num_interno asc");
				
		$acum_x = 0;
		$acum_iva_colpatria = 0;
		while($row = mysql_fetch_array($sql)){
			$acum_x+=$row['cliente']*$row['q']*$row['dias'];
			$acum += $row['cliente']*$row['q']*$row['dias'];
			$acumxx += $row['cliente']*$row['q']*$row['dias'];
			$acumm_iva += (($row['cliente']*$row['q']*$row['dias'])*$row['iva_item'])/100;
			
			if($pk_cliente == 1){
				$t.='<tr>
					<td class = "fondo_items">'.$row['nombre_legal_proveedor'].'</td>
					<td class = "fondo_items">'.strtr(strtoupper(utf8_decode($row['name'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
					<td class = "fondo_items" width = "45%" >'.strtr(strtoupper(utf8_decode($row['descripcion'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
					<td class = "fondo_items">
						<table width = "100%" class ="internos">
							<tr>
								<td align = "left" width = "2%">$</td><td align = "right">'.number_format($row['cliente']).'</td>
							</tr>
						</table>
					</td>
					<td class = "fondo_items" align = "center">'.$row['q'].'</td>
					<td class = "fondo_items" align = "center">'.$row['dias'].'</td>
					<td class = "fondo_items">
						<table width = "100%" class ="internos">
							<tr>
								<td align = "left" width = "2%">$</td><td align = "right">'.number_format($row['cliente']*$row['q']*$row['dias']).'</td>
							</tr>
						</table>
					</td>
			</tr>';
			}else{
				$t.='<tr>
					<td class = "fondo_items">'.strtr(strtoupper(utf8_decode($row['name'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
					<td class = "fondo_items" width = "45%" >'.strtr(strtoupper(utf8_decode($row['descripcion'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
					<td class = "fondo_items">
						<table width = "100%" class ="internos">
							<tr>
								<td align = "left" width = "2%">$</td><td align = "right">'.number_format($row['cliente']).'</td>
							</tr>
						</table>
					</td>
					<td class = "fondo_items" align = "center">'.$row['q'].'</td>
					<td class = "fondo_items" align = "center">'.$row['dias'].'</td>
					<td class = "fondo_items">
						<table width = "100%" class ="internos">
							<tr>
								<td align = "left" width = "2%">$</td><td align = "right">'.number_format($row['cliente']*$row['q']*$row['dias']).'</td>
							</tr>
						</table>
					</td>
				</tr>';
			}
			
		}
		if($pk_cliente == 1){
			$t.='
				<tr class = "salto">
					<td colspan = "5"></td>
					<th class = "th_subtotales">SUBTOTAL</th>
					<td style = "border:1px solid black;">
						<table width = "100%" class ="internos" style = "font-weight:bold;">
							<tr>
								<td align = "left" width = "2%">$</td><td align = "right">'.number_format($acum_x).'</td>
							</tr>
						</table>
					</td>
				</tr>
				
				<tr class = "salto"><td ></br></td></tr>
				
				<tr class = "salto"><td ></br></td></tr>
				';	
		}else{
			$t.='
				<tr class = "salto">
					<td colspan = "4"></td>
					<th class = "th_subtotales">SUBTOTAL</th>
					<td style = "border:1px solid black;">
						<table width = "100%" class ="internos" style = "font-weight:bold;">
							<tr>
								<td align = "left" width = "2%">$</td><td align = "right">'.number_format($acum_x).'</td>
							</tr>
						</table>
					</td>
				</tr>
				
				<tr class = "salto"><td ></br></td></tr>
				
				<tr class = "salto"><td ></br></td></tr>
				';
		}
		
	}
	
	$cabecera_pdf = '<table class = "tabla_central" width = "100%" >
				<tr>
					<th align = "center" style ="padding-left:5px;vertical-align:top;font-size:11px;">
						<img src = "../images/logos/'.$logo.'" height = "50px" />
						NIT: '.$nit_empresa.'
					</th>
					<th width = "92%" align = "center" style = "vertical-align:middle;" >
						<span id = "titulo">PRESUPUESTO</span>
						<table  style = "font-size:11px;">
							<tr>
								<td>AG: </td>
								<td class = "decoration">'.$ppto.' v. '.$vi.'</td>
								<td style = "width:20px;"></td>
								<td>Cliente: </td>
								<td class = "decoration">'.$numero_ppto.' v. '.$vc.'</td>
							</tr>
						</table>
						
					</th>
					<th align = "center" style ="padding-right:5px;vertical-align:top;">
					</th>
				</tr>
				<tr><td></td></tr><tr><td></td></tr>
				<tr><td></td></tr><tr><td></td></tr>
			</table>			
			<table width = "100%" class = "tabla_central">
				<tr>
					<td class = "decoration">CLIENTE</td>
					<td class = "decoration_size">'.$cliente.'</td>
					
					<td class = "decoration">PRODUCTO</td>
					<td class = "decoration_size">'.$producto.'</td>
					
					<td style = "width:10%;" class = "decoration">OT</td>
					<td class = "decoration_size">'.strtoupper($ot).'</td>
				</tr>
				<tr>
					<td class = "decoration">EJECUTIVO</td>
					<td class = "decoration_size">'.strtoupper($nombre_emp).'</td>
					
					<td class = "decoration">REFERENCIA</td>
					<td class = "decoration_size">'.(strtoupper($referencia)).'</td>
				</tr>
			</table>';
	
	
	$contenedor_val_no_cm = '';
	$accc = 0;
	$cont = mysql_query("select id from itempresup where vnc = 1 and ppto = '$ppto' and vi = '$vi' and vc ='$vc'");
	if(mysql_num_rows($cont) > 0){
		$grup =mysql_query("select distinct vnc from itempresup where vnc = 1 and ppto = '$ppto' and vi = '$vi' and vc ='$vc' and asoc = 0 order by fecha_registro");
		while($rowx = mysql_fetch_array($grup)){
			$celula = $rowx['id'];
			if($pk_cliente == 1){
				$t.='<tr><th colspan ="7" align = "center" class = "th_central">VALORES NO COMISIONABLES</th></tr>
				<tr>
					<th class = "th_sub">PROVEEDOR</th>
					<th class = "th_sub">ITEM</th>
					<th class = "th_sub" width = "45%" >DESCRIPCIÓN</th>
					<th class = "th_sub">VALOR UNIDAD</th>
					<th class = "th_sub">CANTIDAD</th>
					<th class = "th_sub">DÍAS</th>
					<th class = "th_sub">VALOR TOTAL</th>
				</tr>';
			}else{
				$t.='<tr><th colspan ="6" align = "center" class = "th_central">VALORES NO COMISIONABLES</th></tr>
				<tr>
					<th class = "th_sub">ITEM</th>
					<th class = "th_sub" width = "45%" >DESCRIPCIÓN</th>
					<th class = "th_sub">VALOR UNIDAD</th>
					<th class = "th_sub">CANTIDAD</th>
					<th class = "th_sub">DÍAS</th>
					<th class = "th_sub">VALOR TOTAL</th>
				</tr>';
			}
			
			
			$sql = mysql_query("select ip.asoc, ip.num_interno, ip.por_prov as volumen,ip.id, ip.dias, ip.q, ip.descripcion, ip.val_item, ip.fecha_ant, ip.por_ant, ip.cliente, ip.val_desde_item,
					ip.por_prov, ip.iva_item, p.nombre_legal_proveedor,ip.name_item as name, ip.descripcion2
					from itempresup ip, proveedores p
					where ip.ppto = '$ppto' and ip.asoc = 0  and ip.vnc =1 and ip.proveedor = p.codigo_interno_proveedor order by ip.num_interno asc");
			
			
			$acum_x = 0;
			while($row = mysql_fetch_array($sql)){
				$acum_x+=$row['cliente']*$row['q']*$row['dias'];
				$acum += $row['cliente']*$row['q']*$row['dias'];
				$accc +=$row['cliente']*$row['q']*$row['dias'];
				$acumm_iva += (($row['cliente']*$row['q']*$row['dias'])*$row['iva_item'])/100;
				if($pk_cliente == 1){
					$t.='<tr>
					<td  class = "fondo_items">'.strtr(strtoupper(utf8_decode($row['nombre_legal_proveedor'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
					<td  class = "fondo_items">'.strtr(strtoupper(utf8_decode($row['name'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
					<td class = "fondo_items" width = "30%">'.strtr(strtoupper(utf8_decode($row['descripcion'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
					<td class = "fondo_items">
						<table width = "100%" class ="internos">
							<tr>
								<td align = "left" width = "2%">$</td><td align = "right">'.number_format($row['cliente']).'</td>
							</tr>
						</table>
					</td>
					<td class = "fondo_items" align = "center">'.$row['q'].'</td>
					<td class = "fondo_items" align = "center">'.$row['dias'].'</td>
					<td class = "fondo_items">
						<table width = "100%" class ="internos">
							<tr>
								<td align = "left" width = "2%">$</td><td align = "right">'.number_format($row['cliente']*$row['q']*$row['dias']).'</td>
							</tr>
						</table>
					</td>
				</tr>';
				}else{
					$t.='<tr>
					<td  class = "fondo_items">'.strtr(strtoupper(utf8_decode($row['name'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
					<td class = "fondo_items" width = "30%">'.strtr(strtoupper(utf8_decode($row['descripcion'])),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ").'</td>
					<td class = "fondo_items">
						<table width = "100%" class ="internos">
							<tr>
								<td align = "left" width = "2%">$</td><td align = "right">'.number_format($row['cliente']).'</td>
							</tr>
						</table>
					</td>
					<td class = "fondo_items" align = "center">'.$row['q'].'</td>
					<td class = "fondo_items" align = "center">'.$row['dias'].'</td>
					<td class = "fondo_items">
						<table width = "100%" class ="internos">
							<tr>
								<td align = "left" width = "2%">$</td><td align = "right">'.number_format($row['cliente']*$row['q']*$row['dias']).'</td>
							</tr>
						</table>
					</td>
				</tr>';
				}
			}
			if($pk_cliente == 1){					
				$t.='
					<tr class = "salto">
						<td colspan = "5"></td>
						<th class = "th_subtotales" >SUBTOTAL</th>
						<td style = "border:1px solid black;">
							<table width = "100%" class ="internos" style = "font-weight:bold;">
								<tr>
									<td align = "left" width = "2%">$</td><td align = "right">'.number_format($acum_x).'</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr class = "salto"><td ></br></td></tr>
					
					<tr class = "salto"><td ></br></td></tr>
					';
			}else{
				$t.='
					<tr class = "salto">
						<td colspan = "4"></td>
						<th class = "th_subtotales" >SUBTOTAL</th>
						<td style = "border:1px solid black;">
							<table width = "100%" class ="internos" style = "font-weight:bold;">
								<tr>
									<td align = "left" width = "2%">$</td><td align = "right">'.number_format($acum_x).'</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<tr class = "salto"><td ></br></td></tr>
					
					<tr class = "salto"><td ></br></td></tr>
					';
			}
			
		}
	}
	$contenedor_val_no_cm.='<tr class = "salto">
		<td colspan = "4"></td>
		<th class = "th_subtotales" nowrap>NO COMISIONABLES</th>
		<td class = "fondo_items" style = "border:1px solid white;" >
			<table width = "100%" class ="internos" style = "font-weight:bold;">
				<tr>
					<td align = "left" width = "2%">$</td><td align = "right">'.number_format($accc).'</td>
				</tr>
			</table>
		</td>
	</tr>
	';
	$contenedor_val_no_cmx.='<tr class = "salto">
		<td colspan = "5"></td>
		<th class = "th_subtotales" nowrap>NO COMISIONABLES</th>
		<td class = "fondo_items" style = "border:1px solid white;">
			<table width = "100%" class ="internos" style = "font-weight:bold;">
				<tr>
					<td align = "left" width = "2%">$</td><td align = "right">'.number_format($accc).'</td>
				</tr>
			</table>
		</td>
	</tr>
	';
	
	$xt = '';
	if($pk_cliente == 1){
		$xt.='<tr  class = "salto">
				<td colspan = "5"></td>
				<th class = "th_subtotales" >SUBTOTAL</th>
				<td class = "fondo_items" style = "border:1px solid white;">
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.number_format($acumxx).'</td>
						</tr>
					</table>
				</td>
			</tr>
			'.$contenedor_val_no_cmx.'
			
			<tr class = "salto">
				<td colspan = "5"></td>
				<th class = "th_subtotales" NOWRAP>COMISIÓN</th>
				<td class = "fondo_items" style = "border:1px solid white;">
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">0</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr class = "salto">
				<td colspan = "5"></td>
				<th class = "th_subtotales" NOWRAP>ANTES DE IVA</th>
				<td class = "fondo_items" style = "border:1px solid white;">
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.number_format($comi + $acumxx +$accc).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr class = "salto">
				<td colspan = "5"></td>
				<th class = "th_subtotales" NOWRAP>IVA</th>
				<td class = "fondo_items" style = "border:1px solid white;">
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.number_format($acumm_iva).'</td>
						</tr>
					</table>
				</td>
			</tr>
			
			<tr class = "salto">
				<td colspan = "5"></td>
				<th class = "th_subtotales" >TOTAL</th>
				<td class = "fondo_items" style = "border:1px solid white;">
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.
							number_format( $acumxx +  $comi + $accc+ $acumm_iva).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr class = "salto"><td ></br></td></tr>
			<tr class = "salto"><td ></br></td></tr>
			';
	}else{
		$uaai = 0;
		$comi = 0;
		$sql = mysql_query("select cc.uaai,cc.tipo, p.pk_clientes_nit_cliente 
		from cabpresup p, condiciones_cliente cc
		where p.codigo_presup = '$ppto' and p.pk_clientes_nit_cliente = cc.cliente  AND p.tipo_comision = cc.consecutivo");
		while($row = mysql_fetch_array($sql)){
			$uaai = $row['uaai'];
			$real = (100-$uaai)/100;
			if($row['tipo'] == 1){
				$comi = ($acumxx/$real)-$acumxx;
			}
			else if($row['tipo'] == 2){
				$comi = $acumxx*($uaai/100);
			}
		}
		$xt.='<tr  class = "salto">
				<td colspan = "4"></td>
				<th class = "th_subtotales" >SUBTOTAL</th>
				<td class = "fondo_items" style = "border:1px solid white;">
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.number_format($acumxx).'</td>
						</tr>
					</table>
				</td>
			</tr>
			'.$contenedor_val_no_cm.'
			
			<tr class = "salto">
				<td colspan = "4"></td>
				<th class = "th_subtotales" NOWRAP>COMISIÓN</th>
				<td class = "fondo_items" style = "border:1px solid white;">
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.number_format($comi).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr class = "salto">
				<td colspan = "4"></td>
				<th class = "th_subtotales" NOWRAP>ANTES DE IVA</th>
				<td class = "fondo_items" style = "border:1px solid white;">
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.number_format($comi + $acumxx +$accc).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr class = "salto">
				<td colspan = "4"></td>
				<th class = "th_subtotales" NOWRAP>IVA</th>
				<td class = "fondo_items" style = "border:1px solid white;">
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.number_format((($comi + $acumxx +$accc)*16)/100).'</td>
						</tr>
					</table>
				</td>
			</tr>
			
			<tr class = "salto">
				<td colspan = "4"></td>
				<th class = "th_subtotales" >TOTAL</th>
				<td class = "fondo_items" style = "border:1px solid white;">
					<table width = "100%" class ="internos" style = "font-weight:bold;">
						<tr>
							<td align = "left" width = "2%">$</td><td align = "right">'.
							number_format( $acumxx +  $comi + $accc+ ((($comi + $acumxx+$accc)*16)/100)).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr class = "salto"><td ></br></td></tr>
			<tr class = "salto"><td ></br></td></tr>
			';
	}
		
	$html = '
			<head>
				<meta http-equiv="Content-Type" charset=utf-8" />
				<title>PPTO No. '.$ppto.' v.'.$vi.'-PPTO No. '.$vc.'</title>
				<style type="text/css">
					body{
						font-family:"Arial";
					}
					
					#titulo{
						font-size:26px;
					}
					
					
					#tabla_items th{
						
					}
					#tabla_items td{
						border:1px solid white;
						font-size:10px;
					}
					.fondo_items{
						background-color:#E5E5E5;
						border:1px solid white;
						padding-left:3px;
					}
					.internos td{
						border:0px solid white;
						
					}
					.internos2{
						border:1px solid black;
					}
					.salto td{
						border:0px solid tranparent;
					}
					@page *{
						margin:0px;
					}
					.decoration{
						background-color:#E6E7E9;
						font-weight:bold;
						padding:5px;
						font-size:12px;
					}
					.decoration_size{
						font-size:12px;
					}
					.th_central{
						background-color:#ACB9C9;
						color:white;
					}
					.th_sub{
						border:1px solid white;
						border-radius:3em;
						border-radius:3mm;
						border-radius:3px;
						background-color:#F8F0B1;
						color:#71675D;
						text-align:center;
						font-size:11px;
					}
					.th_subtotales{
						background-color:#FEA807;
						border:1px solid white;
					}
				</style>
			</head>
			
			<body >
			
			<table width = "100%" id = "tabla_items" style = "border-collapse:collapse;border:1px solid white;" >			
				'.$t.'
			
			'.$xt.'
			<tr class = "salto">
				<td>
					<table width = "100%" class = "internos">
						<tr>
							<td style = "padding-bottom:20px;padding-right:10px;">FIRMA CLIENTE</td>
							<td style = "vertical-align:top;">_________________________________________________</td>
						</tr>
						<tr></tr>
						<tr>
							<td style = "padding-bottom:20px;padding-right:10px;">FECHA FIRMA</td>
							<td>_________________________________________________</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td><br></br></td></tr>
			<tr><td><br></br></td></tr>
			
			<tr class = "salto">
				<td colspan = "6" style = "text-align:justify;font-size:8px;"><strong>NOTA</strong>: '.$observaci.'</td>
			</tr>
			</table>
			<body>';
	//$pdf = new mPDF('utf-8', array(279,210));
	$pdf=new mPDF('en-x','Letter-L','','',20,20,60,55,5,5);
	$pdf->mirrorMargins = true;
	$pdf->AliasNbPages();
	$pdf->SetAutoPageBreak(true, 12);
 
	
	$pdf->SetFont('Arial','B',10);
	
	$pdf->SetHTMLHeader($cabecera_pdf);
	$cb = $cabecera_pdf;
	$pdf->SetHTMLHeader($cb,'E');
	
	
	include("footer_pdf.php");
	//$stylesheet = file_get_contents('ppto.css');
	//$pdf->WriteHTML($stylesheet,1);
	$pdf->WriteHTML($html);

	$pdf->Output('PPTO '.$_GET['ppto'].'.pdf', 'I');
?>