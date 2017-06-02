#!/usr/bin/env python3

import serial
import time
import argparse
from xbee import XBee,ZigBee
import binascii

def init():
  parser = argparse.ArgumentParser(description="XBee Test")
  parser.add_argument("port", action="store", help="Serial Port")
  parser.add_argument("-d", "--debug", help="Print Debug Info", action="store_true")
  args = parser.parse_args()
  main(args)


def print_data(data):
  if data["id"] == "rx":
    """
    {'id': 'rx', 
     'source_addr_long': b'\x00\x13\xa2\x00A%\x92\xfc', 
     'source_addr': b'\xe3\xb9', 
     'options': b'\x01', 
     'rf_data': b'test'
     }
    """
    mac = binascii.hexlify(bytearray(data["source_addr_long"])).decode()
    net_addr = binascii.hexlify(bytearray(data["source_addr"])).decode()
    print("{} {}: {}".format(mac, net_addr, data["rf_data"].decode()))
  elif data["id"] == "at_response":
    if data["command"].decode() == "AS":
      """
      {'id': 'at_response', 'frame_id': b'\x01', 'command': b'AS', 'status': b'\x00', 'parameter': b'\x02\x19kX\x89\xef\x17\x02r\xd3~\xa9\x00\x02\xff\xc5'}
      {'id': 'at_response', 'frame_id': b'\x01', 'command': b'AS', 'status': b'\x00', 'parameter': b'\x02\x19\xa6\x01DGCRocks\x01\x00\xff\xde'}
      {'id': 'at_response', 'frame_id': b'\x01', 'command': b'AS', 'status': b'\x00'}
      """
      print(data)
    elif data["command"].decode() == "ND":
      """
      {'id': 'at_response', 
       'frame_id': b'\x01', 
       'command': b'ND', 
       'status': b'\x00', 
       'parameter': 
          {'source_addr': b'\xe3\xb9', 
           'source_addr_long': b'\x00\x13\xa2\x00A%\x92\xfc', 
           'node_identifier': b' ', 
           'parent_address': b'\xff\xfe', 
           'device_type': b'\x01', 
           'status': b'\x00', 
           'profile_id': b'\xc1\x05', 
           'manufacturer': b'\x10\x1e'}
      }
      Need to see how this looks with multiple devices
      """
      print("{} {}: {}".format(data["command"].decode(),
        binascii.hexlify(bytearray(data["status"])).decode(),
        data["parameter"]))
    else:
      print("UNKNOWN: {}".format(data))
  else:
    print(data)
 


def main(args):
  ser = serial.Serial(args.port, 9600)
  xbee = ZigBee(ser, callback=print_data) #, escaped=True)

  while True:
    try:
      data=input("Send:")
      if data == "ND":
        xbee.send("at", command="ND") #dest_addrr=b'\x1a7', command=str.encode('NI'))
      elif data == "AS":
        xbee.send("at", command="AS")
      else:
        xbee.tx(data=data.encode())
    except KeyboardInterrupt:
      break

  xbee.halt()
  ser.close()

if __name__ == "__main__":
  init()


