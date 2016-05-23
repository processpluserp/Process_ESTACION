$(document).ready(function(){
	//Cambio de EmpresA: Seleccion Cliente
	$("#fecha_entrega_op,#fecha_radicacion_op,#vigencia_inicial_op,#vigencia_final_op").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#empresa").on('change',function(){
		var emp = $("#empresa").val();
		var usu = $("#codigo_usuario").text();
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:1,emp:emp,usu:usu},
			type:'P0ST',
			success:function(data){
				alert(data);
				$("#cliente").html("");
				$("#cliente").html(data);
			}
		});
	});
	var alto = $(window).height();
	var ancho_x = $(window).width();
	var ancho_por = (ancho_x*100)/100;
	var ancho_por2 = (ancho_x*99)/100;
	var x = (alto*100)/100;
	$(".ui-dialog-titlebar").hide();
	
	//Formulario para crear ppto
	$("#formato_nuevo_ppto").dialog({
      autoOpen: false,
      height: "550",
      width: "auto",
      modal: true,
	  resizable: false
    });
	
	
	
	//Abre el formulario de ppto.	
	$("#nuevo_ppto").on('click',function(){
		$("#formato_nuevo_ppto").dialog('open');
	});
	
	$("#v_generar_op,#ventana_anticipos,#ventana_asoc_items").dialog({
      autoOpen: false,
      height: x,
      width: ancho_por,
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 1,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
        $(".ui-draggable").css({
        	top:"2px"
        });
		},
      modal: true,
	  resizable: false
    });
	
	$("#generar_ant").on('click',function(){
		$(".scroll").css({"overflow-y":"hidden"});
		$("#ventana_anticipos").dialog('open');
	});
	$("#cerrar_ventana_ant").on('click',function(){
		$(".scroll").css({"overflow-y":"scroll"});
		$("#ventana_anticipos").dialog('close');
	});
	
	$("#asoc_items_ppto").on('click',function(){
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:57,ppto:$("#codigo_ppto").text()},
			type:'post',
			success:function(data){
				$("#contenedor_asociaciones").html(data);
			}
		});
		$(".scroll").css({"overflow-y":"hidden"});
		$("#ventana_asoc_items").dialog('open');
	});
	$("#cerrar_ventana_asoc").on('click',function(){
		$("#ventana_asoc_items").dialog('close');
		$(".scroll").css({"overflow-y":"scroll"});
	});
	
	$("#generar_op").on('click',function(){
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:25,ppto:$("#codigo_ppto").text()},
			type:'post',
			success:function(data){
				$("#listado_proveedores").html(data);
			}
		});
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:27,ppto:$("#codigo_ppto").text()},
			type:'post',
			success:function(data){
				$("#nota_op").html(data);
			}
		});
		$(".scroll").css({"overflow-y":"hidden"});
		$("#v_generar_op").dialog('open');
	});
	$("#cerrar_ventana_informacion_basica").on('click',function(){
		$(".scroll").css({"overflow-y":"scroll"});
		$("#v_generar_op input,#v_generar_op textarea").val("");
		$("#v_generar_op select").val("0");
		$("#contenedor_items_proveedor").html("");
		$("#v_generar_op").dialog('close');
	});
	
	
});

function abrir_lista_grupos(){
	if($("#nombre_grupo_celula").val() == ""){
		$("#listado").html("");
	}else{
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:10,name:$("#nombre_grupo_celula").val()},
			type:'post',
			success:function(data){
				$("#listado").html("");
				$("#listado").html(data);
			}
		});
	}
}

function abrir_lista_grupos2(id){
	if($("#nombre_grupo_celula").val() == ""){
		$("#listado").html("");
	}else{
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:43,name:$("#nueva_celula_m_ppto"+id).val(),id:id},
			type:'post',
			success:function(data){
				$("#listado").html("");
				$("#listado").html(data);
			}
		});
	}
}

function modificar_grupo_actual_ppto_celula(id){
	var grupo = ($('input:radio[name=grupo_selm]:checked').val());
	$.ajax({
		url:'busqueda_produccion.php',
		data:{turno:44,id:id,grupo:grupo},
		type:'post',
		success:function(data){
			location.reload();
		}
	});
}

