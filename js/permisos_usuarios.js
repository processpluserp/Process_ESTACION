$(document).ready(function(){
	$("#agregar_permiso_empresa").on('click',function(){
		var usu = $("#usuario").val();
		var emp = $("#empresa").val();
		var asig = $("#id_usuario").text();
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:1,usu:usu,emp:emp,asig:asig},
			type:'POST',
			success:function(data){
				alert(data);
				$("#contenedor_permisos").html("");
			}
		});
	});
	
	$("#agregar_permiso_cliente").on('click',function(){
		var usu = $("#usuario_cliente").val();
		var asig = $("#id_usuario").text();
		var clie = $("#cliente").val();
		var emp = $("#empresa_clie").val();
		var pclie = $("#producto_cliente").val();
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:5,usu:usu,clie:clie,asig:asig,pclie:pclie,emp:emp},
			type:'POST',
			success:function(data){
				alert(data);
				$("#contenedor_permisos").html("");
			}
		});
	});
	
	$("#usuario").on('change',function(){
		var usu = $("#usuario").val();
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:2,usu:usu},
			type:'POST',
			success:function(data){
				$("#contenedor_permisos").html("");
				$("#contenedor_permisos").html(data);
			}
		});
	});
	
	$("#usuario_cliente").on('change',function(){
		$("#empresa_clie").html("");
		$("#cliente").html("");
		$("#producto_cliente").html("");
		var usu = $("#usuario_cliente").val();
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:6,usu:usu},
			type:'POST',
			success:function(data){
				$("#contenedor_permisos").html("");
				$("#contenedor_permisos").html(data);
			}
		});
	});
	
	$("#cliente").on('change',function(){
		$("#producto_cliente").html("");
		var clie = $("#cliente").val();
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:4,cliente:clie},
			type:'POST',
			success:function(data){
				$("#producto_cliente").html("");
				$("#producto_cliente").html(data);
			}
		});
	});
	
	$("#usuario_depto").on('change',function(){
		$("#departamento_general").html("");
		var usu = $("#usuario_depto").val();
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:100,usu:usu},
			type:'POST',
			success:function(data){
				$("#empresa_depto").html("");
				$("#empresa_depto").html(data);
			}
		});	
	});
	
	$("#agregar_permiso_director").on('click',function(){
		var usu = $("#usuario_direc").val();
		var asig = $("#id_usuario").text();
		var direc = $("#director").val();
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:13,usu:usu,asig:asig,direc:direc},
			type:'POST',
			success:function(data){
				alert(data);
			}
		});	
	});
	
	$("#agregar_permiso_rol").on('click',function(){
		var usu = $("#usuario_rol").val();
		var rol = $("#rol").val();
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:14,usu:usu,rol:rol},
			type:'POST',
			success:function(data){
				alert(data);
			}
		});	
	});
	
	$("#usuario_cliente").on('change',function(){
		var usu = $("#usuario_cliente").val();
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:100,usu:usu},
			type:'POST',
			success:function(data){
				$("#empresa_clie").html("");
				$("#empresa_clie").html(data);
			}
		});	
	});
	
	$("#empresa_clie").on('change',function(){
		$("#cliente").html("");
		$("#producto_cliente").html("");
		var emp = $("#empresa_clie").val();
		$("#cliente").html("");
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:101,emp:emp},
			type:'POST',
			success:function(data){
				$("#cliente").html("");
				$("#cliente").html(data);
			}
		});	
	});
	
	$("#usuario_r").on('change',function(){
		var usu = $("#usuario_r").val();
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:100,usu:usu},
			type:'POST',
			success:function(data){
				$("#empresa_depto_r").html("");
				$("#empresa_depto_r").html(data);
			}
		});	
	});
	$("#usuario_a").on('change',function(){
		var usu = $("#usuario_a").val();
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:100,usu:usu},
			type:'POST',
			success:function(data){
				$("#empresa_depto_a").html("");
				$("#empresa_depto_a").html(data);
			}
		});	
	});
	
	$("#empresa_depto").on('change',function(){
		var emp = $("#empresa_depto").val();
		var usu = $("#usuario_depto").val();
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:8,emp:emp,usu:usu},
			type:'POST',
			success:function(data){
				$("#departamento_general").html("");
				$("#departamento_general").html(data);
			}
		});
	});
	
	$("#agregar_permiso_depto").on('click',function(){
		var usu = $("#usuario_depto").val();
		var asig = $("#id_usuario").text();
		var depto = $("#departamento_general").val();
		var emp = $("#empresa_depto").val();
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:9,usu:usu,depto:depto,asig:asig,emp:emp},
			type:'POST',
			success:function(data){
				alert(data);
				$("#contenedor_permisos").html("");
			}
		});
	});
	
	$("#empresa_depto_r").on('change',function(){
		var emp = $("#empresa_depto_r").val();
		$("#departamento_general_r").html("");
		$("#responsable").html("");
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:8,emp:emp},
			type:'POST',
			success:function(data){
				$("#departamento_general_r").html("");
				$("#departamento_general_r").html(data);
			}
		});
	});
	
	$("#empresa_depto_a").on('change',function(){
		$("#departamento_general_a").html("");
		$("#asignado").html("");
		var emp = $("#empresa_depto_a").val();
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:8,emp:emp},
			type:'POST',
			success:function(data){
				$("#departamento_general_a").html("");
				$("#departamento_general_a").html(data);
			}
		});
	});
	
	
	
	$("#departamento_general_r").on('change',function(){
		var emp = $("#empresa_depto_r").val();
		var depto = $("#departamento_general_r").val();
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:10,depto:depto,emp:emp},
			type:'POST',
			success:function(data){
				$("#responsable").html("");
				$("#responsable").html(data);
			}
		});
	});
	
	$("#departamento_general_a").on('change',function(){
		var emp = $("#empresa_depto_a").val();
		var depto = $("#departamento_general_a").val();
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:10,depto:depto,emp:emp},
			type:'POST',
			success:function(data){
				$("#asignado").html("");
				$("#asignado").html(data);
			}
		});
	});
	
	$("#agregar_permiso_responsable").on('click',function(){
		var usu = $("#usuario_r").val();
		var asig = $("#id_usuario").text();
		var depto = $("#departamento_general_r").val();
		var emp = $("#empresa_depto_r").val();
		var respon = $("#responsable").val();
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:11,usu:usu,depto:depto,asig:asig,emp:emp,respon:respon},
			type:'POST',
			success:function(data){
				alert(data);
				$("#contenedor_permisos").html("");
			}
		});
	});
	
	$("#agregar_permiso_asignado").on('click',function(){
		var usu = $("#usuario_a").val();
		var asig = $("#id_usuario").text();
		var depto = $("#departamento_general_r").val();
		var emp = $("#empresa_depto_r").val();
		var respon = $("#asignado").val();
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:12,usu:usu,depto:depto,asig:asig,emp:emp,respon:respon},
			type:'POST',
			success:function(data){
				alert(data);
				$("#contenedor_permisos").html("");
			}
		});
	});
	
});
	function eliminar_permiso(id){
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:3,id:id},
			type:'POST',
			success:function(data){
				alert(data);
				$("#contenedor_permisos").html("");
			}
		});
	}
	function eliminar_permisos_cliente(id){
		$.ajax({
			url:'gestion_permisos_usuarios.php',
			data:{turno:7,id:id},
			type:'POST',
			success:function(data){
				alert(data);
				$("#contenedor_permisos").html("");
			}
		});
	}