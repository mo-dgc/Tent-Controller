#!/usr/bin/env python3

import serial
import time
import argparse

def init():
  parser = argparse.ArgumentParser(description="XBee Test")
  parser.add_argument("port", action="store", help="Serial Port")
  parser.add_argument("-d", "--debug", help="Print Debug Info", action="store_true")
  args = parser.parse_args()
  main(args)


def isTransparentMode(s, speed=9600):
  ser = serial.Serial(s, speed)
  ser.timeout=1
  ser.flushInput()
  ser.write("+++".encode())
  time.sleep(0.5)
  ser.flushInput()
  ser.write("AT\r".encode())
  
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


def main(args):
  if isTransparentMode(args.port):
    print("Transparent")
  else:
    # Test for API
    if isAPIMode(args.port):
      print("API")
    else:
      # Unknown
      print("Unknown")

if __name__ == "__main__":
  init()


