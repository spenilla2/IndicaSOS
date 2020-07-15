function prueba(anomes){
$(document).ready(function() {
var m=0;
$.ajax({
        type: "GET",
        dataType: 'html',
        url: "Consultas.php",
        data: "Consulta=1&Anomes="+anomes,
        success: function(resp){
            //$('#respuesta').html(resp);
            m = resp.split("|");
            var p = new Array;
            p.push(26);
            p.push(16);
            p.push(36);
            p.push(2);
            p.push(44);
            p.push(27);
            p.push(26);
            p.push(62);
            p.push(33);
            p.push(74);
            var k = new Array;
            /*k.push(label:"prueba");
            k.push(fillColor : "rgba(151,187,205,0.5)",);
            k.push(strokeColor : "rgba(151,187,205,1)");
            k.push(p);*/
            var barChartData = {
            labels : m,//[anomes+"-"+m,"Febrero","Marzo","Abril","Mayo"],
            datasets :[
                {
                    label:"prueba",
                    backgroundColor : "rgba(151,187,205,0.5)",
                    borderColor : "rgba(151,187,205,1)",
                    data : p,
                    borderWidth: 1
                },
                {
                    label:"prueba1",
                    backgroundColor : "rgba(251,225,105,0.5)",
                    borderColor : "rgba(151,187,205,1)",
                    data : [36,48,40,19,96,27,100,96,27,100],
                    borderWidth: 1
                }
        ]

    };
 
    //
    new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData,{responsive:true });      
    var ctx = $("#bar");
    var bargraph = new Chart(ctx,{
        type:'bar',
        data:barChartData,
        options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Bar Chart'
                    }
                }
        });
    /* new Chart(document.getElementById("bar"),{
        type:'bar',
        data:barChartData,
        options:{
            legend:{display:false},
            title:{
                display:true,
                text:'prueba'
            }
        }
     });  */ 
    }
    
    });    

    /*var doughnutData = [
        {
            value: 30,
            color:"#F7464A"
        },
        {
            value : 50,
            color : "#46BFBD"
        },
        {
            value : 100,
            color : "#FDB45C"
        },
        {
            value : 40,
            color : "#949FB1"
        },
        {
            value : 120,
            color : "#4D5360"
        }

    ];
    var lineChartData = {
        labels : ["","","","","","",""],
        datasets : [
            {
                fillColor : "rgba(220,220,220,0.5)",
                strokeColor : "rgba(220,220,220,1)",
                pointColor : "rgba(220,220,220,1)",
                pointStrokeColor : "#fff",
                data : [65,59,90,81,56,55,40]
            },
            {
                fillColor : "rgba(151,187,205,0.5)",
                strokeColor : "rgba(151,187,205,1)",
                pointColor : "rgba(151,187,205,1)",
                pointStrokeColor : "#fff",
                data : [28,48,40,19,96,27,100]
            }
        ]

    };
    var pieData = [
        {
            value: 30,
            color:"#F38630"
        },
        {
            value : 50,
            color : "#E0E4CC"
        },
        {
            value : 100,
            color : "#69D2E7"
        }

    ];
    
    var barChartData1 = {
        labels : ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio"],
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

    };
    var chartData = [
        {
            value : Math.random(),
            color: "#D97041"
        },
        {
            value : Math.random(),
            color: "#C7604C"
        },
        {
            value : Math.random(),
            color: "#21323D"
        },
        {
            value : Math.random(),
            color: "#9D9B7F"
        },
        {
            value : Math.random(),
            color: "#7D4F6D"
        },
        {
            value : Math.random(),
            color: "#584A5E"
        }
    ];
    var radarChartData = {
        labels : ["","","","","","",""],
        datasets : [
            {
                fillColor : "rgba(220,220,220,0.5)",
                strokeColor : "rgba(220,220,220,1)",
                pointColor : "rgba(220,220,220,1)",
                pointStrokeColor : "#fff",
                data : [65,59,90,81,56,55,40]
            },
            {
                fillColor : "rgba(151,187,205,0.5)",
                strokeColor : "rgba(151,187,205,1)",
                pointColor : "rgba(151,187,205,1)",
                pointStrokeColor : "#fff",
                data : [28,48,40,19,96,27,100]
            }
        ]

    };*/
    //new Chart(document.getElementById("doughnut").getContext("2d")).Doughnut(doughnutData);
    //new Chart(document.getElementById("line").getContext("2d")).Line(lineChartData);
    //new Chart(document.getElementById("radar").getContext("2d")).Radar(radarChartData);
    //new Chart(document.getElementById("polarArea").getContext("2d")).PolarArea(chartData);
    //new Chart(document.getElementById("pie").getContext("2d")).Pie(pieData);
    
    //ew Chart(document.getElementById("bar1").getContext("2d")).Bar(barChartData1);
    

});    
}