function grupo_selected(){
	var grupo = ($('input:radio[name=grupo_sel]:checked').val());
	$.ajax({
		url:'busqueda_produccion.php',
		data:{turno:11,grupo:grupo,ppto:$("#codigo_ppto").text()},
		type:'post',
		success:function(data){
			$("#listado").html("");
			$("#contenedor_informacion_ppto").html("");
			$("#contenedor_informacion_ppto").html(data);
		}
	});
}

function listar_grupos_tarifario(x){
	$("#grupon"+x).html("");
	$("#grupon"+x).append("<table><tr><td><input type = 'text' id = 'nombre_grupo_celula' class = 'entradas_bordes' onkeyup ='abrir_lista_grupos()'/></td><td><img onclick = 'add_grupo_tarifario_ppto("+x+")' src = '../images/iconos/mas_blanco.png' width = '20px' title = 'Adicionar Nuevo Grupo' /></td><td><img onclick = 'cancelar_modificar_celula("+x+")' src = '../images/iconos/eliminar2.png' width = '20px' title = 'Cancelar' /></td></tr></table><div style = 'width:100%;height:150px;overflow:scroll;' id = 'listado'></div>");
}

function listado_items_grupo(x,y,z){
	$("#"+z+"-item"+y).html("");
	$("#"+z+"-item"+y).append("<table><tr><td><input type = 'text' id = 'nombre_item' class = 'entradas_bordes' onkeyup ='abrir_lista_items("+x+","+z+")'/></td><td><img onclick = 'add_item_tarifario_ppto("+x+","+z+")' src = '../images/iconos/ok_verde.png' width = '20px' title = 'Adicionar Item' /></td><td><img onclick = 'cancelar_add_item_ppto("+z+","+y+")' src = '../images/iconos/eliminar2.png' width = '20px' title = 'Cancelar' /></td></tr></table><div style = 'width:100%;height:150px;overflow:scroll;' id = 'listado_items'></div>");
}
function add_item_tarifario_ppto(x,z){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:63,nombre_item_tarifario:$("#nombre_item").val(),iva_item_tarifario:16,tarifa_item_tarifario:0,vol_tarifa_item_ppto:0,listado_subgrupos_grupos_tarifario:0,listado_grupos_item_tarifario:x,adicional_item_tarifario:0},
		type:'post',
		success:function(data){
			$.ajax({
				url:'busqueda_produccion.php',
				data:{turno:42,name:$("#nombre_item").val(),grupo:x,celula:z,ppto:$("#codigo_ppto").text()},
				type:'post',
				success:function(data){
					location.reload();
				}
			});
		}
	});
}

function modificar_grupo_celula_ppto(ppto,grupo,celula){
	var tet = $("#celula_ppto"+celula).text();
	$("#celula_ppto"+celula).html("<table><tr><td><input type = 'text' id = 'nueva_celula_m_ppto"+celula+"' onkeyup = 'abrir_lista_grupos2("+celula+")' value = '"+tet+"'/></td><td><img onclick = 'cancelar_modificar_celula("+celula+")' src = '../images/iconos/cerrar.png' width = '20px' title = 'Cancelar' /></td><td><img onclick = 'copiar_grupo_celula_ppto("+celula+")' src = '../images/iconos/copy.png' width = '20px' title = 'Copiar' /></td></tr></table><div style = 'width:100%;height:150px;overflow:scroll;' id = 'listado'></div>");
}

function cancelar_modificar_celula(celula){
	location.reload();
}

function copiar_grupo_celula_ppto(celula){
	$.ajax({
		url:'busqueda_produccion.php',
		data:{turno:45,celula:celula,ppto:$("#codigo_ppto").text()},
		type:'post',
		success:function(data){
			location.reload();
		}
	});
}

function cancelar_add_item_ppto(z,y){
	$("#"+z+"-item"+y).html("ITEM");
}
function escribir_comision_agencia(x){
	var valor = $("#comision_agencia_pedro").val();
	$("#comision_agencia_pedrox").html("<input type = 'text' id = 'valor_comision_agencia_pedro' onkeypress = 'guardar_comision_agencia_pedro(event,"+x+")' value = '"+valor+"'/>");
}

function guardar_comision_agencia_pedro(e,x){
	if(e.keyCode == 13){
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:29,x:x,val:$("#valor_comision_agencia_pedro").val()},
			type:'post',
			success:function(data){
				location.reload();
			}
		});
	}
}

