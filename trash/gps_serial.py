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
        #print(line.strip())
        
        # Parse the data by using pynmea library
        msg = pynmea2.parse(line)
        print(msg)
        print(repr(msg))
        #print(repr(line))
        
        #Timer
        timer = datetime.datetime.now()
        
        # Print the data GPS NMEA SE100
        #print("Time                             :", timer.strftime("%Y-%m-%d %H:%M:%S"))
        #print("================================")
        #print("Latitude                         :", (msg.latitude))
        #print("Longitude                        :", (msg.longitude))
        #print("Number satelite                  :", (msg.num_sats))
        #print("Horizontal Dilution of Precision :", (msg.horizontal_dil))
        #print("GPS NMEA SE100 Data is sent")
        #print("================================")
        print("")
        
        # Delay time
        time.sleep(2)
    except:
        # Disconnected
        print("GPS NMEA SE100 DATA is not sent")
        print("================================")
        print("")
        #time.sleep(5)
        pass