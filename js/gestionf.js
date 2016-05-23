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


var restaFechas = function(f1,f2){
	 var aFecha1 = f1.split('/'); 
	 var aFecha2 = f2.split('/'); 
	 var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
	 var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]); 
	 var dif = fFecha2 - fFecha1;
	 var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
	 return dias;
 }

 var periodo_nomina = "";

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
	$(".contenedor_num_hijos").hide();
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
	$( "#tabs" ).tabs();
	var alto = $(window).height();
	var ancho_x = $(window).width();
	var ancho_por = (ancho_x*100)/100;
	var ancho_por2 = (ancho_x*99)/100;
	var x = (alto*100)/100;
	var alto_h = (alto*60)/100;
	
	var alto_hh = (alto*99)/100;
	var alto_hhh = (alto*35)/100;
	
	$("#fi_vacaciones,#ff_vacaciones").datepicker({ dateFormat: 'yy-mm-dd',beforeShowDay: nonWorkingDates,	numberOfMonths: 1,	minDate: '0',firstDay: 1 });
	$("#fn0,#fn1,#fn2,#fn3,#fn4,#fn5").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true,yearRange: '-100:+0'});
	
	
	
	var alto_menu_financiero = $(window).height();
	var ancho_menu_izquierda = $("#izquierda_panel_cf").width();
	var ancho_ancho_img = ($("#izquierda_panel_cf").width()*72)/100;
	$(".img_menu_desplieg").css({'width':ancho_ancho_img});
	alto_menu_financiero = (alto_menu_financiero*70)/100;
	//alto_menu_financiero2 = (alto_menu_financiero*)/100;
	$("#contenedor_opciones,#contenedor_opciones_admin,#panel_opciones").css({'height':alto_menu_financiero,"overflow":"scroll"});
	var ancho_cuadro = $( "#panel_opciones_financiero" ).width();
	var alto_cuadro = $( "#contenedor_opciones" ).height();
	
	var alto_h2 = (alto_cuadro*80)/100;
	var ancho = (ancho_cuadro*55)/100;
	$("#contenedor_opciones,#contenedor_opciones_admin").css({'width':ancho});
	
	
	
	/*DOCUMENTOS*/
	$("#simulador_costo_nuevo_empleado").dialog({
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
	$("#documentos_legales_empresa").dialog({
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
	
	$("#abrir_ventana_documentos").on('click',function(){
		$("#documentos_legales_empresa").dialog('open');
	});
	
	$("#limpiar_documentos").on('click',function(){
		$("#archivo_documento").val("");
	});
	
	$("#ventana_documentos").on('click',function(){
		$(".scroll").css({"overflow-y":"hidden"});
		$.ajax({
			url:'gestion_all2.php',
			data:{t:43,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#info_basica_empresa").html("");
				$("#info_basica_empresa").html(data);
			}
		});
		$("#info_basica_empresa").dialog('open');
		//$("#documentos_legales_empresa").dialog('open');
	});
	
	
	
	$("#cerrar_ventana_documentos").on('click',function(){
		$("#documentos_legales_empresa").dialog('close');
	});
	
	$("#panel_opciones_financiero,#opciones_administracion").dialog({
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
	
	$("#ventana_reportar_novedad_vacaciones").dialog({
	  autoOpen: false,
      height: "auto",
      width: "800",
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
	
	$("#reportar_novedad_vacaciones").on('click',function(){
		$("#ventana_reportar_novedad_vacaciones").dialog('open');
	});
	$("#cerrar_ventana_rvacaciones,#cancelar_reportar_novedad_vacaciones_empleado").on('click',function(){
		$("#ventana_reportar_novedad_vacaciones").dialog('close');
	});
	
	$("#crear_vacaciones_reporte_empleado").on('click',function(){
		if($("#ff_vacaciones").val() == "" || $("#fi_vacaciones").val() == ""){
			alert("LOS CAMPOS CON (*) SON DE CARACTER OBLIGATORIO");
		}else{
			$.ajax({
				url:'gestion_all2.php',
				data:{t:98,fi:$("#fri_vacaciones").text(),ff:$("#frf_vacaciones").text(),doc:$("#listado_empleados_empresa_x").val(),tipo:$("#tipo_novedad").val()},
				type:'post',
				success:function(data){
					alert("SE HA GUARDADO LA NOVEDAD");
					$("#ventana_reportar_novedad_vacaciones").dialog('close');
				}
			});
		}
	});
	
	
	
	$("#fi_vacaciones").on('change',function(){
		var date = $("#fi_vacaciones").val();
		$("#fri_vacaciones").text(date);
		date = date.split("-");
		$("#fi_vacaciones").val(monthNames[parseFloat(date[1])-1]+"-"+date[2]+"-"+date[0]);
	});
	
	$("#ff_vacaciones").on('change',function(){
		var date = $("#ff_vacaciones").val();
		$("#frf_vacaciones").text(date);
		date = date.split("-");
		$("#ff_vacaciones").val(monthNames[parseFloat(date[1])-1]+"-"+date[2]+"-"+date[0]);
	});
	
	
	$("#b_tipo_documento").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:82,tipo:$("#b_tipo_documento").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_documentos_x_empresa").html(data);
			}
		});
	});
	
	$("#financiero").on('click',function(){
		//$(".scroll").css({"overflow":"none"});
		$(".scroll").css({"overflow-y":"hidden"});
		$("#panel_opciones_financiero").dialog('open');
		$("#crea_nomina_mes,#consultar_nomina").hide();
		$("#admin_ppto").hide();
	});
	
	$("#cerrar_ventana_panel_financiero").on('click',function(){
		$("#panel_opciones_financiero").dialog('close');
	});
	
	/*EMPLEADOS*/
	$("#opciones_empleados").dialog({
	  autoOpen: false,
      height: "120",
      width: "620",
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 0.7,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
    },
	  modal:true,
	  resizable: false
    });

   
	
	$("#crear_item_tecnologia").dialog({
      autoOpen: false,
      height: "600",
      width: "920",
	  resizable: false
    });
	
	$("#datos_crear_empresa_gestion").dialog({
      autoOpen: false,
      height: "600",
      width: "900",
	  resizable: false
    });
	$("#notifico_a").dialog({
      autoOpen: false,
      height: "600",
      width: "900",
	  resizable: false
    });
	
	$("#datos_modificar_empresa_gestion").dialog({
      autoOpen: false,
      height: "800",
      width: "900",
	  resizable: false
    });
	$("#form_nuevo_documento").dialog({
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
	
	$("#cerrar_ventana_form_empleados").on('click',function(){
		$("#form_nuevo_empleado input").val("");
		$("#foto").html("");
		$("#form_nuevo_empleado").dialog('close');
		
	});
	
	$("#datos_empleados_empresa").dialog({
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
	$("#info_basica_empleado,#form_nuevo_empleado").dialog({
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
	
	
	$("#personal_down_empleados").dialog({
	  autoOpen: false,
      height: x,
      width: "90%",
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 0.999,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	$("#foto_empleado").on('change',function(){
		data =  new FormData();
		var archivos = document.getElementById("foto_empleado");
		var archivo = archivos.files;
		for(i=0; i<archivo.length; i++){
			data.append('empleado_foto'+i,archivo[i]);	
		}
		data.append('t',68);
		$.ajax({
			url:'gestion_all2.php',
			data:data,
			type:'post',
			contentType:false,
			processData:false,
			success:function(data){
				$("#foto").html("");
				$("#foto").html(data);
			}
		});
	});
	
	
	$("#limpiar_foto_empleado").on('click',function(){
		$("#foto_empleado").val("");
		$("#foto").html("");
	});
	
	
	
	
	$("#cerrar_ventana_personal_down").on('click',function(){
		$("#personal_down_empleados").dialog('close');
	});
	
	$("#nuevo_usuario").dialog({
	  autoOpen: false,
      height: 250,
      width: "40%",
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 0.999,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	$("#b_nombre_empleado").on('keyup',function(){
		var nombre = $("#b_nombre_empleado").val();
		var cedula = $("#b_cedula_empleado").val();
		var und = $("#und_filtro_empleado").val();
		var depto = $("#depto_filtro_empleado").val();
		var empresa = $("#empresa_final").text();
		var estado = $('#estado_empleados').val();
		$("#link_impresion_empleados_pdf").attr("href", "generar_pdf_listado_empleados.php?n="+nombre+"&c="+cedula+"&u="+und+"&d="+depto+"&ee="+empresa+"&e="+estado+"");
		$.ajax({
			url:'gestion_all2.php',
			data:{t:69,name:$("#b_nombre_empleado").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedo_tabla_muestra_empleados").html("");
				$("#contenedo_tabla_muestra_empleados").html(data);
			}
		});
	});
	
	$("#nuevo_usuario_empleado").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:48,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#empleado_usuario").html("");
				$("#empleado_usuario").html(data);
			}
		});
		$(".scroll").css({"overflow-y":"hidden"});
		$("#nuevo_usuario").dialog('open');
	});
	
	$("#ventana_hvida_empleados").dialog({
	  autoOpen: false,
      height: x,
      width: "70%",
	  resizable: false
    });
	
	$("#nomina_detallado_empleado").dialog({
	  autoOpen: false,
      height: x,
      width: "50%",
	  resizable: false
    });
	
	$("#usuarios_empleados").dialog({
	  autoOpen: false,
      height:"600",
      width: "auto",
	  resizable: false
    });
	
	$("#listado_empleado_nomina_crear").dialog({
	  autoOpen: false,
      height: "300",
      width: "550",
	  resizable: false
    });
	
	$("#seleccionar_periodo_nomina").dialog({
	  autoOpen: false,
      height: "250",
      width: "400",
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 0.8,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
    },
	  modal:true,
	  resizable: false
    });
	
		
	$("#administracion").on('click',function(){
		$(".scroll").css({"overflow-y":"hidden"});
		$("#opciones_administracion").dialog('open');
	});
	$("#cerrar_administracion").on('click',function(){
		$("#opciones_administracion").dialog('close');
	});
	
	
	$("#unidad_negocio").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:5,und:$("#unidad_negocio").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_departamentos_empresa").html("");
				$("#contenedor_departamentos_empresa").html(data);
			}
		});
	});
		
	
	$("#panel_opciones_nomina").dialog({
	  autoOpen: false,
      height: "150",
      width: "auto",
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 0.8,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	$("#guardar_periodo_seleccionado").on('click',function(){
		var periodo = $("#periodo_nomina").val();
		
		$.ajax({
			url:'gestion_all.php',
			data:{turno:71,periodo:periodo},
			type:'post',
			success:function(data){
				$("#seleccionar_periodo_nomina").dialog('close');
				$(".scroll").css({"overflow-y":"hidden"});
				$("#panel_opciones_nomina").dialog('open');
			}
		});
		
	});
	
	$("#cerrar_ventana_panel_nomina").on('click',function(){
		$("#panel_opciones_nomina").dialog('close');
	});
	
	$("#consulta_nomina_periodos").on('click',function(){
		$(".scroll").css({"overflow-y":"hidden"});
		$("#seleccionar_periodo_nomina").dialog('open');
	});
	
	$("#consulta_nomina_periodos").on('click',function(){
		$.ajax({
			url:'gestion_all.php',
			data:{turno:78,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#periodo_nomina").html("");
				$("#periodo_nomina").html(data);
			}
		});
		$(".scroll").css({"overflow-y":"hidden"});
		$("#seleccionar_periodo_nomina").dialog('open');
	});
	$("#cerrar_ventana_periodo").on('click',function(){
		$("#seleccionar_periodo_nomina").dialog('close');
	});
	
	$("#crear_nomina_mes").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:4,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#unidad_negocio_c_nomina").html("");
				$("#unidad_negocio_c_nomina").html(data);
			}
		});
		$(".scroll").css({"overflow-y":"hidden"});
		$("#listado_empleado_nomina_crear").dialog('open');
	});
	
	
	
	
	$("#cerrar_ventana_empleados_crear").on('click',function(){
		$("#listado_empleado_nomina_crear").dialog('close');
	});
	
	$("#usuarios_x_empresa").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:134,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones_admin").html(data);
			}
		});
		//$("#usuarios_empleados").dialog('open');
	});
	
	$("#cerrar_ventana_usuarios_n_empleados").on('click',function(){
		$("#nuevo_usuario").dialog('close');
	});
	$("#cerrar_ventana_usuarios_empleados").on('click',function(){
		$("#usuarios_empleados").dialog('close');
	});
	$("#mostrar_datos_hj").on('click',function(){
		$("#contenedor_hojas_vida_empleados").html("");
		$("#listado_empleados_empresa").html("");
		$.ajax({
			url:'gestion_all2.php',
			data:{t:9,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#und_hj_empleado").html("");
				$("#und_hj_empleado").html(data);
			}
		});
		$(".scroll").css({"overflow-y":"hidden"});
		$("#ventana_hvida_empleados").dialog('open');
	});
	
	$("#und_hj_empleado").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:8,emp:$("#empresa_final").text(),und:$("#und_hj_empleado").val()},
			type:'post',
			success:function(data){
				$("#listado_empleados_empresa").html("");
				$("#listado_empleados_empresa").html(data);
			}
		});
	});
	
	$("#cerrar_ventana_hj_empleados").on('click',function(){
		$("#ventana_hvida_empleados").dialog('close');
	});
	
	$("#mostrar_nomina_detallado").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:9,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#und_nomina_detallado").html("");
				$("#und_nomina_detallado").html(data);
			}
		});
		$(".scroll").css({"overflow-y":"hidden"});
		$("#nomina_detallado_empleado").dialog('open');
	});
	$("#und_nomina_detallado").on('change',function(){
		$("#contenedor_nomina_detallado").html("");
		$.ajax({
			url:'gestion_all.php',
			data:{turno:74,emp:$("#empresa_final").text(),und:$("#und_nomina_detallado").val()},
			type:'post',
			success:function(data){
				$("#contenedor_nomina_detallado").html("");
				$("#contenedor_nomina_detallado").html(data);
			}
		});
	});
	
	$("#cerrar_ventana_nomina_detallado").on('click',function(){
		$("#nomina_detallado_empleado").dialog('close');
	});
	
	$("#abrir_nomina").on('click',function(){
		$(".scroll").css({"overflow-y":"hidden"});
		$("#opciones_empleados").dialog('open');
	});
	$("#cerrar_ventana_opciones_empleados").on('click',function(){
		$("#opciones_empleados").dialog('close');
	});
	
	$("#ventana_empleados").on('click',function(){
		$("body").css({"overflow":"hidden"});
		
		$.ajax({
			url:'gestion_all2.php',
			data:{t:58,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#und_filtro_empleado").html("");
				$("#und_filtro_empleado").html(data);
			}
		});
		$.ajax({
			url:'gestion_all.php',
			data:{turno:65,emp:$("#empresa_final").text(),alto:x},
			type:'post',
			success:function(data){
				$("#contenedo_tabla_muestra_empleados").html(data);
			}
		});
		$(".scroll").css({"overflow-y":"hidden"});
		$("#datos_empleados_empresa").dialog('open');
		var alto_popup = $("#datos_empleados_empresa").height();
		var alto_y_popup = (alto_popup*65)/100;
		if($(window).height() < 800){
			$("#contenedor_documentos_x_empresa").css({'height':"300px","min-height":"300px"});
			$("#contenedo_tabla_muestra_empleados").css({'height':"300px","min-height":"300px"});
			$("#listado_simulaciones").css({'height':"300px","min-height":"300px"});	
		}else{
			$("#contenedo_tabla_muestra_empleados").css({'height':alto_y_popup,"min-height":"300px"});
			$("#listado_simulaciones").css({'height':alto_y_popup,"min-height":"300px"});	
			$("#contenedor_documentos_x_empresa").css({'height':alto_y_popup,"min-height":"300px"});
		}
		
		
		
	});
	
	$("#pestana_sim").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:87,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#listado_simulaciones").html("");
				$("#listado_simulaciones").html(data);
			}
		});
	});
	
	$("#b_nombre_simulador").on('keyup',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:88,emp:$("#empresa_final").text(),name:$("#b_nombre_simulador").val()},
			type:'post',
			success:function(data){
				$("#listado_simulaciones").html("");
				$("#listado_simulaciones").html(data);
			}
		});
	});
	$("#und_filtro_empleado").on('change',function(){
		var nombre = $("#b_nombre_empleado").val();
		var cedula = $("#b_cedula_empleado").val();
		var und = $("#und_filtro_empleado").val();
		var depto = $("#depto_filtro_empleado").val();
		var empresa = $("#empresa_final").text();
		var estado = $('#estado_empleados').val();
		$("#link_impresion_empleados_pdf").attr("href", "generar_pdf_listado_empleados.php?n="+nombre+"&c="+cedula+"&u="+und+"&d="+depto+"&ee="+empresa+"&e="+estado+"");
		$.ajax({
			url:'gestion_all2.php',
			data:{t:59,emp:$("#empresa_final").text(),und:$("#und_filtro_empleado").val()},
			type:'post',
			success:function(data){
				$("#contenedo_tabla_muestra_empleados").html("");
				$("#contenedo_tabla_muestra_empleados").html(data);
			}
		});
		$.ajax({
			url:'gestion_all2.php',
			data:{t:33,emp:$("#empresa_final").text(),und:$("#und_filtro_empleado").val()},
			type:'post',
			success:function(data){
				$("#depto_filtro_empleado").html("");
				$("#depto_filtro_empleado").html(data);
			}
		});
	});
	
	$("#depto_filtro_empleado").on('change',function(){
		var nombre = $("#b_nombre_empleado").val();
		var cedula = $("#b_cedula_empleado").val();
		var und = $("#und_filtro_empleado").val();
		var depto = $("#depto_filtro_empleado").val();
		var empresa = $("#empresa_final").text();
		var estado = $('#estado_empleados').val();
		$("#link_impresion_empleados_pdf").attr("href", "generar_pdf_listado_empleados.php?n="+nombre+"&c="+cedula+"&u="+und+"&d="+depto+"&ee="+empresa+"&e="+estado+"");
		
		$.ajax({
			url:'gestion_all2.php',
			data:{t:60,emp:$("#empresa_final").text(),und:$("#und_filtro_empleado").val(),depto:$("#depto_filtro_empleado").val()},
			type:'post',
			success:function(data){
				$("#contenedo_tabla_muestra_empleados").html("");
				$("#contenedo_tabla_muestra_empleados").html(data);
			}
		});
	});
	
	$("#cerrar_ventana_datos_empleados").on('click',function(){
		$(".scroll").css({"overflow-y":"scroll"});
		$("#datos_empleados_empresa").dialog('close');
	});
	$("#mostrar_all_empleados").on('click',function(){
		$("#tabs-1 .barra_busqueda input[type=radio]").prop('checked', false); 
		$.ajax({
			url:'gestion_all.php',
			data:{turno:65,emp:$("#empresa_final").text(),alto:x},
			type:'post',
			success:function(data){
				$("#contenedo_tabla_muestra_empleados").html("");
				$("#contenedo_tabla_muestra_empleados").html(data);
			}
		});
	});
	
	$("#b_cedula_empleado").on('keyup',function(){
		var nombre = $("#b_nombre_empleado").val();
		var cedula = $("#b_cedula_empleado").val();
		var und = $("#und_filtro_empleado").val();
		var depto = $("#depto_filtro_empleado").val();
		var empresa = $("#empresa_final").text();
		var estado = $('#estado_empleados').val();
		$("#link_impresion_empleados_pdf").attr("href", "generar_pdf_listado_empleados.php?n="+nombre+"&c="+cedula+"&u="+und+"&d="+depto+"&ee="+empresa+"&e="+estado+"");
		var c = $("#b_cedula_empleado").val();
		var emp = $("#empresa_final").text();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:66,c:c,emp:emp},
			type:'post',
			success:function(data){
				$("#contenedo_tabla_muestra_empleados").html("");
				$("#contenedo_tabla_muestra_empleados").html(data);
			}
		});
	});
	
	$("#listado_empleados_empresa").on('change',function(){
		var e = $("#listado_empleados_empresa").val();
		var emp = $("#empresa_final").text();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:67,c:e,emp:emp},
			type:'post',
			success:function(data){
				$("#contenedor_hojas_vida_empleados").html("");
				$("#contenedor_hojas_vida_empleados").html(data);
			}
		});
	});
	
	$("#n_usuario").on('click',function(){
		var nick = $("#nickname").val();
		var e = $("#empleado_usuario").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:68,e:e,nick:nick},
			type:'post',
			success:function(data){
				alert("USUARIO CREADO");
				location.reload();
				
			}
		});
	});
	
	
	$("#crear_n_item_ppto").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:45,grupo:$("#grupos_ppto").val(),name:$("#name_nuevo_item").val(),valor:$("#valor_item_nuevo_ppto").val(),
			und:$("#und_ppto_consolidado").val(),ppto:$("#num_ppto_und").val()},
			type:'post',
			success:function(data){
				$("#contenedor_ppto_general_x_und").html("");
				$("#contenedor_ppto_general_x_und").html(data);
			}
		});
	});
	
	$("#contenedor_ppto_general").dialog({
	  autoOpen: false,
      height: '700',
      width: "95%",
	  resizable: false
    });
	
	
	
	$("#cerrar_ventana_ppto_general").on('click',function(){
		$("#contenedor_ppto_general").dialog('close');
	});
	
	
	$("#crear_ppto").dialog({
	  autoOpen: false,
      height: "220",
      width: "auto",
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 0.8,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	$("#crear_ppto_x_unidad").on('click',function(){
		alert("RECUERDE QUE SOLO SE PUEDE CREAR UN PPTO POR AÑO");
		$.ajax({
			url:'gestion_all2.php',
			data:{t:4,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#und_ppto_crear").html("");
				$("#und_ppto_crear").html(data);
			}
		});
		$(".scroll").css({"overflow-y":"hidden"});
		$("#crear_ppto").dialog('open');
	});
	$("#cerrar_ventana_new_ppto_general,#c_cancelar_crear_ppto").on('click',function(){
		$("#crear_ppto").dialog('close');
	});
		
	
	$("#und_grupos_item").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:13,und:$("#und_grupos_item").val()},
			type:'post',
			success:function(data){
				$("#grupos_und").html("");
				$("#grupos_und").html(data);
			}
		});
	});
		
	
	$("#und_grupos_item_a").on('change',function(){
		$("#contenedor_items_add_ppto").html("");
		$.ajax({
			url:'gestion_all2.php',
			data:{t:13,und:$("#und_grupos_item_a").val()},
			type:'post',
			success:function(data){
				$("#grupos_und_a").html("");
				$("#grupos_und_a").html(data);
			}
		});
	});
	
	$("#grupos_und_a").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:15,grupo:$("#grupos_und_a").val(),und:$("#und_grupos_item_a").val()},
			type:'post',
			success:function(data){
				var da = data.split("$$$$");
				$("#contenedor_items_add_ppto").html("");
				$("#contenedor_items_add_ppto").html(da[0]);
				$("#codigo_ppto_general").html("");
				$("#codigo_ppto_general").html(da[1]);
			}
		});
	});
		
	$("#ventana_permisos_usuarios").dialog({
	  autoOpen: false,
      height: "150",
      width: "auto",
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 0.8,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	$("#abrir_permisos_usuarios_n,#abrir_permisos_usuarios").on('click',function(){
		$(".scroll").css({"overflow-y":"hidden"});
		$("#ventana_permisos_usuarios").dialog('open');
	});
	$("#cerrar_ventana_permisos").on('click',function(){
		$("#ventana_permisos_usuarios").dialog('close');
	});
	
	$("#consola_cuentas").dialog({
	  autoOpen: false,
      height: "500",
      width: "auto",
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 0.8,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	$("#abrir_consola_cuentas").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:25,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#cliente_consola").html("");
				$("#cliente_consola").html(data);
			}
		});
		$.ajax({
			url:'gestion_all2.php',
			data:{t:16,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#und_negocio_consola").html("");
				$("#und_negocio_consola").html(data);
			}
		});
		$("#consola_cuentas").dialog('open');
	});
	
	$("#cliente_consola").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:30,cliente:$("#cliente_consola").val()},
			type:'post',
			success:function(data){
				$("#producto_cliente_consola").html("");
				$("#producto_cliente_consola").html(data);
			}
		});
	});
	
	$("#und_negocio_consola").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:33,und:$("#und_negocio_consola").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#und_depto_consola").html("");
				$("#und_depto_consola").html(data);
			}
		});
	});
	
	$("#und_depto_consola").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:34,depto:$("#und_depto_consola").val(),und:$("#und_negocio_consola").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#und_empleado_consola").html("");
				$("#und_empleado_consola").html(data);
			}
		});
	});
	
	$("#producto_cliente_consola").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:35,clie:$("#cliente_consola").val(),pro:$("#producto_cliente_consola").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_habilitados_cuenta").html("");
				$("#contenedor_habilitados_cuenta").html(data);
			}
		});
	});
	
	/*$("#und_empleado_consola").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:36,emple:$("#und_empleado_consola").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_habilitados_cuenta").html("");
				$("#contenedor_habilitados_cuenta").html(data);
			}
		});
	});*/
	
	$("#cerrar_ventana_consola_cuentas").on('click',function(){
		$("#consola_cuentas").dialog('close');
	});
	
	$("#n_cliente_consola").on('change',function(){
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
	
	$("#nueva_cuenta_asignar").dialog({
	  autoOpen: false,
      height: "370",
      width: "auto",
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 0.8,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	$("#agregar_cuenta_empleado").on('click',function(){
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
		$("#nueva_cuenta_asignar").dialog('open');
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
			data:{t:39,depto:$("#n_und_depto_consola").val(),und:$("#n_und_negocio_consola").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#n_und_empleado_consola").html("");
				$("#n_und_empleado_consola").html(data);
			}
		});
	});
	
	$("#cerrar_ventana_nueva_cuenta_asignar,#n_cancelar_c_cuenta").on('click',function(){
		$("#nueva_cuenta_asignar").dialog('close');
	});
	
	$("#n_guardar_c_cuenta").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:38,und:$("#n_und_negocio_consola").val(),depto:$("#n_und_depto_consola").val(),
			empleado:$("#n_und_empleado_consola").val(),clie:$("#n_cliente_consola").val(),pro:$("#n_producto_cliente_consola").val(),
			emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				alert(data);
				$("#nueva_cuenta_asignar select").val('0');
				$("#nueva_cuenta_asignar").dialog('close');
			}
		});
	});
	
	$("#info_basica_empresa").dialog({
	  autoOpen: false,
      height: x,
      width: ancho_por,
      resizable:true,
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
	
	$("#nota_op_produccion").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:130,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones_admin").html(data);
			}
		});
	});
	
	$("#cerrar_ventana_consola_cuentas").on('click',function(){
		//$("#info_basica_empresa").dialog('close');
	});
	
	
	
	$("#crea_nomina_mes").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:83,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones").html(data);
			}
		});
	});
	
	
	
	$("#cerrar_ventana_sme").on('click',function(){
		$("#simulador_costo_empleado_sistema").dialog('close');
	});
	
	$("#nomina_detallado_empleados,#modificar_info_empleado,#simulador_costo_empleado_sistema").dialog({
		autoOpen: false,
		height: x,
		width:ancho_por,
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
	
	$("#indepm_liqui_empleados,#ppto_general_empleados").dialog({
		autoOpen: false,
		height: x,
		width:ancho_por,
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
	
	$("#consultar_nomina").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:84,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones").html(data);
			}
		});
	});
	
	$("#admin_ppto").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:94,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones").html(data);
			}
		});
	});
	$("#consultar_ppto").on('click',function(){
		var alto = $("#contenedor_opciones").height();
		$.ajax({
			url:'gestion_all2.php',
			data:{t:107,emp:$("#empresa_final").text(),alto:alto},
			type:'post',
			success:function(data){
				$("#contenedor_opciones").html(data);
			}
		});
	});
	
	$("#respon_deptos").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:148,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones_admin").html(data);
			}
		});
	});
	$("#asignados_tareas").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:151,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones_admin").html(data);
			}
		});
	});
	
	$("#permisos_usuarios_empresas_p").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:158,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones_admin").html(data);
			}
		});
	});
	
	$("#permisos_director_usuario_p").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:160,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones_admin").html(data);
			}
		});
	});
	
	$("#permisos_clientes_p").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:156,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones_admin").html(data);
			}
		});
	});

	$("#min_valor_pptos").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:164,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones_admin").html(data);
			}
		});
	});
	
	$("#pl_negocio").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:167,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones_admin").html(data);
			}
		});
	});
	
	$("#cerrar_ventana_nde").on('click',function(){
		$("#contenedor_nde").html("");
		$("#nomina_detallado_empleados").dialog('close');
	});
	
	$("#cerrar_ventana_inlie").on('click',function(){
		$("#contenedor_inlie").html("");
		$("#indepm_liqui_empleados").dialog('close');
	});
	$("#cerrar_ventana_ppto_general_empleados").on('click',function(){
		$("#contenedor_ppto_general_empleados").html("");
		$("#ppto_general_empleados").dialog('close');
	});
	
	$(".ui-dialog-titlebar").hide();
	$(".ui-widget-overlay").css({
                position: 'fixed',
                top: '0'
            });

            //get the current popup position of the dialog box
            pos = $(".ui-dialog").position();

            //adjust the dialog box so that it scrolls as you scroll the page
            $(".ui-dialog").css({
                position: 'fixed'
            });
	$("#und_empleado").on('change',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:6,und:$("#und_empleado").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#departamento_empleado").html("");
				$("#departamento_empleado").html(data);
			}
		});
	});
	
	$("#nomina_detallado").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:71,emp:$("#empresa_final").text(),alto:alto_cuadro},
			type:'post',
			success:function(data){
				$("#contenedor_opciones").html("");
				$("#contenedor_opciones").html(data);
				$("#contenedor_hojas_vida_empleados_x").css({'height':alto_h2});
			}
		});
	});
	$("#personal_down").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:72,emp:$("#empresa_final").text(),alto:alto_cuadro},
			type:'post',
			success:function(data){
				$("#contenedor_opciones").html("");
				$("#contenedor_opciones").html(data);
				$("#contenedor_hojas_vida_empleados_x").css({'height':alto_h2});
			}
		});
	});
	
	
	$("#sal_minimo").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:99,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones_admin").html(data);
			}
		});
	});
	$("#sal_integral").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:101,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones_admin").html(data);
			}
		});
	});
	
	$("#aux_transporte").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:103,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones_admin").html(data);
			}
		});
	});
	
	$("#monetizacion_sena").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:105,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones_admin").html(data);
			}
		});
	});
	
	$("#und_empresa").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:108,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones_admin").html(data);
			}
		});
	});
	
	$("#departamentos_empresa").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:110,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones_admin").html(data);
			}
		});
	});
	
});
function function_abrir_panel_documentos(){
	$(".scroll").css({"overflow-y":"hidden"});
	$("#documentos_legales_empresa").dialog('open');
}
function eliminar_permiso_cuenta(x){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:37,id:x},
		type:'post',
		success:function(data){
			alert("PERMISO RETIRADO");
			$("#contenedor_list_asignados_usuario").html(data);
		}
	});
}


