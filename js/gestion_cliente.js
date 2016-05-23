$(document).ready(function(){
	//CONTENEDOR INFORMACIÓN EMPRESA (MUESTRA DATOS)
	var largo_tbl_emp = $( "#contenedor_datos_administracion_principal" ).height();
	var ancho_tbl_emp = $( "#contenedor_datos_administracion_principal" ).width();
	var a_por_tbl_emp = (ancho_tbl_emp*98)/100;
	var l_por_tbl_emp = (largo_tbl_emp*80)/100;
	$("#contenedor_tabla_cliente_gestion").css("width",a_por_tbl_emp);
	$("#contenedor_tabla_cliente_gestion").css("height",l_por_tbl_emp);
	var x_largo_aa = $( "#contenedor_tabla_cliente_gestion" ).height();
	var x_ancho_aa = $( "#contenedor_tabla_cliente_gestion" ).width();
	var a_centro_aa = (x_ancho_aa/2)*(-1);
	var l_centro_aa = (x_largo_aa/2)*(-1);
	$("#contenedor_tabla_cliente_gestion").css("margin-left",a_centro_aa);
	$("#contenedor_tabla_cliente_gestion").css("margin-top",l_centro_aa);
	
	$("#c1").hide();
	$("#c2").hide();
	
	var largo_aa = $( window ).height();
	var ancho_aa = $( window ).width();
	var a_por_aa = (ancho_aa*40)/100;
	var l_por_aa = (largo_aa*70)/100;
	$("#datos_crear_cliente_gestion").css("width","650px");
	$("#datos_crear_cliente_gestion").css("height","500px");		
	//Contenedor datos mayor:centrado
	var x_largo_aa = $( "#datos_crear_cliente_gestion" ).height();
	var x_ancho_aa = $( "#datos_crear_cliente_gestion" ).width();
	var a_centro_aa = (x_ancho_aa/2)*(-1);
	var l_centro_aa = (x_largo_aa/2)*(-1);
	$("#datos_crear_cliente_gestion").css("margin-left",a_centro_aa);
	$("#datos_crear_cliente_gestion").css("margin-top",l_centro_aa);
	
	var largo_ax = $( window ).height();
	var ancho_ax = $( window ).width();
	var a_por_ax = (ancho_ax*40)/100;
	var l_por_ax = (largo_ax*70)/100;
	$("#datos_modificar_cliente_gestion").css("width","650px");
	$("#datos_modificar_cliente_gestion").css("height","500px");		
	//Contenedor datos mayor:centrado
	var x_largo_ax = $( "#datos_modificar_cliente_gestion" ).height();
	var x_ancho_ax = $( "#datos_modificar_cliente_gestion" ).width();
	var a_centro_ax = (x_ancho_ax/2)*(-1);
	var l_centro_ax = (x_largo_ax/2)*(-1);
	$("#datos_modificar_cliente_gestion").css("margin-left",a_centro_ax);
	$("#datos_modificar_cliente_gestion").css("margin-top",l_centro_ax);
	
	$("#boton_crear_cliente_gestion").on("click",function(){
		$("#n_guardar_cliente_gestion").hide();
		$("#c1").show();
	});
	
	$("#nit_cliente_gestion").on('keyup',function(){
		var nit = $("#nit_cliente_gestion").val();
		var estado = "";
		var porNombre=document.getElementsByName("estado_cliente_gestion");
		for(var i=0;i<porNombre.length;i++){
			if(porNombre[i].checked)
				estado=porNombre[i].value;
		}
		$.ajax({
			url:'gestion_all.php',
			data:{nit:nit,estado:estado,turno:9},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_cliente_gestion").html("");
				$("#contenedor_tabla_cliente_gestion").append(data);
			}
		});
	});
	$("#nombre_cliente_gestion").on('keyup',function(){
		var nombre = $("#nombre_cliente_gestion").val();
		var estado = "";
		var porNombre=document.getElementsByName("estado_cliente_gestion");
		for(var i=0;i<porNombre.length;i++){
			if(porNombre[i].checked)
				estado=porNombre[i].value;
		}
		$.ajax({
			url:'gestion_all.php',
			data:{name:nombre,estado:estado,turno:10},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_cliente_gestion").html("");
				$("#contenedor_tabla_cliente_gestion").append(data);
			}
		});
	});
	
	$("#n_nit_cliente").on('keyup',function(){
		var nit = $("#n_nit_cliente").val();
		$.ajax({
			url:'gestion_all.php',
			data:{nit:nit,turno:11},
			type:'POST',
			success:function(data){
				if(data == "0"){
					$("#n_guardar_cliente_gestion").show();
					$("#nit_ingresado_cliente").html("EL NIT LIBRE");
				}else{
					$("#nit_ingresado_cliente").html("EL NIT YA SE HA INGRESADO");
					$("#n_guardar_cliente_gestion").hide();
				}
			}
		});
	});
	
	$("#n_pais_cliente").on('change',function(){
		var pais = $("#n_pais_cliente").val();
		$.ajax({
			url:'gestion_all.php',
			data:{p:pais,turno:6},
			type:'POST',
			success:function(data){
				$("#n_departamento_cliente").html(data);
			}
		});
	});
	$("#n_departamento_cliente").on('change',function(){
		var departamento = $("#n_departamento_cliente").val();
		$.ajax({
			url:'gestion_all.php',
			data:{d:departamento,turno:7},
			type: 'POST',
			success:function(data){
				$("#n_ciudad_cliente").html(data);
			}
		});
	});
	$("#n_cancelar_cliente_gestion").on('click',function(){
		$("#tabla_datos_nuevo_cliente input[type = 'text']").each(function(){
			$(this).val("");
		});
		
		$(".info_empresas_asociadas input[type = 'text']").each(function(){
			$(this).val("");
		});
		$(".info_empresas_asociadas input[type = 'checkbox']").each(function(){
			$(this).attr('checked', false);
		});
		$("#c1").hide();
	});
	$("#n_guardar_cliente_gestion").on('click',function(){
		var p_campos = [];
		var datos_ubicacion = [];
		var t_asoc =[];
		var e_asoc = [];
		$("#tabla_datos_nuevo_cliente input[type = 'text']").each(function(){
			p_campos.push($(this).val());
		});
		$("#tabla_datos_nuevo_cliente select").each(function(){
			datos_ubicacion.push($(this).val());
		});
		$(".info_empresas_asociadas input[type = 'text']").each(function(){
			if($(this).val() != ""){
				t_asoc.push($(this).val());
			}
		});
		var porNombre=document.getElementsByName("empresas_clientes");
		for(var i=0;i<porNombre.length;i++){
			if(porNombre[i].checked)
				e_asoc.push(porNombre[i].value);
		}
		$.ajax({
			url:'gestion_all.php',
			data:{
				turno:12,
				primeros:p_campos,
				ubicacion:datos_ubicacion,
				asoc:t_asoc,
				asoc_1:e_asoc},
			type:'POST',
			success:function(data){
				alert(data);
				$("#c1").hide();
				document.location.reload();
			}
		});
	});
	$("#boton_mostrar_cliente_gestion").on('click',function(){
		$.ajax({
			url:'gestion_all.php',
			data:{turno:13},
			type: 'POST',
			success:function(data){
				$("#contenedor_tabla_cliente_gestion").html("");
				$("#contenedor_tabla_cliente_gestion").append(data);
			}
		});
	});
	$("#n_cancelar_modificar_empresa_gestion").on('click',function(){
		$("#e_nit_cliente").val("");
		$("#e_nombre_legal_cliente").val("");
		$("#e_nombre_comercial_cliente").val("");
		$("#e_telefono_cliente").val("");
		$("#e_direccion_cliente").val("");
		$("#c2").hide();
	});
	$("#n_modificar_empresa_gestion").on('click',function(){
		var n_nit = $("#e_nit_cliente").val();
		var n_legal = $("#e_nombre_legal_cliente").val();
		var n_comercial = $("#e_nombre_comercial_cliente").val();
		var n_telefono = $("#e_telefono_cliente").val();
		var n_direccion = $("#e_direccion_cliente").val();
		$.ajax({
			url:'gestion_all.php',
			data:{nit:n_nit,
			legal:n_legal,
			comercial:n_comercial,
			phone:n_telefono,
			direc:n_direccion,
			turno:14},
			type:'POST',
			success:function(data){
				alert(data);
				document.location.reload();
			}
		});
	});
});
	function editar_cliente_gestion(id){
		$("#e_nit_cliente").val($("#tabla_contenedor_info_cliente #"+id+" > td:first-child").text());
		$("#e_nombre_legal_cliente").val($("#tabla_contenedor_info_cliente #"+id+" > td:nth-child(2)").text());
		$("#e_nombre_comercial_cliente").val($("#tabla_contenedor_info_cliente #"+id+" > td:nth-child(3)").text());
		$("#e_telefono_cliente").val($("#tabla_contenedor_info_cliente #"+id+" > td:nth-child(4)").text());
		$("#e_direccion_cliente").val($("#tabla_contenedor_info_cliente #"+id+" > td:nth-child(5)").text());
		$("#c2").show();
	}
	function cambiar_estado_cliente(id){
		var t_estado = $("#tabla_contenedor_info_cliente #"+id+" td:nth-child(7)").text();
		var cliente = $("#tabla_contenedor_info_cliente #"+id+" td:nth-child(1)").text();
		var estado = 0;
		if(t_estado == "INACTIVO"){
			estado = 1;
		}else{
			estado = 0;
		}
		$.ajax({
			url:'gestion_all.php',
			data:{turno:15,est:estado,nit:cliente},
			type: 'POST',
			success:function(data){
				$("#contenedor_tabla_cliente_gestion").html("");
				$("#contenedor_tabla_cliente_gestion").append(data);
			}
		});
	}