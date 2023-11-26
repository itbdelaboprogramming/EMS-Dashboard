#library
import time
import datetime
import pymysql
import csv
import numpy as np

while True:
    try:
        #temperature
        from gpiozero import CPUTemperature
        cpu = CPUTemperature()
        
        timer = datetime.datetime.now()
        print("Time                    :",timer.strftime("%Y-%m-%d %H:%M:%S"))
        print("Temperature Raspberry Pi:",cpu.temperature)
        print("")
        
        time.sleep(5)
        
        #Database Connection
        db = pymysql.connect(host='delabo01-mysql.at.remote.it',
                     port=33000,
                     user='itbdelabo',
                     password='Delabo0220!',
                     db='itbdelabo',
                     charset='utf8',
                     cursorclass=pymysql.cursors.DictCursor)
        cur = db.cursor()
        
        try:
            add_c1 ="INSERT INTO `cpu_temperature`(temperature,time,raspi_id) VALUES(%s,%s,%s)"
            cur.execute(add_c1,(cpu.temperature,
                                timer.strftime("%Y-%m-%d %H:%M:%S"),
                                int(1)))
            db.commit()
            
            time.sleep(60)
            
            #Reading Record Database
            try:
                #Database Connection
                db = pymysql.connect(host='delabo01-mysql.at.remote.it',
                     port=33000,
                     user='itbdelabo',
                     password='Delabo0220!',
                     db='itbdelabo',
                     charset='utf8',
                     cursorclass=pymysql.cursors.DictCursor)
                cur = db.cursor()
                
                with db.cursor() as cursor:
                    sql = "SELECT (temperature),(time),(raspi_id) FROM `cpu_temperature`"
                    cursor.execute(sql)
                    result = cursor.fetchall()
                    print(result)
                 
                Temperature =[]
                Time =[]
                Raspi_id =[]
                 
                #Converting into CSV File
                filename = "/home/pi/temperaturelog.csv"
                with open(filename, mode='w', newline='') as file:
                    a = csv.writer(file, delimiter =',')
                    a.writerow(['Temperature','Time','Raspi_id'])
                    for i in range(0, len(result)):
                        a.writerow(result[i].values())
                        Temperature.append(result[i]['temperature'])
                        Time.append(result[i]['time'])
                        Raspi_id.append(result[i]['raspi_id'])
                
                print("CSV is converted")
                print("")
                
            except:
                print("CSV is not converted")
                print("")
                
        except:
            db.rollback()
            print("Database is not connected")
            print("")
            
        time.sleep(0)
        
    except:
        pass