function mostrar_informacion_basica_empleado(x,y){
	$("#"+x).css({"border":"5px solid red"});
	$.ajax({
			url:'gestion_all.php',
			data:{turno:60,id:x,emp:y},
			type:'post',
			success:function(data){
				$("#info_basica_empleado").html(data);
				$(".scroll").css({"overflow-y":"hidden"});
				$("#info_basica_empleado").dialog('open');
			}
		});
		
}

function cerrar_info_basica_empleado(){
	$("#info_basica_empleado").dialog('close');
	
}
function cerrar_editar_empleado(x){
	$.ajax({
		url:'gestion_all.php',
		data:{turno:60,id:x},
		type:'post',
		success:function(data){
			$("#info_basica_empleado").html(data);
			$(".scroll").css({"overflow-y":"hidden"});
			$("#info_basica_empleado").dialog('open');
		}
	});
}
function editar_empleado_gestion(x){
	$.ajax({
		url:'gestion_all.php',
		data:{turno:63,id:x},
		type:'post',
		success:function(data){
			$("#info_basica_empleado").html(data);
		}
		
	});
}

function modificar_empleado(){
		data = new FormData();
		if($("#foto_empleado_x").val() == ""){
			data.append('foto',0);	
		}else{
			var file = $("#foto_empleado_x")[0].files[0];
			data.append('foto',1);	
			data.append('empleado_foto',file.name);	
		}
		
		data.append('cedula',$("#e_num_cedula_empleado").val());
		data.append('e_fecha_retiro_empleado',$("#e_fecha_retiro_empleado").val());
		data.append('e_motivo_retiro',$("#e_motivo_retiro").val());
		data.append('e_und',$("#e_und").val());
		data.append('e_departamento_empleado',$("#e_departamento_empleado").val());
		data.append('sexo',$('input:radio[name=sexox]:checked').val());
		data.append('e_correo_personal',$("#e_correo_personal").val());		
		data.append('name',$("#e_nombre_complet").val());
		data.append('cargo',$("#e_cargo_empleado").val());
		data.append('eps',$("#e_eps").val());
		data.append('arl',$("#e_arl").val());
		data.append('direc',$("#e_direccion_empleado").val());
		data.append('fpension',$("#e_fondo_pensiones").val());
		data.append('e_phone_casa',$("#e_phone_casa").val());
		data.append('e_fondo_cesantias',$("#e_fondo_cesantias").val());
		data.append('e_celular_empleado',$("#e_celular_empleado").val());
		data.append('e_caja_compensacion',$("#e_caja_compensacion").val());
		//data.append('e_salario_base_empleado',$("#e_salario_base_empleado").val());
		//data.append('e_bonos_alimentacion',$("#e_bonos_alimentacion").val());
		//data.append('e_bnp',$("#e_bnp").val());
		data.append('correo',$("#e_correo").val());
		//data.append('e_otros_salario',$("#e_otros_salario").val());
		data.append('turno',64);
		
		$.ajax({
			url:'gestion_all.php',
			data:data,
			type:'post',
			contentType:false,
			processData:false,
			success:function(data){
				alert("DATOS MODIFICADOS");
				$.ajax({
					url:'gestion_all.php',
					data:{turno:60,id:$("#e_num_cedula_empleado").val(),emp:$("#empresa_final").text()},
					type:'post',
					success:function(data){
						$("#info_basica_empleado").html(data);
						$(".scroll").css({"overflow-y":"hidden"});
						$("#info_basica_empleado").dialog('open');
					}
				});
			}
		});
		
		
		$("#barra_menu_al").on('click',function(){
			$(".barra_financiero").toggle();
		});
}

