UPDATE INDICADORES_SOS 
		                        SET Atencion='Mercadeo', 
		                        	Subclas='Soporte', 
		                        	subclas_Aplic='SBI', 
		                        	Controla='-', 
		                        	Estado_Anterior='Nuevo', 
		                        	Gestion_Sistemas='Mercadeo', 
		                        	FLAG='AN11' 
		                      WHERE SOS=302804 
		                        AND ANOMES = '201907';
