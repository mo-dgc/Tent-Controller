#!/bin/bash

. $INSTALLER_DIR/funcs.sh


disable_serial() {	
	msg "Disabling serial console"
	systemctl stop serial-getty@ttyAMA0.service
	systemctl disable serial-getty@ttyAMA0.service
	systemctl mask serial-getty@ttyAMA0.service
	
	if grep -q "ttyAMA0" /boot/cmdline.txt; then
		msg "Removing serial console from /boot/cmdline.txt"
		sed -i 's/console=ttyAMA0,115200 //' /boot/cmdline.txt
		sed -i 's/kgdboc=ttyAMA0,115200 //' /boot/cmdline.txt
	fi

	# gpio readall (requires apt-get install wiringpi)
	#  Should show 15 and 16 in ALT0
	#  If not:
	# gpio mode 15 ALT0; gpio mode 16 ALT0

	# Adding enable_uart=1 in /boot/config.txt does the same.
	# Need to test this on Pi2
}


disable_serial

