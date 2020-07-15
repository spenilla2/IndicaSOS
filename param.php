<?php
include("head.php");
global $conexion;
date_default_timezone_set('UTC');
$fechaAr = date("dmY");
$sql = "SELECT *
          FROM INDICADORES_PARAMETROS";
$query = $conexion->query($sql);
$nfil = $query->num_rows;


echo '
<section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"> PAR&Aacute;METROS PRINCIPALES DEL SISTEMA</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i>
                    <a href="index_p.php">Home</a>
                </li>
                <li>Parametrizaci&oacute;n del Sistema
                </li>
              </ol>
             </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <div class="panel-body">
                        <div class="tab-pane" id="chartjs">
                          <div class="row">
                            <div class="col-lg-12">
                                    <div class="table-responsive" id="table1" style="border:2px solid black;width: 100%; height: 400px; margin: 0 auto; overflow-y:scroll;text-align:left;padding-top:10px;">
                                    	<ul>
                                        <li><b>Selecciona el Par&aacute;metro :</b>
                                            <select id="parametros" onchange="TraeData()">
                                            <option value="o">Selecciona..</option>';
                                          for($i=0;$i<$nfil;$i++){
                                            $result = $query->fetch_array();
                                            echo '<option value="'.$result[0].'">'.$result[1].'</option>';
                                          }
                                          echo '
                                          </select>
                                        </li>
                                        <br>
                                        <li id="res"></li>
                                      </ul>
                                    </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </section>
            </div>
          </div>
        </section>
    </section>
    <script src="js/data.js"></script>
';
require_once("foot.php");
?>