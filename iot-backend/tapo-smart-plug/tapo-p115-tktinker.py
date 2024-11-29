import asyncio
import threading
import tkinter as tk
from datetime import datetime
from tapo import ApiClient
from tapo.requests import EnergyDataInterval

# Tapo device credentials
TAPO_USERNAME = "zakifajar96@gmail.com"
TAPO_PASSWORD = "*********"
IP_ADDRESS = "192.168.18.216"

# Initialize the async Tapo API client
client = ApiClient(TAPO_USERNAME, TAPO_PASSWORD)
device = None  # Will store the device object once connected

# Function to initialize Tapo device connection
async def initialize_device():
    global device
    device = await client.p110(IP_ADDRESS)

# Function to turn the device on
async def turn_on_device():
    if device:
        await device.on()
        status_label.config(text="Device Status: ON")

# Function to turn the device off
async def turn_off_device():
    if device:
        await device.off()
        status_label.config(text="Device Status: OFF")

# Function to update power, energy usage, and calendar date/time
async def update_readings():
    if device:
        # Fetch the current power and energy usage
        current_power = await device.get_current_power()
        energy_usage = await device.get_energy_usage()

        # Print the dictionary structure to inspect the actual keys
        print(f"Current power: {current_power.to_dict()}")
        print(f"Energy usage: {energy_usage.to_dict()}")

        # Extract the correct attributes from the response dictionaries
        current_power_dict = current_power.to_dict()
        energy_usage_dict = energy_usage.to_dict()

        # Use the correct keys based on your inspection
        power = current_power_dict.get('current_power', '--')  # Adjusted key for power
        energy_today = energy_usage_dict.get('today_energy', '--')  # Adjusted key for today's energy
        energy_month = energy_usage_dict.get('month_energy', '--')  # Adjusted key for monthly energy
        local_time = energy_usage_dict.get('local_time', '')  # Extract local time

        # Parse the local time into a datetime object
        if local_time:
            local_datetime = datetime.fromisoformat(local_time)
            current_date = local_datetime.strftime('%Y-%m-%d')
            current_time = local_datetime.strftime('%H:%M:%S')
        else:
            current_date = '--'
            current_time = '--'

        # Update the labels with the correct values
        power_label.config(text=f"Power: {power} W")
        energy_label.config(text=f"Energy Today: {energy_today} kWh\nEnergy This Month: {energy_month} kWh")
        date_label.config(text=f"Date: {current_date}")
        time_label.config(text=f"Time: {current_time}")
    
    # Update every 5 minutes
    root.after(60000*5, asyncio.run, update_readings())

# Tkinter GUI setup
root = tk.Tk()
root.title("Tapo Device Controller")

# Device status label
status_label = tk.Label(root, text="Device Status: OFF", font=("Arial", 14))
status_label.pack(pady=10)

# Power, energy usage, date, and time labels
power_label = tk.Label(root, text="Power: -- W", font=("Arial", 14))
power_label.pack(pady=5)

energy_label = tk.Label(root, text="Energy Today: -- kWh\nEnergy This Month: -- kWh", font=("Arial", 14))
energy_label.pack(pady=5)

date_label = tk.Label(root, text="Date: --", font=("Arial", 14))
date_label.pack(pady=5)

time_label = tk.Label(root, text="Time: --", font=("Arial", 14))
time_label.pack(pady=5)

# On/Off buttons
on_button = tk.Button(root, text="Turn On", font=("Arial", 12), command=lambda: asyncio.run(turn_on_device()))
on_button.pack(pady=10)

off_button = tk.Button(root, text="Turn Off", font=("Arial", 12), command=lambda: asyncio.run(turn_off_device()))
off_button.pack(pady=10)

# Asyncio event loop in a separate thread for continuous updating
def start_async_loop(loop):
    asyncio.set_event_loop(loop)
    loop.run_until_complete(initialize_device())
    loop.run_until_complete(update_readings())

# Start the async event loop in a separate thread
async_loop = asyncio.new_event_loop()
threading.Thread(target=start_async_loop, args=(async_loop,), daemon=True).start()

# Run the Tkinter GUI
root.mainloop()
