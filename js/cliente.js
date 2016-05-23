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



//PARA LA LIMPIEZA DE CARACTERES RAROS EN LOS ARCHIVOS ADJUNTOS
function getCleanedString(cadena){
   // Definimos los caracteres que queremos eliminar
   var specialChars = "!@#$^&%*()+=-[]\/{}|:<>?,";

   // Los eliminamos todos
   for (var i = 0; i < specialChars.length; i++) {
       cadena= cadena.replace(new RegExp("\\" + specialChars[i], 'gi'), '_');
   }   

   // Lo queremos devolver limpio en minusculas
   cadena = cadena.toLowerCase();

   // Quitamos espacios y los sustituimos por _ porque nos gusta mas asi
   cadena = cadena.replace(/ /g,"_");

   // Quitamos acentos y "ñ". Fijate en que va sin comillas el primer parametro
   cadena = cadena.replace(/á/gi,"a");
   cadena = cadena.replace(/é/gi,"e");
   cadena = cadena.replace(/í/gi,"i");
   cadena = cadena.replace(/ó/gi,"o");
   cadena = cadena.replace(/ú/gi,"u");
   cadena = cadena.replace(/ñ/gi,"n");
   return cadena;
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
	$( "#tabs" ).tabs();
	var contenedor_fest = [];
	var festivos = [];
	
	//$("#contenedor_opciones,#contenedor_opciones_admin").css({'height':'450px',"overflow":"scroll"});
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
		success: function() {}
		});
	
	var alto = $(window).height();
	var ancho_x = $(window).width();
	var ancho_x =$(window).width();
	var ancho_por = (ancho_x*99)/100;
	var ancho_por2 = (ancho_x*99)/100;
	var x = (alto*99)/100;
	var alto_h = (alto*60)/100;
	
	var alto_hh = (alto*80)/100;
	var alto_hhh = (alto*35)/100;
	

	
	var alto_popup = $(window).height();
	var alto_y_popup = (alto_popup*60)/100;
	var alto_y_popup2 = (alto_popup*75)/100;
	if($(window).height() < 600){
		$(".contenedor_info_tablas,#contenedor_contactos_x_cliente").css({'height':"300px","min-height":"300px"});
		$("#contenedor_documentos_clientes,#contenedor_opciones_admin").css({'height':"300px","min-height":"300px"});
	}else{
		$(".contenedor_info_tablas,#contenedor_contactos_x_cliente").css({'height':alto_y_popup+'px',"min-height":"300px"});	
		$("#contenedor_documentos_clientes,#contenedor_opciones_admin").css({'height':alto_y_popup2+'px',"min-height":"300px"});	
	}
	
		
		
	$("#b_nit").on('keyup',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:113,id:$("#b_nit").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_info_clientes").html(data);
			}
		});
	});
	
	$("#b_name_cliente").on('keyup',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:114,id:$("#b_name_cliente").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_info_clientes").html(data);
			}
		});
	});
	
	
	//Ventana información básica cliente
	$("#informacion_basica_cliente").dialog({
	  autoOpen: false,
      height:x,
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
	  modal:true,
	  resizable: false
    });
	
	$("#ventana_negociacion_cliente").dialog({
	  autoOpen: false,
      height:x,
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
	  modal:true,
	  resizable: false
    });
	$("#b_nego_cliente_list").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:138,cliente:$("#b_nego_cliente_list").val()},
			type:'post',
			success:function(Data){
				$("#contenedor_condiciones_clientes").html(Data);
			}
		});
	});
	
	$("#b_cont_cliente_list").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:139,cliente:$("#b_cont_cliente_list").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(Data){
				$("#contenedor_contratos_clientes").html(Data);
			}
		});
	});
	
	$("#n_negociacion_cliente").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:25,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#list_cliente_nego_n").html("");
				$("#list_cliente_nego_n").html(data);
			}
		});
		$("#ventana_negociacion_cliente").dialog('open');
	});
	$("#cerrar_ventana_nego_clientes,#cancelar_nego_cliente").on('click',function(){
		$("#ventana_negociacion_cliente").dialog('close');
	});
	
	
	$("#crear_nego_cliente").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:137,regimen:$('input:radio[name=regimen]:checked').val(),auto:$('input:radio[name=autoretenedor]:checked').val(),riva:$("#reteiva_cond").val(),rfuente:$("#retefuente_cond").val(),
			comision:$("input:radio[name=comision]:checked").val(),val_comision:$("#valor_comision_cliente").val(),fact:$("#cierre_fact_cliente").val(),cliente:$("#list_cliente_nego_n").val(),dias:$("#dias_pago_cliente").val(),ter:$("#val_comi_terceros").val()},
			type:'post',
			success:function(data){
				$("#b_nego_cliente_list").val($("#list_cliente_nego_n").val());
				alert("CONDICIÓN DE CLIENTE CREADA");
				$.ajax({
					url:'gestion_all2.php',
					data:{t:138,cliente:$("#b_nego_cliente_list").val()},
					type:'post',
					success:function(Data){
						$("#contenedor_condiciones_clientes").html(Data);
					}
				});
				$("#ventana_negociacion_cliente").dialog('close');
			}
		});
	});
	
	//Evento para abrir la información básica del cliente.
	$("#abrir_info_basica,#abrir_info_basica_t").on('click',function(){
		$(".scroll").css({"overflow-y":"hidden"});
		abrir_caudro_cliente();
	});
	
	//Evento para cerrar la información básica del cliente.
	$("#c_v_info_cliente").on('click',function(){
		$(".scroll").css({"overflow-y":"scroll"});
		$("#informacion_basica_cliente").dialog('close');
	});
	
	
	
	//Nuevo Cliente
	$("#n_cliente_empresa").dialog({
	  autoOpen: false,
      height:x,
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
	  modal:true,
	  resizable: false
    });
	
	//Evento para abrir el formulario del nuevo cliente.
	$("#n_cliente").on('click',function(){
		//$("#informacion_basica_cliente").dialog('close');
		$("#n_cliente_empresa").dialog('open');
	});
	
	//Evento para cerrar el formulario del nuevo cliente.
	$("#c_v_n_cliente,#cancelar_crear_cliente").on('click',function(){
		$("#n_cliente_empresa input").val("");
		var imp = "<tr><td><p>NOMBRE</p><input type = 'text' name = 'nombre_contactos[]'/>";
		imp += "</td><td><p>CARGO</p><input type = 'text' name = 'cargos[]'/></td>";
		imp += "</td><td><p>EMAIL</p><input type = 'text' name = 'email[]'/></td>";
		imp += "<td><p>TELÉFONO</p><input type = 'text' name = 'phone[]'/></td>";
		imp += "<td><p>CELULAR</p><input type = 'text' name = 'celular[]'/></td>";
		imp += "<td><p>MES</p><input type = 'text' name = 'mes[]'/></td>";
		imp += "<td><p>DÍA</p><input type = 'text' name = 'dia[]'/></td></tr></tr>";
		$("#listado_contactos_cliente").html("");
		$("#listado_contactos_cliente").html(imp);
		$(".scroll").css({'overflow':'scroll'});
		$("#n_cliente_empresa").dialog('close');
	});
	
	//Añadir campos nuevo contacto cliente.
	$("#add_contacto_cliente").on('click',function(){
		var imp = "<tr><td><input type = 'text' name = 'nombre_contactos[]'/>";
		imp += "</td><td><input type = 'text' name = 'cargos[]'/></td>";
		imp += "</td><td><input type = 'text' name = 'email[]'/></td>";
		imp += "<td><input type = 'text' name = 'phone[]'/></td>";
		imp += "<td><input type = 'text' name = 'celular[]'/></td>";
		imp += "<td><input type = 'text' name = 'mes[]'/></td>";
		imp += "<td><input type = 'text' name = 'dia[]'/></td></tr></tr>";
		$("#listado_contactos_cliente").append(imp);
	});
	
	//Guardar Información del nuevo cliente
	$("#crear_cliente").on('click',function(){
		
		var check_empresa = [];
		$("input[name='empresas[]']:checked").each(function() {
            check_empresa.push($(this).val());
        });
		var iniciales = [];
		$("input[name='iniciales[]']").each(function(){
			if($(this).val() == ""){
				
			}else{
				iniciales.push($(this).val());
			}
        });
		
		var comision = "";
		var porNombre=document.getElementsByName("comision");
		for(var i=0;i<porNombre.length;i++){
			if(porNombre[i].checked)
				comision=porNombre[i].value;
		}
		if(check_empresa.length > 0){
			if(iniciales.length > 0){
				$.ajax({
					url:'gestion_all2.php',
					data:{t:20,nit:$("#nit").val(),n_legal:$("#n_legal").val(),n_comercial:$("#n_comercial").val(),tel:$("#tel").val(),direccion:$("#direccion").val(),
					n_pais_empresa:$("#n_pais_empresa").val(),n_departamento_empresa:$("#n_departamento_empresa").val(),n_ciudad_empresa:$("#n_ciudad_empresa").val(),check_empresa:check_empresa,iniciales:iniciales},
					type:'post',
					success:function(data){
						alert(data);
						$("#nit,#n_legal,#n_comercial,#tel,#direccion").val("");
						$("#n_cliente_empresa").dialog('close');
						abrir_caudro_cliente();
					}
				});
			}else{
				alert("Usted debe ingresar las iniciales del cliente ");
			}
			
		}else{
			alert("Usted debe seleccionar una empresa ");
		}
		
		
	});
	
	//Muestra la info completa del cliente
	$("#muestra_info_cliente").dialog({
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
	  modal:true,
	  resizable: false
    });
	
	
	//Ventana documentos cliente
	$("#documentos_cliente").dialog({
	  autoOpen: false,
      height:x,
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
	  modal:true,
	  resizable: false
    });
	
	//Evento para abrir la ventana de documentos.
	$("#abrir_documentos_cliente,#abrir_documentos_cliente_n").on('click',function(){
		abrir_documentos_empleados();
		$("#documentos_cliente").dialog('open');
	});
	
	//Cerrar ventana documentos clientes
	$("#c_v_doc_cliente").on('click',function(){
		$("#documentos_cliente").dialog('close');
	});
	
	
	//VENTANA NUEVO DOCUMENTO CLIENTE:
	$("#n_documento_cliente").dialog({
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
	  modal:true,
	  resizable: false
    });
	
	//abrir ventana nuevo documento
	$("#n_doc_cliente").on('click',function(){
		//abrir_documentos_empleados();
		$.ajax({
			url:'gestion_all2.php',
			data:{t:25,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#listado_clientes_doc").html("");
				$("#listado_clientes_doc").html(data);
			}
		});
		$("#n_documento_cliente").dialog('open');
	});
	
	//cerrar ventana nuevo documento
	$("#c_v_n_doc_cliente,#cancelar_crear_doc_cliente").on('click',function(){
		$("#n_documento_cliente").dialog('close');
	});
	//LIMPIAR INPUT DOCUMENTOS
	$("#limpiar_doc_cliente").on('click',function(){
		$("#archivo_doc").val('');
	});
	
	//GUARDAR DOCUMENTO
	$("#crear_doc_cliente").on('click',function(){
		if($("#archivo_doc").val() == "" || $("#listado_clientes_doc").val() == ""){
			alert("LOS CAMPOS CON * SON OBLIGATORIOS");
			$("#archivo_doc,#listado_clientes_doc").css({"border":"2px solid red"});
		}else{
			data =  new FormData();
			var archivos = document.getElementById("archivo_doc");
			var archivo = archivos.files;
			for(i=0; i<archivo.length; i++){
				data.append('archivo'+i,archivo[i]);	
				data.append('name_archivo'+i, getCleanedString(archivo[i].name) );
			}
			data.append('doc',$("#tipo_documento_cliente").val());
			data.append('cliente',$("#listado_clientes_doc").val());
			data.append('t',24);
			$.ajax({
				url:'gestion_all2.php',
				data:data,
				type:'post',
				contentType:false,
				processData:false,
				success:function(data){
					alert("SE HA SUBIDO EL DOCUMENTO CON EXITO");
					$("#archivo_doc,#listado_clientes_doc").css({"border":"0px"});
					$("#n_documento_cliente input").val("");
					$("#n_documento_cliente").dialog('close');
					abrir_documentos_empleados($("#listado_clientes_doc").val());
				}
			});
		}
	});
	
	
	//CONTRATOS CON CLIENTES
	$("#contratos_clientes").dialog({
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
	  modal:true,
	  resizable: false
    });
	/*
	$("#abrir_contratos_n,#abrir_contratos").on('click',function(){
		abrir_contratos_empleados();
		
		//$("#contratos_clientes").dialog("open");
	});
	*/
	$("#c_v_n_contratos_cliente").on('click',function(){
		$(".scroll").css({'overflow':'scroll'});
		$("#contratos_clientes").dialog("close");
	});
	
	
	
	$("#nuevo_contrato").dialog({
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
	  modal:true,
	  resizable: false
    });
	
	$("#n_contrato_cliente").on('click',function(){
		$("#nuevo_contrato").dialog("open");
	});
	
	$("#fcontrato").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#ffirma").datepicker({  dateFormat: 'yy-mm-dd'  });
	$("#fterminacion").datepicker({  dateFormat: 'yy-mm-dd',beforeShowDay: nonWorkingDates,	numberOfMonths: 1,	minDate: '0',firstDay: 1 });
	
	$("#c_v_nn_contratos_cliente,#cancelar_crear_contrato_cliente").on('click',function(){
		$("#nuevo_contrato input").val("");
		$("#nuevo_contrato").dialog("close");
	});
	
	//LIMPIAR INPUT DOCUMENTOS
	$("#limpiar_contratos_cliente").on('click',function(){
		$("#archivo_contrato").val('');
	});
	
	$("#crear_contrato_cliente").on('click',function(){
		data =  new FormData();
		var archivos = document.getElementById("archivo_contrato");
		var archivo = archivos.files;
		for(i=0; i<archivo.length; i++){
			
			data.append('name_archivo'+i,getCleanedString(archivo[i].name));
			data.append('archivo'+i,archivo[i]);	
		}
		data.append('nombre_contrato_clie',$("#nombre_contrato_clie").val());
		data.append('cliente',$("#listado_clientes_contrato").val());
		data.append('emp',$("#empresa_final").text());
		data.append('fcontrato',$("#fcontrato").val());
		data.append('ffirma',$("#ffirma").val());
		data.append('tipo_contrato',$("#tipo_contrato_cliente").val());
		data.append('fterminacion',$("#fterminacion").val());
		data.append('valor',$("#h_valor_contrato_cliente").text());
		data.append('t',26);
		$.ajax({
			url:'gestion_all2.php',
			data:data,
			type:'post',
			contentType:false,
			processData:false,
			success:function(data){
				$("#nuevo_contrato input").val("");
				$("#nuevo_contrato").dialog('close');
				$("#contratos_clientes").dialog("close");
				$.ajax({
					url:'gestion_all2.php',
					data:{t:25,emp:$("#empresa_final").text()},
					type:'post',
					success:function(data){
						$("#listado_clientes_contrato").html("");
						$("#listado_clientes_contrato").html(data);
						abrir_contratos_empleados();
					}
				});
				$("#contratos_clientes").dialog("open");
			}
		});
	});
	
	
	//PRODUCTOS CLIENTE:
	$("#productos_clientes").dialog({
	  autoOpen: false,
      height: "420",
      width: "680",
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 0.9,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	$("#productos_cliente_n,#productos_cliente").on('click',function(){
		abrir_contratos_empleados();
		
		$("#productos_clientes").dialog("open");
	});
	
	$("#nuevo_producto_cliente").dialog({
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
	  modal:true,
	  resizable: false
    });
	
	$("#n_producto_cliente").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:25,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#n_cliente_producto").html("");
				$("#n_cliente_producto").html(data);
			}
		});
		$("#nuevo_producto_cliente").dialog("open");
	});
	
	$("#c_v_producto_cliente").on('click',function(){
		$("#productos_clientes").dialog("close");
	});
	
	$("#c_v_n_producto_cliente,#cancelar_crear_producto_cliente").on('click',function(){
		$("#nuevo_producto_cliente input").val('');
		$("#nuevo_producto_cliente").dialog("close");
	});
	
	
	$("#crear_producto_cliente").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:28,cliente:$("#n_cliente_producto").val(),name:$("#nombre_producto").val(),fee:$("#fee_val").val()},
			type:'post',
			success:function(data){
				alert("PRODUCTO CREADO");
				$("#nuevo_producto_cliente input").val('');
				$("#nuevo_producto_cliente").dialog("close");
				$("#cliente_producto").val($("#n_cliente_producto").val());
				$("#contenedor_productos_cliente").html("");
				$("#contenedor_productos_cliente").html(data);
			}
		});
	});
	
	$("#cliente_producto").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:29,cliente:$("#cliente_producto").val()},
			type:'post',
			success:function(data){
				$("#contenedor_productos_cliente").html("");
				$("#contenedor_productos_cliente").html(data);
			}
		});
	});
	
	$("#informacion_fee").dialog({
	  autoOpen: false,
      height: "320",
      width: "auto",
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 0.9,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	$("#abrir_fee_n,#abrir_fee").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:25,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#cliente_fee").html("");
				$("#cliente_fee").html(data);
			}
		});
		$("#informacion_fee").dialog("open");
	});
	
	
	$("#new_fee").dialog({
	  autoOpen: false,
      height: "360",
      width: "auto",
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 0.9,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	$("#c_v_fee_cliente").on('click',function(){
		$("#informacion_fee").dialog("close");
	});
	$("#n_fee_cliente").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:25,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#n_cliente_fee").html("");
				$("#n_cliente_fee").html(data);
			}
		});
		$("#new_fee").dialog("open");
	});
	
	$("#c_v_n_fee_cliente,#cancelar_crear_fee_cliente").on('click',function(){
		$("#new_fee input").val("");
		$("#new_fee").dialog("close");
	});
	
	$("#n_cliente_fee").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:30,cliente:$("#n_cliente_fee").val()},
			type:'post',
			success:function(data){
				$("#n_procliente").html("");
				$("#n_procliente").html(data);
			}
		});
	});
	
	$("#crear_fee_cliente").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:31,cliente:$("#n_cliente_fee").val(),producto:$("#n_procliente").val(),valor:$("#valor_fee").val()},
			type:'post',
			success:function(data){
				$("#new_fee input").val("");
				$("#new_fee").dialog("close");
				$("#contenedor_fee").html("");
				$("#contenedor_fee").html(data);
			}
		});
	});
	
	
	$("#cliente_fee").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:32,cliente:$("#cliente_fee").val()},
			type:'post',
			success:function(data){
				$("#contenedor_fee").html("");
				$("#contenedor_fee").html(data);
			}
		});
	});
	
	$("#opciones_grilla").dialog({
	  autoOpen: false,
      height: "150",
      width: "auto",
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 0.9,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	$("#abrir_grilla,#abrir_grilla_n").on('click',function(){
		$("#opciones_grilla").dialog("open");
	});
	$("#cerrar_ventana_opciones_grilla").on('click',function(){
		$("#opciones_grilla").dialog("close");
	});
	
	$("#grilla_clientes_sin_fee").dialog({
	  autoOpen: false,
      height:"900",
      width: "90%",
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 0.9,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	$("#abrir_consola_clientes_sin_fee").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:16,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#n_und_negocio_consola").html("");
				$("#n_und_negocio_consola").html(data);
			}
		});
		
		$.ajax({
			url:'gestion_all2.php',
			data:{t:25,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#n_cliente_consola").html("");
				$("#n_cliente_consola").html(data);
			}
		});
		$("#grilla_clientes_sin_fee").dialog("open");
	});
	
	$("#n_cliente_consola").on('change',function(){
		$("#ejecutivo_asignado").html("<p>EJECUTIVO ASIGNADO:</p>");
		$.ajax({
			url:'gestion_all2.php',
			data:{t:30,cliente:$("#n_cliente_consola").val()},
			type:'post',
			success:function(data){
				$("#n_producto_cliente_consola").html("");
				$("#n_producto_cliente_consola").html(data);
			}
		});
	});
	
	$("#cerrar_ventana_grill_sin_fee").on('click',function(){
		$("#grilla_clientes_sin_fee").dialog("close");
	});
	
	
	$("#contactos_cliente").dialog({
	  autoOpen: false,
      height:x,
      width: ancho_por,
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 0.9,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	$("#nuevo_contacto_cliente").dialog({
	  autoOpen: false,
      height:x,
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

	  modal:true,
	  resizable: false
    });
	
	$("#n_contactos_cliente").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:25,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#n_cliente_contacto").html("");
				$("#n_cliente_contacto").html(data);
			}
		});
		$("#nuevo_contacto_cliente").dialog('open');		
	});
	
	$("#panel_opciones_negocacion").dialog({
	  autoOpen: false,
      height: "120",
      width: "350",
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
	  modal:true,
	  resizable: false
    });
	
	$("#panel_opciones_administracion").dialog({
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
	  modal:true,
	  resizable: false
    });
	
	$("#admin_cliente,#abrir_admin_cliente").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:25,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#cliente_producto").html("");
				$("#cliente_producto").html(data);
			}
		});
		$(".scroll").css({'overflow':'hidden'});
		$("#panel_opciones_administracion").dialog('open');
	});
	
	$("#cerrar_ventana_panel_admin").on('click',function(){
		$("#panel_opciones_administracion").dialog('close');
		$(".scroll").css({'overflow':'scroll'});
	});
	
	
	
	$("#abrir_panel_negociacion,#abrir_negociacion").on('click',function(){
		//$("#panel_opciones_negocacion").dialog('open');
		$.ajax({
			url:'gestion_all2.php',
			data:{t:25,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#listado_clientes_contrato,#b_nego_cliente_list,#b_cont_cliente_list").html("");
				$("#listado_clientes_contrato,#b_nego_cliente_list,#b_cont_cliente_list").html(data);
			}
		});
		$(".scroll").css({'overflow':'hidden'});
		$("#contratos_clientes").dialog("open");
	});
	
	/*abrir_contratos_n*/
	$("#cerrar_ventana_panel_negocacion").on('click',function(){
		$("#panel_opciones_negocacion").dialog('close');
	});
	
	$("#crear_n_contacto_cliente").on('click',function(){
		var cliente = $("#n_cliente_contacto").val();
		$.ajax({
			url:'gestion_all2.php',
			data:{t:47,name:$("#nombre_contactos").val(),cargo:$("#cargos").val(),email:$("#email").val(),
			phone:$("#phone").val(),celular:$("#celular").val(),mes:$("#mes").val(),dia:$("#dia").val(),
			clie:$("#n_cliente_contacto").val()},
			type:'post',
			success:function(data){
				$("#listado_cliente_contacto").val($("#n_cliente_contacto").val());
				$("#nuevo_contacto_cliente input").val("");
				$("#nuevo_contacto_cliente").dialog('close');
				$("#n_cliente_contacto").val("0");
				$("#n_cliente_contacto").val(cliente);
				alert("CONTACTO CREADO");
				$.ajax({
					url:'gestion_all2.php',
					data:{t:46,clie:$("#n_cliente_contacto").val()},
					type:'post',
					success:function(data){
						//$("#contenedor_contactos_x_cliente").html("");
						$("#contenedor_contactos_x_cliente").html(data);
					}
				});
			}
		});
	});
	
	$("#c_v_info_n_contactos_cliente,#cancelar_crear_n_contacto_cliente").on('click',function(){
		$("#nuevo_contacto_cliente input").val("");
		$("#nuevo_contacto_cliente").dialog('close');
	});
	
	$("#contactos_cliente_n_n,#contactos_cliente_n").on('click',function(){
		$(".scroll").css({"overflow-y":"hidden"});
		$.ajax({
			url:'gestion_all2.php',
			data:{t:25,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#listado_cliente_contacto").html("");
				$("#listado_cliente_contacto").html(data);
			}
		});
		$("#contactos_cliente").dialog('open');
	});
	
	$("#listado_cliente_contacto").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:46,clie:$("#listado_cliente_contacto").val()},
			type:'post',
			success:function(data){
				//$("#contenedor_contactos_x_cliente").html("");
				$("#contenedor_contactos_x_cliente").html(data);
			}
		});
	});
	
	$("#c_v_info_contactos_cliente").on('click',function(){
		$(".scroll").css({"overflow-y":"scroll"});
		$("#contactos_cliente").dialog('close');
	});
	
	
	$("#n_und_negocio_consola").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:33,und:$("#n_und_negocio_consola").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#n_und_depto_consola").html("");
				$("#n_und_depto_consola").html(data);
			}
		});
	});
	
	$("#n_und_depto_consola").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:42,depto:$("#n_und_depto_consola").val(),und:$("#n_und_negocio_consola").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#listado_personal_depto_sin_asignar").html("");
				$("#listado_personal_depto_sin_asignar").html(data);
			}
		});
	});
	
	$("#n_producto_cliente_consola").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:40,clie:$("#n_cliente_consola").val(),pro:$("#n_producto_cliente_consola").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#ejecutivo_asignado").html("");
				$("#ejecutivo_asignado").html(data);
			}
		});
		$.ajax({
			url:'gestion_all2.php',
			data:{t:41,clie:$("#n_cliente_consola").val(),pro:$("#n_producto_cliente_consola").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#cuadro_grilla_sin_fee_x").html("");
				$("#cuadro_grilla_sin_fee_x").html(data);
			}
		});
		
	});
	
	$("#mostrar_todos_clientes").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:21,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_info_clientes").html(data);
			}
		});
	});
	
	$(".ui-dialog-titlebar").hide();
});

