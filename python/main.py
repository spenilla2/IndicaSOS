import pymysql
import calendar
from datetime import timedelta, date
def connectionMYSQL():
    try:
        connectionMYSQL = pymysql.connect( host='localhost', 
                              user= 'root', 
                              passwd='', 
                              db='cpv' )
        return connectionMYSQL
    except Exception as e:
        print("Error al Conectar: "+str(e))
    

def callQuery(Query, connection):
    cursor = connection.cursor()
    cursor.execute(Query)
    connection.close()
    return cursor.fetchall()
def callQuery_P(Query, connection):
    cursor = connection.cursor()
    cursor.execute(Query)
    connection.close()
    return cursor

def formatString(value):
    if value<10:
        return "0" + str(value)
    else:
        return str(value)
    
connection = connectionMYSQL()
current_date = date.today()
current_day = current_date.day
if current_day <= 15:
    current_date=current_date - timedelta(days=30)
else:
    current_date = current_date
earlier_date = current_date - timedelta(days=30)
year_p = current_date.year
history_date="2016-01-01 00:00:00"
month_p = formatString(current_date.month)
last_day_month_p = calendar.monthrange(int(year_p),int(month_p))[1]
month_p_ca = formatString(earlier_date.month)
year_p_ca = earlier_date.year
ini_Date = str(year_p)+"-"+str(month_p)+"-01"+" 00:00:00"
end_Date = str(year_p)+"-"+str(month_p)+"-"+str(last_day_month_p)+" 23:59:59"
end_Date_C = str(year_p)+"-"+str(month_p)+"-"+str(last_day_month_p)
corte = str(year_p)+""+str(month_p)
corte_Ant = str(year_p_ca)+""+str(month_p_ca)

print(callQuery_P("CALL Crea_Población_SOS('"+ini_Date+"','"+end_Date+"','"+end_Date_C+"','"+corte+"')", connection))
print(callQuery_P("TRUNCATE TABLE procesar')", connection))
print(callQuery_P("CALL Pendientes_T-1('"+corte_Ant+"')", connection))
print(callQuery_P("CALL Insertar_T-1_en_Poblacion('"+history_date+"','"+end_Date+"','"+corte+"')", connection))
print(callQuery_P("CALL Actualiza_Clasifica('"+corte+"')", connection))
print(callQuery_P("CALL Actualiza_Calificacion('"+corte+"')", connection))
print(callQuery_P("CALL Actualiza_Causa('"+corte+"')", connection))
print(callQuery_P("CALL Actualiza_Historia('"+history_date+"','"+end_Date+"','"+corte+"')", connection))
print(callQuery_P("CALL Actualiza_Medio('"+corte+"')", connection))
print(callQuery_P("CALL Actualiza_Rangos_Dias('"+corte+"')", connection))
print(callQuery_P("TRUNCATE TABLE cargue_inicial')", connection))
print(callQuery_P("CALL Clasificacion_T-1_en_T('"+corte_Ant+"')", connection))
print(callQuery_P("CALL Actualiza_Clasificacion_T_de_T-1('"+corte+"')", connection))
print(ini_Date)    

print(end_Date)
print(end_Date_C)
print(corte)
print(corte_Ant)

#lista = callQuery("CALL prueba_input('265028',' ')", connection)
#for x in lista:
#    print(str(x[0])+"-"+str(x[32]))
