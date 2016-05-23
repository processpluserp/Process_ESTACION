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
	$(function() {
		$.ajax({
			url:'gestion_tarifario.php',
			data:{turno:11},
			type:'post',
			success:function(data){
				$("#contenedor_ppto").html("");
				$("#contenedor_ppto").html(data);
				$("#total_por_ganancia").text("");
				$("#total_por_ganancia_o").text("");
				$("#total_por_ganancia").text(formatNumber.new(Math.round((parseFloat($("#total_ganancia_o").text())/parseFloat($("#valor_final_mio_o").text()))*100)));
				$("#total_por_ganancia_o").text(((parseFloat($("#total_ganancia_o").text())/parseFloat($("#valor_final_mio_o").text()))*100));
				
				$("#total_volumen").text("");
				$("#total_volumen_o").text("");
				var vol = 0;
				$(".ganancia_volumen .hidde").each(function(index){
					vol += parseFloat($("#ganancia_vol_o"+index).text());
				});
				$("#total_volumen").text(formatNumber.new(vol));
				$("#total_volumen_o").text(vol);
				
				
				$("#total_por_volumen").text("");
				$("#total_por_volumen_o").text("");
				var vol_g = vol;
				
				$("#total_por_volumen").text(formatNumber.new(Math.round((vol_g / parseFloat($("#valor_final_mio_o").text()))*100)));
				$("#total_por_volumen_o").text((vol_g / parseFloat($("#valor_final_mio_o").text()))*100);
				
				$("#total_cliente_final_cuadro").text("");
				$("#total_cliente_final_cuadro_o").text("");
				$("#total_cliente_final_cuadro").text(formatNumber.new(Math.round(parseFloat($("#total_ganancia_o").text()))));
				$("#total_cliente_final_cuadro_o").text(parseFloat($("#total_ganancia_o").text()));
				
				$("#total_vol_cliente_final_cuadro").text("");
				$("#total_vol_cliente_final_cuadro_o").text("");
				$("#total_vol_cliente_final_cuadro").text(formatNumber.new(Math.round(parseFloat($("#total_volumen_o").text()))));
				$("#total_vol_cliente_final_cuadro_o").text(parseFloat($("#total_volumen_o").text()));
				
				$("#total_general_1").text("");
				$("#total_general_1_o").text("");
				$("#total_general_1").text(formatNumber.new(Math.round(parseFloat($("#total_vol_cliente_final_cuadro_o").text()) + parseFloat($("#total_cliente_final_cuadro_o").text()) + parseFloat($("#ingres_com_agencia").text()))));
				$("#total_general_1_o").text(parseFloat($("#total_vol_cliente_final_cuadro_o").text()) + parseFloat($("#total_cliente_final_cuadro_o").text()) + 
										parseFloat($("#ingres_com_agencia").text()));
			}
		});
	});
	
	$("#generar_orden").on('click',function(){
		var items = new Array();
		$('input[name="seleccionados[]"]:checked').each(function() {
			items.push($(this).val());
		});
		$.ajax({
			url:'gestion_tarifario.php',
			data:{turno:18,item:items},
			type:'post',
			success:function(){
				
			}
		});
	});
});
var xid = 0;
function consultar_item(i){
	var text = $("#item"+i).val();
	xid = i;
	$.ajax({
		url:'gestion_tarifario.php',
		data:{turno:12,item:text},
		type:'post',
		success:function(data){
			$("#lista"+i).html("");
			$("#lista"+i).html(data);
		}
	});
}
function select_item(){
	var id = $('input:radio[name=new_item]:checked').val();
	var text = $('input:radio:checked').next('label:first').html();
	$.ajax({
		url:'gestion_tarifario.php',
		data:{turno:13,id:id},
		type:'post',
		success:function(data){
			var datos = data.split("****");
			if(datos[0] == 0){
				alert("ESTE ITEM YA HA SIDO INGRESADO EN ESTE PPTO, POR FAVOR INGRESE OTRO");
			}else if(datos[0] == 1){
				$("#valor_unidad"+xid).html("");
				$("#valor_unidad"+xid).html(formatNumber.new(datos[1]));
				
				$("#valor_unidad_o"+xid).html("");
				$("#valor_unidad_o"+xid).html(datos[1]);
				
				$("#grupo"+xid).html("");
				$("#grupo"+xid).html(datos[2]);
				
				$("#por_volumen_o"+xid).html("");
				$("#por_volumen"+xid).html(datos[4]);
				
				$("#item"+xid).remove();
				$("#lista"+xid).remove();
				$("#check"+xid).append("<input type = 'checkbox' name = 'seleccionados[]' value = '"+id+"'/>");
				$("#elemento"+xid).append("<span ondblclick = 'cambiar_item("+xid+")' id = 'itemm"+xid+"'>"+text+"</span><span class = 'hidde' id = 'itemm_o"+xid+"'>"+id+"</span>");
				calcular();
				$("#lista"+xid).html("");
				
				$("#total_cliente_final_cuadro").text("");
				$("#total_cliente_final_cuadro_o").text("");
				$("#total_cliente_final_cuadro").text(formatNumber.new(Math.round(parseFloat($("#total_ganancia_o").text()))));
				$("#total_cliente_final_cuadro_o").text(parseFloat($("#total_ganancia_o").text()));
				
				$("#total_vol_cliente_final_cuadro").text("");
				$("#total_vol_cliente_final_cuadro_o").text("");
				$("#total_vol_cliente_final_cuadro").text(formatNumber.new(Math.round(parseFloat($("#total_volumen_o").text()))));
				$("#total_vol_cliente_final_cuadro_o").text(parseFloat($("#total_volumen_o").text()));
				
				$("#total_general_1").text("");
				$("#total_general_1_o").text("");
				$("#total_general_1").text(formatNumber.new(Math.round(parseFloat($("#total_vol_cliente_final_cuadro_o").text()) + parseFloat($("#total_cliente_final_cuadro_o").text()) + parseFloat($("#ingres_com_agencia").text()))));
				$("#total_general_1_o").text(parseFloat($("#total_vol_cliente_final_cuadro_o").text()) + parseFloat($("#total_cliente_final_cuadro_o").text()) + 
										parseFloat($("#ingres_com_agencia").text()));
			}
		}
	});
}

