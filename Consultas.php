<?php
require_once("connect.php");
global $conexion;
$Grafico = $_GET["Consulta"];
//$Anomes = $_GET["Anomes"];
//$Variable =$_GET["Variable"];
switch($Grafico){
	case '1':
		$Anomes = $_GET["Anomes"];
		$Query0 = "SELECT H.ANO_INI
    				 FROM INDICADORES_SOS H
                    WHERE H.ANOMES = '".$Anomes."'
                      AND H.ATENCION = 'Sistemas'
                 GROUP BY H.ANO_INI
                 ORDER BY 1 ASC";
		$query = $conexion->query($Query0);
		$nfilas0 = $query->num_rows;
		$Ano;
		$Valores=$nfilas0."%";
		$Valore="";
		for($i0=0;$i0<$nfilas0;$i0++){
			$Res1=$query->fetch_array();
			$Ano=$Res1[0];
			$Query2="
					SELECT T1.ESTADO_SOS, 
					       IFNULL(T2.TOTAL,0) 
					  FROM (  
  							SELECT H.ESTADO_SOS
    						  FROM INDICADORES_SOS H
   							 WHERE H.ANOMES = '".$Anomes."'
     						   AND H.ATENCION = 'Sistemas'
						  GROUP BY H.ESTADO_SOS) T1 
					LEFT JOIN (
   								SELECT H1.ESTADO_SOS, 
		  							   COUNT(*) AS Total
	 							  FROM INDICADORES_SOS H1
								 WHERE H1.ANOMES = '".$Anomes."'
      							   AND H1.ANO_INI = '".$Ano."'
      							   AND H1.ATENCION = 'Sistemas'	
 							  GROUP BY H1.ESTADO_SOS) T2 
					ON T1.ESTADO_SOS=T2.ESTADO_SOS";
			$query1 = $conexion->query($Query2);
			$nfilas1 = $query1->num_rows;
			$Estados="";
			$Valor=$Ano."@";
			for($i1=0;$i1<$nfilas1;$i1++){
				$Res1 = $query1->fetch_array();
				$Estados.= $Res1[0]."|";
				$Valor.= $Res1[1]."@";
			}
			
		$Valore.="".$Valor.";";
		}
		$Valores.=$nfilas1."%".$Estados."%".$Valore;
		echo $Valores;
		# code...
		break;
		case '2':
			$Anomes = $_GET["Anomes"];
			$Variable =$_GET["Variable"];
			$Query0 = "SELECT H.ANO_INI
    				     FROM INDICADORES_SOS H
                        WHERE H.ANOMES = '".$Anomes."'
                          AND H.ATENCION = 'Sistemas'
                          AND H.SUBCLAS_APLIC = '".$Variable."'
                     GROUP BY H.ANO_INI
                     ORDER BY 1 ASC";
			$query = $conexion->query($Query0);
			$nfilas0 = $query->num_rows;
			$Ano;
			$Valores=$nfilas0."%";
			$Valore="";
			$Estados="";
			$nfilas1=0;
			for($i0=0;$i0<$nfilas0;$i0++){
				$Res1=$query->fetch_array();
				$Ano=$Res1[0];
				$Query2="
						SELECT T1.ESTADO_SOS, 
						       IFNULL(T2.TOTAL,0) 
						  FROM (  
	  							SELECT H.ESTADO_SOS
	    						  FROM INDICADORES_SOS H
	   							 WHERE H.ANOMES = '".$Anomes."'
	     						   AND H.ATENCION = 'Sistemas'
	     						   AND H.SUBCLAS_APLIC = '".$Variable."' 
							  GROUP BY H.ESTADO_SOS) T1 
						LEFT JOIN (
	   								SELECT H1.ESTADO_SOS, 
			  							   COUNT(*) AS Total
		 							  FROM INDICADORES_SOS H1
									 WHERE H1.ANOMES = '".$Anomes."'
	      							   AND H1.ANO_INI = '".$Ano."'
	      							   AND H1.ATENCION = 'Sistemas'
	      							   AND H1.SUBCLAS_APLIC = '".$Variable."'
	 							  GROUP BY H1.ESTADO_SOS) T2 
						ON T1.ESTADO_SOS=T2.ESTADO_SOS
						ORDER BY 1 ASC";
				$query1 = $conexion->query($Query2);
				$nfilas1 = $query1->num_rows;
				//echo $nfilas1.";<br><br>";
				$Estados="";
				$Valor=$Ano."@";
				for($i1=0;$i1<$nfilas1;$i1++){
					$Res1 = $query1->fetch_array();
					$Estados.= $Res1[0]."|";
					$Valor.= $Res1[1]."@";					
				}
				
			$Valore.="".$Valor.";";
			
			}
			$Valores.=$nfilas1."%".$Estados."%".$Valore;
			echo $Valores;
		break;
		case '3':
			$Anomes = $_GET["Anomes"];
			$Variable =$_GET["Variable"];
			if($Variable!=""){
				$Variable="AND S.CONTROLA = '".$Variable."'";
			}else{
				$Variable=$Variable;
			}
			$Query0 = "SELECT S.CALIFICACION, count(*) as Total
  						 FROM INDICADORES_SOS S 
 						WHERE S.ANOMES = '".$Anomes."' 
   						  AND S.ATENCION = 'Sistemas'
   						  AND S.ESTADO_SOS = 'Terminado'
   						   ".$Variable."
   					 GROUP BY S.CALIFICACION";
			$query = $conexion->query($Query0);
			$nfilas0 = $query->num_rows;
			$Calif="";
			$Valor="";
			for($i1=0;$i1<$nfilas0;$i1++){
					$Res1 = $query->fetch_array();
					$Calif.= $Res1[0]."|";
					$Valor.= $Res1[1]."@";
				}
				$Valores=$nfilas0.";".$Calif.";".$Valor;
			echo $Valores;
		break;
		case '4':
			$Anomes = $_GET["Anomes"];
			$Variable =$_GET["Variable"];
			$especial="";
			switch ($Variable) {
				case 'PROCESO':
					$especial="AND H.CALIFICACION IN ('Aceptable',
													  'Insatisfactorio',
													  'Muy Insatisfactorio')";
				break;
				case 'CONTROLA':
					$especial="";
				default:
					# code...
				break;
			}
			$Query0 = "SELECT H.CALIFICACION
    				     FROM INDICADORES_SOS H, TIPOS_CALIFICACION C
                        WHERE H.ANOMES = '".$Anomes."'
                          AND H.ATENCION = 'Sistemas'
                          AND H.ESTADO_SOS = 'Terminado'
                          AND H.CALIFICACION = C.DESCRIPCION
                          ".$especial."
                     GROUP BY H.CALIFICACION
                     ORDER BY C.ID_CALIF ASC";
   		   	$query = $conexion->query($Query0);
			$nfilas0 = $query->num_rows;
			$Valores = $nfilas0."%";
			$Valore = "";
			for($i0=0;$i0<$nfilas0;$i0++){
				$Res1 = $query->fetch_array();
				$Process = $Res1[0];
				$Query2 = "SELECT T1.".$Variable.", 
						       IFNULL(T2.TOTAL,0) 
						  FROM (  
	  							SELECT H.".$Variable."
	    						  FROM INDICADORES_SOS H
	   							 WHERE H.ANOMES = '".$Anomes."'
	     						   AND H.ATENCION = 'Sistemas'
	     						   AND H.ESTADO_SOS = 'Terminado'
                                   ".$especial."
							  GROUP BY H.".$Variable.") T1 
						LEFT JOIN (
	   								SELECT H1.".$Variable.", 
			  							   COUNT(*) AS Total
		 							  FROM INDICADORES_SOS H1
									 WHERE H1.ANOMES = '".$Anomes."'
	      							   AND H1.CALIFICACION = '".$Process."'
	      							   AND H1.ATENCION = 'Sistemas'
                                       AND H1.ESTADO_SOS = 'Terminado'
	 							  GROUP BY H1.".$Variable.") T2 
						ON T1.".$Variable."=T2.".$Variable."
						ORDER BY 1 ASC";	
			$query1 = $conexion->query($Query2);
				$nfilas1 = $query1->num_rows;
				$Estados="";
				$Valor=$Process."@";
				for($i1=0;$i1<$nfilas1;$i1++){
					$Res1 = $query1->fetch_array();
					$Estados.= $Res1[0]."|";
					$Valor.= $Res1[1]."@";
				}
				
			$Valore.="".$Valor.";";
			}
			$Valores.=$nfilas1."%".$Estados."%".$Valore;
			echo $Valores;
		break;
		case '5':
			$Anomes = $_GET["Anomes"];
			$Query0 = "SELECT H.SOS,
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
							  H.OBSERVACION
    				     FROM INDICADORES_SOS H
                        WHERE H.ANOMES = '".$Anomes."'
                          AND H.ATENCION = 'Sistemas'
                          AND H.ESTADO_SOS = 'Terminado'
                          AND H.CALIFICACION IN ('Aceptable',
											     'Insatisfactorio',
												 'Muy Insatisfactorio')
                     ORDER BY 1 ASC";
   		   	$query = $conexion->query($Query0);
			$nfilas0 = $query->num_rows;
			$tabla ='<table class="table" >
                     	<thead>
                        	<tr>
                        		<th>No.</th>
                            	<th># SOS</th>
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
							<td><a href="detalle_sos.php?Sos='.$res[0].'&Anomes='.$Anomes.'">'.$res[0].'</td>
							<td>'.$res[1]."</td>
							<td>".$res[2]."</td>
							<td>".$res[3]."</td>
							<td>".$res[4].'</td>
							<td align="justify">'.$res[5]."</td>
							<td>".$res[6]."</td>
							<td>".$res[7]."</td>
							<td>".$res[8]."</td>
							<td>".$res[9]."</td>
							<td>".$res[10]."</td>
							<td>".$res[11]."</td>
						</tr>";
			}
			$tabla.="</tbody>
			</table>";
			echo $tabla;
		break;
		case '6':
		  $Anomes=$_GET['Anomes'];
		  $SOS=$_GET['SOS'];
		  $Atencion=$_GET['Atencion'];
		  $Clasif=$_GET['Clasif'];
		  $Aplica=$_GET['Aplica'];
		  $Control=$_GET['Control'];
		  $Gestion=$_GET['Gestion'];
		  $Query ="UPDATE INDICADORES_SOS S 
		  			  SET S.ATENCION = '".$Atencion."',
		  			  	  S.SUBCLAS = '".$Clasif."',
		  			  	  S.SUBCLAS_APLIC = '".$Aplica."',
		  			  	  S.CONTROLA = '".$Control."',
		  			  	  S.GESTION_SISTEMAS = '".$Gestion."',
		  			  	  S.FLAG = 'CM'
		  			WHERE S.ANOMES = '".$Anomes."'
		  			  AND S.SOS = ".$SOS;
		   $query = $conexion->query($Query);
		   			
		  echo $query;
		break;
		case '7':
			$corte=$_GET["corte"];
			$Indicador=['Totales','Area - Sin Desarrollos','Solo Desarrollos','Software','Infraestructura','Perfiles'];
			$Cortes=[];
			$Valor="";
			for($i=0;$i<6;$i++){
				$Indi=$Indicador[$i];
				$Query0 = "
						SELECT * FROM (
						SELECT r.Anomes,
       						  round((Remitido+Anulado+Terminado)/(Total_sos*0.95)*100,2) as Porcentaje
  						 FROM indicadores_resumen r 
 						WHERE r.Concepto='".$Indi."'
 						  AND r.Anomes<='".$corte."'
 					 ORDER BY 1 DESC limit 13) P ORDER BY 1 ASC";
   		   		$query = $conexion->query($Query0);
				$nfilas0 = $query->num_rows;
				$Cortes="";
				$Valor.=$Indi.";";
				for($j=0;$j<$nfilas0;$j++){
					$res=$query->fetch_array();
					$Cortes.=$res[0].";";
					$Valor.=$res[1].";";
				}
				$Valor.="@";
			}
			echo $nfilas0."|".$Cortes."|".$Valor;
		break;
		case '8':
			$id=$_GET['id'];
			if($id==0){

			}else{
				$Query0 = "SELECT *
  						     FROM indicadores_parametros p
 						    WHERE p.id=".$id;
	   		   	$query = $conexion->query($Query0);
	   		   	$fil=$query->num_rows;
	   		   	if($fil>0){
	   		   		$res=$query->fetch_array();
	   		   		$cadena = "<b>".str_replace('_',' ',$res[1])."</b> &nbsp;";
					$cadena.= '<input type="text" id="var" value="'.$res[2].'" 			style="padding-left:10px;">&nbsp;
							   <button onclick="ActualizaPara('.$id.')"  class="btn btn-info">Actualizar</button>';
				}else{

	   		   	}
   		   		
			}
			echo $cadena;
		break;
		case '9':
			$id = $_GET['id'];
			$var= $_GET['val'];
			$Query0 = "UPDATE indicadores_parametros p
 						  SET p.Valor='".$var."'
 				        WHERE p.id=".$id;
   		   	$query = $conexion->query($Query0);
   		   	echo $query;
		break;
		case '10':
			$corte=$_GET['corte'];
			$cadena="<b>Inicia proceso de Generaci&oacute;n de Tabla de Resumen Corte ".$corte."<br>
			<ol>
			";
			$cadena.="<li><>&nbsp;Se Ejecuta el Proceso de Eliminar Datos del Corte<li>";
			$Query0 = "DELETE FROM indicadores_resumen WHERE anomes='".$corte."'";
   		   	$query = $conexion->query($Query0);
   		   	$resp1="";
   		   	if($query==1){
   		   		$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
   		   	}else{
   		   		$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query;
   		   	}
			$cadena.="<li><>&nbsp;Se Ejecuta el Proceso de Inserción de Conceptos del Corte <li>";
			$Conceptos =['Area - Sin Desarrollos','Solo Desarrollos','Totales','Software','Infraestructura','Perfiles'];
			$acum=0;
			for($i=0;$i<6;$i++){
				$Query1="INSERT INTO INDICADORES_RESUMEN values('".$corte."','".$Conceptos[$i]."',0,0,0,0,0,0,0)";
				$query1 = $conexion->query($Query1);
				$acum++;
			}
			if($acum==6){
   		   		$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
   		   	}else{
   		   		$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
   		   	}
			$cadena.="<li>-----Se Calculan los Valores del Concepto Totales-----
					 <ol>";
			$Query1="UPDATE indicadores_resumen 
			            SET Total_sos=(SELECT count(*) as Total/*TOTAL SOS*/
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Totales';";
			$cadena.="<li>Calculado Campo Totales</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Soporte_Inicial=(SELECT count(*) as Total/*TOTAL SOS*/
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									    AND s.Anomes_ini<>'".$corte."'
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Totales';";
			$cadena.="<li>Calculado Campo Soporte Inicial</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}	
			$Query1="UPDATE indicadores_resumen 
			            SET Ingreso_Mes=(SELECT count(*) as Total/*TOTAL SOS*/
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									    AND s.Anomes_ini='".$corte."'
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Totales';";
			$cadena.="<li>Calculado Campo Ingreso Mes</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Remitido=(SELECT count(*) as Total/*TOTAL SOS*/
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									     AND s.estado_sos in('Remitido','Remitido proveedor','Remitido usuario')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Totales';";
			$cadena.="<li>Calculado Campo Remitido</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Anulado=(SELECT count(*) as Total/*TOTAL SOS*/
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									     AND s.estado_sos in('Anulado','Anular')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Totales';";
			$cadena.="<li>Calculado Campo Anulado</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}			
			$Query1="UPDATE indicadores_resumen 
			            SET Terminado=(SELECT count(*) as Total/*TOTAL SOS*/
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									     AND s.estado_sos in('Terminado','Terminado Sin Calificar')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Totales';";
			$cadena.="<li>Calculado Campo Terminados</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Pendiente=(SELECT count(*) as Total/*TOTAL SOS*/
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									     AND s.estado_sos in('Ejecución','Pendiente','Solución','Atención','Análisis')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Totales';";
			$cadena.="<li>Calculado Campo Pendientes</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}				
							
			$cadena.="</ol>
			</li>";
/*INICIA*********************************************************/
			$cadena.="<li>------Se Calculan los Valores del Concepto &Aacute;rea - Sin Desarrollos-----
					 <ol>";
			$Query1="UPDATE indicadores_resumen 
			            SET Total_sos=(SELECT count(*) as Total/*TOTAL SOS*/
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									     AND s.subclas<>'Desarrollo' 
									     AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Area - Sin Desarrollos';";
			$cadena.="<li>Calculado Campo Totales</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Soporte_Inicial=(SELECT count(*) as Total/*TOTAL SOS*/
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									    AND s.Anomes_ini<>'".$corte."'
									    AND s.subclas<>'Desarrollo' 
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Area - Sin Desarrollos';";
			$cadena.="<li>Calculado Campo Soporte Inicial</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}	
			$Query1="UPDATE indicadores_resumen 
			            SET Ingreso_Mes=(SELECT count(*) as Total/*TOTAL SOS*/
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									    AND s.Anomes_ini='".$corte."'
									    AND s.subclas<>'Desarrollo' 
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Area - Sin Desarrollos';";
			$cadena.="<li>Calculado Campo Ingreso Mes</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Remitido=(SELECT count(*) as Total/*TOTAL SOS*/
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									     AND s.subclas<>'Desarrollo'  
									     AND s.estado_sos in('Remitido','Remitido proveedor','Remitido usuario')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Area - Sin Desarrollos';";
			$cadena.="<li>Calculado Campo Remitido</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Anulado=(SELECT count(*) as Total/*TOTAL SOS*/
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									   	 AND s.subclas<>'Desarrollo'  
									     AND s.estado_sos in('Anulado','Anular')
									     AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Area - Sin Desarrollos';";
			$cadena.="<li>Calculado Campo Anulado</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}			
			$Query1="UPDATE indicadores_resumen 
			            SET Terminado=(SELECT count(*) as Total/*TOTAL SOS*/
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									     AND s.subclas<>'Desarrollo'  
									     AND s.estado_sos in('Terminado','Terminado Sin Calificar')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Area - Sin Desarrollos';";
			$cadena.="<li>Calculado Campo Terminados</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}				
			$Query1="UPDATE indicadores_resumen 
			            SET Pendiente=(SELECT count(*) as Total/*TOTAL SOS*/
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									   	 AND s.subclas<>'Desarrollo'  
									     AND s.estado_sos in('Ejecución','Pendiente','Solución','Análisis','Atención')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Area - Sin Desarrollos';";
			$cadena.="<li>Calculado Campo Pendientes</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$cadena.="</ol>
			</li>";				
			/*TERMINA*/
/*INICIA*********************************************************/
			$cadena.="<li>-----Se Calculan los Valores del Concepto S&oacute;lo Desarrollos-----
					 <ol>";
			$Query1="UPDATE indicadores_resumen 
			            SET Total_sos=(SELECT count(*) as Total/*TOTAL SOS*/
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									     AND s.subclas='Desarrollo' 
									     AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Solo Desarrollos';";
			$cadena.="<li>Calculado Campo Totales</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Soporte_Inicial=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									    AND s.Anomes_ini<>'".$corte."'
									    AND s.subclas='Desarrollo' 
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Solo Desarrollos';";
			$cadena.="<li>Calculado Campo Soporte Inicial</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Ingreso_Mes=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									    AND s.Anomes_ini='".$corte."'
									    AND s.subclas='Desarrollo' 
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Solo Desarrollos';";
			$cadena.="<li>Calculado Campo Ingreso Mes</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Remitido=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									     AND s.subclas='Desarrollo'  
									     AND s.estado_sos in('Remitido','Remitido proveedor','Remitido usuario')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Solo Desarrollos';";
			$cadena.="<li>Calculado Campo Remitido</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Anulado=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									   	 AND s.subclas='Desarrollo'  
									     AND s.estado_sos in('Anulado','Anular')
									     AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Solo Desarrollos';";
			$cadena.="<li>Calculado Campo Anulado</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}			
			$Query1="UPDATE indicadores_resumen 
			            SET Terminado=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									     AND s.subclas='Desarrollo'  
									     AND s.estado_sos in('Terminado','Terminado Sin Calificar')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Solo Desarrollos';";
			$cadena.="<li>Calculado Campo Terminados</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}				
			$Query1="UPDATE indicadores_resumen 
			            SET Pendiente=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									   	 AND s.subclas='Desarrollo'  
									     AND s.estado_sos in('Ejecución','Pendiente','Solución','Análisis','Atención')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Solo Desarrollos';";
			$cadena.="<li>Calculado Campo Pendientes</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$cadena.="</ol>
			</li>";				
			/*TERMINA*/
/*INICIA*********************************************************/
			$cadena.="<li>-----Se Calculan los Valores del Concepto Software-----
					 <ol>";
			$Query1="UPDATE indicadores_resumen 
			            SET Total_sos=(SELECT count(*) as Total/*TOTAL SOS*/
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									     and s.Controla='Software' 
									     AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Software';";
			$cadena.="<li>Calculado Campo Totales</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Soporte_Inicial=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									    AND s.Anomes_ini<>'".$corte."'
									    and s.Controla='Software' 
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Software';";
			$cadena.="<li>Calculado Campo Soporte Inicial</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Ingreso_Mes=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									    AND s.Anomes_ini='".$corte."'
									    and s.Controla='Software' 
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Software';";
			$cadena.="<li>Calculado Campo Ingreso Mes</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Remitido=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									     and s.Controla='Software'  
									     AND s.estado_sos in('Remitido','Remitido proveedor','Remitido usuario')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Software';";
			$cadena.="<li>Calculado Campo Remitido</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Anulado=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									   	 and s.Controla='Software'  
									     AND s.estado_sos in('Anulado','Anular')
									     AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Software';";
			$cadena.="<li>Calculado Campo Anulado</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}			
			$Query1="UPDATE indicadores_resumen 
			            SET Terminado=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									     and s.Controla='Software'  
									     AND s.estado_sos in('Terminado','Terminado Sin Calificar')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Software';";
			$cadena.="<li>Calculado Campo Terminados</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}				
			$Query1="UPDATE indicadores_resumen 
			            SET Pendiente=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									   	 and s.Controla='Software'  
									     AND s.estado_sos in('Ejecución','Pendiente','Solución','Análisis','Atención')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Software';";
			$cadena.="<li>Calculado Campo Pendientes</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$cadena.="</ol>
			</li>";				
			/*TERMINA*/
/*INICIA*********************************************************/
			$cadena.="<li>-----Se Calculan los Valores del Concepto Infraestructura-----
					 <ol>";
			$Query1="UPDATE indicadores_resumen 
			            SET Total_sos=(SELECT count(*) as Total/*TOTAL SOS*/
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									     and s.Controla='Infraestructura' 
									     AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Infraestructura';";
			$cadena.="<li>Calculado Campo Totales</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Soporte_Inicial=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									    AND s.Anomes_ini<>'".$corte."'
									    and s.Controla='Infraestructura' 
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Infraestructura';";
			$cadena.="<li>Calculado Campo Soporte Inicial</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Ingreso_Mes=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									    AND s.Anomes_ini='".$corte."'
									    and s.Controla='Infraestructura' 
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Infraestructura';";
			$cadena.="<li>Calculado Campo Ingreso Mes</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Remitido=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									     and s.Controla='Infraestructura'  
									     AND s.estado_sos in('Remitido','Remitido proveedor','Remitido usuario')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Infraestructura';";
			$cadena.="<li>Calculado Campo Remitido</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Anulado=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									   	 and s.Controla='Infraestructura'  
									     AND s.estado_sos in('Anulado','Anular')
									     AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Infraestructura';";
			$cadena.="<li>Calculado Campo Anulado</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}			
			$Query1="UPDATE indicadores_resumen 
			            SET Terminado=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									     and s.Controla='Infraestructura'  
									     AND s.estado_sos in('Terminado','Terminado Sin Calificar')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Infraestructura';";
			$cadena.="<li>Calculado Campo Terminados</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}				
			$Query1="UPDATE indicadores_resumen 
			            SET Pendiente=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									   	 and s.Controla='Infraestructura'  
									     AND s.estado_sos in('Ejecución','Pendiente','Solución','Análisis','Atención')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Infraestructura';";
			$cadena.="<li>Calculado Campo Pendientes</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$cadena.="</ol>
			</li>";				
			/*TERMINA*/
/*INICIA*********************************************************/
			$cadena.="<li>-----Se Calculan los Valores del Concepto Perfiles-----
					 <ol>";
			$Query1="UPDATE indicadores_resumen 
			            SET Total_sos=(SELECT count(*) as Total/*TOTAL SOS*/
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									     and s.Controla='Perfiles' 
									     AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Perfiles';";
			$cadena.="<li>Calculado Campo Totales</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Soporte_Inicial=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									    AND s.Anomes_ini<>'".$corte."'
									    and s.Controla='Perfiles' 
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Perfiles';";
			$cadena.="<li>Calculado Campo Soporte Inicial</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Ingreso_Mes=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									    AND s.Anomes_ini='".$corte."'
									    and s.Controla='Perfiles' 
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Perfiles';";
			$cadena.="<li>Calculado Campo Ingreso Mes</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Remitido=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									     and s.Controla='Perfiles'  
									     AND s.estado_sos in('Remitido','Remitido proveedor','Remitido usuario')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Perfiles';";
			$cadena.="<li>Calculado Campo Remitido</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$Query1="UPDATE indicadores_resumen 
			            SET Anulado=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									   	 and s.Controla='Perfiles'  
									     AND s.estado_sos in('Anulado','Anular')
									     AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Perfiles';";
			$cadena.="<li>Calculado Campo Anulado</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}			
			$Query1="UPDATE indicadores_resumen 
			            SET Terminado=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."'
									     and s.Controla='Perfiles'  
									     AND s.estado_sos in('Terminado','Terminado Sin Calificar')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Perfiles';";
			$cadena.="<li>Calculado Campo Terminados</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}				
			$Query1="UPDATE indicadores_resumen 
			            SET Pendiente=(SELECT count(*) as Total
									    FROM indicadores_sos s 
									   WHERE s.anomes='".$corte."' 
									   	 and s.Controla='Perfiles'  
									     AND s.estado_sos in('Ejecución','Pendiente','Solución','Análisis','Atención')
									    AND s.ATENCION='Sistemas'
									   )
					   WHERE Anomes='".$corte."'
					 	 AND Concepto='Perfiles';";
			$cadena.="<li>Calculado Campo Pendientes</li>";
			$query1 = $conexion->query($Query1);
			if($query1==1){
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Proceso Ejecutado Satisfactoriamente";
			}else{
				$cadena.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;Ocurrio un Error: ".$query1;
			}
			$cadena.="</ol>
			</li>";				
			/*TERMINA*/
			$cadena.="</ol>";
			echo $cadena;
		break;
}
?>