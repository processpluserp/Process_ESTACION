var formatNumber = {
	separador: ",", // separador para los miles
	sepDecimal: '.', // separador para los decimales
	formatear:function (num){
	num +='';
	var splitStr = num.split(',');
	var splitLeft = splitStr[0];
	var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
	var regx = /(\d+)(\d{3})/;
	while (regx.test(splitLeft)) {
		splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
	}
	return this.simbol + splitLeft  +splitRight;
	 },
	
	new:function(num, simbol){
	  this.simbol = simbol ||'';
	 return this.formatear(num);
	 }
}
var archivos_tarea_crear = [];;
var archivos_tarea_res = [];
var nombres = ('A','B','C','D','E','F','G','H','I','J','K');
var asistentes_agencia = [];
var asistentes_cliente = [];
var compromisos_agencia_ie = [];
var compromisos_cliente_ie = [];
var temas_tratados_ie = [];


//Asistentes de la Agencia:
var input_asis_empresa_informe = [];
var input_name_asis_empresa_informe = [];

//Interesados de la Agencia (Copia Oculta)
var input_asis_empresa_int_informe = [];
var input_name_asis_empresa_int_informe = [];


function filtrar_asis_agencia_input(){
	if($("#asis_input_agencia").val().length > 0){
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:34,name:$("#asis_input_agencia").val(),usu:$("#codigo_usuario").text()},
			type:'post',
			success:function(dat){
				$("#listado_Asistentes_agencia").html(dat);
			}
		});
	}else{
		$("#listado_Asistentes_agencia").html("");
	}
	
}
function add_asis_empresa_push(id){
	$("#mensaje_alerta_asis_agencia").text("");
	var num = input_asis_empresa_informe.length;
	var yes = 0;
	$("input[name='asis_empres_ie[]']:checked").each(function() {
		
		for(var i = 0; i < num; i++){
			if(input_asis_empresa_informe[i] == $(this).val()){
				yes = 1;
			}
		}
		if(yes == 1){
			$("#mensaje_alerta_asis_agencia").text($("#text"+$(this).attr("id")+"").text() + " YA HA SIDO SELECCIONADO !");
		}else{
			input_asis_empresa_informe.push($(this).val());
			input_name_asis_empresa_informe.push( $("#text"+$(this).attr("id")+"").text());
		}
	});
	$("#asis_input_agencia").val("");
	
	$("#listado_Asistentes_agencia").html("");
	var tabla = "<table width= '100%' class = 'tabla_comprimosos_ie'><tr><th></th><th>NOMBRE</th></tr>";
	for(var i = 0; i < input_asis_empresa_informe.length; i++){
		tabla+="<tr><td align = 'center'><img title = 'Eliminar Asistente' src = '../images/iconos/eliminar.png' width = '25px' onclick = 'eliminar_asis_empresa_informe("+i+")'/></td><td >"+input_name_asis_empresa_informe[i]+"</td></tr>";
	}
	$("#list_asistentes_agencia_confirmados").html(tabla+"</table>");
}

function eliminar_asis_empresa_informe(i){
	$("#mensaje_alerta_asis_agencia").text("");
	input_name_asis_empresa_informe.splice(i,1);
	input_asis_empresa_informe.splice(i,1);
	var tabla = "<table width= '100%' class = 'tabla_comprimosos_ie'><tr><th></th><th>NOMBRE</th></tr>";
	for(var i = 0; i < input_asis_empresa_informe.length; i++){
		tabla+="<tr><td align = 'center'><img title = 'Eliminar Asistente' src = '../images/iconos/eliminar.png' width = '25px' onclick = 'eliminar_asis_empresa_informe("+i+")'/></td><td >"+input_name_asis_empresa_informe[i]+"</td></tr>";
	}
	$("#list_asistentes_agencia_confirmados").html(tabla+"</table>");
}


function filtrar_asis_agencia_interesados_input(){
	if($("#asis_input_agencia_copiados").val().length > 0){
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:44,name:$("#asis_input_agencia_copiados").val(),usu:$("#codigo_usuario").text()},
			type:'post',
			success:function(dat){
				$("#listado_Asistentes_agencia2").html(dat);
			}
		});
	}else{
		$("#listado_Asistentes_agencia2").html("");
	}
	
}

function add_asis_empresa_copiados_push(id){
	$("#mensaje_alerta_int_agencia").text("");
	var num = input_asis_empresa_int_informe.length;
	var yes = 0;
	$("input[name='asis_empres_ie[]']:checked").each(function() {
		
		for(var i = 0; i < num; i++){
			if(input_asis_empresa_int_informe[i] == $(this).val()){
				yes = 1;
			}
		}
		if(yes == 1){
			$("#mensaje_alerta_int_agencia").text($("#text"+$(this).attr("id")+"").text() + " YA HA SIDO SELECCIONADO !");
		}else{
			input_asis_empresa_int_informe.push($(this).val());
			input_name_asis_empresa_int_informe.push( $("#text"+$(this).attr("id")+"").text());
		}
	});
	$("#asis_input_agencia_copiados").val("");
	
	$("#listado_Asistentes_agencia2").html("");
	var tabla = "<table width= '100%' class = 'tabla_comprimosos_ie'><tr><th></th><th>NOMBRE</th></tr>";
	for(var i = 0; i < input_asis_empresa_int_informe.length; i++){
		tabla+="<tr><td align = 'center'><img title = 'Eliminar Asistente' src = '../images/iconos/eliminar.png' width = '25px' onclick = 'eliminar_asis_empresa_int_informe("+i+")'/></td><td >"+input_name_asis_empresa_int_informe[i]+"</td></tr>";
	}
	$("#list_asistentes_agencia_interesados").html(tabla+"</table>");
}

function eliminar_asis_empresa_int_informe(i){
	$("#mensaje_alerta_int_agencia").text("");
	input_name_asis_empresa_int_informe.splice(i,1);
	input_asis_empresa_int_informe.splice(i,1);
	var tabla = "<table width= '100%' class = 'tabla_comprimosos_ie'><tr><th></th><th>NOMBRE</th></tr>";
	for(var i = 0; i < input_asis_empresa_int_informe.length; i++){
		tabla+="<tr><td align = 'center'><img title = 'Eliminar Copiado' src = '../images/iconos/eliminar.png' width = '25px' onclick = 'eliminar_asis_empresa_int_informe("+i+")'/></td><td >"+input_name_asis_empresa_int_informe[i]+"</td></tr>";
	}
	$("#list_asistentes_agencia_interesados").html(tabla+"</table>");
}
















function fontresize(){
		var resolution=1800;
		var font = 13;
		var width = $(window).width();
		var newfont = font*(width/resolution);
		$("#contenedor_principal_gestion").css("font-size",newfont);
		//$("#contenedor_principal_gestion").css("font-size",newfont);
		//$("#contenedor_menu_navegacion").css("font-size",newfont);
	}
function adicionar_compromiso_agencia_ie(){
	if($("#n_compromiso_agencia_p1").val() != 0 && $("#fentrega_compromiso_agencia_p1").val().length != 0 && $("#compromisos_empresa_p1").val().length != 0){
		$("#n_compromiso_agencia_p1,#fentrega_compromiso_agencia_p1,#compromisos_empresa_p1").css({"border":"0px solid red"});
		compromisos_agencia_ie.push($("#n_compromiso_agencia_p1").val()+"<***+++>"+$("#n_compromiso_agencia_p1 option:selected").text()+"<***+++>"+$("#fentrega_compromiso_agencia_p1").val()+"<***+++>"+$("#compromisos_empresa_p1").val().replace(/\r?\n/g, "<br>"));
		$("#n_compromiso_agencia_p1").val("0");
		$("#fentrega_compromiso_agencia_p1").val("");
		$("#compromisos_empresa_p1").val("");
		$("#contenedor_listado_compromisos_agencia").html("");
		var tabla = "<table width= '100%' class = 'tabla_comprimosos_ie'><tr><th></th><th>NOMBRE</th><th>FECHA</th><th>COMPROMISO</th></tr>";
		for(var i = 0; i < compromisos_agencia_ie.length; i++){
			var list = compromisos_agencia_ie[i].split('<***+++>');
			tabla+="<tr><td align = 'center'><img title = 'Eliminar Compromiso' src = '../images/iconos/eliminar.png' width = '25px' onclick = 'eliminar_compromiso_agencia("+i+")'/></td><td width = '25%'>"+(i+1)+". "+list[1]+"</td><td nowrap width = '10%' align = 'center'>"+list[2]+"</td><td>"+list[3].replace(/\r?\n/g, "<br>")+"</td></tr>";
		}
		$("#contenedor_listado_compromisos_agencia").html(tabla+"</table>");
		////INICIODANIEL
		  $( "#compromisosAgencia" ).fadeOut(200);
		//////FINDANIEL
	}else{
		alert("DEBE DILIGENCIAR TODOS LOS CAMPOS PARA PODER REALIZAR ESTA ACCIÓN !!!");
		$("#n_compromiso_agencia_p1,#fentrega_compromiso_agencia_p1,#compromisos_empresa_p1").css({"border":"1px solid red"});
	}
	
}

function eliminar_compromiso_agencia(i){
	compromisos_agencia_ie.splice(i,1);
	$("#contenedor_listado_compromisos_agencia").html("");
	var tabla = "<table width= '100%' class = 'tabla_comprimosos_ie'><tr><th></th><th>NOMBRE</th><th>FECHA</th><th>COMPROMISO</th></tr>";
	for(var i = 0; i < compromisos_agencia_ie.length; i++){
		var list = compromisos_agencia_ie[i].split('<***+++>');
		tabla+="<tr><td align = 'center'><img title = 'Eliminar Compromiso' src = '../images/iconos/eliminar.png' width = '25px' onclick = 'eliminar_compromiso_agencia("+i+")'/></td><td width = '25%'>"+(i+1)+". "+list[1]+"</td><td nowrap width = '10%' align = 'center'>"+list[2]+"</td><td>"+list[3].replace(/\r?\n/g, "<br>")+"</td></tr>";
	}
	$("#contenedor_listado_compromisos_agencia").html(tabla+"</table>");
}


function add_temas_ie(){
	if($("#temas_tratados_ie").val() != 0){
		$("#temas_tratados_ie").css({"border":"0px solid red"});
		temas_tratados_ie.push($("#temas_tratados_ie").val().replace(/\r?\n/g, "<br>")+"<***+++>");
		$("#temas_tratados_ie").val("");
		$("#contenedor_temas_ie").html("");
		var tabla = "<table width= '100%' class = 'tabla_comprimosos_ie'><tr><th></th><th>TEMA</th></tr>";
		for(var i = 0; i < temas_tratados_ie.length; i++){
			var list = temas_tratados_ie[i].split('<***+++>');
			tabla+="<tr><td align = 'center'><img title = 'Eliminar Compromiso' src = '../images/iconos/eliminar.png' width = '25px' onclick = 'eliminar_temas_tratados_ie("+i+")'/></td><td nowrap>"+(i+1)+". "+list[0].replace(/\r?\n/g, "<br>")+"</td></tr>";
		}
		$("#contenedor_temas_ie").html(tabla+"</table>");
		//Daniel
		  $( "#temasReunion" ).fadeOut(200);
		if(temas_tratados_ie.length < 1){
			$( "#compromisosAgenciaBoton" ).hide();
			$( "#compromisosClienteBoton" ).hide();
		}else{
			$( "#compromisosAgenciaBoton" ).show();
			$( "#compromisosClienteBoton" ).show();
		}
	}else{
		alert("DEBE DILIGENCIAR TODOS LOS CAMPOS PARA PODER REALIZAR ESTA ACCIÓN !!!");
		$("#temas_tratados_ie").css({"border":"1px solid red"});
	}
	
}

function eliminar_temas_tratados_ie(i){
	temas_tratados_ie.splice(i,1);
	$("#contenedor_temas_ie").html("");
	var tabla = "<table width= '100%' class = 'tabla_comprimosos_ie'><tr><th></th><th>TEMA</th></tr>";
	for(var i = 0; i < temas_tratados_ie.length; i++){
		var list = temas_tratados_ie[i].split('<***+++>');
		tabla+="<tr><td align = 'center'><img title = 'Eliminar Compromiso' src = '../images/iconos/eliminar.png' width = '25px' onclick = 'eliminar_temas_tratados_ie("+i+")'/></td><td nowrap>"+(i+1)+". "+list[0].replace(/\r?\n/g, "<br>")+"</td></tr>";
	}
	$("#contenedor_temas_ie").html(tabla+"</table>");
	if(temas_tratados_ie.length < 1){
		$( "#compromisosAgenciaBoton" ).hide();
		$( "#compromisosClienteBoton" ).hide();
	}else{
		$( "#compromisosAgenciaBoton" ).show();
		$( "#compromisosClienteBoton" ).show();
	}
}


