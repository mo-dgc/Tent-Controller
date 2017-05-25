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
	echo "$(date '+%Y-%m-%d %H:%M:%S'): $1" >> install.log
}

err() {
	echo -e "$Red$1$Color_Off" | tee -a install.log
	echo "$(date '+%Y-%m-%d %H:%M:%S'): $1" >> install.log
}

log() {
	echo "$(date '+%Y-%m-%d %H:%M:%S'): $1" >> install.log
}

init_log() {
	echo "" > install.log
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