function add_grupo_tarifario_ppto(x){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:61,grupo:$("#nombre_grupo_celula").val()},
		type:'post',
		success:function(data){
			$.ajax({
				url:'busqueda_produccion.php',
				data:{ppto:$("#codigo_ppto").text(),turno:41,grupo:$("#nombre_grupo_celula").val()},
				type:'post',
				success:function(data){
					location.reload();
				}
			});
		}
	});
}

function abrir_lista_items(x,z){
	if($("#nombre_item").val() == ""){
		$("#listado_items").html("");
	}else{
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:12,name:$("#nombre_item").val(),grupo:x,celula:z},
			type:'post',
			success:function(data){
				$("#listado_items").html("");
				$("#listado_items").html(data);
			}
		});
	}
}
function item_selected(z){
	var grupo = ($('input:radio[name=item_sel]:checked').val());
	$.ajax({
		url:'busqueda_produccion.php',
		data:{turno:13,item:grupo,ppto:$("#codigo_ppto").text(),celula:z},
		type:'post',
		success:function(data){
			//$("#listado_items").html("");
			//$("#contenedor_informacion_ppto").html("");
			//$("#contenedor_informacion_ppto").html(data);
			location.reload();
		}
	});
}

function update_dias_item(x){
	var val = parseFloat($("#dias"+x).text());
	$("#dias"+x).html("");
	$("#dias"+x).append("<input type = 'text' id = 'dias_item' class = 'entradas_bordes' value = '"+val+"' onkeyup ='guardar_dias(event,"+x+")'/>");
}

function guardar_dias(e,x){
	if(e.keyCode == 13){
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:14,dias:$("#dias_item").val(),id:x,ppto:$("#codigo_ppto").text()},
			type:'post',
			success:function(data){
				$("#contenedor_informacion_ppto").html("");
				$("#contenedor_informacion_ppto").html(data);
			}
		});
	}
}

function update_q_item(x){
	var val = parseFloat($("#q"+x).text());
	$("#q"+x).html("");
	$("#q"+x).append("<input type = 'text' id = 'q_item' value = '"+val+"'onkeyup ='guardar_q(event,"+x+")'/>");
}

function guardar_q(e,x){
	if(e.keyCode == 13){
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:15,q:$("#q_item").val(),id:x,ppto:$("#codigo_ppto").text()},
			type:'post',
			success:function(data){
				$("#contenedor_informacion_ppto").html("");
				$("#contenedor_informacion_ppto").html(data);
			}
		});
	}
}

function update_desc_item(x){
	var val = ($("#desc"+x).text());
	$("#desc"+x).html("");
	$("#desc"+x).append("<input type = 'text' id = 'desc_item"+x+"' class = 'entradas_bordes' value = '"+val+"'onkeyup ='guardar_desc(event,"+x+")'/>");
}


function cambiar_valor_cliente(x){
	var val = ($("#val_cliente"+x).text());
	$("#celda_cliente"+x).html("");
	$("#celda_cliente"+x).append("<input type = 'text' id = 'val_cliente' class = 'entradas_bordes' value = '"+val+"'onkeyup ='guardar_val_cliente(event,"+x+")'/><span id = 'h_val_cliente' class = 'hidde'>"+val+"</span>");
}

function guardar_val_cliente(e,x){
	if(e.keyCode == 13){
		if( parseFloat($("#h_val_cliente").text()) < parseFloat($("#h_item_val_tarifario"+x).text())){
			alert("EL VALOR DE "+$("#h_val_cliente").text() +" ES MENOR AL COSTO INTERNO DE "+$("#h_item_val_tarifario"+x).text());
		}else{
			$.ajax({
				url:'busqueda_produccion.php',
				data:{turno:17,q:$("#h_val_cliente").text(),id:x,ppto:$("#codigo_ppto").text()},
				type:'post',
				success:function(data){
					location.reload();
				}
			});
		}
		
	}else{
		var val = $("#val_cliente").val();
		var valor = val.split(",");
		var val_final = "";
		for(var i = 0;i < valor.length; i++){
			val_final += ""+valor[i];
		}
		$("#val_cliente").val(formatNumber.new(val_final));
		$("#h_val_cliente").text(val_final);
	}
}

function update_fecha(x){
	var val = ($("#fec"+x).text());
	$("#fec"+x).html("");
	
	$("#fec"+x).append("<input type = 'text' id = 'fecha"+x+"' value = '"+val+"'onkeyup ='guardar_fecha(event,"+x+")'/>");
	$("#fecha"+x).datepicker({ dateFormat: 'yy-mm-dd' });
}