function adicionar_compromiso_cliente_ie(){
	if($("#name_compromiso_cliente_ie").val() != 0 && $("#fentrega_compromiso_cliente_p1").val().length != 0 && $("#compromisos_cliente_p1").val().length != 0){
		$("#name_compromiso_cliente_ie,#fentrega_compromiso_cliente_p1,#compromisos_cliente_p1").css({"border":"0px solid red"});
		compromisos_cliente_ie.push($("#name_compromiso_cliente_ie").val()+"<***+++>"+$("#fentrega_compromiso_cliente_p1").val()+"<***+++>"+$("#compromisos_cliente_p1").val().replace(/\r?\n/g, "<br>"));
		$("#name_compromiso_cliente_ie").val("");
		$("#fentrega_compromiso_cliente_p1").val("");
		$("#compromisos_cliente_p1").val("");
		$("#contenedor_listado_compromisos_cliente").html("");
		var tabla = "<table width= '100%' class = 'tabla_comprimosos_ie'><tr><th></th><th>NOMBRE</th><th>FECHA</th><th>COMPROMISO</th></tr>";
		for(var i = 0; i < compromisos_cliente_ie.length; i++){
			var list = compromisos_cliente_ie[i].split('<***+++>');
			tabla+="<tr><td align = 'center'><img title = 'Eliminar Compromiso' src = '../images/iconos/eliminar.png' width = '25px' onclick = 'eliminar_compromiso_cliente("+i+")'/></td><td width = '25%'>"+(i+1)+". "+list[0]+"</td><td nowrap width = '10%' align = 'center'>"+list[1]+"</td><td>"+list[2].replace(/\r?\n/g, "<br>")+"</td></tr>";
		}
		$("#contenedor_listado_compromisos_cliente").html(tabla+"</table>");
				
		////INICIODANIEL
		$( "#compromisosCliente" ).fadeOut(200);
		//////FINDANIEL
	}else{
		alert("DEBE DILIGENCIAR TODOS LOS CAMPOS PARA PODER REALIZAR ESTA ACCIÓN !!!");
		$("#name_compromiso_cliente_ie,#fentrega_compromiso_cliente_p1,#compromisos_cliente_p1").css({"border":"1px solid red"});
	}
	
}

