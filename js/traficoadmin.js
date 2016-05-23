function agregar_asunto(x){
	$("#asun"+x).remove();
	$("#asunt"+x).append("<input class = 'inputs' type = 'text' name = 'asunto"+x+"' id = 'asunto"+x+"' onkeypress = 'insertar_asunto("+x+",event)'/>");
}
function nonWorkingDates(date){
		var day = date.getDay(), Sunday = 0, Monday = 1, Tuesday = 2, Wednesday = 3, Thursday = 4, Friday = 5, Saturday = 6;
		var closedDays = [[Saturday], [Sunday]];
		/*for (var i = 0; i < closedDays.length; i++) {
			if (day == closedDays[i][0]) {
				return [false];
			}
		}*/

		for (i = 1; i < festivos.length; i++) {
			if (date.getMonth() == festivos[i][0] - 1 &&
				date.getDate() == festivos[i][1] &&
				date.getFullYear() == festivos[i][2]) {
					return [false];

				}
			}
		return [true];
	}
	
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
function insertar_asunto(x,e){
	if(e.keyCode == 13){
		var d =$("#asunto"+x).val();
		var traf = $("#trafico").text();
		if(d.length == 0){
			alert("NO HA INSERTADO NINGUN DATO");
			$("#asunto"+x).remove();
			$("#asunt"+x).append("<div class = 'contenedor_asunto' id = 'asun"+x+"' ondblclick = 'agregar_asunto("+x+")' ><span></span></div>");
		}else{
			$.ajax({
				url:'trafic.php',
				data:{turno:9,d:d,t:traf},
				type:'post',
				success:function(data){
					$("#contenedor_traficos").html("");
					$("#contenedor_traficos").html(data);
				}
			});
		}
	}
}

function editar_asunto(x){
	var text = $("#asunto"+x).text();
	$("#asunto"+x).remove();
	$("#asunt"+x).append("<input class = 'inputs' type = 'text' name = 'asunto"+x+"' id = 'asunto"+x+"' value = '"+text+"' onkeypress = 'guardar_asunto("+x+",event)'/>");
}

function editar_fecha(x){
	var text = $("#fech"+x).text();
	$("#fech"+x).remove();
	$("#fecha"+x).append("<input class = 'inputs' type = 'text' name = 'fech"+x+"' id = 'fech"+x+"' value = '"+text+"' onkeypress = 'guardar_fecha("+x+",event)'/>");
	$("#fech"+x).datepicker({ dateFormat: 'yy-mm-dd' });
}

function guardar_fecha(x,e){
	if(e.keyCode == 13){
		var d =$("#fech"+x).val();
		var id = $("#idreal"+x).text();
		$.ajax({
			url:'trafic.php',
			data:{id:id,turno:21,d:d},
			type:'post',
			success:function(){
				$("#fech"+x).remove();
				$("#fecha"+x).append("<span id = 'fech"+x+"' ondblclick = 'editar_fecha("+x+")'>"+d+"</span>");
			}
		});
	}
}

function guardar_asunto(x,e){
	if(e.keyCode == 13){
		var d =$("#asunto"+x).val();
		var id = $("#idreal"+x).text();
		$.ajax({
			url:'trafic.php',
			data:{id:id,turno:6,d:d},
			type:'post',
			success:function(){
				$("#asunto"+x).remove();
				$("#asunt"+x).append("<span id = 'asunto"+x+"' ondblclick = 'editar_asunto("+x+")'>"+d+"</span>");
			}
		});
	}
}

function editar_descripcion(x){
	var text = $("#descripcion"+x).text();
	$("#descripcion"+x).remove();
	$("#desc"+x).append("<textarea name = 'descripcion"+x+"' id = 'descripcion"+x+"' onkeypress = 'guardar_descripcion("+x+",event)'>"+text+"</textarea>");
}

function editar_estatus(x){
	var text = $("#estatus"+x).text();
	var id = $("#idreal"+x).text();
	if(text == "TERMINADO"){
		$.ajax({
			url:'trafic.php',
			data:{id:id,turno:10,d:1},
			type:'post',
			success:function(){
				$("#estatus"+x).remove();
				$("#estat"+x).append("<span name = 'estatus"+x+"' id = 'estatus"+x+"' ondblclick = 'editar_estatus("+x+")'>PENDIENTE</span>");
			}
		});
	}else{
		$.ajax({
			url:'trafic.php',
			data:{id:id,turno:10,d:0},
			type:'post',
			success:function(){
				$("#estatus"+x).remove();
				$("#estat"+x).append("<span name = 'estatus"+x+"' id = 'estatus"+x+"' ondblclick = 'editar_estatus("+x+")'>TERMINADO</span>");
			}
		});
	}
}

