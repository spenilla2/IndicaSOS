UPDATE INDICADORES_SOS 
		                        SET Atencion='Bienestar Social', 
		                            Subclas='No clasificado', 
		                            subclas_Aplic='No clasificado', 
		                            Controla='Bienestar Social', 
		                            Gestion_Sistemas='Bienestar Social', 
		                            FLAG='AN4' 
		                      WHERE SOS=261644 
		                        AND ANOMES = '201902';
