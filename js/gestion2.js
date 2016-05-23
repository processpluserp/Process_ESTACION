$(document).ready(function(){
	$("#cancelar_crear_empleado").on('click',function(){
		$("#form_nuevo_empleado select").val("vacio");
		$("#form_nuevo_empleado input").val("");
		$("#foto_empleado").val("");
		$("#foto").html("");
		$("#form_nuevo_empleado").dialog('close');
		$("#add_e").css("color","black");
	});
	$("#cancelar_crear_inv_tec").on('click',function(){
		$("#crear_item_tecnologia input").val('');
		$("#crear_item_tecnologia select").val('vacio');
		$("#crear_item_tecnologia").dialog('close');
	});
	
	$("#opciones_info_empleado").dialog({
	  autoOpen: false,
      height: "100",
      width: "400",
	  resizable: false
    });
	$("#personal_down_contenedor").dialog({
	  autoOpen: false,
      height: "800",
      width: "95%",
	  resizable: false,
	  modal:true
    });
	
	$("#hoja_inventario_empleado").dialog({
	  autoOpen: false,
      height: "700",
      width: "800",
	  resizable: false,
	  modal:true
    });
	/*$("#inventario_equipo_empleado").on('click',function(){
		
	});*/
	
	$("#crear_item_muebles").dialog({
	  autoOpen: false,
      height: "400",
      width: "800",
	  resizable: false
    });
	$("#ingresar_nuevo_inventario_muebles").on('click',function(){
		$("#crear_item_muebles").dialog('open');
	});
	$("#cancelar_crear_muebles").on('click',function(){
		$("#crear_item_muebles input").val('');
		$("#crear_item_muebles select").val('vacio');
		$("#crear_item_muebles").dialog('close');
	});
	
	$("#crear_muebles").on('click',function(){
		data = new FormData();
		data.append('desc',$("#desc").val());
		data.append('turno',56);
		data.append('val_hoy',$("#val_hoy").val());
		data.append('val_compra',$("#val_compra").val());
		data.append('quien',$("#quien").val());
		data.append('factura',$("#factura").val());
		data.append('empresa_muebles_n',$("#empresa_muebles_n").val());
		data.append('area_empresa_muebles',$("#area_empresa_muebles").val());
		$.ajax({
			url:'gestion_all.php',
			data:data,
			type:'post',
			contentType:false, //Debe estar en false para que pase el objeto sin procesar
			processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
			success:function(data){
				$("#crear_item_muebles input").val('');
				$("#crear_item_muebles select").val('vacio');
				$("#crear_item_muebles").dialog('close');
				alert("SE HA CREADO EL NUEVO ITEM");
				$("#contenedor_tabla_muebles").html("");
				$("#contenedor_tabla_muebles").html(data);
			}
		});
	});
	
	$("#empresa_inventario_muebles").on('click',function(){
		var emp = $("#empresa_inventario_muebles").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:57, emp:emp},
			type:'post',
			success:function(data){
				$("#contenedor_tabla_muebles").html("");
				$("#contenedor_tabla_muebles").html(data);
			}
		});
	});
	$(".ui-dialog-titlebar").hide();
	
	
	$("#empresa_muebles_n").on('click',function(){
		var emp = $("#empresa_muebles_n").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:55,emp:emp},
			type:'post',
			success:function(data){
				$("#area_empresa_muebles").html("");
				$("#area_empresa_muebles").html(data);
			}
		});
	});
	
	$("#crear_inv_tect").on('click',function(){
		var data = new FormData();
		data.append('turno',52);
		data.append('emp',$("#empresa_inv_tecnologia").val());
		data.append('plataforma',$("#plataforma").val());
		data.append('tipo',$("#tipo").val());
		data.append('empleado_inv_tecnologia',$("#empleado_inv_tecnologia").val());
		data.append('marca',$("#marca").val());
		data.append('modelo',$("#modelo").val());
		data.append('s_modelo',$("#s_modelo").val());
		data.append('monitor',$("#monitor").val());
		data.append('s_monitor',$("#s_monitor").val());
		data.append('teclado',$("#teclado").val());
		data.append('s_teclado',$("#s_teclado").val());
		data.append('mouse',$("#mouse").val());
		data.append('s_mouse',$("#s_mouse").val());
		data.append('dd',$("#dd").val());
		data.append('memoria',$("#memoria").val());
		data.append('procesador',$("#procesador").val());
		data.append('velocidad',$("#velocidad").val());
		data.append('drive',$("#drive").val());
		$.ajax({
			url:'gestion_all.php',
			data:data,
			type:'post',
			contentType:false, //Debe estar en false para que pase el objeto sin procesar
			processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
			success:function(data){
				$("#crear_item_tecnologia input").val('');
				$("#crear_item_tecnologia select").val('vacio');
				$("#crear_item_tecnologia").dialog('close');
				alert("Item Creado");
				$("#contenedor_tabla_inv_tecnologia").html("");
				$("#contenedor_tabla_inv_tecnologia").html(data);
				
			}
		});
		
	});
	
	$("#empresa_inventario_tec").on('change',function(){
		var emp =  $("#empresa_inventario_tec").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:53,emp:emp},
			type:'post',
			success:function(data){
				$("#contenedor_tabla_inv_tecnologia").html("");
				$("#contenedor_tabla_inv_tecnologia").html(data);
			}
		});
	});
	
	$("#plataforma_inventario_tec").on('click',function(){
		var emp =  $("#empresa_inventario_tec").val();
		var pla = $("#plataforma_inventario_tec").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:54,emp:emp,pla:pla},
			type:'post',
			success:function(data){
				$("#contenedor_tabla_inv_tecnologia").html("");
				$("#contenedor_tabla_inv_tecnologia").html(data);
			}
		});
	});
	
	$("#crear_empleado").on('click',function(){
		var campos = 0;
		if($("#foto_empleado").val() == ""){
			alert("SIN FOTO NO SE PUEDE GUARDAR EL EMPLEADO");
		}else{
			var data = new FormData();
			//data.append('fecha_retiro_empleado',$("#fecha_retiro_empleado").val());
			//data.append('motivo_retiro',$("#motivo_retiro").val());
			data.append('correo_personal',$("#correo_personal").val());
			data.append('name',$("#nombre_complet").val());
			data.append('emp',$("#empresa_final").text());
			data.append('td',$("#tipo_doc_empleado").val());
			data.append('cedula',$("#num_cedula_empleado").val());
			data.append('und',$("#und_empleado").val());
			data.append('area',$("#departamento_empleado").val());
			data.append('cargo',$("#cargo_empleado").val());
			data.append('eps',$("#eps").val());
			data.append('rh',$("#rh").val());
			data.append('correo',$("#correo").val());
			data.append('arl',$("#arl").val());
			data.append('sexo',$('input:radio[name=sexo]:checked').val());
			data.append('fnacimiento',$("#fecha_nacimiento_empleado").val());
			data.append('fingreso',$("#fecha_ingreso_empleado").val());
			data.append('direccion',$("#direccion_empleado").val());
			data.append('fpension',$("#fondo_pensiones").val());
			data.append('phone_casa',$("#phone_casa").val());
			data.append('fcesantias',$("#fondo_cesantias").val());
			data.append('celular',$("#celular_empleado").val());
			data.append('caja',$("#caja_compensacion").val());
			
			data.append('contacto_emergencia',$("#person_contacto").val());
			data.append('num_contacto',$("#num_person_contacto").val());
			var num_hijos = $("#num_hijos").val();
			data.append('hijos',$("#num_hijos").val());
			
			for(var i = 0; i< num_hijos; i++){
				data.append('name'+i,$("#name"+i).val());
				data.append('fn'+i,$("#fn"+i).val());
			}
			
			data.append('salario_base_empleado',$("#salario_base_empleado").val());
			data.append('bonos_alimentacion',$("#bonos_alimentacion").val());
			data.append('bnp',$("#bnp").val());
			data.append('otros_salario',$("#otros_salario").val());
			var file = $("#foto_empleado")[0].files[0];
			data.append('empleado_foto',file.name);	
			data.append('turno',50);
			$.ajax({
				url:'gestion_all.php',
				data:data,
				type:'post',
				contentType:false, //Debe estar en false para que pase el objeto sin procesar
				processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
				success:function(data){
					$("#form_nuevo_empleado select").val("vacio");
					$("#form_nuevo_empleado input").val("");
					$("#form_nuevo_empleado").dialog('close');
					$("#contenedo_tabla_muestra_empleados").html("");
					$("#contenedo_tabla_muestra_empleados").html(data);
				}
			});
		}
		
	});
	/*
	$("#empresa_empleado").on('change',function(){
		var emp = $("#empresa_empleado").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:55,emp:emp},
			type:'post',
			success:function(data){
				$("#departamento_empleado").html("");
				$("#departamento_empleado").html(data);
			}
		});
	});
	*/
	$("#empresa_inv_tecnologia").on('change',function(){
		var emp = $("#empresa_inv_tecnologia").val();
		$.ajax({
			url:'gestion_all.php',
			data:{emp:emp,turno:51},
			type:'post',
			success:function(data){
				$("#empleado_inv_tecnologia").html("");
				$("#empleado_inv_tecnologia").html(data);
			}
		});
	});
	
	$("#mostrar_todo_empleados").on('click',function(){
		$.ajax({
			url:'gestion_all.php',
			data:{turno:59},
			type:'post',
			success:function(data){
				$("#contenedor_tabla_empleados").html("");
				$("#contenedor_tabla_empleados").html(data);
			}
		});
	});
	
	$("#personal_down").on('click',function(){
		var emp = $("#empresa_final").text();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:62,emp:emp},
			type:'post',
			success:function(data){
				$("#personal_down_contenedor").html(data);
				$("#personal_down_contenedor").dialog('open');
			}
		});
	});
});

function cambiar_estado_empleado_gestion(x){
	var estado = ($("#contenedor_tabla_empleados #"+x+" td:nth-child(8)").text());
	var est = 0;
	if(estado == "ACTIVO"){
		est = 0;
	}else{
		est = 1;
	}
	$.ajax({
		url:'gestion_all.php',
		data:{turno:58,id:x,est:est},
		type:'post',
		success:function(data){
			$("#contenedor_tabla_empleados").html("");
			$("#contenedor_tabla_empleados").html(data);
		}
	});
}
function mostrar_informacion_empleado(x,y){
	$.ajax({
			url:'gestion_all.php',
			data:{turno:60,id:x,emp:y},
			type:'post',
			success:function(data){
				//$("#info_basica_empleado").html(data);
				//$("#info_basica_empleado").dialog('open');
			}
		});
		
}