function eliminar_item_trafico(x,y){
	var traf = $("#trafico").text();
	$.ajax({
		url:'trafic.php',
		data:{turno:16,x:x,tt:traf},
		type:'post',
		success:function(data){
			$("#fila"+y).remove();
			$("#contenedor_traficos").html("");
			$("#contenedor_traficos").html(data);
		}
	});
}

function editar_next(x){
	var text = $("#nex"+x).text();
	$("#nex"+x).remove();
	$("#next"+x).append("<textarea name = 'nex"+x+"' id = 'nex"+x+"' onkeypress = 'guardar_next("+x+",event)'>"+text+"</textarea>");
}

function guardar_next(x,e){
	if(e.keyCode == 13){
		var text = $("#nex"+x).val();
		var id = $("#idreal"+x).text();
		if(id == ""){
			alert("NO HA INGRESADO NINGÚN PASO A SEGUIR !");
			$("#nex"+x).remove();
			$("#estat"+x).append("<span name = 'nex"+x+"' id = 'nex"+x+"' ondblclick = 'editar_next("+x+")'></span>");
		}else{
			$.ajax({
				url:'trafic.php',
				data:{id:id,turno:11,d:text},
				type:'post',
				success:function(){
					$("#nex"+x).remove();
					$("#next"+x).append("<span name = 'nex"+x+"' id = 'nex"+x+"' ondblclick = 'editar_next("+x+")'>"+text+"</span>");
				}
			});
		}
	}
}

function guardar_descripcion(x,e){
	if(e.keyCode == 13){
		var text = $("#descripcion"+x).val();
		var id = $("#idreal"+x).text();
		if(id == ""){
			alert("NO HA INGRESADO NINGÚN ASUNTO !");
			$("#descripcion"+x).remove();
			$("#desc"+x).append("<span name = 'descripcion"+x+"' id = 'descripcion"+x+"' ondblclick = 'editar_descripcion("+x+")'></span>");
		}else{
			$.ajax({
				url:'trafic.php',
				data:{id:id,turno:8,d:text},
				type:'post',
				success:function(){
					$("#descripcion"+x).remove();
					$("#desc"+x).append("<span name = 'descripcion"+x+"' id = 'descripcion"+x+"' ondblclick = 'editar_descripcion("+x+")'>"+text+"</span>");
				}
			});
		}
	}
}

function agregar_descripcion(x){
	$("#descripcion"+x).remove();
	$("#desc"+x).append("<textarea name = 'descripcion"+x+"' id = 'descripcion"+x+"' onkeypress = 'guardar_descripcion("+x+",event)'></textarea>");
}

function listar_deptos(x){
	var text = $("#deptos"+x).val();
	if(text == ""){
		$("#lista_departamentos"+x).html("");
	}else{
		$.ajax({
			url:'trafic.php',
			data:{turno:12,text:text,x:x},
			type:'post',
			success:function(data){
				$("#lista_departamentos"+x).html("");
				$("#lista_departamentos"+x).html(data);
			}
		});
	}
}

function listar_responsables(x){
	var text = $("#respon"+x).val();
	var traf = $("#trafico").text();
	if(text == ""){
		$("#lista_responsable"+x).html("");
	}else{
		$.ajax({
			url:'trafic.php',
			data:{turno:17,text:text,x:x,traf:traf},
			type:'post',
			success:function(data){
				$("#lista_responsable"+x).html("");
				$("#lista_responsable"+x).html(data);
			}
		});
	}
}

function abrir_trafico(x){
	$.ajax({
		url:'trafic.php',
		data:{id:x,turno:7},
		type:'post',
		success:function(){
			location.href = 'trafico.php';
		}
	});
}

function asunto(x,e){
	if(e.keyCode == 13){
		var asunto = $("#asunto"+x).val();
		var traf = $("#trafico").text();
		$.ajax({
			url:'trafic.php',
			data:{turno:6,asunto:asunto,traf:traf},
			type:'post',
			success:function(data){
				$("#asunto"+x).remove();
				$("#asunt"+x).append("<span name = 'asunto"+x+"' id = 'asunto"+x+"' ondblclick = 'agregar_asunto("+x+")'>"+asunto+"</span>");
			}
		});
	}
	
}

function eliminar_departamento_item(x,y){
	var traf = $("#trafico").text();
	var idx = $("#idreal"+x).text();
	$.ajax({
		url:'trafic.php',
		data:{turno:15,y:y,traf:traf,idx:idx},
		type:'post',
		success:function(data){
			$("#depto_"+x+"-"+y).remove();
			//$("#contenedor_traficos").html(data);
		}
	});
}

