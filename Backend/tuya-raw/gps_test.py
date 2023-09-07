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

# Serial communication
ser = serial.Serial('/dev/ttyUSB0', baudrate=9600, timeout=5)
#print("Connected to GPS SE100 NMEA")

# Algorithm of GPS SE100 NMEA
while True:
    try:
        # Decode the data from GPS SE100 NMEA serial communication
        line = ser.readline().decode('utf-8', errors='replace')
        #print(line.strip())
        
        # Parse the data by using pynmea library
        msg = pynmea2.parse(line)
        
        #print(msg)
        lat = msg.latitude
        long = msg.longitude
        sats = msg.num_sats
        hdop = horizontal_dil
        
        # Print the data GPS NMEA SE100
        print(lat)
        print(lon)
        print(sats)
        print(hdop)
        #print("GPS NMEA SE100 Data is sent")
        print("")
        
        # Delay time
        #time.sleep(5)
    except:
        # Disconnected
        #print("============")
        #print("GPS NMEA SE100 DATA is not sent")
        #print("============")
        #print("")
        #time.sleep(5)
        pass