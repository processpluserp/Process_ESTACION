$(document).ready(function(){
	$("#p1").hide();
	
	var largo_ar = $( window ).height();
	var ancho_ar = $( window ).width();
	var a_por_ar = (ancho_ar*40)/100;
	var l_por_ar = (largo_ar*60)/100;
	$("#datos_modificar_proveedor_gestion").css("width","400px");
	$("#datos_modificar_proveedor_gestion").css("height","400px");		
	//Contenedor datos mayor:centrado
	var x_largo_ar = $( "#datos_modificar_proveedor_gestion" ).height();
	var x_ancho_ar = $( "#datos_modificar_proveedor_gestion" ).width();
	var a_centro_ar = (x_ancho_ar/2)*(-1);
	var l_centro_ar = (x_largo_ar/2)*(-1);
	$("#datos_modificar_proveedor_gestion").css("margin-left",a_centro_ar);
	$("#datos_modificar_proveedor_gestion").css("margin-top",l_centro_ar);
	
	$("#p2").hide();
	var largo_ax = $( window ).height();
	var ancho_ax = $( window ).width();
	var a_por_ax = (ancho_ax*40)/100;
	var l_por_ax = (largo_ax*60)/100;
	$("#datos_crear_proveedor_gestion").css("width","700px");
	$("#datos_crear_proveedor_gestion").css("height","400px");		
	//Contenedor datos mayor:centrado
	var x_largo_ax = $( "#datos_crear_proveedor_gestion" ).height();
	var x_ancho_ax = $( "#datos_crear_proveedor_gestion" ).width();
	var a_centro_ax = (x_ancho_ax/2)*(-1);
	var l_centro_ax = (x_largo_ax/2)*(-1);
	$("#datos_crear_proveedor_gestion").css("margin-left",a_centro_ax);
	$("#datos_crear_proveedor_gestion").css("margin-top",l_centro_ax);
	
	
	$("#boton_crear_proveedores_gestion").on('click',function(){
		
		$("#p1").show();
	});
	
	var largo_tbl_emp = $( "#contenedor_datos_administracion_principal" ).height();
	var ancho_tbl_emp = $( "#contenedor_datos_administracion_principal" ).width();
	var a_por_tbl_emp = (ancho_tbl_emp*98)/100;
	var l_por_tbl_emp = (largo_tbl_emp*80)/100;
	$("#contenedor_tabla_proveedores_gestion").css("width",a_por_tbl_emp);
	$("#contenedor_tabla_proveedores_gestion").css("height",l_por_tbl_emp);
	var x_largo_aa = $( "#contenedor_tabla_proveedores_gestion" ).height();
	var x_ancho_aa = $( "#contenedor_tabla_proveedores_gestion" ).width();
	var a_centro_aa = (x_ancho_aa/2)*(-1);
	var l_centro_aa = (x_largo_aa/2)*(-1);
	$("#contenedor_tabla_proveedores_gestion").css("margin-left",a_centro_aa);
	$("#contenedor_tabla_proveedores_gestion").css("margin-top",l_centro_aa);
	
	$("#b_nit_proveedor").on('keyup',function(){
		var nit = $("#b_nit_proveedor").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:21,nit:nit},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_proveedores_gestion").html("");
				$("#contenedor_tabla_proveedores_gestion").append(data);
			}
		});
	});
	$("#b_nombre_proveedor").on('keyup',function(){
		var nit = $("#b_nombre_proveedor").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:22,nlegal:nit},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_proveedores_gestion").html("");
				$("#contenedor_tabla_proveedores_gestion").append(data);
			}
		});
	});
	$("#boton_mostrar_proveedores_gestion").on('click',function(){
		$.ajax({
			url:'gestion_all.php',
			data:{turno:23},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_proveedores_gestion").html("");
				$("#contenedor_tabla_proveedores_gestion").append(data);
			}
		});
	});
	$("#n_nit_proveedor").on('keyup',function(){
		var nit = $("#n_nit_proveedor").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:24,nit:nit},
			type:'POST',
			success:function(data){
				if(data == 0){
					$("#nit_ingresado_proveedor").html("");
					$("#nit_ingresado_proveedor").removeClass();
					$("#nit_ingresado_proveedor").html("El Nit que ha ingresado está libre");
					$("#nit_ingresado_proveedor").addClass("mensaje_ingresado_bueno");
					$("#n_crear_proveedor_gestion").show();
				}else if(data == 1){
					$("#nit_ingresado_proveedor").html("");
					$("#nit_ingresado_proveedor").removeClass();
					$("#nit_ingresado_proveedor").html("El Nit "+nit+" ya está asignado a un Cliente");
					$("#nit_ingresado_proveedor").addClass("mensaje_ingresado_malo");
					$("#n_crear_proveedor_gestion").hide();
				}
			}
		});
	});
	$("#n_pais_proveedor").on('change',function(){
		var pais = $("#n_pais_proveedor").val();
		$.ajax({
			url:'gestion_all.php',
			data:{p:pais,turno:6},
			type:'POST',
			success:function(data){
				$("#n_departamento_proveedor").html(data);
			}
		});
	});
	$("#n_departamento_proveedor").on('change',function(){
		var departamento = $("#n_departamento_proveedor").val();
		$.ajax({
			url:'gestion_all.php',
			data:{d:departamento,turno:7},
			type: 'POST',
			success:function(data){
				$("#n_ciudad_proveedor").html(data);
			}
		});
	});
	$("#n_cancelar_proveedores_gestion").on('click',function(){
		$("#tabla_datos_nuevo_proveedor input").val("");
		$("#tabla_datos_nuevo_proveedor select").val("");
		$("#p1").hide();
	});
	$("#n_crear_proveedor_gestion").on('click',function(){
		var nit = $("#n_nit_proveedor").val();
		var nlegal = $("#n_nlegal_proveedor").val();
		var ncomercial = $("#n_ncomercial_proveedor").val();
		var direccion = $("#n_direccion_proveedor").val();
		var telefono = $("#n_telefono_proveedor").val();
		var correo = $("#n_correo_proveedor").val();
		var pais = $("#n_pais_proveedor").val();
		var depto = $("#n_departamento_proveedor").val();
		var ciudad = $("#n_ciudad_proveedor").val();
		
		var e_asoc = [];
		var c_prov_check=document.getElementsByName("empresas_proveedor");
		for(var i=0;i<c_prov_check.length;i++){
			if(c_prov_check[i].checked){
				e_asoc.push(c_prov_check[i].value);
			}
		}
		
		$.ajax({
			url:'gestion_all.php',
			data:{
				nit:nit,
				nlegal:nlegal,
				ncomercial:ncomercial,
				direccion:direccion,
				telefono:telefono,
				correo:correo,
				pais:pais,
				depto:depto,
				ciudad:ciudad,
				e_asoc:e_asoc,
				turno:25
			},
			type:'POST',
			success:function(data){
				alert("SE HA CREADO EL PROVEEDOR "+nlegal);
				$("#tabla_datos_nuevo_proveedor input").val("");
				$("#tabla_datos_nuevo_proveedor select").val("");
				$("#p1").hide();
				$("#contenedor_tabla_proveedores_gestion").html("");
				$("#contenedor_tabla_proveedores_gestion").append(data);
			}
		});
	});
	$("#n_modificar_proveedor_gestion").on('click',function(){
		var nit = $("#e_nit_proveedor").val();
		var nlegal = $("#e_nombre_legal_proveedor").val();
		var ncomercial = $("#e_nombre_comercial_proveedor").val();
		var phone = $("#e_telefono_proveedor").val();
		var direc = $("#e_direccion_proveedor").val();
		var correo = $("#e_correo_proveedor").val();
		$.ajax({
			url:'gestion_all.php',
			data:{turno:27,nit:nit,nlegal:nlegal,ncomer:ncomercial,phone:phone,direc:direc,correo:correo},
			type:'POST',
			success:function(data){
				$("#tabla_datos_modificar_proveedor input").val("");
				$("#tabla_datos_modificar_proveedor select").val("");
				$("#p2").hide();
				$("#contenedor_tabla_proveedores_gestion").html("");
				$("#contenedor_tabla_proveedores_gestion").append(data);
			}
		});
	});
	$("#n_cancelar_modificar_proveedor_gestion").on('click',function(){
		$("#tabla_datos_modificar_proveedor input").val("");
		$("#tabla_datos_modificar_proveedor select").val("");
		$("#p2").hide();
	});
	
});
	function cambiar_estado_proveedor(id){
		var est = $("#tabla_contenedor_info_proveedores #"+id+" td:nth-child(8)").text();
		var nit = $("#tabla_contenedor_info_proveedores #"+id+" td:nth-child(1)").text();
		var valor = 0;
		if(est == "INACTIVO"){
			valor = 1;
		}else{
			valor = 0;
		}
		$.ajax({
			url:'gestion_all.php',
			data:{
				turno:26,esta:valor,nii:nit,id:id},
			type:'POST',
			success:function(data){
				$("#contenedor_tabla_proveedores_gestion").html("");
				$("#contenedor_tabla_proveedores_gestion").append(data);
			}
		});
	}
	
	function editar_proveedor(id){
		$("#e_nit_proveedor").val($("#tabla_contenedor_info_proveedores #"+id+" td:nth-child(1)").text());
		$("#e_nombre_legal_proveedor").val($("#tabla_contenedor_info_proveedores #"+id+" td:nth-child(2)").text());
		$("#e_nombre_comercial_proveedor").val($("#tabla_contenedor_info_proveedores #"+id+" td:nth-child(3)").text());
		$("#e_telefono_proveedor").val($("#tabla_contenedor_info_proveedores #"+id+" td:nth-child(5)").text());
		$("#e_correo_proveedor").val($("#tabla_contenedor_info_proveedores #"+id+" td:nth-child(6)").text());
		$("#e_direccion_proveedor").val($("#tabla_contenedor_info_proveedores #"+id+" td:nth-child(4)").text());
		$("#p2").show();
	}