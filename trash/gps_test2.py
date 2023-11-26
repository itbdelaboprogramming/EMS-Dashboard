"""
#!/usr/bin/env python
#title           :gps_serial.py
#description     :Python Script Communication between GPS SE100 NMEA and Raspberry Pi
#author          :Fajar Muhammad Noor Rozaqi
#date            :2022/11/14
#version         :0.1
#usage           :Python
#notes           :
#python_version  :3.8
#==============================================================================
"""

# Library
import serial #library for serial communication
import pynmea2 #library for parsing GPS NMEA format
import time #library for time
import datetime #library for date & time
import pymysql #library for SQL

# Serial communication
try:
    ser = serial.Serial('/dev/ttyUSB0', baudrate=9600, timeout=5)
    print("Connected to GPS SE100 NMEA")
except:
    print("Disconnected to GPS SE100 NMEA")
    
# Algorithm of GPS SE100 NMEA
while True:
    try:
        # Decode the data from GPS SE100 NMEA serial communication
        line = ser.readline().decode('utf-8', errors='replace')
        line = line.strip()
        #print(line)
        
        # Select the $GNGGA only
        if '$GNGGA' in line:
            print(line)
                
            # Parse the data by using pynmea library
            msg = pynmea2.parse(line)
            #print(msg)
            print(repr(msg))
        
            # Timer
            timer = datetime.datetime.now()
            
            # Variable
            la = msg.latitude
            lo = msg.longitude
            sats = msg.num_sats
            hdop = msg.horizontal_dil
        
            # Print the data GPS NMEA SE100 Radiolink
            print("Time                             :", timer.strftime("%Y-%m-%d %H:%M:%S"))
            #print("================================")
            print("Latitude                         :", la)
            print("Longitude                        :", lo)
            print("Number satellite                 :", sats)
            print("Horizontal Dilution of Precision :", hdop)
            #print("GPS NMEA SE100 Data is sent")
            #print("================================")
            print("")
            
            # Database Connection
            db = pymysql.connect(host='192.168.18.19',
                                 user='admin',
                                 password='admin',
                                 db='monitoring',
                                 charset='utf8',
                                 cursorclass=pymysql.cursors.DictCursor)
            cur = db.cursor()
            
            add_c0 = "INSERT INTO `gps_msd700`(timestamp, latitude, longitude, satellite, hdop) VALUES (%s,%s,%s,%s,%s)"
            cur.execute(add_c0,((timer.strftime("%Y-%m-%d %H:%M:%S"),
                                 la,
                                 lo,
                                 sats,
                                 hdop)))
            db.commit()
            
            # Delay time
            time.sleep(2)
    except:
        # Disconnected
        #print("GPS NMEA SE100 DATA is not sent")
        #print("================================")
        #print("")
        #time.sleep(5)
        pass
