$(document).ready(function(){
	
	$(window).resize(function(){

		var ancho_x = $(window).width();
		var ancho_por = (ancho_x*99)/100;
		var ancho_por2 = (ancho_x*98)/100;
		var alto = $(window).height();
		var x = (alto*99)/100;

		if($(window).height() < 400 || $(window).width() < 1100){
			$("#info_basica_empresa").css({'min-width':"1000px","min-height":"700px"});
			$( ".ventana" ).dialog( "option", "min-width", "1000px" );
			$( ".ventana" ).dialog( "option", "min-height", "700px" );
			$( ".ventana" ).dialog( "option", "width", ancho_por );
			$( ".ventana" ).dialog( "option", "height", x );
		}else{
			//$(".ui-dialog-content .ui-widget-content").css({'height':x+'px',"width":ancho_por+'px'});
			//$("#info_basica_empresa").css({'height':x+'px',"width":ancho_por+'px'});
			 var d = $("#info_basica_empresa").dialog();
			 //alert(ancho_por);
			 $( ".ventana" ).dialog( "option", "width", ancho_por );
			 $( ".ventana" ).dialog( "option", "min-width", "1000px" );
			 $( ".ventana" ).dialog( "option", "height", x );
			 $( ".ventana" ).dialog( "option", "min-height", "700px" );
			 $(".ui-draggable").css({
	        	top:"2px"
	        });

			var resolution=$(window).height();
			var font = 6;
			var font2 = 5;
			var width = $(window).width();
			var newfont = font*(width/resolution);
			var newfont2 = font2*(width/resolution);
			$(".ventana > .mensaje_bienvenida").css("font-size",newfont2);
			$(".ventana > .tabla_nuevos_datos td").css("font-size",newfont);
			$(".ventana > .tabla_nuevos_datos2 td").css("font-size",newfont);
		}
	});
});