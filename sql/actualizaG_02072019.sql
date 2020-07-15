UPDATE INDICADORES_SOS 
								SET Atencion='Financiera', 
									Subclas='-', 
									subclas_Aplic='-', 
									Controla='-', 
									Gestion_Sistemas='Financiera', 
									FLAG='AN13' 
							  WHERE SOS=309913 
							    AND ANOMES='201906';
UPDATE INDICADORES_SOS 
								SET Atencion='Financiera', 
									Subclas='-', 
									subclas_Aplic='-', 
									Controla='-', 
									Gestion_Sistemas='Financiera', 
									FLAG='AN13' 
							  WHERE SOS=310399 
							    AND ANOMES='201906';
UPDATE INDICADORES_SOS 
                    SET Atencion='Administrativa', 
                        Subclas='No Clasificado', 
                        subclas_Aplic='No Clasificado', 
                        Controla='No Clasificado', 
                        Estado_Anterior='Nuevo',
                        Gestion_Sistemas='Juridico', 
                        FLAG='AN17' 
                    WHERE SOS=307869 
                      AND ANOMES = '201906';
