$(document).ready(function(){
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
					
	function nonWorkingDates(date){
		var day = date.getDay(), Sunday = 0, Monday = 1, Tuesday = 2, Wednesday = 3, Thursday = 4, Friday = 5, Saturday = 6;
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
	var ancho_x =$(window).width();
	var ancho_x = $(window).width();
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
		$(".contenedores_info_provee").css({'height':"300px","min-height":"300px"});
		$("#contenedor_opciones_admin").css({'height':"300px","min-height":"300px"});
	}else{
		$(".contenedores_info_provee").css({'height':alto_y_popup+'px',"min-height":"300px"});	
		$("#contenedor_opciones_admin").css({'height':alto_y_popup2+'px',"min-height":"300px"});	
	}
	$("#menu_grupo_tarifario,#menu_tarifario_tarifario,#menu_subgrupo_tarifario").css({"height":($("#contenedor_opciones_admin").height())+"px"});

	$("#informacion_basica").dialog({
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
	
	$("#abrir_info_basica,#abrir_info_basica_t").on('click',function(){
		$(".scroll").css({'overflow':'hidden'});
		abrir_proveedor_empresa();
	});
	
	$("#cerrar_ventana_informacion_basica").on('click',function(){
		$(".scroll").css({'overflow':'scroll'});
		$("#informacion_basica").dialog('close');
	});
	
	$("#documentos_proveedor,#ventana_proveedor_info").dialog({
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
	
	$("#cerrar_ventana_documentos_proveedor").on('click',function(){
		$("#documentos_proveedor").dialog('close');
	});
	
	$("#nuevo_documento_proveedor").dialog({
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
	
	$("#abrir_adicionar_nuevo_documento").on('click',function(){
		$("#nuevo_documento_proveedor").dialog('open');
	});
	
	$("#cerrar_ventana_n_documentos_proveedor,#cancelar_crear_doc_proveedor").on('click',function(){
		$("#nuevo_documento_proveedor").dialog('close');
	});
	
	$("#limpiar_arc_documento").on('click',function(){
		$("#doc_proveedor").val('');
	});
	
	$("#crear_doc_proveedor").on('click',function(){
		data =  new FormData();
		data.append("t",51);
		
		data.append("prov",$("#codigo_proveedor").text());
		
		var archivos = document.getElementById("doc_proveedor");
		var archivo = archivos.files;
		for(i=0; i<archivo.length; i++){
			data.append('name_archivo'+i,getCleanedString(archivo[i].name));	
			data.append('archivo'+i,archivo[i]);	
		}
		data.append("doc",$("#documento_proveedor").val());
		if($("#documento_proveedor").val() == 3){
			data.append("fecha_contrato",$("#fecha_contrato").val());
			data.append("fecha_firma_contrato",$("#fecha_firma_contrato").val());
			data.append("fecha_terminacion_contrato",$("#fecha_terminacion_contrato").val());
		}
		$.ajax({
			url:'gestion_all2.php',
			data:data,
			type:'post',
			contentType:false,
			processData:false,
			success:function(data){
				$("#doc_proveedor").val("");
				$("#nuevo_documento_proveedor").dialog('close');
				$("#contenedor_listado_documentos_proveedor").html("");
				$("#contenedor_listado_documentos_proveedor").html(data);
			}
		});
	});
	
	$("#form_nuevo_proveedor").dialog({
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
	
	$("#add_proveedor").on('click',function(){
		$("#form_nuevo_proveedor").dialog('open');
	});
	
	$("#cerrar_ventana_nuevo_proveedor,#cancelar_crear_proveedor").on('click',function(){
		$("#form_nuevo_proveedor input").val("");
		$("#form_nuevo_proveedor").dialog('close');
	});
	
	
	
	$("#crear_proveedor").on('click',function(){
		var nit = $("#n_nit_proveedor").val();
		var nlegal = $("#n_nlegal_proveedor").val();
		var ncomercial = $("#n_ncomercial_proveedor").val();
		var direccion = $("#n_direccion_proveedor").val();
		var telefono = $("#n_telefono_proveedor").val();
		var correo = $("#n_correo_proveedor").val();
		var pais = $("#n_pais_empresa").val();
		var depto = $("#n_departamento_empresa").val();
		var ciudad = $("#n_ciudad_empresa").val();
		var e_asoc = [];
		$("input[name='empresas[]']:checked").each(function() {
            e_asoc.push($(this).val());
        });
		if(e_asoc.length > 0){
			if(ciudad > 0){
				$.ajax({
					url:'gestion_all2.php',
					data:{
						nit:nit,
						nlegal:nlegal,
						ncomercial:ncomercial,
						direccion:direccion,
						telefono:telefono,
						correo:correo,
						pais:pais,
						depto:depto,
						ciudad:ciudad,
						e_asoc:e_asoc,
						t:52
					},
					type:'POST',
					success:function(data){
						alert("SE HA CREADO EL PROVEEDOR "+nlegal.toUpperCase());
						$("#n_nit_proveedor,#n_nlegal_proveedor,#n_ncomercial_proveedor,#n_direccion_proveedor,#n_telefono_proveedor,#n_correo_proveedor").val("");
						$("#form_nuevo_proveedor").dialog('close');
						$("#informacion_basica").dialog('close');
						abrir_proveedor_empresa();
					}
				});
			}else{
				alert("Usted debe seleccionar la ubicación del Proveedor.");
			}
		}else{
			alert("Usted debe seleccionar al menos una empresa !");
		}
	});
	
	$("#contactos_proveedor").dialog({
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
	
	$("#abrir_contactos_n,#abrir_contactos").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:54,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#listado_proveedores").html("");
				$("#listado_proveedores").html(data);
			}
		});
		$(".scroll").css({'overflow':'hidden'});
		$("#contactos_proveedor").dialog('open');
	});
	
	$("#cerrar_ventana_contactos_x_proveedor").on('click',function(){
		$(".scroll").css({'overflow':'scroll'});
		$("#contactos_proveedor").dialog('close');
	});
	
	$("#nuevo_contacto_proveedor").dialog({
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
	
	$("#abrir_adicionar_nuevo_contacto").on('click',function(){
		if($("#listado_proveedores").val() == 0){
			alert("DEBE SELECCIONAR UN PROVEEDOR !!!");
			$("#listado_proveedores").css({"border":"2px solid red"});
		}else{
			$("#listado_proveedores").css({"border":"0px"});
			$("#nuevo_contacto_proveedor").dialog('open');
		}
	});
	$("#cerrar_ventana_contactos_proveedor").on('click',function(){
		$(".scroll").css({'overflow':'scroll'});
		$("#acuerdo_tarifario").dialog('close');
	});
	$("#cerrar_ventana_n_contactos_proveedor,#cancelar_crear_contacto_proveedor").on('click',function(){
		$("#nuevo_contacto_proveedor").dialog('close');
	});
	
	$("#crear_contacto_proveedor").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:55,name:$("#nombre_contacto").val(),cargo:$("#cargo_contacto").val(),
			phone:$("#telefono_contacto").val(),cel:$("#celular_contacto").val(),correo:$("#correo_contacto").val(),
			mes:$("#mes_contacto").val(),dia:$("#dia_contacto").val(),pro:$("#listado_proveedores").val()},
			type:'post',
			success:function(data){
				$("#nuevo_contacto_proveedor").dialog('close');
				$("#nuevo_contacto_proveedor input").val("");
				$("#nuevo_contacto_proveedor select").val("0");
				alert("CONTACTO GUARDADO !!!");
				$("#contenedor_contactos_proveedor").html("");
				$("#contenedor_contactos_proveedor").html(data);
			}
		});		
	});
	
	$("#listado_proveedores").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:56,pro:$("#listado_proveedores").val()},
			type:'post',
			success:function(data){
				$("#contenedor_contactos_proveedor").html("");
				$("#contenedor_contactos_proveedor").html(data);
			}
		});
	});
	
	$("#acuerdo_tarifario").dialog({
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
	
	$("#abrir_acuerdos,#abrir_acuerdos_n").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:54,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#listado_proveedore").html("");
				$("#listado_proveedore").html(data);
			}
		});
		$(".scroll").css({'overflow':'hidden'});
		$("#acuerdo_tarifario").dialog('open');
	});
	
	$("#listado_proveedore").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:123,prov:$("#listado_proveedore").val()},
			type:'post',
			success:function(data){
				$("#contenedor_acuerdos_proveedor").html(data);
			}
		});
	});
	
	$("#contenedor_nuevo_acuerdo").dialog({
	  autoOpen: false,
      height: "400",
      width: "700",
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 1,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	$("#abrir_adicionar_nuevo_acuerdo").on('click',function(){
		$("#contenedor_nuevo_acuerdo").dialog('open');
	});
	
	$("#cancelar_crear_acuerdo_proveedor,#cerrar_ventana_auc_proveedor").on('click',function(){
		$("#contenedor_nuevo_acuerdo input").val("");
		$("#contenedor_nuevo_acuerdo").dialog('close');
	});
	
	$("#limpiar_acu_documento").on('click',function(){
		$("#acu_proveedor").val("");
	});
	
	$("#fecha_terminacion,#fecha_firma,#fecha_contrato,#fecha_firma_contrato,#fecha_terminacion_contrato").datepicker({ dateFormat: 'yy-mm-dd',beforeShowDay: nonWorkingDates,	numberOfMonths: 1,	minDate: '0',firstDay: 1});
	$("#documento_proveedor").on('change',function(){
		if($("#documento_proveedor").val() == 3){
			$(".contrato_confidencialidad").show();
		}else{
			$(".contrato_confidencialidad").hide();
		}
	});
	$("#crear_acuerdo_proveedor").on('click',function(){
		data = new FormData();
		var archivos = document.getElementById("doc_proveedor");
		var archivo = archivos.files;
		for(i=0; i<archivo.length; i++){
			data.append('archivo'+i,archivo[i]);	
		}
		
	});
	
	$("#b_name_proveedor").on('keyup',function(){
		var text = $("#b_name_proveedor").val();
		$.ajax({
			url:'gestion_all2.php',
			data:{t:141,text:text,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_informacion_basica_proveedores").html(data);
			}
		});
	});
	$("#b_nit_proveedor").on('keyup',function(){
		var text = $("#b_nit_proveedor").val();
		$.ajax({
			url:'gestion_all2.php',
			data:{t:142,text:text,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_informacion_basica_proveedores").html(data);
			}
		});
	});
	
	$("#add_grupos_tarifario").on('click',function(){
		$("#menu_grupo_tarifario").show();
		$("#menu_subgrupo_tarifario").hide();
		$("#menu_tarifario_tarifario").hide();
	});
	$("#add_subgrupos_tarifario").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:62},
			type:'post',
			success:function(data){
				$("#listado_grupos_tarifario").html(data);
			}
		});
		$("#menu_subgrupo_tarifario").show();
		$("#menu_grupo_tarifario").hide();
		$("#menu_tarifario_tarifario").hide();
	});
	$("#add_item_tarifario_item").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:62},
			type:'post',
			success:function(data){
				$("#listado_grupos_item_tarifario").html(data);
			}
		});
		
		$.ajax({
			url:'gestion_all2.php',
			data:{t:54,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#listado_proveedores_tarifario").html(data);
			}
		});
		$("#menu_tarifario_tarifario").show();
		$("#menu_subgrupo_tarifario").hide();
		$("#menu_grupo_tarifario").hide();
	});
	
	$("#listado_grupos_item_tarifario").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:124,grupo:$("#listado_grupos_item_tarifario").val()},
			type:'post',
			success:function(data){
				$("#listado_subgrupos_grupos_tarifario").html(data);
			}
		});
	});
	
	$("#crear_nuevo_itemgrupo").on('click',function(){
		formdata = new FormData(document.getElementById("nuevo_item_tarifario_form"));
		formdata.append("t",63);
		$.ajax({
			url:'gestion_all2.php',
			data:formdata,
			type:'post',
			contentType:false,
			processData:false,
			success:function(data){
				alert("ITEM CREADO");
				$("#nombre_item").val("");
				$("#valor_item").val("");
				$("#nuevo_item_tarifario").dialog('close');
			}
		});
	});
	$("#crear_nuevo_subgrupo").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:123,grupo:$("#listado_grupos_tarifario").val(),name:$("#nombre_subgrupo").val()},
			type:'post',
			success:function(data){
				alert("SUBGRUPO CREADO");
				$("#nombre_subgrupo").val("");
			}
		});
	});
	$("#crear_nuevo_grupo").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:61,grupo:$("#nombre_grupo").val()},
			type:'post',
			success:function(data){
				alert("GRUPO CREADO");
				$("#nombre_grupo").val("");
			}
		});
	});
	
	$("#nuevo_item_tarifario").dialog({
	  autoOpen: false,
      height: "500",
      width: "500",
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 1,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
    },
	  modal:true,
	  resizable: false
    });
	$("#abrir_adicionar_nuevo_item").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:62},
			type:'post',
			success:function(data){
				$("#grupos_item").html("");
				$("#grupos_item").html(data);
			}
		});
		$.ajax({
			url:'gestion_all2.php',
			data:{t:54,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#proveedor_item").html("");
				$("#proveedor_item").html(data);
			}
		});
		$("#nuevo_item_tarifario").dialog('open');
	});
	
	$("#cancelar_nuevo_item,#cerrar_ventana_item_tarifario").on('click',function(){
		$("#nombre_item").val("");
		$("#valor_item").val("");
		$("#nuevo_item_tarifario").dialog('close');
	});
	
	$("#crear_nuevo_item").on('click',function(){
		
	});
	$(".ui-dialog-titlebar").hide();
});