/*PPTO GENERAL FUNCTIONS*/
function editar_valor_mes(id,mes,ppto,id_ppto){
	var text = parseFloat($("#"+id+"-"+mes+"-h").text());
	$("#t"+"-"+id+"-"+mes).html("");
	$("#t"+"-"+id+"-"+mes).html("<input onkeypress = 'guardar_valor_mes(event,"+id+","+mes+","+ppto+","+id_ppto+")' type = 'text' id = 'valor_e_ppto' value = '"+text+"'/>");
}

function guardar_valor_mes(e,id,mes,ppto,id_ppto){
	if(e.keyCode == 13){
		var valor_mes = $("#valor_e_ppto").val();
		$.ajax({
				url:'gestion_all2.php',
				data:{t:129,und:$("#und_ppto_general_consulta").val()},
				type:'post',
				success:function(data){
					$("#und_negocio_ppto_general_texto").html(data);
				}
			});
		$.ajax({
			url:'gestion_all2.php',
			data:{t:10,v:valor_mes,id:id,mes:mes,ppto:ppto,und:$("#und_ppto_consolidado").val()},
			type:'post',
			success:function(data){
				if(valor_mes <= $("#pptado_mes"+id_ppto).text()){					
					$("#t"+"-"+id+"-"+mes).css({"background-color":"#35B324"});
				}else{
					$("#t"+"-"+id+"-"+mes).css({"background-color":"#FF0101"});
				}
				$("#t"+"-"+id+"-"+mes).html("<table width = '100%'><tr><td align = 'left'>$</td><td align = 'right'><span ondblclick='editar_valor_mes("+id+","+mes+","+ppto+","+id_ppto+")' >"+formatNumber.new(valor_mes)+"</span><span class = 'hidde' id = '"+id+"-"+mes+"-h'>"+valor_mes+"</span></td></tr></table>");
				/*$.ajax({
						url:'gestion_all2.php',
						data:{t:18,und:$("#und_ppto_general_consulta").val(),ppto:$("#ano_und_ppto_general_consulta").val(),periodo:$("#periodo_ppto_general").val()},
						type:'post',
						success:function(data){
							
							//$("#contenedor_ppto_general_empleados").html(data);
						}
					});
				*/
			}
		});		
	}
}

