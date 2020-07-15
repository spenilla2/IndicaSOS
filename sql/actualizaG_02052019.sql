UPDATE INDICADORES_SOS 
       							SET Atencion='Crédito y Cartera', 
       								Subclas='-', 
       								subclas_Aplic='-', 
       								Controla='-', 
       								Gestion_Sistemas='Crédito y Cartera', 
       								FLAG='AN12' 
       						  WHERE SOS=298900 
       						    AND ANOMES = '201904';
