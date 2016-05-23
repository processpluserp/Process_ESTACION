$(document).ready(function(){
	var alto = $(window).height();
	var ancho_x = $(window).width();
	var ancho_por = (ancho_x*99)/100;
	var x = (alto*100)/100;
	
	
	
	$("#nuevo_empleado_real").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:4,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#und_empleado").html("");
				$("#und_empleado").html(data);
			}
		});
		$("#form_nuevo_empleado").dialog('open');
		$("#add_e").css("color","#EF8C14");
	});
	$("#nuevo_empleado").on('click',function(){
		$("#simulador_costo_nuevo_empleado").dialog('open');
		/*$.ajax({
			url:'gestion_all2.php',
			data:{t:4,emp:$("#empresa_final").text()},
			type:'post',
			success:function(data){
				$("#und_empleado").html(data);
			}
		});
		$("#form_nuevo_empleado").dialog('open');*/
	});
	$("#cerrar_ventana_simulador").on('click',function(){
		$("#simulador_costo_nuevo_empleado input").val("");
		$("#simulador_costo_nuevo_empleado").dialog('close');
	});
	
	$("#guardar_nombre_simulador").on('click',function(){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:85,name:$("#nombre_simulador").val(),emp:$("#empresa_final").text(),sal:$("#salario_sim").text(),modalidad:$("#modalidad_pago").val()},
			type:'post',
			success:function(data){
				$("#nombre_simulador").val("");
				$("#contenedor_simulador").html(data);
			}
		});
	});
	
	$(".ui-dialog-titlebar").hide();
});

function eliminar_prospecto(id){
	$.ajax({
		url:'gestion_all2.php',
		data:{id:id,t:166},
		type:'post',
		success:function(ata){
			alert("PROSPECTO ELIMINADO");
			$.ajax({
				url:'gestion_all2.php',
				data:{t:87,emp:$("#empresa_final").text()},
				type:'post',
				success:function(data){
					$("#listado_simulaciones").html("");
					$("#listado_simulaciones").html(data);
				}
			});
		}
	});
}
function editar_bonos_sim(x){
	var sb =  $("#b_alimentacion_emp_h").text();
	$("#bono_al_sim").html("<input type = 'text' id = 'bono_nuevo' onkeypress = 'actualizar_bono(event,"+x+")' value = '"+sb+"'/>");
}
function actualizar_bono(e,x){
	if(e.keyCode == 13){
		$.ajax({
			url:'gestion_all2.php',
			data:{t:86,val:$("#bono_nuevo").val(),emp:$("#empresa_final").text(),id:x},
			type:'post',
			success:function(data){
				$("#contenedor_simulador").html(data);
			}
		});
	}
}


