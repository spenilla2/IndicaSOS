UPDATE INDICADORES_SOS 
        						SET ATENCION='Sistemas', 
        							Subclas='Soporte', 
        							subclas_Aplic='Infraestructura', 
        							Controla='Infraestructura', 
        							Gestion_Sistemas='Sistemas', 
        							FLAG='AT5' 
        					  WHERE SOS=310710 
        					    AND ANOMES='201906';
UPDATE INDICADORES_SOS 
								SET ATENCION='Sistemas', 
									Subclas='Soporte', 
									subclas_Aplic='SBI', 
									Controla='Software', 
									Gestion_Sistemas='Sistemas', 
									FLAG='AT15' 
							  WHERE SOS=309122 
							    AND ANOMES='201906';
UPDATE INDICADORES_SOS 
								SET ATENCION='Sistemas', 
									Subclas='Soporte', 
									subclas_Aplic='SBI', 
									Controla='Software', 
									Gestion_Sistemas='Sistemas', 
									FLAG='AT15' 
							  WHERE SOS=310101 
							    AND ANOMES='201906';
UPDATE INDICADORES_SOS 
								SET ATENCION='Sistemas', 
									Subclas='Soporte', 
									subclas_Aplic='SBI', 
									Controla='Software', 
									Estado_Anterior='Nuevo', 
									Gestion_Sistemas='Sistemas', 
									FLAG='AT30' 
							  WHERE SOS=309580 
							    AND ANOMES='201906';
UPDATE INDICADORES_SOS 
								SET ATENCION='Sistemas', 
									Subclas='Soporte', 
									subclas_Aplic='SBI', 
									Controla='Software', 
									Estado_Anterior='Nuevo', 
									Gestion_Sistemas='Sistemas', 
									FLAG='AT30' 
							  WHERE SOS=307444 
							    AND ANOMES='201906';
UPDATE INDICADORES_SOS 
								SET ATENCION='Sistemas', 
									Subclas='Soporte', 
									subclas_Aplic='Infraestructura', 
									Controla='Infraestructura', 
									Estado_Anterior='Nuevo', 
									Gestion_Sistemas='Sistemas', 
									FLAG='AT36' 
							  WHERE SOS=309727 
							    AND ANOMES='201906';
UPDATE INDICADORES_SOS 
                SET ATENCION='Sistemas', 
                  Subclas='Soporte', 
                  subclas_Aplic='Office', 
                  Controla='Infraestructura', 
                  Gestion_Sistemas='Sistemas', 
                  FLAG='AT48' 
                WHERE SOS=307960 
                  AND ANOMES='201906';
UPDATE INDICADORES_SOS 
                SET ATENCION='Sistemas', 
                  Subclas='Soporte', 
                  subclas_Aplic='Pagina WEB', 
                  Controla='Software', 
                  Gestion_Sistemas='Sistemas', 
                  FLAG='AT49' 
                WHERE SOS=309590 
                  AND ANOMES='201906';