function visualizar_documentos_proveedor(x){
	$("#codigo_proveedor").text(x);
	$("#nombre_proveedor_documentos").text("");
	$("#nombre_proveedor_documentos").text($("#rsocial").val());
	$.ajax({
		url:'gestion_all2.php',
		data:{t:50,prov:x},
		type:'post',
		success:function(data){
			$("#contenedor_listado_documentos_proveedor").html("");
			$("#contenedor_listado_documentos_proveedor").html(data);
		}
	});
	$("#documentos_proveedor").dialog('open');
}

function abrir_proveedor_empresa(){
	$.ajax({
			url:'gestion_all2.php',
			data:{t:49,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_informacion_basica_proveedores").html("");
				$("#contenedor_informacion_basica_proveedores").html(data);
			}
		});
		$("#informacion_basica").dialog('open');
		$(".scroll").css({'overflow':'hidden'});
}

function cambiar_estado_proveedor(x){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:53,id:x},
		type:'post',
		success:function(data){
			alert("ESTADO DEL PROVEEDOR MODIFICADO");
			$("#informacion_basica").dialog('close');
			abrir_proveedor_empresa();
		}
	});
}

function editar_contacto_proveedor(x){
	$("#cname"+x).html("<input type = 'text' class = 'entradas_bordes' id = 'ecname"+x+"' value = '"+$("#cname"+x).text()+"'/>");
	$("#ccargo"+x).html("<input type = 'text' id = 'eccargo"+x+"' value = '"+$("#ccargo"+x).text()+"'/>");
	$("#cphone"+x).html("<input type = 'text' id = 'ecphone"+x+"' value = '"+$("#cphone"+x).text()+"'/>");
	$("#ccelular"+x).html("<input type = 'text' id = 'eccelular"+x+"' value = '"+$("#ccelular"+x).text()+"'/>");
	$("#ccorreo"+x).html("<input type = 'text' id = 'eccorreo"+x+"' value = '"+$("#ccorreo"+x).text()+"'/>");
	$("#icono_editar"+x).html("<img src = '../images/iconos/guardar_1.png' class = 'botones_opciones mano' onclick = 'update_contactos_proveedor("+x+")'/>");
}

