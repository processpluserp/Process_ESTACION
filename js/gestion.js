function mostrar_informacion_item_invtec(x){
	$.ajax({
			url:'gestion_all.php',
			data:{turno:61,id:x},
			type:'post',
			success:function(data){
				$("#hoja_inventario_empleado").html(data);
				$("#hoja_inventario_empleado").dialog('open');
			}
		});
}

$(document).ready(function(){
	$(".h_empresa").hide();
	$(".hh_empresa").hide();
	$(".hh_documentos").hide();
	$(".h_empleados").hide();
	$(".hh_inventario").hide();
	$("#documentos_legales_x_empresa").hide();
	$("#informacion_empleados").hide();
	$("#informacion_invetarios_x_empresa").hide();
	$("#inv_tecnoligia").hide();
	$("#c_caf_aseo").hide();
	$("#c_muebles").hide();
	$("#c_be").hide();
	$("#c_bi").hide();
	$(".hh_empleados").hide();
	
	$("#p_empresa").on('click',function(){
		$("#p_empresa").css("color","#EF8C14");
		if($(".h_empresa").is(":visible")){
			$(".h_empresa").hide("fast");
		}else{
			$(".h_empresa").show("slow");
			$("#datos_generales_empresa").show("slow");
			$("#documentos_legales_x_empresa").hide('fast');
		}
	});
	
	$("#ver_empresa").on('click',function(){
		$("#datos_generales_empresa").show();
		$("#informacion_invetarios_x_empresa").hide();
		$("#documentos_legales_x_empresa").hide();
		
		$(".hh_inventario").hide("fast");
		$("#inventarios td:nth-child(2)").html("");
		$("#inventarios").css("color","black");
		$("#inventarios td:nth-child(2)").html("<div class = 'arrow-down'></div>");
		
		$(".hh_documentos").hide("fast");
		$("#docu_legales td:nth-child(2)").html("");
		$("#docu_legales").css("color","black");
		$("#docu_legales td:nth-child(2)").html("<div class = 'arrow-down'></div>");
		
		if($(".hh_empresa").is(":visible")){
			$(".hh_empresa").hide("fast");
			$("#ver_empresa td:nth-child(2)").html("");
			$("#ver_empresa").css("color","black");
			$("#ver_empresa td:nth-child(2)").html("<div class = 'arrow-down'></div>");
		}else{
			$("#ver_empresa").css("color","#EF8C14");
			$(".hh_empresa").show("slow");
			$("#ver_empresa td:nth-child(2)").html("");
			$("#ver_empresa td:nth-child(2)").html("<div class = 'arrow-up'></div>");
		}		
	});
	$("#p_empleados").on('click',function(){
		$(".h_empresa").hide();
		$(".hh_empresa").hide();
		$("#docu_legales").hide();
		$("#h_empresa").hide();
		$("#inventarios").css("color","black");
		$(".hh_inventario").hide();
		$(".hh_documentos").hide();
		$("#inv_tecnoligia").hide();
		$("#tecnologia").css("color","black");
		$("#caf_aseo").css("color","black");
		$("#be").css("color","black");
		$("#muebles").css("color","black");
		$("#bi").css("color","black");
		$("#c_caf_aseo").hide();
		$("#c_muebles").hide();
		$("#c_be").hide();
		$("#c_bi").hide();
		
		$(".h_empleados").show();
		$(".h_empleados").css("color","#EF8C14");
		$("#informacion_empleados").show();
		$("#datos_generales_empresa").hide();
		
		$("#p_empresa").css("color","black");
		$("#p_empleados").css("color","#EF8C14");
	});
	
	$("#ver_empleados").on('click',function(){
		if($(".hh_empleados").is(":visible")){
			$(".hh_empleados").hide();
			$("#ver_empleados td:nth-child(2)").html("");
			$("#ver_empleados td:nth-child(2)").html("<div class = 'arrow-down'></div>");
		}else{
			$(".hh_empleados").show();
			$("#ver_empleados td:nth-child(2)").html("");
			$("#ver_empleados td:nth-child(2)").html("<div class = 'arrow-up'></div>");
		}
	});
	
	$("#docu_legales").on('click',function(){
		$(".hh_empresa").hide("fast");
		$("#ver_empresa td:nth-child(2)").html("");
		$("#ver_empresa").css("color","black");
		$("#ver_empresa td:nth-child(2)").html("<div class = 'arrow-down'></div>");
		
		$(".hh_inventario").hide("fast");
		$("#inventarios td:nth-child(2)").html("");
		$("#inventarios").css("color","black");
		$("#inventarios td:nth-child(2)").html("<div class = 'arrow-down'></div>");
		
		$("#datos_generales_empresa").hide();
		$("#informacion_invetarios_x_empresa").hide();
		$("#documentos_legales_x_empresa").show();
		
		if($(".hh_documentos").is(":visible")){
			$("#docu_legales").show("slow");
			$("#docu_legales").css("color","black");
			$("#docu_legales td:nth-child(2)").html("<div class = 'arrow-down'></div>");
			$(".hh_documentos").hide("fast");
		}else{
			$("#docu_legales td:nth-child(2)").html("<div class = 'arrow-up'></div>");
			$("#docu_legales").css("color","#EF8C14");
			$(".hh_documentos").show("slow");
		}
	});
	
	$("#inventarios").on('click',function(){
		$("#datos_generales_empresa").hide();
		$("#informacion_invetarios_x_empresa").show();
		$("#documentos_legales_x_empresa").hide();
		
		$(".hh_empresa").hide("fast");
		$("#ver_empresa td:nth-child(2)").html("");
		$("#ver_empresa").css("color","black");
		$("#ver_empresa td:nth-child(2)").html("<div class = 'arrow-down'></div>");
		
		$(".hh_documentos").hide("fast");
		$("#docu_legales td:nth-child(2)").html("");
		$("#docu_legales").css("color","black");
		$("#docu_legales td:nth-child(2)").html("<div class = 'arrow-down'></div>");
		
		if($(".hh_inventario").is(":visible")){
			$("#inventarios").show("slow");
			$("#inventarios").css("color","black");
			$("#inventarios td:nth-child(2)").html("<div class = 'arrow-down'></div>");
			$(".hh_inventario").hide("fast");
		}else{			
			$("#inventarios td:nth-child(2)").html("<div class = 'arrow-up'></div>");
			$("#inventarios").css("color","#EF8C14");
			$(".hh_inventario").show("slow");
		}
	});
	
	$("#tecnologia").on('click',function(){
		$("#inv_tecnoligia").show();
		$("#tecnologia").css("color","#EF8C14");
		$("#caf_aseo").css("color","black");
		$("#be").css("color","black");
		$("#muebles").css("color","black");
		$("#bi").css("color","black");
		$("#c_caf_aseo").hide();
		$("#c_muebles").hide();
		$("#c_be").hide();
		$("#c_bi").hide();		
	});
	$("#caf_aseo").on('click',function(){
		$("#inv_tecnoligia").hide();
		$("#caf_aseo").css("color","#EF8C14");
		$("#tecnologia").css("color","black");
		$("#muebles").css("color","black");
		$("#be").css("color","black");
		$("#bi").css("color","black");
		$("#c_caf_aseo").show();
		$("#c_muebles").hide();
		$("#c_be").hide();
		$("#c_bi").hide();	
	});
	$("#muebles").on('click',function(){
		$("#inv_tecnoligia").hide();
		$("#caf_aseo").css("color","black");
		$("#tecnologia").css("color","black");
		$("#muebles").css("color","#EF8C14");
		$("#be").css("color","black");
		$("#bi").css("color","black");
		$("#c_caf_aseo").hide();
		$("#c_muebles").show();
		$("#c_be").hide();
		$("#c_bi").hide();	
	});
	
	
	
	
	$("#n_pais_empresa").on('change',function(){
		var pais = $("#n_pais_empresa").val();
		$.ajax({
			url:'gestion_all.php',
			data:{p:pais,turno:6},
			type:'POST',
			success:function(data){
				$("#n_departamento_empresa").html(data);
			}
		});
	});
	$("#n_departamento_empresa").on('change',function(){
		var departamento = $("#n_departamento_empresa").val();
		$.ajax({
			url:'gestion_all.php',
			data:{d:departamento,turno:7},
			type: 'POST',
			success:function(data){
				$("#n_ciudad_empresa").html(data);
			}
		});
	});
	
});
	function select_cliente(){
		var emp = $("#grupo_empresas").val();
		$.ajax({
			url: 'gestion_all.php',
			data:{empresa:emp},
			type: 'POST',
			success:function (data){
				$("#cliente").html(data);
			}
		});
	}
	