function ponerfecha(x){
	var fecha = $("#fecha"+x).val();
	$("#fec"+x).html("<input type = 'text' class = 'inputs_ppto' id = 'fecha"+x+"' value = '"+fecha+"'onclick = 'ponerfecha("+x+")' />");
	$("#fecha"+x).datepicker({ dateFormat: 'yy-mm-dd' });
}
function guardar_fecha(e,x){
	if(e.keyCode == 13){
		var fecha = $("#fecha"+x).val();
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:18,q:$("#fecha"+x).val(),id:x,ppto:$("#codigo_ppto").text()},
			type:'post',
			success:function(data){
				//$("#contenedor_informacion_ppto").html("");
				//$("#contenedor_informacion_ppto").html(data);
				$("#fec"+x).html("");
				$("#fec"+x).html(fecha);
				var val = ($("#por_a"+x).text());
				$("#por_a"+x).html("");
				$("#por_a"+x).append("<input type = 'text' id = 'por_ant"+x+"' value = '"+val+"'onkeyup ='guardar_por(event,"+x+")'/>");
			}
		});
		
		
	}
}
function guardar_por(e,x){
	if(e.keyCode == 13){
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:19,q:$("#por_ant"+x).val(),id:x,ppto:$("#codigo_ppto").text()},
			type:'post',
			success:function(data){
				$("#contenedor_informacion_ppto").html("");
				$("#contenedor_informacion_ppto").html(data);
			}
		});
	}
}

function eliminar_item_ppto(x){
	$.ajax({
		url:'busqueda_produccion.php',
		data:{turno:20,id:x,ppto:$("#codigo_ppto").text()},
		type:'post',
		success:function(data){
			$("#contenedor_informacion_ppto").html("");
			$("#contenedor_informacion_ppto").html(data);
		}
	});
}

function eliminar_grupo_ppto(x){
	$.ajax({
		url:'busqueda_produccion.php',
		data:{turno:21,id:x,ppto:$("#codigo_ppto").text()},
		type:'post',
		success:function(data){
			$("#contenedor_informacion_ppto").html("");
			$("#contenedor_informacion_ppto").html(data);
		}
	});
}

function listado_items_nc(x,c){
	$("#"+c+"-item"+x).html("");
	$("#"+c+"-item"+x).append("<input type = 'text' id = 'nombre_item' class = 'entradas_bordes' onkeyup ='abrir_lista_items_nc("+x+","+c+")'/><div style = 'width:100%;height:150px;overflow:scroll;' id = 'listado_items'></div>");
}
function abrir_lista_items_nc(x,c){
	if($("#nombre_item").val() == ""){
		$("#listado_items").html("");
	}else{
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:22,name:$("#nombre_item").val(),celula:c},
			type:'post',
			success:function(data){
				$("#listado_items").html("");
				$("#listado_items").html(data);
			}
		});
	}
}

function item_selected_nc(z){
	var grupo = ($('input:radio[name=item_nc]:checked').val());
	$.ajax({
		url:'busqueda_produccion.php',
		data:{turno:13,item:grupo,ppto:$("#codigo_ppto").text(),celula:z},
		type:'post',
		success:function(data){
			$("#listado_items").html("");
			$("#contenedor_informacion_ppto").html("");
			$("#contenedor_informacion_ppto").html(data);
		}
	});
}

function cambiar_imprevistos(x){
	var val = parseFloat($("#imprevistos_h").text());
	$("#impresvistos").html("");
	$("#impresvistos").append("<input type = 'text' id = 'imprevi' value = '"+val+"'class = 'entradas_bordes' onkeyup ='guardar_imprevisto(event,"+x+")'/>");
}

function guardar_imprevisto(e,x){
	if(e.keyCode == 13){
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:23,q:$("#imprevi").val(),ppto:$("#codigo_ppto").text()},
			type:'post',
			success:function(data){
				$("#contenedor_informacion_ppto").html("");
				$("#contenedor_informacion_ppto").html(data);
			}
		});
	}
}

function cambiar_gas_admin(x){
	var val = parseFloat($("#gas_admin_h").text());
	$("#gas_admin").html("");
	$("#gas_admin").append("<input type = 'text' id = 'gastos' value = '"+val+"'class = 'entradas_bordes' onkeyup ='guardar_gasto(event,"+x+")'/>");
}
function guardar_gasto(e,x){
	if(e.keyCode == 13){
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:24,q:$("#gastos").val(),ppto:$("#codigo_ppto").text()},
			type:'post',
			success:function(data){
				$("#contenedor_informacion_ppto").html("");
				$("#contenedor_informacion_ppto").html(data);
			}
		});
	}
}

