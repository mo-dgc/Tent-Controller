#!/bin/bash

INSTALLER_DIR="$(dirname $(readlink -f $0))/installer"
INSTALL="/home/pi/gtmcs"
BINROOT="$INSTALL/bin/"
WEBROOT="$INSTALL/www/"

. $INSTALLER_DIR/funcs.sh

SYSTEM=`uname -s`
RELEASE=$([ $SYSTEM = "Darwin" ] && echo `sw_vers -productVersion` || read_linux_release)


# Make sure we are on a supported platform
if ! check_os_support $SYSTEM $RELEASE; then
	err ">>> Unsupported platform <<<"
	err "Sorry, currently only Debian, Raspbian, and Ubuntu are supported."
	exit 1
fi

# Make sure sudo is available and that we are running as root
if ! command -v sudo > /dev/null 2>&1; then
	err ">>> SUDO not found <<<"
	err "Please install sudo and retry the installation."
	exit 1
fi

# Are we running under sudo?  If not, relaunch.
if [ "$UID" != "0" ]; then
		sudo -H "$0" "$@"
	exit $?
fi


msg "Starting GT:MCS Installation"

if [ -f $INSTALLER_DIR/install.$RELEASE.sh ]; then
	msg "Running $RELEASE specific configurations"
	$INSTALLER_DIR/install.$RELEASE.sh
else
	err ">>> $RELEASE installer missing <<<"
	err "$INSTALLER_DIR/install.$RELEASE.sh was not found."
	err "Please open a ticket for this issue on GitHub."
	exit 1
fi

msg "Installation is complete. Please reboot the system."
