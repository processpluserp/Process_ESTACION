$(document).ready(function(){
	$("#e1").hide();
	var largo_ax = $( window ).height();
	var ancho_ax = $( window ).width();
	var a_por_ax = (ancho_ax*30)/100;
	var l_por_ax = (largo_ax*1)/100;
	$("#datos_crear_ceco_gestion").css("width","430px");
	$("#datos_crear_ceco_gestion").css("height","50px");		
	//Contenedor datos mayor:centrado
	var x_largo_ax = $( "#datos_crear_ceco_gestion" ).height();
	var x_ancho_ax = $( "#datos_crear_ceco_gestion" ).width();
	var a_centro_ax = (x_ancho_ax/2)*(-1);
	var l_centro_ax = (x_largo_ax/2)*(-1);
	$("#datos_crear_ceco_gestion").css("margin-left",a_centro_ax);
	$("#datos_crear_ceco_gestion").css("margin-top",l_centro_ax);
	
	$("#e2").hide();
	var largo_ax = $( window ).height();
	var ancho_ax = $( window ).width();
	var a_por_ax = (ancho_ax*30)/100;
	var l_por_ax = (largo_ax*1)/100;
	$("#datos_modificar_ceco_gestion").css("width","430px");
	$("#datos_modificar_ceco_gestion").css("height","50px");		
	//Contenedor datos mayor:centrado
	var x_largo_ax = $( "#datos_modificar_ceco_gestion" ).height();
	var x_ancho_ax = $( "#datos_modificar_ceco_gestion" ).width();
	var a_centro_ax = (x_ancho_ax/2)*(-1);
	var l_centro_ax = (x_largo_ax/2)*(-1);
	$("#datos_modificar_ceco_gestion").css("margin-left",a_centro_ax);
	$("#datos_modificar_ceco_gestion").css("margin-top",l_centro_ax);
	
	var largo_tbl_emp = $( "#contenedor_datos_administracion_principal" ).height();
	var ancho_tbl_emp = $( "#contenedor_datos_administracion_principal" ).width();
	var a_por_tbl_emp = (ancho_tbl_emp*98)/100;
	var l_por_tbl_emp = (largo_tbl_emp*80)/100;
	$("#contenedor_tabla_ceco_gestion").css("width",a_por_tbl_emp);
	$("#contenedor_tabla_ceco_gestion").css("height",l_por_tbl_emp);
	var x_largo_aa = $( "#contenedor_tabla_ceco_gestion" ).height();
	var x_ancho_aa = $( "#contenedor_tabla_ceco_gestion" ).width();
	var a_centro_aa = (x_ancho_aa/2)*(-1);
	var l_centro_aa = (x_largo_aa/2)*(-1);
	$("#contenedor_tabla_ceco_gestion").css("margin-left",a_centro_aa);
	$("#contenedor_tabla_ceco_gestion").css("margin-top",l_centro_aa);
	
	$("#b_empresa").on('keyup', function(){
		var empresa = $("#b_empresa").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:31, empresa:empresa},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_ceco_gestion").html("");
				$("#contenedor_tabla_ceco_gestion").html(data);
			}
		});
	});
	$("#b_ceco").on('keyup', function(){
		var empresa = $("#b_ceco").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:32, empresa:empresa},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_ceco_gestion").html("");
				$("#contenedor_tabla_ceco_gestion").html(data);
			}
		});
	});
	$("#boton_mostrar_ceco_gestion").on('click', function(){
		$.ajax({
			url:'gestion_all.php',
			data:{turno:33},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_ceco_gestion").html("");
				$("#contenedor_tabla_ceco_gestion").html(data);
			}
		});
	});
	$("#boton_ceco_gestion").on('click', function(){
		$("#e1").show();
	});
	$("#n_cancelar_ceco_gestion").on('click', function(){
		$("#e1").hide();
	});
	
	$("#n_crear_ceco_gestion").on('click', function(){
		var emp = $("#empresa_ceco").val();
		var nombre = $("#n_ceco").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:34,emp:emp,nombre:nombre},
			type:'POST',
			success:function(data){
				alert("SE HA CREADO EL CECO "+nombre);
				document.location.reload();
			}
		});
	});
	$("#e_crear_ceco_gestion").on('click',function(){
		var name = $("#e_ceco").val();
		var codigo = $("#cod_ceco").text();
		$.ajax({
			url:'gestion_all.php',
			data:{name:name,turno:35,cod:codigo},
			type:'POST',
			success:function(data){
				alert("CENTRO DE COSTO MODIFICADO");
				document.location.reload();
				$("#e_ceco").val("");
				$("#e2").hide();
			}
		});
	});
	$("#e_cancelar_ceco_gestion").on('click',function(){
		$("#emp_ceco").html("");
		$("#cod_ceco").html("");
		$("#e_ceco").val("");
		$("#e2").hide();
	});
	
});
	function editar_ceco_gestion(id){
		$("#emp_ceco").html($("#tabla_ceco_gestion_x #"+id+" td:nth-child(1)").text());
		$("#cod_ceco").html($("#tabla_ceco_gestion_x #"+id+" td:nth-child(2)").text());
		$("#e_ceco").val($("#tabla_ceco_gestion_x #"+id+" td:nth-child(3)").text());
		$("#e2").show();
	}
	function editar_estado_ceco_gestion(id){
		var est = $("#tabla_ceco_gestion_x #"+id+" td:nth-child(4)").text();
		var estado = 0;
		if(est == "ACTIVO"){
			estado = 0;
		}else{
			estado = 1;
		}
		$.ajax({
			url:'gestion_all.php',
			data:{turno:36,id:id,est:estado},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_ceco_gestion").html("");
				$("#contenedor_tabla_ceco_gestion").html(data);
			}
		});
	}