<?php
require("head.php");
    echo '
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i>COMO VAMOS</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
              <li><i class="fa fa-laptop"></i>Como Vamos</li>
            </ol>
          </div>
        </div>
        <!-- project team & activity start -->
        <div class="row">
          <div class="col-md-12 portlets">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><strong>Calendario</strong></h2>
                <div class="panel-actions">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>

              </div><br><br><br>
              <div class="panel-body">
                <!-- Widget content -->

                <!-- Below line produces calendar. I am using FullCalendar plugin. -->
                <div id="calendar"></div>

              </div>
            </div>

          </div>

          
        </div>
        <!-- project team & activity end -->

      </section>
      <div class="text-right">
        <div class="credits">
          Diseñado por Direcci&oacute;n de Tecnolog&iacute;a <b>COPROCENVA</b></a>
        </div>
      </div>
    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->
';
require_once("foot.php");
?>