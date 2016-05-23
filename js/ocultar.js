var info_empleado = 1;
var info_sal = 1;
var info_ssp = 1;

$(document).ready(function(){	
	$("#sal_integral,#sal_minimo,#monetizacion_sena,#aux_transporte,#und_empresa,#departamentos_empresa,#nota_op_produccion,#nota_oc_produccion,.list_banco_nuevo_producto,#pl_negocio").hide();
	$(".tr_padre_nomina,#usuarios_x_empresa,#abrir_permisos_usuarios,#respon_deptos,#permisos_clientes_p,#asignados_tareas,#permisos_usuarios_empresas_p,#permisos_director_usuario_p,#min_valor_pptos,.reporte_colpatria").hide();
});

function mostrar_nuevo_producto(){
	if($("#list_banco_nuevo_producto").is(":visible")){
		alert("h");
		$(".list_banco_nuevo_producto").hide();
	}else{
		$(".list_banco_nuevo_producto").show("fast");
	}
	
}
function ocultar_sub_menu_duplicar_nomina(){
	$(".hijo_duplicar_nomina").toggle("fast");
	$(".hijo_nomina_mensual_uno_uno").hide();
}
function resaltar_imagen_seleccionada(id){
		$(".img_menu_desplieg").css({"filter":"alpha(opacity=50)","-moz-opacity":"0.5","-webkit-opacity":"0.5","opacity":"0.5"});
		$("#"+id).css({"filter":"alpha(opacity=100)","-moz-opacity":"1","-webkit-opacity":"1","opacity":"1"});
	}
function ocultar_uno_uno_nomina(){
	$("#nomina_uno_uno_id").css({"filter":"alpha(opacity=100)","-moz-opacity":"1","-webkit-opacity":"1","opacity":"1"});
	$(".hijo_nomina_mensual_uno_uno").toggle("fast");
	$(".hijo_duplicar_nomina").hide();
}
function mostrar_opciones_nomina(id){
	$("#und_empresa,#departamentos_empresa,#nota_op_produccion,#usuarios_x_empresa,#respon_deptos,#asignados_tareas,#permisos_usuarios_empresas_p,#permisos_director_usuario_p,#permisos_clientes_p,#min_valor_pptos").hide();
	if($("#sal_integral").is(":visible")){
		//$("#"+id).css({"padding":"20px"});
		$("#sal_integral,#sal_minimo,#monetizacion_sena,#aux_transporte").hide();
	}else{
		//$("#"+id).css({"padding":"5px"});
		$("#sal_integral,#sal_minimo,#monetizacion_sena,#aux_transporte").show();
	}
	
	
	
}

function ocultar_listado_usuarios(){
	$(".hijo_listado_usuario").toggle();
}

function ocultar_nuevo_usuario(){
	$(".hijo_nuevo_usuario").toggle();
}

function ocultar_nota_ppto(){
	$(".hijo_nota_ppto").toggle();
}

function ocultar_nota_op(){
	$(".hijo_nota_op").toggle();
}

function ocultar_nota_oc(){
	$(".hijo_nota_oc").toggle();
}
function ocultar_jerarquia_empresa(){
	$("#sal_minimo,#sal_integral,#monetizacion_sena,#aux_transporte,#usuarios_x_empresa,#respon_deptos,#asignados_tareas,#permisos_usuarios_empresas_p,#permisos_director_usuario_p,#permisos_clientes_p,#min_valor_pptos").hide();
	if($("#und_empresa").is(":visible")){
		//$("#jerarquia_empresa").css({"padding":"20px"});
		$("#und_empresa,#departamentos_empresa,#nota_op_produccion,#nota_oc_produccion,#pl_negocio,#min_valor_pptos").hide();
	}else{
		//$("#jerarquia_empresa").css({"padding":"5px"});
		$("#und_empresa,#departamentos_empresa,#nota_op_produccion,#nota_oc_produccion,#pl_negocio,#min_valor_pptos").show("fast");
	}
}

