var correos = [];
var representante = [];
var telefonos = [];

$(document).ready(function(){
	$("#cerrar_sesion").on('click',function(){
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
	});
	//alert("ANCHO "+ screen.width + " ALTO "+ screen.height);
	var anc = $( window ).height();
		
		$("#menu_inicio").css({"margin-top":anc/15});
	$(window).resize(function() {
		//location.reload();
		var anc = $( window ).height();
		$("#menu_inicio").css({"margin-top":anc/15});
		$(".empresas_css").css({"height":$("#empresa_arranque").width()/5});
	});
	var mv_largo =$( window ).height();
	var mv_ancho = $( window ).width();
		
		
	var largo = mv_largo;//$( window ).height();
	var ancho = mv_ancho;//$( window ).width();
	var a_por = (ancho*95)/100;
	var l_por = (largo*40)/100;
	//$("#contenedor_datos_mayor").css("width",a_por);
	//$("#contenedor_datos_mayor").css("height",l_por);
		
	//Contenedor datos mayor:centrado
	var x_largo = $( "#contenedor_datos_mayor" ).height();
	var x_ancho = $( "#contenedor_datos_mayor" ).width();
	var a_centro = (x_ancho/2)*(-1);
	var l_centro = (x_largo/2)*(-1);
	//$("#contenedor_datos_mayor").css("margin-left",a_centro);
	//$("#contenedor_datos_mayor").css("margin-top",l_centro);
		
		
	//Tabla de Logeo
	var largo_xxx = mv_largo;//$( window ).height();
	var ancho_xxx = mv_ancho;//$( window ).width();
	var a_por_xxx = (ancho_xxx*95)/100;
	var l_por_xxx = (largo_xxx*40)/100;
	//$("#tabla_logeo").css("width",a_por_xxx);
	
//$("#tabla_logeo").css("height",l_por_xxx);
	var x_largo_x = $( "#tabla_logeo" ).height();
	var x_ancho_x = $( "#tabla_logeo" ).width();
	var a_centro_x = (x_ancho_x/2)*(-1);
	var l_centro_x = (x_largo_x/2)*(-1);
	//$("#tabla_logeo").css("margin-left",a_centro_x);
	//$("#tabla_logeo").css("margin-top",l_centro_x);

	var ancho = ($( window ).width*95)/100;
	var alto = ($( window ).height*40)/100;
	$("#empresa_arranque").dialog({
      autoOpen: false,
      height: "auto",
      width: "80%",
	  open: function () {
        $(".ui-widget-overlay").css({
			background: "black url(../images/logeo/fondo_gris_pantalla.jpg) no-repeat top",
			opacity: 1,
			filter: "Alpha(Opacity=100)"
        });
        $(".ui-draggable").css({
        	top:"50px"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	
	$("#gestion").on('click',function(){
		
		
		$("#empresa_arranque").dialog('open');
		$(".empresas_css").css({"height":$("#empresa_arranque").width()/5});
		var ancho = $("#empresa_arranque").width();
		por = (ancho*32)/100;
		//$("#contenedor_adicionar").css({"position":"absolute","top":"92.55%","left":por,"width":"333px"});
		//$("#contenedor_adicionar").css({"left":por});
		
	});
	
	//$("#tabla_logeo").css({"width":ancho});
	//$("#tabla_logeo").css({"height":alto});
	
	//$("#menu_inicio").css({"width":ancho});
	//$("#menu_inicio").css({"height":alto});
	
	
	
	var alto = $( window ).height();
	var x = (alto*95)/100;
	var ancho = $( window ).width();
	var y = (ancho*95)/100;
	$("#ventana_nueva_empresa").dialog({
      autoOpen: false,
      height: "auto",
      width: "80%",
	  open: function () {
        $(".ui-widget-overlay").css({
            background: "black url(../images/logeo/fondo_gris_pantalla.jpg) no-repeat top",
			opacity: 1,
			filter: "Alpha(Opacity=100)"
        });
        $(".ui-draggable").css({
        	top:"20px"
        });
    },
	  modal:true,
	  resizable: false
    });
	
	$("#agregar_nueva_empresa").on("click",function(){
		$("#ventana_nueva_empresa").dialog('open');
	});
	$("#cerrar_ventana_nueva_empresa").on("click",function(){
		$("#ventana_nueva_empresa input").val("");
		$("#ventana_nueva_empresa").dialog('close');
	});
	
	$("#n_pais_empresa").on('change',function(){
		var pais = $("#n_pais_empresa").val();
		$.ajax({
			url:'gestion_all.php',
			data:{p:pais,turno:6},
			type:'POST',
			success:function(data){
				$("#n_departamento_empresa").html(data);
			}
		});
	});
	$("#n_departamento_empresa").on('change',function(){
		var departamento = $("#n_departamento_empresa").val();
		$.ajax({
			url:'gestion_all.php',
			data:{d:departamento,turno:7},
			type: 'POST',
			success:function(data){
				$("#n_ciudad_empresa").html(data);
			}
		});
	});
	
	$("#limpiar_img_bienvenida").on('click',function(){
		$("#n_logo_bienvenida").val("");
	});
	$("#limpiar_img_logo").on('click',function(){
		$("#n_logo_empresa").val("");
	});
	
	$("#n_guardar_empresa_gestion").on('click',function(){
		var x = 0;
		$("#ventana_nueva_empresa input").each(function(){
			if($(this).val().length == 0){
				x++;
				var id = $(this).attr('id');
				$("#"+id).css({"border":"1px solid red"});
			}else{
				var id = $(this).attr('id');
				$("#"+id).css({"border":"0px"});
			}
		});
		if(x > 0){
			alert("LOS CAMPOS CON * SON OBLIGATORIOS!");
		}else{
			data =  new FormData();
			var archivos = document.getElementById("n_logo_empresa");
			var archivo = archivos.files;
			for(i=0; i<archivo.length; i++){
				data.append('logo'+i,archivo[i]);	
			}
			
			data.append("nit",$("#n_nit_empresa").val());
			data.append("legal",$("#n_nombre_legal_empresa").val());
			data.append("comercial",$("#n_nombre_comercial_empresa").val());
			data.append("turno",4);
			$.ajax({
				url:'gestion_all.php',
				data:data,
				type:'POST',
				contentType:false,
				processData:false,
				success:function(data){
					$("#ventana_nueva_empresa input").val("");
					alert(data);
					document.location.reload();
				}
			});
		}
		
		//data.append("iniciales",$("#n_iniciales_empresa").val());
		//data.append("phone",telefonos);
		//data.append("direc",$("#n_direccion_empresa").val());
		//data.append("nota",$("#n_nota_orden_empresa").val());
		//data.append("n_ppto",$("#n_nota_ppto_empresa").val());
		//data.append("pais",$("#n_pais_empresa").val());
		//data.append("depto",$("#n_departamento_empresa").val());
		//data.append("ciudad",$("#n_ciudad_empresa").val());
		//data.append("n_face",$("#n_face").val());
		//data.append("n_you",$("#n_you").val());
		//data.append("n_twitter",$("#n_twitter").val());
		//data.append("n_nota_oc",$("#n_nota_oc").val());
		//data.append("n_web",$("#n_web").val());
		//data.append("email",correos);
		//data.append("n_re_legal",representante);
	});
	
	$("#n_cancelar_empresa_gestion").on('click',function(){
		$("#ventana_nueva_empresa input").val("");
		$("#ventana_nueva_empresa select").val("vacio");
		$("#ventana_nueva_empresa textarea").val("");
		$("#ventana_nueva_empresa").dialog('close');
	});
	
	$("#cerrar").on('click',function(){
		$("#empresa_arranque").dialog('close');
	});
	
	$(".ui-dialog-titlebar").hide();
});

function guardar_correo(e){
	if(e.keyCode == 13){
		$("#lista_correos").html("");
		correos.push($("#email").val());
		for(var i = 0; i < correos.length; i++){
			$("#lista_correos").append("<table><tr><td><img onclick = 'eliminar_correo("+i+")'src = '../images/icon/icono_cerrar.png' width = '25px' height = '25px'/></td><td>"+correos[i]+"</td></tr></table>");
		}
		$("#email").val("");
	}
}
function eliminar_correo(x){
	correos.splice(x,1);
	$("#lista_correos").html("");
	for(var i = 0; i < correos.length; i++){
		$("#lista_correos").append("<table><tr><td><img onclick = 'eliminar_correo("+i+")'src = '../images/icon/icono_cerrar.png' width = '25px' height = '25px'/></td><td>"+correos[i]+"</td></tr></table>");
	}
	$("#email").val("");
}

function guardar_representante(e){
	if(e.keyCode == 13){
		$("#lista_representante").html("");
		representante.push($("#n_re_legal").val());
		for(var i = 0; i < representante.length; i++){
			$("#lista_representante").append("<table><tr><td><img onclick = 'eliminar_representante("+i+")'src = '../images/icon/icono_cerrar.png' width = '25px' height = '25px'/></td><td>"+representante[i]+"</td></tr></table>");
		}
		$("#n_re_legal").val("");
	}
}
function eliminar_representante(x){
	representante.splice(x,1);
	$("#lista_representante").html("");
	for(var i = 0; i < representante.length; i++){
		$("#lista_representante").append("<table><tr><td><img onclick = 'eliminar_representante("+i+")'src = '../images/icon/icono_cerrar.png' width = '25px' height = '25px'/></td><td>"+representante[i]+"</td></tr></table>");
	}
	$("#n_re_legal").val("");
}

function guardar_telefono(e){
	if(e.keyCode == 13){
		if(isNaN($("#n_telefono_empresa").val())){
			alert("EL VALOR QUE HA INGRESADO NO ES UN NÚMERO");
		}else{
			$("#lista_telefonos").html("");
			telefonos.push($("#n_telefono_empresa").val());
			for(var i = 0; i < telefonos.length; i++){
				$("#lista_telefonos").append("<table><tr><td><img onclick = 'eliminar_telefono("+i+")'src = '../images/icon/icono_cerrar.png' width = '25px' height = '25px'/></td><td>"+telefonos[i]+"</td></tr></table>");
			}
			$("#n_telefono_empresa").val("");
			
		}
		
	}
}

function eliminar_telefono(x){
	representante.splice(x,1);
	$("#lista_telefonos").html("");
	for(var i = 0; i < representante.length; i++){
		$("#lista_telefonos").append("<table><tr><td><img onclick = 'eliminar_telefono("+i+")'src = '../images/icon/icono_cerrar.png' width = '25px' height = '25px'/></td><td>"+telefonos[i]+"</td></tr></table>");
	}
	$("#n_telefono_empresa").val("");
}