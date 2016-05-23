<?php
	include("../Controller/Conexion.php");
	//session_start();
	include_once("../Modelo/gestion_cabecera.php");
	include_once("../Modelo/Empresa.php");
	
	
	$gestion = new cabecera_pagina();
	
	$emp = new Empresa();
	
	
	
	$estructura_ventana = "
	<table width = '100%' style = 'padding-left:50px;padding-right:50px;'>
			<tr>
				<td width = '96%' align = 'left'>
					<table width = '100%'>
						<tr>
							<td align = 'left'>
								".$emp->mostrar_logo_empresa($gestion->mostrar_empresa_empleado())."
							</td>
						</tr>
						<tr>
							<td align = 'left' >
								<span class = 'mensaje_bienvenida' >$titulo_ventana</span>
							</td>
						</tr>
					</table>
				</td>
				<td align = 'right' >
					<table width = '100%'>
						<tr>
							<td align = 'center'>
								<img onclick = '$cerrar_ventana' src = '../images/iconos/$icono_cerrar' class = 'iconos_opciones mano'/>
							</td>
						</tr>
					</table>
				</td>
			</tr>
	</table>";
?>