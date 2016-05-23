$(document).ready(function(){
	
	var largo_tbl_emp = $( "#contenedor_datos_administracion_principal" ).height();
	var ancho_tbl_emp = $( "#contenedor_datos_administracion_principal" ).width();
	var a_por_tbl_emp = (ancho_tbl_emp*98)/100;
	var l_por_tbl_emp = (largo_tbl_emp*80)/100;
	$("#contenedor_tabla_usu_gestion").css("width",a_por_tbl_emp);
	$("#contenedor_tabla_usu_gestion").css("height",l_por_tbl_emp);
	var x_largo_aa = $( "#contenedor_tabla_usu_gestion" ).height();
	var x_ancho_aa = $( "#contenedor_tabla_usu_gestion" ).width();
	var a_centro_aa = (x_ancho_aa/2)*(-1);
	var l_centro_aa = (x_largo_aa/2)*(-1);
	$("#contenedor_tabla_usu_gestion").css("margin-left",a_centro_aa);
	$("#contenedor_tabla_usu_gestion").css("margin-top",l_centro_aa);
	
	
	/*
	var largo_ax = $( window ).height();
	var ancho_ax = $( window ).width();
	var a_por_ax = (ancho_ax*30)/100;
	var l_por_ax = (largo_ax*1)/100;
	$("#datos_crear_usuario_gestion").css("width","430px");
	$("#datos_crear_usuario_gestion").css("height","50px");		
	//Contenedor datos mayor:centrado
	var x_largo_ax = $( "#datos_crear_usuario_gestion" ).height();
	var x_ancho_ax = $( "#datos_crear_usuario_gestion" ).width();
	var a_centro_ax = (x_ancho_ax/2)*(-1);
	var l_centro_ax = (x_largo_ax/2)*(-1);
	$("#datos_crear_usuario_gestion").css("margin-left",a_centro_ax);
	$("#datos_crear_usuario_gestion").css("margin-top",l_centro_ax);
*/
	
	$("#b_empresa").on('keyup',function(){
		var empresa = $("#b_empresa").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:43,empresa:empresa},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_usu_gestion").html("");
				$("#contenedor_tabla_usu_gestion").html(data);
			}
		});
	});
	$("#b_nick").on('keyup',function(){
		var empresa = $("#b_nick").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:44,empresa:empresa},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_usu_gestion").html("");
				$("#contenedor_tabla_usu_gestion").html(data);
			}
		});
	});
	$("#boton_mostrar_usuario_gestion").on('click',function(){
		$.ajax({
			url:'gestion_all.php',
			data:{turno:45},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_usu_gestion").html("");
				$("#contenedor_tabla_usu_gestion").html(data);
			}
		});
	});
	/*
	$("#empresa").on('change',function(){
		var emp = $("#empresa").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:46,emp:emp},
			type:'POST',
			success:function(data){
				$("#depto").html("");
				$("#depto").html(data);
			}
		});
	});
	*/
	
});