$(document).ready(function(){
	var largo_tbl_emp = $( "#contenedor_datos_administracion_principal" ).height();
	var ancho_tbl_emp = $( "#contenedor_datos_administracion_principal" ).width();
	var a_por_tbl_emp = (ancho_tbl_emp*98)/100;
	var l_por_tbl_emp = (largo_tbl_emp*80)/100;
	$("#contenedor_tabla_depto_gestion").css("width",a_por_tbl_emp);
	$("#contenedor_tabla_depto_gestion").css("height",l_por_tbl_emp);
	var x_largo_aa = $( "#contenedor_tabla_depto_gestion" ).height();
	var x_ancho_aa = $( "#contenedor_tabla_depto_gestion" ).width();
	var a_centro_aa = (x_ancho_aa/2)*(-1);
	var l_centro_aa = (x_largo_aa/2)*(-1);
	$("#contenedor_tabla_depto_gestion").css("margin-left",a_centro_aa);
	$("#contenedor_tabla_depto_gestion").css("margin-top",l_centro_aa);
	
	
	$("#b_empresa").on('keyup',function(){
		var nombre_empresa = $("#b_empresa").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:37,empresa:nombre_empresa},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_depto_gestion").html("");
				$("#contenedor_tabla_depto_gestion").html(data);
			}
		});
	});
	$("#b_depto").on('keyup',function(){
		var departamento = $("#b_depto").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:38,depto:departamento},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_depto_gestion").html("");
				$("#contenedor_tabla_depto_gestion").html(data);
			}
		});
	});
	$("#boton_mostrar_depto_gestion").on('click',function(){
		$.ajax({
			url:'gestion_all.php',
			data:{turno:39},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_depto_gestion").html("");
				$("#contenedor_tabla_depto_gestion").html(data);
			}
		});
	});
	
	$("#e1").hide();
	var largo_ax = $( window ).height();
	var ancho_ax = $( window ).width();
	var a_por_ax = (ancho_ax*30)/100;
	var l_por_ax = (largo_ax*1)/100;
	$("#datos_crear_depto_gestion").css("width","430px");
	$("#datos_crear_depto_gestion").css("height","50px");		
	//Contenedor datos mayor:centrado
	var x_largo_ax = $( "#datos_crear_depto_gestion" ).height();
	var x_ancho_ax = $( "#datos_crear_depto_gestion" ).width();
	var a_centro_ax = (x_ancho_ax/2)*(-1);
	var l_centro_ax = (x_largo_ax/2)*(-1);
	$("#datos_crear_depto_gestion").css("margin-left",a_centro_ax);
	$("#datos_crear_depto_gestion").css("margin-top",l_centro_ax);
	
	$("#e2").hide();
	var largo_a = $( window ).height();
	var ancho_a = $( window ).width();
	var a_por_a = (ancho_a*30)/100;
	var l_por_a = (largo_a*1)/100;
	$("#datos_modificar_depto_gestion").css("width","430px");
	$("#datos_modificar_depto_gestion").css("height","50px");		
	//Contenedor datos mayor:centrado
	var x_largo_a = $( "#datos_modificar_depto_gestion" ).height();
	var x_ancho_a = $( "#datos_modificar_depto_gestion" ).width();
	var a_centro_a = (x_ancho_a/2)*(-1);
	var l_centro_a = (x_largo_a/2)*(-1);
	$("#datos_modificar_depto_gestion").css("margin-left",a_centro_a);
	$("#datos_modificar_depto_gestion").css("margin-top",l_centro_a);
	
	$("#boton_depto_gestion").on('click',function(){
		$("#e1").show();
	});
	$("#n_cancelar_depto_gestion").on('click',function(){
		$("#e1").hide();
	});
	
	$("#c_modificar_depto_gestion").on('click',function(){
		$("#e2").hide();
	});
	
	$("#n_crear_depto_gestion").on('click',function(){
		var empresa = $("#empresa_depto").val();
		var depto = $("#n_depto").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:40,depto:depto,emp:empresa},
			type:'POST',
			success:function(data){
				alert(data);
				document.location.reload();
			}
		});
	});
});
	function cambiar_estado_depto(id){
		var est = $("#tabla_depto_gestion #"+id+" td:nth-child(3)").text();
		var estado = 0;
		if(est == "ACTIVO"){
			estado = 0;
		}else{
			estado = 1;
		}
		$.ajax({
			url:'gestion_all.php',
			data:{turno:41,estado:estado,id:id},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_depto_gestion").html("");
				$("#contenedor_tabla_depto_gestion").html(data);
			}
		});
	}
	function guardar_modificar_dpto(){
		var depto = $("#e_depto").val();
		var id = $("#codigo").text();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:42,depto:depto,id:id},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_depto_gestion").html("");
				$("#contenedor_tabla_depto_gestion").html(data);
				$("#e2").hide();
			}
		});
	}
	function cambiar_nombre_depto(id){
		$("#e_depto").val($("#tabla_depto_gestion #"+id+" td:nth-child(1)").text());
		$("#nombre_empresa").text($("#tabla_depto_gestion #"+id+" td:nth-child(2)").text());
		$("#codigo").text(id);
		$("#e2").show();
	}