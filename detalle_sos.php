<?php
require("head.php");
global $conexion;
$SOS = $_GET['Sos'];
$Anomes = $_GET['Anomes'];
$SQL = "SELECT * 
			   FROM INDICADORES_SOS S
		    WHERE S.ANOMES='".$Anomes."'
		      AND S.SOS=".$SOS;
$Query = $conexion->query($SQL);
$res = $Query->fetch_array();
$SQL1 = "SELECT * 
		   FROM INDICADORES_ATENCION S
	   ORDER BY 1 ASC";
$Query1 =  $conexion->query($SQL1);
$nfilas1 = $Query1->num_rows;
$select1 = '
			<select id="atencion">';
			for($i=0;$i<$nfilas1;$i++){
				$sel="";
				$res1=$Query1->fetch_array();
				if($res[40]==$res1[1]){
					$sel=" selected";
				}else{
					$sel="";
				}
				$select1.='<option value="'.$res1[0].'"'.$sel.'>'.$res1[1].'</option>';
			}

$select1.=' </select>';

$SQL2 = "SELECT * 
		   FROM INDICADORES_TCLASIFICACION S
	   ORDER BY 1 ASC";
$Query2 = $conexion->query($SQL2);
$nfilas2=$Query2->num_rows;
$select2 = '
			<select id="clasificacion">';
			for($i=0;$i<$nfilas2;$i++){
				$sel="";
				$res2=$Query2->fetch_array();
				if($res[41]==$res2[1]){
					$sel=" selected";
				}else{
					$sel="";
				}
				$select2.='<option value="'.$res2[0].'"'.$sel.'>'.$res2[1].'</option>';
			}

$select2.=' </select>';
$SQL3 = "SELECT * 
		   FROM INDICADORES_APLICACION  S
	   ORDER BY 1 ASC";
$Query3 = $conexion->query($SQL3);
$nfilas3=$Query3->num_rows;
$select3 = '
			<select id="aplicacion">';
			for($i=0;$i<$nfilas3;$i++){
				$sel="";
				$res2=$Query3->fetch_array();
				if($res[42]==$res2[1]){
					$sel=" selected";
				}else{
					$sel="";
				}
				$select3.='<option value="'.$res2[0].'"'.$sel.'>'.$res2[1].'</option>';
			}

$select3.=' </select>';

$SQL4 = "SELECT * 
		   FROM INDICADORES_CONTROLA  S
	   ORDER BY 1 ASC";
$Query4 = $conexion->query($SQL4);
$nfilas4=$Query4->num_rows;
$select4 = '
			<select id="controla">';
			for($i=0;$i<$nfilas4;$i++){
				$sel="";
				$res2=$Query4->fetch_array();
				if($res[43]==$res2[1]){
					$sel=" selected";
				}else{
					$sel="";
				}
				$select4.='<option value="'.$res2[0].'"'.$sel.'>'.$res2[1].'</option>';
			}
$select4.=' </select>';
$SQL5 = "SELECT * 
		   FROM INDICADORES_GESTION S
	   ORDER BY 1 ASC";
$Query5 = $conexion->query($SQL5);
$nfilas5=$Query5->num_rows;
$select5 = '
			<select id="gestion">';
			for($i=0;$i<$nfilas5;$i++){
				$sel="";
				$res2=$Query5->fetch_array();
				if($res[46]==$res2[1]){
					$sel=" selected";
				}else{
					$sel="";
				}
				$select5.='<option value="'.$res2[0].'"'.$sel.'>'.$res2[1].'</option>';
			}
$select5.=' </select>';

if($res[28]=='Terminado Sin Calificar'){
  if($res[15]!='Terminado'&&$res[15]!='Terminado Sin Calificar')
    {
      $res[28]="SOS ABIERTO";
    }else{
      $res[28]=$res[28];
    }
}else{
  $res[28]=$res[28];
}

