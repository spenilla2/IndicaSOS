function CreaResumen(){
    var corte0=document.getElementById("corte").selectedIndex;
    var corte=document.getElementById("corte").options[corte0].value;
    t=confirm("Esta Seguro que desea Calcular la Tabla de Resumen corte " + corte);
    if(t){
        document.getElementById("res").innerHTML='<center><img src="img/procesando.gif"></center>';
        $(document).ready(function(){
                $.ajax({
                    type: "GET",
                    dataType: 'html',
                    url: "Consultas.php",
                    data: "Consulta=10&corte="+corte,
                    success: function(resp){
                        document.getElementById("res").innerHTML=resp;

                    }
                });
            });
    }else{

    }
    
}
function ActualizaPara(id){
    valor=document.getElementById("var").value;
    if(valor==""){
        alert("El Campo no puede estar vacio");
    }else{
            $(document).ready(function(){
                $.ajax({
                    type: "GET",
                    dataType: 'html',
                    url: "Consultas.php",
                    data: "Consulta=9&id="+id+"&val="+valor,
                    success: function(resp){
                        if(resp==1){
                            alert("Actualización realizada Satisfactoriamente");
                            location.reload(true);
                        }else{
                            alert("Ha Ocurrido un error"+resp);
                        }

                    }
                });
            });

    }
    
}
function TraeData(){
var id0 = document.getElementById("parametros").selectedIndex;
var id= document.getElementById("parametros").options[id0].value;
$(document).ready(function(){
        $.ajax({
            type: "GET",
            dataType: 'html',
            url: "Consultas.php",
            data: "Consulta=8&id="+id,
            success: function(resp){
                document.getElementById("res").innerHTML=resp;
            }
        });
});
}
function CargaGrafico(centi){
    var anomes;
    var TipoConsulta="";
    var Titulo = "";
    var canvas="";
    var Variable="";
    switch(centi){
        case 1:
            var select = document.getElementById("corte");
            anomes = select.options[select.selectedIndex].value;
            TipoConsulta=1;
            Titulo = 'CANTIDAD DE SOS POR ESTADO';
            Subtitulo = 'Corte '+anomes+' ';
            Variable="";
            canvas="barra";
        break;
        case 2:
            var select = document.getElementById("corteIntranet");
            anomes = select.options[select.selectedIndex].value;
            TipoConsulta = 2;
            Titulo = 'CANTIDAD DE SOS POR ESTADO (INTRANET)';
            Subtitulo = 'Corte '+anomes+' ';
            Variable="Intranet";
            canvas="barra1";
        break;
        case 3:
            var select = document.getElementById("corteApoteosys");
            anomes = select.options[select.selectedIndex].value;
            TipoConsulta = 2;
            Titulo = 'CANTIDAD DE SOS POR ESTADO (APOTEOSYS)';
            Subtitulo = 'Corte '+anomes+' ';
            Variable="Apoteosys";
            canvas="barra2";
        break;
        case 4:
            var select = document.getElementById("corteNomina");
            anomes = select.options[select.selectedIndex].value;
            TipoConsulta = 2;
            Titulo = 'CANTIDAD DE SOS POR ESTADO (NOMINA)';
            Subtitulo = 'Corte '+anomes+' ';
            Variable="Heinsohn Nómina";
            canvas="barra3";
        break;
        case 5:
            var select = document.getElementById("corteSbi");
            anomes = select.options[select.selectedIndex].value;
            TipoConsulta = 2;
            Titulo = 'CANTIDAD DE SOS POR ESTADO (SBI)';
            Subtitulo = 'Corte '+anomes+' ';
            Variable="SBI";
            canvas="barra4";
        break;
    
    
    }
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            dataType: 'html',
            url: "Consultas.php",
            data: "Consulta="+TipoConsulta+"&Anomes="+anomes+"&Variable="+Variable,
            success: function(resp){
                var m = resp.split("%");
                var nanos = m[0];
                var nestados = m[1];
                var labels1=m[2].split("|");
                var valores= m[3].split(";");
                var series1=[{}];
                var seriesA=[{}];
                var chart1 = Highcharts.chart(canvas, {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: Titulo,
                        style: {
                            fontSize:'20px',
                            fontWeight:'bold'      
                        }
                    },
                    credits:{
                        text:'Diseñado por: ÁREA DE TECNOLOGÍA COPROCENVA'
                    },
                    subtitle: {
                        text: Subtitulo,
                        style: {
                            fontSize:'16px',
                            fontWeight:'bold'   
                        }
                    },
                    xAxis: {
                        categories: labels1,
                        crosshair: true                        
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'SOS Radicados'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                         '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            dataLabels: {
                                enabled: true,
                                fontWeight:'italic'
                            },
                            pointPadding: 0.001,
                            borderWidth: 0
                        }
                    },
                    series: [{}]
                });
                chart1.series[0].remove();
                var datos1=[];
                for(var i=0;i<nanos;i++){
                    datas = valores[i].split("@");
                    ano = datas[0];
                    for(var j=1;j<=nestados;j++){
                        datos1.push(parseFloat(datas[j]));
                    }
                    chart1.addSeries({
                        name: ano,
                        data: datos1
                    });
                    datos1=[];
                }
            }
        });
    });
}
function Cargue_Grafico(centi){
    var anomes;
    var TipoConsulta="";
    var Titulo = "";
    var canvas="";
    var Variable="";
    switch(centi){
        case 1:
            TipoConsulta = 3;
            Variable = "";
            Titulo = "Nivel de Satisfacción Cliente Interno";
            canvas="torta";
            var select = document.getElementById("corteTotal");
            anomes = select.options[select.selectedIndex].value;
        break;
        case 2:
            TipoConsulta = 3;
            Variable = "Infraestructura";
            Titulo = "Nivel de Satisfacción Infraestructura";
            canvas="torta1";
            var select = document.getElementById("corteInfraestructura");
            anomes = select.options[select.selectedIndex].value;
        break;
        case 3:
            TipoConsulta = 3;
            Variable = "Software";
            Titulo = "Nivel de Satisfacción Software";
            canvas="torta2";
            var select = document.getElementById("corteSoftware");
            anomes = select.options[select.selectedIndex].value;
        break;
    }
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            dataType: 'html',
            url: "Consultas.php",
            data: "Consulta="+TipoConsulta+"&Anomes="+anomes+"&Variable="+Variable,
            success: function(resp){
                var cadena = resp.split(";");
                var tCalif = cadena[0];
                var Calif = cadena[1].split("|");
                var Valor = cadena[2].split("@");
                var data1=[{}];
                var suma=0;
                for(var i=0;i<tCalif;i++){
                    suma+=parseFloat(Valor[i]);
                }
                var chart1 = Highcharts.chart(canvas, {
                    chart: {
                        type: 'pie',
                        options3d: {
                            enabled: true,
                            alpha: 45,
                            beta: 0
                        }
                    },
                    title: {
                        text: Titulo,
                        style: {
                            fontSize:'20px',
                            fontWeight:'bold'
                        }
                    },
                    credits:{
                        text:'Diseñado por: ÁREA DE TECNOLOGÍA COPROCENVA'
                    },
                    subtitle: {
                        text: 'Corte '+anomes,
                        style: {
                            fontSize:'16px',
                            fontWeight:'bold'   
                        }
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            depth: 30,
                            dataLabels: {
                                enabled: true,
                                format: '{point.name} ( {point.percentage:.2f}% )'
                            }
                        }
                    },
                    series: [{
                        type: 'pie',
                        name: 'SOS Calificados',
                        data: [
                              ]
                        }]
                });
            for(var i=0;i<tCalif;i++){
                    chart1.series[0].addPoint([Calif[i],parseFloat(Valor[i])]);
                }
            }

        });
    });
}
function Cargue_Grafico_Barra(centi){
    var anomes='201811';
    var TipoConsulta="4";
    var Titulo = "";
    var canvas="";
    var Variable="";
    var select = "";
        anomes = "";
    var SubTitulo="";
    switch(centi){
        case 1:
            TipoConsulta="4";
            Titulo = "PROCESOS CON CALIFICACIÓN MENOR Ó IGUAL A 4";
            canvas="torta3";
            Variable="PROCESO";
            select = document.getElementById("cortemalcal");
            anomes = select.options[select.selectedIndex].value;
            SubTitulo='CORTE '+anomes;
        break;
        case 2:
            TipoConsulta="4";
            Titulo = "CALIFICACIÓN SOS POR AREA DE TECNOLOGÍA";
            canvas="barra_area";
            Variable="CONTROLA";
            select = document.getElementById("calif_area");
            anomes = select.options[select.selectedIndex].value;
            SubTitulo='CORTE '+anomes;
        break;
    }
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            dataType: 'html',
            url: "Consultas.php",
            data: "Consulta="+TipoConsulta+"&Anomes="+anomes+"&Variable="+Variable,
            success: function(resp){
                var m=resp.split("%");
                var nfilas = m[0];
                var nProcesos = m[1];
                var Procesos = m[2].split("|");
                var valores= m[3].split(";");
                var series1=[{}];
                var seriesA=[{}];
                var chart = new Highcharts.Chart({
                        chart: {
                            renderTo: canvas,
                            type: 'column',
                            options3d: {
                                enabled: true,
                                alpha: 0,
                                beta: 0,
                                depth: 20,
                                viewDistance: 25
                            }
                        },
                        title: {
                            text: Titulo
                        },
                        credits:{
                        text:'Diseñado por: ÁREA DE TECNOLOGÍA COPROCENVA'
                        },
                        xAxis: {
                            categories: Procesos,
                            labels: {
                                skew3d: true,
                                style: {
                                    fontSize:'16px',
                                    fontWeight:'bold'   
                                }
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'SOS Calificados'
                            }
                        },
                        subtitle: {
                            text: SubTitulo
                        },
                        plotOptions: {
                            column: {
                                dataLabels: {
                                enabled: true,
                                fontWeight:'italic'
                                },
                                depth: 25
                            }
                        },
                        series: [{
                            name:'pp',
                            data: [29.9, 71.5, 106.4]
                        }]
                });
                chart.series[0].remove();
                var datos1=[];
                for(var i=0;i<nfilas;i++){
                    datas = valores[i].split("@");
                    proceso = datas[0];
                    for(var j=1;j<=nProcesos;j++){
                        datos1.push(parseFloat(datas[j]));
                    }
                    chart.addSeries({
                        name: proceso,
                        data: datos1
                    });
                    datos1=[];
                }
            }
        });
    });
}
function grafico_Linea(anomes){
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            dataType: 'html',
            url: "Consultas.php?corte="+anomes,
            data: "Consulta=7",
            success: function(resp){
                cadena=resp.split("|");
                nfilas=cadena[0];
                cortes=cadena[1].split(";");
                dat = cadena[2].split("@");
                Meta=[];
                for(var i=0;i<nfilas;i++){
                    Meta[i]=90.0;
                }
                var char1=Highcharts.chart('linea', {
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: 'CUMPLIMIENTO DE SOPORTES TRABAJADOS RESPECTO A LA META'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        categories: cortes
                    },
                    yAxis: {
                        title: {
                            text: 'Soportes Trabajados(%)'
                        }
                    },
                    plotOptions: {
                        line: {
                            dataLabels: {
                                enabled: true
                            },
                            enableMouseTracking: false
                        }
                    },
                    series: [
                    {
                        name: 'Meta',
                        data: Meta,
                        color:'red'

                    }]
                });
                var datos1=[];
                for(var i=0;i<6;i++){
                  det = dat[i].split(";");
                  proceso = det[0];
                  for(var j=1;j<=nfilas;j++){
                    datos1.push(parseFloat(det[j]));
                  }
                  char1.addSeries({
                        name: proceso,
                        data: datos1
                    });
                  datos1=[];
                }
   }});});
}

