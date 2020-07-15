UPDATE INDICADORES_SOS 
								SET ATENCION='Sistemas', 
									Subclas='Soporte', 
									subclas_Aplic='SBI', 
									Controla='Software', 
									Estado_Anterior='Nuevo', 
									Gestion_Sistemas='Sistemas', 
									FLAG='AT34' 
							  WHERE SOS=280652 
							    AND ANOMES='201901';
