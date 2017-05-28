#!/usr/bin/env python3

import serial
import time

def isTransparentMode(s, speed=9600):
  ser = serial.Serial(s, speed)
  ser.timeout=1
  ser.flushInput()
  ser.write("+++".encode())
  time.sleep(1)
  
  try:
    data = ser.readline().decode().strip()
  except:
    data = ""
  
  ser.close()
  
  if data == "OK":
    return True
  else:
    return False

def isAPIMode(s, speed=9600):
  return True

if isTransparentMode("/dev/ttyUSB0"):
  print("Transparent")
else:
  # Test for API
  if isAPIMode("/dev/ttyUSB0"):
    print("API")
  else:
    # Unknown
    print("Unknown")

