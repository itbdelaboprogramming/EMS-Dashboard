#library
import time
import datetime
import pymysql

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
        db = pymysql.connect(host='10.243.177.137',
                     port=3306,
                     user='zaqi',
                     password='raspi13315009',
                     db='monitoring')
        cur = db.cursor()
        
        try:
            add_c1 ="INSERT INTO `cpu_temperature`(temperature,time,raspi_id) VALUES(%s,%s,%s)"
            cur.execute(add_c1,(cpu.temperature,
                                timer.strftime("%Y-%m-%d %H:%M:%S"),
                                int(1)))
            db.commit()
            
            print("Database is connected")
            print("")
            
            time.sleep(0)
                
        except:
            db.rollback()
            print("Database is not connected")
            print("")
            
        time.sleep(0)
        
    except:
        pass
