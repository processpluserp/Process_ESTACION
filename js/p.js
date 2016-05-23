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
	
	
	$("#b_empresa").on('keyup',function(){
		var nombre_empresa = $("#b_empresa").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:37,empresa:nombre_empresa},
			type:'POST',
			success:function(data){
				//alert(nombre_empresa);
				$("#contenedor_tabla_depto_gestion").html("");
				$("#contenedor_tabla_depto_gestion").html(data);
			}
		});
	});
});