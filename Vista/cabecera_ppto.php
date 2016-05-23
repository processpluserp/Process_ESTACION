<?php
	//EVALUO EL ESTADO DEL PPTO PARA SABER SI PUEDO ADICIONAR INFORMACION, COPIARLA O MODIFICARLA
	$boton_insertar_item = "";
	$boton_duplicar_copiar_item = "";
	$boton_adicionar_item = "";
	$boton_copiar_item ="";
	$boton_eliminar_item = "";
	$boton_valores_no_comisionables = "";
	$boton_historico_item = "";
	if($estado_ppto == 1 || $estado_ppto == 2 || $estado_ppto == 5 || $estado_ppto == 6){
		$boton_insertar_item = "<span onclick = 'addicionar_nuevo_item()'><img src = '../images/produccion/iconos-85.png' width = '25px' title = 'Insertar Item' /></br>Adicionar Item</span>";
		$boton_duplicar_copiar_item = "<span onclick = 'dubplicar_item_selected()' ><img src = '../images/produccion/iconos-86.png' width = '25px'  title = 'Copiar Item' /></br>Copiar Item</span>";
		$boton_copiar_item = "<span onclick = 'copiar_grupo_completo()'><img src = '../images/produccion/iconos-87.png' width = '25px' title = 'Copiar Grupo' /></br>Copiar Grupo</span>";
		$boton_eliminar_item = "<img src = '../images/iconos/eliminar.png' width = '15px' title = 'Eliminar Item' onclick = 'eliminar_item_creado()'/>";
		//$boton_adicionar_item = "<span onclick = 'add_nuevo_item()'><img src = '../images/iconos/add.png' width = '25px' title = 'Adicionar Item' /></br></span>";
		$boton_valores_no_comisionables = "<span onclick = 'sel_vnc_ppto()'><img src = '../images/produccion/iconos-88.png' width = '25px' title = 'Valores No Comisionables' /></br>No Comisional (VNC)</span>";
	}else if($estado_ppto == 5 || $estado_ppto == 6){
		$boton_historico_item = "<span class = 'botton_verde' onclick = 'historico_item()'>Histórico Item<img src = '../images/iconos/add.png' width = '15px' title = 'Histórico Item' /></span>";;
	}

	$cabecera_ppto_title = "
	<table width = '100%' style = 'border-collapse: collapse;'>
		<tr>
			<td></br></td>
		</tr>
		<tr>
			<td colspan = '17'>
				<table >
					<tr>
						<td align = 'left' class = 'dimension_tabla' nowrap style = 'padding-left:5px;text-align:center;'>$boton_insertar_item</td>
						<td align = 'left' class = 'dimension_tabla' nowrap style = 'padding-left:5px;text-align:center;'>$boton_duplicar_copiar_item</td>
						<td align = 'left' class = 'dimension_tabla' nowrap style = 'padding-left:5px;text-align:center;'>$boton_copiar_item</td>
						<td align = 'left' class = 'dimension_tabla' nowrap style = 'padding-left:5px;text-align:center;'>$boton_valores_no_comisionables</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td></br></td>
		</tr>
	</table>
	<div class = 'contenedor_cuerpo_ppto' style = 'overflow:scroll;'>
		<table width = '100%' class = 'tabla_ppto_xxx' style = 'border-collapse: collapse;'>
			<tr>
				<th colspan = '18' class = 'dil th_principal'>INTERNO</th>
				<th ></th>
				<th colspan = '3' class = 'ext th_principal'>EXTERNO</th>
				<th ></th>
				<th colspan = '2' class = 'dil th_principal' nowrap>RENTABILIDAD PARCIAL</th>
			</tr>
			
			<tr>
				<th class = 'border_table campos2' nowrap ></th>
				<th class = 'border_table campos2' nowrap >Sel.</th>
				<th class = 'border_table campos2' nowrap title = 'Anticipos'>Ant</th>
				<th class = 'border_table campos2' nowrap title = 'Valores No Comisionables'>VNC</th>
				<th class = 'border_table campos2' nowrap width = '30px'>OP/OC</th>
				<th class = 'border_table campos2' nowrap width = '30px'></th>
				<th class = 'border_table campos2' nowrap style = 'padding:5px;'>GRUPO</th>
				<th class = 'border_table campos2' nowrap style = 'padding:5px;'>NOMBRE ITEM</th>
				<th class = 'border_table campos2' nowrap style = 'padding:5px;'>DESCRIPCIÓN</th>
				<th class = 'border_table campos' nowrap style = 'padding:5px;'>PROVEEDOR</th>
				<th class = 'border_table campos' nowrap style = 'padding:5px;'>DIAS</th>
				<th class = 'border_table campos' nowrap style = 'padding:5px;'>CANT.</th>
				<th class = 'border_table campos' nowrap style = 'padding:5px;'>$ UNITARIO</th>				
				<th class = 'border_table subtotal' nowrap style = 'padding:5px;'>SUBTOTAL</th>
				<th class = 'border_table fondo_td' nowrap style = 'padding:5px;'>ANTICIPO</th>
				<th class = 'border_table fondo_td' nowrap style = 'padding:5px;'>% IVA</th>
				<th class = 'border_table fondo_td' nowrap style = 'padding:5px;'>% VOLUMEN</th>
				<th class = 'border_table fondo_td' nowrap style = 'padding:5px;'>COSTO INTERNO</th>
				<th ></th>
				<th class = 'border_table fondo_td' nowrap style = 'padding:5px;'>DESCRIPCIÓN</th>
				<th class = 'border_table fondo_td' nowrap style = ''>$ UNITARIO</th>
				<th class = 'border_table fondo_td' nowrap style = 'padding:5px;'>$ TOTAL</th>
				<th ></th>
				<th class = 'border_table fondo_td' align = 'center' style = 'padding:5px;'>%</th>
				<th class = 'border_table fondo_td' align = 'center' style = 'padding:5px;'>$</th>
			</tr>";
	echo $cabecera_ppto_title;
?>