function cambiar_factoring_impuestos(x){
	var val = parseFloat($("#factoring_impuestos_h").text());
	$("#factoring_impuestos").html("");
	$("#factoring_impuestos").append("<input type = 'text' id = 'factoring_imp' value = '"+val+"'class = 'entradas_bordes' onkeyup ='guardar_factoring_imp(event,"+x+")'/>");
}
function guardar_factoring_imp(e,x){
	if(e.keyCode == 13){
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:34,q:$("#factoring_imp").val(),ppto:$("#codigo_ppto").text()},
			type:'post',
			success:function(data){
				$("#contenedor_informacion_ppto").html("");
				$("#contenedor_informacion_ppto").html(data);
			}
		});
	}
}

function editar_numero_cheques(ppto,val){
	$("#cheques_ppto").html("<input type = 'text' id = 'val_cheques' value = '"+val+"' onkeypress = 'guardar_cheques(event,"+ppto+")'/>");
}

function guardar_cheques(e,ppto){
	if(e.keyCode == 13){
		$.ajax({
			url:'busqueda_produccion.php',
			data:{num:$("#val_cheques").val(),ppto:ppto,turno:38},
			type:'post',
			success:function(data){
				$("#contenedor_informacion_ppto").html(data);
			}
		});
	}
}


function update_volumen_item(id,valor,ppto){
	$("#volumen_item"+id).html("<input type = 'text' id = 'valor_volumen"+id+"' value = '"+valor+"' onkeypress = 'guardar_valor_volumen(event,"+id+","+ppto+")'/>");
}

function guardar_valor_volumen(e,id,ppto){
	if(e.keyCode == 13){
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:39,vol:$("#valor_volumen"+id).val(),ppto:ppto,id:id},
			type:'post',
			success:function(data){
				$("#contenedor_informacion_ppto").html(data);
			}
		});
	}
}

function cambiar_ant_int_bancarios_impuestos(x){
	var val = parseFloat($("#ant_int_bancarios_imp_h").text());
	$("#ant_int_bancarios_imp").html("");
	$("#ant_int_bancarios_imp").append("<input type = 'text' id = 'ant_int_ban' value = '"+val+"'class = 'entradas_bordes' onkeyup ='guardar_ant_int_bancarios_imp(event,"+x+")'/>");
}
function guardar_ant_int_bancarios_imp(e,x){
	if(e.keyCode == 13){
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:35,q:$("#ant_int_ban").val(),ppto:$("#codigo_ppto").text()},
			type:'post',
			success:function(data){
				$("#contenedor_informacion_ppto").html("");
				$("#contenedor_informacion_ppto").html(data);
			}
		});
	}
}
function cambiar_pro_int_bancarios_impuestos(x){
	var val = parseFloat($("#pro_int_bancarios_imp_h").text());
	$("#pro_int_bancarios_imp").html("");
	$("#pro_int_bancarios_imp").append("<input type = 'text' id = 'pro_int_bancarios_imp_v' value = '"+val+"'class = 'entradas_bordes' onkeyup ='guardar_pro_int_bancarios_imp(event,"+x+")'/>");
}
function guardar_pro_int_bancarios_imp(e,x){
	if(e.keyCode == 13){
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:36,q:$("#pro_int_bancarios_imp_v").val(),ppto:$("#codigo_ppto").text()},
			type:'post',
			success:function(data){
				$("#contenedor_informacion_ppto").html("");
				$("#contenedor_informacion_ppto").html(data);
			}
		});
	}
}
function cambiar_pro_int_ter_impuestos(x){
	var val = parseFloat($("#pro_int_ter_imp_h").text());
	$("#pro_int_ter_imp").html("");
	$("#pro_int_ter_imp").append("<input type = 'text' id = 'pro_int_ter_imp_v' value = '"+val+"'class = 'entradas_bordes' onkeyup ='guardar_pro_int_ter_imp(event,"+x+")'/>");
}
function guardar_pro_int_ter_imp(e,x){
	if(e.keyCode == 13){
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:37,q:$("#pro_int_ter_imp_v").val(),ppto:$("#codigo_ppto").text()},
			type:'post',
			success:function(data){
				$("#contenedor_informacion_ppto").html("");
				$("#contenedor_informacion_ppto").html(data);
			}
		});
	}
}


