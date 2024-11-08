import asyncio
from datetime import datetime
from tapo import ApiClient
from tapo.requests import EnergyDataInterval

async def main():
    tapo_username = "zakifajar96@gmail.com"
    tapo_password = "Tapoapp13315009!"
    ip_address = "192.168.18.216"

    client = ApiClient(tapo_username, tapo_password)
    device = await client.p110(ip_address)

    print("Turning device on...")
    await device.on()

    try:
        while True:
            # Retrieve and print device information every 5 seconds
            device_info = await device.get_device_info()
            print(f"Device info: {device_info.to_dict()}")

            device_usage = await device.get_device_usage()
            print(f"Device usage: {device_usage.to_dict()}")

            current_power = await device.get_current_power()
            print(f"Current power: {current_power.to_dict()}")

            energy_usage = await device.get_energy_usage()
            print(f"Energy usage: {energy_usage.to_dict()}")

            today = datetime.today()
            energy_data_hourly = await device.get_energy_data(EnergyDataInterval.Hourly, today)
            print(f"Energy data (hourly): {energy_data_hourly.to_dict()}")

            energy_data_daily = await device.get_energy_data(
                EnergyDataInterval.Daily,
                datetime(today.year, get_quarter_start_month(today), 1),
            )
            print(f"Energy data (daily): {energy_data_daily.to_dict()}")

            energy_data_monthly = await device.get_energy_data(
                EnergyDataInterval.Monthly,
                datetime(today.year, 1, 1),
            )
            print(f"Energy data (monthly): {energy_data_monthly.to_dict()}")

            print("Waiting 5 minutes for next update...\n")
            await asyncio.sleep(60*5)  # Wait for ** seconds before the next iteration

    except KeyboardInterrupt:
        print("Monitoring stopped by user.")
    finally:
        # Optional: Turn off device when exiting the program
        print("Turning device off...")
        # await device.off()

def get_quarter_start_month(today: datetime) -> int:
    return 3 * ((today.month - 1) // 3) + 1

if __name__ == "__main__":
    asyncio.run(main())