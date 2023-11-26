"""
#!/usr/bin/env python
#title           :smartplugtuya.py
#description     :Python API Communication between Smart Plug Tuya (TuyaCloud API) and Raspberry Pi
#author          :Fajar Muhammad Noor Rozaqi
#date            :2022/07/12
#version         :0.1
#usage           :Python
#notes           :
#python_version  :3.8
#==============================================================================
"""

# device = Smart Plug _ Delabo 4

# Import library
import datetime
from xmlrpc.client import DateTime
import tinytuya # code packet for communication between Tuya devices
import time # RTC Real Time Clock
import pymysql # library for sql

# Specifications of Network scanner (the device Tuya must be turned "ON")
Device_Id = 'eb3053da8ae147e7cawl5i' # Device Id from Tuya device sensor
Address_Id = '192.168.18.26' # IP Address connected to Tuya device sensor
Local_Key = 'fdf71dcf30960eb4' # Local Key generated from  python -m tinytuya wizard
Version = 3.3 #Version of Tuya protocol used

# Checking the connection "Tuya device - sensor"
try:
    smartplug = tinytuya.OutletDevice(Device_Id, Address_Id, Local_Key)
    smartplug.set_version(Version)
    print("Connected to Tuya device sensor")
except:
    print("Disconnected to Tuya device sensor")
    smartplug.close()

# Reading a Tuya device sensor
while True:
    try:
        # Time
        # Change timer_initial whenever run the program
        timer_initial = datetime.datetime(2023, 2, 17, 14, 0)
        # print(timer_initial)
        timer = datetime.datetime.now()
        # print(timer)
        delta_time = timer-timer_initial
        # print(delta_time.total_seconds())
        print("Time                          :",timer.strftime("%Y-%m-%d %H:%M:%S"))
        
        # Get Status of Tuya device sensor
        data = smartplug.status()
        print("set_status() result", data)
        # Voltage # DPS (Data Points)
        print("Voltage                       :", (data['dps']['20'])/10,"V")
        # Current # DPS (Data Points)
        print("Current                       :", (data['dps']['18'])/1000,"A")
        # Power   # DPS (Data Points)
        print("Power                         :", (data['dps']['19'])/10,"W")
        # Total Electricity # DPS (Data Points)
        print("Electricity                   :", (((data['dps']['19'])*5/(10000))*(1/60)),"kWh")
        #print("Electricity                   :", ((data['dps']['19'])/(1000*6)),"kWh")
        day = (((data['dps']['19'])/10)/1000)*24
        #day = (((data['dps']['17'])/1000*6)*24)
        week = day*7.0
        month = (week*52)/12
        # Projected usage (kWh) of day # DPS (Data Points)
        print("Projected usage (kWh) of day  :", day, "kWh")
        # Projected usage (kWh) of week # DPS (Data Points)
        print("Projected usage (kWh) of week :", week, "kWh")
        # Projected usage (kWh) of month # DPS (Data Points)
        print("Projected usage (kWh) of month:", month, "kWh")
        #print('')

        # Turn On
        smartplug.turn_on()

        # Database Connection
        db = pymysql.connect(host='192.168.18.19',
                             user='admin',
                             password='admin',
                             db='monitoring',
                             charset='utf8',
                             cursorclass=pymysql.cursors.DictCursor)
        cur = db.cursor()
        
        add_c0 = "INSERT INTO `tuya_smart_plug_4`(time, voltage, current, power, electricity, day, week, month) VALUES (%s,%s,%s,%s,%s,%s,%s,%s)"
        cur.execute(add_c0,((timer.strftime("%Y-%m-%d %H:%M:%S"),
                             (data['dps']['20'])/10,
                             (data['dps']['18'])/1000,
                             (data['dps']['19'])/10,
                             (((data['dps']['19'])*5/(10000))*(1/60)),
                             day,
                             week,
                             month)))
        db.commit()
        
        sum_power = "SElECT SUM(electricity) FROM `tuya_smart_plug_4`"
        cur.execute(sum_power)
        power_sql = cur.fetchall()    
        total_power = power_sql
        total_electricity = (total_power[0]['SUM(electricity)'])
        cost_total = (total_power[0]['SUM(electricity)'])*1448
        carbon_emission = (total_power[0]['SUM(electricity)'])*0.652

        print("Total Electricity             :", total_electricity,"kWh")
        print("Total Cost                    :", cost_total,"rupiah")
        print("Total carbon emission         :", carbon_emission,"kgCO")
        print('')
        
        add_c0 = "INSERT INTO `tuya_smart_plug_4`(total_electricity, total_cost, carbon_emission) VALUES (%s,%s,%s)"
        cur.execute(add_c0,(total_electricity,
                            cost_total,
                            carbon_emission))
        db.commit()

        time.sleep(60*5)
        print("============")
        print("Connected")
        print("============")

    except:
        # print(timer_initial)
        timer = datetime.datetime.now()
        
        # Database Connection
        db = pymysql.connect(host='192.168.18.19',
                             user='admin',
                             password='admin',
                             db='monitoring',
                             charset='utf8',
                             cursorclass=pymysql.cursors.DictCursor)
        cur = db.cursor()
        
        add_c0 = "INSERT INTO `tuya_smart_plug_4`(time, voltage, current, power, electricity, day, week, month) VALUES (%s,%s,%s,%s,%s,%s,%s,%s)"
        cur.execute(add_c0,((timer.strftime("%Y-%m-%d %H:%M:%S"),
                             0,
                             0,
                             0,
                             0,
                             0,
                             0,
                             0)))
        db.commit()
        
        sum_power = "SElECT SUM(electricity) FROM `tuya_smart_plug_4`"
        cur.execute(sum_power)
        power_sql = cur.fetchall()    
        total_power = power_sql
        total_electricity = (total_power[0]['SUM(electricity)'])
        cost_total = (total_power[0]['SUM(electricity)'])*1448
        carbon_emission = (total_power[0]['SUM(electricity)'])*0.652

        print("Total Electricity             :", total_electricity,"kWh")
        print("Total Cost                    :", cost_total,"rupiah")
        print("Total carbon emission         :", carbon_emission,"kgCO")
        print('')
        
        add_c0 = "INSERT INTO `tuya_smart_plug_4`(total_electricity, total_cost, carbon_emission) VALUES (%s,%s,%s)"
        cur.execute(add_c0,(total_electricity,
                            cost_total,
                            carbon_emission))
        db.commit()
        
        print("============")
        print("Disconnected")
        print("============")
        time.sleep(60*5)
        pass
    
#Trash
    # kwh = ((data['dps']['20'])/10)*((data['dps']['18'])/1000)*((delta_time.total_seconds())/(3600*1000))
    # print("Electricity        :", ((data['dps']['17'])/1000),"kWh")
    # print("Electricity        :", kwh,"kWh")
        
    # print("Electricity        :", (((data['dps']['17'])/1000)+((data['dps']['25'])/100000)),"kWh")
    # print("Electricity        :", (data['dps']['17'])/1000,"kWh")