function info_basica_cliente(){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:21,emp:$("#empresa_final").text()},
		type:'post',
		success:function(data){
			//$("#contenedor_info_clientes").html("");
			$("#contenedor_info_clientes").html(data);
		}
	});
}

function abrir_caudro_cliente(){
	info_basica_cliente();
	$.ajax({
		url:'gestion_all2.php',
		data:{t:4,emp:$("#empresa_final").text()},
		type:'post',
		success:function(data){
			$("#b_und_cliente").html("");
			$("#b_und_cliente").html(data);
		}
	});
	$("#informacion_basica_cliente").dialog('open');
}

function mostrar_informacion_detallada_cliente(x){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:22,emp:$("#empresa_final").text(),id:x},
		type:'post',
		success:function(data){
			$("#muestra_info_cliente").html("");
			$("#muestra_info_cliente").html(data);
			$("#muestra_info_cliente").dialog('open');
		}
	});
}

function cerrar_info_cliente(){
	$("#muestra_info_cliente").dialog('close');
}

function abrir_documentos_empleados(id){
	$.ajax({
			url:'gestion_all2.php',
			data:{t:23,emp:$("#empresa_final").text(),cliente:id},
			type:'post',
			success:function(data){
				$("#contenedor_documentos_clientes").html("");
				$("#contenedor_documentos_clientes").html(data);
			}
		});
	$("#documentos_cliente").dialog('open');
}