function ocultar_opciones_sistema(){
	$("#sal_minimo,#sal_integral,#monetizacion_sena,#aux_transporte,#und_empresa,#departamentos_empresa,#nota_op_produccion,#pl_negocio,#min_valor_pptos").hide();
	$("#usuarios_x_empresa,#abrir_permisos_usuarios,#respon_deptos,#permisos_clientes_p,#asignados_tareas,#permisos_usuarios_empresas_p,#permisos_director_usuario_p").toggle("fast");
}
function ocultar_fvencimiento_documentos(){
	var val = $("#v_fvencimiento").val();
	if(val == 0){
		$("#tabla_contenedor_documentos_empresa th:nth-child(2)").show();
		$("#tabla_contenedor_documentos_empresa tr td:nth-child(2)").show();
		$("#v_fvencimiento").val("1");
	}else{
		$("#tabla_contenedor_documentos_empresa th:nth-child(2)").hide();
		$("#tabla_contenedor_documentos_empresa tr td:nth-child(2)").hide();
		$("#v_fvencimiento").val("0");
	}
}

function ocultar_correos_documentos(){
	var val = $("#v_correos").val();
		if(val == 0){
			$("#tabla_contenedor_documentos_empresa th:nth-child(3)").show();
			$("#tabla_contenedor_documentos_empresa tr td:nth-child(3)").show();
			$("#v_correos").val("1");
		}else{
			$("#tabla_contenedor_documentos_empresa th:nth-child(3)").hide();
			$("#tabla_contenedor_documentos_empresa tr td:nth-child(3)").hide();
			$("#v_correos").val("0");
		}
}

function ocultar_descarga_documentos(){
	var val = $("#v_descarga").val();
		if(val == 0){
			$("#tabla_contenedor_documentos_empresa th:nth-child(4)").show();
			$("#tabla_contenedor_documentos_empresa tr td:nth-child(4)").show();
			$("#v_descarga").val("1");
		}else{
			$("#tabla_contenedor_documentos_empresa th:nth-child(4)").hide();
			$("#tabla_contenedor_documentos_empresa tr td:nth-child(4)").hide();
			$("#v_descarga").val("0");
		}
}
function ocultar_descarga_documentos2(){
	var val = $("#v_descarga").val();
		if(val == 0){
			$("#tabla_contenedor_documentos_empresa th:nth-child(5)").show();
			$("#tabla_contenedor_documentos_empresa tr td:nth-child(5)").show();
			$("#v_descarga").val("1");
		}else{
			$("#tabla_contenedor_documentos_empresa th:nth-child(5)").hide();
			$("#tabla_contenedor_documentos_empresa tr td:nth-child(5)").hide();
			$("#v_descarga").val("0");
		}
}

function ocultar_nombre_archivo_documentos(){
	var val = $("#v_nombre_archivo").val();
	if(val == 0){
		$("#tabla_contenedor_documentos_empresa th:nth-child(2)").show();
		$("#tabla_contenedor_documentos_empresa tr td:nth-child(2)").show();
		$("#v_nombre_archivo").val("1");
	}else{
		$("#tabla_contenedor_documentos_empresa th:nth-child(2)").hide();
		$("#tabla_contenedor_documentos_empresa tr td:nth-child(2)").hide();
		$("#v_nombre_archivo").val("0");
	}
}

function ocultar_fecha_carga_documentos(){
	var val = $("#v_fcarga").val();
		if(val == 0){
			$("#tabla_contenedor_documentos_empresa th:nth-child(4)").show();
			$("#tabla_contenedor_documentos_empresa tr td:nth-child(4)").show();
			$("#v_fcarga").val("1");
		}else{
			$("#tabla_contenedor_documentos_empresa th:nth-child(4)").hide();
			$("#tabla_contenedor_documentos_empresa tr td:nth-child(4)").hide();
			$("#v_fcarga").val("0");
		}
}

function ocultar_cargado_por_documentos(){
	var val = $("#v_cpor").val();
		if(val == 0){
			$("#tabla_contenedor_documentos_empresa th:nth-child(3)").show();
			$("#tabla_contenedor_documentos_empresa tr td:nth-child(3)").show();
			$("#v_cpor").val("1");
		}else{
			$("#tabla_contenedor_documentos_empresa th:nth-child(3)").hide();
			$("#tabla_contenedor_documentos_empresa tr td:nth-child(3)").hide();
			$("#v_cpor").val("0");
		}
}

