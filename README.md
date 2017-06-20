# Grow Tent Management and Control System

A simple Management and Control System for indoor gardening.  

# Components

This system currently uses the Raspberry Pi 3, official 7" touch screen and case, and XBee to control the remote nodes.  Management of the system can be done via a web interface over WiFi.  The touch screen is used as a Kiosk/Dashboard to monitor the system.  There are plans to add basic control and configuration to the touch screen, but for now it's pretty simple. (Read that as: I'm no web developer.)

The remote nodes are all Arduino type microcontrollers, currently using Xbee.  I plan on keeping this easy so it can be ported to other wireless systems (WiFi, LoRa, Cellular, etc) in the future.

The remote node repos can be found at:

* Relay - Xbee controlled relays
* Sensor - Xbee controlled sensor(s)
* Camera - [Tent Camera](https://github.com/mo-dgc/gtmcs-camera)

To get started, see the wiki: https://github.com/mo-dgc/Tent-Controller/wiki