function update_contactos_proveedor(x){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:122,id:x,nombre_c:$("#ecname"+x).val(),cargo_c:$("#eccargo"+x).val(),correo_c:$("#eccorreo"+x).val(),telefono_c:$("#ecphone"+x).val(),celular_c:$("#eccelular"+x).val()},
		type:'post',
		success:function(data){
			alert("Contacto Actualizado");
			$("#cname"+x).html($("#ecname"+x).val());
			$("#ccargo"+x).html($("#eccargo"+x).val());
			$("#ccorreo"+x).html($("#eccorreo"+x).val());
			$("#cphone"+x).html($("#ecphone"+x).val());
			$("#ccelular"+x).html($("#eccelular"+x).val());
			$("#icono_editar"+x).html("<img src = '../images/iconos/icono_editar.png' class = 'botones_opciones mano' onclick = 'editar_contacto_proveedor("+x+")'/>");
		}
	});
}

function ver_info_proveedor(id){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:143,id:id,emp:$("#empresa_final").text()},
		type:'post',
		success:function(data){
			$("#ventana_proveedor_info").html(data);
			$("#ventana_proveedor_info").dialog('open');
		}
	});
}
function editar_info_proveedor_v(id){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:144,id:id,emp:$("#empresa_final").text()},
		type:'post',
		success:function(data){
			$("#ventana_proveedor_info").html(data);
			
		}
	});
}
function cerrar_ventana_info_d(){
	$("#ventana_proveedor_info").dialog('close');
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
function modificar_informacion_proveedor(id){
	dat = new FormData(document.getElementById("form_actualiza_proveedor"));
	dat.append("turno",27);
	dat.append("id",id);
	$.ajax({
		url:'gestion_all.php',
		data:dat,
		type:'post',
		contentType:false,
		processData:false,
		success:function(data){
			alert("DATOS DEL PROVEEDOR MODIFICADO");
		}
	});
	$.ajax({
		url:'gestion_all2.php',
		data:{t:143,id:id,emp:$("#empresa_final").text()},
		type:'post',
		success:function(data){
			$("#ventana_proveedor_info").html(data);
		}
	});
}
function resaltar_imagen_seleccionada(id){
		$(".img_menu_desplieg").css({"filter":"alpha(opacity=50)","-moz-opacity":"0.5","-webkit-opacity":"0.5","opacity":"0.5"});
		$("#"+id).css({"filter":"alpha(opacity=100)","-moz-opacity":"1","-webkit-opacity":"1","opacity":"1"});
	}