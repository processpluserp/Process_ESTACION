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
$(document).ready(function(){
	
	/*FECHAS*/
	$("#fdesde_ot,#fdesde_ot_c").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#fhasta_ot,#fhasta_ot_c").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#fhasta_tareas").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#fdesde_tareas").datepicker({ dateFormat: 'yy-mm-dd' });
	
	$("#reporte_ots").dialog({
      autoOpen: false,
      height: "520",
      width: "90%",
	  resizable: false
    });
	
	$("#reporte_tareas").dialog({
      autoOpen: false,
      height: "520",
      width: "90%",
	  resizable: false
    });
	
	$("#b_reporteot").on('click',function(){
		$("#reporte_ots").dialog('open');
	});
	$("#b_reportetareas").on('click',function(){
		$("#reporte_tareas").dialog('open');
	});
	
	/*$(".ui-dialog-titlebar").hide();*/
	
	
	/*EVENTOS */
	
	$("#empresa_rot").on('change',function(){
		var emp = $("#empresa_rot").val();
		var usu = $("#codigo_usuario").text();
		$.ajax({
			url:'busqueda_reportes.php',
			data:{t:1,emp:emp,usu:usu},
			type:'post',
			success:function(data){
				$("#cliente_rot").html("");
				$("#cliente_rot").html(data);
			}
		});
	});
	
	$("#empresa_rtareas").on('change',function(){
		var emp = $("#empresa_rtareas").val();
		var usu = $("#codigo_usuario").text();
		$.ajax({
			url:'busqueda_reportes.php',
			data:{t:1,emp:emp,usu:usu},
			type:'post',
			success:function(data){
				$("#cliente_rtareas").html("");
				$("#cliente_rtareas").html(data);
			}
		});
		$.ajax({
			url:'busqueda_reportes.php',
			data:{t:3,emp:emp},
			type:'post',
			success:function(data){
				$("#depto_tareas").html("");
				$("#depto_tareas").html(data);
			}
		});
	});
	
	
	function add_arreglos_Pie(datax){
		var ctx = document.getElementById("canvas_rots").getContext("2d");
        var myNewChart = new Chart(ctx).Pie(datax);
		$("#canvas_rots").click( 
            function(evt){
				var activePoints = myNewChart.getSegmentsAtEvent(evt);
                var url = "http://example.com/?label=" + activePoints[0].label + "&value=" + activePoints[0].value;
                alert(url);
            }
        ); 
	}
	
	function getRandomColor() {
		var letters = '0123456789ABCDEF'.split('');
		var color = '#';
		for (var i = 0; i < 6; i++ ) {
			color += letters[Math.floor(Math.random() * 16)];
		}
		return color;
	}
	
	function graficar_departamento_cumplimiento_tipos_tareas_ot(est,empresa,dir,cliente,eje,producto,tipotarea,cumplimiento){
		var datax = [];
		var datax2 = [];
		$.ajax({
			url:'busqueda_reportes.php',
			data:{t:13,emp:empresa,est:est,dir:dir,clie:cliente,prod:producto,fd:$("#fdesde_ot").val(),fh:$("#fhasta_ot").val(),eje:eje,tpt:tipotarea,cumplimiento:cumplimiento},
			type:'post',
			success:function(datay){
				$("#canvas_rots").html("");
				var n_empresa = datay.split("<->");
				var total = 0;
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");
					total +=parseFloat(utl[1]);
				}
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");					
					datax.push({y:((parseInt(utl[1])*100)/total), legendText:utl[0],label: utl[0],x:utl[1],name:utl[2],click:function(e){graficar_nivel_tipos_tarea_ot(est,empresa,dir,cliente,eje,producto);}});
					datax2.push({y:(parseInt(utl[1])),label:(parseInt(utl[1])),indexLabel: utl[0] });
				}
				var chart = new CanvasJS.Chart("canvas_rots",
				{	backgroundColor: "rgb(232, 232, 232)",
					height:$("#canvas_rots").height(),
					title:{
						text: "CUMPLIMIENTO DE DEPARTAMENTOS POR OTS"
					},
					exportFileName: "Pie Chart",
					exportEnabled: true,
					animationEnabled: true,
					legend:{
						verticalAlign: "center",
						horizontalAlign: "left",
						cursor:'pointer',
						fontSize: 12,
						fontFamily: "Open Sans",
						itemclick:function(e){graficar_nivel_tipos_tarea_ot(est,empresa,dir,cliente,eje,producto);}
					},
					theme: "theme1",
					data: [
					{        
						type: "pie",       
						indexLabelFontFamily: "Open Sans",       
						indexLabelFontSize: 12,
						indexLabel: "{y} %",
						startAngle:-60,      
						showInLegend: true,
						toolTipContent:"<strong>{x} TAREAS</strong>",
						dataPoints: datax
					}
					]
				});
			chart.render();
			
			var chart = new CanvasJS.Chart("chart_div",{
				backgroundColor: "rgb(232, 232, 232)",
				height:$("#canvas_rots").height(),
				title:{
					text: "CUMPLIMIENTO DE DEPARTAMENTOS POR OTS"    
				},
				exportFileName: "Pie Chart",
				exportEnabled: true,
				bevelEnabled: true,
				animationEnabled: true,
				axisY: {
					title: "CANTIDAD DE OTS",
						labelFontFamily:"Open Sans",
						gridThickness:1
					},
					axisX: {
						//labelAngle: -30
						labelFontFamily:"Open Sans"
					},
					legend: {
						verticalAlign: "bottom",
						horizontalAlign: "center",
						cursor:'pointer',
						fontFamily: "Open Sans",
						fontSize: 12,
						itemclick:function(e){graficar_nivel_tipos_tarea_ot(est,empresa,dir,cliente,eje,producto);}
					},
					theme: "theme2",
					data: [{        
						bevelEnabled: true,
						type: "bar",  
						showInLegend: true, 
						legendMarkerColor: "grey",
						legendText: "# DE OTS",
						indexLabelFontColor:"black",
						indexLabelFontFamily: "Open Sans",
						indexLabelFontSize: 12,
						 
						indexLabelPlacement: "inside",
                		indexLabelFontColor: "black",
						indexLabel:"{y}",
						cursor:"pointer",
						dataPoints: datax2
					}]
				});
				chart.render();
			}
		});
	}
	
	
	function graficar_cumplimiento_tipos_tareas_ot(est,empresa,dir,cliente,eje,producto,tipotarea){
		var datax = [];
		var datax2 = [];
		$.ajax({
			url:'busqueda_reportes.php',
			data:{t:12,emp:empresa,est:est,dir:dir,clie:cliente,prod:producto,fd:$("#fdesde_ot").val(),fh:$("#fhasta_ot").val(),eje:eje,tpt:tipotarea},
			type:'post',
			success:function(datay){
				$("#canvas_rots").html("");
				var n_empresa = datay.split("<->");
				var total = 0;
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");
					total +=parseFloat(utl[1]);
				}
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");					
					datax.push({y:((parseInt(utl[1])*100)/total), legendText:utl[0],label: utl[0],x:utl[1],name:utl[2],click:function(e){graficar_nivel_tipos_tarea_ot(est,empresa,dir,cliente,eje,producto);}});
					datax2.push({y:(parseInt(utl[1])),label:(parseInt(utl[1])),indexLabel: utl[0] });
				}
				var chart = new CanvasJS.Chart("canvas_rots",
				{	backgroundColor: "rgb(232, 232, 232)",
					height:$("#canvas_rots").height(),
					title:{
						text: "CUMPLIMIENTO DE TAREA POR OTS",
						fontWeight:"normal",
						fontFamily: "Open Sans"
					},
					exportFileName: "Pie Chart",
					exportEnabled: true,
					animationEnabled: true,
					legend:{
						verticalAlign: "center",
						horizontalAlign: "left",
						fontWeight:"normal",
						fontFamily: "Open Sans",
						cursor:'pointer',
						fontSize: 12,
						fontFamily: "Open Sans",
						itemclick:function(e){graficar_departamento_cumplimiento_tipos_tareas_ot(est,empresa,dir,cliente,eje,producto,tipotarea,e.dataPoint.name);}
					},
					theme: "theme1",
					data: [
					{        
						type: "pie",       
						indexLabelFontFamily: "Open Sans",
						fontWeight:"normal",
						fontFamily: "Open Sans",
						indexLabelFontColor:"black",
						       
						indexLabelFontSize: 12,
						indexLabel: "{y} %",
						startAngle:-60,      
						showInLegend: true,
						toolTipContent:"<strong>{x} TAREAS</strong>",
						dataPoints: datax
					}
					]
				});
			chart.render();
			
			var chart = new CanvasJS.Chart("chart_div",{
				backgroundColor: "rgb(232, 232, 232)",
				height:$("#canvas_rots").height(),
				height:$("#canvas_rots").height(),
				title:{
					text: "CUMPLIMIENTO DE TAREA POR OTS" ,
						fontWeight:"normal",
						fontFamily: "Open Sans"   
				},
				exportFileName: "Pie Chart",
				exportEnabled: true,
				bevelEnabled: true,
				animationEnabled: true,
				axisY: {
					title: "CANTIDAD DE OTS",
						fontWeight:"normal",
						fontFamily: "Open Sans",
						gridThickness:1,
						labelFontFamily:"Open Sans"
					},
					axisX: {
						//labelAngle: -30
						labelFontFamily:"Open Sans"
					},
					legend: {
						verticalAlign: "bottom",
						horizontalAlign: "center",
						cursor:'pointer',
						fontFamily: "Open Sans",
						fontSize: 12,
						itemclick:function(e){graficar_departamento_cumplimiento_tipos_tareas_ot(est,empresa,dir,cliente,eje,producto,tipotarea,e.dataPoint.name);}
					},
					theme: "theme2",
					data: [{        
						bevelEnabled: true,
						type: "bar",  
						showInLegend: true, 
						legendMarkerColor: "grey",
						legendText: "# DE OTS",
						indexLabelFontColor:"black",
						indexLabelFontFamily: "Open Sans",
						indexLabelFontSize: 12,
						 
						indexLabelPlacement: "inside",
                		indexLabelFontColor: "black",
						indexLabel:"{y}",
						cursor:"pointer",
						dataPoints: datax2
					}]
				});
				chart.render();
			}
		});
	}
	
	function graficar_nivel_tipos_tarea_ot(est,empresa,dir,cliente,eje,producto){
		var datax = [];
		var datax2 = [];
		$.ajax({
			url:'busqueda_reportes.php',
			data:{t:10,emp:empresa,est:est,dir:dir,clie:cliente,prod:producto,fd:$("#fdesde_ot").val(),fh:$("#fhasta_ot").val(),eje:eje},
			type:'post',
			success:function(datay){
				
				$("#canvas_rots").html("");
				var n_empresa = datay.split("<->");
				var total = 0;
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");
					total +=parseFloat(utl[1]);
				}
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");					
					datax.push({y:((parseInt(utl[1])*100)/total), legendText:utl[0],label: utl[0],x:utl[1],name:utl[2],click:function(e){alert(e.dataPoint.name);}});
					datax2.push({y:(parseInt(utl[1])),label:(parseInt(utl[1])) ,indexLabel: utl[0]});
				}
				var chart = new CanvasJS.Chart("canvas_rots",
				{	backgroundColor: "rgb(232, 232, 232)",
					height:$("#canvas_rots").height(),
					title:{
						text: "TIPOS DE TAREA POR PRODUCTO",
						fontWeight:"normal",
						fontFamily: "Open Sans"
					},
					exportFileName: "Pie Chart",
					exportEnabled: true,
					animationEnabled: true,
					legend:{
						verticalAlign: "center",
						horizontalAlign: "left",
						cursor:'pointer',
						fontSize: 12,
						fontFamily: "Open Sans",
						itemclick:function(e){graficar_cumplimiento_tipos_tareas_ot(est,empresa,dir,cliente,eje,producto,e.dataPoint.name);}
					},
					theme: "theme1",
					data: [
					{        
						type: "pie",       
						indexLabelFontColor:"black",
						 
						indexLabelFontFamily: "Open Sans",
						fontWeight:"normal",
						fontFamily: "Open Sans",     
						indexLabelFontSize: 12,
						indexLabel: "#percent %",
						startAngle:-60,      
						showInLegend: true,
						toolTipContent:"<strong>{x} TAREAS</strong>",
						dataPoints: datax
					}
					]
				});
			chart.render();
			
			var chart = new CanvasJS.Chart("chart_div",{
				backgroundColor: "rgb(232, 232, 232)",
				height:$("#canvas_rots").height(),
				title:{
					text: "TIPOS DE TAREA POR PRODUCTO" ,
						fontWeight:"normal",
						fontFamily: "Open Sans"
				},
				exportFileName: "Pie Chart",
				exportEnabled: true,
				bevelEnabled: true,
				animationEnabled: true,
				axisY: {
					title: "CANTIDAD DE OTS",
						fontWeight:"normal",
						fontFamily: "Open Sans",
						gridThickness:1
				},
				axisX: {
					//labelAngle: -30
				},
				legend: {
					verticalAlign: "bottom",
					horizontalAlign: "center",
					cursor:'pointer',
					itemclick:function(e){graficar_cumplimiento_tipos_tareas_ot(est,empresa,dir,cliente,eje,producto,e.dataPoint.name);}
				},
				theme: "theme2",
				data: [{        
					type: "bar",  
					showInLegend: true,
					indexLabelPlacement: "inside",
                	indexLabelFontColor: "black",
					legendMarkerColor: "grey",
					legendText: "# DE TOS",
					indexLabelFontSize: 12,
					indexLabel:"{y}",
					dataPoints: datax2
				  }]
				});
				chart.render();
			}
		});
	}
	
	
	function graficar_nivel_productos_cliente(est,empresa,dir,eje,cliente){
		var datax = [];
		var datax2 = [];
		$.ajax({
			url:'busqueda_reportes.php',
			data:{t:7,emp:empresa,est:est,dir:dir,clie:cliente,fd:$("#fdesde_ot").val(),fh:$("#fhasta_ot").val(),eje:eje},
			type:'post',
			success:function(datay){
				$("#canvas_rots").html("");
				var n_empresa = datay.split("<->");
				var total = 0;
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");
					total +=parseFloat(utl[1]);
				}
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");					
					datax.push({y:formatNumber.new((parseInt(utl[1])*100)/total), legendText:utl[0],label: utl[0],x:utl[1],name:utl[2],click:function(e){alert(e.dataPoint.name);}});
					datax2.push({y:(parseInt(utl[1])),label:(parseInt(utl[1])),indexLabel: utl[0] });
				}
				var chart = new CanvasJS.Chart("canvas_rots",
				{	backgroundColor: "rgb(232, 232, 232)",
					height:$("#canvas_rots").height(),
					title:{
						text: "OTS POR PRODUCTO",
						fontWeight:"normal",
						fontFamily: "Open Sans" 
					},
					exportFileName: "Pie Chart",
					exportEnabled: true,
					animationEnabled: true,
					legend:{
						verticalAlign: "center",
						fontWeight:"normal",
						fontFamily: "Open Sans" ,
						horizontalAlign: "left",
						fontSize: 12,
						fontFamily: "Open Sans",
						itemclick:function(e){graficar_nivel_tipos_tarea_ot(est,empresa,dir,cliente,eje,e.dataPoint.name);}
					},
					theme: "theme1",
					data: [
					{        
						type: "pie",       
						indexLabelFontFamily: "Open Sans",
						indexLabelFontColor:"black",
						 
						fontWeight:"normal",
						fontFamily: "Open Sans" ,     
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
			
			var chart = new CanvasJS.Chart("chart_div",{
				backgroundColor: "rgb(232, 232, 232)",
				height:$("#canvas_rots").height(),
				title:{
					text: "OTS POR PRODUCTO",
						fontWeight:"normal",
						fontFamily: "Open Sans"    
				},
				exportFileName: "Pie Chart",
				exportEnabled: true,
				bevelEnabled: true,
				animationEnabled: true,
				axisY: {
					title: "CANTIDAD DE OTS",
						fontWeight:"normal",
						fontFamily: "Open Sans",
						gridThickness:1,
						labelFontFamily:"Open Sans"
					},
					axisX: {
						//labelAngle: -30
						labelFontFamily:"Open Sans"
					},
					legend: {
						verticalAlign: "bottom",
						horizontalAlign: "center",
						cursor:'pointer',
						fontFamily: "Open Sans",
						fontSize: 12,
						itemclick:function(e){graficar_nivel_tipos_tarea_ot(est,empresa,dir,cliente,eje,e.dataPoint.name);}
					},
					theme: "theme2",
					data: [{        
						bevelEnabled: true,
						type: "bar",  
						showInLegend: true, 
						legendMarkerColor: "grey",
						legendText: "# DE OTS",
						indexLabelFontColor:"black",
						indexLabelFontFamily: "Open Sans",
						indexLabelFontSize: 12,
						 
						indexLabelPlacement: "inside",
                		indexLabelFontColor: "black",
						indexLabel:"{y}",
						cursor:"pointer",
						dataPoints: datax2
					}]
				});
				chart.render();
			}
		});
	}
	
	
	function graficar_nivel_cliente_ot(est,empresa,dir,eje){
		var datax = [];
		var datax2 = [];
		$.ajax({
			url:'busqueda_reportes.php',
			data:{t:6,emp:empresa,est:est,dir:dir,fd:$("#fdesde_ot").val(),fh:$("#fhasta_ot").val(),eje:eje},
			type:'post',
			success:function(datay){
				$("#canvas_rots").html("");
				var n_empresa = datay.split("<->");
				var total = 0;
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");
					total +=parseFloat(utl[1]);
				}
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");					
					datax.push({y:((parseInt(utl[1])*100)/total), legendText:utl[0],label: utl[0],x:utl[1],name:utl[2]});
					datax2.push({y:(parseInt(utl[1])),label: (parseInt(utl[1])),indexLabel:utl[0] });
				}
				var chart = new CanvasJS.Chart("canvas_rots",
				{
					backgroundColor: "rgb(232, 232, 232)",
					height:$("#canvas_rots").height(),
					title:{
						text: "OTS POR CLIENTES",
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
						fontWeight:"normal",
						fontFamily: "Open Sans",
						cursor:"pointer",
						itemclick:function(e){graficar_nivel_productos_cliente(est,empresa,dir,eje,e.dataPoint.name);}
					},
					theme: "theme1",
					data: [
					{        
						type: "pie", 
						fontWeight:"normal",
						fontFamily: "Open Sans",
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
			var chart = new CanvasJS.Chart("chart_div",{
				backgroundColor: "rgb(232, 232, 232)",
				height:$("#canvas_rots").height(),
				title:{
					text: "OTS POR CLIENTES",
						fontWeight:"normal",
						fontFamily: "Open Sans"   
				},
				exportFileName: "Pie Chart",
				exportEnabled: true,
				animationEnabled: true,
				axisY: {
					title: "CANTIDAD DE OTS",
					gridThickness:1,
						labelFontFamily:"Open Sans"
					},
					axisX: {
						//labelAngle: -30
						labelFontFamily:"Open Sans"
					},
					legend: {
						verticalAlign: "bottom",
						horizontalAlign: "center",
						cursor:'pointer',
						fontFamily: "Open Sans",
						fontSize: 12,
						itemclick:function(e){graficar_nivel_productos_cliente(est,empresa,dir,eje,e.dataPoint.name);}
					},
					theme: "theme2",
					data: [{        
						bevelEnabled: true,
						type: "bar",  
						showInLegend: true, 
						legendMarkerColor: "grey",
						legendText: "# DE OTS",
						indexLabelFontColor:"black",
						indexLabelFontFamily: "Open Sans",
						indexLabelFontSize: 12,
						 
						indexLabelPlacement: "inside",
                		indexLabelFontColor: "black",
						indexLabel:"{y}",
						cursor:"pointer",
						dataPoints: datax2
					}]
					
				});
				chart.render();
			}
		});
	}
	
	function graficar_nivel_estado_reporte_ot(id){
		var datax = [];
		var datax2 = [];
		var nombre_empresa = "";
		$.ajax({
			url:'busqueda_reportes.php',
			data:{t:8,id:id,fd:$("#fdesde_ot").val(),fh:$("#fhasta_ot").val()},
			type:'post',
			success:function(datay){
				$("#canvas_rots").html("");
				var n_empresa = datay.split("<->");
				var total = 0;
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");
					total +=parseFloat(utl[1]);
				}
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");					
					datax.push({y:((parseInt(utl[1])*100)/total), legendText:utl[0],label: utl[0],x:utl[1],name:utl[2],click:function(e){graficar_nivel_empresa_reporte_ot();}});
					datax2.push({y:(parseInt(utl[1])),label: (parseInt(utl[1])),click:function(e){graficar_nivel_empresa_reporte_ot(); },indexLabel:utl[0]});
				}
				var chart = new CanvasJS.Chart("canvas_rots",
				{
					backgroundColor: "rgb(232, 232, 232)",
					height:$("#canvas_rots").height(),
					title:{
						text: "ESTADO DE OTS",
						fontFamily: "Open Sans",
						fontWeight:"normal"
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
						itemclick:function(e){graficar_nivel_director_reporte_ot(e.dataPoint.name,id);}
					},
					theme: "theme1",
					data: [
					{        
						type: "pie",       
						indexLabelFontFamily: "Open Sans",       
						indexLabelFontSize: 12,
						indexLabel: "#percent %",
						startAngle:-60,      
						showInLegend: true,
						indexLabelFontColor:"black",
						 
						toolTipContent:"<strong>{x} OTS</strong>",
						dataPoints: datax
					}
					]
				});
			chart.render();
			var chart = new CanvasJS.Chart("chart_div",{
				backgroundColor: "rgb(232, 232, 232)",
					height:$("#canvas_rots").height(),
					title:{
						text: "ESTADO DE OTS",
						fontWeight:"normal",
						fontFamily: "Open Sans"
						
					},
				exportFileName: "Pie Chart",
				exportEnabled: true,
				animationEnabled: true,
				axisY: {
					title: "CANTIDAD DE OTS",
					gridThickness:1,
						labelFontFamily:"Open Sans"
					},
					axisX: {
						//labelAngle: -30
						labelFontFamily:"Open Sans"
					},
					legend: {
						verticalAlign: "bottom",
						horizontalAlign: "center",
						cursor:'pointer',
						fontFamily: "Open Sans",
						fontSize: 12,
						itemclick:function(e){graficar_nivel_director_reporte_ot(e.dataPoint.name,id);}
					},
					theme: "theme2",
					data: [{        
						bevelEnabled: true,
						type: "bar",  
						showInLegend: true, 
						legendMarkerColor: "grey",
						legendText: "# DE OTS",
						indexLabelFontColor:"black",
						indexLabelFontFamily: "Open Sans",
						indexLabelFontSize: 12,
						 
						indexLabelPlacement: "inside",
                		indexLabelFontColor: "black",
						indexLabel:"{y}",
						cursor:"pointer",
						dataPoints: datax2
					}]
				});
				chart.render();
			}
		});
	}
	
	
	function graficar_nivel_director_ejecutivo_reporte_ot(est,empresa,dir){
		var datax = [];
		var datax2 = [];
		$.ajax({
			url:'busqueda_reportes.php',
			data:{t:11,emp:empresa,est:est,fd:$("#fdesde_ot").val(),fh:$("#fhasta_ot").val(),dir:dir},
			type:'post',
			success:function(datay){
				$("#canvas_rots").html("");
				var n_empresa = datay.split("<->");
				var total = 0;
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");
					total +=parseFloat(utl[1]);
				}
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");					
					datax.push({y:((parseInt(utl[1])*100)/total), legendText:utl[0],label: utl[0],x:utl[1],name:utl[2]});
					datax2.push({y:(parseInt(utl[1])),label: (parseInt(utl[1])),indexLabel:utl[0]});
				}
				var chart = new CanvasJS.Chart("canvas_rots",
				{
					backgroundColor: "rgb(232, 232, 232)",
					height:$("#canvas_rots").height(),
					title:{
						text: "OTS POR EJECUTIVOS",
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
			var chart = new CanvasJS.Chart("chart_div",{
				backgroundColor: "rgb(232, 232, 232)",
				height:$("#canvas_rots").height(),
				title:{
					text: "OTS POR EJECUTIVOS",
					fontWeight:"normal",
					fontFamily: "Open Sans"    
				},
				exportFileName: "Pie Chart",
				exportEnabled: true,
				animationEnabled: true,
				axisY: {
					title: "CANTIDAD DE OTS",
					fontWeight:"normal",
					fontFamily: "Open Sans",
					gridThickness:1,
						labelFontFamily:"Open Sans"
					},
					axisX: {
						//labelAngle: -30
						labelFontFamily:"Open Sans"
					},
					legend: {
						verticalAlign: "bottom",
						horizontalAlign: "center",
						cursor:'pointer',
						fontFamily: "Open Sans",
						fontSize: 12,
						itemclick:function(e){graficar_nivel_cliente_ot(est,empresa,dir,e.dataPoint.name);}
					},
					theme: "theme2",
					data: [{        
						bevelEnabled: true,
						type: "bar",  
						showInLegend: true, 
						legendMarkerColor: "grey",
						legendText: "# DE OTS",
						indexLabelFontColor:"black",
						indexLabelFontFamily: "Open Sans",
						indexLabelFontSize: 12,
						 
						indexLabelPlacement: "inside",
                		indexLabelFontColor: "black",
						indexLabel:"{y}",
						cursor:"pointer",
						dataPoints: datax2
					}]
				});
				chart.render();
			}
		});
	
	}
	
	
	function graficar_nivel_director_reporte_ot(est,empresa){
		var datax = [];
		var datax2 = [];
		$.ajax({
			url:'busqueda_reportes.php',
			data:{t:9,emp:empresa,est:est,fd:$("#fdesde_ot").val(),fh:$("#fhasta_ot").val()},
			type:'post',
			success:function(datay){
				$("#canvas_rots").html("");
				var n_empresa = datay.split("<->");
				var total = 0;
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");
					total +=parseFloat(utl[1]);
				}
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");					
					datax.push({y:((parseInt(utl[1])*100)/total), legendText:utl[0],label: utl[0],x:utl[1],name:utl[2]});
					datax2.push({y:(parseInt(utl[1])),label: (parseInt(utl[1])),indexLabel: utl[0]});
				}
				var chart = new CanvasJS.Chart("canvas_rots",
				{
					backgroundColor: "rgb(232, 232, 232)",
					height:$("#canvas_rots").height(),
					title:{
						text: "OTS POR DIRECTORES",
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
						itemclick:function(e){/*graficar_nivel_cliente_ot(est,empresa,e.dataPoint.name)*/graficar_nivel_director_ejecutivo_reporte_ot(est,empresa,e.dataPoint.name);}
					},
					theme: "theme1",
					data: [
					{        
						type: "pie",       
						indexLabelFontFamily: "Open Sans",       
						indexLabelFontSize: 12,
						indexLabel: "#percent %",
						startAngle:-60,    
						indexLabelFontColor:"black",
						   
						showInLegend: true,
						toolTipContent:"<strong>{x} OTS</strong>",
						dataPoints: datax
					}
					]
				});
			chart.render();
			var chart = new CanvasJS.Chart("chart_div",{
				backgroundColor: "rgb(232, 232, 232)",
				height:$("#canvas_rots").height(),
				title:{
					text: "OTS POR DIRECTORES",
					fontWeight:"normal",
					fontFamily: "Open Sans"
				},
				exportFileName: "Pie Chart",
				exportEnabled: true,
				animationEnabled: true,
				axisY: {
					title: "CANTIDAD DE OTS",
					gridThickness:1,
						labelFontFamily:"Open Sans"
					},
					axisX: {
						//labelAngle: -30
						labelFontFamily:"Open Sans"
					},
					legend: {
						verticalAlign: "bottom",
						horizontalAlign: "center",
						cursor:'pointer',
						fontFamily: "Open Sans",
						fontSize: 12,
						itemclick:function(e){/*graficar_nivel_cliente_ot(est,empresa,e.dataPoint.name)*/graficar_nivel_director_ejecutivo_reporte_ot(est,empresa,e.dataPoint.name);}
					},
					theme: "theme2",
					data: [{        
						bevelEnabled: true,
						type: "bar",  
						showInLegend: true, 
						legendMarkerColor: "grey",
						legendText: "# DE OTS",
						indexLabelFontColor:"black",
						indexLabelFontFamily: "Open Sans",
						indexLabelFontSize: 12,
						 
						indexLabelPlacement: "inside",
                		indexLabelFontColor: "black",
						indexLabel:"{y}",
						cursor:"pointer",
						dataPoints: datax2
					}]
				});
				chart.render();
			}
		});
	}
	
	function graficar_nivel_empresa_reporte_ot(){
		data =  new FormData();
		data.append('emp',$("#empresa_rot").val());
		data.append('clie',$("#cliente_rot").val());
		data.append('fd',$("#fdesde_ot").val());
		data.append('fh',$("#fhasta_ot").val());
		data.append('t',5);
		var datax = [];
		var datax2 = [];
		$.ajax({
			url:'busqueda_reportes.php',
			data:data,
			type:'post',
			contentType:false, //Debe estar en false para que pase el objeto sin procesar
			processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
			success:function(datay){
				$("#canvas_rots").html("");
				var n_empresa = datay.split("<->");
				var total = 0;
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");
					total +=parseFloat(utl[1]);
				}
				for(var i = 1; i < n_empresa.length; i++){
					var utl = n_empresa[i].split("*---*");					
					datax.push({y: ((parseInt(utl[1])*100)/total), legendText:utl[0],label: utl[0],name:utl[2], x:utl[1]});
					datax2.push({y:(parseInt(utl[1])),label:(parseInt(utl[1])),name:utl[2],click:function(e){graficar_nivel_estado_reporte_ot(e.dataPoint.name)},indexLabel: utl[0]});
					//datax.push({utl[0],utl[1]});
				}
				var chart = new CanvasJS.Chart("canvas_rots",{
					backgroundColor: "rgb(232, 232, 232)",
					height:$("#canvas_rots").height(),
					title:{
						text: "REPORTE DE OTS POR EMPRESAS",
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
						cursor:'pointer',
						itemclick:function(e){graficar_nivel_estado_reporte_ot(e.dataPoint.name)}
					},
					theme: "theme1",
					data: [
					{        
						type: "pie",       
						indexLabelFontFamily: "Open Sans",       
						indexLabelFontSize: 12,
						indexLabel: "#percent %",
						startAngle:-60,
						indexLabelFontColor:"black",
						 
						dockInsidePlotArea: true,
						showInLegend: true,
						toolTipContent:"<strong>{x} OTS GENERADAS</strong>",
						dataPoints: datax
					}
					]
				});
				chart.render();
				
				var chart = new CanvasJS.Chart("chart_div",{
					backgroundColor: "rgb(232, 232, 232)",
					height:$("#canvas_rots").height(),
					title:{
						text: "REPORTE DE OTS POR EMPRESAS" ,
						fontFamily: "Open Sans"
					},
					exportFileName: "Pie Chart",
					exportEnabled: true,
					animationEnabled: true,
					axisY: {
						title: "CANTIDAD DE OTS",
						gridThickness:1,
						labelFontFamily:"Open Sans"
					},
					axisX: {
						//labelAngle: -30
						labelFontFamily:"Open Sans"
					},
					legend: {
						verticalAlign: "bottom",
						horizontalAlign: "center",
						cursor:'pointer',
						fontFamily: "Open Sans",
						fontSize: 12
					},
					theme: "theme2",
					data: [{        
						bevelEnabled: true,
						type: "bar",  
						showInLegend: true, 
						legendMarkerColor: "grey",
						legendText: "# DE OTS",
						indexLabelFontColor:"black",
						indexLabelFontFamily: "Open Sans",
						indexLabelFontSize: 10,
						 
						indexLabelPlacement: "inside",
                		indexLabelFontColor: "black",
						indexLabel:"{y}",
						cursor:"pointer",
						dataPoints: datax2
					}]
				});
				
				chart.render();
			}
		});
	}
	
	/*GENERAR REPORTE OT*/
	$("#generar_reporte_ot").on('click',function(){
		$("#link_bajar_excel_ots").attr("href", "download_reporte_ot.php?e="+$("#empresa_rot").val()+"&c="+$("#cliente_rot").val()+"&d="+$("#fdesde_ot").val()+"&h="+$("#fhasta_ot").val()+"");
		graficar_nivel_empresa_reporte_ot();
	});
	
	/*GENERAR REPORTE TAREAS*/
	$("#generar_reporte_tareas").on('click',function(){
		data = new FormData();
		data.append('emp',$("#empresa_rtareas").val());
		data.append('clie',$("#cliente_rtareas").val());
		data.append('depto',$("#depto_tareas option:selected").text());
		data.append('tar',$("#tareas_tareas").val());
		data.append('fd',$("#fdesde_tareas").val());
		data.append('fh',$("#fhasta_tareas").val());
		data.append('t',4);
		$.ajax({
			url:'busqueda_reportes.php',
			data:data,
			type:'post',
			contentType:false,
			processData:false,
			success:function(data){
				$("#contenedor_rrporte_tareas").html(data);
			}
		});
	});
});