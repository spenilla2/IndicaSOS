UPDATE INDICADORES_SOS 
		                        SET Atencion='Bienestar Social', 
		                            Subclas='No clasificado', 
		                            subclas_Aplic='No clasificado', 
		                            Controla='Bienestar Social', 
		                            Gestion_Sistemas='Bienestar Social', 
		                            FLAG='AN4' 
		                      WHERE SOS=345957 
		                        AND ANOMES = '202005';
UPDATE INDICADORES_SOS 
								SET Atencion='Administrativa', 
									Subclas='-', 
									subclas_Aplic='-', 
									Controla='-', 
									Gestion_Sistemas='Administrativa', 
									FLAG='AN15' 
							  WHERE SOS=364492 
							    AND ANOMES = '202005';
