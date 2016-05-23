function cerrar_sesion(){
	/*
		Mediante Ajax, cierro la sesion que tengo abierta en php,
		y luego redireccione a la página que de logeo.
	*/
	$.ajax({
		url:'gestion_all.php',
		data:{turno:0},
		type:'post',
		success:function(data){
			location.href="../logeo.php";
		}
	});
}

function redireccionar(){
	var pagina = "../logeo.php";
	$("#contenedor_datos_usuario_logeo").html("");
	setTimeout("location.href='../logeo.php'", 100);
}


$(document).ready(function(){
	
	$(".cambio_c").hide();
	
	/*
		A todas las transacciones que realice vía Ajax le asigno el Spinner correspondiente
		para que mientras se realice cada consulta se observa dicha imagen.
	*/
	jQuery.ajaxSetup({
		beforeSend: function() {
			$('#spinner').show();
		},
		complete: function(){
			$('#spinner').hide();
		 },
		success: function() {}
	});
	
	$(window).resize(function() {
		
	});
	
	
	/*
		Accion del botton de cancelar la asignación de contraseña.
	*/
	$("#cancelar_c").on('click',function(){
		
		$(".normal_c").show();
		$(".cambio_c").hide();
		$("#n_contrasena,#c_contrasena").css({"border":"2px solid white"});
		$("#contenedor_mensaje_error").html("");
	});
	
	/*
		Mediante este botton valido que se pueda poner la nueva contraseña del usuario.
		Si los campos de nueva contraseña y confirmación de contraseña están vacíos, genero una alerta.
		
		Si los campos de nueva contraseña y confirmación de contraseña contiene datos diferetes, genero una alerta.
		
		Si los campos de nueva contraseña y confirmación de contraseña son iguales, envío esta información vía Ajax para
		que en la base de datos se actualice esta información y se genera un mensaje indicandole al usuario que ingrese los datos de 
		logeo normal para acceder a la plataforma.
	*/
	
	$("#guardar_contrasena_nueva").on('click',function(){
		if($("#n_contrasena").val().length == 0 && $("#c_contrasena").val().length == 0){
			$("#n_contrasena,#c_contrasena").css({"border":"2px solid red"});
			$("#contenedor_mensaje_error").html("<div id ='mensaje_error' style = 'width:'100%';padding:5px;'><span>INGRESE LOS DATOS REQUERIDOS !</span></div>");
		}else if($("#n_contrasena").val() != $("#c_contrasena").val() ){
			$("#contenedor_mensaje_error").html("<div id ='mensaje_error' style = 'width:'100%';padding:5px;'><span>LAS CONTRASEÑAS NO COINDICEN !</span></div>");
		}else if($("#n_contrasena").val() == $("#c_contrasena").val()){
			$.ajax({
				url:'usuario.php',
				data:{t:3,pass:$("#n_contrasena").val(),usu:$("#usuario").val()},
				type:'post',
				success:function(dat){
					$(".normal_c").show();
					$(".cambio_c").hide();
					$("#n_contrasena,#c_contrasena").css({"border":"2px solid white"});
					$("#contenedor_mensaje_error").html("");
					alert("CONTRASEÑA GUARDADA ! \nREALICE SU LOGIN NORMALMENTE.");
				}
			});
		}
	});
	
	
	/*
		Se encarga de validar que la información de logeo de Usuario y contraseña sea correcta.
	*/
	$("#entrar_logeo").on('click',function(){
		if($("#password").val().length == 0 && $("#usuario").val().length == 0){
			$("#contenedor_mensaje_error").html("<div id ='mensaje_error' style = 'width:'100%';padding:5px;'><span>INGRESE LOS DATOS DE LOGEO PARA INGRESAR AL SISTEMA !</span></div>");
			$("#password,#usuario").css({"border":"2px solid red"});
		}else if($("#password").val().length == 0 && $("#usuario").val().length > 0){
			$("#password,#usuario").css({"border":"2px solid white"});
			$.ajax({
				url:'usuario.php',
				data:{t:1,usuario:$("#usuario").val()},
				type:'post',
				success:function(data){
					if(data == 1){
						alert("INGRESE SU NUEVA CONTRASEÑA");
						$(".normal_c").hide();
						$(".cambio_c").show();						
					}else{
						$("#contenedor_mensaje_error").html("<div id ='mensaje_error' style = 'width:'100%';padding:5px;'><span>HA INGRESADO LOS DATOS MAL, INTENTE NUEVAMENTE</span></div>");
					}
				}
			});
		}else if($("#password").val().length != 0 && $("#usuario").val().length == 0){
			$("#contenedor_mensaje_error").html("<div id ='mensaje_error' style = 'width:'100%';padding:5px;'><span>HA INGRESADO LOS DATOS MAL, INTENTE NUEVAMENTE</span></div>");
		}else{
			$.ajax({
				url:'usuario.php',
				data:{t:2,usuario:$("#usuario").val(),password:$("#password").val()},
				type:'post',
				success:function(data){
					if(data == 1){
						window.location.href = 'Vista/bienvenida.php';
					}else{
						$("#contenedor_mensaje_error").html("<div id ='mensaje_error' style = 'width:'100%';padding:5px;'><span>HA INGRESADO LOS DATOS MAL!</br>INTENTE NUEVAMENTE O COMUNÍQUESE CON EL ADMINISTRADOR</span></div>");
					}
				}
			});
			
		}
	});
	//Contenedor datos mayor:
	var mv_largo =$( window ).height();
	var mv_ancho = $( window ).width();
	
	
	var largo = mv_largo;//$( window ).height();
	var ancho = mv_ancho;//$( window ).width();
	var a_por = (ancho*95)/100;
	var l_por = (largo*40)/100;
	/*$("#contenedor_datos_mayor").css("width",a_por);
	$("#contenedor_datos_mayor").css("height",l_por);
	
	//Contenedor datos mayor:centrado
	var x_largo = $( "#contenedor_datos_mayor" ).height();
	var x_ancho = $( "#contenedor_datos_mayor" ).width();
	var a_centro = (x_ancho/2)*(-1);
	var l_centro = (x_largo/2)*(-1);
	$("#contenedor_datos_mayor").css("margin-left",a_centro);
	$("#contenedor_datos_mayor").css("margin-top",l_centro);
	
	
	//Tabla de Logeo
	var largo_xxx = mv_largo;//$( window ).height();
	var ancho_xxx = mv_ancho;//$( window ).width();
	var a_por_xxx = (ancho_xxx*95)/100;
	var l_por_xxx = (largo_xxx*40)/100;
	$("#tabla_logeo").css("width",a_por_xxx);
	$("#tabla_logeo").css("height",l_por_xxx);
	var x_largo_x = $( "#tabla_logeo" ).height();
	var x_ancho_x = $( "#tabla_logeo" ).width();
	var a_centro_x = (x_ancho_x/2)*(-1);
	var l_centro_x = (x_largo_x/2)*(-1);
	$("#tabla_logeo").css("margin-left",a_centro_x);
	$("#tabla_logeo").css("margin-top",l_centro_x);
	
	*/
	//Tabla de Menus
	var largo_xx = 1024;//$( window ).height();
	var ancho_xx = 780;//$( window ).width();
	var a_por_xx = (ancho_xx*95)/100;
	var l_por_xx = (largo_xx*25)/100;
	$("#menu_inicio").css("width",a_por_xx);
	$("#menu_inicio").css("height",l_por_xx);
	var x_largo_xyx = $( "#menu_inicio" ).height();
	var x_ancho_xyx = $( "#menu_inicio" ).width();
	var a_centro_xyx = (x_ancho_xyx/2)*(-1);
	var l_centro_xyx = (x_largo_xyx/2)*(-1);
	$("#menu_inicio").css("margin-left",a_centro_xyx);
	$("#menu_inicio").css("margin-top",l_centro_xyx);
	
	
		
	var largo_img2 = $( "#tabla_contenedora_datos_usuario" ).height();
	var l_por_img2 = (largo_img2*25)/100;	
	$("#img_logo2").css("height",l_por_img2);
	
	
	
	//Footer
	/*var a_por_f = (ancho*40)/100;
	var l_por_f = (largo*2)/100;
	//$("#mensaje_error").css("width",a_por_f);
	$("#mensaje_error").css("height",l_por_f);
	var x_largo_f = $( "#mensaje_error" ).height();
	var x_ancho_f = $( "#mensaje_error" ).width();
	var a_centro_f = (x_ancho_f/2)*(-1);
	var l_centro_f = (x_largo_f/2)*(-1);
	$("#mensaje_error").css("margin-left",a_centro_f);
	$("#mensaje_error").css("margin-top",l_centro_f);*/
	
	
	
	//DATOS DEL INICIO:
	var largo = $( window ).height();
	var ancho = $( window ).width();
	//Cabecera de Inicio
	var a_por_barra = (ancho*99.9)/100;
	var l_por_barra = (largo*20)/100;
	$("#contenedor_cabecera_info").css("width",a_por_barra);
	$("#contenedor_cabecera_info").css("height",l_por_barra);
	var x_largo_barra = $( "#contenedor_cabecera_info" ).height();
	var x_ancho_barra = $( "#contenedor_cabecera_info" ).width();
	var a_centro = (x_ancho_barra/2)*(-1);
	var l_centro = (x_largo_barra/2)*(-1);
	$("#contenedor_cabecera_info").css("margin-left",a_centro);
	$("#contenedor_cabecera_info").css("margin-top",l_centro);
	
	//Div que contiene los datos de loge de usuario
	var a_por_barra_usuario = (ancho*35)/100;
	var l_por_barra_usuario = (largo*0.1)/100;
	$("#tabla_contenedora_datos_usuario").css("width",a_por_barra_usuario);
	$("#tabla_contenedora_datos_usuario").css("height",l_por_barra_usuario);
	var x_largo_barra_usuario = $( "#contenedor_datos_mayor" ).height();
	var x_ancho_barra_usuario = $( "#contenedor_datos_mayor" ).width();
	var a_centro_barra_usuario = (x_ancho_barra_usuario/2)*(-1);
	var l_centro_barra_usuario = (x_largo_barra_usuario/2)*(-1);
	$("#tabla_contenedora_datos_usuario").css("margin-left",a_centro_barra_usuario);
	$("#tabla_contenedora_datos_usuario").css("margin-top",l_centro_barra_usuario);
	
	/*fontresize();
	$(window).bind('resize',function(){
		fontResize();
	});
	*/
	
	//Barra de Menú
	var a_por_barra_menu = (ancho*90)/100;
	var l_por_barra_menu = (largo*10)/100;
	$("#contenedor_menu_navegacion").css("width",a_por_barra_menu);
	$("#contenedor_menu_navegacion").css("height",l_por_barra_menu);
	var x_largo_barra_menu = $( "#contenedor_datos_mayor" ).height();
	var x_ancho_barra_menu = $( "#contenedor_datos_mayor" ).width();
	var a_centro_barra_menu = (x_ancho_barra_menu/2)*(-1);
	var l_centro_barra_menu = (x_largo_barra_menu/2)*(-1);
	$("#contenedor_menu_navegacion").css("margin-left",a_centro_barra_menu);
	$("#contenedor_menu_navegacion").css("margin-top",l_centro_barra_menu);
	
	//Contenedor_Principal
	var largo_p = $( window ).height();
	var ancho_p = $( window ).width();
	var a_por_p = (ancho_p*99.9)/100;
	var l_por_p = (largo_p*79)/100;
	$("#contenedor_principal_gestion").css("width",a_por_p);
	$("#contenedor_principal_gestion").css("height",l_por_p);
	var x_largo_p = $( "#contenedor_principal_gestion" ).height();
	var x_ancho_p = $( "#contenedor_principal_gestion" ).width();
	var a_centro_p = (x_ancho_p/2)*(-1);
	var l_centro_p = (x_largo_p/2)*(-1);
	$("#contenedor_principal_gestion").css("margin-left",a_centro_p);
	$("#contenedor_principal_gestion").css("margin-top",l_centro_p);
	
	
	//Contenedor_Principal_administracion
	var largo_p2 = $( window ).height();
	var ancho_p2 = $( window ).width();
	var a_por_p2 = (ancho_p2*80)/100;
	var l_por_p2 = (largo_p2*76)/100;
	$("#contenedor_datos_administracion_principal").css("width",a_por_p2);
	$("#contenedor_datos_administracion_principal").css("height",l_por_p2);
	var x_largo_p2 = $( "#contenedor_principal_gestion" ).height();
	var x_ancho_p2 = $( "#contenedor_principal_gestion" ).width();
	var a_centro_p2 = (x_ancho_p2/2)*(-1);
	var l_centro_p2 = (x_largo_p2/2)*(-1);
	$("#contenedor_datos_administracion_principal").css("margin-left",a_centro_p2);
	$("#contenedor_datos_administracion_principal").css("margin-top",l_centro_p2);
	
	//Contenedor__tabla opciones
	var largo_p3 = $( window ).height();
	var ancho_p3 = $( window ).width();
	var a_por_p3 = (ancho_p3*20)/100;
	var l_por_p3 = (largo_p3*10)/100;
	$("#tabla_opciones_gestion").css("width",a_por_p3);
	$("#tabla_opciones_gestion").css("height",l_por_p3);
	var x_largo_p3 = $( "#contenedor_principal_gestion" ).height();
	var x_ancho_p3 = $( "#contenedor_principal_gestion" ).width();
	var a_centro_p3 = (x_ancho_p2/2)*(-1);
	var l_centro_p3 = (x_largo_p2/2)*(-1);
	$("#tabla_opciones_gestion").css("margin-left",a_centro_p3);
	$("#tabla_opciones_gestion").css("margin-top",l_centro_p3);
	
	
	//Contenedor_contenido opcion gestion
	var largo_p3 = $( window ).height();
	var ancho_p3 = $( window ).width();
	var a_por_p3 = (ancho_p3*76)/100;
	var l_por_p3 = (largo_p3*78)/100;
	$("#contenedor_datos_administracion_principal").css("width",a_por_p3);
	$("#contenedor_datos_administracion_principal").css("height",l_por_p3);
	var x_largo_p3 = $( "#contenedor_principal_gestion" ).height();
	var x_ancho_p3 = $( "#contenedor_principal_gestion" ).width();
	var a_centro_p3 = (x_ancho_p2/2)*(-1);
	var l_centro_p3 = (x_largo_p2/2)*(-1);
	$("#contenedor_datos_administracion_principal").css("margin-left",a_centro_p3);
	$("#contenedor_datos_administracion_principal").css("margin-top",l_centro_p3);
	
	
	//Contenedor datos mayor:
	var largo_aa = $( window ).height();
	var ancho_aa = $( window ).width();
	var a_por_aa = (ancho_aa*99.2)/100;
	var l_por_aa = (largo_aa*99)/100;
	$(".fondo_apertura").css("width",a_por_aa);
	$(".fondo_apertura").css("height",l_por_aa);
	
	//Contenedor datos mayor:centrado
	var x_largo_aa = $( ".fondo_apertura" ).height();
	var x_ancho_aa = $( ".fondo_apertura" ).width();
	var a_centro_aa = (x_ancho_aa/2)*(-1);
	var l_centro_aa = (x_largo_aa/2)*(-1);
	$(".fondo_apertura").css("margin-left",a_centro_aa);
	$(".fondo_apertura").css("margin-top",l_centro_aa);
	
	
	
});
	function entrar(e){
		if(e.keyCode == 13){
			if($("#password").val().length == 0 && $("#usuario").val().length == 0){
				$("#contenedor_mensaje_error").html("<div id ='mensaje_error' style = 'width:'100%';padding:5px;'><span>INGRESE LOS DATOS DE LOGEO PARA INGRESAR AL SISTEMA !</span></div>");
				$("#password,#usuario").css({"border":"2px solid red"});
			}else if($("#password").val().length == 0 && $("#usuario").val().length > 0){
				$("#password,#usuario").css({"border":"2px solid white"});
				$.ajax({
					url:'usuario.php',
					data:{t:1,usuario:$("#usuario").val()},
					type:'post',
					success:function(data){
						if(data == 1){
							alert("INGRESE SU NUEVA CONTRASEÑA");
							$(".normal_c").hide();
							$(".cambio_c").show();						
						}else{
							$("#contenedor_mensaje_error").html("<div id ='mensaje_error' style = 'width:'100%';padding:5px;'><span>HA INGRESADO LOS DATOS MAL, INTENTE NUEVAMENTE</span></div>");
						}
					}
				});
			}else if($("#password").val().length != 0 && $("#usuario").val().length == 0){
				$("#contenedor_mensaje_error").html("<div id ='mensaje_error' style = 'width:'100%';padding:5px;'><span>HA INGRESADO LOS DATOS MAL, INTENTE NUEVAMENTE</span></div>");
			}else{
				$.ajax({
					url:'usuario.php',
					data:{t:2,usuario:$("#usuario").val(),password:$("#password").val()},
					type:'post',
					success:function(data){
						if(data == 1){
							window.location.href = 'Vista/bienvenida.php';
						}else{
							$("#contenedor_mensaje_error").html("<div id ='mensaje_error' style = 'width:'100%';padding:5px;'><span>HA INGRESADO LOS DATOS MAL!</br>INTENTE NUEVAMENTE O COMUNÍQUESE CON EL ADMINISTRADOR</span></div>");
						}
					}
				});
				
			}
		}
	}