function cantidad(qi,e){
	if(e.keyCode == 13){
		//Cambio el campo
		var text = parseFloat($("#q"+qi).val());
		$("#q"+qi).remove();
		$("#cantidad_item"+qi).append("<span id = 'q"+qi+"' class = 'cantidad' ondblclick = 'cambiar_cantidad("+qi+")'>"+text+"</span>");
		
		var valor_total = parseFloat($("#q"+qi).text()) * parseFloat($("#d"+qi).text()) * parseFloat($("#valor_unidad_o"+qi).text());
		$.ajax({
			url:'gestion_tarifario.php',
			data:{turno:14,q:parseFloat($("#q"+qi).text()),d:parseFloat($("#d"+qi).text()),id:$("#itemm_o"+qi).text()},
			type:'post',
			success:function(){
			}
		});
		$("#valor_total"+qi).text(formatNumber.new(valor_total));
		$("#valor_total_o"+qi).text(valor_total);
		
		var val_cliente = parseFloat($("#q"+qi).text()) * parseFloat($("#d"+qi).text()) * parseFloat($("#val_unidad_c"+qi).text());
		$("#v_total_c"+qi).text(formatNumber.new(val_cliente));
		$("#v_total_c_o"+qi).text((val_cliente));
		
		
		
		//valor final costo interno
		var valor_final = 0;
		$(".valores2").each(function(index){
			if($("#valor_total_o"+index).text() == ""){
				valor_final += 0;
			}else{
				valor_final += parseFloat($("#valor_total_o"+index).text());
			}
		});
		$("#valor_final_mio").text("");
		$("#valor_final_mio").text(formatNumber.new(valor_final));
		$("#valor_final_mio_o").text("");
		$("#valor_final_mio_o").text(valor_final);
		
		
		//valor final ganancia
		var ganacia_total = 0;
		$(".ganancia_class .hidde").each(function(index){
			if($("#ganancia_o"+index).text() == ""){
				ganacia_total += 0;
			}else{
				ganacia_total += parseFloat($("#ganancia_o"+index).text());
			}
		});
		$("#total_ganancia").text("");
		$("#total_ganancia").text(formatNumber.new(ganacia_total));
		$("#total_ganancia_o").text("");
		$("#total_ganancia_o").text(ganacia_total);
		
		//Porcentaje final de ganancia
		$("#total_por_ganancia").text("");
		$("#total_por_ganancia_o").text("");
		$("#total_por_ganancia").text(formatNumber.new(Math.round((parseFloat($("#total_ganancia_o").text())/parseFloat($("#valor_final_mio_o").text()))*100)));
		$("#total_por_ganancia_o").text(((parseFloat($("#total_ganancia_o").text())/parseFloat($("#valor_final_mio_o").text()))*100));
		
		//Volumen
		
		var vol = parseFloat($("#valor_total_o"+qi).text()) / (parseFloat($("#por_volumen"+qi).text()));
		$("#ganancia_vol"+qi).text(formatNumber.new(vol));
		$("#ganancia_vol_o"+qi).text((vol));
		$("#total_por_volumen").text("");
		$("#total_por_volumen_o").text("");
		
		var vol_g = vol;
		$("#total_por_volumen").text(formatNumber.new(Math.round((vol_g / parseFloat($("#valor_final_mio_o").text()))*100)));
		$("#total_por_volumen_o").text((vol_g / parseFloat($("#valor_final_mio_o").text()))*100);
		
		$("#total_volumen").text("");
		$("#total_volumen_o").text("");
		var vol = 0;
		$(".ganancia_volumen .hidde").each(function(index){
			vol += parseFloat($("#ganancia_vol_o"+index).text());
		});
		$("#total_volumen").text(formatNumber.new(vol));
		$("#total_volumen_o").text(vol);
		
		$("#total_cliente_final_cuadro").text("");
		$("#total_cliente_final_cuadro_o").text("");
		$("#total_cliente_final_cuadro").text(formatNumber.new(Math.round(parseFloat($("#total_ganancia_o").text()))));
		$("#total_cliente_final_cuadro_o").text(parseFloat($("#total_ganancia_o").text()));
		
		$("#total_vol_cliente_final_cuadro").text("");
		$("#total_vol_cliente_final_cuadro_o").text("");
		$("#total_vol_cliente_final_cuadro").text(formatNumber.new(Math.round(parseFloat($("#total_volumen_o").text()))));
		$("#total_vol_cliente_final_cuadro_o").text(parseFloat($("#total_volumen_o").text()));
			
		$("#total_general_1").text("");
		$("#total_general_1_o").text("");
		$("#total_general_1").text(formatNumber.new(Math.round(parseFloat($("#total_vol_cliente_final_cuadro_o").text()) + parseFloat($("#total_cliente_final_cuadro_o").text()) + parseFloat($("#ingres_com_agencia").text()))));
		$("#total_general_1_o").text(parseFloat($("#total_vol_cliente_final_cuadro_o").text()) + parseFloat($("#total_cliente_final_cuadro_o").text()) + 
		parseFloat($("#ingres_com_agencia").text()));
		
		//Ganancia
		var valor_total = parseFloat($("#valor_total_o"+qi).text());
		$("#ganancia"+qi).text("");
		$("#ganancia_o"+qi).text("");
		$("#ganancia"+qi).text(formatNumber.new(val_cliente-valor_total));
		$("#ganancia_o"+qi).text((val_cliente-valor_total));
		
		var ganancia = parseFloat($("#ganancia_o"+qi).text());
		$("#por_ganancia"+qi).text(Math.round((ganancia/valor_total)*100));
		$("#por_ganancia_o"+qi).text(Math.round((ganancia/valor_total)*100));

	}
	
}
function dias(di,e){
	if(e.keyCode == 13){
		//Cambio el campo
		var text = parseFloat($("#d"+di).val());
		$("#d"+di).remove();
		$("#dias_item"+di).append("<span id = 'd"+di+"' class = 'dias' ondblclick = 'cambiar_dias("+di+")'>"+text+"</span>");
		var valor_total = parseFloat($("#q"+di).text()) * parseFloat($("#d"+di).text()) * parseFloat($("#valor_unidad_o"+di).text());
		$.ajax({
			url:'gestion_tarifario.php',
			data:{turno:14,q:parseFloat($("#q"+di).text()),d:parseFloat($("#d"+di).text()),id:$("#itemm_o"+di).text()},
			type:'post',
			success:function(){
			}
		});
		$("#valor_total"+di).text(formatNumber.new(valor_total));
		$("#valor_total_o"+di).text(valor_total);
		
		var val_cliente = parseFloat($("#q"+di).text()) * parseFloat($("#d"+di).text()) * parseFloat($("#val_unidad_c"+di).text());
		$("#v_total_c"+di).text(formatNumber.new(val_cliente));
		$("#v_total_c_o"+di).text((val_cliente));
		
		
		
		var valor_final = 0;
		$(".valores2").each(function(index){
			if($("#valor_total_o"+index).text() == ""){
				valor_final += 0;
			}else{
				valor_final += parseFloat($("#valor_total_o"+index).text());
			}
		});
		$("#valor_final_mio").text("");
		$("#valor_final_mio").text(formatNumber.new(valor_final));
		$("#valor_final_mio_o").text("");
		$("#valor_final_mio_o").text(valor_final);
		
		var ganacia_total = 0;
		$(".ganancia_class .hidde").each(function(index){
			if($("#ganancia_o"+index).text() == ""){
				ganacia_total += 0;
			}else{
				ganacia_total += parseFloat($("#ganancia_o"+index).text());
			}
		});
		$("#total_ganancia").text("");
		$("#total_ganancia").text(formatNumber.new(ganacia_total));
		$("#total_ganancia_o").text("");
		$("#total_ganancia_o").text(ganacia_total);
		
		$("#total_por_ganancia").text("");
		$("#total_por_ganancia_o").text("");
		$("#total_por_ganancia").text(formatNumber.new(Math.round((parseFloat($("#total_ganancia_o").text())/parseFloat($("#valor_final_mio_o").text()))*100)));
		$("#total_por_ganancia_o").text(((parseFloat($("#total_ganancia_o").text())/parseFloat($("#valor_final_mio_o").text()))*100));
		
		//Volumen
		var vol = parseFloat($("#valor_total_o"+di).text()) * (parseFloat($("#por_volumen"+di).text())/100);
		$("#ganancia_vol"+di).text(formatNumber.new(vol));
		$("#ganancia_vol_o"+di).text((vol));
		$("#total_por_volumen").text("");
		$("#total_por_volumen_o").text("");
		var vol_g = vol;
		$("#total_por_volumen").text(formatNumber.new(Math.round((vol_g / parseFloat($("#valor_final_mio_o").text()))*100)));
		$("#total_por_volumen_o").text((vol_g / parseFloat($("#valor_final_mio_o").text()))*100);
		var vol = 0;
		$(".ganancia_volumen .hidde").each(function(index){
			vol += parseFloat($("#ganancia_vol_o"+index).text());
		});
		$("#total_volumen").text(formatNumber.new(vol));
		$("#total_volumen_o").text(vol);
		
		$("#total_cliente_final_cuadro").text("");
		$("#total_cliente_final_cuadro_o").text("");
		$("#total_cliente_final_cuadro").text(formatNumber.new(Math.round(parseFloat($("#total_ganancia_o").text()))));
		$("#total_cliente_final_cuadro_o").text(parseFloat($("#total_ganancia_o").text()));
		
		$("#total_vol_cliente_final_cuadro").text("");
		$("#total_vol_cliente_final_cuadro_o").text("");
		$("#total_vol_cliente_final_cuadro").text(formatNumber.new(Math.round(parseFloat($("#total_volumen_o").text()))));
		$("#total_vol_cliente_final_cuadro_o").text(parseFloat($("#total_volumen_o").text()));
			
		$("#total_general_1").text("");
		$("#total_general_1_o").text("");
		$("#total_general_1").text(formatNumber.new(Math.round(parseFloat($("#total_vol_cliente_final_cuadro_o").text()) + parseFloat($("#total_cliente_final_cuadro_o").text()) + parseFloat($("#ingres_com_agencia").text()))));
		$("#total_general_1_o").text(parseFloat($("#total_vol_cliente_final_cuadro_o").text()) + parseFloat($("#total_cliente_final_cuadro_o").text()) + 
		parseFloat($("#ingres_com_agencia").text()));
		//Ganancia
		var valor_total =parseFloat($("#valor_total_o"+di).text());
		alert(valor_total);
		$("#ganancia"+di).text("");
		$("#ganancia_o"+di).text("");
		$("#ganancia"+di).text(formatNumber.new(val_cliente-valor_total));
		$("#ganancia_o"+di).text((val_cliente-valor_total));
		
		var ganancia = parseFloat($("#ganancia_o"+di).text());
		$("#por_ganancia"+di).text(Math.round((ganancia/valor_total)*100));
		$("#por_ganancia_o"+di).text(Math.round((ganancia/valor_total)*100));
	}
	
}
function calcular(){
	var valor_total = parseFloat($("#q"+xid).text()) * parseFloat($("#d"+xid).text()) * parseFloat($("#valor_unidad_o"+xid).text());
	$("#valor_total"+xid).text(formatNumber.new(valor_total));
	$("#valor_total_o"+xid).text(valor_total);
}