function cammbiar_dias_trabajo_empleado(x){
	var text = parseFloat($("#dias_sb").text());
	$("#editar_dias").html("");
	$("#editar_dias").html("<input onkeypress = 'guardar_dias_hoja_vida(event,"+x+")' type = 'text' id = 'dias_sb' value = '"+text+"'/>");
}

function guardar_dias_hoja_vida(e,x){
	if(e.keyCode == 13){
		var dias = $("#dias_sb").val();
		var empleado = $("#listado_empleados_empresa_x").val();
		var emp = $("#empresa_final").text();
		
		$.ajax({
			url:'gestion_all.php',
			data:{turno:73,d:dias,id:x,emple:empleado,emp:emp,periodo:$("#periodo_nomina_x").val()},
			type:'post',
			success:function(data){
				$("#contenedor_hj").html(data);
			}
		});
	}
}


//People Pass:
function cambiar_comision_people_pas(x){
	var text = $("#comi_people_h").text();
	$("#comision_people").html("");
	$("#comision_people").html("<input onkeypress = 'guardar_comision_people_pass(event,"+x+")' type = 'text' id = 'comi_people_h' value = '"+text+"'/>");
}

function guardar_comision_people_pass(e,x){
	if(e.keyCode == 13){
		var people = $("#comi_people_h").val();
		var emp = $("#empresa_final").text();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:75,p:people,id:x,emp:emp,und:$("#und_nomina_detallado_x").val(),periodo:$("#periodo_nomina_x").val()},
			type:'post',
			success:function(data){
				$("#contenedor_nde").html(data);
			}
		});
	}
}

