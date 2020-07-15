<?php
require("head.php");
global $conexion;
function crea_Query($select,$argumentos,$agrupa,$corte){
	$QueryA="SELECT S.".$select.", 
		           COUNT(*) AS TOTAL 
		     FROM INDICADORES_SOS S
		    WHERE S.ATENCION = 'Sistemas'
		     AND S.ESTADO_SOS IN('Terminado','Terminado Sin Calificar')
		     AND S.ANOMES ='".$corte."' ".$argumentos." ".$agrupa;
return $QueryA;
}
function crea_Query_Detalle($argumentos,$corte){
	$QueryA="SELECT S.SOS,
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
		     AND S.ESTADO_SOS IN('Terminado','Terminado Sin Calificar')
		     AND S.ANOMES ='".$corte."' ".$argumentos.' ORDER BY 1 ASC';
return $QueryA;
}
function crea_Tabla($Query,$nfilas,$select,$corte,$arg){
	$tabla='<table width="90%" class="table">
				<thead>
                	<tr>
                		<th width="55%">'.$select.'</th>
                		<th>CANTIDAD DE CASOS</th>
                	</tr>
                </thead>
                <tbody>';
                for($i=0;$i<$nfilas;$i++){
                	$res=$Query->fetch_array();
                	$tabla.='<tr>
                				<td style="background:#02A24A;color:white;font-weight:bold;text-align:right;">'.$res[0].'</td>
                				<td><a href="prueba.php?anomes='.$corte.'&arg1='.$arg.'&arg2='.$select.'&arg3='.$res[0].'&arg4=3">'.$res[1].'</a></td>
                			  </tr>
                			 ';
                }
    $tabla.='   </tbody>
		    </table>';
return $tabla;
}
function crea_Tabla_Detalle($Query,$nfilas,$anomes){
	$tabla='<table width="90%" class="table">
				<thead>
                	<tr><th style="background:#02A24A;">No.</th>
                		<th style="background:#02A24A;">SOS</th>
                		<th style="background:#02A24A;">RADICA</th>
                		<th style="background:#02A24A;">RESPONSABLE</th>
                		<th style="background:#02A24A;">SISTEMA</th>
                		<th style="background:#02A24A;">PROCESO</th>
                		<th style="background:#02A24A;">ACTIVIDAD</th>
                		<th style="background:#02A24A;" width="30%">DESCRIPCION</th>
                		<th style="background:#02A24A;">ESTADO</th>
                		<th style="background:#02A24A;">FECHA RADICACION</th>
                		<th style="background:#02A24A;">APLICATIVO</th>
                		<th style="background:#02A24A;">CONTROLA</th>
                	</tr>
                </thead>
                <tbody>';
                for($i=0;$i<$nfilas;$i++){
                	$res=$Query->fetch_array();
                	$tabla.='<tr>
                				<td>'.($i+1).'</td>
                				<td><a href="detalle_sos.php?Sos='.$res[0].'&Anomes='.$anomes.'">'.$res[0].'</td>
                				<td>'.$res[1].'</td>
                				<td>'.$res[2].'</td>
                				<td>'.$res[3].'</td>
                				<td>'.$res[4].'</td>
                				<td>'.$res[5].'</td>                				
                				<td align="justify" width="40%">'.$res[6].'</td>
                				<td>'.$res[7].'</td>  
                				<td>'.$res[8].'</td>  
                				<td>'.$res[9].'</td> 
                				<td>'.$res[10].'</td>   
                			  </tr>
                			 ';
                }
    $tabla.='   </tbody>
		    </table>';
return $tabla;
}

$var1 = $_GET['Var1'];
$anomes = $_GET['Anomes'];
$profundidad =$_GET['prof'];
$nfilas = 0;
$Query0="";
$Query1="";
$Query2="";
$Query3="";
$sql="";
$tabla0="";
$tabla1="";
$tabla2="";
$tabla3="";

