<?php
require("head.php");
global $conexion;

$sql = "SELECT Valor 
          FROM INDICADORES_PARAMETROS 
         WHERE Variable='Corte_Sistema'";
$query = $conexion->query($sql);
$result = $query->fetch_array();
$Anomes=$result[0];

$Query = "SELECT H.ANOMES
             FROM INDICADORES_SOS H
            WHERE H.ATENCION = 'Sistemas'
         GROUP BY H.ANOMES
         ORDER BY 1 ASC";
$query = $conexion->query($Query);
$nfilas = $query->num_rows;

$Options ='<option value="'.$Anomes.'">Corte</option>';
          for($i=0;$i<$nfilas;$i++){
               $res=$query->fetch_array();
               $t="";
               if($res[0]==$Anomes){
                  $t = "selected";
               }else{
                 $t = "";
               }
               $Options.='<option value="'.$res[0].'" '.$t.'>'.$res[0].'</option>';
           }
echo '<section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"><i class="icon_piechart"></i> GR&Aacute;FICOS</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i>
                    <a href="index_p.php">Home</a>
                </li>
                <li><i class="icon_piechart"></i>Gr&aacute;ficos Estadisticos de Nivel de Satisfacci&oacute;n del Cliente Interno 
                </li>
              </ol>
             </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                         <h3>Indicadores de Nivel de Satisfacci&oacute;n del &Aacute;rea de Tecnolog&iacute;a</h3>
                    </header>
                    <div class="panel-body">
                        <div class="tab-pane" id="chartjs">
                          <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">
                                    <header class="panel-heading">
                                      <b>CALIFICACI&Oacute;N POR AREA INTERNA</b> <br>
                                        Selecciona el Corte: 
                                            <select id="calif_area"  onchange="Cargue_Grafico_Barra(2)">
                                                    '.$Options.'
                                            </select>
                                    </header>
                                    <div class="panel-body text-center" style="border:1px solid black;">
                                        <div id="barra_area" style="border:2px solid black;width: 100%; height: 400px; margin: 0 auto">
                                      </div>
                                    </div>                                  
                                </section>
                            </div>
                         </div>
                          <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">
                                    <header class="panel-heading">
                                      <b>NIVEL DE SATIFACCI&Oacute;N DEL CLIENTE INTERNO AREA DE TECNOLOG&Iacute;A</b> <br>
                                        Selecciona el Corte: 
                                            <select id="corteTotal"  onchange="Cargue_Grafico(1)">
                                                    '.$Options.'
                                            </select>
                                    </header>
                                    <div class="panel-body text-center" style="border:1px solid black;">
                                        <div id="torta" style="border:2px solid black;width: 100%; height: 400px; margin: 0 auto">
                                      </div>
                                    </div>                                  
                                </section>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-lg-6">
                                <section class="panel">
                                    <header class="panel-heading">
                                      <b>NIVEL DE SATIFACCI&Oacute;N INFRAESTRUCTURA</b> <br>
                                        Selecciona el Corte: 
                                            <select id="corteInfraestructura"  onchange="Cargue_Grafico(2)">
                                                    '.$Options.'
                                            </select>
                                    </header>
                                    <div class="panel-body text-center" style="border:1px solid black;">
                                        <div id="torta1" style="border:2px solid black;width: 100%; height: 400px; margin: 0 auto">
                                      </div>
                                    </div>                                  
                                </section>
                            </div>
                            <div class="col-lg-6">
                                <section class="panel">
                                    <header class="panel-heading">
                                      <b>NIVEL DE SATIFACCI&Oacute;N SOFTWARE</b> <br>
                                        Selecciona el Corte: 
                                            <select id="corteSoftware"  onchange="Cargue_Grafico(3)">
                                                    '.$Options.'
                                            </select>
                                    </header>
                                    <div class="panel-body text-center" style="border:1px solid black;">
                                        <div id="torta2" style="border:2px solid black;width: 100%; height: 400px; margin: 0 auto">
                                      </div>
                                    </div>                                  
                                </section>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">
                                    <header class="panel-heading">
                                      <b>PROCESOS CON CALIFICACION INFERIOR A 4</b> <br>
                                        Selecciona el Corte: 
                                            <select id="cortemalcal"  onchange="Cargue_Grafico_Barra(1)">
                                                    '.$Options.'
                                            </select>
                                    </header>
                                    <div class="panel-body text-center" style="border:1px solid black;">
                                        <div id="torta3" style="border:2px solid black;width: 100%; height: 400px; margin: 0 auto">
                                      </div>
                                    </div>                                  
                                </section>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">
                                    <header class="panel-heading">
                                        <b>DETALLE DE SOS CON CALIFICACION MENOR &Oacute; IGUAL A 4</b><br>
                                        Selecciona el Corte: 
                                            <select id="detalle_sos"  onchange="ListaSos()">
                                                    '.$Options.'
                                            </select>
                                    </header>
                                    <div class="table-responsive" id="tabla" style="border:2px solid black;overflow-x:scroll;overflow-y:scroll;height:300px">
                                                
                                    </div>

                                </section>
                            </div>
                        </div>
                        </div>
                    </div>
                </section>
            </div>
          </div>
        </section>
    </section>
        <script src="js/jquery.js"></script>
        <script src="js/highcharts.js"></script>
        <script src="js/highcharts-3d.js"></script>
        <script src="js/exporting.js"></script>
        <script src="js/export-data.js"></script>
        <script src="js/data.js"></script>
        <script>
            Cargue_Grafico(1);
            Cargue_Grafico(2);
            Cargue_Grafico(3);
            Cargue_Grafico_Barra(1);      
            Cargue_Grafico_Barra(2);      
            ListaSos();
        </script>

';
require_once("foot.php");
?>