function eliminar_compromiso_cliente(i){
	compromisos_cliente_ie.splice(i,1);
	$("#contenedor_listado_compromisos_cliente").html("");
	var tabla = "<table width= '100%' class = 'tabla_comprimosos_ie'><tr><th></th><th>NOMBRE</th><th>FECHA</th><th>COMPROMISO</th></tr>";
	for(var i = 0; i < compromisos_cliente_ie.length; i++){
		var list = compromisos_cliente_ie[i].split('<***+++>');
		tabla+="<tr><td align = 'center'><img title = 'Eliminar Compromiso' src = '../images/iconos/eliminar.png' width = '25px' onclick = 'eliminar_compromiso_cliente("+i+")'/></td><td width = '25%'>"+(i+1)+". "+list[0]+"</td><td nowrap width = '10%' align = 'center'>"+list[1]+"</td><td>"+list[2].replace(/\r?\n/g, "<br>")+"</td></tr>";
	}
	$("#contenedor_listado_compromisos_cliente").html(tabla+"</table>");
}
$(document).ready(function(){
	
	$( "#tabs" ).tabs();
	$.datepicker.regional['es'] = {
		 closeText: 'Cerrar',
		 prevText: '<Ant',
		 nextText: 'Sig>',
		 currentText: 'Hoy',
		 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		 weekHeader: 'Sm',
		 firstDay: 1,
		 isRTL: false,
		 showMonthAfterYear: false,
		 yearSuffix: ''
		 };
	$.datepicker.setDefaults($.datepicker.regional['es']);
	$("#previsual_informe").on('click',function(){
		
		var contar_compromisos_empresa = compromisos_agencia_ie.length;
		var contar_temas_tratados = temas_tratados_ie.length;
		var contar_asis_empresa = input_asis_empresa_informe.length;
		var contar_asis_cliente = asistentes_cliente.length;
		var contar_compromisos_cliente = compromisos_cliente_ie.length;
		var contar_copiados = input_asis_empresa_int_informe.length;
		
		window.open('pdf_ie_visual.php?hi='+$("#hora_inicio_ie").val()+':'+$("#minuto_inicio_ie").val()+':'+$("#formato_inicio_ie").val()+'&hf='+$("#hora_fin_ie").val()+':'+$("#minuto_fin_ie").val()+':'+$("#formato_fin_ie").val()+'&ot='+$("#num_ot_sel").text()+'&e='+$("#codigo_emp").text()+'&naa='+contar_asis_empresa+'&nc='+contar_asis_cliente+'&copi='+contar_copiados+'&lc='+input_asis_empresa_int_informe+'&ct='+temas_tratados_ie+'&ccn='+contar_compromisos_cliente+'&tp='+$("#tipo_reunion").val()+'&ac='+asistentes_cliente+'&iaei='+input_asis_empresa_informe+'&ig='+$("#info_general_ie").val().replace(/\r?\n/g, "<br>")+'&caie='+compromisos_agencia_ie+'&cca='+contar_compromisos_empresa+'&ccie='+compromisos_cliente_ie+'&lu='+$("#lugar_reunion_ie").val()+'&fec='+$("#fecha_reunion_ie").val()+'&asu='+$("#name_ie").val()+'&nan='+input_name_asis_empresa_informe,'_blank');
		//$("#cancelar_ie,#add_informe_entrevista_ot").hide("fast");
		//$("#cancelar_ie,#add_informe_entrevista_ot").show("fast");
		if(!$("#add_informe_entrevista_ot").is(":visible")){
			$("#cancelar_ie,#add_informe_entrevista_ot").show('fast');
		}
	});
	$("#add_informe_entrevista_ot").on('click',function(){
		var acum = 0;
		if($("#name_ie").val().length > 0){
			$("#mesaje_alerta_name").text("");
			$("#name_ie").css({'border':'0px solid white'});
		}else{
			acum++;
			$("#mesaje_alerta_name").text("Debe ingresar el título de la reunión.");
			$("#name_ie").css({'border':'1px solid red'});
		}
		if($("#fecha_reunion_ie").val().length > 0){
			$("#mesaje_alerta_fecha_reunion").text("");
			$("#fecha_reunion_ie").css({'border':'0px solid white'});
			
		}else{
			acum++;
			$("#mesaje_alerta_fecha_reunion").text("Debe seleccionar la fecha de reunión.");
			$("#fecha_reunion_ie").css({'border':'1px solid red'});
		}
		if($("#lugar_reunion_ie").val().length > 0){
			$("#mesaje_alerta_lugar").text("");
			$("#lugar_reunion_ie").css({'border':'0px solid white'});
		}else{
			acum++;
			$("#mesaje_alerta_lugar").text("Debe ingresar el lugar de reunión.");
			$("#lugar_reunion_ie").css({'border':'1px solid red'});
		}
		if(input_asis_empresa_informe.length > 0){
			$("#mensaje_alerta_asis_agencia").text("");
			$("#asis_input_agencia").css({'border':'0px solid white'});	
		}else{
			acum++;
			$("#mensaje_alerta_asis_agencia").text("Debe ingresar al menos un asistente de la agencia.");
			$("#asis_input_agencia").css({'border':'1px solid red'});
		}
		
		if($("#info_general_ie").val().length > 0){
			$("#mensaje_alerta_info_general").text("");
			$("#info_general_ie").css({'border':'0px solid white'});
		}else{
			acum++;
			$("#mensaje_alerta_info_general").text("Debe ingresar la información general de la reunión.");
			$("#info_general_ie").css({'border':'1px solid red'});
		}
		var archivos = document.getElementById("adjunto_ie");
		var contar = 0;
		for(i=0; i<archivos.files.length; i++){
			contar++;	
		}
		var contar_compromisos_empresa = compromisos_agencia_ie.length;
		var contar_temas_tratados = temas_tratados_ie.length;
		var contar_asis_empresa = input_asis_empresa_informe.length;
		var contar_asis_cliente = asistentes_cliente.length;
		var contar_compromisos_cliente = compromisos_cliente_ie.length;
		var contar_copiados = input_asis_empresa_int_informe.length;
		if(acum == 0){
			if(contar == 0){
				$.ajax({
					url:'busqueda_trafico.php',
					data:{
						num_asis_agencia:contar_asis_empresa,
						num_cliente:contar_asis_cliente,
						copi:contar_copiados,
						num_archivos:0,
						list_copiados:input_asis_empresa_int_informe,
						contar_temas:contar_temas_tratados,
						comp_clie_num:contar_compromisos_cliente,
						tipo_entrevista:$("#tipo_reunion").val(),ot:$("#num_ot_sel").text(),
						cliente:asistentes_cliente,turno:29,
						asis:input_asis_empresa_informe,
						info_general_ie:$("#info_general_ie").val(),
						compromisos_emp:compromisos_agencia_ie,num_comp_age:contar_compromisos_empresa,
						compromisos_clie:compromisos_cliente_ie,compromisos_cliente_ie:$("#compromisos_cliente_ie").val(),
						lugar_reunion_ie:$("#lugar_reunion_ie").val(),fecha_reunion_ie:$("#fecha_reunion_ie").val(),
						hora_inicio_ie:$("#hora_inicio_ie").val(),minuto_inicio_ie:$("#minuto_inicio_ie").val(),
						formato_inicio_ie:$("#formato_inicio_ie").val(),hora_fin_ie:$("#hora_fin_ie").val(),
						minuto_fin_ie:$("#minuto_fin_ie").val(),formato_fin_ie:$("#formato_fin_ie").val(),
						info_especifica_ie:$("#info_especifica_ie").val(),temas:temas_tratados_ie,
						asunto:$("#name_ie").val(),usu:$("#codigo_usuario").text()},
					type:'post',
					success:function(datax){
						alert(datax);
						compromisos_agencia_ie = [];
						compromisos_cliente_ie = [];
						temas_tratados_ie = [];
						//Asistentes de la Agencia:
						input_asis_empresa_informe = [];
						input_name_asis_empresa_informe = [];

						//Interesados de la Agencia (Copia Oculta)
						input_asis_empresa_int_informe = [];
						input_name_asis_empresa_int_informe = [];
						$("#informe_entrevista input,#informe_entrevista textarea").val("");
						
						$("#list_asistentes_agencia_confirmados,#list_asistentes_agencia_interesados,#cnt_asis_clie").html("");
						$("#informe_entrevista").dialog('close');
						
					}
				});
			}else{
				var formData = new FormData();
				for(i=0; i<archivos.files.length; i++){
					var name = archivos.files[i].name;
					formData.append("arc"+i,archivos.files[i]);		
				}
				formData.append("num_archivos",contar);		
				formData.append("ot",$("#num_ot_sel").text());
				$.ajax({
					url:'guardar_archivos_ie.php',
					data:formData,
					contentType:false,
					processData:false,
					type:'post',
					success:function(d){
						$.ajax({
							url:'busqueda_trafico.php',
							data:{num_asis_agencia:contar_asis_empresa,
								num_cliente:contar_asis_cliente,
								arcx:d,
								num_archivos:contar,
								copi:contar_copiados,
								list_copiados:input_asis_empresa_int_informe,
								contar_temas:contar_temas_tratados,
								comp_clie_num:contar_compromisos_cliente,
								tipo_entrevista:$("#tipo_reunion").val(),ot:$("#num_ot_sel").text(),
								cliente:asistentes_cliente,turno:29,
								asis:input_asis_empresa_informe,
								info_general_ie:$("#info_general_ie").val(),
								compromisos_emp:compromisos_agencia_ie,num_comp_age:contar_compromisos_empresa,
								compromisos_clie:compromisos_cliente_ie,compromisos_cliente_ie:$("#compromisos_cliente_ie").val(),
								lugar_reunion_ie:$("#lugar_reunion_ie").val(),fecha_reunion_ie:$("#fecha_reunion_ie").val(),
								hora_inicio_ie:$("#hora_inicio_ie").val(),minuto_inicio_ie:$("#minuto_inicio_ie").val(),
								formato_inicio_ie:$("#formato_inicio_ie").val(),hora_fin_ie:$("#hora_fin_ie").val(),
								minuto_fin_ie:$("#minuto_fin_ie").val(),formato_fin_ie:$("#formato_fin_ie").val(),
								info_especifica_ie:$("#info_especifica_ie").val(),temas:temas_tratados_ie,
								asunto:$("#name_ie").val(),usu:$("#codigo_usuario").text()},
							type:'post',
							success:function(datax){
								alert(datax);
								compromisos_agencia_ie = [];
								compromisos_cliente_ie = [];
								temas_tratados_ie = [];
								//Asistentes de la Agencia:
								input_asis_empresa_informe = [];
								input_name_asis_empresa_informe = [];

								//Interesados de la Agencia (Copia Oculta)
								input_asis_empresa_int_informe = [];
								input_name_asis_empresa_int_informe = [];
								$("#informe_entrevista input,#informe_entrevista textarea").val("");
								
								$("#list_asistentes_agencia_confirmados,#list_asistentes_agencia_interesados,#cnt_asis_clie").html("");
								$("#informe_entrevista").dialog('close');
							}
						});
					}
				});
			}
		
		}else{
			alert("Diligencie los campos en rojo.");
		}
		
		
		/*if($("#info_general_ie").val().length != 0){
			$("input[name='asis_empres_ie[]']:checked").each(function() {
				asis_empresa_informe.push($(this).val());
				name_asis_empresa.push( $("#text"+$(this).attr("id")+"").text());
			});
			$("input[name='asis_empres_ie2[]']:checked").each(function() {
				asis_empresa_cop.push($(this).val());
				name_asis_cop.push( $("#text"+$(this).attr("id")+"").text());
			});
			var formData = new FormData();
			var archivos = document.getElementById("adjunto_ie");
			var contar = 0;
			for(i=0; i<archivos.files.length; i++){
				contar++;	
			}
			var comprimosos_agenciax = "";
			if(compromisos_agencia_ie.length == 0){
				
			}else{
				
			}
			if(contar == 0){
				
				$.ajax({
					url:'busqueda_trafico.php',
					data:{tipo_entrevista:$("#tipo_reunion").val(),ot:$("#num_ot_sel").text(),cliente:asistentes_cliente,turno:29,n_copiados:name_asis_cop,asis_cop:asis_empresa_cop,name:name_asis_empresa,asis:asis_empresa_informe,info_general_ie:$("#info_general_ie").val(),
					compromisos_empresa_ie:$("#compromisos_empresa_ie").val(),compromisos_emp:compromisos_agencia_ie,compromisos_clie:compromisos_cliente_ie,compromisos_cliente_ie:$("#compromisos_cliente_ie").val(),lugar_reunion_ie:$("#lugar_reunion_ie").val(),fecha_reunion_ie:$("#fecha_reunion_ie").val(),
					hora_inicio_ie:$("#hora_inicio_ie").val(),minuto_inicio_ie:$("#minuto_inicio_ie").val(),formato_inicio_ie:$("#formato_inicio_ie").val(),hora_fin_ie:$("#hora_fin_ie").val(),minuto_fin_ie:$("#minuto_fin_ie").val(),
					formato_fin_ie:$("#formato_fin_ie").val(),info_especifica_ie:$("#info_especifica_ie").val(),temas:temas_tratados_ie,asunto:$("#name_ie").val()},
					type:'post',
					success:function(datax){
						//$("input[type=sis_empres_ie[]],input[type=sis_empres_ie2[]]").prop('checked', false);
						compromisos_agencia_ie = [];
						compromisos_cliente_ie = [];
						temas_tratados_ie = [];
						$("#informe_entrevista input,#informe_entrevista textarea").val("");
						$("#informe_entrevista select").val("0");
						alert(datax);
						//cerrar_ventana_informe_entrevista();
					}
				});
			}else{
				for(i=0; i<archivos.files.length; i++){
					var name = archivos.files[i].name;
					formData.append("arc"+i,archivos.files[i]);		
				}
				formData.append("num_archivos",contar);		
				formData.append("ot",$("#num_ot_sel").text());
				$.ajax({
					url:'guardar_archivos_ie.php',
					data:formData,
					contentType:false,
					processData:false,
					type:'post',
					success:function(d){
						if(d == true){
							$.ajax({
								url:'busqueda_trafico.php',
								data:{tipo_entrevista:$("#tipo_reunion").val(),ot:$("#num_ot_sel").text(),cliente:asistentes_cliente,turno:29,n_copiados:name_asis_cop,asis_cop:asis_empresa_cop,name:name_asis_empresa,asis:asis_empresa_informe,info_general_ie:$("#info_general_ie").val(),
								compromisos_empresa_ie:$("#compromisos_empresa_ie").val(),compromisos_emp:compromisos_agencia_ie,compromisos_clie:compromisos_cliente_ie,compromisos_cliente_ie:$("#compromisos_cliente_ie").val(),lugar_reunion_ie:$("#lugar_reunion_ie").val(),fecha_reunion_ie:$("#fecha_reunion_ie").val(),
								hora_inicio_ie:$("#hora_inicio_ie").val(),minuto_inicio_ie:$("#minuto_inicio_ie").val(),formato_inicio_ie:$("#formato_inicio_ie").val(),hora_fin_ie:$("#hora_fin_ie").val(),minuto_fin_ie:$("#minuto_fin_ie").val(),
								formato_fin_ie:$("#formato_fin_ie").val(),info_especifica_ie:$("#info_especifica_ie").val(),temas:temas_tratados_ie,asunto:$("#name_ie").val()},
								type:'post',
								success:function(datax){
									//$("input[type=sis_empres_ie[]],input[type=sis_empres_ie2[]]").prop('checked', false);
									compromisos_agencia_ie = [];
									compromisos_cliente_ie = [];
									temas_tratados_ie = [];
									$("#informe_entrevista input,#informe_entrevista textarea").val("");
									$("#informe_entrevista select").val("0");
									alert(datax);
									//cerrar_ventana_informe_entrevista();
								}
							});
						}
					}
				});
			}
			
			
		}else{
			alert("HAY CAMPOS SIN DILIGENCIAR !!!");
		}
		*/
	});

	var contenedor_fest = [];
	var festivos = [];
	

	var alto_popup = $(window).height();
	var alto_y_popup = (alto_popup*60)/100;
	var alto_y_popup2 = (alto_popup*75)/100;
	
	if($(window).height() < 600){
		$("#contenedor_listado_brief").css({'height':"300px","min-height":"300px"});
		//$("#contenedor_opciones_admin").css({'height':"300px","min-height":"300px"});
	}else{
		$("#contenedor_listado_brief").css({'height':alto_y_popup+'px',"min-height":"300px"});	
		//$("#contenedor_opciones_admin").css({'height':alto_y_popup2+'px',"min-height":"300px"});	
	}
	
	
	$("#archivo_subir_tarea_crear").on('change',function(){
		//archivos_tarea_crear = [];
		var archivos = document.getElementById("archivo_subir_tarea_crear");
		for(i=0; i<archivos.files.length; i++){
			var name = archivos.files[i].name;
			//alert(name);
			archivos_tarea_crear.push(archivos.files[i]);
			$("#lista_archivos_crear_tareas").append("<tr><td><img src = '../images/iconos/eliminar.png' height = '25px' onclick = 'eliminar_archivo_subir_tarea("+i+")'/></td><td style = 'padding-left:5px;'>"+archivos.files[i].name+"</td></tr>");
		}
	});
	$("#r_archivo_subir_tarea_crear").on('change',function(){
		//archivos_tarea_res = [];
		var archivos = document.getElementById("r_archivo_subir_tarea_crear");
		for(i=0; i<archivos.files.length; i++){
			var name = archivos.files[i].name;
			//alert(name);
			archivos_tarea_res.push(archivos.files[i]);
			$("#r_lista_archivos_crear_tareas").append("<tr><td><img src = '../images/iconos/eliminar.png' height = '25px' onclick = 'eliminar_archivo_subir_rtarea("+i+")'/></td><td style = 'padding-left:5px;'>"+archivos.files[i].name+"</td></tr>");
		}
	});


	$("#fechap_ct").on('change',function(){
		var ndate = new Date();
		//alert(ndate.getHours());
	});
	
	function nonWorkingDates(date){
		var day = date.getDay(), Sunday = 0, Monday = 1, Tuesday = 2, Wednesday = 3, Thursday = 4, Friday = 5, Saturday = 6;
		var closedDays = [[Saturday], [Sunday]];
		return [true];
	}
	
	
	var alto = $(window).height();
	var ancho_x = $(window).width();
	var ancho_por = (ancho_x*100)/100;
	var ancho_por2 = (ancho_x*99)/100;
	var x = (alto*100)/100;
	var alto_h = (alto*60)/100;
	
	var alto_hh = (alto*80)/100;
	var alto_hhh = (alto*35)/100;
	
	//$(".contenedor_scroll_reportes").css({"width":(ancho_x*90)/100});
	$(".contenedor_scroll_reportes").css({"height":(x*40)/100});
	$("#fecha_entrega_creativa_briefx,#fentrega_compromiso_agencia_p1,#fentrega_compromiso_cliente_p1").datepicker({ dateFormat: 'yy-mm-dd',beforeShowDay: nonWorkingDates,	numberOfMonths: 1,	minDate: '0',firstDay: 1  });
	$("#fecha_reunion_ie").datepicker({ dateFormat: 'yy-mm-dd',beforeShowDay: nonWorkingDates });
	$("#fecha_entrega_creativa_brief1,#fecha_terminacion_compromiso").datepicker({ dateFormat: 'yy-mm-dd',beforeShowDay: nonWorkingDates,	numberOfMonths: 1,	minDate: '0',firstDay: 1  });
	$("#fechap_rt").datepicker({ dateFormat: 'yy-mm-dd',beforeShowDay: nonWorkingDates,	numberOfMonths: 1,	minDate: '0',firstDay: 1  });
	$("#fechap_ct,#r_fechap_ct").datepicker({ dateFormat: 'yy-mm-dd',beforeShowDay: nonWorkingDates,	numberOfMonths: 1,	minDate: '0',firstDay: 1  });
	$("#contenedor_ot_seleccionada").css({"height":$(".botones_opciones").height()});

	$("#contenedor_listado_ie").css({"height":(x*75)/100});
	$("#contenedor_resultados_tareas div.dataTables_wrapper").css({"height":$(".contenedores_resultados").height()});

	
	
	
		
	
	//Contenedor de las OT
	var largox = $( "#contenedor_principal_gestion" ).height();
	var anchox = $( "#contenedor_principal_gestion" ).width();
	var a_porx = (anchox*98)/100;
	var l_porx = (largox*20)/100;
		
		
	//Contenedor Contestadas Pendientes.
	var a_pord = (anchox*98)/100;
	var l_pord = (largox*30)/100;
	$("#contenedor_pendientes_contestadas").css("width",a_pord);
	$("#contenedor_pendientes_contestadas").css("height",l_pord);
	var x_largod = $( "#contenedor_pendientes_contestadas" ).height();
	var x_anchod = $( "#contenedor_pendientes_contestadas" ).width();
	var a_centrod = (x_anchod/2)*(-1);
	var l_centrod = (x_largod/2)*(-1);
	$("#contenedor_pendientes_contestadas").css("margin-left",a_centrod);
	$("#contenedor_pendientes_contestadas").css("margin-top",l_centrod);

	$("#cv_trafico,#adicionar_brief_nuevo_ot,#ventana_reportes_trafico,#ventana_informes,#time_table").dialog({
	  autoOpen: false,
      height:x,
      width: ancho_por,
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 1,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
        $(".ui-draggable").css({
        	top:"2px"
        });
		},
      modal: true,
	  resizable: false
	});
	
	$("#abrir_nuevo_brief").on('click',function(){
		$(".nbriefcrm,.nbriefall,.nbriefcreativos").hide();
		
		var id_ot = $("#codigo_ot_interno").text();
		var producto = $("#"+id_ot+" td:last-child").text();
		
		
		if( $("#list_productos_clientesx").val() == 0  || $("#list_ot_briefs").val() == 0){
			alert("DEBE SELECCIONAR UN PRODUCTO Y UNA OT!!!");
		}else{
			$("#desarrollador_por_briefx").val("");
			$("#producto_marca_brief_x").val($("#list_productos_clientesx option:selected").text());
			$(".mensaje_brief_consulta").text("BRIEFS OT "+$("#num_ot_sel").text());
			$("#producto_marca_brief_x").val(producto);
			console.log(producto);
			$("#adicionar_brief_nuevo_ot").dialog("open");
		}
		
		
	});
	$("#tipo_briefx").on('change',function(){
		if( $("#tipo_briefx").val() == 1 ){
			$(".nbriefcreativos,.nbriefcrm").hide();
			$(".nbriefall").show();
		}else if( $("#tipo_briefx").val() == 3 ){
			$(".nbriefall,.nbriefcreativos").hide();
			$(".nbriefcrm").show();
		}else {
			$(".nbriefcrm").hide();
			$(".nbriefcreativos,.nbriefall").show();
		}
	});
	$("#crear_ot_brief_x").on('click',function(){
		//Modificaciones Damian Brief
		var inputs = [];
		var text = [];
		var contador = 0;
		$("#contenedor_datos_brief_adicional input").each(function(index){
			if($(this).is(":visible") && $(this).val().length < 2){
				contador++;
			}else if($(this).is(":visible")){
				inputs.push($(this).val());
			}
			
		});
		$("#contenedor_datos_brief_adicional textarea").each(function(index){
			if($(this).is(":visible")){
				text.push($(this).val());
				console.log($(this).val());
			}
		});
		var date = new Date();
		if(contador == 0){
			$("#contenedor_datos_brief_adicional input").each(function(index){
				$(this).css({"border":"0px"});
			});
			$.ajax({
				url:'busqueda_trafico.php',
				data:{turno:22,ot:$("#num_ot_sel").text(),tipo:$("#tipo_briefx").val(), inputs:inputs,text:text,
				th:date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds(),usu:$("#codigo_usuario").text()},
				type:'post',
				success:function(data){
					$("#adicionar_brief_nuevo_ot").dialog("close");
					$("#producto_marca_brief_x,#fecha_entrega_creativa_briefx").val("");
					$("#adicionar_brief_nuevo_ot textarea").val("");
					$("#adicionar_brief_nuevo_ot textarea, #tipo_priyecto_crm, #fecha_entrega_creativa_briefx, #desarrollador_por_briefx").val("");
					$("#tipo_briefx").val("...");
					consultar_briefs_ot();
					alert("BRIEF SUBIDO !");
				}
			});
		}else{
			alert("LOS CAMPOS EN (*) DEBE TENER MÁS DE DOS CARACTERES !");
			$("#contenedor_datos_brief_adicional input").each(function(index){
				if($(this).val().length < 2){
					$(this).css({"border":"1px solid red"});
				}
			});
		}
		
	});
	
	$("#razon_cancelacion_ot,#informe_entrevista").dialog({
	  autoOpen: false,
      height:x,
      width: ancho_por,
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 1,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
        $(".ui-draggable").css({
        	top:"2px"
        });
		},
      modal: true,
	  resizable: false
	});
	
	$("#adjuntar_ppto_tarea").dialog({
	  autoOpen: false,
      height:x,
      width: ancho_por,
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 1,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
        $(".ui-draggable").css({
        	top:"2px"
        });
		},
      modal: true,
	  resizable: false
	});
	$(".brief_trafico").dialog({
	  autoOpen: false,
      height:x,
      width: ancho_por,
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 1,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
        $(".ui-draggable").css({
        	top:"2px"
        });
		},
      modal: true,
	  resizable: false
	});
	
	$("#ventana_trafico").on('click',function(){
		$(".scroll").css({"overflow-y":"hidden"});

		//actualizar_tareas();
		$("#cv_trafico").dialog('open');
	});
	$("#cerrar_ventana_trafico").on('click',function(){
		$(".scroll").css({"overflow-y":"scroll"});
		$("#cv_trafico").dialog('close');
	});
	
	$("#crear_ot,#traslado_ot").dialog({
      autoOpen: false,
      height:x,
      width: ancho_por,
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 1,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
        $(".ui-draggable").css({
        	top:"2px"
        });
		},
      modal: true,
	  resizable: false
    });
	
	$("#desc_ot").dialog({
      autoOpen: false,
      height: x,
	  width: ancho_por,
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 1,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
        $(".ui-draggable").css({
        	top:"2px"
        });
		},
      modal: true,
	  resizable: false
    });
	$("#ventana_archivos_tareas").dialog({
      autoOpen: false,
      height: "400",
	  width: "auto",
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 1,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
        $(".ui-draggable").css({
        	top:"2px"
        });
		},
      modal: true,
	  resizable: false
    });
	
	$("#cerrar_ventana_archivos_adjuntos").on('click',function(){
		$("#ventana_archivos_tareas").dialog('close');
	});
	
	$("#tarea_desc").dialog({
      autoOpen: false,
      height: x,
	  width: ancho_por,
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 1,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
        $(".ui-draggable").css({
        	top:"2px"
        });
		},
      modal: true,
	  resizable: false
    });
	
	/*BRIEF*/
	$("#cancelar_brief_1,#cerrar_ventana_brief1").on('click',function(){
		$("#brief_1").dialog('close');
	});
	$("#cancelar_creativo,#cerrar_ventana_brief2").on('click',function(){
		$("#brief_2").dialog('close');
	});
	
	
	$("#responder_tarea").dialog({
      autoOpen: false,
      height: x,
      width: ancho_por,
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 1,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
        $(".ui-draggable").css({
        	top:"2px"
        });
		},
      modal: true,
	  resizable: false
    });
	
	$("#cerrar_ventana_responder_tarea,#r_cerrar_ingreso_ct").on('click',function(){
		$("#responder_tarea input,#responder_tarea textarea").val("");
		$("#responder_tarea select").val("0");
		$("#responder_tarea").dialog('close');
	});
	
	$("#cerrar_ventana_crear_tarea").on('click',function(){
		$("#crear_tarea input,#crear_tarea textarea").val("");
		$("#crear_tarea select").val("0");
		$("#crear_tarea").dialog('close');
	});
	$("#crear_tarea,#ventana_briefs").dialog({
      autoOpen: false,
      height: x,
      width: ancho_por,
	  open: function () {
        $(".ui-widget-overlay").css({
            opacity: 1,
            filter: "Alpha(Opacity=100)",
            backgroundColor: "black"
        });
        $(".ui-draggable").css({
        	top:"2px"
        });
		},
      modal: true,
	  resizable: false
    });
	
	
	//Formulario para adjuntar un archivo
	$("#adjuntar_arc_ct").dialog({
      autoOpen: false,
      height: "auto",
      width: "auto",
      modal: true,
	  resizable: false
    });
	
	$("#adjuntar_ct").on('click',function(){
		$("#crear_tarea").dialog('close');
		$("#adjuntar_arc_ct").dialog('open');
	});
	$("#subir_ct").on('click',function(){
		$("#crear_tarea").dialog('open');
		$("#adjuntar_arc_ct").dialog('close');
	});
	
	
	
	$(".ui-dialog-titlebar").hide();
	
	
	//ABRIR CREAR OT
	$("#nueva_ot").on('click',function(){
		$(".datos_colpatria").hide();
		$("#crear_ot").dialog( 'open' );
	});
	
	
	//CERRAR FORMULARIO OT
	$("#cerrar_ingreso_ot,#cerrar_ventana_not").on('click',function(){
		$("#crear_ot input").val("");
		$("#crear_ot select").val("");
		$("#crear_ot textarea").val("");
		$("#crear_ot").dialog( 'close' );
	});
	
	$("#tipo_brief").on('change',function(){
		var brief = $("#tipo_brief").val();
		if(brief == 0){
			$("#enviar_ot").show();
			$("#siguiente_brief").hide();
		}else if(brief =="..."){
			$("#enviar_ot").hide();
			$("#siguiente_brief").hide();
		}else{
			$("#siguiente_brief").show();
			$("#enviar_ot").hide();
		}
	});
	
	
	
	$("#depto_rt").on('change',function(){
		var depto = $("#depto_rt").val();
		var usu = $("#codigo_usuario").text();
		var emp = $("#codigo_emp").text();
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:8,depto:depto,usu:usu,emp:emp},
			type:'POST',
			success:function(data){
				$("#responsable_rt").html("");
				$("#responsable_rt").html(data);
				$("#asignado_rt").html("");
				$("#asignado_rt").html(data);
			}
		});
	});
	
	//Crear una ot (Insertar datos)
	$("#enviar_ot,#crear_ot_brief_1").on('click',function(){
		var respuestas_brief = [];
		var inputs_brief = [];
		$("#codigo_ot_interno").text("");
		if($("#tipo_brief").val() == 1){
			$("#brief_1 input").each(function(index){
				inputs_brief.push($(this).val());
			});
			$("#brief_1 textarea").each(function(index){
				if($(this).is(":visible")){
					respuestas_brief.push($(this).val());
				}				
			});
		}else if($("#tipo_brief").val() != 0 || $("#tipo_brief").val() != 1 ){
			$("#brief_1 input").each(function(index){
				inputs_brief.push($(this).val());
			});
			$("#brief_1 textarea").each(function(index){
				respuestas_brief.push($(this).val());
			});
		}
		var num = 0;
		$("#crear_ot textarea,#crear_ot input").each(function(index){
			if($(this).is("visible")){
				if($(this).val().length == 0){
					$(this).css({"border":"1px solid red"});
					alert($(this).val());
					num++;
				}
			}
			
		});
		if($("#grupo_empresas").val() != 0 && $("#cliente").val() != 0 && $("#pro_cliente").val() != 0 && $("#referencia").val().length > 2 && $("#descripcion").val().length > 2 ){
			$("#crear_ot textarea,#crear_ot input").each(function(index){
				$(this).css({"border":"0px"});
			});
			var emp = $("#grupo_empresas").val();
			var clie = $("#cliente").val();
			var pclie = $("#pro_cliente").val();
			var direc = $("#ot_director").val();
			var eje = $("#ejecutivo").val();
			var brief = $("#tipo_brief").val();
			var ref = $("#referencia").val();
			var desc = $("#descripcion").val();
			
			if(clie == 1){
				var cnums = $("#bc_num_solicitud").val();
				var cnoms = $("#bc_nombre_solicitud").val();
				var prof = $("#bc_profesional").val();
				var tpieza = $("#bc_tipopieza").val();
				var trab = $("#bc_objtrabajo").val();
				var medio = $("#bc_medio").val();
				$.ajax({
					url:'busqueda_trafico.php',
					data:{turno:11,emp:emp,clie:clie,pclie:pclie,direc:direc,eje:eje,brief:brief,ref:ref,desc:desc,
					cnums:cnums,cnoms:cnoms,prof:prof,tpieza:tpieza,trab:trab, medio:medio,inputs_brief:inputs_brief,respuestas_brief:respuestas_brief,usu:$("#codigo_usuario").text()},
					type:'POST',
					success:function(data){
						$("#contenedor_resultados_ot").html(data);
						$("#crear_ot input").val("");
						$("#crear_ot select").val("");
						$("#crear_ot textarea").val("");
						$("#crear_ot").dialog( 'close' );
						$("#brief_1").dialog( 'close' );
					}
				});
			}else{
				$.ajax({
					url:'busqueda_trafico.php',
					data:{turno:6,emp:emp,clie:clie,pclie:pclie,direc:direc,eje:eje,brief:brief,ref:ref,desc:desc,inputs_brief:inputs_brief,respuestas_brief:respuestas_brief,usu:$("#codigo_usuario").text()},
					type:'POST',
					success:function(data){
						$("#contenedor_resultados_ot").html(data);
						$("#crear_ot input").val("");
						$("#brief_1 textarea").val("");
						$("#crear_ot textarea").val("");
						$("#crear_ot").dialog( 'close' );
						$("#brief_1").dialog( 'close' );
					}
				});
			}
		}else{
			alert("HAY CAMPOS SIN DILIGENCIAR");
		}		
	});
	
	
	
	/*
	$("#spinner").bind("ajaxSend", function() {
        $(this).show();
    }).bind("ajaxStop", function() {
        $(this).hide();
    }).bind("ajaxError", function() {
        $(this).hide();
    });*/
	//Acciones que se realizan cuando cierro el formulario de crear tareas
	$("#cerrar_ingreso_ct").on('click',function(){
		$("#crear_tarea > textarea").val("");
		$("#crear_tarea > select").val("");
		$("#crear_tarea > input").val("");
		$("#crear_tarea").dialog('close');
	});
	
	//Acciones que realiz cuando cierro responder tarea
	$("#cerrar_ingreso_rt").on('click',function(){
		$("#responder_tarea > textarea").val("");
		$("#responder_tarea > input").val("");
		$("#responder_tarea").dialog('close');
	});
	
	$("#r_enviar_ct").on('click',function(){
		var data = new FormData();
		var ndate = new Date();
		var usux = $("#codigo_usuario").text();
		var asignados = [];
		var responsable = [];
		$("input[name='asig_tarea[]']:checked").each(function() {
			asignados.push($(this).val());
		 });
		$("input[name='respon_tarea[]']:checked").each(function() {
			 responsable.push($(this).val());
		});
		var archivos = document.getElementById("r_archivo_subir_tarea_crear");
		
		var num_ppto = "";
		if($("#ppto_tareas").text().length != 0){
			num_ppto = $("#ppto_tareas").text();
		}else{
			num_ppto = 0;
		}
		
		if($("#r_tipo_tarea_ct").val() != 0){
			if(responsable.length > 0){
				if(asignados.length > 0){
					if($("#r_trabajo_ct").val().length > 0){
						if($("#r_descripcion_ct").val().length > 0){
							if((archivos_tarea_res.length) == 0){
								$.ajax({
									url:'busqueda_trafico.php',
									type:'POST',
									data:{turno:3,depto:$("#r_depto_ct").val(),fecha:$("#r_fechap_ct").val(),h:$("#r_hora_ct").val(),test:0,
									m:$("#r_minuto_ct").val(),formato:$("#r_formato_ct").val(),trabajo:$("#r_trabajo_ct").val(),desc:$("#r_descripcion_ct").val(),razon:$("#r_razondemora_ct").val(),
									tipo:$("#r_tipo_tarea_ct").val(),idot:$("#codigo_ot_interno").text(),tipo_envio:1,usu:$("#codigo_usuario").text(),id:$("#cod_tarea").text(),
									th:ndate.getHours() + ":" + ndate.getMinutes() + ":" + ndate.getSeconds(),num_ppto:num_ppto,id_tarea:$("#cod_tareax").text()},
									success:function(data){
										$("#responder_tarea textarea").val("");
										$("#responder_tarea input").val("");
										$("#responder_tarea").dialog('close');
										$("#responsable_ctx,#asignado_ctx").html("");
										$("#contenedor_resultados_tareas").html(data);
										$.ajax({
												url:'busqueda_trafico.php',
												data:{turno:35,asi:asignados,resp:responsable,usu:$("#codigo_usuario").text(),idot:$("#codigo_ot_interno").text(),num:data},
												type:'post',
												success:function(roe){
														actualizar_tareas();
														$("#crear_tarea textarea").val("");
														$("#crear_tarea select").val("");
														$("#crear_tarea input").val("");
														$("#crear_tarea").dialog('close');
														$("#contenedor_resultados_tareas").html(roe);
												}
											});
									}
								});
								$.ajax({
									url:'busqueda_trafico.php',
									data:{turno:13,id:usux},
									type:'POST',
									success:function(data){
										$("#depto_ct").html(data);
										$("#r_depto_ct").html(data);
									}
								});
							}else if ( archivos_tarea_res.length > 0 && responsable.length != 0 && asignados.length != 0){
								var formData = new FormData();
								formData.append("turno",3);
								formData.append("num_ppto",num_ppto);
								formData.append("id_tarea",$("#cod_tareax").text());
								formData.append("id",$("#cod_tarea").text());
								//formData.append("asi",asignados);
								formData.append("th",ndate.getHours() + ":" + ndate.getMinutes() + ":" + ndate.getSeconds());
								//formData.append("resp",responsable);
								formData.append("depto",$("#r_depto_ct").val());
								formData.append("fecha",$("#r_fechap_ct").val());
								formData.append("h",$("#r_hora_ct").val());
								formData.append("m",$("#r_minuto_ct").val());
								formData.append("formato",$("#r_formato_ct").val());
								formData.append("trabajo",$("#r_trabajo_ct").val());
								formData.append("desc",$("#r_descripcion_ct").val());
								formData.append("razon",$("#r_razondemora_ct").val());
								formData.append("tipo",$("#r_tipo_tarea_ct").val());
								formData.append("idot",$("#codigo_ot_interno").text());
								formData.append("tipo_envio",2);
								formData.append("test",0)
								formData.append("usu",$("#codigo_usuario").text());
								formData.append("num_arc",archivos_tarea_res.length);
								
								$("#contenedor_resultados_tareas").html("");		
								var archivosx = document.getElementById("r_archivo_subir_tarea_crear");
								for(i=0; i<archivos_tarea_res.length; i++){
									formData.append("arc"+i,archivos_tarea_res[i]);	
								}			
								$.ajax({
										url: "busqueda_trafico.php",
										data: formData,
										cache:false,
										contentType: false,
										processData: false,
										type: "post",
										success: function(res){
											$.ajax({
												url:'busqueda_trafico.php',
												data:{turno:35,asi:asignados,resp:responsable,usu:$("#codigo_usuario").text(),idot:$("#codigo_ot_interno").text(),num:res},
												type:'post',
												success:function(roe){
													actualizar_tareas();
													$("#responder_tarea textarea").val("");
													$("#responder_tarea select").val("0");
													$("#responder_tarea input").val("");
													$("#responder_tarea").dialog('close');
													$("#contenedor_resultados_tareas").html(roe);
												}
											});
										}
									});
							}
							archivos_tarea_res = [];
							$("#r_lista_archivos_crear_tareas").html("");
							$("#responder_tarea").dialog('close');
							$("#tarea_desc").dialog('close');
							$("#responsable_ctx,#asignado_ctx").html("");
						}else{
							alert("ESPECIFIQUE UNA DESCRIPCIÓN !");
						}
					}else{
						alert("ESPECIFIQUE UN TÍTULO PARA ESTA TAREA !");
					}
				}else{
					alert("SELECCIONE AL MENOS UN ASIGNADO !");
				}
			}else{
				alert("SELECCIONE AL MENOS UN RESPONSABLE !");
			}
			
		}else{
			alert("NO SE PUEDEN ENVIAR TAREAS SIN ESPECIFICAR EL TIPO DE TAREA !");
		}
			
			
		//}else{
			//alert("DEBE DILIGENCIAR TODOS LOS DATOS !!!");
		//}
		
	});

	$("#r_terminar_tarea").on('click',function(){
		var usux = $("#codigo_usuario").text();
		var asignados = [];
		var responsable = [];
		$("input[name='asig_tarea[]']:checked").each(function() {
			asignados.push($(this).val());
		 });
		$("input[name='respon_tarea[]']:checked").each(function() {
			 responsable.push($(this).val());
		});
		
		if(responsable.length != 0 && asignados.length != 0){
			$.ajax({
				url:'terminartarea.php',
				type:'POST',
				data:{turno:3,test:1,id:$("#cod_tarea").text()},
				success:function(dat){
					alert(dat);
					location.reload();
				}
			});	
		}
		$("#r_lista_archivos_crear_tareas").html("");
		$("#responsable_ctx,#asignado_ctx").html("");
		
		$("#responder_tarea").dialog('close');
	});
	
	
	
	//Insertar tarea ct
	$("#enviar_ct").on('click',function(){
		var ndate = new Date();
		var asignados = [];
		var responsable = [];
		
		$("input[name='asig_tarea[]']:checked").each(function() {
			asignados.push($(this).val());
			console.log("Asignado: "+ $(this).val());
		 });
		 
		$("input[name='respon_tarea[]']:checked").each(function() {
			 responsable.push($(this).val());
			 console.log("Responsable: "+ $(this).val());
		});
		
		var archivos = document.getElementById("archivo_subir_tarea_crear");
		var v = $("#num_ot_sel").text().split("");
		var colpatria = v[0]+v[1]+v[2];
		var txcol = 0;
		
		if(colpatria == "CLP"){
			txcol = $("#campo_tarea_colpatria_adicional").val();
		}else{
			txcol = 0;
		}
		
		if($("#tipo_tarea_ct").val() != 0 ){
			
			if(responsable.length > 0){
				if(asignados.length > 0){
					if($("#trabajo_ct").val().length > 0){
						if($("#descripcion_ct").val().length > 0){
							if((archivos_tarea_crear.length) == 0 ){
								$.ajax({
									url:'busqueda_trafico.php',
									data:{turno:2,asi:asignados,resp:responsable,depto:$("#depto_ct").val(),fecha:$("#fechap_ct").val(),h:$("#hora_ct").val(),
									m:$("#minuto_ct").val(),formato:$("#formato_ct").val(),trabajo:$("#trabajo_ct").val(),desc:$("#descripcion_ct").val(),razon:$("#razondemora_ct").val(),
									tipo:$("#tipo_tarea_ct").val(),idot:$("#codigo_ot_interno").text(),tipo_envio:1,usu:$("#codigo_usuario").text(),
									th:ndate.getHours() + ":" + ndate.getMinutes() + ":" + ndate.getSeconds(),xxpro_colpatria:txcol},
									type:'POST',
									success:function(datx){
										console.log("Codigo Tarea: "+ datx);
										$.ajax({
											url:'busqueda_trafico.php',
											data:{turno:35,asi:asignados,resp:responsable,usu:$("#codigo_usuario").text(),idot:$("#codigo_ot_interno").text(),num:datx},
											type:'post',
											success:function(roe){
												$("#crear_tarea textarea").val("");
												$("#crear_tarea select").val("");
												$("#crear_tarea input").val("");
												$("#crear_tarea").dialog('close');
												$("#contenedor_resultados_tareas").html(roe);
											}
										});
									}
								});
								var usu = $("#codigo_usuario").text();
								$.ajax({
									url:'busqueda_trafico.php',
									data:{turno:13,id:usu},
									type:'POST',
									success:function(data){
										$("#depto_ct").html(data);
										$("#r_depto_ct").html(data);
									}
								});
							}else if((archivos_tarea_crear.length) > 0 ){
								var formData = new FormData();
								formData.append("turno",2);
								formData.append("depto",$("#depto_ct").val());
								formData.append("fecha",$("#fechap_ct").val());
								formData.append("h",$("#hora_ct").val());
								formData.append("m",$("#minuto_ct").val());
								formData.append("formato",$("#formato_ct").val());
								formData.append("trabajo",$("#trabajo_ct").val());
								formData.append("desc",$("#descripcion_ct").val());
								formData.append("razon",$("#razondemora_ct").val());
								formData.append("tipo",$("#tipo_tarea_ct").val());
								formData.append("idot",$("#codigo_ot_interno").text());
								formData.append("xxpro_colpatria",txcol);
								formData.append("tipo_envio",2);
								formData.append("th",ndate.getHours() + ":" + ndate.getMinutes() + ":" + ndate.getSeconds())
								formData.append("usu",$("#codigo_usuario").text());
								formData.append("num_arc",archivos_tarea_crear.length);
								$("#contenedor_resultados_tareas").html("");		
								var archivosx = document.getElementById("archivo_subir_tarea_crear");
								for(i=0; i<archivos_tarea_crear.length; i++){
									formData.append("arc"+i,archivos_tarea_crear[i]);	
								}			
								$.ajax({
										url: "busqueda_trafico.php",
										data: formData,
										cache:false,
										contentType: false,
										processData: false,
										type: "post",
										success: function(res){
											$.ajax({
												url:'busqueda_trafico.php',
												data:{turno:35,asi:asignados,resp:responsable,usu:$("#codigo_usuario").text(),idot:$("#codigo_ot_interno").text(),num:res},
												type:'post',
												success:function(roe){
													var usu = $("#codigo_usuario").text();
													$.ajax({
														url:'busqueda_trafico.php',
														data:{turno:13,id:usu},
														type:'POST',
														success:function(data){
															archivos_tarea_crear =[];
															$("#responsable_ctx,#asignado_ctx").html("");
															$("#crear_tarea textarea").val("");
															$("#crear_tarea select").val("");
															$("#crear_tarea input").val("");
															$("#lista_archivos_crear_tareas").html("");
															$("#crear_tarea").dialog('close');
															$("#contenedor_resultados_tareas").html(roe);
															$("#depto_ct").html(data);
															$("#r_depto_ct").html(data);
														}
													});
													
												}
											});
										}
									});			
							}
						
						}else{
							alert("DEBE INDICAR UNA DESCRIPCIÓN !");
						}
					}else{
						alert("NO SE PUEDEN ENVIAR TAREAS SIN UN TÍTULO DE TRABAJO !");
					}
				}else{
					alert("DEBE SELECCIONAR AL MENOS UN ASIGNADO !");
				}
			}else{
				alert("DEBE SELECCIONAR AL MENOS UN RESPONSABLE !");
			}
			
		}else{
			alert("NO HA SELECCIONADO NINGÚN TIPO DE TAREA!");
		}
		
		$("#campo_adicional_colpatria_ejecutivo").html("");
	});
	
	$("#cerrar_ot_razon").on('click',function(){
		if($("#razon_text_ot").val() == ""){
			alert("DEBE INDICAR LA RAZÓN DEL CIERRE DE LA OT.");
		}else{
			$.ajax({
				url:'busqueda_trafico.php',
				data:{turno:21,id:$("#id_pk_razon_cancelacion").text(),text:$("#razon_text_ot").val()},
				type:'post',
				success:function(data){
					$.ajax({
						url:'busqueda_trafico.php',
						data:{turno:20,id:$("#id_pk_razon_cancelacion").text()},
						type:'POST',
						success:function(data){
							$("#contenedor_ot_seleccionada").html(data);
						}
					});
					alert("OT CERRADA");
					$("#razon_cancelacion_ot").dialog('close');
					$("#razon_cancelacion_ot textarea").val('');
				}
			});
		}
		
	});
	
	$("#nueva_tarea").on('click',function(){
		if($("#codigo_ot_interno").text().length != 0){
			$("#mensaje_crear_tarea").text("CREAR TAREA PARA OT "+$("#num_ot_sel").text());
			var v = $("#num_ot_sel").text().split("");
			var colpatria = v[0]+v[1]+v[2];
			if(colpatria == "CLP"){
				$.ajax({
					url:'busqueda_trafico.php',
					data:{turno:43,ot:$("#num_ot_sel").text()},
					type:'post',
					success:function(d){
						$("#campo_adicional_colpatria_ejecutivo").html("<p>Seleccione el Profesional de Colpatria</p><select id = 'campo_tarea_colpatria_adicional'>"+d+"</select>");
					}
				});
			}
			
			$("#responsable_ctx,#asignado_ctx").html("");
			$("#crear_tarea").dialog('open');
			$("#crear_tarea textarea").val("");
			$("#crear_tarea input").val("");
		}else{
			alert("PARA CREAR UNA TAREA DEBE SELECCIONAR UNA OT PRIMERO !!!");
		}
		
	});
	
	//EVENTO GRUPO EMPRESAS
	$("#grupo_empresas").on('change',function(){
		var emp = $("#grupo_empresas").val();
		var usu = $("#codigo_usuario").text();
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:4,emp:emp,usu:usu},
			type:'POST',
			success:function(data){
				$("#cliente").html("");
				$("#cliente").append(data);
			}
		});
	});
	$("#grupo_empresas2").on('change',function(){
		var emp = $("#grupo_empresas2").val();
		var usu = $("#codigo_usuario").text();
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:4,emp:emp,usu:usu},
			type:'POST',
			success:function(data){
				$("#cliente2").html("");
				$("#cliente2").append(data);
			}
		});
	});
	$("#grupo_empresasx").on('change',function(){
		var emp = $("#grupo_empresasx").val();
		var usu = $("#codigo_usuario").text();
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:4,emp:emp,usu:usu},
			type:'POST',
			success:function(data){
				$("#list_clientesx").html("");
				$("#list_clientesx").append(data);
			}
		});
	});
	
	
	//EVENTO CLIENTE
	$("#cliente").on('change',function(){
		$("#pro_cliente").html("");
		var clie = $("#cliente").val();
		var usu = $("#codigo_usuario").text();
		if(clie == 1){
			$(".datos_colpatria").show("slow");
		}else{
			$(".datos_colpatria").hide("slow");
		}
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:5,clie:clie,usu:usu},
			type:'POST',
			success:function(data){
				$("#pro_cliente").html("");
				$("#pro_cliente").append(data);
			}
		});
	});
	
	$("#cliente2").on('change',function(){
		$("#pro_cliente2").html("");
		var clie = $("#cliente2").val();
		var usu = $("#codigo_usuario").text();
		
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:5,clie:clie,usu:usu},
			type:'POST',
			success:function(data){
				$("#pro_cliente2").html("");
				$("#pro_cliente2").append(data);
			}
		});
	});

	$("#list_clientesx").on('change',function(){
		var usu = $("#codigo_usuario").text();
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:5,clie:$("#list_clientesx").val(),usu:usu},
			type:'POST',
			success:function(data){
				$("#list_productos_clientesx").html(data);
			}
		});
	});
	
	$("#traslador_ot_ot").on('click',function(){
		var dat = new FormData();
		dat.append('empresa',$("#grupo_empresas2").val());
		dat.append('cliente',$("#cliente2").val());
		dat.append('producto',$("#pro_cliente2").val());
		dat.append('referencia',$("#referencia2").val());
		dat.append('descripcion',$("#descripcion2").val());
		dat.append('id_ot',$("#codigo_ot_interno").text());
		dat.append("turno",25);
		$.ajax({
			url:'busqueda_trafico.php',
			data:dat,
			type:'post',
			contentType:false,
			processData:false,
			success:function(datax){
				alert("OT TRASLADA");
				//alert(datax);
				$("#traslado_ot input").val("");
				$("#traslado_ot").dialog('close');
				$("#contenedor_resultados_ot").html(datax);
			}
		});
	});
	//CARGA DE RESPONSABLE Y ASIGNADO SEGÚN EL DEPARTAMENTO.
	var ancho_cuadro = $( "#ventana_reportes_trafico" ).width();
	var alto_menu_financiero = (x*62)/100;
	$("#panel_opciones,#contenedor_opciones").css({'height':alto_menu_financiero,"overflow":"scroll"});
	

});
	function cerrar_ventanas(id){
		$("#"+id).dialog('close');
	}
	function abrir_ventanas(id){
		$("#"+id+" input").val("0");
		$("#"+id).dialog('open');
	}

	function responder(xx,oot){
		$("#cod_tarea").text(xx);
		$("#codigo_ot_interno").text(oot);
		$("#mensaje_respon_tarea").text("RESPONDER TAREA PARA OT "+$("#num_ot_sel").text());
		var usu = $("#codigo_usuario").text();
			$.ajax({
				url:'busqueda_trafico.php',
				data:{turno:13,id:usu},
				type:'POST',
				success:function(data){
					$("#depto_ct").html(data);
					//$("#r_depto_ct").html(data);
				}
			});
			$.ajax({
				url:'busqueda_trafico.php',
				data:{turno:39,id:xx,usu:usu},
				type:'POST',
				success:function(data){
					$("#r_depto_ct").html(data);
					$.ajax({
						url:'busqueda_trafico.php',
						data:{turno:40,id:xx,usu:usu,depto:$("#r_depto_ct").val()},
						type:'POST',
						success:function(data){
							$("#r_responsable_ctx").html(data);
						}
					});
					$.ajax({
						url:'busqueda_trafico.php',
						data:{turno:41,id:xx,usu:usu,depto:$("#r_depto_ct").val()},
						type:'POST',
						success:function(data){
							$("#r_asignado_ctx").html(data);
						}
					});
				}
			});
			
			$.ajax({
				url:'busqueda_trafico.php',
				data:{turno:42,id:xx,usu:usu},
				type:'POST',
				success:function(data){
					var dat = data.split("<+++***>");
					$("#r_tipo_tarea_ct").html(dat[0]);
					$("#r_trabajo_ct").val("Re:"+dat[1]);
					$("#r_fechap_ct").val(dat[2]);
				}
			});
			var ndate = new Date();
			//ndate.getHours() + ":" + ndate.getMinutes()
			$("#r_hora_ct").append("<option value = '"+ndate.getHours()+"' selected>"+ndate.getHours()+"</option>");
			$("#r_minuto_ct").append("<option value = '"+ndate.getMinutes()+"' selected>"+ndate.getMinutes()+"</option>");
			
		$("#responder_tarea textarea").val("");
		$("#responder_tarea input").val("");
		$("#responder_tarea").dialog('open');
	}
	function cargar_enviar_a(){
		var usu = $("#codigo_usuario").text();
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:14,depto:$("#depto_ct").val()},
			type:'post',
			success:function(data){
				$("#responsable_ctx").html(data);
			}
		});
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:7,usu:usu,depto:$("#depto_ct").val()},
			type:'post',
			success:function(data){
				$("#asignado_ctx").html(data);
			}
		});
	}
	
	function cargar_enviar_a2(){
		var usu = $("#codigo_usuario").text();
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:14,depto:$("#r_depto_ct").val()},
			type:'post',
			success:function(data){
				$("#r_responsable_ctx").html(data);
			}
		});
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:7,usu:usu,depto:$("#r_depto_ct").val()},
			type:'post',
			success:function(data){
				$("#r_asignado_ctx").html(data);
			}
		});
		
	}
	
	function visualizar_tareas_ot(xx){
		var usu = $("#codigo_usuario").text();
		$("#codigo_ot_interno").text(xx);
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:10,ot:xx,usu:usu},
			type:'POST',
			success:function(data){
				$("#contenedor_resultados_tareas").html(data);
			}
		});
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:13,id:usu},
			type:'POST',
			success:function(data){
				$("#depto_ct").html(data);
				$("#r_depto_ct").html(data);
			}
		});
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:20,id:xx},
			type:'POST',
			success:function(data){
				$("#contenedor_ot_seleccionada").html(data);
				$(".class_ie").html("<a href = '#' id = 'bus3' onclick = 'agregar_informe_entrevista()'><img src = '../images/iconos/iconos-20.png' class = 'iconos_opciones mano' title = 'Informe de Entrevista' /></a>");
				$(".class_tras").html("<a href = '#'id = 'bus2' onclick = 'translador_ot()'><img src = '../images/iconos/icon-23.png' class = 'iconos_opciones mano' title = 'Trasladar OT' /></a>");
				$(".class_brief").html("<a href = '#'id = 'bus3' onclick = 'consultar_briefs_ot()'><img src = '../images/iconos/icon-22.png' class = 'iconos_opciones mano' title = 'Brief' /></a>");
			}
		});
		
	}
	
	function buscar_ots(){
		//$("#codigo_ot_interno").text("");
		//alert("Largo "+$( window ).height() + " " + "Ancho " + $( window ).width());
		$("#contenedor_ot_seleccionada").html("");
		var usu = $("#codigo_usuario").text();
		var criterio = $("#criterio_busqueda").val();
		var ano = $("#ano").val();
		var buscar = $("#buscar").val();
		var estado = $("#estado").val();
		$.ajax({
			url:'busqueda_trafico.php',
			data:{c:criterio,a:ano,turno:1,b:buscar,e:estado,usu:usu},
			type: 'post',
			success:function(data){
				$("#contenedor_resultados_ot").html("");
				$("#contenedor_resultados_ot").append(data);

			}
		});

	}
	
	/*function buscar_tareas(){
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:2},
			type: 'POST',
			success:function(data){
				$("#contenedor_resultados_tareas").html("");
				$("#contenedor_resultados_tareas").append(data);
			}
		});
	}*/
	
	function cancelar_tarea(xx){
		
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:15,id:xx,usu:$("#codigo_usuario").text()},
			type:'post',
			success:function(data){
				$("#contenedor_resultados_tareas").html(data);
			}
		});
	}
	
	function eliminar_archivo_subir_tarea(x){
		archivos_tarea_crear.splice(x,1);
		$("#lista_archivos_crear_tareas").html("");
		for(i=0; i<archivos_tarea_crear.length; i++){
			$("#lista_archivos_crear_tareas").append("<tr><td><img src = '../images/iconos/eliminar.png' height = '25px' onclick = 'eliminar_archivo_subir_tarea("+i+")'/></td><td style = 'padding-left:5px;'>"+archivos_tarea_crear[i].name+"</td></tr>");
		}
		$("#archivo_subir_tarea_crear").splice(x,1);
	}
	function eliminar_archivo_subir_rtarea(x){
		archivos_tarea_res.splice(x,1);
		$("#r_lista_archivos_crear_tareas").html("");
		for(i=0; i<archivos_tarea_res.length; i++){
			$("#r_lista_archivos_crear_tareas").append("<tr><td><img src = '../images/iconos/eliminar.png' height = '25px' onclick = 'eliminar_archivo_subir_rtarea("+i+")'/></td><td style = 'padding-left:5px;'>"+archivos_tarea_res[i].name+"</td></tr>");
		}
		$("#r_archivo_subir_tarea_crear").splice(x,1);
	}
	function mostrar_descripcion(id){
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:26,xx:id},
			type:'post',
			success:function(datax){
				$("#desc_ot").html("");
				$("#desc_ot").html(datax);
				//alert(datax);
			}
		});
		$("#desc_ot").dialog('open');
	}
	
	function abrir_tareas(xx){
		$("#tarea_desc").html("");
		$("#cod_tareax").text(xx);
		var usu = $("#codigo_usuario").text();
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:16,id:xx,usu:usu,ot:$("#codigo_ot_interno").text()},
			type:'post',
			success:function(data){
				$("#tarea_desc").html(data);
			}
		});
		$("#tarea_desc").dialog('open');
	}
	
	function imprSelec(muestra){
		var ficha=document.getElementById(muestra);
		var ventimp=window.open(' ','popimpr');
		ventimp.document.write(ficha.innerHTML);
		ventimp.document.write('<link rel="stylesheet" type="text/css" href="../css/reportes.css" />');
		ventimp.document.close();
		ventimp.print();
		ventimp.close();
	}
	
	function abrir_brief(){
		var id = $("#tipo_brief").val();
		$("#producto_marca_brief_1").val($("#pro_cliente option:selected").text());
		$("#desarrollador_por_brief1").val($("#ejecutivo option:selected").text());
		$("#tabla_trafico_creativo").hide();
		
		if( $("#tipo_brief").val() == 1 ){
			$("#brief_1 .nbriefcreativos,#brief_1 .nbriefcrm").hide();
			$("#brief_1 .nbriefall").show();
		}else if( $("#tipo_brief").val() == 3 ){
			$("#brief_1 .nbriefall,#brief_1 .nbriefcreativos").hide();
			$("#brief_1 .nbriefcrm").show();
		}else {
			$("#brief_1 .nbriefcrm").hide();
			$("#brief_1 .nbriefcreativos,.nbriefall").show();
		}
		$("#brief_1").dialog('open');
	}
	
	function cerrar_ventana_detalle_tarea(){
		$("#tarea_desc").dialog('close');
	}
	
	function cerrar_ventana_detalle_ot(){
		$("#desc_ot").dialog('close');
	}
	
	function abrir_ventana_adjuntos(numero,id){
		if(numero == 0){
			alert("ESTA TAREA NO CONTIENE ADJUNTOS !!!");
		}else{
			$.ajax({
				url:'busqueda_trafico.php',
				data:{turno:17,id:id},
				type:'post',
				success:function(data){
					$("#contenedor_ventana_archivos_tareas").html(data);
					$("#ventana_archivos_tareas").dialog('open');
				}
			});
		}
	}
	
	function visualizar_tarea_pendiente(xx,yy){
		$("#tarea_desc").html("");
		var usu = $("#codigo_usuario").text();
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:16,id:xx,usu:usu,ot:yy},
			type:'post',
			success:function(data){
				$("#tarea_desc").html(data);
			}
		});
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:37,id:xx,usu:usu,ot:yy},
			type:'post',
			success:function(data){
				$("#contenedor_resultados_ot").html(data);
			}
		});
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:36,id:xx,usu:usu,ot:yy},
			type:'post',
			success:function(data){
				$("#contenedor_resultados_tareas").html(data);
			}
		});
		$("#tarea_desc").dialog('open');
	}
	
	function buscar_ots_briefs(){
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:18,empresa:$("#grupo_empresasx").val(),cliente:$("#list_clientesx").val(),producto:$("#list_productos_clientesx").val()},
			type:'post',
			success:function(data){
				$("#list_ot_briefs").html(data);
			}
		});
	}
	
	function consultar_briefs_ot(){
		if($("#num_ot_sel").text().length != 0){
			$(".mensaje_brief_consulta").text("BRIEFS OT "+$("#num_ot_sel").text());
			$.ajax({
				url:'busqueda_trafico.php',
				data:{turno:19,id:$("#num_ot_sel").text()},
				type:'post',
				success:function(data){
					$("#contenedor_listado_brief").html(data);
				}
			});
			$("#ventana_briefs").dialog('open');
		}else{
			alert("DEBE SELECCIONAR UNA OT PARA REALIZAR ESTA ACCIÓN !!!");
		}
		
	}
	
	function mostrar_barra_reporte(clase){
		$(".hijos_reporte_tareas,.hijos_reporte_ot").hide();
		$("."+clase).toggle();

	}
	
	function nouncheck(id){
		/*$("#respon"+id).prop('checked', true);
		alert("NO SE PUEDEN DESACTIVAR LOS RESPONSABLES");*/
	}
	
	function cerrar_ot_razon(id){
		$("#id_pk_razon_cancelacion").text(id);
		$("#mensaje_cierre_ot").text("CIERRE DE OT " + $("#num_ot_sel").text());
		$("#razon_cancelacion_ot").dialog('open');
		$("#razon_cancelacion_ot textarea").val('');
	}
	function translador_ot(){
		if($("#codigo_ot_interno").text().length != 0){
			$("#text_tras_ot").text("TRASLADO DE OT " + $("#num_ot_sel").text());
			$.ajax({
				url:'busqueda_trafico.php',
				data:{turno:24,id:$("#codigo_ot_interno").text()},
				type:'post',
				success:function(data){
					var dat = data.split("__**__");
					$("#referencia2").val(dat[0]);
					$("#descripcion2").val(dat[1]);
				}
			});
			$("#traslado_ot").dialog('open');
		}else{
			alert("DEBE SELECCIONAR UNA OT PARA REALIZAR ESTA ACCIÓN !!!");
		}
	}

	function abrir_ventana_adjt_ppto(){
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:28,id:$("#cod_tareax").text()},
			type:'post',
			success:function(dat){
				if(dat == 1){
					$.ajax({
						url:'busqueda_trafico.php',
						data:{turno:27,ot:$("#codigo_ot_interno").text()},
						type:'post',
						success:function(datax){
							$("#contenedor_adj_ppto").html(datax);
						}
					});
					$("#adjuntar_ppto_tarea").dialog('open');
				}else{
					alert("ESTE GRUPO DE TAREAS YA CUENTA CON UN PPTO ADJUNTO !");
				}
			}
		});
		
	}

	function adjuntar_ppto_meth(){
		$("#ppto_tareas").text($('input:radio[name=select_ppto_t]:checked').val());
		$("#adjuntar_ppto_tarea").dialog('close');
	}

	function agregar_informe_entrevista(){
		if($("#num_ot_sel").text().length != 0){
			/**/
			$.ajax({
				url:'busqueda_trafico.php',
				data:{turno:30,id:$("#codigo_ot_interno").text()},
				type:'post',
				success:function(datax){
					$("#contenedor_listado_ie").html(datax);
				}
			});
			$("#ventana_informes").dialog('open');
		}else{
			alert("DEBE SELECCIONAR UNA OT PARA REALIZAR ESTA ACCIÓN !");
		}
		
	}

	function abrir_nuevo_informe_ie(){
		if(temas_tratados_ie.length > 0){
			$( "#compromisosAgenciaBoton" ).show();
			$( "#compromisosClienteBoton" ).show();
		}else{
			$( "#compromisosAgenciaBoton" ).hide();
			$( "#compromisosClienteBoton" ).hide();
		}
		
		$("#mensaje_ie").text("INFORME DE ENTREVISTA PARA OT "+$("#num_ot_sel").text());
		$("#informe_entrevista").dialog('open');
		/////DANIEL

		// Get the modal
		var modalAsistente = document.getElementById('asistentesReunion');
		var modalTemas = document.getElementById('temasReunion');
		var modal = document.getElementById('compromisosAgencia');
		var modalCliente = document.getElementById('compromisosCliente');

		// Get the button that opens the modal
		var btnCreatedAsistente = document.getElementById("asistentesBoton");
		var btnCreatedTemas = document.getElementById("temasTratadosBoton");
		var btnCreated = document.getElementById("compromisosAgenciaBoton");
		var btnCreatedCliente = document.getElementById("compromisosClienteBoton");

		// Get the <span> element that closes the modal
		var spanCreatedAsistente = document.getElementsByClassName("closeCreated")[0];
		var spanCreatedTemas = document.getElementsByClassName("closeCreated")[1];
		var spanCreated = document.getElementsByClassName("closeCreated")[2];
		var spanCreatedCliente = document.getElementsByClassName("closeCreated")[3];
			
		// When the user clicks on the button, open the modal 
		

		btnCreatedAsistente.onclick = function() {
			modalAsistente.style.display = "block";
		}
		
		btnCreated.onclick = function() {
			modal.style.display = "block";
		}

		btnCreatedCliente.onclick = function() {
			modalCliente.style.display = "block";
		}

		btnCreatedTemas.onclick = function() {
			modalTemas.style.display = "block";
		}

		// When the user clicks on <span> (x), close the modal
		
		
		spanCreatedAsistente.onclick = function() {
			modalAsistente.style.display = "none";
		}
		
		spanCreated.onclick = function() {
			modal.style.display = "none";
		}
		spanCreatedCliente.onclick = function() {
			modalCliente.style.display = "none";
		}

		spanCreatedTemas.onclick = function() {
			modalTemas.style.display = "none";
		}
		

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			
			if (event.target == modalAsistente) {
				modalAsistente.style.display = "none";
			}
			
			if (event.target == modal) {
				modal.style.display = "none";
			}
			if (event.target == modalCliente) {
				modalCliente.style.display = "none";
			}
			
			if (event.target == modalTemas) {
				modalTemas.style.display = "none";
			}
			
		}
		////DANIEL
		$("#cancelar_ie,#add_informe_entrevista_ot").css("display","none");

		
	}



	function add_int_empresa_ie(){
		if( $("#add_name_ie_e").val().length != 0 && $("#add_cargo_ie_e").val().length != 0){
			asistentes_agencia.push($("#add_name_ie_e").val().toUpperCase() + " - "+$("#add_cargo_ie_e").val().toUpperCase());
			$("#add_name_ie_e,#add_cargo_ie_e").val("");
			var contenido = "<table width = '100%' style = 'padding:0px;'>";
			for(var i = 0; i < asistentes_agencia.length; i++){
				contenido +="<tr><td><img src = '../images/iconos/eliminar.png' width = '17px' onclick = 'eliminar_item_asist_emp("+i+")'/></td><td><p>"+asistentes_agencia[i]+"</p></td></tr>";
			}
			$("#cnt_asis_emp").html(contenido+"</table>");
		}else{
			alert("NINGUNO DE LOS CAMPOS DEBE ESTAR VACIO; \nPARA AGREGAR UN ASISTENTE DEBE DILIGENCIAR AMBOS CAMPOS ! ");
		}
	}
	function eliminar_item_asist_emp(i){
		asistentes_agencia.splice(i,1);
		var contenido = "<table width = '100%' >";
		for(var i = 0; i < asistentes_agencia.length; i++){
			contenido +="<tr><td><img src = '../images/iconos/eliminar.png' width = '17px' onclick = 'eliminar_item_asist_emp("+i+")'/></td><td><p>"+asistentes_agencia[i]+"</p></td></tr>";
		}
		$("#cnt_asis_emp").html(contenido+"</table>");
	}
	function add_int_cliente_ie(){
		if( $("#add_name_ie_c").val().length != 0 && $("#add_cargo_ie_c").val().length != 0){
			asistentes_cliente.push($("#add_name_ie_c").val().toUpperCase() + " - "+$("#add_cargo_ie_c").val().toUpperCase());
			$("#add_name_ie_c,#add_cargo_ie_c").val("");
			var contenido = "<table width = '100%' style = 'padding:0px;'>";
			for(var i = 0; i < asistentes_cliente.length; i++){
				contenido +="<tr><td><img src = '../images/iconos/eliminar.png' width = '17px' onclick = 'eliminar_item_asist_clie("+i+")'/></td><td><p>"+asistentes_cliente[i]+"</p></td></tr>";
			}
			$("#cnt_asis_clie").html(contenido+"</table>");
			////DANIEL
			  $( "#asistentesReunion" ).fadeOut(200);
			  ////DANIEL
		}else{
			alert("NINGUNO DE LOS CAMPOS DEBE ESTAR VACIO; \nPARA AGREGAR UN ASISTENTE DEBE DILIGENCIAR AMBOS CAMPOS ! ");
		}
	}
	function eliminar_item_asist_clie(i){
		asistentes_cliente.splice(i,1);
		var contenido = "<table width = '100%' >";
		for(var i = 0; i < asistentes_cliente.length; i++){
			contenido +="<tr><td><img src = '../images/iconos/eliminar.png' width = '17px' onclick = 'eliminar_item_asist_clie("+i+")'/></td><td><p>"+asistentes_cliente[i]+"</p></td></tr>";
		}
		$("#cnt_asis_clie").html(contenido+"</table>");
	}

	function cerrar_ventana_informe_entrevista(){
		$("#informe_entrevista textarea,#informe_entrevista input").val("");
		asistentes_cliente = [];
		asistentes_agencia = [];
	}

	

	function grafica_time_table(){
		$("#time_table").dialog("open");$(".scroll").css({"overflow-y":"hidden"});
		var ndate = new Date();
		var alto = ($("#time_table").height()*70)/100;
		var fecha_hoy = ndate.getFullYear()+'-'+(ndate.getMonth()+1)+'-'+ndate.getDate();
		var datax = [];
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:33},
			type:'post',
			success:function(datay){
				var n_empresa = datay.split("<->");
				var total = 0;
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");
				}
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");
					datax.push({title:utl[0],start:utl[2],end:utl[1],color:utl[3]});					
				}
				$('#calendar').fullCalendar({
					theme:true,
					height:720,
						header: {
							left: 'prev,next today',
							center: 'title',
							right: 'month,agendaWeek,agendaDay'
						},
						
						//timezone:"America/Bogota",
						lang:'es',
						defaultDate: fecha_hoy,
						buttonIcons: true, // show the prev/next text
						weekNumbers: true,
						weekends:true,
						editable: false,
						dayNamesShort:['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
						monthNames:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
						eventLimit: true, // allow "more" link when too many events
						eventRender: function(event, element) 
						{ 
							
							var temp_var = element[0].outerHTML;
							var tempvar = temp_var.split("#EF8C14");
							
							if(tempvar.length > 1){
								element[0].innerHTML = '<div class="fc-content " title = "Cumpleaños !"><table width = "100%"><tr><td style = "vertical-align:middle;"><span class="fc-title">'+element[0].innerText+'</span></td><td align = "right"><img src = "../images/tarta.png" width = "20px"/></td></tr></div>';
							}else{
								element[0].innerHTML = '<div class="fc-content" style = "vertical-align:middle;"> <span class="fc-title">'+element[0].innerText+'</span></div>';
							}
						},
						/*eventMouseover:function(calEvent, jsEvent, view){
							$(".tooltipevent").text('');
							var tooltip = '<div class="tooltipevent" style="padding:5px;color:white;background: black;display: inline;border-radius:0.3em;-moz-border-radius:0.3em;-webkit-border-radius:0.3em;-khtml-border-radius: 0.3em;position:absolute;z-index:10001;">' + calEvent.title + '</div>';
						    $("body").append(tooltip);
						    $(this).mouseover(function(e) {
						        $(this).css('z-index', 10000);
						        $('.tooltipevent').fadeIn('500');
						        $('.tooltipevent').fadeTo('10', 1.9);
						    }).mousemove(function(e) {
						        $('.tooltipevent').css('top', e.pageY + 10);
						        $('.tooltipevent').css('left', e.pageX + 20);
						    });
						},*/

						events: datax
				});
		
			}
		});
	}
	
	
	function grafica_colpatria(){
		var tabla = "<table width = '100%'  class = 'tabla_reportes_col'><tr><th>EJECUTIVO</th><th>CANTIDAD</th><th>%</th></tr>";
		var datax = [];
		$.ajax({
			url:'busqueda_reportes.php',
			data:{t:14,fd:$("#fdesde_ot_c").val(),fh:$("#fhasta_ot_c").val()},
			type:'post',
			success:function(datay){
				$("#chart_div_ots_eje,#tabla_divs_ots_eje").html("");
				var n_empresa = datay.split("<->");
				var total = 0;
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");
					total +=parseFloat(utl[1]);
				}
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");					
					datax.push({y:((parseInt(utl[1])*100)/total), legendText:utl[0],label:utl[0],x:utl[1],name:utl[2]});
					tabla+="<tr><td>"+utl[0]+"</td><td align = 'center'>"+utl[1]+"</td><td align = 'center'>"+parseFloat(((parseInt(utl[1])*100)/total)).toFixed(2)+" %</td></tr>";
				}
				tabla+="<tr><td ><strong>TOTAL</strong></td><td align = 'center'><strong>"+total+"</strong></td><td><strong align = 'center'>100%</strong></td></tr>";
				$("#tabla_divs_ots_eje").html(tabla);
				var chart = new CanvasJS.Chart("chart_div_ots_eje",
				{
					backgroundColor: "rgb(232, 232, 232)",
					height:$("#chart_div_ots_eje").height(),
					title:{
						text: "OTS POR EJECUTIVOS",
						fontsize:12,
						fontWeight:"normal",
						fontFamily: "Open Sans"
					},
					exportFileName: "Pie Chart",
					exportEnabled: true,
							animationEnabled: true,
					legend:{
						verticalAlign: "center",
						horizontalAlign: "left",
						fontSize: 12,
						fontFamily: "Open Sans",
						cursor:"pointer",
						itemclick:function(e){graficar_nivel_cliente_ot(est,empresa,dir,e.dataPoint.name);}
					},
					theme: "theme1",
					data: [
					{        
						type: "pie",       
						indexLabelFontFamily: "Open Sans",       
						indexLabelFontColor:"black",
						 
						indexLabelFontSize: 12,
						indexLabel: "#percent %",
						startAngle:-60,      
						showInLegend: true,
						toolTipContent:"<strong>{x} OTS</strong>",
						dataPoints: datax
					}
					]
				});
			chart.render();
			}
		});
		grafica_procolpatria();
		grafica_tareas_colpatria();
		grafica_tareas_procolpatria();
	}
	function grafica_procolpatria(){
		var tabla = "<table width = '100%'  class = 'tabla_reportes_col'><tr><th>PROFESIONAL</th><th>CANTIDAD</th><th>%</th></tr>";
		var datax = [];
		$.ajax({
			url:'busqueda_reportes.php',
			data:{t:15,fd:$("#fdesde_ot_c").val(),fh:$("#fhasta_ot_c").val()},
			type:'post',
			success:function(datay){
				$("#chart_div_ots_pro,#tabla_divs_ots_pro").html("");
				var n_empresa = datay.split("<->");
				var total = 0;
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");
					total +=parseFloat(utl[1]);
				}
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");					
					datax.push({y:((parseInt(utl[1])*100)/total), legendText:utl[0],label:utl[0],x:utl[1],name:utl[2]});
					tabla+="<tr><td>"+utl[0]+"</td><td align = 'center'>"+utl[1]+"</td><td align = 'center'>"+parseFloat(((parseInt(utl[1])*100)/total)).toFixed(2)+" %</td></tr>";
				}
				tabla+="<tr><td ><strong>TOTAL</strong></td><td align = 'center'><strong>"+total+"</strong></td><td><strong align = 'center'>100%</strong></td></tr>";
				$("#tabla_divs_ots_pro").html(tabla);
				var chart = new CanvasJS.Chart("chart_div_ots_pro",
				{
					backgroundColor: "rgb(232, 232, 232)",
					height:$("#chart_div_ots_eje").height(),
					title:{
						text: "OTS PROFESIONALES",
						fontsize:12,
						fontWeight:"normal",
						fontFamily: "Open Sans"
					},
					exportFileName: "Pie Chart",
					exportEnabled: true,
							animationEnabled: true,
					legend:{
						verticalAlign: "center",
						horizontalAlign: "left",
						fontSize: 12,
						fontFamily: "Open Sans",
						cursor:"pointer",
						itemclick:function(e){graficar_nivel_cliente_ot(est,empresa,dir,e.dataPoint.name);}
					},
					theme: "theme1",
					data: [
					{        
						type: "pie",       
						indexLabelFontFamily: "Open Sans",       
						indexLabelFontColor:"black",
						 
						indexLabelFontSize: 12,
						indexLabel: "#percent %",
						startAngle:-60,      
						showInLegend: true,
						toolTipContent:"<strong>{x} OTS</strong>",
						dataPoints: datax
					}
					]
				});
			chart.render();
			}
		});
	}
	
	function grafica_tareas_colpatria(){
		var tabla = "<table width = '100%'  class = 'tabla_reportes_col'><tr><th>EJECUTIVO</th><th>CANTIDAD</th><th>%</th></tr>";
		var datax = [];
		$.ajax({
			url:'busqueda_reportes.php',
			data:{t:16,fd:$("#fdesde_ot_c").val(),fh:$("#fhasta_ot_c").val()},
			type:'post',
			success:function(datay){
				$("#chart_div_tareas_eje,#tabla_divs_tareas_eje").html("");
				var n_empresa = datay.split("<->");
				var total = 0;
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");
					total +=parseFloat(utl[1]);
				}
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");					
					datax.push({y:((parseInt(utl[1])*100)/total), legendText:utl[0],label:utl[0],x:utl[1],name:utl[2]});
					tabla+="<tr><td>"+utl[0]+"</td><td align = 'center'>"+utl[1]+"</td><td align = 'center'>"+parseFloat(((parseInt(utl[1])*100)/total)).toFixed(2)+" %</td></tr>";
				}
				tabla+="<tr><td ><strong>TOTAL</strong></td><td align = 'center'><strong>"+total+"</strong></td><td><strong align = 'center'>100%</strong></td></tr>";
				$("#tabla_divs_tareas_eje").html(tabla);
				var chart = new CanvasJS.Chart("chart_div_tareas_eje",
				{
					backgroundColor: "rgb(232, 232, 232)",
					height:$("#chart_div_tareas_eje").height(),
					title:{
						text: "TAREAS EJECUTIVOS",
						fontsize:12,
						fontWeight:"normal",
						fontFamily: "Open Sans"
					},
					exportFileName: "Pie Chart",
					exportEnabled: true,
							animationEnabled: true,
					legend:{
						verticalAlign: "center",
						horizontalAlign: "left",
						fontSize: 12,
						fontFamily: "Open Sans",
						cursor:"pointer",
						itemclick:function(e){graficar_nivel_cliente_ot(est,empresa,dir,e.dataPoint.name);}
					},
					theme: "theme1",
					data: [
					{        
						type: "pie",       
						indexLabelFontFamily: "Open Sans",       
						indexLabelFontColor:"black",
						 
						indexLabelFontSize: 12,
						indexLabel: "#percent %",
						startAngle:-60,      
						showInLegend: true,
						toolTipContent:"<strong>{x} OTS</strong>",
						dataPoints: datax
					}
					]
				});
			chart.render();
			}
		});
	}
	
	
	function grafica_tareas_procolpatria(){
		var tabla = "<table width = '100%'  class = 'tabla_reportes_col'><tr><th>PROFESIONAL</th><th>CANTIDAD</th><th>%</th></tr>";
		var datax = [];
		$.ajax({
			url:'busqueda_reportes.php',
			data:{t:17,fd:$("#fdesde_ot_c").val(),fh:$("#fhasta_ot_c").val()},
			type:'post',
			success:function(datay){
				$("#chart_div_tareas_pro,#tabla_divs_tareas_pro").html("");
				var n_empresa = datay.split("<->");
				var total = 0;
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");
					total +=parseFloat(utl[1]);
				}
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");					
					datax.push({y:((parseInt(utl[1])*100)/total), legendText:utl[0],label:utl[0],x:utl[1],name:utl[2]});
					tabla+="<tr><td>"+utl[0]+"</td><td align = 'center'>"+utl[1]+"</td><td align = 'center'>"+parseFloat(((parseInt(utl[1])*100)/total)).toFixed(2)+" %</td></tr>";
				}
				tabla+="<tr><td ><strong>TOTAL</strong></td><td align = 'center'><strong>"+total+"</strong></td><td><strong align = 'center'>100%</strong></td></tr>";
				$("#tabla_divs_tareas_pro").html(tabla);
				var chart = new CanvasJS.Chart("chart_div_tareas_pro",
				{
					backgroundColor: "rgb(232, 232, 232)",
					height:$("#chart_div_tareas_eje").height(),
					title:{
						text: "TAREAS PROFESIONALES",
						fontsize:12,
						fontWeight:"normal",
						fontFamily: "Open Sans"
					},
					exportFileName: "Pie Chart",
					exportEnabled: true,
							animationEnabled: true,
					legend:{
						verticalAlign: "center",
						horizontalAlign: "left",
						fontSize: 12,
						fontFamily: "Open Sans",
						cursor:"pointer",
						itemclick:function(e){graficar_nivel_cliente_ot(est,empresa,dir,e.dataPoint.name);}
					},
					theme: "theme1",
					data: [
					{        
						type: "pie",       
						indexLabelFontFamily: "Open Sans",       
						indexLabelFontColor:"black",
						 
						indexLabelFontSize: 12,
						indexLabel: "#percent %",
						startAngle:-60,      
						showInLegend: true,
						toolTipContent:"<strong>{x} OTS</strong>",
						dataPoints: datax
					}
					]
				});
			chart.render();
			}
		});
	}
	
	function actualizar_tareas(){
		$("#spinner").bind("ajaxSend", function() {
	        $(this).show();
	    }).bind("ajaxStop", function() {
	        $(this).show();
	    }).bind("ajaxError", function() {
	        $(this).show();
	    });
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:9,usuario:$("#codigo_usuario").text()},
			type:'POST',
			success:function(data){
				$("#pendientes_contestadas").html(data);
			}
		});
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:23,usuario:$("#codigo_usuario").text()},
			type:'POST',
			success:function(data){
				$("#list_contestadas").html(data);
			}
		});
		/*$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:32,usuario:$("#codigo_usuario").text()},
			type:'POST',
			success:function(data){
				if(data != 0){
					alertify.log("TIENES "+data + " TAREA(S) NUEVA(S)"); 
					return false;
				}
			}
		});
		$.ajax({
			url:'busqueda_trafico.php',
			data:{turno:38,usu:$("#codigo_usuario").text()},
			type:'POST',
			success:function(data){
				$("#title_alertas_tareas").title = 'TIENES '+data;
				$("#alerta_tareas").text(data);
			}
		});*/
	}
	//setInterval(actualizar_tareas, 200);
	
	
	