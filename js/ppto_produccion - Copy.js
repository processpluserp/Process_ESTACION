var formatNumber = {
	separador: ",", // separador para los miles
	sepDecimal: '.', // separador para los decimales
	formatear:function (num){
	num +='';
	var splitStr = num.split(',');
	var splitLeft = splitStr[0];
	var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
	var regx = /(\d+)(\d{3})/;
	while (regx.test(splitLeft)) {
		splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
	}
	return this.simbol + splitLeft  +splitRight;
	 },
	new:function(num, simbol){
	  this.simbol = simbol ||'';
	 return this.formatear(num);
	 }
	 }

$(document).ready(function(){
	//Fecha
	$("#fecha_anticipo").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#t_imp").text("0");
	$("#t_imp_o").text("0");
	$("#t_ga_o").text("0");
	$("#t_ga").text("0");
	$("#imp_p").val("0");
	$("#ga_p").val("0");
	
	var por = $("#imp_p").val();
	var vl = $("#vl_o").text();
	$("#t_imp").text(por*vl);
	var por = $("#ga_p").val();
	var vl = $("#vl_o").text();
	$("#t_ga").text(por*vl);
	
	$("#imp_p").on('keyup',function(){
		var por = $("#imp_p").val();
		var vl = $("#vl_o").text();
		$("#t_imp").text(formatNumber.new(Math.round(por*vl)));
		$("#t_imp_o").text(Math.round(por*vl));
		
		//Total Actividad
		$("#total_actividad").text(formatNumber.new(Math.round(parseFloat($("#tce_o").text()) + parseFloat($("#t_imp_o").text()) + parseFloat($("#t_ga_o").text()) + parseFloat($("#t_uaai_o").text()))));
		$("#total_actividad_o").text( parseFloat($("#tce_o").text()) + parseFloat($("#t_imp_o").text()) + parseFloat($("#t_ga_o").text()) + parseFloat($("#t_uaai_o").text()));
		
		//Total Actividad 2
		$("#total_actividad2").text(formatNumber.new(Math.round(parseFloat($("#tce_o").text()) + parseFloat($("#t_imp_o").text()) + parseFloat($("#t_ga_o").text()) + parseFloat($("#t_uaai_o").text()))));
		$("#total_actividad2_o").text( parseFloat($("#tce_o").text()) + parseFloat($("#t_imp_o").text()) + parseFloat($("#t_ga_o").text()) + parseFloat($("#t_uaai_o").text()));
		
		//Utilidad Comercial
		$("#utilidad_comercial").text(formatNumber.new(parseFloat($("#tocpd").text()) + parseFloat($("#2vnc").text()) + parseFloat($("#2t_uaai_o").text())));
		
		//Volumen
		$("#vol_ppto").text(Math.round( (parseFloat($("#utilidad_comercial_o").text())/parseFloat($("#total_actividad_o").text()))*100));
		
		//Utilidad Marginal
		$("#um_ppto").text(Math.round( (parseFloat($("#tocpd_o").text())/parseFloat($("#vl_o").text()))*100));
		
		//Valor de la Retención en la Fuente.
		var refuente = (parseFloat($("#val_retefuente").text())/100);
		$("#valor_retefuente_o").text(refuente * parseFloat($("#total_actividad2_o").text()));
		$("#valor_retefuente").text(formatNumber.new(Math.round(refuente * parseFloat($("#total_actividad2_o").text()))));
		
		//Valor del ICA
		$("#valor_ica_o").text(parseFloat($("#total_actividad2_o").text()) * (9.66/1000));
		$("#valor_ica").text(formatNumber.new(Math.round(parseFloat($("#total_actividad2_o").text()) * (9.66/1000))));

	});
	
	$("#ga_p").on('keyup',function(){
		var por = $("#ga_p").val();
		var vl = $("#vl_o").text();
		$("#t_ga").text(formatNumber.new(Math.round(por*vl)));
		$("#t_ga_o").text(Math.round(por*vl));
		
		//Total Actividad
		$("#total_actividad").text(formatNumber.new(parseFloat($("#tce_o").text()) + parseFloat($("#t_imp_o").text()) + parseFloat($("#t_ga_o").text()) + parseFloat($("#t_uaai_o").text())));
		$("#total_actividad_o").text( parseFloat($("#tce_o").text()) + parseFloat($("#t_imp_o").text()) + parseFloat($("#t_ga_o").text()) + parseFloat($("#t_uaai_o").text()));
		
		//Total Actividad 2
		$("#total_actividad2").text(formatNumber.new(Math.round(parseFloat($("#tce_o").text()) + parseFloat($("#t_imp_o").text()) + parseFloat($("#t_ga_o").text()) + parseFloat($("#t_uaai_o").text()))));
		$("#total_actividad2_o").text( parseFloat($("#tce_o").text()) + parseFloat($("#t_imp_o").text()) + parseFloat($("#t_ga_o").text()) + parseFloat($("#t_uaai_o").text()));
		
		
		//Utilidad Comercial
		$("#utilidad_comercial").text(formatNumber.new(parseFloat($("#tocpd").text()) + parseFloat($("#2vnc").text()) + parseFloat($("#2t_uaai_o").text())));
		
		//Volumen
		$("#vol_ppto").text(Math.round( (parseFloat($("#utilidad_comercial_o").text())/parseFloat($("#total_actividad_o").text()))*100));
		
		//Utilidad Marginal
		$("#um_ppto").text(Math.round( (parseFloat($("#tocpd_o").text())/parseFloat($("#vl_o").text()))*100));
		
		//Valor de la Retención en la Fuente.
		var refuente = (parseFloat($("#val_retefuente").text())/100);
		$("#valor_retefuente_o").text(refuente * parseFloat($("#total_actividad2_o").text()));
		$("#valor_retefuente").text(formatNumber.new(Math.round(refuente * parseFloat($("#total_actividad2_o").text()))));
		
		//Valor del ICA
		$("#valor_ica_o").text(parseFloat($("#total_actividad2_o").text()) * (9.66/1000));
		$("#valor_ica").text(formatNumber.new(Math.round(parseFloat($("#total_actividad2_o").text()) * (9.66/1000))));
	});
	
	//Total Actividad
	$("#total_actividad").text(formatNumber.new(Math.round(parseFloat($("#tce_o").text()) + parseFloat($("#t_imp_o").text()) + parseFloat($("#t_ga_o").text()) + parseFloat($("#t_uaai_o").text()))));
	$("#total_actividad_o").text( parseFloat($("#tce_o").text()) + parseFloat($("#t_imp_o").text()) + parseFloat($("#t_ga_o").text()) + parseFloat($("#t_uaai_o").text()));
	
	//Total Actividad 2
	$("#total_actividad2").text(formatNumber.new(Math.round(parseFloat($("#tce_o").text()) + parseFloat($("#t_imp_o").text()) + parseFloat($("#t_ga_o").text()) + parseFloat($("#t_uaai_o").text()))));
	$("#total_actividad2_o").text( parseFloat($("#tce_o").text()) + parseFloat($("#t_imp_o").text()) + parseFloat($("#t_ga_o").text()) + parseFloat($("#t_uaai_o").text()));
	
	//Utilidad Comercial
	$("#utilidad_comercial").text(formatNumber.new(Math.round((parseFloat($("#tocpd_o").text()) + parseFloat($("#2vnc").text()) + parseFloat($("#2t_uaai_o").text())))));
	$("#utilidad_comercial_o").text((Math.round((parseFloat($("#tocpd_o").text()) + parseFloat($("#2vnc").text()) + parseFloat($("#2t_uaai_o").text())))));
	
	//Valor de la Retención en la Fuente.
	var refuente = (parseFloat($("#val_retefuente").text())/100);
	$("#valor_retefuente_o").text(refuente * parseFloat($("#total_actividad2_o").text()));
	$("#valor_retefuente").text(formatNumber.new(Math.round(refuente * parseFloat($("#total_actividad2_o").text()))));
	
	//Valor del ICA
	$("#valor_ica_o").text(parseFloat($("#total_actividad2_o").text()) * (9.66/1000));
	$("#valor_ica").text(formatNumber.new(Math.round(parseFloat($("#total_actividad2_o").text()) * (9.66/1000))));
	
	//Valor del CREE
	$("#valor_ica_o").text(parseFloat($("#total_actividad2_o").text()) * (9.66/1000));
	$("#valor_ica").text(formatNumber.new(Math.round(parseFloat($("#total_actividad2_o").text()) * (9.66/1000))));
	
	
	
	//Volumen
	$("#vol_ppto").text(Math.round( (parseFloat($("#utilidad_comercial_o").text())/parseFloat($("#total_actividad_o").text()))*100));
	
	//Utilidad Marginal
	$("#um_ppto").text(Math.round( (parseFloat($("#tocpd_o").text())/parseFloat($("#vl_o").text()))*100));
	
	
	//Formulario para Agregar celula.
	$("#add_celula").dialog({
      autoOpen: false,
      height: "auto",
      width: "auto",
      modal: true,
	  resizable: false
    });
	
	//Agregar una nueva celda.
	$("#nueva_celda").on('click',function(){
		$("#celula").val("");
		$("#add_celula").dialog('open');
	});
	
	//Evento para Agregar Celula.
	$("#celula_add").on('click',function(){
		var cel = $("#celula").val();
		var ppto = $("#codigo_ppto").text();
		$.ajax({
			url: 'busqueda_produccion.php',
			data:{turno:5,celula:cel,ppto:ppto},
			type: 'POST',
			success:function(data){
				document.location.reload();
			}
		});
	});
	
	//Formulario para Agregar Item
	$("#add_item").dialog({
      autoOpen: false,
      height: "auto",
      width: "auto",
      modal: true,
	  resizable: false
    });
	//Formulario para Modificar Item
	$("#modificar_item").dialog({
      autoOpen: false,
      height: "auto",
      width: "auto",
      modal: true,
	  resizable: false
    });
	
	//Abrir Formulario Nuevo Item
	$("#nuevo_item").on('click',function(){
		$("#add_item input").val("");
		$("#add_item select").val("");
		$("#add_item textarea").val("");
		$("#add_item").dialog('open');
	});
	$("#cancelar_concepto").on('click',function(){
		$("#add_item input").val("");
		$("#add_item select").val("");
		$("#add_item textarea").val("");
		$("#add_item").dialog('close');
	});
	
	$("#listado_proveedores").on('change',function(){
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:26,prov:$("#listado_proveedores").val(),ppto:$("#codigo_ppto").text()},
			type:'post',
			success:function(data){
				$("#contenedor_items_proveedor").html(data);
			}
		});
	});
	
	$("#bttn_generar_op").on('click',function(){
		var items = new Array();
		$('input[name="productos_proveedores[]"]:checked').each(function() {
			items.push($(this).val());
		});
		data = new FormData();
		data.append('items',items);
		data.append('turno',28);
		data.append('prov',$("#listado_proveedores").val());
		data.append('fecha_entrega_op',$("#fecha_entrega_op").val());
		data.append('fecha_radicacion_op',$("#fecha_radicacion_op").val());
		data.append('vigencia_inicial_op',$("#vigencia_inicial_op").val());
		data.append('vigencia_final_op',$("#vigencia_final_op").val());
		data.append('nota_op',$("#nota_op").val());
		data.append('fpago',$("#fpago").val());
		data.append('ppto',$("#codigo_ppto").text());
		$.ajax({
			url:'busqueda_produccion.php',
			data:data,
			contentType:false,
			processData:false, 
			type:'post',
			success:function(data){
				alert(data);
			}
		});		
	});
	
	$("#agregar_concepto").on('click',function(){
		var cel = $("#celu").val();
		var ite = $("#item").val();
		var des = $("#descripcion").val();
		var pro = $("#proveedor").val();
		var cant = $("#cantidad").val();
		var d = $("#dias").val();
		var por_ant = $("#por_anticipo").val();
		var fecha = $("#fecha_anticipo").val();
		var vcoti = $("#vcotizacion").val();
		var nego = $("#nego").val();
		var vventa = $("#vventa").val();
		var cventa = $("#cventa").val();
		var usu = $("#codigo_usuario").text();
		id = "";	
		$.ajax({
			url: 'busqueda_produccion.php',
			data:{celula:cel,
			cod:id,
			item:ite,
			descripcion:des,
			proveedor:pro,
			cantidad:cant,
			dias:d,
			por_anticipo:por_ant,
			fecha_anticipo:fecha,
			vcotizacion:vcoti,
			negociacion:nego,
			v_venta:vventa,
			c_venta:cventa,turno:6,usu:usu},
			type: 'POST',
			success:function(data){
				document.location.reload();
			}
		});
	});
	
	$(".ui-dialog-titlebar").hide();
});
var id = "";
function modificar_celda_celula(){
		var cel = $("#celu2").val();
		var ite = $("#item2").val();
		var des = $("#descripcion2").val();
		var pro = $("#proveedor2").val();
		var cant = $("#cantidad2").val();
		var d = $("#dias2").val();
		var por_ant = $("#por_anticipo2").val();
		var fecha = $("#fecha_anticipo2").val();
		var vcoti = $("#vcotizacion2").val();
		var nego = $("#nego2").val();
		var vventa = $("#vventa2").val();
		var cventa = $("#cventa2").val();
		//Borrar Campos:
		$("#add_item input").val("");
		$("#add_item select").val("");
		$("#add_item textarea").val("");
		$.ajax({
			url: 'busqueda_produccion.php',
			data:{celula:cel,
			cod:id,
			item:ite,
			descripcion:des,
			proveedor:pro,
			cantidad:cant,
			dias:d,
			por_anticipo:por_ant,
			fecha_anticipo:fecha,
			vcotizacion:vcoti,
			negociacion:nego,
			v_venta:vventa,
			c_venta:cventa,turno:7},
			type: 'POST',
			success:function(data){
				document.location.reload();
			}
		});
	}
