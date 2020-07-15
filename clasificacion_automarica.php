<?php
include("head.php");
global $conexion;
date_default_timezone_set('UTC');
$fechaAr = date("dmY");
$sql = "SELECT Valor 
          FROM INDICADORES_PARAMETROS 
         WHERE Variable='Corte_Sistema'";
$query = $conexion->query($sql);
$result = $query->fetch_assoc();

$corte = $result["Valor"];
$SQL="SELECT CONCAT('UPDATE INDICADORES_SOS 
                        SET Atencion=%Operaciones%, 
                        	Subclas=%Soporte%, 
                        	subclas_Aplic=%SBI%, 
                        	Controla=%-%, 
                        	Estado_Anterior=%Nuevo%, 
                        	Gestion_Sistemas=%Operaciones%, 
                        	FLAG=%AN1% 
                      WHERE SOS=', sos,' 
                        AND ANOMES = %".$corte."%;')
		FROM INDICADORES_SOS
	   WHERE ANOMES = '".$corte."' 
	     AND ATENCION = '-'
         AND SISTEMA = 'Gestión de Servicios y Operaciones'
         AND PROCESO IN ('SBI-Cdats', 
          				 'SBI-Ahorro Programado PAP',
         				 'SBI-Cuenta de ahorros', 
         				 'SBI-Convenios',
        				 'Ahorro',
        				 'Canales transaccionales',
                 'SBI-Facturación')
      UNION 
      SELECT CONCAT('UPDATE INDICADORES_SOS 
                        SET Atencion=%Operaciones%, 
                            Subclas=%Soporte%, 
                            subclas_Aplic=%SBI%, 
                            Controla=%-%, 
                            Estado_Anterior=%Nuevo%, 
                            Gestion_Sistemas=%Operaciones%, 
                            FLAG=%AN2% 
                      WHERE SOS=',sos,' 
                        AND ANOMES = %".$corte."%;')
	   FROM INDICADORES_SOS
	  WHERE ANOMES = '".$corte."' 
	    AND ATENCION = '-'
        AND SISTEMA = 'Gestión de Servicios y Operaciones'
        AND PROCESO = 'Novedades de Asociados'
        AND ACTIVIDAD IN ('Actualización de datos de asociados')
      UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
      						  SET Atencion=%Operaciones%, 
      						      Subclas=%Soporte%, 
      						      subclas_Aplic=%SBI%, 
      						      Controla=%-%, 
      						      Estado_Anterior=%Nuevo%, 
      						      Gestion_Sistemas=%Operaciones%, 
      						      FLAG=%AN3% 
      						WHERE SOS=',sos,' 
      						  AND ANOMES = %".$corte."%;')
			FROM INDICADORES_SOS 
		   WHERE ANOMES = '".$corte."' 
		     AND ATENCION = '-'
		     AND SISTEMA = 'Gestión de Servicios y Operaciones'
        	 AND PROCESO = 'Novedades de Asociados'
        	 AND ACTIVIDAD IN ('Vinculación de asociados', 
        	 					'Estatutarios - Revisión y/o modificación cuota de aportes',
        	 					'Exceso de Liquidación - Devolución a Exasociados',
        						'Devolución de Saldos Contables',
						        'Revisión y/o Corrección de Movimiento Contable',
						        'Credito - Corrección de Movimientos',
						        'Excesos Normales - Aplicar exceso a producto',
						        'Reclamaciones asociados por Incapacidad total y/o asociados fallecidos',
						        'Cambio de identificación',
						        'Estatutarios - Revisión Movimientos (Aportes, Ahorro Fijo, Fondo)',
						        'Estatutarios - Revisión y/o corrección tope de aportes',
						        'Facturación - Corrección de Movimientos',
						        'Ahorro Programado PAP - Corrección de Movimientos',
						        'Cambio de Nombre',
						        'Estatutarios - Corrección de Movimientos',
						        'Excesos Normales - Revisión y/o Corrección de Movimientos',
						        'Liquidacion normal de asociados',
						        'Cambio de corte',
						        'Cuenta de Ahorros - Corrección de Movimientos',
						        'Liquidacion por fallecimiento de asociados',
						        'Estatutarios - Corrección de Movimientos',
						        'Traslado de agencia',
						        'Exceso de Liquidación - Aplicar Excliq al Credito',
						        'Auxilios de Solidaridad - Corrección de Movimientos',
						        'Revisión y/o corrección de revalorización de aportes',
                    'Coincidencia en listas restrictivas y PEP')
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
		                        SET Atencion=%Bienestar Social%, 
		                            Subclas=%No clasificado%, 
		                            subclas_Aplic=%No clasificado%, 
		                            Controla=%Bienestar Social%, 
		                            Gestion_Sistemas=%Bienestar Social%, 
		                            FLAG=%AN4% 
		                      WHERE SOS=',sos,' 
		                        AND ANOMES = %".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
        		 AND SISTEMA = 'Bienestar Social'
        		 AND PROCESO in ('Auxilios de Solidaridad','Beneficios sociales','Educación Solidaria','Deportes, recreación y turismo')
        		 AND ACTIVIDAD IN ('Revisión de Comité de Solidaridad','Patrocinios','Convenios','Paquetes turísticos')
       	UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
       	                        SET Atencion=%Financiera%, 
       	                            Subclas=%No Clasificado%, 
       	                            subclas_Aplic=%No Clasificado%, 
       	                            Controla=%No Clasificado%, 
       	                            Estado_Anterior=%Nuevo%,
       	                            Gestion_Sistemas=%Financiera%, 
       	                            FLAG=%AN5% 
       	                      WHERE SOS=',sos,' 
       	                        AND ANOMES = %".$corte."%;')
			    FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."'
        	     AND ATENCION = '-'
        	     AND SISTEMA = 'Administración Financiera' 
        	     AND ACTIVIDAD = 'Mantenimiento de parámetros'
       	UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
       							SET Atencion=%Financiera%, 
       								Subclas=%No Clasificado%, 
       								subclas_Aplic=%No Clasificado%, 
       								Controla=%-%, 
       								Estado_Anterior=%Nuevo%, 
       								Gestion_Sistemas=%Financiera%, 
       								FLAG=%AN6% 
       						  WHERE SOS=',sos,' 
       						    AND ANOMES = %".$corte."%;')
			    FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."'
        		 AND ATENCION = '-'
        		 AND SISTEMA = 'Administración Financiera' 
        	     AND ACTIVIDAD = 'Creacion de terceros'
       	UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
       						    SET Atencion=%Financiera%, 
       						    	Subclas=%No Clasificado%, 
       						    	subclas_Aplic=%No Clasificado%, 
       						    	Controla=%-%, 
       						    	Estado_Anterior=%Nuevo%, 
       						    	Gestion_Sistemas=%Financiera%, 
       						    	FLAG=%AN7% 
       						  WHERE SOS=',sos,' 
       						    AND ANOMES = %".$corte."%;')
			    FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."'
        		 AND ATENCION = '-'
        		 AND SISTEMA = 'Administración Financiera' 
        		 AND ACTIVIDAD = 'Corrección a transacción mal aplicada'
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET Atencion=%Financiera%, 
								    Subclas=%No Clasificado%, 
								    subclas_Aplic=%No Clasificado%, 
								    Controla=%-%, 
								    Estado_Anterior=%Nuevo%, 
								    Gestion_Sistemas=%Financiera%, 
								    FLAG=%AN8% 
							  WHERE SOS=',sos,' 
							    AND ANOMES = %".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."'
        		 AND ATENCION = '-'
        		 AND SISTEMA = 'Administración Financiera' 
        		 AND ACTIVIDAD in('Reintegro actividades sociales',
        		 				  'Subsidios de educación superior',
                      'Anulación documentos contables')
        UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
        					    SET Atencion=%Financiera%, 
        					        Subclas=%No Clasificado%, 
        					        subclas_Aplic=%No Clasificado%, 
        					        Controla=%-%, 
        					        Estado_Anterior=%Nuevo%,
        					        Gestion_Sistemas=%Financiera%, 
        					        FLAG=%AN9% 
        					  WHERE SOS=',sos,' 
        					    AND ANOMES = %".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."'
        		 AND ATENCION = '-'
        		 AND SISTEMA = 'Administración Financiera' 
			     AND ACTIVIDAD = 'Revisión y/o corrección de movimientos'
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET Atencion=%Riesgos%, 
								    Subclas=%No Clasificado%, 
								    subclas_Aplic=%No Clasificado%, 
								    Controla=%-%, 
								    Estado_Anterior=%Nuevo%, 
								    Gestion_Sistemas=%Riesgos%, 
								    FLAG=%AN10% 
							  WHERE SOS=',sos,' 
							    AND ANOMES = %".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
        		 AND SISTEMA = 'Gestión del Riesgo' 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
		                        SET Atencion=%Mercadeo%, 
		                        	Subclas=%Soporte%, 
		                        	subclas_Aplic=%SBI%, 
		                        	Controla=%-%, 
		                        	Estado_Anterior=%Nuevo%, 
		                        	Gestion_Sistemas=%Mercadeo%, 
		                        	FLAG=%AN11% 
		                      WHERE SOS=',sos,' 
		                        AND ANOMES = %".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."'
        		 AND ATENCION = '-'
        		 AND SISTEMA = 'Gestión Comercial y Mercadeo' 
        		 AND ACTIVIDAD IN ('Revision de Correspondencia', 
        		                   'Inquietudes de campaña','SQR centro de contacto telefónico',
                               'Adecuacion carnet corporativo')
       	UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
       							SET Atencion=%Crédito y Cartera%, 
       								Subclas=%-%, 
       								subclas_Aplic=%-%, 
       								Controla=%-%, 
       								Gestion_Sistemas=%Crédito y Cartera%, 
       								FLAG=%AN12% 
       						  WHERE SOS=',sos,' 
       						    AND ANOMES = %".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
        		 AND SISTEMA = 'Administración de Cartera'
        		 AND PROCESO = 'Nomina'
        		 AND ACTIVIDAD IN ('Marcación y desmarcación' , 
        		 				   'Revisión del reporte al pagador',
        		 				   'Revisión y/o corrección de aplicación de pago asociado',
                       'Excede capacidad de descuento por nómina') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET Atencion=%Financiera%, 
									Subclas=%-%, 
									subclas_Aplic=%-%, 
									Controla=%-%, 
									Gestion_Sistemas=%Financiera%, 
									FLAG=%AN13% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
        		 AND SISTEMA = 'Administración Financiera'
        		 AND PROCESO = 'Polizas'
        		 AND ACTIVIDAD IN ('Revision, devolucion de polizas ','Novedades de ingreso y retiros funcionarios'
             )
       	UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
       							SET Atencion=%Crédito y Cartera%, 
       							    Subclas=%-%, 
       							    subclas_Aplic=%-%, 
       							    Controla=%-%, 
       							    Gestion_Sistemas=%Crédito y Cartera%, 
       							    FLAG=%AN14% 
       						  WHERE SOS=',sos,' 
       						    AND ANOMES = %".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
			     AND SISTEMA = 'Credito'
        		 AND PROCESO = 'Credito'
        		 AND ACTIVIDAD IN ('Anular radicación',
        		 				   'Inquietudes del credito   ',
        						   'Inconformidad por aprobacion de credito') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET Atencion=%Administrativa%, 
									Subclas=%-%, 
									subclas_Aplic=%-%, 
									Controla=%-%, 
									Gestion_Sistemas=%Administrativa%, 
									FLAG=%AN15% 
							  WHERE SOS=',sos,' 
							    AND ANOMES = %".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			    AND ATENCION = '-'
        		AND SISTEMA = 'Gestión Humana'
        		AND PROCESO = 'Novedades de Personal'
        		AND ACTIVIDAD IN ('Servicio Chapinero', 
        						  'Servicio Zarzal',
        						  'Servicio Palmira',
                      'Control de acceso Biostar2')
  UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
                    SET Atencion=%Crédito y Cartera%, 
                        Subclas=%-%, 
                        subclas_Aplic=%-%, 
                        Controla=%-%, 
                        Gestion_Sistemas=%Crédito y Cartera%, 
                        FLAG=%AN15% 
                    WHERE SOS=',sos,' 
                      AND ANOMES = %".$corte."%;')
        FROM INDICADORES_SOS
         WHERE ANOMES = '".$corte."' 
           AND ATENCION = '-'
           AND SISTEMA = 'Credito'
           AND PROCESO = 'Fabrica Asignación'
           AND ACTIVIDAD IN ('Analista Diez',
                       'Aprendiz crédito'
                       ) 
  UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
                    SET Atencion=%Financiera%, 
                        Subclas=%No Clasificado%, 
                        subclas_Aplic=%No Clasificado%, 
                        Controla=%No Clasificado%, 
                        Estado_Anterior=%Nuevo%,
                        Gestion_Sistemas=%Financiera%, 
                        FLAG=%AN16% 
                    WHERE SOS=',sos,' 
                      AND ANOMES = %".$corte."%;')
        FROM INDICADORES_SOS
         WHERE ANOMES = '".$corte."' 
           AND ATENCION = '-'
           AND SISTEMA = 'Administración Financiera'
           AND PROCESO in ('Consignaciones a bancos','Caja')
  UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
                    SET Atencion=%Administrativa%, 
                        Subclas=%No Clasificado%, 
                        subclas_Aplic=%No Clasificado%, 
                        Controla=%No Clasificado%, 
                        Estado_Anterior=%Nuevo%,
                        Gestion_Sistemas=%Juridico%, 
                        FLAG=%AN17% 
                    WHERE SOS=',sos,' 
                      AND ANOMES = %".$corte."%;')
        FROM INDICADORES_SOS
         WHERE ANOMES = '".$corte."' 
           AND ATENCION = '-'
           AND SISTEMA = 'Gestión Jurídica'
           AND PROCESO in ('Revisión Jurídica')          
  UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
                    SET Atencion=%Administrativa%, 
                        Subclas=%No Clasificado%, 
                        subclas_Aplic=%No Clasificado%, 
                        Controla=%No Clasificado%, 
                        Estado_Anterior=%Nuevo%,
                        Gestion_Sistemas=%Financiera%, 
                        FLAG=%AN18% 
                    WHERE SOS=',sos,' 
                      AND ANOMES = %".$corte."%;')
        FROM INDICADORES_SOS
         WHERE ANOMES = '".$corte."' 
           AND ATENCION = '-'
           AND SISTEMA = 'Gerencia'
           AND PROCESO in ('Bienestar Social')
           AND ACTIVIDAD IN ('Solicitud Auxilio de Solidaridad')           
          
        ";
$Q = $conexion->query($SQL);
$nfilas = $Q->num_rows;        
$Cadena="";
if($nfilas>0){
	$nombre1= "actualizaG_".$fechaAr.".sql";
	$file=fopen("sql/".$nombre1,'w');
	$Cadena="";
	for($i=0;$i<$nfilas;$i++){
		$res = $Q->fetch_array();
		$Cad=str_replace("%","'",$res[0]);
		$Cadena = $Cad.PHP_EOL;
		fwrite($file,$Cadena);	
	}
	$Cadena = '<p style="margin:10px;">Sos con Clasificacion diferente a Tecnologia: &nbsp;<b>'.$nfilas.'</b><a href="sql/'.$nombre1.'">&nbsp;&nbsp;Descargue Script AQUI</a></p>';
}else{
	$Cadena='<p style="margin:10px;">Sos con Clasificacion diferente a Tecnologia: &nbsp;<b>NO EXISTEN SOS POR CLASIFICAR</b></p>';
}
$SQL1="SELECT CONCAT('UPDATE INDICADORES_SOS 
						 SET Atencion=%Sistemas%, 
						 	 Subclas=%Perfiles%, 
						 	 subclas_Aplic=%Perfiles%, 
						 	 Controla=%Perfiles%, 
						 	 Estado_Anterior=%Nuevo%, 
						 	 Gestion_Sistemas=%Sistemas%, 
						 	 FLAG=%AT1% 
					   WHERE SOS=',sos,' 
					     AND ANOMES = %".$corte."%;')
		 FROM INDICADORES_SOS
		WHERE ANOMES = '".$corte."' 
		  AND ATENCION = '-'
          AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
          AND PROCESO = 'Perfiles de usuario'
          AND ACTIVIDAD IN ('Activar usuario funcionario Taylor',
          					'Cambio perfil con traslado de agencia',
          					'Cambio perfil en la misma agencia',
        					'Ingreso',
        					'Retiro definitivo',
        					'Retiro temporal',
        					'Habilitar usuario Heinsohn Apoteosys',
        					'Habilitar usuario Binaps',
        					'Habilitar usuario Biometria / VD',
        					'Crear o Modificar Perfil de SBI',
        					'Habilitar usuario Red Cooperativa Coopcentral',
        					'Habilitar usuario Sugiro',
                  'Ingreso funcionario por vacaciones u otros conceptos',
                  'Ingreso Funcionario Nuevo')
        UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
        						SET ATENCION=%Sistemas%, 
        							Subclas=%Desarrollo%, 
        							subclas_Aplic=%Intranet%, 
        							Controla=%Software%, 
        							Gestion_Sistemas=%Sistemas%, 
        							FLAG=%AT2% 
        					  WHERE SOS=',sos,' 
        					    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
			     AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
        		 AND PROCESO = 'Intranet'
        		 AND ACTIVIDAD IN ('Desarrollo Nuevo',
        		 				   'Reportes desarrollo y actualizacion')
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Mantenimiento%, 
									subclas_Aplic=%Intranet%, 
									Controla=%Software%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT3% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			   	 AND ATENCION = '-'
			   	 AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
        		 AND PROCESO = 'Intranet'
        		 AND ACTIVIDAD IN ('Error en la aplicación',
        		 				   'Mantenimiento o correctivos')
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Infraestructura%, 
									Controla=%Infraestructura%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT4% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
        		 AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
        		 AND PROCESO = 'Internet'
        		 AND ACTIVIDAD IN ('Navegacion',
                               'Interrupcion del Servicio')
        UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
        						SET ATENCION=%Sistemas%, 
        							Subclas=%Soporte%, 
        							subclas_Aplic=%Infraestructura%, 
        							Controla=%Infraestructura%, 
        							Gestion_Sistemas=%Sistemas%, 
        							FLAG=%AT5% 
        					  WHERE SOS=',sos,' 
        					    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
			     AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
				 AND PROCESO = 'Hardware'
				 AND ACTIVIDAD IN ('Servidor AS400 IBM iSeries' , 
				 				   'Servidor de Aplicaciones',
				 				   'Solicitud de herramientas adicionales',
							       'Turno digital',
							       'Validadora',
							       'Datáfono',
							       'Servidor de cámaras',
							       'Biometría',
							       'Impresora punto',
							       'Traslado de Equipo',
                     'Servidor Internet',
                     'Servidor de dominio',
                     'Tablet') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Infraestructura%, 
									Controla=%Infraestructura%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT6% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			   	 AND ATENCION = '-'
        		 AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
        		 AND PROCESO = 'Comunicaciones y Seguridad'
        		 AND ACTIVIDAD IN ('Cable',
        		 				   'Firewall',
        		 				   'Router',
        						   'SISTEMA telefónico',
        						   'Módem telefónica',
                       'Línea telefónica del datáfono')
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Mantenimiento%, 
									subclas_Aplic=%Intranet%, 
									Controla=%Software%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT7% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS 
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
        		 AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
        		 AND PROCESO = 'RAS'
        		 AND ACTIVIDAD IN ('Mantenimiento o correctivos') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Apoteosys%, 
									Controla=%Software%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT8% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			   	 AND ATENCION = '-'
        		 AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
        		 AND PROCESO = 'Heinsohn apoteosys'
        		 AND ACTIVIDAD IN ('Mantenimiento o correctivos',
                               'Respaldo y restauracion base de datos ',
                               'Interfaz contable') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
								    Subclas=%Desarrollo%, 
								    subclas_Aplic=%Apoteosys%, 
								    Controla=%Software%, 
								    Gestion_Sistemas=%Sistemas%, 
								    FLAG=%AT9% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
        		 AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
        		 AND PROCESO = 'Heinsohn apoteosys'
        		 AND ACTIVIDAD IN ('Desarrollo Nuevo') 
        UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
         						SET ATENCION=%Sistemas%, 
         							Subclas=%Desarrollo%, 
         							subclas_Aplic=%SBI%, 
         							Controla=%Software%, 
         							Gestion_Sistemas=%Sistemas%, 
         							FLAG=%AT10% 
         					  WHERE SOS=',sos,' 
         					    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
			     AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
        		 AND PROCESO = 'Red Cooperativa Coopcentral'
        		 AND ACTIVIDAD IN ('Desarrollo Nuevo') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
									SET ATENCION=%Sistemas%, 
										Subclas=%Soporte%, 
										subclas_Aplic=%SBI%, 
										Controla=%Software%, 
										Gestion_Sistemas=%Sistemas%, 
										FLAG=%AT11% 
								  WHERE SOS=',sos,' 
								    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			   	 AND ATENCION = '-'
        		 AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
        	     AND PROCESO = 'Red Cooperativa Coopcentral'
        		 AND ACTIVIDAD IN ('Inconsistencias') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Daturnos%, 
									Controla=%Infraestructura%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT12% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			   	 AND ATENCION = '-'
        		 AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
        		 AND PROCESO = 'Digiturno'
        		 AND ACTIVIDAD IN ('Error en la aplicación',
        		 				   'Dispositivos') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%SBI%, 
									Controla=%Software%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT13% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
		         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
		         AND PROCESO = 'Cierre Diario'
		         AND ACTIVIDAD IN ('Error de cierre en producción' , 
		         				   'Cierre en servidor de pruebas') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Heinsohn Nómina%, 
									Controla=%Software%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT14% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			   	 AND ATENCION = '-'
        		 AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
        		 AND PROCESO = 'Heinsohn nomina'
        		 AND ACTIVIDAD IN ('Mantenimiento o correctivos','Respaldo y restauracion base de datos') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%SBI%, 
									Controla=%Software%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT15% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			    AND ATENCION = '-'
        		AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
        		AND PROCESO = 'Software'
        		AND ACTIVIDAD IN ('Licencias Jwalk',
        						  'Inconsistencias en interfaz',
                      'Antivirus') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Infraestructura%, 
									Controla=%Infraestructura%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT16% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			   	 AND ATENCION = '-'
		         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
		         AND PROCESO = 'Canales'
		         AND ACTIVIDAD IN ('Interrupcion del Servicio','Configuración') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Office%, 
									Controla=%Infraestructura%,
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT17% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
        		 AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
		         AND PROCESO = 'Correo'
		         AND ACTIVIDAD IN ('Mantenimiento y configuración') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Infraestructura%, 
									Controla=%Infraestructura%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT18% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
        		 AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
        		 AND PROCESO = 'Office'
        		 AND ACTIVIDAD IN ('Mantenimiento y configuración') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Gestión humana%, 
									Controla=%Software%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT19% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
		         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
		         AND PROCESO = 'Heinsohn gestion humana'
		         AND ACTIVIDAD IN ('Respaldo y restauracion base de datos',
		         				   'Mantenimiento o correctivos') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Biometría%, 
									Controla=%Software%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT20% 
							  WHERE SOS=',sos,' 
							   AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
        		 AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
        		 AND PROCESO = 'Biometria'
        		 AND ACTIVIDAD IN ('Dispositivos',
        		 				   'Error en la aplicación') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Windows%, 
									Controla=%Infraestructura%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT21% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			   	 AND ATENCION = '-'
		         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
		         AND PROCESO = 'Windows'
		         AND ACTIVIDAD IN ('Mantenimiento y configuración') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%OLAF%, 
									Controla=%Software%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT22% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
		         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
		         AND PROCESO = 'OLAF'
		         AND ACTIVIDAD IN ('Contabilidad',
		         				   'Restaurar BD - OLAF Pruebas') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Intranet%, 
									Controla=%Software%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT23% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
				 AND ATENCION = '-'
				 AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
				 AND PROCESO = 'Intranet'
				 AND ACTIVIDAD IN ('Uso para pruebas')
    UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
                SET ATENCION=%Sistemas%, 
                  Subclas=%Soporte%, 
                  subclas_Aplic=%CEN - FINANCIERO%, 
                  Controla=%Software%, 
                  Gestion_Sistemas=%Sistemas%, 
                  FLAG=%AT23% 
                WHERE SOS=',sos,' 
                  AND ANOMES=%".$corte."%;')
        FROM INDICADORES_SOS
         WHERE ANOMES = '".$corte."' 
         AND ATENCION = '-'
         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
         AND PROCESO = 'CEN - Financiero'
         AND ACTIVIDAD IN ('Mantenimientos o correctivos')  
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%SBI%, 
									Controla=%Software%, 
									Estado_Anterior=%Nuevo%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT24% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."'
		         AND ACTIVIDAD = 'Anulación de radicaciones Solidaridad'
		         AND ATENCION = '-'
		         AND SISTEMA = 'Bienestar Social' 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%-%, 
									Controla=%Infraestructura%, 
									Estado_Anterior=%Nuevo%, 
									Gestion_Sistemas=%Infraestructura%, 
									FLAG=%AT25% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
		         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
		         AND PROCESO = 'Software'
		         AND ACTIVIDAD IN ('Backup / Respaldo de Información')
    UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
                SET ATENCION=%Sistemas%, 
                  Subclas=%Soporte%, 
                  subclas_Aplic=%-%, 
                  Controla=%Infraestructura%, 
                  Estado_Anterior=%Nuevo%, 
                  Gestion_Sistemas=%Infraestructura%, 
                  FLAG=%AT25% 
                WHERE SOS=',sos,' 
                  AND ANOMES=%".$corte."%;')
        FROM INDICADORES_SOS
         WHERE ANOMES = '".$corte."' 
           AND ATENCION = '-'
             AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
             AND PROCESO = 'Software'
             AND ACTIVIDAD IN ('Base de datos SQLServer','Servidor IIS','Replicación Power IBM i')  
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%SBI%, 
									Controla=%Software%, 
									Estado_Anterior=%Nuevo%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT26% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
		         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
		         AND PROCESO = 'Software'
		         AND ACTIVIDAD IN ('Base de datos DB2' , 
		         				   'Backup en Caliente') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Operaciones%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Validación documental%, 
									Controla=%-%, 
									Estado_Anterior=%Nuevo%, 
									Gestion_Sistemas=%Operaciones%, 
									FLAG=%AT27% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS 
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
		         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
		         AND PROCESO = 'Validacion Documental'
		         AND ACTIVIDAD = 'Novedades validacion documental' 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Validación documental%, 
									Controla=%Software%, 
									Estado_Anterior=%Nuevo%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT28% WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
		         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
		         AND PROCESO = 'Validacion Documental'
		         AND ACTIVIDAD = 'Error en la aplicación' 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Infraestructura%, 
									Controla=%Infraestructura%, 
									Estado_Anterior=%Nuevo%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT29% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
		         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
		         AND PROCESO = 'Hardware'
		         AND ACTIVIDAD IN ('Equipo de Cómputo',
		         				   'Escáner',
						           'Impresora laser',
						           'Multifuncional',
						           'Teclado, mouse y camara web',
						           'Teléfonos IP',
						           'Termoimpresora') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%SBI%, 
									Controla=%Software%, 
									Estado_Anterior=%Nuevo%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT30% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."'
		         AND PROCESO LIKE '%SBI%'
		         AND ACTIVIDAD in ('Inconsistencias en SBI','Seguridad Desarrollos Nuevos','Estado de cuenta')
		         AND ATENCION = '-'
		         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones' 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Instalación%, 
									subclas_Aplic=%Infraestructura%, 
									Controla=%Infraestructura%, 
									Estado_Anterior=%Nuevo%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT31% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			   	 AND ATENCION = '-'
		         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
		         AND PROCESO = 'Software'
		         AND ACTIVIDAD IN ('Instalación de Aplicaciones') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Crédito y cartera%, 
									Subclas=%-%, 
									subclas_Aplic=%-%, 
									Controla=%-%, 
									Estado_Anterior=%Nuevo%, 
									Gestion_Sistemas=%Crédito y cartera%, 
									FLAG=%AT32% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
		         AND SISTEMA = 'Gestión de Servicios y Operaciones'
		         AND PROCESO = 'Control y gestión operativa de cartera' 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%SBI%, 
									Controla=%infraestructura%, 
									Estado_Anterior=%Nuevo%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT33% 
							  WHERE SOS=',sos,' 
							   AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS 
			   WHERE ANOMES = '".$corte."'
		         AND ATENCION = '-'
		         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones' 
		         AND PROCESO LIKE 'Software'
		         AND ACTIVIDAD IN ('Mantenimiento binaps')
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%SBI%, 
									Controla=%Software%, 
									Estado_Anterior=%Nuevo%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT34% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."'
		         AND PROCESO LIKE '%SBI%'
		         AND ACTIVIDAD IN ('Muestra de facturación' , 
		         				   'Renombrar Nominas',
		         				   'Reportes actualización reportes en SBI',
                       'Anulación radicación auxilios de solidaridad')
		         AND ATENCION = '-'
		         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones' 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Canales de Recaudo%, 
									Controla=%Software%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT35% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			   	 AND ATENCION = '-'
        		 AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
        		 AND PROCESO = 'Canales de Recaudo'
        		 AND ACTIVIDAD IN ('Inconsistencias') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Infraestructura%, 
									Controla=%Infraestructura%, 
									Estado_Anterior=%Nuevo%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT36% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."'
		         AND PROCESO = 'Comunicaciones y Seguridad'
		         AND ACTIVIDAD IN ('Línea telefónica del datáfono','Incidentes',
             'Switch')
		         AND ATENCION = '-'
		         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones' 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Infraestructura%, 
									Controla=%Infraestructura%, 
									Estado_Anterior=%Nuevo%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT37% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."'
        		 AND ATENCION = '-'
        		 AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones' 
        		 AND PROCESO = 'Energía'
        		 AND ACTIVIDAD IN ('Planta electrica', 'Sistema Eléctrico')
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%SBI%, 
									Controla=%Software%, 
									Estado_Anterior=%Nuevo%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT38% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."'
		         AND ATENCION = '-'
		         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones' 
		         AND PROCESO LIKE '%SBI%'
		         AND ACTIVIDAD IN('Respaldo y Restauración de Base de Datos',
                              'Mantenimiento o correctivos',
                              'Reportes de Ley')
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%SBI%, 
									Controla=%Software%, 
									Estado_Anterior=%Nuevo%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT39% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."' 
			     AND ATENCION = '-'
        		 AND SISTEMA = 'Gestión de Servicios y Operaciones'
			     AND PROCESO = 'Novedades de Asociados'
			     AND ACTIVIDAD IN ('Anulación de vinculación') 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%Intranet%, 
									Controla=%Software%, 
									Estado_Anterior=%Nuevo%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT40% 
							  WHERE SOS=',sos,' 
							    AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."'
        		 AND ACTIVIDAD = 'Anulación de radicaciones Solidaridad'
        		 AND ATENCION = '-'
        		 AND SISTEMA = 'Bienestar Social' 
		UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
								SET ATENCION=%Sistemas%, 
									Subclas=%Soporte%, 
									subclas_Aplic=%SBI%, 
									Controla=%Software%, 
									Estado_Anterior=%Nuevo%, 
									Gestion_Sistemas=%Sistemas%, 
									FLAG=%AT41% 
							  WHERE SOS=',sos,' AND ANOMES=%".$corte."%;')
				FROM INDICADORES_SOS
			   WHERE ANOMES = '".$corte."'
        		 AND ACTIVIDAD = 'Reverso incorrecto de cheque'
        		 AND ATENCION = '-'
        		 AND SISTEMA = 'Administración Financiera'
    UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
                SET ATENCION=%Sistemas%, 
                  Subclas=%Desarrollo%, 
                  subclas_Aplic=%SBI%, 
                  Controla=%Software%, 
                  Estado_Anterior=%Nuevo%, 
                  Gestion_Sistemas=%Sistemas%, 
                  FLAG=%AT42% 
                WHERE SOS=',sos,' 
                  AND ANOMES=%".$corte."%;')
        FROM INDICADORES_SOS
         WHERE ANOMES = '".$corte."' 
           AND ATENCION = '-'
             AND SISTEMA = 'Credito'
           AND PROCESO = 'Credito'
           AND ACTIVIDAD IN ('Desarrollo Nuevo')
    UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
                SET ATENCION=%Sistemas%, 
                  Subclas=%Desarrollo%, 
                  subclas_Aplic=%SBI%, 
                  Controla=%Software%, 
                  Estado_Anterior=%Nuevo%, 
                  Gestion_Sistemas=%Sistemas%, 
                  FLAG=%AT43% 
                WHERE SOS=',sos,' 
                  AND ANOMES=%".$corte."%;')
        FROM INDICADORES_SOS
         WHERE ANOMES = '".$corte."' 
           AND ATENCION = '-'
             AND SISTEMA = 'Administración de Cartera'
           AND PROCESO = 'Cartera'
           AND ACTIVIDAD IN ('Desarrollo Nuevo')
    UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
                SET ATENCION=%Sistemas%, 
                  Subclas=%Desarrollo%, 
                  subclas_Aplic=%SBI%, 
                  Controla=%Software%, 
                  Estado_Anterior=%Nuevo%, 
                  Gestion_Sistemas=%Sistemas%, 
                  FLAG=%AT44% 
                WHERE SOS=',sos,' 
                  AND ANOMES=%".$corte."%;')
        FROM INDICADORES_SOS
         WHERE ANOMES = '".$corte."' 
           AND ATENCION = '-'
             AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
           AND PROCESO LIKE '%SBI%'
           AND ACTIVIDAD IN ('Desarrollo Nuevo')
    UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
                SET ATENCION=%Sistemas%, 
                  Subclas=%Desarrollo%, 
                  subclas_Aplic=%Heinsohn Nómina%, 
                  Controla=%Software%, 
                  Estado_Anterior=%Nuevo%, 
                  Gestion_Sistemas=%Sistemas%, 
                  FLAG=%AT45% 
                WHERE SOS=',sos,' 
                  AND ANOMES=%".$corte."%;')
        FROM INDICADORES_SOS
         WHERE ANOMES = '".$corte."' 
           AND ATENCION = '-'
             AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
           AND PROCESO LIKE '%Heinsohn nomina%'
           AND ACTIVIDAD IN ('Desarrollo Nuevo')
    UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
                SET ATENCION=%Sistemas%, 
                  Subclas=%Soporte%, 
                  subclas_Aplic=%Intranet%, 
                  Controla=%Software%, 
                  Gestion_Sistemas=%Sistemas%, 
                  FLAG=%AT46% 
                WHERE SOS=',sos,' 
                  AND ANOMES=%".$corte."%;')
        FROM INDICADORES_SOS
         WHERE ANOMES = '".$corte."' 
         AND ATENCION = '-'
         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
         AND PROCESO = 'Software'
         AND ACTIVIDAD IN ('Base de datos MySQL')
    UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
                SET ATENCION=%Sistemas%, 
                  Subclas=%Soporte%, 
                  subclas_Aplic=%Intranet%, 
                  Controla=%Software%, 
                  Gestion_Sistemas=%Sistemas%, 
                  FLAG=%AT47% 
                WHERE SOS=',sos,' 
                  AND ANOMES=%".$corte."%;')
        FROM INDICADORES_SOS
         WHERE ANOMES = '".$corte."' 
         AND ATENCION = '-'
         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
         AND PROCESO = 'Software'
         AND ACTIVIDAD IN ('Base de datos MySQL')
    UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
                SET ATENCION=%Sistemas%, 
                  Subclas=%Soporte%, 
                  subclas_Aplic=%Office%, 
                  Controla=%Infraestructura%, 
                  Gestion_Sistemas=%Sistemas%, 
                  FLAG=%AT48% 
                WHERE SOS=',sos,' 
                  AND ANOMES=%".$corte."%;')
        FROM INDICADORES_SOS
         WHERE ANOMES = '".$corte."' 
         AND ATENCION = '-'
         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
         AND PROCESO = 'Megasoft'
         AND ACTIVIDAD IN ('Instalacion y configuración')
    UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
                SET ATENCION=%Sistemas%, 
                  Subclas=%Soporte%, 
                  subclas_Aplic=%Pagina WEB%, 
                  Controla=%Software%, 
                  Gestion_Sistemas=%Sistemas%, 
                  FLAG=%AT49% 
                WHERE SOS=',sos,' 
                  AND ANOMES=%".$corte."%;')
        FROM INDICADORES_SOS
         WHERE ANOMES = '".$corte."' 
         AND ATENCION = '-'
         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
         AND PROCESO = 'Sitio web coprocenva'
         AND ACTIVIDAD IN ('Soporte y mantenimiento')        
    UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
                SET ATENCION=%Sistemas%, 
                  Subclas=%Soporte%, 
                  subclas_Aplic=%Qflow%, 
                  Controla=%Infraestructura%, 
                  Gestion_Sistemas=%Sistemas%,
                  FLAG=%AT50% 
                WHERE SOS=',sos,' 
                  AND ANOMES=%".$corte."%;')
        FROM INDICADORES_SOS
         WHERE ANOMES = '".$corte."' 
         AND ATENCION = '-'
         AND SISTEMA = 'Gestión Tecnologías de Información y Comunicaciones'
         AND PROCESO = 'Qflow'
         AND ACTIVIDAD IN ('Dispositivos')
    UNION SELECT CONCAT('UPDATE INDICADORES_SOS 
                SET ATENCION=%Administrativa%, 
                  Subclas=%No Clasificado%, 
                  subclas_Aplic=%No Clasificado%, 
                  Controla=%Administrativa%, 
                  Gestion_Sistemas=%Administrativa%, 
                  FLAG=%AT50% 
                WHERE SOS=',sos,' 
                  AND ANOMES=%".$corte."%;')
        FROM INDICADORES_SOS
         WHERE ANOMES = '".$corte."' 
         AND ATENCION = '-'
         AND SISTEMA = 'Aprovisionamiento y Mantenimiento'
         AND PROCESO = 'Aprovisionamiento'
         AND ACTIVIDAD IN ('Suministro y elementos para SGSST (descansa pies, alcohol, guantes de seguridad, etc.)')        

        ";
$Q1 = $conexion->query($SQL1);
$nfilas1 = $Q1->num_rows;
$Cadena1=$nfilas1;
if($nfilas1>0){
	$nombre2= "actualizaT_".$fechaAr.".sql";
	$file2=fopen("sql/".$nombre2,'w');
	$Cadena1="";
	for($i=0;$i<$nfilas1;$i++){
		$res = $Q1->fetch_array();
		$Cad1=str_replace("%","'",$res[0]);
		$Cadena1 = $Cad1.PHP_EOL;
		fwrite($file2,$Cadena1);	
	}
	$Cadena1 = '<p style="margin:10px;">Sos con Clasificacion de Tecnologia: &nbsp;<b>'.$nfilas1.'</b><a href="sql/'.$nombre2.'">&nbsp;&nbsp;Descargue Script AQUI</a></p>';
}else{
	$Cadena1='<p style="margin:10px;">Sos con Clasificacion de Tecnologia: &nbsp;<b>NO EXISTEN SOS POR CLASIFICAR</b></p>';
}


echo '
<section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"> CLASIFICACION AUTOMATICA DE SOS</h3>
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
                                    <div class="table-responsive" id="table1" style="border:2px solid black;width: 100%; height: 400px; margin: 0 auto; overflow-y:scroll;text-align:left;">
                                    	<ol>
                                    	<li>'.$Cadena.'</li>
                                    	<li>'.$Cadena1.'</li>
                                    	</ol>
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