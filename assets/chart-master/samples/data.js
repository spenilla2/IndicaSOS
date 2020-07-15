function p(p1){
$(document).ready(function(){
var m=220;
var barChartData = {
 	labels : [p1,"February","March","April","May","June","July"],
	datasets : [
				{
		 		  fillColor : "rgba(220,220,220,0.5)",
				  strokeColor : "rgba(220,220,220,1)",
				  data : [m,59,90,81,56,55,40]
				 },
				{
				 fillColor : "rgba(151,187,205,0.5)",
				 strokeColor : "rgba(151,187,205,1)",
				 data : [28,48,40,19,96,27,100]
				}
			  ]
		}
		var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Bar(barChartData);

	

});
}