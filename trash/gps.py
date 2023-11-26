import io

import pynmea2
import serial


ser = serial.Serial('/dev/ttyUSB0', 9600, timeout=5.0)
#sio = io.TextIOWrapper(io.BufferedRWPair(ser, ser))

while 1:
    try:
        line = ser.readline()
        msg = pynmea2.parse(line)
        print(repr(msg))
    except serial.SerialException as e:
        print('Device error: {}'.format(e))
        break
    except pynmea2.ParseError as e:
        print('Parse error: {}'.format(e))
        continue