//PACC
function cambiar_pacc(x){
	var text = $("#pacc_h").text();
	$("#c_pacc").html("");
	$("#c_pacc").html("<input onkeypress = 'guardar_pacc(event,"+x+")' type = 'text' id = 'pacc_h' value = '"+text+"'/>");
}

function guardar_pacc(e,x){
	if(e.keyCode == 13){
		var people = $("#pacc_h").val();
		var emp = $("#empresa_final").text();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:76,p:people,id:x,emp:emp,und:$("#und_nomina_detallado_x").val(),periodo:$("#periodo_nomina_x").val()},
			type:'post',
			success:function(data){
				$("#contenedor_nde").html(data);
			}
		});
	}
}


//Examenes
function cambiar_examenes(x){
	var text = $("#examenes_h").text();
	$("#exa").html("");
	$("#exa").html("<input onkeypress = 'guardar_examenes(event,"+x+")' type = 'text' id = 'examenes_h' value = '"+text+"'/>");
}

function guardar_examenes(e,x){
	if(e.keyCode == 13){
		var people = $("#examenes_h").val();
		var emp = $("#empresa_final").text();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:77,p:people,id:x,emp:emp,und:$("#und_nomina_detallado_x").val(),periodo:$("#periodo_nomina_x").val()},
			type:'post',
			success:function(data){
				$("#contenedor_nde").html(data);
			}
		});
	}
}

function editar_unidad_negociox(x){
	var nombre = $("#undxx"+x).text();
	$("#undxx"+x).html("<input type = 'text' value = '"+nombre+"' id = 'm_unidad_negocio_empresa' onkeypress = 'guardar_nuevo_nombre_und(event,"+x+")' />");
}
function guardar_nuevo_nombre_und(e,x){
	if(e.keyCode == 13){
		var nombre =$("#m_unidad_negocio_empresa").val();
		$.ajax({
			url:'gestion_all2.php',
			data:{t:2,name:$("#m_unidad_negocio_empresa").val(),cod:x},
			type:'post',
			success:function(data){
				$("#undxx"+x).html("");
				$("#undxx"+x).text(nombre);
				alert("Se ha modificado el nombre de la Unidad de Negocio");
			}
		});
	}
}
function cambiar_nombre_depto(x){
	$("#e_nombre_nueva_area").val($("#tabla_depto_gestion #"+x+" td:nth-child(3)").text());
	$("#codigo_depto").text(x);
	$("#e_depto").dialog('open');
}

function cambiar_estado_depto(x){
	var t = $("#tabla_depto_gestion #"+x+" td:nth-child(4)").text();
	var est = 0;
	if(t == "ACTIVO"){
		est = 0;
	}else{
		est = 1;
	}
	$.ajax({
		url:'gestion_all.php',
		data:{turno:41,id:x,estado:est},
		type:'post',
		success:function(data){
			$("#contenedor_departamentos_empresa").html("");
			$("#contenedor_departamentos_empresa").html(data);
		}
	});
}

function cerrar_info_basica(){
	$("#info_basica_empresa").css({"background-color":"white"});
	$(".scroll").css({"overflow-y":"scroll"});
	$("#info_basica_empresa").dialog('close');
}

function limpiar_logo_empresa(){
	$("#n_logo_empresa").val("");
}

function limpiar_logo_inicio(){
	$("#n_logo_bienvenida").val("");
}

function limpiar_foto_empleado_editar(){
	$("#foto_empleado_x").val("");
	$("#foto_x").html("");
}

function desactivar_usuario_empresa(id,est){
	
	$.ajax({
		url:'gestion_all2.php',
		data:{t:135,id:id,est:est},
		type:'post',
		success:function(data){
			if(est == 0){
				var es = 1;
				$("#imgestado"+id).html("<img src = '../images/iconos/INACTIVO.PNG' width='55px' height = 'auto' onclick = 'desactivar_usuario_empresa("+id+","+es+")'/>");
			}else{
				var es = 0;
				$("#imgestado"+id).html("<img src = '../images/iconos/ACTIVO.PNG' width='55px' height = 'auto' onclick = 'desactivar_usuario_empresa("+id+","+es+")'/>");
			}
			alert("ESTADO MODIFICADO");
		}
	});
}

function eliminar_contrasena_usuario(id){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:136,id:id},
		type:'post',
		success:function(data){
			alert(data);
		}
	});
}

function cambiar_foto_empleado(){
	data =  new FormData();
		var archivos = document.getElementById("foto_empleado_x");
		var archivo = archivos.files;
		for(i=0; i<archivo.length; i++){
			data.append('empleado_foto'+i,archivo[i]);	
		}
		data.append('t',68);
		$.ajax({
			url:'gestion_all2.php',
			data:data,
			type:'post',
			contentType:false,
			processData:false,
			success:function(data){
				$("#foto_x").html("");
				$("#foto_x").html(data);
			}
		});
}

function validar_valor_sel_empleado_hj(){
	if($("#listado_empleados_empresa_x").val() == 0){
			$("#id_imagen_generar_npersonal").css({"filter":"alpha(opacity=50)","-moz-opacity":"0.5","-webkit-opacity":"1","opacity":"0.5"});
			$("#id_imagen_generar_npersonal").removeAttr('onclick');
		}else{
			$("#id_imagen_generar_npersonal").css({"filter":"alpha(opacity=100)","-moz-opacity":"1","-webkit-opacity":"1","opacity":"1"});
			$("#id_imagen_generar_npersonal").attr('onclick','buscar_empleado_und()');
		}
}

function buscar_empleado_und(){
	var e = $("#listado_empleados_empresa_x").val();
	var emp = $("#empresa_final").text();
	$(".scroll").css({"overflow-y":"hidden"});
	$.ajax({
		url:'gestion_all.php',
		data:{turno:67,c:e,emp:emp,periodo:$("#periodo_nomina_x").val()},
		type:'post',
		success:function(data){
			$("#modificar_info_empleado").dialog("open");
			$("#contenedor_hj").html(data);
		}
	});
}

	

function cargar_empleados_und(){
	
}

function cargar_empleados_und_nd(){
	$("#contenedor_nomina_detallado").html("");
		$.ajax({
			url:'gestion_all.php',
			data:{turno:74,emp:$("#empresa_final").text(),und:$("#und_nomina_detallado_x").val(),periodo:$("#periodo_nomina_x").val()},
			type:'post',
			success:function(data){
				$("#contenedor_hojas_vida_empleados_x").html("");
				$("#contenedor_hojas_vida_empleados_x").html(data);
			}
		});
}
function editar_bonos_empleado(x){
	var sb =  $("#b_alimentacion_emp_h").text();
	$("#bono_al_sim").html("<input type = 'text' id = 'bono_nuevo' onkeypress = 'actualizar_bonos(event,"+x+")' value = '"+sb+"'/>");
}
function actualizar_bonos(e,x){
	if(e.keyCode == 13){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:93,val:$("#bono_nuevo").val(),id:x,empleado:$("#listado_empleados_empresa_x").val(),periodo:$("#periodo_nomina_x").val(),empresa:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_hj").html(data);
			}
		});
	}
}
function cargar_empleados_und_pd(){
	$.ajax({
			url:'gestion_all.php',
			data:{turno:62,emp:$("#empresa_final").text(),und:$("#und_pd_x").val(),periodo:$("#periodo_nomina_x").val()},
			type:'post',
			success:function(data){
				$("#contenedor_hojas_vida_empleados_x").html("");
				$("#contenedor_hojas_vida_empleados_x").html(data);
			}
		});
}

function limpiar_filtros_hv(){
	$("#und_hj_empleado_x").val("0");
	$("#und_nomina_detallado_x").val("0");
	$("#und_pd_x").val("0");
	$("#contenedor_nomina_detallado_x").html("");
	$("#contenedor_hojas_vida_empleados_x").html("");
	$("#listado_empleados_empresa_x").val("0");
}

function cargar_departamentos_und(){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:6,und:$("#e_und").val(),emp:$("#empresa_final").text()},
		type:'post',
		success:function(data){
			$("#e_departamento_empleado").html("");
			$("#e_departamento_empleado").html(data);
		}
	});
}

function resaltar_accion(x){
	$("#panel_opciones td span").css({"border":"1px solid transparent","background-color":"rgba(124, 145, 152, 0.14)","color":"#aaaaaa"});
	$("#"+x).css({"background-color":"rgb(39,170,225)","color":"white","font-weight":"bold","border-collapse":"separate","border-spacing":"2px 50px","border":"3px solid rgb(39,170,225)"});
}

function editar_nota_ppto(){
	var text = $("#text_nota_ppto_contenedor").text();
	$("#img_nota_ppto").html("</br><span class = 'botton_verde' onclick = 'guardar_modificar_notappto()'>GUARDAR NOTA PPTO</span></br>");
	$("#text_nota_ppto_contenedor").html("<textarea id ='nueva_info_nota_ppto' rows  = '8'>"+text+"</textarea>");
}

