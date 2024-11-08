"""
#!/usr/bin/env python
#title           :multithread_smartplugtuya.py
#description     :Multi thread of Python API Communication between Smart Plug Tuya (TuyaCloud API) and Raspberry Pi
#author          :Fajar Muhammad Noor Rozaqi
#date            :2022/10/12
#version         :0.1
#usage           :Python
#notes           :
#python_version  :3.8
#==============================================================================
"""

# Import library
import subprocess
from time import sleep

delay = 0
subprocess.Popen("python3 smartplugtuya_1.py", shell=True)
sleep(delay)
subprocess.Popen("python3 smartplugtuya_2.py", shell=True)
sleep(delay)
subprocess.Popen("python3 smartplugtuya_3.py", shell=True)
sleep(delay)
subprocess.Popen("python3 smartplugtuya_4.py", shell=True)
sleep(delay)
subprocess.Popen("python3 smartplugtuya_5.py", shell=True)
sleep(delay)
subprocess.Popen("python3 smartplugtuya_6.py", shell=True)
sleep(delay)
subprocess.Popen("python3 smartplugtuya_7.py", shell=True)
sleep(delay)
subprocess.Popen("python3 smartplugtuya_8.py", shell=True)
sleep(60*5)