function ocultar_prestaciones_sociales_nd(){
	$("#tabla_nd_ss").toggle();
	if($("#tabla_nd_ss").is(':Visible')){
		$("#triangulo_ss_nd div").removeClass();
		$("#triangulo_ss_nd div").addClass('triangulo_sup');
	}else{
		$("#triangulo_ss_nd div").removeClass();
		$("#triangulo_ss_nd div").addClass('triangulo_inf');
	}
	
}
function ocultar_nomina_nd(){
	$("#tabla_nomina_nd").toggle();
	if($("#tabla_nomina_nd").is(':Visible')){
		$("#triangulo_nomina_nd div").removeClass();
		$("#triangulo_nomina_nd div").addClass('triangulo_sup');
	}else{
		$("#triangulo_nomina_nd div").removeClass();
		$("#triangulo_nomina_nd div").addClass('triangulo_inf');
	}
}
function ocultar_bnp_nd(){
	$("#tabla_bnp_nd").toggle();
	if($("#tabla_bnp_nd").is(':Visible')){
		$("#triangulo_bnp_nd div").removeClass();
		$("#triangulo_bnp_nd div").addClass('triangulo_sup');
	}else{
		$("#triangulo_bnp_nd div").removeClass();
		$("#triangulo_bnp_nd div").addClass('triangulo_inf');
	}
}
function ocultar_admins_nd(){
	$("#tabla_admin_nd").toggle();
	if($("#tabla_admin_nd").is(':Visible')){
		$("#triangulo_admin_nd div").removeClass();
		$("#triangulo_admin_nd div").addClass('triangulo_sup');
	}else{
		$("#triangulo_admin_nd div").removeClass();
		$("#triangulo_admin_nd div").addClass('triangulo_inf');
	}
}
function ocultar_ps_nd(){
	$("#tabla_ps_nd").toggle();
	if($("#tabla_ps_nd").is(':Visible')){
		$("#triangulo_ps_nd div").removeClass();
		$("#triangulo_ps_nd div").addClass('triangulo_sup');
	}else{
		$("#triangulo_ps_nd div").removeClass();
		$("#triangulo_ps_nd div").addClass('triangulo_inf');
	}
}
function ocultar_indp_nd(){
	$("#tabla_indep_nd").toggle();
	if($("#tabla_indep_nd").is(':Visible')){
		$("#triangulo_indp_nd div").removeClass();
		$("#triangulo_indp_nd div").addClass('triangulo_sup');
	}else{
		$("#triangulo_indp_nd div").removeClass();
		$("#triangulo_indp_nd div").addClass('triangulo_inf');
	}
}

function ocultar_info_empleado_pd(){
	var val = $("#v_info_emp").val();
	if(val == 1){
		$("#info_empleado,.inf_empleado").hide();
		$("#v_info_emp").val("0");
	}else{
		$("#info_empleado,.inf_empleado").show();
		$("#v_info_emp").val("1");
	}
	
	/*if(info_empleado == 0){
		$(".inf_empleado").css({"font-size":"0.9em","background-color":"#ECECEC"});
		$("#personal_down_emple th").css({"background-color":"white"});
		$(".inf_empleado").css({"width":"auto"});
		$("#info_empleado").html("INFORMACIÓN EMPLEADO");
		$("#info_empleado").css({"width":"auto"});
		$("#info_empleado").removeClass("tooltip");
		info_empleado = 1;
	}else{
		$(".inf_empleado").css({"font-size":"0px","width":"0%","background-color":"white"});
		$("#info_empleado").html("");
		$("#info_empleado").css({"width":"0%"});
		$("#info_empleado").addClass("tooltip");
		$("#info_empleado").html("<span>INFORMACIÓN EMPLEADO</span>");
		info_empleado = 0;
	}*/
}

