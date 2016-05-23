$(document).ready(function(){
	var largo_tbl_emp = $( "#contenedor_datos_administracion_principal" ).height();
	var ancho_tbl_emp = $( "#contenedor_datos_administracion_principal" ).width();
	var a_por_tbl_emp = (ancho_tbl_emp*98)/100;
	var l_por_tbl_emp = (largo_tbl_emp*80)/100;
	$("#contenedor_tabla_ubicaciones_gestion").css("width",a_por_tbl_emp);
	$("#contenedor_tabla_ubicaciones_gestion").css("height",l_por_tbl_emp);
	var x_largo_aa = $( "#contenedor_tabla_ubicaciones_gestion" ).height();
	var x_ancho_aa = $( "#contenedor_tabla_ubicaciones_gestion" ).width();
	var a_centro_aa = (x_ancho_aa/2)*(-1);
	var l_centro_aa = (x_largo_aa/2)*(-1);
	$("#contenedor_tabla_ubicaciones_gestion").css("margin-left",a_centro_aa);
	$("#contenedor_tabla_ubicaciones_gestion").css("margin-top",l_centro_aa);
	
	
	
	$("#p1").hide();
	$("#p2").hide();
	var largo_ax = $( window ).height();
	var ancho_ax = $( window ).width();
	var a_por_ax = (ancho_ax*40)/100;
	var l_por_ax = (largo_ax*60)/100;
	$("#datos_crear_pais_gestion").css("width","300px");
	$("#datos_crear_pais_gestion").css("height","5px");		
	//Contenedor datos mayor:centrado
	var x_largo_ax = $( "#datos_crear_pais_gestion" ).height();
	var x_ancho_ax = $( "#datos_crear_pais_gestion" ).width();
	var a_centro_ax = (x_ancho_ax/2)*(-1);
	var l_centro_ax = (x_largo_ax/2)*(-1);
	$("#datos_crear_pais_gestion").css("margin-left",a_centro_ax);
	$("#datos_crear_pais_gestion").css("margin-top",l_centro_ax);
	
	
	$("#b_pais").on('keyup',function(){
		var pais = $("#b_pais").val();
		$.ajax({
			url:'gestion_all.php',
			data:{pais:pais,turno:28},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_ubicaciones_gestion").html("");
				$("#contenedor_tabla_ubicaciones_gestion").html(data);
			}
		});
	});
	$("#b_departamento").on('keyup',function(){
		var pais = $("#b_departamento").val();
		$.ajax({
			url:'gestion_all.php',
			data:{pais:pais,turno:29},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_ubicaciones_gestion").html("");
				$("#contenedor_tabla_ubicaciones_gestion").html(data);
			}
		});
	});
	$("#b_ciudad").on('keyup',function(){
		var pais = $("#b_ciudad").val();
		$.ajax({
			url:'gestion_all.php',
			data:{pais:pais,turno:30},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_ubicaciones_gestion").html("");
				$("#contenedor_tabla_ubicaciones_gestion").html(data);
			}
		});
	});
	$("#crear_pais").on('click',function(){
		$("#p1").show();
	});
});