echo '
<section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"> DETALLE SISTEMA OPTIMO DE SOPORTE</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i>
                    <a href="index_p.php">Home</a>
                </li>
                <li>Detalle SOS No. '.$SOS.'<input type="hidden" id="SOS" value="'.$SOS.'">
                </li>
                <li>Corte '.$Anomes.'
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
                                        <div class="table-responsive" id="table1" style="border:1px solid black;width: 100%; height: 730px; margin: 0 auto; overflow-y:scroll;">
                                        <table width="100%">
                                        	<tr>
	                                        	<td colspan=4 class="tablatit" align="center">
	                                        		<b>SISTEMA OPTIMO DE SOPORTES INTRANET</b>
	                                        	</td>
	                                        </tr>
                                        	<tr>
	                                        	<td width="7%" class="tablatit">
	                                        		No SOS :
	                                        	</td>
	                                        	<td align="left">
	                                        		'.$res[0].'
	                                        	</td>
	                                        	<td width="20%" class="tablatit">
	                                        		FECHA DE RADICACI&Oacute;N :
	                                        	</td>
	                                        	<td align="left">
	                                        		'.$res[19].'
	                                        	</td>
	                                        </tr>
                                        </table>
                                        <table width="100%">
                                          <tr>
                                        	<td width="18%" class="tablatit">
                                        		USUARIO QUE RADICA :
                                        	</td>
                                        	<td align="left">
                                        		'.$res[1].'
                                        	</td>
                                        	<td width="10%" class="tablatit">
                                        		AGENCIA :
                                        	</td>
                                        	<td align="left">
                                        		'.$res[2].'
                                        	</td>
                                          </tr>
                                        </table>
                                        <table width="100%">
                                          <tr>
                                        	<td width="13%" class="tablatit">
                                        		RESPONSABLE :
                                        	</td>
                                        	<td align="left">
                                        		<b>'.$res[6].'</b>
                                        	</td>
                                        	<td width="8%" class="tablatit">
                                        		LIDER :
                                        	</td>
                                        	<td align="left">
                                        		'.$res[7].'
                                        	</td>
                                          </tr>
                                        </table>
                                        <table width="100%">
                                          <tr>
                                        	<td width="8%" class="tablatit">
                                        		SISTEMA :
                                        	</td>
                                        	<td align="left" colspan=3>
                                        		 '.$res[9].'
                                        	</td>
                                          </tr>
                                          <tr>
                                        	<td width="9%" class="tablatit">
                                        		PROCESO :
                                        	</td>
                                        	<td align="left">
                                        		 '.$res[10].'
                                        	</td>
                                        	<td width="10%" class="tablatit">
                                        		ACTIVIDAD :
                                        	</td>
                                        	<td align="left"><b>'.$res[11].'</b></td>
                                          </tr>
                                          <tr>
                                          	<td colspan=6 class="tablatit" align="center">
                                          		<b>DESCRIPCI&Oacute;N DEL SOS</b>
                                          	</td>
                                          </tr>
                                          <tr>
                                          	<td colspan=6>
                                          		<div style="overflow-y:scroll;height:120px;text-align:justify; margin-left:10px;margin-right:10px;">'.$res[12].'</div>
                                          	</td>
                                          </tr>
                                        </table>
                                        
                                        <table width="100%">
                                          <tr>
                                        	<td width="27%" class="tablatit">
                                        		ULTIMA GESTI&Oacute;N REALIZADA POR : 
                                        	</td>
                                        	<td align="left" width="10%"><b>'.$res[13].'</b></td>
                                        	<td width="24%" class="tablatit">
                                        		FECHA DE LA ULTIMA GESTI&Oacute;N : 
                                        	</td>
                                        	<td align="left">'.$res[25].'</td>
                                          </tr>
                                          <tr>
                                        	<td colspan=4 class="tablatit" align="center">
                                        		<b>ULTIMA GESTI&Oacute;N</b>
                                        	</td>
                                          </tr>
                                          <tr>
                                        	<td colspan=4>
                                        		<div style="overflow-y:scroll;height:80px;text-align:justify; margin-left:10px;">'.$res[14].'
                                        		</div>
                                        	</td>
                                          </tr>
                                          <tr>
                                        	<td wisth="12%" class="tablatit">
                                        		ESTADO DEL SOS : 
                                        	</td>
                                        	<td align="left" colspan=2>
                                        		<b>'.$res[15].'</b>
                                        	</td>
                                          </tr>
                                        </table>
                                        <table width="100%">
                                          <tr>
                                            <td colspan=6  class="tablatit" align="center"><b>CALIFICACI&Oacute;N</b></td>
                                          </tr>
                                          <tr>
                                            <td width="12%" class="tablatit">CALIFICACI&Oacute;N :</td>
                                            <td width="20%"><b>'.$res[28].'</b></td>
                                            <td width="20%" class="tablatit">USUARIO QUE CALIFICA :</td>
                                            <td>'.$res[29].'</td>
                                            <td width="20%" class="tablatit">FECHA DE CALIFICACI&Oacute;N :</td>
                                            <td>'.$res[30].'</td>
                                          </tr>
                                          <tr>
                                            <td colspan=6 class="tablatit" align="center"><b>OBSERVACIONES DE LA CALIFICACI&Oacute;N</b></td>
                                          </tr>
                                          <tr>
                                            <td colspan=6>
                                              <div style="width:100%; overflow-y:scroll;height:80px;text-align:justify;margin-left:10px;margin-right:10px; ">
                                                '.$res[31].'
                                              </div>
                                            </td>
                                          </tr>
                                          
                                        </table>  
                                        <table width="100%">
                                          <tr>
                                        	<td colspan=2 class="tablatit" align="center">
                                        		<b>CLASIFICACI&Oacute;N PARA LOS INDICADORES</b>
                                        	</td>
                                          </tr>
                                          <tr>
                                        	<td width="21%" class="tablatit">
                                        		ORIGEN CLASIFICACI&Oacute;N :
                                        	</td>
                                        	<td align="left">
                                        		 '.$res[47].'
                                        	</td>
                                          </tr>
                                          
                                          <tr>
                                        	<td width="20%" class="tablatit">
                                        		ATENCI&Oacute;N :
                                        	</td>
                                        	<td align="left">
                                        		'.$select1.'
                                        	</td>
                                          </tr>
                                          <tr>
                                        	<td class="tablatit">TIPO DE CLASIFICACI&Oacute;N :</td>
                                        	<td align="left">'.$select2.'</td>
                                          </tr>
                                          <tr>
                                        	<td class="tablatit">
                                        		APLICACI&Oacute;N :
                                        	</td>
                                        	<td align="left">'.$select3.'</td>
                                          </tr>
                                          <tr>
                                        	<td class="tablatit">
                                        		CONTROLA :
                                        	</td>
                                        	<td align="left">'.$select4.'</td>
                                          </tr>
                                          <tr>
                                        	<td class="tablatit">
                                        		GESTI&Oacute;N REALIZADA POR :
                                        	</td>
                                        	<td align="left">
                                        		'.$select5.'
                                        	</td>
                                          </tr>
                                          <tr>
                                        	<td colspan=2 class="tablatit" align="center">
                                        		<button onclick="ActualizarClas('.$Anomes.')"  class="btn btn-info">Actualizar Informaci&oacute;n</button>
                                        	</td>
                                          </tr>
                                        </table>
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