function input_proveedor(id_item,id_real){
	var text = $("#prove"+id_item+" option:selected").text()
	$("#prove"+id_item).css({"background-color":"white"});
	$("#prove"+id_item).html("<input type = 'text' id = 'proveinput"+id_item+"' value = '"+text+"' onkeyup = 'listar_proveedores_text("+id_item+","+id_real+")'/><div style = 'width:100%;height:150px;overflow:scroll;' id = 'contenedor_listado_prov'></div>");
}

function listar_proveedores_text(id_item,id_real){
	var text = $("#proveinput"+id_item).val();
	$.ajax({
		url:'busqueda_produccion.php',
		data:{turno:31,name:text,id:id_item,id_real:id_real},
		type:'post',
		success:function(data){
			$("#contenedor_listado_prov").html(data);
		}
	});
}

function seleccionar_proveedor_item_ppto(pro,id_item,id_real){
	$.ajax({
		url:'busqueda_produccion.php',
		data:{turno:32,id:id_item,pro:pro,id_real:id_real},
		type:'post',
		success:function(data){
			location.reload();
		}
	});
}

function formatear_valor_item_interno(e,id_item,id_real,valor){
	if(e.keyCode == 13){
		var val = $("#h_input_val_item_tarifario"+id_item).text();
		var valor_estado = 2;
		if(valor > val){
			valor_estado = 1;
			alert("HA INGRESADO UN VALOR MENOR AL ALMACENADO. EL VALOR INTERNO DEL ITEM SE ACTUALIZARÁ!");
		}
		$.ajax({
			url:'busqueda_produccion.php',
			data:{id_item:id_item,id_real:id_real,valor_original:valor,valor_n:val,estado:valor_estado,turno:33},
			type:'post',
			success:function(data){
				
				location.reload();
			}
		});
	}else{
		var val = $("#input_val_item_tarifario"+id_item).val();
		var valor = val.split(",");
		var val_final = "";
		for(var i = 0;i < valor.length; i++){
			val_final += ""+valor[i];
		}
		$("#input_val_item_tarifario"+id_item).val(formatNumber.new(val_final));
		$("#h_input_val_item_tarifario"+id_item).text(val_final);
	}
	
	
}

function input_item_valor_unitario(id_item,id_real,valor_interno_t){
	var text = $("#h_item_val_tarifario"+id_item).text();
	var variable1 = 'input_val_item_tarifario'+id_item;
	var variable2 = 'h_input_val_item_tarifario'+id_item;
	$("#item_val_tarifario"+id_item).html("<span class = 'hidde' id = 'h_input_val_item_tarifario"+id_item+"'>"+text+"</span><input type = 'text' id = 'input_val_item_tarifario"+id_item+"' value = '"+text+"' onkeyup = 'formatear_valor_item_interno(event,"+id_item+","+id_real+","+valor_interno_t+")'/>");
}

function modificar_informacion_item_ppto(id){
	$("#espacio_item"+id + " > td:nth-child(3)").html("<textarea rows = '7' cols = '40' id = 'desc_itemx"+id+"' onkeypress = 'guardar_desc(event,"+id+")'>"+$("#desc"+id).text()+"</textarea>");
	//alert($("#desc"+id).text());
}
function guardar_desc(e,x){
	//alert(e.keyCode);
	if(e.keyCode == 13){
		$.ajax({
		url:'busqueda_produccion.php',
		data:{turno:16,q:$("#desc_item"+x).val(),id:x,ppto:$("#codigo_ppto").text()},
		type:'post',
		success:function(data){
			$("#contenedor_informacion_ppto").html("");
			$("#contenedor_informacion_ppto").html(data);
		}
	});
	}
	/*$.ajax({
		url:'busqueda_produccion.php',
		data:{turno:16,q:$("#desc_itemx"+x).val(),id:x,ppto:$("#codigo_ppto").text()},
		type:'post',
		success:function(data){
			//$("#contenedor_informacion_ppto").html("");
			//$("#contenedor_informacion_ppto").html(data);
		}
	});*/
}

