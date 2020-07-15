<?php
include("head.php");
global $conexion;
$corte = $_GET['anomes'];
$arg1 = $_GET['arg1'];
$arg2 = $_GET['arg2'];
$arg3 = $_GET['arg3'];
$arg4 = $_GET['arg4'];
$var="";
switch($arg4){
    case 1:
        $var="AND S.ESTADO_SOS IN('Ejecución','Pendiente','Solución','Análisis','Atención')";
    break;
    case 2:
        $var="AND S.ESTADO_SOS IN('Remitido',
                                  'Remitido proveedor',
                                  'Remitido usuario')";
    break;
    case 3:
        $var="AND S.ESTADO_SOS IN('Terminado',
                                      'Terminado Sin Calificar')";
    break;
    case 4:
        $var="AND S.ESTADO_SOS IN('Anulado')";
    break;
    
    default:
        $var="AND S.ESTADO_SOS NOT IN('Terminado',
                                      'Terminado Sin Calificar',
                                      'Anulado')";
    break;
}
$sql="       SELECT S.SOS,
                    S.RADICA,
                    S.RESPONSABLE,
                    S.SISTEMA,
                    S.PROCESO,
                    S.ACTIVIDAD,
                    S.DESSOP,
                    S.ESTADO_SOS,
                    S.FECRAD,
                    S.SUBCLAS_APLIC,
                    S.CONTROLA
             FROM INDICADORES_SOS S
            WHERE S.ATENCION = 'Sistemas'
             ".$var."
             AND S.ANOMES ='".$corte."'
             ".$arg1."
             AND S.".$arg2."='".$arg3."' 
        ORDER BY 1 ASC";
$Query = $conexion->query($sql);
$nfilas = $Query->num_rows;
echo '
<section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                         <h3>Detalle de Indicadores de Gesti&oacute;n del &Aacute;rea de Tecnolog&iacute;a</h3>
                    </header>
                    <div class="panel-body">
                        <div class="tab-pane" id="chartjs">
                          
                         <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">
                                    <header class="panel-heading">
                                      <b>LISTADO DE CASOS ('.$nfilas.')</b> <br>
                                    </header>
                                    <div class="panel-body text-center" style="border:1px solid black;">
                                        <div class="table-responsive" id="table1" style="border:2px solid black;width: 100%; height: 700px; margin: 0 auto; overflow-y:scroll;">
                                        <br>
                                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>SOS</th>
                                        <th>RADICA</th>
                                        <th>RESPONSABLE</th>
                                        <th>SISTEMA</th>
                                        <th>PROCESO</th>
                                        <th>ACTIVIDAD</th>
                                        <th width="20%">DESCRIPCION</th>
                                        <th>ESTADO</th>
                                        <th>FECHA RADICACION</th>
                                        <th>APLICATIVO</th>
                                        <th>CONTROLA</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>SOS</th>
                                        <th>RADICA</th>
                                        <th>RESPONSABLE</th>
                                        <th>SISTEMA</th>
                                        <th>PROCESO</th>
                                        <th>ACTIVIDAD</th>
                                        <th width="20%">DESCRIPCION</th>
                                        <th>ESTADO</th>
                                        <th>FECHA RADICACION</th>
                                        <th>APLICATIVO</th>
                                        <th>CONTROLA</th>
                                    </tr>
                                </tfoot>
                                <tbody>';
                                for($i=0;$i<$nfilas;$i++){
                                    $res=$Query->fetch_array();
                                    echo '<tr>
                                        <td>'.($i+1).'</td>
                                        <td><a href="detalle_sos.php?Sos='.$res[0].'&Anomes='.$corte.'">'.$res[0].'</td>
                                        <td>'.$res[1].'</td>
                                        <td>'.$res[2].'</td>
                                        <td>'.$res[3].'</td>
                                        <td>'.$res[4].'</td>
                                        <td>'.$res[5].'</td>                                
                                        <td width="20%" align="justify">'.$res[6].'</td>
                                        <td>'.$res[7].'</td>  
                                        <td>'.$res[8].'</td>  
                                        <td>'.$res[9].'</td> 
                                        <td>'.$res[10].'</td>   
                                      </tr>
                             ';
                                }
echo '
                                </tbody>
                            </table>
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
<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Cargando...</p>
        </div>
    </div>
   
            

    <!-- Jquery Core Js -->
    <script src="tables/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="tables/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="tables/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="tables/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="tables/plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="tables/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="tables/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="tables/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="tables/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="tables/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="tables/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="tables/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="tables/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="tables/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="tables/js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <!--script src="js/demo.js"></script-->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"></script>
 
</body>

</html>

';

?>
