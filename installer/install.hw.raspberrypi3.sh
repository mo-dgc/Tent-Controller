#!/bin/bash

. $(dirname $(readlink -f $0))/funcs.sh


disable_serial() {
	msg "Disabling Bluetooth"
	systemctl disable hciuart
	
	msg "Disabling serial console"
	systemctl stop serial-getty@ttyS0.service
	systemctl disable serial-getty@ttyS0.service
	
	if grep -q "console=serial0,115200" /boot/cmdline.txt; then
		msg "Removing serial console from /boot/cmdline.txt"
		sed -i 's/console=serial0,115200 //' /boot/cmdline.txt
	fi

	if ! grep -q "dtoverlay=pi3-miniuart-bt" /boot/config.txt; then
		msg "Swapping serial ports"
		echo "dtoverlay=pi3-miniuart-bt" >> /boot/config.txt
	fi	
}


disable_serial