function ocultar_info_salarial_pd(){
	var val = $("#v_info_Sal").val();
	if(val == 1){
		$("#composicion_salarial,.info_sal").hide();
		$("#v_info_Sal").val("0");
	}else{
		$("#composicion_salarial,.info_sal").show();
		$("#v_info_Sal").val("1");
	}
	
	/*if(info_sal == 0){
		$(".info_sal").css({"font-size":"0.9em","background-color":"#ECECEC"});
		$("#personal_down_emple th").css({"background-color":"white"});
		$(".info_sal td").toggle();
		$("#composicion_salarial").html("COMPOSICIÓN SALARIAL");
		$("#composicion_salarial").css({"width":"auto"});
		$("#composicion_salarial").removeClass("tooltip");
		info_sal = 1;
	}else{
		$(".info_sal").css({"font-size":"0px","width":"0%","padding":"0px","background-color":"white"});
		$(".info_sal td").toggle();
		$("#composicion_salarial").html("");
		$("#composicion_salarial").css({"width":"0%","padding":"0px"});
		$("#composicion_salarial").addClass("tooltip");
		$("#composicion_salarial").html("<span>COMPOSICIÓN SALARIAL</span>");
		info_sal = 0;
	}*/
}

function ocultar_info_ssp_pd(){
	var val = $("#v_info_ssp").val();
	if(val == 1){
		$("#ss_pf,.ss_pf").hide();
		$("#v_info_ssp").val("0");
	}else{
		$("#ss_pf,.ss_pf").show();
		$("#v_info_ssp").val("1");
	}
	/*if(info_ssp == 0){
		$(".ss_pf").css({"font-size":"0.9em","background-color":"#ECECEC"});
		$("#personal_down_emple th").css({"background-color":"white"});
		$(".ss_pf td").toggle();
		$("#ss_pf").html("SEGURIDAD SOCIAL Y PARAFISCALES");
		$("#ss_pf").css({"width":"auto"});
		$("#ss_pf").removeClass("tooltip");
		info_ssp = 1;
	}else{
		$(".ss_pf").css({"font-size":"0px","width":"0%","padding":"0px","background-color":"white"});
		$(".ss_pf td").toggle();
		$("#ss_pf").html("");
		$("#ss_pf").css({"width":"0%","padding":"0px"});
		$("#ss_pf").addClass("tooltip");
		$("#ss_pf").html("<span>SEGURIDAD SOCIAL Y PARAFISCALES</span>");
		info_ssp = 0;
	}*/
}

function ocultar_pps_i_pd(){
	var val = $("#v_ppsi").val();
	if(val == 1){
		$("#pps_i,.pps_i").hide();
		$("#v_ppsi").val("0");
	}else{
		$("#pps_i,.pps_i").show();
		$("#v_ppsi").val("1");
	}
}

function ocultar_horizontal_pd(x){
	$("#"+x).toggle();
	$("#t"+x).toggle();
	$("."+x).toggle();
}

function ocultar_prestaciones_sociales(){
	$(".op_prestaciones_sociales").toggle();
	if($(".op_prestaciones_sociales").is(':Visible')){
		$("#triangulo_pshj_nd div").removeClass();
		$("#triangulo_pshj_nd div").addClass('triangulo_sup');
	}else{
		$("#triangulo_pshj_nd div").removeClass();
		$("#triangulo_pshj_nd div").addClass('triangulo_inf');
	}
}

function ocultar_seguridad_social(){
	$(".op_seguridad_social").toggle();
	if($(".op_seguridad_social").is(':Visible')){
		$("#triangulo_sshj_nd div").removeClass();
		$("#triangulo_sshj_nd div").addClass('triangulo_sup');
	}else{
		$("#triangulo_sshj_nd div").removeClass();
		$("#triangulo_sshj_nd div").addClass('triangulo_inf');
	}
}

function ocultar_aportes_parafiscales(){
	$(".op_aportes_parafiscales").toggle();
	if($(".op_aportes_parafiscales").is(':Visible')){
		$("#triangulo_apshj_nd div").removeClass();
		$("#triangulo_apshj_nd div").addClass('triangulo_sup');
	}else{
		$("#triangulo_apshj_nd div").removeClass();
		$("#triangulo_apshj_nd div").addClass('triangulo_inf');
	}
}