function calcular_cliente(ci,e){
	if(e.keyCode == 13){
		//Cambio el campo
		var textx = parseFloat($("#val_unidad_c"+ci).val());
		$("#val_unidad_c"+ci).remove();
		$("#val_cliente"+ci).append("<span id = 'val_unidad_c"+ci+"' class = 'val_unidad_c' ondblclick = 'cambiar_cliente("+ci+")'>"+textx+"</span>");
		
		var val_cliente = parseFloat($("#q"+ci).text()) * parseFloat($("#d"+ci).text()) * parseFloat($("#val_unidad_c"+ci).text());
		$("#v_total_c"+ci).text(formatNumber.new(val_cliente));
		$("#v_total_c_o"+ci).text((val_cliente));
		
		//Ganancia
		var valor_total = parseFloat($("#valor_total_o"+ci).text());
		$("#ganancia"+ci).text("");
		$("#ganancia_o"+ci).text("");
		$("#ganancia"+ci).text(formatNumber.new(val_cliente-valor_total));
		$("#ganancia_o"+ci).text((val_cliente-valor_total));
		
		var ganancia = parseFloat($("#ganancia_o"+ci).text());
		$("#por_ganancia"+ci).text(Math.round((ganancia/valor_total)*100));
		$("#por_ganancia_o"+ci).text(Math.round((ganancia/valor_total)*100));
		
		var ganancia = parseFloat($("#ganancia_o"+ci).text());
		$("#por_ganancia"+ci).text(Math.round((ganancia/valor_total)*100));
		$("#por_ganancia_o"+ci).text(Math.round((ganancia/valor_total)*100));
		
		//Volumen
		var vol = parseFloat($("#valor_total_o"+ci).text()) * (parseFloat($("#por_volumen"+ci).text())/100);
		$("#ganancia_vol"+ci).text(formatNumber.new(vol));
		$("#ganancia_vol_o"+ci).text((vol));
		$("#total_por_volumen").text("");
		$("#total_por_volumen_o").text("");
		var vol_g = vol;
		$("#total_por_volumen").text(formatNumber.new(Math.round((vol_g / parseFloat($("#valor_final_mio_o").text()))*100)));
		$("#total_por_volumen_o").text((vol_g / parseFloat($("#valor_final_mio_o").text()))*100);
		
		//Total
		var total = vol + (val_cliente-valor_total);
		$("#total_ganacia"+ci).text(formatNumber.new(total));
		$("#total_ganacia_o"+ci).text(total);
		
		
		$.ajax({
			url:'gestion_tarifario.php',
			data:{turno:16,id:$("#itemm_o"+ci).text(),valor:textx},
			type:'post',
			success:function(){
			}
		});
		
		var valor_final = 0;
		$(".val_total .hidde").each(function(index){
			if($("#v_total_c_o"+index).text() == ""){
				valor_final += 0;
			}else{
				valor_final += parseFloat($("#v_total_c_o"+index).text());
				
			}
		});
		$("#total_cliente").text("");
		$("#total_cliente").text(formatNumber.new(valor_final));
		$("#total_cliente_o").text("");
		$("#total_cliente_o").text(valor_final);
		
		var ganacia_total = 0;
		$(".ganancia_class .hidde").each(function(index){
			if($("#ganancia_o"+index).text() == ""){
				ganacia_total += 0;
			}else{
				ganacia_total += parseFloat($("#ganancia_o"+index).text());
			}
		});
		$("#total_ganancia").text("");
		$("#total_ganancia").text(formatNumber.new(ganacia_total));
		$("#total_ganancia_o").text("");
		$("#total_ganancia_o").text(ganacia_total);
		
		$("#total_por_ganancia").text("");
		$("#total_por_ganancia_o").text("");
		$("#total_por_ganancia").text(formatNumber.new(Math.round((parseFloat($("#total_ganancia_o").text())/parseFloat($("#valor_final_mio_o").text()))*100)));
		$("#total_por_ganancia_o").text(((parseFloat($("#total_ganancia_o").text())/parseFloat($("#valor_final_mio_o").text()))*100));
		
		$("#total_cliente_final_cuadro").text("");
		$("#total_cliente_final_cuadro_o").text("");
		$("#total_cliente_final_cuadro").text(formatNumber.new(Math.round(parseFloat($("#total_ganancia_o").text()))));
		$("#total_cliente_final_cuadro_o").text(parseFloat($("#total_ganancia_o").text()));
		
		$("#total_vol_cliente_final_cuadro").text("");
		$("#total_vol_cliente_final_cuadro_o").text("");
		$("#total_vol_cliente_final_cuadro").text(formatNumber.new(Math.round(parseFloat($("#total_volumen_o").text()))));
		$("#total_vol_cliente_final_cuadro_o").text(parseFloat($("#total_volumen_o").text()));
			
		$("#total_general_1").text("");
		$("#total_general_1_o").text("");
		$("#total_general_1").text(formatNumber.new(Math.round(parseFloat($("#total_vol_cliente_final_cuadro_o").text()) + parseFloat($("#total_cliente_final_cuadro_o").text()) + parseFloat($("#ingres_com_agencia").text()))));
		$("#total_general_1_o").text(parseFloat($("#total_vol_cliente_final_cuadro_o").text()) + parseFloat($("#total_cliente_final_cuadro_o").text()) + 
		parseFloat($("#ingres_com_agencia").text()));
	}
}
function cambiar_item(xid2){
	var text = $("#itemm"+xid2).text();
	$("#itemm"+xid2).remove();
	$("#elemento"+xid2).append("<input type = 'text' value = '"+text+"' id = 'item"+xid2+"' class = 'item' onkeyup = 'consultar_item("+xid2+")'/><div id = 'lista"+xid2+"'></div>");
}