function guardar_modificar_notappto(){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:131,text:$("#nueva_info_nota_ppto").val(),emp:$("#empresa_final").text()},
		type:'post',
		success:function(data){
			alert("SE HA MODIFICADO LA INFORMACIÓN DE LA NOTA DE PRESUPUESTOS");
			$("#img_nota_ppto").html("<img src = '../images/iconos/icono_editar.png' class = 'botones_opciones' title = 'Editar Nota Presupuesto' onclick = 'editar_nota_ppto()'/>");
			$("#text_nota_ppto_contenedor").html($("#nueva_info_nota_ppto").val());
		}
	});
}
function editar_nota_oop(){
	var text = $("#text_nota_oop").text();
	$("#img_nota_oop").html("</br><span class = 'botton_verde' onclick = 'guardar_modificar_notaop()'>GUARDAR NOTA OP</span></br>");
	$("#text_nota_oop").html("<textarea id ='nueva_info_nota_op' rows  = '8'>"+text+"</textarea>");
}

function guardar_modificar_notaop(){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:132,text:$("#nueva_info_nota_op").val(),emp:$("#empresa_final").text()},
		type:'post',
		success:function(data){
			alert("SE HA MODIFICADO LA INFORMACIÓN DE LA NOTA DE ORDENES DE PRODUCCIÓN");
			$("#img_nota_oop").html("<img src = '../images/iconos/icono_editar.png' class = 'botones_opciones' title = 'Editar Nota Orden de Producción' onclick = 'editar_nota_oop()'/>");
			$("#text_nota_oop").html($("#nueva_info_nota_op").val());
		}
	});
}


function editar_nota_ooc(){
	var text = $("#text_nota_ooc").text();
	$("#img_nota_ooc").html("</br><span class = 'botton_verde' onclick = 'guardar_modificar_notaoc()'>GUARDAR NOTA OC</span></br>");
	$("#text_nota_ooc").html("<textarea id ='nueva_info_nota_oc' rows  = '8'>"+text+"</textarea>");
}

function guardar_modificar_notaoc(){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:133,text:$("#nueva_info_nota_oc").val(),emp:$("#empresa_final").text()},
		type:'post',
		success:function(data){
			alert("SE HA MODIFICADO LA INFORMACIÓN DE LA NOTA DE ORDENES DE COMPRA");
			$("#img_nota_ooc").html("<img src = '../images/iconos/icono_editar.png' class = 'botones_opciones' title = 'Editar Nota Orden de Compra' onclick = 'editar_nota_ooc()'/>");
			$("#text_nota_ooc").html($("#nueva_info_nota_oc").val());
		}
	});
}


function listar_empleados_und_nueva_nomina(){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:7,emp:$("#empresa_final").text(),und:$("#unidad_negocio_c_nomina").val()},
		type:'post',
		success:function(data){
			$("#contenendor_lista_empleados_carga").html("");
			$("#contenendor_lista_empleados_carga").html(data);
		}
	});
}

function cargar_menu_hj(){
	$("#menu_pd_empleado").html("");
	$("#menu_nd_empleado").html("");
	$("#cuadro_financiero_titulo").text("COSTO EMPLEADO "+$("#und_nomina_detallado_x option:selected").text());
	if($("#periodo_nomina_x").val() == 0 || $("#und_nomina_detallado_x").val() == 0){
		alert("LOS CAMPOS CON * SON OBLIGATORIOS !");
	}else{
		$("#nomina_detallado_x,#indenp_liquidaciones").css({"border":"0px"});
		$("#hojas_de_vida").css({"border":"2px solid #87CDF0"});
		
		$.ajax({
			url:'gestion_all2.php',
			data:{t:70,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#menus_nominaxx").html(data);
			}
		});
		$.ajax({
			url:'gestion_all2.php',
			data:{t:8,emp:$("#empresa_final").text(),und:$("#und_nomina_detallado_x").val(),periodo:$("#periodo_nomina_x").val()},
			type:'post',
			success:function(data){
				$("#listado_empleados_empresa_x").html("");
				$("#listado_empleados_empresa_x").html(data);
			}
		});
	}
	
}

