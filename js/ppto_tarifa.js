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

function calcular_valor_interno(xx){
	var valor_interno = parseFloat($("#valor_unidad_o"+xx).text());
	return valor_interno;
}

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
				$("#lista"+xid).html("");
				
				//Invocacion de Operaciones.
			}
		}
	});
}


//Funcion para formatear los números.
function formato_numeros(valor){
	return formatNumber.new(Math.round(valor));
}

function hacer_calculos(x){
	//Llamo a calcular_valor_interno(xx) para obtener el valor del item correspondiente.
	var valor_interno = calcular_valor_interno(x);
	
	//Obtengo el valor de la cantidad
	var cantidad = parseFloat($("#q"+x).text());
	
	//Obtengo el valor de los días.
	var dias = parseFloat($("#d"+x).text());
	
	//Calculo el valor por días y cantidad correspondiente, y lo paso a los campos correspondientes.
	var valor_interno_x_item = valor_interno * dias * cantidad;
	$("#valor_total"+x).text(formato_numeros(valor_interno_x_item));
	$("#valor_total_o"+x).text(valor_interno_x_item);
	
	//Obtengo el valor que se le cobra al cliente
	var valor_cliente = parseFloat($("#val_unidad_c"+x).text());
	
	//Ahora calculo el valor que se le cobra al cliente por los días y la cantidad que se ocupa.
	var costo_x_item_cliente = valor_cliente * dias * cantidad;
	
	//Paso el valor al campo correspondiente.
	$("#v_total_c"+x).text(formato_numeros(costo_x_item_cliente));
	$("#v_total_c_o"+x).text(costo_x_item_cliente);
	
	//Calculo la ganancia (Valor_Cliente - Valor_mio)
	var ganancia = costo_x_item_cliente - valor_interno_x_item;
	
	//Paso los valores correspondientes al campo de la Ganancia
	$("#ganancia"+x).text(formato_numeros(ganancia));
	$("#ganancia_o"+x).text(ganancia);
	
	//Calculo el porcentaje de la ganancia(Mi Ganacia / Valor_mio)
	var porcentaje_ganancia = (ganancia / valor_interno_x_item)*100;
	
	//Paso los valores al campo correspondiente del % de la ganancia
	$("#por_ganancia"+x).text(formato_numeros(porcentaje_ganancia));
	$("#por_ganancia_o"+x).text(porcentaje_ganancia);
	
	//Obtengo el valor correspondiente al volumen del item y lo divido en 100
	var porcentaje_volumen = parseFloat($("#por_volumen"+x).text());
	var valor_volumen_x_item = 0;
	if(porcentaje_volumen == 0){
		porcentaje_volumen = 0;
		//Calculo el valor del Volumen.
		valor_volumen_x_item = 0;
	}else{
		porcentaje_volumen = porcentaje_volumen/100;
		//Calculo el valor del Volumen.
		valor_volumen_x_item = valor_interno_x_item * porcentaje_volumen;
	}
	
	
	//Paso los valores correspondiente a la ganancia x volumen.
	$("#ganancia_vol"+x).text(formato_numeros(valor_volumen_x_item));
	$("#ganancia_vol_o"+x).text(valor_volumen_x_item);
	
	//Calculo la ganancia total por cada item, Ganancia  + ganancia_volumen.
	var ganancia_total_x_item = valor_volumen_x_item + ganancia;
	
	//Paso los valores correspondientes de la ganancia total por item
	$("#total_ganacia"+x).text(formato_numeros(ganancia_total_x_item));
	$("#total_ganacia_o"+x).text(ganancia_total_x_item);
}

