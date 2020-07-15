UPDATE INDICADORES_SOS 
        						SET ATENCION='Sistemas', 
        							Subclas='Soporte', 
        							subclas_Aplic='Infraestructura', 
        							Controla='Infraestructura', 
        							Gestion_Sistemas='Sistemas', 
        							FLAG='AT5' 
        					  WHERE SOS=325235 
        					    AND ANOMES='201909';
UPDATE INDICADORES_SOS 
								SET ATENCION='Sistemas', 
									Subclas='Soporte', 
									subclas_Aplic='Infraestructura', 
									Controla='Infraestructura', 
									Estado_Anterior='Nuevo', 
									Gestion_Sistemas='Sistemas', 
									FLAG='AT37' 
							  WHERE SOS=323232 
							    AND ANOMES='201909';
