<?php
require("head.php");
global $conexion;
$sql = "SELECT Valor 
          FROM INDICADORES_PARAMETROS 
         WHERE Variable='Corte_Sistema'";
$query = $conexion->query($sql);
$result = $query->fetch_assoc();
$corte = $result["Valor"];
$Query0 = "			   SELECT H.SOS,
							  H.RADICA,
							  H.RESPONSABLE,
							  H.PROCESO,
							  H.ACTIVIDAD,
							  H.DESSOP,
							  H.FECRAD,
							  H.FECTER,
							  H.CALIFICACION,
							  H.USER_CALIFICO,
							  H.FECHA_CALIFICO,
							  H.OBSERVACION,
							  H.ANOMES
    				     FROM INDICADORES_SOS H
                        WHERE H.ATENCION = '-'
                     ORDER BY 1 ASC";
   		   	$query = $conexion->query($Query0);
			$nfilas0 = $query->num_rows;

			if($nfilas0==0){
				$tabla='<h3 align="center">NO EXISTEN SOS PENDIENTES POR CLASIFICAR</h3>';
			}else{
				$tabla ='<table class="table" >
                     	<thead>
                        	<tr>
                        		<th>No</th>
                            	<th>SOS</th>
                                <th>RADICA</th>
                                <th>RESPONSABLE</th>
                                <th>PROCESO</th>
                                <th>ACTIVIDAD</th>
                                <th>DESCRIPCION</th>
                                <th>FECHA RADICACION</th>
                                <th>FECHA TERMINACION</th>
                                <th>CALIFICACION</th>
                                <th>USUARIO CALIFICA</th>
                                <th>FECHA CALIFICACION</th>
                                <th>OBSERVACION</th>
                            </tr>
                        </thead>
                        <tbody>';
			for($i=0;$i<$nfilas0;$i++){
				$res=$query->fetch_array();
				$tabla.='<tr>
							<td>'.($i+1).'</td>
							<td><a href="detalle_sos.php?Sos='.$res[0].'&Anomes='.$res[12].'"">'.$res[0].'</td>
							<td>'.$res[1].'</td>
							<td>'.$res[2].'</td>
							<td>'.$res[3].'</td>
							<td>'.$res[4].'</td>
							<td>'.$res[5].'</td>
							<td>'.$res[6].'</td>
							<td>'.$res[7].'</td>
							<td>'.$res[8].'</td>
							<td>'.$res[9].'</td>
							<td>'.$res[10].'</td>
							<td>'.$res[11].'</td>
						</tr>';
			}
			$tabla.="</tbody>
			</table>";				
			}
			
echo '
<section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"> SOS PENDIENTES DE CLASIFICACI&Oacute;N PARA LOS INDICADORES DE AREA</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i>
                    <a href="index_p.php">Home</a>
                </li>
                <li>Sos Pendientes de Clasificar<input type="hidden" id="SOS" value="'.$SOS.'">
                </li>
                <li>Corte '.$corte.'
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
                            <h4>TOTAL CASOS POR CLASIFICAR '.$nfilas0.'</h4>
                                    <div class="table-responsive" id="table1" style="border:2px solid black;width: 100%; height: 400px; margin: 0 auto; overflow-y:scroll;">
                                        '.$tabla.'
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
        <script src="js/jquery.js"></script>
        <script src="js/data.js"></script>
';

require_once("foot.php");
?>