function eliminar_responsable_item(x,y){
	var traf = $("#trafico").text();
	var idx = $("#idreal"+x).text();
	$.ajax({
		url:'trafic.php',
		data:{turno:20,y:y,traf:traf,idx:idx},
		type:'post',
		success:function(data){
			$("#respon_"+x+"-"+y).remove();
			//$("#contenedor_traficos").html(data);
		}
	});
}

function add_departamento(x){
	var text = $("#deptos"+x).val();
	var traf = $("#trafico").text();
	var idx = $("#idreal"+x).text();
	$.ajax({
		url:'trafic.php',
		data:{turno:14,text:text,traf:traf,idx:idx},
		type:'post',
		success:function(data){
			$("#contenedor_traficos").html("");
			$("#contenedor_traficos").html(data);
		}
	});
}

function add_responsables(x){
	var text = $("#respon"+x).val();
	var traf = $("#trafico").text();
	var idx = $("#idreal"+x).text();
	$.ajax({
		url:'trafic.php',
		data:{turno:18,text:text,traf:traf,idx:idx},
		type:'post',
		success:function(data){
			$("#contenedor_traficos").html("");
			$("#contenedor_traficos").html(data);
		}
	});
}

function select_depto(x){
	var idx = $("#idreal"+x).text();
	var id = $('input:radio[name=dept]:checked').val();
	var text = $('input:radio:checked').next('label:first').html();
	var traf = $("#trafico").text();
	$.ajax({
		url:'trafic.php',
		data:{turno:13,id:id,traf:traf,idx:idx},
		type:'post',
		success:function(data){
			var datos = data.split("*****");
			if(datos[0] == 1){
				$("#contenedor_traficos").html("");
				$("#contenedor_traficos").html(datos[1]);
			}else{
				alert("DEPARTAMENTO YA INGRESADO PARA ESTE ASUNTO");
			}
		}
	});
}

function select_respon(x){
	var idx = $("#idreal"+x).text();
	var id = $('input:radio[name=resp]:checked').val();
	var text = $('input:radio:checked').next('label:first').html();
	var traf = $("#trafico").text();
	$.ajax({
		url:'trafic.php',
		data:{turno:19,id:id,traf:traf,idx:idx},
		type:'post',
		success:function(data){
			var datos = data.split("*****");
			if(datos[0] == 1){
				$("#contenedor_traficos").html("");
				$("#contenedor_traficos").html(datos[1]);
			}else{
				alert("RESPONSABLE YA INGRESADO PARA ESTE ASUNTO");
			}
		}
	});
}

function select_item(){
	var id = $('input:radio[name=nombre]:checked').val();
	var text = $('input:radio:checked').next('label:first').html();
	var num = $("#num").text();
	var emp = $("#emp").text();
	$.ajax({
			url:'trafic.php',
			data:{turno:3,id:id,num:num,emp:emp},
			type:'post',
			success:function(data){
				$("#asistentes_confirmados").html("");
				$("#asistentes_confirmados").html(data);
				$.ajax({
					url:'trafic.php',
					data:{turno:4,num:num,emp:emp},
					type:'post',
					success:function(data){
						$("#asistentes_confirmados").html("");
						$("#asistentes_confirmados").html(data);
						$("#listado_asistentes_existentes").html("");
						$("#asistente").val("");
					}
				});
				
			}
		});
}
/*
function enviar_correos(){
	$.ajax({
		url:'trafic.php',
		data:{turno:23},
		type:'post',
		success:function(data){
			alert(data);
		}
	});
}
*/