function calcular_valores_finales(){
	//Variable para acumular los costos totales internos
	var sum_costos_totales_internos = 0;
	
	//Busco los valores de los datos que tengan como clase valores2.
	$(".valores2").each(function(index){
		sum_costos_totales_internos += parseFloat($("#valor_total_o"+index).text());
	});
	
	//Paso los valores al campo Correspondiente.
	$("#valor_final_mio").text(formato_numeros(sum_costos_totales_internos));
	$("#valor_final_mio_o").text(sum_costos_totales_internos);
	
	//Variable para acumular los costos del cliente.
	var sum_costos_totales_cliente = 0;
	
	//Busco los valores de los datos que tengan como clase val_total.
	$(".val_total").each(function(index){
		sum_costos_totales_cliente += parseFloat($("#v_total_c_o"+index).text());
	});
	
	//Paso los valores al campo Correspondiente.
	$("#total_cliente").text(formato_numeros(sum_costos_totales_cliente));
	$("#total_cliente_o").text(sum_costos_totales_cliente);
	
	//Variable para acumular la ganancia
	var sum_ganancia_total = 0;
	
	//Busco los valores de los datos que tengan como clase ganancia_class.
	$(".ganancia_class").each(function(index){
		sum_ganancia_total += parseFloat($("#ganancia_o"+index).text());
	});
	
	//Paso los valores al campo Correspondiente.
	$("#total_ganancia").text(formato_numeros(sum_ganancia_total));
	$("#total_ganancia_o").text(sum_ganancia_total);
	
	//Variable para calcular el porcentaje total de mi ganancia.
	var porcentaje_ganancia_general = 0;
	porcentaje_ganancia_general = (sum_ganancia_total / sum_costos_totales_internos)*100;
	
	//Paso los valores al campo Correspondiente.
	$("#total_por_ganancia").text(formato_numeros(porcentaje_ganancia_general));
	$("#total_por_ganancia_o").text(porcentaje_ganancia_general);
	
	//Variable para acumular la ganancia por volumen
	var sum_ganancia_total_x_volumen = 0;
	
	//Busco los valores de los datos que tengan como clase ganancia_volumen.
	$(".ganancia_volumen").each(function(index){
		sum_ganancia_total_x_volumen += parseFloat($("#ganancia_vol_o"+index).text());
	});
	
	//Paso los valores al campo Correspondiente.
	$("#total_volumen").text(formato_numeros(sum_ganancia_total_x_volumen));
	$("#total_volumen_o").text(sum_ganancia_total_x_volumen);
	
	//Calculo el valor correspondiente al porcentaje del volumen
	var porcentaje_volumen_total = 0;
	porcentaje_volumen_total = (sum_ganancia_total_x_volumen / sum_costos_totales_internos)*100;
	
	//Paso los valores al campo Correspondiente.
	$("#total_por_volumen").text(formato_numeros(porcentaje_volumen_total));
	$("#total_por_volumen_o").text(porcentaje_volumen_total);
	
	//Variable acumuladora de los valores de ganancia
	var suma_ganancia = 0;
	
	$(".suma_ganancias").each(function(index){
		suma_ganancia += parseFloat($("#total_ganacia_o"+index).text());
	});
	
	//Paso los valores al campo Correspondiente.
	$("#total_total_ganancia").text(formato_numeros(suma_ganancia));
	$("#total_total_ganancia_o").text(suma_ganancia);
	
	//Valores  Finales.
	//Total Cliente
	$("#total_cliente_final_cuadro").text(formato_numeros(sum_ganancia_total));
	$("#total_cliente_final_cuadro_o").text(sum_ganancia_total);
	
	//Total Volumen
	$("#total_vol_cliente_final_cuadro").text(formato_numeros(sum_ganancia_total_x_volumen));
	$("#total_vol_cliente_final_cuadro_o").text(sum_ganancia_total_x_volumen);
	
	//Porcentaje de Comision
	var porcentaje_comision = parseFloat($("#ingres_com_agencia").text());
	
	$("#total_general_1").text(formato_numeros(porcentaje_comision + sum_ganancia_total + sum_ganancia_total_x_volumen));
	$("#total_general_1_o").text(porcentaje_comision + sum_ganancia_total + sum_ganancia_total_x_volumen);
	
	//Valores Final Final
	$("#subtotal_1").text(formato_numeros(sum_costos_totales_cliente));
	$("#subtotal_1_o").text(sum_costos_totales_cliente);
	
	//Valores Final Final
	$("#total_general_2").text(formato_numeros(sum_costos_totales_cliente*0.16));
	$("#total_general_2_o").text(sum_costos_totales_cliente*0.16);
	
	//Valores Final Final
	$("#to_general").text(formato_numeros((sum_costos_totales_cliente*0.16)+sum_costos_totales_cliente));
	$("#to_general_o").text((sum_costos_totales_cliente*0.16)+sum_costos_totales_cliente);
	
}

function cantidad(x,e){
	if(e.keyCode == 13){
		//Modifico el campo de input por un span con el mismo valor que había ingreso en el Input.
		var cantidad = parseFloat($("#q"+x).val());
		$("#q"+x).remove();
		$("#cantidad_item"+x).append("<span id = 'q"+x+"' class = 'cantidad' ondblclick = 'cambiar_cantidad("+x+")'>"+cantidad+"</span>");
		$.ajax({
			url:'gestion_tarifario.php',
			data:{turno:14,q:cantidad,d:parseFloat($("#d"+x).text()),id:$("#itemm_o"+x).text()},
			type:'post',
			success:function(){
				hacer_calculos(x);
				calcular_valores_finales();
			}
		});
	}
}

function dias(x,e){
	if(e.keyCode == 13){
		//Cambio el campo
		var dia = parseFloat($("#d"+x).val());
		$("#d"+x).remove();
		$("#dias_item"+x).append("<span id = 'd"+x+"' class = 'dias' ondblclick = 'cambiar_dias("+x+")'>"+dia+"</span>");
		$.ajax({
			url:'gestion_tarifario.php',
			data:{turno:14,q:parseFloat($("#q"+x).text()),d:dia,id:$("#itemm_o"+x).text()},
			type:'post',
			success:function(){
				hacer_calculos(x);
				calcular_valores_finales();
			}
		});
	}
}

function calcular_cliente(x,e){
	if(e.keyCode == 13){
		//Cambio el campo
		var val_cliente = parseFloat($("#val_unidad_c"+x).val());
		$("#val_unidad_c"+x).remove();
		$("#val_cliente"+x).append("<span id = 'val_unidad_c"+x+"' class = 'val_unidad_c' ondblclick = 'cambiar_cliente("+x+")'>"+val_cliente+"</span>");
		$.ajax({
			url:'gestion_tarifario.php',
			data:{turno:16,id:$("#itemm_o"+x).text(),valor:val_cliente},
			type:'post',
			success:function(){
				hacer_calculos(x);
				calcular_valores_finales();
			}
		});		
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

$(document).ready(function(){
	$(function() {
		$.ajax({
			url:'gestion_tarifario.php',
			data:{turno:11},
			type:'post',
			success:function(data){
				$("#contenedor_ppto").html("");
				$("#contenedor_ppto").html(data);
				calcular_valores_finales();
			}
		});
	});
});