function abrir_contratos_empleados(){
	$.ajax({
			url:'gestion_all2.php',
			data:{t:27,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_contratos_clientes").html("");
				$("#contenedor_contratos_clientes").html(data);
			}
		});
}

function editar_estado_cliente(x,est){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:92,id:x,est:est,emp:$("#empresa_final").text()},
		type:'post',
		success:function(data){
			$("#contenedor_info_clientes").html(data);
		}
	});
}

function visualizar_documentos_cliente(id){
	
}

function mostrar_complemento_regimen(val){
	var valor = $('input:radio[name=edad]:checked').val();
	$("#"+val+" > #autor").show();
	$("#"+val+" > #rete_iva").show();
}

function editar_contacto_cliente(x){
	$("#nombre_c"+x).html("<input type = 'text' id = 'enombre_c"+x+"' value = '"+$("#nombre_c"+x).text()+"' class = 'entradas_bordes'/>");
	$("#cargo_c"+x).html("<input type = 'text' id = 'ecargo_c"+x+"' value = '"+$("#cargo_c"+x).text()+"' class = 'entradas_bordes'/>");
	$("#correo_c"+x).html("<input type = 'text' id = 'ecorreo_c"+x+"' value = '"+$("#correo_c"+x).text()+"' class = 'entradas_bordes'/>");
	$("#telefono_c"+x).html("<input type = 'text' id = 'etelefono_c"+x+"' value = '"+$("#telefono_c"+x).text()+"' class = 'entradas_bordes'/>");
	$("#celular_c"+x).html("<input type = 'text' id = 'ecelular_c"+x+"' value = '"+$("#celular_c"+x).text()+"' class = 'entradas_bordes'/>");
	$("#icono_editar"+x).html("<img src = '../images/iconos/ok_verde.png' width = '35px' onclick = 'update_contactos_cliente("+x+")'/>");
}
function update_contactos_cliente(x){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:119,id:x,nombre_c:$("#enombre_c"+x).val(),cargo_c:$("#ecargo_c"+x).val(),correo_c:$("#ecorreo_c"+x).val(),telefono_c:$("#etelefono_c"+x).val(),celular_c:$("#ecelular_c"+x).val()},
		type:'post',
		success:function(data){
			alert("DATOS DEL CONCTACTO MODIFICADO");
			$("#nombre_c"+x).html($("#enombre_c"+x).val());
			$("#cargo_c"+x).html($("#ecargo_c"+x).val());
			$("#correo_c"+x).html($("#ecorreo_c"+x).val());
			$("#telefono_c"+x).html($("#etelefono_c"+x).val());
			$("#celular_c"+x).html($("#ecelular_c"+x).val());
			$("#icono_editar"+x).html("<img src = '../images/iconos/icono_editar.png' width = '35px' onclick = 'editar_contacto_cliente("+x+")'/>");
		}
	});
}
function visualizar_informacion_cliente(id){
	$("#muestra_info_cliente").css({"background-color":"white"});
	$.ajax({
		url:'gestion_all2.php',
		data:{t:117,id:id,emp:$("#empresa_final").text()},
		type:'post',
		success:function(data){
			$("#muestra_info_cliente").html(data);
			$("#muestra_info_cliente").dialog('open');
		}
	});
}
function cerrar_ventana_info_por_cliente(){
	$("#muestra_info_cliente").dialog('close');
}
function editar_info_basica_cliente(id){
	$("#muestra_info_cliente").css({"background-color":"#E3E3E3"});
	$.ajax({
		url:'gestion_all2.php',
		data:{t:118,id:id,emp:$("#empresa_final").text()},
		type:'post',
		success:function(data){
			$("#muestra_info_cliente").html(data);
			//$("#muestra_info_cliente").dialog('open');
		}
	});
}
	function cambiar_pais_empresa(){
		var pais = $("#n_pais_empresax").val();
		$.ajax({
			url:'gestion_all.php',
			data:{p:pais,turno:6},
			type:'POST',
			success:function(data){
				$("#n_depto_empresax").html(data);
				$("#n_ciudad_empresax").val("");
			}
		});	
	}
	
	function limpiar_pais(x){
		cambiar_pais_empresa();
	}
	function cargar_ciudad(){
		var departamento = $("#n_depto_empresax").val();
		$.ajax({
			url:'gestion_all.php',
			data:{d:departamento,turno:7},
			type: 'POST',
			success:function(data){
				$("#n_ciudad_empresax").html(data);
			}
		});
	}
	
	function update_info_cliente(id){
		var check_empresa = [];
		$("input[name='empresasx[]']:checked").each(function() {
            check_empresa.push($(this).val());
        });
		var iniciales = [];
		$("input[name='inicialesx[]']").each(function(){
			if($(this).val() == ""){
				
			}else{
				iniciales.push($(this).val());
			}
        });
		if(iniciales.length == 0){
			iniciales.push("$#$#$#");
			check_empresa.push("$#$#$#");
			$.ajax({
				url:'gestion_all.php',
				data:{turno:14,pais:$("#n_pais_empresax").val(),depto:$("#n_depto_empresax").val(),ciudad:$("#n_ciudad_empresax").val(),nlegal:$("#e_nombre_legal_cliente").val(),ncomercial:$("#e_ncomercial_cliente").val(),phone:$("#e_phone_cliente").val()
				,direccion:$("#e_direccion_cliente").val(),nit_cliente:$("#e_nit_cliente").val(),check_empresa:check_empresa,iniciales:iniciales,id:id},
				type: 'POST',
				success:function(data){
					alert(data);
					visualizar_informacion_cliente(id);
				}
			});
		}else{
			$.ajax({
				url:'gestion_all.php',
				data:{turno:14,pais:$("#n_pais_empresax").val(),depto:$("#n_depto_empresax").val(),ciudad:$("#n_ciudad_empresax").val(),nlegal:$("#e_nombre_legal_cliente").val(),ncomercial:$("#e_ncomercial_cliente").val(),phone:$("#e_phone_cliente").val()
				,direccion:$("#e_direccion_cliente").val(),nit_cliente:$("#e_nit_cliente").val(),check_empresa:check_empresa,iniciales:iniciales,id:id},
				type: 'POST',
				success:function(data){
					alert(data);
					visualizar_informacion_cliente(id);
				}
			});
		}
		
	}
	function cambiar_estado_producto_cliente(id,estado){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:120,estado:estado,id:id},
			type:'post',
			success:function(data){
				alert("Estado Modificado");
				if(estado == 1){
					$("#imgestado"+id).html("<img src = '../images/iconos/activo.png' onclick = 'cambiar_estado_producto_cliente(" + id + ",1)'class = 'iconos_opciones'/>");
				}else{
					$("#imgestado"+id).html("<img src = '../images/iconos/inactivo.png' onclick = 'cambiar_estado_producto_cliente(" + id + ",1)'class = 'iconos_opciones'/>");
				}
				$("#contenedor_productos_cliente");
			}
		});
	}
	function update_nombre_producto_cliente(id){
		$("#nombre_producto"+id).html("<input type = 'text' id = 'nuevo_nombre_productox"+id+"' value = '"+$("#nombre_producto"+id).text()+"' onkeypress = 'guardar_enombre_producto_cliente(event,"+id+")'/>");
		//$("#valor_productox"+id).html("<input type = 'text' id = 'nuevo_nombre_productox"+id+"' value = '"+$("#valor_productox"+id).text()+"' onkeypress = 'guardar_enombre_producto_cliente(event,"+id+")'/>");
	}
	function guardar_enombre_producto_cliente(e,id){
		if(e.keyCode == 13){
			$.ajax({
				url:'gestion_all2.php',
				data:{t:121,nombre:$("#nuevo_nombre_productox"+id).val(),id:id},
				type:'post',
				success:function(data){
					alert("Nombre Modificado");
					$("#nombre_producto"+id).html($("#nuevo_nombre_productox"+id).val().toUpperCase());
				}
			});
		}
	}
	
	function validar_nit_cliente(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:140,nit:$("#nit").val()},
			type:'post',
			success:function(data){
				if(data == 1 || $("#nit").val().length == 0){
					$("#nit_verificar_cliente").text("ESTE NIT YA ESTÁ INGRESADO !!!");
					$("#nit_verificar_cliente").css({"color":"red"});
					$("#crear_cliente").css({"opacity":"0.5"});
				}else{
					$("#nit_verificar_cliente").text("").css({"color":"white"});
					//$("#crear_cliente").show();
					$("#crear_cliente").css({"opacity":"1"});
				}
			}
		});
	}