function editar(x){
		//Borrar Campos:
		$("#celu2").val("");
		$("#item2").val("");
		$("#dias2").val("");
		$("#descripcion2").val("");
		$("#proveedor2").val("");
		$("#cantidad2").val("");
		$("#por_anticipo2").val("");
		$("#fecha_anticipo2").val("");
		$("#vcotizacion2").val("");
		$("#nego2").val("");
		$("#vventa2").val("");
		$("#cventa2").val("");
		
		$("#celu").val($("#c"+x+" .celu").text());
		$("#item2").val($("#c"+x+" .ocultos .item").text());
		$("#dias2").val($("#c"+x+" .ocultos .dias").text());
		$("#descripcion2").val($("#c"+x+" .ocultos .descripcion").text());
		$("#proveedor2").val($("#c"+x+" .ocultos .proveedor").text());
		$("#cantidad2").val($("#c"+x+" .ocultos .cantidad").text());
		$("#por_anticipo2").val($("#c"+x+" .ocultos .por_anticipo").text());
		$("#fecha_anticipo2").val($("#c"+x+" .ocultos .fecha_anticipo").text());
		$("#vcotizacion2").val($("#c"+x+" .ocultos .vcotizacion").text());
		$("#nego2").val($("#c"+x+" .ocultos .val_negociacion").text());
		$("#vventa2").val($("#c"+x+" .ocultos .valor_venta").text());
		$("#cventa2").val($("#c"+x+" .ocultos .por_comision_venta").text());
		id = $("#c"+x+" .ocultos .id").text();
		$('#modificar_item').dialog('open');
	}
function mostrar_ocultar_resumen_ppto(x){
	$("#contenedor_resumen_ppto_produccion").toggle();
}