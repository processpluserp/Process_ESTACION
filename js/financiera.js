$(document).ready(function(){
	
	
	$("#empresa_financiero").on('change',function(){
		if($("#empresa_financiero").val() != 0) {
			$.ajax({
				url:'gestion_all2.php',
				data:{t:4,emp:$("#empresa_financiero").val()},
				type:'post',
				success:function(d){
					$("#und_financiera").html(d);
				}
			});
		}
	});
});
function generar_cuadros_financieros(){
	$.ajax({
		url:'gestion_all2.php',
		data:{t:178,emp:$("#empresa_financiero").val(),und:$("#und_financiera").val()},
		type:'post',
		success:function(d){
			$("#contenedor_principal").html(d);
		}
	});
}
