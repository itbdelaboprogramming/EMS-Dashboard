import mysql.connector
import datetime
import time
import tinytuya  # code packet for communication between Tuya devices

# Konfigurasi koneksi database (gantilah dengan informasi yang sesuai)
db_config = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "monitoring"
}

# Specifications of Network scanner (the device Tuya must be turned "ON")
Device_Id = 'eb6f360462e0e7a2a6fw8r' # Device Id from Tuya device sensor
Address_Id = '192.168.18.15' # IP Address connected to Tuya device sensor
Local_Key = 'ffd23b959050c09a' # Local Key generated from  python -m tinytuya wizard
Version = 3.3 #Version of Tuya protocol used

# Checking the connection "Tuya device - sensor"
try:
    smartplug = tinytuya.OutletDevice(Device_Id, Address_Id, Local_Key)
    smartplug.set_version(Version)
    print("Connected to Tuya device sensor")
except:
    print("Disconnected to Tuya device sensor")
    smartplug.close()


# Fungsi untuk membaca status dari database
def get_controller_status():
    try:
        connection = mysql.connector.connect(**db_config)
        cursor = connection.cursor(dictionary=True)
        query = "SELECT status FROM controller WHERE id = 5"
        cursor.execute(query)
        result = cursor.fetchone()
        if result:
            return result["status"]
    except Exception as e:
        print(f"Error: {e}")
    finally:
        cursor.close()
        connection.close()
    return None


def get_sum_electricity():
    try:
        connection = mysql.connector.connect(**db_config)
        cursor = connection.cursor(dictionary=True)
        query = "SELECT SUM(electricity) as electricity FROM `tuya_smart_plug_5`"
        cursor.execute(query)
        result = cursor.fetchone()
        if result:
            return result["electricity"]
    except Exception as e:
        print(f"Error: {e}")
    finally:
        cursor.close()
        connection.close()
    return None


while True:
    status = get_controller_status()
    if status == "online":
        smartplug.turn_on()
        print("ttt")
        # try:
        #     # Time
        #     # Change timer_initial whenever run the program
        #     timer_initial = datetime.datetime(2023, 2, 17, 14, 0)

        #     # print(timer_initial)
        #     timer = datetime.datetime.now()

        #     # print(timer)
        #     delta_time = timer-timer_initial

        #     # print(delta_time.total_seconds())
        #     print("Time                          :",
        #           timer.strftime("%Y-%m-%d %H:%M:%S"))

        #     # Get Status of Tuya device sensor
        #     data = smartplug.status()
        #     print("data : ", data)
        #     print("data voltage : ", data['dps']['20'])
        #     print("data power : ", data['dps']['19'])
        #     print("data current : ", data['dps']['18'])
        #     # print("data Electricity : ", data['dps']['17'])
        #     print(" ")

        #     # Voltage # DPS (Data Points)
        #     voltage = data['dps']['20']/10
        #     print("Voltage                       :", voltage, "V")

        #     # Current # DPS (Data Points)
        #     current = data['dps']['18']/1000
        #     print("Current                       :", current, "A")

        #     # Power   # DPS (Data Points)
        #     power = data['dps']['19']/10
        #     print("Power                         :", power, "W")

        #     # Total Electricity # DPS (Data Points)
        #     electricity = voltage

        #     # print("Electricity                   :",
        #     #       (((data['dps']['19'])*5/(10000))*(1/60)), "kWh")

        #     print(" ")

        #     # print("Electricity                   :", ((data['dps']['19'])/(1000*6)),"kWh")

        #     # day = (((data['dps']['19'])/10)/1000)*24

        #     # # day = (((data['dps']['17'])/1000*6)*24)
        #     # week = day*7.0
        #     # month = (week*52)/12

        #     # # Projected usage (kWh) of day # DPS (Data Points)
        #     # print("Projected usage (kWh) of day  :", day, "kWh")
        #     # # Projected usage (kWh) of week # DPS (Data Points)
        #     # print("Projected usage (kWh) of week :", week, "kWh")
        #     # # Projected usage (kWh) of month # DPS (Data Points)
        #     # print("Projected usage (kWh) of month:", month, "kWh")
        #     # # print('')

        #     # query = "SELECT status FROM controller WHERE id = 5"

        #     # query = "INSERT INTO `tuya_smart_plug_8`(time, voltage, current, power, electricity, day, week, month) VALUES (%s,%s,%s,%s,%s,%s,%s,%s)"
        #     # cur.execute(query, ((timer.strftime("%Y-%m-%d %H:%M:%S"),
        #     #                     (data['dps']['20'])/10,
        #     #                     (data['dps']['18'])/1000,
        #     #                     (data['dps']['19'])/10,
        #     #                     (((data['dps']['19'])*5/(10000))*(1/60)),
        #     #                     0,
        #     #                     0,
        #     #                     0)))

        #     # sum_power = "SELECT SUM(electricity) FROM `tuya_smart_plug_8`"
        #     # cur.execute(sum_power)
        #     # power_sql = cur.fetchall()
        #     # total_power = power_sql
        #     # total_electricity = (total_power[0]['SUM(electricity)'])
        #     # cost_total = (total_power[0]['SUM(electricity)'])*1448
        #     # carbon_emission = (total_power[0]['SUM(electricity)'])*0.652

        #     # print("Total Electricity             :", total_electricity, "kWh")
        #     # print("Total Cost                    :", cost_total, "rupiah")
        #     # print("Total carbon emission         :", carbon_emission, "kgCO")
        #     # print('')

        #     # query = "INSERT INTO `tuya_smart_plug_8`(total_electricity, total_cost, carbon_emission) VALUES (%s,%s,%s)"
        #     # cur.execute(query, (total_electricity,
        #     #                     cost_total,
        #     #                     carbon_emission))
        #     # db.commit()

        #     # time.sleep(60*5)
        #     # print("============")
        #     # print("Connected")
        #     # print("============")

        # except:
        #     print("555")
        #     print("")

    elif status == "offline":
        print("rrrr")
        smartplug.turn_off()
    else:
        print("Status tidak valid atau terjadi kesalahan dalam koneksi database.")

    time.sleep(1)


