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

connection = mysql.connector.connect(**db_config)
cursor = connection.cursor(dictionary=True)

# Specifications of Network scanner (the device Tuya must be turned "ON")
Device_Id = 'eb82031cdec9f6852ac2vx' # Device Id from Tuya device sensor
Address_Id = '192.168.18.80' # IP Address connected to Tuya device sensor
Local_Key = '92ceae392e5829ce' # Local Key generated from  python -m tinytuya wizard
Version = 3.3  # Version of Tuya protocol used

id_smartplug = 9

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
        query = "SELECT status FROM controller WHERE id = {id_smartplug}"
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
        query = "SELECT SUM(electricity) as electricity FROM `tuya_smart_plug_{id_smartplug}`"
        cursor.execute(query)
        result = cursor.fetchone()
        if result:
            return result["electricity"]
        else:
            return 0
    except Exception as e:
        print(f"Error: {e}")


while True:
    timer = datetime.datetime.now()

    status = get_controller_status()
    if status == "online":
        smartplug.turn_on()
        try:
            # Time
            # Get Status of Tuya device sensor
            data = smartplug.status()
            print("data dps : ", data['dps'])
            # print("data : ", data)
            print("data voltage : ", data['dps']['20'])
            print("data power : ", data['dps']['19'])
            print("data current : ", data['dps']['18'])
            # print("data Electricity : ", data['dps']['17'])
            print(" ")

            # Voltage # DPS (Data Points)
            voltage = data['dps']['20']/10
            # print("Voltage                       :", voltage, "V")

            # Current # DPS (Data Points)
            current = (data['dps']['18'])/1000
            # print("Current                       :", current, "A")

            latest_electricity = get_sum_electricity()

            if current == 0:
                print("SSSS")
                query = "INSERT INTO `tuya_smart_plug_1` (time, voltage, current, power, electricity, day, week, month, total_electricity, total_cost, carbon_emission) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
                cursor.execute(query, (timer.strftime("%Y-%m-%d %H:%M:%S"),
                                       voltage,
                                       0,
                                       0,
                                       0,
                                       0,
                                       0,
                                       0,
                                       latest_electricity,
                                       0,
                                       0))

                connection.commit()

                last_insert_id = cursor.lastrowid
                print(f"ID Baris Terakhir yang Dimasukkan: {last_insert_id}")

                time.sleep(10)

            else:
                # Power   # DPS (Data Points)
                power = data['dps']['19']/10
                # print("Power                         :", power, "W")

                # Time current
                timer_final = datetime.datetime.now()

                # Menghitung selisih waktu dalam detik
                delta_time = (timer_final - timer).total_seconds()

                # Jumlah subinterval untuk metode Riemann Sum
                n = 1000

                # Lebar setiap subinterval dalam detik
                delta_t = delta_time / n

                # Menghitung daya rata-rata dalam setiap subinterval (karena power konstan)
                avg_power = power

                # Menghitung energi listrik menggunakan metode Riemann Sum
                electricity = (avg_power / 1000) * delta_time  # kWh
                
                sum_electricity = get_sum_electricity() + electricity

                print(" ")

                query = "INSERT INTO `tuya_smart_plug_{id_smartplug}` (time, voltage, current, power, electricity, day, week, month, total_electricity, total_cost, carbon_emission) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"

                cursor.execute(query, (timer.strftime("%Y-%m-%d %H:%M:%S"),
                                       voltage,
                                       current,
                                       power,
                                       electricity,
                                       0,
                                       0,
                                       0,
                                       sum_electricity,
                                       0,
                                       0))

                connection.commit()

                # Dapatkan ID baris terakhir yang dimasukkan ke dalam tabel
                last_insert_id = cursor.lastrowid
                print(f"ID Baris Terakhir yang Dimasukkan: {last_insert_id}")

                time.sleep(10)

        except Exception as e:
            print("Error:", str(e))

    elif status == "offline":
        smartplug.turn_off()
        time.sleep(5)
    else:
        print("Error: Failed to establish a database connection or invalid database status")
        time.sleep(5)
