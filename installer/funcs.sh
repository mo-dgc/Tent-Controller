# Common functions

# Colors for msg outputs
Color_Off="\033[0m"       # Text Reset
Black="\033[0;30m"        # Black
Red="\033[0;31m"          # Red
Green="\033[0;32m"        # Green
Yellow="\033[0;33m"       # Yellow
Blue="\033[0;34m"         # Blue
Purple="\033[0;35m"       # Purple
Cyan="\033[0;36m"         # Cyan
White="\033[0;37m"        # White

msg() {
	echo -e "$Green$(date '+%Y-%m-%d %H:%M:%S'): $Yellow$1$Color_Off"
}

err() {
	echo -e "$Red$1$Color_Off" | tee -a install.log
}

read_linux_release() {
    LINE=`grep "^ID=" /etc/os-release`
    echo "${LINE##*=}"
}

check_os_support() {
	SYSTEM=$1
	RELEASE=$2

	case $SYSTEM in
		"Darwin")
			return 1;
			;;
		"Linux")
			case $RELEASE in
				"debian")
					return 1;
					;;
				"ubuntu")
					return 1;
					;;
				"raspbian")
					return 0;
					;;
			esac
	esac
	return 1;
}

# @TODO: Figure out a better way to do this, unfortunately I only
#  have limited hardware to do testing with.
# Test C.H.I.P, Odroid-C2, PineA64

get_hardware_type() {
  ARCH=$(uname -m)

	if grep -q "^arm" <<< $ARCH; then
		# Determine Hardware
		HARDWARE=$(cat /proc/cpuinfo | grep 'Hardware' | awk '{print $3}')

		# BCM2835 - Raspbery Pi 1, Pi Zero, Pi Zero W
		# BCM2836 - Raspbery Pi 2
		# BCM2837 - Raspbery Pi 3, 32-bit reports as BCM2709
		if grep -q "^BCM" <<< $HARDWARE; then
			# We are a raspberry pi of some sort.
			REVISION=$(cat /proc/cpuinfo | grep 'Revision' | awk '{print $3}')
			# http://www.raspberrypi-spy.co.uk/2012/09/checking-your-raspberry-pi-board-version/
			# I only grab raspberry pi 3 here
			case $REVISION in
				"a02082"|"a22082") 
					echo "raspberypi3" 
					;;
				*)
					echo "raspberrypi"
					;;
			esac
		fi
	fi
}
