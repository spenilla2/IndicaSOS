<?php
require("head.php");
global $conexion;
$sql = "SELECT Valor 
          FROM INDICADORES_PARAMETROS 
         WHERE Variable='Corte_Sistema'";
$queryA = $conexion->query($sql);
$result = $queryA->fetch_assoc();
$Anomes = $result["Valor"];

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
echo '
		<section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"><i class="icon_piechart"></i> GR&Aacute;FICOS</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i>
                	<a href="index_p.php">Home</a>
                </li>
                <li><i class="icon_piechart"></i>Gr&aacute;ficos Estadisticos de Nivel de Atenci&oacute;n a Slicitudes de Soporte 
                </li>
              </ol>
             </div>
          </div>
          <div class="row"> 
          	<div class="col-lg-12">
          	<section class="panel">
                <header class="panel-heading">
                  <h3>Indicadores del &Aacute;rea de Tecnolog&iacute;a</h3>
                </header>
                 <div class="panel-body">
                   <div class="tab-pane" id="chartjs">
                      <div class="row">
                      <div class="col-lg-12">
                              <section class="panel">
                                  <header class="panel-heading">
                                      <b>ATENCI&Oacute;N DE SOS EN EL MES</b> <br>Selecciona el Corte: 
                                      <select id="corte" onchange="CargaGrafico(1)">
                                        '.$Options.'
                                      </select>
                                  </header>
                                  <div class="panel-body text-center" style="border:1px solid black;">
                                      <div id="barra" style="border:2px solid black;width: 100%; height: 500px; margin: 0 auto"></div>
                                  </div>
                              </section>
                          </div>
                      </div>
                      <div class="row">
                      <div class="col-lg-12">
                              <section class="panel">
                                  <header class="panel-heading"><b>ATENCI&Oacute;N DE SOS DE INTRANET EN EL MES</b><br>
                                      Selecciona el Corte: 
                                      <select id="corteIntranet"  onchange="CargaGrafico(2)">
                                         '.$Options.'
                                      </select>
                                  </header>
                                  <div class="panel-body text-center" style="border:1px solid black;">
                                      <div id="barra1" style="border:2px solid black;width: 100%; height: 500px; margin: 0 auto"></div>
                                  </div>
                              </section>
                          </div>
                      </div>
                      <div class="row">
                      <div class="col-lg-12">
                              <section class="panel">
                                  <header class="panel-heading"><b>ATENCI&Oacute;N DE SOS DE APOTEOSYS EN EL MES</b><br>
                                      Selecciona el Corte: 
                                      <select id="corteApoteosys"  onchange="CargaGrafico(3)">
                                        '.$Options.'
                                      </select>
                                  </header>
                                  <div class="panel-body text-center" style="border:1px solid black;">
                                      <div id="barra2" style="border:2px solid black;width: 100%; height: 500px; margin: 0 auto"></div>
                                  </div>
                              </section>
                          </div>
                      </div>
                      <div class="row">
                      <div class="col-lg-12">
                              <section class="panel">
                                  <header class="panel-heading"><b>ATENCI&Oacute;N DE SOS DE NOMINA EN EL MES</b><br>
                                      Selecciona el Corte: 
                                      <select id="corteNomina"  onchange="CargaGrafico(4)">
                                        '.$Options.'
                                        </select>
                                  </header>
                                  <div class="panel-body text-center" style="border:1px solid black;">
                                      <div id="barra3" style="border:2px solid black;width: 100%; height: 500px; margin: 0 auto"></div>
                                  </div>
                              </section>
                          </div>
                      </div>
                      <div class="row">
                      <div class="col-lg-12">
                              <section class="panel">
                                  <header class="panel-heading"><b>ATENCI&Oacute;N DE SOS DE SBI EN EL MES</b><br>
                                      Selecciona el Corte: 
                                      <select id="corteSbi" onchange="CargaGrafico(5)">
                                        '.$Options.'
                                      </select>
                                  </header>
                                  <div class="panel-body text-center" style="border:1px solid black;">
                                      <div id="barra4" style="border:2px solid black;width: 100%; height: 500px; margin: 0 auto"></div>
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
      <script src="js/exporting.js"></script>
      <script src="js/export-data.js"></script>
      <script src="js/data.js"></script>
      <script type="text/javascript">
            CargaGrafico(1);
            CargaGrafico(2);
            CargaGrafico(3);
            CargaGrafico(4);
            CargaGrafico(5);
      </script>
';
require_once("foot.php");
?>