function ListaSos(){
    var select = document.getElementById("detalle_sos");
    var anomes = select.options[select.selectedIndex].value;
    var TipoConsulta = 5;
    var Variable="";
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            dataType: 'html',
            url: "Consultas.php",
            data: "Consulta="+TipoConsulta+"&Anomes="+anomes+"&Variable="+Variable,
            success: function(resp){
                document.getElementById("tabla").innerHTML=resp;
            }
        });
    });
}
function ActualizarClas(anomes){
    var ate = document.getElementById("atencion");
    var atencion = ate.options[ate.selectedIndex].text;
    
    var cla = document.getElementById("clasificacion");
    var clasificacion = cla.options[cla.selectedIndex].text;
    
    var apl = document.getElementById("aplicacion");
    var aplicacion = apl.options[apl.selectedIndex].text;

    var con = document.getElementById("controla");
    var controla = con.options[con.selectedIndex].text;

    var ges = document.getElementById("gestion");
    var gestion = ges.options[ges.selectedIndex].text;

    var SOS = document.getElementById("SOS").value;
    var t = confirm("Esta Seguro que desea Actualizar la Información?");
    if(t){
        $(document).ready(function(){
        $.ajax({
            type: "GET",
            dataType: 'html',
            url: "Consultas.php",
            data: "Consulta=6&Anomes="+anomes
                           +"&Atencion="+atencion
                           +"&Clasif="+clasificacion
                           +"&Aplica="+aplicacion
                           +"&Control="+controla
                           +"&Gestion="+gestion
                           +"&SOS="+SOS,
            success: function(resp){
                if(resp==1){
                    alert("Datos Almacenados Satisfactoriamente");
                    location.reload(true);
                }else{
                    alert("Ha Ocurrido un Error al Actualizar la Clasificación: "+resp);    
                }
                
            }
        });
    });
    }else{
    }
}