function generar_nomina_mes(){
	var categorias = new Array();
    $("input[name='empleados_seleccionado_carga[]']:checked").each(function() {
         categorias.push($(this).val());
     });
	$.ajax({
		url:'gestion_all.php',
		data:{turno:70,categorias:categorias,emp:$("#empresa_final").text(),und:$("#unidad_negocio_c_nomina").val()},
		type:'post',
		success:function(data){
			alert("PERSONAL AGREGADO A LA NÓMINA");
			$.ajax({
				url:'gestion_all2.php',
				data:{t:83,emp:$("#empresa_final").text()},
				type:'post',
				success:function(data){
					$("#contenedor_opciones").html(data);
				}
			});
		}
	});
}
function actualizar_foto_miniatura(){
		data =  new FormData();
		var archivos = document.getElementById("nuevo_logo_editado");
		var archivo = archivos.files;
		for(i=0; i<archivo.length; i++){
			data.append('empleado_foto'+i,archivo[i]);	
		}
		data.append('t',68);
		$.ajax({
			url:'gestion_all2.php',
			data:data,
			type:'post',
			contentType:false,
			processData:false,
			success:function(data){
				$("#foto_logo").html("");
				$("#foto_logo").html(data);
			}
		});
	}
	
	function generar_cuadro_nomina_detallado(){
		$(".scroll").css({"overflow-y":"hidden"});
		$("#menu_hj_empleado").html("");
		$("#menu_pd_empleado").html("");
		$("#cuadro_financiero_titulo_nomina").text("NÓMINA DETALLADO "+$("#und_nomina_detallado_x option:selected").text());
		if($("#periodo_nomina_x").val() == 0 || $("#und_nomina_detallado_x").val() == 0){
			alert("LOS CAMPOS CON * SON OBLIGATORIOS !");
		}else{
			$("#hojas_de_vida,#indenp_liquidaciones").css({"border":"0px"});
			$("#nomina_detallado_x").css({"border":"2px solid #87CDF0"});
			$.ajax({
				url:'gestion_all.php',
				data:{turno:74,emp:$("#empresa_final").text(),und:$("#und_nomina_detallado_x").val(),periodo:$("#periodo_nomina_x").val()},
				type:'post',
				success:function(data){
					$("#contenedor_nde").html(data);
					$("#nomina_detallado_empleados").dialog("open");
				}
			});
		}
	}
	
	
	function generar_cuadro_personal_down(){
		$(".scroll").css({"overflow-y":"hidden"});
		$("#cuadro_financiero_titulo_indli").text("INDEMNIZACIONES Y LIQUIDACIONES "+$("#und_nomina_detallado_x option:selected").text());
		$("#menu_hj_empleado").html("");
		$("#menu_nd_empleado").html("");
		if($("#periodo_nomina_x").val() == 0 || $("#und_nomina_detallado_x").val() == 0){
			alert("LOS CAMPOS CON * SON OBLIGATORIOS !");
		}else{
			$("#hojas_de_vida,#nomina_detallado_x").css({"border":"0px"});
			$("#indenp_liquidaciones").css({"border":"2px solid #87CDF0"});
			$.ajax({
				url:'gestion_all.php',
				data:{turno:62,emp:$("#empresa_final").text(),und:$("#und_nomina_detallado_x").val(),periodo:$("#periodo_nomina_x").val()},
				type:'post',
				success:function(data){
					$("#contenedor_inlie").html(data);
					$("#indepm_liqui_empleados").dialog("open");
				}
			});
		}
		
	}
	
	function trasladar_nomina(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:90,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				alert(data);
			}
		});
	}
	function crear_ppto_general_und(){
		if($("#und_ppto_nuevo").val() == 0){
			alert("POR FAVOR SELECCIONE UNA UNIDAD DE NEGOCIO !!!");
			$("#und_ppto_nuevo").css({"border":"2px solid red"});
		}else{
			$.ajax({
				url:'gestion_all2.php',
				data:{t:11,und:$("#und_ppto_nuevo").val()},
				type:'post',
				success:function(data){
					if(data == 1){
						$("#und_ppto_nuevo").css({"border":"0px"});
						alert("SE HA CREADO EL PPTO");
					}else{
						alert("YA EXISTE UN PPTO PARA ESTA UNIDAD Y EL AÑO PRESENTE");
					}
				}
			});
		}
	}
	function crear_grupo_ppto_general(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:12,name:$("#name_grupo_ppto_general").val()},
			type:'post',
			success:function(data){
				alert("GRUPO CREADO");
				$("#name_grupo_ppto_general").val("");
			}
		});
	}
	/*
	function modificar_nombre_grupo_ppto_general(x){
		var text = $("#campo"+x).text();
		$("#campo"+x).html("<input type = 'text' id = 'update_grupo_"+x+"' onkeypress = 'guardar_nuevo_nombre_grupo("+x+")'/>");
	}
	function guardar_nuevo_nombre_grupo(x){
		alert(x);
		alert($("#update_grupo_"+x).val());
	}
	*/
	
	function agregar_item_grupo_ppto_general(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:14,grupo:$("#listado_grupos_ppto_general").val(),name:$("#name_item_grupo").val(),valor:$("#text_valor_item_grupo").text()},
			type:'post',
			success:function(data){
				alert("ITEM CREADO");
				$("#name_item_grupo").val("");
				$("#val_item_grupo").val("");
				$("#text_valor_item_grupo").text("");
				$("#listado_grupos_ppto_general").val('0');
			}
		});
	}
	
	function buscar_ano_ppto_general_und(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:19,und:$("#und_ppto_general_consulta").val()},
			type:'post',
			success:function(data){
				$("#ano_und_ppto_general_consulta").html(data);
			}
		});
		cambiar_imagen_ano_ppto();
	}
	
	
	function buscar_ppto_general_und_ano(){
		$(".scroll").css({"overflow-y":"hidden"});
		if($("#ano_und_ppto_general_consulta").val() == 0){
			
		}else{

			$.ajax({
				url:'gestion_all2.php',
				data:{t:129,und:$("#und_ppto_general_consulta").val()},
				type:'post',
				success:function(data){
					$("#und_negocio_ppto_general_texto").html(data);
				}
			});
			$.ajax({
				url:'gestion_all2.php',
				data:{t:18,und:$("#und_ppto_general_consulta").val(),ppto:$("#ano_und_ppto_general_consulta").val(),periodo:$("#periodo_ppto_general").val()},
				type:'post',
				success:function(data){
					$("#contenedor_ppto_general_empleados").html(data);
					$("#ppto_general_empleados").dialog("open");
				}
			});
		}
		
	}
	
	function agregar_item_ppto(){
		$("#editable").html("<input type = 'text' id = 'nuevo_item_ppto' onkeyup = 'listar_items_ppto_general()'/><div id = 'contenedor_listado_items_ppto' style = 'overflow:scroll;height:120px;'></div>")
	}
	function listar_items_ppto_general(){
		if($("#nuevo_item_ppto").val().length < 1){
			$("#contenedor_listado_items_ppto").html("");
		}else{
			$.ajax({
				url:'gestion_all2.php',
				data:{t:95,name:$("#nuevo_item_ppto").val()},
				type:'post',
				success:function(data){
					$("#contenedor_listado_items_ppto").html(data);
				}
			});
		}
		
	}
	
	function sel_item_ppto(){
		var categorias = new Array();
		categorias.push($('input:checkbox[name=item_nuevo_add_ppto]:checked').val());
		$.ajax({
				url:'gestion_all2.php',
				data:{t:129,und:$("#und_ppto_general_consulta").val()},
				type:'post',
				success:function(data){
					$("#und_negocio_ppto_general_texto").html(data);
				}
			});
		$.ajax({
			url:'gestion_all2.php',
			data:{t:17,items:categorias,ppto:$("#ano_und_ppto_general_consulta").val()},
			type:'post',
			success:function(data){
				$.ajax({
					url:'gestion_all2.php',
					data:{t:18,und:$("#und_ppto_general_consulta").val(),ppto:$("#ano_und_ppto_general_consulta").val(),periodo:$("#periodo_ppto_general").val()},
					type:'post',
					success:function(data){
						$("#contenedor_ppto_general_empleados").html(data);
					}
				});
			}
		});
		
	}
	
	function update_valor_pptado_mes(id){
		var valor = $("#pptado_mes"+id).text();
		$("#pptado_mes_casilla"+id+"").html("<td colspan = '2' align = 'center'><input type = 'text' id = 'valor_n_pptado_mes"+id+"'value = '"+valor+"' onkeyup = 'guardar_valor_pptado_mes(event,"+id+")'/></td>");
	}
	function guardar_valor_pptado_mes(e,id){
		if(e.keyCode == 13){
			$.ajax({
				url:'gestion_all2.php',
				data:{t:129,und:$("#und_ppto_general_consulta").val()},
				type:'post',
				success:function(data){
					$("#und_negocio_ppto_general_texto").html(data);
				}
			});
			$.ajax({
				url:'gestion_all2.php',
				data:{t:128,id:id,valor:$("#valor_n_pptado_mes"+id).val(),und:$("#und_ppto_general_consulta").val(),ppto:$("#ano_und_ppto_general_consulta").val(),periodo:$("#periodo_ppto_general").val()},
				type:'post',
				success:function(data){
					$("#contenedor_ppto_general_empleados").html(data);
				}
			});
		}
	}
	
	function editar_valor_meta_mes(x){
		var val = $("#meta_mensual_h"+x).text();
		$("#meta"+x).html("<input type = 'text' id = 'valor_meta"+x+"' onkeypress = 'guardar_meta_ppto_general(event,"+x+")' value = '"+val+"'/>");
	}
	
	function guardar_meta_ppto_general(e,x){
		if(e.keyCode == 13){
			$.ajax({
				url:'gestion_all2.php',
				data:{t:96,meta:$("#valor_meta"+x).val(),id:x},
				type:'post',
				success:function(data){
					$.ajax({
						url:'gestion_all2.php',
						data:{t:18,und:$("#und_ppto_general_consulta").val(),ppto:$("#ano_und_ppto_general_consulta").val(),periodo:$("#periodo_ppto_general").val()},
						type:'post',
						success:function(data){
							$("#contenedor_hj").html(data);
						}
					});
				}
			});
		}
		
	}
	
	function visualizar_hoja_costos_simulacro(x){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:97,id:x,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_hjs").html(data);
				//$(".ui-widget-content").css({"width":"auto"});
				$("#simulador_costo_empleado_sistema").dialog("open");
				
			}
		});
	}
	
	function imprSelec(muestra){
		var ficha=document.getElementById(muestra);
		var ventimp=window.open(' ','popimpr');
		ventimp.document.write('<link rel="stylesheet" type="text/css" href="../css/reportes.css" />');
		ventimp.document.write(ficha.innerHTML);		
		ventimp.document.close();
		ventimp.print();
		ventimp.close();
	}
	
	function guardar_tarifa_sal_minimo(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:100,val:$("#valor_sal_minimo_format").text(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#valor_sal_minimo").val("");
				$("#valor_sal_minimo_format").text("");
				$("#contenedor_nuevo_sal_minimo").hide();
				alert(data);
			}
		});
	}
	function guardar_tarifa_sal_integral(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:102,val:$("#valor_sal_minimo_format").text(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#valor_sal_minimo_format").text("");
				$("#valor_sal_minimo").val("");
				$("#contenedor_nuevo_sal_minimo").hide();
				alert(data);
			}
		});
	}
	function guardar_tarifa_aux_transporte(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:102,val:$("#valor_sal_minimo").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#valor_sal_minimo").val("");
				$("#contenedor_nuevo_sal_minimo").hide();
				alert(data);
			}
		});
	}
	function guardar_tarifa_monetizacion_sena(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:106,val:$("#valor_sal_minimo").val(),emp:$("#empresa_final").text(),rel:$("#rel_sena").val()},
			type:'post',
			success:function(data){
				$("#valor_sal_minimo").val("");
				$("#rel_sena").val("");
				$("#contenedor_nuevo_sal_minimo").hide();
				alert(data);
			}
		});
	}
	function add_unidad_negocio(){
		var name = $("#nombre_und_nueva_und").val();
		$("#nombre_und_nueva_und").val("");
		$.ajax({
			url:'gestion_all2.php',
			data:{t:1,name:name,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				alert("UNIDAD DE NEGOCIO CREADA");
			}
		});
	}
	
	function listar_por_und_areas_empresa(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:111,und:$("#listado_und_empresa_area").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_departamentos_und_empresax").html(data);
			}
		});
		
	}
	
	function update_estado_area_empresa(est,id){
		var estado = 0;
		if(est == 1){
			estado = 0;
		}else{
			estado = 1;
		}
		$.ajax({
			url:'gestion_all2.php',
			data:{t:112,est:estado,id:id,und:$("#listado_und_empresa_area").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_departamentos_und_empresax").html(data);
			}
		});
	}
	function editar_nombre_departamento(id){
		var nombre = $("#namedepto"+id).text();
		 $("#namedepto"+id).html("<input type = 'text' id = 'nombre_departamento_editar"+id+"' value = '"+nombre+"' onkeypress = 'modificar_nombre_departamento(event,"+id+")'/>");
	}
	function modificar_nombre_departamento(e,id){
		if(e.keyCode == 13){
			var name = $("#nombre_departamento_editar"+id).val().toUpperCase();
			$.ajax({
				url:'gestion_all.php',
				data:{turno:42,id:id,depto:$("#nombre_departamento_editar"+id).val()},
				type:'post',
				success:function(data){
					alert("Se ha modificado el nombre del departamento");
					$("#namedepto"+id).html(name);
				}
			});
		}
		
	}
	
	function add_depto_und_empresa(){
		$.ajax({
			url:'gestion_all.php',
			data:{turno:40,emp:$("#empresa_final").text(),depto:$("#name_area_nueva_und_empresa").val(),
			und:$("#und_negocio_add_area").val()},
			type:'post',
			success:function(data){
				alert(data);
				$(".hijo_consultar_deptos").hide();
				$(".hijo_add_deptos").toggle();
			}
		});
	}
	
	function filtrar_empleados_estado(){
		var nombre = $("#b_nombre_empleado").val();
		var cedula = $("#b_cedula_empleado").val();
		var und = $("#und_filtro_empleado").val();
		var depto = $("#depto_filtro_empleado").val();
		var empresa = $("#empresa_final").text();
		var estado = $('#estado_empleados').val();
		
		$("#link_impresion_empleados_pdf").attr("href", "generar_pdf_listado_empleados.php?n="+nombre+"&c="+cedula+"&u="+und+"&d="+depto+"&ee="+empresa+"&e="+estado+"");
		$.ajax({
			url:'gestion_all2.php',
			data:{t:115,estado:estado,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedo_tabla_muestra_empleados").html(data);
			}
		});
	}
	
	function buscar_nombre_usuario_n(){
		if($("#listado_empleados_sin_usuario").val() != 0 && $("#listado_perfiles_usuario").val() != 0){
			$.ajax({
				url:'gestion_all2.php',
				data:{t:147,name:$("#nombre_nuevo_usuario_empleado").val()},
				type:'post',
				success:function(data){
					if(data == 1){
						$("#valid_usuario").html("USUARIO YA REGISTRADO");
						$("#boton_guardar_n_usuario").css({"display":"none"});
					}else{
						$("#valid_usuario").html("");	
						$("#boton_guardar_n_usuario").css({"display":"block"});
					}
					
				}
			});
		}
	}
	
	function guardar_info_nuevo_usuario_empleado(){
		if( $("#nombre_nuevo_usuario_empleado").val().length > 0){
			if( $("#listado_depto_trafico_usuario").val() != 0){
				if( $("#listado_empleados_sin_usuario").val() != 0){
					if( $("#listado_empleados_sin_usuario").val() != 0){
						$.ajax({
							url:'gestion_all.php',
							data:{turno:68,name:$("#nombre_nuevo_usuario_empleado").val(),perfil:$("#listado_perfiles_usuario").val(),empleado:$("#listado_empleados_sin_usuario").val(),depto:$("#listado_depto_trafico_usuario").val()},
							type:'post',
							success:function(data){
								$.ajax({
									url:'gestion_all2.php',
									data:{t:134,emp:$("#empresa_final").text()},
									type:'post',
									success:function(data){
										$("#contenedor_opciones_admin").html(data);
									}
								});
								alert("USUARIO CREADO !");
								
							}
						});
					}else{
						alert("Debe seleccionar un perfil de usuario !");
					}
				}else{
					alert("Debe seleccionar un empleado !");
				}
			}else{
				alert("Debe seleccionar un departamento !");
			}
		}
	}
	
	function guardar_info_nuevo_usuario_depto(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:149,usuario:$("#listado_empleados_usuario").val(),depto:$("#listado_deptos_empresa").val()},
			type:'post',
			success:function(data){
				alert("RESPONSABLE ASIGNADO");
				$.ajax({
					url:'gestion_all2.php',
					data:{t:148,emp:$("#empresa_final").text()},
					type:'post',
					success:function(data){
						$("#contenedor_opciones_admin").html(data);
					}
				});
			}
		});
	}
	
	function eliminar_responsable_departamento(id){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:150,id:id},
			type:'post',
			success:function(data){
				alert("RESPONSABLE ELIMINADO");
				$.ajax({
					url:'gestion_all2.php',
					data:{t:148,emp:$("#empresa_final").text()},
					type:'post',
					success:function(data){
						$("#contenedor_opciones_admin").html(data);
					}
				});
			}
		});
	}
	
	function buscar_asignados_por_usuario(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:152,usuario:$("#list_usuarios_asignados").val()},
			type:'post',
			success:function(data){
				$("#contenedor_list_asignados_usuario").html(data);
			}
		});
	}
	
	function eliminar_asignado_usuario_r(id){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:153,id:id},
			type:'post',
			success:function(data){
				alert("ASIGNADO ELIMINADO");
				$.ajax({
					url:'gestion_all2.php',
					data:{t:152,usuario:$("#list_usuarios_asignados").val()},
					type:'post',
					success:function(data){
						$("#contenedor_list_asignados_usuario").html(data);
					}
				});
			}
		});
	}
	function buscar_empleados_depto_usuarios(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:154,emp:$("#empresa_final").text(),depto:$("#listado_deptos_empresa").val(),usu:$("#listado_usuarios_sistema_asignados").val()},
			type:'post',
			success:function(data){
				$("#listado_usuario_por_asignar").html(data);
			}
		});
	}
	
	function update_list_deptos(){
		$("#listado_deptos_empresa").val("0");
	}
	
	function guardar_info_nuevo_usuario_asignado(){
		var asignados = [];
		$("input[name='list_permisos_empleados[]']:checked").each(function() {
			asignados.push($(this).val());
		 });
		$.ajax({
			url:'gestion_all2.php',
			data:{t:155,emp:$("#empresa_final").text(),depto:$("#listado_deptos_empresa").val(),usu:$("#listado_usuarios_sistema_asignados").val(),asig:$("#listado_usuario_por_asignar").val(),asig:asignados},
			type:'post',
			success:function(data){
				alert("PERMISO ASIGNADO");
				$.ajax({
					url:'gestion_all2.php',
					data:{t:152,usuario:$("#list_usuarios_asignados").val()},
					type:'post',
					success:function(data){
						$("#contenedor_list_asignados_usuario").html(data);
					}
				});
			}
		});
	}
	
	function buscar_asignados_por_cuenta(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:36,emple:$("#list_usuario_clientes_permisos").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_list_asignados_usuario").html(data);
			}
		});
	}
	
	function buscar_productos_clientes_libres(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:157,usuario:$("#listado_usuarios_sistema_asignados").val(),emp:$("#empresa_final").text(),cliente:$("#listado_cliente_permisos_p").val()},
			type:'post',
			success:function(data){
				$("#contenedor_productos_list").html(data);
			}
		});
	}
	function guardar_cliente_producto_usuario(){
		var productos = [];
		$("input[name='productos_permisos[]']:checked").each(function() {
            productos.push($(this).val());
        });
		$.ajax({
			url:'gestion_all2.php',
			data:{t:38,empleado:$("#listado_usuarios_sistema_asignados").val(),clie:$("#listado_cliente_permisos_p").val(),pro:productos,
			emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				alert("PERMISO HABILITADO!");
				$("#nueva_cuenta_asignar select").val('0');
				$("#nueva_cuenta_asignar").dialog('close');
			}
		});
	}
	
	function guardar_info_permiso_empresa(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:159,empleado:$("#listado_empleados_usuario").val(),emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				alert("EMPRESA HABILITADA!");
				$("#nueva_cuenta_asignar select").val('0');
				$("#nueva_cuenta_asignar").dialog('close');
			}
		});
		$.ajax({
			url:'gestion_all2.php',
			data:{t:158,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones_admin").html(data);
			}
		});
	}
	
	function guardar_info_director_empleado(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:161,empleado:$("#listado_empleados_usuario").val(),director:$("#listado_empleados_directores").val()},
			type:'post',
			success:function(data){
				alert("DIRECTOR HABILITADO!");
			}
		});
		$.ajax({
			url:'gestion_all2.php',
			data:{t:160,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#contenedor_opciones_admin").html(data);
			}
		});
	}
	function cambiar_imagen_ano_ppto(){
		var valor = $("#ano_und_ppto_general_consulta").val();
		if(valor == 0){
			alert("DEBE SELECCIONAR UN AÑO !!");
			$("#generar_ppto_general_id").html("<img src = '../images/iconos/generar_apagado.png'  height = '150px' />");
		}else{
			$("#generar_ppto_general_id").html("<img src = '../images/iconos/generar_on.png'  height = '150px' onclick = 'buscar_ppto_general_und_ano()'/>");
		}
	}

	function guardar_nuevo_porcentaje_pptos_empresa(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:165,val:$("#n_valor_min_ppto_emp").val(),emp:$("empresa_final").text()},
			type:'post',
			success:function(dat){
				alert(dat);
			}
		});
	}
	
	function hijos_empleados(){
	   var dat = "<table width = '100%'>";
	   var num = $("#num_hijos").val();
	   $(".contenedor_num_hijos").hide();
	   $(".tabla_hijos tr").each(function(index){
		  if(index < num){
			$(this).show();
		  }
	   });
	}
	function subir_archivo_nomina_excel(){
		if($("#excel_nomina").val().length == 0){
			alert("PARA EJECUTAR ESTA ACCIÓN DEDE SUBIR UN ARCHIVO !!!");
		}else{
			data =  new FormData();
			var archivos = document.getElementById("excel_nomina");
			var archivo = archivos.files;
			for(i=0; i<archivo.length; i++){
				data.append('nomina_excel'+i,archivo[i]);	
			}
			data.append('usuario',$("#user").text());
			data.append('emp',$("#empresa_final").text());
			$.ajax({
				url:'excel_nomina_ali.php',
				data:data,
				type:'post',
				contentType:false,
				processData:false,
				success:function(data){
					alert(data);
				}
			});
		}
	}
	
	function guardar_nuevo_plan_negocio(){
		var valores = [];
		valores.push($("#h_enero_year").text());
		valores.push($("#h_febrero_year").text());
		valores.push($("#h_marzo_year").text());
		valores.push($("#h_abril_year").text());
		valores.push($("#h_mayo_year").text());
		valores.push($("#h_junio_year").text());
		valores.push($("#h_julio_year").text());
		valores.push($("#h_agosto_year").text());
		valores.push($("#h_septiembre_year").text());
		valores.push($("#h_octubre_year").text());
		valores.push($("#h_noviembre_year").text());
		valores.push($("#h_diciembre_year").text());
		$.ajax({
			url:'gestion_all2.php',
			data:{t:168,meses:valores,und:$("#n_bp_und").val(),emp:$("#empresa_final").text(),cliente:$("#n_bp_cliente").val()},
			type:'post',
			success:function(d){
				$("#contenedor_opciones_admin").html(d);
			}
		});
	}
	function buscar_und_bp(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:169,und:$("#und_bp").val(),year:$("#year_bp").val(),cliente:$("#cliente_bp_b").val()},
			type:'post',
			success:function(d){
				$("#contenedor_list_bp").html(d);
			}
		});
	}
	
	
	function eliminar_registros_cuadro(id,ppto){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:177,id:id,ppto:ppto},
			type:'post',
			success:function(d){
				$.ajax({
					url:'gestion_all2.php',
					data:{t:18,und:$("#und_ppto_general_consulta").val(),ppto:$("#ano_und_ppto_general_consulta").val(),periodo:$("#periodo_ppto_general").val()},
					type:'post',
					success:function(data){
						$("#contenedor_ppto_general_empleados").html(data);
					}
				});
			}
		});
	}