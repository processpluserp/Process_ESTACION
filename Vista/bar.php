<html>
  <head>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
		google.load("visualization", "1", {packages:["corechart"]});
		google.setOnLoadCallback(drawChart);
		function drawChart() {
		  /*$.ajax({
				url:'busqueda_reportes.php',
				data:{"t":5,emp:0,fd:"2015-08-01",fh:"2015-11-04"},
				type:'post',
				success:function(datay){
					var n_empresa = datay.split("<->");
					var contenedor = [['Empresa','Cantidad']];
					for(var i = 1; i < n_empresa.length; i++){
						var utl = n_empresa[i].split("*---*");
						contenedor.push([ ""+utl[0]+"" , parseFloat(utl[1])]);
					}
					
					var datax = google.visualization.arrayToDataTable(contenedor);
					
					var options = {
					  title: 'OT POR EMPRESA',
					  is3D: true,
					};
					var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
					chart.draw(datax, options);
					google.visualization.events.addListener(chart, 'select', selectHandler);

					function selectHandler(index) {
						var ele = chart.getSelection();
						console.log(ele);
						console.log(index);
						var message = "";
						var selection = chart.getSelection();
						  for (var i = 0; i < selection.length; i++) {
							var item = selection[i];
							if (item.row != null && item.column != null) {
							  message += '{row:' + item.row + ',column:' + item.column + '}';
							} else if (item.row != null) {
								
							  message += '{rowy:' + item.length + '}';
							  
							} else if (item.column != null) {
							  message += '{columnx:' + item.column + '}';
							}
						  }
						  if (message == '') {
							message = 'nothing';
						  }
						  alert('You selected ' + message);
												//alert(ele.row);
					}
				}
			});*/
		
			var jsonData = $.ajax({
			  url: "b_trafico_ot.php",
			  data:{emp:0,fd:"2015-08-04",fh:"2015-11-04"},
			  dataType: "json",
			  async: false
			  }).responseText;
			  var obj = window.JSON.stringify(jsonData);
			  var data = new google.visualization.DataTable(obj);
			
			
 
			  // Instantiate and draw our chart, passing in some options.
			  var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
			  chart.draw(data, {width: 400, height: 240});
      }
	  
    </script>
  </head>
  <body>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
  </body>
</html>

<!--<!doctype html>
<html>
	<head>
		<title>Bar Chart</title>
		<script src="../Chart.js"></script>
	</head>
	<body>
		<div style="width: 50%">
			<canvas id="canvas" height="450" width="600"></canvas>
		</div>


	<script>
	var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

	var barChartData = {
		labels : ["January","February","March","April","May","June","July"],
		datasets : [
			{
				fillColor : "rgba(220,220,220,0.5)",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : [2,4,124,512,871,12,2]
			},
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill : "rgba(151,187,205,0.75)",
				highlightStroke : "rgba(151,187,205,1)",
				data : [53,123,52,512,123,512,654]
			}
		]

	}
	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true
		});
	}

	</script>
	</body>
</html>-->