function cambiar_cantidad(xid3){
	var text = parseFloat($("#q"+xid3).text());
	$("#q"+xid3).remove();
	$("#cantidad_item"+xid3).append("<input type = 'text' value = '"+text+"' id = 'q"+xid3+"' class = 'cantidad' onkeypress = 'cantidad("+xid3+",event)'/>");
}

function cambiar_dias(xid4){
	var text = parseFloat($("#d"+xid4).text());
	$("#d"+xid4).remove();
	$("#dias_item"+xid4).append("<input type = 'text' value = '"+text+"' id = 'd"+xid4+"' class = 'cantidad' onkeypress = 'dias("+xid4+",event)'/>");
}

function cambiar_cliente(xid5){
	var text = parseFloat($("#val_unidad_c"+xid5).text());
	$("#val_unidad_c"+xid5).remove();
	$("#val_cliente"+xid5).append("<input type = 'text' value = '"+text+"' id = 'val_unidad_c"+xid5+"' class = 'val_unidad_c' onkeypress = 'calcular_cliente("+xid5+",event)'/>");
}

function cambiar_comision(){
	var text = parseFloat($("#ingres_com_agencia").text());
	$("#ingres_com_agencia").remove();
	$("#comision_agencia").append("<input type = 'text' value = '"+text+"' id = 'ingres_com_agencia' class = 'ingres_com_agencia' onkeypress = 'calcular_comision(event)'/>");
}
function calcular_comision(e){
	if(e.keyCode == 13){
		var valor = parseFloat($("#ingres_com_agencia").val());
		var valor2 = parseFloat($("#total_general_1_o").text());
		$("#total_general_1").text("");
		$("#total_general_1_o").text("");
		$("#total_general_1").text(formatNumber.new(Math.round(valor + valor2)));
		$("#total_general_1_o").text(valor + valor2);
		
		//Cambio el campo
		$("#ingres_com_agencia").remove();
		$("#comision_agencia").append("<span id = 'ingres_com_agencia' class = 'ingres_com_agencia' ondblclick = 'cambiar_comision()'>"+valor+"</span>");
		
	}
}
function eliminar_item(rt){
	$.ajax({
		url:'gestion_tarifario.php',
		data:{turno:15,id:$("#itemm_o"+rt).text()},
		type:'post',
		success:function(){
			$("#estructura_ppto #"+rt).hide("slow");
			location.reload();
		}
	});
}

function guardar_descripcion(tr){
	$.ajax({
		url:'gestion_tarifario.php',
		data:{turno:17,text:$("#desc"+tr).val(),id:$("#itemm_o"+tr).text()},
		type:'post',
		success:function(){}
	});
}