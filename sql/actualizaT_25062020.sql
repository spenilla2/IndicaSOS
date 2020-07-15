UPDATE INDICADORES_SOS 
        						SET ATENCION='Sistemas', 
        							Subclas='Soporte', 
        							subclas_Aplic='Infraestructura', 
        							Controla='Infraestructura', 
        							Gestion_Sistemas='Sistemas', 
        							FLAG='AT5' 
        					  WHERE SOS=359908 
        					    AND ANOMES='202004';
UPDATE INDICADORES_SOS 
								SET ATENCION='Sistemas', 
									Subclas='Soporte', 
									subclas_Aplic='Heinsohn Nómina', 
									Controla='Software', 
									Gestion_Sistemas='Sistemas', 
									FLAG='AT14' 
							  WHERE SOS=360809 
							    AND ANOMES='202004';
UPDATE INDICADORES_SOS 
								SET ATENCION='Sistemas', 
									Subclas='Soporte', 
									subclas_Aplic='Heinsohn Nómina', 
									Controla='Software', 
									Gestion_Sistemas='Sistemas', 
									FLAG='AT14' 
							  WHERE SOS=361846 
							    AND ANOMES='202004';
UPDATE INDICADORES_SOS 
                SET ATENCION='Sistemas', 
                  Subclas='Soporte', 
                  subclas_Aplic='-', 
                  Controla='Infraestructura', 
                  Estado_Anterior='Nuevo', 
                  Gestion_Sistemas='Infraestructura', 
                  FLAG='AT25' 
                WHERE SOS=361309 
                  AND ANOMES='202004';
UPDATE INDICADORES_SOS 
                SET ATENCION='Sistemas', 
                  Subclas='Soporte', 
                  subclas_Aplic='-', 
                  Controla='Infraestructura', 
                  Estado_Anterior='Nuevo', 
                  Gestion_Sistemas='Infraestructura', 
                  FLAG='AT25' 
                WHERE SOS=359694 
                  AND ANOMES='202004';
UPDATE INDICADORES_SOS 
                SET ATENCION='Sistemas', 
                  Subclas='Soporte', 
                  subclas_Aplic='Qflow', 
                  Controla='Infraestructura', 
                  Gestion_Sistemas='Sistemas',
                  FLAG='AT50' 
                WHERE SOS=359634 
                  AND ANOMES='202004';
