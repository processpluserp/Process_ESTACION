<?php
	class pptado_real{
		
		
		
		
		public function cabecera_estructura(){
			$est = "<table width = '100%'>
				<tr>
					<th>".date("Y")."</th>
				</tr>
			";
		}
		
		public function meses($imp){
			$imp .="
				<tr>
					<th></th>
					<th class = 'separator'></th>
					<th></th>
					<th class = 'separator'></th>
					<th class = 'valores_conceptos' colspan = '2'>ENERO</th>
					<th class = 'separator'></th>
					<th class = 'valores_conceptos' colspan = '2'>FEBRERO</th>
					<th class = 'separator'></th>
					<th class = 'valores_conceptos' colspan = '2'>MARZO</th>
					<th class = 'separator'></th>
					<th class = 'valores_conceptos' colspan = '2'>ABRIL</th>
					<th class = 'separator'></th>
					<th class = 'valores_conceptos' colspan = '2'>MAYO</th>
					<th class = 'separator'></th>
					<th class = 'valores_conceptos' colspan = '2'>JUNIO</th>
					<th class = 'separator'></th>
					<th class = 'valores_conceptos' colspan = '2'>JULIO</th>
					<th class = 'separator'></th>
					<th class = 'valores_conceptos' colspan = '2'>AGOSTO</th>
					<th class = 'separator'></th>
					<th class = 'valores_conceptos' colspan = '2'>SEPTIEMBRE</th>
					<th class = 'separator'></th>
					<th class = 'valores_conceptos' colspan = '2'>OCTUBRE</th>
					<th class = 'separator'></th>
					<th class = 'valores_conceptos' colspan = '2'>NOVIEMBRE</th>
					<th class = 'separator'></th>
					<th class = 'valores_conceptos' colspan = '2' >DICIEMBRE</th>
					<th class = 'separator'></th>
					<th class = 'valores_conceptos' colspan = '2'>TOTAL</th>
				</tr>
				";
		}
		
		public function llenar_clientes($imp){
			
		}
	}
?>