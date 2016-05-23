var correos = [];
var representante = [];
var notificar_a = [];

var monthNames = [
        "Enero", "Febrero", "Marzo",
        "Abril", "Mayo", "Junio", "Julio",
        "Agosto", "Septiembre", "Octubre",
        "Noviembre", "Diciembre"
    ];

function mostrar_informacion_empleado(){
	var id = $('input:radio[name=sel_empleado]:checked').val();
	alert(id);
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
	
	 $.datepicker.regional['es'] = {
		 closeText: 'Cerrar',
		 prevText: '<Ant',
		 nextText: 'Sig>',
		 currentText: 'Hoy',
		 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		 weekHeader: 'Sm',
		 firstDay: 1,
		 isRTL: false,
		 showMonthAfterYear: false,
		 yearSuffix: ''
		 };
	$.datepicker.setDefaults($.datepicker.regional['es']);
	
	
	
	var alto = $(window).height();
	var ancho_x = $(window).width();
	var ancho_por = (ancho_x*99)/100;
	var ancho_por2 = (ancho_x*98)/100;
	var x = (alto*99)/100;
	var alto_hhh = (alto*60)/100;
	
	
	$("#fecha_vencimiento_documento,#e_fecha_retiro_empleado").datepicker({ dateFormat: 'yy-mm-dd',beforeShowDay: nonWorkingDates,	numberOfMonths: 1,	minDate: '0',firstDay: 1});
	$("#fecha_vencimiento_documento").on('change',function(){
		var date = $("#fecha_vencimiento_documento").val();
		$("#fecha_numerica_documento").text(date);
		date = date.split("-");
		$("#fecha_vencimiento_documento").val(monthNames[parseFloat(date[1]-1)]+"-"+date[2]+"-"+date[0]);
	});
	
	$("#fecha_nacimiento_empleado").datepicker({ dateFormat: 'yy-mm-dd',changeMonth: true, changeYear: true,yearRange: '-50:+0'});
	$("#fecha_ingreso_empleado").datepicker({ dateFormat: 'yy-mm-dd',changeMonth: true});
	$("#fecha_retiro_empleado").datepicker({ dateFormat: 'yy-mm-dd',changeMonth: true});
	$("#e_fecha_retiro_empleado").datepicker({ dateFormat: 'yy-mm-dd',beforeShowDay: nonWorkingDates,	numberOfMonths: 1,	minDate: '0',firstDay: 1});
	//$("#fecha_retiro_empleado").datepicker({ dateFormat: 'yy-mm-dd' ,beforeShowDay: nonWorkingDates,	numberOfMonths: 1,	minDate: '0',firstDay: 1});
	
	
	
	
	
	
	$("#ingresar_nuevo_inventario_tec").on('click',function(){
		$("#crear_item_tecnologia").dialog('open');
	});
	
	$("#ingresar_nuevo_documento").on('click',function(){
		$("#form_nuevo_documento").dialog('open');
	});
	$("#n_cancelar_documento_empresa,#n_cancelar_documento_empresa_x").on('click',function(){
		$("#form_nuevo_documento input").val('');
		$("#form_nuevo_documento select").val('vacio');
		$("#form_nuevo_documento").dialog('close');
	});
	
	$("#n_cancelar_modificar_empresa_gestion").on('click',function(){
		$("#modif").css("color","black");
		$("#datos_modificar_empresa_gestion input").val("");
		$("#datos_modificar_empresa_gestion select").val("vacio");
		$("#datos_modificar_empresa_gestion textarea").val("");
		$("#datos_modificar_empresa_gestion").dialog('close');
	});
	$("#boton_crear_empresa_gestion").on("click",function(){
		$("#add").css("color","#EF8C14");
		$("#datos_crear_empresa_gestion").dialog('open');
	});
	$("#n_cancelar_empresa_gestion").on('click',function(){
		$("#add").css("color","black");
		$("#datos_crear_empresa_gestion input").val("");
		$("#datos_crear_empresa_gestion select").val("vacio");
		$("#datos_crear_empresa_gestion textarea").val("");
		$("#datos_crear_empresa_gestion").dialog('close');
	});
	
	$(".ui-dialog-titlebar").hide();
	
	
	$("#nit_empresa_gestion").on('keyup',function(){
		var nit = $("#nit_empresa_gestion").val();
		$.ajax({
			url:'gestion_all.php',
			data:{nit:nit,turno:1},
			type:'POST',
			success:function(data){
				$("#contenedor_respuestas").html("");
				$("#contenedor_respuestas").append(data);
			}
		});
	});
	$("#nombre_empresa_gestion").on('keyup',function(){
		var nombre = $("#nombre_empresa_gestion").val();
		$.ajax({
			url:'gestion_all.php',
			data:{nombre:nombre,turno:2},
			type:'POST',
			success:function(data){
				$("#contenedor_respuestas").html("");
				$("#contenedor_respuestas").append(data);
			}
		});
	});
	$("#boton_mostrar_empresa_gestion").on('click',function(){
		$.ajax({
			url:'gestion_all.php',
			data:{turno:3},
			type:'POST',
			success:function(data){
				$("#contenedor_respuestas").html("");
				$("#contenedor_respuestas").append(data);
			}
		});
	});
	$("#n_nit_empresa").on('keyup',function(){
		var nit = $("#n_nit_empresa").val();
		$.ajax({
			url:'gestion_all.php',
			data:{n:nit,turno:8},
			type:'POST',
			success:function(data){
				if(data == "0"){
					$("#n_guardar_empresa_gestion").show();
				}else{
					alert("EL NIT YA SE HA INGRESADO");
					$("#n_guardar_empresa_gestion").hide();
				}
			}
		});
	});
	
	$("#cerrar_ventana_hje").on('click',function(){
		$("#modificar_info_empleado").dialog('close');
	});
	/*GUARDAR DOCUMENTO*/
	$("#n_guardar_documento_empresa").on('click',function(){
		var data = new FormData();
		var doc = $("#tipo_documento_subir").val();
		
		if(doc == 10 || doc == 11 || doc == 8 || doc == 14 || doc == 9 || doc == 16){
			data.append('tipo_x',0);
			data.append('emp',$("#empresa_final").text());
				data.append('tipo',$("#tipo_documento_subir").val());
				data.append('fecha',$("#fecha_numerica_documento").text());
				data.append('valor',$("#text_input_valor_doc").text());
				data.append('turno',47);
				data.append('tipo_x',0);
				data.append('notificar',notificar_a);
				
				$.ajax({
					url:'gestion_all.php',
					data:data,
					type:'post',
					contentType:false, //Debe estar en false para que pase el objeto sin procesar
					processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
					success:function(data){
						alert(data);
						$("#form_nuevo_documento input").val('');
						$("#form_nuevo_documento select").val('vacio');
						$("#form_nuevo_documento").dialog('close');
						$.ajax({
							url:'gestion_all2.php',
							data:{t:64,emp:$("#empresa_final").text()},
							type:'post',
							success:function(data){
								$("#contenedor_documentos_x_empresa").html("");
								$("#contenedor_documentos_x_empresa").html(data);
							}
						});
					}
				});
		}else{
			var file = $("#archivo_documento")[0].files[0];
			var fileName = file.name;
			fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
			if(fileExtension == "pdf" || fileExtension == 'jpg' || fileExtension == 'png'){
				data.append('tipo_x',1);
				var archivos = document.getElementById("archivo_documento");
				var archivo = archivos.files;
				
				for(i=0; i<archivo.length; i++){
					data.append('archivo'+i,archivo[i]);	
				}
				data.append('emp',$("#empresa_final").text());
				data.append('tipo',$("#tipo_documento_subir").val());
				data.append('fecha',$("#fecha_numerica_documento").text());
				data.append('valor',$("#text_input_valor_doc").text());
				data.append('turno',47);
				data.append('notificar',notificar_a);
				
				$.ajax({
					url:'gestion_all.php',
					data:data,
					type:'post',
					contentType:false, //Debe estar en false para que pase el objeto sin procesar
					processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
					success:function(data){
						alert(data);
						$("#form_nuevo_documento input").val('');
						$("#form_nuevo_documento select").val('vacio');
						$("#form_nuevo_documento").dialog('close');
						$.ajax({
							url:'gestion_all2.php',
							data:{t:64,emp:$("#empresa_final").text()},
							type:'post',
							success:function(data){
								$("#contenedor_documentos_x_empresa").html("");
								$("#contenedor_documentos_x_empresa").html(data);
							}
						});
					}
				});
			}else{
				alert("DEBE SUBIR SOLAMENTE ARCHIVOS EN FORMATO PDF O IMAGEN");
			}
		}
		notificar_a = [];
		$("#listado_notificar_a").html("");
	});
	
	//Cuando cambio de empresa al buscar documentos_empresa
	$("#empresa_documentos").on('change',function(){
		var emp = $("#empresa_documentos").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:48,emp:emp},
			type:'post',
			success:function(data){
				$("#contenedor_documentos_x_empresa").html("");
				$("#contenedor_documentos_x_empresa").html(data);
			}
		});
	});
	
	/*
	$("#archivo_documento").change(function(){
		//obtenemos un array con los datos del archivo
        var file = $("#archivo_documento")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        alert(fileExtension);
	});
	*/
	
	$("#n_guardar_empresa_gestion").on('click',function(){
		var n_nit = $("#n_nit_empresa").val();
		var n_legal = $("#n_nombre_legal_empresa").val();
		var n_comercial = $("#n_nombre_comercial_empresa").val();
		var n_iniciales = $("#n_iniciales_empresa").val();
		var n_telefono = $("#n_telefono_empresa").val();
		var n_direc = $("#n_direccion_empresa").val();
		var n_nota = $("#n_nota_orden_empresa").val();
		var n_ppto = $("#n_nota_ppto_empresa").val();
		var n_pais = $("#n_pais_empresa").val();
		var n_depto = $("#n_departamento_empresa").val();
		var n_ciudad = $("#n_ciudad_empresa").val();
		var info = 4;
		$.ajax({
			url:'gestion_all.php',
			data:{
				nit:n_nit,
				legal:n_legal,
				comercial:n_comercial,
				iniciales:n_iniciales,
				phone:n_telefono,
				direc:n_direc,
				nota:n_nota,
				pais:n_pais,
				depto:n_depto,
				ciudad:n_ciudad,
				n_ppto:n_ppto,
				turno:4
			},
			type:'POST',
			success:function(data){
				$("#n_nit_empresa").val("");
				$("#n_nombre_legal_empresa").val("");
				$("#n_nombre_comercial_empresa").val("");
				$("#n_iniciales_empresa").val("");
				$("#n_telefono_empresa").val("");
				$("#n_nota_orden_empresa").val("");
				$("#n_direccion_empresa").val("");
				$("#n_pais_empresa").val("");
				$("#n_departamento_empresa").val("");
				$("#n_ciudad_empresa").val("");
				$("#e1").hide();
				alert(data);
				document.location.reload();
			}
		});
	});
	
	$("#n_cancelar_empresa_gestion").on('click',function(){
		$("#n_cancelar_empresa_gestion input").val("");
		$("#n_cancelar_empresa_gestion textarea").val("");
		$('#e1').hide();
	});
	
	$("#n_cancelar_modificar_empresa_gestion").on('click',function(){
		$("#n_cancelar_modificar_empresa_gestion input").val("");
		$("#n_cancelar_modificar_empresa_gestion textarea").val("");
		$("#e2").hide();
	})
	
	$("#img1").hover(function(){
		enfasis("img1");
	});
	
	$("#n_modificar_empresa_gestion").on('click',function(){
		var n_nit = $("#e_nit_empresa").val();
		var n_legal = $("#e_nombre_legal_empresa").val();
		var n_comercial = $("#e_nombre_comercial_empresa").val();
		var n_iniciales = $("#e_iniciales_empresa").val();
		var n_telefono = $("#e_telefono_empresa").val();
		var n_direc = $("#e_direccion_empresa").val();
		var n_nota = $("#e_nota_orden_empresa").val();
		var n_nota_ppto = $("#e_nota_ppto_empresa").val();
		$.ajax({
			url:'gestion_all.php',
			data:{
				nit:n_nit,
				legal:n_legal,
				comercial:n_comercial,
				iniciales:n_iniciales,
				phone:n_telefono,
				direc:n_direc,
				nota:n_nota,
				n_nota_ppto:n_nota_ppto,
				turno:5
			},
			type:'POST',
			success:function(data){
				$("#n_cancelar_modificar_empresa_gestion input").val("");
				$("#n_cancelar_modificar_empresa_gestion textarea").val("");
				$("#e2").hide();
				alert(data);
				document.location.reload();
			}
		});
	});

	
});
	function editar_empresa_gestion(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:65,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#info_basica_empresa").css({"background-color":"#E7E7E7"});
				$("#info_basica_empresa").html(data);
			}
		});
	}
	
	function modificar_datos_empresa(){
		data =  new FormData();
		 if($("#nuevo_logo_editado").val().length > 0){
			var archivos = document.getElementById("nuevo_logo_editado");
			var archivo = archivos.files;
			for(i=0; i<archivo.length; i++){
				data.append('bienvenida'+i,archivo[i]);	
			}
			data.append("archivos",1);
		}else if($("#nuevo_logo_editado").val().length == 0){
			data.append("archivos",0);
		}
		data.append("legal",$("#n_legal").val());
		data.append("comercial",$("#r_social").val());
		data.append("iniciales",$("#iniciales").val());
		//data.append("phone",$("#telefono").val());
		data.append("direc",$("#dir").val());
		//data.append("nota",$("#n_nota_orden_empresa").val());
		//data.append("n_ppto",$("#nota_pptos").val());
		data.append("pais",$("#n_pais_empresa").val());
		data.append("depto",$("#n_depto_empresa").val());
		data.append("ciudad",$("#n_ciudad_empresa").val());
		data.append("n_face",$("#n_face").val());
		data.append("n_you",$("#n_you").val());
		data.append("n_twitter",$("#n_twitter").val());
		//data.append("n_nota_oc",$("#n_nota_orden_c").val());
		data.append("n_web",$("#n_pagina").val());
		//data.append("email",$("#email_empresa").val());
		//data.append("n_re_legal",$("#rlegal").val());
		data.append("emp",$("#empresa_final").text());
		data.append("turno",5);
		$.ajax({
			url:'gestion_all.php',
			data:data,
			type:'POST',
			contentType:false,
			processData:false,
			success:function(data){
				$.ajax({
					url:'gestion_all2.php',
					data:{t:43,emp:$("#empresa_final").text()},
					type:'post',
					success:function(data){
						$("#info_basica_empresa").css({"background-color":"white"});
						$("#info_basica_empresa").html(data);
					}
				});
				cancelar_editar_empresa();
			}
		});
	}
	
	function cancelar_editar_empresa(){
		$("#info_basica_empresa").dialog('open');
		$("#datos_modificar_empresa_gestion").dialog('close');
	}
	
	function documentos_empresa(id){
	   var formData = new FormData($(".formulario")[0]);
       var message = ""; 
       $.ajax({
           url: 'reporte_cliente.php',  
           type: 'POST',
           data: formData,
           cache: false,
           contentType: false,
           processData: false,
           success: function(data){
				$("#contenedor_general").html("");
				$("#contenedor_general").html(data);
				$("#contenedor_general").css("overflow","scroll");
           }
       });
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
	
	function mostrar_info_basica(x){
		$.ajax({
			url:'gestion_all2.php',
			data:{emp:x,t:43},
			type:'POST',
			success:function(data){
				$("#info_basica_empresa").css({"background-color":"white"});
				$("#info_basica_empresa").html(data);
			}
		});	
	}
	
	function desactivar_representante(x,e){
		$.ajax({
				url:'gestion_all2.php',
				data:{emp:$("#empresa_final").text(),t:75,id:x,estado:e},
				type:'POST',
				success:function(data){
					$("#lista_representante").html("");
					$("#lista_representante").html(data);
				}
			});	
	}
	function guardar_representante(e){
		if(e.keyCode == 13){
			$.ajax({
				url:'gestion_all2.php',
				data:{emp:$("#empresa_final").text(),t:73,name:$("#n_re_legal").val()},
				type:'POST',
				success:function(data){
					$("#lista_representante").html("");
					$("#lista_representante").html(data);
				}
			});	
			$("#n_re_legal").val("");
		}
	}
	function modificar_nombre_representantes_empresa(e,x,i){
		if(e.keyCode == 13){
			$.ajax({
				url:'gestion_all2.php',
				data:{id:x,t:74,name:$("#name_r"+i).val(),emp:$("#empresa_final").text()},
				type:'POST',
				success:function(data){
					$("#lista_representante").html("");
					$("#lista_representante").html(data);
				}
			});	
		}
	}
	
	function guardar_correo(e){
		if(e.keyCode == 13){
			$.ajax({
				url:'gestion_all2.php',
				data:{emp:$("#empresa_final").text(),t:76,name:$("#email").val()},
				type:'POST',
				success:function(data){
					$("#lista_correos").html("");
					$("#lista_correos").html(data);
				}
			});	
			$("#email").val("");
		}
	}
	
	function modificar_correo_empresa(e,x,i){
		if(e.keyCode == 13){
			$.ajax({
				url:'gestion_all2.php',
				data:{id:x,t:77,name:$("#correo_e"+i).val(),emp:$("#empresa_final").text()},
				type:'POST',
				success:function(data){
					$("#lista_correos").html("");
					$("#lista_correos").html(data);
				}
			});	
		}
	}
	
	function desactivar_correo(x,e){
		$.ajax({
				url:'gestion_all2.php',
				data:{emp:$("#empresa_final").text(),t:78,id:x,estado:e},
				type:'POST',
				success:function(data){
					$("#lista_correos").html("");
					$("#lista_correos").html(data);
				}
			});	
	}
	
	function guardar_telefono(e){
		if(e.keyCode == 13){
			$.ajax({
				url:'gestion_all2.php',
				data:{emp:$("#empresa_final").text(),t:79,name:$("#phone_empresa_editar").val()},
				type:'POST',
				success:function(data){
					$("#lista_telefonos").html("");
					$("#lista_telefonos").html(data);
				}
			});	
			$("#phone_empresa_editar").val("");
		}
	}
	function modificar_nombre_telefono_empresa(e,x,i){
		if(e.keyCode == 13){
			$.ajax({
				url:'gestion_all2.php',
				data:{id:x,t:80,name:$("#phone_r"+i).val(),emp:$("#empresa_final").text()},
				type:'POST',
				success:function(data){
					$("#lista_telefonos").html("");
					$("#lista_telefonos").html(data);
				}
			});	
		}
	}
	function desactivar_telefono(x,e){
		$.ajax({
				url:'gestion_all2.php',
				data:{emp:$("#empresa_final").text(),t:81,id:x,estado:e},
				type:'POST',
				success:function(data){
					$("#lista_telefonos").html("");
					$("#lista_telefonos").html(data);
				}
			});	
	}
	
	
	function limpiar_nuevo_logo(){
		$("#nuevo_logo_editado").val("");
	}
	
	function guardar_notificar_a(e){
		if(e.keyCode == 13){
			$("#listado_notificar_a").html("");
			notificar_a.push($("#nombre_notificar").val());
			for(var i = 0; i < notificar_a.length; i++){
				$("#listado_notificar_a").append("<table><tr><td><img onclick = 'eliminar_notificar_a("+i+")'src = '../images/icon/icono_cerrar.png' width = '25px' height = '25px'/></td><td>"+notificar_a[i]+"</td></tr></table>");
			}
			$("#nombre_notificar").val("");
		}
	}
	
	function eliminar_notificar_a(x){
		notificar_a.splice(x,1);
		$("#listado_notificar_a").html("");
		for(var i = 0; i < notificar_a.length; i++){
			$("#listado_notificar_a").append("<table><tr><td><img onclick = 'eliminar_telefono("+i+")'src = '../images/icon/icono_cerrar.png' width = '25px' height = '25px'/></td><td>"+notificar_a[i]+"</td></tr></table>");
		}
		$("#nombre_notificar").val("");
	}
	
	function enfasis(x){
		var an = $("#"+x).height()/2;
		$("#"+x).css({"border-radius":"50%","width":an,"height":an,"border":"1px solid black"});
	}