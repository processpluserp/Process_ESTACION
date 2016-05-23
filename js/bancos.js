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
function formatear_valor(e,x,y){
	var val = $("#"+x).val();
	var valor = val.split(",");
	var val_final = "";
	for(var i = 0;i < valor.length; i++){
		val_final += ""+valor[i];
	}
	$("#"+x).val(formatNumber.new(val_final));
	$("#"+y).text(val_final);	
}
$(document).ready(function(){
	var contenedor_fest = [];
	var festivos = [];
	$.ajax({
		url:'gestion_all2.php',
		data:{t:116},
		type:'post',
		success:function(data){
			var contenedor = data;
			contenedor_fest = contenedor.split("***");							
			for(var i = 1; i < contenedor_fest.length; i++){
				var aux = contenedor_fest[i].split(",");
				festivos[i] = [ [aux[0]],[aux[1]],[aux[2]] ];
			}
		}
	});
	var alto = $(window).height();
	var ancho_x = $(window).width();
	var ancho_por = (ancho_x*99)/100;
	var ancho_por2 = (ancho_x*99)/100;
	var x = (alto*99)/100;
	var alto_h = (alto*60)/100;			
					
	function nonWorkingDates(date){
		var day = date.getDay(), Sunday = 0, Monday = 1, Tuesday = 2, Wednesday = 3, Thursday = 4, Friday = 5, Saturday = 6;
						//var closedDates = [festivos];// [[8, 7, 2015], [8, 28, 2015]];
		var closedDays = [[Saturday], [Sunday]];
		for (var i = 0; i < closedDays.length; i++) {
			if (day == closedDays[i][0]) {
				return [false];
			}
		}

		for (i = 1; i < festivos.length; i++) {
			if (date.getMonth() == festivos[i][0] - 1 &&
				date.getDate() == festivos[i][1] &&
				date.getFullYear() == festivos[i][2]) {
					return [false];
				}
			}
			return [true];
	}
	jQuery.ajaxSetup({
		beforeSend: function() {
			$('#spinner').show();
		},
		complete: function(){
			$('#spinner').hide();
		 },
		success: function() {
			$('#spinner').show();
		}
		});
	
	
	var alto_popup = $(window).height();
	var alto_y_popup = (alto_popup*70)/100;
	var alto_y_popup2 = (alto_popup*75)/100;
	if($(window).height() < 600){
		$("#contenedor_contactos").css({'height':"300px","min-height":"300px"});
		//$("#contenedor_opciones_admin").css({'height':"300px","min-height":"300px"});
	}else{
		$("#contenedor_contactos").css({'height':alto_y_popup+'px',"min-height":"300px"});	
		//$("#contenedor_opciones_admin").css({'height':alto_y_popup2+'px',"min-height":"300px"});	
	}

	$("#form_nuevo_banco").dialog({
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
        	top:"10px"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	$("#nuevo_banco").on('click',function(){
		$("#form_nuevo_banco").dialog('open');
	});
		
	$("#n_cancelar_banco_gestion").on('click',function(){
		$("#form_nuevo_banco input").val("");
		$("#form_nuevo_banco").dialog('close');
	});

	$("#n_guardar_banco_gestion").on('click',function(){
		var file = $("#n_logo_bienvenida")[0].files[0];
        var fileName = file.name;
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
		if(fileExtension == 'png' || fileExtension == 'jpg'){
			data = new FormData();
			var archivos = document.getElementById("n_logo_bienvenida");
			var archivo = archivos.files;
			for(i=0; i<archivo.length; i++){
				data.append('logo'+i,archivo[i]);	
			}
			var archivos = document.getElementById("n_logo_bienvenida2");
			var archivo = archivos.files;
			for(i=0; i<archivo.length; i++){
				data.append('bienve'+i,archivo[i]);	
			}
			data.append('emp',$("#empresa_final").text());
			data.append('ncomercial_banco',$("#ncomercial_banco").val());
			data.append('direccion',$("#direccion").val());
			data.append('nsocial_banco',$("#nsocial_banco").val());
			data.append('phone',$("#phone").val());
			data.append('nnit_banco',$("#nnit_banco").val());
			data.append('pagina',$("#pagina").val());
			data.append('correo',$("#correo").val());
			data.append('n_pais_empresa',$("#n_pais_empresa").val());
			data.append('n_departamento_empresa',$("#n_departamento_empresa").val());
			data.append('n_ciudad_empresa',$("#n_ciudad_empresa").val());
			data.append('t',66);
			$.ajax({
				url:'gestion_all2.php',
				data:data,
				type:'post',
				contentType:false,
				processData:false, 
				success:function(data){
				}
			});
			var e_asoc = [];
			$("input[name='empresas[]']:checked").each(function() {
			          e_asoc.push($(this).val());
			      });
					$.ajax({
						url:'gestion_all2.php',
						data:{t:162,e_asoc:e_asoc,nnit_banco:$("#nnit_banco").val()},
						type:'post',
						success:function(datax){
							alert(datax);
							document.location.reload();
						}
					});
		}else{
			alert("SOLO SE PUEDEN SUBIR IMÁGENES EN FORMATO PNG!!!");
		}
		
	});
	
	$("#info_basica,#contactos_banco,#nuevo_contacto_banco,#parametrizacion_banco,#cuadros_bancos").dialog({
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
        	top:"10px"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	$("#limpiar_img_bienvenida").on('click',function(){
		$("#n_logo_bienvenida").val("");
	});
	$("#limpiar_img_bienvenida2").on('click',function(){
		$("#n_logo_bienvenida2").val("");
	});

	$("#ventana_empleados").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:126,banco:$("#banco_actual").text()},
			type:'post',
			success:function(data){
				$("#contenedor_contactos").html(data);
			}
		});
		$("#contactos_banco").dialog('open');
	});
	$("#cerrar_ventana_contactos").on('click',function(){
		$("#contactos_banco").dialog('close');
	});
	
	$("#abrir_nuevo_contacto ").on('click',function(){
		$("#nuevo_contacto_banco").dialog('open');
	});
	$("#cancelar_contacto,#cerrar_nuevo_contacto").on('click',function(){
		$("#nuevo_contacto_banco").dialog('close');
	});
	
	$("#financiero").on('click',function(){
		$("#cuadros_bancos").dialog('open');
	});
	$("#crear_contacto_banco").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:127,name:$("#n_name").val(),n_cargo:$("#n_cargo").val(),n_correo:$("#n_correo").val(),n_telefono:$("#n_telefono").val(),n_celular:$("#n_celular").val(),mes_contacto:$("#mes_contacto").val(),n_dia:$("#n_dia").val(),banco:$("#banco_actual").text()},
			type:'post',
			success:function(data){
				alert("CONTACTO CREADO");
				$.ajax({
					url:'gestion_all2.php',
					data:{t:126,banco:$("#banco_actual").text()},
					type:'post',
					success:function(data){
						$("#contenedor_contactos").html(data);
					}
				});
				$("#nuevo_contacto_banco input").val("");
				$("#nuevo_contacto_banco select").val("0");
				$("#nuevo_contacto_banco").dialog('close');
			}
			
		});
	});
	
	$("#administracion").on('click',function(){
		$("#parametrizacion_banco").dialog('open');
	});
	
	
	
	$("#abrir_info_basica").on('click',function(){
		mostrar_info_banco();
		$("#info_basica").dialog('open');
	});
	
	$("#cerrar_info_basica").on('click',function(){
		$("#info_basica").dialog('close');
	});
	
	$("#documentos_banco").dialog({
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
        	top:"10px"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	$(".ui-dialog-titlebar").hide();
});

