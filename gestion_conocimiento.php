<?php
require("head.php");
global $conexion;
$Concepto="Area-Sin Desarrollos";

echo '<section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"> DETALLE RESUMEN</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i>
                    <a href="index.php">Home</a>
                </li>
                <li>Gestion del Conocimiento
                </li>
                <li>'.$Concepto.'
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
                                        
                                    </header>
                                    <div class="panel-body text-center" style="border:1px solid black;">
                                        <div id="barra_area" style="border:2px solid black;width: 100%; height: 400px; margin: 0 auto">
                                      </div>
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
        ';

require_once("foot.php");
?>