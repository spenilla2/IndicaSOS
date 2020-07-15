function CargueGrafico(anomes){
$(document).ready(function() {
	var m=0;
	$.ajax({
		type: "GET",
        dataType: 'html',
        url: "Consultas.php",
        data: "Consulta=1&Anomes="+anomes,
        success: function(resp){
        	m = resp.split("%");
        	var nanos=m[0];
        	var nestados=m[1];
        	m[2] = m[2].replace(" ",/\\n/g);
        	var labels1=m[2].split("|");
        	var valores= m[3].split(";");
        	var datos1 = new Array;
        	var lab1 = new Array;
        	var barChartData = {};
        	var color = Chart.helpers.color;
        	var colorNames = Object.keys(window.chartColors);
        	var colorName = colorNames[1];
			var dsColor = window.chartColors[colorNames[1]];
    		var coloresdef = [5,4,3,0];    	
        	var barChartData = {
				labels: labels1,
				datasets: [{
					label: "Prueba",
					backgroundColor: color(window.chartColors[colorNames[0]]).alpha(0.5).rgbString(),
					borderColor: window.chartColors[colorNames[0]],
					borderWidth: 1,
					data: [100]
				}]

			};
			barChartData.datasets.pop();
        	for(var i=0;i<nanos;i++){
        		data=valores[i].split("@");
        		lab1.push(data[0]);
        		datos1=[];
        		for(var j=1;j<=nestados;j++){
        			datos1.push(data[j]);
        		}
        		var newDataset = {
						label: lab1[i],
						backgroundColor: color(window.chartColors[colorNames[coloresdef[i]]]).alpha(0.2).rgbString(),
						borderColor: window.chartColors[colorNames[coloresdef[i]]],
						borderWidth: 1,
						data: datos1
				};
			barChartData.labels=labels1;
			barChartData.datasets.push(newDataset);

        	}
        	var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					fullWidth:true,
					tooltips:{
						mode:'single'
					},
					elements:{
						rectangle:{
								stepLabel:{
									display:true
								}

						}
					},
					legend: {
						display:true,
						position: 'right',
						labels:{
							fontSize:12,
							fontStyle:'bold'
						}
					},
					title: {
						display: true,
						fontSize:24,
						text: 'INDICADORES GESTION CORTE ('+anomes+')' 
					}
				}
			});    
        	}
	});
});

}
		