switch($profundidad){
	case 1:
		switch($var1){
			case 'Area - Sin Desarrollos';
				$argumentos ="AND S.SUBCLAS <> 'Desarrollo'";
			break;
			case 'Solo Desarrollos';
				$argumentos ="AND S.SUBCLAS = 'Desarrollo'";
			break;
			case 'Software';
				$argumentos ="AND S.CONTROLA = 'Software'";
			break;
			case 'Infraestructura';
				$argumentos ="AND S.CONTROLA = 'Infraestructura'";
			break;
			case 'Perfiles';
				$argumentos ="AND S.CONTROLA = 'Perfiles'";
			break;
		}
		$select ="CONTROLA";
		$sql = crea_Query($select,$argumentos,"GROUP BY ".$select,$anomes);
		$Query = $conexion->query($sql);
		$nfilas = $Query->num_rows;
		$tabla = crea_Tabla($Query,$nfilas,$select,$anomes,$argumentos);
		
		$select0 ="PROCESO";
		$sql0 = crea_Query($select0,$argumentos,"GROUP BY ".$select0,$anomes);
		$Query0 = $conexion->query($sql0);
		$nfilas0 = $Query0->num_rows;
		$tabla0 = crea_Tabla($Query0,$nfilas0,$select0,$anomes,$argumentos);
				
		$select1 ="ESTADO_SOS";
		$sql1 = crea_Query($select1,$argumentos,"GROUP BY ".$select1,$anomes);
		$Query1 = $conexion->query($sql1);
		$nfilas1 = $Query1->num_rows;
		$tabla1 = crea_Tabla($Query1,$nfilas1,$select1,$anomes,$argumentos);
				
		$select2 ="RESPONSABLE";
		$sql2 = crea_Query($select2,$argumentos,"GROUP BY ".$select2,$anomes);
		$Query2 = $conexion->query($sql2);
		$nfilas2 = $Query2->num_rows;
		$tabla2 = crea_Tabla($Query2,$nfilas2,$select2,$anomes,$argumentos);

		
		$sql3 = crea_Query_Detalle($argumentos,$anomes);
		$Query3 = $conexion->query($sql3);
		$nfilas3 = $Query3->num_rows;
		$tabla3 = crea_Tabla_Detalle($Query3,$nfilas3,$anomes);
	break;
}
echo '<section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"> DETALLE RESUMEN</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i>
                    <a href="index_p.php">Home</a>
                </li>
                <li>Detalle Resumen Indicadores
                </li>
                <li>'.$var1.'
                </li>
                <li>'.$anomes.'</li>
              </ol>
             </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                         <h3>Detalle de Indicadores de Gesti&oacute;n del &Aacute;rea de Tecnolog&iacute;a</h3>
                    </header>
                    <div class="panel-body">
                        <div class="tab-pane" id="chartjs">
                          <div class="row">
                            <div class="col-lg-6">
                                <section class="panel">
                                    <header class="panel-heading">
                                      <b>CASOS POR '.$select.'</b> <br>
                                    </header>
                                    <div class="panel-body text-center" style="border:1px solid black;">
                                        <div class="table-responsive" id="table1" style="border:2px solid black;width: 100%; height: 200px; margin: 0 auto; overflow-y:scroll;">
                                        '.$tabla.'
                                      </div>
                                    </div>                                  
                                </section>
                            </div>
                            <div class="col-lg-6">
                                <section class="panel">
                                    <header class="panel-heading">
                                      <b>CASOS POR '.$select0.'</b> <br>
                                    </header>
                                    <div class="panel-body text-center" style="border:1px solid black;">
                                        <div class="table-responsive" id="table1" style="border:2px solid black;width: 100%; height: 200px; margin: 0 auto; overflow-y:scroll;">
                                        '.$tabla0.'
                                      </div>
                                    </div>                                  
                                </section>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6">
                                <section class="panel">
                                    <header class="panel-heading">
                                      <b>CASOS POR '.$select1.'</b> <br>
                                    </header>
                                    <div class="panel-body text-center" style="border:1px solid black;">
                                        <div class="table-responsive" id="table1" style="border:2px solid black;width: 100%; height: 400px; margin: 0 auto; overflow-y:scroll;">
                                        '.$tabla1.'
                                      </div>
                                    </div>                                  
                                </section>
                            </div>
                            <div class="col-lg-6">
                                <section class="panel">
                                    <header class="panel-heading">
                                      <b>CASOS POR '.$select2.'</b> <br>
                                    </header>
                                    <div class="panel-body text-center" style="border:1px solid black;">
                                        <div id="barra_area" style="border:2px solid black;width: 100%; height: 400px; margin: 0 auto; overflow-y:scroll;">
                                        '.$tabla2.'
                                      </div>
                                    </div>                                  
                                </section>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">
                                    <header class="panel-heading">
                                      <b>LISTADO DE CASOS</b> <br>
                                    </header>
                                    <div class="panel-body text-center" style="border:1px solid black;">
                                        <div class="table-responsive" id="table1" style="border:2px solid black;width: 100%; height: 400px; margin: 0 auto; overflow-y:scroll;">
                                        '.$tabla3.'
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