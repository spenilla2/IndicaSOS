<?php
require("head.php");
global $conexion;
$sql = "SELECT Valor 
          FROM INDICADORES_PARAMETROS 
         WHERE Variable='Corte_Sistema'";
$query =  $conexion->query($sql);
$result = $query->fetch_assoc();
$corte = $result["Valor"];
$Ano = substr($corte,0,4)+0;
$mes = substr($corte,4,2)+0;
$mes1 = (($mes-1)<=0)?12:$mes-1;
$Ano1 = (($mes-1)<=0)?$Ano-1:$Ano;
$mes2 = (($mes1-1)<=0)?12:$mes1-1;
$Ano2 = (($mes1-1)<=0)?$Ano1-1:$Ano1;
$mes3 = (($mes2-1)<=0)?12:$mes2-1;
$Ano3 = (($mes2-1)<=0)?$Ano2-1:$Ano2;

$corte1=$Ano1.(($mes1<10)?'0'.$mes1:$mes1);
$corte2=$Ano2.(($mes2<10)?'0'.$mes2:$mes2);
$corte3=$Ano3.(($mes3<10)?'0'.$mes3:$mes3);

echo '
<style type="text/css">
</style>
<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i> resumen indicadores</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index_p.php">Home</a></li>
              <li><i class="fa fa-table"></i>Resumen Indicadores</li>
              <li></li>
            </ol>
          </div>
        </div>
        <section class="panel" >
              <header class="panel-heading tab-bg-primary ">
                <ul class="nav nav-tabs">
                  <li class="active" style="background:green;">
                    <a data-toggle="tab" href="#home">'.$corte.'</a>
                  </li>
                  <li class="" style="background:green;">
                    <a data-toggle="tab" href="#about">'.$corte1.'</a>
                  </li>
                  <li class="" style="background:green;">
                    <a data-toggle="tab" href="#profile">'.$corte2.'</a>
                  </li>
                  <li class="" style="background:green;">
                    <a data-toggle="tab" href="#contact">'.$corte3.'</a>
                  </li>
                </ul>
              </header>
              <div class="panel-body">
                <div class="tab-content">
                  <div id="home" class="tab-pane active">
                    <div class="row">
                      <div class="col-sm-12">
                        <section class="panel">
                          <div style="overflow-x:scroll;width:100%;white-space:nowrap;">
                          <br>
                            <table class="table" border=1>
                <thead>
                  <tr>
                    <th>Concepto</th>
                    <th>Soporte Inicial</th>
                    <th>ingreso Mes</th>
                    <th>Total</th>
                    <th>Meta</th>
                    <th>Remitido</th>
                    <th>Anulado</th>
                    <th>Terminado</th>
                    <th>Gesti&oacute;n</th>
                    <th>Depurado</th>
                    <th>Pendiente</th>
                    <th>% Soportes<br>Trabajados</th>
                    <th>% Soportes<br>Depurados</th>
                    <th>Gesti&oacute;n sobre<br>el total a atender</th>
                    <th>Sin Gesti&oacute;n</th>
                  </tr>
                </thead>
                <tbody>';
                $sql = "SELECT * 
                          FROM indicadores_resumen 
                         WHERE Anomes='".$corte."'";
                $query = $conexion->query($sql);
                $nfilas = $query->num_rows;
                for($i=0;$i<$nfilas;$i++){
                 $result = $query->fetch_array();
                 $Meta=floor($result[2]*0.95);
                 $Gestion=($result[5]+$result[6]+$result[7]);
                 $Depurado=$result[6]+$result[7];
                 $Meta=($Meta==0)?1:$Meta;
                 $result[2]=($result[2]==0)?1:$result[2];
                 $Cumple_Gestion=floor(($Gestion/$Meta)*100);
                 $Depuracion = floor(($Depurado/$Meta)*100);
                 $Gestion_total = floor(($Gestion/$result[2])*100);
                 $NGestion = $result[2]-$Gestion;
                  if($result[1]=="Totales"){
                    echo '<tr style="border-style:dashed;border-width:2px;">
                          <td class="td_to_">'.$result[1].'</td>
                          <td class="td_to_N">'.$result[3].'</td>
                          <td class="td_to_N">'.$result[4].'</td>
                          <td class="td_to_N">'.$result[2].'</td>
                          <td class="td_to_N">'.floor($result[2]*0.95).'</td>
                          <td class="td_to_N">'.$result[5].'</td>
                          <td class="td_to_N">'.$result[6].'</td>
                          <td class="td_to_N">'.$result[7].'</td>
                          <td class="td_to_N">'.$Gestion.'</td>
                          <td class="td_to_N">'.$Depurado.'</td>
                          <td class="td_to_N">'.$result[8].'</td>
                          <td class="td_to">'.$Cumple_Gestion.' %</td>
                          <td class="td_to">'.$Depuracion.' %</td>
                          <td class="td_to">'.$Gestion_total.' %</td>
                          <td style="background:pink;color:red;font-weight:bold;text-align:center;">'.$NGestion.'</td>
                        </tr>';
                  }else{
                      $Meta=floor($result[2]*0.95);
                      $Gestion=($result[5]+$result[6]+$result[7]);
                      $Depurado=$result[6]+$result[7];
                      echo '<tr>
                          <td class="td_to_G">'.$result[1].'</td>
                          <td class="td_to_N">'.$result[3].'</td>
                          <td class="td_to_N">'.$result[4].'</td>
                          <td class="td_to">'.$result[2].'</td>
                          <td class="td_to_M">'.$Meta.'</td>
                          <td class="td_to_N"><a href="modulo_detalle_prof1.php?prof=1&Anomes='.$corte.'&Var1='.$result[1].'">'.$result[5].'</a></td>
                          <td class="td_to_N"><a href="modulo_detalle_prof3.php?prof=1&Anomes='.$corte.'&Var1='.$result[1].'">'.$result[6].'</a></td>
                          <td class="td_to_N"><a href="modulo_detalle_prof2.php?prof=1&Anomes='.$corte.'&Var1='.$result[1].'">'.$result[7].'</a></td>
                          <td class="td_to_N">'.$Gestion.'</td>
                          <td class="td_to_N">'.$Depurado.'</td>
                          <td class="td_to_N"><a href="modulo_detalle_prof.php?prof=1&Anomes='.$corte.'&Var1='.$result[1].'">'.$result[8].'</a></td>
                          <td class="td_to">'.$Cumple_Gestion.' %</td>
                          <td class="td_to">'.$Depuracion.' %</td>
                          <td class="td_to">'.$Gestion_total.' %</td>
                          <td style="background:pink;color:red;font-weight:bold;text-align:center;">'.$NGestion.'</td>
                        </tr>';  
                  }
                  
                }
                  
                  
         echo '</tbody>
              </table>
                          </div>
                        </section>
                      </div>
                    </div>
                  </div>
                  <div id="about" class="tab-pane">
                    <div class="row">
                      <div class="col-sm-12">
                        <section class="panel" >
                          <header class="panel-heading">
                            Tabla Indicadores
                          </header>
                          <div style="overflow-x:scroll;width:100%;white-space:nowrap;">
                            <table class="table">
                <thead>
                  <tr>
                    <th>Concepto</th>
                    <th>Soporte Inicial</th>
                    <th>ingreso Mes</th>
                    <th>Total</th>
                    <th>Meta</th>
                    <th>Remitido</th>
                    <th>Anulado</th>
                    <th>Terminado</th>
                    <th>Gesti&oacute;n</th>
                    <th>Depurado</th>
                    <th>Pendiente</th>
                    <th>% Soportes Trabajados</th>
                    <th>% Soportes Depurados</th>
                    <th>Gesti&oacute;n sobre el total a atender</th>
                    <th>Sin Gesti&oacute;n</th>
                  </tr>
                </thead>
                <tbody>';
                $sql = "SELECT * 
                          FROM indicadores_resumen 
                         WHERE Anomes='".$corte1."'";
                $query = $conexion->query($sql);
                $nfilas = $query->num_rows;
                for($i=0;$i<$nfilas;$i++){
                 $result = $query->fetch_array();
                 $Meta=floor($result[2]*0.95);
                 $Gestion=($result[5]+$result[6]+$result[7]);
                 $Depurado=$result[6]+$result[7];
                 $Meta=($Meta==0)?1:$Meta;
                 $result[2]=($result[2]==0)?1:$result[2];
                 $Cumple_Gestion=floor(($Gestion/$Meta)*100);
                 $Depuracion = floor(($Depurado/$Meta)*100);
                 $Gestion_total = floor(($Gestion/$result[2])*100);
                 $NGestion = $result[2]-$Gestion;
                  if($result[1]=="Totales"){
                    echo '<tr style="border-style:dashed;border-width:2px;">
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$result[1].'</td>
                          <td>'.$result[3].'</td>
                          <td>'.$result[4].'</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$result[2].'</td>
                          <td>'.floor($result[2]*0.95).'</td>
                          <td>'.$result[5].'</td>
                          <td>'.$result[6].'</td>
                          <td>'.$result[7].'</td>
                          <td>'.$Gestion.'</td>
                          <td>'.$Depurado.'</td>
                          <td>'.$result[8].'</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$Cumple_Gestion.' %</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$Depuracion.' %</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$Gestion_total.' %</td>
                          <td style="background:pink;color:red;font-weight:bold;text-align:right;">'.$NGestion.'</td>
                        </tr>';
                  }else{
                      $Meta=floor($result[2]*0.95);
                      $Gestion=($result[5]+$result[6]+$result[7]);
                      $Depurado=$result[6]+$result[7];
                      echo '<tr>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$result[1].'</td>
                          <td>'.$result[3].'</td>
                          <td>'.$result[4].'</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$result[2].'</td>
                          <td>'.$Meta.'</td>
                          <td>'.$result[5].'</td>
                          <td>'.$result[6].'</td>
                          <td>'.$result[7].'</td>
                          <td>'.$Gestion.'</td>
                          <td>'.$Depurado.'</td>
                          <td>'.$result[8].'</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$Cumple_Gestion.' %</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$Depuracion.' %</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$Gestion_total.' %</td>
                          <td style="background:pink;color:red;font-weight:bold;text-align:right;">'.$NGestion.'</td>
                        </tr>';  
                  }
                  
                }
                  
                  
         echo '</tbody>
              </table>
                          </div>
                        </section>
                      </div>
                      </div>  

                  </div>
                  <div id="profile" class="tab-pane">
                    <div class="row">
                      <div class="col-sm-12">
                        <section class="panel" >
                          <header class="panel-heading">
                            Tabla Indicadores
                          </header>
                          <div style="overflow-x:scroll;width:100%;white-space:nowrap;">
                          <table class="table">
                <thead>
                  <tr>
                    <th>Concepto</th>
                    <th>Soporte Inicial</th>
                    <th>ingreso Mes</th>
                    <th>Total</th>
                    <th>Meta</th>
                    <th>Remitido</th>
                    <th>Anulado</th>
                    <th>Terminado</th>
                    <th>Gesti&oacute;n</th>
                    <th>Depurado</th>
                    <th>Pendiente</th>
                    <th>% Soportes Trabajados</th>
                    <th>% Soportes Depurados</th>
                    <th>Gesti&oacute;n sobre el total a atender</th>
                    <th>Sin Gesti&oacute;n</th>
                  </tr>
                </thead>
                <tbody>';
                $sql = "SELECT * 
                          FROM indicadores_resumen 
                         WHERE Anomes='".$corte2."'";
                $query = $conexion->query($sql);
                $nfilas = $query->num_rows;
                for($i=0;$i<$nfilas;$i++){
                 $result = $query->fetch_array();
                 $Meta=floor($result[2]*0.95);
                 $Gestion=($result[5]+$result[6]+$result[7]);
                 $Depurado=$result[6]+$result[7];
                 $Meta=($Meta==0)?1:$Meta;
                 $result[2]=($result[2]==0)?1:$result[2];
                 $Cumple_Gestion=floor(($Gestion/$Meta)*100);
                 $Depuracion = floor(($Depurado/$Meta)*100);
                 $Gestion_total = floor(($Gestion/$result[2])*100);
                 $NGestion = $result[2]-$Gestion;
                  if($result[1]=="Totales"){
                    echo '<tr style="border-style:dashed;border-width:2px;">
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$result[1].'</td>
                          <td>'.$result[3].'</td>
                          <td>'.$result[4].'</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$result[2].'</td>
                          <td>'.floor($result[2]*0.95).'</td>
                          <td>'.$result[5].'</td>
                          <td>'.$result[6].'</td>
                          <td>'.$result[7].'</td>
                          <td>'.$Gestion.'</td>
                          <td>'.$Depurado.'</td>
                          <td>'.$result[8].'</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$Cumple_Gestion.' %</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$Depuracion.' %</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$Gestion_total.' %</td>
                          <td style="background:pink;color:red;font-weight:bold;text-align:right;">'.$NGestion.'</td>
                        </tr>';
                  }else{
                      $Meta=floor($result[2]*0.95);
                      $Gestion=($result[5]+$result[6]+$result[7]);
                      $Depurado=$result[6]+$result[7];
                      echo '<tr>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$result[1].'</td>
                          <td>'.$result[3].'</td>
                          <td>'.$result[4].'</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$result[2].'</td>
                          <td>'.$Meta.'</td>
                          <td>'.$result[5].'</td>
                          <td>'.$result[6].'</td>
                          <td>'.$result[7].'</td>
                          <td>'.$Gestion.'</td>
                          <td>'.$Depurado.'</td>
                          <td>'.$result[8].'</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$Cumple_Gestion.' %</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$Depuracion.' %</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$Gestion_total.' %</td>
                          <td style="background:pink;color:red;font-weight:bold;text-align:right;">'.$NGestion.'</td>
                        </tr>';  
                  }
                  
                }
                  
                  
         echo '</tbody>
              </table>
                          </div>
                        </section>
                      </div>
                      </div>
                  </div>
                  <div id="contact" class="tab-pane">
                    <div class="row">
                      <div class="col-sm-12">
                        <section class="panel" >
                          <header class="panel-heading">
                            Tabla Indicadores
                          </header>
                      <div style="overflow-x:scroll;width:100%;white-space:nowrap;">
                          <table class="table">
                <thead>
                  <tr>
                    <th>Concepto</th>
                    <th>Soporte Inicial</th>
                    <th>ingreso Mes</th>
                    <th>Total</th>
                    <th>Meta</th>
                    <th>Remitido</th>
                    <th>Anulado</th>
                    <th>Terminado</th>
                    <th>Gesti&oacute;n</th>
                    <th>Depurado</th>
                    <th>Pendiente</th>
                    <th>% Soportes Trabajados</th>
                    <th>% Soportes Depurados</th>
                    <th>Gesti&oacute;n sobre el total a atender</th>
                    <th>Sin Gesti&oacute;n</th>
                  </tr>
                </thead>
                <tbody>';
                $sql = "SELECT * 
                          FROM indicadores_resumen 
                         WHERE Anomes='".$corte3."'";
                $query = $conexion->query($sql);
                $nfilas = $query->num_rows;
                for($i=0;$i<$nfilas;$i++){
                 $result = $query->fetch_array();
                 $Meta=floor($result[2]*0.95);
                 $Gestion=($result[5]+$result[6]+$result[7]);
                 $Depurado=$result[6]+$result[7];
                 $Meta=($Meta==0)?1:$Meta;
                 $result[2]=($result[2]==0)?1:$result[2];
                 $Cumple_Gestion=floor(($Gestion/$Meta)*100);
                 $Depuracion = floor(($Depurado/$Meta)*100);
                 $Gestion_total = floor(($Gestion/$result[2])*100);
                 $NGestion = $result[2]-$Gestion;
                  if($result[1]=="Totales"){
                    echo '<tr style="border-style:dashed;border-width:2px;">
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$result[1].'</td>
                          <td>'.$result[3].'</td>
                          <td>'.$result[4].'</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$result[2].'</td>
                          <td>'.floor($result[2]*0.95).'</td>
                          <td>'.$result[5].'</td>
                          <td>'.$result[6].'</td>
                          <td>'.$result[7].'</td>
                          <td>'.$Gestion.'</td>
                          <td>'.$Depurado.'</td>
                          <td>'.$result[8].'</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$Cumple_Gestion.' %</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$Depuracion.' %</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$Gestion_total.' %</td>
                          <td style="background:pink;color:red;font-weight:bold;text-align:right;">'.$NGestion.'</td>
                        </tr>';
                  }else{
                      $Meta=floor($result[2]*0.95);
                      $Gestion=($result[5]+$result[6]+$result[7]);
                      $Depurado=$result[6]+$result[7];
                      echo '<tr>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$result[1].'</td>
                          <td>'.$result[3].'</td>
                          <td>'.$result[4].'</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$result[2].'</td>
                          <td>'.$Meta.'</td>
                          <td>'.$result[5].'</td>
                          <td>'.$result[6].'</td>
                          <td>'.$result[7].'</td>
                          <td>'.$Gestion.'</td>
                          <td>'.$Depurado.'</td>
                          <td>'.$result[8].'</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$Cumple_Gestion.' %</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$Depuracion.' %</td>
                          <td style="background:green;color:white;font-weight:bold;text-align:right;">'.$Gestion_total.' %</td>
                          <td style="background:pink;color:red;font-weight:bold;text-align:right;">'.$NGestion.'</td>
                        </tr>';  
                  }
                  
                }
                  
                  
         echo '</tbody>
              </table>
                      </div>
                      </section>
                      </div>
                      </div>
                  </div>
                </div>
              </div>
            </section>
        <!-- page start-->
        </div>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
                <div class="panel-body">
                    <div class="tab-pane" id="chartjs">
                      <div class="row">
                      <div class="col-lg-12">
                              <section class="panel">
                                  <header class="panel-heading">
                                      <b>CUMPLIMIENTO MENSUAL</b>
                                  </header>
                                  <div class="panel-body text-center" style="border:1px solid black;">
                                      <div id="linea" style="border:2px solid black;width: 100%; height: 500px; margin: 0 auto"></div>
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
<script src="js/series-label.js"></script>
<script src="js/exporting.js"></script>
<script src="js/export-data.js"></script>
<script src="js/data.js"></script>
<script type="text/javascript">
      grafico_Linea('.$corte.');
</script>
';

require_once("foot.php");
?>