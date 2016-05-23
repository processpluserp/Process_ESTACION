<?php
	public class perfil_usuarios{
	
		public function menu_permisos($emp){
			$est = "<table width = '100%'>
				<tr>
					<th  class='titulo_padre_p' align = 'left' style = 'padding-left:20px;' onclick = 'ocultar_sub_menu_duplicar_nomina()'>EMPRESAS</th>
				</tr>
				<tr>
					<th  class='titulo_padre_p' align = 'left' style = 'padding-left:20px;' onclick = 'ocultar_sub_menu_duplicar_nomina()'>CLIENTES Y PRODUCTOS</th>
				</tr>
				<tr>
					<th  class='titulo_padre_p' align = 'left' style = 'padding-left:20px;' onclick = 'ocultar_sub_menu_duplicar_nomina()'>RESPONSABLE</th>
				</tr>
				<tr>
					<th  class='titulo_padre_p' align = 'left' style = 'padding-left:20px;' onclick = 'ocultar_sub_menu_duplicar_nomina()'>ASIGNADO</th>
				</tr>
			</table>";
			echo $est;
		}
	
	}
	
?>