function guardar_cambios_items(id_item){
	$.ajax({
		url:'busqueda_produccion.php',
		data:{turno:56,id:id_item, desc:$("#textarea_descripcion"+id_item).val(), q:$("#numero_real_cantidad"+id_item).text(),d:$("#numero_real_dias"+id_item).text(),
		vcotizacion:$("#h_item_val_tarifario"+id_item).text(), vol:$("#valor_volumen_item_valor"+id_item).text(), vexterna:$("#valor_cobrar_cliente_real"+id_item).text(),
		fa:$("#fecha"+id_item).val(),pfa:$("#porant"+id_item).val(),iva:$("#iva_item_valor_item"+id_item).val()},
		type:'post',
		success:function(dat){
			location.reload();
		}
	});
}

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


function formatear_valor_q(e,id){
	var val = $("#input_cantidad"+id).val();
	var valor = val.split(",");
	var val_final = "";
	for(var i = 0;i < valor.length; i++){
		val_final += ""+valor[i];
	}
	$("#input_cantidad"+id).val(formatNumber.new(val_final));
	$("#numero_real_cantidad"+id).text(val_final);
	
}

function formatear_valor_d(e,id){
	var val = $("#input_dias"+id).val();
	var valor = val.split(",");
	var val_final = "";
	for(var i = 0;i < valor.length; i++){
		val_final += ""+valor[i];
	}
	$("#input_dias"+id).val(formatNumber.new(val_final));
	$("#numero_real_dias"+id).text(val_final);
	
}

function formatear_valor_v_unitario(e,id){
	var val = $("#valor_unitario_venta_ppto"+id).val();
	var valor = val.split(",");
	var val_final = "";
	for(var i = 0;i < valor.length; i++){
		val_final += ""+valor[i];
	}
	$("#valor_unitario_venta_ppto"+id).val(formatNumber.new(val_final));
	$("#h_item_val_tarifario"+id).text(val_final);
	
}

function formatear_valor_v_volumen(e,id){
	var val = $("#valor_volumen_ppto_valor"+id).val();
	var valor = val.split(",");
	var val_final = "";
	for(var i = 0;i < valor.length; i++){
		val_final += ""+valor[i];
	}
	$("#valor_volumen_ppto_valor"+id).val(formatNumber.new(val_final));
	$("#valor_volumen_item_valor"+id).text(val_final);
	
}

function formatear_valor_v_externa(e,id){
	var val = $("#valor_cobrar_cliente"+id).val();
	var valor = val.split(",");
	var val_final = "";
	for(var i = 0;i < valor.length; i++){
		val_final += ""+valor[i];
	}
	$("#valor_cobrar_cliente"+id).val(formatNumber.new(val_final));
	$("#valor_cobrar_cliente_real"+id).text(val_final);
	
}
function buscar_items_diferentes(ppto){
	$.ajax({
		url:'busqueda_produccion.php',
		data:{turno:58,item:$("#item_asoc_principal").val(),ppto:$("#codigo_ppto").text()},
		type:'post',
		success:function(data){
			$("#list_select_asoc").html(data);
			$("#list_valores_items_selected_asoc").html("");
			acum_sumar_asoc(ppto);
		}
	});
	
}

function acum_sumar_asoc(ppto){
	var item_selected = [];
	$("input[name='items_asoc_ppto[]']:checked").each(function() {
        item_selected.push($(this).val());
    });
	if(item_selected.length == 0){
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:59,items:"x",principal:$("#item_asoc_principal").val(),ppto:$("#codigo_ppto").text()},
			type:'post',
			success:function(dat){
				$("#list_valores_items_selected_asoc").html(dat);
			}
		});
	}else{
		$.ajax({
			url:'busqueda_produccion.php',
			data:{turno:59,items:item_selected,principal:$("#item_asoc_principal").val(),ppto:$("#codigo_ppto").text()},
			type:'post',
			success:function(dat){
				$("#list_valores_items_selected_asoc").html(dat);
			}
		});
	}
	
}

function guardar_asociacion_items(ppto){
	var item_selected = [];
	$("input[name='items_asoc_ppto[]']:checked").each(function() {
        item_selected.push($(this).val());
    });
	$.ajax({
		url:'busqueda_produccion.php',
		data:{turno:60,items:item_selected,principal:$("#item_asoc_principal").val(),ppto:$("#codigo_ppto").text()},
		type:'post',
		success:function(dat){
			alert("ITEMS ASOCIADOS");
			//$(".scroll").css({"overflow-y":"scroll"});
			//$("#ventana_asoc_items").dialog('close');
			location.reload();
		}
	});
}