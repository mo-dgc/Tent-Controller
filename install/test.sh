#!/bin/bash

INSTALLER_DIR=$(dirname $(readlink -f $0))
INSTALL="/home/pi/gtmcs"
BINROOT="$INSTALL/bin/"
WEBROOT="$INSTALL/www/"

. $INSTALLER_DIR/funcs.sh

SYSTEM=`uname -s`
RELEASE=$([ $SYSTEM = "Darwin" ] && echo `sw_vers -productVersion` || read_linux_release)

if ! check_os_support $SYSTEM $RELEASE; then
	printf "%s\n" "Currently only Debian, Raspbian and Ubuntu are supported."
	exit 1
fi

# check if sudo is available
if ! command -v sudo > /dev/null 2>&1; then
	printf "%s\n" "The command sudo was not found."
	exit 1
fi

# Are we running under sudo?  If not, relaunch.
if [ "$UID" != "0" ]; then
	sudo -H "$0" "$@"
	exit $?
fi


msg "${SYSTEM}"
msg "${RELEASE}"
msg `whoami`