function ocultar_deducciones(){
	$(".op_deducciones").toggle();
	if($(".op_deducciones").is(':Visible')){
		$("#triangulo_ddshj_nd div").removeClass();
		$("#triangulo_ddshj_nd div").addClass('triangulo_sup');
	}else{
		$("#triangulo_ddshj_nd div").removeClass();
		$("#triangulo_ddshj_nd div").addClass('triangulo_inf');
	}
}


function ocultar_submenus_nomina_cuadros(id){
	resaltar_imagen_seleccionada(id);
	$("#admin_ppto").hide();
	$(".tr_padre_nomina,#crea_nomina_mes,#consultar_nomina").toggle("fast");
}

function ocultar_submenus_ppto_cuadros(id){
	resaltar_imagen_seleccionada(id);
	$(".tr_padre_nomina,#crea_nomina_mes,#consultar_nomina").hide();
	$("#admin_ppto").toggle("fast");
}

function ocultar_hijos_ppto_anual(){
	$(".hijo_nuevo_ppto").toggle("fast");
	$(".hijo_nuevo_grupo_ppto").hide();
	$(".hijo_add_grupo").hide();
	$(".hijos_items_pppto_general").hide();
	$(".consultar_ppto_general").hide();
}
function ocultar_hijos_grupo_ppto_anual(){
	$(".hijo_nuevo_grupo_ppto").toggle("fast");
	$(".hijo_nuevo_ppto").hide();
	$(".hijo_add_grupo").hide();
	$(".hijos_items_pppto_general").hide();
	$(".consultar_ppto_general").hide();
}
function ocultar_hijos_grupo_ppto(){
	$(".hijo_add_grupo").toggle("fast");
	
}
function ocultar_hijos_consultar_grupo(){
	$(".hijo_consutar_grupo").toggle("fast");
	
}
function ocultar_hijos_items_ppto_general(){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:0},
		type:'post',
		success:function(data){
			$("#listado_grupos_ppto_general").html(data);
		}
	});
	$(".hijos_items_pppto_general").toggle("fast");
	$(".hijo_nuevo_ppto").hide();
	$(".hijo_nuevo_grupo_ppto").hide();
	$(".consultar_ppto_general").hide();
}
function ocultar_consultar_ppto_general(){
	$(".consultar_ppto_general").toggle("fast");
}

function ocultar_mes(x){
	$("#oa_all_mes").prop('checked', false); 
	$(".mesx"+x).toggle();
}

function ocultar_nuevo_sal_minimo(){
	$("#contenedor_nuevo_sal_minimo").toggle("fast");
}

function ocultar_hijo_historico_sal_min(){
	$("#contenedor_registros_salarios").toggle("fast");
}
var estado_checked = 0;
function ocultar_mes_all(){
	if($("#oa_all_mes").prop('checked') == false){
		
		for(var i = 1; i <= 12;i++){
			$(".mesx"+i).hide();
		}
		$("#tabla_todos_los_mes_ppto_general .checkbox_ppto_general input[type=checkbox]").prop('checked', false); 
		//$("#oa_all_mes").prop('checked', true);
	}else if($("#oa_all_mes").prop('checked') == true){
		for(var i = 1; i <= 12;i++){
			$(".mesx"+i).show();
		}
		$("#tabla_todos_los_mes_ppto_general .checkbox_ppto_general input[type=checkbox]").prop('checked', true); 
		//$("#oa_all_mes").prop('checked', false);
	}
}
function ocultar_consultar_und(){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:109,emp:$("#empresa_final").text()},
		type:'post',
		success:function(data){
			$(".hijo_und_negocio").html("<td>"+data+"</td>");
		}
	});
	$(".hijo_add_und").hide();
	$(".hijo_und_negocio").toggle();
}
function ocultar_add_und_empresa(){
	$(".hijo_und_negocio").hide();
	$(".hijo_add_und").toggle();
}

function ocultar_consultar_areas(){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:111,emp:$("#empresa_final").text(),und:0},
		type:'post',
		success:function(data){
			$("#contenedor_departamentos_und_empresax").html(data);
		}
	});
	$(".hijo_add_deptos").hide();
	$(".hijo_consultar_deptos").toggle();
}

function ocultar_add_areas(){
	$(".hijo_consultar_deptos").hide();
	$(".hijo_add_deptos").toggle();
}
