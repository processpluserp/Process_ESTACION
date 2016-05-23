$(document).ready(function(){
	$(function() {
		$.ajax({
			url:'gestion_tarifario.php',
			data:{turno:6},
			type:'post',
			success:function(data){
				$("#contenedor_tarifario").html("");
				$("#contenedor_tarifario").html(data);
			}
		});
	});
	
	$(".form_item_nuevo").hide();
	$(".form_grupo_nuevo").hide();
	$(".form_proveedor_nuevo").hide();
	
	
	$("#form_nuevo_item").on('click',function(){
		$(".form_item_nuevo").show("slow");
		$(".form_grupo_nuevo").hide();
		$(".form_proveedor_nuevo").hide();
	});
	$("#form_nuevo_grupo").on('click',function(){
		$(".form_item_nuevo").hide();
		$(".form_grupo_nuevo").show("slow");
		$(".form_proveedor_nuevo").hide();
	});
	
	$("#form_nuevo_proveedor").on('click',function(){
		$(".form_item_nuevo").hide();
		$(".form_grupo_nuevo").hide();
		$(".form_proveedor_nuevo").show("slow");
	});
	
	//Añadir nuevo grupo
	$("#agregar_grupo").on('click',function(){
		var nombre = $("#nombre_grupo").val();
		$.ajax({
			url:'gestion_tarifario.php',
			data:{turno:1,name:nombre},
			type:'POST',
			success:function(data){
				if(data == 1){
					$("#nombre_grupo").val("");
					alert("SE HA CREADO EL GRUPO:"+nombre);
					$.ajax({
						url:'gestion_tarifario.php',
						data:{turno:4},
						type:'POST',
						success:function(data){
							$("#grupo_option").html("");
							$("#grupo_option").html(data);
							$("#b_grupo").html("");
							$("#b_grupo").html(data);
							location.reload();
						}
					});
				}else{
					alert("SE HA PRODUCCIDO UN ERROR DE CONEXION");
					location.reload();
				}
			}
		});
	});
	
	//Añadir Proveedor
	$("#agregar_proveedor").on('click',function(){
		var nit = $("#nit_pro").val();
		var name = $("#nombre_pro").val();
		$.ajax({
			url:'gestion_tarifario.php',
			data:{turno:2,name:name,nit:nit},
			type:'post',
			success:function(data){
				if(data == 1){
					$(".form_proveedor_nuevo td input").val("");
					alert("SE HA CREADO EL PROVEEDOR:"+name);
					$.ajax({
					url:'gestion_tarifario.php',
					data:{turno:3},
					type:'post',
					success:function(data){
						$("#proveedor").html("");
						$("#proveedor").html(data);
						$("#b_proveedor").html("");
						$("#b_proveedor").html(data);
						location.reload();
					}
					});
				}else{
					alert("SE HA PRODUCCIDO UN ERROR DE CONEXION");
					location.reload();
				}
			}
		});
	});
	
	//Agregar Tarifa
	$("#agregar_tarifa").on('click',function(){
		var emp = $("#empresa").val();
		var pro = $("#proveedor").val();
		var grup = $("#grupo_option").val();
		var tar = $("#tarifa").val();
		var iva = $("#iva").val();
		var vol = $("#vol").val();
		var item = $("#item").val();
		if(item == ""){
			alert("Debe Ingresar el Nombre del Item");
		}else if(tar == "0"){
			alert("El valor dle item no puede ser 0");
		}else{
			$.ajax({
				url:'gestion_tarifario.php',
				data:{turno:5,emp:emp,pro:pro,grup:grup,tar:tar,iva:iva,vol:vol,item:item},
				type:'post',
				success:function(data){
					if(data == 1){
						alert("ITEM GUARDADO");
						$(".form_item_nuevo input").val("");
						$("#iva").val("16");
						location.reload();
					}
				}
			});
		}
		
	});
	
	//Cambio empresa
	$("#b_emp").on('change',function(){
		var emp = $("#b_emp").val();
		$.ajax({
			url:'gestion_tarifario.php',
			data:{turno:7,emp:emp},
			type:'post',
			success:function(data){
				$("#contenedor_tarifario").html("");
				$("#contenedor_tarifario").html(data);
			}
		});
	});
	
	//Cambio Proveedor
	$("#b_proveedor").on('change',function(){
		var emp = $("#b_proveedor").val();
		$.ajax({
			url:'gestion_tarifario.php',
			data:{turno:8,emp:emp},
			type:'post',
			success:function(data){
				$("#contenedor_tarifario").html("");
				$("#contenedor_tarifario").html(data);
			}
		});
	});
	
	//Cambio Grupo
	$("#b_grupo").on('change',function(){
		var emp = $("#b_grupo").val();
		$.ajax({
			url:'gestion_tarifario.php',
			data:{turno:9,emp:emp},
			type:'post',
			success:function(data){
				$("#contenedor_tarifario").html("");
				$("#contenedor_tarifario").html(data);
			}
		});
	});
	
	//Cambio Nombre
	$("#nombre_item").on('keyup',function(){
		var emp = $("#nombre_item").val();
		$.ajax({
			url:'gestion_tarifario.php',
			data:{turno:10,emp:emp},
			type:'post',
			success:function(data){
				$("#contenedor_tarifario").html("");
				$("#contenedor_tarifario").html(data);
			}
		});
	});
});