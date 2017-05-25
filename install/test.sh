#!/bin/bash

. funcs.sh

# OPTIONS:

# COMMAND LINE PROPERTIES:

# SYSTEM PROPERTIES:

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

SYSTEM=`uname -s`
RELEASE=$([ $SYSTEM = "Darwin" ] && echo `sw_vers -productVersion` || read_linux_release)

if ! check_os_support $SYSTEM $RELEASE; then
	printf "%s\n" "Currently only Debian, Raspbian and Ubuntu are supported."
	exit 1
fi

# DEPENDENCIES:

# check if sudo is available
if ! command -v sudo > /dev/null 2>&1; then
	printf "%s\n" "The command sudo was not found."
	exit 1
fi





msg "${SYSTEM}"
msg "${RELEASE}"