function insert_cliente_trafic(id){
	if($("#cliente").val().length > 0){
		$.ajax({
			url:'trafic.php',
			data:{turno:2,cliente:$("#cliente").val(),user:1,producto:$("#producto").val(),und:$("#und").val(),
			asunto:$("#asunto").val(),descc:$("#descc").val(),status:$("#status").val(),fecha:$("#fecha_terminacion_compromiso").val()},
			type:'post',
			success:function(d){
				//$("#contenedor_trafico").html(d);
				location.reload();
			}
		});
	}
}
$(document).ready(function(){
	$("#fecha").datepicker({ dateFormat: 'yy-mm-dd' });
	
	
	$("#nuevo_trafico").dialog({
      autoOpen: false,
      height: "202",
      width: "auto",
      modal: true,
	  resizable: false
    });
	
	$("#correos").dialog({
      autoOpen: false,
      height: "auto",
      width: "690px",
      modal: true,
	  resizable: false
    });
	
	$("#buscar_traficos").dialog({
      autoOpen: false,
      height: "380",
      width: "750",
      modal: true,
	  resizable: false
    });
	
	$("#consultar").on('click',function(){
		$("#buscar_traficos").dialog('open');
	});
	
	$("#nuevo").on('click',function(){
		$("#nuevo_trafico").dialog('open');
	});
	
	$("#cancelar_nuevo").on('click',function(){
		$("#nuevo_trafico").dialog('close');
	});
	
	$("#cancelar_busqueda").on('click',function(){
		$("#buscar_traficos").dialog('close');
	});
		
	$(".ui-dialog-titlebar").hide();
	
	$("#b_empresa").on('change',function(){
		var emp = $("#b_empresa").val();
		$.ajax({
			url:'trafic.php',
			data:{turno:0,emp:emp},
			type:'post',
			success:function(data){
				$("#traficos_x_empresa").html(data);
			}
		});
	});
	
	//Creación de nuevo tráfico.
	$("#crear").on('click',function(){
		var emp = $("#empresa").val();
		var empt = $("#empresa option:selected").text();
		
		var fecha = $("#fecha").val();
		$.ajax({
			url:'trafic.php',
			data:{turno:1,emp:emp,fecha:fecha,empt:empt},
			type:'post',
			success:function(data){
				$("#nuevo_trafico").dialog('close');
				location.href = 'trafico.php';
			}
		});
	});
	
	$("#asistente").on('keyup',function(){
		var asis = $("#asistente").val();
		$.ajax({
			url:'trafic.php',
			data:{turno:2,asis:asis},
			type:'post',
			success:function(data){
				$("#listado_asistentes_existentes").html("");
				$("#listado_asistentes_existentes").html(data);
			}
		});
	});
	
	//Mostrar Correos:
	$("#notificar_todos").on('click',function(){
		var traf = $("#trafico").text();
		$.ajax({
			url:'trafic.php',
			data:{turno:22,traf:traf},
			type:'post',
			success:function(data){
				$("#correos").html("");
				$("#correos").html(data);
				$("#correos").dialog('open');
			}
		});
	});
	
	$("#agregar_asistenten").on('click',function(){
		var nombre = $("#asistente").val();
		var num = $("#num").text();
		var emp = $("#emp").text();
		$.ajax({
			url:'trafic.php',
			data:{turno:5,name:nombre,num:num,emp:emp},
			type:'post',
			success:function(data){
				$("#asistentes_confirmados").html("");
				$("#asistentes_confirmados").html(data);
				$("#listado_asistentes_existentes").html("");
				$("#asistente").val("");
			}
		});
	});
});

function filtrar_por_cliente(){
	
		$.ajax({
			url:'trafic.php',
			data:{turno:1,clie:$("#filtro_cliente").val()},
			type:'post',
			success:function(d){
				$("#contenedor_trafico").html(d);
			}
		});
}

function filtrar_por_empleado(){
	if($("#filtro_cliente").val() == ""){
		location.reload();
	}else{
		$.ajax({
			url:'trafic.php',
			data:{turno:3,empleado:$("#filtro_cliente").val(),name:$("#filtro_cliente option:selected").text()},
			type:'post',
			success:function(d){
				$("#trafico_empleados").html(d);
			}
		});
	}
}

function editar_pendiente(id){
	var proyecto = $("#estatus"+id).text();
	$("#estatus"+id).html("<textarea rows = '4' cols = '65' id = 'xestatus"+id+"'>"+proyecto+"</textarea>");
	
	var proyecto = $("#descr"+id).text();
	$("#descr"+id).html("<textarea rows = '4' cols = '65' id = 'xdescr"+id+"'>"+proyecto+"</textarea>");
	
	var proyecto = $("#asunto"+id).text();
	$("#asunto"+id).html("<textarea rows = '4' cols = '65' id = 'xasunto"+id+"'>"+proyecto+"</textarea>");
	
	var proyecto = $("#fin"+id).text();
	$("#fin"+id).html("<input type = 'text' id = 'xfin"+id+"' value = '"+proyecto+"'/>");
	$("#xfin"+id).datepicker({ dateFormat: 'yy-mm-dd',beforeShowDay: nonWorkingDates,	numberOfMonths: 1,	minDate: '0',firstDay: 1  });
	
	$("#icono_guardar"+id).html("<img src = '../images/iconos/ok_verde.png' width = '25px' onclick = 'update_info("+id+")' />");
}

function update_info(id){
	$.ajax({
		url:'trafic.php',
		data:{turno:4,id:id,estatus:$("#xestatus"+id).val(),descr:$("#xdescr"+id).val(),asunto:$("#xasunto"+id).val(),fin:$("#xfin"+id).val()},
		type:'post',
		success:function(d){
			location.reload();
		}
	});
}

function finalizar(id){
	$.ajax({
		url:'trafic.php',
		data:{turno:5,id:id},
		type:'post',
		success:function(d){
			location.reload();
		}
	});
}
function historico(id){
	$(".historio"+id).toggle();
}