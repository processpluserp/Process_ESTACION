<?php
	$footerE = '<div style = "width:100%;font-size:8px;">
		<table style = "font-size:8px;width:100%;border-top:1px solid black;">
			<tr>
				<td nowrap style = "width:33%;text-align:left;">
					Fecha de Impresión<br></br>'.date("Y-m-d h:i:s").'
				</td>
				<td style = "width:33%;text-align:center;">
					{PAGENO}
				</td>
				<td style = "text-align:right;font-size:7px;">
					<table>
						<tr>
							<td align = "center">
								© Process Plus. Todos los derechos reservados.<br></br>
								Prohibida la reproducción total o parcial.
							</td>
							<td>
								<img src = "../images/Untitled-1-01.png" height = "20px" />
							</td>
						</tr>
					</table>
				</td>
				
			</tr>
		</table></div>';
	$pdf->SetHTMLFooter($footerE);
	$pdf->SetHTMLFooter($footerE,'E');
?>