function editar_banco_gestion(id){
	$("#info_basica").css({"background-color":"#E3E3E3"});
	$.ajax({
		url:'gestion_all2.php',
		data:{t:125,id:id},
		type:'post',
		success:function(data){
			$("#contenedor_info_basica").html(data);
		}
	});
}

function abrir_panel_documentos(id){
	$("#documentos_banco").dialog('open');
}
function cerrar_ventana_editar(){
	$("#info_basica").css({"background-color":"white"});
	$("#info_basica").dialog('close');
}
function cambiar_pais_empresa(){
		
		var pais = $("#n_pais_empresa").val();
		$.ajax({
			url:'gestion_all.php',
			data:{p:pais,turno:6},
			type:'POST',
			success:function(data){
				$("#n_depto_empresa").html(data);
				$("#n_ciudad_empresa").val("");
			}
		});	
	}
	
	function limpiar_pais(x){
		cambiar_pais_empresa();
	}
	function cargar_ciudad(){
		var departamento = $("#n_depto_empresa").val();
		$.ajax({
			url:'gestion_all.php',
			data:{d:departamento,turno:7},
			type: 'POST',
			success:function(data){
				$("#n_ciudad_empresa").html(data);
			}
		});
	}
	function mostrar_info_banco(){
		$("#info_basica").css({"background-color":"white"});
		$.ajax({
			url:'gestion_all2.php',
			data:{t:67,b:$("#banco_actual").text()},
			type:'post',
			success:function(data){
				$("#contenedor_info_basica").html("");
				$("#contenedor_info_basica").html(data);
			}
		});
	}
	
	function update_info_banco(){
		formdata = new FormData(document.getElementById("update_form_bancos"));
		formdata.append("t",146);
		$.ajax({
			url:'gestion_all2.php',
			data:formdata,
			type:'post',
			contentType:false,
			processData:false,
			success:function(data){
				alert( " INFORMACIÓN ACTUALIZADA");
				mostrar_info_banco()
			}
		});
	}
	function editar_informacion_contacto(id){
		var campos = "<form id = 'update_datos_contato"+id+"'>";
		$("#editar_contactox"+id + " td").each(function(index){
			if(index <= 6){
				//campos +="<td><input type = 'text' name = '"+id+"name"+index+"' class = 'entradas_bordes' value = '"+$(this).text()+"'/></td>";
				campos +="<td><input type = 'text' name = 'x"+index+"' class = 'entradas_bordes' value = '"+$(this).text()+"'/></td>";
			}
			
		});
		$("#editar_contactox"+id).html(campos+"<td><a href = '#'><img src = '../images/iconos/ok_verde.png' height='25px' onclick = 'guardar_informacion_contacto("+id+")'/></a></td></form>");
	}

	function guardar_informacion_contacto(id){
		datax = new FormData();
		datax.append('t',163);
		datax.append('id',id);
		$("#editar_contactox"+id + " input").each(function(index){
			datax.append(id+"name"+index,$(this).val());
		});
		$.ajax({
			url:'gestion_all2.php',
			data:datax,
			type:'post',
			contentType:false,
			processData:false,
			success:function(data){
				alert(data);
			}
		});
		var campos = "";
		$("#editar_contactox"+id + " input").each(function(index){
			campos +="<td>"+$(this).val()+"</td>";
		});
		$("#editar_contactox"+id).html(campos+"<td align = 'center'><img src = '../images/iconos/icono_editar.png' class = 'iconos_barra' onclick = 'editar_informacion_contacto("+id+")'/></td>");
	}

	function form_nuevo_banco(){
		$("#form_nuevo_banco").dialog('open');
	}
	function cerrar_parametrizacion_banco(){
		$("#parametrizacion_banco").dialog('close');
	}
	
	function guardar_nuevo_producto_banco(){
		if($("#und_banco_nproducto").val().length > 0){
			if($("#und_tipo_nproducto").val().length > 0){
				if($("#num_cuenta_banco_und_n").val().length > 0){
					$.ajax({
						url:'gestion_all2.php',
						data:{t:170,banco:$("#banco_actual").text(),emp:$("#empresa_final").text(),und:$("#und_banco_nproducto").val(),tipo:$("#und_tipo_nproducto").val(),num:$("#num_cuenta_banco_und_n").val()},
						type:'post',
						success:function(d){
							alert("PRODUCTO CREADO !");
							$("#und_banco_nproducto,#und_tipo_nproducto").val("0");
							$("#num_cuenta_banco_und_n").val("");
						}
					});
				}else{
					alert("DEBE SELECCIONAR UN NÚMERO DE CUENTA!");
				}
			}else{
				alert("DEBE SELECCIONAR UN TIPO DE CUENTA!");
			}
		}else{
			alert("DEBE SELECCIONAR UNA UNIDAD DE NEGOCIO !");
		}
	}
	
	function cerrar_financiera_banco(){
		$("#cuadros_bancos").dialog('close');
	}
	
	function buscar_producto_und(){
		if($("#b_und_productoo").val() != 0){
			$.ajax({
				url:'gestion_all2.php',
				data:{t:171,und:$("#b_und_productoo").val()},
				type:'post',
				success:function(d){
					$("#b_productos_und_b").html(d);
				}
			});
		}
	}
	
	function buscar_info_cuenta(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:172,pro:$("#b_productos_und_b").val()},
			type:'post',
			success:function(d){
				$("#contenedor_info_producto").html(d);
			}
		});
	}
	
	function insertar_valor_item_producto(id){
		if($("#n_num").val().length > 2){
			if($("#text_nprod").val().length > 2){
				if($("#n_format_num").val().length > 0){
					$.ajax({
						url:'gestion_all2.php',
						data:{t:173,num:$("#n_num").val(),text:$("#text_nprod").val(),val:$("#n_buscar_format").text(),id:id},
						type:'post',
						success:function(d){
							$.ajax({
								url:'gestion_all2.php',
								data:{t:172,pro:$("#b_productos_und_b").val()},
								type:'post',
								success:function(d){
									$("#contenedor_info_producto").html(d);
								}
							});
						}
					});
				}
			}else{
				alert("DEBE ESPECIFICAR A FAVOR DE QUIÉN SE REALIZA !");
			}
		}else{
			alert("DEBE ESPECIFICAR SI ES CHEQUE O TRANSFERENCIA");
		}
	}
	
	function update_estado_pago(id){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:174,id:id},
			type:'post',
			success:function(d){
				$.ajax({
					url:'gestion_all2.php',
					data:{t:172,pro:$("#b_productos_und_b").val()},
					type:'post',
					success:function(d){
						$("#contenedor_info_producto").html(d);
					}
				});
			}
		});
	}
	
	function guardar_saldos_bancos(id){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:175,id:id,iva:$("#h_iva_saldo_banco").text(),h_reteiva_saldo_banco:$("#h_reteiva_saldo_banco").text(),
			h_ica_saldo_banco:$("#h_ica_saldo_banco").text(),h_reteica_saldo_banco:$("#h_reteica_saldo_banco").text(),h_refuente_saldo_banco:$("#h_refuente_saldo_banco").text(),h_cree_saldo_banco:$("#h_cree_saldo_banco").text(),h_saldo_saldo_banco:$("#h_saldo_saldo_banco").text(),
			h_canjes_saldo_banco:$("#h_canjes_saldo_banco").text()},
			type:'post',
			success:function(d){
				$.ajax({
					url:'gestion_all2.php',
					data:{t:172,pro:$("#b_productos_und_b").val()},
					type:'post',
					success:function(d){
						$("#contenedor_info_producto").html(d);
					}
				});
			}
		});
	}
	
	function eliminar_registro_banco(id){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:176,id:id},
			type:'post',
			success:function(d){
				$.ajax({
					url:'gestion_all2.php',
					data:{t:172,pro:$("#b_productos_und_b").val()},
					type:'post',
					success:function(d){
						$("#contenedor_info_producto").html(d);
					}
				});
			}
		});
	}