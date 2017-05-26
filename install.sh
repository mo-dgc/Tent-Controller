#!/bin/bash

INSTALLER_DIR="$(dirname $(readlink -f $0))/installer"

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

# Determine hardware type
HWTYPE=$(get_hardware_type)
if [ ! -z "$HWTYPE" ]; then
	# Do HW Specific configurations
	msg "Running $HWTYPE specific configurations"
	$INSTALLER_DIR/install.hw.$HWTYPE.sh
fi

# Do OS Specific configurations
if [ -f $INSTALLER_DIR/install.os.$RELEASE.sh ]; then
	msg "Running $RELEASE specific configurations"
	$INSTALLER_DIR/install.os.$RELEASE.sh
else
	err ">>> $RELEASE installer missing <<<"
	err "$INSTALLER_DIR/install.os.$RELEASE.sh was not found."
	err "Please open a ticket for this issue on GitHub."
	exit 1
fi

configure_php7
configure_nginx


# Make sure that os.installer set required variables to proceed.
if [ -z "$INSTALL" ] || [ -z "$BINROOT" ] || [ -z "$WEBROOT" ] || [ -z "$APPUSER" ]; then
	err ">>> $RELEASE installer did not set required variables <<<"
	err "INSTALL = '$INSTALL'"
	err "BINROOT = '$BINROOT'"
	err "WEBROOT = '$WEBROOT'"
	err "APPUSER = '$APPUSER'"
	err "Please open a ticket for this issue on GitHub."
	exit 1
fi

# This needs to be done per OS.
install_components

msg "Installation is complete.  Please refer to the getting started wiki."
msg "Please reboot the system."
