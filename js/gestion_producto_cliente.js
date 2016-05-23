$(document).ready(function(){
	
	$("#p1").hide();
	var largo_aa = $( window ).height();
	var ancho_aa = $( window ).width();
	var a_por_aa = (ancho_aa*20)/100;
	var l_por_aa = (largo_aa*70)/100;
	$("#datos_crear_producto_cliente_gestion").css("width","320px");
	$("#datos_crear_producto_cliente_gestion").css("height","320px");		
	//Contenedor datos mayor:centrado
	var x_largo_aa = $( "#datos_crear_producto_cliente_gestion" ).height();
	var x_ancho_aa = $( "#datos_crear_producto_cliente_gestion" ).width();
	var a_centro_aa = (x_ancho_aa/2)*(-1);
	var l_centro_aa = (x_largo_aa/2)*(-1);
	$("#datos_crear_producto_cliente_gestion").css("margin-left",a_centro_aa);
	$("#datos_crear_producto_cliente_gestion").css("margin-top",l_centro_aa);
	
	
	var largo_tbl_emp = $( "#contenedor_datos_administracion_principal" ).height();
	var ancho_tbl_emp = $( "#contenedor_datos_administracion_principal" ).width();
	var a_por_tbl_emp = (ancho_tbl_emp*98)/100;
	var l_por_tbl_emp = (largo_tbl_emp*80)/100;
	$("#contenedor_tabla_productos_cliente_gestion").css("width",a_por_tbl_emp);
	$("#contenedor_tabla_productos_cliente_gestion").css("height",l_por_tbl_emp);
	var x_largo_aa = $( "#contenedor_tabla_productos_cliente_gestion" ).height();
	var x_ancho_aa = $( "#contenedor_tabla_productos_cliente_gestion" ).width();
	var a_centro_aa = (x_ancho_aa/2)*(-1);
	var l_centro_aa = (x_largo_aa/2)*(-1);
	$("#contenedor_tabla_productos_cliente_gestion").css("margin-left",a_centro_aa);
	$("#contenedor_tabla_productos_cliente_gestion").css("margin-top",l_centro_aa);
	
	$("#boton_crear_producto_cliente_gestion").on('click',function(){
		$("#p1").show();
	});
	
	
	$("#n_producto_cliente").on('keyup',function(){
		var nombre = $("#n_producto_cliente").val();
		$.ajax({
			url:'gestion_all.php',
			data:{nombre:nombre,turno:16},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_productos_cliente_gestion").html("");
				$("#contenedor_tabla_productos_cliente_gestion").append(data);
			}
		});
	});
	$("#b_cliente_producto").on('change',function(){
		var nombre = $("#b_cliente_producto").val();
		$.ajax({
			url:'gestion_all.php',
			data:{nombre:nombre,turno:17},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_productos_cliente_gestion").html("");
				$("#contenedor_tabla_productos_cliente_gestion").append(data);
			}
		});
	});
	$("#boton_mostrar_productos_cliente_gestion").on('click',function(){
		$.ajax({
			url:'gestion_all.php',
			data:{turno:18},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_productos_cliente_gestion").html("");
				$("#contenedor_tabla_productos_cliente_gestion").append(data);						
			}
		});
	});
	$("#n_cancelar_producto_clientes_gestion").on('click',function(){
		$("#tabla_datos_nuevo_producto_cliente input").val("");
		$("#tabla_datos_nuevo_producto_cliente select").val("");
		$("#p1").hide();
	});
	$("#n_crear_producto_cliente_gestion").on('click',function(){
		var nombre = $("#n_nombre_producto").val();
		var cliente = $("#n_cliente_producto").val();
		$.ajax({
			url:'gestion_all.php',
			data:{name:nombre,cliente:cliente,turno:19},
			type:'POST',
			success:function(data){
				$("#tabla_datos_nuevo_producto_cliente input").val("");
				$("#tabla_datos_nuevo_producto_cliente select").val("");
				$("#p1").hide();
				$("#contenedor_tabla_productos_cliente_gestion").html("");
				$("#contenedor_tabla_productos_cliente_gestion").append(data);
			}
		});
	});
});
	function cambiar_estado_producto_cliente(id){
		var dato = $("#tabla_contenedor_info_productos_cliente #"+id+" td:nth-child(3)").text();
		var valor = 0;
		if(dato == "INACTIVO"){
			valor = 1;
		}else{
			valor = 0;
		}
		$.ajax({
			url:'gestion_all.php',
			data:{turno:20,estado:valor,id:id},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_productos_cliente_gestion").html("");
				$("#contenedor_tabla_productos_cliente_gestion").append(data);	
			}
		});
	}